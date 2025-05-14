<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\ShippingAreaRequest;
use App\Http\Requests\UpdateShippingAreaRequest;
use App\Models\ShippingArea;
use Illuminate\Http\Request;

class ShippingAreaController extends Controller
{
    public function index()
    {
        $areas = ShippingArea::filter(request()->all())->paginate();
        return view('dashboard.shipping-area.index', compact('areas'));
    }

    public function show(ShippingArea $area)
    {
        return view('dashboard.shipping-area.show', compact('area'));
    }


    public function create()
    {
        return view('dashboard.shipping-area.create');
    }

    public function store(ShippingAreaRequest $request)
    {
        ShippingArea::create($request->validated());
        return redirect()->route('dashboard.areas.index')->with('success', __('area.shipping_area_created_successfully'));
    }

    public function edit(ShippingArea $area)
    {
        return view('dashboard.shipping-area.edit', compact('area'));
    }

    public function update(UpdateShippingAreaRequest $request, ShippingArea $area)
    {
        $area->update($request->validated());
        return redirect()->route('dashboard.areas.index')->with('success', __('area.shipping_area_updated_successfully'));
    }

    public function destroy(ShippingArea $area)
    {
        $area->delete();
        return redirect()->route('dashboard.areas.index')->with('success', __('area.shipping_area_deleted_successfully'));
    }
}
