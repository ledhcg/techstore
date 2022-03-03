    <script src="{{asset('public/admin/vendor/global/global.min.js')}}"></script>
	<script src="{{asset('public/admin/vendor/bootstrap-select/dist/js/bootstrap-select.min.js')}}"></script>
    <script src="{{asset('public/admin/js/custom.min.js')}}"></script>
	<script src="{{asset('public/admin/js/deznav-init.js')}}"></script>
	<script src="{{asset('public/admin/vendor/lightgallery/js/lightgallery-all.min.js')}}"></script>
	<script src="{{asset('public/admin/vendor/chart.js/Chart.bundle.min.js')}}"></script>
	<script src="{{asset('public/admin/vendor/bootstrap-datetimepicker/js/moment.js')}}"></script>
	<script src="{{asset('public/admin/vendor/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js')}}"></script>

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="{{asset('public/admin/vendor/toastr/js/toastr.min.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/howler/2.2.3/howler.min.js" integrity="sha512-6+YN/9o9BWrk6wSfGxQGpt3EUK6XeHi6yeHV+TYD2GR0Sj/cggRpXr1BrAQf0as6XslxomMUxXp2vIl+fv0QRA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/push.js/1.0.8/push.min.js" integrity="sha512-eiqtDDb4GUVCSqOSOTz/s/eiU4B31GrdSb17aPAA4Lv/Cjc8o+hnDvuNkgXhSI5yHuDvYkuojMaQmrB5JB31XQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    {{--	<!-- Chart piety plugin files -->--}}
{{--    <script src="{{asset('public/admin/vendor/peity/jquery.peity.min.js')}}"></script>--}}

{{--	<!-- Apex Chart -->--}}
{{--	<script src="{{asset('public/admin/vendor/apexchart/apexchart.js')}}"></script>--}}

