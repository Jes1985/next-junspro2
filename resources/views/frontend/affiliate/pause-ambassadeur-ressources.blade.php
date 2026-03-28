@extends('frontend.layout')

@section('pageHeading', __('Ressources Ambassadeurs — Pause Souffle'))

@section('content')
<style>
  :root {
    --ps-gold: #C9A84C; --ps-gold-light: #E8C96A;
    --ps-gold-dim: rgba(201,168,76,0.15); --ps-gold-border: rgba(201,168,76,0.30);
    --ps-bg: #070712; --ps-bg-card: #0D0D20; --ps-bg-card2: #111126;
    --ps-text: rgba(228,220,208,0.88); --ps-text-dim: rgba(228,220,208,0.45);
  }
  .psr-wrap { background: var(--ps-bg); color: var(--ps-text); min-height: 100vh; padding: 100px 24px 80px; }

  /* ─── Forcer couleurs lisibles sur fond sombre — override thème global ─── */
  .psr-wrap, .psr-wrap * { color: inherit; }
  .psr-wrap p, .psr-wrap span, .psr-wrap li, .psr-wrap label, .psr-wrap small {
    color: var(--ps-text) !important;
  }
  .psr-wrap h1, .psr-wrap h2, .psr-wrap h3, .psr-wrap h4, .psr-wrap h5 {
    color: #fff !important;
  }
  .psr-wrap a:not([class]) { color: var(--ps-gold) !important; }
  .psr-wrap::before {
    content: '';
    position: fixed;
    inset: 0;
    background: var(--ps-bg);
    z-index: -1;
    pointer-events: none;
  }
  .psr-container { max-width: 1000px; margin: 0 auto; }

  .psr-header { text-align: center; margin-bottom: 60px; }
  .psr-header__badge {
    display: inline-flex; align-items: center; gap: 8px;
    font-size: 0.7rem; letter-spacing: 0.25em; text-transform: uppercase;
    color: var(--ps-gold); border: 1px solid var(--ps-gold-border);
    padding: 6px 20px; border-radius: 50px; margin-bottom: 1.5rem;
  }
  .psr-header__title { font-size: clamp(1.8rem, 4vw, 2.8rem); font-weight: 300; letter-spacing: -0.02em; margin-bottom: 1rem; }
  .psr-header__title span { color: var(--ps-gold); }
  .psr-header__sub { color: var(--ps-text-dim); font-size: 1rem; max-width: 600px; margin: 0 auto; }

  .psr-section-title {
    font-size: 0.65rem; letter-spacing: 0.3em; text-transform: uppercase;
    color: var(--ps-gold); margin-bottom: 1.5rem; padding-bottom: 0.75rem;
    border-bottom: 1px solid var(--ps-gold-border);
  }

  .psr-header__badge { color: var(--ps-gold) !important; }
  .psr-header__title { color: #fff !important; }
  .psr-header__title span { color: var(--ps-gold) !important; }
  .psr-header__sub { color: var(--ps-text-dim) !important; }
  .psr-section-title { color: var(--ps-gold) !important; }
  .psr-card__title { color: var(--ps-gold-light) !important; }
  .psr-card__text { color: var(--ps-text-dim) !important; }
  .psr-card__btn { color: var(--ps-gold) !important; }
  .psr-template__label { color: var(--ps-gold) !important; }
  .psr-template__text { color: var(--ps-text) !important; }
  .psr-template__copy { color: var(--ps-gold) !important; }
  .psr-rules li { color: var(--ps-text-dim) !important; }
  .psr-link-input { color: var(--ps-gold-light) !important; }

  /* ─── CARTES RESSOURCES ─────────── */
  .psr-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap: 1.5rem; margin-bottom: 3rem; }
  .psr-card {
    background: var(--ps-bg-card); border: 1px solid var(--ps-gold-border);
    border-radius: 14px; padding: 1.75rem;
    transition: border-color 0.2s, background 0.2s;
  }
  .psr-card:hover { border-color: var(--ps-gold); background: var(--ps-bg-card2); }
  .psr-card__icon { font-size: 1.8rem; margin-bottom: 1rem; }
  .psr-card__title { font-size: 1rem; font-weight: 500; color: var(--ps-gold-light); margin-bottom: 0.5rem; }
  .psr-card__text { font-size: 0.85rem; color: var(--ps-text-dim); line-height: 1.6; margin-bottom: 1.25rem; }
  .psr-card__btn {
    display: inline-flex; align-items: center; gap: 6px;
    font-size: 0.78rem; color: var(--ps-gold); text-decoration: none;
    border: 1px solid var(--ps-gold-border); padding: 7px 16px; border-radius: 50px;
    transition: background 0.2s;
  }
  .psr-card__btn:hover { background: var(--ps-gold-dim); }

  /* ─── TEXTES DE PARTAGE ─────────── */
  .psr-templates { display: flex; flex-direction: column; gap: 1.25rem; margin-bottom: 3rem; }
  .psr-template {
    background: var(--ps-bg-card); border: 1px solid var(--ps-gold-border);
    border-radius: 12px; padding: 1.5rem;
  }
  .psr-template__label {
    font-size: 0.65rem; letter-spacing: 0.2em; text-transform: uppercase;
    color: var(--ps-gold); margin-bottom: 0.75rem;
  }
  .psr-template__text {
    font-size: 0.88rem; color: var(--ps-text); line-height: 1.7;
    white-space: pre-line; font-style: italic; margin-bottom: 1rem;
  }
  .psr-template__copy {
    background: none; border: 1px solid var(--ps-gold-border); color: var(--ps-gold);
    padding: 6px 16px; border-radius: 50px; font-size: 0.75rem; cursor: pointer;
    transition: background 0.2s;
  }
  .psr-template__copy:hover { background: var(--ps-gold-dim); }

  /* ─── RÈGLES ─────────── */
  .psr-rules { background: var(--ps-bg-card); border: 1px solid var(--ps-gold-border); border-radius: 14px; padding: 2rem; margin-bottom: 3rem; }
  .psr-rules ul { list-style: none; padding: 0; margin: 0; display: flex; flex-direction: column; gap: 0.75rem; }
  .psr-rules li { display: flex; gap: 10px; align-items: flex-start; font-size: 0.88rem; color: var(--ps-text-dim); line-height: 1.6; }
  .psr-rules li::before { content: '✦'; color: var(--ps-gold); flex-shrink: 0; margin-top: 2px; }

  /* ─── LIEN PERSO ─────────── */
  .psr-link-box { display: flex; gap: 12px; align-items: center; background: var(--ps-bg-card); border: 1px solid var(--ps-gold-border); border-radius: 12px; padding: 1rem 1.25rem; margin-bottom: 3rem; }
  .psr-link-input { flex: 1; background: transparent; border: none; color: var(--ps-gold-light); font-size: 0.9rem; outline: none; }
  .psr-link-btn { background: var(--ps-gold); color: #070712; border: none; padding: 8px 20px; border-radius: 50px; font-size: 0.78rem; font-weight: 600; cursor: pointer; transition: background 0.2s; white-space: nowrap; }
  .psr-link-btn:hover { background: var(--ps-gold-light); }

  @media (max-width: 640px) {
    .psr-grid { grid-template-columns: 1fr; }
    .psr-link-box { flex-direction: column; align-items: stretch; }
  }
</style>

<div class="psr-wrap">
  <div class="psr-container">

    {{-- En-tête --}}
    <div class="psr-header">
      <div class="psr-header__badge">✦ Espace Ambassadeurs</div>
      <h1 class="psr-header__title">Vos <span>ressources</span> pour partager</h1>
      <p class="psr-header__sub">Tout ce dont vous avez besoin pour parler de Pause Souffle avec authenticité. Rien à inventer — partagez simplement ce que vous avez vécu.</p>
    </div>

    {{-- Lien personnel --}}
    <div class="psr-section-title">Votre lien personnel</div>
    <div x-data="{ copied: false }" class="psr-link-box" style="margin-bottom: 3rem;">
      <input class="psr-link-input" type="text" value="{{ url('/ps/' . $ambassadeur->code) }}" readonly id="psr-link-val">
      <button class="psr-link-btn" @click="navigator.clipboard.writeText('{{ url('/ps/' . $ambassadeur->code) }}').then(() => { copied = true; setTimeout(() => copied = false, 2500) })" x-text="copied ? '✓ Copié !' : 'Copier le lien'">Copier le lien</button>
    </div>

    {{-- ══════════════════════════════════════════════════════════
         MISSION DU PREMIER JOUR
    ══════════════════════════════════════════════════════════════ --}}
    <div class="psr-section-title">Votre première mission</div>
    <div style="background: linear-gradient(160deg, rgba(201,168,76,0.08) 0%, var(--ps-bg-card) 60%); border: 1.5px solid rgba(201,168,76,0.35); border-radius: 16px; padding: 2rem 2.25rem; margin-bottom: 1.5rem;">
      <div style="display: flex; gap: 1.5rem; align-items: flex-start; flex-wrap: wrap;">
        <div style="flex: 1; min-width: 260px;">
          <div style="font-size: 0.65rem; letter-spacing: 0.2em; text-transform: uppercase; color: var(--ps-gold); margin-bottom: 0.75rem;">Pas vendre. Juste partager.</div>
          <h3 style="font-size: 1.15rem; font-weight: 600; color: #fff !important; margin-bottom: 0.75rem; line-height: 1.4;">Pensez à 3 personnes<br>dans votre entourage</h3>
          <p style="font-size: 0.88rem; color: rgba(228,220,208,0.65) !important; line-height: 1.8; margin-bottom: 1rem;">
            Pas nécessairement des prospects. Des personnes à qui l'expérience Pause Souffle pourrait genuinement apporter quelque chose :
            un collègue stressé, un ami en recherche de sens, un client en transition professionnelle.
          </p>
          <p style="font-size: 0.88rem; color: rgba(228,220,208,0.65) !important; line-height: 1.8;">
            Envoyez-leur un message simple. <strong style="color: #fff !important;">Pas un pitch. Un témoignage.</strong>
          </p>
        </div>
        <div style="flex: 1; min-width: 260px; background: rgba(0,0,0,0.2); border-radius: 12px; padding: 1.25rem 1.5rem;" x-data="{ copied: false }">
          <div style="font-size: 0.65rem; letter-spacing: 0.15em; text-transform: uppercase; color: rgba(228,220,208,0.4) !important; margin-bottom: 0.75rem;">Message prêt à envoyer</div>
          <p style="font-size: 0.88rem; color: rgba(228,220,208,0.8) !important; line-height: 1.8; font-style: italic; margin-bottom: 1rem;" id="first-mission-tpl">« J'ai découvert quelque chose qui m'a vraiment aidé à retrouver de la clarté dans ma vie. Ça s'appelle Pause Souffle. Si ça te parle, voici le lien pour en savoir plus : {{ url('/ps/' . $ambassadeur->code) }} »</p>
          <button class="psr-template__copy" @click="navigator.clipboard.writeText(document.getElementById('first-mission-tpl').innerText).then(() => { copied = true; setTimeout(() => copied = false, 2500) })" x-text="copied ? '✓ Copié !' : 'Copier ce message'">Copier ce message</button>
        </div>
      </div>
    </div>

    {{-- ══════════════════════════════════════════════════════════
         ENVOI DIRECT — 3 INVITATIONS PERSONNELLES
    ══════════════════════════════════════════════════════════════ --}}
    <div x-data="{
      sent: {{ session('ps_invitations_sent') ? 'true' : 'false' }},
      sending: false,
      contacts: [
        { name: '', email: '' },
        { name: '', email: '' },
        { name: '', email: '' }
      ],
      message: `J'ai découvert quelque chose qui m'a vraiment aidé à retrouver de la clarté dans ma vie. Ça s'appelle Pause Souffle. Si ça te parle, voici le lien pour en savoir plus.`,
      hasAtLeastOne() {
        return this.contacts.some(c => c.email.trim() !== '');
      }
    }"
    style="background: var(--ps-bg-card); border: 1px solid rgba(201,168,76,0.2); border-radius: 16px; padding: 2rem 2.25rem; margin-bottom: 3rem;">

      <div style="font-size: 0.65rem; letter-spacing: 0.2em; text-transform: uppercase; color: var(--ps-gold); margin-bottom: 0.5rem;">Ou envoyez directement</div>
      <h4 style="font-size: 1.05rem; font-weight: 500; color: #fff !important; margin-bottom: 0.5rem; line-height: 1.4;">3 invitations personnalisées par email</h4>
      <p style="font-size: 0.83rem; color: rgba(228,220,208,0.5) !important; margin-bottom: 1.75rem; line-height: 1.7;">
        Renseignez les prénoms et adresses email. Chacun recevra un message signé de votre part,
        avec votre lien personnel. Vous pouvez personnaliser le message ci-dessous.
      </p>

      {{-- Message envoyé --}}
      <div x-show="sent" style="display:none; text-align: center; padding: 2rem;">
        <div style="font-size: 2rem; margin-bottom: 0.75rem;">✦</div>
        <p style="color: #C9A84C !important; font-size: 1rem; font-weight: 500; margin-bottom: 0.4rem;">Invitations envoyées</p>
        <p style="font-size: 0.83rem; color: rgba(228,220,208,0.5) !important;">Vos contacts ont reçu un email avec votre recommandation personnelle.</p>
      </div>

      {{-- Formulaire --}}
      <form x-show="!sent" action="{{ route('ps.invitations.send') }}" method="POST" @submit.prevent="
        if (!hasAtLeastOne()) return;
        sending = true;
        fetch('{{ route('ps.invitations.send') }}', {
          method: 'POST',
          headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': document.querySelector('[name=_token]').value },
          body: JSON.stringify({ contacts, message })
        }).then(r => r.json()).then(d => {
          sending = false;
          if (d.success) sent = true;
        }).catch(() => sending = false);
      ">
        @csrf

        {{-- Message personnalisé --}}
        <div style="margin-bottom: 1.5rem;">
          <label style="display: block; font-size: 0.7rem; letter-spacing: 0.15em; text-transform: uppercase; color: rgba(228,220,208,0.45) !important; margin-bottom: 0.5rem;">Votre message (personnalisable)</label>
          <textarea x-model="message" rows="3" style="width: 100%; background: rgba(0,0,0,0.25); border: 1px solid rgba(255,255,255,0.1); border-radius: 10px; padding: 12px 16px; font-size: 0.85rem; color: rgba(228,220,208,0.85); resize: vertical; line-height: 1.7; font-family: inherit;"></textarea>
        </div>

        {{-- 3 contacts --}}
        <div style="display: grid; gap: 1rem; margin-bottom: 1.5rem;">
          <template x-for="(contact, i) in contacts" :key="i">
            <div style="display: flex; gap: 0.75rem; align-items: flex-start; flex-wrap: wrap;">
              <div style="flex: 0 0 160px;">
                <label style="display: block; font-size: 0.65rem; letter-spacing: 0.15em; text-transform: uppercase; color: rgba(228,220,208,0.35) !important; margin-bottom: 4px;" :for="'contact-name-'+i">Prénom</label>
                <input :id="'contact-name-'+i" type="text" x-model="contact.name" :placeholder="'Prénom ' + (i+1)"
                  style="width: 100%; background: rgba(0,0,0,0.2); border: 1px solid rgba(255,255,255,0.08); border-radius: 8px; padding: 10px 12px; font-size: 0.85rem; color: rgba(228,220,208,0.9); font-family: inherit;">
              </div>
              <div style="flex: 1; min-width: 200px;">
                <label style="display: block; font-size: 0.65rem; letter-spacing: 0.15em; text-transform: uppercase; color: rgba(228,220,208,0.35) !important; margin-bottom: 4px;" :for="'contact-email-'+i">Email</label>
                <input :id="'contact-email-'+i" type="email" x-model="contact.email" :placeholder="'email' + (i+1) + '@exemple.com'"
                  style="width: 100%; background: rgba(0,0,0,0.2); border: 1px solid rgba(255,255,255,0.08); border-radius: 8px; padding: 10px 12px; font-size: 0.85rem; color: rgba(228,220,208,0.9); font-family: inherit;">
              </div>
            </div>
          </template>
        </div>

        <div style="display: flex; align-items: center; gap: 1rem; flex-wrap: wrap;">
          <button type="submit" :disabled="sending || !hasAtLeastOne()"
            style="display: inline-flex; align-items: center; gap: 8px; background: linear-gradient(135deg, #C9A84C, #E8C96A); color: #000; border: none; font-size: 0.82rem; font-weight: 700; letter-spacing: 0.08em; text-transform: uppercase; padding: 13px 28px; border-radius: 50px; cursor: pointer; transition: opacity 0.2s;"
            :style="(sending || !hasAtLeastOne()) ? 'opacity: 0.45; cursor: not-allowed;' : ''">
            <span x-text="sending ? 'Envoi…' : '✦ Envoyer les invitations'">✦ Envoyer les invitations</span>
          </button>
          <span style="font-size: 0.75rem; color: rgba(228,220,208,0.3) !important; font-style: italic;">
            Maximum 3 contacts · Votre lien est inclus automatiquement
          </span>
        </div>
      </form>
    </div>

    {{-- ══════════════════════════════════════════════════════════
         GUIDE DU TÉMOIGNAGE
    ══════════════════════════════════════════════════════════════ --}}
    <div class="psr-section-title">Trouver votre témoignage personnel</div>
    <div style="background: var(--ps-bg-card); border: 1px solid rgba(255,255,255,0.06); border-radius: 16px; padding: 2rem 2.25rem; margin-bottom: 3rem;">
      <p style="font-size: 0.9rem; color: rgba(228,220,208,0.65) !important; line-height: 1.9; margin-bottom: 1.5rem;">
        Votre témoignage est votre outil le plus puissant. Personne ne peut le contester — c'est votre vécu.
        Répondez mentalement à ces 4 questions, et vous aurez tout ce qu'il faut pour parler de Pause Souffle de façon authentique.
      </p>
      <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(220px,1fr)); gap: 1px; border: 1px solid rgba(255,255,255,0.05); border-radius: 12px; overflow: hidden;">
        @foreach([
          ['01', 'Avant', 'Pourquoi vous cherchiez quelque chose ? Quel était votre état d\'esprit, votre besoin, votre frustration avant de commencer ?'],
          ['02', 'La découverte', 'Qu\'est-ce qui vous a convaincu d\'essayer Pause Souffle ? Quel élément, quelle rencontre, quelle intuition ?'],
          ['03', 'Ce qui a changé', 'Qu\'est-ce que vous avez remarqué concrètement ? Dans votre quotidien, vos relations, votre façon d\'être ?'],
          ['04', 'Pour qui ?', 'À quelle personne pensez-vous spontanément quand vous parlez de Pause Souffle ? Qui dans votre entourage en aurait besoin ?'],
        ] as [$num, $label, $question])
        <div style="background: var(--ps-bg); padding: 1.5rem;">
          <div style="font-size: 2rem; font-weight: 700; color: rgba(201,168,76,0.12); line-height: 1; margin-bottom: 0.5rem;">{{ $num }}</div>
          <div style="font-size: 0.8rem; font-weight: 700; color: var(--ps-gold) !important; text-transform: uppercase; letter-spacing: 0.1em; margin-bottom: 0.6rem;">{{ $label }}</div>
          <div style="font-size: 0.82rem; color: rgba(228,220,208,0.55) !important; line-height: 1.7;">{{ $question }}</div>
        </div>
        @endforeach
      </div>
    </div>

    {{-- Kit de partage --}}
    <div class="psr-section-title">Textes de partage prêts à l'emploi</div>
    <div class="psr-templates" x-data="{ copied1: false, copied2: false, copied3: false, copied4: false, copied5: false, copied6: false, copied7: false }">

      <div class="psr-template">
        <div class="psr-template__label">🎵 TikTok — Format vidéo courte (caption)</div>
        <div class="psr-template__text" id="tpl7">J'ai découvert something qui a changé ma façon d'être dans le quotidien 🌿

