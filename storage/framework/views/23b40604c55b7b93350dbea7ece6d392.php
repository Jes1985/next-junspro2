<?php $__env->startSection('content'); ?>
  <div class="page-header">
    <h4 class="page-title"><?php echo e(__('Edit Seller')); ?></h4>
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
        <a href="<?php echo e(route('admin.seller_management.registered_seller')); ?>"><?php echo e(__('Registered Sellers')); ?></a>
      </li>
      <li class="separator">
        <i class="flaticon-right-arrow"></i>
      </li>
      <li class="nav-item">
        <a href="#"><?php echo e(__('Edit Seller')); ?></a>
      </li>
    </ul>
    <a href="<?php echo e(route('admin.seller_management.registered_seller')); ?>"
      class="btn btn-primary ml-auto"><?php echo e(__('Back')); ?></a>
  </div>

  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <div class="row">
            <div class="col-lg-12">
              <div class="card-title"><?php echo e(__('Edit Seller')); ?></div>
            </div>
          </div>
        </div>

        <div class="card-body">
          <div class="row">
            <div class="col-lg-10 mx-auto">
              <form id="ajaxEditForm"
                action="<?php echo e(route('admin.seller_management.seller.update_seller', ['id' => $seller->id])); ?>"
                method="post">
                <?php echo csrf_field(); ?>
                <h2><?php echo e(__('Details')); ?></h2>
                <hr>
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
                  <div class="col-lg-3">
                    <div class="form-group">
                      <label><?php echo e(__('Username*')); ?></label>
                      <input type="text" value="<?php echo e($seller->username); ?>" class="form-control" name="username">
                      <p id="editErr_username" class="mt-1 mb-0 text-danger em"></p>
                    </div>
                  </div>
                  <div class="col-lg-3">
                    <div class="form-group">
                      <label><?php echo e(__('Email*')); ?></label>
                      <input type="text" value="<?php echo e($seller->email); ?>" class="form-control" name="email">
                      <p id="editErr_email" class="mt-1 mb-0 text-danger em"></p>
                    </div>
                  </div>
                  <div class="col-lg-3">
                    <div class="form-group">
                      <label><?php echo e(__('Recipient Mail*')); ?></label>
                      <input type="text" value="<?php echo e($seller->recipient_mail); ?>" class="form-control"
                        name="recipient_mail">
                      <p id="editErr_recipient_mail" class="mt-1 mb-0 text-danger em"></p>
                    </div>
                  </div>
                  <div class="col-lg-3">
                    <div class="form-group">
                      <label><?php echo e(__('Phone')); ?></label>
                      <input type="tel" value="<?php echo e($seller->phone); ?>" class="form-control" name="phone">
                      <p id="editErr_phone" class="mt-1 mb-0 text-danger em"></p>
                    </div>
                  </div>

                  <div class="col-lg-12">
                    <div class="row">
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
                            <label class="custom-control-label"
                              for="show_contact_form"><?php echo e(__('Show Contact Form')); ?></label>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="col-lg-12">
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
                                <?php echo e($language->name . __(' Language')); ?>

                                <?php echo e($language->is_default == 1 ? '(Default)' : ''); ?>

                              </button>
                            </h5>
                          </div>

                          <?php
                            $sellerInfo = App\Models\SellerInfo::where('seller_id', $seller->id)
                                ->where('language_id', $language->id)
                                ->first();
                          ?>

                          <div id="collapse<?php echo e($language->id); ?>"
                            class="collapse <?php echo e($language->is_default == 1 ? 'show' : ''); ?>"
                            aria-labelledby="heading<?php echo e($language->id); ?>" data-parent="#accordion">
                            <div class="version-body">
                              <div class="row">
                                <div class="col-lg-4">
                                  <div class="form-group">
                                    <label><?php echo e(__('Name*')); ?></label>
                                    <input type="text" value="<?php echo e(!empty($sellerInfo) ? $sellerInfo->name : ''); ?>"
                                      class="form-control" name="<?php echo e($language->code); ?>_name"
                                      placeholder="<?php echo e(__('Enter Name')); ?>">
                                    <p id="editErr_<?php echo e($language->code); ?>_name" class="mt-1 mb-0 text-danger em"></p>
                                  </div>
                                </div>
                                <div class="col-lg-4">
                                  <div class="form-group <?php echo e($language->direction == 1 ? 'rtl text-right' : ''); ?>">
                                    <?php
                                      $skills = App\Models\Skill::where([['language_id', $language->id], ['status', 1]])->get();
                                      if ($sellerInfo) {
                                          if (!is_null($sellerInfo->skills)) {
                                              $selected_skills = json_decode($sellerInfo->skills);
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
                                <div class="col-lg-4">
                                  <div class="form-group">
                                    <label><?php echo e(__('Country')); ?></label>
                                    <input type="text" value="<?php echo e(!empty($sellerInfo) ? $sellerInfo->country : ''); ?>"
                                      class="form-control" name="<?php echo e($language->code); ?>_country"
                                      placeholder="<?php echo e(__('Enter Country')); ?>">
                                    <p id="editErr_<?php echo e($language->code); ?>_country" class="mt-1 mb-0 text-danger em"></p>
                                  </div>
                                </div>
                                <div class="col-lg-4">
                                  <div class="form-group">
                                    <label><?php echo e(__('City')); ?></label>
                                    <input type="text" value="<?php echo e(!empty($sellerInfo) ? $sellerInfo->city : ''); ?>"
                                      class="form-control" name="<?php echo e($language->code); ?>_city"
                                      placeholder="<?php echo e(__('Enter City')); ?>">
                                    <p id="editErr_<?php echo e($language->code); ?>_city" class="mt-1 mb-0 text-danger em"></p>
                                  </div>
                                </div>
                                <div class="col-lg-4">
                                  <div class="form-group">
                                    <label><?php echo e(__('State')); ?></label>
                                    <input type="text" value="<?php echo e(!empty($sellerInfo) ? $sellerInfo->state : ''); ?>"
                                      class="form-control" name="<?php echo e($language->code); ?>_state"
                                      placeholder="<?php echo e(__('Enter State')); ?>">
                                    <p id="editErr_<?php echo e($language->code); ?>_state" class="mt-1 mb-0 text-danger em"></p>
                                  </div>
                                </div>
                                <div class="col-lg-4">
                                  <div class="form-group">
                                    <label><?php echo e(__('Zip Code')); ?></label>
                                    <input type="text"
                                      value="<?php echo e(!empty($sellerInfo) ? $sellerInfo->zip_code : ''); ?>"
                                      class="form-control" name="<?php echo e($language->code); ?>_zip_code"
                                      placeholder="<?php echo e(__('Enter Zip Code')); ?>">
                                    <p id="editErr_<?php echo e($language->code); ?>_zip_code" class="mt-1 mb-0 text-danger em">
                                    </p>
                                  </div>
                                </div>
                                <div class="col-lg-12">
                                  <div class="form-group">
                                    <label><?php echo e(__('Address')); ?></label>
                                    <textarea name="<?php echo e($language->code); ?>_address" class="form-control" placeholder="<?php echo e(__('Enter Address')); ?>"><?php echo e(!empty($sellerInfo) ? $sellerInfo->address : ''); ?></textarea>
                                    <p id="editErr_<?php echo e($language->code); ?>_email" class="mt-1 mb-0 text-danger em"></p>
                                  </div>
                                </div>
                                <div class="col-lg-12">
                                  <div class="form-group">
                                    <label><?php echo e(__('Details')); ?></label>
                                    <textarea name="<?php echo e($language->code); ?>_details" class="form-control" rows="5"
                                      placeholder="<?php echo e(__('Enter Details')); ?>"><?php echo e(!empty($sellerInfo) ? $sellerInfo->details : ''); ?></textarea>
                                    <p id="editErr_<?php echo e($language->code); ?>_details" class="mt-1 mb-0 text-danger em"></p>
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
      <div class="card">
        <div class="card-body">
          <div class="row">
            <div class="col-lg-8 mx-auto">
              <h2 class="mt-3 text-warning"><?php echo e(__('Seller Balance') . ' : '); ?>

                <?php echo e($seller->amount == null ? 0.0 : symbolPrice($seller->amount)); ?></h2>
              <hr>
              <form id="ajaxEditForm2"
                action="<?php echo e(route('admin.seller_management.seller.update_seller_balance', ['id' => $seller->id])); ?>"
                method="post">
                <?php echo csrf_field(); ?>
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label><?php echo e(__('Seller Balance') . '*'); ?></label>
                      <div class="selectgroup w-100">
                        <label class="selectgroup-item">
                          <input type="radio" name="amount_status" value="1" class="selectgroup-input">
                          <span class="selectgroup-button"><?php echo e(__('Add')); ?></span>
                        </label>
                        <label class="selectgroup-item">
                          <input type="radio" name="amount_status" value="0" class="selectgroup-input">
                          <span class="selectgroup-button"><?php echo e(__('Subtract')); ?></span>
                        </label>
                      </div>
                      <p id="editErr_amount_status" class="mt-1 mb-0 text-danger em"></p>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                      <label><?php echo e(__('Amount')); ?> (<?php echo e($settings->base_currency_symbol); ?>) *</label>
                      <input type="number" name="amount" class="form-control">
                      <p id="editErr_amount" class="mt-1 mb-0 text-danger em"></p>
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
              <button type="submit" id="updateBtn2" class="btn btn-success">
                <?php echo e(__('Update')); ?>

              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  <?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\younes\Downloads\junspro-main (1)\junspro-main3\resources\views\backend\end-user\seller\edit.blade.php ENDPATH**/ ?>