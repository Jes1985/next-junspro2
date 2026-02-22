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
      font-size: 1rem;
      color: #6b7280;
      line-height: 1.6;
    }

    /* Zone d'upload */
    .photo-upload-section {
      margin-bottom: 3rem;
    }

    .photo-upload-zone {
      border: 2px dashed #d1d5db;
      border-radius: 16px;
      padding: 3rem 2rem;
      text-align: center;
      background: #f9fafb;
      transition: all 0.3s ease;
      cursor: pointer;
      position: relative;
    }

    .photo-upload-zone:hover {
      border-color: var(--junspro-purple);
      background: #faf5ff;
    }

    .photo-upload-zone.dragover {
      border-color: var(--junspro-purple);
      background: #faf5ff;
      box-shadow: 0 0 0 4px rgba(124, 58, 237, 0.1);
    }

    .photo-upload-icon {
      font-size: 3rem;
      color: #9ca3af;
      margin-bottom: 1rem;
    }

    .photo-upload-text {
      font-size: 1rem;
      font-weight: 600;
      color: #374151;
      margin-bottom: 0.5rem;
    }

    .photo-upload-hint {
      font-size: 0.875rem;
      color: #6b7280;
    }

    #photo-input {
      display: none;
    }

    .photo-preview {
      display: none;
      margin-top: 2rem;
      text-align: center;
    }

    .photo-preview.active {
      display: block;
    }

    .photo-preview img {
      width: 200px;
      height: 200px;
      border-radius: 50%;
      object-fit: cover;
      border: 4px solid var(--junspro-purple);
      box-shadow: 0 4px 20px rgba(124, 58, 237, 0.2);
    }

    .photo-preview-name {
      margin-top: 1rem;
      font-size: 0.875rem;
      color: #6b7280;
    }

    /* Aperçu profil */
    .profile-preview {
      background: #f9fafb;
      border-radius: 16px;
      padding: 2rem;
      margin-bottom: 2rem;
      border: 1px solid #e5e7eb;
    }

    .profile-preview-title {
      font-size: 1.125rem;
      font-weight: 600;
      color: #374151;
      margin-bottom: 1.5rem;
    }

    .profile-preview-card {
      background: white;
      border-radius: 12px;
      padding: 1.5rem;
      display: flex;
      align-items: center;
      gap: 1rem;
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
    }

    .profile-preview-avatar {
      width: 64px;
      height: 64px;
      border-radius: 50%;
      background: var(--junspro-gradient);
      display: flex;
      align-items: center;
      justify-content: center;
      color: white;
      font-size: 1.5rem;
      font-weight: 700;
      flex-shrink: 0;
      overflow: hidden;
    }

    .profile-preview-avatar img {
      width: 100%;
      height: 100%;
      object-fit: cover;
    }

    .profile-preview-info {
      flex: 1;
    }

    .profile-preview-name {
      font-size: 1rem;
      font-weight: 600;
      color: #1a202c;
      margin-bottom: 0.25rem;
    }

    .profile-preview-details {
      font-size: 0.875rem;
      color: #6b7280;
    }

    /* Critères photo */
    .photo-criteria {
      margin-top: 3rem;
    }

    .photo-criteria .advice-header {
      display: flex;
      align-items: center;
      justify-content: space-between;
      background: #f8fafc;
      border: 1px solid #e5e7eb;
      border-radius: 12px;
      padding: 0.9rem 1rem;
      cursor: pointer;
      transition: all 0.3s ease;
    }

    .photo-criteria .advice-header:hover {
      background: linear-gradient(135deg, #f3e8ff 0%, #e5e7eb 100%);
    }

    .photo-criteria .advice-header-title {
      font-size: 1rem;
      font-weight: 700;
      color: #1a202c;
      display: flex;
      align-items: center;
      gap: 0.75rem;
    }

    .photo-criteria .advice-header-icon {
      width: 24px;
      height: 24px;
      background: var(--junspro-gradient);
      border-radius: 6px;
      display: flex;
      align-items: center;
      justify-content: center;
      flex-shrink: 0;
    }

    .photo-criteria .advice-toggle-icon {
      width: 20px;
      height: 20px;
      color: var(--junspro-purple);
      transition: transform 0.3s ease;
    }

    .photo-criteria .advice-header.active .advice-toggle-icon {
      transform: rotate(180deg);
    }

    .photo-criteria-content {
      max-height: 0;
      overflow: hidden;
      transition: max-height 0.4s ease, padding 0.3s ease;
      padding: 0;
    }

    .photo-criteria-content.expanded {
      max-height: 1200px;
      padding: 1.25rem 0 0 0;
    }

    .photo-criteria-title {
      font-size: 1.25rem;
      font-weight: 600;
      color: #1a202c;
      margin-bottom: 1.5rem;
    }

    .photo-criteria-list {
      list-style: none;
      padding: 0;
      margin: 0;
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
      gap: 1rem;
    }

    .photo-criteria-item {
      display: flex;
      align-items: flex-start;
      gap: 0.75rem;
      padding: 1rem;
      background: #f9fafb;
      border-radius: 12px;
    }

    .photo-criteria-icon {
      color: #10b981;
      font-size: 1.25rem;
      flex-shrink: 0;
      margin-top: 0.125rem;
    }

    .photo-criteria-text {
      font-size: 0.875rem;
      color: #374151;
      line-height: 1.5;
    }

    .photo-examples {
      display: flex;
      gap: 1rem;
      margin-top: 1.5rem;
      justify-content: center;
      flex-wrap: wrap;
    }

    .photo-example {
      width: 80px;
      height: 80px;
      border-radius: 50%;
      background: #e5e7eb;
      overflow: hidden;
    }

    .photo-example img {
      width: 100%;
      height: 100%;
      object-fit: cover;
    }

    /* Actions */
    .onboarding-actions {
      display: flex;
      justify-content: space-between;
      gap: 1rem;
      margin-top: 2rem;
      padding-top: 2rem;
      border-top: 1px solid #e5e7eb;
    }

    .btn-back {
      padding: 0.875rem 2rem;
      background: white;
      border: 2px solid #e5e7eb;
      border-radius: 12px;
      color: #6b7280;
      font-weight: 600;
      cursor: pointer;
      transition: all 0.2s ease;
      text-decoration: none;
      display: inline-flex;
      align-items: center;
      gap: 0.5rem;
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

    .btn-continue:disabled {
      opacity: 0.5;
      cursor: not-allowed;
      transform: none;
    }

    /* Responsive */
    @media (max-width: 968px) {
      .photo-upload-section {
        grid-template-columns: 1fr !important;
      }
    }

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

      .photo-upload-zone {
        padding: 2rem 1rem;
      }

      .photo-criteria-list {
        grid-template-columns: 1fr;
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
      <?php echo $__env->make('frontend.freelance.onboarding.partials.premium-stepper', ['routeStep' => 2], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
      <!-- Barre de progression -->
      <div class="onboarding-progress" style="display:none;">
        <div class="progress-steps">
          <div class="progress-step completed">
            <div class="progress-step-number">✓</div>
            <span class="progress-step-label">À propos</span>
          </div>
          <span class="progress-chevron">›</span>
          <div class="progress-step active">
            <div class="progress-step-number">2</div>
            <span class="progress-step-label">Photo</span>
          </div>
          <span class="progress-chevron">›</span>
          <div class="progress-step pending">
            <div class="progress-step-number">3</div>
            <span class="progress-step-label">Certifications</span>
          </div>
          <span class="progress-chevron">›</span>
          <div class="progress-step pending">
            <div class="progress-step-number">4</div>
            <span class="progress-step-label">Formation</span>
          </div>
          <span class="progress-chevron">›</span>
          <div class="progress-step pending">
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
          <h1 class="onboarding-title">Photo de profil</h1>
          <p class="onboarding-description">
            Choisissez une photo qui aidera les clients à mieux vous connaître.
          </p>
        </div>

        <?php if(session('success')): ?>
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

        <form action="<?php echo e(route('freelance.onboarding.step2.store')); ?>" method="POST" enctype="multipart/form-data" id="photoForm">
          <?php echo csrf_field(); ?>

          <!-- Zone d'upload et aperçu côte à côte -->
          <div class="photo-upload-section" style="display: grid; grid-template-columns: 1fr 1fr; gap: 2rem; margin-bottom: 3rem;">
            <!-- Zone d'upload à gauche -->
            <div>
              <div class="photo-upload-zone" id="uploadZone" onclick="document.getElementById('photo-input').click()" style="min-height: 300px; display: flex; flex-direction: column; align-items: center; justify-content: center;">
                <div class="photo-upload-icon">📷</div>
                <div class="photo-upload-text">Ajouter une photo</div>
                <div class="photo-upload-hint">JPG ou PNG, 5 Mo max</div>
                <input type="file" id="photo-input" name="photo" accept="image/jpeg,image/png,image/jpg,image/webp">
              </div>
              <div class="photo-preview" id="photoPreview" style="margin-top: 1rem; text-align: center;">
                <img id="previewImage" src="" alt="Aperçu" style="max-width: 100%; border-radius: 12px; box-shadow: 0 4px 12px rgba(0,0,0,0.1);">
                <div class="photo-preview-name" id="previewName" style="margin-top: 0.5rem; font-size: 0.875rem; color: #6b7280;"></div>
              </div>
            </div>

            <!-- Aperçu profil à droite -->
            <div class="profile-preview" style="margin: 0;">
              <div class="profile-preview-title">Aperçu de votre profil</div>
              <div class="profile-preview-card" style="flex-direction: column; align-items: flex-start; gap: 1rem;">
                <div style="display: flex; align-items: center; gap: 1rem; width: 100%;">
                  <div class="profile-preview-avatar" id="profileAvatar" style="width: 80px; height: 80px; font-size: 2rem;">
                    <?php if($user->image): ?>
                      <img src="<?php echo e(asset('assets/img/users/' . $user->image)); ?>" alt="<?php echo e($user->first_name ?? 'Freelance'); ?>">
                    <?php else: ?>
                      <?php echo e(strtoupper(substr($user->first_name ?? 'F', 0, 1))); ?><?php echo e(strtoupper(substr($user->last_name ?? 'L', 0, 1))); ?>

                    <?php endif; ?>
                  </div>
                  <div class="profile-preview-info" style="flex: 1;">
                    <div class="profile-preview-name"><?php echo e($user->first_name ?? 'Prénom'); ?> <?php echo e($user->last_name ?? 'Nom'); ?></div>
                    <?php if($freelancerProfile->skills && count($freelancerProfile->skills) > 0): ?>
                      <div class="profile-preview-details" style="margin-top: 0.5rem;">
                        Domaine de compétences: <?php echo e($freelancerProfile->skills[0]); ?>

                      </div>
                    <?php endif; ?>
                  </div>
                </div>
                <?php if($freelancerProfile->languages && count($freelancerProfile->languages) > 0): ?>
                  <div style="width: 100%; padding-top: 1rem; border-top: 1px solid #e5e7eb;">
                    <div class="profile-preview-details">
                      <strong>Parle:</strong> 
                      <?php $__currentLoopData = $freelancerProfile->languages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php echo e($lang['language'] ?? ''); ?> 
                        <?php if(isset($lang['level'])): ?>
                          (<?php echo e($lang['level'] === 'native' ? 'Natif' : ($lang['level'] === 'fluent' ? 'Courant' : ($lang['level'] === 'intermediate' ? 'Intermédiaire' : 'Débutant'))); ?>)
                        <?php endif; ?>
                        <?php if($index < count($freelancerProfile->languages) - 1): ?>, <?php endif; ?>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                  </div>
                <?php endif; ?>
              </div>
            </div>
          </div>

          <!-- Critères photo -->
          <div class="photo-criteria">
            <div class="advice-header" onclick="togglePhotoCriteria()" style="margin-bottom: 1rem;">
              <div class="advice-header-title">
                <div class="advice-header-icon">
                  <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2.5">
                    <circle cx="12" cy="12" r="10"></circle>
                    <line x1="12" y1="16" x2="12" y2="12"></line>
                    <line x1="12" y1="8" x2="12.01" y2="8"></line>
                  </svg>
                </div>
                <span>Les critères à suivre pour une photo réussie</span>
              </div>
              <svg class="advice-toggle-icon" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <polyline points="6 9 12 15 18 9"></polyline>
              </svg>
            </div>

            <div class="photo-criteria-content" id="photoCriteriaContent">
              <!-- Exemples visuels en haut -->
              <div class="photo-examples" style="margin-bottom: 2rem;">
                <div class="photo-example" style="width: 100px; height: 100px;">
                  <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=200&h=200&fit=crop&crop=face" alt="Exemple">
                </div>
                <div class="photo-example" style="width: 100px; height: 100px;">
                  <img src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?w=200&h=200&fit=crop&crop=face" alt="Exemple">
                </div>
                <div class="photo-example" style="width: 100px; height: 100px;">
                  <img src="https://images.unsplash.com/photo-1500648767791-00dcc994a43e?w=200&h=200&fit=crop&crop=face" alt="Exemple">
                </div>
                <div class="photo-example" style="width: 100px; height: 100px;">
                  <img src="https://images.unsplash.com/photo-1438761681033-6461ffad8d80?w=200&h=200&fit=crop&crop=face" alt="Exemple">
                </div>
              </div>

              <!-- Liste des critères -->
              <ul class="photo-criteria-list" style="grid-template-columns: 1fr; gap: 0.75rem;">
                <li class="photo-criteria-item" style="background: white; border: 1px solid #e5e7eb;">
                  <span class="photo-criteria-icon" style="color: #10b981; font-size: 1.5rem;">✓</span>
                  <span class="photo-criteria-text" style="font-size: 0.95rem; font-weight: 500;">Vous devez faire face à l'objectif</span>
                </li>
                <li class="photo-criteria-item" style="background: white; border: 1px solid #e5e7eb;">
                  <span class="photo-criteria-icon" style="color: #10b981; font-size: 1.5rem;">✓</span>
                  <span class="photo-criteria-text" style="font-size: 0.95rem; font-weight: 500;">Assurez-vous que votre tête et vos épaules sont bien cadrées</span>
                </li>
                <li class="photo-criteria-item" style="background: white; border: 1px solid #e5e7eb;">
                  <span class="photo-criteria-icon" style="color: #10b981; font-size: 1.5rem;">✓</span>
                  <span class="photo-criteria-text" style="font-size: 0.95rem; font-weight: 500;">Vous devez apparaître au centre de la photo</span>
                </li>
                <li class="photo-criteria-item" style="background: white; border: 1px solid #e5e7eb;">
                  <span class="photo-criteria-icon" style="color: #10b981; font-size: 1.5rem;">✓</span>
                  <span class="photo-criteria-text" style="font-size: 0.95rem; font-weight: 500;">Votre visage et vos yeux doivent être entièrement visibles (sauf pour des motifs religieux)</span>
                </li>
                <li class="photo-criteria-item" style="background: white; border: 1px solid #e5e7eb;">
                  <span class="photo-criteria-icon" style="color: #10b981; font-size: 1.5rem;">✓</span>
                  <span class="photo-criteria-text" style="font-size: 0.95rem; font-weight: 500;">Vous devez être la seule personne sur la photo</span>
                </li>
                <li class="photo-criteria-item" style="background: white; border: 1px solid #e5e7eb;">
                  <span class="photo-criteria-icon" style="color: #10b981; font-size: 1.5rem;">✓</span>
                  <span class="photo-criteria-text" style="font-size: 0.95rem; font-weight: 500;">Utilisez une photo en couleurs, en haute définition et sans filtres</span>
                </li>
                <li class="photo-criteria-item" style="background: white; border: 1px solid #e5e7eb;">
                  <span class="photo-criteria-icon" style="color: #10b981; font-size: 1.5rem;">✓</span>
                  <span class="photo-criteria-text" style="font-size: 0.95rem; font-weight: 500;">N'ajoutez pas de logo ni vos coordonnées</span>
                </li>
              </ul>
            </div>
          </div>

          <!-- Actions -->
          <div class="onboarding-actions">
            <a href="<?php echo e(route('freelance.onboarding.step1')); ?>" class="btn-back">
              ← Retour
            </a>
            <button type="submit" class="btn-continue" id="submitBtn" <?php echo e($user->image ? '' : 'disabled'); ?>>
              Sauvegarder et continuer →
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <script>
    const photoInput = document.getElementById('photo-input');
    const uploadZone = document.getElementById('uploadZone');
    const photoPreview = document.getElementById('photoPreview');
    const previewImage = document.getElementById('previewImage');
    const previewName = document.getElementById('previewName');
    const profileAvatar = document.getElementById('profileAvatar');
    const submitBtn = document.getElementById('submitBtn');

    // Gestion du drag & drop
    uploadZone.addEventListener('dragover', (e) => {
      e.preventDefault();
      uploadZone.classList.add('dragover');
    });

    uploadZone.addEventListener('dragleave', () => {
      uploadZone.classList.remove('dragover');
    });

    uploadZone.addEventListener('drop', (e) => {
      e.preventDefault();
      uploadZone.classList.remove('dragover');
      const files = e.dataTransfer.files;
      if (files.length > 0) {
        photoInput.files = files;
        handleFileSelect(files[0]);
      }
    });

    // Gestion de la sélection de fichier
    photoInput.addEventListener('change', (e) => {
      if (e.target.files.length > 0) {
        handleFileSelect(e.target.files[0]);
      }
    });

    // Accordéon critères photo (pattern step 5)
    function togglePhotoCriteria() {
      const header = document.querySelector('.photo-criteria .advice-header');
      const content = document.getElementById('photoCriteriaContent');
      if (!header || !content) return;
      header.classList.toggle('active');
      content.classList.toggle('expanded');
    }

    function handleFileSelect(file) {
      // Vérifier le type de fichier
      if (!file.type.match('image.*')) {
        alert('Veuillez sélectionner une image.');
        photoInput.value = '';
        return;
      }

      // Vérifier la taille (5 Mo max)
      if (file.size > 5 * 1024 * 1024) {
        alert('L\'image ne doit pas dépasser 5 Mo.');
        photoInput.value = '';
        return;
      }

      // Afficher l'aperçu
      const reader = new FileReader();
      reader.onload = (e) => {
        previewImage.src = e.target.result;
        previewName.textContent = file.name;
        photoPreview.style.display = 'block';
        photoPreview.classList.add('active');
        
        // Mettre à jour l'aperçu du profil
        const existingImg = profileAvatar.querySelector('img');
        if (existingImg) {
          existingImg.src = e.target.result;
        } else {
          const img = document.createElement('img');
          img.src = e.target.result;
          img.alt = 'Photo de profil';
          profileAvatar.innerHTML = '';
          profileAvatar.appendChild(img);
        }
        
        // Activer le bouton
        submitBtn.disabled = false;
        submitBtn.style.opacity = '1';
        submitBtn.style.cursor = 'pointer';
      };
      reader.readAsDataURL(file);
    }

    // Gestion de la soumission du formulaire
    photoForm.addEventListener('submit', function(e) {
      // Vérifier qu'une photo est sélectionnée ou existe déjà
      if (!photoInput.files.length && !<?php echo e($user->image ? 'true' : 'false'); ?>) {
        e.preventDefault();
        alert('Veuillez sélectionner une photo de profil.');
        return false;
      }
    });
  </script>
<?php $__env->stopSection(); ?>



<?php echo $__env->make('frontend.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\younes\Downloads\junspro-main (1)\junspro-main3\resources\views\frontend\freelance\onboarding\step2.blade.php ENDPATH**/ ?>