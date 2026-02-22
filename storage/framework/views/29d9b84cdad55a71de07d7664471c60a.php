<!DOCTYPE html>
<html lang="<?php echo e($currentLanguageInfo->code ?? 'fr'); ?>" dir="ltr">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
  <title>Connexion | <?php echo e($websiteInfo->website_title ?? 'Junspro'); ?></title>
  <link rel="shortcut icon" href="<?php echo e(asset('assets/img/' . ($websiteInfo->favicon ?? 'favicon.png'))); ?>" type="image/x-icon">
  
  
  <link rel="stylesheet" href="<?php echo e(asset('assets/front/css/auth-modern.css')); ?>">
  <style>
    html, body {
      margin: 0;
      padding: 0;
      width: 100%;
      height: 100%;
      overflow-x: hidden;
    }
  </style>
</head>
<body style="margin: 0; padding: 0;">
  <?php
    $role = request()->get('role', 'client'); // 'client' ou 'freelance'
  ?>

  <?php echo $__env->make('frontend.auth.auth-modal', [
    'role' => $role,
    'mode' => 'login',
    'isModal' => false,
    'websiteInfo' => $websiteInfo ?? null,
    'googleEnabled' => $googleEnabled ?? false,
    'facebookEnabled' => $facebookEnabled ?? false,
    'googleRecaptchaStatus' => $googleRecaptchaStatus ?? 0
  ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
</body>
</html>

<?php /**PATH C:\Users\younes\Downloads\junspro-main (1)\junspro-main3\resources\views\frontend\auth\login.blade.php ENDPATH**/ ?>