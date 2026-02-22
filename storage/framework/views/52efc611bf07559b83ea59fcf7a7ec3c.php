<?php $__env->startSection('content'); ?>
  <div class="page-header">
    <h4 class="page-title"><?php echo e(__('Saved Codes')); ?></h4>
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
        <a href="#"><?php echo e(__('QR Codes')); ?></a>
      </li>
      <li class="separator">
        <i class="flaticon-right-arrow"></i>
      </li>
      <li class="nav-item">
        <a href="#"><?php echo e(__('Saved Codes')); ?></a>
      </li>
    </ul>
  </div>

  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <div class="row">
            <div class="col-lg-8">
              <div class="card-title d-inline-block"><?php echo e(__('Saved QR Codes')); ?></div>
            </div>

            <div class="col-lg-2 mt-2 mt-lg-0">
              <button class="btn btn-danger btn-sm float-right d-none bulk-delete"
                data-href="<?php echo e(route('admin.qr_codes.bulk_delete_qr')); ?>">
                <i class="flaticon-interface-5"></i> <?php echo e(__('Delete')); ?>

              </button>
            </div>
            <div class="col-lg-2">
              <form action="" method="GET">
                <input type="hidden" name="language" value="<?php echo e(request()->input('language')); ?>">
                <input type="hidden" name="title" value="<?php echo e(request()->input('title')); ?>">
                <select name="seller" id="" class="form-control select2" onchange="this.form.submit()">
                  <option selected disabled><?php echo e(__('Select Seller')); ?></option>
                  <option value="" selected><?php echo e(__('All')); ?></option>
                  <option value="admin" <?php if(request()->input('seller') == 'admin'): echo 'selected'; endif; ?>><?php echo e(__('Admin')); ?></option>
                  <?php $__currentLoopData = $sellers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $seller): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option <?php if($seller->id == request()->input('seller')): echo 'selected'; endif; ?> value="<?php echo e($seller->id); ?>"><?php echo e($seller->username); ?></option>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
              </form>
            </div>
          </div>
        </div>

        <div class="card-body">
          <div class="row">
            <div class="col-lg-12">
              <?php if(count($qrcodes) == 0): ?>
                <h3 class="text-center mt-2"><?php echo e(__('NO QR CODE FOUND') . '!'); ?></h3>
              <?php else: ?>
                <div class="table-responsive">
                  <table class="table table-striped mt-3" id="basic-datatables">
                    <thead>
                      <tr>
                        <th scope="col">
                          <input type="checkbox" class="bulk-check" data-val="all">
                        </th>
                        <th scope="col"><?php echo e(__('Name')); ?></th>
                        <th scope="col"><?php echo e(__('Seller')); ?></th>
                        <th scope="col"><?php echo e(__('QR Code')); ?></th>
                        <th scope="col"><?php echo e(__('URL')); ?></th>
                        <th scope="col"><?php echo e(__('Actions')); ?></th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $__currentLoopData = $qrcodes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $qrcode): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                          <td>
                            <input type="checkbox" class="bulk-check" data-val="<?php echo e($qrcode->id); ?>">
                          </td>
                          <td><?php echo e($qrcode->name); ?></td>
                          <td>
                            <?php if(!is_null($qrcode->seller_id)): ?>
                              <a
                                href="<?php echo e(route('admin.seller_management.seller_details', ['id' => $qrcode->seller_id, 'language' => $defaultLang->code])); ?>"><?php echo e(@$qrcode->seller->username); ?></a>
                            <?php else: ?>
                              <span class="badge badge-primary"><?php echo e(__('Admin')); ?></span>
                            <?php endif; ?>
                          </td>
                          <td>
                            <a href="#" data-toggle="modal" data-target="#showModal-<?php echo e($qrcode->id); ?>"
                              class="btn btn-primary btn-sm">
                              <i class="fas fa-eye"></i> <?php echo e(__('Show')); ?>

                            </a>
                          </td>
                          <td><?php echo e($qrcode->url); ?></td>
                          <td>
                            <a href="<?php echo e(asset('assets/img/qr-codes/' . $qrcode->image)); ?>"
                              class="btn btn-secondary btn-sm mr-1 mb-1" download="<?php echo e($qrcode->name . '.png'); ?>">
                              <i class="fas fa-download"></i> <?php echo e(__('Download')); ?>

                            </a>

                            <form class="deleteForm d-inline-block"
                              action="<?php echo e(route('admin.qr_codes.delete_qr', ['id' => $qrcode->id])); ?>" method="post">
                              <?php echo csrf_field(); ?>
                              <button type="submit" class="btn btn-danger btn-sm deleteBtn mb-1">
                                <span class="btn-label">
                                  <i class="fas fa-trash"></i>
                                </span>
                                <?php echo e(__('Delete')); ?>

                              </button>
                            </form>
                          </td>
                        </tr>

                        
                        <?php if ($__env->exists('backend.qr-code.show')) echo $__env->make('backend.qr-code.show', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\younes\Downloads\junspro-main (1)\junspro-main3\resources\views\backend\qr-code\saved-codes.blade.php ENDPATH**/ ?>