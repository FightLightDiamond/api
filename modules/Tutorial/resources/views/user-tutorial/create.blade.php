@extends('layouts.app')
@section('content')
    <div class="row">
        <ol class="breadcrumb">
            <li>
                <a href="/"><i class="fa fa-home"></i></a>
            </li>
            <li>
                <a href="{{route('user-tutorials.index')}}">{{trans('table.tutorials')}}</a>
            </li>
            <li class="active">
                <strong>Tables</strong>
            </li>
        </ol>
        <form action="{{route('user-tutorials.store')}}" method="post" enctype="multipart/form-data">
            {{csrf_field()}}
            <div class="col-lg-6 form-group">
                <label>User</label>
                <div class="input-group">
                    <span class="input-group-btn">
                        <button class="btn btn-primary" data-toggle="modal" data-target="#userModal" type="button">Change</button>
                    </span>
                    <input type="hidden" name="user_id">
                    <input  id="user_name" readonly class="form-control">
                </div><!-- /input-group -->
            </div><!-- /.col-lg-6 -->
            <div class="col-lg-6 form-group" >
                <label for="">Tutorial</label>
                <div class="input-group">
                    <input type="hidden" name="tutorial_id">
                    <input name="" id="user_name" readonly class="form-control">
                    <span class="input-group-btn">
                        <button class="btn btn-primary"  data-toggle="modal" data-target="#tutorialModal"  type="button">Change</button>
                    </span>
                </div><!-- /input-group -->
            </div><!-- /.col-lg-6 -->
            <div class="col-sm-12">
                @include('mod::layouts.components.is-active')
            </div>

            <div class="col-lg-12">
                <button class="btn btn-primary">{{trans('button.done')}}</button>
                <button class="btn btn-primary isBack">{{trans('button.done_and_back')}}</button>
                <button type="reset" class="btn btn-default">{{trans('button.reset')}}</button>
                <a href="{{url()->previous()}}" class="btn btn-default">{{trans('button.cancel')}}</a>
            </div>
        </form>

        @include('tut::user-tutorial.modals.create.user')
        @include('tut::user-tutorial.modals.create.tutorial')

    </div>

@endsection

@push('css')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet"/>
@endpush

@push('js')
{{--    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.17.0/dist/jquery.validate.js"></script>--}}
{{--    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.17.0/dist/jquery.validate.min.js"></script>--}}
{{--    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.17.0/dist/additional-methods.js"></script>--}}
{{--    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.17.0/dist/additional-methods.min.js"></script>--}}
{{--    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>--}}
<script src="{{asset('build/forceForm.js')}}"></script>
    <script>

        const forms = ['User', 'Tutorial'];
        // alert(123);
        forms.forEach(function (value) {
            let config = {
                inputIn: $('.inputFilter' + value),
                selectIn: $('.selectFilter' + value),
                btnIn: $('#btnFilter'+ value),
                tableIn: $('#table' + value),
            };

            $('#formFilter' + value).magicFormer(config);
        });

        // alert(444);

        // const categoryForm = $("#categoryFrom");
        // categoryForm.validate();
        // $(document).ready(function () {
        //     const jsSlelect = $('.js-single');
        //     jsSlelect.select2({
        //         tags: true,
        //         createTag: function (params) {
        //             const term = $.trim(params.term);
        //             if (term === '') {
        //                 return null;
        //             }
        //             return {
        //                 id: term,
        //                 text: term,
        //                 newTag: true // add additional parameters
        //             }
        //         }
        //     });
        //     jsSlelect.on('select2:select', function (e) {
        //         const data = e.params.data;
        //         console.log(data);
        //     });
        //     jsSlelect.on('select2:unselect', function (e) {
        //         const data = e.params.data;
        //         console.log(data);
        //     });
        // });
    </script>
    <script>
        Menu('#eLearnMenu', '#userTutorialMenu')
    </script>
@endpush
