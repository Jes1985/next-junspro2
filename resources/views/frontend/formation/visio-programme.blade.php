@extends('frontend.layout')

@section('pageHeading', __('Séance Visio — Rituel sur Tapis'))

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
.vp-hero__eyebrow { font-size:.68rem; letter-spacing:.2em; text-transform:uppercase; color:var(--vp-gold); margin-bottom:1.25rem; display:flex; align-items:center; justify-content:center; gap:.75rem; }
.vp-hero__eyebrow::before,.vp-hero__eyebrow::after { content:''; flex:1; max-width:50px; height:1px; background:var(--vp-gold-dim); }
.vp-hero__title { font-size:clamp(1.8rem,4vw,2.6rem); font-weight:300; font-family:Georgia,serif; color:#fff; line-height:1.25; margin-bottom:.9rem; }
.vp-hero__title em { color:var(--vp-gold); font-style:italic; }
.vp-hero__sub { font-size:.95rem; color:var(--vp-muted); max-width:560px; margin:0 auto 2rem; line-height:1.85; }
.vp-hero__timing { display:inline-flex; align-items:center; gap:1.5rem; background:rgba(255,255,255,.04); border:1px solid rgba(255,255,255,.08); border-radius:50px; padding:.65rem 2rem; font-size:.8rem; color:var(--vp-muted); flex-wrap:wrap; justify-content:center; }
.vp-hero__timing strong { color:var(--vp-gold); }
.vp-ratio { max-width:720px; margin:2.5rem auto; padding:1.5rem 2rem; background:var(--vp-surface); border:1px solid rgba(255,255,255,.06); border-radius:14px; display:flex; gap:2rem; align-items:center; flex-wrap:wrap; }
.vp-ratio__bar { flex:1; min-width:200px; }
.vp-ratio__label { font-size:.7rem; text-transform:uppercase; letter-spacing:.1em; color:var(--vp-muted); margin-bottom:.6rem; }
.vp-ratio__track { height:7px; background:rgba(255,255,255,.07); border-radius:4px; display:flex; overflow:hidden; }
.vp-ratio__online { height:100%; width:80%; background:linear-gradient(90deg,#3b82f6,#60a5fa); }
.vp-ratio__visio  { height:100%; width:20%; background:linear-gradient(90deg,var(--vp-gold),#e8d17a); }
.vp-ratio__leg { display:flex; gap:1.5rem; margin-top:.65rem; flex-wrap:wrap; }
.vp-ratio__leg span { font-size:.73rem; color:var(--vp-muted); display:flex; align-items:center; gap:.4rem; }
.vp-ratio__leg i { width:8px; height:8px; border-radius:50%; flex-shrink:0; font-style:normal; display:inline-block; }
.vp-ratio__note { font-size:.83rem; color:var(--vp-muted); line-height:1.75; max-width:220px; }
.vp-ratio__note strong { color:var(--vp-text); }
.vp-prog-head { max-width:720px; margin:3rem auto .5rem; padding:0 2rem; font-size:.7rem; letter-spacing:.15em; text-transform:uppercase; color:var(--vp-gold); }
.vp-phase { max-width:720px; margin:.85rem auto; padding:0 2rem; }
.vp-phase__inner { background:var(--vp-surface); border:1px solid rgba(255,255,255,.07); border-radius:16px; overflow:hidden; }
.vp-phase__inner--gold { border-color:rgba(201,168,76,.25); background:rgba(201,168,76,.04); }
.vp-phase__inner--blue { border-color:rgba(59,130,246,.2); background:rgba(59,130,246,.04); }
.vp-phase__inner--fire { border-color:rgba(239,68,68,.25); background:rgba(239,68,68,.04); }
.vp-phase__inner--green { border-color:rgba(16,185,129,.2); background:rgba(16,185,129,.04); }
.vp-phase__top { display:flex; align-items:center; justify-content:space-between; padding:1.25rem 1.75rem; flex-wrap:wrap; gap:.75rem; }
.vp-phase__left { display:flex; align-items:center; gap:1rem; }
.vp-phase__emoji { font-size:1.5rem; line-height:1; flex-shrink:0; }
.vp-phase__num { font-size:.65rem; text-transform:uppercase; letter-spacing:.12em; color:var(--vp-muted); margin-bottom:.2rem; }
.vp-phase__name { font-size:1rem; font-weight:700; color:#fff; }
.vp-phase__tag { font-size:.7rem; font-weight:700; letter-spacing:.06em; padding:.3rem .85rem; border-radius:20px; white-space:nowrap; }
.vp-tag--gold { background:rgba(201,168,76,.15); color:var(--vp-gold); }
.vp-tag--blue { background:rgba(59,130,246,.15); color:#93c5fd; }
.vp-tag--red { background:rgba(239,68,68,.15); color:#fca5a5; }
.vp-tag--green { background:rgba(16,185,129,.15); color:#6ee7b7; }
.vp-phase__body { padding:0 1.75rem 1.5rem; border-top:1px solid rgba(255,255,255,.05); }
.vp-phase__subtitle { font-size:.82rem; color:var(--vp-gold); font-style:italic; padding:.9rem 0 .6rem; }
.vp-phase__desc { font-size:.9rem; color:var(--vp-muted); line-height:1.85; margin-bottom:1rem; }
.vp-box { border-radius:12px; padding:1.25rem 1.5rem; margin:.9rem 0; font-size:.875rem; line-height:1.8; }
.vp-box--gold { background:rgba(201,168,76,.08); border:1px solid rgba(201,168,76,.2); }
.vp-box--blue { background:rgba(59,130,246,.07); border:1px solid rgba(59,130,246,.18); }
.vp-box--red  { background:rgba(239,68,68,.07); border:1px solid rgba(239,68,68,.18); }
.vp-box--dark { background:rgba(0,0,0,.3); border:1px solid rgba(255,255,255,.07); }
.vp-box__label { font-size:.68rem; text-transform:uppercase; letter-spacing:.12em; margin-bottom:.75rem; }
.vp-box__label--gold { color:rgba(201,168,76,.8); }
.vp-box__label--blue { color:rgba(59,130,246,.8); }
.vp-box__label--red  { color:rgba(239,68,68,.8); }
.vp-steps { list-style:none; padding:0; margin:0; }
.vp-steps li { display:flex; gap:.75rem; align-items:flex-start; padding:.55rem 0; border-bottom:1px solid rgba(255,255,255,.04); font-size:.875rem; color:var(--vp-text); line-height:1.75; }
.vp-steps li:last-child { border-bottom:none; padding-bottom:0; }
.vp-steps li .n { width:22px; height:22px; flex-shrink:0; background:rgba(201,168,76,.1); border:1px solid rgba(201,168,76,.22); border-radius:50%; font-size:.68rem; font-weight:700; color:var(--vp-gold); display:flex; align-items:center; justify-content:center; }
.vp-bquote { border-left:3px solid var(--vp-gold); padding:.85rem 1.25rem; background:rgba(201,168,76,.06); border-radius:0 10px 10px 0; font-style:italic; font-size:.875rem; color:rgba(232,224,208,.85); line-height:1.8; margin:.9rem 0; }
.vp-breath { display:flex; gap:.6rem; margin:.85rem 0; }
.vp-breath__step { flex:1; background:rgba(201,168,76,.08); border:1px solid rgba(201,168,76,.2); border-radius:10px; padding:.7rem .5rem; text-align:center; }
.vp-breath__step strong { display:block; font-size:1.3rem; color:var(--vp-gold); font-weight:700; }
.vp-breath__step span { font-size:.65rem; color:var(--vp-muted); text-transform:uppercase; letter-spacing:.06em; }
.vp-big-q { max-width:720px; margin:0 auto; padding:0 2rem; }
.vp-big-q__inner { background:radial-gradient(ellipse 70% 100% at 50% 110%,rgba(239,68,68,.1),transparent 60%),linear-gradient(135deg,rgba(239,68,68,.06),rgba(201,168,76,.04)); border:1.5px solid rgba(239,68,68,.25); border-radius:18px; padding:2.5rem 2rem; text-align:center; }
.vp-big-q__label { font-size:.68rem; text-transform:uppercase; letter-spacing:.18em; color:rgba(239,68,68,.7); margin-bottom:1.25rem; }
.vp-big-q__text { font-size:clamp(1rem,2.5vw,1.3rem); font-family:Georgia,serif; font-style:italic; color:#fff; line-height:1.65; }
.vp-big-q__text em { color:var(--vp-gold); font-style:normal; }
.vp-big-q__sub { font-size:.8rem; color:var(--vp-muted); margin-top:1rem; line-height:1.7; }
.vp-temoignages { max-width:720px; margin:0 auto; padding:0 2rem; }
.vp-temo { background:var(--vp-surface); border-left:3px solid rgba(255,255,255,.12); border-radius:0 12px 12px 0; padding:1.25rem 1.5rem; margin-bottom:.85rem; }
.vp-temo__who { font-size:.65rem; text-transform:uppercase; letter-spacing:.12em; color:var(--vp-muted); margin-bottom:.65rem; }
.vp-temo__text { font-size:.9rem; font-family:Georgia,serif; font-style:italic; color:rgba(232,224,208,.85); line-height:1.85; }
.vp-temo__pivot { font-size:.8rem; color:var(--vp-gold); margin-top:.65rem; font-style:normal; font-family:inherit; }
.vp-temo--retraite { border-left-color:rgba(59,130,246,.5); }
.vp-temo--praticien { border-left-color:var(--vp-gold); }
.vp-temo--ambassadeur { border-left-color:rgba(16,185,129,.5); }
.vp-miroir { max-width:720px; margin:2rem auto; padding:0 2rem; }
.vp-miroir__inner { background:radial-gradient(ellipse 80% 60% at 50% 100%,rgba(201,168,76,.12),transparent 65%); border:1px solid rgba(201,168,76,.3); border-radius:20px; padding:3rem 2rem; text-align:center; }
.vp-miroir__lbl { font-size:.65rem; text-transform:uppercase; letter-spacing:.2em; color:rgba(201,168,76,.6); margin-bottom:1.75rem; }
.vp-miroir__phrase { font-size:clamp(1rem,2.2vw,1.25rem); font-family:Georgia,serif; color:#fff; line-height:1.75; max-width:520px; margin:0 auto 1.5rem; }
.vp-miroir__phrase em { color:var(--vp-gold); font-style:italic; }
.vp-miroir__souffle { font-size:.8rem; color:var(--vp-muted); margin-bottom:2rem; font-style:italic; }
.vp-miroir__paths { display:flex; gap:.75rem; justify-content:center; flex-wrap:wrap; margin:2rem 0; }
.vp-miroir__path { background:rgba(255,255,255,.04); border:1px solid rgba(255,255,255,.1); border-radius:12px; padding:.85rem 1.25rem; text-decoration:none; transition:border-color .2s,transform .15s; text-align:center; min-width:130px; }
.vp-miroir__path:hover { border-color:rgba(201,168,76,.35); transform:translateY(-2px); }
.vp-miroir__path-icon { font-size:1.3rem; margin-bottom:.3rem; }
.vp-miroir__path-label { font-size:.8rem; font-weight:600; color:#fff; }
.vp-miroir__path-sub { font-size:.68rem; color:var(--vp-muted); margin-top:.15rem; }
.vp-miroir__finale { font-size:clamp(.95rem,2vw,1.1rem); font-family:Georgia,serif; font-style:italic; color:rgba(232,224,208,.7); line-height:1.9; border-top:1px solid rgba(201,168,76,.15); padding-top:1.75rem; max-width:500px; margin:0 auto; }
.vp-miroir__finale strong { color:#fff; font-style:normal; }
.vp-finale { max-width:720px; margin:3rem auto; padding:0 2rem; }
.vp-finale__inner { background:radial-gradient(ellipse 70% 80% at 50% 100%,rgba(201,168,76,.1),transparent 60%),linear-gradient(180deg,rgba(201,168,76,.05),transparent); border:1px solid rgba(201,168,76,.22); border-radius:20px; padding:3rem 2rem; text-align:center; }
.vp-finale__sym { font-size:1.5rem; opacity:.6; margin-bottom:1rem; }
.vp-finale__title { font-size:1.3rem; font-weight:300; font-family:Georgia,serif; color:#fff; line-height:1.45; margin-bottom:.9rem; }
.vp-finale__title em { color:var(--vp-gold); font-style:italic; }
.vp-finale__text { font-size:.88rem; color:var(--vp-muted); max-width:480px; margin:0 auto 2rem; line-height:1.9; }
.vp-finale__verse { font-style:italic; font-family:Georgia,serif; color:rgba(232,224,208,.35); font-size:.83rem; line-height:2; }
.vp-finale__verse em { color:rgba(201,168,76,.55); font-style:normal; }
.vp-back { max-width:720px; margin:1.5rem auto; padding:0 2rem; }
.vp-back a { font-size:.82rem; color:var(--vp-muted); text-decoration:none; display:inline-flex; align-items:center; gap:.4rem; transition:color .2s; }
.vp-back a:hover { color:var(--vp-gold); }
</style>
@endsection

@section('content')
<div class="vp-page">

<div class="vp-hero">
  <div class="vp-hero__eyebrow">20% de la formation · 3h en direct · Signature praticien</div>
  <h1 class="vp-hero__title">
    Rituel sur Tapis<br>
    <em>2h en groupe. 1h clinique Q/R. Un protocole adaptable 15-30-45 min.</em>
  </h1>
  <p class="vp-hero__sub">
    Cette séance clôt les modules 00 à 06 par un passage au concret: cycles respiratoires, détente cou/cervicales, jambes + massage des pieds, bras, puis tête/visage avec points de shiatsu. Chaque praticien apprend à l'adapter à sa manière.
  </p>
  <div class="vp-hero__timing">
    <span>🫁 <strong>20 min</strong> Cycles respiratoires</span>
    <span>🧠 <strong>25 min</strong> Cou & cervicales</span>
    <span>🦵 <strong>35 min</strong> Jambes + pieds</span>
    <span>💪 <strong>20 min</strong> Bras & étirements</span>
    <span>🙂 <strong>20 min</strong> Tête & visage</span>
    <span>🎓 <strong>60 min</strong> Clinique Q/R</span>
  </div>
</div>

<div class="vp-ratio">
  <div class="vp-ratio__bar">
    <div class="vp-ratio__label">Votre formation complète</div>
    <div class="vp-ratio__track">
      <div class="vp-ratio__online"></div>
      <div class="vp-ratio__visio"></div>
    </div>
    <div class="vp-ratio__leg">
      <span><i style="background:#3b82f6;"></i> 80% en ligne — modules 00 à 06</span>
      <span><i style="background:var(--vp-gold);"></i> 20% en visio — 3h (2h groupe + 1h clinique Q/R)</span>
    </div>
  </div>
  <p class="vp-ratio__note">Les 80% vous donnent la base. Ces 20% transforment la base en <strong>pratique transmissible</strong>.</p>
</div>

<div class="vp-prog-head">Programme · 2h groupe + 1h clinique Q/R</div>

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
        <p style="font-size:.8rem;color:var(--vp-muted);margin:.75rem 0 0;line-height:1.7;"><strong style="color:var(--vp-text);">Votre vérité — pas votre CV.</strong> C'est votre seule arme ce soir. Et elle est immense.</p>
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
      <p style="font-size:.85rem;color:var(--vp-muted);line-height:1.85;margin:.5rem 0;">Tour de table. Un mot. Pas une phrase. Ces mots forment l'empreinte unique de ce groupe — elle n'existera jamais nulle part ailleurs.</p>
    </div>
  </div>
</div>

{{-- VISUALISATION --}}
<div class="vp-prog-head" style="margin-top:0;">Exercice de Visualisation · 12 min · La mise en bouche</div>

<div class="vp-temoignages">
  <p style="font-size:.85rem;color:var(--vp-muted);line-height:1.85;margin:0 0 1.25rem;">
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
          <div class="vp-bquote" style="font-size:.95rem;color:var(--vp-text);">
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
    <p style="font-size:.75rem;letter-spacing:.14em;text-transform:uppercase;color:rgba(201,168,76,.6);margin:0 0 1.1rem;">Aller plus loin dans ce que vous venez de vivre — trois chemins existent</p>
    <div style="display:flex;gap:.65rem;justify-content:center;flex-wrap:wrap;">
      <span style="background:rgba(59,130,246,.08);border:1px solid rgba(59,130,246,.2);border-radius:8px;padding:.45rem .9rem;font-size:.78rem;color:#93c5fd;">🌊 La Retraite</span>
      <span style="background:rgba(201,168,76,.08);border:1px solid rgba(201,168,76,.2);border-radius:8px;padding:.45rem .9rem;font-size:.78rem;color:var(--vp-gold);">✦ Praticien Certifié</span>
      <span style="background:rgba(16,185,129,.08);border:1px solid rgba(16,185,129,.2);border-radius:8px;padding:.45rem .9rem;font-size:.78rem;color:#6ee7b7;">🤝 Ambassadeur</span>
    </div>
    <p style="font-size:.78rem;color:var(--vp-muted);margin:.9rem 0 0;font-style:italic;">Aucun engagement ce soir. Juste une direction. Laissez l'image que vous venez de voir faire son chemin.</p>
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