{{--	<!-- Dashboard 1 -->--}}
{{--	<script src="{{asset('public/admin/js/dashboard/dashboard-1.js')}}"></script>--}}

    <!-- Datatable -->
    <script src="{{asset('public/admin/vendor/datatables/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('public/admin/js/plugins-init/datatables.init.js')}}"></script>
    <script src="https://js.pusher.com/7.0/pusher-with-encryption.min.js"></script>
    <!-- css.gg -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tabler-icons/1.35.0/iconfont/tabler-icons.min.css" integrity="sha512-tpsEzNMLQS7w9imFSjbEOHdZav3/aObSESAL1y5jyJDoICFF2YwEdAHOPdOr1t+h8hTzar0flphxR76pd0V1zQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <script>

        var pusher = new Pusher('{{env("MIX_PUSHER_APP_KEY")}}', {
            cluster: '{{env("PUSHER_APP_CLUSTER")}}',
            encrypted: true
        });

        var channel = pusher.subscribe('techstore');
        channel.bind('App\\Events\\newOrder', function(data) {
            reloadListNotifications();
            reloadListNotificationsDashboard();
            toastr.success("Đơn hàng mới đã được tạo.", data.order_tracking, {
                timeOut: 5000,
                closeButton: !0,
                debug: !1,
                newestOnTop: !0,
                progressBar: !0,
                positionClass: "toast-bottom-left",
                preventDuplicates: !0,
                onclick: null,
                showDuration: "300",
                hideDuration: "1000",
                extendedTimeOut: "1000",
                showEasing: "swing",
                hideEasing: "linear",
                showMethod: "fadeIn",
                hideMethod: "fadeOut",
                tapToDismiss: !1
            });
            Push.create(data.order_tracking, {
                body: "Đơn hàng mới đã được tạo.",
                icon: '{{asset('public/admin/images/logo.png')}}',
                timeout: 10000,
                onClick: function () {
                    window.focus();
                    this.close();
                }
            });
            sound.play();
        });

        $('body').one('keypress click', function() {
            let buttonStartAudioContext = document.getElementById('start-audio-context');
            startAudioContext(buttonStartAudioContext);
        });
        function startAudioContext(e){
            e.classList.remove("btn-primary");
            e.classList.add("btn-success");
            e.innerHTML = `<i class="fa fa-volume-off" aria-hidden="true"></i> ĐÃ BẬT CHUÔNG`;
        };


        var sound = new Howl({
            src: ['{{asset('public/admin/sound/noti1.mp3')}}'],
            loop: true,
            volume: 1,
            onend: function() {
                // console.log('New sound!');
            }
        });

        setInterval(autoDeleteOrder, 300000);
        // autoDeleteOrder();
        function autoDeleteOrder(){
            var url = '{{route('order.autoDeleteOrder')}}';
            $.ajax({
                type: 'POST',
                url: url,
                data: {
                    _token: '{{csrf_token()}}'
                },
                success: function (data) {
                }
            });
        }

        function markAsRead(notification) {
            var id = notification.dataset.id;
            var url = '{{route('notification.markAsReadNotificationAdmin')}}';
            $.ajax({
                type: 'POST',
                url: url,
                data: {
                    id: id,
                    _token: '{{csrf_token()}}'
                },
                success: function (data) {
                    if (data.success == 1) {
                        reloadListNotifications();
                    }
                }
            });
        }

        function markAllAsRead(){
            var url = '{{route('notification.markAllAsReadNotificationsAdmin')}}';
            $.ajax({
                type: 'POST',
                url: url,
                data: {
                    _token: '{{csrf_token()}}'
                },
                success: function (data) {
                    if (data.success == 1) {
                        reloadListNotifications();
                        reloadListNotificationsDashboard();
                    }
                }
            });
        }

        function goToOrderTracking(order){
            var order_tracking = order.dataset.order_tracking;
            var notification_id = order.dataset.id;
            markAsRead(notification_id);
            var url = '{{route('main.orderTracking', ":id")}}';
            url = url.replace(':id', order_tracking);
            let a= document.createElement('a');
            a.href= url;
            a.target = '_blank',
            a.click();
        }

        function changeOrderStatus(selectObject){
            var order_id = selectObject.dataset.id;
            var order_status = selectObject.value;
            $.ajax({
                type: "POST",
                url: "{{ route('order.changeOrderStatus') }}",
                data: {
                    order_id:order_id,
                    order_status: order_status,
                    _token: '{{ csrf_token() }}'
                },
                success: function (data) {
                    alert(data.msg);
                },
                error: function (data) {
                    console.log('Error:', data);
                }
            });
        }

        // ===== START Product ===== //

        //Send data to database
        $('#form-insert-product').on('submit', function(e){
            e.preventDefault();
            var form = this;
            $('#spinner-loading').html('<span class="spinner-border spinner-border-sm"></span>');

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
                        $('#spinner-loading').html('');
                        $.each(data.error, function(prefix, val){
                            $(form).find('span.'+prefix+'-error').text(val[0]);
                        });
                    }else {
                        $(form)[0].reset();
                        $('#spinner-loading').html('');
                        alert(data.msg);
                    }
                }
            });
        });

        //Get products data to datatable
        $(function () {
            var table = $('#product-datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('product.getProducts') }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {
                        data: 'product_image',
                        name: 'product_image',
                        orderable: false,
                        searchable: false
                    },
                    {data: 'product_name_vi', name: 'product_name_vi'},
                    {data: 'product_name_ru', name: 'product_name_ru'},
                    {data: 'product_price_last', name: 'product_price_last'},
                    {data: 'product_price_fix', name: 'product_price_fix'},
                    {data: 'product_price_discount', name: 'product_price_discount'},
                    {data: 'product_status', name: 'product_status'},
                    {data: 'category_name', name: 'category_name'},
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ]
            });


            //Get product by id
            $('body').on('click', '.editProduct', function () {
                var id = $(this).data("id");
                var url = '{{ route("product.adminGetProductByID", ":id") }}';
                url = url.replace(':id', id );
                $.get(url, function (product) {
                    $("#product-image-preview_edit").attr("src",product.product_image);
                    $('#product_id_edit').val(product.details.id);
                    $('#product_name_vi_edit').val(product.details.product_name_vi);
                    $('#product_name_ru_edit').val(product.details.product_name_ru);
                    $('#p_category_id_edit').val(product.details.category_id).change();;
                    $('#product_price_last_edit').val(product.details.product_price_last);
                    $('#product_price_fix_edit').val(product.details.product_price_fix);
                    $('#product_price_discount_edit').val(product.details.product_price_discount);
                    $('#product_unit_vi_edit').val(product.details.product_unit_vi);
                    $('#product_unit_ru_edit').val(product.details.product_unit_ru);
                    $('#product_quantity_to_discount_edit').val(product.details.product_quantity_to_discount);
                    $('#product_description_vi_edit').val(product.details.product_description_vi);
                    $('#product_description_ru_edit').val(product.details.product_description_ru);
                    $('#product_status_edit').val(product.details.product_status).change();;
                })
            });

            //Delete product item
            $('body').on('click', '.deleteProduct', function (){
                var product_id = $(this).data("id");
                var result = confirm("Are you sure want to delete !");
                if(result){
                    $.ajax({
                        type: "POST",
                        url: "{{ route('product.delete') }}",
                        data: {
                            product_id:product_id,
                            _token: '{{ csrf_token() }}'
                        },
                        success: function (data) {
                            table.draw();
                            alert(data.msg);
                        },
                        error: function (data) {
                            console.log('Error:', data);
                        }
                    });
                }else{
                    return false;
                }
            });

            //Update product item
            $('#form-edit-product').on('submit', function(e){
                e.preventDefault();
                var form = this;
                $('#product-edit-spinner-loading').html('<span class="spinner-border spinner-border-sm"></span>');

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
                                $('#product-edit-spinner-loading').html('');
                                $(form).find('span.'+prefix+'-error').text(val[0]);
                            });
                        } else {
                            $(form)[0].reset();
                            $('#product-edit-spinner-loading').html('');
                            $('.modal-edit-product').modal('hide');
                            table.draw();
                            console.log(data.msg);
                        }
                    }
                });
            });

        });

        if(document.getElementById('product_image')){
            document.getElementById('product_image').onchange = function () {
                readURL(this, 'product-image-preview');
            };
        }

        if(document.getElementById('product_image_edit')){
            document.getElementById('product_image_edit').onchange = function () {
                readURL(this, 'product-image-preview_edit');
            };
        }

        // ===== END Product ===== //


        // ===== START Category ===== //

            //Send data to database
        $('#form-insert-category').on('submit', function(e){
            e.preventDefault();
            var form = this;
            $('#spinner-loading').html('<span class="spinner-border spinner-border-sm"></span>');

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
                        $('#spinner-loading').html('');
                        $.each(data.error, function(prefix, val){
                            $(form).find('span.'+prefix+'-error').text(val[0]);
                        });
                    }else {
                        $(form)[0].reset();
                        $('#spinner-loading').html('');
                        alert(data.msg);
                    }
                }
            });
        });

            //Get categories data to datatable
        $(function () {
            var table = $('#category-datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('category.getCategories') }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {
                        data: 'category_image',
                        name: 'category_image',
                        orderable: false,
                        searchable: false
                    },
                    {data: 'category_name_vi', name: 'category_name_vi'},
                    {data: 'category_name_ru', name: 'category_name_ru'},
                    {data: 'category_status', name: 'category_status'},
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ]
            });


            //Get category by id
            $('body').on('click', '.editCategory', function () {
                var id = $(this).data("id");
                var url = '{{ route("category.adminGetCategoryByID", ":id") }}';
                url = url.replace(':id', id );
                $.get(url, function (category) {
                    $("#category-image-preview_edit").attr("src",category.category_image);
                    $('#category_id_edit').val(category.details.id);
                    $('#category_name_vi_edit').val(category.details.category_name_vi);
                    $('#category_name_ru_edit').val(category.details.category_name_ru);
                    $('#category_status_edit').val(category.details.category_status).change();;
                })
            });

            //Delete category item
            $('body').on('click', '.deleteCategory', function (){
                var category_id = $(this).data("id");
                var result = confirm("Are you sure want to delete !");
                if(result){
                    $.ajax({
                        type: "POST",
                        url: "{{ route('category.delete') }}",
                        data: {
                            category_id:category_id,
                            _token: '{{ csrf_token() }}'
                        },
                        success: function (data) {
                            table.draw();
                            alert(data.msg);
                        },
                        error: function (data) {
                            console.log('Error:', data);
                        }
                    });
                }else{
                    return false;
                }
            });

            //Update category item
            $('#form-edit-category').on('submit', function(e){
                e.preventDefault();
                var form = this;
                $('#category-edit-spinner-loading').html('<span class="spinner-border spinner-border-sm"></span>');

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
                                $('#category-edit-spinner-loading').html('');
                                $(form).find('span.'+prefix+'-error').text(val[0]);
                            });
                        }else {
                            $(form)[0].reset();
                            $('#category-edit-spinner-loading').html('');
                            $('.modal-edit-category').modal('hide');
                            table.draw();
                            alert(data.msg);
                        }
                    }
                });
            });

        });

        if(document.getElementById('category_image')){
            document.getElementById('category_image').onchange = function () {
                readURL(this, 'category-image-preview');
            };
        }

        if(document.getElementById('category_image_edit')){
            document.getElementById('category_image_edit').onchange = function () {
                readURL(this, 'category-image-preview_edit');
            };
        }

        // ===== END Category ===== //

        $(function () {
            var table = $('#user-datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('admin.getUsers') }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'name', name: 'name'},
                    {data: 'gender', name: 'gender'},
                    {data: 'phone', name: 'phone'},
                    {data: 'address', name: 'address'},
                    {data: 'email', name: 'email'}
                ]
            });
        });

        $(function () {
            var table = $('#order-datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('admin.getOrders')}}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'client_name', name: 'client_name'},
                    {data: 'client_email', name: 'client_email'},
                    {data: 'client_phone', name: 'client_phone'},
                    {data: 'order_total', name: 'order_total'},
                    {data: 'order_tracking', name: 'order_tracking'},
                    {data: 'order_status', name: 'order_status'},
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ]
            });
        });

        $(function () {
            var table = $('#order-created-datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('admin.getOrdersCreated')}}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'client_name', name: 'client_name'},
                    {data: 'client_email', name: 'client_email'},
                    {data: 'client_phone', name: 'client_phone'},
                    {data: 'order_total', name: 'order_total'},
                    {data: 'order_tracking', name: 'order_tracking'},
                    {data: 'order_status', name: 'order_status'},
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ]
            });
        });

        $(function () {
            var table = $('#order-received-datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('admin.getOrdersReceived')}}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'client_name', name: 'client_name'},
                    {data: 'client_email', name: 'client_email'},
                    {data: 'client_phone', name: 'client_phone'},
                    {data: 'order_total', name: 'order_total'},
                    {data: 'order_tracking', name: 'order_tracking'},
                    {data: 'order_status', name: 'order_status'},
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ]
            });
        });

        $(function () {
            var table = $('#order-delivering-datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('admin.getOrdersDelivering')}}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'client_name', name: 'client_name'},
                    {data: 'client_email', name: 'client_email'},
                    {data: 'client_phone', name: 'client_phone'},
                    {data: 'order_total', name: 'order_total'},
                    {data: 'order_tracking', name: 'order_tracking'},
                    {data: 'order_status', name: 'order_status'},
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ]
            });
        });

        $(function () {
            var table = $('#order-delete-datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('admin.getOrdersDelete')}}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'client_name', name: 'client_name'},
                    {data: 'client_email', name: 'client_email'},
                    {data: 'client_phone', name: 'client_phone'},
                    {data: 'order_total', name: 'order_total'},
                    {data: 'order_tracking', name: 'order_tracking'},
                    {data: 'order_status', name: 'order_status'},
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ]
            });
        });

        $(function () {
            var table = $('#order-delivered-datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('admin.getOrdersDelivered')}}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'client_name', name: 'client_name'},
                    {data: 'client_email', name: 'client_email'},
                    {data: 'client_phone', name: 'client_phone'},
                    {data: 'order_total', name: 'order_total'},
                    {data: 'order_tracking', name: 'order_tracking'},
                    {data: 'order_status', name: 'order_status'},
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ]
            });
        });



        // ===== START Order ===== //

        //Get order by id
        $('body').on('click', '.viewNewOrder', function () {
            $('.modal-body').hide();
            $('.modal-loading').show();
            $('.no_content').html(``);
            var order_tracking = $(this).data("order_tracking");
            var notification_id = $(this).data("id");
            $('#NO_order_tracking').html(order_tracking);
            var url = '{{ route("order.adminGetOrderByID", ":order_tracking") }}';
            url = url.replace(':order_tracking', order_tracking );
            $.get(url, function (order) {
                $("#NO_name").html(order.orderInfo.client_name);
                $('#NO_phone').html(order.orderInfo.client_phone);
                $('#NO_address').html(order.orderInfo.client_address);
                $('#NO_email').html(order.orderInfo.client_email);
                $('#NO_note').html(order.orderInfo.order_note);
                var table_order_details = ``;
                var count = 1;
                $.each(order.orderDetails, function( key, value ) {
                    table_order_details +=`
                        <tr>
                           <td><strong>`+ count +`</strong></td>
                           <td>`+ value.product_id+`</td>
                           <td>`+ value.product_quantity +`</td>
                        </tr>
                    `;
                    count++;
                });
                $('.tb-order-details').html(table_order_details);
                $('.modal-body').show();
                $('.modal-loading').hide();
                $('.button-accept-order').attr('onclick', 'sendMarkRequest('+notification_id+')');
            })
        });


        //Get order details by order_tracking
        $('body').on('click', '.viewOrder', function () {

            var order_tracking = $(this).data("id");

            var url_get = '{{ route("admin.getOrderByID", ":order_tracking") }}';
            url_get = url_get.replace(':order_tracking', order_tracking );
            $.get(url_get, function (order) {
                $("#od_client_name").html(order.client_name);
                $("#od_client_address").html(order.client_address);
                $('#od_client_email').html(order.client_email);
                $('#od_client_phone').html(order.client_phone);
                $('#od_amount').html(order.order_total + ' ₽');
                $('#od_ship').html(order.order_ship + ' ₽');
                $('#od_id_tracking').html(order.order_tracking);
                $('#od_status').html(order.order_status);
                $('#od_note').html(order.order_note);
                $('#created_at').html(new Date(order.created_at).toLocaleString());
            })

            var url = '{{route("admin.getOrderDetails", ":order_tracking")}}';
            url = url.replace(':order_tracking', order_tracking );
            var table1 = $('#order-details-datatable').DataTable({
                processing: true,
                serverSide: true,
                destroy: true,
                ajax: url,
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'product_name', name: 'product_name'},
                    {data: 'product_price', name: 'product_price'},
                    {data: 'product_quantity', name: 'product_quantity'}
                ]
            });
        });

        function reloadListNotifications(){
            var url = '{{ route("notification.getAdminUnreadNotifications") }}';
            $.ajax({
                type:'GET',
                url:url,
                success:function(data){
                    var data_convert = jQuery.parseJSON(JSON.stringify(data));

                    $('.view-notification-count').html(data_convert.count);

                    if(data_convert.count == 0){
                        $('#dropdown-notification').html(
                            `Không có đơn hàng mới.`
                        )
                    } else {
                        var html_dropdown_list_notifications = ``;

                        data_convert.notifications.forEach(noti => {
                            html_dropdown_list_notifications +=  `
                                                <li>
                                                    <a href="{{route('admin.all-orders-created')}}" onclick="markAsRead(this)" data-id="`+ noti.id +`">
                                                        <div class="timeline-panel">
                                                            <div class="media mr-2">
                                                                <svg width="28" height="28" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                    <path d="M22.75 15.8385V13.0463C22.7471 10.8855 21.9385 8.80353 20.4821 7.20735C19.0258 5.61116 17.0264 4.61555 14.875 4.41516V2.625C14.875 2.39294 14.7828 2.17038 14.6187 2.00628C14.4546 1.84219 14.2321 1.75 14 1.75C13.7679 1.75 13.5454 1.84219 13.3813 2.00628C13.2172 2.17038 13.125 2.39294 13.125 2.625V4.41534C10.9736 4.61572 8.97429 5.61131 7.51794 7.20746C6.06159 8.80361 5.25291 10.8855 5.25 13.0463V15.8383C4.26257 16.0412 3.37529 16.5784 2.73774 17.3593C2.10019 18.1401 1.75134 19.1169 1.75 20.125C1.75076 20.821 2.02757 21.4882 2.51969 21.9803C3.01181 22.4724 3.67904 22.7492 4.375 22.75H9.71346C9.91521 23.738 10.452 24.6259 11.2331 25.2636C12.0142 25.9013 12.9916 26.2497 14 26.2497C15.0084 26.2497 15.9858 25.9013 16.7669 25.2636C17.548 24.6259 18.0848 23.738 18.2865 22.75H23.625C24.321 22.7492 24.9882 22.4724 25.4803 21.9803C25.9724 21.4882 26.2492 20.821 26.25 20.125C26.2486 19.117 25.8998 18.1402 25.2622 17.3594C24.6247 16.5786 23.7374 16.0414 22.75 15.8385ZM7 13.0463C7.00232 11.2113 7.73226 9.45223 9.02974 8.15474C10.3272 6.85726 12.0863 6.12732 13.9212 6.125H14.0788C15.9137 6.12732 17.6728 6.85726 18.9703 8.15474C20.2677 9.45223 20.9977 11.2113 21 13.0463V15.75H7V13.0463ZM14 24.5C13.4589 24.4983 12.9316 24.3292 12.4905 24.0159C12.0493 23.7026 11.716 23.2604 11.5363 22.75H16.4637C16.284 23.2604 15.9507 23.7026 15.5095 24.0159C15.0684 24.3292 14.5411 24.4983 14 24.5ZM23.625 21H4.375C4.14298 20.9999 3.9205 20.9076 3.75644 20.7436C3.59237 20.5795 3.50014 20.357 3.5 20.125C3.50076 19.429 3.77757 18.7618 4.26969 18.2697C4.76181 17.7776 5.42904 17.5008 6.125 17.5H21.875C22.571 17.5008 23.2382 17.7776 23.7303 18.2697C24.2224 18.7618 24.4992 19.429 24.5 20.125C24.4999 20.357 24.4076 20.5795 24.2436 20.7436C24.0795 20.9076 23.857 20.9999 23.625 21Z" fill="#007A64"/>
                                                                </svg>
                                                            </div>
                                                            <div class="media-body">
                                                                <h6 class="mb-1">Đơn hàng `+ noti.data.order_tracking +` đã được tạo.</h6>
                                                                <small class="d-block">`+ new Date(noti.created_at).toLocaleString() +`</small>
                                                            </div>
                                                        </div>
                                                    </a>

                                                </li>
                        `;
                        });
                        $('#dropdown-notification').html(html_dropdown_list_notifications);
                    }
                }
            });
        }

        function reloadListNotificationsDashboard(){
            var url = '{{ route("notification.getAdminUnreadNotifications") }}';
            $.ajax({
                type:'GET',
                url:url,
                success:function(data){
                    var data_convert = jQuery.parseJSON(JSON.stringify(data));

                    if(data_convert.count == 0){
                        $('#list-notification-dashboard').html(
                            `Không có đơn hàng mới.`
                        )
                    } else {
                        var html_dropdown_list_notifications = `
                                                <div class="pb-2">
                                                    <a class="pointer" onclick="markAllAsRead()">
                                                        Đánh dấu đã đọc tất cả
                                                    </a>
                                                </div>`
                        ;

                        data_convert.notifications.forEach(noti => {
                            html_dropdown_list_notifications +=  `
                                                <a href="{{route('admin.all-orders-created')}}" onclick="markAsRead(this)" data-id="`+ noti.id +`">
                                                    <div class="alert alert-success pointer" role="alert">
                                                         [`+ noti.data.order_tracking +`] Đơn hàng <strong>`+ noti.data.order_tracking +`</strong> đã được tạo thành công.
                                                    </div>
                                                </a>
                        `;
                        });
                        $('#list-notification-dashboard').html(html_dropdown_list_notifications);
                    }
                }
            });
        }

    </script>
	<script>

		$('#lightgallery').lightGallery({
			thumbnail:true,
		});

		$(function () {
			$('#datetimepicker1').datetimepicker({
				inline: true,
			});
		});


        //Preview image





        if(document.getElementById('file-upload')){
            document.getElementById('file-upload').onchange = function () {
                readURL(this, 'imagePreview');
            };
        }

        if(document.getElementById('file-upload_edit')){
            document.getElementById('file-upload_edit').onchange = function () {
                readURL(this, 'imagePreview_edit');
            };
        }

        function readURL(input, id_image) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                document.getElementById(id_image).src = e.target.result;
                }
                reader.readAsDataURL(input.files[0]);
            }
        }



	</script>
