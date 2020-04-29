<table class="table">
    <tr>
{{--        <th></th>--}}
        <th>Identity</th>
        <th>Email</th>
        <th>Phone number</th>
        <th>First name</th>
        <th>Last name</th>
        <th>Status</th>
        <th></th>
    </tr>
    @foreach($users as $user)
        <tr>
{{--            <td>--}}
{{--                <input type="checkbox" name="ids[]" value="{{ $user->id }}">--}}
{{--            </td>--}}
            <td>{{ @$user->identity }}</td>
            <td>{{ @$user->email }}</td>
            <td>{{ @$user->phone_number }}</td>
            <td>{{ @$user->first_name }}</td>
            <td>{{ @$user->last_name }}</td>
            <td>{{ @$user->is_active }}</td>
            <td>
                @if(!in_array($user->id, $userIds))
                    <form action="{{route('user-tutorials.store')}}" method="POST">
                        {{csrf_field()}}
                        <input type="hidden" name="status" value="{{ACTIVE}}">
                        <input type="hidden" name="user_id" value="{{$user->id}}">
                        <input type="hidden" name="tutorial_id" value="{{$tutorial->id}}">
                        <button class="btn btn-primary btn-xs">Assign</button>
                    </form>
                @else
{{--                    <form action="{{route('user-tutorial.inactive')}}" method="POST">--}}
{{--                        <input type="hidden" name="status" value="{{INACTIVE}}">--}}
{{--                        <input type="hidden" name="user_id" value="{{$user->id}}">--}}
{{--                        <input type="hidden" name="tutorial_id" value="{{$tutorial->id}}">--}}
{{--                        <button class="btn btn-primary"></button>--}}
{{--                    </form>--}}
                @endif
            </td>
        </tr>
    @endforeach
</table>

{{$users->links()}}
