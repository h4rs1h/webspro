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
                            <div id="notification" class="alert" style="display:none;"></div>
                            <div class="tab-content" id="custom-tabs-three-tabContent">
                                <div class="tab-pane fade active show" id="custom-tabs-three-home" role="tabpanel"
                                    aria-labelledby="custom-tabs-three-home-tab">
                                    <div class="row">

                                        <div class="col-12">
                                            <div class="card">

                                                <div class="card-body">
                                                    <table id="daftarhp" class="table table-bordered table-hover">
                                                        <thead>
                                                            <tr>
                                                                <th>No</th>
                                                                <th>Owner</th>
                                                                <th>No WA</th>
                                                                <th>API Key</th>
                                                                <th>API Kay Number</th>
                                                                <th>End Poin</th>
                                                                <th>Aksi</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>

                                                        </tbody>

                                                    </table>
                                                </div>

                                            </div>

                                        </div>

                                    </div>
                                </div>


                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </div>

    </section>
    <div class="modal fade" id="modal-tambah">
        {{-- memisahkan scritp modal filter --}}
        {{-- @include('Billing.modal-filter') --}}
    </div>

    <div class="modal dialog" id="editModal">
        {{-- memisahkan scritp modal filter --}}
        @include('Perangkat.modal-edit')
    </div>
@endsection
