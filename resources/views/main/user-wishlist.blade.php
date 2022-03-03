@extends('layouts.main-user-layout')

@section('title')
    <title>TECHSTORE</title>
@endsection

@section('content')
    <div id="wishlist-list">
        <!--Loading-->
        <button class="btn btn-primary d-block w-100 mt-4" type="button">
            <span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>
            Loading...
        </button>
        <div class="border-bottom p-3 pt-2"></div>
    </div>
    <button class="btn btn-outline-accent d-block w-100 mt-4" onclick="destroyWishlist()" type="button"><i class="ci-trash fs-base me-2"></i>{{__('main.Destroy-wishlist')}}</button>

@endsection
