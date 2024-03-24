@extends('layout.main')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{ $title }}</h1>
                </div>

            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card card-primary card-outline card-tabs">
                        <div class="card-header p-0 pt-1 border-bottom-0">
                            <ul class="nav nav-tabs" id="custom-tabs-three-tab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="custom-tabs-three-home-tab" data-toggle="pill"
                                        href="#custom-tabs-three-home" role="tab" aria-controls="custom-tabs-three-home"
                                        aria-selected="true">Data Invoice SP</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="custom-tabs-three-profile-tab" data-toggle="pill"
                                        href="#custom-tabs-three-profile" role="tab"
                                        aria-controls="custom-tabs-three-profile" aria-selected="false">Import Data SP</a>
                                </li>

                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="tab-content" id="custom-tabs-three-tabContent">
                                <div class="tab-pane fade active show" id="custom-tabs-three-home" role="tabpanel"
                                    aria-labelledby="custom-tabs-three-home-tab">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="card">

                                                <div class="card-body">
                                                    <table id="invoicesp" class="table table-bordered table-hover">
                                                        <thead>
                                                            <tr>
                                                                <th>Debtor Acct</th>
                                                                <th>Bulan</th>
                                                                <th>Tahun</th>
                                                                <th>Nama</th>
                                                                <th>Handphone</th>
                                                                <th>Total Tagihan</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>

                                                        </tbody>

                                                    </table>
                                                </div>
                                                <!-- /.card-body -->
                                            </div>
                                            <!-- /.card -->
                                        </div>
                                        <!-- /.col -->
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="custom-tabs-three-profile" role="tabpanel"
                                    aria-labelledby="custom-tabs-three-profile-tab">
                                    <div class="container-fluid">
                                        <form action="{{ route('invoicesp.import-proses') }}" method="POST"
                                            enctype="multipart/form-data">
                                            @csrf
                                            <div class="row">
                                                <!-- left column -->
                                                <div class="col-md-6">
                                                    <!-- general form elements -->
                                                    <div class="card card-primary">
                                                        <div class="card-header">
                                                            <h3 class="card-title">Form Import Data Invoice SP</h3>
                                                        </div>
                                                        <!-- general form elements -->
                                                        <div class="card card-primary">
                                                            <form action="{{ route('invoicesp.import-proses') }}"
                                                                method="POST" enctype="multipart/form-data">
                                                                @csrf
                                                                <div class="card-body">
                                                                    <div class="form-group">
                                                                        <label for="bulan">Bulan</label>

                                                                        <select class="form-control" name="fin_month"
                                                                            id="fin_month">
                                                                            <option value="">-- Pilih --</option>
                                                                            @foreach ($fin_month as $item)
                                                                                @if (old('fin_month') == $item['id'])
                                                                                    )
                                                                                    <option value="{{ $item['id'] }}"
                                                                                        selected>
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
                                                                        <select class="form-control" name="fin_year"
                                                                            id="fin_year">
                                                                            <option value="">-- Pilih --</option>
                                                                            @foreach ($fin_year as $item)
                                                                                @if (old('fin_year') == $item['id'])
                                                                                    )
                                                                                    <option value="{{ $item['id'] }}"
                                                                                        selected>
                                                                                        {{ $item['name'] }}</option>
                                                                                @else
                                                                                    <option value="{{ $item['id'] }}">
                                                                                        {{ $item['name'] }}</option>
                                                                                @endif
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="reminder">Reminder
                                                                            No</label>
                                                                        <select class="form-control" name="reminder_no"
                                                                            id="reminder_no">
                                                                            <option value="">-- Pilih --</option>
                                                                            @foreach ($reminder_no as $item)
                                                                                @if (old('reminder_no') == $item['id'])
                                                                                    )
                                                                                    <option value="{{ $item['id'] }}"
                                                                                        selected>
                                                                                        {{ $item['name'] }}</option>
                                                                                @else
                                                                                    <option value="{{ $item['id'] }}">
                                                                                        {{ $item['name'] }}</option>
                                                                                @endif
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="tgl_cetak">Tanggal Kirim</label>
                                                                        <input type="date" name="tgl_cetak"
                                                                            {{-- value={{ old('tgl_cetak') }} --}} class="form-control"
                                                                            id="tgl_cetak" placeholder="Tanggal Kirim">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="tgl_batas_bayar">Tanggal Batas
                                                                            Bayar</label>
                                                                        <input type="date" name="tgl_batas_bayar"
                                                                            {{-- value={{ old('tgl_batas_bayar') }} --}} class="form-control"
                                                                            id="tgl_batas_bayar"
                                                                            placeholder="Tanggal batas Bayar">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="tgl_tempo_awal">Tanggal Tempo Awal
                                                                        </label>
                                                                        <input type="date" name="tgl_tempo_awal"
                                                                            {{-- value={{ old('tgl_tempo_akhir') }} --}} class="form-control"
                                                                            id="tgl_tempo_awal"
                                                                            placeholder="Tanggal Tempo Awal">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="tgl_tempo_akhir">Tanggal Tempo
                                                                            Terakhir</label>
                                                                        <input type="date" name="tgl_tempo_akhir"
                                                                            {{-- value={{ old('tgl_tempo_akhir') }} --}} class="form-control"
                                                                            id="tgl_tempo_akhir"
                                                                            placeholder="Tanggal Tempo Akhir">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="exampleInputFile">File input</label>
                                                                        <input type="file" class="form-control"
                                                                            id="exampleInputEmail1" name="file">
                                                                        @error('file')
                                                                            <small>{{ $message }}</small>
                                                                        @enderror

                                                                    </div>

                                                                </div>
                                                                <!-- /.card-body -->

                                                                <div class="card-footer">
                                                                    <button type="submit"
                                                                        class="btn btn-primary">Submit</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                        <!-- /.card -->

                                                    </div>
                                                    <!-- /.card -->
                                                </div>
                                                <!--/.col (left) -->
                                            </div>
                                        </form>
                                        <!-- /.row -->
                                    </div><!-- /.container-fluid -->
                                </div>

                            </div>
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
            </div>

            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
    {{-- </div> --}}
    <!-- /.content-wrapper -->
@endsection
