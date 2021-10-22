@extends('layouts.main-layout')

@section('title')
    <title>HT Phở Đất Việt</title>
@endsection

@section('content')
    <div class="container pb-5 mb-sm-4">
        <div class="pt-5">
            <div class="card py-3 mt-sm-3">

                <div class="card-body text-center">
                    @if($checkExistOrder === true)
                        <h2 class="h4 pb-3">Thank you for your order!</h2>
                        <p class="fs-sm mb-2">Your order has been placed and will be processed as soon as possible.</p>
                        <p class="fs-sm mb-2">Make sure you make note of your order number, which is <span class='fw-medium'>{{$orderTracking}}.</span></p>
                        <p class="fs-sm">You will be receiving an email shortly with confirmation of your order. <u>You can now:</u></p>
                    @else
                        <h2 class="h4 pb-3">Loii!</h2>
                        <p class="fs-sm mb-2">Your order has been placed and will be processed as soon as possible.</p>
                        <p class="fs-sm">You will be receiving an email shortly with confirmation of your order. <u>You can now:</u></p>
                    @endif
                    <a class="btn btn-secondary mt-3 me-3" href="shop-grid-ls.html">Go back shopping</a><a class="btn btn-primary mt-3" href="order-tracking.html"><i class="ci-location"></i>&nbsp;Track order</a>
                </div>
            </div>
        </div>
    </div>
@endsection
