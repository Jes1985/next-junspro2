<?php $__env->startSection('content'); ?>
  <div class="page-header">
    <h4 class="page-title"><?php echo e(__('Registered Customers')); ?></h4>
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
        <a href="#"><?php echo e(__('Customers Management')); ?></a>
      </li>
      <li class="separator">
        <i class="flaticon-right-arrow"></i>
      </li>
      <li class="nav-item">
        <a href="#"><?php echo e(__('Registered Customers')); ?></a>
      </li>
    </ul>
  </div>

  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <div class="row">
            <div class="col-lg-4">
              <div class="card-title"><?php echo e(__('All Customers')); ?></div>
            </div>

            <div class="col-lg-6 offset-lg-2">
              <button type="button" class="btn btn-primary float-right   btn-sm ml-2 mt-1  " data-toggle="modal"
                data-target="#addUserModal"><i class="fas fa-plus"></i>
                <?php echo e(__('Add Customer')); ?></button>

              <button class="btn btn-danger btn-sm float-right d-none bulk-delete mr-2 ml-3 mt-1"
                data-href="<?php echo e(route('admin.user_management.bulk_delete_user')); ?>">
                <i class="flaticon-interface-5"></i> <?php echo e(__('Delete')); ?>

              </button>
              <form class="float-right" action="<?php echo e(route('admin.user_management.registered_users')); ?>" method="GET">
                <input name="info" type="text" class="form-control min_width_230" placeholder="Search By Username or Email ID"
                  value="<?php echo e(!empty(request()->input('info')) ? request()->input('info') : ''); ?>" >
              </form>



            </div>
          </div>
        </div>

        <div class="card-body">
          <div class="row">
            <div class="col-lg-12">
              <?php if(count($users) == 0): ?>
                <h3 class="text-center mt-2"><?php echo e(__('NO CUSTOMER FOUND') . '!'); ?></h3>
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
                        <th scope="col"><?php echo e(__('Email Status')); ?></th>
                        <th scope="col"><?php echo e(__('Phone')); ?></th>
                        <th scope="col"><?php echo e(__('Account Status')); ?></th>
                        <th scope="col"><?php echo e(__('Actions')); ?></th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                          <td>
                            <input type="checkbox" class="bulk-check" data-val="<?php echo e($user->id); ?>">
                          </td>
                          <td>
                            <?php if(empty($user->username)): ?>
                              <?php echo e($user->provider_id); ?>

                            <?php else: ?>
                              <?php echo e($user->username); ?>

                            <?php endif; ?>
                          </td>
                          <td><?php echo e($user->email_address); ?></td>
                          <td>
                            <form id="emailStatusForm-<?php echo e($user->id); ?>" class="d-inline-block"
                              action="<?php echo e(route('admin.user_management.user.update_email_status', ['id' => $user->id])); ?>"
                              method="post">
                              <?php echo csrf_field(); ?>
                              <select
                                class="form-control form-control-sm <?php echo e(!is_null($user->email_verified_at) ? 'bg-success' : 'bg-danger'); ?>"
                                name="email_status"
                                onchange="document.getElementById('emailStatusForm-<?php echo e($user->id); ?>').submit()">
                                <option value="verified" <?php echo e(!is_null($user->email_verified_at) ? 'selected' : ''); ?>>
                                  <?php echo e(__('Verified')); ?>

                                </option>
                                <option value="not verified" <?php echo e(is_null($user->email_verified_at) ? 'selected' : ''); ?>>
                                  <?php echo e(__('Not Verified')); ?>

                                </option>
                              </select>
                            </form>
                          </td>
                          <td><?php echo e(empty($user->phone_number) ? '-' : $user->phone_number); ?></td>
                          <td>
                            <form id="accountStatusForm-<?php echo e($user->id); ?>" class="d-inline-block"
                              action="<?php echo e(route('admin.user_management.user.update_account_status', ['id' => $user->id])); ?>"
                              method="post">
                              <?php echo csrf_field(); ?>
                              <select
                                class="form-control form-control-sm <?php echo e($user->status == 1 ? 'bg-success' : 'bg-danger'); ?>"
                                name="account_status"
                                onchange="document.getElementById('accountStatusForm-<?php echo e($user->id); ?>').submit()">
                                <option value="1" <?php echo e($user->status == 1 ? 'selected' : ''); ?>>
                                  <?php echo e(__('Active')); ?>

                                </option>
                                <option value="2" <?php echo e($user->status == 0 ? 'selected' : ''); ?>>
                                  <?php echo e(__('Deactive')); ?>

                                </option>
                              </select>
                            </form>
                          </td>
                          <td>
                            <div class="dropdown">
                              <button class="btn btn-secondary btn-sm dropdown-toggle" type="button"
                                id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <?php echo e(__('Select')); ?>

                              </button>

                              <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a href="<?php echo e(route('admin.user_management.user.details', ['id' => $user->id])); ?>"
                                  class="dropdown-item">
                                  <?php echo e(__('Details')); ?>

                                </a>
                                <a href="<?php echo e(route('admin.user_management.user.edit', ['id' => $user->id])); ?>"
                                  class="dropdown-item">
                                  <?php echo e(__('Edit')); ?>

                                </a>

                                <a href="<?php echo e(route('admin.user_management.user.change_password', ['id' => $user->id])); ?>"
                                  class="dropdown-item">
                                  <?php echo e(__('Change Password')); ?>

                                </a>

                                <form class=" d-block" target="_blank"
                                  action="<?php echo e(route('admin.user_management.user.secretLogin', ['id' => $user->id])); ?>"
                                  method="post">
                                  <?php echo csrf_field(); ?>
                                  <button type="submit" class="dropdown-item">
                                    <?php echo e(__('Secret Login')); ?>

                                  </button>
                                </form>

                                <form class="deleteForm d-block"
                                  action="<?php echo e(route('admin.user_management.user.delete', ['id' => $user->id])); ?>"
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

        <div class="card-footer">
          <div class="mt-3 text-center">
            <div class="d-inline-block mx-auto">
              <?php echo e($users->appends(['info' => request()->input('info')])->links()); ?>

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Modal -->
  <div class="modal fade" id="addUserModal" tabindex="-1" role="dialog" aria-labelledby="addUserModalTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle"><?php echo e(__('Add Customer')); ?></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="<?php echo e(route('admin.user_management.register_user')); ?>" method="POST" id="ajaxForm">
            <?php echo csrf_field(); ?>

            <div class="form-group">
              <label for=""><?php echo e(__('Username')); ?> *</label>
              <input class="form-control" type="text" name="username">
              <p id="err_username" class="text-danger mb-0 em"></p>
            </div>
            <div class="form-group">
              <label for=""><?php echo e(__('Email')); ?> *</label>
              <input class="form-control" type="email" name="email_address">
              <p id="err_email_address" class="text-danger mb-0 em"></p>
            </div>
            <div class="form-group">
              <label for=""><?php echo e(__('Password')); ?> *</label>
              <input class="form-control" type="password" name="password">
              <p id="err_password" class="text-danger mb-0 em"></p>
            </div>
            <div class="form-group">
              <label for=""><?php echo e(__('Confirm Password')); ?> *</label>
              <input class="form-control" type="password" name="password_confirmation">
              <p id="err_password_confirmation" class="text-danger mb-0 em"></p>
            </div>

          </form>
        </div>
        <div class="modal-footer text-center">
          <button id="submitBtn" type="button" class="btn btn-primary"><?php echo e(__('Add Customer')); ?></button>
        </div>
      </div>
    </div>
  </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\younes\Downloads\junspro-main (1)\junspro-main3\resources\views\backend\end-user\user\index.blade.php ENDPATH**/ ?>