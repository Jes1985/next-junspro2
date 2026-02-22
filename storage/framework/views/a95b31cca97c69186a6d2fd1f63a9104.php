<?php $__env->startSection('content'); ?>
  <div class="page-header">
    <h4 class="page-title">
      <?php if(empty(request()->input('order_status'))): ?>
        <?php echo e(__('All Orders')); ?>

      <?php elseif(request()->input('order_status') == 'pending'): ?>
        <?php echo e(__('Pending Orders')); ?>

      <?php elseif(request()->input('order_status') == 'processing'): ?>
        <?php echo e(__('Processing Orders')); ?>

      <?php elseif(request()->input('order_status') == 'completed'): ?>
        <?php echo e(__('Completed Orders')); ?>

      <?php elseif(request()->input('order_status') == 'rejected'): ?>
        <?php echo e(__('Rejected Orders')); ?>

      <?php endif; ?>
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
        <a href="#"><?php echo e(__('Service Orders')); ?></a>
      </li>
      <li class="separator">
        <i class="flaticon-right-arrow"></i>
      </li>
      <li class="nav-item">
        <a href="#">
          <?php if(empty(request()->input('order_status'))): ?>
            <?php echo e(__('All Orders')); ?>

          <?php elseif(request()->input('order_status') == 'pending'): ?>
            <?php echo e(__('Pending Orders')); ?>

          <?php elseif(request()->input('order_status') == 'processing'): ?>
            <?php echo e(__('Processing Orders')); ?>

          <?php elseif(request()->input('order_status') == 'completed'): ?>
            <?php echo e(__('Completed Orders')); ?>

          <?php elseif(request()->input('order_status') == 'rejected'): ?>
            <?php echo e(__('Rejected Orders')); ?>

          <?php endif; ?>
        </a>
      </li>
    </ul>
  </div>

  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <div class="row">
            <div class="col-lg-10">
              <form id="searchForm" action="<?php echo e(route('admin.service_orders')); ?>" method="GET">
                <div class="row">
                  <div class="col-lg-3">
                    <div class="form-group">
                      <label><?php echo e(__('Order Number')); ?></label>
                      <input name="order_no" type="text" class="form-control" placeholder="Search Here..."
                        value="<?php echo e(!empty(request()->input('order_no')) ? request()->input('order_no') : ''); ?>">
                    </div>
                  </div>

                  <div class="col-lg-3">
                    <div class="form-group">
                      <label><?php echo e(__('Seller')); ?></label>
                      <select class="form-control mdb_343 select2" name="seller"
                        onchange="document.getElementById('searchForm').submit()">
                        <option value="" <?php echo e(empty(request()->input('seller')) ? 'selected' : ''); ?>>
                          <?php echo e(__('All')); ?>

                        </option>
                        <option value="admin" <?php if(request()->input('seller') == 'admin'): echo 'selected'; endif; ?>>
                          <?php echo e(__('Admin')); ?>

                        </option>
                        <?php $__currentLoopData = $sellers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $seller): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                          <option <?php if(request()->input('seller') == $seller->id): echo 'selected'; endif; ?> value="<?php echo e($seller->id); ?>"><?php echo e($seller->username); ?>

                          </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                      </select>
                    </div>
                  </div>

                  <div class="col-lg-3">
                    <div class="form-group">
                      <label><?php echo e(__('Payment')); ?></label>
                      <select class="form-control mdb_343" name="payment_status"
                        onchange="document.getElementById('searchForm').submit()">
                        <option value="" <?php echo e(empty(request()->input('payment_status')) ? 'selected' : ''); ?>>
                          <?php echo e(__('All')); ?>

                        </option>
                        <option value="completed"
                          <?php echo e(request()->input('payment_status') == 'completed' ? 'selected' : ''); ?>>
                          <?php echo e(__('Completed')); ?>

                        </option>
                        <option value="pending" <?php echo e(request()->input('payment_status') == 'pending' ? 'selected' : ''); ?>>
                          <?php echo e(__('Pending')); ?>

                        </option>
                        <option value="rejected"
                          <?php echo e(request()->input('payment_status') == 'rejected' ? 'selected' : ''); ?>>
                          <?php echo e(__('Rejected')); ?>

                        </option>
                      </select>
                    </div>
                  </div>

                  <div class="col-lg-3">
                    <div class="form-group">
                      <label><?php echo e(__('Order')); ?></label>
                      <select class="form-control mdb_343" name="order_status"
                        onchange="document.getElementById('searchForm').submit()">
                        <option value="" <?php echo e(empty(request()->input('order_status')) ? 'selected' : ''); ?>>
                          <?php echo e(__('All')); ?>

                        </option>
                        <option value="pending" <?php echo e(request()->input('order_status') == 'pending' ? 'selected' : ''); ?>>
                          <?php echo e(__('Pending')); ?>

                        </option>
                        <option value="processing"
                          <?php echo e(request()->input('order_status') == 'processing' ? 'selected' : ''); ?>>
                          <?php echo e(__('Processing')); ?>

                        </option>
                        <option value="completed"
                          <?php echo e(request()->input('order_status') == 'completed' ? 'selected' : ''); ?>>
                          <?php echo e(__('Completed')); ?>

                        </option>
                        <option value="rejected" <?php echo e(request()->input('order_status') == 'rejected' ? 'selected' : ''); ?>>
                          <?php echo e(__('Rejected')); ?>

                        </option>
                      </select>
                    </div>
                  </div>
                </div>
              </form>
            </div>

            <div class="col-lg-2">
              <button class="btn btn-danger btn-sm d-none bulk-delete float-lg-right card-header-button"
                data-href="<?php echo e(route('admin.service_orders.bulk_delete')); ?>">
                <i class="flaticon-interface-5"></i> <?php echo e(__('Delete')); ?>

              </button>
            </div>
          </div>
        </div>

        <div class="card-body">
          <div class="row">
            <div class="col-lg-12">
              <?php if(count($orders) == 0): ?>
                <h3 class="text-center mt-3"><?php echo e(__('NO ORDER FOUND') . '!'); ?></h3>
              <?php else: ?>
                <div class="table-responsive">
                  <table class="table table-striped mt-2">
                    <thead>
                      <tr>
                        <th scope="col">
                          <input type="checkbox" class="bulk-check" data-val="all">
                        </th>
                        <th scope="col"><?php echo e(__('Order No.')); ?></th>
                        <th scope="col"><?php echo e(__('Customer Name')); ?></th>
                        <th scope="col"><?php echo e(__('Seller')); ?></th>
                        <th scope="col"><?php echo e(__('Service')); ?></th>
                        <th scope="col"><?php echo e(__('Package')); ?></th>
                        <th scope="col"><?php echo e(__('Total Price')); ?></th>
                        <th scope="col"><?php echo e(__('Paid via')); ?></th>
                        <th scope="col"><?php echo e(__('Payment Status')); ?></th>
                        <th scope="col"><?php echo e(__('Order Status')); ?></th>
                        <th scope="col"><?php echo e(__('Actions')); ?></th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                          <td>
                            <input type="checkbox" class="bulk-check" data-val="<?php echo e($order->id); ?>">
                          </td>
                          <td><?php echo e('#' . $order->order_number); ?></td>

                          <?php $customerName = $order->name; ?>
                          <td><?php echo e($customerName); ?></td>
                          <td>
                            <?php if(!is_null($order->seller_id)): ?>
                              <a
                                href="<?php echo e(route('admin.seller_management.seller_details', ['id' => $order->seller_id, 'language' => $defaultLang->code])); ?>"><?php echo e(@$order->seller->username); ?></a>
                            <?php else: ?>
                              <span class="badge badge-success"><?php echo e(__('Admin')); ?></span>
                            <?php endif; ?>
                          </td>
                          <td>
                            <?php if(!empty($order->serviceSlug)): ?>
                              <a
                                href="<?php echo e(route('service_details', ['slug' => $order->serviceSlug, 'id' => $order->service_id])); ?>">
                                <?php echo e(strlen($order->serviceTitle) > 70 ? mb_substr($order->serviceTitle, 0, 70, 'UTF-8') . '...' : $order->serviceTitle); ?>

                              </a>
                            <?php else: ?>
                              <?php echo e('-'); ?>

                            <?php endif; ?>
                          </td>

                          <td>
                            <?php if(is_null($order->packageName)): ?>
                              <span class="ml-4">-</span>
                            <?php else: ?>
                              <?php echo e($order->packageName); ?>

                            <?php endif; ?>
                          </td>
                          <td>
                            <?php if(is_null($order->grand_total)): ?>
                              <?php echo e(__('Requested')); ?>

                            <?php else: ?>
                              <?php echo e($order->currency_symbol_position == 'left' ? $order->currency_symbol : ''); ?><?php echo e($order->grand_total); ?><?php echo e($order->currency_symbol_position == 'right' ? $order->currency_symbol : ''); ?>

                            <?php endif; ?>
                          </td>
                          <td>
                            <?php if(is_null($order->payment_method)): ?>
                              <span class="ml-4">-</span>
                            <?php else: ?>
                              <?php echo e($order->payment_method); ?>

                            <?php endif; ?>
                          </td>
                          <td>
                            <?php if($order->gateway_type == 'online'): ?>
                              <h2 class="d-inline-block">
                                <?php if($order->payment_status == 'completed'): ?>
                                  <span class="badge badge-success"><?php echo e(__('Completed')); ?></span>
                                <?php else: ?>
                                  <span class="badge badge-warning"><?php echo e(__('Pending')); ?></span>
                                <?php endif; ?>
                              </h2>
                            <?php else: ?>
                              <?php if($order->payment_status == 'pending'): ?>
                                <form id="paymentStatusForm-<?php echo e($order->id); ?>" class="d-inline-block"
                                  action="<?php echo e(route('admin.service_order.update_payment_status', ['id' => $order->id])); ?>"
                                  method="post">
                                  <?php echo csrf_field(); ?>
                                  <select
                                    class="form-control form-control-sm <?php if($order->payment_status == 'completed'): ?> bg-success <?php elseif($order->payment_status == 'pending'): ?> bg-warning text-dark <?php else: ?> bg-danger <?php endif; ?>"
                                    name="payment_status"
                                    onchange="document.getElementById('paymentStatusForm-<?php echo e($order->id); ?>').submit()">
                                    <option value="completed"
                                      <?php echo e($order->payment_status == 'completed' ? 'selected' : ''); ?>>
                                      <?php echo e(__('Completed')); ?>

                                    </option>
                                    <option value="pending" <?php echo e($order->payment_status == 'pending' ? 'selected' : ''); ?>>
                                      <?php echo e(__('Pending')); ?>

                                    </option>
                                    <option value="rejected"
                                      <?php echo e($order->payment_status == 'rejected' ? 'selected' : ''); ?>>
                                      <?php echo e(__('Rejected')); ?>

                                    </option>
                                  </select>
                                </form>
                              <?php else: ?>
                                <?php if($order->payment_status == 'completed'): ?>
                                  <span class="badge badge-success"><?php echo e(__('Completed')); ?></span>
                                <?php elseif($order->payment_status == 'pending'): ?>
                                  <span class="badge badge-warning"><?php echo e(__('Pending')); ?></span>
                                <?php else: ?>
                                  <span class="badge badge-danger"><?php echo e(__('Rejected')); ?></span>
                                <?php endif; ?>
                              <?php endif; ?>
                            <?php endif; ?>
                          </td>
                          <td>
                            <?php if($order->order_status == 'pending'): ?>
                              <form class="d-inline-block completeForm"
                                action="<?php echo e(route('admin.service_order.update_order_status', ['id' => $order->id])); ?>"
                                method="post">
                                <?php echo csrf_field(); ?>
                                <select
                                  class="form-control completeBtn form-control-sm <?php if($order->order_status == 'pending'): ?> bg-warning text-dark <?php elseif($order->order_status == 'processing'): ?> bg-primary <?php elseif($order->order_status == 'completed'): ?> bg-success <?php elseif($order->order_status == 'rejected'): ?> bg-danger <?php endif; ?>"
                                  name="order_status">
                                  <option disabled value="pending"
                                    <?php echo e($order->order_status == 'pending' ? 'selected' : ''); ?>>
                                    <?php echo e(__('Pending')); ?>

                                  </option>
                                  <option value="completed" <?php echo e($order->order_status == 'completed' ? 'selected' : ''); ?>>
                                    <?php echo e(__('Completed')); ?>

                                  </option>
                                  <option value="rejected" <?php echo e($order->order_status == 'rejected' ? 'selected' : ''); ?>>
                                    <?php echo e(__('Rejected')); ?>

                                  </option>
                                </select>
                              </form>
                            <?php else: ?>
                              <?php if($order->order_status == 'completed'): ?>
                                <span class="badge badge-success"><?php echo e(__('Completed')); ?></span>
                              <?php else: ?>
                                <span class="badge badge-danger"><?php echo e(__('Rejected')); ?></span>
                              <?php endif; ?>
                            <?php endif; ?>
                          </td>
                          <td>
                            <div class="dropdown">
                              <button class="btn btn-sm btn-secondary dropdown-toggle" type="button"
                                id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false">
                                <?php echo e(__('Select')); ?>

                              </button>

                              <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a href="<?php echo e(route('admin.service_order.details', ['id' => $order->id])); ?>"
                                  class="dropdown-item">
                                  <?php echo e(__('Details')); ?>

                                </a>

                                <?php if(!is_null($order->receipt)): ?>
                                  <a href="#" class="dropdown-item" data-toggle="modal"
                                    data-target="#receiptModal-<?php echo e($order->id); ?>">
                                    <?php echo e(__('Receipt')); ?>

                                  </a>
                                <?php endif; ?>

                                <?php if(!is_null($order->invoice)): ?>
                                  <a href="<?php echo e(asset('assets/file/invoices/service/' . $order->invoice)); ?>"
                                    class="dropdown-item" target="_blank">
                                    <?php echo e(__('Invoice')); ?>

                                  </a>
                                <?php endif; ?>

                                <a href="<?php echo e(route('admin.service_order.message', ['id' => $order->id])); ?>"
                                  class="dropdown-item">
                                  <?php echo e(__('Chat with customer')); ?>

                                </a>
                                <a href="<?php echo e('#emailModal-' . $order->id); ?>" data-toggle="modal"
                                  class="dropdown-item">
                                  <?php echo e(__('Send via Mail')); ?>

                                </a>
                                <form class="deleteForm d-block"
                                  action="<?php echo e(route('admin.service_order.delete', ['id' => $order->id])); ?>"
                                  method="post">
                                  <?php echo csrf_field(); ?>
                                  <button type="submit" class="deleteBtn">
                                    <?php echo e(__('Delete')); ?>

                                  </button>
                                </form>
                              </div>
                            </div>
                          </td>
                        </tr>
                        <!-- Email Modal -->
                        <?php if ($__env->exists('backend.client-service.order.send-mail')) echo $__env->make('backend.client-service.order.send-mail', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

                        <?php echo $__env->renderWhen($order->receipt, 'backend.client-service.order.show-receipt', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1])); ?>
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
              <?php echo e($orders->appends([
                      'order_no' => request()->input('order_no'),
                      'payment_status' => request()->input('payment_status'),
                      'order_status' => request()->input('order_status'),
                      'seller' => request()->input('seller'),
                  ])->links()); ?>

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\younes\Downloads\junspro-main (1)\junspro-main3\resources\views\backend\client-service\order\index.blade.php ENDPATH**/ ?>