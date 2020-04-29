<div class="modal fade" id="rateUserModal" tabindex="-1" role="dialog" aria-labelledby="rateUserModalLabel">
    <div class="modal-dialog" role="document">
        <form method="POST" action="{{route('user-rates.store')}}" class="modal-content">
            {{csrf_field()}}
            <input type="hidden" name="user_id" value="{{auth()->id()}}">
            <input type="hidden" name="start" id="rateHidden">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="rateUserModalLabel">Rate</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="">Description</label>
                    <textarea class="form-control" name="description" id="" cols="30"></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary">Done</button>
            </div>
        </form>
    </div>
</div>