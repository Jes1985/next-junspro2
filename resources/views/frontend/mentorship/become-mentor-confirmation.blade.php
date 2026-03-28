@extends('frontend.layout')

@section('pageHeading')
  Candidature reçue — Merci !
@endsection

@section('style')
<style>
  .bm-confirm { min-height: 80vh; display: flex; align-items: center; justify-content: center; background: linear-gradient(160deg, #f5f3ff, #ede9fe); padding: 4rem 1.5rem; }
  .bm-confirm__card { background: #fff; border-radius: 28px; padding: 3.5rem 3rem; text-align: center; max-width: 560px; width: 100%; box-shadow: 0 12px 48px rgba(79,70,229,.14); }
  .bm-confirm__icon { width: 80px; height: 80px; background: linear-gradient(135deg,#4f46e5,#7c3aed); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 2rem; }
  .bm-confirm__icon i { font-size: 2rem; color: #fff; }
  .bm-confirm__title { font-size: 1.9rem; font-weight: 900; color: #1a1363; margin-bottom: .75rem; }
  .bm-confirm__sub { font-size: 1rem; color: #6b7280; line-height: 1.65; margin-bottom: 2rem; }
  .bm-confirm__steps { background: #f5f3ff; border-radius: 16px; padding: 1.5rem; text-align: left; margin-bottom: 2rem; }
  .bm-confirm__step { display: flex; align-items: flex-start; gap: .75rem; margin-bottom: .75rem; font-size: .88rem; color: #4b5563; }
  .bm-confirm__step:last-child { margin-bottom: 0; }
  .bm-confirm__step i { color: #4f46e5; margin-top: 2px; }
  .bm-confirm__cta { display: inline-flex; align-items: center; gap: .5rem; background: linear-gradient(135deg,#4f46e5,#7c3aed); color: #fff; font-size: .95rem; font-weight: 700; padding: .85rem 2rem; border-radius: 12px; text-decoration: none; transition: transform .2s; }
  .bm-confirm__cta:hover { transform: translateY(-2px); color: #fff; }
</style>
@endsection

@section('content')
<div class="bm-confirm">
  <div class="bm-confirm__card">
    <div class="bm-confirm__icon">
      <i class="fa fa-paper-plane"></i>
    </div>
    <h1 class="bm-confirm__title">Candidature envoyée !</h1>
    <p class="bm-confirm__sub">
      Merci pour votre intérêt. Notre équipe examine votre dossier et vous
      répondra par e-mail dans un délai de <strong>48 heures ouvrées</strong>.
    </p>

    <div class="bm-confirm__steps">
      <div class="bm-confirm__step">
        <i class="fa fa-envelope"></i>
        <span>Un e-mail de confirmation vient d'être envoyé à votre adresse.</span>
      </div>
      <div class="bm-confirm__step">
        <i class="fa fa-search"></i>
        <span>Notre équipe examinera votre profil et votre motivation.</span>
      </div>
      <div class="bm-confirm__step">
        <i class="fa fa-check-circle"></i>
        <span>Si votre candidature est acceptée, vous recevrez un lien pour activer votre espace mentor.</span>
      </div>
    </div>

    <a href="{{ route('user.dashboard') }}" class="bm-confirm__cta">
      <i class="fa fa-home"></i> Retour au tableau de bord
    </a>
  </div>
</div>
@endsection
