<!-- Header-area start -->
<header class="header-area header_v1" data-aos="fade-down">
  <!-- Start mobile menu -->
  <div class="mobile-menu">
    <div class="container">
      <div class="mobile-menu-wrapper"></div>
    </div>
  </div>
  <!-- End mobile menu -->
  <div class="main-responsive-nav">
    <div class="container">
      <!-- Mobile Logo -->
        <div class="logo">
        <a href="<?php echo e(route('index')); ?>" class="junspro-logo" target="_self" title="Junspro">
          <span class="junspro-logo-top">
            <span class="junspro-logo-text-wrapper">
              <span class="junspro-logo-text">JUNSPRO</span>
              <span class="junspro-logo-line"></span>
            </span>
            <img src="<?php echo e(asset('assets/img/logo.png')); ?>?v=<?php echo e(time()); ?>" class="junspro-logo-icon" alt="Junspro">
          </span>
          </a>
        </div>
      <!-- Menu toggle button -->
      <button class="menu-toggler" type="button">
        <span></span>
        <span></span>
        <span></span>
      </button>
    </div>
  </div>

  <div class="main-navbar">
    <div class="container-fluid px-xl-5">
      <nav class="navbar navbar-expand-lg">
        <!-- Logo -->
        <a class="navbar-brand junspro-logo-brand" href="<?php echo e(route('index')); ?>" target="_self" title="Junspro">
          <span class="junspro-logo">
            <span class="junspro-logo-top">
              <span class="junspro-logo-text-wrapper">
                <span class="junspro-logo-text"><span class="junspro-j">J</span>UNSPR<span class="junspro-o">O</span></span>
                <span class="junspro-logo-line"></span>
              </span>
              <span class="brand-icon-wrapper">
                <img src="<?php echo e(asset('assets/img/logo.png')); ?>?v=<?php echo e(time()); ?>" class="junspro-logo-icon" alt="Junspro">
              </span>
            </span>
          </span>
        </a>
        <!-- Navigation items -->
        <div class="collapse navbar-collapse">
          <ul id="mainMenu" class="navbar-nav mobile-item mx-auto">
            <?php $menuDatas = json_decode($menuInfos); ?>

            <?php $__currentLoopData = $menuDatas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $menuData): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <?php 
                // Filtrer les éléments redondants
                if (isset($menuData->type) && ($menuData->type == 'home' || $menuData->type == 'contact')) {
                  continue;
                }
                $href = get_href($menuData); 
              ?>
              <?php if(!property_exists($menuData, 'children')): ?>
                <li class="nav-item">
                  <a class="nav-link" href="<?php echo e($href); ?>"><?php echo e(str_replace(['Tarification', 'Tarificatication'], 'Abonnement', $menuData->text)); ?></a>
                </li>
              <?php else: ?>
                <li class="nav-item">
                  <a class="nav-link toggle" href="<?php echo e($href); ?>"><?php echo e(str_replace(['Tarification', 'Tarificatication'], 'Abonnement', $menuData->text)); ?><i
                      class="fal fa-plus"></i></a>
                  <ul class="menu-dropdown">
                    <?php $childMenuDatas = $menuData->children; ?>

                    <?php $__currentLoopData = $childMenuDatas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $childMenuData): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <?php 
                        // Filtrer les éléments redondants dans les sous-menus
                        if (isset($childMenuData->type) && ($childMenuData->type == 'home' || $childMenuData->type == 'contact')) {
                          continue;
                        }
                        $child_href = get_href($childMenuData); 
                      ?>
                      <li class="nav-item">
                        <a class="nav-link" href="<?php echo e($child_href); ?>"><?php echo e(str_replace(['Tarification', 'Tarificatication'], 'Abonnement', $childMenuData->text)); ?></a>
                      </li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </ul>
                </li>
              <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </ul>
        </div>
        <div class="more-option mobile-item">
          
          <div class="item pause-souffle-header-capsule-item">
            <?php echo $__env->make('frontend.components.pause-souffle.header-capsule-premium', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
          </div>
          <?php if($basicInfo->is_language == 1): ?>
            <div class="item">
              <div class="language">
                <form action="<?php echo e(route('change_language')); ?>" method="GET">
                  <select class="niceselect" name="lang_code" onchange="this.form.submit()">
                    <?php $__currentLoopData = $allLanguageInfos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $languageInfo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <option value="<?php echo e($languageInfo->code); ?>" <?php if($languageInfo->code == $currentLanguageInfo->code): echo 'selected'; endif; ?>>
                        <?php echo e($languageInfo->name); ?>

                      </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </select>
                </form>
              </div>
            </div>
          <?php endif; ?>
          <div class="item">
            <a href="#searchBox" class="btn-search btn-icon rounded-1" target="_self" aria-label="Search Form"
              title="<?php echo e(__('Search Form')); ?>" data-effect="mfp-zoom-in">
              <i class="far fa-search"></i>
            </a>
            <div id="searchBox" class="search-box mx-auto mfp-with-anim mfp-hide mt-30">
              <form action="<?php echo e(route('services')); ?>" method="GET">
                <div class="input-inline p-1 border radius-sm">
                  <input class="form-control border-0 color-light" placeholder="<?php echo e(__('Search Service') . '...'); ?>"
                    type="text" name="keyword">
                  <button class="btn-icon radius-sm" type="submit" aria-label="button">
                    <i class="far fa-search"></i>
                  </button>
                </div>
              </form>
            </div>
          </div>
          
          <?php if(auth()->guard('seller')->check()): ?>
          <div class="item">
            <div class="dropdown">
                <button class="user-menu-btn dropdown-toggle" type="button" data-bs-toggle="dropdown"
                  aria-expanded="false" style="background: linear-gradient(135deg, #6B7280 0%, #4B5563 100%);">
                  <?php if(Auth::guard('seller')->user()->photo): ?>
                    <img src="<?php echo e(asset('assets/admin/img/seller-photo/' . Auth::guard('seller')->user()->photo)); ?>" 
                         alt="Freelance">
                  <?php else: ?>
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                      <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                      <circle cx="12" cy="7" r="4"></circle>
                    </svg>
                  <?php endif; ?>
              </button>
                <ul class="dropdown-menu dropdown-menu-end user-menu-premium">
                  <li>
                    <a class="dropdown-item" href="<?php echo e(route('seller.dashboard')); ?>">
                      <svg class="menu-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <rect x="3" y="3" width="7" height="7"></rect>
                        <rect x="14" y="3" width="7" height="7"></rect>
                        <rect x="14" y="14" width="7" height="7"></rect>
                        <rect x="3" y="14" width="7" height="7"></rect>
                      </svg>
                      <span><?php echo e(__('Dashboard')); ?></span>
                    </a>
                  </li>
                  <li>
                    <a class="dropdown-item" href="<?php echo e(route('seller.logout')); ?>">
                      <svg class="menu-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                        <polyline points="16 17 21 12 16 7"></polyline>
                        <line x1="21" y1="12" x2="9" y2="12"></line>
                      </svg>
                      <span><?php echo e(__('Logout')); ?></span>
                    </a>
                  </li>
              </ul>
            </div>
          </div>
          <?php endif; ?>

          
          <div class="item">
            <div class="dropdown">
              <button class="user-menu-btn dropdown-toggle" type="button" data-bs-toggle="dropdown"
                aria-expanded="false">
                <?php if(auth()->guard('web')->check()): ?>
                  <?php if(Auth::guard('web')->user()->image): ?>
                    <img src="<?php echo e(asset('assets/img/users/' . Auth::guard('web')->user()->image)); ?>" 
                         alt="User">
                  <?php else: ?>
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                      <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                      <circle cx="12" cy="7" r="4"></circle>
                    </svg>
                  <?php endif; ?>
                <?php else: ?>
                  <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                    <circle cx="12" cy="7" r="4"></circle>
                  </svg>
                <?php endif; ?>
              </button>
              <ul class="dropdown-menu dropdown-menu-end user-menu-premium">
                <?php if(auth()->guard('web')->guest()): ?>
                  <li>
                    <a class="dropdown-item" href="<?php echo e(route('user.login')); ?>">
                      <svg class="menu-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4"></path>
                        <polyline points="10 17 15 12 10 7"></polyline>
                        <line x1="15" y1="12" x2="3" y2="12"></line>
                      </svg>
                      <span><?php echo e(__('Connexion')); ?></span>
                    </a>
                  </li>
                  <li>
                    <a class="dropdown-item" href="<?php echo e(route('user.signup')); ?>">
                      <svg class="menu-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path>
                        <circle cx="9" cy="7" r="4"></circle>
                        <line x1="19" y1="8" x2="19" y2="14"></line>
                        <line x1="22" y1="11" x2="16" y2="11"></line>
                      </svg>
                      <span><?php echo e(__('Inscription')); ?></span>
                    </a>
                  </li>
                <?php endif; ?>
                <?php if(auth()->guard('web')->check()): ?>
                  <li>
                    <a class="dropdown-item" href="<?php echo e(route('user.dashboard')); ?>">
                      <svg class="menu-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <rect x="3" y="3" width="7" height="7"></rect>
                        <rect x="14" y="3" width="7" height="7"></rect>
                        <rect x="14" y="14" width="7" height="7"></rect>
                        <rect x="3" y="14" width="7" height="7"></rect>
                      </svg>
                      <span><?php echo e(__('Dashboard')); ?></span>
                    </a>
                  </li>
                  <li>
                    <a class="dropdown-item" href="<?php echo e(route('user.logout')); ?>">
                      <svg class="menu-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                        <polyline points="16 17 21 12 16 7"></polyline>
                        <line x1="21" y1="12" x2="9" y2="12"></line>
                      </svg>
                      <span><?php echo e(__('Logout')); ?></span>
                    </a>
                  </li>
                <?php endif; ?>
              </ul>
            </div>
          </div>
        </div>
      </nav>
    </div>
  </div>

</header>
<!-- Header-area end -->
<?php /**PATH C:\Users\younes\Downloads\junspro-main (1)\junspro-main3\resources\views\frontend\partials\header\header-nav-v2.blade.php ENDPATH**/ ?>