<label for="title">{{trans('label.tutorial_id')}}</label>
<select class="form-control selectFilter" name="tutorial_id" id="tutorial_id">
    <option value=""></option>
    @foreach($tutorialCompose as $id => $name)
        <option value="{{$id}}">{{$name}}</option>
    @endforeach
</select>