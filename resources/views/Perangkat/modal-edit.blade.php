<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title">Form Filter Data Invoice</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="card-body">
                <form id="filter_form">

                    <div class="form-group row">
                        <input type="hidden" class="form-control" id="id_perangkat" name="id_perangkat" readonly>
                        <label for="owner" class="col-sm-3 col-form-label">Perangkat</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="owner" name="owner" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="no_wa" class="col-sm-3 col-form-label">Nomer WA</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="no_wa" name="no_wa">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="api_key" class="col-sm-3 col-form-label">API Key</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="api_key" name="api_key">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="api_kyY_number" class="col-sm-3 col-form-label">API Key Number</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="api_key_number" name="api_key_number">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="endpoin" class="col-sm-3 col-form-label">End Poin</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="endpoin" name="endpoin">
                        </div>
                    </div>


                </form>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="btn-save">Save changes</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
