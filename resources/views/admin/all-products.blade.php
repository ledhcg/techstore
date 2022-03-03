@extends('layouts.admin-product-layout')

@section('title')
    <title>ADMIN | TECHSTORE</title>
@endsection

@section('content')
<div class="content-body">
            <div class="container-fluid">
                <div class="page-titles">
					<h4>Quản lý sản phẩm</h4>
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="javascript:void(0)">Sản phẩm</a></li>
						<li class="breadcrumb-item active"><a href="javascript:void(0)">Quản lý sản phẩm</a></li>
					</ol>
                </div>

                <div class="row">
					<div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Danh sách sản phẩm</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="product-datatable" class="display min-w850">
                                        <thead>
                                            <tr>
                                                <th>STT</th>
                                                <th>Hình</th>
                                                <th>Tên (VI)</th>
                                                <th>Tên (RU)</th>
                                                <th>Giá cuối</th>
                                                <th>Giá gốc</th>
                                                <th>Giá chiết khấu</th>
                                                <th>Trạng thái</th>
                                                <th>Danh mục</th>
                                                <th>Hành động</th>
                                            </tr>
                                        </thead>
                                        <tbody>
										</tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
				</div>
            </div>
        </div>
@endsection
