@extends('layout.main')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">

                    <input type="hidden" id="sp" value="{{ $reminder }}" name="sp">
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-12">

                <div class="card">
                    <div class="card-body">
                        <div id="notification" class="alert" style="display:none;"></div>
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-import">
                            Import Data SP {{ $reminder }}
                        </button>
                        {{-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-import2">
                            Import Data Reminder Invoice
                        </button> --}}
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-filter">
                            Filter Data SP {{ $reminder }}
                        </button>
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-proses">
                            Proses Blast Data SP {{ $reminder }}
                        </button>
                        {{-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-proses">
                            Antrian Blast Invoice
                        </button> --}}

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
                    <div class="card-body" id="tabel_inv_sp">
                        <table id="inv_sp" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Unit ID</th>
                                    <th>Nama</th>
                                    {{-- <th>IPL</th>
                                    <th>DC</th>
                                    <th>AIR</th> --}}
                                    <th>Total Tagihan</th>
                                    {{-- <th>IPL (Sblmnya)</th>
                                    <th>DC (Sblmnya)</th>
                                    <th>AIR (Sblmnya)</th>
                                    <th>Denda</th>
                                    <th>Asuransi (Sblmnya)</th> --}}
                                    <th>Total (Sblmnya)</th>
                                    <th>Total Seluruhnya</th>
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
        {{-- memisahkan scritp modal filter --}}
        @include('Collection.modal-filter')
    </div>

    <div class="modal fade" id="modal-proses">
        {{-- memisahkan script modal-proses --}}
        {{-- @include('Billing.modal-proses') --}}
    </div>
    <div class="modal fade" id="modal-import">
        {{-- memisahkan modal import --}}
        @include('Collection.modal-import')
        <!-- /.modal-dialog -->
    </div>
    <div class="modal fade" id="modal-import2">
        {{-- memisahkan modal import --}}
        {{-- @include('Billing.modal-import-reminder') --}}
        <!-- /.modal-dialog -->
    </div>
@endsection
