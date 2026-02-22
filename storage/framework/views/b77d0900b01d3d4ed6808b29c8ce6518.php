<?php $__env->startSection('style'); ?>
  <link rel="stylesheet" href="<?php echo e(asset('assets/front/css/services-pages.css')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
  <div class="services-page-wrapper">
    <!-- Hero Section -->
    <?php if (isset($component)) { $__componentOriginalb39ae5b5f84ff9a368cd5d0328502dda = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalb39ae5b5f84ff9a368cd5d0328502dda = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.services.hero','data' => ['title' => $title,'subtitle' => $subtitle ?? null,'micro' => $micro ?? null,'cta' => $cta ?? null]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('services.hero'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($title),'subtitle' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($subtitle ?? null),'micro' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($micro ?? null),'cta' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($cta ?? null)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalb39ae5b5f84ff9a368cd5d0328502dda)): ?>
<?php $attributes = $__attributesOriginalb39ae5b5f84ff9a368cd5d0328502dda; ?>
<?php unset($__attributesOriginalb39ae5b5f84ff9a368cd5d0328502dda); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalb39ae5b5f84ff9a368cd5d0328502dda)): ?>
<?php $component = $__componentOriginalb39ae5b5f84ff9a368cd5d0328502dda; ?>
<?php unset($__componentOriginalb39ae5b5f84ff9a368cd5d0328502dda); ?>
<?php endif; ?>

    <div class="container">
      <!-- Breadcrumb Navigation -->
      <div class="services-category-breadcrumb">
        <a href="<?php echo e(route('services')); ?>" class="services-breadcrumb-link">Services</a>
        <span class="services-breadcrumb-separator">/</span>
        <a href="<?php echo e($universeInfo['url']); ?>" class="services-breadcrumb-link"><?php echo e($universeInfo['title']); ?></a>
        <span class="services-breadcrumb-separator">/</span>
        <span class="services-breadcrumb-current"><?php echo e($categoryName); ?></span>
      </div>

      <!-- Category Slider -->
      <section class="services-page-categories">
        <?php if (isset($component)) { $__componentOriginal05f1cfb32d0add844fc7509e4e226305 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal05f1cfb32d0add844fc7509e4e226305 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.services.category-slider','data' => ['categories' => $categories]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('services.category-slider'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['categories' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($categories)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal05f1cfb32d0add844fc7509e4e226305)): ?>
<?php $attributes = $__attributesOriginal05f1cfb32d0add844fc7509e4e226305; ?>
<?php unset($__attributesOriginal05f1cfb32d0add844fc7509e4e226305); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal05f1cfb32d0add844fc7509e4e226305)): ?>
<?php $component = $__componentOriginal05f1cfb32d0add844fc7509e4e226305; ?>
<?php unset($__componentOriginal05f1cfb32d0add844fc7509e4e226305); ?>
<?php endif; ?>
      </section>

      <!-- Results Section -->
      <section id="results" class="services-page-results">
        <h2 class="services-results-title">Services <?php echo e($categoryName); ?></h2>
        <p class="services-results-subtitle">Découvrez nos prestations <?php echo e(strtolower($categoryName)); ?> de qualité</p>
        
        <?php if (isset($component)) { $__componentOriginal1b6842c71cab7d160cd894078b18f280 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal1b6842c71cab7d160cd894078b18f280 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.services.result-grid','data' => ['results' => $results]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('services.result-grid'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['results' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($results)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal1b6842c71cab7d160cd894078b18f280)): ?>
<?php $attributes = $__attributesOriginal1b6842c71cab7d160cd894078b18f280; ?>
<?php unset($__attributesOriginal1b6842c71cab7d160cd894078b18f280); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal1b6842c71cab7d160cd894078b18f280)): ?>
<?php $component = $__componentOriginal1b6842c71cab7d160cd894078b18f280; ?>
<?php unset($__componentOriginal1b6842c71cab7d160cd894078b18f280); ?>
<?php endif; ?>
      </section>
    </div>
  </div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('frontend.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\younes\Downloads\junspro-main (1)\junspro-main3\resources\views\services\category.blade.php ENDPATH**/ ?>