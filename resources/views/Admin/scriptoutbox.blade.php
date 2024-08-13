<script>
    $(document).ready(function() {
        var table =
            $('#outbox').DataTable({
                "processing": true,
                "serverSide": true,
                "autoWidth": false,
                "responsive": true,
                "ajax": "{{ route('filter.outbox') }}",
                "columns": [
                    // Sesuaikan dengan kolom tabel Anda
                    {
                        "data": 'debtor_acct',
                        "name": 'debtor_acct'
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
                        "data": 'tipe',
                        "name": 'tipe'
                    },
                    {
                        "data": 'tglkirim',
                        "name": 'tglkirim'
                    },
                    {
                        "data": 'pesan',
                        "name": 'pesan'
                    }
                    // dan seterusnya
                ]
            });
        // Fungsi untuk memuat data tabel tanpa parameter antrian
        function loadTableWithoutParam() {
            table.ajax.url("{{ route('filter.outbox') }}").load();
        }
        // Fungsi untuk memuat data tabel dengan parameter antrian=yes
        function loadTableWithParam() {
            table.ajax.url("{{ route('filter.outbox') }}?antrian=yes").load();
        }
        // Memanggil fungsi untuk memuat data tabel tanpa parameter saat halaman dimuat
        loadTableWithoutParam();

        // Event listener untuk tombol btn_data_antrian
        $('#btn_data_antrian').click(function() {
            $('#total_outbox').hide();
            $('#tabel_outbox').show();
            $('#tabel_outbox tbody').empty();
            loadTableWithParam();
        });
        $('#btn_monitor_antrian').click(function() {

            $('#tabel_outbox').hide();
            $.ajax({
                url: '/outbox/json-antrian', // Sesuaikan dengan rute Anda
                type: 'GET',
                success: function(response) {
                    // console(response.total);
                    $('#total_outbox').text('Total Outbox: ' + response.total)
                        .show();
                },
                error: function(xhr, textStatus, errorThrown) {
                    console.error('Error:', errorThrown);
                }
            });

        });
        $('#btn_proses_job').click(function() {
            $.ajax({
                url: '/api/kirimwajob',
                type: 'GET',
                success: function(response) {
                    // Tampilkan result di div notifikasi
                    $('#notification').removeClass(response.remove).addClass(response.add)
                        .text(response.message).show();
                },

            });
        });
        $('#btn_proses_job_rere').click(function() {
            $.ajax({
                url: '/api/kirimbyJobsRere',
                type: 'GET',
                success: function(response) {
                    // Tampilkan result di div notifikasi
                    $('#notification').removeClass(response.remove).addClass(response.add)
                        .text(response.message).show();
                },

            });
        });

    });
</script>
