<!-- payment -->
<section class="my-5 py-5 payment-section">
    @php
    $locale = app()->getLocale();
    @endphp
    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-12">
                <p class="payment_title">{{ __('website/cart-summary.title') }}</p>
                <div class="payment">

                </div>
                <form action="{{ route('front.order.create') }}" method="POST">
                    <div class="total p-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <p class="text-secondary fs-5 ">{{ __('website/cart-summary.subtotal') }}</p>
                            <p class="fs-4 fw-bold subtotal-amount">
                                {{ __('website/home.egp') }}
                                {{ translateNumberToLocale($locale,$total) }}
                            </p>
                        </div>
                        <div class="d-flex justify-content-between align-items-center mt-3">
                            <p class="text-secondary fs-5">{{ __('website/cart-summary.shipping') }}</p>
                            <p class="fs-4 fw-bold">
                                @csrf
                                <select class="form-select" wire:change="updateShippingArea($event.target.value)"
                                    name="shipping_area_id" aria-label="Default select example" required>
                                    <option selected disabled>{{ __('website/cart-summary.select_shipping_area') }}
                                    </option>
                                    @foreach ($shipping_areas as $shipping_area)
                                    <option value="{{$shipping_area->id}}">{{$shipping_area->name}}</option>
                                    @endforeach
                                </select>
                                <input type="hidden" name="tax_percentage" value="{{$tax_percentage}}" id="">
                            </p>

                        </div>
                        <div class="d-flex justify-content-between align-items-center py-3">
                            <p class="text-secondary fs-5">{{ __('website/cart-summary.shipping_fee') }}</p>
                            <p class="fs-4 fw-bold">
                                {{ __('website/home.egp') }}
                                {{ translateNumberToLocale($locale,$shipping_fee)}}
                            </p>
                        </div>
                        <div class="d-flex justify-content-between align-items-center py-3">
                            <p class="text-secondary fs-5">{{ __('website/cart-summary.address') }}</p>
                            <p class="fs-4 fw-bold col-7">
                                @if ($user_addresses->count())
                                <select class="form-select my-2" wire:change="selectAddress($event.target.value)"
                                    name="address" aria-label="Default select example" required>
                                    <option selected disabled>{{ __('website/cart-summary.select_address') }}</option>
                                    @foreach ($user_addresses as $user_address)
                                    <option value="{{$user_address->id}}">{{$user_address->address}}</option>
                                    @endforeach
                                </select>
                                @endif
                                @unless (!empty($address))
                                <input type="text" class="form-control" name="address" id="exampleFormControlInput1"
                                    placeholder="{{ __('website/cart-summary.enter_new_address') }}">
                                @endunless
                            </p>
                        </div>
                        @unless (!empty($address))
                        <div class="d-flex justify-content-end  py-1">
                            <div class="form-check">
                                <input class="form-check-input" name="save_to_address" type="checkbox" value="1"
                                    id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    {{ __('website/cart-summary.save_to_address') }}
                                </label>
                            </div>
                        </div>
                        @endunless
                        <div class="d-flex justify-content-between align-items-center py-3">
                            <p class="text-secondary fs-5 ">{{ __('website/cart-summary.tax') }}</p>
                            <p class="fs-4 fw-bold">
                                {{ __('website/home.egp') }}
                                {{ translateNumberToLocale($locale,$tax_amount)}}
                            </p>
                        </div>
                        <div class="d-flex justify-content-between align-items-center border-top py-3">
                            <p class="text-secondary fs-5 ">{{ __('website/cart-summary.total') }}</p>
                            <p class="fs-3 fw-bold main_text total-amount">
                                {{ __('website/home.egp') }}
                                {{ translateNumberToLocale($locale,$total_with_tax)}}
                            </p>
                        </div>

                        <div class="d-flex justify-content-between align-items-center border-top py-3">
                            <p class="text-secondary fs-5">{{ __('website/cart-summary.payment_type') }}</p>
                            <p class="fs-3 fw-bold main_text">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="payment_type" value="{{$cash}}"
                                    checked id="flexRadioDefault1">
                                <label class="form-check-label" for="flexRadioDefault1">
                                    {{ __('website/cart-summary.cash') }}
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="payment_type" value="{{$visa}}"
                                    id="flexRadioDefault2">
                                <label class="form-check-label" for="flexRadioDefault2">
                                    {{ __('website/cart-summary.visa') }}
                                </label>
                            </div>
                            </p>
                        </div>
                    </div>
                    <button type="submit" class="main_btn w-100"> {{ __('website/cart-summary.checkout') }}</button>
                </form>
                <a href="{{ route('front.books.index') }}">
                    <button class="primary_btn w-100 mt-3"> {{ __('website/cart-summary.keep_shopping') }}</button>
                </a>
            </div>
        </div>
    </div>
</section>