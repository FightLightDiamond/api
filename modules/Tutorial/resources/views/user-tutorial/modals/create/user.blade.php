<div class="modal fade" id="userModal" tabindex="-1" role="dialog" aria-labelledby="userModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="userModalLabel">User list</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-4 form-group">
                        <input class="form-control inputFilterUser" name="email" placeholder="email">
                    </div>
                    <div class="col-sm-4 form-group">
                        <input class="form-control inputFilterUser" name="identity" placeholder="identity">
                    </div>
                    <div class="col-sm-4 form-group">
                        <select name="apartment_id" id="" class="form-control selectFilterUser">
                            <option value="">Select apartment</option>
                            @foreach($departmentCompose as $id => $name)
                                <option value="{{$id}}">{{$name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-12" id="tableUser">
{{--                        @include('tut::user-tutorial.modals.tables.user')--}}
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>
