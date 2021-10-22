@extends('layouts.main-layout')

@section('title')
    <title>HT Phở Đất Việt</title>
@endsection

@section('content')
    <!-- Hero slider-->

{{--    <section class="tns-carousel tns-controls-lg mb-4 mb-lg-5">--}}
{{--        <div class="tns-carousel-inner" data-carousel-options="{&quot;mode&quot;: &quot;gallery&quot;, &quot;responsive&quot;: {&quot;0&quot;:{&quot;nav&quot;:true, &quot;controls&quot;: false},&quot;992&quot;:{&quot;nav&quot;:false, &quot;controls&quot;: true}}}">--}}
{{--            <!-- Item-->--}}
{{--            <div class="px-lg-5" style="background-color: #f5b1b0;">--}}
{{--                <div class="d-lg-flex justify-content-between align-items-center ps-lg-4"><img class="d-block order-lg-2 me-lg-n5 flex-shrink-0" src="{{asset('public/main/img/home/hero-slider/02.jpg')}}" alt="Women Sportswear">--}}
{{--                    <div class="position-relative mx-auto me-lg-n5 py-5 px-4 mb-lg-5 order-lg-1" style="max-width: 42rem; z-index: 10;">--}}
{{--                        <div class="pb-lg-5 mb-lg-5 text-center text-lg-start text-lg-nowrap">--}}
{{--                            <h3 class="h2 text-light fw-light pb-1 from-bottom">Ẩm thực Việt Nam tại Nga</h3>--}}
{{--                            <h2 class="text-light display-5 from-bottom delay-1">Nhà hàng HT PHỞ ĐẤT VIỆT</h2>--}}
{{--                            <p class="fs-lg text-light pb-3 from-bottom delay-2">Thơm ngon đậm chất hồn Việt</p>--}}
{{--                            <div class="d-table scale-up delay-4 mx-auto mx-lg-0"><a class="btn btn-primary" href="shop-grid-ls.html">Mua hàng<i class="ci-arrow-right ms-2 me-n1"></i></a></div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <!-- Item-->--}}
{{--            <div class="px-lg-5" style="background-color: #3aafd2;">--}}
{{--                <div class="d-lg-flex justify-content-between align-items-center ps-lg-4"><img class="d-block order-lg-2 me-lg-n5 flex-shrink-0" src="{{asset('public/main/img/home/hero-slider/01.jpg')}}" alt="Summer Collection">--}}
{{--                    <div class="position-relative mx-auto me-lg-n5 py-5 px-4 mb-lg-5 order-lg-1" style="max-width: 42rem; z-index: 10;">--}}
{{--                        <div class="pb-lg-5 mb-lg-5 text-center text-lg-start text-lg-nowrap">--}}
{{--                            <h3 class="h2 text-light fw-light pb-1 from-bottom">Ẩm thực Việt Nam tại Nga</h3>--}}
{{--                            <h2 class="text-light display-5 from-bottom delay-1">Nhà hàng HT PHỞ ĐẤT VIỆT</h2>--}}
{{--                            <p class="fs-lg text-light pb-3 from-bottom delay-2">Thơm ngon đậm chất hồn Việt</p>--}}
{{--                            <div class="d-table scale-up delay-4 mx-auto mx-lg-0"><a class="btn btn-primary" href="shop-grid-ls.html">Shop Now<i class="ci-arrow-right ms-2 me-n1"></i></a></div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <!-- Item-->--}}
{{--            <div class="px-lg-5" style="background-color: #eba170;">--}}
{{--                <div class="d-lg-flex justify-content-between align-items-center ps-lg-4"><img class="d-block order-lg-2 me-lg-n5 flex-shrink-0" src="{{asset('public/main/img/home/hero-slider/03.jpg')}}" alt="Men Accessories">--}}
{{--                    <div class="position-relative mx-auto me-lg-n5 py-5 px-4 mb-lg-5 order-lg-1" style="max-width: 42rem; z-index: 10;">--}}
{{--                        <div class="pb-lg-5 mb-lg-5 text-center text-lg-start text-lg-nowrap">--}}
{{--                            <h3 class="h2 text-light fw-light pb-1 from-bottom">Ẩm thực Việt Nam tại Nga</h3>--}}
{{--                            <h2 class="text-light display-5 from-bottom delay-1">Nhà hàng HT PHỞ ĐẤT VIỆT</h2>--}}
{{--                            <p class="fs-lg text-light pb-3 from-bottom delay-2">Thơm ngon đậm chất hồn Việt</p>--}}
{{--                            <div class="d-table scale-up delay-4 mx-auto mx-lg-0"><a class="btn btn-primary" href="shop-grid-ls.html">Shop Now<i class="ci-arrow-right ms-2 me-n1"></i></a></div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </section>--}}
    <!-- Hero (Banners + Slider)-->
{{--    <section class="bg-secondary py-4 pt-md-5">--}}
{{--        <div class="container py-xl-2">--}}
{{--            <div class="row">--}}
{{--                <!-- Slider     -->--}}
{{--                <div class="col-xl-9 pt-xl-4 order-xl-2">--}}
{{--                    <div class="tns-carousel">--}}
{{--                        <div class="tns-carousel-inner" data-carousel-options="{&quot;items&quot;: 1, &quot;controls&quot;: false, &quot;loop&quot;: false}">--}}
{{--                            <div>--}}
{{--                                <div class="row align-items-center">--}}
{{--                                    <div class="col-md-6 order-md-2"><img class="d-block mx-auto" src="img/home/hero-slider/05.jpg" alt="VR Collection"></div>--}}
{{--                                    <div class="col-lg-5 col-md-6 offset-lg-1 order-md-1 pt-4 pb-md-4 text-center text-md-start">--}}
{{--                                        <h2 class="fw-light pb-1 from-bottom">World of music with</h2>--}}
{{--                                        <h1 class="display-4 from-bottom delay-1">{{config('app.name')}}</h1>--}}
{{--                                        <h5 class="fw-light pb-3 from-bottom delay-2">Choose between top brands</h5>--}}
{{--                                        <div class="d-table scale-up delay-4 mx-auto mx-md-0"><a class="btn btn-primary btn-shadow" href="shop-grid-ls.html">Shop Now<i class="ci-arrow-right ms-2 me-n1"></i></a></div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div>--}}
{{--                                <div class="row align-items-center">--}}
{{--                                    <div class="col-md-6 order-md-2"><img class="d-block mx-auto" src="img/home/hero-slider/04.jpg" alt="VR Collection"></div>--}}
{{--                                    <div class="col-lg-5 col-md-6 offset-lg-1 order-md-1 pt-4 pb-md-4 text-center text-md-start">--}}
{{--                                        <h2 class="fw-light pb-1 from-start">Explore the best</h2>--}}
{{--                                        <h1 class="display-4 from-start delay-1">VR Collection</h1>--}}
{{--                                        <h5 class="fw-light pb-3 from-start delay-2">on the market</h5>--}}
{{--                                        <div class="d-table scale-up delay-4 mx-auto mx-md-0"><a class="btn btn-primary btn-shadow" href="shop-grid-ls.html">Shop Now<i class="ci-arrow-right ms-2 me-n1"></i></a></div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div>--}}
{{--                                <div class="row align-items-center">--}}
{{--                                    <div class="col-md-6 order-md-2"><img class="d-block mx-auto" src="img/home/hero-slider/06.jpg" alt="VR Collection"></div>--}}
{{--                                    <div class="col-lg-5 col-md-6 offset-lg-1 order-md-1 pt-4 pb-md-4 text-center text-md-start">--}}
{{--                                        <h2 class="fw-light pb-1 scale-up">Check our huge</h2>--}}
{{--                                        <h1 class="display-4 scale-up delay-1">Smartphones</h1>--}}
{{--                                        <h5 class="fw-light pb-3 scale-up delay-2">&amp; Accessories collection</h5>--}}
{{--                                        <div class="d-table scale-up delay-4 mx-auto mx-md-0"><a class="btn btn-primary btn-shadow" href="shop-grid-ls.html">Shop Now<i class="ci-arrow-right ms-2 me-n1"></i></a></div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <!-- Banner group-->--}}
{{--                <div class="col-xl-3 order-xl-1 pt-4 mt-3 mt-xl-0 pt-xl-0">--}}
{{--                    <div class="table-responsive" data-simplebar>--}}
{{--                        <div class="d-flex d-xl-block"><a class="d-flex align-items-center bg-faded-info rounded-3 pt-2 ps-2 mb-4 me-4 me-xl-0" href="#" style="min-width: 16rem;"><img src="img/home/banners/banner-sm01.png" width="125" alt="Banner">--}}
{{--                                <div class="py-4 px-2">--}}
{{--                                    <h5 class="mb-2"><span class="fw-light">Next Gen</span><br>Video <span class="fw-light">with</span><br>360 Cam</h5>--}}
{{--                                    <div class="text-info fs-sm">Shop now<i class="ci-arrow-right fs-xs ms-1"></i></div>--}}
{{--                                </div></a><a class="d-flex align-items-center bg-faded-warning rounded-3 pt-2 ps-2 mb-4 me-4 me-xl-0" href="#" style="min-width: 16rem;"><img src="img/home/banners/banner-sm02.png" width="125" alt="Banner">--}}
{{--                                <div class="py-4 px-2">--}}
{{--                                    <h5 class="mb-2"><span class="fw-light">Top Rated</span><br>Gadgets<br><span class="fw-light">are on </span>Sale</h5>--}}
{{--                                    <div class="text-warning fs-sm">Shop now<i class="ci-arrow-right fs-xs ms-1"></i></div>--}}
{{--                                </div></a><a class="d-flex align-items-center bg-faded-success rounded-3 pt-2 ps-2 mb-4" href="#" style="min-width: 16rem;"><img src="img/home/banners/banner-sm03.png" width="125" alt="Banner">--}}
{{--                                <div class="py-4 px-2">--}}
{{--                                    <h5 class="mb-2"><span class="fw-light">Catch Big</span><br>Deals <span class="fw-light">on</span><br>Earbuds</h5>--}}
{{--                                    <div class="text-success fs-sm">Shop now<i class="ci-arrow-right fs-xs ms-1"></i></div>--}}
{{--                                </div></a></div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </section>--}}
    <!-- Shop by product-->
    <!-- Hero section-->
    <section class="bg-position-top-center bg-repeat-0 pt-5 pb-5 py-md-10" style="background-image: url({{asset('public/main/img/home/mono-product/hero-bg.jpg')}});">
        <div class="container pt-4 mb-3 mb-lg-0">
            <div class="row">
                <div class="col-lg-5 col-md-6 col-sm-8 offset-lg-1 offset-sm-1">
                    <h5 class="text-light fw-normal">{{__('main.APP DESCRIPTION')}}</h5>
                    <h1 class="text-light display-3 mb-3"><strong>{{__('main.' .config('app.name'))}}</strong></h1>
                    <div class="d-flex align-items-center mb-3"><a class="btn btn-outline-primary me-grid-gutter" href="{{route('main.store')}}"><i class="ci-bag fs-lg me-2"></i>{{__('main.Shop now')}}</a></div>
                </div>
            </div>
        </div>
    </section>

    <section class="container ps-lg-4 pe-lg-3 pt-4 mb-4 mb-md-5" >
        <div class="px-3 pt-2">
            <!-- Page title + breadcrumb-->
            <!-- Content-->
            <!-- Slider-->

