@extends('dashboard.layout')

@section('title', 'Dashboard')

@section('content_header')
    <h1 class="card-header">{{ __('discount.create_discounts') }}</h1>
@stop

@section('content')
    <div class="card card-primary">
        <form action="{{ route('dashboard.discounts.store') }}" method="POST">
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <div class="row">
                        <x-adminlte-input name="code" label="{{ __('discount.code') }}" type="text"
                            placeholder="ex: DISCOUNT******" fgroup-class="col-md-6" />

                        <x-adminlte-input name="quantity" label="{{ __('discount.quantity') }}" type="number"
                            placeholder="1 - 100" fgroup-class="col-md-6" />

                        <x-adminlte-input name="precentage" label="{{ __('discount.precentage') }}" type="test"
                            placeholder="ex: max-90" fgroup-class="col-md-6" />

                        <x-adminlte-input name="expiry_date" label="{{ __('discount.expiry_date') }}" type="datetime-local"
                            fgroup-class="col-md-6" />
                    </div>
                </div>
            </div>

            <div class="card-footer">
                <x-adminlte-button type="submit" theme="primary" label="{{ __('discount.create') }}" />
            </div>
        </form>
    </div>
@stop
