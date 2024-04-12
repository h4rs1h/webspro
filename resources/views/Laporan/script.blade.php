<script>
    $(document).ready(function() {
        var table =
            $('#inv_billing').DataTable({
                "processing": true,
                "serverSide": true,
                // "info": true,
                // "autoWidth": false,
                "responsive": true,
                "buttons": ["csv", "excel", "pdf", "print"],
                "ajax": "{{ route('filter.laporan') }}",
                "columns": [
                    // Sesuaikan dengan kolom tabel Anda
                    // Kolom nomor urut
                    // {
                    //     "data": null,
                    //     "name": 'index',
                    //     "render": function(data, type, row, meta) {
                    //         return meta.row + meta.settings._iDisplayStart + 1;
                    //     }
                    // },
                    {
                        "data": "Title",
                        "name": 'Title'
                    },
                    {
                        "data": "tgl_kirim",
                        "name": 'tgl_kirim'
                    },
                    {
                        "data": "fin_month",
                        "name": 'fin_month'
                    },
                    {
                        "data": "fin_year",
                        "name": 'fin_year'
                    },
                    {
                        "data": "reminder_no",
                        "name": 'reminder_no'
                    },
                    {
                        "data": "jml_rencana",
                        "name": 'jml_rencana'
                    },
                    // Kolom jml_success dengan link detail
                    {
                        "data": "jml_success",
                        "name": 'jml_success',
                        // "render": function(data, type, row) {
                        //     return '<a href="/detail/' + row.Title + '/jml_success">' + data +
                        //         '</a>';
                        // }
                    },
                    // Kolom jml_not_exists dengan link detail
                    {
                        "data": "jml_not_exists",
                        "name": 'jml_not_exists',
                        // "render": function(data, type, row) {
                        //     return '<a href="/detail/' + row.id + '/jml_not_exists">' + data +
                        //         '</a>';
                        // }
                    },
                    // Kolom jml_failed dengan link detail
                    {
                        "data": "jml_failed",
                        "name": 'jml_failed',
                        // "render": function(data, type, row) {
                        //     return '<a href="/detail/' + row.id + '/jml_failed">' + data + '</a>';
                        // }
                    },
                    // Kolom jml_offline dengan link detail
                    {
                        "data": "jml_offline",
                        "name": 'jml_offline',
                        // "render": function(data, type, row) {
                        //     return '<a href="/detail/' + row.id + '/jml_offline">' + data + '</a>';
                        // }
                    },
                    // dan seterusnya
                ],
                "drawCallback": function(settings) {
                    var api = this.api();
                    var json = api.ajax.json();

                    if (json && json.data && json.data.length > 0) {
                        $('#printBtn, #exportBtn, #pdfBtn').show(); // Tampilkan tombol-tombol aksi
                    } else {
                        $('#printBtn, #exportBtn, #pdfBtn').hide(); // Sembunyikan tombol-tombol aksi
                    }
                }
            });
        // .buttons().container().appendTo('#inv_billing_wrapper .col-md-6:eq(0)');
        // Bersihkan form
        $('#modal-filter').on('show.bs.modal', function(e) {
            $('#fin_year').val('');
            $('#fin_month').val('');
        });
        // kirim data
        $('#btn-filter').click(function() {
            var tahun = $('#fin_year').val();
            var bulan = $('#fin_month').val();
            console.log("Tahun: " + tahun + ", Bulan: " + bulan); // Cek nilai yang dikirim
            table.ajax.url("{{ route('filter.laporan') }}?tahun=" + tahun + "&bulan=" + bulan).load();
            $('#tabel_inv_billing').show();

            $('#modal-filter').modal('hide'); // Tutup modal setelah submit
        });
        $('#btn-filter-today').click(function() {
            // var tahun = $('#fin_year').val();
            // var bulan = $('#fin_month').val();
            var today = new Date(); // Mendapatkan tanggal hari ini
            var tanggal = today.getDate();
            var bulan = today.getMonth() + 1; // Ingat, bulan dimulai dari 0
            var tahun = today.getFullYear();

            console.log("Tahun: " + tahun + ", Bulan: " + bulan, ", tanggal: " +
                tanggal); // Cek nilai yang dikirim
            table.ajax.url("{{ route('filter.laporan') }}?tahun=" + tahun + "&bulan=" + bulan +
                "&tanggal=" + tanggal).load();
            $('#tabel_inv_billing').show();

            $('#modal-filter').modal('hide'); // Tutup modal setelah submit
        });
        // btn import
        // Menangani klik tombol-tombol aksi (print, export, pdf)
        $('#printBtn').click(function() {
            table.button(0).trigger();
        });

        $('#exportBtn').click(function() {
            table.button(1).trigger();
        });

        $('#pdfBtn').click(function() {
            table.button(2).trigger();

        });


    });
</script>
