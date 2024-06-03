<script>
    $(document).ready(function() {
        // Inisialisasi DataTable di sini jika belum ada

        // Event listener untuk tombol Save changes
        var table =
            $('#inv_billing').DataTable({
                "processing": true,
                "serverSide": true,
                "ajax": "{{ route('filter.invoices') }}",
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
                        "data": "hand_phone",
                        "name": 'hand_phone'
                    },
                    {
                        "data": "IPL_DC",
                        "name": 'IPL_DC'
                    },
                    {
                        "data": "AIR",
                        "name": 'AIR'
                    },
                    {
                        "data": "tunggakan_sebelumnya",
                        "name": 'tunggakan_sebelumnya'
                    },
                    {
                        "data": "tagihan_bln_ini",
                        "name": 'tagihan_bln_ini'
                    },
                    {
                        "data": "deposit",
                        "name": 'deposit'
                    },
                    {
                        "data": "tagihan_dibayar",
                        "name": 'tagihan_dibayar'
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
                "ajax": "{{ route('billing.preview') }}",
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
                        "data": "hand_phone",
                        "name": 'hand_phone'
                    },
                    {
                        "data": "isi_pesan",
                        "name": 'isi_pesan'
                    },

                    // dan seterusnya
                ]
            });

        $('#modal-filter').on('show.bs.modal', function(e) {
            $('#fin_year').val('');
            $('#fin_month').val('');
            $('#reminder_no3').val('');

            $('.alert-danger').addClass('d-none');
            $('.alert-danger').html('');

            $('.alert-success').addClass('d-none');
            $('.alert-success').html('');
        });

        $('#btn-filter').click(function() {
            var tahun = $('#fin_year').val();
            var bulan = $('#fin_month').val();
            var reminder_no = $('#reminder_no3').val();

            console.log("Tahun: " + tahun + ", Bulan: " + bulan + "reminder_no: " +
                reminder_no); // Cek nilai yang dikirim
            table.ajax.url("{{ route('filter.invoices') }}?tahun=" + tahun + "&bulan=" + bulan +
                "&reminder_no=" + reminder_no).load();
            $('#tabel_inv_billing').show();
            $('#tabel_inv_blast').hide();
            $('#modal-filter').modal('hide'); // Tutup modal setelah submit
        });

        $('#exampleInputEmail1').change(function() {

            $('.alert-danger').addClass('d-none');
            $('.alert-danger').html('');

            $('.alert-success').addClass('d-none');
            $('.alert-success').html('');
        });
        // btn import
        $('#btn_upload').click(function(e) {
            e.preventDefault();

            // Ambil nilai input
            var fin_month = $('#fin_month3').val();
            var fin_year = $('#fin_year3').val();
            var formData = new FormData();
            formData.append('file', $('input[type=file]')[0].files[0]);
            formData.append('fin_month', fin_month);
            formData.append('fin_year', fin_year);

            $.ajax({
                url: '/billing/import-invoices',
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
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
                        table.ajax.url("{{ route('filter.invoices') }}?tahun=" + fin_year +
                            "&bulan=" + fin_month).load();
                    }

                },

            });
        });

        // Bersihkan isian file saat modal dibuka
        $('#modal-import').on('show.bs.modal', function(e) {
            $('#exampleInputEmail1').val('');
            $('#fin_month3').val('');
            $('#fin_year3').val('');

            $('.alert-danger').addClass('d-none');
            $('.alert-danger').html('');

            $('.alert-success').addClass('d-none');
            $('.alert-success').html('');
        });
        // Bersihkan isian file saat modal dibuka
        $('#modal-import2').on('show.bs.modal', function(e) {
            $('#file_outstanding').val('');
            $('#fin_month2').val('');
            $('#fin_year2').val('');
            $('#reminder_no').val('');

            $('.alert-danger').addClass('d-none');
            $('.alert-danger').html('');

            $('.alert-success').addClass('d-none');
            $('.alert-success').html('');
        });
        // btn upload outstanding

        $('#btn_upload_outstanding').click(function(e) {
            e.preventDefault();

            // Ambil nilai input
            var fin_month = $('#fin_month2').val();
            var fin_year = $('#fin_year2').val();
            var reminder_no = $('#reminder_no').val();
            var file = $('#file_outstanding')[0].files[0];

            // Buat objek FormData dan tambahkan data
            var formData = new FormData();
            formData.append('fin_month', fin_month);
            formData.append('fin_year', fin_year);
            formData.append('reminder_no', reminder_no);
            formData.append('file', file);

            // Debug: Cetak nilai-nilai formData di konsol
            console.log("FormData Content:");
            console.log("fin_month:", fin_month);
            console.log("fin_year:", fin_year);
            console.log("reminder_no:", reminder_no);
            console.log("file:", file);

            $.ajax({
                url: "{{ route('billing.invoice-import-outstanding') }}",
                method: "POST", // Menggunakan method: 'POST'
                data: formData,
                contentType: false,
                processData: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
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
                        console.log("Tahun: " + fin_year + ", Bulan: " + fin_month +
                            ", reminder_no:" + reminder_no);
                        table.ajax.url(
                            "{{ route('filter.invoices_reminder') }}?tahun=" +
                            fin_year +
                            "&bulan=" + fin_month +
                            "&reminder_no=" + reminder_no).load();
                    }


                },

            });
        });

        // Bersihkan isian file saat modal dibuka
        $('#modal-proses').on('show.bs.modal', function(e) {

            // $('#fin_bulan').val('');
            // $('#fin_tahun').val('');
            // $('#reminder_no2').val('');
            // $('#tower').val('');
            // $('#tower2').val('');
            // $('#lantai').val('');
            // $('#lantai2').val('');

            $('.alert-danger').addClass('d-none');
            $('.alert-danger').html('');

            $('.alert-success').addClass('d-none');
            $('.alert-success').html('');
        });
        // Btn preview

        $('#btn_preview').click(function() {
            var tahun = $('#fin_tahun').val();
            var bulan = $('#fin_bulan').val();
            var tower = $('#tower').val();
            var tower2 = $('#tower2').val();
            var lantai = $('#lantai').val();
            var lantai2 = $('#lantai2').val();
            var reminder_no = $('#reminder_no2').val();

            // Buat objek FormData dan tambahkan data
            var formData = new FormData();
            formData.append('fin_bulan', bulan);
            formData.append('fin_tahun', tahun);
            formData.append('reminder_no', reminder_no);
            formData.append('tower', tower);
            formData.append('tower2', tower2);
            formData.append('lantai', lantai);
            formData.append('lantai2', lantai2);

            // Debug: Cetak nilai-nilai formData di konsol
            console.log("FormData Content: , Bulan: " + bulan + ", tahun: " + tahun +
                ", reminder_no: " + reminder_no + ", tower: " + tower + " dan " + tower2 +
                ", lantai: " + lantai + " sampai " + lantai2);

            $.ajax({
                url: "{{ route('billing.getpreview') }}",
                method: "POST", // Menggunakan method: 'POST'
                data: formData,
                contentType: false,
                processData: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
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

                        console.log("Tahun: " + tahun + ", Bulan: " + bulan + ", Tower:" +
                            tower + " to " + tower2 +
                            ", Lantai:" + lantai + " to " + lantai2
                        ); // Cek nilai yang dikirim
                        table_blast.ajax.url("{{ route('billing.preview') }}?fin_tahun=" +
                                tahun + "&fin_bulan=" + bulan +
                                "&tower=" + tower + "&tower2=" + tower2 + "&lantai=" +
                                lantai + "&lantai2=" +
                                lantai2 + "&reminder_no=" + reminder_no)
                            .load();

                        $('#tabel_inv_billing').hide();
                        $('#tabel_inv_blast').show();
                        $('#modal-proses').modal('hide'); // Tutup modal setelah submit
                    }
                },
            });
        });

        $('#btn_kirim').click(function() {
            var tahun = $('#fin_tahun').val();
            var bulan = $('#fin_bulan').val();
            var tower = $('#tower').val();
            var tower2 = $('#tower2').val();
            var lantai = $('#lantai').val();
            var lantai2 = $('#lantai2').val();
            var reminder_no = $('#reminder_no2').val();

            console.log("Tahun: " + tahun + ", Bulan: " + bulan + ", Tower:" + tower + " to " + tower2 +
                ", Lantai:" + lantai + " to " + lantai2 + " reminder_no: " + reminder_no
            ); // Cek nilai yang dikirim
            $.ajax({
                url: "{{ route('billing.kirim-blast-inv') }}",
                type: "GET",
                data: {
                    tahun: tahun,
                    bulan: bulan,
                    tower: tower,
                    tower2: tower2,
                    lantai: lantai,
                    lantai2: lantai2,
                    reminder_no: reminder_no,
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

            // Menutup modal setelah submit


            $('#modal-proses').modal('hide'); // Tutup modal setelah submit
        });

        $('#btn_kirim-sample').click(function() {
            var tahun = $('#fin_tahun').val();
            var bulan = $('#fin_bulan').val();
            var reminder_no = $('#reminder_no2').val();

            console.log("Tahun: " + tahun + ", Bulan: " + bulan + " reminder_no: " +
                reminder_no); // Cek nilai yang dikirim
            $.ajax({
                url: "{{ route('billing.kirim-blast-inv-sampel') }}",
                type: "GET",
                data: {
                    tahun: tahun,
                    bulan: bulan,
                    reminder_no: reminder_no,
                },
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
                        console.log("Tahun: " + tahun + ", Bulan: " + bulan);
                        // $('#tabel_inv_sp').hide();
                        // $('#tabel_inv_blast').show();
                        // $('#modal-filter').modal('hide'); // Tutup modal setelah submit
                    }
                }
            });
            // $('#modal-proses').modal('hide'); // Tutup modal setelah submit
        });
    });
</script>
