<!DOCTYPE html>
<head>
    <title>Bukti Upload Prestasi</title>
    <meta charset="utf-8">
    <style>
        #judul{
            text-align:center;
        }

        #halaman{
            width: auto;
            height: auto;
            position: absolute;
            border: 1px solid;
            padding-top: 30px;
            padding-left: 30px;
            padding-right: 30px;
            padding-bottom: 80px;
        }

    </style>

</head>

<body>
    <div id=halaman>
        <h3 id=judul>Bukti Upload Prestasi</h3>

        <p>Berikut ini adalah bukti upload prestasi mahasiswa pada kegiatan lomba "{{ $prestasi->nama_kegiatan }}", dengan peserta sebagai berikut:</p>
        <table>
            @foreach ($prestasi->pesertas as $peserta)
                <tr>
                    <td style="width: 30%;">Peserta {{ $loop->iteration }}</td>
                    <td style="width: 5%;">:</td>
                    <td style="width: 65%;">{{ $peserta->nama }} (<i>{{ $peserta->nim }}</i>)</td>
                </tr>
            @endforeach
        </table>

        <p>Terima kasih sudah mengupload dan mengisi form prestasi mahasiswa, atas perhatiannya kami ucapkan terima kasih.</p>

        <table style="width: 100%;">
            <tbody>
                <tr>
                    <td style="width: 50%;" align="center">
                        <div class="text-center">
                            <span></span><br>
                            <span></span><br>
                            <span>Pemohon</span><br>
                            <br><br><br><br>
                            <span><u></u></span><br>
                            <span>NIM. </span>
                        </div>
                    </td>
                    <td style="width: 50%;" align="center">
                        <div class="text-center">
                            <span>Surakarta, {{ \Carbon\Carbon::parse(now())->format('d F Y')}}</span><br>
                            <span>Mengetahui</span><br>
                            <span>Dekan Fakultas Psikologi</span><br>
                            <br><br><br><br>
                            <span><u>(NAMA)</u></span><br>
                            <span>NIP. </span>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>

    </div>
</body>

</html>
