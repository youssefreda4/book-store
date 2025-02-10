@extends('dashboard.layout')

@section('title', 'Dashboard')

@section('content_header')
    <h1 class="card-header">{{ __('publisher.publisher_edit') }}</h1>
@stop

@section('content')
    <div class="card card-primary">
        <form action="{{ route('dashboard.publishers.update', $publisher->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="card-body">
                <div class="form-group">
                    <div class="row">
                        <x-adminlte-input name="name[en]" label="{{ __('publisher.name_publisher_en') }}" value="{{ $publisher->getTranslation('name','en') }}" type="text"
                            placeholder="{{ __('publisher.enter_publisher_name') }}" fgroup-class="col-md-6" />

                        <x-adminlte-input name="name[ar]" label="{{ __('publisher.name_publisher_ar') }}" value="{{ $publisher->getTranslation('name','ar') }}" type="text"
                            placeholder="{{ __('publisher.enter_publisher_name') }}" fgroup-class="col-md-6" />
                    </div>
                </div>
            </div>

            <div class="card-footer">
                <x-adminlte-button type="submit" theme="primary" label="{{ __('publisher.update') }}" />  
            </div>
        </form>
    </div>
@stop
