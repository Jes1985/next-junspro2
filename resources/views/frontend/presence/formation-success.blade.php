@extends('frontend.layout')

@section('pageHeading', __('Inscription confirmée · Formation Praticien'))

@section('style')
<style>
.fs-page {
  min-height: 80vh;
  background: #0f0f0f;
  display: flex;
  align-items: center;
  justify-content: center;
  padding: 4rem 1.5rem;
}
.fs-card {
  background: linear-gradient(135deg, #1a0e00, #111);
  border: 1.5px solid #c9a84c;
  border-radius: 20px;
  max-width: 580px;
  width: 100%;
  padding: 3rem 2.5rem;
  text-align: center;
  color: #e8e0d0;
}
.fs-icon { font-size: 3.5rem; line-height: 1; margin-bottom: 1.2rem; }
.fs-title { font-size: 1.6rem; font-weight: 800; color: #fff; margin: 0 0 .8rem; }
.fs-verse {
  font-size: .85rem;
  color: rgba(201,168,76,.7);
  font-style: italic;
  border-left: 2px solid #c9a84c;
  padding-left: .9rem;
  margin: 1.2rem 0;
  text-align: left;
}
.fs-body { font-size: .95rem; color: rgba(232,224,208,.7); line-height: 1.7; margin-bottom: 1.8rem; }
.fs-actions { display: flex; gap: 1rem; justify-content: center; flex-wrap: wrap; }
.fs-btn {
  padding: .75rem 1.75rem;
  border-radius: 10px;
  font-size: .9rem; font-weight: 600;
  text-decoration: none;
  display: inline-flex; align-items: center; gap: .5rem;
  transition: opacity .2s;
}
.fs-btn:hover { opacity: .85; }
.fs-btn--gold    { background: #c9a84c; color: #000; }
.fs-btn--outline { background: transparent; border: 1px solid rgba(255,255,255,.2); color: #e8e0d0; }
</style>
@endsection

@section('content')
<div class="fs-page">
  <div class="fs-card">
    <div class="fs-icon">🎉</div>
    <h1 class="fs-title">Votre place est confirmée !</h1>
    <blockquote class="fs-verse">
      « L'Éternel lui dit : Va avec la force que tu as… C'est moi qui t'envoie. »<br>— Juges 6:14
    </blockquote>
    <p class="fs-body">
      Paiement reçu. Votre accès à la formation certifiante <strong>Freelance Pause Souffle</strong> est maintenant actif.<br><br>
      Les 6 modules sont disponibles dans votre espace personnel. Vous pouvez commencer dès maintenant par le premier module.
    </p>
    <div class="fs-actions">
      <a href="{{ route('formation.dashboard') }}" class="fs-btn fs-btn--gold">
        <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><polygon points="5 3 19 12 5 21 5 3"/></svg>
        Accéder à ma formation
      </a>
      <a href="{{ route('presence.pause-souffle') }}" class="fs-btn fs-btn--outline">
        Découvrir le Rituel
      </a>
    </div>

    {{-- CTA Ambassadeur — uniquement pour les non-ambassadeurs --}}
    @if(!($isAlreadyAmbassadeur ?? false))
    <div style="margin-top: 2.5rem; padding-top: 2rem; border-top: 1px solid rgba(201,168,76,0.15); text-align: center;">
      <p style="font-size: 0.78rem; letter-spacing: 0.2em; text-transform: uppercase; color: rgba(201,168,76,0.6); margin-bottom: 0.75rem;">Une invitation</p>
      <p style="font-size: 0.88rem; color: rgba(232,224,208,0.55); line-height: 1.8; margin-bottom: 1.25rem;">
        En tant que praticien certifié, vous êtes les mieux placés pour partager cette pratique.
        Le Réseau des Ambassadeurs est fait pour vous.
      </p>
      <a href="{{ route('presence.ambassadeurs') }}"
         style="display: inline-block; background: transparent; color: #c9a84c; border: 1px solid rgba(201,168,76,0.4); font-size: 0.8rem; font-weight: 600; letter-spacing: 0.06em; text-transform: uppercase; text-decoration: none; padding: 10px 24px; border-radius: 50px;">
        ✦ Voir le programme Ambassadeur
      </a>
    </div>
    @endif
  </div>
</div>
@endsection
