<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Bonus Bien-être Junspro</title>
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.6; color: #333;">
    <div style="max-width: 600px; margin: 0 auto; padding: 20px;">
        <h2 style="color: #28a745;">Félicitations <?php echo e($mission->client_nom); ?> !</h2>
        
        <div style="background: #d4edda; padding: 20px; border-radius: 5px; margin: 20px 0; border-left: 4px solid #28a745;">
            <h3 style="margin-top: 0; color: #155724;">Votre projet vous donne droit à un bonus bien-être :</h3>
            <p style="font-size: 24px; font-weight: bold; color: #155724;">
                🎁 Bonus <?php echo e($bonusLabel); ?>

            </p>
        </div>

        <p>En raison du montant de votre projet (<?php echo e(number_format($mission->budget, 2, ',', ' ')); ?> €), vous bénéficiez automatiquement d'une séance de bien-être offerte !</p>

        <div style="background: #fff3cd; padding: 15px; border-radius: 5px; margin: 20px 0; border-left: 4px solid #ffc107;">
            <h3 style="margin-top: 0;">Réservez votre séance :</h3>
            <p style="text-align: center; margin: 20px 0;">
                <a href="<?php echo e($mission->calendly_link); ?>" 
                   style="background: #28a745; color: white; padding: 12px 30px; text-decoration: none; border-radius: 5px; display: inline-block;">
                    Cliquez ici pour réserver votre séance
                </a>
            </p>
            <p><small>Le lien Zoom vous sera envoyé après confirmation de votre rendez-vous.</small></p>
        </div>
        
        <p>Cordialement,<br>L'équipe Junspro</p>
    </div>
</body>
</html>


<?php /**PATH C:\Users\younes\Downloads\junspro-main (1)\junspro-main3\resources\views\emails\bonus-bien-etre.blade.php ENDPATH**/ ?>