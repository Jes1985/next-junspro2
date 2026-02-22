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

    /* Tableau */
    .billing-table-wrapper {
      overflow-x: auto;
      margin-bottom: 2rem;
    }

    .billing-table {
      width: 100%;
      border-collapse: collapse;
    }

    .billing-table thead {
      background: linear-gradient(135deg, #f3e8ff 0%, #e9d5ff 50%, #ddd6fe 100%);
    }

    .billing-table th {
      padding: 1rem;
      text-align: left;
      font-size: 0.875rem;
      font-weight: 600;
      color: #6b7280;
      text-transform: uppercase;
      letter-spacing: 0.05em;
      border-bottom: 2px solid #e5e7eb;
    }

    .billing-table th.text-right {
      text-align: right;
    }

    .billing-table td {
      padding: 1rem;
      border-bottom: 1px solid #e5e7eb;
      font-size: 0.95rem;
      color: #1a202c;
    }

    .billing-table tbody tr {
      transition: background 0.2s ease;
    }

    .billing-table tbody tr:hover {
      background: linear-gradient(135deg, #f3e8ff 0%, #e9d5ff 50%, #ddd6fe 100%);
    }

    .billing-table td.text-right {
      text-align: right;
    }

    /* Badges de statut */
    .badge {
      display: inline-flex;
      align-items: center;
      padding: 0.375rem 0.75rem;
      border-radius: 6px;
      font-size: 0.875rem;
      font-weight: 500;
    }

    .badge-success {
      background: #f0fdf4;
      color: #166534;
      border: 1px solid #86efac;
    }

    .badge-warning {
      background: #fff7ed;
      color: #9a3412;
      border: 1px solid #fdba74;
    }

    .badge-muted {
      background: #f3f4f6;
      color: #6b7280;
      border: 1px solid #d1d5db;
    }

    .badge-danger {
      background: #fef2f2;
      color: #dc2626;
      border: 1px solid #fca5a5;
    }

    /* Liens */
    .btn-link {
      color: var(--junspro-purple);
      text-decoration: none;
      font-size: 0.875rem;
      font-weight: 500;
      transition: color 0.2s ease;
    }

    .btn-link:hover {
      color: var(--junspro-blue);
      text-decoration: underline;
    }

    .text-muted {
      color: #9ca3af;
    }

    /* Pagination */
    .pagination-wrapper {
      margin-top: 2rem;
      display: flex;
      justify-content: center;
    }

    /* Empty state */
    .empty-state {
      text-align: center;
      padding: 4rem 2rem;
      color: #6b7280;
    }

    .empty-state-icon {
      font-size: 4rem;
      margin-bottom: 1.5rem;
      opacity: 0.5;
      color: var(--junspro-purple);
    }

    .empty-state-title {
      font-size: 1.5rem;
      font-weight: 600;
      color: #1a202c;
      margin-bottom: 0.75rem;
    }

    .empty-state-text {
      font-size: 1rem;
      margin-bottom: 2rem;
      max-width: 500px;
      margin-left: auto;
      margin-right: auto;
      line-height: 1.6;
    }

    .btn-primary {
      padding: 0.875rem 2rem;
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

    .btn-primary:hover {
      transform: translateY(-2px);
      box-shadow: 0 6px 20px rgba(124, 58, 237, 0.4);
    }

    /* Section aide */
    .settings-subsection {
      margin-top: 3rem;
      padding-top: 2rem;
      border-top: 1px solid #e5e7eb;
    }

    .settings-subsection h2 {
      font-size: 1.25rem;
      font-weight: 600;
      color: #1a202c;
      margin-bottom: 0.75rem;
    }

    .settings-subsection p {
      font-size: 0.95rem;
      color: #6b7280;
      line-height: 1.6;
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

      .billing-table-wrapper {
        overflow-x: scroll;
      }

      .billing-table {
        min-width: 800px;
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

      .billing-table th,
      .billing-table td {
        padding: 0.75rem 0.5rem;
        font-size: 0.875rem;
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
          <h1><?php echo e(__('Historique de paiement')); ?></h1>
          <p><?php echo e(__('Consultez vos paiements Junspro, les détails de vos abonnements et téléchargez vos factures en toute autonomie.')); ?></p>
        </div>

        <?php if($invoices && $invoices->count() > 0): ?>
          <div class="billing-table-wrapper">
            <table class="billing-table">
              <thead>
                <tr>
                  <th><?php echo e(__('Date')); ?></th>
                  <th><?php echo e(__('Projet / freelance')); ?></th>
                  <th><?php echo e(__('Type')); ?></th>
                  <th><?php echo e(__('Montant')); ?></th>
                  <th><?php echo e(__('Mode de paiement')); ?></th>
                  <th><?php echo e(__('Statut')); ?></th>
                  <th class="text-right"><?php echo e(__('Facture')); ?></th>
                </tr>
              </thead>
              <tbody>
                <?php $__currentLoopData = $invoices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $invoice): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <tr>
                    <td>
                      <?php echo e($invoice->date->format('d/m/Y')); ?>

                    </td>

                    <td>
                      <?php echo e($invoice->freelancer_name ?? __('—')); ?>

                    </td>

                    <td>
                      <?php echo e($invoice->type_label ?? __('Paiement')); ?>

                    </td>

                    <td>
                      <strong>
                        <?php echo e(number_format($invoice->amount, 2, ',', ' ')); ?>

                        <?php echo e($invoice->currency === 'EUR' ? '€' : $invoice->currency); ?>

                      </strong>
                    </td>

                    <td>
                      <?php echo e($invoice->payment_method_label ?? __('Carte bancaire')); ?>

                    </td>

                    <td>
                      <?php
                        $status = $invoice->status ?? 'paid';
                      ?>
                      <span class="badge
                        <?php if($status === 'paid'): ?> badge-success
                        <?php elseif(in_array($status, ['pending', 'processing'])): ?> badge-warning
                        <?php elseif(in_array($status, ['refunded', 'canceled'])): ?> badge-muted
                        <?php else: ?> badge-danger <?php endif; ?>
                      ">
                        <?php switch($status):
                          case ('paid'): ?>
                            <?php echo e(__('Payé')); ?>

                            <?php break; ?>
                          <?php case ('pending'): ?>
                          <?php case ('processing'): ?>
                            <?php echo e(__('En cours')); ?>

                            <?php break; ?>
                          <?php case ('refunded'): ?>
                            <?php echo e(__('Remboursé')); ?>

                            <?php break; ?>
                          <?php case ('canceled'): ?>
                            <?php echo e(__('Annulé')); ?>

                            <?php break; ?>
                          <?php case ('failed'): ?>
                            <?php echo e(__('Échoué')); ?>

                            <?php break; ?>
                          <?php default: ?>
                            <?php echo e(ucfirst($status)); ?>

                        <?php endswitch; ?>
                      </span>
                    </td>

                    <td class="text-right">
                      <?php if(!empty($invoice->invoice_url) || !empty($invoice->invoice_path)): ?>
                        <a href="<?php echo e(route('user.settings.billing_history.invoice', $invoice->id)); ?>" class="btn-link" target="_blank">
                          <i class="fas fa-download"></i> <?php echo e(__('Télécharger')); ?>

                        </a>
                      <?php else: ?>
                        <span class="text-muted">—</span>
                      <?php endif; ?>
                    </td>
                  </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </tbody>
            </table>
          </div>

          
          <?php if(method_exists($invoices, 'links')): ?>
            <div class="pagination-wrapper">
              <?php echo e($invoices->links()); ?>

            </div>
          <?php endif; ?>
        <?php else: ?>
          <div class="empty-state">
            <div class="empty-state-icon">
              <i class="far fa-receipt"></i>
            </div>
            <div class="empty-state-title"><?php echo e(__('Aucun paiement enregistré pour le moment')); ?></div>
            <div class="empty-state-text">
              <?php echo e(__('Dès que vous aurez réservé une session ou souscrit un abonnement Junspro, vos paiements apparaîtront ici avec la possibilité de télécharger vos factures.')); ?>

            </div>
            <a href="<?php echo e(route('explore') ?? '#'); ?>" class="btn-primary">
              <i class="fas fa-search"></i> <?php echo e(__('Trouver un freelance et démarrer')); ?>

            </a>
          </div>
        <?php endif; ?>

        
        <div class="settings-subsection">
          <h2><?php echo e(__('Besoin d\'aide concernant un paiement ?')); ?></h2>
          <p>
            <?php echo e(__('Si un montant vous semble incorrect ou si vous ne trouvez pas une facture, contactez le support Junspro en indiquant la date et le montant concernés. Nous vous répondrons dans les meilleurs délais.')); ?>

          </p>
        </div>
      </main>
    </div>
  </div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('frontend.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\younes\Downloads\junspro-main (1)\junspro-main3\resources\views\frontend\client\settings\billing-history.blade.php ENDPATH**/ ?>