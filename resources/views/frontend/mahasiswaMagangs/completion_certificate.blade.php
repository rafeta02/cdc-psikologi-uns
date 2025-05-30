<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Internship Completion Certificate</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            line-height: 1.6;
            color: #333;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
        }
        .certificate-container {
            max-width: 800px;
            margin: 20px auto;
            padding: 40px;
            background-color: #fff;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
            border: 15px solid #013880;
            position: relative;
        }
        .certificate-header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #013880;
            padding-bottom: 20px;
        }
        .certificate-logo {
            max-width: 120px;
            margin-bottom: 20px;
        }
        h1 {
            font-size: 28px;
            color: #013880;
            margin: 10px 0;
            text-transform: uppercase;
            letter-spacing: 2px;
        }
        h2 {
            font-size: 22px;
            margin: 5px 0 20px;
            color: #555;
        }
        .certificate-body {
            text-align: center;
            margin: 30px 0;
        }
        .student-name {
            font-size: 24px;
            font-weight: bold;
            color: #013880;
            margin: 20px 0;
            text-transform: uppercase;
        }
        .certificate-text {
            font-size: 16px;
            line-height: 1.8;
            margin: 20px 0;
        }
        .certificate-footer {
            margin-top: 50px;
            text-align: right;
        }
        .signature-area {
            margin-bottom: 10px;
        }
        .signature-line {
            width: 200px;
            border-bottom: 1px solid #333;
            margin: 50px 0 10px auto;
        }
        .official-stamp {
            position: absolute;
            bottom: 70px;
            right: 100px;
            opacity: 0.5;
        }
        .timestamp {
            font-size: 14px;
            color: #666;
            margin-top: 20px;
            text-align: center;
        }
        .qr-code {
            position: absolute;
            bottom: 40px;
            left: 40px;
            width: 80px;
            height: 80px;
            background-color: #f0f0f0;
            padding: 5px;
        }
        .certificate-id {
            font-size: 12px;
            color: #777;
            position: absolute;
            top: 20px;
            right: 20px;
        }
        .verification-note {
            margin: 15px auto;
            padding: 10px;
            max-width: 80%;
            border-left: 3px solid #013880;
            font-style: italic;
            color: #555;
            background-color: #f9f9f9;
        }
        @media print {
            body {
                background: none;
            }
            .certificate-container {
                box-shadow: none;
                margin: 0;
                padding: 40px;
                border: 15px solid #013880;
            }
            .no-print {
                display: none;
            }
        }
    </style>
</head>
<body>
    <div class="certificate-container">
        <div class="certificate-id">ID: CDC-PSI-{{ $mahasiswaMagang->id }}-{{ date('Ymd') }}</div>
        
        <div class="certificate-header">
            <img src="{{ asset('img/logo.png') }}" alt="Logo" class="certificate-logo">
            <h1>Career Development Center</h1>
            <h2>Faculty of Psychology, Universitas Sebelas Maret</h2>
        </div>
        
        <div class="certificate-body">
            <h2>CERTIFICATE OF COMPLETION</h2>
            <p>This is to certify that</p>
            <p class="student-name">{{ $mahasiswaMagang->nama }}</p>
            <p>NIM: {{ $mahasiswaMagang->nim }}</p>
            <p class="certificate-text">
                has successfully completed the internship program at <strong>{{ $mahasiswaMagang->instansi }}</strong>
                for the <strong>{{ App\Models\MahasiswaMagang::TYPE_SELECT[$mahasiswaMagang->type] }}</strong> program
                in the field of <strong>{{ App\Models\MahasiswaMagang::BIDANG_SELECT[$mahasiswaMagang->bidang] }}</strong>.
                All required documents have been submitted and verified.
            </p>
            
            @if($mahasiswaMagang->verification_notes)
            <div class="verification-note">
                <p><em>"{{ $mahasiswaMagang->verification_notes }}"</em></p>
            </div>
            @endif
        </div>
        
        <div class="certificate-footer">
            <div class="signature-area">
                <div class="signature-line"></div>
                <p>
                    <strong>
                        {{ $mahasiswaMagang->verified_by->name ?? 'Head of Career Development Center' }}<br>
                        CDC Faculty of Psychology UNS
                    </strong>
                </p>
            </div>
        </div>
        
        <div class="official-stamp">
            <!-- Placeholder for official stamp -->
        </div>
        
        <div class="qr-code">
            <!-- Placeholder for QR code -->
        </div>
        
        <div class="timestamp">
            Issued on: {{ date('F j, Y') }}
        </div>
    </div>
    
    <div class="no-print" style="text-align: center; margin: 20px">
        <button onclick="window.print()" style="padding: 10px 20px; background: #013880; color: white; border: none; cursor: pointer; font-size: 16px;">
            Print Certificate
        </button>
        <a href="{{ route('frontend.mahasiswa-magangs.index') }}" style="padding: 10px 20px; background: #6c757d; color: white; text-decoration: none; margin-left: 10px; font-size: 16px;">
            Back to Dashboard
        </a>
    </div>
</body>
</html> 