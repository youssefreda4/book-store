@extends('dashboard.layout')

@section('title', 'Dashboard')

@section('content_header')
    <x-header :title="__('publisher.all_publisher')">
        @can('super-admin')
            <x-slot:actions>
                <a href="{{ route('dashboard.publishers.create') }}" class="btn btn-success">
                    <i class="fas fa-plus me-2"></i> <span>{{ __('publisher.create') }}</span>
                </a>
            </x-slot:actions>
        @endcan
    </x-header>

    @include('dashboard.publisher.partials.filter')
@stop

@section('content')
    @can('super-admin')
        <div class="mb-3">
            <x-delete-selected model="Publisher"></x-delete-selected>

            <x-import-excel model="Publisher"></x-import-excel>

            <x-export-excel model="Publisher"></x-export-excel>
        </div>
    @endcan
    <div class="card">
        <table class="table table-bordered ">
            <thead>
                <tr>
                    @can('super-admin')
                        <th class="text-center"><input type="checkbox" id="select-all"></th>
                    @endcan
                    <th class="text-center">{{ __('publisher.id') }}</th>
                    <th class="text-center">{{ __('publisher.name') }}</th>
                    <th class="text-center">{{ __('publisher.create_at') }}</th>
                    <th class="text-center">{{ __('publisher.updated_at') }}</th>
                    @can('super-admin')
                        <th class="text-center">{{ __('publisher.actions') }}</th>
                    @endcan
                </tr>
            </thead>
            <tbody>
                @php
                    $locale = session()->get('locale');
                @endphp
                @foreach ($publishers as $publisher)
                    <tr>
                        @can('super-admin')
                            <td class="text-center "><input class="row-checkbox" type="checkbox" value="{{ $publisher->id }}">
                            @endcan
                        <th class="text-center">
                            {{ $locale == 'ar' ? Numbers::ShowInArabicDigits($publisher->id) : $publisher->id }}</th>
                        <td class="text-center">{{ $publisher->name }}</td>
                        <td class="text-center">
                            {{ $locale == 'ar' ? Numbers::ShowInArabicDigits($publisher->created_at) : $publisher->created_at }}
                        </td>
                        <td class="text-center">
                            {{ $locale == 'ar' ? Numbers::ShowInArabicDigits($publisher->updated_at) : $publisher->updated_at }}
                        </td>
                        @can('super-admin')
                            <td class="text-center">
                                <x-crud-action-button route="publishers" model="{{ $publisher->id }}"></x-crud-action-button>
                            </td>
                        @endcan
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div>
        {{ $publishers->links() }}
    </div>
@stop
