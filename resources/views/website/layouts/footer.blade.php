<footer>
    <div class="container">
        <div class="d-flex justify-content-between align-items-center border-bottom pb-4 flex-wrap gap-4">
            <div class="d-flex gap-4 align-items-center">
                <div class="logo_image">
                    <img src="{{ asset('front-assets') }}/images/logo.png" alt="logo" />
                </div>
                <div class="links_footer">
                    <ul class="d-flex gap-3 align-items-center p-0 m-0">
                        <li><a href="{{ route('front.home.index') }}" class="nav-link.active"> {{ __('website/nav.home')
                                }}</a></li>
                        <li><a href="{{ route('front.books.index') }}" class="nav-link.active">{{
                                __('website/nav.books') }}</a></li>
                        <li>
                            <a href="{{ route('front.about.index') }}" class="nav-link.active">{{
                                __('website/nav.about_us') }}</a>
                        </li>
                        <li><a href="{{ route('front.contact.index') }}" class="nav-link.active"> {{
                                __('website/nav.contact_us') }}</a></li>
                    </ul>
                </div>
            </div>
            <div class="social-icons d-flex gap-3">
                <img src="{{ asset('front-assets') }}/images/face.png" alt="" />
                <img src="{{ asset('front-assets') }}/images/insta.png" alt="" />
                <img src="{{ asset('front-assets') }}/images/youtube.png" alt="" />
                <img src="{{ asset('front-assets') }}/images/x.png" alt="" />
            </div>
        </div>
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-4 pt-4">
            <div>
                <p class="text-light">
                    &lt; {{ __('website/nav.developed_by') }} &gt; Youssef &lt; {{ __('website/nav.all_copy_rights') }} @
                    {{ date('Y') }}
                </p>
            </div>
            <div class="dropdown">
                <button class="btn btn-outline-light dropdown-toggle" data-bs-toggle="dropdown">
                    <img src="{{ asset('front-assets/images/lang.png') }}" width="20" class="me-1" alt="Language" />
                    {{ app()->getLocale() === 'ar' ? 'العربية' : 'English' }}
                </button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="{{ route('front.home.change.language', 'en') }}">{{
                            __('website/nav.english') }}</a></li>
                    <li><a class="dropdown-item" href="{{ route('front.home.change.language', 'ar') }}">{{
                            __('website/nav.arabic') }}</a></li>
                </ul>
            </div>
        </div>
    </div>
</footer>