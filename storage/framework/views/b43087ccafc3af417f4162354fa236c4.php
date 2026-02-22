<?php $__env->startSection('content'); ?>
  <div class="page-header">
    <h4 class="page-title"><?php echo e(__('Seller Details')); ?></h4>
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
        <a href="#"><?php echo e(__('Sellers Management')); ?></a>
      </li>
      <li class="separator">
        <i class="flaticon-right-arrow"></i>
      </li>
      <li class="nav-item">
        <a href="<?php echo e(route('admin.seller_management.registered_seller')); ?>"><?php echo e(__('Registered Sellers')); ?></a>
      </li>
      <li class="separator">
        <i class="flaticon-right-arrow"></i>
      </li>
      <li class="nav-item">
        <a href="#"><?php echo e(__('Seller Details')); ?></a>
      </li>
    </ul>
    <a href="<?php echo e(route('admin.seller_management.registered_seller')); ?>"
      class="btn btn-primary ml-auto"><?php echo e(__('Back')); ?></a>
  </div>

  <div class="row">
    <div class="col-md-12">
      <div class="row">

        <div class="col-md-4">
          <div class="card">
            <div class="card-header">
              <div class="h4 card-title"><?php echo e(__('Seller Information')); ?></div>
              <h2 class="text-center">
                <?php if($seller->photo != null): ?>
                  <img class="admin-seller-photo rounded-circle" src="<?php echo e(asset('assets/admin/img/seller-photo/' . $seller->photo)); ?>"
                    alt="..." class="uploaded-img">
                <?php else: ?>
                  <img class="admin-seller-photo rounded-circle" src="<?php echo e(asset('assets/img/blank-user.jpg')); ?>" alt="..."
                    class="uploaded-img">
                <?php endif; ?>

              </h2>
            </div>

            <div class="card-body">
              <div class="payment-information">

                <?php
                  $currPackage = \App\Http\Helpers\SellerPermissionHelper::currPackageOrPending($seller->id);
                  $currMemb = \App\Http\Helpers\SellerPermissionHelper::currMembOrPending($seller->id);
                ?>
                <div class="row mb-3">
                  <div class="col-lg-6">
                    <strong><?php echo e(__('Current Package:')); ?></strong>
                  </div>
                  <div class="col-lg-6">
                    <?php if($currPackage): ?>
                      <a target="_blank"
                        href="<?php echo e(route('admin.package.edit', $currPackage->id)); ?>"><?php echo e($currPackage->title); ?></a>
                      <span class="badge badge-secondary badge-xs mr-2"><?php echo e($currPackage->term); ?></span>
                      <button type="submit" class="btn btn-xs btn-warning" data-toggle="modal"
                        data-target="#editCurrentPackage"><i class="far fa-edit"></i></button>
                      <form action="<?php echo e(route('seller.currPackage.remove')); ?>" class="d-inline-block deleteForm"
                        method="POST">
                        <?php echo csrf_field(); ?>
                        <input type="hidden" name="seller_id" value="<?php echo e($seller->id); ?>">
                        <button type="submit" class="btn btn-xs btn-danger deleteBtn"><i
                            class="fas fa-trash"></i></button>
                      </form>

                      <p class="mb-0">
                        <?php if($currMemb->is_trial == 1): ?>
                          (<?php echo e(__('Expire Date') . ':'); ?>

                          <?php echo e(Carbon\Carbon::parse($currMemb->expire_date)->format('M-d-Y')); ?>)
                          <span class="badge badge-primary"><?php echo e(__('Trial')); ?></span>
                        <?php else: ?>
                          (<?php echo e(__('Expire Date') . ':'); ?>

                          <?php echo e($currPackage->term === 'lifetime' ? 'Lifetime' : Carbon\Carbon::parse($currMemb->expire_date)->format('M-d-Y')); ?>)
                        <?php endif; ?>
                        <?php if($currMemb->status == 0): ?>
                          <form id="statusForm<?php echo e($currMemb->id); ?>" class="d-inline-block"
                            action="<?php echo e(route('admin.payment-log.update')); ?>" method="post">
                            <?php echo csrf_field(); ?>
                            <input type="hidden" name="id" value="<?php echo e($currMemb->id); ?>">
                            <select class="form-control form-control-sm bg-warning" name="status"
                              onchange="document.getElementById('statusForm<?php echo e($currMemb->id); ?>').submit();">
                              <option value=0 selected><?php echo e(__('Pending')); ?></option>
                              <option value=1><?php echo e(__('Success')); ?></option>
                              <option value=2><?php echo e(__('Rejected')); ?></option>
                            </select>
                          </form>
                        <?php endif; ?>
                      </p>
                    <?php else: ?>
                      <a data-target="#addCurrentPackage" data-toggle="modal" class="btn btn-xs btn-primary text-white"><i
                          class="fas fa-plus"></i> <?php echo e(__('Add Package')); ?></a>
                    <?php endif; ?>
                  </div>
                </div>

                <?php
                  $nextPackage = \App\Http\Helpers\SellerPermissionHelper::nextPackage($seller->id);
                  $nextMemb = \App\Http\Helpers\SellerPermissionHelper::nextMembership($seller->id);
                ?>
                <div class="row mb-3">
                  <div class="col-lg-6">
                    <strong><?php echo e(__('Next Package:')); ?></strong>
                  </div>
                  <div class="col-lg-6">
                    <?php if($nextPackage): ?>
                      <a target="_blank"
                        href="<?php echo e(route('admin.package.edit', $nextPackage->id)); ?>"><?php echo e($nextPackage->title); ?></a>
                      <span class="badge badge-secondary badge-xs mr-2"><?php echo e($nextPackage->term); ?></span>
                      <button type="button" class="btn btn-xs btn-warning" data-toggle="modal"
                        data-target="#editNextPackage"><i class="far fa-edit"></i></button>
                      <form action="<?php echo e(route('seller.nextPackage.remove')); ?>" class="d-inline-block deleteForm"
                        method="POST">
                        <?php echo csrf_field(); ?>
                        <input type="hidden" name="seller_id" value="<?php echo e($seller->id); ?>">
                        <button type="submit" class="btn btn-xs btn-danger deleteBtn"><i
                            class="fas fa-trash"></i></button>
                      </form>

                      <p class="mb-0">
                        <?php if($currPackage->term != 'lifetime' && $nextMemb->is_trial != 1): ?>
                          (
                          Activation Date:
                          <?php echo e(Carbon\Carbon::parse($nextMemb->start_date)->format('M-d-Y')); ?>,
                          Expire Date:
                          <?php echo e($nextPackage->term === 'lifetime' ? 'Lifetime' : Carbon\Carbon::parse($nextMemb->expire_date)->format('M-d-Y')); ?>)
                        <?php endif; ?>
                        <?php if($nextMemb->status == 0): ?>
                          <form id="statusForm<?php echo e($nextMemb->id); ?>" class="d-inline-block"
                            action="<?php echo e(route('admin.payment-log.update')); ?>" method="post">
                            <?php echo csrf_field(); ?>
                            <input type="hidden" name="id" value="<?php echo e($nextMemb->id); ?>">
                            <select class="form-control form-control-sm bg-warning" name="status"
                              onchange="document.getElementById('statusForm<?php echo e($nextMemb->id); ?>').submit();">
                              <option value=0 selected><?php echo e(__('Pending')); ?></option>
                              <option value=1><?php echo e(__('Success')); ?></option>
                              <option value=2><?php echo e(__('Rejected')); ?></option>
                            </select>
                          </form>
                        <?php endif; ?>
                      </p>
                    <?php else: ?>
                      <?php if(!empty($currPackage)): ?>
                        <a class="btn btn-xs btn-primary text-white" data-toggle="modal"
                          data-target="#addNextPackage"><i class="fas fa-plus"></i> <?php echo e(__('Add  Package')); ?></a>
                      <?php else: ?>
                        -
                      <?php endif; ?>
                    <?php endif; ?>
                  </div>
                </div>

                <div class="row mb-2">
                  <div class="col-lg-4">
                    <strong><?php echo e(__('Name') . ' :'); ?></strong>
                  </div>
                  <div class="col-lg-8">
                    <?php echo e(@$seller->seller_info->name); ?>

                  </div>
                </div>

                <div class="row mb-2">
                  <div class="col-lg-4">
                    <strong><?php echo e(__('Username') . ' :'); ?></strong>
                  </div>
                  <div class="col-lg-8">
                    <?php echo e($seller->username); ?>

                  </div>
                </div>

                <div class="row mb-2">
                  <div class="col-lg-4">
                    <strong><?php echo e(__('Email') . ' :'); ?></strong>
                  </div>
                  <div class="col-lg-8">
                    <?php echo e($seller->email); ?>

                  </div>
                </div>

                <div class="row mb-2">
                  <div class="col-lg-4">
                    <strong><?php echo e(__('Phone') . ' :'); ?></strong>
                  </div>
                  <div class="col-lg-8">
                    <?php echo e($seller->phone); ?>

                  </div>
                </div>

                <div class="row mb-2">
                  <div class="col-lg-4">
                    <strong><?php echo e(__('Country') . ' :'); ?></strong>
                  </div>
                  <div class="col-lg-8">
                    <?php echo e(@$seller->seller_info->country); ?>

                  </div>
                </div>
                <div class="row mb-2">
                  <div class="col-lg-4">
                    <strong><?php echo e(__('City') . ' :'); ?></strong>
                  </div>
                  <div class="col-lg-8">
                    <?php echo e(@$seller->seller_info->city); ?>

                  </div>
                </div>
                <div class="row mb-2">
                  <div class="col-lg-4">
                    <strong><?php echo e(__('State') . ' :'); ?></strong>
                  </div>
                  <div class="col-lg-8">
                    <?php echo e(@$seller->seller_info->state); ?>

                  </div>
                </div>
                <div class="row mb-2">
                  <div class="col-lg-4">
                    <strong><?php echo e(__('Zip Code') . ' :'); ?></strong>
                  </div>
                  <div class="col-lg-8">
                    <?php echo e(@$seller->seller_info->zip_code); ?>

                  </div>
                </div>
                <div class="row mb-2">
                  <div class="col-lg-4">
                    <strong><?php echo e(__('Address') . ' :'); ?></strong>
                  </div>
                  <div class="col-lg-8">
                    <?php echo e(@$seller->seller_info->address); ?>

                  </div>
                </div>
                <div class="row mb-2">
                  <div class="col-lg-4">
                    <strong><?php echo e(__('Details') . ' :'); ?></strong>
                  </div>
                  <div class="col-lg-8">
                    <?php echo e(@$seller->seller_info->details); ?>

                  </div>
                </div>
                <div class="row mb-2">
                  <div class="col-lg-4">
                    <strong><?php echo e(__('Balance') . ' :'); ?></strong>
                  </div>
                  <div class="col-lg-8">
                    <?php echo e(symbolPrice(@$seller->amount)); ?>

                  </div>
                </div>

              </div>
            </div>
          </div>
        </div>
        <div class="col-md-8">
          <div class="card">
            <div class="card-header">
              <div class="row">
                <div class="col-lg-4">
                  <div class="card-title d-inline-block"><?php echo e(__('Services')); ?></div>
                </div>

                <div class="col-lg-3">
                  <?php if ($__env->exists('backend.partials.languages')) echo $__env->make('backend.partials.languages', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                </div>


                <div class="col-lg-4 offset-lg-1 mt-2 mt-lg-0">
                  <a href="<?php echo e(route('admin.service_management.create_service')); ?>"
                    class="btn btn-primary btn-sm float-right">
                    <i class="fas fa-plus"></i> <?php echo e(__('Add Service')); ?>

                  </a>

                  <button class="btn btn-danger btn-sm float-right mr-2 d-none bulk-delete"
                    data-href="<?php echo e(route('admin.service_management.bulk_delete_service')); ?>">
                    <i class="flaticon-interface-5"></i> <?php echo e(__('Delete')); ?>

                  </button>
                </div>
              </div>
            </div>

            <div class="card-body">
              <div class="row">
                <div class="col-lg-12">
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
                            <th scope="col"><?php echo e(__('Seller')); ?></th>
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
                                  href="<?php echo e(route('service_details', ['slug' => $service->slug, 'id' => $service->id])); ?>"><?php echo e(strlen($service->title) > 30 ? mb_substr($service->title, 0, 30, 'UTF-8') . '...' : $service->title); ?></a>
                              </td>
                              <td>
                                <?php if(!is_null($service->seller_id)): ?>
                                  <a target="_blank"
                                    href="<?php echo e(route('admin.seller_management.seller_details', ['id' => $service->seller_id, 'language' => $defaultLang->code])); ?>"><?php echo e(@$service->seller->username); ?></a>
                                <?php else: ?>
                                  <span class="badge badge-success"><?php echo e(__('Admin')); ?></span>
                                <?php endif; ?>
                              </td>
                              <td><?php echo e($service->categoryName); ?></td>
                              <td>
                                <?php if($service->quote_btn_status == 1): ?>
                                  <span class="ml-4">-</span>
                                <?php else: ?>
                                  <a href="<?php echo e(route('admin.service_management.service.packages', ['id' => $service->id, 'language' => request()->input('language')])); ?>"
                                    class="btn btn-primary btn-sm">
                                    <?php echo e(__('Manage')); ?>

                                  </a>
                                <?php endif; ?>
                              </td>
                              <td>
                                <?php if($service->quote_btn_status == 1): ?>
                                  <span class="ml-4">-</span>
                                <?php else: ?>
                                  <a href="<?php echo e(route('admin.service_management.service.addons', ['id' => $service->id, 'language' => request()->input('language')])); ?>"
                                    class="btn btn-primary btn-sm">
                                    <?php echo e(__('Manage')); ?>

                                  </a>
                                <?php endif; ?>
                              </td>
                              <td>
                                <form id="featuredForm-<?php echo e($service->id); ?>" class="d-inline-block"
                                  action="<?php echo e(route('admin.service_management.service.update_featured_status', ['id' => $service->id])); ?>"
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
                                    id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false">
                                    <?php echo e(__('Select')); ?>

                                  </button>

                                  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <a href="<?php echo e(route('admin.service_management.edit_service', ['id' => $service->id])); ?>"
                                      class="dropdown-item">
                                      <?php echo e(__('Edit')); ?>

                                    </a>

                                    <a href="<?php echo e(route('admin.service_management.service.faqs', ['id' => $service->id, 'language' => request()->input('language')])); ?>"
                                      class="dropdown-item">
                                      <?php echo e(__('FAQ')); ?>

                                    </a>

                                    <form class="deleteForm d-block"
                                      action="<?php echo e(route('admin.service_management.delete_service', ['id' => $service->id])); ?>"
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
    </div>
    <?php if ($__env->exists('backend.end-user.seller.edit-current-package')) echo $__env->make('backend.end-user.seller.edit-current-package', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    <?php if ($__env->exists('backend.end-user.seller.add-current-package')) echo $__env->make('backend.end-user.seller.add-current-package', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    <?php if ($__env->exists('backend.end-user.seller.edit-next-package')) echo $__env->make('backend.end-user.seller.edit-next-package', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    <?php if ($__env->exists('backend.end-user.seller.add-next-package')) echo $__env->make('backend.end-user.seller.add-next-package', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
  <?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\younes\Downloads\junspro-main (1)\junspro-main3\resources\views\backend\end-user\seller\details.blade.php ENDPATH**/ ?>