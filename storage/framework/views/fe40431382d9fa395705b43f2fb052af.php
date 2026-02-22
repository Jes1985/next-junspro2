<?php $__currentLoopData = $inputs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $input): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    
    <?php if($input->type == 1): ?>
        <form class="ui-state-default" action="<?php echo e(route('admin.withdraw_payment_method.options_delete')); ?>" method="post"
            data-id="<?php echo e($input->id); ?>" data-id="<?php echo e($input->id); ?>">
            <?php echo e(csrf_field()); ?>

            <input type="hidden" name="input_id" value="<?php echo e($input->id); ?>">
            <div class="form-group">
                <label for=""><?php echo e($input->label); ?> <?php if($input->required == 1): ?>
                        <span>**</span>
                    <?php elseif($input->required == 0): ?>
                        (<?php echo e(__('Optional')); ?>)
                    <?php endif; ?>
                </label>
                <div class="row">
                    <div class="col-md-10">
                        <input class="form-control" type="text" name="" value=""
                            placeholder="<?php echo e($input->placeholder); ?>">
                    </div>
                    <div class="col-md-1">
                        <a class="btn btn-warning btn-sm mb-1"
                            href="<?php echo e(route('admin.withdraw_payment_method.edit_input', $input->id)); ?>"
                            target="_blank">
                            <i class="fas fa-edit"></i>
                        </a>
                    </div>
                    <div class="col-md-1">
                        <button class="btn btn-danger btn-sm mb-1" type="submit">
                            <i class="fa fa-times"></i>
                        </button>
                    </div>
                </div>
            </div>
        </form>
    <?php elseif($input->type == 7): ?>
        <form class="ui-state-default" action="<?php echo e(route('admin.withdraw_payment_method.options_delete')); ?>" method="post"
            data-id="<?php echo e($input->id); ?>">
            <?php echo e(csrf_field()); ?>

            <input type="hidden" name="input_id" value="<?php echo e($input->id); ?>">
            <div class="form-group">
                <label for=""><?php echo e($input->label); ?> <?php if($input->required == 1): ?>
                        <span>**</span>
                    <?php elseif($input->required == 0): ?>
                        (<?php echo e(__('Optional')); ?>)
                    <?php endif; ?>
                </label>
                <div class="row">
                    <div class="col-md-10">
                        <input class="form-control" type="number" name="" value=""
                            placeholder="<?php echo e($input->placeholder); ?>">
                    </div>
                    <div class="col-md-1">
                        <a class="btn btn-warning btn-sm"
                            href="<?php echo e(route('admin.withdraw_payment_method.edit_input', $input->id)); ?>"
                            target="_blank">
                            <i class="fas fa-edit"></i>
                        </a>
                    </div>
                    <div class="col-md-1">
                        <button class="btn btn-danger btn-sm" type="submit">
                            <i class="fa fa-times"></i>
                        </button>
                    </div>
                </div>
            </div>
        </form>
    <?php elseif($input->type == 2): ?>
        <form class="ui-state-default" action="<?php echo e(route('admin.withdraw_payment_method.options_delete')); ?>" method="post"
            data-id="<?php echo e($input->id); ?>">
            <?php echo e(csrf_field()); ?>

            <input type="hidden" name="input_id" value="<?php echo e($input->id); ?>">
            <div class="form-group">
                <label for=""><?php echo e($input->label); ?> <?php if($input->required == 1): ?>
                        <span>**</span>
                    <?php elseif($input->required == 0): ?>
                        (<?php echo e(__('Optional')); ?>)
                    <?php endif; ?>
                </label>
                <div class="row">
                    <div class="col-md-10">
                        <select class="form-control" name="">
                            <?php
                                $input_options = DB::table('withdraw_method_options')->where('withdraw_method_input_id', $input->id)->get();
                            ?>
                            <option value="" selected disabled><?php echo e($input->placeholder); ?></option>
                            <?php $__currentLoopData = $input_options; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value=""><?php echo e($option->name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>

                    <div class="col-md-1">
                        <a class="btn btn-warning btn-sm"
                            href="<?php echo e(route('admin.withdraw_payment_method.edit_input', $input->id)); ?>"
                            target="_blank">
                            <i class="fas fa-edit"></i>
                        </a>
                    </div>
                    <div class="col-md-1">
                        <button class="btn btn-danger btn-sm" type="submit">
                            <i class="fa fa-times"></i>
                        </button>
                    </div>
                </div>
            </div>
        </form>
    <?php elseif($input->type == 3): ?>
        <form class="ui-state-default" action="<?php echo e(route('admin.withdraw_payment_method.options_delete')); ?>" method="post"
            data-id="<?php echo e($input->id); ?>">
            <?php echo e(csrf_field()); ?>

            <input type="hidden" name="input_id" value="<?php echo e($input->id); ?>">
            <div class="form-group">
                <label for=""><?php echo e($input->label); ?> <?php if($input->required == 1): ?>
                        <span>**</span>
                    <?php elseif($input->required == 0): ?>
                        (<?php echo e(__('Optional')); ?>)
                    <?php endif; ?>
                </label>
                <div class="row">
                    <div class="col-md-10">
                        <?php
                          $input_options = DB::table('withdraw_method_options')->where('withdraw_method_input_id', $input->id)->get();
                        ?>
                        <?php $__currentLoopData = $input_options; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" id="customRadio<?php echo e($option->id); ?>" name="customRadio"
                                    class="custom-control-input">
                                <label class="custom-control-label"
                                    for="customRadio<?php echo e($option->id); ?>"><?php echo e($option->name); ?></label>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                    <div class="col-md-1">
                        <a class="btn btn-warning btn-sm"
                            href="<?php echo e(route('admin.withdraw_payment_method.edit_input', $input->id)); ?>"
                            target="_blank">
                            <i class="fas fa-edit"></i>
                        </a>
                    </div>
                    <div class="col-md-1">
                        <button type="submit" class="btn btn-danger btn-sm">
                            <i class="fa fa-times"></i>
                        </button>
                    </div>
                </div>
            </div>
        </form>
    <?php elseif($input->type == 4): ?>
        <form class="ui-state-default" action="<?php echo e(route('admin.withdraw_payment_method.options_delete')); ?>" method="post"
            data-id="<?php echo e($input->id); ?>">
            <?php echo e(csrf_field()); ?>

            <input type="hidden" name="input_id" value="<?php echo e($input->id); ?>">
            <div class="form-group">
                <label for=""><?php echo e($input->label); ?> <?php if($input->required == 1): ?>
                        <span>**</span>
                    <?php elseif($input->required == 0): ?>
                        (<?php echo e(__('Optional')); ?>)
                    <?php endif; ?>
                </label>
                <div class="row">
                    <div class="col-md-10">
                        <textarea class="form-control" name="" rows="5" cols="80" placeholder="<?php echo e($input->placeholder); ?>"></textarea>
                    </div>
                    <div class="col-md-1">
                        <a class="btn btn-warning btn-sm"
                            href="<?php echo e(route('admin.withdraw_payment_method.edit_input', $input->id)); ?>"
                            target="_blank">
                            <i class="fas fa-edit"></i>
                        </a>
                    </div>
                    <div class="col-md-1">
                        <button type="submit" class="btn btn-danger btn-sm">
                            <i class="fa fa-times"></i>
                        </button>
                    </div>
                </div>
            </div>
        </form>
    <?php elseif($input->type == 5): ?>
        <form class="ui-state-default" action="<?php echo e(route('admin.withdraw_payment_method.options_delete')); ?>" method="post"
            data-id="<?php echo e($input->id); ?>">
            <?php echo e(csrf_field()); ?>

            <input type="hidden" name="input_id" value="<?php echo e($input->id); ?>">
            <div class="form-group">
                <label for=""><?php echo e($input->label); ?> <?php if($input->required == 1): ?>
                        <span>**</span>
                    <?php elseif($input->required == 0): ?>
                        (<?php echo e(__('Optional')); ?>)
                    <?php endif; ?>
                </label>
                <div class="row">
                    <div class="col-md-10">
                        <input type="text" class="form-control datepicker" autocomplete="off"
                            placeholder="<?php echo e($input->placeholder); ?>">
                    </div>
                    <div class="col-md-1">
                        <a class="btn btn-warning btn-sm"
                            href="<?php echo e(route('admin.withdraw_payment_method.edit_input', $input->id)); ?>"
                            target="_blank">
                            <i class="fas fa-edit"></i>
                        </a>
                    </div>
                    <div class="col-md-1">
                        <button type="submit" class="btn btn-danger btn-sm">
                            <i class="fa fa-times"></i>
                        </button>
                    </div>
                </div>
            </div>
        </form>
    <?php elseif($input->type == 6): ?>
        <form class="ui-state-default" action="<?php echo e(route('admin.withdraw_payment_method.options_delete')); ?>" method="post"
            data-id="<?php echo e($input->id); ?>">
            <?php echo e(csrf_field()); ?>

            <input type="hidden" name="input_id" value="<?php echo e($input->id); ?>">
            <div class="form-group">
                <label for=""><?php echo e($input->label); ?> <?php if($input->required == 1): ?>
                        <span>**</span>
                    <?php elseif($input->required == 0): ?>
                        (<?php echo e(__('Optional')); ?>)
                    <?php endif; ?>
                </label>
                <div class="row">
                    <div class="col-md-10">
                        <input type="text" class="form-control timepicker" autocomplete="off"
                            placeholder="<?php echo e($input->placeholder); ?>">
                    </div>
                    <div class="col-md-1">
                        <a class="btn btn-warning btn-sm"
                            href="<?php echo e(route('admin.withdraw_payment_method.edit_input', $input->id)); ?>"
                            target="_blank">
                            <i class="fas fa-edit"></i>
                        </a>
                    </div>
                    <div class="col-md-1">
                        <button type="submit" class="btn btn-danger btn-sm">
                            <i class="fa fa-times"></i>
                        </button>
                    </div>
                </div>
            </div>
        </form>
    <?php endif; ?>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php /**PATH C:\Users\younes\Downloads\junspro-main (1)\junspro-main3\resources\views\backend\withdraw\form\created-inputs.blade.php ENDPATH**/ ?>