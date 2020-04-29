<div class="modal fade" id="tutorialModal" tabindex="-1" role="dialog" aria-labelledby="tutorialModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="tutorialModalLabel">Tutorial list</h4>
            </div>
            <div class="modal-body">
                <form class="row" action="{{ route('tutorial.searchList') }}" id="formFilterTutorial">
                    <div class="col-sm-12 form-group">
                        <input class="form-control inputFilterTutorial" placeholder="name">
                    </div>
                </form>

                <div class="row">
                    <div class="col-sm-12" id="tableTutorial">
{{--                        @include('tut::user-tutorial.modals.tables.tutorial')--}}
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>
