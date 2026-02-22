

<?php $__env->startSection('content'); ?>
  <div style="max-width: 1200px; margin: 0 auto; padding: 2rem 1rem;">
    <div style="margin-bottom: 2rem;">
      <h1 style="font-size: 2rem; font-weight: 700; margin-bottom: 0.5rem;">Vidéo de présentation</h1>
      <p style="color: #6b7280; font-size: 1rem;">Ajoutez ou modifiez votre vidéo de présentation pour votre profil public.</p>
    </div>

    <?php if(session('success')): ?>
      <div style="background: #d1fae5; border: 1px solid #10b981; color: #065f46; padding: 1rem; border-radius: 8px; margin-bottom: 2rem;">
        <?php echo e(session('success')); ?>

      </div>
    <?php endif; ?>

    <?php if(session('error')): ?>
      <div style="background: #fee2e2; border: 1px solid #ef4444; color: #991b1b; padding: 1rem; border-radius: 8px; margin-bottom: 2rem;">
        <?php echo e(session('error')); ?>

      </div>
    <?php endif; ?>

    <div style="background: white; border-radius: 16px; padding: 2rem; box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);">
      <form method="POST" action="<?php echo e(route('freelance.settings.video.update')); ?>">
        <?php echo csrf_field(); ?>

        <div style="margin-bottom: 2rem;">
          <label for="video_url" style="display: block; font-weight: 600; margin-bottom: 0.5rem; color: #111827;">
            URL de la vidéo
          </label>
          <p style="color: #6b7280; font-size: 0.875rem; margin-bottom: 1rem;">
            Entrez l'URL de votre vidéo YouTube, Vimeo ou une URL directe vers votre vidéo.
          </p>
          <input 
            type="url" 
            id="video_url" 
            name="video_url" 
            value="<?php echo e(old('video_url', $freelancerProfile->video_url ?? '')); ?>"
            placeholder="https://www.youtube.com/watch?v=..."
            style="width: 100%; padding: 0.75rem 1rem; border: 2px solid #e5e7eb; border-radius: 8px; font-size: 1rem; transition: border-color 0.2s;"
            class="<?php $__errorArgs = ['video_url'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
          >
          <?php $__errorArgs = ['video_url'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            <p style="color: #ef4444; font-size: 0.875rem; margin-top: 0.5rem;"><?php echo e($message); ?></p>
          <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        <?php if($freelancerProfile->video_url): ?>
          <div style="margin-bottom: 2rem; padding: 1rem; background: #f9fafb; border-radius: 8px;">
            <p style="font-weight: 600; margin-bottom: 0.5rem; color: #111827;">Vidéo actuelle :</p>
            <p style="color: #6b7280; font-size: 0.875rem; word-break: break-all;"><?php echo e($freelancerProfile->video_url); ?></p>
          </div>
        <?php endif; ?>

        <div style="display: flex; gap: 1rem; align-items: center;">
          <button 
            type="submit" 
            style="background: linear-gradient(135deg, #4F46E5 0%, #7C3AED 100%); color: white; padding: 0.75rem 2rem; border: none; border-radius: 8px; font-weight: 600; font-size: 1rem; cursor: pointer; transition: transform 0.2s, box-shadow 0.2s;"
            onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 4px 12px rgba(79, 70, 229, 0.3)';"
            onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none';"
          >
            Enregistrer
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

    <div style="margin-top: 2rem; padding: 1.5rem; background: #eff6ff; border-left: 4px solid #3b82f6; border-radius: 8px;">
      <h3 style="font-weight: 600; margin-bottom: 0.5rem; color: #1e40af;">💡 Conseils</h3>
      <ul style="color: #1e3a8a; margin: 0; padding-left: 1.5rem; line-height: 1.8;">
        <li>Pour YouTube : copiez l'URL complète de la vidéo (ex: https://www.youtube.com/watch?v=...)</li>
        <li>Pour Vimeo : copiez l'URL complète de la vidéo (ex: https://vimeo.com/...)</li>
        <li>Les URLs courtes (youtu.be) sont également acceptées</li>
        <li>La vidéo sera visible sur votre profil public</li>
      </ul>
    </div>
  </div>
<?php $__env->stopSection(); ?>









<?php echo $__env->make('frontend.freelance.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\younes\Downloads\junspro-main (1)\junspro-main3\resources\views\frontend\freelance\settings\video.blade.php ENDPATH**/ ?>