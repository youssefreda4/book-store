<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css"
        integrity="sha512-5Hs3dF2AEPkpNAR7UiOHba+lRSJNeM2ECkwxUIxC1Q/FLycGTbNapWXB4tP889k5T5Ju8fs4b1P5z/iB4nMfSQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Link to the file hosted on your server, -->
    <!-- <link rel="stylesheet" href="path-to-the-file/splide.min.css"> -->
    <!-- or link to the CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/splidejs/4.1.4/css/splide-core.min.css"
        integrity="sha512-cSogJ0h5p3lhb//GYQRKsQAiwRku2tKOw/Rgvba47vg0+iOFrQ94iQbmAvRPF5+qkF8+gT7XBct233jFg1cBaQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- <link rel="stylesheet" href="url-to-cdn/splide.min.css"> -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap"
        rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('front-assets') }}/css/reset.css" />
    <link rel="stylesheet" href="{{ asset('front-assets') }}/css/layout.css" />
    @stack('css')
    <title>Book Store | @yield('title')</title>
</head>
