<!-- Edit product modal -->

<div class="modal fade modal-edit-product" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Chỉnh sửa sản phẩm</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                </button>
            </div>
            <form id="form-edit-product" action="{{route('product.update')}}" method="post" enctype="multipart/form-data">
                @csrf
                <input id="product_id_edit" name="product_id_edit" type="hidden">
                    <div class="row">
                        <div class="col-xl-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="profile-blog mb-5">
                                        <h4 class="text-primary d-inline">Ảnh sản phẩm</h4>
                                        <img id="product-image-preview_edit" src="{{asset('public/admin/images/upload_image.jpg')}}" alt="" class="img-fluid mt-4 mb-4 w-100">
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="product_image_edit" name="product_image_edit">
                                                <label class="custom-file-label">Chọn ảnh ...</label>
                                            </div>
                                        </div>
                                        <span class="text-danger text-error product_image-error"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-8">
                            <div class="card">
                                <div class="card-body">
                                    <div class="settings-form">
                                        <h4 class="text-primary">Thông tin sản phẩm</h4>
                                        <div class="mt-4 mb-4 w-100">
                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label><strong>Tên sản phẩm (Tiếng Việt)</strong></label>
                                                    <input name="product_name_vi_edit"  id="product_name_vi_edit" type="text" placeholder="Ví dụ: Phở Gà" class="form-control">
                                                    <span class="text-danger text-error product_name_vi_edit-error"></span>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label><strong>Tên sản phẩm (Tiếng Nga)</strong></label>
                                                    <input name="product_name_ru_edit" id="product_name_ru_edit" type="text" placeholder="Ví dụ: Фо Га" class="form-control">
                                                    <span class="text-danger text-error product_name_ru_edit-error"></span>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="form-group col-md-4">
                                                    <label><strong>Giá bán cuối (RUB)</strong></label>
                                                    <input name="product_price_last_edit" id="product_price_last_edit" type="number" placeholder="Ví dụ: 300" class="form-control">
                                                    <span class="text-danger text-error product_price_last_edit-error"></span>
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label><strong>Giá cũ (RUB)</strong></label>
                                                    <input name="product_price_fix_edit" id="product_price_fix_edit" type="number" placeholder="Ví dụ: 300" class="form-control">
                                                    <span class="text-danger text-error product_price_fix_edit-error"></span>
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label><strong>Giá có chiết khấu (RUB)</strong></label>
                                                    <input name="product_price_discount_edit" id="product_price_discount_edit" type="number" placeholder="Ví dụ: 300" class="form-control">
                                                    <span class="text-danger text-error product_price_discount_edit-error"></span>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label><strong>Số lượng để nhận chiết khấu</strong></label>
                                                    <input name="product_quantity_to_discount_edit" id="product_quantity_to_discount_edit" type="number" placeholder="Ví dụ: 300" class="form-control">
                                                    <span class="text-danger text-error product_quantity_to_discount_edit-error"></span>
                                                </div>
                                                <div class="form-group col-md-3">
                                                    <label><strong>Đơn vị (Tiếng Việt)</strong></label>
                                                    <input name="product_unit_vi_edit" id="product_unit_vi_edit" type="text" placeholder="Ví dụ: bát" class="form-control">
                                                    <span class="text-danger text-error product_unit_vi_edit-error"></span>
                                                </div>
                                                <div class="form-group col-md-3">
                                                    <label><strong>Đơn vị (Tiếng Nga)</strong></label>
                                                    <input name="product_unit_ru_edit" id="product_unit_ru_edit" type="text" placeholder="Ví dụ: bát" class="form-control">
                                                    <span class="text-danger text-error product_unit_ru_edit-error"></span>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label><strong>Trạng thái sản phẩm</strong></label>
                                                    <select class="form-control default-select" id="product_status_edit" name="product_status_edit">
                                                        <option value="{{\App\Enums\StatusEnum::ACTIVE}}">Đang kinh doanh</option>
                                                        <option value="{{\App\Enums\StatusEnum::INACTIVE}}">Ngừng kinh doanh</option>
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label><strong>Danh mục sản phẩm</strong></label>
                                                    <select class="form-control default-select" id="p_category_id_edit" name="p_category_id_edit">
                                                        <option selected="">Chọn...</option>
                                                        @foreach($dataCategories as $option){
                                                        <option value="{{$option->id}}">{{$option->category_name_vi}}</option>
                                                        @endforeach
                                                    </select>
                                                    <span class="text-danger text-error p_category_id_edit-error"></span>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label><strong>Mô tả sản phẩm (Tiếng Việt)</strong></label>
                                                <textarea name="product_description_vi_edit" id="product_description_vi_edit" class="form-control" rows="5"></textarea>
                                            </div>
                                            <span class="text-danger text-error product_description_vi_edit-error"></span>
                                            <div class="form-group">
                                                <label><strong>Mô tả sản phẩm (Tiếng Nga)</strong></label>
                                                <textarea name="product_description_ru_edit" id="product_description_ru_edit" class="form-control" rows="5"></textarea>
                                            </div>
                                            <span class="text-danger text-error product_description_ru_edit-error"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <div class="modal-footer">
                    <button class="btn btn-danger light" data-dismiss="modal">Đóng</button>
                    <button class="btn btn-primary" type="submit">Lưu <span id="product-edit-spinner-loading"></span></button>
                </div>
            </form>

        </div>
    </div>
</div>



<!-- Edit category modal -->

<div class="modal fade modal-edit-category" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Chỉnh sửa danh mục sản phẩm</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                </button>
            </div>
            <form id="form-edit-category" action="{{route('category.update')}}" method="post" enctype="multipart/form-data">
                @csrf
                <input id="category_id_edit" name="category_id_edit" type="hidden">
                <div class="row">
                    <div class="col-xl-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="profile-blog mb-5">
                                    <h4 class="text-primary d-inline">Ảnh sản phẩm</h4>
                                    <img id="category-image-preview_edit" src="{{asset('public/admin/images/upload_image.jpg')}}" alt="" class="img-fluid mt-4 mb-4 w-100">
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="category_image_edit" name="category_image_edit">
                                            <label class="custom-file-label">Chọn ảnh ...</label>
                                        </div>
                                    </div>
                                    <span class="text-danger text-error category_image_edit-error"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-8">
                        <div class="card">
                            <div class="card-body">
                                <div class="settings-form">
                                    <h4 class="text-primary">Thông tin danh mục sản phẩm</h4>
                                    <div class="mt-4 mb-4 w-100">
                                        <div class="form-row">
                                            <div class="col-xl-6">
                                                <div class="form-group">
                                                    <label><strong>Tên danh mục sản phẩm (VI)</strong></label>
                                                    <input type="text" class="form-control" id="category_name_vi_edit" name="category_name_vi_edit" placeholder="VD: Đồ ăn">
                                                    <span class="text-danger text-error category_name_vi_edit-error"></span>
                                                </div>
                                            </div>
                                            <div class="col-xl-6">
                                                <div class="form-group">
                                                    <label><strong>Tên danh mục sản phẩm (RU)</strong></label>
                                                    <input type="text" class="form-control" id="category_name_ru_edit" name="category_name_ru_edit" placeholder="VD: Еда">
                                                    <span class="text-danger text-error category_name_ru_edit-error"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col-xl-6">
                                                <div class="form-group">
                                                    <label><strong>Trạng thái danh mục sản phẩm</strong></label>
                                                    <select class="form-control default-select" id="category_status_edit" name="category_status_edit">
                                                        <option value="{{\App\Enums\StatusEnum::ACTIVE}}">Đang kinh doanh</option>
                                                        <option value="{{\App\Enums\StatusEnum::INACTIVE}}">Ngừng kinh doanh</option>
                                                    </select>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-danger light" data-dismiss="modal">Đóng</button>
                    <button class="btn btn-primary" type="submit">Lưu <span id="category-edit-spinner-loading"></span></button>
                </div>
            </form>

        </div>
    </div>
</div>

<!-- view order modal -->

<div class="modal fade modal-view-order" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Xem đơn hàng - <strong id="od_id_tracking"></strong></h3>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                </button>
            </div>
            <div class="row">
                <div class="col-xl-12">
                    <div class="card ">
                        <div class="m-4">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th></th>
                                        <th class="text-center">
                                            Thông tin
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td >Tên khách hàng</td>
                                        <th colspan="5" id="od_client_name"></th>
                                    </tr>
                                    <tr>
                                        <td >Địa chỉ</td>
                                        <th colspan="5" id="od_client_address"></th>
                                    </tr>
                                    <tr>
                                        <td >Email</td>
                                        <th colspan="5" id="od_client_email"></th>
                                    </tr>
                                    <tr>
                                        <td >Số điện thoại</td>
                                        <th colspan="5" id="od_client_phone"></th>
                                    </tr>
                                    <tr>
                                        <td >Tổng</td>
                                        <th colspan="5" id="od_amount"></th>
                                    </tr>
                                    <tr>
                                        <td >Phí vận chuyển</td>
                                        <th colspan="5" id="od_ship"></th>
                                    </tr>
                                    <tr>
                                        <td >Trạng thái</td>
                                        <th colspan="5" id="od_status"></th>
                                    </tr>
                                    <tr>
                                        <td >Thời gian đặt hàng</td>
                                        <th colspan="5" id="created_at"></th>
                                    </tr>
                                    <tr>
                                        <td >Ghi chú</td>
                                        <th colspan="5" id="od_note"></th>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
{{--                            <table class="display min-w850">--}}
{{--                                <thead>--}}
{{--                                <tr>--}}
{{--                                    <th>Tên khách hàng</th>--}}
{{--                                    <th>Email</th>--}}
{{--                                    <th>Số điện thoại</th>--}}
{{--                                    <th>Tổng</th>--}}
{{--                                    <th>Phí vận chuyển</th>--}}
{{--                                    <th>Mã đơn hàng</th>--}}
{{--                                    <th>Trạng thái</th>--}}
{{--                                </tr>--}}
{{--                                </thead>--}}
{{--                                <tbody>--}}
{{--                                <tr>--}}
{{--                                    <td id="od_client_name"></td>--}}
{{--                                    <td id="od_client_email"></td>--}}
{{--                                    <td id="od_client_phone"></td>--}}
{{--                                    <td id="od_amount"></td>--}}
{{--                                    <td id="od_ship"></td>--}}
{{--                                    <td id="od_id_tracking"></td>--}}
{{--                                    <td id="od_status"></td>--}}
{{--                                </tr>--}}
{{--                                </tbody>--}}
{{--                            </table>--}}
                        </div>
                    </div>
                </div>
                <div class="col-xl-12">
                    <div class="card m-4">
                        <div class="table-responsive">
                            <table id="order-details-datatable" class="display min-w850">
                                <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>Sản phẩm</th>
                                    <th>Giá</th>
                                    <th>Số lượng</th>
                                </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-danger light" data-dismiss="modal">Đóng</button>
            </div>
            </form>

        </div>
    </div>
</div>
