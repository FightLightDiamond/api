@extends('en::layouts.app')
@section('content')

    <div class="row">
        <div class="col-lg-12">
            <h1>{{config('app.name')}} English</h1>
            <p class="text-info">
                <b>Hãy học tập để vươn tầm, kết nối với hàng tỉ người trên thế giới.
                    Vượt ra khỏi giới hạn ao làng, vốn kiến thức hạn hẹp của tiếng mẹ đẻ,
                    tiếp xúc với thông tin đa chiều của đa quốc gia, lĩnh hội kiến thức toàn cầu. </b>
            </p>
            @if(!auth()->check())
                <p class=panel-default"><i>Hãy đăng nhập để lưu lại chiến tích chăm chỉ học tập của bạn. </i></p>
            @endif
        </div>
    </div>

    @include('edu::layouts.components.slides')

    <div class="row">

        <div class="col-lg-12">
            @include('en::english.components.courses.crazy')
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="panel-title">{{__('table.pronunciations')}}</div>
                </div>
                <div class="panel-body">
                    @for($i = 1; $i <=$pronunciationPage; $i++)
                        <div class="col-md-2 form-group col-sm-3 col-xs-6">
                            <a href="{{route('test.pronunciation.index')}}?page={{$i}}"
                               class="list-test btn-icon">
                                Bài số {{$i}}
                                <i class="fa fa-pencil"></i>
                            </a>
                        </div>
                    @endfor
                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="panel-title">{{__('table.mistakes')}}</div>
                </div>
                <div class="panel-body">
                    @for($i = 1; $i <=$mistakesPage; $i++)
                        <div class="col-md-2 form-group col-sm-3 col-xs-6">
                            <a href="{{route('test.mistake.index')}}?page={{$i}}"
                               class="list-test btn-icon">
                                Bài số {{$i}}
                                <i class="fa fa-pencil"></i>
                            </a>
                        </div>
                    @endfor
                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="panel-title">{{__('table.fill_in_the_blanks')}}</div>
                </div>
                <div class="panel-body">
                    @for($i = 1; $i <=$fillInTheBlankPage; $i++)
                        <div class="col-md-2 form-group col-sm-3 col-xs-6">
                            <a href="{{route('test.fill-in-the-blank.index')}}?page={{$i}}"
                               class="list-test btn-icon">
                                Bài số {{$i}}
                                <i class="fa fa-pencil"></i>
                            </a>
                        </div>
                    @endfor
                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="panel-title">{{__('table.similarities')}}</div>
                </div>
                <div class="panel-body">
                    @for($i = 1; $i <=$similarityPage; $i++)
                        <div class="col-md-2 form-group col-sm-3 col-xs-6">
                            <a href="{{route('test.similarity.index')}}?page={{$i}}"
                               class="list-test btn-icon">
                                Bài số {{$i}}
                                <i class="fa fa-pencil"></i>
                            </a>
                        </div>
                    @endfor
                </div>
            </div>
        </div>

    </div>
@endsection

@push('js')

@endpush