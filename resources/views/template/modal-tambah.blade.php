<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title">Form Tambah Template Pesan</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="card-body">
                <form id="filter_form">
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">Kode Pesan</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="kode_pesan" name="kode_pesan">

                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputPassword3" class="col-sm-2 col-form-label">Judul</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="judul_pesan" name="judul_pesan">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputPassword3" class="col-sm-5 col-form-label">Template Isi Pesan</label>

                    </div>
                    <div class="form-group row">
                        <textarea id="summernote" style="display: none;">

                        </textarea>

                    </div>
                </form>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="btn-filter">Save changes</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
