@php
    $locale = app()->getLocale();
@endphp
<nav class="navbar navbar-expand-lg" >
    <div class="container d-flex justify-content-between align-items-center">
        <a class="navbar-brand {{ $locale === 'ar' ? 'ms-3' : 'me-3' }}" href="{{ route('front.home.index') }}">
            <img src="{{ asset('front-assets/images/logo.png') }}" alt="Logo" />
        </a>

        <button class="navbar-toggler text-white border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent">
            <i class="fa-solid fa-bars fs-3"></i>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav {{ $locale === 'ar' ? 'ms-auto' : 'me-auto' }} mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('front.home.index') ? 'active' : '' }}" href="{{ route('front.home.index') }}">
                        {{ __('website/nav.home') }}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('front.books.index') ? 'active' : '' }}" href="{{ route('front.books.index') }}">
                        {{ __('website/nav.books') }}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('front.about.index') ? 'active' : '' }}" href="{{ route('front.about.index') }}">
                        {{ __('website/nav.about_us') }}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('front.contact.index') ? 'active' : '' }}" href="{{ route('front.contact.index') }}">
                        {{ __('website/nav.contact_us') }}
                    </a>
                </li>
            </ul>

            {{-- User & Cart --}}
            <div class="d-flex align-items-center gap-4">
                @auth
                    <div class="dropdown">
                        <button class="btn btn-light dropdown-toggle d-flex align-items-center gap-2" data-bs-toggle="dropdown">
                            <img src="{{ auth()->user()->image ?? 'https://fakeimg.pl/100x100' }}" alt="Profile" class="rounded-circle" width="40" height="40">
                            <div class="text-start">
                                <div class="fw-bold">{{ auth()->user()->username }}</div>
                                <div class="small text-muted">{{ auth()->user()->email }}</div>
                            </div>
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="profile.html">{{ __('website/nav.profile') }}</a></li>
                            <li><a class="dropdown-item" href="{{ route('front.order.index') }}">{{ __('website/nav.order_history') }}</a></li>
                            <li>
                                <form method="POST" action="{{ route('front.auth.logout') }}">
                                    @csrf
                                    <button class="dropdown-item">{{ __('website/nav.log_out') }}</button>
                                </form>
                            </li>
                        </ul>
                    </div>
                @endauth

                <a href="{{ route('front.favorite.index') }}" class="position-relative">
                    @if($favoriteCount > 0)
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">{{ translateNumberToLocale($locale,$favoriteCount,0) }}</span>
                    @endif
                    <i class="fa-regular fa-heart fs-4 text-white"></i>
                </a>

                <a href="{{ route('front.cart.index') }}" class="position-relative">
                    @if($cartCount > 0)
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">{{ translateNumberToLocale($locale,$cartCount,0) }}</span>
                    @endif
                    <i class="fa-solid fa-cart-shopping fs-4 text-white"></i>
                </a>

                @guest
                    <a class="main_btn login_btn" href="{{ route('front.auth.login') }}">{{ __('website/nav.login') }}</a>
                    <a class="primary_btn" href="{{ route('front.auth.register') }}">{{ __('website/nav.register') }}</a>
                @endguest

                <div class="dropdown">
                    <button class="btn btn-outline-light dropdown-toggle" data-bs-toggle="dropdown">
                        <img src="{{ asset('front-assets/images/lang.png') }}" width="20" class="me-1" alt="Language" />
                        {{ app()->getLocale() === 'ar' ? 'العربية' : 'English' }}
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{ route('front.home.change.language', 'en') }}">{{ __('website/nav.english') }}</a></li>
                        <li><a class="dropdown-item" href="{{ route('front.home.change.language', 'ar') }}">{{ __('website/nav.arabic') }}</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</nav>
