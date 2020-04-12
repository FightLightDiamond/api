<table class="table">
    <tr>

        <th>{{trans('label.section_id')}}</th>
        <th>{{trans('label.questions')}}</th>
        <th>{{trans('label.answer')}}</th>
        <th>{{trans('label.is_active')}}</th>
        <th>{{trans('label.created_by')}}</th>
        <th>{{trans('label.updated_by')}}</th>

        <th></th>
    </tr>
    @foreach($sectionTests as $row)
        <tr class="{{$row->is_active === 1 ? : 'text-danger'}}">

            <td>{{$row->section_id}}</td>
            <td>{{$row->questions}}</td>
            <td>{{$row->answer}}</td>
            <td>{{$row->is_active}}</td>
            <td>{{$row->created_by}}</td>
            <td>{{$row->updated_by}}</td>
            <td>
                <form method="POST" action="{{route('section-test.destroy', $row->id)}}">
                    {{csrf_field()}}
                    {{method_field('DELETE')}}
                    <button class="btn btn-danger btn-xs destroyBtn">
                        <i class="fa fa-trash"></i>
                    </button>
                    <a href="{{route('section-test.edit', $row->id)}}" class="btn btn-info btn-xs">
                        <i class="fa fa-edit"></i>
                    </a>
                    <a href="{{route('section-test.show', $row->id)}}" class="btn btn-info btn-xs">
                        <i class="fa fa-eye"></i>
                    </a>
                </form>
            </td>
        </tr>
    @endforeach
</table>

<div id="linkPaginate">
    {{$sectionTests->links()}}
</div>
