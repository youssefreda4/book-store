<div class="card card-body mb-4">
    <form action="{{ route('dashboard.orders.index') }}" method="GET">
        <div class="row">
            {{-- Order Number --}}
            <div class="col-md-4">
                <div class="form-group">
                    <label for="order_number">{{ __('order.number') }}</label>
                    <input type="text" name="order_number" class="form-control"
                        placeholder="{{ __('order.enter_order_number') }}" value="{{ request()->order_number }}">
                </div>
            </div>

            {{-- Order Status --}}
            <div class="col-md-4">
                <div class="form-group">
                    <label for="order_status">{{ __('order.status') }}</label>
                    <select name="order_status" class="form-control">
                        <option value="">{{ __('order.select_status') }}</option>
                        @foreach (\App\Enum\OrderStatusEnum::cases() as $status)
                        <option value="{{ $status->value }}" @selected(request()->order_status == $status->value)>
                            {{ __('order.status_' . $status->value) }}
                        </option>
                        @endforeach
                    </select>
                </div>
            </div>

            {{-- Payment Status --}}
            <div class="col-md-4">
                <div class="form-group">
                    <label for="payment_status">{{ __('order.payment_status') }}</label>
                    <select name="payment_status" class="form-control">
                        <option value="">{{ __('order.select_payment_status') }}</option>
                        @foreach (\App\Enum\PaymentStatusEnum::cases() as $status)
                        <option value="{{ $status->value }}" @selected(request()->payment_status == $status->value)>
                            {{ __('order.payment_status_' . $status->value) }}
                        </option>
                        @endforeach
                    </select>
                </div>
            </div>

            {{-- Payment Type --}}
            <div class="col-md-4">
                <div class="form-group">
                    <label for="payment_type">{{ __('order.payment_type') }}</label>
                    <select name="payment_type" class="form-control">
                        <option value="">{{ __('order.select_payment_type') }}</option>
                        @foreach (\App\Enum\PaymentTypeEnum::cases() as $type)
                        <option value="{{ $type->value }}" @selected(request()->payment_type == $type->value)>
                            {{ __('order.payment_type_' . $type->value) }}
                        </option>
                        @endforeach
                    </select>
                </div>
            </div>

            {{-- User --}}
            <div class="col-md-4">
                <div class="form-group">
                    <label for="user_name">{{ __('order.user_name') }}</label>
                    <input type="text" name="user_name" class="form-control"
                        placeholder="{{ __('order.enter_user_name') }}" value="{{ request()->user_name }}">
                </div>
            </div>


            {{-- Shipping Area Name --}}
            <div class="col-md-4">
                <div class="form-group">
                    <label for="shipping_area_name">{{ __('order.shipping_area_name') }}</label>
                    <input type="text" name="shipping_area_name" class="form-control"
                        placeholder="{{ __('order.enter_shipping_area_name') }}"
                        value="{{ request()->shipping_area_name }}">
                </div>
            </div>
        </div>

        {{-- Filter and Reset --}}
        <div class="col-md-12 mt-3">
            <x-adminlte-button label="{{ __('order.filter') }}" theme="primary" type="submit" />
            <a href="{{ route('dashboard.orders.index') }}">
                <x-adminlte-button label="{{ __('order.reset') }}" theme="secondary" />
            </a>
        </div>
    </form>
</div>