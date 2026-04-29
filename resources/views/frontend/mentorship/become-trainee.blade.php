@extends('frontend.layout')

@section('pageHeading')
  Devenir Stagiaire Junior — Mentorat Junspro
@endsection

@section('metaDescription')
  Rejoignez un pod de mentorat, travaillez sur de vraies missions guidées par un expert, et lancez votre carrière freelance avec un encadrement concret de 4 semaines.
@endsection

@section('style')
<style>
  :root {
    --tj-blue: #2563EB;
    --tj-blue-light: #EFF6FF;
    --tj-indigo: #4338CA;
    --tj-green: #10B981;
    --tj-gold: #F59E0B;
    --tj-dark: #0f172a;
    --tj-gradient: linear-gradient(135deg, #0f172a 0%, #1e3a5f 50%, #1d4ed8 100%);
    --tj-gradient-blue: linear-gradient(135deg, #2563eb 0%, #4338ca 100%);
    --tj-gradient-green: linear-gradient(135deg, #10b981 0%, #059669 100%);
    --tj-shadow: 0 4px 24px rgba(37,99,235,.1);
    --tj-shadow-hover: 0 16px 48px rgba(37,99,235,.2);
  }

  .tj-page { background: #f0f4ff; min-height: 100vh; }

  /* ─── HERO ─────────────────────────────────────────────── */
  .tj-hero {
    background: var(--tj-gradient);
    padding: 5rem 1.5rem 6rem;
    text-align: center;
    position: relative;
    overflow: hidden;
  }
  .tj-hero::before {
    content: '';
    position: absolute;
    inset: 0;
    background: url("data:image/svg+xml,%3Csvg width='80' height='80' viewBox='0 0 80 80' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none'%3E%3Cg fill='%23ffffff' fill-opacity='0.03'%3E%3Cpath d='M50 50L80 80H20L50 50zM0 0l30 30L0 60V0z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
  }
  .tj-hero__eyebrow {
    display: inline-flex; align-items: center; gap: .5rem;
    background: rgba(37,99,235,.2); color: #93c5fd; border: 1px solid rgba(147,197,253,.3);
    font-size: .75rem; font-weight: 700; letter-spacing: .1em; text-transform: uppercase;
    border-radius: 999px; padding: .35rem 1.1rem; margin-bottom: 1.5rem;
  }
  .tj-hero__title {
    font-size: clamp(2.2rem, 6vw, 3.8rem); font-weight: 900; line-height: 1.1;
    color: #fff; margin-bottom: 1.25rem; max-width: 820px; margin-left: auto; margin-right: auto;
  }
  .tj-hero__title .accent {
    background: linear-gradient(135deg, #60a5fa, #34d399);
    -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;
  }
  .tj-hero__sub {
    font-size: 1.15rem; color: rgba(255,255,255,.72); max-width: 600px;
    margin: 0 auto 2.5rem; line-height: 1.65;
  }
  .tj-btn-primary {
    display: inline-flex; align-items: center; gap: .5rem;
    background: var(--tj-gradient-green); color: #fff;
    font-size: 1rem; font-weight: 800; padding: .9rem 2.2rem;
    border-radius: 12px; text-decoration: none; transition: transform .2s, box-shadow .2s;
    box-shadow: 0 4px 20px rgba(16,185,129,.35);
  }
  .tj-btn-primary:hover { transform: translateY(-2px); box-shadow: 0 8px 32px rgba(16,185,129,.5); color: #fff; }
  .tj-btn-ghost {
    display: inline-flex; align-items: center; gap: .5rem;
    background: rgba(255,255,255,.08); color: rgba(255,255,255,.9);
    border: 1px solid rgba(255,255,255,.2); font-size: .95rem; font-weight: 600;
    padding: .9rem 2rem; border-radius: 12px; text-decoration: none; transition: background .2s;
  }
  .tj-btn-ghost:hover { background: rgba(255,255,255,.14); color: #fff; }
  .tj-cta-group { display: flex; gap: 1rem; justify-content: center; flex-wrap: wrap; }

  .tj-hero__stats {
    display: flex; justify-content: center; gap: 3rem; flex-wrap: wrap;
    margin-top: 3.5rem; padding-top: 3rem; border-top: 1px solid rgba(255,255,255,.1);
  }
  .tj-hero__stat-val { font-size: 2.2rem; font-weight: 900; color: #60a5fa; display: block; }
  .tj-hero__stat-lbl { font-size: .78rem; color: rgba(255,255,255,.5); text-transform: uppercase; letter-spacing: .08em; }

  /* ─── SECTION ─────────────────────────────────────────── */
  .tj-section { padding: 5rem 1.5rem; }
  .tj-section-inner { max-width: 1100px; margin: 0 auto; }
  .tj-section-label {
    display: inline-block; font-size: .72rem; font-weight: 700; letter-spacing: .12em;
    text-transform: uppercase; color: var(--tj-blue); background: var(--tj-blue-light);
    border-radius: 999px; padding: .28rem .9rem; margin-bottom: 1rem;
  }
  .tj-section-title { font-size: clamp(1.6rem, 3vw, 2.4rem); font-weight: 800; color: #0f172a; margin-bottom: .75rem; line-height: 1.2; }
  .tj-section-sub { font-size: 1rem; color: #64748b; max-width: 560px; line-height: 1.65; }

  /* ─── PROFILS ─────────────────────────────────────────── */
  .tj-profiles { background: #fff; }
  .tj-profile-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 1.5rem; margin-top: 3rem; }
  .tj-profile-card {
    border-radius: 20px; padding: 2rem 1.75rem;
    border: 2px solid transparent; transition: transform .3s, box-shadow .3s, border-color .3s;
    background: #f8fafc; position: relative;
  }
  .tj-profile-card:hover { transform: translateY(-4px); box-shadow: var(--tj-shadow-hover); border-color: #bfdbfe; }
  .tj-profile-card__icon {
    width: 56px; height: 56px; border-radius: 16px;
    background: var(--tj-gradient-blue); display: flex; align-items: center; justify-content: center;
    font-size: 1.6rem; margin-bottom: 1.25rem;
  }
  .tj-profile-card__title { font-size: 1.1rem; font-weight: 800; color: #0f172a; margin-bottom: .5rem; }
  .tj-profile-card__desc { font-size: .9rem; color: #64748b; line-height: 1.6; margin-bottom: 1rem; }
  .tj-profile-card__tag { display: inline-block; font-size: .75rem; font-weight: 600; background: var(--tj-blue-light); color: var(--tj-blue); border-radius: 6px; padding: .2rem .6rem; margin: 2px; }
  .tj-profile-card--best { border-color: var(--tj-blue); background: #eff6ff; }
  .tj-profile-card__badge {
    position: absolute; top: -.5rem; right: 1rem;
    background: var(--tj-gradient-blue); color: #fff;
    font-size: .68rem; font-weight: 700; letter-spacing: .06em; text-transform: uppercase;
    padding: .25rem .75rem; border-radius: 999px;
  }

  /* ─── AVANTAGES ────────────────────────────────────────── */
  .tj-benefits { background: linear-gradient(160deg, #eff6ff, #e0e7ff); }
  .tj-benefit-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 1.25rem; margin-top: 3rem; }
  .tj-benefit {
    background: #fff; border-radius: 16px; padding: 1.5rem;
    box-shadow: var(--tj-shadow); text-align: center;
    transition: transform .25s;
  }
  .tj-benefit:hover { transform: translateY(-3px); }
  .tj-benefit__icon { font-size: 2.2rem; margin-bottom: .75rem; display: block; }
  .tj-benefit__title { font-size: .95rem; font-weight: 700; color: #0f172a; margin-bottom: .4rem; }
  .tj-benefit__desc { font-size: .83rem; color: #64748b; line-height: 1.55; }

  /* ─── PARCOURS ─────────────────────────────────────────── */
  .tj-journey { background: #fff; }
  .tj-journey-steps { display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 0; margin-top: 3rem; position: relative; }
  .tj-journey-steps::before {
    content: ''; position: absolute; top: 30px; left: 5%; right: 5%; height: 2px;
    background: linear-gradient(90deg, var(--tj-blue), var(--tj-green));
    z-index: 0;
  }
  .tj-jstep { text-align: center; padding: 0 1rem; position: relative; z-index: 1; }
  .tj-jstep__num {
    width: 60px; height: 60px; border-radius: 50%;
    background: var(--tj-gradient-blue); color: #fff;
    font-size: 1.3rem; font-weight: 900;
    display: flex; align-items: center; justify-content: center;
    margin: 0 auto 1.25rem; box-shadow: 0 4px 16px rgba(37,99,235,.35);
    position: relative;
  }
  .tj-jstep__num--done { background: var(--tj-gradient-green); }
  .tj-jstep__title { font-size: .95rem; font-weight: 700; color: #0f172a; margin-bottom: .4rem; }
  .tj-jstep__desc { font-size: .83rem; color: #64748b; line-height: 1.55; }
  .tj-jstep__tag { font-size: .72rem; background: #eff6ff; color: var(--tj-blue); border-radius: 999px; padding: .15rem .7rem; font-weight: 600; display: inline-block; margin-top: .5rem; }

  /* ─── RÉMUNÉRATION ─────────────────────────────────────── */
  .tj-pay { background: linear-gradient(160deg, #f0fdf4, #dcfce7); }
  .tj-pay-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 2rem; margin-top: 3rem; align-items: start; }
  .tj-pay-card {
    background: #fff; border-radius: 20px; overflow: hidden;
    box-shadow: var(--tj-shadow);
  }
  .tj-pay-card__header { padding: 1.25rem 1.75rem; font-size: .95rem; font-weight: 700; color: #fff; }
  .tj-pay-card__header--trainee { background: var(--tj-gradient-blue); }
  .tj-pay-card__header--mentor  { background: linear-gradient(135deg,#7c3aed,#4f46e5); }
  .tj-pay-card__body { padding: 1.75rem; }
  .tj-pay-row { display: flex; justify-content: space-between; align-items: center; padding: .6rem 0; border-bottom: 1px solid #f1f5f9; font-size: .88rem; }
  .tj-pay-row:last-child { border-bottom: none; }
  .tj-pay-row__label { color: #64748b; }
  .tj-pay-row__value { font-weight: 700; color: #0f172a; }
  .tj-pay-row__value--green { color: var(--tj-green); }

  .tj-pay-note {
    grid-column: 1 / -1; padding: 1.25rem 1.75rem; background: #fffbeb;
    border: 1.5px solid #fde68a; border-radius: 14px;
    font-size: .85rem; color: #92400e; display: flex; align-items: flex-start; gap: .75rem;
  }

  /* ─── CONDITIONS ─────────────────────────────────────────── */
  .tj-access { background: #fff; }
  .tj-access-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 1.25rem; margin-top: 2.5rem; }
  .tj-access-item {
    display: flex; align-items: flex-start; gap: 1rem; padding: 1.25rem 1.5rem;
    background: #f8fafc; border-radius: 14px; border: 1.5px solid #e2e8f0;
  }
  .tj-access-icon { font-size: 1.4rem; flex-shrink: 0; margin-top: 2px; }
  .tj-access-label { font-size: .92rem; font-weight: 700; color: #0f172a; }
  .tj-access-desc  { font-size: .82rem; color: #64748b; margin-top: .2rem; line-height: 1.4; }

  /* ─── CTA FINAL ────────────────────────────────────────── */
  .tj-cta-section {
    background: var(--tj-gradient);
    padding: 5rem 1.5rem; text-align: center;
  }
  .tj-cta-section h2 { font-size: clamp(1.8rem, 4vw, 3rem); font-weight: 900; color: #fff; margin-bottom: 1rem; }
  .tj-cta-section p { font-size: 1.05rem; color: rgba(255,255,255,.7); max-width: 520px; margin: 0 auto 2.5rem; line-height: 1.6; }

  /* responsive */
  @media (max-width: 640px) {
    .tj-journey-steps { gap: 2rem; }
    .tj-journey-steps::before { display: none; }
    .tj-pay-grid { grid-template-columns: 1fr; }
    .tj-pay-note { grid-column: auto; }
  }
</style>
@endsection

@section('content')
<div class="tj-page">

  {{-- ═══════════════════════════════════════════════════════
       HERO
  ═══════════════════════════════════════════════════════ --}}
  <section class="tj-hero">
    <div class="tj-hero__eyebrow">
      <i class="fa fa-seedling"></i> Programme Stagiaire Junior
    </div>
    <h1 class="tj-hero__title">
      Lancez votre carrière freelance<br>avec un <span class="accent">mentor expert à vos côtés</span>
    </h1>
    <p class="tj-hero__sub">
      Rejoignez un pod de mentorat, travaillez sur de vraies missions,
      soyez payé dès le premier projet — et devenez un freelance crédible
      en seulement 4 semaines.
    </p>
    <div class="tj-cta-group">
      <a href="{{ route('mentorship.subscription.index') }}" class="tj-btn-primary">
        <i class="fa fa-rocket"></i> Commencer — dès 49 €
      </a>
      <a href="#comment-ca-marche" class="tj-btn-ghost">
        <i class="fa fa-play-circle"></i> Voir comment ça marche
      </a>
    </div>

    <div class="tj-hero__stats">
      <div>
        <span class="tj-hero__stat-val">4 sem.</span>
        <span class="tj-hero__stat-lbl">Cycle de mentorat</span>
      </div>
      <div>
        <span class="tj-hero__stat-val">50–70 %</span>
        <span class="tj-hero__stat-lbl">Part junior selon la difficulté</span>
      </div>
      <div>
        <span class="tj-hero__stat-val">3+</span>
        <span class="tj-hero__stat-lbl">Missions réelles par cycle</span>
      </div>
      <div>
        <span class="tj-hero__stat-val">100 %</span>
        <span class="tj-hero__stat-lbl">En ligne, à votre rythme</span>
      </div>
    </div>
  </section>

  {{-- ═══════════════════════════════════════════════════════
       POUR QUI ?
  ═══════════════════════════════════════════════════════ --}}
  <section class="tj-section tj-profiles" id="pour-qui">
    <div class="tj-section-inner">
      <div style="text-align:center; margin-bottom:.5rem;">
        <span class="tj-section-label">Pour qui ?</span>
        <h2 class="tj-section-title">Deux profils de stagiaires</h2>
        <p class="tj-section-sub" style="margin:0 auto;">
          Que vous soyez encore en formation ou fraîchement diplômé,
          le programme s'adapte à votre niveau.
        </p>
      </div>

      <div class="tj-profile-grid">

        {{-- Étudiant --}}
        <div class="tj-profile-card tj-profile-card--best">
          <span class="tj-profile-card__badge">Recommandé</span>
          <div class="tj-profile-card__icon">🎓</div>
          <div class="tj-profile-card__title">Étudiant actif</div>
          <div class="tj-profile-card__desc">
            Vous êtes en école, en BTS, en licence pro ou en bootcamp.
            Vous voulez pratiquer sur de vraies missions en parallèle de vos études
            et commencer à construire vos revenus et votre portfolio.
          </div>
          <div>
            <span class="tj-profile-card__tag">Études en cours</span>
            <span class="tj-profile-card__tag">Portfolio vide à remplir</span>
            <span class="tj-profile-card__tag">0–2 ans d'expérience</span>
          </div>
        </div>

        {{-- Diplômé junior --}}
        <div class="tj-profile-card">
          <div class="tj-profile-card__icon">🚀</div>
          <div class="tj-profile-card__title">Diplômé en reconversion</div>
          <div class="tj-profile-card__desc">
            Vous êtes diplômé récemment ou en reconversion professionnelle.
            Vous maîtrisez les bases mais manquez de projets concrets pour
            décrocher vos premières missions en indépendant.
          </div>
          <div>
            <span class="tj-profile-card__tag">Diplômé récent</span>
            <span class="tj-profile-card__tag">Reconversion</span>
            <span class="tj-profile-card__tag">Besoin de clients réels</span>
          </div>
        </div>

      </div>
    </div>
  </section>

  {{-- ═══════════════════════════════════════════════════════
       CE QUE VOUS GAGNEZ
  ═══════════════════════════════════════════════════════ --}}
  <section class="tj-section tj-benefits">
    <div class="tj-section-inner">
      <div style="text-align:center; margin-bottom:.5rem;">
        <span class="tj-section-label">Avantages</span>
        <h2 class="tj-section-title">Ce que vous gagnez en rejoignant un pod</h2>
      </div>

      <div class="tj-benefit-grid">
        <div class="tj-benefit">
          <span class="tj-benefit__icon">💼</span>
          <div class="tj-benefit__title">Vraies missions, vrai portfolio</div>
          <div class="tj-benefit__desc">Travaillez sur des projets réels avec un vrai client. Chaque mission validée enrichit votre portfolio.</div>
        </div>
        <div class="tj-benefit">
          <span class="tj-benefit__icon">💰</span>
          <div class="tj-benefit__title">Rémunération dès le 1er projet</div>
          <div class="tj-benefit__desc">Vous recevez votre part automatiquement via Stripe Connect — 50 à 70 % selon la complexité du projet.</div>
        </div>
        <div class="tj-benefit">
          <span class="tj-benefit__icon">🧠</span>
          <div class="tj-benefit__title">Un mentor expert en direct</div>
          <div class="tj-benefit__desc">Check-ins hebdomadaires, suivi des jalons, feedback personnalisé à chaque étape.</div>
        </div>
        <div class="tj-benefit">
          <span class="tj-benefit__icon">🏆</span>
          <div class="tj-benefit__title">Certificat de validation</div>
          <div class="tj-benefit__desc">À la fin du cycle, recevez un certificat Junspro attestant vos compétences et missions réalisées.</div>
        </div>
        <div class="tj-benefit">
          <span class="tj-benefit__icon">🌐</span>
          <div class="tj-benefit__title">Réseau freelance actif</div>
          <div class="tj-benefit__desc">Intégrez la communauté Junspro et accédez aux opportunités clients normalement réservées aux profils confirmés.</div>
        </div>
        <div class="tj-benefit">
          <span class="tj-benefit__icon">📈</span>
          <div class="tj-benefit__title">Progression mesurée</div>
          <div class="tj-benefit__desc">Tableau de bord avec jalons, progression par mission et score de fiabilité — tout est trackable.</div>
        </div>
      </div>
    </div>
  </section>

  {{-- ═══════════════════════════════════════════════════════
       COMMENT ÇA MARCHE
  ═══════════════════════════════════════════════════════ --}}
  <section class="tj-section tj-journey" id="comment-ca-marche">
    <div class="tj-section-inner">
      <div style="text-align:center; margin-bottom:.5rem;">
        <span class="tj-section-label">Parcours</span>
        <h2 class="tj-section-title">Votre parcours en 5 étapes</h2>
        <p class="tj-section-sub" style="margin:0 auto;">
          De zéro à stagiaire actif en quelques clics.
        </p>
      </div>

      <div class="tj-journey-steps" style="grid-template-columns:repeat(5,1fr);">
        <div class="tj-jstep">
          <div class="tj-jstep__num">1</div>
          <div class="tj-jstep__title">Créer un compte</div>
          <div class="tj-jstep__desc">Inscrivez-vous gratuitement sur Junspro en 2 minutes.</div>
          <span class="tj-jstep__tag">Gratuit</span>
        </div>
        <div class="tj-jstep">
          <div class="tj-jstep__num">2</div>
          <div class="tj-jstep__title">Compléter votre profil</div>
          <div class="tj-jstep__desc">Renseignez vos compétences, votre niveau et vos disponibilités.</div>
          <span class="tj-jstep__tag">5 min</span>
        </div>
        <div class="tj-jstep">
          <div class="tj-jstep__num">3</div>
          <div class="tj-jstep__title">Souscrire un cycle</div>
          <div class="tj-jstep__desc">Choisissez votre plan (1, 2 ou 4 cycles de 4 semaines) — à partir de 49 €.</div>
          <span class="tj-jstep__tag">Dès 49 €</span>
        </div>
        <div class="tj-jstep">
          <div class="tj-jstep__num">4</div>
          <div class="tj-jstep__title">Rejoindre un pod</div>
          <div class="tj-jstep__desc">Parcourez les pods ouverts et candidatez au mentor qui correspond à votre domaine.</div>
          <span class="tj-jstep__tag">Votre choix</span>
        </div>
        <div class="tj-jstep">
          <div class="tj-jstep__num tj-jstep__num--done">5</div>
          <div class="tj-jstep__title">Travailler & être payé</div>
          <div class="tj-jstep__desc">Suivez les missions, soumettez vos jalons, recevez votre rémunération automatiquement.</div>
          <span class="tj-jstep__tag" style="background:#d1fae5;color:#065f46;">Stripe Connect</span>
        </div>
      </div>
    </div>
  </section>

  {{-- ═══════════════════════════════════════════════════════
       RÉMUNÉRATION
  ═══════════════════════════════════════════════════════ --}}
  <section class="tj-section tj-pay" id="remuneration">
    <div class="tj-section-inner">
      <div style="text-align:center; margin-bottom:.5rem;">
        <span class="tj-section-label" style="background:#d1fae5;color:#065f46;">Rémunération</span>
        <h2 class="tj-section-title">Ce que vous touchez réellement</h2>
        <p class="tj-section-sub" style="margin:0 auto;">
          Votre part est calculée automatiquement selon la difficulté du projet.
          Plus la mission est complexe, plus <strong>votre expertise est récompensée</strong>.
        </p>
      </div>

      <div class="tj-pay-grid">

        {{-- Card stagiaire --}}
        <div class="tj-pay-card">
          <div class="tj-pay-card__header tj-pay-card__header--trainee">
            📊 Votre part selon la difficulté
          </div>
          <div class="tj-pay-card__body">
            <div class="tj-pay-row">
              <span class="tj-pay-row__label">🌱 Mission débutante</span>
              <span class="tj-pay-row__value tj-pay-row__value--green">50 % pour vous</span>
            </div>
            <div class="tj-pay-row">
              <span class="tj-pay-row__label">⚡ Mission intermédiaire</span>
              <span class="tj-pay-row__value">60 % pour vous</span>
            </div>
            <div class="tj-pay-row">
              <span class="tj-pay-row__label">🏆 Mission avancée</span>
              <span class="tj-pay-row__value">70 % pour vous</span>
            </div>
            <div style="margin-top:1.25rem; padding:1rem; background:#f0fdf4; border-radius:12px; font-size:.83rem; color:#065f46;">
              <strong>Exemple :</strong> Mission avancée à 300 € brut,<br>
              commission Junspro 20 % (60 €) →
              <strong>Vous recevez 168 €</strong>
            </div>
          </div>
        </div>

        {{-- Card plans --}}
        <div class="tj-pay-card">
          <div class="tj-pay-card__header" style="background:linear-gradient(135deg,#1e3a5f,#2563eb);">
            💳 Coût de l'abonnement mentorat
          </div>
          <div class="tj-pay-card__body">
            <div class="tj-pay-row">
              <span class="tj-pay-row__label">Découverte (1 cycle · 4 sem.)</span>
              <span class="tj-pay-row__value">49 €</span>
            </div>
            <div class="tj-pay-row">
              <span class="tj-pay-row__label">Régulier (2 cycles · 8 sem.)</span>
              <span class="tj-pay-row__value">89 € <small style="color:#94a3b8;font-weight:400;">(-9%)</small></span>
            </div>
            <div class="tj-pay-row">
              <span class="tj-pay-row__label">Engagement (4 cycles · 16 sem.)</span>
              <span class="tj-pay-row__value">159 € <small style="color:#94a3b8;font-weight:400;">(-19%)</small></span>
            </div>
            <div style="margin-top:1.25rem; padding:1rem; background:#eff6ff; border-radius:12px; font-size:.83rem; color:#1e40af;">
              L'abonnement couvre votre accès au programme, aux missions
              et au suivi mentor. Il se rembourse souvent dès la première mission réalisée.
            </div>
          </div>
        </div>

        <div class="tj-pay-note">
          <i class="fa fa-info-circle" style="margin-top:2px; flex-shrink:0;"></i>
          <span>
            Les paiements sont versés directement sur votre compte Stripe Connect
            à la validation du jalon par le mentor. Aucune avance sur salaire —
            vous êtes payé à la livraison.
          </span>
        </div>

      </div>
    </div>
  </section>

  {{-- ═══════════════════════════════════════════════════════
       CONDITIONS D'ACCÈS
  ═══════════════════════════════════════════════════════ --}}
  <section class="tj-section tj-access" id="conditions">
    <div class="tj-section-inner">
      <div style="text-align:center; margin-bottom:.5rem;">
        <span class="tj-section-label">Conditions d'accès</span>
        <h2 class="tj-section-title">Simple et ouvert à tous</h2>
        <p class="tj-section-sub" style="margin:0 auto;">
          Contrairement au programme mentor, il n'y a pas de critères restrictifs —
          seule votre motivation compte.
        </p>
      </div>

      <div class="tj-access-grid">
        <div class="tj-access-item">
          <span class="tj-access-icon">📧</span>
          <div>
            <div class="tj-access-label">Créer un compte Junspro</div>
            <div class="tj-access-desc">Inscription gratuite avec e-mail valide. Vous trouverez le bouton "S'inscrire" en haut de chaque page.</div>
          </div>
        </div>
        <div class="tj-access-item">
          <span class="tj-access-icon">💳</span>
          <div>
            <div class="tj-access-label">Souscrire un plan mentorat</div>
            <div class="tj-access-desc">À partir de 49 € pour 4 semaines. C'est ce qui débloque l'accès au tableau de bord stagiaire et aux pods.</div>
          </div>
        </div>
        <div class="tj-access-item">
          <span class="tj-access-icon">🏦</span>
          <div>
            <div class="tj-access-label">Compte bancaire / Stripe</div>
            <div class="tj-access-desc">Pour recevoir votre rémunération sur les projets, vous devrez connecter un compte Stripe (guidé lors du premier paiement).</div>
          </div>
        </div>
        <div class="tj-access-item">
          <span class="tj-access-icon">🎯</span>
          <div>
            <div class="tj-access-label">Un domaine à travailler</div>
            <div class="tj-access-desc">Web, mobile, design, marketing, data… Précisez votre domaine pour être matching avec le bon mentor.</div>
          </div>
        </div>
      </div>
    </div>
  </section>

  {{-- ═══════════════════════════════════════════════════════
       CTA FINAL
  ═══════════════════════════════════════════════════════ --}}
  <section class="tj-cta-section">
    <div style="max-width:700px; margin:0 auto;">
      <h2>Prêt à vous lancer ?</h2>
      <p>
        Rejoignez un pod de mentorat dès aujourd'hui.
        Choisissez votre plan, trouvez votre mentor, et commencez à travailler
        sur de vraies missions dès cette semaine.
      </p>
      <div class="tj-cta-group">
        <a href="{{ route('mentorship.subscription.index') }}" class="tj-btn-primary" style="font-size:1.1rem; padding:1rem 2.5rem;">
          <i class="fa fa-rocket"></i> Choisir mon plan — dès 49 €
        </a>
        @guest
          <a href="{{ route('user.signup') }}" class="tj-btn-ghost">
            <i class="fa fa-user-plus"></i> Créer mon compte gratuitement
          </a>
        @endguest
      </div>

      <div style="margin-top:2.5rem; display:flex; justify-content:center; gap:2rem; flex-wrap:wrap; color:rgba(255,255,255,.55); font-size:.82rem;">
        <span><i class="fa fa-check" style="color:#34d399; margin-right:.3rem;"></i>Aucun engagement long terme</span>
        <span><i class="fa fa-check" style="color:#34d399; margin-right:.3rem;"></i>Résiliable à tout moment</span>
        <span><i class="fa fa-check" style="color:#34d399; margin-right:.3rem;"></i>Paiement sécurisé Stripe</span>
        <span><i class="fa fa-check" style="color:#34d399; margin-right:.3rem;"></i>Certificat inclus</span>
      </div>
    </div>
  </section>

</div>
@endsection

@section('script')
<script>
document.querySelectorAll('a[href^="#"]').forEach(a => {
  a.addEventListener('click', e => {
    const target = document.querySelector(a.getAttribute('href'));
    if (target) { e.preventDefault(); target.scrollIntoView({ behavior: 'smooth', block: 'start' }); }
  });
});
</script>
@endsection
