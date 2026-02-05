{{-- Bloc "Tableau de bord Freelance" réutilisable --}}
<div class="dashboard-header-premium">
  <h1>Tableau de bord Freelance</h1>
  <p class="dashboard-header-subtitle">
    Un espace clair pour avancer sans relances : vos clients voient l'avancement, vous gardez le rythme.
  </p>
  <div class="dashboard-header-ctas">
    <a href="{{ route('freelance.services.create') }}" class="btn-premium btn-premium-primary">
      Créer un service
    </a>
    <a href="{{ route('freelance.show', ['id' => $freelancerProfile->id ?? 0]) }}" target="_blank" class="btn-premium btn-premium-secondary">
      Voir mon profil public
    </a>
  </div>
  <p class="dashboard-header-microcopy">💡 Plus vos informations sont complètes, plus vous remontez dans les résultats.</p>
</div>

