@extends('layouts.app')
@section('content')
    <ol class="breadcrumb">
        <li>
            <a href="{{route('admin')}}"><i class="fa fa-home"></i></a>
        </li>
        <li>
            <a {{route('roles.index')}}>{{__('table.roles')}}</a>
        </li>
    </ol>

    <form class="form-group row" id="formFilter" action="{{route('roles.index')}}" method="POST">
        <div class="col-sm-2 form-group">
            <select name="per_page" class="form-control inputFilter">
                <option value="">10</option>
                <option value="">20</option>
                <option value="">30</option>
                <option value="">40</option>
                <option value="">50</option>
            </select>
        </div>
        <div class="col-sm-3 form-group">
            <input  name="name" class="form-control inputFilter" placeholder="{{__('label.name')}}">
        </div>
        <div class="col-sm-3 form-group">
            <input  name="display_name" class="form-control inputFilter"
                   placeholder="{{__('label.display_name')}}">
        </div>
        <div class="col-sm-2 form-group">
            <select name="is_active" class="form-control inputFilter">
                <option value="">{{__('common.all')}}</option>
                <option value="1">Active</option>
                <option value="0">Inactive</option>
            </select>
        </div>
        <div class="col-sm-2 form-group">
            <a class="btn btn-primary" href="{{route('roles.create')}}"><i class="fa fa-plus"></i></a>
            <a class="btn btn-danger destroyBtn"><i class="fa fa-trash"></i></a>
        </div>
    </form>

    <div class="form-group">
        @include('acl::roles.table')
    </div>

    @include('acl::layouts.modals.permissionList')
@endsection
@push('css')

@endpush
@push('js')
    <script>
        const set_role_permission = $('.set_role_permission');
        const role_id = $('#role_id');
        const permission_id = $('.permission_id');
        $(document).on('click', '.set_role_permission', function () {
            const id = $(this).attr('data');
            role_id.val(id);
            assignedPermission(id);
        });

        function assignedPermission(id) {
            $.ajax({
{{--                url: '{{route('involve.role.assignedPermission')}}',--}}
                method: 'GET',
                data: {id: id},
                success: function (data) {
                    //alert(data);
                    setChecked(data);
                },
                error: function () {

                }
            });
        }

        function setChecked(data) {
            permission_id.prop('checked', true);
            permission_id.each(function (index) {
                const self = $(this);
                console.log($(this).val());
                const result = $.inArray(self.val(), data);
                if (result !== -1) {
                    self.prop('checked', true);
                }
            });
        }
    </script>

    <script>
        Menu('#ACLMenu', '#roleMenu')
    </script>
@endpush