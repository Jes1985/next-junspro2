<?php $title = __('Service Wishlist'); ?>

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
                    <h4><?php echo e(__('Services')); ?></h4>
                  </div>

                  <div class="main-info">
                    <?php if(count($listedServices) == 0): ?>
                      <div class="row text-center mt-2">
                        <div class="col">
                          <h4><?php echo e(__('No Service Found') . '!'); ?></h4>
                        </div>
                      </div>
                    <?php else: ?>
                      <div class="main-table">
                        <div class="table-responsive">
                          <table id="user-datatable" class="table table-striped w-100">
                            <thead>
                              <tr>
                                <th><?php echo e(__('Service')); ?></th>
                                <th><?php echo e(__('Action')); ?></th>
                              </tr>
                            </thead>
                            <tbody>
                              <?php $__currentLoopData = $listedServices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $listedService): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr id="service-<?php echo e($listedService->service_id); ?>">
                                  <?php
                                    $serviceTitle = $listedService->serviceContent->title;
                                    $slug = $listedService->serviceContent->slug;
                                    $serviceId = $listedService->service_id;
                                  ?>

                                  <td class="ps-3">
                                    <a class="text-primary"
                                      href="<?php echo e(route('service_details', ['slug' => $slug, 'id' => $serviceId])); ?>"
                                      target="_blank">
                                      <?php echo e(strlen($serviceTitle) > 60 ? mb_substr($serviceTitle, 0, 60, 'UTF-8') . '...' : $serviceTitle); ?>

                                    </a>
                                  </td>
                                  <td class="ps-3">
                                    <a href="<?php echo e(route('service_details', ['slug' => $slug, 'id' => $serviceId])); ?>"
                                      class="btn btn-sm btn-primary rounded-1 <?php echo e($currentLanguageInfo->direction == 1 ? 'ms-1' : 'me-1'); ?>"
                                      target="_blank">
                                      <?php echo e(__('Details')); ?>

                                    </a>

                                    <form
                                      action="<?php echo e(route('user.service_wishlist.remove_service', ['service_id' => $serviceId])); ?>"
                                      method="POST" class="d-inline">
                                      <?php echo csrf_field(); ?>
                                      <button type="submit" class="btn btn-sm btn-primary rounded-1">
                                        <?php echo e(__('Remove')); ?>

                                      </button>
                                    </form>
                                  </td>
                                </tr>
                              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                          </table>
                        </div>
                      </div>
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

<?php echo $__env->make('frontend.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\younes\Downloads\junspro-main (1)\junspro-main3\resources\views\frontend\user\service-wishlist.blade.php ENDPATH**/ ?>