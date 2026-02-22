<?php if ($__env->exists('backend.partials.rtl-style')) echo $__env->make('backend.partials.rtl-style', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<?php $__env->startSection('content'); ?>
  <div class="page-header">
    <h4 class="page-title"><?php echo e(__('Page Headings')); ?></h4>
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
        <a href="#"><?php echo e(__('Basic Settings')); ?></a>
      </li>
      <li class="separator">
        <i class="flaticon-right-arrow"></i>
      </li>
      <li class="nav-item">
        <a href="#"><?php echo e(__('Page Headings')); ?></a>
      </li>
    </ul>
  </div>

  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <form
          action="<?php echo e(route('admin.basic_settings.update_page_headings', ['language' => request()->input('language')])); ?>"
          method="post">
          <?php echo csrf_field(); ?>
          <div class="card-header">
            <div class="row">
              <div class="col-lg-10">
                <div class="card-title"><?php echo e(__('Update Page Headings')); ?></div>
              </div>

              <div class="col-lg-2">
                <?php if ($__env->exists('backend.partials.languages')) echo $__env->make('backend.partials.languages', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
              </div>
            </div>
          </div>

          <div class="card-body">
            <div class="row">
              <div class="col-lg-10 mx-auto">
                <div class="row">
                  <div class="col-md-4">
                    <div class="form-group">
                      <label><?php echo e(__('Sellers Page Title') . '*'); ?></label>
                      <input type="text" class="form-control" name="seller_page_title"
                        value="<?php echo e(!is_null($data) ? $data->seller_page_title : ''); ?>">
                      <?php $__errorArgs = ['seller_page_title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="mt-2 mb-0 text-danger"><?php echo e($message); ?></p>
                      <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label><?php echo e(__('Pricing Page Title') . '*'); ?></label>
                      <input type="text" class="form-control" name="pricing_page_title"
                        value="<?php echo e(!is_null($data) ? $data->pricing_page_title : ''); ?>">
                      <?php $__errorArgs = ['pricing_page_title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="mt-2 mb-0 text-danger"><?php echo e($message); ?></p>
                      <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label><?php echo e(__('About Us Page Title') . '*'); ?></label>
                      <input type="text" class="form-control" name="about_us_page_title"
                        value="<?php echo e(!is_null($data) ? $data->about_us_page_title : ''); ?>">
                      <?php $__errorArgs = ['about_us_page_title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="mt-2 mb-0 text-danger"><?php echo e($message); ?></p>
                      <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label><?php echo e(__('Blog Page Title') . '*'); ?></label>
                      <input type="text" class="form-control" name="blog_page_title"
                        value="<?php echo e(!is_null($data) ? $data->blog_page_title : ''); ?>">
                      <?php $__errorArgs = ['blog_page_title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="mt-2 mb-0 text-danger"><?php echo e($message); ?></p>
                      <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label><?php echo e(__('Post Details Page Title') . '*'); ?></label>
                      <input type="text" class="form-control" name="post_details_page_title"
                        value="<?php echo e(!is_null($data) ? $data->post_details_page_title : ''); ?>">
                      <?php $__errorArgs = ['post_details_page_title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="mt-2 mb-0 text-danger"><?php echo e($message); ?></p>
                      <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label><?php echo e(__('Contact Page Title') . '*'); ?></label>
                      <input type="text" class="form-control" name="contact_page_title"
                        value="<?php echo e(!is_null($data) ? $data->contact_page_title : ''); ?>">
                      <?php $__errorArgs = ['contact_page_title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="mt-2 mb-0 text-danger"><?php echo e($message); ?></p>
                      <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                  </div>

                  <div class="col-md-4">
                    <div class="form-group">
                      <label><?php echo e(__('Error Page Title') . '*'); ?></label>
                      <input type="text" class="form-control" name="error_page_title"
                        value="<?php echo e(!is_null($data) ? $data->error_page_title : ''); ?>">
                      <?php $__errorArgs = ['error_page_title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="mt-2 mb-0 text-danger"><?php echo e($message); ?></p>
                      <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label><?php echo e(__('FAQ Page Title') . '*'); ?></label>
                      <input type="text" class="form-control" name="faq_page_title"
                        value="<?php echo e(!is_null($data) ? $data->faq_page_title : ''); ?>">
                      <?php $__errorArgs = ['faq_page_title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="mt-2 mb-0 text-danger"><?php echo e($message); ?></p>
                      <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label><?php echo e(__('Customer Forget Password Page Title') . '*'); ?></label>
                      <input type="text" class="form-control" name="forget_password_page_title"
                        value="<?php echo e(!is_null($data) ? $data->forget_password_page_title : ''); ?>">
                      <?php $__errorArgs = ['forget_password_page_title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="mt-2 mb-0 text-danger"><?php echo e($message); ?></p>
                      <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label><?php echo e(__('Customer Login Page Title') . '*'); ?></label>
                      <input type="text" class="form-control" name="login_page_title"
                        value="<?php echo e(!is_null($data) ? $data->login_page_title : ''); ?>">
                      <?php $__errorArgs = ['login_page_title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="mt-2 mb-0 text-danger"><?php echo e($message); ?></p>
                      <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label><?php echo e(__('Customer Signup Page Title') . '*'); ?></label>
                      <input type="text" class="form-control" name="signup_page_title"
                        value="<?php echo e(!is_null($data) ? $data->signup_page_title : ''); ?>">
                      <?php $__errorArgs = ['signup_page_title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="mt-2 mb-0 text-danger"><?php echo e($message); ?></p>
                      <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                  </div>

                  <div class="col-md-4">
                    <div class="form-group">
                      <label><?php echo e(__('Services Page Title') . '*'); ?></label>
                      <input type="text" class="form-control" name="services_page_title"
                        value="<?php echo e(!is_null($data) ? $data->services_page_title : ''); ?>">
                      <?php $__errorArgs = ['services_page_title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="mt-2 mb-0 text-danger"><?php echo e($message); ?></p>
                      <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label><?php echo e(__('Service Details Page Title') . '*'); ?></label>
                      <input type="text" class="form-control" name="service_details_page_title"
                        value="<?php echo e(!is_null($data) ? $data->service_details_page_title : ''); ?>">
                      <?php $__errorArgs = ['service_details_page_title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="mt-2 mb-0 text-danger"><?php echo e($message); ?></p>
                      <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label><?php echo e(__('Seller Login Page Title') . '*'); ?></label>
                      <input type="text" class="form-control" name="seller_login_page_title"
                        value="<?php echo e(!is_null($data) ? $data->seller_login_page_title : ''); ?>">
                      <?php $__errorArgs = ['seller_login_page_title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="mt-2 mb-0 text-danger"><?php echo e($message); ?></p>
                      <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label><?php echo e(__('Seller Signup Page Title') . '*'); ?></label>
                      <input type="text" class="form-control" name="seller_signup_page_title"
                        value="<?php echo e(!is_null($data) ? $data->seller_signup_page_title : ''); ?>">
                      <?php $__errorArgs = ['seller_signup_page_title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="mt-2 mb-0 text-danger"><?php echo e($message); ?></p>
                      <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label><?php echo e(__('Seller Forget Password Page Title') . '*'); ?></label>
                      <input type="text" class="form-control" name="seller_forget_password_page_title"
                        value="<?php echo e(!is_null($data) ? $data->seller_forget_password_page_title : ''); ?>">
                      <?php $__errorArgs = ['seller_forget_password_page_title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="mt-2 mb-0 text-danger"><?php echo e($message); ?></p>
                      <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                  </div>
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

<?php echo $__env->make('backend.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\younes\Downloads\junspro-main (1)\junspro-main3\resources\views\backend\basic-settings\page-headings.blade.php ENDPATH**/ ?>