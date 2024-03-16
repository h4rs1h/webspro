@extends('layout.main')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    {{-- <h1>{{ $title }}</h1> --}}
                </div>

            </div>
        </div><!-- /.container-fluid -->
    </section>
    <section class="content">
        <div class="row">
            <div class="col-12">

                <div class="card">
                    <div class="card-body">
                        <div id="notification" class="alert" style="display:none;"></div>
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-import">
                            Import Data Invoice
                        </button>

                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-filter">
                            Filter Data Invoice
                        </button>
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-proses">
                            Proses Blast Invoice
                        </button>
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-proses">
                            Antrian Blast Invoice
                        </button>

                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3>{{ $title }}</h3>

                    </div>
                    <div class="card-body" id="tabel_inv_billing">

                        <table id="inv_billing" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Unit ID</th>
                                    <th>Nama</th>
                                    <th>Handphone</th>
                                    <th>IPL DC</th>
                                    <th>AIR</th>
                                    <th>Tunggakan</th>
                                    <th>Tagihan</th>
                                    <th>Deposit</th>
                                    <th>Total Tagihan</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                    <div class="card-body" id="tabel_inv_blast" style="display:none;">

                        <table id="inv_blast" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Unit ID</th>
                                    <th>Nama</th>
                                    <th>Handphone</th>
                                    <th>Isi Pesan</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="modal fade" id="modal-filter">
        <div class="modal-dialog">
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
                                <label for="inputEmail3" class="col-sm-2 col-form-label">Tahun</label>
                                <div class="col-sm-8">
                                    <select class="form-control" name="fin_year" id="fin_year">
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
                                    <select class="form-control" name="fin_month" id="fin_month">
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
    </div>
    <!-- /.modal -->
    <div class="modal fade" id="modal-proses">
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
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
    <!-- /.modal -->
    <div class="modal fade" id="modal-import">
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
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
@endsection
