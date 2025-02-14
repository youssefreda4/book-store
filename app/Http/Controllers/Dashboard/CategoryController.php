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
        $categories = Category::filter(request()->all())
            ->latest('id')
            ->paginate();
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

        return redirect()->route('dashboard.categories.index')->with('success', __('category.discount_added_successfully'));
    }

    public function create()
    {
        return view('dashboard.category.create');
    }

    public function store(CategoryRequest $request)
    {
        $data = $request->validated();
        $category = Category::create($data);
        if ($request->hasFile('image')) {
            $category->addMediaFromRequest('image')->toMediaCollection('image');
        }
        return redirect()->route('dashboard.categories.index')->with('success', __('category.category_created_successfully'));
    }

    public function edit(Category $category)
    {
        return view('dashboard.category.edit', compact('category'));
    }

    public function update(CategoryRequest $request, Category $category)
    {
        if ($request->hasFile('image')) {
            $category->clearMediaCollection('image');
            $category->addMediaFromRequest('image')
                ->toMediaCollection('image');
        }
        $data = $request->validated();
        $category->update($data);
        return redirect()->route('dashboard.categories.index')->with('success', __('category.category_updated_successfully'));
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('dashboard.categories.index')->with('success', __('category.category_deleted_successfully'));
    }

    public function search(Category $request)
    {
        $categories = Category::whereLike('name->en', "%$request->q%")
            ->orWhereLike('name->ar', "%$request->q%")
            ->limit(10)->get();
        return response()->json(['data' => ['categories' => $categories]]);
    }
}
