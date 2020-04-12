<div class="panel panel-default">
    <div class="panel-heading">
        <div class="panel-title">{{__('table.crazy_courses')}}</div>
    </div>
    <div class="panel-body">
        @foreach($crazyCourseCompose as $id => $name)
            <div class="col-md-12 form-group col-sm-4 col-xs-6 text-left">
                <a href="{{route('crazy-course.list', $id)}}" title="{{$name}}"
                   class="text-left list-test btn-icon">
                    {{$name}}
                    <i class="fa fa-pencil"></i>
                </a>
            </div>
        @endforeach
    </div>
</div>