<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Author;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\AuthorRequest;

class AuthorController extends Controller
{
    public function index()
    {
        $authors = Author::filter(request()->all())->orderBy('id', 'DESC')->paginate();
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
        return redirect()->route('dashboard.authors.index')->with('success', 'Author created successfully');
    }

    public function edit(Author $author)
    {
        return view('dashboard.author.edit', compact('author'));
    }

    public function update(AuthorRequest $request, Author $author)
    {
        $data = $request->validated();
        $author->update($data);
        return redirect()->route('dashboard.authors.index')->with('success', 'Author updated successfully');
    }

    public function destroy(Author $author)
    {
        $author->delete();
        return redirect()->route('dashboard.authors.index')->with('success', 'Author deleted successfully');
    }
}
