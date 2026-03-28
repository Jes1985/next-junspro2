@extends('frontend.layout')

@section('pageHeading', $moduleTitle)

@php
  $spaceKey = $spaceKey ?? 'praticien';
  $spaceLabel = $spaceLabel ?? 'Espace Formation Pause Souffle';
  $dashboardRouteName = $dashboardRouteName ?? 'formation.dashboard';
  $moduleShowRouteName = $moduleShowRouteName ?? 'formation.module.show';
  $activityCompleteRouteName = $activityCompleteRouteName ?? 'praticien.activity.complete';
  $activityNotesRouteName = $activityNotesRouteName ?? 'praticien.activity.notes';
  $moduleCompleteRouteName = $moduleCompleteRouteName ?? 'praticien.module.complete';
  $modulePdfRouteName = $modulePdfRouteName ?? 'praticien.module.pdf';
  $showEndOfParcoursSection = $showEndOfParcoursSection ?? false;
@endphp

@section('style')
<style>
/* ══════════════════════════════════════════════════════
  MODULE PAGE — PARCOURS / PRATICIEN PAUSE SOUFFLE
   Design: dark/gold, typographie contemplative
   ══════════════════════════════════════════════════════ */
:root {
  --gold:    #c9a84c;
  --gold-l:  #e8d17a;
  --gold-dim: rgba(201,168,76,.15);
  --dark:    #0a0a0a;
  --surf:    #141414;
  --surf2:   #1e1e1e;
  --border:  rgba(201,168,76,.18);
  --text:    #e8e0d0;
  --muted:   rgba(232,224,208,.5);
  --green:   #22c55e;
  --green-dim: rgba(34,197,94,.12);
}

body { background: var(--dark); color: var(--text); }

/* ── Navigation haut ── */
.mod-nav {
  display: flex; align-items: center; justify-content: space-between;
  padding: 1rem 2rem;
  border-bottom: 1px solid var(--border);
  background: var(--surf);
  position: sticky; top: 0; z-index: 50;
}
.mod-nav__back {
  display: flex; align-items: center; gap: .5rem;
  color: var(--muted); font-size: .82rem; text-decoration: none;
  transition: color .2s;
}
.mod-nav__back:hover { color: var(--text); }
.mod-nav__title {
  font-size: .85rem; font-weight: 600; color: var(--gold);
  text-align: center; flex: 1; padding: 0 1rem;
}
.mod-nav__progress {
  font-size: .78rem; color: var(--muted); white-space: nowrap;
}

