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

        <!-- QR Code Section -->
        <div style="text-align: center; margin: 30px 0;">
            {{-- <p><strong>Scan QR Code untuk verifikasi online:</strong></p> --}}
            <div style="display: inline-block; border: 2px solid #333; padding: 10px;">
                @php
                    // Get QR code as base64 for PDF compatibility
                    $qrCodeBase64 = $prestasi->getQrCodeBase64();
                @endphp
                
                @if($qrCodeBase64)
                    <img src="{{ $qrCodeBase64 }}" alt="QR Code" style="width: 150px; height: 150px; display: block; margin: 0 auto;">
                @else
                    <div style="width: 150px; height: 150px; border: 2px dashed #999; display: flex; align-items: center; justify-content: center; font-size: 12px; color: #666; text-align: center; margin: 0 auto;">
                        QR Code tidak dapat dibuat<br>
                        <small>Gunakan link di bawah</small>
                    </div>
                @endif
            </div>
            <p style="font-size: 12px; color: #666; margin-top: 10px;">
                Atau kunjungi: {{ route('prestasi.public-show', $prestasi->uuid ?? $prestasi->id) }}
            </p>
        </div>

    </div>
</body>

</html>
