<?php $__env->startSection('style'); ?>
<link rel="stylesheet" href="<?php echo e(asset('assets/css/summernote-content.css')); ?>">
<style>
  /* Suppression définitive de la barre de catégories sur les pages légales */
  .legal-page-wrapper .categories-menu,
  .legal-page-wrapper .categories-menu-nav,
  .legal-page-wrapper .categories,
  .legal-page-wrapper ul.categories,
  .legal-page-wrapper .category-menu,
  .legal-page-wrapper .category-nav {
    display: none !important;
    visibility: hidden !important;
    height: 0 !important;
    overflow: hidden !important;
    margin: 0 !important;
    padding: 0 !important;
    opacity: 0 !important;
    pointer-events: none !important;
  }
  /* ============================================
     PAGES LÉGALES - DESIGN PREMIUM HAUT DE GAMME
     ============================================ */
  
  /* Fond premium cohérent avec le site - Même palette que FAQ */
  /* VERSION TEST - Si vous voyez cette bordure violette, le CSS est chargé */
  .legal-page-wrapper {
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
    ) !important;
    border: 5px solid #7C3AED !important; /* TEST VISIBLE */
    min-height: 100vh !important;
    padding-top: 120px !important;
    padding-bottom: 80px !important;
    position: relative !important;
    overflow: hidden !important;
    -webkit-font-smoothing: antialiased !important;
    -moz-osx-font-smoothing: grayscale !important;
    text-rendering: optimizeLegibility !important;
  }

  /* Overlay foncé pour la zone du header (comme FAQ) */
  .legal-page-wrapper::after {
    content: "";
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    height: 120px;
    background: linear-gradient(
      180deg,
      rgba(124, 58, 237, 0.30) 0%,
      rgba(79, 70, 229, 0.20) 40%,
      rgba(124, 58, 237, 0.10) 80%,
      transparent 100%
    );
    pointer-events: none;
    z-index: 998;
  }

  /* Halo lumineux subtil en haut */
  .legal-page-wrapper::before {
    content: "";
    position: absolute;
    top: 0;
    left: 50%;
    transform: translateX(-50%);
    width: 100%;
    max-width: 1400px;
    height: 400px;
    background: radial-gradient(
      ellipse 100% 60% at 50% 0%,
      rgba(124, 58, 237, 0.12) 0%,
      rgba(124, 58, 237, 0.06) 30%,
      rgba(79, 70, 229, 0.03) 60%,
      transparent 100%
    );
    pointer-events: none;
    z-index: 0;
    filter: blur(40px);
    -webkit-filter: blur(40px);
  }

  .legal-page-wrapper > * {
    position: relative;
    z-index: 1;
  }

  /* Container principal */
  .legal-page-container {
    max-width: 900px;
    margin: 0 auto;
    padding: 0 24px;
  }

  /* En-tête premium */
  .legal-page-header {
    text-align: center;
    margin-bottom: 60px;
    padding-bottom: 40px;
    border-bottom: 1px solid rgba(124, 58, 237, 0.15);
  }

  .legal-page-title {
    font-size: 42px;
    font-weight: 700;
    color: #111827;
    margin-bottom: 16px;
    line-height: 1.2;
    letter-spacing: -0.02em;
    text-rendering: optimizeLegibility;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
  }

  .legal-page-subtitle {
    font-size: 18px;
    color: #4B5563;
    font-weight: 400;
    line-height: 1.6;
    max-width: 600px;
    margin: 0 auto;
  }

  /* Contenu premium - Style glassmorphism raffiné */
  .legal-page-content {
    background: rgba(255, 255, 255, 0.92);
    backdrop-filter: blur(20px);
    -webkit-backdrop-filter: blur(20px);
    border-radius: 24px;
    padding: 56px 64px;
    box-shadow: 
      0 24px 80px rgba(15, 23, 42, 0.12),
      0 8px 24px rgba(15, 23, 42, 0.08),
      0 0 0 1px rgba(124, 58, 237, 0.08),
      inset 0 1px 0 rgba(255, 255, 255, 0.6);
    margin-bottom: 40px;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
    position: relative;
    overflow: hidden;
  }

  /* Effet de lumière subtil sur le contenu */
  .legal-page-content::before {
    content: "";
    position: absolute;
    top: -50%;
    left: -50%;
    width: 200%;
    height: 200%;
    background: radial-gradient(
      circle at center,
      rgba(124, 58, 237, 0.03) 0%,
      transparent 70%
    );
    pointer-events: none;
    z-index: 0;
  }

  .legal-page-content > * {
    position: relative;
    z-index: 1;
  }

  /* Typographie premium pour le contenu */
  .legal-page-content :global(h1),
  .legal-page-content h1 {
    font-size: 32px;
    font-weight: 700;
    color: #111827;
    margin-top: 48px;
    margin-bottom: 24px;
    line-height: 1.3;
    letter-spacing: -0.01em;
  }

  .legal-page-content :global(h1:first-child),
  .legal-page-content h1:first-child {
    margin-top: 0;
  }

  .legal-page-content :global(h2),
  .legal-page-content h2 {
    font-size: 26px;
    font-weight: 600;
    color: #1F2937;
    margin-top: 40px;
    margin-bottom: 20px;
    line-height: 1.4;
  }

  .legal-page-content :global(h3),
  .legal-page-content h3 {
    font-size: 20px;
    font-weight: 600;
    color: #374151;
    margin-top: 32px;
    margin-bottom: 16px;
    line-height: 1.5;
  }

  .legal-page-content :global(h4),
  .legal-page-content h4 {
    font-size: 18px;
    font-weight: 600;
    color: #4B5563;
    margin-top: 28px;
    margin-bottom: 14px;
    line-height: 1.5;
  }

  .legal-page-content :global(p),
  .legal-page-content p {
    font-size: 16px;
    line-height: 1.8;
    color: #374151;
    margin-bottom: 20px;
    text-rendering: optimizeLegibility;
  }

  .legal-page-content :global(ul),
  .legal-page-content ul,
  .legal-page-content :global(ol),
  .legal-page-content ol {
    margin: 24px 0;
    padding-left: 28px;
  }

  .legal-page-content :global(li),
  .legal-page-content li {
    font-size: 16px;
    line-height: 1.8;
    color: #374151;
    margin-bottom: 12px;
  }

  .legal-page-content :global(strong),
  .legal-page-content strong {
    font-weight: 600;
    color: #111827;
  }

  .legal-page-content :global(a),
  .legal-page-content a {
    color: #6366F1;
    text-decoration: none;
    border-bottom: 1px solid rgba(99, 102, 241, 0.3);
    transition: all 0.2s ease;
  }

  .legal-page-content :global(a:hover),
  .legal-page-content a:hover {
    color: #4F46E5;
    border-bottom-color: #4F46E5;
  }

  .legal-page-content :global(blockquote),
  .legal-page-content blockquote {
    border-left: 4px solid #6366F1;
    padding-left: 24px;
    margin: 32px 0;
    font-style: italic;
    color: #4B5563;
    background: rgba(99, 102, 241, 0.03);
    padding: 20px 24px;
    border-radius: 8px;
  }

  .legal-page-content :global(table),
  .legal-page-content table {
    width: 100%;
    border-collapse: collapse;
    margin: 32px 0;
    background: white;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 4px 12px rgba(15, 23, 42, 0.05);
  }

  .legal-page-content :global(table th),
  .legal-page-content table th {
    background: linear-gradient(135deg, #4F46E5 0%, #6366F1 30%, #7C3AED 70%, #8B5CF6 100%);
    color: white;
    padding: 18px 24px;
    text-align: left;
    font-weight: 600;
    font-size: 14px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    box-shadow: 0 2px 8px rgba(79, 70, 229, 0.2);
  }

  .legal-page-content :global(table td),
  .legal-page-content table td {
    padding: 16px 20px;
    border-bottom: 1px solid rgba(226, 232, 240, 0.8);
    color: #374151;
  }

  .legal-page-content :global(table tr:last-child td),
  .legal-page-content table tr:last-child td {
    border-bottom: none;
  }

  /* Section de navigation retour */
  .legal-page-footer {
    text-align: center;
    margin-top: 60px;
    padding-top: 40px;
    border-top: 1px solid rgba(124, 58, 237, 0.15);
  }

  .legal-page-back-link {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    color: #FFFFFF;
    font-weight: 600;
    font-size: 16px;
    text-decoration: none;
    padding: 14px 28px;
    border-radius: 12px;
    background: linear-gradient(135deg, #6366F1 0%, #7C3AED 100%);
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    border: none;
    box-shadow: 
      0 8px 24px rgba(99, 102, 241, 0.3),
      0 4px 8px rgba(99, 102, 241, 0.2);
    position: relative;
    overflow: hidden;
  }

  .legal-page-back-link::before {
    content: "";
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
    transition: left 0.5s ease;
  }

  .legal-page-back-link:hover::before {
    left: 100%;
  }

  .legal-page-back-link:hover {
    transform: translateY(-2px);
    box-shadow: 
      0 12px 32px rgba(99, 102, 241, 0.4),
      0 6px 12px rgba(99, 102, 241, 0.3);
  }

  .legal-page-back-link:active {
    transform: translateY(0);
  }

  /* Responsive */
  @media (max-width: 768px) {
    .legal-page-wrapper {
      padding-top: 100px;
      padding-bottom: 60px;
    }

    .legal-page-container {
      padding: 0 20px;
    }

    .legal-page-title {
      font-size: 32px;
    }

    .legal-page-subtitle {
      font-size: 16px;
    }

    .legal-page-content {
      padding: 32px 24px;
      border-radius: 20px;
    }

    .legal-page-content :global(h1),
    .legal-page-content h1 {
      font-size: 28px;
    }

    .legal-page-content :global(h2),
    .legal-page-content h2 {
      font-size: 22px;
    }

    .legal-page-content :global(h3),
    .legal-page-content h3 {
      font-size: 18px;
    }
  }
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('pageHeading'); ?>
    <?php echo e($pageInfo->title); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('metaKeywords'); ?>
    <?php echo e($pageInfo->meta_keywords); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('metaDescription'); ?>
    <?php echo e($pageInfo->meta_description); ?>

<?php $__env->stopSection(); ?>

<?php
    $title = $pageInfo->title ?? __('No Page Title Found');
?>

<?php $__env->startSection('content'); ?>
    
    
    
    <!-- ============================================
         PAGE LÉGALE - DESIGN PREMIUM
         ============================================ -->
    <!-- TEST: Si vous voyez cette bordure violette épaisse, le template est chargé -->
    <div class="legal-page-wrapper" style="border: 8px solid #7C3AED !important; background: linear-gradient(180deg, #D8DBFF 0%, #C3C5FF 100%) !important;">
        <div class="legal-page-container">
            <!-- En-tête premium -->
            <div class="legal-page-header">
                <h1 class="legal-page-title" style="color: #7C3AED !important; font-size: 48px !important;"><?php echo e($title); ?></h1>
                <p class="legal-page-subtitle">
                    <?php echo e(__('Document officiel')); ?> • <?php echo e(__('Dernière mise à jour')); ?> : <?php echo e(date('d/m/Y')); ?>

                </p>
            </div>

            <!-- Contenu premium -->
            <div class="legal-page-content summernote-content">
                <?php echo replaceBaseUrl($pageInfo->content, 'summernote'); ?>

            </div>

            <!-- Footer avec lien retour -->
            <div class="legal-page-footer">
                <a href="<?php echo e(route('index')); ?>" class="legal-page-back-link">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M19 12H5M12 19l-7-7 7-7"/>
                    </svg>
                    <?php echo e(__('Retour à l\'accueil')); ?>

                </a>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\younes\Downloads\junspro-main (1)\junspro-main3\resources\views\frontend\custom-page.blade.php ENDPATH**/ ?>