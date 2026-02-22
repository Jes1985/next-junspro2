<?php $__env->startSection('pageHeading'); ?>
  <?php echo e(replaceSellerWithFreelance($pageHeading->seller_page_title ?? __('Sellers'))); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('metaKeywords'); ?>
  <?php if(!empty($seoInfo)): ?>
    <?php echo e($seoInfo->seller_page_meta_keywords ?? ''); ?>

  <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('metaDescription'); ?>
  <?php if(!empty($seoInfo)): ?>
    <?php echo e($seoInfo->seller_page_meta_description ?? ''); ?>

  <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
  <?php if ($__env->exists('frontend.partials.breadcrumb', [
      'breadcrumb' => $breadcrumb ?? '',
      'title' => replaceSellerWithFreelance($pageHeading->seller_page_title ?? __('Sellers')),
  ])) echo $__env->make('frontend.partials.breadcrumb', [
      'breadcrumb' => $breadcrumb ?? '',
      'title' => replaceSellerWithFreelance($pageHeading->seller_page_title ?? __('Sellers')),
  ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

  <!--====== Start Seller Section ======-->
  <div class="seller-area pt-100 pb-70">
    <div class="container">
      <form action="<?php echo e(route('frontend.sellers')); ?>" method="get">
        <div class="row justify-content-left mb-30">
          <div class="col-lg-3 col-md-6">
            <div class="seller-search mb-10">
              <div class="form-group">
                <input type="text" placeholder="<?php echo e(__('Seller Name/Username')); ?>" class="form-control rounded"
                  name="name" value="<?php echo e(request()->input('name')); ?>">
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-md-6">
            <div class="seller-search mb-10">
              <div class="form-group">
                <input type="text" placeholder="<?php echo e(__('Seller Location')); ?>" class="form-control rounded"
                  name="location" value="<?php echo e(request()->input('location')); ?>">
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-md-6">
            <div class="seller-search mb-10">
              <div class="form-group">
                <button class="btn btn-lg btn-primary radius-sm"><?php echo e(__('Search')); ?></button>
              </div>
            </div>
          </div>

        </div>
      </form>
      <div class="row">
        <?php if(count($sellers) > 0): ?>
          <?php $__currentLoopData = $sellers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $seller): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-xl-3 col-lg-4 col-md-6">
              <div class="card card-center p-3 border mb-30">
                <figure class="card-img mb-15">
                  <a href="<?php echo e(route('frontend.seller.details', ['username' => $seller->username])); ?>" target="_self"
                    title="Seller">
                    <?php if(!is_null($seller->photo)): ?>
                      <img class="rounded-circle" src="<?php echo e(asset('assets/admin/img/seller-photo/' . $seller->photo)); ?>"
                        alt="image">
                    <?php else: ?>
                      <img class="rounded-circle" src="<?php echo e(asset('assets/img/seller-blank-user.jpg')); ?>" alt="image">
                    <?php endif; ?>
                  </a>
                </figure>
                <div class="card-content">
                  <div class="content-top">
                    <div class="ratings mx-auto">
                      <div class="rate bg-img"
                        data-bg-img="<?php echo e(asset('assets/front/images/rate-star.png')); ?>">
                        <div class="rating-icon bg-img" style="width: <?php echo e(SellerAvgRating($seller->sellerId) * 20); ?>%;"
                          data-bg-img="<?php echo e(asset('assets/front/images/rate-star.png')); ?>"></div>
                      </div>
                      <span class="ratings-total">(<?php echo e(SellerAvgRating($seller->sellerId)); ?>)</span>
                    </div>
                  </div>
                  <h5 class="card-title mb-10"><a
                      href="<?php echo e(route('frontend.seller.details', ['username' => $seller->username])); ?>"><?php echo e(strlen($seller->username) > 20 ? mb_substr($seller->username, 0, 20, 'UTF-8') . '..' : $seller->username); ?></a>
                  </h5>
                  <ul class="info-list list-unstyled mb-15 font-sm">
                    <?php
                      $service_count = App\Models\ClientService\Service::where([['seller_id', $seller->sellerId], ['service_status', 1]])->count();
                    ?>
                    <li><?php echo e($service_count); ?> <?php echo e($service_count > 1 ? __('Services') : __('Service')); ?></li>
                    <li>
                      <?php
                        $follwers_count = App\Models\Follower::where('following_id', $seller->sellerId)->count();
                      ?>

                      <?php echo e($follwers_count); ?> <?php echo e(__('Followers')); ?>

                    </li>
                  </ul>
                  <a href="<?php echo e(route('frontend.seller.details', ['username' => $seller->username])); ?>" target="_self"
                    title="<?php echo e($seller->username); ?>" class="main-btn text-center w-100">
                    <?php echo e(__('View Profile')); ?>

                  </a>
                </div>
              </div>
            </div>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php else: ?>
          <div class="col-12">
            <h4 class="text-center"><?php echo e(__('No Seller Found.')); ?></h4>
          </div>
        <?php endif; ?>


        <div class="col-12">
          <?php echo e($sellers->appends([
                  'name' => request()->input('name'),
                  'location' => request()->input('location'),
              ])->links()); ?>

        </div>
      </div>
      
    </div>
  </div>
  <!--====== End Seller Section ======-->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\younes\Downloads\junspro-main (1)\junspro-main3\resources\views\frontend\seller\index.blade.php ENDPATH**/ ?>