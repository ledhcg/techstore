    <script src="{{asset('public/admin/vendor/global/global.min.js')}}"></script>
	<script src="{{asset('public/admin/vendor/bootstrap-select/dist/js/bootstrap-select.min.js')}}"></script>
    <script src="{{asset('public/admin/js/custom.min.js')}}"></script>
	<script src="{{asset('public/admin/js/deznav-init.js')}}"></script>
	<script src="{{asset('public/admin/vendor/lightgallery/js/lightgallery-all.min.js')}}"></script>
	<script src="{{asset('public/admin/vendor/chart.js/Chart.bundle.min.js')}}"></script>
	<script src="{{asset('public/admin/vendor/bootstrap-datetimepicker/js/moment.js')}}"></script>
	<script src="{{asset('public/admin/vendor/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js')}}"></script>
	<!-- Chart piety plugin files -->
    <script src="{{asset('public/admin/vendor/peity/jquery.peity.min.js')}}"></script>

	<!-- Apex Chart -->
	<script src="{{asset('public/admin/vendor/apexchart/apexchart.js')}}"></script>

	<!-- Dashboard 1 -->
	<script src="{{asset('public/admin/js/dashboard/dashboard-1.js')}}"></script>

    <!-- Datatable -->
    <script src="{{asset('public/admin/vendor/datatables/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('public/admin/js/plugins-init/datatables.init.js')}}"></script>

    <script type="text/javascript">


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
