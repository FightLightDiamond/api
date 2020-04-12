<table class="table">
    <tr>
        <th></th>
        <th>Name</th>
        <th>Description</th>
    </tr>

    @foreach($tutorials as $row)
        <tr>
            <td><input name="tutorial_id" value="{{$row}}" class="selectTutorial" type="radio"></td>
            <td>{{$row->name}}</td>
            <td>{{$row->description}}</td>
        </tr>
    @endforeach

</table>
