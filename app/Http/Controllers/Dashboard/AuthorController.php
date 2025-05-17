<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\AuthorRequest;
use App\Models\Author;

class AuthorController extends Controller
{
    public function index()
    {
        $authors = Author::filter(request()->all())
            ->latest('id')
            ->paginate();

        return view('dashboard.author.index', compact('authors'));
    }

    public function show(Author $author)
    {
        return view('dashboard.author.show', compact('author'));
    }

    public function create()
    {
        return view('dashboard.author.create');
    }

    public function store(AuthorRequest $request)
    {
        $data = $request->validated();
        Author::create($data);

        return redirect()->route('dashboard.authors.index')->with('success', __('author.author_created_successfully'));
    }

    public function edit(Author $author)
    {
        return view('dashboard.author.edit', compact('author'));
    }

    public function update(AuthorRequest $request, Author $author)
    {
        $data = $request->validated();
        $author->update($data);

        return redirect()->route('dashboard.authors.index')->with('success', __('author.author_updated_successfully'));
    }

    public function destroy(Author $author)
    {
        $author->delete();

        return redirect()->route('dashboard.authors.index')->with('success', __('author.author_deleted_successfully'));
    }

    public function search(Author $request)
    {
        $authors = Author::whereLike('name->en', "%$request->q%")
            ->orWhereLike('name->ar', "%$request->q%")
            ->limit(10)->get();

        return response()->json(['data' => ['authors' => $authors]]);
    }
}
