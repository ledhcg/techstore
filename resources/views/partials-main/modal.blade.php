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
