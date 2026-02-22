<?php $__env->startSection('style'); ?>
  <link rel="stylesheet" href="<?php echo e(asset('assets/css/summernote-content.css')); ?>">
  <style>
    :root {
      --junspro-purple: #7C3AED;
      --junspro-blue: #1e40af;
      --junspro-gradient: linear-gradient(135deg, #1e40af 0%, #4c1d95 50%, #7c3aed 100%);
      --card-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
      --card-shadow-hover: 0 8px 30px rgba(30, 64, 175, 0.15);
    }

    /* Layout principal */
    .settings-container {
      max-width: 1280px;
      margin: 0 auto;
      padding: 2rem 1.5rem;
      padding-top: 3rem;
      background: linear-gradient(135deg, #f3e8ff 0%, #e9d5ff 50%, #ddd6fe 100%);
      min-height: calc(100vh - 200px);
    }

    /* Container principal en 2 colonnes */
    .settings-wrapper {
      display: grid;
      grid-template-columns: 25% 75%;
      gap: 2rem;
      margin-top: 2rem;
    }

    /* Menu vertical gauche */
    .settings-sidebar {
      background: white;
      border-radius: 20px;
      box-shadow: var(--card-shadow);
      padding: 1.5rem 0;
      height: fit-content;
      position: sticky;
      top: 2rem;
    }

    .settings-sidebar-title {
      padding: 0 1.5rem 1rem 1.5rem;
      font-size: 0.875rem;
      font-weight: 600;
      color: #6b7280;
      text-transform: uppercase;
      letter-spacing: 0.05em;
      border-bottom: 1px solid #e5e7eb;
      margin-bottom: 0.5rem;
    }

    .settings-menu {
      list-style: none;
      padding: 0;
      margin: 0;
    }

    .settings-menu-item {
      margin: 0;
    }

    .settings-menu-item a {
      display: block;
      padding: 0.875rem 1.5rem;
      color: #374151;
      text-decoration: none;
      font-size: 0.95rem;
      font-weight: 500;
      transition: all 0.2s ease;
      border-left: 3px solid transparent;
      position: relative;
    }

    .settings-menu-item a:hover {
      background: linear-gradient(135deg, #f3e8ff 0%, #e9d5ff 50%, #ddd6fe 100%);
      color: var(--junspro-purple);
    }

    .settings-menu-item a.active {
      background: #f3f4f6;
      color: var(--junspro-purple);
      font-weight: 600;
      border-left-color: var(--junspro-purple);
    }

    /* Contenu principal droite */
    .settings-content {
      background: white;
      border-radius: 20px;
      box-shadow: var(--card-shadow);
      padding: 2.5rem;
    }

    .settings-header {
      margin-bottom: 2.5rem;
      padding-bottom: 1.5rem;
      border-bottom: 1px solid #e5e7eb;
    }

    .settings-header h1 {
      font-size: 2rem;
      font-weight: 700;
      color: #1a202c;
      margin: 0 0 0.5rem 0;
    }

    .settings-header p {
      font-size: 0.95rem;
      color: #6b7280;
      margin: 0;
      line-height: 1.6;
    }

    /* Alerts */
    .alert {
      padding: 1rem 1.5rem;
      border-radius: 12px;
      margin-bottom: 2rem;
      font-size: 0.95rem;
    }

    .alert-success {
      background: #f0fdf4;
      color: #166534;
      border: 1px solid #86efac;
    }

    .alert-error {
      background: #fef2f2;
      color: #dc2626;
      border: 1px solid #fca5a5;
    }

    /* Formulaires */
    .settings-form {
      margin-top: 2rem;
    }

    .form-group {
      margin-bottom: 2.5rem;
    }

    .form-label {
      display: block;
      font-size: 0.95rem;
      font-weight: 600;
      color: #1a202c;
      margin-bottom: 0.75rem;
    }

    .form-control {
      width: 100%;
      padding: 0.875rem 1rem;
      border: 2px solid #e5e7eb;
      border-radius: 12px;
      font-size: 0.95rem;
      color: #1a202c;
      transition: all 0.2s ease;
      background: white;
    }

    .form-control:focus {
      outline: none;
      border-color: var(--junspro-purple);
      box-shadow: 0 0 0 3px rgba(124, 58, 237, 0.1);
    }

    .select {
      width: 100%;
      padding: 0.875rem 1rem;
      border: 2px solid #e5e7eb;
      border-radius: 12px;
      font-size: 0.95rem;
      color: #1a202c;
      transition: all 0.2s ease;
      background: white;
      cursor: pointer;
    }

    .select:focus {
      outline: none;
      border-color: var(--junspro-purple);
      box-shadow: 0 0 0 3px rgba(124, 58, 237, 0.1);
    }

    .form-hint {
      font-size: 0.875rem;
      color: #6b7280;
      margin-top: 0.5rem;
      line-height: 1.5;
    }

    .form-error {
      font-size: 0.875rem;
      color: #dc2626;
      margin-top: 0.5rem;
    }

    /* Radio chips (inline options) */
    .inline-options {
      display: flex;
      gap: 1rem;
      flex-wrap: wrap;
    }

    .radio-chip {
      display: flex;
      align-items: center;
      padding: 0.875rem 1.5rem;
      border: 2px solid #e5e7eb;
      border-radius: 12px;
      cursor: pointer;
      transition: all 0.2s ease;
      background: white;
      font-size: 0.95rem;
      font-weight: 500;
      color: #374151;
    }

    .radio-chip:hover {
      border-color: var(--junspro-purple);
      background: linear-gradient(135deg, #f3e8ff 0%, #e9d5ff 50%, #ddd6fe 100%);
    }

    .radio-chip input[type="radio"] {
      display: none;
    }

    .radio-chip input[type="radio"]:checked + span {
      color: var(--junspro-purple);
    }

    .radio-chip input[type="radio"]:checked ~ .radio-chip {
      border-color: var(--junspro-purple);
      background: #f3f4f6;
    }

    .radio-chip:has(input[type="radio"]:checked) {
      border-color: var(--junspro-purple);
      background: #f3f4f6;
      color: var(--junspro-purple);
    }

    /* Info box */
    .info-box {
      margin-top: 3rem;
      padding: 2rem;
      background: linear-gradient(135deg, #f3e8ff 0%, #e9d5ff 50%, #ddd6fe 100%);
      border-radius: 16px;
      border-left: 4px solid var(--junspro-purple);
    }

    .info-title {
      font-size: 1.25rem;
      font-weight: 600;
      color: #1a202c;
      margin: 0 0 1.25rem 0;
    }

    .info-list {
      list-style: none;
      padding: 0;
      margin: 0;
    }

    .info-list li {
      padding: 0.75rem 0;
      font-size: 0.95rem;
      color: #374151;
      line-height: 1.7;
      padding-left: 1.75rem;
      position: relative;
    }

    .info-list li::before {
      content: '✓';
      position: absolute;
      left: 0;
      color: var(--junspro-purple);
      font-weight: 600;
      font-size: 1.1rem;
    }

    .info-list li strong {
      color: #1a202c;
      font-weight: 600;
    }

    /* Actions */
    .form-actions {
      margin-top: 3rem;
      padding-top: 2rem;
      border-top: 1px solid #e5e7eb;
    }

    .btn-primary-gradient {
      padding: 1rem 2rem;
      background: linear-gradient(135deg, var(--junspro-purple) 0%, var(--junspro-blue) 100%);
      color: white;
      border: none;
      border-radius: 12px;
      font-size: 1rem;
      font-weight: 600;
      cursor: pointer;
      transition: all 0.3s ease;
      box-shadow: 0 4px 15px rgba(124, 58, 237, 0.3);
    }

    .btn-primary-gradient:hover {
      transform: translateY(-2px);
      box-shadow: 0 6px 20px rgba(124, 58, 237, 0.4);
    }

    .btn-primary-gradient i {
      margin-right: 0.5rem;
    }

    /* Responsive */
    @media (max-width: 968px) {
      .settings-wrapper {
        grid-template-columns: 1fr;
      }

      .settings-sidebar {
        position: relative;
        top: 0;
      }

      .settings-menu {
        display: flex;
        overflow-x: auto;
        padding: 0 1rem;
        -webkit-overflow-scrolling: touch;
      }

      .settings-menu-item {
        flex-shrink: 0;
      }

      .settings-menu-item a {
        white-space: nowrap;
        border-left: none;
        border-bottom: 3px solid transparent;
        padding: 0.875rem 1rem;
      }

      .settings-menu-item a.active {
        border-left: none;
        border-bottom-color: var(--junspro-purple);
      }

      .inline-options {
        flex-direction: column;
      }

      .radio-chip {
        width: 100%;
      }
    }

    @media (max-width: 640px) {
      .settings-container {
        padding: 1rem;
        padding-top: 2rem;
      }

      .settings-content {
        padding: 1.5rem;
      }

      .info-box {
        padding: 1.5rem;
      }
    }
  </style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
  <div class="settings-container">
    <?php echo $__env->make('frontend.client.partials.dashboard-nav', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    <div class="settings-wrapper">
      <!-- Menu vertical gauche -->
      <aside class="settings-sidebar">
        <div class="settings-sidebar-title"><?php echo e(__('Compte')); ?></div>
        <ul class="settings-menu">
          <li class="settings-menu-item">
            <a href="<?php echo e(route('user.settings.index')); ?>" class="<?php echo e(request()->routeIs('user.settings.index') ? 'active' : ''); ?>">
              <?php echo e(__('Compte')); ?>

            </a>
          </li>
          <li class="settings-menu-item">
            <a href="<?php echo e(route('user.settings.password')); ?>" class="<?php echo e(request()->routeIs('user.settings.password') ? 'active' : ''); ?>">
              <?php echo e(__('Mot de passe')); ?>

            </a>
          </li>
          <li class="settings-menu-item">
            <a href="<?php echo e(route('user.settings.email.edit')); ?>" class="<?php echo e(request()->routeIs('user.settings.email.*') ? 'active' : ''); ?>">
              <?php echo e(__('Adresse e-mail')); ?>

            </a>
          </li>
          <li class="settings-menu-item">
            <a href="<?php echo e(route('user.settings.payment_methods.index')); ?>" class="<?php echo e(request()->routeIs('user.settings.payment_methods.*') ? 'active' : ''); ?>">
              <?php echo e(__('Modes de paiement')); ?>

            </a>
          </li>
          <li class="settings-menu-item">
            <a href="<?php echo e(route('user.settings.subscription')); ?>" class="<?php echo e(request()->routeIs('user.settings.subscription') ? 'active' : ''); ?>">
              <?php echo e(__('Abonnement Junspro')); ?>

            </a>
          </li>
          <li class="settings-menu-item">
            <a href="<?php echo e(route('user.settings.billing_history')); ?>" class="<?php echo e(request()->routeIs('user.settings.billing_history.*') ? 'active' : ''); ?>">
              <?php echo e(__('Historique de paiement')); ?>

            </a>
          </li>
          <li class="settings-menu-item">
            <a href="<?php echo e(route('user.settings.auto_confirmation')); ?>" class="<?php echo e(request()->routeIs('user.settings.auto_confirmation*') ? 'active' : ''); ?>">
              <?php echo e(__('Confirmation automatique')); ?>

            </a>
          </li>
          <li class="settings-menu-item">
            <a href="<?php echo e(route('user.settings.agenda')); ?>" class="<?php echo e(request()->routeIs('user.settings.agenda*') ? 'active' : ''); ?>">
              <?php echo e(__('Agenda & fuseau horaire')); ?>

            </a>
          </li>
          <li class="settings-menu-item">
            <?php
              try {
                $notificationsUrl = route('user.settings.notifications');
              } catch (\Exception $e) {
                $notificationsUrl = url('/user/settings/notifications');
              }
            ?>
            <a href="<?php echo e($notificationsUrl); ?>" class="<?php echo e(request()->routeIs('user.settings.notifications*') ? 'active' : ''); ?>">
              <?php echo e(__('Notifications')); ?>

            </a>
          </li>
          <li class="settings-menu-item">
            <?php
              try {
                $connectionsUrl = route('user.settings.connections');
              } catch (\Exception $e) {
                $connectionsUrl = url('/user/settings/connections');
              }
            ?>
            <a href="<?php echo e($connectionsUrl); ?>" class="<?php echo e(request()->routeIs('user.settings.connections*') ? 'active' : ''); ?>">
              <?php echo e(__('Connexions & autorisations')); ?>

            </a>
          </li>
          <li class="settings-menu-item">
            <?php
              try {
                $deleteAccountUrl = route('user.settings.delete_account');
              } catch (\Exception $e) {
                $deleteAccountUrl = url('/user/settings/delete-account');
              }
            ?>
            <a href="<?php echo e($deleteAccountUrl); ?>" class="danger-link <?php echo e(request()->routeIs('user.settings.delete_account*') ? 'active' : ''); ?>" style="color: #dc2626;">
              <?php echo e(__('Supprimer le compte')); ?>

            </a>
          </li>
        </ul>
      </aside>

      <!-- Contenu principal droite -->
      <main class="settings-content">
        <!-- En-tête -->
        <div class="settings-header">
          <h1><?php echo e(__('Agenda & fuseau horaire')); ?></h1>
          <p><?php echo e(__('Choisissez comment Junspro affiche les horaires de vos sessions : fuseau horaire, format d\'heure et vue par défaut. Cela vous évite les décalages et les malentendus avec les freelances.')); ?></p>
        </div>

        <?php if(session('status') === 'agenda-updated' || session('success')): ?>
          <div class="alert alert-success">
            ✅ <?php echo e(session('success', __('Vos préférences d\'agenda ont été mises à jour.'))); ?>

          </div>
        <?php endif; ?>

        <?php if($errors->any()): ?>
          <div class="alert alert-error">
            <ul style="margin: 0; padding-left: 1.5rem;">
              <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li>• <?php echo e($error); ?></li>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
          </div>
        <?php endif; ?>

        <form method="POST" action="<?php echo e(route('user.settings.agenda.update')); ?>" class="settings-form">
          <?php echo csrf_field(); ?>

          
          <div class="form-group">
            <label for="timezone" class="form-label"><?php echo e(__('Fuseau horaire')); ?></label>
            <select id="timezone" name="timezone" class="select">
              <?php $__currentLoopData = $commonTimezones; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tzValue => $tzLabel): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($tzValue); ?>"
                  <?php if(old('timezone', $settings['timezone'] ?? 'Europe/Paris') === $tzValue): ?> selected <?php endif; ?>>
                  <?php echo e($tzLabel); ?>

                </option>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
            <p class="form-hint">
              <?php echo e(__('Tous les horaires de vos sessions (00h–23h) et de vos rapports seront affichés selon ce fuseau horaire.')); ?>

            </p>
          </div>

          
          <div class="form-group">
            <label class="form-label"><?php echo e(__('Format d\'heure')); ?></label>
            <?php
              $timeFormat = old('time_format', $settings['time_format'] ?? '24h');
            ?>
            <div class="inline-options">
              <label class="radio-chip">
                <input type="radio" name="time_format" value="24h"
                  <?php if($timeFormat === '24h'): ?> checked <?php endif; ?>>
                <span>24h (00:00 – 23:00)</span>
              </label>
              <label class="radio-chip">
                <input type="radio" name="time_format" value="12h"
                  <?php if($timeFormat === '12h'): ?> checked <?php endif; ?>>
                <span>12h (am / pm)</span>
              </label>
            </div>
            <p class="form-hint">
              <?php echo e(__('Junspro fonctionne nativement en 24h (00h–23h) pour éviter les confusions, mais vous pouvez choisir le format qui vous convient.')); ?>

            </p>
          </div>

          
          <div class="form-group">
            <label class="form-label"><?php echo e(__('Début de semaine')); ?></label>
            <?php
              $weekStart = old('week_start', $settings['week_start'] ?? 'monday');
            ?>
            <div class="inline-options">
              <label class="radio-chip">
                <input type="radio" name="week_start" value="monday"
                  <?php if($weekStart === 'monday'): ?> checked <?php endif; ?>>
                <span><?php echo e(__('Lundi')); ?></span>
              </label>
              <label class="radio-chip">
                <input type="radio" name="week_start" value="sunday"
                  <?php if($weekStart === 'sunday'): ?> checked <?php endif; ?>>
                <span><?php echo e(__('Dimanche')); ?></span>
              </label>
            </div>
            <p class="form-hint">
              <?php echo e(__('Ce réglage influence l\'affichage de votre calendrier (vue semaine / mois).')); ?>

            </p>
          </div>

          
          <div class="form-group">
            <label for="default_view" class="form-label"><?php echo e(__('Vue par défaut de l\'agenda')); ?></label>
            <?php
              $defaultView = old('default_view', $settings['default_view'] ?? 'week');
            ?>
            <select id="default_view" name="default_view" class="select">
              <option value="week" <?php if($defaultView === 'week'): ?> selected <?php endif; ?>>
                <?php echo e(__('Vue semaine (recommandé)')); ?>

              </option>
              <option value="month" <?php if($defaultView === 'month'): ?> selected <?php endif; ?>>
                <?php echo e(__('Vue mois')); ?>

              </option>
            </select>
            <p class="form-hint">
              <?php echo e(__('La vue semaine est idéale pour suivre les sessions à venir et garder un bon rythme avec votre freelance.')); ?>

            </p>
          </div>

          
          <div class="info-box">
            <h2 class="info-title"><?php echo e(__('Comment Junspro utilise ces réglages ?')); ?></h2>
            <ul class="info-list">
              <li>
                <?php echo e(__('Quand vous réservez une session, les créneaux affichés (00h–23h) sont automatiquement ajustés à votre fuseau horaire.')); ?>

              </li>
              <li>
                <?php echo e(__('Le freelance voit l\'horaire dans son propre fuseau, mais Junspro synchronise les deux pour éviter toute confusion.')); ?>

              </li>
              <li>
                <?php echo e(__('Les rapports envoyés par le freelance sont horodatés avec ce réglage, ce qui facilite le suivi de l\'avancement de vos projets.')); ?>

              </li>
            </ul>
          </div>

          
          <div class="form-actions">
            <button type="submit" class="btn-primary-gradient">
              <i class="fas fa-save"></i> <?php echo e(__('Enregistrer mes préférences')); ?>

            </button>
          </div>
        </form>
      </main>
    </div>
  </div>

  <script>
    // Gérer l'état visuel des radio chips
    document.addEventListener('DOMContentLoaded', function() {
      const radioChips = document.querySelectorAll('.radio-chip');
      
      radioChips.forEach(chip => {
        const radio = chip.querySelector('input[type="radio"]');
        
        // Mettre à jour visuellement au chargement
        if (radio && radio.checked) {
          chip.style.borderColor = 'var(--junspro-purple)';
          chip.style.background = '#f3f4f6';
          chip.style.color = 'var(--junspro-purple)';
        }
        
        // Mettre à jour visuellement au clic
        chip.addEventListener('click', function() {
          // Désélectionner tous les autres dans le même groupe
          const name = radio.name;
          document.querySelectorAll(`input[name="${name}"]`).forEach(r => {
            r.closest('.radio-chip').style.borderColor = '#e5e7eb';
            r.closest('.radio-chip').style.background = 'white';
            r.closest('.radio-chip').style.color = '#374151';
          });
          
          // Sélectionner celui-ci
          radio.checked = true;
          chip.style.borderColor = 'var(--junspro-purple)';
          chip.style.background = '#f3f4f6';
          chip.style.color = 'var(--junspro-purple)';
        });
      });
    });
  </script>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('frontend.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\younes\Downloads\junspro-main (1)\junspro-main3\resources\views\frontend\client\settings\agenda.blade.php ENDPATH**/ ?>