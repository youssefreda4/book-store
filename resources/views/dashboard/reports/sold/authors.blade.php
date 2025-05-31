@extends('dashboard.layout')

@section('title', 'Dashboard')

@php
$locale = session()->get('locale');
@endphp

@section('content_header')
<x-header :title="__('soldAuthorsReport.most_sold_authors')"></x-header>
@include('dashboard.reports.partials.authors-filter',['locale' => $locale])
@stop

@section('content')
<div class="card">
    <table class="table table-bordered ">
        <thead>
            <tr>
                <th class="text-center">{{ __('soldAuthorsReport.id') }}</th>
                <th class="text-center">{{ __('soldAuthorsReport.name') }}</th>
                <th class="text-center">{{ __('soldAuthorsReport.total_quantity_sold') }}</th>
                <th class="text-center">{{ __('soldAuthorsReport.actions') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($bestSellingAuthors as $author)
            <tr>
                <th class="text-center">{{ translateNumberToLocale($locale,$author->id,0) }}</th>
                <td class="text-center">{{ $author->name }}</td>
                <td class="text-center">{{ translateNumberToLocale($locale,$author->total_quantity_sold,0) }}</td>
                <td class="text-center">
                    <a href="{{ route('dashboard.authors.show', $author->id) }}" class="btn btn-info">
                        <i class="fas fa-eye"></i>
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
<div>
    {{ $bestSellingAuthors->links() }}
</div>
@stop