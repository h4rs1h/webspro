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
                },
                "columns": [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        "data": "unitid",
                        "name": 'unitid'
                    },
                    {
                        "data": "name",
                        "name": 'name'
                    },
                    {
                        "data": "handphone",
                        "name": 'handphone'
                    },
                    {
                        "data": "tgl_cetak",
                        "name": 'tgl_cetak'
                    },
                    {
                        "data": "tagihan",
                        "name": 'tagihan'
                    },

                    {
                        "data": "tagihan_sebelumnya",
                        "name": 'tagihan_sebelumnya'
                    },
                    {
                        "data": "total_tagihan",
                        "name": 'total_tagihan'
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
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        "data": "unitid",
                        "name": 'unitid'
                    },
                    {
                        "data": "name",
                        "name": 'name'
                    },
                    {
                        "data": "handphone",
                        "name": 'handphone'
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
            var tipe_sp = $('#tipe_sp').val();

            // if (fin_month == '' || fin_year == '' || tgl_cetak == '' || tgl_batas_bayar == '' || file ==
            //     '') {
            //     alert('Harap lengkapi semua inputan');
            //     return;
            // }
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
            formData.append('tipe_sp', $('#tipe_sp').val());

            console.log("Tahun: " + fin_year + ", Bulan: " + fin_month + ", Reminder:" + reminder_no +
                " tgl_cetak: " + tgl_cetak +
                ", tgl_batas_bayar:" + tgl_batas_bayar + " tgl_tempo_awal " + tgl_tempo_awal +
                " tgl_tempo_akhir " + tgl_tempo_akhir); // Cek nilai yang dikirim
            $.ajax({
                type: 'POST', // Tentukan tipe permintaan
                url: '/collection/upload', // Sesuaikan dengan URL endpoint untuk upload data SP
                data: formData,
                contentType: false,
                processData: false,
                dataType: 'json',
                success: function(response) {
                    if (response.errors) {
                        console.log(response.errors);
                        $('.alert-success').addClass('d-none');
                        $('.alert-danger').removeClass('d-none');
                        $('.alert-danger').html("<ul>");
                        $.each(response.errors, function(key, value) {
                            $('.alert-danger').find('ul').append("<li>" + value +
                                "</li>");
                        });
                        $('.alert-danger').append("</ul>");
                    } else {
                        $('.alert-danger').addClass('d-none');
                        $('.alert-success').removeClass('d-none');
                        $('.alert-success').html(response.success);
                        console.log("Tahun: " + fin_year + ", Bulan: " + fin_month);
                        table.ajax.url("{{ route('filter.collection') }}?tahun=" +
                            fin_year +
                            "&bulan=" + fin_month +
                            "&reminder_no=" + reminder_no +
                            "&tipe_sp=" + tipe_sp +
                            "&tgl_cetak=" + tgl_cetak +
                            "&tgl_batas_bayar=" + tgl_batas_bayar).load();
                    }

                },

            });
        });


        $('#modal-filter').on('show.bs.modal', function(e) {
            // $('#tgl_cetak').val('');
            // $('#fin_month').val('');
            // $('#fin_year').val('');
            // $('#tgl_batas_bayar').val('');
            // $('#tipe_sp').val('');
            // $('#exampleInputEmail1').val('');

            $('.alert-danger').addClass('d-none');
            $('.alert-danger').html('');

            $('.alert-success').addClass('d-none');
            $('.alert-success').html('');
        });
        $('#btn-reset').click(function() {
            $('#fin_year2').val('');
            $('#fin_month2').val('');
            $('#tgl_cetak2').val('');
            $('#tgl_batas_bayar2').val('');
            $('#tipe_sp2').val('');

        })
        // Bersihkan isian file saat modal dibuka
        $('#modal-import').on('show.bs.modal', function(e) {
            $('#tgl_cetak').val('');
            $('#fin_month').val('');
            $('#fin_year').val('');
            $('#tgl_batas_bayar').val('');
            $('#tipe_sp').val('');
            $('#exampleInputEmail1').val('');

            $('.alert-danger').addClass('d-none');
            $('.alert-danger').html('');

            $('.alert-success').addClass('d-none');
            $('.alert-success').html('');
        });
        // btn filter
        $('#btn-filter').click(function() {
            var tahun = $('#fin_year2').val();
            var bulan = $('#fin_month2').val();
            var tgl_cetak = $('#tgl_cetak2').val();
            var tgl_batas_bayar = $('#tgl_batas_bayar2').val();
            var reminder_no = $('#reminder_no2').val();
            var tipe_sp = $('#tipe_sp2').val();

            if (!tahun || !bulan || !tgl_cetak || !tgl_batas_bayar || !tipe_sp) {
                alert('Harap lengkapi semua inputan.');
                return;
            }

            console.log("Tahun: " + tahun + ", Bulan: " + bulan + " tgl_cetak: " + tgl_cetak +
                ", tgl_batas_bayar: " + tgl_batas_bayar +
                ", tipe_sp: " + tipe_sp); // Cek nilai yang dikirim

            table.ajax.url("{{ route('filter.collection') }}?sp=" + reminder_no +
                "&bulan=" + bulan +
                "&tahun=" + tahun +
                "&tgl_cetak=" + tgl_cetak +
                "&tgl_batas_bayar=" + tgl_batas_bayar +
                "&tipe_sp=" + tipe_sp).load();

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
            var tipe_sp = $('#tipe_sp2').val();

            var formData = new FormData();
            formData.append('fin_month', bulan);
            formData.append('fin_year', tahun);
            formData.append('reminder_no', reminder_no);
            formData.append('tgl_cetak', tgl_cetak);
            formData.append('tgl_batas_bayar', tgl_batas_bayar);
            formData.append('tipe_sp', tipe_sp);

            $.ajax({
                type: 'POST', // Tentukan tipe permintaan
                url: '/collection/getpreview', // Sesuaikan dengan URL endpoint untuk upload data SP
                data: formData,
                contentType: false,
                processData: false,
                dataType: 'json',
                success: function(response) {
                    if (response.errors) {
                        console.log(response.errors);
                        $('.alert-success').addClass('d-none');
                        $('.alert-danger').removeClass('d-none');
                        $('.alert-danger').html("<ul>");
                        $.each(response.errors, function(key, value) {
                            $('.alert-danger').find('ul').append("<li>" + value +
                                "</li>");
                        });
                        $('.alert-danger').append("</ul>");
                    } else {
                        $('.alert-danger').addClass('d-none');
                        $('.alert-success').removeClass('d-none');
                        $('.alert-success').html(response.success);
                        console.log("Tahun: " + tahun + ", Bulan: " + bulan +
                            ", tipe_sp: " + tipe_sp + ", tgl_cetak: " + tgl_cetak +
                            ", tgl_batas_bayar: " + tgl_batas_bayar);
                        table_blast.ajax.url("{{ route('collection.preview') }}?tahun=" +
                            tahun +
                            "&bulan=" + bulan +
                            "&reminder_no=" + reminder_no +
                            "&tipe_sp=" + tipe_sp +
                            "&tgl_cetak=" + tgl_cetak +
                            "&tgl_batas_bayar=" + tgl_batas_bayar).load();

                        $('#tabel_inv_sp').hide();
                        $('#tabel_inv_blast').show();
                        $('#modal-filter').modal('hide'); // Tutup modal setelah submit
                    }

                },

            });

        });

        //btn Proses kirim SP
        $('#btn-proses-sp').click(function() {
            var tahun = $('#fin_year2').val();
            var bulan = $('#fin_month2').val();
            var tgl_cetak = $('#tgl_cetak2').val();
            var tgl_batas_bayar = $('#tgl_batas_bayar2').val();
            var reminder_no = $('#reminder_no2').val();
            var tipe_sp = $('#tipe_sp2').val();

            var formData = new FormData();
            formData.append('fin_month', bulan);
            formData.append('fin_year', tahun);
            formData.append('reminder_no', reminder_no);
            formData.append('tgl_cetak', tgl_cetak);
            formData.append('tgl_batas_bayar', tgl_batas_bayar);
            formData.append('tipe_sp', tipe_sp);

            console.log("Tahun: " + tahun + ", Bulan: " + bulan + " tgl_cetak: " + tgl_cetak +
                ", tgl_batas_bayar: " + tgl_batas_bayar); // Cek nilai yang dikirim

            $.ajax({
                type: 'POST', // Tentukan tipe permintaan
                url: '/collection/kirim-blast-sp', // Sesuaikan dengan URL endpoint untuk upload data SP
                data: formData,
                contentType: false,
                processData: false,
                dataType: 'json',
                success: function(response) {
                    if (response.errors) {
                        console.log(response.errors);
                        $('.alert-success').addClass('d-none');
                        $('.alert-danger').removeClass('d-none');
                        $('.alert-danger').html("<ul>");
                        $.each(response.errors, function(key, value) {
                            $('.alert-danger').find('ul').append("<li>" + value +
                                "</li>");
                        });
                        $('.alert-danger').append("</ul>");
                    } else {
                        $('.alert-danger').addClass('d-none');
                        $('.alert-success').removeClass('d-none');
                        $('.alert-success').html(response.success);
                        console.log("Tahun: " + tahun + ", Bulan: " + bulan +
                            ", tipe_sp: " + tipe_sp + ", tgl_cetak: " + tgl_cetak +
                            ", tgl_batas_bayar: " + tgl_batas_bayar);
                        // $('#tabel_inv_sp').hide();
                        // $('#tabel_inv_blast').show();
                        // $('#modal-filter').modal('hide'); // Tutup modal setelah submit
                    }
                },
            });
        });

        $('#btn-proses-sp-sample').click(function() {
            var tahun = $('#fin_year2').val();
            var bulan = $('#fin_month2').val();
            var tgl_cetak = $('#tgl_cetak2').val();
            var tgl_batas_bayar = $('#tgl_batas_bayar2').val();
            var reminder_no = $('#reminder_no2').val();
            var tipe_sp = $('#tipe_sp2').val();

            var formData = new FormData();
            formData.append('fin_month', bulan);
            formData.append('fin_year', tahun);
            formData.append('reminder_no', reminder_no);
            formData.append('tgl_cetak', tgl_cetak);
            formData.append('tgl_batas_bayar', tgl_batas_bayar);
            formData.append('tipe_sp', tipe_sp);

            console.log("Tahun: " + tahun + ", Bulan: " + bulan + " tgl_cetak: " + tgl_cetak +
                ", tgl_batas_bayar: " + tgl_batas_bayar); // Cek nilai yang dikirim

            $.ajax({
                type: 'POST', // Tentukan tipe permintaan
                url: '/collection/kirim-blast-sp-sample', // Sesuaikan dengan URL endpoint untuk upload data SP
                data: formData,
                contentType: false,
                processData: false,
                dataType: 'json',
                success: function(response) {
                    if (response.errors) {
                        console.log(response.errors);
                        $('.alert-success').addClass('d-none');
                        $('.alert-danger').removeClass('d-none');
                        $('.alert-danger').html("<ul>");
                        $.each(response.errors, function(key, value) {
                            $('.alert-danger').find('ul').append("<li>" + value +
                                "</li>");
                        });
                        $('.alert-danger').append("</ul>");
                    } else {
                        $('.alert-danger').addClass('d-none');
                        $('.alert-success').removeClass('d-none');
                        $('.alert-success').html(response.success);
                        console.log("Tahun: " + tahun + ", Bulan: " + bulan +
                            ", tipe_sp: " + tipe_sp + ", tgl_cetak: " + tgl_cetak +
                            ", tgl_batas_bayar: " + tgl_batas_bayar);
                        // $('#tabel_inv_sp').hide();
                        // $('#tabel_inv_blast').show();
                        // $('#modal-filter').modal('hide'); // Tutup modal setelah submit
                    }
                },
            });
        });

        //btn preview Asuransi
        $('#btn-preview-sp-asuransi').click(function() {
            var tahun = $('#fin_year2').val();
            var bulan = $('#fin_month2').val();
            var tgl_cetak = $('#tgl_cetak2').val();
            var tgl_batas_bayar = $('#tgl_batas_bayar2').val();
            var reminder_no = $('#reminder_no2').val();
            var tipe = $('#tipe').val();


            console.log("Tahun: " + tahun + ", Bulan: " + bulan + " tgl_cetak: " + tgl_cetak +
                ", tgl_batas_bayar: " + tgl_batas_bayar + " tipe SP: " + reminder_no + " plus: " +
                tipe); // Cek nilai yang dikirim

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
            var tipe = 'asuransi';
            console.log("Tahun: " + tahun + ", Bulan: " + bulan + " tgl_cetak: " + tgl_cetak +
                ", tgl_batas_bayar: " + tgl_batas_bayar); // Cek nilai yang dikirim



            $.ajax({
                url: "{{ route('collection.preview') }}",
                type: "GET",
                data: {
                    tahun: tahun,
                    bulan: bulan,
                    sp: reminder_no,
                    tgl_cetak: tgl_cetak,
                    tgl_batas_bayar: tgl_batas_bayar,
                    tipe: tipe
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
