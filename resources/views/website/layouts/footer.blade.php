<footer>
    <div class="container">
        <div class="d-flex justify-content-between align-items-center border-bottom pb-4 flex-wrap gap-4">
            <div class="d-flex gap-4 align-items-center">
                <div class="logo_image">
                    <img src="{{ asset('front-assets') }}/images/logo.png" alt="logo" />
                </div>
                <div class="links_footer">
                    <ul class="d-flex gap-3 align-items-center p-0 m-0">
                        <li><a href="{{ route('front.home.index') }}" class="nav-link.active">Home</a></li>
                        <li><a href="{{ route('front.books.index') }}" class="nav-link.active">Books</a></li>
                        <li>
                            <a href="{{ route('front.about.index') }}" class="nav-link.active">About Us</a>
                        </li>
                        <li><a href="{{ route('front.contact.index') }}" class="nav-link.active">Books</a></li>
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
                    &lt; Developed By &gt; EraaSoft &lt; All Copy Rights Reserved @
                    {{ date('Y') }}
                </p>
            </div>
            <div class="lang d-flex gap-3">
                <img src="{{ asset('front-assets') }}/images/lang.png" alt="" class="image_lang" />
                <select name="lang" id="lang">
                    <option value="english" class="d-flex align-items-center">
                        English
                    </option>
                    <option value="arabic">عربي</option>
                </select>
            </div>
        </div>
    </div>
</footer>
