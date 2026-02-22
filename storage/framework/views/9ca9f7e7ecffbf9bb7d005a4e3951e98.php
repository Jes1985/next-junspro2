<?php $title = __('Following'); ?>

<?php $__env->startSection('pageHeading'); ?>
  <?php echo e($title); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
  <?php if ($__env->exists('frontend.partials.breadcrumb', ['breadcrumb' => $breadcrumb, 'title' => $title])) echo $__env->make('frontend.partials.breadcrumb', ['breadcrumb' => $breadcrumb, 'title' => $title], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

  <!--====== Start Service Wishlist Section ======-->
  <section class="user-dashboard pt-100 pb-60">
    <div class="container">
      <div class="row">
        <?php if ($__env->exists('frontend.user.side-navbar')) echo $__env->make('frontend.user.side-navbar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

        <div class="col-lg-9">
          <div class="row">
            <div class="col-lg-12">
              <div class="user-profile-details mb-40">
                <div class="account-info">
                  <div class="title">
                    <h4><?php echo e(__('Following')); ?></h4>
                  </div>

                  <div class="main-info seller-area">
                    <?php if(count($followings) == 0): ?>
                      <div class="row text-center mt-2">
                        <div class="col">
                          <h4><?php echo e(__('No Data Found') . '!'); ?></h4>
                        </div>
                      </div>
                    <?php else: ?>
                      
                      <div class="row">
                        <?php $__currentLoopData = $followings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $following): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                          <?php if($following->following_seller): ?>
                            <div class="col-xl-4 col-lg-4 col-md-6">
                              <div class="card card-center p-3 border mb-30">
                                <figure class="card-img mb-15">
                                  <a href="<?php echo e(route('frontend.seller.details', ['username' => $following->following_seller->username])); ?>"
                                    target="_self" title="<?php echo e(__('Seller')); ?>">
                                    <?php if(!is_null($following->following_seller->photo)): ?>
                                      <img class="rounded-circle"
                                        src="<?php echo e(asset('assets/admin/img/seller-photo/' . $following->following_seller->photo)); ?>"
                                        alt="image">
                                    <?php else: ?>
                                      <img class="rounded-circle" src="<?php echo e(asset('assets/img/seller-blank-user.jpg')); ?>"
                                        alt="image">
                                    <?php endif; ?>
                                  </a>
                                </figure>
                                <div class="card-content">
                                  <div class="content-top">
                                    <div class="ratings mx-auto">
                                      <div class="rate bg-img"
                                        data-bg-img="<?php echo e(asset('assets/front/images/rate-star.png')); ?>">
                                        <div class="rating-icon bg-img"style="width: <?php echo e(SellerAvgRating(@$following->following_seller->id) * 20); ?>%;"
                                          data-bg-img="<?php echo e(asset('assets/front/images/rate-star.png')); ?>"></div>
                                      </div>
                                      <span class="ratings-total">(<?php echo e(SellerAvgRating(@$following->following_seller->id)); ?>)</span>
                                    </div>
                                  </div>
                                  <h5 class="card-title mb-10">
                                    <a href="<?php echo e(route('frontend.seller.details', ['username' => $following->following_seller->username])); ?>"><?php echo e(strlen($following->following_seller->username) > 20 ? mb_substr($following->following_seller->username, 0, 20, 'UTF-8') . '..' : $following->following_seller->username); ?></a>
                                  </h5>
                                  <ul class="info-list mb-15 font-sm list-unstyled">
                                    <?php
                                      $service_count = App\Models\ClientService\Service::where([['seller_id', $following->following_seller->id], ['service_status', 1]])->count();
                                    ?>
                                    <li><?php echo e($service_count); ?> <?php echo e($service_count > 1 ? __('Services') : __('Service')); ?>

                                    </li>
                                    <li>
                                      <?php
                                        $follwers_count = App\Models\Follower::where('following_id', $following->following_seller->id)->count();
                                      ?>

                                      <?php echo e($follwers_count); ?> <?php echo e(__('Followers')); ?>

                                    </li>
                                  </ul>
                                  <a href="<?php echo e(route('frontend.seller.details', ['username' => $following->following_seller->username])); ?>"
                                    target="_self" title="<?php echo e($following->following_seller); ?>"
                                    class="main-btn text-center w-100">
                                    <?php echo e(__('View Profile')); ?>

                                  </a>
                                </div>
                              </div>
                            </div>
                          <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                      </div>
                      <?php echo e($followings->links()); ?>

                    <?php endif; ?>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!--====== End Service Wishlist Section ======-->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\younes\Downloads\junspro-main (1)\junspro-main3\resources\views\frontend\user\following.blade.php ENDPATH**/ ?>