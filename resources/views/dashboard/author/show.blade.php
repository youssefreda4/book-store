@extends('dashboard.layout')

@section('title', 'Dashboard')

@section('content_header')
    <h1 class="card-header">Author Name : {{ $author->name }}</h1>
@stop

@section('content')
    <div class="card col-12">
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    @php
                        $locale = session()->get('locale');
                    @endphp
                    <tr>
                        <th class="text-center">{{ __('author.id') }}</th>
                        <th class="text-center">{{ __('author.name') }}</th>
                        <th class="text-center">{{ __('author.created_at') }}</th>
                        <th class="text-center">{{ __('author.updated_at') }}</th>
                        <th class="text-center">{{ __('author.actions') }}</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
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
                            <div class="d-flex justify-content-between">

                                <a href="{{ route('dashboard.authors.edit', $author->id) }}" class="btn btn-warning ">
                                    <i class="fas fa-edit"></i>
                                </a>

                                <form action="{{ route('dashboard.authors.destroy', $author->id) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <x-adminlte-button type="submit" theme="danger" icon="fas fa-trash-alt" />
                                </form>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@stop
