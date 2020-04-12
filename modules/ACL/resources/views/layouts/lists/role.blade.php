<ul class="list-group">
    <li class="list-group-item">
        <div class="checkbox checkbox-replace color-primary pull-right">
            <input type="checkbox">
        </div>
        All
    </li>
    @foreach($roleCompose as $key => $role)
        <li class="list-group-item">
            <div class="checkbox checkbox-replace color-primary pull-right">
                <input type="checkbox" name="role[]" value="{{$key}}" class="role_id">
            </div>
            {{$role}}
        </li>
    @endforeach
</ul>