@extends('dashboard.layout')

@section('title', 'Report Books')

@section('content_header')
<x-header :title="__('reports.books_report')">

</x-header>
@stop

@section('content')

@php
$locale = session()->get('locale');

function translateToLocale($locale,$number,int $digits= null){
return $locale == 'ar' ? Numbers::ShowInArabicDigits(number_format($number,$digits)) : number_format($number, $digits);
}
@endphp

<div class="row">
    <!-- Daily Sales -->
    <div class="col-lg-4 col-md-6">
        <x-adminlte-info-box title="{{ __('booksReport.today_sales') }}"
            text="{{ __('booksReport.total') }}:{{ translateToLocale($locale,$dailySales,2) }}"
            icon="fas fa-dollar-sign text-green" />
    </div>

    <!-- Weekly Sales -->
    <div class="col-lg-4 col-md-6">
        <x-adminlte-info-box title="{{ __('booksReport.this_week_sales') }}"
            text="{{ __('booksReport.total') }}: {{ translateToLocale($locale,$weeklySales,2) }}"
            icon="fas fa-calendar-week text-blue" />
    </div>

    <!-- Monthly Sales -->
    <div class="col-lg-4 col-md-6">
        <x-adminlte-info-box title="{{ __('booksReport.this_month_sales') }}"
            text="{{ __('booksReport.total') }}: {{ translateToLocale($locale,$monthlySales,2) }}"
            icon="fas fa-calendar-alt text-yellow" />
    </div>
</div>

<div class="row">
    <!-- Daily Orders -->
    <div class="col-lg-4 col-md-6">
        <x-adminlte-info-box title="{{ __('booksReport.today_orders') }}"
            text="{{ translateToLocale($locale,$dailyOrders)  }} {{ __('booksReport.orders') }}"
            icon="fas fa-shopping-cart text-green" />
    </div>

    <!-- Weekly Orders -->
    <div class="col-lg-4 col-md-6">
        <x-adminlte-info-box title="{{ __('booksReport.this_week_orders') }}"
            text="{{ translateToLocale($locale,$weeklyOrders)  }} {{ __('booksReport.orders') }}"
            icon="fas fa-calendar-week text-blue" />
    </div>

    <!-- Monthly Orders -->
    <div class="col-lg-4 col-md-6">
        <x-adminlte-info-box title="{{ __('booksReport.this_month_orders') }}"
            text="{{ translateToLocale($locale,$monthlyOrders)  }} {{ __('booksReport.orders') }}"
            icon="fas fa-calendar-alt text-yellow" />
    </div>
</div>
@stop