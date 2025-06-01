@extends('dashboard.layout')

@section('title', 'Dashboard')

@section('content_header')
<x-header :title="__('message.all_messages')" />
@stop

@section('content')
@can('super-admin')
<div class="mb-3">
    <x-import-excel model="ContactUs"></x-import-excel>

    <x-export-excel model="ContactUs"></x-export-excel>
</div>
@endcan
<div class="card">
    <table class="table table-bordered ">
        <thead>
            <tr>
                <th class="text-center">{{ __('message.id') }}</th>
                <th class="text-center">{{ __('message.name') }}</th>
                <th class="text-center">{{ __('message.email') }}</th>
                <th class="text-center">{{ __('message.message') }}</th>
                <th class="text-center">{{ __('message.create_at') }}</th>
            </tr>
        </thead>
        <tbody>
            @php
            $locale = session()->get('locale');
            @endphp
            @foreach ($messages as $message)
            <tr>
                <td class="text-center">
                    {{ $locale == 'ar' ? Numbers::ShowInArabicDigits($message->id) : $message->id }}</td>
                <td class="text-center">{{ $message->name }}</td>
                <td class="text-center">{{ $message->email }}</td>
                <td class="text-center">{{ $message->name }}</td>

                <td class="text-center">
                    {{ $locale == 'ar' ? Numbers::ShowInArabicDigits($message->created_at) : $message->created_at }}
                </td>

            </tr>
            @endforeach
        </tbody>
    </table>
</div>
<div>
    {{ $messages->links() }}
</div>
@stop