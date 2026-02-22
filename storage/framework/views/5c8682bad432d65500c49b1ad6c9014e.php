<?php $__env->startSection('content'); ?>
  <div class="page-header">
    <h4 class="page-title"><?php echo e(__('Services')); ?></h4>
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
        <a href="#"><?php echo e(__('Services')); ?></a>
      </li>
    </ul>
  </div>

  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <div class="row">
            <div class="col-lg-4">
              <div class="card-title d-inline-block"><?php echo e(__('Services')); ?></div>
            </div>

            <div class="col-lg-3">
              <?php if ($__env->exists('seller.partials.languages')) echo $__env->make('seller.partials.languages', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
            </div>

            <div class="col-lg-4 offset-lg-1 mt-2 mt-lg-0">
              <a href="<?php echo e(route('seller.service_management.create_service')); ?>"
                class="btn btn-primary btn-sm float-right">
                <i class="fas fa-plus"></i> <?php echo e(__('Add Service')); ?>

              </a>

              <button class="btn btn-danger btn-sm float-right mr-2 d-none bulk-delete"
                data-href="<?php echo e(route('seller.service_management.bulk_delete_service')); ?>">
                <i class="flaticon-interface-5"></i> <?php echo e(__('Delete')); ?>

              </button>
            </div>
          </div>
        </div>

        <div class="card-body">
          <div class="row">
            <div class="col-lg-12">
              <?php
                $data = sellerPermission(Auth::guard('seller')->user()->id, 'service');
                $data2 = sellerPermission(Auth::guard('seller')->user()->id, 'service-featured');
              ?>
              <?php if($data['status'] == 'package_false'): ?>
                <div class="alert alert-warning text-dark">
                  <?php echo e(__('Your membership is expired. Please purchase a new package / extend the current package.')); ?>

                </div>
              <?php else: ?>
                <?php if($data['status'] == 'false'): ?>
                  <div class="alert alert-warning alert-block">
                    <strong
                      class="text-dark"><?php echo e(__('Currently, you have added ' . $data['total_service_added'] . ' services. ' . 'Your current package supports ' . $data['package_support'] . ' services. Please delete ' . $data['total_service_added'] - $data['package_support'] . ' services  to enable service management')); ?></strong>
                  </div>
                <?php endif; ?>
                <?php if($data2['status'] == 'false'): ?>
                  <div class="alert alert-warning alert-block">
                    <strong
                      class="text-dark"><?php echo e(__('Currently, you have featured ' . $data2['total_service_featured'] . ' services. ' . 'Your current package supports ' . $data2['package_support'] . ' services to make featured. Please unfeatured ' . $data2['total_service_featured'] - $data2['package_support'] . ' services to enable service management')); ?></strong>
                  </div>
                <?php endif; ?>
              <?php endif; ?>

              <?php if(count($services) == 0): ?>
                <h3 class="text-center mt-2"><?php echo e(__('NO SERVICE FOUND') . '!'); ?></h3>
              <?php else: ?>
                <div class="table-responsive">
                  <table class="table table-striped mt-3" id="basic-datatables">
                    <thead>
                      <tr>
                        <th scope="col">
                          <input type="checkbox" class="bulk-check" data-val="all">
                        </th>
                        <th scope="col"><?php echo e(__('Title')); ?></th>
                        <th scope="col"><?php echo e(__('Category')); ?></th>
                        <th scope="col"><?php echo e(__('Packages')); ?></th>
                        <th scope="col"><?php echo e(__('Addons')); ?></th>
                        <th scope="col"><?php echo e(__('Featured')); ?></th>
                        <th scope="col"><?php echo e(__('Actions')); ?></th>
                      </tr>
                    </thead>
                    <tbody>

                      <?php $__currentLoopData = $services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                          <td>
                            <input type="checkbox" class="bulk-check" data-val="<?php echo e($service->id); ?>">
                          </td>
                          <td>
                            <a target="_blank"
                              href="<?php echo e(route('service_details', ['slug' => $service->slug, 'id' => $service->id])); ?>"><?php echo e(strlen($service->title) > 75 ? mb_substr($service->title, 0, 75, 'UTF-8') . '...' : $service->title); ?></a>
                          </td>
                          <td><?php echo e($service->categoryName); ?></td>
                          <td>
                            <?php if($service->quote_btn_status == 1): ?>
                              <span class="ml-4">-</span>
                            <?php else: ?>
                              <a <?php if($data['status'] == 'true'): ?> href="<?php echo e(route('seller.service_management.service.packages', ['id' => $service->id, 'language' => request()->input('language')])); ?>" <?php endif; ?>
                                class="btn btn-primary btn-sm ">
                                <?php echo e(__('Manage')); ?>

                              </a>
                            <?php endif; ?>
                          </td>
                          <td>
                            <?php if($service->quote_btn_status == 1): ?>
                              <span class="ml-4">-</span>
                            <?php else: ?>
                              <a <?php if($data['status'] == 'true' && $data2['status'] == 'true'): ?> href="<?php echo e(route('seller.service_management.service.addons', ['id' => $service->id, 'language' => request()->input('language')])); ?>" <?php endif; ?>
                                class="btn btn-primary btn-sm  ">
                                <?php echo e(__('Manage')); ?>

                              </a>
                            <?php endif; ?>
                          </td>
                          <td>
                            <form id="featuredForm-<?php echo e($service->id); ?>" class="d-inline-block"
                              action="<?php echo e(route('seller.service_management.service.update_featured_status', ['id' => $service->id])); ?>"
                              method="post">
                              <?php echo csrf_field(); ?>
                              <select
                                class="form-control form-control-sm <?php if($service->is_featured == 'yes'): ?> bg-success <?php else: ?> bg-danger <?php endif; ?>"
                                name="is_featured"
                                onchange="document.getElementById('featuredForm-<?php echo e($service->id); ?>').submit()">
                                <option value="yes" <?php echo e($service->is_featured == 'yes' ? 'selected' : ''); ?>>
                                  <?php echo e(__('Yes')); ?>

                                </option>
                                <option value="no" <?php echo e($service->is_featured == 'no' ? 'selected' : ''); ?>>
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
                                <a <?php if($data['status'] == 'true' && $data2['status'] == 'true'): ?> href="<?php echo e(route('seller.service_management.edit_service', ['id' => $service->id])); ?>" <?php endif; ?>
                                  class="dropdown-item ">
                                  <?php echo e(__('Edit')); ?>

                                </a>

                                <a href="<?php echo e(route('seller.service_management.service.faqs', ['id' => $service->id, 'language' => request()->input('language')])); ?>"
                                  class="dropdown-item">
                                  <?php echo e(__('FAQ')); ?>

                                </a>

                                <form class="deleteForm d-block"
                                  action="<?php echo e(route('seller.service_management.delete_service', ['id' => $service->id])); ?>"
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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('seller.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\younes\Downloads\junspro-main (1)\junspro-main3\resources\views\seller\service\index.blade.php ENDPATH**/ ?>