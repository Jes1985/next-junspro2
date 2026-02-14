
<section class="breadcrumbs-area bg_cover lazyload bg-img header-next" data-bg-img="<?php echo e(asset('assets/img/' . $breadcrumb)); ?>">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-8">
        <div class="breadcrumbs-title text-center">
          <h3>
            <?php if(isset($serviceTitle)): ?>
              <?php echo e(replaceSellerWithFreelance(@$serviceTitle)); ?>

            <?php endif; ?>
            <?php if(empty($serviceTitle)): ?>
              <?php echo e(!empty($title) ? replaceSellerWithFreelance($title) : ''); ?>

            <?php endif; ?>
          </h3>
          <ul class="breadcumb-link justify-content-center">
            <li><a href="<?php echo e(route('index')); ?>"><?php echo e(__('Home')); ?></a></li>
            <li class="active"><?php echo e(!empty($title) ? replaceSellerWithFreelance($title) : ''); ?></li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</section>

<?php /**PATH C:\Users\younes\Downloads\junspro-main (1)\junspro-main3\resources\views/frontend/partials/breadcrumb.blade.php ENDPATH**/ ?>