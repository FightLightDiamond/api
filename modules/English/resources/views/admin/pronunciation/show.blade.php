@extends('layouts.app')
@section('content')
    <ol class="breadcrumb bc-3">
        <li>
            <a href="/"><i class="fa fa-home"></i></a>
        </li>
        <li>
            <a href="{{route('admin.pronunciations.index')}}">{{trans('table.pronunciations')}}</a>
        </li>
        <li class="active">
            <strong>Table</strong>
        </li>
    </ol>
    <div class=" col-lg-6 col-lg-offset-3">
        <table class="table table-bordered">
            <tbody>
            @foreach(REPLIES as $k => $REPLY)
                <tr>
                    <td class="speakEnglish"> {!! \ViewFa::underline($pronunciation[PRONUNCIATIONS[$k]], $pronunciation->$REPLY) !!}</td>
                    <td>
                        <input name="answer" type="radio" value="{{$k}}" {{ $pronunciation->answer == $k ? 'checked' : '' }} >
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

@endsection