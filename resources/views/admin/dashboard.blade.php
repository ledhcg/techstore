@extends('layouts.admin-layout')

@section('title')
    <title>ADMIN | TECHSTORE</title>
@endsection

@section('content')
<div class="content-body">
            <!-- row -->
			<div class="container-fluid">
				<div class="form-head d-flex align-items-center mb-sm-4 mb-3">
					<div class="mr-auto">
						<h2 class="text-black font-w600">Thống kê</h2>
						<p class="mb-0">Cửa hàng HT Phở Đất Việt</p>
					</div>
				</div>
				<div class="row">
					<div class="col-xl-3 col-sm-6">
						<div class="card">
							<div class="card-body">
								<div class="media align-items-center">
									<div class="media-body mr-3">
										<h2 class="fs-34 text-black font-w600">{{$dataUsers->count()}}</h2>
										<span>Khách hàng</span>
									</div>
                                    <i class="ti ti-users" style="font-size: xxx-large"></i>
								</div>
							</div>
							<div class="progress  rounded-0" style="height:4px;">
								<div class="progress-bar rounded-0 bg-secondary progress-animated" style="width: 100%; height:4px;" role="progressbar">
								</div>
							</div>
						</div>
					</div>
					<div class="col-xl-3  col-sm-6">
						<div class="card">
							<div class="card-body">
								<div class="media align-items-center">
									<div class="media-body mr-3">
										<h2 class="fs-34 text-black font-w600">{{$dataOrders->count()}}</h2>
										<span>Đơn hàng</span>
									</div>
                                    <i class="ti ti-basket" style="font-size: xxx-large"></i>
								</div>
							</div>
							<div class="progress  rounded-0" style="height:4px;">
								<div class="progress-bar rounded-0 bg-secondary progress-animated" style="width: 100%; height:4px;" role="progressbar">
								</div>
							</div>
						</div>
					</div>
					<div class="col-xl-3  col-sm-6">
						<div class="card">
							<div class="card-body">
								<div class="media align-items-center">
									<div class="media-body mr-3">
										<h2 class="fs-34 text-black font-w600">{{$dataProducts->count()}}</h2>
										<span>Sản phẩm</span>
									</div>
                                    <i class="ti ti-box" style="font-size: xxx-large"></i>
								</div>
							</div>
							<div class="progress  rounded-0" style="height:4px;">
								<div class="progress-bar rounded-0 bg-secondary progress-animated" style="width: 100%; height:4px;" role="progressbar">
								</div>
							</div>
						</div>
					</div>
					<div class="col-xl-3  col-sm-6">
						<div class="card">
							<div class="card-body">
								<div class="media align-items-center">
									<div class="media-body mr-3">
										<h2 class="fs-34 text-black font-w600">{{$dataCategories->count()}}</h2>
										<span>Danh mục sản phẩm</span>
									</div>
                                    <i class="ti ti-database" style="font-size: xxx-large"></i>
								</div>
							</div>
							<div class="progress  rounded-0" style="height:4px;">
								<div class="progress-bar rounded-0 bg-secondary progress-animated" style="width: 100%; height:4px;" role="progressbar">
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-xl-6">
						<div class="row">
							<div class="col-xl-12">
								<div class="card">
									<div class="card-header d-sm-flex d-block pb-0 border-0">
										<div class="mr-auto pr-3 d-flex align-content-between">
											<h4 class="text-black fs-20 mb-0">Thông báo</h4>
										</div>
									</div>
									<div class="card-body" id="list-notification-dashboard">
                                            @forelse($notifications as $notification)
                                            @if($loop->first)
                                                <div class="pb-2">
                                                    <a class="pointer" onclick="markAllAsRead()">
                                                        Đánh dấu đã đọc tất cả
                                                    </a>
                                                </div>
                                            @endif
                                                <a href="{{route('admin.all-orders-created')}}" onclick="markAsRead(this)" data-id="{{$notification->id}}">
                                                    <div class="alert alert-success pointer" role="alert">
                                                         [{{$notification->created_at}}] Đơn hàng <strong>{{$notification->data['order_tracking']}}</strong> đã được tạo thành công.
                                                    </div>
                                                </a>
                                            @empty
                                                Không có đơn hàng mới.
                                            @endforelse
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-xl-6">
						<div class="row">
							<div class="col-xl-12">
								<div class="card appointment-schedule">
									<div class="card-header pb-0 border-0">
										<h3 class="fs-20 text-black mb-0">Lịch</h3>
										<div class="dropdown ml-auto">
											<div class="btn-link p-2 bg-light" data-toggle="dropdown">
												<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
													<path d="M12 13C12.5523 13 13 12.5523 13 12C13 11.4477 12.5523 11 12 11C11.4477 11 11 11.4477 11 12C11 12.5523 11.4477 13 12 13Z" stroke="#2E2E2E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
													<path d="M12 6C12.5523 6 13 5.55228 13 5C13 4.44772 12.5523 4 12 4C11.4477 4 11 4.44772 11 5C11 5.55228 11.4477 6 12 6Z" stroke="#2E2E2E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
													<path d="M12 20C12.5523 20 13 19.5523 13 19C13 18.4477 12.5523 18 12 18C11.4477 18 11 18.4477 11 19C11 19.5523 11.4477 20 12 20Z" stroke="#2E2E2E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
												</svg>
											</div>
											<div class="dropdown-menu dropdown-menu-right">
												<a class="dropdown-item text-black" href="javascript:;">Info</a>
												<a class="dropdown-item text-black" href="javascript:;">Details</a>
											</div>
										</div>
									</div>
									<div class="card-body">
                                        <div class="appointment-calender">
                                            <input type='text' class="form-control d-none" id='datetimepicker1' />
                                        </div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
            </div>
        </div>
@endsection
