<div class="modal-dialog">
    <div class="modal-content">
        <form id="import_form_outstanding" method="POST">
            {{-- @csrf --}}
            <div class="modal-header">
                <h4 class="modal-title">Form Import Data Reminder Invoice</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="card card-primary">
                <div class="card-body">
                    <div class="form-group">
                        <label for="reminder">Reminder
                            No</label>
                        <select class="form-control" name="reminder_no" id="reminder_no">
                            <option value="">-- Pilih --</option>
                            @foreach ($reminder_no as $item)
                                @if (old('reminder_no') == $item['id'])
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
                        <label for="bulan">Bulan</label>

                        <select class="form-control" name="fin_month" id="fin_month2">
                            <option value="">-- Pilih --</option>
                            @foreach ($bulan as $item)
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
                        <select class="form-control" name="fin_year" id="fin_year2">
                            <option value="">-- Pilih --</option>
                            @foreach ($tahun as $item)
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
                    <div class="form-group">
                        <label for="exampleInputEmail1">File</label>
                        <input type="file" class="form-control" id="file_outstanding" name="file">
                        @error('file')
                            <small>{{ $message }}</small>
                        @enderror
                    </div>
                </div>

            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-success" id="btn_upload_outstanding">Upload</button>
            </div>

        </form>
    </div>
    <!-- /.modal-content -->
</div>