Pause Souffle — un parcours sur la présence et la respiration.

Pas de la méditation classique. Quelque chose de beaucoup plus concret.

Mon lien en bio si tu veux en savoir plus → {{ url('/ps/' . $ambassadeur->code) }}

#pausesouffle #presencementale #développementpersonnel #bien-etre #transformation #respiration #mindfulness #coaching</div>
        <button class="psr-template__copy" @click="navigator.clipboard.writeText(document.getElementById('tpl7').innerText).then(() => { copied7 = true; setTimeout(() => copied7 = false, 2500) })" x-text="copied7 ? '✓ Copié' : 'Copier ce texte'">Copier ce texte</button>
      </div>

      <div class="psr-template">
        <div class="psr-template__label">💬 WhatsApp / SMS — Court et direct</div>
        <div class="psr-template__text" id="tpl1">Salut ! Tu connais Pause Souffle ? Je viens de terminer le parcours et ça m'a vraiment apporté quelque chose. Si tu cherches à retrouver un peu de clarté dans ta vie, jette un œil ici : {{ url('/ps/' . $ambassadeur->code) }}
(c'est mon lien personnel, si tu t'inscris via ce lien tu sais que c'est moi qui t'ai recommandé 🙂)</div>
        <button class="psr-template__copy" @click="navigator.clipboard.writeText(document.getElementById('tpl1').innerText).then(() => { copied1 = true; setTimeout(() => copied1 = false, 2500) })" x-text="copied1 ? '✓ Copié' : 'Copier ce texte'">Copier ce texte</button>
      </div>

      <div class="psr-template">
        <div class="psr-template__label">📱 Instagram / Facebook — Format post</div>
        <div class="psr-template__text" id="tpl2">J'ai traversé quelque chose d'assez transformateur ces derniers mois.

