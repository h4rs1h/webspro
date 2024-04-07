@extends('layout.main')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    {{-- <div class="content-wrapper"> --}}
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{ $title }}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">DataTables</li>
                    </ol>
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
                                        aria-selected="true">Data Ownership</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="custom-tabs-three-profile-tab" data-toggle="pill"
                                        href="#custom-tabs-three-profile" role="tab"
                                        aria-controls="custom-tabs-three-profile" aria-selected="false">Import Data</a>
                                </li>

                            </ul>
                        </div>
                        <div class="card-body">
                            <div id="notification" class="alert" style="display:none;"></div>
                            <div class="tab-content" id="custom-tabs-three-tabContent">
                                <div class="tab-pane fade active show" id="custom-tabs-three-home" role="tabpanel"
                                    aria-labelledby="custom-tabs-three-home-tab">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="card">

                                                <div class="card-body">
                                                    <table id="example3" class="table table-bordered table-hover">
                                                        <thead>
                                                            <tr>
                                                                <th>Debtor Acct</th>
                                                                {{-- <th>Unit</th> --}}
                                                                <th>Nama</th>
                                                                <th>Handphone</th>
                                                                <th>Nomor WA</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            {{-- @foreach ($data as $item)
                                                                <tr>
                                                                    <td>{{ $item->owner_acct }}</td>
                                                                    <td>{{ $item->owner_acct }}</td>
                                                                    <td>{{ $item->name }}</td>
                                                                    <td> {{ $item->hand_phone }}</td>
                                                                    <td>{{ $item->hand_phone }}</td>
                                                                </tr>
                                                            @endforeach --}}

                                                        </tbody>
                                                        {{-- <tfoot>
                                                            <tr>
                                                                <th>Rendering engine</th>
                                                                <th>Browser</th>
                                                                <th>Platform(s)</th>
                                                                <th>Engine version</th>
                                                                <th>CSS grade</th>
                                                            </tr>
                                                        </tfoot> --}}
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
                                        <form action="{{ route('admin.import-proses') }}" method="POST"
                                            enctype="multipart/form-data">
                                            @csrf
                                            <div class="row">
                                                <!-- left column -->
                                                <div class="col-md-12">
                                                    <!-- general form elements -->
                                                    <div class="card card-primary">
                                                        <div class="card-header">
                                                            <h3 class="card-title">Form Import Data Ownership</h3>
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
