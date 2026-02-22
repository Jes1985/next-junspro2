<?php $__env->startSection('style'); ?>
  <style type="text/css">
    @font-face {
      font-family: 'Lato-Regular';
      src: url('<?php echo e(asset('assets/fonts/Lato-Regular.ttf')); ?>');
    }

    input[type='range'] {
      cursor: pointer;
    }
  </style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
  <div class="page-header">
    <h4 class="page-title"><?php echo e(__('Generate Code')); ?></h4>
    <ul class="breadcrumbs">
      <li class="nav-home">
        <a href="<?php echo e(route('seller.dashboard')); ?>">
          <i class="flaticon-home"></i>
        </a>
      </li>
      <li class="separator">
        <i class="flaticon-right-arrow"></i>
      </li>
      <li class="nav-item">
        <a href="#"><?php echo e(__('QR Codes')); ?></a>
      </li>
      <li class="separator">
        <i class="flaticon-right-arrow"></i>
      </li>
      <li class="nav-item">
        <a href="#"><?php echo e(__('Generate Code')); ?></a>
      </li>
    </ul>
  </div>

  <div class="row">
    <div class="col-lg-7">
      <div class="card">
        <div class="card-header">
          <div class="row">
            <div class="col">
              <div class="card-title"><?php echo e(__('Generate QR Code')); ?></div>
            </div>
          </div>
        </div>

        <div class="card-body">
          <div class="alert alert-info text-center" role="alert">
            <strong class="text-dark">
              <?php echo e(__('Click the mouse after giving the input in \'URL\' and \'Text\' field.')); ?>

            </strong>
          </div>

          <form id="qrCodeForm" method="POST" enctype="multipart/form-data">
            <?php echo csrf_field(); ?>
            <div class="row">
              <div class="col-lg-6">
                <div class="form-group">
                  <label for=""><?php echo e(__('URL') . '*'); ?></label>
                  <input type="url" class="form-control" name="url" value="<?php echo e($bs->qr_url); ?>"
                    onchange="generateQR()">
                  <p class="mt-1 mb-0 text-warning">
                    <?php echo e(__('QR Code will be generate for this url') . '.'); ?>

                  </p>
                </div>
              </div>

              <div class="col-lg-6">
                <div class="form-group">
                  <label for=""><?php echo e(__('Color')); ?></label>
                  <input type="text" class="form-control jscolor" name="color" value="<?php echo e($bs->qr_color); ?>"
                    onchange="generateQR()">
                  <p class="mt-1 mb-0 text-warning">
                    <?php echo e(__('If the QR Code cannot be scanned, then chosse a darker color') . '.'); ?>

                  </p>
                </div>
              </div>

              <div class="col-lg-6">
                <div class="form-group">
                  <label for=""><?php echo e(__('Size')); ?></label>
                  <input type="range" class="form-control p-0" name="size" min="200" max="350"
                    value="<?php echo e($bs->qr_size); ?>" onchange="generateQR()">
                  <span class="text-info float-right"><?php echo e($bs->qr_size); ?></span>
                </div>
              </div>

              <div class="col-lg-6">
                <div class="form-group">
                  <label for=""><?php echo e(__('White Space')); ?></label>
                  <input type="range" class="form-control p-0" name="margin" min="0" max="5"
                    value="<?php echo e($bs->qr_margin); ?>" onchange="generateQR()">
                  <span class="text-info float-right"><?php echo e($bs->qr_margin); ?></span>
                </div>
              </div>

              <div class="col-lg-6">
                <div class="form-group">
                  <label for=""><?php echo e(__('Style')); ?></label>
                  <select name="style" class="form-control" onchange="generateQR()">
                    <option value="square" <?php echo e($bs->qr_style == 'square' ? 'selected' : ''); ?>>
                      <?php echo e(__('Square')); ?>

                    </option>
                    <option value="round" <?php echo e($bs->qr_style == 'round' ? 'selected' : ''); ?>>
                      <?php echo e(__('Round')); ?>

                    </option>
                  </select>
                </div>
              </div>

              <div class="col-lg-6">
                <div class="form-group">
                  <label for=""><?php echo e(__('Eye Style')); ?></label>
                  <select name="eye_style" class="form-control" onchange="generateQR()">
                    <option value="square" <?php echo e($bs->qr_eye_style == 'square' ? 'selected' : ''); ?>>
                      <?php echo e(__('Square')); ?>

                    </option>
                    <option value="circle" <?php echo e($bs->qr_eye_style == 'circle' ? 'selected' : ''); ?>>
                      <?php echo e(__('Circle')); ?>

                    </option>
                  </select>
                </div>
              </div>

              <div class="col-lg-12">
                <div class="form-group">
                  <label for=""><?php echo e(__('Code Type')); ?></label>
                  <select name="type" class="form-control" onchange="generateQR()">
                    <option value="default" <?php echo e($bs->qr_type == 'default' ? 'selected' : ''); ?>>
                      <?php echo e(__('Default')); ?>

                    </option>
                    <option value="image" <?php echo e($bs->qr_type == 'image' ? 'selected' : ''); ?>>
                      <?php echo e(__('Image')); ?>

                    </option>
                    <option value="text" <?php echo e($bs->qr_type == 'text' ? 'selected' : ''); ?>>
                      <?php echo e(__('Text')); ?>

                    </option>
                  </select>
                </div>
              </div>
            </div>

            <div class="row qrcode-type" id="image-type">
              <div class="col-lg-12">
                <div class="form-group">
                  <label for=""><?php echo e(__('Image')); ?></label>
                  <br>
                  <div class="thumb-preview">
                    <?php if(empty($bs->qr_inserted_image)): ?>
                      <img src="<?php echo e(asset('assets/img/noimage.jpg')); ?>" alt="..." class="uploaded-img">
                    <?php else: ?>
                      <img src="<?php echo e(asset('assets/img/qr-codes/' . $bs->qr_inserted_image)); ?>" alt="inserted image"
                        class="uploaded-img">
                    <?php endif; ?>
                  </div>

                  <div class="mt-3">
                    <div role="button" class="btn btn-primary btn-sm upload-btn">
                      <?php echo e(__('Choose Image')); ?>

                      <input type="file" class="img-input" name="image" onchange="generateQR()">
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-lg-12">
                <div class="form-group">
                  <label for=""><?php echo e(__('Image Size')); ?></label>
                  <input type="range" class="form-control p-0" name="image_size" min="1" max="20"
                    value="<?php echo e($bs->qr_inserted_image_size); ?>" onchange="generateQR()">
                  <span class="text-info float-right"><?php echo e($bs->qr_inserted_image_size); ?></span>
                  <p class="mt-1 mb-0 text-warning">
                    <?php echo e(__('If the QR Code cannot be scanned, then reduce the image size') . '.'); ?>

                  </p>
                </div>
              </div>

              <div class="col-lg-6">
                <div class="form-group">
                  <label for=""><?php echo e(__('Image Horizontal Position')); ?></label>
                  <input type="range" class="form-control p-0" name="img_x_pos" min="0" max="100"
                    value="<?php echo e($bs->qr_inserted_image_x); ?>" onchange="generateQR()">
                  <span class="text-info float-right"><?php echo e($bs->qr_inserted_image_x); ?></span>
                </div>
              </div>

              <div class="col-lg-6">
                <div class="form-group">
                  <label for=""><?php echo e(__('Image Vertical Position')); ?></label>
                  <input type="range" class="form-control p-0" name="img_y_pos" min="0" max="100"
                    value="<?php echo e($bs->qr_inserted_image_y); ?>" onchange="generateQR()">
                  <span class="text-info float-right"><?php echo e($bs->qr_inserted_image_y); ?></span>
                </div>
              </div>
            </div>

            <div class="row qrcode-type" id="text-type">
              <div class="col-lg-6">
                <div class="form-group">
                  <label for=""><?php echo e(__('Text')); ?></label>
                  <input type="text" class="form-control" name="text" value="<?php echo e($bs->qr_text); ?>"
                    onchange="generateQR()">
                </div>
              </div>

              <div class="col-lg-6">
                <div class="form-group">
                  <label for=""><?php echo e(__('Text Color')); ?></label>
                  <input type="text" class="form-control jscolor" name="text_color"
                    value="<?php echo e($bs->qr_text_color); ?>" onchange="generateQR()">
                </div>
              </div>

              <div class="col-lg-12">
                <div class="form-group">
                  <label for=""><?php echo e(__('Text Size')); ?></label>
                  <input type="range" class="form-control p-0" name="text_size" min="1" max="15"
                    value="<?php echo e($bs->qr_text_size); ?>" onchange="generateQR()">
                  <span class="text-info float-right"><?php echo e($bs->qr_text_size); ?></span>
                  <p class="mt-1 mb-0 text-warning">
                    <?php echo e(__('If the QR Code cannot be scanned, then reduce the text size') . '.'); ?>

                  </p>
                </div>
              </div>

              <div class="col-lg-6">
                <div class="form-group">
                  <label for=""><?php echo e(__('Text Horizontal Position')); ?></label>
                  <input type="range" class="form-control p-0" name="txt_x_pos" min="0" max="100"
                    value="<?php echo e($bs->qr_text_x); ?>" onchange="generateQR()">
                  <span class="text-info float-right"><?php echo e($bs->qr_text_x); ?></span>
                </div>
              </div>

              <div class="col-lg-6">
                <div class="form-group">
                  <label for=""><?php echo e(__('Text Vertical Position')); ?></label>
                  <input type="range" class="form-control p-0" name="txt_y_pos" min="0" max="100"
                    value="<?php echo e($bs->qr_text_y); ?>" onchange="generateQR()">
                  <span class="text-info float-right"><?php echo e($bs->qr_text_y); ?></span>
                </div>
              </div>

              <span id="text-input" class="invisible"></span>
            </div>
          </form>
        </div>
      </div>
    </div>

    <div class="col-lg-5">
      <div class="card bg-white">
        <div class="card-header">
          <div class="row">
            <div class="col-lg-4">
              <div class="card-title text-dark"><?php echo e(__('Preview')); ?></div>
            </div>

            <div class="col-lg-8">
              <form action="<?php echo e(route('seller.qr_codes.clear')); ?>" method="post"
                class="d-inline-block float-lg-right float-left">
                <?php echo csrf_field(); ?>
                <button type="submit" class="btn btn-danger btn-sm">
                  <?php echo e(__('Clear')); ?>

                </button>
              </form>

              <a href="#" data-toggle="modal" data-target="#saveModal"
                class="btn btn-success btn-sm float-lg-right float-left mr-2"><?php echo e(__('Save')); ?></a>
            </div>
          </div>
        </div>

        <div class="card-body text-center py-5">
          <div class="bg-light d-inline-block p-3 border rounded">
            <img src="<?php echo e(asset('assets/img/qr-codes/' . $bs->qr_image)); ?>" alt="qr code" id="preview">
          </div>
        </div>

        <div class="card-footer text-center">
          <a href="<?php echo e(asset('assets/img/qr-codes/' . $bs->qr_image)); ?>" class="btn btn-primary btn-sm"
            download="qrcode.png" id="btn-download">
            <?php echo e(__('Download')); ?>

          </a>
        </div>
      </div>
    </div>
  </div>

  
  <?php if ($__env->exists('seller.qr-code.save')) echo $__env->make('seller.qr-code.save', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
  <script>
    let regenerateUrl = "<?php echo e(route('seller.qr_codes.regenerate_code')); ?>";
  </script>

  <script type="text/javascript" src="<?php echo e(asset('assets/js/qr-code.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('seller.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\younes\Downloads\junspro-main (1)\junspro-main3\resources\views\seller\qr-code\generate.blade.php ENDPATH**/ ?>