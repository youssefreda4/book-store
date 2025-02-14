@extends('dashboard.layout')

@section('title', 'Dashboard')

@section('content_header')
    <x-header :title="__('author.all_authors')">
        @can('super-admin')
            <x-slot:actions>
                <a href="{{ route('dashboard.authors.create') }}" class="btn btn-success">
                    <i class="fas fa-plus me-2"></i> <span>{{ __('author.create') }}</span>
                </a>
            </x-slot:actions>
        @endcan
    </x-header>

    @include('dashboard.author.partials.filter')
@stop

@section('content')
    @can('super-admin')
        <div class="mb-3">
            <x-delete-selected model="Author"></x-delete-selected>

            <x-import-excel model="Author"></x-import-excel>

            <x-export-excel model="Author"></x-export-excel>
        </div>
    @endcan
    <div class="card">
        <table class="table table-bordered ">
            <thead>
                <tr>
                    @can('super-admin')
                        <th class="text-center"><input type="checkbox" id="select-all"></th>
                    @endcan
                    <th class="text-center">{{ __('author.id') }}</th>
                    <th class="text-center">{{ __('author.name') }}</th>
                    <th class="text-center">{{ __('author.created_at') }}</th>
                    <th class="text-center">{{ __('author.updated_at') }}</th>
                    @can('super-admin')
                        <th class="text-center">{{ __('author.actions') }}</th>
                    @endcan
                </tr>
            </thead>
            <tbody>
                @php
                    $locale = session()->get('locale');
                @endphp
                @foreach ($authors as $author)
                    <tr>
                        @can('super-admin')
                            <td class="text-center "><input class="row-checkbox" type="checkbox" value="{{ $author->id }}">
                            @endcan
                        <th class="text-center">
                            {{ $locale == 'ar' ? Numbers::ShowInArabicDigits($author->id) : $author->id }}</th>
                        <td class="text-center">{{ $author->name }}</td>
                        <td class="text-center">
                            {{ $locale == 'ar' ? Numbers::ShowInArabicDigits($author->created_at) : $author->created_at }}
                        </td>
                        <td class="text-center">
                            {{ $locale == 'ar' ? Numbers::ShowInArabicDigits($author->updated_at) : $author->updated_at }}
                        </td>

                        @can('super-admin')
                            <td class="text-center">
                                <x-crud-action-button route="authors" model="{{ $author->id }}"></x-crud-action-button>
                            </td>
                        @endcan
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div>
        {{ $authors->links() }}
    </div>
@stop
