<?php $__env->startSection('style'); ?>
  <style>
    body { background: #F5F3FF; }
    .junspro-blog-hero { background-image: url('<?php echo e(asset('assets/img/blog-hero.jpg')); ?>'); background-size: cover; background-position: center; background-repeat: no-repeat; padding: 0; min-height: 650px; position: relative; overflow: hidden; display: flex; align-items: center; }
    .junspro-blog-hero-container { max-width: 1200px; margin: 0 auto; padding: 0 24px; position: relative; z-index: 2; }
    .junspro-blog-hero-content { text-align: center; }
    .junspro-blog-hero-title { font-size: 3.5rem; font-weight: 700; color: #111827; line-height: 1.2; margin: 0 0 2rem 0; letter-spacing: -0.02em; }
    .junspro-blog-hero-cta { display: inline-block; padding: 16px 32px; background: white; color: #1e40af; font-weight: 600; font-size: 1.1rem; border-radius: 12px; text-decoration: none; transition: all 0.3s ease; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15); }
    .junspro-blog-hero-cta:hover { transform: translateY(-2px); box-shadow: 0 6px 20px rgba(0, 0, 0, 0.2); color: #4c1d95; }
    .junspro-blog-filters { background: white; padding: 2rem 0; border-bottom: 1px solid #E5E7EB; }
    .junspro-blog-filters-container { max-width: 1200px; margin: 0 auto; padding: 0 24px; }
    .junspro-filter-form { display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1.5rem; align-items: end; }
    .junspro-filter-group { display: flex; flex-direction: column; gap: 0.5rem; }
    .junspro-filter-label { font-size: 0.9rem; font-weight: 600; color: #374151; }
    .junspro-filter-input, .junspro-filter-select { padding: 10px 14px; border: 1.5px solid #E5E7EB; border-radius: 8px; font-size: 0.95rem; color: #111827; background: white; transition: all 0.3s ease; }
    .junspro-filter-input:focus, .junspro-filter-select:focus { outline: none; border-color: #4F46E5; box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1); }
    .junspro-filter-submit { padding: 10px 24px; background: linear-gradient(135deg, #1e40af 0%, #4c1d95 50%, #7c3aed 100%); color: white; font-weight: 600; border: none; border-radius: 8px; cursor: pointer; transition: all 0.3s ease; white-space: nowrap; }
    .junspro-filter-submit:hover { transform: translateY(-1px); box-shadow: 0 4px 12px rgba(79, 70, 229, 0.3); }
    .junspro-rubriques-section { padding: 80px 0; background: #F5F3FF; }
    .junspro-rubriques-container { max-width: 1200px; margin: 0 auto; padding: 0 24px; }
    .junspro-rubrique-block { margin-bottom: 4rem; }
    .junspro-rubrique-block:last-child { margin-bottom: 0; }
    .junspro-rubrique-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 3rem; }
    .junspro-rubrique-title { font-size: 2rem; font-weight: 700; color: #111827; margin: 0; }
    .junspro-rubrique-block:first-child .junspro-rubrique-title { margin-bottom: 4rem; }
    .junspro-rubrique-block:last-child .junspro-rubrique-title { margin-bottom: 4rem; }
    .junspro-rubrique-voir-tous { padding: 10px 20px; border: 1.5px solid rgba(75, 44, 235, 0.2); border-radius: 8px; color: #4B2CEB; font-weight: 600; text-decoration: none; transition: all 0.3s ease; background: white; }
    .junspro-rubrique-voir-tous:hover { background: #4B2CEB; color: white; border-color: #4B2CEB; transform: translateY(-1px); box-shadow: 0 4px 12px rgba(75, 44, 235, 0.3); }
    .junspro-rubrique-plateforme-grid { display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 2rem; }
    .junspro-rubrique-card { background: #FFFFFF; border-radius: 24px; overflow: hidden; box-shadow: 0 10px 30px rgba(17, 24, 39, 0.06); border: 1px solid rgba(17, 24, 39, 0.08); transition: all 0.3s ease; text-decoration: none; color: inherit; display: flex; flex-direction: column; height: 100%; }
    .junspro-rubrique-card:hover { transform: translateY(-2px); box-shadow: 0 12px 40px rgba(17, 24, 39, 0.1); border-color: rgba(75, 44, 235, 0.15); }
    .junspro-rubrique-card-media { width: 100%; flex: 0 0 50%; min-height: 200px; max-height: 250px; position: relative; overflow: hidden; background: #F9FAFB; }
    .junspro-rubrique-card-image { width: 100%; height: 100%; object-fit: cover; }
    .junspro-rubrique-card-image-placeholder { width: 100%; height: 100%; position: relative; background: linear-gradient(135deg, rgba(255, 255, 255, 0.98) 0%, rgba(249, 250, 251, 0.95) 50%, rgba(255, 255, 255, 0.98) 100%); border-bottom: 1px solid rgba(17, 24, 39, 0.08); overflow: hidden; }
    .junspro-rubrique-card-image-placeholder::before { content: ''; position: absolute; inset: 0; background-image: radial-gradient(circle at 2px 2px, rgba(17, 24, 39, 0.015) 1px, transparent 0); background-size: 24px 24px; opacity: 0.4; }
    .junspro-rubrique-card-image-placeholder::after { content: '📄'; position: absolute; bottom: 12px; right: 12px; opacity: 0.2; font-size: 1.5rem; }
    .junspro-rubrique-card-content { padding: 1.5rem; flex: 1; display: flex; flex-direction: column; justify-content: space-between; min-height: 0; }
    .junspro-rubrique-card-meta { display: flex; align-items: center; gap: 0.5rem; margin-bottom: 0.75rem; font-size: 0.85rem; font-weight: 500; }
    .junspro-rubrique-card-meta i { background: linear-gradient(135deg, #4B2CEB 0%, #1e40af 50%, #4B2CEB 100%); background-size: 200% 200%; -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; }
    .junspro-rubrique-card-meta span { background: linear-gradient(135deg, #4B2CEB 0%, #1e40af 50%, #4B2CEB 100%); background-size: 200% 200%; -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; }
    .junspro-rubrique-card-title { font-size: 1.25rem; font-weight: 700; color: #111827; margin-bottom: 0.75rem; line-height: 1.4; }
    .junspro-rubrique-card-excerpt { font-size: 0.95rem; color: #6B7280; line-height: 1.6; margin-bottom: 1rem; display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden; }
    .junspro-rubrique-card-link { background: linear-gradient(135deg, #4B2CEB 0%, #1e40af 50%, #4B2CEB 100%); background-size: 200% 200%; -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; font-weight: 600; font-size: 0.9rem; text-decoration: none; display: inline-block; transition: background-position 0.3s ease; }
    .junspro-rubrique-card-link:hover { background-position: 100% 0; }
    .junspro-rubrique-text-item { margin-bottom: 1.5rem; }
    .junspro-rubrique-text-item:last-child { margin-bottom: 0; }
    .junspro-rubrique-text-title { font-size: 1.1rem; font-weight: 700; color: #111827; margin-bottom: 0.5rem; line-height: 1.4; }
    .junspro-rubrique-text-excerpt { font-size: 0.95rem; color: #6B7280; line-height: 1.6; margin-bottom: 0.75rem; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; }
    .junspro-rubrique-text-link { background: linear-gradient(135deg, #4B2CEB 0%, #1e40af 50%, #4B2CEB 100%); background-size: 200% 200%; -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; font-weight: 600; font-size: 0.9rem; text-decoration: none; transition: background-position 0.3s ease; }
    .junspro-rubrique-text-link:hover { background-position: 100% 0; }
    .junspro-rubrique-parutions-grid { display: grid; grid-template-columns: repeat(2, 1fr); gap: 2rem; }
    .junspro-rubrique-informer-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 2rem; }
    .junspro-rubrique-informer-left { display: flex; flex-direction: column; gap: 1.5rem; }
    .junspro-cta-section { padding: 80px 0; background: #F5F3FF; border-top: 1px solid rgba(17, 24, 39, 0.08); }
    .junspro-cta-container { max-width: 1200px; margin: 0 auto; padding: 0 24px; }
    .junspro-cta-card { background: white; border-radius: 24px; padding: 3rem; box-shadow: 0 10px 30px rgba(17, 24, 39, 0.06); text-align: center; }
    .junspro-cta-title { font-size: 2rem; font-weight: 700; color: #111827; margin-bottom: 1rem; }
    .junspro-cta-subtitle { font-size: 1.1rem; color: #6B7280; margin-bottom: 2rem; }
    .junspro-cta-buttons { display: flex; justify-content: center; gap: 1rem; flex-wrap: wrap; }
    .junspro-cta-btn-primary { display: inline-flex; align-items: center; gap: 0.5rem; padding: 14px 28px; background: #4B2CEB; color: white; font-weight: 600; border-radius: 12px; text-decoration: none; transition: all 0.3s ease; }
    .junspro-cta-btn-primary:hover { transform: translateY(-2px); box-shadow: 0 6px 20px rgba(75, 44, 235, 0.3); }
    .junspro-cta-btn-secondary { display: inline-flex; align-items: center; gap: 0.5rem; padding: 14px 28px; background: white; color: #4B2CEB; border: 1.5px solid #4B2CEB; font-weight: 600; border-radius: 12px; text-decoration: none; transition: all 0.3s ease; }
    .junspro-cta-btn-secondary:hover { background: #F5F3FF; }
    .junspro-blog-pagination { display: flex; justify-content: center; align-items: center; gap: 0.5rem; padding: 60px 0; background: #F5F3FF; }
    .junspro-pagination-link { padding: 8px 14px; border: 1.5px solid rgba(17, 24, 39, 0.08); border-radius: 8px; text-decoration: none; color: #374151; font-weight: 500; transition: all 0.3s ease; background: white; }
    .junspro-pagination-link:hover { border-color: #4B2CEB; color: #4B2CEB; background: #F5F3FF; }
    .junspro-pagination-link.active { background: #4B2CEB; color: white; border-color: #4B2CEB; }
    .junspro-pagination-link.disabled { opacity: 0.5; cursor: not-allowed; pointer-events: none; }
    @media (min-width: 1024px) { .junspro-rubrique-parutions-grid { grid-template-columns: repeat(4, 1fr); } }
    @media (max-width: 1023px) and (min-width: 769px) { .junspro-rubrique-parutions-grid { grid-template-columns: repeat(2, 1fr); } }
    @media (max-width: 768px) { .junspro-blog-hero-title { font-size: 2.25rem; } .junspro-filter-form { grid-template-columns: 1fr; } .junspro-rubrique-plateforme-grid { grid-template-columns: 1fr; } .junspro-rubrique-parutions-grid { grid-template-columns: 1fr; } .junspro-rubrique-informer-grid { grid-template-columns: 1fr; } .junspro-cta-buttons { flex-direction: column; } }
  </style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('pageHeading'); ?>
  <?php if(!empty($pageHeading)): ?>
    <?php echo e($pageHeading->blog_page_title ?? 'Blog'); ?>

  <?php else: ?>
    Blog
  <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
  <section class="junspro-blog-hero">
    <div class="junspro-blog-hero-container">
      <div class="junspro-blog-hero-content">
        <h1 class="junspro-blog-hero-title">Bienvenue sur notre Blog</h1>
        <a href="#blog-content" class="junspro-blog-hero-cta">Consulter nos articles</a>
      </div>
    </div>
  </section>

  <section class="junspro-blog-filters">
    <div class="junspro-blog-filters-container">
      <form method="GET" action="<?php echo e(route('blog')); ?>" class="junspro-filter-form">
        <div class="junspro-filter-group">
          <label class="junspro-filter-label" for="filter-title">Recherche par titre</label>
          <input type="text" id="filter-title" name="title" class="junspro-filter-input" placeholder="Titre de l'article..." value="<?php echo e($filters['title'] ?? ''); ?>">
        </div>
        <div class="junspro-filter-group">
          <label class="junspro-filter-label" for="filter-univers">Univers</label>
          <select id="filter-univers" name="univers" class="junspro-filter-select">
            <option value="">Tous les univers</option>
            <option value="projects" <?php echo e(($filters['univers'] ?? '') === 'projects' ? 'selected' : ''); ?>>Projets et Consulting</option>
            <option value="lessons" <?php echo e(($filters['univers'] ?? '') === 'lessons' ? 'selected' : ''); ?>>Cours et Tutorat</option>
            <option value="at-home" <?php echo e(($filters['univers'] ?? '') === 'at-home' ? 'selected' : ''); ?>>Service à Domicile</option>
            <option value="homeswap" <?php echo e(($filters['univers'] ?? '') === 'homeswap' ? 'selected' : ''); ?>>Échange de Logement</option>
            <option value="wellnesslive" <?php echo e(($filters['univers'] ?? '') === 'wellnesslive' ? 'selected' : ''); ?>>WellnessLive</option>
            <option value="pause-souffle" <?php echo e(($filters['univers'] ?? '') === 'pause-souffle' ? 'selected' : ''); ?>>Pause Souffle</option>
          </select>
        </div>
        <div class="junspro-filter-group">
          <label class="junspro-filter-label" for="filter-duree">Durée de l'article</label>
          <select id="filter-duree" name="duree" class="junspro-filter-select">
            <option value="">Toutes les durées</option>
            <option value="2" <?php echo e(($filters['duree'] ?? '') === '2' ? 'selected' : ''); ?>>2 minutes</option>
            <option value="3-5" <?php echo e(($filters['duree'] ?? '') === '3-5' ? 'selected' : ''); ?>>3-5 minutes</option>
            <option value="6-10" <?php echo e(($filters['duree'] ?? '') === '6-10' ? 'selected' : ''); ?>>6-10 minutes</option>
          </select>
        </div>
        <div class="junspro-filter-group">
          <label class="junspro-filter-label" for="filter-categorie">Catégorie</label>
          <select id="filter-categorie" name="categorie" class="junspro-filter-select">
            <option value="">Toutes les catégories</option>
            <option value="guides" <?php echo e(($filters['categorie'] ?? '') === 'guides' ? 'selected' : ''); ?>>Guides & tutoriels</option>
            <option value="conseils-clients" <?php echo e(($filters['categorie'] ?? '') === 'conseils-clients' ? 'selected' : ''); ?>>Conseils clients</option>
            <option value="conseils-prestataires" <?php echo e(($filters['categorie'] ?? '') === 'conseils-prestataires' ? 'selected' : ''); ?>>Conseils prestataires</option>
            <option value="methodes" <?php echo e(($filters['categorie'] ?? '') === 'methodes' ? 'selected' : ''); ?>>Méthodes & organisation</option>
            <option value="qualite" <?php echo e(($filters['categorie'] ?? '') === 'qualite' ? 'selected' : ''); ?>>Qualité & confiance</option>
          </select>
        </div>
        <div class="junspro-filter-group">
          <label class="junspro-filter-label" for="filter-rubrique">Rubrique</label>
          <select id="filter-rubrique" name="rubrique" class="junspro-filter-select">
            <option value="">Toutes les rubriques</option>
            <option value="plateforme" <?php echo e(($filters['rubrique'] ?? '') === 'plateforme' ? 'selected' : ''); ?>>Mieux connaître la plateforme</option>
            <option value="parutions" <?php echo e(($filters['rubrique'] ?? '') === 'parutions' ? 'selected' : ''); ?>>Nos nouvelles parutions</option>
            <option value="informer" <?php echo e(($filters['rubrique'] ?? '') === 'informer' ? 'selected' : ''); ?>>S'informer et se former</option>
          </select>
        </div>
        <div class="junspro-filter-group">
          <button type="submit" class="junspro-filter-submit">Filtrer</button>
        </div>
      </form>
    </div>
  </section>

  <?php
    $items = collect($posts->items());
    // Filtrer l'article "Test" et les articles avec titre "Test"
    $items = $items->filter(function($item) {
      $title = strtolower(trim($item->title ?? ''));
      return $title !== 'test' && !str_starts_with($title, 'article exemple');
    });
    
    $placeholderDurations = [2, 3, 4, 5, 6, 7, 8, 9, 10, 2, 4, 8, 6];
    $placeholders = collect(range(1, 13))->map(function($i) use ($placeholderDurations) {
      return (object)[
        'id' => 999999 + $i,
        'title' => "Article exemple {$i}",
        'slug' => '#',
        'excerpt' => "Texte de démonstration pour prévisualiser la mise en page et la structure des articles du blog.",
        'reading_minutes' => $placeholderDurations[$i - 1] ?? 2,
        'image' => null,
        'categoryName' => 'Exemple',
        'is_placeholder' => true,
      ];
    });
    // Garantir que le premier article réel est en première position
    $firstReal = $items->first();
    $restItems = $items->slice(1);
    $itemsComplete = collect();
    if ($firstReal) {
      $itemsComplete = $itemsComplete->push($firstReal);
    }
    $itemsComplete = $itemsComplete->concat($restItems)->concat($placeholders)->take(13);
    
    $s1_main = $itemsComplete->slice(0, 2);
    $s1_list = $itemsComplete->slice(2, 3);
    $s2_grid = $itemsComplete->slice(5, 4);
    $s3_list = $itemsComplete->slice(9, 3);
    $s3_featured = $itemsComplete->slice(12, 1)->first();
  ?>

  <section class="junspro-rubriques-section" id="blog-content">
    <div class="junspro-rubriques-container">
      
      <div class="junspro-rubrique-block">
        <h2 class="junspro-rubrique-title">Mieux connaître la plateforme</h2>
        <div class="junspro-rubrique-plateforme-grid">
          <?php $__currentLoopData = $s1_main; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <a href="<?php echo e(($post->is_placeholder ?? false) ? '#' : route('blog.post_details', ['slug' => $post->slug, 'id' => $post->id])); ?>" class="junspro-rubrique-card">
              <div class="junspro-rubrique-card-media">
                <?php if(!empty($post->image) && !($post->is_placeholder ?? false)): ?>
                  <img src="<?php echo e(asset('assets/img/posts/' . $post->image)); ?>" alt="<?php echo e($post->title); ?>" class="junspro-rubrique-card-image" onerror="this.onerror=null; this.src='<?php echo e(asset('assets/front/images/placeholder.png')); ?>';">
                <?php else: ?>
                  <div class="junspro-rubrique-card-image-placeholder"></div>
                <?php endif; ?>
              </div>
              <div class="junspro-rubrique-card-content">
                <div class="junspro-rubrique-card-meta">
                  <i class="fas fa-clock"></i>
                  <span><?php echo e($post->reading_minutes ?? 2); ?>min</span>
                </div>
                <h3 class="junspro-rubrique-card-title"><?php echo e($post->title); ?></h3>
                <p class="junspro-rubrique-card-excerpt"><?php echo e(Str::limit(strip_tags($post->content ?? $post->excerpt ?? ''), 120)); ?></p>
                <span class="junspro-rubrique-card-link">Lire l'article <i class="fas fa-arrow-right"></i></span>
              </div>
            </a>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          <div style="display: flex; flex-direction: column; gap: 1.5rem;">
            <?php $__currentLoopData = $s1_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <div class="junspro-rubrique-text-item">
                <a href="<?php echo e(($post->is_placeholder ?? false) ? '#' : route('blog.post_details', ['slug' => $post->slug, 'id' => $post->id])); ?>" style="text-decoration: none; color: inherit;">
                  <h3 class="junspro-rubrique-text-title"><?php echo e($post->title); ?></h3>
                  <p class="junspro-rubrique-text-excerpt"><?php echo e(Str::limit(strip_tags($post->content ?? $post->excerpt ?? ''), 100)); ?></p>
                  <span class="junspro-rubrique-text-link">Lire cet article de <?php echo e($post->reading_minutes ?? 2); ?>mn</span>
                </a>
              </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </div>
        </div>
      </div>

      
      <div class="junspro-rubrique-block">
        <div class="junspro-rubrique-header">
          <h2 class="junspro-rubrique-title">Nos nouvelles parutions</h2>
          <a href="<?php echo e(route('blog', ['rubrique' => 'parutions'])); ?>" class="junspro-rubrique-voir-tous">Voir tous les articles</a>
        </div>
        <div class="junspro-rubrique-parutions-grid">
          <?php $__currentLoopData = $s2_grid; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <a href="<?php echo e(($post->is_placeholder ?? false) ? '#' : route('blog.post_details', ['slug' => $post->slug, 'id' => $post->id])); ?>" class="junspro-rubrique-card">
              <div class="junspro-rubrique-card-media">
                <?php if(!empty($post->image) && !($post->is_placeholder ?? false)): ?>
                  <img src="<?php echo e(asset('assets/img/posts/' . $post->image)); ?>" alt="<?php echo e($post->title); ?>" class="junspro-rubrique-card-image" onerror="this.onerror=null; this.src='<?php echo e(asset('assets/front/images/placeholder.png')); ?>';">
                <?php else: ?>
                  <div class="junspro-rubrique-card-image-placeholder"></div>
                <?php endif; ?>
              </div>
              <div class="junspro-rubrique-card-content">
                <div class="junspro-rubrique-card-meta">
                  <i class="fas fa-clock"></i>
                  <span><?php echo e($post->reading_minutes ?? 2); ?>min</span>
                </div>
                <h3 class="junspro-rubrique-card-title"><?php echo e($post->title); ?></h3>
                <p class="junspro-rubrique-card-excerpt"><?php echo e(Str::limit(strip_tags($post->content ?? $post->excerpt ?? ''), 120)); ?></p>
                <span class="junspro-rubrique-card-link">Lire cet article de <?php echo e($post->reading_minutes ?? 2); ?>mn</span>
              </div>
            </a>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
      </div>

      
      <div class="junspro-rubrique-block">
        <h2 class="junspro-rubrique-title">S'informer et se former</h2>
        <div class="junspro-rubrique-informer-grid">
          <div class="junspro-rubrique-informer-left">
            <?php $__currentLoopData = $s3_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <div class="junspro-rubrique-text-item">
                <a href="<?php echo e(($post->is_placeholder ?? false) ? '#' : route('blog.post_details', ['slug' => $post->slug, 'id' => $post->id])); ?>" style="text-decoration: none; color: inherit;">
                  <h3 class="junspro-rubrique-text-title"><?php echo e($post->title); ?></h3>
                  <p class="junspro-rubrique-text-excerpt"><?php echo e(Str::limit(strip_tags($post->content ?? $post->excerpt ?? ''), 100)); ?></p>
                  <span class="junspro-rubrique-text-link">Lire cet article de <?php echo e($post->reading_minutes ?? 2); ?>mn</span>
                </a>
              </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </div>
          <div>
            <?php if($s3_featured): ?>
              <a href="<?php echo e(($s3_featured->is_placeholder ?? false) ? '#' : route('blog.post_details', ['slug' => $s3_featured->slug, 'id' => $s3_featured->id])); ?>" class="junspro-rubrique-card">
                <div class="junspro-rubrique-card-media">
                  <?php if(!empty($s3_featured->image) && !($s3_featured->is_placeholder ?? false)): ?>
                    <img src="<?php echo e(asset('assets/img/posts/' . $s3_featured->image)); ?>" alt="<?php echo e($s3_featured->title); ?>" class="junspro-rubrique-card-image" onerror="this.onerror=null; this.src='<?php echo e(asset('assets/front/images/placeholder.png')); ?>';">
                  <?php else: ?>
                    <div class="junspro-rubrique-card-image-placeholder"></div>
                  <?php endif; ?>
                </div>
                <div class="junspro-rubrique-card-content">
                  <div class="junspro-rubrique-card-meta">
                    <i class="fas fa-clock"></i>
                    <span><?php echo e($s3_featured->reading_minutes ?? 2); ?>min</span>
                  </div>
                  <h3 class="junspro-rubrique-card-title"><?php echo e($s3_featured->title); ?></h3>
                  <p class="junspro-rubrique-card-excerpt"><?php echo e(Str::limit(strip_tags($s3_featured->content ?? $s3_featured->excerpt ?? ''), 120)); ?></p>
                  <span class="junspro-rubrique-card-link">Lire cet article de <?php echo e($s3_featured->reading_minutes ?? 2); ?>mn</span>
                </div>
              </a>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </div>
  </section>

  
  <section class="junspro-cta-section">
    <div class="junspro-cta-container">
      <div class="junspro-cta-card">
        <h2 class="junspro-cta-title">Prêt à passer à l'action ?</h2>
        <p class="junspro-cta-subtitle">Déposez votre mission ou trouvez le freelance idéal pour votre projet.</p>
        <div class="junspro-cta-buttons">
          <a href="<?php echo e(route('mission.form')); ?>" class="junspro-cta-btn-primary">
            <i class="fas fa-paper-plane"></i>
            Déposer une mission
          </a>
          <a href="<?php echo e(route('services')); ?>" class="junspro-cta-btn-secondary">
            <i class="fas fa-search"></i>
            Trouver un freelance
          </a>
        </div>
      </div>
    </div>
  </section>

  
  <div class="junspro-blog-pagination">
    <?php if($posts->onFirstPage()): ?>
      <span class="junspro-pagination-link disabled">&lt;</span>
    <?php else: ?>
      <a href="<?php echo e($posts->previousPageUrl()); ?>" class="junspro-pagination-link">&lt;</a>
    <?php endif; ?>
    <?php $__currentLoopData = range(1, $posts->lastPage()); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <?php if($page == $posts->currentPage()): ?>
        <span class="junspro-pagination-link active"><?php echo e($page); ?></span>
      <?php else: ?>
        <a href="<?php echo e($posts->url($page)); ?>" class="junspro-pagination-link"><?php echo e($page); ?></a>
      <?php endif; ?>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php if($posts->hasMorePages()): ?>
      <a href="<?php echo e($posts->nextPageUrl()); ?>" class="junspro-pagination-link">&gt;</a>
    <?php else: ?>
      <span class="junspro-pagination-link disabled">&gt;</span>
    <?php endif; ?>
  </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
  <script>
    document.querySelector('.junspro-blog-hero-cta')?.addEventListener('click', function(e) {
      e.preventDefault();
      document.getElementById('blog-content')?.scrollIntoView({ behavior: 'smooth', block: 'start' });
    });

    // Scroller vers les résultats après soumission des filtres
    document.addEventListener('DOMContentLoaded', function() {
      const urlParams = new URLSearchParams(window.location.search);
      const hasFilters = urlParams.has('title') || urlParams.has('univers') || urlParams.has('duree') || 
                         urlParams.has('categorie') || urlParams.has('rubrique');
      
      if (hasFilters) {
        setTimeout(function() {
          document.getElementById('blog-content')?.scrollIntoView({ behavior: 'smooth', block: 'start' });
        }, 100);
      }
    });
  </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\younes\Downloads\junspro-main (1)\junspro-main3\resources\views\frontend\blog\posts.blade.php ENDPATH**/ ?>