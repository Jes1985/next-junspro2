<div class="sidebar sidebar-style-2"
  data-background-color="<?php echo e(Session::get('seller_theme_version') == 'light' ? 'white' : 'dark2'); ?>">
  <div class="sidebar-wrapper scrollbar scrollbar-inner">
    <div class="sidebar-content">
      <div class="user">
        <div class="avatar-sm float-left mr-2">
          <?php if(Auth::guard('seller')->user()->photo != null): ?>
            <img src="<?php echo e(asset('assets/admin/img/seller-photo/' . Auth::guard('seller')->user()->photo)); ?>"
              alt="Seller Image" class="avatar-img rounded-circle">
          <?php else: ?>
            <img src="<?php echo e(asset('assets/img/seller-blank-user.jpg')); ?>" alt="" class="avatar-img rounded-circle">
          <?php endif; ?>
        </div>

        <div class="info">
          <a data-toggle="collapse" href="#adminProfileMenu" aria-expanded="true">
            <span>
              <?php echo e(Auth::guard('seller')->user()->username); ?>

              <span class="user-level">Seller</span>
              <span class="caret"></span>
            </span>
          </a>

          <div class="clearfix"></div>

          <div class="collapse in" id="adminProfileMenu">
            <ul class="nav">
              <li>
                <a href="<?php echo e(route('seller.edit.profile')); ?>">
                  <span class="link-collapse">Edit Profile</span>
                </a>
              </li>

              <li>
                <a href="<?php echo e(route('seller.change_password')); ?>">
                  <span class="link-collapse">Change Password</span>
                </a>
              </li>

              <li>
                <a href="<?php echo e(route('seller.logout')); ?>">
                  <span class="link-collapse">Logout</span>
                </a>
              </li>
            </ul>
          </div>
        </div>
      </div>


      <ul class="nav nav-primary">
        
        <div class="row mb-3">
          <div class="col-12">
            <form>
              <div class="form-group py-0">
                <input name="term" type="text" class="form-control sidebar-search ltr"
                  placeholder="Search Menu Here...">
              </div>
            </form>
          </div>
        </div>
        <?php
          $seller = Auth::guard('seller')->user();
          $package = \App\Http\Helpers\SellerPermissionHelper::currentPackagePermission($seller->id);
        ?>
        
        <li class="nav-item <?php if(request()->routeIs('seller.dashboard')): ?> active <?php endif; ?>">
          <a href="<?php echo e(route('seller.dashboard')); ?>">
            <i class="fal fa-tachometer-alt-average"></i>
            <p>Dashboard</p>
          </a>
        </li>

        
        <li
          class="nav-item <?php if(request()->routeIs('seller.service_management.services')): ?> active 
            <?php elseif(request()->routeIs('seller.service_management.create_service')): ?> active 
            <?php elseif(request()->routeIs('seller.service_management.edit_service')): ?> active 
            <?php elseif(request()->routeIs('seller.service_management.service.packages')): ?> active 
            <?php elseif(request()->routeIs('seller.service_management.service.addons')): ?> active 
            <?php elseif(request()->routeIs('seller.service_management.service.faqs')): ?> active 
            <?php elseif(request()->routeIs('seller.service_management.forms')): ?> active 
            <?php elseif(request()->routeIs('seller.service_management.form.input')): ?> active 
            <?php elseif(request()->routeIs('seller.service_management.form.edit_input')): ?> active <?php endif; ?>">
          <a data-toggle="collapse" href="#service">
            <i class="fal fa-headset"></i>
            <p>Service Management</p>
            <span class="caret"></span>
          </a>

          <div id="service"
            class="collapse 
              <?php if(request()->routeIs('seller.service_management.services')): ?> show 
              <?php elseif(request()->routeIs('seller.service_management.create_service')): ?> show 
              <?php elseif(request()->routeIs('seller.service_management.edit_service')): ?> show 
              <?php elseif(request()->routeIs('seller.service_management.service.packages')): ?> show 
              <?php elseif(request()->routeIs('seller.service_management.service.addons')): ?> show 
              <?php elseif(request()->routeIs('seller.service_management.service.faqs')): ?> show
              <?php elseif(request()->routeIs('seller.service_management.forms')): ?> show
              <?php elseif(request()->routeIs('seller.service_management.form.input')): ?> show 
              <?php elseif(request()->routeIs('seller.service_management.form.edit_input')): ?> show <?php endif; ?>">
            <ul class="nav nav-collapse">
              <li
                class="<?php if(request()->routeIs('seller.service_management.forms')): ?> active 
                  <?php elseif(request()->routeIs('seller.service_management.form.input')): ?> active 
                  <?php elseif(request()->routeIs('seller.service_management.form.edit_input')): ?> active <?php endif; ?>">
                <a href="<?php echo e(route('seller.service_management.forms', ['language' => $defaultLang->code])); ?>">
                  <span class="sub-item">Forms</span>
                </a>
              </li>
              <li class=" 
                  <?php if(request()->routeIs('seller.service_management.create_service')): ?> active <?php endif; ?>">
                <a href="<?php echo e(route('seller.service_management.create_service', ['language' => $defaultLang->code])); ?>">
                  <span class="sub-item">Add Service</span>
                </a>
              </li>
              <li
                class="<?php if(request()->routeIs('seller.service_management.services')): ?> active 
                  <?php elseif(request()->routeIs('seller.service_management.edit_service')): ?> active 
                  <?php elseif(request()->routeIs('seller.service_management.service.packages')): ?> active 
                  <?php elseif(request()->routeIs('seller.service_management.service.addons')): ?> active 
                  <?php elseif(request()->routeIs('seller.service_management.service.faqs')): ?> active <?php endif; ?>">
                <a href="<?php echo e(route('seller.service_management.services', ['language' => $defaultLang->code])); ?>">
                  <span class="sub-item">Manage Services</span>
                </a>
              </li>
            </ul>
          </div>
        </li>

        
        <li
          class="nav-item <?php if(request()->routeIs('seller.service_orders')): ?> active 
            <?php elseif(request()->routeIs('seller.service_order.details')): ?> active 
            <?php elseif(request()->routeIs('seller.service_order.message')): ?> active 
            <?php elseif(request()->routeIs('seller.service_orders.report')): ?> active <?php endif; ?>">
          <a data-toggle="collapse" href="#service_orders">
            <i class="far fa-cubes"></i>
            <p>Service Orders</p>
            <span class="caret"></span>
          </a>

          <div id="service_orders"
            class="collapse 
              <?php if(request()->routeIs('seller.service_orders')): ?> show 
              <?php elseif(request()->routeIs('seller.service_order.details')): ?> show 
              <?php elseif(request()->routeIs('seller.service_order.message')): ?> show 
              <?php elseif(request()->routeIs('seller.service_orders.report')): ?> show <?php endif; ?>">
            <ul class="nav nav-collapse">
              <li
                class="<?php echo e(request()->routeIs('seller.service_orders') && empty(request()->input('order_status')) ? 'active' : ''); ?>">
                <a href="<?php echo e(route('seller.service_orders')); ?>">
                  <span class="sub-item">All Orders</span>
                </a>
              </li>

              <li
                class="<?php echo e(request()->routeIs('seller.service_orders') && request()->input('order_status') == 'pending' ? 'active' : ''); ?>">
                <a href="<?php echo e(route('seller.service_orders', ['order_status' => 'pending'])); ?>">
                  <span class="sub-item">Pending Orders</span>
                </a>
              </li>

              <li
                class="<?php echo e(request()->routeIs('seller.service_orders') && request()->input('order_status') == 'processing' ? 'active' : ''); ?>">
                <a href="<?php echo e(route('seller.service_orders', ['order_status' => 'processing'])); ?>">
                  <span class="sub-item">Processing Orders</span>
                </a>
              </li>

              <li
                class="<?php echo e(request()->routeIs('seller.service_orders') && request()->input('order_status') == 'completed' ? 'active' : ''); ?>">
                <a href="<?php echo e(route('seller.service_orders', ['order_status' => 'completed'])); ?>">
                  <span class="sub-item">Completed Orders</span>
                </a>
              </li>

              <li
                class="<?php echo e(request()->routeIs('seller.service_orders') && request()->input('order_status') == 'rejected' ? 'active' : ''); ?>">
                <a href="<?php echo e(route('seller.service_orders', ['order_status' => 'rejected'])); ?>">
                  <span class="sub-item">Rejected Orders</span>
                </a>
              </li>

              <li class="<?php echo e(request()->routeIs('seller.service_orders.report') ? 'active' : ''); ?>">
                <a href="<?php echo e(route('seller.service_orders.report')); ?>">
                  <span class="sub-item">Report</span>
                </a>
              </li>
            </ul>
          </div>
        </li>
        <?php if($package && $package->qr_builder_status == 1): ?>
          <li
            class="nav-item <?php if(request()->routeIs('seller.qr_codes.generate_code')): ?> active 
    <?php elseif(request()->routeIs('seller.qr_codes.saved_codes')): ?> active <?php endif; ?>">
            <a data-toggle="collapse" href="#qr_codes">
              <i class="fal fa-qrcode"></i>
              <p>QR Codes</p>
              <span class="caret"></span>
            </a>

            <div id="qr_codes"
              class="collapse 
      <?php if(request()->routeIs('seller.qr_codes.generate_code')): ?> show 
      <?php elseif(request()->routeIs('seller.qr_codes.saved_codes')): ?> show <?php endif; ?>">
              <ul class="nav nav-collapse">
                <li class="<?php echo e(request()->routeIs('seller.qr_codes.generate_code') ? 'active' : ''); ?>">
                  <a href="<?php echo e(route('seller.qr_codes.generate_code')); ?>">
                    <span class="sub-item">Generate Code</span>
                  </a>
                </li>

                <li class="<?php echo e(request()->routeIs('seller.qr_codes.saved_codes') ? 'active' : ''); ?>">
                  <a href="<?php echo e(route('seller.qr_codes.saved_codes')); ?>">
                    <span class="sub-item">Saved Codes</span>
                  </a>
                </li>
              </ul>
            </div>
          </li>
        <?php endif; ?>

        <li
          class="nav-item <?php if(request()->routeIs('seller.withdraw')): ?> active 
            <?php elseif(request()->routeIs('seller.withdraw.create')): ?>  active <?php endif; ?>">
          <a data-toggle="collapse" href="#Withdrawals">
            <i class="fal fa-donate"></i>
            <p>Withdrawals</p>
            <span class="caret"></span>
          </a>

          <div id="Withdrawals"
            class="collapse 
              <?php if(request()->routeIs('seller.withdraw')): ?> show 
              <?php elseif(request()->routeIs('seller.withdraw.create')): ?> show <?php endif; ?>">
            <ul class="nav nav-collapse">
              <li class="<?php echo e(request()->routeIs('seller.withdraw') ? 'active' : ''); ?>">
                <a href="<?php echo e(route('seller.withdraw', ['language' => $defaultLang->code])); ?>">
                  <span class="sub-item">Withdrawal Requests</span>
                </a>
              </li>

              <li class="<?php echo e(request()->routeIs('seller.withdraw.create') ? 'active' : ''); ?>">
                <a href="<?php echo e(route('seller.withdraw.create', ['language' => $defaultLang->code])); ?>">
                  <span class="sub-item">Make a Request</span>
                </a>
              </li>
            </ul>
          </div>
        </li>


        <li class="nav-item 
        <?php if(request()->routeIs('seller.transcation')): ?> active <?php endif; ?>">
          <a href="<?php echo e(route('seller.transcation')); ?>">
            <i class="fal fa-lightbulb-dollar"></i>
            <p>Transactions</p>
          </a>
        </li>
        <?php
          $support_status = DB::table('basic_settings')
              ->select('support_ticket_status')
              ->first();
        ?>
        <?php if($support_status->support_ticket_status == 1): ?>
          

          <li
            class="nav-item <?php if(request()->routeIs('seller.support_tickets')): ?> active
            <?php elseif(request()->routeIs('seller.support_tickets.message')): ?> active
            <?php elseif(request()->routeIs('seller.support_ticket.create')): ?> active <?php endif; ?>">
            <a data-toggle="collapse" href="#support_ticket">
              <i class="la flaticon-web-1"></i>
              <p>Support Tickets</p>
              <span class="caret"></span>
            </a>

            <div id="support_ticket"
              class="collapse
              <?php if(request()->routeIs('seller.support_tickets')): ?> show
              <?php elseif(request()->routeIs('seller.support_tickets.message')): ?> show
              <?php elseif(request()->routeIs('seller.support_ticket.create')): ?> show <?php endif; ?>">
              <ul class="nav nav-collapse">

                <li
                  class="<?php echo e(request()->routeIs('seller.support_tickets') && empty(request()->input('status')) ? 'active' : ''); ?>">
                  <a href="<?php echo e(route('seller.support_tickets')); ?>">
                    <span class="sub-item">All Tickets</span>
                  </a>
                </li>
                <li class="<?php echo e(request()->routeIs('seller.support_ticket.create') ? 'active' : ''); ?>">
                  <a href="<?php echo e(route('seller.support_ticket.create')); ?>">
                    <span class="sub-item">Add a Ticket</span>
                  </a>
                </li>
              </ul>
            </div>
          </li>
        <?php endif; ?>


        <li
          class="nav-item 
        <?php if(request()->routeIs('seller.plan.extend.index')): ?> active 
        <?php elseif(request()->routeIs('seller.plan.extend.checkout')): ?> active <?php endif; ?>">
          <a href="<?php echo e(route('seller.plan.extend.index')); ?>">
            <i class="fal fa-lightbulb-dollar"></i>
            <p>Buy Plan</p>
          </a>
        </li>
        <li class="nav-item <?php if(request()->routeIs('seller.subscription_log')): ?> active <?php endif; ?>">
          <a href="<?php echo e(route('seller.subscription_log')); ?>">
            <i class="fas fa-list-ol"></i>
            <p>Subscription Log</p>
          </a>
        </li>


        <li class="nav-item <?php if(request()->routeIs('seller.edit.profile')): ?> active <?php endif; ?>">
          <a href="<?php echo e(route('seller.edit.profile')); ?>">
            <i class="fal fa-user-edit"></i>
            <p>Edit Profile</p>
          </a>
        </li>
        <li class="nav-item <?php if(request()->routeIs('seller.recipient_mail')): ?> active <?php endif; ?>">
          <a href="<?php echo e(route('seller.recipient_mail')); ?>">
            <i class="fal fa-envelope"></i>
            <p>Recipient Mail</p>
          </a>
        </li>
        <li class="nav-item <?php if(request()->routeIs('seller.change_password')): ?> active <?php endif; ?>">
          <a href="<?php echo e(route('seller.change_password')); ?>">
            <i class="fal fa-key"></i>
            <p>Change Password</p>
          </a>
        </li>

        <li class="nav-item <?php if(request()->routeIs('seller.logout')): ?> active <?php endif; ?>">
          <a href="<?php echo e(route('seller.logout')); ?>">
            <i class="fal fa-sign-out"></i>
            <p>Logout</p>
          </a>
        </li>

      </ul>
    </div>
  </div>
</div>
<?php /**PATH C:\Users\younes\Downloads\junspro-main (1)\junspro-main3\resources\views\seller\partials\side-navbar.blade.php ENDPATH**/ ?>