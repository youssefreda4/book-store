<?php

namespace App\Livewire;

use App\Models\AddToCart;
use App\Models\Book;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\WithPagination;

class BookFilter extends Component
{
    use WithPagination;

    public $categories_id = [];

    #[Computed]
    public function categories()
    {
        return Category::has('books')->withCount('books')->get();
    }


    public function render()
    {
        $books = Book::with('media', 'author', 'category', 'favorite', 'discountable','addToCart')->filter(['category_id' => $this->categories_id])->paginate(10);
        return view('livewire.book-filter', compact('books'));
    }
}
