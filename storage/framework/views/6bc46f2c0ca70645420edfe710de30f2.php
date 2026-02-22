<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Rendez-vous Confirmé - Junspro</title>
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.6; color: #333;">
    <div style="max-width: 600px; margin: 0 auto; padding: 20px;">
        <h2 style="color: #007bff;">Bonjour <?php echo e($mission->client_nom); ?>,</h2>
        
        <div style="background: #d4edda; padding: 20px; border-radius: 5px; margin: 20px 0; border-left: 4px solid #28a745;">
            <h3 style="margin-top: 0; color: #155724;">✓ Votre rendez-vous est confirmé !</h3>
        </div>

        <div style="background: #f8f9fa; padding: 15px; border-radius: 5px; margin: 20px 0;">
            <h3>Détails du rendez-vous :</h3>
            <?php if($mission->date_rdv): ?>
                <p><strong>Date et heure :</strong> <?php echo e($mission->date_rdv->format('d/m/Y à H:i')); ?></p>
            <?php endif; ?>
            <p><strong>ID Mission :</strong> #<?php echo e($mission->id_mission); ?></p>
        </div>

        <div style="background: #e7f3ff; padding: 15px; border-radius: 5px; margin: 20px 0; border-left: 4px solid #007bff;">
            <h3 style="margin-top: 0;">Lien de la réunion Zoom :</h3>
            <p style="text-align: center; margin: 20px 0;">
                <a href="<?php echo e($mission->zoom_link); ?>" 
                   style="background: #007bff; color: white; padding: 12px 30px; text-decoration: none; border-radius: 5px; display: inline-block;">
                    Rejoindre la réunion Zoom
                </a>
            </p>
            <p style="word-break: break-all; font-size: 12px; color: #666;">
                <?php echo e($mission->zoom_link); ?>

            </p>
            <p><small>⚠️ Les réunions Zoom gratuites sont limitées à 40 minutes maximum.</small></p>
        </div>

        <p>Nous avons hâte de vous rencontrer !</p>
        
        <p>Cordialement,<br>L'équipe Junspro</p>
    </div>
</body>
</html>


<?php /**PATH C:\Users\younes\Downloads\junspro-main (1)\junspro-main3\resources\views\emails\rdv-confirme.blade.php ENDPATH**/ ?>