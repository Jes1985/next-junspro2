<?php $__env->startSection('pageHeading'); ?>
    <?php if(!empty($pageHeading)): ?>
        <?php echo e($pageHeading->contact_page_title); ?>

    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('metaKeywords'); ?>
    <?php if(!empty($seoInfo)): ?>
        <?php echo e($seoInfo->meta_keyword_contact); ?>

    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('metaDescription'); ?>
    <?php if(!empty($seoInfo)): ?>
        <?php echo e($seoInfo->meta_description_contact); ?>

    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('style'); ?>
  <style>
    :root {
      --junspro-blue: #1e40af;
      --junspro-purple: #7C3AED;
      --junspro-gradient: linear-gradient(135deg, #1e40af 0%, #4c1d95 50%, #7c3aed 100%);
    }

    /* En-tête avec dégradé - Même style que la page d'accueil - Spécificité maximale */
    body .header-area,
    html body .header-area,
    body .header-area.header_v1,
    html body .header-area.header_v1,
    body .header-area.header_v1:not(.is-sticky),
    html body .header-area.header_v1:not(.is-sticky) {
      background: linear-gradient(135deg, #1e40af 0%, #4c1d95 50%, #020617 100%) !important;
      background-color: transparent !important;
      background-image: linear-gradient(135deg, #1e40af 0%, #4c1d95 50%, #020617 100%) !important;
      position: relative;
      z-index: 1000 !important;
    }

    /* Main navbar avec dégradé */
    body .header-area .main-navbar,
    html body .header-area .main-navbar,
    body .header-area .main-responsive-nav,
    html body .header-area .main-responsive-nav,
    body .header-area .main-navbar .navbar,
    html body .header-area .main-navbar .navbar,
    body .header-area .main-navbar .container-fluid,
    html body .header-area .main-navbar .container-fluid {
      background: linear-gradient(135deg, #1e40af 0%, #4c1d95 50%, #020617 100%) !important;
      background-color: transparent !important;
      background-image: linear-gradient(135deg, #1e40af 0%, #4c1d95 50%, #020617 100%) !important;
    }

    /* Assurer la visibilité des liens de navigation sur fond sombre - Spécificité maximale */
    body .header-area .nav-link,
    html body .header-area .nav-link,
    body .header-area .main-navbar .nav-link,
    html body .header-area .main-navbar .nav-link,
    body .header-area .navbar-nav .nav-link,
    html body .header-area .navbar-nav .nav-link,
    body .header-area .navbar-nav .nav-item .nav-link,
    html body .header-area .navbar-nav .nav-item .nav-link,
    body .header-area .main-navbar .navbar-nav .nav-link,
    html body .header-area .main-navbar .navbar-nav .nav-link {
      color: rgba(255, 255, 255, 0.95) !important;
      -webkit-text-fill-color: rgba(255, 255, 255, 0.95) !important;
    }

    body .header-area .nav-link:hover,
    body .header-area .nav-link.active,
    html body .header-area .nav-link:hover,
    html body .header-area .nav-link.active,
    body .header-area .navbar-nav .nav-link:hover,
    body .header-area .navbar-nav .nav-link.active,
    html body .header-area .navbar-nav .nav-link:hover,
    html body .header-area .navbar-nav .nav-link.active {
      color: #ffffff !important;
      -webkit-text-fill-color: #ffffff !important;
    }

    /* Forcer la couleur blanche pour tous les textes de navigation */
    body .header-area .navbar-nav a,
    html body .header-area .navbar-nav a,
    body .header-area .main-navbar a.nav-link,
    html body .header-area .main-navbar a.nav-link {
      color: rgba(255, 255, 255, 0.95) !important;
    }

    /* Logo blanc sur fond sombre - Spécificité maximale */
    /* Logo JUNSPRO - Le style global du layout s'applique déjà */
    /* Pas besoin de surcharger ici, le style avec aberration chromatique est dans layout.blade.php */

    /* Icônes et boutons blancs sur fond sombre */
    body .header-area .more-option .item button,
    html body .header-area .more-option .item button,
    body .header-area .more-option .item .btn-search,
    html body .header-area .more-option .item .btn-search,
    body .header-area .more-option .item .btn-outline,
    html body .header-area .more-option .item .btn-outline,
    body .header-area button,
    html body .header-area button {
      color: rgba(255, 255, 255, 0.9) !important;
    }

    body .header-area .more-option .item button:hover,
    html body .header-area .more-option .item button:hover,
    body .header-area .more-option .item .btn-search:hover,
    html body .header-area .more-option .item .btn-search:hover {
      color: #ffffff !important;
    }

    /* Menu toggle button blanc */
    body .header-area .menu-toggler span,
    html body .header-area .menu-toggler span {
      background-color: rgba(255, 255, 255, 0.9) !important;
    }

    /* Force l'application du dégradé avec JavaScript si nécessaire */
    @media screen {
      body .header-area,
      html body .header-area {
        background: linear-gradient(135deg, #1e40af 0%, #4c1d95 50%, #020617 100%) !important;
        background-color: transparent !important;
      }
    }

    /* Hero Contact Premium - Transparent pour laisser le wrapper gérer le fond */
    .contact-hero-premium {
      background: transparent;
      position: relative;
      overflow: visible;
      padding: 120px 0 0;
      margin-top: 0;
      margin-bottom: 0;
      min-height: 75vh;
      display: flex;
      align-items: center;
      z-index: 1;
    }

    /* Fond unifié pour toute la page */
    .contact-page-wrapper {
      background: linear-gradient(135deg, #1e40af 0%, #4c1d95 50%, #7c3aed 100%);
      min-height: 100vh;
      position: relative;
      width: 100%;
      padding-bottom: 0;
    }

    /* S'assurer que le body et les sections n'ont pas de fond différent */
    body {
      background: linear-gradient(135deg, #1e40af 0%, #4c1d95 50%, #7c3aed 100%) !important;
    }

    /* Supprimer tout fond blanc ou gris qui pourrait créer une séparation */
    .contact-form-premium-section {
      background: transparent !important;
    }

    /* Textures abstraites légères sur le wrapper */
    .contact-page-wrapper::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background: 
        radial-gradient(circle at 20% 50%, rgba(255, 255, 255, 0.08) 0%, transparent 50%),
        radial-gradient(circle at 80% 80%, rgba(255, 255, 255, 0.06) 0%, transparent 50%);
      z-index: 0;
      pointer-events: none;
    }

    .contact-hero-premium::before,
    .contact-form-premium-section::before {
      display: none;
    }

    body .contact-hero-premium {
      margin-top: 0 !important;
      padding-top: 120px !important;
    }

    /* Textures abstraites légères */
    .contact-hero-premium::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background: 
        radial-gradient(circle at 20% 50%, rgba(255, 255, 255, 0.08) 0%, transparent 50%),
        radial-gradient(circle at 80% 80%, rgba(255, 255, 255, 0.06) 0%, transparent 50%);
      z-index: 1;
      pointer-events: none;
    }

    .contact-hero-container {
      max-width: 1280px;
      margin: 0 auto;
      padding: 0 2rem;
      position: relative;
      z-index: 2;
    }

    .contact-hero-content {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 4rem;
      align-items: center;
    }

    .contact-hero-text {
      color: white;
      opacity: 0;
      animation: fadeInLeft 0.8s ease-out 0.2s forwards;
    }

    .contact-hero-title {
      font-size: 3.5rem;
      font-weight: 700;
      color: #FFFFFF;
      line-height: 1.1;
      margin-bottom: 1.5rem;
      letter-spacing: -0.02em;
    }

    .contact-hero-title .highlight {
      font-weight: 700;
      background: linear-gradient(135deg, #a5b4fc 0%, #c4b5fd 50%, #ddd6fe 100%);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      background-clip: text;
      display: inline-block;
    }

    .contact-hero-subtitle {
      font-size: 1.25rem;
      color: rgba(255, 255, 255, 0.9);
      margin-bottom: 0;
      font-weight: 400;
      line-height: 1.7;
    }

    .contact-hero-image {
      opacity: 0;
      animation: fadeInRight 0.8s ease-out 0.4s forwards;
      position: relative;
    }

    .contact-hero-image {
      position: relative;
      overflow: hidden;
    }

    .contact-hero-image img {
      width: 100%;
      height: auto;
      min-height: 500px;
      border-radius: 24px;
      box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
      object-fit: cover;
      background: linear-gradient(135deg, rgba(30, 64, 175, 0.1) 0%, rgba(124, 58, 237, 0.1) 100%);
      image-rendering: -webkit-optimize-contrast;
      image-rendering: crisp-edges;
      image-rendering: high-quality;
      -webkit-backface-visibility: hidden;
      backface-visibility: hidden;
      transform: translateZ(0);
    }

    @media (max-width: 968px) {
      .contact-hero-image img {
        min-height: 400px;
      }
    }

    @media (max-width: 640px) {
      .contact-hero-image img {
        min-height: 300px;
      }
    }

    @keyframes fadeInLeft {
      from {
        opacity: 0;
        transform: translateX(-30px);
      }
      to {
        opacity: 1;
        transform: translateX(0);
      }
    }

    @keyframes fadeInRight {
      from {
        opacity: 0;
        transform: translateX(30px);
      }
      to {
        opacity: 1;
        transform: translateX(0);
      }
    }

    /* Section Formulaire Contact Premium - Continuation du dégradé */
    .contact-form-premium-section {
      background: transparent;
      padding: 0;
      margin-top: -6rem;
      margin-bottom: 0;
      position: relative;
      z-index: 2;
    }

    .contact-form-premium-section .container {
      padding-top: 6rem !important;
      padding-bottom: 6rem !important;
    }

    .contact-form-premium-wrapper {
      background: white;
      border-radius: 24px 24px 0 0;
      padding: 4rem;
      box-shadow: 0 -4px 24px rgba(0, 0, 0, 0.08);
      border: none;
      margin-top: 0;
      margin-bottom: 0;
    }

    .contact-form-header {
      margin-bottom: 3rem;
    }

    .contact-form-title {
      font-size: 2.5rem;
      font-weight: 700;
      color: #1a202c;
      margin-bottom: 1rem;
      letter-spacing: -0.01em;
    }

    .contact-form-subtitle {
      font-size: 1.125rem;
      color: #6b7280;
      line-height: 1.7;
      margin: 0;
    }

    /* Alerts */
    .alert-success-premium {
      background: #f0fdf4;
      border: 1px solid #86efac;
      color: #166534;
      padding: 1rem 1.5rem;
      border-radius: 12px;
      font-size: 0.95rem;
    }

    .alert-error-premium {
      background: #fef2f2;
      border: 1px solid #fca5a5;
      color: #dc2626;
      padding: 1rem 1.5rem;
      border-radius: 12px;
      font-size: 0.95rem;
    }

    /* Form Premium */
    .form-group-premium {
      margin-bottom: 1.5rem;
    }

    .form-label-premium {
      display: block;
      font-size: 0.95rem;
      font-weight: 600;
      color: #374151;
      margin-bottom: 0.5rem;
    }

    .form-control-premium {
      width: 100%;
      padding: 0.875rem 1.25rem;
      font-size: 1rem;
      line-height: 1.5;
      color: #1a202c;
      background-color: #ffffff;
      border: 2px solid #e5e7eb;
      border-radius: 12px;
      transition: all 0.2s ease;
      font-family: inherit;
    }

    .form-control-premium:focus {
      outline: none;
      border-color: var(--junspro-purple);
      box-shadow: 0 0 0 3px rgba(124, 58, 237, 0.1);
    }

    .form-control-premium::placeholder {
      color: #9ca3af;
    }

    .form-control-premium.is-invalid {
      border-color: #dc2626;
    }

    .form-control-premium.is-invalid:focus {
      border-color: #dc2626;
      box-shadow: 0 0 0 3px rgba(220, 38, 38, 0.1);
    }

    .form-textarea-premium {
      resize: vertical;
      min-height: 150px;
    }

    .form-error-premium {
      font-size: 0.875rem;
      color: #dc2626;
      margin-top: 0.5rem;
    }

    /* Bouton Submit Premium */
    .btn-premium-submit {
      background: var(--junspro-gradient);
      color: white;
      border: none;
      padding: 1rem 2.5rem;
      border-radius: 12px;
      font-size: 1.125rem;
      font-weight: 600;
      cursor: pointer;
      transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
      box-shadow: 0 4px 20px rgba(124, 58, 237, 0.3);
      display: inline-flex;
      align-items: center;
      justify-content: center;
      width: 100%;
    }

    .btn-premium-submit:hover {
      transform: translateY(-2px);
      box-shadow: 0 8px 30px rgba(124, 58, 237, 0.4);
    }

    .btn-premium-submit:active {
      transform: translateY(0);
    }

    /* Responsive */
    @media (max-width: 991px) {
      .contact-form-premium-section {
        margin-top: -4rem;
      }

      .contact-form-premium-wrapper {
        padding: 3rem 2rem;
        margin-top: 4rem;
      }

      .contact-form-title {
        font-size: 2rem;
      }
    }

    @media (max-width: 768px) {
      .contact-form-premium-section {
        margin-top: -3rem;
      }

      .contact-form-premium-wrapper {
        padding: 2.5rem 1.5rem;
        border-radius: 24px 24px 0 0;
        margin-top: 3rem;
      }

      .contact-form-title {
        font-size: 1.75rem;
      }

      .contact-form-subtitle {
        font-size: 1rem;
      }
    }

    /* Responsive */
    @media (max-width: 968px) {
      .contact-hero-content {
        grid-template-columns: 1fr;
        gap: 3rem;
      }

      .contact-hero-image {
        order: -1;
      }

      .contact-hero-title {
        font-size: 2.5rem;
      }

      .contact-hero-subtitle {
        font-size: 1.125rem;
      }

      .contact-form-premium-section {
        margin-top: -2rem;
      }

      .contact-form-premium-wrapper {
        margin-top: 2rem;
        border-radius: 24px 24px 0 0;
      }
    }

    @media (max-width: 640px) {
      .contact-hero-premium {
        padding: 100px 0 0 !important;
        min-height: auto;
      }

      .contact-hero-title {
        font-size: 2rem;
      }

      .contact-hero-subtitle {
        font-size: 1rem;
      }

      .contact-form-premium-section {
        margin-top: -1rem;
        padding-bottom: 4rem;
      }

      .contact-form-premium-wrapper {
        margin-top: 1rem;
        padding: 2.5rem 1.5rem;
      }
    }
  </style>
<?php $__env->stopSection(); ?>

<?php
    $title = $pageHeading->contact_page_title ?? __('No Page Title Found');
?>
<?php $__env->startSection('content'); ?>
  <div class="contact-page-wrapper">
  <!-- Hero Contact Premium -->
  <section class="contact-hero-premium">
    <div class="contact-hero-container">
      <div class="contact-hero-content">
        <div class="contact-hero-text">
          <h1 class="contact-hero-title">
            <?php echo e(__('Restons en')); ?> <span class="highlight"><?php echo e(__('contact')); ?></span>
          </h1>
          <p class="contact-hero-subtitle">
            <?php echo e(__('Que vous cherchiez un freelance pour votre projet ou que vous souhaitiez proposer vos services, notre équipe est là pour vous accompagner et répondre à toutes vos questions.')); ?>

          </p>
        </div>
        <div class="contact-hero-image">
          <img src="https://images.unsplash.com/photo-1552664730-d307ca884978?w=1200&h=800&fit=crop&q=90" 
               alt="<?php echo e(__('Contactez notre équipe Junspro')); ?>"
               loading="lazy"
               style="min-height: 500px; object-fit: cover;">
        </div>
      </div>
    </div>
  </section>

    <!--====== Start Contact Form Section Premium ======-->
    <div class="contact-form-premium-section">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-8 col-xl-7">
              <div class="contact-form-premium-wrapper">
                  <div class="contact-form-header text-center mb-50">
                      <h2 class="contact-form-title"><?php echo e(__('Entrer en contact')); ?></h2>
                      <p class="contact-form-subtitle">
                        <?php echo e(__('Remplissez le formulaire ci-dessous et notre équipe vous répondra dans les plus brefs délais.')); ?>

                      </p>
                  </div>

                  <div class="contact-form-premium">
                    <?php if(session('success')): ?>
                      <div class="alert alert-success-premium mb-30">
                        <i class="fas fa-check-circle me-2"></i>
                        <?php echo e(session('success')); ?>

                      </div>
                    <?php endif; ?>

                    <?php if(session('error')): ?>
                      <div class="alert alert-error-premium mb-30">
                        <i class="fas fa-exclamation-circle me-2"></i>
                        <?php echo e(session('error')); ?>

                      </div>
                    <?php endif; ?>

                    <form action="<?php echo e(route('contact.send_mail')); ?>" method="post" class="premium-contact-form">
                        <?php echo csrf_field(); ?>
                        <div class="row g-4">
                            <div class="col-md-6">
                                <div class="form-group-premium">
                                    <label for="name" class="form-label-premium"><?php echo e(__('Nom complet')); ?></label>
                                    <input 
                                        id="name"
                                        name="name" 
                                        type="text" 
                                        class="form-control-premium <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                        placeholder="<?php echo e(__('Entrez votre nom complet')); ?>"
                                        value="<?php echo e(old('name')); ?>"
                                        required>
                                    <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <div class="form-error-premium"><?php echo e($message); ?></div>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group-premium">
                                    <label for="email" class="form-label-premium"><?php echo e(__('Adresse e-mail')); ?></label>
                                    <input 
                                        id="email"
                                        name="email" 
                                        type="email" 
                                        class="form-control-premium <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                        placeholder="<?php echo e(__('Entrez votre adresse e-mail')); ?>"
                                        value="<?php echo e(old('email')); ?>"
                                        required>
                                    <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <div class="form-error-premium"><?php echo e($message); ?></div>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-group-premium">
                                    <label for="subject" class="form-label-premium"><?php echo e(__('Objet de l\'e-mail')); ?></label>
                                    <input 
                                        id="subject"
                                        name="subject" 
                                        type="text" 
                                        class="form-control-premium <?php $__errorArgs = ['subject'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                        placeholder="<?php echo e(__('Entrez l\'objet de l\'e-mail')); ?>"
                                        value="<?php echo e(old('subject')); ?>"
                                        required>
                                    <?php $__errorArgs = ['subject'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <div class="form-error-premium"><?php echo e($message); ?></div>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-group-premium">
                                    <label for="message" class="form-label-premium"><?php echo e(__('Message')); ?></label>
                                    <textarea 
                                        id="message"
                                        name="message" 
                                        class="form-control-premium form-textarea-premium <?php $__errorArgs = ['message'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                        rows="6"
                                        placeholder="<?php echo e(__('Écrivez votre message')); ?>"
                                        required><?php echo e(old('message')); ?></textarea>
                                    <?php $__errorArgs = ['message'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <div class="form-error-premium"><?php echo e($message); ?></div>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                            </div>

                            <?php if($info->google_recaptcha_status == 1): ?>
                                <div class="col-12">
                                    <div class="form-group-premium">
                                        <?php echo NoCaptcha::renderJs(); ?>

                                        <?php echo NoCaptcha::display(); ?>

                                        <?php $__errorArgs = ['g-recaptcha-response'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <div class="form-error-premium"><?php echo e($message); ?></div>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                </div>
                            <?php endif; ?>

                            <div class="col-12">
                                <button type="submit" class="btn-premium-submit">
                                    <span><?php echo e(__('Envoyer le message')); ?></span>
                                    <i class="fas fa-paper-plane ms-2"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                  </div>
              </div>
            </div>
          </div>
        </div>
    </div>
    <!--====== End Contact Form Section Premium ======-->

    <!--====== Start Contact Section ======-->
    
    <!--====== End Contact Section ======-->
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
  <script>
    // Forcer l'application du dégradé sur l'en-tête après le chargement
    (function() {
      function applyHeaderGradient() {
        const gradient = 'linear-gradient(135deg, #1e40af 0%, #4c1d95 50%, #020617 100%)';
        
        // Cibler tous les éléments de l'en-tête
        const headerArea = document.querySelector('.header-area');
        const mainNavbar = document.querySelector('.header-area .main-navbar');
        const mainResponsiveNav = document.querySelector('.header-area .main-responsive-nav');
        const navbar = document.querySelector('.header-area .main-navbar .navbar');
        const containerFluid = document.querySelector('.header-area .main-navbar .container-fluid');
        const navbarCollapse = document.querySelector('.header-area .navbar-collapse');
        
        // Appliquer le dégradé à tous les éléments
        [headerArea, mainNavbar, mainResponsiveNav, navbar, containerFluid, navbarCollapse].forEach(function(element) {
          if (element) {
            element.style.setProperty('background', gradient, 'important');
            element.style.setProperty('background-color', 'transparent', 'important');
            element.style.setProperty('background-image', gradient, 'important');
            // Supprimer tout fond blanc
            element.style.removeProperty('background-color');
            element.style.setProperty('background', gradient, 'important');
          }
        });
        
        // Forcer la couleur blanche sur tous les liens de navigation
        const navLinks = document.querySelectorAll('.header-area .nav-link, .header-area .navbar-nav a, .header-area .main-navbar a, .header-area .navbar-nav .nav-item a');
        navLinks.forEach(function(link) {
          if (link) {
            // Forcer le blanc directement
            link.style.setProperty('color', 'rgba(255, 255, 255, 0.95)', 'important');
            link.style.setProperty('-webkit-text-fill-color', 'rgba(255, 255, 255, 0.95)', 'important');
          }
        });
        
        // Forcer aussi sur les éléments actifs
        const activeLinks = document.querySelectorAll('.header-area .nav-link.active, .header-area .navbar-nav .nav-link.active');
        activeLinks.forEach(function(link) {
          if (link) {
            link.style.setProperty('color', '#ffffff', 'important');
            link.style.setProperty('-webkit-text-fill-color', '#ffffff', 'important');
          }
        });
      }
      
      // Appliquer immédiatement
      applyHeaderGradient();
      
      // Réappliquer après le chargement complet
      if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', function() {
          applyHeaderGradient();
          setTimeout(applyHeaderGradient, 50);
          setTimeout(applyHeaderGradient, 200);
          setTimeout(applyHeaderGradient, 500);
        });
      } else {
        applyHeaderGradient();
        setTimeout(applyHeaderGradient, 50);
        setTimeout(applyHeaderGradient, 200);
        setTimeout(applyHeaderGradient, 500);
      }
      
      // Observer les changements de style pour réappliquer si nécessaire
      const observer = new MutationObserver(function(mutations) {
        let shouldReapply = false;
        mutations.forEach(function(mutation) {
          if (mutation.type === 'attributes' && mutation.attributeName === 'style') {
            shouldReapply = true;
          }
        });
        if (shouldReapply) {
          setTimeout(applyHeaderGradient, 10);
        }
      });
      
      // Observer les changements sur l'en-tête
      const headerArea = document.querySelector('.header-area');
      if (headerArea) {
        observer.observe(headerArea, {
          attributes: true,
          attributeFilter: ['style', 'class']
        });
      }
      
      // Réappliquer périodiquement pour garantir l'application
      setInterval(applyHeaderGradient, 1000);
    })();
  </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\younes\Downloads\junspro-main (1)\junspro-main3\resources\views\frontend\contact.blade.php ENDPATH**/ ?>