@extends('en::test.layout')

@section('content')
    <h1>Tìm từ phát âm khác biệt</h1>
    <form action="{{route('test.pronunciation.done')}}?page={{request()->get('page')}}" method="POST" id="formTest">
        {{csrf_field()}}
        @foreach($questions as $k => $question)
            <div class="form-group" id="{{$k+1}}">
                <strong>{{__('label.question')}} {{++$k}}</strong>
                <input type="checkbox" data="{{$k}}" class="unsure pull-right" data-toggle="tooltip" data-placement="bottom"
                       title="Bạn chưa chắc chắn ">
            </div>
            <div class="form-group text-info speakEnglish">{{$question->question}} </div>
            <table class="table">
                @foreach(REPLIES as $i => $rep)
                    <tr>
                        <td width="20px">
                            <input type="radio" value="{{$i}}" class="done" data="{{$k}}"
                                   name="answer{{$question->id}}">
                        </td>
                        <td class="speakEnglish">
                            {!! ViewFa::underline($question["pronunciation_{$rep}"], $question->$rep ); !!}
                        </td>
                    </tr>
                @endforeach
            </table>
        @endforeach
    </form>
@endsection
