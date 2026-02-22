<?php $__env->startSection('content'); ?>
  <div class="page-header">
    <h4 class="page-title">
      <?php echo e(__('Dispute Requests')); ?>

    </h4>
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
        <a href="#"><?php echo e(__('Dispute Requests')); ?></a>
      </li>
      <li class="separator">
        <i class="flaticon-right-arrow"></i>
      </li>
      <li class="nav-item">
        <a href="#">
          <?php echo e(__('Dispute Requests')); ?>

        </a>
      </li>
    </ul>
  </div>

  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <div class="row">
            <div class="col-md-8">
              <div class="card-title d-inline-block"><?php echo e(__('Dispute Requests')); ?></div>
            </div>
            <div class="col-md-4">
              <form action="" action="" method="GET">
                <div class="form-group">
                  <input name="order_no" type="text" class="form-control" placeholder="Order Number"
                    value="<?php echo e(!empty(request()->input('order_no')) ? request()->input('order_no') : ''); ?>">
                </div>
              </form>
            </div>
          </div>
        </div>

        <div class="card-body">
          <div class="row">
            <div class="col-lg-12">
              <?php if(count($collection) == 0): ?>
                <h3 class="text-center mt-3"><?php echo e(__('NO ORDER DISPUTES FOUND') . '!'); ?></h3>
              <?php else: ?>
                <div class="table-responsive">
                  <table class="table table-striped mt-2">
                    <thead>
                      <tr>
                        <th scope="col"><?php echo e(__('Order No.')); ?></th>
                        <th scope="col"><?php echo e(__('Customer Email')); ?></th>
                        <th scope="col"><?php echo e(__('Seller')); ?></th>
                        <th scope="col"><?php echo e(__('Service')); ?></th>
                        <th scope="col"><?php echo e(__('Disput Status')); ?></th>
                        <th scope="col"><?php echo e(__('Actions')); ?></th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $__currentLoopData = $collection; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                          <td><?php echo e('#' . $order->order_number); ?></td>

                          <?php $customerEmail = $order->email_address; ?>
                          <td><?php echo e($customerEmail); ?></td>
                          <td>
                            <?php if(!is_null($order->seller_id)): ?>
                              <a
                                href="<?php echo e(route('admin.seller_management.seller_details', ['id' => $order->seller_id, 'language' => $defaultLang->code])); ?>"><?php echo e(@$order->seller->username); ?></a>
                            <?php else: ?>
                              <span class="badge badge-success"><?php echo e(__('Admin')); ?></span>
                            <?php endif; ?>
                          </td>
                          <td><a
                              href="<?php echo e(route('service_details', ['slug' => $order->serviceSlug, 'id' => $order->service_id])); ?>">
                              <?php echo e(strlen($order->serviceTitle) > 35 ? mb_substr($order->serviceTitle, 0, 35, 'UTF-8') . '...' : $order->serviceTitle); ?>

                            </a>
                          </td>

                          <td>
                            <form id="orderStatusForm-<?php echo e($order->id); ?>" class="d-inline-block"
                              action="<?php echo e(route('admin.service_order.disput.update', ['id' => $order->id])); ?>"
                              method="post">
                              <?php echo csrf_field(); ?>
                              <select
                                class="form-control form-control-sm <?php if($order->raise_status == 1): ?> bg-warning text-dark <?php elseif($order->raise_status == 2): ?> bg-success <?php elseif($order->raise_status == 3): ?> bg-danger <?php endif; ?>"
                                name="raise_status"
                                onchange="document.getElementById('orderStatusForm-<?php echo e($order->id); ?>').submit()">
                                <option value="1" <?php if($order->raise_status == 1): echo 'selected'; endif; ?>>
                                  <?php echo e(__('Pending')); ?>

                                </option>
                                <option value="2" <?php if($order->raise_status == 2): echo 'selected'; endif; ?>>
                                  <?php echo e(__('Completed')); ?>

                                </option>
                                <option value="3" <?php if($order->raise_status == 3): echo 'selected'; endif; ?>>
                                  <?php echo e(__('Rejected')); ?>

                                </option>
                              </select>
                            </form>
                          </td>
                          <td>
                            <a href="<?php echo e(route('admin.service_order.details', ['id' => $order->id])); ?>"
                              class="btn btn-secondary btn-sm"><?php echo e(__('View Order')); ?></a>
                          </td>
                        </tr>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                  </table>
                </div>
              <?php endif; ?>
            </div>
          </div>
        </div>

        <div class="card-footer">
          <div class="mt-3 text-center">
            <div class="d-inline-block mx-auto">
              <?php echo e($collection->appends([
                      'order_no' => request()->input('order_no'),
                  ])->links()); ?>

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\younes\Downloads\junspro-main (1)\junspro-main3\resources\views\backend\client-service\order\disputs.blade.php ENDPATH**/ ?>