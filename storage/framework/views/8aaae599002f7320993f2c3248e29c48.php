<?php
  // Chercher une image hero pour cette page
  $heroImagePath = null;
  $heroImageExists = false;
  
  // Déterminer le nom de l'image selon la page
  $imageName = 'services-hero';
  if (isset($imageNameOverride)) {
    $imageName = $imageNameOverride;
  } elseif (isset($title)) {
    // Générer un nom basé sur le titre
    $imageName = 'services-' . strtolower(str_replace([' ', 'é', 'è', 'ê', 'à', 'ô'], ['-', 'e', 'e', 'e', 'a', 'o'], $title));
    $imageName = preg_replace('/[^a-z0-9-]/', '', $imageName);
  }
  
  // Emplacements possibles pour l'image hero
  $possiblePaths = [
    public_path("images/{$imageName}.png"),
    public_path("images/{$imageName}.jpg"),
    public_path("images/{$imageName}.jpeg"),
    public_path("images/{$imageName}.webp"),
    public_path("assets/img/{$imageName}.png"),
    public_path("assets/img/{$imageName}.jpg"),
    public_path("assets/img/{$imageName}.jpeg"),
    public_path("assets/img/{$imageName}.webp"),
  ];
  
  foreach ($possiblePaths as $path) {
    if (file_exists($path)) {
      $heroImageExists = true;
      $relativePath = str_replace(public_path(), '', $path);
      $heroImagePath = str_replace('\\', '/', $relativePath);
      if (!str_starts_with($heroImagePath, '/')) {
        $heroImagePath = '/' . $heroImagePath;
      }
      break;
    }
  }
  
  // Si une image est fournie directement, l'utiliser en priorité
  if (isset($image) && $image) {
    $heroImagePath = $image;
    $heroImageExists = true;
  }
?>

<div class="services-hero">
  <div class="services-hero__image-wrapper">
    <?php if($heroImageExists && $heroImagePath): ?>
      <img src="<?php echo e($heroImagePath); ?>" alt="<?php echo e($title ?? ''); ?>" class="services-hero__image">
    <?php else: ?>
      <div class="services-hero__placeholder"></div>
    <?php endif; ?>
  </div>
  <div class="services-hero__content">
    <h1 class="services-hero__title"><?php echo e($title); ?></h1>
    <?php if(isset($subtitle)): ?>
      <h2 class="services-hero__subtitle"><?php echo e($subtitle); ?></h2>
    <?php endif; ?>
    <?php if(isset($micro)): ?>
      <p class="services-hero__micro"><?php echo e($micro); ?></p>
    <?php endif; ?>
    <?php if(isset($cta)): ?>
      <div class="services-hero__cta">
        <?php if(is_array($cta) && isset($cta[0])): ?>
          
          <?php $__currentLoopData = $cta; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $button): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php if(is_array($button)): ?>
              <a href="<?php echo e($button['url'] ?? '#'); ?>" class="services-hero__btn services-hero__btn--<?php echo e($button['variant'] ?? 'primary'); ?>">
                <?php echo e($button['text'] ?? 'Voir plus'); ?>

              </a>
            <?php endif; ?>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php elseif(is_array($cta) && isset($cta['url'])): ?>
          
          <a href="<?php echo e($cta['url']); ?>" class="services-hero__btn services-hero__btn--primary">
            <?php echo e($cta['text'] ?? 'Voir plus'); ?>

          </a>
        <?php endif; ?>
      </div>
    <?php endif; ?>
    <?php if(isset($searchPlaceholder)): ?>
      <div class="services-hero__search">
        <form action="<?php echo e(route('services.projects')); ?>" method="GET" class="services-hero__search-form">
          <input type="text" name="q" placeholder="<?php echo e($searchPlaceholder); ?>" class="services-hero__search-input">
          <button type="submit" class="services-hero__search-btn">
            <i class="far fa-search"></i>
          </button>
        </form>
      </div>
    <?php endif; ?>
  </div>
</div>

<?php /**PATH C:\Users\younes\Downloads\junspro-main (1)\junspro-main3\resources\views\components\services\hero.blade.php ENDPATH**/ ?>