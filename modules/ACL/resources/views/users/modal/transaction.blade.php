<div class="modal fade" tabindex="-1" role="dialog" id="transaction">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Transaction</h4>
            </div>
            <div class="modal-body">
                <form action="{{route('transaction', auth()->id())}}" method="POST">
                    {{csrf_field()}}
                    {{method_field('PUT')}}
                    <div class="form-group">
                        <label>{{trans('label.email')}} người nhận</label>
                        <input type="email" class="form-control" required name="email"
                               value="{{auth()->user()->email}}">
                    </div>
                    <div class="form-group">
                        <label>{{trans('label.coin')}}</label>
                        <input type="number" min="0" max="{{auth()->user()->coin}}" class="form-control"
                               required  name="coin" value="0" id="coin">
                        <h5 id="number" class="text-success"></h5>
                    </div>
                    <div class="form-group">
                        <label>{{trans('label.password')}}</label>
                        <input required type="password" class="form-control" name="password">
                    </div>
                    <button type="submit" class="btn btn-default">Submit</button>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->