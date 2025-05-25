@extends('website.layouts.main')

@section('title', __('website/orders.title'))

@push('css')
<link rel="stylesheet" href="{{ asset('front-assets')}}/css/orders.css" />
@endpush

@section('content')
<main>
    <section>
        <div class="container py-4">
            <ul class="nav nav-pills gap-3 justify-content-center mb-4" id="pills-tab" role="tablist">
                <ul class="nav nav-pills gap-3 justify-content-center mb-4" id="pills-tab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a href="{{ route('front.order.index', ['status' => 'all']) }}"
                            class="nav-link nav-order {{ request()->status === 'all' ? 'active' : '' }}">
                            {{ __('website/orders.tabs.all') }}
                        </a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a href="{{ route('front.order.index', ['status' => 'in_progress']) }}"
                            class="nav-link nav-order {{ request()->status === 'in_progress' ? 'active' : '' }}">
                            {{ __('website/orders.tabs.in_progress') }}
                        </a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a href="{{ route('front.order.index', ['status' => 'completed']) }}"
                            class="nav-link nav-order {{ request()->status === 'completed' ? 'active' : '' }}">
                            {{ __('website/orders.tabs.completed') }}
                        </a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a href="{{ route('front.order.index', ['status' => 'delivered']) }}"
                            class="nav-link nav-order {{ request()->status === 'delivered' ? 'active' : '' }}">
                            {{ __('website/orders.tabs.delivered') }}
                        </a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a href="{{ route('front.order.index', ['status' => 'cancelled']) }}"
                            class="nav-link nav-order {{ request()->status === 'cancelled' ? 'active' : '' }}">
                            {{ __('website/orders.tabs.canceled') }}
                        </a>
                    </li>
                </ul>

            </ul>

            <div class="tab-content" id="pills-tabContent">
                {{-- Orders --}}
                <div class="tab-pane fade show active" id="pills-all" role="tabpanel" aria-labelledby="pills-all-tab">
                    <div class="row g-4">
                        @forelse ($orders as $order)
                        @include('website.pages.order.partials.order_card', ['order' => $order])
                        @empty
                        <section class="my-5 d-flex justify-content-center align-items-center"
                            style="min-height: 50vh;">
                            <div class="container">
                                <div class="col-12">
                                    <h1 class="text-center text-danger fw-bold display-4">
                                        {{ __('website/orders.no_order') }}
                                    </h1>
                                </div>
                            </div>
                        </section>
                        @endforelse
                    </div>
                    <div class="mt-4">
                        {{ $orders->links('pagination::bootstrap-5') }}
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
@endsection