/* ── Hero du module ── */
.mod-hero {
  background: linear-gradient(135deg, #120c00 0%, #0a0a0a 60%, #080812 100%);
  border-bottom: 1px solid var(--border);
  padding: 3rem 2rem 2.5rem;
  text-align: center;
}
.mod-hero__eyebrow {
  font-size: .72rem; letter-spacing: .18em; text-transform: uppercase;
  color: var(--gold); margin-bottom: .8rem;
}
.mod-hero__num {
  display: inline-flex; align-items: center; justify-content: center;
  width: 64px; height: 64px; border-radius: 50%;
  background: var(--gold-dim); border: 1.5px solid var(--gold);
  font-size: 1.6rem; font-weight: 800; color: var(--gold);
  margin: 0 auto 1.25rem;
}
.mod-hero__title {
  font-size: clamp(1.5rem, 4vw, 2.2rem); font-weight: 700;
  color: #fff; margin: 0 0 .6rem; line-height: 1.25;
}
.mod-hero__week {
  font-size: .85rem; color: var(--muted); margin: 0 0 1.5rem;
}

/* Barre de progression activités */
.mod-hero__progress {
  max-width: 320px; margin: 0 auto;
}
.mod-hero__progress-label {
  display: flex; justify-content: space-between;
  font-size: .76rem; color: var(--muted); margin-bottom: .4rem;
}
.mod-hero__progress-track {
  height: 5px; background: rgba(255,255,255,.08); border-radius: 3px; overflow: hidden;
}
.mod-hero__progress-fill {
  height: 100%; border-radius: 3px;
  background: linear-gradient(90deg, var(--gold), var(--gold-l));
  transition: width .5s ease;
}

/* ── Contenu principal ── */
.mod-body {
  max-width: 740px; margin: 0 auto; padding: 0 1.5rem 4rem;
}

/* Lecteur audio */
.mod-audio {
  margin: 2.5rem 0;
  background: rgba(201,168,76,.07);
  border: 1px solid var(--border);
  border-radius: 16px;
  padding: 1.4rem 1.8rem;
  display: flex; flex-direction: column; gap: .75rem;
}
.mod-audio__label {
  display: flex; align-items: center; gap: .6rem;
  font-size: .85rem; color: var(--gold); font-weight: 600;
}
.mod-audio audio {
  width: 100%;
  height: 40px;
  border-radius: 8px;
  accent-color: var(--gold);
}
.mod-audio__hint {
  font-size: .74rem; color: var(--muted);
}

/* Intro narrative */
.mod-intro {
  margin: 2.5rem 0;
  padding: 2rem 2.2rem;
  background: var(--surf);
  border-left: 3px solid var(--gold);
  border-radius: 0 12px 12px 0;
  font-size: 1rem; line-height: 1.9;
  color: rgba(232,224,208,.88);
  white-space: pre-line;
}
.mod-intro strong { color: #fff; }

/* Séparateur */
.mod-divider {
  display: flex; align-items: center; gap: 1rem;
  margin: 2.5rem 0;
  color: var(--muted); font-size: .75rem; letter-spacing: .12em; text-transform: uppercase;
}
.mod-divider::before, .mod-divider::after {
  content: ''; flex: 1; height: 1px; background: var(--border);
}

/* ── Activités ── */
.mod-activities { display: flex; flex-direction: column; gap: 1.25rem; }

.mod-activity {
  background: var(--surf);
  border: 1px solid rgba(255,255,255,.07);
  border-radius: 14px;
  overflow: hidden;
  transition: border-color .2s;
}
.mod-activity.is-done {
  border-color: rgba(34,197,94,.3);
  background: rgba(34,197,94,.04);
}

.mod-activity__header {
  display: flex; align-items: flex-start; gap: 1rem; padding: 1.2rem 1.4rem;
  cursor: pointer;
}
.mod-activity__icon {
  flex-shrink: 0; width: 44px; height: 44px; border-radius: 10px;
  display: flex; align-items: center; justify-content: center;
  font-size: 1.3rem;
  background: rgba(255,255,255,.05);
}
.mod-activity__icon--lecture   { background: rgba(59,130,246,.12); }
.mod-activity__icon--pratique  { background: rgba(16,185,129,.12); }
.mod-activity__icon--ecriture  { background: rgba(245,158,11,.10); }
.mod-activity__icon--exercice  { background: rgba(139,92,246,.12); }
.mod-activity__icon--reflexion { background: rgba(236,72,153,.10); }

/* ─ Contenu long lecture ─ */
.mod-lecture-content, .mod-rich-content {
  background: rgba(255,255,255,.10);
  border: 1px solid rgba(255,255,255,.18);
  border-radius: 14px;
  padding: 2rem 2.25rem;
  margin: 1.25rem 0;
  font-size: 1rem;
  line-height: 2;
  color: #e8e0d0;
}
.mod-rich-content { padding: 1rem 0; background: none; border: none; border-radius: 0; margin: .5rem 0; }
.mod-lecture-content h3 {
  font-size: 1.1rem;
  font-weight: 700;
  color: #ffffff;
  margin: 2rem 0 .8rem;
  letter-spacing: .015em;
}
.mod-lecture-content h3:first-child { margin-top: 0; }
.mod-lecture-content p {
  margin: 0 0 1.2rem;
  color: #e8e0d0;
}
.mod-lecture-content p:last-child { margin-bottom: 0; }
.mod-lecture-content strong {
  color: #ffffff;
  font-weight: 700;
}
.mod-lecture-content em {
  color: #c9a84c;
  font-style: italic;
  font-weight: 500;
}
.mod-lecture-content blockquote {
  border-left: 3px solid #c9a84c;
  padding: 1rem 1.5rem;
  margin: 1.5rem 0;
  background: rgba(201,168,76,.12);
  border-radius: 0 10px 10px 0;
  font-style: italic;
  color: #f0e6c8;
  font-size: 1rem;
  line-height: 1.85;
}
.mod-lecture-content ul {
  padding-left: 1.5rem;
  margin: 1rem 0 1.2rem;
}
.mod-lecture-content ul li {
  margin-bottom: .7rem;
  color: #e8e0d0;
  line-height: 1.85;
}
.mod-lecture-source {
  display: flex; align-items: flex-start; gap: .5rem; flex-wrap: wrap;
  margin-top: 1.5rem; padding-top: 1rem;
  border-top: 1px solid rgba(255,255,255,.1);
  font-size: .78rem;
  color: rgba(232,224,208,.5);
  font-style: italic;
  line-height: 1.6;
}
.mod-lecture-source span { color: #c9a84c; flex-shrink: 0; }

.mod-activity__meta { flex: 1; }
.mod-activity__title {
  font-size: .95rem; font-weight: 600; color: #fff; margin: 0 0 .25rem; line-height: 1.3;
}
.mod-activity__tags {
  display: flex; align-items: center; gap: .5rem; flex-wrap: wrap;
}
.mod-activity__tag {
  font-size: .7rem; padding: .18rem .55rem; border-radius: 20px;
  background: rgba(255,255,255,.07); color: var(--muted);
  text-transform: capitalize;
}
.mod-activity__check {
  flex-shrink: 0; margin-top: .1rem;
  width: 22px; height: 22px; border-radius: 50%;
  display: flex; align-items: center; justify-content: center;
  background: rgba(34,197,94,.2); border: 1.5px solid rgba(34,197,94,.5);
  color: #4ade80; font-size: .85rem;
}
.mod-activity__expand {
  flex-shrink: 0; margin-top: .25rem;
  color: var(--muted); font-size: .8rem;
  transition: transform .25s;
}
.mod-activity.is-expanded .mod-activity__expand { transform: rotate(180deg); }

/* Corps de l'activité */
.mod-activity__body {
  display: none;
  padding: 0 1.4rem 1.4rem;
  border-top: 1px solid rgba(255,255,255,.05);
}
.mod-activity.is-expanded .mod-activity__body { display: block; }

.mod-activity__desc {
  font-size: .9rem; color: rgba(232,224,208,.75); line-height: 1.75;
  margin-bottom: 1.2rem; margin-top: 1rem;
}

/* Textarea journal */
.mod-journal-label {
  font-size: .78rem; color: var(--gold); margin-bottom: .45rem;
  display: flex; align-items: center; gap: .4rem;
}
.mod-journal-textarea {
  width: 100%; min-height: 120px;
  background: rgba(255,255,255,.04);
  border: 1px solid rgba(255,255,255,.12);
  border-radius: 10px;
  color: var(--text);
  font-size: .875rem; line-height: 1.65;
  padding: .9rem 1rem;
  resize: vertical;
  outline: none;
  transition: border-color .2s;
  font-family: inherit;
}
.mod-journal-textarea:focus { border-color: rgba(201,168,76,.4); }
.mod-journal-textarea::placeholder { color: rgba(232,224,208,.25); }
.mod-journal-saved {
  font-size: .72rem; color: var(--muted); margin-top: .35rem; height: .9rem;
  transition: opacity .3s;
}

/* Bouton valider activité */
.mod-btn-validate {
  margin-top: 1rem;
  display: inline-flex; align-items: center; gap: .5rem;
  background: linear-gradient(135deg, #1a4a1a, #14391e);
  border: 1.5px solid rgba(34,197,94,.4);
  color: #4ade80; padding: .6rem 1.2rem; border-radius: 10px;
  font-size: .85rem; font-weight: 600; cursor: pointer;
  transition: all .2s;
}
.mod-btn-validate:hover { border-color: rgba(34,197,94,.7); background: rgba(34,197,94,.15); }
.mod-btn-validate.is-done {
  background: rgba(34,197,94,.12);
  border-color: rgba(34,197,94,.3);
  color: #4ade80; cursor: default;
}

/* Guide respiration */
.mod-breath-guide {
  background: rgba(16,185,129,.07);
  border: 1px solid rgba(16,185,129,.2);
  border-radius: 12px;
  padding: 1.25rem;
  margin-bottom: 1rem;
}
.mod-breath-guide__title {
  font-size: .8rem; color: #6ee7b7; margin-bottom: .75rem;
  display: flex; align-items: center; gap: .4rem;
}
.mod-breath-timer-btn {
  display: inline-flex; align-items: center; gap: .5rem;
  background: rgba(16,185,129,.15); border: 1px solid rgba(16,185,129,.3);
  color: #6ee7b7; border-radius: 8px; padding: .5rem 1rem;
  font-size: .82rem; cursor: pointer; transition: all .2s;
}
.mod-breath-timer-btn:hover { background: rgba(16,185,129,.25); }
.mod-breath-display {
  margin-top: .75rem; text-align: center;
  font-size: 1.8rem; font-weight: 700; color: #6ee7b7; letter-spacing: .05em;
  display: none;
}
.mod-breath-phase {
  font-size: .8rem; color: rgba(110,231,183,.7); margin-top: .2rem;
}

/* ── Conclusion ── */
.mod-conclusion {
  margin: 3rem 0 2rem;
  text-align: center;
  padding: 2.5rem 2rem;
  background: linear-gradient(135deg, rgba(201,168,76,.08), rgba(201,168,76,.03));
  border: 1px solid var(--border);
  border-radius: 18px;
}
.mod-conclusion__symbol {
  font-size: 2.2rem; margin-bottom: .75rem; display: block;
}
.mod-conclusion__text {
  font-size: 1.1rem; font-style: italic; color: var(--gold-l); line-height: 1.7;
}

.mod-pdf-download {
  margin: 0 0 2rem;
  padding: 1.4rem 1.5rem;
  background: linear-gradient(135deg, rgba(201,168,76,.10), rgba(201,168,76,.04));
  border: 1px solid rgba(201,168,76,.22);
  border-radius: 18px;
  position: relative;
  overflow: hidden;
}
.mod-pdf-download::before {
  content: '';
  position: absolute; inset: 0;
  background: radial-gradient(circle at top right, rgba(201,168,76,.10), transparent 45%);
  pointer-events: none;
}
.mod-pdf-download__eyebrow {
  position: relative;
  font-size: .68rem; letter-spacing: .24em; text-transform: uppercase;
  color: rgba(201,168,76,.72); margin-bottom: .8rem;
}
.mod-pdf-download__title {
  position: relative;
  font-size: 1.15rem; font-weight: 700; color: #fff; margin-bottom: .45rem;
}
.mod-pdf-download__text {
  position: relative;
  font-size: .95rem; line-height: 1.8; color: rgba(232,224,208,.78); margin-bottom: 1rem;
}
.mod-pdf-download__actions {
  position: relative;
  display: flex; gap: .85rem; flex-wrap: wrap;
}
.mod-pdf-download__btn {
  display: inline-flex; align-items: center; gap: .55rem;
  text-decoration: none;
  padding: .78rem 1rem;
  border-radius: 12px;
  border: 1px solid rgba(201,168,76,.24);
  background: rgba(255,255,255,.03);
  color: #f5ecd7;
  transition: all .2s ease;
  min-width: 210px;
}
.mod-pdf-download__btn:hover {
  border-color: rgba(201,168,76,.55);
  background: rgba(201,168,76,.10);
  transform: translateY(-2px);
}
.mod-pdf-download__icon {
  width: 38px; height: 38px; border-radius: 10px;
  display: inline-flex; align-items: center; justify-content: center;
  background: rgba(201,168,76,.14); color: var(--gold);
  font-size: 1rem; flex-shrink: 0;
}
.mod-pdf-download__label {
  display: block; font-size: .92rem; font-weight: 600; color: #fff;
}
.mod-pdf-download__sub {
  display: block; font-size: .74rem; color: rgba(232,224,208,.58); margin-top: .12rem;
}

/* ── Navigation prev/next ── */
.mod-nav-bottom {
  display: flex; justify-content: space-between; align-items: center;
  margin-top: 2rem; gap: 1rem; flex-wrap: wrap;
}

/* ══════════════════════════════════════════════════
   FIN DE PARCOURS — Module 06 uniquement
   Section "Continuer le chemin" + invitation ambassadeur
   ══════════════════════════════════════════════════ */

/* ─ Séparateur narratif ─ */
.mod-journey-sep {
  display: flex; align-items: center; gap: 1.5rem;
  margin: 3.5rem 0 2.5rem;
}
.mod-journey-sep__line {
  flex: 1; height: 1px;
  background: linear-gradient(to right, transparent, rgba(201,168,76,.3), transparent);
}
.mod-journey-sep__symbol {
  font-size: 1.4rem; color: rgba(201,168,76,.5); flex-shrink: 0; letter-spacing: .1em;
}

/* ─ Titre de section ─ */
.mod-chapter-label {
  font-size: .62rem; letter-spacing: .32em; text-transform: uppercase;
  color: rgba(201,168,76,.6); margin-bottom: 1.75rem; text-align: center;
}

/* ─ 3 Cartes "Continuer" ─ */
.mod-paths-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
  gap: 1.25rem;
  margin-bottom: 3rem;
}
.mod-path-card {
  background: #141414;
  border: 1px solid rgba(201,168,76,.18);
  border-radius: 18px;
  padding: 2rem 1.75rem 1.75rem;
  text-decoration: none;
  transition: border-color .25s, background .25s, transform .2s;
  display: flex; flex-direction: column;
  position: relative; overflow: hidden;
}
.mod-path-card::before {
  content: '';
  position: absolute; inset: 0;
  background: radial-gradient(ellipse at top left, rgba(201,168,76,.06) 0%, transparent 65%);
  pointer-events: none;
}
.mod-path-card:hover {
  border-color: rgba(201,168,76,.5);
  background: #1a1208;
  transform: translateY(-3px);
}
.mod-path-card__badge {
  display: inline-flex; align-items: center; gap: 6px;
  font-size: .58rem; letter-spacing: .25em; text-transform: uppercase;
  color: rgba(201,168,76,.65);
  border: 1px solid rgba(201,168,76,.2);
  padding: 4px 12px; border-radius: 50px;
  margin-bottom: 1.25rem; width: fit-content;
}
.mod-path-card__icon {
  font-size: 1.9rem; line-height: 1; margin-bottom: .9rem;
}
.mod-path-card__title {
  font-size: 1.05rem; font-weight: 700; color: #fff;
  margin: 0 0 .55rem; line-height: 1.3;
}
.mod-path-card__text {
  font-size: .82rem; color: rgba(232,224,208,.5);
  line-height: 1.75; flex: 1;
}
.mod-path-card__arrow {
  margin-top: 1.5rem;
  display: flex; align-items: center; gap: 6px;
  font-size: .75rem; font-weight: 600; letter-spacing: .06em; text-transform: uppercase;
  color: rgba(201,168,76,.55);
  transition: color .2s, gap .2s;
}
.mod-path-card:hover .mod-path-card__arrow {
  color: #c9a84c; gap: 10px;
}

/* ─ Bloc invitation ambassadeur ─ */
.mod-amb-block {
  position: relative;
  margin: 1rem 0 3rem;
  border-radius: 22px;
  overflow: hidden;
  padding: 3rem 2.5rem 2.75rem;
  text-align: center;
  background: linear-gradient(160deg, #100d00 0%, #0d0d1a 50%, #070712 100%);
  border: 1px solid rgba(201,168,76,.28);
}
.mod-amb-block::before {
  content: '';
  position: absolute; inset: 0;
  background: radial-gradient(ellipse 70% 50% at 50% 0%, rgba(201,168,76,.12) 0%, transparent 70%);
  pointer-events: none;
}
.mod-amb-block__eyebrow {
  font-size: .6rem; letter-spacing: .32em; text-transform: uppercase;
  color: rgba(201,168,76,.6); margin-bottom: 1.1rem;
  display: flex; align-items: center; justify-content: center; gap: .75rem;
}
.mod-amb-block__eyebrow::before,
.mod-amb-block__eyebrow::after {
  content: '∿';
  color: rgba(201,168,76,.25); font-size: .85rem;
}
.mod-amb-block__title {
  font-size: clamp(1.35rem, 3.5vw, 1.9rem);
  font-weight: 300; letter-spacing: -.02em;
  color: #fff; margin: 0 0 1rem; line-height: 1.3;
}
.mod-amb-block__title em { color: #c9a84c; font-style: normal; }
.mod-amb-block__text {
  font-size: .9rem; line-height: 1.85;
  color: rgba(232,224,208,.55);
  max-width: 540px; margin: 0 auto 2rem;
}
.mod-amb-block__text strong { color: rgba(232,224,208,.9); font-weight: 500; }
.mod-amb-cta-wrap {
  display: flex; flex-direction: column;
  align-items: center; gap: .75rem;
}
.mod-amb-btn {
  display: inline-flex; align-items: center; gap: .65rem;
  background: linear-gradient(135deg, #c9a84c, #e8d17a);
  color: #0a0800 !important; text-decoration: none;
  font-size: .85rem; font-weight: 800; letter-spacing: .1em; text-transform: uppercase;
  padding: 1rem 2.75rem; border-radius: 50px;
  border: none; cursor: pointer;
  transition: box-shadow .25s, transform .2s;
  box-shadow: 0 4px 24px rgba(201,168,76,.22);
}
.mod-amb-btn:hover {
  box-shadow: 0 8px 36px rgba(201,168,76,.4);
  transform: translateY(-2px);
}
.mod-amb-btn svg { flex-shrink: 0; }
.mod-amb-skip {
  font-size: .75rem; color: rgba(232,224,208,.25);
  font-style: italic; letter-spacing: .02em;
}
/* Si déjà ambassadeur */
.mod-amb-already {
  display: inline-flex; align-items: center; gap: .6rem;
  background: rgba(201,168,76,.08);
  border: 1px solid rgba(201,168,76,.22);
  border-radius: 50px; padding: .75rem 1.75rem;
  font-size: .85rem; color: #c9a84c; font-weight: 600;
  text-decoration: none;
  transition: background .2s;
}
.mod-amb-already:hover { background: rgba(201,168,76,.14); }

/* ─ Note de fin poétique ─ */
.mod-final-verse {
  margin: 0 0 2.5rem;
  text-align: center;
  padding: 2rem 1.5rem;
  border-top: 1px solid rgba(201,168,76,.1);
}
.mod-final-verse__text {
  font-size: .95rem; font-style: italic; color: rgba(232,224,208,.4);
  line-height: 1.9; letter-spacing: .01em;
}
.mod-final-verse__attr {
  margin-top: .75rem; font-size: .72rem; letter-spacing: .2em;
  text-transform: uppercase; color: rgba(201,168,76,.3);
}
.mod-nav-btn {
  display: flex; align-items: center; gap: .5rem;
  padding: .75rem 1.4rem; border-radius: 10px;
  font-size: .85rem; font-weight: 600; text-decoration: none;
  transition: all .2s;
  border: 1.5px solid rgba(255,255,255,.1); color: var(--muted);
  background: var(--surf);
}
.mod-nav-btn:hover { border-color: rgba(201,168,76,.4); color: var(--text); }
.mod-nav-btn--gold {
  background: linear-gradient(135deg, #2d1f00, #1a1200);
  border-color: var(--gold); color: var(--gold);
}
.mod-nav-btn--gold:hover { background: var(--gold-dim); color: var(--gold-l); }

/* ── CTA terminer le module ── */
.mod-complete-wrap {
  margin-top: 2.5rem;
  background: var(--surf);
  border: 1px solid var(--border);
  border-radius: 16px;
  padding: 1.8rem 2rem;
  text-align: center;
}
.mod-complete-wrap h3 {
  font-size: 1.05rem; color: #fff; margin: 0 0 .4rem;
}
.mod-complete-wrap p {
  font-size: .85rem; color: var(--muted); margin: 0 0 1.25rem;
}
.mod-btn-complete {
  display: inline-flex; align-items: center; gap: .6rem;
  background: linear-gradient(135deg, #7c3aed, #4c1d95);
  color: #fff; padding: .9rem 2rem; border-radius: 12px;
  font-size: .95rem; font-weight: 700; border: none; cursor: pointer;
  transition: all .2s; text-decoration: none;
}
.mod-btn-complete:hover { transform: translateY(-1px); box-shadow: 0 6px 20px rgba(124,58,237,.4); }
.mod-btn-complete--gold {
  background: linear-gradient(135deg, var(--gold), #a07820);
  color: #1a0e00;
}
.mod-btn-complete--gold:hover { box-shadow: 0 6px 20px rgba(201,168,76,.35); }

/* Flash */
.mod-flash {
  padding: 1rem 1.5rem 0;
  max-width: 740px; margin: 0 auto;
}
.mod-flash__msg {
  border-radius: 10px; padding: .8rem 1.2rem; font-size: .88rem; margin-bottom: .5rem;
}
.mod-flash__msg--success { background: rgba(34,197,94,.1); border: 1px solid rgba(34,197,94,.25); color: #86efac; }
.mod-flash__msg--info    { background: rgba(59,130,246,.1); border: 1px solid rgba(59,130,246,.25); color: #93c5fd; }

@media (max-width: 640px) {
  .mod-nav { padding: .75rem 1rem; }
  .mod-hero { padding: 2rem 1.25rem 1.75rem; }
  .mod-body { padding: 0 1rem 3rem; }
  .mod-intro { padding: 1.4rem 1.5rem; }
  .mod-activity__header { gap: .75rem; padding: 1rem; }
  .mod-activity__body { padding: 0 1rem 1rem; }
  .mod-conclusion { padding: 1.75rem 1.25rem; }
  .mod-pdf-download { padding: 1.2rem; }
  .mod-pdf-download__btn { width: 100%; min-width: 0; }
}
</style>
@endsection

@section('content')
<div style="background: var(--dark, #0a0a0a); min-height: 100vh;">

  {{-- Navigation sticky --}}
  <nav class="mod-nav">
    <a href="{{ route($dashboardRouteName) }}" class="mod-nav__back">
      <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M19 12H5M12 5l-7 7 7 7"/></svg>
      {{ $isEn ? ($spaceKey === 'parcours' ? 'My Journey' : 'Dashboard') : ($spaceKey === 'parcours' ? 'Mon parcours' : 'Tableau de bord') }}
    </a>
    <div class="mod-nav__title">{{ $moduleTitle }}</div>
    <div class="mod-nav__progress">{{ $completedCount }}/{{ $totalCount }} {{ $isEn ? 'activities' : 'activités' }}</div>
  </nav>

  {{-- Flash --}}
  @if(session('success') || session('info'))
  <div class="mod-flash">
    @if(session('success'))
      <div class="mod-flash__msg mod-flash__msg--success">{{ session('success') }}</div>
    @endif
    @if(session('info'))
      <div class="mod-flash__msg mod-flash__msg--info">{{ session('info') }}</div>
    @endif
  </div>
  @endif

  {{-- Badge Mode Créateur --}}
  @if(!empty($creatorMode))
  <div style="background:linear-gradient(90deg,rgba(201,168,76,.1),rgba(201,168,76,.05));border-bottom:1px solid rgba(201,168,76,.3);padding:.5rem 1.5rem;display:flex;align-items:center;gap:.6rem;">
    <span style="font-size:.9rem;">🔑</span>
    <span style="font-size:.72rem;font-weight:700;letter-spacing:.1em;color:rgba(201,168,76,.9);text-transform:uppercase;">{{ $isEn ? 'Creator Mode' : 'Mode Créateur' }}</span>
    <span style="font-size:.72rem;color:rgba(255,255,255,.4);">{{ $isEn ? '— Preview access without progress lock' : '— Accès prévisualisé sans verrou de progression' }}</span>
  </div>
  @endif

  {{-- Hero du module --}}
  <div class="mod-hero">
    <div class="mod-hero__eyebrow">{{ $module->week_label }} · {{ $spaceLabel }}</div>
    <div class="mod-hero__num">{{ $module->display_order }}</div>
    <h1 class="mod-hero__title">{{ $moduleTitle }}</h1>
    @if($moduleDescription)
      <p class="mod-hero__week">{{ $moduleDescription }}</p>
    @endif

    @if($totalCount > 0)
    <div class="mod-hero__progress">
      <div class="mod-hero__progress-label">
        <span>{{ $isEn ? 'Progress' : 'Progression' }}</span>
        <span>{{ $completedCount }}/{{ $totalCount }}</span>
      </div>
      <div class="mod-hero__progress-track">
        <div class="mod-hero__progress-fill" style="width: {{ $totalCount > 0 ? round($completedCount/$totalCount*100) : 0 }}%"></div>
      </div>
    </div>
    @endif
  </div>

  {{-- Corps du module --}}
  <div class="mod-body">

    {{-- Lecteur audio guidé FR / EN --}}
    @if($module->audio_path || $module->audio_path_en)
    <div class="mod-audio">
      {{-- Toggle langue : toujours affiché si au moins 1 audio existe --}}
      @php
        // FR actif si page FR, OU page EN mais sans audio EN (fallback FR)
        $frBtnActive = !($isEn && $module->audio_path_en);
        $enBtnActive = $isEn && $module->audio_path_en;
      @endphp
      <div style="display:flex;gap:8px;margin-bottom:10px;">
        <button id="btn-lang-fr" onclick="switchAudioLang('fr')"
          style="{{ $frBtnActive ? 'background:#c9a84c;color:#0f0f0f;border:none;' : 'background:rgba(201,168,76,.15);color:#c9a84c;border:1px solid #c9a84c;' }}padding:5px 14px;border-radius:20px;font-size:12px;font-weight:700;cursor:pointer;letter-spacing:.04em;">
          🇫🇷 Français
        </button>
        <button id="btn-lang-en" onclick="switchAudioLang('en')"
          style="{{ $enBtnActive ? 'background:#c9a84c;color:#0f0f0f;border:none;' : 'background:rgba(201,168,76,.15);color:#c9a84c;border:1px solid #c9a84c;' }}padding:5px 14px;border-radius:20px;font-size:12px;font-weight:700;cursor:pointer;letter-spacing:.04em;">
          🇬🇧 English
        </button>
      </div>

      <div class="mod-audio__label">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polygon points="5 3 19 12 5 21 5 3" fill="currentColor"/></svg>
        <span id="audio-label-text">{{ $isEn ? 'Listen to the guided module' : 'Écouter le module guidé' }}</span>
      </div>
      <audio id="mod-audio-player" controls preload="metadata" style="width:100%">
        <source id="mod-audio-source"
          src="{{ asset('storage/' . ($isEn && $module->audio_path_en ? $module->audio_path_en : ($module->audio_path ?? $module->audio_path_en))) }}"
          type="audio/mpeg">
      </audio>
      <div class="mod-audio__hint">{{ $isEn ? '🎧 Recommended: listen to the guided module first, then work through the activities.' : '🎧 Recommandé : écoutez d\'abord le module guidé, puis travaillez les activités.' }}</div>
    </div>

    <script>
    var _audioFr  = "{{ $module->audio_path ? asset('storage/'.$module->audio_path) : '' }}";
    var _audioEn  = "{{ $module->audio_path_en ? asset('storage/'.$module->audio_path_en) : '' }}";
    function switchAudioLang(lang) {
      var player  = document.getElementById('mod-audio-player');
      var source  = document.getElementById('mod-audio-source');
      var label   = document.getElementById('audio-label-text');
      var btnFr   = document.getElementById('btn-lang-fr');
      var btnEn   = document.getElementById('btn-lang-en');
      if (lang === 'fr' && _audioFr) {
        source.src = _audioFr;
        label.textContent = '{{ $isEn ? 'Listen to the guided module' : 'Écouter le module guidé' }}';
        if (btnFr) { btnFr.style.background='#c9a84c'; btnFr.style.color='#0f0f0f'; }
        if (btnEn) { btnEn.style.background='rgba(201,168,76,.15)'; btnEn.style.color='#c9a84c'; }
      } else if (lang === 'en' && _audioEn) {
        source.src = _audioEn;
        label.textContent = 'Listen to the guided module';
        if (btnEn) { btnEn.style.background='#c9a84c'; btnEn.style.color='#0f0f0f'; }
        if (btnFr) { btnFr.style.background='rgba(201,168,76,.15)'; btnFr.style.color='#c9a84c'; }
      }
      player.load();
    }
    </script>
    @endif

    {{-- Texte introductif narratif (FR par défaut, bascule EN via bouton) --}}
    @if($module->intro_text || $module->intro_text_en)
    @if($module->intro_text_en)
    <div style="display:flex;gap:8px;margin:20px 0 8px;align-items:center;">
      <span style="font-size:12px;color:rgba(201,168,76,.7);text-transform:uppercase;letter-spacing:.08em;">{{ $isEn ? 'Introduction' : 'Présentation' }}</span>
      <div style="flex:1;height:1px;background:rgba(201,168,76,.15);"></div>
      <button onclick="toggleIntroLang()" id="btn-intro-lang"
        style="background:none;border:1px solid rgba(201,168,76,.4);color:#c9a84c;font-size:11px;padding:3px 10px;border-radius:12px;cursor:pointer;">
        {{ $isEn ? '🇫🇷 Lire en Français' : '🇬🇧 Read in English' }}
      </button>
    </div>
    @endif
    <div class="mod-intro" id="mod-intro-fr" @if($isEn && $module->intro_text_en) style="display:none;" @endif>{!! nl2br(e($module->intro_text)) !!}</div>
    @if($module->intro_text_en)
    <div class="mod-intro" id="mod-intro-en" @if(!$isEn) style="display:none;" @endif>{!! nl2br(e($module->intro_text_en)) !!}</div>
    <script>
    var _introLang = '{{ $isEn ? 'en' : 'fr' }}';
    function toggleIntroLang() {
      var btn = document.getElementById('btn-intro-lang');
      if (_introLang === 'fr') {
        document.getElementById('mod-intro-fr').style.display = 'none';
        document.getElementById('mod-intro-en').style.display = 'block';
        btn.textContent = '🇫🇷 Lire en Français';
        _introLang = 'en';
      } else {
        document.getElementById('mod-intro-fr').style.display = 'block';
        document.getElementById('mod-intro-en').style.display = 'none';
        btn.textContent = '🇬🇧 Read in English';
        _introLang = 'fr';
      }
    }
    </script>
    @endif
    @endif

    @if(count($activities) > 0)
    <div class="mod-divider">{{ $isEn ? 'Module activities' : 'Activités du module' }}</div>

    <div class="mod-activities" id="mod-activities">
      @foreach($activities as $idx => $act)
      @php
        $prog    = $activityProgress->get($idx);
        $isDone  = $prog && $prog->completed_at;
        $notes   = $prog->notes ?? '';
        $type    = $act['type'] ?? 'pratique';
        $iconMap = ['lecture'=>'📖','pratique'=>'🌬️','ecriture'=>'✍️','exercice'=>'💡','reflexion'=>'🔍'];
        $isJournal = in_array($type, ['ecriture','reflexion']);
        $isBreath  = $type === 'pratique';
      @endphp
      <div class="mod-activity {{ $isDone ? 'is-done' : '' }}" id="activity-{{ $idx }}" data-idx="{{ $idx }}">

        <div class="mod-activity__header" onclick="toggleActivity({{ $idx }})">
          <div class="mod-activity__icon mod-activity__icon--{{ $type }}">
            {{ $iconMap[$type] ?? '▸' }}
          </div>
          <div class="mod-activity__meta">
            <div class="mod-activity__title">{{ $act['title'] }}</div>
            <div class="mod-activity__tags">
              <span class="mod-activity__tag">{{ ucfirst($type) }}</span>
              @if(!empty($act['duration']))
                <span class="mod-activity__tag">⏱ {{ $act['duration'] }}</span>
              @endif
              @if($isDone)
                <span class="mod-activity__tag" style="color:#4ade80;background:rgba(34,197,94,.12);">✓ {{ $isEn ? 'Done' : 'Fait' }}</span>
              @endif
            </div>
          </div>
          @if($isDone)
            <div class="mod-activity__check">✓</div>
          @else
            <div class="mod-activity__expand">▼</div>
          @endif
        </div>

        <div class="mod-activity__body">
          @if(!empty($act['description']))
          <div class="mod-activity__desc">{{ $act['description'] }}</div>
          @endif

          {{-- Contenu riche (toutes activités) --}}
          @if(!empty($act['content']))
          <div class="mod-{{ $type === 'lecture' ? 'lecture' : 'rich' }}-content">{!! $act['content'] !!}</div>
          @if($type === 'lecture' && !empty($act['source']))
          <div class="mod-lecture-source"><span>✦</span> {{ $act['source'] }}</div>
          @endif
          @endif

          {{-- Guide respiration animé pour les pratiques --}}
          @if($isBreath)
          <div class="mod-breath-guide">
            <div class="mod-breath-guide__title">
              🌬️ {{ $isEn ? 'Practice timer' : 'Minuteur de pratique' }}
            </div>
            <button class="mod-breath-timer-btn" onclick="startBreathTimer({{ $idx }}, this)">
              <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polygon points="5 3 19 12 5 21 5 3" fill="currentColor"/></svg>
              {{ $isEn ? 'Start timer' : 'Démarrer le minuteur' }}
            </button>
            <div class="mod-breath-display" id="breath-display-{{ $idx }}">
              <div id="breath-timer-{{ $idx }}">5</div>
              <div class="mod-breath-phase" id="breath-phase-{{ $idx }}">Inspirez</div>
            </div>
          </div>
          @endif

          {{-- Zone de journal pour écriture / réflexion --}}
          @if($isJournal)
          <div class="mod-journal-label">
            ✍️ {{ $isEn ? 'Your personal journal (auto-saved)' : 'Votre journal personnel (enregistré automatiquement)' }}
          </div>
          <textarea
            class="mod-journal-textarea"
            id="notes-{{ $idx }}"
            data-idx="{{ $idx }}"
            data-slug="{{ $module->slug }}"
            placeholder="{{ $isEn ? 'Write your answers and reflections here… Your text is saved automatically.' : 'Écrivez ici vos réponses et réflexions… Votre texte est sauvegardé automatiquement.' }}"
            oninput="autosaveNotes(this)"
          >{{ $notes }}</textarea>
          <div class="mod-journal-saved" id="saved-{{ $idx }}"></div>
          @endif

          {{-- Bouton valider --}}
          <form method="POST" action="{{ route($activityCompleteRouteName, [$module->slug, $idx]) }}" class="mod-validate-form" data-idx="{{ $idx }}">
            @csrf
            @if($isJournal)
              <input type="hidden" name="notes" id="hidden-notes-{{ $idx }}">
            @endif
            <button type="submit" class="mod-btn-validate {{ $isDone ? 'is-done' : '' }}" data-idx="{{ $idx }}">
              @if($isDone)
                {{ $isEn ? '✓ Activity completed' : '✓ Activité validée' }}
              @else
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12l5 5L20 7"/></svg>
                {{ $isEn ? 'I have done this activity' : "J'ai fait cette activité" }}
              @endif
            </button>
          </form>
        </div>

      </div>
      @endforeach
    </div>
    @endif

    {{-- Conclusion ∞+ --}}
    @php
      $moduleSlugKey = preg_replace('/^formation-/', '', $module->slug);
      $conclusionsFr = [
        '01-je-me-rencontre'           => ['∞+', "Infiniment + présent(e) à vous-même\nqu'au début de cette semaine."],
        '02-je-reconnais-mes-blessures' => ['∞+', "Infiniment + proche de vous-même\ndans votre vérité."],
        '03-je-decris-mon-bonheur'      => ['∞+', "Infiniment + proche\nde votre propre boussole intérieure."],
        '04-j-ecoute-mon-souffle'       => ['∞+', "Infiniment + à l'écoute\nde votre souffle intérieur."],
        '05-je-decouvre-ma-mission'     => ['∞+', "Infiniment + proche\nde votre raison d'être."],
        '06-je-visualise-ma-vie'        => ['∞+', "Infiniment + clair(e)\nsur la vie que vous choisissez d'appeler."],
        '07-je-transmets-le-rituel'     => ['∞+', "Vous avez traversé le voyage.\nVous pouvez désormais le transmettre."],
        '08-je-maitrise-la-vision'      => ['∞+', "Votre vision n'est plus mentale.\nElle devient une discipline incarnée."],
      ];
      $conclusionsEn = [
        '01-je-me-rencontre'           => ['∞+', "Infinitely more present to yourself\nthan at the start of this week."],
        '02-je-reconnais-mes-blessures' => ['∞+', "Infinitely closer to yourself\nin your own truth."],
        '03-je-decris-mon-bonheur'      => ['∞+', "Infinitely closer\nto your own inner compass."],
        '04-j-ecoute-mon-souffle'       => ['∞+', "Infinitely more attuned\nto your inner breath."],
        '05-je-decouvre-ma-mission'     => ['∞+', "Infinitely closer\nto your reason for being."],
        '06-je-visualise-ma-vie'        => ['∞+', "Infinitely clearer\non the life you choose to call in."],
        '07-je-transmets-le-rituel'     => ['∞+', "You have walked the journey.\nNow you can offer it to others."],
        '08-je-maitrise-la-vision'      => ['∞+', "Your vision is no longer mental.\nIt becomes an embodied discipline."],
      ];
      $conclusions = $isEn ? $conclusionsEn : $conclusionsFr;
    @endphp
    @if(isset($conclusions[$moduleSlugKey]))
    <div class="mod-conclusion">
      <span class="mod-conclusion__symbol">{{ $conclusions[$moduleSlugKey][0] }}</span>
      <p class="mod-conclusion__text">{{ $conclusions[$moduleSlugKey][1] }}</p>
    </div>
    @endif

    <div class="mod-pdf-download">
      <div class="mod-pdf-download__eyebrow">{{ $isEn ? 'Premium edition — download' : 'Edition premium a telecharger' }}</div>
      <div class="mod-pdf-download__title">{{ $isEn ? 'Get the full module as a PDF, in French or English.' : "Retrouvez l'integralite du module en PDF, en francais ou en anglais." }}</div>
      <div class="mod-pdf-download__text">
        {{ $isEn ? 'An elegant version to read, annotate or keep offline, to revisit the full course structure at your own pace.' : 'Une version elegante a lire, annoter ou conserver hors ligne, pour revisiter toute la structure du cours a votre rythme.' }}
      </div>
      <div class="mod-pdf-download__actions">
        <a class="mod-pdf-download__btn" href="{{ route($modulePdfRouteName, ['slug' => $module->slug, 'lang' => 'fr']) }}" target="_blank" rel="noopener">
          <span class="mod-pdf-download__icon">FR</span>
          <span>
            <span class="mod-pdf-download__label">Telecharger le PDF francais</span>
            <span class="mod-pdf-download__sub">{{ $module->title }}</span>
          </span>
        </a>
        <a class="mod-pdf-download__btn" href="{{ route($modulePdfRouteName, ['slug' => $module->slug, 'lang' => 'en']) }}" target="_blank" rel="noopener">
          <span class="mod-pdf-download__icon">EN</span>
          <span>
            <span class="mod-pdf-download__label">Download the English PDF</span>
            <span class="mod-pdf-download__sub">{{ $module->title_en ?: $module->title }}</span>
          </span>
        </a>
      </div>
    </div>

    {{-- Bloc terminer le module --}}
    @if($moduleStatus !== 'completed')
    <div class="mod-complete-wrap">
      <h3>{{ $isEn ? 'Ready to move on?' : 'Prêt(e) à avancer ?' }}</h3>
      <p>{{ $isEn ? 'Mark this module as complete to unlock the next one.' : 'Marquez ce module comme terminé pour débloquer le suivant.' }}</p>
      <form method="POST" action="{{ route($moduleCompleteRouteName, $module->id) }}">
        @csrf
        <button type="submit" class="mod-btn-complete {{ $completedCount >= $totalCount && $totalCount > 0 ? 'mod-btn-complete--gold' : '' }}">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12l5 5L20 7"/></svg>
          {{ $isEn ? 'Complete this module' : 'Terminer ce module' }}
        </button>
      </form>
    </div>
    @else
    <div class="mod-complete-wrap" style="border-color: rgba(34,197,94,.3); background: rgba(34,197,94,.04);">
      <h3 style="color: #4ade80;">{{ $isEn ? '✓ Module completed' : '✓ Module complété' }}</h3>
      <p>{{ $isEn ? 'This module is complete. Continue your progress.' : 'Ce module est terminé. Continuez votre progression.' }}</p>
    </div>
    @endif

    {{-- ══════════════════════════════════════════════════════════
         FIN DE PARCOURS — Section exclusive au Module 06
         "Continuer le chemin" + Invitation Ambassadeur
    ══════════════════════════════════════════════════════════════ --}}
    @if($showEndOfParcoursSection)

    {{-- Séparateur narratif --}}
    <div class="mod-journey-sep">
      <div class="mod-journey-sep__line"></div>
      <span class="mod-journey-sep__symbol">∞+</span>
      <div class="mod-journey-sep__line"></div>
    </div>

    <p class="mod-chapter-label">{{ $isEn ? 'You have completed all modules · The next chapter begins now' : 'Vous avez parcouru les 6 modules · La suite commence maintenant' }}</p>

    {{-- 3 portes ouvertes --}}
    <div class="mod-paths-grid">

      {{-- Carte 1 : Freelance Pause Souffle --}}
      <a href="{{ route('services.corporate') }}?domain=pause-souffle" class="mod-path-card">
        <div class="mod-path-card__badge">✦ Pratiquer</div>
        <div class="mod-path-card__icon">🌬️</div>
        <div class="mod-path-card__title">Rituel Pause Souffle</div>
        <p class="mod-path-card__text">
          Intégrez le Rituel Pause Souffle auprès d'un accompagnant certifié.
          Continuez à pratiquer avec un guide hebdomadaire dédié.
        </p>
        <div class="mod-path-card__arrow">
          Poursuivre
          <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
        </div>
      </a>

      {{-- Carte 2 : Devenir Praticien / Formateur --}}
      <a href="{{ route('presence.formation-praticien') }}" class="mod-path-card">
        <div class="mod-path-card__badge">◈ Transmettre</div>
        <div class="mod-path-card__icon">🎓</div>
        <div class="mod-path-card__title">Praticien Pause Souffle</div>
        <p class="mod-path-card__text">
          Formez-vous à la facilitation et transmettez le Rituel Pause Souffle
          à vos propres clients, équipes ou communautés.
        </p>
        <div class="mod-path-card__arrow">
          Découvrir la formation
          <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
        </div>
      </a>

      {{-- Carte 3 : Retraite --}}
      <a href="{{ route('presence.retraite') }}" class="mod-path-card">
        <div class="mod-path-card__badge">⬡ Approfondir</div>
        <div class="mod-path-card__icon">🏔️</div>
        <div class="mod-path-card__title">Retraite Pause Souffle</div>
        <p class="mod-path-card__text">
          Rejoignez une retraite immersive pour aller plus loin —
          3 jours hors du quotidien, dans un espace de silence et de présence.
        </p>
        <div class="mod-path-card__arrow">
          Voir les dates
          <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
        </div>
      </a>

    </div>

    {{-- ─ Invitation ambassadeur ─────────────────────────────── --}}
    <div class="mod-amb-block">
      <div class="mod-amb-block__eyebrow">{{ $isEn ? 'An invitation, not an obligation' : 'Une invitation, pas une obligation' }}</div>
      <h2 class="mod-amb-block__title">
        {{ $isEn ? 'What you have lived,' : 'Ce que vous avez vécu,' }}<br>
        <em>{{ $isEn ? 'others are still searching for it.' : 'd’autres le cherchent encore.' }}</em>
      </h2>
      <p class="mod-amb-block__text">
        {{ $isEn
          ? 'If the Pause Souffle experience touched you — if something in you shifted, became clearer, found peace — it is likely that people in your circle are going through what you were going through before you started.'
          : 'Si l’expérience Pause Souffle vous a touché — si quelque chose en vous a bougé, s’est clarifié, s’est apaisé — il est probable que des personnes dans votre entourage traversent ce que vous traversiez avant de commencer.' }}
      </p>
      <p class="mod-amb-block__text" style="margin-bottom: 2rem;">
        {{ $isEn
          ? 'The Pause Souffle Ambassador Network is not a classic affiliate programme. It is a circle of people who share what they have received, with their own link, their own words, their own experience. Nothing to sell. Just share.'
          : 'Le Réseau des Ambassadeurs Pause Souffle n’est pas un programme d’affiliation classique. C’est un cercle de personnes qui transmettent ce qu’elles ont reçu, avec leur propre lien, leurs propres mots, leur propre vécu. Rien à vendre. Juste partager.' }}
      </p>

      <div class="mod-amb-cta-wrap">
        @if($isAlreadyAmbassadeur ?? false)
          {{-- Déjà ambassadeur --}}
          <a href="{{ route('ps.ressources') }}" class="mod-amb-already">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12l5 5L20 7"/></svg>
            {{ $isEn ? 'You are already an Ambassador · Access resources' : 'Vous êtes déjà Ambassadeur · Accéder aux ressources' }}
          </a>
        @else
          {{-- Invitation à rejoindre --}}
          <form method="POST" action="{{ route('ps.register') }}" id="mod-amb-form" style="display:contents;">
            @csrf
            <button type="submit" class="mod-amb-btn" onclick="this.disabled=true;this.textContent='{{ $isEn ? 'Creating your profile…' : 'Création de votre profil…' }}';this.form.submit();">
              <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
              {{ $isEn ? 'Join the Ambassador Network' : 'Rejoindre le Réseau des Ambassadeurs' }}
            </button>
          </form>
          <p class="mod-amb-skip">{{ $isEn ? '30-second sign-up · Your personal link is created automatically' : 'Inscription en 30 secondes · Votre lien personnel est créé automatiquement' }}</p>
        @endif
      </div>
    </div>

    {{-- Note finale --}}
    <div class="mod-final-verse">
      <p class="mod-final-verse__text">
        {{ $isEn
          ? '« I ran for a very long time. I stopped everything.\nAnd that is where I found everything — and infinitely more. »'
          : '« J’ai couru très longtemps. J’ai tout arrêté.\nEt c’est là que j’ai tout trouvé — et infiniment plus. »' }}
      </p>
      <p class="mod-final-verse__attr">∞+ · {{ $isEn ? 'Last module · Pause Souffle Journey' : 'Dernier module · Parcours Pause Souffle' }}</p>
    </div>

    @endif
    {{-- /FIN DE PARCOURS --}}

    {{-- Navigation prev/next --}}
    <div class="mod-nav-bottom">
      @if($prevSlug)
        <a href="{{ route($moduleShowRouteName, $prevSlug) }}" class="mod-nav-btn">
          <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M19 12H5M12 5l-7 7 7 7"/></svg>
          {{ $isEn ? 'Previous module' : 'Module précédent' }}
        </a>
      @else
        <div></div>
      @endif

      @if($nextSlug)
        <a href="{{ route($moduleShowRouteName, $nextSlug) }}" class="mod-nav-btn mod-nav-btn--gold">
          {{ $isEn ? 'Next module' : 'Module suivant' }}
          <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
        </a>
      @endif
    </div>

  </div>{{-- /mod-body --}}

</div>
@endsection

@section('script')
<script>
// ─── Toggle accordéon activités ───────────────────────────
function toggleActivity(idx) {
  const el = document.getElementById('activity-' + idx);
  if (!el) return;
  const isExp = el.classList.contains('is-expanded');
  // Fermer tous
  document.querySelectorAll('.mod-activity.is-expanded').forEach(e => e.classList.remove('is-expanded'));
  if (!isExp) el.classList.add('is-expanded');
}

// Ouvrir la première activité non terminée au chargement
document.addEventListener('DOMContentLoaded', function () {
  const first = document.querySelector('.mod-activity:not(.is-done)');
  if (first) {
    const idx = first.getAttribute('data-idx');
    if (idx !== null) toggleActivity(parseInt(idx));
  }
});

// ─── Autosave journal ──────────────────────────────────────
const saveTimers = {};

function autosaveNotes(textarea) {
  const idx  = textarea.getAttribute('data-idx');
  const slug = textarea.getAttribute('data-slug');
  const savedEl = document.getElementById('saved-' + idx);
  // Synchroniser le hidden input
  const hidden = document.getElementById('hidden-notes-' + idx);
  if (hidden) hidden.value = textarea.value;

  if (saveTimers[idx]) clearTimeout(saveTimers[idx]);
  if (savedEl) savedEl.textContent = 'Enregistrement…';

  saveTimers[idx] = setTimeout(function () {
    fetch(`{{ route($activityNotesRouteName, ['slug' => '__SLUG__', 'idx' => '__IDX__']) }}`.replace('__SLUG__', slug).replace('__IDX__', idx), {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || '',
      },
      body: JSON.stringify({ notes: textarea.value }),
    })
    .then(r => r.json())
    .then(() => {
      if (savedEl) {
        savedEl.textContent = 'Sauvegardé ✓';
        setTimeout(() => { savedEl.textContent = ''; }, 2500);
      }
    })
    .catch(() => { if (savedEl) savedEl.textContent = ''; });
  }, 1200);
}

// ─── Validation activité via AJAX ─────────────────────────
document.querySelectorAll('.mod-validate-form').forEach(function(form) {
  form.addEventListener('submit', function(e) {
    e.preventDefault();
    const idx    = form.getAttribute('data-idx');
    const slug   = form.getAttribute('action').split('/module/')[1].split('/activity/')[0];
    const notes  = document.getElementById('notes-' + idx)?.value || '';
    const btn    = form.querySelector('.mod-btn-validate');

    fetch(form.getAttribute('action'), {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || '',
        'Accept': 'application/json',
      },
      body: JSON.stringify({ notes }),
    })
    .then(r => r.json())
    .then(d => {
      if (d.ok) {
        const activity = document.getElementById('activity-' + idx);
        activity?.classList.add('is-done');
        if (btn) {
          btn.classList.add('is-done');
          btn.innerHTML = '✓ Activité validée';
        }
        // Mettre à jour compteur + barre
        updateProgress();
        // Ouvrir la prochaine activité non terminée
        setTimeout(() => {
          const next = document.querySelector('.mod-activity:not(.is-done)');
          if (next) {
            const nextIdx = next.getAttribute('data-idx');
            if (nextIdx !== null) toggleActivity(parseInt(nextIdx));
          }
        }, 400);
      }
    })
    .catch(() => form.submit()); // fallback : soumission normale
  });
});

function updateProgress() {
  const total = document.querySelectorAll('.mod-activity').length;
  const done  = document.querySelectorAll('.mod-activity.is-done').length;
  const fill  = document.querySelector('.mod-hero__progress-fill');
  const label = document.querySelector('.mod-hero__progress-label span:last-child');
  const navLbl = document.querySelector('.mod-nav__progress');
  if (fill)   fill.style.width = (total > 0 ? Math.round(done/total*100) : 0) + '%';
  if (label)  label.textContent = done + '/' + total;
  if (navLbl) navLbl.textContent = done + '/' + total + ' activités';
}

// ─── Minuteur respiration ──────────────────────────────────
const breathTimers = {};

function startBreathTimer(idx, btn) {
  if (breathTimers[idx]) {
    clearInterval(breathTimers[idx].interval);
    clearTimeout(breathTimers[idx].timeout);
    delete breathTimers[idx];
    btn.innerHTML = `<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polygon points="5 3 19 12 5 21 5 3" fill="currentColor"/></svg> Démarrer le minuteur`;
    const display = document.getElementById('breath-display-' + idx);
    if (display) display.style.display = 'none';
    return;
  }

  const display = document.getElementById('breath-display-' + idx);
  const timerEl = document.getElementById('breath-timer-' + idx);
  const phaseEl = document.getElementById('breath-phase-' + idx);
  if (!display || !timerEl) return;
  display.style.display = 'block';

  // Séquence : [durée, label] × cycle
  const sequence = [
    [5, 'Inspirez'], [5, 'Retenez'], [5, 'Expirez']
  ];

  let seqIdx = 0, remaining = sequence[0][0];

  btn.innerHTML = '⏹ Arrêter';

  function tick() {
    timerEl.textContent = remaining;
    phaseEl.textContent = sequence[seqIdx][1];

    if (remaining <= 0) {
      seqIdx = (seqIdx + 1) % sequence.length;
      remaining = sequence[seqIdx][0];
    } else {
      remaining--;
    }
  }

  tick();
  breathTimers[idx] = { interval: setInterval(tick, 1000) };
}
</script>
@endsection
