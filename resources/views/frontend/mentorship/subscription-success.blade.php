@extends('frontend.layout')

@section('pageHeading')
  Abonnement mentorat activé !
@endsection

@section('content')
<div style="min-height:70vh;display:flex;align-items:center;justify-content:center;background:linear-gradient(160deg,#f5f3ff,#ede9fe);padding:2rem;">
  <div style="text-align:center;background:#fff;border-radius:24px;padding:3rem 2.5rem;max-width:520px;box-shadow:0 8px 40px rgba(124,58,237,.15);">
    <div style="width:5rem;height:5rem;background:linear-gradient(135deg,#10b981,#059669);border-radius:50%;display:flex;align-items:center;justify-content:center;margin:0 auto 1.5rem;font-size:2rem;color:#fff;">
      <i class="fas fa-check"></i>
    </div>
    <h1 style="font-size:1.8rem;font-weight:800;color:#1e1b4b;margin-bottom:.75rem;">Bienvenue dans le mentorat !</h1>
    <p style="color:#6b7280;margin-bottom:.5rem;font-size:.95rem;">Votre abonnement est maintenant actif.</p>

    @if($subscription)
      <div style="background:#f5f3ff;border-radius:12px;padding:1rem 1.25rem;margin:1.25rem 0;text-align:left;">
        <div style="display:flex;justify-content:space-between;font-size:.88rem;margin-bottom:.4rem;">
          <span style="color:#6b7280;">Plan</span>
          <strong style="color:#1e1b4b;">{{ $subscription->planLabel() }}</strong>
        </div>
        <div style="display:flex;justify-content:space-between;font-size:.88rem;margin-bottom:.4rem;">
          <span style="color:#6b7280;">Cycle jusqu'au</span>
          <strong style="color:#1e1b4b;">{{ optional($subscription->current_cycle_end)->format('d/m/Y') ?? '—' }}</strong>
        </div>
        <div style="display:flex;justify-content:space-between;font-size:.88rem;">
          <span style="color:#6b7280;">Prochain renouvellement</span>
          <strong style="color:#1e1b4b;">{{ optional($subscription->next_billing_at)->format('d/m/Y') ?? '—' }}</strong>
        </div>
      </div>
    @endif

    <div style="display:flex;flex-direction:column;gap:.75rem;">
      <a href="{{ route('mentorship.dashboard.trainee') }}" style="display:block;padding:.85rem;background:linear-gradient(135deg,#1e40af,#7c3aed);color:#fff;border-radius:12px;text-decoration:none;font-weight:700;">
        <i class="fas fa-rocket"></i> Accéder à mon espace stagiaire
      </a>
      <a href="{{ route('mentorship.subscription.index') }}" style="display:block;padding:.85rem;background:#ede9fe;color:#7c3aed;border-radius:12px;text-decoration:none;font-weight:600;font-size:.9rem;">
        Retour aux plans
      </a>
    </div>
  </div>
</div>
@endsection
