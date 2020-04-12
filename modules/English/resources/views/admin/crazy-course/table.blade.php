<table class="table">
    <thead>
    <tr>
        <th>{{trans('label.img')}}</th>
        <th>{{trans('label.name')}}</th>
        <th>{{trans('label.description')}}</th>
{{--        <th>{{trans('label.created_by')}}</th>--}}
{{--        <th>{{trans('label.updated_by')}}</th>--}}
        <th></th>
    </tr>
    </thead>
    <tbody>
    @foreach($crazyCourses as $row)
        <tr class="{{$row->is_active === 1 ? : 'text-danger'}}">
            <td>
                <img src="{{$row->getThumbPath('img', [200, 200])}}" alt="{{$row->name}}">
            </td>
            <td>{{$row->name}}</td>
            <td>{!! $row->description !!}</td>
            <td>{{$row->is_active}}</td>
{{--            <td>{{$row->creatorName()}}</td>--}}
{{--            <td>{{$row->updaterName()}}</td>--}}

            <td class="text-right">
                <form method="POST" action="{{route('admin.crazy-courses.destroy', $row->id)}}">
                    {{csrf_field()}}
                    {{method_field('DELETE')}}
                    <button class="btn btn-danger btn-xs destroyBtn">
                        <i class="fa fa-trash"></i>
                    </button>
                    <a href="{{route('admin.crazy-courses.edit', $row->id)}}" class="btn btn-info btn-xs">
                        <i class="fa fa-edit"></i>
                    </a>
                    <a href="{{route('admin.crazy-courses.show', $row->id)}}" class="btn btn-info btn-xs">
                        <i class="fa fa-eye"></i>
                    </a>
                </form>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

<div id="linkPaginate">
    {{$crazyCourses->links()}}
</div>
