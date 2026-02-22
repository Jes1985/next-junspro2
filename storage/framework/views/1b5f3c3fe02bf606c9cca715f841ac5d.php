<div class="main-header">
  <!-- Logo Header Start -->
  <div class="logo-header"
    data-background-color="<?php echo e(Session::get('seller_theme_version') == 'light' ? 'white' : 'dark2'); ?>">
    <?php if(!empty($websiteInfo->logo)): ?>
      <a href="<?php echo e(route('index')); ?>" class="logo" target="_blank">
        <img src="<?php echo e(asset('assets/img/' . $websiteInfo->logo)); ?>" alt="logo" class="navbar-brand" width="60">
      </a>
    <?php endif; ?>

    <button class="navbar-toggler sidenav-toggler ml-auto" type="button" data-toggle="collapse" data-target="collapse"
      aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon">
        <i class="icon-menu"></i>
      </span>
    </button>
    <button class="topbar-toggler more"><i class="icon-options-vertical"></i></button>

    <div class="nav-toggle">
      <button class="btn btn-toggle toggle-sidebar">
        <i class="icon-menu"></i>
      </button>
    </div>
  </div>
  <!-- Logo Header End -->

  <!-- Navbar Header Start -->
  <nav class="navbar navbar-header navbar-expand-lg"
    data-background-color="<?php echo e(Session::get('seller_theme_version') == 'light' ? 'white2' : 'dark'); ?>">
    <div class="container-fluid">
      <ul class="navbar-nav topbar-nav ml-md-auto align-items-center">
        <form action="<?php echo e(route('seller.change_theme')); ?>" class="form-inline mr-3" method="POST">

          <?php echo csrf_field(); ?>
          <div class="form-group">
            <div class="selectgroup selectgroup-secondary selectgroup-pills">
              <label class="selectgroup-item">
                <input type="radio" name="seller_theme_version" value="light" class="selectgroup-input"
                  <?php echo e(Session::get('seller_theme_version') == 'light' ? 'checked' : ''); ?> onchange="this.form.submit()">
                <span class="selectgroup-button selectgroup-button-icon"><i class="fa fa-sun"></i></span>
              </label>

              <label class="selectgroup-item">
                <input type="radio" name="seller_theme_version" value="dark" class="selectgroup-input"
                  <?php echo e(Session::get('seller_theme_version') == 'dark' || !Session::has('seller_theme_version') ? 'checked' : ''); ?>

                  onchange="this.form.submit()">
                <span class="selectgroup-button selectgroup-button-icon"><i class="fa fa-moon"></i></span>
              </label>
            </div>
          </div>
        </form>

        <li class="nav-item dropdown hidden-caret">
          <a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#" aria-expanded="false">
            <div class="avatar-sm">
              <?php if(Auth::guard('seller')->user()->photo != null): ?>
                <img src="<?php echo e(asset('assets/admin/img/seller-photo/' . Auth::guard('seller')->user()->photo)); ?>"
                  alt="seller Image" class="avatar-img rounded-circle">
              <?php else: ?>
                <img src="<?php echo e(asset('assets/img/seller-blank-user.jpg')); ?>" alt=""
                  class="avatar-img rounded-circle">
              <?php endif; ?>
            </div>
          </a>

          <ul class="dropdown-menu dropdown-user animated fadeIn">
            <div class="dropdown-user-scroll scrollbar-outer">
              <li>
                <div class="user-box">
                  <div class="avatar-lg">
                    <?php if(Auth::guard('seller')->user()->photo != null): ?>
                      <img src="<?php echo e(asset('assets/admin/img/seller-photo/' . Auth::guard('seller')->user()->photo)); ?>"
                        alt="seller Image" class="avatar-img rounded-circle">
                    <?php else: ?>
                      <img src="<?php echo e(asset('assets/img/seller-blank-user.jpg')); ?>" alt=""
                        class="avatar-img rounded-circle">
                    <?php endif; ?>
                  </div>

                  <div class="u-text">
                    <h4>
                      <?php echo e(Auth::guard('seller')->user()->username); ?>

                    </h4>
                    <p class="text-muted"><?php echo e(Auth::guard('seller')->user()->email); ?></p>
                  </div>
                </div>
              </li>

              <li>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="<?php echo e(route('seller.edit.profile')); ?>">
                  <?php echo e(__('Edit Profile')); ?>

                </a>

                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="<?php echo e(route('seller.change_password')); ?>">
                  <?php echo e(__('Change Password')); ?>

                </a>

                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="<?php echo e(route('seller.logout')); ?>">
                  <?php echo e(__('Logout')); ?>

                </a>
              </li>
            </div>
          </ul>
        </li>
      </ul>
    </div>
  </nav>
  <!-- Navbar Header End -->
</div>
<?php /**PATH C:\Users\younes\Downloads\junspro-main (1)\junspro-main3\resources\views\seller\partials\top-navbar.blade.php ENDPATH**/ ?>