<table class="table">
    <thead>
    <tr>
        <th>{{trans('label.user_id')}}</th>
<th>{{trans('label.crazy_id')}}</th>
<th>{{trans('label.score')}}</th>
<th>{{trans('label.type')}}</th>

        <th></th>
    </tr>
    </thead>
    <tbody>
    @foreach($crazyWriteHistories as $row)
    <tr class="{{$row->is_active === 1 ? : 'text-danger'}}">
        <td>{{$row->user_id}}</td>
<td>{{$row->crazy_id}}</td>
<td>{{$row->score}}</td>
<td>{{$row->type}}</td>

        <td class="text-right">
            <form method="POST" action="{{route('crazy-write-histories.destroy', $row->id)}}">
                {{csrf_field()}}
                {{method_field('DELETE')}}
                <button class="btn btn-danger btn-xs destroyBtn">
                    <i class="fa fa-trash"></i>
                </button>
                <a href="{{route('crazy-write-histories.edit', $row->id)}}" class="btn btn-info btn-xs">
                    <i class="fa fa-edit"></i>
                </a>
                <a href="{{route('crazy-write-histories.show', $row->id)}}" class="btn btn-info btn-xs">
                    <i class="fa fa-eye"></i>
                </a>
            </form>
        </td>
    </tr>
    @endforeach
    </tbody>
</table>

<div id="linkPaginate">
    {{$crazyWriteHistories->links()}}
</div>
