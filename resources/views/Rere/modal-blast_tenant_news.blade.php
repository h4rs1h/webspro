<div class="modal-dialog modal-xl">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title">Form Blast Informasi Tenant</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="alert alert-danger d-none"></div>
        <div class="alert alert-success d-none"></div>
        <div class="modal-body">
            <div class="form-group row">
                <label for="title" class="col-sm-2 col-form-label">Title Info</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" id="title" placeholder="title">
                </div>
            </div>
            <div class="form-group row">
                <label for="title" class="col-sm-2 col-form-label">Tanggal</label>
                <div class="col-sm-2">
                    <input type="date" class="form-control" id="tgl_pesan">
                </div>
                <label for="title" class="col-form-label">Jam</label>
                <div class="col-sm-2">
                    <input type="time" class="form-control" id="jam_pesan">
                </div>
            </div>
            <div class="form-group row">
                <label for="title" class="col-sm-2 col-form-label">Isi Pesan</label>
                <div class="col-sm-10">
                    <textarea class="form-control" rows="4" id="isi_pesan" placeholder="Isi Pesan ..."></textarea>
                </div>
            </div>
            <div class="form-group row">
                <label for="inputPassword3" class="col-sm-2 col-form-label">Tower</label>
                <div class="col-sm-3">
                    <select class="form-control" name="tower" id="tower">
                        <option value="">-- Pilih --</option>
                        <option value="0">ALL</option>
                        @foreach ($tower as $th)
                            @if (old('tower') == $th->id)
                                <option value="{{ $th->id }}" selected>{{ $th->name }}
                                </option>
                            @else
                                <option value="{{ $th->id }}">{{ $th->name }}</option>
                            @endif
                        @endforeach
                    </select>

                </div>
                <label for="inputPassword3" class="col-sm-2 col-form-label">sampai</label>
                <div class="col-sm-3">
                    <select class="form-control" name="tower2" id="tower2">
                        <option value="">-- Pilih --</option>
                        <option value="0">ALL</option>
                        @foreach ($tower as $th)
                            @if (old('tower2') == $th->id)
                                <option value="{{ $th->id }}" selected>{{ $th->name }}
                                </option>
                            @else
                                <option value="{{ $th->id }}">{{ $th->name }}</option>
                            @endif
                        @endforeach
                    </select>

                </div>
            </div>
            <div class="form-group row">
                <label for="inputPassword3" class="col-sm-2 col-form-label">Lantai</label>
                <div class="col-sm-3">
                    <select class="form-control" name="lantai" id="lantai">
                        <option value="">-- Pilih --</option>
                        <option value="0">ALL</option>
                        @foreach ($lantai as $th)
                            @if (old('lantai') == $th->kode)
                                <option value="{{ $th->id }}" selected>{{ $th->kode }}
                                </option>
                            @else
                                <option value="{{ $th->id }}">{{ $th->kode }}</option>
                            @endif
                        @endforeach
                    </select>

                </div>
                <label for="inputPassword3" class="col-sm-2 col-form-label">sampai</label>
                <div class="col-sm-3">
                    <select class="form-control" name="lantai2" id="lantai2">
                        <option value="">-- Pilih --</option>
                        <option value="0">ALL</option>
                        @foreach ($lantai as $th)
                            @if (old('lantai2') == $th->kode)
                                <option value="{{ $th->id }}" selected>{{ $th->kode }}
                                </option>
                            @else
                                <option value="{{ $th->id }}">{{ $th->kode }}</option>
                            @endif
                        @endforeach
                    </select>

                </div>
            </div>


        </div>
        <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" id="btn_preview">Preview Pesan Blast</button>
            {{-- <button type="button" class="btn btn-primary" id="btn_kirim">Proses Kirim Pesan Blast</button> --}}
        </div>
    </div>
    <!-- /.modal-content -->
</div>
