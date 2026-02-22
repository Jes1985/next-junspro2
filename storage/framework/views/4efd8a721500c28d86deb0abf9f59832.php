<?php $__env->startSection('content'); ?>
  <div class="page-header">
    <h4 class="page-title"><?php echo e(__('Seller Profile')); ?></h4>
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
        <a href="#"><?php echo e(__('Profile Settings')); ?></a>
      </li>
    </ul>
  </div>

  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <div class="row">
            <div class="col-lg-12">
              <div class="card-title"><?php echo e(__('Update Profile')); ?></div>
            </div>
          </div>
        </div>

        <div class="card-body">
          <div class="row">
            <div class="col-lg-8 mx-auto">
              <form id="ajaxEditForm" action="<?php echo e(route('seller.update_profile')); ?>" method="POST"
                enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <div class="row">
                  <div class="col-lg-12">
                    <div class="form-group">
                      <label for=""><?php echo e(__('Photo')); ?></label>
                      <br>
                      <div class="thumb-preview">
                        <?php if($seller->photo != null): ?>
                          <img src="<?php echo e(asset('assets/admin/img/seller-photo/' . $seller->photo)); ?>" alt="..."
                            class="uploaded-img">
                        <?php else: ?>
                          <img src="<?php echo e(asset('assets/img/noimage.jpg')); ?>" alt="..." class="uploaded-img">
                        <?php endif; ?>

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
                  <div class="col-lg-4">
                    <div class="form-group">
                      <label><?php echo e(__('Username*')); ?></label>
                      <input type="text" value="<?php echo e($seller->username); ?>" class="form-control" name="username">
                      <p id="editErr_username" class="mt-1 mb-0 text-danger em"></p>
                    </div>
                  </div>
                  <div class="col-lg-4">
                    <div class="form-group">
                      <label><?php echo e(__('Email*')); ?></label>
                      <input type="text" value="<?php echo e($seller->email); ?>" class="form-control" name="email">
                      <p id="editErr_email" class="mt-1 mb-0 text-danger em"></p>
                    </div>
                  </div>
                  <div class="col-lg-4">
                    <div class="form-group">
                      <label><?php echo e(__('Phone')); ?></label>
                      <input type="tel" value="<?php echo e($seller->phone); ?>" class="form-control" name="phone">
                      <p id="editErr_phone" class="mt-1 mb-0 text-danger em"></p>
                    </div>
                  </div>
                  <div class="col-lg-4">
                    <div class="form-group">
                      <div class="custom-control custom-checkbox">
                        <input type="checkbox" <?php echo e($seller->show_email_addresss == 1 ? 'checked' : ''); ?>

                          name="show_email_addresss" class="custom-control-input" id="show_email_addresss">
                        <label class="custom-control-label"
                          for="show_email_addresss"><?php echo e(__('Show Email Address in Profile Page')); ?></label>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-4">
                    <div class="form-group">
                      <div class="custom-control custom-checkbox">
                        <input type="checkbox" <?php echo e($seller->show_phone_number == 1 ? 'checked' : ''); ?>

                          name="show_phone_number" class="custom-control-input" id="show_phone_number">
                        <label class="custom-control-label"
                          for="show_phone_number"><?php echo e(__('Show Phone Number in Profile Page')); ?></label>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-4">
                    <div class="form-group">
                      <div class="custom-control custom-checkbox">
                        <input type="checkbox" <?php echo e($seller->show_contact_form == 1 ? 'checked' : ''); ?>

                          name="show_contact_form" class="custom-control-input" id="show_contact_form">
                        <label class="custom-control-label" for="show_contact_form"><?php echo e(__('Show Contact Form')); ?></label>
                      </div>
                    </div>
                  </div>

                  <div class="col-lg-12">
                    <div id="accordion" class="mt-3">
                      <?php $__currentLoopData = $languages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="version">
                          <div class="version-header" id="heading<?php echo e($language->id); ?>">
                            <h5 class="mb-0">
                              <button type="button" class="btn btn-link" data-toggle="collapse"
                                data-target="#collapse<?php echo e($language->id); ?>"
                                aria-expanded="<?php echo e($language->is_default == 1 ? 'true' : 'false'); ?>"
                                aria-controls="collapse<?php echo e($language->id); ?>">
                                <?php echo e($language->name . __(' Language')); ?>

                                <?php echo e($language->is_default == 1 ? '(Default)' : ''); ?>

                              </button>
                            </h5>
                          </div>

                          <?php
                            $seller_info = App\Models\SellerInfo::where('seller_id', Auth::guard('seller')->user()->id)
                                ->where('language_id', $language->id)
                                ->first();
                          ?>

                          <div id="collapse<?php echo e($language->id); ?>"
                            class="collapse <?php echo e($language->is_default == 1 ? 'show' : ''); ?>"
                            aria-labelledby="heading<?php echo e($language->id); ?>" data-parent="#accordion">
                            <div class="version-body">
                              <div class="row">
                                <div class="col-lg-6">
                                  <div class="form-group <?php echo e($language->direction == 1 ? 'rtl text-right' : ''); ?>">
                                    <label><?php echo e(__('Name') . '*'); ?></label>
                                    <input type="text" class="form-control" name="<?php echo e($language->code); ?>_name"
                                      placeholder="Enter Your Full Name"
                                      value="<?php echo e($seller_info ? $seller_info->name : ''); ?>">

                                    <p class="mt-2 mb-0 text-danger em" id="editErr_<?php echo e($language->code); ?>_name"></p>
                                  </div>
                                </div>
                                <div class="col-lg-6">
                                  <div class="form-group <?php echo e($language->direction == 1 ? 'rtl text-right' : ''); ?>">
                                    <?php
                                      $skills = App\Models\Skill::where([['language_id', $language->id], ['status', 1]])->get();
                                      if ($seller_info) {
                                          if (!is_null($seller_info->skills)) {
                                              $selected_skills = json_decode($seller_info->skills);
                                          } else {
                                              $selected_skills = [];
                                          }
                                      } else {
                                          $selected_skills = [];
                                      }
                                    ?>
                                    <label><?php echo e(__('Skills')); ?></label>
                                    <select name="<?php echo e($language->code); ?>_skills[]" multiple id=""
                                      class="select2">
                                      <?php $__currentLoopData = $skills; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $skill): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($skill->id); ?>" <?php if(in_array($skill->id, $selected_skills)): echo 'selected'; endif; ?>>
                                          <?php echo e($skill->name); ?></option>
                                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                    <p class="mt-2 mb-0 text-danger em" id="editErr_<?php echo e($language->code); ?>_skills"></p>
                                  </div>
                                </div>

                                <div class="col-lg-6">
                                  <div class="form-group <?php echo e($language->direction == 1 ? 'rtl text-right' : ''); ?>">
                                    <label><?php echo e(__('Country')); ?></label>
                                    <input type="text" class="form-control" name="<?php echo e($language->code); ?>_country"
                                      value="<?php echo e($seller_info ? $seller_info->country : ''); ?>">
                                  </div>
                                </div>
                                <div class="col-lg-6">
                                  <div class="form-group <?php echo e($language->direction == 1 ? 'rtl text-right' : ''); ?>">
                                    <label><?php echo e(__('City')); ?></label>
                                    <input type="text" class="form-control" name="<?php echo e($language->code); ?>_city"
                                      value="<?php echo e($seller_info ? $seller_info->city : ''); ?>">
                                  </div>
                                </div>
                                <div class="col-lg-6">
                                  <div class="form-group <?php echo e($language->direction == 1 ? 'rtl text-right' : ''); ?>">
                                    <label><?php echo e(__('State')); ?></label>
                                    <input type="text" class="form-control" name="<?php echo e($language->code); ?>_state"
                                      value="<?php echo e($seller_info ? $seller_info->state : ''); ?>">
                                  </div>
                                </div>
                                <div class="col-lg-6">
                                  <div class="form-group <?php echo e($language->direction == 1 ? 'rtl text-right' : ''); ?>">
                                    <label><?php echo e(__('Zip Code')); ?></label>
                                    <input type="text" class="form-control" name="<?php echo e($language->code); ?>_zip_code"
                                      value="<?php echo e($seller_info ? $seller_info->zip_code : ''); ?>">
                                  </div>
                                </div>
                                <div class="col-lg-12">
                                  <div class="form-group <?php echo e($language->direction == 1 ? 'rtl text-right' : ''); ?>">
                                    <label><?php echo e(__('Address')); ?></label>
                                    <textarea name="<?php echo e($language->code); ?>_address" class="form-control"><?php echo e($seller_info ? $seller_info->address : ''); ?></textarea>
                                  </div>
                                </div>
                                <div class="col-lg-12">
                                  <div class="form-group <?php echo e($language->direction == 1 ? 'rtl text-right' : ''); ?>">
                                    <label><?php echo e(__('Details')); ?></label>
                                    <textarea name="<?php echo e($language->code); ?>_details" rows="5" class="form-control"><?php echo e($seller_info ? $seller_info->details : ''); ?></textarea>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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

<?php echo $__env->make('seller.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\younes\Downloads\junspro-main (1)\junspro-main3\resources\views\seller\auth\edit-profile.blade.php ENDPATH**/ ?>