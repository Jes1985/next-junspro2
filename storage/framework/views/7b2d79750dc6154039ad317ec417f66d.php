<?php $__env->startSection('content'); ?>
  <div class="page-header">
    <h4 class="page-title"><?php echo e(__('Messages')); ?></h4>
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
        <a href="#"><?php echo e(__('Support Tickets')); ?></a>
      </li>
      <li class="separator">
        <i class="flaticon-right-arrow"></i>
      </li>
      <li class="nav-item">
        <a href="<?php echo e(route('seller.support_tickets')); ?>"><?php echo e(__('All Tickets')); ?></a>
      </li>
      <li class="separator">
        <i class="flaticon-right-arrow"></i>
      </li>
      <li class="nav-item">
        <a href="#"><?php echo e(__('Messages')); ?></a>
      </li>
    </ul>
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <div class="card-title d-inline-block">
            <?php echo e(__('Ticket') . ': #' . $ticket->id); ?>

          </div>

          <a class="btn btn-info btn-sm float-right d-inline-block" href="<?php echo e(route('seller.support_tickets')); ?>">
            <span class="btn-label">
              <i class="fas fa-backward mdb_12"></i>
            </span>
            <?php echo e(__('Back')); ?>

          </a>
        </div>

        <div class="card-body">
          <div class="row text-center">
            <div class="col-12">
              <h3 class="ticket-subject"><?php echo e($ticket->subject); ?></h3>
            </div>
          </div>

          <div class="row text-center mt-4">
            <div class="col-12">
              <?php if($ticket->status == 'pending'): ?>
                <span class="badge badge-warning"><?php echo e(__('Pending')); ?></span>
              <?php elseif($ticket->status == 'open'): ?>
                <span class="badge badge-success"><?php echo e(__('Open')); ?></span>
              <?php else: ?>
                <span class="badge badge-danger"><?php echo e(__('Closed')); ?></span>
              <?php endif; ?>

              <span class="badge badge-secondary ml-2"><?php echo e($ticket->created_at->format('M d, Y - h:i A')); ?></span>
            </div>
          </div>

          <div class="row justify-content-center mt-4 msg">
            <div class="col-8">
              <?php echo $ticket->message; ?>


              <?php if(!is_null($ticket->attachment)): ?>
                <div class="text-center mt-4">
                  <a href="<?php echo e(asset('assets/file/ticket-files/' . $ticket->attachment)); ?>" class="btn btn-info btn-sm"
                    download="file.zip">
                    <span class="btn-label">
                      <i class="fas fa-download mdb_12"></i>
                    </span>
                    <?php echo e(__('Attachment')); ?>

                  </a>
                </div>
              <?php endif; ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="<?php echo e($ticket->status != 'closed' ? 'col-lg-6' : 'col-12'); ?>">
      <div class="card">
        <div class="card-header">
          <div class="card-title d-inline-block"><?php echo e(__('Conversations')); ?></div>
        </div>

        <div class="card-body">
          <div class="row">
            <div class="col-12">
              <?php if(count($conversations) == 0): ?>
                <h5><?php echo e(__('No Conversation Found') . '!'); ?></h5>
              <?php else: ?>
                <div class="messages-container">
                  <?php $__currentLoopData = $conversations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $conversation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if($conversation->person_type == 'admin'): ?>
                      <?php $admin = $conversation->admin()->first(); ?>

                      <div class="single-message">
                        <div class="user-details">
                          <div class="user-img">
                            <img
                              src="<?php echo e(!is_null($admin->image) ? asset('assets/img/admins/' . $admin->image) : asset('assets/img/blank-user.jpg')); ?>"
                              alt="<?php echo e($admin->first_name . ' ' . $admin->last_name); ?>">
                          </div>

                          <div class="user-infos">
                            <h6 class="name"><?php echo e($admin->first_name . ' ' . $admin->last_name); ?></h6>
                            <span class="type"><i
                                class="fas fa-user mr-2"></i><?php echo e(is_null($admin->role_id) ? 'Super Admin' : $admin->role->name); ?></span>
                            <span
                              class="badge badge-secondary"><?php echo e($conversation->created_at->format('M d, Y - h:i A')); ?></span>
                          </div>
                        </div>

                        <div class="message">
                          <?php echo replaceBaseUrl($conversation->reply, 'summernote'); ?>

                        </div>

                        <?php if(!is_null($conversation->attachment)): ?>
                          <a href="<?php echo e(asset('assets/file/ticket-files/' . $conversation->attachment)); ?>"
                            download="support.zip" class="btn btn-sm btn-info mt-3">
                            <span class="btn-label">
                              <i class="fas fa-download mdb_12"></i>
                            </span>
                            <?php echo e(__('Attachment')); ?>

                          </a>
                        <?php endif; ?>
                      </div>
                    <?php else: ?>
                      <?php $seller = $conversation->seller()->first(); ?>
                      <div class="single-message">
                        <div class="user-details">
                          <div class="user-img">
                            <img
                              src="<?php echo e(!is_null($seller->photo) ? asset('assets/admin/img/seller-photo/' . $seller->photo) : asset('assets/img/blank-user.jpg')); ?>"
                              alt="<?php echo e($seller->username); ?>">
                          </div>

                          <div class="user-infos">
                            <h6 class="name"><?php echo e($seller->username); ?></h6>
                            <span class="type"><i class="fas fa-user mr-2"></i><?php echo e(__('Seller')); ?></span>
                            <span
                              class="badge badge-secondary"><?php echo e($conversation->created_at->format('M d, Y - h:i A')); ?></span>
                          </div>
                        </div>

                        <div class="message">
                          <?php echo replaceBaseUrl($conversation->reply, 'summernote'); ?>

                        </div>

                        <?php if(!is_null($conversation->attachment)): ?>
                          <a href="<?php echo e(asset('assets/file/ticket-files/' . $conversation->attachment)); ?>"
                            download="support.zip" class="btn btn-sm btn-info mt-3">
                            <span class="btn-label">
                              <i class="fas fa-download mdb_12"></i>
                            </span>
                            <?php echo e(__('Attachment')); ?>

                          </a>
                        <?php endif; ?>
                      </div>
                    <?php endif; ?>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
              <?php endif; ?>
            </div>
          </div>
        </div>
      </div>
    </div>

    <?php if($ticket->status == 'open'): ?>
      <div class="col-md-6">
        <div class="card">
          <div class="card-header">
            <div class="card-title d-inline-block"><?php echo e(__('Reply To Ticket')); ?></div>
          </div>

          <div class="card-body">
            <form id="replyForm" action="<?php echo e(route('seller.support_ticket.reply', ['id' => $ticket->id])); ?>"
              method="POST" enctype="multipart/form-data">
              <?php echo csrf_field(); ?>
              <div class="row">
                <div class="col-12">
                  <div class="form-group">
                    <textarea class="form-control summernote" name="reply" placeholder="Write Your Reply Here..." data-height="200"></textarea>
                    <?php $__errorArgs = ['reply'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                      <p class="mt-1 mb-0 text-danger"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                  </div>

                  <div class="form-group">
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" name="attachment">
                        <label class="custom-file-label"><?php echo e(__('Choose File')); ?></label>
                      </div>
                    </div>

                    <div class="progress mt-3 d-none">
                      <div class="progress-bar mdb_0" role="progressbar"></div>
                    </div>

                    <p id="attachment-info" class="mt-2 mb-0 text-warning">
                      <?php echo e('*' . __('Upload only .zip file.') . ' ' . __('Max file size is 20 MB.')); ?>

                    </p>

                    <?php $__errorArgs = ['attachment'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                      <p class="mt-1 mb-0 text-danger"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                  </div>
                </div>
              </div>
            </form>
          </div>

          <div class="card-footer">
            <div class="row">
              <div class="col-12 text-center">
                <button type="submit" class="btn btn-success" form="replyForm">
                  <?php echo e(__('Submit')); ?>

                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
    <?php endif; ?>
  </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
  <script src="<?php echo e(asset('assets/js/support-ticket.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('seller.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\younes\Downloads\junspro-main (1)\junspro-main3\resources\views\seller\support_ticket\messages.blade.php ENDPATH**/ ?>