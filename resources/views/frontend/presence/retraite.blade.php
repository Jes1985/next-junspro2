@extends('frontend.layout')

@php $en = isset($language) && $language->code === 'en'; @endphp

@section('pageHeading')
  {{ $en ? 'The Pause Souffle Retreat | 7 Days · The Immersion of a Lifetime' : 'La Retraite Pause Souffle | 7 Jours · L\'Immersion d\'une Vie' }}
@endsection

@section('metaDescription')
  {{ $en
    ? 'An exclusive 7-day retreat for Pause Souffle Practitioners. Surprise Mediterranean destination — private villa, pool & spa, private boat, chef. Breathwork, reflexology, equitherapy, freediving. 12 places only.'
    : 'Une retraite de 7 jours exclusive. Rivages ou sommets — destination surprise. Villa ou chalet privé, spa, chef, accès privatisé. Souffle, réflexologie, ski ou apnée. 12 places seulement.'
  }}
@endsection

@section('style')
<style>
/* ═════════════════════════════════════════════════════════════════
   RETRAITE PAUSE SOUFFLE — Design ultra luxe dark/gold
   Palette : --rt-dark #06060f · --rt-gold #D4A853 · --rt-teal #0EA5E9
   ═════════════════════════════════════════════════════════════════ */

:root {
  --rt-dark:    #06060f;
  --rt-dark2:   #0d0d1a;
  --rt-dark3:   #131320;
  --rt-surf:    #171724;
  --rt-gold:    #D4A853;
  --rt-gold-l:  #e8c87a;
  --rt-gold-d:  rgba(212,168,83,.12);
  --rt-gold-b:  rgba(212,168,83,.22);
  --rt-teal:    #0EA5E9;
  --rt-teal-d:  rgba(14,165,233,.12);
  --rt-sand:    #F0E9D8;
  --rt-muted:   rgba(240,233,216,.45);
  --rt-border:  rgba(212,168,83,.15);
  --rt-border2: rgba(255,255,255,.07);
  --serif:      Georgia, 'Times New Roman', serif;
  --sans:       -apple-system, BlinkMacSystemFont, 'Segoe UI', system-ui, sans-serif;
}

*, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

.rt-page {
  background: var(--rt-dark);
  color: var(--rt-sand);
  font-family: var(--sans);
  -webkit-font-smoothing: antialiased;
  overflow-x: hidden;
}

/* ── HERO ─────────────────────────────────────────────────────── */
.rt-hero {
  position: relative;
  min-height: 100vh;
  display: flex; align-items: center; justify-content: center;
  text-align: center;
  overflow: hidden;
  padding: 120px 24px 100px;
}

