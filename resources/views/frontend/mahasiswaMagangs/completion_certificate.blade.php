<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Certificate of Appreciation</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Merriweather:wght@300;400;700&display=swap');
        
        body {
            font-family: 'Merriweather', serif;
            margin: 0;
            padding: 0;
            background: #f0f0f0;
        }
        
        .certificate-container {
            width: 1123px;
            height: 794px;
            margin: 20px auto;
            position: relative;
            background-image: url('{{ asset('img/certificate.png') }}');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            box-shadow: 0 10px 30px rgba(0,0,0,0.3);
            overflow: hidden;
        }
        
        .certificate-overlay {
            position: absolute;
            top: 42%;
            left: 50%;
            transform: translate(-50%, -50%);
            text-align: center;
            z-index: 10;
        }
        
        .student-name {
            font-family: 'Playfair Display', serif;
            font-size: 42px;
            font-weight: 700;
            color: #1a365d;
            margin: 45px 0 5px 0;
            text-transform: uppercase;
            letter-spacing: 3px;
            text-shadow: 2px 2px 4px rgba(255,255,255,0.9);
            width: 600px;
        }
        
        .student-details {
            font-size: 14px;
            color: #2d3748;
            margin: 5px 0;
            font-weight: 500;
            text-shadow: 1px 1px 3px rgba(255,255,255,0.9);
            letter-spacing: 1px;
        }
        
        .certificate-id {
            position: absolute;
            top: 30px;
            right: 50px;
            font-size: 12px;
            color: #666;
            font-weight: 400;
            background: rgba(255,255,255,0.8);
            padding: 5px 10px;
            border-radius: 3px;
        }
        
        .qr-code-section {
            position: absolute;
            bottom: 50px;
            left: 50px;
            text-align: center;
            background: rgba(255,255,255,0.9);
            padding: 10px;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }
        
        .qr-code-section p {
            margin: 0 0 5px 0;
            font-size: 10px;
            color: #666;
            font-weight: 500;
        }
        
        @media print {
            body {
                background: none;
            }
            .certificate-container {
                box-shadow: none;
                margin: 0;
                width: 100%;
                height: 100vh;
            }
            .no-print {
                display: none;
            }
        }
    </style>
</head>
<body>
    <div class="certificate-container">
        <!-- Certificate ID -->
        <div class="certificate-id">ID: CDC-PSI-{{ $mahasiswaMagang->id }}-{{ date('Ymd') }}</div>
        
        <!-- Text overlay positioned in center -->
        <div class="certificate-overlay">
            <div class="student-name">{{ $mahasiswaMagang->nama }}</div>
            <div class="student-details">NIM: {{ $mahasiswaMagang->nim }}</div>
        </div>
        
        <!-- QR Code for verification -->
        {{-- <div class="qr-code-section">
            @php
                $verificationUrl = route('certificates.verify', $mahasiswaMagang->id);
                $qrCode = null;
                try {
                    $qrCode = base64_encode(\QrCode::format('png')->size(80)->generate($verificationUrl));
                } catch (\Exception $e) {
                    // QR generation failed, will show text fallback
                    $qrCode = null;
                }
            @endphp
            
            @if($qrCode)
                <p>Scan to verify</p>
                <img src="data:image/png;base64,{{ $qrCode }}" alt="QR Code" style="width: 80px; height: 80px;">
            @else
                <p style="font-size: 9px; line-height: 1.2; margin: 0;">Verify at:</p>
                <p style="font-size: 8px; line-height: 1.1; margin: 0; word-break: break-all;">{{ $verificationUrl }}</p>
            @endif
        </div> --}}
    </div>
    
    <div class="no-print" style="text-align: center; margin: 20px">
        <button onclick="window.print()" style="padding: 12px 24px; background: linear-gradient(135deg, #1e3a5f, #2d5aa0); color: white; border: none; cursor: pointer; font-size: 16px; border-radius: 8px; font-weight: 600; margin-right: 10px;">
            🖨️ Print Certificate
        </button>
        <a href="{{ route('frontend.mahasiswa-magangs.index') }}" style="padding: 12px 24px; background: #6c757d; color: white; text-decoration: none; font-size: 16px; border-radius: 8px; font-weight: 600;">
            ↩️ Back to Dashboard
        </a>
    </div>
</body>
</html> 