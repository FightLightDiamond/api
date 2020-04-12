<ul class="list-group">
    <li class="list-group-item">
        <div class="checkbox checkbox-replace color-primary pull-right">
            <input type="checkbox">
        </div>
        All
    </li>
    @foreach($permissionCompose as $key => $permission)
        <li class="list-group-item">
            <div class="checkbox checkbox-replace color-primary pull-right">
                <input type="checkbox" name="permission_ids[]" value="{{$key}}" class="permission_id">
            </div>
            {{$permission}}
        </li>
    @endforeach
</ul>