<footer class="footer-area bg-primary-light">
  <div class="footer-top pt-100 pb-70">
    <div class="container">
      <div class="row gx-xl-5 justify-content-between">
        <div class="col-xl-4 col-lg-5 col-md-6">
          <div class="footer-widget">
            <!-- Logo -->
            <div class="logo mb-20">
              <a class="navbar-brand" href="<?php echo e(route('index')); ?>" target="_self" title="">
                <?php if(!empty($basicInfo->footer_logo)): ?>
                  <img class="lazyload" data-src="<?php echo e(asset('assets/img/' . $basicInfo->footer_logo)); ?>"
                    alt="Brand Logo">
                <?php endif; ?>
              </a>
            </div>
            <p>
              <?php echo e(!empty($footerInfo) ? $footerInfo->about_company : ''); ?>

            </p>

          </div>
        </div>
        <div class="col-xl-2 col-lg-3 col-sm-6">
          <div class="footer-widget">
            <h5><?php echo e(__('Useful Links')); ?></h5>
            <?php if(count($quickLinkInfos) == 0): ?>
              <ul class="footer-links">
                <li><a href="<?php echo e(route('dynamic_page', ['slug' => 'mentions-legales'])); ?>"><?php echo e(__('Mentions légales')); ?></a></li>
                <li><a href="<?php echo e(route('dynamic_page', ['slug' => 'termes-et-conditions'])); ?>"><?php echo e(__('Termes et conditions')); ?></a></li>
                <li><a href="<?php echo e(route('dynamic_page', ['slug' => 'politique-de-confidentialite'])); ?>"><?php echo e(__('Politique de confidentialité')); ?></a></li>
                <li><a href="<?php echo e(route('dynamic_page', ['slug' => 'conditions-generales-de-vente'])); ?>"><?php echo e(__('Conditions générales de vente')); ?></a></li>
              </ul>
            <?php else: ?>
              <ul class="footer-links">
                <?php $__currentLoopData = $quickLinkInfos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $quickLinkInfo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <li>
                    <?php
                      $url = $quickLinkInfo->url;
                      $isInternal = strpos($url, '/') === 0 || strpos($url, url('/')) === 0;
                      $target = $isInternal ? '' : 'target="_blank"';
                    ?>
                    <a href="<?php echo e($url); ?>" <?php echo e($target); ?>><?php echo e($quickLinkInfo->title); ?></a>
                  </li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </ul>
            <?php endif; ?>
          </div>
        </div>
        <div class="col-xl-2 col-lg-3 col-sm-6">
          <div class="footer-widget">
            <h5><?php echo e(__('Contact Us')); ?></h5>
            <ul class="footer-links">
              <?php if(!empty($basicInfo->email_address)): ?>
                <li>
                  <a href="mailTo:<?php echo e($basicInfo->email_address); ?>" target="_self"
                    title="link"><?php echo e($basicInfo->email_address); ?></a>
                </li>
              <?php endif; ?>
              <?php if(!empty($basicInfo->contact_number)): ?>
                <li>
                  <a href="tel:<?php echo e($basicInfo->contact_number); ?>" target="_self"
                    title="link"><?php echo e($basicInfo->contact_number); ?></a>
                </li>
              <?php endif; ?>
              <?php if(!empty($basicInfo->address)): ?>
                <li>
                  <?php echo e($basicInfo->address); ?>

                </li>
              <?php endif; ?>
            </ul>
          </div>
        </div>
        <div class="col-xl-4 col-md-6">
          <div class="footer-widget">
            <h5><?php echo e(__('Subscribe Us')); ?></h5>
            <p>
              <?php echo e(@$basicExtend->news_letter_section_text); ?>

            </p>
            <form id="newsletterForm" action="<?php echo e(route('store_subscriber')); ?>" class="subscription-form"
              method="POST">
              <?php echo csrf_field(); ?>
              <div class="input-inline p-1 bg-white radius-sm">
                <input class="form-control border-0 size-md" placeholder="<?php echo e(__('Enter Your Email Address')); ?>"
                  type="text" name="email_id">
                <button class="btn-icon radius-sm" type="submit" aria-label="button">
                  <i class="fas fa-paper-plane"></i>
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="copy-right-area">
    <div class="go-top">
      <div class="go-top-btn">
        <i class="far fa-angle-double-up"></i>
      </div>
    </div>
    <div class="container">
      <div class="copy-right-content ptb-30">
        <?php if(count($socialMediaInfos) > 0): ?>
          <div class="social-link rounded style-2 justify-content-center mb-10">
            <?php $__currentLoopData = $socialMediaInfos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $socialMediaInfo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <a href="<?php echo e($socialMediaInfo->url); ?>" target="_blank"><i class="<?php echo e($socialMediaInfo->icon); ?>"></i></a>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </div>
        <?php endif; ?>
        <?php if(!empty($footerInfo)): ?>
          <span>
            <?php echo e($footerInfo->copyright_text); ?>

          </span>
        <?php endif; ?>
      </div>
    </div>
  </div>
</footer>
<?php /**PATH C:\Users\younes\Downloads\junspro-main (1)\junspro-main3\resources\views\frontend\partials\footer\footer-v1.blade.php ENDPATH**/ ?>