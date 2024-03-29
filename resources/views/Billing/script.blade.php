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
        });

        $('#btn-filter').click(function() {
            var tahun = $('#fin_year').val();
            var bulan = $('#fin_month').val();
            console.log("Tahun: " + tahun + ", Bulan: " + bulan); // Cek nilai yang dikirim
            table.ajax.url("{{ route('filter.invoices') }}?tahun=" + tahun + "&bulan=" + bulan).load();
            $('#tabel_inv_billing').show();
            $('#tabel_inv_blast').hide();
            $('#modal-filter').modal('hide'); // Tutup modal setelah submit
        });
        // btn import
        $('#btn_upload').click(function(e) {
            e.preventDefault();

            var formData = new FormData();
            formData.append('file', $('input[type=file]')[0].files[0]);

            $.ajax({
                url: '/billing/import-invoices',
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(data) {
                    console.log(data);
                    $('#modal-import').modal('hide');
                    // Bersihkan form setelah upload berhasil
                    $('form')[0].reset();
                    // Refresh data atau tampilkan pesan sukses di sini
                    // Tampilkan notifikasi
                    $('#notification').removeClass('alert-danger').addClass('alert-success')
                        .text(data.message).show();
                },
                error: function(data) {
                    console.log(data);
                    // Handle error di sini
                    // Tampilkan notifikasi error
                    $('#notification').removeClass('alert-success').addClass('alert-danger')
                        .text('Error uploading file. Please try again.').show();
                }
            });
        });

        // Bersihkan isian file saat modal dibuka
        $('#modal-import').on('show.bs.modal', function(e) {
            $('#exampleInputEmail1').val('');
        });

        // btn upload outstanding

        $('#btn_upload_outstanding').click(function(e) {
            e.preventDefault();

            var formData = new FormData();
            formData.append('fin_month', $('#fin_month2').val());
            formData.append('fin_year', $('#fin_year2').val());
            formData.append('reminder_no', $('#reminder_no').val());
            formData.append('file', $('#file_outstanding')[0].files[0]);

            // Debug: Cetak nilai-nilai formData di konsol
            console.log("FormData Content:");
            console.log("fin_month:", formData.get('fin_month'));
            console.log("fin_year:", formData.get('fin_year'));
            console.log("reminder_no:", formData.get('reminder_no'));
            console.log("file:", formData.get('file'));

            $.ajax({
                url: '/billing/import-invoices-outstanding',
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(data) {
                    console.log(data);
                    $('#modal-import2').modal('hide');
                    // Bersihkan form setelah upload berhasil
                    $('#import_form_outstanding')[0].reset();
                    // Refresh data atau tampilkan pesan sukses di sini
                    // Tampilkan notifikasi
                    $('#notification').removeClass('alert-danger').addClass('alert-success')
                        .text(data.message).show();
                },
                error: function(xhr, textStatus, errorThrown) {
                    console.log(xhr);
                    // Handle error di sini
                    // Tampilkan notifikasi error
                    $('#notification').removeClass('alert-success').addClass('alert-danger')
                        .text('Error uploading file. Please try again.').show();
                }
            });
        });


        // Btn preview

        $('#btn_preview').click(function() {
            var tahun = $('#fin_tahun').val();
            var bulan = $('#fin_bulan').val();
            var tower = $('#tower').val();
            var tower2 = $('#tower2').val();
            var lantai = $('#lantai').val();
            var lantai2 = $('#lantai2').val();

            console.log("Tahun: " + tahun + ", Bulan: " + bulan + ", Tower:" + tower + " to " + tower2 +
                ", Lantai:" + lantai + " to " + lantai2); // Cek nilai yang dikirim
            table_blast.ajax.url("{{ route('billing.preview') }}?tahun=" + tahun + "&bulan=" + bulan +
                    "&tower=" + tower + "&tower2=" + tower2 + "&lantai=" + lantai + "&lantai2=" +
                    lantai2)
                .load();
            $('#tabel_inv_billing').hide();
            $('#tabel_inv_blast').show();

            $('#modal-proses').modal('hide'); // Tutup modal setelah submit
        });

        $('#btn_kirim').click(function() {
            var tahun = $('#fin_tahun').val();
            var bulan = $('#fin_bulan').val();
            var tower = $('#tower').val();
            var tower2 = $('#tower2').val();
            var lantai = $('#lantai').val();
            var lantai2 = $('#lantai2').val();

            console.log("Tahun: " + tahun + ", Bulan: " + bulan + ", Tower:" + tower + " to " + tower2 +
                ", Lantai:" + lantai + " to " + lantai2); // Cek nilai yang dikirim
            $.ajax({
                url: "{{ route('billing.kirim-blast-inv') }}",
                type: "GET",
                data: {
                    tahun: tahun,
                    bulan: bulan,
                    tower: tower,
                    tower2: tower2,
                    lantai: lantai,
                    lantai2: lantai2
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
    });
</script>
