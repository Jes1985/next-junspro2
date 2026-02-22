<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
  'title' => '',
  'updatedAt' => '13/02/2026',
  'toc' => [],
  'prefix' => 'legal',
]));

foreach ($attributes->all() as $__key => $__value) {
    if (in_array($__key, $__propNames)) {
        $$__key = $$__key ?? $__value;
    } else {
        $__newAttributes[$__key] = $__value;
    }
}

$attributes = new \Illuminate\View\ComponentAttributeBag($__newAttributes);

unset($__propNames);
unset($__newAttributes);

foreach (array_filter(([
  'title' => '',
  'updatedAt' => '13/02/2026',
  'toc' => [],
  'prefix' => 'legal',
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>
<?php
  $btnId = $prefix . '-sommaire-btn';
  $dropdownId = $prefix . '-sommaire-dropdown';
  $backToTopId = $prefix . '-back-to-top';
?>
<div class="legal-page-wrapper">
  <div class="terms-page-inner">
    <aside class="terms-sommaire-sidebar">
      <div class="terms-sommaire-title"><?php echo e(__('Sommaire')); ?></div>
      <ul class="terms-sommaire-list">
        <?php $__currentLoopData = $toc; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <li><a href="<?php echo e($item['href']); ?>"><?php echo e($item['label']); ?></a></li>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </ul>
    </aside>

    <main class="terms-page-main">
      <div class="legal-page-header">
        <h1 class="legal-page-title"><?php echo e($title); ?></h1>
        <p class="legal-page-subtitle">
          <?php echo e(__('Document officiel')); ?> • <?php echo e(__('Dernière mise à jour')); ?> : <?php echo e($updatedAt); ?>

        </p>
      </div>

      <div class="terms-sommaire-mobile">
        <button type="button" class="terms-sommaire-toggle" aria-expanded="false" aria-controls="<?php echo e($dropdownId); ?>" id="<?php echo e($btnId); ?>">
          <?php echo e(__('Sommaire')); ?>

          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M6 9l6 6 6-6"/></svg>
        </button>
        <div class="terms-sommaire-dropdown" id="<?php echo e($dropdownId); ?>" hidden>
          <?php $__currentLoopData = $toc; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <a href="<?php echo e($item['href']); ?>"><?php echo e($item['label']); ?></a>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
      </div>

      <div class="legal-page-content summernote-content">
        <div class="terms-doc-body">
          <?php echo e($slot); ?>

        </div>
      </div>

      <div class="legal-page-footer">
        <a href="<?php echo e(route('index')); ?>" class="legal-page-back-link">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M19 12H5M12 19l-7-7 7-7"/>
          </svg>
          <?php echo e(__('Retour à l\'accueil')); ?>

        </a>
        <a href="#" class="terms-back-to-top" id="<?php echo e($backToTopId); ?>"><?php echo e(__('Retour en haut')); ?></a>
      </div>
    </main>
  </div>
</div>

<script>
(function() {
  var prefix = '<?php echo e($prefix); ?>';
  var btn = document.getElementById(prefix + '-sommaire-btn');
  var dropdown = document.getElementById(prefix + '-sommaire-dropdown');
  if (btn && dropdown) {
    btn.addEventListener('click', function(e) {
      e.stopPropagation();
      var expanded = btn.getAttribute('aria-expanded') === 'true';
      btn.setAttribute('aria-expanded', !expanded);
      dropdown.hidden = expanded;
    });
    document.addEventListener('click', function(e) {
      if (!btn.contains(e.target) && !dropdown.contains(e.target)) {
        btn.setAttribute('aria-expanded', 'false');
        dropdown.hidden = true;
      }
    });
    var links = dropdown.querySelectorAll('a');
    for (var i = 0; i < links.length; i++) {
      links[i].addEventListener('click', function() {
        btn.setAttribute('aria-expanded', 'false');
        dropdown.hidden = true;
      });
    }
  }
  var backToTop = document.getElementById(prefix + '-back-to-top');
  if (backToTop) {
    backToTop.addEventListener('click', function(e) {
      e.preventDefault();
      window.scrollTo({ top: 0, behavior: 'smooth' });
    });
  }
})();
</script>
<?php /**PATH C:\Users\younes\Downloads\junspro-main (1)\junspro-main3\resources\views\components\legal-document-layout.blade.php ENDPATH**/ ?>