@extends('dashboard.layout')

@section('title', 'Dashboard')

@section('content_header')
    <h1 class="card-header">{{ __('discount.discount_code') }} : {{ $discount->code }}</h1>
@stop

@section('content')
    <div class="card col-12">
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th class="text-center">{{ __('discount.id') }}</th>
                        <th class="text-center">{{ __('discount.code') }}</th>
                        <th class="text-center">{{ __('discount.quantity') }}</th>
                        <th class="text-center">{{ __('discount.precentage') }}</th>
                        <th class="text-center">{{ __('discount.expiry_date') }}</th>
                        <th class="text-center">{{ __('discount.create_at') }}</th>
                        <th class="text-center">{{ __('discount.updated_at') }}</th>
                        <th class="text-center">{{ __('discount.actions') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $locale = session()->get('locale');
                    @endphp
                    <tr>
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
                        <td class="text-center">
                            <div class="d-flex justify-content-between">

                                <a href="{{ route('dashboard.discounts.edit', $discount->id) }}" class="btn btn-warning ">
                                    <i class="fas fa-edit"></i>
                                </a>

                                <form action="{{ route('dashboard.discounts.destroy', $discount->id) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <x-adminlte-button type="submit" theme="danger" icon="fas fa-trash-alt" />
                                </form>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@stop
