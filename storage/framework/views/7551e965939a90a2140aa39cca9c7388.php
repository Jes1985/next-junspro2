<?php if ($__env->exists('backend.partials.rtl-style')) echo $__env->make('backend.partials.rtl-style', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<?php $__env->startSection('content'); ?>
  <div class="page-header">
    <h4 class="page-title"><?php echo e(__('Testimonials Section')); ?></h4>
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
        <a href="#"><?php echo e(__('Testimonials Section')); ?></a>
      </li>
    </ul>
  </div>

  <div class="row">
    <?php if($settings->theme_version == 1): ?>
      <div class="col-lg-4">
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
                <form id="bgImgForm" action="<?php echo e(route('admin.home_page.update_testimonials_bg')); ?>" method="POST"
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

                        <input type="file" class="background-img-input" name="testimonial_bg_img">
                      </div>
                    </div>
                    <?php $__errorArgs = ['testimonial_bg_img'];
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
    <?php endif; ?>

    <div class="col-lg-<?php echo e($settings->theme_version == 1 ? '8' : '12'); ?>">
      <div class="card">
        <div class="card-header">
          <div class="row">
            <div class="col-lg-4">
              <div class="card-title"><?php echo e(__('Testimonials')); ?></div>
            </div>

            <div class="col-lg-3">
              <?php if ($__env->exists('backend.partials.languages')) echo $__env->make('backend.partials.languages', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
            </div>

            <div class="col-lg-4 offset-lg-1 mt-2 mt-lg-0">
              <a href="#" data-toggle="modal" data-target="#createModal"
                class="btn btn-primary btn-sm float-lg-right float-left">
                <i class="fas fa-plus"></i> <?php echo e(__('Add')); ?>

              </a>

              <button class="btn btn-danger btn-sm float-right mr-2 d-none bulk-delete"
                data-href="<?php echo e(route('admin.home_page.bulk_delete_testimonial')); ?>">
                <i class="flaticon-interface-5"></i> <?php echo e(__('Delete')); ?>

              </button>
            </div>
          </div>
        </div>

        <div class="card-body">
          <div class="row">
            <div class="col">
              <?php if(count($testimonials) == 0): ?>
                <h3 class="text-center mt-2"><?php echo e(__('NO TESTIMONIAL FOUND') . '!'); ?></h3>
              <?php else: ?>
                <div class="table-responsive">
                  <table class="table table-striped mt-3" id="basic-datatables">
                    <thead>
                      <tr>
                        <th scope="col">
                          <input type="checkbox" class="bulk-check" data-val="all">
                        </th>
                        <th scope="col"><?php echo e(__('Image')); ?></th>
                        <th scope="col"><?php echo e(__('Name')); ?></th>
                        <th scope="col"><?php echo e(__('Occupation')); ?></th>
                        <th scope="col"><?php echo e(__('Comment')); ?></th>
                        <th scope="col"><?php echo e(__('Actions')); ?></th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $__currentLoopData = $testimonials; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $testimonial): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                          <td>
                            <input type="checkbox" class="bulk-check" data-val="<?php echo e($testimonial->id); ?>">
                          </td>
                          <td>
                            <img src="<?php echo e(asset('assets/img/clients/' . $testimonial->image)); ?>" alt="client image"
                              width="45">
                          </td>
                          <td><?php echo e($testimonial->name); ?></td>
                          <td><?php echo e($testimonial->occupation); ?></td>
                          <td>
                            <?php echo e(strlen($testimonial->comment) > 30 ? mb_substr($testimonial->comment, 0, 30, 'UTF-8') . '...' : $testimonial->comment); ?>

                          </td>
                          <td>
                            <a class="btn btn-secondary btn-sm mr-1 editBtn mb-1" href="#" data-toggle="modal"
                              data-target="#editModal" data-id="<?php echo e($testimonial->id); ?>"
                              data-image="<?php echo e(asset('assets/img/clients/' . $testimonial->image)); ?>"
                              data-name="<?php echo e($testimonial->name); ?>" data-occupation="<?php echo e($testimonial->occupation); ?>"
                              data-comment="<?php echo e($testimonial->comment); ?>">
                              <span class="btn-label">
                                <i class="fas fa-edit"></i>
                              </span>

                            </a>

                            <form class="deleteForm d-inline-block"
                              action="<?php echo e(route('admin.home_page.delete_testimonial', ['id' => $testimonial->id])); ?>"
                              method="post">
                              <?php echo csrf_field(); ?>
                              <button type="submit" class="btn btn-danger btn-sm deleteBtn mb-1">
                                <span class="btn-label">
                                  <i class="fas fa-trash"></i>
                                </span>

                              </button>
                            </form>
                          </td>
                        </tr>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                  </table>
                </div>
              <?php endif; ?>
            </div>
          </div>
        </div>

        <div class="card-footer"></div>
      </div>
    </div>
  </div>

  
  <?php if ($__env->exists('backend.home-page.testimonial-section.create')) echo $__env->make('backend.home-page.testimonial-section.create', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

  
  <?php if ($__env->exists('backend.home-page.testimonial-section.edit')) echo $__env->make('backend.home-page.testimonial-section.edit', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\younes\Downloads\junspro-main (1)\junspro-main3\resources\views\backend\home-page\testimonial-section\index.blade.php ENDPATH**/ ?>