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

    /* Sections */
    .notification-section {
      margin-bottom: 2.5rem;
    }

    .notification-section-title {
      font-size: 1.125rem;
      font-weight: 600;
      color: #1a202c;
      margin: 0 0 1.5rem 0;
      padding-bottom: 0.75rem;
      border-bottom: 2px solid #e5e7eb;
    }

    /* Connection items */
    .connection-item {
      display: flex;
      align-items: flex-start;
      justify-content: space-between;
      padding: 1.5rem;
      background: linear-gradient(135deg, #f3e8ff 0%, #e9d5ff 50%, #ddd6fe 100%);
      border-radius: 16px;
      border: 2px solid #e5e7eb;
      margin-bottom: 1.5rem;
      transition: all 0.2s ease;
    }

    .connection-item:hover {
      border-color: #d1d5db;
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
    }

    .connection-main {
      display: flex;
      align-items: flex-start;
      gap: 1.25rem;
      flex: 1;
    }

    .connection-icon {
      width: 48px;
      height: 48px;
      border-radius: 12px;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 1.5rem;
      font-weight: 600;
      flex-shrink: 0;
      background: white;
      border: 2px solid #e5e7eb;
    }

    .connection-icon-email {
      background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
      color: white;
      border: none;
    }

    .connection-icon-google {
      background: white;
      color: #4285f4;
      border: 2px solid #e5e7eb;
      font-weight: 700;
      font-size: 1.25rem;
    }

    .connection-icon-facebook {
      background: #1877f2;
      color: white;
      border: none;
      font-weight: 700;
      font-size: 1.25rem;
    }

    .connection-title {
      font-size: 1.125rem;
      font-weight: 600;
      color: #1a202c;
      margin-bottom: 0.375rem;
    }

    .connection-subtitle {
      font-size: 0.875rem;
      color: #6b7280;
      margin-bottom: 0.5rem;
    }

    .connection-text {
      font-size: 0.875rem;
      color: #6b7280;
      margin: 0;
      line-height: 1.6;
    }

    .connection-actions {
      flex-shrink: 0;
      margin-left: 1rem;
    }

    /* Buttons */
    .btn {
      padding: 0.625rem 1.25rem;
      border-radius: 10px;
      font-size: 0.875rem;
      font-weight: 500;
      cursor: pointer;
      transition: all 0.2s ease;
      text-decoration: none;
      display: inline-block;
      border: 2px solid transparent;
    }

    .btn-primary {
      background: linear-gradient(135deg, var(--junspro-purple) 0%, var(--junspro-blue) 100%);
      color: white;
      border: none;
    }

    .btn-primary:hover {
      transform: translateY(-1px);
      box-shadow: 0 4px 12px rgba(124, 58, 237, 0.3);
    }

    .btn-outline {
      background: white;
      color: var(--junspro-purple);
      border: 2px solid var(--junspro-purple);
    }

    .btn-outline:hover {
      background: var(--junspro-purple);
      color: white;
    }

    .btn-text {
      background: transparent;
      border: none;
      padding: 0.5rem 0;
    }

    .btn-danger {
      color: #dc2626;
    }

    .btn-danger:hover {
      color: #b91c1c;
      text-decoration: underline;
    }

    .btn-sm {
      padding: 0.5rem 1rem;
      font-size: 0.875rem;
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
      margin: 0 0 1rem 0;
    }

    .info-text {
      font-size: 0.95rem;
      color: #374151;
      line-height: 1.7;
      margin: 0;
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

      .connection-item {
        flex-direction: column;
        gap: 1rem;
      }

      .connection-actions {
        margin-left: 0;
        width: 100%;
      }

      .connection-actions .btn {
        width: 100%;
        text-align: center;
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

      .connection-item {
        padding: 1rem;
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
        <?php
          $user = Auth::guard('web')->user();
        ?>

        <!-- En-tête -->
        <div class="settings-header">
          <h1><?php echo e(__('Connexions & autorisations')); ?></h1>
          <p><?php echo e(__('Gérez les comptes utilisés pour vous connecter à Junspro (Google, Facebook, e-mail & mot de passe). Vous gardez le contrôle sur les accès à votre compte.')); ?></p>
        </div>

        <?php if(session('status') === 'connection-disconnected' || session('success')): ?>
          <div class="alert alert-success">
            ✅ <?php echo e(session('success', __('La connexion a été supprimée. Vous pouvez toujours vous reconnecter plus tard en utilisant ce compte, ou en ajoutant un autre moyen de connexion.'))); ?>

          </div>
        <?php endif; ?>

        <?php if(session('error')): ?>
          <div class="alert alert-error">
            ⚠️ <?php echo session('error'); ?>

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

        <!-- Section : Connexion par e-mail / mot de passe -->
        <div class="notification-section">
          <h2 class="notification-section-title"><?php echo e(__('Connexion par e-mail')); ?></h2>

          <div class="connection-item">
            <div class="connection-main">
              <div class="connection-icon connection-icon-email">📧</div>
              <div>
                <div class="connection-title">
                  <?php echo e(__('E-mail & mot de passe')); ?>

                </div>
                <div class="connection-subtitle">
                  <?php echo e($user->email_address); ?>

                </div>
                <p class="connection-text">
                  <?php echo e(__('Vous pouvez continuer à vous connecter avec votre adresse e-mail et votre mot de passe Junspro. Pour modifier votre mot de passe, rendez-vous dans la section')); ?> <strong><?php echo e(__('Mot de passe')); ?></strong>.
                </p>
              </div>
            </div>
            <div class="connection-actions">
              <a href="<?php echo e(route('user.settings.password')); ?>" class="btn btn-outline btn-sm">
                <?php echo e(__('Gérer le mot de passe')); ?>

              </a>
            </div>
          </div>
        </div>

        <!-- Section : Connexions via services externes -->
        <div class="notification-section">
          <h2 class="notification-section-title"><?php echo e(__('Connexions via d\'autres services')); ?></h2>

          <!-- Google -->
          <div class="connection-item">
            <div class="connection-main">
              <div class="connection-icon connection-icon-google">G</div>
              <div>
                <div class="connection-title">
                  <?php echo e(__('Google')); ?>

                </div>

                <?php if(!empty($providers['google'])): ?>
                  <div class="connection-subtitle">
                    <?php echo e(__('Connecté en tant que')); ?>

                    <strong><?php echo e($providers['google']->email ?? $user->email_address); ?></strong>
                  </div>
                  <p class="connection-text">
                    <?php echo e(__('Vous pouvez vous connecter à Junspro avec votre compte Google. Si vous supprimez cette connexion, vous devrez utiliser votre e-mail et mot de passe Junspro ou un autre service connecté.')); ?>

                  </p>
                <?php else: ?>
                  <div class="connection-subtitle">
                    <?php echo e(__('Aucun compte Google connecté')); ?>

                  </div>
                  <p class="connection-text">
                    <?php echo e(__('En connectant votre compte Google, vous pourrez vous connecter à Junspro en un clic, sans retaper votre mot de passe.')); ?>

                  </p>
                <?php endif; ?>
              </div>
            </div>

            <div class="connection-actions">
              <?php if(!empty($providers['google'])): ?>
                <form method="POST" action="<?php echo e(route('user.settings.connections.disconnect')); ?>"
                      onsubmit="return confirm('<?php echo e(__("Voulez-vous vraiment supprimer la connexion Google ?")); ?>');">
                  <?php echo csrf_field(); ?>
                  <input type="hidden" name="provider" value="google">
                  <button type="submit" class="btn btn-text btn-danger btn-sm">
                    <?php echo e(__('Supprimer la connexion')); ?>

                  </button>
                </form>
              <?php else: ?>
                <?php
                  try {
                    $googleUrl = route('user.login.google');
                  } catch (\Exception $e) {
                    $googleUrl = url('/user/login/google');
                  }
                ?>
                <a href="<?php echo e($googleUrl); ?>" class="btn btn-primary btn-sm">
                  <?php echo e(__('Connecter avec Google')); ?>

                </a>
              <?php endif; ?>
            </div>
          </div>

          <!-- Facebook -->
          <div class="connection-item">
            <div class="connection-main">
              <div class="connection-icon connection-icon-facebook">f</div>
              <div>
                <div class="connection-title">
                  <?php echo e(__('Facebook')); ?>

                </div>

                <?php if(!empty($providers['facebook'])): ?>
                  <div class="connection-subtitle">
                    <?php echo e(__('Connecté en tant que')); ?>

                    <strong><?php echo e($providers['facebook']->name ?? ($user->first_name . ' ' . $user->last_name)); ?></strong>
                  </div>
                  <p class="connection-text">
                    <?php echo e(__('Vous pouvez vous connecter à Junspro avec votre compte Facebook. Supprimer cette connexion ne supprime pas votre compte Facebook, seulement le lien avec Junspro.')); ?>

                  </p>
                <?php else: ?>
                  <div class="connection-subtitle">
                    <?php echo e(__('Aucun compte Facebook connecté')); ?>

                  </div>
                  <p class="connection-text">
                    <?php echo e(__('Vous pouvez connecter Facebook pour simplifier vos connexions.')); ?>

                  </p>
                <?php endif; ?>
              </div>
            </div>

            <div class="connection-actions">
              <?php if(!empty($providers['facebook'])): ?>
                <form method="POST" action="<?php echo e(route('user.settings.connections.disconnect')); ?>"
                      onsubmit="return confirm('<?php echo e(__("Voulez-vous vraiment supprimer la connexion Facebook ?")); ?>');">
                  <?php echo csrf_field(); ?>
                  <input type="hidden" name="provider" value="facebook">
                  <button type="submit" class="btn btn-text btn-danger btn-sm">
                    <?php echo e(__('Supprimer la connexion')); ?>

                  </button>
                </form>
              <?php else: ?>
                <?php
                  try {
                    $facebookUrl = route('user.login.facebook');
                  } catch (\Exception $e) {
                    $facebookUrl = url('/user/login/facebook');
                  }
                ?>
                <a href="<?php echo e($facebookUrl); ?>" class="btn btn-outline btn-sm">
                  <?php echo e(__('Connecter avec Facebook')); ?>

                </a>
              <?php endif; ?>
            </div>
          </div>
        </div>

        <!-- Bloc pédagogique -->
        <div class="info-box">
          <h2 class="info-title"><?php echo e(__('Ce que signifie supprimer une connexion')); ?></h2>
          <p class="info-text">
            <?php echo e(__('Quand vous supprimez une connexion Google ou Facebook, Junspro n\'a plus l\'autorisation d\'utiliser ce compte pour vous identifier. Votre compte Google ou Facebook n\'est pas supprimé, uniquement le lien avec Junspro. Assurez-vous de conserver au moins un moyen de connexion actif (e-mail & mot de passe ou autre service).')); ?>

          </p>
        </div>
      </main>
    </div>
  </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\younes\Downloads\junspro-main (1)\junspro-main3\resources\views\frontend\client\settings\connections.blade.php ENDPATH**/ ?>