@extends('frontend.layout')

@section('pageHeading', __('Ma Pause Souffle — L\'Intégration'))

@section('style')
<style>
:root {
  --ps-gold:      #c9a84c;
  --ps-gold-l:    #e8d17a;
  --ps-gold-dim:  rgba(201,168,76,.15);
  --ps-gold-glow: rgba(201,168,76,.08);
  --ps-dark:      #0a0a0a;
  --ps-surf:      #111111;
  --ps-surf2:     #181818;
  --ps-text:      #e8e0d0;
  --ps-muted:     rgba(232,224,208,.48);
  --ps-border:    rgba(255,255,255,.07);
}

/* ════ BASE ════ */
.ps-page { min-height:100vh; background:var(--ps-dark); color:var(--ps-text); font-family:'Segoe UI',system-ui,sans-serif; padding-bottom:6rem; }

/* ════ HERO ════ */
.ps-hero {
  position:relative; overflow:hidden;
  padding:5rem 2rem 4rem; text-align:center;
  background:radial-gradient(ellipse 90% 60% at 50% -10%, rgba(201,168,76,.14) 0%, transparent 65%),
             linear-gradient(180deg,#0f0800 0%,var(--ps-dark) 100%);
  border-bottom:1px solid var(--ps-gold-dim);
}
.ps-hero__eyebrow {
  font-size:.65rem; letter-spacing:.25em; text-transform:uppercase;
  color:var(--ps-gold); margin-bottom:1.5rem;
  display:flex; align-items:center; justify-content:center; gap:1rem;
}
.ps-hero__eyebrow::before,.ps-hero__eyebrow::after {
  content:''; flex:1; max-width:60px; height:1px; background:var(--ps-gold-dim);
}
.ps-hero__title {
  font-size:clamp(2rem,5vw,3.2rem); font-weight:200; font-family:Georgia,serif;
  color:#fff; line-height:1.2; margin-bottom:1rem; letter-spacing:-.01em;
}
.ps-hero__title em { color:var(--ps-gold); font-style:italic; }
.ps-hero__sub {
  font-size:1.05rem; color:var(--ps-muted); max-width:600px; margin:0 auto 2.5rem;
  line-height:1.9; font-style:italic;
}
.ps-hero__rule {
  display:flex; align-items:center; justify-content:center; gap:1.5rem;
  background:rgba(201,168,76,.06); border:1px solid rgba(201,168,76,.2);
  border-radius:60px; padding:.9rem 2.5rem; max-width:480px; margin:0 auto;
  font-size:.82rem; color:var(--ps-text); flex-wrap:wrap; text-align:center;
}
.ps-hero__rule strong { color:var(--ps-gold); font-size:1rem; }

/* ════ SECTION TITLES ════ */
.ps-section-head {
  max-width:760px; margin:4rem auto 2rem; padding:0 2rem; text-align:center;
}
.ps-section-head__eyebrow {
  font-size:.62rem; letter-spacing:.22em; text-transform:uppercase;
  color:rgba(201,168,76,.55); margin-bottom:.75rem;
}
.ps-section-head__title {
  font-size:clamp(1.3rem,3vw,1.8rem); font-weight:300; font-family:Georgia,serif;
  color:#fff; margin-bottom:.6rem; line-height:1.35;
}
.ps-section-head__title em { color:var(--ps-gold); font-style:italic; }
.ps-section-head__sub {
  font-size:.9rem; color:var(--ps-muted); line-height:1.85; max-width:520px; margin:0 auto;
}

/* ════ PHILOSOPHIE ════ */
.ps-philo { max-width:760px; margin:0 auto; padding:0 2rem; }
.ps-philo__inner {
  display:grid; grid-template-columns:1fr 1fr; gap:1px;
  background:var(--ps-gold-dim); border:1px solid var(--ps-gold-dim);
  border-radius:20px; overflow:hidden;
}
.ps-philo__cell {
  background:var(--ps-surf); padding:2.25rem 2rem;
}
.ps-philo__cell--center {
  grid-column:1/-1; background:rgba(201,168,76,.05);
  text-align:center; padding:2rem;
}
.ps-philo__icon { font-size:1.75rem; margin-bottom:.75rem; line-height:1; }
.ps-philo__label {
  font-size:.62rem; text-transform:uppercase; letter-spacing:.16em;
  color:rgba(201,168,76,.55); margin-bottom:.5rem;
}
.ps-philo__text { font-size:.9rem; color:var(--ps-text); line-height:1.85; }
.ps-philo__text strong { color:var(--ps-gold); }
.ps-philo__axiom {
  font-size:1.1rem; font-family:Georgia,serif; font-style:italic;
  color:rgba(232,224,208,.9); line-height:1.7; max-width:540px; margin:0 auto;
}
.ps-philo__axiom em { color:var(--ps-gold); font-style:normal; }
@media(max-width:600px){ .ps-philo__inner { grid-template-columns:1fr; } }

/* ════ FAMILLES CARDS ════ */
.ps-families { max-width:760px; margin:0 auto; padding:0 2rem; display:flex; flex-direction:column; gap:.85rem; }

.ps-card {
  background:var(--ps-surf); border:1px solid var(--ps-border);
  border-radius:18px; overflow:hidden; transition:border-color .2s,transform .15s;
  cursor:default;
}
.ps-card:hover { border-color:rgba(201,168,76,.22); transform:translateY(-2px); }

.ps-card__head {
  display:flex; align-items:center; justify-content:space-between;
  padding:1.4rem 1.75rem; gap:1rem; flex-wrap:wrap;
}
.ps-card__left { display:flex; align-items:center; gap:1rem; }
.ps-card__icon {
  width:48px; height:48px; border-radius:14px; flex-shrink:0;
  display:flex; align-items:center; justify-content:center;
  font-size:1.4rem;
}
.ps-card__meta {}
.ps-card__name { font-size:1rem; font-weight:700; color:#fff; margin-bottom:.15rem; }
.ps-card__prof { font-size:.72rem; color:var(--ps-muted); line-height:1.5; }
.ps-card__tag {
  font-size:.68rem; font-weight:700; letter-spacing:.06em;
  padding:.3rem .85rem; border-radius:20px; white-space:nowrap; flex-shrink:0;
}

/* Couleurs par famille */
.ps-card--creatif  .ps-card__icon { background:rgba(168,85,247,.12); }
.ps-card--creatif  .ps-card__tag  { background:rgba(168,85,247,.12); color:#c4b5fd; border:1px solid rgba(168,85,247,.25); }
.ps-card--creatif  { border-left:3px solid rgba(168,85,247,.35); }

.ps-card--soin     .ps-card__icon { background:rgba(20,184,166,.1); }
.ps-card--soin     .ps-card__tag  { background:rgba(20,184,166,.1); color:#5eead4; border:1px solid rgba(20,184,166,.25); }
.ps-card--soin     { border-left:3px solid rgba(20,184,166,.35); }

.ps-card--corps    .ps-card__icon { background:rgba(59,130,246,.1); }
.ps-card--corps    .ps-card__tag  { background:rgba(59,130,246,.1); color:#93c5fd; border:1px solid rgba(59,130,246,.25); }
.ps-card--corps    { border-left:3px solid rgba(59,130,246,.35); }

.ps-card--leader   .ps-card__icon { background:rgba(201,168,76,.1); }
.ps-card--leader   .ps-card__tag  { background:rgba(201,168,76,.1); color:var(--ps-gold); border:1px solid rgba(201,168,76,.25); }
.ps-card--leader   { border-left:3px solid rgba(201,168,76,.4); }

.ps-card--educ     .ps-card__icon { background:rgba(34,197,94,.1); }
.ps-card--educ     .ps-card__tag  { background:rgba(34,197,94,.1); color:#86efac; border:1px solid rgba(34,197,94,.25); }
.ps-card--educ     { border-left:3px solid rgba(34,197,94,.35); }

.ps-card__body {
  padding:0 1.75rem 1.75rem;
  border-top:1px solid rgba(255,255,255,.05);
}
.ps-card__subtitle {
  font-size:.8rem; color:var(--ps-muted); font-style:italic;
  padding:.8rem 0 .6rem; line-height:1.7;
}
.ps-card__moment {
  background:rgba(0,0,0,.25); border:1px solid rgba(255,255,255,.07);
  border-radius:12px; padding:1.1rem 1.35rem; margin:.5rem 0 .75rem;
}
.ps-card__moment-label {
  font-size:.6rem; text-transform:uppercase; letter-spacing:.14em;
  color:var(--ps-muted); margin-bottom:.6rem;
}
.ps-card__moment-text {
  font-size:.875rem; color:var(--ps-text); line-height:1.85; font-style:italic;
}
.ps-card__moment-text strong { color:#fff; font-style:normal; }
.ps-card__examples {
  display:flex; flex-wrap:wrap; gap:.4rem; margin-top:.75rem;
}
.ps-card__ex {
  font-size:.72rem; color:var(--ps-muted);
  background:rgba(255,255,255,.04); border:1px solid rgba(255,255,255,.07);
  border-radius:6px; padding:.25rem .65rem;
}
.ps-card__result {
  font-size:.82rem; color:var(--ps-text); line-height:1.8; margin-top:.75rem;
  border-left:2px solid var(--ps-gold-dim); padding-left:1rem;
}
.ps-card__result em { color:var(--ps-gold); font-style:normal; }

/* ════ PROTOCOLE ════ */
.ps-proto { max-width:760px; margin:0 auto; padding:0 2rem; }
.ps-proto__inner {
  background:radial-gradient(ellipse 70% 80% at 50% 100%, rgba(201,168,76,.1), transparent 60%),
             linear-gradient(135deg, rgba(201,168,76,.05), rgba(0,0,0,.3));
  border:1.5px solid rgba(201,168,76,.25); border-radius:22px;
  padding:3rem 2.5rem;
}
.ps-proto__title {
  font-size:1.25rem; font-family:Georgia,serif; font-weight:300;
  color:#fff; text-align:center; margin-bottom:.5rem; line-height:1.45;
}
.ps-proto__sub {
  font-size:.85rem; color:var(--ps-muted); text-align:center;
  line-height:1.8; margin-bottom:2.5rem;
}
.ps-proto__steps { list-style:none; padding:0; margin:0; display:flex; flex-direction:column; gap:.75rem; }
.ps-proto__step {
  display:flex; gap:1.25rem; align-items:flex-start;
  background:rgba(0,0,0,.2); border:1px solid rgba(255,255,255,.06);
  border-radius:14px; padding:1.25rem 1.5rem;
}
.ps-proto__step-num {
  width:32px; height:32px; flex-shrink:0; border-radius:50%;
  background:rgba(201,168,76,.1); border:1px solid rgba(201,168,76,.3);
  font-size:.78rem; font-weight:800; color:var(--ps-gold);
  display:flex; align-items:center; justify-content:center;
}
.ps-proto__step-body {}
.ps-proto__step-q {
  font-size:.88rem; font-weight:600; color:#fff; margin-bottom:.35rem; line-height:1.45;
}
.ps-proto__step-hint {
  font-size:.8rem; color:var(--ps-muted); line-height:1.75; font-style:italic;
}
.ps-proto__step-hint em { color:rgba(201,168,76,.8); font-style:normal; }
.ps-proto__example {
  margin-top:2rem; background:rgba(201,168,76,.06); border:1px solid rgba(201,168,76,.18);
  border-radius:14px; padding:1.5rem;
}
.ps-proto__ex-label {
  font-size:.62rem; text-transform:uppercase; letter-spacing:.16em;
  color:rgba(201,168,76,.55); margin-bottom:1rem;
}
.ps-proto__ex-item {
  display:flex; gap:.75rem; align-items:baseline; margin-bottom:.6rem;
  font-size:.83rem; color:var(--ps-text); line-height:1.75;
}
.ps-proto__ex-item::before { content:'✦'; color:var(--ps-gold); flex-shrink:0; font-size:.65rem; }
.ps-proto__ex-item strong { color:#fff; }

/* ════ BREATH REMINDER ════ */
.ps-breath { max-width:760px; margin:3rem auto; padding:0 2rem; }
.ps-breath__inner {
  display:flex; gap:0; border:1px solid rgba(201,168,76,.2); border-radius:16px; overflow:hidden;
}
.ps-breath__step {
  flex:1; padding:1.5rem 1rem; text-align:center;
  background:rgba(201,168,76,.05); border-right:1px solid rgba(201,168,76,.12);
}
.ps-breath__step:last-child { border-right:none; }
.ps-breath__step strong { display:block; font-size:1.8rem; color:var(--ps-gold); font-weight:700; line-height:1; margin-bottom:.4rem; }
.ps-breath__step span { font-size:.65rem; color:var(--ps-muted); text-transform:uppercase; letter-spacing:.08em; }
.ps-breath__unchanged {
  max-width:760px; margin:.5rem auto 0; padding:0 2rem;
  text-align:center; font-size:.78rem; color:var(--ps-muted); font-style:italic;
}

/* ════ FINALE ════ */
.ps-finale { max-width:760px; margin:4rem auto; padding:0 2rem; }
.ps-finale__inner {
  background:radial-gradient(ellipse 80% 60% at 50% 100%, rgba(201,168,76,.12), transparent 60%),
             linear-gradient(180deg, rgba(201,168,76,.04), transparent);
  border:1px solid rgba(201,168,76,.22); border-radius:24px;
  padding:4rem 2.5rem; text-align:center;
}
.ps-finale__sym { font-size:1.3rem; opacity:.5; margin-bottom:1.5rem; letter-spacing:.3em; }
.ps-finale__title {
  font-size:clamp(1.3rem,3vw,1.9rem); font-weight:200; font-family:Georgia,serif;
  color:#fff; margin-bottom:1rem; line-height:1.4;
}
.ps-finale__title em { color:var(--ps-gold); font-style:italic; }
.ps-finale__body {
  font-size:.92rem; color:var(--ps-muted); max-width:520px; margin:0 auto 2.5rem;
  line-height:1.95;
}
.ps-finale__quote {
  font-family:Georgia,serif; font-style:italic;
  font-size:1.05rem; color:rgba(232,224,208,.8); line-height:1.85;
  border-top:1px solid rgba(201,168,76,.15); padding-top:2rem;
  max-width:480px; margin:0 auto;
}
.ps-finale__quote em { color:var(--ps-gold); font-style:normal; }

/* ════ BACK ════ */
.ps-back { max-width:760px; margin:1.5rem auto; padding:0 2rem; }
.ps-back a {
  font-size:.82rem; color:var(--ps-muted); text-decoration:none;
  display:inline-flex; align-items:center; gap:.4rem; transition:color .2s;
}
.ps-back a:hover { color:var(--ps-gold); }
</style>
@endsection

@section('content')
<div class="ps-page">

{{-- ══════ HERO ══════ --}}
<div class="ps-hero">
  <div class="ps-hero__eyebrow">Module d'intégration · Espace Formation Pause Souffle</div>
  <h1 class="ps-hero__title">
    Le 5-5-5 ne change pas.<br>
    <em>Ce qui change, c'est ce qu'il précède — et ce qu'il révèle.</em>
  </h1>
  <p class="ps-hero__sub">
    Vous avez une pratique. Un talent. Un espace que vous habitez chaque jour.<br>
    Ce module ne vous demande pas de tout recommencer.<br>
    Il vous demande d'aller plus loin dans ce que vous faites déjà.
  </p>
  <div class="ps-hero__rule">
    <span>Inspirer</span>
    <strong>5s · 5s · 5s</strong>
    <span>Retenir</span>
    <strong>×</strong>
    <span>Expirer</span>
    <strong>= Universel</strong>
  </div>
</div>

{{-- ══════ PHILOSOPHIE ══════ --}}
<div class="ps-section-head">
  <div class="ps-section-head__eyebrow">Le principe fondateur</div>
  <h2 class="ps-section-head__title">Une pratique ancrée. <em>Mille façons de la vivre.</em></h2>
  <p class="ps-section-head__sub">Le souffle est universel. Le contexte dans lequel vous l'activez — lui — vous appartient entièrement.</p>
</div>

<div class="ps-philo">
  <div class="ps-philo__inner">
    <div class="ps-philo__cell">
      <div class="ps-philo__icon">⚓</div>
      <div class="ps-philo__label">Ce qui ne change jamais</div>
      <p class="ps-philo__text">Le protocole <strong>5-5-5</strong> est identique pour le potier et le chirurgien, pour l'enfant de 7 ans et le directeur de 55 ans. Cinq secondes à inspirer. Cinq à retenir. Cinq à expirer. Sa puissance vient précisément de son invariance.</p>
    </div>
    <div class="ps-philo__cell">
      <div class="ps-philo__icon">🧭</div>
      <div class="ps-philo__label">Ce qui vous appartient</div>
      <p class="ps-philo__text"><strong>Le moment d'activation</strong> — avant de toucher l'argile, avant d'entrer en scène, avant une séance de soin, avant une réunion difficile. Ce moment devient votre signature. Personne d'autre ne l'a au même endroit que vous.</p>
    </div>
    <div class="ps-philo__cell--center">
      <p class="ps-philo__axiom">
        "Vous n'ajoutez pas le souffle à votre pratique.<br>
        Vous découvrez que <em>votre pratique attendait le souffle</em>."
      </p>
    </div>
  </div>
</div>

{{-- ══════ 5 FAMILLES ══════ --}}
<div class="ps-section-head" style="margin-top:4.5rem;">
  <div class="ps-section-head__eyebrow">5 familles · Des dizaines de pratiques</div>
  <h2 class="ps-section-head__title">Trouvez <em>votre famille.</em> Reconnaissez-vous.</h2>
  <p class="ps-section-head__sub">Chaque carte décrit le moment exact d'activation du 5-5-5 — pas une nouvelle méthode. Une greffe sur la vôtre.</p>
</div>

<div class="ps-families">

  {{-- 1 — CRÉATEURS --}}
  <div class="ps-card ps-card--creatif">
    <div class="ps-card__head">
      <div class="ps-card__left">
        <div class="ps-card__icon">🎨</div>
        <div class="ps-card__meta">
          <div class="ps-card__name">Les Créateurs</div>
          <div class="ps-card__prof">Potier · Peintre · Sculpteur · Chanteur · Musicien · Danseur · Artisan</div>
        </div>
      </div>
      <span class="ps-card__tag">Art & Création</span>
    </div>
    <div class="ps-card__body">
      <div class="ps-card__subtitle">Avant de créer, on entre. Le souffle est la porte.</div>
      <div class="ps-card__moment">
        <div class="ps-card__moment-label">Le moment d'activation</div>
        <div class="ps-card__moment-text">
          <strong>Avant de toucher la matière.</strong> Mains posées à plat sur l'établi ou l'instrument. Les yeux fermés. Un seul cycle 5-5-5. La question intérieure : <em style="color:var(--ps-gold);">"Qu'est-ce que je veux que cette œuvre traverse ?"</em> Puis on commence.
        </div>
      </div>
      <div class="ps-card__examples">
        <span class="ps-card__ex">🏺 avant de centrer l'argile</span>
        <span class="ps-card__ex">🎵 avant le premier accord</span>
        <span class="ps-card__ex">🖌️ avant le premier trait</span>
        <span class="ps-card__ex">🎤 avant d'ouvrir la bouche</span>
        <span class="ps-card__ex">🔨 avant le premier coup de ciseau</span>
      </div>
      <div class="ps-card__result">Ce que ça change : la matière reçoit votre intention <em>avant</em> votre technique. Les élèves et clients le sentent — sans pouvoir l'expliquer.</div>
    </div>
  </div>

  {{-- 2 — SOIGNANTS --}}
  <div class="ps-card ps-card--soin">
    <div class="ps-card__head">
      <div class="ps-card__left">
        <div class="ps-card__icon">🤲</div>
        <div class="ps-card__meta">
          <div class="ps-card__name">Les Soignants</div>
          <div class="ps-card__prof">Massothérapeute · Ostéopathe · Psychologue · Médecin · Infirmier · Kiné · Naturopathe</div>
        </div>
      </div>
      <span class="ps-card__tag">Soin & Présence</span>
    </div>
    <div class="ps-card__body">
      <div class="ps-card__subtitle">Vous ne pouvez pas offrir ce que vous n'habitez pas. Le 5-5-5 est votre reset entre chaque patient.</div>
      <div class="ps-card__moment">
        <div class="ps-card__moment-label">Le moment d'activation</div>
        <div class="ps-card__moment-text">
          <strong>Dans le couloir, avant d'ouvrir la porte.</strong> Trois secondes. Un cycle. Poser la main précédente. Entrer entier. Ou : en début de séance proposé <em>ensemble</em> au patient — <em style="color:var(--ps-gold);">"On commence par un souffle partagé."</em>
        </div>
      </div>
      <div class="ps-card__examples">
        <span class="ps-card__ex">🚪 avant chaque cabinet</span>
        <span class="ps-card__ex">🛁 avant de poser les mains sur le dos</span>
        <span class="ps-card__ex">💬 avant une annonce difficile</span>
        <span class="ps-card__ex">🧘 offert au patient en entrée de séance</span>
      </div>
      <div class="ps-card__result">Ce que ça change : vous ne transférez plus le stress du patient précédent. <em>Chaque personne reçoit votre meilleure présence</em> — pas ce qu'il reste de vous.</div>
    </div>
  </div>

  {{-- 3 — ENSEIGNANTS DU CORPS --}}
  <div class="ps-card ps-card--corps">
    <div class="ps-card__head">
      <div class="ps-card__left">
        <div class="ps-card__icon">🧘</div>
        <div class="ps-card__meta">
          <div class="ps-card__name">Les Enseignants du Corps</div>
          <div class="ps-card__prof">Prof de yoga · Prof de pilates · Coach sportif · Entraîneur · Prof de danse · Arts martiaux</div>
        </div>
      </div>
      <span class="ps-card__tag">Mouvement & Ancrage</span>
    </div>
    <div class="ps-card__body">
      <div class="ps-card__subtitle">Le mouvement commence dans le souffle. Pas dans le muscle.</div>
      <div class="ps-card__moment">
        <div class="ps-card__moment-label">Le moment d'activation</div>
        <div class="ps-card__moment-text">
          <strong>Les 5 premières minutes de chaque cours.</strong> Collectif. Debout ou assis. Les yeux fermés. Vous guidez les 5 cycles à voix posée. La question posée avant de commencer : <em style="color:var(--ps-gold);">"Qu'est-ce que votre corps veut vous dire aujourd'hui ? Pas ce qu'on attend de lui."</em>
        </div>
      </div>
      <div class="ps-card__examples">
        <span class="ps-card__ex">🧘 ouverture de cours collectif</span>
        <span class="ps-card__ex">🏋️ avant un effort maximal</span>
        <span class="ps-card__ex">⚔️ avant un kata, une compétition</span>
        <span class="ps-card__ex">💃 avant d'entrer en scène</span>
      </div>
      <div class="ps-card__result">Ce que ça change : les élèves entrent dans le cours — pas juste dans la salle. <em>Votre heure devient leur respiration</em>. Ils reviennent pour ça.</div>
    </div>
  </div>

  {{-- 4 — LEADERS --}}
  <div class="ps-card ps-card--leader">
    <div class="ps-card__head">
      <div class="ps-card__left">
        <div class="ps-card__icon">🏢</div>
        <div class="ps-card__meta">
          <div class="ps-card__name">Les Leaders</div>
          <div class="ps-card__prof">Chef d'entreprise · Manager · Coach · Consultant · Directeur · Entrepreneur</div>
        </div>
      </div>
      <span class="ps-card__tag">Décision & Clarté</span>
    </div>
    <div class="ps-card__body">
      <div class="ps-card__subtitle">Les meilleures décisions ne viennent pas de la vitesse. Elles viennent du calme délibéré.</div>
      <div class="ps-card__moment">
        <div class="ps-card__moment-label">Le moment d'activation</div>
        <div class="ps-card__moment-text">
          <strong>Avant chaque réunion importante — seul ou en ouverture collective.</strong> 90 secondes. Les téléphones retournés. Un cycle complet. La question : <em style="color:var(--ps-gold);">"Qu'est-ce qui compte vraiment dans les prochaines 60 minutes ?"</em>
        </div>
      </div>
      <div class="ps-card__examples">
        <span class="ps-card__ex">📊 avant un comité de direction</span>
        <span class="ps-card__ex">🤝 avant une négociation</span>
        <span class="ps-card__ex">📞 avant un appel difficile</span>
        <span class="ps-card__ex">✍️ avant de signer une décision majeure</span>
        <span class="ps-card__ex">👥 en ouverture d'équipe le lundi</span>
      </div>
      <div class="ps-card__result">Ce que ça change : vous n'entrez plus dans la pièce avec le poids de la réunion précédente. <em>Votre clarté devient contagieuse</em> — c'est ça, le leadership.</div>
    </div>
  </div>

  {{-- 5 — ÉDUCATEURS --}}
  <div class="ps-card ps-card--educ">
    <div class="ps-card__head">
      <div class="ps-card__left">
        <div class="ps-card__icon">📚</div>
        <div class="ps-card__meta">
          <div class="ps-card__name">Les Éducateurs</div>
          <div class="ps-card__prof">Maîtresse d'école · Professeur · Formateur · Éducateur spécialisé · Animateur jeunesse</div>
        </div>
      </div>
      <span class="ps-card__tag">Transmission & Ancrage</span>
    </div>
    <div class="ps-card__body">
      <div class="ps-card__subtitle">Un enfant qui respire apprend différemment. Un adulte qui enseigne calmement transforme.</div>
      <div class="ps-card__moment">
        <div class="ps-card__moment-label">Le moment d'activation</div>
        <div class="ps-card__moment-text">
          <strong>Le rituel d'entrée en classe.</strong> Chaque matin, avant la première leçon. Ensemble. Les enfants ferment les yeux, mains sur les genoux. Vous guidez 3 cycles à voix douce. Puis : <em style="color:var(--ps-gold);">"Ouvrez les yeux. Vous êtes arrivés."</em>
        </div>
      </div>
      <div class="ps-card__examples">
        <span class="ps-card__ex">🏫 rituel quotidien classe</span>
        <span class="ps-card__ex">📝 avant une évaluation importante</span>
        <span class="ps-card__ex">😤 gestion d'un conflit en classe</span>
        <span class="ps-card__ex">🎭 avant un exposé oral</span>
        <span class="ps-card__ex">🎒 rentrée et transitions difficiles</span>
      </div>
      <div class="ps-card__result">Ce que ça change : vous installez un ancrage neurologique que <em>ces enfants garderont toute leur vie</em>. C'est peut-être le seul outil que vous leur transmettrez qui n'a pas de date de péremption.</div>
    </div>
  </div>

</div>

{{-- ══════ LE SOUFFLE COMMUN ══════ --}}
<div class="ps-breath">
  <div class="ps-breath__inner">
    <div class="ps-breath__step"><strong>5</strong><span>Inspirer</span></div>
    <div class="ps-breath__step"><strong>5</strong><span>Retenir</span></div>
    <div class="ps-breath__step"><strong>5</strong><span>Expirer</span></div>
    <div class="ps-breath__step" style="background:rgba(201,168,76,.1);border:none;">
      <strong style="font-size:1.2rem;">∞</strong><span>Universel</span>
    </div>
  </div>
</div>
<p class="ps-breath__unchanged">Ce protocole est identique pour le potier, le chirurgien, la maîtresse d'école et le chef d'entreprise. C'est sa force.</p>

{{-- ══════ CONSTRUIRE SON PROTOCOLE ══════ --}}
<div class="ps-section-head" style="margin-top:4rem;">
  <div class="ps-section-head__eyebrow">Exercice d'intégration</div>
  <h2 class="ps-section-head__title">Construire <em>votre protocole personnel</em></h2>
  <p class="ps-section-head__sub">Quatre questions. Prenez le temps qu'il faut. Ce que vous écrivez ici ne ressemblera à personne d'autre.</p>
</div>

<div class="ps-proto">
  <div class="ps-proto__inner">
    <h3 class="ps-proto__title">Votre Pause Souffle à vous</h3>
    <p class="ps-proto__sub">Le 5-5-5 est la constante. Ce que vous définissez ci-dessous est votre signature.</p>

    <ul class="ps-proto__steps">
      <li class="ps-proto__step">
        <div class="ps-proto__step-num">1</div>
        <div class="ps-proto__step-body">
          <div class="ps-proto__step-q">Quelle est ma pratique principale — celle que j'habite déjà ?</div>
          <div class="ps-proto__step-hint">Pas ce que vous faites parfois. Ce que vous faites <em>naturellement</em>, même sans le décider. Le geste qui revient.</div>
        </div>
      </li>
      <li class="ps-proto__step">
        <div class="ps-proto__step-num">2</div>
        <div class="ps-proto__step-body">
          <div class="ps-proto__step-q">Quel est le moment exact — dans cette pratique — où tout bascule ?</div>
          <div class="ps-proto__step-hint">Le seuil. La porte. Le moment où l'on passe du dehors au dedans. Pour le potier : avant de toucher l'argile. Pour le chanteur : avant d'ouvrir la bouche. Pour le manager : avant d'entrer dans la salle. <em>Quel est votre seuil ?</em></div>
        </div>
      </li>
      <li class="ps-proto__step">
        <div class="ps-proto__step-num">3</div>
        <div class="ps-proto__step-body">
          <div class="ps-proto__step-q">Quelle est la question intérieure que vous poserez — juste après le dernier cycle ?</div>
          <div class="ps-proto__step-hint">Une seule question. Pas une intention générale. Une vraie question. <em>"Qu'est-ce que cette séance va transformer ?"</em> — <em>"Qu'est-ce que je veux laisser ici ce soir ?"</em> — <em>"À qui est-ce que j'offre ça aujourd'hui ?"</em></div>
        </div>
      </li>
      <li class="ps-proto__step">
        <div class="ps-proto__step-num">4</div>
        <div class="ps-proto__step-body">
          <div class="ps-proto__step-q">Comment allez-vous l'enseigner un jour à quelqu'un d'autre ?</div>
          <div class="ps-proto__step-hint">Pas dans dix ans. Dans quelques semaines, quelqu'un dans votre vie vous verra faire ça. Il vous demandera. <em>Quelle sera votre phrase d'une ligne pour expliquer ce que vous faites et pourquoi ?</em></div>
        </div>
      </li>
    </ul>

    <div class="ps-proto__example">
      <div class="ps-proto__ex-label">Exemple · La potière</div>
      <div class="ps-proto__ex-item"><strong>Pratique :</strong> Atelier de poterie, 8 élèves par session.</div>
      <div class="ps-proto__ex-item"><strong>Moment :</strong> Après que tout le monde a pris place, avant de toucher l'argile.</div>
      <div class="ps-proto__ex-item"><strong>Question intérieure :</strong> "Qu'est-ce que je veux que mes mains transmettent aujourd'hui ?"</div>
      <div class="ps-proto__ex-item"><strong>En une ligne :</strong> "Je respire avant de créer — pour que ce que je fais vienne de quelque chose de vrai."</div>
    </div>
  </div>
</div>

{{-- ══════ FINALE ══════ --}}
<div class="ps-finale">
  <div class="ps-finale__inner">
    <div class="ps-finale__sym">✦ ∞ ✦</div>
    <h2 class="ps-finale__title">
      Ce n'est pas une méthode de plus.<br>
      <em>C'est la vôtre — enfin.</em>
    </h2>
    <p class="ps-finale__body">
      Le 5-5-5 que vous avez appris appartient à tout le monde.<br>
      Le Pause Souffle que vous venez de construire n'appartient qu'à vous.<br><br>
      Il a votre geste. Votre moment. Votre question.<br>
      Il ressemble à personne d'autre — parce que vous ne ressemblez à personne d'autre.
    </p>
    <div class="ps-finale__quote">
      "J'ai couru très longtemps.<br>
      J'ai tout arrêté.<br>
      Et c'est là que j'ai trouvé —<br>
      <em>et infiniment plus.</em>"
    </div>
  </div>
</div>

<div class="ps-back">
  <a href="{{ route('formation.dashboard') }}">
    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M19 12H5M5 12l7-7M5 12l7 7"/></svg>
    Retour à mon espace formation
  </a>
</div>

</div>
@endsection
