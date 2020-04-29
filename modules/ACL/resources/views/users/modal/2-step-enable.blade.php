<div class="modal fade" id="twoStepEnable" tabindex="-1" role="dialog" aria-labelledby="twoStepEnableLabel">
    <div class="modal-dialog modal-setting" role="document">
        <form class="modal-content" action="{{route('otp.google.enable')}}" method="POST" id="twoStepEnableForm">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="twoStepLabel">2-Step Enable</h4>
            </div>
            <div class="modal-body">
                <div class="row" >
                    <div class="col-sm-12 form-group">
                        <label for="" class="area-label-input">{{__('label.password')}}</label>
                        <input name="password" type="password" class="form-control input-form-modal" required>
                    </div>
                    <div class="col-sm-12 form-group">
                        <label for="" class="area-label-input">{{__('label.otp')}}</label>
                        <input name="otp" type="number" class="form-control input-form-modal" required>
                    </div>
                </div>
                <button class="btn btn-primary">Done</button>
            </div>
        </form>
    </div>
</div>
