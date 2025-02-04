<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Publisher;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\PublisherRequest;

class PublisherController extends Controller
{
    public function index()
    {
        //filter(request()->all())->
        $publishers = Publisher::filter(request()->all())->orderBy('id', 'DESC')->paginate();
        return view('dashboard.publisher.index', compact('publishers'));
    }
    public function show(Publisher $publisher)
    {
        return view('dashboard.publisher.show', compact('publisher'));
    }


    public function create()
    {
        return view('dashboard.publisher.create');
    }

    public function store(PublisherRequest $request)
    {
        $data = $request->validated();
        Publisher::create($data);
        return redirect()->route('dashboard.publishers.index')->with('success', 'Publisher created successfully');
    }

    public function edit(Publisher $publisher)
    {
        return view('dashboard.publisher.edit', compact('publisher'));
    }

    public function update(PublisherRequest $request, Publisher $publisher)
    {
        $data = $request->validated();
        $publisher->update($data);
        return redirect()->route('dashboard.publishers.index')->with('success', 'Publisher updated successfully');
    }

    public function destroy(Publisher $publisher)
    {
        $publisher->delete();
        return redirect()->route('dashboard.publishers.index')->with('success', 'Publisher deleted successfully');
    }
}
