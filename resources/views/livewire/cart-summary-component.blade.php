<!-- payment -->
<section class="my-5 py-5 payment-section">
    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-6">
                <div class="payment">
                    <p class="payment_title">Payment Summary</p>
                    <p class="payment_description description fs-6 mt-2">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                        Mauris et ultricies est. Aliquam in justo varius, sagittis
                        neque ut, malesuada leo.
                    </p>
                    <div class=" py-5">
                        <p class="fs-4 description mt-3">Have a discount code?</p>
                        <div class="d-flex gap-3 mt-3">
                            <form class="input_container w-50">
                                <img src="{{ asset('front-assets') }}/images/ticket.png" alt="" />
                                <input type="text" placeholder="Enter Promo Code" />
                            </form>
                            <button class="cart_btn main_btn">Apply</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-6">
                <div class="total p-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <p class="text-secondary fs-5 ">Subtotal</p>
                        <p class="fs-4 fw-bold subtotal-amount">{{ $total }}</p>
                    </div>
                    <div class="d-flex justify-content-between align-items-center mt-3">
                        <p class="text-secondary fs-5">Shipping</p>
                        <p class="fs-4 fw-bold">Free Delivery</p>
                    </div>
                    <div class="d-flex justify-content-between align-items-center py-3">
                        <p class="text-secondary fs-5 ">Tax</p>
                        <p class="fs-4 fw-bold tax-amount"></p>
                    </div>
                    <div class="d-flex justify-content-between align-items-center border-top py-3">
                        <p class="text-secondary fs-5 ">Total</p>
                        <p class="fs-3 fw-bold main_text total-amount"></p>
                    </div>
                </div>
                <form action="" method="POST">
                    @csrf
                    <button class="main_btn w-100">Check out</button>
                </form>
                <a href="{{ route('front.books.index') }}">
                    <button class="primary_btn w-100 mt-3">Keep Shopping</button>
                </a>
            </div>
        </div>
    </div>
</section>
