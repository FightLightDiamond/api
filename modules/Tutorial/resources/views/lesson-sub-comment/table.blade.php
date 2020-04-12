<table class="table">
    <tr>
        <th>{{trans('label.lesson_comment')}}</th>
<th>{{trans('label.content')}}</th>
<th>{{trans('label.create_by')}}</th>
<th>{{trans('label.is_active')}}</th>

        <th></th>
    </tr>
    @foreach($lessonSubComments as $row)
    <tr>
        <td>{{$row->lesson_comment}}</td>
<td>{{$row->content}}</td>
<td>{{$row->create_by}}</td>
<td>{{$row->is_active}}</td>

       <td>
           <form method="POST" action="{{route('lesson-sub-comment.destroy', $row->id)}}">
               {{csrf_field()}}
               {{method_field('DELETE')}}
               <button class="btn btn-danger btn-xs">
                   <i class="fa fa-trash"></i>
               </button>
               <a href="{{route('lesson-sub-comment.edit', $row->id)}}" class="btn btn-info btn-xs">
                   <i class="fa fa-edit"></i>
               </a>
               <a href="{{route('lesson-sub-comment.show', $row->id)}}" class="btn btn-info btn-xs">
                   <i class="fa fa-eye"></i>
               </a>
           </form>
       </td>
    </tr>
    @endforeach
</table>

<div id="linkPaginate">
    {{$lessonSubComments->links()}}
</div>
