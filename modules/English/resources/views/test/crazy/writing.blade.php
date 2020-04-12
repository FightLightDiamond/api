@extends('en::test.crazy.layout')
@section('doing')
    <p>
        <i>Nghe và viết những gì nghe được của từng nhân vật vào chỗ trống phía đưới theo đúng trình tự.
            Bấm vào gợi ý để có thể làm bài chính xác
        </i>
    </p>
    <form action="{{route('api.test.crazy.written', $crazy['id'])}}" method="POST" id="formTest" class="row">
        {{csrf_field()}}
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <h3>English</h3>
            <ul class="list-group">
                @foreach($ens as $id => $sentence)
                    <div class="input-group" style="margin-bottom: 0">
                        <span class="EnQ input-group-addon EnNo"
                              data-toggle="tooltip" data-placement="right" title="{{$randEns[$id]}}"
                              style=" color: black">.</span>
                        <input class="form-control writingInput" placeholder="{{$sentence}}"
                               name="sentences[{{$id}}]" style="height: 38px">
                    </div>
                @endforeach
            </ul>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <h3>Vietnam </h3>
            <ul class="list-group" id="ViSortable">
                @foreach($vis as $id => $meaning)
                    <li class="ViQ list-group-item ">
                        <input type="hidden" name="meanings[{{$id}}]" value="{{$meaning}}">
                        <span class="ViNo"></span>.
                        {{$meaning}}
                    </li>
                @endforeach
            </ul>
        </div>
    </form>
@endsection
