@extends('dashboard.layout')

@section('title', 'Dashboard')

@section('content_header')
    <h1 class="card-header">{{ __('author.create_author') }}</h1>
@stop

@section('content')
    <div class="card card-primary">
        <form action="{{ route('dashboard.authors.store') }}" method="POST">
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <div class="row">
                        <x-adminlte-input name="name[en]" label="{{ __('author.name_author_en') }}" type="text" placeholder="{{ __('author.enter_author_name') }}"
                            fgroup-class="col-md-6" />

                        <x-adminlte-input name="name[ar]" label="{{ __('author.name_author_ar') }}" type="text" placeholder="{{ __('author.enter_author_name') }}"
                            fgroup-class="col-md-6" />
                    </div>
                </div>
            </div>

            <div class="card-footer">
                <x-adminlte-button type="submit" theme="primary" label="{{ __('author.create') }}" />
            </div>
        </form>
    </div>
@stop
