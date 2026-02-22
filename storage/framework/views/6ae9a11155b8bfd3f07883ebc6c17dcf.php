<?php $__env->startSection('content'); ?>
  <div class="page-header">
    <h4 class="page-title"><?php echo e(__('Withdraw Requests')); ?></h4>
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
        <a href="#"><?php echo e(__('Withdrawals Management')); ?></a>
      </li>
      <li class="separator">
        <i class="flaticon-right-arrow"></i>
      </li>
      <li class="nav-item">
        <a href="#"><?php echo e(__('Withdraw Requests')); ?></a>
      </li>
    </ul>
  </div>

  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <div class="row">
            <div class="col-lg-9">
              <div class="card-title d-inline-block"><?php echo e(__('Withdraw Requests')); ?></div>
            </div>
            <div class="col-lg-3">
              <form class="" action="<?php echo e(route('admin.withdraw.withdraw_request')); ?>" method="GET">
                <input name="search" type="text" class="form-control min-230 w-100"
                  placeholder="Search  withdraw id, method name" value="<?php echo e(request()->input('search')); ?>">
              </form>
            </div>
          </div>
        </div>

        <div class="card-body">
          <div class="row">
            <div class="col-lg-12">
              <?php if(count($collection) == 0): ?>
                <h3 class="text-center"><?php echo e(__('NO WITHDRAW REQUESTS FOUND') . '!'); ?></h3>
              <?php else: ?>
                <div class="table-responsive">
                  <table class="table table-striped mt-3">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th scope="col"><?php echo e(__('Withdraw Id')); ?></th>
                        <th scope="col"><?php echo e(__('Seller')); ?></th>
                        <th scope="col"><?php echo e(__('Method Name')); ?></th>
                        <th scope="col"><?php echo e(__('Total Amount')); ?></th>
                        <th scope="col"><?php echo e(__('Total Charge')); ?></th>
                        <th scope="col"><?php echo e(__('Total Payable Amount')); ?></th>
                        <th scope="col"><?php echo e(__('Status')); ?></th>
                        <th scope="col"><?php echo e(__('Action')); ?></th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $__currentLoopData = $collection; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                          <td><?php echo e($loop->iteration); ?></td>
                          <td># <?php echo e($item->withdraw_id); ?></td>
                          <?php
                            $seller = $item->seller()->first();
                          ?>
                          <td>
                            <?php if($seller): ?>
                              <a target="_blank"
                                href="<?php echo e(route('admin.seller_management.seller_details', ['id' => $seller->id, 'language' => $defaultLang->code])); ?>"><?php echo e($seller->username); ?></a>
                            <?php else: ?>
                              <?php echo e('-'); ?>

                            <?php endif; ?>
                          </td>
                          <td>
                            <?php echo e(optional($item->method)->name); ?>

                          </td>
                          <td>

                            <?php echo e($currencyInfo->base_currency_symbol_position == 'left' ? $currencyInfo->base_currency_symbol : ''); ?>

                            <?php echo e(round($item->amount, 2)); ?>

                            <?php echo e($currencyInfo->base_currency_symbol_position == 'right' ? $currencyInfo->base_currency_symbol : ''); ?>

                          </td>
                          <td>

                            <?php echo e($currencyInfo->base_currency_symbol_position == 'left' ? $currencyInfo->base_currency_symbol : ''); ?>

                            <?php echo e(round($item->total_charge, 2)); ?>

                            <?php echo e($currencyInfo->base_currency_symbol_position == 'right' ? $currencyInfo->base_currency_symbol : ''); ?>

                          </td>
                          <td>

                            <?php echo e($currencyInfo->base_currency_symbol_position == 'left' ? $currencyInfo->base_currency_symbol : ''); ?>

                            <?php echo e(round($item->payable_amount, 2)); ?>

                            <?php echo e($currencyInfo->base_currency_symbol_position == 'right' ? $currencyInfo->base_currency_symbol : ''); ?>

                          </td>
                          <td>
                            <?php if($item->status == 0): ?>
                              <span class="badge badge-warning"><?php echo e(__('Pending')); ?></span>
                            <?php elseif($item->status == 1): ?>
                              <span class="badge badge-success"><?php echo e(__('Approved')); ?></span>
                            <?php elseif($item->status == 2): ?>
                              <span class="badge badge-danger"><?php echo e(__('Declined')); ?></span>
                            <?php endif; ?>
                          </td>
                          <td>
                            <a href="javascript:void(0)" data-toggle="modal"
                              data-target="#withdrawModal<?php echo e($item->id); ?>" class="btn btn-primary btn-xs mb-1"><span
                                class="btn-label">
                                <i class="fas fa-eye"></i>
                              </span> <?php echo e(__('View')); ?></a>
                            <?php if($item->status == 0): ?>
                              <a href="<?php echo e(route('admin.witdraw.approve_withdraw', ['id' => $item->id])); ?>"
                                class="btn btn-success btn-xs mb-1 withdrawStatusBtn"><span class="btn-label">
                                  <i class="fas fa-check-circle"></i>
                                </span> <?php echo e(__('Approve')); ?></a>
                              <a href="<?php echo e(route('admin.witdraw.decline_withdraw', ['id' => $item->id])); ?>"
                                class="btn btn-warning mb-1 btn-xs withdrawStatusBtn"><span class="btn-label">
                                  <i class="fas fa-times"></i>
                                </span> <?php echo e(__('Decline')); ?></a>
                            <?php endif; ?>



                            <form class="deleteForm d-inline-block"
                              action="<?php echo e(route('admin.witdraw.delete_withdraw', ['id' => $item->id])); ?>" method="post">
                              <?php echo csrf_field(); ?>
                              <button type="submit" class="btn btn-danger mb-1 btn-xs deleteBtn">
                                <span class="btn-label">
                                  <i class="fas fa-trash"></i>
                                </span>
                                <?php echo e(__('Delete')); ?>

                              </button>
                            </form>
                          </td>
                        </tr>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                  </table>
                </div>
                <div class="">
                  <?php echo e($collection->appends([
                          'search' => request()->input('search'),
                      ])->links()); ?>

                </div>
              <?php endif; ?>
            </div>
          </div>
        </div>

        <div class="card-footer"></div>
      </div>
    </div>
  </div>

  
  <?php echo $__env->make('backend.withdraw.history.view', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\younes\Downloads\junspro-main (1)\junspro-main3\resources\views\backend\withdraw\history\index.blade.php ENDPATH**/ ?>