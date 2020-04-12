<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Assign user</h4>
            </div>
            <div class="modal-body row">
                <form action="{{ route('tutorial.getUserForAssignTutorial') }}"  id="formFilter">
                    <input type="hidden" name="tutorial_id" value="{{$tutorial->id}}">
                    <div class="col-sm-4 form-group">
                        <label>Identity</label>
                        <input class="form-control inputFilter" name="identity">
                    </div>
                    <div class="col-sm-4 form-group">
                        <label>Email</label>
                        <input class="form-control inputFilter" name="email">
                    </div>
                    <div class="col-sm-4 form-group">
                        <label>Phone number</label>
                        <input class="form-control inputFilter" name="phone_number">
                    </div>
                </form>
{{--                    <input type="hidden" name="tutorial_id" value="{{$tutorial->id}}">--}}
{{--                    <input type="hidden" name="status" value="{{ ACTIVE }}">--}}
                <div id="table" class="col-sm-12">
                    @include('tut::tutorial.modals.tables.user', ['users' => $userCompose])
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
{{--                <button type="button" class="btn btn-primary">Save changes</button>--}}
            </div>
        </div>
    </div>
</div>
