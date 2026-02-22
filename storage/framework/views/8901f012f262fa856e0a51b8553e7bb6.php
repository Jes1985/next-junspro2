<div class="services-service-card">
  <?php if(isset($image) && $image): ?>
    <div class="services-service-card__image-wrapper">
      <img src="<?php echo e($image); ?>" alt="<?php echo e($title); ?>" class="services-service-card__image">
    </div>
  <?php endif; ?>
  <div class="services-service-card__content">
    <h3 class="services-service-card__title"><?php echo e($title); ?></h3>
    <?php if(isset($description)): ?>
      <p class="services-service-card__description"><?php echo e($description); ?></p>
    <?php endif; ?>
    <?php if(isset($badges)): ?>
      <div class="services-service-card__badges">
        <?php if(is_array($badges)): ?>
          <?php $__currentLoopData = $badges; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $badge): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <span class="services-service-card__badge"><?php echo e($badge); ?></span>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php else: ?>
          <span class="services-service-card__badge"><?php echo e($badges); ?></span>
        <?php endif; ?>
      </div>
    <?php endif; ?>
    <?php if(isset($price)): ?>
      <div class="services-service-card__price"><?php echo e($price); ?></div>
    <?php endif; ?>
    <?php if(isset($cta)): ?>
      <a href="<?php echo e($cta['url'] ?? '#'); ?>" class="services-service-card__cta">
        <?php echo e($cta['text'] ?? 'Voir plus'); ?>

      </a>
    <?php endif; ?>
  </div>
</div>

<?php /**PATH C:\Users\younes\Downloads\junspro-main (1)\junspro-main3\resources\views\components\services\service-card.blade.php ENDPATH**/ ?>