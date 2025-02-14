@extends('dashboard.layout')

@section('title', 'Dashboard')

@section('content_header')
    <x-header :title="__('book.all_books')">
        <x-slot:actions>
            <a href="{{ route('dashboard.books.create') }}" class="btn btn-success">
                <i class="fas fa-plus me-2"></i> <span>{{ __('book.create') }}</span>
            </a>
        </x-slot:actions>
    </x-header>

    @include('dashboard.book.partials.filter')
@stop

@section('content')
    <div class="mb-3">
        <x-delete-selected model="Book"></x-delete-selected>

        <x-import-excel model="Book"></x-import-excel>

        <x-export-excel model="Book"></x-export-excel>
    </div>

    <div class="card">
        <table class="table table-bordered ">
            <thead>
                <tr>
                    <th class="text-center"><input type="checkbox" id="select-all"></th>
                    <th class="text-center">{{ __('book.id') }}</th>
                    <th class="text-center">{{ __('book.name') }}</th>
                    <th class="text-center">{{ __('book.description') }}</th>
                    <th class="text-center">{{ __('book.quantity') }}</th>
                    <th class="text-center">{{ __('book.rate') }}</th>
                    <th class="text-center">{{ __('book.publish_year') }}</th>
                    <th class="text-center">{{ __('book.price') }}</th>
                    <th class="text-center">{{ __('book.is_available') }}</th>
                    <th class="text-center">{{ __('book.category') }}</th>
                    <th class="text-center">{{ __('book.publisher') }}</th>
                    <th class="text-center">{{ __('book.author') }}</th>
                    <th class="text-center">{{ __('book.created_at') }}</th>
                    <th class="text-center">{{ __('book.updated_at') }}</th>
                    <th class="text-center">{{ __('book.actions') }}</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $locale = session()->get('locale');
                @endphp
                @foreach ($books as $book)
                    <tr>
                        <td class="text-center "><input class="row-checkbox" type="checkbox" value="{{ $book->id }}">
                        <th class="text-center">
                            {{ $locale == 'ar' ? Numbers::ShowInArabicDigits($book->id) : $book->id }}</th>
                        <td class="text-center">{{ $book->name }}</td>
                        <td class="text-center">{{ $book->description }}</td>
                        <td class="text-center">
                            {{ $locale == 'ar' ? Numbers::ShowInArabicDigits($book->quantity) : $book->quantity }}</td>
                        <td class="text-center">
                            {{ $locale == 'ar' ? Numbers::ShowInArabicDigits($book->rate) : $book->rate }}</td>
                        <td class="text-center">
                            {{ $locale == 'ar' ? Numbers::ShowInArabicDigits($book->publish_year) : $book->publish_year }}
                        </td>
                        <td class="text-center">
                            {{ $locale == 'ar' ? Numbers::ShowInArabicDigits($book->price) : $book->price }} EGP</td>
                        <td class="text-center">{!! $book->isAvailable() !!}</td>
                        <td class="text-center">{{ $book->category->name }}</td>
                        <td class="text-center">{{ $book->publisher->name }}</td>
                        <td class="text-center">{{ $book->author->name }}</td>

                        <td class="text-center">
                            {{ $locale == 'ar' ? Numbers::ShowInArabicDigits($book->created_at) : $book->created_at }}
                        </td>
                        <td class="text-center">
                            {{ $locale == 'ar' ? Numbers::ShowInArabicDigits($book->updated_at) : $book->updated_at }}
                        </td>
                        <td class="text-center">
                            <x-crud-action-button route="books" model="{{ $book->slug }}"></x-crud-action-button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div>
        {{ $books->links() }}
    </div>
@stop