Ça s'appelle Pause Souffle — un parcours centré sur la présence, la respiration et la clarté intérieure.

Ce que j'ai retenu : ce n'est pas une technique. C'est un chemin vers plus d'attention, dans tous les sens du terme.

Si tu cherches à retrouver de l'espace dans ta vie, le lien est dans ma bio.
→ {{ url('/ps/' . $ambassadeur->code) }}</div>
        <button class="psr-template__copy" @click="navigator.clipboard.writeText(document.getElementById('tpl2').innerText).then(() => { copied2 = true; setTimeout(() => copied2 = false, 2500) })" x-text="copied2 ? '✓ Copié' : 'Copier ce texte'">Copier ce texte</button>
      </div>

      <div class="psr-template">
        <div class="psr-template__label">💼 LinkedIn — Format professionnel</div>
        <div class="psr-template__text" id="tpl3">J'ai suivi un parcours qui a changé quelque chose dans ma façon d'aborder le travail et les relations.

Pause Souffle n'est pas une formation de développement personnel classique. C'est un travail profond sur la présence et la qualité de l'attention — deux choses que je trouvais de plus en plus difficiles à maintenir dans un monde saturé d'informations.

Ce qui m'a frappé : les effets sont très concrets, dans les réunions, les conversations, la prise de décision.

