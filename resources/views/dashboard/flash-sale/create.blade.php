@extends('dashboard.layout')

@section('title', 'Dashboard')

@section('content_header')
    <h1 class="card-header">{{ __('flashsale.create_flash_sale') }}</h1>
@stop

@section('content')
    <div class="card card-primary">
        <form action="{{ route('dashboard.flashsales.store') }}" method="POST">
            @csrf
            <div class="card-body col-12">
                <div class="row">
                    <x-adminlte-input name="name[en]" label="{{ __('flashsale.name_flash_sale_en') }}" type="text"
                        placeholder="{{ __('flashsale.enter_flash_sale_name') }}" fgroup-class="col-md-6" />

                    <x-adminlte-input name="name[ar]" label="{{ __('flashsale.name_flash_sale_ar') }}" type="text"
                        placeholder="{{ __('flashsale.enter_flash_sale_name') }}" fgroup-class="col-md-6" />
                </div>

                <div class="row">

                    <x-adminlte-textarea name="description[en]" label="{{ __('flashsale.description_flash_sale_en') }}"
                        placeholder="{{ __('flashsale.enter_flash_sale_description') }}" fgroup-class="col-md-6" />

                    <x-adminlte-textarea name="description[ar]" label="{{ __('flashsale.description_flash_sale_ar') }}"
                        placeholder="{{ __('flashsale.enter_flash_sale_description') }}" fgroup-class="col-md-6" />

                </div>

                <div class="row">
                    <x-adminlte-input name="date" label="{{ __('flashsale.label_date') }}" type="date"
                        fgroup-class="col-md-6" value="{{ old('date') }}" />

                    <x-adminlte-input name="time" label="{{ __('flashsale.label_time') }}" type="number"
                        placeholder="{{ __('flashsale.time_placeholder') }}" fgroup-class="col-md-6"
                        value="{{ old('time') }}" />
                </div>

                <div class="row">
                    <x-adminlte-select name="is_active" label="{{ __('flashsale.is_active') }}" fgroup-class="col-12">
                        <option value="1" {{ old('time') === 1 ? 'selected' : '' }}>
                            {{ __('flashsale.active_dropdown') }}</option>
                        <option value="0" {{ old('time') === 0 ? 'selected' : '' }}>
                            {{ __('flashsale.inactive_dropdown') }}</option>
                    </x-adminlte-select>
                </div>
            </div>

            <div class="card-footer">
                <x-adminlte-button type="submit" theme="primary" label="{{ __('flashsale.create') }}" />
            </div>
        </form>
    </div>
@stop
