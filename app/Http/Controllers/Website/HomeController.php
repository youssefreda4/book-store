<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\BookInteraction;
use App\Models\UserPrefrence;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    private $locale;

    public function __construct()
    {
        $this->locale = session()->get('locale') ?? 'en';
    }

    public function index()
    {
        $bestSellingBooks = Book::with('media')->select('books.id', 'books.name')
            ->join('book_orders', 'books.id', '=', 'book_orders.book_id')
            ->selectRaw('SUM(book_orders.quantity) as total_quantity_sold')
            ->groupBy('books.id')
            ->orderByDesc('total_quantity_sold')
            ->limit(10)
            ->get();

        $now = Carbon::now()->format('Y-m-d H:i:s');

        $books = Book::with('author', 'media')->where('discountable_type', 'App\Models\FlashSale')
            ->join('flash_sales', 'flash_sales.id', '=', 'books.discountable_id')
            ->where('flash_sales.is_active', true)
            ->whereRaw("DATE_ADD(CONCAT(flash_sales.date, ' ', flash_sales.start_time), INTERVAL flash_sales.time HOUR) > ?", [$now])
            ->get();

        $recommended_books = collect([]);
        if (Auth::check()) {
            $recommended_books = $this->getRecommendedBooks(Auth::id());
        }

        return view('website.pages.index', compact('bestSellingBooks', 'books', 'recommended_books'));
    }

    public function getBooksFromPreferences($userId, $interests)
    {
        return Book::with('author:id,name')->whereHas('category', function ($query) use ($userId) {
            $query->whereIn('id', UserPrefrence::where('user_id', $userId)->pluck('category_id'));
        })
            ->orWhereHas('author', function ($query) use ($userId) {
                $query->whereIn('id', UserPrefrence::where('user_id', $userId)->pluck('author_id'));
            })
            ->select('id', 'slug', 'name', 'quantity' ,'description', 'rate', 'price', 'author_id')
            ->whereNotIn('id', $interests)
            ->inRandomOrder()
            ->limit(10)
            ->get();
    }

    public function getBooksFromSimilarUsers($userId, $interests)
    {
        return Book::with('author:id,name')->whereIn('id', function ($query) use ($userId) {
            $query->select('book_id')
                ->from('book_interactions')
                ->whereIn('user_id', function ($subQuery) use ($userId) {
                    $subQuery->select('user_id')
                        ->from('book_interactions')
                        ->whereIn('book_id', function ($subQuery2) use ($userId) {
                            $subQuery2->select('book_id')
                                ->from('book_interactions')
                                ->where('user_id', $userId);
                        })
                        ->where('user_id', '!=', $userId);
                });
            // ->where('rate', '>=', 4);
        })
            ->select('id', 'slug', 'name', 'quantity' ,'description', 'rate', 'price', 'author_id')
            ->whereNotIn('id', $interests)
            ->orderByDesc('rate')
            ->limit(10)
            ->get();
    }

    public function getRecommendedBooks($userId)
    {
        return Cache::remember("recommended_books_{$userId}", now()->addMinutes(30), function () use ($userId) {
            $interests = $this->getUserInterests($userId);
            $preferenceBooks = $this->getBooksFromPreferences($userId, $interests);
            $similarUserBooks = $this->getBooksFromSimilarUsers($userId, $interests);
            $recommendations = $preferenceBooks->merge($similarUserBooks)->sortByDesc('rate');

            return $recommendations->take(10);
        });
    }

    private function getUserInterests($user_id)
    {
        return BookInteraction::where('user_id', $user_id)->pluck('book_id');
    }

    public function searchForBooks(Request $request)
    {
        ['search' => $searchParam, 'limit' => $limit] = $request->all();
        $nameMatches = $this->searchBooksByName($searchParam, $limit);
        $nameMatches = $nameMatches->map(fn($book) => ['id' => $book->id, 'slug' => $book->slug, 'text' => $book->name]);

        $remainingCount = $limit - $nameMatches->count();
        if ($remainingCount) {
            $descriptionMatches = $this->searchBooksByDescription($searchParam, $remainingCount);

            $descriptionMatches = $descriptionMatches->map(function ($book) use ($searchParam) {
                $sentences = preg_split('/[.?,()]|\s+--\s+/', $book->description);

                foreach ($sentences as $sentence) {
                    if (stripos($sentence, $searchParam) !== false) {
                        $book->text = $book->name . ' - ' . $sentence;
                    }
                }

                return ['id' => $book->id, 'slug' => $book->slug, 'text' => $book->text];
            });
        }

        $books = $nameMatches->merge($descriptionMatches ?? null);

        $remainingCount = $limit - $books->count();
        if ($remainingCount) {
            $authorMatches = $this->searchBooksByAuthors($searchParam, $remainingCount);
            $authorMatches = $authorMatches->map(fn($book) => [
                'id' => $book->id,
                'slug' => $book->slug,
                'text' => "{$book->name} By {$book->author_name}",
            ]);
        }

        $books = $books->merge($authorMatches ?? null);

        return $books;
    }

    private function searchBooksByName($search, $limit)
    {
        return DB::table('books')
            ->whereLike('name', "%$search%")
            ->selectRaw("id , JSON_UNQUOTE(JSON_EXTRACT(name, '$.\"{$this->locale}\"')) as name  ,slug")
            ->limit($limit)
            ->get();
    }

    private function searchBooksByDescription($search, $count)
    {
        return DB::table('books')
            ->whereLike('description', "%$search%")
            ->selectRaw(
                "id ,
                JSON_UNQUOTE(JSON_EXTRACT(name, '$.\"{$this->locale}\"')) as name,
                slug ,
                JSON_UNQUOTE(JSON_EXTRACT(description, '$.\"{$this->locale}\"')) as description"
            )
            ->limit($count)
            ->get();
    }

    private function searchBooksByAuthors($search, $count)
    {
        return DB::table('books')
            ->join('authors', 'authors.id', '=', 'books.author_id')
            ->whereLike('authors.name', "%$search%")
            ->selectRaw(
                "books.id as id ,
                JSON_UNQUOTE(JSON_EXTRACT(books.name, '$.\"{$this->locale}\"')) as name,
                books.slug as slug, 
                JSON_UNQUOTE(JSON_EXTRACT(authors.name, '$.\"{$this->locale}\"')) as author_name"
            )
            ->limit($count)
            ->get();
    }

    public function searchForBooksUsingFulltext()
    {
        ['search' => $searchParam, 'limit' => $limit] = request()->all();
        $books = Book::search($searchParam)->select('id', 'slug', 'name_' . $this->locale, 'description_' . $this->locale)->limit($limit)->get();

        return $books;
    }

    public function changeLanguage($lang)
    {
        if (in_array($lang, ['en', 'ar'])) {
            Session::put('locale', $lang);
        }
        return redirect()->back();
    }
}
