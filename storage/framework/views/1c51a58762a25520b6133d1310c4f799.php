<!DOCTYPE html>
<html>

<head lang="<?php echo e($currentLanguageInfo->code); ?>" <?php if($currentLanguageInfo->direction == 1): ?> dir="rtl" <?php endif; ?>>
  
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">

  
  <title><?php echo e('Service Invoice | ' . config('app.name')); ?></title>

  
  <link rel="shortcut icon" type="image/png" href="<?php echo e(asset('assets/img/' . $websiteInfo->favicon)); ?>">

  
  <link rel="stylesheet" href="<?php echo e(asset('assets/css/bootstrap.min.css')); ?>">
  <style>
    body {
      font-family: DejaVu Sans, serif;
    }
  </style>
</head>

<body>
  <div class="service-order-invoice my-5">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="logo text-center mdf_3432">
            <img src="<?php echo e(asset('assets/img/' . $websiteInfo->logo)); ?>" alt="website logo">
          </div>

          <div class="mb-3">
            <h2 class="text-center">
              <?php echo e(__('SERVICE ORDER INVOICE')); ?>

            </h2>
          </div>

          <?php
            $position = $orderInfo->currency_text_position;
            $currency = $orderInfo->currency_text;
          ?>

          <div class="row">
            <div class="col">
              <table class="table table-striped table-bordered">
                <tbody>
                  <tr>
                    <th><?php echo e(__('Order No')); ?></th>
                    <td><?php echo e('#' . $orderInfo->order_number); ?></td>
                  </tr>

                  <tr>
                    <th><?php echo e(__('Order Date')); ?></th>
                    <td><?php echo e(date_format($orderInfo->created_at, 'M d, Y')); ?></td>
                  </tr>

                  <tr>
                    <th><?php echo e(__('Customer Name')); ?></th>
                    <td><?php echo e($orderInfo->name); ?></td>
                  </tr>
                  <tr>
                    <th><?php echo e(__('Seller')); ?></th>
                    <td>
                      <?php if($orderInfo->seller_id != 0): ?>
                        <?php if($orderInfo->seller): ?>
                          <a target="_blank"
                            href="<?php echo e(route('frontend.seller.details', @$orderInfo->seller->username)); ?>"><?php echo e(@$orderInfo->seller->username); ?></a>
                        <?php endif; ?>
                      <?php else: ?>
                        <span class="badge badge-junspro"><?php echo e(__('Admin')); ?></span>
                      <?php endif; ?>
                    </td>
                  </tr>

                  <tr>
                    <th><?php echo e(__('Customer Email')); ?></th>
                    <td><?php echo e($orderInfo->email_address); ?></td>
                  </tr>

                  <tr>
                    <th><?php echo e(__('Service')); ?></th>
                    <td><?php echo e($serviceTitle); ?></td>
                  </tr>

                  <?php if(!is_null($packageTitle)): ?>
                    <tr>
                      <th><?php echo e(__('Package')); ?></th>
                      <td><?php echo e($packageTitle); ?>

                        (<?php echo e($position == 'left' ? $currency . ' ' : ''); ?><?php echo e(formatPrice(number_format($orderInfo->package_price, 2))); ?><?php echo e($position == 'right' ? ' ' . $currency : ''); ?>)
                      </td>
                    </tr>
                  <?php endif; ?>

                  <?php if(!is_null($orderInfo->addons)): ?>
                    <tr>
                      <th><?php echo e(__('Addons')); ?></th>
                      <td>
                        <?php
                          $addons = json_decode($orderInfo->addons);
                          $adonTotal = 0;
                        ?>

                        <?php $__currentLoopData = $addons; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $addon): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                          <?php
                            $addonId = $addon->id;

                            $serviceAddon = \App\Models\ClientService\ServiceAddon::query()->find($addonId);
                          ?>

                          <?php echo e($loop->iteration . '.'); ?> <?php echo e($serviceAddon->name); ?>

                          (<?php echo e($position == 'left' ? $currency . ' ' : ''); ?><?php echo e(formatPrice($addon->price)); ?><?php echo e($position == 'right' ? ' ' . $currency : ''); ?>)
                          <?php
                            $adonTotal = $adonTotal + $addon->price;
                          ?>
                          <br>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <hr>
                        <p><?php echo e(__('Total') . ':'); ?>

                          <?php echo e($position == 'left' ? $currency . ' ' : ''); ?><?php echo e(formatPrice($adonTotal)); ?><?php echo e($position == 'right' ? ' ' . $currency : ''); ?>

                        </p>
                      </td>
                    </tr>
                  <?php endif; ?>
                  <?php if(!is_null($orderInfo->tax)): ?>
                    <tr>
                      <th><?php echo e(__('Tax')); ?> (<?php echo e($orderInfo->tax_percentage . '%'); ?>) <i
                          class="fas fa-plus text-danger text-small"></i></th>
                      <td>
                        <?php if(is_null($orderInfo->tax)): ?>
                          <?php echo e(__('Price Requested')); ?>

                        <?php else: ?>
                          <?php echo e($position == 'left' ? $currency . ' ' : ''); ?><?php echo e(formatPrice(number_format($orderInfo->tax, 2))); ?><?php echo e($position == 'right' ? ' ' . $currency : ''); ?>

                        <?php endif; ?>
                      </td>
                    </tr>
                  <?php endif; ?>

                  <tr>
                    <th><?php echo e(__('Total')); ?></th>
                    <td>
                      <?php if(is_null($orderInfo->grand_total)): ?>
                        <?php echo e(__('Price Requested')); ?>

                      <?php else: ?>
                        <?php echo e($position == 'left' ? $currency . ' ' : ''); ?><?php echo e(formatPrice(number_format($orderInfo->grand_total, 2))); ?><?php echo e($position == 'right' ? ' ' . $currency : ''); ?>

                      <?php endif; ?>
                    </td>
                  </tr>

                  <tr>
                    <th><?php echo e(__('Payment Method')); ?></th>
                    <td>
                      <?php if(is_null($orderInfo->payment_method)): ?>
                        <?php echo e(__('None')); ?>

                      <?php else: ?>
                        <?php echo e($orderInfo->payment_method); ?>

                      <?php endif; ?>
                    </td>
                  </tr>

                  <tr>
                    <th><?php echo e(__('Payment Status')); ?></th>
                    <td><?php echo e(ucfirst($orderInfo->payment_status)); ?></td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>

</html>
<?php /**PATH C:\Users\younes\Downloads\junspro-main (1)\junspro-main3\resources\views\frontend\service\invoice.blade.php ENDPATH**/ ?>