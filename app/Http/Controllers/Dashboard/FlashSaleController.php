<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\FlashSale;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\FlashSaleRequest;

class FlashSaleController extends Controller
{
    public function index()
    {
       $flash_sales = FlashSale::filter(request()->all())
            ->latest('id')
            ->paginate();
        return view('dashboard.flash-sale.index', compact('flash_sales'));
    }

    public function show($flash_sale)
    {
        $flash_sale = FlashSale::findOrFail($flash_sale);
        return view('dashboard.flash-sale.show', compact('flash_sale'));
    }

    public function create()
    {
        return view('dashboard.flash-sale.create');
    }

    public function store(FlashSaleRequest $request)
    {
        $data = $request->validated();
        FlashSale::create($data);
        return redirect()->route('dashboard.flashsales.index')->with('success', __('flashsale.flash_sale_created_successfully'));
    }

    public function edit($flash_sale)
    {
        $flash_sale = FlashSale::findOrFail($flash_sale);
        return view('dashboard.flash-sale.edit', compact('flash_sale'));
    }

    public function update(FlashSaleRequest $request, $flash_sale)
    {
        $data = $request->validated();
        $flash_sale = FlashSale::findOrFail($flash_sale);
        $flash_sale->update($data);
        return redirect()->route('dashboard.flashsales.index')->with('success', __('flashsale.flash_sale_updated_successfully'));
    }

    public function destroy(FlashSale $flash_sale)
    {
        $flash_sale->delete();
        return redirect()->route('dashboard.flashsales.index')->with('success', __('flashsale.flash_sale_deleted_successfully'));
    }
}
