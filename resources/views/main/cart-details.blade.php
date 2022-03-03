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
                        <li class="breadcrumb-item text-nowrap active" aria-current="page">{{__('main.Cart')}}</li>
                    </ol>
                </nav>
            </div>
            <div class="order-lg-1 pe-lg-4 text-center text-lg-start">
                <h1 class="h3 text-light mb-0">{{__('main.Your-cart')}}</h1>
            </div>
        </div>
    </div>
    <div class="container pb-5 mb-2 mb-md-4">
        <div class="row">
            <!-- List of items-->
            <section class="col-lg-7">
                <div class="d-flex justify-content-between align-items-center pt-3 pb-4 pb-sm-5 mt-1">
                    <h2 class="h6 text-light mb-0">{{__('main.Products')}}</h2><a class="btn btn-outline-primary btn-sm ps-2" href="{{route('main.store')}}"><i class="ci-arrow-left me-2"></i>{{__('main.Continue-shopping')}}</a>
                </div>
                <!-- Products -->
                <div id="cart-details">
                    <!--Loading-->
                    <button class="btn btn-primary d-block w-100 mt-4" type="button">
                        <span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>
                        Loading...
                    </button>
                    <div class="border-bottom p-3 pt-2"></div>
                </div>
                <button class="btn btn-outline-accent d-block w-100 mt-4" onclick="destroyCart()" type="button"><i class="ci-trash fs-base me-2"></i>{{__('main.Destroy-cart')}}</button>
            </section>
            <!-- Sidebar-->
            <aside class="col-lg-5 pt-4 pt-lg-0 ps-xl-5">
                <div class="bg-white rounded-3 shadow-lg p-4">
                    <div class="py-2 px-xl-2">
                        <div class="text-center mb-4 pb-3 border-bottom">
                            <h2 class="h4 mb-3">{{__('main.Cart-details')}}</h2>
                        </div>

                        @if(Auth()->user())
                            <form id="form-add-order" action="{{route('user.addOrderToReview')}}" method="post">
                                @csrf
                                <div class="mb-3 mb-4">
                                    <label class="form-label mb-3" for="order-comments"><span class="badge bg-info fs-xs me-2">Note</span><span class="fw-medium">{{__('main.Message')}}</span></label>
                                    <textarea class="form-control" rows="4" id="order_note" name="order_note"></textarea>
                                </div>

                                <div class="accordion" id="order-options">
                                    <div class="accordion-item">
                                        <h3 class="accordion-header"><a class="accordion-button" href="#client-info" role="button" data-bs-toggle="collapse" aria-expanded="true" aria-controls="promo-code">{{__('main.Client info')}}</a></h3>
                                        <div class="accordion-collapse collapse show" id="client-info" data-bs-parent="#order-options">
                                            <div class="accordion-body">
                                                <div class="mb-3">
                                                    <label for="client_name" class="form-label">{{__('main.Full name')}}</label>
                                                    <input class="form-control" type="text" id="client_name" name="client_name" placeholder="{{__('main.Full name')}}" value="{{Auth()->user()->name}}" >

                                                    <span class="text-danger small text-error client_name-error"></span>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="clientemail" class="form-label">{{__('main.Email')}}</label>
                                                    <input class="form-control" type="text" id="client_email" name="client_email" placeholder="{{__('main.Email')}}" value="{{Auth()->user()->email}}" >

                                                    <span class="text-danger small text-error client_email-error"></span>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="client_phone" class="form-label">{{__('main.Phone number')}}</label>
                                                    <input class="form-control" type="text" id="client_phone" name="client_phone" placeholder="{{__('main.Phone number')}}" value="{{Auth()->user()->phone}}" >

                                                    <span class="text-danger small text-error client_phone-error"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <input type="hidden" class="input-order_discount" name="order_discount" value="0">
                                    <input type="hidden" class="input-order_tracking" name="order_tracking" value="">
                                    <input type="hidden" class="input-description" name="description" value="">

                                    <div class="accordion-item">
                                        <h3 class="accordion-header"><a class="accordion-button" href="#shipping-estimates" role="button" data-bs-toggle="collapse" aria-expanded="true" aria-controls="shipping-estimates">{{__('main.Shipping estimates')}}</a></h3>
                                        <div class="accordion-collapse collapse show" id="shipping-estimates" data-bs-parent="#order-options">
                                            <div class="accordion-body">
                                                    <div class="mb-3">
                                                        <label for="client_address" class="form-label">{{__('main.Address')}}</label>
                                                        <input class="form-control" type="text" id="choose-address" name="client_address" placeholder="{{__('main.Address')}}" value="{{Auth()->user()->address}}" >
                                                        <span class="text-danger small text-error client_address-error"></span>
                                                    </div>
                                                    <div id="map-yandex" style="display: none"></div>
                                                    <ul class="list-unstyled fs-sm pb-2 border-bottom">
                                                        <li class="d-flex justify-content-between align-items-center"><span class="me-2">{{__('main.Distance')}}:</span><span class="text-end view-distance">—</span></li>
                                                        <li class="d-flex justify-content-between align-items-center"><span class="me-2">{{__('main.Shipping fee')}}:</span><span class="text-end view-shipping-fee">—</span></li>
                                                        <span class="text-danger small text-error order_ship-error"></span>
                                                    </ul>
                                                    <a class="btn btn-outline-primary d-block w-100" id="calculate-ship">{{__('main.Calculate shipping')}}</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="accordion-item">
                                        <h3 class="accordion-header"><a class="accordion-button" href="#paymend-method" role="button" data-bs-toggle="collapse" aria-expanded="true" aria-controls="promo-code">{{__('main.Choose payment method')}}</a></h3>
                                        <div class="accordion-collapse collapse show" id="paymend-method" data-bs-parent="#order-options">
                                            <div class="accordion-body">
                                                @foreach($dataPaymentMethods as $paymentMethod)
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="order_payment" value="{{$paymentMethod->id}}" @if($paymentMethod->id == 1) checked @endif>
                                                    <label class="form-check-label" for="radio-1">{{__('main.'.$paymentMethod->name)}}</label>
                                                </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="p-3 border-bottom mb-4 pb-3"></div>
                                <ul class="list-unstyled fs-sm pb-2 border-bottom">
                                    <li class="d-flex justify-content-between align-items-center"><span class="me-2">{{__('main.Subtotal')}}:</span><span class="text-end view-subtotal">—</span></li>
                                    <input type="hidden" class="input-subtotal" value="0">
                                    <li class="d-flex justify-content-between align-items-center"><span class="me-2">{{__('main.Shipping fee')}}:</span><span class="text-end view-shipping-fee">—</span></li>
                                    <input type="hidden" class="input-shipping-fee" name="order_ship">
                                    <span class="text-danger small text-error order_total-error"></span>
                                </ul>
                        @else
                            <a class="btn btn-primary btn-shadow d-block w-100 mt-4" href="{{route('user.login')}}"><i class="ci-sign-in fs-lg me-2"></i>{{__('main.Sign in to pay')}}</a>
                            <div class="p-3 border-bottom mb-4 pb-3"></div>
                        @endif



                        <div class="text-center pt-2">
                            <h3 class="fw-normal"><strong class="view-total">—</strong></h3>
                            <input type="hidden" class="total" name="order_total">
                        </div>

                        @if(Auth()->user())
                                <button class="btn btn-primary btn-shadow d-block w-100 mt-4" type="submit"><i class="ci-bag fs-lg me-2"></i>{{__('main.Continue')}}</button>
                            </form>
                        @endif
                    </div>
                </div>
            </aside>
        </div>
    </div>
