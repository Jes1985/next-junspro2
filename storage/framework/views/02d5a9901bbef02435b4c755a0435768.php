<?php
  $pageTitle = $quoteBtnStatus == 0 ? __('Service Checkout') : __('Request A Quote');
?>

<?php $__env->startSection('pageHeading'); ?>
  <?php echo e($pageTitle); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('metaKeywords'); ?>
  <?php echo e($seoInfo->meta_keyword_service_order ?? ''); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('metaDescription'); ?>
  <?php echo e($seoInfo->meta_description_service_order ?? ''); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
  <?php if ($__env->exists('frontend.partials.breadcrumb', [
      'breadcrumb' => $breadcrumb,
      'serviceTitle' => $serviceTitle,
      'title' => $pageTitle,
  ])) echo $__env->make('frontend.partials.breadcrumb', [
      'breadcrumb' => $breadcrumb,
      'serviceTitle' => $serviceTitle,
      'title' => $pageTitle,
  ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

  <!--====== Start Service Checkout Area ======-->
  <section class="service-checkout-area pt-100 pb-60">
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


      <form action="<?php echo e(route('service.place_order', ['slug' => request()->route('slug')])); ?>" method="POST"
        enctype="multipart/form-data" id="payment-form">
        <?php echo csrf_field(); ?>
        <div class="row">
          <div class=" <?php if($quoteBtnStatus == 0): ?> col-lg-8 <?php else: ?> col-12 <?php endif; ?>">
            <input type="hidden" name="quote_btn_status" value="<?php echo e($quoteBtnStatus); ?>">
            <div class="row mb-40">
              <div class="col-md-6">
                <?php
                  if (!empty($authUser->first_name) && !empty($authUser->last_name)) {
                      $authUserName = $authUser->first_name . ' ' . $authUser->last_name;
                  } else {
                      $authUserName = '';
                  }
                ?>

                <div class="form-group mb-30">
                  <label><?php echo e(__('Name') . '*'); ?></label>
                  <input type="text" class="form-control" name="name" placeholder="<?php echo e(__('Enter Your Full Name')); ?>"
                    value="<?php echo e(old('name') ? old('name') : $authUserName); ?>">
                  <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <p class="mt-2 text-danger"><?php echo e($message); ?></p>
                  <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-group mb-30">
                  <label><?php echo e(__('Email Address') . '*'); ?></label>
                  <input type="email" class="form-control" name="email_address"
                    placeholder="<?php echo e(__('Enter Your Email Address')); ?>"
                    value="<?php echo e(old('email_address') ? old('email_address') : $authUser->email_address); ?>">
                  <?php $__errorArgs = ['email_address'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <p class="mt-2 text-danger"><?php echo e($message); ?></p>
                  <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
              </div>


              <?php $__currentLoopData = $inputFields; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $inputField): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if($inputField->type == 1): ?>
                  <div class="col-md-6">
                    <div class="form-group mb-30">
                      <label>
                        <?php echo e(__($inputField->label)); ?><?php echo e($inputField->is_required == 1 ? '*' : ''); ?>

                      </label>
                      <input type="text" class="form-control" name="<?php echo e($inputField->name); ?>"
                        placeholder="<?php echo e(__($inputField->placeholder)); ?>" value="<?php echo e(old($inputField->name)); ?>">
                      <?php $__errorArgs = [$inputField->name];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="mt-2 text-danger"><?php echo e($message); ?></p>
                      <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                  </div>
                <?php elseif($inputField->type == 2): ?>
                  <div class="col-md-6">
                    <div class="form-group mb-30">
                      <label>
                        <?php echo e(__($inputField->label)); ?><?php echo e($inputField->is_required == 1 ? '*' : ''); ?>

                      </label>
                      <input type="number" class="form-control" name="<?php echo e($inputField->name); ?>"
                        placeholder="<?php echo e(__($inputField->placeholder)); ?>" value="<?php echo e(old($inputField->name)); ?>">
                      <?php $__errorArgs = [$inputField->name];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="mt-2 text-danger"><?php echo e($message); ?></p>
                      <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                  </div>
                <?php elseif($inputField->type == 3): ?>
                  <?php $options = json_decode($inputField->options); ?>

                  <div class="col-md-6">
                    <div class="form-group mb-30">
                      <label>
                        <?php echo e(__($inputField->label)); ?><?php echo e($inputField->is_required == 1 ? '*' : ''); ?>

                      </label>
                      <select class="form-control" name="<?php echo e($inputField->name); ?>">
                        <option selected disabled><?php echo e(__($inputField->placeholder)); ?></option>

                        <?php $__currentLoopData = $options; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                          <option value="<?php echo e($option); ?>" <?php echo e(old($inputField->name) == $option ? 'selected' : ''); ?>>
                            <?php echo e(__($option)); ?>

                          </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                      </select>
                      <?php $__errorArgs = [$inputField->name];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="mt-2 text-danger"><?php echo e($message); ?></p>
                      <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                  </div>
                <?php elseif($inputField->type == 4): ?>
                  <?php $options = json_decode($inputField->options); ?>

                  <div class="col-12">
                    <div class="form-group mb-30">
                      <label class="mb-1">
                        <?php echo e(__($inputField->label)); ?><?php echo e($inputField->is_required == 1 ? '*' : ''); ?>

                      </label>
                      <br>
                      <?php $__currentLoopData = $options; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="custom-control custom-checkbox custom-control-inline">
                          <input type="checkbox" id="<?php echo e('option-' . $loop->iteration); ?>"
                            name="<?php echo e($inputField->name . '[]'); ?>" class="custom-control-input"
                            value="<?php echo e($option); ?>"
                            <?php echo e(is_array(old($inputField->name)) && in_array($option, old($inputField->name)) ? 'checked' : ''); ?>>
                          <label for="<?php echo e('option-' . $loop->iteration); ?>"
                            class="custom-control-label"><?php echo e($option); ?></label>
                        </div>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                      <?php $__errorArgs = [$inputField->name];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="mt-2 text-danger"><?php echo e($message); ?></p>
                      <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                  </div>
                <?php elseif($inputField->type == 5): ?>
                  <div class="col-12">
                    <div class="form-group mb-30">
                      <label>
                        <?php echo e(__($inputField->label)); ?><?php echo e($inputField->is_required == 1 ? '*' : ''); ?>

                      </label>
                      <textarea class="form-control" name="<?php echo e($inputField->name); ?>" placeholder="<?php echo e(__($inputField->placeholder)); ?>"
                        rows="2"><?php echo e(old($inputField->name)); ?></textarea>
                      <?php $__errorArgs = [$inputField->name];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="mt-2 text-danger"><?php echo e($message); ?></p>
                      <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                  </div>
                <?php elseif($inputField->type == 6): ?>
                  <div class="col-md-6">
                    <div class="form-group mb-30">
                      <label>
                        <?php echo e(__($inputField->label)); ?><?php echo e($inputField->is_required == 1 ? '*' : ''); ?>

                      </label>
                      <input type="text" class="form-control datepicker ltr" name="<?php echo e($inputField->name); ?>"
                        placeholder="<?php echo e(__($inputField->placeholder)); ?>" readonly autocomplete="off"
                        value="<?php echo e(old($inputField->name)); ?>">
                      <?php $__errorArgs = [$inputField->name];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="mt-2 text-danger"><?php echo e($message); ?></p>
                      <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                  </div>
                <?php elseif($inputField->type == 7): ?>
                  <div class="col-md-6">
                    <div class="form-group mb-30">
                      <label>
                        <?php echo e(__($inputField->label)); ?><?php echo e($inputField->is_required == 1 ? '*' : ''); ?>

                      </label>
                      <input type="text" class="form-control timepicker ltr" name="<?php echo e($inputField->name); ?>"
                        placeholder="<?php echo e(__($inputField->placeholder)); ?>" readonly autocomplete="off"
                        value="<?php echo e(old($inputField->name)); ?>">
                      <?php $__errorArgs = [$inputField->name];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="mt-2 text-danger"><?php echo e($message); ?></p>
                      <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                  </div>
                <?php else: ?>
                  <div class="col-md-6">
                    <div class="form-group mb-30">
                      <label>
                        <?php echo e(__($inputField->label)); ?><?php echo e($inputField->is_required == 1 ? '*' : ''); ?>

                        <span
                          class="text-info <?php echo e($currentLanguageInfo->direction == 0 ? 'ms-2' : 'me-2'); ?>">(<?php echo e(__('Only .zip file is allowed') . '.'); ?>)</span>
                      </label>
                      <input type="file" name="<?php echo e('form_builder_' . $inputField->name); ?>">
                      <?php $__errorArgs = ["form_builder_$inputField->name"];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="mt-2 text-danger"><?php echo e($message); ?></p>
                      <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                  </div>
                <?php endif; ?>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>

            <?php if($quoteBtnStatus != 0): ?>
              <div class="row mb-40">
                <div class="col-12 text-center">
                  <button class="btn btn-lg btn-primary radius-sm" id="payment-form-btn">
                    <?php echo e($quoteBtnStatus == 0 ? __('Place Order') : __('Submit')); ?>

                  </button>
                </div>
              </div>
            <?php endif; ?>
          </div>
          <?php if($quoteBtnStatus == 0): ?>
            <div class="col-lg-4">
              <?php if(isset($package)): ?>
                <?php
                  $position = $currencyInfo->base_currency_symbol_position;
                  $symbol = $currencyInfo->base_currency_symbol;
                ?>

                <div class="gigs-sidebar mb-40">
                  <div class="packages-widgets">
                    <div class="packages-content-wrap">
                      <div class="packages-content">
                        <div class="p-2">
                          <h3 class="text-center"><?php echo e(__('Selected Package')); ?></h3>
                        </div>
                        <hr class="p-0 m-0">
                        <ul class="mt-30 list-unstyled">
                          <li class="d-flex justify-content-between">

                            <h3><?php echo e($package->name); ?></h3>
                            <h3>
                              <?php echo e($position == 'left' ? $symbol : ''); ?><?php echo e(formatPrice($package->current_price)); ?><?php echo e($position == 'right' ? $symbol : ''); ?>

                              <?php if($package->previous_price): ?>
                                <del class="ms-2 mdf_34335">
                                  <?php echo e($position == 'left' ? $symbol : ''); ?><?php echo e(formatPrice($package->previous_price)); ?><?php echo e($position == 'right' ? $symbol : ''); ?>

                                </del>
                              <?php endif; ?>
                            </h3>

                          </li>
                          <li>

                          </li>
                        </ul>
                        <div class="mt-2 mb-2">
                          <?php if(!empty($package->delivery_time) || !empty($package->number_of_revision)): ?>
                            <span class="additional-info">
                              <?php if(!empty($package->delivery_time)): ?>
                                <span class="delivery">
                                  <i class="far fa-clock "></i>
                                  <?php echo e($package->delivery_time); ?>

                                  <?php echo e($package->delivery_time > 1 ? __('Days Delivery') : __('Day Delivery')); ?></span>
                              <?php endif; ?>

                              <?php if(!empty($package->number_of_revision)): ?>
                                &nbsp;&nbsp;
                                <span class="revisions"><i class="far fa-sync-alt"></i>
                                  <?php echo e($package->number_of_revision); ?>

                                  <?php echo e($package->number_of_revision > 1 ? __('Revisions') : __('Revision')); ?></span>
                              <?php endif; ?>
                            </span>
                          <?php endif; ?>
                        </div>
                        <?php $features = explode(PHP_EOL, $package->features); ?>
                        <ul class="features list-unstyled">
                          <?php $__currentLoopData = $features; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $feature): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li class="feature check-icon">
                              <?php echo e($feature); ?>

                            </li>
                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>

                        <?php
                          $chekedAddons = session()->get('addons');
                          $adonPrice = 0;
                        ?>

                        <?php if(count($addons) > 0 && $chekedAddons): ?>
                          <h3><span class="title"><?php echo e(__('Addons')); ?></span></h3>
                          <ul class="features mt-3 list-unstyled">


                            <?php $__currentLoopData = $addons; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $addon): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                              <?php if(in_array($addon->id, $chekedAddons)): ?>
                                <li class="feature check-icon">

                                  <?php echo e(__($addon->name)); ?>

                                  <span>(<span
                                      class="text-danger">+</span><?php echo e($position == 'left' ? $symbol : ''); ?><?php echo e(formatPrice($addon->price)); ?><?php echo e($position == 'right' ? $symbol : ''); ?>)</span>
                                </li>
                                <?php
                                  $adonPrice = $adonPrice + $addon->price;
                                ?>
                              <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                          </ul>
                        <?php endif; ?>

                        <?php
                          $totalPrice = $package->current_price + $adonPrice;
                          $tax = ($basicInfo->tax / 100) * $totalPrice;
                        ?>

                        <hr class="pb-1 mb-1">
                        <p class="mb-0"><strong><?php echo e(__('Subtotal') . ':'); ?></strong>
                          <?php echo e($position == 'left' ? $symbol : ''); ?><?php echo e(formatPrice($totalPrice)); ?><?php echo e($position == 'right' ? $symbol : ''); ?>

                        </p>
                        <p class="mb-0"><strong><?php echo e(__('Tax') . ':'); ?></strong>
                          <?php echo e($position == 'left' ? $symbol : ''); ?><?php echo e(formatPrice($tax)); ?><?php echo e($position == 'right' ? $symbol : ''); ?>

                        </p>
                        <p><strong><?php echo e(__('Total') . ':'); ?></strong>
                          <?php echo e($position == 'left' ? $symbol : ''); ?><?php echo e(formatPrice($tax + $totalPrice)); ?><?php echo e($position == 'right' ? $symbol : ''); ?>

                        </p>
                      </div>
                    </div>
                  </div>
                </div>
              <?php endif; ?>
              <div class="order-payment mb-40">
                <h4 class="mb-3"><?php echo e(__('Payment Method')); ?></h4>
                <?php $__errorArgs = ['gateway'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                  <p class="mt-2 text-danger"><?php echo e($message); ?></p>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

                <?php if($quoteBtnStatus == 0): ?>
                  <div class="form-group mb-30">

                    <select class="niceselect form-control wide" name="gateway">
                      <option selected disabled><?php echo e(__('Select a Payment Gateway')); ?></option>

                      <?php if(count($onlineGateways) > 0): ?>
                        <?php $__currentLoopData = $onlineGateways; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $onlineGateway): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                          <option value="<?php echo e($onlineGateway->keyword); ?>"
                            <?php echo e(old('gateway') == $onlineGateway->keyword ? 'selected' : ''); ?>

                            data-gateway_type="online">
                            <?php echo e(__($onlineGateway->name)); ?>

                          </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                      <?php endif; ?>

                      <?php if(count($offlineGateways) > 0): ?>
                        <?php $__currentLoopData = $offlineGateways; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $offlineGateway): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                          <option value="<?php echo e($offlineGateway->id); ?>"
                            <?php echo e(old('gateway') == $offlineGateway->id ? 'selected' : ''); ?> data-gateway_type="offline"
                            data-has_attachment="<?php echo e($offlineGateway->has_attachment); ?>">
                            <?php echo e(__($offlineGateway->name)); ?>

                          </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                      <?php endif; ?>
                    </select>
                  </div>

                <?php endif; ?>

                <div class="iyzico-element <?php echo e(old('gateway') == 'iyzico' ? '' : 'd-none'); ?>">
                  <div class="form-group mb-30">
                    <input type="text" name="phone_number" value="<?php echo e(old('phone_number')); ?>" class="form-control"
                      placeholder="Phone Number">
                    <?php $__errorArgs = ['phone_number'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                      <p class="text-danger"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                  </div>
                  <div class="form-group mb-30">
                    <input type="text" name="identity_number" value="<?php echo e(old('identity_number')); ?>"
                      class="form-control" placeholder="Identity Number">
                    <?php $__errorArgs = ['identity_number'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                      <p class="text-danger"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                  </div>
                  <div class="form-group mb-30">
                    <input type="text" name="city" value="<?php echo e(old('city')); ?>" class="form-control"
                      placeholder="City">
                    <?php $__errorArgs = ['city'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                      <p class="text-danger"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                  </div>
                  <div class="form-group mb-30">
                    <input type="text" name="country" value="<?php echo e(old('country')); ?>" class="form-control"
                      placeholder="Country">
                    <?php $__errorArgs = ['country'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                      <p class="text-danger"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                  </div>
                  <div class="form-group mb-30">
                    <input type="text" name="address" value="<?php echo e(old('address')); ?>" class="form-control"
                      placeholder="Address">
                    <?php $__errorArgs = ['address'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                      <p class="text-danger"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                  </div>
                  <div class="form-group mb-30">
                    <input type="text" name="zip_code" value="<?php echo e(old('zip_code')); ?>" class="form-control"
                      placeholder="Zip Code">
                    <?php $__errorArgs = ['zip_code'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                      <p class="text-danger"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                  </div>
                </div>

                <!-----------stripe------------->
                <div id="stripe-element" class="mb-2 mt-2">
                  <!-- A Stripe Element will be inserted here. -->
                </div>
                <!-- Used to display form errors -->
                <div id="stripe-errors" role="alert" class="mb-2 text-danger"></div>
                <!-----------stripe------------->

                <div class="mt-3 mdf_display_none" id="authorizenet-form">
                  <div class="row">
                    <div class="col-md-12 mb-4">
                      <div class="form-group mb-30">
                        <label><?php echo e(__('Card Number') . '*'); ?></label>
                        <input type="text" class="form-control" id="cardNumber" autocomplete="off"
                          placeholder="Enter Card Number">
                      </div>
                    </div>

                    <div class="col-md-12 mb-4">
                      <div class="form-group mb-30">
                        <label><?php echo e(__('Card Code') . '*'); ?></label>
                        <input type="text" class="form-control" id="cardCode" autocomplete="off"
                          placeholder="Enter Card Code">
                      </div>
                    </div>

                    <div class="col-md-12 mb-4">
                      <div class="form-group mb-30">
                        <label><?php echo e(__('Expiry Month') . '*'); ?></label>
                        <input type="text" class="form-control" id="expMonth" placeholder="Enter Expiry Month">
                      </div>
                    </div>

                    <div class="col-md-12 mb-4">
                      <div class="form-group mb-30">
                        <label><?php echo e(__('Expiry Year') . '*'); ?></label>
                        <input type="text" class="form-control" id="expYear" placeholder="Enter Expiry Year">
                      </div>
                    </div>

                    <input type="hidden" name="opaqueDataValue" id="opaqueDataValue">
                    <input type="hidden" name="opaqueDataDescriptor" id="opaqueDataDescriptor">

                    <div id="anetErrors"></div>
                  </div>
                </div>

                <?php if($quoteBtnStatus == 0 && count($offlineGateways) > 0): ?>
                  <div class="row ">
                    <div class="col-12 mt-3">
                      <?php $__currentLoopData = $offlineGateways; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $offlineGateway): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($offlineGateway->has_attachment == 1): ?>
                          <div class="form-group mb-30 mb-3 mdf_display_none"
                            id="<?php echo e('gateway-attachment-' . $offlineGateway->id); ?>">
                            <label><strong><?php echo e(__('Attachment') . '*'); ?></strong></label>
                            <br>
                            <input type="file" name="attachment" class="form-control-file">
                            <span class="text-warning"><?php echo e(__('Note: File type only jpg, jpeg, png and svg')); ?>.</span>
                          </div>
                        <?php endif; ?>

                        <?php if(!is_null($offlineGateway->short_description)): ?>
                          <div class="form-group mb-30 mb-3 mdf_display_none"
                            id="<?php echo e('gateway-description-' . $offlineGateway->id); ?>">
                            <strong><?php echo e(__('Description')); ?></strong>
                            <br>
                            <p><?php echo e($offlineGateway->short_description); ?></p>
                          </div>
                        <?php endif; ?>

                        <?php if(!is_null($offlineGateway->instructions)): ?>
                          <div class="form-group mb-30 mb-3 mdf_display_none"
                            id="<?php echo e('gateway-instructions-' . $offlineGateway->id); ?>">
                            <strong class=""><?php echo e(__('Instructions')); ?></strong>
                            <br>
                            <?php echo replaceBaseUrl($offlineGateway->instructions, 'summernote'); ?>

                          </div>
                        <?php endif; ?>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                  </div>
                <?php endif; ?>

                <?php if($quoteBtnStatus == 0): ?>
                  <button class="btn btn-lg btn-primary radius-sm w-100" id="payment-form-btn">
                    <?php echo e($quoteBtnStatus == 0 ? __('Place Order') : __('Submit')); ?>

                  </button>
                <?php endif; ?>

              </div>
            </div>
          <?php endif; ?>
        </div>
      </form>
    </div>
  </section>
  <!--====== End Service Checkout Area ======-->
<?php $__env->stopSection(); ?>


<?php $__env->startSection('script'); ?>
  <script type="text/javascript">
    const clientKey = '<?php echo e($quoteBtnStatus == 0 ? $anetClientKey : ''); ?>';
    const loginId = '<?php echo e($quoteBtnStatus == 0 ? $anetLoginId : ''); ?>';
    let stripe_key = "<?php echo e($stripeKey); ?>";
  </script>
  <script type="text/javascript" src="https://js.stripe.com/v3/"></script>
  <script type="text/javascript" src="<?php echo e($quoteBtnStatus == 0 ? $anetSource : ''); ?>" charset="utf-8"></script>

  <script type="text/javascript" src="<?php echo e(asset('assets/js/service.js')); ?>"></script>

  <?php if(old('gateway') == 'stripe'): ?>
    <script>
      $(document).ready(function() {
        $('#stripe-element').removeClass('d-none');
      });
    </script>
  <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\younes\Downloads\junspro-main (1)\junspro-main3\resources\views\frontend\service\payment-form.blade.php ENDPATH**/ ?>