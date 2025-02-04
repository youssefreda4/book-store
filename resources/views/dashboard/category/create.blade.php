@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1 class="card-header">Category Create</h1>
@stop

@section('content')
    <div class="card card-primary">
        <form action="{{ route('dashboard.categories.store') }}" method="POST">
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <div class="row">
                        <x-adminlte-input name="name" label="Name" type="text" placeholder="Enter Category Name"
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
