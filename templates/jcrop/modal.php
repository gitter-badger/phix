<div class="modal fade bs-example-modal-lg" id="modal_crop" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button class="close" data-dismiss="modal">×</button>
                <h3 class="modal-title">Кадрирование фото</h3>
                <p class="text-muted" id="modal_crop_filename"></p>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-xs-12 thumbnail" id="modal_crop_body">
                        <img src="" class="img-responsive" id="target" alt="" /><? // class="mfp-fade item-gallery img-responsive" ?>
                    </div>
                </div>

                <input type="hidden" size="4" id="x1" name="x1" />
                <input type="hidden" size="4" id="y1" name="y1" />
                <input type="hidden" size="4" id="x2" name="x2" />
                <input type="hidden" size="4" id="y2" name="y2" />
                <input type="hidden" size="4" id="w" name="w" />
                <input type="hidden" size="4" id="h" name="h" />
                <input type="hidden" size="4" id="bx" name="bx" />
                <input type="hidden" size="4" id="by" name="by" />

            </div>
            <div class="modal-footer">
                <button class="btn btn-success" onclick="ajax_photo_crop();">Кадрировать</button>
            </div>
        </div>
    </div>
</div>