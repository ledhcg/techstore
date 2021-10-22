<!DOCTYPE html>
<html lang="en">

    <meta http-equiv="content-type" content="text/html;charset=utf-8" />
    @include('partials-main.head')
    <!-- Body-->
    <body class="handheld-toolbar-enabled">

    @include('partials-main.modal')

<main class="page-wrapper" style="background-color: #f6fbff">

    @include('partials-main.navbar')
    @include('partials-main.search')
    <div id="layout-content">
        <div class="page-title-overlap bg-dark pt-4 bg-htphodatviet">
            <div class="container d-lg-flex justify-content-between py-2 py-lg-3">
                <div class="order-lg-2 mb-3 mb-lg-0 pt-lg-2">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb breadcrumb-light flex-lg-nowrap justify-content-center justify-content-lg-start">
                            <li class="breadcrumb-item"><a class="text-nowrap" href="{{route('main.home')}}"><i class="ci-home"></i>{{__('main.Home')}}</a></li>
                            </li>
                            <li class="breadcrumb-item text-nowrap"><a>{{__('main.User')}}</a></li>
                            <li class="breadcrumb-item text-nowrap active" aria-current="page">{{$name_page}}</li>
                        </ol>
                    </nav>
                </div>
                <div class="order-lg-1 pe-lg-4 text-center text-lg-start">
                    <h1 class="h3 text-light mb-0">{{$name_page}}</h1>
                </div>
            </div>
        </div>
        <div class="container pb-5 mb-2 mb-md-4">
            <div class="row">
                <!-- Sidebar-->
                <aside class="col-lg-4 pt-4 pt-lg-0 pe-xl-5">
                    <div class="bg-white rounded-3 shadow-lg pt-1 mb-5 mb-lg-0">
                        <div class="d-md-flex justify-content-between align-items-center text-center text-md-start p-4">
                            <div class="d-md-flex align-items-center">
                                <div class="img-thumbnail rounded-circle position-relative flex-shrink-0 mx-auto mb-2 mx-md-0 mb-md-0" style="width: 6.375rem;"><img class="rounded-circle account-avatar" src="{{$urlPhoto}}/{{Auth::user()->image}}" alt="Avatar"></div>
                                <div class="ps-md-3">
                                    <h3 class="fs-base mb-0 account-name">{{Auth::user()->name}}</h3><span class="text-accent fs-sm">{{Auth::user()->email}}</span>
                                </div>
                            </div><a class="btn btn-primary d-lg-none mb-2 mt-3 mt-md-0" href="#account-menu" data-bs-toggle="collapse" aria-expanded="false"><i class="ci-menu me-2"></i>{{__('main.Account-menu')}}</a>
                        </div>
                        <div class="d-lg-block collapse" id="account-menu">
                            <div class="bg-secondary px-4 py-3">
                                <h3 class="fs-sm mb-0 text-muted">{{__('main.Dashboard')}}</h3>
                            </div>
                            <ul class="list-unstyled mb-0">
                                <li class="border-bottom mb-0"><a class="nav-link-style d-flex align-items-center px-4 py-3 @if($page=='ORDERS') active @endif" href="{{route('user.orders')}}"><i class="ci-bag opacity-60 me-2"></i>{{__('main.Orders')}}</a></li>
                                <li class="mb-0"><a class="nav-link-style d-flex align-items-center px-4 py-3 @if($page=='WISHLIST') active @endif" href="{{route('user.wishlist')}}"><i class="ci-star opacity-60 me-2"></i>{{__('main.Wishlist')}}</a></li>
                            </ul>
                            <div class="bg-secondary px-4 py-3">
                                <h3 class="fs-sm mb-0 text-muted">{{__('main.Account-settings')}}</h3>
                            </div>
                            <ul class="list-unstyled mb-0">
                                <li class="border-bottom mb-0"><a class="nav-link-style d-flex align-items-center px-4 py-3 @if($page=='PROFILEINFO') active @endif " href="{{route('user.profileInfo')}}"><i class="ci-user opacity-60 me-2"></i>{{__('main.Profile-info')}}</a></li>
                                <li class="mb-0"><a class="nav-link-style d-flex align-items-center px-4 py-3 pointer" onclick="event.preventDefault();document.getElementById('logout-form').submit();"><i class="ci-sign-out opacity-60 me-2"></i>{{__('main.Sign-out')}}</a>
                                    <form action="{{route('user.logout')}}" method="post" class="d-none" id="logout-form">@csrf</form></li>
                            </ul>
                        </div>
                    </div>
                </aside>
                <!-- Content  -->
                <section class="col-lg-8">
                    <!-- Toolbar-->
                    <div class="d-none d-lg-flex justify-content-between align-items-center pt-lg-3 pb-4 pb-lg-5 mb-lg-3">
                        <h6 class="fs-base text-light mb-0">{{$extra_text}}</h6><a class="btn btn-primary btn-sm" href="{{route('main.store')}}"><i class="ci-arrow-left me-2"></i>{{__('main.Continue-shopping')}}</a>
                    </div>
                    <!-- Content-->
                    @yield('content')

                </section>
            </div>
        </div>

        <!-- Quick View Modal-->
        <div class="modal-quick-view modal fade" id="quick-view" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">{{__('main.Product details')}}</h5>
                        <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <!-- Product gallery-->
                            <div class="col-lg-7 col-md-6 pe-lg-0"><img class="rounded-3" id="modal_product_detail_image" src="" alt="Product"></div>
                            <!-- Product details-->
                            <div class="col-lg-5 col-md-6 pt-4 pt-lg-0">
                                <div class="product-details ms-auto pb-3">
                                    <div class="pb-2" id="modal_product_sale"></div>
                                    <h3 class="product-title" style="margin-bottom: 0.25rem" id="modal_product_detail_name"></h3>
                                    <p class="text-muted" id="modal_product_detail_category"></p>
                                    <div class="mb-3"><span class="h3 fw-normal text-accent me-1" id="modal_product_detail_price"></span></div>
                                    <div class="mb-3 d-flex align-items-center">
                                        <input class="form-control me-3" type="number" id="modal_product_detail_qty" placeholder="Số lượng">
                                        <input type="hidden" id="modal_product_id">
                                        <button class="btn btn-primary btn-shadow d-block w-100" onclick="addToCartFromModal()"><i class="ci-cart fs-lg me-2"></i>{{(__('main.Add to cart'))}}</button>
                                    </div>
                                    <div id="modal_product_alert_discount"></div>
                                    <h6 class="h6 mb-3 pb-2 pt-3 border-bottom"><i class="ci-announcement text-muted fs-lg align-middle mt-n1 me-2"></i>{{__('main.Product info')}}</h6>
                                    <p class="fs-sm" id="modal_product_detail_description"></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</main>

    @include('partials-main.footer')
    @include('partials-main.handheld-toobar')
    @include('partials-main.back-to-top')
    @include('partials-main.script')

</body>
</html>
