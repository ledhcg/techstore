@extends('layouts.main-layout')

@section('title')
    <title>HT Phở Đất Việt</title>
@endsection

@section('content')
    <div class="bg-dark py-4">
        <div class="container d-lg-flex justify-content-between py-2 py-lg-3">
            <div class="order-lg-2 mb-3 mb-lg-0 pt-lg-2">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-light flex-lg-nowrap justify-content-center justify-content-lg-start">
                        <li class="breadcrumb-item"><a class="text-nowrap" href="{{route('main.home')}}"><i class="ci-home"></i>{{__('main.Home')}}</a></li>
                        </li>
                        <li class="breadcrumb-item text-nowrap active" aria-current="page">{{__('main.Order tracking')}}</li>
                    </ol>
                </nav>
            </div>
            <div class="order-lg-1 pe-lg-4 text-center text-lg-start">
                <h1 class="h3 text-light mb-0">{{__('main.Order tracking')}}: <span class="h4 fw-normal text-light">{{$order->order_tracking}}</span></h1>
            </div>
        </div>
    </div>
    <div class="container py-5 mb-2 mb-md-3">
        <!-- Details-->
        <div class="row gx-4 mb-4">
            <div class="col-md-4 mb-2">
                <div class="bg-secondary h-100 p-4 text-center rounded-3"><span class="fw-medium text-dark me-2">{{__('main.Total')}}:</span>{{number_format($order->order_total, 1, ',', ' ')}} ₽</div>
            </div>
            <div class="col-md-4 mb-2">
                <div class="bg-secondary h-100 p-4 text-center rounded-3"><span class="fw-medium text-dark me-2">{{__('main.Status')}}:</span>{{$order->order_status}}</div>
            </div>
            <div class="col-md-4 mb-2">
                <div class="bg-secondary h-100 p-4 text-center rounded-3"><span class="fw-medium text-dark me-2">{{__('main.Last updated')}}:</span>{{date('g:i A, d M Y', strtotime($order->updated_at))}}</div>
            </div>
        </div>
        <!-- Progress-->
        <div class="card border-0 shadow-lg">
            <div class="card-body pb-2">
                <ul class="nav nav-tabs media-tabs nav-justified">
                    <li class="nav-item">
                        <div class="nav-link
                            @if($order->order_status == 'CREATED')
                            completed
                            @elseif($order->order_status == 'RECEIVED')
                            completed
                            @elseif($order->order_status == 'DELIVERING')
                            completed
                            @elseif($order->order_status == 'DELIVERED')
                            completed
                            @endif
                            ">
                            <div class="d-flex align-items-center">
                                <div class="media-tab-media"><i class="ci-bag"></i></div>
                                <div class="ps-3">
                                    <div class="media-tab-subtitle text-muted fs-xs mb-1">{{__('main.First step')}}</div>
                                    <h6 class="media-tab-title text-nowrap mb-0">{{__('main.CREATED')}}</h6>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="nav-item">
                        <div class="nav-link
                            @if($order->order_status == 'CREATED')
                            @elseif($order->order_status == 'RECEIVED')
                            active
                            @elseif($order->order_status == 'DELIVERING')
                            completed
                            @elseif($order->order_status == 'DELIVERED')
                            completed
                            @endif
                            ">
                            <div class="d-flex align-items-center">
                                <div class="media-tab-media"><i class="ci-edit"></i></div>
                                <div class="ps-3">
                                    <div class="media-tab-subtitle text-muted fs-xs mb-1">{{__('main.Second step')}}</div>
                                    <h6 class="media-tab-title text-nowrap mb-0">{{__('main.RECEIVED')}}</h6>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="nav-item">
                        <div class="nav-link
                            @if($order->order_status == 'CREATED')
                            @elseif($order->order_status == 'RECEIVED')
                            @elseif($order->order_status == 'DELIVERING')
                            active
                            @elseif($order->order_status == 'DELIVERED')
                            completed
                            @endif
                            ">
                            <div class="d-flex align-items-center">
                                <div class="media-tab-media"><i class="ci-delivery"></i></div>
                                <div class="ps-3">
                                    <div class="media-tab-subtitle text-muted fs-xs mb-1">{{__('main.Third step')}}</div>
                                    <h6 class="media-tab-title text-nowrap mb-0">{{__('main.DELIVERING')}}</h6>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="nav-item">
                        <div class="nav-link
                            @if($order->order_status == 'CREATED')
                            @elseif($order->order_status == 'RECEIVED')
                            @elseif($order->order_status == 'DELIVERING')
                            @elseif($order->order_status == 'DELIVERED')
                            completed
                            @endif
                            ">
                            <div class="d-flex align-items-center">
                                <div class="media-tab-media"><i class="ci-package"></i></div>
                                <div class="ps-3">
                                    <div class="media-tab-subtitle text-muted fs-xs mb-1">{{__('main.Fourth step')}}</div>
                                    <h6 class="media-tab-title text-nowrap mb-0">{{__('main.DELIVERED')}}</h6>
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
        <!-- Footer-->
        <div class="d-sm-flex flex-wrap justify-content-between align-items-center text-center pt-4">
            <div class="form-check mt-2 me-3">
            </div><a class="btn btn-primary btn-sm mt-2" href="#order-details" data-bs-toggle="modal">{{__('main.View Order Details')}}</a>
        </div>
    </div>
    <div class="modal fade" id="order-details">
        <div class="modal-dialog modal-lg modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{__('main.Order details')}} - <strong id="VO_order_tracking">{{$order->order_tracking}}</strong></h5>
                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body pb-0">
                    <div class="card mb-3">
                        <div class="card-body">
                            <ul class="list-unstyled mb-0">
                                <div class="row">
                                    <div class="col-6">
                                        <li class="d-flex pb-3 border-bottom">
                                            <i class="ci-user fs-lg mt-2 mb-0 text-primary"></i>
                                            <div class="ps-3">
                                                <span class="fs-ms text-muted">{{__('main.Full name')}}</span>
                                                <a class="d-block text-heading fs-sm">{{$order->client_name}}</a>
                                            </div>
                                        </li>
                                    </div>
                                    <div class="col-6">
                                        <li class="d-flex pb-3 border-bottom">
                                            <i class="ci-location fs-lg mt-2 mb-0 text-primary"></i>
                                            <div class="ps-3 ">
                                                <span class="fs-ms text-muted">{{__('main.Address')}}</span>
                                                <div class="parent-animated-white-space">
                                                    <a class="d-block text-heading fs-sm animated-white-space">{{$order->client_address}}</a>
                                                </div>
                                            </div>
                                        </li>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-6">
                                        <li class="d-flex pt-3 pb-3 border-bottom">
                                            <i class="ci-phone fs-lg mt-2 mb-0 text-primary"></i>
                                            <div class="ps-3">
                                                <span class="fs-ms text-muted">{{__('main.Phone number')}}</span>
                                                <a class="d-block text-heading fs-sm">{{$order->client_phone}}</a>
                                            </div>
                                        </li>
                                    </div>
                                    <div class="col-6 ">
                                        <li class="d-flex pt-3 pb-3 border-bottom">
                                            <i class="ci-mail fs-lg mt-2 mb-0 text-primary"></i>
                                            <div class="ps-3">
                                                <span class="fs-ms text-muted">{{__('main.Email')}}</span>
                                                <a class="d-block text-heading fs-sm">{{$order->client_email}}</a>
                                            </div>
                                        </li>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <li class="d-flex pt-3">
                                            <i class="ci-dollar-circle fs-lg mt-2 mb-0 text-primary"></i>
                                            <div class="ps-3">
                                                <span class="fs-ms text-muted">{{__('main.Payment method')}}</span>
                                                <a class="d-block text-heading fs-sm">{{__('main.'.$order->paymentMethods->name)}}</a>
                                            </div>
                                        </li>
                                    </div>
                                    <div class="col-6">
                                        <li class="d-flex pt-3">
                                            <i class="ci-time fs-lg mt-2 mb-0 text-primary"></i>
                                            <div class="ps-3">
                                                <span class="fs-ms text-muted">{{__('main.Created at')}}</span>
                                                <a class="d-block text-heading fs-sm">{{date('g:i A, d M Y', strtotime($order->created_at))}}</a>
                                            </div>
                                        </li>
                                    </div>
                                </div>
                            </ul>
                        </div>
                    </div>
                    <div class="accordion mb-3" id="accordionExample">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingOne">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">{{__('main.Message')}}</button>
                            </h2>
                            <div class="accordion-collapse collapse" id="collapseOne" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                <div class="accordion-body">{{__('main.'.$order->order_note)}}</div>
                            </div>
                        </div>
                    </div>
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>{{__('main.Product')}}</th>
                            <th>{{__('main.Price')}}</th>
                            <th>{{__('main.Quantity')}}</th>
                        </tr>
                        </thead>
                        <tbody class="tb-order-details">
                        @foreach($orderDetails as $index => $od)
                            <tr>
                                <td><strong>{{$index+1}}</strong></td>
                                <td>{{$od->products["product_name_".config('app.locale')]}}</td>
                                <td>{{$od->product_price}}</td>
                                <td>{{$od->product_quantity}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- Footer-->
                <div class="modal-footer flex-wrap justify-content-between bg-secondary fs-md">
                    <div class="px-2 py-1"><span class="text-muted">{{__('main.Total')}}&nbsp;</span><strong>{{number_format($order->order_total, 1, ',', ' ')}} ₽</strong></div>
                    <div class="px-2 py-1"><span class="text-muted">{{__('main.Shipping fee')}} </span><strong>{{number_format($order->order_ship, 1, ',', ' ')}} ₽</strong></div>
                </div>
            </div>
        </div>
    </div>
@endsection
