@extends('layouts.main-layout')

@section('title')
    <title>HT Phở Đất Việt</title>
@endsection

@section('content')
    <div class="container pb-5 mb-sm-4">
        <div class="pt-5">
            <div class="card py-3 mt-sm-3">

                <div class="card-body text-center">
                        <h2 class="h4 pb-3">{{__('main.Thank you for your order')}}</h2>
                        <p class="fs-sm mb-2">{{__('main.Your order has been placed and will be processed as soon as possible')}}</p>
                        <p class="fs-sm mb-2">{{__('main.Your order number')}} - <span class="fw-medium pointer" data-order_tracking="{{$orderTracking}}" onclick="goToOrderTracking(this)">{{$orderTracking}}</span>.</p>

                    <a class="btn btn-secondary mt-3 me-3" href="shop-grid-ls.html">{{__('main.Continue-shopping')}}</a><a class="btn btn-primary mt-3 pointer clear-modal-order-tracking" data-bs-toggle="modal" data-bs-target="#modal-order-tracking"><i class="ci-location"></i>&nbsp;{{__('main.Order-tracking')}}</a>
                </div>
            </div>
        </div>
    </div>
@endsection
