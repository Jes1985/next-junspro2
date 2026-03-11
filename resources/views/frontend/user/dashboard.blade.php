@extends('frontend.layout')

@php $title = __('Dashboard'); @endphp

@section('pageHeading')
  {{ $title }}
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

  <!--====== Start Dashboard Section ======-->
  <section class="user-dashboard pt-100 pb-60">
    <div class="container">
      <div class="row">
        @includeIf('frontend.user.side-navbar')

        <div class="col-lg-9">
          <div class="row">
            <div class="col-lg-12">
              <div class="user-profile-details mb-30">
                <div class="account-info">
                  <div class="title">
                    <h4>{{ __('Account Information') }}</h4>
                  </div>

                  <div class="main-info">
                    <ul class="list list-unstyled">

                      @if ($authUser->first_name != null && $authUser->last_name != null)
                      <li>
                        <span>{{ __('Name') . ':' }}</span>
                        <span>{{ $authUser->first_name . ' ' . $authUser->last_name }}</span>
                      </li>
                      @endif

                      @if ($authUser->username != null)
                      <li>
                        <span>{{ __('Username') . ':' }}</span>
                        <span>{{ $authUser->username }}</span>
                      </li>
                      @endif

                      <li>
                        <span>{{ __('Email Address') . ':' }}</span>
                        <span>{{ $authUser->email_address }}</span>
                      </li>

                      @if ($authUser->phone_number != null)
                      <li>
                        <span>{{ __('Phone') . ':' }}</span>
                        <span>{{ $authUser->phone_number }}</span>
                      </li>
                      @endif

                      @if ($authUser->address != null)
                      <li>
                        <span>{{ __('Address') . ':' }}</span>
                        <span>{{ $authUser->address }}</span>
                      </li>
                      @endif

                      @if ($authUser->city != null)
                      <li>
                        <span>{{ __('City') . ':' }}</span>
                        <span>{{ $authUser->city }}</span>
                      </li>
                      @endif

                      @if ($authUser->state != null)
                      <li>
                        <span>{{ __('State') . ':' }}</span>
                        <span>{{ $authUser->state }}</span>
                      </li>
                      @endif

                      @if ($authUser->country != null)
                      <li>
                        <span>{{ __('Country') . ':' }}</span>
                        <span>{{ $authUser->country }}</span>
                      </li>
                      @endif
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="row pb-10">
            @if ($basicInfo->is_service)
              <div class="col-md-4">
                <div class="mb-30">
                  <a href="{{ route('user.service_orders') }}" class="d-block">
                    <div class="card card-box radius-md box-1">
                      <div class="card-info">
                        <h5>{{ __('Service Orders') }}</h5>
                        <p>{{ $numOfServiceOrders }}</p>
                      </div>
                    </div>
                  </a>
                </div>
              </div>

              <div class="col-md-4">
                <div class="mb-30">
                  <a href="{{ route('user.service_wishlist') }}" class="d-block">
                    <div class="card card-box radius-md box-2">
                      <div class="card-info">
                        <h5>{{ __('Wishlisted Services') }}</h5>
                        <p>{{ $numOfWishlistedServices }}</p>
                      </div>
                    </div>
                  </a>
                </div>
              </div>
            @endif
            @if ($basicInfo->support_ticket_status == 1)
              <div class="col-md-4">
                <div class="mb-30">
                  <a href="{{ route('user.support_tickets') }}" class="d-block">
                    <div class="card card-box radius-md box-5">
                      <div class="card-info">
                        <h5>{{ __('Support Tickets') }}</h5>
                        <p>{{ $numOfsupportTicket }}</p>
                      </div>
                    </div>
                  </a>
                </div>
              </div>
            @endif
          </div>
        </div>
      </div>
    </div>
  </section>
  <!--====== End Dashboard Section ======-->

  {{-- ✨ Widget résumé IA Freelance --}}
  <div style="max-width:1200px;margin:0 auto 3rem;padding:0 1.5rem;">
    <div id="ai-fl-summary-widget" style="background:linear-gradient(135deg,rgba(124,58,237,.10),rgba(76,29,149,.06));border:1px solid rgba(124,58,237,.18);border-radius:14px;padding:1.1rem 1.4rem;">
      <div style="display:flex;align-items:center;justify-content:space-between;gap:1rem;">
        <div style="display:flex;align-items:center;gap:.55rem;">
          <span style="font-size:1.1rem;">✨</span>
          <div>
            <span style="font-weight:600;font-size:.875rem;color:#6d28d9;">Conseil Juns IA du jour</span>
          </div>
        </div>
        <button onclick="loadFreelanceSummary()" id="ai-fl-refresh" style="background:rgba(109,40,217,.12);border:1px solid rgba(109,40,217,.25);color:#6d28d9;border-radius:7px;padding:.3rem .65rem;font-size:.72rem;cursor:pointer;transition:all .2s;">Actualiser</button>
      </div>
      <p id="ai-fl-summary-text" style="margin:.75rem 0 0;font-size:.85rem;color:#4c1d95;line-height:1.65;"><span style="color:#9ca3af;">Chargement…</span></p>
    </div>
  </div>

  <script>
  (function() {
    function loadFreelanceSummary() {
      const el = document.getElementById('ai-fl-summary-text');
      const btn = document.getElementById('ai-fl-refresh');
      if (!el) return;
      el.innerHTML = '<span style="color:#9ca3af;">Analyse en cours…</span>';
      if (btn) btn.disabled = true;
      fetch('/api/ai/freelance-summary', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || '' },
      })
      .then(r => r.json())
      .then(d => { el.textContent = d.summary || 'Continuez sur votre lancée !'; })
      .catch(() => { el.innerHTML = '<span style="color:#9ca3af;">Non disponible pour le moment.</span>'; })
      .finally(() => { if (btn) btn.disabled = false; });
    }
    window.loadFreelanceSummary = loadFreelanceSummary;
    document.addEventListener('DOMContentLoaded', function() { setTimeout(loadFreelanceSummary, 800); });
  })();
  </script>

@endsection
