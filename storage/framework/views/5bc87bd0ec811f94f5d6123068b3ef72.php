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
    }

    /* Alertes */
    .alert {
      padding: 1rem 1.5rem;
      border-radius: 12px;
      margin-bottom: 1.5rem;
      display: flex;
      align-items: center;
      gap: 0.75rem;
    }

    .alert-success {
      background: #f0fdf4;
      color: #166534;
      border: 1px solid #86efac;
    }

    .alert-error {
      background: #fef2f2;
      color: #991b1b;
      border: 1px solid #fca5a5;
    }

    /* Section liste des moyens de paiement */
    .payment-methods-list {
      margin-bottom: 3rem;
    }

    .payment-method-card {
      padding: 1.5rem;
      border: 1px solid #e5e7eb;
      border-radius: 12px;
      margin-bottom: 1rem;
      display: flex;
      align-items: center;
      justify-content: space-between;
      transition: all 0.2s ease;
      background: white;
    }

    .payment-method-card:hover {
      border-color: var(--junspro-purple);
      box-shadow: 0 2px 8px rgba(124, 58, 237, 0.1);
    }

    .payment-method-info {
      display: flex;
      align-items: center;
      gap: 1rem;
      flex: 1;
    }

    .payment-method-icon {
      width: 48px;
      height: 32px;
      border-radius: 6px;
      background: linear-gradient(135deg, #1e40af 0%, #7C3AED 100%);
      display: flex;
      align-items: center;
      justify-content: center;
      color: white;
      font-weight: 700;
      font-size: 0.875rem;
      flex-shrink: 0;
    }

    .payment-method-details {
      flex: 1;
    }

    .payment-method-brand {
      font-size: 1rem;
      font-weight: 600;
      color: #1a202c;
      margin-bottom: 0.25rem;
    }

    .payment-method-number {
      font-size: 0.875rem;
      color: #6b7280;
      font-family: 'Courier New', monospace;
      letter-spacing: 0.05em;
    }

    .payment-method-expiry {
      font-size: 0.875rem;
      color: #6b7280;
      margin-top: 0.25rem;
    }

    .payment-method-badge {
      display: inline-flex;
      align-items: center;
      padding: 0.25rem 0.75rem;
      background: #f0fdf4;
      color: #166534;
      border: 1px solid #86efac;
      border-radius: 6px;
      font-size: 0.75rem;
      font-weight: 600;
      margin-top: 0.5rem;
    }

    .payment-method-actions {
      display: flex;
      align-items: center;
      gap: 1rem;
    }

    .btn-delete {
      padding: 0.5rem 1rem;
      background: white;
      border: 1px solid #e5e7eb;
      color: #ef4444;
      border-radius: 8px;
      font-size: 0.875rem;
      font-weight: 500;
      cursor: pointer;
      transition: all 0.2s ease;
      text-decoration: none;
      display: inline-block;
    }

    .btn-delete:hover {
      background: #fef2f2;
      border-color: #fca5a5;
    }

    /* Section ajout */
    .add-payment-method-section {
      padding-top: 2rem;
      border-top: 1px solid #e5e7eb;
    }

    .add-payment-method-section h2 {
      font-size: 1.5rem;
      font-weight: 600;
      color: #1a202c;
      margin-bottom: 0.5rem;
    }

    .add-payment-method-section p {
      font-size: 0.875rem;
      color: #6b7280;
      margin-bottom: 1.5rem;
    }

    .card-element-container {
      margin-bottom: 1.5rem;
      padding: 1.25rem;
      background: linear-gradient(135deg, #f3e8ff 0%, #e9d5ff 50%, #ddd6fe 100%);
      border: 1px solid #e5e7eb;
      border-radius: 12px;
    }

    #card-element {
      padding: 0.75rem;
      background: white;
      border: 1px solid #d1d5db;
      border-radius: 8px;
    }

    .card-element-container .form-label {
      display: block;
      font-size: 0.875rem;
      font-weight: 500;
      color: #374151;
      margin-bottom: 0.5rem;
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
      text-decoration: none;
      display: inline-block;
    }

    .btn-primary-gradient:hover {
      transform: translateY(-2px);
      box-shadow: 0 6px 20px rgba(124, 58, 237, 0.4);
    }

    .btn-primary-gradient:active {
      transform: translateY(0);
    }

    .empty-state {
      text-align: center;
      padding: 3rem 1rem;
      color: #6b7280;
    }

    .empty-state-icon {
      font-size: 3rem;
      margin-bottom: 1rem;
      opacity: 0.5;
    }

    .empty-state-text {
      font-size: 1rem;
      margin-bottom: 0.5rem;
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

      .payment-method-card {
        flex-direction: column;
        align-items: flex-start;
        gap: 1rem;
      }

      .payment-method-actions {
        width: 100%;
        justify-content: flex-end;
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

      .btn-primary-gradient {
        width: 100%;
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
          <h1><?php echo e(__('Gérez vos modes de paiement')); ?></h1>
          <p><?php echo e(__('Ajoutez et gérez vos moyens de paiement en toute sécurité. Vos informations sont cryptées et protégées.')); ?></p>
        </div>

        <?php if(session('status') === 'payment-method-added' || (session('success') && session('status') === 'payment-method-added')): ?>
          <div class="alert alert-success">
            ✅ <?php echo e(session('success', __('Votre moyen de paiement a été ajouté avec succès.'))); ?>

          </div>
        <?php endif; ?>

        <?php if(session('status') === 'payment-method-removed' || (session('success') && session('status') === 'payment-method-removed')): ?>
          <div class="alert alert-success">
            ✅ <?php echo e(session('success', __('Le moyen de paiement a été supprimé avec succès.'))); ?>

          </div>
        <?php endif; ?>

        <?php if($errors->any()): ?>
          <div class="alert alert-error">
            <ul>
              <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li>• <?php echo e($error); ?></li>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
          </div>
        <?php endif; ?>

        <!-- Liste des moyens de paiement -->
        <div class="payment-methods-list">
          <?php if($paymentMethods && $paymentMethods->count() > 0): ?>
            <?php $__currentLoopData = $paymentMethods; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $method): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <div class="payment-method-card">
                <div class="payment-method-info">
                  <div class="payment-method-icon">
                    <?php echo e(strtoupper(substr($method->brand ?? 'CARD', 0, 1))); ?>

                  </div>
                  <div class="payment-method-details">
                    <div class="payment-method-brand"><?php echo e($method->brand ?? __('Carte bancaire')); ?></div>
                    <div class="payment-method-number">• • • • <?php echo e($method->last4 ?? '0000'); ?></div>
                    <div class="payment-method-expiry">
                      <?php echo e(__('Expire le')); ?> <?php echo e(str_pad($method->exp_month ?? '00', 2, '0', STR_PAD_LEFT)); ?>/<?php echo e(substr($method->exp_year ?? '0000', -2)); ?>

                    </div>
                    <?php if($method->is_default ?? false): ?>
                      <span class="payment-method-badge"><?php echo e(__('Mode de paiement principal')); ?></span>
                    <?php endif; ?>
                  </div>
                </div>
                <div class="payment-method-actions">
                  <form method="POST" action="<?php echo e(route('user.settings.payment_methods.destroy', $method->id)); ?>" style="display: inline;" onsubmit="return confirm('<?php echo e(__("Êtes-vous sûr de vouloir supprimer ce moyen de paiement ?")); ?>');">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('DELETE'); ?>
                    <button type="submit" class="btn-delete">
                      <i class="fas fa-trash"></i> <?php echo e(__('Supprimer')); ?>

                    </button>
                  </form>
                </div>
              </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          <?php else: ?>
            <div class="empty-state">
              <div class="empty-state-icon">
                <i class="far fa-credit-card"></i>
              </div>
              <div class="empty-state-text"><?php echo e(__("Vous n'avez pas encore ajouté de moyen de paiement.")); ?></div>
            </div>
          <?php endif; ?>
        </div>

        <!-- Section ajout -->
        <div class="add-payment-method-section">
          <h2><?php echo e(__('Ajouter un moyen de paiement')); ?></h2>
          <p><?php echo e(__("Vos informations de paiement sont sécurisées et cryptées. Aucune donnée bancaire n'est stockée sur nos serveurs.")); ?></p>

          <form method="POST" action="<?php echo e(route('user.settings.payment_methods.store')); ?>" id="payment-method-form">
            <?php echo csrf_field(); ?>

            <div class="card-element-container">
              <label class="form-label"><?php echo e(__('Informations de la carte')); ?></label>
              <div id="card-element">
                <!-- Stripe Elements ou autre système de paiement sera intégré ici -->
                <div style="padding: 1rem; background: #f9fafb; border-radius: 8px; text-align: center; color: #6b7280; font-size: 0.875rem;">
                  <i class="fas fa-credit-card" style="font-size: 1.5rem; margin-bottom: 0.5rem; display: block;"></i>
                  <?php echo e(__('Zone de saisie de carte bancaire')); ?><br>
                  <small><?php echo e(__('Stripe Elements / PayPal sera intégré ici')); ?></small>
                </div>
              </div>
              <input type="hidden" name="payment_method_token" id="payment_method_token" value="">
            </div>

            <button type="submit" class="btn-primary-gradient">
              <i class="fas fa-plus"></i> <?php echo e(__('Enregistrer ce moyen de paiement')); ?>

            </button>
          </form>
        </div>
      </main>
    </div>
  </div>

  <script>
    // TODO: Intégrer Stripe Elements ou autre système de paiement
    // Exemple avec Stripe (à décommenter et configurer) :
    /*
    const stripe = Stripe('<?php echo e(config("services.stripe.key")); ?>');
    const elements = stripe.elements();
    const cardElement = elements.create('card');
    cardElement.mount('#card-element');

    const form = document.getElementById('payment-method-form');
    form.addEventListener('submit', async (e) => {
      e.preventDefault();
      
      const {token, error} = await stripe.createToken(cardElement);
      
      if (error) {
        // Afficher l'erreur
        console.error(error);
      } else {
        document.getElementById('payment_method_token').value = token.id;
        form.submit();
      }
    });
    */
  </script>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('frontend.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\younes\Downloads\junspro-main (1)\junspro-main3\resources\views\frontend\client\settings\payment-methods.blade.php ENDPATH**/ ?>