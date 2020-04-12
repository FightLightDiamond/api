@extends('en::test.crazy.layout')
@section('doing')
    <form action="{{route('api.test.crazy.read', $crazy['id'])}}" method="POST" id="formTest" class="row">
        {{csrf_field()}}
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <h3>English</h3>
            <ul class="list-group" id="EnSortable">
                @foreach($ens as $id => $sentence)
                    <li class="EnQ list-group-item">
                        <input type="hidden" name="sentences[]" value="{{$id}}">
                        <span class="EnNo"></span>. {{$sentence}}
                    </li>
                @endforeach
            </ul>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <h3>Vietnam </h3>
            <ul class="list-group" id="ViSortable">
                @foreach($vis as $id => $meaning)
                    <li class="ViQ list-group-item ">
                        <input type="hidden" name="meanings[]" value="{{$meaning}}">
                        <span class="ViNo"></span>.
                        {{$meaning}}
                    </li>
                @endforeach
            </ul>
        </div>
    </form>
@endsection
