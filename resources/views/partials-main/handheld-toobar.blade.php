<div class="handheld-toolbar">
    <div class="d-table table-layout-fixed w-100">
        <a class="d-table-cell handheld-toolbar-item" href="{{route('user.wishlist')}}">
            <span class="handheld-toolbar-icon"><i class="ci-star"></i></span><span class="handheld-toolbar-label">{{__('main.Wishlist')}}</span></a>
        <a class="d-table-cell handheld-toolbar-item" href="javascript:void(0)" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" onclick="window.scrollTo(0, 0)"><span class="handheld-toolbar-icon"><i class="ci-menu"></i></span><span class="handheld-toolbar-label">{{__('main.Menu')}}</span></a>
        <a class="d-table-cell handheld-toolbar-item" href="{{route('main.cartDetails')}}"><span class="handheld-toolbar-icon"><i class="ci-cart"></i><span class="badge bg-primary rounded-pill ms-1 view-cart-count">{{\Gloudemans\Shoppingcart\Facades\Cart::instance('cart')->content()->count()}}</span></span><span class="handheld-toolbar-label view-subtotal">{{\Gloudemans\Shoppingcart\Facades\Cart::instance('cart')->subtotal(1,',',' ')}} ₽</span></a></div>
</div>
