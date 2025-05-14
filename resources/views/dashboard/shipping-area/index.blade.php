@extends('dashboard.layout')

@section('title', 'Shipping Areas')

@section('content_header')
<x-header :title="__('area.all_shipping_areas')">
    @can('super-admin')
    <x-slot:actions>
        <a href="{{ route('dashboard.areas.create') }}" class="btn btn-success">
            <i class="fas fa-plus me-2"></i> <span>{{ __('area.create') }}</span>
        </a>
    </x-slot:actions>
    @endcan
</x-header>

@include('dashboard.shipping-area.partials.filter')
@stop

@section('content')
@can('super-admin')
<div class="mb-3">
    <x-delete-selected model="ShippingArea"></x-delete-selected>

    <x-import-excel model="ShippingArea"></x-import-excel>

    <x-export-excel model="ShippingArea"></x-export-excel>
</div>
@endcan
<div class="card">
    <table class="table table-bordered ">
        <thead>
            <tr>
                @can('super-admin')
                <th class="text-center"><input type="checkbox" id="select-all"></th>
                @endcan
                <th class="text-center">{{ __('area.id') }}</th>
                <th class="text-center">{{ __('area.name') }}</th>
                <th class="text-center">{{ __('area.fee') }}</th>
                <th class="text-center">{{ __('area.create_at') }}</th>
                <th class="text-center">{{ __('area.updated_at') }}</th>
                @can('super-admin')
                <th class="text-center">{{ __('area.actions') }}</th>
                @endcan
            </tr>
        </thead>
        <tbody>
            @php
            $locale = session()->get('locale');
            @endphp
            @foreach ($areas as $area)
            <tr>
                @can('super-admin')
                <td class="text-center "><input class="row-checkbox" type="checkbox" value="{{ $area->id }}">
                </td>
                @endcan
                <td class="text-center">
                    {{ $locale == 'ar' ? Numbers::ShowInArabicDigits($area->id) : $area->id }}</td>
                <td class="text-center">{{ $area->name }}</td>

                <td class="text-center">
                    {{ $locale == 'ar' ? Numbers::ShowInArabicDigits($area->fee) : $area->fee }}</td>

                <td class="text-center">
                    {{ $locale == 'ar' ? Numbers::ShowInArabicDigits($area->created_at) : $area->created_at }}
                </td>
                <td class="text-center">
                    {{ $locale == 'ar' ? Numbers::ShowInArabicDigits($area->updated_at) : $area->updated_at }}
                </td>
                @can('super-admin')
                <td class="text-center">
                    <x-crud-action-button route="areas" model="{{ $area->id }}"></x-crud-action-button>
                </td>
                @endcan
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
<div>
    {{ $areas->links() }}
</div>
@stop