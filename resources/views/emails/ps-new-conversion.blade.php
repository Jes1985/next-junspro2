<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Nouvelle vente — Commission en attente</title>
</head>
<body style="margin:0; padding:0; background:#070712; font-family: 'Segoe UI', Arial, sans-serif;">
<div style="max-width:620px; margin:0 auto; background:#070712; padding:48px 20px 40px;">

  <!-- Header -->
  <div style="text-align:center; margin-bottom:36px;">
    <div style="font-size:11px; letter-spacing:.22em; text-transform:uppercase; color:#C9A84C; margin-bottom:16px;">Réseau des Ambassadeurs · Pause Souffle</div>
    <div style="font-size:26px; letter-spacing:.06em; color:#fff; font-weight:200; line-height:1.3;">
      ✦ Nouvelle <span style="color:#C9A84C; font-style:italic;">vente</span>
    </div>
  </div>

  <!-- Card principale -->
  <div style="background:linear-gradient(160deg,rgba(201,168,76,0.07) 0%,#0D0D20 60%); border:1.5px solid rgba(201,168,76,0.3); border-radius:20px; padding:40px 36px; margin-bottom:24px;">

    <p style="font-size:15px; color:rgba(228,220,208,0.8); line-height:1.8; margin:0 0 24px;">
      Bonjour {{ $notifiable->name }},
    </p>

    <p style="font-size:15px; color:rgba(228,220,208,0.8); line-height:1.8; margin:0 0 24px;">
      Quelqu'un a rejoint <strong style="color:#fff;">Pause Souffle</strong> grâce à votre lien.
      Une commission vient d'être enregistrée sur votre compte.
    </p>

    <!-- Commission highlight -->
    <div style="text-align:center; background:rgba(201,168,76,0.06); border:1px solid rgba(201,168,76,0.3); border-radius:16px; padding:28px 24px; margin-bottom:28px;">
      <div style="font-size:11px; letter-spacing:.22em; text-transform:uppercase; color:rgba(201,168,76,0.7); margin-bottom:12px;">Commission enregistrée</div>
      <div style="font-size:42px; font-weight:600; color:#E8C96A; letter-spacing:-.01em; line-height:1;">+ {{ $commission }} €</div>
      <div style="font-size:13px; color:rgba(228,220,208,0.5); margin-top:8px;">{{ $product }}</div>
    </div>

    <!-- Détails de la conversion -->
    <table style="width:100%; border-collapse:collapse; margin-bottom:28px;">
      <tr>
        <td style="padding:10px 0; border-bottom:1px solid rgba(255,255,255,0.05); font-size:13px; color:rgba(228,220,208,0.45);">Statut</td>
        <td style="padding:10px 0; border-bottom:1px solid rgba(255,255,255,0.05); font-size:13px; color:#fff; text-align:right;">En attente de validation (30 jours)</td>
      </tr>
      <tr>
        <td style="padding:10px 0; border-bottom:1px solid rgba(255,255,255,0.05); font-size:13px; color:rgba(228,220,208,0.45);">Commissions en attente (total)</td>
        <td style="padding:10px 0; border-bottom:1px solid rgba(255,255,255,0.05); font-size:13px; color:#E8C96A; font-weight:600; text-align:right;">{{ $pending }} €</td>
      </tr>
      <tr>
        <td style="padding:10px 0; font-size:13px; color:rgba(228,220,208,0.45);">Votre lien</td>
        <td style="padding:10px 0; font-size:12px; color:#C9A84C; font-family:'Courier New',monospace; text-align:right; word-break:break-all;">{{ $trackingLink }}</td>
      </tr>
    </table>

    <!-- Note délai -->
    <div style="background:rgba(255,255,255,0.03); border-left:3px solid rgba(201,168,76,0.4); border-radius:0 10px 10px 0; padding:14px 18px; margin-bottom:28px;">
      <p style="font-size:13px; color:rgba(228,220,208,0.6); line-height:1.7; margin:0;">
        La commission sera <strong style="color:#fff;">validée automatiquement après 30 jours</strong> — délai anti-fraude standard.
        Vous pouvez suivre l'état en temps réel depuis votre espace ressources.
      </p>
    </div>

    <!-- CTA -->
    <div style="text-align:center;">
      <a href="{{ $ressourcesUrl }}"
         style="display:inline-block; background:linear-gradient(135deg,#b8893a 0%,#C9A84C 40%,#E8C96A 100%); color:#070712; font-weight:700; font-size:14px; padding:14px 36px; border-radius:50px; text-decoration:none; letter-spacing:.04em;">
        Voir mon tableau de bord →
      </a>
    </div>

  </div>

  <!-- Encouragement -->
  <div style="text-align:center; padding:24px 0; border-top:1px solid rgba(255,255,255,0.05);">
    <p style="font-size:13px; color:rgba(228,220,208,0.4); line-height:1.8; font-style:italic; margin:0;">
      « Chaque partage sincère est un cadeau fait à quelqu'un qui cherche. »
    </p>
    <div style="margin-top:16px; font-size:11px; letter-spacing:.15em; text-transform:uppercase; color:rgba(228,220,208,0.25);">Pause Souffle · Réseau des Ambassadeurs</div>
  </div>

</div>
</body>
</html>
