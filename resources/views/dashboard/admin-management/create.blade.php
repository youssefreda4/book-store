@extends('dashboard.layout')

@section('title', 'Dashboard')

@section('content_header')
    <h1 class="card-header">{{ __('admin.create_admin') }}</h1>
@stop

@section('content')
    <div class="card card-primary">
        <form action="{{ route('dashboard.admins.store') }}" method="POST">
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <div class="row">
                        <x-adminlte-input name="name" label="{{ __('admin.name') }}" type="text"
                            placeholder="{{ __('admin.enter_admin_name') }}" fgroup-class="col-md-6"
                            value="{{ old('name') }}" />

                        <x-adminlte-input name="email" label="{{ __('admin.email') }}" type="email"
                            placeholder="{{ __('admin.enter_admin_email') }}" fgroup-class="col-md-6"
                            value="{{ old('email') }}" />
                    </div>

                    <div class="row">
                        <x-adminlte-input name="password" label="{{ __('admin.password') }}" type="password"
                            placeholder="{{ __('admin.enter_admin_password') }}" fgroup-class="col-md-6" />

                        <x-adminlte-input name="password_confirmation" label="{{ __('admin.password_confirmation') }}"
                            type="password" placeholder="{{ __('admin.enter_admin_password_confirmation') }}"
                            fgroup-class="col-md-6" />
                    </div>
                    <div class="row">
                        <label>{{ __('admin.admin_type') }}</label>
                        <select name="type" class="form-control">
                            <option value="">{{ __('admin.select_admin_type') }}</option>
                            <option value="super-admin">{{ __('admin.super_admin') }}</option>
                            <option value="content-management">{{ __('admin.content_management') }}</option>
                        </select>
                        <x-error-input name="type"></x-error-input>
                    </div>
                </div>
            </div>

            <div class="card-footer">
                <x-adminlte-button type="submit" theme="primary" label="{{ __('admin.create') }}" />
            </div>
        </form>
    </div>
@stop
