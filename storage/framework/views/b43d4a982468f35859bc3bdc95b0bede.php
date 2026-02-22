<!DOCTYPE html>
<html lang="<?php echo e($currentLanguageInfo->code ?? 'fr'); ?>" dir="ltr">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
  <title>Inscription | <?php echo e($websiteInfo->website_title ?? 'Junspro'); ?></title>
  <link rel="shortcut icon" href="<?php echo e(asset('assets/img/' . ($websiteInfo->favicon ?? 'favicon.png'))); ?>" type="image/x-icon">
  
  
  <link rel="stylesheet" href="<?php echo e(asset('assets/front/css/auth-modern.css')); ?>?v=<?php echo e(time()); ?>">
  <style>
    html, body {
      margin: 0;
      padding: 0;
      width: 100%;
      height: 100%;
      overflow-x: hidden;
    }
    /* Force l'affichage du sélecteur de rôle */
    .auth-role-selector {
      display: flex !important;
      gap: 0 !important;
      margin-bottom: 32px !important;
      background: #FFFFFF !important;
      padding: 0 !important;
      border-radius: 12px !important;
      border: 2px solid #E5E7EB !important;
      overflow: hidden !important;
      box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05) !important;
    }
    .auth-role-btn {
      flex: 1 !important;
      padding: 14px 20px !important;
      border: none !important;
      background: transparent !important;
      border-radius: 0 !important;
      font-size: 15px !important;
      font-weight: 600 !important;
      color: #4B5563 !important;
      cursor: pointer !important;
      transition: all 0.2s ease !important;
      position: relative !important;
      border-right: 1px solid #E5E7EB !important;
    }
    .auth-role-btn:last-child {
      border-right: none !important;
    }
    .auth-role-btn:hover {
      color: #111827 !important;
      background: #F9FAFB !important;
    }
    .auth-role-btn.active {
      background: linear-gradient(135deg, #4F46E5 0%, #7C3AED 100%) !important;
      color: #FFFFFF !important;
      box-shadow: none !important;
    }
    .auth-role-btn.active:hover {
      background: linear-gradient(135deg, #4338CA 0%, #6D28D9 100%) !important;
      color: #FFFFFF !important;
    }
  </style>
</head>
<body style="margin: 0; padding: 0;">
  <?php
    $role = request()->get('role', 'client'); // 'client' ou 'freelance'
    // Debug: vérifier que le rôle est bien récupéré
    // dd($role); // Décommenter pour debug si nécessaire
  ?>

  <?php echo $__env->make('frontend.auth.auth-modal', [
    'role' => $role,
    'mode' => 'register',
    'isModal' => false,
    'websiteInfo' => $websiteInfo ?? null,
    'googleEnabled' => $googleEnabled ?? false,
    'facebookEnabled' => $facebookEnabled ?? false
  ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
</body>
</html>

<?php /**PATH C:\Users\younes\Downloads\junspro-main (1)\junspro-main3\resources\views\frontend\auth\register.blade.php ENDPATH**/ ?>