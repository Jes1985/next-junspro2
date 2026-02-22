<script>
  let baseURL = "<?php echo e(url('/')); ?>";
  let vapid_public_key = "<?php echo e(env('VAPID_PUBLIC_KEY')); ?>";
  let langDir = <?php echo e($currentLanguageInfo->direction); ?>;
  let whatsappStatus = <?php echo e($basicInfo->whatsapp_status); ?>;
  let whatsappNumber = '<?php echo e($basicInfo->whatsapp_number); ?>';
  let whatsappPopupMessage = `<?php echo $basicInfo->whatsapp_popup_message; ?>`;
  let whatsappPopupStatus = <?php echo e($basicInfo->whatsapp_popup_status); ?>;
  let whatsappHeaderTitle = '<?php echo e($basicInfo->whatsapp_header_title); ?>';
  let readMore = "<?php echo e(__('Read More')); ?>";
  let readLess = "<?php echo e(__('Read Less')); ?>";
  let showMore = "<?php echo e(__('Show More')); ?>";
  let showLess = "<?php echo e(__('Show Less')); ?>";
  let selectSkills = "<?php echo e(__('Select Skills')); ?>";
  let addBtnTxt = "<?php echo e(__('Add To Wishlist')); ?>";
  let rmvBtnTxt = "<?php echo e(__('Remove From Wishlist')); ?>";
  let save_to_wishlist = "<?php echo e(__('Save to Wishlist')); ?>";
  let remove_from_wishlist = "<?php echo e(__('Remove from wishlist')); ?>";
  let demo_mode = "<?php echo e(env('DEMO_MODE')); ?>";
</script>

<!-- jQuery JS -->
<script type="text/javascript" src="<?php echo e(asset('assets/front/js/vendors/jquery.min.js')); ?>"></script>
<!-- Bootstrap JS -->
<script type="text/javascript" src="<?php echo e(asset('assets/front/js/vendors/bootstrap.min.js')); ?>"></script>
<!-- User Menu Dropdown JS -->
<script type="text/javascript" src="<?php echo e(asset('assets/front/js/user-menu-dropdown.js')); ?>"></script>
<!-- Nice Select JS -->
<script type="text/javascript" src="<?php echo e(asset('assets/front/js/vendors/jquery.nice-select.min.js')); ?>"></script>
<!-- Magnific Popup JS -->
<script type="text/javascript" src="<?php echo e(asset('assets/front/js/vendors/jquery.magnific-popup.min.js')); ?>"></script>
<!-- Swiper Slider JS -->
<script type="text/javascript" src="<?php echo e(asset('assets/front/js/vendors/swiper-bundle.min.js')); ?>"></script>
<!-- Lazysizes -->
<script type="text/javascript" src="<?php echo e(asset('assets/front/js/vendors/lazysizes.min.js')); ?>"></script>
<!-- Mouse Hover JS -->
<script type="text/javascript" src="<?php echo e(asset('assets/front/js/vendors/mouse-hover-move.js')); ?>"></script>
<!-- AOS JS -->
<script type="text/javascript" src="<?php echo e(asset('assets/front/js/vendors/aos.min.js')); ?>"></script>
<!-- Data Tables JS -->
<script type="text/javascript" src="<?php echo e(asset('assets/front/js/vendors/datatables.min.js')); ?>"></script>
<!-- SVG Loader JS -->
<script type="text/javascript" src="<?php echo e(asset('assets/front/js/vendors/svg-loader.min.js')); ?>"></script>

<script type="text/javascript" src="<?php echo e(asset('assets/js/tinymce/js/tinymce/tinymce.min.js')); ?>"></script>

<script type="text/javascript" src="<?php echo e(asset('assets/js/slick.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('assets/js/toastr.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('assets/js/jquery-ui.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('assets/js/jquery.timepicker.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('assets/js/select2.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('assets/js/jquery-syotimer.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/js/sweet-alert.min.js')); ?>"></script>

<?php if(session()->has('success')): ?>
  <script>
    toastr['success']("<?php echo e(__(session('success'))); ?>");
  </script>
<?php endif; ?>

<?php if(session()->has('error')): ?>
  <script>
    toastr['error']("<?php echo e(__(session('error'))); ?>");
  </script>
<?php endif; ?>

<?php if(session()->has('warning')): ?>
  <script>
    toastr['warning']("<?php echo e(__(session('warning'))); ?>");
  </script>
<?php endif; ?>


<script>
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
</script>



<?php echo $__env->yieldContent('script'); ?>
<script type="text/javascript" src="<?php echo e(asset('assets/js/subscriptions/expressOptions.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('assets/js/push-notification.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('assets/js/floating-whatsapp.js')); ?>"></script>
<!-- Main script JS -->
<script type="text/javascript" src="<?php echo e(asset('assets/front/js/script.js')); ?>"></script>
<?php /**PATH C:\Users\younes\Downloads\junspro-main (1)\junspro-main3\resources\views\frontend\partials\scripts\script-v2.blade.php ENDPATH**/ ?>