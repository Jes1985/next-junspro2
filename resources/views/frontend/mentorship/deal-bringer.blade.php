@extends('frontend.layout')

@section('pageHeading')
  J'apporte un projet — Bonus Apporteur Junspro
@endsection

@section('metaDescription')
  Vous avez trouvé un client ? Déclarez votre projet et bénéficiez d'un bonus de +10 % sur votre rémunération. Formulaire de déclaration apporteur Junspro.
@endsection

@section('style')
<style>
:root {
  --db-gold:    #f59e0b;
  --db-gold-lt: #fffbeb;
  --db-green:   #10b981;
  --db-dark:    #0f172a;
  --db-card-bg: #fff;
  --db-shadow:  0 8px 40px rgba(15,23,42,.08);
}

* { box-sizing: border-box; }

.db-page { background: #f8fafc; min-height: 100vh; padding: 0 0 5rem; font-family: inherit; }

/* ── Hero ───────────────────────────────────────────────── */
.db-hero {
  background: linear-gradient(135deg, #0f172a 0%, #1e1b4b 50%, #0f172a 100%);
  padding: 5rem 2rem 3.5rem;
  text-align: center;
  position: relative;
  overflow: hidden;
}
.db-hero::before {
  content: '';
  position: absolute; inset: 0;
  background: radial-gradient(ellipse at 30% 50%, rgba(245,158,11,.12) 0%, transparent 60%),
              radial-gradient(ellipse at 70% 30%, rgba(124,58,237,.1) 0%, transparent 55%);
  pointer-events: none;
}
.db-hero__badge {
  display: inline-flex; align-items: center; gap: .5rem;
  background: rgba(245,158,11,.15); border: 1px solid rgba(245,158,11,.35);
  border-radius: 999px; padding: .35rem 1rem;
  font-size: .75rem; font-weight: 700; letter-spacing: .1em; text-transform: uppercase;
  color: #fcd34d; margin-bottom: 1.25rem;
}
.db-hero__title {
  font-size: clamp(1.75rem, 4vw, 2.75rem); font-weight: 900; color: #fff;
  line-height: 1.2; margin-bottom: 1rem;
}
.db-hero__title .accent {
  background: linear-gradient(135deg, #f59e0b, #fcd34d);
  -webkit-background-clip: text; -webkit-text-fill-color: transparent;
}
.db-hero__sub {
  font-size: 1rem; color: rgba(255,255,255,.7); max-width: 560px; margin: 0 auto 2rem;
  line-height: 1.65;
}
.db-hero__rates {
  display: flex; justify-content: center; gap: 1.5rem; flex-wrap: wrap;
  margin-bottom: 2.5rem;
}
.db-hero__rate {
  background: rgba(255,255,255,.07); border: 1px solid rgba(255,255,255,.12);
  border-radius: 16px; padding: 1rem 1.5rem; min-width: 140px;
}
.db-hero__rate-lbl { font-size: .7rem; font-weight: 700; text-transform: uppercase;
  letter-spacing: .1em; color: rgba(255,255,255,.5); margin-bottom: .35rem; }
.db-hero__rate-pct { font-size: 1.5rem; font-weight: 900; color: #fff; }
.db-hero__rate-sub { font-size: .72rem; color: var(--db-gold); font-weight: 600; margin-top: .2rem; }

/* ── Bonus meter ─────────────────────────────────────────── */
.db-bonus-strip {
  background: linear-gradient(90deg, #064e3b, #065f46, #064e3b);
  padding: 1rem 2rem;
  display: flex; align-items: center; justify-content: center; gap: 1rem; flex-wrap: wrap;
  font-size: .88rem; color: #6ee7b7; font-weight: 600; text-align: center;
}
.db-bonus-strip strong { color: #fff; }
.db-bonus-chip {
  background: rgba(16,185,129,.25); border: 1px solid rgba(16,185,129,.4);
  border-radius: 999px; padding: .2rem .75rem;
  font-size: .75rem; font-weight: 800; color: #34d399;
}

/* ── Wizard container ────────────────────────────────────── */
.db-wizard-wrap {
  max-width: 820px; margin: 2.5rem auto 0; padding: 0 1.5rem;
}

/* Stepper */
.db-stepper {
  display: flex; justify-content: center; gap: 0;
  background: var(--db-card-bg);
  border-radius: 20px 20px 0 0;
  box-shadow: 0 -4px 20px rgba(0,0,0,.04);
  overflow: hidden;
  border-bottom: 2px solid #f1f5f9;
}
.db-stepper__item {
  flex: 1; padding: .9rem .5rem; text-align: center; position: relative;
  cursor: default; transition: background .2s;
}
.db-stepper__item.is-done   { background: #f0fdf4; }
.db-stepper__item.is-active { background: var(--db-gold-lt); }
.db-stepper__num {
  width: 28px; height: 28px; border-radius: 999px;
  display: inline-flex; align-items: center; justify-content: center;
  font-size: .75rem; font-weight: 800; margin-bottom: .3rem;
  background: #e2e8f0; color: #64748b;
}
.db-stepper__item.is-done   .db-stepper__num { background: var(--db-green); color: #fff; }
.db-stepper__item.is-active .db-stepper__num { background: var(--db-gold); color: #fff; }
.db-stepper__lbl { font-size: .68rem; font-weight: 700; text-transform: uppercase;
  letter-spacing: .08em; color: #94a3b8; display: block; }
.db-stepper__item.is-active .db-stepper__lbl { color: #92400e; }
.db-stepper__item.is-done   .db-stepper__lbl { color: #065f46; }
.db-stepper__connector {
  position: absolute; top: 50%; right: 0;
  width: 2px; height: 40%; background: #e2e8f0;
  transform: translateY(-50%);
}

/* Card step */
.db-card {
  background: var(--db-card-bg);
  border-radius: 0 0 20px 20px;
  box-shadow: var(--db-shadow);
  overflow: hidden;
}
.db-step { display: none; }
.db-step.is-active { display: block; animation: dbFade .3s ease; }
@keyframes dbFade { from { opacity:0; transform:translateY(10px); } to { opacity:1; transform:translateY(0); } }

.db-step-body { padding: 2.5rem 2.5rem 2rem; }
.db-step-eyebrow {
  font-size: .7rem; font-weight: 700; text-transform: uppercase; letter-spacing: .1em;
  color: var(--db-gold); margin-bottom: .5rem;
}
.db-step-title { font-size: 1.25rem; font-weight: 800; color: var(--db-dark); margin-bottom: .35rem; }
.db-step-sub { font-size: .88rem; color: #64748b; margin-bottom: 1.75rem; line-height: 1.55; }

/* Profile cards (step 1) */
.db-profile-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; margin-bottom: 1.75rem; }
.db-profile-card {
  border: 2px solid #e2e8f0; border-radius: 16px; padding: 1.5rem;
  cursor: pointer; transition: all .22s; text-align: center; background: #fafafa;
  position: relative;
}
.db-profile-card:hover { transform: translateY(-3px); border-color: #cbd5e1; }
.db-profile-card.is-selected { border-color: var(--db-gold); background: var(--db-gold-lt);
  box-shadow: 0 0 0 3px rgba(245,158,11,.18); }
.db-profile-card.is-selected[data-profile="intern"]  { border-color: #0d9488; background: #f0fdfa;
  box-shadow: 0 0 0 3px rgba(13,148,136,.15); }
.db-profile-card.is-selected[data-profile="junior"]  { border-color: #2563eb; background: #eff6ff;
  box-shadow: 0 0 0 3px rgba(37,99,235,.15); }
.db-profile-card__icon { font-size: 2.5rem; margin-bottom: .75rem; }
.db-profile-card__title { font-size: 1rem; font-weight: 800; color: var(--db-dark); }
.db-profile-card__desc  { font-size: .8rem; color: #64748b; margin-top: .3rem; line-height: 1.45; }
.db-profile-card__rates {
  margin-top: .9rem; padding: .65rem; background: rgba(0,0,0,.04); border-radius: 10px;
  font-size: .78rem;
}
.db-profile-card__rate-row { display: flex; justify-content: space-between; padding: .15rem 0; }
.db-profile-card__rate-name { color: #64748b; }
.db-profile-card__rate-val  { font-weight: 700; }
.db-profile-card .db-check-badge {
  position: absolute; top: .75rem; right: .75rem;
  width: 22px; height: 22px; border-radius: 999px; background: #e2e8f0;
  display: flex; align-items: center; justify-content: center;
  font-size: .7rem; font-weight: 800; color: transparent; transition: all .2s;
}
.db-profile-card.is-selected .db-check-badge {
  background: var(--db-green); color: #fff;
}

/* Form fields */
.db-form-grid  { display: grid; grid-template-columns: 1fr 1fr; gap: 1rem 1.25rem; margin-bottom: 1.75rem; }
.db-form-full  { grid-column: 1 / -1; }
.db-form-group { display: flex; flex-direction: column; gap: .4rem; }
.db-form-label { font-size: .78rem; font-weight: 700; color: #374151; }
.db-form-label span { color: #ef4444; margin-left: .2rem; }
.db-form-input, .db-form-select, .db-form-textarea {
  border: 2px solid #e2e8f0; border-radius: 12px; padding: .7rem 1rem;
  font-size: .9rem; color: var(--db-dark); background: #fafafa;
  transition: border-color .2s, box-shadow .2s; font-family: inherit; width: 100%;
}
.db-form-input:focus, .db-form-select:focus, .db-form-textarea:focus {
  outline: none; border-color: var(--db-gold);
  box-shadow: 0 0 0 3px rgba(245,158,11,.12);
  background: #fff;
}
.db-form-textarea { resize: vertical; min-height: 110px; }
.db-form-hint { font-size: .73rem; color: #94a3b8; margin-top: .15rem; }

/* How-found chips */
.db-how-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: .65rem; }
.db-how-chip {
  border: 2px solid #e2e8f0; border-radius: 12px; padding: .65rem .75rem;
  cursor: pointer; text-align: center; transition: all .2s; background: #fafafa;
  font-size: .78rem; font-weight: 600; color: #475569;
}
.db-how-chip:hover       { border-color: #94a3b8; background: #f8fafc; }
.db-how-chip.is-selected { border-color: var(--db-gold); background: var(--db-gold-lt);
  color: #92400e; }

/* Summary (step 4) */
.db-summary { }
.db-summary-section { margin-bottom: 1.5rem; }
.db-summary-section h5 {
  font-size: .72rem; font-weight: 700; text-transform: uppercase; letter-spacing: .1em;
  color: #94a3b8; margin-bottom: .65rem; border-bottom: 1px solid #f1f5f9; padding-bottom: .4rem;
}
.db-summary-row { display: flex; gap: .75rem; padding: .35rem 0; }
.db-summary-lbl { font-size: .8rem; color: #64748b; min-width: 120px; flex-shrink: 0; }
.db-summary-val { font-size: .85rem; font-weight: 600; color: var(--db-dark); flex: 1; }

/* Bonus preview box */
.db-bonus-preview {
  background: linear-gradient(135deg, #064e3b, #065f46);
  border-radius: 16px; padding: 1.5rem; margin: 1.5rem 0;
  color: #fff;
}
.db-bonus-preview h4 {
  font-size: .88rem; font-weight: 800; color: #a7f3d0; margin-bottom: .75rem;
  text-transform: uppercase; letter-spacing: .08em;
}
.db-bonus-preview-table { width: 100%; border-collapse: collapse; }
.db-bonus-preview-table th {
  font-size: .7rem; font-weight: 700; text-transform: uppercase; letter-spacing: .08em;
  color: rgba(255,255,255,.5); padding: .35rem .5rem; text-align: left;
}
.db-bonus-preview-table td {
  padding: .45rem .5rem; font-size: .85rem;
}
.db-bonus-preview-table tr:not(:last-child) td { border-bottom: 1px solid rgba(255,255,255,.08); }
.db-bonus-std  { color: rgba(255,255,255,.6); }
.db-bonus-deal { color: #34d399; font-weight: 800; }
.db-bonus-delta { color: #6ee7b7; font-size: .72rem; font-weight: 700; }

/* Navigation bar */
.db-nav {
  display: flex; justify-content: space-between; align-items: center;
  padding: 1.25rem 2.5rem 2rem;
  border-top: 1px solid #f1f5f9;
}
.db-btn { border: none; cursor: pointer; font-weight: 700; font-family: inherit;
  border-radius: 12px; transition: all .2s; display: inline-flex; align-items: center; gap: .5rem; }
.db-btn-back {
  background: #f1f5f9; color: #475569; padding: .7rem 1.4rem; font-size: .88rem;
}
.db-btn-back:hover { background: #e2e8f0; }
.db-btn-next {
  background: var(--db-gold); color: #fff; padding: .75rem 1.75rem; font-size: .92rem;
  box-shadow: 0 4px 14px rgba(245,158,11,.35);
}
.db-btn-next:hover { background: #d97706; }
.db-btn-submit {
  background: linear-gradient(135deg, #059669, #10b981); color: #fff;
  padding: .8rem 2rem; font-size: .95rem;
  box-shadow: 0 4px 20px rgba(16,185,129,.35);
}
.db-btn-submit:hover { opacity: .92; }
.db-btn:disabled { opacity: .4; cursor: not-allowed; }

/* Error messages */
.db-error { background: #fef2f2; border: 1px solid #fca5a5; border-radius: 12px;
  padding: 1rem 1.25rem; margin-bottom: 1.5rem; }
.db-error ul { margin: 0; padding-left: 1.2rem; font-size: .85rem; color: #b91c1c; }

/* Success message */
.db-success { background: #f0fdf4; border: 2px solid #6ee7b7; border-radius: 14px;
  padding: 1.5rem; margin-bottom: 2rem; text-align: center; }
.db-success__icon { font-size: 2.5rem; margin-bottom: .5rem; }
.db-success h3 { font-size: 1.15rem; font-weight: 800; color: #065f46; margin-bottom: .4rem; }
.db-success p  { font-size: .88rem; color: #047857; line-height: 1.55; }

/* History */
.db-history { max-width: 820px; margin: 2.5rem auto 0; padding: 0 1.5rem; }
.db-history__title { font-size: .9rem; font-weight: 800; color: var(--db-dark); margin-bottom: 1rem; }
.db-history-card {
  background: #fff; border-radius: 14px; padding: 1rem 1.5rem;
  box-shadow: 0 2px 12px rgba(0,0,0,.05); margin-bottom: .75rem;
  display: flex; align-items: center; gap: 1rem; flex-wrap: wrap;
}
.db-history-card__badge {
  font-size: .7rem; font-weight: 700; border-radius: 999px;
  padding: .2rem .65rem; white-space: nowrap;
}
.db-history-card__title { font-size: .9rem; font-weight: 700; color: var(--db-dark); flex: 1; }
.db-history-card__meta  { font-size: .75rem; color: #94a3b8; }

/* Responsive */
@media(max-width: 640px) {
  .db-profile-grid { grid-template-columns: 1fr; }
  .db-form-grid    { grid-template-columns: 1fr; }
  .db-how-grid     { grid-template-columns: repeat(2, 1fr); }
  .db-step-body    { padding: 1.5rem; }
  .db-nav          { padding: 1rem 1.5rem 1.5rem; }
  .db-hero { padding: 3.5rem 1.25rem 2.5rem; }
  .db-hero__rates  { gap: .75rem; }
  .db-wizard-wrap  { padding: 0 1rem; }
  .db-stepper__lbl { display: none; }
}
</style>
@endsection

@section('content')

@php
  $rates = [
    ['level' => 'Débutant',      'std_intern' => $stdIntern['beginner'],     'deal_intern' => $internRates['beginner'],     'std_junior' => $stdJunior['beginner'],     'deal_junior' => $juniorRates['beginner']],
    ['level' => 'Intermédiaire', 'std_intern' => $stdIntern['intermediate'], 'deal_intern' => $internRates['intermediate'], 'std_junior' => $stdJunior['intermediate'], 'deal_junior' => $juniorRates['intermediate']],
    ['level' => 'Avancé',        'std_intern' => $stdIntern['advanced'],     'deal_intern' => $internRates['advanced'],     'std_junior' => $stdJunior['advanced'],     'deal_junior' => $juniorRates['advanced']],
  ];
@endphp

<div class="db-page">

  {{-- ═══════════════════ HERO ═══════════════════ --}}
  <section class="db-hero">
    <div class="db-hero__badge">💼 Bonus Apporteur de Mission</div>
    <h1 class="db-hero__title">
      Vous avez trouvé un client ?<br>
      <span class="accent">Déclarez-le et gagnez plus.</span>
    </h1>
    <p class="db-hero__sub">
      Chaque mission que vous apportez à la plateforme vous vaut un bonus de
      <strong style="color:#fcd34d;">+10 %</strong> sur votre rémunération — validé par votre mentor,
      anti-abus garanti.
    </p>

    <div class="db-hero__rates">
      @foreach($rates as $r)
      <div class="db-hero__rate">
        <div class="db-hero__rate-lbl">{{ $r['level'] }}</div>
        <div class="db-hero__rate-pct">+10 %</div>
        <div class="db-hero__rate-sub">
          Stage : {{ $r['std_intern'] }} → {{ $r['deal_intern'] }} %&nbsp;&nbsp;
          Junior : {{ $r['std_junior'] }} → {{ $r['deal_junior'] }} %
        </div>
      </div>
      @endforeach
    </div>

    <a href="#formulaire" class="db-btn db-btn-next" style="font-size:1rem; padding:.85rem 2.25rem;">
      🤝 Déclarer mon projet maintenant
    </a>
  </section>

  {{-- ═══════════════════ STRIP ═══════════════════ --}}
  <div class="db-bonus-strip">
    <span>🎯 <strong>Comment ça marche :</strong> vous remplissez le formulaire en 3 min</span>
    <span class="db-bonus-chip">→</span>
    <span>⏳ <strong>Votre mentor valide</strong> en 48h max</span>
    <span class="db-bonus-chip">→</span>
    <span>💰 <strong>Le bonus +10 %</strong> est appliqué sur cette mission</span>
  </div>

  {{-- ═══════════════════ WIZARD ═══════════════════ --}}
  <div class="db-wizard-wrap" id="formulaire">

    @if(session('success'))
    <div class="db-success" style="margin-top:2.5rem;">
      <div class="db-success__icon">🎉</div>
      <h3>Déclaration envoyée !</h3>
      <p>{{ session('success') }}</p>
    </div>
    @endif

    @if($errors->any())
    <div class="db-error" style="margin-top:2rem;">
      <ul>@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
    </div>
    @endif

    {{-- Stepper --}}
    <div class="db-stepper" id="db-stepper">
      <div class="db-stepper__item is-active" data-step="1">
        <div class="db-stepper__num">1</div>
        <span class="db-stepper__lbl">Profil</span>
        <div class="db-stepper__connector"></div>
      </div>
      <div class="db-stepper__item" data-step="2">
        <div class="db-stepper__num">2</div>
        <span class="db-stepper__lbl">Le client</span>
        <div class="db-stepper__connector"></div>
      </div>
      <div class="db-stepper__item" data-step="3">
        <div class="db-stepper__num">3</div>
        <span class="db-stepper__lbl">La mission</span>
        <div class="db-stepper__connector"></div>
      </div>
      <div class="db-stepper__item" data-step="4">
        <div class="db-stepper__num">4</div>
        <span class="db-stepper__lbl">Récap & bonus</span>
      </div>
    </div>

    <div class="db-card">
      <form method="POST" action="{{ route('mentorship.deal-bringer.submit') }}" id="db-form">
        @csrf
        <input type="hidden" name="profile_type" id="db-profile-input" value="">
        <input type="hidden" name="how_found"    id="db-how-found-input" value="">

        {{-- ════════ STEP 1 — PROFIL ════════ --}}
        <div class="db-step is-active" data-step="1">
          <div class="db-step-body">
            <div class="db-step-eyebrow">Étape 1 / 4</div>
            <h2 class="db-step-title">Quel est votre profil ?</h2>
            <p class="db-step-sub">Votre statut détermine le taux bonus qui s'appliquera une fois votre déclaration validée.</p>

            <div class="db-profile-grid">
              <div class="db-profile-card" data-profile="intern" onclick="dbSelectProfile('intern', this)">
                <div class="db-check-badge">✓</div>
                <div class="db-profile-card__icon">🎓</div>
                <div class="db-profile-card__title">Je suis Stagiaire</div>
                <div class="db-profile-card__desc">Encore en formation — je cherche des missions encadrées par un mentor.</div>
                <div class="db-profile-card__rates">
                  @foreach($rates as $r)
                  <div class="db-profile-card__rate-row">
                    <span class="db-profile-card__rate-name">{{ $r['level'] }}</span>
                    <span class="db-profile-card__rate-val" style="color:#0d9488;">
                      {{ $r['std_intern'] }} → <strong>{{ $r['deal_intern'] }} %</strong>
                    </span>
                  </div>
                  @endforeach
                </div>
              </div>

              <div class="db-profile-card" data-profile="junior" onclick="dbSelectProfile('junior', this)">
                <div class="db-check-badge">✓</div>
                <div class="db-profile-card__icon">🚀</div>
                <div class="db-profile-card__title">Je suis Freelance Junior</div>
                <div class="db-profile-card__desc">Diplômé — je facture mes premières missions en autonomie guidée.</div>
                <div class="db-profile-card__rates">
                  @foreach($rates as $r)
                  <div class="db-profile-card__rate-row">
                    <span class="db-profile-card__rate-name">{{ $r['level'] }}</span>
                    <span class="db-profile-card__rate-val" style="color:#2563eb;">
                      {{ $r['std_junior'] }} → <strong>{{ $r['deal_junior'] }} %</strong>
                    </span>
                  </div>
                  @endforeach
                </div>
              </div>
            </div>
          </div>

          <div class="db-nav">
            <span></span>
            <button type="button" class="db-btn db-btn-next" id="db-next-1" disabled onclick="dbGoStep(2)">
              Continuer →
            </button>
          </div>
        </div>

        {{-- ════════ STEP 2 — LE CLIENT ════════ --}}
        <div class="db-step" data-step="2">
          <div class="db-step-body">
            <div class="db-step-eyebrow">Étape 2 / 4</div>
            <h2 class="db-step-title">Parlez-nous de votre contact</h2>
            <p class="db-step-sub">Ces informations permettent à votre mentor de vérifier que vous avez effectivement apporté ce projet.</p>

            <div class="db-form-grid">
              <div class="db-form-group">
                <label class="db-form-label">Nom du contact<span>*</span></label>
                <input type="text" class="db-form-input" name="contact_name" id="db-contact-name"
                       placeholder="Jean Dupont" value="{{ old('contact_name') }}" required>
              </div>
              <div class="db-form-group">
                <label class="db-form-label">Email du contact</label>
                <input type="email" class="db-form-input" name="contact_email"
                       placeholder="jean@entreprise.com" value="{{ old('contact_email') }}">
              </div>
              <div class="db-form-group">
                <label class="db-form-label">Entreprise / Client</label>
                <input type="text" class="db-form-input" name="contact_company"
                       placeholder="Ex : Startup Lyon SAS" value="{{ old('contact_company') }}">
              </div>
              <div class="db-form-group">
                <label class="db-form-label">Secteur d'activité</label>
                <select class="db-form-select" name="sector">
                  <option value="">— Choisir —</option>
                  @foreach(['E-commerce','SaaS / Tech','Agence digitale','Santé','Éducation','Finance / Fintech','Immobilier','Médias / Communication','Retail / Distribution','Autre'] as $s)
                  <option value="{{ $s }}" {{ old('sector') === $s ? 'selected' : '' }}>{{ $s }}</option>
                  @endforeach
                </select>
              </div>
            </div>

            <div class="db-form-group" style="margin-bottom: 1.25rem;">
              <label class="db-form-label">Comment avez-vous trouvé ce client ?<span>*</span></label>
              <div class="db-how-grid" id="db-how-grid">
                @foreach([
                  ['val' => 'Réseau personnel',    'icon' => '👥'],
                  ['val' => 'LinkedIn',             'icon' => '💼'],
                  ['val' => 'Événement / meetup',   'icon' => '🎤'],
                  ['val' => 'Recommandation',       'icon' => '⭐'],
                  ['val' => 'Démarchage direct',    'icon' => '📞'],
                  ['val' => 'Autre',                'icon' => '🔗'],
                ] as $h)
                <div class="db-how-chip {{ old('how_found') === $h['val'] ? 'is-selected' : '' }}"
                     data-val="{{ $h['val'] }}"
                     onclick="dbSelectHow('{{ $h['val'] }}', this)">
                  {{ $h['icon'] }} {{ $h['val'] }}
                </div>
                @endforeach
              </div>
            </div>
          </div>

          <div class="db-nav">
            <button type="button" class="db-btn db-btn-back" onclick="dbGoStep(1)">← Précédent</button>
            <button type="button" class="db-btn db-btn-next" id="db-next-2" onclick="dbValidateStep2()">
              Continuer →
            </button>
          </div>
        </div>

        {{-- ════════ STEP 3 — LA MISSION ════════ --}}
        <div class="db-step" data-step="3">
          <div class="db-step-body">
            <div class="db-step-eyebrow">Étape 3 / 4</div>
            <h2 class="db-step-title">Décrivez la mission</h2>
            <p class="db-step-sub">Plus vous êtes précis, plus la validation sera rapide. Indiquez ce que le client attend.</p>

            <div class="db-form-grid">
              <div class="db-form-group db-form-full">
                <label class="db-form-label">Titre de la mission<span>*</span></label>
                <input type="text" class="db-form-input" name="mission_title" id="db-mission-title"
                       placeholder="Ex : Refonte du site e-commerce avec intégration Stripe"
                       value="{{ old('mission_title') }}" required>
              </div>
              <div class="db-form-group db-form-full">
                <label class="db-form-label">Description de la mission<span>*</span></label>
                <textarea class="db-form-textarea" name="mission_description" id="db-mission-desc"
                          placeholder="Décrivez les besoins du client, le contexte, les objectifs..."
                          required>{{ old('mission_description') }}</textarea>
              </div>
              <div class="db-form-group">
                <label class="db-form-label">Budget estimé (€)</label>
                <input type="number" class="db-form-input" name="budget_estimate"
                       placeholder="ex: 1500" min="0" value="{{ old('budget_estimate') }}">
                <div class="db-form-hint">Budget global brut côté client</div>
              </div>
              <div class="db-form-group">
                <label class="db-form-label">Délai souhaité</label>
                <input type="text" class="db-form-input" name="timeline"
                       placeholder="ex: 3 semaines, avant le 15 mai" value="{{ old('timeline') }}">
              </div>
              <div class="db-form-group">
                <label class="db-form-label">Technologies / compétences requises</label>
                <input type="text" class="db-form-input" name="technologies"
                       placeholder="ex: Laravel, Vue.js, Figma" value="{{ old('technologies') }}">
              </div>
              <div class="db-form-group">
                <label class="db-form-label">Livrables principaux</label>
                <input type="text" class="db-form-input" name="deliverables"
                       placeholder="ex: site déployé, doc technique, formation" value="{{ old('deliverables') }}">
              </div>
            </div>
          </div>

          <div class="db-nav">
            <button type="button" class="db-btn db-btn-back" onclick="dbGoStep(2)">← Précédent</button>
            <button type="button" class="db-btn db-btn-next" onclick="dbValidateStep3()">
              Voir le récap →
            </button>
          </div>
        </div>

        {{-- ════════ STEP 4 — RÉCAP & BONUS ════════ --}}
        <div class="db-step" data-step="4">
          <div class="db-step-body">
            <div class="db-step-eyebrow">Étape 4 / 4 — Récapitulatif</div>
            <h2 class="db-step-title">Tout est bon ?</h2>
            <p class="db-step-sub">Vérifiez les informations avant de soumettre. Votre mentor recevra une notification immédiatement.</p>

            <div class="db-summary">
              <div class="db-summary-section">
                <h5>Profil</h5>
                <div class="db-summary-row">
                  <span class="db-summary-lbl">Votre profil</span>
                  <span class="db-summary-val" id="recap-profile">—</span>
                </div>
              </div>
              <div class="db-summary-section">
                <h5>Contact client</h5>
                <div class="db-summary-row">
                  <span class="db-summary-lbl">Nom</span>
                  <span class="db-summary-val" id="recap-contact-name">—</span>
                </div>
                <div class="db-summary-row">
                  <span class="db-summary-lbl">Entreprise</span>
                  <span class="db-summary-val" id="recap-company">—</span>
                </div>
                <div class="db-summary-row">
                  <span class="db-summary-lbl">Comment trouvé</span>
                  <span class="db-summary-val" id="recap-how">—</span>
                </div>
              </div>
              <div class="db-summary-section">
                <h5>Mission</h5>
                <div class="db-summary-row">
                  <span class="db-summary-lbl">Titre</span>
                  <span class="db-summary-val" id="recap-title">—</span>
                </div>
                <div class="db-summary-row">
                  <span class="db-summary-lbl">Budget</span>
                  <span class="db-summary-val" id="recap-budget">—</span>
                </div>
                <div class="db-summary-row">
                  <span class="db-summary-lbl">Délai</span>
                  <span class="db-summary-val" id="recap-timeline">—</span>
                </div>
                <div class="db-summary-row">
                  <span class="db-summary-lbl">Technologies</span>
                  <span class="db-summary-val" id="recap-tech">—</span>
                </div>
              </div>
            </div>

            {{-- Bonus preview dynamique --}}
            <div class="db-bonus-preview" id="recap-bonus-box">
              <h4>🎁 Votre bonus apporteur estimé</h4>
              <table class="db-bonus-preview-table">
                <thead>
                  <tr>
                    <th>Niveau mission</th>
                    <th>Taux standard</th>
                    <th>Avec bonus apporteur</th>
                    <th>Gain</th>
                  </tr>
                </thead>
                <tbody id="recap-bonus-rows">
                  {{-- rempli en JS --}}
                </tbody>
              </table>
              <p style="font-size:.75rem; color:rgba(255,255,255,.45); margin:.85rem 0 0; line-height:1.5;">
                Le niveau exact sera déterminé par l'algorithme de scoring lors de l'attribution formelle de la mission.
                Le bonus est confirmé et appliqué après validation de votre mentor.
              </p>
            </div>

            @guest
            <div style="background:#fffbeb; border:1px solid #fcd34d; border-radius:12px; padding:1rem 1.25rem; font-size:.85rem; color:#92400e; margin-bottom:.5rem;">
              <strong>🔐 Connexion requise</strong> — Vous devez être connecté pour soumettre la déclaration.
              Vos informations sont préservées dans le formulaire.
              <a href="{{ route('user.login') }}?redirect={{ urlencode(route('mentorship.deal-bringer')) }}"
                 style="color:#d97706; font-weight:700; text-decoration:underline; margin-left:.5rem;">
                Se connecter →
              </a>
            </div>
            @endguest
          </div>

          <div class="db-nav">
            <button type="button" class="db-btn db-btn-back" onclick="dbGoStep(3)">← Précédent</button>
            @auth
            <button type="submit" class="db-btn db-btn-submit">
              🚀 Soumettre ma déclaration
            </button>
            @else
            <a href="{{ route('user.login') }}?redirect={{ urlencode(route('mentorship.deal-bringer')) }}"
               class="db-btn db-btn-submit" style="text-decoration:none;">
              🔐 Se connecter pour soumettre
            </a>
            @endauth
          </div>
        </div>

      </form>
    </div>{{-- /db-card --}}
  </div>{{-- /db-wizard-wrap --}}

  {{-- ═══════════════════ HISTORIQUE ═══════════════════ --}}
  @auth
  @if($submissions->isNotEmpty())
  <div class="db-history">
    <div class="db-history__title">📋 Vos déclarations récentes</div>
    @foreach($submissions as $sub)
    <div class="db-history-card">
      <span class="db-history-card__badge"
            style="background:{{ $sub->statusColor() }}22; color:{{ $sub->statusColor() }}; border:1px solid {{ $sub->statusColor() }}44;">
        {{ $sub->statusLabel() }}
      </span>
      <span class="db-history-card__title">{{ $sub->mission_title }}</span>
      <span class="db-history-card__meta">{{ $sub->contact_company ?: $sub->contact_name }} · {{ $sub->created_at->diffForHumans() }}</span>
    </div>
    @endforeach
  </div>
  @endif
  @endauth

  {{-- ═══════════════════ TABLE TAUX COMPLÈTE ═══════════════════ --}}
  <div style="max-width:820px; margin: 3rem auto 0; padding: 0 1.5rem;">
    <div style="background:#fff; border-radius:20px; box-shadow:var(--db-shadow); overflow:hidden;">
      <div style="background:linear-gradient(135deg,#0f172a,#1e1b4b); padding:1.5rem 2rem; color:#fff;">
        <div style="font-size:.72rem; font-weight:700; text-transform:uppercase; letter-spacing:.1em; color:#93c5fd; margin-bottom:.4rem;">Tableau de référence complet</div>
        <div style="font-size:1.1rem; font-weight:800;">Taux standard vs. bonus apporteur — tous niveaux</div>
      </div>
      <div style="padding:1.5rem 2rem; overflow-x:auto;">
        <table style="width:100%; border-collapse:collapse; font-size:.85rem;">
          <thead>
            <tr style="border-bottom:2px solid #f1f5f9;">
              <th style="text-align:left; padding:.6rem; color:#94a3b8; font-weight:700; text-transform:uppercase; font-size:.7rem; letter-spacing:.08em;">Niveau</th>
              <th style="text-align:center; padding:.6rem; color:#0d9488; font-weight:700; font-size:.7rem; text-transform:uppercase;">Stagiaire std</th>
              <th style="text-align:center; padding:.6rem; color:#059669; font-weight:700; font-size:.7rem; text-transform:uppercase; background:#f0fdf4;">Stagiaire deal</th>
              <th style="text-align:center; padding:.6rem; color:#2563eb; font-weight:700; font-size:.7rem; text-transform:uppercase;">Junior std</th>
              <th style="text-align:center; padding:.6rem; color:#7c3aed; font-weight:700; font-size:.7rem; text-transform:uppercase; background:#f5f3ff;">Junior deal</th>
            </tr>
          </thead>
          <tbody>
            @foreach($rates as $r)
            <tr style="border-bottom:1px solid #f8fafc;">
              <td style="padding:.7rem .6rem; font-weight:700; color:#0f172a;">{{ $r['level'] }}</td>
              <td style="text-align:center; padding:.7rem; color:#0d9488; font-weight:600;">{{ $r['std_intern'] }} %</td>
              <td style="text-align:center; padding:.7rem; color:#059669; font-weight:800; background:#f0fdf4;">{{ $r['deal_intern'] }} % <sup style="font-size:.65rem;">+{{ $r['deal_intern'] - $r['std_intern'] }}</sup></td>
              <td style="text-align:center; padding:.7rem; color:#2563eb; font-weight:600;">{{ $r['std_junior'] }} %</td>
              <td style="text-align:center; padding:.7rem; color:#7c3aed; font-weight:800; background:#f5f3ff;">{{ $r['deal_junior'] }} % <sup style="font-size:.65rem;">+{{ $r['deal_junior'] - $r['std_junior'] }}</sup></td>
            </tr>
            @endforeach
          </tbody>
        </table>
        <p style="font-size:.75rem; color:#94a3b8; margin:.75rem 0 0; line-height:1.55;">
          Les pourcentages s'appliquent sur le <strong>montant net</strong> (brut client − 20 % commission Junspro).
          Le niveau de mission est déterminé par l'algorithme objectif de scoring à 11 critères.
        </p>
      </div>
    </div>
  </div>

</div>{{-- /db-page --}}

<script>
(function () {
  var RATES = {
    intern:  { beginner: @json($stdIntern['beginner']),     intermediate: @json($stdIntern['intermediate']),  advanced: @json($stdIntern['advanced']) },
    junior:  { beginner: @json($stdJunior['beginner']),     intermediate: @json($stdJunior['intermediate']),  advanced: @json($stdJunior['advanced']) },
    ideal:   { beginner: @json($internRates['beginner']),   intermediate: @json($internRates['intermediate']), advanced: @json($internRates['advanced']) },
    jdeal:   { beginner: @json($juniorRates['beginner']),   intermediate: @json($juniorRates['intermediate']), advanced: @json($juniorRates['advanced']) },
  };
  var LEVEL_LABELS = ['Débutant', 'Intermédiaire', 'Avancé'];
  var LEVEL_KEYS   = ['beginner', 'intermediate', 'advanced'];

  var currentProfile = '';
  var currentStep    = 1;

  /* ── Profile selection ──────────────────────────────── */
  window.dbSelectProfile = function (profile, el) {
    currentProfile = profile;
    document.querySelectorAll('.db-profile-card').forEach(function (c) { c.classList.remove('is-selected'); });
    el.classList.add('is-selected');
    document.getElementById('db-profile-input').value = profile;
    document.getElementById('db-next-1').disabled = false;
  };

  /* ── How-found chips ────────────────────────────────── */
  window.dbSelectHow = function (val, el) {
    document.querySelectorAll('.db-how-chip').forEach(function (c) { c.classList.remove('is-selected'); });
    el.classList.add('is-selected');
    document.getElementById('db-how-found-input').value = val;
  };

  /* ── Navigation ─────────────────────────────────────── */
  window.dbGoStep = function (step) {
    document.querySelectorAll('.db-step').forEach(function (s) { s.classList.remove('is-active'); });
    document.querySelector('.db-step[data-step="' + step + '"]').classList.add('is-active');

    // Stepper
    document.querySelectorAll('.db-stepper__item').forEach(function (item) {
      var n = parseInt(item.dataset.step);
      item.classList.remove('is-active', 'is-done');
      if (n === step)       item.classList.add('is-active');
      else if (n < step)    item.classList.add('is-done');
      item.querySelector('.db-stepper__num').textContent = n < step ? '✓' : n;
    });

    currentStep = step;
    if (step === 4) dbBuildRecap();

    // Scroll to top of wizard
    var el = document.getElementById('db-stepper');
    if (el) el.scrollIntoView({ behavior: 'smooth', block: 'start' });
  };

  /* ── Step 2 validation ──────────────────────────────── */
  window.dbValidateStep2 = function () {
    var name    = document.getElementById('db-contact-name').value.trim();
    var howFound = document.getElementById('db-how-found-input').value;
    if (!name)     { alert('Veuillez saisir le nom du contact.'); return; }
    if (!howFound) { alert('Veuillez indiquer comment vous avez trouvé ce client.'); return; }
    dbGoStep(3);
  };

  /* ── Step 3 validation ──────────────────────────────── */
  window.dbValidateStep3 = function () {
    var title = document.getElementById('db-mission-title').value.trim();
    var desc  = document.getElementById('db-mission-desc').value.trim();
    if (!title) { alert('Veuillez saisir un titre de mission.'); return; }
    if (!desc)  { alert('Veuillez décrire la mission.'); return; }
    dbGoStep(4);
  };

  /* ── Build Récap ────────────────────────────────────── */
  function dbBuildRecap() {
    var f = document.getElementById('db-form');
    var profileLabels = { intern: '🎓 Stagiaire', junior: '🚀 Freelance Junior' };

    var get = function (name) {
      var el = f.querySelector('[name="' + name + '"]');
      return el ? el.value : '';
    };

    setText('recap-profile', profileLabels[get('profile_type')] || '—');
    setText('recap-contact-name', get('contact_name') || '—');
    setText('recap-company', get('contact_company') || '—');
    setText('recap-how', get('how_found') || '—');
    setText('recap-title', get('mission_title') || '—');
    setText('recap-budget', get('budget_estimate') ? get('budget_estimate') + ' €' : '—');
    setText('recap-timeline', get('timeline') || '—');
    setText('recap-tech', get('technologies') || '—');

    // Build bonus table
    var profile = get('profile_type') || 'intern';
    var stdKey  = profile === 'junior' ? 'junior' : 'intern';
    var dealKey = profile === 'junior' ? 'jdeal'  : 'ideal';
    var html    = '';
    LEVEL_KEYS.forEach(function (k, i) {
      var std  = RATES[stdKey][k];
      var deal = RATES[dealKey][k];
      var diff = deal - std;
      html +=
        '<tr>' +
          '<td style="padding:.45rem .5rem;">' + LEVEL_LABELS[i] + '</td>' +
          '<td class="db-bonus-std" style="text-align:center;">' + std + ' %</td>' +
          '<td class="db-bonus-deal" style="text-align:center;">' + deal + ' %</td>' +
          '<td class="db-bonus-delta" style="text-align:center;">+' + diff + ' pts</td>' +
        '</tr>';
    });
    document.getElementById('recap-bonus-rows').innerHTML = html;
  }

  function setText(id, val) {
    var el = document.getElementById(id);
    if (el) el.textContent = val;
  }

  /* ── Pre-select old() profile if validation failed ─── */
  @if(old('profile_type'))
    (function () {
      var card = document.querySelector('[data-profile="{{ old("profile_type") }}"]');
      if (card) { currentProfile = '{{ old("profile_type") }}'; card.classList.add('is-selected');
        document.getElementById('db-next-1').disabled = false; }
    })();
  @endif
  @if(old('how_found'))
    (function () {
      var chip = document.querySelector('.db-how-chip[data-val="{{ old("how_found") }}"]');
      if (chip) chip.classList.add('is-selected');
      document.getElementById('db-how-found-input').value = '{{ old("how_found") }}';
    })();
  @endif
  @if($errors->any())
    // Re-open at last valid step
    dbGoStep({{ old('mission_title') ? 4 : (old('contact_name') ? 3 : 2) }});
  @endif
})();
</script>
@endsection
