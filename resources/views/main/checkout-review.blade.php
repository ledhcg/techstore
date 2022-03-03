@extends('layouts.main-layout-white')

@section('title')
    <title>TECHSTORE</title>
@endsection

@section('content')
    <div class="page-title-overlap bg-dark pt-4">
        <div class="container d-lg-flex justify-content-between py-2 py-lg-3">
            <div class="order-lg-2 mb-3 mb-lg-0 pt-lg-2">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-light flex-lg-nowrap justify-content-center justify-content-lg-start">
                        <li class="breadcrumb-item"><a class="text-nowrap" href="{{route('main.home')}}"><i class="ci-home"></i>{{__('main.Home')}}</a></li>
                        <li class="breadcrumb-item text-nowrap active" aria-current="page">{{__('main.Checkout')}}</li>
                    </ol>
                </nav>
            </div>
            <div class="order-lg-1 pe-lg-4 text-center text-lg-start">
                <h1 class="h3 text-light mb-0">{{__('main.Checkout')}}</h1>
            </div>
        </div>
    </div>
    <div class="container pb-5 mb-2 mb-md-4">
        <form id="form-complete-order-online" action="{{route('user.payment.create')}}" method="post">
            @csrf
        <div class="row">
            <!-- List of items-->
            <section class="col-lg-7">
                <div class="d-flex justify-content-between align-items-center pt-3 pb-4 pb-sm-5 mt-1">
                    <h2 class="h6 text-light mb-0">{{__('main.Review your order')}}</h2><a class="btn btn-outline-primary btn-sm ps-2" href="{{route('main.store')}}"><i class="ci-arrow-left me-2"></i>{{__('main.Continue-shopping')}}</a>
                </div>
                <div id="cart-review-details">
                    <!--Loading-->
                    <button class="btn btn-primary d-block w-100 mt-4" type="button">
                        <span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>
                        Loading...
                    </button>
                    <div class="border-bottom p-3 pt-2"></div>
                </div>

                <!-- Navigation (desktop)-->
                <div class="d-none d-lg-flex pt-4">
                    <div class="w-50 pe-3"><a class="btn btn-secondary d-block w-100" href="{{route('main.cartDetails')}}"><i class="ci-arrow-left mt-sm-0 me-1"></i><span class="d-none d-sm-inline">{{__('main.Back')}}</span><span class="d-inline d-sm-none">{{__('main.Back')}}</span></a></div>
                    <div class="w-50 ps-2"><a class="btn btn-primary d-block w-100" onclick="completeOrder()"><span class="d-none d-sm-inline">{{__('main.Complete order')}}</span><span class="d-inline d-sm-none">{{__('main.Complete')}}</span><i class="ci-arrow-right mt-sm-0 ms-1"></i></a></div>
                </div>
            </section>
            <!-- Sidebar-->
            <aside class="col-lg-5 pt-4 pt-lg-0 ps-xl-5">

                <div class="bg-white rounded-3 shadow-lg p-4 ms-lg-auto">
                    <div class="py-2 px-xl-2">
                        <h2 class="h4 text-center mb-4">{{__('main.Order summary')}}</h2>
                        <div class="border-bottom"></div>
                        <div class="border-bottom pt-3">
                            <h4 class="h6 text-primary">{{__('main.Shipping to')}}:</h4>
                            <ul class="list-unstyled fs-sm">
                                <li><span class="text-muted">{{__('main.Full name')}}:&nbsp;</span><strong>{{$client_name}}</strong></li>
                                <li><span class="text-muted">{{__('main.Address')}}:&nbsp;</span><strong>{{$client_address}}</strong></li>
                                <li><span class="text-muted">{{__('main.Phone number')}}:&nbsp;</span><strong>{{$client_phone}}</strong></li>
                                <li><span class="text-muted">{{__('main.Email')}}:&nbsp;</span><strong>{{$client_email}}</strong></li>
                                <!--INPUT HIDDEN -->
                                <input type="hidden" name="client_name" value="{{$client_name}}">
                                <input type="hidden" name="client_address" value="{{$client_address}}">
                                <input type="hidden" name="client_phone" value="{{$client_phone}}">
                                <input type="hidden" name="client_email" value="{{$client_email}}">
                            </ul>
                        </div>

                        <div class="border-bottom pt-3">
                            <h4 class="h6 text-primary">{{__('main.Order details')}}:</h4>
                            <ul class="list-unstyled fs-sm">
                                <li><span class="text-muted">{{__('main.Order ID')}}:&nbsp;</span>
                                    @if($order_tracking == null)
                                        <strong>{{__('main.NULL')}}</strong>
                                    @else
                                        <strong>{{$order_tracking}}</strong>
                                        <input type="hidden" id="order_tracking" name="order_tracking" value="{{$order_tracking}}">
                                    @endif
                                </li>
                                @if($description != null)
                                    <input type="hidden" id="description" name="description" value="{{$description}}">
                                @endif
                                <li><span class="text-muted">{{__('main.Payment method')}}:&nbsp;</span>
                                    @if($order_payment == null)
                                        <strong>{{__('main.NULL')}}</strong>
                                    @else
                                        @foreach($dataPaymentMethods as $paymentMethod)
                                            @if($paymentMethod->id == $order_payment)
                                                <strong>{{__('main.'.$paymentMethod->name)}}</strong>
                                                <input type="hidden" id="order_payment" name="order_payment" value="{{$order_payment}}">
                                            @endif
                                        @endforeach
                                    @endif
                                </li>
                                <li><span class="text-muted">{{__('main.Message')}}:&nbsp;</span>
                                    <strong>
                                        @if($order_note == null)
                                            {{__('main.NULL')}}
                                        @else
                                            <strong>{{($order_note)}}</strong>
                                            <textarea type="hidden" id="order_note" name="order_note" style="display:none;">{{$order_note}}</textarea>
                                        @endif
                                    </strong>
                                </li>
                                @if($order_ship != null) <input type="hidden" id="order_ship" name="order_ship" value="{{$order_ship}}"> @endif
                            </ul>
                        </div>

                        <!--INPUT HIDDEN -->
                        @if($order_discount != null)
                            <input type="hidden" id="order_discount" name="order_discount" value="{{$order_discount}}">
                        @endif


                        <div id="order-summary">
                            <!--Loading-->
                            <button class="btn btn-primary d-block w-100 mt-4" type="button">
                                <span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>
                                Loading...
                            </button>
                        </div>
                    </div>
                </div>

            </aside>
        </div>
        <!-- Navigation (mobile)-->
        <div class="row d-lg-none">
            <div class="col-lg-8">
                <div class="d-flex pt-4 mt-3">
                    <div class="w-50 pe-3"><a class="btn btn-secondary d-block w-100" href="{{route('main.cartDetails')}}"><i class="ci-arrow-left mt-sm-0 me-1"></i><span class="d-none d-sm-inline">{{__('main.Back')}}</span><span class="d-inline d-sm-none">{{__('main.Back')}}</span></a></div>
                    <div class="w-50 ps-2"><a class="btn btn-primary d-block w-100" onclick="completeOrder()"><span class="d-none d-sm-inline">{{__('main.Complete order')}}</span><span class="d-inline d-sm-none">{{__('main.Complete')}}</span><i class="ci-arrow-right mt-sm-0 ms-1"></i></a></div>
                </div>
            </div>
        </div>
        </form>
    </div>

    <form id="form-complete-order-cash" action="{{route('user.order.create')}}" method="post">
        @csrf
        <input type="hidden" name="client_name" value="{{$client_name}}">
        <input type="hidden" name="client_address" value="{{$client_address}}">
        <input type="hidden" name="client_phone" value="{{$client_phone}}">
        <input type="hidden" name="client_email" value="{{$client_email}}">

            @if($order_tracking != null)
                <input type="hidden" name="order_tracking" value="{{$order_tracking}}">
            @endif
            @if($description != null)
                <input type="hidden" name="description" value="{{$description}}">
            @endif=
            @if($order_payment != null)
                <input type="hidden" name="order_payment" value="{{$order_payment}}">
            @endif
            @if($order_note != null)
                <textarea type="hidden" id="order_note" name="order_note" style="display:none;">{{$order_note}}</textarea>
            @endif
            @if($order_ship != null)
                <input type="hidden" id="order_ship" name="order_ship" value="{{$order_ship}}">
            @endif
            @if($order_discount != null)
            <input type="hidden" id="order_discount" name="order_discount" value="{{$order_discount}}">
            @endif
            <input type="hidden" class="order-total" name="order_total">
    </form>
