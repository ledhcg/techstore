@extends('layouts.admin-product-layout')

@section('title')
    <title>ADMIN | HT Phở Đất Việt</title>
@endsection

@section('content')
<div class="content-body">
            <div class="container-fluid">
                <div class="page-titles">
					<h4>Danh sách đơn hàng đã nhận</h4>
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="javascript:void(0)">Đơn hàng</a></li>
						<li class="breadcrumb-item active"><a href="javascript:void(0)">Danh sách đơn hàng đã nhận</a></li>
					</ol>
                </div>

                <div class="row">
					<div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Danh sách đơn hàng đã nhận</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="order-received-datatable" class="display min-w850">
                                        <thead>
                                            <tr>
                                                <th>STT</th>
                                                <th>Khách hàng</th>
                                                <th>Email</th>
                                                <th>Số điện thoại</th>
                                                <th>Tổng</th>
                                                <th>ID Tracking</th>
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
