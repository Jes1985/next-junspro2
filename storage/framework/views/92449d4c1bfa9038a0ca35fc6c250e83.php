<?php if ($__env->exists('seller.partials.rtl-style')) echo $__env->make('seller.partials.rtl-style', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<?php $__env->startSection('content'); ?>
  <div class="page-header">
    <h4 class="page-title"><?php echo e(__('Packages')); ?></h4>
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
        <a href="#"><?php echo e(__('Service Management')); ?></a>
      </li>
      <li class="separator">
        <i class="flaticon-right-arrow"></i>
      </li>
      <li class="nav-item">
        <a href="<?php echo e(route('seller.service_management.services', ['language' => $defaultLang->code])); ?>">
          <?php echo e(__('Manage Services')); ?>

        </a>
      </li>
      <li class="separator">
        <i class="flaticon-right-arrow"></i>
      </li>
      <li class="nav-item">
        <a href="#">
          <?php echo e(strlen($serviceTitle) > 30 ? mb_substr($serviceTitle, 0, 30, 'UTF-8') . '...' : $serviceTitle); ?>

        </a>
      </li>
      <li class="separator">
        <i class="flaticon-right-arrow"></i>
      </li>
      <li class="nav-item">
        <a href="#"><?php echo e(__('Packages')); ?></a>
      </li>
    </ul>
  </div>

  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <div class="row">
            <div class="col-lg-4">
              <div class="card-title d-inline-block"><?php echo e(__('Packages')); ?></div>
            </div>

            <div class="col-lg-3">
              <?php if ($__env->exists('backend.partials.languages')) echo $__env->make('backend.partials.languages', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
            </div>

            <div class="col-lg-4 offset-lg-1 mt-2 mt-lg-0">
              <a href="<?php echo e(route('seller.service_management.services', ['language' => request()->input('language')])); ?>"
                class="btn btn-info btn-sm float-lg-right float-left">
                <span class="btn-label">
                  <i class="fas fa-backward mdb_12"></i>
                </span>
                <?php echo e(__('Back')); ?>

              </a>

              <a href="#" data-toggle="modal" data-target="#createModal"
                class="btn btn-primary btn-sm float-lg-right float-left mr-2">
                <i class="fas fa-plus"></i> <?php echo e(__('Add')); ?>

              </a>

              <button class="btn btn-danger btn-sm float-lg-right float-left mr-2 d-none bulk-delete"
                data-href="<?php echo e(route('seller.service_management.service.bulk_delete_package')); ?>">
                <i class="flaticon-interface-5"></i> <?php echo e(__('Delete')); ?>

              </button>
            </div>
          </div>
        </div>

        <?php
          $position = $currencyInfo->base_currency_symbol_position;
          $symbol = $currencyInfo->base_currency_symbol;
          $currencyText = $currencyInfo->base_currency_text;
        ?>

        <div class="card-body">
          <div class="row">
            <div class="col-lg-12">
              <?php if(count($packages) == 0): ?>
                <h3 class="text-center mt-2"><?php echo e(__('NO PACKAGE FOUND') . '!'); ?></h3>
              <?php else: ?>
                <div class="table-responsive">
                  <table class="table table-striped mt-3" id="basic-datatables">
                    <thead>
                      <tr>
                        <th scope="col">
                          <input type="checkbox" class="bulk-check" data-val="all">
                        </th>
                        <th scope="col"><?php echo e(__('Name')); ?></th>
                        <th scope="col"><?php echo e(__('Current Price')); ?></th>
                        <th scope="col"><?php echo e(__('Actions')); ?></th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $__currentLoopData = $packages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $package): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                          <td>
                            <input type="checkbox" class="bulk-check" data-val="<?php echo e($package->id); ?>">
                          </td>
                          <td>
                            <?php echo e(strlen($package->name) > 50 ? mb_substr($package->name, 0, 50, 'UTF-8') . '...' : $package->name); ?>

                          </td>
                          <td>
                            <?php echo e($position == 'left' ? $symbol : ''); ?><?php echo e($package->current_price); ?><?php echo e($position == 'right' ? $symbol : ''); ?>

                          </td>
                          <td>
                            <a class="btn btn-secondary btn-sm mr-1 editBtn" href="#" data-toggle="modal"
                              data-target="#editModal" data-id="<?php echo e($package->id); ?>" data-name="<?php echo e($package->name); ?>"
                              data-current_price="<?php echo e($package->current_price); ?>"
                              data-previous_price="<?php echo e($package->previous_price); ?>"
                              data-delivery_time="<?php echo e($package->delivery_time); ?>"
                              data-number_of_revision="<?php echo e($package->number_of_revision); ?>"
                              data-features="<?php echo e($package->features); ?>">
                              <span class="btn-label">
                                <i class="fas fa-edit"></i>
                              </span>
                              <?php echo e(__('Edit')); ?>

                            </a>

                            <form class="deleteForm d-inline-block"
                              action="<?php echo e(route('seller.service_management.service.delete_package', ['id' => $package->id])); ?>"
                              method="post">
                              <?php echo csrf_field(); ?>
                              <button type="submit" class="btn btn-danger btn-sm deleteBtn">
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
              <?php endif; ?>
            </div>
          </div>
        </div>

        <div class="card-footer"></div>
      </div>
    </div>
  </div>

  
  <?php echo $__env->make('seller.package.create', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

  
  <?php echo $__env->make('seller.package.edit', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('seller.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\younes\Downloads\junspro-main (1)\junspro-main3\resources\views\seller\package\index.blade.php ENDPATH**/ ?>