<div id="layout-search" style="display: none">
    <div class="bg-dark py-4">
        <div class="container d-lg-flex justify-content-between py-2 py-lg-3">
            <div class="order-lg-2 mb-3 mb-lg-0 pt-lg-2">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-light flex-lg-nowrap justify-content-center justify-content-lg-start">
                        <li class="breadcrumb-item"><a class="text-nowrap" href="{{route('main.home')}}"><i class="ci-home"></i>{{__('main.Home')}}</a></li>
                        </li>
                        <li class="breadcrumb-item text-nowrap active" aria-current="page">{{__('main.Search')}}</li>
                    </ol>
                </nav>
            </div>
            <div class="order-lg-1 pe-lg-4 text-center text-lg-start">
                <h1 class="h3 text-light mb-0">{{__('main.Keyword')}}: "<span class="h4 fw-normal text-light" id="text_keyword"></span>"</h1>
            </div>
        </div>
    </div>
    <div class="container pb-5 pt-4 mb-2 mb-md-4">
        <section>
            <div id="products-search">
                <!--Loading-->
                <button class="btn btn-primary d-block w-100 mt-5" type="button">
                    <span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>
                    Loading...
                </button>
            </div>
        </section>
    </div>
</div>