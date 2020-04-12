<div class="modal fade" tabindex="-1" role="dialog" id="change_password">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">Change password</h4>
            </div>
            <div class="modal-body">
                <form action="{{route('change-password')}}" method="POST">
                    {{csrf_field()}}
                    {{method_field('PUT')}}
                    <div class="form-group">
                        <label>{{trans('label.old_password')}}</label>
                        <input type="password" required class="form-control" name="old_password">
                    </div>
                    <div class="form-group">
                        <label>{{trans('label.new_password')}}</label>
                        <input type="password" required class="form-control" name="new_password">
                    </div>
                    <div class="form-group">
                        <label>{{trans('label.confirm_password')}}</label>
                        <input type="password" required class="form-control" name="new_password_confirmation">
                    </div>
                    <button type="submit" class="btn btn-default">Submit</button>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->