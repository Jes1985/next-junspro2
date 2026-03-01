@extends('frontend.layout')

@section('pageHeading')
  {{ __('Confirmer l\'annulation') }}
@endsection

@section('style')
<style>
  .page-hero-banner { background: linear-gradient(135deg, #4c1d95 0%, #7c3aed 60%, #a855f7 100%); border-radius: 40px; padding: 3rem 4rem; margin-bottom: 2rem; color: white; position: relative; overflow: hidden; box-shadow: 0 32px 80px rgba(124,58,237,0.3), inset 0 1px 1px rgba(255,255,255,0.2); display: flex; justify-content: space-between; align-items: center; gap: 2rem; }
  .page-hero-banner::before { content: ''; position: absolute; top: -40%; left: -5%; width: 400px; height: 400px; background: radial-gradient(circle, rgba(255,255,255,0.08) 0%, transparent 70%); border-radius: 50%; pointer-events: none; }
  .page-hero-banner::after { content: ''; position: absolute; bottom: -20%; right: -10%; width: 600px; height: 600px; background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%); border-radius: 50%; pointer-events: none; }
  .page-hero-title { font-size: 2.5rem; font-weight: 900; margin-bottom: 0.5rem; color: white; line-height: 1.1; letter-spacing: -0.03em; position: relative; z-index: 2; }
  .page-hero-subtitle { font-size: 1.1rem; opacity: 0.9; margin-bottom: 0; font-weight: 300; color: white; position: relative; z-index: 2; }
  .hero-text-content { flex: 1; position: relative; z-index: 2; }
  .hero-search-btn { background: white; color: #7c3aed; border-radius: 50px; padding: 0.85rem 1.8rem; font-weight: 600; font-size: 0.95rem; text-decoration: none !important; display: flex; align-items: center; gap: 0.5rem; white-space: nowrap; position: relative; z-index: 2; flex-shrink: 0; transition: background 0.2s, color 0.2s; }
  .hero-search-btn:hover { background: #f5f3ff; color: #6d28d9; text-decoration: none !important; }
</style>
@endsection

@section('content')
@php $heroFirstName = Auth::guard('web')->user()?->first_name ?? Auth::guard('web')->user()?->username ?? 'vous'; @endphp
<div style="max-width: 1400px; margin: 0 auto; padding: 2rem 1.5rem 0;">
  @include('frontend.client.partials.dashboard-nav')
  <div class="page-hero-banner">
    <div class="hero-text-content">
      <h1 class="page-hero-title">Bonjour {{ $heroFirstName }} !</h1>
      <p class="page-hero-subtitle">Bienvenue dans votre espace</p>
    </div>
    <a href="/services" class="hero-search-btn"><i class="fas fa-search"></i> Trouver un freelance</a>
  </div>
</div>
  <section class="user-dashboard pt-100 pb-60">
    <div class="container">
      <div class="row">
        @includeIf('frontend.user.side-navbar')

        <div class="col-lg-9">
          <div class="user-profile-details mb-30">
            <div class="title mb-30">
              <h4>{{ __('Confirmer l\'annulation de votre abonnement') }}</h4>
            </div>

            <!-- Étape 2 : Confirmation avec raison -->
            <div class="card mb-30">
              <div class="card-body">
                <h5 class="mb-20">{{ __('Votre abonnement sera arrêté. Plus aucun débit ni nouvelle livraison programmée.') }}</h5>
                
                <p class="text-muted mb-20">
                  <strong>{{ __('Raison') }}:</strong> {{ $reason ?? 'Non spécifiée' }}
                </p>

                <!-- Étape 3 : Dernière offre -->
                <form action="{{ route('client.subscriptions.cancel.submit', $subscription->id) }}" method="POST">
                  @csrf
                  <input type="hidden" name="action" value="final_cancel">
                  <input type="hidden" name="reason" value="{{ $reason ?? '' }}">
                  
                  <div class="mb-20">
                    <a href="{{ route('explore') }}" class="btn btn-lg btn-primary w-100 mb-10">
                      {{ __('Trouver un autre freelance') }}
                    </a>
                  </div>

                  <div class="mb-20">
                    <a href="{{ route('client.subscriptions.index') }}" class="btn btn-lg w-100 mb-10" style="background: linear-gradient(135deg, #4F46E5 0%, #7C3AED 100%); border: none; color: #ffffff;">
                      {{ __('Garder mon abonnement') }}
                    </a>
                  </div>

                  <hr>

                  <div class="mb-20">
                    <button type="submit" class="btn btn-lg btn-danger w-100 mb-10">
                      {{ __('Annuler définitivement mon abonnement') }}
                    </button>
                    <p class="text-muted small text-center">{{ __('Cette action est irréversible.') }}</p>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection



