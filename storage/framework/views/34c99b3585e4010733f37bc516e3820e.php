<?php $__env->startSection('content'); ?>
  <div class="page-header">
    <h4 class="page-title"><?php echo e(__('Permissions')); ?></h4>
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
        <a href="#"><?php echo e(__('Admin Management')); ?></a>
      </li>
      <li class="separator">
        <i class="flaticon-right-arrow"></i>
      </li>
      <li class="nav-item">
        <a href="#"><?php echo e(__('Role')); ?></a>
      </li>
      <li class="separator">
        <i class="flaticon-right-arrow"></i>
      </li>
      <li class="nav-item">
        <a href="#"><?php echo e(__('Permissions')); ?></a>
      </li>
    </ul>
  </div>

  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <form action="<?php echo e(route('admin.admin_management.role.update_permissions', ['id' => $role->id])); ?>" method="post">
          <?php echo csrf_field(); ?>
          <div class="card-header">
            <div class="card-title d-inline-block"><?php echo e(__('Permissions of') . ' ' . $role->name); ?></div>

            <a class="btn btn-info btn-sm float-right d-inline-block"
              href="<?php echo e(route('admin.admin_management.role_permissions')); ?>">
              <span class="btn-label">
                <i class="fas fa-backward mdb_3242"></i>
              </span>
              <?php echo e(__('Back')); ?>

            </a>
          </div>

          <div class="card-body py-5">
            <div class="row justify-content-center">
              <div class="col-lg-5">
                <div class="alert alert-warning text-center" role="alert">
                  <strong class="text-dark"><?php echo e(__('Select from this below options.')); ?></strong>
                </div>
              </div>
            </div>

            <?php $rolePermissions = json_decode($role->permissions); ?>

            <div class="row mt-3 justify-content-center">
              <div class="col-lg-8">
                <div class="form-group">
                  <div class="selectgroup selectgroup-pills">
                    <label class="selectgroup-item">
                      <input type="checkbox" class="selectgroup-input" name="permissions[]" value="Language Management"
                        <?php if(is_array($rolePermissions) && in_array('Language Management', $rolePermissions)): ?> checked <?php endif; ?>>
                      <span class="selectgroup-button"><?php echo e(__('Language Management')); ?></span>
                    </label>

                    <label class="selectgroup-item">
                      <input type="checkbox" class="selectgroup-input" name="permissions[]" value="Admin Management"
                        <?php if(is_array($rolePermissions) && in_array('Admin Management', $rolePermissions)): ?> checked <?php endif; ?>>
                      <span class="selectgroup-button"><?php echo e(__('Admin Management')); ?></span>
                    </label>
                    <label class="selectgroup-item">
                      <input type="checkbox" class="selectgroup-input" name="permissions[]" value="Payment Gateways"
                        <?php if(is_array($rolePermissions) && in_array('Payment Gateways', $rolePermissions)): ?> checked <?php endif; ?>>
                      <span class="selectgroup-button"><?php echo e(__('Payment Gateways')); ?></span>
                    </label>
                    <label class="selectgroup-item">
                      <input type="checkbox" class="selectgroup-input" name="permissions[]" value="Basic Settings"
                        <?php if(is_array($rolePermissions) && in_array('Basic Settings', $rolePermissions)): ?> checked <?php endif; ?>>
                      <span class="selectgroup-button"><?php echo e(__('Basic Settings')); ?></span>
                    </label>

                    <label class="selectgroup-item">
                      <input type="checkbox" class="selectgroup-input" name="permissions[]" value="Announcement Popups"
                        <?php if(is_array($rolePermissions) && in_array('Announcement Popups', $rolePermissions)): ?> checked <?php endif; ?>>
                      <span class="selectgroup-button"><?php echo e(__('Announcement Popups')); ?></span>
                    </label>
                    <label class="selectgroup-item">
                      <input type="checkbox" class="selectgroup-input" name="permissions[]" value="Advertise"
                        <?php if(is_array($rolePermissions) && in_array('Advertise', $rolePermissions)): ?> checked <?php endif; ?>>
                      <span class="selectgroup-button"><?php echo e(__('Advertise')); ?></span>
                    </label>
                    <label class="selectgroup-item">
                      <input type="checkbox" class="selectgroup-input" name="permissions[]" value="Custom Pages"
                        <?php if(is_array($rolePermissions) && in_array('Custom Pages', $rolePermissions)): ?> checked <?php endif; ?>>
                      <span class="selectgroup-button"><?php echo e(__('Custom Pages')); ?></span>
                    </label>
                    <label class="selectgroup-item">
                      <input type="checkbox" class="selectgroup-input" name="permissions[]" value="FAQ Management"
                        <?php if(is_array($rolePermissions) && in_array('FAQ Management', $rolePermissions)): ?> checked <?php endif; ?>>
                      <span class="selectgroup-button"><?php echo e(__('FAQ Management')); ?></span>
                    </label>
                    <label class="selectgroup-item">
                      <input type="checkbox" class="selectgroup-input" name="permissions[]" value="Blog Management"
                        <?php if(is_array($rolePermissions) && in_array('Blog Management', $rolePermissions)): ?> checked <?php endif; ?>>
                      <span class="selectgroup-button"><?php echo e(__('Blog Management')); ?></span>
                    </label>
                    <label class="selectgroup-item">
                      <input type="checkbox" class="selectgroup-input" name="permissions[]" value="Footer"
                        <?php if(is_array($rolePermissions) && in_array('Footer', $rolePermissions)): ?> checked <?php endif; ?>>
                      <span class="selectgroup-button"><?php echo e(__('Footer')); ?></span>
                    </label>
                    <label class="selectgroup-item">
                      <input type="checkbox" class="selectgroup-input" name="permissions[]" value="Home Page"
                        <?php if(is_array($rolePermissions) && in_array('Home Page', $rolePermissions)): ?> checked <?php endif; ?>>
                      <span class="selectgroup-button"><?php echo e(__('Home Page')); ?></span>
                    </label>

                    <label class="selectgroup-item">
                      <input type="checkbox" class="selectgroup-input" name="permissions[]"
                        value="Withdrawals Management" <?php if(is_array($rolePermissions) && in_array('Withdrawals Management', $rolePermissions)): ?> checked <?php endif; ?>>
                      <span class="selectgroup-button"><?php echo e(__('Withdrawals Management')); ?></span>
                    </label>
                    <label class="selectgroup-item">
                      <input type="checkbox" class="selectgroup-input" name="permissions[]" value="Transactions"
                        <?php if(is_array($rolePermissions) && in_array('Transactions', $rolePermissions)): ?> checked <?php endif; ?>>
                      <span class="selectgroup-button"><?php echo e(__('Transactions')); ?></span>
                    </label>

                    <label class="selectgroup-item">
                      <input type="checkbox" class="selectgroup-input" name="permissions[]" value="Raise Disputs"
                        <?php if(is_array($rolePermissions) && in_array('Raise Disputs', $rolePermissions)): ?> checked <?php endif; ?>>
                      <span class="selectgroup-button"><?php echo e(__('Raise Disputs')); ?></span>
                    </label>

                    <label class="selectgroup-item">
                      <input type="checkbox" class="selectgroup-input" name="permissions[]" value="Support Tickets"
                        <?php if(is_array($rolePermissions) && in_array('Support Tickets', $rolePermissions)): ?> checked <?php endif; ?>>
                      <span class="selectgroup-button"><?php echo e(__('Support Tickets')); ?></span>
                    </label>
                    <label class="selectgroup-item">
                      <input type="checkbox" class="selectgroup-input" name="permissions[]" value="Sellers Management"
                        <?php if(is_array($rolePermissions) && in_array('Sellers Management', $rolePermissions)): ?> checked <?php endif; ?>>
                      <span class="selectgroup-button"><?php echo e(__('Sellers Management')); ?></span>
                    </label>
                    <label class="selectgroup-item">
                      <input type="checkbox" class="selectgroup-input" name="permissions[]" value="User Management"
                        <?php if(is_array($rolePermissions) && in_array('User Management', $rolePermissions)): ?> checked <?php endif; ?>>
                      <span class="selectgroup-button"><?php echo e(__('User Management')); ?></span>
                    </label>
                    <label class="selectgroup-item">
                      <input type="checkbox" class="selectgroup-input" name="permissions[]" value="QR Codes"
                        <?php if(is_array($rolePermissions) && in_array('QR Codes', $rolePermissions)): ?> checked <?php endif; ?>>
                      <span class="selectgroup-button"><?php echo e(__('QR Codes')); ?></span>
                    </label>
                    <label class="selectgroup-item">
                      <input type="checkbox" class="selectgroup-input" name="permissions[]" value="Service Management"
                        <?php if(is_array($rolePermissions) && in_array('Service Management', $rolePermissions)): ?> checked <?php endif; ?>>
                      <span class="selectgroup-button"><?php echo e(__('Service Management')); ?></span>
                    </label>

                    <label class="selectgroup-item">
                      <input type="checkbox" class="selectgroup-input" name="permissions[]" value="Service Orders"
                        <?php if(is_array($rolePermissions) && in_array('Service Orders', $rolePermissions)): ?> checked <?php endif; ?>>
                      <span class="selectgroup-button"><?php echo e(__('Service Orders')); ?></span>
                    </label>
                    <label class="selectgroup-item">
                      <input type="checkbox" class="selectgroup-input" name="permissions[]" value="Subscription Log"
                        <?php if(is_array($rolePermissions) && in_array('Subscription Log', $rolePermissions)): ?> checked <?php endif; ?>>
                      <span class="selectgroup-button"><?php echo e(__('Subscription Log')); ?></span>
                    </label>
                    <label class="selectgroup-item">
                      <input type="checkbox" class="selectgroup-input" name="permissions[]" value="Package Management"
                        <?php if(is_array($rolePermissions) && in_array('Package Management', $rolePermissions)): ?> checked <?php endif; ?>>
                      <span class="selectgroup-button"><?php echo e(__('Package Management')); ?></span>
                    </label>
                    <label class="selectgroup-item">
                      <input type="checkbox" class="selectgroup-input" name="permissions[]" value="Menu Builder"
                        <?php if(is_array($rolePermissions) && in_array('Menu Builder', $rolePermissions)): ?> checked <?php endif; ?>>
                      <span class="selectgroup-button"><?php echo e(__('Menu Builder')); ?></span>
                    </label>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="card-footer">
            <div class="row">
              <div class="col-12 text-center">
                <button type="submit" class="btn btn-success">
                  <?php echo e(__('Update')); ?>

                </button>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\younes\Downloads\junspro-main (1)\junspro-main3\resources\views\backend\administrator\role-permission\permissions.blade.php ENDPATH**/ ?>