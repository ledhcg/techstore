<div class="deznav">
            <div class="deznav-scroll">
				<ul class="metismenu" id="menu">
                    <li><a class="ai-icon" href="{{route('admin.dashboard')}}" aria-expanded="false">
                            <i class="flaticon-381-networking"></i>
                            <span class="nav-text">Dashboard</span>
                        </a>
                    </li>
                    <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
							<i class="flaticon-381-networking"></i>
							<span class="nav-text">Sản phẩm</span>
						</a>
						<ul aria-expanded="false">
							<li><a href="{{route('product.add-product')}}">Thêm sản phẩm</a></li>
							<li><a href="{{route('product.all-products')}}">Quản lý sản phẩm</a></li>
						</ul>
					</li>
                    <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
							<i class="flaticon-381-networking"></i>
							<span class="nav-text">Danh mục sản phẩm</span>
						</a>
						<ul aria-expanded="false">
							<li><a href="{{route('category.add-category')}}">Thêm danh mục sản phẩm</a></li>
							<li><a href="{{route('category.all-categories')}}">Quản lý danh mục sản phẩm</a></li>
						</ul>
					</li>
                    <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                            <i class="flaticon-381-networking"></i>
                            <span class="nav-text">Khách hàng</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="{{route('admin.all-users')}}">Danh sách khách hàng</a></li>
                        </ul>
                    </li>

                    <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                            <i class="flaticon-381-networking"></i>
                            <span class="nav-text">Đơn hàng</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="{{route('admin.all-orders-created')}}">Đơn hàng chưa xử lý</a></li>
                            <li><a href="{{route('admin.all-orders-received')}}">Đơn hàng đã nhận</a></li>
                            <li><a href="{{route('admin.all-orders-delivering')}}">Đơn hàng đang giao hàng</a></li>
                            <li><a href="{{route('admin.all-orders-delivered')}}">Đơn hàng hoàn thành</a></li>
                            <li><a href="{{route('admin.all-orders-delete')}}">Đơn hàng đã xóa</a></li>
                            <li><a href="{{route('admin.all-orders')}}">Tất cả đơn hàng</a></li>
                        </ul>
                    </li>
                </ul>

				<div class="copyright">
                    <p> Copyright &copy; <script>document.write(new Date().getFullYear())</script> <strong>TECHSTORE</strong></p>
				</div>
			</div>
        </div>
