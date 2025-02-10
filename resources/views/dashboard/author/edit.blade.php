@extends('dashboard.layout')

@section('title', 'Dashboard')

@section('content_header')
    <h1 class="card-header">{{ __('author.author_edit') }}</h1>
@stop

@section('content')
    <div class="card card-primary">
        <form action="{{ route('dashboard.authors.update', $author->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="card-body">
                <div class="form-group">
                    <div class="row">
                        <x-adminlte-input name="name[en]" label="{{ __('author.name_author_en') }}"
                            value="{{ $author->getTranslation('name', 'en') }}" type="text" placeholder="Enter author Name"
                            fgroup-class="col-md-6" />

                        <x-adminlte-input name="name[ar]" label="{{ __('author.name_author_ar') }}"
                            value="{{ $author->getTranslation('name', 'ar') }}" type="text"
                            placeholder="Enter author Name" fgroup-class="col-md-6" />
                    </div>
                </div>
            </div>

            <div class="card-footer">
                <x-adminlte-button type="submit" theme="primary" label="{{ __('author.update') }}" />
            </div>
        </form>
    </div>
@stop
