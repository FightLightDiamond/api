@extends('en::test.crazy.layout')
@section('doing')
    <form action="{{route('api.test.crazy.read', $crazy['id'])}}" method="POST" id="formTest" class="row">
        {{csrf_field()}}
        <input type="hidden" name="type" value="1">
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <h3>English</h3>
            <ul class="list-group" id="EnSortable">
                @foreach($ens as $id => $sentence)
                    <li class="list-group-item EnQ {{$resultMap[$id] ? 'list-group-item-success' : ''}}">
                        <input type="hidden" name="sentences[]" value="{{request('sentences')[$id]}}">
                        <span class="EnNo"> </span>. {{$sentence}}
                        <span class="btn btn-xs btn-primary pull-right englishRead" data-content="{{$sentence}}">
                            <i class="fa fa-volume-up"></i>
                        </span>
                    </li>
                @endforeach
            </ul>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <h3>Vietnam </h3>
            <ul class="list-group" id="ViSortable">
                @foreach(request('meanings') as $id => $meaning)
                    <li class="list-group-item ViQ {{$resultMap[$id] ? 'list-group-item-success' : ''}}">
                        <input type="hidden" name="meanings[]" value="{{$meaning}}">
                        <span class="ViNo"> </span>.
                        {{$meaning}}
                    </li>
                @endforeach
            </ul>
        </div>
    </form>
@endsection
