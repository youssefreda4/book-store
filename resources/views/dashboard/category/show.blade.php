@extends('dashboard.layout')

@section('title', 'Dashboard')

@section('content_header')
    <h1 class="card-header">{{ __('category.category_name') }} : {{ $category->name }}</h1>
@stop

@section('content')
    <div class="card col-12">
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th class="text-center">{{ __('category.id') }}</th>
                        <th class="text-center">{{ __('category.name') }}</th>
                        <th class="text-center">{{ __('category.discount_code') }}</th>
                        <th class="text-center">{{ __('category.create_at') }}</th>
                        <th class="text-center">{{ __('category.updated_at') }}</th>
                        <th class="text-center">{{ __('category.actions') }}</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th class="text-center">{{ $category->id }}</th>
                        <td class="text-center">{{ $category->name }}</td>
                        <td class="text-center">{{ $category->discount?->code }}</td>
                        <td class="text-center">{{ $category->created_at }}</td>
                        <td class="text-center">{{ $category->updated_at }}</td>
                        <td class="text-center">
                            <div class="d-flex justify-content-between">

                                <a href="{{ route('dashboard.categories.edit', $category->id) }}" class="btn btn-warning ">
                                    <i class="fas fa-edit"></i>
                                </a>

                                <form action="{{ route('dashboard.categories.destroy', $category->id) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <x-adminlte-button type="submit" theme="danger" icon="fas fa-trash-alt" />
                                </form>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="mb-3 mt-3">
                <label class="form-label ml-2">{{ __('category.discount') }}:</label>

                <form action="{{ route('dashboard.categories.add.discount', $category->id) }}" method="POST">
                    @csrf

                    <select id="discount-select2" class="col-md-6 js-states form-control" name="discount_id">
                        <option></option>
                    </select>

                    <x-adminlte-button type="submit" theme="primary" label="{{ __('category.add') }}" class=" ml-3 " />
                </form>
            </div>
        </div>
    </div>
@stop

@push('js')
    <script>
        $('#discount-select2').select2({
             //minimumInputLength: 1,
            placeholder: "{{ __('category.select_discount') }}",
            allowClear: true,
            ajax: {
                url: "{{ route('dashboard.discounts.search') }}",
                dataType: 'json',
                processResults: function(data) {
                    return {
                        results: data.data.discounts.map(discount => ({
                            id: discount.id,
                            text: discount.code + ' - ' + discount.precentage + '%',
                        }))
                    }
                }
            }
        });
    </script>
@endpush
