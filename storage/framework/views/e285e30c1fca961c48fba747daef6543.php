<?php $__env->startSection('content'); ?>
  <div class="page-header">
    <h4 class="page-title"><?php echo e(__('Add Seller')); ?></h4>
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
        <a href="#"><?php echo e(__('Seller Management')); ?></a>
      </li>
      <li class="separator">
        <i class="flaticon-right-arrow"></i>
      </li>
      <li class="nav-item">
        <a href="#"><?php echo e(__('Add Seller')); ?></a>
      </li>
    </ul>
  </div>

  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <div class="row">
            <div class="col-lg-12">
              <div class="card-title"><?php echo e(__('Add Seller')); ?></div>
            </div>
          </div>
        </div>

        <div class="card-body">
          <div class="row">
            <div class="col-lg-10 mx-auto">
              <form id="ajaxEditForm" action="<?php echo e(route('admin.seller_management.save-seller')); ?>" method="post">
                <?php echo csrf_field(); ?>
                <div class="row">
                  <div class="col-lg-12">
                    <div class="form-group">
                      <label for=""><?php echo e(__('Photo')); ?></label>
                      <br>
                      <div class="thumb-preview">
                        <img src="<?php echo e(asset('assets/img/noimage.jpg')); ?>" alt="..." class="uploaded-img">
                      </div>
                      <div class="mt-3">
                        <div role="button" class="btn btn-primary btn-sm upload-btn">
                          <?php echo e(__('Choose Photo')); ?>

                          <input type="file" class="img-input" name="photo">
                        </div>
                        <p id="editErr_photo" class="mt-1 mb-0 text-danger em"></p>
                        <p class="mt-2 mb-0 text-warning"><?php echo e(__('Image Size 100x100')); ?></p>
                      </div>
                    </div>
                  </div>


                  <div class="col-lg-3">
                    <div class="form-group">
                      <label><?php echo e(__('Username*')); ?></label>
                      <input type="text" value="" class="form-control" name="username"
                        placeholder="<?php echo e(__('Enter Username')); ?>">
                      <p id="editErr_username" class="mt-1 mb-0 text-danger em"></p>
                    </div>
                  </div>
                  <div class="col-lg-3">
                    <div class="form-group">
                      <label><?php echo e(__('Password *')); ?></label>
                      <input type="password" value="" class="form-control" name="password"
                        placeholder="<?php echo e(__('Enter Password')); ?> ">
                      <p id="editErr_password" class="mt-1 mb-0 text-danger em"></p>
                    </div>
                  </div>
                  <div class="col-lg-3">
                    <div class="form-group">
                      <label><?php echo e(__('Email*')); ?></label>
                      <input type="text" value="" class="form-control" name="email"
                        placeholder="<?php echo e(__('Enter Email')); ?>">
                      <p id="editErr_email" class="mt-1 mb-0 text-danger em"></p>
                    </div>
                  </div>
                  <div class="col-lg-3">
                    <div class="form-group">
                      <label><?php echo e(__('Phone')); ?></label>
                      <input type="tel" value="" class="form-control" name="phone"
                        placeholder="<?php echo e(__('Enter Phone')); ?>">
                      <p id="editErr_phone" class="mt-1 mb-0 text-danger em"></p>
                    </div>
                  </div>

                </div>
                <div id="accordion" class="mt-5">
                  <?php $__currentLoopData = $languages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="version">
                      <div class="version-header" id="heading<?php echo e($language->id); ?>">
                        <h5 class="mb-0">
                          <button type="button"
                            class="btn btn-link <?php echo e($language->direction == 1 ? 'rtl text-right' : ''); ?>"
                            data-toggle="collapse" data-target="#collapse<?php echo e($language->id); ?>"
                            aria-expanded="<?php echo e($language->is_default == 1 ? 'true' : 'false'); ?>"
                            aria-controls="collapse<?php echo e($language->id); ?>">
                            <?php echo e($language->name . __(' Language')); ?> <?php echo e($language->is_default == 1 ? '(Default)' : ''); ?>

                          </button>
                        </h5>
                      </div>

                      <div id="collapse<?php echo e($language->id); ?>"
                        class="collapse <?php echo e($language->is_default == 1 ? 'show' : ''); ?>"
                        aria-labelledby="heading<?php echo e($language->id); ?>" data-parent="#accordion">
                        <div class="version-body">
                          <div class="row">
                            <div class="col-lg-4">
                              <div class="form-group">
                                <label><?php echo e(__('Name*')); ?></label>
                                <input type="text" value="" class="form-control"
                                  name="<?php echo e($language->code); ?>_name" placeholder="<?php echo e(__('Enter Name')); ?>">
                                <p id="editErr_<?php echo e($language->code); ?>_name" class="mt-1 mb-0 text-danger em"></p>
                              </div>
                            </div>
                            <div class="col-lg-4">
                              <div class="form-group">
                                <label><?php echo e(__('Skill')); ?></label>
                                <?php
                                  $skills = App\Models\Skill::where([['language_id', $language->id], ['status', 1]])->get();
                                ?>
                                <select name="<?php echo e($language->code); ?>_skills[]" multiple id="" class="select2">
                                  <?php $__currentLoopData = $skills; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $skill): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($skill->id); ?>">
                                      <?php echo e($skill->name); ?></option>
                                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                                <p id="editErr_<?php echo e($language->code); ?>_skills" class="mt-1 mb-0 text-danger em"></p>
                              </div>
                            </div>
                            <div class="col-lg-4">
                              <div class="form-group">
                                <label><?php echo e(__('Country')); ?></label>
                                <input type="text" value="" class="form-control"
                                  name="<?php echo e($language->code); ?>_country" placeholder="<?php echo e(__('Enter Country')); ?>">
                                <p id="editErr_<?php echo e($language->code); ?>_country" class="mt-1 mb-0 text-danger em"></p>
                              </div>
                            </div>
                            <div class="col-lg-4">
                              <div class="form-group">
                                <label><?php echo e(__('City')); ?></label>
                                <input type="text" value="" class="form-control"
                                  name="<?php echo e($language->code); ?>_city" placeholder="<?php echo e(__('Enter City')); ?>">
                                <p id="editErr_<?php echo e($language->code); ?>_city" class="mt-1 mb-0 text-danger em"></p>
                              </div>
                            </div>
                            <div class="col-lg-4">
                              <div class="form-group">
                                <label><?php echo e(__('State')); ?></label>
                                <input type="text" value="" class="form-control" name="state"
                                  placeholder="<?php echo e(__('Enter State')); ?>">
                                <p id="editErr_<?php echo e($language->code); ?>_state" class="mt-1 mb-0 text-danger em"></p>
                              </div>
                            </div>
                            <div class="col-lg-4">
                              <div class="form-group">
                                <label><?php echo e(__('Zip Code')); ?></label>
                                <input type="text" value="" class="form-control"
                                  name="<?php echo e($language->code); ?>_zip_code" placeholder="<?php echo e(__('Enter Zip Code')); ?>">
                                <p id="editErr_<?php echo e($language->code); ?>_zip_code" class="mt-1 mb-0 text-danger em"></p>
                              </div>
                            </div>
                            <div class="col-lg-12">
                              <div class="form-group">
                                <label><?php echo e(__('Address')); ?></label>
                                <textarea name="<?php echo e($language->code); ?>_address" class="form-control" placeholder="<?php echo e(__('Enter Address')); ?>"></textarea>
                                <p id="editErr_<?php echo e($language->code); ?>_email" class="mt-1 mb-0 text-danger em"></p>
                              </div>
                            </div>
                            <div class="col-lg-12">
                              <div class="form-group">
                                <label><?php echo e(__('Details')); ?></label>
                                <textarea name="<?php echo e($language->code); ?>_details" class="form-control" rows="5"
                                  placeholder="<?php echo e(__('Enter Details')); ?>"></textarea>
                                <p id="editErr_<?php echo e($language->code); ?>_details" class="mt-1 mb-0 text-danger em"></p>
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
                                    <span class="form-check-sign"><?php echo e(__('Clone for')); ?> <strong
                                        class="text-capitalize text-secondary"><?php echo e($language->name); ?></strong>
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
              <button type="submit" id="updateBtn" class="btn btn-success">
                <?php echo e(__('Update')); ?>

              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\younes\Downloads\junspro-main (1)\junspro-main3\resources\views\backend\end-user\seller\create.blade.php ENDPATH**/ ?>