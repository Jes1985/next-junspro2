<?php $__env->startSection('pageHeading'); ?>
  <?php echo e(__('Followers')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('metaKeywords'); ?>
  <?php echo e(__('Followers')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('metaDescription'); ?>
  <?php echo e(__('Followers')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
  <section class="breadcrumbs-area bg_cover lazyload bg-img header-next" data-bg-img="<?php echo e(asset('assets/img/' . $breadcrumb)); ?>">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-8">
          <div class="breadcrumbs-title text-center">
            <h3>
                <?php echo e($username); ?>

            </h3>
            <ul class="breadcumb-link justify-content-center">
              <li><a href="<?php echo e(route('index')); ?>"><?php echo e(__('Home')); ?></a></li>
              <li class="active"><?php echo e(__('Followers')); ?></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!--====== Start Followers Section ======-->
  <div class="follower-area pt-100 pb-70">
    <div class="container">
      <?php if(count($followers) < 1): ?>
        <h2 class="text-center"><?php echo e(__('No Followers are found')); ?></h2>
      <?php endif; ?>
      <div class="row">
        <?php $__currentLoopData = $followers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $follower): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <?php if($follower->type == 'seller'): ?>
            <?php if($follower->follower_seller): ?>
              <div class="col-xl-4 col-md-6">
                <div class="card border mb-30">
                  <figure class="card-img">
                    <a href="<?php echo e(route('frontend.seller.details', ['username' => $follower->follower_seller->username])); ?>"
                      target="_self" title="<?php echo e(__('Seller')); ?>">
                      <?php if(!empty($follower->follower_seller->photo)): ?>
                        <img class="rounded-lg"
                          src="<?php echo e(asset('assets/admin/img/seller-photo/' . $follower->follower_seller->photo)); ?>"
                          alt="image">
                      <?php else: ?>
                        <img class="rounded-lg" src="<?php echo e(asset('assets/img/seller-blank-user.jpg')); ?>" alt="image">
                      <?php endif; ?>
                    </a>
                  </figure>
                  <div class="card-content">
                    <h5 class="card-title mb-1">
                      <a
                        href="<?php echo e(route('frontend.seller.details', ['username' => $follower->follower_seller->username])); ?>"><?php echo e($follower->follower_seller->username); ?></a>
                    </h5>
                    <div class="font-sm">
                      <span><?php echo e(@$follower->follower_seller->seller_info->name); ?></span>
                    </div>
                  </div>
                </div>
              </div>
            <?php endif; ?>
          <?php elseif($follower->type == 'user'): ?>
            <?php if($follower->follower_user): ?>
              <div class="col-xl-4 col-md-6">
                <div class="card border mb-30">
                  <figure class="card-img">
                    <a href="#" target="_self" title="Seller">
                      <img class="rounded-lg"
                        src="<?php echo e(is_null($follower->follower_user->image) ? asset('assets/img/blank-user.jpg') : asset('assets/img/users/' . $follower->follower_user->image)); ?>"
                        alt="Author">
                    </a>
                  </figure>
                  <div class="card-content">
                    <h5 class="card-title mb-1"><a href="#"><?php echo e($follower->follower_user->username); ?></a></h5>
                    <div class="font-sm">
                      <span><?php echo e(@$follower->follower_user->first_name . ' ' . @$follower->follower_user->last_name); ?></span>
                    </div>
                  </div>
                </div>
              </div>
            <?php endif; ?>
          <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </div>
      <?php echo e($followers->links()); ?>


      
    </div>
  </div>
  <!--====== End Followers Section ======-->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\younes\Downloads\junspro-main (1)\junspro-main3\resources\views\frontend\seller\followers.blade.php ENDPATH**/ ?>