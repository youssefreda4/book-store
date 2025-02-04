@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <div class="card-header d-flex justify-content-between align-items-center">
        <h3 class="col">All Discounts</h3>
        <a href="{{ route('dashboard.discounts.create') }}" class="btn btn-primary ">
            <i class="fas fa-plus"></i> <span class="ml-2">Create</span>
        </a>
    </div>
@stop

@section('content')

    @if (session()->get('success') !== null)
        <x-adminlte-alert theme="success" title="Success">
            {{ session()->get('success') }}
        </x-adminlte-alert>
    @endif

    <div class="card col-12">
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th class="text-center">Id</th>
                        <th class="text-center">Code</th>
                        <th class="text-center">Quantity</th>
                        <th class="text-center">Precentage</th>
                        <th class="text-center">Expiry Date</th>
                        <th class="text-center">Create At</th>
                        <th class="text-center">Updated At</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($discounts as $discount)
                        <tr>
                            <th class="text-center">{{ $discount->id }}</th>
                            <td class="text-center">{{ $discount->code }}</td>
                            <td class="text-center">{{ $discount->quantity }}</td>
                            <td class="text-center">{{ $discount->precentage }}</td>
                            <td class="text-center">{{ $discount->expiry_date }}</td>
                            <td class="text-center">{{ $discount->created_at }}</td>
                            <td class="text-center">{{ $discount->updated_at }}</td>
                            <td class="text-center">

                                <div class="d-flex justify-content-between ">

                                    <a href="{{ route('dashboard.discounts.edit', $discount->id) }}"
                                        class="btn btn-warning">
                                        <i class="fas fa-edit"></i>
                                    </a>

                                    <a href="{{ route('dashboard.discounts.show', $discount->id) }}" class="btn btn-info">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <form action="{{ route('dashboard.discounts.destroy', $discount->id) }}"
                                        method="post">
                                        @csrf
                                        @method('DELETE')
                                        <x-adminlte-button type="submit" theme="danger" icon="fas fa-trash-alt" />
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer clearfix">
            {{ $discounts->links() }}
        </div>
    </div>
@stop
