@extends('dashboard.layout')

@section('title', 'Dashboard')

@section('content_header')
    <h1 class="card-header">{{ __('publisher.publisher_name') }} : {{ $publisher->name }}</h1>
@stop

@section('content')
    <div class="card col-12">
        <div class="card-body">
            <table class="table table-bordered">
                @php
                    $locale = session()->get('locale');
                @endphp
                <thead>
                    <tr>
                        <th class="text-center">{{ __('publisher.id') }}</th>
                        <th class="text-center">{{ __('publisher.name') }}</th>
                        <th class="text-center">{{ __('publisher.create_at') }}</th>
                        <th class="text-center">{{ __('publisher.updated_at') }}</th>
                        <th class="text-center">{{ __('publisher.actions') }}</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th class="text-center">
                            {{ $locale == 'ar' ? Numbers::ShowInArabicDigits($publisher->id) : $publisher->id }}</th>
                        <td class="text-center">{{ $publisher->name }}</td>
                        <td class="text-center">
                            {{ $locale == 'ar' ? Numbers::ShowInArabicDigits($publisher->created_at) : $publisher->created_at }}
                        </td>
                        <td class="text-center">
                            {{ $locale == 'ar' ? Numbers::ShowInArabicDigits($publisher->updated_at) : $publisher->updated_at }}
                        </td>
                        <td class="text-center">
                            <div class="d-flex justify-content-between">

                                <a href="{{ route('dashboard.publishers.edit', $publisher->id) }}"
                                    class="btn btn-warning ">
                                    <i class="fas fa-edit"></i>
                                </a>

                                <form action="{{ route('dashboard.publishers.destroy', $publisher->id) }}" method="post">
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
