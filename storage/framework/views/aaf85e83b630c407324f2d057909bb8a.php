<?php $__env->startSection('style'); ?>
  <link rel="stylesheet" href="<?php echo e(asset('assets/css/summernote-content.css')); ?>">
  <style>
    :root {
      --junspro-purple: #7C3AED;
      --junspro-blue: #1e40af;
      --junspro-gradient: linear-gradient(135deg, #1e40af 0%, #4c1d95 50%, #7c3aed 100%);
    }

    /* Page onboarding freelance */
    .onboarding-page {
      min-height: 100vh;
      background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
      padding: 2rem 0 4rem;
    }

    .onboarding-container {
      max-width: 1100px;
      margin: 0 auto;
      padding: 0 1.5rem;
    }

    /* Barre de progression */
    .onboarding-progress {
      background: white;
      border-radius: 16px;
      padding: 2rem;
      margin-bottom: 2rem;
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
    }

    .progress-steps {
      display: flex;
      align-items: center;
      justify-content: space-between;
      gap: 0.5rem;
      flex-wrap: wrap;
    }

    .progress-step {
      display: flex;
      align-items: center;
      gap: 0.5rem;
      flex: 1;
      min-width: 0;
    }

    .progress-step-number {
      width: 36px;
      height: 36px;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      font-weight: 600;
      font-size: 0.875rem;
      flex-shrink: 0;
      transition: all 0.3s ease;
    }

    .progress-step.completed .progress-step-number {
      background: var(--junspro-gradient);
      color: white;
    }

    .progress-step.active .progress-step-number {
      background: var(--junspro-gradient);
      color: white;
      box-shadow: 0 0 0 4px rgba(124, 58, 237, 0.1);
    }

    .progress-step.pending .progress-step-number {
      background: #e5e7eb;
      color: #6b7280;
    }

    .progress-step-label {
      font-size: 0.875rem;
      font-weight: 500;
      color: #374151;
      white-space: nowrap;
      overflow: hidden;
      text-overflow: ellipsis;
    }

    .progress-step.completed .progress-step-label,
    .progress-step.active .progress-step-label {
      color: var(--junspro-purple);
      font-weight: 600;
    }

    .progress-chevron {
      color: #d1d5db;
      font-size: 1.25rem;
      flex-shrink: 0;
      margin: 0 0.5rem;
    }

    /* Contenu principal */
    .onboarding-content {
      background: white;
      border-radius: 24px;
      padding: 3rem;
      box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
    }

    .onboarding-header {
      margin-bottom: 2.5rem;
    }

    .onboarding-title {
      font-size: 2.25rem;
      font-weight: 800;
      color: #1a202c;
      margin-bottom: 1.5rem;
      letter-spacing: -0.02em;
      background: linear-gradient(135deg, #1a202c 0%, #4c1d95 100%);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      background-clip: text;
    }

    .onboarding-description {
      font-size: 1.05rem;
      color: #4b5563;
      line-height: 1.7;
      font-weight: 400;
    }

    .onboarding-description a {
      color: var(--junspro-purple);
      text-decoration: underline;
      font-weight: 600;
    }

    /* Formulaires */
    .form-group {
      margin-bottom: 2rem;
    }

    .form-label {
      display: block;
      font-size: 0.95rem;
      font-weight: 600;
      color: #1a202c;
      margin-bottom: 0.75rem;
      letter-spacing: -0.01em;
    }

    .form-textarea {
      width: 100%;
      padding: 1.25rem;
      border: 2px solid #e5e7eb;
      border-radius: 12px;
      font-size: 0.95rem;
      color: #1a202c;
      transition: all 0.3s ease;
      box-sizing: border-box;
      background: white;
      font-weight: 400;
      font-family: inherit;
      resize: vertical;
      min-height: 300px;
      line-height: 1.6;
    }

    .form-textarea:focus {
      outline: none;
      border-color: var(--junspro-purple);
      box-shadow: 0 0 0 4px rgba(124, 58, 237, 0.1);
      background: #faf5ff;
    }
    
    .form-textarea:hover {
      border-color: #d1d5db;
    }

    .form-textarea-error {
      border-color: #ef4444 !important;
    }

    .form-error {
      display: block;
      color: #ef4444;
      font-size: 0.875rem;
      margin-top: 0.5rem;
    }

    .char-counter {
      font-size: 0.875rem;
      color: #6b7280;
      text-align: right;
      margin-top: 0.5rem;
    }

    .char-counter.warning {
      color: #f59e0b;
    }

    .char-counter.error {
      color: #ef4444;
    }

    .advice-section {
      background: white;
      border-radius: 20px;
      padding: 0;
      margin-bottom: 2rem;
      box-shadow: 0 2px 12px rgba(0, 0, 0, 0.04);
      overflow: hidden;
    }

    .advice-header {
      padding: 1.5rem 2rem;
      background: linear-gradient(135deg, #faf5ff 0%, #f3f4f6 100%);
      border-bottom: 1px solid #e5e7eb;
      cursor: pointer;
      transition: all 0.3s ease;
      display: flex;
      align-items: center;
      justify-content: space-between;
    }

    .advice-header:hover {
      background: linear-gradient(135deg, #f3e8ff 0%, #e5e7eb 100%);
    }

    .advice-header-title {
      font-size: 1rem;
      font-weight: 700;
      color: #1a202c;
      display: flex;
      align-items: center;
      gap: 0.75rem;
    }

    .advice-header-icon {
      width: 24px;
      height: 24px;
      background: var(--junspro-gradient);
      border-radius: 6px;
      display: flex;
      align-items: center;
      justify-content: center;
      flex-shrink: 0;
    }

    .advice-toggle-icon {
      width: 20px;
      height: 20px;
      color: var(--junspro-purple);
      transition: transform 0.3s ease;
    }

    .advice-header.active .advice-toggle-icon {
      transform: rotate(180deg);
    }

    .advice-content {
      max-height: 0;
      overflow: hidden;
      transition: max-height 0.4s ease, padding 0.3s ease;
      padding: 0 2rem;
    }

    .advice-content.expanded {
      max-height: 1000px;
      padding: 1.5rem 2rem;
    }

    .advice-list {
      list-style: none;
      padding: 0;
      margin: 0;
      display: grid;
      gap: 0.75rem;
    }

    .advice-item {
      display: flex;
      align-items: flex-start;
      gap: 1rem;
      padding: 1rem 1.25rem;
      background: linear-gradient(135deg, #faf5ff 0%, #ffffff 100%);
      border-radius: 12px;
      border: 1px solid #e9d5ff;
      transition: all 0.3s ease;
      cursor: pointer;
      position: relative;
      overflow: hidden;
    }

    .advice-item::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      width: 4px;
      height: 100%;
      background: var(--junspro-gradient);
      transform: scaleY(0);
      transition: transform 0.3s ease;
    }

    .advice-item:hover {
      border-color: var(--junspro-purple);
      box-shadow: 0 4px 12px rgba(124, 58, 237, 0.1);
      transform: translateX(4px);
    }

    .advice-item:hover::before {
      transform: scaleY(1);
    }

    .advice-item.expanded {
      background: white;
      border-color: var(--junspro-purple);
      box-shadow: 0 4px 16px rgba(124, 58, 237, 0.15);
    }

    .advice-item.expanded::before {
      transform: scaleY(1);
    }

    .advice-number {
      width: 32px;
      height: 32px;
      background: var(--junspro-gradient);
      border-radius: 8px;
      display: flex;
      align-items: center;
      justify-content: center;
      color: white;
      font-weight: 700;
      font-size: 0.875rem;
      flex-shrink: 0;
      box-shadow: 0 2px 8px rgba(124, 58, 237, 0.2);
    }

    .advice-item-content {
      flex: 1;
      min-width: 0;
    }

    .advice-item-title {
      font-size: 0.95rem;
      font-weight: 700;
      color: #1a202c;
      margin-bottom: 0.5rem;
      display: flex;
      align-items: center;
      justify-content: space-between;
    }

    .advice-item-text {
      font-size: 0.9rem;
      color: #4b5563;
      line-height: 1.7;
      max-height: 0;
      overflow: hidden;
      transition: max-height 0.4s ease, margin-top 0.3s ease;
      margin-top: 0;
    }

    .advice-item.expanded .advice-item-text {
      max-height: 500px;
      margin-top: 0.5rem;
    }

    .advice-item-toggle {
      width: 20px;
      height: 20px;
      color: var(--junspro-purple);
      transition: transform 0.3s ease;
      flex-shrink: 0;
      margin-left: 0.5rem;
    }

    .advice-item.expanded .advice-item-toggle {
      transform: rotate(180deg);
    }

    .onboarding-actions {
      display: flex;
      justify-content: space-between;
      align-items: center;
      gap: 1rem;
      margin-top: 3rem;
      padding-top: 2rem;
      border-top: 2px solid #f3f4f6;
    }

    .btn-back {
      padding: 0.875rem 2rem;
      background: white;
      border: 2px solid #e5e7eb;
      border-radius: 12px;
      color: #374151;
      font-weight: 600;
      text-decoration: none;
      cursor: pointer;
      transition: all 0.3s ease;
      display: inline-flex;
      align-items: center;
    }

    .btn-back:hover {
      border-color: #d1d5db;
      background: #f9fafb;
    }

    .btn-continue {
      padding: 0.875rem 2rem;
      background: var(--junspro-gradient);
      border: none;
      border-radius: 12px;
      color: white;
      font-weight: 600;
      cursor: pointer;
      transition: all 0.3s ease;
      box-shadow: 0 4px 15px rgba(124, 58, 237, 0.3);
    }

    .btn-continue:hover {
      transform: translateY(-2px);
      box-shadow: 0 6px 20px rgba(124, 58, 237, 0.4);
    }

    /* Responsive */
    @media (max-width: 768px) {
      .onboarding-content {
        padding: 2rem 1.5rem;
      }

      .progress-steps {
        flex-direction: column;
        align-items: flex-start;
      }

      .progress-chevron {
        display: none;
      }

      .onboarding-actions {
        flex-direction: column-reverse;
      }

      .btn-back,
      .btn-continue {
        width: 100%;
        justify-content: center;
      }
    }
  </style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
  <div class="onboarding-page">
    <div class="onboarding-container">
      <?php echo $__env->make('frontend.freelance.onboarding.partials.premium-stepper', ['routeStep' => 5], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
      <!-- Barre de progression -->
      <div class="onboarding-progress" style="display:none;">
        <div class="progress-steps">
          <div class="progress-step completed">
            <div class="progress-step-number">✓</div>
            <span class="progress-step-label">À propos</span>
          </div>
          <span class="progress-chevron">›</span>
          <div class="progress-step completed">
            <div class="progress-step-number">✓</div>
            <span class="progress-step-label">Photo</span>
          </div>
          <span class="progress-chevron">›</span>
          <div class="progress-step completed">
            <div class="progress-step-number">✓</div>
            <span class="progress-step-label">Certifications</span>
          </div>
          <span class="progress-chevron">›</span>
          <div class="progress-step completed">
            <div class="progress-step-number">✓</div>
            <span class="progress-step-label">Formation</span>
          </div>
          <span class="progress-chevron">›</span>
          <div class="progress-step active">
            <div class="progress-step-number">5</div>
            <span class="progress-step-label">Description</span>
          </div>
          <span class="progress-chevron">›</span>
          <div class="progress-step pending">
            <div class="progress-step-number">6</div>
            <span class="progress-step-label">Vidéo</span>
          </div>
          <span class="progress-chevron">›</span>
          <div class="progress-step pending">
            <div class="progress-step-number">7</div>
            <span class="progress-step-label">Disponibilité</span>
          </div>
          <span class="progress-chevron">›</span>
          <div class="progress-step pending">
            <div class="progress-step-number">8</div>
            <span class="progress-step-label">Tarif</span>
          </div>
        </div>
      </div>

      <!-- Contenu principal -->
      <div class="onboarding-content">
        <div class="onboarding-header">
          <h1 class="onboarding-title">Description du profil</h1>
          <p class="onboarding-description">
            Ces informations seront affichées publiquement dans votre profil. Rédigez-les dans la langue de votre choix, en vous assurant de suivre nos <strong>critères pour que votre profil soit approuvé</strong>.
          </p>
        </div>

        <?php if(session('success') && !empty(old('bio'))): ?>
          <div style="padding: 1rem; background: #f0fdf4; border: 1px solid #86efac; border-radius: 12px; color: #166534; margin-bottom: 1.5rem;">
            ✓ <?php echo e(session('success')); ?>

          </div>
        <?php endif; ?>

        <?php if($errors->any()): ?>
          <div style="padding: 1rem; background: #fef2f2; border: 1px solid #fca5a5; border-radius: 12px; color: #991b1b; margin-bottom: 1.5rem;">
            <ul style="margin: 0; padding-left: 1.25rem;">
              <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li><?php echo e($error); ?></li>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
          </div>
        <?php endif; ?>

        <!-- Section conseils -->
        <div class="advice-section">
          <div class="advice-header" onclick="toggleAdviceSection()">
            <div class="advice-header-title">
              <div class="advice-header-icon">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2.5">
                  <circle cx="12" cy="12" r="10"></circle>
                  <line x1="12" y1="16" x2="12" y2="12"></line>
                  <line x1="12" y1="8" x2="12.01" y2="8"></line>
                </svg>
              </div>
              <span>Conseils pour rédiger votre description professionnelle</span>
            </div>
            <svg class="advice-toggle-icon" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <polyline points="6 9 12 15 18 9"></polyline>
            </svg>
          </div>
          <div class="advice-content" id="adviceContent">
            <ul class="advice-list">
              <li class="advice-item" onclick="toggleAdviceItem(this)">
                <div class="advice-number">1</div>
                <div class="advice-item-content">
                  <div class="advice-item-title">
                    <span>Présentez-vous</span>
                    <svg class="advice-item-toggle" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                      <polyline points="6 9 12 15 18 9"></polyline>
                    </svg>
                  </div>
                  <div class="advice-item-text">
                    Parlez un peu de vous pour que les clients potentiels découvrent qui vous êtes. Faites part de votre expérience et de votre passion pour votre domaine, et décrivez brièvement vos centres d'intérêt.
                  </div>
                </div>
              </li>
              <li class="advice-item" onclick="toggleAdviceItem(this)">
                <div class="advice-number">2</div>
                <div class="advice-item-content">
                  <div class="advice-item-title">
                    <span>Parlez de votre expérience</span>
                    <svg class="advice-item-toggle" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                      <polyline points="6 9 12 15 18 9"></polyline>
                    </svg>
                  </div>
                  <div class="advice-item-text">
                    Décrivez votre parcours professionnel, vos compétences clés et les projets sur lesquels vous avez travaillé. Mettez en avant ce qui vous rend unique et précieux pour vos clients.
                  </div>
                </div>
              </li>
              <li class="advice-item" onclick="toggleAdviceItem(this)">
                <div class="advice-number">3</div>
                <div class="advice-item-content">
                  <div class="advice-item-title">
                    <span>Motivez les clients potentiels</span>
                    <svg class="advice-item-toggle" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                      <polyline points="6 9 12 15 18 9"></polyline>
                    </svg>
                  </div>
                  <div class="advice-item-text">
                    Expliquez pourquoi les clients devraient vous choisir. Partagez votre approche, votre méthode de travail et ce qui vous passionne dans votre domaine. Montrez votre enthousiasme et votre engagement.
                  </div>
                </div>
              </li>
              <li class="advice-item" onclick="toggleAdviceItem(this)">
                <div class="advice-number">4</div>
                <div class="advice-item-content">
                  <div class="advice-item-title">
                    <span>Choisissez un titre accrocheur</span>
                    <svg class="advice-item-toggle" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                      <polyline points="6 9 12 15 18 9"></polyline>
                    </svg>
                  </div>
                  <div class="advice-item-text">
                    Le titre est ce que les clients voient en premier. Faites en sorte d'attirer leur attention en indiquant vos domaines de compétences et en les encourageant à lire votre description.
                  </div>
                </div>
              </li>
            </ul>
          </div>
        </div>

        <form action="<?php echo e(route('freelance.onboarding.step5.store')); ?>" method="POST" id="descriptionForm">
          <?php echo csrf_field(); ?>

          <!-- Champ unique pour la description professionnelle -->
          <div class="form-group">
            <label class="form-label">Votre description professionnelle</label>
            <textarea 
              name="bio" 
              id="bio"
              class="form-textarea <?php $__errorArgs = ['bio'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> form-textarea-error <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
              placeholder="Rédigez ici votre description professionnelle complète. Vous pouvez vous inspirer des conseils ci-dessus pour structurer votre texte..."
              oninput="updateCharCounter(this)"
              maxlength="5000"
              required
            ><?php echo e(old('bio', $data['bio'] ?? '')); ?></textarea>
            <div class="char-counter" id="char-counter">
              <span id="char-count">0</span> / 5000 caractères
            </div>
            <?php $__errorArgs = ['bio'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
              <span class="form-error"><?php echo e($message); ?></span>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
          </div>

          <!-- Actions -->
          <div class="onboarding-actions">
            <a href="<?php echo e(route('freelance.onboarding.step4')); ?>" class="btn-back">
              ← Retour
            </a>
            <button type="submit" class="btn-continue">
              Sauvegarder et continuer →
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <script>
    function updateCharCounter(element) {
      const count = element.value.length;
      const maxLength = parseInt(element.getAttribute('maxlength'));
      const counter = document.getElementById('char-counter');
      const countSpan = document.getElementById('char-count');
      
      countSpan.textContent = count;
      
      // Mettre à jour la classe pour le style
      counter.classList.remove('warning', 'error');
      if (count > maxLength * 0.9) {
        counter.classList.add('warning');
      }
      if (count >= maxLength) {
        counter.classList.add('error');
      }
    }

    function toggleAdviceSection() {
      const header = document.querySelector('.advice-header');
      const content = document.getElementById('adviceContent');
      
      header.classList.toggle('active');
      content.classList.toggle('expanded');
    }

    function toggleAdviceItem(item) {
      item.classList.toggle('expanded');
    }

    // Initialiser le compteur au chargement
    document.addEventListener('DOMContentLoaded', function() {
      const bioTextarea = document.getElementById('bio');
      if (bioTextarea) {
        updateCharCounter(bioTextarea);
      }
    });
  </script>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('frontend.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\younes\Downloads\junspro-main (1)\junspro-main3\resources\views\frontend\freelance\onboarding\step5.blade.php ENDPATH**/ ?>