@extends('en::test.crazy.layout')
@section('doing')
    <p>
        <i>Nghe và viết những gì nghe được của từng nhân vật vào chỗ trống phía đưới theo đúng trình tự.
            Bấm vào gợi ý để có thể làm bài chính xác
        </i>
    </p>
    <form action="{{route('test.crazy.written', $crazy['id'])}}" method="POST" id="formTest" class="row">
        {{csrf_field()}}
        <input type="hidden" name="type" value="1">
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <h3>English</h3>
            <ul class="list-group">
                @foreach($ens as $id => $sentence)
                    <div class="input-group {{$resultMap[$id] ? 'text-success' : ''}}"
                         style="margin-bottom: 0; ">
                        <span class="input-group-addon EnNo" style=" color: black;
                            {{$resultMap[$id] ? 'background: #bdedbc' : ''}}"
                              data-toggle="tooltip" data-placement="right" title="{{$sentence}}"
                        >.</span>
                        <input class="form-control" placeholder="{{$sentence}}" value="{{$sentences[$id]}}"
                               name="sentences[{{$id}}]"
                               style="height: 38px; {{$resultMap[$id] ? 'background: #bdedbc' : ''}}">
                    </div>
                @endforeach
            </ul>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <h3>Vietnam </h3>
            <ul class="list-group" id="ViSortable">
                @foreach($meanings as $id => $meaning)
                    <li class="list-group-item {{$resultMap[$id] ? 'list-group-item-success' : ''}}">
                        <input type="hidden" name="meanings[{{$id}}]" value="{{$meaning}}">
                        <span class="ViNo"></span>.
                        {{$meaning}}
                    </li>
                @endforeach
            </ul>
        </div>
    </form>
@endsection
