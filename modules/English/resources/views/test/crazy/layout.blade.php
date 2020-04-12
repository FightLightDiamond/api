@extends('en::layouts.app')
@section('content')
    <div class="row english">
        <ol class="breadcrumb bc-1">
            <li>
                <a href="{{route('english.index')}}">
                    <i class="fa fa-language"></i> Crazy English
                </a>
            </li>
            <li>
                <a href="{{route('crazy-course.list', $crazyCourse->id)}}">
                    <i class="fa fa-list"></i> {{$crazyCourse['name']}}
                </a>
            </li>
        </ol>
        <h1>{{$crazy['name']}}</h1>
        <audio controls loop preload id="audio">
            <source src="{{$crazy->getAudioPath()}}">
        </audio>
        <p class="text-info" style="font-weight: bold">
            Nghe audio sau đó tiến hành kéo thả để sắp xếp cột theo đúng "thứ
            tự" và "đúng
            nghĩa" English với Vietnam.
        </p>
        <p class="text-info" style="font-weight: bold">
            Sử dụng phím tắt "w" để play/pause, "q" để
            back và "e" để next 5s audio, sử dụng "r" để chuyển chế đổi qua lại
            giữa sắp xếp theo thứ tự và đổi chỗ(mặc
            định là sắp xếp thứ tự).</p>
        @yield('doing')
    </div>
    <div class="row">
        @if(auth()->check())
            <table class="table">
                <tr>
                    <td>Đã làm: {{ $testedCount }} (lần)</td>
                    <td>Điểm TB lần đầu: {{ $avgFirst ? $avgFirst : 0}} </td>
                    <td>Điểm TB làm lại: {{ $avgAgain ? $avgAgain : 0}} </td>
                </tr>
            </table>
        @else
            <p class="text-info">
                <b>Đăng nhập để xem lại chiến tích làm bài của bạn </b>
            </p>
        @endif
    </div>

    @include('en::test.crazy.modals.lessonList')
@endsection

@section('bot')
    @include('en::test.components.nav')
@endsection

@push('head')
    <style>
        .unsure {
            height: 20px;
            width: 20px;
            margin-bottom: 0 !important;
        }
        #formTest {
            color: black;
        }
    </style>
@endpush

@push('js')
    <script src="{{asset('assets/js/bootstrap-switch.min.js')}}"></script>
    <script src="{{asset('modules/English/js/app.js')}}"></script>
    {{--<script src="{{asset('build/test.js')}}"></script>--}}
    {{--<script src="{{asset('build/forceSort.js')}}?v={{rand(0, 9999)}}"></script>--}}
    {{--<script src="{{asset('build/english/player.js')}}"></script>--}}
@endpush
