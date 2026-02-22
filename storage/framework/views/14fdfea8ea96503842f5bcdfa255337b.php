<?php if ($__env->exists('backend.partials.rtl-style')) echo $__env->make('backend.partials.rtl-style', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<?php $__env->startSection('content'); ?>
  <div class="page-header">
    <h4 class="page-title"><?php echo e(__('Categories')); ?></h4>
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
        <a href="#"><?php echo e(__('Categories')); ?></a>
      </li>
    </ul>
  </div>

  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <div class="row">
            <div class="col-lg-4">
              <div class="card-title d-inline-block"><?php echo e(__('Service Categories')); ?></div>
            </div>

            <div class="col-lg-3">
              <?php if ($__env->exists('backend.partials.languages')) echo $__env->make('backend.partials.languages', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
            </div>

            <div class="col-lg-4 offset-lg-1 mt-2 mt-lg-0">
              <a href="#" data-toggle="modal" data-target="#createModal"
                class="btn btn-primary btn-sm float-lg-right float-left"><i class="fas fa-plus"></i>
                <?php echo e(__('Add')); ?></a>

              <button class="btn btn-danger btn-sm float-right mr-2 d-none bulk-delete"
                data-href="<?php echo e(route('admin.service_management.bulk_delete_category')); ?>">
                <i class="flaticon-interface-5"></i> <?php echo e(__('Delete')); ?>

              </button>
            </div>
          </div>
        </div>

        <div class="card-body">
          <div class="row">
            <div class="col-lg-12">
              <?php if(count($categories) == 0): ?>
                <h3 class="text-center mt-2"><?php echo e(__('NO CATEGORY FOUND') . '!'); ?></h3>
              <?php else: ?>
                <div class="table-responsive">
                  <table class="table table-striped mt-3" id="basic-datatables">
                    <thead>
                      <tr>
                        <th scope="col">
                          <input type="checkbox" class="bulk-check" data-val="all">
                        </th>
                        <th scope="col"><?php echo e(__('Image')); ?></th>
                        <th scope="col"><?php echo e(__('Name')); ?></th>
                        <th scope="col"><?php echo e(__('Status')); ?></th>
                        <th scope="col"><?php echo e(__('Serial Number')); ?></th>
                        <th scope="col"><?php echo e(__('Featured')); ?></th>
                        <th scope="col"><?php echo e(__('Add to Menu')); ?></th>
                        <th scope="col"><?php echo e(__('Actions')); ?></th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                          <td>
                            <input type="checkbox" class="bulk-check" data-val="<?php echo e($category->id); ?>">
                          </td>
                          <td>
                            <img src="<?php echo e(asset('assets/img/service-categories/' . $category->image)); ?>"
                              alt="category image" width="45">
                          </td>
                          <td>
                            <?php echo e(strlen($category->name) > 50 ? mb_substr($category->name, 0, 50, 'UTF-8') . '...' : $category->name); ?>

                          </td>
                          <td>
                            <?php if($category->status == 1): ?>
                              <h2 class="d-inline-block"><span class="badge badge-success"><?php echo e(__('Active')); ?></span>
                              </h2>
                            <?php else: ?>
                              <h2 class="d-inline-block"><span class="badge badge-danger"><?php echo e(__('Deactive')); ?></span>
                              </h2>
                            <?php endif; ?>
                          </td>
                          <td><?php echo e($category->serial_number); ?></td>
                          <td>
                            <form id="featuredForm-<?php echo e($category->id); ?>" class="d-inline-block"
                              action="<?php echo e(route('admin.service_management.category.update_featured_status', ['id' => $category->id])); ?>"
                              method="post">
                              <?php echo csrf_field(); ?>
                              <select
                                class="form-control form-control-sm <?php if($category->is_featured == 'yes'): ?> bg-success <?php else: ?> bg-danger <?php endif; ?>"
                                name="is_featured"
                                onchange="document.getElementById('featuredForm-<?php echo e($category->id); ?>').submit()">
                                <option value="yes" <?php echo e($category->is_featured == 'yes' ? 'selected' : ''); ?>>
                                  <?php echo e(__('Yes')); ?>

                                </option>
                                <option value="no" <?php echo e($category->is_featured == 'no' ? 'selected' : ''); ?>>
                                  <?php echo e(__('No')); ?>

                                </option>
                              </select>
                            </form>
                          </td>
                          <td>
                            <form id="addToMenuForm-<?php echo e($category->id); ?>" class="d-inline-block"
                              action="<?php echo e(route('admin.service_management.category.update_add_to_menu', ['id' => $category->id])); ?>"
                              method="post">
                              <?php echo csrf_field(); ?>
                              <select
                                class="form-control form-control-sm <?php if($category->add_to_menu == 1): ?> bg-success <?php else: ?> bg-danger <?php endif; ?>"
                                name="is_menu"
                                onchange="document.getElementById('addToMenuForm-<?php echo e($category->id); ?>').submit()">
                                <option value="1" <?php if($category->add_to_menu == 1): echo 'selected'; endif; ?>>
                                  <?php echo e(__('Yes')); ?>

                                </option>
                                <option value="0" <?php if($category->add_to_menu == 0): echo 'selected'; endif; ?>>
                                  <?php echo e(__('No')); ?>

                                </option>
                              </select>
                            </form>
                          </td>
                          <td>

                            <div class="dropdown">
                              <button class="btn btn-sm btn-secondary dropdown-toggle" type="button"
                                id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <?php echo e(__('Select')); ?>

                              </button>

                              <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a data-toggle="modal" data-target="#editModal" data-id="<?php echo e($category->id); ?>"
                                  data-image="<?php echo e(asset('assets/img/service-categories/' . $category->image)); ?>"
                                  data-name="<?php echo e($category->name); ?>" data-status="<?php echo e($category->status); ?>"
                                  data-serial_number="<?php echo e($category->serial_number); ?>"" class="dropdown-item editBtn">
                                  <?php echo e(__('Edit')); ?>

                                </a>

                                <form class="deleteForm d-block"
                                  action="<?php echo e(route('admin.service_management.delete_category', ['id' => $category->id])); ?>"
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

  
  <?php echo $__env->make('backend.client-service.category.create', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

  
  <?php echo $__env->make('backend.client-service.category.edit', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\younes\Downloads\junspro-main (1)\junspro-main3\resources\views\backend\client-service\category\index.blade.php ENDPATH**/ ?>