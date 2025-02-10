@extends('dashboard.layout')

@section('title', 'Dashboard')

@section('content_header')
    <h1 class="card-header">{{ __('flashsale.flash_sale_name') }} : {{ $flash_sale->name }}</h1>
@stop

@section('content')
    <div class="card col-12">
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th class="text-center">{{ __('flashsale.id') }}</th>
                        <th class="text-center">{{ __('flashsale.name') }}</th>
                        <th class="text-center">{{ __('flashsale.description') }}</th>
                        <th class="text-center">{{ __('flashsale.date') }}</th>
                        <th class="text-center">{{ __('flashsale.time') }}</th>
                        <th class="text-center">{{ __('flashsale.create_at') }}</th>
                        <th class="text-center">{{ __('flashsale.updated_at') }}</th>
                        <th class="text-center">{{ __('flashsale.actions') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $locale = session()->get('locale');
                    @endphp
                    <tr>
                        <th class="text-center">
                            {{ $locale == 'ar' ? Numbers::ShowInArabicDigits($flash_sale->id) : $flash_sale->id }}</th>
                        <td class="text-center">{{ $flash_sale->name }}</td>
                        <td class="text-center">{{ $flash_sale->description }}</td>
                        <td class="text-center">{{ $flash_sale->date }}</td>
                        <td class="text-center">{{ $flash_sale->time }}</td>
                        <td class="text-center">
                            {{ $locale == 'ar' ? Numbers::ShowInArabicDigits($flash_sale->created_at) : $flash_sale->created_at }}
                        </td>
                        <td class="text-center">
                            {{ $locale == 'ar' ? Numbers::ShowInArabicDigits($flash_sale->updated_at) : $flash_sale->updated_at }}
                        </td>
                        <td class="text-center">
                            <div class="d-flex justify-content-between">

                                <a href="{{ route('dashboard.flashsales.edit', $flash_sale->id) }}"
                                    class="btn btn-warning ">
                                    <i class="fas fa-edit"></i>
                                </a>

                                <form action="{{ route('dashboard.flashsales.destroy', $flash_sale->id) }}" method="post">
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
