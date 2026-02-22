<script>
  'use strict';
  let demo_mode = "<?php echo e(env('DEMO_MODE')); ?>";
</script>


<script type="text/javascript" src="<?php echo e(asset('assets/js/jquery-3.7.1.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('assets/js/popper.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('assets/js/bootstrap.min.js')); ?>"></script>


<script type="text/javascript" src="<?php echo e(asset('assets/js/jquery-ui.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('assets/js/jquery.ui.touch-punch.min.js')); ?>"></script>


<script type="text/javascript" src="<?php echo e(asset('assets/js/jquery.timepicker.min.js')); ?>"></script>


<script type="text/javascript" src="<?php echo e(asset('assets/js/jquery.scrollbar.min.js')); ?>"></script>


<script type="text/javascript" src="<?php echo e(asset('assets/js/bootstrap-notify.min.js')); ?>"></script>


<script type="text/javascript" src="<?php echo e(asset('assets/js/sweet-alert.min.js')); ?>"></script>


<script type="text/javascript" src="<?php echo e(asset('assets/js/bootstrap-tagsinput.min.js')); ?>"></script>


<script type="text/javascript" src="<?php echo e(asset('assets/js/bootstrap-datepicker.min.js')); ?>"></script>


<script type="text/javascript" src="<?php echo e(asset('assets/js/tinymce/js/tinymce/tinymce.min.js')); ?>"></script>


<script type="text/javascript" src="<?php echo e(asset('assets/js/jscolor.min.js')); ?>"></script>


<script type="text/javascript" src="<?php echo e(asset('assets/js/fontawesome-iconpicker.min.js')); ?>"></script>


<script type="text/javascript" src="<?php echo e(asset('assets/js/datatables-1.10.23.min.js')); ?>"></script>


<script type="text/javascript" src="<?php echo e(asset('assets/js/datatables.bootstrap4.min.js')); ?>"></script>


<script type="text/javascript" src="<?php echo e(asset('assets/js/dropzone.min.js')); ?>"></script>


<script type="text/javascript" src="<?php echo e(asset('assets/js/atlantis.js')); ?>"></script>


<script type="text/javascript" src="<?php echo e(asset('assets/js/select2.min.js')); ?>"></script>


<script>
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
</script>


<script type="text/javascript" src="<?php echo e(asset('assets/js/webfont.min.js')); ?>"></script>

<script>
  WebFont.load({
    google: {
      "families": ["Lato:300,400,700,900"]
    },
    custom: {
      "families": ["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands",
        "simple-line-icons"
      ],
      urls: ['<?php echo e(asset('assets/css/fonts.min.css')); ?>']
    },
    active: function() {
      sessionStorage.fonts = true;
    }
  });
</script>

<?php if(session()->has('success')): ?>
  <script>
    var content = {};

    content.message = '<?php echo e(session('success')); ?>';
    content.title = 'Success';
    content.icon = 'fas fa-check-circle';

    $.notify(content, {
      type: 'success',
      placement: {
        from: 'top',
        align: 'right'
      },
      showProgressbar: true,
      time: 1000,
      delay: 4000
    });
  </script>
<?php endif; ?>

<?php if(session()->has('warning')): ?>
  <script>
    var content = {};

    content.message = '<?php echo e(session('warning')); ?>';
    content.title = 'Warning';
    content.icon = 'fas fa-exclamation-circle';

    $.notify(content, {
      type: 'warning',
      placement: {
        from: 'top',
        align: 'right'
      },
      showProgressbar: true,
      time: 1000,
      delay: 4000
    });
  </script>
<?php endif; ?>

<?php if(session()->has('error')): ?>
  <script>
    var content = {};

    content.message = '<?php echo e(session('error')); ?>';
    content.title = 'Error';
    content.icon = 'fas fa-times-circle';

    $.notify(content, {
      type: 'danger',
      placement: {
        from: 'top',
        align: 'right'
      },
      showProgressbar: true,
      time: 1000,
      delay: 4000
    });
  </script>
<?php endif; ?>

<script>
  var account_status = <?php echo e(Auth::guard('seller')->user()->status); ?>;
  var baseUrl = "<?php echo e(route('index')); ?>";
</script>
<?php if(session()->has('secret_login')): ?>
  <script>
    var secret_login = <?php echo e(Session::get('secret_login')); ?>;
  </script>
<?php else: ?>
  <script>
    var secret_login = 0;
  </script>
<?php endif; ?>


<script type="text/javascript" src="<?php echo e(asset('assets/js/admin-main.js')); ?>"></script>
<?php /**PATH C:\Users\younes\Downloads\junspro-main (1)\junspro-main3\resources\views\seller\partials\scripts.blade.php ENDPATH**/ ?>