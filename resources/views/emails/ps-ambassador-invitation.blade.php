<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Votre expérience mérite d'être partagée</title>
  <style>
    * { margin: 0; padding: 0; box-sizing: border-box; }
    body {
      background: #070712;
      font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
      color: rgba(228,220,208,0.88);
      -webkit-font-smoothing: antialiased;
    }
    .wrap { max-width: 600px; margin: 0 auto; padding: 48px 24px; }

    /* ─── En-tête ─── */
    .header { text-align: center; padding: 0 0 40px; border-bottom: 1px solid rgba(201,168,76,0.2); }
    .header__symbol {
      font-size: 2.4rem;
      line-height: 1;
      color: #C9A84C;
      letter-spacing: -0.02em;
      display: block;
      margin-bottom: 12px;
    }
    .header__brand {
      font-size: 0.6rem; letter-spacing: 0.35em; text-transform: uppercase;
      color: rgba(201,168,76,0.55);
    }

    /* ─── Corps ─── */
    .body { padding: 40px 0; }
    .greeting {
      font-size: 1.3rem; font-weight: 300; letter-spacing: -0.01em;
      color: #fff; margin-bottom: 28px; line-height: 1.4;
    }
    .text {
      font-size: 0.95rem; line-height: 1.85; color: rgba(228,220,208,0.75);
      margin-bottom: 20px;
    }
    .text strong { color: rgba(228,220,208,0.95); font-weight: 500; }

    /* ─── Citation ─── */
    .verse {
      border-left: 2px solid #C9A84C;
      padding: 16px 20px;
      margin: 32px 0;
      background: rgba(201,168,76,0.06);
      border-radius: 0 8px 8px 0;
    }
    .verse__text {
      font-size: 0.9rem; font-style: italic; line-height: 1.75;
      color: rgba(201,168,76,0.85);
    }

    /* ─── Séparation visuelle ─── */
    .divider {
      text-align: center; margin: 36px 0;
      font-size: 1.1rem; color: rgba(201,168,76,0.25); letter-spacing: 0.4em;
    }

    /* ─── Encart "ce que ça signifie" ─── */
    .card {
      background: #0D0D20;
      border: 1px solid rgba(201,168,76,0.22);
      border-radius: 14px;
      padding: 28px 28px 24px;
      margin: 32px 0;
    }
    .card__label {
      font-size: 0.6rem; letter-spacing: 0.3em; text-transform: uppercase;
      color: #C9A84C; margin-bottom: 14px;
    }
    .card__list { list-style: none; padding: 0; }
    .card__list li {
      display: flex; align-items: flex-start; gap: 12px;
      padding: 9px 0;
      border-bottom: 1px solid rgba(255,255,255,0.04);
      font-size: 0.88rem; color: rgba(228,220,208,0.72); line-height: 1.6;
    }
    .card__list li:last-child { border-bottom: none; }
    .card__list li span.icon { color: #C9A84C; flex-shrink: 0; font-size: 1rem; }

    /* ─── CTA ─── */
    .cta-wrap { text-align: center; margin: 36px 0 8px; }
    .cta {
      display: inline-block;
      background: linear-gradient(135deg, #C9A84C, #E8C96A);
      color: #000 !important;
      text-decoration: none;
      font-size: 0.88rem;
      font-weight: 700;
      letter-spacing: 0.08em;
      text-transform: uppercase;
      padding: 16px 38px;
      border-radius: 50px;
    }
    .cta-sub {
      text-align: center; margin-top: 12px;
      font-size: 0.75rem; color: rgba(228,220,208,0.35);
      font-style: italic;
    }

    /* ─── Note ─── */
    .note {
      font-size: 0.8rem; color: rgba(228,220,208,0.35); line-height: 1.7;
      border-top: 1px solid rgba(255,255,255,0.06);
      padding-top: 28px; margin-top: 40px;
    }
    /* ─── Pied ─── */
    .footer {
      text-align: center; padding-top: 28px;
      font-size: 0.72rem; color: rgba(228,220,208,0.25); line-height: 1.8;
    }
  </style>
</head>
<body>
<div class="wrap">

  {{-- En-tête --}}
  <div class="header">
    <span class="header__symbol">✦</span>
    <div class="header__brand">Réseau des Ambassadeurs · Pause Souffle</div>
  </div>

  {{-- Corps --}}
  <div class="body">

    <p class="greeting">
      @if($context === 'formation')
        {{ ucfirst($firstName) }}, vous venez de franchir un cap.
      @else
        {{ ucfirst($firstName) }}, vous venez de vivre quelque chose.
      @endif
    </p>

    @if($context === 'formation')
    <p class="text">
      Vous êtes maintenant <strong>Praticien certifié Pause Souffle</strong>.
      Cela signifie que vous avez traversé les 6 modules, intégré les outils,
      et que vous portez désormais cette pratique dans votre vie et, peut-être, dans celle des autres.
    </p>
    @else
    <p class="text">
      Votre cycle Pause Souffle vient d'être activé.
      Derrière ce geste simple se trouve souvent une décision profonde :
      prendre soin de soi, retrouver de l'espace intérieur, ralentir là où tout va vite.
    </p>
    @endif

    <p class="text">
      Il arrive que certaines expériences ne se gardent pas pour soi.
      Elles ont envie de voyager — vers une personne proche qui en aurait besoin,
      vers quelqu'un qui cherche sans encore savoir ce qu'il cherche.
    </p>

    <div class="verse">
      <p class="verse__text">
        « Ce que vous avez vécu, d'autres le cherchent encore.
        Partager n'est pas vendre. C'est ouvrir une porte. »
      </p>
    </div>

    <p class="text">
      C'est pourquoi nous vous adressons cette invitation — pas une proposition commerciale,
      une invitation à faire partie d'un cercle de personnes qui transmettent ce qu'ils ont reçu.
    </p>

    <div class="divider">· · ·</div>

    <div class="card">
      <div class="card__label">Ce que cela représente concrètement</div>
      <ul class="card__list">
        <li>
          <span class="icon">∿</span>
          <span>Un <strong>lien personnel</strong> à partager avec votre entourage — pas un code promo, un lien de recommandation humaine.</span>
        </li>
        <li>
          <span class="icon">◈</span>
          <span>Une <strong>commission</strong> reversée chaque fois qu'une personne découvre Pause Souffle grâce à vous, comme reconnaissance de votre rôle.</span>
        </li>
        <li>
          <span class="icon">⬡</span>
          <span>Des <strong>ressources</strong> pour partager avec les bons mots — témoignages, templates, guide de première mission.</span>
        </li>
        <li>
          <span class="icon">✦</span>
          <span>Une <strong>communauté</strong> d'ambassadeurs qui partagent la même vision.</span>
        </li>
      </ul>
    </div>

    <p class="text">
      Aucune obligation, aucune pression. Vous pouvez consulter la page, lire le détail,
      et décider si cela correspond à ce que vous souhaitez faire.
    </p>

    <div class="cta-wrap">
      <a href="{{ $landingUrl }}" class="cta">Découvrir le programme Ambassadeur</a>
    </div>
    <p class="cta-sub">L'inscription prend moins de 2 minutes.</p>

  </div>

  {{-- Note de bas --}}
  <p class="note">
    Cette invitation vous a été envoyée parce que vous avez récemment activé
    @if($context === 'formation')
      votre formation certifiante Pause Souffle.
    @else
      un cycle Pause Souffle.
    @endif
    Si vous ne souhaitez pas rejoindre le réseau des Ambassadeurs, ignorez simplement ce message.
    Votre parcours Pause Souffle reste inchangé.
  </p>

  <div class="footer">
    © {{ date('Y') }} Pause Souffle · Tous droits réservés<br>
    <a href="{{ $landingUrl }}" style="color: rgba(201,168,76,0.4);">En savoir plus sur le réseau des Ambassadeurs</a>
  </div>

</div>
</body>
</html>
