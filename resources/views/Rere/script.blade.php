<script>
    $(document).ready(function() {

        var table =
            $('#sum_rere').DataTable({
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
                        "data": "tanggal",
                        "name": 'tanggal'
                    },
                    {
                        "data": "title",
                        "name": 'title'
                    },
                    {
                        "data": "rencana",
                        "name": 'rencana'
                    },
                    {
                        "data": "sukses",
                        "name": 'sukses'
                    },
                    {
                        "data": "not_exists",
                        "name": 'not_exists'
                    },
                    {
                        "data": "failed",
                        "name": 'failed'
                    },
                    {
                        "data": "offline",
                        "name": 'offline'
                    },

                ]
            });
        var table_blast =
            $('#sum_rere_blast').DataTable({
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

        $('#btn_preview').click(function() {
            var title = $('#title').val();
            var tgl_pesan = $('#tgl_pesan').val();
            var jam_pesan = $('#jam_pesan').val();
            var isi_pesan = $('#isi_pesan').val();
            var tower = $('#tower').val();
            var tower2 = $('#tower2').val();
            var lantai = $('#lantai').val();
            var lantai2 = $('#lantai2').val();

            // Buat objek FormData dan tambahkan data
            var formData = new FormData();
            formData.append('title', title);
            formData.append('tgl_pesan', tgl_pesan);
            formData.append('jam_pesan', jam_pesan);
            formData.append('isi_pesan', isi_pesan);
            formData.append('tower', tower);
            formData.append('tower2', tower2);
            formData.append('lantai', lantai);
            formData.append('lantai2', lantai2);

            // Debug: Cetak nilai-nilai formData di konsol
            console.log("FormData Content: , title: " + title + ", tgl_pesan: " + tgl_pesan +
                ", jam_pesan: " + jam_pesan + ", isi_pesan: " + isi_pesan + ", tower: " + tower +
                " dan " + tower2 +
                ", lantai: " + lantai + " sampai " + lantai2);

            $.ajax({
                url: "{{ route('rere.getpreview') }}",
                type: "POST",
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

                        console.log("FormData Content: , title: " + title +
                            ", tgl_pesan: " + tgl_pesan +
                            ", jam_pesan: " + jam_pesan + ", isi_pesan: " + isi_pesan +
                            ", tower: " + tower +
                            " dan " + tower2 +
                            ", lantai: " + lantai + " sampai " + lantai2);
                        // table_blast.ajax.url("{{ route('billing.preview') }}?fin_tahun=" +
                        //         tahun + "&fin_bulan=" + bulan +
                        //         "&tower=" + tower + "&tower2=" + tower2 + "&lantai=" +
                        //         lantai + "&lantai2=" +
                        //         lantai2 + "&reminder_no=" + reminder_no)
                        //     .load();

                        $('#sum_rere').hide();
                        $('#sum_rere_blast').show();
                        // $('#modal-proses').modal('hide'); // Tutup modal setelah submit
                    }
                },
            });
        });
    });
</script>
