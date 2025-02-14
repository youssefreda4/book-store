@extends('dashboard.layout')

@section('title', 'Dashboard')

@section('content_header')
    <x-header :title="__('discount.all_discounts')">
        @can('super-admin')
            <x-slot:actions>
                <a href="{{ route('dashboard.discounts.create') }}" class="btn btn-success">
                    <i class="fas fa-plus me-2"></i> <span>{{ __('discount.create') }}</span>
                </a>
            </x-slot:actions>
        @endcan
    </x-header>
    @include('dashboard.discount.partials.filter')
@stop

@section('content')
    @can('super-admin')
        <div class="mb-3">
            <x-delete-selected model="Discount"></x-delete-selected>

            <x-import-excel model="Discount"></x-import-excel>

            <x-export-excel model="Discount"></x-export-excel>

        </div>
    @endcan
    <div class="card">
        <table class="table table-bordered ">
            <thead>
                <tr>
                    @can('super-admin')
                        <th class="text-center"><input type="checkbox" id="select-all"></th>
                    @endcan
                    <th class="text-center">{{ __('discount.id') }}</th>
                    <th class="text-center">{{ __('discount.code') }}</th>
                    <th class="text-center">{{ __('discount.quantity') }}</th>
                    <th class="text-center">{{ __('discount.precentage') }}</th>
                    <th class="text-center">{{ __('discount.expiry_date') }}</th>
                    <th class="text-center">{{ __('discount.create_at') }}</th>
                    <th class="text-center">{{ __('discount.updated_at') }}</th>
                    @can('super-admin')
                        <th class="text-center">{{ __('discount.actions') }}</th>
                    @endcan
                </tr>
            </thead>
            <tbody>
                @php
                    $locale = session()->get('locale');
                @endphp
                @foreach ($discounts as $discount)
                    <tr>
                        @can('super-admin')
                            <td class="text-center "><input class="row-checkbox" type="checkbox" value="{{ $discount->id }}">
                            @endcan
                        <th class="text-center">
                            {{ $locale == 'ar' ? Numbers::ShowInArabicDigits($discount->id) : $discount->id }}</th>
                        <td class="text-center">{{ $discount->code }}</td>
                        <td class="text-center">
                            {{ $locale == 'ar' ? Numbers::ShowInArabicDigits($discount->quantity) : $discount->quantity }}
                        </td>
                        <td class="text-center">
                            {{ $locale == 'ar' ? Numbers::ShowInArabicDigits($discount->precentage) : $discount->precentage }}
                        </td>
                        <td class="text-center">
                            {{ $locale == 'ar' ? Numbers::ShowInArabicDigits($discount->expiry_date) : $discount->expiry_date }}
                        </td>
                        <td class="text-center">
                            {{ $locale == 'ar' ? Numbers::ShowInArabicDigits($discount->created_at) : $discount->created_at }}
                        </td>
                        <td class="text-center">
                            {{ $locale == 'ar' ? Numbers::ShowInArabicDigits($discount->updated_at) : $discount->updated_at }}
                        </td>
                        @can('super-admin')
                            <td class="text-center">
                                <x-crud-action-button route="discounts" model="{{ $discount->id }}"></x-crud-action-button>
                            </td>
                        @endcan
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div>
        {{ $discounts->links() }}
    </div>
@stop
