<!DOCTYPE html>
<html lang="en">

    <meta http-equiv="content-type" content="text/html;charset=utf-8" />
    @include('partials-main.head')
    <!-- Body-->
    <body class="handheld-toolbar-enabled">
    <!-- Google Tag Manager (noscript)-->
    <noscript>
        <iframe src="http://www.googletagmanager.com/ns.html?id=GTM-WKV3GT5" height="0" width="0" style="display: none; visibility: hidden;"></iframe>
    </noscript>

    @include('partials-main.modal')

<main class="page-wrapper" style="background-color: #f6fbff">

    @include('partials-main.navbar')
    @include('partials-main.search')
    <div id="layout-content">
    @yield('content')
    </div>

</main>

    @include('partials-main.footer')
    @include('partials-main.handheld-toobar')
    @include('partials-main.back-to-top')
    @include('partials-main.script')

</body>
</html>
