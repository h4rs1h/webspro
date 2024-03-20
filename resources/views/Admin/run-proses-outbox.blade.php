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
            // Inisialisasi jumlah pemanggilan yang telah dilakukan
            var callCount = 0;

            // Fungsi untuk memanggil API
            function callAPI() {
                // Cek apakah jumlah pemanggilan telah mencapai batas maksimal (3)
                if (callCount < 1100) {
                    $.ajax({
                        url: '/api/kirimsp', // Sesuaikan dengan URL API Anda
                        type: 'GET',
                        success: function(response) {
                            console.log(response);
                            // Anda bisa melakukan sesuatu dengan response di sini
                            callCount++; // Tambahkan jumlah pemanggilan setelah berhasil
                        },
                        error: function(error) {
                            console.error("Error calling API", error);
                        }
                    });
                } else {
                    // Jika jumlah pemanggilan telah mencapai batas maksimal, hentikan pemanggilan
                    clearInterval(intervalID);
                }
            }

            // Menjadwalkan pemanggilan API setiap 15 detik
            var intervalID = setInterval(callAPI, 15000); // 15 detik = 15,000 milidetik
        });
    </script>

</body>

</html>
