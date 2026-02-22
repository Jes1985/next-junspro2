<?php if ($__env->exists('backend.partials.rtl-style')) echo $__env->make('backend.partials.rtl-style', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<?php $__env->startSection('content'); ?>
  <div class="page-header">
    <h4 class="page-title"><?php echo e(__('Hero Section')); ?></h4>
    <ul class="breadcrumbs">
      <li class="nav-home">
        <a href="<?php echo e(route('admin.dashboard')); ?>">
          <i class="flaticon-home"></i>
        </a>
      </li>
      <li class="separator">
        <i class="flaticon-right-arrow"></i>
      </li>
      <li class="nav-item">
        <a href="#"><?php echo e(__('Home Page')); ?></a>
      </li>
      <li class="separator">
        <i class="flaticon-right-arrow"></i>
      </li>
      <li class="nav-item">
        <a href="#"><?php echo e(__('Hero Section')); ?></a>
      </li>
    </ul>
  </div>

  <div class="row">
    <div class="col-md-6">
      <div class="card">
        <div class="card-header">
          <div class="row">
            <div class="col">
              <div class="card-title"><?php echo e(__('Image')); ?></div>
            </div>
          </div>
        </div>

        <div class="card-body">
          <div class="row">
            <div class="col-lg-8 offset-lg-2">
              <form id="bgImgForm" action="<?php echo e(route('admin.home_page.update_hero_bg')); ?>" method="POST"
                enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <div class="form-group">
                  <label for=""><?php echo e(__('Background Image') . '*'); ?></label>
                  <br>
                  <div class="thumb-preview">
                    <?php if(empty($bgImg)): ?>
                      <img src="<?php echo e(asset('assets/img/noimage.jpg')); ?>" alt="..." class="uploaded-background-img">
                    <?php else: ?>
                      <img src="<?php echo e(asset('assets/img/' . $bgImg)); ?>" alt="image" class="uploaded-background-img">
                    <?php endif; ?>
                  </div>

                  <div class="mt-3">
                    <div role="button" class="btn btn-primary btn-sm upload-btn">
                      <?php echo e(__('Choose Image')); ?>

                      <input type="file" class="background-img-input" name="hero_bg_img">
                    </div>
                  </div>
                  <?php $__errorArgs = ['hero_bg_img'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <p class="mt-2 mb-0 text-danger"><?php echo e($message); ?></p>
                  <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
              </form>
            </div>
          </div>
        </div>

        <div class="card-footer">
          <div class="row">
            <div class="col-12 text-center">
              <button type="submit" form="bgImgForm" class="btn btn-success">
                <?php echo e(__('Update')); ?>

              </button>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-md-6">
      <div class="card">
        <div class="card-header">
          <div class="row">
            <div class="col-lg-4">
              <div class="card-title d-inline-block"><?php echo e(__('Sliders')); ?></div>
            </div>

            <div class="col-lg-3">
              <?php if ($__env->exists('backend.partials.languages')) echo $__env->make('backend.partials.languages', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
            </div>

            <div class="col-lg-4 offset-lg-1 mt-2 mt-lg-0">
              <a href="#" data-toggle="modal" data-target="#createModal"
                class="btn btn-primary btn-sm float-lg-right float-left">
                <i class="fas fa-plus"></i> <?php echo e(__('Add')); ?>

              </a>
            </div>
          </div>
        </div>

        <div class="card-body">
          <div class="row">
            <div class="col-md-12">
              <?php if(count($sliders) == 0): ?>
                <h3 class="text-center mt-2"><?php echo e(__('NO SLIDER FOUND') . '!'); ?></h3>
              <?php else: ?>
                <div class="row">
                  <?php $__currentLoopData = $sliders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $slider): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-md-3">
                      <div class="card">
                        <div class="card-body">
                          <img src="<?php echo e(asset('assets/img/hero-sliders/' . $slider->image)); ?>" alt="image"
                            class="mdb_100">
                        </div>

                        <div class="card-footer text-center">
                          <a class="editBtn btn btn-secondary btn-sm mr-2" href="#" data-toggle="modal"
                            data-target="#editModal" data-id="<?php echo e($slider->id); ?>"
                            data-image="<?php echo e(asset('assets/img/hero-sliders/' . $slider->image)); ?>"
                            data-title="<?php echo e($slider->title); ?>" data-text="<?php echo e($slider->text); ?>"
                            data-button_name="<?php echo e($slider->button_name); ?>" data-button_url="<?php echo e($slider->button_url); ?>">
                            <span class="btn-label">
                              <i class="fas fa-edit"></i>
                            </span>
                          </a>

                          <form class="deleteForm d-inline-block"
                            action="<?php echo e(route('admin.home_page.delete_slider', ['id' => $slider->id])); ?>" method="post">
                            <?php echo csrf_field(); ?>
                            <button type="submit" class="btn btn-danger btn-sm deleteBtn">
                              <span class="btn-label">
                                <i class="fas fa-trash"></i>
                              </span>
                            </button>
                          </form>
                        </div>
                      </div>
                    </div>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
              <?php endif; ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  
  <?php if ($__env->exists('backend.home-page.hero-section.slider.create')) echo $__env->make('backend.home-page.hero-section.slider.create', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

  
  <?php if ($__env->exists('backend.home-page.hero-section.slider.edit')) echo $__env->make('backend.home-page.hero-section.slider.edit', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\younes\Downloads\junspro-main (1)\junspro-main3\resources\views\backend\home-page\hero-section\slider\index.blade.php ENDPATH**/ ?>