<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>{{ $senderFirstName }} vous a transmis quelque chose</title>
  <style>
    * { margin: 0; padding: 0; box-sizing: border-box; }
    body {
      background: #070712;
      font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
      color: rgba(228,220,208,0.88);
      -webkit-font-smoothing: antialiased;
    }
    .wrap { max-width: 580px; margin: 0 auto; padding: 48px 24px; }

    .header { text-align: center; padding: 0 0 36px; border-bottom: 1px solid rgba(201,168,76,0.18); }
    .header__symbol { font-size: 2rem; color: #C9A84C; display: block; margin-bottom: 10px; }
    .header__brand { font-size: 0.6rem; letter-spacing: 0.35em; text-transform: uppercase; color: rgba(201,168,76,0.5); }

    .body { padding: 36px 0; }
    .greeting { font-size: 1.2rem; font-weight: 300; color: #fff; margin-bottom: 24px; line-height: 1.4; }
    .text { font-size: 0.93rem; line-height: 1.85; color: rgba(228,220,208,0.72); margin-bottom: 18px; }
    .text strong { color: rgba(228,220,208,0.95); font-weight: 500; }

    /* ─── Message personnel ─── */
    .personal-msg {
      background: rgba(201,168,76,0.07);
      border: 1px solid rgba(201,168,76,0.2);
      border-radius: 12px;
      padding: 22px 24px;
      margin: 28px 0;
    }
    .personal-msg__label {
      font-size: 0.6rem; letter-spacing: 0.3em; text-transform: uppercase;
      color: rgba(201,168,76,0.65); margin-bottom: 10px;
    }
    .personal-msg__text {
      font-size: 0.92rem; font-style: italic;
      color: rgba(228,220,208,0.85); line-height: 1.75;
    }

    /* ─── Présentation Pause Souffle ─── */
    .card {
      background: #0D0D20;
      border: 1px solid rgba(201,168,76,0.18);
      border-radius: 14px;
      padding: 26px 26px 22px;
      margin: 28px 0;
    }
    .card__label { font-size: 0.6rem; letter-spacing: 0.3em; text-transform: uppercase; color: #C9A84C; margin-bottom: 12px; }
    .card__title { font-size: 1.05rem; font-weight: 500; color: #fff; margin-bottom: 10px; }
    .card__text { font-size: 0.86rem; color: rgba(228,220,208,0.6); line-height: 1.8; }

    /* ─── CTA ─── */
    .cta-wrap { text-align: center; margin: 32px 0 6px; }
    .cta {
      display: inline-block;
      background: linear-gradient(135deg, #C9A84C, #E8C96A);
      color: #000 !important;
      text-decoration: none;
      font-size: 0.85rem; font-weight: 700;
      letter-spacing: 0.08em; text-transform: uppercase;
      padding: 14px 34px; border-radius: 50px;
    }
    .cta-sub {
      text-align: center; margin-top: 10px;
      font-size: 0.72rem; color: rgba(228,220,208,0.3); font-style: italic;
    }

    .note {
      font-size: 0.78rem; color: rgba(228,220,208,0.3); line-height: 1.7;
      border-top: 1px solid rgba(255,255,255,0.05);
      padding-top: 26px; margin-top: 38px;
    }
    .footer { text-align: center; padding-top: 24px; font-size: 0.7rem; color: rgba(228,220,208,0.2); line-height: 1.8; }
  </style>
</head>
<body>
<div class="wrap">

  <div class="header">
    <span class="header__symbol">✦</span>
    <div class="header__brand">Pause Souffle</div>
  </div>

  <div class="body">
    <p class="greeting">
      {{ ucfirst($recipientFirstName) }}, <strong>{{ $senderFirstName }}</strong> vous a transmis quelque chose.
    </p>

    <p class="text">
      Votre contact {{ $senderFirstName }} a découvert <strong>Pause Souffle</strong> et a pensé à vous en partageant ce lien.
      Ce n'est pas un message commercial automatisé — c'est une recommandation personnelle.
    </p>

    @if($senderMessage)
    <div class="personal-msg">
      <div class="personal-msg__label">Message de {{ $senderFirstName }}</div>
      <p class="personal-msg__text">« {{ e($senderMessage) }} »</p>
    </div>
    @endif

    <div class="card">
      <div class="card__label">Qu'est-ce que Pause Souffle ?</div>
      <p class="card__title">Un parcours sur la présence et la respiration</p>
      <p class="card__text">
        Pause Souffle accompagne des personnes qui cherchent à retrouver de l'espace intérieur dans leur quotidien.
        Ce n'est pas de la méditation classique — c'est un rituel concret, porté par des accompagnants certifiés,
        qui aide à habiter l'instant avec plus de clarté et moins de bruit mental.
      </p>
    </div>

    <p class="text">
      Si la recommandation de {{ $senderFirstName }} résonne, vous pouvez découvrir Pause Souffle via son lien personnel.
    </p>

    <div class="cta-wrap">
      <a href="{{ $ambassadorLink }}" class="cta">Découvrir Pause Souffle</a>
    </div>
    <p class="cta-sub">Aucun engagement. Juste découvrir.</p>
  </div>

  <p class="note">
    Vous avez reçu ce message parce que {{ $senderFirstName }} a souhaité vous partager cette expérience.
    Si vous ne souhaitez pas recevoir d'autres messages de ce type, ignorez simplement celui-ci.
  </p>

  <div class="footer">
    © {{ date('Y') }} Pause Souffle · Tous droits réservés
  </div>

</div>
</body>
</html>
