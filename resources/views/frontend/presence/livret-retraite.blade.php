<!DOCTYPE html>
<html lang="{{ isset($language) && $language->code === 'en' ? 'en' : 'fr' }}">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  @php $en = isset($language) && $language->code === 'en'; @endphp
  <title>{{ $en ? 'Pause Souffle Retreat · Personal Booklet' : 'Retraite Pause Souffle · Livret personnel' }}</title>
  <style>
    /* ─── TYPOGRAPHIE & COULEURS ────────────────────────────── */
    @import url('https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,600;1,300;1,400&family=Raleway:wght@300;400;500;600&display=swap');

    :root {
      --gold: #C9A84C;
      --gold-light: #E8D5A0;
      --gold-pale: #F5EDD6;
      --cream: #F9F5EC;
      --cream-dark: #EFE7D3;
      --ink: #1C1208;
      --ink-soft: #3D2F15;
      --brown-light: #8B6E3E;
      --line-color: rgba(201,168,76,.25);
      --serif: 'Cormorant Garamond', Georgia, serif;
      --sans: 'Raleway', sans-serif;
    }

    * { box-sizing: border-box; margin: 0; padding: 0; }

    body {
      background: #fff;
      font-family: var(--sans);
      color: var(--ink);
      font-size: 14px;
      line-height: 1.7;
    }

    /* ─── BARRE DE NAVIGATION LIVRET ───────────────────────── */
    .livret-nav {
      position: fixed;
      top: 0; left: 0; right: 0;
      z-index: 999;
      background: var(--cream);
      border-bottom: 1px solid var(--line-color);
      padding: .6rem 2rem;
      display: flex;
      align-items: center;
      justify-content: space-between;
      print-color-adjust: exact;
    }

    .livret-nav-brand {
      font-family: var(--serif);
      font-size: 1rem;
      font-weight: 400;
      color: var(--gold);
      letter-spacing: .1em;
    }

    .livret-nav-actions {
      display: flex;
      gap: .75rem;
    }

    .btn-print {
      display: inline-flex;
      align-items: center;
      gap: .4rem;
      padding: .45rem 1.2rem;
      background: var(--gold);
      color: #fff;
      border-radius: 50px;
      font-size: .78rem;
      font-weight: 600;
      letter-spacing: .06em;
      text-transform: uppercase;
      border: none;
      cursor: pointer;
      text-decoration: none;
      font-family: var(--sans);
      transition: opacity .2s;
    }
    .btn-print:hover { opacity: .85; }

    .btn-back {
      display: inline-flex;
      align-items: center;
      gap: .4rem;
      padding: .45rem 1.2rem;
      border: 1px solid var(--line-color);
      color: var(--brown-light);
      border-radius: 50px;
      font-size: .78rem;
      font-weight: 500;
      text-decoration: none;
      font-family: var(--sans);
      transition: all .2s;
    }
    .btn-back:hover { background: var(--cream-dark); color: var(--ink); }

    /* ─── CONTENEUR PRINCIPAL ───────────────────────────────── */
    .livret-body {
      padding-top: 56px; /* hauteur navbarre */
      max-width: 760px;
      margin: 0 auto;
    }

    /* ─── PAGE GÉNÉRIQUE ────────────────────────────────────── */
    .page {
      background: var(--cream);
      border: 1px solid var(--cream-dark);
      border-radius: 4px;
      margin: 2rem 1rem;
      padding: 4rem 4.5rem;
      position: relative;
      overflow: hidden;
      page-break-after: always;
    }

    /* Filet doré gauche vertical */
    .page::before {
      content: '';
      position: absolute;
      left: 1.5rem;
      top: 3rem;
      bottom: 3rem;
      width: 2px;
      background: linear-gradient(to bottom, transparent, var(--gold), transparent);
    }

    /* ─── PAGE DE COUVERTURE ────────────────────────────────── */
    .page-cover {
      background: var(--ink);
      border-radius: 4px;
      padding: 5rem 4.5rem;
      text-align: center;
      min-height: 600px;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
    }

    .page-cover::before { display: none; }

    .cover-line {
      width: 60px;
      height: 1px;
      background: var(--gold);
      margin: 1.5rem auto;
    }

    .cover-overtitle {
      font-family: var(--sans);
      font-size: .72rem;
      font-weight: 600;
      letter-spacing: .25em;
      text-transform: uppercase;
      color: var(--gold);
    }

    .cover-title {
      font-family: var(--serif);
      font-size: clamp(2.2rem, 5vw, 3.2rem);
      font-weight: 300;
      color: #fff;
      line-height: 1.25;
      margin: .75rem 0;
    }

    .cover-title em {
      color: var(--gold);
      font-style: italic;
    }

    .cover-subtitle {
      font-family: var(--serif);
      font-size: 1.05rem;
      font-weight: 300;
      color: rgba(255,255,255,.55);
      font-style: italic;
      margin-top: .5rem;
    }

    .cover-details {
      margin-top: 3rem;
      display: flex;
      flex-direction: column;
      gap: .5rem;
    }

    .cover-detail-item {
      font-size: .8rem;
      font-family: var(--sans);
      color: rgba(255,255,255,.4);
      letter-spacing: .08em;
    }

    .cover-owner-block {
      margin-top: 3.5rem;
      border-top: 1px solid rgba(255,255,255,.12);
      padding-top: 2rem;
      width: 100%;
      max-width: 340px;
    }

    .cover-owner-label {
      font-size: .68rem;
      letter-spacing: .2em;
      text-transform: uppercase;
      color: var(--gold);
      font-family: var(--sans);
      font-weight: 600;
      margin-bottom: .5rem;
    }

    .cover-owner-line {
      border: none;
      border-bottom: 1px solid rgba(255,255,255,.2);
      width: 100%;
      height: 1.8rem;
      margin-bottom: .6rem;
      background: transparent;
    }

    .cover-owner-hint {
      font-size: .68rem;
      color: rgba(255,255,255,.2);
      font-style: italic;
    }

    /* ─── TITRES DE SECTION ─────────────────────────────────── */
    .section-overtitle {
      font-family: var(--sans);
      font-size: .68rem;
      font-weight: 600;
      letter-spacing: .22em;
      text-transform: uppercase;
      color: var(--gold);
      margin-bottom: .6rem;
    }

    .section-title {
      font-family: var(--serif);
      font-size: clamp(1.7rem, 3vw, 2.4rem);
      font-weight: 300;
      color: var(--ink);
      line-height: 1.3;
      margin-bottom: 1.5rem;
    }

    .section-title em { color: var(--gold); font-style: italic; }

    .section-rule {
      width: 40px;
      height: 1px;
      background: var(--gold);
      margin: 1.25rem 0;
    }

    /* ─── TEXTE ─────────────────────────────────────────────── */
    .body-text {
      font-size: .9rem;
      line-height: 1.8;
      color: var(--ink-soft);
      margin-bottom: 1.25rem;
    }

    .body-text strong { color: var(--ink); font-weight: 600; }

    /* ─── PROGRAMME ─────────────────────────────────────────── */
    .programme-day {
      margin-bottom: 2rem;
    }

    .programme-day-label {
      font-family: var(--sans);
      font-size: .68rem;
      letter-spacing: .2em;
      text-transform: uppercase;
      color: var(--gold);
      font-weight: 700;
      margin-bottom: .35rem;
    }

    .programme-day-title {
      font-family: var(--serif);
      font-size: 1.4rem;
      font-weight: 300;
      color: var(--ink);
      margin-bottom: .75rem;
      border-bottom: 1px solid var(--line-color);
      padding-bottom: .5rem;
    }

    .programme-item {
      display: flex;
      gap: 1.2rem;
      padding: .5rem 0;
      border-bottom: 1px dashed rgba(201,168,76,.15);
    }

    .programme-time {
      font-family: var(--sans);
      font-size: .75rem;
      font-weight: 600;
      color: var(--gold);
      min-width: 70px;
      padding-top: .05rem;
    }

    .programme-desc {
      font-size: .87rem;
      color: var(--ink-soft);
      line-height: 1.6;
    }

    .programme-desc strong { color: var(--ink); font-weight: 600; }

    /* ─── QUESTIONS INTROSPECTIVES ──────────────────────────── */
    .question-block {
      margin-bottom: 2.5rem;
    }

    .question-number {
      font-family: var(--sans);
      font-size: .65rem;
      letter-spacing: .2em;
      text-transform: uppercase;
      color: var(--gold);
      font-weight: 700;
      margin-bottom: .3rem;
    }

    .question-text {
      font-family: var(--serif);
      font-size: 1.2rem;
      font-weight: 300;
      color: var(--ink);
      line-height: 1.45;
      font-style: italic;
      margin-bottom: 1rem;
    }

    /* ─── LIGNES D'ÉCRITURE ─────────────────────────────────── */
    .writing-lines {
      display: flex;
      flex-direction: column;
      gap: .85rem;
      margin-top: .5rem;
    }

    .writing-line {
      border: none;
      border-bottom: 1px solid rgba(201,168,76,.3);
      width: 100%;
      height: 1.4rem;
      background: transparent;
    }

    /* ─── CARNET BLANC ──────────────────────────────────────── */
    .blank-page-note {
      font-family: var(--serif);
      font-size: .9rem;
      font-style: italic;
      color: var(--brown-light);
      text-align: center;
      margin-bottom: 2rem;
    }

    .blank-lines-grid {
      display: flex;
      flex-direction: column;
      gap: 1.2rem;
    }

    /* ─── PHRASE DE MISSION ─────────────────────────────────── */
    .mission-frame {
      border: 1px solid var(--gold);
      border-radius: 3px;
      padding: 2.5rem 3rem;
      text-align: center;
      position: relative;
      margin-top: 1.5rem;
    }

    .mission-frame::before {
      content: '"';
      font-family: var(--serif);
      font-size: 5rem;
      color: rgba(201,168,76,.2);
      position: absolute;
      top: -1.5rem;
      left: 1.5rem;
      line-height: 1;
    }

    .mission-frame-label {
      font-size: .65rem;
      letter-spacing: .2em;
      text-transform: uppercase;
      color: var(--gold);
      font-weight: 700;
      margin-bottom: 1.5rem;
    }

    .mission-big-line {
      border: none;
      border-bottom: 1px solid rgba(201,168,76,.4);
      width: 100%;
      height: 2.5rem;
      margin-bottom: 1rem;
      background: transparent;
      font-family: var(--serif);
      font-size: 1.15rem;
      text-align: center;
    }

    .mission-sub-lines {
      display: flex;
      flex-direction: column;
      gap: .8rem;
      margin-top: .5rem;
    }

    /* ─── ATTESTATION ───────────────────────────────────────── */
    .attestation-frame {
      border: 2px solid var(--gold);
      border-radius: 4px;
      padding: 3rem 3.5rem;
      text-align: center;
      background: linear-gradient(135deg, #FDF8EC, #F9F3E2);
      position: relative;
    }

    .attestation-frame::before,
    .attestation-frame::after {
      content: '';
      position: absolute;
      width: 30px;
      height: 30px;
      border: 1px solid var(--gold);
    }

    .attestation-frame::before { top: 8px; left: 8px; border-right: none; border-bottom: none; }
    .attestation-frame::after  { bottom: 8px; right: 8px; border-left: none; border-top: none; }

    .attestation-title {
      font-family: var(--serif);
      font-size: 1.6rem;
      font-weight: 300;
      color: var(--ink);
      margin-bottom: .75rem;
    }

    .attestation-subtitle {
      font-size: .78rem;
      letter-spacing: .18em;
      text-transform: uppercase;
      color: var(--gold);
      font-weight: 600;
      margin-bottom: 2rem;
    }

    .attestation-name-line {
      border: none;
      border-bottom: 1px solid var(--gold);
      width: 280px;
      height: 2rem;
      background: transparent;
      margin: 1rem auto;
      display: block;
      font-family: var(--serif);
      font-size: 1.15rem;
      text-align: center;
    }

    .attestation-hint {
      font-size: .75rem;
      color: var(--brown-light);
      font-style: italic;
      margin-top: .25rem;
    }

    .attestation-body {
      font-family: var(--serif);
      font-size: 1rem;
      font-weight: 300;
      color: var(--ink-soft);
      line-height: 1.75;
      margin: 1.5rem 0;
    }

    .attestation-date-block {
      display: flex;
      justify-content: space-between;
      margin-top: 3rem;
      gap: 2rem;
    }

    .attestation-sig-line {
      flex: 1;
      text-align: center;
    }

    .attestation-sig-line .line {
      border-bottom: 1px solid var(--line-color);
      margin-bottom: .4rem;
      height: 2.5rem;
    }

    .attestation-sig-label {
      font-size: .68rem;
      letter-spacing: .12em;
      text-transform: uppercase;
      color: var(--brown-light);
    }

    /* ─── CITATION ──────────────────────────────────────────── */
    .pullquote {
      font-family: var(--serif);
      font-size: 1.3rem;
      font-weight: 300;
      font-style: italic;
      color: var(--ink);
      padding: 1.5rem 2rem;
      border-left: 2px solid var(--gold);
      margin: 1.5rem 0;
      line-height: 1.5;
    }

    .pullquote-ref {
      font-family: var(--sans);
      font-size: .72rem;
      letter-spacing: .1em;
      color: var(--brown-light);
      margin-top: .75rem;
      display: block;
    }

    /* ─── BADGE ACTIVITÉ ────────────────────────────────────── */
    .activity-grid {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 1rem;
      margin-top: 1.2rem;
    }

    .activity-card {
      border: 1px solid var(--line-color);
      border-radius: 4px;
      padding: 1rem 1.2rem;
      background: rgba(255,255,255,.5);
    }

    .activity-card-label {
      font-size: .65rem;
      letter-spacing: .18em;
      text-transform: uppercase;
      color: var(--gold);
      font-weight: 700;
      margin-bottom: .3rem;
    }

    .activity-card-name {
      font-family: var(--serif);
      font-size: 1rem;
      font-weight: 400;
      color: var(--ink);
    }

    /* ─── IMPRESSION ────────────────────────────────────────── */
    @media print {
      .livret-nav { display: none !important; }
      .livret-body { padding-top: 0; }
      .page { margin: 0; border: none; border-radius: 0; break-after: page; }
      .page-cover { min-height: 100vh; }
      body { font-size: 13px; }
    }

    @media (max-width: 600px) {
      .page { padding: 2.5rem 1.5rem; }
      .page-cover { padding: 3rem 1.5rem; }
      .activity-grid { grid-template-columns: 1fr; }
    }
  </style>
</head>
<body>

{{-- ─── BARRE DE NAVIGATION ──────────────────────────────── --}}
<nav class="livret-nav">
  <span class="livret-nav-brand">Junspro · Pause Souffle</span>
  <div class="livret-nav-actions">
    <a href="{{ route('presence.retraite') }}" class="btn-back">
      ← {{ $en ? 'Back to retreat' : 'Retour à la retraite' }}
    </a>
    <button class="btn-print" onclick="window.print()">
      <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M6 9V2h12v7M6 18H4a2 2 0 01-2-2v-5a2 2 0 012-2h16a2 2 0 012 2v5a2 2 0 01-2 2h-2"/><path d="M6 14h12v8H6z"/></svg>
      {{ $en ? 'Print / PDF' : 'Imprimer / PDF' }}
    </button>
  </div>
</nav>

<div class="livret-body">

  {{-- ═══════════════════════════════════════════════════════ --}}
  {{-- PAGE 1 — COUVERTURE                                     --}}
  {{-- ═══════════════════════════════════════════════════════ --}}
  <div class="page page-cover">
    <span class="cover-overtitle">
      {{ $en ? 'Personal booklet · Exclusive retreat' : 'Livret personnel · Retraite exclusive' }}
    </span>
    <div class="cover-line"></div>
    <h1 class="cover-title">
      {{ $en ? 'The Pause Souffle<br>' : 'La Retraite<br>' }}
      <em>{{ $en ? 'Retreat' : 'Pause Souffle' }}</em>
    </h1>
    <p class="cover-subtitle">
      {{ $en ? 'Mediterranean · Surprise Destination · 7 days · 12 souls' : 'Méditerranée · Destination Surprise · 7 jours · 12 âmes' }}
    </p>
    <div class="cover-line"></div>

    <div class="cover-details">
      <span class="cover-detail-item">
        {{ $en ? '6 signature activities · Private villa' : '6 activités signature · Villa privée' }}
      </span>
      <span class="cover-detail-item">
        {{ $en ? 'Certified Practitioner Programme — Final immersion' : 'Formation Praticien Certifié — Immersion finale' }}
      </span>
    </div>

    <div class="cover-owner-block">
      <div class="cover-owner-label">
        {{ $en ? 'This booklet belongs to' : 'Ce livret appartient à' }}
      </div>
      <hr class="cover-owner-line">
      <hr class="cover-owner-line" style="margin-bottom:0">
      <p class="cover-owner-hint">
        {{ $en ? 'Your name · Your intention' : 'Votre prénom · Votre intention' }}
      </p>
    </div>
  </div>

  {{-- ═══════════════════════════════════════════════════════ --}}
  {{-- PAGE 2 — AVANT DE PARTIR (lettre d'introduction)        --}}
  {{-- ═══════════════════════════════════════════════════════ --}}
  <div class="page">
    <div class="section-overtitle">{{ $en ? 'Before you leave' : 'Avant de partir' }}</div>
    <h2 class="section-title">
      {{ $en ? 'This booklet is a space<br>just for <em>you</em>.' : 'Ce livret est un espace<br>rien que pour <em>vous</em>.' }}
    </h2>
    <div class="section-rule"></div>

    <p class="body-text">
      {{ $en
        ? 'There are no right answers here. No notes, no performance. Just an honest conversation with yourself — written down.'
        : 'Il n\'y a pas de bonnes réponses ici. Pas de notes, pas de performance. Juste une conversation honnête avec vous-même — posée sur le papier.' }}
    </p>
    <p class="body-text">
      {{ $en
        ? 'Use these pages however you wish: a few words, a sentence, a drawing, a silence. What matters is that you show up.'
        : 'Utilisez ces pages comme vous le souhaitez : quelques mots, une phrase, un dessin, un silence. Ce qui compte, c\'est que vous soyez là.' }}
    </p>
    <p class="body-text">
      {{ $en
        ? 'The retreat is designed to complete what the six modules began — to anchor it in the body, in lived experience, in the heart.'
        : 'La retraite est conçue pour compléter ce que les six modules ont commencé — l\'ancrer dans le corps, dans le vécu, dans le cœur.' }}
    </p>

    <div class="pullquote">
      {{ $en
        ? '"You are no longer a seeker. You are a bearer."'
        : '"Vous n\'êtes plus un chercheur. Vous êtes un passeur."' }}
      <span class="pullquote-ref">— {{ $en ? 'Module 6 · Pause Souffle Training' : 'Module 6 · Formation Pause Souffle' }}</span>
    </div>

    <p class="body-text" style="margin-top:1.5rem;">
      {{ $en
        ? 'May these seven days be a threshold — not an end, but a beginning.'
        : 'Que ces sept jours soient un seuil — pas une fin, mais un commencement.' }}
    </p>
  </div>

  {{-- ═══════════════════════════════════════════════════════ --}}
  {{-- PAGE 3 — PROGRAMME DES 7 JOURS                          --}}
  {{-- ═══════════════════════════════════════════════════════ --}}
  <div class="page">
    <div class="section-overtitle">{{ $en ? 'Your seven days' : 'Vos sept jours' }}</div>
    <h2 class="section-title">{{ $en ? 'The <em>Programme</em>' : 'Le <em>Programme</em>' }}</h2>
    <div class="section-rule"></div>

    {{-- Jour 1 --}}
    <div class="programme-day">
      <div class="programme-day-label">{{ $en ? 'Day 1' : 'Jour 1' }}</div>
      <div class="programme-day-title">{{ $en ? 'Arrival · Silence' : 'Arrivée · Silence' }}</div>
      <div class="programme-item">
        <span class="programme-time">14:00</span>
        <span class="programme-desc">{{ $en ? 'Arrival · Villa · Welcome ritual · 2h of silence' : 'Arrivée · Villa · Rituel de bienvenue · 2h de silence' }}</span>
      </div>
      <div class="programme-item">
        <span class="programme-time">21:00</span>
        <span class="programme-desc">{{ $en ? 'Fire ritual · Letter to oneself · First circle' : 'Rituel du feu · Lettre à soi · Premier cercle' }}</span>
      </div>
    </div>

    {{-- Jour 2 --}}
    <div class="programme-day">
      <div class="programme-day-label">{{ $en ? 'Day 2' : 'Jour 2' }}</div>
      <div class="programme-day-title">{{ $en ? 'Module 1 — Meeting oneself' : 'Module 1 — Se rencontrer' }}</div>
      <div class="programme-item">
        <span class="programme-time">07:00</span>
        <span class="programme-desc"><strong>{{ $en ? 'Outdoor reflexology (75 min)' : 'Réflexologie en plein air (75 min)' }}</strong></span>
      </div>
      <div class="programme-item">
        <span class="programme-time">15:00</span>
        <span class="programme-desc">{{ $en ? 'Silent contemplative walk · Collective 5-5-5 by the sea' : 'Marche contemplative silencieuse · 5-5-5 collectif face à la mer' }}</span>
      </div>
    </div>

    {{-- Jour 3 --}}
    <div class="programme-day">
      <div class="programme-day-label">{{ $en ? 'Day 3' : 'Jour 3' }}</div>
      <div class="programme-day-title">{{ $en ? 'Module 2 — The wound recognised' : 'Module 2 — La blessure reconnue' }}</div>
      <div class="programme-item">
        <span class="programme-time">09:00</span>
        <span class="programme-desc"><strong>{{ $en ? 'Deep shiatsu (75 min) · Private session' : 'Shiatsu profond (75 min) · Session individuelle' }}</strong></span>
      </div>
      <div class="programme-item">
        <span class="programme-time">20:30</span>
        <span class="programme-desc">{{ $en ? 'Evening speaking circle · Listening without judgement' : 'Cercle de parole du soir · Écoute sans jugement' }}</span>
      </div>
    </div>

    {{-- Jour 4 --}}
    <div class="programme-day">
      <div class="programme-day-label">{{ $en ? 'Day 4' : 'Jour 4' }}</div>
      <div class="programme-day-title">{{ $en ? 'Modules 3 & 4 — Open up' : 'Modules 3 & 4 — S\'ouvrir' }}</div>
      <div class="programme-item">
        <span class="programme-time">05:30</span>
        <span class="programme-desc"><strong>{{ $en ? 'Sunrise private boat · Turquoise water · 40 min absolute silence' : 'Bateau privatisé lever du soleil · Eau turquoise · 40 min silence absolu' }}</strong></span>
      </div>
      <div class="programme-item">
        <span class="programme-time">10:00</span>
        <span class="programme-desc">{{ $en ? 'Pilates by the sea (60 min) · Vagus nerve activation sequence' : 'Pilates bord de mer (60 min) · Séquence activation nerf vague' }}</span>
      </div>
      <div class="programme-item">
        <span class="programme-time">15:00</span>
        <span class="programme-desc">{{ $en ? 'Free afternoon · Pool · Journal · Silence' : 'Après-midi libre · Piscine · Carnet · Silence' }}</span>
      </div>
    </div>

    {{-- Jour 5 --}}
    <div class="programme-day">
      <div class="programme-day-label">{{ $en ? 'Day 5' : 'Jour 5' }}</div>
      <div class="programme-day-title">{{ $en ? 'Module 5 — The mission' : 'Module 5 — La mission' }}</div>
      <div class="programme-item">
        <span class="programme-time">06:00</span>
        <span class="programme-desc">{{ $en ? 'Module 5 replay at dawn (collective) · The sentence heard differently' : 'Réécoute module 5 à l\'aube (collectif) · La phrase entendue différemment' }}</span>
      </div>
      <div class="programme-item">
        <span class="programme-time">10:00</span>
        <span class="programme-desc">{{ $en ? 'Mission sentence writing workshop · Alone, in silence, until it is true' : 'Atelier d\'écriture phrase de mission · Seul, en silence, jusqu\'à ce qu\'elle soit vraie' }}</span>
      </div>
      <div class="programme-item">
        <span class="programme-time">18:30</span>
        <span class="programme-desc"><strong>{{ $en ? 'Guided freediving (45 min) — the 5-5-5 underwater · Pool' : 'Apnée guidée (45 min) — le 5-5-5 sous l\'eau · Piscine' }}</strong></span>
      </div>
    </div>

    {{-- Jour 6 --}}
    <div class="programme-day">
      <div class="programme-day-label">{{ $en ? 'Day 6' : 'Jour 6' }}</div>
      <div class="programme-day-title">{{ $en ? 'Integration · Closing ceremony' : 'Intégration · Cérémonie de clôture' }}</div>
      <div class="programme-item">
        <span class="programme-time">09:30</span>
        <span class="programme-desc"><strong>{{ $en ? 'Horse whispering (90 min) — the soul\'s mirror' : 'Horse whispering (90 min) — le miroir de l\'âme' }}</strong></span>
      </div>
      <div class="programme-item">
        <span class="programme-time">13:00</span>
        <span class="programme-desc">{{ $en ? 'Free spa · Pool · Journal · Silence · Music' : 'Spa libre · Piscine · Carnet · Silence · Musique' }}</span>
      </div>
      <div class="programme-item">
        <span class="programme-time">17:00</span>
        <span class="programme-desc"><strong>{{ $en ? 'Closing ceremony · Mission sentences spoken aloud, facing the horizon' : 'Cérémonie de clôture · Phrases de mission dites à voix haute, face à l\'horizon' }}</strong></span>
      </div>
      <div class="programme-item">
        <span class="programme-time">20:00</span>
        <span class="programme-desc">{{ $en ? 'Gala dinner · Attestation ceremony · The practitioner network activated' : 'Dîner de gala · Remise des attestations · Le réseau des praticiens activé' }}</span>
      </div>
    </div>

    {{-- Jour 7 --}}
    <div class="programme-day">
      <div class="programme-day-label">{{ $en ? 'Day 7' : 'Jour 7' }}</div>
      <div class="programme-day-title">{{ $en ? 'Departure · Sending off' : 'Départ · Envoi' }}</div>
      <div class="programme-item">
        <span class="programme-time">07:00</span>
        <span class="programme-desc">{{ $en ? 'Final collective breath at dawn · Booklet sealing ritual' : 'Dernier souffle collectif à l\'aube · Rituel de scellement du livret' }}</span>
      </div>
      <div class="programme-item">
        <span class="programme-time">10:00</span>
        <span class="programme-desc">{{ $en ? 'Group departure · You leave different — the body now knows.' : 'Départ du groupe · Vous partez différent — le corps sait maintenant.' }}</span>
      </div>
    </div>
    </div>
  </div>

  {{-- ═══════════════════════════════════════════════════════ --}}
  {{-- PAGE 4 — QUESTIONS JOUR 1 (Arrivée · Présence)          --}}
  {{-- ═══════════════════════════════════════════════════════ --}}
  <div class="page">
    <div class="section-overtitle">{{ $en ? 'Day 1 · Arrival · Presence' : 'Jour 1 · Arrivée · Présence' }}</div>
    <h2 class="section-title">{{ $en ? 'Questions for<br><em>today</em>' : 'Questions pour<br><em>aujourd\'hui</em>' }}</h2>
    <div class="section-rule"></div>

    <div class="question-block">
      <div class="question-number">{{ $en ? 'Question 01' : 'Question 01' }}</div>
      <p class="question-text">
        {{ $en
          ? '"What did you bring with you that you no longer need?"'
          : '"Qu\'avez-vous apporté avec vous dont vous n\'avez plus besoin ?"' }}
      </p>
      <div class="writing-lines">
        @for ($i = 0; $i < 5; $i++)
          <hr class="writing-line">
        @endfor
      </div>
    </div>

    <div class="question-block">
      <div class="question-number">{{ $en ? 'Question 02' : 'Question 02' }}</div>
      <p class="question-text">
        {{ $en
          ? '"If your body could speak right now, what would it ask you for?"'
          : '"Si votre corps pouvait parler en ce moment, que vous demanderait-il ?"' }}
      </p>
      <div class="writing-lines">
        @for ($i = 0; $i < 5; $i++)
          <hr class="writing-line">
        @endfor
      </div>
    </div>

    <div class="question-block">
      <div class="question-number">{{ $en ? 'Question 03' : 'Question 03' }}</div>
      <p class="question-text">
        {{ $en
          ? '"What intention are you setting for these seven days — in one sentence?"'
          : '"Quelle intention posez-vous pour ces sept jours — en une phrase ?"' }}
      </p>
      <div class="writing-lines">
        @for ($i = 0; $i < 4; $i++)
          <hr class="writing-line">
        @endfor
      </div>
    </div>
  </div>

  {{-- ═══════════════════════════════════════════════════════ --}}
  {{-- PAGE 5 — QUESTIONS JOUR 2 (Profondeur · Mission)        --}}
  {{-- ═══════════════════════════════════════════════════════ --}}
  <div class="page">
    <div class="section-overtitle">{{ $en ? 'Day 2 · Depth · Mission' : 'Jour 2 · Profondeur · Mission' }}</div>
    <h2 class="section-title">{{ $en ? 'Going further<br><em>into yourself</em>' : 'Aller plus loin<br><em>en vous-même</em>' }}</h2>
    <div class="section-rule"></div>

    <div class="question-block">
      <div class="question-number">{{ $en ? 'Question 04' : 'Question 04' }}</div>
      <p class="question-text">
        {{ $en
          ? '"What wound — healed or still tender — turned you into who you are today?"'
          : '"Quelle blessure — guérie ou encore vive — vous a transformé·e en qui vous êtes aujourd\'hui ?"' }}
      </p>
      <div class="writing-lines">
        @for ($i = 0; $i < 5; $i++)
          <hr class="writing-line">
        @endfor
      </div>
    </div>

    <div class="question-block">
      <div class="question-number">{{ $en ? 'Question 05' : 'Question 05' }}</div>
      <p class="question-text">
        {{ $en
          ? '"The person I want to accompany — what do they need that only I can give?"'
          : '"La personne que je veux accompagner — de quoi a-t-elle besoin que seul·e moi peux lui donner ?"' }}
      </p>
      <div class="writing-lines">
        @for ($i = 0; $i < 5; $i++)
          <hr class="writing-line">
        @endfor
      </div>
    </div>

    <div class="question-block">
      <div class="question-number">{{ $en ? 'Question 06' : 'Question 06' }}</div>
      <p class="question-text">
        {{ $en
          ? '"When you are 80 years old, looking back at these seven days: what did they change?"'
          : '"Quand vous aurez 80 ans, en regardant ces sept jours : qu\'ont-ils changé ?"' }}
      </p>
      <div class="writing-lines">
        @for ($i = 0; $i < 5; $i++)
          <hr class="writing-line">
        @endfor
      </div>
    </div>
  </div>

  {{-- ═══════════════════════════════════════════════════════ --}}
  {{-- PAGE 6 — QUESTIONS JOUR 3 (Intégration · Envoi)         --}}
  {{-- ═══════════════════════════════════════════════════════ --}}
  <div class="page">
    <div class="section-overtitle">{{ $en ? 'Day 3 · Integration · Commissioning' : 'Jour 3 · Intégration · Envoi' }}</div>
    <h2 class="section-title">{{ $en ? 'Before you<br><em>leave</em>' : 'Avant de<br><em>partir</em>' }}</h2>
    <div class="section-rule"></div>

    <div class="question-block">
      <div class="question-number">{{ $en ? 'Question 07' : 'Question 07' }}</div>
      <p class="question-text">
        {{ $en
          ? '"What has shifted in you? Something you feel — even if you cannot yet name it."'
          : '"Qu\'est-ce qui a bougé en vous ? Quelque chose que vous ressentez — même si vous ne savez pas encore le nommer."' }}
      </p>
      <div class="writing-lines">
        @for ($i = 0; $i < 5; $i++)
          <hr class="writing-line">
        @endfor
      </div>
    </div>

    <div class="question-block">
      <div class="question-number">{{ $en ? 'Question 08' : 'Question 08' }}</div>
      <p class="question-text">
        {{ $en
          ? '"What is the first thing you will do when you return home?"'
          : '"Quelle est la première chose que vous ferez en rentrant chez vous ?"' }}
      </p>
      <div class="writing-lines">
        @for ($i = 0; $i < 4; $i++)
          <hr class="writing-line">
        @endfor
      </div>
    </div>

    <div class="question-block">
      <div class="question-number">{{ $en ? 'Question 09' : 'Question 09' }}</div>
      <p class="question-text">
        {{ $en
          ? '"Complete this sentence: I am no longer the same because…"'
          : '"Complétez cette phrase : Je ne suis plus le/la même parce que…"' }}
      </p>
      <div class="writing-lines">
        @for ($i = 0; $i < 4; $i++)
          <hr class="writing-line">
        @endfor
      </div>
    </div>
  </div>

  {{-- ═══════════════════════════════════════════════════════ --}}
  {{-- PAGE 7 — CARNET BLANC (pages de notes libres)           --}}
  {{-- ═══════════════════════════════════════════════════════ --}}
  <div class="page">
    <div class="section-overtitle">{{ $en ? 'Free space' : 'Espace libre' }}</div>
    <h2 class="section-title">{{ $en ? 'Your <em>notes</em>' : 'Vos <em>notes</em>' }}</h2>
    <div class="section-rule"></div>
    <p class="blank-page-note">
      {{ $en ? 'Write, draw, attach a memory. This page is yours.' : 'Écrivez, dessinez, collez un souvenir. Cette page est à vous.' }}
    </p>
    <div class="blank-lines-grid">
      @for ($i = 0; $i < 18; $i++)
        <hr class="writing-line" style="border-bottom-color: rgba(201,168,76,{{ $i % 3 === 0 ? '.35' : '.18' }});">
      @endfor
    </div>
  </div>

  {{-- ═══════════════════════════════════════════════════════ --}}
  {{-- PAGE 8 — MA PHRASE DE MISSION PERSONNELLE               --}}
  {{-- ═══════════════════════════════════════════════════════ --}}
  <div class="page">
    <div class="section-overtitle">{{ $en ? 'Your gift to the world' : 'Votre don au monde' }}</div>
    <h2 class="section-title">{{ $en ? 'My <em>personal</em><br>mission statement' : 'Ma phrase de<br><em>mission</em> personnelle' }}</h2>
    <div class="section-rule"></div>

    <p class="body-text">
      {{ $en
        ? 'In the workshop on Day 2, you will receive time to write your mission sentence. Use this page to refine it, to let it breathe, to make it yours completely.'
        : 'Lors de l\'atelier du Jour 2, vous recevrez un temps pour écrire votre phrase de mission. Utilisez cette page pour l\'affiner, la laisser respirer, l\'habiter pleinement.' }}
    </p>

    <div class="mission-frame">
      <div class="mission-frame-label">
        {{ $en ? 'My mission sentence' : 'Ma phrase de mission' }}
      </div>
      <hr class="mission-big-line">
      <hr class="mission-big-line">
      <div class="mission-sub-lines">
        @for ($i = 0; $i < 3; $i++)
          <hr class="writing-line">
        @endfor
      </div>
    </div>

    <div class="activity-grid" style="margin-top: 2.5rem;">
      <div class="activity-card">
        <div class="activity-card-label">{{ $en ? 'I accompany' : 'J\'accompagne' }}</div>
        <hr class="writing-line" style="margin-top:.5rem;">
        <hr class="writing-line">
      </div>
      <div class="activity-card">
        <div class="activity-card-label">{{ $en ? 'Through' : 'À travers' }}</div>
        <hr class="writing-line" style="margin-top:.5rem;">
        <hr class="writing-line">
      </div>
      <div class="activity-card">
        <div class="activity-card-label">{{ $en ? 'So that they can' : 'Pour qu\'ils puissent' }}</div>
        <hr class="writing-line" style="margin-top:.5rem;">
        <hr class="writing-line">
      </div>
      <div class="activity-card">
        <div class="activity-card-label">{{ $en ? 'My unique gift' : 'Mon don unique' }}</div>
        <hr class="writing-line" style="margin-top:.5rem;">
        <hr class="writing-line">
      </div>
    </div>
  </div>

  {{-- ═══════════════════════════════════════════════════════ --}}
  {{-- PAGE 9 — ATTESTATION DE PARTICIPATION                   --}}
  {{-- ═══════════════════════════════════════════════════════ --}}
  <div class="page">
    <div class="section-overtitle">{{ $en ? 'Certification' : 'Attestation' }}</div>
    <h2 class="section-title" style="margin-bottom:2rem;">{{ $en ? 'Certificate of<br><em>Participation</em>' : 'Attestation de<br><em>Participation</em>' }}</h2>

    <div class="attestation-frame">
      <div class="attestation-subtitle">
        {{ $en ? 'Pause Souffle Retreat · Junspro' : 'Retraite Pause Souffle · Junspro' }}
      </div>
      <div class="attestation-title">
        {{ $en ? 'This certifies that' : 'La présente atteste que' }}
      </div>
      <hr class="attestation-name-line">
      <p class="attestation-hint">{{ $en ? 'full name of participant' : 'nom et prénom du participant·e' }}</p>

      <p class="attestation-body">
        {{ $en
          ? 'has fully participated in the Pause Souffle Retreat, an exclusive seven-day immersion in the Mediterranean — including the six signature activities, the mission workshop, and the fire ritual of integration.'
          : 'a pleinement participé à la Retraite Pause Souffle, immersion exclusive de sept jours en Méditerranée — comprenant les six activités signature, l\'atelier Mission et le rituel de feu d\'intégration.' }}
      </p>

      <div class="attestation-date-block">
        <div class="attestation-sig-line">
          <div class="line"></div>
          <span class="attestation-sig-label">{{ $en ? 'Date' : 'Date' }}</span>
        </div>
        <div class="attestation-sig-line">
          <div class="line"></div>
          <span class="attestation-sig-label">{{ $en ? 'Facilitator signature' : 'Signature du facilitateur' }}</span>
        </div>
        <div class="attestation-sig-line">
          <div class="line"></div>
          <span class="attestation-sig-label">{{ $en ? 'Participant signature' : 'Signature participant·e' }}</span>
        </div>
      </div>
    </div>

    <p class="body-text" style="margin-top:2rem; font-size:.8rem; color:rgba(61,47,21,.5); font-style:italic; text-align:center;">
      {{ $en
        ? 'Junspro · Certified Practitioner Programme · Presence Universe'
        : 'Junspro · Formation Praticien Certifié · Univers Présence' }}
    </p>
  </div>

</div>{{-- /.livret-body --}}

</body>
</html>
