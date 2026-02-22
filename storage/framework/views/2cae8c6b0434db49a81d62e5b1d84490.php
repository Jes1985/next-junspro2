<div class="services-result-grid">
  <?php if(isset($results) && count($results) > 0): ?>
    <?php $__currentLoopData = $results; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $result): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <?php if (isset($component)) { $__componentOriginal6c5db73971dcb0bff4371680f1cd202d = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal6c5db73971dcb0bff4371680f1cd202d = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.services.service-card','data' => ['title' => $result['title'] ?? 'Service','description' => $result['description'] ?? null,'badges' => $result['badges'] ?? ($result['badge'] ?? null),'price' => $result['price'] ?? null,'image' => $result['image'] ?? null,'cta' => $result['cta'] ?? null]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('services.service-card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($result['title'] ?? 'Service'),'description' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($result['description'] ?? null),'badges' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($result['badges'] ?? ($result['badge'] ?? null)),'price' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($result['price'] ?? null),'image' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($result['image'] ?? null),'cta' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($result['cta'] ?? null)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal6c5db73971dcb0bff4371680f1cd202d)): ?>
<?php $attributes = $__attributesOriginal6c5db73971dcb0bff4371680f1cd202d; ?>
<?php unset($__attributesOriginal6c5db73971dcb0bff4371680f1cd202d); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal6c5db73971dcb0bff4371680f1cd202d)): ?>
<?php $component = $__componentOriginal6c5db73971dcb0bff4371680f1cd202d; ?>
<?php unset($__componentOriginal6c5db73971dcb0bff4371680f1cd202d); ?>
<?php endif; ?>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
  <?php else: ?>
    
    <?php for($i = 1; $i <= 3; $i++): ?>
      <?php if (isset($component)) { $__componentOriginal6c5db73971dcb0bff4371680f1cd202d = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal6c5db73971dcb0bff4371680f1cd202d = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.services.service-card','data' => ['title' => 'Service exemple '.e($i).'','description' => 'Description du service exemple '.e($i).'','badges' => ['Démo'],'price' => 'Sur devis']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('services.service-card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Service exemple '.e($i).'','description' => 'Description du service exemple '.e($i).'','badges' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(['Démo']),'price' => 'Sur devis']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal6c5db73971dcb0bff4371680f1cd202d)): ?>
<?php $attributes = $__attributesOriginal6c5db73971dcb0bff4371680f1cd202d; ?>
<?php unset($__attributesOriginal6c5db73971dcb0bff4371680f1cd202d); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal6c5db73971dcb0bff4371680f1cd202d)): ?>
<?php $component = $__componentOriginal6c5db73971dcb0bff4371680f1cd202d; ?>
<?php unset($__componentOriginal6c5db73971dcb0bff4371680f1cd202d); ?>
<?php endif; ?>
    <?php endfor; ?>
  <?php endif; ?>
</div>

<?php /**PATH C:\Users\younes\Downloads\junspro-main (1)\junspro-main3\resources\views\components\services\result-grid.blade.php ENDPATH**/ ?>