<!DOCTYPE html>
<html lang="en">

@include('website.layouts.header')

<body>

    <section class="hero-section">
        <header>
            @include('website.layouts.nav')
            <div class="overlay"></div>
        </header>
        @yield('hero_content')
    </section>

    @yield('content')

    @include('website.layouts.footer')

    @include('website.layouts.script')

</body>

</html>
