@extends('dashboard.layout')

@section('title', 'Total Trends Report')

@php
$locale = session()->get('locale') ?? 'en';
@endphp

@section('content_header')
<x-header :title="__('trends.total_trends_report')" />
@include('dashboard.reports.partials.trends-filter',['locale' => $locale])
@stop

@section('content')
<div class="card">
    <table class="table table-bordered ">
        <thead>
            <tr>
                <th class="text-center">{{ __('trends.book_id') }}</th>
                <th class="text-center">{{ __('trends.book_name') }}</th>
                <th class="text-center">{{ __('trends.year') }}</th>
                <th class="text-center">{{ __('trends.week_number') }}</th>
                <th class="text-center">{{ __('trends.total_quantity_sold') }}</th>
                <th class="text-center">{{ __('trends.actions') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($trendingSales as $book)
            <tr>
                <th class="text-center">{{ translateNumberToLocale($locale,$book->id,0) }}</th>
                <td class="text-center">{{ $book->name }}</td>
                <td class="text-center">{{ $locale == 'ar' ? Numbers::ShowInArabicDigits($book->year) : $book->year }}
                </td>
                <td class="text-center">{{ $locale == 'ar' ? Numbers::ShowInArabicDigits($book->week_number) :
                    $book->week_number }}</td>
                <td class="text-center">{{ translateNumberToLocale($locale,$book->total_quantity_sold,0) }}</td>
                <td class="text-center">
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
    {{ $trendingSales->links() }}
</div>
@stop