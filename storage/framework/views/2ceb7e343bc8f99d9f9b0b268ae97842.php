<?php if ($__env->exists('backend.partials.rtl-style')) echo $__env->make('backend.partials.rtl-style', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<?php $__env->startSection('content'); ?>
  <div class="page-header">
    <h4 class="page-title"><?php echo e(__('Section Titles')); ?></h4>
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
        <a href="#"><?php echo e(__('Section Titles')); ?></a>
      </li>
    </ul>
  </div>

  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <form action="<?php echo e(route('admin.home_page.update_section_titles', ['language' => request()->input('language')])); ?>"
          method="post">
          <?php echo csrf_field(); ?>
          <div class="card-header">
            <div class="row">
              <div class="col-lg-10">
                <div class="card-title"><?php echo e(__('Section Titles')); ?></div>
              </div>

              <div class="col-lg-2">
                <?php if ($__env->exists('backend.partials.languages')) echo $__env->make('backend.partials.languages', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
              </div>
            </div>
          </div>

          <div class="card-body">
            <div class="row">
              <div class="col-lg-6 offset-lg-3">
                <div class="form-group">
                  <label><?php echo e(__('Category Section Title')); ?></label>
                  <input class="form-control" name="category_section_title"
                    value="<?php echo e(!is_null($data) ? $data->category_section_title : ''); ?>"
                    placeholder="Enter Category Section Title">
                </div>

                <div class="form-group">
                  <label><?php echo e(__('Featured Services Section Title')); ?></label>
                  <input class="form-control" name="featured_services_section_title"
                    value="<?php echo e(!is_null($data) ? $data->featured_services_section_title : ''); ?>"
                    placeholder="Enter Featured Services Section Title">
                </div>

                <div class="form-group">
                  <label><?php echo e(__('Testimonials Section Title')); ?></label>
                  <input class="form-control" name="testimonials_section_title"
                    value="<?php echo e(!is_null($data) ? $data->testimonials_section_title : ''); ?>"
                    placeholder="Enter Testimonials Section Title">
                </div>

                <div class="form-group">
                  <label><?php echo e(__('Blog Section Title')); ?></label>
                  <input class="form-control" name="blog_section_title"
                    value="<?php echo e(!is_null($data) ? $data->blog_section_title : ''); ?>"
                    placeholder="Enter Blog Section Title">
                </div>

                <?php if($settings->theme_version == 2): ?>
                  <div class="form-group">
                    <label><?php echo e(__('Featured Products Section Title')); ?></label>
                    <input class="form-control" name="featured_products_section_title"
                      value="<?php echo e(!is_null($data) ? $data->featured_products_section_title : ''); ?>"
                      placeholder="Enter Featured Products Section Title">
                  </div>
                <?php endif; ?>
                <?php if($settings->theme_version == 2 || $settings->theme_version == 3): ?>
                  <div class="form-group">
                    <label><?php echo e(__('Newsletter Section Title')); ?></label>
                    <input class="form-control" name="newsletter_section_title"
                      value="<?php echo e(!is_null($data) ? $data->newsletter_section_title : ''); ?>"
                      placeholder="Enter Newsletter Section Title">
                  </div>
                <?php endif; ?>
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

<?php echo $__env->make('backend.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\younes\Downloads\junspro-main (1)\junspro-main3\resources\views\backend\home-page\section-titles.blade.php ENDPATH**/ ?>