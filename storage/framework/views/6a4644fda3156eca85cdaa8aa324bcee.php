

<?php $__env->startSection('style'); ?>
  <style>
    :root {
      --junspro-purple: #7C3AED;
      --junspro-gradient: linear-gradient(135deg, #1e40af 0%, #4c1d95 50%, #7c3aed 100%);
    }

    .complete-page {
      min-height: 100vh;
      background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
      padding: 2rem 0 4rem;
    }

    .complete-container {
      max-width: 700px;
      margin: 0 auto;
      padding: 0 1.5rem;
    }

    /* Message de succès */
    .success-badge {
      display: inline-flex;
      align-items: center;
      gap: 0.5rem;
      padding: 0.75rem 1.25rem;
      background: #f0fdf4;
      color: #166534;
      border-radius: 8px;
      font-size: 0.95rem;
      font-weight: 600;
      margin-bottom: 2rem;
    }

    .success-badge-icon {
      width: 20px;
      height: 20px;
      background: #10b981;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      flex-shrink: 0;
    }

    .success-badge-icon svg {
      width: 12px;
      height: 12px;
      color: white;
    }

    /* Contenu principal - Directement sur le fond, sans bloc */
    .complete-title {
      font-size: 2rem;
      font-weight: 700;
      color: #1a202c;
      margin-bottom: 1.5rem;
      letter-spacing: -0.01em;
    }

    .complete-message {
      font-size: 1rem;
      color: #4b5563;
      line-height: 1.7;
      margin-bottom: 2rem;
    }

    .complete-actions {
      display: flex;
      gap: 1rem;
      justify-content: flex-start;
    }

    .btn-understand {
      padding: 0.875rem 2rem;
      background: var(--junspro-gradient);
      border: none;
      border-radius: 8px;
      color: white;
      font-weight: 600;
      text-decoration: none;
      cursor: pointer;
      transition: all 0.3s ease;
      box-shadow: 0 4px 15px rgba(124, 58, 237, 0.3);
      display: inline-block;
    }

    .btn-understand:hover {
      transform: translateY(-2px);
      box-shadow: 0 6px 20px rgba(124, 58, 237, 0.4);
    }

    .btn-edit-email:hover {
      border-color: #9CA3AF;
      background: #F9FAFB;
    }
    
    .btn-save-email:hover {
      transform: translateY(-1px);
      box-shadow: 0 4px 12px rgba(124, 58, 237, 0.3);
    }

    @media (max-width: 768px) {
      .complete-actions {
        flex-direction: column;
      }

      .btn-understand {
        width: 100%;
        text-align: center;
      }
    }
  </style>
  
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const editEmailBtn = document.getElementById('editEmailBtn');
      const cancelEmailBtn = document.getElementById('cancelEmailBtn');
      const editEmailForm = document.getElementById('editEmailForm');
      const emailUpdateForm = document.getElementById('emailUpdateForm');
      const newEmailInput = document.getElementById('newEmailInput');
      
      if (editEmailBtn && editEmailForm) {
        editEmailBtn.addEventListener('click', function() {
          editEmailForm.style.display = 'block';
          editEmailBtn.style.display = 'none';
          if (newEmailInput) {
            newEmailInput.focus();
          }
        });
      }
      
      if (cancelEmailBtn && editEmailForm) {
        cancelEmailBtn.addEventListener('click', function() {
          editEmailForm.style.display = 'none';
          if (editEmailBtn) {
            editEmailBtn.style.display = 'block';
          }
          if (newEmailInput && emailUpdateForm) {
            newEmailInput.value = '<?php echo e($user->email_address ?? ''); ?>';
            // Réinitialiser les erreurs
            const errorMessages = emailUpdateForm.querySelectorAll('p[style*="color: #EF4444"]');
            errorMessages.forEach(msg => msg.remove());
          }
        });
      }
    });
  </script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
  <div class="complete-page">
    <div class="complete-container">
      <!-- Message de succès -->
      <div class="success-badge">
        <div class="success-badge-icon">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3">
            <polyline points="20 6 9 17 4 12"></polyline>
          </svg>
        </div>
        <span>Envoi réussi</span>
      </div>

      <!-- Contenu principal - Directement sur le fond, sans bloc -->
      <h1 class="complete-title">Merci d'avoir finalisé votre inscription !</h1>
      <p class="complete-message">
        Nous avons bien reçu votre candidature et nous allons l'examiner. Vous recevrez un e-mail vous informant du statut de votre candidature dans un délai de 5 jours ouvrés.
      </p>

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
      
      <!-- Section modification email -->
      <div style="background: #F9FAFB; border: 1px solid #E5E7EB; border-radius: 12px; padding: 1.5rem; margin-bottom: 2rem;">
        <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 1rem;">
          <div>
            <h3 style="font-size: 1rem; font-weight: 600; color: #111827; margin: 0 0 0.25rem 0;">Adresse e-mail</h3>
            <p style="font-size: 0.875rem; color: #6B7280; margin: 0;"><?php echo e($user->email_address ?? ''); ?></p>
          </div>
          <button type="button" id="editEmailBtn" class="btn-edit-email" style="padding: 0.5rem 1rem; background: white; border: 1px solid #D1D5DB; border-radius: 8px; color: #374151; font-weight: 500; font-size: 0.875rem; cursor: pointer; transition: all 0.2s;">
            Modifier
          </button>
        </div>
        
        <!-- Formulaire de modification email (caché par défaut) -->
        <div id="editEmailForm" style="display: none; padding-top: 1rem; border-top: 1px solid #E5E7EB;">
          <form action="<?php echo e(route('freelance.onboarding.update_email')); ?>" method="POST" id="emailUpdateForm">
            <?php echo csrf_field(); ?>
            <div style="margin-bottom: 1rem;">
              <label style="display: block; font-size: 0.875rem; font-weight: 500; color: #374151; margin-bottom: 0.5rem;">Nouvelle adresse e-mail</label>
              <input 
                type="email" 
                name="email" 
                id="newEmailInput"
                value="<?php echo e(old('email', $user->email_address ?? '')); ?>"
                required
                style="width: 100%; padding: 0.75rem; border: 1px solid #D1D5DB; border-radius: 8px; font-size: 0.875rem;"
                placeholder="nouvelle@email.com"
              >
              <?php if($errors->has('email')): ?>
                <p style="color: #EF4444; font-size: 0.875rem; margin-top: 0.5rem;"><?php echo e($errors->first('email')); ?></p>
              <?php endif; ?>
            </div>
            <div style="display: flex; gap: 0.75rem;">
              <button type="submit" class="btn-save-email" style="padding: 0.625rem 1.25rem; background: var(--junspro-gradient); border: none; border-radius: 8px; color: white; font-weight: 500; font-size: 0.875rem; cursor: pointer;">
                Enregistrer
              </button>
              <button type="button" id="cancelEmailBtn" style="padding: 0.625rem 1.25rem; background: white; border: 1px solid #D1D5DB; border-radius: 8px; color: #374151; font-weight: 500; font-size: 0.875rem; cursor: pointer;">
                Annuler
              </button>
            </div>
          </form>
        </div>
      </div>
      
      <div class="complete-actions">
        <a href="<?php echo e(route('index')); ?>" class="btn-understand">
          D'accord, j'ai compris
        </a>
      </div>
    </div>
  </div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('frontend.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\younes\Downloads\junspro-main (1)\junspro-main3\resources\views\frontend\freelance\onboarding\complete.blade.php ENDPATH**/ ?>