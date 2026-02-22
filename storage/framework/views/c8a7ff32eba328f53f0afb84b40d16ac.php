

<?php $__env->startSection('content'); ?>
  <div style="max-width: 1200px; margin: 0 auto; padding: 2rem 1rem;">
    <h1>Paramètres Freelance</h1>
    <p>Page principale des paramètres (TODO: rediriger vers le dashboard avec tab=settings)</p>
    <a href="<?php echo e(route('freelance.dashboard', ['tab' => 'settings'])); ?>" class="btn-premium btn-premium-primary">
      Retour au dashboard
    </a>
  </div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('frontend.freelance.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\younes\Downloads\junspro-main (1)\junspro-main3\resources\views\frontend\freelance\settings\index.blade.php ENDPATH**/ ?>