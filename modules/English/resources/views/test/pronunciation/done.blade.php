@extends('en::test.layout')

@section('content')
    <h4>Tìm từ phát âm khác biệt</h4>
    <form action="{{route('test.pronunciation.done')}}?page={{$page}}" method="POST" id="formTest">
        {{csrf_field()}}
        @foreach($questions as $k => $question)
            <div class="form-group" id="{{$k+1}}">
                <strong>{{__('label.question')}} {{++$k}}</strong>
                <input type="checkbox" data="{{$k}}" class="unsure pull-right" data-toggle="tooltip"
                       data-placement="bottom" title="Bạn chưa chắc chắn ">
            </div>
            <div class="form-group speakEnglish">{{$question->question}}</div>
            <table class="table">
                @if(isset($replies[$answer = 'answer' . $question->id]))
                    @foreach(REPLIES as $i => $rep)
                        <tr class="@if($exactly[$question->id] && $replies[$answer] == $i) bg-success @endif">
                            <td width="20px">
                                <input type="radio" value="{{$i}}"
                                       @if($exactly[$question->id] && $replies[$answer] == $i) checked
                                       @endif  name="answer{{$question->id}}">
                            </td>
                            <td class="speakEnglish">
                                {!! ViewFa::underline($question["pronunciation_{$rep}"], $question->$rep ); !!}
                            </td>
                        </tr>
                    @endforeach
                @else
                    @foreach(REPLIES as $i => $rep)
                        <tr>
                            <td width="20px">
                                <input type="radio" value="{{$i}}" name="answer{{$question->id}}">
                            </td>
                            <td class="speakEnglish">
                                {!! ViewFa::underline($question["pronunciation_{$rep}"], $question->$rep ); !!}
                            </td>
                        </tr>
                    @endforeach
                @endif
            </table>
            <hr>
        @endforeach
    </form>
@endsection

