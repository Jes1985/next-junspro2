<?php
  $sellerInfo = \App\Models\SellerInfo::where('seller_id', $seller->sellerId)->first();
  $avgRating = SellerAvgRating($seller->sellerId);
  $serviceCount = \App\Models\ClientService\Service::where([['seller_id', $seller->sellerId], ['service_status', 1]])->count();
  $orderCount = \App\Models\ClientService\ServiceOrder::where([['seller_id', $seller->sellerId], ['order_status', 'completed']])->count();
  $followerCount = \App\Models\Follower::where('following_id', $seller->sellerId)->count();
  
  // Badge
  $badge = null;
  if ($seller->is_featured == 1) {
    $badge = 'top';
  } elseif ($seller->status == 1 && $avgRating >= 4.5) {
    $badge = 'verified';
  } elseif ($orderCount < 5) {
    $badge = 'new';
  }
  
  // Prix
  $lowestPrice = \App\Models\ClientService\Service::where([['seller_id', $seller->sellerId], ['service_status', 1]])
    ->min('package_lowest_price');
  $priceDisplay = $lowestPrice ? 'À partir de ' . number_format($lowestPrice, 0, ',', ' ') . ' € / projet' : 'Sur devis';
  
  // Pitch
  $pitch = $sellerInfo && $sellerInfo->details ? mb_substr(strip_tags($sellerInfo->details), 0, 120) . '...' : 'Freelance expert pour vos projets clés en main.';
?>

