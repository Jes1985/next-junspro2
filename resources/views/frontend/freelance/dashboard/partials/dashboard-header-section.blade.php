{{-- Bloc "Tableau de bord Freelance" réutilisable --}}
<div class="dashboard-header">
  <h1>Tableau de bord Freelance</h1>
  <p class="dashboard-header-subtitle">
    Un espace clair pour avancer sans relances : vos clients voient l'avancement, vous gardez le rythme.
  </p>
  <div class="dashboard-header-ctas">
    <a href="{{ route('freelance.services.create') }}" class="btn-premium btn-premium-primary">
      Créer un service
    </a>
    @if(isset($freelancerProfile) && $freelancerProfile && $freelancerProfile->id)
      <a href="{{ route('freelance.show', ['id' => $freelancerProfile->id]) }}" target="_blank" class="btn-premium btn-premium-secondary">
        Voir mon profil public
      </a>
    @else
      <a href="#" class="btn-premium btn-premium-secondary" onclick="alert('Vous devez compléter votre profil freelance pour voir votre profil public.'); return false;">
        Voir mon profil public
      </a>
    @endif
  </div>
  <p style="margin-top: 0.75rem; font-size: 0.85rem; color: #6b7280;">💡 Plus vos informations sont complètes, plus vous remontez dans les résultats.</p>
</div>

