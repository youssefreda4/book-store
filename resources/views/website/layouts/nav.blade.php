<nav class="navbar navbar-expand-lg">
    <div class="container">
        <a class="navbar-brand" href="{{ route('front.home.index') }}">
            <img src="{{ asset('front-assets') }}/images/logo.png" alt="" />
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fa-solid fa-bars text-light"></i>
            <!-- <span class="navbar-toggler-icon "></span> -->
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('front.home.index') ? 'active' : '' }}" aria-current="page"
                        href="{{ route('front.home.index') }}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('front.books.index') ? 'active' : '' }}"
                        href="{{ route('front.books.index') }}">Books</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('front.about.index') ? 'active' : '' }}"
                        href="{{ route('front.about.index') }}">About us</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('front.contact.index') ? 'active' : '' }}"
                        href="{{ route('front.contact.index') }}">Contact us</a>
                </li>
            </ul>


            @auth
            <div class="profile d-flex gap-4 align-items-center">

                <div class="dropdown">
                    <button class="dropdown-toggle d-flex align-items-center border-0 profile_dropdown gap-2"
                        type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                        <div class="profile_image">
                            <img src="{{ asset('front-assets') }}/images/commentimage.jpeg" alt=""
                                class="w-100 h-100" />
                        </div>
                        <div class="flex-column align-items-start">
                            <p class="fs-6 fw-bold text-light text-start">
                                Ahmed Fawzy
                            </p>
                            <p class="text-secondary">fawzy@gmail.com</p>
                        </div>
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                        <li>
                            <a class="dropdown-item" href="profile.html">Profile</a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="orders.html">Order History</a>
                        </li>
                        <li>
                            <form action="{{ route('front.auth.logout') }}" method="POST">
                                @csrf
                                <button class="dropdown-item">Log Out</button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
            @endauth

            <div class="me-5 d-flex gap-4 align-items-center">
                <a href="wishlist.html" class="wishlist-link">
                    <span>1</span>
                    <i class="fa-regular fa-heart fs-3"></i></a>
                <a href="{{ route('front.cart.index') }}" class="cart-link">
                    <span>1</span>
                    <i class="fa-solid fa-cart-shopping fs-3"></i></a>
            </div>

            @guest
            <div class="d-flex gap-3 me-3">
                <a class="main_btn login_btn" href="{{ route('front.auth.login') }}" type="button">Log in</a>
                <a class="primary_btn" href="{{ route('front.auth.register') }}" type="button">Sign Up
                </a>
            </div>
            @endguest

            <div class="dropdown">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" role="button"
                                data-bs-toggle="dropdown">
                                <img src="{{ asset('front-assets') }}/images/lang.png" alt="Lang"
                                    class="image_lang me-2" width="20" />
                                {{-- Language --}}
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#" data-lang="english">English</a></li>
                                <li><a class="dropdown-item" href="#" data-lang="arabic">عربي</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</nav>