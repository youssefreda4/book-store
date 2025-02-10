@extends('adminlte::page')


@section('css')
    @if (App::getLocale() === 'ar')
        <link rel="stylesheet" href="{{ asset('css/rtl.css') }}">
    @endif
    <link href="https://unpkg.com/filepond/dist/filepond.css" rel="stylesheet" />
    <link href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css" rel="stylesheet" />

    {{-- <style>
        .custom-form {
            box-shadow: rgba(83, 158, 214, 0.15) 0px 2px 10px 0px;
            padding: 20px ;
            border-radius: 8px;
            background-color: #fff;
        }
        .content-header {
            padding-bottom: 5px;
        }
        .bread-crumb {
            font-size: 16px;
        }
    </style> --}}
@stop

@push('js')
    <script src="https://unpkg.com/filepond/dist/filepond.js"></script>
    <script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.js"></script>
    <script src="https://unpkg.com/filepond-plugin-file-validate-type/dist/filepond-plugin-file-validate-type.js"></script>
    {{-- <script>
        const checkCodeUrl = "{{route('discount.check.code')}}" ;
    </script> --}}
    <script src="{{ asset('js/main.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        @if (session('success'))
            Swal.fire({
                icon: 'success',
                title: '{{  __("adminlte::adminlte.success") }}',
                text: "{{ session('success') }}",
                timer: 3000,
                showConfirmButton: false
            });
        @endif
        @if (session('error'))
            Swal.fire({
                icon: 'error',
                title: '{{ __("adminlte::adminlte.success") }}',
                text: "{{ session('error') }}",
                timer: 3000,
                showConfirmButton: false
            });
        @endif
    </script>
@endpush
