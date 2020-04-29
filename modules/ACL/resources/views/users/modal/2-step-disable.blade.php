<div class="modal fade" id="twoStepDisable" tabindex="-1" role="dialog" aria-labelledby="twoStepDisableLabel">
    <div class="modal-dialog modal-setting" role="document">
        <form class="modal-content"  action="{{route("otp.google.disable")}}" method="POST" id="twoStepDisableForm">
            <div class="modal-header">
                <h4 class="modal-title" id="twoStepDisableLabel">2-Step disable</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i class="fa fa-close"></i>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12 form-group">
                        <label for="" class="area-label-input">{{__('label.password')}}</label>
                        <input name="password" type="password" class="form-control input-form-modal" required>
                    </div>
                    <div class="col-sm-12 form-group">
                        <label for="" class="area-label-input">{{__('label.otp')}}</label>
                        <input name="otp" type="number" class="form-control input-form-modal" required>
                    </div>
                </div>
                <button class="btn btn-setting">Done</button>
            </div>
        </form>
    </div>
</div>
