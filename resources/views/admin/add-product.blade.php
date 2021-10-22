@extends('layouts.admin-product-layout')

@section('title')
    <title>ADMIN | HT Phở Đất Việt</title>
@endsection

@section('content')
    <div class="content-body">
            <div class="container-fluid">
                <div class="page-titles">
					<h4>Thêm sản phẩm mới</h4>
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="javascript:void(0)">Sản phẩm</a></li>
						<li class="breadcrumb-item active"><a href="javascript:void(0)">Thêm sản phẩm mới</a></li>
					</ol>
                </div>
                <form id="form-insert-product" class="form-valide" action="{{route('product.insert')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-xl-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="profile-blog mb-5">
                                        <h4 class="text-primary d-inline">Ảnh sản phẩm</h4>
                                        <img id="product-image-preview" src="{{asset('public/admin/images/upload_image.jpg')}}" alt="" class="img-fluid mt-4 mb-4 w-100">
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="product_image" name="product_image">
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
                                                    <input name="product_name_vi" type="text" placeholder="Ví dụ: Phở Gà" class="form-control">
                                                    <span class="text-danger text-error product_name_vi-error"></span>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label><strong>Tên sản phẩm (Tiếng Nga)</strong></label>
                                                    <input name="product_name_ru" type="text" placeholder="Ví dụ: Фо Га" class="form-control">
                                                    <span class="text-danger text-error product_name_ru-error"></span>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="form-group col-md-4">
                                                    <label><strong>Giá bán cuối (RUB)</strong></label>
                                                    <input name="product_price_last" type="number" placeholder="Ví dụ: 300" class="form-control">
                                                    <span class="text-danger text-error product_price_last-error"></span>
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label><strong>Giá cũ (RUB)</strong></label>
                                                    <input name="product_price_fix" type="number" placeholder="Ví dụ: 300" class="form-control">
                                                    <span class="text-danger text-error product_price_fix-error"></span>
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label><strong>Giá có chiết khấu (RUB)</strong></label>
                                                    <input name="product_price_discount" type="number" placeholder="Ví dụ: 300" class="form-control">
                                                    <span class="text-danger text-error product_price_discount-error"></span>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label><strong>Số lượng để nhận chiết khấu</strong></label>
                                                    <input name="product_quantity_to_discount" type="number" placeholder="Ví dụ: 300" class="form-control">
                                                    <span class="text-danger text-error product_quantity_to_discount-error"></span>
                                                </div>
                                                <div class="form-group col-md-3">
                                                    <label><strong>Đơn vị (Tiếng Việt)</strong></label>
                                                    <input name="product_unit_vi" type="text" placeholder="Ví dụ: bát" class="form-control">
                                                    <span class="text-danger text-error product_unit_vi-error"></span>
                                                </div>
                                                <div class="form-group col-md-3">
                                                    <label><strong>Đơn vị (Tiếng Nga)</strong></label>
                                                    <input name="product_unit_ru" type="text" placeholder="Ví dụ: bát" class="form-control">
                                                    <span class="text-danger text-error product_unit_ru-error"></span>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label><strong>Trạng thái sản phẩm</strong></label>
                                                    <input type="text" value="Đang kinh doanh" name="product_status" class="form-control" readonly>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label><strong>Danh mục sản phẩm</strong></label>
                                                    <select class="form-control default-select" id="category_id" name="category_id">
                                                        <option selected="">Chọn...</option>
                                                        @foreach($dataCategories as $option){
                                                        <option value="{{$option->id}}">{{$option->category_name_vi}}</option>
                                                        @endforeach
                                                    </select>
                                                    <span class="text-danger text-error category_id-error"></span>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label><strong>Mô tả sản phẩm (Tiếng Việt)</strong></label>
                                                <textarea name="product_description_vi" class="form-control" rows="5"></textarea>
                                            </div>
                                            <span class="text-danger text-error product_description_vi-error"></span>
                                            <div class="form-group">
                                                <label><strong>Mô tả sản phẩm (Tiếng Nga)</strong></label>
                                                <textarea name="product_description_ru" class="form-control" rows="5"></textarea>
                                            </div>
                                            <span class="text-danger text-error product_description_ru-error"></span>

                                            <button class="btn btn-primary mt-4 w-100" type="submit">Thêm sản phẩm <span id="spinner-loading"></span></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
@endsection