Si cela résonne avec ce que vous traversez en ce moment, j'ai un lien personnel à partager → {{ url('/ps/' . $ambassadeur->code) }}</div>
        <button class="psr-template__copy" @click="navigator.clipboard.writeText(document.getElementById('tpl3').innerText).then(() => { copied3 = true; setTimeout(() => copied3 = false, 2500) })" x-text="copied3 ? '✓ Copié' : 'Copier ce texte'">Copier ce texte</button>
      </div>

      <div class="psr-template">
        <div class="psr-template__label">📧 Email — À un ami ou collègue</div>
        <div class="psr-template__text" id="tpl4">Bonjour,

Je voulais te parler d'un parcours que j'ai suivi récemment : Pause Souffle.

Ce n'est pas une formation classique. C'est un travail en profondeur sur la présence, la respiration et la clarté intérieure. Personnellement, cela m'a permis de [votre propre témoignage ici].

Si cela te parle, voici le lien pour en savoir plus :
{{ url('/ps/' . $ambassadeur->code) }}

N'hésite pas si tu as des questions — je suis heureux d'en parler.</div>
        <button class="psr-template__copy" @click="navigator.clipboard.writeText(document.getElementById('tpl4').innerText).then(() => { copied4 = true; setTimeout(() => copied4 = false, 2500) })" x-text="copied4 ? '✓ Copié' : 'Copier ce texte'">Copier ce texte</button>
      </div>

      <div class="psr-template">
        <div class="psr-template__label">🎙️ Bouche à oreille — En conversation</div>
        <div class="psr-template__text" id="tpl5">« J'ai fait quelque chose de vraiment intéressant ces derniers mois. C'est un parcours qui s'appelle Pause Souffle — centré sur la présence et la respiration. Ce qui m'a frappé, c'est que c'est très concret, pas seulement théorique. Je peux te passer mon lien si tu veux regarder. »</div>
        <button class="psr-template__copy" @click="navigator.clipboard.writeText(document.getElementById('tpl5').innerText).then(() => { copied5 = true; setTimeout(() => copied5 = false, 2500) })" x-text="copied5 ? '✓ Copié' : 'Copier ce texte'">Copier ce texte</button>
      </div>

      <div class="psr-template">
        <div class="psr-template__label">📅 Invitation à un événement de découverte</div>
        <div class="psr-template__text" id="tpl6">Bonjour,

