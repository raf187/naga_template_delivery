<div class="modal fade" id="openStore" tabindex="1" role="dialog" aria-labelledby="labelOpenStore" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content col-md-12">
            <div class="modal-body px-3">
                <h4 class="text-center py-4 text-success font-weight-bolder display-4">{!! $homeMsg->homeMessageTitle !!}</h4>
                {!! $homeMsg->homeMessage !!}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light mr-4" data-dismiss="modal">Fermer</button>
            </div>
        </div>
    </div>
</div>
<input type="hidden" id="ModalisActived" value="{{ $homeMsg->isActived }}">
