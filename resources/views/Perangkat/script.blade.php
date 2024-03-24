<script>
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(function() {
            $("#daftarhp").DataTable({
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
                "ajax": '/perangkat/json',
                "columns": [{
                        "data": 'level',
                        "name": 'level'
                    },
                    {
                        "data": 'no_wa',
                        "name": 'no_wa'
                    },
                    {
                        "data": 'api_key',
                        "name": 'api_key'
                    },
                    {
                        "data": 'api_key_number',
                        "name": 'api_key_number'
                    },
                    {
                        "data": 'api_endpoin_url',
                        "name": 'api_endpoin_url'
                    },
                    {
                        "data": null,
                        "name": 'action',
                        "render": function(data, type, row) {
                            return '<button type="button" class="btn btn-info btn-xs edit" data-id="' +
                                data.id + '">Edit</button>&nbsp;';
                        }
                    },
                ]
            }).buttons().container().appendTo('#daftarhp_wrapper .col-md-6:eq(0)');

            // Event listener untuk tombol edit
            $('#daftarhp').on('click', '.edit', function() {
                var id = $(this).data('id');
                // Panggil URL '/perangkat/id' untuk mendapatkan data berdasarkan id
                $.get('/perangkat/' + id, function(data) {
                    // Mengisi nilai input form modal dengan data yang diterima dari URL
                    $('#id_perangkat').val(data.id);
                    $('#owner').val(data.level);
                    $('#no_wa').val(data.no_wa);
                    $('#api_key').val(data.api_key);
                    $('#api_key_number').val(data.api_key_number);
                    $('#endpoin').val(data.api_endpoin_url);
                    // Tampilkan modal
                    $('#editModal').modal('show');
                });
            });

            // Event listener untuk tombol hapus
            $('#daftarhp').on('click', '.delete', function() {
                var id = $(this).data('id');
                // Lakukan aksi hapus data berdasarkan id
            });

            // Ketika tombol Save changes di klik
            $('#btn-save').click(function() {
                // Mendapatkan data dari form
                var formData = new FormData();
                formData.append('id_perangkat', $('#id_perangkat').val());
                formData.append('owner', $('#owner').val());
                formData.append('no_wa', $('#no_wa').val());
                formData.append('api_key', $('#api_key').val());
                formData.append('api_key_number', $('#api_key_number').val());
                formData.append('endpoin', $('#endpoin').val());

                console.log('Form Data:', formData);

                // Mengirim data ke server menggunakan AJAX
                $.ajax({
                    type: 'POST',
                    url: '/perangkat/update', // Sesuaikan dengan URL endpoint untuk menyimpan perubahan
                    data: formData,
                    contentType: false,
                    processData: false,
                    dataType: 'json',

                    success: function(data) {
                        console.log('Success response:', data);
                        // Tutup modal dan bersihkan form
                        $('#filter_form').trigger('reset');
                        $('#editModal').modal('hide');
                        // Tampilkan pesan sukses atau lakukan aksi lainnya
                        $('#notification').removeClass(data.remove).addClass(data
                                .add)
                            .text(data.message).show();
                        $('#daftarhp').DataTable().ajax.reload();
                    },
                    error: function(xhr, status, error) {
                        // Handle error
                        console.error(xhr.responseText);
                        // Tampilkan pesan error validasi dari controller
                        $('#notification').removeClass(xhr.responseJSON.remove)
                            .addClass(xhr.responseJSON.add)
                            .text(xhr.responseJSON.message).show();
                    }
                });
            });

        });
    });
</script>