@endsection

@section('script')
    <script>

        create_order_id();
        function create_order_id()
        {
            var order_id_text = $.now().toString().slice(3);
            $('.input-order_tracking').val(order_id_text);
            $('.input-description').val(`Order ID: `+ order_id_text);
        }

        reloadCart();

        //Reload cart
        function reloadCart(){
            var url = '{{ route("cart.reloadCart") }}';
            $.ajax({
                type:'GET',
                url:url,
                success:function(data){
                    var data_convert = jQuery.parseJSON(JSON.stringify(data));

                    if(data_convert.count == 0){
                        $('#cart-details').html(
                            `<div class="text-center pt-3">
                             <h2 class="h6">{{__('main.Empty list')}}</h2>
                         </div>`
                        )
                    } else {
                        var html_list_products = ``;

                        for (var product_id in data.content) {
                            var product = data.content[product_id];

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
                            <div class="d-sm-flex justify-content-between align-items-center my-2 pb-3 border-bottom">
                                <div class="d-block d-sm-flex align-items-center text-center text-sm-start">
                                    <a class="d-inline-block flex-shrink-0 mx-auto me-sm-4">
                                        <img class="rounded-3" src="{{asset('data/images/upload/products')}}/` + product.options.product_image + `" width="160" alt="Product">
                                    </a>
                                    <div class="pt-2">
                                        <h3 class="product-title fs-base mb-2"><a>` + product.options.product_name_{{config('app.locale')}} + ` `+html_sale+`</a></h3>
                                        <div class="fs-sm"><span class="text-muted me-2">`+product.options.category_name_{{config('app.locale')}}+`</span></div>
                                        `+html_alert_discount+`
                                        <div class="fs-lg text-accent pt-2">` + html_price + `</div>
                                    </div>
                                </div>
                                <div class="pt-2 pt-sm-0 ps-sm-3 mx-auto mx-sm-0 text-center text-sm-start" style="max-width: 9rem;">
                                    <label class="form-label" for="quantity1">{{__('main.Quantity')}}</label>
                                    <input class="form-control" type="number" id="product_quantity_`+product.id+`" min="1" value="`+ product.qty +`" onchange="updateItemQuantity('`+product.id+`')">
                                    <input type="hidden" id="rowId_`+product.id+`" value='`+product.rowId+`'>
                                    <a class="btn btn-link px-0 text-danger" onclick="removeItem(`+product.id+`)"><i class="ci-close-circle me-2"></i><span class="fs-sm">{{__('main.Remove')}}</span></a>
                                </div>
                            </div>
                        `;
                        }

                        $('#cart-details').html(html_list_products);


                    }

                    var string_subtotal = data.subtotal.toLocaleString().replace(/\D/g,'');
                    var num_subtotal = parseFloat(string_subtotal)/10;

                    $('.view-subtotal').html(formatter.format(num_subtotal));
                    $('.input-subtotal').val(num_subtotal);

                    var total;
                    if($('.input-shipping-fee').val()){
                        if($('.input-shipping-fee').val() != ''){
                            total = parseFloat($('.input-shipping-fee').val()) + num_subtotal;
                        } else{
                            total = num_subtotal;
                        }
                    }else{
                        total = num_subtotal;
                    }
                    $('.view-total').html(formatter.format(total));
                    $('.total').val(total);
                }
            });
        }

        //Yandex API
        ymaps.ready(init);
        function init() {
        var chooseAddress = new ymaps.SuggestView('choose-address');

        $('#choose-address').on('change', function(){
            if($('#choose-address').val() == ''){
                $('.input-shipping-fee').val('');
                $('.view-shipping-fee').html('—');
                $('.view-distance').html('—');
                reloadCart();
            }
        });

            @if($dataShippingFee)

            chooseAddress.events.add("select", function(e) {

                var SHIPPING_CHARGES = {{$dataShippingFee->SHIPPING_CHARGES}},
                    // Минимальная стоимость.
                    MINIMUM_COST = {{$dataShippingFee->MINIMUM_COST}},
                    MIN_TOTAL_TO_GET_FREE = {{$dataShippingFee->MIN_TOTAL_TO_GET_FREE}},
                    MAX_DISTANCE_TO_GET_FREE = {{$dataShippingFee->MAX_DISTANCE_TO_GET_FREE}},

                myMap = new ymaps.Map('map-yandex', {
                        center: [60.906882, 30.067233],
                        zoom: 9,
                        controls: []
                    }),



                    // Создадим панель маршрутизации.
                    routePanelControl = new ymaps.control.RoutePanel({
                        options: {
                            // Добавим заголовок панели.
                            showHeader: true,
                            title: 'Расчёт доставки'
                        }
                    }),
                    zoomControl = new ymaps.control.ZoomControl({
                        options: {
                            size: 'small',
                            float: 'none',
                            position: {
                                bottom: 145,
                                right: 10
                            }
                        }
                    });
                // Пользователь сможет построить только автомобильный маршрут.
                routePanelControl.routePanel.options.set({
                    types: {auto: true}
                });

                var address1 = '{{config('app.address')}}';
                var address2 = e.get('item').value;

                // Если вы хотите задать неизменяемую точку "откуда", раскомментируйте код ниже.
                //Dia chi co dinh cua nha hang
                routePanelControl.routePanel.state.set({
                    fromEnabled: false,
                    from: address1,
                    toEnabled:false,
                    to: address2,
                });

                myMap.controls.add(routePanelControl).add(zoomControl);

                // Получим ссылку на маршрут.
                routePanelControl.routePanel.getRouteAsync().then(function (route) {

                    // Зададим максимально допустимое число маршрутов, возвращаемых мультимаршрутизатором.
                    route.model.setParams({results: 1}, true);

                    // Повесим обработчик на событие построения маршрута.
                    route.model.events.add('requestsuccess', function () {

                        var activeRoute = route.getActiveRoute();
                        if (activeRoute) {

                            // Получим протяженность маршрута.
                            var length = route.getActiveRoute().properties.get("distance"),
                                // Вычислим стоимость доставки.
                                price = calculate(Math.round(length.value / 1000), $('.input-subtotal').val());



                            var total = parseFloat($('.input-subtotal').val()) + parseFloat(price);

                            $('.view-distance').html(length.text);
                            $('.view-shipping-fee').html(formatter.format(price));
                            $('.input-shipping-fee').val(price);
                            $('.view-total').html(formatter.format(total));



                            // Создадим макет содержимого балуна маршрута.
                            var balloonContentLayout = ymaps.templateLayoutFactory.createClass(
                                '<span>Расстояние: ' + length.text + '.</span><br/>' +
                                '<span style="font-weight: bold; font-style: italic">Стоимость доставки: ' + price + ' р.</span>');
                            // Зададим этот макет для содержимого балуна.
                            route.options.set('routeBalloonContentLayout', balloonContentLayout);
                            // Откроем балун.
                            activeRoute.balloon.open();
                        }
                    });

                });
                // Функция, вычисляющая стоимость доставки.
                function calculate(routeLength, total) {
                    if(total > MIN_TOTAL_TO_GET_FREE || routeLength < MAX_DISTANCE_TO_GET_FREE){
                        return 0;
                    } else {
                        return Math.max(routeLength * SHIPPING_CHARGES, MINIMUM_COST);
                    }
                }
            })

            $("#calculate-ship").click(function(){
                calculateShipFromAddress();
            });

            //calculateShipFromAddress();

            function calculateShipFromAddress(){

                var SHIPPING_CHARGES = {{$dataShippingFee->SHIPPING_CHARGES}},
                    // Минимальная стоимость.
                    MINIMUM_COST = {{$dataShippingFee->MINIMUM_COST}},
                    MIN_TOTAL_TO_GET_FREE = {{$dataShippingFee->MIN_TOTAL_TO_GET_FREE}},
                    MAX_DISTANCE_TO_GET_FREE = {{$dataShippingFee->MAX_DISTANCE_TO_GET_FREE}},
                    myMap = new ymaps.Map('map-yandex', {
                        center: [60.906882, 30.067233],
                        zoom: 9,
                        controls: []
                    }),



                    // Создадим панель маршрутизации.
                    routePanelControl = new ymaps.control.RoutePanel({
                        options: {
                            // Добавим заголовок панели.
                            showHeader: true,
                            title: 'Расчёт доставки'
                        }
                    }),
                    zoomControl = new ymaps.control.ZoomControl({
                        options: {
                            size: 'small',
                            float: 'none',
                            position: {
                                bottom: 145,
                                right: 10
                            }
                        }
                    });
                // Пользователь сможет построить только автомобильный маршрут.
                routePanelControl.routePanel.options.set({
                    types: {auto: true}
                });

                var address1 = '{{config('app.address')}}';
                var address2 = $('#choose-address').val();

                // Если вы хотите задать неизменяемую точку "откуда", раскомментируйте код ниже.
                //Dia chi co dinh cua nha hang
                routePanelControl.routePanel.state.set({
                    fromEnabled: false,
                    from: address1,
                    toEnabled:false,
                    to: address2,
                });

                myMap.controls.add(routePanelControl).add(zoomControl);

                // Получим ссылку на маршрут.
                routePanelControl.routePanel.getRouteAsync().then(function (route) {

                    // Зададим максимально допустимое число маршрутов, возвращаемых мультимаршрутизатором.
                    route.model.setParams({results: 1}, true);

                    // Повесим обработчик на событие построения маршрута.
                    route.model.events.add('requestsuccess', function () {

                        var activeRoute = route.getActiveRoute();
                        if (activeRoute) {

                            // Получим протяженность маршрута.
                            var length = route.getActiveRoute().properties.get("distance"),
                                // Вычислим стоимость доставки.
                                // price = calculate(Math.round(length.value / 1000));
                                price = calculate(Math.round(length.value / 1000), $('.input-subtotal').val());



                            var total = parseFloat($('.input-subtotal').val()) + parseFloat(price);

                            $('.view-distance').html(length.text);
                            $('.view-shipping-fee').html(formatter.format(price));
                            $('.input-shipping-fee').val(price);
                            $('.view-total').html(formatter.format(total));



                            // Создадим макет содержимого балуна маршрута.
                            var balloonContentLayout = ymaps.templateLayoutFactory.createClass(
                                '<span>Расстояние: ' + length.text + '.</span><br/>' +
                                '<span style="font-weight: bold; font-style: italic">Стоимость доставки: ' + price + ' р.</span>');
                            // Зададим этот макет для содержимого балуна.
                            route.options.set('routeBalloonContentLayout', balloonContentLayout);
                            // Откроем балун.
                            activeRoute.balloon.open();
                        }
                    });

                });
                // Функция, вычисляющая стоимость доставки.
                function calculate(routeLength, total) {
                    if(total > MIN_TOTAL_TO_GET_FREE || routeLength < MAX_DISTANCE_TO_GET_FREE){
                        return 0;
                    } else {
                        return Math.max(routeLength * SHIPPING_CHARGES, MINIMUM_COST);
                    }
                }
            };

            @endif


        }

        //Order


        $('#form-add-order').on('submit', function(e){
            e.preventDefault();

            var form = this;

            $.ajax({
                url: $(form).attr('action'),
                method: $(form).attr('method'),
                dataType: 'json',
                contentType: false,
                processData: false,
                data: new FormData(this),
                beforeSend:function (){
                    $(form).find('span.text-error').text('');
                },
                success: function(data){
                    if(data.code == 0){
                        $.each(data.error, function(prefix, val){
                            $(form).find('span.'+prefix+'-error').text(val[0]);
                        });
                        Toastify({
                            text: "{{__('notifications.ERROR.Please try again')}}",
                            duration: 3000,
                            close: true,
                            gravity: "bottom",
                            position: "center",
                            backgroundColor: "#F55260",
                            stopOnFocus: true,
                        }).showToast();
                        return 0;
                    }else {
                        {{--$.redirect('{{route('checkoutReview')}}', {--}}
                        {{--    '_token': '{{ csrf_token() }}',--}}
                        {{--    'client_name': data.client_name,--}}
                        {{--    'client_email' : data.client_email,--}}
                        {{--    'client_phone' : data.client_phone,--}}
                        {{--    'client_address' : data.client_address,--}}
                        {{--});--}}

                        window.location.replace("{{route('user.checkoutReview')}}");

                    }
                }
            });
        });

    </script>
@endsection
