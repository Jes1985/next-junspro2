<div class="card">
  <div class="card-header">
    <div class="card-title"><?php echo e(__('Create Input')); ?></div>
  </div>

  <form id="ajaxForm" action="<?php echo e(route('admin.withdraw_payment_method.store_input')); ?>" method="post"
    enctype="multipart/form-data">
    <?php echo e(csrf_field()); ?>

    <input type="hidden" name="withdraw_payment_method_id" value="<?php echo e(request()->input('id')); ?>">
    <div class="form-group">
      <label for=""><strong><?php echo e(__('Field Type')); ?></strong></label>
      <div class="">
        <div class="form-check form-check-inline">
          <input name="type" class="form-check-input" type="radio" id="inlineRadio1" value="1" v-model="type"
            @change="typeChange()">
          <label class="form-check-label" for="inlineRadio1"><?php echo e(__('Text Field')); ?></label>
        </div>
        <div class="form-check form-check-inline">
          <input name="type" class="form-check-input" type="radio" id="inlineRadio7" value="7" v-model="type"
            @change="typeChange()">
          <label class="form-check-label" for="inlineRadio7"><?php echo e(__('Number Field')); ?></label>
        </div>
        <div class="form-check form-check-inline">
          <input name="type" class="form-check-input" type="radio" id="inlineRadio2" value="2" v-model="type"
            @change="typeChange()">
          <label class="form-check-label" for="inlineRadio2"><?php echo e(__('Select')); ?></label>
        </div>
        <div class="form-check form-check-inline">
          <input name="type" class="form-check-input" type="radio" id="inlineRadio3" value="3" v-model="type"
            @change="typeChange()">
          <label class="form-check-label" for="inlineRadio3"><?php echo e(__('Checkbox')); ?></label>
        </div>
        <div class="form-check form-check-inline">
          <input name="type" class="form-check-input" type="radio" id="inlineRadio4" value="4" v-model="type"
            @change="typeChange()">
          <label class="form-check-label" for="inlineRadio4"><?php echo e(__('Textarea')); ?></label>
        </div>
        <div class="form-check form-check-inline">
          <input name="type" class="form-check-input" type="radio" id="inlineRadio5" value="5" v-model="type"
            @change="typeChange()">
          <label class="form-check-label" for="inlineRadio5"><?php echo e(__('Datepicker')); ?></label>
        </div>
        <div class="form-check form-check-inline">
          <input name="type" class="form-check-input" type="radio" id="inlineRadio6" value="6" v-model="type"
            @change="typeChange()">
          <label class="form-check-label" for="inlineRadio6"><?php echo e(__('Timepicker')); ?></label>
        </div>
      </div>
      <p id="errtype" class="mb-0 text-danger em"></p>
    </div>

    <div class="form-group">
      <label>Required</label>
      <div class="selectgroup w-100">
        <label class="selectgroup-item">
          <input type="radio" name="required" value="1" class="selectgroup-input" checked>
          <span class="selectgroup-button"><?php echo e(__('Yes')); ?></span>
        </label>
        <label class="selectgroup-item">
          <input type="radio" name="required" value="0" class="selectgroup-input">
          <span class="selectgroup-button"><?php echo e(__('No')); ?></span>
        </label>
      </div>
      <p id="err_required" class="mb-0 text-danger em"></p>
    </div>

    <div class="form-group">
      <label for=""><strong><?php echo e(__('Label Name')); ?></strong></label>
      <div class="">
        <input type="text" class="form-control" name="label" value="" placeholder="Enter Label Name">
      </div>
      <p id="err_label" class="mb-0 text-danger em"></p>
    </div>

    <div class="form-group" v-if="placeholdershow">
      <label for=""><strong><?php echo e(__('Placeholder')); ?></strong></label>
      <div class="">
        <input type="text" class="form-control" name="placeholder" value=""
          placeholder="Enter Placeholder">
      </div>
      <p id="err_placeholder" class="mb-0 text-danger em"></p>
    </div>


    <div class="form-group" v-if="counter > 0" id="optionarea">
      <label for=""><strong><?php echo e(__('Options')); ?></strong></label>
      <div class="row mb-2 counterrow" v-for="n in counter" :id="'counterrow' + n">
        <div class="col-md-10">
          <input type="text" class="form-control" name="options[]" value="" placeholder="Option label">
        </div>

        <div class="col-md-1">
          <button type="button" class="btn btn-danger btn-md text-white btn-sm" @click="removeOption(n)"><i
              class="fa fa-times"></i></button>
        </div>
      </div>
      <p id="err_options.0" class="mb-2 text-danger em"></p>
      <button type="button" class="btn btn-success btn-sm text-white" @click="addOption()"><i
          class="fa fa-plus"></i> <?php echo e(__('Add Option')); ?></button>
    </div>


    <div class="form-group text-center">
      <button id="submitBtn" type="submit" class="btn btn-primary btn-sm"><?php echo e(__('ADD FIELD')); ?></button>
    </div>
  </form>

</div>
<?php /**PATH C:\Users\younes\Downloads\junspro-main (1)\junspro-main3\resources\views\backend\withdraw\form\create-input.blade.php ENDPATH**/ ?>