<?php $__env->startSection('style'); ?>
  <style>
    body { background: #F5F3FF; }
    .junspro-blog-hero { background-image: url('<?php echo e(asset('assets/img/blog-hero.jpg')); ?>'); background-size: cover; background-position: center; background-repeat: no-repeat; padding: 0; min-height: 650px; position: relative; overflow: hidden; display: flex; align-items: center; }
    .junspro-blog-hero-container { max-width: 1200px; margin: 0 auto; padding: 0 24px; position: relative; z-index: 2; }
    .junspro-blog-hero-content { text-align: center; }
    .junspro-blog-hero-title { font-size: 3.5rem; font-weight: 700; color: #111827; line-height: 1.2; margin: 0 0 2rem 0; letter-spacing: -0.02em; }
    .junspro-blog-hero-cta { display: inline-block; padding: 16px 32px; background: white; color: #1e40af; font-weight: 600; font-size: 1.1rem; border-radius: 12px; text-decoration: none; transition: all 0.3s ease; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15); }
    .junspro-blog-hero-cta:hover { transform: translateY(-2px); box-shadow: 0 6px 20px rgba(0, 0, 0, 0.2); color: #4c1d95; }
    .junspro-article-section { padding: 60px 0; background: #F5F3FF; }
    .junspro-article-container { max-width: 900px; margin: 0 auto; padding: 0 24px; }
    .junspro-article-card { background: white; border-radius: 24px; padding: 3rem; box-shadow: 0 10px 30px rgba(17, 24, 39, 0.06); border: 1px solid rgba(17, 24, 39, 0.08); }
    .junspro-article-hero-media { margin-top: 1.5rem; margin-bottom: 2rem; border-radius: 28px; overflow: hidden; border: 1px solid rgba(0, 0, 0, 0.05); box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1); }
    .junspro-article-hero-media-inner { height: 220px; }
    @media (min-width: 768px) {
      .junspro-article-hero-media-inner { height: 320px; }
    }
    .junspro-article-hero-media img { width: 100%; height: 100%; object-fit: cover; }
    .junspro-article-hero-media-placeholder { width: 100%; height: 100%; background: linear-gradient(135deg, #FFFFFF 0%, #F5F3FF 60%, #FFFFFF 100%); }
    .junspro-article-category { display: inline-block; padding: 6px 14px; background: linear-gradient(135deg, #4B2CEB 0%, #1e40af 50%, #4B2CEB 100%); background-size: 200% 200%; -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; font-weight: 600; font-size: 0.9rem; margin-bottom: 1rem; }
    .junspro-article-meta { display: flex; align-items: center; gap: 1rem; margin-bottom: 1.5rem; font-size: 0.9rem; color: #6B7280; }
    .junspro-article-title { font-size: 2.5rem; font-weight: 700; color: #111827; line-height: 1.3; margin-bottom: 1.5rem; }
    .junspro-article-content { font-size: 1.1rem; line-height: 1.8; color: #374151; }
    .junspro-article-content h2 { font-size: 1.75rem; font-weight: 700; color: #111827; margin-top: 2rem; margin-bottom: 1rem; }
    .junspro-article-content h3 { font-size: 1.5rem; font-weight: 700; color: #111827; margin-top: 1.5rem; margin-bottom: 0.75rem; }
    .junspro-article-content p { margin-bottom: 1.25rem; }
    .junspro-article-content ul, .junspro-article-content ol { margin-bottom: 1.25rem; padding-left: 2rem; }
    .junspro-article-content li { margin-bottom: 0.5rem; }
    .junspro-article-content a { color: #4B2CEB; text-decoration: underline; }
    .junspro-article-content a:hover { color: #1e40af; }
    .junspro-article-footer { margin-top: 3rem; padding-top: 2rem; border-top: 1px solid #E5E7EB; }
    .junspro-article-back { display: inline-flex; align-items: center; gap: 0.5rem; padding: 12px 24px; background: linear-gradient(135deg, #4B2CEB 0%, #1e40af 50%, #4B2CEB 100%); background-size: 200% 200%; -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; font-weight: 600; text-decoration: none; transition: background-position 0.3s ease; }
    .junspro-article-back:hover { background-position: 100% 0; }
    @media (max-width: 768px) {
      .junspro-blog-hero-title { font-size: 2.25rem; }
      .junspro-article-title { font-size: 2rem; }
      .junspro-article-card { padding: 2rem; }
    }
  </style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('pageHeading'); ?>
  <?php if(!empty($pageHeading)): ?>
    <?php echo e($pageHeading->post_details_page_title ?? ($details->title ?? 'Article')); ?>

  <?php else: ?>
    <?php echo e($details->title ?? 'Article'); ?>

  <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
  <!-- Hero Section (duplicated from blog list page) -->
  <section class="junspro-blog-hero">
    <div class="junspro-blog-hero-container">
      <div class="junspro-blog-hero-content">
        <h1 class="junspro-blog-hero-title">Bienvenue sur notre Blog</h1>
        <a href="<?php echo e(route('blog')); ?>" class="junspro-blog-hero-cta">Consulter nos articles</a>
      </div>
    </div>
  </section>

  <!-- Article Content -->
  <section class="junspro-article-section">
    <div class="junspro-article-container">
      <div class="junspro-article-card">
        <?php
          // Unifier la source de l'image : priorité cover_image > image > thumbnail
          $cover = $details->cover_image ?? $details->image ?? $details->thumbnail ?? null;
          if ($cover && is_string($cover) && !str_starts_with($cover, 'http') && !str_starts_with($cover, '/')) {
            $coverPath = asset($cover);
          } elseif ($cover && is_string($cover) && str_starts_with($cover, '/')) {
            $coverPath = asset(ltrim($cover, '/'));
          } elseif ($cover) {
            $coverPath = $cover;
          } else {
            $coverPath = null;
          }
        ?>

        <?php if(!empty($details->categoryName)): ?>
          <div class="junspro-article-category"><?php echo e($details->categoryName); ?></div>
        <?php endif; ?>

        <div class="junspro-article-meta">
          <?php if(!empty($details->author)): ?>
            <span><strong><?php echo e($details->author); ?></strong></span>
          <?php endif; ?>
          <?php if(!empty($details->created_at)): ?>
            <?php
              try {
                $date = \Carbon\Carbon::parse($details->created_at)->format('d F Y');
              } catch (\Exception $e) {
                $date = date('d F Y', strtotime($details->created_at));
              }
            ?>
            <span><?php echo e($date); ?></span>
          <?php endif; ?>
        </div>

        <!-- Hero Media Header -->
        <div class="junspro-article-hero-media">
          <div class="junspro-article-hero-media-inner">
            <?php if($coverPath): ?>
              <img src="<?php echo e($coverPath); ?>" alt="<?php echo e($details->title ?? 'Article'); ?>" class="junspro-article-hero-media-img" onerror="this.parentElement.innerHTML='<div class=\'junspro-article-hero-media-placeholder\'></div>';">
            <?php else: ?>
              <div class="junspro-article-hero-media-placeholder"></div>
            <?php endif; ?>
          </div>
        </div>

        <h1 class="junspro-article-title"><?php echo e($details->title ?? 'Article sans titre'); ?></h1>

        <?php if(!empty($details->content)): ?>
          <div class="junspro-article-content">
            <?php echo $details->content; ?>

          </div>
        <?php else: ?>
          <p style="color: #6B7280;">Aucun contenu disponible.</p>
        <?php endif; ?>

        <div class="junspro-article-footer">
          <a href="<?php echo e(route('blog')); ?>" class="junspro-article-back">
            <i class="fas fa-arrow-left"></i> Retour au blog
          </a>
        </div>
      </div>
    </div>
  </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\younes\Downloads\junspro-main (1)\junspro-main3\resources\views\frontend\blog\post-details.blade.php ENDPATH**/ ?>