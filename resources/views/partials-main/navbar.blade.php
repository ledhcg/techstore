<!-- Navbar 3 Level (Light)-->
<header class="shadow-sm">
    <!-- Topbar-->
    <div class="topbar topbar-dark bg-dark bg-htphodatviet">
        <div class="container">
            <div class="topbar-text dropdown d-md-none"><a class="topbar-link dropdown-toggle" href="#" data-bs-toggle="dropdown">{{__('main.Useful-links')}}</a>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="tel:{{config('app.phone_number', '+7 (900) 555 67 89')}}"><i class="ci-support text-muted me-2"></i>{{config('app.phone_number', '+7 (900) 555 67 89')}}</a></li>
                    <li><a class="dropdown-item" href="order-tracking.html"><i class="ci-location text-muted me-2"></i>{{__('main.Order-tracking')}}</a></li>
                </ul>
            </div>
            <div class="topbar-text text-nowrap d-none d-md-inline-block"><i class="ci-support"></i><span class="text-muted me-1">{{__('main.Support')}}</span><a class="topbar-link" href="tel:{{config('app.phone_number', '+7 (900) 555 67 89')}}">{{config('app.phone_number', '+7 (900) 555 67 89')}}</a></div>
            <div class="tns-carousel tns-controls-static d-none d-md-block">
                <div class="tns-carousel-inner" data-carousel-options="{&quot;mode&quot;: &quot;gallery&quot;, &quot;nav&quot;: false}">
                    <div class="topbar-text">{{__('main.Topbar-text1')}}</div>
                    <div class="topbar-text">{{__('main.Topbar-text2')}}</div>
                    <div class="topbar-text">{{__('main.Topbar-text3')}}</div>
                </div>
            </div>
            <div class="ms-3 text-nowrap"><a class="topbar-link me-4 d-none d-md-inline-block" href="order-tracking.html"><i class="ci-location"></i>{{__('main.Order-tracking')}}</a>
                <div class="topbar-text dropdown disable-autohide">
                    @if(config('app.locale') == 'vi')
                        <a class="topbar-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
                            <img class="me-2" src="{{asset('public/main/img/flags/vi.png')}}" width="20" alt="Tiếng Việt">Tiếng Việt / ₽</a>
                    @else
                        <a class="topbar-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
                            <img class="me-2" src="{{asset('public/main/img/flags/ru.png')}}" width="20" alt="Русский">Русский / ₽</a>
                    @endif

                    <ul class="dropdown-menu my-1">
                        <li class="dropdown-item">
                            <select class="form-select form-select-sm">
                                <option value="rub">₽ (RUB)</option>
                            </select>
                        </li>
                        <li><a class="dropdown-item pb-1" href="{{ route('setting.locale', 'ru') }}"><img class="me-2" src="{{asset('public/main/img/flags/ru.png')}}" width="20" alt="Русский">Русский</a></li>
                        <li><a class="dropdown-item pb-1" href="{{ route('setting.locale', 'vi') }}"><img class="me-2" src="{{asset('public/main/img/flags/vi.png')}}" width="20" alt="Tiếng Việt">Tiếng Việt</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- Remove "navbar-sticky" class to make navigation bar scrollable with the page.-->
    <div class="navbar-sticky bg-light">
        <div class="navbar navbar-expand-lg navbar-light">
            <div class="container"><a class="navbar-brand d-none d-sm-block flex-shrink-0" href="{{route('main.home')}}"><img src="{{asset('public/main/img/logo-dark.png')}}" width="142" alt="HT"></a><a class="navbar-brand d-sm-none flex-shrink-0 me-2" href="index-2.html"><img src="{{asset('public/main/img/logo-icon.png')}}" width="74" alt="HT"></a>
                <div class="input-group d-none d-lg-flex mx-4">
                        <input class="form-control rounded-end pe-5" id="input_search" type="text" placeholder="{{__('main.Search-for-products')}}">
                        <i class="ci-search position-absolute top-50 end-0 translate-middle-y text-muted fs-base me-3"></i>
                        <form id="form-search" action="{{route('main.getSearch')}}" method="POST">
                            @csrf
                            <input type="hidden" id="search_keyword" name="search_keyword">
                        </form>
                </div>
                <div class="navbar-toolbar d-flex flex-shrink-0 align-items-center">
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse"><span class="navbar-toggler-icon"></span></button><a class="navbar-tool navbar-stuck-toggler" href="#"><span class="navbar-tool-tooltip">{{__('main.Expand-menu')}}</span>
                        <div class="navbar-tool-icon-box"><i class="navbar-tool-icon ci-menu"></i></div></a><a class="navbar-tool d-none d-lg-flex" href="{{route('user.wishlist')}}"><span class="navbar-tool-tooltip">{{__('main.Wishlist')}}</span>
                        <div class="navbar-tool-icon-box"><i class="navbar-tool-icon ci-star"></i></div></a>

                        @if (Route::has('user.login'))
                                @auth
                                    <a class="navbar-tool ms-1 ms-lg-0 me-n1 me-lg-2" href="{{route('user.profileInfo')}}">
                                        <div class="navbar-tool-icon-box"><i class="navbar-tool-icon ci-user"></i></div>
                                        <div class="navbar-tool-text ms-n3"><small>{{__('main.Hello')}}</small><span class="account-name">{{Auth::user()->name}}</span></div></a>
                                @else
                                    <a class="navbar-tool ms-1 ms-lg-0 me-n1 me-lg-2" href="{{route('user.login')}}">
                                        <div class="navbar-tool-icon-box"><i class="navbar-tool-icon ci-user"></i></div>
                                        <div class="navbar-tool-text ms-n3"><small>{{__('main.Sign-in')}}</small>{{__('main.My-Account')}}</div></a>
                                @endauth
                        @endif


                    <div class="navbar-tool dropdown ms-3">
                            <a class="navbar-tool-icon-box bg-secondary dropdown-toggle" href="{{route('main.cartDetails')}}">
                                <span class="navbar-tool-label view-cart-count">{{\Gloudemans\Shoppingcart\Facades\Cart::instance('cart')->content()->count()}}</span>
                                <i class="navbar-tool-icon ci-cart"></i>
                            </a>
                            <a class="navbar-tool-text" href="{{route('main.cartDetails')}}"><small>{{__('main.My-Cart')}}</small>
                                <span class="view-subtotal">{{\Gloudemans\Shoppingcart\Facades\Cart::instance('cart')->subtotal(1,',',' ')}} ₽</span>
                            </a>
                            <!-- Cart dropdown-->
                            <div class="dropdown-menu dropdown-menu-end">
                                <div class="widget widget-cart px-3 pt-2 pb-3" id="dropdown-cart" style="width: 20rem;">
                                    <!--Content-->
                                </div>
                            </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="navbar navbar-expand-lg navbar-light navbar-stuck-menu mt-n2 pt-0 pb-2">
            <div class="container">
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <!-- Search-->
                    <div class="input-group d-lg-none my-3"><i class="ci-search position-absolute top-50 start-0 translate-middle-y text-muted fs-base ms-3"></i>
                        <input class="form-control rounded-start" id="input_search_mobile" type="text" placeholder="{{__('main.Search-for-products')}}">
                    </div>
                    <!-- Departments menu-->
                    <ul class="navbar-nav navbar-mega-nav pe-lg-2 me-lg-2">
                        <li class="nav-item dropdown"><a class="nav-link dropdown-toggle ps-lg-0" href="#" data-bs-toggle="dropdown"><i class="ci-view-grid me-2"></i>{{__('main.Categories')}}</a>
                            <div class="dropdown-menu px-2 pb-4">
                                <div class="d-flex flex-wrap flex-sm-nowrap">
                                    @foreach($dataCategories as $categoryNav)
                                    <div class="mega-dropdown-column pt-3 pt-sm-4 px-2 px-lg-3">
                                        <div class="widget widget-links"><a class="d-block overflow-hidden rounded-3 mb-3 @if($page == 'STORE') pointer" onclick="loadTabFromStore({{$categoryNav->id}})" @else " href="{{route('main.store')}}#tab_category_{{$categoryNav->id}}" @endif><img src="{{asset('data/images/upload/categories/'.$categoryNav->category_image)}}" alt="Clothing"></a>
                                            <h6 class="fs-base mb-2">{{$categoryNav["category_name_".config('app.locale')]}}</h6>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </li>
                    </ul>
                    <!-- Primary menu-->
                    <ul class="navbar-nav">
                        <li class="nav-item @if($page == 'HOME') active @endif"><a class="nav-link" href="{{route('main.home')}}">{{__('main.Home')}}</a></li>
                        <li class="nav-item @if($page == 'STORE') active @endif"><a class="nav-link" href="{{route('main.store')}}">{{__('main.Store')}}</a></li>
                        <li class="nav-item @if($page == 'CONTACT') active @endif"><a class="nav-link" href="{{route('main.contacts')}}">{{__('main.Contacts')}}</a></li>
                        <!--<li class="nav-item @if($page == 'ABOUT') active @endif"><a class="nav-link" href="#">{{__('main.About')}}</a></li>-->
                    </ul>
                </div>
            </div>
        </div>
    </div>
</header>
