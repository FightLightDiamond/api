<table class="table">
    <thead>
    <tr>

        <th>{{trans('label.question')}}</th>
        <th>{{trans('label.a')}}</th>
        <th>{{trans('label.b')}}</th>
        <th>{{trans('label.c')}}</th>
        <th>{{trans('label.d')}}</th>
        <th>{{trans('label.answer')}}</th>
        {{--<th>{{trans('label.repair')}}</th>--}}
        {{--<th>{{trans('label.is_active')}}</th>--}}
        <th></th>
    </tr>
    </thead>
    <tbody>
    @foreach($mistakes as $row)
        <tr class="{{$row->is_active === 1 ? : 'text-danger'}}">

            <td class="speakEnglish">{!! \ViewFa::mistake($row) !!}</td>
            <td class="speakEnglish">{{$row->a}}</td>
            <td class="speakEnglish">{{$row->b}}</td>
            <td class="speakEnglish">{{$row->c}}</td>
            <td class="speakEnglish">{{$row->d}}</td>
            <td>{{$row->answer}}</td>
            {{--<td>{{$row->repair}}</td>--}}
{{--            <td>{{$row->is_active}}</td>--}}
            <td class="text-right">
                <form method="POST" action="{{route('admin.mistakes.destroy', $row->id)}}">
                    {{csrf_field()}}
                    {{method_field('DELETE')}}
                    <button class="btn btn-danger btn-xs destroyBtn">
                        <i class="fa fa-trash"></i>
                    </button>
                    <a href="{{route('admin.mistakes.edit', $row->id)}}" class="btn btn-info btn-xs">
                        <i class="fa fa-edit"></i>
                    </a>
                    <a href="{{route('admin.mistakes.show', $row->id)}}" class="btn btn-info btn-xs">
                        <i class="fa fa-eye"></i>
                    </a>
                </form>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

<div id="linkPaginate">
    {{$mistakes->links()}}
</div>