<div class="freelancer-card-wrapper" data-seller-id="<?php echo e($seller->sellerId); ?>">
  <!-- Carte principale -->
  <div class="freelancer-card-premium" data-seller-id="<?php echo e($seller->sellerId); ?>">
    <div class="freelancer-card-content">
      <!-- Colonne gauche : Photo + Badge -->
      <div class="freelancer-card-left">
        <div class="freelancer-photo-wrapper">
          <?php if(!is_null($seller->photo)): ?>
            <img class="freelancer-photo" 
                 src="<?php echo e(asset('assets/admin/img/seller-photo/' . $seller->photo)); ?>" 
                 alt="<?php echo e($seller->username); ?>">
          <?php else: ?>
            <img class="freelancer-photo" 
                 src="<?php echo e(asset('assets/img/seller-blank-user.jpg')); ?>" 
                 alt="<?php echo e($seller->username); ?>">
          <?php endif; ?>
          
          <?php if($badge): ?>
            <div class="freelancer-badge badge-<?php echo e($badge); ?>">
              <?php if($badge == 'top'): ?>
                <span>⭐ Top Junspro</span>
              <?php elseif($badge == 'verified'): ?>
                <span>✓ Vérifié</span>
              <?php elseif($badge == 'new'): ?>
                <span>✨ Nouveau talent</span>
              <?php endif; ?>
            </div>
          <?php endif; ?>
        </div>
      </div>

      <!-- Colonne centre : Infos principales -->
      <div class="freelancer-card-center">
        <div class="freelancer-name-section">
          <h3 class="freelancer-name">
            <a href="<?php echo e(route('frontend.seller.details', ['username' => $seller->username])); ?>" target="_self">
              <?php echo e($sellerInfo && $sellerInfo->name ? $sellerInfo->name : $seller->username); ?>

            </a>
          </h3>
          
          <?php if($sellerInfo && $sellerInfo->designation): ?>
            <div class="freelancer-badges">
              <span class="freelancer-badge-item badge-expert">Expert certifié</span>
              <span class="freelancer-badge-item badge-specialty"><?php echo e($sellerInfo->designation); ?></span>
            </div>
          <?php endif; ?>
        </div>

        <!-- Statistiques -->
        <div class="freelancer-stats">
          <span class="freelancer-stat-item">
            <span class="stat-icon">⭐</span>
            <span class="stat-value"><?php echo e(number_format($avgRating, 1)); ?>/5</span>
            <span class="stat-label"><?php echo e($orderCount); ?> <?php echo e(__('avis')); ?></span>
          </span>
          <span class="freelancer-stat-item">
            <span class="stat-icon">📁</span>
            <span class="stat-value"><?php echo e($orderCount); ?></span>
            <span class="stat-label"><?php echo e(__('projets livrés')); ?></span>
          </span>
          <span class="freelancer-stat-item">
            <span class="stat-icon">🔁</span>
            <span class="stat-value"><?php echo e($followerCount); ?></span>
            <span class="stat-label"><?php echo e(__('clients récurrents')); ?></span>
          </span>
        </div>

        <!-- Pitch -->
        <p class="freelancer-pitch">
          <?php echo e($pitch); ?>

        </p>

        <!-- Lien En savoir plus -->
        <a href="<?php echo e(route('frontend.seller.details', ['username' => $seller->username])); ?>" 
           class="freelancer-learn-more" target="_self">
          <?php echo e(__('En savoir plus')); ?> →
        </a>
      </div>

      <!-- Colonne droite : Abonnements + CTA -->
      <div class="freelancer-card-right">
        <div class="freelancer-pricing">
          <div class="pricing-label"><?php echo e(__('Pricing')); ?></div>
          <div class="pricing-value"><?php echo e($priceDisplay); ?></div>
        </div>

        <div class="freelancer-cta">
          <a href="<?php echo e(route('frontend.seller.details', ['username' => $seller->username])); ?>" 
             class="freelancer-cta-primary" target="_self">
            <?php echo e(__('Lancer un projet avec')); ?> <?php echo e($sellerInfo && $sellerInfo->name ? explode(' ', $sellerInfo->name)[0] : $seller->username); ?>

          </a>
          <a href="#" class="freelancer-cta-secondary" data-seller-id="<?php echo e($seller->sellerId); ?>">
            <?php echo e(__('Envoyer un message')); ?>

          </a>
        </div>

        <div class="freelancer-micro-text">
          <span class="micro-text-item">
            <?php echo e(__('Super populaire')); ?> : <?php echo e(rand(5, 50)); ?> <?php echo e(__('projets démarrés ces 30 derniers jours')); ?>

          </span>
          <span class="micro-text-item">
            <?php echo e(__('Temps moyen de réponse')); ?> : ~<?php echo e(rand(1, 6)); ?>h
          </span>
        </div>
      </div>
    </div>
  </div>

  <!-- Carte Quick View (apparaît au survol) -->
  <div class="freelancer-quick-view" data-seller-id="<?php echo e($seller->sellerId); ?>">
    <div class="quick-view-content">
      <!-- Vidéo / Visuel -->
      <div class="quick-view-media">
        <?php if($sellerInfo && $sellerInfo->video_url): ?>
          <div class="quick-view-video-wrapper">
            <img class="quick-view-thumbnail" 
                 src="<?php echo e(asset('assets/img/video-placeholder.jpg')); ?>" 
                 alt="Vidéo de présentation">
            <button class="quick-view-play-btn" data-video-url="<?php echo e($sellerInfo->video_url); ?>">
              <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <polygon points="5 3 19 12 5 21 5 3"></polygon>
              </svg>
            </button>
          </div>
        <?php else: ?>
          <div class="quick-view-image-wrapper">
            <img class="quick-view-image" 
                 src="<?php echo e(asset('assets/img/project-showcase.jpg')); ?>" 
                 alt="Projets réalisés">
          </div>
        <?php endif; ?>
      </div>

      <!-- Boutons d'action -->
      <div class="quick-view-actions">
        <a href="<?php echo e(route('frontend.seller.details', ['username' => $seller->username])); ?>#agenda" 
           class="quick-view-btn-primary" target="_self">
          <?php echo e(__('Voir les disponibilités')); ?>

        </a>
        <a href="<?php echo e(route('frontend.seller.details', ['username' => $seller->username])); ?>" 
           class="quick-view-btn-secondary" target="_self">
          <?php echo e(__('Voir le profil de')); ?> <?php echo e($sellerInfo && $sellerInfo->name ? explode(' ', $sellerInfo->name)[0] : $seller->username); ?>

        </a>
      </div>
    </div>
  </div>
</div>




<?php /**PATH C:\Users\younes\Downloads\junspro-main (1)\junspro-main3\resources\views\frontend\seller\partials\freelancer-card-premium.blade.php ENDPATH**/ ?>