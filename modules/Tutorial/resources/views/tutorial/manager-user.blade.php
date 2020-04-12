@extends('layouts.app')
@section('content')
    <ol class="breadcrumb">
        <li>
            <a href="/"><i class="fa fa-home"></i></a>
        </li>
        <li>
            <a href="{{route('tutorial.index')}}">{{__('table.tutorials')}}</a>
        </li>
        <li class="active">
            <strong>Table</strong>
        </li>
    </ol>

    <div class="row">
        <div class="col-sm-12 form-group">
            Tutorial: {{$tutorial->name}}
        </div>
        <div class="col-sm-12">
            <table class="table">
                <tr>
                    <th>Identity</th>
                    <th>Email</th>
                    <th>Phone number</th>
                    <th>First name</th>
                    <th>Last name</th>
                    <th>Status</th>
                    <th class="text-right">
                        <button data-toggle="modal" data-target="#myModal" class="btn btn-primary btn-xs">Assign</button>
                    </th>
                </tr>
                @foreach($tutorial->userTutorials as $userTutorial)
                    <tr>
                        <td>{{ @$userTutorial->user->identity }}</td>
                        <td>{{ @$userTutorial->user->email }}</td>
                        <td>{{ @$userTutorial->user->phone_number }}</td>
                        <td>{{ @$userTutorial->user->first_name }}</td>
                        <td>{{ @$userTutorial->user->last_name }}</td>
                        <td>{{ @$userTutorial->user->is_active }}</td>
                        <form action="{{route('user-tutorials.destroy', $userTutorial->id)}}" method="POST">
                            <input type="hidden" name="status" value="{{ REJECT }}">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
                            <td class="text-right"><button class="btn btn-danger btn-xs">Reject</button></td>
                        </form>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>

    <!-- Modal -->
    @include('tut::tutorial.modals.assign')

@endsection

@push('js')
    <script src="{{asset('build/form-filter.js')}}"></script>
    <script>
        Menu('#eLearnMenu', '#tutorialMenu')
    </script>
@endpush
