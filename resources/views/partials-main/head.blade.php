<head>
    <meta charset="utf-8">

    @yield('title')
    <!-- SEO Meta Tags-->
    <meta name="description" content="Cartzilla - Bootstrap E-commerce Template">
    <meta name="keywords" content="bootstrap, shop, e-commerce, market, modern, responsive,  business, mobile, bootstrap, html5, css3, js, gallery, slider, touch, creative, clean">
    <meta name="author" content="Createx Studio">
    <!-- Viewport-->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Favicon and Touch Icons-->
    <link rel="apple-touch-icon" sizes="180x180" href="{{asset('public/main/apple-touch-icon.png')}}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{asset('public/main/favicon-32x32.png')}}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('public/main/favicon-16x16.png')}}">
    <link rel="manifest" href="{{asset('public/main/site.webmanifest')}}">
    <link rel="mask-icon" color="#fe6a6a" href="{{asset('public/main/safari-pinned-tab.svg')}}">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="theme-color" content="#ffffff">
    <!-- Vendor Styles including: Font Icons, Plugins, etc.-->
    <link rel="stylesheet" media="screen" href="{{asset('public/main/vendor/simplebar/dist/simplebar.min.css')}}"/>
    <link rel="stylesheet" media="screen" href="{{asset('public/main/vendor/tiny-slider/dist/tiny-slider.css')}}"/>
    <!-- Main Theme Styles + Bootstrap-->
    <link rel="stylesheet" media="screen" href="{{asset('public/main/css/theme.min.css')}}">

    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.6/cropper.css" integrity="sha256-jKV9n9bkk/CTP8zbtEtnKaKf+ehRovOYeKoyfthwbC8=" crossorigin="anonymous" />

    <style>
        * {
            font-family: 'Roboto', sans-serif;
        }

        .pointer {
            cursor:pointer;
        }
        #map-yandex {
            width: 100%;
            height: 300px;
        }
        .bg-htphodatviet {
            background-color: #5e000a !important;
        }

        .parent-animated-white-space{
            overflow-x: hidden;
        }
        .animated-white-space {
            white-space: nowrap;
            animation: 20s linear 2s animation infinite;

        }

        @keyframes animation {
            0% {
                transform: translateX(5%)
            }
            50% {
                transform: translateX(-95%)
            }
            100% {
                transform: translateX(5%)
            }
        }
        .background-htphodatviet{
            background-image: url({{asset('public/admin/images/trongdong.svg')}});
            background-color: #5e000a;
        }

    </style>
    <!--Google font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <!-- Google Tag Manager-->
    <script>
        (function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
                new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
            j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
            '../www.googletagmanager.com/gtm5445.html?id='+i+dl;f.parentNode.insertBefore(j,f);
        })(window,document,'script','dataLayer','GTM-WKV3GT5');
    </script>

</head>
