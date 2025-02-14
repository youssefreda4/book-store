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
        return redirect()->route('dashboard.publishers.index')->with('success',  __('publisher.publisher_created_successfully'));
    }

    public function edit(Publisher $publisher)
    {
        return view('dashboard.publisher.edit', compact('publisher'));
    }

    public function update(PublisherRequest $request, Publisher $publisher)
    {
        $data = $request->validated();
        $publisher->update($data);
        return redirect()->route('dashboard.publishers.index')->with('success',  __('publisher.publisher_updated_successfully'));
    }

    public function destroy(Publisher $publisher)
    {
        $publisher->delete();
        return redirect()->route('dashboard.publishers.index')->with('success',  __('publisher.publisher_deleted_successfully'));
    }

    public function search(Publisher $request)
    {
        $publishers = Publisher::whereLike('name->en', "%$request->q%")
            ->orWhereLike('name->ar', "%$request->q%")
            ->limit(10)->get();
        return response()->json(['data' => ['publishers' => $publishers]]);
    }
}
