@extends('frontend.layout')

@section('pageHeading', __('Rituel Pause Souffle & BodyFlow — La Pratique Certifiée'))

@section('style')
<style>
:root {
  --vp-gold: #c9a84c;
  --vp-gold-dim: rgba(201,168,76,.18);
  --vp-dark: #0a0a0a;
  --vp-surface: #141414;
  --vp-surface2: #1c1c1c;
  --vp-text: #e8e0d0;
  --vp-muted: rgba(232,224,208,.5);
}
.vp-page { min-height:100vh; background:var(--vp-dark); color:var(--vp-text); font-family:'Segoe UI',system-ui,sans-serif; padding-bottom:5rem; }
.vp-hero { padding:4rem 2rem 3rem; text-align:center; background:radial-gradient(ellipse 80% 50% at 50% 0%,rgba(201,168,76,.12) 0%,transparent 70%),linear-gradient(180deg,#0f0800 0%,var(--vp-dark) 100%); border-bottom:1px solid var(--vp-gold-dim); }
.vp-hero__eyebrow { font-size:1.05rem; letter-spacing:.2em; text-transform:uppercase; color:var(--vp-gold); margin-bottom:1.25rem; display:flex; align-items:center; justify-content:center; gap:.75rem; }
.vp-hero__eyebrow::before,.vp-hero__eyebrow::after { content:''; flex:1; max-width:50px; height:1px; background:var(--vp-gold-dim); }
.vp-hero__title { font-size:clamp(1.8rem,4vw,2.6rem); font-weight:300; font-family:Georgia,serif; color:#fff; line-height:1.25; margin-bottom:.9rem; }
.vp-hero__title em { color:var(--vp-gold); font-style:italic; }
.vp-hero__sub { font-size:1.15rem; color:var(--vp-muted); max-width:560px; margin:0 auto 2rem; line-height:1.85; }
.vp-hero__timing { display:inline-flex; align-items:center; gap:1.5rem; background:rgba(255,255,255,.04); border:1px solid rgba(255,255,255,.08); border-radius:50px; padding:.65rem 2rem; font-size:1rem; color:var(--vp-muted); flex-wrap:wrap; justify-content:center; }
.vp-hero__timing strong { color:var(--vp-gold); }
.vp-ratio { max-width:720px; margin:2.5rem auto; padding:1.5rem 2rem; background:var(--vp-surface); border:1px solid rgba(255,255,255,.06); border-radius:14px; display:flex; gap:2rem; align-items:center; flex-wrap:wrap; }
.vp-ratio__bar { flex:1; min-width:200px; }
.vp-ratio__label { font-size:1.1rem; text-transform:uppercase; letter-spacing:.1em; color:var(--vp-muted); margin-bottom:.6rem; }
.vp-ratio__track { height:7px; background:rgba(255,255,255,.07); border-radius:4px; display:flex; overflow:hidden; }
.vp-ratio__online { height:100%; width:80%; background:linear-gradient(90deg,#3b82f6,#60a5fa); }
.vp-ratio__visio  { height:100%; width:20%; background:linear-gradient(90deg,var(--vp-gold),#e8d17a); }
.vp-ratio__leg { display:flex; gap:1.5rem; margin-top:.65rem; flex-wrap:wrap; }
.vp-ratio__leg span { font-size:1.1rem; color:var(--vp-muted); display:flex; align-items:center; gap:.4rem; }
.vp-ratio__leg i { width:8px; height:8px; border-radius:50%; flex-shrink:0; font-style:normal; display:inline-block; }
.vp-ratio__note { font-size:1rem; color:var(--vp-muted); line-height:1.75; max-width:220px; }
.vp-ratio__note strong { color:var(--vp-text); }
.vp-prog-head { max-width:720px; margin:3rem auto .5rem; padding:0 2rem; font-size:1.1rem; letter-spacing:.15em; text-transform:uppercase; color:var(--vp-gold); }
.vp-phase { max-width:720px; margin:.85rem auto; padding:0 2rem; }
.vp-phase__inner { background:var(--vp-surface); border:1px solid rgba(255,255,255,.07); border-radius:16px; overflow:hidden; }
.vp-phase__inner--gold { border-color:rgba(201,168,76,.25); background:rgba(201,168,76,.04); }
.vp-phase__inner--blue { border-color:rgba(59,130,246,.2); background:rgba(59,130,246,.04); }
.vp-phase__inner--fire { border-color:rgba(239,68,68,.25); background:rgba(239,68,68,.04); }
.vp-phase__inner--green { border-color:rgba(16,185,129,.2); background:rgba(16,185,129,.04); }
.vp-phase__top { display:flex; align-items:center; justify-content:space-between; padding:1.25rem 1.75rem; flex-wrap:wrap; gap:.75rem; }
.vp-phase__left { display:flex; align-items:center; gap:1rem; }
.vp-phase__emoji { font-size:1.5rem; line-height:1; flex-shrink:0; }
.vp-phase__num { font-size:1.05rem; text-transform:uppercase; letter-spacing:.12em; color:var(--vp-muted); margin-bottom:.2rem; }
.vp-phase__name { font-size:1rem; font-weight:700; color:#fff; }
.vp-phase__tag { font-size:1.1rem; font-weight:700; letter-spacing:.06em; padding:.3rem .85rem; border-radius:20px; white-space:nowrap; }
.vp-tag--gold { background:rgba(201,168,76,.15); color:var(--vp-gold); }
.vp-tag--blue { background:rgba(59,130,246,.15); color:#93c5fd; }
.vp-tag--red { background:rgba(239,68,68,.15); color:#fca5a5; }
.vp-tag--green { background:rgba(16,185,129,.15); color:#6ee7b7; }
.vp-phase__body { padding:0 1.75rem 1.5rem; border-top:1px solid rgba(255,255,255,.05); }
.vp-phase__subtitle { font-size:1rem; color:var(--vp-gold); font-style:italic; padding:.9rem 0 .6rem; }
.vp-phase__desc { font-size:1.1rem; color:var(--vp-muted); line-height:1.85; margin-bottom:1rem; }
.vp-box { border-radius:12px; padding:1.25rem 1.5rem; margin:.9rem 0; font-size:1.05rem; line-height:1.8; }
.vp-box--gold { background:rgba(201,168,76,.08); border:1px solid rgba(201,168,76,.2); }
.vp-box--blue { background:rgba(59,130,246,.07); border:1px solid rgba(59,130,246,.18); }
.vp-box--red  { background:rgba(239,68,68,.07); border:1px solid rgba(239,68,68,.18); }
.vp-box--dark { background:rgba(0,0,0,.3); border:1px solid rgba(255,255,255,.07); }
.vp-box__label { font-size:1.05rem; text-transform:uppercase; letter-spacing:.12em; margin-bottom:.75rem; }
.vp-box__label--gold { color:rgba(201,168,76,.8); }
.vp-box__label--blue { color:rgba(59,130,246,.8); }
.vp-box__label--red  { color:rgba(239,68,68,.8); }
.vp-steps { list-style:none; padding:0; margin:0; }
.vp-steps li { display:flex; gap:.75rem; align-items:flex-start; padding:.55rem 0; border-bottom:1px solid rgba(255,255,255,.04); font-size:1.05rem; color:var(--vp-text); line-height:1.75; }
.vp-steps li:last-child { border-bottom:none; padding-bottom:0; }
.vp-steps li .n { width:22px; height:22px; flex-shrink:0; background:rgba(201,168,76,.1); border:1px solid rgba(201,168,76,.22); border-radius:50%; font-size:1.05rem; font-weight:700; color:var(--vp-gold); display:flex; align-items:center; justify-content:center; }
.vp-bquote { border-left:3px solid var(--vp-gold); padding:.85rem 1.25rem; background:rgba(201,168,76,.06); border-radius:0 10px 10px 0; font-style:italic; font-size:1.05rem; color:rgba(232,224,208,.85); line-height:1.8; margin:.9rem 0; }
.vp-breath { display:flex; gap:.6rem; margin:.85rem 0; }
.vp-breath__step { flex:1; background:rgba(201,168,76,.08); border:1px solid rgba(201,168,76,.2); border-radius:10px; padding:.7rem .5rem; text-align:center; }
.vp-breath__step strong { display:block; font-size:1.3rem; color:var(--vp-gold); font-weight:700; }
.vp-breath__step span { font-size:1.05rem; color:var(--vp-muted); text-transform:uppercase; letter-spacing:.06em; }
.vp-big-q { max-width:720px; margin:0 auto; padding:0 2rem; }
.vp-big-q__inner { background:radial-gradient(ellipse 70% 100% at 50% 110%,rgba(239,68,68,.1),transparent 60%),linear-gradient(135deg,rgba(239,68,68,.06),rgba(201,168,76,.04)); border:1.5px solid rgba(239,68,68,.25); border-radius:18px; padding:2.5rem 2rem; text-align:center; }
.vp-big-q__label { font-size:1.05rem; text-transform:uppercase; letter-spacing:.18em; color:rgba(239,68,68,.7); margin-bottom:1.25rem; }
.vp-big-q__text { font-size:clamp(1rem,2.5vw,1.3rem); font-family:Georgia,serif; font-style:italic; color:#fff; line-height:1.65; }
.vp-big-q__text em { color:var(--vp-gold); font-style:normal; }
.vp-big-q__sub { font-size:1rem; color:var(--vp-muted); margin-top:1rem; line-height:1.7; }
.vp-temoignages { max-width:720px; margin:0 auto; padding:0 2rem; }
.vp-temo { background:var(--vp-surface); border-left:3px solid rgba(255,255,255,.12); border-radius:0 12px 12px 0; padding:1.25rem 1.5rem; margin-bottom:.85rem; }
.vp-temo__who { font-size:1.05rem; text-transform:uppercase; letter-spacing:.12em; color:var(--vp-muted); margin-bottom:.65rem; }
.vp-temo__text { font-size:1.1rem; font-family:Georgia,serif; font-style:italic; color:rgba(232,224,208,.85); line-height:1.85; }
.vp-temo__pivot { font-size:1rem; color:var(--vp-gold); margin-top:.65rem; font-style:normal; font-family:inherit; }
.vp-temo--retraite { border-left-color:rgba(59,130,246,.5); }
.vp-temo--praticien { border-left-color:var(--vp-gold); }
.vp-temo--ambassadeur { border-left-color:rgba(16,185,129,.5); }
.vp-miroir { max-width:720px; margin:2rem auto; padding:0 2rem; }
.vp-miroir__inner { background:radial-gradient(ellipse 80% 60% at 50% 100%,rgba(201,168,76,.12),transparent 65%); border:1px solid rgba(201,168,76,.3); border-radius:20px; padding:3rem 2rem; text-align:center; }
.vp-miroir__lbl { font-size:1.05rem; text-transform:uppercase; letter-spacing:.2em; color:rgba(201,168,76,.6); margin-bottom:1.75rem; }
.vp-miroir__phrase { font-size:clamp(1rem,2.2vw,1.25rem); font-family:Georgia,serif; color:#fff; line-height:1.75; max-width:520px; margin:0 auto 1.5rem; }
.vp-miroir__phrase em { color:var(--vp-gold); font-style:italic; }
.vp-miroir__souffle { font-size:1rem; color:var(--vp-muted); margin-bottom:2rem; font-style:italic; }
.vp-miroir__paths { display:flex; gap:.75rem; justify-content:center; flex-wrap:wrap; margin:2rem 0; }
.vp-miroir__path { background:rgba(255,255,255,.04); border:1px solid rgba(255,255,255,.1); border-radius:12px; padding:.85rem 1.25rem; text-decoration:none; transition:border-color .2s,transform .15s; text-align:center; min-width:130px; }
.vp-miroir__path:hover { border-color:rgba(201,168,76,.35); transform:translateY(-2px); }
.vp-miroir__path-icon { font-size:1.3rem; margin-bottom:.3rem; }
.vp-miroir__path-label { font-size:1rem; font-weight:600; color:#fff; }
.vp-miroir__path-sub { font-size:1.05rem; color:var(--vp-muted); margin-top:.15rem; }
.vp-miroir__finale { font-size:clamp(.95rem,2vw,1.1rem); font-family:Georgia,serif; font-style:italic; color:rgba(232,224,208,.7); line-height:1.9; border-top:1px solid rgba(201,168,76,.15); padding-top:1.75rem; max-width:500px; margin:0 auto; }
.vp-miroir__finale strong { color:#fff; font-style:normal; }
.vp-finale { max-width:720px; margin:3rem auto; padding:0 2rem; }
.vp-finale__inner { background:radial-gradient(ellipse 70% 80% at 50% 100%,rgba(201,168,76,.1),transparent 60%),linear-gradient(180deg,rgba(201,168,76,.05),transparent); border:1px solid rgba(201,168,76,.22); border-radius:20px; padding:3rem 2rem; text-align:center; }
.vp-finale__sym { font-size:1.5rem; opacity:.6; margin-bottom:1rem; }
.vp-finale__title { font-size:1.3rem; font-weight:300; font-family:Georgia,serif; color:#fff; line-height:1.45; margin-bottom:.9rem; }
.vp-finale__title em { color:var(--vp-gold); font-style:italic; }
.vp-finale__text { font-size:1.05rem; color:var(--vp-muted); max-width:480px; margin:0 auto 2rem; line-height:1.9; }
.vp-finale__verse { font-style:italic; font-family:Georgia,serif; color:rgba(232,224,208,.35); font-size:1rem; line-height:2; }
.vp-finale__verse em { color:rgba(201,168,76,.55); font-style:normal; }
.vp-back { max-width:720px; margin:1.5rem auto; padding:0 2rem; }
.vp-back a { font-size:1rem; color:var(--vp-muted); text-decoration:none; display:inline-flex; align-items:center; gap:.4rem; transition:color .2s; }
.vp-back a:hover { color:var(--vp-gold); }
</style>
@endsection

@section('content')
<div class="vp-page">

<div class="vp-hero">
  <div class="vp-hero__eyebrow">Pause Souffle · Formation Certifiée · 2 Rituels · Modules 00 à 12</div>
  <h1 class="vp-hero__title">
    Rituel Terra &amp; BodyFlow<br>
    <em>Deux rituels Pause Souffle. Un praticien complet.</em>
  </h1>
  <p class="vp-hero__sub">
    Ces séances closent les modules 00 à 12 par la pratique intégrale des deux rituels certifiés. Deux équipements distincts, deux logiques corporelles complémentaires. Chaque praticien maîtrise les deux, les adapte et les transmet.
  </p>

  {{-- Deux cartes rituels --}}
  <div style="display:flex;gap:1.25rem;max-width:720px;margin:2rem auto;flex-wrap:wrap;justify-content:center;">

    {{-- Rituel Terra --}}
    <div style="flex:1;min-width:280px;background:rgba(201,168,76,.05);border:1.5px solid rgba(201,168,76,.3);border-radius:18px;padding:1.75rem;text-align:left;">
      <div style="display:flex;align-items:center;gap:.5rem;margin-bottom:.65rem;">
        <span style="font-size:1rem;text-transform:uppercase;letter-spacing:.15em;color:rgba(201,168,76,.6);">Pause Souffle</span>
        <span style="font-size:1.15rem;background:rgba(201,168,76,.12);border:1px solid rgba(201,168,76,.22);color:#c9a84c;border-radius:20px;padding:.15rem .7rem;font-weight:600;">Rituel 1</span>
      </div>
      <div style="font-size:1.6rem;font-weight:700;color:#fff;letter-spacing:-.01em;margin-bottom:.25rem;">Rituel Terra</div>
      <div style="font-size:1.05rem;color:rgba(201,168,76,.6);font-style:italic;margin-bottom:1rem;">Corps vivant · Respiration &amp; Toucher · Sur futon</div>
      <div style="font-size:1.1rem;color:rgba(232,224,208,.65);line-height:1.8;margin-bottom:1.2rem;">Un futon portable — léger, compact, adaptable partout. Idéal en cabinet, au domicile ou en événement. Zéro encombrement, contrairement à une table de massage même pliante.</div>
      <div style="font-size:1rem;text-transform:uppercase;letter-spacing:.1em;color:rgba(201,168,76,.45);margin-bottom:.65rem;">Durée au choix</div>
      <div style="display:flex;gap:.4rem;flex-wrap:wrap;">
        <span style="background:rgba(201,168,76,.1);border:1px solid rgba(201,168,76,.22);border-radius:20px;padding:.32rem .9rem;font-size:1.1rem;color:#c9a84c;font-weight:600;">15 min</span>
        <span style="background:rgba(201,168,76,.1);border:1px solid rgba(201,168,76,.22);border-radius:20px;padding:.32rem .9rem;font-size:1.1rem;color:#c9a84c;font-weight:600;">30 min</span>
        <span style="background:rgba(201,168,76,.1);border:1px solid rgba(201,168,76,.22);border-radius:20px;padding:.32rem .9rem;font-size:1.1rem;color:#c9a84c;font-weight:600;">45 min</span>
        <span style="background:rgba(201,168,76,.1);border:1px solid rgba(201,168,76,.22);border-radius:20px;padding:.32rem .9rem;font-size:1.1rem;color:#c9a84c;font-weight:600;">60 min</span>
      </div>
    </div>

    {{-- BodyFlow --}}
    <div style="flex:1;min-width:280px;background:rgba(34,197,94,.04);border:1.5px solid rgba(34,197,94,.3);border-radius:18px;padding:1.75rem;text-align:left;">
      <div style="display:flex;align-items:center;gap:.5rem;margin-bottom:.65rem;">
        <span style="font-size:1rem;text-transform:uppercase;letter-spacing:.15em;color:rgba(134,239,172,.6);">Pause Souffle</span>
        <span style="font-size:1.15rem;background:rgba(34,197,94,.12);border:1px solid rgba(34,197,94,.22);color:#4ade80;border-radius:20px;padding:.15rem .7rem;font-weight:600;">Rituel 2</span>
      </div>
      <div style="font-size:1.6rem;font-weight:700;color:#fff;letter-spacing:-.01em;margin-bottom:.25rem;">BodyFlow</div>
      <div style="font-size:1.05rem;color:rgba(134,239,172,.55);font-style:italic;margin-bottom:1rem;">Corps en mouvement · Pilates &amp; Mobilité · Sur tapis</div>
      <div style="font-size:1.1rem;color:rgba(232,224,208,.65);line-height:1.8;margin-bottom:1.2rem;">Un tapis Pilates haute densité — épais, protecteur, conçu pour amortir les appuis lombaires et vertébraux. À ne pas confondre avec le tapis yoga, trop fin pour ce travail du dos.</div>
      <div style="font-size:1rem;text-transform:uppercase;letter-spacing:.1em;color:rgba(134,239,172,.4);margin-bottom:.65rem;">Durée au choix</div>
      <div style="display:flex;gap:.4rem;flex-wrap:wrap;">
        <span style="background:rgba(34,197,94,.09);border:1px solid rgba(34,197,94,.22);border-radius:20px;padding:.32rem .9rem;font-size:1.1rem;color:#4ade80;font-weight:600;">⚡ 15 min</span>
        <span style="background:rgba(34,197,94,.09);border:1px solid rgba(34,197,94,.22);border-radius:20px;padding:.32rem .9rem;font-size:1.1rem;color:#4ade80;font-weight:600;">🔥 30 min</span>
        <span style="background:rgba(34,197,94,.09);border:1px solid rgba(34,197,94,.22);border-radius:20px;padding:.32rem .9rem;font-size:1.1rem;color:#4ade80;font-weight:600;">💪 45 min</span>
        <span style="background:rgba(34,197,94,.09);border:1px solid rgba(34,197,94,.22);border-radius:20px;padding:.32rem .9rem;font-size:1.1rem;color:#4ade80;font-weight:600;">🌊 60 min</span>
      </div>
    </div>
  </div>

  {{-- Séances groupe vidéo --}}
  <div style="max-width:700px;margin:0 auto 1rem;background:rgba(59,130,246,.07);border:1.5px solid rgba(59,130,246,.28);border-radius:16px;padding:1.5rem 1.75rem;text-align:left;">
    <div style="font-size:1rem;text-transform:uppercase;letter-spacing:.15em;color:#93c5fd;margin-bottom:.9rem;">📹 Séances groupe · Vidéo dédiée · Formation Praticien &amp; Mentor uniquement</div>
    <div style="display:flex;gap:1.5rem;flex-wrap:wrap;">
      <div style="flex:1;min-width:180px;">
        <div style="font-size:1.05rem;font-weight:700;color:#fff;margin-bottom:.4rem;">Rituel Terra — 1h en groupe</div>
        <div style="font-size:1.1rem;color:rgba(232,224,208,.65);line-height:1.7;">Pratique complète du Rituel 1 en vidéo — pour ancrer chaque geste, affiner la technique et ne faire plus qu'éun avec le protocole.</div>
      </div>
      <div style="width:1px;background:rgba(59,130,246,.15);flex-shrink:0;"></div>
      <div style="flex:1;min-width:180px;">
        <div style="font-size:1.05rem;font-weight:700;color:#fff;margin-bottom:.4rem;">BodyFlow — 1h en groupe</div>
        <div style="font-size:1.1rem;color:rgba(232,224,208,.65);line-height:1.7;">Pratique complète du Rituel 2 en vidéo — même objectif : la technique disparaît, il ne reste que la présence.</div>
      </div>
    </div>
    <div style="margin-top:1rem;padding-top:.9rem;border-top:1px solid rgba(59,130,246,.12);font-size:1.05rem;color:rgba(232,224,208,.45);font-style:italic;">Suivi d'une clinique Q/R de 1h48. Ces vidéos s'adressent exclusivement aux formations Praticien Pause Souffle et Mentor — non incluses dans le parcours standard.</div>
  </div>
</div>

<div class="vp-ratio" style="flex-direction:column;gap:1.5rem;">
  <div class="vp-ratio__bar" style="width:100%;">
    <div class="vp-ratio__label">Votre formation complète · Pause Souffle</div>
    <div class="vp-ratio__track">
      <div class="vp-ratio__online"></div>
      <div class="vp-ratio__visio"></div>
    </div>
    <div class="vp-ratio__leg">
      <span><i style="background:#3b82f6;"></i> 80% en ligne — modules 00 à 12 · Théorie, anatomie, protocoles, posturologie</span>
      <span><i style="background:var(--vp-gold);"></i> 20% pratique — <strong style="color:var(--vp-text);">7h48</strong> = 1h vidéo Rituel Terra + 1h vidéo BodyFlow + 3h48 groupe live + 2h individuel</span>
    </div>
  </div>

  <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(155px,1fr));gap:.9rem;width:100%;">
    <div style="background:rgba(201,168,76,.05);border:1.5px solid rgba(201,168,76,.22);border-radius:14px;padding:1.1rem 1.2rem;">
      <div style="font-size:1.35rem;margin-bottom:.35rem;">📹</div>
      <div style="font-size:1.15rem;font-weight:700;color:#c9a84c;margin-bottom:.2rem;">1h · Vidéo</div>
      <div style="font-size:1rem;font-weight:700;color:#fff;margin-bottom:.2rem;">Rituel Terra</div>
      <div style="font-size:1rem;color:rgba(232,224,208,.5);line-height:1.55;">Groupe asynchrone · Ancrage du protocole</div>
    </div>
    <div style="background:rgba(34,197,94,.04);border:1.5px solid rgba(34,197,94,.22);border-radius:14px;padding:1.1rem 1.2rem;">
      <div style="font-size:1.35rem;margin-bottom:.35rem;">📹</div>
      <div style="font-size:1.15rem;font-weight:700;color:#4ade80;margin-bottom:.2rem;">1h · Vidéo</div>
      <div style="font-size:1rem;font-weight:700;color:#fff;margin-bottom:.2rem;">BodyFlow</div>
      <div style="font-size:1rem;color:rgba(232,224,208,.5);line-height:1.55;">Groupe asynchrone · Ne faire plus qu'un avec le mouvement</div>
    </div>
    <div style="background:rgba(59,130,246,.05);border:1.5px solid rgba(59,130,246,.22);border-radius:14px;padding:1.1rem 1.2rem;">
      <div style="font-size:1.35rem;margin-bottom:.35rem;">🎥</div>
      <div style="font-size:1.15rem;font-weight:700;color:#93c5fd;margin-bottom:.2rem;">3h48 · Live</div>
      <div style="font-size:1rem;font-weight:700;color:#fff;margin-bottom:.2rem;">Groupe · 2 Rituels</div>
      <div style="font-size:1rem;color:rgba(232,224,208,.5);line-height:1.55;">Visio en direct · Praticien &amp; Mentor · + Clinique Q/R</div>
    </div>
    <div style="background:rgba(255,255,255,.03);border:1.5px solid rgba(255,255,255,.1);border-radius:14px;padding:1.1rem 1.2rem;">
      <div style="font-size:1.35rem;margin-bottom:.35rem;">👤</div>
      <div style="font-size:1.15rem;font-weight:700;color:#fff;margin-bottom:.2rem;">2h · Live</div>
      <div style="font-size:1rem;font-weight:700;color:rgba(232,224,208,.75);margin-bottom:.2rem;">Individuel</div>
      <div style="font-size:1rem;color:rgba(232,224,208,.5);line-height:1.55;">1h Rituel Terra · 1h BodyFlow · Suivi personnalisé</div>
    </div>
  </div>

  <div style="background:rgba(139,92,246,.04);border:1px solid rgba(139,92,246,.18);border-radius:12px;padding:1rem 1.4rem;">
    <div style="font-size:1rem;text-transform:uppercase;letter-spacing:.12em;color:rgba(167,139,250,.65);margin-bottom:.5rem;">✦ Formation Mentor · Accompagnement &amp; Déploiement Terrain</div>
    <div style="font-size:1.05rem;color:rgba(232,224,208,.6);line-height:1.8;">Le Mentor n'est <strong style="color:rgba(232,224,208,.85);">pas formé à certifier</strong> — il est formé à <strong style="color:rgba(232,224,208,.85);">déployer &amp; accompagner</strong>. Sa mission : développer Pause Souffle dans les <strong style="color:rgba(167,139,250,.85);">entreprises, collectivités et l'Univers Présence</strong>, constituer une équipe locale et intervenir lors des événements de sa région. <span style="color:rgba(167,139,250,.4);font-style:italic;">Certification exclusive JUNSPRO · Paiements &amp; visibilité gérés par JUNSPRO.</span></div>
  </div>
</div>

<div class="vp-prog-head">Rituel Terra · Pause Souffle Rituel 1 · Programme Groupe · 1h vidéo + 1h individuel sur futon</div>

{{-- PHASE 1 --}}
<div class="vp-phase">
  <div class="vp-phase__inner vp-phase__inner--blue">
    <div class="vp-phase__top">
      <div class="vp-phase__left">
        <div class="vp-phase__emoji">🤝</div>
        <div class="vp-phase__meta">
          <div class="vp-phase__num">Phase 1</div>
          <div class="vp-phase__name">La Prise de Contact</div>
        </div>
      </div>
      <span class="vp-phase__tag vp-tag--blue">15 min</span>
    </div>
    <div class="vp-phase__body">
      <div class="vp-phase__subtitle">« Avant de plonger — on se rencontre. Vraiment. »</div>
      <div class="vp-box vp-box--blue">
        <div class="vp-box__label vp-box__label--blue">Ce que vous dites en ouvrant — 60 secondes, pas plus</div>
        <div class="vp-bquote">
          "Bonjour. Je m'appelle [prénom]. Il y a [X] ans, j'ai couru très fort. Longtemps. Et un jour, quelque chose s'est arrêté — pas parce que j'avais le choix. Le Rituel Pause Souffle, ce n'est pas quelque chose que j'ai lu dans un livre. C'est quelque chose que j'ai trouvé dans ce silence. C'est pour ça que je suis là ce soir."
        </div>
        <p style="font-size:1rem;color:var(--vp-muted);margin:.75rem 0 0;line-height:1.7;"><strong style="color:var(--vp-text);">Votre vérité — pas votre CV.</strong> C'est votre seule arme ce soir. Et elle est immense.</p>
      </div>
      <div class="vp-box vp-box--dark">
        <div class="vp-box__label" style="color:rgba(255,255,255,.3);">Tour de table — un mot par personne</div>
        <ul class="vp-steps">
          <li><span class="n">1</span>Chaque participant dit son <strong>prénom</strong> + répond à : <em style="color:var(--vp-text);">"Un seul mot — pas une explication — qui décrit ce qui s'est passé en toi depuis le début de cette formation."</em></li>
          <li><span class="n">2</span>Vous accueillez chaque mot : <em style="color:rgba(232,224,208,.55);">"Merci [prénom]."</em> Silence. Puis au suivant. Aucun commentaire.</li>
          <li><span class="n">3</span>Si quelqu'un commence à expliquer : <em style="color:rgba(232,224,208,.55);">"Gardez ça — on va en avoir besoin plus tard."</em></li>
        </ul>
      </div>
    </div>
  </div>
</div>

{{-- PHASE 2 --}}
<div class="vp-phase">
  <div class="vp-phase__inner vp-phase__inner--gold">
    <div class="vp-phase__top">
      <div class="vp-phase__left">
        <div class="vp-phase__emoji">🫁</div>
        <div class="vp-phase__meta">
          <div class="vp-phase__num">Phase 2</div>
          <div class="vp-phase__name">L'Ancrage 5-5-5 Collectif</div>
        </div>
      </div>
      <span class="vp-phase__tag vp-tag--gold">10 min</span>
    </div>
    <div class="vp-phase__body">
      <div class="vp-phase__subtitle">« Ils ont fait ça seuls. Là, ensemble, ça n'a rien à voir. »</div>
      <p class="vp-phase__desc">Ce n'est pas une séance de respiration. C'est un rituel d'entrée. Il dit : <em style="color:var(--vp-text);">tout ce qui existait avant ces 2 heures peut attendre.</em> 10 minutes. Puis on plonge.</p>
      <div class="vp-box vp-box--gold">
        <div class="vp-box__label vp-box__label--gold">10 cycles guidés — voix grave, 30% plus lente qu'à l'ordinaire</div>
        <div class="vp-breath">
          <div class="vp-breath__step"><strong>5s</strong><span>Inspirer</span></div>
          <div class="vp-breath__step"><strong>5s</strong><span>Retenir</span></div>
          <div class="vp-breath__step"><strong>5s</strong><span>Expirer</span></div>
          <div class="vp-breath__step"><strong>×10</strong><span>Cycles</span></div>
        </div>
      </div>
      <div class="vp-box vp-box--dark">
        <div class="vp-box__label" style="color:rgba(255,255,255,.3);">Script exact</div>
        <ul class="vp-steps">
          <li><span class="n">1</span><strong>"Fermez les yeux. Posez les mains sur le ventre."</strong> — 10 secondes de silence. Puis commencez.</li>
          <li><span class="n">2</span>Cycles 1 à 5 : guidez chaque phase à voix basse. <em style="color:rgba(232,224,208,.55);">Inspirez… retenez… expirez…</em></li>
          <li><span class="n">3</span>Cycles 6 à 10 : guidez seulement l'inspire. Le reste appartient au silence.</li>
          <li><span class="n">4</span><em style="color:rgba(232,224,208,.55);">"Respirez normalement. Ouvrez les yeux quand vous êtes prêt(e)s."</em> — 30 secondes avant de reprendre.</li>
        </ul>
      </div>
    </div>
  </div>
</div>

{{-- PHASE 3 --}}
<div class="vp-phase">
  <div class="vp-phase__inner vp-phase__inner--fire">
    <div class="vp-phase__top">
      <div class="vp-phase__left">
        <div class="vp-phase__emoji">🔓</div>
        <div class="vp-phase__meta">
          <div class="vp-phase__num">Phase 3 — Le Coeur</div>
          <div class="vp-phase__name">Les Maux à Voix Haute</div>
        </div>
      </div>
      <span class="vp-phase__tag vp-tag--red">35 min</span>
    </div>
    <div class="vp-phase__body">
      <div class="vp-phase__subtitle">« Ce qui ne s'est jamais dit. Ce soir — si tu le veux — ça peut changer. »</div>
      <p class="vp-phase__desc">Pendant 7h15 tout était intérieur, silencieux, seul. Là, pour la première fois, quelque chose va traverser l'air de leur bouche vers les oreilles d'autres êtres humains réels. Ce passage est irréversible — c'est exactement ce que vous leur offrez.</p>
    </div>
  </div>
</div>

<div class="vp-big-q">
  <div class="vp-big-q__inner">
    <div class="vp-big-q__label">La question unique · Posée après 2 cycles de 5-5-5 silencieux</div>
    <div class="vp-big-q__text">
      "Il y a quelque chose que vous portez depuis longtemps —<br>
      quelque chose que vous n'avez jamais dit à voix haute.<br>
      <em>Pas à vos proches. Pas à votre famille.<br>
      Peut-être même jamais à vous-même.</em><br>
      Ce soir, si vous le voulez —<br>
      vous pouvez le dire ici."
    </div>
    <div class="vp-big-q__sub">Posée. Silence de 3 minutes. Caméra allumée. Vous attendez. Sans remplir le vide.</div>
  </div>
</div>

<div class="vp-phase" style="margin-top:.85rem;">
  <div class="vp-phase__inner vp-phase__inner--fire">
    <div class="vp-phase__body" style="padding-top:1.25rem;">
      <div class="vp-box vp-box--red">
        <div class="vp-box__label vp-box__label--red">Le format — aucune variation</div>
        <ul class="vp-steps">
          <li><span class="n">1</span><strong>3 min de silence</strong> après la question. Caméra allumée. Vous n'intervenez pas.</li>
          <li><span class="n">2</span>Tour de table : chaque participant dit <em style="color:var(--vp-text);">une seule phrase</em>. Directe. Sans introduction.</li>
          <li><span class="n">3</span>Après chaque phrase : 15 secondes de silence. Uniquement : <em style="color:rgba(232,224,208,.6);">"Merci. Nous vous avons entendu(e)."</em></li>
          <li><span class="n">4</span>Si quelqu'un pleure — laissez. Si quelqu'un passe — <em style="color:rgba(232,224,208,.6);">"Pas d'obligation. Votre présence ici est déjà un acte."</em></li>
        </ul>
      </div>
      <div class="vp-bquote">Jamais de conseil. Jamais de comparaison. Jamais de précipitation. Le silence tenu est l'acte de soin le plus précieux que vous puissiez offrir.</div>
    </div>
  </div>
</div>

{{-- PHASE 4 : LE RETOURNEMENT --}}
<div class="vp-prog-head" style="margin-top:2.5rem;">Phase 4 · Le Retournement · 20 min · La fin de saison</div>

<div class="vp-phase">
  <div class="vp-phase__inner vp-phase__inner--green">
    <div class="vp-phase__top">
      <div class="vp-phase__left">
        <div class="vp-phase__emoji">✦</div>
        <div class="vp-phase__meta">
          <div class="vp-phase__num">Le moment que personne n'oublie</div>
          <div class="vp-phase__name">La Question du Miroir</div>
        </div>
      </div>
      <span class="vp-phase__tag vp-tag--green">5 min</span>
    </div>
    <div class="vp-phase__body">
      <div class="vp-phase__subtitle">« Pas sur ce que vous portez. Sur ce que vous en faites. »</div>
      <div class="vp-bquote">
        "Une dernière question — et c'est la plus importante de ce soir.<br><br>
        <strong style="color:#fff;font-style:normal;">Si la personne que vous étiez au début de cette formation pouvait vous voir maintenant — qu'est-ce qu'elle ressentirait ?</strong>"
      </div>
      <p style="font-size:1.05rem;color:var(--vp-muted);line-height:1.85;margin:.5rem 0;">Tour de table. Un mot. Pas une phrase. Ces mots forment l'empreinte unique de ce groupe — elle n'existera jamais nulle part ailleurs.</p>
    </div>
  </div>
</div>

{{-- VISUALISATION --}}
<div class="vp-prog-head" style="margin-top:0;">Exercice de Visualisation · 12 min · La mise en bouche</div>

<div class="vp-temoignages">
  <p style="font-size:1.05rem;color:var(--vp-muted);line-height:1.85;margin:0 0 1.25rem;">
    Ce n'est pas une méditation. Ce n'est pas de la relaxation. C'est la première fois qu'ils vont <em style="color:var(--vp-text);">voir avec intention</em> — et c'est exactement ce que la formation va approfondir. Ce soir, c'est la graine.
  </p>

  <div class="vp-phase" style="padding:0;margin-bottom:1rem;">
    <div class="vp-phase__inner vp-phase__inner--gold">
      <div class="vp-phase__body" style="padding-top:1.25rem;">
        <div class="vp-box vp-box--gold">
          <div class="vp-box__label vp-box__label--gold">Entrée — 3 cycles 5-5-5 · Yeux fermés · 2 min</div>
          <div class="vp-bquote">"Fermez les yeux. Posez les deux mains à plat sur vos cuisses. Trois respirations — lentes — pour laisser la journée derrière vous. Ce qui reste dans la salle après ça, c'est vous. Juste vous."</div>
        </div>

        <div class="vp-box vp-box--dark" style="margin-top:.85rem;">
          <div class="vp-box__label" style="color:rgba(255,255,255,.3);">La question d'entrée · À voix posée · Puis silence</div>
          <div class="vp-bquote" style="font-size:1.15rem;color:var(--vp-text);">
            "Il y a quelque chose que vous voulez. Pas ce que vous devriez vouloir. Pas ce qu'on attend de vous. Quelque chose qui vous appartient — un projet, une relation, une version de vous-même, un endroit, un acte. Quelque chose qui, si ça existait dans votre vie dans un an, vous ferait dire : <em style="color:var(--vp-gold);">c'est pour ça que j'étais là ce soir.</em>"
          </div>
        </div>

        <div class="vp-box vp-box--dark" style="margin-top:.85rem;">
          <div class="vp-box__label" style="color:rgba(255,255,255,.3);">Script guidé · 7 min · Voix lente — pauses longues</div>
          <ul class="vp-steps">
            <li><span class="n">1</span><strong>"Voyez-vous dedans."</strong> — Pas les étapes. Pas le chemin. L'image finale. <em style="color:rgba(232,224,208,.55);">Où êtes-vous ? Que portez-vous ? Quel air respirez-vous ?</em> — 60 secondes de silence.</li>
            <li><span class="n">2</span><strong>"Regardez votre visage dans cette image."</strong> — <em style="color:rgba(232,224,208,.55);">Pas l'expression que vous montrez aux autres. Celle que vous avez quand personne ne regarde.</em> — 60 secondes de silence.</li>
            <li><span class="n">3</span><strong>"Il y a quelqu'un à côté de vous — ou devant vous — dans cette image."</strong> — <em style="color:rgba(232,224,208,.55);">Qui est là ? Que ressentent-ils ? Que vous disent-ils sans les mots ?</em> — 60 secondes de silence.</li>
            <li><span class="n">4</span><em style="color:rgba(232,224,208,.55);">"Gravez cette image. Pas pour la garder — pour savoir qu'elle existe déjà quelque part."</em> — 90 secondes de silence absolu.</li>
            <li><span class="n">5</span>3 cycles 5-5-5 silencieux. Puis : <em style="color:rgba(232,224,208,.55);">"Respirez normalement. Ouvrez les yeux quand vous êtes prêt(e)s."</em> — 30 secondes avant de reprendre.</li>
          </ul>
        </div>

        <div class="vp-box vp-box--dark" style="margin-top:.85rem;">
          <div class="vp-box__label" style="color:rgba(255,255,255,.3);">Retour · Tour de table · 1 mot ou 1 image — pas une explication</div>
          <ul class="vp-steps">
            <li><span class="n">1</span>Chaque participant dit ce qu'il a vu — <strong>un mot ou une image</strong>. Pas une interprétation. Pas un projet. L'image brute.</li>
            <li><span class="n">2</span>Après chaque réponse : <em style="color:rgba(232,224,208,.55);">"Merci."</em> Silence de 10 secondes. Puis au suivant.</li>
            <li><span class="n">3</span>Si quelqu'un ne voit rien : <em style="color:rgba(232,224,208,.55);">"Ce vide est une image aussi. Gardez-le."</em></li>
          </ul>
        </div>

        <div class="vp-bquote" style="margin-top:.85rem;">Ce que vous venez de faire en 7 minutes — voir, ressentir, graver — c'est exactement ce que nous allons apprendre à faire avec précision, avec méthode, avec puissance dans la suite de cette formation. Ce soir vous venez juste de l'effleurer.</div>
      </div>
    </div>
  </div>

  {{-- PONT : 3 CHEMINS --}}
  <div style="background:rgba(255,255,255,.03);border:1px solid rgba(255,255,255,.07);border-radius:14px;padding:1.5rem 1.75rem;text-align:center;margin-top:.85rem;">
    <p style="font-size:1.15rem;letter-spacing:.14em;text-transform:uppercase;color:rgba(201,168,76,.6);margin:0 0 1.1rem;">Aller plus loin dans ce que vous venez de vivre — trois chemins existent</p>
    <div style="display:flex;gap:.65rem;justify-content:center;flex-wrap:wrap;">
      <span style="background:rgba(59,130,246,.08);border:1px solid rgba(59,130,246,.2);border-radius:8px;padding:.45rem .9rem;font-size:1.15rem;color:#93c5fd;">🌊 La Retraite</span>
      <span style="background:rgba(201,168,76,.08);border:1px solid rgba(201,168,76,.2);border-radius:8px;padding:.45rem .9rem;font-size:1.15rem;color:var(--vp-gold);">✦ Praticien Certifié</span>
      <span style="background:rgba(16,185,129,.08);border:1px solid rgba(16,185,129,.2);border-radius:8px;padding:.45rem .9rem;font-size:1.15rem;color:#6ee7b7;">🤝 Ambassadeur</span>
    </div>
    <p style="font-size:1.15rem;color:var(--vp-muted);margin:.9rem 0 0;font-style:italic;">Aucun engagement ce soir. Juste une direction. Laissez l'image que vous venez de voir faire son chemin.</p>
  </div>
</div>

{{-- ══════════════════════════════════════════════════════════════════ --}}{{-- Rituel Terra — SÉANCE INDIVIDUELLE · 1H · PROGRAMME CORPOREL SUR FUTON --}}
{{-- ══════════════════════════════════════════════════════════════════ --}}

<div style="max-width:720px; margin:4rem auto 1.5rem; padding:0 2rem;">
  <div style="display:flex; align-items:center; gap:1rem;">
    <div style="flex:1; height:1px; background:linear-gradient(90deg,transparent,rgba(201,168,76,.35));"></div>
    <span style="font-size:1rem; font-weight:700; letter-spacing:.18em; text-transform:uppercase; color:rgba(201,168,76,.9); background:rgba(201,168,76,.07); border:1px solid rgba(201,168,76,.25); padding:.3rem 1rem; border-radius:20px; white-space:nowrap;">✦ Rituel Terra · Séance Individuelle · 1h · Sur futon</span>
    <div style="flex:1; height:1px; background:linear-gradient(90deg,rgba(201,168,76,.35),transparent);"></div>
  </div>
</div>

<div style="background:radial-gradient(ellipse 80% 50% at 50% 0%,rgba(201,168,76,.08) 0%,transparent 70%),linear-gradient(180deg,rgba(12,8,3,.9) 0%,var(--vp-dark) 100%); border-top:1px solid rgba(201,168,76,.15); border-bottom:1px solid rgba(201,168,76,.1); padding:2.5rem 2rem; text-align:center; margin-bottom:2rem;">
  <div style="font-size:1.05rem; letter-spacing:.2em; text-transform:uppercase; color:rgba(201,168,76,.55); margin-bottom:.8rem;">Respiration · Nuque & Épaules · Jambes & Pieds · Bras · Shiatsu Visage & Crâne</div>
  <h2 style="font-size:clamp(1.4rem,3vw,1.9rem); font-weight:300; font-family:Georgia,serif; color:#fff; line-height:1.35; margin-bottom:.9rem;">
    Rituel Terra —<br><em style="color:var(--vp-gold); font-style:italic;">Du souffle aux extrémités. Chaque tension libérée.</em>
  </h2>
  <p style="font-size:1.1rem; color:rgba(232,224,208,.5); max-width:540px; margin:0 auto 1.6rem; line-height:1.9;">Une séquence corporelle complète, tapis au sol, accessible à tous. De la respiration ancrée au shiatsu du visage — une heure pour traverser tout le corps, zone par zone, sans rien oublier.</p>
  <div class="vp-hero__timing" style="border-color:rgba(201,168,76,.2); background:rgba(201,168,76,.04);">
    <span>🫁 <strong style="color:var(--vp-gold);">2 min 50</strong> Respiration</span>
    <span>🧘 <strong style="color:var(--vp-gold);">12 min</strong> Nuque & Cou</span>
    <span>🦶 <strong style="color:var(--vp-gold);">12 min</strong> Jambes & Pieds</span>
    <span>💫 <strong style="color:var(--vp-gold);">12 min</strong> Bras & Torse</span>
    <span>✋ <strong style="color:var(--vp-gold);">20 min</strong> Shiatsu Visage</span>
  </div>
</div>

{{-- Timeline Rituel 1 individuel --}}
<div style="max-width:720px; margin:0 auto 2.5rem; padding:0 2rem;">
  <div style="display:grid; grid-template-columns:repeat(auto-fit,minmax(110px,1fr)); gap:.5rem;">
    @foreach([
      ['🫁','Respiration','2 min 50','5-5-5 · 11 cycles ancrés'],
      ['🧘','Nuque & Cou','12 min','Étirements + Massages'],
      ['🦶','Jambes & Pieds','12 min','Allongement + Réflexologie'],
      ['💫','Bras & Torse','12 min','Étirements croisés'],
      ['✋','Shiatsu','20 min','Visage & Crâne'],
    ] as [$ic,$nom,$dur,$desc])
    <div style="background:rgba(201,168,76,.05);border:1px solid rgba(201,168,76,.12);border-radius:12px;padding:.85rem .6rem;text-align:center;">
      <div style="font-size:1.25rem;margin-bottom:.25rem;">{{$ic}}</div>
      <div style="font-size:1rem;font-weight:700;color:var(--vp-gold);line-height:1.1;margin-bottom:.2rem;">{{$nom}}</div>
      <div style="font-size:1.05rem;font-weight:700;color:rgba(201,168,76,.45);margin-bottom:.3rem;">{{$dur}}</div>
      <div style="font-size:1.05rem;color:rgba(232,224,208,.3);line-height:1.4;">{{$desc}}</div>
    </div>
    @endforeach
  </div>
</div>

{{-- ÉTAPE 1 — RESPIRATION --}}
<div class="vp-prog-head">Étape 1 · Respiration 5-5-5 <span style="color:rgba(201,168,76,.4); font-weight:400;">· 2 min 50 · L'entrée dans le rituel</span></div>

<div class="vp-phase">
  <div class="vp-phase__inner vp-phase__inner--gold">
    <div class="vp-phase__top">
      <div class="vp-phase__left">
        <div class="vp-phase__emoji">🫁</div>
        <div class="vp-phase__meta">
          <div class="vp-phase__num">Étape 1 · Allongé sur le dos · 2 min 50</div>
          <div class="vp-phase__name">Ancrage par le Souffle — 11 cycles 5-5-5</div>
        </div>
      </div>
      <span class="vp-phase__tag vp-tag--gold">2 min 50</span>
    </div>
    <div class="vp-phase__body">
      <div class="vp-phase__subtitle">« Le rituel commence par le souffle, toujours. Pas par le corps — par le dedans. »</div>
      <p class="vp-phase__desc">En position allongée sur le tapis, ces 11 cycles de respiration 5-5-5 créent l'état intérieur dans lequel tous les étirements et massages suivants vont opérer. Un corps non ancré résiste. Un corps ancré reçoit.</p>
      <div class="vp-box vp-box--gold">
        <div class="vp-box__label vp-box__label--gold">11 cycles · 15 secondes par cycle · 2 min 45 + 5s d'entrée</div>
        <div class="vp-breath">
          <div class="vp-breath__step"><strong>5s</strong><span>Inspirer</span></div>
          <div class="vp-breath__step"><strong>5s</strong><span>Retenir</span></div>
          <div class="vp-breath__step"><strong>5s</strong><span>Expirer</span></div>
          <div class="vp-breath__step"><strong>×11</strong><span>Cycles</span></div>
        </div>
      </div>
      <div class="vp-box vp-box--dark" style="margin-top:.75rem;">
        <div class="vp-box__label" style="color:rgba(255,255,255,.3);">Position & script</div>
        <ul class="vp-steps">
          <li><span class="n">1</span>Allongé sur le dos, genoux fléchis. Une main sur le ventre, une main sur le cœur. Yeux fermés. <em style="color:rgba(232,224,208,.55);">"Sentez le tapis sous le bas de votre dos. Laissez-vous peser."</em></li>
          <li><span class="n">2</span>Cycles 1 à 5 : guidez intérieurement chaque phase (<em style="color:rgba(232,224,208,.55);">inspire… retiens… expire…</em>). Cycles 6 à 11 : le souffle guide seul, en silence.</li>
          <li><span class="n">3</span>Après le dernier cycle : 10 secondes d'immobilité complète. <em style="color:rgba(232,224,208,.55);">"Votre corps est prêt. Chaque étirement qui suit sera plus profond, plus juste."</em></li>
        </ul>
      </div>
    </div>
  </div>
</div>

{{-- ÉTAPE 2 — NUQUE & ÉPAULES --}}
<div class="vp-prog-head">Étape 2 · Nuque, Deltoïde, SCM & Omoplate <span style="color:rgba(201,168,76,.4); font-weight:400;">· 12 min</span></div>

<div class="vp-phase">
  <div class="vp-phase__inner vp-phase__inner--blue">
    <div class="vp-phase__top">
      <div class="vp-phase__left">
        <div class="vp-phase__emoji">🧘</div>
        <div class="vp-phase__meta">
          <div class="vp-phase__num">Étape 2 · Assis ou allongé · 12 min</div>
          <div class="vp-phase__name">Nuque & Épaules — Libérer le Haut du Corps</div>
        </div>
      </div>
      <span class="vp-phase__tag vp-tag--blue">12 min</span>
    </div>
    <div class="vp-phase__body">
      <div class="vp-phase__subtitle">« Le cou est la frontière entre la tête et le corps. Quand elle se libère, tout change. »</div>
      <p class="vp-phase__desc">Les tensions de nuque et d'épaules sont les archives corporelles du stress mental. Le SCM (sterno-cléido-mastoïdien) — ce muscle qui relie l'oreille à la clavicule — est souvent le plus négligé et le plus tendu. Ce bloc en libère la totalité.</p>
      <div class="vp-box vp-box--blue">
        <div class="vp-box__label vp-box__label--blue">Séquence · 5 gestes · Dans l'ordre · Douceur absolue</div>
        <ul class="vp-steps">
          <li><span class="n">1</span><strong>Étirements de la nuque · 3 min</strong> — Assis en tailleur ou sur chaise. <em style="color:rgba(232,224,208,.55);">Inclinaison droite : oreille vers épaule droite, 30s. Puis gauche, 30s. Rotation doucement droite puis gauche, 3 cercles lents dans chaque sens.</em> Toujours en expirant vers le bas. Jamais de forçage.</li>
          <li><span class="n">2</span><strong>Massage du deltoïde · 2 min par épaule</strong> — Pression circulaire avec la main opposée sur le muscle rond de l'épaule. <em style="color:rgba(232,224,208,.55);">Pression progressive : léger → moyen → profond. Cherchez les nœuds, cerclez dessus 10 fois, puis libérez.</em> Vous pouvez sentir des craquements — c'est normal, bienvenu.</li>
          <li><span class="n">3</span><strong>Massage SCM (sterno-cléido-mastoïdien) · 1 min 30 par côté</strong> — Ce muscle va de derrière l'oreille jusqu'à la clavicule. Pincez-le doucement entre pouce et index, du haut vers le bas. <em style="color:rgba(232,224,208,.55);">"Vous pouvez ressentir une légère sensibilité : c'est ce muscle qui porte votre tête depuis des années — et qu'on n'a jamais remercié."</em></li>
          <li><span class="n">4</span><strong>Massage de l'omoplate · 1 min 30 par côté</strong> — Une main glisse sur le bord interne de l'omoplate opposée, pouce remontant le long de la crête. Exercer une pression ferme, lente, de haut en bas. <em style="color:rgba(232,224,208,.55);">Rotation lente de l'épaule massée pendant la pression — les deux mouvements ensemble décrochent les adhérences fasciales profondes.</em></li>
          <li><span class="n">5</span><strong>Étirement du cou dans la longueur · 30s × 2</strong> — Asseyez-vous droit, mettez-vous en "double menton" (chin tuck) : rentrez le menton vers la gorge sans baisser la tête. <em style="color:rgba(232,224,208,.55);">"Imaginez un fil invisible qui tire le sommet de votre crâne vers le plafond. Sentez la colonne cervicale s'allonger vertèbre par vertèbre."</em> Tenez 30s. Relâchez, 10s. Reprenez.</li>
        </ul>
      </div>
      <div class="vp-bquote">Après ces 12 minutes, la nuque, les deux épaules, les SCM et les omoplates ont été travaillés. C'est 80% des tensions du haut du corps qui viennent d'être adressées. Respirez une fois. Notez la différence.</div>
    </div>
  </div>
</div>

{{-- ÉTAPE 3 — JAMBES & PIEDS --}}
<div class="vp-prog-head">Étape 3 · Jambes Longues & Pieds <span style="color:rgba(201,168,76,.4); font-weight:400;">· 12 min</span></div>

<div class="vp-phase">
  <div class="vp-phase__inner vp-phase__inner--green">
    <div class="vp-phase__top">
      <div class="vp-phase__left">
        <div class="vp-phase__emoji">🦶</div>
        <div class="vp-phase__meta">
          <div class="vp-phase__num">Étape 3 · Au sol · 12 min</div>
          <div class="vp-phase__name">Jambes & Pieds — La Base de la Pyramide</div>
        </div>
      </div>
      <span class="vp-phase__tag vp-tag--green">12 min</span>
    </div>
    <div class="vp-phase__body">
      <div class="vp-phase__subtitle">« Les pieds sont connectés à tout. Ils portent tout. Ils méritent 12 minutes. »</div>
      <p class="vp-phase__desc">En réflexologie, chaque zone du pied correspond à un organe, une glande, une région du corps. Un massage des pieds après des étirements défatigue le corps en entier — pas seulement les jambes.</p>
      <div class="vp-box" style="background:rgba(16,185,129,.06);border:1px solid rgba(16,185,129,.2);">
        <div class="vp-box__label" style="color:rgba(110,231,183,.7);">3 temps · Jambes puis pieds</div>
        <ul class="vp-steps">
          <li><span class="n" style="background:rgba(16,185,129,.1);border-color:rgba(16,185,129,.3);color:#6ee7b7;">1</span><strong>Étirement jambes dans la longueur · 45s chaque jambe</strong> — Allongé sur le dos, une jambe tendue vers le plafond, mains derrière la cuisse (ou sangle). <em style="color:rgba(232,224,208,.55);">Jambe parfaitement droite. Orteil vers vous. À chaque expir, la jambe se rapproche de la verticale de 1 degré — pas plus.</em> Répétez côté opposé. Puis les deux jambes tendues ensemble, 20s.</li>
          <li><span class="n" style="background:rgba(16,185,129,.1);border-color:rgba(16,185,129,.3);color:#6ee7b7;">2</span><strong>Rotation des chevilles · 15 tours dans chaque sens × 2 pieds</strong> — Jambes allongées. Faites tourner lentement chaque pied dans un grand cercle. <em style="color:rgba(232,224,208,.55);">Cherchez les endroits où la rotation "accroche" — le ligament ou muscle tendu — et ralentissez exactement là, 5 secondes.</em></li>
          <li><span class="n" style="background:rgba(16,185,129,.1);border-color:rgba(16,185,129,.3);color:#6ee7b7;">3</span><strong>Massage des pieds · 5 min (2 min 30 par pied)</strong> — Assis, pied sur la cuisse opposée. <em style="color:rgba(232,224,208,.55);">Pression du pouce sur la voûte plantaire, du talon vers les orteils, 3 passages. Puis : pression sur chaque orteil, légère traction, rotation. Pression forte sur le centre de la plante (plexus solaire — sous le milieu du pied) : 10 secondes.</em> L'autre pied. <em style="color:rgba(232,224,208,.55);">"Ces 2 minutes sur chaque pied valent une heure de l'état dans lequel vous êtes."</em></li>
        </ul>
      </div>
    </div>
  </div>
</div>

{{-- ÉTAPE 4 — BRAS & TORSION --}}
<div class="vp-prog-head">Étape 4 · Bras Droit, Bras Gauche & Torsion <span style="color:rgba(201,168,76,.4); font-weight:400;">· 12 min</span></div>

<div class="vp-phase">
  <div class="vp-phase__inner vp-phase__inner--gold" style="border-color:rgba(201,168,76,.35);">
    <div class="vp-phase__top">
      <div class="vp-phase__left">
        <div class="vp-phase__emoji">💫</div>
        <div class="vp-phase__meta">
          <div class="vp-phase__num">Étape 4 · Debout puis au sol · 12 min</div>
          <div class="vp-phase__name">Bras & Torsion — Croiser, Ouvrir, Revenir</div>
        </div>
      </div>
      <span class="vp-phase__tag vp-tag--gold">12 min</span>
    </div>
    <div class="vp-phase__body">
      <div class="vp-phase__subtitle">« Le bras qui passe par la tête ouvre tout ce que l'épaule gardait fermé. »</div>
      <div class="vp-box vp-box--gold">
        <div class="vp-box__label vp-box__label--gold">4 gestes · Bras droit d'abord, toujours</div>
        <ul class="vp-steps">
          <li><span class="n">1</span><strong>Étirement bras droit · 45s</strong> — Debout. Bras droit tendu vers le haut (paume en avant). Inclinez doucement vers la gauche — sentez le côté droit s'étirer de la hanche jusqu'aux doigts. <em style="color:rgba(232,224,208,.55);">Main gauche posée sur la hanche. Expirez vers le bas — ne montez pas l'épaule droite.</em></li>
          <li><span class="n">2</span><strong>Étirement bras gauche en passant par la tête · 45s</strong> — Bras gauche monte, coude plié, main derrière la nuque. Main droite attrape le coude gauche par dessus la tête. <em style="color:rgba(232,224,208,.55);">Tirez DOUCEMENT le coude vers la droite — l'étirement descend le long du triceps gauche jusqu'à l'omoplate. Tenez. Respirez.</em></li>
          <li><span class="n">3</span><strong>Torsion complète · 30s chaque côté</strong> — Debout, pieds largeur hanches. Le bras gauche part en arrière, le bras droit accompagne vers l'avant — rotation complète du buste. <em style="color:rgba(232,224,208,.55);">Les yeux suivent la main arrière jusqu'à voir ce qui est derrière soi. Bassin face avant — seul le torse tourne.</em> Puis inversé.</li>
          <li><span class="n">4</span><strong>Retour à la tête · massage de transition · 2 min</strong> — Les deux mains remontent des épaules vers la nuque, puis la base du crâne. Pression des pouces sous les os occipitaux (à la jonction nuque-crâne). <em style="color:rgba(232,224,208,.55);">"Ce point — entre la tête et le cou — est le "reset" du système nerveux. Tenez la pression 20 secondes. Expirez. Relâchez."</em></li>
        </ul>
      </div>
    </div>
  </div>
</div>

{{-- ÉTAPE 5 — SHIATSU VISAGE & CRÂNE --}}
<div class="vp-prog-head">Étape 5 · Massage Shiatsu — Visage & Crâne <span style="color:rgba(201,168,76,.4); font-weight:400;">· 20 min · La clôture du corps entier</span></div>

<div class="vp-phase">
  <div class="vp-phase__inner" style="border-color:rgba(201,168,76,.35); background:linear-gradient(135deg,rgba(201,168,76,.06),rgba(235,200,100,.03));">
    <div class="vp-phase__top">
      <div class="vp-phase__left">
        <div class="vp-phase__emoji">✋</div>
        <div class="vp-phase__meta">
          <div class="vp-phase__num">Étape 5 · Allongé ou assis · 20 min</div>
          <div class="vp-phase__name">Shiatsu Visage & Crâne — Le Soin Final</div>
        </div>
      </div>
      <span class="vp-phase__tag" style="background:rgba(201,168,76,.12);color:var(--vp-gold);">20 min</span>
    </div>
    <div class="vp-phase__body">
      <div class="vp-phase__subtitle" style="color:var(--vp-gold);">« Le visage porte tout ce qu'on ne montre pas. Le crâne porte tout ce qu'on ne dit pas. »</div>
      <p class="vp-phase__desc">Le shiatsu du visage et du crâne est l'une des pratiques les plus puissantes du soin corporel japonais. Il agit sur les méridiens, draine les sinus, détend le cuir chevelu, libère les pressions intracrâniennes légères et plonge dans un état de calme que peu de pratiques atteignent.</p>
      <div class="vp-box" style="background:rgba(201,168,76,.05);border:1px solid rgba(201,168,76,.2);">
        <div class="vp-box__label" style="color:rgba(201,168,76,.7);">6 zones · Pression + cercles + effleurages · Séquence shiatsu complète</div>
        <ul class="vp-steps">
          <li><span class="n" style="background:rgba(201,168,76,.1);border-color:rgba(201,168,76,.3);color:var(--vp-gold);">1</span><strong>Front & Sourcils · 3 min</strong> — Index et majeur des deux mains sur le front. Pression glissante du centre vers les tempes, 6 passages. Puis : pressions ponctuelles sur l'arcade sourcilière de l'intérieur vers l'extérieur — cherchez le creux entre l'os et le sourcil. <em style="color:rgba(232,224,208,.55);">Là où vous sentez une légère douleur sourde : c'est un point de tension — 10 secondes de pression douce, relâchez.</em></li>
          <li><span class="n" style="background:rgba(201,168,76,.1);border-color:rgba(201,168,76,.3);color:var(--vp-gold);">2</span><strong>Tempes · 2 min</strong> — Quatre doigts sur chaque tempe. Cercles lents, dans le sens des aiguilles, 20 rotations. Puis contre-sens, 20 rotations. Pression ferme mais sans douleur. <em style="color:rgba(232,224,208,.55);">"Les tempes sont les vannes de la pression crânienne. Les masser régulièrement prévient et soulage les céphalées."</em></li>
          <li><span class="n" style="background:rgba(201,168,76,.1);border-color:rgba(201,168,76,.3);color:var(--vp-gold);">3</span><strong>Pommettes & Sinus · 3 min</strong> — Pouces sous les pommettes, index sur les os zygomatiques. Pression vers le haut et dedans — drainant les sinus maxillaires. 5 pressions de 8 secondes. Puis : glissement du bord du nez vers l'extérieur (ailes du nez → oreilles), 4 passages. <em style="color:rgba(232,224,208,.55);">Si vous ressentez une pression ou constriction nasale : c'est le drainage. Expirez par le nez après chaque pression.</em></li>
          <li><span class="n" style="background:rgba(201,168,76,.1);border-color:rgba(201,168,76,.3);color:var(--vp-gold);">4</span><strong>Mâchoire & Oreilles · 2 min</strong> — L'articulation temporo-mandibulaire (ATM) : à l'endroit qui se creuse quand vous ouvrez la bouche. Pression douce × 5 de chaque côté. Puis : tirage doux des lobes d'oreilles vers le bas, puis vers l'extérieur, 3 fois chaque geste. <em style="color:rgba(232,224,208,.55);">"Ouvrez légèrement la bouche pendant la pression ATM — c'est là que la majorité du stress quotidien se stocke, sans qu'on s'en aperçoive."</em></li>
          <li><span class="n" style="background:rgba(201,168,76,.1);border-color:rgba(201,168,76,.3);color:var(--vp-gold);">5</span><strong>Cuir chevelu complet · 5 min</strong> — Dix doigts sur le crâne, légèrement écartés. Commencez au sommet : mouvements de friction (comme pour shampooing) en partant du centrede la tête vers les côtés, avancez zone par zone. <em style="color:rgba(232,224,208,.55);">Particulièrement : base du crâne (os occipital), vertex (sommet), et la ligne médiane d'avant en arrière. Chaque zone : 15 secondes de friction puis 5 secondes d'immobilité pour sentir la chaleur monter.</em></li>
          <li><span class="n" style="background:rgba(201,168,76,.1);border-color:rgba(201,168,76,.3);color:var(--vp-gold);">6</span><strong>Effleurage final · 5 min</strong> — Les deux paumes à plat, du front vers la nuque, lentement, 5 passages. Puis paumes sur les yeux fermés, 60 secondes d'obscurité et de chaleur. <em style="color:rgba(232,224,208,.55);">"Ne bougez pas. Laissez la chaleur de vos mains entrer dans vos yeux, votre front, votre cerveau. Rien d'autre à faire."</em> Terminez par 3 respirations 5-5-5, les paumes encore sur le visage.</li>
        </ul>
      </div>
      <div class="vp-bquote" style="border-left-color:var(--vp-gold); background:rgba(201,168,76,.04);">Respiration 5-5-5, nuque libérée, épaules relâchées, jambes allongées, pieds massés, bras étirés des deux côtés, torsion ouverte, visage détendu, crâne massé. Du souffle aux extrémités — pas une tension n'a été oubliée. C'est ça, une heure sur le tapis.</div>
    </div>
  </div>
</div>

{{-- ══════════════════════════════════════════════════════════════════ --}}{{-- BodyFlow — RITUEL 2 · DOS & CORPS COMPLET                     --}}
{{-- ══════════════════════════════════════════════════════════════════ --}}

<div style="max-width:720px; margin:4.5rem auto 1.5rem; padding:0 2rem;">
  <div style="display:flex; align-items:center; gap:1rem;">
    <div style="flex:1; height:1px; background:linear-gradient(90deg,transparent,rgba(34,197,94,.4));"></div>
    <span style="font-size:1.05rem; font-weight:700; letter-spacing:.18em; text-transform:uppercase; color:rgba(134,239,172,.85); background:rgba(34,197,94,.08); border:1px solid rgba(34,197,94,.3); padding:.3rem 1rem; border-radius:20px; white-space:nowrap;">🌿 Rituel 2 · BodyFlow · 1h individuel</span>
    <div style="flex:1; height:1px; background:linear-gradient(90deg,rgba(34,197,94,.4),transparent);"></div>
  </div>
</div>

<div style="background:radial-gradient(ellipse 80% 50% at 50% 0%,rgba(34,197,94,.1) 0%,transparent 70%),linear-gradient(180deg,#031008 0%,var(--vp-dark) 100%); border-top:1px solid rgba(34,197,94,.15); border-bottom:1px solid rgba(34,197,94,.1); padding:2.5rem 2rem; text-align:center; margin-bottom:2rem;">
  <div style="font-size:1.05rem; letter-spacing:.2em; text-transform:uppercase; color:rgba(134,239,172,.65); margin-bottom:.8rem;">
    Taïchi · Yoga · Pilates · Stretching · Méditation
  </div>
  <h2 style="font-size:clamp(1.5rem,3vw,2.1rem); font-weight:300; font-family:Georgia,serif; color:#fff; line-height:1.3; margin-bottom:.9rem;">
    BodyFlow —<br><em style="color:#4ade80; font-style:italic;">Le Dos d'abord. Le Corps entier.</em>
  </h2>
  <p style="font-size:1.1rem; color:rgba(232,224,208,.55); max-width:540px; margin:0 auto 1.5rem; line-height:1.9;">
    Soulager le dos, libérer les hanches, renforcer les abdos, retrouver l'équilibre. Un rituel fluide praticable seul ou en groupe, pour toutes les corpulences et tous les niveaux.
  </p>
  <div style="display:flex; align-items:center; justify-content:center; gap:.5rem; flex-wrap:wrap; margin-bottom:1.5rem;">
    <span style="background:rgba(34,197,94,.1); border:1px solid rgba(34,197,94,.2); border-radius:8px; padding:.35rem .9rem; font-size:1.15rem; color:#4ade80;">🥋 Taïchi</span>
    <span style="color:rgba(134,239,172,.3); font-size:1.1rem;">→</span>
    <span style="background:rgba(34,197,94,.1); border:1px solid rgba(34,197,94,.2); border-radius:8px; padding:.35rem .9rem; font-size:1.15rem; color:#4ade80;">🧘 Yoga</span>
    <span style="color:rgba(134,239,172,.3); font-size:1.1rem;">→</span>
    <span style="background:rgba(34,197,94,.1); border:1px solid rgba(34,197,94,.2); border-radius:8px; padding:.35rem .9rem; font-size:1.15rem; color:#4ade80;">🛡️ Pilates</span>
    <span style="color:rgba(134,239,172,.3); font-size:1.1rem;">→</span>
    <span style="background:rgba(34,197,94,.1); border:1px solid rgba(34,197,94,.2); border-radius:8px; padding:.35rem .9rem; font-size:1.15rem; color:#4ade80;">🌿 Stretching</span>
    <span style="color:rgba(134,239,172,.3); font-size:1.1rem;">→</span>
    <span style="background:rgba(34,197,94,.1); border:1px solid rgba(34,197,94,.2); border-radius:8px; padding:.35rem .9rem; font-size:1.15rem; color:#4ade80;">🕊️ Méditation</span>
  </div>
  <div class="vp-hero__timing" style="border-color:rgba(34,197,94,.2); background:rgba(34,197,94,.04);">
    <span>⚡ <strong style="color:#4ade80;">15 min</strong> Express</span>
    <span>🔥 <strong style="color:#4ade80;">30 min</strong> Court</span>
    <span>💪 <strong style="color:#4ade80;">45 min</strong> Complet</span>
    <span>🌊 <strong style="color:#4ade80;">60 min</strong> Profond</span>
    <span>📅 <strong style="color:#4ade80;">30 jours</strong> = zéro douleur</span>
  </div>
  <p style="margin-top:1.25rem; font-size:1.15rem; color:rgba(134,239,172,.5); font-style:italic;">Seul ou en groupe · Aucun matériel requis · Toutes corpulences · Tous niveaux</p>
</div>

{{-- Timeline 5 temps --}}
<div style="max-width:720px; margin:0 auto 2.5rem; padding:0 2rem;">
  <div style="display:grid; grid-template-columns:repeat(auto-fit,minmax(118px,1fr)); gap:.5rem;">
    @foreach([
      ['🥋','Taïchi','10 min','Échauffement · Debout'],
      ['🧘','Yoga','15 min','Hanches & Colonne'],
      ['🛡️','Pilates','10 min','Abdos & Sangle'],
      ['🌿','Stretching','10 min','Allongement'],
      ['🕊️','VisioBoard','15 min','VisioBoard 10 min · Silence 5 min'],
    ] as [$ic,$nom,$dur,$desc])
    <div style="background:rgba(34,197,94,.05);border:1px solid rgba(34,197,94,.15);border-radius:12px;padding:.85rem .6rem;text-align:center;">
      <div style="font-size:1.25rem;margin-bottom:.25rem;">{{$ic}}</div>
      <div style="font-size:1rem;font-weight:700;color:#4ade80;line-height:1.1;margin-bottom:.2rem;">{{$nom}}</div>
      <div style="font-size:1.05rem;font-weight:700;color:rgba(134,239,172,.5);margin-bottom:.3rem;">{{$dur}}</div>
      <div style="font-size:1.05rem;color:rgba(232,224,208,.3);line-height:1.4;">{{$desc}}</div>
    </div>
    @endforeach
  </div>
</div>

{{-- TEMPS 1 --}}
<div class="vp-prog-head" style="color:rgba(134,239,172,.7);">Temps 1 · Taïchi — Éveil & Ancrage <span style="color:rgba(134,239,172,.35); font-weight:400;">· Squat Large → Sol → Équilibre · 10 min</span></div>

<div class="vp-phase">
  <div class="vp-phase__inner" style="border-color:rgba(34,197,94,.25); background:rgba(34,197,94,.04);">
    <div class="vp-phase__top">
      <div class="vp-phase__left">
        <div class="vp-phase__emoji">🥋</div>
        <div class="vp-phase__meta">
          <div class="vp-phase__num">Temps 1 · Squat Large → Sol → Debout · 10 min</div>
          <div class="vp-phase__name">Taïchi — Éveiller, Ouvrir & Enraciner</div>
        </div>
      </div>
      <span class="vp-phase__tag" style="background:rgba(34,197,94,.15);color:#4ade80;">10 min</span>
    </div>
    <div class="vp-phase__body">
      <div class="vp-phase__subtitle" style="color:#4ade80;">« Le corps s'éveille depuis la terre. L'équilibre commence sous vos pieds. »</div>
      <p class="vp-phase__desc">Ce premier temps traverse trois niveaux en 10 minutes : l'ancrage profond en squat large, l'ouverture des hanches et du dos au sol, puis la légèreté de l'équilibre debout. Une réinitialisation complète avant le travail en profondeur.</p>
      <div class="vp-box" style="background:rgba(34,197,94,.06);border:1px solid rgba(34,197,94,.2);">
        <div class="vp-box__label" style="color:rgba(134,239,172,.7);">5 mouvements · Squat Large → Sol → Équilibre</div>
        <ul class="vp-steps">
          <li><span class="n" style="background:rgba(34,197,94,.1);border-color:rgba(34,197,94,.3);color:#4ade80;">1</span><strong>Enracinement en Squat Large — 1 min</strong> · Pieds à deux fois la largeur des épaules, pointes légèrement ouvertes vers l'extérieur. Genoux fléchis et alignés sur les pieds, dos droit, tête haute. Mains posées sur les cuisses. <em style="color:rgba(232,224,208,.55);">Sentez le bassin s'ouvrir naturellement sous le poids du corps. Respirez lentement dans les hanches — à chaque expir, laissez-les descendre un peu plus.</em></li>
          <li><span class="n" style="background:rgba(34,197,94,.1);border-color:rgba(34,197,94,.3);color:#4ade80;">2</span><strong>Le Passage de la Boule de Feu · × 8 de chaque côté</strong> — Restez en squat large, bassin stable. Les deux mains forment une sphère imaginaire devant vous — comme si vous teniez une boule de feu entre vos paumes. Faites pivoter le buste vers la droite en amenant doucement la boule dans cette direction, puis portez-la lentement en arc de cercle de droite à gauche en suivant la rotation du sternum, et poussez-la fermement devant vous en fin de mouvement. Revenez au centre. Alternez. <em style="color:rgba(232,224,208,.55);">"La rotation part du sternum, pas des bras. La boule ne tombe jamais — vous la portez avec une intention totale. Le bassin reste ancré."</em></li>
          <li><span class="n" style="background:rgba(34,197,94,.1);border-color:rgba(34,197,94,.3);color:#4ade80;">3</span><strong>Ouverture des Hanches — Fentes Latérales · × 8 chaque côté</strong> — Depuis le squat large, transférez lentement tout le poids sur la jambe droite. Le genou droit s'aligne sur le 3ème orteil, le talon gauche reste ancré au sol. Poussez la hanche droite vers l'extérieur et maintenez 2s. Revenez au centre, puis transférez à gauche. Gardez le dos droit tout au long. <em style="color:rgba(232,224,208,.55);">"À chaque déplacement, vous ouvrez une porte avec la hanche. Jamais par la force — par le souffle."</em></li>
          <li><span class="n" style="background:rgba(34,197,94,.1);border-color:rgba(34,197,94,.3);color:#4ade80;">4</span><strong>La Nage au Sol — Renforcement du Dos · × 8 alternances + × 4 extensions</strong> — Allongez-vous à plat ventre, bras tendus devant, front au sol, jambes jointes. Phase 1 — Nage alternée : levez le bras droit et la jambe gauche simultanément (2s), posez doucement, puis bras gauche et jambe droite. × 8 alternances. Phase 2 — Extension complète : levez les deux bras et les deux jambes ensemble, tenez 2s, redescendez lentement. × 4. <em style="color:rgba(232,224,208,.55);">"Imaginez que vous nagez en suspension au-dessus du sol. Le bas du dos se muscle sans aucune compression vertébrale. Respirez librement — ne bloquez pas l'air."</em></li>
          <li><span class="n" style="background:rgba(34,197,94,.1);border-color:rgba(34,197,94,.3);color:#4ade80;">5</span><strong>La Pause de l'Arbre — Séquence d'Équilibre · 30s chaque côté</strong> — Debout, pieds joints. Posez doucement le pied droit contre le mollet gauche (orteils pointés vers le bas). Fixez un point immobile devant vous et tenez 5s. Puis enchaînez sans poser le pied : ouvrez lentement la jambe droite sur le côté (abduction, 1s) → passez-la derrière vous → penchez le buste vers l'avant, les deux bras s'allongent comme des ailes. Tenez 3s, revenez debout. Changez de côté. <em style="color:rgba(232,224,208,.55);">"Si l'équilibre vacille, c'est le corps qui cherche son axe. Recommencez sans jugement — chaque tentative renforce."</em></li>
        </ul>
      </div>
      <div class="vp-bquote" style="border-left-color:#4ade80;">Ces 10 minutes ouvrent les hanches, renforcent le bas du dos et réveillent le sens de l'équilibre — avant même que le travail en profondeur commence.</div>
    </div>
  </div>
</div>

{{-- TEMPS 2 --}}
<div class="vp-prog-head" style="color:rgba(134,239,172,.7);">Temps 2 · Mobilité Thérapeutique — Hanches & Colonne <span style="color:rgba(134,239,172,.35); font-weight:400;">· Debout & Au sol · 15 min</span></div>

<div class="vp-phase">
  <div class="vp-phase__inner" style="border-color:rgba(34,197,94,.25); background:rgba(34,197,94,.04);">
    <div class="vp-phase__top">
      <div class="vp-phase__left">
        <div class="vp-phase__emoji">🌿</div>
        <div class="vp-phase__meta">
          <div class="vp-phase__num">Temps 2 · Debout & Au sol · 15 min</div>
          <div class="vp-phase__name">Mobilité Thérapeutique — Libérer en Profondeur</div>
        </div>
      </div>
      <span class="vp-phase__tag" style="background:rgba(34,197,94,.15);color:#4ade80;">15 min</span>
    </div>
    <div class="vp-phase__body">
      <div class="vp-phase__subtitle" style="color:#4ade80;">« Les hanches libérées, la colonne retrouve sa longueur naturelle. »</div>
      <p class="vp-phase__desc">90% des douleurs lombaires naissent dans les hanches contractées et le psoas raccourci. Ce temps travaille en douceur et en profondeur — de la Pyramide debout jusqu'à la libération au sol. 6 enchaînements fluides, adaptés à toutes les morphologies et toutes les croyances.</p>
      <div class="vp-box" style="background:rgba(34,197,94,.06);border:1px solid rgba(34,197,94,.2);">
        <div class="vp-box__label" style="color:rgba(134,239,172,.7);">6 enchaînements · Debout → Sol · Dans l'ordre · Sans forcer</div>
        <ul class="vp-steps">
          <li><span class="n" style="background:rgba(34,197,94,.1);border-color:rgba(34,197,94,.3);color:#4ade80;">1</span><strong>La Vague de la Colonne · × 8 cycles</strong> — À quatre pattes, genoux sous les hanches, poignets sous les épaules. Inspirez en creusant le dos et en levant doucement le regard ; expirez en arrondissant le dos, le menton qui descend vers la poitrine. Mouvement lent, fluide, vertèbre par vertèbre. <em style="color:rgba(232,224,208,.55);">Sentez chaque vertèbre s'articuler comme un rouage. C'est le réveil de la colonne.</em></li>
          <li><span class="n" style="background:rgba(34,197,94,.1);border-color:rgba(34,197,94,.3);color:#4ade80;">2</span><strong>La Pyramide — Allongement Dorsal · 45s</strong> — Depuis quatre pattes, reculez les deux mains, étendez les bras, relevez les fesses vers le plafond. Les deux mains et les deux pieds au sol forment un triangle parfait. Jambes semi-tendues, talons qui cherchent le sol. Tête entre les bras, regard vers le nombril. <em style="color:rgba(232,224,208,.55);">"À chaque expir, la colonne s'allonge depuis le coccyx jusqu'aux mains. Vos hanches montent. Votre dos se décompresse."</em></li>
          <li><span class="n" style="background:rgba(34,197,94,.1);border-color:rgba(34,197,94,.3);color:#4ade80;">3</span><strong>Déroulé en Planche & Descente Maîtrisée · × 3</strong> — Depuis La Pyramide, avancez lentement les mains pas à pas jusqu'à la position Planche haute (corps entier aligné, bras tendus). Maintenez 2s. Fléchissez les coudes collés au buste et descendez le corps au sol de façon contrôlée — lentement, sans tomber. Votre poitrine touche le sol en dernier. <em style="color:rgba(232,224,208,.55);">"Chaque descente est un exercice de contrôle total. Ce sont les triceps, les pectoraux et les abdos profonds qui travaillent ensemble."</em></li>
          <li><span class="n" style="background:rgba(34,197,94,.1);border-color:rgba(34,197,94,.3);color:#4ade80;">4</span><strong>Le Lèvement du Buste — Extension Dorsale · 30s × 2</strong> — À plat ventre, mains placées sous les épaules, coudes fléchis contre le buste. En inspirant, montez le buste uniquement avec la force des muscles du dos, les coudes restant légèrement fléchis. Regardez devant vous, épaules loin des oreilles. Version douce : coudes au sol (position Sphinx). <em style="color:rgba(232,224,208,.55);">"Ce n'est pas les bras qui soulèvent — c'est le dos. Hernie sévère : restez en Sphinx, coudes ancrés au sol."</em></li>
          <li><span class="n" style="background:rgba(34,197,94,.1);border-color:rgba(34,197,94,.3);color:#4ade80;">5</span><strong>La Fente Basse — Libération du Psoas · 60s chaque côté</strong> — Genou arrière au sol (ou sur une serviette pliée), genou avant à 90°. Bassin poussé doucement vers l'avant et vers le bas. Les deux mains sur la cuisse avant pour le soutien. <em style="color:rgba(232,224,208,.55);">"À chaque expir, un millimètre de plus — jamais par la force. Le psoas se rend. La hanche s'ouvre."</em></li>
          <li><span class="n" style="background:rgba(34,197,94,.1);border-color:rgba(34,197,94,.3);color:#4ade80;">6</span><strong>La Torsion Libératrice · 45s chaque côté</strong> — Sur le dos, ramenez le genou droit sur la poitrine, puis basculez-le doucement vers la gauche, le bras droit s'ouvre à l'opposé. Regardez vers la droite. Respirez dans l'espace qui s'ouvre entre les côtes. Alternez. <em style="color:rgba(232,224,208,.55);">"Chaque expir creuse un peu plus la rotation. Laissez le corps trouver sa limite naturelle."</em></li>
        </ul>
      </div>
      <div class="vp-bquote" style="border-left-color:#4ade80;">De la Pyramide à la Torsion du sol, ces 15 minutes décompressent la colonne, libèrent le psoas et restaurent l'amplitude des hanches — sans aucune contrainte.</div>
    </div>
  </div>
</div>

{{-- TEMPS 3 --}}
<div class="vp-prog-head" style="color:rgba(134,239,172,.7);">Temps 3 · Pilates — Abdos & Sangle <span style="color:rgba(134,239,172,.35); font-weight:400;">· Au sol · 10 min</span></div>

<div class="vp-phase">
  <div class="vp-phase__inner" style="border-color:rgba(34,197,94,.25); background:rgba(34,197,94,.04);">
    <div class="vp-phase__top">
      <div class="vp-phase__left">
        <div class="vp-phase__emoji">🛡️</div>
        <div class="vp-phase__meta">
          <div class="vp-phase__num">Temps 3 · Au sol · 10 min</div>
          <div class="vp-phase__name">Pilates — Renforcer en Douceur</div>
        </div>
      </div>
      <span class="vp-phase__tag" style="background:rgba(34,197,94,.15);color:#4ade80;">10 min</span>
    </div>
    <div class="vp-phase__body">
      <div class="vp-phase__subtitle" style="color:#4ade80;">« Un dos fort n'est jamais seul — ses abdos profonds travaillent avec lui. »</div>
      <p class="vp-phase__desc">Zéro crunch. Zéro compression cervicale. Le Pilates thérapeutique active le transverse et les multifides — les muscles profonds qui forment la vraie ceinture lombaire naturelle. Adapté aux hernies discales légères.</p>
      <div class="vp-box" style="background:rgba(34,197,94,.06);border:1px solid rgba(34,197,94,.2);">
        <div class="vp-box__label" style="color:rgba(134,239,172,.7);">4 exercices · Lents, précis, profonds</div>
        <ul class="vp-steps">
          <li><span class="n" style="background:rgba(34,197,94,.1);border-color:rgba(34,197,94,.3);color:#4ade80;">1</span><strong>Pont fessier · × 12 · 2 séries</strong> — Allongé, genoux fléchis. Montée en 3s (vertèbre par vertèbre), tenue 2s, descente en 3s. <em style="color:rgba(232,224,208,.55);">"Serrez les fessiers comme si vous teniez une orange — sans l'écraser."</em></li>
          <li><span class="n" style="background:rgba(34,197,94,.1);border-color:rgba(34,197,94,.3);color:#4ade80;">2</span><strong>Dead bug · × 8 chaque côté</strong> — Sur le dos, bras au plafond, genoux à 90°. Descendez bras droit + jambe gauche simultanément, dos collé au sol. Alternez. <em style="color:rgba(232,224,208,.55);">Si le dos décolle → réduisez l'amplitude.</em></li>
          <li><span class="n" style="background:rgba(34,197,94,.1);border-color:rgba(34,197,94,.3);color:#4ade80;">3</span><strong>Gainage latéral doux · 20s chaque côté</strong> — Appui sur avant-bras et genou (version douce) ou pied (version complète). Corps aligné de la tête aux pieds. <em style="color:rgba(232,224,208,.55);">Respirez normalement — ne bloquez pas l'air.</em></li>
          <li><span class="n" style="background:rgba(34,197,94,.1);border-color:rgba(34,197,94,.3);color:#4ade80;">4</span><strong>Vacuum abdominal · × 5</strong> — Assis ou debout. Expirez tout, rentrez le nombril vers la colonne, tenez 5s en respirant en surface. <em style="color:rgba(232,224,208,.55);">"Ce transverse — invisible mais essentiel — est votre ceinture lombaire naturelle."</em></li>
        </ul>
      </div>
    </div>
  </div>
</div>

{{-- TEMPS 4 --}}
<div class="vp-prog-head" style="color:rgba(134,239,172,.7);">Temps 4 · Stretching — Allonger les Chaînes <span style="color:rgba(134,239,172,.35); font-weight:400;">· 10 min</span></div>

<div class="vp-phase">
  <div class="vp-phase__inner" style="border-color:rgba(34,197,94,.25); background:rgba(34,197,94,.04);">
    <div class="vp-phase__top">
      <div class="vp-phase__left">
        <div class="vp-phase__emoji">🌿</div>
        <div class="vp-phase__meta">
          <div class="vp-phase__num">Temps 4 · Sol & Debout · 10 min</div>
          <div class="vp-phase__name">Stretching — Retrouver l'Équilibre</div>
        </div>
      </div>
      <span class="vp-phase__tag" style="background:rgba(34,197,94,.15);color:#4ade80;">10 min</span>
    </div>
    <div class="vp-phase__body">
      <div class="vp-phase__subtitle" style="color:#4ade80;">« La chaîne postérieure du talon à la nuque — un seul tissu. »</div>
      <p class="vp-phase__desc">Après le renforcement, les muscles doivent être allongés. Ce stretching restaure l'équilibre musculaire et prépare le corps à la transition vers le silence de la méditation.</p>
      <div class="vp-box" style="background:rgba(34,197,94,.06);border:1px solid rgba(34,197,94,.2);">
        <div class="vp-box__label" style="color:rgba(134,239,172,.7);">4 étirements · Tenus 30 à 45s · Sans rebond</div>
        <ul class="vp-steps">
          <li><span class="n" style="background:rgba(34,197,94,.1);border-color:rgba(34,197,94,.3);color:#4ade80;">1</span><strong>Ischio-jambiers debout · 30s chaque jambe</strong> — Pied posé sur une chaise ou bord de tapis, dos droit, inclinaison légère vers l'avant. <em style="color:rgba(232,224,208,.55);">Ne rebondissez pas — tenez la sensation et respirez.</em></li>
          <li><span class="n" style="background:rgba(34,197,94,.1);border-color:rgba(34,197,94,.3);color:#4ade80;">2</span><strong>Papillon assis · 45s</strong> — Plantes des pieds collées, genoux tombent. 30s statique, puis 15s de petits battements doux. <em style="color:rgba(232,224,208,.55);">"Laissez la gravité — pas vos mains — faire le travail."</em></li>
          <li><span class="n" style="background:rgba(34,197,94,.1);border-color:rgba(34,197,94,.3);color:#4ade80;">3</span><strong>Étirement latéral debout · 30s chaque côté</strong> — Bras levé, inclinaison douce sur le côté. <em style="color:rgba(232,224,208,.55);">Sentez l'espace qui s'ouvre entre les côtes et l'épaule.</em></li>
          <li><span class="n" style="background:rgba(34,197,94,.1);border-color:rgba(34,197,94,.3);color:#4ade80;">4</span><strong>Shavasana préparatoire · 60s</strong> — Allongé sur le dos, bras légèrement écartés, paumes vers le ciel. <em style="color:rgba(232,224,208,.55);">"Le corps se pose. La séance physique est terminée. Ce qui suit appartient à autre chose."</em></li>
        </ul>
      </div>
    </div>
  </div>
</div>

{{-- TEMPS 5 --}}
<div class="vp-prog-head" style="color:rgba(134,239,172,.7);">Temps 5 · VisioBoard & Silence <span style="color:rgba(134,239,172,.35); font-weight:400;">· 15 min · Clôture du Rituel</span></div>

<div class="vp-phase">
  <div class="vp-phase__inner" style="border-color:rgba(34,197,94,.3); background:linear-gradient(135deg,rgba(34,197,94,.06),rgba(16,185,129,.04));">
    <div class="vp-phase__top">
      <div class="vp-phase__left">
        <div class="vp-phase__emoji">🕊️</div>
        <div class="vp-phase__meta">
          <div class="vp-phase__num">Temps 5 · Clôture · 15 min</div>
          <div class="vp-phase__name">VisioBoard & Moment de Silence</div>
        </div>
      </div>
      <div style="display:flex;gap:.4rem;align-items:center;">
        <span class="vp-phase__tag" style="background:rgba(34,197,94,.15);color:#4ade80;">10 min</span>
        <span class="vp-phase__tag" style="background:rgba(34,197,94,.08);color:rgba(134,239,172,.6);">+ 5 min silence</span>
      </div>
    </div>
    <div class="vp-phase__body">
      <div class="vp-phase__subtitle" style="color:#4ade80;">« Votre VisioBoard n'est pas une image — c'est une instruction donnée à votre cerveau. »</div>
      <p class="vp-phase__desc">Le tableau de visualisation ancre dans le système nerveux ce que le corps vient de libérer. 10 minutes sur votre VisioBoard, corps ouvert et détendu, puis 5 minutes de silence total — la séquence qui transforme une séance physique en rituel de transformation durable.</p>

      <div class="vp-box" style="background:rgba(34,197,94,.06);border:1px solid rgba(34,197,94,.2);margin-bottom:.85rem;">
        <div class="vp-box__label" style="color:rgba(134,239,172,.7);">🖼️ Votre VisioBoard · 10 minutes · Tableau de visualisation</div>
        <ul class="vp-steps">
          <li><span class="n" style="background:rgba(34,197,94,.1);border-color:rgba(34,197,94,.3);color:#4ade80;">1</span><strong>Entrée en conscience · 3 respirations 5-5-5</strong> — Allongé ou assis en tailleur, yeux fermés. Laissez vos épaules descendre, relâchez le visage. <em style="color:rgba(232,224,208,.55);">"Votre corps vient de travailler pour vous. Maintenant c'est votre vision qui prend le relais."</em></li>
          <li><span class="n" style="background:rgba(34,197,94,.1);border-color:rgba(34,197,94,.3);color:#4ade80;">2</span><strong>Parcourez votre VisioBoard · 5 min</strong> — Image par image. Mot par mot. <em style="color:rgba(232,224,208,.55);">"Habitez chaque image comme si elle était déjà réelle. Où êtes-vous dans cette vie ? Que sentez-vous dans votre corps maintenant que chaque tension a été libérée ?"</em> Silence de 30 à 60 secondes après chaque image forte.</li>
          <li><span class="n" style="background:rgba(34,197,94,.1);border-color:rgba(34,197,94,.3);color:#4ade80;">3</span><strong>L'ancrage final · 2 min</strong> — Choisissez l'image la plus puissante. Celle qui accélère légèrement le cœur. <em style="color:rgba(232,224,208,.55);">"Gravez cette image dans l'état exact dans lequel vous êtes : dos libre, nuque allongée, pieds enracinés. Cette connexion corps-vision — c'est votre carburant pour les prochains jours."</em></li>
        </ul>
      </div>

      <div class="vp-box" style="background:rgba(16,185,129,.04);border:1px solid rgba(34,197,94,.15);">
        <div class="vp-box__label" style="color:rgba(134,239,172,.6);">∞ Moment de Silence Absolu · 5 minutes</div>
        <div style="text-align:center;padding:1rem 0;">
          <div style="font-size:1.8rem;margin-bottom:.6rem;opacity:.5;">· · ·</div>
          <p style="font-size:1.1rem;color:rgba(232,224,208,.5);max-width:440px;margin:0 auto;line-height:2;font-style:italic;">Aucun guidage. Aucune instruction.<br>Aucun son. 5 minutes entières.<br>Ce silence appartient entièrement à chacun.</p>
          <div style="font-size:1.8rem;margin-top:.6rem;opacity:.5;">· · ·</div>
        </div>
        <p style="font-size:1.15rem;color:rgba(134,239,172,.4);margin:.5rem 0 0;text-align:center;font-style:italic;">À la sortie du silence : <em style="color:rgba(232,224,208,.6);">"Respirez doucement. Bougez les doigts, les orteils. Revenez dans la pièce à votre rythme."</em></p>
      </div>

      <div class="vp-bquote" style="border-left-color:#4ade80; background:rgba(34,197,94,.05);">60 minutes. Taïchi pour éveiller, Yoga pour libérer, Pilates pour renforcer, Stretching pour allonger, VisioBoard pour programmer, Silence pour intégrer. Pratiqué chaque semaine pendant 30 jours : zéro douleur, corps aligné, vision ancrée dans chaque cellule.</div>
    </div>
  </div>
</div>

{{-- Récap programme --}}
<div style="max-width:720px; margin:2rem auto 3rem; padding:0 2rem;">
  <div style="background:linear-gradient(135deg,rgba(34,197,94,.08),rgba(16,185,129,.04)); border:1px solid rgba(34,197,94,.25); border-radius:16px; padding:2rem; text-align:center;">
    <div style="font-size:1.05rem; letter-spacing:.18em; text-transform:uppercase; color:rgba(134,239,172,.65); margin-bottom:1rem;">BodyFlow · 60 min · Le programme complet</div>
    <div style="display:grid; grid-template-columns:repeat(auto-fit,minmax(175px,1fr)); gap:.75rem; margin-bottom:1.25rem; text-align:left;">
      @foreach([
        ['🥋','Taïchi debout','10 min','Échauffement · Alignement · Circulation'],
        ['🧘','Yoga au sol','15 min','Hanches · Colonne · Chaînes postérieures'],
        ['🛡️','Pilates abdos','10 min','Sangle · Transverse · Stabilisation'],
        ['🌿','Stretching','10 min','Allongement · Récupération · Équilibre'],
        ['🕊️','VisioBoard','15 min','VisioBoard 10 min · Silence 5 min'],
      ] as [$ic,$nom,$dur,$desc])
      <div style="background:rgba(0,0,0,.2); border:1px solid rgba(34,197,94,.12); border-radius:10px; padding:.85rem 1rem; display:flex; align-items:center; gap:.75rem;">
        <span style="font-size:1.3rem; flex-shrink:0;">{{$ic}}</span>
        <div>
          <div style="font-size:1rem; font-weight:700; color:#4ade80;">{{$nom}}</div>
          <div style="font-size:1.05rem; color:rgba(134,239,172,.5); margin:.1rem 0;">{{$dur}}</div>
          <div style="font-size:1.05rem; color:rgba(232,224,208,.35); line-height:1.4;">{{$desc}}</div>
        </div>
      </div>
      @endforeach
    </div>
    <p style="font-size:1rem; color:rgba(232,224,208,.4); font-style:italic; margin:0;">Seul ou en groupe · Aucun matériel · Toutes corpulences · Tous niveaux</p>
  </div>
</div>

{{-- LE MIROIR FINAL --}}
<div class="vp-miroir">
  <div class="vp-miroir__inner">
    <div class="vp-miroir__lbl">La clôture · Le dernier souffle · La phrase finale</div>
    <div class="vp-miroir__phrase">
      3 cycles de 5-5-5 collectifs. En silence.<br>
      Les yeux fermés. Ensemble.<br>
      Pour la dernière fois ce soir.
    </div>
    <div class="vp-miroir__souffle">Guidez doucement. 30 secondes de silence absolu après le dernier cycle avant de parler.</div>
    <div class="vp-miroir__paths">
      <a href="{{ route('presence.retraite') }}" class="vp-miroir__path" style="border-color:rgba(59,130,246,.2);">
        <div class="vp-miroir__path-icon">🌊</div>
        <div class="vp-miroir__path-label">La Retraite</div>
        <div class="vp-miroir__path-sub">7 jours · Méditerranée</div>
      </a>
      <a href="{{ route('presence.formation-praticien') }}" class="vp-miroir__path" style="border-color:rgba(201,168,76,.2);">
        <div class="vp-miroir__path-icon">✦</div>
        <div class="vp-miroir__path-label">Praticien Certifié</div>
        <div class="vp-miroir__path-sub">Guider les autres</div>
      </a>
      <a href="{{ route('presence.ambassadeurs') }}" class="vp-miroir__path" style="border-color:rgba(16,185,129,.2);">
        <div class="vp-miroir__path-icon">🤝</div>
        <div class="vp-miroir__path-label">Ambassadeur</div>
        <div class="vp-miroir__path-sub">Transmettre</div>
      </a>
    </div>
    <div class="vp-miroir__finale">
      La dernière phrase — la seule chose que vous dites pour fermer :<br><br>
      <strong>"Je ne vous demande rien ce soir.<br>
      Rentrez chez vous. Regardez quelqu'un que vous aimez.<br>
      Et demandez-vous : est-ce qu'il ou elle mérite ce que vous venez de vivre ?<br>
      Cette réponse sera votre boussole."</strong>
    </div>
  </div>
</div>

{{-- FINALE --}}
<div class="vp-finale">
  <div class="vp-finale__inner">
    <div class="vp-finale__sym">∞+</div>
    <h2 class="vp-finale__title">
      Comme la fin d'une saison<br>
      <em>qui s'arrête au moment où on brûle d'envie de voir la suite</em>
    </h2>
    <p class="vp-finale__text">
      Ils ne repartent pas avec une conclusion. Ils repartent avec une vérité dite à voix haute, une image qu'ils ont vue eux-mêmes et que personne ne peut effacer — et une question posée à quelqu'un qu'ils aiment. Le générique commence. La suite est déjà là.
    </p>
    <div class="vp-finale__verse">
      J'ai couru très longtemps.<br>
      J'ai tout arrêté.<br>
      Et c'est là que j'ai tout trouvé —<br>
      <em>et infiniment plus.</em>
    </div>
  </div>
</div>

<div class="vp-back">
  <a href="{{ route('formation.dashboard') }}">
    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M19 12H5M5 12l7-7M5 12l7 7"/></svg>
    Retour à mon espace formation
  </a>
</div>

</div>
@endsection
