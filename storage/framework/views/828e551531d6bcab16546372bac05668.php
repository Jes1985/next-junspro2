

<?php $__env->startSection('content'); ?>
  <div style="max-width: 1200px; margin: 0 auto; padding: 2rem 1rem;">
    <div style="margin-bottom: 2rem;">
      <h1 style="font-size: 2rem; font-weight: 700; margin-bottom: 0.5rem;">Notifications</h1>
      <p style="color: #6b7280; font-size: 1rem;">Rappels, demandes, messages, bilans.</p>
    </div>

    <?php if(session('success')): ?>
      <div style="background: #d1fae5; border: 1px solid #10b981; color: #065f46; padding: 1rem; border-radius: 8px; margin-bottom: 2rem;">
        <?php echo e(session('success')); ?>

      </div>
    <?php endif; ?>

    <div style="background: white; border-radius: 16px; padding: 2rem; box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);">
      <form method="POST" action="<?php echo e(route('user.settings.notifications.update')); ?>">
        <?php echo csrf_field(); ?>

        <!-- Section Demandes de clients -->
        <div style="margin-bottom: 2.5rem;">
          <h3 style="font-size: 1.25rem; font-weight: 600; color: #111827; margin-bottom: 1rem;">Demandes de clients</h3>
          
          <div style="display: flex; align-items: center; justify-content: space-between; padding: 1rem; background: #f9fafb; border-radius: 8px; margin-bottom: 1rem;">
            <div>
              <p style="font-weight: 600; margin: 0; color: #111827;">Nouvelles demandes</p>
              <p style="color: #6b7280; font-size: 0.875rem; margin: 0.25rem 0 0 0;">Recevoir un e-mail pour chaque nouvelle demande</p>
            </div>
            <label style="position: relative; display: inline-block; width: 50px; height: 26px;">
              <input type="checkbox" name="notify_requests" checked style="opacity: 0; width: 0; height: 0;">
              <span style="position: absolute; cursor: pointer; top: 0; left: 0; right: 0; bottom: 0; background-color: #4F46E5; transition: .4s; border-radius: 26px;"></span>
            </label>
          </div>
        </div>

        <!-- Section Messages -->
        <div style="margin-bottom: 2.5rem;">
          <h3 style="font-size: 1.25rem; font-weight: 600; color: #111827; margin-bottom: 1rem;">Messages</h3>
          
          <div style="display: flex; align-items: center; justify-content: space-between; padding: 1rem; background: #f9fafb; border-radius: 8px; margin-bottom: 1rem;">
            <div>
              <p style="font-weight: 600; margin: 0; color: #111827;">Nouveaux messages</p>
              <p style="color: #6b7280; font-size: 0.875rem; margin: 0.25rem 0 0 0;">Recevoir un e-mail pour chaque nouveau message</p>
            </div>
            <label style="position: relative; display: inline-block; width: 50px; height: 26px;">
              <input type="checkbox" name="notify_messages" checked style="opacity: 0; width: 0; height: 0;">
              <span style="position: absolute; cursor: pointer; top: 0; left: 0; right: 0; bottom: 0; background-color: #4F46E5; transition: .4s; border-radius: 26px;"></span>
            </label>
          </div>
        </div>

        <!-- Section Rendez-vous -->
        <div style="margin-bottom: 2.5rem;">
          <h3 style="font-size: 1.25rem; font-weight: 600; color: #111827; margin-bottom: 1rem;">Rendez-vous</h3>
          
          <div style="display: flex; align-items: center; justify-content: space-between; padding: 1rem; background: #f9fafb; border-radius: 8px; margin-bottom: 1rem;">
            <div>
              <p style="font-weight: 600; margin: 0; color: #111827;">Rappels de rendez-vous</p>
              <p style="color: #6b7280; font-size: 0.875rem; margin: 0.25rem 0 0 0;">Recevoir un rappel 1 heure avant chaque rendez-vous</p>
            </div>
            <label style="position: relative; display: inline-block; width: 50px; height: 26px;">
              <input type="checkbox" name="notify_appointments" checked style="opacity: 0; width: 0; height: 0;">
              <span style="position: absolute; cursor: pointer; top: 0; left: 0; right: 0; bottom: 0; background-color: #4F46E5; transition: .4s; border-radius: 26px;"></span>
            </label>
          </div>
        </div>

        <!-- Section Bilans -->
        <div style="margin-bottom: 2.5rem;">
          <h3 style="font-size: 1.25rem; font-weight: 600; color: #111827; margin-bottom: 1rem;">Rapports d'activité</h3>
          
          <div style="display: flex; align-items: center; justify-content: space-between; padding: 1rem; background: #f9fafb; border-radius: 8px; margin-bottom: 1rem;">
            <div>
              <p style="font-weight: 600; margin: 0; color: #111827;">Bilan hebdomadaire</p>
              <p style="color: #6b7280; font-size: 0.875rem; margin: 0.25rem 0 0 0;">Recevoir un résumé de votre activité chaque semaine</p>
            </div>
            <label style="position: relative; display: inline-block; width: 50px; height: 26px;">
              <input type="checkbox" name="notify_weekly" checked style="opacity: 0; width: 0; height: 0;">
              <span style="position: absolute; cursor: pointer; top: 0; left: 0; right: 0; bottom: 0; background-color: #4F46E5; transition: .4s; border-radius: 26px;"></span>
            </label>
          </div>
        </div>

        <div style="display: flex; gap: 1rem; align-items: center;">
          <button 
            type="submit" 
            style="background: linear-gradient(135deg, #4F46E5 0%, #7C3AED 100%); color: white; padding: 0.75rem 2rem; border: none; border-radius: 8px; font-weight: 600; font-size: 1rem; cursor: pointer; transition: transform 0.2s, box-shadow 0.2s;"
            onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 4px 12px rgba(79, 70, 229, 0.3)';"
            onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none';"
          >
            Enregistrer les préférences
          </button>
          <a 
            href="<?php echo e(route('freelance.dashboard', ['tab' => 'settings'])); ?>" 
            style="color: #6b7280; text-decoration: none; font-weight: 500; padding: 0.75rem 1.5rem; border-radius: 8px; transition: background-color 0.2s;"
            onmouseover="this.style.backgroundColor='#f3f4f6';"
            onmouseout="this.style.backgroundColor='transparent';"
          >
            Annuler
          </a>
        </div>
      </form>
    </div>
  </div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('frontend.freelance.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\younes\Downloads\junspro-main (1)\junspro-main3\resources\views\frontend\freelance\settings\notifications.blade.php ENDPATH**/ ?>