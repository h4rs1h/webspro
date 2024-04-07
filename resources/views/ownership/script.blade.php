<script>
    $(document).ready(function() {
        $(function() {
            $("#example3").DataTable({
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
                "ajax": '/ownership/getdata/json',
                "columns": [{
                        "data": 'owner_acct',
                        "name": 'owner_acct'
                    },
                    // {
                    //     "data": 'owner_acct',
                    //     "name": 'owner_acct'
                    // },
                    {
                        "data": 'name',
                        "name": 'name'
                    },
                    {
                        "data": 'hand_phone',
                        "name": 'hand_phone'
                    },
                    {
                        "data": 'hand_phone',
                        "name": 'hand_phone'
                    },
                ]
            }).buttons().container().appendTo('#example3_wrapper .col-md-6:eq(0)');
        });

    });
</script>
