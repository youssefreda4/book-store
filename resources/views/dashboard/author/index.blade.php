@extends('dashboard.layout')

@section('title', 'Dashboard')

@section('content_header')
    <x-header :title="__('author.all_authors')">
        <x-slot:actions>
            <a href="{{ route('dashboard.authors.create') }}" class="btn btn-success">
                <i class="fas fa-plus me-2"></i> <span>{{ __('author.create') }}</span>
            </a>
        </x-slot:actions>
    </x-header>
    
    @include('dashboard.author.partials.filter')
@stop

@section('content')
    <div class="mb-3">
        <x-delete-selected model="Author"></x-delete-selected>
    </div>
    <div class="card">
        <table class="table table-bordered ">
            <thead>
                <tr>
                    <th class="text-center"><input type="checkbox" id="select-all"></th>
                    <th class="text-center">{{ __('author.id') }}</th>
                    <th class="text-center">{{ __('author.name') }}</th>
                    <th class="text-center">{{ __('author.created_at') }}</th>
                    <th class="text-center">{{ __('author.updated_at') }}</th>
                    <th class="text-center">{{ __('author.actions') }}</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $locale = session()->get('locale');
                @endphp
                @foreach ($authors as $author)
                    <tr>
                        <td class="text-center "><input class="row-checkbox" type="checkbox" value="{{ $author->id }}">
                        <th class="text-center">
                            {{ $locale == 'ar' ? Numbers::ShowInArabicDigits($author->id) : $author->id }}</th>
                        <td class="text-center">{{ $author->name }}</td>
                        <td class="text-center">
                            {{ $locale == 'ar' ? Numbers::ShowInArabicDigits($author->created_at) : $author->created_at }}
                        </td>
                        <td class="text-center">
                            {{ $locale == 'ar' ? Numbers::ShowInArabicDigits($author->updated_at) : $author->updated_at }}
                        </td>
                        <td class="text-center">
                            <x-crud-action-button route="authors" model="{{ $author->id }}"></x-crud-action-button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div>
        {{ $authors->links() }}
    </div>
@stop
