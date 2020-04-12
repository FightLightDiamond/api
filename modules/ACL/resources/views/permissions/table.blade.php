<table class="table table-hover table-nomargin table-condensed table-responsive" id="table">
    <tr>
        {{--<th>--}}
            {{--<div class="checkbox checkbox-replace color-primary">--}}
                {{--<input type="checkbox">--}}
            {{--</div>--}}
        {{--</th>--}}
        <th>Name</th>
        <th>Display name</th>
        <th>Is active</th>
        <th>Role</th>
        <th></th>
    </tr>
    @foreach($permissions as $permission)
        <tr>
            {{--<td>--}}
                {{--<input type="checkbox" id="{{$permission->id}}">--}}
            {{--</td>--}}
            <td><a href="{{route('permissions.edit', $permission->id)}}">{{$permission->name}}</a></td>
            <td>{{$permission->display_name}}</td>
            <td>{!! $permission->is_active ? '<i class="fa fa-check text-success"></i>' : '<i class="fa fa-ban text-danger"></i>' !!}</td>
            <td>
                <a data-toggle="modal" data-target="#role_permission" class="btn btn-sm btn-default"
                   onclick="getRoles('{{$permission->id}}', '{{route('involve.permission.roles')}}')">Set Role </a>
                <form class="form-group" action="{{route('permissions.destroy', $permission->id)}}" method="POST"
                      style="display: inline">
                    {{csrf_field()}}
                    {{method_field('DELETE')}}
                    <button class="btn btn-danger destroyBtn btn-sm"><i class="fa fa-remove"></i></button>
                </form>
            </td>
        </tr>
    @endforeach
</table>