{{--            <section class="tns-carousel mb-3 mb-md-5">--}}
{{--                <div class="tns-carousel-inner" data-carousel-options="{&quot;items&quot;: 1, &quot;mode&quot;: &quot;gallery&quot;, &quot;nav&quot;: false, &quot;responsive&quot;: {&quot;0&quot;: {&quot;nav&quot;: true, &quot;controls&quot;: false}, &quot;576&quot;: {&quot;nav&quot;: false, &quot;controls&quot;: true}}}">--}}
{{--                    <!-- Slide 1-->--}}
{{--                    <div>--}}
{{--                        <div class="rounded-3 px-md-5 text-center text-xl-start" style="background-color: #59c879;">--}}
{{--                            <div class="d-xl-flex justify-content-between align-items-center px-4 px-sm-5 mx-auto" style="max-width: 1226px;">--}}
{{--                                <div class="py-5 me-xl-4 mx-auto mx-xl-0" style="max-width: 490px;">--}}
{{--                                    <h1 class="h1 text-light">HT PHỞ ĐẤT VIỆT</h1>--}}
{{--                                    <p class="text-light pb-4">Ẩm thực Việt Nam tại Nga </br>Thơm ngon đậm chất hồn Việt</p>--}}
{{--                                    <div class="d-table mx-auto mx-lg-0"><a class="btn btn-primary" href="shop-grid-ls.html">Mua hàng<i class="ci-arrow-right ms-2 me-n1"></i></a></div>--}}
{{--                                </div>--}}
{{--                                <div><img src="{{asset('public/main/img/grocery/slider/slide01.jpg')}}" alt="Image"></div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <!-- Slide 2-->--}}
{{--                    <div>--}}
{{--                        <div class="rounded-3 px-md-5 text-center text-xl-start" style="background-color: #1a6fb0;">--}}
{{--                            <div class="d-xl-flex justify-content-between align-items-center px-4 px-sm-5 mx-auto" style="max-width: 1226px;">--}}
{{--                                <div class="py-5 me-xl-4 mx-auto mx-xl-0" style="max-width: 490px;">--}}
{{--                                    <h1 class="h1 text-light">HT PHỞ ĐẤT VIỆT</h1>--}}
{{--                                    <p class="text-light pb-4">Ẩm thực Việt Nam tại Nga </br>Thơm ngon đậm chất hồn Việt</p>--}}
{{--                                    <div class="d-table mx-auto mx-lg-0"><a class="btn btn-primary" href="shop-grid-ls.html">Mua hàng<i class="ci-arrow-right ms-2 me-n1"></i></a></div>--}}
{{--                                </div>--}}
{{--                                <div><img src="img/grocery/slider/slide02.jpg" alt="Image"></div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </section>--}}


            <!-- How it works-->
            <section class="pt-4 mb-4 mb-md-5">
                <h2 class="h3 text-center mb-grid-gutter pt-2">{{__('main.How it works')}}</h2>
                <div class="row g-0 bg-light rounded-3">
                    <div class="col-xl-4 col-lg-12 col-md-4 border-end">
                        <div class="py-3">
                            <div class="d-flex align-items-center mx-auto py-3 px-3" style="max-width: 362px;">
                                <div class="display-3 fw-normal opacity-15 me-4">01</div>
                                <div class="ps-2"><img class="d-block my-2" src="{{asset('public/main/img/grocery/steps/01.png')}}" width="72" alt="Order online">
                                    <p class="mb-3 pt-1">{{__('main.You order your favorite products online')}}</p>
                                </div>
                            </div>
                            <hr class="d-md-none d-lg-block d-xl-none">
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-12 col-md-4 border-end">
                        <div class="py-3">
                            <div class="d-flex align-items-center mx-auto py-3 px-3" style="max-width: 362px;">
                                <div class="display-3 fw-normal opacity-15 me-4">02</div>
                                <div class="ps-2"><img class="d-block my-2" src="{{asset('public/main/img/grocery/steps/02.png')}}" width="72" alt="Grocery collected">
                                    <p class="mb-3 pt-1">{{__('main.A personal assistant collects the products from your list')}}</p>
                                </div>
                            </div>
                            <hr class="d-md-none d-lg-block d-xl-none">
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-12 col-md-4">
                        <div class="py-3">
                            <div class="d-flex align-items-center mx-auto py-3 px-3" style="max-width: 362px;">
                                <div class="display-3 fw-normal opacity-15 me-4">03</div>
                                <div class="ps-2"><img class="d-block my-2" src="{{asset('public/main/img/grocery/steps/03.png')}}" width="72" alt="Delivery">
                                    <p class="mb-3 pt-1">{{__('main.We deliver to the door at a time convenient for you')}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            @foreach($dataCategories as $categoryS)
                @if(\App\Models\Product::where('category_id',$categoryS->id)->get()->count() > 0)
                    <section class="pt-3 pt-md-4">
                        <!-- Heading-->
                        <div class="d-flex flex-wrap justify-content-between align-items-center pt-1 border-bottom pb-4 mb-4">
                            <h2 class="h3 mb-0 pt-3 me-3">{{$categoryS["category_name_".config('app.locale')]}}</h2>
                            <div class="pt-3"><a class="btn btn-outline-primary btn-sm" href="{{route('main.store')}}#tab_category_{{$categoryS->id}}">{{__('main.More products')}}<i class="ci-arrow-right ms-1 me-n1"></i></a></div>
                        </div>
                        <div class="tns-carousel tns-controls-static tns-controls-outside tns-nav-enabled pt-2">
                            <div class="tns-carousel-inner" data-carousel-options="{&quot;items&quot;: 2, &quot;gutter&quot;: 16, &quot;controls&quot;: true, &quot;autoHeight&quot;: true, &quot;responsive&quot;: {&quot;0&quot;:{&quot;items&quot;:1}, &quot;480&quot;:{&quot;items&quot;:2}, &quot;720&quot;:{&quot;items&quot;:3}, &quot;991&quot;:{&quot;items&quot;:2}, &quot;1140&quot;:{&quot;items&quot;:3}, &quot;1300&quot;:{&quot;items&quot;:4}, &quot;1500&quot;:{&quot;items&quot;:5}}}">
                                @foreach($dataProducts as $product){
                                    @if($product->category_id == $categoryS->id)
                                    <!-- Product-->
                                    <div>
                                        <div class="card product-card card-static pb-3">
                                            @if($product->product_price_fix > 0)
                                                <span class="badge bg-danger badge-shadow">{{__('main.Sale')}}</span>
                                            @endif
{{--                                                @if(\Gloudemans\Shoppingcart\Facades\Cart::instance('wishlist')->count())--}}
{{--                                                    @php--}}
{{--                                                        $added_wishlist = false;--}}
{{--                                                    @endphp--}}
{{--                                                    @foreach(\Gloudemans\Shoppingcart\Facades\Cart::instance('wishlist')->content() as $wishlistItem)--}}
{{--                                                        @if($wishlistItem->id == $product->id)--}}
{{--                                                            @php--}}
{{--                                                                $added_wishlist = true;--}}
{{--                                                            @endphp--}}
{{--                                                            <button id="button_action_wishlist_all_{{$product->id}}" class="btn-wishlist btn-sm" onclick="removeFromWishlist({{$product->id}})" type="button"><i class="ci-star-filled text-primary"></i></button>--}}
{{--                                                            @break--}}
{{--                                                        @endif--}}
{{--                                                    @endforeach--}}
{{--                                                    @if(!$added_wishlist)--}}
{{--                                                        <button id="button_action_wishlist_all_{{$product->id}}" class="btn-wishlist btn-sm" onclick="addToWishlist({{$product->id}})" type="button"><i class="ci-star"></i></button>--}}
{{--                                                    @endif--}}
{{--                                                @else--}}
{{--                                                    <button id="button_action_wishlist_all_{{$product->id}}" class="btn-wishlist btn-sm" onclick="addToWishlist({{$product->id}})" type="button"><i class="ci-star"></i></button>--}}
{{--                                                @endif--}}
                                            <a class="card-img-top d-block overflow-hidden"><img src="{{$urlPhoto}}/{{$product->product_image}}" alt="Product"></a>
                                            <div class="card-body py-2">
                                                <a class="product-meta d-block fs-xs pb-1 text-center" href="{{route('main.store')}}#tab_category_{{$categoryS->id}}">
                                                    @foreach($dataCategories as $category)
                                                        @if($product->category_id == $category->id)
                                                            {{$category["category_name_".config('app.locale')]}}
                                                        @endif
                                                    @endforeach
                                                </a>
                                                <h3 class="product-title fs-6 text-truncate text-center">
                                                    <a>
                                                        {{$product["product_name_".config('app.locale')]}}
                                                    </a>
                                                </h3>
                                                <div class="product-price mb-2 justify-content-between text-center"><span class="text-accent">{{number_format($product->product_price_last, 1, ',', ' ')}} ₽</span>
                                                    @if($product->product_price_fix > 0)
                                                        <del class="fs-sm text-muted">{{number_format($product->product_price_fix, 1, ',', ' ')}} ₽</del>
                                                    @endif
                                                </div>
                                                    @if($product->product_quantity_to_discount > 0)
                                                        <div class="border-top pt-3">
                                                            <div class="alert alert-success d-flex" role="alert">
                                                                <div class="alert-icon">
                                                                    <small><i class="ci-percent"></i></small>
                                                                </div>
                                                                <div><small class="fs-xs">{{trans_choice('main.Alert-discount', $product->product_quantity_to_discount, ['value' => $product->product_quantity_to_discount])}}</small></div>
                                                            </div>
                                                        </div>
                                                    @endif

                                                <div class="pt-md-2">
                                                    <button class="btn btn-primary btn-sm w-100 add-to-cart" data-id="{{$product->id}}" type="submit">
                                                        <i class="ci-cart fs-sm me-1"></i>{{__('main.Add to cart')}}</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </section>
                @endif
            @endforeach



            <!-- Reviews-->
{{--            <section class="py-5 bg-light rounded-3 my-4 my-md-5 px-3 px-sm-4">--}}
{{--                <h2 class="h3 py-4 text-center">{{__('main.Customer reviews')}}</h2>--}}
{{--                <div class="tns-carousel">--}}
{{--                    <div class="tns-carousel-inner" data-carousel-options='{"items": 2, "controls": false, "responsive": {"0":{"items":1},"750":{"items":2, "gutter": 20},"991":{"items":3, "gutter": 30}}}'>--}}
{{--                        <blockquote class="testimonial mb-2">--}}
{{--                            <div class="card border-0 shadow-sm"><span class="testimonial-mark"></span>--}}
{{--                                <div class="card-body fs-md">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</div>--}}
{{--                            </div>--}}
{{--                            <footer class="d-flex justify-content-center align-items-center pt-4">--}}
{{--                                <img class="rounded" width="50" src="path-to-picture" alt="Mary Grant"/>--}}
{{--                                <div class="ps-3">--}}
{{--                                    <h6 class="fs-sm mb-n1">Mary Alice Grant</h6>--}}
{{--                                    <span class="fs-ms text-muted">Desperate housewife</span>--}}
{{--                                </div>--}}
{{--                            </footer>--}}
{{--                        </blockquote>--}}

{{--                        <blockquote class="testimonial mb-2">--}}
{{--                            <div class="card border-0 shadow-sm"><span class="testimonial-mark"></span>--}}
{{--                                <div class="card-body fs-md">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</div>--}}
{{--                            </div>--}}
{{--                            <footer class="d-flex justify-content-center align-items-center pt-4">--}}
{{--                                <img class="rounded" width="50" src="path-to-picture" alt="Mary Grant"/>--}}
{{--                                <div class="ps-3">--}}
{{--                                    <h6 class="fs-sm mb-n1">Mary Alice Grant</h6>--}}
{{--                                    <span class="fs-ms text-muted">Desperate housewife</span>--}}
{{--                                </div>--}}
{{--                            </footer>--}}
{{--                        </blockquote>--}}
{{--                        <blockquote class="testimonial mb-2">--}}
{{--                            <div class="card border-0 shadow-sm"><span class="testimonial-mark"></span>--}}
{{--                                <div class="card-body fs-md">liqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</div>--}}
{{--                            </div>--}}
{{--                            <footer class="d-flex justify-content-center align-items-center pt-4">--}}
{{--                                <img class="rounded" width="50" src="path-to-picture" alt="Mary Grant"/>--}}
{{--                                <div class="ps-3">--}}
{{--                                    <h6 class="fs-sm mb-n1">Mary Alice Grant</h6>--}}
{{--                                    <span class="fs-ms text-muted">Desperate housewife</span>--}}
{{--                                </div>--}}
{{--                            </footer>--}}
{{--                        </blockquote>--}}
{{--                        <blockquote class="testimonial mb-2">--}}
{{--                            <div class="card border-0 shadow-sm"><span class="testimonial-mark"></span>--}}
{{--                                <div class="card-body fs-md">Lorem ipsum doore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</div>--}}
{{--                            </div>--}}
{{--                            <footer class="d-flex justify-content-center align-items-center pt-4">--}}
{{--                                <img class="rounded" width="50" src="path-to-picture" alt="Mary Grant"/>--}}
{{--                                <div class="ps-3">--}}
{{--                                    <h6 class="fs-sm mb-n1">Mary Alice Grant</h6>--}}
{{--                                    <span class="fs-ms text-muted">Desperate housewife</span>--}}
{{--                                </div>--}}
{{--                            </footer>--}}
{{--                        </blockquote>--}}

{{--                        <!-- Add as many testimonials as you need -->--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </section>--}}
{{--            <div class="pb-3"></div>--}}
        </div>
    </section>
@endsection
