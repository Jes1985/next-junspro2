<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <title><?php echo e($websiteInfo->website_title); ?></title>
</head>

<body>
  <form action="<?php echo e($data['url']); ?>" method="<?php echo e($data['method']); ?>" id="paymentForm">
    <?php $__currentLoopData = $data['val']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <input type="hidden" name="<?php echo e($key); ?>" value="<?php echo e($value); ?>" />
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
  </form>
  <script>
    "use strict";
    document.getElementById("paymentForm").submit();
  </script>
</body>

</html>
<?php /**PATH C:\Users\younes\Downloads\junspro-main (1)\junspro-main3\resources\views\frontend\payment\perfect-money.blade.php ENDPATH**/ ?>