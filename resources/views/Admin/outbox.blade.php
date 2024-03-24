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
                        <button type="button" class="btn btn-primary" id="btn_data_antrian">
                            Data Antrian
                        </button>
                        <button type="button" class="btn btn-primary" id="btn_proses_job">
                            Proses Daftar Antrian
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
                    <div class="card-body" id="tabel_outbox">
                        <table id="outbox" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Debtor Acct</th>
                                    <th>Nama</th>
                                    <th>Handphone</th>
                                    <th>Tipe</th>
                                    <th>Tgl Kirim</th>
                                    <th>Pesan</th>
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
@endsection
