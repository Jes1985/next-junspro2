<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Confirmation Mise en Relation Junspro</title>
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.6; color: #333;">
    <div style="max-width: 600px; margin: 0 auto; padding: 20px;">
        <h2 style="color: #007bff;">Bonjour {{ $mission->client_nom }},</h2>
        
        <p>Merci pour votre commande de mise en relation simple !</p>
        
        <div style="background: #f8f9fa; padding: 15px; border-radius: 5px; margin: 20px 0;">
            <h3>Détails de votre mission :</h3>
            <p><strong>ID Mission :</strong> #{{ $mission->id_mission }}</p>
            <p><strong>Budget :</strong> {{ number_format($mission->budget, 2, ',', ' ') }} €</p>
            <p><strong>Description :</strong> {{ Str::limit($mission->description_mission, 200) }}</p>
        </div>

        <p>Votre mission a été enregistrée et vous recevrez prochainement une mise en relation avec un ou plusieurs freelances correspondant à vos besoins.</p>
        
        <p>Cordialement,<br>L'équipe Junspro</p>
    </div>
</body>
</html>


