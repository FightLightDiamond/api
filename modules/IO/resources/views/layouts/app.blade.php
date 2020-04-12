<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <meta http-equiv="Content-Language" content="vi"/>
    <meta http-equiv="X-UA-Compatible" content="requiresActiveX=true"/>
    <meta name="ROBOTS" content="index, follow"/>
    <meta property="og:type" content="website"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{config('app.name')}} (IO) | @yield('title')</title>
    <meta name="keywords" content="english, coding, tutorial, laravel, crazy, test, lesson, section, php, kiểm tra, mất gốc,
    chắc chắn, vượt giới hạn"/>
    <meta name="author" content="{{url('')}}"/>
    <meta name="copyright" content="{{url('')}}"/>

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="user-id" content="{{auth()->id()}}"/>
    <meta name="group-id" content="{{auth()->user() ? auth()->user()->group_id : '' }}"/>

    <link rel="stylesheet" href="{{$asset_url}}/assets/js/jquery-ui/css/no-theme/jquery-ui-1.10.3.custom.min.css">
    <link rel="stylesheet" href="{{$asset_url}}/assets/css/font-icons/entypo/css/entypo.css">
    <link rel="stylesheet" href="{{$asset_url}}/assets/css/bootstrap.css">
    <link rel="stylesheet" href="{{$asset_url}}/assets/css/neon-core.css">
    <link rel="stylesheet" href="{{$asset_url}}/assets/css/neon-theme.css">
    <link rel="stylesheet" href="{{$asset_url}}/assets/css/neon-forms.css">
    <link rel="stylesheet" href="{{$asset_url}}/assets/css/custom.css">
    {{--<link rel="stylesheet" href="{{$asset_url}}/assets/css/font-icons/font-awesome/css/font-awesome.min.css">--}}
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="{{$asset_url}}/assets/css/skins/{{config('app.skins')}}.css">
    @stack('head')
    @yield('css')
    <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
    <script>
        (adsbygoogle = window.adsbygoogle || []).push({
            google_ad_client: "ca-pub-7812844249179949",
            enable_page_level_ads: true
        });
    </script>
</head>
<body class="page-body">
<div class="page-container horizontal-menu">
    @include('edu::layouts.nav')
    <div class="main-content">
        <div class="container">
            <div class="row">
                @include('layouts.alerts.index')
            </div>
            @yield('content')
        </div>
    </div>
</div>
<script src="{{$asset_url}}/assets/js/jquery-1.11.3.min.js"></script>
<script src="{{$asset_url}}/assets/js/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="{{$asset_url}}/assets/js/jvectormap/jquery-jvectormap-europe-merc-en.js"></script>
<script src="{{$asset_url}}/assets/js/jquery.sparkline.min.js"></script>
<script src="{{$asset_url}}/assets/js/rickshaw/vendor/d3.v3.js"></script>
<script src="{{$asset_url}}/assets/js/rickshaw/rickshaw.min.js"></script>
<script src="{{$asset_url}}/assets/js/raphael-min.js"></script>
<script src="{{$asset_url}}/assets/js/morris.min.js"></script>
<script src="{{$asset_url}}/assets/js/toastr.js"></script>
<!-- Bottom scripts (common) -->
<script src="{{$asset_url}}/assets/js/gsap/TweenMax.min.js"></script>
<script src="{{$asset_url}}/assets/js/jquery-ui/js/jquery-ui-1.10.3.minimal.min.js"></script>
<script src="{{$asset_url}}/assets/js/bootstrap.js"></script>
<script src="{{$asset_url}}/assets/js/joinable.js"></script>
<script src="{{$asset_url}}/assets/js/resizeable.js"></script>
<script src="{{$asset_url}}/assets/js/neon-api.js"></script>
<!-- Imported scripts on this page -->
<script src="{{$asset_url}}/assets/js/neon-chat.js"></script>
<!-- JavaScripts initializations and stuff -->
<script src="{{$asset_url}}/assets/js/neon-custom.js"></script>
<script src="{{$asset_url}}/assets/js/neon-demo.js"></script>
<script src="{{ asset('build/vincentForm.js')}}"></script>
<script src="{{ asset('build/english.js')}}"></script>

<script>
    const config = {
        inputIn: '.inputFilter',
        selectIn: null,
        btnIn: null,
        tableIn: $('#vocabularyTable')
    };
    $('#filterForm').magicFormer(config);
    $('td').click(function () {
        $(this).children('input').prop('checked');
    });
</script>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>

@yield('js')
@stack('js')

{{--<script type="text/javascript" src="{{elixir('modules/IO/js/app.js')}}?v={{rand(0, 9999)}}"></script>--}}
</body>
</html>
