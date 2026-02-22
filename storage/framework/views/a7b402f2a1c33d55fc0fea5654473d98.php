<?php $__env->startSection('content'); ?>
  <div class="page-header">
    <h4 class="page-title"><?php echo e(__('Partners Section')); ?></h4>
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
        <a href="#"><?php echo e(__('Home Page')); ?></a>
      </li>
      <li class="separator">
        <i class="flaticon-right-arrow"></i>
      </li>
      <li class="nav-item">
        <a href="#"><?php echo e(__('Partners Section')); ?></a>
      </li>
    </ul>
  </div>

  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <div class="row">
            <div class="col-lg-8">
              <div class="card-title d-inline-block"><?php echo e(__('Partners')); ?></div>
            </div>

            <div class="col-lg-4 mt-2 mt-lg-0">
              <a href="#" data-toggle="modal" data-target="#createModal" class="btn btn-primary btn-sm float-lg-right float-left">
                <i class="fas fa-plus"></i> <?php echo e(__('Add')); ?>

              </a>
            </div>
          </div>
        </div>

        <div class="card-body">
          <div class="row">
            <div class="col-md-12">
              <?php if(count($partners) == 0): ?>
                <h3 class="text-center mt-2"><?php echo e(__('NO PARTNER FOUND') . '!'); ?></h3>
              <?php else: ?>
                <div class="row">
                  <?php $__currentLoopData = $partners; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $partner): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-md-3">
                      <div class="card">
                        <div class="card-body">
                          <img src="<?php echo e(asset('assets/img/partners/' . $partner->image)); ?>" alt="image" class="mdb_100">
                        </div>

                        <div class="card-footer text-center">
                          <a class="editBtn btn btn-secondary btn-sm mr-2" href="#" data-toggle="modal" data-target="#editModal" data-id="<?php echo e($partner->id); ?>" data-image="<?php echo e(asset('assets/img/partners/' . $partner->image)); ?>" data-url="<?php echo e($partner->url); ?>" data-serial_number="<?php echo e($partner->serial_number); ?>">
                            <span class="btn-label">
                              <i class="fas fa-edit"></i>
                            </span>
                            <?php echo e(__('Edit')); ?>

                          </a>

                          <form class="deleteForm d-inline-block" action="<?php echo e(route('admin.home_page.delete_partner', ['id' => $partner->id])); ?>" method="post">
                            <?php echo csrf_field(); ?>
                            <button type="submit" class="btn btn-danger btn-sm deleteBtn">
                              <span class="btn-label">
                                <i class="fas fa-trash"></i>
                              </span>
                              <?php echo e(__('Delete')); ?>

                            </button>
                          </form>
                        </div>
                      </div>
                    </div>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
              <?php endif; ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  
  <?php if ($__env->exists('backend.home-page.partners.create')) echo $__env->make('backend.home-page.partners.create', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

  
  <?php if ($__env->exists('backend.home-page.partners.edit')) echo $__env->make('backend.home-page.partners.edit', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\younes\Downloads\junspro-main (1)\junspro-main3\resources\views\backend\home-page\partners\index.blade.php ENDPATH**/ ?>