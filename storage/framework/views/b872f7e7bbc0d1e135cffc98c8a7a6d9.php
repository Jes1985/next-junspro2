<!DOCTYPE html>
<html lang="en">
  <head>
    
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    
    <title><?php echo e('Maintenance Mode | ' . config('app.name')); ?></title>

    
    <link rel="shortcut icon" type="image/png" href="<?php echo e(asset('assets/img/' . $websiteInfo->favicon)); ?>">

    
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/bootstrap.min.css')); ?>">

    
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/503.css')); ?>">
  </head>

  <body>
    <div class="container">
      <div class="content">
        <div class="row mt-4">
          <div class="col-lg-4 offset-lg-4">
            <div class="maintanance-img-wrapper">
              <img src="<?php echo e(asset('assets/img/' . $info->maintenance_img)); ?>" alt="image">
            </div>
          </div>
        </div>

        <div class="row mt-3">
          <div class="col-lg-8 offset-lg-2">
            <h3 class="maintanance-txt"><?php echo nl2br($info->maintenance_msg); ?></h3>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>
<?php /**PATH C:\Users\younes\Downloads\junspro-main (1)\junspro-main3\resources\views\errors\503.blade.php ENDPATH**/ ?>