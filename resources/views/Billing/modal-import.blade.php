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
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">Tahun</label>
                        <div class="col-sm-8">
                            <select class="form-control" name="fin_year" id="fin_year3">
                                <option value="">-- Pilih --</option>
                                @foreach ($tahun as $th)
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
                        <label for="inputPassword3" class="col-sm-2 col-form-label">Bulan</label>
                        <div class="col-sm-8">
                            <select class="form-control" name="fin_month" id="fin_month3">
                                <option value="">-- Pilih --</option>
                                @foreach ($bulan as $th)
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
                    <div class="form-group  row">
                        <label for="exampleInputEmail1" class="col-sm-2 col-form-label">File</label>
                        <div class="col-sm-8">
                            <input type="file" class="form-control" id="exampleInputEmail1" name="file">
                            @error('file')
                                <small>{{ $message }}</small>
                            @enderror

                        </div>
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
