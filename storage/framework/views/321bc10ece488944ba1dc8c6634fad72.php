<?php $title = __('Edit Profile'); ?>

<?php $__env->startSection('pageHeading'); ?>
  <?php echo e($title); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
  <?php if ($__env->exists('frontend.partials.breadcrumb', ['breadcrumb' => $breadcrumb, 'title' => $title])) echo $__env->make('frontend.partials.breadcrumb', ['breadcrumb' => $breadcrumb, 'title' => $title], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

  <!-- Start User Edit-Profile Section -->
  <section class="user-dashboard pt-100 pb-60">
    <div class="container">
      <div class="row">
        <?php if ($__env->exists('frontend.user.side-navbar')) echo $__env->make('frontend.user.side-navbar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

        <div class="col-lg-9">
          <div class="row">
            <div class="col-lg-12">
              <div class="user-profile-details mb-40">
                <div class="account-info">
                  <div class="title">
                    <h4><?php echo e(__('Edit Your Profile')); ?></h4>
                  </div>

                  <div class="edit-info-area">
                    <form action="<?php echo e(route('user.update_profile')); ?>" method="POST" enctype="multipart/form-data">
                      <?php echo csrf_field(); ?>
                      <div class="upload-img">
                        <div class="img-box">
                          <img class="user-photo lazyload" data-src="<?php echo e(is_null($authUser->image) ? asset('assets/img/profile.jpg') : asset('assets/img/users/' . $authUser->image)); ?>" alt="user image">
                        </div>

                        <div class="file-upload-area">
                          <div class="upload-file">
                            <input type="file" name="image" class="upload">
                            <span><?php echo e(__('Upload')); ?></span>
                          </div>
                        </div>
                      </div>
                      <?php $__errorArgs = ['image'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="mb-3 text-danger"><?php echo e($message); ?></p>
                      <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                      <p class="text-warning mb-3"><?php echo e(__('Image Size : 80x80')); ?>

                      </p>


                      <div class="row">
                        <div class="col-lg-6 mb-4">
                          <input type="text" class="form-control" placeholder="<?php echo e(__('First Name')); ?>"
                            name="first_name" value="<?php echo e($authUser->first_name); ?>">
                          <?php $__errorArgs = ['first_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <p class="text-danger mt-1"><?php echo e($message); ?></p>
                          <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <div class="col-lg-6 mb-4">
                          <input type="text" class="form-control" placeholder="<?php echo e(__('Last Name')); ?>" name="last_name"
                            value="<?php echo e($authUser->last_name); ?>">
                          <?php $__errorArgs = ['last_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <p class="text-danger mt-1"><?php echo e($message); ?></p>
                          <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                        <div class="col-lg-6 mb-4">
                          <input type="text" class="form-control" placeholder="<?php echo e(__('Username')); ?>" name="username"
                            value="<?php echo e(empty($authUser->username) ? $authUser->provider_id : $authUser->username); ?>">
                          <?php $__errorArgs = ['username'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <p class="text-danger mt-1"><?php echo e($message); ?></p>
                          <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <div class="col-lg-6 mb-4">
                          <input type="email" class="form-control" placeholder="<?php echo e(__('Email Address')); ?>"
                            value="<?php echo e($authUser->email_address); ?>" readonly>
                        </div>

                        <div class="col-lg-6 mb-4">
                          <input type="text" class="form-control" placeholder="<?php echo e(__('Phone Number')); ?>"
                            name="phone_number" value="<?php echo e($authUser->phone_number); ?>">
                          <?php $__errorArgs = ['phone_number'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <p class="text-danger mt-1"><?php echo e($message); ?></p>
                          <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <div class="col-lg-6 mb-4">
                          <input type="text" class="form-control" placeholder="<?php echo e(__('City')); ?>" name="city"
                            value="<?php echo e($authUser->city); ?>">
                          <?php $__errorArgs = ['city'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <p class="text-danger mt-1"><?php echo e($message); ?></p>
                          <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <div class="col-lg-6 mb-4">
                          <input type="text" class="form-control" placeholder="<?php echo e(__('State')); ?>" name="state"
                            value="<?php echo e($authUser->state); ?>">
                        </div>

                        <div class="col-lg-6 mb-4">
                          <input type="text" class="form-control" placeholder="<?php echo e(__('Country')); ?>" name="country"
                            value="<?php echo e($authUser->country); ?>">
                          <?php $__errorArgs = ['country'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <p class="text-danger mt-1"><?php echo e($message); ?></p>
                          <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <div class="col-lg-12 mb-4">
                          <textarea class="form-control" placeholder="<?php echo e(__('Address')); ?>" rows="2" name="address"><?php echo e($authUser->address); ?></textarea>
                          <?php $__errorArgs = ['address'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <p class="text-danger mt-1"><?php echo e($message); ?></p>
                          <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <?php
                          $freelancerProfile = $authUser->freelancerProfile ?? null;
                        ?>

                        <?php if($freelancerProfile): ?>
                          <!-- Section Freelance Profile -->
                          <div class="col-lg-12 mb-4">
                            <hr style="margin: 30px 0; border-color: #E5E7EB;">
                            <h5 style="font-weight: 600; margin-bottom: 20px; color: #111827;">
                              <i class="fas fa-user-tie me-2" style="color: #4F46E5;"></i>
                              <?php echo e(__('Profil Freelance')); ?>

                            </h5>
                          </div>

                          <div class="col-lg-12 mb-4">
                            <label class="form-label"><?php echo e(__('Bio')); ?></label>
                            <textarea class="form-control" placeholder="<?php echo e(__('Décrivez votre expertise et votre expérience...')); ?>" rows="4" name="freelancer_bio"><?php echo e($freelancerProfile->bio); ?></textarea>
                            <?php $__errorArgs = ['freelancer_bio'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                              <p class="text-danger mt-1"><?php echo e($message); ?></p>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                          </div>

                          <div class="col-lg-6 mb-4">
                            <label class="form-label"><?php echo e(__('Tarif horaire (€)')); ?></label>
                            <input type="number" class="form-control" placeholder="50" name="freelancer_hourly_rate" 
                                   value="<?php echo e($freelancerProfile->hourly_rate); ?>" 
                                   min="3" max="200" step="0.01">
                            <?php $__errorArgs = ['freelancer_hourly_rate'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                              <p class="text-danger mt-1"><?php echo e($message); ?></p>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            <small class="text-muted"><?php echo e(__('Entre 3€ et 200€')); ?></small>
                          </div>

                          <!-- Section Vidéo de présentation -->
                          <div class="col-lg-12 mb-4">
                            <hr style="margin: 20px 0; border-color: #E5E7EB;">
                            <h6 style="font-weight: 600; margin-bottom: 16px; color: #111827;">
                              <i class="fas fa-video me-2" style="color: #4F46E5;"></i>
                              <?php echo e(__('Vidéo de présentation')); ?>

                            </h6>
                            
                            <?php
                              $hasVideo = !empty($freelancerProfile->video_thumbnail_url);
                            ?>

                            <?php if($hasVideo): ?>
                              <div class="mb-3">
                                <label class="form-label"><?php echo e(__('Miniature actuelle')); ?></label>
                                <div class="thumb-preview" style="max-width: 400px;">
                                  <img src="<?php echo e($freelancerProfile->video_thumbnail_url); ?>" 
                                       alt="Miniature vidéo" 
                                       class="uploaded-img" 
                                       id="video-thumbnail-preview"
                                       style="max-width: 100%; border-radius: 8px; aspect-ratio: 16/9; object-fit: cover;">
                                </div>
                              </div>
                            <?php endif; ?>

                            <!-- Upload d'image -->
                            <div class="mb-3">
                              <label class="form-label"><?php echo e(__('Uploader une miniature vidéo')); ?></label>
                              <div class="file-upload-area">
                                <div class="upload-file">
                                  <input type="file" name="video_thumbnail_image" id="video_thumbnail_image" 
                                         class="upload" accept="image/jpeg,image/png,image/webp"
                                         onchange="previewVideoThumbnail(this)">
                                  <span><?php echo e(__('Choisir une image')); ?></span>
                                </div>
                              </div>
                              <?php $__errorArgs = ['video_thumbnail_image'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <p class="text-danger mt-1"><?php echo e($message); ?></p>
                              <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                              <small class="text-muted d-block mt-1">
                                <?php echo e(__('Format 16:9 recommandé (ex: 1280×720px). Formats acceptés: JPG, PNG, WEBP.')); ?>

                              </small>
                            </div>

                            <!-- OU URL -->
                            <div class="mb-3">
                              <label class="form-label"><?php echo e(__('OU URL de la miniature vidéo')); ?></label>
                              <input type="url" class="form-control" 
                                     placeholder="https://example.com/video-thumbnail.jpg" 
                                     name="video_thumbnail_url" 
                                     id="video_thumbnail_url"
                                     value="<?php echo e($freelancerProfile->video_thumbnail_url); ?>">
                              <?php $__errorArgs = ['video_thumbnail_url'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <p class="text-danger mt-1"><?php echo e($message); ?></p>
                              <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                              <small class="text-muted d-block mt-1">
                                <?php echo e(__('Si vous avez déjà hébergé votre image ailleurs, entrez son URL ici.')); ?>

                              </small>
                            </div>

                            <?php if(!$hasVideo && !empty($freelancerProfile->bio)): ?>
                              <div class="alert alert-warning" style="background: #FEF3C7; border-color: #FCD34D; color: #92400E; padding: 12px; border-radius: 8px; font-size: 13px;">
                                <i class="fas fa-exclamation-triangle me-2"></i>
                                <?php echo e(__('Pour un rendu plus professionnel, ajoutez une miniature à votre vidéo (format 16:9).')); ?>

                              </div>
                            <?php endif; ?>
                          </div>

                          <script>
                            function previewVideoThumbnail(input) {
                              if (input.files && input.files[0]) {
                                const reader = new FileReader();
                                reader.onload = function(e) {
                                  let preview = document.getElementById('video-thumbnail-preview');
                                  if (!preview) {
                                    // Créer le preview si il n'existe pas
                                    const previewContainer = document.createElement('div');
                                    previewContainer.className = 'mb-3';
                                    previewContainer.innerHTML = `
                                      <label class="form-label"><?php echo e(__('Aperçu')); ?></label>
                                      <div class="thumb-preview" style="max-width: 400px;">
                                        <img src="${e.target.result}" 
                                             alt="Aperçu miniature" 
                                             class="uploaded-img" 
                                             id="video-thumbnail-preview"
                                             style="max-width: 100%; border-radius: 8px; aspect-ratio: 16/9; object-fit: cover;">
                                      </div>
                                    `;
                                    input.closest('.mb-3').after(previewContainer);
                                  } else {
                                    preview.src = e.target.result;
                                  }
                                  // Vider le champ URL si on upload une image
                                  document.getElementById('video_thumbnail_url').value = '';
                                };
                                reader.readAsDataURL(input.files[0]);
                              }
                            }
                          </script>
                        <?php endif; ?>

                        <div class="col-lg-12">
                          <div class="form-button">
                            <button class="btn btn-md btn-primary radius-sm form-btn"><?php echo e(__('Submit')); ?></button>
                          </div>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- End User Edit-Profile Section -->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\younes\Downloads\junspro-main (1)\junspro-main3\resources\views\frontend\user\edit-profile.blade.php ENDPATH**/ ?>