@extends('dashboard.layout')

@section('title', 'Dashboard')

@section('content_header')
    <x-header :title="__('flashsale.all_flash_sale')">
        @can('super-admin')
            <x-slot:actions>
                <a href="{{ route('dashboard.flashsales.create') }}" class="btn btn-success">
                    <i class="fas fa-plus me-2"></i> <span>{{ __('flashsale.create') }}</span>
                </a>
            </x-slot:actions>
        @endcan
    </x-header>

    @include('dashboard.flash-sale.partials.filter')
@stop

@section('content')
    @can('super-admin')
        <div class="mb-3">
            <x-delete-selected model="Flashsale"></x-delete-selected>

            <x-import-excel model="Flashsale"></x-import-excel>

            <x-export-excel model="Flashsale"></x-export-excel>
        </div>
    @endcan
    <div class="card">
        <table class="table table-bordered ">
            <thead>
                <tr>
                    @can('super-admin')
                        <th class="text-center"><input type="checkbox" id="select-all"></th>
                    @endcan
                    <th class="text-center">{{ __('flashsale.id') }}</th>
                    <th class="text-center">{{ __('flashsale.name') }}</th>
                    <th class="text-center">{{ __('flashsale.description') }}</th>
                    <th class="text-center">{{ __('flashsale.is_active') }}</th>
                    <th class="text-center">{{ __('flashsale.date') }}</th>
                    <th class="text-center">{{ __('flashsale.time') }}</th>
                    <th class="text-center">{{ __('flashsale.create_at') }}</th>
                    <th class="text-center">{{ __('flashsale.updated_at') }}</th>
                    @can('super-admin')
                        <th class="text-center">{{ __('flashsale.actions') }}</th>
                    @endcan
                </tr>
            </thead>
            <tbody>
                @php
                    $locale = session()->get('locale');
                @endphp
                @foreach ($flash_sales as $flash_sale)
                    <tr>
                        @can('super-admin')
                            <td class="text-center "><input class="row-checkbox" type="checkbox" value="{{ $flash_sale->id }}">
                            @endcan
                        <th class="text-center">
                            {{ $locale == 'ar' ? Numbers::ShowInArabicDigits($flash_sale->id) : $flash_sale->id }}</th>
                        <td class="text-center">{{ $flash_sale->name }}</td>
                        <td class="text-center">{{ $flash_sale->description }}</td>
                        <td class="text-center">{!! $flash_sale->isActive() !!}</td>
                        <td class="text-center">{{ $flash_sale->date }}</td>
                        <td class="text-center">{{ $flash_sale->time }}</td>
                        <td class="text-center">
                            {{ $locale == 'ar' ? Numbers::ShowInArabicDigits($flash_sale->created_at) : $flash_sale->created_at }}
                        </td>
                        <td class="text-center">
                            {{ $locale == 'ar' ? Numbers::ShowInArabicDigits($flash_sale->updated_at) : $flash_sale->updated_at }}
                        </td>
                        @can('super-admin')
                            <td class="text-center">
                                <x-crud-action-button route="flashsales" model="{{ $flash_sale->id }}"></x-crud-action-button>
                            </td>
                        @endcan
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div>
        {{ $flash_sales->links() }}
    </div>
@stop
