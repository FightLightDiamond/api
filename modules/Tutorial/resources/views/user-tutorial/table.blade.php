<table class="table">
    <tr>
        <th>{{trans('label.name')}}</th>
        {{--<th>{{trans('label.img')}}</th>--}}
        {{--<th>{{trans('label.is_active')}}</th>--}}
        <th></th>
    </tr>
    @foreach($user_tutorials as $row)
        <tr  class="{{$row->is_active === 1 ? : 'text-danger'}}">
            <td>{{$row->name}}</td>
            {{--<td>{{$row->img}}</td>--}}
            {{--<td>{{$row->is_active}}</td>--}}
            <td class="text-right">
                <form method="POST" action="{{route('tutorial.destroy', $row->id)}}">
                    {{csrf_field()}}
                    {{method_field('DELETE')}}
                    <button class="btn btn-danger btn-xs destroyBtn">
                        <i class="fa fa-trash"></i>
                    </button>
                    <a href="{{route('tutorial.edit', $row->id)}}" class="btn btn-info btn-xs">
                        <i class="fa fa-edit"></i>
                    </a>
                    {{--<a href="{{route('tutorial.show', $row->id)}}" class="btn btn-info btn-xs">--}}
                        {{--<i class="fa fa-eye"></i>--}}
                    {{--</a>--}}
                    <a class="btn btn-info btn-xs"
                       href="{{route('section.index')}}?tutorial_id={{$row->id}}">{{trans('table.sections')}}</a>
                </form>
            </td>
        </tr>
    @endforeach
</table>

<div id="linkPaginate">
    {{$user_tutorials->links()}}
</div>
