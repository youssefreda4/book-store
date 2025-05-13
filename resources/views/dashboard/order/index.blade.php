@extends('dashboard.layout')

@section('title', 'Orders')

@section('content_header')
<x-header :title="__('order.all_orders')">

</x-header>

@include('dashboard.order.partials.filter')
@stop

@section('content')
@can('super-admin')
<div class="mb-3">
    <x-import-excel model="Order"></x-import-excel>

    <x-export-excel model="Order"></x-export-excel>
</div>
@endcan
<div class="card">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th class="text-center">{{ __('order.id') }}</th>
                <th class="text-center">{{ __('order.number') }}</th>
                <th class="text-center">{{ __('order.shipping_fee') }}</th>
                <th class="text-center">{{ __('order.books_total') }}</th>
                <th class="text-center">{{ __('order.total') }}</th>
                <th class="text-center">{{ __('order.tax_amount') }}</th>
                <th class="text-center">{{ __('order.status') }}</th>
                <th class="text-center">{{ __('order.payment_status') }}</th>
                <th class="text-center">{{ __('order.payment_type') }}</th>
                <th class="text-center">{{ __('order.address') }}</th>
                <th class="text-center">{{ __('order.transaction_reference') }}</th>
                <th class="text-center">{{ __('order.shipping_area_id') }}</th>
                <th class="text-center">{{ __('order.user_id') }}</th>
                <th class="text-center">{{ __('Created At') }}</th>
                <th class="text-center">{{ __('Updated At') }}</th>
            </tr>
        </thead>
        <tbody>
            @php $locale = session()->get('locale'); @endphp

            @foreach ($orders as $order)
            <tr>
                <td class="text-center">
                    {{ $locale == 'ar' ? Numbers::ShowInArabicDigits($order->id) : $order->id }}
                </td>
                <td class="text-center">{{ $order->number }}</td>

                <td class="text-center">
                    {{ $locale == 'ar' ? Numbers::ShowInArabicDigits($order->shipping_fee) : $order->shipping_fee }}
                </td>
                <td class="text-center">
                    {{ $locale == 'ar' ? Numbers::ShowInArabicDigits($order->books_total) : $order->books_total }}
                </td>
                <td class="text-center">
                    {{ $locale == 'ar' ? Numbers::ShowInArabicDigits($order->total) : $order->total }}
                </td>
                <td class="text-center">
                    {{ $locale == 'ar' ? Numbers::ShowInArabicDigits($order->tax_amount) : $order->tax_amount }}
                </td>
                <td class="text-center">{!! $order->statusBadge() !!}</td>
                <td class="text-center">{!! $order->getPaymentStatusBadge() !!}</td>
                <td class="text-center">{!! $order->getPaymentTypeBadge() !!}</td>

                <td class="text-center">{{ $order->address }}</td>
                <td class="text-center">{{ $order->transaction_reference }}</td>
                <td class="text-center">{{ $order->shippingArea->name }}</td>

                <td class="text-center">{{ $order->user->first_name.' ' .$order->user->last_name}}</td>
                <td class="text-center">
                    {{ $locale == 'ar' ? Numbers::ShowInArabicDigits($order->created_at->format('Y-m-d H:i')) :
                    $order->created_at->format('Y-m-d H:i') }}
                </td>
                <td class="text-center">
                    {{ $locale == 'ar' ? Numbers::ShowInArabicDigits($order->updated_at->format('Y-m-d H:i')) :
                    $order->updated_at->format('Y-m-d H:i') }}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

</div>
<div>
    {{ $orders->links() }}
</div>
@stop