<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title">{{ $title_form_filter }}</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="card-body">
                <form id="filter_form">
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-5 col-form-label">Tahun</label>
                        <div class="col-sm-7">
                            <select class="form-control" name="fin_year" id="fin_year2">
                                <option value="">-- Pilih --</option>
                                @foreach ($fin_year as $th)
                                    @if (old('fin_year') == $th['id'])
                                        <option value="{{ $th['id'] }}" selected>{{ $th['name'] }}
                                        </option>
                                    @else
                                        <option value="{{ $th['id'] }}">{{ $th['name'] }}</option>
                                    @endif
                                @endforeach
                            </select>
                            @error('fin_year')
                                <div class="invalid-feedback" role="alert">
                                    <strong>{{ $message }} </strong>
                                </div>
                            @enderror

                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputPassword3" class="col-sm-5 col-form-label">Bulan</label>
                        <div class="col-sm-7">
                            <select class="form-control" name="fin_month" id="fin_month2">
                                <option value="">-- Pilih --</option>
                                @foreach ($fin_month as $th)
                                    @if (old('fin_month') == $th['id'])
                                        <option value="{{ $th['id'] }}" selected>{{ $th['name'] }}
                                        </option>
                                    @else
                                        <option value="{{ $th['id'] }}">{{ $th['name'] }}</option>
                                    @endif
                                @endforeach
                            </select>
                            @error('fin_month')
                                <div class="invalid-feedback" role="alert">
                                    <strong>{{ $message }} </strong>
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="tgl_cetak" class="col-sm-5 col-form-label">Tanggal Kirim</label>
                        <div class="col-sm-7">
                            <input type="date" name="tgl_cetak" {{-- value={{ old('tgl_cetak') }} --}} class="form-control"
                                id="tgl_cetak2" placeholder="Tanggal Kirim">
                        </div>

                    </div>
                    <div class="form-group row">
                        <label for="tgl_batas_bayar" class="col-sm-5 col-form-label">Tanggal Batas
                            Bayar</label>
                        <div class="col-sm-7">
                            <input type="date" name="tgl_batas_bayar" {{-- value={{ old('tgl_batas_bayar') }} --}} class="form-control"
                                id="tgl_batas_bayar2" placeholder="Tanggal batas Bayar">
                        </div>
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
