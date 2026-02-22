
<div class="dashboard-header-premium">
  <h1>Tableau de bord Freelance</h1>
  <p class="dashboard-header-subtitle">
    Un espace clair pour avancer sans relances : vos clients voient l'avancement, vous gardez le rythme.
  </p>
  <div class="dashboard-header-ctas">
    <a href="<?php echo e(route('freelance.services.create')); ?>" class="btn-premium btn-premium-primary">
      Créer un service
    </a>
    <a href="<?php echo e(route('freelance.show', ['id' => $freelancerProfile->id ?? 0])); ?>" target="_blank" class="btn-premium btn-premium-secondary">
      Voir mon profil public
    </a>
  </div>
  <p class="dashboard-header-microcopy">💡 Plus vos informations sont complètes, plus vous remontez dans les résultats.</p>
</div>

<?php /**PATH C:\Users\younes\Downloads\junspro-main (1)\junspro-main3\resources\views\frontend\freelance\dashboard\partials\dashboard-header.blade.php ENDPATH**/ ?>