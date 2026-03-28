@extends('frontend.layout')

@section('pageHeading')
  Devenir Freelance Junior — Mentorat Junspro
@endsection

@section('metaDescription')
  Diplômé sans expérience ? Rejoignez un pod de mentorat, décrochez vos premiers clients et soyez rémunéré progressivement (50→70 % selon la mission). Lancez votre activité freelance avec un mentor expert à vos côtés.
@endsection

@section('style')
<style>
  :root {
    --fj-blue: #2563EB;
    --fj-blue-light: #EFF6FF;
    --fj-indigo: #4338CA;
    --fj-dark: #0f172a;
    --fj-gradient: linear-gradient(135deg, #0f172a 0%, #1e1b4b 50%, #2563eb 100%);
    --fj-gradient-blue: linear-gradient(135deg, #2563eb 0%, #7c3aed 100%);
    --fj-shadow: 0 4px 24px rgba(37,99,235,.1);
    --fj-shadow-hover: 0 16px 48px rgba(37,99,235,.2);
  }
  .fj-page { background: #eff6ff; min-height: 100vh; }

  /* ─── HERO ─────────────────────────────────────────────── */
  .fj-hero { background: var(--fj-gradient); padding: 5rem 1.5rem 6rem; text-align: center; position: relative; overflow: hidden; }
  .fj-hero::before { content:''; position:absolute; inset:0; background:url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none'%3E%3Cg fill='%23ffffff' fill-opacity='0.03'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E"); pointer-events:none; }
  .fj-hero__eyebrow { display:inline-flex; align-items:center; gap:.5rem; background:rgba(37,99,235,.2); color:#93c5fd; border:1px solid rgba(147,197,253,.3); font-size:.75rem; font-weight:700; letter-spacing:.1em; text-transform:uppercase; border-radius:999px; padding:.35rem 1.1rem; margin-bottom:1.5rem; }
  .fj-hero__badge-pay { display:inline-flex; align-items:center; gap:.4rem; background:rgba(52,211,153,.15); border:1px solid rgba(52,211,153,.4); color:#34d399; border-radius:999px; padding:.3rem .9rem; font-size:.78rem; font-weight:700; margin-bottom:1rem; }
  .fj-hero__title { font-size:clamp(2.2rem,6vw,3.6rem); font-weight:900; line-height:1.1; color:#fff; margin-bottom:1.25rem; max-width:820px; margin-left:auto; margin-right:auto; }
  .fj-hero__title .accent { background:linear-gradient(135deg,#93c5fd,#c4b5fd); -webkit-background-clip:text; -webkit-text-fill-color:transparent; background-clip:text; }
  .fj-hero__sub { font-size:1.1rem; color:rgba(255,255,255,.72); max-width:600px; margin:0 auto 2.5rem; line-height:1.65; }
  .fj-btn-primary { display:inline-flex; align-items:center; gap:.5rem; background:var(--fj-gradient-blue); color:#fff; font-size:1rem; font-weight:800; padding:.9rem 2.2rem; border-radius:12px; text-decoration:none; transition:transform .2s, box-shadow .2s; box-shadow:0 4px 20px rgba(37,99,235,.4); }
  .fj-btn-primary:hover { transform:translateY(-2px); color:#fff; }
  .fj-btn-ghost { display:inline-flex; align-items:center; gap:.5rem; background:rgba(255,255,255,.08); color:rgba(255,255,255,.9); border:1px solid rgba(255,255,255,.2); font-size:.95rem; font-weight:600; padding:.9rem 2rem; border-radius:12px; text-decoration:none; }
  .fj-btn-ghost:hover { background:rgba(255,255,255,.14); color:#fff; }
  .fj-cta-group { display:flex; gap:1rem; justify-content:center; flex-wrap:wrap; }
  .fj-hero__stats { display:flex; justify-content:center; gap:3rem; flex-wrap:wrap; margin-top:3.5rem; padding-top:3rem; border-top:1px solid rgba(255,255,255,.1); }
  .fj-hero__stat-val { font-size:2.2rem; font-weight:900; color:#93c5fd; display:block; }
  .fj-hero__stat-lbl { font-size:.78rem; color:rgba(255,255,255,.5); text-transform:uppercase; letter-spacing:.08em; }

  /* ─── SECTION ─────────────────────────────────────────── */
  .fj-section { padding:5rem 1.5rem; }
  .fj-section-inner { max-width:1100px; margin:0 auto; }
  .fj-section-label { display:inline-block; font-size:.72rem; font-weight:700; letter-spacing:.12em; text-transform:uppercase; color:var(--fj-blue); background:var(--fj-blue-light); border-radius:999px; padding:.28rem .9rem; margin-bottom:1rem; }
  .fj-section-title { font-size:clamp(1.6rem,3vw,2.4rem); font-weight:800; color:#0f172a; margin-bottom:.75rem; line-height:1.2; }
  .fj-section-sub { font-size:1rem; color:#64748b; max-width:580px; line-height:1.65; }

  /* ─── DIFFÉRENCE ─────────────────────────────────────── */
  .fj-diff { background:#fff; }
  .fj-diff-banner {
    background: linear-gradient(135deg, #eff6ff, #f5f3ff);
    border: 2px solid #2563eb; border-radius: 20px; padding: 2rem 2.5rem;
    display: grid; grid-template-columns: 1fr auto 1fr; gap: 2rem; align-items: center;
    margin-top: 3rem;
  }
  .fj-diff-col__badge { display:inline-block; font-size:.7rem; font-weight:700; text-transform:uppercase; letter-spacing:.08em; border-radius:999px; padding:.25rem .8rem; margin-bottom:.75rem; }
  .fj-diff-col__badge--intern { background:#ccfbf1; color:#0f766e; }
  .fj-diff-col__badge--junior { background:#dbeafe; color:#1e40af; }
  .fj-diff-col__title { font-size:1.1rem; font-weight:800; color:#0f172a; margin-bottom:.5rem; }
  .fj-diff-col__desc { font-size:.88rem; color:#475569; line-height:1.6; }
  .fj-diff-col__item { display:flex; align-items:center; gap:.5rem; font-size:.83rem; margin-bottom:.35rem; }
  .fj-diff-separator { text-align:center; }
  .fj-diff-separator span { display:inline-block; background:var(--fj-blue); color:#fff; font-size:.75rem; font-weight:700; border-radius:999px; padding:.4rem .8rem; }

  /* ─── TABLEAU COMPENSATION ───────────────────────────── */
  .fj-comp { background: linear-gradient(160deg,#f8fafc,#eff6ff); }
  .fj-comp-intro {
    background:linear-gradient(135deg,#0f172a,#1e1b4b);
    border-radius:20px; padding:2rem 2.5rem; color:#fff; margin-top:3rem;
    display:grid; grid-template-columns:1fr 1fr; gap:2rem; align-items:center;
  }
  .fj-comp-intro__left h3 { font-size:1.2rem; font-weight:800; margin-bottom:.5rem; }
  .fj-comp-intro__left p { font-size:.88rem; color:rgba(255,255,255,.7); line-height:1.6; margin:0; }
  .fj-comp-intro__right { display:flex; flex-direction:column; gap:.5rem; }
  .fj-comp-pill { display:flex; align-items:center; justify-content:space-between; padding:.5rem 1rem; border-radius:10px; background:rgba(255,255,255,.07); }
  .fj-comp-pill__label { font-size:.83rem; color:rgba(255,255,255,.8); }
  .fj-comp-pill__val { font-size:.9rem; font-weight:700; color:#93c5fd; }
  .fj-comp-pill--commission { background:rgba(239,68,68,.15); border:1px dashed rgba(239,68,68,.4); }
  .fj-comp-pill--commission .fj-comp-pill__label { color:rgba(255,255,255,.9); font-weight:600; }
  .fj-comp-pill--commission .fj-comp-pill__val { color:#fca5a5; }
  .fj-comp-pill--degressif { background:rgba(251,191,36,.1); border:1px dashed rgba(251,191,36,.3); font-size:.75rem; color:rgba(255,255,255,.5); padding:.35rem 1rem; border-radius:8px; text-align:center; }

  .fj-comp-table { margin-top:2rem; border-radius:16px; overflow:hidden; box-shadow:var(--fj-shadow); }
  .fj-comp-table-head { display:grid; grid-template-columns:1.8fr 1fr 1fr 2fr; background:var(--fj-dark); color:rgba(255,255,255,.6); font-size:.7rem; font-weight:700; text-transform:uppercase; letter-spacing:.08em; padding:.75rem 1.25rem; }
  .fj-comp-row { display:grid; grid-template-columns:1.8fr 1fr 1fr 2fr; padding:1rem 1.25rem; background:#fff; border-bottom:1px solid #f1f5f9; align-items:center; transition:background .2s; }
  .fj-comp-row:hover { background:#eff6ff; }
  .fj-comp-row:last-child { border-bottom:none; }
  .fj-comp-row__level { display:flex; align-items:center; gap:.6rem; }
  .fj-comp-row__dot { width:10px; height:10px; border-radius:50%; flex-shrink:0; }
  .fj-comp-row__dot--beginner     { background:#22c55e; }
  .fj-comp-row__dot--intermediate { background:#f59e0b; }
  .fj-comp-row__dot--advanced     { background:#ef4444; }
  .fj-comp-row__name { font-size:.88rem; font-weight:700; color:#0f172a; }
  .fj-comp-row__role { font-size:.77rem; color:#64748b; margin-top:.15rem; }
  .fj-comp-row__pct { font-size:1rem; font-weight:800; color:#2563eb; }
  .fj-comp-row__pct-mentor { font-size:.88rem; font-weight:600; color:#475569; }
  .fj-comp-row__examples { font-size:.78rem; color:#64748b; line-height:1.5; }

  .fj-comp-example-box { margin-top:2rem; background:linear-gradient(135deg,#eff6ff,#dbeafe); border-radius:16px; padding:2rem; }
  .fj-comp-example-box h4 { font-size:1rem; font-weight:800; color:#0f172a; margin-bottom:1.25rem; }
  .fj-comp-sim-grid { display:grid; grid-template-columns:repeat(auto-fit,minmax(200px,1fr)); gap:1rem; }
  .fj-comp-sim { background:#fff; border-radius:12px; padding:1.25rem; box-shadow:var(--fj-shadow); }
  .fj-comp-sim__badge { font-size:.68rem; font-weight:700; text-transform:uppercase; letter-spacing:.07em; border-radius:999px; padding:.2rem .7rem; display:inline-block; margin-bottom:.75rem; }
  .fj-comp-sim__badge--beginner     { background:#dcfce7; color:#15803d; }
  .fj-comp-sim__badge--intermediate { background:#fef3c7; color:#b45309; }
  .fj-comp-sim__badge--advanced     { background:#fee2e2; color:#b91c1c; }
  .fj-comp-sim__gross { font-size:.78rem; color:#64748b; margin-bottom:.3rem; }
  .fj-comp-sim__row { display:flex; justify-content:space-between; font-size:.83rem; margin-bottom:.25rem; }
  .fj-comp-sim__row--junior span:last-child { color:#2563eb; font-weight:700; }
  .fj-comp-sim__row--mentor span:last-child { color:#475569; font-weight:600; }
  .fj-comp-sim__divider { border:none; border-top:1px solid #e2e8f0; margin:.5rem 0; }

  .fj-vs-intern { background:#f0fdf4; border:2px solid #86efac; border-radius:16px; padding:1.5rem 2rem; margin-top:2rem; display:flex; align-items:center; gap:1.5rem; flex-wrap:wrap; }
  .fj-vs-intern__text { flex:1; min-width:220px; }
  .fj-vs-intern__text strong { color:#15803d; }
  .fj-vs-intern__text p { font-size:.85rem; color:#16a34a; margin:0; }
  .fj-vs-intern__cta { flex-shrink:0; display:inline-flex; align-items:center; gap:.4rem; background:#16a34a; color:#fff; font-size:.85rem; font-weight:700; padding:.6rem 1.25rem; border-radius:10px; text-decoration:none; }
  .fj-vs-intern__cta:hover { background:#15803d; color:#fff; }

  /* ─── CE QUE VOUS GAGNEZ ─────────────────────────────── */
  .fj-gain { background:#fff; }
  .fj-gain-grid { display:grid; grid-template-columns:repeat(auto-fit,minmax(230px,1fr)); gap:1.25rem; margin-top:3rem; }
  .fj-gain-item { background:#fff; border:1px solid #e2e8f0; border-radius:16px; padding:1.5rem; text-align:center; transition:transform .25s, box-shadow .25s; }
  .fj-gain-item:hover { transform:translateY(-3px); box-shadow:var(--fj-shadow-hover); border-color:#93c5fd; }
  .fj-gain-item__icon { font-size:2.2rem; margin-bottom:.75rem; display:block; }
  .fj-gain-item__title { font-size:.95rem; font-weight:700; color:#0f172a; margin-bottom:.4rem; }
  .fj-gain-item__desc { font-size:.83rem; color:#64748b; line-height:1.55; }

  /* ─── PARCOURS ─────────────────────────────────────────── */
  .fj-journey { background:linear-gradient(160deg,#f8fafc,#eff6ff); }
  .fj-steps { display:grid; grid-template-columns:repeat(auto-fit,minmax(190px,1fr)); gap:1.5rem; margin-top:3rem; }
  .fj-step { background:#fff; border-radius:18px; padding:1.75rem 1.5rem; box-shadow:var(--fj-shadow); text-align:center; transition:transform .3s; }
  .fj-step:hover { transform:translateY(-4px); box-shadow:var(--fj-shadow-hover); }
  .fj-step__num { width:50px; height:50px; border-radius:50%; background:var(--fj-gradient-blue); color:#fff; font-size:1.25rem; font-weight:900; display:flex; align-items:center; justify-content:center; margin:0 auto 1rem; }
  .fj-step__title { font-size:.95rem; font-weight:700; color:#0f172a; margin-bottom:.4rem; }
  .fj-step__desc { font-size:.83rem; color:#64748b; line-height:1.55; }
  .fj-step__tag { font-size:.7rem; background:var(--fj-blue-light); color:var(--fj-blue); border-radius:999px; padding:.15rem .7rem; font-weight:600; display:inline-block; margin-top:.5rem; }

  /* ─── PRÉREQUIS ───────────────────────────────────────── */
  .fj-prereq { background: linear-gradient(160deg,#fafafa,#eff6ff); }
  .fj-prereq-grid { display:grid; grid-template-columns:repeat(auto-fit,minmax(220px,1fr)); gap:1rem; margin-top:2.5rem; }
  .fj-prereq-item { background:#fff; border-radius:14px; padding:1.25rem 1.5rem; display:flex; align-items:flex-start; gap:1rem; box-shadow:var(--fj-shadow); }
  .fj-prereq-item__icon { width:40px; height:40px; border-radius:10px; background:var(--fj-blue-light); color:var(--fj-blue); display:flex; align-items:center; justify-content:center; font-size:1.1rem; flex-shrink:0; }
  .fj-prereq-item__title { font-size:.9rem; font-weight:700; color:#0f172a; margin-bottom:.2rem; }
  .fj-prereq-item__desc { font-size:.8rem; color:#64748b; line-height:1.5; }

  /* ─── CTA ─────────────────────────────────────────────── */
  .fj-cta { background:var(--fj-gradient); padding:5rem 1.5rem; text-align:center; }
  .fj-cta h2 { font-size:clamp(1.8rem,4vw,3rem); font-weight:900; color:#fff; margin-bottom:1rem; }
  .fj-cta p { font-size:1.05rem; color:rgba(255,255,255,.7); max-width:540px; margin:0 auto 2.5rem; line-height:1.6; }

  @media(max-width:640px) {
    .fj-diff-banner { grid-template-columns:1fr; }
    .fj-diff-separator { display:none; }
    .fj-comp-table-head, .fj-comp-row { grid-template-columns:1.5fr 1fr 1fr; }
    .fj-comp-table-head > :last-child, .fj-comp-row__examples { display:none; }
    .fj-comp-intro { grid-template-columns:1fr; }
  }
</style>
@endsection

@section('content')
<div class="fj-page">

  {{-- HERO --}}
  <section class="fj-hero">
    <div class="fj-hero__badge-pay"><i class="fa fa-coins"></i> Rémunéré — jusqu'à 70 % sur vos missions</div>
    <div class="fj-hero__eyebrow"><i class="fa fa-rocket"></i> Programme Freelance Junior</div>
    <h1 class="fj-hero__title">
      Diplômé ? Lancez votre <span class="accent">activité freelance</span><br>accompagné d'un expert
    </h1>
    <p class="fj-hero__sub">
      Vous avez terminé vos études mais manquez de clients et d'expérience terrain.
      Rejoignez un pod de mentorat, travaillez sur de vrais projets payants
      et construisez votre réputation dès les premières semaines.
    </p>
    <div class="fj-cta-group">
      <a href="{{ route('mentorship.subscription.index') }}" class="fj-btn-primary">
        <i class="fa fa-rocket"></i> Lancer ma carrière — dès 49 €
      </a>
      <a href="#compensation" class="fj-btn-ghost">
        <i class="fa fa-chart-bar"></i> Voir la rémunération
      </a>
    </div>
    <div class="fj-hero__stats">
      <div><span class="fj-hero__stat-val">50 %</span><span class="fj-hero__stat-lbl">Mission débutant</span></div>
      <div><span class="fj-hero__stat-val">60 %</span><span class="fj-hero__stat-lbl">Mission intermédiaire</span></div>
      <div><span class="fj-hero__stat-val">70 %</span><span class="fj-hero__stat-lbl">Mission avancée</span></div>
      <div><span class="fj-hero__stat-val">4 sem.</span><span class="fj-hero__stat-lbl">Cycle de mentorat</span></div>
    </div>
  </section>

  {{-- DIFFÉRENCE FONDAMENTALE --}}
  <section class="fj-section fj-diff">
    <div class="fj-section-inner">
      <div style="text-align:center;">
        <span class="fj-section-label">Comprendre la différence</span>
        <h2 class="fj-section-title">Freelance junior ≠ Stagiaire</h2>
        <p class="fj-section-sub" style="margin:0 auto;">Deux profils, deux accompagnements — vous êtes diplômé, vous avez vocation à facturer.</p>
      </div>
      <div class="fj-diff-banner">
        <div>
          <span class="fj-diff-col__badge fj-diff-col__badge--junior">Vous — Freelance Junior 🚀</span>
          <div class="fj-diff-col__title">Diplômé débutant</div>
          <div class="fj-diff-col__desc">Vos études sont terminées. Vous voulez trouver des clients, prouver votre valeur et être payé — mais vous avez besoin d'un mentor pour être crédible.</div>
          <div style="margin-top:.75rem;">
            <div class="fj-diff-col__item" style="color:#1d4ed8;"><i class="fa fa-coins" style="color:#2563eb;"></i> Rémunéré sur chaque mission (50–70 %)</div>
            <div class="fj-diff-col__item" style="color:#1d4ed8;"><i class="fa fa-check" style="color:#2563eb;"></i> Accès au pipeline client Junspro</div>
            <div class="fj-diff-col__item" style="color:#1d4ed8;"><i class="fa fa-check" style="color:#2563eb;"></i> Profil pro vérifié + crédibilité marché</div>
            <div class="fj-diff-col__item" style="color:#1d4ed8;"><i class="fa fa-check" style="color:#2563eb;"></i> Stripe Connect requis pour encaisser</div>
          </div>
        </div>
        <div class="fj-diff-separator"><span>VS</span></div>
        <div>
          <span class="fj-diff-col__badge fj-diff-col__badge--intern">Stagiaire Étudiant 🎓</span>
          <div class="fj-diff-col__title">Étudiant en formation</div>
          <div class="fj-diff-col__desc">Vous êtes encore aux études. Vous cherchez un encadrement pratique pour valider votre formation et obtenir un certificat.</div>
          <div style="margin-top:.75rem;">
            <div class="fj-diff-col__item" style="color:#0d9488;"><i class="fa fa-graduation-cap" style="color:#0d9488;"></i> Gratification 20/30/40 % selon difficulté</div>
            <div class="fj-diff-col__item"><i class="fa fa-check"></i> Certificat de stage Junspro</div>
            <div class="fj-diff-col__item"><i class="fa fa-check"></i> Portfolio + réseau professionnel</div>
            <div class="fj-diff-col__item"><i class="fa fa-arrow-right" style="color:#0d9488;"></i> <a href="{{ route('mentorship.become-intern') }}" style="color:#0d9488;">Voir le programme stagiaire →</a></div>
          </div>
        </div>
      </div>
    </div>
  </section>

  {{-- TABLEAU DE COMPENSATION --}}
  <section class="fj-section fj-comp" id="compensation">
    <div class="fj-section-inner">
      <div style="text-align:center;">
        <span class="fj-section-label">Rémunération progressive</span>
        <h2 class="fj-section-title">Votre part selon la difficulté de la mission</h2>
        <p class="fj-section-sub" style="margin:0 auto;">
          Sur les missions avancées, votre expertise est maximale — vous êtes le mieux rémunéré.
          Sur les missions débutantes, le mentor porte l’essentiel de la relation client — sa part est plus forte.
        </p>
      </div>

      <div class="fj-comp-intro">
        <div class="fj-comp-intro__left">
          <h3>Logique du modèle junior</h3>
          <p>
            Junspro prélève une <strong style="color:#fca5a5;">commission de 20 %</strong> sur le montant brut client — en premier, avant tout partage.
            Sur le montant net restant, vous et votre mentor vous répartissez selon la difficulté.
            Plus la mission est complexe, plus votre expertise est valorisée — et mieux vous êtes rémunéré.
          </p>
        </div>
        <div class="fj-comp-intro__right">
          <div class="fj-comp-pill fj-comp-pill--commission">
            <span class="fj-comp-pill__label">Commission Junspro (prélèvement brut)</span>
            <span class="fj-comp-pill__val">20 %</span>
          </div>
          <div class="fj-comp-pill--degressif">Dégressive : 20 % → 16 % → 12 % selon votre volume cumulé</div>
          <div class="fj-comp-pill">
            <span class="fj-comp-pill__label">Mission débutante</span>
            <span class="fj-comp-pill__val">Vous recevez 50 %</span>
          </div>
          <div class="fj-comp-pill">
            <span class="fj-comp-pill__label">Mission intermédiaire</span>
            <span class="fj-comp-pill__val">Vous recevez 60 %</span>
          </div>
          <div class="fj-comp-pill">
            <span class="fj-comp-pill__label">Mission avancée</span>
            <span class="fj-comp-pill__val">Vous recevez 70 %</span>
          </div>
        </div>
      </div>

      {{-- Tableau --}}
      <div class="fj-comp-table">
        <div class="fj-comp-table-head">
          <span>Niveau de mission</span>
          <span>Votre part</span>
          <span>Mentor</span>
          <span>Exemples de missions</span>
        </div>

        <div class="fj-comp-row">
          <div class="fj-comp-row__level">
            <div class="fj-comp-row__dot fj-comp-row__dot--beginner"></div>
            <div>
              <div class="fj-comp-row__name">Débutant</div>
              <div class="fj-comp-row__role">Autonomie progressive guidée</div>
            </div>
          </div>
          <div class="fj-comp-row__pct">50 %</div>
          <div class="fj-comp-row__pct-mentor">50 %</div>
          <div class="fj-comp-row__examples">Landing page · Refonte UI · Script d'automatisation</div>
        </div>

        <div class="fj-comp-row">
          <div class="fj-comp-row__level">
            <div class="fj-comp-row__dot fj-comp-row__dot--intermediate"></div>
            <div>
              <div class="fj-comp-row__name">Intermédiaire</div>
              <div class="fj-comp-row__role">Co-construction en binôme</div>
            </div>
          </div>
          <div class="fj-comp-row__pct">60 %</div>
          <div class="fj-comp-row__pct-mentor">40 %</div>
          <div class="fj-comp-row__examples">Application CRUD · Campagne multi-canal · Intégration API</div>
        </div>

        <div class="fj-comp-row">
          <div class="fj-comp-row__level">
            <div class="fj-comp-row__dot fj-comp-row__dot--advanced"></div>
            <div>
              <div class="fj-comp-row__name">Avancé</div>
              <div class="fj-comp-row__role">Expertise technique reconnue</div>
            </div>
          </div>
          <div class="fj-comp-row__pct">70 %</div>
          <div class="fj-comp-row__pct-mentor">30 %</div>
          <div class="fj-comp-row__examples">Architecture microservices · Stratégie B2B · Système temps réel</div>
        </div>
      </div>

      {{-- Simulations chiffrées --}}
      <div class="fj-comp-example-box">
        <h4>💡 Exemples chiffrés (mission à 500 € brut, commission Junspro 20 %)</h4>
        <div class="fj-comp-sim-grid">
          <div class="fj-comp-sim">
            <span class="fj-comp-sim__badge fj-comp-sim__badge--beginner">Débutant · 50 %</span>
            <div class="fj-comp-sim__gross">500 € brut → 400 € net</div>
            <hr class="fj-comp-sim__divider">
            <div class="fj-comp-sim__row fj-comp-sim__row--junior"><span>Vous recevez</span><span>200 €</span></div>
            <div class="fj-comp-sim__row fj-comp-sim__row--mentor"><span>Mentor</span><span>200 €</span></div>
            <div class="fj-comp-sim__row"><span>Commission</span><span style="color:#ef4444">100 €</span></div>
          </div>
          <div class="fj-comp-sim">
            <span class="fj-comp-sim__badge fj-comp-sim__badge--intermediate">Intermédiaire · 60 %</span>
            <div class="fj-comp-sim__gross">500 € brut → 400 € net</div>
            <hr class="fj-comp-sim__divider">
            <div class="fj-comp-sim__row fj-comp-sim__row--junior"><span>Vous recevez</span><span>240 €</span></div>
            <div class="fj-comp-sim__row fj-comp-sim__row--mentor"><span>Mentor</span><span>160 €</span></div>
            <div class="fj-comp-sim__row"><span>Commission</span><span style="color:#ef4444">100 €</span></div>
          </div>
          <div class="fj-comp-sim">
            <span class="fj-comp-sim__badge fj-comp-sim__badge--advanced">Avancé · 70 %</span>
            <div class="fj-comp-sim__gross">500 € brut → 400 € net</div>
            <hr class="fj-comp-sim__divider">
            <div class="fj-comp-sim__row fj-comp-sim__row--junior"><span>Vous recevez</span><span>280 €</span></div>
            <div class="fj-comp-sim__row fj-comp-sim__row--mentor"><span>Mentor</span><span>120 €</span></div>
            <div class="fj-comp-sim__row"><span>Commission</span><span style="color:#ef4444">100 €</span></div>
          </div>
        </div>
      </div>

      {{-- Comparaison avec stagiaire --}}
      <div class="fj-vs-intern">
        <div class="fj-vs-intern__text">
          <strong>Encore étudiant ?</strong>
          <p>Le programme Stagiaire offre une gratification 20/30/40 % — pour les étudiants en formation qui veulent de l'expérience terrain.</p>
        </div>
        <a href="{{ route('mentorship.become-intern') }}" class="fj-vs-intern__cta">
          <i class="fa fa-graduation-cap"></i> Voir le programme Stagiaire
        </a>
      </div>
    </div>
  </section>

  {{-- SIMULATEUR DE DIFFICULTÉ --}}
  <section class="fj-section" style="background:linear-gradient(160deg,#f8fafc,#eff6ff);">
    <div class="fj-section-inner">
      <div style="text-align:center;">
        <span class="fj-section-label">Classification automatique</span>
        <h2 class="fj-section-title">Quel est votre niveau sur cette mission ?</h2>
        <p class="fj-section-sub" style="margin:0 auto;">Répondez à 5 questions — l'algorithme calcule votre part de façon neutre. Ni le mentor ni vous ne décidez seul.</p>
      </div>
      @include('frontend.mentorship.partials.difficulty-scorer', ['traineeType' => 'graduate'])
    </div>
  </section>
  <section class="fj-section fj-gain">
    <div class="fj-section-inner">
      <div style="text-align:center;">
        <span class="fj-section-label">Valeur du programme</span>
        <h2 class="fj-section-title">Pourquoi passer par Junspro pour lancer votre activité ?</h2>
      </div>
      <div class="fj-gain-grid">
        <div class="fj-gain-item">
          <span class="fj-gain-item__icon">💰</span>
          <div class="fj-gain-item__title">Revenus dès la première mission</div>
          <div class="fj-gain-item__desc">Avec jusqu’à 70 % sur les missions avancées, votre expertise est directement récompensée.</div>
        </div>
        <div class="fj-gain-item">
          <span class="fj-gain-item__icon">🎯</span>
          <div class="fj-gain-item__title">Accès aux clients Junspro</div>
          <div class="fj-gain-item__desc">Votre mentor apporte les clients. Vous n'avez pas à prospecter seul dès le début.</div>
        </div>
        <div class="fj-gain-item">
          <span class="fj-gain-item__icon">🏆</span>
          <div class="fj-gain-item__title">Crédibilité immédiate</div>
          <div class="fj-gain-item__desc">Votre profil est co-signé par un mentor vérifié. Les clients vous font confiance dès le départ.</div>
        </div>
        <div class="fj-gain-item">
          <span class="fj-gain-item__icon">📈</span>
          <div class="fj-gain-item__title">Montée en compétence accélérée</div>
          <div class="fj-gain-item__desc">Feedback en temps réel, revues de code, corrections directes — vous progressez 3× plus vite qu'en solo.</div>
        </div>
        <div class="fj-gain-item">
          <span class="fj-gain-item__icon">🔗</span>
          <div class="fj-gain-item__title">Réseau professionnel</div>
          <div class="fj-gain-item__desc">Votre mentor vous introduit dans son réseau de clients, partenaires et autres freelances.</div>
        </div>
        <div class="fj-gain-item">
          <span class="fj-gain-item__icon">🚀</span>
          <div class="fj-gain-item__title">Indépendance progressive</div>
          <div class="fj-gain-item__desc">Au fil des cycles, vous prenez de plus en plus d'autonomie — jusqu'à voler de vos propres ailes.</div>
        </div>
      </div>
    </div>
  </section>

  {{-- PRÉREQUIS --}}
  <section class="fj-section fj-prereq">
    <div class="fj-section-inner">
      <div style="text-align:center;">
        <span class="fj-section-label">Conditions d'accès</span>
        <h2 class="fj-section-title">Ce qu'il vous faut pour rejoindre</h2>
      </div>
      <div class="fj-prereq-grid">
        <div class="fj-prereq-item">
          <div class="fj-prereq-item__icon"><i class="fa fa-graduation-cap"></i></div>
          <div>
            <div class="fj-prereq-item__title">Diplômé ou en fin d'études</div>
            <div class="fj-prereq-item__desc">Vous avez obtenu (ou êtes sur le point d'obtenir) un diplôme dans votre domaine.</div>
          </div>
        </div>
        <div class="fj-prereq-item">
          <div class="fj-prereq-item__icon"><i class="fa fa-user-circle"></i></div>
          <div>
            <div class="fj-prereq-item__title">Profil Junspro créé</div>
            <div class="fj-prereq-item__desc">Compte freelance avec votre spécialisation, tarif journalier et description complète.</div>
          </div>
        </div>
        <div class="fj-prereq-item">
          <div class="fj-prereq-item__icon"><i class="fa fa-credit-card"></i></div>
          <div>
            <div class="fj-prereq-item__title">Stripe Connect activé</div>
            <div class="fj-prereq-item__desc">Pour recevoir vos paiements directement. Configuré en quelques minutes depuis votre dashboard.</div>
          </div>
        </div>
        <div class="fj-prereq-item">
          <div class="fj-prereq-item__icon"><i class="fa fa-check-circle"></i></div>
          <div>
            <div class="fj-prereq-item__title">Abonnement actif</div>
            <div class="fj-prereq-item__desc">Cycle 1 (49 €), Cycle 2 (89 €) ou Cycle 4 (159 €) selon la durée souhaitée.</div>
          </div>
        </div>
      </div>
    </div>
  </section>

  {{-- PARCOURS --}}
  <section class="fj-section fj-journey" id="parcours">
    <div class="fj-section-inner">
      <div style="text-align:center;">
        <span class="fj-section-label">Parcours</span>
        <h2 class="fj-section-title">De la première mission à l'indépendance en 5 étapes</h2>
      </div>
      <div class="fj-steps">
        <div class="fj-step">
          <div class="fj-step__num">1</div>
          <div class="fj-step__title">Créer votre profil</div>
          <div class="fj-step__desc">Inscription freelance, spécialisation, tarif, description. Activez Stripe Connect.</div>
          <span class="fj-step__tag">Gratuit</span>
        </div>
        <div class="fj-step">
          <div class="fj-step__num">2</div>
          <div class="fj-step__title">Souscrire un cycle</div>
          <div class="fj-step__desc">Choisissez la durée d'accompagnement. De 4 semaines à 16 semaines.</div>
          <span class="fj-step__tag">Dès 49 €</span>
        </div>
        <div class="fj-step">
          <div class="fj-step__num">3</div>
          <div class="fj-step__title">Rejoindre un pod</div>
          <div class="fj-step__desc">Parcourez les pods ouverts et candidatez au mentor qui correspond à votre domaine.</div>
          <span class="fj-step__tag">Votre choix</span>
        </div>
        <div class="fj-step">
          <div class="fj-step__num">4</div>
          <div class="fj-step__title">Réaliser des missions</div>
          <div class="fj-step__desc">Travaillez sur des projets clients réels, soumettez vos livrables, récoltez votre part.</div>
          <span class="fj-step__tag">Rémunéré</span>
        </div>
        <div class="fj-step">
          <div class="fj-step__num" style="background:linear-gradient(135deg,#2563eb,#7c3aed);">5</div>
          <div class="fj-step__title">Voler de vos propres ailes</div>
          <div class="fj-step__desc">Portfolio solide, références clients, réseau actif — lancez votre activité indépendante.</div>
          <span class="fj-step__tag">Objectif final</span>
        </div>
      </div>
    </div>
  </section>

  {{-- CTA --}}
  <section class="fj-cta">
    <div style="max-width:680px; margin:0 auto;">
      <h2>Prêt à lancer votre activité freelance ?</h2>
      <p>Un mentor, de vrais clients, et une rémunération dès la première mission. C'est le programme Freelance Junior Junspro.</p>
      <div class="fj-cta-group">
        <a href="{{ route('mentorship.subscription.index') }}" class="fj-btn-primary" style="font-size:1.05rem;">
          <i class="fa fa-rocket"></i> Démarrer ma carrière — dès 49 €
        </a>
        @guest
          <a href="{{ route('register') }}" class="fj-btn-ghost">
            <i class="fa fa-user-plus"></i> Créer mon compte
          </a>
        @endguest
      </div>
      <div style="margin-top:2rem; display:flex; justify-content:center; gap:2rem; flex-wrap:wrap; color:rgba(255,255,255,.5); font-size:.82rem;">
        <span><i class="fa fa-check" style="color:#93c5fd; margin-right:.3rem;"></i>Projets clients réels</span>
        <span><i class="fa fa-check" style="color:#93c5fd; margin-right:.3rem;"></i>Jusqu'à 70 % des revenus</span>
        <span><i class="fa fa-check" style="color:#93c5fd; margin-right:.3rem;"></i>Mentor expert dédié</span>
        <span><i class="fa fa-check" style="color:#93c5fd; margin-right:.3rem;"></i>Résiliable</span>
      </div>
    </div>
  </section>

</div>
@endsection
