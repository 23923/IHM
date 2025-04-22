<!DOCTYPE html>
<html lang="fr">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>School</title>
    <!-- Favicon avec asset() -->
    <link rel="icon" href="{{ asset('img/logo.png') }}">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <!-- animate CSS -->
    <link rel="stylesheet" href="{{ asset('css/animate.css') }}">
    <!-- owl carousel CSS -->
    <link rel="stylesheet" href="{{ asset('css/owl.carousel.min.css') }}">
    <!-- themify CSS -->
    <link rel="stylesheet" href="{{ asset('css/themify-icons.css') }}">
    <!-- flaticon CSS -->
    <link rel="stylesheet" href="{{ asset('css/flaticon.css') }}">
    <!-- font awesome CSS -->
    <link rel="stylesheet" href="{{ asset('css/magnific-popup.css') }}">
    <!-- swiper CSS -->
    <link rel="stylesheet" href="{{ asset('css/slick.css') }}">
    <!-- style CSS -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <style>
        @page {
            size: A4 landscape;
            margin: 0;
        }
        @media print {
            body {
                margin: 0 !important;
                padding: 0 !important;
                background: none;
            }
            .buttons-container {
                display: none !important;
            }
            .certificate-wrapper {
                border: none !important;
                box-shadow: none !important;
                margin: 0 !important;
                padding: 0 !important;
                page-break-after: avoid;
                page-break-inside: avoid;
            }
        }
        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
        }
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #f5f5f5;
            font-family: 'Montserrat', sans-serif;
        }
        .container {
            display: flex;
            flex-direction: column;
            align-items: center;
            width: 100%;
            max-width: 900px;
            padding: 20px;

        }
        .certificate-wrapper {
            width: 100%;
            padding: 40px;
            background-color: #f8f4e9;
            border: 15px double #2c3e50;
            box-shadow: 0 0 25px rgba(0,0,0,0.15);
            position: relative;
            background-image: url('https://www.transparenttextures.com/patterns/cream-paper.png');
            box-sizing: border-box;
            display: flex;
            flex-direction: column;
            justify-content: center;
            margin-bottom: 30px;
            text-align: center;
        }
        .certificate-border {
            position: absolute;
            top: 20px;
            left: 20px;
            right: 20px;
            bottom: 20px;
            border: 1px solid #c0b8a0;
            pointer-events: none;
        }
        .certificate-header {
            margin-bottom: 15px;
            position: relative;
        }
        h1 { 
            font-family: 'Playfair Display', serif;
            font-size: 32px; 
            margin: 10px 0;
            color: #2c3e50;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            font-weight: 700;
        }
        .certificate-body {
            margin: 15px 0;
            padding: 0 20px;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }
        p { 
            font-size: 16px;
            margin: 12px 0;
            line-height: 1.5;
            color: #333;
            max-width: 80%;
        }
        .recipient-name {
            font-size: 22px;
            font-weight: 600;
            color: #2c3e50;
            margin: 15px 0;
            padding: 6px 0;
            border-top: 1px solid #d1c7b7;
            border-bottom: 1px solid #d1c7b7;
            width: 100%;
            max-width: 600px;
        }
        .formation-name {
            font-style: italic;
            font-weight: 600;
            color: #2980b9;
            max-width: 80%;
        }
        .date {
            margin-top: 15px;
            font-weight: 600;
        }
        .seal {
            margin: 15px auto;
            width: 100px;
            height: 100px;
            border-radius: 50%;
            background: #e74c3c;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-family: 'Playfair Display', serif;
            font-weight: bold;
            box-shadow: 0 0 8px rgba(0,0,0,0.3);
            position: relative;
            border: 2px solid #c0392b;
        }
        .seal:before {
            content: "";
            position: absolute;
            top: 4px;
            left: 4px;
            right: 4px;
            bottom: 4px;
            border: 1px dashed white;
            border-radius: 50%;
        }
        .seal-text {
            text-align: center;
            font-size: 10px;
            padding: 6px;
            text-transform: uppercase;
            z-index: 1;
        }
        .signature-area {
            margin-top: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .signature-line {
            width: 180px;
            height: 1px;
            background: #333;
            margin: 6px auto;
        }
        .director-title {
            margin-top: 4px;
            font-size: 12px;
            color: #666;
        }
        .logo {
            max-width: 200px !important;
            max-height: 100px;
            margin-bottom: 8px;
            object-fit: contain;
        }
        .watermark {
            position: absolute;
            opacity: 0.1;
            font-size: 80px;
            color: #2c3e50;
            transform: rotate(-30deg);
            left: 50%;
            top: 50%;
            margin-left: -160px;
            margin-top: -50px;
            font-family: 'Playfair Display', serif;
            font-weight: bold;
            pointer-events: none;
            z-index: 0;
        }
        .buttons-container {
            display: flex;
            justify-content: center;
            gap: 15px;
            padding: 15px 0;
            width: 100%;
        }
        .btn {
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            font-size: 14px;
            cursor: pointer;
            transition: all 0.3s;
            text-decoration: none;
            display: inline-block;
        }
        .btn-return {
            background-color: #2c3e50;
            color: white;
        }
        .btn-download {
            background-color: #27ae60;
            color: white;
        }
        .btn:hover {
            opacity: 0.9;
            transform: translateY(-1px);
        }
        @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Montserrat:wght@300;400;600&display=swap');
    </style>
</head>
<body>
    <div class="container">
        <div class="certificate-wrapper">
            <div class="certificate-border"></div>
            <div class="watermark">Certificat</div>
            
            <div class="certificate-header">
                <img src="{{ asset('img/logo.png') }}" alt="Company Logo" class="logo">
                <h1>Certificat de Réussite</h1>
            </div>

            <div class="certificate-body">
                <p>Ce certificat atteste que</p>
                <div class="recipient-name">{{ $user->name }}</div>
                <p>a complété avec succès la formation</p>
                <p class="formation-name">"{{ $formation->titre }}"</p>
                <p class="date">le {{ now()->format('d/m/Y') }}</p>
                
                <div class="seal">
                    <div class="seal-text">
                        {{ $formation->titre }}
                    </div>
                </div>
                
                <div class="signature-area">
                    <div class="signature-line"></div>
                    <p class="director-title">Directeur des Formations</p>
                </div>
            </div>
        </div>

        <div class="buttons-container">
            <a href="/course" class="btn btn-return">Retour aux cours</a>
            <button onclick="generatePDF()" class="btn btn-download">Télécharger PDF</button>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
    <script>
        function generatePDF() {
            const element = document.querySelector('.certificate-wrapper');
            const opt = {
                margin: 0,
                filename: 'certificat_{{ $user->name }}_{{ $formation->titre }}.pdf',
                image: { type: 'jpeg', quality: 1 },
                html2canvas: { 
                    scale: 2,
                    logging: true,
                    useCORS: true,
                    allowTaint: true
                },
                jsPDF: { 
                    unit: 'mm', 
                    format: 'a4', 
                    orientation: 'landscape' 
                },
                pagebreak: { mode: 'avoid-all' }
            };

            // Cache les boutons avant la génération
            document.querySelector('.buttons-container').style.display = 'none';
            
            // Génère le PDF
            html2pdf().set(opt).from(element).save().then(() => {
                // Réaffiche les boutons après génération
                document.querySelector('.buttons-container').style.display = 'flex';
            });
        }
    </script>
</body>
</html>