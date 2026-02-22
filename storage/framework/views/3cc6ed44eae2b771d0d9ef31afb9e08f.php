<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title><?php echo e(__('Invoice')); ?></title>
  <link rel="stylesheet" href="<?php echo e(asset('assets/css/pdf.css')); ?>">
  <style>
    body {
      font-family: DejaVu Sans, serif;
    }
  </style>
</head>

<body>
  <div class="main">
    <table class="heading">
      <tr>
        <td>
          <?php if(!empty($websiteInfo->logo)): ?>
            <img loading="lazy" src="<?php echo e(asset('assets/img/' . $websiteInfo->logo)); ?>" height="40"
              class="d-inline-block">
          <?php else: ?>
            <img loading="lazy" src="<?php echo e(asset('assets/admin/img/noimage.jpg')); ?>" height="40" class="d-inline-block">
          <?php endif; ?>
        </td>
        <td class="text-right strong invoice-heading"><?php echo e(__('INVOICE')); ?></td>
      </tr>
    </table>
    <div class="header">
      <div class="ml-20">
        <table class="text-left">
          <tr>
            <td class="strong small gry-color"><?php echo e(__('Bill to') . ':'); ?></td>
          </tr>
          <tr>
            <td class="strong"><?php echo e(ucfirst($member['first_name']) . ' ' . ucfirst($member['last_name'])); ?></td>
          </tr>
          <tr>
            <td class="gry-color small"><strong><?php echo e(__('Username') . ':'); ?> </strong><?php echo e($member['username']); ?></td>
          </tr>
          <tr>
            <td class="gry-color small"><strong><?php echo e(__('Email') . ':'); ?> </strong> <?php echo e($member['email']); ?></td>
          </tr>
          <tr>
            <td class="gry-color small"><strong><?php echo e(__('Phone') . ':'); ?> </strong> <?php echo e($phone); ?></td>
          </tr>
        </table>
      </div>
      <div class="order-details">
        <table class="text-right">
          <tr>
            <td class="strong"><?php echo e(__('Order Details') . ':'); ?></td>
          </tr>
          <tr>
            <td class="gry-color small"><strong><?php echo e(__('Order ID') . ':'); ?></strong> #<?php echo e($order_id); ?></td>
          </tr>
          <tr>
            <td class="gry-color small"><strong>Total:</strong>
              <?php echo e($websiteInfo->base_currency_text_position == 'left' ? $websiteInfo->base_currency_text : ''); ?>

              <?php echo e($amount); ?>

              <?php echo e($websiteInfo->base_currency_text_position == 'right' ? $websiteInfo->base_currency_text : ''); ?></td>
          </tr>
          <tr>
            <td class="gry-color small"><strong><?php echo e(__('Payment Method') . ':'); ?></strong>
              <?php echo e($request['payment_method']); ?></td>
          </tr>
          <tr>
            <td class="gry-color small"><strong><?php echo e(__('Payment Status') . ':'); ?></strong><?php echo e(__('Completed')); ?></td>
          </tr>
          <tr>
            <td class="gry-color small"><strong><?php echo e(__('Order Date') . ':'); ?></strong>
              <?php echo e(\Carbon\Carbon::now()->format('d/m/Y')); ?></td>
          </tr>
        </table>
      </div>
    </div>

    <div class="package-info">
      <table class="padding text-left small border-bottom">
        <thead>
          <tr class="gry-color info-titles">
            <th width="20%"><?php echo e(__('Package Title')); ?></th>
            <th width="20%"><?php echo e(__('Start Date')); ?></th>
            <th width="20%"><?php echo e(__('Expire Date')); ?></th>
            <th width="20%"><?php echo e(__('Currency')); ?></th>
            <th width="20%"><?php echo e(__('Total')); ?></th>
          </tr>
        </thead>
        <tbody class="strong">

          <tr class="text-center">
            <td><?php echo e($package_title); ?></td>
            <td><?php echo e($request['start_date']); ?></td>
            <td>
              <?php echo e(\Carbon\Carbon::parse($request['expire_date'])->format('Y') == '9999' ? 'Lifetime' : $request['expire_date']); ?>

            </td>
            <td><?php echo e($base_currency_text); ?></td>
            <td>
              <?php echo e($amount == 0 ? 'Free' : $amount); ?>

            </td>
          </tr>
        </tbody>
      </table>
    </div>
    <table class="mt-80">
      <tr>
        <td class="text-right regards"><?php echo e(__('Thanks & Regards') . ','); ?></td>
      </tr>
      <tr>
        <td class="text-right strong regards"><?php echo e($websiteInfo->website_title); ?></td>
      </tr>
    </table>
  </div>


</body>

</html>
<?php /**PATH C:\Users\younes\Downloads\junspro-main (1)\junspro-main3\resources\views\pdf\membership.blade.php ENDPATH**/ ?>