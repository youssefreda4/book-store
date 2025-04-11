<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Discount;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\DiscountRequest;

class DiscountController extends Controller
{
    public function index()
    {
        $discounts = Discount::filter(request()->all())
            ->latest('id')
            ->paginate();
        return view('dashboard.discount.index', compact('discounts'));
    }

    public function show(Discount $discount)
    {
        return view('dashboard.discount.show', compact('discount'));
    }

    public function create()
    {
        return view('dashboard.discount.create');
    }

    public function store(DiscountRequest $request)
    {
        $data = $request->validated();
        $data['code'] =  Str::upper($request->code);
        Discount::create($data);
        return redirect()->route('dashboard.discounts.index')->with('success', __('discount.discount_created_successfully'));
    }

    public function edit(Discount $discount)
    {
        return view('dashboard.discount.edit', compact('discount'));
    }

    public function update(DiscountRequest $request, Discount $discount)
    {
        $data = $request->validated();
        $data['code'] = Str::upper($request->code);
        $discount->update($data);
        return redirect()->route('dashboard.discounts.index')->with('success', __('discount.discount_updated_successfully'));
    }

    public function destroy(Discount $discount)
    {
        $discount->delete();
        return redirect()->route('dashboard.discounts.index')->with('success',  __('discount.discount_deleted_successfully'));
    }

    public function search(Request $request)
    {
        $discounts = Discount::whereLike('code', "%$request->q%")
            ->orWhereLike('percentage', "%$request->q%")
            ->limit(10)->get();
        return response()->json(['data' => ['discounts' => $discounts]]);
    }
}
