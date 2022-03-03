@extends('layouts.main-layout-white')

@section('title')
    <title>TECHSTORE</title>
@endsection

@section('content')
    <div class="container py-4 py-lg-5 my-4">
        <div class="row d-flex justify-content-center">
            <div class="col-md-6 ">
                <div class="card border-0 shadow">
                    <div class="card-body">
                        @if (Session::get('fail'))
                            <div class="alert alert-danger">
                                {{Session::get('fail')}}
                            </div>
                        @endif
                        <h2 class="h4 mb-3">{{__('main.Sign-up')}}</h2>
                            <!--
                        <p class="fs-sm text-muted mb-4">Registration takes less than a minute but gives you full control over your orders.</p>
                        -->
                        <div class="pb-4"><hr></div>
                        <form action="{{route('user.create')}}" method="post">
                            @csrf
                            <div class="row gx-4 gy-3">
                                <div class="col-sm-6">
                                    <label class="form-label" for="reg-fn">{{__('main.Full-name')}}</label>
                                    <input class="form-control" type="text" name="name" value="{{old('name')}}">
                                    <span class="text-danger small">@error('name') {{$message}} @enderror</span>
                                </div>
                                <div class="col-sm-6">
                                    <!--
                                    <label class="form-label" for="reg-ln">Gender</label>
                                    <input class="form-control" type="text" name="gender" value="{{old('gender')}}">
                                    -->
                                    <label for="gender" class="form-label">{{__('main.Gender')}}</label>
                                    <select class="form-select" name="gender" value="{{old('gender')}}">
                                        <option value="{{\App\Enums\GenderEnum::NULL}}">{{__('main.Choose')}}...</option>
                                        <option value="{{\App\Enums\GenderEnum::MALE}}">{{__('main.MALE')}}</option>
                                        <option value="{{\App\Enums\GenderEnum::FEMALE}}">{{__('main.FEMALE')}}</option>
                                        <option value="{{\App\Enums\GenderEnum::OTHER}}">{{__('main.OTHER')}}</option>
                                    </select>
                                    <span class="text-danger small">@error('gender'){{$message}}@enderror</span>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label" for="reg-email">{{__('main.Email-address')}}</label>
                                    <input class="form-control" type="email" name="email" value="{{old('email')}}">
                                    <span class="text-danger small">@error('email'){{$message}}@enderror</span>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label" for="reg-phone">{{__('main.Phone-number')}}</label>
                                    <input class="form-control" type="text" name="phone" value="{{old('phone')}}">
                                    <span class="text-danger small">@error('phone'){{$message}}@enderror</span>
                                </div>
                                <div class="col-12">
                                    <label class="form-label" for="reg-phone">{{__('main.Address')}}</label>
                                    <input class="form-control" id="choose-address" type="text" name="address" value="{{old('address')}}">
                                    <span class="text-danger small">@error('address'){{$message}}@enderror</span>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label" for="reg-password">{{__('main.Password')}}</label>
                                    <input class="form-control" type="password" name="password" value="{{old('password')}}">
                                    <span class="text-danger small">@error('password'){{$message}}@enderror</span>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label" for="reg-password-confirm">{{__('main.Confirm-password')}}</label>
                                    <input class="form-control" type="password" name="cpassword" value="{{old('cpassword')}}">
                                    <span class="text-danger small">@error('cpassword'){{$message}}@enderror</span>
                                </div>
                                <div class="pt-1"><hr></div>
                                <div class="col-12 d-flex flex-wrap justify-content-between text-center align-items-center pt-2">
                                    <a class="nav-link-inline fs-sm fst-italic" href="{{route('user.login')}}"><i class="ci-idea me-2 ms-n1"></i><strong>{{__('main.Sign-in')}}</strong></a>
                                    <button class="btn btn-primary" type="submit"><i class="ci-user me-2 ms-n1"></i>{{__('main.Sign-up')}}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
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
