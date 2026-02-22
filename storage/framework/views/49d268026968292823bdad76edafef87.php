<!DOCTYPE html>
<html>

<head>
  
  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  
  <title><?php echo e(__('Admin Login') . ' | ' . $websiteInfo->website_title); ?></title>

  
  <link rel="shortcut icon" type="image/png" href="<?php echo e(asset('assets/img/' . $websiteInfo->favicon)); ?>">

  
  <link rel="stylesheet" href="<?php echo e(asset('assets/css/bootstrap.min.css')); ?>">

  
  <link rel="stylesheet" href="<?php echo e(asset('assets/css/admin-login.css')); ?>">
</head>

<body>
  
  <div class="login-page">
    <?php if(!empty($websiteInfo->logo)): ?>
      <div class="text-center mb-4">
        <img class="login-logo" src="<?php echo e(asset('assets/img/' . $websiteInfo->logo)); ?>" alt="logo">
      </div>
    <?php endif; ?>

    <div class="form">
      <?php if(session()->has('alert')): ?>
        <div class="alert alert-danger fade show mdb_233" role="alert">
          <strong><?php echo e(session('alert')); ?></strong>
        </div>
      <?php endif; ?>

      <form class="login-form" action="<?php echo e(route('admin.auth')); ?>" method="POST">
        <?php echo csrf_field(); ?>
        <input type="text" name="username" placeholder="Enter Username" value="" />
        <?php if($errors->has('username')): ?>
          <p class="text-danger text-left"><?php echo e($errors->first('username')); ?></p>
        <?php endif; ?>

        <input type="password" name="password" placeholder="Enter Password" value="" />
        <?php if($errors->has('password')): ?>
          <p class="text-danger text-left"><?php echo e($errors->first('password')); ?></p>
        <?php endif; ?>

        <button type="submit"><?php echo e(__('login')); ?></button>
      </form>

      <a class="forget-link" href="<?php echo e(route('admin.forget_password')); ?>">
        <?php echo e(__('Forget Password?')); ?>

      </a>
    </div>
  </div>
  


  
  <script src="<?php echo e(asset('assets/js/jquery-3.7.1.min.js')); ?>"></script>

  
  <script src="<?php echo e(asset('assets/js/popper.min.js')); ?>"></script>

  
  <script src="<?php echo e(asset('assets/js/bootstrap.min.js')); ?>"></script>
</body>

</html>
<?php /**PATH C:\Users\younes\Downloads\junspro-main (1)\junspro-main3\resources\views\backend\login.blade.php ENDPATH**/ ?>