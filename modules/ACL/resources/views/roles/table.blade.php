<table class="table table-hover table-nomargin">
    <tr>
        <th>
            <div class="check">
                <input type="checkbox" class='icheck-me' data-skin="square" data-color="blue">
            </div>
        </th>
        <th>{{__('label.name')}}</th>
        <th>{{__('label.display_name')}}</th>
        <th>{{__('label.is_active')}}</th>
        <th>Set permission</th>
    </tr>
    @foreach($roles as $role)
    <tr>
        <td>
            <div class="check">
                <input type="checkbox">
            </div>
        </td>
        <td><a href="{{route('roles.edit', $role->id)}}">{{$role->name}}</a></td>
        <td>{{$role->display_name}}</td>
        <td>{!! $role->is_active ? '<i class="fa fa-check"></i>' : '<i class="fa fa-ban"></i>' !!}</td>
        <td class="text-right">
            <form class="form-group" action="{{route('roles.destroy', $role->id)}}" method="POST">
                {{csrf_field()}}
                {{method_field('DELETE')}}
                <a data-toggle="modal" data-target="#role_permission" class="btn btn-xs btn-default set_role_permission" data="{{$role->id}}">Set Permission </a>
                <button class="btn btn-danger destroyBtn btn-xs">
                    <i class="fa fa-remove"></i>
                </button>
            </form>
        </td>
    </tr>
    @endforeach
</table>
