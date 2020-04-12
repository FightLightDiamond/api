<table class="table table-hover">
    <thead>
    <tr>
        <th>{{trans('label.author')}}</th>
<th>{{trans('label.content')}}</th>

        <th></th>
    </tr>
    </thead>
    <tbody>
    @foreach($messages as $row)
    <tr class="{{$row->is_active === 1 ? : 'text-danger'}}">
        <td>{{$row->author}}</td>
<td>{{$row->content}}</td>

        <td class="text-right">
            <form method="POST" action="{{route('messages.destroy', $row->id)}}">
                {{csrf_field()}}
                {{method_field('DELETE')}}
                <button class="btn btn-danger btn-xs destroyBtn">
                    <i class="fa fa-trash"></i>
                </button>
                <a href="{{route('messages.edit', $row->id)}}" class="btn btn-info btn-xs">
                    <i class="fa fa-edit"></i>
                </a>
                <a href="{{route('messages.show', $row->id)}}" class="btn btn-info btn-xs">
                    <i class="fa fa-eye"></i>
                </a>
            </form>
        </td>
    </tr>
    @endforeach
    </tbody>
</table>

<div id="linkPaginate">
    {{$messages->links()}}
</div>
