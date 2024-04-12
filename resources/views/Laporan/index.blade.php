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
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-filter">
                            Filter Laporan
                        </button>
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-filter2">
                            Filter Laporan Detail
                        </button>


                        {{--
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-proses">
                            Proses Blast Invoice
                        </button> --}}
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
                    <div class="card-body" id="tabel_inv_billing">
                        <table id="inv_billing" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    {{-- <th>No</th> --}}
                                    <th>Tipe Pesan</th>
                                    <th>Tanggal Kirim</th>
                                    <th>Bulan</th>
                                    <th>Tahun</th>
                                    <th>Reminder</th>
                                    <th>Rencana Kirim</th>
                                    <th>Sukses</th>
                                    <th>Not Exists</th>
                                    <th>Failed</th>
                                    <th>Offline</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th colspan="10" class="text-right">
                                        <button class="btn btn-primary btn-sm" id="printBtn">Print</button>
                                        <button class="btn btn-primary btn-sm" id="exportBtn">Export</button>
                                        <button class="btn btn-primary btn-sm" id="pdfBtn">PDF</button>
                                    </th>
                                </tr>
                            </tfoot>
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
        @include('Laporan.modal-filter')
    </div>
    <div class="modal fade" id="modal-filter2">
        {{-- memisahkan scritp modal filter --}}
        @include('Laporan.modal-filter2')
    </div>
    <div class="modal fade" id="modal-proses">
        {{-- memisahkan script modal-proses --}}
        {{-- @include('Billing.modal-proses') --}}
    </div>
    <div class="modal fade" id="modal-import">
        {{-- memisahkan modal import --}}
        {{-- @include('Billing.modal-import') --}}
        <!-- /.modal-dialog -->
    </div>
    <div class="modal fade" id="modal-import2">
        {{-- memisahkan modal import --}}
        {{-- @include('Billing.modal-import-reminder') --}}
        <!-- /.modal-dialog -->
    </div>
@endsection
