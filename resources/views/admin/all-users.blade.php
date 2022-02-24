@extends('layouts.admin-product-layout')

@section('title')
    <title>ADMIN | HT Phở Đất Việt</title>
@endsection

@section('content')
<div class="content-body">
            <div class="container-fluid">
                <div class="page-titles">
					<h4>Danh sách khách hàng</h4>
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="javascript:void(0)">Khách hàng</a></li>
						<li class="breadcrumb-item active"><a href="javascript:void(0)">Danh sách khách hàng</a></li>
					</ol>
                </div>

                <div class="row">
					<div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Danh sách khách hàng</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="user-datatable" class="display min-w850">
                                        <thead>
                                            <tr>
                                                <th>STT</th>
                                                <th>Họ và tên</th>
                                                <th>Giới tính</th>
                                                <th>Số điện thoại</th>
                                                <th>Địa chỉ</th>
                                                <th>Email</th>
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
