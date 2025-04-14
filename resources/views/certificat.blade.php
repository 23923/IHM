<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Certificat de Réussite</title>
    <style>
        body { 
            font-family: 'DejaVu Sans', Arial, sans-serif; 
            text-align: center; 
            padding: 50px;
            background-color: #f9f9f9;
            border: 2px solid #333;
            max-width: 800px;
            margin: 30px auto;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .certificate-header {
            margin-bottom: 30px;
        }
        h1 { 
            font-size: 36px; 
            margin-bottom: 20px;
            color: #2c3e50;
        }
        .certificate-body {
            margin: 30px 0;
        }
        p { 
            font-size: 18px;
            margin: 15px 0;
            line-height: 1.6;
        }
        .signature {
            margin-top: 50px;
            border-top: 1px solid #333;
            display: inline-block;
            padding-top: 10px;
            width: 300px;
        }
        .download-btn {
            margin-top: 40px;
        }
        .logo {
            max-width: 150px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="certificate-header">
        <img src="{{ asset('images/logo.png') }}" alt="Company Logo" class="logo">
        <h1>Certificat de Réussite</h1>
    </div>

    <div class="certificate-body">
        <p>Ce certificat atteste que</p>
        <p><strong>{{ $user->name }}</strong></p>
        <p>a complété avec succès la formation</p>
        <p><strong>{{ $formation->titre }}</strong></p>
        <p>le {{ now()->format('d/m/Y') }}</p>
    </div>

    <div class="signature">
        <p>Signature</p>
        <p>_________________________</p>
    </div>

    <div class="download-btn">
            Télécharger le certificat (PDF)
        </a>
    </div>
</body>
</html>