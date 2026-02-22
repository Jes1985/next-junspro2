<?php if(count($services) == 0): ?>
  <div class="row">
    <div class="col">
      <h3 class="text-center mt-5"><?php echo e(__('No Service Found') . '!'); ?></h3>
    </div>
  </div>
<?php else: ?>
  <div class="row sss">
    <?php $__currentLoopData = $services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <div class="col-lg-4 col-md-6">
        <div class="service_default p-15 radius-md border mb-25">
          <figure class="service_img">
            <a href="<?php echo e(route('service_details', ['slug' => $service->slug, 'id' => $service->id])); ?>" title="Image"
              target="_self" class="lazy-container ratio ratio-2-3">
              <img class="lazyload" src="<?php echo e(asset('assets/front/images/placeholder.png')); ?>"
                data-src="<?php echo e(asset('assets/img/services/thumbnail-images/' . $service->thumbnail_image)); ?>"
                alt="service">
            </a>
          </figure>
          <div class="service_details mt-20">
            <div class="authors mb-15">
              <?php if($service->seller_id != 0): ?>
                <?php
                  $seller = App\Models\Seller::where('id', $service->seller_id)->first();
                ?>
                <div class="author">
                  <a href="<?php echo e(route('frontend.seller.details', ['username' => $seller->username])); ?>" target="_self"
                    title="<?php echo e($seller->username); ?>">
                    <?php if(!is_null($seller->photo)): ?>
                      <img class="lazyload" data-src="<?php echo e(asset('assets/admin/img/seller-photo/' . $seller->photo)); ?>"
                        alt="Image">
                    <?php else: ?>
                      <img class="lazyload" data-src="<?php echo e(asset('assets/img/blank-user.jpg')); ?>" alt="Image">
                    <?php endif; ?>
                  </a>
                  <div>
                    <span class="h6 font-sm mb-0">
                      <a href="<?php echo e(route('frontend.seller.details', ['username' => $seller->username])); ?>"
                        target="_self">
                        <?php echo e(strlen($seller->username) > 20 ? mb_substr($seller->username, 0, 20, 'UTF-8') . '..' : $seller->username); ?>

                      </a>
                    </span>
                    <span class="font-sm">
                      <a href="<?php echo e(route('frontend.seller.details', ['username' => $seller->username])); ?>"
                        target="_self" title="<?php echo e($seller->username); ?>">
                        <?php echo e(strlen(@$seller->seller_info->name) > 20 ? mb_substr(@$seller->seller_info->name, 0, 20, 'UTF-8') . '..' : @$seller->seller_info->name); ?>

                      </a>
                    </span>
                  </div>
                </div>
              <?php else: ?>
                <?php
                  $admin = App\Models\Admin::first();
                ?>
                <div class="author">
                  <a href="<?php echo e(route('frontend.seller.details', ['username' => $admin->username, 'admin' => true])); ?>"
                    target="_self" title="James Hobert">
                    <?php if(!empty($admin->image)): ?>
                      <img class="lazyload" data-src="<?php echo e(asset('assets/img/admins/' . $admin->image)); ?>"
                        alt="Image">
                    <?php else: ?>
                      <img class="lazyload" data-src="<?php echo e(asset('assets/img/blank-user.jpg')); ?>" alt="Image">
                    <?php endif; ?>
                  </a>
                  <div>
                    <span class="h6 font-sm mb-0">
                      <a href="<?php echo e(route('frontend.seller.details', ['username' => $admin->username, 'admin' => true])); ?>"
                        target="_self">
                        <?php echo e(strlen($admin->username) > 20 ? mb_substr($admin->username, 0, 20, 'UTF-8') . '..' : $admin->username); ?>

                      </a>
                    </span>
                    <span class="font-sm">
                      <a href="<?php echo e(route('frontend.seller.details', ['username' => $admin->username, 'admin' => true])); ?>"
                        target="_self" title="Graphic Designer">
                        <?php echo e(strlen($admin->first_name . ' ' . $admin->last_name) > 20 ? mb_substr($admin->first_name . ' ' . $admin->last_name, 0, 20, 'UTF-8') . '..' : $admin->first_name . ' ' . $admin->last_name); ?>

                      </a>
                    </span>
                  </div>
                </div>
              <?php endif; ?>
              <a href="<?php echo e(route('service.update_wishlist', ['slug' => $service->slug])); ?>"
                class="btn btn-icon radius-sm wishlist-link" data-tooltip="tooltip" data-bs-placement="top"
                title="<?php echo e(@$service->wishlisted == true ? __('Remove from wishlist') : __('Save to Wishlist')); ?>">
                <?php if(auth()->guard('web')->check()): ?>
                  <i class="fas fa-heart <?php if(@$service->wishlisted == true): ?> added-in-wishlist <?php endif; ?>"></i>
                <?php endif; ?>

                <?php if(auth()->guard('web')->guest()): ?>
                  <i class="fas fa-heart"></i>
                <?php endif; ?>
              </a>
            </div>

            <h6 class="service_title lc-2 mb-15">
              <a href="<?php echo e(route('service_details', ['slug' => $service->slug, 'id' => $service->id])); ?>" target="_self"
                title="Link">
                <?php echo e(strlen($service->title) > 70 ? mb_substr($service->title, 0, 70, 'UTF-8') . '...' : $service->title); ?>

              </a>
            </h6>

            <div class="ratings size-md">
              <div class="rate bg-img"
                style="background-image:url('<?php echo e(asset('assets/front/images/rate-star-md.png')); ?>')">
                <div class="rating-icon bg-img"
                  style="width: <?php echo e($service->average_rating * 20); ?>%; background-image:url('<?php echo e(asset('assets/front/images/rate-star-md.png')); ?>')">
                </div>
              </div>
              <span class="ratings-total"><?php echo e($service->average_rating); ?>

                (<?php echo e(@$service->reviewCount); ?>)
              </span>
            </div>
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
  <div class="row">
    <div class="col-md-12">
      <nav class="pagination-nav">
        <ul class="pagination justify-content-center">
          <?php echo e($services->appends([
                  'keyword' => request()->input('keyword'),
                  'category' => request()->input('category'),
                  'subcategory' => request()->input('subcategory'),
                  'tag' => request()->input('tag'),
                  'rating' => request()->input('rating'),
                  'min' => request()->input('min'),
                  'max' => request()->input('max'),
                  'sort' => request()->input('sort'),
              ])->links()); ?>

        </ul>
      </nav>
    </div>
  </div>
<?php endif; ?>
<?php /**PATH C:\Users\younes\Downloads\junspro-main (1)\junspro-main3\resources\views\frontend\service\service-section.blade.php ENDPATH**/ ?>