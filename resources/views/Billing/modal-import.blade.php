<div class="modal-dialog">
    <div class="modal-content">
        <form id="import_form">
            {{-- @csrf --}}
            <div class="modal-header">
                <h4 class="modal-title">Form Import Data Invoice</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="card card-primary">
                <div class="alert alert-danger d-none"></div>
                <div class="alert alert-success d-none"></div>
                <div class="card-body">

                    <div class="form-group">
                        <label for="exampleInputEmail1">File</label>
                        <input type="file" class="form-control" id="exampleInputEmail1" name="file">
                        @error('file')
                            <small>{{ $message }}</small>
                        @enderror
                    </div>
                </div>

            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-success" id="btn_upload">Upload</button>
            </div>

        </form>
    </div>
    <!-- /.modal-content -->
</div>