.rt-hero__backdrop {
  position: absolute; inset: 0; pointer-events: none;
  background:
    radial-gradient(ellipse 110% 60% at 50% -10%, rgba(212,168,83,.10) 0%, transparent 55%),
    radial-gradient(ellipse 70% 50% at 15% 90%,  rgba(14,165,233,.08) 0%, transparent 50%),
    radial-gradient(ellipse 60% 40% at 85% 80%,  rgba(20,184,166,.06) 0%, transparent 50%),
    linear-gradient(170deg, #0a0a18 0%, #06060f 50%, #060d12 100%);
}

/* Particules stellaires */
.rt-hero__stars {
  position: absolute; inset: 0; pointer-events: none;
  background-image:
    radial-gradient(1px 1px at  8% 12%, rgba(212,168,83,.55) 0%, transparent 100%),
    radial-gradient(1px 1px at 22% 35%, rgba(255,255,255,.18) 0%, transparent 100%),
    radial-gradient(1px 1px at 38% 18%, rgba(212,168,83,.40) 0%, transparent 100%),
    radial-gradient(1px 1px at 54% 72%, rgba(14,165,233,.35) 0%, transparent 100%),
    radial-gradient(1px 1px at 67% 28%, rgba(255,255,255,.12) 0%, transparent 100%),
    radial-gradient(1px 1px at 78% 55%, rgba(212,168,83,.30) 0%, transparent 100%),
    radial-gradient(1px 1px at 88% 22%, rgba(255,255,255,.20) 0%, transparent 100%),
    radial-gradient(1px 1px at 14% 78%, rgba(212,168,83,.25) 0%, transparent 100%),
    radial-gradient(1.5px 1.5px at 92% 88%, rgba(14,165,233,.45) 0%, transparent 100%),
    radial-gradient(1px 1px at 45% 92%, rgba(255,255,255,.10) 0%, transparent 100%),
    radial-gradient(1px 1px at 61% 8%,  rgba(212,168,83,.45) 0%, transparent 100%),
    radial-gradient(1.5px 1.5px at 32% 62%, rgba(255,255,255,.15) 0%, transparent 100%);
}

/* Ligne dorée centrale */
.rt-hero__line {
  position: absolute;
  top: 0; left: 50%; transform: translateX(-50%);
  width: 1px; height: 80px;
  background: linear-gradient(180deg, transparent 0%, var(--rt-gold) 100%);
  opacity: .5;
}

.rt-hero__inner {
  position: relative; z-index: 2;
  max-width: 860px; margin: 0 auto;
}

.rt-hero__eyebrow {
  display: inline-flex; align-items: center; gap: .6rem;
  font-size: .7rem; letter-spacing: .22em; text-transform: uppercase;
  color: var(--rt-gold); margin-bottom: 2.2rem;
}
.rt-hero__eyebrow-dot {
  width: 4px; height: 4px; border-radius: 50%;
  background: var(--rt-gold); display: inline-block;
}

.rt-hero__title {
  font-family: var(--serif);
  font-size: clamp(2.4rem, 6vw, 4.2rem);
  font-weight: 400;
  color: #fff;
  line-height: 1.15;
  letter-spacing: -.01em;
  margin-bottom: 1.6rem;
}
.rt-hero__title em {
  font-style: italic;
  color: var(--rt-gold);
}

.rt-hero__verse {
  font-size: clamp(.9rem, 2vw, 1.05rem);
  color: rgba(255,255,255,.38);
  font-style: italic;
  font-family: var(--serif);
  margin-bottom: 2.8rem;
  line-height: 1.7;
}

.rt-hero__manifesto {
  font-size: clamp(1rem, 2.5vw, 1.22rem);
  color: var(--rt-sand);
  line-height: 1.75;
  max-width: 640px;
  margin: 0 auto 3rem;
}
.rt-hero__manifesto strong {
  color: #fff;
  font-weight: 600;
}

.rt-hero__pills {
  display: flex; justify-content: center; flex-wrap: wrap; gap: .75rem;
  margin-bottom: 3.5rem;
}
.rt-pill {
  padding: 7px 18px;
  border: 1px solid var(--rt-gold-b);
  border-radius: 40px;
  font-size: .72rem;
  letter-spacing: .12em;
  text-transform: uppercase;
  color: var(--rt-gold);
  background: var(--rt-gold-d);
}

.rt-hero__cta-wrap {
  display: flex; justify-content: center; flex-wrap: wrap; gap: 1rem;
}

/* ── BOUTONS ──────────────────────────────────────────────────── */
.rt-btn-primary {
  display: inline-flex; align-items: center; gap: .6rem;
  background: linear-gradient(135deg, var(--rt-gold), #b8893a);
  color: #0a0a0a;
  font-size: .88rem; font-weight: 700;
  letter-spacing: .06em; text-transform: uppercase;
  padding: 1rem 2.2rem;
  border: none; border-radius: 6px;
  text-decoration: none; cursor: pointer;
  transition: transform .2s, box-shadow .2s;
  box-shadow: 0 4px 24px rgba(212,168,83,.28);
}
.rt-btn-primary:hover {
  transform: translateY(-2px);
  box-shadow: 0 8px 32px rgba(212,168,83,.40);
  color: #0a0a0a;
}

.rt-btn-ghost {
  display: inline-flex; align-items: center; gap: .6rem;
  background: transparent;
  color: var(--rt-sand);
  font-size: .88rem; font-weight: 500; letter-spacing: .04em;
  padding: 1rem 2rem;
  border: 1px solid var(--rt-border2);
  border-radius: 6px;
  text-decoration: none; cursor: pointer;
  transition: border-color .2s, color .2s;
}
.rt-btn-ghost:hover { border-color: var(--rt-gold-b); color: var(--rt-gold); }

/* ── SCROLL INDICATOR ─────────────────────────────────────────── */
.rt-scroll-indicator {
  position: absolute; bottom: 2.5rem; left: 50%; transform: translateX(-50%);
  display: flex; flex-direction: column; align-items: center; gap: .5rem;
  color: var(--rt-muted); font-size: .65rem; letter-spacing: .14em; text-transform: uppercase;
  z-index: 2;
}
.rt-scroll-line {
  width: 1px; height: 40px;
  background: linear-gradient(180deg, var(--rt-gold) 0%, transparent 100%);
  animation: rt-scroll-pulse 2s ease-in-out infinite;
}
@keyframes rt-scroll-pulse {
  0%, 100% { opacity: .2; }
  50%       { opacity: .8; }
}

/* ── SÉPARATEUR SECTION ───────────────────────────────────────── */
.rt-sep {
  width: 60px; height: 1px;
  background: linear-gradient(90deg, transparent, var(--rt-gold), transparent);
  margin: 0 auto 2.5rem;
}

/* ── SECTION GÉNÉRIQUE ────────────────────────────────────────── */
.rt-section {
  padding: clamp(4rem, 8vw, 7rem) 24px;
}
.rt-section--alt { background: var(--rt-dark2); }
.rt-section--teal-glow {
  background: linear-gradient(180deg, var(--rt-dark) 0%, #040c14 50%, var(--rt-dark) 100%);
}

.rt-section__inner {
  max-width: 1080px; margin: 0 auto;
}

.rt-section__eyebrow {
  font-size: .68rem; letter-spacing: .2em; text-transform: uppercase;
  color: var(--rt-gold); margin-bottom: 1rem; text-align: center;
}
.rt-section__title {
  font-family: var(--serif);
  font-size: clamp(1.8rem, 4vw, 2.8rem);
  font-weight: 400; color: #fff;
  line-height: 1.2; text-align: center;
  margin-bottom: 1.2rem;
}
.rt-section__title em { font-style: italic; color: var(--rt-gold); }
.rt-section__lead {
  max-width: 620px; margin: 0 auto 3.5rem;
  font-size: 1rem; color: var(--rt-muted);
  line-height: 1.75; text-align: center;
}

/* ── CONCEPT — 3 COLONNES ─────────────────────────────────────── */
.rt-concept-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
  gap: 1.5px;
  border: 1.5px solid var(--rt-border);
  border-radius: 14px;
  overflow: hidden;
  background: var(--rt-border);
  margin-bottom: 1px;
}
.rt-concept-card {
  background: var(--rt-surf);
  padding: 2.5rem 2rem;
  text-align: center;
  transition: background .25s;
}
.rt-concept-card:hover { background: #1a1a2c; }
.rt-concept-card__icon {
  font-size: 2.2rem; margin-bottom: 1.2rem; line-height: 1;
}
.rt-concept-card__title {
  font-family: var(--serif);
  font-size: 1.15rem; color: #fff;
  margin-bottom: .8rem; font-weight: 400;
}
.rt-concept-card__body {
  font-size: .88rem; color: var(--rt-muted);
  line-height: 1.7;
}

/* ── LIEU ─────────────────────────────────────────────────────── */
.rt-lieu-wrap {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 2px;
  border-radius: 16px; overflow: hidden;
  background: var(--rt-border);
}
@media (max-width: 700px) { .rt-lieu-wrap { grid-template-columns: 1fr; } }

.rt-lieu-visual {
  position: relative;
  min-height: 420px;
  background:
    radial-gradient(ellipse 80% 60% at 50% 30%, rgba(14,165,233,.18) 0%, transparent 60%),
    linear-gradient(135deg, #04101c 0%, #050e1a 50%, #040c12 100%);
  display: flex; align-items: center; justify-content: center;
  flex-direction: column; gap: 1rem;
  padding: 3rem;
}
.rt-lieu-visual__name {
  font-family: var(--serif);
  font-size: clamp(1.8rem, 4vw, 2.8rem);
  color: #fff; font-weight: 400;
  text-align: center; line-height: 1.2;
}
.rt-lieu-visual__name em { color: var(--rt-teal); font-style: italic; }
.rt-lieu-visual__sub {
  font-size: .78rem; letter-spacing: .18em; text-transform: uppercase;
  color: var(--rt-teal); text-align: center;
}
.rt-lieu-visual__wave {
  position: absolute; bottom: 0; left: 0; right: 0;
  height: 80px;
  background: linear-gradient(180deg, transparent, rgba(14,165,233,.06));
}

.rt-lieu-content { background: var(--rt-surf); padding: 3rem; display: flex; flex-direction: column; justify-content: center; }
.rt-lieu-content__title {
  font-family: var(--serif);
  font-size: 1.35rem; color: #fff; font-weight: 400;
  margin-bottom: 1.2rem; line-height: 1.3;
}
.rt-lieu-content__body { font-size: .9rem; color: var(--rt-muted); line-height: 1.8; margin-bottom: 1.5rem; }
.rt-lieu-detail-list { list-style: none; display: flex; flex-direction: column; gap: .6rem; }
.rt-lieu-detail-list li {
  display: flex; align-items: center; gap: .75rem;
  font-size: .85rem; color: var(--rt-sand);
}
.rt-lieu-detail-list li::before {
  content: ''; width: 5px; height: 5px; border-radius: 50%;
  background: var(--rt-gold); flex-shrink: 0;
}

/* ── TIMELINE 3 JOURS ─────────────────────────────────────────── */
.rt-timeline {
  position: relative;
  display: flex; flex-direction: column; gap: 0;
}
.rt-timeline::before {
  content: '';
  position: absolute; left: 47px; top: 0; bottom: 0; width: 1px;
  background: linear-gradient(180deg, transparent 0%, var(--rt-gold) 10%, var(--rt-gold) 90%, transparent 100%);
  opacity: .25;
}
@media (max-width: 640px) { .rt-timeline::before { left: 27px; } }

.rt-day {
  display: flex; gap: 2rem;
  padding: 2.5rem 0;
  border-bottom: 1px solid var(--rt-border2);
  position: relative;
}
.rt-day:last-child { border-bottom: none; }

.rt-day__num-wrap {
  flex-shrink: 0;
  width: 96px;
  display: flex; flex-direction: column; align-items: center; gap: .4rem;
  padding-top: .2rem;
}
@media (max-width: 640px) { .rt-day__num-wrap { width: 56px; } }

.rt-day__dot {
  width: 40px; height: 40px; border-radius: 50%;
  background: var(--rt-gold-d);
  border: 1.5px solid var(--rt-gold);
  display: flex; align-items: center; justify-content: center;
  font-size: .65rem; letter-spacing: .1em; text-transform: uppercase;
  color: var(--rt-gold); font-weight: 700;
  position: relative; z-index: 1;
  flex-shrink: 0;
}
.rt-day__label-num {
  font-size: .6rem; letter-spacing: .14em; text-transform: uppercase;
  color: var(--rt-muted);
}

.rt-day__body { flex: 1; }
.rt-day__theme {
  font-size: .65rem; letter-spacing: .18em; text-transform: uppercase;
  color: var(--rt-gold); margin-bottom: .5rem;
}
.rt-day__title {
  font-family: var(--serif);
  font-size: clamp(1.3rem, 3vw, 1.7rem);
  font-weight: 400; color: #fff;
  margin-bottom: .75rem; line-height: 1.2;
}
.rt-day__title em { font-style: italic; color: var(--rt-gold); }
.rt-day__lead {
  font-size: .9rem; color: var(--rt-muted);
  line-height: 1.75; margin-bottom: 1.2rem;
  max-width: 600px;
}
.rt-day__activities {
  display: flex; flex-wrap: wrap; gap: .6rem;
}
.rt-day__act {
  display: inline-flex; align-items: center; gap: .45rem;
  background: var(--rt-dark3); border: 1px solid var(--rt-border2);
  border-radius: 8px; padding: .55rem .9rem;
  font-size: .78rem; color: var(--rt-sand); line-height: 1;
}
.rt-day__act-icon { font-size: .95rem; }

/* ── ACTIVITÉS GRID ───────────────────────────────────────────── */
.rt-act-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
  gap: 1px;
  border: 1px solid var(--rt-border);
  border-radius: 16px; overflow: hidden;
  background: var(--rt-border);
}
.rt-act-card {
  background: var(--rt-surf);
  padding: 2rem 1.8rem;
  display: flex; flex-direction: column; gap: .8rem;
  transition: background .25s;
}
.rt-act-card:hover { background: #181825; }

.rt-act-card__header {
  display: flex; align-items: flex-start; gap: 1rem;
}
.rt-act-card__icon-wrap {
  width: 44px; height: 44px; border-radius: 10px; flex-shrink: 0;
  background: var(--rt-gold-d); border: 1px solid var(--rt-gold-b);
  display: flex; align-items: center; justify-content: center;
  font-size: 1.2rem; line-height: 1;
}
.rt-act-card__title { font-size: 1rem; font-weight: 600; color: #fff; line-height: 1.3; padding-top: .1rem; }
.rt-act-card__subtitle { font-size: .72rem; color: var(--rt-gold); letter-spacing: .06em; text-transform: uppercase; }
.rt-act-card__body { font-size: .85rem; color: var(--rt-muted); line-height: 1.7; }
.rt-act-card__tag {
  display: inline-block;
  font-size: .65rem; letter-spacing: .1em; text-transform: uppercase;
  padding: 4px 10px; border-radius: 4px;
  background: var(--rt-gold-d); color: var(--rt-gold);
  align-self: flex-start;
}

/* ── INCLUS ───────────────────────────────────────────────────── */
.rt-inclus-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
  gap: 1rem;
}
.rt-inclus-item {
  display: flex; align-items: flex-start; gap: 1rem;
  background: var(--rt-surf);
  border: 1px solid var(--rt-border2);
  border-radius: 12px;
  padding: 1.4rem 1.4rem;
  transition: border-color .2s;
}
.rt-inclus-item:hover { border-color: var(--rt-gold-b); }
.rt-inclus-item__icon { font-size: 1.4rem; flex-shrink: 0; padding-top: .1rem; }
.rt-inclus-item__title { font-size: .9rem; font-weight: 600; color: #fff; margin-bottom: .3rem; }
.rt-inclus-item__body { font-size: .8rem; color: var(--rt-muted); line-height: 1.6; }

/* ── POUR QUI ─────────────────────────────────────────────────── */
.rt-pourqui {
  max-width: 720px; margin: 0 auto;
  border: 1.5px solid var(--rt-gold-b);
  border-radius: 16px;
  padding: 3rem;
  background: linear-gradient(135deg, rgba(212,168,83,.05), transparent);
  text-align: center;
}
.rt-pourqui__title {
  font-family: var(--serif);
  font-size: 1.5rem; color: #fff;
  font-weight: 400; margin-bottom: 1.4rem; line-height: 1.3;
}
.rt-pourqui__title em { color: var(--rt-gold); font-style: italic; }
.rt-pourqui__list {
  list-style: none; text-align: left;
  display: flex; flex-direction: column; gap: .8rem;
  margin-bottom: 2rem;
}
.rt-pourqui__list li {
  display: flex; align-items: flex-start; gap: .8rem;
  font-size: .9rem; color: var(--rt-sand); line-height: 1.6;
}
.rt-pourqui__list li::before {
  content: '✦'; color: var(--rt-gold);
  font-size: .65rem; padding-top: .3rem; flex-shrink: 0;
}
.rt-pourqui__note {
  font-size: .82rem; color: var(--rt-muted);
  font-style: italic; line-height: 1.6;
  border-top: 1px solid var(--rt-border2);
  padding-top: 1.2rem; margin-top: .5rem;
}

/* ── CALENDRIER ÉDITIONS ────────────────────────────────────────── */
.rt-editions-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(230px, 1fr));
  gap: 1.2rem; margin: 2.5rem 0;
}
.rt-edition-card {
  background: rgba(255,255,255,.03);
  border: 1px solid rgba(255,255,255,.08);
  border-radius: 16px; padding: 1.8rem 1.5rem;
  text-align: left; transition: border-color .2s;
}
.rt-edition-card--open {
  border-color: var(--rt-gold-b);
  background: linear-gradient(135deg, rgba(212,168,83,.08), rgba(212,168,83,.03));
}
.rt-edition-card__season {
  font-size: .7rem; letter-spacing: .15em; text-transform: uppercase;
  color: var(--rt-gold); margin-bottom: .5rem;
}
.rt-edition-card__date {
  font-family: var(--serif); font-size: 1.3rem; color: #fff; margin-bottom: .5rem;
}
.rt-edition-card__dest { font-size: .82rem; color: var(--rt-muted); margin-bottom: 1rem; }
.rt-edition-card__status {
  display: inline-flex; align-items: center; gap: .4rem;
  font-size: .72rem; letter-spacing: .08em; text-transform: uppercase;
  font-weight: 700; padding: 4px 12px; border-radius: 20px;
}
.rt-edition-card__status--waiting { background: rgba(212,168,83,.15); color: var(--rt-gold); border: 1px solid var(--rt-gold-b); }
.rt-edition-card__status--open    { background: rgba(16,185,129,.12); color: #10b981; border: 1px solid rgba(16,185,129,.25); }
.rt-edition-card__status--full    { background: rgba(239,68,68,.08);  color: rgba(239,68,68,.8); border: 1px solid rgba(239,68,68,.2); }
/* ── LISTE D'ATTENTE ─────────────────────────────────────────────── */
.rt-waitlist { max-width: 620px; margin: 0 auto; }
.rt-waitlist__counter {
  display: flex; align-items: center; justify-content: center; gap: 1.5rem;
  background: linear-gradient(135deg, rgba(212,168,83,.1), rgba(212,168,83,.04));
  border: 1px solid var(--rt-gold-b);
  border-radius: 20px; padding: 1.5rem 2.5rem; margin: 2rem auto;
  max-width: 480px;
}
.rt-waitlist__num { font-size: 3.5rem; font-weight: 800; color: var(--rt-gold); line-height: 1; }
.rt-waitlist__counter-text { text-align:left; }
.rt-waitlist__counter-text strong { color: #fff; display: block; font-size: 1rem; }
.rt-waitlist__counter-text span   { color: var(--rt-sand); font-size: .85rem; }
.rt-waitlist__rule {
  background: rgba(14,165,233,.08); border: 1px solid rgba(14,165,233,.2);
  border-radius: 12px; padding: 1rem 1.5rem; margin: 1.5rem auto;
  max-width: 480px; font-size: .85rem; color: rgba(14,165,233,.9);
  display: flex; align-items: flex-start; gap: .7rem; line-height: 1.6;
}
.rt-waitlist__perks {
  display: flex; flex-wrap: wrap; gap: .6rem;
  justify-content: center; margin: 1.5rem 0;
}
.rt-waitlist__perk {
  display: inline-flex; align-items: center; gap: .4rem;
  background: rgba(255,255,255,.04); border: 1px solid rgba(255,255,255,.1);
  border-radius: 20px; padding: 6px 14px; font-size: .78rem; color: var(--rt-sand);
}
.rt-waitlist__perk::before { content: '✓'; color: var(--rt-gold); font-weight:700; }
.rt-waitlist__form {
  background: rgba(255,255,255,.03); border: 1px solid rgba(255,255,255,.08);
  border-radius: 20px; padding: 2rem; margin-top: 2rem; text-align: left;
}
.rt-waitlist__form-title {
  font-family: var(--serif); font-size: 1.25rem; color: #fff;
  margin-bottom: 1.2rem; font-style: italic;
}
.rt-waitlist__fields { display: grid; grid-template-columns: 1fr 1fr; gap: .8rem; margin-bottom: .8rem; }
.rt-waitlist__input {
  background: rgba(255,255,255,.05); border: 1px solid rgba(255,255,255,.12);
  border-radius: 10px; padding: .75rem 1rem; color: #fff; font-size: .9rem;
  outline: none; transition: border-color .2s; width: 100%;
}
.rt-waitlist__input:focus { border-color: var(--rt-gold-b); }
.rt-waitlist__input::placeholder { color: var(--rt-muted); }
.rt-waitlist__select {
  background: rgba(255,255,255,.05); border: 1px solid rgba(255,255,255,.12);
  border-radius: 10px; padding: .75rem 1rem; color: #fff; font-size: .9rem;
  outline: none; width: 100%; cursor: pointer;
  -webkit-appearance: none; appearance: none;
  background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='8' viewBox='0 0 12 8'%3E%3Cpath d='M1 1l5 5 5-5' stroke='%23D4A853' stroke-width='1.5' fill='none'/%3E%3C/svg%3E");
  background-repeat: no-repeat; background-position: right 1rem center; margin-bottom: .8rem;
}
.rt-waitlist__select option { background: #0e1020; color: #fff; }
.rt-waitlist__btn {
  width: 100%; padding: .95rem;
  background: linear-gradient(135deg, var(--rt-gold), var(--rt-gold-b));
  border: none; border-radius: 10px; color: #06060f;
  font-weight: 700; font-size: .95rem; cursor: pointer;
  transition: opacity .2s; letter-spacing: .03em;
}
.rt-waitlist__btn:hover { opacity: .88; }
.rt-waitlist__btn:disabled { opacity: .5; cursor: not-allowed; }
.rt-waitlist__success { text-align: center; padding: 2rem; display: none; color: #10b981; }
.rt-waitlist__success p.main { font-size:1.1rem; font-weight:600; margin-bottom:.5rem; }
/* ── PLACES LIMITÉES ──────────────────────────────────────────── */
.rt-places {
  display: flex; justify-content: center;
  margin-bottom: 1.5rem;
}
.rt-places__badge {
  display: inline-flex; align-items: center; gap: .8rem;
  background: linear-gradient(135deg, rgba(212,168,83,.12), rgba(212,168,83,.05));
  border: 1px solid var(--rt-gold-b);
  border-radius: 50px;
  padding: .9rem 2rem;
  font-size: .82rem;
}
.rt-places__num {
  font-size: 1.8rem; font-weight: 800; color: var(--rt-gold);
  line-height: 1;
}
.rt-places__text { color: var(--rt-sand); line-height: 1.3; }
.rt-places__text strong { color: #fff; font-size: .9rem; display: block; }

/* ── CTA FINAL ────────────────────────────────────────────────── */
.rt-cta-final {
  text-align: center;
  padding: clamp(5rem, 10vw, 8rem) 24px;
  position: relative;
  overflow: hidden;
  background: linear-gradient(180deg, var(--rt-dark) 0%, #06080f 50%, var(--rt-dark) 100%);
}
.rt-cta-final__backdrop {
  position: absolute; inset: 0; pointer-events: none;
  background: radial-gradient(ellipse 90% 60% at 50% 50%, rgba(212,168,83,.06) 0%, transparent 65%);
}
.rt-cta-final__inner { position: relative; z-index: 1; max-width: 680px; margin: 0 auto; }
.rt-cta-final__title {
  font-family: var(--serif);
  font-size: clamp(2rem, 5vw, 3.2rem);
  font-weight: 400; color: #fff;
  line-height: 1.2; margin-bottom: 1.2rem;
}
.rt-cta-final__title em { color: var(--rt-gold); font-style: italic; }
.rt-cta-final__sub {
  font-size: 1rem; color: var(--rt-muted);
  line-height: 1.75; margin-bottom: 2.8rem;
  font-style: italic;
}

/* ── QUOTE CENTRALE ───────────────────────────────────────────── */
.rt-quote {
  text-align: center;
  max-width: 700px; margin: 0 auto;
  padding: 0 1rem;
}
.rt-quote__text {
  font-family: var(--serif);
  font-size: clamp(1.3rem, 3.5vw, 1.75rem);
  color: #fff; font-weight: 400; line-height: 1.5;
  font-style: italic; margin-bottom: 1rem;
}
.rt-quote__text em { color: var(--rt-gold); }
.rt-quote__attr {
  font-size: .72rem; letter-spacing: .16em; text-transform: uppercase;
  color: var(--rt-gold);
}

/* ── RESPONSIVE ───────────────────────────────────────────────── */
@media (max-width: 640px) {
  .rt-lieu-content { padding: 2rem 1.5rem; }
  .rt-concept-card { padding: 2rem 1.5rem; }
  .rt-day { gap: 1.2rem; }
  .rt-pourqui { padding: 2rem 1.5rem; }
  .rt-act-grid { grid-template-columns: 1fr; }

  .rt-lang-toggle { bottom: 5rem; right: 1.25rem; }
}

/* ── LANG TOGGLE ──────────────────────────────────────────────── */
.rt-lang-toggle {
  position: fixed;
  bottom: 5.5rem;
  right: 2rem;
  z-index: 9999;
  display: flex;
  align-items: center;
  gap: 0;
  background: rgba(13,13,26,.92);
  border: 1px solid rgba(212,168,83,.35);
  border-radius: 999px;
  backdrop-filter: blur(12px);
  -webkit-backdrop-filter: blur(12px);
  box-shadow: 0 8px 32px rgba(0,0,0,.55), 0 0 0 1px rgba(212,168,83,.08);
  overflow: hidden;
  padding: 3px;
}
.rt-lang-toggle__btn {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  gap: .35rem;
  padding: .52rem 1.15rem;
  border-radius: 999px;
  font-family: 'Montserrat', Georgia, sans-serif;
  font-size: .7rem;
  font-weight: 700;
  letter-spacing: .12em;
  text-transform: uppercase;
  text-decoration: none;
  border: none;
  cursor: pointer;
  transition: background .22s, color .22s, box-shadow .22s;
  color: rgba(255,255,255,.38);
  background: transparent;
}
.rt-lang-toggle__btn--active {
  background: linear-gradient(135deg, var(--rt-gold), #c49340);
  color: #06060f;
  box-shadow: 0 2px 12px rgba(212,168,83,.4);
}
.rt-lang-toggle__btn--active:hover { opacity: .9; }
.rt-lang-toggle__btn:not(.rt-lang-toggle__btn--active):hover {
  color: var(--rt-gold-l);
}
.rt-lang-toggle__sep {
  width: 1px;
  height: 16px;
  background: rgba(212,168,83,.22);
  flex-shrink: 0;
}
</style>
@endsection

@section('content')
<div class="rt-page">

  {{-- ── LANGUE TOGGLE FLOTTANT ─────────────────────────────── --}}
  <div class="rt-lang-toggle" role="navigation" aria-label="Language switcher">
    <a href="{{ url()->current() }}?lang=fr"
       class="rt-lang-toggle__btn {{ !$en ? 'rt-lang-toggle__btn--active' : '' }}"
       title="Version française">
      FR
    </a>
    <span class="rt-lang-toggle__sep"></span>
    <a href="{{ url()->current() }}?lang=en"
       class="rt-lang-toggle__btn {{ $en ? 'rt-lang-toggle__btn--active' : '' }}"
       title="English version">
      EN
    </a>
  </div>

  {{-- ═══════════════════════════════════════════════════════ --}}
  {{-- HERO                                                    --}}
  {{-- ═══════════════════════════════════════════════════════ --}}
  <section class="rt-hero">
    <div class="rt-hero__backdrop"></div>
    <div class="rt-hero__stars"></div>
    <div class="rt-hero__line"></div>

    <div class="rt-hero__inner">
      <div class="rt-hero__eyebrow">
        <span class="rt-hero__eyebrow-dot"></span>
        {{ $en ? 'Pause Souffle' : 'Pause Souffle' }}
        <span class="rt-hero__eyebrow-dot"></span>
        {{ $en ? 'The Retreat' : 'La Retraite' }}
        <span class="rt-hero__eyebrow-dot"></span>
      </div>

      <h1 class="rt-hero__title">
        {{ $en ? 'What you understood,' : 'Ce que vous avez compris,' }}<br>
        <em>{{ $en ? 'you are about to live it' : 'vous allez maintenant le vivre.' }}</em>
      </h1>

      <p class="rt-hero__verse">
        @if($en)
          "I ran for a very long time. I stopped everything.<br>And that is where I found everything. And infinitely more."
        @else
          « J'ai couru très longtemps. J'ai tout arrêté.<br>Et c'est là que j'ai tout trouvé. Et infiniment plus. »
        @endif
      </p>

      <p class="rt-hero__manifesto">
        @if($en)
          Seven days. One secret place. A transformation your body will <strong>never forget.</strong><br>
          Not a holiday. The most powerful week of your year.
        @else
          Sept jours. Un lieu secret. Une transformation que votre corps <strong>n'oubliera jamais.</strong><br>
          Pas un voyage. La semaine la plus impactante de votre vie.
        @endif
      </p>

      <div class="rt-hero__pills">
        <span class="rt-pill">{{ $en ? '7 Days' : '7 Jours' }}</span>
        <span class="rt-pill">{{ $en ? 'Rivages & Sommets · Surprise Destination' : 'Rivages & Sommets · Destination Surprise' }}</span>
        <span class="rt-pill">{{ $en ? 'Villa or Chalet · Spa' : 'Villa ou Chalet · Spa' }}</span>
        <span class="rt-pill">{{ $en ? '12 Places only' : '12 Places seulement' }}</span>
        <span class="rt-pill">{{ $en ? 'Freelances Pause Souffle' : 'Freelances Pause Souffle' }}</span>
      </div>

      <div class="rt-hero__cta-wrap">
        <a href="{{ route('presence.formation-praticien') }}" class="rt-btn-primary">
          {{ $en ? 'Reserve my place →' : 'Réserver ma place →' }}
        </a>
        <a href="#programme" class="rt-btn-ghost">
          {{ $en ? 'See the programme' : 'Voir le programme' }}
        </a>
      </div>
    </div>

    <div class="rt-scroll-indicator">
      <span>{{ $en ? 'Discover' : 'Découvrir' }}</span>
      <div class="rt-scroll-line"></div>
    </div>
  </section>

  {{-- ═══════════════════════════════════════════════════════ --}}
  {{-- CITATION CENTRALE                                       --}}
  {{-- ═══════════════════════════════════════════════════════ --}}
  <section class="rt-section" style="padding: 4rem 24px;">
    <div class="rt-quote">
      @if($en)
        <p class="rt-quote__text">"The retreat is not a luxury.<br>It is the <em>proof through the body</em><br>of what the modules planted."</p>
      @else
        <p class="rt-quote__text">« La retraite n'est pas un luxe.<br>C'est la <em>preuve par le corps</em><br>de ce que les modules ont semé. »</p>
      @endif
      <div class="rt-sep"></div>
      <p class="rt-quote__attr">{{ $en ? 'Pause Souffle · The Retreat · Rivages & Sommets' : 'Pause Souffle · La Retraite · Rivages & Sommets' }}</p>
    </div>
  </section>

  {{-- ═══════════════════════════════════════════════════════ --}}
  {{-- CONCEPT — 3 PILIERS                                     --}}
  {{-- ═══════════════════════════════════════════════════════ --}}
  <section class="rt-section rt-section--alt">
    <div class="rt-section__inner">
      <p class="rt-section__eyebrow">{{ $en ? 'The concept' : 'Le concept' }}</p>
      <h2 class="rt-section__title">
        @if($en)
          Not a retreat.<br><em>A homecoming.</em>
        @else
          Pas une retraite.<br><em>Un retour à soi.</em>
        @endif
      </h2>
      <p class="rt-section__lead">
        @if($en)
          You completed six modules. You have a practitioner's attestation. You carry insights no one can take from you. Now the body needs to integrate what the mind has understood.
        @else
          Vous avez traversé six modules. Vous portez une attestation de praticien. Vous portez des compréhensions que personne ne peut vous enlever. Il reste une étape : laisser le corps intégrer ce que l'esprit a compris.
        @endif
      </p>

      <div class="rt-concept-grid">
        <div class="rt-concept-card">
          <div class="rt-concept-card__icon">🌊</div>
          <h3 class="rt-concept-card__title">{{ $en ? 'Leave.' : 'Partir.' }}</h3>
          <p class="rt-concept-card__body">
            @if($en)
              Cross a sea. Get on a plane. Put geography between daily life and the person you are becoming. The distance is part of the work.
            @else
              Traverser une mer. Prendre un avion. Mettre de la géographie entre le quotidien et la personne que vous devenez. La distance fait partie du travail.
            @endif
          </p>
        </div>
        <div class="rt-concept-card">
          <div class="rt-concept-card__icon">🔥</div>
          <h3 class="rt-concept-card__title">{{ $en ? 'Live it.' : 'Vivre.' }}</h3>
          <p class="rt-concept-card__body">
            @if($en)
              Seven days with no distractions, no roles, no performance. Only practices that speak directly to the body. Breathwork. Water. Silence. Movement. Animals. Fire.
            @else
              Sept jours sans distraction, sans rôle, sans performance. Seulement des pratiques qui parlent directement au corps. Souffle. Eau. Silence. Mouvement. Animaux. Feu.
            @endif
          </p>
        </div>
        <div class="rt-concept-card">
          <div class="rt-concept-card__icon">✦</div>
          <h3 class="rt-concept-card__title">{{ $en ? 'Return.' : 'Revenir.' }}</h3>
          <p class="rt-concept-card__body">
            @if($en)
              Come back different. Not because you learned something new. But because what you already know has entered every cell of your body. That is the definition of transformation.
            @else
              Revenir différent. Pas parce que vous avez appris quelque chose de nouveau. Mais parce que ce que vous savez déjà est entré dans chaque cellule. C'est ça, la transformation.
            @endif
          </p>
        </div>
      </div>
    </div>
  </section>

  {{-- ═══════════════════════════════════════════════════════ --}}
  {{-- LE LIEU                                                 --}}
  {{-- ═══════════════════════════════════════════════════════ --}}
  <section class="rt-section rt-section--teal-glow">
    <div class="rt-section__inner">
      <p class="rt-section__eyebrow">{{ $en ? 'The place' : 'Le lieu' }}</p>
      <h2 class="rt-section__title" style="margin-bottom: 3rem;">
        @if($en)
          <em>Somewhere between shores and summits.</em><br>Sea or mountain: revealed at registration &middot; Exact venue revealed 4 weeks before departure.
        @else
          <em>Quelque part entre rivages et sommets.</em><br>Mer ou montagne : révélé à l'inscription &middot; Le lieu exact révélé 4 semaines avant le départ.
        @endif
      </h2>

      <div class="rt-lieu-wrap">
        <div class="rt-lieu-visual">
          <p class="rt-lieu-visual__sub">{{ $en ? 'Sea or mountain — a surprise every year' : 'Mer ou montagne — une surprise chaque année' }}</p>
          <p class="rt-lieu-visual__name">
            {{ $en ? '??' : '??' }}<br>
            <em>{{ $en ? 'The secret' : 'Le secret' }}</em>
          </p>
          <p style="font-size:.82rem; color:rgba(14,165,233,.7); text-align:center; max-width:260px; line-height:1.6;">
            @if($en)
              Shore or summit · Private villa or chalet · Spa · Private chef
            @else
              Rivage ou sommet · Villa ou chalet privé · Spa · Chef privé
            @endif
          </p>
          <div class="rt-lieu-visual__wave"></div>
        </div>

        <div class="rt-lieu-content">
          <h3 class="rt-lieu-content__title">
            @if($en)
              The destination changes. The universe changes. The standards never do.
            @else
              La destination change. L'univers change. Les standards, jamais.
            @endif
          </h3>
          <p class="rt-lieu-content__body">
            @if($en)
              Each year, a different destination — sometimes a private villa by turquoise water, sometimes a luxury ski chalet at altitude. Always exclusive for the group, always with a private spa, always a private chef, always a setting worthy of the interior journey you have made. The universe (sea or mountain) is revealed when registrations open — 3 months before departure. The exact venue remains secret until 4 weeks before arrival. The adventure begins the moment you register.
            @else
              Chaque année, une destination différente — parfois une villa privée au bord d'une eau turquoise, parfois un chalet de luxe en altitude. Toujours exclusive pour le groupe, toujours avec spa privé, toujours avec un chef privé, toujours un cadre à la hauteur du voyage intérieur accompli. L'univers (mer ou montagne) est révélé à l'ouverture des inscriptions — 3 mois avant le départ. Le lieu exact reste secret jusqu'à 4 semaines avant l'arrivée. L'aventure commence dès l'inscription.
            @endif
          </p>

          {{-- Destinations possibles --}}
          <div style="margin: 1.5rem 0;">

            {{-- ÉDITION FONDATRICE --}}
            <div style="margin-bottom:1.25rem; padding:1rem 1.25rem; background:linear-gradient(135deg,rgba(212,168,83,.1),rgba(212,168,83,.04)); border:1px solid rgba(212,168,83,.35); border-radius:12px;">
              <div style="display:flex; align-items:center; gap:.6rem; margin-bottom:.5rem;">
                <span style="background:var(--rt-gold); color:#0D0D1A; font-size:.6rem; font-weight:800; letter-spacing:2px; text-transform:uppercase; padding:3px 10px; border-radius:20px;">{{ $en ? 'Founding Edition' : 'Édition Fondatrice' }}</span>
                <span style="font-size:.72rem; color:rgba(212,168,83,.6); letter-spacing:1px;">{{ $en ? 'First 3 sea retreats' : '3 premières retraites mer' }}</span>
              </div>
              <div style="display:flex; align-items:center; gap:.75rem; flex-wrap:wrap;">
                <span style="font-size:1.25rem;">🇲🇹</span>
                <div>
                  <div style="font-size:.95rem; font-weight:600; color:var(--rt-gold);">{{ $en ? 'Malta · Gozo' : 'Malte · Gozo' }}</div>
                  <div style="font-size:.75rem; color:rgba(255,255,255,.4); line-height:1.5;">{{ $en ? 'Azure Window · Blue Lagoon · private villa overlooking the sea · 300 days of sun' : 'Azure Window · Blue Lagoon · villa privée surplombant la mer · 300 jours de soleil' }}</div>
                </div>
              </div>
            </div>

            <div style="font-size:.65rem; letter-spacing:1.8px; text-transform:uppercase; color:rgba(14,165,233,.6); margin-bottom:.6rem;">{{ $en ? '🌊 Sea editions — after Malte' : '🌊 Éditions Mer — après Malte' }}</div>
            <div style="display:flex; flex-wrap:wrap; gap:.5rem; margin-bottom:1rem;">
              <span style="background:rgba(212,168,83,.12); border:1px solid rgba(212,168,83,.25); color:var(--rt-gold); font-size:.72rem; font-weight:600; letter-spacing:1.5px; text-transform:uppercase; padding:4px 12px; border-radius:20px;">Crète</span>
              <span style="background:rgba(212,168,83,.12); border:1px solid rgba(212,168,83,.25); color:var(--rt-gold); font-size:.72rem; font-weight:600; letter-spacing:1.5px; text-transform:uppercase; padding:4px 12px; border-radius:20px;">Pouilles</span>
              <span style="background:rgba(212,168,83,.12); border:1px solid rgba(212,168,83,.25); color:var(--rt-gold); font-size:.72rem; font-weight:600; letter-spacing:1.5px; text-transform:uppercase; padding:4px 12px; border-radius:20px;">Essaouira</span>
              <span style="background:rgba(212,168,83,.12); border:1px solid rgba(212,168,83,.25); color:var(--rt-gold); font-size:.72rem; font-weight:600; letter-spacing:1.5px; text-transform:uppercase; padding:4px 12px; border-radius:20px;">Bodrum</span>
              <span style="background:rgba(14,165,233,.12); border:1px solid rgba(14,165,233,.2); color:rgba(14,165,233,.9); font-size:.72rem; font-weight:600; letter-spacing:1.5px; text-transform:uppercase; padding:4px 12px; border-radius:20px;">{{ $en ? 'Or elsewhere…' : 'Ou ailleurs…' }}</span>
            </div>

            <div style="font-size:.65rem; letter-spacing:1.8px; text-transform:uppercase; color:rgba(132,204,22,.6); margin-bottom:.6rem;">{{ $en ? '⛷️ Mountain editions' : '⛷️ Éditions Montagne' }}</div>
            <div style="display:flex; flex-wrap:wrap; gap:.5rem;">
              <span style="background:rgba(132,204,22,.1); border:1px solid rgba(132,204,22,.3); color:#84CC16; font-size:.72rem; font-weight:700; letter-spacing:1.5px; text-transform:uppercase; padding:4px 12px; border-radius:20px; position:relative;">Méribel-Village ★</span>
              <span style="background:rgba(132,204,22,.1); border:1px solid rgba(132,204,22,.22); color:#84CC16; font-size:.72rem; font-weight:600; letter-spacing:1.5px; text-transform:uppercase; padding:4px 12px; border-radius:20px;">Megève</span>
              <span style="background:rgba(132,204,22,.1); border:1px solid rgba(132,204,22,.22); color:#84CC16; font-size:.72rem; font-weight:600; letter-spacing:1.5px; text-transform:uppercase; padding:4px 12px; border-radius:20px;">Verbier</span>
              <span style="background:rgba(132,204,22,.1); border:1px solid rgba(132,204,22,.22); color:#84CC16; font-size:.72rem; font-weight:600; letter-spacing:1.5px; text-transform:uppercase; padding:4px 12px; border-radius:20px;">Dolomites</span>
            </div>
            <p style="font-size:.72rem; color:rgba(132,204,22,.45); margin-top:.5rem; font-style:italic;">★ {{ $en ? 'Méribel-Village — founding mountain edition. Chalet with independent staff annex.' : 'Méribel-Village — édition fondatrice montagne. Chalet avec dépendance indépendante.' }}</p>
          </div>

          <ul class="rt-lieu-detail-list">
            <li>{{ $en ? 'Entire private villa or luxury chalet — 12+ bedrooms, exclusive for the group · staff annex available' : 'Villa privée entière ou chalet de luxe — 12+ chambres, exclusif pour le groupe · dépendance équipe disponible' }}</li>
            <li>{{ $en ? 'Infinity pool (sea) or Nordic outdoor jacuzzi (mountain) · Full spa included' : 'Piscine à débordement (mer) ou jacuzzi nordique extérieur (montagne) · Spa complet inclus' }}</li>
            <li>{{ $en ? 'In-house or adjacent spa — hammam, jacuzzi, sauna, treatment room' : 'Spa intégré ou attenant — hammam, jacuzzi, sauna, salle de soins' }}</li>
            <li>{{ $en ? 'Private boat trip (sea) or full ski day at a premium resort (mountain)' : 'Sortie en bateau privatisé (mer) ou journée ski sur domaine premium (montagne)' }}</li>
            <li>{{ $en ? 'Chef on site — slow, local, seasonal cuisine' : 'Chef sur place — cuisine lente, locale, de saison' }}</li>
            <li>{{ $en ? 'Round-trip flight included · Organised by our Junspro team' : 'Vol aller-retour inclus · Organisé par notre équipe Junspro pour vous' }}</li>
            <li>{{ $en ? 'Universe (sea or mountain) revealed at registration (3 months before) · Exact venue revealed 4 weeks before arrival' : 'Univers (mer ou montagne) révélé à l\'inscription (3 mois avant) · Lieu exact révélé 4 semaines avant l\'arrivée' }}</li>
          </ul>
        </div>
      </div>
    </div>
  </section>

  {{-- ═══════════════════════════════════════════════════════ --}}
  {{-- PROGRAMME 7 JOURS                                       --}}
  {{-- ═══════════════════════════════════════════════════════ --}}
  <section id="programme" class="rt-section rt-section--alt">
    <div class="rt-section__inner">
      <p class="rt-section__eyebrow">{{ $en ? 'The programme' : 'Le programme' }}</p>
      <h2 class="rt-section__title">
        @if($en)
          Seven days.<br><em>Seven layers.</em>
        @else
          Sept jours.<br><em>Sept couches.</em>
        @endif
      </h2>
      <p class="rt-section__lead">
        @if($en)
          One day per module, plus an arrival day, an integration day, and a departure. Each practice is chosen because it directly embodies what the formation planted.
        @else
          Un jour par module, plus un jour d'arrivée, un jour d'intégration, et un jour d'envoi. Chaque pratique est choisie parce qu'elle incarne directement ce que la formation a semé.
        @endif
      </p>

      {{-- TOGGLE MER / MONTAGNE --}}
      <style>
        .rt-prog-toggle { display:flex; gap:.75rem; margin-bottom:2.5rem; flex-wrap:wrap; }
        .rt-prog-tab { background:transparent; border:1px solid rgba(212,168,83,.3); color:rgba(255,255,255,.4); font-size:.73rem; font-weight:700; letter-spacing:1.8px; text-transform:uppercase; padding:.7rem 1.6rem; border-radius:30px; cursor:pointer; transition:all .28s ease; }
        .rt-prog-tab:hover { border-color:rgba(212,168,83,.6); color:rgba(255,255,255,.7); }
        .rt-prog-tab.rt-prog-tab--active { background:rgba(212,168,83,.12); border-color:var(--rt-gold); color:var(--rt-gold); }
        .rt-prog-tab.rt-prog-tab--mountain.rt-prog-tab--active { background:rgba(132,204,22,.1); border-color:#84CC16; color:#84CC16; }
        .rt-prog-panel { display:none; }
        .rt-prog-panel.rt-prog-panel--visible { display:block; }
      </style>

      <div class="rt-prog-toggle">
        <button class="rt-prog-tab rt-prog-tab--active" data-target="prog-mer">🌊 {{ $en ? 'Sea &amp; Shores' : 'Mer &amp; Rivages' }}</button>
        <button class="rt-prog-tab rt-prog-tab--mountain" data-target="prog-montagne">⛷️ {{ $en ? 'Mountain &amp; Summits' : 'Montagne &amp; Sommets' }}</button>
      </div>

      <div id="prog-mer" class="rt-prog-panel rt-prog-panel--visible">
      {{-- Note fondatrice --}}
      <div style="margin-bottom:1.75rem; padding:.875rem 1.25rem; background:rgba(212,168,83,.06); border:1px solid rgba(212,168,83,.2); border-radius:10px; font-size:.78rem; color:rgba(212,168,83,.65); line-height:1.6;">
        🇲🇹 {{ $en ? 'Founding editions — Malta &amp; Gozo. The 3 first sea retreats take place on the island of Gozo — the wild, silent face of Malta.' : 'Éditions fondatrices — Malte &amp; Gozo. Les 3 premières retraites mer se déroulent sur l’île de Gozo — le visage sauvage et silencieux de Malte.' }}
      </div>
      <div class="rt-timeline">

        {{-- JOUR 1 — ARRIVÉE --}}
        <div class="rt-day">
          <div class="rt-day__num-wrap">
            <div class="rt-day__dot">J1</div>
            <span class="rt-day__label-num">{{ $en ? 'Day 1' : 'Jour 1' }}</span>
          </div>
          <div class="rt-day__body">
            <p class="rt-day__theme">{{ $en ? 'Arrival · Settling in' : 'Arrivée · Installation' }}</p>
            <h3 class="rt-day__title">{!! $en ? '"<em>Arrive.</em>"' : '"<em>Arriver.</em>"' !!}</h3>
            <p class="rt-day__lead">
              @if($en)
                No programme displayed on arrival. First act: put down your bags and breathe. Two hours of pure silence on the terrace — the sea of Gozo below you, the Azure Window cliffs in the distance. In the evening: fire, letter, and the words you have never said out loud. The first dinner — local fish, capers, wild thyme.
              @else
                Pas de programme affiché. Premier acte : poser les bagages et respirer. Deux heures de silence pur sur la terrasse — la mer de Gozo en contrebas, les falaises de l'Azure Window au loin. Le soir : feu, lettre, et les mots que vous n'avez jamais dits à voix haute. Premier dîner — poisson local, câpres, thym sauvage.
            @endif
            </p>
            <div class="rt-day__activities">
              <span class="rt-day__act"><span class="rt-day__act-icon">🤲</span>{{ $en ? 'Welcome silence on the Gozo terrace (2h)' : 'Silence d\'accueil sur la terrasse de Gozo (2h)' }}</span>
              <span class="rt-day__act"><span class="rt-day__act-icon">🏡</span>{{ $en ? 'Villa discovery · Free afternoon facing the sea' : 'Découverte de la villa · Après-midi libre face à la mer' }}</span>
              <span class="rt-day__act"><span class="rt-day__act-icon">🕯️</span>{{ $en ? 'Opening fire ritual + letter to oneself' : 'Rituel du feu d\'ouverture + lettre à soi' }}</span>
              <span class="rt-day__act"><span class="rt-day__act-icon">🍽️</span>{{ $en ? 'First dinner · Maltese cuisine · local fish · capers · wild thyme' : 'Premier dîner · cuisine maltaise · poisson local · câpres · thym sauvage' }}</span>
            </div>
          </div>
        </div>

        {{-- JOUR 2 — MODULE 1 --}}
        <div class="rt-day">
          <div class="rt-day__num-wrap">
            <div class="rt-day__dot">J2</div>
            <span class="rt-day__label-num">{{ $en ? 'Day 2' : 'Jour 2' }}</span>
          </div>
          <div class="rt-day__body">
            <p class="rt-day__theme">{{ $en ? 'Module 1 — Embodied' : 'Module 1 — Incarné' }}</p>
            <h3 class="rt-day__title">{!! $en ? '"<em>Meet yourself.</em>"' : '"<em>Se rencontrer.</em>"' !!}</h3>
            <p class="rt-day__lead">
              @if($en)
                Outdoor reflexology at dawn on the Gozo terrace, facing the water — the body lets go of what the mind has kept behind glass. Then a silent walk along the Dwejra cliffs: no destination, no performance, only the presence and the wild sea below. In the evening, the first collective 5-5-5 breathwork facing the Gozo sea.
              @else
                Réflexologie plantaire à l'aube sur la terrasse de Gozo, face à l'eau — le corps lâche ce que l'esprit gardait derrière une vitre. Puis marche silencieuse le long des falaises de Dwejra : pas de destination, pas de performance, seulement la présence et la mer sauvage en contrebas. Le soir, premier souffle collectif 5-5-5 face à la mer de Gozo.
              @endif
            </p>
            <div class="rt-day__activities">
              <span class="rt-day__act"><span class="rt-day__act-icon">🦶</span>{{ $en ? 'Outdoor reflexology · Gozo terrace (75 min)' : 'Réflexologie plantaire · terrasse de Gozo (75 min)' }}</span>
              <span class="rt-day__act"><span class="rt-day__act-icon">🚶</span>{{ $en ? 'Silent walk · Dwejra cliffs (1h)' : 'Marche silencieuse · falaises de Dwejra (1h)' }}</span>
              <span class="rt-day__act"><span class="rt-day__act-icon">🫁</span>{{ $en ? 'Collective 5-5-5 breathwork · Gozo sea' : 'Souffle collectif 5-5-5 · mer de Gozo' }}</span>
            </div>
          </div>
        </div>

        {{-- JOUR 3 — MODULE 2 --}}
        <div class="rt-day">
          <div class="rt-day__num-wrap">
            <div class="rt-day__dot">J3</div>
            <span class="rt-day__label-num">{{ $en ? 'Day 3' : 'Jour 3' }}</span>
          </div>
          <div class="rt-day__body">
            <p class="rt-day__theme">{{ $en ? 'Module 2 — Embodied' : 'Module 2 — Incarné' }}</p>
            <h3 class="rt-day__title">{!! $en ? '"<em>Recognise the wound.</em>"' : '"<em>Reconnaître la blessure.</em>"' !!}</h3>
            <p class="rt-day__lead">
              @if($en)
                Shiatsu in the morning — deep manual therapy that speaks the wound held in the body. After lunch: a private session, 45 minutes, on the terrace looking out to sea. In the late afternoon: outdoor pottery on the Gozo beach — hands in the clay, facing the sea, in silence. A video montage will be created of this session. In the evening: speaking circles under the stars of Gozo, then collective vocal toning — the voice of the group as one breath.
              @else
                Shiatsu le matin — thérapie manuelle profonde qui parle directement à la blessure tenue dans le corps. Après déjeuner : session individuelle privée, 45 minutes, terrasse face à la mer. En fin d'après-midi : poterie en plein air sur la plage de Gozo — les mains dans l'argile, face à la mer, en silence. Un montage vidéo sera réalisé sur cette session. Le soir : cercles de parole sous les étoiles de Gozo, puis tonalisation vocale collective — la voix du groupe, comme un seul souffle.
              @endif
            </p>
            <div class="rt-day__activities">
              <span class="rt-day__act"><span class="rt-day__act-icon">🫁</span>{{ $en ? 'Deep shiatsu (75 min)' : 'Shiatsu profond (75 min)' }}</span>
              <span class="rt-day__act"><span class="rt-day__act-icon">🪑</span>{{ $en ? 'Private individual session (45 min)' : 'Session individuelle privée (45 min)' }}</span>
              <span class="rt-day__act"><span class="rt-day__act-icon">🏺</span>{{ $en ? 'Outdoor pottery · Gozo beach · local freelance (90 min)' : 'Poterie en plein air · plage de Gozo · freelance local (90 min)' }}</span>
              <span class="rt-day__act"><span class="rt-day__act-icon">🎵</span>{{ $en ? 'Speaking circle · collective vocal toning' : 'Cercle de parole · tonalisation vocale collective' }}</span>
            </div>
          </div>
        </div>

        {{-- JOUR 4 — MODULES 3 & 4 --}}
        <div class="rt-day">
          <div class="rt-day__num-wrap">
            <div class="rt-day__dot">J4</div>
            <span class="rt-day__label-num">{{ $en ? 'Day 4' : 'Jour 4' }}</span>
          </div>
          <div class="rt-day__body">
            <p class="rt-day__theme">{{ $en ? 'Modules 3 & 4 — Embodied' : 'Modules 3 & 4 — Incarnés' }}</p>
            <h3 class="rt-day__title">{!! $en ? '"<em>Open up.</em>"' : '"<em>S\'ouvrir.</em>"' !!}</h3>
            <p class="rt-day__lead">
              @if($en)
                5:30am. Private boat from the port of Mgarr. Comino island. Blue Lagoon. Turquoise water, absolute silence, forty minutes where no one speaks and everything is already said — module 3 in real life. In the afternoon: Pilates on the villa terrace overlooking the sea, then guided freediving in the pool: the 5-5-5 underwater.
              @else
                5h30. Bateau privatisé depuis le port de Mgarr. Île de Comino. Blue Lagoon. Eau turquoise, silence absolu, quarante minutes où personne ne parle et où tout est dit — le module 3 en vrai. L'après-midi : Pilates sur la terrasse de la villa vue sur mer, puis apnée guidée en piscine : le 5-5-5 sous l'eau.
              @endif
            </p>
            <div class="rt-day__activities">
              <span class="rt-day__act"><span class="rt-day__act-icon">🌅</span>{{ $en ? 'Private boat · Comino · Blue Lagoon (5:30am)' : 'Bateau privatisé · Comino · Blue Lagoon (5h30)' }}</span>
              <span class="rt-day__act"><span class="rt-day__act-icon">🧘</span>{{ $en ? 'Pilates · villa terrace overlooking the sea (60 min)' : 'Pilates · terrasse villa vue sur mer (60 min)' }}</span>
              <span class="rt-day__act"><span class="rt-day__act-icon">🌊</span>{{ $en ? 'Guided freediving in the pool (45 min)' : 'Apnée guidée en piscine (45 min)' }}</span>
              <span class="rt-day__act"><span class="rt-day__act-icon">📷</span>{{ $en ? 'Retreat photographer (candid)' : 'Photographe de retraite (discret)' }}</span>
            </div>
          </div>
        </div>

        {{-- JOUR 5 — MODULE 5 --}}
        <div class="rt-day">
          <div class="rt-day__num-wrap">
            <div class="rt-day__dot">J5</div>
            <span class="rt-day__label-num">{{ $en ? 'Day 5' : 'Jour 5' }}</span>
          </div>
          <div class="rt-day__body">
            <p class="rt-day__theme">{{ $en ? 'Module 5 — Embodied' : 'Module 5 — Incarné' }}</p>
            <h3 class="rt-day__title">{!! $en ? '"<em>Discover the mission.</em>"' : '"<em>Découvrir la mission.</em>"' !!}</h3>
            <p class="rt-day__lead">
              @if($en)
                Dawn on the villa terrace in robes, facing the Gozo sea. Module 5 listened together. The sentence “My presence in the lives of others allows…” resonates differently here, on Day 5, facing this water. Then: horse whispering at the Gozo stables — a horse reads who you truly are, right now. No one cheats with a horse. In the afternoon: writing workshop — each freelance writes their mission sentence alone, in silence, until it is true.
              @else
                Aube en peignoir sur la terrasse de Gozo, face à la mer. Module 5 réécouté ensemble. La phrase « Ma présence dans la vie des autres permet à... » résonne différemment ici, au J5, face à cette eau. Puis : horse whispering dans les écuries de Gozo — un cheval lit qui vous êtes vraiment, maintenant. Personne ne triche avec un cheval. L'après-midi : atelier d'écriture — chaque freelance écrit sa phrase de mission seul, en silence, jusqu'à ce qu'elle soit vraie.
              @endif
            </p>
            <div class="rt-day__activities">
              <span class="rt-day__act"><span class="rt-day__act-icon">🎧</span>{{ $en ? 'Module 5 replay at dawn · Gozo terrace (collective)' : 'Réécoute module 5 à l\'aube · terrasse de Gozo (collectif)' }}</span>
              <span class="rt-day__act"><span class="rt-day__act-icon">🐴</span>{{ $en ? 'Horse whispering · Gozo stables (90 min)' : 'Horse whispering · écuries de Gozo (90 min)' }}</span>
              <span class="rt-day__act"><span class="rt-day__act-icon">✍️</span>{{ $en ? 'Mission sentence writing workshop' : 'Atelier d\'écriture phrase de mission' }}</span>
              <span class="rt-day__act"><span class="rt-day__act-icon">🐎</span>{{ $en ? 'Horseback trail OR quad ride · Gozo roads · your choice (2h)' : 'Balade à cheval OU quad · pistes de Gozo · au choix (2h)' }}</span>
            </div>
          </div>
        </div>

        {{-- JOUR 6 — INTÉGRATION --}}
        <div class="rt-day">
          <div class="rt-day__num-wrap">
            <div class="rt-day__dot">J6</div>
            <span class="rt-day__label-num">{{ $en ? 'Day 6' : 'Jour 6' }}</span>
          </div>
          <div class="rt-day__body">
            <p class="rt-day__theme">{{ $en ? 'Module 6 — Embodied · Integration' : 'Module 6 — Incarné · Intégration' }}</p>
            <h3 class="rt-day__title">{!! $en ? '"<em>Practice the ritual.</em>"' : '"<em>Pratiquer le rituel.</em>"' !!}</h3>
            <p class="rt-day__lead">
              @if($en)
                A day with no fixed schedule. The morning is free: spa, pool, journals — or dive into the creative workshops: watercolour painting facing the sea, marine clay sculpture. Each person integrates at their own pace. In the afternoon: closing ceremony — each Freelance Pause Souffle stands, faces the group and the Gozo sea, and says their mission sentence aloud. Tears are welcome. The ceremony closes with a collective chant rising over the water. Then the gala dinner on the terrace at sunset. Then the rest of your life — differently.
              @else
                Une journée sans programme fixe. Le matin est libre : spa, piscine, carnets — ou plongez dans les ateliers créatifs : aquarelle en plein air face à la mer, sculpture d'argile marine. Chacun intègre à son rythme. L'après-midi : cérémonie de clôture — chaque Freelance Pause Souffle se lève, fait face au groupe et à la mer de Gozo, et dit sa phrase de mission à voix haute. Les larmes sont les bienvenues. La cérémonie se clôt par un chant collectif qui monte sur la mer. Puis le dîner de gala sur la terrasse au coucher du soleil. Puis le reste de votre vie — autrement.
              @endif
            </p>
            <div class="rt-day__activities">
              <span class="rt-day__act"><span class="rt-day__act-icon">♨️</span>{{ $en ? 'Free spa (hammam · jacuzzi · treatment)' : 'Spa libre (hammam · jacuzzi · soin corps)' }}</span>
              <span class="rt-day__act"><span class="rt-day__act-icon">🎨</span>{{ $en ? 'Watercolour painting · outdoor facing the sea' : 'Aquarelle en plein air · face à la mer' }}</span>
              <span class="rt-day__act"><span class="rt-day__act-icon">🗿</span>{{ $en ? 'Marine clay sculpture workshop' : 'Atelier sculpture · argile marine' }}</span>
              <span class="rt-day__act"><span class="rt-day__act-icon">🎤</span>{{ $en ? 'Closing ceremony · Mission sentences aloud' : 'Cérémonie de clôture · Phrases de mission à voix haute' }}</span>
              <span class="rt-day__act"><span class="rt-day__act-icon">🎵</span>{{ $en ? 'Collective chant rising over the sea' : 'Chant collectif qui monte sur la mer' }}</span>
              <span class="rt-day__act"><span class="rt-day__act-icon">🥂</span>{{ $en ? 'Gala dinner · Attestation ceremony' : 'Dîner de gala · Remise des attestations' }}</span>
            </div>
          </div>
        </div>

        {{-- JOUR 7 — ENVOI --}}
        <div class="rt-day">
          <div class="rt-day__num-wrap">
            <div class="rt-day__dot">J7</div>
            <span class="rt-day__label-num">{{ $en ? 'Day 7' : 'Jour 7' }}</span>
          </div>
          <div class="rt-day__body">
            <p class="rt-day__theme">{{ $en ? 'Departure · Sending off' : 'Départ · Envoi' }}</p>
            <h3 class="rt-day__title">{!! $en ? '"<em>Go and carry it.</em>"' : '"<em>Partir et le porter.</em>"' !!}</h3>
            <p class="rt-day__lead">
              @if($en)
                Morning on the Gozo terrace. The final collective breath — facing the sea, for the last time together. Then: the pottery montage screening — the video filmed during your session at the Gozo beach, set to «Vase d’argile» and «Grâce infinie». Hands in the clay. Seven days of transformation in a few minutes of images. Some will cry. That’s expected. A last silence over the water. The booklet is sealed. You leave different — Gozo has given you something. The body now knows.
              @else
                Matinée sur la terrasse de Gozo. Le dernier souffle collectif — face à la mer, pour la dernière fois ensemble. Puis : projection du montage poterie — la vidéo filmée lors de votre session sur la plage de Gozo, sur fond de « Vase d’argile » et « Grâce infinie ». Les mains dans l’argile. Sept jours de transformation en quelques minutes d’images. Certains pleureront. C’est prévu. Un dernier silence face à l’eau. Le livret est scellé. Vous partez différent — Gozo vous a donné quelque chose. Le corps sait maintenant.
              @endif
            </p>
            <div class="rt-day__activities">
              <span class="rt-day__act"><span class="rt-day__act-icon">🌿</span>{{ $en ? 'Final collective breath (dawn)' : 'Dernier souffle collectif (aube)' }}</span>
              <span class="rt-day__act"><span class="rt-day__act-icon">🎥</span>{{ $en ? 'Pottery montage screening · «Vase d’argile» · «Grâce infinie»' : 'Projection montage poterie · « Vase d’argile » · « Grâce infinie »' }}</span>
              <span class="rt-day__act"><span class="rt-day__act-icon">📖</span>{{ $en ? 'Booklet sealing ritual' : 'Rituel de scellement du livret' }}</span>
              <span class="rt-day__act"><span class="rt-day__act-icon">✈️</span>{{ $en ? 'Group departure · Freelance Network activated' : 'Départ du groupe · Réseau Freelance activé' }}</span>
            </div>
          </div>
        </div>

      </div>
      </div>{{-- end prog-mer --}}

      {{-- ═══════════════════════════════════════════════════ --}}
      {{-- PROGRAMME MONTAGNE 7 JOURS                         --}}
      {{-- ═══════════════════════════════════════════════════ --}}
      <div id="prog-montagne" class="rt-prog-panel">
      <div class="rt-timeline">

        {{-- JOUR 1 — ARRIVÉE --}}
        <div class="rt-day">
          <div class="rt-day__num-wrap">
            <div class="rt-day__dot">J1</div>
            <span class="rt-day__label-num">{{ $en ? 'Day 1' : 'Jour 1' }}</span>
          </div>
          <div class="rt-day__body">
            <p class="rt-day__theme">{{ $en ? 'Arrival · Into the Altitude' : 'Arrivée · L\'Altitude' }}</p>
            <h3 class="rt-day__title">{!! $en ? '"<em>Rise.</em>"' : '"<em>Monter.</em>"' !!}</h3>
            <p class="rt-day__lead">
              @if($en)
                No programme displayed on arrival. First act: put down your bags, look at the summit facing you, and do nothing. Ninety minutes of pure silence on the snow. In the evening: the first fire, the opening ritual, hot ceremonial cocoa — and the letter you will carry for seven days.
              @else
                Pas de programme affiché. Premier acte : poser les bagages, regarder le sommet en face, et ne rien faire. Quatre-vingt-dix minutes de silence pur face à la montagne. Le soir : premier feu, rituel d'ouverture, cacao cérémoniel chaud — et la lettre que vous porterez sept jours.
              @endif
            </p>
            <div class="rt-day__activities">
              <span class="rt-day__act"><span class="rt-day__act-icon">🤲</span>{{ $en ? 'Welcome silence facing the summit (1h30)' : 'Silence d\'accueil face au sommet (1h30)' }}</span>
              <span class="rt-day__act"><span class="rt-day__act-icon">🏡</span>{{ $en ? 'Chalet discovery · Free afternoon' : 'Découverte du chalet · Après-midi libre' }}</span>
              <span class="rt-day__act"><span class="rt-day__act-icon">🔥</span>{{ $en ? 'Opening fire ritual + letter to oneself' : 'Rituel du feu d\'ouverture + lettre à soi' }}</span>
              <span class="rt-day__act"><span class="rt-day__act-icon">🍽️</span>{{ $en ? 'Ceremonial cocoa · Gourmet dinner by the fire' : 'Cacao cérémoniel · Dîner gastronomique au coin du feu' }}</span>
            </div>
          </div>
        </div>

        {{-- JOUR 2 — LE BLANC --}}
        <div class="rt-day">
          <div class="rt-day__num-wrap">
            <div class="rt-day__dot">J2</div>
            <span class="rt-day__label-num">{{ $en ? 'Day 2' : 'Jour 2' }}</span>
          </div>
          <div class="rt-day__body">
            <p class="rt-day__theme">{{ $en ? 'Module 1 — Embodied' : 'Module 1 — Incarné' }}</p>
            <h3 class="rt-day__title">{!! $en ? '"<em>Breathe at altitude.</em>"' : '"<em>Respirer en altitude.</em>"' !!}</h3>
            <p class="rt-day__lead">
              @if($en)
                6:30am. Do In on the snow-covered terrace, facing the peaks. The altitude air does what ocean silence does — it strips everything away. Then Pilates and Stretching in the panoramic room. In the afternoon: snowshoe walk in the silent forest. No destination, no performance. Only the white and the breath. In the evening: reflexology by the fire — the body finally lets go.
              @else
                6h30. Do In sur la terrasse enneigée face aux sommets. L'air d'altitude fait ce que le silence de la mer fait — il désosse tout. Puis Pilates et Stretching en salle panoramique. L'après-midi : raquettes en forêt silencieuse — pas de destination, pas de performance. Seulement le blanc et le souffle. Le soir : réflexologie au coin du feu — le corps lâche enfin.
              @endif
            </p>
            <div class="rt-day__activities">
              <span class="rt-day__act"><span class="rt-day__act-icon">🧘</span>{{ $en ? 'Do In on the snowy terrace (1h)' : 'Do In en terrasse enneigée (1h)' }}</span>
              <span class="rt-day__act"><span class="rt-day__act-icon">💪</span>{{ $en ? 'Pilates + Stretching · panoramic room (60 min)' : 'Pilates + Stretching · salle panoramique (60 min)' }}</span>
              <span class="rt-day__act"><span class="rt-day__act-icon">🏔️</span>{{ $en ? 'Silent snowshoe walk in the forest (2h)' : 'Raquettes en forêt silencieuse (2h)' }}</span>
              <span class="rt-day__act"><span class="rt-day__act-icon">🦶</span>{{ $en ? 'Reflexology by the fire (75 min)' : 'Réflexologie au coin du feu (75 min)' }}</span>
              <span class="rt-day__act"><span class="rt-day__act-icon">♨️</span>{{ $en ? 'Nordic bath under the stars' : 'Bain nordique sous les étoiles' }}</span>
            </div>
          </div>
        </div>

        {{-- JOUR 3 — LA BLESSURE --}}
        <div class="rt-day">
          <div class="rt-day__num-wrap">
            <div class="rt-day__dot">J3</div>
            <span class="rt-day__label-num">{{ $en ? 'Day 3' : 'Jour 3' }}</span>
          </div>
          <div class="rt-day__body">
            <p class="rt-day__theme">{{ $en ? 'Module 2 — Embodied' : 'Module 2 — Incarné' }}</p>
            <h3 class="rt-day__title">{!! $en ? '"<em>What the white reveals.</em>"' : '"<em>Ce que le blanc révèle.</em>"' !!}</h3>
            <p class="rt-day__lead">
              @if($en)
                Shiatsu in the morning — deep manual therapy that reaches what the altitude has already started to loosen. In the afternoon: private individual session, the unsaid, the held, the unfinished. Then: pottery workshop in the chalet — hands in the clay, in silence, facing the mountain. A video montage will be created of this session. In the evening: small speaking circles by the fire, followed by collective vocal toning. Then Finnish sauna — the oldest detox on Earth.
              @else
                Shiatsu le matin — thérapie manuelle profonde qui atteint ce que l'altitude a déjà commencé de dénouer. L'après-midi : session individuelle privée, le non-dit, le tenu, l'inachevé. Puis : atelier de poterie dans le chalet — les mains dans l'argile, en silence, face à la montagne. Un montage vidéo sera réalisé sur cette session. Le soir : cercles de parole en petit groupe au coin du feu, suivis d'une tonalisation vocale collective. Puis sauna finlandais — le plus ancien détox du monde.
              @endif
            </p>
            <div class="rt-day__activities">
              <span class="rt-day__act"><span class="rt-day__act-icon">🫁</span>{{ $en ? 'Deep shiatsu (75 min)' : 'Shiatsu profond (75 min)' }}</span>
              <span class="rt-day__act"><span class="rt-day__act-icon">🪑</span>{{ $en ? 'Private individual session (45 min)' : 'Session individuelle privée (45 min)' }}</span>
              <span class="rt-day__act"><span class="rt-day__act-icon">🏺</span>{{ $en ? 'Pottery workshop · chalet facing the mountain (90 min)' : 'Atelier poterie · chalet face à la montagne (90 min)' }}</span>
              <span class="rt-day__act"><span class="rt-day__act-icon">🎵</span>{{ $en ? 'Speaking circle · collective vocal toning' : 'Cercle de parole · tonalisation vocale collective' }}</span>
              <span class="rt-day__act"><span class="rt-day__act-icon">🔥</span>{{ $en ? 'Finnish sauna · steam detox' : 'Sauna finlandais · détox vapeur' }}</span>
            </div>
          </div>
        </div>

        {{-- JOUR 4 — L'IMMENSITÉ --}}
        <div class="rt-day">
          <div class="rt-day__num-wrap">
            <div class="rt-day__dot">J4</div>
            <span class="rt-day__label-num">{{ $en ? 'Day 4' : 'Jour 4' }}</span>
          </div>
          <div class="rt-day__body">
            <p class="rt-day__theme">{{ $en ? 'Modules 3 & 4 — Embodied' : 'Modules 3 & 4 — Incarnés' }}</p>
            <h3 class="rt-day__title">{!! $en ? '"<em>Open up like a peak.</em>"' : '"<em>S\'ouvrir comme un sommet.</em>"' !!}</h3>
            <p class="rt-day__lead">
              @if($en)
                7am. Tai Chi in absolute silence facing the peaks. The mountain teaches what neither words nor screens can — scale, presence, depth. After Pilates in the panoramic room, the afternoon: guided walk to a frozen lake. One hour of motionless contemplation on the ice. Module 3 in real life. In the evening: the collective 5-5-5 breathwork by the fire — like the sea, but differently.
              @else
                7h. Tai Chi en silence absolu face aux sommets. La montagne enseigne ce que ni les mots ni les écrans ne peuvent — l'échelle, la présence, la profondeur. Après Pilates en salle panoramique, l'après-midi : marche guidée vers un lac gelé. Une heure de contemplation immobile sur la glace. Le module 3 en vrai. Le soir : souffle collectif 5-5-5 au coin du feu — comme la mer, mais autrement.
              @endif
            </p>
            <div class="rt-day__activities">
              <span class="rt-day__act"><span class="rt-day__act-icon">🌅</span>{{ $en ? 'Tai Chi in silence facing the peaks (1h)' : 'Tai Chi en silence face aux sommets (1h)' }}</span>
              <span class="rt-day__act"><span class="rt-day__act-icon">💪</span>{{ $en ? 'Pilates · panoramic room (60 min)' : 'Pilates · salle panoramique (60 min)' }}</span>
              <span class="rt-day__act"><span class="rt-day__act-icon">🏔️</span>{{ $en ? 'Guided walk to a frozen lake · 1h contemplation' : 'Marche guidée vers lac gelé · 1h contemplation' }}</span>
              <span class="rt-day__act"><span class="rt-day__act-icon">🫁</span>{{ $en ? 'Collective 5-5-5 breathwork by the fire (evening)' : 'Souffle collectif 5-5-5 au coin du feu (soir)' }}</span>
              <span class="rt-day__act"><span class="rt-day__act-icon">📷</span>{{ $en ? 'Retreat photographer (candid)' : 'Photographe de retraite (discret)' }}</span>
            </div>
          </div>
        </div>

        {{-- JOUR 5 — LA JOURNÉE SKI --}}
        <div class="rt-day">
          <div class="rt-day__num-wrap">
            <div class="rt-day__dot">J5</div>
            <span class="rt-day__label-num">{{ $en ? 'Day 5' : 'Jour 5' }}</span>
          </div>
          <div class="rt-day__body">
            <p class="rt-day__theme">{{ $en ? 'Module 5 — Embodied' : 'Module 5 — Incarné' }}</p>
            <h3 class="rt-day__title">{!! $en ? '"<em>The mission in motion.</em>"' : '"<em>La mission en mouvement.</em>"' !!}</h3>
            <p class="rt-day__lead">
              @if($en)
                The mountain day. Ski or snowboard — all levels, beginner courses available. Lunch at an altitude restaurant, privatised for the group. No agenda, no formation talk. Just the descent, the cold, the speed, the laughter. Back at the chalet: guided Do In muscle recovery (45 min), then Nordic bath, then silence and altitude herbal teas. The body earns what it has integrated.
              @else
                La journée montagne. Ski ou snowboard — tous niveaux, cours débutants disponibles. Déjeuner en altitude dans un restaurant privatisé pour le groupe. Pas de programme, pas de séances. Juste la piste, le froid, la vitesse, le rire. Retour au chalet : Do In de récupération musculaire guidé (45 min), puis bain nordique, puis silence et tisanes d'altitude. Le corps gagne ce qu'il a intégré.
              @endif
            </p>
            <div class="rt-day__activities">
              <span class="rt-day__act"><span class="rt-day__act-icon">⛷️</span>{{ $en ? 'Full ski/snowboard day — all levels' : 'Journée ski / snowboard — tous niveaux' }}</span>
              <span class="rt-day__act"><span class="rt-day__act-icon">🍽️</span>{{ $en ? 'Altitude restaurant (privatised) · group lunch' : 'Restaurant d\'altitude privatisé · déjeuner du groupe' }}</span>
              <span class="rt-day__act"><span class="rt-day__act-icon">🧘</span>{{ $en ? 'Guided Do In muscle recovery (45 min)' : 'Do In de récupération musculaire guidé (45 min)' }}</span>
              <span class="rt-day__act"><span class="rt-day__act-icon">♨️</span>{{ $en ? 'Nordic bath + altitude herbal teas + silence' : 'Bain nordique + tisanes d\'altitude + silence' }}</span>
            </div>
          </div>
        </div>

        {{-- JOUR 6 — INTÉGRATION & CÉRÉMONIE --}}
        <div class="rt-day">
          <div class="rt-day__num-wrap">
            <div class="rt-day__dot">J6</div>
            <span class="rt-day__label-num">{{ $en ? 'Day 6' : 'Jour 6' }}</span>
          </div>
          <div class="rt-day__body">
            <p class="rt-day__theme">{{ $en ? 'Module 6 — Embodied · Integration' : 'Module 6 — Incarné · Intégration' }}</p>
            <h3 class="rt-day__title">{!! $en ? '"<em>Practice the ritual. At last.</em>"' : '"<em>Pratiquer le rituel. Enfin.</em>"' !!}</h3>
            <p class="rt-day__lead">
              @if($en)
                A morning without schedule — the spa is open. Hammam, Finnish sauna, outdoor jacuzzi with a view of the peaks. Or: watercolour painting facing the summits, mountain clay sculpture workshop. Each person integrates at their own pace. In the afternoon: closing ceremony — each Freelance Pause Souffle stands, faces the group and the mountains, and says their mission sentence aloud. The ceremony closes with a collective chant under the peaks — voices rising into the altitude. Then the gala dinner. Then the last fire. Then the closing hug — the Pause Souffle signature.
              @else
                Matinée sans programme — le spa est ouvert. Hammam, sauna finlandais, jacuzzi extérieur vue sur les sommets. Ou : aquarelle face aux sommets, atelier sculpture d'argile de montagne. Chacun intègre à son rythme. L'après-midi : cérémonie de clôture — chaque Freelance Pause Souffle se lève, fait face au groupe et à la montagne, et dit sa phrase de mission à voix haute. La cérémonie se clôt par un chant collectif sous les sommets — les voix qui montent dans l'altitude. Puis le dîner de gala. Puis le dernier feu. Puis le câlin de clôture — la signature Pause Souffle.
              @endif
            </p>
            <div class="rt-day__activities">
              <span class="rt-day__act"><span class="rt-day__act-icon">♨️</span>{{ $en ? 'Free spa · hammam · Finnish sauna · jacuzzi with mountain view' : 'Spa libre · hammam · sauna finlandais · jacuzzi vue sommets' }}</span>
              <span class="rt-day__act"><span class="rt-day__act-icon">🎨</span>{{ $en ? 'Watercolour painting · facing the summits' : 'Aquarelle · face aux sommets' }}</span>
              <span class="rt-day__act"><span class="rt-day__act-icon">🗿</span>{{ $en ? 'Mountain clay sculpture workshop' : 'Atelier sculpture · argile de montagne' }}</span>
              <span class="rt-day__act"><span class="rt-day__act-icon">🎤</span>{{ $en ? 'Closing ceremony · Mission sentences aloud · Attestation ceremony' : 'Cérémonie de clôture · Phrases de mission à voix haute · Remise des attestations' }}</span>
              <span class="rt-day__act"><span class="rt-day__act-icon">🎵</span>{{ $en ? 'Collective chant under the peaks' : 'Chant collectif sous les sommets' }}</span>
              <span class="rt-day__act"><span class="rt-day__act-icon">🥂</span>{{ $en ? 'Gala dinner · long table · last fire' : 'Dîner de gala · table longue · dernier feu' }}</span>
              <span class="rt-day__act"><span class="rt-day__act-icon">🤗</span>{{ $en ? 'Closing hug — the Pause Souffle signature' : 'Câlin de clôture — la signature Pause Souffle' }}</span>
            </div>
          </div>
        </div>

        {{-- JOUR 7 — L'ENVOI BLANC --}}
        <div class="rt-day">
          <div class="rt-day__num-wrap">
            <div class="rt-day__dot">J7</div>
            <span class="rt-day__label-num">{{ $en ? 'Day 7' : 'Jour 7' }}</span>
          </div>
          <div class="rt-day__body">
            <p class="rt-day__theme">{{ $en ? 'Departure · The White Sending' : 'Départ · L\'Envoi Blanc' }}</p>
            <h3 class="rt-day__title">{!! $en ? '"<em>Go and carry the heights.</em>"' : '"<em>Partir et porter les hauteurs.</em>"' !!}</h3>
            <p class="rt-day__lead">
              @if($en)
                Dawn. Last collective breath facing the peaks. Then: the pottery montage screening — the video filmed during your chalet session, set to «Vase d’argile» and «Grâce infinie». Hands in the clay, the mountain behind, seven days of transformation in a few minutes of images. One last moment on the snow, in silence, before the world calls you back. The booklet is sealed in the cold. You leave different — not because you pushed yourself, but because the body holds what it lived. The heights stay with you.
              @else
                Aube. Dernier souffle collectif face aux sommets. Puis : projection du montage poterie — la vidéo filmée lors de votre session dans le chalet, sur fond de « Vase d’argile » et « Grâce infinie ». Les mains dans l’argile, la montagne en fond, sept jours de transformation en quelques minutes d’images. Un dernier moment sur la neige, en silence, avant que le monde ne vous rappelle. Le livret est scellé dans le froid. Vous partez différent — pas parce que vous vous êtes forcé, mais parce que le corps porte ce qu’il a vécu. Les hauteurs restent en vous.
              @endif
            </p>
            <div class="rt-day__activities">
              <span class="rt-day__act"><span class="rt-day__act-icon">🌄</span>{{ $en ? 'Final collective breath facing the peaks (dawn)' : 'Dernier souffle collectif face aux sommets (aube)' }}</span>
              <span class="rt-day__act"><span class="rt-day__act-icon">🎥</span>{{ $en ? 'Pottery montage screening · «Vase d’argile» · «Grâce infinie»' : 'Projection montage poterie · « Vase d’argile » · « Grâce infinie »' }}</span>
              <span class="rt-day__act"><span class="rt-day__act-icon">📖</span>{{ $en ? 'Booklet sealing ritual in the snow' : 'Rituel de scellement du livret dans la neige' }}</span>
              <span class="rt-day__act"><span class="rt-day__act-icon">✈️</span>{{ $en ? 'Group departure · Freelance Network activated' : 'Départ du groupe · Réseau Freelance activé' }}</span>
            </div>
          </div>
        </div>

      </div>
      </div>{{-- end prog-montagne --}}

      <script>
        document.addEventListener('DOMContentLoaded', function() {
          document.querySelectorAll('.rt-prog-tab').forEach(function(tab) {
            tab.addEventListener('click', function() {
              document.querySelectorAll('.rt-prog-tab').forEach(function(t) { t.classList.remove('rt-prog-tab--active'); });
              document.querySelectorAll('.rt-prog-panel').forEach(function(p) { p.classList.remove('rt-prog-panel--visible'); });
              tab.classList.add('rt-prog-tab--active');
              document.getElementById(tab.getAttribute('data-target')).classList.add('rt-prog-panel--visible');
            });
          });
        });
      </script>

    </div>
  </section>

  {{-- ═══════════════════════════════════════════════════════ --}}
  {{-- LES 6 ACTIVITÉS SIGNATURE                              --}}
  {{-- ═══════════════════════════════════════════════════════ --}}
  <section class="rt-section">
    <div class="rt-section__inner">
      <p class="rt-section__eyebrow">{{ $en ? 'Signature experiences' : 'Expériences signature' }}</p>
      <h2 class="rt-section__title">
        @if($en)
          Six practices.<br><em>Zero decoration.</em>
        @else
          Six pratiques.<br><em>Zéro décoration.</em>
        @endif
      </h2>
      <p class="rt-section__lead">
        @if($en)
          None of these activities was chosen for the Instagram photo. Each one was chosen because it produces a precise physiological or emotional effect — in direct continuity with the formation.
        @else
          Aucune de ces activités n'a été choisie pour la photo Instagram. Chacune a été choisie parce qu'elle produit un effet physiologique ou émotionnel précis — en continuité directe avec la formation.
        @endif
      </p>

      <div class="rt-act-grid">

        <div class="rt-act-card">
          <div class="rt-act-card__header">
            <div class="rt-act-card__icon-wrap">🦶</div>
            <div>
              <p class="rt-act-card__title">{{ $en ? 'Reflexology' : 'Réflexologie plantaire' }}</p>
              <p class="rt-act-card__subtitle">{{ $en ? 'The body before the head' : 'Le corps avant la tête' }}</p>
            </div>
          </div>
          <p class="rt-act-card__body">
            @if($en)
              Practiced outdoors, facing the garden. The practitioner gently works the feet in 75-minute sessions. Sometimes tears come without warning. The body lets go of what the mind was keeping behind glass.
            @else
              Pratiquée en plein air, face au jardin. Le praticien travaille les pieds en douceur, 75 minutes. Parfois des larmes arrivent sans prévenir. Le corps lâche ce que l'esprit gardait derrière une vitre.
            @endif
          </p>
          <span class="rt-act-card__tag">{{ $en ? 'Day 1 · Afternoon' : 'Jour 1 · Après-midi' }}</span>
        </div>

        <div class="rt-act-card">
          <div class="rt-act-card__header">
            <div class="rt-act-card__icon-wrap">🌅</div>
            <div>
              <p class="rt-act-card__title">{{ $en ? 'Sunrise at the Blue Lagoon' : 'Blue Lagoon au lever du soleil' }}</p>
              <p class="rt-act-card__subtitle">{{ $en ? 'Being carried' : 'Se laisser porter' }}</p>
            </div>
          </div>
          <p class="rt-act-card__body">
            @if($en)
              5:30am. Private boat. Turquoise water. Absolute silence. Forty minutes where no one speaks and everything is already said. Module 3 in real life — "what truly nourishes you."
            @else
              5h30. Bateau privatisé. Eau turquoise. Silence absolu. Quarante minutes où personne ne parle et où tout est déjà dit. Le module 3 en vrai — « ce qui vous nourrit vraiment ».
            @endif
          </p>
          <span class="rt-act-card__tag">{{ $en ? 'Day 2 · Dawn' : 'Jour 2 · Aube' }}</span>
        </div>

        <div class="rt-act-card">
          <div class="rt-act-card__header">
            <div class="rt-act-card__icon-wrap">🫁</div>
            <div>
              <p class="rt-act-card__title">{{ $en ? 'Shiatsu + Pilates' : 'Shiatsu + Pilates' }}</p>
              <p class="rt-act-card__subtitle">{{ $en ? 'Vagus nerve in action' : 'Le nerf vague en action' }}</p>
            </div>
          </div>
          <p class="rt-act-card__body">
            @if($en)
              Pilates then immediately Shiatsu — the two combined activate the vagus nerve in a way that module 4 explained in words. Here, the body verifies it. No more metaphor.
            @else
              Pilates puis directement Shiatsu — les deux combinés activent le nerf vague de la façon que le module 4 a expliquée en mots. Ici, le corps le vérifie. Plus de métaphore.
            @endif
          </p>
          <span class="rt-act-card__tag">{{ $en ? 'Day 2 · Afternoon' : 'Jour 2 · Après-midi' }}</span>
        </div>

        <div class="rt-act-card">
          <div class="rt-act-card__header">
            <div class="rt-act-card__icon-wrap">🌊</div>
            <div>
              <p class="rt-act-card__title">{{ $en ? 'Guided Freediving' : 'Apnée guidée' }}</p>
              <p class="rt-act-card__subtitle">{{ $en ? 'The 5-5-5 in water' : 'Le 5-5-5 dans l\'eau' }}</p>
            </div>
          </div>
          <p class="rt-act-card__body">
            @if($en)
              Underwater, motionless, in total silence — only the breath as a tool. What the formation said in theory becomes a lived, undeniable truth. 45 minutes that change the relationship with your own breath forever.
            @else
              Sous l'eau, immobile, en silence total — seul le souffle comme outil. Ce que la formation a dit en théorie devient une vérité vécue, indiscutable. 45 minutes qui changent le rapport au souffle pour toujours.
            @endif
          </p>
          <span class="rt-act-card__tag">{{ $en ? 'Day 2 · Evening' : 'Jour 2 · Soirée' }}</span>
        </div>

        <div class="rt-act-card">
          <div class="rt-act-card__header">
            <div class="rt-act-card__icon-wrap">🐴</div>
            <div>
              <p class="rt-act-card__title">{{ $en ? 'Horse Whispering' : 'Horse Whispering' }}</p>
              <p class="rt-act-card__subtitle">{{ $en ? 'The mirror of the soul' : 'Le miroir de l\'âme' }}</p>
            </div>
          </div>
          <p class="rt-act-card__body">
            @if($en)
              A horse, an instructor, no riding. The horse reads your inner state and responds to it — calm or agitation, presence or absence. No one cheats with a horse. It shows who you are, right now, instantly.
            @else
              Un cheval, un instructeur, pas de monte à cheval. Le cheval lit votre état intérieur et y répond — calme ou agitation, présence ou absence. Personne ne triche avec un cheval. Il montre qui vous êtes, maintenant, instantanément.
            @endif
          </p>
          <span class="rt-act-card__tag">{{ $en ? 'Day 5 · Morning' : 'Jour 5 · Matin' }}</span>
        </div>

        <div class="rt-act-card">
          <div class="rt-act-card__header">
            <div class="rt-act-card__icon-wrap">🔥</div>
            <div>
              <p class="rt-act-card__title">{{ $en ? 'Fire Ritual' : 'Rituel du Feu' }}</p>
              <p class="rt-act-card__subtitle">{{ $en ? 'The wound released' : 'La blessure libérée' }}</p>
            </div>
          </div>
          <p class="rt-act-card__body">
            @if($en)
              Evening of Day 1. Candles, no screens, ambient piano. Each participant writes on a sheet what they no longer want to carry. The sheet goes into the fire. Then the letter from module 2 — read aloud, if you wish. No one is forced. No one forgets it.
            @else
              Soirée du Jour 1. Bougies, pas d'écrans, piano ambient. Chaque participant écrit sur une feuille ce qu'il ne veut plus porter. La feuille part dans le feu. Puis la lettre du module 2 — lue à voix haute, si l'on veut. Personne n'est obligé. Personne ne l'oublie.
            @endif
          </p>
          <span class="rt-act-card__tag">{{ $en ? 'Day 1 · Evening' : 'Jour 1 · Soirée' }}</span>
        </div>

      </div>
    </div>
  </section>

  {{-- ═══════════════════════════════════════════════════════ --}}
  {{-- CE QUI EST INCLUS                                       --}}
  {{-- ═══════════════════════════════════════════════════════ --}}
  <section class="rt-section rt-section--alt">
    <div class="rt-section__inner">
      <p class="rt-section__eyebrow">{{ $en ? 'What is included' : 'Ce qui est inclus' }}</p>
      <h2 class="rt-section__title">
        @if($en)
          <em>Everything.</em> Without exception.
        @else
          <em>Tout.</em> Sans exception.
        @endif
      </h2>
      <p class="rt-section__lead">
        @if($en)
          When you arrive, you only think about one thing: being here. Not about organising, not about coordinating. Everything has been taken care of.
        @else
          Quand vous arrivez, vous n'avez qu'une chose en tête : être là. Pas organiser, pas coordonner. Tout a été pensé.
        @endif
      </p>

      <div class="rt-inclus-grid">
        <div class="rt-inclus-item">
          <span class="rt-inclus-item__icon">🏡</span>
          <div>
            <p class="rt-inclus-item__title">{{ $en ? 'Exclusive Villa' : 'Villa exclusive' }}</p>
            <p class="rt-inclus-item__body">{{ $en ? 'Entire private villa for the group — infinity pool, garden, panoramic view.' : 'Villa privée entière pour le groupe — piscine à débordement, jardin, vue panoramique.' }}</p>
          </div>
        </div>
        <div class="rt-inclus-item">
          <span class="rt-inclus-item__icon">♨️</span>
          <div>
            <p class="rt-inclus-item__title">{{ $en ? 'Integrated spa' : 'Spa intégré' }}</p>
            <p class="rt-inclus-item__body">{{ $en ? 'Hammam, jacuzzi, body treatment. Two sessions included, on Day 1 and Day 6.' : 'Hammam, jacuzzi, soin corps. Deux séances incluses, Jour 1 et Jour 6.' }}</p>
          </div>
        </div>
        <div class="rt-inclus-item">
          <span class="rt-inclus-item__icon">🍽️</span>
          <div>
            <p class="rt-inclus-item__title">{{ $en ? 'Full meals' : 'Repas complets' }}</p>
            <p class="rt-inclus-item__body">{{ $en ? 'Chef on site. Slow, local, seasonal cuisine. All meals included, including the gala dinner.' : 'Chef sur place. Cuisine lente, locale, de saison. Tous les repas inclus, dont le dîner de gala.' }}</p>
          </div>
        </div>
        <div class="rt-inclus-item">
          <span class="rt-inclus-item__icon">📖</span>
          <div>
            <p class="rt-inclus-item__title">{{ $en ? 'The Retreat Journal' : 'Le Livret de Retraite' }}</p>
            <p class="rt-inclus-item__body">{{ $en ? 'A 12-page printed booklet — programme, reflection questions, blank pages for your carnet. A physical trace that lasts.' : 'Un livret imprimé de 12 pages — programme, questions de réflexion, pages vierges pour votre carnet. Une trace physique qui dure.' }}</p>
          </div>
        </div>
        <div class="rt-inclus-item">
          <span class="rt-inclus-item__icon">📷</span>
          <div>
            <p class="rt-inclus-item__title">{{ $en ? 'Retreat photographer' : 'Photographe de retraite' }}</p>
            <p class="rt-inclus-item__body">{{ $en ? 'A professional present discreetly on Day 4. Photos delivered 72 hours later. No selfie. Only moments.' : 'Un professionnel présent discrètement au Jour 4. Photos livrées 72h après. Pas de selfie. Seulement des moments.' }}</p>
          </div>
        </div>
        <div class="rt-inclus-item">
          <span class="rt-inclus-item__icon">🎓</span>
          <div>
            <p class="rt-inclus-item__title">{{ $en ? 'Attestation ceremony' : 'Cérémonie d\'attestation' }}</p>
            <p class="rt-inclus-item__body">{{ $en ? 'Official physical attestation Pause Souffle Freelance — remitted during the gala dinner, in front of the group.' : 'Attestation physique officielle Freelance Pause Souffle — remise lors du dîner de gala, devant le groupe.' }}</p>
          </div>
        </div>
        <div class="rt-inclus-item">
          <span class="rt-inclus-item__icon">🚤</span>
          <div>
            <p class="rt-inclus-item__title">{{ $en ? 'Private boat · Secret spot' : 'Bateau privatisé · Spot secret' }}</p>
            <p class="rt-inclus-item__body">{{ $en ? 'Sunrise departure. Private boat for the group. Turquoise water. Absolute silence. Secret spot chosen for the destination.' : 'Départ au lever du soleil. Bateau privatisé pour le groupe. Eau turquoise. Silence absolu. Spot secret choisi selon la destination.' }}</p>
          </div>
        </div>
        <div class="rt-inclus-item">
          <span class="rt-inclus-item__icon">🤝</span>
          <div>
            <p class="rt-inclus-item__title">{{ $en ? 'Practitioner network' : 'Réseau des praticiens' }}</p>
            <p class="rt-inclus-item__body">{{ $en ? 'Membership in the community of Pause Souffle Practitioners. Private circle, ongoing support, shared resources.' : 'Intégration dans la communauté des Praticiens Pause Souffle. Cercle privé, soutien continu, ressources partagées.' }}</p>
          </div>
        </div>
        <div class="rt-inclus-item">
          <span class="rt-inclus-item__icon">✈️</span>
          <div>
            <p class="rt-inclus-item__title">{{ $en ? 'Return flight included' : 'Vol aller-retour inclus' }}</p>
            <p class="rt-inclus-item__body">{{ $en ? 'Organised by our Junspro team. Your ticket is delivered to you. Nothing left to manage.' : 'Organisé par notre équipe Junspro. Votre billet vous est livré. Plus rien à gérer.' }}</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  {{-- ═══════════════════════════════════════════════════════ --}}
  {{-- POUR QUI                                                --}}
  {{-- ═══════════════════════════════════════════════════════ --}}
  <section class="rt-section">
    <div class="rt-section__inner">
      <p class="rt-section__eyebrow">{{ $en ? 'Who is this for' : 'Pour qui' }}</p>
      <h2 class="rt-section__title" style="margin-bottom: 3rem;">
        @if($en)
          Not for everyone.<br><em>For you</em>, if…
        @else
          Pas pour tout le monde.<br><em>Pour vous</em>, si…
        @endif
      </h2>

      <div class="rt-pourqui">
        <h3 class="rt-pourqui__title">
          @if($en)
            You are ready for the retreat if…
          @else
            Vous êtes prêt pour la retraite si…
          @endif
        </h3>
        <ul class="rt-pourqui__list">
          @if($en)
            <li>You have completed the Pause Souffle formation and hold the practitioner attestation</li>
            <li>You felt something shift during the six modules — and you want to go further</li>
            <li>You are ready to step out of your daily environment for seven full days</li>
            <li>You want to meet people who have lived the same interior journey as you</li>
            <li>You believe that what you have understood deserves to be fully embodied — not just understood</li>
            <li>You are ready to say your mission sentence out loud, in front of others, facing the sea</li>
          @else
            <li>Vous avez complété la formation Pause Souffle et portez l'attestation de praticien</li>
            <li>Vous avez senti quelque chose se transformer pendant les six modules — et vous voulez aller plus loin</li>
            <li>Vous êtes prêt à sortir de votre quotidien pendant sept jours entiers</li>
            <li>Vous voulez rencontrer des personnes qui ont vécu le même voyage intérieur que vous</li>
            <li>Vous croyez que ce que vous avez compris mérite d'être pleinement incarné — pas seulement compris</li>
            <li>Vous êtes prêt à dire votre phrase de mission à voix haute, devant les autres, face à la mer</li>
          @endif
        </ul>
        <p class="rt-pourqui__note">
          @if($en)
            The retreat is not open to the general public. It is open to anyone who has completed the Pause Souffle online programme.
          @else
            La retraite n'est pas ouverte au grand public. Elle est ouverte à toute personne ayant complété la formation en ligne Pause Souffle.
          @endif
        </p>
      </div>
    </div>
  </section>

  {{-- ═══════════════════════════════════════════════════════ --}}
  {{-- CALENDRIER ÉDITIONS + LISTE D'ATTENTE PRIORITAIRE      --}}
  {{-- ═══════════════════════════════════════════════════════ --}}
  <section id="editions" class="rt-section rt-section--alt">
    <div class="rt-section__inner" style="text-align:center;">
      <p class="rt-section__eyebrow">{{ $en ? 'Next editions' : 'Prochaines éditions' }}</p>
      <h2 class="rt-section__title" style="margin-bottom:.8rem;">
        @if($en)
          <em>The demand</em><br>creates the editions.
        @else
          La <em>demande</em><br>crée les éditions.
        @endif
      </h2>
      <p style="color:var(--rt-muted); font-size:1rem; line-height:1.75; max-width:560px; margin:0 auto 2.5rem;">
        @if($en)
          3 to 4 retreats per year — each one confirmed when the waitlist exceeds 30 participants.<br>The demand drives the offer. Not the other way around.
        @else
          3 à 4 retraites par an — chacune confirmée quand la liste d'attente dépasse 30 participants.<br>La demande pilote l'offre. Pas l'inverse.
        @endif
      </p>

      {{-- Grille des prochaines éditions --}}
      <div class="rt-editions-grid">
        <div class="rt-edition-card rt-edition-card--open">
          <p class="rt-edition-card__season">{{ $en ? 'Spring 2026' : 'Printemps 2026' }}</p>
          <p class="rt-edition-card__date">{{ $en ? 'May · June' : 'Mai · Juin' }}</p>
          <p class="rt-edition-card__dest">{{ $en ? 'Mediterranean — destination TBA' : 'Méditerranée — destination à confirmer' }}</p>
          <span class="rt-edition-card__status rt-edition-card__status--waiting">
            {{ $en ? '⏳ Waitlist open' : '⏳ Liste d\'attente ouverte' }}
          </span>
        </div>
        <div class="rt-edition-card">
          <p class="rt-edition-card__season">{{ $en ? 'Summer 2026' : 'Été 2026' }}</p>
          <p class="rt-edition-card__date">{{ $en ? 'September · October' : 'Septembre · Octobre' }}</p>
          <p class="rt-edition-card__dest">{{ $en ? 'Mediterranean — destination TBA' : 'Méditerranée — destination à confirmer' }}</p>
          <span class="rt-edition-card__status rt-edition-card__status--waiting">
            {{ $en ? '⏳ Waitlist open' : '⏳ Liste d\'attente ouverte' }}
          </span>
        </div>
        <div class="rt-edition-card">
          <p class="rt-edition-card__season">{{ $en ? 'Winter 2026' : 'Hiver 2026' }}</p>
          <p class="rt-edition-card__date">{{ $en ? 'November · December' : 'Novembre · Décembre' }}</p>
          <p class="rt-edition-card__dest">{{ $en ? 'Mediterranean — destination TBA' : 'Méditerranée — destination à confirmer' }}</p>
          <span class="rt-edition-card__status rt-edition-card__status--waiting">
            {{ $en ? '⏳ Waitlist open' : '⏳ Liste d\'attente ouverte' }}
          </span>
        </div>
      </div>

      {{-- Compteur + formulaire liste d'attente --}}
      <div class="rt-waitlist">

        {{-- Compteur --}}
        <div class="rt-waitlist__counter">
          <span class="rt-waitlist__num" id="waitlist-count">17</span>
          <div class="rt-waitlist__counter-text">
            <strong>{{ $en ? 'participants on the waitlist' : 'participants sur la liste d\'attente' }}</strong>
            <span>{{ $en ? 'Only 13 more to confirm the Spring edition' : 'Plus que 13 pour confirmer l\'édition Printemps' }}</span>
          </div>
        </div>

        {{-- Règle --}}
        <div class="rt-waitlist__rule">
          <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="flex-shrink:0; margin-top:1px;"><circle cx="12" cy="12" r="10"/><path d="M12 8v4m0 4h.01"/></svg>
          @if($en)
            When the waitlist reaches 30 participants, an edition is officially confirmed. Priority members receive a private notification 48h before public opening.
          @else
            Quand la liste atteint 30 participants, une édition est officiellement confirmée. Les membres prioritaires reçoivent une notification privée 48h avant l'ouverture publique.
          @endif
        </div>

        {{-- Avantages --}}
        <div class="rt-waitlist__perks">
          <span class="rt-waitlist__perk">{{ $en ? 'Priority access 48h before public' : 'Accès prioritaire 48h avant le public' }}</span>
          <span class="rt-waitlist__perk">{{ $en ? 'Reserved early-bird rate' : 'Tarif early-bird réservé' }}</span>
          <span class="rt-waitlist__perk">{{ $en ? 'First choice of edition' : 'Choix de l\'édition en premier' }}</span>
          <span class="rt-waitlist__perk">{{ $en ? 'No commitment' : 'Aucun engagement' }}</span>
        </div>

        {{-- Formulaire d'inscription --}}
        <div class="rt-waitlist__form" id="waitlist-form-wrap">
          <p class="rt-waitlist__form-title">
            {{ $en ? 'Join the priority waitlist' : 'Rejoindre la liste d\'attente prioritaire' }}
          </p>
          <form id="waitlist-form" onsubmit="submitWaitlist(event)">
            @csrf
            <div class="rt-waitlist__fields">
              <input type="text" name="first_name" placeholder="{{ $en ? 'First name' : 'Prénom' }}" class="rt-waitlist__input" required>
              <input type="email" name="email" placeholder="{{ $en ? 'Email address' : 'Adresse email' }}" class="rt-waitlist__input" required>
            </div>
            <select name="edition" class="rt-waitlist__select" required>
              <option value="">{{ $en ? 'Preferred edition' : 'Édition souhaitée' }}</option>
              <option value="printemps-2026">{{ $en ? 'Spring 2026 — May / June' : 'Printemps 2026 — Mai / Juin' }}</option>
              <option value="ete-2026">{{ $en ? 'Summer 2026 — Sep / Oct' : 'Été 2026 — Sep / Oct' }}</option>
              <option value="hiver-2026">{{ $en ? 'Winter 2026 — Nov / Dec' : 'Hiver 2026 — Nov / Déc' }}</option>
              <option value="any">{{ $en ? 'Any — first available' : 'Peu importe — première disponible' }}</option>
            </select>
            <button type="submit" class="rt-waitlist__btn" id="waitlist-submit">
              {{ $en ? '→ Join the waitlist' : '→ Rejoindre la liste d\'attente' }}
            </button>
            <p style="font-size:.72rem; color:var(--rt-muted); margin-top:.8rem; text-align:center;">
              {{ $en ? 'No commitment · Confidential · Unsubscribe at any time' : 'Aucun engagement · Confidentiel · Désinscription à tout moment' }}
            </p>
          </form>
          <div class="rt-waitlist__success" id="waitlist-success">
            <svg width="44" height="44" fill="none" stroke="#10b981" stroke-width="1.5" viewBox="0 0 24 24" style="display:block; margin:0 auto 1rem;"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            <p class="main">{{ $en ? 'You are on the list.' : 'Vous êtes sur la liste.' }}</p>
            <p style="color:var(--rt-muted); font-size:.9rem;">
              {{ $en ? 'You will receive a priority notification when the next edition is confirmed.' : 'Vous recevrez une notification prioritaire dès que la prochaine édition sera confirmée.' }}
            </p>
          </div>
        </div>

      </div>{{-- /.rt-waitlist --}}
    </div>
  </section>

  {{-- ═══════════════════════════════════════════════════════ --}}
  {{-- PLACES LIMITÉES + CTA FINAL                            --}}
  {{-- ═══════════════════════════════════════════════════════ --}}
  <section class="rt-cta-final">
    <div class="rt-cta-final__backdrop"></div>
    <div class="rt-cta-final__inner">

      <div class="rt-places">
        <div class="rt-places__badge">
          <span class="rt-places__num">12</span>
          <div class="rt-places__text">
            <strong>{{ $en ? 'places only' : 'places seulement' }}</strong>
            {{ $en ? 'per edition · 3 to 4 per year' : 'par édition · 3 à 4 par an' }}
          </div>
        </div>
      </div>

      <h2 class="rt-cta-final__title">
        @if($en)
          <em>Twelve people.</em><br>One year. One life-changing week.
        @else
          <em>Douze personnes.</em><br>Un an. Une semaine qui change une vie.
        @endif
      </h2>

      <p class="rt-cta-final__sub">
        @if($en)
          Each edition is born from real demand — when 30 participants join the waitlist, a new retreat is confirmed. Carefully prepared. With the right people. In the right place. At the right time.
        @else
          Chaque édition naît d'une demande réelle — quand 30 participants rejoignent la liste d'attente, une nouvelle retraite est confirmée. Soigneusement préparée. Avec les bonnes personnes. Au bon endroit. Au bon moment.
        @endif
      </p>

      <div class="rt-sep"></div>

      <p style="font-family: Georgia, serif; font-size: clamp(1.1rem,3vw,1.4rem); color: #fff; font-style: italic; line-height: 1.6; margin-bottom: 2.5rem;">
        @if($en)
          "You have stopped.<br>You have looked.<br>You have listened.<br>Now you <em>carry it</em>."
        @else
          « Vous vous êtes arrêté.<br>Vous avez regardé.<br>Vous avez écouté.<br>Maintenant vous <em>le portez</em>. »
        @endif
      </p>

      <div class="rt-hero__cta-wrap">
        <a href="{{ route('presence.formation-praticien') }}" class="rt-btn-primary" style="font-size:.95rem; padding: 1.1rem 2.6rem;">
          {{ $en ? 'Reserve my place for the retreat →' : 'Réserver ma place pour la retraite →' }}
        </a>
        <a href="{{ route('presence.retraite.livret') }}" class="rt-btn-ghost" style="font-size:.88rem; padding: .9rem 2rem; margin-top:.75rem; display:inline-flex; align-items:center; gap:.5rem;">
          <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M12 20h9"/><path d="M16.5 3.5a2.121 2.121 0 013 3L7 19l-4 1 1-4 12.5-12.5z"/></svg>
          {{ $en ? 'View / Print the booklet' : 'Voir / Imprimer le livret' }}
        </a>
      </div>

      <p style="font-size:.75rem; color:var(--rt-muted); margin-top:1.5rem; letter-spacing:.04em;">
        @if($en)
          For those who completed the Pause Souffle programme · Retreat open to all alumni
        @else
          Pour les participants ayant complété la formation Pause Souffle · Retraite ouverte à tous les alumni
        @endif
      </p>
    </div>
  </section>

</div>
@endsection

@push('scripts')
<script>
async function submitWaitlist(e) {
  e.preventDefault();
  const btn    = document.getElementById('waitlist-submit');
  const form   = document.getElementById('waitlist-form');
  const token  = document.querySelector('#waitlist-form [name=_token]').value;
  btn.disabled = true;
  btn.textContent = '…';

  try {
    const resp = await fetch('{{ route("presence.retraite.waitlist") }}', {
      method: 'POST',
      headers: {
        'X-CSRF-TOKEN': token,
        'Content-Type': 'application/json',
        'Accept':       'application/json',
      },
      body: JSON.stringify(Object.fromEntries(new FormData(form))),
    });

    if (resp.ok) {
      form.style.display = 'none';
      document.getElementById('waitlist-success').style.display = 'block';
      const cnt = document.getElementById('waitlist-count');
      if (cnt) cnt.textContent = parseInt(cnt.textContent) + 1;
    } else {
      btn.disabled = false;
      btn.textContent = '{{ $en ? "→ Join the waitlist" : "→ Rejoindre la liste d\'attente" }}';
    }
  } catch (err) {
    btn.disabled = false;
    btn.textContent = '{{ $en ? "→ Join the waitlist" : "→ Rejoindre la liste d\'attente" }}';
  }
}
</script>
@endpush
