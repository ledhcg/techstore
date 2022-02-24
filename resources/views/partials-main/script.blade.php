<script src="{{asset('public/admin/vendor/global/global.min.js')}}"></script>
<!-- Vendor scrits: js libraries and plugins-->
<script src="{{asset('public/main/vendor/bootstrap/dist/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('public/main/vendor/simplebar/dist/simplebar.min.js')}}"></script>
<script src="{{asset('public/main/vendor/tiny-slider/dist/min/tiny-slider.js')}}"></script>
<script src="{{asset('public/main/vendor/smooth-scroll/dist/smooth-scroll.polyfills.min.js')}}"></script>
<!-- Main theme script-->
<script src="{{asset('public/main/js/theme.min.js')}}"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.6/cropper.js" integrity="sha256-CgvH7sz3tHhkiVKh05kSUgG97YtzYNnWt6OXcmYzqHY=" crossorigin="anonymous"></script>
<script src="https://api-maps.yandex.ru/2.1/?lang=ru_RU&amp;apikey=678c87c8-6536-44a1-bf09-2006ddd52d0b" type="text/javascript"></script>

<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/numeral.js/2.0.6/numeral.min.js"></script>

<script type="text/javascript" src="https://cdn.rawgit.com/mgalante/jquery.redirect/master/jquery.redirect.js"></script>

