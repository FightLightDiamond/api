<table class="table">
    <thead>
    <tr>
        <th>{{trans('label.crazy_id')}}</th>
<th>{{trans('label.no')}}</th>
<th>{{trans('label.sentence')}}</th>
<th>{{trans('label.meaning')}}</th>
<th>{{trans('label.created_by')}}</th>
<th>{{trans('label.updated_by')}}</th>
<th>{{trans('label.is_active')}}</th>

        <th></th>
    </tr>
    </thead>
    <tbody>
    @foreach($crazyDetails as $row)
    <tr class="{{$row->is_active === 1 ? : 'text-danger'}}">
        <td>{{$row->crazy_id}}</td>
<td>{{$row->no}}</td>
<td>{{$row->sentence}}</td>
<td>{{$row->meaning}}</td>
<td>{{$row->created_by}}</td>
<td>{{$row->updated_by}}</td>
<td>{{$row->is_active}}</td>

        <td class="text-right">
            <form method="POST" action="{{route('admin.crazies.detail.destroy', $row->id)}}">
                {{csrf_field()}}
                {{method_field('DELETE')}}
                <button class="btn btn-danger btn-xs destroyBtn">
                    <i class="fa fa-trash"></i>
                </button>
                <a href="{{route('admin.crazies.detail.edit', $row->id)}}" class="btn btn-info btn-xs">
                    <i class="fa fa-edit"></i>
                </a>
                <a href="{{route('admin.crazies.detail.show', $row->id)}}" class="btn btn-info btn-xs">
                    <i class="fa fa-eye"></i>
                </a>
            </form>
        </td>
    </tr>
    @endforeach
    </tbody>
</table>

<div id="linkPaginate">
    {{$crazyDetails->links()}}
</div>
