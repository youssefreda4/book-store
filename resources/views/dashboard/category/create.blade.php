@extends('dashboard.layout')

@section('title', 'Dashboard')

@section('content_header')
    <h1 class="card-header">{{ __('category.create_category') }}</h1>
@stop

@section('content')
    <div class="card card-primary">
        <form action="{{ route('dashboard.categories.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card-body col-12">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <x-adminlte-input name="name[en]" label="{{ __('category.name_category_en') }}" type="text"
                                    placeholder="{{ __('category.enter_category_name') }}"  />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <x-adminlte-input name="name[ar]" label="{{ __('category.name_category_ar') }}" type="text"
                                    placeholder="{{ __('category.enter_category_name') }}"  />
                            </div>
                        </div>
                        <div class="col-12">
                            <x-image-preview name='image' />

                        </div>

                    </div>
            </div>

            <div class="card-footer">
                <x-adminlte-button type="submit" theme="primary" label="{{ __('category.create') }}" />
            </div>
        </form>
    </div>
@stop
