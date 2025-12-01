<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Confirmation Accompagnement Junspro</title>
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.6; color: #333;">
    <div style="max-width: 600px; margin: 0 auto; padding: 20px;">
        <h2 style="color: #007bff;">Bonjour {{ $mission->client_nom }},</h2>
        
        <p>Merci pour votre commande d'accompagnement complet !</p>
        
        <div style="background: #f8f9fa; padding: 15px; border-radius: 5px; margin: 20px 0;">
            <h3>Détails de votre mission :</h3>
            <p><strong>ID Mission :</strong> #{{ $mission->id_mission }}</p>
            <p><strong>Budget :</strong> {{ number_format($mission->budget, 2, ',', ' ') }} €</p>
            <p><strong>Description :</strong> {{ Str::limit($mission->description_mission, 200) }}</p>
        </div>

        <div style="background: #fff3cd; padding: 15px; border-radius: 5px; margin: 20px 0; border-left: 4px solid #ffc107;">
            <h3 style="margin-top: 0;">Prochaine étape :</h3>
            <p>Veuillez choisir un créneau pour votre rendez-vous en cliquant sur le lien ci-dessous :</p>
            <p style="text-align: center; margin: 20px 0;">
                <a href="{{ $mission->calendly_link }}" 
                   style="background: #007bff; color: white; padding: 12px 30px; text-decoration: none; border-radius: 5px; display: inline-block;">
                    Réserver un créneau
                </a>
            </p>
            <p><small>Le lien Zoom vous sera envoyé automatiquement après confirmation de votre rendez-vous.</small></p>
        </div>

        <p>L'équipe Junspro vous enverra 3 freelances pré-qualifiés dans les plus brefs délais.</p>
        
        <p>Cordialement,<br>L'équipe Junspro</p>
    </div>
</body>
</html>


