<header class="navbar navbar-fixed-top"><!-- set fixed position by adding class "navbar-fixed-top" -->
    <div class="navbar-inner">
        <div class="navbar-brand">
            <a href="/" style="color: whitesmoke">
                <strong>{{config('app.name')}}</strong>
            </a>
        </div>
        <ul class="navbar-nav">
            <li>
                <a href="{{route('english.index')}}" title="{{config('app.name')}} English" >
                    <i class="fa fa-language"></i> English
                </a>
            </li>
        </ul>
        <ul class="navbar-nav navbar-right">
            @if(auth()->check())
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown"
                       data-close-others="true">
                        <span  style="color: palegoldenrod">
                            <strong>
                            <span id="moneyTotal">{{number_format(auth()->user()->coin)}}</span>
                                <i class="fa fa-bitcoin"></i>
                                {{auth()->user()->last_name}}
                            </strong>
                        </span>
                        <i class="entypo-user-add"></i>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="external">
                            <a href="{{route('acl.profile')}}">
                                <i class="entypo-user-add"></i> {{__('auth.profile')}}
                            </a>
                        </li>
                        <li class="sep"></li>
                        <li>
                            <a onclick="$('#logoutForm').submit()">
                                <i class="fa fa-sign-out"></i>
                            </a>
                            <form id="logoutForm" style="display: none" method="post" action="{{route('logout')}}" >
                                {!! csrf_field() !!}
                            </form>
                        </li>
                    </ul>
                </li>
            @else
                <li>
                    <a href="{{asset('login')}}">
                        <span>
                            {{__('auth.login')}} <i class="fa fa-sign-in"></i>
                        </span>
                    </a>
                </li>
                <li class="sep"></li>
                <li>
                    <a href="{{asset('register')}}">
                        <span>
                            {{__('auth.register')}} <i class="fa entypo-user-add-plus"></i>
                        </span>
                    </a>
                </li>
            @endif
        </ul>
        <ul class="nav navbar-right pull-right">
            <li class="visible-xs">
                <div class="horizontal-mobile-menu visible-xs">
                    <a href="#" class="with-animation">
                        <i class="entypo-menu"></i>
                    </a>
                </div>
            </li>
        </ul>
    </div>
</header>
