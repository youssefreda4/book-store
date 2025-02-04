@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1 class="card-header">Publisher Name : {{ $publisher->name }}</h1>
@stop

@section('content')
    <div class="card col-12">
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th class="text-center">Id</th>
                        <th class="text-center">Name</th>
                        <th class="text-center">Create At</th>
                        <th class="text-center">Updated At</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th class="text-center">{{ $publisher->id }}</th>
                        <td class="text-center">{{ $publisher->name }}</td>
                        <td class="text-center">{{ $publisher->created_at }}</td>
                        <td class="text-center">{{ $publisher->updated_at }}</td>
                        <td class="text-center">
                            <div class="d-flex justify-content-between">

                                <a href="{{ route('dashboard.publishers.edit', $publisher->id) }}" class="btn btn-warning ">
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
