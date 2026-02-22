<?php $__env->startSection('content'); ?>
  <div class="page-header">
    <h4 class="page-title"><?php echo e(__('All Advertisement')); ?></h4>
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
        <a href="#"><?php echo e(__('Advertise')); ?></a>
      </li>
      <li class="separator">
        <i class="flaticon-right-arrow"></i>
      </li>
      <li class="nav-item">
        <a href="#"><?php echo e(__('All Advertisement')); ?></a>
      </li>
    </ul>
  </div>

  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <div class="row">
            <div class="col-lg-4">
              <div class="card-title d-inline-block"><?php echo e(__('All Advertisement')); ?></div>
            </div>

            <div class="col-lg-8 mt-2 mt-lg-0">
              <a href="#" data-toggle="modal" data-target="#createModal" class="btn btn-primary btn-sm float-lg-right float-left"><i class="fas fa-plus"></i> <?php echo e(__('Add')); ?></a>

              <button class="btn btn-danger float-right btn-sm mr-2 d-none bulk-delete" data-href="<?php echo e(route('admin.advertise.bulk_delete_advertisement')); ?>">
                <i class="flaticon-interface-5"></i> <?php echo e(__('Delete')); ?>

              </button>
            </div>
          </div>
        </div>

        <div class="card-body">
          <div class="row">
            <div class="col-lg-12">
              <?php if(count($ads) == 0): ?>
                <h3 class="text-center"><?php echo e(__('NO ADVERTISEMENT FOUND') . '!'); ?></h3>
              <?php else: ?>
                <div class="table-responsive">
                  <table class="table table-striped mt-3" id="basic-datatables">
                    <thead>
                      <tr>
                        <th scope="col">
                          <input type="checkbox" class="bulk-check" data-val="all">
                        </th>
                        <th scope="col"><?php echo e(__('Ad Type')); ?></th>
                        <th scope="col"><?php echo e(__('Resolution')); ?></th>
                        <th scope="col"><?php echo e(__('Image')); ?></th>
                        <th scope="col"><?php echo e(__('Views')); ?></th>
                        <th scope="col"><?php echo e(__('Actions')); ?></th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $__currentLoopData = $ads; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ad): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                          <td>
                            <input type="checkbox" class="bulk-check" data-val="<?php echo e($ad->id); ?>">
                          </td>
                          <td><?php echo e(ucfirst($ad->ad_type)); ?></td>
                          <td>
                            <?php if($ad->resolution_type == 1): ?>
                              300 x 250
                            <?php elseif($ad->resolution_type == 2): ?>
                              300 x 600
                            <?php elseif($ad->resolution_type == 3): ?>
                              728 x 90
                            <?php elseif($ad->resolution_type == 4): ?>
                             370 x 250
                            <?php else: ?>
                            370 x 600
                            <?php endif; ?>
                          </td>
                          <td>
                            <?php if($ad->ad_type == 'banner'): ?>
                              <img src="<?php echo e(asset('assets/img/advertisements/' . $ad->image)); ?>" alt="ad image" width="45">
                            <?php else: ?>
                              -
                            <?php endif; ?>
                          </td>
                          <td><?php echo e($ad->views); ?></td>
                          <td>
                            <a class="btn btn-secondary btn-sm mr-1 editBtn mb-1" href="#" data-toggle="modal" data-target="#editModal" data-id="<?php echo e($ad->id); ?>" data-ad_type="<?php echo e($ad->ad_type); ?>" data-resolution_type="<?php echo e($ad->resolution_type); ?>" data-image="<?php echo e($ad->ad_type == 'banner' ? asset('assets/img/advertisements/' . $ad->image) : asset('assets/img/noimage.jpg')); ?>" data-url="<?php echo e($ad->url); ?>" data-slot="<?php echo e($ad->slot); ?>" data-edit="editAdvertisement">
                              <span class="btn-label">
                                <i class="fas fa-edit"></i>
                              </span>
   
                            </a>

                            <form class="deleteForm d-inline-block" action="<?php echo e(route('admin.advertise.delete_advertisement', ['id' => $ad->id])); ?>" method="post">
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

  
  <?php echo $__env->make('backend.advertisement.create', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

  
  <?php echo $__env->make('backend.advertisement.edit', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
  <script type="text/javascript" src="<?php echo e(asset('assets/js/admin-partial.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\younes\Downloads\junspro-main (1)\junspro-main3\resources\views\backend\advertisement\index.blade.php ENDPATH**/ ?>