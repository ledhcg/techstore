@extends('layouts.admin-category-layout')

@section('title')
    <title>ADMIN | TECHSTORE</title>
@endsection

@section('content')
    <div class="content-body">
        <div class="container-fluid">
            <div class="page-titles">
                <h4>Thêm danh mục sản phẩm</h4>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Danh mục sản phẩm</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">Thêm danh mục sản phẩm</a></li>
                </ol>
            </div>
            <form id="form-insert-category" class="form-valide" action="{{route('category.insert')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-xl-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="profile-blog mb-5">
                                    <h4 class="text-primary d-inline">Ảnh danh mục sản phẩm</h4>
                                    <img id="category-image-preview" src="{{asset('public/admin/images/upload_image.jpg')}}" alt="" class="img-fluid mt-4 mb-4 w-100">
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="category_image" name="category_image">
                                            <label class="custom-file-label">Chọn ảnh ...</label>

                                        </div>

                                    </div>
                                    <span class="text-danger text-error category_image-error"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-8">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Danh mục sản phẩm mới</h4>
                            </div>
                            <div class="card-body">
                                <div class="form-validation">
                                        <div class="form-row">
                                            <div class="col-xl-6">
                                                <div class="form-group">
                                                    <label><strong>Tên danh mục sản phẩm (VI)</strong></label>
                                                    <input type="text" class="form-control" id="category_name_vi" name="category_name_vi" placeholder="VD: Đồ ăn">
                                                    <span class="text-danger text-error category_name_vi-error"></span>
                                                </div>
                                            </div>
                                            <div class="col-xl-6">
                                                <div class="form-group">
                                                    <label><strong>Tên danh mục sản phẩm (RU)</strong></label>
                                                    <input type="text" class="form-control" id="category_name_ru" name="category_name_ru" placeholder="VD: Еда">
                                                    <span class="text-danger text-error category_name_ru-error"></span>
                                                </div>
                                            </div>
                                            <button type="submit" class="btn btn-primary w-100 mt-4">Thêm danh mục sản phẩm <span id="spinner-loading"></span></button>
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
