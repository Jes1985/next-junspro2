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
  --ps-muted:     rgba(232,224,208,.78);
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
  font-size:1.05rem; letter-spacing:.25em; text-transform:uppercase;
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
  font-size:1rem; color:var(--ps-text); flex-wrap:wrap; text-align:center;
}
.ps-hero__rule strong { color:var(--ps-gold); font-size:1rem; }

/* ════ SECTION TITLES ════ */
.ps-section-head {
  max-width:760px; margin:4rem auto 2rem; padding:0 2rem; text-align:center;
}
.ps-section-head__eyebrow {
  font-size:1.05rem; letter-spacing:.22em; text-transform:uppercase;
  color:rgba(201,168,76,.75); margin-bottom:.75rem;
}
.ps-section-head__title {
  font-size:clamp(1.3rem,3vw,1.8rem); font-weight:300; font-family:Georgia,serif;
  color:#fff; margin-bottom:.6rem; line-height:1.35;
}
.ps-section-head__title em { color:var(--ps-gold); font-style:italic; }
.ps-section-head__sub {
  font-size:1.1rem; color:var(--ps-muted); line-height:1.85; max-width:520px; margin:0 auto;
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
  font-size:1.05rem; text-transform:uppercase; letter-spacing:.16em;
  color:rgba(201,168,76,.8); margin-bottom:.5rem;
}
.ps-philo__text { font-size:1.1rem; color:var(--ps-text); line-height:1.85; }
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
.ps-card__prof { font-size:1.1rem; color:var(--ps-muted); line-height:1.5; }
.ps-card__tag {
  font-size:1.05rem; font-weight:700; letter-spacing:.06em;
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

.ps-card--bebe     .ps-card__icon { background:rgba(244,114,182,.1); }
.ps-card--bebe     .ps-card__tag  { background:rgba(244,114,182,.1); color:#f9a8d4; border:1px solid rgba(244,114,182,.25); }
.ps-card--bebe     { border-left:3px solid rgba(244,114,182,.4); }

.ps-card--proches  .ps-card__icon { background:rgba(251,146,60,.1); }
.ps-card--proches  .ps-card__tag  { background:rgba(251,146,60,.1); color:#fdba74; border:1px solid rgba(251,146,60,.25); }
.ps-card--proches  { border-left:3px solid rgba(251,146,60,.4); }

/* ══ SECTION VISION ══ */
.ps-vision {
  position:relative; overflow:hidden;
  background:linear-gradient(135deg,rgba(201,168,76,.07) 0%,rgba(0,0,0,0) 55%,rgba(201,168,76,.04) 100%);
  border:1px solid rgba(201,168,76,.18); border-radius:20px;
  padding:4.5rem 3.5rem; text-align:center;
}
@media(max-width:680px){ .ps-vision{ padding:3rem 1.5rem; } }
.ps-vision__bg-text {
  position:absolute; top:50%; left:50%; transform:translate(-50%,-50%);
  font-size:16rem; font-weight:900; letter-spacing:.12em;
  color:rgba(201,168,76,.04); pointer-events:none; white-space:nowrap; user-select:none;
}
.ps-vision__eyebrow {
  font-size:.72rem; text-transform:uppercase; letter-spacing:.22em;
  color:var(--ps-gold); margin-bottom:1.2rem; position:relative;
}
.ps-vision__title {
  font-size:clamp(1.9rem,4vw,3rem); font-weight:800; color:#fff;
  line-height:1.15; margin-bottom:1.5rem; position:relative;
}
.ps-vision__title em { color:var(--ps-gold); font-style:normal; }
.ps-vision__lead {
  max-width:560px; margin:0 auto 3rem;
  font-size:1.05rem; color:var(--ps-muted); line-height:1.85; position:relative;
}
.ps-vision__lead em { color:rgba(255,255,255,.8); }
.ps-vision__pillars {
  display:grid; grid-template-columns:repeat(3,1fr); gap:1.5rem;
  text-align:left; margin-bottom:3rem; position:relative;
}
@media(max-width:680px){ .ps-vision__pillars{ grid-template-columns:1fr; } }
.ps-vision__pillar {
  background:rgba(255,255,255,.025); border:1px solid rgba(255,255,255,.07);
  border-radius:14px; padding:1.7rem; transition:border-color .2s;
}
.ps-vision__pillar:hover { border-color:rgba(201,168,76,.25); }
.ps-vision__pillar-icon { font-size:2rem; margin-bottom:.75rem; }
.ps-vision__pillar-title { font-size:1rem; font-weight:700; color:#fff; margin-bottom:.6rem; }
.ps-vision__pillar p { font-size:.88rem; color:var(--ps-muted); line-height:1.8; margin:0; }
.ps-vision__divider { width:40px; height:2px; background:rgba(201,168,76,.3); margin:0 auto 2.2rem; position:relative; }
.ps-vision__quote {
  max-width:550px; margin:0 auto; font-size:1.1rem; color:rgba(255,255,255,.7);
  font-style:italic; line-height:1.75; border-top:1px solid rgba(201,168,76,.2);
  padding-top:2rem; position:relative;
}
.ps-vision__quote-mark { font-size:1.5rem; color:var(--ps-gold); vertical-align:-.12em; margin:0 .15rem; }

.ps-card__body {
  padding:0 1.75rem 1.75rem;
  border-top:1px solid rgba(255,255,255,.05);
}
.ps-card__subtitle {
  font-size:1rem; color:var(--ps-muted); font-style:italic;
  padding:.8rem 0 .6rem; line-height:1.7;
}
.ps-card__moment {
  background:rgba(0,0,0,.25); border:1px solid rgba(255,255,255,.07);
  border-radius:12px; padding:1.1rem 1.35rem; margin:.5rem 0 .75rem;
}
.ps-card__moment-label {
  font-size:1.05rem; text-transform:uppercase; letter-spacing:.14em;
  color:var(--ps-muted); margin-bottom:.6rem;
}
.ps-card__moment-text {
  font-size:1.05rem; color:var(--ps-text); line-height:1.85; font-style:italic;
}
.ps-card__moment-text strong { color:#fff; font-style:normal; }
.ps-card__examples {
  display:flex; flex-wrap:wrap; gap:.4rem; margin-top:.75rem;
}
.ps-card__ex {
  font-size:1.1rem; color:var(--ps-muted);
  background:rgba(255,255,255,.04); border:1px solid rgba(255,255,255,.07);
  border-radius:6px; padding:.25rem .65rem;
}
.ps-card__result {
  font-size:1rem; color:var(--ps-text); line-height:1.8; margin-top:.75rem;
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
  font-size:1.05rem; color:var(--ps-muted); text-align:center;
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
  font-size:1.15rem; font-weight:800; color:var(--ps-gold);
  display:flex; align-items:center; justify-content:center;
}
.ps-proto__step-body {}
.ps-proto__step-q {
  font-size:1.05rem; font-weight:600; color:#fff; margin-bottom:.35rem; line-height:1.45;
}
.ps-proto__step-hint {
  font-size:1rem; color:var(--ps-muted); line-height:1.75; font-style:italic;
}
.ps-proto__step-hint em { color:rgba(201,168,76,.8); font-style:normal; }
.ps-proto__example {
  margin-top:2rem; background:rgba(201,168,76,.06); border:1px solid rgba(201,168,76,.18);
  border-radius:14px; padding:1.5rem;
}
.ps-proto__ex-label {
  font-size:1.05rem; text-transform:uppercase; letter-spacing:.16em;
  color:rgba(201,168,76,.55); margin-bottom:1rem;
}
.ps-proto__ex-item {
  display:flex; gap:.75rem; align-items:baseline; margin-bottom:.6rem;
  font-size:1rem; color:var(--ps-text); line-height:1.75;
}
.ps-proto__ex-item::before { content:'✦'; color:var(--ps-gold); flex-shrink:0; font-size:1.05rem; }
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
.ps-breath__step span { font-size:1.05rem; color:var(--ps-muted); text-transform:uppercase; letter-spacing:.08em; }
.ps-breath__unchanged {
  max-width:760px; margin:.5rem auto 0; padding:0 2rem;
  text-align:center; font-size:1.15rem; color:var(--ps-muted); font-style:italic;
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
  font-size:1.1rem; color:var(--ps-muted); max-width:520px; margin:0 auto 2.5rem;
  line-height:1.95;
}
.ps-finale__quote {
  font-family:Georgia,serif; font-style:italic;
  font-size:1.05rem; color:rgba(232,224,208,.8); line-height:1.85;
  border-top:1px solid rgba(201,168,76,.15); padding-top:2rem;
  max-width:480px; margin:0 auto;
}
.ps-finale__quote em { color:var(--ps-gold); font-style:normal; }

/* ════ 30 JOURS D'ANCRAGE ════ */
.ps-30j { max-width:760px; margin:0 auto; padding:0 2rem; }
.ps-30j__intro {
  background:linear-gradient(135deg,rgba(201,168,76,.06),rgba(0,0,0,0));
  border:1px solid rgba(201,168,76,.14); border-radius:18px;
  padding:1.6rem 2rem; text-align:center; margin-bottom:1.75rem;
}
.ps-30j__intro-text { font-size:.98rem; color:var(--ps-muted); line-height:1.85; max-width:510px; margin:0 auto; }
.ps-30j__phases { display:grid; grid-template-columns:repeat(4,1fr); gap:.5rem; margin-top:1.2rem; }
@media(max-width:540px){ .ps-30j__phases{ grid-template-columns:repeat(2,1fr); } }
.ps-30j__phase { background:rgba(255,255,255,.03); border:1px solid rgba(255,255,255,.06); border-radius:12px; padding:.85rem .7rem; text-align:center; }
.ps-30j__phase-days { font-size:1.4rem; font-weight:800; color:var(--ps-gold); line-height:1; margin-bottom:.3rem; }
.ps-30j__phase-lbl { font-size:.7rem; text-transform:uppercase; letter-spacing:.13em; color:rgba(232,224,208,.45); }
.ps-30j__tabs { display:flex; flex-wrap:wrap; gap:.4rem; margin-bottom:1.5rem; }
.ps-30j__tab {
  padding:.38rem .85rem; border-radius:20px; font-size:.83rem; font-weight:600;
  cursor:pointer; border:1.5px solid rgba(255,255,255,.1); background:rgba(255,255,255,.03);
  color:rgba(232,224,208,.48); transition:all .18s; white-space:nowrap; font-family:inherit;
}
.ps-30j__tab.active { background:var(--tbg,rgba(201,168,76,.14)); border-color:var(--tbd,rgba(201,168,76,.38)); color:var(--tc,var(--ps-gold)); }
.ps-30j__panel { display:none; }
.ps-30j__panel.active { display:block; animation:ps30f .22s ease; }
@keyframes ps30f { from{opacity:0;transform:translateY(5px);}to{opacity:1;transform:none;} }
.ps-30j__week { background:var(--ps-surf); border:1px solid var(--ps-border); border-radius:16px; overflow:hidden; margin-bottom:.6rem; }
.ps-30j__week-hd {
  display:flex; align-items:center; justify-content:space-between;
  padding:1.05rem 1.35rem; cursor:pointer; gap:.7rem; user-select:none; transition:background .15s;
}
.ps-30j__week-hd:hover { background:rgba(255,255,255,.02); }
.ps-30j__whl { display:flex; align-items:center; gap:.7rem; flex:1; min-width:0; }
.ps-30j__wkb {
  font-size:.68rem; font-weight:700; letter-spacing:.1em; text-transform:uppercase;
  padding:.18rem .52rem; border-radius:20px; flex-shrink:0;
  background:rgba(201,168,76,.07); color:rgba(201,168,76,.72); border:1px solid rgba(201,168,76,.17); white-space:nowrap;
}
.ps-30j__wkt { font-size:.93rem; font-weight:700; color:#fff; line-height:1.25; }
.ps-30j__wkth { font-size:.8rem; color:var(--ps-muted); font-style:italic; }
.ps-30j__wka { color:var(--ps-muted); font-size:.78rem; transition:transform .22s; flex-shrink:0; }
.ps-30j__week.open .ps-30j__wka { transform:rotate(180deg); }
.ps-30j__week-bd { display:none; }
.ps-30j__week.open .ps-30j__week-bd { display:block; }
.ps-30j__ctx {
  margin:.45rem 1.35rem .7rem;
  border-left:2px solid rgba(201,168,76,.2); padding:.65rem .95rem;
  font-size:.84rem; color:rgba(232,224,208,.6); line-height:1.78; font-style:italic;
}
.ps-30j__ctx strong { color:rgba(255,255,255,.72); font-style:normal; }
.ps-30j__days { display:flex; flex-direction:column; padding:0 .7rem .2rem; }
.ps-30j__day {
  display:flex; align-items:flex-start; gap:.7rem;
  padding:.52rem .45rem; border-bottom:1px solid rgba(255,255,255,.033);
  transition:background .12s; border-radius:6px;
}
.ps-30j__day:last-child { border-bottom:none; }
.ps-30j__day:hover { background:rgba(255,255,255,.018); }
.ps-30j__day.done { opacity:.48; }
.ps-30j__dn {
  min-width:25px; height:25px; border-radius:7px; flex-shrink:0;
  background:rgba(255,255,255,.05); border:1px solid rgba(255,255,255,.08);
  font-size:.66rem; font-weight:800; color:rgba(232,224,208,.42);
  display:flex; align-items:center; justify-content:center; margin-top:.1rem;
}
.ps-30j__day.done .ps-30j__dn { background:rgba(34,197,94,.1); border-color:rgba(34,197,94,.25); color:#4ade80; }
.ps-30j__db { flex:1; min-width:0; }
.ps-30j__dt { font-size:.88rem; font-weight:600; color:#fff; margin-bottom:.18rem; line-height:1.3; }
.ps-30j__di { font-size:.82rem; color:rgba(232,224,208,.58); line-height:1.65; margin:0; }
.ps-30j__dck {
  flex-shrink:0; width:19px; height:19px; border-radius:5px; cursor:pointer; margin-top:.2rem;
  background:rgba(255,255,255,.04); border:1.5px solid rgba(255,255,255,.1);
  display:flex; align-items:center; justify-content:center; font-size:.62rem;
  color:transparent; transition:all .18s;
}
.ps-30j__day.done .ps-30j__dck { background:rgba(34,197,94,.12); border-color:rgba(34,197,94,.32); color:#4ade80; }
.ps-30j__wkq { margin:.45rem 1.35rem 1rem; padding:.7rem .95rem; background:rgba(201,168,76,.04); border:1px solid rgba(201,168,76,.1); border-radius:10px; }
.ps-30j__wkq-l { font-size:.66rem; text-transform:uppercase; letter-spacing:.14em; color:rgba(201,168,76,.62); margin-bottom:.3rem; }
.ps-30j__wkq-t { font-size:.84rem; color:var(--ps-text); line-height:1.7; }

/* ════ BACK ════ */
.ps-back { max-width:760px; margin:1.5rem auto; padding:0 2rem; }
.ps-back a {
  font-size:1rem; color:var(--ps-muted); text-decoration:none;
  display:inline-flex; align-items:center; gap:.4rem; transition:color .2s;
}
.ps-back a:hover { color:var(--ps-gold); }

/* ════ MODULE NAV ════ */
.ps-module-nav {
  max-width:760px; margin:2.5rem auto 0; padding:0 2rem;
  display:grid; grid-template-columns:repeat(auto-fill,minmax(130px,1fr)); gap:.6rem;
}
.ps-module-nav__card {
  background:var(--ps-surf); border:1px solid var(--ps-border);
  border-radius:14px; padding:.85rem 1rem; display:flex; flex-direction:column; gap:.35rem;
  transition:border-color .2s;
}
.ps-module-nav__card--available { border-left:3px solid rgba(201,168,76,.5); }
.ps-module-nav__card--coming    { border-left:3px solid rgba(255,255,255,.08); opacity:.65; }
.ps-module-nav__num { font-size:.85rem; text-transform:uppercase; letter-spacing:.14em; color:var(--ps-muted); }
.ps-module-nav__title { font-size:1rem; font-weight:600; color:#fff; line-height:1.3; }
.ps-module-nav__badge {
  display:inline-block; font-size:.8rem; padding:.15rem .5rem;
  border-radius:20px; margin-top:.1rem; align-self:flex-start;
}
.ps-module-nav__badge--ok     { background:rgba(201,168,76,.12); color:rgba(201,168,76,.9); border:1px solid rgba(201,168,76,.2); }
.ps-module-nav__badge--soon   { background:rgba(255,255,255,.04); color:rgba(232,224,208,.45); border:1px solid rgba(255,255,255,.07); }

/* ════ MODULE HEADING ════ */
.ps-module-heading {
  max-width:760px; margin:4rem auto 2rem; padding:0 2rem;
  display:flex; align-items:center; gap:1.1rem;
}
.ps-module-heading__num {
  width:40px; height:40px; border-radius:50%; flex-shrink:0;
  background:rgba(201,168,76,.08); border:1.5px solid rgba(201,168,76,.35);
  font-size:1.05rem; font-weight:800; color:var(--ps-gold);
  display:flex; align-items:center; justify-content:center;
}
.ps-module-heading__body {}
.ps-module-heading__eyebrow { font-size:.9rem; letter-spacing:.18em; text-transform:uppercase; color:rgba(201,168,76,.7); margin-bottom:.2rem; }
.ps-module-heading__title { font-size:1.25rem; font-weight:600; color:#fff; }

/* ════ AUDIO BLOCK ════ */
.ps-audio-block {
  max-width:760px; margin:2rem auto 0; padding:0 2rem;
}
.ps-audio-inner {
  display:flex; align-items:center; gap:1rem; flex-wrap:wrap;
  background:rgba(201,168,76,.05); border:1px solid rgba(201,168,76,.18);
  border-radius:14px; padding:1.1rem 1.4rem;
}
.ps-audio-icon {
  width:38px; height:38px; flex-shrink:0; border-radius:10px;
  background:rgba(201,168,76,.1); border:1px solid rgba(201,168,76,.25);
  display:flex; align-items:center; justify-content:center; color:var(--ps-gold);
}
.ps-audio-label { font-size:1rem; color:var(--ps-text); flex:1; min-width:140px; font-weight:600; }
.ps-audio-label span { display:block; font-size:.9rem; color:var(--ps-muted); font-weight:400; margin-top:.1rem; }
.ps-audio-coming {
  display:inline-flex; align-items:center; gap:.5rem;
  font-size:.9rem; color:rgba(232,224,208,.5); background:rgba(255,255,255,.04);
  border:1px dashed rgba(255,255,255,.12); border-radius:8px; padding:.4rem .9rem;
  font-style:italic;
}
/* ── Lecteur audio custom — timeline libre ── */
.cplayer {
  background: rgba(0,0,0,.28);
  border: 1px solid rgba(201,168,76,.22);
  border-radius: 12px;
  padding: .9rem 1.1rem;
  display: flex; flex-direction: column; gap: .6rem;
  width: 100%;
}
.cplayer__top { display: flex; align-items: center; gap: .75rem; }
.cplayer__btn-play {
  width: 42px; height: 42px; border-radius: 50%;
  background: #c9a84c; border: none; cursor: pointer;
  display: flex; align-items: center; justify-content: center;
  flex-shrink: 0; transition: background .15s, transform .1s;
}
.cplayer__btn-play:hover { background: #e8d17a; }
.cplayer__btn-play:active { transform: scale(.92); }
.cplayer__times {
  font-size: 13px; font-variant-numeric: tabular-nums;
  color: rgba(201,168,76,.85); white-space: nowrap; font-weight: 600;
}
.cplayer__track {
  position: relative; height: 10px; border-radius: 5px;
  background: rgba(255,255,255,.1); cursor: pointer; touch-action: none;
  user-select: none;
}
.cplayer__track:hover .cplayer__thumb { transform: translate(-50%,-50%) scale(1.3); }
.cplayer__fill {
  height: 100%; border-radius: 5px; pointer-events: none; width: 0%;
  background: linear-gradient(90deg, #c9a84c, #e8d17a);
}
.cplayer__thumb {
  position: absolute; top: 50%; left: 0%;
  width: 16px; height: 16px; border-radius: 50%;
  background: #e8d17a; pointer-events: none;
  transform: translate(-50%,-50%); transition: transform .12s;
  box-shadow: 0 0 8px rgba(201,168,76,.5);
}
.cplayer__btns {
  display: flex; align-items: center; justify-content: center;
  gap: .4rem; flex-wrap: wrap;
}
.cplayer__skip {
  display: inline-flex; align-items: center; gap: .22rem;
  padding: 5px 11px; border-radius: 18px;
  border: 1px solid rgba(201,168,76,.3);
  background: rgba(201,168,76,.07);
  color: #c9a84c; font-size: 12px; font-weight: 700;
  cursor: pointer; user-select: none;
  transition: background .15s, border-color .15s, transform .1s;
}
.cplayer__skip:hover { background: rgba(201,168,76,.2); border-color: rgba(201,168,76,.6); }
.cplayer__skip:active { transform: scale(.91); }
.cplayer__skip--big { font-size: 13px; padding: 6px 13px; background: rgba(201,168,76,.12); border-color: rgba(201,168,76,.45); }

/* ════ MODULE COMING SOON ════ */
.ps-module-coming {
  max-width:760px; margin:4rem auto 0; padding:0 2rem;
}
.ps-module-coming__inner {
  background:rgba(255,255,255,.02); border:1px dashed rgba(255,255,255,.1);
  border-radius:18px; padding:2.5rem 2rem; text-align:center;
}
.ps-module-coming__num { font-size:.9rem; letter-spacing:.18em; text-transform:uppercase; color:rgba(232,224,208,.4); margin-bottom:.75rem; }
.ps-module-coming__icon { font-size:2rem; margin-bottom:.75rem; opacity:.5; }
.ps-module-coming__title { font-size:1.2rem; font-weight:600; color:rgba(255,255,255,.6); margin-bottom:.5rem; }
.ps-module-coming__desc { font-size:1rem; color:rgba(232,224,208,.45); line-height:1.75; max-width:440px; margin:0 auto .9rem; }
.ps-module-coming__tag {
  display:inline-flex; align-items:center; gap:.4rem;
  font-size:.9rem; color:rgba(232,224,208,.4); background:rgba(255,255,255,.04);
  border:1px dashed rgba(255,255,255,.1); border-radius:20px; padding:.3rem .9rem;
}

/* ════ INFO BAR PREMIUM ════ */
.ps-info-bar {
  background:linear-gradient(135deg,rgba(201,168,76,.1),rgba(201,168,76,.04));
  border-bottom:1px solid rgba(201,168,76,.2);
  padding:.8rem 2rem;
}
.ps-info-bar__inner {
  max-width:760px; margin:0 auto;
  display:flex; align-items:center; gap:.7rem; flex-wrap:wrap; justify-content:center;
}
.ps-info-bar__badge {
  font-size:.85rem; font-weight:700; letter-spacing:.14em; text-transform:uppercase;
  color:#000; background:linear-gradient(135deg,#c9a84c,#a07820);
  padding:.22rem .7rem; border-radius:20px;
}
.ps-info-bar__sep { color:rgba(255,255,255,.18); }
.ps-info-bar__item { font-size:.95rem; color:rgba(232,224,208,.8); }
.ps-info-bar__price { font-size:1.1rem; font-weight:800; color:var(--ps-gold); letter-spacing:.02em; }
.ps-info-bar__acc { font-size:.82rem; color:rgba(232,224,208,.55); letter-spacing:.08em; text-transform:uppercase; }

/* ════ ACTIVITÉS MODULE ════ */
.ps-act-section {
  max-width:760px; margin:2.5rem auto 0; padding:0 2rem;
}
.ps-act-section__head {
  display:flex; align-items:center; gap:1rem; margin-bottom:1.25rem;
  color:var(--ps-muted); font-size:.85rem; letter-spacing:.16em; text-transform:uppercase;
}
.ps-act-section__head::before, .ps-act-section__head::after {
  content:''; flex:1; height:1px; background:rgba(255,255,255,.07);
}
.ps-activities { display:flex; flex-direction:column; gap:.9rem; }
.ps-act {
  background:var(--ps-surf); border:1px solid var(--ps-border);
  border-radius:14px; overflow:hidden; transition:border-color .2s;
}
.ps-act.is-done { border-color:rgba(34,197,94,.3); background:rgba(34,197,94,.04); }
.ps-act__header {
  display:flex; align-items:flex-start; gap:1rem; padding:1.15rem 1.4rem;
  cursor:pointer; user-select:none;
}
.ps-act__icon {
  flex-shrink:0; width:42px; height:42px; border-radius:10px;
  display:flex; align-items:center; justify-content:center; font-size:1.2rem;
  background:rgba(255,255,255,.05);
}
.ps-act__icon--lecture   { background:rgba(59,130,246,.12); }
.ps-act__icon--pratique  { background:rgba(16,185,129,.12); }
.ps-act__icon--ecriture  { background:rgba(245,158,11,.10); }
.ps-act__icon--exercice  { background:rgba(139,92,246,.12); }
.ps-act__icon--reflexion { background:rgba(236,72,153,.10); }
.ps-act__meta { flex:1; }
.ps-act__title { font-size:1rem; font-weight:600; color:#fff; margin:0 0 .2rem; line-height:1.3; }
.ps-act__tags { display:flex; align-items:center; gap:.45rem; flex-wrap:wrap; }
.ps-act__tag {
  font-size:.78rem; padding:.12rem .48rem; border-radius:20px;
  background:rgba(255,255,255,.06); color:var(--ps-muted); text-transform:capitalize;
}
.ps-act__expand { flex-shrink:0; color:var(--ps-muted); font-size:.85rem; transition:transform .25s; margin-top:.3rem; }
.ps-act.is-expanded .ps-act__expand { transform:rotate(180deg); }
.ps-act__body {
  display:none; padding:0 1.4rem 1.4rem;
  border-top:1px solid rgba(255,255,255,.05);
}
.ps-act.is-expanded .ps-act__body { display:block; }
.ps-act__desc {
  font-size:.95rem; color:rgba(232,224,208,.75); line-height:1.8;
  margin:1rem 0 .75rem;
}
.ps-act__rich {
  background:rgba(255,255,255,.04); border:1px solid rgba(255,255,255,.09);
  border-radius:12px; padding:1.25rem 1.5rem; margin:.5rem 0 .9rem;
  font-size:.95rem; line-height:1.9; color:#e8e0d0;
}
.ps-act__rich h4 { font-size:1rem; font-weight:700; color:#fff; margin:1.25rem 0 .5rem; }
.ps-act__rich h4:first-child { margin-top:0; }
.ps-act__rich p { margin:0 0 .9rem; }
.ps-act__rich p:last-child { margin-bottom:0; }
.ps-act__rich strong { color:#fff; }
.ps-act__rich em { color:var(--ps-gold); font-style:italic; }
.ps-act__rich blockquote {
  border-left:3px solid var(--ps-gold); padding:.75rem 1.1rem;
  margin:1rem 0; background:rgba(201,168,76,.08); border-radius:0 8px 8px 0;
  font-style:italic; color:#f0e6c8; font-size:.93rem; line-height:1.85;
}
.ps-act__rich ul { padding-left:1.2rem; margin:.7rem 0; }
.ps-act__rich ul li { margin-bottom:.55rem; color:#e8e0d0; line-height:1.8; }
.ps-act__questions { display:flex; flex-direction:column; gap:.65rem; margin:.75rem 0; }
.ps-act__q {
  display:flex; gap:.75rem; align-items:baseline;
  background:rgba(255,255,255,.03); border:1px solid rgba(255,255,255,.07);
  border-radius:10px; padding:.85rem 1.1rem;
  font-size:.93rem; color:var(--ps-text); line-height:1.75;
}
.ps-act__q-num { color:var(--ps-gold); font-weight:700; flex-shrink:0; }
.ps-act__timer-wrap { margin:.5rem 0 1rem; }
.ps-act__timer-btn {
  display:inline-flex; align-items:center; gap:.5rem;
  background:rgba(16,185,129,.1); border:1px solid rgba(16,185,129,.3);
  color:#6ee7b7; border-radius:8px; padding:.48rem .95rem;
  font-size:.9rem; cursor:pointer; transition:all .2s; font-family:inherit;
}
.ps-act__timer-btn:hover { background:rgba(16,185,129,.2); }
.ps-act__timer-display {
  font-size:2.2rem; font-weight:700; color:#6ee7b7; letter-spacing:.05em;
  text-align:center; margin:.6rem 0; display:none;
}
.ps-act__timer-phase { font-size:.88rem; color:rgba(110,231,183,.65); text-align:center; min-height:1.2rem; }
.ps-act__journal-label {
  font-size:.88rem; color:var(--ps-gold); margin-bottom:.4rem;
  display:flex; align-items:center; gap:.4rem;
}
.ps-act__journal-area {
  width:100%; min-height:100px;
  background:rgba(255,255,255,.04); border:1px solid rgba(255,255,255,.09);
  border-radius:10px; color:var(--ps-text); font-family:inherit;
  font-size:.93rem; line-height:1.65; padding:.82rem .95rem; resize:vertical; outline:none;
  transition:border-color .2s; box-sizing:border-box;
}
.ps-act__journal-area:focus { border-color:rgba(201,168,76,.4); }
.ps-act__journal-area::placeholder { color:rgba(232,224,208,.2); }
.ps-act__validate {
  margin-top:.8rem;
  display:inline-flex; align-items:center; gap:.45rem;
  background:linear-gradient(135deg,#1a4a1a,#14391e);
  border:1.5px solid rgba(34,197,94,.4); color:#4ade80;
  padding:.5rem 1.05rem; border-radius:10px;
  font-size:.9rem; font-weight:600; cursor:pointer; transition:all .2s; font-family:inherit;
}
.ps-act__validate:hover { border-color:rgba(34,197,94,.7); background:rgba(34,197,94,.15); }
</style>
@endsection

@section('content')
<div class="ps-page">

{{-- ══════ INFO BAR ══════ --}}
<div class="ps-info-bar">
  <div class="ps-info-bar__inner">
    <span class="ps-info-bar__badge">Formation indépendante</span>
    <span class="ps-info-bar__sep">·</span>
    <span class="ps-info-bar__item">1 module transformateur</span>
    <span class="ps-info-bar__sep">·</span>
    <span class="ps-info-bar__item">🎧 Audios guidés · Exercices pratiques</span>
    <span class="ps-info-bar__sep">·</span>
    <span class="ps-info-bar__price">999 €</span>
    <span class="ps-info-bar__acc">accès à vie</span>
  </div>
</div>

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

{{-- ══════ MODULE NAV ══════ --}}
<nav class="ps-module-nav" aria-label="Modules de la formation">
  <div class="ps-module-nav__card ps-module-nav__card--available">
    <div class="ps-module-nav__num">Module 01</div>
    <div class="ps-module-nav__title">Le Principe Fondateur</div>
    <span class="ps-module-nav__badge ps-module-nav__badge--ok">✓ Disponible</span>
  </div>
  <div class="ps-module-nav__card ps-module-nav__card--available">
    <div class="ps-module-nav__num">Module 02</div>
    <div class="ps-module-nav__title">Les 7 Familles</div>
    <span class="ps-module-nav__badge ps-module-nav__badge--ok">✓ Disponible</span>
  </div>
  <div class="ps-module-nav__card ps-module-nav__card--available">
    <div class="ps-module-nav__num">Module 03</div>
    <div class="ps-module-nav__title">Votre Protocole</div>
    <span class="ps-module-nav__badge ps-module-nav__badge--ok">✓ Disponible</span>
  </div>
  <div class="ps-module-nav__card ps-module-nav__card--available">
    <div class="ps-module-nav__num">Module 04</div>
    <div class="ps-module-nav__title">Audios Guidés</div>
    <span class="ps-module-nav__badge ps-module-nav__badge--ok">✓ Disponible</span>
  </div>
  <div class="ps-module-nav__card ps-module-nav__card--available">
    <div class="ps-module-nav__num">Module 05</div>
    <div class="ps-module-nav__title">Ancrage Turbulence</div>
    <span class="ps-module-nav__badge ps-module-nav__badge--ok">✓ Disponible</span>
  </div>
</nav>

{{-- ══════ MODULE 01 ══════ --}}
<div class="ps-module-heading">
  <div class="ps-module-heading__num">01</div>
  <div class="ps-module-heading__body">
    <div class="ps-module-heading__eyebrow">Module 01 · Fondation</div>
    <div class="ps-module-heading__title">Le Principe Fondateur — Ce qui ne change jamais</div>
  </div>
</div>
<div class="ps-audio-block">
  <div class="ps-audio-inner" style="flex-direction:column;align-items:flex-start;">
    <div style="display:flex;gap:8px;margin-bottom:10px;">
      <button id="btn-lang-fr-01" onclick="psSwitchLang('01','fr')" style="background:#c9a84c;color:#0f0f0f;border:none;padding:5px 14px;border-radius:20px;font-size:12px;font-weight:700;cursor:pointer;letter-spacing:.04em;">🇫🇷 Français</button>
      <button id="btn-lang-en-01" onclick="psSwitchLang('01','en')" style="background:rgba(201,168,76,.15);color:#c9a84c;border:1px solid #c9a84c;padding:5px 14px;border-radius:20px;font-size:12px;font-weight:700;cursor:pointer;letter-spacing:.04em;">🇬🇧 English</button>
    </div>
    <div class="ps-audio-label">▶ Écouter le module guidé
      <span>Audio guidé · 5-5-5 · Introduction au principe fondateur</span>
    </div>
    <audio id="audio-player-01" preload="metadata" style="display:none" class="ps-audio-element"
      src="{{ asset('storage/formation/audio/mps-01-fr.mp3') }}">
      Votre navigateur ne supporte pas la lecture audio.
    </audio>
    <div class="cplayer" id="audio-player-01-cp">
      <div class="cplayer__top">
        <button class="cplayer__btn-play" aria-label="Lecture / Pause">
          <svg class="cp-icon-play" width="18" height="18" viewBox="0 0 24 24" fill="#0f0f0f"><polygon points="5 3 19 12 5 21 5 3"/></svg>
          <svg class="cp-icon-pause" width="18" height="18" viewBox="0 0 24 24" fill="#0f0f0f" style="display:none"><rect x="6" y="4" width="4" height="16"/><rect x="14" y="4" width="4" height="16"/></svg>
        </button>
        <div style="flex:1"></div>
        <div class="cplayer__times"><span class="cp-cur">0:00</span> / <span class="cp-dur">--:--</span></div>
      </div>
      <div class="cplayer__track"><div class="cplayer__fill"></div><div class="cplayer__thumb"></div></div>
      <div class="cplayer__btns">
        <button class="cplayer__skip cplayer__skip--big" data-seek="-300" title="Reculer 5 min"><svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="11 17 6 12 11 7"/><polyline points="18 17 13 12 18 7"/></svg> 5 min</button>
        <button class="cplayer__skip" data-seek="-30"><svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="15 18 9 12 15 6"/></svg> 30s</button>
        <button class="cplayer__skip" data-seek="30">30s <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="9 18 15 12 9 6"/></svg></button>
        <button class="cplayer__skip cplayer__skip--big" data-seek="300" title="Avancer 5 min">5 min <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="13 17 18 12 13 7"/><polyline points="6 17 11 12 6 7"/></svg></button>
      </div>
    </div>
    <div class="ps-audio-coming">🎧 Recommandé : écoutez d'abord le module guidé, puis travaillez les activités.</div>
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

{{-- ══════ ACTIVITÉS MODULE 01 ══════ --}}
<div class="ps-act-section">
  <div class="ps-act-section__head">Vos activités &middot; Module 01</div>
  <div class="ps-activities">

    {{-- Activité 01 — Lecture --}}
    <div class="ps-act">
      <div class="ps-act__header" onclick="psToggleAct(this)">
        <div class="ps-act__icon ps-act__icon--lecture">📖</div>
        <div class="ps-act__meta">
          <div class="ps-act__title">La science des 5 secondes</div>
          <div class="ps-act__tags">
            <span class="ps-act__tag">Lecture</span>
            <span class="ps-act__tag">~8 min</span>
          </div>
        </div>
        <span class="ps-act__expand">▼</span>
      </div>
      <div class="ps-act__body">
        <div class="ps-act__rich">
          <h4>Pourquoi 5 — et pas 4, ni 6 ?</h4>
          <p>Ce n'est pas un chiffre choisi par intuition. <strong>Cinq secondes</strong> correspond à la zone de résonance du système cardio-respiratoire adulte. En dessous de 4 secondes, le cycle est trop court pour atteindre les récepteurs du <em>nerf vague</em> — le câble neurologique qui relie le cerveau au cœur, aux poumons, à l'intestin. Au-delà de 6, la majorité des gens force — et la force crée de la résistance, non du calme.</p>
          <blockquote>"5 secondes, c'est là où la variabilité cardiaque atteint sa cohérence maximale. Là où le cortex préfrontal reprend le contrôle sur l'amygdale. En termes simples : là où vous passez de réactif à lucide."</blockquote>
          <h4>Le nerf vague — votre interrupteur</h4>
          <p>Le nerf vague est le pivot du système nerveux autonome. Stimulé correctement — par une expiration longue, par une rétention — il active le système parasympathique. Résultat : fréquence cardiaque ralentie, cortisol diminué, champ attentionnel élargi. Vous n'êtes plus en réaction. Vous êtes en <em>présence</em>.</p>
          <h4>Ce que ça signifie concrètement</h4>
          <ul>
            <li>Un cycle 5-5-5 (15 secondes) produit un effet mesurable sur la variabilité cardiaque immédiatement.</li>
            <li>Trois cycles (45 secondes) induisent une cohérence cardiaque suffisante pour changer la qualité décisionnelle.</li>
            <li>Pratiqué régulièrement au même moment, l'effet devient conditionné — le simple geste d'amorçe suffit à déclencher l'état.</li>
          </ul>
        </div>
        <button class="ps-act__validate" onclick="psValidate(this)"><span>✓</span> Marquer comme lu</button>
      </div>
    </div>

    {{-- Activité 02 — Exercice sensoriel --}}
    <div class="ps-act">
      <div class="ps-act__header" onclick="psToggleAct(this)">
        <div class="ps-act__icon ps-act__icon--exercice">🔬</div>
        <div class="ps-act__meta">
          <div class="ps-act__title">Le miroir du souffle</div>
          <div class="ps-act__tags">
            <span class="ps-act__tag">Exercice sensoriel</span>
            <span class="ps-act__tag">2 min</span>
          </div>
        </div>
        <span class="ps-act__expand">▼</span>
      </div>
      <div class="ps-act__body">
        <p class="ps-act__desc">Avant de modifier quoi que ce soit, vous allez simplement observer votre souffle naturel — sans le corriger, sans juger ce que vous ressentez. Le miroir, avant la transformation.</p>
        <div class="ps-act__rich">
          <h4>Consigne</h4>
          <p>Installez-vous. Fermez doucement les yeux. Posez une main sur la poitrine, une autre sur le ventre. Respirez comme vous respirez normalement — ne forcez rien. Pendant 2 minutes, observez en silence :</p>
          <ul>
            <li><strong>L'amplitude :</strong> votre souffle est-il court, moyen, profond ?</li>
            <li><strong>Le rythme :</strong> régulier ou saccadé ?</li>
            <li><strong>La tension :</strong> où sent-on de la résistance ? Gorge, poitrine, ventre ?</li>
            <li><strong>La température :</strong> l'air est-il frais à l'entrée, chaud à la sortie ?</li>
          </ul>
        </div>
        <div class="ps-act__journal-label">📝 Vos observations</div>
        <textarea class="ps-act__journal-area" placeholder="Mon souffle naturel est... J'ai remarqué... La tension était dans..."></textarea>
        <button class="ps-act__validate" onclick="psValidate(this)"><span>✓</span> Exercice terminé</button>
      </div>
    </div>

    {{-- Activité 03 — Réflexion --}}
    <div class="ps-act">
      <div class="ps-act__header" onclick="psToggleAct(this)">
        <div class="ps-act__icon ps-act__icon--reflexion">💭</div>
        <div class="ps-act__meta">
          <div class="ps-act__title">20 000 respirations</div>
          <div class="ps-act__tags">
            <span class="ps-act__tag">Réflexion</span>
            <span class="ps-act__tag">5 min</span>
          </div>
        </div>
        <span class="ps-act__expand">▼</span>
      </div>
      <div class="ps-act__body">
        <p class="ps-act__desc">Vous respirez en moyenne 20 000 fois par jour. Ces questions ne cherchent pas à vous faire culpabiliser — elles vous invitent à voir ce qui existe déjà, et ce qui pourrait être autrement.</p>
        <div class="ps-act__questions">
          <div class="ps-act__q"><span class="ps-act__q-num">1</span> Dans quel état respirez-vous habituellement pendant votre pratique professionnelle ?</div>
          <div class="ps-act__q"><span class="ps-act__q-num">2</span> Quel moment de votre journée est le plus chaôtique ? Le plus drainant ?</div>
          <div class="ps-act__q"><span class="ps-act__q-num">3</span> Avez-vous déjà ressenti une différence notable dans votre efficacité selon votre état intérieur ce jour-là ?</div>
          <div class="ps-act__q"><span class="ps-act__q-num">4</span> Si vous deviez nommer votre état « par défaut » dans les moments difficiles — quel serait ce mot ?</div>
          <div class="ps-act__q"><span class="ps-act__q-num">5</span> Y a-t-il un geste, un rituel, un endroit qui vous recentre naturellement ? Comment se manifeste-t-il ?</div>
        </div>
        <div class="ps-act__journal-label">📝 Votre réflexion</div>
        <textarea class="ps-act__journal-area" placeholder="Ce qui me revient après ces questions..."></textarea>
        <button class="ps-act__validate" onclick="psValidate(this)"><span>✓</span> Réflexion complétée</button>
      </div>
    </div>

    {{-- Activité 04 — Pratique guidée --}}
    <div class="ps-act">
      <div class="ps-act__header" onclick="psToggleAct(this)">
        <div class="ps-act__icon ps-act__icon--pratique">⏱️</div>
        <div class="ps-act__meta">
          <div class="ps-act__title">Premier cycle 5-5-5</div>
          <div class="ps-act__tags">
            <span class="ps-act__tag">Pratique guidée</span>
            <span class="ps-act__tag">45 sec · 3 cycles</span>
          </div>
        </div>
        <span class="ps-act__expand">▼</span>
      </div>
      <div class="ps-act__body">
        <p class="ps-act__desc">Votre première pratique consciente du 5-5-5. Pas de performance attendue. Juste ressentir — sans chercher à comprendre.</p>
        <div class="ps-act__rich">
          <h4>Consigne</h4>
          <p>Installez-vous. Dos droit, pieds au sol. Fermez les yeux si possible. Quand vous êtes prêt, cliquez sur Démarrer.</p>
          <ul>
            <li><strong>Inspirer</strong> — comptez mentalement jusqu'à 5</li>
            <li><strong>Retenir</strong> — comptez jusqu'à 5 (sans bloquer, juste suspendre)</li>
            <li><strong>Expirer</strong> — comptez jusqu'à 5, lentement, jusqu'au bout</li>
          </ul>
          <p>Répétez 3 fois. Puis rouvrez les yeux doucement.</p>
        </div>
        <div class="ps-act__timer-wrap">
          <button class="ps-act__timer-btn" onclick="psStartTimer(this,5,5,5,3)">▶ Démarrer les 3 cycles guidés</button>
          <div class="ps-act__timer-display">5</div>
          <div class="ps-act__timer-phase"></div>
        </div>
        <button class="ps-act__validate" onclick="psValidate(this)"><span>✓</span> Pratique effectuée</button>
      </div>
    </div>

    {{-- Activité 05 — Journal --}}
    <div class="ps-act">
      <div class="ps-act__header" onclick="psToggleAct(this)">
        <div class="ps-act__icon ps-act__icon--ecriture">✍️</div>
        <div class="ps-act__meta">
          <div class="ps-act__title">Avant &amp; Après</div>
          <div class="ps-act__tags">
            <span class="ps-act__tag">Journal</span>
            <span class="ps-act__tag">3 min</span>
          </div>
        </div>
        <span class="ps-act__expand">▼</span>
      </div>
      <div class="ps-act__body">
        <p class="ps-act__desc">En deux phrases, nommez ce que vous avez ressenti avant votre premier cycle, et ce que vous avez ressenti après. La trace qui rend le changement visible.</p>
        <div class="ps-act__journal-label">📝 Avant le cycle</div>
        <textarea class="ps-act__journal-area" placeholder="Avant, je me sentais..." style="margin-bottom:.75rem;min-height:65px;"></textarea>
        <div class="ps-act__journal-label">📝 Après le cycle</div>
        <textarea class="ps-act__journal-area" placeholder="Après, j'ai remarqué..." style="min-height:65px;"></textarea>
        <button class="ps-act__validate" onclick="psValidate(this)"><span>✓</span> Journal complété</button>
      </div>
    </div>

  </div>
</div>

{{-- ══════ MODULE 02 ══════ --}}
<div class="ps-module-heading" style="margin-top:5rem;">
  <div class="ps-module-heading__num">02</div>
  <div class="ps-module-heading__body">
    <div class="ps-module-heading__eyebrow">Module 02 · Reconnaissance</div>
    <div class="ps-module-heading__title">Les 7 Familles — Trouvez votre famille, reconnaissez-vous</div>
  </div>
</div>
<div class="ps-audio-block">
  <div class="ps-audio-inner" style="flex-direction:column;align-items:flex-start;">
    <div style="display:flex;gap:8px;margin-bottom:10px;">
      <button id="btn-lang-fr-02" onclick="psSwitchLang('02','fr')" style="background:#c9a84c;color:#0f0f0f;border:none;padding:5px 14px;border-radius:20px;font-size:12px;font-weight:700;cursor:pointer;letter-spacing:.04em;">🇫🇷 Français</button>
      <button id="btn-lang-en-02" onclick="psSwitchLang('02','en')" style="background:rgba(201,168,76,.15);color:#c9a84c;border:1px solid #c9a84c;padding:5px 14px;border-radius:20px;font-size:12px;font-weight:700;cursor:pointer;letter-spacing:.04em;">🇬🇧 English</button>
    </div>
    <div class="ps-audio-label">▶ Écouter le module guidé
      <span>Audio de 22 min — immersion dans votre famille de pratique</span>
    </div>
    <audio id="audio-player-02" preload="metadata" style="display:none" class="ps-audio-element"
      src="{{ asset('storage/formation/audio/mps-02-fr.mp3') }}">
      Votre navigateur ne supporte pas la lecture audio.
    </audio>
    <div class="cplayer" id="audio-player-02-cp">
      <div class="cplayer__top">
        <button class="cplayer__btn-play" aria-label="Lecture / Pause">
          <svg class="cp-icon-play" width="18" height="18" viewBox="0 0 24 24" fill="#0f0f0f"><polygon points="5 3 19 12 5 21 5 3"/></svg>
          <svg class="cp-icon-pause" width="18" height="18" viewBox="0 0 24 24" fill="#0f0f0f" style="display:none"><rect x="6" y="4" width="4" height="16"/><rect x="14" y="4" width="4" height="16"/></svg>
        </button>
        <div style="flex:1"></div>
        <div class="cplayer__times"><span class="cp-cur">0:00</span> / <span class="cp-dur">--:--</span></div>
      </div>
      <div class="cplayer__track"><div class="cplayer__fill"></div><div class="cplayer__thumb"></div></div>
      <div class="cplayer__btns">
        <button class="cplayer__skip cplayer__skip--big" data-seek="-300" title="Reculer 5 min"><svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="11 17 6 12 11 7"/><polyline points="18 17 13 12 18 7"/></svg> 5 min</button>
        <button class="cplayer__skip" data-seek="-30"><svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="15 18 9 12 15 6"/></svg> 30s</button>
        <button class="cplayer__skip" data-seek="30">30s <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="9 18 15 12 9 6"/></svg></button>
        <button class="cplayer__skip cplayer__skip--big" data-seek="300" title="Avancer 5 min">5 min <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="13 17 18 12 13 7"/><polyline points="6 17 11 12 6 7"/></svg></button>
      </div>
    </div>
    <div class="ps-audio-coming">🎧 Recommandé : écoutez d'abord le module guidé, puis travaillez les activités.</div>
  </div>
</div>

{{-- ══════ 5 FAMILLES ══════ --}}
<div class="ps-section-head" style="margin-top:4.5rem;">
  <div class="ps-section-head__eyebrow">7 familles · Des dizaines de pratiques</div>
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

  {{-- 3 — ENSEIGNANTS --}}
  <div class="ps-card ps-card--corps">
    <div class="ps-card__head">
      <div class="ps-card__left">
        <div class="ps-card__icon">🏫</div>
        <div class="ps-card__meta">
          <div class="ps-card__name">Les Enseignants</div>
          <div class="ps-card__prof">Maternelle · Primaire · Collège · Lycée · Classes prépa · Université · Grandes Écoles</div>
        </div>
      </div>
      <span class="ps-card__tag">Savoir & Transmission</span>
    </div>
    <div class="ps-card__body">
      <div class="ps-card__subtitle">Ce que vous enseignez, ils l'emportent pour toujours. Commencez par leur apprendre à être là.</div>
      <div class="ps-card__moment">
        <div class="ps-card__moment-label">Le moment d'activation</div>
        <div class="ps-card__moment-text">
          <strong>Le rituel d'entrée.</strong> Chaque matin, avant la première leçon — ou avant chaque cours. Debout ou assis. Vous guidez 3 cycles à voix posée. Puis : <em style="color:var(--ps-gold);">"Ouvrez les yeux. Vous êtes là. On commence."</em> 30 secondes d'ancrage — universellement applicable de la maternelle aux grandes écoles.
        </div>
      </div>
      <div class="ps-card__examples">
        <span class="ps-card__ex">🏫 rituel d'entrée en classe le matin</span>
        <span class="ps-card__ex">📝 avant une évaluation ou un examen</span>
        <span class="ps-card__ex">😤 gestion d'une tension en classe</span>
        <span class="ps-card__ex">🎤 avant un exposé oral ou une soutenance</span>
        <span class="ps-card__ex">🎓 avant un oral de grandes écoles ou de bac</span>
        <span class="ps-card__ex">📚 en ouverture de TP ou de cours magistral</span>
      </div>
      <div class="ps-card__result">Ce que ça change : vous installez un ancrage neurologique que <em>ces élèves garderont toute leur vie</em>. De la maternelle à Sciences Po — c'est peut-être le seul outil que vous leur transmettrez qui n'a pas de date de péremption.</div>
    </div>
  </div>

  {{-- 4 — LEADERS --}}
  <div class="ps-card ps-card--leader">
    <div class="ps-card__head">
      <div class="ps-card__left">
        <div class="ps-card__icon">🏢</div>
        <div class="ps-card__meta">
          <div class="ps-card__name">Les Leaders</div>
          <div class="ps-card__prof">Chef d'entreprise · Manager · Cadre · Coach · Consultant · RH &amp; DRH · Directeur · Entrepreneur</div>
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

  {{-- 6 — GARDIENS DU TOUT-PETIT --}}
  <div class="ps-card ps-card--bebe">
    <div class="ps-card__head">
      <div class="ps-card__left">
        <div class="ps-card__icon">🍼</div>
        <div class="ps-card__meta">
          <div class="ps-card__name">Les Gardiens du Tout-Petit</div>
          <div class="ps-card__prof">Nounou · Assistante maternelle · Auxiliaire de puériculture · Sage-femme · Puéricultrice · Crèche &amp; Maternité</div>
        </div>
      </div>
      <span class="ps-card__tag">Premiers instants &amp; Éveil</span>
    </div>
    <div class="ps-card__body">
      <div class="ps-card__subtitle">Un nourrisson ressent votre tension avant d'entendre votre voix. Votre souffle est son premier ancrage.</div>
      <div class="ps-card__moment">
        <div class="ps-card__moment-label">Le moment d'activation</div>
        <div class="ps-card__moment-text">
          <strong>Avant chaque change, chaque biberon, chaque portage.</strong> Mains posées, un cycle silencieux. Le corps du tout-petit se règle sur le vôtre — rythme cardiaque, tonus musculaire, qualité de présence. La question intérieure&nbsp;: <em style="color:var(--ps-gold);">&quot;Est-ce que je suis vraiment là… pour lui&nbsp;?&quot;</em>
        </div>
      </div>
      <div class="ps-card__examples">
        <span class="ps-card__ex">🍼 avant chaque biberon</span>
        <span class="ps-card__ex">🛁 avant le bain du soir</span>
        <span class="ps-card__ex">😴 avant d'endormir le bébé</span>
        <span class="ps-card__ex">😢 face aux pleurs inconsolables</span>
        <span class="ps-card__ex">🤱 transition maternité → maison</span>
      </div>
      <div class="ps-card__result">Ce que ça change&nbsp;: vous offrez à ces enfants <em>dès les premiers instants de leur vie</em> un système nerveux qui rencontre le calme. L'ancrage le plus profond qui soit — avant même les premiers mots.</div>
    </div>
  </div>

  {{-- 7 — LES PROCHES --}}
  <div class="ps-card ps-card--proches">
    <div class="ps-card__head">
      <div class="ps-card__left">
        <div class="ps-card__icon">🏡</div>
        <div class="ps-card__meta">
          <div class="ps-card__name">Les Proches</div>
          <div class="ps-card__prof">Parent · Conjoint · Mari · Femme · Ami(e) · Femme au foyer · Aidant familial</div>
        </div>
      </div>
      <span class="ps-card__tag">Vie quotidienne &amp; Lien</span>
    </div>
    <div class="ps-card__body">
      <div class="ps-card__subtitle">Pas de titre, pas de protocole. Juste la vie. Un souffle avant de répondre change tout ce qui suit.</div>
      <div class="ps-card__moment">
        <div class="ps-card__moment-label">Le moment d'activation</div>
        <div class="ps-card__moment-text">
          <strong>L'éclat de voix sur le point d'arriver.</strong> L'enfant qui crie, le partenaire qui reproche, la fatigue du soir qui déborde. Pause. Un cycle 5-5-5. Puis vous répondez. La question intérieure&nbsp;: <em style="color:var(--ps-gold);">"Est-ce que je veux réagir… ou agir ?"</em>
        </div>
      </div>
      <div class="ps-card__examples">
        <span class="ps-card__ex">👶 avant de répondre à un enfant en crise</span>
        <span class="ps-card__ex">👩‍❤️‍👨 avant une conversation difficile en couple</span>
        <span class="ps-card__ex">🌙 rituel du soir après les enfants couchés</span>
        <span class="ps-card__ex">🛒 dans la file d'attente, entre deux corvnées</span>
        <span class="ps-card__ex">🤗 avant de retrouver un ami en peine</span>
      </div>
      <div class="ps-card__result">Ce que ça change : un parent qui respire apprend à son enfant que la paix est possible — <em>sans le dire, sans l'enseigner, juste en le vivant devant eux</em>. C'est peut-être la transmission la plus profonde de toutes.</div>
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
<p class="ps-breath__unchanged">Ce protocole est identique pour le potier, le chirurgien, la maîtresse d'école, le chef d'entreprise et le parent épuisé du soir. C'est sa force.</p>

{{-- ══════ VISION : NOS VIES · NOS MAISONS · NOS RUES ══════ --}}
<div class="ps-vision" style="max-width:760px;margin:5rem auto 4rem;">
  <div class="ps-vision__bg-text" aria-hidden="true">SOUFFLE</div>
  <div class="ps-vision__eyebrow">Une pratique pour chaque vie</div>
  <h2 class="ps-vision__title">La Pause Souffle<br><em>dans nos vies,</em><br><em>dans nos maisons,</em><br><em>dans nos rues.</em></h2>
  <p class="ps-vision__lead">
    Le 5-5-5 n'a pas de lieu attitré. Pas de cabinet, pas de salle de cours, pas de bureau.<br>
    Il appartient à quiconque respire — et veut choisir <em>comment</em> il respire.
  </p>
  <div class="ps-vision__pillars">
    <div class="ps-vision__pillar">
      <div class="ps-vision__pillar-icon">🏠</div>
      <div class="ps-vision__pillar-title">Dans nos maisons</div>
      <p>La cuisine à 7 h du matin, avant que tout commence. La chambre des enfants le soir, quand la voix doit rester douce. Le couloir après une journée qui vous a tout pris. Un seul cycle — et la maison change de tonalité. Pas parce que les murs ont bougé. Parce que vous avez bougé.</p>
    </div>
    <div class="ps-vision__pillar">
      <div class="ps-vision__pillar-icon">🌆</div>
      <div class="ps-vision__pillar-title">Dans nos rues</div>
      <p>Dans la voiture entre deux rendez-vous. Dans le métro avant d'arriver. Sur le quai, à la caisse du supermarché, dans la salle d'attente. Ces espaces de transition que l'on traverse sans les habiter — la Pause Souffle les transforme en espaces de retour à soi. Trente secondes. N'importe où.</p>
    </div>
    <div class="ps-vision__pillar">
      <div class="ps-vision__pillar-icon">🌍</div>
      <div class="ps-vision__pillar-title">Dans notre monde</div>
      <p>Une enseignante qui respire avant d'entrer en classe depuis dix ans. Deux cents élèves qui ont appris à faire pareil. Et les enfants de ces enfants, qui sauront que le calme est possible. Une pratique se transmet silencieusement — par l'exemple, par la présence, par la qualité de ce qu'on dépose dans l'espace.</p>
    </div>
  </div>
  <div class="ps-vision__divider"></div>
  <div class="ps-vision__quote">
    <span class="ps-vision__quote-mark">&laquo;</span>Le souffle est le seul acte que vous faites depuis votre naissance jusqu'à votre dernier instant. Autant choisir <em>comment</em> vous le faites.<span class="ps-vision__quote-mark">&raquo;</span>
  </div>
</div>

{{-- ══════ ACTIVITÉS MODULE 02 ══════ --}}
<div class="ps-act-section">
  <div class="ps-act-section__head">Vos activités &middot; Module 02</div>
  <div class="ps-activities">

    {{-- Activité 01 — Lecture résumé audio --}}
    <div class="ps-act">
      <div class="ps-act__header" onclick="psToggleAct(this)">
        <div class="ps-act__icon ps-act__icon--lecture">📖</div>
        <div class="ps-act__meta">
          <div class="ps-act__title">Ce que dit l'audio — les 7 familles en détail</div>
          <div class="ps-act__tags">
            <span class="ps-act__tag">Lecture</span>
            <span class="ps-act__tag">~10 min</span>
          </div>
        </div>
        <span class="ps-act__expand">▼</span>
      </div>
      <div class="ps-act__body">
        <div class="ps-act__rich">
          <h4>Pour les Créateurs — Art & Création</h4>
          <p>Potiers, musiciens, peintres, artisans, chanteurs. Pour eux, le souffle est une porte. Avant de toucher la matière, on entre. Ce cycle n'est pas un échauffement — c'est une invocation. La matière reçoit votre intention <em>avant</em> votre technique.</p>
          <h4>Pour les Soignants — Soin & Présence</h4>
          <p>Massothérapeutes, médecins, osteopathes, infirmiers, psychologues. Le souffle est un reset entre chaque patient. La personne précédente a eu tout ce que vous aviez. La suivante mérite que vous recommenciez neuf.</p>
          <h4>Pour les Enseignants — Savoir & Transmission</h4>
          <p>Instituteurs de maternelle, professeurs de collège, enseignants de lycée, chargés de cours en faculté, formateurs en grandes écoles. Le souffle est un ancrage neurologique. Chaque élève qui apprend à respirer avec vous emporte un outil qu'il n'oubliera jamais. <em>De la maternelle à Sciences Po, c'est peut-être le seul enseignement qui n'a pas de date de péremption.</em></p>
          <h4>Pour les Leaders — Décision & Clarté</h4>
          <p>Chefs d'entreprise, managers, coachs, consultants, directeurs. Le souffle est une clarification délibérée. Une décision prise depuis le calme est une décision prise depuis votre intelligence la plus haute. 90 secondes avant une réunion valent parfois deux heures de préparation.</p>
          <h4>Pour les Éducateurs — Transmission & Ancrage</h4>
          <p>Maîtresses d'école, formateurs, éducateurs spécialisés, animateurs jeunesse. Le souffle ritualise la présence. Un enfant qui respire apprend différemment. Un adulte qui enseigne calmement transforme.</p>
          <h4>Pour les Proches — Vie quotidienne & Lien</h4>
          <p>Parents, conjoints, maris, femmes, amis, femmes au foyer, aidants familiaux. Le souffle est un battement de cœur avant la réponse. Ce n'est pas une pratique professionnelle — c'est une pratique humaine. Un parent qui respire avant de répondre à un enfant en crise lui transmet silencieusement que la paix intérieure existe. <em>Pas besoin de séance, ni de titre. Juste la vie, et un souffle avant d'agir.</em></p>
        </div>
        <button class="ps-act__validate" onclick="psValidate(this)"><span>✓</span> Marquer comme lu</button>
      </div>
    </div>

    {{-- Activité 02 — Quelle est votre famille ? --}}
    <div class="ps-act">
      <div class="ps-act__header" onclick="psToggleAct(this)">
        <div class="ps-act__icon ps-act__icon--exercice">🧭</div>
        <div class="ps-act__meta">
          <div class="ps-act__title">Quelle est votre famille ?</div>
          <div class="ps-act__tags">
            <span class="ps-act__tag">Exercice</span>
            <span class="ps-act__tag">5 min</span>
          </div>
        </div>
        <span class="ps-act__expand">▼</span>
      </div>
      <div class="ps-act__body">
        <p class="ps-act__desc">Ces 5 questions vous aident à identifier votre famille de pratique. Il n'y a pas de bonne réponse — seulement la vôtre.</p>
        <div class="ps-act__questions">
          <div class="ps-act__q"><span class="ps-act__q-num">1</span> Dans votre pratique, êtes-vous principalement seul devant votre travail, face à une personne, ou devant un groupe ?</div>
          <div class="ps-act__q"><span class="ps-act__q-num">2</span> Le moment le plus délicat de votre journée — c'est avant de commencer, entre deux personnes, ou au milieu d'une décision ?</div>
          <div class="ps-act__q"><span class="ps-act__q-num">3</span> Ce que vous transmettez — c'est une œuvre, une guérison, un savoir, une direction, ou une présence ?</div>
          <div class="ps-act__q"><span class="ps-act__q-num">4</span> Quand vous n'êtes pas centré, cela se voit-il dans le résultat (qualité du travail), dans la relation (qualité du contact), dans la salle (ambiance du groupe) ?</div>
          <div class="ps-act__q"><span class="ps-act__q-num">5</span> Quelle carte vous a touché instinctivement — même si vous ne vous y retrouvez pas à 100 % ?</div>
        </div>
        <div class="ps-act__journal-label">📝 Votre famille (ou vos familles)</div>
        <textarea class="ps-act__journal-area" placeholder="Je me reconnais dans... parce que..."></textarea>
        <button class="ps-act__validate" onclick="psValidate(this)"><span>✓</span> Exercice terminé</button>
      </div>
    </div>

    {{-- Activité 03 — Le moment vivant --}}
    <div class="ps-act">
      <div class="ps-act__header" onclick="psToggleAct(this)">
        <div class="ps-act__icon ps-act__icon--exercice">⚡</div>
        <div class="ps-act__meta">
          <div class="ps-act__title">Le moment vivant</div>
          <div class="ps-act__tags">
            <span class="ps-act__tag">Exercice de projection</span>
            <span class="ps-act__tag">5 min</span>
          </div>
        </div>
        <span class="ps-act__expand">▼</span>
      </div>
      <div class="ps-act__body">
        <p class="ps-act__desc">Choisissez un moment réel dans votre semaine à venir. Un moment professionnel précis où vous allez activer le 5-5-5 pour la première fois. Nommez-le maintenant — avant de l'avoir vécu.</p>
        <div class="ps-act__rich">
          <h4>Comment nommer un moment vivant</h4>
          <p>Soyez précis jusqu'à l'absurde. Pas « avant une réunion » — mais « mardi 14h, dans le couloir du 2e étage, avant d'entrer en salle de conférence. » Pas « avant mon cours » — mais « lundi matin 8h45, dans la salle 12 avant que les élèves arrivent. »</p>
          <p>La précision du contexte active la mémoire anticipatoire. Vous aurez déjà « vécu » ce moment — avant qu'il arrive.</p>
        </div>
        <div class="ps-act__journal-label">📝 Mon moment vivant</div>
        <textarea class="ps-act__journal-area" placeholder="[Jour] — [Heure] — [Lieu exact] — [Ce qui précède]&#10;&#10;Je pratique le 5-5-5 systématiquement quand : "></textarea>
        <button class="ps-act__validate" onclick="psValidate(this)"><span>✓</span> Moment nommé</button>
      </div>
    </div>

    {{-- Activité 04 — Mon moment d'activation --}}
    <div class="ps-act">
      <div class="ps-act__header" onclick="psToggleAct(this)">
        <div class="ps-act__icon ps-act__icon--ecriture">✍️</div>
        <div class="ps-act__meta">
          <div class="ps-act__title">Mon moment d'activation</div>
          <div class="ps-act__tags">
            <span class="ps-act__tag">Écriture</span>
            <span class="ps-act__tag">3 min</span>
          </div>
        </div>
        <span class="ps-act__expand">▼</span>
      </div>
      <div class="ps-act__body">
        <p class="ps-act__desc">Trois phrases. La précision d'un photographe — pas la générosité d'un poète. Ce que vous écrivez ici devient votre engagement envers vous-même.</p>
        <div class="ps-act__rich">
          <p><strong>Phrase 1 — Le lieu :</strong> où êtes-vous physiquement ?<br><em>Ex : « Dans le couloir, la main sur la poignée de porte de mon bureau. »</em></p>
          <p><strong>Phrase 2 — Le geste :</strong> que faites-vous juste avant ?<br><em>Ex : « Je pose les deux mains à plat sur mes cuisses. »</em></p>
          <p><strong>Phrase 3 — La seconde exacte :</strong> quel est le déclencheur ?<br><em>Ex : « Dès que j'entends la sonnerie dans le couloir — systématiquement. »</em></p>
        </div>
        <div class="ps-act__journal-label">📝 Mes trois phrases</div>
        <textarea class="ps-act__journal-area" placeholder="Lieu : &#10;Geste : &#10;Seconde exacte : " style="min-height:90px;"></textarea>
        <button class="ps-act__validate" onclick="psValidate(this)"><span>✓</span> Engagement écrit</button>
      </div>
    </div>

  </div>
</div>

{{-- ══════ MODULE 03 ══════ --}}
<div class="ps-module-heading" style="margin-top:5rem;">
  <div class="ps-module-heading__num">03</div>
  <div class="ps-module-heading__body">
    <div class="ps-module-heading__eyebrow">Module 03 · Création</div>
    <div class="ps-module-heading__title">Votre Protocole Personnel — Votre signature unique</div>
  </div>
</div>
<div class="ps-audio-block">
  <div class="ps-audio-inner" style="flex-direction:column;align-items:flex-start;">
    <div style="display:flex;gap:8px;margin-bottom:10px;">
      <button id="btn-lang-fr-03" onclick="psSwitchLang('03','fr')" style="background:#c9a84c;color:#0f0f0f;border:none;padding:5px 14px;border-radius:20px;font-size:12px;font-weight:700;cursor:pointer;letter-spacing:.04em;">🇫🇷 Français</button>
      <button id="btn-lang-en-03" onclick="psSwitchLang('03','en')" style="background:rgba(201,168,76,.15);color:#c9a84c;border:1px solid #c9a84c;padding:5px 14px;border-radius:20px;font-size:12px;font-weight:700;cursor:pointer;letter-spacing:.04em;">🇬🇧 English</button>
    </div>
    <div class="ps-audio-label">▶ Écouter le module guidé
      <span>Audio de 28 min — construction de votre protocole pas à pas</span>
    </div>
    <audio id="audio-player-03" preload="metadata" style="display:none" class="ps-audio-element"
      src="{{ asset('storage/formation/audio/mps-03-fr.mp3') }}">
      Votre navigateur ne supporte pas la lecture audio.
    </audio>
    <div class="cplayer" id="audio-player-03-cp">
      <div class="cplayer__top">
        <button class="cplayer__btn-play" aria-label="Lecture / Pause">
          <svg class="cp-icon-play" width="18" height="18" viewBox="0 0 24 24" fill="#0f0f0f"><polygon points="5 3 19 12 5 21 5 3"/></svg>
          <svg class="cp-icon-pause" width="18" height="18" viewBox="0 0 24 24" fill="#0f0f0f" style="display:none"><rect x="6" y="4" width="4" height="16"/><rect x="14" y="4" width="4" height="16"/></svg>
        </button>
        <div style="flex:1"></div>
        <div class="cplayer__times"><span class="cp-cur">0:00</span> / <span class="cp-dur">--:--</span></div>
      </div>
      <div class="cplayer__track"><div class="cplayer__fill"></div><div class="cplayer__thumb"></div></div>
      <div class="cplayer__btns">
        <button class="cplayer__skip cplayer__skip--big" data-seek="-300" title="Reculer 5 min"><svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="11 17 6 12 11 7"/><polyline points="18 17 13 12 18 7"/></svg> 5 min</button>
        <button class="cplayer__skip" data-seek="-30"><svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="15 18 9 12 15 6"/></svg> 30s</button>
        <button class="cplayer__skip" data-seek="30">30s <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="9 18 15 12 9 6"/></svg></button>
        <button class="cplayer__skip cplayer__skip--big" data-seek="300" title="Avancer 5 min">5 min <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="13 17 18 12 13 7"/><polyline points="6 17 11 12 6 7"/></svg></button>
      </div>
    </div>
    <div class="ps-audio-coming">🎧 Recommandé : écoutez d'abord le module guidé, puis travaillez les activités.</div>
  </div>
</div>

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

{{-- ══════ ACTIVITÉS MODULE 03 ══════ --}}
<div class="ps-act-section">
  <div class="ps-act-section__head">Vos activités &middot; Module 03</div>
  <div class="ps-activities">

    {{-- Activité 01 — Mon ancrage corporel --}}
    <div class="ps-act">
      <div class="ps-act__header" onclick="psToggleAct(this)">
        <div class="ps-act__icon ps-act__icon--exercice">⚓</div>
        <div class="ps-act__meta">
          <div class="ps-act__title">Mon ancrage corporel</div>
          <div class="ps-act__tags">
            <span class="ps-act__tag">Exercice sensoriel</span>
            <span class="ps-act__tag">5 min</span>
          </div>
        </div>
        <span class="ps-act__expand">▼</span>
      </div>
      <div class="ps-act__body">
        <p class="ps-act__desc">L'ancrage est le signal physique que vous envoyez à votre système nerveux avant chaque cycle. Testez les 5 options — chacune 30 secondes — puis notez celle qui « active » sans effort, sans forcer.</p>
        <div class="ps-act__questions">
          <div class="ps-act__q"><span class="ps-act__q-num">A</span> Deux mains à plat sur les genoux, dos droit, yeux mi-clos.</div>
          <div class="ps-act__q"><span class="ps-act__q-num">B</span> Une main sur le sternum, l'autre sur le ventre, debout.</div>
          <div class="ps-act__q"><span class="ps-act__q-num">C</span> Pouce et index réunis (mudra simple), assis ou debout.</div>
          <div class="ps-act__q"><span class="ps-act__q-num">D</span> Deux pieds bien à plat au sol, sensation dans les plantes, yeux fermés.</div>
          <div class="ps-act__q"><span class="ps-act__q-num">E</span> Votre geste naturel — celui qui revient quand vous avez besoin de calme.</div>
        </div>
        <div class="ps-act__journal-label">📝 Mon ancrage choisi</div>
        <textarea class="ps-act__journal-area" placeholder="L'option qui m'a parlé naturellement est... Parce que..."></textarea>
        <button class="ps-act__validate" onclick="psValidate(this)"><span>✓</span> Ancrage identifié</button>
      </div>
    </div>

    {{-- Activité 02 — Mon déclencheur nommé --}}
    <div class="ps-act">
      <div class="ps-act__header" onclick="psToggleAct(this)">
        <div class="ps-act__icon ps-act__icon--ecriture">🎯</div>
        <div class="ps-act__meta">
          <div class="ps-act__title">Mon déclencheur nommé</div>
          <div class="ps-act__tags">
            <span class="ps-act__tag">Écriture précise</span>
            <span class="ps-act__tag">3 min</span>
          </div>
        </div>
        <span class="ps-act__expand">▼</span>
      </div>
      <div class="ps-act__body">
        <p class="ps-act__desc">Le déclencheur n'est pas « quand j'en ai besoin » — c'est l'instant précis, reconductible, automatisable. Complétez cette phrase jusqu'à ce qu'elle soit inattaquable.</p>
        <div class="ps-act__rich">
          <p><em>« Je pratique le 5-5-5 systématiquement quand ________. »</em></p>
          <p>Exemples valides :</p>
          <ul>
            <li>« Je pose la main sur la poignée de porte de mon cabinet. »</li>
            <li>« Je m'assieds dans ma voiture, moteur coupé, après la dernière séance. »</li>
            <li>« J'entends la sonnerie de début de cours dans le couloir. »</li>
            <li>« Je clique sur "Démarrer" dans mon logiciel de réservation. »</li>
          </ul>
          <p>Exemples invalides : <strong>« quand je suis stressé »</strong> (trop vague) — <strong>« quand je le décide »</strong> (trop dépendant de la volonté).</p>
        </div>
        <div class="ps-act__journal-label">📝 Ma phrase complète</div>
        <textarea class="ps-act__journal-area" placeholder="Je pratique le 5-5-5 systématiquement quand ..." style="min-height:70px;"></textarea>
        <button class="ps-act__validate" onclick="psValidate(this)"><span>✓</span> Déclencheur nommé</button>
      </div>
    </div>

    {{-- Activité 03 — Ma question d'intention --}}
    <div class="ps-act">
      <div class="ps-act__header" onclick="psToggleAct(this)">
        <div class="ps-act__icon ps-act__icon--reflexion">❓</div>
        <div class="ps-act__meta">
          <div class="ps-act__title">Ma question d'intention</div>
          <div class="ps-act__tags">
            <span class="ps-act__tag">Réflexion créatrice</span>
            <span class="ps-act__tag">5 min</span>
          </div>
        </div>
        <span class="ps-act__expand">▼</span>
      </div>
      <div class="ps-act__body">
        <p class="ps-act__desc">La question d'intention est posée à la fin du dernier cycle — juste avant d'agir. Elle oriente l'état que vous venez d'installer. Choisissez-en une ou formulez la vôtre.</p>
        <div class="ps-act__questions">
          <div class="ps-act__q"><span class="ps-act__q-num">🎨</span> « Qu'est-ce que je veux que cette œuvre traverse ? » — <em style="color:rgba(201,168,76,.75)">Créateurs</em></div>
          <div class="ps-act__q"><span class="ps-act__q-num">🤲</span> « Qu'est-ce que cette personne a besoin de recevoir — à travers moi ? » — <em style="color:rgba(201,168,76,.75)">Soignants</em></div>
          <div class="ps-act__q"><span class="ps-act__q-num">🏫</span> « Qu'est-ce que ces élèves ont besoin que j'incarne aujourd'hui ? » — <em style="color:rgba(201,168,76,.75)">Enseignants</em></div>
          <div class="ps-act__q"><span class="ps-act__q-num">🏢</span> « Qu'est-ce qui compte vraiment dans les 60 prochaines minutes ? » — <em style="color:rgba(201,168,76,.75)">Leaders</em></div>
          <div class="ps-act__q"><span class="ps-act__q-num">📚</span> « Qu'est-ce que je veux que ces enfants emportent de cet instant ? » — <em style="color:rgba(201,168,76,.75)">Éducateurs</em></div>
        </div>
        <div class="ps-act__journal-label">📝 Ma question personnelle</div>
        <textarea class="ps-act__journal-area" placeholder="Ma question d'intention est : « __________________ »" style="min-height:65px;"></textarea>
        <button class="ps-act__validate" onclick="psValidate(this)"><span>✓</span> Question choisie</button>
      </div>
    </div>

    {{-- Activité 04 — Répétition générale --}}
    <div class="ps-act">
      <div class="ps-act__header" onclick="psToggleAct(this)">
        <div class="ps-act__icon ps-act__icon--pratique">🎬</div>
        <div class="ps-act__meta">
          <div class="ps-act__title">Répétition générale</div>
          <div class="ps-act__tags">
            <span class="ps-act__tag">Pratique complète</span>
            <span class="ps-act__tag">2 min</span>
          </div>
        </div>
        <span class="ps-act__expand">▼</span>
      </div>
      <div class="ps-act__body">
        <p class="ps-act__desc">Votre protocole complet — une première fois. Ancrage → 3 cycles 5-5-5 → question d'intention → ouverture. Exactement comme vous le ferez demain matin dans votre contexte réel.</p>
        <div class="ps-act__rich">
          <h4>Déroulé</h4>
          <ul>
            <li>Adoptez votre <strong>ancrage</strong> (celui que vous avez défini)</li>
            <li>Cliquez sur <strong>Démarrer</strong> pour les 3 cycles guidés</li>
            <li>À la fin du dernier cycle, posez votre <strong>question d'intention</strong> en silence</li>
            <li>Ouvrez les yeux doucement — notez ce qui a changé</li>
          </ul>
        </div>
        <div class="ps-act__timer-wrap">
          <button class="ps-act__timer-btn" onclick="psStartTimer(this,5,5,5,3)">▶ Démarrer le protocole complet</button>
          <div class="ps-act__timer-display">5</div>
          <div class="ps-act__timer-phase"></div>
        </div>
        <div class="ps-act__journal-label">📝 Déclaration de Protocole</div>
        <textarea class="ps-act__journal-area" placeholder="Mon ancrage est :&#10;Mon déclencheur est :&#10;Ma question est : « ... »" style="min-height:90px;"></textarea>
        <button class="ps-act__validate" onclick="psValidate(this)"><span>✓</span> Protocole complété</button>
      </div>
    </div>

  </div>
</div>

{{-- ══════ MODULE 04 ══════ --}}
<div class="ps-module-heading" style="margin-top:5rem;" id="mod-04">
  <div class="ps-module-heading__num">04</div>
  <div class="ps-module-heading__body">
    <div class="ps-module-heading__eyebrow">Module 04 · Audios guidés</div>
    <div class="ps-module-heading__title">L'Avant — Votre Pratique en Son</div>
  </div>
</div>

<p style="max-width:620px;margin:0 auto 2rem;text-align:center;color:var(--ps-muted);font-size:.95rem;line-height:1.8;padding:0 1.5rem;">
  Un audio par famille. Choisissez le vôtre et écoutez le protocole guidé — conçu spécifiquement pour votre contexte.
</p>

{{-- Tabs familles module 04 --}}
<div style="max-width:760px;margin:0 auto;padding:0 1.5rem;">
  <div class="ps-30j__tabs" id="tabs-mod04">
    <button class="ps-30j__tab active" style="--tbg:rgba(168,85,247,.14);--tbd:rgba(168,85,247,.38);--tc:#c4b5fd;" onclick="psMod04Tab('creatif',this)">🎨 Créatifs</button>
    <button class="ps-30j__tab" style="--tbg:rgba(20,184,166,.14);--tbd:rgba(20,184,166,.38);--tc:#5eead4;" onclick="psMod04Tab('soin',this)">🩺 Soignants</button>
    <button class="ps-30j__tab" style="--tbg:rgba(59,130,246,.14);--tbd:rgba(59,130,246,.38);--tc:#93c5fd;" onclick="psMod04Tab('enseignant',this)">📚 Enseignants</button>
    <button class="ps-30j__tab" style="--tbg:rgba(201,168,76,.14);--tbd:rgba(201,168,76,.38);--tc:#c9a84c;" onclick="psMod04Tab('leader',this)">🏆 Leaders</button>
    <button class="ps-30j__tab" style="--tbg:rgba(34,197,94,.14);--tbd:rgba(34,197,94,.38);--tc:#86efac;" onclick="psMod04Tab('educateur',this)">🌱 Éducateurs</button>
    <button class="ps-30j__tab" style="--tbg:rgba(244,114,182,.14);--tbd:rgba(244,114,182,.38);--tc:#f9a8d4;" onclick="psMod04Tab('bebe',this)">👶 Petite Enfance</button>
    <button class="ps-30j__tab" style="--tbg:rgba(251,146,60,.14);--tbd:rgba(251,146,60,.38);--tc:#fdba74;" onclick="psMod04Tab('proches',this)">🏠 Proches</button>
  </div>

  @foreach([
    ['creatif','Créatifs','L\'avant de la création','rgba(168,85,247,.08)','rgba(168,85,247,.25)','#c4b5fd'],
    ['soin','Soignants','L\'avant de la consultation','rgba(20,184,166,.08)','rgba(20,184,166,.25)','#5eead4'],
    ['enseignant','Enseignants','L\'avant d\'entrer en classe','rgba(59,130,246,.08)','rgba(59,130,246,.25)','#93c5fd'],
    ['leader','Leaders','L\'avant de la réunion','rgba(201,168,76,.08)','rgba(201,168,76,.25)','#c9a84c'],
    ['educateur','Éducateurs','L\'avant de la session','rgba(34,197,94,.08)','rgba(34,197,94,.25)','#86efac'],
    ['bebe','Petite Enfance','L\'avant du soin','rgba(244,114,182,.08)','rgba(244,114,182,.25)','#f9a8d4'],
    ['proches','Proches','L\'avant de rentrer','rgba(251,146,60,.08)','rgba(251,146,60,.25)','#fdba74'],
  ] as [$key, $label, $subtitle, $bg, $border, $color])
  <div id="pnl04-{{ $key }}" class="ps-30j__panel {{ $key === 'creatif' ? 'active' : '' }}">
    <div class="ps-audio-block">
      <div class="ps-audio-inner" style="flex-direction:column;align-items:flex-start;">
        <div style="display:flex;gap:8px;margin-bottom:10px;">
          <button id="btn-lang-fr-04-{{ $key }}" onclick="psSwitchLang('04-{{ $key }}','fr')" style="background:#c9a84c;color:#0f0f0f;border:none;padding:5px 14px;border-radius:20px;font-size:12px;font-weight:700;cursor:pointer;letter-spacing:.04em;">🇫🇷 Français</button>
          <button id="btn-lang-en-04-{{ $key }}" onclick="psSwitchLang('04-{{ $key }}','en')" style="background:rgba(201,168,76,.15);color:#c9a84c;border:1px solid #c9a84c;padding:5px 14px;border-radius:20px;font-size:12px;font-weight:700;cursor:pointer;letter-spacing:.04em;">🇬🇧 English</button>
        </div>
        <div class="ps-audio-label">▶ {{ $label }} — {{ $subtitle }}
          <span>Audio guidé · 6–8 min</span>
        </div>
        <audio id="audio-player-04-{{ $key }}" preload="metadata" style="display:none" class="ps-audio-element"
          src="{{ asset('storage/formation/audio/mps-04-' . $key . '-fr.mp3') }}">
          Votre navigateur ne supporte pas la lecture audio.
        </audio>
        <div class="cplayer" id="audio-player-04-{{ $key }}-cp">
          <div class="cplayer__top">
            <button class="cplayer__btn-play" aria-label="Lecture / Pause">
              <svg class="cp-icon-play" width="18" height="18" viewBox="0 0 24 24" fill="#0f0f0f"><polygon points="5 3 19 12 5 21 5 3"/></svg>
              <svg class="cp-icon-pause" width="18" height="18" viewBox="0 0 24 24" fill="#0f0f0f" style="display:none"><rect x="6" y="4" width="4" height="16"/><rect x="14" y="4" width="4" height="16"/></svg>
            </button>
            <div style="flex:1"></div>
            <div class="cplayer__times"><span class="cp-cur">0:00</span> / <span class="cp-dur">--:--</span></div>
          </div>
          <div class="cplayer__track"><div class="cplayer__fill"></div><div class="cplayer__thumb"></div></div>
          <div class="cplayer__btns">
            <button class="cplayer__skip cplayer__skip--big" data-seek="-300" title="Reculer 5 min"><svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="11 17 6 12 11 7"/><polyline points="18 17 13 12 18 7"/></svg> 5 min</button>
            <button class="cplayer__skip" data-seek="-30"><svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="15 18 9 12 15 6"/></svg> 30s</button>
            <button class="cplayer__skip" data-seek="30">30s <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="9 18 15 12 9 6"/></svg></button>
            <button class="cplayer__skip cplayer__skip--big" data-seek="300" title="Avancer 5 min">5 min <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="13 17 18 12 13 7"/><polyline points="6 17 11 12 6 7"/></svg></button>
          </div>
        </div>
        <div class="ps-audio-coming">🎧 Recommandé : écoutez votre famille, puis passez aux activités.</div>
      </div>
    </div>
  </div>
  @endforeach
</div>

{{-- ══════ MODULE 05 ══════ --}}
<div class="ps-module-heading" style="margin-top:5rem;" id="mod-05">
  <div class="ps-module-heading__num">05</div>
  <div class="ps-module-heading__body">
    <div class="ps-module-heading__eyebrow">Module 05 · Audios guidés</div>
    <div class="ps-module-heading__title">L'Ancrage en Pleine Turbulence</div>
  </div>
</div>

<p style="max-width:620px;margin:0 auto 2rem;text-align:center;color:var(--ps-muted);font-size:.95rem;line-height:1.8;padding:0 1.5rem;">
  Un audio par famille. Choisissez le vôtre — conçu pour les moments de turbulence réelle.
</p>

<div style="max-width:760px;margin:0 auto;padding:0 1.5rem;">
  <div class="ps-30j__tabs" id="tabs-mod05">
    <button class="ps-30j__tab active" style="--tbg:rgba(168,85,247,.14);--tbd:rgba(168,85,247,.38);--tc:#c4b5fd;" onclick="psMod05Tab('creatif',this)">🎨 Créatifs</button>
    <button class="ps-30j__tab" style="--tbg:rgba(20,184,166,.14);--tbd:rgba(20,184,166,.38);--tc:#5eead4;" onclick="psMod05Tab('soin',this)">🩺 Soignants</button>
    <button class="ps-30j__tab" style="--tbg:rgba(59,130,246,.14);--tbd:rgba(59,130,246,.38);--tc:#93c5fd;" onclick="psMod05Tab('enseignant',this)">📚 Enseignants</button>
    <button class="ps-30j__tab" style="--tbg:rgba(201,168,76,.14);--tbd:rgba(201,168,76,.38);--tc:#c9a84c;" onclick="psMod05Tab('leader',this)">🏆 Leaders</button>
    <button class="ps-30j__tab" style="--tbg:rgba(34,197,94,.14);--tbd:rgba(34,197,94,.38);--tc:#86efac;" onclick="psMod05Tab('educateur',this)">🌱 Éducateurs</button>
    <button class="ps-30j__tab" style="--tbg:rgba(244,114,182,.14);--tbd:rgba(244,114,182,.38);--tc:#f9a8d4;" onclick="psMod05Tab('bebe',this)">👶 Petite Enfance</button>
    <button class="ps-30j__tab" style="--tbg:rgba(251,146,60,.14);--tbd:rgba(251,146,60,.38);--tc:#fdba74;" onclick="psMod05Tab('proches',this)">🏠 Proches</button>
  </div>

  @foreach([
    ['creatif','Créatifs','L\'ancrage en pleine création'],
    ['soin','Soignants','L\'ancrage en consultation difficile'],
    ['enseignant','Enseignants','L\'ancrage face à la classe'],
    ['leader','Leaders','L\'ancrage sous pression'],
    ['educateur','Éducateurs','L\'ancrage face à la résistance'],
    ['bebe','Petite Enfance','L\'ancrage face aux pleurs'],
    ['proches','Proches','L\'ancrage dans la tension familiale'],
  ] as [$key, $label, $subtitle])
  <div id="pnl05-{{ $key }}" class="ps-30j__panel {{ $key === 'creatif' ? 'active' : '' }}">
    <div class="ps-audio-block">
      <div class="ps-audio-inner" style="flex-direction:column;align-items:flex-start;">
        <div style="display:flex;gap:8px;margin-bottom:10px;">
          <button id="btn-lang-fr-05-{{ $key }}" onclick="psSwitchLang('05-{{ $key }}','fr')" style="background:#c9a84c;color:#0f0f0f;border:none;padding:5px 14px;border-radius:20px;font-size:12px;font-weight:700;cursor:pointer;letter-spacing:.04em;">🇫🇷 Français</button>
          <button id="btn-lang-en-05-{{ $key }}" onclick="psSwitchLang('05-{{ $key }}','en')" style="background:rgba(201,168,76,.15);color:#c9a84c;border:1px solid #c9a84c;padding:5px 14px;border-radius:20px;font-size:12px;font-weight:700;cursor:pointer;letter-spacing:.04em;">🇬🇧 English</button>
        </div>
        <div class="ps-audio-label">▶ {{ $label }} — {{ $subtitle }}
          <span>Audio guidé · 6–8 min</span>
        </div>
        <audio id="audio-player-05-{{ $key }}" preload="metadata" style="display:none" class="ps-audio-element"
          src="{{ asset('storage/formation/audio/mps-05-' . $key . '-fr.mp3') }}">
          Votre navigateur ne supporte pas la lecture audio.
        </audio>
        <div class="cplayer" id="audio-player-05-{{ $key }}-cp">
          <div class="cplayer__top">
            <button class="cplayer__btn-play" aria-label="Lecture / Pause">
              <svg class="cp-icon-play" width="18" height="18" viewBox="0 0 24 24" fill="#0f0f0f"><polygon points="5 3 19 12 5 21 5 3"/></svg>
              <svg class="cp-icon-pause" width="18" height="18" viewBox="0 0 24 24" fill="#0f0f0f" style="display:none"><rect x="6" y="4" width="4" height="16"/><rect x="14" y="4" width="4" height="16"/></svg>
            </button>
            <div style="flex:1"></div>
            <div class="cplayer__times"><span class="cp-cur">0:00</span> / <span class="cp-dur">--:--</span></div>
          </div>
          <div class="cplayer__track"><div class="cplayer__fill"></div><div class="cplayer__thumb"></div></div>
          <div class="cplayer__btns">
            <button class="cplayer__skip cplayer__skip--big" data-seek="-300" title="Reculer 5 min"><svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="11 17 6 12 11 7"/><polyline points="18 17 13 12 18 7"/></svg> 5 min</button>
            <button class="cplayer__skip" data-seek="-30"><svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="15 18 9 12 15 6"/></svg> 30s</button>
            <button class="cplayer__skip" data-seek="30">30s <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="9 18 15 12 9 6"/></svg></button>
            <button class="cplayer__skip cplayer__skip--big" data-seek="300" title="Avancer 5 min">5 min <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="13 17 18 12 13 7"/><polyline points="6 17 11 12 6 7"/></svg></button>
          </div>
        </div>
        <div class="ps-audio-coming">🎧 Recommandé : écoutez votre famille, puis travaillez les activités.</div>
      </div>
    </div>
  </div>
  @endforeach
</div>

{{-- ══════ VISIO ══════ --}}
<div style="max-width:760px;margin:5rem auto 0;padding:0 2rem;">
  <div style="
    background:radial-gradient(ellipse 80% 50% at 50% 100%,rgba(201,168,76,.1),transparent 70%),
               linear-gradient(160deg,rgba(201,168,76,.06),rgba(0,0,0,0));
    border:1px solid rgba(201,168,76,.22); border-radius:24px; padding:3.5rem 2.5rem;
    text-align:center; position:relative; overflow:hidden;
  ">
    {{-- Fond décoratif --}}
    <div style="
      position:absolute;top:0;left:0;right:0;bottom:0;
      background:repeating-linear-gradient(45deg,rgba(201,168,76,.018) 0,rgba(201,168,76,.018) 1px,transparent 1px,transparent 28px);
      pointer-events:none;
    "></div>

    <div style="position:relative;">
      <div style="font-size:.7rem;font-weight:700;letter-spacing:.22em;text-transform:uppercase;color:rgba(201,168,76,.7);margin-bottom:1.2rem;">
        Session d'intégration · Incluse dans la formation
      </div>

      <h2 style="font-size:clamp(1.3rem,3vw,1.85rem);font-weight:200;font-family:Georgia,serif;color:#fff;margin-bottom:.9rem;line-height:1.4;">
        Votre séance de clôture<br><em style="color:var(--ps-gold);font-style:italic;">en visio privée</em>
      </h2>

      <p style="font-size:1rem;color:var(--ps-muted);max-width:480px;margin:0 auto 2rem;line-height:1.9;">
        La formation représente <strong style="color:rgba(232,224,208,.8);">3h30 de contenu guidé</strong>.
        Conformément à la règle des 20 %, votre parcours se conclut par une
        <strong style="color:rgba(232,224,208,.8);">séance visio de 45 minutes</strong> —
        pour ancrer, ajuster, et personnaliser ce que vous avez vécu.
      </p>

      {{-- 3 piliers --}}
      <div style="display:grid;grid-template-columns:repeat(3,1fr);gap:1rem;margin-bottom:2.5rem;">
        @foreach([
          ['🔍','Bilan personnel','Ce qui a changé. Ce qui résiste encore. Ce que vous emportez.'],
          ['🎯','Ajustement','Votre protocole affiné — précisément pour votre réalité, pas la moyenne.'],
          ['🚀','Projection','Les 30 prochains jours. Un engagement concret. Une direction claire.'],
        ] as [$icon,$title,$desc])
        <div style="background:rgba(255,255,255,.03);border:1px solid rgba(255,255,255,.07);border-radius:14px;padding:1.4rem 1.1rem;text-align:center;">
          <div style="font-size:1.6rem;margin-bottom:.65rem;">{{ $icon }}</div>
          <div style="font-size:.88rem;font-weight:700;color:#fff;margin-bottom:.5rem;">{{ $title }}</div>
          <p style="font-size:.8rem;color:var(--ps-muted);line-height:1.75;margin:0;">{{ $desc }}</p>
        </div>
        @endforeach
      </div>

      {{-- Durée + format --}}
      <div style="display:flex;justify-content:center;gap:1.5rem;flex-wrap:wrap;margin-bottom:2.5rem;">
        @foreach([
          ['⏱','45 minutes','Séance individuelle'],
          ['🎥','Visio privée','Lien envoyé par e-mail'],
          ['📅','À votre rythme','Dans les 30 jours suivant la formation'],
        ] as [$ic,$val,$lbl])
        <div style="display:flex;align-items:center;gap:.5rem;background:rgba(201,168,76,.06);border:1px solid rgba(201,168,76,.14);border-radius:30px;padding:.5rem 1.1rem;">
          <span>{{ $ic }}</span>
          <div style="text-align:left;">
            <div style="font-size:.82rem;font-weight:700;color:#fff;">{{ $val }}</div>
            <div style="font-size:.7rem;color:var(--ps-muted);">{{ $lbl }}</div>
          </div>
        </div>
        @endforeach
      </div>

      {{-- CTA --}}
      <a href="mailto:contact@junspro.com?subject=Réservation séance visio — Ma Pause Souffle"
         style="
           display:inline-flex;align-items:center;gap:.6rem;
           background:var(--ps-gold);color:#0a0a0a;
           padding:.85rem 2.2rem;border-radius:30px;
           font-size:.92rem;font-weight:700;letter-spacing:.04em;
           text-decoration:none;transition:opacity .18s;
         "
         onmouseover="this.style.opacity='.85'" onmouseout="this.style.opacity='1'">
        📅 Réserver ma séance de clôture
      </a>

      <p style="font-size:.78rem;color:rgba(232,224,208,.35);margin-top:1.2rem;">
        Incluse dans votre accès formation · Aucun frais supplémentaire
      </p>
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

<script>
function psToggleAct(header) {
  var act = header.closest('.ps-act');
  act.classList.toggle('is-expanded');
}

function psValidate(btn) {
  var act = btn.closest('.ps-act');
  act.classList.add('is-done');
  btn.innerHTML = '<span>✓</span> Complété';
  btn.disabled = true;
  btn.style.opacity = '.65';
  btn.style.cursor = 'default';
}

function psStartTimer(btn, inSec, holdSec, outSec, cycles) {
  var wrap = btn.closest('.ps-act__timer-wrap');
  var display = wrap.querySelector('.ps-act__timer-display');
  var phase = wrap.querySelector('.ps-act__timer-phase');
  if (!display || !phase) return;
  btn.disabled = true;
  btn.style.opacity = '.45';
  display.style.display = 'block';
  var cycle = 0;
  var phases = [
    { label: 'Inspirer ↑', sec: inSec },
    { label: 'Retenir ●', sec: holdSec },
    { label: 'Expirer ↓', sec: outSec }
  ];
  function runPhase(pi, timeLeft) {
    if (pi >= phases.length) {
      cycle++;
      if (cycle >= cycles) {
        display.textContent = '✓';
        phase.textContent = 'Terminé — rouvrez les yeux doucement';
        btn.disabled = false;
        btn.style.opacity = '1';
        return;
      }
      runPhase(0, phases[0].sec);
      return;
    }
    phase.textContent = phases[pi].label + ' · cycle ' + (cycle + 1) + '/' + cycles;
    display.textContent = timeLeft;
    if (timeLeft <= 0) { runPhase(pi + 1, phases[pi + 1] ? phases[pi + 1].sec : 0); return; }
    setTimeout(function() { runPhase(pi, timeLeft - 1); }, 1000);
  }
  runPhase(0, phases[0].sec);
}

function psMod05Tab(fam, btn) {
  document.querySelectorAll('#tabs-mod05 .ps-30j__tab').forEach(b => b.classList.remove('active'));
  document.querySelectorAll('[id^="pnl05-"]').forEach(p => p.classList.remove('active'));
  btn.classList.add('active');
  document.getElementById('pnl05-' + fam).classList.add('active');
}

function psMod04Tab(fam, btn) {
  document.querySelectorAll('#tabs-mod04 .ps-30j__tab').forEach(b => b.classList.remove('active'));
  document.querySelectorAll('[id^="pnl04-"]').forEach(p => p.classList.remove('active'));
  btn.classList.add('active');
  document.getElementById('pnl04-' + fam).classList.add('active');
}

function psSwitchLang(mod, lang) {
  var btnFr = document.getElementById('btn-lang-fr-' + mod);
  var btnEn = document.getElementById('btn-lang-en-' + mod);
  if (!btnFr || !btnEn) return;
  if (lang === 'fr') {
    btnFr.style.background = '#c9a84c'; btnFr.style.color = '#0f0f0f'; btnFr.style.border = 'none';
    btnEn.style.background = 'rgba(201,168,76,.15)'; btnEn.style.color = '#c9a84c'; btnEn.style.border = '1px solid #c9a84c';
  } else {
    btnEn.style.background = '#c9a84c'; btnEn.style.color = '#0f0f0f'; btnEn.style.border = 'none';
    btnFr.style.background = 'rgba(201,168,76,.15)'; btnFr.style.color = '#c9a84c'; btnFr.style.border = '1px solid #c9a84c';
  }
  var playerId = 'audio-player-' + mod;
  var audio = document.getElementById(playerId);
  if (audio) {
    var base = audio.getAttribute('data-base') || audio.src.replace(/-fr\.mp3$/, '').replace(/-en\.mp3$/, '');
    audio.setAttribute('data-base', base);
    audio.pause();
    audio.src = base + '-' + lang + '.mp3';
    audio.load();
    var wrap = document.getElementById(playerId + '-cp');
    if (wrap) {
      wrap.querySelector('.cplayer__fill').style.width = '0%';
      wrap.querySelector('.cplayer__thumb').style.left = '0%';
      wrap.querySelector('.cp-cur').textContent = '0:00';
      wrap.querySelector('.cp-dur').textContent = '--:--';
      var ipl = wrap.querySelector('.cp-icon-play');
      var ipa = wrap.querySelector('.cp-icon-pause');
      if (ipl) ipl.style.display = ''; if (ipa) ipa.style.display = 'none';
    }
  }
}
function initCPlayer(audioId) {
  var audio = document.getElementById(audioId);
  var wrap  = document.getElementById(audioId + '-cp');
  if (!audio || !wrap) return;
  var fill   = wrap.querySelector('.cplayer__fill');
  var thumb  = wrap.querySelector('.cplayer__thumb');
  var track  = wrap.querySelector('.cplayer__track');
  var curEl  = wrap.querySelector('.cp-cur');
  var durEl  = wrap.querySelector('.cp-dur');
  var iconPl = wrap.querySelector('.cp-icon-play');
  var iconPa = wrap.querySelector('.cp-icon-pause');
  var dragging = false;
  var pendingSeekPct = null;
  function fmt(s) { if (!isFinite(s)) return '--:--'; return Math.floor(s/60)+':'+('0'+Math.floor(s%60)).slice(-2); }
  function bar(p) { fill.style.width = p+'%'; thumb.style.left = p+'%'; }
  function pct(e) { var r = track.getBoundingClientRect(); var x = e.clientX; if (r.width <= 0) return 0; return Math.max(0, Math.min(1, (x - r.left) / r.width)) * 100; }
  function applyPendingSeek() { if (pendingSeekPct !== null && isFinite(audio.duration) && audio.duration > 0) { audio.currentTime = pendingSeekPct / 100 * audio.duration; pendingSeekPct = null; } }
  audio.addEventListener('loadedmetadata', function() { durEl.textContent = fmt(audio.duration); applyPendingSeek(); });
  audio.addEventListener('durationchange', function() { durEl.textContent = fmt(audio.duration); applyPendingSeek(); });
  audio.addEventListener('timeupdate', function() { if (dragging) return; curEl.textContent = fmt(audio.currentTime); if (isFinite(audio.duration) && audio.duration > 0) bar(audio.currentTime / audio.duration * 100); });
  audio.addEventListener('play',  function() { iconPl.style.display = 'none'; iconPa.style.display = ''; });
  audio.addEventListener('pause', function() { iconPl.style.display = ''; iconPa.style.display = 'none'; });
  audio.addEventListener('ended', function() { iconPl.style.display = ''; iconPa.style.display = 'none'; bar(100); });
  wrap.querySelector('.cplayer__btn-play').addEventListener('click', function() { audio.paused ? audio.play() : audio.pause(); });
  wrap.querySelectorAll('.cplayer__skip[data-seek]').forEach(function(btn) {
    btn.addEventListener('click', function() { var s = parseFloat(btn.dataset.seek); var max = isFinite(audio.duration) && audio.duration > 0 ? audio.duration : 1e9; audio.currentTime = Math.max(0, Math.min((audio.currentTime || 0) + s, max)); });
  });
  function doSeek(e) { var p = pct(e); bar(p); if (isFinite(audio.duration) && audio.duration > 0) { audio.currentTime = p / 100 * audio.duration; } else { pendingSeekPct = p; } }
  track.addEventListener('pointerdown', function(e) { dragging = true; track.setPointerCapture(e.pointerId); doSeek(e); });
  track.addEventListener('pointermove', function(e) { if (dragging) doSeek(e); });
  track.addEventListener('pointerup',   function()  { dragging = false; });
  track.addEventListener('pointercancel', function()  { dragging = false; });
}
document.addEventListener('DOMContentLoaded', function() {
  document.querySelectorAll('audio.ps-audio-element').forEach(function(audio) {
    initCPlayer(audio.id);
  });
});
</script>

@endsection
