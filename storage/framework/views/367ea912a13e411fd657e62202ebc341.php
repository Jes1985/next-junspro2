<?php $__env->startSection('content'); ?>
  <div style="padding: 2rem; text-align: center;">
    <h1>Test Page Messages</h1>
    <p>Si vous voyez ce message, la route fonctionne !</p>
    <a href="<?php echo e(route('user.messages.index')); ?>">Aller à la page Messages complète</a>
  </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\younes\Downloads\junspro-main (1)\junspro-main3\resources\views\frontend\client\messages\test.blade.php ENDPATH**/ ?>