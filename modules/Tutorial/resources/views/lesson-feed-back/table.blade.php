<table class="table">
    <tr>

        <th>{{trans('label.lesson_id')}}</th>
        <th>{{trans('label.title')}}</th>
        <th>{{trans('label.content')}}</th>
        <th>{{trans('label.create_by')}}</th>
        <th>{{trans('label.is_active')}}</th>

        <th></th>
    </tr>
    @foreach($lessonFeedBacks as $row)
        <tr class="{{$row->is_active === 1 ? : 'text-danger'}}" >

            <td>{{$row->lesson_id}}</td>
            <td>{{$row->title}}</td>
            <td>{{$row->content}}</td>
            <td>{{$row->create_by}}</td>
            <td>{{$row->is_active}}</td>

            <td>
                <form method="POST" action="{{route('lesson-feed-back.destroy', $row->id)}}">
                    {{csrf_field()}}
                    {{method_field('DELETE')}}
                    <button class="btn btn-danger btn-xs destroyBtn">
                        <i class="fa fa-trash"></i>
                    </button>
                    <a href="{{route('lesson-feed-back.edit', $row->id)}}" class="btn btn-info btn-xs">
                        <i class="fa fa-edit"></i>
                    </a>
                    <a href="{{route('lesson-feed-back.show', $row->id)}}" class="btn btn-info btn-xs">
                        <i class="fa fa-eye"></i>
                    </a>
                </form>
            </td>
        </tr>
    @endforeach
</table>

<div id="linkPaginate">
    {{$lessonFeedBacks->links()}}
</div>
