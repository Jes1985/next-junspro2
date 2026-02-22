<?php $__env->startSection('content'); ?>
  <div class="page-header">
    <h4 class="page-title"><?php echo e(__('Offline Gateways')); ?></h4>
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
        <a href="#"><?php echo e(__('Payment Gateways')); ?></a>
      </li>
      <li class="separator">
        <i class="flaticon-right-arrow"></i>
      </li>
      <li class="nav-item">
        <a href="#"><?php echo e(__('Offline Gateways')); ?></a>
      </li>
    </ul>
  </div>

  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <div class="row">
            <div class="col-lg-4">
              <div class="card-title d-inline-block"><?php echo e(__('Offline Gateways')); ?></div>
            </div>

            <div class="col-lg-4 offset-lg-4 mt-2 mt-lg-0">
              <a href="#" data-toggle="modal" data-target="#createModal" class="btn btn-primary btn-sm float-right"><i class="fas fa-plus"></i> <?php echo e(__('Add')); ?></a>
            </div>
          </div>
        </div>

        <div class="card-body">
          <div class="row">
            <div class="col-lg-12">
              <?php if(count($offlineGateways) == 0): ?>
                <h3 class="text-center"><?php echo e(__('NO OFFLINE PAYMENT GATEWAY FOUND!')); ?></h3>
              <?php else: ?>
                <div class="table-responsive">
                  <table class="table table-striped mt-3" id="basic-datatables">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col"><?php echo e(__('Gateway Name')); ?></th>
                        <th scope="col"><?php echo e(__('Status')); ?></th>
                        <th scope="col"><?php echo e(__('Serial Number')); ?></th>
                        <th scope="col"><?php echo e(__('Actions')); ?></th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $__currentLoopData = $offlineGateways; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $offlineGateway): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                          <td><?php echo e($loop->iteration); ?></td>
                          <td><?php echo e($offlineGateway->name); ?></td>
                          <td>
                            <form id="statusForm-<?php echo e($offlineGateway->id); ?>" class="d-inline-block" action="<?php echo e(route('admin.payment_gateways.update_status', ['id' => $offlineGateway->id])); ?>" method="post">
                              <?php echo csrf_field(); ?>
                              <select class="form-control form-control-sm <?php echo e($offlineGateway->status == 1 ? 'bg-success' : 'bg-danger'); ?>" name="status" onchange="document.getElementById('statusForm-<?php echo e($offlineGateway->id); ?>').submit();">
                                <option value="1" <?php echo e($offlineGateway->status == 1 ? 'selected' : ''); ?>>
                                  <?php echo e(__('Active')); ?>

                                </option>
                                <option value="0" <?php echo e($offlineGateway->status == 0 ? 'selected' : ''); ?>>
                                  <?php echo e(__('Deactive')); ?>

                                </option>
                              </select>
                            </form>
                          </td>
                          <td><?php echo e($offlineGateway->serial_number); ?></td>
                          <td>
                            <a class="btn btn-secondary btn-sm editBtn mr-1 mb-1" href="#editModal" data-toggle="modal" data-id="<?php echo e($offlineGateway->id); ?>" data-name="<?php echo e($offlineGateway->name); ?>" data-short_description="<?php echo e($offlineGateway->short_description); ?>" data-instructions="<?php echo e(replaceBaseUrl($offlineGateway->instructions, 'summernote')); ?>" data-has_attachment="<?php echo e($offlineGateway->has_attachment); ?>" data-serial_number="<?php echo e($offlineGateway->serial_number); ?>">
                              <span class="btn-label">
                                <i class="fas fa-edit"></i>
                              </span>

                            </a>

                            <form class="deleteForm d-inline-block" action="<?php echo e(route('admin.payment_gateways.delete_offline_gateway', ['id' => $offlineGateway->id])); ?>" method="post">
                              <?php echo csrf_field(); ?>
                              <button type="submit" class="btn btn-danger btn-sm deleteBtn mb-1">
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

  
  <?php echo $__env->make('backend.payment-gateways.offline-gateways.create', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

  
  <?php echo $__env->make('backend.payment-gateways.offline-gateways.edit', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\younes\Downloads\junspro-main (1)\junspro-main3\resources\views\backend\payment-gateways\offline-gateways\index.blade.php ENDPATH**/ ?>