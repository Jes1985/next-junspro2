<?php $__env->startSection('metaKeywords'); ?>
  <?php echo e($seoInfo->meta_keyword_invoice_payment ?? ''); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('metaDescription'); ?>
  <?php echo e($seoInfo->meta_description_invoice_payment ?? ''); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('style'); ?>
  <link rel="stylesheet" href="<?php echo e(asset('assets/css/summernote-content.css')); ?>">
<?php $__env->stopSection(); ?>

<?php
  $pageTitle = __('Invoice Payment');
  $serviceTitle = 'Invoice #' . $invoice->id;
?>


<?php $__env->startSection('pageHeading'); ?>
  <?php echo e($pageTitle); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
  <?php if ($__env->exists('frontend.partials.breadcrumb', ['breadcrumb' => $breadcrumb, 'title' => $pageTitle])) echo $__env->make('frontend.partials.breadcrumb', ['breadcrumb' => $breadcrumb, 'title' => $pageTitle], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

  <section class="service-checkout-area pt-120 pb-120">
    <div class="container">
      
      <?php $__errorArgs = ['attachment'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
        <div class="row mb-3">
          <div class="col">
            <div class="alert alert-danger alert-block">
              <strong><?php echo e($message); ?></strong>
              <button type="button" class="close" data-dismiss="alert">×</button>
            </div>
          </div>
        </div>
      <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>



      <div class="row mb-2">
        <div class="col-12">
          <?php
            $items = json_decode($invoice->items);
            $position = $invoice->base_currency_symbol_position;
            $symbol = $invoice->base_currency_symbol;
          ?>

          <table class="table table-bordered">
            <thead>
              <tr>
                <th scope="col"><?php echo e(__('ITEM')); ?></th>
                <th scope="col"><?php echo e(__('QUANTITY')); ?></th>
                <th scope="col"><?php echo e(__('UNIT PRICE')); ?></th>
                <th scope="col"><?php echo e(__('AMOUNT')); ?></th>
              </tr>
            </thead>
            <tbody>
              <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php
                  $quantity = intval($item->quantity);
                  $unitPrice = floatval($item->unit_price);
                  $eachItemTotal = $quantity * $unitPrice;
                ?>

                <tr>
                  <td><?php echo e($item->title); ?></td>
                  <td><?php echo e($quantity); ?></td>
                  <td>
                    <?php echo e($position == 'left' ? $symbol : ''); ?><?php echo e(formatPrice(number_format($unitPrice, 2))); ?><?php echo e($position == 'right' ? $symbol : ''); ?>

                  </td>
                  <td>
                    <?php echo e($position == 'left' ? $symbol : ''); ?><?php echo e(formatPrice(number_format($eachItemTotal, 2))); ?><?php echo e($position == 'right' ? $symbol : ''); ?>

                  </td>
                </tr>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
          </table>
        </div>
      </div>
      <div class="row align-items-center">

        <div class="col-lg-6 ">
          <?php
            $position = $invoice->base_currency_symbol_position;
            $symbol = $invoice->base_currency_symbol;
          ?>
          <table class="table table-bordered table-striped mb-0">
            <tr>
              <td>
                <p><?php echo e(__('Total')); ?></p>
              </td>
              <td>
                <p>
                  <?php echo e($position == 'left' ? $symbol : ''); ?><?php echo e(formatPrice(number_format($invoice->total, 2))); ?><?php echo e($position == 'right' ? $symbol : ''); ?>

                </p>
              </td>
            </tr>
            <tr>
              <td>
                <p><?php echo e(__('Discount')); ?></p>
              </td>
              <td>
                <p>
                  <?php if(is_null($invoice->discount)): ?>
                    <?php echo e($position == 'left' ? $symbol : ''); ?><?php echo e(formatPrice(number_format(0, 2))); ?><?php echo e($position == 'right' ? $symbol : ''); ?>

                  <?php else: ?>
                    <?php echo e($position == 'left' ? $symbol : ''); ?><?php echo e(formatPrice(number_format($invoice->discount, 2))); ?><?php echo e($position == 'right' ? $symbol : ''); ?>

                  <?php endif; ?>
                </p>
              </td>
            </tr>
            <tr>
              <td>
                <p><?php echo e(__('Subtotal')); ?></p>
              </td>
              <td>
                <p>
                  <?php echo e($position == 'left' ? $symbol : ''); ?><?php echo e(formatPrice(number_format($invoice->subtotal, 2))); ?><?php echo e($position == 'right' ? $symbol : ''); ?>

                </p>
              </td>
            </tr>
            <tr>
              <td>
                <p>
                  <?php if(is_null($invoice->tax)): ?>
                    <?php echo e(__('Tax')); ?>

                  <?php else: ?>
                    <?php echo e(__('Tax') . ' (' . formatPrice($invoice->tax) . '%)'); ?>

                  <?php endif; ?>
                </p>
              </td>
              <td>
                <p>
                  <?php if(is_null($invoice->tax)): ?>
                    <?php echo e($position == 'left' ? $symbol : ''); ?><?php echo e(formatPrice(number_format(0, 2))); ?><?php echo e($position == 'right' ? $symbol : ''); ?>

                  <?php else: ?>
                    <?php
                      $subtotal = floatval($invoice->subtotal);
                      $taxPercentage = floatval($invoice->tax);
                      $tax = $subtotal * ($taxPercentage / 100);
                    ?>

                    <?php echo e($position == 'left' ? $symbol : ''); ?><?php echo e(formatPrice(number_format($tax, 2))); ?><?php echo e($position == 'right' ? $symbol : ''); ?>

                  <?php endif; ?>
                </p>
              </td>
            </tr>
            <tr>
              <td>
                <p><?php echo e(__('Grand Total')); ?></p>
              </td>
              <td>
                <p>
                  <?php echo e($position == 'left' ? $symbol : ''); ?><?php echo e(formatPrice(number_format($invoice->grand_total, 2))); ?><?php echo e($position == 'right' ? $symbol : ''); ?>

                </p>
              </td>
            </tr>
          </table>

        </div>
        <div class=" col-lg-6  ">
          <form action="<?php echo e(route('pay')); ?>" method="POST" enctype="multipart/form-data" id="payment-form">
            <?php echo csrf_field(); ?>
            <div class="row d-flex align-items-end">
              <div class="col-lg-8  ">
                <div class="form-group">
                  <label class="font-weight-bold"><?php echo e(__('Pay via') . '*'); ?></label>
                  <select class="form-control" name="gateway">
                    <option selected disabled><?php echo e(__('Select a Payment Gateway')); ?></option>

                    <?php if(count($onlineGateways) > 0): ?>
                      <?php $__currentLoopData = $onlineGateways; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $onlineGateway): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($onlineGateway->keyword); ?>" data-gateway_type="online">
                          <?php echo e(__($onlineGateway->name)); ?>

                        </option>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>

                    <?php if(count($offlineGateways) > 0): ?>
                      <?php $__currentLoopData = $offlineGateways; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $offlineGateway): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($offlineGateway->id); ?>" data-gateway_type="offline"
                          data-has_attachment="<?php echo e($offlineGateway->has_attachment); ?>">
                          <?php echo e(__($offlineGateway->name)); ?>

                        </option>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>
                  </select>
                </div>

              </div>
              <div class="col-lg-4 ">
                <button class="main-btn w-100" id="payment-form-btn">
                  <?php echo e(__('Pay')); ?>

                </button>
              </div>

            </div>

            <div style="<?php if(
                $errors->has('card_number') ||
                    $errors->has('cvc_number') ||
                    $errors->has('expiry_month') ||
                    $errors->has('expiry_year')): ?> display: block; <?php else: ?> display: none; <?php endif; ?>" id="stripe-form">
              <div class="row">
                <div class="col-md-6 mb-4">
                  <div class="form-group">
                    <label><?php echo e(__('Card Number') . '*'); ?></label>
                    <input type="text" class="form-control" name="card_number" autocomplete="off"
                      oninput="checkCard(this.value)" placeholder="Enter Card Number">
                    <p class="mt-1 text-danger" id="card-error"></p>
                    <?php $__errorArgs = ['card_number'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                      <p class="mt-1 text-danger"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                  </div>
                </div>

                <div class="col-md-6 mb-4">
                  <div class="form-group">
                    <label><?php echo e(__('CVC Number') . '*'); ?></label>
                    <input type="text" class="form-control" name="cvc_number" autocomplete="off"
                      oninput="checkCVC(this.value)" placeholder="Enter CVC Number">
                    <p class="mt-1 text-danger" id="cvc-error"></p>
                    <?php $__errorArgs = ['cvc_number'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                      <p class="mt-1 text-danger"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                  </div>
                </div>

                <div class="col-md-6 mb-4">
                  <div class="form-group">
                    <label><?php echo e(__('Expiry Month') . '*'); ?></label>
                    <input type="text" class="form-control" name="expiry_month" placeholder="Enter Expiry Month">
                    <?php $__errorArgs = ['expiry_month'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                      <p class="mt-1 text-danger"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                  </div>
                </div>

                <div class="col-md-6 mb-4">
                  <div class="form-group">
                    <label><?php echo e(__('Expiry Year') . '*'); ?></label>
                    <input type="text" class="form-control" name="expiry_year" placeholder="Enter Expiry Year">
                    <?php $__errorArgs = ['expiry_year'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                      <p class="mt-1 text-danger"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                  </div>
                </div>
              </div>
            </div>

            <div class="mdf_display_none" id="authorizenet-form">
              <div class="row">
                <div class="col-md-6 mb-4">
                  <div class="form-group">
                    <label><?php echo e(__('Card Number') . '*'); ?></label>
                    <input type="text" class="form-control" id="cardNumber" autocomplete="off"
                      placeholder="Enter Card Number">
                  </div>
                </div>

                <div class="col-md-6 mb-4">
                  <div class="form-group">
                    <label><?php echo e(__('Card Code') . '*'); ?></label>
                    <input type="text" class="form-control" id="cardCode" autocomplete="off"
                      placeholder="Enter Card Code">
                  </div>
                </div>

                <div class="col-md-6 mb-4">
                  <div class="form-group">
                    <label><?php echo e(__('Expiry Month') . '*'); ?></label>
                    <input type="text" class="form-control" id="expMonth" placeholder="Enter Expiry Month">
                  </div>
                </div>

                <div class="col-md-6 mb-4">
                  <div class="form-group">
                    <label><?php echo e(__('Expiry Year') . '*'); ?></label>
                    <input type="text" class="form-control" id="expYear" placeholder="Enter Expiry Year">
                  </div>
                </div>

                <input type="hidden" name="opaqueDataValue" id="opaqueDataValue">
                <input type="hidden" name="opaqueDataDescriptor" id="opaqueDataDescriptor">

                <ul id="anetErrors"></ul>
              </div>
            </div>

            <?php if(count($offlineGateways) > 0): ?>
              <div class="row">
                <div class="col-12">
                  <?php $__currentLoopData = $offlineGateways; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $offlineGateway): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if($offlineGateway->has_attachment == 1): ?>
                      <div class="form-group mb-3 mdf_display_none"
                        id="<?php echo e('gateway-attachment-' . $offlineGateway->id); ?>">
                        <label><?php echo e(__('Attachment') . '*'); ?></label>
                        <input type="file" name="attachment">
                        <span class="text-warning">
                          <?php echo e(__('Note: File type only jpg, jpeg, png and svg')); ?>.
                        </span>
                      </div>
                    <?php endif; ?>

                    <?php if(!is_null($offlineGateway->short_description)): ?>
                      <div class="form-group mb-3 mdf_display_none"
                        id="<?php echo e('gateway-description-' . $offlineGateway->id); ?>">
                        <label><strong><?php echo e(__('Description')); ?></strong></label>
                        <br>
                        <p><?php echo e($offlineGateway->short_description); ?></p>
                      </div>
                    <?php endif; ?>

                    <?php if(!is_null($offlineGateway->instructions)): ?>
                      <div class="form-group mb-3 mdf_display_none"
                        id="<?php echo e('gateway-instructions-' . $offlineGateway->id); ?>">
                        <label><strong><?php echo e(__('Instructions')); ?></strong></label>
                        <br>
                        <p class="summernote-content m-0">
                          <?php echo replaceBaseUrl($offlineGateway->instructions, 'summernote'); ?>

                        </p>
                      </div>
                    <?php endif; ?>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
              </div>
            <?php endif; ?>


          </form>
        </div>
      </div>


      <div class="row mt-4">

      </div>

    </div>
  </section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
  <script type="text/javascript" src="https://js.stripe.com/v3/"></script>

  <script type="text/javascript">
    const clientKey = '<?php echo e($anetClientKey); ?>';
    const loginId = '<?php echo e($anetLoginId); ?>';
  </script>

  <script type="text/javascript" src="<?php echo e($anetSource); ?>" charset="utf-8"></script>

  <script type="text/javascript" src="<?php echo e(asset('assets/js/service.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\younes\Downloads\junspro-main (1)\junspro-main3\resources\views\frontend\payment\form.blade.php ENDPATH**/ ?>