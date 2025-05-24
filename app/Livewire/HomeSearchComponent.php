<?php

namespace App\Livewire;

use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Url;
use Livewire\Component;

class HomeSearchComponent extends Component
{
    #[Url(except: 5)]
    public $limit = 5;

    #[Url(except: '')]
    public $searchParam;

    public function getLocale()
    {
        return session()->get('locale') ?? 'en';
    }

    public function searchForBooks()
    {
        $limit = $this->limit;
        $searchParam = trim($this->searchParam);

        if (! $searchParam || strlen($searchParam) < 2 || $limit < 5) {
            return collect();
        }

        $nameMatches = $this->searchBooksByName($searchParam, $this->limit);
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
            ->selectRaw("id ,
             COALESCE(
                JSON_UNQUOTE(JSON_EXTRACT(name, '$.\"{$this->getLocale()}\"')),
                JSON_UNQUOTE(JSON_EXTRACT(name, '$.\"en\"'))
            ) as name
            ,slug")
            ->limit($limit)
            ->get();
    }

    private function searchBooksByDescription($search, $count)
    {
        return DB::table('books')
            ->whereLike('description', "%$search%")
            ->selectRaw(
                "id ,
                COALESCE(
                    JSON_UNQUOTE(JSON_EXTRACT(name, '$.\"{$this->getLocale()}\"')),
                    JSON_UNQUOTE(JSON_EXTRACT(name, '$.\"en\"'))
                )  as name,
                slug ,
                COALESCE(
                    JSON_UNQUOTE(JSON_EXTRACT(description, '$.\"{$this->getLocale()}\"')),
                    JSON_UNQUOTE(JSON_EXTRACT(description, '$.\"en\"'))
                ) as description"
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
                 COALESCE(
                    JSON_UNQUOTE(JSON_EXTRACT(books.name, '$.\"{$this->getLocale()}\"')),
                    JSON_UNQUOTE(JSON_EXTRACT(books.name, '$.\"en\"'))
                ) as name,
                books.slug as slug, 
                COALESCE(
                    JSON_UNQUOTE(JSON_EXTRACT(authors.name, '$.\"{$this->getLocale()}\"')),
                    JSON_UNQUOTE(JSON_EXTRACT(authors.name, '$.\"en\"'))
                ) as author_name"
            )
            ->limit($count)
            ->get();
    }

    public function render()
    {
        return view('livewire.home-search-component', [
            'books' => $this->searchForBooks(),
        ]);
    }
}
