<div class="modal fade" id="twoStep" tabindex="-1" role="dialog" aria-labelledby="twoStepLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="twoStepLabel">2-Step Verification</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>COPY CODE</label>
                    <input id="TwoStepTxt" readonly class="form-control" onclick="copyToClipboard('TwoStepTxt')">
                </div>
                <div class="form-group text-center">
                    <label for="" class="area-label-input">Or scan QRCode</label>
                    <div class="text-center" id="TowStepQrImage"></div>
                </div>
                <div class="text-right">
                    <button type="button" class="btn btn-primary" id="twoStepBtn">Next</button>
                </div>
            </div>
        </div>
    </div>
</div>