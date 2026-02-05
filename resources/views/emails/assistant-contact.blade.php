<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Nouveau message depuis l'Assistant Junspro</title>
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.6; color: #333;">
    <div style="max-width: 600px; margin: 0 auto; padding: 20px;">
        <h2 style="color: #4F46E5;">Nouveau message depuis l'Assistant Junspro</h2>
        
        <div style="background: #f9fafb; padding: 15px; border-radius: 8px; margin: 20px 0;">
            <p><strong>Numéro de ticket :</strong> {{ $ticket_number }}</p>
            @if($user_id)
                <p><strong>Utilisateur connecté :</strong> {{ $user_name ?? 'ID: ' . $user_id }}</p>
            @else
                <p><strong>Visiteur non connecté</strong></p>
            @endif
            <p><strong>Email :</strong> {{ $email }}</p>
            <p><strong>Sujet :</strong> {{ $subject }}</p>
        </div>

        <div style="background: #ffffff; padding: 15px; border-left: 4px solid #4F46E5; margin: 20px 0;">
            <h3 style="margin-top: 0;">Message :</h3>
            <p style="white-space: pre-wrap;">{{ $message }}</p>
        </div>

        <p style="color: #6B7280; font-size: 14px; margin-top: 30px;">
            Ce message a été envoyé depuis le widget Assistant IA de Junspro.
        </p>
    </div>
</body>
</html>


