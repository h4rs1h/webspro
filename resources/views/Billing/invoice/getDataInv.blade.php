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

                        <div class="card-body">
                            <div class="tab-content" id="custom-tabs-three-tabContent">
                                <div class="tab-pane fade active show" id="custom-tabs-three-home" role="tabpanel"
                                    aria-labelledby="custom-tabs-three-home-tab">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="card">
                                                <div class="card-body">

                                                    <button type="button" class="btn btn-primary">
                                                        Filter Data Invoice
                                                    </button>
                                                    <button type="button" class="btn btn-primary">
                                                        Proses Kirim Blast Invoice
                                                    </button>
                                                    <button type="button" class="btn btn-primary">
                                                        Import Data Invoice
                                                    </button>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="card">

                                                <div class="card-body">
                                                    <table id="polosinv" class="table table-bordered table-hover">
                                                        <thead>
                                                            <tr>
                                                                <th>Unit</th>
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
                                                            {{-- @foreach ($data as $dt)
                                                                <tr>
                                                                    <td>{{ $dt->unitid }}</td>
                                                                    <td>{{ $dt->name }}</td>
                                                                    <td>{{ $dt->hand_phone }}</td>
                                                                    <td align="right">{{ $dt->IPL_DC }}</td>
                                                                    <td align="right">{{ $dt->AIR }}</td>
                                                                    <td align="right">{{ $dt->tunggakan_sebelumnya }}</td>
                                                                    <td align="right">{{ $dt->tagihan_bln_ini }}</td>
                                                                    <td align="right">{{ $dt->deposit }}</td>
                                                                    <td align="right">{{ $dt->tagihan_dibayar }}</td>
                                                                </tr>
                                                            @endforeach --}}
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
                                        <form action="{{ route('invoice.import-proses') }}" method="POST"
                                            enctype="multipart/form-data">
                                            @csrf
                                            <div class="row">
                                                <!-- left column -->
                                                <div class="col-md-12">
                                                    <!-- general form elements -->
                                                    <div class="card card-primary">
                                                        <div class="card-header">
                                                            <h3 class="card-title">Form Import Data Invoice</h3>
                                                        </div>
                                                        <form>
                                                            <div class="card-body">
                                                                <div class="form-group">
                                                                    <label for="exampleInputEmail1">File</label>
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
