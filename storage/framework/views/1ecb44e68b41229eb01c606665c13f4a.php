<?php if ($__env->exists('backend.partials.rtl-style')) echo $__env->make('backend.partials.rtl-style', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<?php $__env->startSection('content'); ?>
    <div class="page-header">
        <h4 class="page-title"><?php echo e(__('Subcategories')); ?></h4>
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
                <a href="#"><?php echo e(__('Subcategories')); ?></a>
            </li>
        </ul>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="card-title d-inline-block"><?php echo e(__('Service Subcategories')); ?></div>
                        </div>

                        <div class="col-lg-3">
                            <?php if ($__env->exists('backend.partials.languages')) echo $__env->make('backend.partials.languages', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                        </div>

                        <div class="col-lg-4 offset-lg-1 mt-2 mt-lg-0">
                            <a href="#" data-toggle="modal" data-target="#createModal"
                                class="btn btn-primary btn-sm float-lg-right float-left"><i class="fas fa-plus"></i>
                                <?php echo e(__('Add')); ?></a>

                            <button class="btn btn-danger btn-sm float-right mr-2 d-none bulk-delete"
                                data-href="<?php echo e(route('admin.service_management.bulk_delete_subcategory')); ?>">
                                <i class="flaticon-interface-5"></i> <?php echo e(__('Delete')); ?>

                            </button>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <?php if(count($subcategories) == 0): ?>
                                <h3 class="text-center mt-2"><?php echo e(__('NO SUBCATEGORY FOUND') . '!'); ?></h3>
                            <?php else: ?>
                                <div class="table-responsive">
                                    <table class="table table-striped mt-3" id="basic-datatables">
                                        <thead>
                                            <tr>
                                                <th scope="col">
                                                    <input type="checkbox" class="bulk-check" data-val="all">
                                                </th>
                                                <th scope="col"><?php echo e(__('Name')); ?></th>
                                                <th scope="col"><?php echo e(__('Status')); ?></th>
                                                <th scope="col"><?php echo e(__('Category')); ?></th>
                                                <th scope="col"><?php echo e(__('Serial Number')); ?></th>
                                                <th scope="col"><?php echo e(__('Actions')); ?></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $__currentLoopData = $subcategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subcategory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr>
                                                    <td>
                                                        <input type="checkbox" class="bulk-check"
                                                            data-val="<?php echo e($subcategory->id); ?>">
                                                    </td>
                                                    <td>
                                                        <?php echo e(strlen($subcategory->name) > 50 ? mb_substr($subcategory->name, 0, 50, 'UTF-8') . '...' : $subcategory->name); ?>

                                                    </td>
                                                    <td>
                                                        <?php if($subcategory->status == 1): ?>
                                                            <h2 class="d-inline-block"><span
                                                                    class="badge badge-success"><?php echo e(__('Active')); ?></span>
                                                            </h2>
                                                        <?php else: ?>
                                                            <h2 class="d-inline-block"><span
                                                                    class="badge badge-danger"><?php echo e(__('Deactive')); ?></span>
                                                            </h2>
                                                        <?php endif; ?>
                                                    </td>
                                                    <td><?php echo e($subcategory->categoryName); ?></td>
                                                    <td><?php echo e($subcategory->serial_number); ?></td>
                                                    <td>

                                                        <div class="dropdown">
                                                            <button class="btn btn-sm btn-secondary dropdown-toggle"
                                                                type="button" id="dropdownMenuButton"
                                                                data-toggle="dropdown" aria-haspopup="true"
                                                                aria-expanded="false">
                                                                <?php echo e(__('Select')); ?>

                                                            </button>

                                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                                <a href="" class="dropdown-item editBtn"
                                                                    data-toggle="modal" data-target="#editModal"
                                                                    data-id="<?php echo e($subcategory->id); ?>"
                                                                    data-service_category_id="<?php echo e($subcategory->service_category_id); ?>"
                                                                    data-name="<?php echo e($subcategory->name); ?>"
                                                                    data-status="<?php echo e($subcategory->status); ?>"
                                                                    data-serial_number="<?php echo e($subcategory->serial_number); ?>">
                                                                    <?php echo e(__('Edit')); ?>

                                                                </a>

                                                                <form class="deleteForm d-block"
                                                                    action="<?php echo e(route('admin.service_management.delete_subcategory', ['id' => $subcategory->id])); ?>"
                                                                    method="post">
                                                                    <?php echo csrf_field(); ?>
                                                                    <button type="submit" class="deleteBtn">
                                                                        <?php echo e(__('Delete')); ?>

                                                                    </button>
                                                                </form>
                                                            </div>
                                                        </div>
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

    
    <?php echo $__env->make('backend.client-service.subcategory.create', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    
    <?php echo $__env->make('backend.client-service.subcategory.edit', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\younes\Downloads\junspro-main (1)\junspro-main3\resources\views\backend\client-service\subcategory\index.blade.php ENDPATH**/ ?>