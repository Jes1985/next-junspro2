<?php $__env->startSection('content'); ?>
  <div class="page-header">
    <h4 class="page-title"><?php echo e(__('Withdrawals Management')); ?></h4>
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
        <a href="#"><?php echo e(__('Payment Methods')); ?></a>
      </li>
    </ul>
  </div>

  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <div class="row">
            <div class="col-lg-6">
              <div class="card-title d-inline-block"><?php echo e(__('Payment Methods')); ?></div>
            </div>

            <div class="col-lg-6 mt-2 mb-1 mt-lg-0">
              <a href="#" data-toggle="modal" data-target="#createModal"
                class="btn btn-primary btn-sm float-lg-right float-left"><i class="fas fa-plus"></i>
                <?php echo e(__('Add Payment Method')); ?></a>
            </div>

          </div>

        </div>

        <div class="card-body">
          <div class="row">
            <div class="col-lg-12">
              <?php if(count($collection) == 0): ?>
                <h3 class="text-center"><?php echo e(__('NO Withdraw Payment Methods FOUND') . '!'); ?></h3>
              <?php else: ?>
                <div class="table-responsive">
                  <table class="table table-striped mt-3" id="basic-datatables">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col"><?php echo e(__('Name')); ?></th>
                        <th scope="col"><?php echo e(__('Min Limit')); ?></th>
                        <th scope="col"><?php echo e(__('Max Limit')); ?></th>
                        <th scope="col"><?php echo e(__('Manage Form')); ?></th>
                        <th scope="col"><?php echo e(__('Status')); ?></th>
                        <th scope="col"><?php echo e(__('Actions')); ?></th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $__currentLoopData = $collection; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                          <td><?php echo e($loop->iteration); ?></td>
                          <td>
                            <?php echo e(strlen($item->name) > 30 ? mb_substr($item->name, 0, 30, 'UTF-8') . '...' : $item->name); ?>

                          </td>
                          <td><?php echo e($item->min_limit); ?></td>
                          <td><?php echo e($item->max_limit); ?></td>
                          <td><a class="btn btn-info btn-sm"
                              href="<?php echo e(route('admin.withdraw_payment_method.mange_input', ['id' => $item->id])); ?>"><?php echo e(__('Mange Form')); ?></a>
                          </td>
                          <td>
                            <?php if($item->status == 1): ?>
                              <h2 class="d-inline-block"><span class="badge badge-success"><?php echo e(__('Active')); ?></span>
                              </h2>
                            <?php else: ?>
                              <h2 class="d-inline-block"><span class="badge badge-danger"><?php echo e(__('Deactive')); ?></span>
                              </h2>
                            <?php endif; ?>
                          </td>

                          <td>
                            <a class="btn btn-secondary btn-sm mr-1 mb-1 editBtn" href="#" data-toggle="modal"
                              data-target="#editModal" data-id="<?php echo e($item->id); ?>" data-name="<?php echo e($item->name); ?>"
                              data-min_limit="<?php echo e($item->min_limit); ?>" data-max_limit="<?php echo e($item->max_limit); ?>"
                              data-status="<?php echo e($item->status); ?>" data-fixed_charge="<?php echo e($item->fixed_charge); ?>"
                              data-percentage_charge="<?php echo e($item->percentage_charge); ?>">
                              <span class="btn-label">
                                <i class="fas fa-edit"></i>
                              </span>
                            </a>

                            <form class="deleteForm d-inline-block"
                              action="<?php echo e(route('admin.withdraw_payment_method.delete', ['id' => $item->id])); ?>"
                              method="post">

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
                </div>
              <?php endif; ?>
            </div>
          </div>
        </div>

        <div class="card-footer"></div>
      </div>
    </div>
  </div>

  
  <?php echo $__env->make('backend.withdraw.create', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

  
  <?php echo $__env->make('backend.withdraw.edit', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\younes\Downloads\junspro-main (1)\junspro-main3\resources\views\backend\withdraw\index.blade.php ENDPATH**/ ?>