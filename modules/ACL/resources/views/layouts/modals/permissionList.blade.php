<div class="modal fade" id="role_permission" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog">
        <form class="modal-content" id="formPermissionList" method="POST"
{{--              action='{{route('involve.role.syncPermission')}}'--}}
        >
            {{csrf_field()}}
            <input type="hidden" name="id" id="role_id">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Permission List</h4>
            </div>

            <div class="modal-body">
                @include('acl::layouts.lists.permission')
            </div>

            <div class="modal-footer">
                <button class="btn btn-info" id="DoneListRole">Save</button>
            </div>
        </form>
    </div>
</div>