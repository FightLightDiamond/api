<table class="table">
    <tr>
        @foreach($columns as $name => $sort)
            <th>{{trans('label.'.$name)}} <span class="fa fa-sort{{$sort ? '-' . $sort : ''}} sortFilter" name="{{$name}}" sort="{{$sort}}"></span></th>
        @endforeach
        <th></th>
        <th></th>
    </tr>
    @foreach($tutorials as $row)
        <tr>
            @foreach($columns as $name => $sort)
                <td>{{$row->$name}}</td>
            @endforeach
            <th class="text-right"><a href="{{route('tutorial.managerUsers', $row->id)}}" class="btn btn-primary btn-xs">Manager User</a></th>
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
    {{$tutorials->links()}}
</div>
