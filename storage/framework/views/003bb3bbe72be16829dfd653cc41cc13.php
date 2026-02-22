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
            <p><strong>Numéro de ticket :</strong> <?php echo e($ticket_number); ?></p>
            <?php if($user_id): ?>
                <p><strong>Utilisateur connecté :</strong> <?php echo e($user_name ?? 'ID: ' . $user_id); ?></p>
            <?php else: ?>
                <p><strong>Visiteur non connecté</strong></p>
            <?php endif; ?>
            <p><strong>Email :</strong> <?php echo e($email); ?></p>
            <p><strong>Sujet :</strong> <?php echo e($subject); ?></p>
        </div>

        <div style="background: #ffffff; padding: 15px; border-left: 4px solid #4F46E5; margin: 20px 0;">
            <h3 style="margin-top: 0;">Message :</h3>
            <p style="white-space: pre-wrap;"><?php echo e($message); ?></p>
        </div>

        <p style="color: #6B7280; font-size: 14px; margin-top: 30px;">
            Ce message a été envoyé depuis le widget Assistant IA de Junspro.
        </p>
    </div>
</body>
</html>


<?php /**PATH C:\Users\younes\Downloads\junspro-main (1)\junspro-main3\resources\views\emails\assistant-contact.blade.php ENDPATH**/ ?>