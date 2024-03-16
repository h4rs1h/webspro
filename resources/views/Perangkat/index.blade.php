@extends('layout.main')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Perangkat WA</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Perangkat WA</li>
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

                        <div class="card-body">
                            <div class="tab-content" id="custom-tabs-three-tabContent">
                                <div class="tab-pane fade active show" id="custom-tabs-three-home" role="tabpanel"
                                    aria-labelledby="custom-tabs-three-home-tab">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="card">

                                                <div class="card-body">
                                                    <table id="example2" class="table table-bordered table-hover">
                                                        <thead>
                                                            <tr>
                                                                <th>No</th>
                                                                <th>Owner</th>
                                                                <th>No WA</th>
                                                                <th>API Key</th>
                                                                <th>API Kay Number</th>
                                                                <th>End Poin</th>
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
