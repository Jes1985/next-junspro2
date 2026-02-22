<?php
  $misc = new App\Http\Controllers\FrontEnd\MiscellaneousController();
  $language = $misc->getLanguage();
  $pageHeading = $language->pageName()->select('error_page_title')->first();
?>

<?php $__env->startSection('pageHeading'); ?>
  <?php if(!empty($pageHeading)): ?>
    <?php echo e($pageHeading->error_page_title); ?>

  <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('style'); ?>
<style>
  /* ============================================
     PAGE 404 - DESIGN PREMIUM HAUT DE GAMME
     ============================================ */
  
  .error-page-wrapper {
    background: linear-gradient(
      180deg,
      #D8DBFF 0%,
      #D5D8FF 15%,
      #D2D5FF 30%,
      #CFD2FF 45%,
      #CCCEFF 60%,
      #C9CBFF 75%,
      #C6C8FF 90%,
      #C3C5FF 100%
    );
    min-height: 100vh;
    padding-top: 120px;
    padding-bottom: 80px;
    position: relative;
    overflow: hidden;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
    text-rendering: optimizeLegibility;
  }

  /* Halo lumineux subtil */
  .error-page-wrapper::before {
    content: "";
    position: absolute;
    top: 0;
    left: 50%;
    transform: translateX(-50%);
    width: 100%;
    max-width: 1400px;
    height: 500px;
    background: radial-gradient(
      ellipse 100% 60% at 50% 0%,
      rgba(124, 58, 237, 0.15) 0%,
      rgba(124, 58, 237, 0.08) 30%,
      rgba(79, 70, 229, 0.04) 60%,
      transparent 100%
    );
    pointer-events: none;
    z-index: 0;
    filter: blur(50px);
    -webkit-filter: blur(50px);
  }

  .error-page-wrapper > * {
    position: relative;
    z-index: 1;
  }

  /* Container principal */
  .error-page-container {
    max-width: 800px;
    margin: 0 auto;
    padding: 0 24px;
    text-align: center;
  }

  /* Illustration 404 premium */
  .error-illustration {
    margin-bottom: 48px;
    position: relative;
  }

  .error-number {
    font-size: 180px;
    font-weight: 800;
    background: linear-gradient(135deg, #6366F1 0%, #7C3AED 50%, #8B5CF6 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    line-height: 1;
    margin-bottom: 24px;
    letter-spacing: -0.05em;
    text-rendering: optimizeLegibility;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
    position: relative;
    display: inline-block;
  }

  .error-number::after {
    content: "";
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 120%;
    height: 120%;
    background: radial-gradient(
      circle at center,
      rgba(124, 58, 237, 0.1) 0%,
      transparent 70%
    );
    z-index: -1;
    filter: blur(40px);
  }

  /* Texte d'erreur */
  .error-text-content {
    margin-bottom: 48px;
  }

  .error-title {
    font-size: 36px;
    font-weight: 700;
    color: #111827;
    margin-bottom: 16px;
    line-height: 1.3;
    letter-spacing: -0.02em;
  }

  .error-description {
    font-size: 18px;
    color: #4B5563;
    line-height: 1.7;
    max-width: 600px;
    margin: 0 auto 32px;
  }

  /* Bouton retour premium */
  .error-action {
    margin-top: 48px;
  }

  .error-btn-home {
    display: inline-flex;
    align-items: center;
    gap: 12px;
    padding: 16px 32px;
    font-size: 16px;
    font-weight: 600;
    color: #FFFFFF;
    background: linear-gradient(135deg, #6366F1 0%, #7C3AED 100%);
    border: none;
    border-radius: 12px;
    text-decoration: none;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    box-shadow: 
      0 8px 24px rgba(99, 102, 241, 0.3),
      0 4px 8px rgba(99, 102, 241, 0.2);
    position: relative;
    overflow: hidden;
  }

  .error-btn-home::before {
    content: "";
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
    transition: left 0.5s ease;
  }

  .error-btn-home:hover::before {
    left: 100%;
  }

  .error-btn-home:hover {
    transform: translateY(-2px);
    box-shadow: 
      0 12px 32px rgba(99, 102, 241, 0.4),
      0 6px 12px rgba(99, 102, 241, 0.3);
  }

  .error-btn-home:active {
    transform: translateY(0);
  }

  .error-btn-icon {
    width: 20px;
    height: 20px;
  }

  /* Responsive */
  @media (max-width: 768px) {
    .error-page-wrapper {
      padding-top: 100px;
      padding-bottom: 60px;
    }

    .error-number {
      font-size: 120px;
    }

    .error-title {
      font-size: 28px;
    }

    .error-description {
      font-size: 16px;
    }

    .error-btn-home {
      padding: 14px 28px;
      font-size: 15px;
    }
  }
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
  <div class="error-page-wrapper">
    <div class="error-page-container">
      <!-- Illustration 404 -->
      <div class="error-illustration">
        <div class="error-number">404</div>
      </div>

      <!-- Texte d'erreur -->
      <div class="error-text-content">
        <h1 class="error-title"><?php echo e(__('Vous êtes perdu')); ?></h1>
        <p class="error-description">
          <?php echo e(__('La page que vous recherchez')); ?>, <?php echo e(__('a peut-être été déplacée')); ?>,<br>
          <?php echo e(__('renommée')); ?> <?php echo e(__('ou n\'a peut-être jamais existé')); ?>.
        </p>
      </div>

      <!-- Action -->
      <div class="error-action">
        <a href="<?php echo e(route('index')); ?>" class="error-btn-home">
          <svg class="error-btn-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
            <polyline points="9 22 9 12 15 12 15 22"></polyline>
          </svg>
          <?php echo e(__('Retour à l\'accueil')); ?>

        </a>
      </div>
    </div>
  </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\younes\Downloads\junspro-main (1)\junspro-main3\resources\views\errors\404.blade.php ENDPATH**/ ?>