@extends('layouts.main-user-layout')

@section('title')
    <title>HT Phở Đất Việt</title>
@endsection

@section('content')

                <!-- Profile form-->
                    <div class="bg-primary rounded-3 p-4 mb-4">
                        <div class="d-flex align-items-center "><img class="rounded account-avatar" src="{{$urlPhoto}}/{{Auth::user()->image}}" width="90" alt="Avatar">
                            <div class="ps-3">
                                <button class="btn btn-light btn-shadow btn-sm mb-2" type="button" id="button-change-image"><i class="ci-loading me-2"></i>{{__('main.Change-avatar')}}</button>
                                <input type="file" id="account-image" style="display: none" class="image_upload">
                                <div class="p mb-0 fs-ms text-white">{{__('main.Upload-JPG-GIF-or-PNG-image-Max-upload-size-is-2MB-only')}}</div>
                            </div>
                        </div>
                    </div>

                <form id="form-update-user" action="{{route('user.update')}}" method="post">
                    @csrf
                    <div class="row gx-4 gy-3">
                        <div class="col-md-6 col-sm-12">
                            <label class="form-label" for="account-fn">{{__('main.Full-name')}}</label>
                            <input name="name" class="form-control" type="text" id="account-fn" value="{{Auth::user()->name}}">
                            <span class="text-danger text-error small name-error"></span>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <label for="gender" class="form-label">{{__('main.Gender')}}</label>
                            <select class="form-select" name="gender" value="{{old('gender')}}">
                                <option value="0">{{__('main.Choose')}}</option>

                                    <option value="{{\App\Enums\GenderEnum::MALE}}" @if(Auth::user()->gender == \App\Enums\GenderEnum::MALE)
                                            selected @endif >{{__('main.MALE')}}</option>
                                    <option value="{{\App\Enums\GenderEnum::FEMALE}}" @if(Auth::user()->gender == \App\Enums\GenderEnum::FEMALE)
                                            selected @endif >{{__('main.FEMALE')}}</option>
                                    <option value="{{\App\Enums\GenderEnum::OTHER}}" @if(Auth::user()->gender == \App\Enums\GenderEnum::OTHER)
                                    selected @endif >{{__('main.OTHER')}}</option>

                            </select>
                            <span class="text-danger text-error small gender-error"></span>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <label class="form-label" for="account-email">{{__('main.Email-address')}}</label>
                            <input name="email" class="form-control" type="email" id="account-email" value="{{Auth::user()->email}}" disabled>
                            <span class="text-danger text-error small email-error"></span>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <label class="form-label" for="account-phone">{{__('main.Phone-number')}}</label>
                            <input name="phone" class="form-control" type="text" id="account-phone" value="{{Auth::user()->phone}}">
                            <span class="text-danger text-error small phone-error"></span>
                        </div>
                        <div class="col-12">
                            <label class="form-label" for="choose-address">{{__('main.Address')}}</label>
                            <input name="address" class="form-control" type="text" id="choose-address" value="{{Auth::user()->address}}">
                            <span class="text-danger text-error small address-error"></span>
                        </div>
                        <div class="col-12">
                            <div class="d-flex flex-wrap justify-content-end align-items-center">
                                <button class="btn btn-primary mt-3 mt-sm-0" type="submit">{{__('main.Update-profile')}}</button>
                            </div>
                        </div>
                    </div>
                </form>

                <hr class="mt-4 mb-4">
                <form id="form-change-password" action="{{route('user.changePassword')}}" method="post">
                    @csrf
                    <div class="row gx-4 gy-3">
                        <div class="col-md-6 col-sm-12">
                            <label class="form-label" for="account-pass">{{__('main.New-password')}}</label>
                            <div class="password-toggle">
                                <input name="npassword" class="form-control" type="password" id="account-pass">
                                <label class="password-toggle-btn" aria-label="Show/hide password">
                                    <input class="password-toggle-check" type="checkbox"><span class="password-toggle-indicator"></span>
                                </label>
                            </div>
                            <span class="text-danger text-error small npassword-error"></span>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <label class="form-label" for="account-confirm-pass">{{__('main.Confirm-password')}}</label>
                            <div class="password-toggle">
                                <input name="cpassword" class="form-control" type="password" id="account-confirm-pass">
                                <label class="password-toggle-btn" aria-label="Show/hide password">
                                    <input class="password-toggle-check" type="checkbox"><span class="password-toggle-indicator"></span>
                                </label>
                            </div>
                            <span class="text-danger text-error small cpassword-error"></span>
                        </div>
                        <div class="col-12">
                            <div class="d-flex flex-wrap justify-content-end align-items-center">
                                <button class="btn btn-primary mt-3 mt-sm-0" type="submit">{{__('main.Update-profile')}}</button>
                            </div>
                        </div>
                    </div>
                </form>
@endsection
@section('script')
    <script>

        //Yandex API
        ymaps.ready(init);
        function init() {
            var chooseAddress = new ymaps.SuggestView('choose-address');

        }
    </script>
@endsection
