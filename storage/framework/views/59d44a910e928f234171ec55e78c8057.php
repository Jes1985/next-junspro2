<div data-onboarding-universe="<?php echo e($uSlug); ?>">
  <?php if (isset($component)) { $__componentOriginal4d1ccb2ed0d932403614e86a644d3fb6 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal4d1ccb2ed0d932403614e86a644d3fb6 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.services.filters.universal-filter','data' => ['universe' => $uSlug,'categories' => $uf['categories'] ?? [],'lessonGoals' => $uf['lessonGoals'] ?? [],'embedded' => true,'hierarchyMode' => (bool)($uf['hierarchyMode'] ?? true),'hideDomainSpecInAdvanced' => true,'disableExpertFilter' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('services.filters.universal-filter'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['universe' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($uSlug),'categories' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($uf['categories'] ?? []),'lesson-goals' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($uf['lessonGoals'] ?? []),'embedded' => true,'hierarchy-mode' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute((bool)($uf['hierarchyMode'] ?? true)),'hide-domain-spec-in-advanced' => true,'disable-expert-filter' => true]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal4d1ccb2ed0d932403614e86a644d3fb6)): ?>
<?php $attributes = $__attributesOriginal4d1ccb2ed0d932403614e86a644d3fb6; ?>
<?php unset($__attributesOriginal4d1ccb2ed0d932403614e86a644d3fb6); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal4d1ccb2ed0d932403614e86a644d3fb6)): ?>
<?php $component = $__componentOriginal4d1ccb2ed0d932403614e86a644d3fb6; ?>
<?php unset($__componentOriginal4d1ccb2ed0d932403614e86a644d3fb6); ?>
<?php endif; ?>
</div>
<?php /**PATH C:\Users\younes\Downloads\junspro-main (1)\junspro-main3\resources\views\frontend\freelance\onboarding\partials\matching\universal.blade.php ENDPATH**/ ?>