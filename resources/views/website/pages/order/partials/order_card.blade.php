<div class="col-md-6">
    <div class="card order-card p-3">
        <div class="d-flex justify-content-between">
            <p class="mb-1 text-muted">{{ __('website/orders.order_no') }}</p>
            <p class="mb-1 fw-bold">{{ $order->number }}</p>
        </div>

        <div class="d-flex justify-content-between">
            <p class="mb-1 text-muted">{{ __('website/orders.status') }}</p>
            <span>
                {!! $order->statusBadge() !!}
            </span>
        </div>

        <div class="d-flex justify-content-between">
            <p class="mb-1 text-muted">{{ __('website/orders.date') }}</p>
            <p class="mb-1">{{ $order->formatted_created_at }}</p>
        </div>

        <div class="d-flex justify-content-between">
            <p class="mb-1 text-muted">{{ __('website/orders.address') }}</p>
            <p class="mb-1">{{ $order->address }}</p>
        </div>

        <div class="d-flex align-items-center justify-content-center my-3 gap-2">
            <div class="step active"><i class="fa-solid fa-check"></i></div>
            <div class="line"></div>
            <div class="step {{ $order->status !== 'pending' ? 'active' : '' }}"><i class="fa-solid fa-check"></i></div>
            <div class="line"></div>
            <div class="step {{ $order->status === 'completed' ? 'active' : '' }}"><i class="fa-solid fa-check"></i>
            </div>
        </div>

        <div class="d-flex justify-content-between align-items-center mt-2">
            <a href="{{ route('front.order.show',$order->number) }}"
                class="main_text d-flex align-items-center gap-2 single-order">
                <p class="mb-0">{{ __('website/orders.view_order_detail') }}</p>
                <i class="fa-solid fa-arrow-right-long"></i>
            </a>
        </div>
    </div>
</div>