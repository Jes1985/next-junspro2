<?php $title = __('Service Order Details'); ?>

<?php $__env->startSection('pageHeading'); ?>
  <?php echo e($title); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
  <?php if ($__env->exists('frontend.partials.breadcrumb', ['breadcrumb' => $breadcrumb, 'title' => $title])) echo $__env->make('frontend.partials.breadcrumb', ['breadcrumb' => $breadcrumb, 'title' => $title], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

  <!--====== Start Service Order Details ======-->
  <section class="user-dashboard pt-100 pb-60">
    <div class="container">
      <div class="row">
        <?php if ($__env->exists('frontend.user.side-navbar')) echo $__env->make('frontend.user.side-navbar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

        <div class="col-lg-9">
          <div class="row">
            <div class="col-lg-12">
              <div class="user-profile-details mb-40">
                <div class="order-details">
                  <div class="title">
                    <h4><?php echo e(__('Details')); ?></h4>
                  </div>

                  <div class="view-order-page">
                    <div class="order-info-area">
                      <div class="row align-items-center">
                        <div class="col-lg-8">
                          <div class="order-info">
                            <h3><?php echo e(__('Order') . ': #' . $orderInfo->order_number); ?></h3>
                            <p><?php echo e(__('Order Date') . ': ' . date_format($orderInfo->created_at, 'M d, Y')); ?></p>
                          </div>
                        </div>

                        <?php if(!is_null($orderInfo->invoice)): ?>
                          <?php
                            $slug = @$serviceInfo->slug;
                            $date = $orderInfo->created_at->toDateString();
                          ?>

                          <div class="col-lg-4">
                            <div class="download">
                              <a href="<?php echo e(asset('assets/file/invoices/service/' . $orderInfo->invoice)); ?>"
                                download="<?php echo e($slug . '-' . $date . '.pdf'); ?>" class="btn btn-lg btn-primary radius-sm">
                                <i class="fas fa-download"></i> <?php echo e(__('Invoice')); ?>

                              </a>
                            </div>
                          </div>
                        <?php endif; ?>
                      </div>
                    </div>
                  </div>

                  <div class="billing-add-area mb-0">
                    <?php
                      $position = $orderInfo->currency_symbol_position;
                      $symbol = $orderInfo->currency_symbol;
                    ?>

                    <div class="row">
                      <div class="col-md-6">
                        <div class="main-info">
                          <h5><?php echo e(__('Information')); ?></h5>
                          <ul class="list list-unstyled">
                            <li>
                              <p><span><?php echo e(__('Name') . ':'); ?></span><?php echo e($orderInfo->name); ?></p>
                            </li>

                            <li>
                              <p><span><?php echo e(__('Email') . ':'); ?></span><?php echo e($orderInfo->email_address); ?></p>
                            </li>
                            <?php $informations = json_decode($orderInfo->informations); ?>

                            <?php if(!is_null($informations)): ?>
                              <?php $__currentLoopData = $informations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $information): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php
                                  $str = preg_replace('/_/', ' ', $key);
                                  $label = mb_convert_case($str, MB_CASE_TITLE);
                                ?>

                                <?php if($information->type == 8): ?>
                                  <li>
                                    <p>
                                      <span><?php echo e(__($label) . ':'); ?></span>
                                      <a href="<?php echo e(asset('assets/file/zip-files/' . $information->value)); ?>" download
                                        class="btn btn-sm btn-primary rounded-1">
                                        <?php echo e(__('Download')); ?>

                                      </a>
                                    </p>
                                  </li>
                                <?php elseif($information->type == 4): ?>
                                  <li>
                                    <p>
                                      <span><?php echo e(__($label) . ':'); ?></span>

                                      <?php
                                        $checkboxValues = $information->value;
                                        $allCheckboxOptions = '';
                                        $lastElement = end($checkboxValues);

                                        foreach ($checkboxValues as $value) {
                                            if ($value == $lastElement) {
                                                $allCheckboxOptions .= $value;
                                            } else {
                                                $allCheckboxOptions .= $value . ', ';
                                            }
                                        }
                                      ?>

                                      <?php echo e($allCheckboxOptions); ?>

                                    </p>
                                  </li>
                                <?php elseif($information->type == 5): ?>
                                  <li>
                                    <p>
                                      <span><?php echo e(__($label) . ':'); ?></span>
                                      <button type="button" class="btn btn-sm btn-primary rounded-1"
                                        data-bs-toggle="modal" data-bs-target="#textAreaModal-<?php echo e($key); ?>">
                                        <?php echo e(__('Show')); ?>

                                      </button>
                                    </p>
                                  </li>

                                  <?php if ($__env->exists('frontend.user.textarea-data')) echo $__env->make('frontend.user.textarea-data', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                                <?php else: ?>
                                  <li>
                                    <p><span><?php echo e(__($label) . ':'); ?></span><?php echo e($information->value); ?></p>
                                  </li>
                                <?php endif; ?>
                              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                          </ul>
                        </div>
                      </div>

                      <div class="col-md-6">
                        <div class="main-info">
                          <h5><?php echo e(__('Order Information')); ?></h5>
                          <ul class="list list-unstyled">
                            <li>
                              <p><span><?php echo e(__('Service') . ':'); ?></span><?php echo e(@$serviceInfo->title); ?></p>
                            </li>

                            <?php if(!is_null($packageTitle)): ?>
                              <li>
                                <p><span><?php echo e(__('Package') . ':'); ?></span><?php echo e($packageTitle); ?>

                                  (<?php echo e($position == 'left' ? $symbol : ''); ?><?php echo e(formatPrice(number_format($orderInfo->package_price, 2))); ?><?php echo e($position == 'right' ? $symbol : ''); ?>)
                                </p>
                              </li>
                            <?php endif; ?>

                            <?php if(!is_null($orderInfo->addons)): ?>
                              <?php $addons = json_decode($orderInfo->addons); ?>

                              <li>
                                <span class="d-block"><?php echo e(__('Addons') . ':'); ?></span>
                                <div class="ps-3">
                                  <?php
                                    $addonTotal = 0;
                                  ?>
                                  <?php $__currentLoopData = $addons; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $addon): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php
                                      $addonId = $addon->id;

                                      $serviceAddon = \App\Models\ClientService\ServiceAddon::query()->find($addonId);
                                    ?>

                                    <span>
                                      <?php echo e($loop->iteration . '.'); ?> <?php echo e($serviceAddon->name); ?>

                                      (<?php echo e($position == 'left' ? $symbol : ''); ?><?php echo e(formatPrice($addon->price)); ?><?php echo e($position == 'right' ? $symbol : ''); ?>)
                                    </span>
                                    <br>
                                    <?php
                                      $addonTotal = $addonTotal + $addon->price;
                                    ?>
                                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                                <hr class="mt-1 mb-1">
                                <p>
                                  <span><?php echo e(__('Total' . ':')); ?></span>
                                  <?php echo e($position == 'left' ? $symbol : ''); ?><?php echo e(formatPrice($addonTotal)); ?><?php echo e($position == 'right' ? $symbol : ''); ?>

                                </p>
                              </li>
                            <?php endif; ?>
                            <li>
                              <p>
                                <span><?php echo e(__('Tax')); ?> (<?php echo e($orderInfo->tax_percentage . '%'); ?>) :
                                </span><?php echo e($position == 'left' ? $symbol : ''); ?><?php echo e(formatPrice(number_format($orderInfo->tax, 2))); ?><?php echo e($position == 'right' ? $symbol : ''); ?>

                              </p>
                            </li>

                            <?php if(is_null($orderInfo->grand_total)): ?>
                              <li>
                                <p><span><?php echo e(__('Total') . ':'); ?></span><?php echo e(__('Price Requested')); ?></p>
                              </li>
                            <?php else: ?>
                              <li>
                                <p>
                                  <span><?php echo e(__('Total') . ':'); ?></span><?php echo e($position == 'left' ? $symbol : ''); ?><?php echo e(formatPrice(number_format($orderInfo->grand_total, 2))); ?><?php echo e($position == 'right' ? $symbol : ''); ?>

                                </p>
                              </li>
                            <?php endif; ?>

                            <?php if(!is_null($orderInfo->payment_method)): ?>
                              <li>
                                <p><span><?php echo e(__('Paid via') . ':'); ?></span><?php echo e($orderInfo->payment_method); ?></p>
                              </li>
                            <?php endif; ?>

                            <li>
                              <p><span><?php echo e(__('Payment Status') . ':'); ?></span>
                                <?php if($orderInfo->payment_status == 'completed'): ?>
                                  <span class="badge px-2 py-1" style="background: rgba(79, 70, 229, 0.12); color: #4F46E5;"><?php echo e(__('Completed')); ?></span>
                                <?php elseif($orderInfo->payment_status == 'pending'): ?>
                                  <span class="badge bg-warning px-2 py-1"><?php echo e(__('Pending')); ?></span>
                                <?php else: ?>
                                  <span class="badge bg-danger px-2 py-1"><?php echo e(__('Rejected')); ?></span>
                                <?php endif; ?>
                              </p>
                            </li>

                            <li>
                              <p><span><?php echo e(__('Order Status') . ':'); ?></span>
                                <?php if($orderInfo->order_status == 'pending'): ?>
                                  <span class="badge bg-warning px-2 py-1"><?php echo e(__('Pending')); ?></span>
                                <?php elseif($orderInfo->order_status == 'completed'): ?>
                                  <span class="badge px-2 py-1" style="background: rgba(79, 70, 229, 0.12); color: #4F46E5;"><?php echo e(__('Completed')); ?></span>
                                <?php else: ?>
                                  <span class="badge bg-danger px-2 py-1"><?php echo e(__('Rejected')); ?></span>
                                <?php endif; ?>
                              </p>
                            </li>
                          </ul>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!--====== End Service Order Details ======-->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\younes\Downloads\junspro-main (1)\junspro-main3\resources\views\frontend\user\service-order-details.blade.php ENDPATH**/ ?>