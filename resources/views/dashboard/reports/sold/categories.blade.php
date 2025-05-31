@extends('dashboard.layout')

@section('title', 'Dashboard')

@php
$locale = session()->get('locale');
@endphp

@section('content_header')
<x-header :title="__('soldCategoriesReport.most_sold_categories')"></x-header>
@include('dashboard.reports.partials.categories-filter',['locale' => $locale])
@stop

@section('content')
<div class="card">
    <table class="table table-bordered ">
        <thead>
            <tr>
                <th class="text-center">{{ __('soldCategoriesReport.id') }}</th>
                <th class="text-center">{{ __('soldCategoriesReport.name') }}</th>
                <th class="text-center">{{ __('soldCategoriesReport.total_quantity_sold') }}</th>
                <th class="text-center">{{ __('soldCategoriesReport.actions') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($bestSellingCategories as $category)
            <tr>
                <th class="text-center">{{ translateNumberToLocale($locale,$category->id,0) }}</th>
                <td class="text-center">{{ $category->name }}</td>
                <td class="text-center">{{ translateNumberToLocale($locale,$category->total_quantity_sold,0) }}</td>
                <td class="text-center">
                    <a href="{{ route('dashboard.categories.show', $category->id) }}" class="btn btn-info">
                        <i class="fas fa-eye"></i>
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
<div>
    {{ $bestSellingCategories->links() }}
</div>
@stop