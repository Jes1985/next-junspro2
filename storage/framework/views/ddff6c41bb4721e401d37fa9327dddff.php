<?php $__env->startSection('content'); ?>
  <div class="page-header">
    <h4 class="page-title"><?php echo e(__('Order Details')); ?></h4>
    <ul class="breadcrumbs">
      <li class="nav-home">
        <a href="<?php echo e(route('admin.dashboard')); ?>">
          <i class="flaticon-home"></i>
        </a>
      </li>
      <li class="separator">
        <i class="flaticon-right-arrow"></i>
      </li>
      <li class="nav-item">
        <a href="#"><?php echo e(__('Service Orders')); ?></a>
      </li>
      <li class="separator">
        <i class="flaticon-right-arrow"></i>
      </li>
      <li class="nav-item">
        <a href="<?php echo e(route('admin.service_orders')); ?>"><?php echo e(__('All Orders')); ?></a>
      </li>
      <li class="separator">
        <i class="flaticon-right-arrow"></i>
      </li>
      <li class="nav-item">
        <a href="#"><?php echo e(__('Order Details')); ?></a>
      </li>
    </ul>
    <a href="<?php echo e(route('admin.service_orders')); ?>" class="btn btn-primary ml-auto"><?php echo e(__('Back')); ?></a>
  </div>

  <div class="row">
    <?php
      $position = $orderInfo->currency_text_position;
      $currency = $orderInfo->currency_text;
    ?>

    <div class="col-md-6">
      <div class="card">
        <div class="card-header">
          <div class="card-title d-inline-block"><?php echo e(__('Order Information')); ?></div>
        </div>

        <div class="card-body">
          <div class="payment-information">
            <div class="row mb-2">
              <div class="col-lg-3">
                <strong><?php echo e(__('Order No.') . ' :'); ?></strong>
              </div>

              <div class="col-lg-9"><?php echo e('#' . $orderInfo->order_number); ?></div>
            </div>

            <div class="row mb-2">
              <div class="col-lg-3">
                <strong><?php echo e(__('Order Date') . ' :'); ?></strong>
              </div>

              <div class="col-lg-9"><?php echo e(date_format($orderInfo->created_at, 'M d, Y')); ?></div>
            </div>

            <div class="row mb-2">
              <div class="col-lg-3">
                <strong><?php echo e(__('Service') . ' :'); ?></strong>
              </div>

              <div class="col-lg-9">
                <?php if(!empty($serviceTitle->slug)): ?>
                  <a target="_blank"
                    href="<?php echo e(route('service_details', ['slug' => $serviceTitle->slug, 'id' => $orderInfo->service_id])); ?>">
                    <?php echo e($serviceTitle->title); ?>

                  </a>
                <?php else: ?>
                  <?php echo e('-'); ?>

                <?php endif; ?>
              </div>
            </div>

            <div class="row mb-2">
              <div class="col-lg-3">
                <strong><?php echo e(__('Package') . ' :'); ?></strong>
              </div>

              <div class="col-lg-9">
                <?php if(is_null($packageTitle)): ?>
                  -
                <?php else: ?>
                  <?php echo e($packageTitle); ?>

                  (<?php echo e($position == 'left' ? $currency . ' ' : ''); ?><?php echo e($orderInfo->package_price); ?><?php echo e($position == 'right' ? ' ' . $currency : ''); ?>)
                <?php endif; ?>
              </div>
            </div>


            <?php if(!is_null($orderInfo->addons)): ?>
              <?php $addons = json_decode($orderInfo->addons); ?>

              <div class="row mb-2">
                <div class="col-lg-3">
                  <strong><?php echo e(__('Addons') . ' :'); ?></strong>
                </div>

                <div class="col-lg-9">
                  <?php
                    $totalAdonPrice = 0;
                  ?>
                  <?php $__currentLoopData = $addons; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $addon): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php
                      $addonId = $addon->id;

                      $serviceAddon = \App\Models\ClientService\ServiceAddon::query()->find($addonId);
                    ?>

                    <?php echo e($loop->iteration . '.'); ?> <?php echo e($serviceAddon->name); ?>

                    (<?php echo e($position == 'left' ? $currency . ' ' : ''); ?><?php echo e($addon->price); ?><?php echo e($position == 'right' ? ' ' . $currency : ''); ?>)
                    <?php
                      $totalAdonPrice = $totalAdonPrice + $addon->price;
                    ?>
                    <br>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  <hr class="mb-1 mt-1">
                  <p class="mt-0"><?php echo e(__('Total') . ':'); ?>

                    <?php echo e($position == 'left' ? $currency . ' ' : ''); ?><?php echo e($totalAdonPrice); ?><?php echo e($position == 'right' ? ' ' . $currency : ''); ?>

                  </p>
                </div>
              </div>
            <?php endif; ?>

            <?php if(!is_null($orderInfo->seller_id)): ?>
              <div class="row mb-2">
                <div class="col-lg-3">
                  <strong><?php echo e(__('Seller Recived') . ' :'); ?></strong>
                </div>

                <div class="col-lg-9">
                  <?php if(is_null($orderInfo->grand_total)): ?>
                    <?php echo e(__('Requested')); ?>

                  <?php else: ?>
                    <?php echo e($position == 'left' ? $currency . ' ' : ''); ?><?php echo e($orderInfo->grand_total - $orderInfo->tax); ?><?php echo e($position == 'right' ? ' ' . $currency : ''); ?>

                  <?php endif; ?>
                </div>
              </div>
            <?php endif; ?>

            <?php if(!is_null($orderInfo->tax)): ?>
              <div class="row mb-2">
                <div class="col-lg-3">
                  <strong><?php echo e(__('Tax')); ?> (<?php echo e($orderInfo->tax_percentage . '%'); ?>) <i
                      class="fas fa-plus text-success text-small"></i> : </strong>
                </div>

                <div class="col-lg-9">
                  <?php echo e($position == 'left' ? $currency . ' ' : ''); ?><?php echo e($orderInfo->tax); ?><?php echo e($position == 'right' ? ' ' . $currency : ''); ?>

                  <?php echo e(__('(Received by Admin)')); ?>

                </div>
              </div>
            <?php endif; ?>

            <div class="row mb-2">
              <div class="col-lg-3">
                <strong><?php echo e(__('Total') . ' :'); ?></strong>
              </div>

              <div class="col-lg-9">
                <?php if(is_null($orderInfo->grand_total)): ?>
                  <?php echo e(__('Requested')); ?>

                <?php else: ?>
                  <?php echo e($position == 'left' ? $currency . ' ' : ''); ?><?php echo e($orderInfo->grand_total); ?><?php echo e($position == 'right' ? ' ' . $currency : ''); ?>

                <?php endif; ?>
              </div>
            </div>

            <div class="row mb-2">
              <div class="col-lg-3">
                <strong><?php echo e(__('Paid via') . ' :'); ?></strong>
              </div>

              <div class="col-lg-9">
                <?php if(is_null($orderInfo->payment_method)): ?>
                  -
                <?php else: ?>
                  <?php echo e($orderInfo->payment_method); ?>

                <?php endif; ?>
              </div>
            </div>

            <div class="row mb-2">
              <div class="col-lg-3">
                <strong><?php echo e(__('Payment Status') . ' :'); ?></strong>
              </div>

              <div class="col-lg-9">
                <?php if($orderInfo->gateway_type == 'online'): ?>
                  <?php if($orderInfo->payment_status == 'completed'): ?>
                    <span class="badge badge-success"><?php echo e(__('Completed')); ?></span>
                  <?php else: ?>
                    <span class="badge badge-warning"><?php echo e(__('Pending')); ?></span>
                  <?php endif; ?>
                <?php else: ?>
                  <?php if($orderInfo->payment_status == 'pending'): ?>
                    <form id="paymentStatusForm" class="d-inline-block"
                      action="<?php echo e(route('admin.service_order.update_payment_status', ['id' => $orderInfo->id])); ?>"
                      method="post">
                      <?php echo csrf_field(); ?>
                      <select
                        class="form-control form-control-sm <?php if($orderInfo->payment_status == 'completed'): ?> bg-success <?php elseif($orderInfo->payment_status == 'pending'): ?> bg-warning text-dark <?php else: ?> bg-danger <?php endif; ?>"
                        name="payment_status" onchange="document.getElementById('paymentStatusForm').submit()">
                        <option value="completed" <?php echo e($orderInfo->payment_status == 'completed' ? 'selected' : ''); ?>>
                          <?php echo e(__('Completed')); ?>

                        </option>
                        <option value="pending" <?php echo e($orderInfo->payment_status == 'pending' ? 'selected' : ''); ?>>
                          <?php echo e(__('Pending')); ?>

                        </option>
                        <option value="rejected" <?php echo e($orderInfo->payment_status == 'rejected' ? 'selected' : ''); ?>>
                          <?php echo e(__('Rejected')); ?>

                        </option>
                      </select>
                    </form>
                  <?php else: ?>
                    <?php if($orderInfo->payment_status == 'completed'): ?>
                      <span class="badge badge-success"><?php echo e(__('Completed')); ?></span>
                    <?php elseif($orderInfo->payment_status == 'pending'): ?>
                      <span class="badge badge-warning"><?php echo e(__('Pending')); ?></span>
                    <?php else: ?>
                      <span class="badge badge-danger"><?php echo e(__('Rejected')); ?></span>
                    <?php endif; ?>
                  <?php endif; ?>
                <?php endif; ?>
              </div>
            </div>

            <div class="row mb-1">
              <div class="col-lg-3">
                <strong><?php echo e(__('Order Status') . ' :'); ?></strong>
              </div>

              <div class="col-lg-9">
                <?php if($orderInfo->order_status == 'pending'): ?>
                  <form class="d-inline-block completeForm"
                    action="<?php echo e(route('admin.service_order.update_order_status', ['id' => $orderInfo->id])); ?>"
                    method="post">
                    <?php echo csrf_field(); ?>
                    <select
                      class="form-control completeBtn form-control-sm <?php if($orderInfo->order_status == 'pending'): ?> bg-warning text-dark <?php elseif($orderInfo->order_status == 'processing'): ?> bg-primary <?php elseif($orderInfo->order_status == 'completed'): ?> bg-success <?php elseif($orderInfo->order_status == 'rejected'): ?> bg-danger <?php endif; ?>"
                      name="order_status">
                      <option disabled value="pending" <?php echo e($orderInfo->order_status == 'pending' ? 'selected' : ''); ?>>
                        <?php echo e(__('Pending')); ?>

                      </option>
                      <option value="completed" <?php echo e($orderInfo->order_status == 'completed' ? 'selected' : ''); ?>>
                        <?php echo e(__('Completed')); ?>

                      </option>
                      <option value="rejected" <?php echo e($orderInfo->order_status == 'rejected' ? 'selected' : ''); ?>>
                        <?php echo e(__('Rejected')); ?>

                      </option>
                    </select>
                  </form>
                <?php else: ?>
                  <?php if($orderInfo->order_status == 'completed'): ?>
                    <span class="badge badge-success"><?php echo e(__('Completed')); ?></span>
                  <?php else: ?>
                    <span class="badge badge-danger"><?php echo e(__('Rejected')); ?></span>
                  <?php endif; ?>
                <?php endif; ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-md-3">
      <div class="card">
        <div class="card-header">
          <div class="card-title d-inline-block">
            <?php echo e(__('Customer Information')); ?>

          </div>
        </div>

        <div class="card-body">
          <div class="payment-information">
            <div class="row mb-2">
              <div class="col-lg-4">
                <strong><?php echo e(__('Name') . ' :'); ?></strong>
              </div>

              <div class="col-lg-8"><?php echo e($orderInfo->name); ?></div>
            </div>

            <div class="row mb-2">
              <div class="col-lg-4">
                <strong><?php echo e(__('Email') . ' :'); ?></strong>
              </div>

              <div class="col-lg-8"><?php echo e(@$orderInfo->email_address); ?></div>
            </div>

            <?php $informations = json_decode($orderInfo->informations); ?>

            <?php if(!is_null($informations)): ?>
              <?php $__currentLoopData = $informations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $information): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php
                  $length = count((array) $informations);
                  $str = preg_replace('/_/', ' ', $key);
                  $label = mb_convert_case($str, MB_CASE_TITLE);
                ?>

                <?php if($information->type == 8): ?>
                  <div class="row <?php echo e($loop->iteration == $length ? 'mb-1' : 'mb-2'); ?>">
                    <div class="col-lg-4">
                      <strong><?php echo e($label . ' :'); ?></strong>
                    </div>

                    <div class="col-lg-8">
                      <a href="<?php echo e(asset('assets/file/zip-files/' . $information->value)); ?>"
                        download="<?php echo e($information->originalName); ?>" class="btn btn-sm btn-primary">
                        <?php echo e(__('Download')); ?>

                      </a>
                    </div>
                  </div>
                <?php elseif($information->type == 5): ?>
                  <div class="row <?php echo e($loop->iteration == $length ? 'mb-1' : 'mb-2'); ?>">
                    <div class="col-lg-4">
                      <strong><?php echo e($label . ' :'); ?></strong>
                    </div>

                    <div class="col-lg-8">
                      <a href="#" class="btn btn-sm btn-info" data-toggle="modal"
                        data-target="#textModal-<?php echo e($loop->iteration); ?>">
                        <?php echo e(__('Show')); ?>

                      </a>
                    </div>
                  </div>

                  <?php echo $__env->make('backend.client-service.order.show-text', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                <?php elseif($information->type == 4): ?>
                  <div class="row <?php echo e($loop->iteration == $length ? 'mb-1' : 'mb-2'); ?>">
                    <div class="col-lg-4">
                      <strong><?php echo e($label . ' :'); ?></strong>
                    </div>

                    <div class="col-lg-8">
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

                    </div>
                  </div>
                <?php else: ?>
                  <div class="row <?php echo e($loop->iteration == $length ? 'mb-1' : 'mb-2'); ?>">
                    <div class="col-lg-4">
                      <strong><?php echo e($label . ' :'); ?></strong>
                    </div>

                    <div class="col-lg-8"><?php echo e($information->value); ?></div>
                  </div>
                <?php endif; ?>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </div>
    <?php if($orderInfo->seller_id != 0): ?>
      <div class="col-md-3">
        <div class="card">
          <div class="card-header">
            <div class="card-title d-inline-block">
              <?php echo e(__('Seller Information')); ?>

            </div>
          </div>
          <?php
            if ($orderInfo->seller) {
                $sellerInfo = $orderInfo->seller
                    ->seller_info()
                    ->where('language_id', $defaultLang->id)
                    ->first();
            } else {
                $sellerInfo = null;
            }
          ?>
          <div class="card-body">
            <div class="payment-information">
              <div class="row mb-2">
                <div class="col-lg-4">
                  <strong><?php echo e(__('Username') . ' :'); ?></strong>
                </div>

                <div class="col-lg-8">
                  <a
                    href="<?php echo e(route('admin.seller_management.seller_details', ['id' => $orderInfo->seller_id, 'language' => $defaultLang->code])); ?>"><?php echo e(@$orderInfo->seller->username); ?></a>
                </div>
              </div>
              <div class="row mb-2">
                <div class="col-lg-4">
                  <strong><?php echo e(__('Name') . ' :'); ?></strong>
                </div>

                <div class="col-lg-8"><?php echo e(@$sellerInfo->name); ?></div>
              </div>

              <div class="row mb-2">
                <div class="col-lg-4">
                  <strong><?php echo e(__('Email') . ' :'); ?></strong>
                </div>

                <div class="col-lg-8"><?php echo e(@$orderInfo->seller->email); ?></div>
              </div>

              <div class="row mb-2">
                <div class="col-lg-4">
                  <strong><?php echo e(__('Phone Number') . ' :'); ?></strong>
                </div>

                <div class="col-lg-8"><?php echo e(@$orderInfo->seller->phone); ?></div>
              </div>

              <?php if(!is_null($sellerInfo)): ?>
                <?php if(!is_null($sellerInfo->address)): ?>
                  <div class="row mb-2">
                    <div class="col-lg-4">
                      <strong><?php echo e(__('Address') . ' :'); ?></strong>
                    </div>

                    <div class="col-lg-8"><?php echo e(@$sellerInfo->address); ?></div>
                  </div>
                <?php endif; ?>

                <?php if(!is_null($sellerInfo->city)): ?>
                  <div class="row mb-2">
                    <div class="col-lg-4">
                      <strong><?php echo e(__('City') . ' :'); ?></strong>
                    </div>

                    <div class="col-lg-8"><?php echo e(@$sellerInfo->city); ?></div>
                  </div>
                <?php endif; ?>

                <?php if(!is_null($sellerInfo->state)): ?>
                  <div class="row mb-2">
                    <div class="col-lg-4">
                      <strong><?php echo e(__('State') . ' :'); ?></strong>
                    </div>

                    <div class="col-lg-8"><?php echo e(@$sellerInfo->state); ?></div>
                  </div>
                <?php endif; ?>
                <?php if(!is_null($sellerInfo->country)): ?>
                  <div class="row mb-2">
                    <div class="col-lg-4">
                      <strong><?php echo e(__('Country') . ' :'); ?></strong>
                    </div>

                    <div class="col-lg-8"><?php echo e(@$sellerInfo->country); ?></div>
                  </div>
                <?php endif; ?>
              <?php endif; ?>

            </div>
          </div>
        </div>
      </div>
    <?php endif; ?>
  </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\younes\Downloads\junspro-main (1)\junspro-main3\resources\views\backend\client-service\order\details.blade.php ENDPATH**/ ?>