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
                <div class="alert alert-danger d-none"></div>
                <div class="alert alert-success d-none"></div>
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
                    @if ($reminder != 'asuransi')
                        <div class="form-group row">
                            <label for="tahun" class="col-sm-5 col-form-label">Tipe SP {{ $reminder }}</label>
                            <div class="col-sm-7">

                                <select class="form-control" name="tipe_sp2" id="tipe_sp2">
                                    <option value="">-- Pilih --</option>
                                    @foreach ($tipe_sp as $item)
                                        @if (old('tipe_sp2') == $item['id'])
                                            <option value="{{ $item['id'] }}" selected>
                                                {{ $item['name'] }}</option>
                                        @else
                                            <option value="{{ $item['id'] }}">
                                                {{ $item['name'] }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    @endif
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
            <div class="form-group">
                <input type="hidden" id="reminder_no2" value="{{ $reminder }}" name="reminder_no">
            </div>
            <div class="modal-footer justify-content-between">
                {{-- <button type="button" class="btn btn-default" id="btn-reset">Reset</button> --}}
                {{-- <button type="button" class="btn btn-primary" id="btn-filter">Show SP {{ $reminder }}</button> --}}
                <button type="button" class="btn btn-primary" id="btn-preview-sp">Preview Pesan SP
                    {{ $reminder }}</button>
                <button type="button" class="btn btn-primary" id="btn-proses-sp">Proses Kirim SP
                    {{ $reminder }}</button>
                <button type="button" class="btn btn-primary" id="btn-proses-sp-sample">Sample SP
                    {{ $reminder }}</button>
                {{-- @if ($reminder == '1')
                    <input type="hidden" id="tipe" value="asuransi" name="tipe">
                    <button type="button" class="btn btn-primary" id="btn-preview-sp-asuransi">Preview SP
                        Asuransi</button>
                    <button type="button" class="btn btn-primary" id="btn-proses-sp-asuransi">Kirim SP
                        Asuransi</button>
                @endif --}}
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
