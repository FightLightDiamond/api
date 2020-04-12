<div class="modal fade" id="role_user" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog">
        <form class="modal-content" id="formroleCompose" method="GET" action='{{route('involve.user.syncRole')}}'>
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">set Role</h4>
            </div>
            <div class="modal-body">
                @include('acl::layouts.lists.role')
            </div>
            <div class="modal-footer">
                <button class="btn btn-info" id="DoneListRole">Save</button>
            </div>
        </form>
    </div>
</div>

@push('js')
<script src="{{asset('build/form-filter.js')}}"></script>
@endpush