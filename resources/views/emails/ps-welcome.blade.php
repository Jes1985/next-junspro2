<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Bienvenue dans le Réseau des Ambassadeurs Pause Souffle</title>
</head>
<body style="margin:0; padding:0; background:#070712; font-family: 'Segoe UI', Arial, sans-serif;">
<div style="max-width:620px; margin:0 auto; background:#070712; padding:48px 20px 40px;">

  <!-- Header -->
  <div style="text-align:center; margin-bottom:36px;">
    <div style="font-size:11px; letter-spacing:.22em; text-transform:uppercase; color:#C9A84C; margin-bottom:16px;">Réseau des Ambassadeurs · Pause Souffle</div>
    <div style="font-size:28px; letter-spacing:.08em; color:#fff; font-weight:200; line-height:1.3;">
      Transmettre ce qui <span style="color:#C9A84C; font-style:italic;">transforme.</span>
    </div>
  </div>

  <!-- Card principale -->
  <div style="background:linear-gradient(160deg,rgba(201,168,76,0.07) 0%,#0D0D20 60%); border:1.5px solid rgba(201,168,76,0.3); border-radius:20px; padding:40px 36px; margin-bottom:24px;">

    <p style="font-size:15px; color:rgba(228,220,208,0.8); line-height:1.8; margin:0 0 24px;">
      Bonjour {{ $firstName }},
    </p>

    <p style="font-size:15px; color:rgba(228,220,208,0.8); line-height:1.8; margin:0 0 24px;">
      Vous faites maintenant partie du <strong style="color:#fff;">Réseau des Ambassadeurs Pause Souffle</strong>.<br>
      Votre lien personnel est actif. Chaque personne qui le suit et rejoint Pause Souffle vous attribuera automatiquement une commission — pendant 90 jours.
    </p>

    <!-- Lien perso -->
    <div style="background:rgba(201,168,76,0.06); border:1px solid rgba(201,168,76,0.25); border-radius:12px; padding:18px 22px; margin-bottom:28px;">
      <div style="font-size:10px; letter-spacing:.2em; text-transform:uppercase; color:rgba(201,168,76,0.7); margin-bottom:8px;">Votre lien ambassadeur</div>
      <div style="font-size:16px; font-family:'Courier New', monospace; color:#E8C96A; word-break:break-all;">{{ $trackingLink }}</div>
    </div>

    <!-- Mission #1 -->
    <div style="background:rgba(255,255,255,0.03); border-left:3px solid #C9A84C; border-radius:0 12px 12px 0; padding:20px 22px; margin-bottom:28px;">
      <div style="font-size:10px; letter-spacing:.2em; text-transform:uppercase; color:#C9A84C; margin-bottom:10px;">✦ Votre première mission</div>
      <p style="font-size:14px; color:rgba(228,220,208,0.85); line-height:1.8; margin:0 0 12px;">
        Pas vendre. Juste <strong style="color:#fff;">partager.</strong><br>
        Pensez à <strong style="color:#fff;">3 personnes</strong> dans votre entourage à qui le Parcours Pause Souffle pourrait apporter quelque chose.
        Envoyez-leur ce message simple :
      </p>
      <div style="background:rgba(201,168,76,0.06); border-radius:8px; padding:14px 16px;">
        <p style="font-size:13px; color:rgba(228,220,208,0.8); line-height:1.7; font-style:italic; margin:0;">
          « J'ai découvert quelque chose qui m'a vraiment aidé à retrouver de la clarté et de la présence dans ma vie. Ça s'appelle Pause Souffle. Si ça te parle, voici le lien pour en savoir plus : <span style="color:#E8C96A;">{{ $trackingLink }}</span> »
        </p>
      </div>
    </div>

    <!-- Ce que vous recevez -->
    <div style="margin-bottom:28px;">
      <div style="font-size:10px; letter-spacing:.2em; text-transform:uppercase; color:rgba(228,220,208,0.4); margin-bottom:14px;">Ce que vous avez maintenant</div>
      <table style="width:100%; border-collapse:collapse;">
        @foreach([
          ['🔗', 'Lien ambassadeur', '90 jours de tracking · Attribution automatique'],
          ['📊', 'Tableau de bord', 'Suivi en temps réel de vos clics et commissions'],
          ['📎', 'Kit de partage', 'Textes prêts à l\'emploi sur votre page ressources'],
          ['💸', 'Commissions', '25% Parcours · 20% Freelance · 15% Formateur · 10% Retraite'],
        ] as [$icon, $label, $detail])
        <tr>
          <td style="padding:8px 0; border-bottom:1px solid rgba(255,255,255,0.04); width:32px; vertical-align:top; font-size:18px;">{{ $icon }}</td>
          <td style="padding:8px 0 8px 10px; border-bottom:1px solid rgba(255,255,255,0.04);">
            <div style="font-size:13px; color:#fff; font-weight:600; margin-bottom:2px;">{{ $label }}</div>
            <div style="font-size:12px; color:rgba(228,220,208,0.45);">{{ $detail }}</div>
          </td>
        </tr>
        @endforeach
      </table>
    </div>

    <!-- CTA -->
    <div style="text-align:center; margin-bottom:8px;">
      <a href="{{ $ressourcesUrl }}"
         style="display:inline-block; background:linear-gradient(135deg,#b8893a 0%,#C9A84C 40%,#E8C96A 100%); color:#070712; font-weight:700; font-size:14px; padding:14px 36px; border-radius:50px; text-decoration:none; letter-spacing:.04em;">
        Accéder à mes ressources →
      </a>
    </div>
    <p style="text-align:center; font-size:11px; color:rgba(228,220,208,0.3); margin:12px 0 0;">
      Textes prêts à l'emploi · Templates · Kit complet
    </p>
  </div>

  <!-- Séparateur philosophie -->
  <div style="text-align:center; padding:8px 0 28px;">
    <div style="font-size:14px; color:rgba(228,220,208,0.5); font-style:italic; line-height:1.8;">
      « Vous ne vendez pas un produit.<br>Vous partagez une expérience que vous avez <span style="color:#C9A84C;">vécue</span>. »
    </div>
  </div>

  <!-- Les 4 programmes -->
  <div style="background:#0D0D20; border:1px solid rgba(255,255,255,0.06); border-radius:16px; padding:28px 32px; margin-bottom:24px;">
    <div style="font-size:10px; letter-spacing:.2em; text-transform:uppercase; color:rgba(228,220,208,0.4); margin-bottom:18px;">Les 4 programmes que vous pouvez recommander</div>
    <table style="width:100%; border-collapse:collapse; font-size:13px;">
      <tr style="border-bottom:1px solid rgba(255,255,255,0.06);">
        <td style="padding:10px 0; color:rgba(228,220,208,0.75);">🌿 Parcours Pause Souffle</td>
        <td style="padding:10px 0; text-align:right; color:#C9A84C; font-weight:700;">25% · ≈ 372 €</td>
      </tr>
      <tr style="border-bottom:1px solid rgba(255,255,255,0.06);">
        <td style="padding:10px 0; color:rgba(228,220,208,0.75);">💼 Freelance Pause Souffle</td>
        <td style="padding:10px 0; text-align:right; color:#a78bfa; font-weight:700;">20% · ≈ 298 €</td>
      </tr>
      <tr style="border-bottom:1px solid rgba(255,255,255,0.06);">
        <td style="padding:10px 0; color:rgba(228,220,208,0.75);">🎓 Formateur Pause Souffle</td>
        <td style="padding:10px 0; text-align:right; color:#60a5fa; font-weight:700;">15% · ≈ 525 €</td>
      </tr>
      <tr>
        <td style="padding:10px 0 0; color:rgba(228,220,208,0.75);">🏔️ Retraite Pause Souffle</td>
        <td style="padding:10px 0 0; text-align:right; color:#84cc16; font-weight:700;">10% · ≈ 480–550 €</td>
      </tr>
    </table>
  </div>

  <!-- Footer -->
  <div style="text-align:center; padding:8px 0;">
    <div style="font-size:11px; color:rgba(228,220,208,0.25); line-height:1.8;">
      Réseau des Ambassadeurs Pause Souffle<br>
      Commissions versées par virement SEPA · Cookie tracking 90 jours<br>
      <span style="color:rgba(201,168,76,0.4);">Junspro · {{ config('app.url') }}</span>
    </div>
  </div>

</div>
</body>
</html>
