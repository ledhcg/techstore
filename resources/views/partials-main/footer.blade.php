<!-- Footer-->
<footer class="footer bg-dark">
    <div class="pt-5 bg-darker bg-htphodatviet">
        <div class="container">
            <div class="row pb-3">
                <div class="col-md-4 mb-4 text-center">
                    <div class="d-flex justify-content-center">
                        <i class="ci-rocket text-primary" style="font-size: 2.25rem;"></i>
                        <div class="ps-3">
                            <h6 class="fs-base text-light mb-1">{{__('main.Fast and free delivery')}}</h6>
                            <p class="mb-0 fs-ms text-light opacity-50">{{__('main.Free delivery for all orders over $200')}}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4 text-center">
                    <div class="d-flex justify-content-center">
                        <i class="ci-thumb-up text-primary" style="font-size: 2.25rem;"></i>
                        <div class="ps-3">
                            <h6 class="fs-base text-light mb-1">{{__('main.24/7 customer support')}}</h6>
                            <p class="mb-0 fs-ms text-light opacity-50">{{__('main.Friendly 24/7 customer support')}}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4 text-center">
                    <div class="d-flex justify-content-center">
                        <i class="ci-security-check text-primary" style="font-size: 2.25rem;"></i>
                        <div class="ps-3">
                            <h6 class="fs-base text-light mb-1">{{__('main.Secure online payment')}}</h6>
                            <p class="mb-0 fs-ms text-light opacity-50">{{__('main.We possess SSL / Secure сertificate')}}</p>
                        </div>
                    </div>
                </div>
            </div>
            <hr class="hr-light mb-5">
            <div class="row pb-2">
                <div class="col-md-6 text-center text-md-start mb-4">
                    <div class="text-nowrap mb-4"><a class="d-inline-block align-middle mt-n1 me-3" href="#"><img class="d-block" src="{{asset('public/main/img/footer-logo-light.png')}}" width="117" alt="Cartzilla"></a>
                        <div class="btn-group dropdown disable-autohide">
                            @if(config('app.locale') == 'vi')
                                <button class="btn btn-outline-light border-light btn-sm dropdown-toggle px-2" type="button" data-bs-toggle="dropdown">
                                    <img class="me-2" src="{{asset('public/main/img/flags/vi.png')}}" width="20" alt="Tiếng Việt">Tiếng Việt / ₽</button>
                            @else
                                <button class="btn btn-outline-light border-light btn-sm dropdown-toggle px-2" type="button" data-bs-toggle="dropdown">
                                    <img class="me-2" src="{{asset('public/main/img/flags/ru.png')}}" width="20" alt="Русский">Русский / ₽</button>
                            @endif

                            <ul class="dropdown-menu my-1">
                                <li class="dropdown-item">
                                    <select class="form-select form-select-sm">
                                        <option value="rub">₽ (RUB)</option>
                                    </select>
                                </li>
                                <li><a class="dropdown-item pb-1" href="{{ route('setting.locale', 'ru') }}"><img class="me-2" src="{{asset('public/main/img/flags/ru.png')}}" width="20" alt="Русский">Русский</a></li>
                                <li><a class="dropdown-item pb-1" href="{{ route('setting.locale', 'vi') }}"><img class="me-2" src="{{asset('public/main/img/flags/vi.png')}}" width="20" alt="Tiếng Việt">Tiếng Việt</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="widget widget-links widget-light">
                        <div class="pb-4 fs-xs text-light opacity-50 text-center text-md-start">© All rights reserved. Made by <a class="text-light" href="https://ledinhcuong.com/" target="_blank" rel="noopener">LEDINHCUONG.COM</a></div>
                    </div>
                </div>
                <div class="col-md-6 text-center text-md-end mb-4">
                    <div class="mb-3">
                        <a class="btn-social bs-light bs-twitter ms-2 mb-2" href="#"><i class="ci-vk"></i></a>
                        <a class="btn-social bs-light bs-facebook ms-2 mb-2" href="#"><i class="ci-facebook"></i></a>
                        <a class="btn-social bs-light bs-instagram ms-2 mb-2" href="#"><i class="ci-instagram"></i></a>
                    </div>
                    <img class="d-inline-block" src="{{asset('public/main/img/cards-alt.png')}}" width="187" alt="Payment methods">
                </div>
            </div>

        </div>
    </div>
</footer>
