@extends('frontend.layout')

@section('pageHeading')
  Trouver un Stage Encadré — Mentorat Junspro
@endsection

@section('metaDescription')
  Étudiant ? Trouvez un mentor professionnel qui vous encadre sur un vrai projet de stage. Validez votre formation avec une expérience concrète et décrochez votre certificat Junspro.
@endsection

@section('style')
<style>
  :root {
    --si-teal: #0D9488;
    --si-teal-light: #F0FDFA;
    --si-blue: #2563EB;
    --si-dark: #0f172a;
    --si-gradient: linear-gradient(135deg, #0f172a 0%, #134e4a 50%, #0d9488 100%);
    --si-gradient-teal: linear-gradient(135deg, #0d9488 0%, #0891b2 100%);
    --si-shadow: 0 4px 24px rgba(13,148,136,.1);
    --si-shadow-hover: 0 16px 48px rgba(13,148,136,.2);
  }
  .si-page { background: #f0fdfa; min-height: 100vh; }

  /* ─── HERO ─────────────────────────────────────────────── */
  .si-hero { background: var(--si-gradient); padding: 5rem 1.5rem 6rem; text-align: center; position: relative; overflow: hidden; }
  .si-hero::before { content:''; position:absolute; inset:0; background:url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none'%3E%3Cg fill='%23ffffff' fill-opacity='0.03'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E"); pointer-events:none; }
  .si-hero__eyebrow { display:inline-flex; align-items:center; gap:.5rem; background:rgba(13,148,136,.2); color:#5eead4; border:1px solid rgba(94,234,212,.3); font-size:.75rem; font-weight:700; letter-spacing:.1em; text-transform:uppercase; border-radius:999px; padding:.35rem 1.1rem; margin-bottom:1.5rem; }
  .si-hero__title { font-size:clamp(2.2rem,6vw,3.6rem); font-weight:900; line-height:1.1; color:#fff; margin-bottom:1.25rem; max-width:800px; margin-left:auto; margin-right:auto; }
  .si-hero__title .accent { background:linear-gradient(135deg,#5eead4,#67e8f9); -webkit-background-clip:text; -webkit-text-fill-color:transparent; background-clip:text; }
    .si-hero__sub { font-size:1.1rem; color:rgba(255,255,255,.72); max-width:600px; margin:0 auto 2.5rem; line-height:1.65; }
  .si-hero__badge-pay { display:inline-flex; align-items:center; gap:.4rem; background:rgba(52,211,153,.15); border:1px solid rgba(52,211,153,.4); color:#34d399; border-radius:999px; padding:.3rem .9rem; font-size:.78rem; font-weight:700; margin-bottom:1rem; }
  .si-btn-primary { display:inline-flex; align-items:center; gap:.5rem; background:var(--si-gradient-teal); color:#fff; font-size:1rem; font-weight:800; padding:.9rem 2.2rem; border-radius:12px; text-decoration:none; transition:transform .2s, box-shadow .2s; box-shadow:0 4px 20px rgba(13,148,136,.4); }
  .si-btn-primary:hover { transform:translateY(-2px); color:#fff; }
  .si-btn-ghost { display:inline-flex; align-items:center; gap:.5rem; background:rgba(255,255,255,.08); color:rgba(255,255,255,.9); border:1px solid rgba(255,255,255,.2); font-size:.95rem; font-weight:600; padding:.9rem 2rem; border-radius:12px; text-decoration:none; transition:background .2s; }
  .si-btn-ghost:hover { background:rgba(255,255,255,.14); color:#fff; }
  .si-cta-group { display:flex; gap:1rem; justify-content:center; flex-wrap:wrap; }
  .si-hero__stats { display:flex; justify-content:center; gap:3rem; flex-wrap:wrap; margin-top:3.5rem; padding-top:3rem; border-top:1px solid rgba(255,255,255,.1); }
  .si-hero__stat-val { font-size:2.2rem; font-weight:900; color:#5eead4; display:block; }
  .si-hero__stat-lbl { font-size:.78rem; color:rgba(255,255,255,.5); text-transform:uppercase; letter-spacing:.08em; }

  /* ─── SECTION ─────────────────────────────────────────── */
  .si-section { padding:5rem 1.5rem; }
  .si-section-inner { max-width:1100px; margin:0 auto; }
  .si-section-label { display:inline-block; font-size:.72rem; font-weight:700; letter-spacing:.12em; text-transform:uppercase; color:var(--si-teal); background:var(--si-teal-light); border-radius:999px; padding:.28rem .9rem; margin-bottom:1rem; }
  .si-section-title { font-size:clamp(1.6rem,3vw,2.4rem); font-weight:800; color:#0f172a; margin-bottom:.75rem; line-height:1.2; }
  .si-section-sub { font-size:1rem; color:#64748b; max-width:560px; line-height:1.65; }

  /* ─── DIFFÉRENCE CLEF ────────────────────────────────── */
  .si-diff { background:#fff; }
  .si-diff-banner {
    background: linear-gradient(135deg, #f0fdfa, #e0f2fe);
    border: 2px solid #0d9488; border-radius: 20px; padding: 2rem 2.5rem;
    display: grid; grid-template-columns: 1fr auto 1fr; gap: 2rem; align-items: center;
    margin-top: 3rem;
  }
  .si-diff-col { }
  .si-diff-col__badge { display:inline-block; font-size:.7rem; font-weight:700; text-transform:uppercase; letter-spacing:.08em; border-radius:999px; padding:.25rem .8rem; margin-bottom:.75rem; }
  .si-diff-col__badge--intern { background:#ccfbf1; color:#0f766e; }
  .si-diff-col__badge--junior { background:#dbeafe; color:#1e40af; }
  .si-diff-col__title { font-size:1.1rem; font-weight:800; color:#0f172a; margin-bottom:.5rem; }
  .si-diff-col__desc { font-size:.88rem; color:#475569; line-height:1.6; }
  .si-diff-col__items { margin-top:.75rem; }
  .si-diff-col__item { display:flex; align-items:center; gap:.5rem; font-size:.83rem; color:#334155; margin-bottom:.35rem; }
  .si-diff-col__item i { color: var(--si-teal); }
  .si-diff-separator { text-align:center; }
  .si-diff-separator span { display:inline-block; background:var(--si-teal); color:#fff; font-size:.75rem; font-weight:700; border-radius:999px; padding:.4rem .8rem; }

  /* ─── CE QUE VOUS GAGNEZ ─────────────────────────────── */
  .si-gain { background: linear-gradient(160deg,#f0fdfa,#ccfbf1); }
  .si-gain-grid { display:grid; grid-template-columns:repeat(auto-fit,minmax(230px,1fr)); gap:1.25rem; margin-top:3rem; }
  .si-gain-item { background:#fff; border-radius:16px; padding:1.5rem; box-shadow:var(--si-shadow); text-align:center; transition:transform .25s; }
  .si-gain-item:hover { transform:translateY(-3px); }
  .si-gain-item__icon { font-size:2.2rem; margin-bottom:.75rem; display:block; }
  .si-gain-item__title { font-size:.95rem; font-weight:700; color:#0f172a; margin-bottom:.4rem; }
  .si-gain-item__desc { font-size:.83rem; color:#64748b; line-height:1.55; }

  /* ─── TABLEAU RÉMUNÉRATION STAGIAIRE ────────────────────── */
  .si-comp { background:#fff; }
  .si-comp-intro {
    background:linear-gradient(135deg,#0f172a,#134e4a);
    border-radius:20px; padding:2rem 2.5rem; margin-top:3rem; color:#fff;
    display:grid; grid-template-columns:1fr 1fr; gap:2rem; align-items:center;
  }
  .si-comp-intro__left h3 { font-size:1.2rem; font-weight:800; margin-bottom:.5rem; }
  .si-comp-intro__left p { font-size:.88rem; color:rgba(255,255,255,.7); line-height:1.6; margin:0; }
  .si-comp-intro__right { display:flex; flex-direction:column; gap:.5rem; }
  .si-comp-pill { display:flex; align-items:center; justify-content:space-between; padding:.5rem 1rem; border-radius:10px; background:rgba(255,255,255,.07); }
  .si-comp-pill__label { font-size:.83rem; color:rgba(255,255,255,.8); }
  .si-comp-pill__val { font-size:.9rem; font-weight:700; color:#34d399; }
  .si-comp-pill--commission { background:rgba(239,68,68,.15); border:1px dashed rgba(239,68,68,.4); }
  .si-comp-pill--commission .si-comp-pill__label { color:rgba(255,255,255,.9); font-weight:600; }
  .si-comp-pill--commission .si-comp-pill__val { color:#fca5a5; }
  .si-comp-pill--degressif { background:rgba(251,191,36,.1); border:1px dashed rgba(251,191,36,.3); font-size:.75rem; color:rgba(255,255,255,.5); padding:.35rem 1rem; border-radius:8px; text-align:center; }

  .si-comp-table { margin-top:2rem; border-radius:16px; overflow:hidden; box-shadow:var(--si-shadow); }
  .si-comp-table-head { display:grid; grid-template-columns:1.8fr 1fr 1fr 2fr; background:var(--si-dark); color:rgba(255,255,255,.6); font-size:.7rem; font-weight:700; text-transform:uppercase; letter-spacing:.08em; padding:.75rem 1.25rem; }
  .si-comp-row { display:grid; grid-template-columns:1.8fr 1fr 1fr 2fr; padding:1rem 1.25rem; background:#fff; border-bottom:1px solid #f1f5f9; align-items:center; transition:background .2s; }
  .si-comp-row:hover { background:#f0fdfa; }
  .si-comp-row:last-child { border-bottom:none; }
  .si-comp-row__level { display:flex; align-items:center; gap:.6rem; }
  .si-comp-row__dot { width:10px; height:10px; border-radius:50%; flex-shrink:0; }
  .si-comp-row__dot--beginner     { background:#22c55e; }
  .si-comp-row__dot--intermediate { background:#f59e0b; }
  .si-comp-row__dot--advanced     { background:#ef4444; }
  .si-comp-row__name { font-size:.88rem; font-weight:700; color:#0f172a; }
  .si-comp-row__role { font-size:.77rem; color:#64748b; margin-top:.15rem; }
  .si-comp-row__pct { font-size:1rem; font-weight:800; color:#0d9488; }
  .si-comp-row__pct-mentor { font-size:.88rem; font-weight:600; color:#475569; }
  .si-comp-row__examples { font-size:.78rem; color:#64748b; line-height:1.5; }

  .si-comp-example-box { margin-top:2rem; background:linear-gradient(135deg,#f0fdfa,#ccfbf1); border-radius:16px; padding:2rem; }
  .si-comp-example-box h4 { font-size:1rem; font-weight:800; color:#0f172a; margin-bottom:1.25rem; }
  .si-comp-sim-grid { display:grid; grid-template-columns:repeat(auto-fit,minmax(200px,1fr)); gap:1rem; }
  .si-comp-sim { background:#fff; border-radius:12px; padding:1.25rem; box-shadow:var(--si-shadow); }
  .si-comp-sim__badge { font-size:.68rem; font-weight:700; text-transform:uppercase; letter-spacing:.07em; border-radius:999px; padding:.2rem .7rem; display:inline-block; margin-bottom:.75rem; }
  .si-comp-sim__badge--beginner     { background:#dcfce7; color:#15803d; }
  .si-comp-sim__badge--intermediate { background:#fef3c7; color:#b45309; }
  .si-comp-sim__badge--advanced     { background:#fee2e2; color:#b91c1c; }
  .si-comp-sim__gross { font-size:.78rem; color:#64748b; margin-bottom:.3rem; }
  .si-comp-sim__row { display:flex; justify-content:space-between; font-size:.83rem; margin-bottom:.25rem; }
  .si-comp-sim__row span:first-child { color:#64748b; }
  .si-comp-sim__row--intern span:last-child { color:#0d9488; font-weight:700; }
  .si-comp-sim__row--mentor span:last-child { color:#475569; font-weight:600; }
  .si-comp-sim__divider { border:none; border-top:1px solid #e2e8f0; margin:.5rem 0; }

  /* diff banner */
  .si-vs-junior { background:#eff6ff; border:2px solid #bfdbfe; border-radius:16px; padding:1.5rem 2rem; margin-top:2rem; display:flex; align-items:center; gap:1.5rem; flex-wrap:wrap; }
  .si-vs-junior__text { flex:1; min-width:220px; }
  .si-vs-junior__text strong { color:#1e40af; }
  .si-vs-junior__text p { font-size:.85rem; color:#3b82f6; margin:0; }
  .si-vs-junior__cta { flex-shrink:0; display:inline-flex; align-items:center; gap:.4rem; background:#2563eb; color:#fff; font-size:.85rem; font-weight:700; padding:.6rem 1.25rem; border-radius:10px; text-decoration:none; }
  .si-vs-junior__cta:hover { background:#1d4ed8; color:#fff; }

  @media(max-width:640px) {
    .si-comp-table-head,
    .si-comp-row { grid-template-columns:1.5fr 1fr 1fr; }
    .si-comp-table-head > :last-child,
    .si-comp-row__examples { display:none; }
    .si-comp-intro { grid-template-columns:1fr; }
  }
  .si-pay-box {
    background: linear-gradient(135deg, #0f172a, #134e4a);
    border-radius:24px; padding:2.5rem; color:#fff; margin-top:3rem;
  }
  .si-pay-box h3 { font-size:1.3rem; font-weight:800; margin-bottom:.5rem; }
  .si-pay-box p { font-size:.9rem; color:rgba(255,255,255,.7); margin-bottom:1.75rem; }
  .si-pay-row { display:flex; align-items:center; justify-content:space-between; padding:.75rem 1rem; background:rgba(255,255,255,.06); border-radius:10px; margin-bottom:.5rem; }
  .si-pay-row__label { font-size:.88rem; color:rgba(255,255,255,.8); }
  .si-pay-row__value { font-size:.95rem; font-weight:700; }
  .si-pay-row__value--green { color:#34d399; }
  .si-pay-row__value--amber { color:#fbbf24; }
  .si-pay-important {
    margin-top:1.5rem; background:rgba(94,234,212,.1); border:1px solid rgba(94,234,212,.3);
    border-radius:14px; padding:1.25rem 1.5rem; font-size:.88rem; color:#ccfbf1;
    display:flex; align-items:flex-start; gap:.75rem;
  }

  /* ─── PARCOURS ─────────────────────────────────────────── */
  .si-journey { background:linear-gradient(160deg,#f8fafc,#e0f2fe); }
  .si-steps { display:grid; grid-template-columns:repeat(auto-fit,minmax(190px,1fr)); gap:1.5rem; margin-top:3rem; }
  .si-step { background:#fff; border-radius:18px; padding:1.75rem 1.5rem; box-shadow:var(--si-shadow); text-align:center; transition:transform .3s; }
  .si-step:hover { transform:translateY(-4px); box-shadow:var(--si-shadow-hover); }
  .si-step__num { width:50px; height:50px; border-radius:50%; background:var(--si-gradient-teal); color:#fff; font-size:1.25rem; font-weight:900; display:flex; align-items:center; justify-content:center; margin:0 auto 1rem; }
  .si-step__title { font-size:.95rem; font-weight:700; color:#0f172a; margin-bottom:.4rem; }
  .si-step__desc { font-size:.83rem; color:#64748b; line-height:1.55; }
  .si-step__tag { font-size:.7rem; background:var(--si-teal-light); color:var(--si-teal); border-radius:999px; padding:.15rem .7rem; font-weight:600; display:inline-block; margin-top:.5rem; }

  /* ─── CTA ─────────────────────────────────────────────── */
  .si-cta { background:var(--si-gradient); padding:5rem 1.5rem; text-align:center; }
  .si-cta h2 { font-size:clamp(1.8rem,4vw,3rem); font-weight:900; color:#fff; margin-bottom:1rem; }
  .si-cta p { font-size:1.05rem; color:rgba(255,255,255,.7); max-width:520px; margin:0 auto 2.5rem; line-height:1.6; }

  @media(max-width:640px) {
    .si-diff-banner { grid-template-columns:1fr; }
    .si-diff-separator { display:none; }
  }
</style>
@endsection

@section('content')
<div class="si-page">

  {{-- HERO --}}
  <section class="si-hero">
    <div class="si-hero__badge-pay"><i class="fa fa-coins"></i> Stage rémunéré — 20 % → 40 % selon la mission</div>
    <div class="si-hero__eyebrow"><i class="fa fa-graduation-cap"></i> Programme Stagiaire</div>
    <h1 class="si-hero__title">
      Étudiant ? Vivez un <span class="accent">vrai stage encadré</span><br>et soyez rémunéré sur vos missions
    </h1>
    <p class="si-hero__sub">
      Intégrez un pod de mentorat, travaillez sur un projet réel, obtenez votre certificat Junspro
      — et recevez une <strong>gratification progressive</strong> sur chaque mission réalisée.
      Parce que tout travail mérite salaire, même en stage.
    </p>
    <div class="si-cta-group">
      <a href="{{ route('mentorship.subscription.index') }}" class="si-btn-primary">
        <i class="fa fa-graduation-cap"></i> Trouver mon stage — dès 49 €
      </a>
      <a href="#parcours" class="si-btn-ghost">
        <i class="fa fa-play-circle"></i> Voir le parcours
      </a>
    </div>
    <div class="si-hero__stats">
      <div><span class="si-hero__stat-val">4 sem.</span><span class="si-hero__stat-lbl">Cycle de stage</span></div>
      <div><span class="si-hero__stat-val">100 %</span><span class="si-hero__stat-lbl">Projets réels</span></div>
      <div><span class="si-hero__stat-val">Certificat</span><span class="si-hero__stat-lbl">Junspro inclus</span></div>
      <div><span class="si-hero__stat-val">20→40 %</span><span class="si-hero__stat-lbl">Gratification mission</span></div>
    </div>
  </section>

  {{-- DIFFÉRENCE FONDAMENTALE --}}
  <section class="si-section si-diff">
    <div class="si-section-inner">
      <div style="text-align:center;">
        <span class="si-section-label">Comprendre la différence</span>
        <h2 class="si-section-title">Stagiaire ≠ Freelance junior</h2>
        <p class="si-section-sub" style="margin:0 auto;">Deux profils, deux accompagnements, deux logiques économiques différentes.</p>
      </div>
      <div class="si-diff-banner">
        <div class="si-diff-col">
          <span class="si-diff-col__badge si-diff-col__badge--intern">Vous — Stagiaire 🎓</span>
          <div class="si-diff-col__title">Étudiant en formation</div>
          <div class="si-diff-col__desc">Vous êtes encore aux études. Vous cherchez un encadrement professionnel pour valider votre formation.</div>
          <div class="si-diff-col__items">
            <div class="si-diff-col__item"><i class="fa fa-check"></i> Stage pratique sur projet réel</div>
            <div class="si-diff-col__item"><i class="fa fa-check"></i> Certificat de stage Junspro</div>
            <div class="si-diff-col__item"><i class="fa fa-check"></i> Portfolio à montrer en entretien</div>
            <div class="si-diff-col__item" style="color:#0d9488; font-weight:600;"><i class="fa fa-coins" style="color:#0d9488;"></i> Gratification 20/30/40 % selon difficulté</div>
          </div>
        </div>
        <div class="si-diff-separator"><span>VS</span></div>
        <div class="si-diff-col">
          <span class="si-diff-col__badge si-diff-col__badge--junior">Freelance Junior 🚀</span>
          <div class="si-diff-col__title">Diplômé débutant</div>
          <div class="si-diff-col__desc">Vous avez terminé vos études. Vous voulez commencer à facturer mais manquez d'expérience et de clients.</div>
          <div class="si-diff-col__items">
            <div class="si-diff-col__item" style="color:#1d4ed8;"><i class="fa fa-coins" style="color:#2563eb;"></i> Rémunéré sur chaque mission (50–70 %)</div>
            <div class="si-diff-col__item" style="color:#1d4ed8;"><i class="fa fa-check" style="color:#2563eb;"></i> Accès au pipeline client Junspro</div>
            <div class="si-diff-col__item" style="color:#1d4ed8;"><i class="fa fa-check" style="color:#2563eb;"></i> Crédibilité professionnelle</div>
            <div class="si-diff-col__item" style="color:#1d4ed8; font-weight:600;"><i class="fa fa-arrow-right" style="color:#2563eb;"></i> <a href="{{ route('mentorship.become-junior') }}" style="color:#1d4ed8;">Voir le programme junior →</a></div>
          </div>
        </div>
      </div>
    </div>
  </section>

  {{-- CE QUE VOUS GAGNEZ --}}
  <section class="si-section si-gain">
    <div class="si-section-inner">
      <div style="text-align:center;">
        <span class="si-section-label">Valeur du programme</span>
        <h2 class="si-section-title">Ce que vous obtenez en tant que stagiaire</h2>
      </div>
      <div class="si-gain-grid">
        <div class="si-gain-item">
          <span class="si-gain-item__icon">🏢</span>
          <div class="si-gain-item__title">Expérience professionnelle réelle</div>
          <div class="si-gain-item__desc">Vous travaillez sur un projet d'entreprise réel — pas un cas étude fictif. Cela se voit sur un CV.</div>
        </div>
        <div class="si-gain-item">
          <span class="si-gain-item__icon">🎓</span>
          <div class="si-gain-item__title">Certificat de stage Junspro</div>
          <div class="si-gain-item__desc">Attestation de réalisation signée par le mentor et Junspro, avec les missions et jalons validés.</div>
        </div>
        <div class="si-gain-item">
          <span class="si-gain-item__icon">�</span>
          <div class="si-gain-item__title">Gratification réelle (20–40 %)</div>
          <div class="si-gain-item__desc">Vous êtes rémunéré sur chaque mission selon sa difficulté — parce que tout travail mérite salaire.</div>
        </div>
        <div class="si-gain-item">
          <span class="si-gain-item__icon">💼</span>
          <div class="si-gain-item__title">Portfolio concret</div>
          <div class="si-gain-item__desc">Chaque jalon soumis et validé devient une pièce de votre portfolio — utilisable en entretien.</div>
        </div>
        <div class="si-gain-item">
          <span class="si-gain-item__icon">🧠</span>
          <div class="si-gain-item__title">Mentor dédié</div>
          <div class="si-gain-item__desc">Suivi hebdomadaire, feedback direct, questions illimitées auprès d'un expert du secteur.</div>
        </div>
        <div class="si-gain-item">
          <span class="si-gain-item__icon">🌐</span>
          <div class="si-gain-item__title">Réseau professionnel</div>
          <div class="si-gain-item__desc">Le mentor peut vous recommander, vous ouvrir son réseau, ou même vous embaucher après le stage.</div>
        </div>
      </div>
    </div>
  </section>

  {{-- TABLEAU DE COMPENSATION --}}
  <section class="si-section si-comp">
    <div class="si-section-inner">
      <div style="text-align:center;">
        <span class="si-section-label">Rémunération progressive</span>
        <h2 class="si-section-title">Votre gratification selon la difficulté</h2>
        <p class="si-section-sub" style="margin:0 auto;">
          Vous payez un abonnement <em>et</em> vous participez à la livraison réelle.
          Votre part croît avec la complexité de la mission — un arc de progression concret.
        </p>
      </div>

      <div class="si-comp-intro">
        <div class="si-comp-intro__left">
          <h3>Logique du modèle stagiaire</h3>
          <p>
            Sur chaque mission réalisée, Junspro prélève sa commission sur le montant brut client.
            Le reste (montant net) est réparti entre votre mentor et vous selon la difficulté.
            Plus la mission est complexe, plus votre contribution est grande — et mieux vous êtes rémunéré.
          </p>
        </div>
        <div class="si-comp-intro__right">
          <div class="si-comp-pill">
            <span class="si-comp-pill__label">Mission débutant</span>
            <span class="si-comp-pill__val">Vous recevez 20 %</span>
          </div>
          <div class="si-comp-pill">
            <span class="si-comp-pill__label">Mission intermédiaire</span>
            <span class="si-comp-pill__val">Vous recevez 30 %</span>
          </div>
          <div class="si-comp-pill">
            <span class="si-comp-pill__label">Mission avancée</span>
            <span class="si-comp-pill__val">Vous recevez 40 %</span>
          </div>
        </div>
      </div>

      {{-- Tableau --}}
      <div class="si-comp-table">
        <div class="si-comp-table-head">
          <span>Niveau de mission</span>
          <span>Votre part</span>
          <span>Mentor</span>
          <span>Exemples de missions</span>
        </div>

        <div class="si-comp-row">
          <div class="si-comp-row__level">
            <div class="si-comp-row__dot si-comp-row__dot--beginner"></div>
            <div>
              <div class="si-comp-row__name">Débutant</div>
              <div class="si-comp-row__role">Tâches guidées pas à pas</div>
            </div>
          </div>
          <div class="si-comp-row__pct">20 %</div>
          <div class="si-comp-row__pct-mentor">80 %</div>
          <div class="si-comp-row__examples">Intégration HTML/CSS · Rédaction de contenu · Tests manuels</div>
        </div>

        <div class="si-comp-row">
          <div class="si-comp-row__level">
            <div class="si-comp-row__dot si-comp-row__dot--intermediate"></div>
            <div>
              <div class="si-comp-row__name">Intermédiaire</div>
              <div class="si-comp-row__role">Modules supervisés</div>
            </div>
          </div>
          <div class="si-comp-row__pct">30 %</div>
          <div class="si-comp-row__pct-mentor">70 %</div>
          <div class="si-comp-row__examples">Composant front-end · Module backend simple · Analyse de données</div>
        </div>

        <div class="si-comp-row">
          <div class="si-comp-row__level">
            <div class="si-comp-row__dot si-comp-row__dot--advanced"></div>
            <div>
              <div class="si-comp-row__name">Avancé</div>
              <div class="si-comp-row__role">Implémentation technique complexe</div>
            </div>
          </div>
          <div class="si-comp-row__pct">40 %</div>
          <div class="si-comp-row__pct-mentor">60 %</div>
          <div class="si-comp-row__examples">Intégration API tierce · Pipeline ETL · Module de paiement</div>
        </div>
      </div>

      {{-- Simulations chiffrées --}}
      <div class="si-comp-example-box">
        <h4>💡 Exemples chiffrés (mission à 300 € brut, commission Junspro 20 %)</h4>
        <div class="si-comp-sim-grid">
          <div class="si-comp-sim">
            <span class="si-comp-sim__badge si-comp-sim__badge--beginner">Débutant · 20 %</span>
            <div class="si-comp-sim__gross">300 € brut → 240 € net</div>
            <hr class="si-comp-sim__divider">
            <div class="si-comp-sim__row si-comp-sim__row--intern"><span>Vous recevez</span><span>48 €</span></div>
            <div class="si-comp-sim__row si-comp-sim__row--mentor"><span>Mentor</span><span>192 €</span></div>
            <div class="si-comp-sim__row"><span>Commission</span><span style="color:#ef4444">60 €</span></div>
          </div>
          <div class="si-comp-sim">
            <span class="si-comp-sim__badge si-comp-sim__badge--intermediate">Intermédiaire · 30 %</span>
            <div class="si-comp-sim__gross">300 € brut → 240 € net</div>
            <hr class="si-comp-sim__divider">
            <div class="si-comp-sim__row si-comp-sim__row--intern"><span>Vous recevez</span><span>72 €</span></div>
            <div class="si-comp-sim__row si-comp-sim__row--mentor"><span>Mentor</span><span>168 €</span></div>
            <div class="si-comp-sim__row"><span>Commission</span><span style="color:#ef4444">60 €</span></div>
          </div>
          <div class="si-comp-sim">
            <span class="si-comp-sim__badge si-comp-sim__badge--advanced">Avancé · 40 %</span>
            <div class="si-comp-sim__gross">300 € brut → 240 € net</div>
            <hr class="si-comp-sim__divider">
            <div class="si-comp-sim__row si-comp-sim__row--intern"><span>Vous recevez</span><span>96 €</span></div>
            <div class="si-comp-sim__row si-comp-sim__row--mentor"><span>Mentor</span><span>144 €</span></div>
            <div class="si-comp-sim__row"><span>Commission</span><span style="color:#ef4444">60 €</span></div>
          </div>
        </div>
      </div>

      {{-- Comparaison avec junior --}}
      <div class="si-vs-junior">
        <div class="si-vs-junior__text">
          <strong>Vous visez une carrière freelance ?</strong>
          <p>Le programme Freelance Junior offre 50/60/70 % selon la difficulté — pour les diplômés prêts à travailler en autonomie.</p>
        </div>
        <a href="{{ route('mentorship.become-junior') }}" class="si-vs-junior__cta">
          <i class="fa fa-rocket"></i> Voir le programme Junior
        </a>
      </div>
    </div>
  </section>

  {{-- SIMULATEUR DE DIFFICULTÉ --}}
  <section class="si-section" style="background:linear-gradient(160deg,#f8fafc,#f0fdfa);">
    <div class="si-section-inner">
      <div style="text-align:center;">
        <span class="si-section-label">Classification automatique</span>
        <h2 class="si-section-title">Quel est votre niveau sur cette mission ?</h2>
        <p class="si-section-sub" style="margin:0 auto;">Répondez à 5 questions — l'algorithme détermine votre niveau et votre gratification de façon neutre et transparente.</p>
      </div>
      @include('frontend.mentorship.partials.difficulty-scorer', ['traineeType' => 'student'])
    </div>
  </section>
  <section class="si-section si-journey" id="parcours">
    <div class="si-section-inner">
      <div style="text-align:center;">
        <span class="si-section-label">Parcours</span>
        <h2 class="si-section-title">De l'inscription au certificat en 4 étapes</h2>
      </div>
      <div class="si-steps" style="grid-template-columns:repeat(auto-fit,minmax(200px,1fr));">
        <div class="si-step">
          <div class="si-step__num">1</div>
          <div class="si-step__title">Créer votre compte</div>
          <div class="si-step__desc">Inscription gratuite. Renseignez votre spécialisation et niveau d'études.</div>
          <span class="si-step__tag">Gratuit</span>
        </div>
        <div class="si-step">
          <div class="si-step__num">2</div>
          <div class="si-step__title">Souscrire un cycle</div>
          <div class="si-step__desc">Choisissez 1, 2 ou 4 cycles de 4 semaines selon la durée de stage souhaitée.</div>
          <span class="si-step__tag">Dès 49 €</span>
        </div>
        <div class="si-step">
          <div class="si-step__num">3</div>
          <div class="si-step__title">Trouver votre pod</div>
          <div class="si-step__desc">Parcourez les pods ouverts, candidatez au mentor qui correspond à votre domaine.</div>
          <span class="si-step__tag">Votre choix</span>
        </div>
        <div class="si-step">
          <div class="si-step__num" style="background:linear-gradient(135deg,#0d9488,#0891b2);">4</div>
          <div class="si-step__title">Stages + Certificat</div>
          <div class="si-step__desc">Réalisez vos missions, validez vos jalons, recevez votre certificat de stage.</div>
          <span class="si-step__tag">Certifié Junspro</span>
        </div>
      </div>
    </div>
  </section>

  {{-- CTA --}}
  <section class="si-cta">
    <div style="max-width:680px; margin:0 auto;">
      <h2>Prêt·e à démarrer votre stage rémunéré ?</h2>
      <p>Un vrai projet, un vrai mentor, un vrai certificat et une gratification sur chaque mission. Le stage Junspro, c'est la meilleure rampe de lancement pour votre carrière.</p>
      <div class="si-cta-group">
        <a href="{{ route('mentorship.subscription.index') }}" class="si-btn-primary" style="font-size:1.05rem;">
          <i class="fa fa-graduation-cap"></i> Démarrer mon stage — dès 49 €
        </a>
        @guest
          <a href="{{ route('user.signup') }}" class="si-btn-ghost">
            <i class="fa fa-user-plus"></i> Créer mon compte
          </a>
        @endguest
      </div>
      <div style="margin-top:2rem; display:flex; justify-content:center; gap:2rem; flex-wrap:wrap; color:rgba(255,255,255,.5); font-size:.82rem;">
        <span><i class="fa fa-check" style="color:#5eead4; margin-right:.3rem;"></i>Projet réel</span>
        <span><i class="fa fa-check" style="color:#5eead4; margin-right:.3rem;"></i>Certificat inclus</span>
        <span><i class="fa fa-check" style="color:#5eead4; margin-right:.3rem;"></i>20–40 % de gratification</span>
        <span><i class="fa fa-check" style="color:#5eead4; margin-right:.3rem;"></i>Résiliable</span>
      </div>
    </div>
  </section>

</div>
@endsection
