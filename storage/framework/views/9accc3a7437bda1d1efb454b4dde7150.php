<?php $__env->startSection('content'); ?>
  <div class="page-header">
    <h4 class="page-title"><?php echo e(__('Message')); ?></h4>
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
        <a href="#"><?php echo e(__('Service Orders')); ?></a>
      </li>
      <li class="separator">
        <i class="flaticon-right-arrow"></i>
      </li>
      <li class="nav-item">
        <a href="<?php echo e(route('admin.service_orders')); ?>"><?php echo e(__('All Orders')); ?></a>
      </li>
      <li class="separator">
        <i class="flaticon-right-arrow"></i>
      </li>
      <li class="nav-item">
        <a href="#"><?php echo e(__('Message')); ?></a>
      </li>
    </ul>
    <a href="<?php echo e(route('admin.service_orders')); ?>" class="btn btn-primary ml-auto"><?php echo e(__('Back')); ?></a>
  </div>

  <div class="row justify-content-center">
    <div class="col-8">
      <div class="card">
        <div class="card-body pb-0">
          <div id="reload-div">
            <div class="message-wrapper">
              <h4 class="mb-3">
                <?php echo e('#' . $order->order_number); ?> -
                <?php echo e(strlen($serviceInfo->title) > 50 ? mb_substr($serviceInfo->title, 0, 50, 'UTF-8') . '...' : $serviceInfo->title); ?>

              </h4>

              <div class="row">
                <div class="col-lg-12">
                  <div class="chat-wrapper-area">
                    <div class="chat-wrapper">
                      <?php if(count($messages) > 0): ?>
                        <?php $__currentLoopData = $messages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $msgInfo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                          <?php if($msgInfo->person_type == 'admin'): ?>
                            <div class="chat-card mdb-15">
                              <div class="chat-text">
                                <div class="content mdb-15">
                                  <?php if(!empty($msgInfo->message)): ?>
                                    <p><?php echo nl2br($msgInfo->message); ?></p>
                                  <?php else: ?>
                                    
                                    <?php
                                      $unqName = $msgInfo->file_name;
                                      $orgName = $msgInfo->file_original_name;

                                      if (strpos($orgName, '.jpg') == true || strpos($orgName, '.jpeg') == true || strpos($orgName, '.png') == true) {
                                          $isImg = true;
                                      } else {
                                          $isImg = false;
                                      }
                                    ?>

                                    <?php if($isImg == true): ?>
                                      <a href="<?php echo e(asset('assets/file/message-files/' . $unqName)); ?>"
                                        download="<?php echo e($orgName); ?>">
                                        <span class="mr-2"><i
                                            class="fas fa-arrow-alt-circle-down"></i></span><?php echo e($orgName); ?>

                                      </a>
                                      <br>
                                      <img src="<?php echo e(asset('assets/file/message-files/' . $unqName)); ?>" alt="image"
                                        width="150">
                                    <?php else: ?>
                                      <a href="<?php echo e(asset('assets/file/message-files/' . $unqName)); ?>"
                                        download="<?php echo e($orgName); ?>">
                                        <span class="mr-2"><i
                                            class="fas fa-arrow-alt-circle-down"></i></span><?php echo e($orgName); ?>

                                      </a>
                                    <?php endif; ?>
                                  <?php endif; ?>
                                </div>
                              </div>

                              <div class="thumb">
                                <img src="<?php echo e(asset('assets/img/admins/' . $msgInfo->admin->image)); ?>" alt="admin">
                              </div>
                            </div>
                          <?php elseif($msgInfo->person_type == 'seller'): ?>
                            <div class="chat-card mdb-15">
                              <div class="chat-text">
                                <div class="content mdb-15">
                                  <?php if(!empty($msgInfo->message)): ?>
                                    <p><?php echo nl2br($msgInfo->message); ?></p>
                                  <?php else: ?>
                                    
                                    <?php
                                      $unqName = $msgInfo->file_name;
                                      $orgName = $msgInfo->file_original_name;

                                      if (strpos($orgName, '.jpg') == true || strpos($orgName, '.jpeg') == true || strpos($orgName, '.png') == true) {
                                          $isImg = true;
                                      } else {
                                          $isImg = false;
                                      }
                                    ?>

                                    <?php if($isImg == true): ?>
                                      <a href="<?php echo e(asset('assets/file/message-files/' . $unqName)); ?>"
                                        download="<?php echo e($orgName); ?>">
                                        <span class="mr-2"><i
                                            class="fas fa-arrow-alt-circle-down"></i></span><?php echo e($orgName); ?>

                                      </a>
                                      <br>
                                      <img src="<?php echo e(asset('assets/file/message-files/' . $unqName)); ?>" alt="image"
                                        width="150">
                                    <?php else: ?>
                                      <a href="<?php echo e(asset('assets/file/message-files/' . $unqName)); ?>"
                                        download="<?php echo e($orgName); ?>">
                                        <span class="mr-2"><i
                                            class="fas fa-arrow-alt-circle-down"></i></span><?php echo e($orgName); ?>

                                      </a>
                                    <?php endif; ?>
                                  <?php endif; ?>
                                </div>
                              </div>

                              <div class="thumb">
                                <?php if(!is_null($msgInfo->seller->photo)): ?>
                                  <img src="<?php echo e(asset('assets/admin/img/seller-photo/' . $msgInfo->seller->photo)); ?>"
                                    alt="seller" title="<?php echo e(__('Seller')); ?>">
                                <?php else: ?>
                                  <img src="<?php echo e(asset('assets/img/blank-user.jpg')); ?>" alt="seller"
                                    title="<?php echo e(__('Seller')); ?>">
                                <?php endif; ?>
                              </div>
                            </div>
                          <?php else: ?>
                            <div class="chat-card reply-chat mdb-15">
                              <div class="thumb">
                                <?php if(!is_null($msgInfo->user->image)): ?>
                                  <img src="<?php echo e(asset('assets/img/users/' . $msgInfo->user->image)); ?>" alt="user">
                                <?php else: ?>
                                  <img src="<?php echo e(asset('assets/img/blank-user.jpg')); ?>" alt="user">
                                <?php endif; ?>

                              </div>

                              <div class="chat-text">
                                <div class="content mdb-15">
                                  <?php if(!empty($msgInfo->message)): ?>
                                    <p><?php echo nl2br($msgInfo->message); ?></p>
                                  <?php else: ?>
                                    
                                    <?php
                                      $unqName = $msgInfo->file_name;
                                      $orgName = $msgInfo->file_original_name;

                                      if (strpos($orgName, '.jpg') == true || strpos($orgName, '.jpeg') == true || strpos($orgName, '.png') == true) {
                                          $isImg = true;
                                      } else {
                                          $isImg = false;
                                      }
                                    ?>

                                    <?php if($isImg == true): ?>
                                      <a href="<?php echo e(asset('assets/file/message-files/' . $unqName)); ?>"
                                        download="<?php echo e($orgName); ?>">
                                        <span class="mr-2"><i
                                            class="fas fa-arrow-alt-circle-down"></i></span><?php echo e($orgName); ?>

                                      </a>
                                      <br>
                                      <img src="<?php echo e(asset('assets/file/message-files/' . $unqName)); ?>" alt="image"
                                        width="150">
                                    <?php else: ?>
                                      <a href="<?php echo e(asset('assets/file/message-files/' . $unqName)); ?>"
                                        download="<?php echo e($orgName); ?>">
                                        <span class="mr-2"><i
                                            class="fas fa-arrow-alt-circle-down"></i></span><?php echo e($orgName); ?>

                                      </a>
                                    <?php endif; ?>
                                  <?php endif; ?>
                                </div>
                              </div>
                            </div>
                          <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                      <?php endif; ?>
                    </div>

                    <?php if(is_null($order->seller_id)): ?>
                      <div class="chat-bottom">
                        <form action="<?php echo e(route('admin.service_order.store_message', ['id' => $order->id])); ?>"
                          method="POST" id="msg-form">
                          <?php echo csrf_field(); ?>
                          <div class="chat-input-group">
                            <input type="text" name="msg" placeholder="<?php echo e(__('Type a message') . '...'); ?>"
                              autocomplete="off">

                            <label id="file-input-label">
                              <input type="file" name="attachment" class="mdb_display_none">
                              <i class="fas fa-paperclip"
                                title="<?php echo e(__('Allow file types') . ': '); ?><?php echo e(__('.jpg, .jpeg, .png, .rar, .zip, .txt, .doc, .docx, .pdf')); ?>"
                                data-toggle="tooltip" data-placement="top"></i>
                            </label>
                          </div>

                          <div class="chat-send-button">
                            <button type="submit" clas><i class="fas fa-paper-plane"></i></button>
                          </div>
                        </form>
                        <div class="progress mt-2 d-none message-progress">
                          <div class="progress-bar" role="progressbar" style="width: 0%;" aria-valuenow="0"
                            aria-valuemin="0" aria-valuemax="100">0%</div>
                        </div>
                      </div>
                    <?php endif; ?>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <p class="mt-1 ml-2 text-danger" id="msg-err"></p>
        </div>
      </div>
    </div>
  </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
  <script type="text/javascript" src="<?php echo e(asset('assets/js/pusher.min.js')); ?>"></script>

  <script>
    let pusherKey = '<?php echo e($bs->pusher_key); ?>';
    let pusherCluster = '<?php echo e($bs->pusher_cluster); ?>';
  </script>
  <script type="text/javascript" src="<?php echo e(asset('assets/js/message.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\younes\Downloads\junspro-main (1)\junspro-main3\resources\views\backend\client-service\order\message.blade.php ENDPATH**/ ?>