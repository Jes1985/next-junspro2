<?php $__env->startSection('pageHeading'); ?>
  <?php echo e(__('Créer un service')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('style'); ?>
  <link rel="stylesheet" href="<?php echo e(asset('assets/css/summernote-content.css')); ?>">
  <style>
    :root {
      --junspro-purple: #7C3AED;
      --junspro-blue: #1e40af;
      --junspro-gradient: linear-gradient(135deg, #1e40af 0%, #4c1d95 50%, #7c3aed 100%);
    }

    .create-service-page {
      padding: 2rem 1rem;
      min-height: calc(100vh - 200px);
    }

    .create-service-container {
      max-width: 1400px;
      margin: 0 auto;
      background: rgba(255, 255, 255, 0.95);
      backdrop-filter: blur(20px);
      border-radius: 24px;
      box-shadow: 0 8px 32px rgba(0, 0, 0, 0.08);
      padding: 2.5rem;
    }

    .page-header-section {
      margin-bottom: 2rem;
      padding-bottom: 1.5rem;
      border-bottom: 2px solid #e5e7eb;
    }

    .page-header-section h1 {
      font-size: 2rem;
      font-weight: 700;
      color: #1f2937;
      margin-bottom: 0.5rem;
    }

    .page-header-section p {
      color: #6b7280;
      font-size: 1rem;
    }

    .form-section {
      margin-bottom: 2.5rem;
    }

    .form-section-title {
      font-size: 1.25rem;
      font-weight: 600;
      color: #1f2937;
      margin-bottom: 1.5rem;
      padding-bottom: 0.5rem;
      border-bottom: 1px solid #e5e7eb;
    }

    .form-group {
      margin-bottom: 1.5rem;
    }

    .form-group label {
      display: block;
      font-weight: 600;
      color: #374151;
      margin-bottom: 0.5rem;
    }

    .form-group label.required::after {
      content: ' *';
      color: #ef4444;
    }

    .form-control {
      width: 100%;
      padding: 0.75rem;
      border: 1px solid #d1d5db;
      border-radius: 8px;
      font-size: 1rem;
      transition: border-color 0.3s;
    }

    .form-control:focus {
      outline: none;
      border-color: #7c3aed;
      box-shadow: 0 0 0 3px rgba(124, 58, 237, 0.1);
    }

    /* Layout 2 colonnes pour desktop */
    .description-editor-wrapper {
      display: grid;
      grid-template-columns: 1fr 380px;
      gap: 2rem;
      margin-bottom: 1.5rem;
    }

    /* Zone éditeur */
    .editor-container {
      display: flex;
      flex-direction: column;
    }

    .editor-toolbar {
      display: flex;
      flex-wrap: wrap;
      gap: 0.5rem;
      padding: 0.75rem;
      background: #f9fafb;
      border: 1px solid #e5e7eb;
      border-radius: 8px 8px 0 0;
      border-bottom: none;
    }

    .toolbar-group {
      display: flex;
      gap: 0.25rem;
      padding-right: 0.5rem;
      border-right: 1px solid #e5e7eb;
      margin-right: 0.5rem;
    }

    .toolbar-group:last-child {
      border-right: none;
      margin-right: 0;
      padding-right: 0;
    }

    .toolbar-btn {
      padding: 0.5rem 0.75rem;
      background: white;
      border: 1px solid #d1d5db;
      border-radius: 6px;
      cursor: pointer;
      font-size: 0.875rem;
      font-weight: 500;
      color: #374151;
      transition: all 0.2s;
      position: relative;
      min-width: 36px;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .toolbar-btn:hover {
      background: #f3f4f6;
      border-color: #9ca3af;
    }

    .toolbar-btn.active {
      background: var(--junspro-gradient);
      color: white;
      border-color: transparent;
    }

    .toolbar-btn[data-type="color"], .toolbar-btn[data-type="highlight"], .toolbar-btn[data-type="table"], .toolbar-btn[data-type="callout"] {
      padding: 0.5rem;
    }

    .color-picker-wrapper, .highlight-picker-wrapper, .table-menu-wrapper, .callout-menu-wrapper {
      position: relative;
      display: inline-block;
    }

    .color-palette, .highlight-palette, .table-menu, .callout-menu {
      position: absolute;
      top: 100%;
      left: 0;
      margin-top: 0.25rem;
      background: white;
      border: 1px solid #d1d5db;
      border-radius: 8px;
      padding: 0.5rem;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
      z-index: 1000;
      min-width: 200px;
    }

    .color-palette, .highlight-palette {
      display: grid;
      grid-template-columns: repeat(5, 1fr);
      gap: 0.25rem;
    }

    .color-swatch, .highlight-swatch {
      width: 32px;
      height: 32px;
      border-radius: 4px;
      border: 2px solid #e5e7eb;
      cursor: pointer;
      transition: transform 0.2s;
    }

    .color-swatch:hover, .highlight-swatch:hover {
      transform: scale(1.1);
      border-color: #7c3aed;
    }

    .table-menu-item, .callout-menu-item {
      padding: 0.5rem 0.75rem;
      cursor: pointer;
      border-radius: 4px;
      font-size: 0.875rem;
      color: #374151;
      transition: background 0.2s;
    }

    .table-menu-item:hover, .callout-menu-item:hover {
      background: #f3f4f6;
    }

    .table-menu-item.danger {
      color: #dc2626;
    }

    .editor-content {
      min-height: 400px;
      padding: 1rem;
      border: 1px solid #e5e7eb;
      border-radius: 0 0 8px 8px;
      background: white;
      font-size: 1rem;
      line-height: 1.6;
      overflow-y: auto;
    }

    .editor-content:focus {
      outline: none;
      border-color: #7c3aed;
      box-shadow: 0 0 0 3px rgba(124, 58, 237, 0.1);
    }

    .editor-content p {
      margin: 0.75rem 0;
    }

    .editor-content h2 {
      font-size: 1.5rem;
      font-weight: 700;
      margin: 1.5rem 0 1rem;
      color: #1f2937;
    }

    .editor-content h3 {
      font-size: 1.25rem;
      font-weight: 600;
      margin: 1.25rem 0 0.75rem;
      color: #374151;
    }

    .editor-content ul, .editor-content ol {
      margin: 0.75rem 0;
      padding-left: 1.5rem;
    }

    .editor-content li {
      margin: 0.5rem 0;
    }

    .editor-content blockquote {
      border-left: 4px solid #7c3aed;
      padding-left: 1rem;
      margin: 1rem 0;
      color: #6b7280;
      font-style: italic;
    }

    .editor-content hr {
      border: none;
      border-top: 2px solid #e5e7eb;
      margin: 1.5rem 0;
    }

    .editor-content a {
      color: #7c3aed;
      text-decoration: underline;
    }

    /* Styles pour tableaux dans l'éditeur */
    .editor-content table {
      width: 100%;
      border-collapse: collapse;
      margin: 1rem 0;
      background: white;
      border: 1px solid #e5e7eb;
      border-radius: 8px;
      overflow: hidden;
    }

    .editor-content thead {
      background: #f9fafb;
    }

    .editor-content th {
      padding: 0.75rem 1rem;
      text-align: left;
      font-weight: 600;
      color: #374151;
      border-bottom: 2px solid #e5e7eb;
      border-right: 1px solid #e5e7eb;
    }

    .editor-content th:last-child {
      border-right: none;
    }

    .editor-content td {
      padding: 0.75rem 1rem;
      border-bottom: 1px solid #e5e7eb;
      border-right: 1px solid #e5e7eb;
      color: #374151;
    }

    .editor-content td:last-child {
      border-right: none;
    }

    .editor-content tbody tr:last-child td {
      border-bottom: none;
    }

    .editor-content tbody tr:hover {
      background: #f9fafb;
    }

    /* Styles pour callouts dans l'éditeur */
    .editor-content .callout-info,
    .editor-content .callout-conseil,
    .editor-content .callout-attention {
      padding: 1rem 1.25rem;
      border-radius: 8px;
      margin: 1rem 0;
      border-left: 4px solid;
    }

    .editor-content .callout-info {
      background: #eff6ff;
      border-left-color: #3b82f6;
    }

    .editor-content .callout-conseil {
      background: #f0fdf4;
      border-left-color: #22c55e;
    }

    .editor-content .callout-attention {
      background: #fef3c7;
      border-left-color: #f59e0b;
    }

    .editor-content .callout-title {
      font-weight: 600;
      margin-bottom: 0.5rem;
      font-size: 0.9375rem;
    }

    .editor-content .callout-content {
      font-size: 0.875rem;
      line-height: 1.6;
    }

    .editor-helper {
      margin-top: 0.5rem;
      font-size: 0.875rem;
      color: #6b7280;
    }

    .emoji-counter {
      display: inline-flex;
      align-items: center;
      gap: 0.5rem;
      margin-top: 0.5rem;
      padding: 0.5rem 0.75rem;
      background: #f9fafb;
      border-radius: 6px;
      font-size: 0.875rem;
    }

    .emoji-counter.warning {
      background: #fef3c7;
      color: #92400e;
    }

    .emoji-counter.error {
      background: #fee2e2;
      color: #991b1b;
    }

    /* Templates */
    .templates-section {
      margin-top: 1.5rem;
    }

    .templates-grid {
      display: grid;
      grid-template-columns: repeat(2, 1fr);
      gap: 0.75rem;
      margin-top: 1rem;
    }

    .template-btn {
      padding: 0.75rem 1rem;
      background: white;
      border: 2px solid #e5e7eb;
      border-radius: 8px;
      cursor: pointer;
      text-align: left;
      font-size: 0.875rem;
      font-weight: 500;
      color: #374151;
      transition: all 0.2s;
    }

    .template-btn:hover {
      border-color: #7c3aed;
      background: #faf5ff;
      color: #7c3aed;
    }

    /* Sidebar droite - Aperçu + Score */
    .editor-sidebar {
      display: flex;
      flex-direction: column;
      gap: 1.5rem;
      position: relative;
      z-index: 10;
    }

    .preview-card, .score-card {
      background: white;
      border: 1px solid #e5e7eb;
      border-radius: 16px;
      padding: 1.5rem;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.06);
      transition: box-shadow 0.2s;
    }

    .preview-card:hover, .score-card:hover {
      box-shadow: 0 6px 16px rgba(0, 0, 0, 0.08);
    }

    .preview-card h3, .score-card h3 {
      font-size: 1.125rem;
      font-weight: 600;
      color: #1f2937;
      margin-bottom: 1rem;
      padding-bottom: 0.75rem;
      border-bottom: 2px solid #e5e7eb;
      display: flex;
      align-items: center;
      gap: 0.5rem;
    }

    /* Score Clarté badge */
    .clarity-score-badge {
      display: inline-flex;
      align-items: center;
      gap: 0.5rem;
      padding: 0.5rem 1rem;
      background: linear-gradient(135deg, #f3f4f6 0%, #e5e7eb 100%);
      border-radius: 8px;
      font-weight: 600;
      font-size: 0.9375rem;
      margin-bottom: 0.75rem;
    }

    .clarity-score-badge.excellent {
      background: linear-gradient(135deg, #d1fae5 0%, #a7f3d0 100%);
      color: #065f46;
    }

    .clarity-score-badge.correct {
      background: linear-gradient(135deg, #fef3c7 0%, #fde68a 100%);
      color: #92400e;
    }

    .clarity-score-badge.faible {
      background: linear-gradient(135deg, #fee2e2 0%, #fecaca 100%);
      color: #991b1b;
    }

    .clarity-progress-bar {
      height: 10px;
      background: #e5e7eb;
      border-radius: 6px;
      overflow: hidden;
      margin: 0.75rem 0;
      position: relative;
    }

    .clarity-progress-fill {
      height: 100%;
      background: var(--junspro-gradient);
      transition: width 0.4s cubic-bezier(0.4, 0, 0.2, 1);
      border-radius: 6px;
    }

    .clarity-explanation {
      font-size: 0.8125rem;
      color: #6b7280;
      line-height: 1.5;
      margin-top: 0.5rem;
      padding-top: 0.75rem;
      border-top: 1px solid #e5e7eb;
    }

    .preview-content {
      font-size: 0.9375rem;
      line-height: 1.6;
      color: #374151;
      max-height: 400px;
      overflow-y: auto;
      padding: 1rem;
      background: #f9fafb;
      border-radius: 8px;
      border: 1px solid #e5e7eb;
    }

    .preview-content:empty::before {
      content: 'Commencez à écrire pour voir l\'aperçu...';
      color: #9ca3af;
      font-style: italic;
    }

    .preview-content h2 {
      font-size: 1.25rem;
      font-weight: 700;
      margin: 1rem 0 0.75rem;
      color: #1f2937;
    }

    .preview-content h3 {
      font-size: 1.125rem;
      font-weight: 600;
      margin: 0.75rem 0 0.5rem;
      color: #374151;
    }

    .preview-content ul, .preview-content ol {
      margin: 0.75rem 0;
      padding-left: 1.5rem;
    }

    .preview-content li {
      margin: 0.5rem 0;
    }

    .preview-content strong {
      font-weight: 600;
      color: #1f2937;
    }

    .preview-content em {
      font-style: italic;
    }

    /* Styles pour alignement dans preview */
    .preview-content [style*="text-align: left"],
    .preview-content [style*="text-align: center"],
    .preview-content [style*="text-align: right"] {
      display: block;
    }

    /* Styles pour tableaux dans preview */
    .preview-content table {
      width: 100%;
      border-collapse: collapse;
      margin: 1rem 0;
      background: white;
      border-radius: 8px;
      overflow: hidden;
      box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
    }

    .preview-content thead {
      background: #f9fafb;
    }

    .preview-content th {
      padding: 0.75rem 1rem;
      text-align: left;
      font-weight: 600;
      color: #374151;
      border-bottom: 2px solid #e5e7eb;
      font-size: 0.875rem;
    }

    .preview-content td {
      padding: 0.75rem 1rem;
      border-bottom: 1px solid #e5e7eb;
      color: #374151;
      font-size: 0.875rem;
    }

    .preview-content tbody tr:last-child td {
      border-bottom: none;
    }

    .preview-content tbody tr:hover {
      background: #f9fafb;
    }

    /* Wrapper pour scroll horizontal sur mobile */
    .preview-content .table-wrapper {
      overflow-x: auto;
      max-width: 100%;
      margin: 1rem 0;
      -webkit-overflow-scrolling: touch;
    }

    .preview-content .table-wrapper table {
      min-width: 300px;
    }

    /* Styles pour callouts dans preview */
    .preview-content .callout-info,
    .preview-content .callout-conseil,
    .preview-content .callout-attention {
      padding: 1rem 1.25rem;
      border-radius: 8px;
      margin: 1rem 0;
      border-left: 4px solid;
    }

    .preview-content .callout-info {
      background: #eff6ff;
      border-left-color: #3b82f6;
      color: #1e40af;
    }

    .preview-content .callout-conseil {
      background: #f0fdf4;
      border-left-color: #22c55e;
      color: #166534;
    }

    .preview-content .callout-attention {
      background: #fef3c7;
      border-left-color: #f59e0b;
      color: #92400e;
    }

    .preview-content .callout-title {
      font-weight: 600;
      margin-bottom: 0.5rem;
      font-size: 0.9375rem;
    }

    .preview-content .callout-content {
      font-size: 0.875rem;
      line-height: 1.6;
    }

    .preview-content h2 {
      font-size: 1.25rem;
      font-weight: 700;
      margin: 1rem 0 0.75rem;
    }

    .preview-content h3 {
      font-size: 1.125rem;
      font-weight: 600;
      margin: 0.75rem 0 0.5rem;
    }

    .score-value {
      font-size: 2.5rem;
      font-weight: 700;
      text-align: center;
      margin: 1rem 0;
      background: var(--junspro-gradient);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      background-clip: text;
    }

    .score-checklist {
      list-style: none;
      padding: 0;
      margin: 0;
    }

    .score-checklist li {
      display: flex;
      align-items: center;
      gap: 0.75rem;
      padding: 0.5rem 0;
      font-size: 0.875rem;
      color: #6b7280;
    }

    /* Checklist Cercle d'Or premium */
    .golden-circle-item {
      display: flex;
      align-items: center;
      gap: 0.75rem;
      padding: 0.75rem 0;
      font-size: 0.875rem;
      line-height: 1.5;
      min-height: 3rem;
    }

    .golden-circle-icon {
      flex-shrink: 0;
      width: 24px;
      height: 24px;
      display: flex;
      align-items: center;
      justify-content: center;
      border-radius: 6px;
      font-size: 0.875rem;
      font-weight: 600;
    }

    .golden-circle-icon.ok {
      background: #d1fae5;
      color: #059669;
    }

    .golden-circle-icon.incomplete {
      background: #fef3c7;
      color: #d97706;
    }

    .golden-circle-icon.empty {
      background: #f3f4f6;
      color: #6b7280;
    }

    .golden-circle-content {
      flex: 1;
      min-width: 0;
    }

    .golden-circle-label {
      font-weight: 600;
      color: #374151;
      margin-bottom: 0.25rem;
    }

    .golden-circle-label.ok {
      color: #059669;
    }

    .golden-circle-label.incomplete {
      color: #d97706;
    }

    .golden-circle-label.empty {
      color: #6b7280;
    }

    .golden-circle-hint {
      font-size: 0.8125rem;
      color: #d97706;
      margin-top: 0.25rem;
      line-height: 1.4;
    }

    .golden-circle-hint.empty {
      color: #6b7280;
    }

    .ritual-badge {
      display: inline-block;
      padding: 0.25rem 0.75rem;
      background: #faf5ff;
      color: #7c3aed;
      border-radius: 6px;
      font-size: 0.75rem;
      font-weight: 600;
      margin-left: 0.5rem;
    }

    .btn-submit {
      background: var(--junspro-gradient);
      color: white;
      padding: 0.75rem 2rem;
      border: none;
      border-radius: 8px;
      font-size: 1rem;
      font-weight: 600;
      cursor: pointer;
      transition: transform 0.2s, box-shadow 0.2s;
    }

    .btn-submit:hover {
      transform: translateY(-2px);
      box-shadow: 0 4px 12px rgba(124, 58, 237, 0.3);
    }

    .alert {
      padding: 1rem;
      border-radius: 8px;
      margin-bottom: 1.5rem;
    }

    .alert-danger {
      background-color: #fee2e2;
      color: #991b1b;
      border: 1px solid #fecaca;
    }

    .alert-success {
      background-color: #d1fae5;
      color: #065f46;
      border: 1px solid #a7f3d0;
    }

    /* Responsive */
    @media (max-width: 1024px) {
      .description-editor-wrapper {
        grid-template-columns: 1fr;
      }

      .editor-sidebar {
        order: -1;
        position: relative;
      }

      .score-card {
        position: relative !important;
        top: auto !important;
      }
    }

    /* Protection contre le chat flottant */
    .editor-sidebar {
      padding-bottom: 100px;
    }

    @media (max-width: 768px) {
      .editor-sidebar {
        padding-bottom: 80px;
      }
    }

    @media (max-width: 768px) {
      .create-service-container {
        padding: 1.5rem;
      }

      .templates-grid {
        grid-template-columns: 1fr;
      }

      .editor-content {
        min-height: 300px;
      }
    }
  </style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
  <div class="create-service-page">
    <div class="create-service-container">
      <!-- En-tête -->
      <div class="page-header-section">
        <h1><?php echo e(__('Créer un nouveau service')); ?></h1>
        <p><?php echo e(__('Remplissez le formulaire ci-dessous pour créer votre Rituel et commencer à recevoir des demandes.')); ?></p>
        <p class="ritual-badge" style="margin-top: 0.5rem; display: inline-block;">
          💡 1 Rituel = 50 min focus + 10 min rapport auto
        </p>
      </div>

      <!-- Messages d'erreur/succès -->
      <?php if(session('error')): ?>
        <div class="alert alert-danger">
          <?php echo e(session('error')); ?>

        </div>
      <?php endif; ?>

      <?php if(session('success')): ?>
        <div class="alert alert-success">
          <?php echo e(session('success')); ?>

        </div>
      <?php endif; ?>

      <?php if($errors->any()): ?>
        <div class="alert alert-danger">
          <ul class="mb-0">
            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <li><?php echo e($error); ?></li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </ul>
        </div>
      <?php endif; ?>

      <!-- Formulaire -->
      <form id="serviceForm" action="<?php echo e(route('freelance.services.store')); ?>" method="POST" enctype="multipart/form-data">
        <?php echo csrf_field(); ?>

        <!-- Informations de base -->
        <div class="form-section">
          <h2 class="form-section-title"><?php echo e(__('Informations de base')); ?></h2>

          <div class="form-group">
            <label for="title" class="required"><?php echo e(__('Titre du service')); ?></label>
            <input type="text" id="title" name="title" class="form-control <?php $__errorArgs = ['title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                   value="<?php echo e(old('title')); ?>" placeholder="<?php echo e(__('Ex: Développement web personnalisé')); ?>" required>
            <?php $__errorArgs = ['title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
              <div class="text-danger small mt-1"><?php echo e($message); ?></div>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
          </div>

          <!-- Éditeur de description premium -->
          <div class="form-group">
            <label for="description" class="required"><?php echo e(__('Description')); ?></label>
            
            <div class="description-editor-wrapper">
              <!-- Zone éditeur -->
              <div class="editor-container">
                <!-- Toolbar -->
                <div class="editor-toolbar" id="editorToolbar">
                  <!-- Format -->
                  <div class="toolbar-group">
                    <button type="button" class="toolbar-btn" data-command="formatBlock" data-value="p" title="Paragraphe normal">P</button>
                    <button type="button" class="toolbar-btn" data-command="heading" data-level="2" title="Titre H2">H2</button>
                    <button type="button" class="toolbar-btn" data-command="heading" data-level="3" title="Titre H3">H3</button>
                  </div>
                  
                  <!-- Style texte -->
                  <div class="toolbar-group">
                    <button type="button" class="toolbar-btn" data-command="bold" title="Gras">B</button>
                    <button type="button" class="toolbar-btn" data-command="italic" title="Italique">I</button>
                    <button type="button" class="toolbar-btn" data-command="underline" title="Souligné">U</button>
                  </div>
                  
                  <!-- Undo/Redo -->
                  <div class="toolbar-group">
                    <button type="button" class="toolbar-btn" data-command="undo" title="Annuler (Ctrl+Z)" style="font-size: 1rem;">↶</button>
                    <button type="button" class="toolbar-btn" data-command="redo" title="Refaire (Ctrl+Y)" style="font-size: 1rem;">↷</button>
                  </div>
                  
                  <!-- Alignement -->
                  <div class="toolbar-group">
                    <button type="button" class="toolbar-btn" data-command="justifyLeft" title="Aligner à gauche" style="font-size: 1rem;">◄</button>
                    <button type="button" class="toolbar-btn" data-command="justifyCenter" title="Centrer" style="font-size: 1rem;">●</button>
                    <button type="button" class="toolbar-btn" data-command="justifyRight" title="Aligner à droite" style="font-size: 1rem;">►</button>
                  </div>
                  
                  <!-- Couleur & Highlight -->
                  <div class="toolbar-group">
                    <div class="color-picker-wrapper">
                      <button type="button" class="toolbar-btn" data-type="color" title="Couleur du texte" id="colorBtn">A</button>
                      <div class="color-palette" id="colorPalette" style="display: none;">
                        <div class="color-swatch" data-color="#1f2937" style="background: #1f2937;" title="Noir"></div>
                        <div class="color-swatch" data-color="#6b7280" style="background: #6b7280;" title="Gris"></div>
                        <div class="color-swatch" data-color="#1e40af" style="background: #1e40af;" title="Bleu Junspro"></div>
                        <div class="color-swatch" data-color="#7c3aed" style="background: #7c3aed;" title="Violet Junspro"></div>
                        <div class="color-swatch" data-color="#059669" style="background: #059669;" title="Vert"></div>
                        <div class="color-swatch" data-color="#dc2626" style="background: #dc2626;" title="Rouge"></div>
                        <div class="color-swatch" data-color="#d97706" style="background: #d97706;" title="Orange"></div>
                        <div class="color-swatch" data-color="#7c2d12" style="background: #7c2d12;" title="Marron"></div>
                        <div class="color-swatch" data-color="#000000" style="background: #000000;" title="Reset"></div>
                        <div class="color-swatch" data-color="inherit" style="background: linear-gradient(45deg, #ccc 25%, transparent 25%), linear-gradient(-45deg, #ccc 25%, transparent 25%), linear-gradient(45deg, transparent 75%, #ccc 75%), linear-gradient(-45deg, transparent 75%, #ccc 75%); background-size: 8px 8px; background-position: 0 0, 0 4px, 4px -4px, -4px 0px;" title="Par défaut"></div>
                      </div>
                    </div>
                    <div class="highlight-picker-wrapper">
                      <button type="button" class="toolbar-btn" data-type="highlight" title="Surlignage" id="highlightBtn">▦</button>
                      <div class="highlight-palette" id="highlightPalette" style="display: none;">
                        <div class="highlight-swatch" data-color="#fef3c7" style="background: #fef3c7;" title="Jaune"></div>
                        <div class="highlight-swatch" data-color="#dbeafe" style="background: #dbeafe;" title="Bleu clair"></div>
                        <div class="highlight-swatch" data-color="#f3e8ff" style="background: #f3e8ff;" title="Violet clair"></div>
                        <div class="highlight-swatch" data-color="#d1fae5" style="background: #d1fae5;" title="Vert clair"></div>
                        <div class="highlight-swatch" data-color="#fee2e2" style="background: #fee2e2;" title="Rouge clair"></div>
                        <div class="highlight-swatch" data-color="transparent" style="background: transparent; border: 2px dashed #d1d5db;" title="Retirer"></div>
                      </div>
                    </div>
                  </div>
                  
                  <!-- Listes -->
                  <div class="toolbar-group">
                    <button type="button" class="toolbar-btn" data-command="bulletList" title="Liste à puces">•</button>
                    <button type="button" class="toolbar-btn" data-command="orderedList" title="Liste numérotée">1.</button>
                    <button type="button" class="toolbar-btn" data-command="taskList" title="Checklist">☑</button>
                  </div>
                  
                  <!-- Tableaux -->
                  <div class="toolbar-group">
                    <div class="table-menu-wrapper">
                      <button type="button" class="toolbar-btn" data-type="table" title="Tableau" id="tableBtn">⊞</button>
                      <div class="table-menu" id="tableMenu" style="display: none;">
                        <div class="table-menu-item" data-action="insert-table">Insérer tableau 2x2</div>
                        <div class="table-menu-item" data-action="add-row">Ajouter ligne</div>
                        <div class="table-menu-item" data-action="add-col">Ajouter colonne</div>
                        <div class="table-menu-item" data-action="delete-row">Supprimer ligne</div>
                        <div class="table-menu-item" data-action="delete-col">Supprimer colonne</div>
                        <div class="table-menu-item danger" data-action="delete-table">Supprimer tableau</div>
                      </div>
                    </div>
                  </div>
                  
                  <!-- Callouts -->
                  <div class="toolbar-group">
                    <div class="callout-menu-wrapper">
                      <button type="button" class="toolbar-btn" data-type="callout" title="Insérer bloc" id="calloutBtn">💬</button>
                      <div class="callout-menu" id="calloutMenu" style="display: none;">
                        <div class="callout-menu-item" data-callout="info">📘 Encadré Info</div>
                        <div class="callout-menu-item" data-callout="conseil">💡 Encadré Conseil</div>
                        <div class="callout-menu-item" data-callout="attention">⚠️ Encadré Attention</div>
                      </div>
                    </div>
                  </div>
                  
                  <!-- Autres -->
                  <div class="toolbar-group">
                    <button type="button" class="toolbar-btn" data-command="blockquote" title="Citation">"</button>
                    <button type="button" class="toolbar-btn" data-command="link" title="Lien">🔗</button>
                    <button type="button" class="toolbar-btn" data-command="horizontalRule" title="Séparateur">─</button>
                  </div>
                </div>

                <!-- Zone d'édition -->
                <div class="editor-content" id="editorContent" contenteditable="true" 
                     placeholder="<?php echo e(__('Décrivez votre Rituel en détail (minimum 30 caractères)...')); ?>"></div>
                
                <!-- Champ caché pour la soumission -->
                <textarea id="description" name="description" style="display: none;" required><?php echo e(old('description')); ?></textarea>
                
                <?php $__errorArgs = ['description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                  <div class="text-danger small mt-1"><?php echo e($message); ?></div>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

                <!-- Microcopy premium -->
                <div class="editor-helper">
                  <strong>Conseil Junspro :</strong> WHY (transformation) → HOW (méthode + Rituels) → WHAT (livrables). Trois sections courtes inspirent plus confiance qu'un long paragraphe.
                </div>

                <!-- Compteur emojis -->
                <div class="emoji-counter" id="emojiCounter">
                  <span><strong>Emojis :</strong> <span id="emojiCount">0</span>/6</span>
                  <span id="emojiWarning" style="display: none; margin-left: 0.5rem; color: #991b1b; font-weight: 600;">Trop d'emojis : gardez un style sobre.</span>
                </div>

                <!-- Templates -->
                <div class="templates-section">
                  <strong style="display: block; margin-bottom: 0.5rem; color: #374151;">Templates rapides :</strong>
                  <div class="templates-grid">
                    <button type="button" class="template-btn" data-template="cercle-dor" title="WHY → HOW → WHAT : une description claire, rassurante et orientée résultat.">✨ Structure Cercle d'Or</button>
                    <button type="button" class="template-btn" data-template="resultat">📊 Résultat obtenu</button>
                    <button type="button" class="template-btn" data-template="pour-qui">👥 Pour qui c'est</button>
                    <button type="button" class="template-btn" data-template="rituels">⚡ Déroulé en Rituels</button>
                    <button type="button" class="template-btn" data-template="livrables">📦 Livrables inclus</button>
                    <button type="button" class="template-btn" data-template="packs">💎 Options & Packs</button>
                    <button type="button" class="template-btn" data-template="prerequis">⚠️ Pré-requis & limites</button>
                  </div>
                </div>
              </div>

              <!-- Sidebar droite - Aperçu + Qualité -->
              <div class="editor-sidebar">
                <!-- Aperçu client -->
                <div class="preview-card">
                  <h3>
                    <span aria-label="Vue client">👁️</span>
                    Vue client
                  </h3>
                  <div class="preview-content" id="previewContent" role="region" aria-label="Aperçu de la description">
                    <em style="color: #9ca3af;">Commencez à écrire pour voir l'aperçu...</em>
                  </div>
                </div>

                <!-- Qualité de la description -->
                <div class="score-card" style="position: sticky; top: 20px;">
                  <h3>Qualité de la description</h3>
                  <p style="font-size: 0.875rem; color: #6b7280; margin-bottom: 1.5rem; padding-bottom: 1rem; border-bottom: 1px solid #e5e7eb;">
                    Visez une fiche claire et structurée : le client doit comprendre en 10 secondes.
                  </p>

                  <!-- Score Clarté visible -->
                  <div style="margin-bottom: 1.5rem;">
                    <div class="clarity-score-badge" id="clarityBadge">
                      <span>Score Clarté:</span>
                      <span id="clarityScoreValue" style="font-size: 1.125rem;">0</span>
                      <span>/100</span>
                    </div>
                    <div style="display: flex; align-items: center; gap: 0.5rem; margin-bottom: 0.5rem;">
                      <span id="clarityLabel" style="font-size: 0.875rem; font-weight: 600; color: #6b7280;">Faible</span>
                    </div>
                    <div class="clarity-progress-bar">
                      <div class="clarity-progress-fill" id="clarityBar" style="width: 0%;"></div>
                    </div>
                    <div class="clarity-explanation" id="clarityExplanation" role="tooltip" aria-label="Explication du score">
                      Pourquoi ce score ? Structurez votre description en WHY (transformation), HOW (méthode + Rituels), WHAT (livrables).
                    </div>
                  </div>

                  <!-- Checklist Cercle d'Or -->
                  <div style="margin-bottom: 1.5rem;">
                    <h4 style="font-size: 0.9375rem; font-weight: 600; color: #374151; margin-bottom: 0.75rem;">Structure Cercle d'Or</h4>
                    <ul style="list-style: none; padding: 0; margin: 0;" id="goldenCircleChecklist" role="list">
                      <li class="golden-circle-item" role="listitem">
                        <span class="golden-circle-icon empty" id="why-icon" aria-label="Statut WHY">○</span>
                        <div class="golden-circle-content">
                          <div class="golden-circle-label empty" id="why-label">WHY — Transformation</div>
                          <div class="golden-circle-hint empty" id="why-hint">Ajoutez le résultat que le client va obtenir.</div>
                        </div>
                      </li>
                      <li class="golden-circle-item" role="listitem">
                        <span class="golden-circle-icon empty" id="how-icon" aria-label="Statut HOW">○</span>
                        <div class="golden-circle-content">
                          <div class="golden-circle-label empty" id="how-label">HOW — Méthode (Rituels)</div>
                          <div class="golden-circle-hint empty" id="how-hint">Expliquez votre méthode en Rituels (50 + 10).</div>
                        </div>
                      </li>
                      <li class="golden-circle-item" role="listitem">
                        <span class="golden-circle-icon empty" id="what-icon" aria-label="Statut WHAT">○</span>
                        <div class="golden-circle-content">
                          <div class="golden-circle-label empty" id="what-label">WHAT — Livrables</div>
                          <div class="golden-circle-hint empty" id="what-hint">Listez des livrables concrets et vérifiables.</div>
                        </div>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="category" class="required"><?php echo e(__('Catégorie')); ?></label>
                <select id="category" name="category_id" class="form-control <?php $__errorArgs = ['category_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" required>
                  <option value=""><?php echo e(__('Sélectionner une catégorie')); ?></option>
                  <?php if(isset($languages) && $languages->isNotEmpty()): ?>
                    <?php
                      $defaultLanguage = $languages->where('is_default', 1)->first() ?? $languages->first();
                      $categories = $defaultLanguage->categories ?? collect();
                    ?>
                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <option value="<?php echo e($category->id); ?>" <?php echo e(old('category_id') == $category->id ? 'selected' : ''); ?>>
                        <?php echo e($category->name); ?>

                      </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  <?php endif; ?>
                </select>
                <?php $__errorArgs = ['category_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                  <div class="text-danger small mt-1"><?php echo e($message); ?></div>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-group">
                <label for="price" class="required"><?php echo e(__('Prix (€)')); ?></label>
                <input type="number" id="price" name="price" class="form-control <?php $__errorArgs = ['price'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                       step="0.01" min="0" value="<?php echo e(old('price')); ?>" placeholder="0.00" required>
                <?php $__errorArgs = ['price'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                  <div class="text-danger small mt-1"><?php echo e($message); ?></div>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
              </div>
            </div>
          </div>
        </div>

        <!-- Images -->
        <div class="form-section">
          <h2 class="form-section-title"><?php echo e(__('Images')); ?></h2>

          <div class="form-group">
            <label for="thumbnail_image" class="required"><?php echo e(__('Image miniature')); ?></label>
            <input type="file" id="thumbnail_image" name="thumbnail_image" 
                   class="form-control <?php $__errorArgs = ['thumbnail_image'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" accept="image/*" required>
            <small class="text-muted"><?php echo e(__('Taille recommandée : 330 x 255 px. Taille max : 2 Mo')); ?></small>
            <?php $__errorArgs = ['thumbnail_image'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
              <div class="text-danger small mt-1"><?php echo e($message); ?></div>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
          </div>
        </div>

        <!-- Bouton de soumission -->
        <div class="text-center mt-4">
          <button type="submit" class="btn-submit">
            <?php echo e(__('Créer le service')); ?>

          </button>
          <a href="<?php echo e(route('freelance.dashboard', ['tab' => 'services'])); ?>" class="btn btn-secondary ml-3" style="padding: 0.75rem 2rem; border-radius: 8px; text-decoration: none; display: inline-block; background: #f3f4f6; color: #374151;">
            <?php echo e(__('Annuler')); ?>

          </a>
        </div>
      </form>
    </div>
  </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
  <script>
    (function() {
      'use strict';

      // Éditeur simple avec contenteditable (sans dépendance externe)
      const editorContent = document.getElementById('editorContent');
      const descriptionInput = document.getElementById('description');
      const previewContent = document.getElementById('previewContent');
      const emojiCounter = document.getElementById('emojiCounter');

      // Templates
      const templates = {
        'cercle-dor': '<h2>WHY — Pourquoi (transformation)</h2><ul><li>Le problème que vous aidez à résoudre :</li><li>Le résultat attendu pour le client :</li><li>Pour qui c\'est idéal :</li></ul><h2>HOW — Comment (méthode)</h2><ul><li>Déroulé en Rituels (1 Rituel = 50 min focus + 10 min rapport) :</li><li>Votre approche / outils :</li><li>Cadre & limites (scope) :</li></ul><h2>WHAT — Quoi (livrables)</h2><ul><li>Livrables inclus :</li><li>Délais :</li><li>Options / packs :</li></ul>',
        resultat: '<h2>📊 Résultat obtenu</h2><p>À la fin de ce service, vous obtiendrez :</p><ul><li>Résultat 1</li><li>Résultat 2</li><li>Résultat 3</li></ul>',
        'pour-qui': '<h2>👥 Pour qui c\'est</h2><p>Ce Rituel est idéal pour :</p><ul><li>Profil 1</li><li>Profil 2</li></ul>',
        rituels: '<h2>⚡ Déroulé en Rituels</h2><p>Ce Rituel comprend <strong>X Rituels</strong> :</p><ul><li><strong>Rituel 1</strong> (50 min focus + 10 min rapport) : Description</li><li><strong>Rituel 2</strong> (50 min focus + 10 min rapport) : Description</li></ul><p class="ritual-badge">💡 1 Rituel = 50 min focus + 10 min rapport auto</p>',
        livrables: '<h2>📦 Livrables inclus</h2><ul><li>Livrable 1</li><li>Livrable 2</li><li>Livrable 3</li></ul>',
        packs: '<h2>💎 Options & Packs</h2><ul><li><strong>Essentiel</strong> (X Rituels) : Description</li><li><strong>Standard</strong> (X Rituels) : Description</li><li><strong>Premium</strong> (X Rituels) : Description</li></ul>',
        prerequis: '<h2>⚠️ Pré-requis & limites</h2><p><strong>Pré-requis :</strong></p><ul><li>Pré-requis 1</li><li>Pré-requis 2</li></ul><p><strong>Limites du scope :</strong></p><ul><li>Limite 1</li><li>Limite 2</li></ul>'
      };

      // Fonctions utilitaires
      function countEmojis(text) {
        const emojiRegex = /[\u{1F300}-\u{1F9FF}]|[\u{2600}-\u{26FF}]|[\u{2700}-\u{27BF}]/gu;
        return (text.match(emojiRegex) || []).length;
      }

      // Palette de couleurs autorisées
      const allowedColors = {
        text: ['#1f2937', '#6b7280', '#1e40af', '#7c3aed', '#059669', '#dc2626', '#d97706', '#7c2d12', '#000000', 'inherit'],
        highlight: ['#fef3c7', '#dbeafe', '#f3e8ff', '#d1fae5', '#fee2e2', 'transparent']
      };

      function sanitizeHTML(html) {
        const div = document.createElement('div');
        div.innerHTML = html;
        
        // Whitelist stricte : tags safe + tableaux + callouts
        const allowedTags = ['p', 'h2', 'h3', 'ul', 'ol', 'li', 'strong', 'em', 'u', 'br', 'table', 'thead', 'tbody', 'tr', 'th', 'td', 'div', 'span'];
        const allowedAttributes = {
          'p': ['style'],
          'h2': ['style'],
          'h3': ['style'],
          'div': ['class', 'style'],
          'span': ['style'],
          'table': ['style'],
          'td': ['style', 'colspan', 'rowspan'],
          'th': ['style', 'colspan', 'rowspan']
        };
        
        // Styles autorisés
        const allowedStyles = {
          'text-align': ['left', 'center', 'right'],
          'color': allowedColors.text,
          'background-color': allowedColors.highlight
        };

        function isStyleAllowed(styleName, styleValue) {
          if (!allowedStyles[styleName]) return false;
          if (styleName === 'color' || styleName === 'background-color') {
            // Normaliser la couleur (hex, rgb, nom)
            const normalized = styleValue.toLowerCase().trim();
            return allowedStyles[styleName].some(color => {
              if (color === 'inherit' || color === 'transparent') return normalized === color;
              return normalized.includes(color.replace('#', ''));
            });
          }
          return allowedStyles[styleName].includes(styleValue);
        }

        function cleanNode(node) {
          if (node.nodeType === Node.TEXT_NODE) {
            return node.cloneNode(true);
          }
          
          if (node.nodeType === Node.ELEMENT_NODE) {
            const tagName = node.tagName.toLowerCase();
            
            // Vérifier les callouts (div avec class callout-*)
            if (tagName === 'div' && node.className) {
              const classes = node.className.split(' ').filter(c => c.trim());
              const isCallout = classes.some(c => c.startsWith('callout-'));
              if (isCallout) {
                const cleanNode = document.createElement('div');
                // Garder uniquement les classes callout autorisées
                const allowedCalloutClasses = classes.filter(c => 
                  c === 'callout-info' || c === 'callout-conseil' || c === 'callout-attention' ||
                  c === 'callout-title' || c === 'callout-content' || c === 'callout'
                );
                if (allowedCalloutClasses.length > 0) {
                  cleanNode.className = allowedCalloutClasses.join(' ');
                }
                Array.from(node.childNodes).forEach(child => {
                  const cleaned = cleanNode(child);
                  if (cleaned) cleanNode.appendChild(cleaned);
                });
                return cleanNode;
              }
            }
            
            if (!allowedTags.includes(tagName)) {
              return document.createTextNode(node.textContent);
            }

            const cleanNode = document.createElement(tagName);
            const allowedAttrs = allowedAttributes[tagName] || [];
            
            // Copier les attributs autorisés
            allowedAttrs.forEach(attr => {
              if (node.hasAttribute(attr)) {
                if (attr === 'style') {
                  // Nettoyer le style
                  const style = node.getAttribute('style');
                  const cleanStyles = [];
                  style.split(';').forEach(rule => {
                    const [prop, value] = rule.split(':').map(s => s.trim());
                    if (prop && value && isStyleAllowed(prop, value)) {
                      cleanStyles.push(`${prop}: ${value}`);
                    }
                  });
                  if (cleanStyles.length > 0) {
                    cleanNode.setAttribute('style', cleanStyles.join('; '));
                  }
                } else {
                  cleanNode.setAttribute(attr, node.getAttribute(attr));
                }
              }
            });
            
            Array.from(node.childNodes).forEach(child => {
              const cleaned = cleanNode(child);
              if (cleaned) cleanNode.appendChild(cleaned);
            });

            return cleanNode;
          }
          
          return null;
        }

        const cleaned = document.createDocumentFragment();
        Array.from(div.childNodes).forEach(child => {
          const cleanedChild = cleanNode(child);
          if (cleanedChild) cleaned.appendChild(cleanedChild);
        });

        const tempDiv = document.createElement('div');
        tempDiv.appendChild(cleaned);
        return tempDiv.innerHTML;
      }

      function updatePreview() {
        const content = editorContent.innerHTML;
        if (!content || content.trim() === '') {
          previewContent.innerHTML = '<em style="color: #9ca3af;">Commencez à écrire pour voir l\'aperçu...</em>';
          return;
        }
        let sanitized = sanitizeHTML(content);
        
        // Wrapper les tableaux pour le scroll horizontal sur mobile
        const tempDiv = document.createElement('div');
        tempDiv.innerHTML = sanitized;
        const tables = tempDiv.querySelectorAll('table');
        tables.forEach(table => {
          const wrapper = document.createElement('div');
          wrapper.className = 'table-wrapper';
          table.parentNode.insertBefore(wrapper, table);
          wrapper.appendChild(table);
        });
        
        sanitized = tempDiv.innerHTML;
        previewContent.innerHTML = sanitized || '<em style="color: #9ca3af;">Commencez à écrire pour voir l\'aperçu...</em>';
      }

      function updateQualityScore() {
        // Cette fonction n'est plus utilisée mais conservée pour compatibilité
        // Le score de qualité est maintenant géré par updateClarityScore()
        return;
      }

      function updateEmojiCounter() {
        const content = editorContent.textContent || editorContent.innerText;
        const count = countEmojis(content);
        const countSpan = document.getElementById('emojiCount');
        const warningSpan = document.getElementById('emojiWarning');
        
        if (countSpan) countSpan.textContent = count;
        
        if (warningSpan) {
          if (count > 6) {
            warningSpan.style.display = 'inline';
          } else {
            warningSpan.style.display = 'none';
          }
        }
        
        emojiCounter.className = 'emoji-counter';
        if (count > 6) {
          emojiCounter.classList.add('error');
        } else if (count > 4) {
          emojiCounter.classList.add('warning');
        }
      }

      function updateGoldenCircleChecklist() {
        const html = editorContent.innerHTML.toLowerCase();
        const text = (editorContent.textContent || editorContent.innerText).toLowerCase();
        const textLength = text.trim().length;
        
        // Détecter WHY (transformation) - plus précis
        const whyKeywords = ['pourquoi', 'transformation', 'résultat', 'problème', 'idéal', 'why', 'obtenir', 'bénéfice'];
        const hasWhySection = html.includes('<h2>why') || html.includes('why —') || html.includes('pourquoi');
        const hasWhyKeywords = whyKeywords.some(kw => text.includes(kw));
        const hasWhy = hasWhySection || (hasWhyKeywords && textLength > 20);
        
        // Détecter HOW (méthode + rituels) - plus précis
        const howKeywords = ['comment', 'méthode', 'rituel', 'rituels', 'déroulé', 'approche', 'how', '50 min', '10 min', 'processus', 'étapes'];
        const hasHowSection = html.includes('<h2>how') || html.includes('how —') || html.includes('comment');
        const hasHowKeywords = howKeywords.some(kw => text.includes(kw));
        const hasHow = hasHowSection || (hasHowKeywords && textLength > 20);
        
        // Détecter WHAT (livrables) - plus précis
        const whatKeywords = ['quoi', 'livrable', 'livrables', 'délai', 'délais', 'pack', 'packs', 'what', 'inclus', 'fourni'];
        const hasWhatSection = html.includes('<h2>what') || html.includes('what —') || html.includes('quoi');
        const hasWhatKeywords = whatKeywords.some(kw => text.includes(kw));
        const hasWhat = hasWhatSection || (hasWhatKeywords && textLength > 20);
        
        // Mettre à jour WHY
        const whyIcon = document.getElementById('why-icon');
        const whyLabel = document.getElementById('why-label');
        const whyHint = document.getElementById('why-hint');
        if (whyIcon && whyLabel && whyHint) {
          if (hasWhy && textLength > 50) {
            whyIcon.className = 'golden-circle-icon ok';
            whyIcon.textContent = '✓';
            whyIcon.setAttribute('aria-label', 'WHY présent');
            whyLabel.className = 'golden-circle-label ok';
            whyHint.style.display = 'none';
          } else if (hasWhy || textLength > 10) {
            whyIcon.className = 'golden-circle-icon incomplete';
            whyIcon.textContent = '⚠';
            whyIcon.setAttribute('aria-label', 'WHY incomplet');
            whyLabel.className = 'golden-circle-label incomplete';
            whyHint.className = 'golden-circle-hint incomplete';
            whyHint.textContent = 'Développez davantage le résultat attendu.';
            whyHint.style.display = 'block';
          } else {
            whyIcon.className = 'golden-circle-icon empty';
            whyIcon.textContent = '○';
            whyIcon.setAttribute('aria-label', 'WHY manquant');
            whyLabel.className = 'golden-circle-label empty';
            whyHint.className = 'golden-circle-hint empty';
            whyHint.textContent = 'Ajoutez le résultat que le client va obtenir.';
            whyHint.style.display = 'block';
          }
        }
        
        // Mettre à jour HOW
        const howIcon = document.getElementById('how-icon');
        const howLabel = document.getElementById('how-label');
        const howHint = document.getElementById('how-hint');
        if (howIcon && howLabel && howHint) {
          if (hasHow && (text.includes('rituel') || text.includes('50 min'))) {
            howIcon.className = 'golden-circle-icon ok';
            howIcon.textContent = '✓';
            howIcon.setAttribute('aria-label', 'HOW présent');
            howLabel.className = 'golden-circle-label ok';
            howHint.style.display = 'none';
          } else if (hasHow || textLength > 10) {
            howIcon.className = 'golden-circle-icon incomplete';
            howIcon.textContent = '⚠';
            howIcon.setAttribute('aria-label', 'HOW incomplet');
            howLabel.className = 'golden-circle-label incomplete';
            howHint.className = 'golden-circle-hint incomplete';
            howHint.textContent = 'Mentionnez les Rituels (50 + 10 min).';
            howHint.style.display = 'block';
          } else {
            howIcon.className = 'golden-circle-icon empty';
            howIcon.textContent = '○';
            howIcon.setAttribute('aria-label', 'HOW manquant');
            howLabel.className = 'golden-circle-label empty';
            howHint.className = 'golden-circle-hint empty';
            howHint.textContent = 'Expliquez votre méthode en Rituels (50 + 10).';
            howHint.style.display = 'block';
          }
        }
        
        // Mettre à jour WHAT
        const whatIcon = document.getElementById('what-icon');
        const whatLabel = document.getElementById('what-label');
        const whatHint = document.getElementById('what-hint');
        if (whatIcon && whatLabel && whatHint) {
          if (hasWhat && (html.includes('<ul') || html.includes('<ol') || text.includes('livrable'))) {
            whatIcon.className = 'golden-circle-icon ok';
            whatIcon.textContent = '✓';
            whatIcon.setAttribute('aria-label', 'WHAT présent');
            whatLabel.className = 'golden-circle-label ok';
            whatHint.style.display = 'none';
          } else if (hasWhat || textLength > 10) {
            whatIcon.className = 'golden-circle-icon incomplete';
            whatIcon.textContent = '⚠';
            whatIcon.setAttribute('aria-label', 'WHAT incomplet');
            whatLabel.className = 'golden-circle-label incomplete';
            whatHint.className = 'golden-circle-hint incomplete';
            whatHint.textContent = 'Listez les livrables sous forme de liste.';
            whatHint.style.display = 'block';
          } else {
            whatIcon.className = 'golden-circle-icon empty';
            whatIcon.textContent = '○';
            whatIcon.setAttribute('aria-label', 'WHAT manquant');
            whatLabel.className = 'golden-circle-label empty';
            whatHint.className = 'golden-circle-hint empty';
            whatHint.textContent = 'Listez des livrables concrets et vérifiables.';
            whatHint.style.display = 'block';
          }
        }
      }

      function updateClarityScore() {
        const html = editorContent.innerHTML;
        const text = editorContent.textContent || editorContent.innerText;
        const textLength = text.trim().length;
        const wordCount = text.split(/\s+/).filter(w => w.length > 0).length;
        let score = 0;
        
        // WHY (présent + clair) : +30
        const hasWhySection = /<h2[^>]*>.*why|pourquoi/i.test(html) || /why\s*—|pourquoi\s*\(/i.test(text);
        const hasWhyKeywords = /transformation|résultat|problème|bénéfice|obtenir/i.test(text);
        if (hasWhySection && hasWhyKeywords && textLength > 50) {
          score += 30;
        } else if (hasWhySection || hasWhyKeywords) {
          score += 15; // Partiel
        }
        
        // HOW (méthode/rituels mentionnés + structure) : +30
        const hasHowSection = /<h2[^>]*>.*how|comment/i.test(html) || /how\s*—|comment\s*\(/i.test(text);
        const hasRituels = /rituel|50\s*min|10\s*min|rapport/i.test(text);
        const hasMethod = /méthode|approche|processus|étapes/i.test(text);
        if (hasHowSection && (hasRituels || hasMethod) && textLength > 50) {
          score += 30;
        } else if (hasHowSection || hasRituels || hasMethod) {
          score += 15; // Partiel
        }
        
        // WHAT (livrables listés et vérifiables) : +30
        const hasWhatSection = /<h2[^>]*>.*what|quoi/i.test(html) || /what\s*—|quoi\s*\(/i.test(text);
        const hasLivrables = /livrable|délai|pack|inclus|fourni/i.test(text);
        const hasLists = /<ul|<ol/.test(html);
        if (hasWhatSection && hasLivrables && hasLists) {
          score += 30;
        } else if (hasWhatSection || hasLivrables) {
          score += 15; // Partiel
        }
        
        // Bonus structure : +10 si présence de listes OU titres OU paragraphes courts
        const hasTitles = /<h2|<h3/.test(html);
        const paragraphs = html.match(/<p[^>]*>.*?<\/p>/g) || [];
        const shortParagraphs = paragraphs.filter(p => {
          const pText = p.replace(/<[^>]+>/g, '');
          const lines = pText.split(/\n/).filter(l => l.trim().length > 0);
          return lines.length <= 3;
        });
        if (hasLists || hasTitles || (paragraphs.length > 0 && shortParagraphs.length / paragraphs.length >= 0.7)) {
          score += 10;
        }
        
        // Malus : -10 si description trop courte (< 80 mots)
        if (wordCount < 80) {
          score -= 10;
        }
        
        // Malus : -10 si énorme pavé (> 350 mots) sans titres/listes
        if (wordCount > 350 && !hasTitles && !hasLists) {
          score -= 10;
        }
        
        // Clamp 0..100
        score = Math.max(0, Math.min(100, score));
        
        // Mettre à jour l'affichage
        const clarityScoreValue = document.getElementById('clarityScoreValue');
        const clarityBadge = document.getElementById('clarityBadge');
        const clarityLabel = document.getElementById('clarityLabel');
        const clarityBar = document.getElementById('clarityBar');
        const clarityExplanation = document.getElementById('clarityExplanation');
        
        if (clarityScoreValue) clarityScoreValue.textContent = score;
        if (clarityBar) clarityBar.style.width = score + '%';
        
        // Badge et label selon le score
        if (clarityBadge && clarityLabel) {
          clarityBadge.className = 'clarity-score-badge';
          if (score >= 80) {
            clarityBadge.classList.add('excellent');
            clarityLabel.textContent = 'Excellent';
            clarityLabel.style.color = '#059669';
            if (clarityExplanation) {
              clarityExplanation.textContent = 'Pourquoi ce score ? Votre description est claire, structurée en WHY/HOW/WHAT avec des livrables vérifiables.';
            }
          } else if (score >= 50) {
            clarityBadge.classList.add('correct');
            clarityLabel.textContent = 'Correct';
            clarityLabel.style.color = '#d97706';
            if (clarityExplanation) {
              clarityExplanation.textContent = 'Pourquoi ce score ? Structurez davantage en WHY (transformation), HOW (Rituels), WHAT (livrables).';
            }
          } else {
            clarityBadge.classList.add('faible');
            clarityLabel.textContent = 'Faible';
            clarityLabel.style.color = '#dc2626';
            if (clarityExplanation) {
              clarityExplanation.textContent = 'Pourquoi ce score ? Structurez votre description en WHY (transformation), HOW (méthode + Rituels), WHAT (livrables).';
            }
          }
        }
      }

      // Fermer les menus au clic extérieur
      document.addEventListener('click', function(e) {
        if (!e.target.closest('.color-picker-wrapper')) {
          const palette = document.getElementById('colorPalette');
          if (palette) palette.style.display = 'none';
        }
        if (!e.target.closest('.highlight-picker-wrapper')) {
          const palette = document.getElementById('highlightPalette');
          if (palette) palette.style.display = 'none';
        }
        if (!e.target.closest('.table-menu-wrapper')) {
          const menu = document.getElementById('tableMenu');
          if (menu) menu.style.display = 'none';
        }
        if (!e.target.closest('.callout-menu-wrapper')) {
          const menu = document.getElementById('calloutMenu');
          if (menu) menu.style.display = 'none';
        }
      });

      // Toolbar commands de base (format, style)
      document.querySelectorAll('.toolbar-btn[data-command]').forEach(btn => {
        btn.addEventListener('click', function(e) {
          e.preventDefault();
          e.stopPropagation();
          const command = this.dataset.command;
          const level = this.dataset.level;
          const value = this.dataset.value;

          // S'assurer que l'éditeur a le focus
          editorContent.focus();
          
          try {
            // Gestion Undo/Redo
            if (command === 'undo') {
              document.execCommand('undo', false, null);
              debouncedUpdate();
              return;
            } else if (command === 'redo') {
              document.execCommand('redo', false, null);
              debouncedUpdate();
              return;
            }
            // Gestion des titres et paragraphes
            else if (command === 'heading' && level) {
              document.execCommand('formatBlock', false, 'h' + level);
            } else if (command === 'formatBlock' && value) {
              document.execCommand('formatBlock', false, value);
            }
            // Gestion bold, italic, underline - fonctionnent toujours
            else if (command === 'bold') {
              document.execCommand('bold', false, null);
            } else if (command === 'italic') {
              document.execCommand('italic', false, null);
            } else if (command === 'underline') {
              document.execCommand('underline', false, null);
            }
            // Gestion des listes
            else if (command === 'bulletList') {
              document.execCommand('insertUnorderedList', false, null);
            } else if (command === 'orderedList') {
              document.execCommand('insertOrderedList', false, null);
            } else if (command === 'taskList') {
              // Pour les checklists, créer une liste avec des cases à cocher
              const selection = window.getSelection();
              if (selection.rangeCount > 0) {
                const range = selection.getRangeAt(0);
                
                // Vérifier si on est déjà dans une liste
                let listContainer = range.commonAncestorContainer;
                if (listContainer.nodeType === Node.TEXT_NODE) {
                  listContainer = listContainer.parentElement;
                }
                
                // Trouver la liste parente ou créer une nouvelle liste
                let list = listContainer.closest('ul, ol');
                if (!list) {
                  list = document.createElement('ul');
                  list.style.listStyleType = 'none';
                  list.style.paddingLeft = '1.5rem';
                  // Insérer la liste à la position du curseur
                  if (range.startContainer.nodeType === Node.TEXT_NODE && 
                      range.startContainer.parentElement === editorContent) {
                    const p = document.createElement('p');
                    p.appendChild(list);
                    range.insertNode(p);
                  } else {
                  range.insertNode(list);
                  }
                }
                
                // Créer un élément de liste avec checkbox
                const li = document.createElement('li');
                li.style.listStyleType = 'none';
                li.style.display = 'flex';
                li.style.alignItems = 'flex-start';
                li.style.marginBottom = '0.5rem';
                
                const checkbox = document.createElement('input');
                checkbox.type = 'checkbox';
                checkbox.style.marginRight = '0.5rem';
                checkbox.style.marginTop = '0.25rem';
                checkbox.disabled = true;
                
                const textSpan = document.createElement('span');
                textSpan.textContent = 'Tâche';
                textSpan.contentEditable = 'true';
                
                li.appendChild(checkbox);
                li.appendChild(textSpan);
                list.appendChild(li);
                
                // Placer le curseur dans le texte de la tâche
                const newRange = document.createRange();
                newRange.setStart(textSpan.firstChild || textSpan, 0);
                newRange.setEnd(textSpan.firstChild || textSpan, 0);
                selection.removeAllRanges();
                selection.addRange(newRange);
              }
            }
            // Gestion blockquote
            else if (command === 'blockquote') {
              try {
              document.execCommand('formatBlock', false, 'blockquote');
              } catch (e) {
                // Fallback si formatBlock échoue
                const selection = window.getSelection();
                if (selection.rangeCount > 0) {
                  const range = selection.getRangeAt(0);
                  let blockElement = range.commonAncestorContainer;
                  if (blockElement.nodeType === Node.TEXT_NODE) {
                    blockElement = blockElement.parentElement;
                  }
                  while (blockElement && !['P', 'H2', 'H3', 'LI', 'DIV'].includes(blockElement.tagName)) {
                    blockElement = blockElement.parentElement;
                  }
                  if (blockElement && blockElement.tagName !== 'BLOCKQUOTE') {
                    const blockquote = document.createElement('blockquote');
                    blockElement.parentNode.insertBefore(blockquote, blockElement);
                    blockquote.appendChild(blockElement);
                  }
                }
              }
            }
            // Gestion lien
            else if (command === 'link') {
              const selection = window.getSelection();
              if (selection.rangeCount > 0 && !selection.isCollapsed) {
              const url = prompt('Entrez l\'URL du lien:', 'https://');
              if (url && url.trim()) {
                  try {
                document.execCommand('createLink', false, url.trim());
                  } catch (e) {
                    // Fallback si createLink échoue
                    const range = selection.getRangeAt(0);
                    const link = document.createElement('a');
                    link.href = url.trim();
                    link.textContent = range.toString();
                    try {
                      range.surroundContents(link);
                    } catch (e2) {
                      const contents = range.extractContents();
                      link.appendChild(contents);
                      range.insertNode(link);
                    }
                  }
                }
              } else {
                alert('Veuillez sélectionner le texte à transformer en lien.');
              }
            }
            // Gestion séparateur
            else if (command === 'horizontalRule') {
              try {
              document.execCommand('insertHorizontalRule', false, null);
              } catch (e) {
                // Fallback si insertHorizontalRule échoue
                const hr = document.createElement('hr');
                const selection = window.getSelection();
                if (selection.rangeCount > 0) {
                  const range = selection.getRangeAt(0);
                  range.insertNode(hr);
                } else {
                  editorContent.appendChild(hr);
                }
              }
            }
            // Autres commandes standard
            else {
              document.execCommand(command, false, level || value || null);
            }
            
            // Mettre à jour l'état visuel après un court délai
            setTimeout(() => {
              updateToolbarButtonStates();
            }, 50);
          } catch (err) {
            console.warn('Erreur lors de l\'exécution de la commande:', command, err);
          }
          
          // Maintenir le focus et mettre à jour
          editorContent.focus();
          debouncedUpdate();
        });
      });

      // Alignement
      document.querySelectorAll('.toolbar-btn[data-command^="justify"]').forEach(btn => {
        btn.addEventListener('click', function(e) {
          e.preventDefault();
          e.stopPropagation();
          const command = this.dataset.command;
          
          // Retirer les autres alignements actifs
          document.querySelectorAll('.toolbar-btn[data-command^="justify"]').forEach(b => b.classList.remove('active'));
          this.classList.add('active');
          
          const selection = window.getSelection();
          if (selection.rangeCount > 0) {
            const range = selection.getRangeAt(0);
            let blockElement = range.commonAncestorContainer;
            if (blockElement.nodeType === Node.TEXT_NODE) {
              blockElement = blockElement.parentElement;
            }
            
            // Trouver l'élément bloc (p, h2, h3, li)
            while (blockElement && !['P', 'H2', 'H3', 'LI', 'DIV'].includes(blockElement.tagName)) {
              blockElement = blockElement.parentElement;
            }
            
            if (blockElement) {
              let align = 'left';
              if (command === 'justifyCenter') align = 'center';
              if (command === 'justifyRight') align = 'right';
              
              blockElement.style.textAlign = align;
            }
          }
          
          editorContent.focus();
          debouncedUpdate();
        });
      });

      // Couleur du texte
      const colorBtn = document.getElementById('colorBtn');
      const colorPalette = document.getElementById('colorPalette');
      if (colorBtn && colorPalette) {
        colorBtn.addEventListener('click', function(e) {
          e.preventDefault();
          e.stopPropagation();
          colorPalette.style.display = colorPalette.style.display === 'none' ? 'grid' : 'none';
        });
        
        colorPalette.querySelectorAll('.color-swatch').forEach(swatch => {
          swatch.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            const color = this.dataset.color;
            
            if (color === 'inherit') {
              document.execCommand('foreColor', false, 'inherit');
            } else {
              document.execCommand('foreColor', false, color);
            }
            
            colorPalette.style.display = 'none';
            editorContent.focus();
            debouncedUpdate();
          });
        });
      }

      // Surlignage
      const highlightBtn = document.getElementById('highlightBtn');
      const highlightPalette = document.getElementById('highlightPalette');
      if (highlightBtn && highlightPalette) {
        highlightBtn.addEventListener('click', function(e) {
          e.preventDefault();
          e.stopPropagation();
          highlightPalette.style.display = highlightPalette.style.display === 'none' ? 'grid' : 'none';
        });
        
        highlightPalette.querySelectorAll('.highlight-swatch').forEach(swatch => {
          swatch.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            const color = this.dataset.color;
            
            const selection = window.getSelection();
            if (selection.rangeCount > 0 && !selection.isCollapsed) {
              const range = selection.getRangeAt(0);
              const span = document.createElement('span');
              if (color === 'transparent') {
                span.style.backgroundColor = 'transparent';
              } else {
                span.style.backgroundColor = color;
              }
              
              try {
                range.surroundContents(span);
              } catch (e) {
                const contents = range.extractContents();
                span.appendChild(contents);
                range.insertNode(span);
              }
            }
            
            highlightPalette.style.display = 'none';
            editorContent.focus();
            debouncedUpdate();
          });
        });
      }

      // Tableaux
      const tableBtn = document.getElementById('tableBtn');
      const tableMenu = document.getElementById('tableMenu');
      if (tableBtn && tableMenu) {
        tableBtn.addEventListener('click', function(e) {
          e.preventDefault();
          e.stopPropagation();
          tableMenu.style.display = tableMenu.style.display === 'none' ? 'block' : 'none';
        });
        
        tableMenu.querySelectorAll('.table-menu-item').forEach(item => {
          item.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            const action = this.dataset.action;
            
            if (action === 'insert-table') {
              const table = document.createElement('table');
              const thead = document.createElement('thead');
              const tbody = document.createElement('tbody');
              
              // Créer l'en-tête
              const headerRow = document.createElement('tr');
              for (let j = 0; j < 2; j++) {
                const th = document.createElement('th');
                th.innerHTML = '&nbsp;';
                headerRow.appendChild(th);
              }
              thead.appendChild(headerRow);
              
              // Créer le corps
              for (let i = 0; i < 2; i++) {
                const tr = document.createElement('tr');
                for (let j = 0; j < 2; j++) {
                  const td = document.createElement('td');
                  td.innerHTML = '&nbsp;';
                  tr.appendChild(td);
                }
                tbody.appendChild(tr);
              }
              
              table.appendChild(thead);
              table.appendChild(tbody);
              
              const selection = window.getSelection();
              if (selection.rangeCount > 0) {
                const range = selection.getRangeAt(0);
                // Insérer un paragraphe avant si nécessaire
                if (range.startContainer.nodeType === Node.TEXT_NODE && range.startContainer.parentElement === editorContent) {
                  const p = document.createElement('p');
                  p.appendChild(table);
                  range.insertNode(p);
                } else {
                range.insertNode(table);
                }
              } else {
                // Si pas de sélection, insérer à la fin
                editorContent.appendChild(table);
              }
            } else {
              const selection = window.getSelection();
              if (selection.rangeCount > 0) {
                const range = selection.getRangeAt(0);
                let cell = range.commonAncestorContainer;
                while (cell && cell.tagName !== 'TD' && cell.tagName !== 'TH') {
                  cell = cell.parentElement;
                }
                
                if (cell) {
                  const row = cell.parentElement;
                  const table = row.closest('table');
                  
                  if (!table) {
                    alert('Veuillez placer le curseur dans un tableau.');
                    return;
                  }
                  
                  if (action === 'add-row') {
                    const newRow = row.cloneNode(true);
                    newRow.querySelectorAll('td, th').forEach(c => {
                      c.innerHTML = '&nbsp;';
                      // Convertir th en td si nécessaire
                      if (c.tagName === 'TH' && row.parentElement.tagName === 'TBODY') {
                        const td = document.createElement('td');
                        td.innerHTML = '&nbsp;';
                        newRow.replaceChild(td, c);
                      }
                    });
                    row.parentElement.insertBefore(newRow, row.nextSibling);
                  } else if (action === 'add-col') {
                    const colIndex = Array.from(row.children).indexOf(cell);
                    table.querySelectorAll('tr').forEach(r => {
                      const newCell = cell.cloneNode(true);
                      newCell.innerHTML = '&nbsp;';
                      // Garder le même type de cellule (th ou td)
                      if (cell.tagName === 'TH') {
                        const th = document.createElement('th');
                        th.innerHTML = '&nbsp;';
                      if (r.children[colIndex + 1]) {
                          r.insertBefore(th, r.children[colIndex + 1]);
                      } else {
                          r.appendChild(th);
                        }
                      } else {
                        const td = document.createElement('td');
                        td.innerHTML = '&nbsp;';
                        if (r.children[colIndex + 1]) {
                          r.insertBefore(td, r.children[colIndex + 1]);
                        } else {
                          r.appendChild(td);
                        }
                      }
                    });
                  } else if (action === 'delete-row') {
                    if (table.querySelectorAll('tr').length > 1) {
                    row.remove();
                    } else {
                      alert('Un tableau doit avoir au moins une ligne.');
                    }
                  } else if (action === 'delete-col') {
                    if (row.children.length > 1) {
                    const colIndex = Array.from(row.children).indexOf(cell);
                    table.querySelectorAll('tr').forEach(r => {
                      if (r.children[colIndex]) r.children[colIndex].remove();
                    });
                    } else {
                      alert('Un tableau doit avoir au moins une colonne.');
                    }
                  } else if (action === 'delete-table') {
                    if (confirm('Êtes-vous sûr de vouloir supprimer ce tableau ?')) {
                    table.remove();
                  }
                }
                } else {
                  alert('Veuillez placer le curseur dans une cellule du tableau.');
                }
              } else {
                alert('Veuillez placer le curseur dans le tableau.');
              }
            }
            
            tableMenu.style.display = 'none';
            editorContent.focus();
            debouncedUpdate();
          });
        });
      }

      // Callouts
      const calloutBtn = document.getElementById('calloutBtn');
      const calloutMenu = document.getElementById('calloutMenu');
      if (calloutBtn && calloutMenu) {
        calloutBtn.addEventListener('click', function(e) {
          e.preventDefault();
          e.stopPropagation();
          calloutMenu.style.display = calloutMenu.style.display === 'none' ? 'block' : 'none';
        });
        
        calloutMenu.querySelectorAll('.callout-menu-item[data-callout]').forEach(item => {
          item.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            const type = this.dataset.callout;
            
            const callout = document.createElement('div');
            callout.className = 'callout-' + type;
            
            const title = document.createElement('div');
            title.className = 'callout-title';
            if (type === 'info') title.textContent = 'Info';
            else if (type === 'conseil') title.textContent = 'Conseil';
            else if (type === 'attention') title.textContent = 'Attention';
            
            const content = document.createElement('div');
            content.className = 'callout-content';
            const p = document.createElement('p');
            p.textContent = 'Votre contenu ici...';
            content.appendChild(p);
            
            callout.appendChild(title);
            callout.appendChild(content);
            
            const selection = window.getSelection();
            if (selection.rangeCount > 0) {
              const range = selection.getRangeAt(0);
              // Insérer un saut de ligne avant si nécessaire
              const prevSibling = range.startContainer.previousSibling || 
                                 (range.startContainer.nodeType === Node.TEXT_NODE ? 
                                  range.startContainer.parentElement.previousSibling : null);
              if (prevSibling && prevSibling.nodeType === Node.ELEMENT_NODE && 
                  !['P', 'H2', 'H3', 'DIV', 'BLOCKQUOTE'].includes(prevSibling.tagName)) {
                const br = document.createElement('br');
                range.insertNode(br);
              }
              range.insertNode(callout);
              // Placer le curseur dans le contenu du callout
              const textNode = p.firstChild || p;
              const newRange = document.createRange();
              newRange.setStart(textNode, 0);
              newRange.setEnd(textNode, 0);
              selection.removeAllRanges();
              selection.addRange(newRange);
            } else {
              // Si pas de sélection, insérer à la fin
              editorContent.appendChild(callout);
            }
            
            calloutMenu.style.display = 'none';
            editorContent.focus();
            debouncedUpdate();
          });
        });
      }

      // Templates
      document.querySelectorAll('.template-btn').forEach(btn => {
        btn.addEventListener('click', function(e) {
          e.preventDefault();
          const template = templates[this.dataset.template];
          if (template) {
            const selection = window.getSelection();
            const range = selection.getRangeAt(0);
            range.deleteContents();
            
            const tempDiv = document.createElement('div');
            tempDiv.innerHTML = template;
            const fragment = document.createDocumentFragment();
            Array.from(tempDiv.childNodes).forEach(node => fragment.appendChild(node.cloneNode(true)));
            
            range.insertNode(fragment);
            editorContent.focus();
            debouncedUpdate();
          }
        });
      });

      // Debounce function pour optimiser les performances
      let updateTimeout;
      function debouncedUpdate() {
        clearTimeout(updateTimeout);
        updateTimeout = setTimeout(function() {
          const sanitized = sanitizeHTML(editorContent.innerHTML);
          editorContent.innerHTML = sanitized;
          descriptionInput.value = sanitized;
          updatePreview();
          updateQualityScore();
          updateEmojiCounter();
          updateGoldenCircleChecklist();
          updateClarityScore();
        }, 250);
      }

      // Fonction pour mettre à jour l'état visuel des boutons de style
      function updateToolbarButtonStates() {
        try {
          // Boutons de style (bold, italic, underline)
          const boldBtn = document.querySelector('.toolbar-btn[data-command="bold"]');
          const italicBtn = document.querySelector('.toolbar-btn[data-command="italic"]');
          const underlineBtn = document.querySelector('.toolbar-btn[data-command="underline"]');
          
          if (boldBtn && document.queryCommandSupported('bold')) {
            boldBtn.classList.toggle('active', document.queryCommandState('bold'));
          }
          if (italicBtn && document.queryCommandSupported('italic')) {
            italicBtn.classList.toggle('active', document.queryCommandState('italic'));
          }
          if (underlineBtn && document.queryCommandSupported('underline')) {
            underlineBtn.classList.toggle('active', document.queryCommandState('underline'));
          }
          
          // Boutons de format (P, H2, H3)
          const pBtn = document.querySelector('.toolbar-btn[data-command="formatBlock"][data-value="p"]');
          const h2Btn = document.querySelector('.toolbar-btn[data-command="heading"][data-level="2"]');
          const h3Btn = document.querySelector('.toolbar-btn[data-command="heading"][data-level="3"]');
          
          // Détecter le format actuel du bloc
          const selection = window.getSelection();
          if (selection.rangeCount > 0) {
            const range = selection.getRangeAt(0);
            let blockElement = range.commonAncestorContainer;
            if (blockElement.nodeType === Node.TEXT_NODE) {
              blockElement = blockElement.parentElement;
            }
            
            // Trouver l'élément bloc (p, h2, h3, li, etc.)
            while (blockElement && !['P', 'H2', 'H3', 'LI', 'DIV', 'BLOCKQUOTE'].includes(blockElement.tagName)) {
              blockElement = blockElement.parentElement;
            }
            
            if (blockElement) {
              const tagName = blockElement.tagName.toLowerCase();
              
              // Réinitialiser tous les boutons de format
              if (pBtn) pBtn.classList.remove('active');
              if (h2Btn) h2Btn.classList.remove('active');
              if (h3Btn) h3Btn.classList.remove('active');
              
              // Activer le bouton correspondant
              if (tagName === 'p' && pBtn) {
                pBtn.classList.add('active');
              } else if (tagName === 'h2' && h2Btn) {
                h2Btn.classList.add('active');
              } else if (tagName === 'h3' && h3Btn) {
                h3Btn.classList.add('active');
              }
            }
          }
        } catch (e) {
          // Ignorer les erreurs silencieusement
        }
      }

      // Écouter les changements dans l'éditeur avec debounce
      editorContent.addEventListener('input', debouncedUpdate);
      
      // Mettre à jour l'état des boutons lors de la sélection
      editorContent.addEventListener('mouseup', updateToolbarButtonStates);
      editorContent.addEventListener('keyup', updateToolbarButtonStates);
      editorContent.addEventListener('selectionchange', updateToolbarButtonStates);

      editorContent.addEventListener('paste', function(e) {
        e.preventDefault();
        const text = e.clipboardData.getData('text/plain');
        document.execCommand('insertText', false, text);
        debouncedUpdate();
        updateToolbarButtonStates();
      });

      // Initialiser avec l'ancienne valeur si présente
      if (descriptionInput.value) {
        editorContent.innerHTML = descriptionInput.value;
        debouncedUpdate();
      } else {
        // Initialiser les checklists même si vide
        updateGoldenCircleChecklist();
        updateClarityScore();
      }
      
      // Raccourcis clavier pour Undo/Redo
      editorContent.addEventListener('keydown', function(e) {
        if ((e.ctrlKey || e.metaKey) && e.key === 'z' && !e.shiftKey) {
          e.preventDefault();
          document.execCommand('undo', false, null);
          debouncedUpdate();
        } else if ((e.ctrlKey || e.metaKey) && (e.key === 'y' || (e.key === 'z' && e.shiftKey))) {
          e.preventDefault();
          document.execCommand('redo', false, null);
          debouncedUpdate();
        }
      });

      // Validation avant soumission
      document.getElementById('serviceForm').addEventListener('submit', function(e) {
        const content = editorContent.textContent || editorContent.innerText;
        const html = editorContent.innerHTML;
        
        if (content.trim().length < 30) {
          e.preventDefault();
          alert('<?php echo e(__('La description doit contenir au moins 30 caractères.')); ?>');
          editorContent.focus();
          return false;
        }

        const emojiCount = countEmojis(content);
        if (emojiCount > 6) {
          e.preventDefault();
          alert('<?php echo e(__('Vous avez utilisé trop d\'emojis (maximum 6 autorisés).')); ?>');
          editorContent.focus();
          return false;
        }

        // Sauvegarder le HTML sanitized
        descriptionInput.value = sanitizeHTML(html);
      });
    })();
  </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.freelance.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\younes\Downloads\junspro-main (1)\junspro-main3\resources\views\frontend\freelance\services\create.blade.php ENDPATH**/ ?>