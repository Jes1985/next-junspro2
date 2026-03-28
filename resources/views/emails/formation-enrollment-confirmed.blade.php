<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Inscription confirmée — Formation Freelance Pause Souffle</title>
</head>
<body style="margin:0; padding:0; background:#0f0f0f; font-family: 'Segoe UI', Arial, sans-serif;">
  <div style="max-width:600px; margin:0 auto; background:#0f0f0f; padding:40px 20px;">

    <!-- Header -->
    <div style="text-align:center; margin-bottom:32px;">
      <div style="font-size:11px; letter-spacing:.15em; text-transform:uppercase; color:#c9a84c; margin-bottom:8px;">Junspro · Formation Certifiante</div>
      <div style="font-size:32px; margin-bottom:4px;">🏅</div>
    </div>

    <!-- Card -->
    <div style="background:linear-gradient(135deg,#1a0e00,#111); border:1.5px solid #c9a84c; border-radius:16px; padding:36px 32px; margin-bottom:24px;">

      <h1 style="font-size:22px; font-weight:800; color:#ffffff; margin:0 0 12px; line-height:1.3;">
        @if($paymentType === 'installment')
          Votre 1ère mensualité est confirmée !
        @else
          Votre inscription est confirmée !
        @endif
      </h1>

      <blockquote style="border-left:2px solid #c9a84c; padding-left:14px; margin:16px 0; font-style:italic; font-size:13px; color:rgba(201,168,76,.8); line-height:1.6;">
        « L'Éternel lui dit : Va avec la force que tu as… C'est moi qui t'envoie. »<br>— Juges 6:14
      </blockquote>

      <p style="font-size:15px; color:rgba(232,224,208,.8); line-height:1.7; margin:0 0 20px;">
        @if($paymentType === 'installment')
          Votre paiement de <strong style="color:#c9a84c;">{{ number_format($amountPaid, 0, ',', ' ') }} €</strong> (mensualité 1/3) a bien été reçu.<br>
          Votre accès à la formation <strong style="color:#fff;">Freelance Pause Souffle</strong> est maintenant <strong style="color:#22c55e;">actif</strong>.
        @else
          Votre paiement de <strong style="color:#c9a84c;">{{ number_format($amountPaid, 0, ',', ' ') }} €</strong> a bien été reçu.<br>
          Votre accès à la formation <strong style="color:#fff;">Freelance Pause Souffle</strong> est maintenant <strong style="color:#22c55e;">actif</strong>.
        @endif
      </p>

      <!-- Détails -->
      <div style="background:rgba(255,255,255,.04); border-radius:10px; padding:16px 20px; margin-bottom:24px;">
        <div style="font-size:12px; text-transform:uppercase; letter-spacing:.1em; color:rgba(232,224,208,.4); margin-bottom:12px;">Détails de votre accès</div>
        <table style="width:100%; font-size:13px; color:rgba(232,224,208,.8); border-collapse:collapse;">
          <tr>
            <td style="padding:4px 0; color:rgba(232,224,208,.5);">Réf. enrollment</td>
            <td style="padding:4px 0; text-align:right; color:#fff;">{{ str_pad($enrollment->id, 6, '0', STR_PAD_LEFT) }}</td>
          </tr>
          <tr>
            <td style="padding:4px 0; color:rgba(232,224,208,.5);">Formation</td>
            <td style="padding:4px 0; text-align:right; color:#fff;">Freelance Pause Souffle</td>
          </tr>
          <tr>
            <td style="padding:4px 0; color:rgba(232,224,208,.5);">Modules</td>
            <td style="padding:4px 0; text-align:right; color:#fff;">6 modules (accès à vie)</td>
          </tr>
          @if($paymentType === 'installment')
          <tr>
            <td style="padding:4px 0; color:rgba(232,224,208,.5);">Plan</td>
            <td style="padding:4px 0; text-align:right; color:#c9a84c;">3× 510 € / mois</td>
          </tr>
          @endif
          <tr>
            <td style="padding:4px 0; color:rgba(232,224,208,.5);">Statut</td>
            <td style="padding:4px 0; text-align:right; color:#22c55e; font-weight:700;">Actif ✓</td>
          </tr>
        </table>
      </div>

      <!-- CTA -->
      <div style="text-align:center;">
        <a href="{{ $dashboardUrl }}"
           style="display:inline-block; background:#c9a84c; color:#000; font-weight:700; font-size:14px; padding:14px 32px; border-radius:10px; text-decoration:none; letter-spacing:.03em;">
          Accéder à ma formation →
        </a>
      </div>
    </div>

    <!-- Footer -->
    <div style="text-align:center; font-size:11px; color:rgba(255,255,255,.2); line-height:1.6;">
      Junspro · Plateforme professionnelle de mise en relation<br>
      Vous recevez cet email car vous vous êtes inscrit(e) à une formation sur Junspro.
    </div>

  </div>
</body>
</html>
