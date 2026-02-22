<?php $__env->startSection('content'); ?>
  <div class="page-header">
    <h4 class="page-title"><?php echo e(__('Plugins')); ?></h4>
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
        <a href="#"><?php echo e(__('Plugins')); ?></a>
      </li>
    </ul>
  </div>

  <div class="row">
    <div class="col-lg-4">
      <div class="card">
        <form action="<?php echo e(route('admin.basic_settings.update_disqus')); ?>" method="post">
          <?php echo csrf_field(); ?>
          <div class="card-header">
            <div class="row">
              <div class="col-lg-12">
                <div class="card-title"><?php echo e(__('Disqus')); ?></div>
              </div>
            </div>
          </div>

          <div class="card-body">
            <div class="row">
              <div class="col-lg-12">
                <div class="form-group">
                  <label><?php echo e(__('Status') . '*'); ?></label>
                  <div class="selectgroup w-100">
                    <label class="selectgroup-item">
                      <input type="radio" name="disqus_status" value="1" class="selectgroup-input" <?php echo e((!empty($data) && $data->disqus_status == 1) ? 'checked' : ''); ?>>
                      <span class="selectgroup-button"><?php echo e(__('Enable')); ?></span>
                    </label>

                    <label class="selectgroup-item">
                      <input type="radio" name="disqus_status" value="0" class="selectgroup-input" <?php echo e((!empty($data) && $data->disqus_status == 0) ? 'checked' : ''); ?>>
                      <span class="selectgroup-button"><?php echo e(__('Disable')); ?></span>
                    </label>
                  </div>

                  <?php if($errors->has('disqus_status')): ?>
                    <p class="mt-1 mb-0 text-danger"><?php echo e($errors->first('disqus_status')); ?></p>
                  <?php endif; ?>
                </div>

                <div class="form-group">
                  <label><?php echo e(__('Short Name') . '*'); ?></label>
                  <input type="text" class="form-control" name="disqus_short_name" value="<?php echo e(!empty($data) ? $data->disqus_short_name : ''); ?>">

                  <?php if($errors->has('disqus_short_name')): ?>
                    <p class="mt-1 mb-0 text-danger"><?php echo e($errors->first('disqus_short_name')); ?></p>
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
        <form action="<?php echo e(route('admin.basic_settings.update_recaptcha')); ?>" method="post">
          <?php echo csrf_field(); ?>
          <div class="card-header">
            <div class="row">
              <div class="col-lg-12">
                <div class="card-title"><?php echo e(__('Google Recaptcha')); ?></div>
              </div>
            </div>
          </div>

          <div class="card-body">
            <div class="row">
              <div class="col-lg-12">
                <div class="form-group">
                  <label><?php echo e(__('Status') . '*'); ?></label>
                  <div class="selectgroup w-100">
                    <label class="selectgroup-item">
                      <input type="radio" name="google_recaptcha_status" value="1" class="selectgroup-input" <?php echo e((!empty($data) && $data->google_recaptcha_status == 1) ? 'checked' : ''); ?>>
                      <span class="selectgroup-button"><?php echo e(__('Enable')); ?></span>
                    </label>

                    <label class="selectgroup-item">
                      <input type="radio" name="google_recaptcha_status" value="0" class="selectgroup-input" <?php echo e((!empty($data) && $data->google_recaptcha_status == 0) ? 'checked' : ''); ?>>
                      <span class="selectgroup-button"><?php echo e(__('Disable')); ?></span>
                    </label>
                  </div>

                  <?php if($errors->has('google_recaptcha_status')): ?>
                    <p class="mt-1 mb-0 text-danger"><?php echo e($errors->first('google_recaptcha_status')); ?></p>
                  <?php endif; ?>
                </div>

                <div class="form-group">
                  <label><?php echo e(__('Site Key') . '*'); ?></label>
                  <input type="text" class="form-control" name="google_recaptcha_site_key" value="<?php echo e(!empty($data) ? $data->google_recaptcha_site_key : ''); ?>">

                  <?php if($errors->has('google_recaptcha_site_key')): ?>
                    <p class="mt-1 mb-0 text-danger"><?php echo e($errors->first('google_recaptcha_site_key')); ?></p>
                  <?php endif; ?>
                </div>

                <div class="form-group">
                  <label><?php echo e(__('Secret Key') . '*'); ?></label>
                  <input type="text" class="form-control" name="google_recaptcha_secret_key" value="<?php echo e(!empty($data) ? $data->google_recaptcha_secret_key : ''); ?>">

                  <?php if($errors->has('google_recaptcha_secret_key')): ?>
                    <p class="mt-1 mb-0 text-danger"><?php echo e($errors->first('google_recaptcha_secret_key')); ?></p>
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
        <form action="<?php echo e(route('admin.basic_settings.update_google')); ?>" method="post">
          <?php echo csrf_field(); ?>
          <div class="card-header">
            <div class="row">
              <div class="col-lg-12">
                <div class="card-title"><?php echo e(__('Login via Google')); ?></div>
              </div>
            </div>
          </div>

          <div class="card-body">
            <div class="row">
              <div class="col-lg-12">
                <div class="form-group">
                  <label><?php echo e(__('Login Status') . '*'); ?></label>
                  <div class="selectgroup w-100">
                    <label class="selectgroup-item">
                      <input type="radio" name="google_login_status" value="1" class="selectgroup-input" <?php echo e((!empty($data) && $data->google_login_status == 1) ? 'checked' : ''); ?>>
                      <span class="selectgroup-button"><?php echo e(__('Enable')); ?></span>
                    </label>

                    <label class="selectgroup-item">
                      <input type="radio" name="google_login_status" value="0" class="selectgroup-input" <?php echo e((!empty($data) && $data->google_login_status == 0) ? 'checked' : ''); ?>>
                      <span class="selectgroup-button"><?php echo e(__('Disable')); ?></span>
                    </label>
                  </div>

                  <?php if($errors->has('google_login_status')): ?>
                    <p class="mt-1 mb-0 text-danger"><?php echo e($errors->first('google_login_status')); ?></p>
                  <?php endif; ?>
                </div>

                <div class="form-group">
                  <label><?php echo e(__('Client ID') . '*'); ?></label>
                  <input type="text" class="form-control" name="google_client_id" value="<?php echo e(!empty($data) ? $data->google_client_id : ''); ?>">

                  <?php if($errors->has('google_client_id')): ?>
                    <p class="mt-1 mb-0 text-danger"><?php echo e($errors->first('google_client_id')); ?></p>
                  <?php endif; ?>
                </div>

                <div class="form-group">
                  <label><?php echo e(__('Client Secret') . '*'); ?></label>
                  <input type="text" class="form-control" name="google_client_secret" value="<?php echo e(!empty($data) ? $data->google_client_secret : ''); ?>">

                  <?php if($errors->has('google_client_secret')): ?>
                    <p class="mt-1 mb-0 text-danger"><?php echo e($errors->first('google_client_secret')); ?></p>
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
        <form action="<?php echo e(route('admin.basic_settings.update_facebook')); ?>" method="post">
          <?php echo csrf_field(); ?>
          <div class="card-header">
            <div class="row">
              <div class="col-lg-12">
                <div class="card-title"><?php echo e(__('Login via Facebook')); ?></div>
              </div>
            </div>
          </div>

          <div class="card-body">
            <div class="row">
              <div class="col-lg-12">
                <div class="form-group">
                  <label><?php echo e(__('Login Status') . '*'); ?></label>
                  <div class="selectgroup w-100">
                    <label class="selectgroup-item">
                      <input type="radio" name="facebook_login_status" value="1" class="selectgroup-input" <?php echo e((!empty($data) && $data->facebook_login_status == 1) ? 'checked' : ''); ?>>
                      <span class="selectgroup-button"><?php echo e(__('Enable')); ?></span>
                    </label>

                    <label class="selectgroup-item">
                      <input type="radio" name="facebook_login_status" value="0" class="selectgroup-input" <?php echo e((!empty($data) && $data->facebook_login_status == 0) ? 'checked' : ''); ?>>
                      <span class="selectgroup-button"><?php echo e(__('Disable')); ?></span>
                    </label>
                  </div>

                  <?php if($errors->has('facebook_login_status')): ?>
                    <p class="mt-1 mb-0 text-danger"><?php echo e($errors->first('facebook_login_status')); ?></p>
                  <?php endif; ?>
                </div>

                <div class="form-group">
                  <label><?php echo e(__('App ID') . '*'); ?></label>
                  <input type="text" class="form-control" name="facebook_app_id" value="<?php echo e(!empty($data) ? $data->facebook_app_id : ''); ?>">

                  <?php if($errors->has('facebook_app_id')): ?>
                    <p class="mt-1 mb-0 text-danger"><?php echo e($errors->first('facebook_app_id')); ?></p>
                  <?php endif; ?>
                </div>

                <div class="form-group">
                  <label><?php echo e(__('App Secret') . '*'); ?></label>
                  <input type="text" class="form-control" name="facebook_app_secret" value="<?php echo e(!empty($data) ? $data->facebook_app_secret : ''); ?>">

                  <?php if($errors->has('facebook_app_secret')): ?>
                    <p class="mt-1 mb-0 text-danger"><?php echo e($errors->first('facebook_app_secret')); ?></p>
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
        <form action="<?php echo e(route('admin.basic_settings.update_pusher')); ?>" method="post">
          <?php echo csrf_field(); ?>
          <div class="card-header">
            <div class="row">
              <div class="col-lg-12">
                <div class="card-title"><?php echo e(__('Pusher')); ?></div>
              </div>
            </div>
          </div>

          <div class="card-body">
            <div class="row">
              <div class="col-lg-12">
                <div class="form-group">
                  <label><?php echo e(__('App ID') . '*'); ?></label>
                  <input type="text" class="form-control" name="pusher_app_id" value="<?php echo e(!empty($data) ? $data->pusher_app_id : ''); ?>">

                  <?php if($errors->has('pusher_app_id')): ?>
                    <p class="mt-1 mb-0 text-danger"><?php echo e($errors->first('pusher_app_id')); ?></p>
                  <?php endif; ?>
                </div>

                <div class="form-group">
                  <label><?php echo e(__('Key') . '*'); ?></label>
                  <input type="text" class="form-control" name="pusher_key" value="<?php echo e(!empty($data) ? $data->pusher_key : ''); ?>">

                  <?php if($errors->has('pusher_key')): ?>
                    <p class="mt-1 mb-0 text-danger"><?php echo e($errors->first('pusher_key')); ?></p>
                  <?php endif; ?>
                </div>

                <div class="form-group">
                  <label><?php echo e(__('Secret') . '*'); ?></label>
                  <input type="text" class="form-control" name="pusher_secret" value="<?php echo e(!empty($data) ? $data->pusher_secret : ''); ?>">

                  <?php if($errors->has('pusher_secret')): ?>
                    <p class="mt-1 mb-0 text-danger"><?php echo e($errors->first('pusher_secret')); ?></p>
                  <?php endif; ?>
                </div>

                <div class="form-group">
                  <label><?php echo e(__('Cluster') . '*'); ?></label>
                  <input type="text" class="form-control" name="pusher_cluster" value="<?php echo e(!empty($data) ? $data->pusher_cluster : ''); ?>">

                  <?php if($errors->has('pusher_cluster')): ?>
                    <p class="mt-1 mb-0 text-danger"><?php echo e($errors->first('pusher_cluster')); ?></p>
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
        <form action="<?php echo e(route('admin.basic_settings.update_whatsapp')); ?>" method="post">
          <?php echo csrf_field(); ?>
          <div class="card-header">
            <div class="row">
              <div class="col-lg-12">
                <div class="card-title"><?php echo e(__('WhatsApp')); ?></div>
              </div>
            </div>
          </div>

          <div class="card-body">
            <div class="row">
              <div class="col-lg-12">
                <div class="form-group">
                  <label><?php echo e(__('Status') . '*'); ?></label>
                  <div class="selectgroup w-100">
                    <label class="selectgroup-item">
                      <input type="radio" name="whatsapp_status" value="1" class="selectgroup-input" <?php echo e((!empty($data) && $data->whatsapp_status == 1) ? 'checked' : ''); ?>>
                      <span class="selectgroup-button"><?php echo e(__('Enable')); ?></span>
                    </label>

                    <label class="selectgroup-item">
                      <input type="radio" name="whatsapp_status" value="0" class="selectgroup-input" <?php echo e((!empty($data) && $data->whatsapp_status == 0) ? 'checked' : ''); ?>>
                      <span class="selectgroup-button"><?php echo e(__('Disable')); ?></span>
                    </label>
                  </div>

                  <?php if($errors->has('whatsapp_status')): ?>
                    <p class="mt-1 mb-0 text-danger"><?php echo e($errors->first('whatsapp_status')); ?></p>
                  <?php endif; ?>
                </div>

                <div class="form-group">
                  <label><?php echo e(__('Number') . '*'); ?></label>
                  <input type="text" class="form-control" name="whatsapp_number" value="<?php echo e(!empty($data) ? $data->whatsapp_number : ''); ?>">

                  <?php if($errors->has('whatsapp_number')): ?>
                    <p class="mt-1 mb-0 text-danger"><?php echo e($errors->first('whatsapp_number')); ?></p>
                  <?php endif; ?>
                </div>

                <div class="form-group">
                  <label><?php echo e(__('Header Title') . '*'); ?></label>
                  <input type="text" class="form-control" name="whatsapp_header_title" value="<?php echo e(!empty($data) ? $data->whatsapp_header_title : ''); ?>">

                  <?php if($errors->has('whatsapp_header_title')): ?>
                    <p class="mt-1 mb-0 text-danger"><?php echo e($errors->first('whatsapp_header_title')); ?></p>
                  <?php endif; ?>
                </div>

                <div class="form-group">
                  <label><?php echo e(__('Popup Status') . '*'); ?></label>
                  <div class="selectgroup w-100">
                    <label class="selectgroup-item">
                      <input type="radio" name="whatsapp_popup_status" value="1" class="selectgroup-input" <?php echo e((!empty($data) && $data->whatsapp_popup_status == 1) ? 'checked' : ''); ?>>
                      <span class="selectgroup-button"><?php echo e(__('Enable')); ?></span>
                    </label>

                    <label class="selectgroup-item">
                      <input type="radio" name="whatsapp_popup_status" value="0" class="selectgroup-input" <?php echo e((!empty($data) && $data->whatsapp_popup_status == 0) ? 'checked' : ''); ?>>
                      <span class="selectgroup-button"><?php echo e(__('Disable')); ?></span>
                    </label>
                  </div>

                  <?php if($errors->has('whatsapp_popup_status')): ?>
                    <p class="mt-1 mb-0 text-danger"><?php echo e($errors->first('whatsapp_popup_status')); ?></p>
                  <?php endif; ?>
                </div>

                <div class="form-group">
                  <label><?php echo e(__('Popup Message') . '*'); ?></label>
                  <textarea class="form-control" name="whatsapp_popup_message" rows="3"><?php echo e(!empty($data) ? $data->whatsapp_popup_message : ''); ?></textarea>

                  <?php if($errors->has('whatsapp_popup_message')): ?>
                    <p class="mt-1 mb-0 text-danger"><?php echo e($errors->first('whatsapp_popup_message')); ?></p>
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

<?php echo $__env->make('backend.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\younes\Downloads\junspro-main (1)\junspro-main3\resources\views\backend\basic-settings\plugins.blade.php ENDPATH**/ ?>