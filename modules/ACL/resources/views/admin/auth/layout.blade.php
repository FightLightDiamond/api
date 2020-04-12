<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <meta name="description" content="Vincent"/>
    <meta name="author" content=""/>
    <link rel="icon" href="{{asset('')}}assets/images/favicon.ico">
    <title>{{config('app.name')}} | @yield('title')</title>
    <link rel="stylesheet" href="{{asset('')}}assets/js/jquery-ui/css/no-theme/jquery-ui-1.10.3.custom.min.css">
    <link rel="stylesheet" href="{{asset('')}}assets/css/font-icons/entypo/css/entypo.css">
    <link rel="stylesheet" href="//fonts.googleapis.com/css?family=Noto+Sans:400,700,400italic">
    <link rel="stylesheet" href="{{asset('')}}assets/css/bootstrap.css">
    <link rel="stylesheet" href="{{asset('')}}assets/css/neon-core.css">
    <link rel="stylesheet" href="{{asset('')}}assets/css/neon-theme.css">
    <link rel="stylesheet" href="{{asset('')}}assets/css/custom.css">
    <link rel="stylesheet" href="{{asset('')}}assets/css/skins/facebook.css">
    <script src="{{asset('')}}assets/js/jquery-1.11.3.min.js"></script>
</head>
<body class="page-body login-page">
<div class="login-container">
    <div class="login-header login-caret">
        <div class="login-content">
            <a class="logo" href="{{url('')}}">
                <h1 style="color:white">{{config('app.name')}}</h1>
            </a>
        </div>
    </div>
    @yield('content')
    <div class="text-center">
        {!! QrCode::size(100)->generate(url('')); !!}
        <p>Scan QR code access to mobile</p>
    </div>
</div>
<!-- Bottom scripts (common) -->
<script src="{{asset('')}}assets/js/gsap/TweenMax.min.js"></script>
<script src="{{asset('')}}assets/js/jquery-ui/js/jquery-ui-1.10.3.minimal.min.js"></script>
<script src="{{asset('')}}assets/js/bootstrap.js"></script>
<script src="{{asset('')}}assets/js/joinable.js"></script>
<script src="{{asset('')}}assets/js/resizeable.js"></script>
<script src="{{asset('')}}assets/js/neon-api.js"></script>
<script src="{{asset('')}}assets/js/jquery.validate.min.js"></script>
<script src="{{asset('')}}assets/js/neon-login.js"></script>
</body>
</html>
