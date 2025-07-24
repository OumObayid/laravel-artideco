<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Nouvelle commande reçue</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #f4f0eb;
            color: #333;
            padding: 40px;
        }

        .container {
            max-width: 600px;
            background-color: #fff;
            margin: auto;
            border-radius: 12px;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
            overflow: hidden;
        }

        .header {
            background-color: #b89d74;
            color: #fff;
            padding: 25px 30px;
            text-align: center;
        }

        .content {
            padding: 30px;
        }

        h2 {
            margin-top: 0;
            font-size: 24px;
            border-bottom: 1px solid #eee;
            padding-bottom: 10px;
            color: #333;
        }

        p {
            font-size: 16px;
            margin: 10px 0;
        }

        strong {
            color: #555;
        }

        .footer {
            background-color: #f8f4f0;
            text-align: center;
            padding: 15px;
            font-size: 13px;
            color: #888;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1> Nouvelle commande reçue</h1>
        </div>
        <div class="content">
            <h2>Détails de la commande</h2>

            <p><strong>Produit :</strong> {{ $product->name }}</p>
            <p><strong>Prix :</strong> {{ number_format($product->price, 2, ',', ' ') }} DH</p>

            <h2>Informations du client</h2>
            <p><strong>Nom :</strong> {{ $order->name }}</p>
            <p><strong>Téléphone :</strong> {{ $order->phone }}</p>
            <p><strong>Ville :</strong> {{ $order->city }}</p>
            <p><strong>Adresse :</strong><br>{{ $order->address }}</p>
        </div>
        <div class="footer">
            L’Atelier Déco • Merci de consulter régulièrement vos commandes
        </div>
    </div>
</body>
</html>
