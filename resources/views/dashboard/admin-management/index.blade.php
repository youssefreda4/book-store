@extends('dashboard.layout')

@section('title', 'Dashboard')

@section('content_header')
    <x-header :title="__('admin.all_admins')">
        @can('super-admin')
            <x-slot:actions>
                <a href="{{ route('dashboard.admins.create') }}" class="btn btn-success">
                    <i class="fas fa-plus me-2"></i> <span>{{ __('admin.create') }}</span>
                </a>
            </x-slot:actions>
        @endcan
    </x-header>

    @include('dashboard.admin-management.partials.filter')
@stop

@section('content')
    @can('super-admin')
        <div class="mb-3">
            <x-delete-selected model="Admin"></x-delete-selected>
        </div>
    @endcan
    <div class="card">
        <table class="table table-bordered ">
            <thead>
                <tr>
                    @can('super-admin')
                        <th class="text-center"><input type="checkbox" id="select-all"></th>
                    @endcan
                    <th class="text-center">{{ __('admin.id') }}</th>
                    <th class="text-center">{{ __('admin.name') }}</th>
                    <th class="text-center">{{ __('admin.email') }}</th>
                    <th class="text-center">{{ __('admin.type') }}</th>
                    <th class="text-center">{{ __('admin.created_at') }}</th>
                    <th class="text-center">{{ __('admin.updated_at') }}</th>
                    @can('super-admin')
                        <th class="text-center">{{ __('admin.actions') }}</th>
                    @endcan
                </tr>
            </thead>
            <tbody>
                @php
                    $locale = session()->get('locale');
                @endphp
                @foreach ($admins as $admin)
                    <tr>
                        @can('super-admin')
                            <td class="text-center "><input class="row-checkbox" type="checkbox" value="{{ $admin->id }}">
                            @endcan
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
                        @can('super-admin')
                            <td class="text-center">
                                <x-crud-action-button route="admins" model="{{ $admin->id }}"></x-crud-action-button>
                            </td>
                        @endcan
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div>
        {{ $admins->links() }}
    </div>
@stop
