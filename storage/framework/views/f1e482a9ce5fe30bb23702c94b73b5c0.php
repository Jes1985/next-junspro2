<div class="services-universe-conversation">
  <?php $__currentLoopData = $universes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $universe): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div class="services-universe-bubble" data-index="<?php echo e($index); ?>">
      <div class="services-universe-bubble__tail"></div>
      <div class="services-universe-bubble__content">
        <div class="services-universe-bubble__header">
          <h3 class="services-universe-bubble__title"><?php echo e($universe['title']); ?></h3>
          <div class="services-universe-bubble__emoji-wrapper">
            <span class="services-universe-bubble__emoji">
              <?php if($index == 0): ?>💡
              <?php elseif($index == 1): ?>🎓
              <?php elseif($index == 2): ?>🏠
              <?php elseif($index == 3): ?>🏃
              <?php elseif($index == 4): ?>🛋️
              <?php elseif($index == 5): ?>🌍
              <?php else: ?>💬
              <?php endif; ?>
            </span>
          </div>
        </div>
        <p class="services-universe-bubble__baseline"><?php echo e($universe['baseline']); ?></p>
        <p class="services-universe-bubble__text"><?php echo e($universe['text']); ?></p>
        <a href="<?php echo e($universe['url']); ?>" class="services-universe-bubble__cta">
          <?php echo e($universe['cta']); ?>

          <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M6 12L10 8L6 4" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
          </svg>
        </a>
      </div>
    </div>
  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>

<?php /**PATH C:\Users\younes\Downloads\junspro-main (1)\junspro-main3\resources\views\components\services\universe-grid.blade.php ENDPATH**/ ?>