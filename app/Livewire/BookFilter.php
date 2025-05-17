<?php

namespace App\Livewire;

use App\Models\Book;
use App\Models\Category;
use App\Models\Publisher;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\WithPagination;

class BookFilter extends Component
{
    use WithPagination;

    public $categories_id = [];

    public $publishers_id = [];

    public $start_year;

    public $end_year;

    public function mount()
    {
        $this->start_year = Book::select('publish_year')->min('publish_year');
        $this->end_year = now()->year;
    }

    #[Computed]
    public function categories()
    {
        return Category::has('books')->withCount('books')->get();
    }

    #[Computed]
    public function publishers()
    {
        return Publisher::has('books')->withCount('books')->get();
    }

    public function render()
    {
        $books = Book::with(['media', 'author', 'category', 'favorite', 'discountable', 'cartForCurrentUser'])
            ->filter([
                'category_id' => $this->categories_id,
                'publisher_id' => $this->publishers_id,
            ])
            ->whereBetween('publish_year', [$this->start_year, $this->end_year])
            ->paginate(10);

        return view('livewire.book-filter', compact('books'));
    }
}
