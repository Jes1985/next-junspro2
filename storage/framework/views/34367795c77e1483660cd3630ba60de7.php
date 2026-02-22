<?php $__env->startSection('content'); ?>
  <div class="page-header">
    <h4 class="page-title"><?php echo e(__('Add Service')); ?></h4>
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
        <a href="#"><?php echo e(__('Service Management')); ?></a>
      </li>
      <li class="separator">
        <i class="flaticon-right-arrow"></i>
      </li>
      <li class="nav-item">
        <a
          href="<?php echo e(route('admin.service_management.services', ['language' => $defaultLang->code])); ?>"><?php echo e(__('Services')); ?></a>
      </li>
      <li class="separator">
        <i class="flaticon-right-arrow"></i>
      </li>
      <li class="nav-item">
        <a href="#"><?php echo e(__('Add Service')); ?></a>
      </li>
    </ul>
  </div>

  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <div class="card-title d-inline-block"><?php echo e(__('Add Service')); ?></div>
          <a class="btn btn-info btn-sm float-right d-inline-block"
            href="<?php echo e(route('admin.service_management.services', ['language' => $defaultLang->code])); ?>">
            <span class="btn-label">
              <i class="fas fa-backward mdb_12"></i>
            </span>
            <?php echo e(__('Back')); ?>

          </a>
        </div>

        <div class="card-body">
          <div class="row">
            <div class="col-lg-8 offset-lg-2">
              <div class="alert alert-danger pb-1 mdb_display_none" id="serviceErrors">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <ul></ul>
              </div>

              <div class="mdb_353">
                <label for=""><strong><?php echo e(__('Slider Images') . '*'); ?></strong></label>
                <form id="slider-dropzone" enctype="multipart/form-data" class="dropzone mt-2 mb-0">
                  <?php echo csrf_field(); ?>
                  <div class="fallback"></div>
                </form>
                <p class="text-warning mt-3 mb-0">
                  <?php echo e('*' . __('Upload 860x610 pixel size image for best quality.')); ?></p>
                <p class="em text-danger mt-3 mb-0" id="err_slider_image"></p>
              </div>

              <form id="serviceForm" action="<?php echo e(route('admin.service_management.store_service')); ?>"
                enctype="multipart/form-data" method="POST">
                <?php echo csrf_field(); ?>
                <div id="slider-image-id"></div>

                <div class="form-group">
                  <label for=""><?php echo e(__('Thumbnail Image') . '*'); ?></label>
                  <br>
                  <div class="thumb-preview">
                    <img src="<?php echo e(asset('assets/img/noimage.jpg')); ?>" alt="..." class="uploaded-img">
                  </div>

                  <div class="mt-3">
                    <div role="button" class="btn btn-primary btn-sm upload-btn">
                      <?php echo e(__('Choose Image')); ?>

                      <input type="file" class="img-input" name="thumbnail_image">
                    </div>
                  </div>
                  <p class="text-warning"><?php echo e(__('Image size : 330 x 255 px')); ?></p>
                </div>

                <div class="row">
                  <div class="col-lg-6">
                    <div class="form-group">
                      <label><?php echo e(__('Video Preview Link')); ?></label>
                      <input type="url" class="form-control" name="video_preview_link"
                        placeholder="Enter Video Preview Link">
                    </div>
                  </div>

                  <div class="col-lg-6">
                    <div class="form-group">
                      <label><?php echo e(__('Live Demo Link')); ?></label>
                      <input type="url" class="form-control" name="live_demo_link" placeholder="Enter Live Demo Link">
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-lg-6">
                    <div class="form-group">
                      <label><?php echo e(__('Quote Button Status') . '*'); ?></label>
                      <div class="selectgroup w-100">
                        <label class="selectgroup-item">
                          <input type="radio" name="quote_btn_status" value="1" class="selectgroup-input" checked>
                          <span class="selectgroup-button"><?php echo e(__('Active')); ?></span>
                        </label>
                        <label class="selectgroup-item">
                          <input type="radio" name="quote_btn_status" value="0" class="selectgroup-input">
                          <span class="selectgroup-button"><?php echo e(__('Deactive')); ?></span>
                        </label>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="form-group">
                      <label><?php echo e(__('Service Status') . '*'); ?></label>
                      <div class="selectgroup w-100">
                        <label class="selectgroup-item">
                          <input type="radio" name="service_status" value="1" class="selectgroup-input" checked>
                          <span class="selectgroup-button"><?php echo e(__('Active')); ?></span>
                        </label>
                        <label class="selectgroup-item">
                          <input type="radio" name="service_status" value="0" class="selectgroup-input">
                          <span class="selectgroup-button"><?php echo e(__('Deactive')); ?></span>
                        </label>
                      </div>
                    </div>
                  </div>

                  <div class="col-lg-6">
                    <div class="form-group">
                      <label><?php echo e(__('Seller')); ?></label>
                      <select name="seller_id" id="seller_id_service" class="select2">
                        <option value="0"><?php echo e(__('Select Seller')); ?></option>
                        <?php $__currentLoopData = $sellers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $seller): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                          <option value="<?php echo e($seller->id); ?>"><?php echo e($seller->username); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                      </select>
                      <p class="text-warning"><?php echo e(__("leave it blank for admin's service")); ?></p>
                    </div>
                  </div>
                </div>

                <div id="accordion" class="mt-3">
                  <?php $__currentLoopData = $languages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="version">
                      <div class="version-header" id="heading<?php echo e($language->id); ?>">
                        <h5 class="mb-0">
                          <button type="button"
                            class="btn btn-link <?php echo e($language->direction == 1 ? 'rtl text-right' : ''); ?>"
                            data-toggle="collapse" data-target="#collapse<?php echo e($language->id); ?>"
                            aria-expanded="<?php echo e($language->is_default == 1 ? 'true' : 'false'); ?>"
                            aria-controls="collapse<?php echo e($language->id); ?>">
                            <?php echo e($language->name . __(' Language')); ?>

                            <?php echo e($language->is_default == 1 ? '(Default)' : ''); ?>

                          </button>
                        </h5>
                      </div>

                      <div id="collapse<?php echo e($language->id); ?>"
                        class="collapse <?php echo e($language->is_default == 1 ? 'show' : ''); ?>"
                        aria-labelledby="heading<?php echo e($language->id); ?>" data-parent="#accordion">
                        <div class="version-body">
                          <div class="row">
                            <div class="col-lg-6">
                              <div class="form-group <?php echo e($language->direction == 1 ? 'rtl text-right' : ''); ?>">
                                <label><?php echo e(__('Title') . '*'); ?></label>
                                <input type="text" class="form-control" name="<?php echo e($language->code); ?>_title"
                                  placeholder="Enter Service Title">
                              </div>
                            </div>
                            <div class="col-lg-6">
                              <div class="form-group">
                                <?php
                                  $skills = App\Models\Skill::where([['language_id', $language->id], ['status', 1]])->get();
                                ?>
                                <label><?php echo e(__('Skills')); ?></label>
                                <select name="<?php echo e($language->code); ?>_skills[]" multiple id="" class="select2">
                                  <?php $__currentLoopData = $skills; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $skill): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($skill->id); ?>"><?php echo e($skill->name); ?></option>
                                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                              </div>
                            </div>
                          </div>


                          <div class="row">
                            <div class="col-lg-6">
                              <div class="form-group <?php echo e($language->direction == 1 ? 'rtl text-right' : ''); ?>">
                                <?php $categories = $language->categories; ?>

                                <label><?php echo e(__('Category') . '*'); ?></label>
                                <select name="<?php echo e($language->code); ?>_category_id" class="form-control service-category"
                                  data-lang_code="<?php echo e($language->code); ?>">
                                  <option selected disabled><?php echo e(__('Select a Category')); ?>

                                  </option>

                                  <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($category->id); ?>">
                                      <?php echo e($category->name); ?></option>
                                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                              </div>
                            </div>

                            <div class="col-lg-6">
                              <div class="form-group <?php echo e($language->direction == 1 ? 'rtl text-right' : ''); ?>">
                                <label><?php echo e(__('Subcategory') . '*'); ?></label>
                                <select name="<?php echo e($language->code); ?>_subcategory_id" class="form-control" disabled>
                                  <option selected disabled>
                                    <?php echo e(__('Select a Subcategory')); ?></option>
                                </select>
                              </div>
                            </div>
                          </div>

                          <div class="row">
                            <div class="col-lg-12">
                              <div class="form-group <?php echo e($language->direction == 1 ? 'rtl text-right' : ''); ?>">
                                <label><?php echo e(__('Description') . '*'); ?></label>
                                <textarea id="descriptionTmce<?php echo e($language->id); ?>" class="form-control summernote"
                                  name="<?php echo e($language->code); ?>_description" placeholder="Enter Service Description" data-height="300"></textarea>
                              </div>
                            </div>
                          </div>

                          <div class="row">
                            <div class="col-lg-6">
                              <div class="form-group <?php echo e($language->direction == 1 ? 'rtl text-right' : ''); ?>">
                                <label><?php echo e(__('Tags')); ?></label>
                                <input class="form-control" name="<?php echo e($language->code); ?>_tags" placeholder="Enter Tags"
                                  data-role="tagsinput">
                              </div>
                            </div>

                            <div class="col-lg-6">
                              <div class="form-group <?php echo e($language->direction == 1 ? 'rtl text-right' : ''); ?>">
                                <?php
                                  $forms = App\Models\ClientService\Form::where([['seller_id', null], ['language_id', $language->id]])->get();
                                ?>

                                <label><?php echo e(__('Form') . '*'); ?></label>
                                <select name="<?php echo e($language->code); ?>_form_id" class="form-control seller_form"
                                  data-lang_id="<?php echo e($language->id); ?>" id="seller_form<?php echo e($language->id); ?>">
                                  <option selected disabled><?php echo e(__('Select a Form')); ?>

                                  </option>

                                  <?php $__currentLoopData = $forms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $form): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($form->id); ?>">
                                      <?php echo e($form->name); ?></option>
                                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>

                                <p class="mt-2 mb-0 text-warning">
                                  <?php echo e('*' . __('The selected form will be used during the purchase of this service.')); ?>

                                </p>
                              </div>
                            </div>
                          </div>

                          <div class="row">
                            <div class="col-lg-12">
                              <div class="form-group <?php echo e($language->direction == 1 ? 'rtl text-right' : ''); ?>">
                                <label><?php echo e(__('Meta Keywords')); ?></label>
                                <input class="form-control" name="<?php echo e($language->code); ?>_meta_keywords"
                                  placeholder="Enter Meta Keywords" data-role="tagsinput">
                              </div>
                            </div>
                          </div>

                          <div class="row">
                            <div class="col-lg-12">
                              <div class="form-group <?php echo e($language->direction == 1 ? 'rtl text-right' : ''); ?>">
                                <label><?php echo e(__('Meta Description')); ?></label>
                                <textarea class="form-control" name="<?php echo e($language->code); ?>_meta_description" rows="5"
                                  placeholder="Enter Meta Description"></textarea>
                              </div>
                            </div>
                          </div>

                          <div class="row">
                            <div class="col-lg-12">
                              <?php $currLang = $language; ?>

                              <?php $__currentLoopData = $languages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($language->id == $currLang->id) continue; ?>

                                <div class="form-check py-0">
                                  <label class="form-check-label">
                                    <input class="form-check-input" type="checkbox"
                                      onchange="cloneInput('collapse<?php echo e($currLang->id); ?>', 'collapse<?php echo e($language->id); ?>', event)">
                                    <span class="form-check-sign"><?php echo e(__('Clone for')); ?>

                                      <strong class="text-capitalize text-secondary"><?php echo e($language->name); ?></strong>
                                      <?php echo e(__('language')); ?></span>
                                  </label>
                                </div>
                              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
              </form>
            </div>
          </div>
        </div>

        <div class="card-footer">
          <div class="row">
            <div class="col-12 text-center">
              <button type="submit" form="serviceForm" class="btn btn-success">
                <?php echo e(__('Save')); ?>

              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
  <script>
    const imgUpUrl = "<?php echo e(route('admin.service_management.upload_slider_image')); ?>";
    const imgRmvUrl = "<?php echo e(route('admin.service_management.remove_slider_image')); ?>";
    var form_get_url = "<?php echo e(route('admin.service_management.get-form-by-vendor')); ?>";
  </script>

  <script type="text/javascript" src="<?php echo e(asset('assets/js/slider-image.js')); ?>"></script>
  <script type="text/javascript" src="<?php echo e(asset('assets/js/admin-partial.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\younes\Downloads\junspro-main (1)\junspro-main3\resources\views\backend\client-service\service\create.blade.php ENDPATH**/ ?>