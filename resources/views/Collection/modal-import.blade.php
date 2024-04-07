<div class="modal-dialog">
    <div class="modal-content">
        <form id="import_form_sp">
            <div class="modal-header">
                <h4 class="modal-title">Form Import Data Invoice SP {{ $reminder }}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="card card-primary">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card card-primary">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="bulan">Bulan</label>

                                        <select class="form-control" name="fin_month" id="fin_month">
                                            <option value="">-- Pilih --</option>
                                            @foreach ($fin_month as $item)
                                                @if (old('fin_month') == $item['id'])
                                                    )
                                                    <option value="{{ $item['id'] }}" selected>
                                                        {{ $item['name'] }}</option>
                                                @else
                                                    <option value="{{ $item['id'] }}">
                                                        {{ $item['name'] }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="tahun">Tahun</label>
                                        <select class="form-control" name="fin_year" id="fin_year">
                                            <option value="">-- Pilih --</option>
                                            @foreach ($fin_year as $item)
                                                @if (old('fin_year') == $item['id'])
                                                    )
                                                    <option value="{{ $item['id'] }}" selected>
                                                        {{ $item['name'] }}</option>
                                                @else
                                                    <option value="{{ $item['id'] }}">
                                                        {{ $item['name'] }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                    @if ($reminder != 'asuransi')
                                        <div class="form-group">
                                            <label for="tahun">Tipe SP {{ $reminder }}</label>
                                            <select class="form-control" name="tipe_sp" id="tipe_sp">
                                                <option value="">-- Pilih --</option>
                                                @foreach ($tipe_sp as $item)
                                                    @if (old('tipe_sp') == $item['id'])
                                                        <option value="{{ $item['id'] }}" selected>
                                                            {{ $item['name'] }}</option>
                                                    @else
                                                        <option value="{{ $item['id'] }}">
                                                            {{ $item['name'] }}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                    @endif
                                    <div class="form-group">
                                        <input type="hidden" id="reminder_no" value="{{ $reminder }}"
                                            name="reminder_no">
                                    </div>
                                    @if ($reminder == 'asuransi')
                                        <div class="form-group">
                                            <label for="reminder">Reminder
                                                No</label>
                                            <select class="form-control" name="reminder_no_ass" id="reminder_no_ass">
                                                <option value="">-- Pilih --</option>
                                                @foreach ($reminder_no as $item)
                                                    @if (old('reminder_no_ass') == $item['id'])
                                                        )
                                                        <option value="{{ $item['id'] }}" selected>
                                                            {{ $item['name'] }}</option>
                                                    @else
                                                        <option value="{{ $item['id'] }}">
                                                            {{ $item['name'] }}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>

                                    @endif

                                    <div class="form-group">
                                        <label for="tgl_cetak">Tanggal Kirim</label>
                                        <input type="date" name="tgl_cetak" {{-- value={{ old('tgl_cetak') }} --}}
                                            class="form-control" id="tgl_cetak" placeholder="Tanggal Kirim">
                                    </div>
                                    <div class="form-group">
                                        <label for="tgl_batas_bayar">Tanggal Batas
                                            Bayar</label>
                                        <input type="date" name="tgl_batas_bayar" {{-- value={{ old('tgl_batas_bayar') }} --}}
                                            class="form-control" id="tgl_batas_bayar" placeholder="Tanggal batas Bayar">
                                    </div>
                                    @if ($reminder != 1)
                                        @if ($reminder != 'asuransi')
                                            <div class="form-group">
                                                <label for="tgl_tempo_awal">Tanggal Tempo Awal
                                                </label>
                                                <input type="date" name="tgl_tempo_awal" {{-- value={{ old('tgl_tempo_akhir') }} --}}
                                                    class="form-control" id="tgl_tempo_awal"
                                                    placeholder="Tanggal Tempo Awal">
                                            </div>
                                        @endif
                                        <div class="form-group">
                                            <label for="tgl_tempo_akhir">Tanggal Tempo
                                                Terakhir</label>
                                            <input type="date" name="tgl_tempo_akhir" {{-- value={{ old('tgl_tempo_akhir') }} --}}
                                                class="form-control" id="tgl_tempo_akhir"
                                                placeholder="Tanggal Tempo Akhir">
                                        </div>
                                    @endif
                                    <div class="form-group">
                                        <label for="exampleInputFile">File input</label>
                                        <input type="file" class="form-control" id="exampleInputEmail1"
                                            name="file">
                                        @error('file')
                                            <small>{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="btn_upload_sp">Upload Data SP
                    {{ $reminder }}</button>
            </div>
        </form>
    </div>
</div>
