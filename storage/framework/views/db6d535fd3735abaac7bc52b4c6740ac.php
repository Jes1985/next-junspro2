<?php $title = __('Service Orders'); ?>

<?php $__env->startSection('pageHeading'); ?>
  <?php echo e($title); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
  <?php if ($__env->exists('frontend.partials.breadcrumb', ['breadcrumb' => $breadcrumb, 'title' => $title])) echo $__env->make('frontend.partials.breadcrumb', ['breadcrumb' => $breadcrumb, 'title' => $title], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

  <!--====== Start Service Orders Section ======-->
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
                    <h4><?php echo e(__('Order List')); ?></h4>
                  </div>

                  <div class="main-info">
                    <?php if(count($orders) == 0): ?>
                      <div class="row text-center mt-2">
                        <div class="col">
                          <h4><?php echo e(__('No Order Found') . '!'); ?></h4>
                        </div>
                      </div>
                    <?php else: ?>
                      <div class="main-table">
                        <div class="table-responsive">
                          <table id="user-datatable" class="table table-striped w-100">
                            <thead>
                              <tr>
                                <th><?php echo e(__('Order Number')); ?></th>
                                <th><?php echo e(__('Service')); ?></th>
                                <th><?php echo e(__('Date')); ?></th>
                                <th><?php echo e(__('Status')); ?></th>
                                <th><?php echo e(__('Action')); ?></th>
                              </tr>
                            </thead>
                            <tbody>
                              <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                  <td class="ps-3"><?php echo e('#' . $order->order_number); ?></td>
                                  <td class="ps-3">
                                    <?php
                                      $title = @$order->serviceInfo->title;
                                      $slug = @$order->serviceInfo->slug;
                                    ?>
                                    <?php if(!empty($slug)): ?>
                                      <a class="text-primary"
                                        href="<?php echo e(route('service_details', ['slug' => $slug, 'id' => $order->service_id])); ?>"
                                        target="_blank">
                                        <?php echo e(strlen($title) > 75 ? mb_substr($title, 0, 75, 'UTF-8') . '...' : $title); ?>

                                      </a>
                                    <?php endif; ?>
                                  </td>
                                  <td class="ps-3">
                                    <?php echo e(date_format($order->created_at, 'M d, Y')); ?>

                                  </td>
                                  <td>
                                    <?php if($order->order_status == 'pending' && $order->payment_status == 'completed'): ?>
                                      <form
                                        action="<?php echo e(route('user.service_order.confirm_order', ['id' => $order->id])); ?>"
                                        method="post" class="completeForm">
                                        <?php echo csrf_field(); ?>
                                        <select name="status" class="niceselect completeBtn">
                                          <option disabled <?php if($order->order_status == 'pending'): echo 'selected'; endif; ?> value="pending">
                                            <?php echo e(__('Pending')); ?>

                                          </option>
                                          <option value="completed"><?php echo e(__('Completed')); ?>

                                          </option>
                                        </select>
                                      </form>
                                    <?php else: ?>
                                      <?php if($order->order_status == 'completed'): ?>
                                        <span
                                          class="completed <?php echo e($currentLanguageInfo->direction == 1 ? 'me-2' : 'ms-2'); ?>" style="color: #4F46E5;"><b><?php echo e(__('Completed')); ?></b></span>
                                      <?php elseif($order->order_status == 'pending'): ?>
                                        <span
                                          class="rejected <?php echo e($currentLanguageInfo->direction == 1 ? 'me-2' : 'ms-2'); ?>"><b><?php echo e(__('Pending')); ?></b></span>
                                      <?php else: ?>
                                        <span
                                          class="rejected text-danger <?php echo e($currentLanguageInfo->direction == 1 ? 'me-2' : 'ms-2'); ?>"><b><?php echo e(__('Rejected')); ?></b></span>
                                      <?php endif; ?>
                                    <?php endif; ?>
                                  </td>
                                  <td class="ps-3">
                                    <div class="dropdown">
                                      <button class="btn btn-sm btn-primary rounded-1 dropdown-toggle dropdown_btn"
                                        type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        <?php echo e(__('Select')); ?>

                                      </button>
                                      <div class="dropdown-menu">
                                        <a class="dropdown-item font-sm"
                                          href="<?php echo e(route('user.service_order.details', ['id' => $order->id])); ?>"><?php echo e(__('Details')); ?></a>
                                        <?php if($order->payment_status == 'completed'): ?>
                                          <?php if(!is_null($order->seller_id)): ?>
                                            <?php
                                              $liveChatStatus = App\Http\Helpers\SellerPermissionHelper::getPackageInfoByMembership($order->seller_membership_id);
                                            ?>
                                            <?php if($liveChatStatus == true): ?>
                                              <a href="<?php echo e(route('user.service_order.message', ['id' => $order->id])); ?>"
                                                class="dropdown-item font-sm">
                                                <?php echo e(__('Chat with Seller')); ?>

                                              </a>
                                            <?php endif; ?>
                                          <?php else: ?>
                                            <a href="<?php echo e(route('user.service_order.message', ['id' => $order->id])); ?>"
                                              class="dropdown-item font-sm">
                                              <?php echo e(__('Chat with Seller')); ?>

                                            </a>
                                          <?php endif; ?>
                                        <?php endif; ?>

                                        <?php if($order->raise_status == 1): ?>
                                          <a href="<?php echo e(route('user.service_order.raise_request', ['id' => $order->id, 'status' => 0])); ?>"
                                            class="dropdown-item font-sm"><?php echo e(__('Cancel Dispute')); ?></a>
                                        <?php elseif($order->raise_status == 2): ?>
                                          <a href="#" class="dropdown-item font-sm"><?php echo e(__('Dispute Resolved')); ?></a>
                                        <?php elseif($order->raise_status == 3): ?>
                                          <a href="#" class="dropdown-item font-sm"><?php echo e(__('Dispute Rejected')); ?></a>
                                        <?php else: ?>
                                          <a href="<?php echo e(route('user.service_order.raise_request', ['id' => $order->id, 'status' => 1])); ?>"
                                            class="dropdown-item font-sm"><?php echo e(__('Raise Dispute')); ?></a>
                                        <?php endif; ?>
                                      </div>
                                    </div>


                                  </td>
                                </tr>
                              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                          </table>
                        </div>
                      </div>
                    <?php endif; ?>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!--====== End Service Orders Section ======-->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\younes\Downloads\junspro-main (1)\junspro-main3\resources\views\frontend\user\service-orders.blade.php ENDPATH**/ ?>