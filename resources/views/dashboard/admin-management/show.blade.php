@extends('dashboard.layout')

@section('title', 'Dashboard')

@section('content_header')
    <h1 class="card-header">{{ __('admin.admin_name') }} : {{ $admin->name }}</h1>
@stop

@section('content')
    <div class="card col-12">
        <div class="card-body">
            <table class="table table-bordered ">
                <thead>
                    <tr>
                        <th class="text-center">{{ __('admin.id') }}</th>
                        <th class="text-center">{{ __('admin.name') }}</th>
                        <th class="text-center">{{ __('admin.email') }}</th>
                        <th class="text-center">{{ __('admin.type') }}</th>
                        <th class="text-center">{{ __('admin.created_at') }}</th>
                        <th class="text-center">{{ __('admin.updated_at') }}</th>
                        <th class="text-center">{{ __('admin.actions') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $locale = session()->get('locale');
                    @endphp
                    <tr>
                        <th class="text-center">
                            {{ $locale == 'ar' ? Numbers::ShowInArabicDigits($admin->id) : $admin->id }}</th>
                        <td class="text-center">{{ $admin->name }}</td>
                        <td class="text-center">{{ $admin->email }}</td>
                        <td class="text-center">{{ $admin->type }}</td>
                        <td class="text-center">
                            {{ $locale == 'ar' ? Numbers::ShowInArabicDigits($admin->created_at) : $admin->created_at }}
                        </td>
                        <td class="text-center">
                            {{ $locale == 'ar' ? Numbers::ShowInArabicDigits($admin->updated_at) : $admin->updated_at }}
                        </td>
                        <td class="text-center">
                            <x-crud-action-button route="admins" model="{{ $admin->id }}"></x-crud-action-button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@stop
