<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ticket de Caisse</title>
    <style>
        body {
            font-family: Helvetica, Arial, sans-serif;
            font-size: 14px;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 100%;
            padding: 5px;
        }
        .title {
            text-align: center;
            font-size: 16px;
            font-weight: bold;
            margin-bottom: 10px;
        }
        .separator {
            border-top: 1px dashed #000;
            margin: 5px 0;
        }
        .details {
            margin-bottom: 10px;
        }
        .details th, .details td {
            text-align: left;
            padding: 2px 0;
        }
        .footer {
            text-align: center;
            margin-top: 10px;
            font-size: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="title">{{ $expense->category }}</div>

        <div class="separator"></div>

        <table class="details" width="100%">
            <tr>
                <th>Montant :</th>
                <td>{{ number_format($expense->amount, 2) }} FCFA</td>
            </tr>
            
            <tr>
                <th>Date :</th>
                <td>{{ \Carbon\Carbon::parse($expense->created_at)->format('d/m/Y') }}</td>
            </tr>
        </table>

        <div class="separator"></div>

        <div class="footer">
            <strong>Merci de votre visite !</strong>
        </div>
    </div>
</body>
</html>
