<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Author;
use App\Models\Book;
use App\Models\BookOrder;
use App\Models\Category;
use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function books()
    {
        $dailySales = Order::whereDate('created_at', Carbon::today())->sum('total');
        $weeklySales = Order::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->sum('total');
        $monthlySales = Order::whereMonth('created_at', Carbon::now()->month)->sum('total');

        $dailyOrders = Order::whereDate('created_at', Carbon::today())->count();
        $weeklyOrders = Order::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->count();
        $monthlyOrders = Order::whereMonth('created_at', Carbon::now()->month)->count();

        return view('dashboard.reports.sales.books', compact('dailySales', 'weeklySales', 'monthlySales', 'dailyOrders', 'weeklyOrders', 'monthlyOrders'));
    }

    public function revenue()
    {
        $dailyRevenue = DB::table('orders')
            ->selectRaw('Date(created_at) as date, SUM(total) as revenue')
            ->where('created_at', '>=', now()->subDays(7))
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        $weeklyRevenue = DB::table('orders')
            ->selectRaw('YEARWEEK(created_at) as week, SUM(total) as revenue')
            ->where('created_at', '>=', now()->subWeeks(6))
            ->groupBy('week')
            ->orderBy('week')
            ->get();

        $monthlyRevenue = DB::table('orders')
            ->selectRaw('DATE_FORMAT(created_at, "%Y-%m") as month, SUM(total) as revenue')
            ->where('created_at', '>=', now()->subMonths(6))
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        return view('dashboard.reports.sales.revenue', compact('dailyRevenue', 'weeklyRevenue', 'monthlyRevenue'));
    }

    public function trends()
    {
        $min = request('total_quantity_sold_from');
        $max = request('total_quantity_sold_to');
        $trendingSales = Book::leftJoin('book_orders', 'books.id', '=', 'book_orders.book_id')
            ->select(
                'books.id',
                'books.slug',
                'books.name',
                DB::raw('YEAR(book_orders.created_at) as year'),
                DB::raw('WEEK(book_orders.created_at) as week_number'),
                DB::raw('SUM(book_orders.quantity) as total_quantity_sold')
            )
            ->orderByDesc('total_quantity_sold')
            ->groupBy('books.id', 'books.slug', 'name', 'year', 'week_number')
            ->filter(request()->only(['book_name','total_quantity_sold_from', 'total_quantity_sold_to']))
            ->paginate()
            ->appends([
                'total_quantity_sold_from' => $min,
                'total_quantity_sold_to' => $max
            ]);

        return view('dashboard.reports.sales.trends', compact('trendingSales'));
    }

    public function soldBooks()
    {
        $min = request('total_quantity_sold_from');
        $max = request('total_quantity_sold_to');
        $bestSellingBooks = Book::with('media')
            ->select('books.id', 'books.name', 'books.slug')
            ->join('book_orders', 'books.id', '=', 'book_orders.book_id')
            ->selectRaw('SUM(book_orders.quantity) as total_quantity_sold')
            ->groupBy('books.id')
            ->orderByDesc('total_quantity_sold')
            ->filter(request()->only(['total_quantity_sold_from', 'total_quantity_sold_to']))
            ->paginate()
            ->appends([
                'total_quantity_sold_from' => $min,
                'total_quantity_sold_to' => $max
            ]);

        return view('dashboard.reports.sold.books', compact('bestSellingBooks'));
    }

    public function soldCategory()
    {
        $min = request('total_quantity_sold_from');
        $max = request('total_quantity_sold_to');
        $bestSellingCategories = Category::select('categories.id', 'categories.name')
            ->join('books', 'categories.id', '=', 'books.category_id')
            ->join('book_orders', 'books.id', '=', 'book_orders.book_id')
            ->selectRaw('SUM(book_orders.quantity) as total_quantity_sold')
            ->groupBy('categories.id', 'categories.name')
            ->orderByDesc('total_quantity_sold')
            ->filter(request()->only(['category_name', 'total_quantity_sold_from', 'total_quantity_sold_to']))
            ->paginate()
            ->appends([
                'total_quantity_sold_from' => $min,
                'total_quantity_sold_to' => $max
            ]);

        return view('dashboard.reports.sold.categories', compact('bestSellingCategories'));
    }

    public function soldAuthor()
    {
        $min = request('total_quantity_sold_from');
        $max = request('total_quantity_sold_to');
        $bestSellingAuthors = Author::select('authors.id', 'authors.name')
            ->join('books', 'authors.id', '=', 'books.author_id')
            ->join('book_orders', 'books.id', '=', 'book_orders.book_id')
            ->selectRaw('SUM(book_orders.quantity) as total_quantity_sold')
            ->groupBy('authors.id', 'authors.name')
            ->orderByDesc('total_quantity_sold')
            ->filter(request()->only(['author_name', 'total_quantity_sold_from', 'total_quantity_sold_to']))
            ->paginate()
            ->appends([
                'total_quantity_sold_from' => $min,
                'total_quantity_sold_to' => $max
            ]);
        return view('dashboard.reports.sold.authors', compact('bestSellingAuthors'));
    }
}
