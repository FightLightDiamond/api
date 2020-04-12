<table class="table">
    <tr>

        <th>{{trans('label.created_by')}}</th>
        <th>{{trans('label.lesson_id')}}</th>
        <th>{{trans('label.score')}}</th>

        <th></th>
    </tr>
    @foreach($lessonResults as $row)
        <tr class="{{$row->is_active === 1 ? : 'text-danger'}}" >

            <td>{{$row->creatorName()}}</td>
            <td>{{$row->lesson? $row->lesson->title : ''}}</td>
            <td>{{$row->score}}</td>

            <td>
                <form method="POST" action="{{route('lesson-result.destroy', $row->id)}}">
                    {{csrf_field()}}
                    {{method_field('DELETE')}}
                    <button class="btn btn-danger btn-xs destroyBtn">
                        <i class="fa fa-trash"></i>
                    </button>
                    <a href="{{route('lesson-result.edit', $row->id)}}" class="btn btn-info btn-xs">
                        <i class="fa fa-edit"></i>
                    </a>
                    <a href="{{route('lesson-result.show', $row->id)}}" class="btn btn-info btn-xs">
                        <i class="fa fa-eye"></i>
                    </a>
                </form>
            </td>
        </tr>
    @endforeach
</table>

<div id="linkPaginate">
    {{$lessonResults->links()}}
</div>
