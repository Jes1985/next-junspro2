

<?php $__env->startSection('pageHeading'); ?>
  <?php echo e($seller->username); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('metaKeywords'); ?>
  <?php echo e($seller->username); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('metaDescription'); ?>
  <?php echo e(@$sellerInfo->details); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('style'); ?>
<link rel="stylesheet" href="<?php echo e(asset('assets/front/css/freelancers-premium.css')); ?>?v=<?php echo e(time()); ?>">
<link rel="stylesheet" href="<?php echo e(asset('assets/front/css/freelancer-profile-premium.css')); ?>?v=<?php echo e(time()); ?>">
<style>
  /* Styles inline additionnels si nécessaire */
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
  
  

  <?php
    $avgRating = SellerAvgRating($seller->id);
    $orderCount = $order_completed ?? 0;
    $serviceCount = count($all_services ?? []);
    $followerCount = \App\Models\Follower::where('following_id', $seller->id)->count();
    
    // Récupérer les avis
    $reviews = [];
    if (isset($all_services)) {
      foreach ($all_services as $service) {
        $serviceReviews = \App\Models\ClientService\ServiceReview::where('service_id', $service->id)
          ->with('user')
          ->get();
        foreach ($serviceReviews as $review) {
          $reviews[] = $review;
        }
      }
    }
    $reviewsCount = count($reviews);
    
    // Prix minimum
    $lowestPrice = isset($all_services) && count($all_services) > 0 
      ? min(array_filter(array_column($all_services->toArray(), 'package_lowest_price'))) 
      : null;
  ?>

  <!-- ============================================
       HERO / HEADER
       ============================================ -->
  <section class="freelancer-profile-hero">
    <div class="freelancer-profile-hero-container">
      <div class="freelancer-profile-hero-content">
        <div class="freelancer-profile-hero-left">
          <!-- Visuel principal (vidéo ou image) -->
          <div class="freelancer-profile-media">
            <?php if($sellerInfo && $sellerInfo->video_url): ?>
              <div class="freelancer-profile-video-wrapper">
                <img class="freelancer-profile-video-thumbnail" 
                     src="<?php echo e(asset('assets/img/video-placeholder.jpg')); ?>" 
                     alt="Vidéo de présentation">
                <button class="freelancer-profile-play-btn" data-video-url="<?php echo e($sellerInfo->video_url); ?>">
                  <svg width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <polygon points="5 3 19 12 5 21 5 3"></polygon>
                  </svg>
                </button>
                <div class="freelancer-profile-video-label">
                  <?php echo e(__('Lire la vidéo de présentation')); ?>

                </div>
              </div>
            <?php else: ?>
              <div class="freelancer-profile-image-wrapper">
                <img class="freelancer-profile-image" 
                     src="<?php echo e(asset('assets/img/project-showcase.jpg')); ?>" 
                     alt="Projets réalisés">
              </div>
            <?php endif; ?>
          </div>
        </div>

        <div class="freelancer-profile-hero-right">
          <!-- Bloc "Démarrer un projet" -->
          <div class="freelancer-profile-cta-box">
            <div class="freelancer-profile-name-section">
              <h1 class="freelancer-profile-name">
                <?php echo e($sellerInfo && $sellerInfo->name ? $sellerInfo->name : $seller->username); ?>

              </h1>
              <?php if($sellerInfo && $sellerInfo->country): ?>
                <p class="freelancer-profile-location">
                  <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                    <circle cx="12" cy="10" r="3"></circle>
                  </svg>
                  <?php echo e($sellerInfo->country); ?>

                </p>
              <?php endif; ?>
            </div>

            <!-- Stats en ligne -->
            <div class="freelancer-profile-stats-inline">
              <div class="freelancer-profile-stat-item">
                <span class="stat-icon">⭐</span>
                <span class="stat-value"><?php echo e(number_format($avgRating, 1)); ?>/5</span>
                <span class="stat-label"><?php echo e($reviewsCount); ?> <?php echo e(__('avis')); ?></span>
              </div>
              <div class="freelancer-profile-stat-item">
                <span class="stat-icon">📁</span>
                <span class="stat-value"><?php echo e($orderCount); ?></span>
                <span class="stat-label"><?php echo e(__('projets livrés')); ?></span>
              </div>
              <div class="freelancer-profile-stat-item">
                <span class="stat-icon">💶</span>
                <span class="stat-value">
                  <?php if($lowestPrice): ?>
                    <?php echo e(__('À partir de')); ?> <?php echo e(number_format($lowestPrice, 0, ',', ' ')); ?> €
                  <?php else: ?>
                    <?php echo e(__('Sur devis')); ?>

                  <?php endif; ?>
                </span>
              </div>
            </div>

            <!-- Boutons CTA -->
            <div class="freelancer-profile-cta-buttons">
              <a href="#contact-form" class="freelancer-profile-cta-primary">
                <?php echo e(__('Lancer un projet')); ?> / <?php echo e(__('Demander un devis')); ?>

              </a>
              <div class="freelancer-profile-cta-secondary-group">
                <a href="#contact-form" class="freelancer-profile-cta-secondary">
                  <?php echo e(__('Envoyer un message')); ?>

                </a>
                <button class="freelancer-profile-cta-secondary" id="save-freelancer-btn">
                  <?php echo e(__('Sauvegarder dans ma liste')); ?>

                </button>
                <button class="freelancer-profile-cta-secondary" id="share-profile-btn">
                  <?php echo e(__('Partager le profil')); ?>

                </button>
              </div>
            </div>

            <!-- Bloc Confiance -->
            <div class="freelancer-profile-trust-box">
              <div class="trust-item">
                <strong><?php echo e(__('Super populaire')); ?></strong> : <?php echo e(rand(10, 50)); ?> <?php echo e(__('nouveaux contacts et')); ?> <?php echo e(rand(5, 30)); ?> <?php echo e(__('projets démarrés ces 30 derniers jours')); ?>

              </div>
              <div class="trust-item">
                <strong><?php echo e(__('Temps de réponse moyen')); ?></strong> : ~<?php echo e(rand(1, 6)); ?>h
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- ============================================
       AGENDA & DISPONIBILITÉS
       ============================================ -->
  <section class="freelancer-profile-agenda" id="agenda">
    <div class="freelancer-profile-container">
      <div class="freelancer-profile-agenda-content">
        <!-- Bandeau d'info -->
        <div class="freelancer-profile-agenda-info">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <circle cx="12" cy="12" r="10"></circle>
            <line x1="12" y1="16" x2="12" y2="12"></line>
            <line x1="12" y1="8" x2="12.01" y2="8"></line>
          </svg>
          <p><?php echo e(__('Sélectionnez l\'horaire de votre appel découverte ou de votre première séance de travail. Les heures sont affichées dans votre fuseau horaire.')); ?></p>
        </div>

        <div class="freelancer-profile-agenda-layout">
          <!-- Contrôles -->
          <div class="freelancer-profile-agenda-controls">
            <button class="agenda-nav-btn" id="agenda-prev-week">
              <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <polyline points="15 18 9 12 15 6"></polyline>
              </svg>
            </button>
            <div class="agenda-week-display" id="agenda-week-display">
              <?php echo e(__('11–17 déc. 2025')); ?>

            </div>
            <button class="agenda-nav-btn" id="agenda-next-week">
              <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <polyline points="9 18 15 12 9 6"></polyline>
              </svg>
            </button>
            <select class="agenda-timezone-select" id="agenda-timezone">
              <option value="Europe/Paris" selected>Europe/Paris (GMT+1)</option>
              <option value="Europe/London">Europe/London (GMT+0)</option>
              <option value="America/New_York">America/New_York (GMT-5)</option>
            </select>
          </div>

          <!-- Tableau agenda -->
          <div class="freelancer-profile-agenda-table">
            <div class="agenda-days-header">
              <div class="agenda-day-header"><?php echo e(__('Jeu')); ?></div>
              <div class="agenda-day-header"><?php echo e(__('Ven')); ?></div>
              <div class="agenda-day-header"><?php echo e(__('Sam')); ?></div>
              <div class="agenda-day-header"><?php echo e(__('Dim')); ?></div>
              <div class="agenda-day-header"><?php echo e(__('Lun')); ?></div>
              <div class="agenda-day-header"><?php echo e(__('Mar')); ?></div>
              <div class="agenda-day-header"><?php echo e(__('Mer')); ?></div>
            </div>
            <div class="agenda-slots-container">
              <?php for($day = 0; $day < 7; $day++): ?>
                <div class="agenda-day-slots">
                  <?php for($hour = 7; $hour < 20; $hour += 1.5): ?>
                    <button class="agenda-slot-btn" 
                            data-day="<?php echo e($day); ?>" 
                            data-hour="<?php echo e($hour); ?>">
                      <?php echo e(str_pad(floor($hour), 2, '0', STR_PAD_LEFT)); ?>:<?php echo e(str_pad(($hour - floor($hour)) * 60, 2, '0', STR_PAD_LEFT)); ?>

                    </button>
                  <?php endfor; ?>
                </div>
              <?php endfor; ?>
            </div>
          </div>
        </div>

        <!-- Bloc CTA sticky (desktop) -->
        <div class="freelancer-profile-agenda-cta-sticky">
          <div class="agenda-cta-box">
            <h4><?php echo e(__('Prêt à démarrer ?')); ?></h4>
            <a href="#contact-form" class="agenda-cta-btn"><?php echo e(__('Lancer un projet')); ?></a>
            <a href="#contact-form" class="agenda-cta-btn-secondary"><?php echo e(__('Envoyer un message')); ?></a>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- ============================================
       PROFIL IDÉAL POUR…
       ============================================ -->
  <section class="freelancer-profile-ideal">
    <div class="freelancer-profile-container">
      <h2 class="freelancer-profile-section-title"><?php echo e(__('Profil idéal pour…')); ?></h2>
      <div class="freelancer-profile-ideal-cards">
        <div class="ideal-card">
          <div class="ideal-card-icon">🚀</div>
          <h3 class="ideal-card-title"><?php echo e(__('Lancements d\'offres / programmes en ligne')); ?></h3>
        </div>
        <div class="ideal-card">
          <div class="ideal-card-icon">🎨</div>
          <h3 class="ideal-card-title"><?php echo e(__('Refonte de site & tunnels de vente')); ?></h3>
        </div>
        <div class="ideal-card">
          <div class="ideal-card-icon">📈</div>
          <h3 class="ideal-card-title"><?php echo e(__('Optimisation des conversions')); ?></h3>
        </div>
        <div class="ideal-card">
          <div class="ideal-card-icon">✨</div>
          <h3 class="ideal-card-title"><?php echo e(__('Branding & repositionnement')); ?></h3>
        </div>
      </div>
    </div>
  </section>

  <!-- ============================================
       À PROPOS DE MOI
       ============================================ -->
  <section class="freelancer-profile-about">
    <div class="freelancer-profile-container">
      <h2 class="freelancer-profile-section-title"><?php echo e(__('À propos de moi')); ?></h2>
      <div class="freelancer-profile-about-content">
        <?php if($sellerInfo && $sellerInfo->details): ?>
          <div class="freelancer-profile-about-text" id="about-text">
            <?php echo nl2br($sellerInfo->details); ?>

          </div>
          <?php if(strlen($sellerInfo->details) > 500): ?>
            <button class="freelancer-profile-about-toggle" id="about-toggle">
              <?php echo e(__('Voir plus')); ?>

            </button>
          <?php endif; ?>
        <?php else: ?>
          <p class="freelancer-profile-about-text"><?php echo e(__('Aucune description disponible.')); ?></p>
        <?php endif; ?>
      </div>
    </div>
  </section>

  <!-- ============================================
       MES OFFRES & PACKS DE PROJETS
       ============================================ -->
  <section class="freelancer-profile-packs">
    <div class="freelancer-profile-container">
      <h2 class="freelancer-profile-section-title"><?php echo e(__('Mes offres & packs de projets')); ?></h2>
      <div class="freelancer-profile-packs-grid">
        <?php if(isset($all_services) && count($all_services) > 0): ?>
          <?php $__currentLoopData = $all_services->take(4); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php
              $serviceContent = \App\Models\ClientService\ServiceContent::where([
                ['service_id', $service->id],
                ['language_id', $language->id ?? 1]
              ])->first();
              
              $packages = \App\Models\ClientService\Package::where([
                ['service_id', $service->id],
                ['language_id', $language->id ?? 1]
              ])->orderBy('current_price', 'asc')->get();
              
              $lowestPackagePrice = $packages->min('current_price') ?? $service->package_lowest_price;
            ?>
            <div class="freelancer-profile-pack-card">
              <h3 class="pack-card-title"><?php echo e($serviceContent ? $serviceContent->title : $service->title); ?></h3>
              <div class="pack-card-includes">
                <strong><?php echo e(__('Comprend')); ?> :</strong>
                <ul>
                  <li><?php echo e(__('Analyse & stratégie')); ?></li>
                  <li><?php echo e(__('Conception & design')); ?></li>
                  <li><?php echo e(__('Intégration & développement')); ?></li>
                  <li><?php echo e(__('Révisions illimitées')); ?></li>
                </ul>
              </div>
              <div class="pack-card-delivery">
                <strong><?php echo e(__('Délai estimé')); ?></strong> : <?php echo e(__('7 à 10 jours ouvrés')); ?>

              </div>
              <div class="pack-card-price">
                <?php if($lowestPackagePrice): ?>
                  <?php echo e(__('À partir de')); ?> <?php echo e(number_format($lowestPackagePrice, 0, ',', ' ')); ?> €
                <?php else: ?>
                  <?php echo e(__('Sur devis')); ?>

                <?php endif; ?>
              </div>
              <a href="<?php echo e(route('service_details', ['slug' => $service->slug, 'id' => $service->id])); ?>" 
                 class="pack-card-cta">
                <?php echo e(__('Démarrer ce projet')); ?>

              </a>
            </div>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php else: ?>
          <p class="freelancer-profile-empty"><?php echo e(__('Aucun pack disponible pour le moment.')); ?></p>
        <?php endif; ?>
      </div>
    </div>
  </section>

  <!-- ============================================
       PROCESSUS DE TRAVAIL
       ============================================ -->
  <section class="freelancer-profile-process">
    <div class="freelancer-profile-container">
      <h2 class="freelancer-profile-section-title"><?php echo e(__('Comment je travaille avec vous')); ?></h2>
      <div class="freelancer-profile-process-timeline">
        <div class="process-step">
          <div class="process-step-icon">1️⃣</div>
          <h3 class="process-step-title"><?php echo e(__('Appel découverte & brief')); ?></h3>
          <p class="process-step-description">
            <?php echo e(__('Nous échangeons sur vos besoins, vos objectifs et votre vision du projet.')); ?>

          </p>
        </div>
        <div class="process-step">
          <div class="process-step-icon">2️⃣</div>
          <h3 class="process-step-title"><?php echo e(__('Proposition détaillée & validation')); ?></h3>
          <p class="process-step-description">
            <?php echo e(__('Je vous envoie une proposition complète avec planning, livrables et tarifs.')); ?>

          </p>
        </div>
        <div class="process-step">
          <div class="process-step-icon">3️⃣</div>
          <h3 class="process-step-title"><?php echo e(__('Production & retours')); ?></h3>
          <p class="process-step-description">
            <?php echo e(__('Je réalise le projet étape par étape avec vos retours à chaque phase.')); ?>

          </p>
        </div>
        <div class="process-step">
          <div class="process-step-icon">4️⃣</div>
          <h3 class="process-step-title"><?php echo e(__('Livraison finale & suivi / optimisation')); ?></h3>
          <p class="process-step-description">
            <?php echo e(__('Je livre le projet finalisé et assure un suivi pour optimiser les résultats.')); ?>

          </p>
        </div>
      </div>
    </div>
  </section>

  <!-- ============================================
       COMPÉTENCES, LANGUES, OUTILS & SPÉCIALISATIONS
       ============================================ -->
  <section class="freelancer-profile-skills">
    <div class="freelancer-profile-container">
      <h2 class="freelancer-profile-section-title"><?php echo e(__('Compétences, langues, outils & spécialisations')); ?></h2>
      
      <!-- Compétences -->
      <div class="freelancer-profile-skills-section">
        <h3 class="skills-section-title"><?php echo e(__('Compétences')); ?></h3>
        <div class="skills-tags">
          <?php if(isset($skills) && $sellerInfo && $sellerInfo->skills): ?>
            <?php
              $selectedSkills = json_decode($sellerInfo->skills, true) ?? [];
            ?>
            <?php $__currentLoopData = $skills; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $skill): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <?php if(in_array($skill->id, $selectedSkills)): ?>
                <span class="skill-tag"><?php echo e($skill->name); ?></span>
              <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          <?php endif; ?>
          <span class="skill-tag">Copywriting</span>
          <span class="skill-tag">UX writing</span>
          <span class="skill-tag">Email marketing</span>
          <span class="skill-tag">Webflow</span>
          <span class="skill-tag">Figma</span>
          <span class="skill-tag">Ads</span>
          <span class="skill-tag">Automatisation</span>
        </div>
      </div>

      <!-- Langues -->
      <div class="freelancer-profile-skills-section">
        <h3 class="skills-section-title"><?php echo e(__('Langues')); ?></h3>
        <div class="languages-list">
          <div class="language-item">
            <span class="language-name">Français</span>
            <span class="language-level">C2</span>
          </div>
          <div class="language-item">
            <span class="language-name">English</span>
            <span class="language-level">C1</span>
          </div>
        </div>
      </div>

      <!-- Outils -->
      <div class="freelancer-profile-skills-section">
        <h3 class="skills-section-title"><?php echo e(__('Outils')); ?></h3>
        <div class="tools-tags">
          <span class="tool-tag">Notion</span>
          <span class="tool-tag">ClickUp</span>
          <span class="tool-tag">Make</span>
          <span class="tool-tag">Zapier</span>
          <span class="tool-tag">Webflow</span>
          <span class="tool-tag">Figma</span>
        </div>
      </div>

      <!-- Spécialisations (accordéons) -->
      <div class="freelancer-profile-skills-section">
        <h3 class="skills-section-title"><?php echo e(__('Spécialisations')); ?></h3>
        <div class="specializations-accordion">
          <div class="specialization-item">
            <button class="specialization-toggle">
              <span><?php echo e(__('Pages de vente & tunnels')); ?></span>
              <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <polyline points="6 9 12 15 18 9"></polyline>
              </svg>
            </button>
            <div class="specialization-content">
              <p><strong><?php echo e(__('Types de missions')); ?></strong> : Landing pages, tunnels de vente, pages de capture</p>
              <p><strong><?php echo e(__('Exemples de résultats')); ?></strong> : +300% de conversions, tunnel optimisé</p>
              <p><strong><?php echo e(__('Fourchette de prix')); ?></strong> : 500€ - 3000€ / projet</p>
            </div>
          </div>
          <div class="specialization-item">
            <button class="specialization-toggle">
              <span><?php echo e(__('Email marketing & séquences')); ?></span>
              <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <polyline points="6 9 12 15 18 9"></polyline>
              </svg>
            </button>
            <div class="specialization-content">
              <p><strong><?php echo e(__('Types de missions')); ?></strong> : Séquences de lancement, newsletters, automations</p>
              <p><strong><?php echo e(__('Exemples de résultats')); ?></strong> : +25% d'ouverture, +15% de clics</p>
              <p><strong><?php echo e(__('Fourchette de prix')); ?></strong> : 300€ - 1500€ / séquence</p>
            </div>
          </div>
          <div class="specialization-item">
            <button class="specialization-toggle">
              <span><?php echo e(__('Branding & identité')); ?></span>
              <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <polyline points="6 9 12 15 18 9"></polyline>
              </svg>
            </button>
            <div class="specialization-content">
              <p><strong><?php echo e(__('Types de missions')); ?></strong> : Logo, charte graphique, identité visuelle</p>
              <p><strong><?php echo e(__('Exemples de résultats')); ?></strong> : Identité cohérente, repositionnement réussi</p>
              <p><strong><?php echo e(__('Fourchette de prix')); ?></strong> : 800€ - 5000€ / projet</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- ============================================
       CV & CERTIFICATIONS
       ============================================ -->
  <section class="freelancer-profile-cv">
    <div class="freelancer-profile-container">
      <div class="freelancer-profile-cv-tabs">
        <button class="cv-tab-btn active" data-tab="experience">
          <?php echo e(__('Expérience professionnelle')); ?>

        </button>
        <button class="cv-tab-btn" data-tab="certifications">
          <?php echo e(__('Certifications')); ?>

        </button>
      </div>

      <div class="freelancer-profile-cv-content">
        <!-- Expérience -->
        <div class="cv-tab-pane active" id="cv-experience">
          <div class="cv-timeline">
            <div class="cv-timeline-item">
              <div class="cv-timeline-date">2024 — 2025</div>
              <div class="cv-timeline-content">
                <h4 class="cv-timeline-company"><?php echo e(__('Freelance indépendant')); ?></h4>
                <p class="cv-timeline-role"><?php echo e(__('Copywriter funnel & email')); ?></p>
                <p class="cv-timeline-description">
                  <?php echo e(__('Création de tunnels de vente et séquences email pour des clients dans le secteur du coaching et de l\'infopreneuriat.')); ?>

                </p>
              </div>
            </div>
            <div class="cv-timeline-item">
              <div class="cv-timeline-date">2022 — 2024</div>
              <div class="cv-timeline-content">
                <h4 class="cv-timeline-company"><?php echo e(__('Agence Marketing Digital')); ?></h4>
                <p class="cv-timeline-role"><?php echo e(__('Responsable Copywriting')); ?></p>
                <p class="cv-timeline-description">
                  <?php echo e(__('Direction d\'une équipe de 3 copywriters et création de contenus pour des clients e-commerce.')); ?>

                </p>
              </div>
            </div>
          </div>
        </div>

        <!-- Certifications -->
        <div class="cv-tab-pane" id="cv-certifications">
          <div class="cv-certifications-list">
            <div class="cv-certification-item">
              <div class="certification-icon">🎓</div>
              <div class="certification-content">
                <h4 class="certification-title"><?php echo e(__('Master en Marketing Digital')); ?></h4>
                <p class="certification-issuer"><?php echo e(__('Université Paris-Dauphine')); ?> • 2021</p>
              </div>
            </div>
            <div class="cv-certification-item">
              <div class="certification-icon">🏆</div>
              <div class="certification-content">
                <h4 class="certification-title"><?php echo e(__('Certification Google Ads')); ?></h4>
                <p class="certification-issuer"><?php echo e(__('Google')); ?> • 2022</p>
              </div>
            </div>
            <div class="cv-certification-item">
              <div class="certification-icon">⭐</div>
              <div class="certification-content">
                <h4 class="certification-title"><?php echo e(__('Top Junspro Freelance')); ?></h4>
                <p class="certification-issuer"><?php echo e(__('Junspro')); ?> • 2024</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- ============================================
       AVIS DES CLIENTS
       ============================================ -->
  <section class="freelancer-profile-reviews">
    <div class="freelancer-profile-container">
      <div class="freelancer-profile-reviews-header">
        <div>
          <h2 class="freelancer-profile-section-title"><?php echo e(__('L\'avis de mes clients')); ?></h2>
          <p class="freelancer-profile-reviews-subtitle">
            <?php echo e(__('D\'après')); ?> <?php echo e($reviewsCount); ?> <?php echo e(__('avis vérifiés')); ?>

          </p>
        </div>
        <div class="freelancer-profile-reviews-rating">
          <div class="reviews-rating-number"><?php echo e(number_format($avgRating, 1)); ?></div>
          <div class="reviews-rating-stars">
            <?php for($i = 0; $i < 5; $i++): ?>
              <span class="star <?php echo e($i < floor($avgRating) ? 'filled' : ''); ?>">⭐</span>
            <?php endfor; ?>
          </div>
        </div>
      </div>

      <div class="freelancer-profile-reviews-grid">
        <?php if(count($reviews) > 0): ?>
          <?php $__currentLoopData = $reviews->take(6); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $review): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="freelancer-profile-review-card">
              <div class="review-card-header">
                <div class="review-card-avatar">
                  <?php if($review->user && $review->user->image): ?>
                    <img src="<?php echo e(asset('assets/img/users/' . $review->user->image)); ?>" alt="<?php echo e($review->user->username); ?>">
                  <?php else: ?>
                    <div class="review-card-avatar-initial">
                      <?php echo e(strtoupper(substr($review->user->username ?? 'A', 0, 1))); ?>

                    </div>
                  <?php endif; ?>
                </div>
                <div class="review-card-info">
                  <div class="review-card-name"><?php echo e($review->user->username ?? __('Anonyme')); ?></div>
                  <div class="review-card-date"><?php echo e(\Carbon\Carbon::parse($review->created_at)->format('d/m/Y')); ?></div>
                </div>
                <div class="review-card-rating">
                  <?php for($i = 0; $i < 5; $i++): ?>
                    <span class="star <?php echo e($i < $review->rating ? 'filled' : ''); ?>">⭐</span>
                  <?php endfor; ?>
                </div>
              </div>
              <div class="review-card-content">
                <p><?php echo e($review->comment); ?></p>
              </div>
            </div>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php else: ?>
          <p class="freelancer-profile-empty"><?php echo e(__('Aucun avis pour le moment.')); ?></p>
        <?php endif; ?>
      </div>
    </div>
  </section>

  <!-- ============================================
       AUTRES FREELANCES RECOMMANDÉS
       ============================================ -->
  <section class="freelancer-profile-recommended">
    <div class="freelancer-profile-container">
      <h2 class="freelancer-profile-section-title"><?php echo e(__('Ces freelances pourraient aussi vous intéresser')); ?></h2>
      <div class="freelancer-profile-recommended-grid">
        <?php
          $recommendedSellers = \App\Models\Seller::where('id', '!=', $seller->id)
            ->where('status', 1)
            ->limit(4)
            ->get();
        ?>
        <?php $__currentLoopData = $recommendedSellers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $recommendedSeller): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <?php echo $__env->make('frontend.seller.partials.freelancer-card-compact', ['seller' => $recommendedSeller], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </div>
    </div>
  </section>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
<script src="<?php echo e(asset('assets/front/js/freelancer-profile-premium.js')); ?>?v=<?php echo e(time()); ?>"></script>
<?php $__env->stopSection(); ?>





<?php echo $__env->make('frontend.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\younes\Downloads\junspro-main (1)\junspro-main3\resources\views\frontend\seller\details-premium.blade.php ENDPATH**/ ?>