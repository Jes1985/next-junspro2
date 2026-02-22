

<?php $__env->startSection('pageHeading'); ?>
  <?php echo e(replaceSellerWithFreelance($pageHeading->seller_page_title ?? __('Freelances'))); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('metaKeywords'); ?>
  <?php if(!empty($seoInfo)): ?>
    <?php echo e($seoInfo->seller_page_meta_keywords ?? ''); ?>

  <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('metaDescription'); ?>
  <?php if(!empty($seoInfo)): ?>
    <?php echo e($seoInfo->seller_page_meta_description ?? ''); ?>

  <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('style'); ?>
<link rel="stylesheet" href="<?php echo e(asset('assets/front/css/freelancers-premium.css')); ?>?v=<?php echo e(time()); ?>">
<style>
  /* Styles inline pour le panneau de filtres et les cartes */
  :root {
    --junspro-primary: #4F46E5;
    --junspro-primary-light: #6366F1;
    --junspro-primary-dark: #4338CA;
    --junspro-violet: #7C3AED;
    --junspro-gray-50: #F9FAFB;
    --junspro-gray-100: #F3F4F6;
    --junspro-gray-200: #E5E7EB;
    --junspro-gray-300: #D1D5DB;
    --junspro-gray-400: #9CA3AF;
    --junspro-gray-500: #6B7280;
    --junspro-gray-600: #4B5563;
    --junspro-gray-700: #374151;
    --junspro-gray-800: #1F2937;
    --junspro-gray-900: #111827;
  }
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
  
  

  <!-- Hero Section Premium -->
  <section class="freelancers-hero-premium">
    <div class="freelancers-hero-container">
      <div class="freelancers-hero-content">
        <h1 class="freelancers-hero-title">
          <span class="hero-title-line-1"><?php echo e(__('Trouvez le')); ?> <span class="highlight"><?php echo e(__('freelance idéal')); ?></span></span>
          <span class="hero-title-line-2"><?php echo e(__('pour votre projet')); ?></span>
        </h1>
        <p class="freelancers-hero-subtitle">
          <?php echo e(__('Des experts vérifiés pour vos projets clés en main : landing pages, tunnels de vente, branding, automatisation...')); ?>

        </p>
        <div class="freelancers-hero-stats">
          <span class="hero-stat-item">
            <strong><?php echo e(count($sellers) > 0 ? $sellers->total() : '0'); ?>+</strong> <?php echo e(__('freelances')); ?>

          </span>
          <span class="hero-stat-item">
            <strong>5/5</strong> <?php echo e(__('note moyenne')); ?>

          </span>
          <span class="hero-stat-item">
            <strong>2j</strong> <?php echo e(__('délai moyen')); ?>

          </span>
        </div>
      </div>
    </div>
  </section>

  <!-- Page Freelances Premium -->
  <div class="freelancers-page-premium">
    <div class="freelancers-container-premium">
      <div class="freelancers-layout-premium">
        
        <!-- ============================================
             COLONNE FILTRES (GAUCHE) - STICKY DESKTOP
             ============================================ -->
        <aside class="freelancers-sidebar-premium" id="freelancers-sidebar">
          <div class="sidebar-content">
            <!-- Header Mobile -->
            <div class="sidebar-header-mobile">
              <h3><?php echo e(__('Filtres')); ?></h3>
              <button class="sidebar-close-btn" type="button" aria-label="Fermer">
                <i class="fas fa-times"></i>
              </button>
            </div>

            <form action="<?php echo e(route('frontend.sellers')); ?>" method="get" id="freelancers-filter-form">
              
              <!-- RECHERCHE -->
              <div class="filter-section">
                <h4 class="filter-title"><?php echo e(__('RECHERCHE')); ?></h4>
                <div class="filter-content">
                  <input type="text" 
                         name="search" 
                         class="filter-search-input" 
                         placeholder="<?php echo e(__('Mot-clé, compétence, type de projet ou secteur')); ?>"
                         value="<?php echo e(request()->input('search')); ?>">
                </div>
              </div>

              <!-- TARIF -->
              <div class="filter-section">
                <h4 class="filter-title"><?php echo e(__('TARIF')); ?></h4>
                <div class="filter-content">
                  <!-- Toggle Tarif horaire / Budget par projet -->
                  <div class="filter-toggle-group">
                    <button type="button" class="filter-toggle-btn active" data-mode="hourly">
                      <?php echo e(__('Tarif horaire')); ?>

                    </button>
                    <button type="button" class="filter-toggle-btn" data-mode="project">
                      <?php echo e(__('Budget par projet')); ?>

                    </button>
                  </div>
                  
                  <!-- Slider Tarif horaire -->
                  <div class="price-filter-wrapper" id="hourly-price-filter">
                    <div id="hourly-rate-slider" class="price-slider"></div>
                    <div class="price-range-display">
                      <span><?php echo e(__('De')); ?>:</span>
                      <input type="number" name="hourly_min" id="hourly-min" class="price-input" min="0" max="500" value="<?php echo e(request()->input('hourly_min', 10)); ?>">
                      <span><?php echo e(__('à')); ?>:</span>
                      <input type="number" name="hourly_max" id="hourly-max" class="price-input" min="0" max="500" value="<?php echo e(request()->input('hourly_max', 299)); ?>">
                      <span class="price-unit">€/h</span>
                    </div>
                  </div>

                  <!-- Budget par projet -->
                  <div class="price-filter-wrapper" id="project-price-filter" style="display: none;">
                    <div class="price-range-display">
                      <span><?php echo e(__('Budget estimé')); ?>:</span>
                      <input type="number" name="project_min" id="project-min" class="price-input" min="0" max="50000" value="<?php echo e(request()->input('project_min', 300)); ?>">
                      <span><?php echo e(__('à')); ?>:</span>
                      <input type="number" name="project_max" id="project-max" class="price-input" min="0" max="50000" value="<?php echo e(request()->input('project_max', 3000)); ?>">
                      <span class="price-unit">€ / <?php echo e(__('projet')); ?></span>
                    </div>
                  </div>
                </div>
              </div>

              <!-- DISPONIBILITÉ -->
              <div class="filter-section">
                <h4 class="filter-title"><?php echo e(__('DISPONIBILITÉ')); ?></h4>
                <div class="filter-content">
                  <div class="filter-pills">
                    <label class="filter-pill <?php echo e(empty(request()->input('availability')) ? 'active' : ''); ?>">
                      <input type="radio" name="availability" value="" <?php echo e(empty(request()->input('availability')) ? 'checked' : ''); ?>>
                      <span><?php echo e(__('Toutes les disponibilités')); ?></span>
                    </label>
                    <label class="filter-pill <?php echo e(request()->input('availability') == '1-8' ? 'active' : ''); ?>">
                      <input type="radio" name="availability" value="1-8" <?php echo e(request()->input('availability') == '1-8' ? 'checked' : ''); ?>>
                      <span>1 à 8h/semaine</span>
                    </label>
                    <label class="filter-pill <?php echo e(request()->input('availability') == '8-16' ? 'active' : ''); ?>">
                      <input type="radio" name="availability" value="8-16" <?php echo e(request()->input('availability') == '8-16' ? 'checked' : ''); ?>>
                      <span>8 à 16h/semaine</span>
                    </label>
                    <label class="filter-pill <?php echo e(request()->input('availability') == '16-24' ? 'active' : ''); ?>">
                      <input type="radio" name="availability" value="16-24" <?php echo e(request()->input('availability') == '16-24' ? 'checked' : ''); ?>>
                      <span>16 à 24h/semaine</span>
                    </label>
                  </div>

                  <!-- Délai de démarrage -->
                  <div class="filter-subsection">
                    <h5 class="filter-subtitle"><?php echo e(__('Délai de démarrage')); ?></h5>
                    <div class="filter-checkboxes">
                      <label class="filter-checkbox-item">
                        <input type="checkbox" name="start_delay[]" value="immediate" <?php echo e(in_array('immediate', (array)request()->input('start_delay', [])) ? 'checked' : ''); ?>>
                        <span><?php echo e(__('Immédiat (cette semaine)')); ?></span>
                      </label>
                      <label class="filter-checkbox-item">
                        <input type="checkbox" name="start_delay[]" value="15days" <?php echo e(in_array('15days', (array)request()->input('start_delay', [])) ? 'checked' : ''); ?>>
                        <span><?php echo e(__('Sous 15 jours')); ?></span>
                      </label>
                      <label class="filter-checkbox-item">
                        <input type="checkbox" name="start_delay[]" value="1-3months" <?php echo e(in_array('1-3months', (array)request()->input('start_delay', [])) ? 'checked' : ''); ?>>
                        <span><?php echo e(__('Sous 1-3 mois')); ?></span>
                      </label>
                    </div>
                  </div>
                </div>
              </div>

              <!-- PAYS -->
              <div class="filter-section">
                <h4 class="filter-title"><?php echo e(__('PAYS')); ?></h4>
                <div class="filter-content">
                  <input type="text" 
                         name="country" 
                         class="filter-search-input" 
                         id="country-autocomplete"
                         placeholder="<?php echo e(__('FR, BE, CH...')); ?>"
                         value="<?php echo e(request()->input('country')); ?>">
                  <div class="filter-checkboxes mt-2">
                    <label class="filter-checkbox-item">
                      <input type="checkbox" name="remote_only" value="1" <?php echo e(request()->input('remote_only') == '1' ? 'checked' : ''); ?>>
                      <span><?php echo e(__('Remote uniquement')); ?></span>
                    </label>
                  </div>
                </div>
              </div>

              <!-- LANGUES -->
              <div class="filter-section">
                <h4 class="filter-title"><?php echo e(__('LANGUES')); ?></h4>
                <div class="filter-content">
                  <div class="filter-checkboxes">
                    <label class="filter-checkbox-item">
                      <input type="checkbox" name="languages[]" value="fr" <?php echo e(in_array('fr', (array)request()->input('languages', [])) ? 'checked' : ''); ?>>
                      <span>Français</span>
                    </label>
                    <label class="filter-checkbox-item">
                      <input type="checkbox" name="languages[]" value="en" <?php echo e(in_array('en', (array)request()->input('languages', [])) ? 'checked' : ''); ?>>
                      <span>English</span>
                    </label>
                    <label class="filter-checkbox-item">
                      <input type="checkbox" name="languages[]" value="es" <?php echo e(in_array('es', (array)request()->input('languages', [])) ? 'checked' : ''); ?>>
                      <span>Español</span>
                    </label>
                    <label class="filter-checkbox-item">
                      <input type="checkbox" name="languages[]" value="de" <?php echo e(in_array('de', (array)request()->input('languages', [])) ? 'checked' : ''); ?>>
                      <span>Deutsch</span>
                    </label>
                  </div>
                </div>
              </div>

              <!-- TYPE DE FREELANCE -->
              <div class="filter-section">
                <h4 class="filter-title"><?php echo e(__('TYPE DE FREELANCE')); ?></h4>
                <div class="filter-content">
                  <div class="filter-checkboxes">
                    <label class="filter-checkbox-item">
                      <input type="checkbox" name="freelance_type[]" value="verified" <?php echo e(in_array('verified', (array)request()->input('freelance_type', [])) ? 'checked' : ''); ?>>
                      <span><?php echo e(__('Freelances vérifiés / premium')); ?></span>
                    </label>
                    <label class="filter-checkbox-item">
                      <input type="checkbox" name="freelance_type[]" value="top" <?php echo e(in_array('top', (array)request()->input('freelance_type', [])) ? 'checked' : ''); ?>>
                      <span><?php echo e(__('Top Junspro')); ?></span>
                    </label>
                    <label class="filter-checkbox-item">
                      <input type="checkbox" name="freelance_type[]" value="new" <?php echo e(in_array('new', (array)request()->input('freelance_type', [])) ? 'checked' : ''); ?>>
                      <span><?php echo e(__('Nouveaux talents')); ?></span>
                    </label>
                  </div>
                </div>
              </div>

              <!-- ÉVALUATION -->
              <div class="filter-section">
                <h4 class="filter-title"><?php echo e(__('ÉVALUATION')); ?></h4>
                <div class="filter-content">
                  <div class="filter-pills">
                    <label class="filter-pill <?php echo e(empty(request()->input('rating')) ? 'active' : ''); ?>">
                      <input type="radio" name="rating" value="" <?php echo e(empty(request()->input('rating')) ? 'checked' : ''); ?>>
                      <span><?php echo e(__('Toutes')); ?></span>
                    </label>
                    <label class="filter-pill <?php echo e(request()->input('rating') == '5' ? 'active' : ''); ?>">
                      <input type="radio" name="rating" value="5" <?php echo e(request()->input('rating') == '5' ? 'checked' : ''); ?>>
                      <span>⭐⭐⭐⭐⭐ 5 <?php echo e(__('étoiles')); ?></span>
                    </label>
                    <label class="filter-pill <?php echo e(request()->input('rating') == '4' ? 'active' : ''); ?>">
                      <input type="radio" name="rating" value="4" <?php echo e(request()->input('rating') == '4' ? 'checked' : ''); ?>>
                      <span>⭐⭐⭐⭐ 4+ <?php echo e(__('étoiles')); ?></span>
                    </label>
                    <label class="filter-pill <?php echo e(request()->input('rating') == '3' ? 'active' : ''); ?>">
                      <input type="radio" name="rating" value="3" <?php echo e(request()->input('rating') == '3' ? 'checked' : ''); ?>>
                      <span>⭐⭐⭐ 3+ <?php echo e(__('étoiles')); ?></span>
                    </label>
                  </div>
                </div>
              </div>

              <!-- TYPE DE PROJET -->
              <div class="filter-section">
                <h4 class="filter-title"><?php echo e(__('TYPE DE PROJET')); ?></h4>
                <div class="filter-content">
                  <div class="filter-checkboxes">
                    <label class="filter-checkbox-item">
                      <input type="checkbox" name="project_type[]" value="landing-page" <?php echo e(in_array('landing-page', (array)request()->input('project_type', [])) ? 'checked' : ''); ?>>
                      <span><?php echo e(__('Landing page')); ?></span>
                    </label>
                    <label class="filter-checkbox-item">
                      <input type="checkbox" name="project_type[]" value="site-vitrine" <?php echo e(in_array('site-vitrine', (array)request()->input('project_type', [])) ? 'checked' : ''); ?>>
                      <span><?php echo e(__('Site vitrine')); ?></span>
                    </label>
                    <label class="filter-checkbox-item">
                      <input type="checkbox" name="project_type[]" value="tunnel-vente" <?php echo e(in_array('tunnel-vente', (array)request()->input('project_type', [])) ? 'checked' : ''); ?>>
                      <span><?php echo e(__('Tunnel de vente')); ?></span>
                    </label>
                    <label class="filter-checkbox-item">
                      <input type="checkbox" name="project_type[]" value="brand-kit" <?php echo e(in_array('brand-kit', (array)request()->input('project_type', [])) ? 'checked' : ''); ?>>
                      <span><?php echo e(__('Brand kit')); ?></span>
                    </label>
                    <label class="filter-checkbox-item">
                      <input type="checkbox" name="project_type[]" value="emailing" <?php echo e(in_array('emailing', (array)request()->input('project_type', [])) ? 'checked' : ''); ?>>
                      <span><?php echo e(__('Emailing')); ?></span>
                    </label>
                    <label class="filter-checkbox-item">
                      <input type="checkbox" name="project_type[]" value="ads" <?php echo e(in_array('ads', (array)request()->input('project_type', [])) ? 'checked' : ''); ?>>
                      <span><?php echo e(__('Ads')); ?></span>
                    </label>
                    <label class="filter-checkbox-item">
                      <input type="checkbox" name="project_type[]" value="automatisation" <?php echo e(in_array('automatisation', (array)request()->input('project_type', [])) ? 'checked' : ''); ?>>
                      <span><?php echo e(__('Automatisation')); ?></span>
                    </label>
                    <label class="filter-checkbox-item">
                      <input type="checkbox" name="project_type[]" value="coaching-strategique" <?php echo e(in_array('coaching-strategique', (array)request()->input('project_type', [])) ? 'checked' : ''); ?>>
                      <span><?php echo e(__('Coaching stratégique')); ?></span>
                    </label>
                  </div>
                </div>
              </div>

              <!-- SECTEUR / INDUSTRIE -->
              <div class="filter-section">
                <h4 class="filter-title"><?php echo e(__('SECTEUR / INDUSTRIE')); ?></h4>
                <div class="filter-content">
                  <div class="filter-checkboxes">
                    <label class="filter-checkbox-item">
                      <input type="checkbox" name="sector[]" value="infopreneurs-coachs" <?php echo e(in_array('infopreneurs-coachs', (array)request()->input('sector', [])) ? 'checked' : ''); ?>>
                      <span><?php echo e(__('Infopreneurs & coachs')); ?></span>
                    </label>
                    <label class="filter-checkbox-item">
                      <input type="checkbox" name="sector[]" value="ecommerce" <?php echo e(in_array('ecommerce', (array)request()->input('sector', [])) ? 'checked' : ''); ?>>
                      <span><?php echo e(__('E-commerce')); ?></span>
                    </label>
                    <label class="filter-checkbox-item">
                      <input type="checkbox" name="sector[]" value="services-locaux" <?php echo e(in_array('services-locaux', (array)request()->input('sector', [])) ? 'checked' : ''); ?>>
                      <span><?php echo e(__('Services locaux')); ?></span>
                    </label>
                    <label class="filter-checkbox-item">
                      <input type="checkbox" name="sector[]" value="associations-ong" <?php echo e(in_array('associations-ong', (array)request()->input('sector', [])) ? 'checked' : ''); ?>>
                      <span><?php echo e(__('Associations / ONG')); ?></span>
                    </label>
                    <label class="filter-checkbox-item">
                      <input type="checkbox" name="sector[]" value="autres" <?php echo e(in_array('autres', (array)request()->input('sector', [])) ? 'checked' : ''); ?>>
                      <span><?php echo e(__('Autres')); ?></span>
                    </label>
                  </div>
                </div>
              </div>

              <!-- TYPE DE MISSION -->
              <div class="filter-section">
                <h4 class="filter-title"><?php echo e(__('TYPE DE MISSION')); ?></h4>
                <div class="filter-content">
                  <div class="filter-checkboxes">
                    <label class="filter-checkbox-item">
                      <input type="checkbox" name="mission_type[]" value="one-shot" <?php echo e(in_array('one-shot', (array)request()->input('mission_type', [])) ? 'checked' : ''); ?>>
                      <span><?php echo e(__('Projet unique (one-shot)')); ?></span>
                    </label>
                    <label class="filter-checkbox-item">
                      <input type="checkbox" name="mission_type[]" value="long-term" <?php echo e(in_array('long-term', (array)request()->input('mission_type', [])) ? 'checked' : ''); ?>>
                      <span><?php echo e(__('Accompagnement long terme')); ?></span>
                    </label>
                    <label class="filter-checkbox-item">
                      <input type="checkbox" name="mission_type[]" value="maintenance" <?php echo e(in_array('maintenance', (array)request()->input('mission_type', [])) ? 'checked' : ''); ?>>
                      <span><?php echo e(__('Maintenance / optimisation continue')); ?></span>
                    </label>
                  </div>
                </div>
              </div>

              <!-- Bouton Réinitialiser -->
              <div class="filter-section">
                <button type="button" class="filter-reset-btn" id="reset-filters">
                  <?php echo e(__('Réinitialiser')); ?>

                </button>
              </div>

            </form>
          </div>
        </aside>

        <!-- ============================================
             CONTENU PRINCIPAL (CARTES FREELANCES)
             ============================================ -->
        <main class="freelancers-main-premium">
          <!-- Bouton Filtrer Mobile -->
          <button class="filter-mobile-btn" id="filter-mobile-btn">
            <i class="fas fa-filter"></i> <?php echo e(__('Filtrer')); ?>

          </button>

          <!-- Liste des freelances -->
          <div class="freelancers-list-premium" id="freelancers-list">
            <?php if(count($sellers) > 0): ?>
              <?php $__currentLoopData = $sellers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $seller): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php echo $__env->make('frontend.seller.partials.freelancer-card-premium', ['seller' => $seller], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php else: ?>
              <div class="freelancers-empty">
                <h3><?php echo e(__('Aucun freelance trouvé')); ?></h3>
                <p><?php echo e(__('Essayez de modifier vos critères de recherche.')); ?></p>
              </div>
            <?php endif; ?>
          </div>

          <!-- Pagination -->
          <?php if(count($sellers) > 0): ?>
            <div class="freelancers-pagination">
              <?php echo e($sellers->appends(request()->query())->links()); ?>

            </div>
          <?php endif; ?>
        </main>

      </div>
    </div>
  </div>

  <!-- Section "Pourquoi Junspro" -->
  <?php echo $__env->make('frontend.seller.partials.why-junspro-section', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
<script src="<?php echo e(asset('assets/front/js/freelancers-premium.js')); ?>?v=<?php echo e(time()); ?>"></script>
<?php $__env->stopSection(); ?>





<?php echo $__env->make('frontend.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\younes\Downloads\junspro-main (1)\junspro-main3\resources\views\frontend\seller\index-premium.blade.php ENDPATH**/ ?>