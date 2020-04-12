<!-- Modal -->
<div class="modal fade" id="vocabularyModal" tabindex="-1" role="dialog" aria-labelledby="vocabularyModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content modal-lg">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="vocabularyModalLabel">{{__('table.vocabularies')}}</h4>
            </div>
            <div class="modal-body">
                <form id="filterForm" method="GET" action="{{route('vocabulary.search')}}">
                    {{csrf_field()}}
                    <div class="form-group col-lg-6">
                        <input  class="form-control inputFilter" name="word" placeholder="word">
                    </div>
                    <div class="form-group col-lg-6">
                        <input  class="form-control inputFilter" name="meaning" placeholder="meaning">
                    </div>
                    <div id="vocabularyTable">

                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">{{__('button.close')}}</button>
            </div>
        </div>
    </div>
</div>