<?php $__env->startSection('content'); ?>
  <div class="page-header">
    <h4 class="page-title"><?php echo e(__('Edit Service')); ?></h4>
    <ul class="breadcrumbs">
      <li class="nav-home">
        <a href="<?php echo e(route('seller.dashboard')); ?>">
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
          href="<?php echo e(route('seller.service_management.services', ['language' => $defaultLang->code])); ?>"><?php echo e(__('Manage Services')); ?></a>
      </li>
      <li class="separator">
        <i class="flaticon-right-arrow"></i>
      </li>
      <li class="nav-item">
        <a href="#"><?php echo e(__('Edit Service')); ?></a>
      </li>
    </ul>
  </div>

  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <div class="card-title d-inline-block"><?php echo e(__('Edit Service')); ?></div>
          <a class="btn btn-info btn-sm float-right d-inline-block"
            href="<?php echo e(route('seller.service_management.services', ['language' => $defaultLang->code])); ?>">
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

              <div class="mdb_10">
                <label for=""><strong><?php echo e(__('Slider Images') . '*'); ?></strong></label>

                <?php $sliderImages = json_decode($service->slider_images); ?>

                <?php if(count($sliderImages) > 0): ?>
                  <div id="reload-slider-div">
                    <div class="row mt-2">
                      <div class="col">
                        <table class="table" id="img-table">
                          <?php $__currentLoopData = $sliderImages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $sliderImage): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr class="table-row" id="<?php echo e('slider-image-' . $key); ?>">
                              <td>
                                <img class="thumb-preview mdb_3523"
                                  src="<?php echo e(asset('assets/img/services/slider-images/' . $sliderImage)); ?>"
                                  alt="slider image">
                              </td>
                              <td>
                                <i class="fa fa-times-circle"
                                  onclick="rmvStoredImg(<?php echo e($service->id); ?>, <?php echo e($key); ?>)"></i>
                              </td>
                            </tr>
                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </table>
                      </div>
                    </div>
                  </div>
                <?php endif; ?>

                <form id="slider-dropzone" enctype="multipart/form-data" class="dropzone mt-2 mb-0">
                  <?php echo csrf_field(); ?>
                  <div class="fallback"></div>
                </form>
                <p class="em text-warning mt-3 mb-0">
                  <?php echo e('*' . __('Upload 860x610 pixel size image for best quality.')); ?></p>
                <p class="em text-danger mt-3 mb-0" id="err_slider_image"></p>
              </div>

              <form id="serviceForm"
                action="<?php echo e(route('seller.service_management.update_service', ['id' => $service->id])); ?>"
                enctype="multipart/form-data" method="POST">
                <?php echo csrf_field(); ?>
                <div id="slider-image-id"></div>

                <div class="form-group">
                  <label for=""><?php echo e(__('Thumbnail Image') . '*'); ?></label>
                  <br>
                  <div class="thumb-preview">
                    <img src="<?php echo e(asset('assets/img/services/thumbnail-images/' . $service->thumbnail_image)); ?>"
                      alt="image" class="uploaded-img">
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
                        placeholder="Enter Video Preview Link" value="<?php echo e($service->video_preview_link); ?>">
                    </div>
                  </div>

                  <div class="col-lg-6">
                    <div class="form-group">
                      <label><?php echo e(__('Live Demo Link')); ?></label>
                      <input type="url" class="form-control" name="live_demo_link" placeholder="Enter Live Demo Link"
                        value="<?php echo e($service->live_demo_link); ?>">
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-lg-6">
                    <div class="form-group">
                      <label><?php echo e(__('Quote Button Status') . '*'); ?></label>
                      <div class="selectgroup w-100">
                        <label class="selectgroup-item">
                          <input type="radio" name="quote_btn_status" value="1" class="selectgroup-input"
                            <?php echo e($service->quote_btn_status == 1 ? 'checked' : ''); ?>>
                          <span class="selectgroup-button"><?php echo e(__('Active')); ?></span>
                        </label>
                        <label class="selectgroup-item">
                          <input type="radio" name="quote_btn_status" value="0" class="selectgroup-input"
                            <?php echo e($service->quote_btn_status == 0 ? 'checked' : ''); ?>>
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
                          <input type="radio" name="service_status" value="1" class="selectgroup-input"
                            <?php echo e($service->service_status == 1 ? 'checked' : ''); ?>>
                          <span class="selectgroup-button"><?php echo e(__('Active')); ?></span>
                        </label>
                        <label class="selectgroup-item">
                          <input type="radio" name="service_status" value="0" class="selectgroup-input"
                            <?php echo e($service->service_status == 0 ? 'checked' : ''); ?>>
                          <span class="selectgroup-button"><?php echo e(__('Deactive')); ?></span>
                        </label>
                      </div>
                    </div>
                  </div>
                </div>

                <div id="accordion" class="mt-3">
                  <?php $__currentLoopData = $languages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php $serviceData = $language->serviceData; ?>

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
                                  placeholder="Enter Service Title"
                                  value="<?php echo e(is_null($serviceData) ? '' : $serviceData->title); ?>">
                              </div>
                            </div>
                            <div class="col-lg-6">
                              <div class="form-group <?php echo e($language->direction == 1 ? 'rtl text-right' : ''); ?>">
                                <?php
                                  $skills = App\Models\Skill::where([['language_id', $language->id], ['status', 1]])->get();
                                  if (!empty($serviceData)) {
                                      if (!is_null($serviceData->skills)) {
                                          $selected_skills = json_decode($serviceData->skills);
                                      } else {
                                          $selected_skills = [];
                                      }
                                  } else {
                                      $selected_skills = [];
                                  }
                                  if (is_null($selected_skills)) {
                                      $selected_skills = [];
                                  }
                                ?>
                                <label><?php echo e(__('Skills')); ?></label>
                                <select name="<?php echo e($language->code); ?>_skills[]" class="select2" multiple>
                                  <?php if(is_null($skills)): ?>
                                    <option selected disabled>
                                      <?php echo e(__('Select Skills')); ?></option>
                                  <?php else: ?>
                                    <option disabled><?php echo e(__('Select Skills')); ?>

                                    </option>

                                    <?php $__currentLoopData = $skills; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $skill): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                      <option value="<?php echo e($skill->id); ?>" <?php if(in_array($skill->id, $selected_skills)): echo 'selected'; endif; ?>>
                                        <?php echo e($skill->name); ?>

                                      </option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                  <?php endif; ?>
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
                                  <?php if(is_null($categories)): ?>
                                    <option selected disabled>
                                      <?php echo e(__('Select a Category')); ?></option>
                                  <?php else: ?>
                                    <option disabled><?php echo e(__('Select a Category')); ?>

                                    </option>

                                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                      <option value="<?php echo e($category->id); ?>"
                                        <?php echo e(!empty($serviceData) && $serviceData->service_category_id == $category->id ? 'selected' : ''); ?>>
                                        <?php echo e($category->name); ?>

                                      </option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                  <?php endif; ?>
                                </select>
                              </div>
                            </div>

                            <div class="col-lg-6">
                              <div class="form-group <?php echo e($language->direction == 1 ? 'rtl text-right' : ''); ?>">
                                <?php
                                  if (!is_null($serviceData)) {
                                      $categoryId = $serviceData->service_category_id;
                                      $category = \App\Models\ClientService\ServiceCategory::query()->find($categoryId);
                                      $subcategories = $category
                                          ->subcategory()
                                          ->where('status', 1)
                                          ->orderByDesc('id')
                                          ->get();
                                  }
                                ?>

                                <label><?php echo e(__('Subcategory') . '*'); ?></label>
                                <select name="<?php echo e($language->code); ?>_subcategory_id" class="form-control">
                                  <?php if(is_null($subcategories)): ?>
                                    <option selected disabled>
                                      <?php echo e(__('Select a Subcategory')); ?></option>
                                  <?php else: ?>
                                    <option disabled><?php echo e(__('Select a Subcategory')); ?>

                                    </option>

                                    <?php $__currentLoopData = $subcategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subcategory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                      <option value="<?php echo e($subcategory->id); ?>"
                                        <?php echo e(!empty($serviceData) && $serviceData->service_subcategory_id == $subcategory->id ? 'selected' : ''); ?>>
                                        <?php echo e($subcategory->name); ?>

                                      </option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                  <?php endif; ?>
                                </select>
                              </div>
                            </div>
                          </div>

                          <div class="row">
                            <div class="col-lg-12">
                              <div class="form-group <?php echo e($language->direction == 1 ? 'rtl text-right' : ''); ?>">
                                <label><?php echo e(__('Description') . '*'); ?></label>
                                <textarea class="form-control summernote" name="<?php echo e($language->code); ?>_description"
                                  placeholder="Enter Service Description" data-height="300"><?php echo e(is_null($serviceData) ? '' : replaceBaseUrl($serviceData->description, 'summernote')); ?></textarea>
                              </div>
                            </div>
                          </div>

                          <div class="row">
                            <div class="col-lg-6">
                              <div class="form-group <?php echo e($language->direction == 1 ? 'rtl text-right' : ''); ?>">
                                <label><?php echo e(__('Tags')); ?></label>
                                <input class="form-control" name="<?php echo e($language->code); ?>_tags" placeholder="Enter Tags"
                                  data-role="tagsinput" value="<?php echo e(is_null($serviceData) ? '' : $serviceData->tags); ?>">
                              </div>
                            </div>

                            <div class="col-lg-6">
                              <div class="form-group <?php echo e($language->direction == 1 ? 'rtl text-right' : ''); ?>">
                                <?php $forms = $language->forms; ?>

                                <label><?php echo e(__('Form') . '*'); ?></label>
                                <select name="<?php echo e($language->code); ?>_form_id" class="form-control">
                                  <?php if(is_null($forms)): ?>
                                    <option selected disabled><?php echo e(__('Select a Form')); ?>

                                    </option>
                                  <?php else: ?>
                                    <option disabled><?php echo e(__('Select a Form')); ?></option>

                                    <?php $__currentLoopData = $forms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $form): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                      <option value="<?php echo e($form->id); ?>"
                                        <?php echo e(!empty($serviceData) && $serviceData->form_id == $form->id ? 'selected' : ''); ?>>
                                        <?php echo e($form->name); ?>

                                      </option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                  <?php endif; ?>
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
                                  placeholder="Enter Meta Keywords" data-role="tagsinput"
                                  value="<?php echo e(is_null($serviceData) ? '' : $serviceData->meta_keywords); ?>">
                              </div>
                            </div>
                          </div>

                          <div class="row">
                            <div class="col-lg-12">
                              <div class="form-group <?php echo e($language->direction == 1 ? 'rtl text-right' : ''); ?>">
                                <label><?php echo e(__('Meta Description')); ?></label>
                                <textarea class="form-control" name="<?php echo e($language->code); ?>_meta_description" rows="5"
                                  placeholder="Enter Meta Description"><?php echo e(is_null($serviceData) ? '' : $serviceData->meta_description); ?></textarea>
                              </div>
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
                <?php echo e(__('Update')); ?>

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
    const imgUpUrl = "<?php echo e(route('seller.service_management.upload_slider_image')); ?>";
    const imgRmvUrl = "<?php echo e(route('seller.service_management.remove_slider_image')); ?>";
    const imgDetachUrl = "<?php echo e(route('seller.service_management.detach_slider_image')); ?>";
  </script>

  <script type="text/javascript" src="<?php echo e(asset('assets/js/slider-image.js')); ?>"></script>
  <script type="text/javascript" src="<?php echo e(asset('assets/js/admin-partial.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('seller.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\younes\Downloads\junspro-main (1)\junspro-main3\resources\views\seller\service\edit.blade.php ENDPATH**/ ?>