@extends('dashboard.layout')

@section('title', 'Dashboard')

@section('content_header')
    <x-header :title="__('flashsale.all_flash_sale')">
        <x-slot:actions>
            <a href="{{ route('dashboard.flashsales.create') }}" class="btn btn-success">
                <i class="fas fa-plus me-2"></i> <span>{{ __('flashsale.create') }}</span>
            </a>
        </x-slot:actions>
    </x-header>

    @include('dashboard.flash-sale.partials.filter')
@stop

@section('content')
    <div class="mb-3">
        <x-delete-selected model="Flashsale"></x-delete-selected>
    </div>
    <div class="card">
        <table class="table table-bordered ">
            <thead>
                <tr>
                    <th class="text-center"><input type="checkbox" id="select-all"></th>
                    <th class="text-center">{{ __('flashsale.id') }}</th>
                    <th class="text-center">{{ __('flashsale.name') }}</th>
                    <th class="text-center">{{ __('flashsale.description') }}</th>
                    <th class="text-center">{{ __('flashsale.date') }}</th>
                    <th class="text-center">{{ __('flashsale.time') }}</th>
                    <th class="text-center">{{ __('flashsale.create_at') }}</th>
                    <th class="text-center">{{ __('flashsale.updated_at') }}</th>
                    <th class="text-center">{{ __('flashsale.actions') }}</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $locale = session()->get('locale');
                @endphp
                @foreach ($flash_sales as $flash_sale)
                    <tr>
                        <td class="text-center "><input class="row-checkbox" type="checkbox" value="{{ $flash_sale->id }}">
                        <th class="text-center">
                            {{ $locale == 'ar' ? Numbers::ShowInArabicDigits($flash_sale->id) : $flash_sale->id }}</th>
                        <td class="text-center">{{ $flash_sale->name }}</td>
                        <td class="text-center">{{ $flash_sale->description }}</td>
                        <td class="text-center">{{ $flash_sale->date }}</td>
                        <td class="text-center">{{ $flash_sale->time }}</td>
                        <td class="text-center">
                            {{ $locale == 'ar' ? Numbers::ShowInArabicDigits($flash_sale->created_at) : $flash_sale->created_at }}
                        </td>
                        <td class="text-center">
                            {{ $locale == 'ar' ? Numbers::ShowInArabicDigits($flash_sale->updated_at) : $flash_sale->updated_at }}
                        </td>
                        <td class="text-center">
                            <x-crud-action-button route="flashsales" model="{{ $flash_sale->id }}"></x-crud-action-button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div>
        {{ $flash_sales->links() }}
    </div>
@stop
