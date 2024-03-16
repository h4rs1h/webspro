<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Run Script</title>
</head>

<body>
    <h1>Skrip JavaScript Berjalan</h1>
    <!-- jQuery -->
    <script src="{{ asset('AdminLTE/plugins/jquery/jquery.min.js') }}"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="{{ asset('AdminLTE/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            // Fungsi untuk memanggil API
            function callAPI() {
                $.ajax({
                    url: '/api/kirimsp', // Sesuaikan dengan URL API Anda
                    type: 'GET',
                    success: function(response) {
                        console.log(response);
                        // Anda bisa melakukan sesuatu dengan response di sini
                    },
                    error: function(error) {
                        console.error("Error calling API", error);
                    }
                });
            }

            // Menjadwalkan pemanggilan API setiap 5 detik
            setInterval(callAPI, 5000);
        });
    </script>

</body>

</html>
