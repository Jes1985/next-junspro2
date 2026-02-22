<?php $__env->startSection('content'); ?>
  <div class="page-header">
    <h4 class="page-title"><?php echo e(__('Monthly Total Income')); ?></h4>
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
        <a href="#"><?php echo e(__('Monthly Total Income')); ?></a>
      </li>
    </ul>
  </div>

  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <div class="row">

            <div class="col-lg-5">
              <div class="card-title d-inline-block">
                <?php echo e(__('Monthly Total Income')); ?>

              </div>
            </div>
            <div class="col-lg-7">
              <div class="card-title d-inline-block">
                <form action="<?php echo e(route('seller.monthly_income')); ?>" id="year" method="get">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <select id="year" class="form-control" name="year"
                          onchange="document.getElementById('year').submit()">
                          <option value=""><?php echo e(__('Select Year')); ?></option>
                          <?php for($year = 2023; $year <= date('Y'); $year++): ?>
                            <option
                              <?php if(request()->input('year') == '' && $year == date('Y')): ?> <?php echo e('selected'); ?> 
                          <?php elseif(request()->input('year') == $year): ?>
                          <?php echo e('selected'); ?> <?php endif; ?>
                              value="<?php echo e($year); ?>">
                              <?php echo e($year); ?></option>
                          <?php endfor; ?>
                        </select>
                      </div>
                    </div>

                  </div>

                </form>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="card-body">
        <div class="row">
          <div class="col-lg-8 mx-auto">

            <div class="table-responsive">
              <table class="table table-striped mt-3">
                <thead>
                  <tr>
                    <th scope="col"><?php echo e(__('Month Name')); ?></th>
                    <th scope="col"><?php echo e(__('Total Income')); ?></th>
                  </tr>
                </thead>
                <tbody>
                  <?php $__currentLoopData = $incomes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                      <td>
                        <?php
                          $monthNum = $key + 1;
                          $dateObj = DateTime::createFromFormat('!m', $monthNum);
                          $monthName = $dateObj->format('F');
                        ?>
                        <?php echo e($monthName); ?>

                      </td>

                      <td>
                        <?php echo e($settings->base_currency_symbol_position == 'left' ? $settings->base_currency_symbol : ''); ?>

                        <?php echo e(round($value + $returns[$key] - ($expenses[$key] + $taxes[$key]), 2)); ?>

                        <?php echo e($settings->base_currency_symbol_position == 'right' ? $settings->base_currency_symbol : ''); ?>

                      </td>
                    </tr>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>

      <div class="card-footer"></div>
    </div>
  </div>
  </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('seller.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\younes\Downloads\junspro-main (1)\junspro-main3\resources\views\seller\income.blade.php ENDPATH**/ ?>