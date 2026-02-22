<!-- Root component pour le flow de changement de formule -->
<div 
  x-data="changePlanFlow()"
  x-show="isOpen"
  x-cloak
  @keydown.escape.window="close()"
  class="change-plan-flow-root"
  style="display: none;"
>
  <!-- Inclure toutes les modals -->
  <?php if (isset($component)) { $__componentOriginald1ec4775d8da7a89073e11beba031193 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald1ec4775d8da7a89073e11beba031193 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.subscription.change-plan-entry','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('subscription.change-plan-entry'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginald1ec4775d8da7a89073e11beba031193)): ?>
<?php $attributes = $__attributesOriginald1ec4775d8da7a89073e11beba031193; ?>
<?php unset($__attributesOriginald1ec4775d8da7a89073e11beba031193); ?>
<?php endif; ?>
<?php if (isset($__componentOriginald1ec4775d8da7a89073e11beba031193)): ?>
<?php $component = $__componentOriginald1ec4775d8da7a89073e11beba031193; ?>
<?php unset($__componentOriginald1ec4775d8da7a89073e11beba031193); ?>
<?php endif; ?>
  <?php if (isset($component)) { $__componentOriginalb3f9c3b1a1e79b1cc7a2e80a4186860d = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalb3f9c3b1a1e79b1cc7a2e80a4186860d = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.subscription.change-plan-upgrade-builder','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('subscription.change-plan-upgrade-builder'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalb3f9c3b1a1e79b1cc7a2e80a4186860d)): ?>
<?php $attributes = $__attributesOriginalb3f9c3b1a1e79b1cc7a2e80a4186860d; ?>
<?php unset($__attributesOriginalb3f9c3b1a1e79b1cc7a2e80a4186860d); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalb3f9c3b1a1e79b1cc7a2e80a4186860d)): ?>
<?php $component = $__componentOriginalb3f9c3b1a1e79b1cc7a2e80a4186860d; ?>
<?php unset($__componentOriginalb3f9c3b1a1e79b1cc7a2e80a4186860d); ?>
<?php endif; ?>
  <?php if (isset($component)) { $__componentOriginald97c98e7cd3e63b62462251a62056961 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald97c98e7cd3e63b62462251a62056961 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.subscription.change-plan-upgrade-review','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('subscription.change-plan-upgrade-review'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginald97c98e7cd3e63b62462251a62056961)): ?>
<?php $attributes = $__attributesOriginald97c98e7cd3e63b62462251a62056961; ?>
<?php unset($__attributesOriginald97c98e7cd3e63b62462251a62056961); ?>
<?php endif; ?>
<?php if (isset($__componentOriginald97c98e7cd3e63b62462251a62056961)): ?>
<?php $component = $__componentOriginald97c98e7cd3e63b62462251a62056961; ?>
<?php unset($__componentOriginald97c98e7cd3e63b62462251a62056961); ?>
<?php endif; ?>
  <?php if (isset($component)) { $__componentOriginal33840df9ef04345b0b7f1fd10ecb9050 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal33840df9ef04345b0b7f1fd10ecb9050 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.subscription.change-plan-payment','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('subscription.change-plan-payment'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal33840df9ef04345b0b7f1fd10ecb9050)): ?>
<?php $attributes = $__attributesOriginal33840df9ef04345b0b7f1fd10ecb9050; ?>
<?php unset($__attributesOriginal33840df9ef04345b0b7f1fd10ecb9050); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal33840df9ef04345b0b7f1fd10ecb9050)): ?>
<?php $component = $__componentOriginal33840df9ef04345b0b7f1fd10ecb9050; ?>
<?php unset($__componentOriginal33840df9ef04345b0b7f1fd10ecb9050); ?>
<?php endif; ?>
  <?php if (isset($component)) { $__componentOriginalc0e11910cf9ac11b5f72a9e7a1b1bb11 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc0e11910cf9ac11b5f72a9e7a1b1bb11 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.subscription.change-plan-downgrade-picker','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('subscription.change-plan-downgrade-picker'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalc0e11910cf9ac11b5f72a9e7a1b1bb11)): ?>
<?php $attributes = $__attributesOriginalc0e11910cf9ac11b5f72a9e7a1b1bb11; ?>
<?php unset($__attributesOriginalc0e11910cf9ac11b5f72a9e7a1b1bb11); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc0e11910cf9ac11b5f72a9e7a1b1bb11)): ?>
<?php $component = $__componentOriginalc0e11910cf9ac11b5f72a9e7a1b1bb11; ?>
<?php unset($__componentOriginalc0e11910cf9ac11b5f72a9e7a1b1bb11); ?>
<?php endif; ?>
  <?php if (isset($component)) { $__componentOriginaled5dc47ba9d6b751adef1e65aec910f2 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginaled5dc47ba9d6b751adef1e65aec910f2 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.subscription.change-plan-downgrade-confirm','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('subscription.change-plan-downgrade-confirm'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginaled5dc47ba9d6b751adef1e65aec910f2)): ?>
<?php $attributes = $__attributesOriginaled5dc47ba9d6b751adef1e65aec910f2; ?>
<?php unset($__attributesOriginaled5dc47ba9d6b751adef1e65aec910f2); ?>
<?php endif; ?>
<?php if (isset($__componentOriginaled5dc47ba9d6b751adef1e65aec910f2)): ?>
<?php $component = $__componentOriginaled5dc47ba9d6b751adef1e65aec910f2; ?>
<?php unset($__componentOriginaled5dc47ba9d6b751adef1e65aec910f2); ?>
<?php endif; ?>
</div>

<?php /**PATH C:\Users\younes\Downloads\junspro-main (1)\junspro-main3\resources\views\components\subscription\change-plan-root.blade.php ENDPATH**/ ?>