@endsection

@section('script')
    <script>
        reloadCartReview();
        function reloadCartReview(){
            var url = '{{ route("cart.reloadCart") }}';
            $.ajax({
                type:'GET',
                url:url,
                success:function(data){
                    var data_convert = jQuery.parseJSON(JSON.stringify(data));

                    if(data_convert.count == 0){
                        $('#cart-review-details').html(
                            `<div class="text-center pt-3">
                             <h2 class="h6">{{__('main.Empty list')}}</h2>
                         </div>`
                        );

                        $('#order-summary').html(
                            `<h3 class="fw-normal text-center pt-4">` + formatter.format(0) + `</h3>`
                        )
                    } else {
                        var html_list_products = ``;

                        var html_order_summary = ``;

                        for (var product_id in data.content) {
                            var product = data.content[product_id];

                            var shipping_fee;
                            if($('#order_ship').val()){
                                shipping_fee = $('#order_ship').val();
                            } else {
                                shipping_fee = 0;
                            }
                            var string_subtotal = data.subtotal.toLocaleString().replace(/\D/g,'');
                            var num_subtotal = parseFloat(string_subtotal)/10;

                            var total = parseFloat(shipping_fee) + num_subtotal;

                            var html_price = ``;
                            var html_sale = ``;
                            var html_alert_discount = ``;
                            if(product.options.product_price_fix > 0){
                                html_sale += `<span class="badge bg-primary">{{__('main.Sale')}}</span> `
                                html_price += formatter.format(parseFloat(product.options.product_price_last)) +` <del class="fs-sm text-muted">`+formatter.format(parseFloat(product.options.product_price_fix))+ `</del>`;
                            } else {
                                html_price += formatter.format(parseFloat(product.options.product_price_last));
                            }

                            if(product.options.product_quantity_to_discount > 0){
                                html_alert_discount += `<span class="badge bg-success"><i>{{__('main.Quantity to discount')}}</i><strong>`+product.options.product_quantity_to_discount+`</strong></span>`
                            }

                            html_list_products +=  `
                            <div class="d-sm-flex justify-content-between my-4 pb-3 border-bottom">
                                <div class="d-sm-flex text-center text-sm-start">
                                    <a class="d-inline-block flex-shrink-0 mx-auto me-sm-4">
                                        <img class="rounded-3" src="{{asset('data/images/upload/products')}}/` + product.options.product_image + `" width="160" alt="Product">
                                    </a>
                                    <div class="pt-2">
                                        <h3 class="product-title fs-base mb-2"><a>` + product.options.product_name_{{config('app.locale')}} + ` `+html_sale+`</a></h3>
                                        <div class="fs-sm"><span class="text-muted me-2">Size:</span>8.5</div>
                                        <div class="fs-sm"><span class="text-muted me-2">{{__('main.Category')}}:</span>`+product.options.category_name_{{config('app.locale')}}+`</div>
                                        <div class="fs-lg text-accent pt-2">` + html_price + `</div>
                                    </div>
                                </div>
                                <div class="pt-2 pt-sm-0 ps-sm-3 mx-auto mx-sm-0 text-center text-sm-end" style="max-width: 9rem;">
                                    <p class="mb-0"><span class="text-muted fs-sm">{{__('main.Quantity')}}:</span><span>&nbsp;`+ product.qty +`</span></p>
                                </div>
                            </div>
                        `;


                        }
                        html_order_summary = `
                             <ul class="list-unstyled fs-sm pb-2 pt-3 border-bottom">
                                <li class="d-flex justify-content-between align-items-center"><span class="me-2">{{__('main.Subtotal')}}:</span><span class="text-end">` + formatter.format(num_subtotal) + `</span></li>
                                <li class="d-flex justify-content-between align-items-center"><span class="me-2">{{__('main.Shipping fee')}}:</span><span class="text-end">` + formatter.format(shipping_fee) + `</span></li>
                            </ul>
                            <h3 class="fw-normal text-center pt-4"><strong>` + formatter.format(total) + `</strong></h3>
                            <input type="hidden" id="amount" name="amount" value="`+ total +`">
                        `;

                        $('#cart-review-details').html(html_list_products);
                        $('#order-summary').html(html_order_summary);
                        $('.order-total').val(total);
                    }
                }
            });
        }

        function completeOrder(){
            if($('#amount').val() > 0){
                if($('#order_payment').val()
                    && $('#order_note').val()
                    && $('#order_ship').val()
                    && $('#order_discount').val()
                    && $('#order_tracking').val()
                    && $('#description').val()
                ){
                    if($('#order_payment').val() == 2){
                        console.log('abc');
                        $('#form-complete-order-online').submit();
                    }else if($('#order_payment').val() == 1){
                        console.log('cda');
                        $('#form-complete-order-cash').submit();
                    }

                } else {
                    Toastify({
                        text: "{{__('notifications.ERROR.Message complete order')}}",
                        duration: 3000,
                        close: true,
                        gravity: "bottom",
                        position: "center",
                        backgroundColor: "#F55260",
                        stopOnFocus: true,
                    }).showToast();
                    return 0;
                }
            } else {
                Toastify({
                    text: "{{__('notifications.ERROR.Message total invalid')}}",
                    duration: 3000,
                    close: true,
                    gravity: "bottom",
                    position: "center",
                    backgroundColor: "#F55260",
                    stopOnFocus: true,
                }).showToast();
                return 0;
            }


        }
    </script>

@endsection


