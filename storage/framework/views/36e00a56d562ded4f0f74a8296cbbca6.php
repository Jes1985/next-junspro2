<?php $__env->startSection('pageHeading'); ?>
  <?php echo e(__('Devenir freelance')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('metaKeywords'); ?>
  <?php echo e(__('Devenir freelance, créer profil freelance, services freelance, Junspro')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('metaDescription'); ?>
  <?php echo e(__('Lancez votre activité freelance sur Junspro. Créez un profil premium, présentez vos services et recevez des demandes de clients.')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('style'); ?>
  <link rel="stylesheet" href="<?php echo e(asset('assets/css/summernote-content.css')); ?>">
  <style>
    :root {
      --junspro-blue: #1e40af;
      --junspro-purple: #7C3AED;
      --junspro-gradient: linear-gradient(135deg, #1e40af 0%, #4c1d95 50%, #7c3aed 100%);
      --junspro-gradient-light: linear-gradient(135deg, rgba(30, 64, 175, 0.05) 0%, rgba(76, 29, 149, 0.05) 50%, rgba(124, 58, 237, 0.05) 100%);
    }

    /* Reset & Base */
    .become-freelance-page {
      overflow-x: hidden;
    }

    .become-freelance-page * {
      box-sizing: border-box;
    }

    /* Hero Section */
    .hero-become-freelance {
      min-height: 85vh;
      display: flex;
      align-items: center;
      position: relative;
      background: var(--junspro-gradient-light);
      padding: 6rem 0;
      overflow: hidden;
    }

    .hero-become-freelance::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background-image: 
        radial-gradient(circle at 20% 50%, rgba(124, 58, 237, 0.08) 0%, transparent 50%),
        radial-gradient(circle at 80% 50%, rgba(30, 64, 175, 0.08) 0%, transparent 50%);
      pointer-events: none;
    }

    .hero-container {
      max-width: 1280px;
      margin: 0 auto;
      padding: 0 2rem;
      position: relative;
      z-index: 1;
    }

    .hero-content {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 4rem;
      align-items: center;
    }

    .hero-text {
      opacity: 0;
      animation: fadeInUp 0.8s ease-out 0.2s forwards;
    }

    .hero-text h1 {
      font-size: 3.5rem;
      font-weight: 700;
      line-height: 1.1;
      color: #1a202c;
      margin-bottom: 1.5rem;
      letter-spacing: -0.02em;
    }

    .hero-text .subtitle {
      font-size: 1.25rem;
      line-height: 1.7;
      color: #4b5563;
      margin-bottom: 2.5rem;
      font-weight: 400;
    }

    .hero-cta {
      display: flex;
      gap: 1.5rem;
      flex-wrap: wrap;
      align-items: center;
    }

    .btn-primary-hero {
      background: var(--junspro-gradient);
      color: white;
      padding: 1rem 2.5rem;
      border-radius: 50px;
      font-size: 1.125rem;
      font-weight: 600;
      text-decoration: none;
      display: inline-flex;
      align-items: center;
      gap: 0.75rem;
      transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
      box-shadow: 0 4px 20px rgba(124, 58, 237, 0.3);
      border: none;
      cursor: pointer;
    }

    .btn-primary-hero:hover {
      transform: translateY(-2px);
      box-shadow: 0 8px 30px rgba(124, 58, 237, 0.4);
    }

    .btn-secondary-hero {
      color: var(--junspro-purple);
      font-size: 1.125rem;
      font-weight: 500;
      text-decoration: none;
      transition: color 0.2s ease;
      border-bottom: 2px solid transparent;
    }

    .btn-secondary-hero:hover {
      color: var(--junspro-blue);
      border-bottom-color: var(--junspro-purple);
    }

    .hero-image {
      opacity: 0;
      animation: fadeInUp 0.8s ease-out 0.4s forwards;
      position: relative;
    }

    .hero-image img {
      width: 100%;
      height: auto;
      border-radius: 24px;
      box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15);
      object-fit: cover;
    }

    /* Steps Section */
    .steps-section {
      padding: 6rem 0;
      background: white;
    }

    .steps-container {
      max-width: 1280px;
      margin: 0 auto;
      padding: 0 2rem;
    }

    .steps-inline {
      display: grid;
      grid-template-columns: repeat(3, 1fr);
      gap: 3rem;
      position: relative;
    }

    .steps-inline::before {
      content: '';
      position: absolute;
      top: 2rem;
      left: 0;
      right: 0;
      height: 2px;
      background: linear-gradient(to right, transparent, #e5e7eb, transparent);
      z-index: 0;
    }

    .step-item {
      text-align: center;
      position: relative;
      z-index: 1;
      opacity: 0;
      animation: fadeInUp 0.6s ease-out forwards;
    }

    .step-item:nth-child(1) { animation-delay: 0.1s; }
    .step-item:nth-child(2) { animation-delay: 0.2s; }
    .step-item:nth-child(3) { animation-delay: 0.3s; }

    .step-number {
      width: 4rem;
      height: 4rem;
      border-radius: 50%;
      background: white;
      border: 2px solid var(--junspro-purple);
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 1.5rem;
      font-weight: 700;
      color: var(--junspro-purple);
      margin: 0 auto 1.5rem;
      box-shadow: 0 4px 12px rgba(124, 58, 237, 0.15);
    }

    .step-title {
      font-size: 1.25rem;
      font-weight: 600;
      color: #1a202c;
      margin-bottom: 0.75rem;
    }

    .step-description {
      font-size: 1rem;
      color: #6b7280;
      line-height: 1.6;
    }

    /* Feature Split Sections */
    .feature-split {
      padding: 6rem 0;
      background: white;
    }

    .feature-split:nth-child(even) {
      background: #f9fafb;
    }

    .feature-container {
      max-width: 1280px;
      margin: 0 auto;
      padding: 0 2rem;
    }

    .feature-content {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 4rem;
      align-items: center;
    }

    .feature-content.reverse {
      direction: rtl;
    }

    .feature-content.reverse > * {
      direction: ltr;
    }

    .feature-text {
      opacity: 0;
      animation: fadeInLeft 0.8s ease-out forwards;
    }

    .feature-content.reverse .feature-text {
      animation-name: fadeInRight;
    }

    .feature-text h2 {
      font-size: 2.5rem;
      font-weight: 700;
      line-height: 1.2;
      color: #1a202c;
      margin-bottom: 1.5rem;
      letter-spacing: -0.01em;
    }

    .feature-text p {
      font-size: 1.125rem;
      line-height: 1.8;
      color: #4b5563;
      margin-bottom: 0;
    }

    .feature-image {
      opacity: 0;
      animation: fadeInRight 0.8s ease-out 0.2s forwards;
    }

    .feature-content.reverse .feature-image {
      animation-name: fadeInLeft;
    }

    .feature-image img {
      width: 100%;
      height: auto;
      border-radius: 24px;
      box-shadow: 0 20px 60px rgba(0, 0, 0, 0.12);
      object-fit: cover;
    }

    /* FAQ Section */
    .faq-section {
      padding: 6rem 0;
      background: white;
    }

    .faq-container {
      max-width: 800px;
      margin: 0 auto;
      padding: 0 2rem;
    }

    .faq-title {
      font-size: 2.5rem;
      font-weight: 700;
      text-align: center;
      color: #1a202c;
      margin-bottom: 3rem;
    }

    .faq-item {
      border-bottom: 1px solid #e5e7eb;
      padding: 1.5rem 0;
    }

    .faq-question {
      display: flex;
      justify-content: space-between;
      align-items: center;
      cursor: pointer;
      font-size: 1.125rem;
      font-weight: 600;
      color: #1a202c;
      transition: color 0.2s ease;
    }

    .faq-question:hover {
      color: var(--junspro-purple);
    }

    .faq-question::after {
      content: '+';
      font-size: 1.5rem;
      font-weight: 300;
      color: var(--junspro-purple);
      transition: transform 0.3s ease;
    }

    .faq-item.active .faq-question::after {
      transform: rotate(45deg);
    }

    .faq-answer {
      max-height: 0;
      overflow: hidden;
      transition: max-height 0.3s ease-out;
      padding-top: 0;
    }

    .faq-item.active .faq-answer {
      max-height: 500px;
      padding-top: 1rem;
    }

    .faq-answer p {
      font-size: 1rem;
      line-height: 1.7;
      color: #6b7280;
      margin: 0;
    }

    .faq-support {
      text-align: center;
      margin-top: 3rem;
      padding-top: 2rem;
      border-top: 1px solid #e5e7eb;
      font-size: 1rem;
      color: #6b7280;
    }

    .faq-support a {
      color: var(--junspro-purple);
      text-decoration: none;
      font-weight: 500;
    }

    .faq-support a:hover {
      text-decoration: underline;
    }

    /* Footer CTA */
    .footer-cta {
      padding: 6rem 0;
      background: var(--junspro-gradient-light);
      text-align: center;
    }

    .footer-cta-container {
      max-width: 800px;
      margin: 0 auto;
      padding: 0 2rem;
    }

    .footer-cta h2 {
      font-size: 2.5rem;
      font-weight: 700;
      color: #1a202c;
      margin-bottom: 2rem;
    }

    .footer-cta .btn-primary-hero {
      margin-top: 1rem;
    }

    /* Animations */
    @keyframes fadeInUp {
      from {
        opacity: 0;
        transform: translateY(30px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
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

    /* Responsive */
    @media (max-width: 968px) {
      .hero-content,
      .feature-content {
        grid-template-columns: 1fr;
        gap: 3rem;
      }

      .hero-text h1 {
        font-size: 2.5rem;
      }

      .hero-text .subtitle {
        font-size: 1.125rem;
      }

      .steps-inline {
        grid-template-columns: 1fr;
        gap: 2rem;
      }

      .steps-inline::before {
        display: none;
      }

      .feature-content.reverse {
        direction: ltr;
      }

      .feature-text h2 {
        font-size: 2rem;
      }

      .faq-title,
      .footer-cta h2 {
        font-size: 2rem;
      }
    }

    @media (max-width: 640px) {
      .hero-become-freelance {
        padding: 4rem 0;
        min-height: auto;
      }

      .hero-text h1 {
        font-size: 2rem;
      }

      .hero-cta {
        flex-direction: column;
        align-items: stretch;
      }

      .btn-primary-hero {
        width: 100%;
        justify-content: center;
      }

      .steps-section,
      .feature-split,
      .faq-section,
      .footer-cta {
        padding: 4rem 0;
      }
    }
  </style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
  <div class="become-freelance-page">
    <!-- Hero Section -->
    <section class="hero-become-freelance">
      <div class="hero-container">
        <div class="hero-content">
          <div class="hero-text">
            <h1><?php echo e(__('Lancez votre activité freelance sur Junspro.')); ?></h1>
            <p class="subtitle">
              <?php echo e(__('Créez un profil premium, présentez vos services, recevez des demandes, gérez vos réservations.')); ?>

            </p>
            <div class="hero-cta">
              <a href="<?php echo e(route('user.signup')); ?>?role=freelance" class="btn-primary-hero">
                <?php echo e(__('Créer mon profil freelance')); ?>

                <i class="fas fa-arrow-right"></i>
              </a>
              <a href="#fonctionnement" class="btn-secondary-hero">
                <?php echo e(__('Découvrir le fonctionnement')); ?>

              </a>
            </div>
          </div>
          <div class="hero-image">
            <img src="<?php echo e(asset('assets/img/freelance-hero.jpg')); ?>" 
                 alt="<?php echo e(__('Freelance au travail sur Junspro')); ?>"
                 onerror="this.src='https://images.unsplash.com/photo-1522071820081-009f0129c71c?w=800&h=600&fit=crop';">
          </div>
        </div>
      </div>
    </section>

    <!-- Steps Section -->
    <section id="fonctionnement" class="steps-section">
      <div class="steps-container">
        <div class="steps-inline">
          <div class="step-item">
            <div class="step-number">1</div>
            <h3 class="step-title"><?php echo e(__('Créez votre profil')); ?></h3>
            <p class="step-description">
              <?php echo e(__('Remplissez votre profil avec vos compétences, votre expérience et votre tarif horaire.')); ?>

            </p>
          </div>
          <div class="step-item">
            <div class="step-number">2</div>
            <h3 class="step-title"><?php echo e(__('Publiez vos services')); ?></h3>
            <p class="step-description">
              <?php echo e(__('Définissez vos offres et vos disponibilités. Votre profil devient visible pour les clients.')); ?>

            </p>
          </div>
          <div class="step-item">
            <div class="step-number">3</div>
            <h3 class="step-title"><?php echo e(__('Recevez vos premières demandes')); ?></h3>
            <p class="step-description">
              <?php echo e(__('Les clients réservent vos créneaux et vous travaillez ensemble sur leurs projets.')); ?>

            </p>
          </div>
        </div>
      </div>
    </section>

    <!-- Feature 1: Tarif -->
    <section class="feature-split">
      <div class="feature-container">
        <div class="feature-content">
          <div class="feature-text">
            <h2><?php echo e(__('Définissez votre offre et votre tarif.')); ?></h2>
            <p>
              <?php echo e(__('Vous avez le contrôle total sur votre tarif horaire et vos offres. Créez des packages clairs pour vos clients, définissez vos disponibilités et gérez votre agenda en toute autonomie. Junspro vous donne les outils pour présenter votre valeur de manière professionnelle.')); ?>

            </p>
          </div>
          <div class="feature-image">
            <img src="<?php echo e(asset('assets/img/freelance-tarif.jpg')); ?>" 
                 alt="<?php echo e(__('Définir son tarif freelance')); ?>"
                 onerror="this.src='https://images.unsplash.com/photo-1551288049-bebda4e38f71?w=800&h=600&fit=crop';">
          </div>
        </div>
      </div>
    </section>

    <!-- Feature 2: Flexibilité -->
    <section class="feature-split">
      <div class="feature-container">
        <div class="feature-content reverse">
          <div class="feature-text">
            <h2><?php echo e(__('Travaillez où vous voulez, quand vous voulez.')); ?></h2>
            <p>
              <?php echo e(__('Organisez votre emploi du temps selon vos contraintes. Définissez vos disponibilités, acceptez ou refusez les demandes, et travaillez depuis n\'importe où. Junspro s\'adapte à votre rythme et à votre mode de travail.')); ?>

            </p>
          </div>
          <div class="feature-image">
            <img src="<?php echo e(asset('assets/img/freelance-flexibilite.jpg')); ?>" 
                 alt="<?php echo e(__('Travaillez en toute flexibilité')); ?>"
                 onerror="this.src='https://images.unsplash.com/photo-1521791136064-7986c2920216?w=800&h=600&fit=crop';">
          </div>
        </div>
      </div>
    </section>

    <!-- Feature 3: Expérience premium -->
    <section class="feature-split">
      <div class="feature-container">
        <div class="feature-content">
          <div class="feature-text">
            <h2><?php echo e(__('Une expérience premium pour vos clients.')); ?></h2>
            <p>
              <?php echo e(__('Votre profil Junspro est conçu pour inspirer confiance. Présentez vos services de manière claire, montrez votre expertise et facilitez la réservation pour vos clients. Un process simple et professionnel qui valorise votre travail.')); ?>

            </p>
          </div>
          <div class="feature-image">
            <img src="<?php echo e(asset('assets/img/freelance-premium.jpg')); ?>" 
                 alt="<?php echo e(__('Expérience premium pour clients')); ?>"
                 onerror="this.src='https://images.unsplash.com/photo-1552664730-d307ca884978?w=800&h=600&fit=crop';">
          </div>
        </div>
      </div>
    </section>

    <!-- FAQ Section -->
    <section class="faq-section">
      <div class="faq-container">
        <h2 class="faq-title"><?php echo e(__('Questions fréquentes')); ?></h2>
        
        <div class="faq-item">
          <div class="faq-question"><?php echo e(__('Comment créer mon profil freelance ?')); ?></div>
          <div class="faq-answer">
            <p><?php echo e(__('Cliquez sur "Créer mon profil freelance" et suivez les 8 étapes du formulaire. Vous devrez renseigner vos compétences, votre expérience, vos tarifs et vos disponibilités.')); ?></p>
          </div>
        </div>

        <div class="faq-item">
          <div class="faq-question"><?php echo e(__('Quels sont les tarifs recommandés ?')); ?></div>
          <div class="faq-answer">
            <p><?php echo e(__('Les tarifs varient selon votre expertise et votre domaine. Sur Junspro, les freelances facturent généralement entre 10€ et 300€ de l\'heure. Vous êtes libre de définir votre propre tarif.')); ?></p>
          </div>
        </div>

        <div class="faq-item">
          <div class="faq-question"><?php echo e(__('Combien de temps prend la création de profil ?')); ?></div>
          <div class="faq-answer">
            <p><?php echo e(__('Le formulaire de création de profil prend environ 15 à 20 minutes. Une fois complété, votre profil sera vérifié et publié sous 5 jours ouvrés.')); ?></p>
          </div>
        </div>

        <div class="faq-item">
          <div class="faq-question"><?php echo e(__('Puis-je modifier mon profil après création ?')); ?></div>
          <div class="faq-answer">
            <p><?php echo e(__('Oui, vous pouvez modifier votre profil, vos tarifs et vos disponibilités à tout moment depuis votre tableau de bord freelance.')); ?></p>
          </div>
        </div>

        <div class="faq-item">
          <div class="faq-question"><?php echo e(__('Comment sont gérés les paiements ?')); ?></div>
          <div class="faq-answer">
            <p><?php echo e(__('Junspro gère les paiements de manière sécurisée. Les clients paient à l\'avance, et vous recevez vos revenus selon le calendrier défini dans votre contrat.')); ?></p>
          </div>
        </div>

        <div class="faq-item">
          <div class="faq-question"><?php echo e(__('Y a-t-il des frais de service ?')); ?></div>
          <div class="faq-answer">
            <p><?php echo e(__('Junspro prélève des frais de service sur chaque transaction. Les détails exacts vous seront communiqués lors de la création de votre profil.')); ?></p>
          </div>
        </div>

        <div class="faq-support">
          <?php echo e(__('Une question ?')); ?> 
          <?php
            try {
              $contactUrl = route('contact');
            } catch (\Exception $e) {
              $contactUrl = url('/contact');
            }
          ?>
          <a href="<?php echo e($contactUrl); ?>"><?php echo e(__('Contacter le support')); ?></a>
        </div>
      </div>
    </section>

    <!-- Footer CTA -->
    <section class="footer-cta">
      <div class="footer-cta-container">
        <h2><?php echo e(__('Prêt(e) à créer votre profil ?')); ?></h2>
        <a href="<?php echo e(route('user.signup')); ?>?role=freelance" class="btn-primary-hero">
          <?php echo e(__('Créer mon profil freelance')); ?>

          <i class="fas fa-arrow-right"></i>
        </a>
      </div>
    </section>
  </div>

  <script>
    // FAQ Accordion
    document.addEventListener('DOMContentLoaded', function() {
      const faqItems = document.querySelectorAll('.faq-item');
      
      faqItems.forEach(item => {
        const question = item.querySelector('.faq-question');
        question.addEventListener('click', () => {
          const isActive = item.classList.contains('active');
          
          // Fermer tous les autres
          faqItems.forEach(otherItem => {
            otherItem.classList.remove('active');
          });
          
          // Ouvrir/fermer celui-ci
          if (!isActive) {
            item.classList.add('active');
          }
        });
      });
    });

    // Scroll animations avec Intersection Observer
    const observerOptions = {
      threshold: 0.1,
      rootMargin: '0px 0px -100px 0px'
    };

    const observer = new IntersectionObserver((entries) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          entry.target.style.opacity = '1';
          entry.target.style.transform = 'translateY(0)';
        }
      });
    }, observerOptions);

    // Observer les éléments avec animations
    document.querySelectorAll('.step-item, .feature-text, .feature-image').forEach(el => {
      observer.observe(el);
    });

    // Smooth scroll pour le lien "Découvrir le fonctionnement"
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
      anchor.addEventListener('click', function (e) {
        e.preventDefault();
        const target = document.querySelector(this.getAttribute('href'));
        if (target) {
          target.scrollIntoView({
            behavior: 'smooth',
            block: 'start'
          });
        }
      });
    });
  </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\younes\Downloads\junspro-main (1)\junspro-main3\resources\views\frontend\freelance\become.blade.php ENDPATH**/ ?>