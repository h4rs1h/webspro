<script>
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var sp = $('#sp').val();
        console.log(sp);
        var table =
            $('#inv_sp').DataTable({
                "processing": true,
                "serverSide": true,

                "autoWidth": false,

                "ajax": {
                    "url": "{{ route('filter.collection') }}",
                    // "method": "GET", // Mengubah metode HTTP menjadi GET
                    // "data": {
                    //     "sp": sp // Menambahkan parameter sp ke dalam data AJAX
                    // }
                },
                "columns": [{
                        "data": "unitid",
                        "name": 'unitid'
                    },
                    {
                        "data": "name",
                        "name": 'name'
                    },

                    {
                        "data": "total_tagihan",
                        "name": 'total_tagihan'
                    },

                    {
                        "data": "total_tagihan_lalu",
                        "name": 'total_tagihan_lalu'
                    },
                    {
                        "data": "total_semua",
                        "name": 'total_semua'
                    },
                    // dan seterusnya
                ]
            });
        var table_blast =
            $('#inv_blast').DataTable({
                "processing": true,
                "serverSide": true,
                "autoWidth": false,
                "responsive": true,
                "ajax": "{{ route('collection.preview') }}",
                "columns": [
                    // Sesuaikan dengan kolom tabel Anda
                    {
                        "data": "unitid",
                        "name": 'unitid'
                    },
                    {
                        "data": "name",
                        "name": 'name'
                    },
                    {
                        "data": "wa",
                        "name": 'wa'
                    },
                    {
                        "data": "isi_pesan",
                        "name": 'isi_pesan'
                    },

                    // dan seterusnya
                ]
            });
        $(function() {
            $("#invoicesp").DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
                "buttons": ["csv", "excel", "pdf", "print"],
                "processing": true,
                "serverSide": true,
                "ajax": '/invoicesp/json',
                "columns": [{
                        "data": 'debtor_acct',
                        "name": 'debtor_acct'
                    },
                    {
                        "data": 'fin_month',
                        "name": 'fin_month'
                    },
                    {
                        "data": 'fin_year',
                        "name": 'fin_year'
                    },
                    {
                        "data": 'name',
                        "name": 'name'
                    },
                    {
                        "data": 'wa',
                        "name": 'wa'
                    },
                    {
                        "data": 'TotalTagihan',
                        "name": 'TotalTagihan'
                    },
                ]
            }).buttons().container().appendTo('#invoicesp_wrapper .col-md-6:eq(0)');
        });

        // Upload file SP
        $('#btn_upload_sp').click(function() {
            // Validasi setiap input
            var fin_month = $('#fin_month').val();
            var fin_year = $('#fin_year').val();
            var reminder_no = $('#reminder_no').val();
            var reminder_no_ass = $('#reminder_no_ass').val();
            var tgl_cetak = $('#tgl_cetak').val();
            var tgl_batas_bayar = $('#tgl_batas_bayar').val();
            var tgl_tempo_awal = $('#tgl_tempo_awal').val();
            var tgl_tempo_akhir = $('#tgl_tempo_akhir').val();
            var file = $('#exampleInputFile').val();

            if (fin_month == '' || fin_year == '' || tgl_cetak == '' || tgl_batas_bayar == '' || file ==
                '') {
                alert('Harap lengkapi semua inputan.');
                return;
            }
            // Jika reminder_no = 1, atur tgl_tempo_awal dan tgl_tempo_akhir sama dengan tgl_batas_bayar
            if (reminder_no == 1) {
                tgl_tempo_awal = tgl_batas_bayar;
                tgl_tempo_akhir = tgl_batas_bayar;
            }
            // Mengirim data ke server menggunakan AJAX
            var formData = new FormData();
            formData.append('fin_month', $('#fin_month').val());
            formData.append('fin_year', $('#fin_year').val());
            formData.append('reminder_no', $('#reminder_no').val());
            formData.append('reminder_no_ass', $('#reminder_no_ass').val());
            formData.append('tgl_cetak', $('#tgl_cetak').val());
            formData.append('tgl_batas_bayar', $('#tgl_batas_bayar').val());
            formData.append('tgl_tempo_awal', $('#tgl_tempo_awal').val());
            formData.append('tgl_tempo_akhir', $('#tgl_tempo_akhir').val());
            formData.append('file', $('input[type=file]')[0].files[0]);
            console.log("Tahun: " + fin_year + ", Bulan: " + fin_month + ", Reminder:" + reminder_no +
                " tgl_cetak: " + tgl_cetak +
                ", tgl_batas_bayar:" + tgl_batas_bayar + " tgl_tempo_awal " + tgl_tempo_awal +
                " tgl_tempo_akhir " + tgl_tempo_akhir); // Cek nilai yang dikirim
            $.ajax({
                type: 'POST',
                url: '/collection/upload', // Sesuaikan dengan URL endpoint untuk upload data SP
                data: formData,
                contentType: false,
                processData: false,
                dataType: 'json',
                success: function(data) {
                    $('#import_form_sp').trigger('reset');
                    $('#modal-import').modal('hide');
                    // Tampilkan pesan sukses atau lakukan aksi lainnya
                    $('#notification').removeClass(data.remove).addClass(data.add).text(data
                        .message).show();
                    table.ajax.url("{{ route('filter.collection') }}?sp=" + reminder_no +
                        "&bulan=" + fin_month +
                        "&tahun=" + fin_year).load();
                },
                error: function(xhr, status, error) {
                    // Notifikasi upload gagal
                    $('#notification').removeClass(data.remove).addClass(data.add).text(data
                        .message).show();
                }
            });
        });

        // $('#modal-filter').on('show.bs.modal', function(e) {
        // });
        $('#btn-reset').click(function() {
            $('#fin_year2').val('');
            $('#fin_month2').val('');
            $('#tgl_cetak2').val('');
            $('#tgl_batas_bayar2').val('');

        })
        // btn filter
        $('#btn-filter').click(function() {
            var tahun = $('#fin_year2').val();
            var bulan = $('#fin_month2').val();
            var tgl_cetak = $('#tgl_cetak2').val();
            var tgl_batas_bayar = $('#tgl_batas_bayar2').val();
            var reminder_no = $('#reminder_no2').val();

            console.log("Tahun: " + tahun + ", Bulan: " + bulan + " tgl_cetak: " + tgl_cetak +
                ", tgl_batas_bayar: " + tgl_batas_bayar); // Cek nilai yang dikirim

            table.ajax.url("{{ route('filter.collection') }}?sp=" + reminder_no +
                "&bulan=" + bulan +
                "&tahun=" + tahun +
                "&tgl_cetak=" + tgl_cetak +
                "&tgl_batas_bayar=" + tgl_batas_bayar).load();

            $('#tabel_inv_sp').show();
            $('#tabel_inv_blast').hide();
            $('#modal-filter').modal('hide'); // Tutup modal setelah submit
        });

        //btn preview
        $('#btn-preview-sp').click(function() {
            var tahun = $('#fin_year2').val();
            var bulan = $('#fin_month2').val();
            var tgl_cetak = $('#tgl_cetak2').val();
            var tgl_batas_bayar = $('#tgl_batas_bayar2').val();
            var reminder_no = $('#reminder_no2').val();

            console.log("Tahun: " + tahun + ", Bulan: " + bulan + " tgl_cetak: " + tgl_cetak +
                ", tgl_batas_bayar: " + tgl_batas_bayar); // Cek nilai yang dikirim

            table_blast.ajax.url("{{ route('collection.preview') }}?sp=" + reminder_no +
                "&bulan=" + bulan +
                "&tahun=" + tahun +
                "&tgl_cetak=" + tgl_cetak +
                "&tgl_batas_bayar=" + tgl_batas_bayar).load();

            $('#tabel_inv_sp').hide();
            $('#tabel_inv_blast').show();
            $('#modal-filter').modal('hide'); // Tutup modal setelah submit
        });

        //btn Proses kirim SP
        $('#btn-proses-sp').click(function() {
            var tahun = $('#fin_year2').val();
            var bulan = $('#fin_month2').val();
            var tgl_cetak = $('#tgl_cetak2').val();
            var tgl_batas_bayar = $('#tgl_batas_bayar2').val();
            var reminder_no = $('#reminder_no2').val();

            console.log("Tahun: " + tahun + ", Bulan: " + bulan + " tgl_cetak: " + tgl_cetak +
                ", tgl_batas_bayar: " + tgl_batas_bayar); // Cek nilai yang dikirim

            // table_blast.ajax.url("{{ route('collection.proses-kirim-sp') }}?sp=" + reminder_no +
            //     "&bulan=" + bulan +
            //     "&tahun=" + tahun +
            //     "&tgl_cetak=" + tgl_cetak +
            //     "&tgl_batas_bayar=" + tgl_batas_bayar).load();

            $.ajax({
                url: "{{ route('collection.proses-kirim-sp') }}",
                type: "GET",
                data: {
                    tahun: tahun,
                    bulan: bulan,
                    sp: reminder_no,
                    tgl_cetak: tgl_cetak,
                    tgl_batas_bayar: tgl_batas_bayar
                },
                success: function(data) {
                    $('#notification').removeClass('alert-danger').addClass('alert-success')
                        .text(data.message).show();
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                    // Tampilkan pesan kesalahan jika ada
                    $('#notification').removeClass('alert-success').addClass('alert-danger')
                        .text(data.message).show();
                }
            });
            $('#modal-filter').modal('hide'); // Tutup modal setelah submit
        });

        //btn preview Asuransi
        $('#btn-preview-sp-asuransi').click(function() {
            var tahun = $('#fin_year2').val();
            var bulan = $('#fin_month2').val();
            var tgl_cetak = $('#tgl_cetak2').val();
            var tgl_batas_bayar = $('#tgl_batas_bayar2').val();
            var reminder_no = $('#reminder_no2').val();

            console.log("Tahun: " + tahun + ", Bulan: " + bulan + " tgl_cetak: " + tgl_cetak +
                ", tgl_batas_bayar: " + tgl_batas_bayar); // Cek nilai yang dikirim

            table_blast.ajax.url("{{ route('collection.preview') }}?sp=" + reminder_no +
                "&bulan=" + bulan +
                "&tahun=" + tahun +
                "&tgl_cetak=" + tgl_cetak +
                "&tgl_batas_bayar=" + tgl_batas_bayar + "&tipe=asuransi").load();

            $('#tabel_inv_sp').hide();
            $('#tabel_inv_blast').show();
            $('#modal-filter').modal('hide'); // Tutup modal setelah submit
        });

        //btn Proses kirim SP asuransi
        $('#btn-proses-sp-asuransi').click(function() {
            var tahun = $('#fin_year2').val();
            var bulan = $('#fin_month2').val();
            var tgl_cetak = $('#tgl_cetak2').val();
            var tgl_batas_bayar = $('#tgl_batas_bayar2').val();
            var reminder_no = $('#reminder_no2').val();

            console.log("Tahun: " + tahun + ", Bulan: " + bulan + " tgl_cetak: " + tgl_cetak +
                ", tgl_batas_bayar: " + tgl_batas_bayar); // Cek nilai yang dikirim

            // table_blast.ajax.url("{{ route('collection.proses-kirim-sp') }}?sp=" + reminder_no +
            //     "&bulan=" + bulan +
            //     "&tahun=" + tahun +
            //     "&tgl_cetak=" + tgl_cetak +
            //     "&tgl_batas_bayar=" + tgl_batas_bayar,
            // tipe=asuransi).load();

            $.ajax({
                url: "{{ route('collection.proses-kirim-sp') }}",
                type: "GET",
                data: {
                    tahun: tahun,
                    bulan: bulan,
                    sp: reminder_no,
                    tgl_cetak: tgl_cetak,
                    tgl_batas_bayar: tgl_batas_bayar,
                    tipe: asuransi
                },
                success: function(data) {
                    $('#notification').removeClass('alert-danger').addClass('alert-success')
                        .text(data.message).show();
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                    // Tampilkan pesan kesalahan jika ada
                    $('#notification').removeClass('alert-success').addClass('alert-danger')
                        .text(data.message).show();
                }
            });
            $('#modal-filter').modal('hide'); // Tutup modal setelah submit
        });

    });
</script>
