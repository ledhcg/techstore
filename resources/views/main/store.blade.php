@extends('layouts.main-layout')

@section('title')
    <title>HT Phở Đất Việt</title>
@endsection

@section('content')

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
                                        <input class="form-control me-3" type="number" id="modal_product_detail_qty" placeholder="{{__('main.Quantity')}}">
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
    <!-- Page title-->
    <section class="bg-darker bg-size-cover bg-position-center py-5" style="background-image: url({{asset('public/main/img/food-delivery/restaurants/single/pt-bg.jpg')}});">
        <div class="container py-md-4">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-light flex-lg-nowrap justify-content-center justify-content-lg-start">
                    <li class="breadcrumb-item"><a class="text-nowrap" href="{{route('main.home')}}"><i class="ci-home"></i>{{__('main.Home')}}</a></li>
                    <li class="breadcrumb-item text-nowrap active" aria-current="page">{{__('main.Store')}}</li>
                </ol>
            </nav>
            <h1 class="text-light text-center text-lg-start py-3">{{config('app.name')}}</h1>
        </div>
    </section>
    <!-- Page navigation-->
    <nav class="container mt-n5">
        <div class="d-flex align-items-center bg-white rounded-3 shadow-lg py-2 ps-sm-2 pe-4 pe-lg-2"><img class="d-block rounded-3 m-3 m-sm-3" src="{{asset('public/main/img/logo-dark.png')}}" width="150" alt="Brand">
            <div class="ps-lg-3 w-100 text-end">
                <!-- For desktop-->
                <ul class="nav nav-tabs d-none d-lg-flex border-0 mb-0 tab-store">
                    <li class="nav-item"><a class="nav-link active" data-bs-toggle="tab" role="tab" href="#tab_category_all">{{__('main.All')}}</a></li>
                    @foreach($dataCategories as $categoryS)
                        @if(\App\Models\Product::where('category_id',$categoryS->id)->get()->count() > 0)
                        <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" role="tab" href="#tab_category_{{$categoryS->id}}">{{$categoryS["category_name_".config('app.locale')]}}</a></li>
                        @endif
                    @endforeach
                </ul>
                <!-- For mobile-->
                <div class="btn-group dropdown d-lg-none ms-auto">
                    <button class="btn btn-primary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="ci-menu fs-base me-2"></i>{{__('main.Menu')}}</button>
                    <div class="dropdown-menu dropdown-menu-end">
                        <ul class="nav flex-column border-0 mb-0 tab-store">
                            <li class="nav-item"><a class="nav-link active" data-bs-toggle="tab" role="tab" href="#tab_category_all">{{__('main.All')}}</a></li>
                            @foreach($dataCategories as $categoryS)
                                @if(\App\Models\Product::where('category_id',$categoryS->id)->get()->count() > 0)
                                    <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" role="tab" href="#tab_category_{{$categoryS->id}}">{{$categoryS["category_name_".config('app.locale')]}}</a></li>
                                @endif
                            @endforeach
                        </ul>

                    </div>
                </div>
            </div>
        </div>
    </nav>
    <!-- Menu (Products grid)-->
    <section class="container tab-content py-4 py-sm-5">
        <div class="tab-content">
            <div class="tab-pane fade show active" id="tab_category_all" role="tabpanel">
                <h2 class="text-center pt-2 pt-sm-0 mb-sm-5 text-light">{{__('main.All')}}</h2>
                <div class="row pt-3 pt-sm-0">
                    @foreach($dataProducts as $product)
                    <!-- Item-->
                        <div class="col-lg-3 col-md-4 col-sm-6 mb-grid-gutter">
                            <div class="card product-card border pb-2"><a class="d-block pointer" onclick="showModalProductDetail({{$product->id}})"><img class="card-img-top" src="{{$urlPhoto}}/{{$product->product_image}}" alt="Product"></a>
                                @if($product->product_price_fix > 0)
                                    <span class="badge bg-danger badge-shadow">{{__('main.Sale')}}</span>
                                @endif

                                @if(\Gloudemans\Shoppingcart\Facades\Cart::instance('wishlist')->count())
                                    @php
                                        $added_wishlist = false;
                                    @endphp
                                    @foreach(\Gloudemans\Shoppingcart\Facades\Cart::instance('wishlist')->content() as $wishlistItem)
                                        @if($wishlistItem->id == $product->id)
                                            @php
                                                $added_wishlist = true;
                                            @endphp
                                            <button id="button_action_wishlist_all_{{$product->id}}" class="btn-wishlist btn-sm" onclick="removeFromWishlist({{$product->id}})" type="button"><i class="ci-star-filled text-primary"></i></button>
                                            @break
                                        @endif
                                    @endforeach
                                    @if(!$added_wishlist)
                                        <button id="button_action_wishlist_all_{{$product->id}}" class="btn-wishlist btn-sm" onclick="addToWishlist({{$product->id}})" type="button"><i class="ci-star"></i></button>
                                    @endif
                                @else
                                    <button id="button_action_wishlist_all_{{$product->id}}" class="btn-wishlist btn-sm" onclick="addToWishlist({{$product->id}})" type="button"><i class="ci-star"></i></button>
                                @endif
                                <div class="card-body pt-4 pb-3">
                                    <h3 class="product-title fs-md text-center" style="margin-bottom: 0.25rem"><a class="pointer" onclick="showModalProductDetail({{$product->id}})">{{$product["product_name_".config('app.locale')]}}</a></h3>
                                    <p class="fs-ms text-muted text-center">
                                        @foreach($dataCategories as $category)
                                            @if($product->category_id == $category->id)
                                                {{$category["category_name_".config('app.locale')]}}
                                            @endif
                                        @endforeach
                                    </p>
                                    @if($product->product_quantity_to_discount > 0)
                                        <div class="mb-1 border-top pt-3">
                                            <div class="alert alert-success d-flex" role="alert">
                                                <div class="alert-icon">
                                                    <small><i class="ci-percent"></i></small>
                                                </div>
                                                <div><small class="fs-xs">{{trans_choice('main.Alert-discount', $product->product_quantity_to_discount, ['value' => $product->product_quantity_to_discount])}}</small></div>
                                            </div>
                                        </div>
                                    @endif
                                    <div class="d-flex border-top pt-2 pb-2 align-items-center justify-content-center">
                                        <div class="product-price">{{__('main.Price')}}<span class="text-accent">{{number_format($product->product_price_last, 1, ',', ' ')}} ₽</span>
                                            @if($product->product_price_fix > 0)
                                                <del class="fs-sm text-muted">{{number_format($product->product_price_fix, 1, ',', ' ')}} ₽</del>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="d-flex border-top pt-3 align-items-center justify-content-between">
                                        <input class="form-control me-2 form-control-sm" type="number" id="product_qty_{{$product->id}}" placeholder="{{__('main.Quantity')}}">
                                        <button class="btn btn-primary btn-sm add-to-cart" data-id="{{$product->id}}" type="submit">
                                            <i class="ci-cart fs-base ms-1"></i> {{__('main.Add')}}</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            @foreach($dataCategories as $categoryS)
                @if(\App\Models\Product::where('category_id',$categoryS->id)->get()->count() > 0)
                <div class="tab-pane fade show" id="tab_category_{{$categoryS->id}}" role="tabpanel">
                    <h2 class="text-center pt-2 pt-sm-0 mb-sm-5">{{$categoryS["category_name_".config('app.locale')]}}</h2>
                    <div class="row pt-3 pt-sm-0">
                        <!-- Item-->
                        @foreach($dataProducts as $product)
                            @if($product->category_id == $categoryS->id)
                            <div class="col-lg-3 col-md-4 col-sm-6 mb-grid-gutter">
                            <div class="card product-card border pb-2"><a class="d-block" style="cursor: pointer" onclick="showModalProductDetail({{$product->id}})"><img class="card-img-top" src="{{$urlPhoto}}/{{$product->product_image}}" alt="Product"></a>
                                @if($product->product_price_fix > 0)
                                    <span class="badge bg-danger badge-shadow">{{__('main.Sale')}}</span>
                                @endif

                                @if(\Gloudemans\Shoppingcart\Facades\Cart::instance('wishlist')->count())
                                    @php
                                        $added_wishlist = false;
                                    @endphp
                                    @foreach(\Gloudemans\Shoppingcart\Facades\Cart::instance('wishlist')->content() as $wishlistItem)
                                        @if($wishlistItem->id == $product->id)
                                            @php
                                                $added_wishlist = true;
                                            @endphp
                                            <button id="button_action_wishlist_{{$product->id}}" class="btn-wishlist btn-sm" onclick="removeFromWishlist({{$product->id}})" type="button"><i class="ci-star-filled text-primary"></i></button>
                                            @break
                                        @endif
                                    @endforeach
                                    @if(!$added_wishlist)
                                        <button id="button_action_wishlist_{{$product->id}}" class="btn-wishlist btn-sm" onclick="addToWishlist({{$product->id}})" type="button"><i class="ci-star"></i></button>
                                    @endif
                                @else
                                    <button id="button_action_wishlist_{{$product->id}}" class="btn-wishlist btn-sm" onclick="addToWishlist({{$product->id}})" type="button"><i class="ci-star"></i></button>
                                @endif
                                <div class="card-body pt-4 pb-3">
                                    <h3 class="product-title fs-md text-center" style="margin-bottom: 0.25rem"><a style="cursor: pointer" onclick="showModalProductDetail({{$product->id}})">{{$product["product_name_".config('app.locale')]}}</a></h3>
                                    <p class="fs-ms text-muted text-center">
                                        @foreach($dataCategories as $category)
                                            @if($product->category_id == $category->id)
                                                {{$category["category_name_".config('app.locale')]}}
                                            @endif
                                        @endforeach
                                    </p>
                                    @if($product->product_quantity_to_discount > 0)
                                        <div class="d-flex mb-1 border-top pt-3">
                                            <div class="alert alert-success d-flex" role="alert">
                                                <div class="alert-icon">
                                                    <small><i class="ci-percent"></i></small>
                                                </div>
                                                <div><small class="fs-xs">{{trans_choice('main.Alert-discount', $product->product_quantity_to_discount, ['value' => $product->product_quantity_to_discount])}}</small></div>
                                            </div>
                                        </div>
                                    @endif
                                    <div class="d-flex border-top pt-2 pb-2 align-items-center justify-content-center">
                                        <div class="product-price">{{__('main.Price')}}<span class="text-accent">{{$product->product_price_last}} ₽</span>
                                            @if($product->product_price_fix > 0)
                                                <del class="fs-sm text-muted">{{$product->product_price_fix}} ₽</del>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="d-flex border-top pt-3 align-items-center justify-content-between">
                                        <input class="form-control me-2 form-control-sm" type="number" id="product_qty_{{$product->id}}" placeholder="{{__('main.Quantity')}}">
                                        <button class="btn btn-primary btn-sm add-to-cart" data-id="{{$product->id}}" type="submit">
                                            <i class="ci-cart fs-base ms-1"></i> {{__('main.Add')}}</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                            @endif
                        @endforeach
                    </div>
                </div>
                @endif
            @endforeach

        </div>

    </section>

@endsection

@section('script')
    <script>
        loadTab();
        function loadTab(){
            var url = window.location.href;
            var activeTab;
            if(url.substring(url.indexOf("#") + 1) != url){
                activeTab = url.substring(url.indexOf("#") + 1);
                console.log(activeTab);
            } else{
                return 0;
            }
            var TabEl = document.querySelector('.tab-store a[href="#'+ activeTab +'"]')
            var Tab = new bootstrap.Tab(TabEl)
            Tab.show()
        }
        function loadTabFromStore(nameTab){
            var TabEl = document.querySelector('.tab-store a[href="#tab_category_'+ nameTab +'"]')
            var Tab = new bootstrap.Tab(TabEl)
            Tab.show()
        }
    </script>
@endsection
