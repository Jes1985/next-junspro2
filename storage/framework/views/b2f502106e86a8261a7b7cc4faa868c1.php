<?php
  $basicInfo = DB::table('basic_settings')
      ->select('theme_version')
      ->first();
  $version = $basicInfo->theme_version;
?>


<?php $__env->startSection('content'); ?>
  <div class="text-center">
    <h1>Please do not refresh this page...</h1>
  </div>
  <form method="post" action="<?php echo e($paytm_txn_url); ?>" name="f1">
    <?php echo e(csrf_field()); ?>

    <table border="1">
      <tbody>
        <?php
        foreach ($paramList as $name => $value) {
            echo '<input type="hidden" name="' . $name . '" value="' . $value . '">';
        }
        ?>
        <input type="hidden" name="CHECKSUMHASH" value="<?php echo htmlspecialchars($checkSum); ?>">
      </tbody>
    </table>

  </form>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
  <script src="<?php echo e(asset('assets/js/paytm.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\younes\Downloads\junspro-main (1)\junspro-main3\resources\views\frontend\payment\paytm.blade.php ENDPATH**/ ?>