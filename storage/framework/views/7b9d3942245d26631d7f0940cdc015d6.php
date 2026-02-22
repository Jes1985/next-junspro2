<?php
  $referralLink = route('referral.track', ['code' => $referralCode]);
  // Chemins possibles pour l'image hero (vérifier plusieurs emplacements et noms)
  $possiblePaths = [
    // Emplacements standards dans public/images/
    public_path('images/parrainage-hero.png'),
    public_path('images/parrainage-hero.jpg'),
    public_path('images/parrainage-hero.jpeg'),
    // Cas avec double point dans public/images/ (erreur de nommage courante)
    public_path('images/parrainage-hero..png'),
    public_path('images/parrainage-hero..jpg'),
    // Emplacements alternatifs dans public/assets/img/
    public_path('assets/img/parrainage-hero.png'),
    public_path('assets/img/parrainage-hero.jpg'),
    public_path('assets/img/parrainage-hero.jpeg'),
    // Emplacement direct dans public/ (cas où l'image est à la racine)
    public_path('parrainage-hero.png'),
    public_path('parrainage-hero.jpg'),
    public_path('parrainage-hero.jpeg'),
    // Cas avec double point directement dans public/
    public_path('parrainage-hero..png'),
    public_path('parrainage-hero..jpg'),
  ];
  
  $heroImagePath = null;
  $heroImageExists = false;
  
  foreach ($possiblePaths as $path) {
    if (file_exists($path)) {
      $heroImageExists = true;
      // Convertir le chemin absolu en chemin relatif pour le navigateur
      $relativePath = str_replace(public_path(), '', $path);
      $heroImagePath = str_replace('\\', '/', $relativePath); // Normaliser les slashes
      // S'assurer que le chemin commence par /
      if (!str_starts_with($heroImagePath, '/')) {
        $heroImagePath = '/' . $heroImagePath;
      }
      break;
    }
  }
  
  // Si aucune image trouvée, utiliser le placeholder
  if (!$heroImageExists) {
    $heroImagePath = asset('assets/img/parrainage-hero-placeholder.svg');
  }
  
  $heroImagePlaceholder = asset('assets/img/parrainage-hero-placeholder.svg');
  
  // Debug : pour vérifier quel chemin est utilisé (à retirer en production)
  // Log::info('Hero image path: ' . $heroImagePath);
  // Log::info('Hero image exists: ' . ($heroImageExists ? 'yes' : 'no'));
?>

<section class="ref-hero">
  <div class="ref-hero__container">
    
    <div class="ref-hero__left">
      <div class="ref-hero__content">
        <div class="ref-hero__badge"><?php echo e(__('Faites passer le mot.')); ?></div>
        <h1 class="ref-hero__title">
          <?php echo e(__('Invitez un proche à rejoindre l\'écosystème Junspro, recevez :amount€', ['amount' => $config['reward_amount']])); ?>

        </h1>
        <p class="ref-hero__text">
          <?php echo e(__('Chez Junspro, on ne réserve pas "juste une prestation". On met en place un cadre d\'exécution : discipline, suivi, sécurité — pour des projets qui avancent vraiment.')); ?>

          <br><br>
          <?php echo e(__('Invitez vos proches : ils bénéficient de :benefit_label sur leur première réservation éligible, et vous recevez :amount€ en crédit Junspro dès que la première prestation est confirmée.', [
            'benefit_label' => $config['benefit_label'],
            'amount' => $config['reward_amount']
          ])); ?>

        </p>
        <div class="ref-hero__actions">
          <button 
            type="button"
            class="ref-hero__cta"
            onclick="window.dispatchEvent(new CustomEvent('openInviteModal'))"
          >
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path>
            </svg>
            <?php echo e(__('Inviter des amis')); ?>

          </button>
        </div>
        <p class="ref-hero__micro">
          <?php echo e(__('Offre valable dès :amount€ de prestation. Récompense versée après prestation payée et non annulée.', ['amount' => $config['min_eligible_amount']])); ?>

        </p>
      </div>
    </div>
    
    
    <div class="ref-hero__right">
      <?php if($heroImageExists): ?>
        <img 
          src="<?php echo e($heroImagePath); ?>" 
          alt="<?php echo e(__('Deux personnes en séance de coaching / collaboration, ambiance chaleureuse.')); ?>"
          class="ref-hero__image"
          loading="lazy"
          decoding="async"
          onerror="console.error('Image failed to load: <?php echo e($heroImagePath); ?>'); this.src='<?php echo e($heroImagePlaceholder); ?>'; this.onerror=null;"
        />
      <?php else: ?>
        <img 
          src="<?php echo e($heroImagePlaceholder); ?>" 
          alt="<?php echo e(__('Parrainage Junspro')); ?>"
          class="ref-hero__image"
          loading="lazy"
        />
      <?php endif; ?>
      <div class="ref-hero__overlay"></div>
    </div>
  </div>
</section>

<?php /**PATH C:\Users\younes\Downloads\junspro-main (1)\junspro-main3\resources\views\components\referral\hero-split.blade.php ENDPATH**/ ?>