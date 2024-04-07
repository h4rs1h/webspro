<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PDF Template</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>

    <style>
        /* Gaya CSS Anda */
    </style>
</head>

<body>
    <h1>PDF Report</h1>
    {{-- <table id="pdfTable">
        <thead>
            <tr>
                <th>Tipe Pesan</th>
                <th>Tanggal Kirim</th>
                <th>Bulan</th>
                <th>Tahun</th>
                <th>Reminder</th>
                <th>Rencana Kirim</th>
                <th>Sukses</th>
                <th>Not Exists</th>
                <th>Failed</th>
                <th>Offline</th>
            </tr>
        </thead>
        <tbody>
            <!-- Data tabel akan dimasukkan di sini -->
        </tbody>
    </table> --}}
    <div class="card-body" id="tabel_inv_billing">
        <table id="inv_billing" class="table table-bordered table-hover">
            <thead>
                <tr>
                    {{-- <th>No</th> --}}
                    <th>Tipe Pesan</th>
                    <th>Tanggal Kirim</th>
                    <th>Bulan</th>
                    <th>Tahun</th>
                    <th>Reminder</th>
                    <th>Rencana Kirim</th>
                    <th>Sukses</th>
                    <th>Not Exists</th>
                    <th>Failed</th>
                    <th>Offline</th>
                </tr>
            </thead>

            <tbody>
            </tbody>
        </table>
    </div>
</body>

</html>
