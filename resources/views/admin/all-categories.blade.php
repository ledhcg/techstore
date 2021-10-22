@extends('layouts.admin-category-layout')

@section('title')
    <title>ADMIN | HT Phở Đất Việt</title>
@endsection

@section('content')
<div class="content-body">
            <div class="container-fluid">
                <div class="page-titles">
					<h4>Quản lý danh mục sản phẩm</h4>
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="javascript:void(0)">Danh mục sản phẩm</a></li>
						<li class="breadcrumb-item active"><a href="javascript:void(0)">Quản lý danh mục sản phẩm</a></li>
					</ol>
                </div>

                <div class="row">
					<div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Danh sách danh mục sản phẩm</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="category-datatable" class="display min-w850">
                                        <thead>
                                            <tr>
                                                <th>STT</th>
                                                <th>Hình</th>
                                                <th>Tên (VI)</th>
                                                <th>Tên (RU)</th>
                                                <th>Trạng thái</th>
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
