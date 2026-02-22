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

    /* Formulaires */
    .form-group {
      margin-bottom: 1.5rem;
    }

    .form-label {
      display: block;
      font-size: 0.95rem;
      font-weight: 600;
      color: #1a202c;
      margin-bottom: 0.75rem;
      letter-spacing: -0.01em;
    }

    .form-input,
    .form-select,
    .form-textarea {
      width: 100%;
      padding: 0.75rem 1rem;
      border: 1.5px solid #e5e7eb;
      border-radius: 12px;
      font-size: 0.95rem;
      color: #1a202c;
      transition: all 0.2s ease;
      box-sizing: border-box;
    }

    .form-input:focus,
    .form-select:focus,
    .form-textarea:focus {
      outline: none;
      border-color: var(--junspro-purple);
      box-shadow: 0 0 0 3px rgba(124, 58, 237, 0.1);
    }

    .form-textarea {
      min-height: 120px;
      resize: vertical;
    }

    .form-error {
      color: #dc2626;
      font-size: 0.875rem;
      margin-top: 0.25rem;
      display: block;
    }

    .form-input-error {
      border-color: #dc2626;
    }

    /* Certifications */
    .certifications-container {
      margin-bottom: 2rem;
    }

    .certification-item {
      background: #f9fafb;
      border: 1px solid #e5e7eb;
      border-radius: 12px;
      padding: 1.5rem;
      margin-bottom: 1rem;
      position: relative;
    }

    .certification-item-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 1rem;
    }

    .certification-item-title {
      font-weight: 600;
      color: #1a202c;
    }

    .btn-remove-certification {
      background: #ef4444;
      color: white;
      border: none;
      border-radius: 6px;
      width: 32px;
      height: 32px;
      cursor: pointer;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 1.25rem;
      transition: all 0.2s ease;
    }

    .btn-remove-certification:hover {
      background: #dc2626;
    }

    .btn-add-certification {
      color: var(--junspro-purple);
      background: white;
      border: 2px dashed var(--junspro-purple);
      border-radius: 12px;
      padding: 0.875rem 1.75rem;
      font-weight: 600;
      cursor: pointer;
      transition: all 0.3s ease;
      margin-top: 1rem;
      display: inline-flex;
      align-items: center;
      font-size: 0.95rem;
      box-shadow: 0 2px 8px rgba(124, 58, 237, 0.1);
    }

    .btn-add-certification:hover {
      background: #faf5ff;
      border-color: #7C3AED;
      transform: translateY(-2px);
      box-shadow: 0 4px 12px rgba(124, 58, 237, 0.2);
    }

    /* Section badge vérifié */
    .verified-badge-section {
      background: #f9fafb;
      border: 1px solid #e5e7eb;
      border-radius: 16px;
      padding: 2rem;
      margin-top: 2rem;
    }

    .verified-badge-title {
      font-size: 1.25rem;
      font-weight: 700;
      color: #1a202c;
      margin-bottom: 1rem;
    }

    .verified-badge-description {
      font-size: 0.95rem;
      color: #4b5563;
      line-height: 1.7;
      margin-bottom: 1.5rem;
    }

    .verified-badge-requirements {
      font-size: 0.875rem;
      color: #6b7280;
      margin-bottom: 1rem;
    }

    .file-upload-zone {
      border: 2px dashed #c4b5fd;
      border-radius: 16px;
      padding: 2.5rem;
      text-align: center;
      background: white;
      cursor: pointer;
      transition: all 0.3s ease;
      position: relative;
    }

    .file-upload-zone:hover {
      border-color: var(--junspro-purple);
      background: #faf5ff;
      transform: translateY(-2px);
      box-shadow: 0 8px 24px rgba(124, 58, 237, 0.15);
    }

    .file-upload-zone.dragover {
      border-color: var(--junspro-purple);
      background: #faf5ff;
      box-shadow: 0 0 0 4px rgba(124, 58, 237, 0.2);
      transform: scale(1.02);
    }

    .file-upload-icon {
      font-size: 2rem;
      color: #9ca3af;
      margin-bottom: 0.5rem;
    }

    .file-upload-text {
      font-size: 0.95rem;
      font-weight: 600;
      color: #374151;
      margin-bottom: 0.25rem;
    }

    .file-upload-hint {
      font-size: 0.875rem;
      color: #6b7280;
    }

    #certificate-input {
      display: none;
    }

    .file-preview {
      margin-top: 1rem;
      padding: 1rem;
      background: white;
      border-radius: 8px;
      border: 1px solid #e5e7eb;
      display: flex;
      align-items: center;
      gap: 1rem;
    }

    .file-preview-icon {
      font-size: 2rem;
    }

    .file-preview-info {
      flex: 1;
    }

    .file-preview-name {
      font-weight: 600;
      color: #1a202c;
    }

    .file-preview-size {
      font-size: 0.875rem;
      color: #6b7280;
    }

    /* Checkbox */
    .checkbox-group {
      display: flex;
      align-items: center;
      gap: 0.75rem;
      margin-bottom: 1.5rem;
    }

    .checkbox-input {
      width: 20px;
      height: 20px;
      cursor: pointer;
    }

    .checkbox-label {
      font-size: 0.95rem;
      color: #374151;
      cursor: pointer;
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
      <?php echo $__env->make('frontend.freelance.onboarding.partials.premium-stepper', ['routeStep' => 3], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
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
          <div class="progress-step active">
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
          <h1 class="onboarding-title">Certifications & Accréditations</h1>
          <p class="onboarding-description">
            Valorisez votre expertise professionnelle en ajoutant vos certifications, diplômes et accréditations. Ces éléments renforcent votre crédibilité auprès des clients et vous permettent de vous démarquer sur Junspro.
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

        <form action="<?php echo e(route('freelance.onboarding.step3.store')); ?>" method="POST" enctype="multipart/form-data" id="certificationsForm">
          <?php echo csrf_field(); ?>

          <!-- Option : Pas de certificat -->
          <div class="checkbox-group">
            <input 
              type="checkbox" 
              id="no_certificate" 
              name="no_certificate" 
              value="1"
              class="checkbox-input"
              <?php echo e(old('no_certificate') ? 'checked' : ''); ?>

              onchange="toggleCertifications(this)"
            >
            <label for="no_certificate" class="checkbox-label">
              Je n'ai pas de certification
            </label>
          </div>

          <!-- Liste des certifications -->
          <div id="certificationsContainer" class="certifications-container">
            <?php
              $certifications = old('certifications', $data['certifications'] ?? []);
              if (empty($certifications)) {
                $certifications = [['subject' => '', 'name' => '', 'description' => '']];
              }
            ?>
            <?php $__currentLoopData = $certifications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $cert): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <div class="certification-item" data-cert-index="<?php echo e($index); ?>">
                <div class="certification-item-header">
                  <span class="certification-item-title">Certification <?php echo e($index + 1); ?></span>
                  <?php if($index > 0): ?>
                    <button type="button" class="btn-remove-certification" onclick="removeCertification(this)">✕</button>
                  <?php endif; ?>
                </div>
                <div class="form-group">
                  <label class="form-label">Domaine de compétences</label>
                  <select name="certifications[<?php echo e($index); ?>][subject]" class="form-select <?php $__errorArgs = ['certifications.' . $index . '.subject'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> form-input-error <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" required>
                    <option value="">Sélectionner...</option>
                    <?php if($freelancerProfile->skills): ?>
                      <?php $__currentLoopData = $freelancerProfile->skills; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $skill): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($skill); ?>" <?php echo e(($cert['subject'] ?? '') === $skill ? 'selected' : ''); ?>><?php echo e($skill); ?></option>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>
                    <option value="Développement Web" <?php echo e(($cert['subject'] ?? '') === 'Développement Web' ? 'selected' : ''); ?>>Développement Web</option>
                    <option value="Design Graphique" <?php echo e(($cert['subject'] ?? '') === 'Design Graphique' ? 'selected' : ''); ?>>Design Graphique</option>
                    <option value="Marketing Digital" <?php echo e(($cert['subject'] ?? '') === 'Marketing Digital' ? 'selected' : ''); ?>>Marketing Digital</option>
                    <option value="Autre" <?php echo e(($cert['subject'] ?? '') === 'Autre' ? 'selected' : ''); ?>>Autre</option>
                  </select>
                  <?php $__errorArgs = ['certifications.' . $index . '.subject'];
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
                <div class="form-group">
                  <label class="form-label">Nom de la certification ou accréditation</label>
                  <input 
                    type="text" 
                    name="certifications[<?php echo e($index); ?>][name]" 
                    class="form-input <?php $__errorArgs = ['certifications.' . $index . '.name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> form-input-error <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                    value="<?php echo e($cert['name'] ?? ''); ?>"
                    placeholder="Ex: Certification Google Ads, AWS Solutions Architect, Diplôme en Design UX/UI, Certification Scrum Master..."
                    required
                  >
                  <?php $__errorArgs = ['certifications.' . $index . '.name'];
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
                <div class="form-group">
                  <label class="form-label">Description</label>
                  <textarea 
                    name="certifications[<?php echo e($index); ?>][description]" 
                    class="form-textarea <?php $__errorArgs = ['certifications.' . $index . '.description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> form-input-error <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                    placeholder="Décrivez votre certification, les compétences acquises, l'organisme délivrant..."
                    required
                  ><?php echo e($cert['description'] ?? ''); ?></textarea>
                  <?php $__errorArgs = ['certifications.' . $index . '.description'];
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
              </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </div>

          <button type="button" class="btn-add-certification" onclick="addCertification()" id="addCertBtn">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="display: inline-block; vertical-align: middle; margin-right: 0.5rem;">
              <line x1="12" y1="5" x2="12" y2="19"></line>
              <line x1="5" y1="12" x2="19" y2="12"></line>
            </svg>
            Ajouter une autre certification
          </button>

          <!-- Section badge vérifié -->
          <div class="verified-badge-section" style="background: linear-gradient(135deg, #faf5ff 0%, #f3f4f6 100%); border: 2px solid #e9d5ff; border-radius: 20px; padding: 2.5rem; margin-top: 3rem; position: relative; overflow: hidden;">
            <div style="position: absolute; top: -50px; right: -50px; width: 200px; height: 200px; background: radial-gradient(circle, rgba(124, 58, 237, 0.1) 0%, transparent 70%); border-radius: 50%;"></div>
            <div style="position: relative; z-index: 1;">
              <div style="display: flex; align-items: center; gap: 1rem; margin-bottom: 1.5rem;">
                <div style="width: 48px; height: 48px; background: var(--junspro-gradient); border-radius: 12px; display: flex; align-items: center; justify-content: center; box-shadow: 0 4px 12px rgba(124, 58, 237, 0.3);">
                  <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2.5">
                    <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                    <polyline points="22 4 12 14.01 9 11.01"></polyline>
                  </svg>
                </div>
                <h2 class="verified-badge-title" style="margin: 0; font-size: 1.5rem; font-weight: 700; color: #1a202c;">
                  Obtenez le badge « Certificat vérifié »
                </h2>
              </div>
              
              <div class="verified-badge-description" style="background: white; border-radius: 16px; padding: 1.75rem; margin-bottom: 1.5rem; box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);">
                <p style="margin-bottom: 1rem; font-weight: 600; color: #1a202c; font-size: 1rem;">
                  Votre certificat est vérifié par notre équipe avant l'activation du badge.
                </p>
                <p style="color: #4b5563; line-height: 1.8; font-size: 0.95rem; margin: 0;">
                  Conformément aux principes de protection des données, le document est supprimé après vérification. Nous conservons uniquement les informations nécessaires à la preuve de contrôle (statut, horodatage, historique), afin d'assurer la fiabilité du badge et prévenir les usages frauduleux.
                </p>
              </div>
              
              <div class="verified-badge-requirements" style="background: white; border-radius: 12px; padding: 1.25rem; margin-bottom: 1.5rem; border: 1px solid #e5e7eb;">
                <div style="display: flex; align-items: center; gap: 0.75rem; margin-bottom: 0.75rem;">
                  <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#10b981" stroke-width="2">
                    <circle cx="12" cy="12" r="10"></circle>
                    <path d="M12 16v-4M12 8h.01"></path>
                  </svg>
                  <span style="font-size: 0.9rem; color: #374151;"><strong style="color: #1a202c;">Format accepté :</strong> JPG ou PNG</span>
                </div>
                <div style="display: flex; align-items: center; gap: 0.75rem;">
                  <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#10b981" stroke-width="2">
                    <circle cx="12" cy="12" r="10"></circle>
                    <path d="M12 16v-4M12 8h.01"></path>
                  </svg>
                  <span style="font-size: 0.9rem; color: #374151;"><strong style="color: #1a202c;">Taille maximale :</strong> 20 Mo</span>
                </div>
              </div>
              
              <div class="file-upload-zone" id="certificateUploadZone" onclick="document.getElementById('certificate-input').click()" style="background: white; border: 2px dashed #c4b5fd; border-radius: 16px; padding: 2.5rem; text-align: center; cursor: pointer; transition: all 0.3s ease; position: relative;">
                <div style="width: 64px; height: 64px; background: linear-gradient(135deg, #f3f4f6 0%, #e5e7eb 100%); border-radius: 12px; display: flex; align-items: center; justify-content: center; margin: 0 auto 1rem; box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);">
                  <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="#7C3AED" stroke-width="2">
                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                    <polyline points="17 8 12 3 7 8"></polyline>
                    <line x1="12" y1="3" x2="12" y2="15"></line>
                  </svg>
                </div>
                <div class="file-upload-text" style="font-size: 1.05rem; font-weight: 600; color: #1a202c; margin-bottom: 0.5rem;">
                  Importer votre certificat
                </div>
                <div class="file-upload-hint" style="font-size: 0.9rem; color: #6b7280;">
                  Glissez-déposez votre fichier ou cliquez pour sélectionner
                </div>
                <input type="file" id="certificate-input" name="certificate_file[]" accept="image/jpeg,image/png,image/jpg" multiple style="display: none;">
              </div>
              
              <div id="certificateFilesPreview" style="margin-top: 1rem;"></div>
              
              <button type="button" class="btn-add-certification" onclick="document.getElementById('certificate-input').click()" style="margin-top: 1rem; background: white; border: 1px solid #e5e7eb; color: #7C3AED; padding: 0.75rem 1.5rem; border-radius: 10px; font-weight: 600; transition: all 0.2s ease;">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="display: inline-block; vertical-align: middle; margin-right: 0.5rem;">
                  <line x1="12" y1="5" x2="12" y2="19"></line>
                  <line x1="5" y1="12" x2="19" y2="12"></line>
                </svg>
                Ajouter un autre certificat
              </button>
            </div>
          </div>

          <!-- Actions -->
          <div class="onboarding-actions">
            <a href="<?php echo e(route('freelance.onboarding.step2')); ?>" class="btn-back">
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
    let certificationIndex = <?php echo e(count($certifications ?? [['subject' => '', 'name' => '', 'description' => '']])); ?>;
    let certificateFiles = [];

    function toggleCertifications(checkbox) {
      const container = document.getElementById('certificationsContainer');
      const addBtn = document.getElementById('addCertBtn');
      const form = document.getElementById('certificationsForm');
      
      if (checkbox.checked) {
        container.style.display = 'none';
        addBtn.style.display = 'none';
        // Désactiver les champs requis
        const requiredFields = container.querySelectorAll('[required]');
        requiredFields.forEach(field => field.removeAttribute('required'));
      } else {
        container.style.display = 'block';
        addBtn.style.display = 'block';
        // Réactiver les champs requis
        const requiredFields = container.querySelectorAll('input, select, textarea');
        requiredFields.forEach(field => {
          if (field.name.includes('certifications')) {
            field.setAttribute('required', 'required');
          }
        });
      }
    }

    function addCertification() {
      const container = document.getElementById('certificationsContainer');
      const newItem = document.createElement('div');
      newItem.className = 'certification-item';
      newItem.setAttribute('data-cert-index', certificationIndex);
      
      newItem.innerHTML = `
        <div class="certification-item-header">
          <span class="certification-item-title" style="font-size: 1.1rem; font-weight: 700; color: #1a202c;">Certification ${certificationIndex + 1}</span>
          <button type="button" class="btn-remove-certification" onclick="removeCertification(this)" style="width: 36px; height: 36px; border: none; background: #fee2e2; color: #dc2626; border-radius: 8px; cursor: pointer; font-size: 18px; display: flex; align-items: center; justify-content: center; transition: all 0.2s ease; font-weight: 600;">✕</button>
        </div>
        <div class="form-group">
          <label class="form-label">Domaine de compétences</label>
          <select name="certifications[${certificationIndex}][subject]" class="form-select" required>
            <option value="">Sélectionner un domaine...</option>
            <option value="Développement Web">Développement Web</option>
            <option value="Design Graphique">Design Graphique</option>
            <option value="Marketing Digital">Marketing Digital</option>
            <option value="Autre">Autre</option>
          </select>
        </div>
        <div class="form-group">
          <label class="form-label">Nom de la certification ou accréditation</label>
          <input 
            type="text" 
            name="certifications[${certificationIndex}][name]" 
            class="form-input"
            placeholder="Ex: Certification Google Ads, AWS Solutions Architect, Diplôme en Design UX/UI, Certification Scrum Master..."
            required
          >
        </div>
        <div class="form-group">
          <label class="form-label">Description détaillée</label>
          <textarea 
            name="certifications[${certificationIndex}][description]" 
            class="form-textarea"
            placeholder="Décrivez votre certification : compétences acquises, organisme délivrant, date d'obtention, niveau de maîtrise, projets réalisés..."
            required
          ></textarea>
        </div>
      `;
      
      container.appendChild(newItem);
      
      // Animation d'apparition
      newItem.style.opacity = '0';
      newItem.style.transform = 'translateY(-20px)';
      setTimeout(() => {
        newItem.style.transition = 'all 0.4s ease';
        newItem.style.opacity = '1';
        newItem.style.transform = 'translateY(0)';
      }, 10);
      
      certificationIndex++;
    }

    function removeCertification(button) {
      const item = button.closest('.certification-item');
      if (item) {
        item.remove();
      }
    }

    // Gestion du drag & drop pour les certificats
    const certificateUploadZone = document.getElementById('certificateUploadZone');
    const certificateInput = document.getElementById('certificate-input');
    const certificateFilesPreview = document.getElementById('certificateFilesPreview');

    certificateUploadZone.addEventListener('dragover', (e) => {
      e.preventDefault();
      certificateUploadZone.classList.add('dragover');
    });

    certificateUploadZone.addEventListener('dragleave', () => {
      certificateUploadZone.classList.remove('dragover');
    });

    certificateUploadZone.addEventListener('drop', (e) => {
      e.preventDefault();
      certificateUploadZone.classList.remove('dragover');
      const files = Array.from(e.dataTransfer.files);
      handleCertificateFiles(files);
    });

    certificateInput.addEventListener('change', (e) => {
      const files = Array.from(e.target.files);
      handleCertificateFiles(files);
    });

    function handleCertificateFiles(files) {
      files.forEach(file => {
        if (file.type.match('image.*') && file.size <= 20 * 1024 * 1024) {
          certificateFiles.push(file);
          displayCertificateFile(file);
        } else {
          alert('Veuillez sélectionner une image valide (max 20 Mo).');
        }
      });
      
      // Mettre à jour l'input file
      const dt = new DataTransfer();
      certificateFiles.forEach(file => dt.items.add(file));
      certificateInput.files = dt.files;
    }

    function displayCertificateFile(file) {
      const preview = document.createElement('div');
      preview.className = 'file-preview';
      preview.innerHTML = `
        <div class="file-preview-icon" style="width: 48px; height: 48px; background: linear-gradient(135deg, #f3f4f6 0%, #e5e7eb 100%); border-radius: 10px; display: flex; align-items: center; justify-content: center;">
          <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#7C3AED" stroke-width="2">
            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
            <polyline points="14 2 14 8 20 8"></polyline>
            <line x1="16" y1="13" x2="8" y2="13"></line>
            <line x1="16" y1="17" x2="8" y2="17"></line>
            <polyline points="10 9 9 9 8 9"></polyline>
          </svg>
        </div>
        <div class="file-preview-info" style="flex: 1;">
          <div class="file-preview-name" style="font-weight: 600; color: #1a202c; margin-bottom: 0.25rem;">${file.name}</div>
          <div class="file-preview-size" style="font-size: 0.875rem; color: #6b7280;">${(file.size / 1024 / 1024).toFixed(2)} Mo</div>
        </div>
        <button type="button" onclick="removeCertificateFile(this, '${file.name}')" class="btn-remove-certification" style="width: 36px; height: 36px; border: none; background: #fee2e2; color: #dc2626; border-radius: 8px; cursor: pointer; font-size: 18px; display: flex; align-items: center; justify-content: center; transition: all 0.2s ease; font-weight: 600;">✕</button>
      `;
      certificateFilesPreview.appendChild(preview);
      
      // Animation d'apparition
      preview.style.opacity = '0';
      preview.style.transform = 'translateY(-10px)';
      setTimeout(() => {
        preview.style.transition = 'all 0.3s ease';
        preview.style.opacity = '1';
        preview.style.transform = 'translateY(0)';
      }, 10);
    }

    function removeCertificateFile(button, fileName) {
      certificateFiles = certificateFiles.filter(file => file.name !== fileName);
      const preview = button.closest('.file-preview');
      
      // Animation de suppression
      preview.style.transition = 'all 0.3s ease';
      preview.style.opacity = '0';
      preview.style.transform = 'translateX(-20px)';
      setTimeout(() => {
        preview.remove();
      }, 300);
      
      // Mettre à jour l'input file
      const dt = new DataTransfer();
      certificateFiles.forEach(file => dt.items.add(file));
      certificateInput.files = dt.files;
    }
  </script>
<?php $__env->stopSection(); ?>



<?php echo $__env->make('frontend.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\younes\Downloads\junspro-main (1)\junspro-main3\resources\views\frontend\freelance\onboarding\step3.blade.php ENDPATH**/ ?>