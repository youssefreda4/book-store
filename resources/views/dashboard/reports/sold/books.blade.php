@extends('dashboard.layout')

@section('title', 'Dashboard')

@php
$locale = session()->get('locale');
@endphp

@section('content_header')
<x-header :title="__('soldBooksReport.most_sold_books')"></x-header>
@include('dashboard.reports.partials.books-filter',['locale' => $locale])
@stop

@section('content')
<div class="card">
    <table class="table table-bordered ">
        <thead>
            <tr>
                <th class="text-center">{{ __('soldBooksReport.id') }}</th>
                <th class="text-center">{{ __('soldBooksReport.name') }}</th>
                <th class="text-center">{{ __('soldBooksReport.total_quantity_sold') }}</th>
                <th class="text-center">{{ __('soldBooksReport.actions') }}</th>
            </tr>
        </thead>
        <tbody>

            @foreach ($bestSellingBooks as $book)
            <tr>
                <th class="text-center">{{ translateNumberToLocale($locale,$book->id,0) }}</th>
                <td class="text-center">{{ $book->name }}</td>
                <td class="text-center">{{ translateNumberToLocale($locale,$book->total_quantity_sold,0) }}</td>
                <td>
                    <a href="{{ route('dashboard.books.show', $book->slug) }}" class="btn btn-info">
                        <i class="fas fa-eye"></i>
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
<div>
    {{ $bestSellingBooks->links() }}
</div>
@stop