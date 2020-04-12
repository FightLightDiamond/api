<table class="table">
    <thead>
    <tr>
        <th>{{trans('label.tutorial_id')}}</th>
        <th>{{trans('label.questions')}}</th>
        <th>{{trans('label.answer')}}</th>
        <th></th>
    </tr>
    </thead>
    <tbody>
    @foreach($tutorialTests as $row)
        <tr  class="{{$row->is_active === 1 ? : 'text-danger'}}">
            <td>{{@$row->tutorial->name}}</td>
            <td>{{$row->question}}</td>
            <td>{{$row->answer}}</td>
            <td>
                <form method="POST" action="{{route('tutorial-test.destroy', $row->id)}}">
                    {{csrf_field()}}
                    {{method_field('DELETE')}}
                    <button class="btn btn-danger btn-xs destroyBtn">
                        <i class="fa fa-trash"></i>
                    </button>
                    <a href="{{route('tutorial-test.edit', $row->id)}}" class="btn btn-info btn-xs">
                        <i class="fa fa-edit"></i>
                    </a>
                    <a href="{{route('tutorial-test.show', $row->id)}}" class="btn btn-info btn-xs">
                        <i class="fa fa-eye"></i>
                    </a>
                </form>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

<div id="linkPaginate">
    {{$tutorialTests->links()}}
</div>
