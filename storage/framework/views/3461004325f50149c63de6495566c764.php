<?php $__env->startSection('content'); ?>
  <div class="page-header">
    <h4 class="page-title"><?php echo e(__('Registered seller')); ?></h4>
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
        <a href="#"><?php echo e(__('Registered Sellers')); ?></a>
      </li>
    </ul>
  </div>

  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <div class="row">
            <div class="col-lg-6">
              <div class="card-title"><?php echo e(__('Registered Sellers')); ?></div>
            </div>

            <div class="col-lg-3">
              <button class="btn btn-danger btn-sm float-right d-none bulk-delete mr-2 ml-3 mt-1"
                data-href="<?php echo e(route('admin.seller_management.bulk_delete_seller')); ?>">
                <i class="flaticon-interface-5"></i> <?php echo e(__('Delete')); ?>

              </button>
            </div>

            <div class="col-lg-3">
              <form class="float-right w-100" action="<?php echo e(route('admin.seller_management.registered_seller')); ?>" method="GET">
                <input name="info" type="text" class="form-control min-230"
                  placeholder="Search By Username or Email ID"
                  value="<?php echo e(!empty(request()->input('info')) ? request()->input('info') : ''); ?>">
              </form>
            </div>
          </div>
        </div>

        <div class="card-body">
          <div class="row">
            <div class="col-lg-12">
              <?php if(count($sellers) == 0): ?>
                <h3 class="text-center"><?php echo e(__('NO SELLER FOUND') . '!'); ?></h3>
              <?php else: ?>
                <div class="table-responsive">
                  <table class="table table-striped mt-3">
                    <thead>
                      <tr>
                        <th scope="col">
                          <input type="checkbox" class="bulk-check" data-val="all">
                        </th>
                        <th scope="col"><?php echo e(__('Username')); ?></th>
                        <th scope="col"><?php echo e(__('Email ID')); ?></th>
                        <th scope="col"><?php echo e(__('Phone')); ?></th>
                        <th scope="col"><?php echo e(__('Account Status')); ?></th>
                        <th scope="col"><?php echo e(__('Email Status')); ?></th>
                        <th scope="col"><?php echo e(__('Actions')); ?></th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $__currentLoopData = $sellers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $seller): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                          <td>
                            <input type="checkbox" class="bulk-check" data-val="<?php echo e($seller->id); ?>">
                          </td>
                          <td><?php echo e($seller->username); ?></td>
                          <td><?php echo e($seller->email); ?></td>
                          <td><?php echo e(empty($seller->phone) ? '-' : $seller->phone); ?></td>
                          <td>
                            <form id="accountStatusForm-<?php echo e($seller->id); ?>" class="d-inline-block"
                              action="<?php echo e(route('admin.seller_management.seller.update_account_status', ['id' => $seller->id])); ?>"
                              method="post">
                              <?php echo csrf_field(); ?>
                              <select
                                class="form-control form-control-sm <?php echo e($seller->status == 1 ? 'bg-success' : 'bg-danger'); ?>"
                                name="account_status"
                                onchange="document.getElementById('accountStatusForm-<?php echo e($seller->id); ?>').submit()">
                                <option value="1" <?php echo e($seller->status == 1 ? 'selected' : ''); ?>>
                                  <?php echo e(__('Active')); ?>

                                </option>
                                <option value="0" <?php echo e($seller->status == 0 ? 'selected' : ''); ?>>
                                  <?php echo e(__('Deactive')); ?>

                                </option>
                              </select>
                            </form>
                          </td>
                          <td>
                            <form id="emailStatusForm-<?php echo e($seller->id); ?>" class="d-inline-block"
                              action="<?php echo e(route('admin.seller_management.seller.update_email_status', ['id' => $seller->id])); ?>"
                              method="post">
                              <?php echo csrf_field(); ?>
                              <select
                                class="form-control form-control-sm <?php echo e($seller->email_verified_at != null ? 'bg-success' : 'bg-danger'); ?>"
                                name="email_status"
                                onchange="document.getElementById('emailStatusForm-<?php echo e($seller->id); ?>').submit()">
                                <option value="1" <?php echo e($seller->email_verified_at != null ? 'selected' : ''); ?>>
                                  <?php echo e(__('Verified')); ?>

                                </option>
                                <option value="0" <?php echo e($seller->email_verified_at == null ? 'selected' : ''); ?>>
                                  <?php echo e(__('Unverified')); ?>

                                </option>
                              </select>
                            </form>
                          </td>
                          <td>
                            <div class="dropdown">
                              <button class="btn btn-secondary dropdown-toggle btn-sm" type="button"
                                id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <?php echo e(__('Select')); ?>

                              </button>

                              <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a href="<?php echo e(route('admin.seller_management.seller_details', ['id' => $seller->id, 'language' => $defaultLang->code])); ?>"
                                  class="dropdown-item">
                                  <?php echo e(__('Details & Package')); ?>

                                </a>

                                <a href="<?php echo e(route('admin.edit_management.seller_edit', ['id' => $seller->id])); ?>"
                                  class="dropdown-item">
                                  <?php echo e(__('Edit')); ?>

                                </a>

                                <a href="<?php echo e(route('admin.seller_management.seller.change_password', ['id' => $seller->id])); ?>"
                                  class="dropdown-item">
                                  <?php echo e(__('Change Password')); ?>

                                </a>

                                <form class="deleteForm d-block"
                                  action="<?php echo e(route('admin.seller_management.seller.delete', ['id' => $seller->id])); ?>"
                                  method="post">
                                  <?php echo csrf_field(); ?>
                                  <button type="submit" class="deleteBtn">
                                    <?php echo e(__('Delete')); ?>

                                  </button>
                                </form>
                                <a target="_blank"
                                  href="<?php echo e(route('admin.seller_management.seller.secret_login', ['id' => $seller->id])); ?>"
                                  class="dropdown-item">
                                  <?php echo e(__('Secret Login')); ?>

                                </a>
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

        <div class="card-footer">
          <div class="row">
            <div class="d-inline-block mx-auto">
              <?php echo e($sellers->appends(['info' => request()->input('info')])->links()); ?>

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\younes\Downloads\junspro-main (1)\junspro-main3\resources\views\backend\end-user\seller\index.blade.php ENDPATH**/ ?>