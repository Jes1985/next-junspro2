<?php $title = __('Ticket Conversation'); ?>

<?php $__env->startSection('pageHeading'); ?>
  <?php echo e($title); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('style'); ?>
  <link rel="stylesheet" href="<?php echo e(asset('assets/css/summernote-content.css')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
  <?php if ($__env->exists('frontend.partials.breadcrumb', ['breadcrumb' => $breadcrumb, 'title' => $title])) echo $__env->make('frontend.partials.breadcrumb', ['breadcrumb' => $breadcrumb, 'title' => $title], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

  <!--====== Start Support Tickets Section ======-->
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
                    <h4><?php echo e(__('Ticket') . ': #' . $ticket->id); ?></h4>

                    <a href="<?php echo e(route('user.support_tickets')); ?>" class="btn btn-sm btn-primary rounded-1">
                      <i
                        class="<?php echo e($currentLanguageInfo->direction == 0 ? 'fas fa-chevron-left' : 'fas fa-chevron-right'); ?>"></i>
                      <?php echo e(__('Back')); ?>

                    </a>
                  </div>

                  <div class="ticket-info">
                    <div class="subject">
                      <h5><?php echo e($ticket->subject); ?></h5>

                      <div>
                        <?php if($ticket->status == 'pending'): ?>
                          <span class="badge badge-warning"><?php echo e(__('Pending')); ?></span>
                        <?php elseif($ticket->status == 'open'): ?>
                          <span class="badge badge-junspro"><?php echo e(__('Open')); ?></span>
                        <?php else: ?>
                          <span class="badge badge-danger"><?php echo e(__('Closed')); ?></span>
                        <?php endif; ?>

                        <span class="date-time"><?php echo e($ticket->created_at->format('M d, Y - h:i A')); ?></span>
                      </div>
                    </div>

                    <div class="message mt-2 summernote-content">
                      <?php echo replaceBaseUrl($ticket->message, 'summernote'); ?>

                    </div>

                    <?php if(!is_null($ticket->attachment)): ?>
                      <div class="attachment mt-4">
                        <a href="<?php echo e(asset('assets/file/ticket-files/' . $ticket->attachment)); ?>" download
                          class="btn btn-sm btn-primary rounded-1">
                          <i class="fas fa-download"></i> <?php echo e(__('Attachment')); ?>

                        </a>
                      </div>
                    <?php endif; ?>
                  </div>

                  <div class="conversation-info">
                    <h4 class="mb-3"><?php echo e(__('Conversations')); ?></h4>

                    <?php if(count($conversations) == 0): ?>
                      <p><?php echo e(__('No Conversation Found') . '!'); ?></p>
                    <?php else: ?>
                      <div class="message-list">
                        <?php $__currentLoopData = $conversations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $conversation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                          <?php if($conversation->person_type == 'user'): ?>
                            <?php $user = $conversation->user()->first(); ?>

                            <div class="single-message">
                              <div class="user-details">
                                <div class="user-img">
                                  <img
                                    data-src="<?php echo e(!is_null($user->image) ? asset('assets/img/users/' . $user->image) : asset('assets/img/blank-user.jpg')); ?>"
                                    alt="<?php echo e($user->first_name . ' ' . $user->last_name); ?>" class="lazyload">
                                </div>

                                <div class="user-infos">
                                  <h6 class="name"><?php echo e($user->first_name . ' ' . $user->last_name); ?></h6>
                                  <span class="type"><i
                                      class="fas fa-user <?php echo e($currentLanguageInfo->direction == 0 ? 'me-2' : 'ms-2'); ?>"></i><?php echo e(__('Customer')); ?></span>
                                  <span
                                    class="badge badge-secondary text-dark"><?php echo e($conversation->created_at->format('M d, Y - h:i A')); ?></span>
                                </div>
                              </div>

                              <div class="message summernote-content">
                                <?php echo replaceBaseUrl($conversation->reply, 'summernote'); ?>

                              </div>

                              <?php if(!is_null($conversation->attachment)): ?>
                                <a href="<?php echo e(asset('assets/file/ticket-files/' . $conversation->attachment)); ?>"
                                  download="support.zip" class="btn btn-sm btn-primary rounded-1">
                                  <i class="fas fa-download"></i> <?php echo e(__('Attachment')); ?>

                                </a>
                              <?php endif; ?>
                            </div>
                          <?php else: ?>
                            <?php $admin = $conversation->admin()->first(); ?>

                            <div class="single-message">
                              <div class="user-details">
                                <div class="user-img">
                                  <img
                                    data-src="<?php echo e(!is_null($admin->image) ? asset('assets/img/admins/' . $admin->image) : asset('assets/img/blank-user.jpg')); ?>"
                                    alt="<?php echo e($admin->first_name . ' ' . $admin->last_name); ?>" class="lazyload">
                                </div>

                                <div class="user-infos">
                                  <h6 class="name"><?php echo e($admin->first_name . ' ' . $admin->last_name); ?></h6>
                                  <span class="type"><i
                                      class="fas fa-user <?php echo e($currentLanguageInfo->direction == 0 ? 'me-2' : 'ms-2'); ?>"></i><?php echo e(is_null($admin->role_id) ? __('Super Admin') : $admin->role->name); ?></span>
                                  <span
                                    class="badge badge-secondary text-dark"><?php echo e($conversation->created_at->format('M d, Y - h:i A')); ?></span>
                                </div>
                              </div>

                              <div class="message summernote-content">
                                <?php echo replaceBaseUrl($conversation->reply, 'summernote'); ?>

                              </div>

                              <?php if(!is_null($conversation->attachment)): ?>
                                <a href="<?php echo e(asset('assets/file/ticket-files/' . $conversation->attachment)); ?>"
                                  download="support.zip" class="btn btn-lg btn-primary radius-sm">
                                  <i class="fas fa-download"></i><?php echo e(__('Attachment')); ?>

                                </a>
                              <?php endif; ?>
                            </div>
                          <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                      </div>
                    <?php endif; ?>
                  </div>

                  <?php if($ticket->status == 'open'): ?>
                    <div class="edit-info-area support-ticket-area">
                      <h4 class="mb-4"><?php echo e(__('Reply To Ticket')); ?></h4>

                      <form action="<?php echo e(route('user.support_ticket.reply', ['id' => $ticket->id])); ?>" method="POST"
                        enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
                        <div class="row">
                          <div class="col-lg-12 mb-4">
                            <textarea class="form-control" placeholder="<?php echo e(__('Write Your Reply Here') . '...'); ?>" name="reply" data-height="220"
                              autocomplete="off"></textarea>
                            <?php $__errorArgs = ['reply'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                              <p class="text-danger mt-2"><?php echo e($message); ?></p>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                          </div>

                          <div class="col-lg-12 mb-3">
                            <div class="form-group mb-1">
                              <label for="formFile" class="form-label"><?php echo e(__('Choose File')); ?></label>
                              <input type="file" class="form-control size-md w-100" id="formFile" name="attachment"
                                data-url="<?php echo e(route('user.support_tickets.store_temp_file')); ?>">
                            </div>
                            <div class="progress mt-3 mb-1 d-none">
                              <div class="progress-bar mdf_34322" role="progressbar"></div>
                            </div>
                            <small
                              id="attachment-info"><?php echo e('*' . __('Upload only .zip file') . '. ' . __('Max file size is 20 MB') . '.'); ?></small>
                            <?php $__errorArgs = ['attachment'];
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

                          <div class="col-lg-12">
                            <div class="form-button">
                              <button class="btn btn-md btn-primary radius-sm"><?php echo e(__('Submit')); ?></button>
                            </div>
                          </div>
                        </div>
                      </form>
                    </div>
                  <?php endif; ?>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!--====== End Support Tickets Section ======-->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\younes\Downloads\junspro-main (1)\junspro-main3\resources\views\frontend\user\ticket-conversation.blade.php ENDPATH**/ ?>