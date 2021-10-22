@extends('layouts.main-layout')

@section('title')
    <title>HT Phở Đất Việt</title>
@endsection

@section('content')

    <div class="bg-htphodatviet py-4">
        <div class="container d-lg-flex justify-content-between py-2 py-lg-3">
            <div class="order-lg-2 mb-3 mb-lg-0 pt-lg-2">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-light flex-lg-nowrap justify-content-center justify-content-lg-start">
                        <li class="breadcrumb-item"><a class="text-nowrap" href="{{route('main.home')}}"><i class="ci-home"></i>{{__('main.Home')}}</a></li>
                        <li class="breadcrumb-item text-nowrap active" aria-current="page">{{__('main.Contacts')}}</li>
                    </ol>
                </nav>
            </div>
            <div class="order-lg-1 pe-lg-4 text-center text-lg-start">
                <h1 class="h3 text-light mb-0">{{__('main.Contacts')}}</h1>
            </div>
        </div>
    </div>

    <!-- Outlet stores-->
    <section class="container pt-grid-gutter">
        <div class="card">
            <div class="row g-0 justify-content-sm-center">
                <div class="col-sm-auto col-md-4 p-3">
                    <img src="{{asset('data/images/source/htphodatviet.jpg')}}" class="rounded" alt="Card image">
                </div>
                <div class=" col-sm-auto col-md-8">
                    <div class="card-body">
                        <h5 class="card-title text-center">{{__('main.'.config('app.name'))}}</h5>
                        <p class="card-text fs-sm text-muted">(Them thong tin)</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact detail cards-->
    <section class="container pt-4 mt-md-4 mb-5">
        <div class="row">
            <div class="col-xl-3 col-sm-6 mb-grid-gutter"><a class="card h-100" href="#map" data-scroll>
                    <div class="card-body text-center"><i class="ci-location h3 mt-2 mb-4 text-primary"></i>
                        <h3 class="h6 mb-2">{{__('main.Address')}}</h3>
                        <p class="fs-sm text-muted">{{config('app.address')}}</p>
                        <div class="fs-sm text-primary">{{__('main.Click to see map')}}<i class="ci-arrow-right align-middle ms-1"></i></div>
                    </div></a></div>
            <div class="col-xl-3 col-sm-6 mb-grid-gutter">
                <div class="card h-100">
                    <div class="card-body text-center"><i class="ci-time h3 mt-2 mb-4 text-primary"></i>
                        <h3 class="h6 mb-3">{{__('main.Working hours')}}</h3>
                        <ul class="list-unstyled fs-sm text-muted mb-0">
                            <li>{{__('main.Working hours detail')}}</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 mb-grid-gutter">
                <div class="card h-100">
                    <div class="card-body text-center"><i class="ci-phone h3 mt-2 mb-4 text-primary"></i>
                        <h3 class="h6 mb-3">{{__('main.Phone number')}}</h3>
                        <ul class="list-unstyled fs-sm mb-0">
                            <li><span class="text-muted me-1"></span><a class="nav-link-style" href="tel:{{config('app.phone_number')}}">{{config('app.phone_number')}}</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 mb-grid-gutter">
                <div class="card h-100">
                    <div class="card-body text-center"><i class="ci-mail h3 mt-2 mb-4 text-primary"></i>
                        <h3 class="h6 mb-3">{{__('main.Email')}}</h3>
                        <ul class="list-unstyled fs-sm mb-0">
                            <li class="mb-0"><span class="text-muted me-1"></span><a class="nav-link-style" href="mailto:{{config('app.email_address')}}">{{config('app.email_address')}}</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Split section: Map + Contact form-->
    <div class="container py-4">
        <div class="card">
            <div style="position:relative;overflow:hidden;"><a href="https://yandex.ru/maps/15/tula/?utm_medium=mapframe&utm_source=maps" style="color:#eee;font-size:12px;position:absolute;top:0px;">Тула</a><a href="https://yandex.ru/maps/15/tula/house/sovetskaya_ulitsa_47/Z04YcAZoQUAAQFtufX14cHtkbQ==/?ll=37.618857%2C54.191779&utm_medium=mapframe&utm_source=maps&z=16" style="color:#eee;font-size:12px;position:absolute;top:14px;">Советская улица, 47 на карте Тулы — Яндекс.Карты</a><iframe src="https://yandex.ru/map-widget/v1/-/CCUqZ2R9xB" width="560" height="500" frameborder="1" allowfullscreen="true" style="position:relative;"></iframe></div>
        </div>

    </div>

@endsection

@section('script')
    <script>

    </script>
@endsection