<script src="https://js.pusher.com/7.0/pusher-with-encryption.min.js"></script>
<script>

    var pusher = new Pusher('{{env("MIX_PUSHER_APP_KEY")}}', {
        cluster: '{{env("PUSHER_APP_CLUSTER")}}',
        encrypted: true
    });

    @if (Route::has('user.login'))
        @auth
    var channel = pusher.subscribe('htphodatviet');
    channel.bind('App\\Events\\UpdateChange', function(data) {
        if(data.user_id == {{Auth::user()->id}}){
            Toastify({
                text: "[" +data.order_tracking + "] - {{__('main.Order status has been changed')}}",
                duration: 7000,
                close: true,
                gravity: "bottom",
                position: "left",
                backgroundColor: "linear-gradient(to right, #00b09b, #96c93d)",
                stopOnFocus: true,
            }).showToast();
            reloadNotificationNavbar();
            if(typeof reloadNotification === "function"){
                reloadNotification();
            }
        }
    });

    reloadNotificationNavbar();
    function reloadNotificationNavbar(){
        var url = '{{ route("main.getUserUnreadNotifications") }}';
        $.ajax({
            type:'GET',
            url:url,
            success:function(data){
                var data_convert = jQuery.parseJSON(JSON.stringify(data));

                $('.view-notification-count').html(data_convert.count);

                //console.log(data.content);
                if(data_convert.count == 0){
                    $('#dropdown-notification').html(
                        `<div class="text-center pt-3">
                             <h2 class="h6">{{__('main.Empty list')}}</h2>
                         </div>`
                    )
                } else {
                    var html_dropdown_list_notifications = `<div style="height: 15rem;" data-simplebar data-simplebar-auto-hide="false" id="dropdown-list-notification">`;

                    data_convert.notifications.forEach(noti => {
                        html_dropdown_list_notifications +=  `
                            <div class="d-flex p-3 px-3 pt-3 pb-3 border-bottom">
                               <i class="ci-loudspeaker fs-lg mt-2 mb-0 text-primary"></i>
                                <div class="ps-3">
                                  <span class="fs-ms text-muted">`+ new Date(noti.created_at).toLocaleString() +`</span>
                                  <a class="d-block text-heading fs-sm pointer" data-id="`+ noti.id +`" data-order_tracking="`+ noti.data.order_tracking +`" onclick="goToOrderTracking(this)">[<strong>`+ noti.data.order_tracking +`</strong>] - {{__('main.Order status has been changed')}}</a>
                                </div>
                            </div>
                        `;
                    });
                    html_dropdown_list_notifications +=  `
                        </div>
                            <a class="btn btn-primary btn-sm d-block w-100 mt-3" href="{{route('user.notifications')}}">
                                <i class="ci-arrow-right-circle me-2 fs-base align-middle"></i>{{__('main.View all notifications')}}
                    </a>
`;

                    $('#dropdown-notification').html(html_dropdown_list_notifications);
                }
            }
        });
    }
        @endauth
    @endif


    //Formatter

    let formatter = new Intl.NumberFormat("ru", {
        style: "currency",
        currency: "RUB",
        minimumFractionDigits: 1
    });

    // ====== index.balde.php ====== //

    // Ajax for add to wishlist
    function addToWishlist(id){
        var url = '{{route("cart.addToWishlist")}}';
        $.ajax({
            type:'POST',
            url:url,
            data: {
                id: id,
                _token: '{{csrf_token()}}'
            },
            success:function(data){
                $('#button_action_wishlist_'+id).attr("onclick","removeFromWishlist("+id+")");
                $('#button_action_wishlist_'+id).html(`<i class="ci-star-filled text-primary"></i>`);
                $('#button_action_wishlist_all_'+id).attr("onclick","removeFromWishlist("+id+")");
                $('#button_action_wishlist_all_'+id).html(`<i class="ci-star-filled text-primary"></i>`);
            }
        });
    }

    //Remove From Wishlist
    function removeFromWishlist(id){
        var url = '{{route("cart.removeFromWishlist")}}';
        $.ajax({
            type:'POST',
            url:url,
            data: {
                id: id,
                _token: '{{csrf_token()}}'
            },
            success:function(data){
                $('#button_action_wishlist_'+id).attr("onclick","addToWishlist("+id+")");
                $('#button_action_wishlist_'+id).html(`<i class="ci-star"></i>`);
                $('#button_action_wishlist_all_'+id).attr("onclick","addToWishlist("+id+")");
                $('#button_action_wishlist_all_'+id).html(`<i class="ci-star"></i>`);
                reloadWishlist();
            }
        });
    }

    function showModalProductDetail(id){
        var myModal = new bootstrap.Modal(document.getElementById('quick-view'));
        myModal.show()
        var url = '{{ route("product.getProductByID", ":id") }}';
        url = url.replace(':id', id );
        $.get(url, function (product) {
            $("#modal_product_detail_image").attr("src",product.product_image_hd);
            console.log(product.product_image_hd);
            $('#modal_product_detail_name').html(product.details.product_name_{{config('app.locale')}});
            if(product.details.product_price_fix > 0){
                $('#modal_product_sale').html(`<span class="badge bg-primary">{{__('main.Sale')}}</span>`);
                $('#modal_product_detail_price').html(formatter.format(product.details.product_price_last)+` <del class="fs-sm text-muted">`+ formatter.format(product.details.product_price_fix) +`</del>`);
            } else {
                $('#modal_product_detail_price').html(formatter.format(product.details.product_price_last));
            }
            $('#modal_product_detail_category').html(product.category_name);

            $('#modal_product_detail_description').html(product.details.product_description_{{config('app.locale')}});

            $('#modal_product_alert_discount').html(product.alert_discount);

            $('#modal_product_id').val(id);
        })
    }

    function addToCartFromModal(){
        var quantity = 1;
        if($('#modal_product_detail_qty').val() != ''){
            if($('#modal_product_detail_qty').val() < 1){
                Toastify({
                    text: "{{__('notifications.ERROR.Invalid quantity')}}",
                    duration: 3000,
                    close: true,
                    gravity: "bottom",
                    position: "center",
                    backgroundColor: "#F55260",
                    stopOnFocus: true,
                }).showToast();
                return false;
            }else{
                quantity = $('#modal_product_detail_qty').val();
            };
        }
        var id = $('#modal_product_id').val();
        var url = '{{route("cart.addToCart")}}';
        $.ajax({
            type:'POST',
            url:url,
            data: {
                id: id,
                quantity: quantity,
                _token: '{{csrf_token()}}'
            },
            success:function(data){
                reloadCartNavbar();
                Toastify({
                    text: "{{__('notifications.SUCCESS.Add to cart')}}",
                    duration: 3000,
                    close: true,
                    gravity: "bottom",
                    position: "center",
                    backgroundColor: "#39DA8A",
                    stopOnFocus: true,
                }).showToast();
            }
        });
    }

    function addToCart(id){
        var quantity = 1;
        var url = '{{route("cart.addToCart")}}';
        $.ajax({
            type:'POST',
            url:url,
            data: {
                id: id,
                quantity: quantity,
                _token: '{{csrf_token()}}'
            },
            success:function(data){
                reloadCartNavbar();
                Toastify({
                    text: "{{__('notifications.SUCCESS.Add to cart')}}",
                    duration: 3000,
                    close: true,
                    gravity: "bottom",
                    position: "center",
                    backgroundColor: "#39DA8A",
                    stopOnFocus: true,
                }).showToast();
            }
        });
    }

    // Ajax for add to cart
    $(".add-to-cart").click(function(e){
        e.preventDefault();
        var id = $(this).data('id');

        var quantity = 1;

        if($('#product_qty_'+id).length){
            if($('#product_qty_'+id).val() != ''){
                if($('#product_qty_'+id).val() < 1){
                    Toastify({
                        text: "{{__('notifications.ERROR.Invalid quantity')}}",
                        duration: 3000,
                        close: true,
                        gravity: "bottom",
                        position: "center",
                        backgroundColor: "#F55260",
                        stopOnFocus: true,
                    }).showToast();
                    return false;
                }else{
                    quantity = $('#product_qty_'+id).val();
                };
            }
        };

        var url = '{{route("cart.addToCart")}}';
        $.ajax({
            type:'POST',
            url:url,
            data: {
                id: id,
                quantity: quantity,
                _token: '{{csrf_token()}}'
            },
            success:function(data){
                reloadCartNavbar();
                Toastify({
                    text: "{{__('notifications.SUCCESS.Add to cart')}}",
                    duration: 3000,
                    close: true,
                    gravity: "bottom",
                    position: "center",
                    backgroundColor: "#39DA8A",
                    stopOnFocus: true,
                }).showToast();
            }
        });
    });

    reloadCartNavbar();



    //Reload cart
    function reloadCartNavbar(){
        var url = '{{ route("cart.reloadCart") }}';
        $.ajax({
            type:'GET',
            url:url,
            success:function(data){
                var data_convert = jQuery.parseJSON(JSON.stringify(data));

                $('.view-subtotal').html(formatter.format(Number(data_convert.subtotal.replace(",", ".").replace(/[^0-9.-]+/g,""))));
                $('.view-cart-count').html(data_convert.count);

                //console.log(data.content);
                if(data_convert.count == 0){
                    $('#dropdown-cart').html(
                        `<div class="text-center pt-3">
                             <h2 class="h6">{{__('main.Empty-cart')}}</h2>
                         </div>`
                    )
                } else {
                    var html_dropdown_list_products = `<div style="height: 15rem;" data-simplebar data-simplebar-auto-hide="false" id="dropdown-list-product">`;

                    for (var product_id in data.content) {
                        var product = data.content[product_id];

                        html_dropdown_list_products +=  `
                        <div class="p-3 px-3 pt-3 pb-3 border-bottom">
                           <!-- <button class="btn-close text-danger remove-cart-item" data-id="`+ product.rowId +`" type="button" aria-label="Remove"><span aria-hidden="true">&times;</span></button>-->
                            <div class="d-flex align-items-center"><a class="flex-shrink-0"><img class="rounded-1" src="{{asset('data/images/upload/products')}}/` + product.options.product_image + `" width="64" alt="Product"></a>
                                <div class="ps-2">
                                    <h6 class="widget-product-title">` + product.options.product_name_{{config('app.locale')}} + `</h6>
                                    <div class="widget-product-meta"><span class="text-accent me-2">` + formatter.format(parseFloat(product.price)) + `</span><span class="text-muted">x ` + product.qty + `</span></div>
                                </div>
                            </div>
                        </div>
                        `;
                    }
                    html_dropdown_list_products +=  `
                        </div>
                                        <div class="d-flex flex-wrap justify-content-between align-items-center py-3">
                                            <div class="fs-sm me-2 py-2"><span class="text-muted">{{__('main.Subtotal')}}:</span><span class="text-accent fs-base ms-1 view-subtotal">` + formatter.format(Number(data_convert.subtotal.replace(",", ".").replace(/[^0-9.-]+/g,"")))  +`<!--<small>00</small>--></span></div><button class="btn btn-outline-secondary btn-sm" onclick="destroyCart()"><i class="ci-trash me-2 fs-base align-middle"></i>{{__('main.Destroy-cart')}}</button>
                                        </div>
                                        <a class="btn btn-primary btn-sm d-block w-100" href="{{route('main.cartDetails')}}">
                                            <i class="ci-basket me-2 fs-base align-middle"></i>{{__('main.Expand-cart')}}</a>
                        `;

                    $('#dropdown-cart').html(html_dropdown_list_products);
                }
            }
        });
    }

    //Destroy cart
    function destroyCart(){
        var url = '{{ route("cart.destroyCart") }}';
        $.ajax({
            type:'POST',
            url:url,
            data: {
                _token: '{{csrf_token()}}'
            },
            success:function(data){
                reloadCartNavbar();
                reloadCart();
            }
        });
    }

    function destroyWishlist(){
        var url = '{{ route("cart.destroyWishlist") }}';
        $.ajax({
            type:'POST',
            url:url,
            data: {
                _token: '{{csrf_token()}}'
            },
            success:function(data){
                reloadWishlist();
            }
        });
    }
    reloadWishlist();

    //Reload wishlist
    function reloadWishlist(){
        var url = '{{ route("cart.reloadWishlist") }}';
        $.ajax({
            type:'GET',
            url:url,
            success:function(data){
                var data_convert = jQuery.parseJSON(JSON.stringify(data));

                if(data_convert.count == 0){
                    $('#wishlist-list').html(
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
                            <div class="d-sm-flex justify-content-between mt-lg-4 mb-4 pb-3 pb-sm-2 border-bottom">
                              <div class="d-block d-sm-flex align-items-start text-center text-sm-start"><a class="d-block flex-shrink-0 mx-auto me-sm-4 pointer" onclick="showModalProductDetail(` + product.id + `)" style="width: 10rem;">
                              <img class="rounded-3" src="{{asset('data/images/upload/products')}}/` + product.options.product_image + `" alt="Product"></a>
                                <div class="pt-2">
                                  <h3 class="product-title fs-base mb-2"><a class="pointer" onclick="showModalProductDetail(` + product.id + `)">` + product.options.product_name_{{config('app.locale')}} + ` ` + html_sale + `</a></h3>
                                  <div class="fs-sm">` + product.options.category_name_{{config('app.locale')}} + `</div>
                                  `+html_alert_discount +`
                                  <div class="fs-lg text-accent pt-2">` + html_price + `</div>
                                </div>
                              </div>
                              <div class="pt-2 ps-sm-3 mx-auto mx-sm-0 text-center">
                                <button class="btn btn-outline-danger btn-sm" type="button" onclick="removeFromWishlist(` + product.id + `)"><i class="ci-trash me-2"></i>{{__('main.Remove')}}</button>
                              </div>
                            </div>
                        `;
                    }

                    $('#wishlist-list').html(html_list_products);
                }
            }
        });
    }




    //Update Item Quantity
    function updateItemQuantity(id){
        var quantity = $('#product_quantity_'+id).val();
        var rowId = $('#rowId_'+id).val();
        var url = '{{ route("cart.updateQuantity") }}';
        $.ajax({
            type:'POST',
            url:url,
            data: {
              rowId: rowId,
              quantity: quantity,
                _token: '{{csrf_token()}}'
            },
            success:function(data){
                reloadCart();
                reloadCartNavbar();
            }
        });
    }

    //Remove Item
    function removeItem(id){
        var rowId = $('#rowId_'+id).val();

        var url = '{{ route("cart.removeCartItem") }}';
        $.ajax({
            type:'POST',
            url:url,
            data: {
                rowId: rowId,
                _token: '{{csrf_token()}}'
            },
            success:function(data){
                reloadCart();
                reloadCartNavbar();
            }
        });
    }

    //Profile info change avatar

    $('#button-change-image').click(function (){
        $('#account-image').click();
    });


    var modal_crop = $('#modal_crop_image');
    var image_crop = document.getElementById('image_crop');
    var cropper;

    $("body").on("change", ".image_upload", function(e){
        var files = e.target.files;

        //Check File Image
        const file_check = this.files[0];
        var t = file_check.type.split('/').pop().toLowerCase();
        if (t != "jpeg" && t != "jpg" && t != "png" && t != "bmp" && t != "gif") {
            Toastify({
                text: "{{__('notifications.ERROR.Please select a valid image file')}}",
                duration: 3000,
                close: true,
                gravity: "bottom",
                position: "center",
                backgroundColor: "#F55260",
                stopOnFocus: true,
            }).showToast();
            document.getElementById('account-image').value = '';
            return false;
        }

        //Check File Size
        var fsize = (file_check.size / 1024 / 1024).toFixed(2);
        if (fsize > 2 ) {
            Toastify({
                text: "{{__('notifications.ERROR.Max upload size')}}",
                duration: 3000,
                close: true,
                gravity: "bottom",
                position: "center",
                backgroundColor: "#F55260",
                stopOnFocus: true,
            }).showToast();
            document.getElementById('account-image').value = '';
            return false;
        }

        var done = function (url) {
            image_crop.src = url;
            modal_crop.modal('show');
        };
        var reader;
        var file;
        var url;

        if (files && files.length > 0) {
            file = files[0];

            if (URL) {
                done(URL.createObjectURL(file));
            } else if (FileReader) {
                reader = new FileReader();
                reader.onload = function (e) {
                    done(reader.result);
                };
                reader.readAsDataURL(file);
            }
        }
    });

    modal_crop.on('shown.bs.modal', function () {
        cropper = new Cropper(image_crop, {
            aspectRatio: 1,
            viewMode: 3,
            preview: '.preview_image'
        });
    }).on('hidden.bs.modal', function () {
        cropper.destroy();
        cropper = null;
    });

    $("#crop").click(function(){
        canvas = cropper.getCroppedCanvas({
            width: 160,
            height: 160,
        });

        canvas.toBlob(function(blob) {
            url = URL.createObjectURL(blob);
            var reader = new FileReader();
            reader.readAsDataURL(blob);
            reader.onloadend = function() {
                var base64data = reader.result;
                var token = '{{csrf_token()}}';
                $.ajax({
                    type: "POST",
                    dataType: "json",
                    url: "{{route('user.updateAvatar')}}",
                    data: {
                        '_token': token,
                        'image': base64data,
                    },
                    success: function(data){
                        modal_crop.modal('hide');

                        $(".account-avatar").attr("src",data.url);

                        if(data.code == 1){
                            Toastify({
                                text: "{{__('notifications.SUCCESS.Change avatar')}}",
                                duration: 3000,
                                close: true,
                                gravity: "bottom",
                                position: "center",
                                backgroundColor: "#39DA8A",
                                stopOnFocus: true,
                            }).showToast();
                        } else {
                            Toastify({
                                text: "{{__('notifications.ERROR.Change avatar')}}",
                                duration: 3000,
                                close: true,
                                gravity: "bottom",
                                position: "center",
                                backgroundColor: "#F55260",
                                stopOnFocus: true,
                            }).showToast();
                        }

                    }
                });
            }
        });
    })


    $('#form-update-user').on('submit', function(e){
        e.preventDefault();
        var form = this;
        //$('#product-edit-spinner-loading').html('<span class="spinner-border spinner-border-sm"></span>');

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
                        //$('#product-edit-spinner-loading').html('');
                        $(form).find('span.'+prefix+'-error').text(val[0]);
                        $(form)[0].reset();
                    });
                    Toastify({
                        text: "{{__('notifications.ERROR.Update user')}}",
                        duration: 3000,
                        close: true,
                        gravity: "bottom",
                        position: "center",
                        backgroundColor: "#F55260",
                        stopOnFocus: true,
                    }).showToast();
                } else {

                    $(".account-name").text(data.name);
                    Toastify({
                        text: "{{__('nofitications.SUCCESS.Update user')}}",
                        duration: 3000,
                        close: true,
                        gravity: "bottom",
                        position: "center",
                        backgroundColor: "#39DA8A",
                        stopOnFocus: true,
                    }).showToast();
                }
            }
        });
    });

    $('#form-change-password').on('submit', function(e){
        e.preventDefault();
        var form = this;
        //$('#product-edit-spinner-loading').html('<span class="spinner-border spinner-border-sm"></span>');

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
                        //$('#product-edit-spinner-loading').html('');
                        $(form).find('span.'+prefix+'-error').text(val[0]);
                        $(form)[0].reset();
                    });
                    Toastify({
                        text: "{{__('notifications.ERROR.Update password')}}",
                        duration: 3000,
                        close: true,
                        gravity: "bottom",
                        position: "center",
                        backgroundColor: "#F55260",
                        stopOnFocus: true,
                    }).showToast();
                } else {
                    Toastify({
                        text: "{{__('notifications.SUCCESS.Update password')}}",
                        duration: 3000,
                        close: true,
                        gravity: "bottom",
                        position: "center",
                        backgroundColor: "#39DA8A",
                        stopOnFocus: true,
                    }).showToast();
                }
            }
        });
    });


    $(document).ready(function(){
        $("#input_search").keyup(function(){
            $("#search_keyword").val($("#input_search").val());
            $("#text_keyword").html($("#input_search").val());
            if($("#search_keyword").val()){
                $('#form-search').submit();
                $('#layout-search').show();
                $('#layout-content').hide();
            }else {
                $('#layout-search').hide();
                $('#layout-content').show();
            }
        });

        $("#input_search_mobile").keyup(function(){
            $("#search_keyword").val($("#input_search_mobile").val());
            $("#text_keyword").html($("#input_search_mobile").val());
            if($("#search_keyword").val()){
                $('#form-search').submit();
                $('#layout-search').show();
                $('#layout-content').hide();
            }else {
                $('#layout-search').hide();
                $('#layout-content').show();
            }
        });
    });

    $('#form-search').on('submit', function(e){
        e.preventDefault();

        $('#products-search').html(
        `<button class="btn btn-primary d-block w-100 mt-5" type="button">
                        <span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>
                        Loading...
                    </button>`
        );
        var form = this;

        $.ajax({
            url: $(form).attr('action'),
            method: $(form).attr('method'),
            dataType: 'json',
            contentType: false,
            processData: false,
            data: new FormData(this),
            success: function(data){
                if(data.result == false){
                    $('#products-search').html(`
                        <div class="d-sm-flex justify-content-center mt-4 mb-4 pb-2 pt-2">
                            <h5 class="text-center">{{__('notifications.No results found')}}</h2>
                        </div>
                    `);
                } else {
                    var html_list_products = ``;
                    for (var product_id in data.products) {
                        var product = data.products[product_id];

                        var html_name_category = ``;
                        var html_price = ``;
                        var html_sale = ``;
                        var html_alert_discount = ``;

                        for (var category_id in data.categories) {
                            var category = data.categories[category_id];
                            if(category.id == product.category_id){
                                var html_name_category = category.category_name_{{config('app.locale')}};
                            }
                        }
                        if(product.product_price_fix > 0){
                            html_sale += `<span class="badge bg-primary">{{__('main.Sale')}}</span> `
                            html_price += formatter.format(parseFloat(product.product_price_last)) +` <del class="fs-sm text-muted">`+formatter.format(parseFloat(product.product_price_fix))+ `</del>`;
                        } else {
                            html_price += formatter.format(parseFloat(product.product_price_last));
                        }

                        if(product.product_quantity_to_discount > 0){
                            html_alert_discount += `<span class="badge bg-success"><i>{{__('main.Quantity to discount')}}</i><strong>`+product.product_quantity_to_discount+`</strong></span>`
                        }

                        html_list_products +=  `
                            <div class="d-sm-flex justify-content-between mt-4 mb-4 pb-2 pt-2">
                              <div class="d-block d-sm-flex align-items-start text-center text-sm-start"><a class="d-block flex-shrink-0 mx-auto me-sm-4 pointer" style="width: 10rem;">
                              <img class="rounded-3" src="{{asset('data/images/upload/products')}}/` + product.product_image + `" alt="Product"></a>
                                <div class="pt-2">
                                  <h3 class="product-title fs-base mb-2"><a class="pointer">` + product.product_name_{{config('app.locale')}} + ` ` + html_sale + `</a></h3>
                                  <div class="fs-sm">` + html_name_category + `</div>
                                  `+html_alert_discount +`
                                  <div class="fs-lg text-accent pt-2">` + html_price + `</div>
                                </div>
                              </div>
                              <div class="pt-2 ps-sm-3 mx-auto mx-sm-0 text-center">
                                <button class="btn btn-primary btn-sm w-100" onclick="addToCart(` + product.id + `)">
                                                        <i class="ci-cart fs-sm me-1"></i>{{__('main.Add to cart')}}</button>
                              </div>
                            </div>
                            <div class="border-bottom"></div>
                        `;
                    }
                    $('#products-search').html(html_list_products);

                }
            }
        });
    });

    $('#tracking-btn').on('click', function(){
        var url = '{{ route("order.checkOrderTrackingExist", ":order_tracking") }}';
        url = url.replace(':order_tracking', $('#order-tracking-input').val());
        console.log(url);
        $.get(url, function (data) {
            if(data.isExist == 'YES'){
                var url = '{{route('main.orderTracking', ":id")}}';
                url = url.replace(':id', $('#order-tracking-input').val());
                let a= document.createElement('a');
                a.href= url;
                a.click();

            } else {
                $('#alert-error-order-tracking').html(`
                    <div class="alert alert-primary d-flex" role="alert">
                        <div class="alert-icon">
                            <i class="ci-bell"></i>
                        </div>
                        <div class="text-center">{{__('notifications.ERROR.Invalid order tracking')}}</div>
                    </div>
                `);
            }
        })
    });
    $('.clear-modal-order-tracking').on('click', function(){
       $('#alert-error-order-tracking').html(``);
    });


    function goToOrderTracking(order){
        var order_tracking = order.dataset.order_tracking;
        var notification_id = order.dataset.id;
        markAsRead(notification_id);
        var url = '{{route('main.orderTracking', ":id")}}';
        url = url.replace(':id', order_tracking);
        let a= document.createElement('a');
        a.href= url;
        a.target = '_blank';
        a.click();
    }

    function markAsRead(id){
        var url = '{{route('notification.markAsReadNotificationUser')}}';
        $.ajax({
            type:'POST',
            url:url,
            data: {
                id: id,
                _token: '{{csrf_token()}}'
            },
            success:function(data){
                if(data.success == 1){
                    reloadNotificationNavbar();
                    if(typeof reloadNotification === "function"){
                        reloadNotification();
                    }
                }
            }
        });
    }



</script>

@yield('script')
