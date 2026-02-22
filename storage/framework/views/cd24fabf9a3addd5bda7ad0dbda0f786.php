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

    /* Switch Toggle */
    .switch-group {
      padding: 1.5rem;
      background: linear-gradient(135deg, #f3e8ff 0%, #e9d5ff 50%, #ddd6fe 100%);
      border-radius: 12px;
      border: 2px solid #e5e7eb;
    }

    .switch-label {
      display: flex;
      align-items: center;
      cursor: pointer;
      gap: 1rem;
    }

    .switch-label input[type="checkbox"] {
      display: none;
    }

    .switch {
      position: relative;
      width: 52px;
      height: 28px;
      background: #d1d5db;
      border-radius: 14px;
      transition: all 0.3s ease;
      flex-shrink: 0;
    }

    .switch::before {
      content: '';
      position: absolute;
      width: 24px;
      height: 24px;
      border-radius: 50%;
      background: white;
      top: 2px;
      left: 2px;
      transition: all 0.3s ease;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
    }

    .switch-label input[type="checkbox"]:checked + .switch {
      background: var(--junspro-purple);
    }

    .switch-label input[type="checkbox"]:checked + .switch::before {
      transform: translateX(24px);
    }

    .switch-text {
      font-size: 1rem;
      font-weight: 600;
      color: #1a202c;
      flex: 1;
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
          <h1><?php echo e(__('Confirmation automatique des sessions')); ?></h1>
          <p><?php echo e(__('Junspro vous aide à garder un rythme régulier : chaque Rituel comprend 50 min de travail et 10 min de rapport. Si vous ne signalez pas de problème, les Rituels sont confirmés automatiquement après un certain délai.')); ?></p>
        </div>

        <?php if(session('status') === 'auto-confirmation-updated' || session('success')): ?>
          <div class="alert alert-success">
            ✅ <?php echo e(session('success', __('Vos préférences de confirmation automatique ont été mises à jour.'))); ?>

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

        <form method="POST" action="<?php echo e(route('user.settings.auto_confirmation.update')); ?>" class="settings-form">
          <?php echo csrf_field(); ?>

          
          <div class="form-group switch-group">
            <label class="switch-label">
              <input type="checkbox"
                     name="auto_confirm_enabled"
                     value="1"
                     <?php if(old('auto_confirm_enabled', $settings['auto_confirm_enabled'] ?? true)): ?> checked <?php endif; ?>>
              <span class="switch"></span>
              <span class="switch-text">
                <?php echo e(__('Activer la confirmation automatique des sessions')); ?>

              </span>
            </label>
            <p class="form-hint">
              <?php echo e(__('Quand cette option est activée, une session est considérée comme validée automatiquement si vous ne signalez pas de problème dans le délai choisi.')); ?>

            </p>
          </div>

          
          <div class="form-group">
            <label for="auto_confirm_delay_hours" class="form-label">
              <?php echo e(__('Délai avant validation automatique')); ?>

            </label>
            <select id="auto_confirm_delay_hours"
                    name="auto_confirm_delay_hours"
                    class="select">
              <?php $__currentLoopData = [24, 48, 72]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $delay): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($delay); ?>"
                  <?php if((int) old('auto_confirm_delay_hours', $settings['auto_confirm_delay_hours'] ?? 48) === $delay): ?>
                    selected
                  <?php endif; ?>>
                  <?php echo e($delay); ?> <?php echo e(__('heures')); ?>

                </option>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
            <p class="form-hint">
              <?php echo e(__('Exemple : avec 48 heures, si vous ne signalez rien dans les 2 jours suivant la session, celle-ci est automatiquement confirmée.')); ?>

            </p>
          </div>

          
          <div class="form-group">
            <label for="reminder_before_hours" class="form-label">
              <?php echo e(__('Rappel avant confirmation')); ?>

            </label>
            <select id="reminder_before_hours"
                    name="reminder_before_hours"
                    class="select">
              <?php
                $reminder = (int) old('reminder_before_hours', $settings['reminder_before_hours'] ?? 24);
              ?>
              <option value="0" <?php if($reminder === 0): ?> selected <?php endif; ?>>
                <?php echo e(__('Aucun rappel')); ?>

              </option>
              <option value="12" <?php if($reminder === 12): ?> selected <?php endif; ?>>
                <?php echo e(__('12 heures avant')); ?>

              </option>
              <option value="24" <?php if($reminder === 24): ?> selected <?php endif; ?>>
                <?php echo e(__('24 heures avant')); ?>

              </option>
            </select>
            <p class="form-hint">
              <?php echo e(__('Si activé, vous recevrez un e-mail avant la validation automatique pour vérifier que tout s\'est bien passé avec le freelance.')); ?>

            </p>
          </div>

          
          <div class="info-box">
            <h2 class="info-title"><?php echo e(__('Comment cela fonctionne côté Junspro ?')); ?></h2>
            <ul class="info-list">
              <li>
                <?php echo e(__('Le freelance travaille')); ?> <strong>50 minutes</strong> <?php echo e(__('et rédige un')); ?>

                <strong><?php echo e(__('rapport de 10 minutes')); ?></strong> <?php echo e(__('à la fin de chaque session.')); ?>

              </li>
              <li>
                <?php echo e(__('Vous recevez ce rapport dans votre tableau de bord et par e-mail.')); ?>

              </li>
              <li>
                <?php echo e(__('Si tout est OK, vous n\'avez rien à faire : la session sera marquée comme')); ?>

                <strong><?php echo e(__('validée automatiquement')); ?></strong> <?php echo e(__('une fois le délai écoulé.')); ?>

              </li>
              <li>
                <?php echo e(__('En cas de souci, vous pouvez signaler un problème avant la validation automatique, et l\'équipe Junspro pourra intervenir si besoin.')); ?>

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
<?php $__env->stopSection(); ?>


<?php echo $__env->make('frontend.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\younes\Downloads\junspro-main (1)\junspro-main3\resources\views\frontend\client\settings\auto-confirmation.blade.php ENDPATH**/ ?>