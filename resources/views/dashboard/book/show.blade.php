@extends('dashboard.layout')

@section('title', 'Dashboard')

@section('content_header')
    <h1 class="card-header">{{ __('book.book_name') }} : {{ $book->name }}</h1>

@stop

@section('content')
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
            </tbody>
        </table>
        <div class="m-3">
            <h3>{{ __('adminlte::adminlte.image') }}</h3>
            @if ($book->getFirstMediaUrl('book', 'preview'))
                <img src="{{ $book->getFirstMediaUrl('book', 'preview') }}" alt="Thumbnail"
                    style=" height: 200px; object-fit: contain; " class="rounded">
            @else
                <span class="badge bg-danger rounded">{{ __('adminlte::adminlte.no_image') }}</span>
            @endif
        </div>
    </div>
@stop
