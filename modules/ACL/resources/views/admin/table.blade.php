<table class="table table-hover">
    <thead>
    <tr>
        <th>{{trans('label.name')}}</th>
<th>{{trans('label.email')}}</th>
<th>{{trans('label.password')}}</th>
<th>{{trans('label.remember_token')}}</th>

        <th></th>
    </tr>
    </thead>
    <tbody>
    @foreach($admins as $row)
    <tr class="{{$row->is_active === 1 ? : 'text-danger'}}">
        <td>{{$row->name}}</td>
<td>{{$row->email}}</td>
<td>{{$row->password}}</td>
<td>{{$row->remember_token}}</td>

        <td class="text-right">
            <form method="POST" action="{{route('admins.destroy', $row->id)}}">
                {{csrf_field()}}
                {{method_field('DELETE')}}
                <button class="btn btn-danger btn-xs destroyBtn">
                    <i class="fa fa-trash"></i>
                </button>
                <a href="{{route('admins.edit', $row->id)}}" class="btn btn-info btn-xs">
                    <i class="fa fa-edit"></i>
                </a>
                <a href="{{route('admins.show', $row->id)}}" class="btn btn-info btn-xs">
                    <i class="fa fa-eye"></i>
                </a>
            </form>
        </td>
    </tr>
    @endforeach
    </tbody>
</table>

<div id="linkPaginate">
    {{$admins->links()}}
</div>
