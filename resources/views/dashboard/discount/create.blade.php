@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1 class="card-header">Discounts Create</h1>
@stop

@section('content')
    <div class="card card-primary">
        <form action="{{ route('dashboard.discounts.store') }}" method="POST">
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <div class="row">
                        <x-adminlte-input name="code" label="Code" type="text" placeholder="ex: DISCOUNT******"
                            fgroup-class="col-md-6" />

                        <x-adminlte-input name="quantity" label="Quantity" type="number" placeholder="1 - 100"
                            fgroup-class="col-md-6" />

                        <x-adminlte-input name="precentage" label="Precentage" type="test" placeholder="ex: max-90"
                            fgroup-class="col-md-6" />

                        <x-adminlte-input name="expiry_date" label="Expiry Date" type="datetime-local"
                            fgroup-class="col-md-6" />
                    </div>
                </div>
            </div>

            <div class="card-footer">
                <x-adminlte-button type="submit" theme="primary" label="Create" />
            </div>
        </form>
    </div>
@stop
