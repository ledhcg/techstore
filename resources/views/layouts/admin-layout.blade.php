<!DOCTYPE html>
<html lang="en">

@include('partials-admin.head')

<body>

    @include('partials-admin.preload')

    <div id="main-wrapper">


        @include('partials-admin.nav-header')

		@include('partials-admin.chat-box')

        @include('partials-admin.header')

        @include('partials-admin.sidebar')

        @yield('content')

        @include('partials-admin.footer')

    </div>

    @include('partials-admin.script')

</body>

</html>
