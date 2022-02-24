<div class="modal fade" id="modal_crop_image" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalLabel">{{__('main.Change avatar')}}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="img-container">
                    <div class="row">
                        <div class="col-md-8" style="border-radius: 30px" >
                            <img id="image_crop" src="https://avatars0.githubusercontent.com/u/3456749">
                        </div>
                        <div class="col-md-4">
                            <div class="preview_image rounded"></div>
                        </div>
                        <style>
                            .preview_image {
                                overflow: hidden;
                                width: 160px;
                                height: 160px;
                            }
                        </style>

                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">{{__('main.Close')}}</button>
                <button type="button" class="btn btn-primary btn-sm"  id="crop">{{__('main.Save')}}</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-order-tracking" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">{{__('main.Search your order')}}</h4>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="order-tracking-input" class="form-label">{{__('main.Your order tracking')}}</label>
                    <input class="form-control" type="text" id="order-tracking-input" placeholder="XXXXXXXXXX">
                </div>
                <div id="alert-error-order-tracking"></div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary btn-sm" type="button" data-bs-dismiss="modal">{{__('main.Close')}}</button>
                <button class="btn btn-primary btn-shadow btn-sm" type="button" id="tracking-btn">{{__('main.TRACKING')}}</button>
            </div>
        </div>
    </div>
</div>

