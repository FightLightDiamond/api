<li class="has-sub root-level" id="ACLMenu">
    <a>
        <i class="fa fa-user-secret"></i>
        <span class="title">{{__('menu.acl')}}</span>
    </a>
    <ul>
        <li id="adminsMenu">
            <a href="{{route('admins.index')}}">
                <span class="title"> {{__('table.admins')}}</span>
            </a>
        </li>
{{--        <li id="permissionMenu">--}}
{{--            <a href="{{route('permissions.index')}}">--}}
{{--                <span class="title">{{__('table.permissions')}}</span>--}}
{{--            </a>--}}
{{--        </li>--}}
{{--        <li id="roleMenu">--}}
{{--            <a href="{{route('roles.index')}}">--}}
{{--                <span class="title">{{__('table.roles')}}</span>--}}
{{--            </a>--}}
{{--        </li>--}}
        <li id="userMenu">
            <a href="{{route('users.index')}}">
                <i class="fa fa-sign-out"></i> <span class="title">{{__('table.users')}}</span>
            </a>
        </li>
{{--        <li id="verifyUsersMenu">--}}
{{--            <a href="{{route('verify-users.index')}}">--}}
{{--                <span class="title">{{__('table.verify_users')}}</span>--}}
{{--            </a>--}}
{{--        </li>--}}
    </ul>
</li>
