<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title">Proses Kirim Blast Invoice</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">

            <div class="form-group row">
                <label for="inputEmail3" class="col-sm-2 col-form-label">Tahun</label>
                <div class="col-sm-3">
                    <select class="form-control" name="fin_tahun" id="fin_tahun">
                        <option value="">-- Pilih --</option>
                        @foreach ($tahun as $th)
                            @if (old('fin_tahun') == $th['id'])
                                <option value="{{ $th['id'] }}" selected>{{ $th['name'] }}
                                </option>
                            @else
                                <option value="{{ $th['id'] }}">{{ $th['name'] }}</option>
                            @endif
                        @endforeach
                    </select>
                    @error('fin_tahun')
                        <div class="invalid-feedback" role="alert">
                            <strong>{{ $message }} </strong>
                        </div>
                    @enderror

                </div>
                <label for="inputPassword3" class="col-sm-2 col-form-label">Bulan</label>
                <div class="col-sm-3">
                    <select class="form-control" name="fin_bulan" id="fin_bulan">
                        <option value="">-- Pilih --</option>
                        @foreach ($bulan as $th)
                            @if (old('fin_bulan') == $th['id'])
                                <option value="{{ $th['id'] }}" selected>{{ $th['name'] }}
                                </option>
                            @else
                                <option value="{{ $th['id'] }}">{{ $th['name'] }}</option>
                            @endif
                        @endforeach
                    </select>
                    @error('fin_bulan')
                        <div class="invalid-feedback" role="alert">
                            <strong>{{ $message }} </strong>
                        </div>
                    @enderror
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
                    @error('tower')
                        <div class="invalid-feedback" role="alert">
                            <strong>{{ $message }} </strong>
                        </div>
                    @enderror
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
                    @error('tower2')
                        <div class="invalid-feedback" role="alert">
                            <strong>{{ $message }} </strong>
                        </div>
                    @enderror
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
                                <option value="{{ $th->kode }}" selected>{{ $th->kode }}
                                </option>
                            @else
                                <option value="{{ $th->kode }}">{{ $th->kode }}</option>
                            @endif
                        @endforeach
                    </select>
                    @error('lantai')
                        <div class="invalid-feedback" role="alert">
                            <strong>{{ $message }} </strong>
                        </div>
                    @enderror
                </div>
                <label for="inputPassword3" class="col-sm-2 col-form-label">sampai</label>
                <div class="col-sm-3">
                    <select class="form-control" name="lantai2" id="lantai2">
                        <option value="">-- Pilih --</option>
                        <option value="0">ALL</option>
                        @foreach ($lantai as $th)
                            @if (old('lantai2') == $th->kode)
                                <option value="{{ $th->kode }}" selected>{{ $th->kode }}
                                </option>
                            @else
                                <option value="{{ $th->kode }}">{{ $th->kode }}</option>
                            @endif
                        @endforeach
                    </select>
                    @error('lantai2')
                        <div class="invalid-feedback" role="alert">
                            <strong>{{ $message }} </strong>
                        </div>
                    @enderror
                </div>
            </div>


        </div>
        <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" id="btn_preview">Preview Pesan Blast</button>
            <button type="button" class="btn btn-primary" id="btn_kirim">Proses Kirim Pesan Blast</button>
        </div>
    </div>
    <!-- /.modal-content -->
</div>
