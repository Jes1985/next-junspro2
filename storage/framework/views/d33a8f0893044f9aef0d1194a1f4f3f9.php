<?php $__env->startSection('style'); ?>
  <link rel="stylesheet" href="<?php echo e(asset('assets/css/summernote-content.css')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('pageHeading'); ?>
  <?php echo e($seller->username); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('metaKeywords'); ?>
  <?php echo e($seller->username); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('metaDescription'); ?>
  <?php echo e(@$sellerInfo->details); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
  
  <section class="breadcrumbs-area bg_cover lazyload bg-img header-next" data-bg-img="<?php echo e(asset('assets/img/' . $breadcrumb)); ?>">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-8">
          <div class="breadcrumbs-title text-center">
            <h3>
              <?php echo e($seller->username); ?>

            </h3>
            <ul class="breadcumb-link justify-content-center">
              <li><a href="<?php echo e(route('index')); ?>"><?php echo e(__('Home')); ?></a></li>
              <li class="active"><?php echo e(__('Seller Details')); ?></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </section>
  

  <!--====== Start Seller Section ======-->
  <div class="seller-area pt-100 pb-60">
    <div class="container">
      <div class="row">
        <div class="col-lg-4">
          <aside class="sidebar-widget-area">
            <div class="widget-seller-details border mb-40">
              <div class="author mb-20">
                <?php if(request()->input('admin') != true): ?>
                  <figure class="author-img">
                    <?php if(!is_null($seller->photo)): ?>
                      <img class="radius-sm lazyload" data-src="<?php echo e(asset('assets/admin/img/seller-photo/' . $seller->photo)); ?>"
                        alt="image">
                    <?php else: ?>
                      <img class="radius-sm lazyload" data-src="<?php echo e(asset('assets/img/seller-blank-user.jpg')); ?>" alt="image">
                    <?php endif; ?>
                  </figure>
                  <div class="author-info">
                    <h5 class="mb-0"><?php echo e(@$sellerInfo->name); ?></h5>

                    <p class="mb-0 mt-1"><?php echo e($seller->username); ?></p>

                    <div class="ratings mt-2 mx-auto">
                      <div class="rate bg-img"
                        data-bg-img="<?php echo e(asset('assets/front/images/rate-star.png')); ?>">
                        <div class="rating-icon bg-img" style="width: <?php echo e(SellerAvgRating($seller->id) * 20); ?>%;"
                          data-bg-img="<?php echo e(asset('assets/front/images/rate-star.png')); ?>"></div>
                      </div>
                      <span class="ratings-total">(<?php echo e(SellerAvgRating($seller->id)); ?>)</span>
                    </div>
                  </div>
                <?php else: ?>
                  <figure class="author-img">
                    <?php if(!empty($seller->image)): ?>
                      <img class="rounded-lg" src="<?php echo e(asset('assets/img/admins/' . $seller->image)); ?>" alt="image">
                    <?php else: ?>
                      <img class="rounded-lg" src="<?php echo e(asset('assets/img/blank-user.jpg')); ?>" alt="image">
                    <?php endif; ?>
                  </figure>
                  <div class="author-info">
                    <h6 class="mb-0"><?php echo e(@$seller->first_name . ' ' . $seller->last_name); ?></h6>
                    <p class="mb-0 mt-1"><?php echo e($seller->username); ?></p>
                  </div>
                <?php endif; ?>
              </div>
              <?php if(request()->input('admin') != true): ?>
                <?php if(!empty($sellerInfo) && !is_null($sellerInfo->details)): ?>
                  <div class="click-show">
                    <p class="text font-sm">
                      <b><?php echo e(__('About') . ':'); ?> </b><?php echo nl2br($sellerInfo->details); ?>

                    </p>
                  </div>
                  <?php if(strlen($sellerInfo->details) > 150): ?>
                    <div class="read-more-btn font-sm"><?php echo e(__('Read More')); ?></div>
                  <?php endif; ?>
                <?php endif; ?>
              <?php endif; ?>

              <ul class="toggle-list list-unstyled mt-15 font-sm">
                <li>
                  <span class="first"><?php echo e(__('Total Services') . ' : '); ?></span>
                  <span class="last font-sm">
                    <?php echo e(count($all_services)); ?>

                  </span>
                </li>
                <li>
                  <span class="first"><?php echo e(__('Orders Completed') . ':'); ?></span>
                  <span class="last font-sm"><?php echo e($order_completed); ?></span>
                </li>
                <?php if(request()->input('admin') != true): ?>
                  <li>
                    <span class="first"><?php echo e(__('Skills') . ':'); ?></span>
                    <span class="last font-sm">
                      <?php
                        if ($sellerInfo) {
                            if (!is_null($sellerInfo->skills)) {
                                $selected_skills = json_decode($sellerInfo->skills);
                            } else {
                                $selected_skills = [];
                            }
                        } else {
                            $selected_skills = [];
                        }
                      ?>
                      <?php $__currentLoopData = $skills; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $skill): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if(in_array($skill->id, $selected_skills)): ?>
                          <span class="badge bg-secondary"><?php echo e($skill->name); ?></span>
                          <?php if(!$loop->last): ?>
                          <?php endif; ?>
                        <?php endif; ?>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </span>
                  </li>
                  <?php if(@$seller->show_email_addresss == 1): ?>
                    <li>
                      <span class="first"><?php echo e(__('Email') . ':'); ?></span>
                      <span class="last font-sm email">
                        <span class="text-to-copy" id="textToCopy"><?php echo e(@$seller->email); ?></span>
                        <button type="button" id="copyBtn" class="btn-text" data-bs-placement="top" data-tooltip="tooltip" aria-label="List View" data-bs-original-title="<?php echo e(@$seller->email); ?>">
                          <?php echo e(__('Copy')); ?>

                        </button>
                      </span>
                    </li>
                  <?php endif; ?>
                  <?php if(@$seller->show_phone_number == 1): ?>
                    <li>
                      <span class="first"><?php echo e(__('Phone') . ':'); ?></span>
                      <span class="last font-sm"><?php echo e(@$seller->phone); ?></span>
                    </li>
                  <?php endif; ?>

                  <?php if(!empty($sellerInfo) && !is_null($sellerInfo->city)): ?>
                    <li>
                      <span class="first"><?php echo e(__('City') . ':'); ?></span>
                      <span class="last font-sm"><?php echo e($sellerInfo->city); ?></span>
                    </li>
                  <?php endif; ?>
                  <?php if(!empty($sellerInfo) && !is_null($sellerInfo->state)): ?>
                    <li>
                      <span class="first"><?php echo e(__('State') . ':'); ?></span>
                      <span class="last font-sm"><?php echo e($sellerInfo->state); ?></span>
                    </li>
                  <?php endif; ?>

                  <?php if(!empty($sellerInfo) && !is_null($sellerInfo->zip_code)): ?>
                    <li>
                      <span class="first"><?php echo e(__('Zip Code') . ':'); ?></span>
                      <span class="last font-sm"><?php echo e($sellerInfo->zip_code); ?></span>
                    </li>
                  <?php endif; ?>
                  <?php if(!empty($sellerInfo) && !is_null($sellerInfo->country)): ?>
                    <li>
                      <span class="first"><?php echo e(__('Country') . ':'); ?></span>
                      <span class="last font-sm"><?php echo e($sellerInfo->country); ?></span>
                    </li>
                  <?php endif; ?>
                  <?php if(!empty($sellerInfo) && !is_null($sellerInfo->address)): ?>
                    <li>
                      <span class="first"><?php echo e(__('Address') . ':'); ?></span>
                      <span class="last font-sm"><?php echo e($sellerInfo->address); ?></span>
                    </li>
                  <?php endif; ?>

                  <li>
                    <span class="first"><?php echo e(__('Member Since') . ':'); ?></span>
                    <span class="last font-sm"><?php echo e(\Carbon\Carbon::parse($seller->created_at)->format('dS M Y')); ?></span>
                  </li>
                <?php endif; ?>
              </ul>

              <div class="btn-groups text-center mt-20">
                <?php if($seller->show_contact_form == 1): ?>
                  <button class="btn btn-lg btn-primary radius-sm w-100 mb-10" data-bs-toggle="modal" data-bs-target="#contactModal" type="button"
                    aria-label="button"><?php echo e(__('Contact Now')); ?></button>
                <?php endif; ?>
                <?php
                  if (Auth::guard('web')->check()) {
                      $user_id = Auth::guard('web')->user()->id;
                      $type = 'user';
                  } elseif (Auth::guard('seller')->check()) {
                      $user_id = Auth::guard('seller')->user()->id;
                      $type = 'seller';
                  } else {
                      $user_id = null;
                      $type = null;
                  }
                ?>
                <?php if(followingCheck($user_id, $type, $seller->id) == false): ?>
                  <a href="<?php echo e(route('frontend.seller.follow-seller', ['user_id' => $user_id, 'type' => $type, 'following_id' => $seller->id])); ?>"
                    class="btn btn-lg btn-outline radius-sm w-100" title="Title"><?php echo e(__('Follow')); ?></a>
                <?php else: ?>
                  <a href="<?php echo e(route('frontend.seller.unfollow-seller', ['user_id' => $user_id, 'type' => $type, 'following_id' => $seller->id])); ?>"
                    class="btn btn-lg btn-outline radius-sm w-100" title="Title"><?php echo e(__('Unfollow')); ?></a>
                <?php endif; ?>

              </div>
            </div>
            <div class="widget-shared-author border mb-40">
              <div class="tabs-navigation tabs-navigation-3 text-center">
                <ul class="nav nav-tabs justify-content-center border-0">
                  <li class="nav-item">
                    <button class="nav-link active" type="button" data-bs-toggle="tab"
                      data-bs-target="#followers"><?php echo e(__('Followers')); ?></button>
                  </li>
                  <li class="nav-item">
                    <button class="nav-link" type="button" data-bs-toggle="tab" data-bs-target="#following"
                      tabindex="-1"><?php echo e(__('Following')); ?></button>
                  </li>
                </ul>
              </div>

              <div class="tab-content mt-20">
                <div class="tab-pane fade show active" id="followers" role="tabpanel">
                  <?php $__currentLoopData = $followers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $follower): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if($follower->type == 'seller'): ?>
                      <?php if($follower->follower_seller): ?>
                        <div class="shared-author mb-20">
                          <figure class="shared-author-img">
                            <a href="<?php echo e(route('frontend.seller.details', ['username' => $follower->follower_seller->username])); ?>">
                              <?php if(!empty($follower->follower_seller->photo)): ?>
                                <img class="rounded-lg lazyload"
                                  data-src="<?php echo e(asset('assets/admin/img/seller-photo/' . $follower->follower_seller->photo)); ?>"
                                  alt="image">
                              <?php else: ?>
                                <img class="rounded-lg lazyload" data-src="<?php echo e(asset('assets/img/blank-user.jpg')); ?>" alt="image">
                              <?php endif; ?>
                            </a>
                          </figure>
                          <div class="shared-author-info flex-grow-1">
                            <div class="d-flex align-items-center justify-content-between">
                              <div>
                                <h6 class="mb-0"><a
                                    href="<?php echo e(route('frontend.seller.details', ['username' => $follower->follower_seller->username])); ?>"><?php echo e($follower->follower_seller->username); ?></a>
                                </h6>
                                <span class="font-xsm"><?php echo e(@$follower->follower_seller->seller_info->name); ?></span>
                              </div>
                            </div>
                          </div>
                        </div>
                      <?php endif; ?>
                    <?php elseif($follower->type == 'user'): ?>
                      <?php if($follower->follower_user): ?>
                        <div class="shared-author mb-20">
                          <figure class="shared-author-img">
                            <img class="rounded-lg lazyload"
                              data-src="<?php echo e(is_null($follower->follower_user->image) ? asset('assets/img/blank-user.jpg') : asset('assets/img/users/' . $follower->follower_user->image)); ?>"
                              alt="Author">
                          </figure>
                          <div class="shared-author-info flex-grow-1">
                            <div class="d-flex align-items-center justify-content-between">
                              <div>
                                <h6 class="mb-0"><?php echo e($follower->follower_user->username); ?></h6>
                                <span
                                  class="font-xsm"><?php echo e(@$follower->follower_user->first_name . ' ' . @$follower->follower_user->last_name); ?></span>
                              </div>
                            </div>
                          </div>
                        </div>
                      <?php endif; ?>
                    <?php endif; ?>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  <?php if(count($followers) > 0): ?>
                    <div class="text-center"><a href="<?php echo e(route('frontend.seller.followers', $seller->username)); ?>"
                        class="btn btn-md btn-primary radius-sm"><?php echo e(__('View All')); ?></a></div>
                  <?php else: ?>
                  <div class="not-found-area p-30 bg-light radius-md text-center">
                    <h6 class="mb-0"><?php echo e(__('No Followers are found')); ?></h6>
                  </div>
                  <?php endif; ?>
                </div>
                <div class="tab-pane fade" id="following" role="tabpanel">
                  <?php $__currentLoopData = $followings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $following): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if($following->following_seller): ?>
                      <div class="shared-author mb-20">
                        <figure class="shared-author-img">
                          <a
                            href="<?php echo e(route('frontend.seller.details', ['username' => $following->following_seller->username])); ?>">
                            <?php if(!empty($following->following_seller->photo)): ?>
                              <img class="rounded-lg lazyload"
                                data-src="<?php echo e(asset('assets/admin/img/seller-photo/' . $following->following_seller->photo)); ?>"
                                alt="image">
                            <?php else: ?>
                              <img class="rounded-lg lazyload" data-src="<?php echo e(asset('assets/img/blank-user.jpg')); ?>" alt="image">
                            <?php endif; ?>
                          </a>
                        </figure>
                        <div class="shared-author-info flex-grow-1">
                          <div class="d-flex align-items-center justify-content-between">
                            <div>
                              <h6 class="mb-0"><a
                                  href="<?php echo e(route('frontend.seller.details', ['username' => $following->following_seller->username])); ?>"><?php echo e($following->following_seller->username); ?></a>
                              </h6>
                              <span class="font-xsm"><?php echo e(@$following->following_seller->seller_info->name); ?></span>
                            </div>
                          </div>
                        </div>
                      </div>
                    <?php endif; ?>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  <?php if(count($followings) > 0): ?>
                    <div class="text-center"><a href="<?php echo e(route('frontend.seller.followings', $seller->username)); ?>"
                        class="btn btn-md btn-primary radius-sm"><?php echo e(__('View All')); ?></a></div>
                  <?php else: ?>
                  <div class="not-found-area p-30 bg-light radius-md text-center">
                    <h6 class="mb-0"><?php echo e(__('No following are found')); ?></h6>
                  </div>
                  <?php endif; ?>
                </div>
              </div>
            </div>
            
          </aside>
        </div>
        <div class="col-lg-8 order-lg-first">
          <h3 class="mb-20"><?php echo e(__('Services')); ?></h3>
          <div class="tabs-navigation mb-30">
            <ul class="nav nav-tabs" data-hover="fancyHover">
              <li class="nav-item active">
                <button class="nav-link hover-effect border btn-md radius-sm active" type="button" data-bs-toggle="tab"
                  data-bs-target="#all"><?php echo e(__('All')); ?>

                </button>
              </li>
              <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li class="nav-item mb-10">
                  <button class="nav-link hover-effect border btn-md radius-sm " type="button" data-bs-toggle="tab" data-bs-target="#tab<?php echo e($category->id); ?>" ><?php echo e($category->name); ?></button>
                </li>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
          </div>
          <?php
            $position = $currencyInfo->base_currency_symbol_position;
            $symbol = $currencyInfo->base_currency_symbol;
          ?>
          <div class="tab-content pb-10">
            <div class="tab-pane fade show active" id="all">
              <?php if(count($all_services) > 0): ?>
                <div class="row">
                  <?php $__currentLoopData = $all_services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <div class="col-lg-4 col-md-6">
                    <div class="service_default p-15 radius-md border mb-25">
                      <figure class="service_img">
                        <a href="<?php echo e(route('service_details', ['slug' => $service->slug, 'id' => $service->id])); ?>"
                          title="Image" target="_self" class="lazy-container ratio ratio-2-3">
                          <img class="lazyload" src="<?php echo e(asset('assets/front/images/placeholder.png')); ?>"
                            data-src="<?php echo e(asset('assets/img/services/thumbnail-images/' . $service->thumbnail_image)); ?>"
                            alt="service">
                        </a>
                      </figure>
                      <div class="service_details mt-20">
                        <div class="authors mb-15">
                          <div class="ratings size-md">
                            <div class="rate bg-img" data-bg-img="<?php echo e(asset('assets/front/images/rate-star-md.png')); ?>">
                              <div class="rating-icon bg-img" style="width: <?php echo e($service->average_rating * 20); ?>%"
                                data-bg-img="<?php echo e(asset('assets/front/images/rate-star-md.png')); ?>"></div>
                            </div>
                            <span class="ratings-total"><?php echo e($service->average_rating); ?> (<?php echo e(@$service->reviewCount); ?>)</span>
                          </div>
                          <a href="<?php echo e(route('service.update_wishlist', ['slug' => $service->slug])); ?>"
                            class="btn btn-icon radius-sm wishlist-link" data-tooltip="tooltip" data-bs-placement="top"
                            title="<?php echo e(@$wishlisted == true ? __('Saved') : __('Save to Wishlist')); ?>">
                            <?php if(auth()->guard('web')->check()): ?>
                              <i class="fas fa-heart <?php if(@$service->wishlisted == true): ?> added-in-wishlist <?php endif; ?>"></i>
                            <?php endif; ?>

                            <?php if(auth()->guard('web')->guest()): ?>
                              <i class="fas fa-heart"></i>
                            <?php endif; ?>
                          </a>
                        </div>

                        <h6 class="service_title lc-2 mb-0">
                          <a href="<?php echo e(route('service_details', ['slug' => $service->slug, 'id' => $service->id])); ?>"
                            target="_self" title="Link">
                            <?php echo e(strlen($service->title) > 70 ? mb_substr($service->title, 0, 70, 'UTF-8') . '...' : $service->title); ?>

                          </a>
                        </h6>
                        <?php
                          $position = $currencyInfo->base_currency_symbol_position;
                          $symbol = $currencyInfo->base_currency_symbol;
                        ?>
                        <div class="service_bottom-info mt-20 pt-15">
                          <?php if($service->quote_btn_status == 1): ?>
                            <span><?php echo e(__('Request Quote')); ?></span>
                          <?php else: ?>
                            <span><?php echo e(__('Starting At')); ?></span>
                            <span class="font-medium">
                              <?php
                                $currentMinPackagePrice = $service
                                    ->package()
                                    ->where('language_id', $languageId)
                                    ->min('current_price');
                                $previousPackagePrice = $service
                                    ->package()
                                    ->where('language_id', $languageId)
                                    ->min('previous_price');
                              ?>
                              <?php echo e($position == 'left' ? $symbol : ''); ?><?php echo e(is_null($currentMinPackagePrice) ? formatPrice('0.00') : formatPrice($currentMinPackagePrice)); ?><?php echo e($position == 'right' ? $symbol : ''); ?>

                              <!--- previous price --->

                              <?php if($previousPackagePrice): ?>
                                <del><?php echo e($position == 'left' ? $symbol : ''); ?><?php echo e(is_null($previousPackagePrice) ? formatPrice(0.0) : formatPrice($previousPackagePrice)); ?><?php echo e($position == 'right' ? $symbol : ''); ?>

                                </del>
                              <?php endif; ?>
                            </span>
                            <!--- previous price --->
                          <?php endif; ?>
                        </div>
                      </div>
                    </div>
                  </div>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
              <?php else: ?>
                <p class="text-center"><?php echo e(__('No Service Found')); ?></p>
              <?php endif; ?>
            </div>

            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <div class="tab-pane fade" id="tab<?php echo e($category->id); ?>">
                <?php
                  if (request()->input('admin') == true) {
                      $seller_id = 0;
                  } else {
                      $seller_id = $seller->id;
                  }
                  $all_services = App\Models\ClientService\Service::join('service_contents', 'services.id', '=', 'service_contents.service_id')
                      ->where([['services.service_status', '=', 1], ['service_contents.language_id', '=', $language->id], ['service_contents.service_category_id', $category->id], ['services.seller_id', $seller_id]])
                      ->select('services.id', 'services.thumbnail_image', 'service_contents.title', 'service_contents.slug', 'services.average_rating', 'services.package_lowest_price', 'services.quote_btn_status')
                      ->orderByDesc('services.id')
                      ->get();
                  // review
                  $all_services->map(function ($service) {
                      $service['reviewCount'] = $service->review()->count();
                  });
                  // wishlist
                  if (Auth::guard('web')->check() == true) {
                      $all_services->map(function ($service) {
                          $authUser = Auth::guard('web')->user();

                          $listedService = $service
                              ->wishlist()
                              ->where('user_id', $authUser->id)
                              ->first();

                          if (empty($listedService)) {
                              $service['wishlisted'] = false;
                          } else {
                              $service['wishlisted'] = true;
                          }
                      });
                  }
                ?>
                <?php if(count($all_services) > 0): ?>
                  <div class="row">
                    <?php $__currentLoopData = $all_services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-lg-4 col-md-6">
                      <div class="service_default p-15 radius-md border mb-25">
                        <figure class="service_img">
                          <a href="<?php echo e(route('service_details', ['slug' => $service->slug, 'id' => $service->id])); ?>"
                            title="Image" target="_self" class="lazy-container ratio ratio-2-3">
                            <img class="lazyload" src="<?php echo e(asset('assets/front/images/placeholder.png')); ?>"
                              data-src="<?php echo e(asset('assets/img/services/thumbnail-images/' . $service->thumbnail_image)); ?>"
                              alt="service">
                          </a>
                        </figure>
                        <div class="service_details mt-20">
                          <div class="authors mb-15">
                            <div class="ratings size-md">
                              <div class="rate bg-img" data-bg-img="<?php echo e(asset('assets/front/images/rate-star-md.png')); ?>">
                                <div class="rating-icon bg-img" style="width: <?php echo e($service->average_rating * 20); ?>%"
                                  data-bg-img="<?php echo e(asset('assets/front/images/rate-star-md.png')); ?>"></div>
                              </div>
                              <span class="ratings-total"><?php echo e($service->average_rating); ?> (<?php echo e(@$service->reviewCount); ?>)</span>
                            </div>
                            <a href="<?php echo e(route('service.update_wishlist', ['slug' => $service->slug])); ?>"
                              class="btn btn-icon radius-sm wishlist-link" data-tooltip="tooltip" data-bs-placement="top"
                              title="<?php echo e(@$wishlisted == true ? __('Saved') : __('Save to Wishlist')); ?>">
                              <?php if(auth()->guard('web')->check()): ?>
                                <i class="fas fa-heart <?php if(@$service->wishlisted == true): ?> added-in-wishlist <?php endif; ?>"></i>
                              <?php endif; ?>

                              <?php if(auth()->guard('web')->guest()): ?>
                                <i class="fas fa-heart"></i>
                              <?php endif; ?>
                            </a>
                          </div>

                          <h6 class="service_title lc-2 mb-0">
                            <a href="<?php echo e(route('service_details', ['slug' => $service->slug, 'id' => $service->id])); ?>"
                              target="_self" title="Link">
                              <?php echo e(strlen($service->title) > 70 ? mb_substr($service->title, 0, 70, 'UTF-8') . '...' : $service->title); ?>

                            </a>
                          </h6>
                          <?php
                            $position = $currencyInfo->base_currency_symbol_position;
                            $symbol = $currencyInfo->base_currency_symbol;
                          ?>
                          <div class="service_bottom-info mt-20 pt-15">
                            <?php if($service->quote_btn_status == 1): ?>
                              <span><?php echo e(__('Request Quote')); ?></span>
                            <?php else: ?>
                              <span><?php echo e(__('Starting At')); ?></span>
                              <span class="font-medium">
                                <?php
                                  $currentMinPackagePrice = $service
                                      ->package()
                                      ->where('language_id', $languageId)
                                      ->min('current_price');
                                  $previousPackagePrice = $service
                                      ->package()
                                      ->where('language_id', $languageId)
                                      ->min('previous_price');
                                ?>
                                <?php echo e($position == 'left' ? $symbol : ''); ?><?php echo e(is_null($currentMinPackagePrice) ? formatPrice('0.00') : formatPrice($currentMinPackagePrice)); ?><?php echo e($position == 'right' ? $symbol : ''); ?>

                                <!--- previous price --->

                                <?php if($previousPackagePrice): ?>
                                  <del><?php echo e($position == 'left' ? $symbol : ''); ?><?php echo e(is_null($previousPackagePrice) ? formatPrice(0.0) : formatPrice($previousPackagePrice)); ?><?php echo e($position == 'right' ? $symbol : ''); ?>

                                  </del>
                                <?php endif; ?>
                              </span>
                              <!--- previous price --->
                            <?php endif; ?>
                          </div>
                        </div>
                      </div>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </div>
                <?php else: ?>
                <div class="not-found-area p-30 bg-light radius-md text-center">
                  <h6 class="mb-0"><?php echo e(__('No Service Found')); ?></h6>
                </div>
                <?php endif; ?>
              </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </div>

          
        </div>
      </div>
    </div>
  </div>
  <!--====== End Seller Section ======-->

  <!-- Contact Modal -->
  <div class="modal contact-modal fade" id="contactModal" tabindex="-1" aria-labelledby="contactModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content">
        <div class="modal-header align-item-center">
          <h4 class="modal-title mb-0" id="contactModalLabel"><?php echo e(__('Contact Now')); ?></h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="<?php echo e(route('seller.contact.message')); ?>" method="POST" id="sellerContactForm">
            <?php echo csrf_field(); ?>
            <input type="hidden" name="seller_email"
              value="<?php echo e(request()->input('admin') == true ? $bs->to_mail : $seller->recipient_mail); ?>">
            <div class="row">
              <div class="col-lg-6">
                <div class="form-group mb-20">
                  <input type="text" class="form-control" placeholder="<?php echo e(__('Enter Your Full Name')); ?>"
                    name="name">
                  <p class="text-danger em" id="err_name"></p>
                </div>
              </div>
              <div class="col-lg-6">
                <div class="form-group mb-20">
                  <input type="email" class="form-control" placeholder="<?php echo e(__('Enter Your Email Address')); ?>"
                    name="email">
                  <p class="text-danger em" id="err_email"></p>
                </div>
              </div>
              <div class="col-lg-12">
                <div class="form-group mb-20">
                  <input type="text" class="form-control" placeholder="<?php echo e(__('Enter Subject')); ?>" name="subject">
                  <p class="text-danger em" id="err_subject"></p>
                </div>
              </div>
              <div class="col-lg-12">
                <div class="form-group mb-20">
                  <textarea name="message" class="form-control" placeholder="<?php echo e(__('Message')); ?>"></textarea>
                  <p class="text-danger em" id="err_message"></p>
                </div>
              </div>
              <?php if($bs->google_recaptcha_status == 1): ?>
                <div class="col-md-12">
                  <div class="form-group mb-20">
                    <?php echo NoCaptcha::renderJs(); ?>

                    <?php echo NoCaptcha::display(); ?>

                    <p class="text-danger em" id="err_g-recaptcha-response"></p>
                  </div>
                </div>
              <?php endif; ?>
              <div class="col-lg-12 text-center">
                <button class="btn btn-lg btn-primary radius-sm" id="sellerSubmitBtn" type="submit"
                  aria-label="button"><?php echo e(__('Send Message')); ?></button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
  <script src="<?php echo e(asset('assets/js/seller-contact.js')); ?>"></script>
  <script src="<?php echo e(asset('assets/js/service.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\younes\Downloads\junspro-main (1)\junspro-main3\resources\views\frontend\seller\details.blade.php ENDPATH**/ ?>