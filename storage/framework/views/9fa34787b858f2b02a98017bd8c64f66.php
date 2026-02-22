<?php
  // Déterminer l'univers depuis la route actuelle ou les paramètres
  $universe = 'at-home'; // Par défaut
  
  if (request()->route()->hasParameter('universe')) {
    $universe = request()->route('universe');
  } else {
    $currentRoute = request()->route()->getName();
    if (strpos($currentRoute, 'services.projects') !== false) {
      $universe = 'projects';
    } elseif (strpos($currentRoute, 'services.lessons') !== false) {
      $universe = 'lessons';
    } elseif (strpos($currentRoute, 'services.at-home') !== false) {
      $universe = 'at-home';
    } elseif (strpos($currentRoute, 'services.wellnesslive') !== false) {
      $universe = 'wellnesslive';
    } elseif (strpos($currentRoute, 'services.corporate') !== false) {
      $universe = 'corporate';
    } elseif (strpos($currentRoute, 'services.homeswap') !== false) {
      $universe = 'homeswap';
    }
  }
  
  // Récupérer la catégorie actuelle si on est sur une page de catégorie
  $currentCategory = null;
  if (request()->route()->hasParameter('category')) {
    $currentCategory = request()->route('category');
  }
?>

<div class="services-category-slider">
  <div class="services-category-slider__container">
    <?php if(isset($categories) && is_array($categories)): ?>
      <?php
        // Détecter si c'est un tableau associatif (catégories groupées)
        $isGrouped = false;
        if (count($categories) > 0) {
          $firstKey = array_key_first($categories);
          $isGrouped = is_string($firstKey) && is_array($categories[$firstKey]);
        }
      ?>
      
      <?php if($isGrouped): ?>
        
        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $groupName => $groupCategories): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <?php if(is_array($groupCategories)): ?>
            <div class="services-category-group">
              <span class="services-category-group__label"><?php echo e($groupName); ?></span>
              <?php $__currentLoopData = $groupCategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if(is_string($category)): ?>
                  <?php
                    $categorySlug = strtolower(str_replace([' ', '&'], ['-', ''], $category));
                    $categoryUrl = route('services.category', ['universe' => $universe, 'category' => $categorySlug]);
                    $isActive = $currentCategory === $categorySlug;
                  ?>
                  <a href="<?php echo e($categoryUrl); ?>" class="services-category-chip <?php echo e($isActive ? 'active' : ''); ?>" data-category="<?php echo e($category); ?>">
                    <?php echo e($category); ?>

                  </a>
                <?php endif; ?>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
          <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      <?php else: ?>
        
        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <?php if(is_string($category)): ?>
            <?php
              // Générer le slug de la catégorie pour l'URL
              $categorySlug = strtolower(str_replace([' ', '&'], ['-', ''], $category));
              $categoryUrl = route('services.category', ['universe' => $universe, 'category' => $categorySlug]);
              $isActive = $currentCategory === $categorySlug;
            ?>
            <a href="<?php echo e($categoryUrl); ?>" class="services-category-chip <?php echo e($isActive ? 'active' : ''); ?>" data-category="<?php echo e($category); ?>">
              <?php echo e($category); ?>

            </a>
          <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      <?php endif; ?>
    <?php endif; ?>
  </div>
</div>

<?php /**PATH C:\Users\younes\Downloads\junspro-main (1)\junspro-main3\resources\views\components\services\category-slider.blade.php ENDPATH**/ ?>