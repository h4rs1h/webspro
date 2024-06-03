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
                        <button type="button" class="btn btn-primary" data-toggle="modal"
                            data-target="#modal-blast_tenant_news">
                            Blast Tenant News
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
                    <div class="card-body" id="tabel_sum_rere">
                        <table id="sum_rere" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Tanggal</th>
                                    <th>Judul Pesan</th>
                                    <th>Rencana Kirim</th>
                                    <th>Sukses</th>
                                    <th>Not Exists</th>
                                    <th>Failed</th>
                                    <th>Offline</th>

                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                    <div class="card-body" id="tabel_sum_rere_blast" style="display:none;">

                        <table id="sum_rere_blast" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
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
    <div class="modal fade" id="modal-blast_tenant_news">
        {{-- memisahkan scritp modal filter --}}
        @include('Rere.modal-blast_tenant_news')
    </div>
@endsection
