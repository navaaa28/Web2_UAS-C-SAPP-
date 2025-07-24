<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Sertifikat - Certificate Title</title>
    <style>
        @page {
            margin: 0;
            size: landscape;
        }
        
        @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Cormorant+Garamond:wght@400;600&family=Open+Sans:wght@300;400;600&display=swap');
        
        body {
            font-family: 'Open Sans', sans-serif;
            margin: 0;
            padding: 0;
            background: #fff;
            width: 100%;
            height: 100%;
        }
        
        .certificate {
            width: 277mm;
            height: 190mm;
            margin: 0;
            background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%);
            position: relative;
            overflow: hidden;
            box-sizing: border-box;
        }
        
        /* Decorative border */
        .border-outer {
            position: absolute;
            top: 10mm;
            left: 10mm;
            right: 10mm;
            bottom: 10mm;
            border: 2px solid #2c3e50;
            z-index: 1;
        }
        
        .border-inner {
            position: absolute;
            top: 15mm;
            left: 15mm;
            right: 15mm;
            bottom: 15mm;
            border: 1px solid #bdc3c7;
            z-index: 1;
        }
        
        /* Decorative corners */
        .corner-decoration {
            position: absolute;
            width: 40px;
            height: 40px;
            z-index: 2;
        }
        
        .corner-decoration::before {
            content: '';
            position: absolute;
            width: 30px;
            height: 30px;
            top: 5px;
            left: 5px;
            border: 2px solid #d4af37;
            border-radius: 3px;
        }
        
        .corner-decoration::after {
            content: '';
            position: absolute;
            width: 16px;
            height: 16px;
            top: 12px;
            left: 12px;
            border: 1px solid #d4af37;
            border-radius: 50%;
        }
        
        .corner-top-left {
            top: 18mm;
            left: 18mm;
        }
        
        .corner-top-right {
            top: 18mm;
            right: 18mm;
        }
        
        .corner-bottom-left {
            bottom: 18mm;
            left: 18mm;
        }
        
        .corner-bottom-right {
            bottom: 18mm;
            right: 18mm;
        }
        
        .corner-top-left::before {
            border-right: none;
            border-bottom: none;
        }
        
        .corner-top-right::before {
            border-left: none;
            border-bottom: none;
        }
        
        .corner-bottom-left::before {
            border-right: none;
            border-top: none;
        }
        
        .corner-bottom-right::before {
            border-left: none;
            border-top: none;
        }
        
        .content {
            position: relative;
            z-index: 3;
            padding: 20mm 25mm 15mm 25mm;
            text-align: center;
            height: calc(100% - 35mm);
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            box-sizing: border-box;
        }
        
        .header {
            margin-bottom: 15px;
        }
        
        .logo-section {
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 12px;
        }
        
        .logo {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, #2c3e50 0%, #34495e 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-size: 24px;
            font-weight: bold;
            margin-right: 15px;
            border: 2px solid #d4af37;
            overflow: hidden;
            position: relative;
        }
        
        .logo img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: center;
            border-radius: 50%;
        }
        
        .logo-text {
            position: absolute;
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #2c3e50 0%, #34495e 100%);
            border-radius: 50%;
        }
        
        .organization {
            text-align: left;
        }
        
        .org-name {
            font-family: 'Cormorant Garamond', serif;
            font-size: 20px;
            font-weight: 600;
            color: #2c3e50;
            margin: 0;
        }
        
        .org-subtitle {
            font-size: 12px;
            color: #7f8c8d;
            margin: 2px 0 0 0;
        }
        
        .certificate-title {
            font-family: 'Playfair Display', serif;
            font-size: 40px;
            font-weight: 700;
            color: #2c3e50;
            margin: 15px 0;
            text-transform: uppercase;
            letter-spacing: 4px;
            position: relative;
        }
        
        .certificate-title::after {
            content: '';
            position: absolute;
            bottom: -8px;
            left: 50%;
            transform: translateX(-50%);
            width: 100px;
            height: 2px;
            background: linear-gradient(90deg, transparent, #d4af37, transparent);
        }
        
        .presented-to {
            font-size: 14px;
            color: #5d6d7e;
            margin-bottom: 6px;
            font-style: italic;
        }
        
        .recipient-name {
            font-family: 'Cormorant Garamond', serif;
            font-size: 32px;
            font-weight: 600;
            color: #2c3e50;
            margin: 8px 0 15px 0;
            position: relative;
            display: inline-block;
        }
        
        .recipient-name::after {
            content: '';
            position: absolute;
            bottom: -6px;
            left: 0;
            right: 0;
            height: 2px;
            background: linear-gradient(90deg, transparent, #d4af37, transparent);
        }
        
        .achievement-text {
            font-size: 14px;
            color: #5d6d7e;
            line-height: 1.5;
            margin-bottom: 10px;
            max-width: 500px;
            margin-left: auto;
            margin-right: auto;
        }
        
        .module-title {
            font-family: 'Cormorant Garamond', serif;
            font-size: 22px;
            font-weight: 600;
            color: #2c3e50;
            margin: 10px 0;
        }
        
        .score-section {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            border: 1px solid #d4af37;
            border-radius: 6px;
            padding: 10px;
            margin: 12px auto;
            max-width: 250px;
        }
        
        .score-text {
            font-size: 14px;
            color: #5d6d7e;
            margin-bottom: 3px;
        }
        
        .score-value {
            font-size: 20px;
            font-weight: 600;
            color: #2c3e50;
        }
        
        .details-section {
            display: flex;
            justify-content: space-between;
            margin: 15px auto 0;
            max-width: 400px;
            text-align: left;
        }
        
        .detail-group {
            flex: 1;
        }
        
        .detail-item {
            margin-bottom: 8px;
        }
        
        .detail-label {
            font-size: 12px;
            font-weight: 600;
            color: #2c3e50;
            margin-bottom: 2px;
        }
        
        .detail-value {
            font-size: 14px;
            color: #5d6d7e;
        }
        
        .signature-section {
            position: absolute;
            bottom: 20mm;
            right: 30mm;
            text-align: center;
        }
        
        .signature-line {
            width: 150px;
            border-top: 2px solid #2c3e50;
            margin: 0 auto 6px;
        }
        
        .signature-name {
            font-family: 'Cormorant Garamond', serif;
            font-size: 16px;
            font-weight: 600;
            color: #2c3e50;
            margin-bottom: 2px;
        }
        
        .signature-title {
            font-size: 11px;
            color: #7f8c8d;
        }
        
        .signature-image {
            width: 120px;
            height: auto;
            display: block;
            margin: 0 auto 8px auto;
        }
        
        .watermark {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%) rotate(-45deg);
            font-size: 80px;
            color: rgba(212, 175, 55, 0.05);
            font-weight: bold;
            z-index: 1;
            pointer-events: none;
        }
        
        .seal {
            position: absolute;
            bottom: 20mm;
            left: 30mm;
            width: 60px;
            height: 60px;
            border: 2px solid #d4af37;
            border-radius: 50%;
            background: radial-gradient(circle, #fff 0%, #f8f9fa 100%);
            z-index: 3;
            overflow: hidden;
        }
        .seal-image {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            z-index: 3;
        }
        .seal-text {
            position: relative;
            z-index: 4;
            font-size: 8px;
            color: #2c3e50;
            font-weight: 600;
            text-align: center;
            line-height: 1.1;
            background: none;
            margin-top: 38px;
        }
    </style>
</head>
<body>
    <div class="certificate">
        <div class="border-outer"></div>
        <div class="border-inner"></div>
        
        <div class="corner-decoration corner-top-left"></div>
        <div class="corner-decoration corner-top-right"></div>
        <div class="corner-decoration corner-bottom-left"></div>
        <div class="corner-decoration corner-bottom-right"></div>
        
        <div class="watermark">CERTIFIED</div>
        
        <div class="content">
            <div class="header">
                <div class="logo-section">
                <div class="logo">
                        <img src="{{ public_path('storage/images/LOGO.png') }}" alt="Logo">
                        </div>
                    <div class="organization">
                        <div class="org-name">C-SAPP Learning Platform</div>
                        <div class="org-subtitle">Excellence in Digital Education</div>
                    </div>
                </div>
            </div>
            
            <div class="main-content">
                <div class="certificate-title">Sertifikat</div>
                
                <div class="presented-to">Dengan hormat diberikan kepada:</div>
                
                <div class="recipient-name">{{ $certificate->user->name ?? 'Nama Peserta' }}</div>
                
                <div class="achievement-text">
                    Yang telah berhasil menyelesaikan program pembelajaran dan memenuhi 
                    seluruh persyaratan yang ditetapkan untuk modul:
                </div>
                
                <div class="module-title">{{ $certificate->title ?? 'Judul Modul Pembelajaran' }}</div>
                
                <div class="score-section">
                    <div class="score-text">Skor Akhir</div>
                    <div class="score-value">{{ isset($certificate->score) ? number_format($certificate->score, 2) : '95.00' }}%</div>
                </div>
                
                <div class="details-section">
                    <div class="detail-group">
                        <div class="detail-item">
                            <div class="detail-label">Nomor Sertifikat</div>
                            <div class="detail-value">{{ $certificate->certificate_number ?? 'CERT-2024-001' }}</div>
                        </div>
                    </div>
                    <div class="detail-group">
                        <div class="detail-item">
                            <div class="detail-label">Tanggal Terbit</div>
                            <div class="detail-value">{{ isset($certificate->issued_at) ? $certificate->issued_at->locale('id')->isoFormat('D MMMM Y') : '15 Januari 2024' }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="seal">
            <img src="{{ public_path('storage/images/cap.png') }}" alt="Cap" class="seal-image">
            <div class="seal-text">OFFICIAL<br>SEAL</div>
        </div>
        
        <div class="signature-section">
            <img src="{{ public_path('storage/images/signature.png') }}" alt="Tanda Tangan" class="signature-image">
            <div class="signature-line"></div>
            <div class="signature-name">Administrator</div>
            <div class="signature-title">C-SAPP Learning Platform</div>
        </div>
    </div>
</body>
</html>