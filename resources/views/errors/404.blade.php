@extends('layouts.main-layout')

@section('title')
    <title>HT Phở Đất Việt</title>
@endsection

@section('content')
    <div class="container py-5 mb-lg-5">
        <div class="row justify-content-center pt-lg-4 text-center">
            <div class="col-lg-5 col-md-7 col-sm-9"><img class="d-block mx-auto mb-5" src="{{asset('public/main/img/pages/404.png')}}" width="340" alt="404 Error">
                <h1 class="h3">{{__('main.404 error')}}</h1>
                <h3 class="h5 fw-normal mb-4">{{__('main.We cant seem to find the page you are looking for')}}</h3>
                <a href="{{route('main.home')}}" class="btn btn-primary fs-md mb-5">
                    {{__('main.Home')}}
                </a>
            </div>
        </div>
    </div>
@endsection
