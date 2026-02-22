<!-- Section "Pourquoi Junspro" -->
<section class="why-junspro-section">
  <div class="why-junspro-container">
    <h2 class="why-junspro-title"><?php echo e(__('Pourquoi Junspro est la meilleure plateforme pour vos projets')); ?></h2>
    <div class="why-junspro-cards">
      <div class="why-junspro-card">
        <div class="why-junspro-number">5/5</div>
        <div class="why-junspro-text"><?php echo e(__('Note moyenne des freelances Junspro')); ?></div>
      </div>
      <div class="why-junspro-card">
        <div class="why-junspro-number"><?php echo e(isset($freelancers) ? $freelancers->total() : (isset($sellers) ? $sellers->total() : '1000')); ?>+</div>
        <div class="why-junspro-text"><?php echo e(__('Projets livrés avec succès via la plateforme')); ?></div>
      </div>
      <div class="why-junspro-card">
        <div class="why-junspro-number">2 <?php echo e(__('jours')); ?></div>
        <div class="why-junspro-text"><?php echo e(__('Délai moyen pour recevoir une première proposition')); ?></div>
      </div>
      <div class="why-junspro-card">
        <div class="why-junspro-number">85%</div>
        <div class="why-junspro-text"><?php echo e(__('Des clients lancent un 2ᵉ projet avec le même freelance')); ?></div>
      </div>
    </div>
  </div>
</section>

<?php /**PATH C:\Users\younes\Downloads\junspro-main (1)\junspro-main3\resources\views\frontend\seller\partials\why-junspro-section.blade.php ENDPATH**/ ?>