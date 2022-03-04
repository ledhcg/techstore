<!DOCTYPE html>
<html lang="en" class="h-100">

@include('partials-admin.head')

<body class="h-100">
<div class="authincation h-100">
    <div class="container h-100">
        <div class="row justify-content-center h-100 align-items-center">
            <div class="col-md-6">
                <div class="authincation-content">
                    <div class="row no-gutters">
                        <div class="col-xl-12">
                            <div class="auth-form">
                                <div class="text-center mb-3">
                                    <a href=""><img src="{{asset('public/admin/images/logo.png')}}" alt=""></a>
                                </div>
                                <h4 class="text-center mb-4 text-white">{{__('admin.Sign in')}}</h4>
                                @if (Session::get('fail'))
                                    <div class="alert alert-danger">
                                        {{Session::get('fail')}}
                                    </div>
                                @endif
                                <form action="{{route('admin.check')}}" method="post">
                                    @csrf
                                    <div class="form-group">
                                        <label class="mb-1 text-white"><strong>{{__('admin.Email')}}</strong></label>
                                        <input type="email" class="form-control" style="color: #0c0c0c; font-weight: 600" name="email" placeholder="hello@techstore.com">
                                    </div>
                                    <div class="form-group">
                                        <label class="mb-1 text-white"><strong>{{__('admin.Password')}}</strong></label>
                                        <input type="password" class="form-control" style="color: #0c0c0c; font-weight: 600" name="password" placeholder="Password">
                                    </div>

                                    <div class="form-row d-flex justify-content-between mt-4 mb-2">
                                    <!--
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox ml-1 text-white">
                                                <input type="checkbox" class="custom-control-input" id="basic_checkbox_1">
                                                <label class="custom-control-label" for="basic_checkbox_1">Remember my preference</label>
                                            </div>
                                        </div>
                                        -->
                                        <div class="form-group">
                                            <a class="text-white" href="">{{__('admin.Forgot password')}}</a>
                                        </div>
                                    </div>
                                    <div class="text-center">
                                        <button type="submit" class="btn bg-white text-primary btn-block">{{__('admin.Sign in')}}</button>
                                    </div>
                                </form>
                                <!--
                                <div class="new-account mt-3">
                                    <p class="text-white">Don't have an account? <a class="text-white" href="page-register.html">Sign up</a></p>
                                </div>
                                -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('partials-admin.script')

</body>
</html>
