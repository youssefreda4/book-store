@extends('website.layouts.main')
@push('css')
<link rel="stylesheet" href="{{ asset('front-assets') }}/css/cart.css" />
<meta name="csrf-token" content="{{ csrf_token() }}">
@endpush
@section('title', 'Cart')

@section('content')
    @livewire('cart-page-component',[
        'books'=> $books,
        'cartItems'=> $cartItems,
    ])
@endsection