@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <div class="card-header d-flex justify-content-between align-items-center">
        <h3 class="col">All Author</h3>
        <a href="{{ route('dashboard.authors.create') }}" class="btn btn-success ">
            <i class="fas fa-plus"></i> <span class="ml-2">Create</span>
        </a>
    </div>
    @include('dashboard.author.partials.filter')
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
                        <th class="text-center">Name</th>
                        <th class="text-center">Create At</th>
                        <th class="text-center">Updated At</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($authors as $author)
                        <tr>
                            <th class="text-center">{{ $author->id }}</th>
                            <td class="text-center">{{ $author->name }}</td>
                            <td class="text-center">{{ $author->created_at }}</td>
                            <td class="text-center">{{ $author->updated_at }}</td>
                            <td class="text-center">

                                <div class="d-flex justify-content-between ">

                                    <a href="{{ route('dashboard.authors.edit', $author->id) }}"
                                        class="btn btn-warning">
                                        <i class="fas fa-edit"></i>
                                    </a>

                                    <a href="{{ route('dashboard.authors.show', $author->id) }}" class="btn btn-info">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <form action="{{ route('dashboard.authors.destroy', $author->id) }}"
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
            {{ $authors->links() }}
        </div>
    </div>
@stop
