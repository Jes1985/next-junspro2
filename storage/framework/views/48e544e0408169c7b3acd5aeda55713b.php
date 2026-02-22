<div class="services-pricing-card">
  <h3 class="services-pricing-card__title"><?php echo e($title); ?></h3>
  <?php if(isset($subtext)): ?>
    <p class="services-pricing-card__subtext"><?php echo e($subtext); ?></p>
  <?php endif; ?>
  <?php if(isset($cta)): ?>
    <a href="<?php echo e($cta['url']); ?>" class="services-pricing-card__cta"><?php echo e($cta['text']); ?></a>
  <?php endif; ?>
</div>

<?php /**PATH C:\Users\younes\Downloads\junspro-main (1)\junspro-main3\resources\views\components\services\pricing-card.blade.php ENDPATH**/ ?>