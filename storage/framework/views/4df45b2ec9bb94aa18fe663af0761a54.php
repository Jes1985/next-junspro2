<!-- Footer Junspro Moderne -->
<footer class="junspro-footer">
  <!-- Bloc A : Contenu principal -->
  <div class="footer-main">
    <div class="container">
      <div class="row g-4">
        <!-- Colonne 1 : À propos -->
        <div class="col-lg-3 col-md-6 col-sm-6">
          <div class="footer-column">
            <h5 class="footer-title">JUNSPRO</h5>
            <p class="footer-about">
              Plateforme de mise en relation avec des freelances experts, disponibles à la semaine.
              Liberté, confiance, connaissance, sagesse, joie.
            </p>
          </div>
        </div>

        <!-- Colonne 2 : Liens utiles -->
        <div class="col-lg-2 col-md-6 col-sm-6">
          <div class="footer-column">
            <h5 class="footer-title"><?php echo e(__('Liens utiles')); ?></h5>
            <ul class="footer-links-list">
              <?php if(count($quickLinkInfos) > 0): ?>
                <?php $__currentLoopData = $quickLinkInfos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $quickLinkInfo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <li>
                    <?php
                      // Vérifier si l'URL est interne (commence par /) ou externe
                      $url = $quickLinkInfo->url;
                      $isInternal = strpos($url, '/') === 0 || strpos($url, url('/')) === 0;
                      // Si c'est une URL interne, retirer target="_blank"
                      $target = $isInternal ? '' : 'target="_blank"';
                    ?>
                    <a href="<?php echo e($url); ?>" <?php echo e($target); ?>><?php echo e($quickLinkInfo->title); ?></a>
                  </li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              <?php else: ?>
                
                <li><a href="<?php echo e(route('dynamic_page', ['slug' => 'cgu'])); ?>"><?php echo e(__('CGU')); ?></a></li>
                <li><a href="<?php echo e(route('dynamic_page', ['slug' => 'mentions-legales'])); ?>"><?php echo e(__('Mentions légales')); ?></a></li>
                <li><a href="<?php echo e(route('dynamic_page', ['slug' => 'termes-et-conditions'])); ?>"><?php echo e(__('Termes et conditions')); ?></a></li>
                <li><a href="<?php echo e(route('dynamic_page', ['slug' => 'politique-de-confidentialite'])); ?>"><?php echo e(__('Politique de confidentialité')); ?></a></li>
                <li><a href="<?php echo e(route('dynamic_page', ['slug' => 'conditions-generales-de-vente'])); ?>"><?php echo e(__('Conditions générales de vente')); ?></a></li>
              <?php endif; ?>
              <?php if(auth()->guard('web')->check()): ?>
                <li><a href="<?php echo e(route('referral.index')); ?>"><?php echo e(__('Parrainage')); ?></a></li>
              <?php endif; ?>
              <li><a href="<?php echo e(route('referral.conditions')); ?>"><?php echo e(__('Conditions du parrainage')); ?></a></li>
            </ul>
          </div>
        </div>

        <!-- Colonne 3 : Démarrer (avec Pause Souffle) -->
        <div class="col-lg-2 col-md-6 col-sm-6">
          <?php echo $__env->make('frontend.components.pause-souffle.footer-section-premium', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        </div>


        <!-- Colonne 4 : Newsletter -->
        <div class="col-lg-5 col-md-6 col-sm-6">
          <div class="footer-column">
            <h5 class="footer-title"><?php echo e(__('Restez informé')); ?></h5>
            <p class="footer-newsletter-text">
              <?php echo e(__('Recevez les nouveautés Junspro, les offres et des conseils pour mieux collaborer avec vos freelances.')); ?>

            </p>
            <form id="newsletterForm" action="<?php echo e(route('store_subscriber')); ?>" class="footer-newsletter-form" method="POST">
              <?php echo csrf_field(); ?>
              <div class="footer-newsletter-input-group">
                <input 
                  type="email" 
                  name="email_id" 
                  class="footer-newsletter-input" 
                  placeholder="<?php echo e(__('Votre adresse e-mail')); ?>"
                  required
                >
                <button type="submit" class="footer-newsletter-btn">
                  <?php echo e(__('S\'abonner')); ?>

                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Bloc B : Copyright et réseaux sociaux -->
  <div class="footer-bottom">
    <div class="container">
      <div class="footer-bottom-content">
        <div class="footer-copyright">
          <p>&copy; <?php echo e(date('Y')); ?> Junspro. <?php echo e(__('Tous droits réservés.')); ?></p>
        </div>
        <div class="footer-social">
          <?php if(count($socialMediaInfos) > 0): ?>
            <?php $__currentLoopData = $socialMediaInfos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $socialMediaInfo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <a href="<?php echo e($socialMediaInfo->url); ?>" target="_blank" class="footer-social-icon" aria-label="<?php echo e($socialMediaInfo->icon); ?>">
                <i class="<?php echo e($socialMediaInfo->icon); ?>"></i>
              </a>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          <?php else: ?>
            <!-- Icônes sociales par défaut -->
            <a href="#" target="_blank" class="footer-social-icon" aria-label="Facebook">
              <i class="fab fa-facebook-f"></i>
            </a>
            <a href="#" target="_blank" class="footer-social-icon" aria-label="LinkedIn">
              <i class="fab fa-linkedin-in"></i>
            </a>
            <a href="#" target="_blank" class="footer-social-icon" aria-label="Twitter">
              <i class="fab fa-x-twitter"></i>
            </a>
            <a href="#" target="_blank" class="footer-social-icon" aria-label="Instagram">
              <i class="fab fa-instagram"></i>
            </a>
            <a href="#" target="_blank" class="footer-social-icon" aria-label="YouTube">
              <i class="fab fa-youtube"></i>
            </a>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>
</footer>

<style>
  /* Footer Junspro Moderne - Style épuré bleu/violet */
  .junspro-footer {
    background: #050816;
    color: #E5E7EB;
    font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
    margin-bottom: 0 !important;
    padding-bottom: 0 !important;
  }

  /* Supprimer tout espace sous le footer */
  body:has(.junspro-footer),
  html:has(.junspro-footer),
  .main-wrapper:has(.junspro-footer) {
    padding-bottom: 0 !important;
    margin-bottom: 0 !important;
  }

  .junspro-footer * {
    margin-bottom: 0 !important;
  }

  .junspro-footer .footer-bottom,
  .junspro-footer .footer-bottom-content,
  .junspro-footer .footer-copyright,
  .junspro-footer .footer-social {
    margin-bottom: 0 !important;
    padding-bottom: 0 !important;
  }

  /* Supprimer tout espace après le footer */
  body:has(.junspro-footer),
  html:has(.junspro-footer),
  .main-wrapper:has(.junspro-footer) {
    padding-bottom: 0 !important;
    margin-bottom: 0 !important;
  }

  /* S'assurer qu'il n'y a pas d'espace après le footer-bottom */
  .junspro-footer .footer-bottom:last-child {
    margin-bottom: 0 !important;
    padding-bottom: 0 !important;
  }

  .junspro-footer .footer-bottom-content:last-child {
    margin-bottom: 0 !important;
    padding-bottom: 0 !important;
  }

  /* Bloc A : Contenu principal */
  .footer-main {
    padding: 60px 0 50px;
    background: #050816;
  }

  .footer-column {
    height: 100%;
  }

  .footer-title {
    font-size: 16px;
    font-weight: 700;
    color: #ffffff;
    margin-bottom: 20px;
    letter-spacing: 0.5px;
  }

  .footer-about {
    font-size: 14px;
    line-height: 1.7;
    color: #9CA3AF;
    margin: 0;
    max-width: 280px;
  }

  /* Liens utiles */
  .footer-links-list {
    list-style: none;
    padding: 0;
    margin: 0;
  }

  .footer-links-list li {
    margin-bottom: 12px;
  }

  .footer-links-list li:last-child {
    margin-bottom: 0;
  }

  .footer-links-list a {
    color: #9CA3AF;
    text-decoration: none;
    font-size: 14px;
    transition: color 0.2s ease;
    display: inline-block;
  }

  .footer-links-list a:hover {
    color: #7B3FF2;
  }

  /* Contact */
  .footer-contact {
    display: flex;
    flex-direction: column;
    gap: 12px;
  }

  .footer-contact-item {
    margin: 0;
    font-size: 14px;
    line-height: 1.6;
  }

  .footer-contact-label {
    color: #9CA3AF;
    display: block;
    margin-bottom: 4px;
  }

  .footer-contact-item a {
    color: #E5E7EB;
    text-decoration: none;
    transition: color 0.2s ease;
  }

  .footer-contact-item a:hover {
    color: #7B3FF2;
  }

  .footer-link {
    color: #9CA3AF;
    text-decoration: none;
    font-size: 14px;
    transition: color 0.2s ease;
  }

  .footer-link:hover {
    color: #7B3FF2;
  }

  .footer-contact-note {
    font-size: 13px;
    color: #6B7280;
    margin: 8px 0 0 0;
    font-style: italic;
  }

  /* Newsletter */
  .footer-newsletter-text {
    font-size: 14px;
    line-height: 1.7;
    color: #9CA3AF;
    margin-bottom: 20px;
  }

  .footer-newsletter-form {
    width: 100%;
  }

  .footer-newsletter-input-group {
    display: flex;
    gap: 8px;
    align-items: stretch;
  }

  .footer-newsletter-input {
    flex: 1;
    padding: 12px 16px;
    background: rgba(255, 255, 255, 0.05);
    border: 1px solid rgba(255, 255, 255, 0.1);
    border-radius: 8px;
    color: #E5E7EB;
    font-size: 14px;
    transition: all 0.2s ease;
  }

  .footer-newsletter-input::placeholder {
    color: #6B7280;
  }

  .footer-newsletter-input:focus {
    outline: none;
    border-color: #7B3FF2;
    background: rgba(255, 255, 255, 0.08);
  }

  .footer-newsletter-btn {
    padding: 12px 24px;
    background: linear-gradient(135deg, #1F3BFF 0%, #7B3FF2 100%);
    border: none;
    border-radius: 8px;
    color: white;
    font-size: 14px;
    font-weight: 600;
    cursor: pointer;
    transition: transform 0.2s ease, box-shadow 0.2s ease;
    white-space: nowrap;
  }

  .footer-newsletter-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(123, 63, 242, 0.4);
  }

  .footer-newsletter-btn:active {
    transform: translateY(0);
  }

  /* Bloc B : Copyright et réseaux sociaux */
  .footer-bottom {
    padding: 30px 0 0 0 !important;
    background: #030510;
    border-top: 1px solid rgba(255, 255, 255, 0.08);
    margin-bottom: 0 !important;
    padding-bottom: 0 !important;
    border-bottom: none !important;
  }

  .footer-bottom-content {
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 20px;
    margin-bottom: 0 !important;
    padding-bottom: 0 !important;
  }

  /* Supprimer tout espace sous le footer */
  .junspro-footer {
    margin-bottom: 0 !important;
    padding-bottom: 0 !important;
  }

  .junspro-footer .footer-bottom {
    margin-bottom: 0 !important;
    padding-bottom: 0 !important;
  }

  .junspro-footer .footer-bottom-content {
    margin-bottom: 0 !important;
    padding-bottom: 0 !important;
  }

  .junspro-footer .footer-copyright,
  .junspro-footer .footer-social {
    margin-bottom: 0 !important;
    padding-bottom: 0 !important;
  }

  .footer-copyright {
    flex: 1;
    min-width: 200px;
  }

  .footer-copyright p {
    margin: 0 !important;
    padding: 0 !important;
    font-size: 14px;
    color: #9CA3AF;
  }

  .footer-social {
    display: flex;
    gap: 12px;
    align-items: center;
  }

  .footer-social-icon {
    width: 40px;
    height: 40px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: rgba(127, 90, 240, 0.15);
    border-radius: 50%;
    color: #E5E7EB;
    text-decoration: none;
    transition: all 0.3s ease;
    font-size: 16px;
  }

  .footer-social-icon:hover {
    background: linear-gradient(135deg, #1F3BFF 0%, #7B3FF2 100%);
    color: white;
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(123, 63, 242, 0.3);
  }

  /* Responsive */
  @media (max-width: 991px) {
    .footer-main {
      padding: 50px 0 40px;
    }

    .footer-column {
      margin-bottom: 32px;
    }

    .footer-column:last-child {
      margin-bottom: 0;
    }

    .footer-about {
      max-width: 100%;
    }

    .footer-newsletter-input-group {
      flex-direction: column;
    }

    .footer-newsletter-btn {
      width: 100%;
    }
  }

  @media (max-width: 768px) {
    .footer-main {
      padding: 40px 0 30px;
    }

    .footer-bottom {
      padding-bottom: 0 !important;
      margin-bottom: 0 !important;
    }

    .footer-bottom-content {
      flex-direction: column;
      text-align: center;
      gap: 24px;
      padding-bottom: 0 !important;
      margin-bottom: 0 !important;
    }

    .footer-copyright {
      min-width: 100%;
    }

    .footer-social {
      justify-content: center;
    }
  }

  @media (max-width: 480px) {
    .footer-main {
      padding: 32px 0 24px;
    }

    .footer-bottom {
      padding-bottom: 0 !important;
      margin-bottom: 0 !important;
    }

    .footer-bottom-content {
      padding-bottom: 0 !important;
      margin-bottom: 0 !important;
    }

    .footer-title {
      font-size: 15px;
      margin-bottom: 16px;
    }

    .footer-about,
    .footer-newsletter-text,
    .footer-links-list a,
    .footer-contact-item {
      font-size: 13px;
    }

    .footer-social-icon {
      width: 36px;
      height: 36px;
      font-size: 14px;
    }
  }

  /* Suppression de tout espace après le footer */
  .junspro-footer::after {
    display: none;
    content: none;
  }

  body:has(.junspro-footer) {
    padding-bottom: 0 !important;
    margin-bottom: 0 !important;
  }

  /* Supprimer tout padding/margin après footer-bottom */
  .footer-bottom::after,
  .footer-bottom-content::after {
    display: none;
    content: none;
  }

  html:has(.junspro-footer),
  .main-wrapper:has(.junspro-footer) {
    padding-bottom: 0 !important;
    margin-bottom: 0 !important;
  }

  /* S'assurer que le footer est le dernier élément sans espace */
  .junspro-footer:last-child {
    margin-bottom: 0 !important;
    padding-bottom: 0 !important;
  }
</style>
<?php /**PATH C:\Users\younes\Downloads\junspro-main (1)\junspro-main3\resources\views/frontend/partials/footer/footer-v3.blade.php ENDPATH**/ ?>