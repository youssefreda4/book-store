@extends('dashboard.layout')

@section('title', 'Dashboard')

@section('content_header')
    <h1 class="card-header">{{ __('category.category_edit') }}</h1>
@stop

@section('content')
    <div class="card card-primary">
        <form action="{{ route('dashboard.categories.update', $category->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="card-body col-12">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <x-adminlte-input name="name[en]" value="{{ $category->getTranslation('name','en') }}"  label="{{ __('category.name_category_en') }}" type="text"
                                placeholder="{{ __('category.enter_category_name') }}" />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <x-adminlte-input name="name[ar]" value="{{ $category->getTranslation('name','ar') }}" label="{{ __('category.name_category_ar') }}" type="text"
                                placeholder="{{ __('category.enter_category_name') }}" />
                        </div>
                    </div>
                    <div class="col-12">
                        <x-image-preview name='image' value="{{$category->getFirstMediaUrl('image')}}"/>

                    </div>
                </div>
            </div>

            <div class="card-footer">
                <x-adminlte-button type="submit" theme="primary" label="{{ __('category.update') }}" />
            </div>
        </form>
    </div>
@stop
