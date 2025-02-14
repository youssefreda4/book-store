@extends('dashboard.layout')

@section('title', 'Dashboard')

@section('content_header')
    <x-header :title="__('category.all_categories')">
        @can('super-admin')
            <x-slot:actions>
                <a href="{{ route('dashboard.categories.create') }}" class="btn btn-success">
                    <i class="fas fa-plus me-2"></i> <span>{{ __('category.create') }}</span>
                </a>
            </x-slot:actions>
        @endcan
    </x-header>

    @include('dashboard.category.partials.filter')
@stop

@section('content')
    @can('super-admin')
        <div class="mb-3">
            <x-delete-selected model="Category"></x-delete-selected>

            <x-import-excel model="Category"></x-import-excel>

            <x-export-excel model="Category"></x-export-excel>
        </div>
    @endcan
    <div class="card">
        <table class="table table-bordered ">
            <thead>
                <tr>
                    @can('super-admin')
                        <th class="text-center"><input type="checkbox" id="select-all"></th>
                    @endcan
                    <th class="text-center">{{ __('category.id') }}</th>
                    <th class="text-center">{{ __('category.name') }}</th>
                    <th class="text-center">{{ __('category.discount_code') }}</th>
                    <th class="text-center">{{ __('category.image') }}</th>
                    <th class="text-center">{{ __('category.create_at') }}</th>
                    <th class="text-center">{{ __('category.updated_at') }}</th>
                    @can('super-admin')
                        <th class="text-center">{{ __('category.actions') }}</th>
                    @endcan
                </tr>
            </thead>
            <tbody>
                @php
                    $locale = session()->get('locale');
                @endphp
                @foreach ($categories as $category)
                    <tr>
                        @can('super-admin')
                            <td class="text-center "><input class="row-checkbox" type="checkbox" value="{{ $category->id }}">
                            </td>
                        @endcan
                        <td class="text-center">
                            {{ $locale == 'ar' ? Numbers::ShowInArabicDigits($category->id) : $category->id }}</td>
                        <td class="text-center">{{ $category->name }}</td>
                        <td class="text-center">
                            {!! $category->discount->code ??
                                '<span class="badge bg-danger rounded">' . __('adminlte::adminlte.no_discount') . '</span>' !!}</td>

                        <td class="text-center">
                            @if ($category->getFirstMediaUrl('image', 'preview'))
                                <img src="{{ $category->getFirstMediaUrl('image', 'preview') }}" alt="Thumbnail"
                                    style="width: 200px; height: 100px; object-fit: contain;">
                            @else
                                <span class="badge bg-danger rounded">{{ __('adminlte::adminlte.no_image') }}</span>
                            @endif
                        </td>
                        <td class="text-center">
                            {{ $locale == 'ar' ? Numbers::ShowInArabicDigits($category->created_at) : $category->created_at }}
                        </td>
                        <td class="text-center">
                            {{ $locale == 'ar' ? Numbers::ShowInArabicDigits($category->updated_at) : $category->updated_at }}
                        </td>
                        @can('super-admin')
                            <td class="text-center">
                                <x-crud-action-button route="categories" model="{{ $category->id }}"></x-crud-action-button>
                            </td>
                        @endcan
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div>
        {{ $categories->links() }}
    </div>
@stop
