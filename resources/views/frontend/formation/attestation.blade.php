@extends('frontend.layout')

@section('pageHeading', 'Attestation Praticien Pause Souffle')

@section('style')
<style>
/* ══════════════════════════════════════════════════════
  ATTESTATION — FORMATION PRATICIEN PAUSE SOUFFLE
   Design cérémoniel : parchemin doré sur fond sombre
   ══════════════════════════════════════════════════════ */
:root {
  --gold:   #c9a84c;
  --gold-l: #e8d17a;
  --dark:   #080808;
  --text:   #e8e0d0;
  --muted:  rgba(232,224,208,.55);
}

body { background: var(--dark); }

.att-page {
  min-height: 100vh;
  display: flex; flex-direction: column; align-items: center;
  justify-content: flex-start;
  padding: 3rem 1.5rem 5rem;
  background: radial-gradient(ellipse 100% 60% at 50% 0%, rgba(201,168,76,.06) 0%, transparent 70%),
              linear-gradient(180deg, #0e0907 0%, #080808 100%);
}

.att-back {
  align-self: flex-start;
  display: flex; align-items: center; gap: .5rem;
  color: var(--muted); font-size: .82rem; text-decoration: none;
  margin-bottom: 2.5rem; transition: color .2s;
}
.att-back:hover { color: var(--text); }

/* ── Le parchemin ── */
.att-certificate {
  width: 100%; max-width: 760px;
  background: linear-gradient(160deg, #1a1306 0%, #0f0d07 50%, #14100a 100%);
  border: 2px solid var(--gold);
  border-radius: 20px;
  padding: 4rem 4rem 3.5rem;
  position: relative;
  box-shadow: 0 0 80px rgba(201,168,76,.12), 0 0 200px rgba(201,168,76,.04);
}

/* Coins décoratifs */
.att-certificate::before,
.att-certificate::after {
  content: '';
  position: absolute; width: 60px; height: 60px;
  border-color: var(--gold); border-style: solid;
  opacity: .35;
}
.att-certificate::before { top: 14px; left: 14px; border-width: 2px 0 0 2px; border-radius: 6px 0 0 0; }
.att-certificate::after  { bottom: 14px; right: 14px; border-width: 0 2px 2px 0; border-radius: 0 0 6px 0; }

/* Médaillons coins bas-gauche et haut-droit */
.att-corner-br, .att-corner-tl {
  position: absolute; width: 60px; height: 60px;
  border-color: var(--gold); border-style: solid; opacity: .35;
}
.att-corner-tl { top: 14px; right: 14px; border-width: 2px 2px 0 0; border-radius: 0 6px 0 0; }
.att-corner-br { bottom: 14px; left: 14px; border-width: 0 0 2px 2px; border-radius: 0 0 0 6px; }

/* Contenu */
.att-inner { text-align: center; position: relative; z-index: 1; }

.att-logo {
  font-size: 3rem; margin-bottom: .5rem; display: block; line-height: 1;
  filter: drop-shadow(0 0 20px rgba(201,168,76,.4));
}
.att-brand {
  font-size: .72rem; letter-spacing: .22em; text-transform: uppercase;
  color: var(--gold); margin-bottom: 2.5rem;
}
.att-certifie {
  font-size: .8rem; letter-spacing: .2em; text-transform: uppercase;
  color: var(--muted); margin-bottom: .6rem;
}
.att-name {
  font-size: clamp(2rem, 6vw, 3rem);
  font-weight: 300; font-style: italic;
  color: var(--gold-l); line-height: 1.2; margin: .2rem 0 1.5rem;
  text-shadow: 0 0 40px rgba(232,209,122,.25);
}
.att-text {
  font-size: .92rem; color: var(--muted); line-height: 1.9;
  max-width: 500px; margin: 0 auto 1.75rem;
}
.att-text strong { color: var(--text); font-weight: 600; }

/* Séparateur décoratif */
.att-ornament {
  display: flex; align-items: center; gap: 1rem;
  justify-content: center; margin: 1.75rem 0;
  color: var(--gold); font-size: 1.1rem; opacity: .5;
}
.att-ornament::before, .att-ornament::after {
  content: ''; flex: 1; max-width: 100px; height: 1px; background: var(--gold); opacity: .4;
}

/* Code attestation */
.att-code-block {
  background: rgba(201,168,76,.06);
  border: 1px solid rgba(201,168,76,.2);
  border-radius: 10px;
  padding: 1rem 1.5rem;
  margin: 0 auto 1.75rem;
  display: inline-block;
}
.att-code-label { font-size: .7rem; letter-spacing: .15em; text-transform: uppercase; color: var(--muted); margin-bottom: .3rem; }
.att-code {
  font-family: 'Courier New', monospace;
  font-size: 1.1rem; font-weight: 700;
  color: var(--gold); letter-spacing: .18em;
}

/* Date */
.att-date {
  font-size: .8rem; color: var(--muted); margin-bottom: 2rem;
}

/* Signature */
.att-signature-zone {
  display: flex; justify-content: center; gap: 4rem; flex-wrap: wrap;
  margin-top: 1.5rem;
}
.att-signature {
  text-align: center;
}
.att-signature-line {
  width: 140px; height: 1px; background: rgba(201,168,76,.3); margin: 0 auto .5rem;
}
.att-signature-name { font-size: .8rem; color: var(--text); font-weight: 600; }
.att-signature-role { font-size: .7rem; color: var(--muted); }

/* Phrase fondatrice */
.att-quote {
  margin-top: 2.5rem;
  font-size: .88rem; font-style: italic;
  color: rgba(232,209,122,.5);
  line-height: 1.7;
}

/* Boutons d'action */
.att-actions {
  display: flex; flex-direction: column; align-items: center; gap: 1rem;
  margin-top: 2.5rem;
}
.att-btn {
  display: inline-flex; align-items: center; gap: .6rem;
  padding: .85rem 2rem; border-radius: 12px;
  font-size: .9rem; font-weight: 600; cursor: pointer;
  transition: all .2s; text-decoration: none;
}
.att-btn--print {
  background: linear-gradient(135deg, var(--gold), #a07820);
  color: #1a0e00; border: none;
}
.att-btn--print:hover { box-shadow: 0 6px 20px rgba(201,168,76,.3); transform: translateY(-1px); }
.att-btn--dash {
  background: transparent;
  border: 1.5px solid rgba(255,255,255,.15); color: var(--muted);
}
.att-btn--dash:hover { border-color: var(--gold); color: var(--text); }

.att-share-tip {
  font-size: .78rem; color: var(--muted); text-align: center;
  max-width: 400px;
}

@media print {
  .att-back, .att-actions { display: none !important; }
  body { background: #fff !important; }
  .att-page { background: #fff !important; padding: 0 !important; }
  .att-certificate {
    border: 2px solid #c9a84c !important;
    box-shadow: none !important;
    color: #1a1306 !important;
    background: #fffef8 !important;
    border-radius: 0 !important;
    padding: 4cm 4cm 3.5cm !important;
    max-width: 100% !important;
  }
  .att-name { color: #a07820 !important; text-shadow: none !important; }
  .att-brand, .att-certifie, .att-code { color: #8b6914 !important; }
  .att-text, .att-date, .att-quote, .att-muted { color: #4a4436 !important; }
}

@media (max-width: 640px) {
  .att-certificate { padding: 2.5rem 1.75rem 2rem; }
  .att-signature-zone { gap: 2rem; }
}
</style>
@endsection

@section('content')
@php
  $firstName = $user->first_name ?? $user->name ?? 'Praticien';
  $lastName  = $user->last_name ?? '';
  $fullName  = trim($firstName . ' ' . $lastName) ?: $user->email;
  $certDate  = $enrollment->attestation_issued_at
    ? \Carbon\Carbon::parse($enrollment->attestation_issued_at)->locale('fr')->isoFormat('D MMMM YYYY')
    : \Carbon\Carbon::parse($enrollment->updated_at)->locale('fr')->isoFormat('D MMMM YYYY');
@endphp

<div class="att-page">

  <a href="{{ route('formation.dashboard') }}" class="att-back">
    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M19 12H5M12 5l-7 7 7 7"/></svg>
    Retour à mon espace
  </a>

  <div class="att-certificate" id="attestation-cert">
    <div class="att-corner-tl"></div>
    <div class="att-corner-br"></div>

    <div class="att-inner">
      <span class="att-logo">∞+</span>
      <div class="att-brand">Junspro · Formation certifiante</div>

      <div class="att-certifie">Certifie que</div>
      <div class="att-name">{{ $fullName }}</div>

      <p class="att-text">
        a suivi et complété avec succès la formation<br>
        <strong>« Praticien Pause Souffle »</strong><br>
        Parcours + pratique professionnelle · Attestation certifiante
      </p>

      <div class="att-ornament">✦</div>

      <p class="att-text" style="font-size:.82rem; font-style:italic; color:rgba(232,224,208,.5);">
        Cette formation est reconnue par la plateforme Junspro et atteste<br>
        d'une maîtrise des outils du Rituel Pause Souffle,<br>
        de la respiration consciente et de l'accompagnement de personnes.
      </p>

      <div class="att-date">Délivré le {{ $certDate }}</div>

      @if($enrollment->attestation_code)
      <div class="att-code-block">
        <div class="att-code-label">Code de vérification</div>
        <div class="att-code">{{ $enrollment->attestation_code }}</div>
      </div>
      @endif

      <div class="att-signature-zone">
        <div class="att-signature">
          <div class="att-signature-line"></div>
          <div class="att-signature-name">Jésula Junspro</div>
          <div class="att-signature-role">Fondatrice · Junspro</div>
        </div>
        <div class="att-signature">
          <div class="att-signature-line"></div>
          <div class="att-signature-name">{{ $fullName }}</div>
          <div class="att-signature-role">Praticien Pause Souffle</div>
        </div>
      </div>

      <div class="att-quote">
        « J'ai couru très longtemps. J'ai tout arrêté.<br>
        Et c'est là que j'ai tout trouvé — et infiniment plus. »
      </div>
    </div>
  </div>

  <div class="att-actions">
    <button onclick="window.print()" class="att-btn att-btn--print">
      <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 6 2 18 2 18 9"/><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"/><rect x="6" y="14" width="12" height="8"/></svg>
      Imprimer / Enregistrer en PDF
    </button>
    <a href="{{ route('formation.dashboard') }}" class="att-btn att-btn--dash">
      <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M19 12H5M12 5l-7 7 7 7"/></svg>
      Retour au tableau de bord
    </a>
    <p class="att-share-tip">
      💡 Astuce : via "Imprimer", sélectionnez « Enregistrer en PDF » dans votre navigateur pour télécharger votre attestation officielle.
    </p>
  </div>

</div>
@endsection
