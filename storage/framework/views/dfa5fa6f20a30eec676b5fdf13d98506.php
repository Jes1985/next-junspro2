<div class="sidebar sidebar-style-2"
  data-background-color="<?php echo e($settings->admin_theme_version == 'light' ? 'white' : 'dark2'); ?>">
  <div class="sidebar-wrapper scrollbar scrollbar-inner">
    <div class="sidebar-content">
      <div class="user">
        <div class="avatar-sm float-left mr-2">
          <?php if(Auth::guard('admin')->user()->image != null): ?>
            <img src="<?php echo e(asset('assets/img/admins/' . Auth::guard('admin')->user()->image)); ?>" alt="Admin Image"
              class="avatar-img rounded-circle">
          <?php else: ?>
            <img src="<?php echo e(asset('assets/img/blank-user.jpg')); ?>" alt="" class="avatar-img rounded-circle">
          <?php endif; ?>
        </div>

        <div class="info">
          <a data-toggle="collapse" href="#adminProfileMenu" aria-expanded="true">
            <span>
              <?php echo e(Auth::guard('admin')->user()->first_name); ?>


              <?php if(is_null($roleInfo)): ?>
                <span class="user-level"><?php echo e('Super Admin'); ?></span>
              <?php else: ?>
                <span class="user-level"><?php echo e($roleInfo->name); ?></span>
              <?php endif; ?>

              <span class="caret"></span>
            </span>
          </a>

          <div class="clearfix"></div>

          <div class="collapse in" id="adminProfileMenu">
            <ul class="nav">
              <li>
                <a href="<?php echo e(route('admin.edit_profile')); ?>">
                  <span class="link-collapse"><?php echo e('Edit Profile'); ?></span>
                </a>
              </li>

              <li>
                <a href="<?php echo e(route('admin.change_password')); ?>">
                  <span class="link-collapse"><?php echo e('Change Password'); ?></span>
                </a>
              </li>

              <li>
                <a href="<?php echo e(route('admin.logout')); ?>">
                  <span class="link-collapse"><?php echo e('Logout'); ?></span>
                </a>
              </li>
            </ul>
          </div>
        </div>
      </div>

      <?php
        if (!is_null($roleInfo)) {
            $rolePermissions = json_decode($roleInfo->permissions);
        }
      ?>

      <ul class="nav nav-primary">
        
        <div class="row mb-3">
          <div class="col-12">
            <form action="">
              <div class="form-group py-0">
                <input name="term" type="text" class="form-control sidebar-search ltr"
                  placeholder="Search Menu Here...">
              </div>
            </form>
          </div>
        </div>

        
        <li class="nav-item <?php if(request()->routeIs('admin.dashboard')): ?> active <?php endif; ?>">
          <a href="<?php echo e(route('admin.dashboard')); ?>">
            <i class="la flaticon-paint-palette"></i>
            <p><?php echo e('Dashboard'); ?></p>
          </a>
        </li>


        
        <?php if(is_null($roleInfo) || (!empty($rolePermissions) && in_array('Menu Builder', $rolePermissions))): ?>
          <li class="nav-item <?php if(request()->routeIs('admin.menu_builder')): ?> active <?php endif; ?>">
            <a href="<?php echo e(route('admin.menu_builder', ['language' => $defaultLang->code])); ?>">
              <i class="fal fa-bars"></i>
              <p><?php echo e(__('Menu Builder')); ?></p>
            </a>
          </li>
        <?php endif; ?>

        
        <?php if(is_null($roleInfo) || (!empty($rolePermissions) && in_array('Package Management', $rolePermissions))): ?>
          <li
            class="nav-item <?php if(request()->routeIs('admin.package.settings')): ?> active 
            <?php elseif(request()->routeIs('admin.package.index')): ?> active 
            <?php elseif(request()->routeIs('admin.package.edit')): ?> active <?php endif; ?>">
            <a data-toggle="collapse" href="#packageManagement">
              <i class="fal fa-receipt"></i>
              <p>Package Management</p>
              <span class="caret"></span>
            </a>

            <div id="packageManagement"
              class="collapse 
              <?php if(request()->routeIs('admin.package.settings')): ?> show 
              <?php elseif(request()->routeIs('admin.package.index')): ?> show 
              <?php elseif(request()->routeIs('admin.package.edit')): ?> show <?php endif; ?>">
              <ul class="nav nav-collapse">

                <li class="<?php echo e(request()->routeIs('admin.package.settings') ? 'active' : ''); ?>">
                  <a href="<?php echo e(route('admin.package.settings', ['language' => $defaultLang->code])); ?>">
                    <span class="sub-item">Settings</span>
                  </a>
                </li>

                <li class="<?php echo e(request()->routeIs('admin.package.index') ? 'active' : ''); ?>">
                  <a href="<?php echo e(route('admin.package.index', ['language' => $defaultLang->code])); ?>">
                    <span class="sub-item">Packages</span>
                  </a>
                </li>
              </ul>
            </div>
          </li>
        <?php endif; ?>

        
        <?php if(is_null($roleInfo) || (!empty($rolePermissions) && in_array('Subscription Log', $rolePermissions))): ?>
          <li class="nav-item <?php if(request()->routeIs('admin.payment-log.index')): ?> active <?php endif; ?>">
            <a href="<?php echo e(route('admin.payment-log.index')); ?>">
              <i class="fas fa-list-ol"></i>
              <p>Subscription Log</p>
            </a>
          </li>
        <?php endif; ?>

        
        <?php if(is_null($roleInfo) || (!empty($rolePermissions) && in_array('Service Management', $rolePermissions))): ?>
          <li
            class="nav-item <?php if(request()->routeIs('admin.service_management.categories')): ?> active 
            <?php elseif(request()->routeIs('admin.service_management.settings')): ?> active 
            <?php elseif(request()->routeIs('admin.service_management.popular_tags')): ?> active 
            <?php elseif(request()->routeIs('admin.service_management.skills')): ?> active 
            <?php elseif(request()->routeIs('admin.service_management.subcategories')): ?> active 
            <?php elseif(request()->routeIs('admin.service_management.forms')): ?> active 
            <?php elseif(request()->routeIs('admin.service_management.form.input')): ?> active 
            <?php elseif(request()->routeIs('admin.service_management.form.edit_input')): ?> active 
            <?php elseif(request()->routeIs('admin.service_management.services')): ?> active 
            <?php elseif(request()->routeIs('admin.service_management.create_service')): ?> active 
            <?php elseif(request()->routeIs('admin.service_management.edit_service')): ?> active 
            <?php elseif(request()->routeIs('admin.service_management.service.packages')): ?> active 
            <?php elseif(request()->routeIs('admin.service_management.service.addons')): ?> active 
            <?php elseif(request()->routeIs('admin.service_management.service.faqs')): ?> active <?php endif; ?>">
            <a data-toggle="collapse" href="#service">
              <i class="fal fa-headset"></i>
              <p><?php echo e(__('Service Management')); ?></p>
              <span class="caret"></span>
            </a>

            <div id="service"
              class="collapse 
              <?php if(request()->routeIs('admin.service_management.categories')): ?> show 
              <?php elseif(request()->routeIs('admin.service_management.settings')): ?> show 
              <?php elseif(request()->routeIs('admin.service_management.popular_tags')): ?> show 
              <?php elseif(request()->routeIs('admin.service_management.skills')): ?> show 
              <?php elseif(request()->routeIs('admin.service_management.subcategories')): ?> show 
              <?php elseif(request()->routeIs('admin.service_management.forms')): ?> show 
              <?php elseif(request()->routeIs('admin.service_management.form.input')): ?> show 
              <?php elseif(request()->routeIs('admin.service_management.form.edit_input')): ?> show 
              <?php elseif(request()->routeIs('admin.service_management.services')): ?> show 
              <?php elseif(request()->routeIs('admin.service_management.create_service')): ?> show 
              <?php elseif(request()->routeIs('admin.service_management.edit_service')): ?> show 
              <?php elseif(request()->routeIs('admin.service_management.service.packages')): ?> show 
              <?php elseif(request()->routeIs('admin.service_management.service.addons')): ?> show 
              <?php elseif(request()->routeIs('admin.service_management.service.faqs')): ?> show <?php endif; ?>">
              <ul class="nav nav-collapse">
                <li class="<?php echo e(request()->routeIs('admin.service_management.settings') ? 'active' : ''); ?>">
                  <a href="<?php echo e(route('admin.service_management.settings', ['language' => $defaultLang->code])); ?>">
                    <span class="sub-item"><?php echo e(__('Settings')); ?></span>
                  </a>
                </li>
                <li class="<?php echo e(request()->routeIs('admin.service_management.popular_tags') ? 'active' : ''); ?>">
                  <a href="<?php echo e(route('admin.service_management.popular_tags', ['language' => $defaultLang->code])); ?>">
                    <span class="sub-item"><?php echo e(__('Populal Tags')); ?></span>
                  </a>
                </li>
                <li class="<?php echo e(request()->routeIs('admin.service_management.skills') ? 'active' : ''); ?>">
                  <a href="<?php echo e(route('admin.service_management.skills', ['language' => $defaultLang->code])); ?>">
                    <span class="sub-item"><?php echo e(__('Skills')); ?></span>
                  </a>
                </li>

                <li class="<?php echo e(request()->routeIs('admin.service_management.categories') ? 'active' : ''); ?>">
                  <a href="<?php echo e(route('admin.service_management.categories', ['language' => $defaultLang->code])); ?>">
                    <span class="sub-item"><?php echo e('Categories'); ?></span>
                  </a>
                </li>

                <li class="<?php echo e(request()->routeIs('admin.service_management.subcategories') ? 'active' : ''); ?>">
                  <a href="<?php echo e(route('admin.service_management.subcategories', ['language' => $defaultLang->code])); ?>">
                    <span class="sub-item"><?php echo e(__('Subcategories')); ?></span>
                  </a>
                </li>

                <li
                  class="<?php if(request()->routeIs('admin.service_management.forms')): ?> active 
                  <?php elseif(request()->routeIs('admin.service_management.form.input')): ?> active 
                  <?php elseif(request()->routeIs('admin.service_management.form.edit_input')): ?> active <?php endif; ?>">
                  <a href="<?php echo e(route('admin.service_management.forms', ['language' => $defaultLang->code])); ?>">
                    <span class="sub-item"><?php echo e(__('Forms')); ?></span>
                  </a>
                </li>

                <li
                  class="<?php if(request()->routeIs('admin.service_management.services')): ?> active 
                  <?php elseif(request()->routeIs('admin.service_management.create_service')): ?> active 
                  <?php elseif(request()->routeIs('admin.service_management.edit_service')): ?> active 
                  <?php elseif(request()->routeIs('admin.service_management.service.packages')): ?> active 
                  <?php elseif(request()->routeIs('admin.service_management.service.addons')): ?> active 
                  <?php elseif(request()->routeIs('admin.service_management.service.faqs')): ?> active <?php endif; ?>">
                  <a href="<?php echo e(route('admin.service_management.services', ['language' => $defaultLang->code])); ?>">
                    <span class="sub-item"><?php echo e('Services'); ?></span>
                  </a>
                </li>
              </ul>
            </div>
          </li>
        <?php endif; ?>

        
        <?php if(is_null($roleInfo) || (!empty($rolePermissions) && in_array('Service Orders', $rolePermissions))): ?>
          <li
            class="nav-item <?php if(request()->routeIs('admin.service_orders')): ?> active 
            <?php elseif(request()->routeIs('admin.service_order.details')): ?> active 
            <?php elseif(request()->routeIs('admin.service_order.message')): ?> active 
            <?php elseif(request()->routeIs('admin.service_orders.report')): ?> active <?php endif; ?>">
            <a data-toggle="collapse" href="#service_orders">
              <i class="far fa-cubes"></i>
              <p><?php echo e('Service Orders'); ?></p>
              <span class="caret"></span>
            </a>

            <div id="service_orders"
              class="collapse 
              <?php if(request()->routeIs('admin.service_orders')): ?> show 
              <?php elseif(request()->routeIs('admin.service_order.details')): ?> show 
              <?php elseif(request()->routeIs('admin.service_order.message')): ?> show 
              <?php elseif(request()->routeIs('admin.service_orders.report')): ?> show <?php endif; ?>">
              <ul class="nav nav-collapse">
                <li
                  class="<?php echo e(request()->routeIs('admin.service_orders') && empty(request()->input('order_status')) ? 'active' : ''); ?>">
                  <a href="<?php echo e(route('admin.service_orders')); ?>">
                    <span class="sub-item"><?php echo e(__('All Orders')); ?></span>
                  </a>
                </li>

                <li
                  class="<?php echo e(request()->routeIs('admin.service_orders') && request()->input('order_status') == 'pending' ? 'active' : ''); ?>">
                  <a href="<?php echo e(route('admin.service_orders', ['order_status' => 'pending'])); ?>">
                    <span class="sub-item"><?php echo e(__('Pending Orders')); ?></span>
                  </a>
                </li>

                <li
                  class="<?php echo e(request()->routeIs('admin.service_orders') && request()->input('order_status') == 'processing' ? 'active' : ''); ?>">
                  <a href="<?php echo e(route('admin.service_orders', ['order_status' => 'processing'])); ?>">
                    <span class="sub-item"><?php echo e(__('Processing Orders')); ?></span>
                  </a>
                </li>

                <li
                  class="<?php echo e(request()->routeIs('admin.service_orders') && request()->input('order_status') == 'completed' ? 'active' : ''); ?>">
                  <a href="<?php echo e(route('admin.service_orders', ['order_status' => 'completed'])); ?>">
                    <span class="sub-item"><?php echo e(__('Completed Orders')); ?></span>
                  </a>
                </li>

                <li
                  class="<?php echo e(request()->routeIs('admin.service_orders') && request()->input('order_status') == 'rejected' ? 'active' : ''); ?>">
                  <a href="<?php echo e(route('admin.service_orders', ['order_status' => 'rejected'])); ?>">
                    <span class="sub-item"><?php echo e(__('Rejected Orders')); ?></span>
                  </a>
                </li>

                <li class="<?php echo e(request()->routeIs('admin.service_orders.report') ? 'active' : ''); ?>">
                  <a href="<?php echo e(route('admin.service_orders.report')); ?>">
                    <span class="sub-item"><?php echo e(__('Report')); ?></span>
                  </a>
                </li>
              </ul>
            </div>
          </li>
        <?php endif; ?>

        
        <?php if(is_null($roleInfo) || (!empty($rolePermissions) && in_array('Raise Disputs', $rolePermissions))): ?>
          <li class="nav-item <?php if(request()->routeIs('admin.service_order.disputs')): ?> active <?php endif; ?>">
            <a href="<?php echo e(route('admin.service_order.disputs')); ?>">
              <i class="fal fa-gavel"></i>
              <p><?php echo e('Dispute Requests'); ?></p>
            </a>
          </li>
        <?php endif; ?>

        
        <?php if(is_null($roleInfo) || (!empty($rolePermissions) && in_array('Withdrawals Management', $rolePermissions))): ?>
          <li
            class="nav-item
          <?php if(request()->routeIs('admin.withdraw.payment_method')): ?> active
          <?php elseif(request()->routeIs('admin.withdraw.payment_method')): ?> active
          <?php elseif(request()->routeIs('admin.withdraw_payment_method.mange_input')): ?> active
          <?php elseif(request()->routeIs('admin.withdraw_payment_method.edit_input')): ?> active
          <?php elseif(request()->routeIs('admin.withdraw.withdraw_request')): ?> active <?php endif; ?>">
            <a data-toggle="collapse" href="#withdraw_method">
              <i class="fal fa-credit-card"></i>
              <p><?php echo e(__('Withdrawals Management')); ?></p>
              <span class="caret"></span>
            </a>

            <div id="withdraw_method"
              class="collapse
            <?php if(request()->routeIs('admin.withdraw.payment_method')): ?> show
            <?php elseif(request()->routeIs('admin.withdraw.payment_method')): ?> show
            <?php elseif(request()->routeIs('admin.withdraw_payment_method.mange_input')): ?> show
            <?php elseif(request()->routeIs('admin.withdraw_payment_method.edit_input')): ?> show
            <?php elseif(request()->routeIs('admin.withdraw.withdraw_request')): ?> show <?php endif; ?>">
              <ul class="nav nav-collapse">
                <li
                  class="<?php echo e(request()->routeIs('admin.withdraw.payment_method') && empty(request()->input('status')) ? 'active' : ''); ?>">
                  <a href="<?php echo e(route('admin.withdraw.payment_method', ['language' => $defaultLang->code])); ?>">
                    <span class="sub-item"><?php echo e(__('Payment Methods')); ?></span>
                  </a>
                </li>

                <li
                  class="<?php echo e(request()->routeIs('admin.withdraw.withdraw_request') && empty(request()->input('status')) ? 'active' : ''); ?>">
                  <a href="<?php echo e(route('admin.withdraw.withdraw_request', ['language' => $defaultLang->code])); ?>">
                    <span class="sub-item"><?php echo e(__('Withdraw Requests')); ?></span>
                  </a>
                </li>
              </ul>
            </div>
          </li>
        <?php endif; ?>

        
        <?php if(is_null($roleInfo) || (!empty($rolePermissions) && in_array('Transactions', $rolePermissions))): ?>
          <li class="nav-item <?php if(request()->routeIs('admin.transcation')): ?> active <?php endif; ?>">
            <a href="<?php echo e(route('admin.transcation')); ?>">
              <i class="fal fa-exchange-alt"></i>
              <p><?php echo e(__('Transactions')); ?></p>
            </a>
          </li>
        <?php endif; ?>

        
        <?php if(is_null($roleInfo) || (!empty($rolePermissions) && in_array('QR Codes', $rolePermissions))): ?>
          <li
            class="nav-item <?php if(request()->routeIs('admin.qr_codes.generate_code')): ?> active 
            <?php elseif(request()->routeIs('admin.qr_codes.saved_codes')): ?> active <?php endif; ?>">
            <a data-toggle="collapse" href="#qr_codes">
              <i class="fal fa-qrcode"></i>
              <p><?php echo e(__('QR Codes')); ?></p>
              <span class="caret"></span>
            </a>

            <div id="qr_codes"
              class="collapse 
              <?php if(request()->routeIs('admin.qr_codes.generate_code')): ?> show 
              <?php elseif(request()->routeIs('admin.qr_codes.saved_codes')): ?> show <?php endif; ?>">
              <ul class="nav nav-collapse">
                <li class="<?php echo e(request()->routeIs('admin.qr_codes.generate_code') ? 'active' : ''); ?>">
                  <a href="<?php echo e(route('admin.qr_codes.generate_code')); ?>">
                    <span class="sub-item"><?php echo e(__('Generate Code')); ?></span>
                  </a>
                </li>

                <li class="<?php echo e(request()->routeIs('admin.qr_codes.saved_codes') ? 'active' : ''); ?>">
                  <a href="<?php echo e(route('admin.qr_codes.saved_codes')); ?>">
                    <span class="sub-item"><?php echo e(__('Saved Codes')); ?></span>
                  </a>
                </li>
              </ul>
            </div>
          </li>
        <?php endif; ?>

        
        <?php if(is_null($roleInfo) || (!empty($rolePermissions) && in_array('User Management', $rolePermissions))): ?>
          <li
            class="nav-item <?php if(request()->routeIs('admin.user_management.registered_users')): ?> active 
            <?php elseif(request()->routeIs('admin.user_management.user.details')): ?> active 
            <?php elseif(request()->routeIs('admin.user_management.user.edit')): ?> active 
            <?php elseif(request()->routeIs('admin.user_management.user.change_password')): ?> active 
            <?php elseif(request()->routeIs('admin.user_management.subscribers')): ?> active 
            <?php elseif(request()->routeIs('admin.user_management.mail_for_subscribers')): ?> active 
            <?php elseif(request()->routeIs('admin.user_management.push_notification.settings')): ?> active 
            <?php elseif(request()->routeIs('admin.user_management.push_notification.notification_for_visitors')): ?> active <?php endif; ?>">
            <a data-toggle="collapse" href="#user">
              <i class="la flaticon-users"></i>
              <p><?php echo e(__('Customers Management')); ?></p>
              <span class="caret"></span>
            </a>

            <div id="user"
              class="collapse 
              <?php if(request()->routeIs('admin.user_management.registered_users')): ?> show 
              <?php elseif(request()->routeIs('admin.user_management.user.details')): ?> show 
              <?php elseif(request()->routeIs('admin.user_management.user.edit')): ?> show 
              <?php elseif(request()->routeIs('admin.user_management.user.change_password')): ?> show 
              <?php elseif(request()->routeIs('admin.user_management.subscribers')): ?> show 
              <?php elseif(request()->routeIs('admin.user_management.mail_for_subscribers')): ?> show 
              <?php elseif(request()->routeIs('admin.user_management.push_notification.settings')): ?> show 
              <?php elseif(request()->routeIs('admin.user_management.push_notification.notification_for_visitors')): ?> show <?php endif; ?>">
              <ul class="nav nav-collapse">
                <li
                  class="<?php if(request()->routeIs('admin.user_management.registered_users')): ?> active 
                  <?php elseif(request()->routeIs('admin.user_management.user.details')): ?> active 
                  <?php elseif(request()->routeIs('admin.user_management.user.edit')): ?> active 
                  <?php elseif(request()->routeIs('admin.user_management.user.change_password')): ?> active <?php endif; ?>">
                  <a href="<?php echo e(route('admin.user_management.registered_users')); ?>">
                    <span class="sub-item"><?php echo e(__('Registered Customers')); ?></span>
                  </a>
                </li>

                <li
                  class="<?php if(request()->routeIs('admin.user_management.subscribers')): ?> active 
                  <?php elseif(request()->routeIs('admin.user_management.mail_for_subscribers')): ?> active <?php endif; ?>">
                  <a href="<?php echo e(route('admin.user_management.subscribers')); ?>">
                    <span class="sub-item"><?php echo e(__('Subscribers')); ?></span>
                  </a>
                </li>

                <li class="submenu">
                  <a data-toggle="collapse" href="#push_notification">
                    <span class="sub-item"><?php echo e(__('Push Notification')); ?></span>
                    <span class="caret"></span>
                  </a>

                  <div id="push_notification"
                    class="collapse 
                    <?php if(request()->routeIs('admin.user_management.push_notification.settings')): ?> show 
                    <?php elseif(request()->routeIs('admin.user_management.push_notification.notification_for_visitors')): ?> show <?php endif; ?>">
                    <ul class="nav nav-collapse subnav">
                      <li
                        class="<?php echo e(request()->routeIs('admin.user_management.push_notification.settings') ? 'active' : ''); ?>">
                        <a href="<?php echo e(route('admin.user_management.push_notification.settings')); ?>">
                          <span class="sub-item"><?php echo e(__('Settings')); ?></span>
                        </a>
                      </li>

                      <li
                        class="<?php echo e(request()->routeIs('admin.user_management.push_notification.notification_for_visitors') ? 'active' : ''); ?>">
                        <a href="<?php echo e(route('admin.user_management.push_notification.notification_for_visitors')); ?>">
                          <span class="sub-item"><?php echo e(__('Send Notification')); ?></span>
                        </a>
                      </li>
                    </ul>
                  </div>
                </li>
              </ul>
            </div>
          </li>
        <?php endif; ?>

        
        <?php if(is_null($roleInfo) || (!empty($rolePermissions) && in_array('Sellers Management', $rolePermissions))): ?>
          <li
            class="nav-item <?php if(request()->routeIs('admin.seller_management.registered_seller')): ?> active
            <?php elseif(request()->routeIs('admin.seller_management.add_seller')): ?> active
            <?php elseif(request()->routeIs('admin.seller_management.seller_details')): ?> active
            <?php elseif(request()->routeIs('admin.edit_management.seller_edit')): ?> active
            <?php elseif(request()->routeIs('admin.seller_management.settings')): ?> active
            <?php elseif(request()->routeIs('admin.seller_management.seller.change_password')): ?> active <?php endif; ?>">
            <a data-toggle="collapse" href="#seller">
              <i class="la flaticon-users"></i>
              <p>Sellers Management</p>
              <span class="caret"></span>
            </a>

            <div id="seller"
              class="collapse
              <?php if(request()->routeIs('admin.seller_management.registered_seller')): ?> show
              <?php elseif(request()->routeIs('admin.seller_management.seller_details')): ?> show
              <?php elseif(request()->routeIs('admin.edit_management.seller_edit')): ?> show
              <?php elseif(request()->routeIs('admin.seller_management.add_seller')): ?> show
              <?php elseif(request()->routeIs('admin.seller_management.settings')): ?> show
              <?php elseif(request()->routeIs('admin.seller_management.seller.change_password')): ?> show <?php endif; ?>">
              <ul class="nav nav-collapse">
                <li class="<?php if(request()->routeIs('admin.seller_management.settings')): ?> active <?php endif; ?>">
                  <a href="<?php echo e(route('admin.seller_management.settings')); ?>">
                    <span class="sub-item">Settings</span>
                  </a>
                </li>
                <li
                  class="<?php if(request()->routeIs('admin.seller_management.registered_seller')): ?> active
                  <?php elseif(request()->routeIs('admin.seller_management.seller_details')): ?> active
                  <?php elseif(request()->routeIs('admin.edit_management.seller_edit')): ?> active
                  <?php elseif(request()->routeIs('admin.seller_management.seller.change_password')): ?> active <?php endif; ?>">
                  <a href="<?php echo e(route('admin.seller_management.registered_seller')); ?>">
                    <span class="sub-item">Registered Sellers</span>
                  </a>
                </li>
                <li class="<?php if(request()->routeIs('admin.seller_management.add_seller')): ?> active <?php endif; ?>">
                  <a href="<?php echo e(route('admin.seller_management.add_seller')); ?>">
                    <span class="sub-item">Add Seller</span>
                  </a>
                </li>
              </ul>
            </div>
          </li>
        <?php endif; ?>

        
        <?php if(is_null($roleInfo) || (!empty($rolePermissions) && in_array('Support Tickets', $rolePermissions))): ?>
          <li
            class="nav-item <?php if(request()->routeIs('admin.support_tickets.settings')): ?> active 
            <?php elseif(request()->routeIs('admin.support_tickets')): ?> active 
            <?php elseif(request()->routeIs('admin.support_ticket.conversation')): ?> active <?php endif; ?>">
            <a data-toggle="collapse" href="#support_tickets">
              <i class="fal fa-ticket-alt"></i>
              <p><?php echo e('Support Tickets'); ?></p>
              <span class="caret"></span>
            </a>

            <div id="support_tickets"
              class="collapse 
              <?php if(request()->routeIs('admin.support_tickets.settings')): ?> show 
              <?php elseif(request()->routeIs('admin.support_tickets')): ?> show 
              <?php elseif(request()->routeIs('admin.support_ticket.conversation')): ?> show <?php endif; ?>">
              <ul class="nav nav-collapse">
                <li class="<?php echo e(request()->routeIs('admin.support_tickets.settings') ? 'active' : ''); ?>">
                  <a href="<?php echo e(route('admin.support_tickets.settings')); ?>">
                    <span class="sub-item"><?php echo e(__('Settings')); ?></span>
                  </a>
                </li>

                <li
                  class="<?php echo e(request()->routeIs('admin.support_tickets') && empty(request()->input('ticket_status')) ? 'active' : ''); ?>">
                  <a href="<?php echo e(route('admin.support_tickets')); ?>">
                    <span class="sub-item"><?php echo e(__('All Tickets')); ?></span>
                  </a>
                </li>

                <li
                  class="<?php echo e(request()->routeIs('admin.support_tickets') && request()->input('ticket_status') == 'pending' ? 'active' : ''); ?>">
                  <a href="<?php echo e(route('admin.support_tickets', ['ticket_status' => 'pending'])); ?>">
                    <span class="sub-item"><?php echo e(__('Pending Tickets')); ?></span>
                  </a>
                </li>

                <li
                  class="<?php echo e(request()->routeIs('admin.support_tickets') && request()->input('ticket_status') == 'open' ? 'active' : ''); ?>">
                  <a href="<?php echo e(route('admin.support_tickets', ['ticket_status' => 'open'])); ?>">
                    <span class="sub-item"><?php echo e(__('Open Tickets')); ?></span>
                  </a>
                </li>

                <li
                  class="<?php echo e(request()->routeIs('admin.support_tickets') && request()->input('ticket_status') == 'closed' ? 'active' : ''); ?>">
                  <a href="<?php echo e(route('admin.support_tickets', ['ticket_status' => 'closed'])); ?>">
                    <span class="sub-item"><?php echo e(__('Closed Tickets')); ?></span>
                  </a>
                </li>
              </ul>
            </div>
          </li>
        <?php endif; ?>

        
        <?php if(is_null($roleInfo) || (!empty($rolePermissions) && in_array('Home Page', $rolePermissions))): ?>
          <li
            class="nav-item <?php if(request()->routeIs('admin.home_page.hero_section')): ?> active 
            <?php elseif(request()->routeIs('admin.home_page.calltoactionsection')): ?> active
            <?php elseif(request()->routeIs('admin.home_page.section_titles')): ?> active
            <?php elseif(request()->routeIs('admin.home_page.about_section')): ?> active 
            <?php elseif(request()->routeIs('admin.home_page.features_section')): ?> active 
            <?php elseif(request()->routeIs('admin.home_page.testimonials_section')): ?> active 
            <?php elseif(request()->routeIs('admin.home_page.partners_section')): ?> active 
            <?php elseif(request()->routeIs('admin.home_page.section_customization')): ?> active <?php endif; ?>">
            <a data-toggle="collapse" href="#home_page">
              <i class="fal fa-layer-group"></i>
              <p><?php echo e(__('Home Page')); ?></p>
              <span class="caret"></span>
            </a>

            <div id="home_page"
              class="collapse 
              <?php if(request()->routeIs('admin.home_page.hero_section')): ?> show 
              <?php elseif(request()->routeIs('admin.home_page.section_titles')): ?> show
              <?php elseif(request()->routeIs('admin.home_page.calltoactionsection')): ?> show
              <?php elseif(request()->routeIs('admin.home_page.about_section')): ?> show 
              <?php elseif(request()->routeIs('admin.home_page.features_section')): ?> show 
              <?php elseif(request()->routeIs('admin.home_page.testimonials_section')): ?> show 
              <?php elseif(request()->routeIs('admin.home_page.partners_section')): ?> show 
              <?php elseif(request()->routeIs('admin.home_page.section_customization')): ?> show <?php endif; ?>">
              <ul class="nav nav-collapse">
                <li class="<?php echo e(request()->routeIs('admin.home_page.hero_section') ? 'active' : ''); ?>">
                  <a href="<?php echo e(route('admin.home_page.hero_section', ['language' => $defaultLang->code])); ?>">
                    <span class="sub-item"><?php echo e(__('Hero Section')); ?></span>
                  </a>
                </li>

                <li class="<?php echo e(request()->routeIs('admin.home_page.section_titles') ? 'active' : ''); ?>">
                  <a href="<?php echo e(route('admin.home_page.section_titles', ['language' => $defaultLang->code])); ?>">
                    <span class="sub-item"><?php echo e(__('Section Titles')); ?></span>
                  </a>
                </li>

                <li class="<?php echo e(request()->routeIs('admin.home_page.about_section') ? 'active' : ''); ?>">
                  <a href="<?php echo e(route('admin.home_page.about_section', ['language' => $defaultLang->code])); ?>">
                    <span class="sub-item"><?php echo e(__('About Section')); ?></span>
                  </a>
                </li>

                <li class="<?php echo e(request()->routeIs('admin.home_page.features_section') ? 'active' : ''); ?>">
                  <a href="<?php echo e(route('admin.home_page.features_section', ['language' => $defaultLang->code])); ?>">
                    <span class="sub-item"><?php echo e(__('Features Section')); ?></span>
                  </a>
                </li>

                <li class="<?php echo e(request()->routeIs('admin.home_page.testimonials_section') ? 'active' : ''); ?>">
                  <a href="<?php echo e(route('admin.home_page.testimonials_section', ['language' => $defaultLang->code])); ?>">
                    <span class="sub-item"><?php echo e(__('Testimonials Section')); ?></span>
                  </a>
                </li>
                <li class="<?php echo e(request()->routeIs('admin.home_page.calltoactionsection') ? 'active' : ''); ?>">
                  <a href="<?php echo e(route('admin.home_page.calltoactionsection', ['language' => $defaultLang->code])); ?>">
                    <span class="sub-item"><?php echo e(__('Call to action Section')); ?></span>
                  </a>
                </li>

                <li class="<?php echo e(request()->routeIs('admin.home_page.partners_section') ? 'active' : ''); ?>">
                  <a href="<?php echo e(route('admin.home_page.partners_section')); ?>">
                    <span class="sub-item"><?php echo e(__('Partners Section')); ?></span>
                  </a>
                </li>

                <li class="<?php echo e(request()->routeIs('admin.home_page.section_customization') ? 'active' : ''); ?>">
                  <a href="<?php echo e(route('admin.home_page.section_customization')); ?>">
                    <span class="sub-item"><?php echo e(__('Section Customization')); ?></span>
                  </a>
                </li>
              </ul>
            </div>
          </li>
        <?php endif; ?>

        
        <?php if(is_null($roleInfo) || (!empty($rolePermissions) && in_array('Footer', $rolePermissions))): ?>
          <li
            class="nav-item <?php if(request()->routeIs('admin.footer.logo')): ?> active 
            <?php elseif(request()->routeIs('admin.footer.content')): ?> active 
            <?php elseif(request()->routeIs('admin.home_page.newsletter_section')): ?> active 
            <?php elseif(request()->routeIs('admin.footer.quick_links')): ?> active <?php endif; ?>">
            <a data-toggle="collapse" href="#footer">
              <i class="fal fa-shoe-prints"></i>
              <p><?php echo e(__('Footer')); ?></p>
              <span class="caret"></span>
            </a>

            <div id="footer"
              class="collapse <?php if(request()->routeIs('admin.footer.logo')): ?> show 
              <?php elseif(request()->routeIs('admin.footer.content')): ?> show 
              <?php elseif(request()->routeIs('admin.home_page.newsletter_section')): ?> show 
              <?php elseif(request()->routeIs('admin.footer.quick_links')): ?> show <?php endif; ?>">
              <ul class="nav nav-collapse">
                <li class="<?php echo e(request()->routeIs('admin.footer.logo') ? 'active' : ''); ?>">
                  <a href="<?php echo e(route('admin.footer.logo')); ?>">
                    <span class="sub-item"><?php echo e(__('Logo')); ?></span>
                  </a>
                </li>

                <li class="<?php echo e(request()->routeIs('admin.footer.content') ? 'active' : ''); ?>">
                  <a href="<?php echo e(route('admin.footer.content', ['language' => $defaultLang->code])); ?>">
                    <span class="sub-item"><?php echo e(__('Content')); ?></span>
                  </a>
                </li>


                <li class="<?php echo e(request()->routeIs('admin.footer.quick_links') ? 'active' : ''); ?>">
                  <a href="<?php echo e(route('admin.footer.quick_links', ['language' => $defaultLang->code])); ?>">
                    <span class="sub-item"><?php echo e(__('Quick Links')); ?></span>
                  </a>
                </li>
                <li class="<?php echo e(request()->routeIs('admin.home_page.newsletter_section') ? 'active' : ''); ?>">
                  <a href="<?php echo e(route('admin.home_page.newsletter_section', ['language' => $defaultLang->code])); ?>">
                    <span class="sub-item"><?php echo e(__('Newsletter Section')); ?></span>
                  </a>
                </li>
              </ul>
            </div>
          </li>
        <?php endif; ?>

        
        <?php if(is_null($roleInfo) || (!empty($rolePermissions) && in_array('Blog Management', $rolePermissions))): ?>
          <li
            class="nav-item <?php if(request()->routeIs('admin.blog_management.categories')): ?> active 
            <?php elseif(request()->routeIs('admin.blog_management.posts')): ?> active 
            <?php elseif(request()->routeIs('admin.blog_management.create_post')): ?> active 
            <?php elseif(request()->routeIs('admin.blog_management.edit_post')): ?> active <?php endif; ?>">
            <a data-toggle="collapse" href="#blog">
              <i class="fal fa-blog"></i>
              <p><?php echo e(__('Blog Management')); ?></p>
              <span class="caret"></span>
            </a>

            <div id="blog"
              class="collapse 
              <?php if(request()->routeIs('admin.blog_management.categories')): ?> show 
              <?php elseif(request()->routeIs('admin.blog_management.posts')): ?> show 
              <?php elseif(request()->routeIs('admin.blog_management.create_post')): ?> show 
              <?php elseif(request()->routeIs('admin.blog_management.edit_post')): ?> show <?php endif; ?>">
              <ul class="nav nav-collapse">
                <li class="<?php echo e(request()->routeIs('admin.blog_management.categories') ? 'active' : ''); ?>">
                  <a href="<?php echo e(route('admin.blog_management.categories', ['language' => $defaultLang->code])); ?>">
                    <span class="sub-item"><?php echo e('Categories'); ?></span>
                  </a>
                </li>

                <li
                  class="<?php if(request()->routeIs('admin.blog_management.posts')): ?> active 
                  <?php elseif(request()->routeIs('admin.blog_management.create_post')): ?> active 
                  <?php elseif(request()->routeIs('admin.blog_management.edit_post')): ?> active <?php endif; ?>">
                  <a href="<?php echo e(route('admin.blog_management.posts', ['language' => $defaultLang->code])); ?>">
                    <span class="sub-item"><?php echo e(__('Posts')); ?></span>
                  </a>
                </li>
              </ul>
            </div>
          </li>
        <?php endif; ?>

        
        <?php if(is_null($roleInfo) || (!empty($rolePermissions) && in_array('FAQ Management', $rolePermissions))): ?>
          <li class="nav-item <?php echo e(request()->routeIs('admin.faq_management') ? 'active' : ''); ?>">
            <a href="<?php echo e(route('admin.faq_management', ['language' => $defaultLang->code])); ?>">
              <i class="la flaticon-round"></i>
              <p><?php echo e(__('FAQ Management')); ?></p>
            </a>
          </li>
        <?php endif; ?>

        
        <?php if(is_null($roleInfo) || (!empty($rolePermissions) && in_array('Custom Pages', $rolePermissions))): ?>
          <li
            class="nav-item <?php if(request()->routeIs('admin.custom_pages')): ?> active 
            <?php elseif(request()->routeIs('admin.custom_pages.create_page')): ?> active 
            <?php elseif(request()->routeIs('admin.custom_pages.edit_page')): ?> active <?php endif; ?>">
            <a href="<?php echo e(route('admin.custom_pages', ['language' => $defaultLang->code])); ?>">
              <i class="la flaticon-file"></i>
              <p><?php echo e(__('Custom Pages')); ?></p>
            </a>
          </li>
        <?php endif; ?>

        
        <?php if(is_null($roleInfo) || (!empty($rolePermissions) && in_array('Advertise', $rolePermissions))): ?>
          <li
            class="nav-item <?php if(request()->routeIs('admin.advertise.settings')): ?> active 
            <?php elseif(request()->routeIs('admin.advertise.all_advertisement')): ?> active <?php endif; ?>">
            <a data-toggle="collapse" href="#abecex">
              <i class="fab fa-buysellads"></i>
              <p><?php echo e(__('Advertise')); ?></p>
              <span class="caret"></span>
            </a>

            <div id="abecex"
              class="collapse <?php if(request()->routeIs('admin.advertise.settings')): ?> show 
            <?php elseif(request()->routeIs('admin.advertise.all_advertisement')): ?> show <?php endif; ?>">
              <ul class="nav nav-collapse">
                <li class="<?php echo e(request()->routeIs('admin.advertise.settings') ? 'active' : ''); ?>">
                  <a href="<?php echo e(route('admin.advertise.settings')); ?>">
                    <span class="sub-item"><?php echo e(__('Settings')); ?></span>
                  </a>
                </li>

                <li class="<?php echo e(request()->routeIs('admin.advertise.all_advertisement') ? 'active' : ''); ?>">
                  <a href="<?php echo e(route('admin.advertise.all_advertisement')); ?>">
                    <span class="sub-item"><?php echo e(__('All Advertisement')); ?></span>
                  </a>
                </li>
              </ul>
            </div>
          </li>
        <?php endif; ?>

        
        <?php if(is_null($roleInfo) || (!empty($rolePermissions) && in_array('Announcement Popups', $rolePermissions))): ?>
          <li
            class="nav-item <?php if(request()->routeIs('admin.announcement_popups')): ?> active 
            <?php elseif(request()->routeIs('admin.announcement_popups.select_popup_type')): ?> active 
            <?php elseif(request()->routeIs('admin.announcement_popups.create_popup')): ?> active 
            <?php elseif(request()->routeIs('admin.announcement_popups.edit_popup')): ?> active <?php endif; ?>">
            <a href="<?php echo e(route('admin.announcement_popups', ['language' => $defaultLang->code])); ?>">
              <i class="fal fa-bullhorn"></i>
              <p><?php echo e(__('Announcement Popups')); ?></p>
            </a>
          </li>
        <?php endif; ?>


        
        <?php if(is_null($roleInfo) || (!empty($rolePermissions) && in_array('Basic Settings', $rolePermissions))): ?>
          <li
            class="nav-item <?php if(request()->routeIs('admin.basic_settings.favicon')): ?> active
            <?php elseif(request()->routeIs('admin.basic_settings.logo')): ?> active
            <?php elseif(request()->routeIs('admin.basic_settings.information')): ?> active
            <?php elseif(request()->routeIs('admin.basic_settings.timezone')): ?> active
            <?php elseif(request()->routeIs('admin.basic_settings.theme_and_home')): ?> active
            <?php elseif(request()->routeIs('admin.basic_settings.currency')): ?> active
            <?php elseif(request()->routeIs('admin.basic_settings.appearance')): ?> active
            <?php elseif(request()->routeIs('admin.basic_settings.mail_from_admin')): ?> active
            <?php elseif(request()->routeIs('admin.basic_settings.mail_to_admin')): ?> active
            <?php elseif(request()->routeIs('admin.basic_settings.mail_templates')): ?> active
            <?php elseif(request()->routeIs('admin.basic_settings.edit_mail_template')): ?> active
            <?php elseif(request()->routeIs('admin.basic_settings.breadcrumb')): ?> active
            <?php elseif(request()->routeIs('admin.basic_settings.page_headings')): ?> active
            <?php elseif(request()->routeIs('admin.basic_settings.plugins')): ?> active
            <?php elseif(request()->routeIs('admin.basic_settings.seo')): ?> active
            <?php elseif(request()->routeIs('admin.basic_settings.maintenance_mode')): ?> active
            <?php elseif(request()->routeIs('admin.basic_settings.cookie_alert')): ?> active
            <?php elseif(request()->routeIs('admin.basic_settings.social_medias')): ?> active <?php endif; ?>">
            <a data-toggle="collapse" href="#basic_settings">
              <i class="la flaticon-settings"></i>
              <p><?php echo e(__('Basic Settings')); ?></p>
              <span class="caret"></span>
            </a>

            <div id="basic_settings"
              class="collapse 
              <?php if(request()->routeIs('admin.basic_settings.favicon')): ?> show
              <?php elseif(request()->routeIs('admin.basic_settings.logo')): ?> show
              <?php elseif(request()->routeIs('admin.basic_settings.information')): ?> show
              <?php elseif(request()->routeIs('admin.basic_settings.timezone')): ?> show
              <?php elseif(request()->routeIs('admin.basic_settings.theme_and_home')): ?> show
              <?php elseif(request()->routeIs('admin.basic_settings.currency')): ?> show
              <?php elseif(request()->routeIs('admin.basic_settings.appearance')): ?> show
              <?php elseif(request()->routeIs('admin.basic_settings.mail_from_admin')): ?> show
              <?php elseif(request()->routeIs('admin.basic_settings.mail_to_admin')): ?> show
              <?php elseif(request()->routeIs('admin.basic_settings.mail_templates')): ?> show
              <?php elseif(request()->routeIs('admin.basic_settings.edit_mail_template')): ?> show
              <?php elseif(request()->routeIs('admin.basic_settings.breadcrumb')): ?> show
              <?php elseif(request()->routeIs('admin.basic_settings.page_headings')): ?> show
              <?php elseif(request()->routeIs('admin.basic_settings.plugins')): ?> show
              <?php elseif(request()->routeIs('admin.basic_settings.seo')): ?> show
              <?php elseif(request()->routeIs('admin.basic_settings.maintenance_mode')): ?> show
              <?php elseif(request()->routeIs('admin.basic_settings.cookie_alert')): ?> show
              <?php elseif(request()->routeIs('admin.basic_settings.social_medias')): ?> show <?php endif; ?>">
              <ul class="nav nav-collapse">
                <li class="<?php echo e(request()->routeIs('admin.basic_settings.favicon') ? 'active' : ''); ?>">
                  <a href="<?php echo e(route('admin.basic_settings.favicon')); ?>">
                    <span class="sub-item"><?php echo e(__('Favicon')); ?></span>
                  </a>
                </li>

                <li class="<?php echo e(request()->routeIs('admin.basic_settings.logo') ? 'active' : ''); ?>">
                  <a href="<?php echo e(route('admin.basic_settings.logo')); ?>">
                    <span class="sub-item"><?php echo e(__('Logo')); ?></span>
                  </a>
                </li>

                <li class="<?php echo e(request()->routeIs('admin.basic_settings.information') ? 'active' : ''); ?>">
                  <a href="<?php echo e(route('admin.basic_settings.information')); ?>">
                    <span class="sub-item"><?php echo e('Information'); ?></span>
                  </a>
                </li>

                <li class="<?php echo e(request()->routeIs('admin.basic_settings.timezone') ? 'active' : ''); ?>">
                  <a href="<?php echo e(route('admin.basic_settings.timezone')); ?>">
                    <span class="sub-item"><?php echo e(__('Timezone')); ?></span>
                  </a>
                </li>

                <li class="<?php echo e(request()->routeIs('admin.basic_settings.theme_and_home') ? 'active' : ''); ?>">
                  <a href="<?php echo e(route('admin.basic_settings.theme_and_home')); ?>">
                    <span class="sub-item"><?php echo e(__('Theme & Home')); ?></span>
                  </a>
                </li>

                <li class="<?php echo e(request()->routeIs('admin.basic_settings.currency') ? 'active' : ''); ?>">
                  <a href="<?php echo e(route('admin.basic_settings.currency')); ?>">
                    <span class="sub-item"><?php echo e(__('Currency')); ?></span>
                  </a>
                </li>

                <li class="<?php echo e(request()->routeIs('admin.basic_settings.appearance') ? 'active' : ''); ?>">
                  <a href="<?php echo e(route('admin.basic_settings.appearance')); ?>">
                    <span class="sub-item"><?php echo e(__('Website Appearance')); ?></span>
                  </a>
                </li>

                <li class="submenu">
                  <a data-toggle="collapse" href="#mail-settings"
                    aria-expanded="<?php echo e(request()->routeIs('admin.basic_settings.mail_from_admin') || request()->routeIs('admin.basic_settings.mail_to_admin') || request()->routeIs('admin.basic_settings.mail_templates') || request()->routeIs('admin.basic_settings.edit_mail_template') ? 'true' : 'false'); ?>">
                    <span class="sub-item"><?php echo e(__('Email Settings')); ?></span>
                    <span class="caret"></span>
                  </a>

                  <div id="mail-settings"
                    class="collapse 
                    <?php if(request()->routeIs('admin.basic_settings.mail_from_admin')): ?> show 
                    <?php elseif(request()->routeIs('admin.basic_settings.mail_to_admin')): ?> show
                    <?php elseif(request()->routeIs('admin.basic_settings.mail_templates')): ?> show
                    <?php elseif(request()->routeIs('admin.basic_settings.edit_mail_template')): ?> show <?php endif; ?>">
                    <ul class="nav nav-collapse subnav">
                      <li class="<?php echo e(request()->routeIs('admin.basic_settings.mail_from_admin') ? 'active' : ''); ?>">
                        <a href="<?php echo e(route('admin.basic_settings.mail_from_admin')); ?>">
                          <span class="sub-item"><?php echo e(__('Mail From Admin')); ?></span>
                        </a>
                      </li>

                      <li class="<?php echo e(request()->routeIs('admin.basic_settings.mail_to_admin') ? 'active' : ''); ?>">
                        <a href="<?php echo e(route('admin.basic_settings.mail_to_admin')); ?>">
                          <span class="sub-item"><?php echo e(__('Mail To Admin')); ?></span>
                        </a>
                      </li>

                      <li
                        class="<?php if(request()->routeIs('admin.basic_settings.mail_templates')): ?> active 
                        <?php elseif(request()->routeIs('admin.basic_settings.edit_mail_template')): ?> active <?php endif; ?>">
                        <a href="<?php echo e(route('admin.basic_settings.mail_templates')); ?>">
                          <span class="sub-item"><?php echo e(__('Mail Templates')); ?></span>
                        </a>
                      </li>
                    </ul>
                  </div>
                </li>

                <li class="<?php echo e(request()->routeIs('admin.basic_settings.breadcrumb') ? 'active' : ''); ?>">
                  <a href="<?php echo e(route('admin.basic_settings.breadcrumb')); ?>">
                    <span class="sub-item"><?php echo e(__('Breadcrumb')); ?></span>
                  </a>
                </li>

                <li class="<?php echo e(request()->routeIs('admin.basic_settings.page_headings') ? 'active' : ''); ?>">
                  <a href="<?php echo e(route('admin.basic_settings.page_headings', ['language' => $defaultLang->code])); ?>">
                    <span class="sub-item"><?php echo e(__('Page Headings')); ?></span>
                  </a>
                </li>

                <li class="<?php echo e(request()->routeIs('admin.basic_settings.plugins') ? 'active' : ''); ?>">
                  <a href="<?php echo e(route('admin.basic_settings.plugins')); ?>">
                    <span class="sub-item"><?php echo e(__('Plugins')); ?></span>
                  </a>
                </li>

                <li class="<?php echo e(request()->routeIs('admin.basic_settings.seo') ? 'active' : ''); ?>">
                  <a href="<?php echo e(route('admin.basic_settings.seo', ['language' => $defaultLang->code])); ?>">
                    <span class="sub-item"><?php echo e(__('SEO Informations')); ?></span>
                  </a>
                </li>

                <li class="<?php echo e(request()->routeIs('admin.basic_settings.maintenance_mode') ? 'active' : ''); ?>">
                  <a href="<?php echo e(route('admin.basic_settings.maintenance_mode')); ?>">
                    <span class="sub-item"><?php echo e(__('Maintenance Mode')); ?></span>
                  </a>
                </li>

                <li class="<?php echo e(request()->routeIs('admin.basic_settings.cookie_alert') ? 'active' : ''); ?>">
                  <a href="<?php echo e(route('admin.basic_settings.cookie_alert', ['language' => $defaultLang->code])); ?>">
                    <span class="sub-item"><?php echo e(__('Cookie Alert')); ?></span>
                  </a>
                </li>

                <li class="<?php echo e(request()->routeIs('admin.basic_settings.social_medias') ? 'active' : ''); ?>">
                  <a href="<?php echo e(route('admin.basic_settings.social_medias')); ?>">
                    <span class="sub-item"><?php echo e(__('Social Medias')); ?></span>
                  </a>
                </li>
              </ul>
            </div>
          </li>
        <?php endif; ?>

        
        <?php if(is_null($roleInfo) || (!empty($rolePermissions) && in_array('Payment Gateways', $rolePermissions))): ?>
          <li
            class="nav-item <?php if(request()->routeIs('admin.payment_gateways.online_gateways')): ?> active 
            <?php elseif(request()->routeIs('admin.payment_gateways.offline_gateways')): ?> active <?php endif; ?>">
            <a data-toggle="collapse" href="#payment_gateways">
              <i class="la flaticon-paypal"></i>
              <p><?php echo e(__('Payment Gateways')); ?></p>
              <span class="caret"></span>
            </a>

            <div id="payment_gateways"
              class="collapse 
              <?php if(request()->routeIs('admin.payment_gateways.online_gateways')): ?> show 
              <?php elseif(request()->routeIs('admin.payment_gateways.offline_gateways')): ?> show <?php endif; ?>">
              <ul class="nav nav-collapse">
                <li class="<?php echo e(request()->routeIs('admin.payment_gateways.online_gateways') ? 'active' : ''); ?>">
                  <a href="<?php echo e(route('admin.payment_gateways.online_gateways')); ?>">
                    <span class="sub-item"><?php echo e(__('Online Gateways')); ?></span>
                  </a>
                </li>

                <li class="<?php echo e(request()->routeIs('admin.payment_gateways.offline_gateways') ? 'active' : ''); ?>">
                  <a href="<?php echo e(route('admin.payment_gateways.offline_gateways')); ?>">
                    <span class="sub-item"><?php echo e(__('Offline Gateways')); ?></span>
                  </a>
                </li>
              </ul>
            </div>
          </li>
        <?php endif; ?>
        
        <?php if(is_null($roleInfo) || (!empty($rolePermissions) && in_array('Admin Management', $rolePermissions))): ?>
          <li
            class="nav-item <?php if(request()->routeIs('admin.admin_management.role_permissions')): ?> active 
            <?php elseif(request()->routeIs('admin.admin_management.role.permissions')): ?> active 
            <?php elseif(request()->routeIs('admin.admin_management.registered_admins')): ?> active <?php endif; ?>">
            <a data-toggle="collapse" href="#admin">
              <i class="fal fa-users-cog"></i>
              <p><?php echo e(__('Admin Management')); ?></p>
              <span class="caret"></span>
            </a>

            <div id="admin"
              class="collapse 
              <?php if(request()->routeIs('admin.admin_management.role_permissions')): ?> show 
              <?php elseif(request()->routeIs('admin.admin_management.role.permissions')): ?> show 
              <?php elseif(request()->routeIs('admin.admin_management.registered_admins')): ?> show <?php endif; ?>">
              <ul class="nav nav-collapse">
                <li
                  class="<?php if(request()->routeIs('admin.admin_management.role_permissions')): ?> active 
                  <?php elseif(request()->routeIs('admin.admin_management.role.permissions')): ?> active <?php endif; ?>">
                  <a href="<?php echo e(route('admin.admin_management.role_permissions')); ?>">
                    <span class="sub-item"><?php echo e(__('Role & Permissions')); ?></span>
                  </a>
                </li>

                <li class="<?php echo e(request()->routeIs('admin.admin_management.registered_admins') ? 'active' : ''); ?>">
                  <a href="<?php echo e(route('admin.admin_management.registered_admins')); ?>">
                    <span class="sub-item"><?php echo e(__('Registered Admins')); ?></span>
                  </a>
                </li>
              </ul>
            </div>
          </li>
        <?php endif; ?>

        
        <?php if(is_null($roleInfo) || (!empty($rolePermissions) && in_array('Language Management', $rolePermissions))): ?>
          <li
            class="nav-item <?php if(request()->routeIs('admin.language_management')): ?> active 
                        <?php elseif(request()->routeIs('admin.language_management.edit_keyword')): ?> active
                        <?php elseif(request()->routeIs('admin.language_management.settings')): ?> active <?php endif; ?>">

            <a data-toggle="collapse" href="#language_management">
              <i class="fal fa-language"></i>
              <p><?php echo e(__('Language Management')); ?></p>
              <span class="caret"></span>
            </a>
            <div id="language_management"
              class="collapse 
                            <?php if(request()->routeIs('admin.language_management')): ?> show
                            <?php elseif(request()->routeIs('admin.language_management.edit_keyword')): ?> show
                            <?php elseif(request()->routeIs('admin.language_management.settings')): ?> show <?php endif; ?>">
              <ul class="nav
                            nav-collapse">
                <li class="<?php echo e(request()->routeIs('admin.language_management.settings') ? 'active' : ''); ?>">
                  <a href="<?php echo e(route('admin.language_management.settings', ['language' => $defaultLang->code])); ?>">
                    <span class="sub-item"><?php echo e(__('Settings')); ?></span>
                  </a>
                </li>

                <li
                  class="<?php echo e(request()->routeIs('admin.language_management') || request()->routeIs('admin.language_management.edit_keyword') ? 'active' : ''); ?>">
                  <a href="<?php echo e(route('admin.language_management')); ?>">
                    <span class="sub-item"><?php echo e(__('Languages')); ?></span>
                  </a>
                </li>
              </ul>
            </div>
          </li>
        <?php endif; ?>

      </ul>
    </div>
  </div>
</div>
<?php /**PATH C:\Users\younes\Downloads\junspro-main (1)\junspro-main3\resources\views\backend\partials\side-navbar.blade.php ENDPATH**/ ?>