<table class="table">
    <thead>
    <tr>

        <th>{{trans('label.a')}}</th>
        <th>{{trans('label.b')}}</th>
        <th>{{trans('label.c')}}</th>
        <th>{{trans('label.d')}}</th>
        <th>{{trans('label.answer')}}</th>
        <th>{{trans('label.is_active')}}</th>
        <th></th>
    </tr>
    </thead>
    <tbody>
    @foreach($pronunciations as $row)
        <tr class="{{$row->is_active === 1 ? : 'text-danger'}}">

            <td class="speakEnglish">{!! ViewFa::underline($row->pronunciation_a, $row->a ); !!} </td>
            <td class="speakEnglish">{!! ViewFa::underline($row->pronunciation_b, $row->b ); !!} </td>
            <td class="speakEnglish">{!! ViewFa::underline($row->pronunciation_c, $row->c ); !!} </td>
            <td class="speakEnglish">{!! ViewFa::underline($row->pronunciation_d, $row->d ); !!} </td>
            <td>{{$row->answer}}</td>
            <td>{{$row->is_active}}</td>

            <td class="text-right">
                <form method="POST" action="{{route('admin.pronunciations.destroy', $row->id)}}">
                    {{csrf_field()}}
                    {{method_field('DELETE')}}
                    <button class="btn btn-danger btn-xs destroyBtn">
                        <i class="fa fa-trash"></i>
                    </button>
                    <a href="{{route('admin.pronunciations.edit', $row->id)}}" class="btn btn-info btn-xs">
                        <i class="fa fa-edit"></i>
                    </a>
                    <a href="{{route('admin.pronunciations.show', $row->id)}}" class="btn btn-info btn-xs">
                        <i class="fa fa-eye"></i>
                    </a>
                </form>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
<div id="linkPaginate">
    {{$pronunciations->links()}}
</div>
