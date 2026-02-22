<?php if ($__env->exists('backend.partials.rtl-style')) echo $__env->make('backend.partials.rtl-style', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<?php $__env->startSection('content'); ?>
  <div class="page-header">
    <h4 class="page-title"><?php echo e(__('About Section')); ?></h4>
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
        <a href="#"><?php echo e(__('Home Page')); ?></a>
      </li>
      <li class="separator">
        <i class="flaticon-right-arrow"></i>
      </li>
      <li class="nav-item">
        <a href="#"><?php echo e(__('About Section')); ?></a>
      </li>
    </ul>
  </div>

  <div class="row">
    <div class="col-md-6">
      <div class="card">
        <div class="card-header">
          <div class="row">
            <div class="col">
              <div class="card-title"><?php echo e(__('Section Image')); ?></div>
            </div>
          </div>
        </div>

        <div class="card-body">
          <div class="row">
            <div class="col-lg-8 offset-lg-2">
              <form id="aboutImgForm" action="<?php echo e(route('admin.home_page.update_about_img')); ?>" method="POST"
                enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <div class="form-group">
                  <label for=""><?php echo e(__('Background Image') . '*'); ?></label>
                  <br>
                  <div class="thumb-preview">
                    <?php if(empty($info->about_section_image)): ?>
                      <img src="<?php echo e(asset('assets/img/noimage.jpg')); ?>" alt="..." class="uploaded-img">
                    <?php else: ?>
                      <img src="<?php echo e(asset('assets/img/' . $info->about_section_image)); ?>" alt="image"
                        class="uploaded-img">
                    <?php endif; ?>
                  </div>

                  <div class="mt-3">
                    <div role="button" class="btn btn-primary btn-sm upload-btn">
                      <?php echo e(__('Choose Image')); ?>

                      <input type="file" class="img-input" name="about_section_image">
                    </div>
                  </div>
                  <?php $__errorArgs = ['about_section_image'];
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


                <div class="form-group">
                  <label for=""><?php echo e(__('Video Link')); ?></label>
                  <input type="url" class="form-control ltr" name="about_section_video_link"
                    value="<?php echo e(empty($info->about_section_video_link) ? '' : $info->about_section_video_link); ?>"
                    placeholder="Enter Video Link">
                </div>
              </form>
            </div>
          </div>
        </div>

        <div class="card-footer">
          <div class="row">
            <div class="col-12 text-center">
              <button type="submit" form="aboutImgForm" class="btn btn-success">
                <?php echo e(__('Update')); ?>

              </button>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-md-6">
      <div class="card">
        <div class="card-header">
          <div class="row">
            <div class="col-lg-9">
              <div class="card-title"><?php echo e(__('About Section Information')); ?></div>
            </div>

            <div class="col-lg-3">
              <?php if ($__env->exists('backend.partials.languages')) echo $__env->make('backend.partials.languages', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
            </div>
          </div>
        </div>

        <div class="card-body">
          <div class="row justify-content-center">
            <div class="col-lg-12">
              <form id="aboutForm"
                action="<?php echo e(route('admin.home_page.update_about_info', ['language' => request()->input('language')])); ?>"
                method="POST">
                <?php echo csrf_field(); ?>
                <div class="form-group">
                  <label for=""><?php echo e(__('Title')); ?></label>
                  <input type="text" class="form-control" name="title"
                    value="<?php echo e(empty($data) ? '' : $data->title); ?>" placeholder="Enter Title">
                </div>

                <div class="form-group">
                  <label for=""><?php echo e(__('Text')); ?></label>
                  <textarea class="form-control summernote" name="text" placeholder="Enter Text" data-height="300"><?php echo e(empty($data) ? '' : $data->text); ?></textarea>
                </div>

                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for=""><?php echo e(__('Button Name')); ?></label>
                      <input type="text" class="form-control" name="button_name" placeholder="Enter Button Name"
                        value="<?php echo e(empty($data) ? '' : $data->button_name); ?>">
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group">
                      <label for=""><?php echo e(__('Button URL')); ?></label>
                      <input type="url" class="form-control ltr" name="button_url" placeholder="Enter Button URL"
                        value="<?php echo e(empty($data) ? '' : $data->button_url); ?>">
                    </div>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>

        <div class="card-footer">
          <div class="row">
            <div class="col-12 text-center">
              <button type="submit" form="aboutForm" class="btn btn-success">
                <?php echo e(__('Update')); ?>

              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\younes\Downloads\junspro-main (1)\junspro-main3\resources\views\backend\home-page\about-section.blade.php ENDPATH**/ ?>