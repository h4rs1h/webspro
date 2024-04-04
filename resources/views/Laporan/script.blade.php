<script>
    $(document).ready(function() {
        var table =
            $('#inv_billing').DataTable({
                "processing": true,
                "serverSide": true,
                // "info": true,
                // "autoWidth": false,
                // "responsive": true,
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
                    {
                        "data": "jml_success",
                        "name": 'jml_success'
                    },
                    {
                        "data": "jml_not_exists",
                        "name": 'jml_not_exists'
                    },
                    {
                        "data": "jml_failed",
                        "name": 'jml_failed'
                    },
                    {
                        "data": "jml_offline",
                        "name": 'jml_offline'
                    },
                    // dan seterusnya
                ],
                // "rowCallback": function(row, data, index) {
                //     // Mengatur nomor urut (index) pada kolom pertama
                //     $('td:eq(0)', row).html(index + 1);
                // }
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
        // btn import
    });
</script>
