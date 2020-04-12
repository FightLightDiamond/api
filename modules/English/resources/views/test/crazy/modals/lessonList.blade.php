<div class="modal fade" id="crazyListModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">Danh sách bài học</h4>
            </div>
            <div class="modal-body">
                <table class="table">
                    <thead>
                    <tr>
                        <th>Lessons</th>
                        <th>Read</th>
                        <th class="text-right">Write</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($crazyCompose as $id => $name)
                        <tr class="{{$crazy->id == $id ? 'success': ''}}">
                            <td>{{$name}}</td>
                            <td>
                                <a href="{{route('test.crazy.reading', $id)}}" title="Reading: {{$name}}">
                                    <i class="fa fa-pencil"></i>
                                </a>
                            </td>
                            <td class="text-right">
                                <a href="{{route('test.crazy.writing', $id)}}" title="Writing: {{$name}}">
                                    <i class="fa fa-pencil"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default btn-icon" data-dismiss="modal">
                    Close <i class="fa fa-close"></i>
                </button>
            </div>
        </div>
    </div>
</div>