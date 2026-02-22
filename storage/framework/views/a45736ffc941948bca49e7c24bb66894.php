<?php $__env->startSection('content'); ?>
  <div class="page-header">
    <h4 class="page-title"><?php echo e(__('Online Gateways')); ?></h4>
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
        <a href="#"><?php echo e(__('Payment Gateways')); ?></a>
      </li>
      <li class="separator">
        <i class="flaticon-right-arrow"></i>
      </li>
      <li class="nav-item">
        <a href="#"><?php echo e(__('Online Gateways')); ?></a>
      </li>
    </ul>
  </div>

  <div class="row">
    <div class="col-lg-4">
      <div class="card">
        <form action="<?php echo e(route('admin.payment_gateways.update_mollie_info')); ?>" method="post">
          <?php echo csrf_field(); ?>
          <div class="card-header">
            <div class="row">
              <div class="col-lg-12">
                <div class="card-title"><?php echo e(__('Mollie')); ?></div>
              </div>
            </div>
          </div>

          <div class="card-body">
            <div class="row">
              <div class="col-lg-12">
                <div class="form-group">
                  <label><?php echo e(__('Status')); ?></label>
                  <div class="selectgroup w-100">
                    <label class="selectgroup-item">
                      <input type="radio" name="mollie_status" value="1" class="selectgroup-input"
                        <?php echo e($mollie->status == 1 ? 'checked' : ''); ?>>
                      <span class="selectgroup-button"><?php echo e(__('Active')); ?></span>
                    </label>
                    <label class="selectgroup-item">
                      <input type="radio" name="mollie_status" value="0" class="selectgroup-input"
                        <?php echo e($mollie->status == 0 ? 'checked' : ''); ?>>
                      <span class="selectgroup-button"><?php echo e(__('Deactive')); ?></span>
                    </label>
                  </div>
                  <?php if($errors->has('mollie_status')): ?>
                    <p class="mt-1 mb-0 text-danger"><?php echo e($errors->first('mollie_status')); ?></p>
                  <?php endif; ?>
                </div>

                <?php $mollieInfo = json_decode($mollie->information, true); ?>

                <div class="form-group">
                  <label><?php echo e(__('API Key')); ?></label>
                  <input type="text" class="form-control" name="mollie_key" value="<?php echo e($mollieInfo['key']); ?>">
                  <?php if($errors->has('mollie_key')): ?>
                    <p class="mt-1 mb-0 text-danger"><?php echo e($errors->first('mollie_key')); ?></p>
                  <?php endif; ?>
                </div>
              </div>
            </div>
          </div>

          <div class="card-footer">
            <div class="row">
              <div class="col-12 text-center">
                <button type="submit" class="btn btn-success">
                  <?php echo e(__('Update')); ?>

                </button>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>

    <div class="col-lg-4">
      <div class="card">
        <form action="<?php echo e(route('admin.payment_gateways.update_paystack_info')); ?>" method="post">
          <?php echo csrf_field(); ?>
          <div class="card-header">
            <div class="row">
              <div class="col-lg-12">
                <div class="card-title"><?php echo e(__('Paystack')); ?></div>
              </div>
            </div>
          </div>

          <div class="card-body">
            <div class="row">
              <div class="col-lg-12">
                <div class="form-group">
                  <label><?php echo e(__('Status')); ?></label>
                  <div class="selectgroup w-100">
                    <label class="selectgroup-item">
                      <input type="radio" name="paystack_status" value="1" class="selectgroup-input"
                        <?php echo e($paystack->status == 1 ? 'checked' : ''); ?>>
                      <span class="selectgroup-button"><?php echo e(__('Active')); ?></span>
                    </label>
                    <label class="selectgroup-item">
                      <input type="radio" name="paystack_status" value="0" class="selectgroup-input"
                        <?php echo e($paystack->status == 0 ? 'checked' : ''); ?>>
                      <span class="selectgroup-button"><?php echo e(__('Deactive')); ?></span>
                    </label>
                  </div>
                  <?php if($errors->has('paystack_status')): ?>
                    <p class="mt-1 mb-0 text-danger"><?php echo e($errors->first('paystack_status')); ?></p>
                  <?php endif; ?>
                </div>

                <?php $paystackInfo = json_decode($paystack->information, true); ?>

                <div class="form-group">
                  <label><?php echo e(__('Secret Key')); ?></label>
                  <input type="text" class="form-control" name="paystack_key" value="<?php echo e($paystackInfo['key']); ?>">
                  <?php if($errors->has('paystack_key')): ?>
                    <p class="mt-1 mb-0 text-danger"><?php echo e($errors->first('paystack_key')); ?></p>
                  <?php endif; ?>
                </div>
              </div>
            </div>
          </div>

          <div class="card-footer">
            <div class="row">
              <div class="col-12 text-center">
                <button type="submit" class="btn btn-success">
                  <?php echo e(__('Update')); ?>

                </button>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>

    
    <div class="col-lg-4">
      <div class="card">
        <form action="<?php echo e(route('admin.payment_gateways.update_yoco_info')); ?>" method="post">
          <?php echo csrf_field(); ?>
          <div class="card-header">
            <div class="row">
              <div class="col-lg-12">
                <div class="card-title"><?php echo e(__('Yoco')); ?></div>
              </div>
            </div>
          </div>

          <div class="card-body">
            <div class="row">
              <div class="col-lg-12">
                <div class="form-group">
                  <label><?php echo e(__('Yoco Status')); ?></label>
                  <div class="selectgroup w-100">
                    <label class="selectgroup-item">
                      <input type="radio" name="status" value="1" class="selectgroup-input"
                        <?php echo e($yoco->status == 1 ? 'checked' : ''); ?>>
                      <span class="selectgroup-button"><?php echo e(__('Active')); ?></span>
                    </label>
                    <label class="selectgroup-item">
                      <input type="radio" name="status" value="0" class="selectgroup-input"
                        <?php echo e($yoco->status == 0 ? 'checked' : ''); ?>>
                      <span class="selectgroup-button"><?php echo e(__('Deactive')); ?></span>
                    </label>
                  </div>
                  <?php if($errors->has('status')): ?>
                    <p class="mt-1 mb-0 text-danger"><?php echo e($errors->first('status')); ?></p>
                  <?php endif; ?>
                </div>

                <?php $yocoInfo = json_decode($yoco->information, true); ?>


                <div class="form-group">
                  <label><?php echo e(__('Secret Key')); ?></label>
                  <input type="text" class="form-control" name="secret_key"
                    value="<?php echo e(@$yocoInfo['secret_key']); ?>">
                  <?php if($errors->has('secret_key')): ?>
                    <p class="mt-1 mb-0 text-danger"><?php echo e($errors->first('secret_key')); ?></p>
                  <?php endif; ?>
                </div>
              </div>
            </div>
          </div>

          <div class="card-footer">
            <div class="row">
              <div class="col-12 text-center">
                <button type="submit" class="btn btn-success">
                  <?php echo e(__('Update')); ?>

                </button>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>

    
    <div class="col-lg-4">
      <div class="card">
        <form action="<?php echo e(route('admin.payment_gateways.update_xendit_info')); ?>" method="post">
          <?php echo csrf_field(); ?>
          <div class="card-header">
            <div class="row">
              <div class="col-lg-12">
                <div class="card-title"><?php echo e(__('Xendit')); ?></div>
              </div>
            </div>
          </div>

          <div class="card-body">
            <div class="row">
              <div class="col-lg-12">
                <div class="form-group">
                  <label><?php echo e(__('Xendit Status')); ?></label>
                  <div class="selectgroup w-100">
                    <label class="selectgroup-item">
                      <input type="radio" name="status" value="1" class="selectgroup-input"
                        <?php echo e($xendit->status == 1 ? 'checked' : ''); ?>>
                      <span class="selectgroup-button"><?php echo e(__('Active')); ?></span>
                    </label>
                    <label class="selectgroup-item">
                      <input type="radio" name="status" value="0" class="selectgroup-input"
                        <?php echo e($xendit->status == 0 ? 'checked' : ''); ?>>
                      <span class="selectgroup-button"><?php echo e(__('Deactive')); ?></span>
                    </label>
                  </div>
                  <?php if($errors->has('status')): ?>
                    <p class="mt-1 mb-0 text-danger"><?php echo e($errors->first('status')); ?></p>
                  <?php endif; ?>
                </div>

                <?php $xenditInfo = json_decode($xendit->information, true); ?>


                <div class="form-group">
                  <label><?php echo e(__('Secret Key')); ?></label>
                  <input type="text" class="form-control" name="secret_key"
                    value="<?php echo e(@$xenditInfo['secret_key']); ?>">
                  <?php if($errors->has('secret_key')): ?>
                    <p class="mt-1 mb-0 text-danger"><?php echo e($errors->first('secret_key')); ?></p>
                  <?php endif; ?>
                </div>
              </div>
            </div>
          </div>

          <div class="card-footer">
            <div class="row">
              <div class="col-12 text-center">
                <button type="submit" class="btn btn-success">
                  <?php echo e(__('Update')); ?>

                </button>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>

    
    <div class="col-lg-4">
      <div class="card">
        <form action="<?php echo e(route('admin.payment_gateways.update_perfect_money_info')); ?>" method="post">
          <?php echo csrf_field(); ?>
          <div class="card-header">
            <div class="row">
              <div class="col-lg-12">
                <div class="card-title"><?php echo e(__('Perfect Money')); ?></div>
              </div>
            </div>
          </div>

          <div class="card-body">
            <div class="row">
              <div class="col-lg-12">
                <div class="form-group">
                  <label><?php echo e(__('Perfect Money Status')); ?></label>
                  <div class="selectgroup w-100">
                    <label class="selectgroup-item">
                      <input type="radio" name="status" value="1" class="selectgroup-input"
                        <?php echo e($perfect_money->status == 1 ? 'checked' : ''); ?>>
                      <span class="selectgroup-button"><?php echo e(__('Active')); ?></span>
                    </label>
                    <label class="selectgroup-item">
                      <input type="radio" name="status" value="0" class="selectgroup-input"
                        <?php echo e($perfect_money->status == 0 ? 'checked' : ''); ?>>
                      <span class="selectgroup-button"><?php echo e(__('Deactive')); ?></span>
                    </label>
                  </div>
                  <?php if($errors->has('status')): ?>
                    <p class="mt-1 mb-0 text-danger"><?php echo e($errors->first('status')); ?></p>
                  <?php endif; ?>
                </div>

                <?php $perfect_moneyInfo = json_decode($perfect_money->information, true); ?>

                <div class="form-group">
                  <label><?php echo e(__('Perfect Money Wallet Id')); ?></label>
                  <input type="text" class="form-control" name="perfect_money_wallet_id"
                    value="<?php echo e(@$perfect_moneyInfo['perfect_money_wallet_id']); ?>">
                  <?php if($errors->has('perfect_money_wallet_id')): ?>
                    <p class="mt-1 mb-0 text-danger"><?php echo e($errors->first('perfect_money_wallet_id')); ?></p>
                  <?php endif; ?>

                  <p class="text-warning mt-1 mb-0">You will get wallet id form here </p>
                  <a href="https://prnt.sc/bM3LqLXBduaq" target="_blank">https://prnt.sc/bM3LqLXBduaq</a>
                </div>
              </div>
            </div>
          </div>

          <div class="card-footer">
            <div class="row">
              <div class="col-12 text-center">
                <button type="submit" class="btn btn-success">
                  <?php echo e(__('Update')); ?>

                </button>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>

    
    <div class="col-lg-4">
      <div class="card">
        <form action="<?php echo e(route('admin.payment_gateways.update_mercadopago_info')); ?>" method="post">
          <?php echo csrf_field(); ?>
          <div class="card-header">
            <div class="row">
              <div class="col-lg-12">
                <div class="card-title"><?php echo e(__('MercadoPago')); ?></div>
              </div>
            </div>
          </div>

          <div class="card-body">
            <div class="form-group">
              <label><?php echo e(__('Status')); ?></label>
              <div class="selectgroup w-100">
                <label class="selectgroup-item">
                  <input type="radio" name="mercadopago_status" value="1" class="selectgroup-input"
                    <?php echo e($mercadopago->status == 1 ? 'checked' : ''); ?>>
                  <span class="selectgroup-button"><?php echo e(__('Active')); ?></span>
                </label>
                <label class="selectgroup-item">
                  <input type="radio" name="mercadopago_status" value="0" class="selectgroup-input"
                    <?php echo e($mercadopago->status == 0 ? 'checked' : ''); ?>>
                  <span class="selectgroup-button"><?php echo e(__('Deactive')); ?></span>
                </label>
              </div>
              <?php if($errors->has('mercadopago_status')): ?>
                <p class="mt-1 mb-0 text-danger"><?php echo e($errors->first('mercadopago_status')); ?></p>
              <?php endif; ?>
            </div>

            <?php $mercadopagoInfo = json_decode($mercadopago->information, true); ?>

            <div class="form-group">
              <label><?php echo e(__('Test Mode')); ?></label>
              <div class="selectgroup w-100">
                <label class="selectgroup-item">
                  <input type="radio" name="mercadopago_sandbox_status" value="1" class="selectgroup-input"
                    <?php echo e($mercadopagoInfo['sandbox_status'] == 1 ? 'checked' : ''); ?>>
                  <span class="selectgroup-button"><?php echo e(__('Active')); ?></span>
                </label>
                <label class="selectgroup-item">
                  <input type="radio" name="mercadopago_sandbox_status" value="0" class="selectgroup-input"
                    <?php echo e($mercadopagoInfo['sandbox_status'] == 0 ? 'checked' : ''); ?>>
                  <span class="selectgroup-button"><?php echo e(__('Deactive')); ?></span>
                </label>
              </div>
              <?php if($errors->has('mercadopago_sandbox_status')): ?>
                <p class="mt-1 mb-0 text-danger"><?php echo e($errors->first('mercadopago_sandbox_status')); ?></p>
              <?php endif; ?>
            </div>

            <div class="form-group">
              <label><?php echo e(__('Token')); ?></label>
              <input type="text" class="form-control" name="mercadopago_token"
                value="<?php echo e($mercadopagoInfo['token']); ?>">
              <?php if($errors->has('mercadopago_token')): ?>
                <p class="mt-1 mb-0 text-danger"><?php echo e($errors->first('mercadopago_token')); ?></p>
              <?php endif; ?>
            </div>
          </div>

          <div class="card-footer">
            <div class="row">
              <div class="col-12 text-center">
                <button type="submit" class="btn btn-success">
                  <?php echo e(__('Update')); ?>

                </button>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>




    <div class="col-lg-4">
      <div class="card">
        <form action="<?php echo e(route('admin.payment_gateways.update_flutterwave_info')); ?>" method="post">
          <?php echo csrf_field(); ?>
          <div class="card-header">
            <div class="row">
              <div class="col-lg-12">
                <div class="card-title"><?php echo e(__('Flutterwave')); ?></div>
              </div>
            </div>
          </div>

          <div class="card-body">
            <div class="row">
              <div class="col-lg-12">
                <div class="form-group">
                  <label><?php echo e(__('Status')); ?></label>
                  <div class="selectgroup w-100">
                    <label class="selectgroup-item">
                      <input type="radio" name="flutterwave_status" value="1" class="selectgroup-input"
                        <?php echo e($flutterwave->status == 1 ? 'checked' : ''); ?>>
                      <span class="selectgroup-button"><?php echo e(__('Active')); ?></span>
                    </label>
                    <label class="selectgroup-item">
                      <input type="radio" name="flutterwave_status" value="0" class="selectgroup-input"
                        <?php echo e($flutterwave->status == 0 ? 'checked' : ''); ?>>
                      <span class="selectgroup-button"><?php echo e(__('Deactive')); ?></span>
                    </label>
                  </div>
                  <?php if($errors->has('flutterwave_status')): ?>
                    <p class="mt-1 mb-0 text-danger"><?php echo e($errors->first('flutterwave_status')); ?></p>
                  <?php endif; ?>
                </div>

                <?php $flutterwaveInfo = json_decode($flutterwave->information, true); ?>

                <div class="form-group">
                  <label><?php echo e(__('Public Key')); ?></label>
                  <input type="text" class="form-control" name="flutterwave_public_key"
                    value="<?php echo e($flutterwaveInfo['public_key']); ?>">
                  <?php if($errors->has('flutterwave_public_key')): ?>
                    <p class="mt-1 mb-0 text-danger"><?php echo e($errors->first('flutterwave_public_key')); ?></p>
                  <?php endif; ?>
                </div>

                <div class="form-group">
                  <label><?php echo e(__('Secret Key')); ?></label>
                  <input type="text" class="form-control" name="flutterwave_secret_key"
                    value="<?php echo e($flutterwaveInfo['secret_key']); ?>">
                  <?php if($errors->has('flutterwave_secret_key')): ?>
                    <p class="mt-1 mb-0 text-danger"><?php echo e($errors->first('flutterwave_secret_key')); ?></p>
                  <?php endif; ?>
                </div>
              </div>
            </div>
          </div>

          <div class="card-footer">
            <div class="row">
              <div class="col-12 text-center">
                <button type="submit" class="btn btn-success">
                  <?php echo e(__('Update')); ?>

                </button>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>

    <div class="col-lg-4">
      <div class="card">
        <form action="<?php echo e(route('admin.payment_gateways.update_razorpay_info')); ?>" method="post">
          <?php echo csrf_field(); ?>
          <div class="card-header">
            <div class="row">
              <div class="col-lg-12">
                <div class="card-title"><?php echo e(__('Razorpay')); ?></div>
              </div>
            </div>
          </div>

          <div class="card-body">
            <div class="row">
              <div class="col-lg-12">
                <div class="form-group">
                  <label><?php echo e(__('Status')); ?></label>
                  <div class="selectgroup w-100">
                    <label class="selectgroup-item">
                      <input type="radio" name="razorpay_status" value="1" class="selectgroup-input"
                        <?php echo e($razorpay->status == 1 ? 'checked' : ''); ?>>
                      <span class="selectgroup-button"><?php echo e(__('Active')); ?></span>
                    </label>
                    <label class="selectgroup-item">
                      <input type="radio" name="razorpay_status" value="0" class="selectgroup-input"
                        <?php echo e($razorpay->status == 0 ? 'checked' : ''); ?>>
                      <span class="selectgroup-button"><?php echo e(__('Deactive')); ?></span>
                    </label>
                  </div>
                  <?php if($errors->has('razorpay_status')): ?>
                    <p class="mt-1 mb-0 text-danger"><?php echo e($errors->first('razorpay_status')); ?></p>
                  <?php endif; ?>
                </div>

                <?php $razorpayInfo = json_decode($razorpay->information, true); ?>

                <div class="form-group">
                  <label><?php echo e(__('Key')); ?></label>
                  <input type="text" class="form-control" name="razorpay_key" value="<?php echo e($razorpayInfo['key']); ?>">
                  <?php if($errors->has('razorpay_key')): ?>
                    <p class="mt-1 mb-0 text-danger"><?php echo e($errors->first('razorpay_key')); ?></p>
                  <?php endif; ?>
                </div>

                <div class="form-group">
                  <label><?php echo e(__('Secret')); ?></label>
                  <input type="text" class="form-control" name="razorpay_secret"
                    value="<?php echo e($razorpayInfo['secret']); ?>">
                  <?php if($errors->has('razorpay_secret')): ?>
                    <p class="mt-1 mb-0 text-danger"><?php echo e($errors->first('razorpay_secret')); ?></p>
                  <?php endif; ?>
                </div>
              </div>
            </div>
          </div>

          <div class="card-footer">
            <div class="row">
              <div class="col-12 text-center">
                <button type="submit" class="btn btn-success">
                  <?php echo e(__('Update')); ?>

                </button>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>

    <div class="col-lg-4">
      <div class="card">
        <form action="<?php echo e(route('admin.payment_gateways.update_stripe_info')); ?>" method="post">
          <?php echo csrf_field(); ?>
          <div class="card-header">
            <div class="row">
              <div class="col-lg-12">
                <div class="card-title"><?php echo e(__('Stripe')); ?></div>
              </div>
            </div>
          </div>

          <div class="card-body">
            <div class="row">
              <div class="col-lg-12">
                <div class="form-group">
                  <label><?php echo e(__('Status')); ?></label>
                  <div class="selectgroup w-100">
                    <label class="selectgroup-item">
                      <input type="radio" name="stripe_status" value="1" class="selectgroup-input"
                        <?php echo e($stripe->status == 1 ? 'checked' : ''); ?>>
                      <span class="selectgroup-button"><?php echo e(__('Active')); ?></span>
                    </label>
                    <label class="selectgroup-item">
                      <input type="radio" name="stripe_status" value="0" class="selectgroup-input"
                        <?php echo e($stripe->status == 0 ? 'checked' : ''); ?>>
                      <span class="selectgroup-button"><?php echo e(__('Deactive')); ?></span>
                    </label>
                  </div>
                  <?php if($errors->has('stripe_status')): ?>
                    <p class="mt-1 mb-0 text-danger"><?php echo e($errors->first('stripe_status')); ?></p>
                  <?php endif; ?>
                </div>

                <?php $stripeInfo = json_decode($stripe->information, true); ?>

                <div class="form-group">
                  <label><?php echo e(__('Key')); ?></label>
                  <input type="text" class="form-control" name="stripe_key" value="<?php echo e($stripeInfo['key']); ?>">
                  <?php if($errors->has('stripe_key')): ?>
                    <p class="mt-1 mb-0 text-danger"><?php echo e($errors->first('stripe_key')); ?></p>
                  <?php endif; ?>
                </div>

                <div class="form-group">
                  <label><?php echo e(__('Secret')); ?></label>
                  <input type="text" class="form-control" name="stripe_secret"
                    value="<?php echo e($stripeInfo['secret']); ?>">
                  <?php if($errors->has('stripe_secret')): ?>
                    <p class="mt-1 mb-0 text-danger"><?php echo e($errors->first('stripe_secret')); ?></p>
                  <?php endif; ?>
                </div>
              </div>
            </div>
          </div>

          <div class="card-footer">
            <div class="row">
              <div class="col-12 text-center">
                <button type="submit" class="btn btn-success">
                  <?php echo e(__('Update')); ?>

                </button>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>

    
    <div class="col-lg-4">
      <div class="card">
        <form action="<?php echo e(route('admin.payment_gateways.update_myfatoorah_info')); ?>" method="post">
          <?php echo csrf_field(); ?>
          <div class="card-header">
            <div class="row">
              <div class="col-lg-12">
                <div class="card-title"><?php echo e(__('MyFatoorah')); ?></div>
              </div>
            </div>
          </div>

          <div class="card-body">
            <div class="row">
              <div class="col-lg-12">
                <div class="form-group">
                  <label><?php echo e(__('MyFatoorah Status')); ?></label>
                  <div class="selectgroup w-100">
                    <label class="selectgroup-item">
                      <input type="radio" name="status" value="1" class="selectgroup-input"
                        <?php echo e($myfatoorah->status == 1 ? 'checked' : ''); ?>>
                      <span class="selectgroup-button"><?php echo e(__('Active')); ?></span>
                    </label>
                    <label class="selectgroup-item">
                      <input type="radio" name="status" value="0" class="selectgroup-input"
                        <?php echo e($myfatoorah->status == 0 ? 'checked' : ''); ?>>
                      <span class="selectgroup-button"><?php echo e(__('Deactive')); ?></span>
                    </label>
                  </div>
                  <?php if($errors->has('status')): ?>
                    <p class="mt-1 mb-0 text-danger"><?php echo e($errors->first('status')); ?></p>
                  <?php endif; ?>
                </div>

                <?php $myfatoorahInfo = json_decode($myfatoorah->information, true); ?>
                <div class="form-group">
                  <label><?php echo e(__('Sandbox Status')); ?></label>
                  <div class="selectgroup w-100">
                    <label class="selectgroup-item">
                      <input type="radio" name="sandbox_status" value="1" class="selectgroup-input"
                        <?php echo e(@$myfatoorahInfo['sandbox_status'] == 1 ? 'checked' : ''); ?>>
                      <span class="selectgroup-button"><?php echo e(__('Active')); ?></span>
                    </label>
                    <label class="selectgroup-item">
                      <input type="radio" name="sandbox_status" value="0" class="selectgroup-input"
                        <?php echo e(@$myfatoorahInfo['sandbox_status'] == 0 ? 'checked' : ''); ?>>
                      <span class="selectgroup-button"><?php echo e(__('Deactive')); ?></span>
                    </label>
                  </div>
                  <?php if($errors->has('sandbox_status')): ?>
                    <p class="mt-1 mb-0 text-danger"><?php echo e($errors->first('sandbox_status')); ?></p>
                  <?php endif; ?>
                </div>

                <div class="form-group">
                  <label><?php echo e(__('Token')); ?></label>
                  <input type="text" class="form-control" name="token" value="<?php echo e(@$myfatoorahInfo['token']); ?>">
                  <?php if($errors->has('token')): ?>
                    <p class="mt-1 mb-0 text-danger"><?php echo e($errors->first('token')); ?></p>
                  <?php endif; ?>
                </div>
              </div>
            </div>
          </div>

          <div class="card-footer">
            <div class="row">
              <div class="col-12 text-center">
                <button type="submit" class="btn btn-success">
                  <?php echo e(__('Update')); ?>

                </button>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>

    
    <div class="col-lg-4">
      <div class="card">
        <form action="<?php echo e(route('admin.payment_gateways.update_paypal_info')); ?>" method="post">
          <?php echo csrf_field(); ?>
          <div class="card-header">
            <div class="row">
              <div class="col-lg-12">
                <div class="card-title"><?php echo e(__('Paypal')); ?></div>
              </div>
            </div>
          </div>

          <div class="card-body">
            <div class="row">
              <div class="col-lg-12">
                <div class="form-group">
                  <label><?php echo e(__('Status')); ?></label>
                  <div class="selectgroup w-100">
                    <label class="selectgroup-item">
                      <input type="radio" name="paypal_status" value="1" class="selectgroup-input"
                        <?php echo e($paypal->status == 1 ? 'checked' : ''); ?>>
                      <span class="selectgroup-button"><?php echo e(__('Active')); ?></span>
                    </label>
                    <label class="selectgroup-item">
                      <input type="radio" name="paypal_status" value="0" class="selectgroup-input"
                        <?php echo e($paypal->status == 0 ? 'checked' : ''); ?>>
                      <span class="selectgroup-button"><?php echo e(__('Deactive')); ?></span>
                    </label>
                  </div>
                  <?php if($errors->has('paypal_status')): ?>
                    <p class="mt-1 mb-0 text-danger"><?php echo e($errors->first('paypal_status')); ?></p>
                  <?php endif; ?>
                </div>

                <?php $paypalInfo = json_decode($paypal->information, true); ?>

                <div class="form-group">
                  <label><?php echo e(__('Test Mode')); ?></label>
                  <div class="selectgroup w-100">
                    <label class="selectgroup-item">
                      <input type="radio" name="paypal_sandbox_status" value="1" class="selectgroup-input"
                        <?php echo e($paypalInfo['sandbox_status'] == 1 ? 'checked' : ''); ?>>
                      <span class="selectgroup-button"><?php echo e(__('Active')); ?></span>
                    </label>
                    <label class="selectgroup-item">
                      <input type="radio" name="paypal_sandbox_status" value="0" class="selectgroup-input"
                        <?php echo e($paypalInfo['sandbox_status'] == 0 ? 'checked' : ''); ?>>
                      <span class="selectgroup-button"><?php echo e(__('Deactive')); ?></span>
                    </label>
                  </div>
                  <?php if($errors->has('paypal_sandbox_status')): ?>
                    <p class="mt-1 mb-0 text-danger"><?php echo e($errors->first('paypal_sandbox_status')); ?></p>
                  <?php endif; ?>
                </div>

                <div class="form-group">
                  <label><?php echo e(__('Client ID')); ?></label>
                  <input type="text" class="form-control" name="paypal_client_id"
                    value="<?php echo e($paypalInfo['client_id']); ?>">
                  <?php if($errors->has('paypal_client_id')): ?>
                    <p class="mt-1 mb-0 text-danger"><?php echo e($errors->first('paypal_client_id')); ?></p>
                  <?php endif; ?>
                </div>

                <div class="form-group">
                  <label><?php echo e(__('Client Secret')); ?></label>
                  <input type="text" class="form-control" name="paypal_client_secret"
                    value="<?php echo e($paypalInfo['client_secret']); ?>">
                  <?php if($errors->has('paypal_client_secret')): ?>
                    <p class="mt-1 mb-0 text-danger"><?php echo e($errors->first('paypal_client_secret')); ?></p>
                  <?php endif; ?>
                </div>
              </div>
            </div>
          </div>

          <div class="card-footer">
            <div class="row">
              <div class="col-12 text-center">
                <button type="submit" class="btn btn-success">
                  <?php echo e(__('Update')); ?>

                </button>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>

    
    <div class="col-lg-4">
      <div class="card">
        <form action="<?php echo e(route('admin.payment_gateways.update_instamojo_info')); ?>" method="post">
          <?php echo csrf_field(); ?>
          <div class="card-header">
            <div class="row">
              <div class="col-lg-12">
                <div class="card-title"><?php echo e(__('Instamojo')); ?></div>
              </div>
            </div>
          </div>

          <div class="card-body">
            <div class="row">
              <div class="col-lg-12">
                <div class="form-group">
                  <label><?php echo e(__('Status')); ?></label>
                  <div class="selectgroup w-100">
                    <label class="selectgroup-item">
                      <input type="radio" name="instamojo_status" value="1" class="selectgroup-input"
                        <?php echo e($instamojo->status == 1 ? 'checked' : ''); ?>>
                      <span class="selectgroup-button"><?php echo e(__('Active')); ?></span>
                    </label>
                    <label class="selectgroup-item">
                      <input type="radio" name="instamojo_status" value="0" class="selectgroup-input"
                        <?php echo e($instamojo->status == 0 ? 'checked' : ''); ?>>
                      <span class="selectgroup-button"><?php echo e(__('Deactive')); ?></span>
                    </label>
                  </div>
                  <?php if($errors->has('instamojo_status')): ?>
                    <p class="mt-1 mb-0 text-danger"><?php echo e($errors->first('instamojo_status')); ?></p>
                  <?php endif; ?>
                </div>

                <?php $instamojoInfo = json_decode($instamojo->information, true); ?>

                <div class="form-group">
                  <label><?php echo e(__('Test Mode')); ?></label>
                  <div class="selectgroup w-100">
                    <label class="selectgroup-item">
                      <input type="radio" name="instamojo_sandbox_status" value="1" class="selectgroup-input"
                        <?php echo e($instamojoInfo['sandbox_status'] == 1 ? 'checked' : ''); ?>>
                      <span class="selectgroup-button"><?php echo e(__('Active')); ?></span>
                    </label>
                    <label class="selectgroup-item">
                      <input type="radio" name="instamojo_sandbox_status" value="0" class="selectgroup-input"
                        <?php echo e($instamojoInfo['sandbox_status'] == 0 ? 'checked' : ''); ?>>
                      <span class="selectgroup-button"><?php echo e(__('Deactive')); ?></span>
                    </label>
                  </div>
                  <?php if($errors->has('instamojo_sandbox_status')): ?>
                    <p class="mt-1 mb-0 text-danger"><?php echo e($errors->first('instamojo_sandbox_status')); ?></p>
                  <?php endif; ?>
                </div>

                <div class="form-group">
                  <label><?php echo e(__('API Key')); ?></label>
                  <input type="text" class="form-control" name="instamojo_key"
                    value="<?php echo e($instamojoInfo['key']); ?>">
                  <?php if($errors->has('instamojo_key')): ?>
                    <p class="mt-1 mb-0 text-danger"><?php echo e($errors->first('instamojo_key')); ?></p>
                  <?php endif; ?>
                </div>

                <div class="form-group">
                  <label><?php echo e(__('Auth Token')); ?></label>
                  <input type="text" class="form-control" name="instamojo_token"
                    value="<?php echo e($instamojoInfo['token']); ?>">
                  <?php if($errors->has('instamojo_token')): ?>
                    <p class="mt-1 mb-0 text-danger"><?php echo e($errors->first('instamojo_token')); ?></p>
                  <?php endif; ?>
                </div>
              </div>
            </div>
          </div>

          <div class="card-footer">
            <div class="row">
              <div class="col-12 text-center">
                <button type="submit" class="btn btn-success">
                  <?php echo e(__('Update')); ?>

                </button>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>

    
    <div class="col-lg-4">
      <div class="card">
        <form action="<?php echo e(route('admin.payment_gateways.update_toyyibpay_info')); ?>" method="post">
          <?php echo csrf_field(); ?>
          <div class="card-header">
            <div class="row">
              <div class="col-lg-12">
                <div class="card-title"><?php echo e(__('Toyyibpay')); ?></div>
              </div>
            </div>
          </div>

          <div class="card-body">
            <div class="row">
              <div class="col-lg-12">
                <div class="form-group">
                  <label><?php echo e(__('Toyyibpay Status')); ?></label>
                  <div class="selectgroup w-100">
                    <label class="selectgroup-item">
                      <input type="radio" name="status" value="1" class="selectgroup-input"
                        <?php echo e($toyyibpay->status == 1 ? 'checked' : ''); ?>>
                      <span class="selectgroup-button"><?php echo e(__('Active')); ?></span>
                    </label>
                    <label class="selectgroup-item">
                      <input type="radio" name="status" value="0" class="selectgroup-input"
                        <?php echo e($toyyibpay->status == 0 ? 'checked' : ''); ?>>
                      <span class="selectgroup-button"><?php echo e(__('Deactive')); ?></span>
                    </label>
                  </div>
                  <?php if($errors->has('status')): ?>
                    <p class="mt-1 mb-0 text-danger"><?php echo e($errors->first('status')); ?></p>
                  <?php endif; ?>
                </div>

                <?php $toyyibpayInfo = json_decode($toyyibpay->information, true); ?>

                <div class="form-group">
                  <label><?php echo e(__('Toyyibpay Test Mode')); ?></label>
                  <div class="selectgroup w-100">
                    <label class="selectgroup-item">
                      <input type="radio" name="sandbox_status" value="1" class="selectgroup-input"
                        <?php echo e($toyyibpayInfo['sandbox_status'] == 1 ? 'checked' : ''); ?>>
                      <span class="selectgroup-button"><?php echo e(__('Active')); ?></span>
                    </label>
                    <label class="selectgroup-item">
                      <input type="radio" name="sandbox_status" value="0" class="selectgroup-input"
                        <?php echo e($toyyibpayInfo['sandbox_status'] == 0 ? 'checked' : ''); ?>>
                      <span class="selectgroup-button"><?php echo e(__('Deactive')); ?></span>
                    </label>
                  </div>
                  <?php if($errors->has('sandbox_status')): ?>
                    <p class="mt-1 mb-0 text-danger"><?php echo e($errors->first('sandbox_status')); ?></p>
                  <?php endif; ?>
                </div>

                <div class="form-group">
                  <label><?php echo e(__('Secret Key')); ?></label>
                  <input type="text" class="form-control" name="secret_key"
                    value="<?php echo e(@$toyyibpayInfo['secret_key']); ?>">
                  <?php if($errors->has('secret_key')): ?>
                    <p class="mt-1 mb-0 text-danger"><?php echo e($errors->first('secret_key')); ?></p>
                  <?php endif; ?>
                </div>
                <div class="form-group">
                  <label><?php echo e(__('Category Code')); ?></label>
                  <input type="text" class="form-control" name="category_code"
                    value="<?php echo e(@$toyyibpayInfo['category_code']); ?>">
                  <?php if($errors->has('category_code')): ?>
                    <p class="mt-1 mb-0 text-danger"><?php echo e($errors->first('category_code')); ?></p>
                  <?php endif; ?>
                </div>
              </div>
            </div>
          </div>

          <div class="card-footer">
            <div class="row">
              <div class="col-12 text-center">
                <button type="submit" class="btn btn-success">
                  <?php echo e(__('Update')); ?>

                </button>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>

    
    <div class="col-lg-4">
      <div class="card">
        <form action="<?php echo e(route('admin.payment_gateways.update_midtrans_info')); ?>" method="post">
          <?php echo csrf_field(); ?>
          <div class="card-header">
            <div class="row">
              <div class="col-lg-12">
                <div class="card-title"><?php echo e(__('Midtrans')); ?></div>
              </div>
            </div>
          </div>

          <div class="card-body">
            <div class="row">
              <div class="col-lg-12">
                <div class="form-group">
                  <label><?php echo e(__('Midtrans Status')); ?></label>
                  <div class="selectgroup w-100">
                    <label class="selectgroup-item">
                      <input type="radio" name="status" value="1" class="selectgroup-input"
                        <?php echo e($midtrans->status == 1 ? 'checked' : ''); ?>>
                      <span class="selectgroup-button"><?php echo e(__('Active')); ?></span>
                    </label>
                    <label class="selectgroup-item">
                      <input type="radio" name="status" value="0" class="selectgroup-input"
                        <?php echo e($midtrans->status == 0 ? 'checked' : ''); ?>>
                      <span class="selectgroup-button"><?php echo e(__('Deactive')); ?></span>
                    </label>
                  </div>
                  <?php if($errors->has('status')): ?>
                    <p class="mt-1 mb-0 text-danger"><?php echo e($errors->first('status')); ?></p>
                  <?php endif; ?>
                </div>

                <?php $midtransInfo = json_decode($midtrans?->information, true); ?>

                <div class="form-group">
                  <label><?php echo e(__('Midtrans Test Mode')); ?></label>
                  <div class="selectgroup w-100">
                    <label class="selectgroup-item">
                      <input type="radio" name="is_production" value="1" class="selectgroup-input"
                        <?php echo e(!empty($midtransInfo) && $midtransInfo['is_production'] == 1 ? 'checked' : ''); ?>>
                      <span class="selectgroup-button"><?php echo e(__('Active')); ?></span>
                    </label>
                    <label class="selectgroup-item">
                      <input type="radio" name="is_production" value="0" class="selectgroup-input"
                        <?php echo e(!empty($midtransInfo) && $midtransInfo['is_production'] == 0 ? 'checked' : ''); ?>>
                      <span class="selectgroup-button"><?php echo e(__('Deactive')); ?></span>
                    </label>
                  </div>
                  <?php if($errors->has('is_production')): ?>
                    <p class="mt-1 mb-0 text-danger"><?php echo e($errors->first('is_production')); ?></p>
                  <?php endif; ?>
                </div>
                <div class="form-group">
                  <label><?php echo e(__('Midtrans Server Key')); ?></label>
                  <input type="text" class="form-control" name="server_key"
                    value="<?php echo e(!empty($midtransInfo['server_key']) ? $midtransInfo['server_key'] : null); ?>">
                  <?php if($errors->has('server_key')): ?>
                    <p class="mt-1 mb-0 text-danger"><?php echo e($errors->first('server_key')); ?></p>
                  <?php endif; ?>
                </div>
                <p class="text-warning">Your Success URL : <?php echo e(route('midtrans.bank_notify')); ?> </p>
                <p class="text-warning">Your Cancel URL : <?php echo e(route('midtrans.cancel')); ?></p>
                <p>
                  <strong class="text-warning">Set these URLs in Midtrans Dashboard like this :</strong> <br>
                  <a href="https://prnt.sc/OiucUCeYJIXo" target="_blank">https://prnt.sc/OiucUCeYJIXo</a>
                </p>
              </div>
            </div>
          </div>

          <div class="card-footer">
            <div class="row">
              <div class="col-12 text-center">
                <button type="submit" class="btn btn-success">
                  <?php echo e(__('Update')); ?>

                </button>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
    
    <div class="col-lg-4">
      <div class="card">
        <form action="<?php echo e(route('admin.payment_gateways.update_authorizenet_info')); ?>" method="post">
          <?php echo csrf_field(); ?>
          <div class="card-header">
            <div class="row">
              <div class="col-lg-12">
                <div class="card-title"><?php echo e(__('Authorize.Net')); ?></div>
              </div>
            </div>
          </div>

          <div class="card-body">
            <div class="row">
              <div class="col-lg-12">
                <div class="form-group">
                  <label><?php echo e(__('Status')); ?></label>
                  <div class="selectgroup w-100">
                    <label class="selectgroup-item">
                      <input type="radio" name="authorizenet_status" value="1" class="selectgroup-input"
                        <?php echo e($authorizenet->status == 1 ? 'checked' : ''); ?>>
                      <span class="selectgroup-button"><?php echo e(__('Active')); ?></span>
                    </label>
                    <label class="selectgroup-item">
                      <input type="radio" name="authorizenet_status" value="0" class="selectgroup-input"
                        <?php echo e($authorizenet->status == 0 ? 'checked' : ''); ?>>
                      <span class="selectgroup-button"><?php echo e(__('Deactive')); ?></span>
                    </label>
                  </div>
                  <?php if($errors->has('authorizenet_status')): ?>
                    <p class="mt-1 mb-0 text-danger"><?php echo e($errors->first('authorizenet_status')); ?></p>
                  <?php endif; ?>
                </div>

                <?php $authorizenetInfo = json_decode($authorizenet->information, true); ?>

                <div class="form-group">
                  <label><?php echo e(__('Test Mode')); ?></label>
                  <div class="selectgroup w-100">
                    <label class="selectgroup-item">
                      <input type="radio" name="authorizenet_sandbox_status" value="1"
                        class="selectgroup-input" <?php echo e($authorizenetInfo['sandbox_status'] == 1 ? 'checked' : ''); ?>>
                      <span class="selectgroup-button"><?php echo e(__('Active')); ?></span>
                    </label>
                    <label class="selectgroup-item">
                      <input type="radio" name="authorizenet_sandbox_status" value="0"
                        class="selectgroup-input" <?php echo e($authorizenetInfo['sandbox_status'] == 0 ? 'checked' : ''); ?>>
                      <span class="selectgroup-button"><?php echo e(__('Deactive')); ?></span>
                    </label>
                  </div>
                  <?php if($errors->has('authorizenet_sandbox_status')): ?>
                    <p class="mt-1 mb-0 text-danger"><?php echo e($errors->first('authorizenet_sandbox_status')); ?></p>
                  <?php endif; ?>
                </div>

                <div class="form-group">
                  <label><?php echo e(__('API Login ID')); ?></label>
                  <input type="text" class="form-control" name="authorizenet_api_login_id"
                    value="<?php echo e($authorizenetInfo['api_login_id']); ?>">
                  <?php if($errors->has('authorizenet_api_login_id')): ?>
                    <p class="mt-1 mb-0 text-danger"><?php echo e($errors->first('authorizenet_api_login_id')); ?></p>
                  <?php endif; ?>
                </div>

                <div class="form-group">
                  <label><?php echo e(__('Transaction Key')); ?></label>
                  <input type="text" class="form-control" name="authorizenet_transaction_key"
                    value="<?php echo e($authorizenetInfo['transaction_key']); ?>">
                  <?php if($errors->has('authorizenet_transaction_key')): ?>
                    <p class="mt-1 mb-0 text-danger"><?php echo e($errors->first('authorizenet_transaction_key')); ?></p>
                  <?php endif; ?>
                </div>

                <div class="form-group">
                  <label><?php echo e(__('Public Client Key')); ?></label>
                  <input type="text" class="form-control" name="authorizenet_public_client_key"
                    value="<?php echo e($authorizenetInfo['public_client_key']); ?>">
                  <?php if($errors->has('authorizenet_public_client_key')): ?>
                    <p class="mt-1 mb-0 text-danger"><?php echo e($errors->first('authorizenet_public_client_key')); ?></p>
                  <?php endif; ?>
                </div>
              </div>
            </div>
          </div>

          <div class="card-footer">
            <div class="row">
              <div class="col-12 text-center">
                <button type="submit" class="btn btn-success">
                  <?php echo e(__('Update')); ?>

                </button>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>

    
    <div class="col-lg-4">
      <div class="card">
        <form action="<?php echo e(route('admin.payment_gateways.update_iyzico_info')); ?>" method="post">
          <?php echo csrf_field(); ?>
          <div class="card-header">
            <div class="row">
              <div class="col-lg-12">
                <div class="card-title"><?php echo e(__('Iyzico')); ?></div>
              </div>
            </div>
          </div>

          <div class="card-body">
            <div class="row">
              <div class="col-lg-12">
                <div class="form-group">
                  <label><?php echo e(__('Iyzico Status')); ?></label>
                  <div class="selectgroup w-100">
                    <label class="selectgroup-item">
                      <input type="radio" name="status" value="1" class="selectgroup-input"
                        <?php echo e($iyzico->status == 1 ? 'checked' : ''); ?>>
                      <span class="selectgroup-button"><?php echo e(__('Active')); ?></span>
                    </label>
                    <label class="selectgroup-item">
                      <input type="radio" name="status" value="0" class="selectgroup-input"
                        <?php echo e($iyzico->status == 0 ? 'checked' : ''); ?>>
                      <span class="selectgroup-button"><?php echo e(__('Deactive')); ?></span>
                    </label>
                  </div>
                  <?php if($errors->has('status')): ?>
                    <p class="mt-1 mb-0 text-danger"><?php echo e($errors->first('status')); ?></p>
                  <?php endif; ?>
                </div>

                <?php $iyzicoInfo = json_decode($iyzico?->information, true); ?>

                <div class="form-group">
                  <label><?php echo e(__('Iyzico Test Mode')); ?></label>
                  <div class="selectgroup w-100">
                    <label class="selectgroup-item">
                      <input type="radio" name="sandbox_status" value="1" class="selectgroup-input"
                        <?php echo e(!empty($iyzicoInfo) && $iyzicoInfo['sandbox_status'] == 1 ? 'checked' : ''); ?>>
                      <span class="selectgroup-button"><?php echo e(__('Active')); ?></span>
                    </label>
                    <label class="selectgroup-item">
                      <input type="radio" name="sandbox_status" value="0" class="selectgroup-input"
                        <?php echo e(!empty($iyzicoInfo) && $iyzicoInfo['sandbox_status'] == 0 ? 'checked' : ''); ?>>
                      <span class="selectgroup-button"><?php echo e(__('Deactive')); ?></span>
                    </label>
                  </div>
                  <?php if($errors->has('sandbox_status')): ?>
                    <p class="mt-1 mb-0 text-danger"><?php echo e($errors->first('sandbox_status')); ?></p>
                  <?php endif; ?>
                </div>

                <div class="form-group">
                  <label><?php echo e(__('Iyzico Api Key')); ?></label>
                  <input type="text" class="form-control" name="api_key"
                    value="<?php echo e(!empty($iyzicoInfo['api_key']) ? $iyzicoInfo['api_key'] : null); ?>">
                  <?php if($errors->has('api_key')): ?>
                    <p class="mt-1 mb-0 text-danger"><?php echo e($errors->first('api_key')); ?></p>
                  <?php endif; ?>
                </div>
                <div class="form-group">
                  <label><?php echo e(__('Iyzico Secret Key')); ?></label>
                  <input type="text" class="form-control" name="secrect_key"
                    value="<?php echo e(!empty($iyzicoInfo['secrect_key']) ? $iyzicoInfo['secrect_key'] : null); ?>">
                  <?php if($errors->has('secrect_key')): ?>
                    <p class="mt-1 mb-0 text-danger"><?php echo e($errors->first('secrect_key')); ?></p>
                  <?php endif; ?>
                </div>
                <p class="text-warning"><strong>Cron Job Command :</strong> <br>
                  <code>curl -sS <?php echo e(route('cron.check_payment')); ?></code>
                </p>
                <strong class="text-warning">Set the cron job following this video: </strong>
                <a href="https://www.awesomescreenshot.com/video/25404126?key=3f7a7fa8cf2391113bb926f43609fa56"
                  target="_blank">https://www.awesomescreenshot.com/video/25404126?key=3f7a7fa8cf2391113bb926f43609fa56</a>
                <p class="text-danger">without cronjob setup, Iyzico payment method won't work</p>
              </div>
            </div>
          </div>

          <div class="card-footer">
            <div class="row">
              <div class="col-12 text-center">
                <button type="submit" class="btn btn-success">
                  <?php echo e(__('Update')); ?>

                </button>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>

    
    <div class="col-lg-4">
      <div class="card">
        <form action="<?php echo e(route('admin.payment_gateways.update_paytabs_info')); ?>" method="post">
          <?php echo csrf_field(); ?>
          <div class="card-header">
            <div class="row">
              <div class="col-lg-12">
                <div class="card-title"><?php echo e(__('Paytabs')); ?></div>
              </div>
            </div>
          </div>

          <div class="card-body">
            <div class="row">
              <div class="col-lg-12">
                <div class="form-group">
                  <label><?php echo e(__('Paytabs Status')); ?></label>
                  <div class="selectgroup w-100">
                    <label class="selectgroup-item">
                      <input type="radio" name="status" value="1" class="selectgroup-input"
                        <?php echo e($paytabs->status == 1 ? 'checked' : ''); ?>>
                      <span class="selectgroup-button"><?php echo e(__('Active')); ?></span>
                    </label>
                    <label class="selectgroup-item">
                      <input type="radio" name="status" value="0" class="selectgroup-input"
                        <?php echo e($paytabs->status == 0 ? 'checked' : ''); ?>>
                      <span class="selectgroup-button"><?php echo e(__('Deactive')); ?></span>
                    </label>
                  </div>
                  <?php if($errors->has('status')): ?>
                    <p class="mt-1 mb-0 text-danger"><?php echo e($errors->first('status')); ?></p>
                  <?php endif; ?>
                </div>

                <?php $paytabsInfo = json_decode($paytabs->information, true); ?>

                <div class="form-group">
                  <label><?php echo e(__('Country')); ?></label>
                  <select name="country" id="" class="form-control">
                    <option value="global" <?php if($paytabsInfo['country'] == 'global'): echo 'selected'; endif; ?>><?php echo e(__('Global')); ?></option>
                    <option value="sa" <?php if($paytabsInfo['country'] == 'sa'): echo 'selected'; endif; ?>><?php echo e(__('Saudi Arabia')); ?></option>
                    <option value="uae" <?php if($paytabsInfo['country'] == 'uae'): echo 'selected'; endif; ?>><?php echo e(__('United Arab Emirates')); ?></option>
                    <option value="egypt" <?php if($paytabsInfo['country'] == 'egypt'): echo 'selected'; endif; ?>><?php echo e(__('Egypt')); ?></option>
                    <option value="oman" <?php if($paytabsInfo['country'] == 'oman'): echo 'selected'; endif; ?>><?php echo e(__('Oman')); ?></option>
                    <option value="jordan" <?php if($paytabsInfo['country'] == 'jordan'): echo 'selected'; endif; ?>><?php echo e(__('Jordan')); ?></option>
                    <option value="iraq" <?php if($paytabsInfo['country'] == 'iraq'): echo 'selected'; endif; ?>><?php echo e(__('Iraq')); ?></option>
                  </select>
                  <?php if($errors->has('country')): ?>
                    <p class="mt-1 mb-0 text-danger"><?php echo e($errors->first('server_key')); ?></p>
                  <?php endif; ?>
                </div>

                <div class="form-group">
                  <label><?php echo e(__('Server Key')); ?></label>
                  <input type="text" class="form-control" name="server_key"
                    value="<?php echo e(@$paytabsInfo['server_key']); ?>">
                  <?php if($errors->has('server_key')): ?>
                    <p class="mt-1 mb-0 text-danger"><?php echo e($errors->first('server_key')); ?></p>
                  <?php endif; ?>
                </div>
                <div class="form-group">
                  <label><?php echo e(__('Profile Id')); ?></label>
                  <input type="text" class="form-control" name="profile_id"
                    value="<?php echo e(@$paytabsInfo['profile_id']); ?>">
                  <?php if($errors->has('profile_id')): ?>
                    <p class="mt-1 mb-0 text-danger"><?php echo e($errors->first('profile_id')); ?></p>
                  <?php endif; ?>
                </div>
                <div class="form-group">
                  <label><?php echo e(__('API Endpoint')); ?></label>
                  <input type="text" class="form-control" name="api_endpoint"
                    value="<?php echo e(@$paytabsInfo['api_endpoint']); ?>">
                  <?php if($errors->has('api_endpoint')): ?>
                    <p class="mt-1 mb-0 text-danger"><?php echo e($errors->first('api_endpoint')); ?></p>
                  <?php endif; ?>
                  <p class="mt-1 mb-0 text-warning">You will get your 'API Endpoit' from PayTabs Dashboard.
                  </p>
                  <strong class="text-warning">Step 1:</strong> <a href="https://prnt.sc/McaCbxt75fyi"
                    target="_blank">https://prnt.sc/McaCbxt75fyi</a><br>
                  <strong class="text-warning">Step 2:</strong> <a href="https://prnt.sc/DgztAyHVR2o8"
                    target="_blank">https://prnt.sc/DgztAyHVR2o8</a>
                </div>
              </div>
            </div>
          </div>

          <div class="card-footer">
            <div class="row">
              <div class="col-12 text-center">
                <button type="submit" class="btn btn-success">
                  <?php echo e(__('Update')); ?>

                </button>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>

    
    <div class="col-lg-4">
      <div class="card">
        <form action="<?php echo e(route('admin.payment_gateways.update_phonepe_info')); ?>" method="post">
          <?php echo csrf_field(); ?>
          <div class="card-header">
            <div class="row">
              <div class="col-lg-12">
                <div class="card-title"><?php echo e(__('Phonepe')); ?></div>
              </div>
            </div>
          </div>

          <div class="card-body">
            <div class="row">
              <div class="col-lg-12">
                <div class="form-group">
                  <label><?php echo e(__('Phonepe Status')); ?></label>
                  <div class="selectgroup w-100">
                    <label class="selectgroup-item">
                      <input type="radio" name="status" value="1" class="selectgroup-input"
                        <?php echo e($phonepe->status == 1 ? 'checked' : ''); ?>>
                      <span class="selectgroup-button"><?php echo e(__('Active')); ?></span>
                    </label>
                    <label class="selectgroup-item">
                      <input type="radio" name="status" value="0" class="selectgroup-input"
                        <?php echo e($phonepe->status == 0 ? 'checked' : ''); ?>>
                      <span class="selectgroup-button"><?php echo e(__('Deactive')); ?></span>
                    </label>
                  </div>
                  <?php if($errors->has('status')): ?>
                    <p class="mt-1 mb-0 text-danger"><?php echo e($errors->first('status')); ?></p>
                  <?php endif; ?>
                </div>

                <?php $phonepeInfo = json_decode($phonepe->information, true); ?>

                <div class="form-group">
                  <label><?php echo e(__('Sandbox Status')); ?></label>
                  <div class="selectgroup w-100">
                    <label class="selectgroup-item">
                      <input type="radio" name="sandbox_status" value="1" class="selectgroup-input"
                        <?php echo e($phonepeInfo['sandbox_status'] == 1 ? 'checked' : ''); ?>>
                      <span class="selectgroup-button"><?php echo e(__('Active')); ?></span>
                    </label>
                    <label class="selectgroup-item">
                      <input type="radio" name="sandbox_status" value="0" class="selectgroup-input"
                        <?php echo e($phonepeInfo['sandbox_status'] == 0 ? 'checked' : ''); ?>>
                      <span class="selectgroup-button"><?php echo e(__('Deactive')); ?></span>
                    </label>
                  </div>
                  <?php if($errors->has('sandbox_status')): ?>
                    <p class="mt-1 mb-0 text-danger"><?php echo e($errors->first('sandbox_status')); ?></p>
                  <?php endif; ?>
                </div>

                <div class="form-group">
                  <label><?php echo e(__('Merchant Id')); ?></label>
                  <input type="text" class="form-control" name="merchant_id"
                    value="<?php echo e(@$phonepeInfo['merchant_id']); ?>">
                  <?php if($errors->has('merchant_id')): ?>
                    <p class="mt-1 mb-0 text-danger"><?php echo e($errors->first('merchant_id')); ?></p>
                  <?php endif; ?>
                </div>

                <div class="form-group">
                  <label><?php echo e(__('Salt Key')); ?></label>
                  <input type="text" class="form-control" name="salt_key"
                    value="<?php echo e(@$phonepeInfo['salt_key']); ?>">
                  <?php if($errors->has('salt_key')): ?>
                    <p class="mt-1 mb-0 text-danger"><?php echo e($errors->first('salt_key')); ?></p>
                  <?php endif; ?>
                </div>
                <div class="form-group">
                  <label><?php echo e(__('Salt Index')); ?></label>
                  <input type="number" class="form-control" name="salt_index"
                    value="<?php echo e(@$phonepeInfo['salt_index']); ?>">
                  <?php if($errors->has('salt_index')): ?>
                    <p class="mt-1 mb-0 text-danger"><?php echo e($errors->first('salt_index')); ?></p>
                  <?php endif; ?>
                </div>
              </div>
            </div>
          </div>

          <div class="card-footer">
            <div class="row">
              <div class="col-12 text-center">
                <button type="submit" class="btn btn-success">
                  <?php echo e(__('Update')); ?>

                </button>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>

    <div class="col-lg-4">
      <div class="card">
        <form action="<?php echo e(route('admin.payment_gateways.update_paytm_info')); ?>" method="post">
          <?php echo csrf_field(); ?>
          <div class="card-header">
            <div class="row">
              <div class="col-lg-12">
                <div class="card-title"><?php echo e(__('Paytm')); ?></div>
              </div>
            </div>
          </div>

          <div class="card-body">
            <div class="row">
              <div class="col-lg-12">
                <div class="form-group">
                  <label><?php echo e(__('Status')); ?></label>
                  <div class="selectgroup w-100">
                    <label class="selectgroup-item">
                      <input type="radio" name="paytm_status" value="1" class="selectgroup-input"
                        <?php echo e($paytm->status == 1 ? 'checked' : ''); ?>>
                      <span class="selectgroup-button"><?php echo e(__('Active')); ?></span>
                    </label>
                    <label class="selectgroup-item">
                      <input type="radio" name="paytm_status" value="0" class="selectgroup-input"
                        <?php echo e($paytm->status == 0 ? 'checked' : ''); ?>>
                      <span class="selectgroup-button"><?php echo e(__('Deactive')); ?></span>
                    </label>
                  </div>
                  <?php if($errors->has('paytm_status')): ?>
                    <p class="mt-1 mb-0 text-danger"><?php echo e($errors->first('paytm_status')); ?></p>
                  <?php endif; ?>
                </div>

                <?php $paytmInfo = json_decode($paytm->information, true); ?>

                <div class="form-group">
                  <label><?php echo e(__('Environment')); ?></label>
                  <div class="selectgroup w-100">
                    <label class="selectgroup-item">
                      <input type="radio" name="paytm_environment" value="local" class="selectgroup-input"
                        <?php echo e($paytmInfo['environment'] == 'local' ? 'checked' : ''); ?>>
                      <span class="selectgroup-button"><?php echo e(__('Local')); ?></span>
                    </label>
                    <label class="selectgroup-item">
                      <input type="radio" name="paytm_environment" value="production" class="selectgroup-input"
                        <?php echo e($paytmInfo['environment'] == 'production' ? 'checked' : ''); ?>>
                      <span class="selectgroup-button"><?php echo e(__('Production')); ?></span>
                    </label>
                  </div>
                  <?php if($errors->has('paytm_environment')): ?>
                    <p class="mt-1 mb-0 text-danger"><?php echo e($errors->first('paytm_environment')); ?></p>
                  <?php endif; ?>
                </div>

                <div class="form-group">
                  <label><?php echo e(__('Merchant Key')); ?></label>
                  <input type="text" class="form-control" name="paytm_merchant_key"
                    value="<?php echo e($paytmInfo['merchant_key']); ?>">
                  <?php if($errors->has('paytm_merchant_key')): ?>
                    <p class="mt-1 mb-0 text-danger"><?php echo e($errors->first('paytm_merchant_key')); ?></p>
                  <?php endif; ?>
                </div>

                <div class="form-group">
                  <label><?php echo e(__('Merchant MID')); ?></label>
                  <input type="text" class="form-control" name="paytm_merchant_mid"
                    value="<?php echo e($paytmInfo['merchant_mid']); ?>">
                  <?php if($errors->has('paytm_merchant_mid')): ?>
                    <p class="mt-1 mb-0 text-danger"><?php echo e($errors->first('paytm_merchant_mid')); ?></p>
                  <?php endif; ?>
                </div>

                <div class="form-group">
                  <label><?php echo e(__('Merchant Website')); ?></label>
                  <input type="text" class="form-control" name="paytm_merchant_website"
                    value="<?php echo e($paytmInfo['merchant_website']); ?>">
                  <?php if($errors->has('paytm_merchant_website')): ?>
                    <p class="mt-1 mb-0 text-danger"><?php echo e($errors->first('paytm_merchant_website')); ?></p>
                  <?php endif; ?>
                </div>

                <div class="form-group">
                  <label><?php echo e(__('Industry Type')); ?></label>
                  <input type="text" class="form-control" name="paytm_industry_type"
                    value="<?php echo e($paytmInfo['industry_type']); ?>">
                  <?php if($errors->has('paytm_industry_type')): ?>
                    <p class="mt-1 mb-0 text-danger"><?php echo e($errors->first('paytm_industry_type')); ?></p>
                  <?php endif; ?>
                </div>
              </div>
            </div>
          </div>

          <div class="card-footer">
            <div class="row">
              <div class="col-12 text-center">
                <button type="submit" class="btn btn-success">
                  <?php echo e(__('Update')); ?>

                </button>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\younes\Downloads\junspro-main (1)\junspro-main3\resources\views\backend\payment-gateways\online-gateways.blade.php ENDPATH**/ ?>