@extends('dashboard.layout')

@section('title', 'Edit Area')

@section('content_header')
<h1 class="card-header">{{ __('area.area_edit') }}</h1>
@stop

@section('content')
<div class="card card-primary">
    <form action="{{ route('dashboard.areas.update', $area->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="card-body col-12">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <x-adminlte-input name="name[en]" value="{{ $area->getTranslation('name','en') }}"
                            label="{{ __('area.name_area_en') }}" type="text"
                            placeholder="{{ __('area.enter_area_name') }}" />
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <x-adminlte-input name="name[ar]" value="{{ $area->getTranslation('name','ar') }}"
                            label="{{ __('area.name_area_ar') }}" type="text"
                            placeholder="{{ __('area.enter_area_name') }}" />
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <x-adminlte-input name="fee" label="{{ __('area.fee') }}" value="{{ $area->fee }}" type="number"
                            placeholder="{{ __('area.enter_area_fee') }}" />
                    </div>
                </div>
            </div>
        </div>

        <div class="card-footer">
            <x-adminlte-button type="submit" theme="primary" label="{{ __('area.update') }}" />
        </div>
    </form>
</div>
@stop