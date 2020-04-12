<table class="table">
    <tr>
        <th>{{trans('label.title')}}</th>
        <th>{{trans('label.section_id')}}</th>
        <th>{{trans('label.views')}}</th>
        <th>{{trans('label.last_view')}}</th>
        <th>{{trans('label.created_by')}}</th>
        <th>{{trans('label.updated_by')}}</th>
        <th></th>
    </tr>
    @foreach($lessons as $row)
        <tr class="{{$row->is_active === 1 ? : 'text-danger'}}" >
            <td>{{$row->title}}</td>
            <td>{{$row->section ? $row->section->name : ''}}</td>
            <td>{{$row->views}}</td>
            <td>{{$row->last_view}}</td>
            <td>{{$row->creatorName()}}</td>
            <td>{{$row->updaterName()}}</td>
            <td class="text-right">
                <form method="POST" action="{{route('lesson.destroy', $row->id)}}">
                    {{csrf_field()}}
                    {{method_field('DELETE')}}
                    <button class="btn btn-danger btn-xs destroyBtn">
                        <i class="fa fa-trash"></i>
                    </button>
                    <a href="{{route('lesson.edit', $row->id)}}" class="btn btn-info btn-xs">
                        <i class="fa fa-edit"></i>
                    </a>
                    <a href="{{route('lesson.show', $row->id)}}" class="btn btn-info btn-xs">
                        <i class="fa fa-eye"></i>
                    </a>
                    <a href="{{route('lesson-test.create')}}?lesson_id={{$row->id}}" class="btn btn-primary btn-xs ">
                        <i class="fa fa-question-circle"></i>
                    </a>
                </form>
            </td>
        </tr>
    @endforeach
</table>

<div id="linkPaginate">
    {{$lessons->links()}}
</div>
