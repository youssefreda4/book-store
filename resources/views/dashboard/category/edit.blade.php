@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1 class="card-header">Category Edit</h1>
@stop

@section('content')
    <div class="card card-primary">
        <form action="{{ route('dashboard.categories.update', $category->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="card-body">
                <div class="form-group">
                    <div class="row">
                        <x-adminlte-input name="name" label="Name" value="{{ $category->name }}" type="text"
                            placeholder="Enter Category Name" fgroup-class="col-md-6" />
                    </div>
                </div>
            </div>

            <div class="card-footer">
                <x-adminlte-button type="submit" theme="primary" label="Update" />  
            </div>
        </form>
    </div>
@stop
