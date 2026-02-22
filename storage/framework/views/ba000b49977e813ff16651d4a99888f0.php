<!DOCTYPE html>
<html>

<head>
  
  <meta http-equiv="Content-Type" content="text/html" charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">

  
  <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

  
  <title><?php echo e(__('Seller') . ' | ' . $websiteInfo->website_title); ?></title>

  
  <link rel="shortcut icon" type="image/png" href="<?php echo e(asset('assets/img/' . $websiteInfo->favicon)); ?>">

  
  <?php if ($__env->exists('seller.partials.styles')) echo $__env->make('seller.partials.styles', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

  
  <?php echo $__env->yieldContent('style'); ?>
</head>

<body data-background-color="<?php echo e(Session::get('seller_theme_version') == 'light' ? 'white2' : 'dark'); ?>">
  
  <div class="request-loader">
    <img src="<?php echo e(asset('assets/img/loader.gif')); ?>" alt="loader">
  </div>
  

  <div class="wrapper">
    
    <?php if ($__env->exists('seller.partials.top-navbar')) echo $__env->make('seller.partials.top-navbar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    

    
    <?php if ($__env->exists('seller.partials.side-navbar')) echo $__env->make('seller.partials.side-navbar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    

    <div class="main-panel">
      <div class="content">
        <div class="page-inner">
          <?php echo $__env->yieldContent('content'); ?>
        </div>
      </div>

      
      <?php if ($__env->exists('seller.partials.footer')) echo $__env->make('seller.partials.footer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
      
    </div>
  </div>

  
  <?php if ($__env->exists('seller.partials.scripts')) echo $__env->make('seller.partials.scripts', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

  
  <?php echo $__env->yieldContent('script'); ?>


</body>

</html>
<?php /**PATH C:\Users\younes\Downloads\junspro-main (1)\junspro-main3\resources\views\seller\layout.blade.php ENDPATH**/ ?>