@extends('dashboard.layout')

@section('title', 'Dashboard')

@section('content_header')
    <h1 class="card-header">{{ __('flashsale.flash_sale_edit') }}</h1>
@stop

@section('content')

    <div class="card card-primary">
        <form action="{{ route('dashboard.flashsales.update', $flash_sale->id) }}" method="POST">
            @method('PUT')
            @csrf
            <div class="card-body col-12">
                <div class="row">
                    <x-adminlte-input name="name[en]" label="{{ __('flashsale.name_flash_sale_en') }}" type="text"
                        placeholder="{{ __('flashsale.enter_flash_sale_name') }}"
                        value="{{ $flash_sale->getTranslation('name', 'en') }}" fgroup-class="col-md-6" />

                    <x-adminlte-input name="name[ar]" label="{{ __('flashsale.name_flash_sale_ar') }}" type="text"
                        placeholder="{{ __('flashsale.enter_flash_sale_name') }}"
                        value="{{ $flash_sale->getTranslation('name', 'ar') }}" fgroup-class="col-md-6" />
                </div>

                <div class="row">

                    <x-adminlte-textarea name="description[en]" label="{{ __('flashsale.description_flash_sale_en') }}"
                        placeholder="{{ __('flashsale.enter_flash_sale_description') }}" fgroup-class="col-md-6">
                        {{ $flash_sale->getTranslation('description', 'en') }}
                    </x-adminlte-textarea>

                    <x-adminlte-textarea name="description[ar]" label="{{ __('flashsale.description_flash_sale_ar') }}"
                        placeholder="{{ __('flashsale.enter_flash_sale_description') }}" fgroup-class="col-md-6">
                        {{ $flash_sale->getTranslation('description', 'ar') }}
                    </x-adminlte-textarea>

                </div>

                <div class="row">
                    <x-adminlte-input name="date" label="{{ __('flashsale.label_date') }}" type="date"
                        fgroup-class="col-md-6" value="{{ $flash_sale->date }}" />

                    <x-adminlte-input name="time" label="{{ __('flashsale.label_time') }}" type="number"
                        placeholder="{{ __('flashsale.time_placeholder') }}" value="{{ $flash_sale->time }}"
                        fgroup-class="col-md-6" />
                </div>

                <div class="row">
                    <x-adminlte-select name="is_active" label="{{ __('flashsale.is_active') }}" fgroup-class="col-12">
                        <option value="1" {{ $flash_sale->is_active === 1 ? 'selected' : '' }}>
                            {{ __('flashsale.active_dropdown') }}</option>
                        <option value="0" {{ $flash_sale->is_active === 0 ? 'selected' : '' }}>
                            {{ __('flashsale.inactive_dropdown') }}</option>
                    </x-adminlte-select>
                </div>
            </div>

            <div class="card-footer">
                <x-adminlte-button type="submit" theme="primary" label="{{ __('flashsale.update') }}" />
            </div>
        </form>
    </div>
@stop
