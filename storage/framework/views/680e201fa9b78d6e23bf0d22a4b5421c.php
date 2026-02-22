<?php if ($__env->exists('backend.partials.rtl-style')) echo $__env->make('backend.partials.rtl-style', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<?php $__env->startSection('content'); ?>
  <div class="page-header">
    <h4 class="page-title"><?php echo e(__('Addons')); ?></h4>
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
        <a href="#"><?php echo e(__('Service Management')); ?></a>
      </li>
      <li class="separator">
        <i class="flaticon-right-arrow"></i>
      </li>
      <li class="nav-item">
        <a href="<?php echo e(route('admin.service_management.services', ['language' => $defaultLang->code])); ?>">
          <?php echo e(__('Services')); ?>

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
        <a href="#"><?php echo e(__('Addons')); ?></a>
      </li>
    </ul>
  </div>

  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <div class="row">
            <div class="col-lg-4">
              <div class="card-title d-inline-block"><?php echo e(__('Addons')); ?></div>
            </div>

            <div class="col-lg-3">
              <?php if ($__env->exists('backend.partials.languages')) echo $__env->make('backend.partials.languages', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
            </div>

            <div class="col-lg-4 offset-lg-1 mt-2 mt-lg-0">
              <a href="<?php echo e(route('admin.service_management.services', ['language' => request()->input('language')])); ?>"
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
                data-href="<?php echo e(route('admin.service_management.service.bulk_delete_addon')); ?>">
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
              <?php if(count($addons) == 0): ?>
                <h3 class="text-center mt-2"><?php echo e(__('NO ADDON FOUND') . '!'); ?></h3>
              <?php else: ?>
                <div class="table-responsive">
                  <table class="table table-striped mt-3" id="basic-datatables">
                    <thead>
                      <tr>
                        <th scope="col">
                          <input type="checkbox" class="bulk-check" data-val="all">
                        </th>
                        <th scope="col"><?php echo e(__('Name')); ?></th>
                        <th scope="col"><?php echo e(__('Price')); ?></th>
                        <th scope="col"><?php echo e(__('Actions')); ?></th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $__currentLoopData = $addons; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $addon): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                          <td>
                            <input type="checkbox" class="bulk-check" data-val="<?php echo e($addon->id); ?>">
                          </td>
                          <td>
                            <?php echo e(strlen($addon->name) > 50 ? mb_substr($addon->name, 0, 50, 'UTF-8') . '...' : $addon->name); ?>

                          </td>
                          <td>
                            <?php echo e($position == 'left' ? $symbol : ''); ?><?php echo e($addon->price); ?><?php echo e($position == 'right' ? $symbol : ''); ?>

                          </td>
                          <td>
                            <a class="btn btn-secondary btn-sm mr-1  mb-1 editBtn" href="#" data-toggle="modal"
                              data-target="#editModal" data-id="<?php echo e($addon->id); ?>" data-name="<?php echo e($addon->name); ?>"
                              data-price="<?php echo e($addon->price); ?>">
                              <span class="btn-label">
                                <i class="fas fa-edit"></i>
                              </span>
                            </a>

                            <form class="deleteForm d-inline-block"
                              action="<?php echo e(route('admin.service_management.service.delete_addon', ['id' => $addon->id])); ?>"
                              method="post">
                              <?php echo csrf_field(); ?>
                              <button type="submit" class="btn btn-danger btn-sm mb-1 deleteBtn">
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

  
  <?php echo $__env->make('backend.client-service.addon.create', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

  
  <?php echo $__env->make('backend.client-service.addon.edit', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\younes\Downloads\junspro-main (1)\junspro-main3\resources\views\backend\client-service\addon\index.blade.php ENDPATH**/ ?>