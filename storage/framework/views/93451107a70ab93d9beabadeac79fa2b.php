<?php if ($__env->exists('backend.partials.rtl-style')) echo $__env->make('backend.partials.rtl-style', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<?php $__env->startSection('content'); ?>
  <div class="page-header">
    <h4 class="page-title"><?php echo e(__('Forms')); ?></h4>
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
        <a href="#"><?php echo e(__('Forms')); ?></a>
      </li>
    </ul>
  </div>

  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <div class="row">
            <div class="col-lg-4">
              <div class="card-title d-inline-block"><?php echo e(__('All Forms')); ?></div>
            </div>

            <div class="col-lg-2">
              <?php if ($__env->exists('backend.partials.languages')) echo $__env->make('backend.partials.languages', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
            </div>
            <div class="col-lg-2">
              <form action="" method="GET">
                <input type="hidden" name="language" value="<?php echo e(request()->input('language')); ?>">
                <select name="seller" id="" class="form-control select2" onchange="this.form.submit()">
                  <option value="" selected><?php echo e(__('All')); ?></option>
                  <option value="admin" <?php if(request()->input('seller') == 'admin'): echo 'selected'; endif; ?>><?php echo e(__('Admin')); ?></option>
                  <?php $__currentLoopData = $sellers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $seller): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option <?php if($seller->id == request()->input('seller')): echo 'selected'; endif; ?> value="<?php echo e($seller->id); ?>"><?php echo e($seller->username); ?></option>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
              </form>
            </div>

            <div class="col-lg-3 offset-lg-1 mt-2 mt-lg-0">
              <a href="#" data-toggle="modal" data-target="#createModal"
                class="btn btn-primary btn-sm float-lg-right float-left">
                <i class="fas fa-plus"></i> <?php echo e(__('Add')); ?>

              </a>
            </div>
          </div>
        </div>

        <div class="card-body">
          <div class="row">
            <div class="col-lg-12">
              <?php if(session()->has('error')): ?>
                <div class="alert alert-warning alert-block">
                  <strong class="text-dark"><?php echo e(session()->get('error')); ?></strong>
                  <button type="button" class="close" data-dismiss="alert">×</button>
                </div>
              <?php endif; ?>

              <?php if(count($forms) == 0): ?>
                <h3 class="text-center mt-2"><?php echo e(__('NO FORM FOUND') . '!'); ?></h3>
              <?php else: ?>
                <div class="table-responsive">
                  <table class="table table-striped mt-3" id="basic-datatables">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col"><?php echo e(__('Name')); ?></th>
                        <th scope="col"><?php echo e(__('Seller')); ?></th>
                        <th scope="col"><?php echo e(__('Form Inputs')); ?></th>
                        <th scope="col"><?php echo e(__('Actions')); ?></th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $__currentLoopData = $forms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $form): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                          <td><?php echo e($loop->iteration); ?></td>
                          <td><?php echo e($form->name); ?></td>
                          <td>
                            <?php if(!is_null($form->seller_id)): ?>
                              <a target="_blank"
                                href="<?php echo e(route('admin.seller_management.seller_details', ['id' => $form->seller_id, 'language' => $defaultLang->code])); ?>"><?php echo e(@$form->seller->username); ?></a>
                            <?php else: ?>
                              <?php echo e(__('Admin')); ?>

                            <?php endif; ?>
                          </td>
                          <td>
                            <a href="<?php echo e(route('admin.service_management.form.input', ['id' => $form->id, 'language' => request()->input('language')])); ?>"
                              class="btn btn-sm btn-info">
                              <?php echo e(__('Manage')); ?>

                            </a>
                          </td>
                          <td>
                            <a class="btn btn-secondary btn-sm editBtn mb-1" href="#" data-toggle="modal"
                              data-target="#editModal" data-id="<?php echo e($form->id); ?>" data-name="<?php echo e($form->name); ?>"
                              data-seller_id="<?php echo e($form->seller_id); ?>">
                              <span class="btn-label">
                                <i class="fas fa-edit"></i>
                              </span>
                            </a>

                            <form class="deleteForm d-inline-block"
                              action="<?php echo e(route('admin.service_management.delete_form', ['id' => $form->id])); ?>"
                              method="post">
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

  
  <?php if ($__env->exists('backend.client-service.form.create')) echo $__env->make('backend.client-service.form.create', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

  
  <?php if ($__env->exists('backend.client-service.form.edit')) echo $__env->make('backend.client-service.form.edit', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\younes\Downloads\junspro-main (1)\junspro-main3\resources\views\backend\client-service\form\index.blade.php ENDPATH**/ ?>