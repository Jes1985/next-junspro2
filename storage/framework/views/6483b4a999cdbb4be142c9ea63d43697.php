<?php $__env->startSection('content'); ?>
  <div class="page-header">
    <h4 class="page-title"><?php echo e(__('Withdrawals')); ?></h4>
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
        <a href="#"><?php echo e(__('My Withdrawals')); ?></a>
      </li>
    </ul>
  </div>

  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <div class="row">

            <div class="col-lg-6">
              <div class="card-title d-inline-block">
                <?php echo e(__('My Balance')); ?> :
                <?php echo e($settings->base_currency_symbol_position == 'left' ? $settings->base_currency_symbol : ''); ?>

                <?php echo e(Auth::guard('seller')->user()->amount); ?>

                <?php echo e($settings->base_currency_symbol_position == 'right' ? $settings->base_currency_symbol : ''); ?>

              </div>
            </div>

            <div class="col-lg-6">

              <a href="<?php echo e(route('seller.withdraw.create', ['language' => $defaultLang->code])); ?>"
                class="btn btn-secondary btn-sm float-lg-right float-left">
                <i class="fas fa-donate"></i> <?php echo e(__('Make a Withdrawal Request')); ?>

              </a>

              <button class="btn btn-danger btn-sm float-right mr-2 d-none bulk-delete"
                data-href="<?php echo e(route('seller.witdraw.bulk_delete_withdraw')); ?>">
                <i class="flaticon-interface-5"></i> <?php echo e(__('Delete')); ?>

              </button>
            </div>
          </div>
        </div>
      </div>

      <div class="card-body">
        <div class="row">
          <div class="col-lg-12">

            <?php if(session()->has('course_status_warning')): ?>
              <div class="alert alert-warning">
                <p class="text-dark mb-0"><?php echo e(session()->get('course_status_warning')); ?></p>
              </div>
            <?php endif; ?>

            <div class="table-responsive">
              <?php if(count($collection) < 1): ?>
                <h2 class="text-center"><?php echo e(__('NO WITHDRAWAL REQUEST FOUND')); ?></h2>
              <?php else: ?>
                <table class="table table-striped mt-3" id="basic-datatables">
                  <thead>
                    <tr>
                      <th scope="col">
                        <input type="checkbox" class="bulk-check" data-val="all">
                      </th>
                      <th scope="col"><?php echo e(__('Withdraw Id')); ?></th>
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
                        <td>
                          <input type="checkbox" class="bulk-check" data-val="<?php echo e($item->id); ?>">
                        </td>
                        <td>
                          <?php echo e($item->withdraw_id); ?>

                        </td>
                        <td>
                          <?php echo e(optional($item->method)->name); ?>

                        </td>

                        <td>

                          <?php echo e($settings->base_currency_symbol_position == 'left' ? $settings->base_currency_symbol : ''); ?>

                          <?php echo e(round($item->amount, 2)); ?>

                          <?php echo e($settings->base_currency_symbol_position == 'right' ? $settings->base_currency_symbol : ''); ?>

                        </td>
                        <td>

                          <?php echo e($settings->base_currency_symbol_position == 'left' ? $settings->base_currency_symbol : ''); ?>

                          <?php echo e(round($item->total_charge, 2)); ?>

                          <?php echo e($settings->base_currency_symbol_position == 'right' ? $settings->base_currency_symbol : ''); ?>

                        </td>
                        <td>

                          <?php echo e($settings->base_currency_symbol_position == 'left' ? $settings->base_currency_symbol : ''); ?>

                          <?php echo e(round($item->payable_amount, 2)); ?>

                          <?php echo e($settings->base_currency_symbol_position == 'right' ? $settings->base_currency_symbol : ''); ?>

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
                            data-target="#withdrawModal<?php echo e($item->id); ?>" class="btn btn-primary btn-sm mb-1"><span
                              class="btn-label">
                              <i class="fas fa-eye"></i>
                            </span></a>
                          <form class="deleteForm d-inline-block"
                            action="<?php echo e(route('seller.witdraw.delete_withdraw', ['id' => $item->id])); ?>" method="post">

                            <?php echo csrf_field(); ?>
                            <button type="submit" class="btn btn-danger mb-1 btn-sm deleteBtn">
                              <span class="btn-label">
                                <i class="fas fa-trash"></i>
                              </span>
                            </button>
                          </form>
                        </td>
                      </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </tbody>
                </table>
              <?php endif; ?>
            </div>
          </div>
        </div>
      </div>

      <div class="card-footer"></div>
    </div>
  </div>
  </div>
  <?php $__currentLoopData = $collection; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div class="modal fade" id="withdrawModal<?php echo e($item->id); ?>" tabindex="-1" role="dialog"
      aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title" id="exampleModalLongTitle"><?php echo e(__('Withdraw Information')); ?></h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>

          <div class="modal-body">

            <div class="text-left">
              <p><strong><?php echo e(__('Payable Amount :')); ?>

                  <?php echo e($settings->base_currency_symbol_position == 'left' ? $settings->base_currency_symbol : ''); ?>

                  <?php echo e(round($item->payable_amount, 2)); ?>

                  <?php echo e($settings->base_currency_symbol_position == 'right' ? $settings->base_currency_symbol : ''); ?></strong>
              </p>
            </div>
            <?php
              $d_feilds = json_decode($item->feilds, true);
            ?>
            <?php $__currentLoopData = $d_feilds; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $d_feild): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <div class="text-left">
                <p><strong><?php echo e(str_replace('_', ' ', $key)); ?> : <?php echo e($d_feild); ?></strong></p>
              </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <div class="text-left">
              <p><strong><?php echo e(__('Additional Reference ') . ' : '); ?>

                  <?php echo e($item->additional_reference); ?></strong>
              </p>
            </div>

          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">
              <?php echo e(__('Close')); ?>

            </button>
          </div>
        </div>
      </div>
    </div>
  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('seller.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\younes\Downloads\junspro-main (1)\junspro-main3\resources\views\seller\withdraw\index.blade.php ENDPATH**/ ?>