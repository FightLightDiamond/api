<div class="modal fade" tabindex="-1" role="dialog" id="profile">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Update profile</h4>
            </div>
            <div class="modal-body">
                <form action="{{route('profile.update', $user->id)}}" method="POST" enctype="multipart/form-data">
                    {{csrf_field()}}
                    {{method_field('PUT')}}
                    <div class="form-group">
                        <label>{{trans('label.first_name')}}</label>
                        <input class="form-control" name="first_name" value="{{$user->first_name}}">
                    </div>
                    <div class="form-group">
                        <label>{{trans('label.last_name')}}</label>
                        <input class="form-control" name="last_name" value="{{$user->last_name}}">
                    </div>
                    <div class="form-group">
                        <label>{{trans('label.email')}}</label>
                        <input type="email" class="form-control" required name="email" value="{{$user->email}}">
                    </div>
                    <div class="form-group">
                        <label>{{trans('label.phone_number')}}</label>
                        <input type="number" class="form-control" name="phone_number"
                               value="{{$user->phone_number}}">
                    </div>
                    <div class="form-group">
                        <label>{{trans('label.sex')}}</label>
                        <div >
                            <input type="radio" @if((int)$user->sex === 1) checked @endif name="sex"
                                   value="1"> {{trans('label.male')}}
                            <input type="radio" @if((int)$user->sex === 0) checked @endif  name="sex"
                                   value="0"> {{trans('label.female')}}
                        </div>
                    </div>
                    <div class="form-group">
                        <label>{{trans('label.birthday')}}</label>
                        <input class="form-control" name="birthday" value="{{$user->birthday}}" id="birthday">
                    </div>
                    <div class="form-group">
                        <label>{{trans('label.address')}}</label>
                        <input class="form-control" name="address" value="{{$user->address}}">
                    </div>
                    <div class="form-group">
                        <label>{{trans('label.avatar')}}</label>
                        <input type="file" class="form-control" name="avatar">
                    </div>
                    <button type="submit" class="btn btn-default">Submit</button>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->