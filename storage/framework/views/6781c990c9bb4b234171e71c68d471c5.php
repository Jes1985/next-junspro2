<?php $__env->startSection('content'); ?>
  <div class="page-header">
    <h4 class="page-title"><?php echo e(__('Email Settings')); ?></h4>
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
        <a href="#"><?php echo e(__('Email Settings')); ?></a>
      </li>
      <li class="separator">
        <i class="flaticon-right-arrow"></i>
      </li>
      <li class="nav-item">
        <a href="#"><?php echo e(__('Mail Templates')); ?></a>
      </li>
      <li class="separator">
        <i class="flaticon-right-arrow"></i>
      </li>
      <li class="nav-item">
        <a href="#"><?php echo e(__('Edit Mail Template')); ?></a>
      </li>
    </ul>
  </div>

  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <div class="card-title d-inline-block"><?php echo e(__('Edit Mail Template')); ?></div>
          <a class="btn btn-info btn-sm float-right d-inline-block" href="<?php echo e(route('admin.basic_settings.mail_templates')); ?>">
            <span class="btn-label">
              <i class="fas fa-backward mdb_2342"></i>
            </span>
            <?php echo e(__('Back')); ?>

          </a>
        </div>

        <div class="card-body pt-5">
          <div class="row">
            <div class="col-lg-7">
              <form id="mailTemplateForm" action="<?php echo e(route('admin.basic_settings.update_mail_template', ['id' => $templateInfo->id])); ?>" method="post">
                <?php echo csrf_field(); ?>
                <div class="row">
                  <div class="col-lg-12">
                    <div class="form-group">
                      <?php $mailType = str_replace('_', ' ', $templateInfo->mail_type); ?>

                      <label><?php echo e(__('Mail Type')); ?></label>
                      <input type="text" class="form-control text-capitalize" name="mail_type" value="<?php echo e($mailType); ?>" readonly>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-lg-12">
                    <div class="form-group">
                      <label><?php echo e(__('Mail Subject*')); ?></label>
                      <input type="text" class="form-control" name="mail_subject" placeholder="Enter Mail Subject" value="<?php echo e($templateInfo->mail_subject); ?>">
                      <?php if($errors->has('mail_subject')): ?>
                        <p class="mt-1 mb-0 text-danger"><?php echo e($errors->first('mail_subject')); ?></p>
                      <?php endif; ?>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-lg-12">
                    <div class="form-group">
                      <label><?php echo e(__('Mail Body*')); ?></label>
                      <textarea class="form-control summernote" name="mail_body" placeholder="Enter Mail Body Format" data-height="300"><?php echo e(replaceBaseUrl($templateInfo->mail_body, 'summernote')); ?></textarea>
                      <?php if($errors->has('mail_body')): ?>
                        <p class="text-danger"><?php echo e($errors->first('mail_body')); ?></p>
                      <?php endif; ?>
                    </div>
                  </div>
                </div>
              </form>
            </div>

            <?php if ($__env->exists('backend.basic-settings.email.bbcode')) echo $__env->make('backend.basic-settings.email.bbcode', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
          </div>
        </div>

        <div class="card-footer">
          <div class="row">
            <div class="col-12 text-center">
              <button type="submit" form="mailTemplateForm" class="btn btn-success">
                <?php echo e(__('Update')); ?>

              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\younes\Downloads\junspro-main (1)\junspro-main3\resources\views\backend\basic-settings\email\edit-template.blade.php ENDPATH**/ ?>