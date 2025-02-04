<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Discount;

class CategoryController extends Controller
{
    public function index()
    {
        //filter(request()->all())->
        $categories = Category::filter(request()->all())->orderBy('id', 'DESC')->paginate();
        return view('dashboard.category.index', compact('categories'));
    }

    public function show(Category $category)
    {
        $discounts = Discount::get();
        return view('dashboard.category.show', compact('category', 'discounts'));
    }

    public function addDiscount(Request $request, Category $category)
    {
        $request->validate(['discount_id' => 'required|exists:discounts,id']);
        $category->update([
            'discount_id' => $request->discount_id,
        ]);

        return redirect()->route('dashboard.categories.index')->with('success', 'Discount Added successfully');
    }

    public function create()
    {
        return view('dashboard.category.create');
    }

    public function store(CategoryRequest $request)
    {
        $data = $request->validated();
        Category::create($data);
        return redirect()->route('dashboard.categories.index')->with('success', 'Category created successfully');
    }

    public function edit(Category $category)
    {
        return view('dashboard.category.edit', compact('category'));
    }

    public function update(CategoryRequest $request, Category $category)
    {
        $data = $request->validated();
        $category->update($data);
        return redirect()->route('dashboard.categories.index')->with('success', 'Category updated successfully');
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('dashboard.categories.index')->with('success', 'Category deleted successfully');
    }
}