Je t'invite à une rencontre de découverte Pause Souffle — une session gratuite pour explorer ce que ce programme peut apporter.

Tu n'as rien à acheter, rien à décider. C'est simplement une heure pour voir si l'approche te parle.

Pour t'inscrire, je te laisse mon lien :
{{ url('/ps/' . $ambassadeur->code) }}

@if(config('services.calendly.scheduling_link'))
📅 Planifier un créneau directement : {{ config('services.calendly.scheduling_link') }}
@else
[Ajouter ici la date, l'heure et le lien de connexion si vous organisez l'événement vous-même]
@endif</div>
        <button class="psr-template__copy" @click="navigator.clipboard.writeText(document.getElementById('tpl6').innerText).then(() => { copied6 = true; setTimeout(() => copied6 = false, 2500) })" x-text="copied6 ? '✓ Copié' : 'Copier ce texte'">Copier ce texte</button>
      </div>

    </div>

    {{-- Programmes & commissions --}}
    <div class="psr-section-title">Programmes que vous pouvez recommander</div>
    <div class="psr-grid" style="margin-bottom: 3rem;">
      <div class="psr-card">
        <div class="psr-card__icon">🌿</div>
        <div class="psr-card__title">Parcours Pause Souffle</div>
        <div class="psr-card__text">Transformation personnelle — 6 modules. La porte d'entrée de l'écosystème.<br><br><strong style="color:var(--ps-gold)">Commission : 25% → ~372 €</strong></div>
        <a href="{{ route('presence.parcours') }}" target="_blank" class="psr-card__btn">Voir le programme →</a>
      </div>
      <div class="psr-card">
        <div class="psr-card__icon">💼</div>
        <div class="psr-card__title">Freelance Pause Souffle</div>
        <div class="psr-card__text">Apprendre à accompagner des clients avec la méthode.<br><br><strong style="color:var(--ps-gold)">Commission : 20% → ~298 €</strong></div>
        <a href="{{ route('presence.formation-praticien') }}" target="_blank" class="psr-card__btn">Voir le programme →</a>
      </div>
      <div class="psr-card">
        <div class="psr-card__icon">🎓</div>
        <div class="psr-card__title">Formateur Pause Souffle</div>
        <div class="psr-card__text">Former d'autres praticiens et transmettre la méthode.<br><br><strong style="color:var(--ps-gold)">Commission : 15% → ~525 €</strong></div>
        <a href="{{ route('presence.formation-praticien') }}" target="_blank" class="psr-card__btn">Voir le programme →</a>
      </div>
      <div class="psr-card">
        <div class="psr-card__icon">🏔️</div>
        <div class="psr-card__title">Retraite Pause Souffle</div>
        <div class="psr-card__text">Expérience immersive en cadre naturel d'exception.<br><br><strong style="color:var(--ps-gold)">Commission : 10% → ~480–550 €</strong></div>
        <a href="{{ route('presence.retraite') }}" target="_blank" class="psr-card__btn">Voir la retraite →</a>
      </div>
    </div>

    {{-- Règles du réseau --}}
    <div class="psr-section-title">Les règles du réseau</div>
    <div class="psr-rules">
      <ul>
        <li>Partagez uniquement ce que vous avez vécu — c'est votre crédibilité qui fait la différence.</li>
        <li>Ne présentez jamais Pause Souffle comme un moyen de « gagner de l'argent facilement ».</li>
        <li>Votre lien est actif pendant 90 jours après chaque clic — inutile de le répéter à chaque fois.</li>
        <li>Les commissions sont versées 30 jours après le paiement du client (délai anti-remboursement).</li>
        <li>Un achat que vous faites vous-même via votre propre lien ne génère pas de commission.</li>
        <li>En cas de remboursement d'un client, la commission correspondante est annulée.</li>
        <li>Les virements SEPA sont effectués chaque mois sur votre IBAN enregistré dans votre profil.</li>
      </ul>
    </div>

    {{-- Retour --}}
    <div style="text-align:center; padding-bottom: 2rem;">
      <a href="{{ route('presence.ambassadeurs') }}" style="font-size:.85rem; color:var(--ps-text-dim); text-decoration:none;">
        ← Retour à votre espace ambassadeur
      </a>
    </div>

  </div>
</div>
@endsection
