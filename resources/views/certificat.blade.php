<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Certificat de Réussite</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Montserrat:wght@300;400;600&display=swap');
        
        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
            overflow: hidden;
        }
        
        body { 
            font-family: 'Montserrat', sans-serif;
            text-align: center; 
            padding: 40px;
            background-color: #f8f4e9;
            border: 15px double #2c3e50;
            margin: 0 auto;
            box-shadow: 0 0 25px rgba(0,0,0,0.15);
            position: relative;
            background-image: url('https://www.transparenttextures.com/patterns/cream-paper.png');
            height: calc(100vh - 80px);
            box-sizing: border-box;
            display: flex;
            flex-direction: column;
            justify-content: center;
            max-width: 900px;
            margin-bottom: 10px;

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
        }
        
        p { 
            font-size: 16px;
            margin: 12px 0;
            line-height: 1.5;
            color: #333;
        }
        
        .recipient-name {
            font-size: 22px;
            font-weight: 600;
            color: #2c3e50;
            margin: 15px 0;
            padding: 6px 0;
            border-top: 1px solid #d1c7b7;
            border-bottom: 1px solid #d1c7b7;
        }
        
        .formation-name {
            font-style: italic;
            font-weight: 600;
            color: #2980b9;
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
            margin-top: 15px;
            padding-bottom: 15px;
        }
        
        .btn {
            padding: 8px 16px;
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
    </style>
</head>
<body>
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
    </div>

    <div class="seal">
        <div class="seal-text">
            Cachet Officiel<br>
            {{ config('app.name') }}
        </div>
    </div>
    
    <div class="signature-area">
        <div class="signature-line"></div>
        <p class="director-title">Directeur des Formations</p>
    </div>
    </div>

    <div class="buttons-container">
        <a href="/course" class="btn btn-return">Retour aux cours</a>
        <button onclick="generatePDF()" class="btn btn-download">Télécharger PDF</button>
    </div>

    <script>
        function generatePDF() {
            // Cache les boutons avant la génération du PDF
            document.querySelector('.buttons-container').style.display = 'none';
            
            // Utilisation de html2pdf.js pour générer le PDF
            const element = document.body;
            const opt = {
                margin: 10,
                filename: 'certificat_{{ $user->name }}_{{ $formation->titre }}.pdf',
                image: { type: 'jpeg', quality: 0.98 },
                html2canvas: { scale: 2 },
                jsPDF: { unit: 'mm', format: 'a4', orientation: 'landscape' }
            };

            // Charge la librairie html2pdf.js si elle n'est pas déjà chargée
            if (typeof html2pdf !== 'undefined') {
                html2pdf().from(element).set(opt).save();
            } else {
                const script = document.createElement('script');
                script.src = 'https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js';
                script.onload = function() {
                    html2pdf().from(element).set(opt).save();
                };
                document.head.appendChild(script);
            }
            
            // Réaffiche les boutons après un court délai
            setTimeout(() => {
                document.querySelector('.buttons-container').style.display = 'flex';
            }, 1000);
        }
    </script>
</body>
</html>