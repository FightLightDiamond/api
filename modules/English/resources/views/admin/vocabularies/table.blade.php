<table class="table table-hover table-nomargin table-condensed table-responsive">
    <tr>
        <th>
            {{--<input type="checkbox" class="check_all">--}}
        </th>
        <th>Image</th>
        <th>word</th>
        <th>type</th>
        <th>pronounce</th>
        <th>mean</th>
        <th>Is active</th>
        <th></th>
    </tr>
    @foreach($vocabularies as $vocabulary)
        <tr>
            <td>
                {{--<div class="checkbox checkbox-replace color-primary">--}}
                {{--<input type="checkbox" id="{{$vocabulary->id}}" class="check_item">--}}
                {{--</div>--}}
            </td>
            <th>
                @if(!empty($vocabulary->image))
                    <img src="{{asset('storage'.str_replace_last('.', '_50_50.', $vocabulary->image))}}" alt="">
                @endif
            </th>
            <td><a href="{{route('admin.vocabularies.edit', $vocabulary->id)}}">{{$vocabulary->word}}</a></td>
            <td>{{$vocabulary->type}}</td>
            <td>{{$vocabulary->pronounce}}</td>
            <td>{{$vocabulary->meaning}}</td>
            <td>{!! $vocabulary->is_active ? '<i class="fa fa-check text-success"></i>' : '<i class="fa fa-ban text-danger"></i>' !!}</td>
            <td>
                <form class="form-group" action="{{route('admin.vocabularies.destroy', $vocabulary->id)}}" method="POST">
                    {!! csrf_field() !!}
                    {!! method_field('DELETE') !!}
                    <button class="btn btn-danger destroyBtn btn-sm"><i class="fa fa-remove"></i></button>
                    <span type="button" class="btn btn-info btn-sm" onclick="speakEnglish('{{$vocabulary->word}}')">
                        <i class="fa fa-volume-up"></i>
                    </span>
                </form>
            </td>
        </tr>
    @endforeach
</table>
<div id="linkPaginate">
    {!! $vocabularies->links() !!}
</div>