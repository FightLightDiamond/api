<table class="table">
    <tr>

        <th>{{trans('label.lesson_id')}}</th>
        <th>{{trans('label.questions')}}</th>
{{--        <th>{{trans('label.answer')}}</th>--}}
{{--        <th>{{trans('label.is_active')}}</th>--}}
        <th>{{trans('label.created_by')}}</th>
        <th>{{trans('label.updated_by')}}</th>
        <th></th>
    </tr>
    @foreach($lessonTests as $row)
        <tr class="{{$row->is_active === 1 ? : 'text-danger'}}" >

            <td>{{$row->lesson ? $row->lesson->title : ''}}</td>
            <td>{!! $row->question !!}</td>
            {{--<td>{{$row->answer}}</td>--}}
{{--            <td>{{$row->is_active}}</td>--}}
            <td>{{$row->creatorName('email')}}</td>
            <td>{{$row->updaterName('email')}}</td>
            <td class="text-right">
                <form method="POST" action="{{route('lesson-test.destroy', $row->id)}}">
                    {{csrf_field()}}
                    {{method_field('DELETE')}}
                    <button class="btn btn-danger btn-xs destroyBtn">
                        <i class="fa fa-trash"></i>
                    </button>
                    <a href="{{route('lesson-test.edit', $row->id)}}" class="btn btn-info btn-xs">
                        <i class="fa fa-edit"></i>
                    </a>
                    <a href="{{route('lesson-test.show', $row->id)}}" class="btn btn-info btn-xs">
                        <i class="fa fa-eye"></i>
                    </a>
                </form>
            </td>
        </tr>
    @endforeach
</table>

<div id="linkPaginate">
    {{$lessonTests->links()}}
</div>
