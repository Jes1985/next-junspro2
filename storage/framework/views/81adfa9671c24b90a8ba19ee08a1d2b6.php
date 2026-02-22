<?php $__env->startSection('pageHeading'); ?>
  <?php echo e(__('Message')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
  <?php if ($__env->exists('frontend.partials.breadcrumb', ['breadcrumb' => $breadcrumb, 'title' => __('Message')])) echo $__env->make('frontend.partials.breadcrumb', ['breadcrumb' => $breadcrumb, 'title' => __('Message')], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
  <!--====== Start Live Chat ======-->
  <section class="user-dashboard pt-100 pb-60">
    <div class="container">
      <div class="row">
        <?php if ($__env->exists('frontend.user.side-navbar')) echo $__env->make('frontend.user.side-navbar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

        <div class="col-lg-9">
          <div id="reload-div">
            <div class="message-wrapper mb-40">
              <h4 class="mb-3">
                <?php echo e('#' . $order->order_number); ?> - <a
                  href="<?php echo e(route('service_details', ['slug' => $serviceInfo->slug, 'id' => $serviceInfo->service_id])); ?>"
                  class="link_22422"
                  target="_blank"><?php echo e(strlen($serviceInfo->title) > 35 ? mb_substr($serviceInfo->title, 0, 35, 'UTF-8') . '...' : $serviceInfo->title); ?></a>
              </h4>
              <div class="row">
                <div class="col-lg-12">
                  <div class="chat-wrapper-area">
                    <div class="chat-wrapper">
                      <?php if(count($messages) > 0): ?>
                        <?php $__currentLoopData = $messages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $msgInfo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                          <?php if($msgInfo->person_type == 'user'): ?>
                            <div class="chat-card mb-15">
                              <div class="chat-text">
                                <div class="content mb-15">
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
                                        <span class="me-2"><i
                                            class="far fa-arrow-alt-circle-down"></i></span><?php echo e($orgName); ?>

                                      </a>
                                      <br>
                                      <img src="<?php echo e(asset('assets/file/message-files/' . $unqName)); ?>" alt="image"
                                        width="150">
                                    <?php else: ?>
                                      <a href="<?php echo e(asset('assets/file/message-files/' . $unqName)); ?>"
                                        download="<?php echo e($orgName); ?>">
                                        <span class="me-2"><i
                                            class="far fa-arrow-alt-circle-down"></i></span><?php echo e($orgName); ?>

                                      </a>
                                    <?php endif; ?>
                                  <?php endif; ?>
                                </div>
                              </div>

                              <div class="thumb">
                                <img
                                  src="<?php echo e(empty($msgInfo->user->image) ? asset('assets/img/users/profile.jpeg') : asset('assets/img/users/' . $msgInfo->user->image)); ?>"
                                  alt="user">
                              </div>
                            </div>
                          <?php elseif($msgInfo->person_type == 'seller'): ?>
                            <div class="chat-card reply-chat mb-15">
                              <div class="thumb">
                                <img
                                  src="<?php echo e(empty($msgInfo->seller->photo) ? asset('assets/img/users/profile.jpeg') : asset('assets/admin/img/seller-photo/' . $msgInfo->seller->photo)); ?>"
                                  alt="admin">
                              </div>

                              <div class="chat-text">
                                <div class="content mb-15">
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
                                        <span class="me-2"><i
                                            class="far fa-arrow-alt-circle-down"></i></span><?php echo e($orgName); ?>

                                      </a>
                                      <br>
                                      <img src="<?php echo e(asset('assets/file/message-files/' . $unqName)); ?>" alt="image"
                                        width="150">
                                    <?php else: ?>
                                      <a href="<?php echo e(asset('assets/file/message-files/' . $unqName)); ?>"
                                        download="<?php echo e($orgName); ?>">
                                        <span class="me-2"><i
                                            class="far fa-arrow-alt-circle-down"></i></span><?php echo e($orgName); ?>

                                      </a>
                                    <?php endif; ?>
                                  <?php endif; ?>
                                </div>
                              </div>
                            </div>
                          <?php else: ?>
                            <div class="chat-card reply-chat mb-15">
                              <div class="thumb">
                                <img
                                  src="<?php echo e(empty($msgInfo->admin->image) ? asset('assets/img/users/profile.jpeg') : asset('assets/img/admins/' . $msgInfo->admin->image)); ?>"
                                  alt="admin">
                              </div>

                              <div class="chat-text">
                                <div class="content mb-15">
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
                                        <span class="me-2"><i
                                            class="far fa-arrow-alt-circle-down"></i></span><?php echo e($orgName); ?>

                                      </a>
                                      <br>
                                      <img src="<?php echo e(asset('assets/file/message-files/' . $unqName)); ?>" alt="image"
                                        width="150">
                                    <?php else: ?>
                                      <a href="<?php echo e(asset('assets/file/message-files/' . $unqName)); ?>"
                                        download="<?php echo e($orgName); ?>">
                                        <span class="me-2"><i
                                            class="far fa-arrow-alt-circle-down"></i></span><?php echo e($orgName); ?>

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

                    <div class="chat-bottom">
                      <form action="<?php echo e(route('user.service_order.store_message', ['id' => $order->id])); ?>" method="POST"
                        id="msg-form" autocomplete="off">
                        <?php echo csrf_field(); ?>
                        <div class="chat-input-group">
                          <label class="helper-form">
                            <input type="file" name="attachment" id="attachment" class="mdf_display_none">
                            <i class="far fa-paperclip"></i>

                            <div class="helper-text">
                              <h6 class="mb-2"><?php echo e(__('Allow file types')); ?></h6>
                              <ul class="helper-list">
                                <li><?php echo e(__('.jpg')); ?>,
                                  <?php echo e(__('.jpeg')); ?>,
                                  <?php echo e(__('.png')); ?>,
                                  <?php echo e(__('.rar')); ?>,
                                  <?php echo e(__('.zip')); ?>,
                                  <?php echo e(__('.txt')); ?>,
                                  <?php echo e(__('.doc')); ?>,
                                  <?php echo e(__('.docx')); ?>,
                                  <?php echo e(__('.pdf')); ?></li>
                              </ul>
                            </div>
                          </label>

                          <input type="text" name="msg" placeholder="<?php echo e(__('Type a message') . '...'); ?>"
                            autocomplete="off">

                          <div class="chat-send-button">
                            <button type="submit" id="chat-send-button"><i class="far fa-paper-plane"></i></button>
                          </div>
                        </div>

                      </form>
                      <div class="progress mt-2 d-none">
                        <div class="progress-bar" role="progressbar" style="width: 0%;" aria-valuenow="0"
                          aria-valuemin="0" aria-valuemax="100">0%</div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <p class="mt-4 text-danger" id="msg-err"></p>
        </div>
      </div>
    </div>
  </section>
  <!--====== End Live Chat ======-->
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
  <script src="https://js.pusher.com/7.2/pusher.min.js"></script>

  <script>
    let pusherKey = '<?php echo e($bs->pusher_key); ?>';
    let pusherCluster = '<?php echo e($bs->pusher_cluster); ?>';
  </script>
  <script type="text/javascript" src="<?php echo e(asset('assets/js/message.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\younes\Downloads\junspro-main (1)\junspro-main3\resources\views\frontend\user\service-order-message.blade.php ENDPATH**/ ?>