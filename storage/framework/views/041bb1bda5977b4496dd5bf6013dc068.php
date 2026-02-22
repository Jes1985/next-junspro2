<?php $__env->startSection('content'); ?>
  <div class="page-header">
    <h4 class="page-title"><?php echo e(__('Section Customization')); ?></h4>
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
        <a href="#"><?php echo e(__('Section Customization')); ?></a>
      </li>
    </ul>
  </div>

  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <form action="<?php echo e(route('admin.home_page.update_section_status')); ?>" method="POST">
          <?php echo csrf_field(); ?>
          <div class="card-header">
            <div class="card-title d-inline-block"><?php echo e(__('Home Page Sections')); ?></div>
          </div>

          <div class="card-body">
            <div class="row">
              <div class="col-lg-6 offset-lg-3">
                <?php if($settings->theme_version == 1): ?>
                  <div class="form-group">
                    <label><?php echo e(__('Service Category Section Status')); ?></label>
                    <div class="selectgroup w-100">
                      <label class="selectgroup-item">
                        <input type="radio" name="service_category_section_status" value="1"
                          class="selectgroup-input"
                          <?php echo e($sectionInfo->service_category_section_status == 1 ? 'checked' : ''); ?>>
                        <span class="selectgroup-button"><?php echo e(__('Enable')); ?></span>
                      </label>

                      <label class="selectgroup-item">
                        <input type="radio" name="service_category_section_status" value="0"
                          class="selectgroup-input"
                          <?php echo e($sectionInfo->service_category_section_status == 0 ? 'checked' : ''); ?>>
                        <span class="selectgroup-button"><?php echo e(__('Disable')); ?></span>
                      </label>
                    </div>
                  </div>
                <?php endif; ?>
                <div class="form-group">
                  <label><?php echo e(__('About Section Status')); ?></label>
                  <div class="selectgroup w-100">
                    <label class="selectgroup-item">
                      <input type="radio" name="about_section_status" value="1" class="selectgroup-input"
                        <?php echo e($sectionInfo->about_section_status == 1 ? 'checked' : ''); ?>>
                      <span class="selectgroup-button"><?php echo e(__('Enable')); ?></span>
                    </label>

                    <label class="selectgroup-item">
                      <input type="radio" name="about_section_status" value="0" class="selectgroup-input"
                        <?php echo e($sectionInfo->about_section_status == 0 ? 'checked' : ''); ?>>
                      <span class="selectgroup-button"><?php echo e(__('Disable')); ?></span>
                    </label>
                  </div>
                </div>


                <div class="form-group">
                  <label><?php echo e(__('Features Section Status')); ?></label>
                  <div class="selectgroup w-100">
                    <label class="selectgroup-item">
                      <input type="radio" name="features_section_status" value="1" class="selectgroup-input"
                        <?php echo e($sectionInfo->features_section_status == 1 ? 'checked' : ''); ?>>
                      <span class="selectgroup-button"><?php echo e(__('Enable')); ?></span>
                    </label>

                    <label class="selectgroup-item">
                      <input type="radio" name="features_section_status" value="0" class="selectgroup-input"
                        <?php echo e($sectionInfo->features_section_status == 0 ? 'checked' : ''); ?>>
                      <span class="selectgroup-button"><?php echo e(__('Disable')); ?></span>
                    </label>
                  </div>
                </div>

                <div class="form-group">
                  <label><?php echo e(__('Featured Services Section Status')); ?></label>
                  <div class="selectgroup w-100">
                    <label class="selectgroup-item">
                      <input type="radio" name="featured_services_section_status" value="1"
                        class="selectgroup-input"
                        <?php echo e($sectionInfo->featured_services_section_status == 1 ? 'checked' : ''); ?>>
                      <span class="selectgroup-button"><?php echo e(__('Enable')); ?></span>
                    </label>

                    <label class="selectgroup-item">
                      <input type="radio" name="featured_services_section_status" value="0"
                        class="selectgroup-input"
                        <?php echo e($sectionInfo->featured_services_section_status == 0 ? 'checked' : ''); ?>>
                      <span class="selectgroup-button"><?php echo e(__('Disable')); ?></span>
                    </label>
                  </div>
                </div>

                <div class="form-group">
                  <label><?php echo e(__('Testimonials Section Status')); ?></label>
                  <div class="selectgroup w-100">
                    <label class="selectgroup-item">
                      <input type="radio" name="testimonials_section_status" value="1" class="selectgroup-input"
                        <?php echo e($sectionInfo->testimonials_section_status == 1 ? 'checked' : ''); ?>>
                      <span class="selectgroup-button"><?php echo e(__('Enable')); ?></span>
                    </label>

                    <label class="selectgroup-item">
                      <input type="radio" name="testimonials_section_status" value="0" class="selectgroup-input"
                        <?php echo e($sectionInfo->testimonials_section_status == 0 ? 'checked' : ''); ?>>
                      <span class="selectgroup-button"><?php echo e(__('Disable')); ?></span>
                    </label>
                  </div>
                </div>

                <div class="form-group">
                  <label><?php echo e(__('Blog Section Status')); ?></label>
                  <div class="selectgroup w-100">
                    <label class="selectgroup-item">
                      <input type="radio" name="blog_section_status" value="1" class="selectgroup-input"
                        <?php echo e($sectionInfo->blog_section_status == 1 ? 'checked' : ''); ?>>
                      <span class="selectgroup-button"><?php echo e(__('Enable')); ?></span>
                    </label>

                    <label class="selectgroup-item">
                      <input type="radio" name="blog_section_status" value="0" class="selectgroup-input"
                        <?php echo e($sectionInfo->blog_section_status == 0 ? 'checked' : ''); ?>>
                      <span class="selectgroup-button"><?php echo e(__('Disable')); ?></span>
                    </label>
                  </div>
                </div>

                <div class="form-group">
                  <label><?php echo e(__('Partners Section Status')); ?></label>
                  <div class="selectgroup w-100">
                    <label class="selectgroup-item">
                      <input type="radio" name="partners_section_status" value="1" class="selectgroup-input"
                        <?php echo e($sectionInfo->partners_section_status == 1 ? 'checked' : ''); ?>>
                      <span class="selectgroup-button"><?php echo e(__('Enable')); ?></span>
                    </label>

                    <label class="selectgroup-item">
                      <input type="radio" name="partners_section_status" value="0" class="selectgroup-input"
                        <?php echo e($sectionInfo->partners_section_status == 0 ? 'checked' : ''); ?>>
                      <span class="selectgroup-button"><?php echo e(__('Disable')); ?></span>
                    </label>
                  </div>
                </div>

                <?php if($settings->theme_version != 1): ?>
                  <div class="form-group">
                    <label><?php echo e(__('Newsletter Section Status')); ?></label>
                    <div class="selectgroup w-100">
                      <label class="selectgroup-item">
                        <input type="radio" name="newsletter_section_status" value="1"
                          class="selectgroup-input" <?php echo e($sectionInfo->newsletter_section_status == 1 ? 'checked' : ''); ?>>
                        <span class="selectgroup-button"><?php echo e(__('Enable')); ?></span>
                      </label>

                      <label class="selectgroup-item">
                        <input type="radio" name="newsletter_section_status" value="0"
                          class="selectgroup-input" <?php echo e($sectionInfo->newsletter_section_status == 0 ? 'checked' : ''); ?>>
                        <span class="selectgroup-button"><?php echo e(__('Disable')); ?></span>
                      </label>
                    </div>
                  </div>
                <?php endif; ?>

                <div class="form-group">
                  <label><?php echo e(__('Call to action Section Status')); ?></label>
                  <div class="selectgroup w-100">
                    <label class="selectgroup-item">
                      <input type="radio" name="cta_section_status" value="1" class="selectgroup-input"
                        <?php echo e($sectionInfo->cta_section_status == 1 ? 'checked' : ''); ?>>
                      <span class="selectgroup-button"><?php echo e(__('Enable')); ?></span>
                    </label>

                    <label class="selectgroup-item">
                      <input type="radio" name="cta_section_status" value="0" class="selectgroup-input"
                        <?php echo e($sectionInfo->cta_section_status == 0 ? 'checked' : ''); ?>>
                      <span class="selectgroup-button"><?php echo e(__('Disable')); ?></span>
                    </label>
                  </div>
                </div>

                <div class="form-group">
                  <label><?php echo e(__('Footer Section Status')); ?></label>
                  <div class="selectgroup w-100">
                    <label class="selectgroup-item">
                      <input type="radio" name="footer_section_status" value="1" class="selectgroup-input"
                        <?php echo e($sectionInfo->footer_section_status == 1 ? 'checked' : ''); ?>>
                      <span class="selectgroup-button"><?php echo e(__('Enable')); ?></span>
                    </label>

                    <label class="selectgroup-item">
                      <input type="radio" name="footer_section_status" value="0" class="selectgroup-input"
                        <?php echo e($sectionInfo->footer_section_status == 0 ? 'checked' : ''); ?>>
                      <span class="selectgroup-button"><?php echo e(__('Disable')); ?></span>
                    </label>
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

<?php echo $__env->make('backend.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\younes\Downloads\junspro-main (1)\junspro-main3\resources\views\backend\home-page\section-customization.blade.php ENDPATH**/ ?>