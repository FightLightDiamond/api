<table class="table table-hover">
    <thead>
    <tr>
        <th>{{trans('label.user_id')}}</th>
<th>{{trans('label.code')}}</th>
<th>{{trans('label.email')}}</th>
<th>{{trans('label.phone')}}</th>
<th>{{trans('label.otp_verified')}}</th>
<th>{{trans('label.google_authentication')}}</th>

        <th></th>
    </tr>
    </thead>
    <tbody>
    @foreach($verifyUsers as $row)
    <tr class="{{$row->is_active === 1 ? : 'text-danger'}}">
        <td>{{$row->user_id}}</td>
<td>{{$row->code}}</td>
<td>{{$row->email}}</td>
<td>{{$row->phone}}</td>
<td>{{$row->otp_verified}}</td>
<td>{{$row->google_authentication}}</td>

        <td class="text-right">
            <form method="POST" action="{{route('verify-users.destroy', $row->id)}}">
                {{csrf_field()}}
                {{method_field('DELETE')}}
                <button class="btn btn-danger btn-xs destroyBtn">
                    <i class="fa fa-trash"></i>
                </button>
                <a href="{{route('verify-users.edit', $row->id)}}" class="btn btn-info btn-xs">
                    <i class="fa fa-edit"></i>
                </a>
                <a href="{{route('verify-users.show', $row->id)}}" class="btn btn-info btn-xs">
                    <i class="fa fa-eye"></i>
                </a>
            </form>
        </td>
    </tr>
    @endforeach
    </tbody>
</table>

<div id="linkPaginate">
    {{$verifyUsers->links()}}
</div>
