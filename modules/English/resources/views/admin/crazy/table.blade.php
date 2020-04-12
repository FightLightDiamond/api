<table class="table">
    <thead>
    <tr>
        <th>Image</th>
        <th>{{trans('label.name')}}</th>
        <th>{{trans('label.audio')}}</th>
        {{--<th>{{trans('label.created_by')}}</th>--}}
        {{--<th>{{trans('label.updated_by')}}</th>--}}
        {{--<th>{{trans('label.is_active')}}</th>--}}

        <th></th>
    </tr>
    </thead>
    <tbody>
    @foreach($crazies as $row)
        <tr class="{{$row->is_active === 1 ? : 'text-danger'}}">
            <td>
                <img src="{{$row->img}}" alt="" width="150px">
            </td>
            <td>{{$row->name}}</td>
            <td>
                <audio controls src="{{$row->getAudioPath()}}">
                    <source src="{{$row->getAudioPath()}}" type="audio/mpeg">
                </audio></td>
            {{--<td>{{$row->created_by}}</td>--}}
            {{--<td>{{$row->updated_by}}</td>--}}
            {{--<td>{{$row->is_active}}</td>--}}

            <td class="text-right">
                <form method="POST" action="{{route('admin.crazies.destroy', $row->id)}}">
                    {{csrf_field()}}
                    {{method_field('DELETE')}}
                    <button class="btn btn-danger btn-xs destroyBtn">
                        <i class="fa fa-trash"></i>
                    </button>
                    <a href="{{route('admin.crazies.edit', $row->id)}}" class="btn btn-info btn-xs">
                        <i class="fa fa-edit"></i>
                    </a>
                    {{--<a href="{{route('admin.crazies.show', $row->id)}}" class="btn btn-info btn-xs">--}}
                        {{--<i class="fa fa-eye"></i>--}}
                    {{--</a>--}}
                </form>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

<div id="linkPaginate">
    {{$crazies->links()}}
</div>
