@extends('dashboard.layout')

@section('title', 'Dashboard')

@section('content_header')
<h1 class="card-header">{{ __('area.create_area') }}</h1>
@stop

@section('content')
<div class="card card-primary">
    <form action="{{ route('dashboard.areas.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="card-body col-12">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <x-adminlte-input name="name[en]" label="{{ __('area.name_area_en') }}"
                            value="{{ old('name.en') }}" type="text" placeholder="{{ __('area.enter_area_name') }}" />
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <x-adminlte-input name="name[ar]" label="{{ __('area.name_area_ar') }}"
                            value="{{ old('name.ar') }}" type="text" placeholder="{{ __('area.enter_area_name') }}" />
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <x-adminlte-input name="fee" label="{{ __('area.fee') }}" value="{{ old('fee') }}" type="number"
                            placeholder="{{ __('area.enter_area_fee') }}" />
                    </div>
                </div>
            </div>
        </div>

        <div class="card-footer">
            <x-adminlte-button type="submit" theme="primary" label="{{ __('area.create') }}" />
        </div>
    </form>
</div>
@stop