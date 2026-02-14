<?php
  $role = $role ?? 'client'; // 'client' ou 'freelance'
  $mode = $mode ?? 'login'; // 'login' ou 'register'
  $isModal = $isModal ?? false;
  $googleRecaptchaStatus = $googleRecaptchaStatus ?? 0;
?>

<div class="auth-container <?php echo e($isModal ? 'auth-modal' : 'auth-page'); ?>" id="authContainer">
  <?php if($isModal): ?>
    <button class="auth-close-btn" onclick="closeAuthModal()" aria-label="Fermer">
      <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
        <line x1="18" y1="6" x2="6" y2="18"></line>
        <line x1="6" y1="6" x2="18" y2="18"></line>
      </svg>
    </button>
  <?php endif; ?>

  <div class="auth-content">
    
    <div class="auth-logo">
      <?php if(isset($websiteInfo) && !empty($websiteInfo->logo)): ?>
        <img src="<?php echo e(asset('assets/img/' . $websiteInfo->logo)); ?>" alt="Junspro" class="auth-logo-img">
      <?php else: ?>
        <div class="auth-logo-text">JUNSPRO</div>
      <?php endif; ?>
    </div>

    
    <div class="auth-role-selector">
      <button 
        class="auth-role-btn <?php echo e($role === 'client' ? 'active' : ''); ?>" 
        onclick="switchRole('client')"
        data-role="client"
        type="button"
      >
        Je suis un client
      </button>
      <button 
        class="auth-role-btn <?php echo e($role === 'freelance' ? 'active' : ''); ?>" 
        onclick="switchRole('freelance')"
        data-role="freelance"
        type="button"
      >
        Je suis un freelance
      </button>
    </div>

    
    <div class="auth-header">
      <h1 class="auth-title">
        <?php if($mode === 'login'): ?>
          Connexion
        <?php else: ?>
          <?php if($role === 'freelance'): ?>
            Commencez votre parcours freelance
          <?php else: ?>
            Créer un compte
          <?php endif; ?>
        <?php endif; ?>
      </h1>
      <p class="auth-subtitle">
        <?php if($role === 'client'): ?>
          <?php if($mode === 'login'): ?>
            Accédez à vos services et vos abonnements en un clic.
          <?php else: ?>
            Créez votre compte client et accédez à des milliers de services.
          <?php endif; ?>
        <?php else: ?>
          <?php if($mode === 'login'): ?>
            Gérez vos missions et vos revenus en toute simplicité.
          <?php else: ?>
            Créez votre compte et suivez les étapes pour devenir freelance sur Junspro.
          <?php endif; ?>
        <?php endif; ?>
      </p>
    </div>

    
    <?php if(session('error')): ?>
      <div class="auth-alert auth-alert-error">
        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" stroke="currentColor">
          <circle cx="10" cy="10" r="9"></circle>
          <line x1="10" y1="6" x2="10" y2="10"></line>
          <line x1="10" y1="14" x2="10" y2="14"></line>
        </svg>
        <div style="flex: 1;">
          <span><?php echo e(session('error')); ?></span>
        </div>
      </div>
    <?php endif; ?>

    <?php if(session('success')): ?>
      <div class="auth-alert auth-alert-success">
        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" stroke="currentColor">
          <path d="M16 6l-8 8-4-4"></path>
        </svg>
        <span><?php echo e(session('success')); ?></span>
      </div>
    <?php endif; ?>

    
    <?php
      $googleEnabled = $googleEnabled ?? false;
      $facebookEnabled = $facebookEnabled ?? false;
      $hasSocialAuth = $googleEnabled || $facebookEnabled;
    ?>

    <?php if($hasSocialAuth): ?>
      <div class="auth-social-buttons">
        <?php if($googleEnabled): ?>
          <a href="<?php echo e(route('user.login.google')); ?>?role=<?php echo e($role); ?>" class="auth-social-btn auth-social-google">
            <svg width="20" height="20" viewBox="0 0 24 24">
              <path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/>
              <path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/>
              <path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z"/>
              <path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"/>
            </svg>
            <span>Continuer avec Google</span>
          </a>
        <?php endif; ?>

        <?php if($facebookEnabled): ?>
          <a href="<?php echo e(route('user.login.facebook')); ?>?role=<?php echo e($role); ?>" class="auth-social-btn auth-social-facebook">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="#1877F2">
              <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
            </svg>
            <span>Continuer avec Facebook</span>
          </a>
        <?php endif; ?>

        <a href="#" class="auth-social-btn auth-social-apple" onclick="alert('Connexion Apple à venir'); return false;">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
            <path d="M17.05 20.28c-.98.95-2.05.88-3.08.4-1.09-.5-2.08-.48-3.24 0-1.44.62-2.2.44-3.06-.4C2.79 15.25 3.51 7.59 9.05 7.31c1.35.07 2.29.74 3.08.8 1.18-.24 2.31-.93 3.57-.84 1.51.12 2.65.72 3.4 1.8-3.12 1.87-2.38 5.98.48 7.13-.57 1.5-1.31 2.99-2.54 4.09l.01-.01zM12.03 7.25c-.15-2.23 1.66-4.07 3.74-4.25.29 2.58-2.34 4.5-3.74 4.25z"/>
          </svg>
          <span>Continuer avec Apple</span>
        </a>
      </div>

      
      <div class="auth-divider">
        <span class="auth-divider-text">ou</span>
      </div>
    <?php endif; ?>

    
    <?php if($mode === 'login'): ?>
      <form action="<?php echo e(route('user.login_submit')); ?>" method="POST" class="auth-form" id="authLoginForm">
        <?php echo csrf_field(); ?>
        <input type="hidden" name="role" value="<?php echo e($role); ?>">

        <div class="auth-form-group">
          <label for="email" class="auth-label">Adresse e-mail</label>
          <input 
            type="email" 
            id="email" 
            name="email_address" 
            class="auth-input <?php $__errorArgs = ['email_address'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> auth-input-error <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
            value="<?php echo e(old('email_address')); ?>"
            placeholder="votre@email.com"
            required
            autocomplete="email"
          >
          <?php $__errorArgs = ['email_address'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            <span class="auth-error"><?php echo e($message); ?></span>
          <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        <div class="auth-form-group">
          <div class="auth-label-row">
            <label for="password" class="auth-label">Mot de passe</label>
            <a href="<?php echo e(route('user.forget_password')); ?>" class="auth-link-forgot">Mot de passe oublié ?</a>
          </div>
          <input 
            type="password" 
            id="password" 
            name="password" 
            class="auth-input <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> auth-input-error <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
            placeholder="••••••••"
            required
            autocomplete="current-password"
          >
          <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            <span class="auth-error"><?php echo e($message); ?></span>
          <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        <button type="submit" class="auth-submit-btn" id="authSubmitBtn">
          <span class="auth-submit-text">Se connecter</span>
          <span class="auth-submit-loader" style="display: none;">
            <svg class="auth-spinner" width="20" height="20" viewBox="0 0 24 24">
              <circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4" fill="none" opacity="0.25"/>
              <path fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"/>
            </svg>
          </span>
        </button>
      </form>
    <?php else: ?>
      <form action="<?php echo e(route('user.signup_submit')); ?>" method="POST" class="auth-form" id="authRegisterForm">
        <?php echo csrf_field(); ?>
        <input type="hidden" name="role" value="<?php echo e($role); ?>">

        <div class="auth-form-group">
          <label for="username" class="auth-label">Nom d'utilisateur</label>
          <input 
            type="text" 
            id="username" 
            name="username" 
            class="auth-input <?php $__errorArgs = ['username'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> auth-input-error <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
            value="<?php echo e(old('username')); ?>"
            placeholder="johndoe"
            required
            autocomplete="username"
          >
          <?php $__errorArgs = ['username'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            <span class="auth-error"><?php echo e($message); ?></span>
          <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        <div class="auth-form-group">
          <label for="email_register" class="auth-label">Adresse e-mail</label>
          <input 
            type="email" 
            id="email_register" 
            name="email_address" 
            class="auth-input <?php $__errorArgs = ['email_address'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> auth-input-error <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
            value="<?php echo e(old('email_address')); ?>"
            placeholder="votre@email.com"
            required
            autocomplete="email"
          >
          <?php $__errorArgs = ['email_address'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            <span class="auth-error"><?php echo e($message); ?></span>
          <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        <div class="auth-form-group">
          <label for="password_register" class="auth-label">Mot de passe</label>
          <input 
            type="password" 
            id="password_register" 
            name="password" 
            class="auth-input <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> auth-input-error <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
            placeholder="••••••••"
            required
            autocomplete="new-password"
          >
          <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            <span class="auth-error"><?php echo e($message); ?></span>
          <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        <div class="auth-form-group">
          <label for="password_confirmation" class="auth-label">Confirmer le mot de passe</label>
          <input 
            type="password" 
            id="password_confirmation" 
            name="password_confirmation" 
            class="auth-input <?php $__errorArgs = ['password_confirmation'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> auth-input-error <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
            placeholder="••••••••"
            required
            autocomplete="new-password"
          >
          <?php $__errorArgs = ['password_confirmation'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            <span class="auth-error"><?php echo e($message); ?></span>
          <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        <button type="submit" class="auth-submit-btn" id="authSubmitBtn">
          <span class="auth-submit-text">
            <?php if($role === 'freelance'): ?>
              Continuer
            <?php else: ?>
              Créer mon compte
            <?php endif; ?>
          </span>
          <span class="auth-submit-loader" style="display: none;">
            <svg class="auth-spinner" width="20" height="20" viewBox="0 0 24 24">
              <circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4" fill="none" opacity="0.25"/>
              <path fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"/>
            </svg>
          </span>
        </button>
      </form>
    <?php endif; ?>

    
    <div class="auth-footer">
      <?php if($mode === 'login'): ?>
        <p class="auth-footer-text">
          Vous n'avez pas de compte ? 
          <a href="<?php echo e(route('user.signup')); ?>?role=<?php echo e($role); ?>" class="auth-footer-link">Inscrivez-vous</a>
        </p>
      <?php else: ?>
        <p class="auth-footer-text">
          Vous avez déjà un compte ? 
          <a href="<?php echo e(route('user.login')); ?>?role=<?php echo e($role); ?>" class="auth-footer-link">Connectez-vous</a>
        </p>
      <?php endif; ?>

      <p class="auth-legal">
        En continuant, vous acceptez nos 
        <a href="#" class="auth-legal-link">Conditions générales</a> 
        et notre 
        <a href="#" class="auth-legal-link">Politique de confidentialité</a>.
      </p>
    </div>
  </div>
</div>

<script>
  function switchRole(newRole) {
    // Mettre à jour l'URL avec le nouveau rôle
    const currentUrl = new URL(window.location.href);
    currentUrl.searchParams.set('role', newRole);
    
    // Mettre à jour le champ caché role dans le formulaire avant de recharger
    const registerForm = document.getElementById('authRegisterForm');
    if (registerForm) {
      const roleInput = registerForm.querySelector('input[name="role"]');
      if (roleInput) {
        roleInput.value = newRole;
      }
    }
    
    window.location.href = currentUrl.toString();
  }

  function closeAuthModal() {
    document.getElementById('authContainer').style.display = 'none';
  }

  // Gestion du loader sur soumission
  document.addEventListener('DOMContentLoaded', function() {
    const forms = document.querySelectorAll('.auth-form');
    forms.forEach(form => {
      form.addEventListener('submit', function() {
        const btn = form.querySelector('#authSubmitBtn');
        const text = btn.querySelector('.auth-submit-text');
        const loader = btn.querySelector('.auth-submit-loader');
        
        if (text) text.style.display = 'none';
        if (loader) loader.style.display = 'inline-block';
        btn.disabled = true;
        
        // Nettoyer localStorage après soumission réussie
        // (sera nettoyé côté serveur si succès, sinon les valeurs restent pour restauration)
        
        // Nettoyer localStorage après un délai (si succès, la page sera rechargée)
        setTimeout(function() {
          // Si on est toujours sur la même page après 2 secondes, c'est qu'il y a eu une erreur
          // Sinon, la redirection aura eu lieu et localStorage sera nettoyé au prochain chargement
        }, 2000);
      });
      
      // Nettoyer localStorage si on arrive sur une page de succès (onboarding step1)
      if (window.location.pathname.includes('/freelance/onboarding/step-1')) {
        // Nettoyer toutes les clés de localStorage liées à l'inscription
        Object.keys(localStorage).forEach(key => {
          if (key.startsWith('signup_form_data')) {
            localStorage.removeItem(key);
          }
        });
      }
    });

    // Mettre à jour le champ caché role si le formulaire existe
    const registerForm = document.getElementById('authRegisterForm');
    if (registerForm) {
      const roleInput = registerForm.querySelector('input[name="role"]');
      const urlParams = new URLSearchParams(window.location.search);
      const roleFromUrl = urlParams.get('role') || 'client';
      
      if (roleInput) {
        roleInput.value = roleFromUrl;
      }
      
      // Sauvegarder les champs dans localStorage
      const storageKey = 'signup_form_data_' + roleFromUrl;
      
      // Restaurer les valeurs sauvegardées
      const savedData = localStorage.getItem(storageKey);
      if (savedData) {
        try {
          const data = JSON.parse(savedData);
          const usernameInput = registerForm.querySelector('#username');
          const emailInput = registerForm.querySelector('#email_register');
          
          if (usernameInput && data.username && !usernameInput.value) {
            usernameInput.value = data.username;
          }
          if (emailInput && data.email_address && !emailInput.value) {
            emailInput.value = data.email_address;
          }
        } catch (e) {
          console.error('Erreur lors de la restauration des données:', e);
        }
      }
      
      // Sauvegarder les valeurs lors de la saisie
      const inputsToSave = ['username', 'email_address'];
      inputsToSave.forEach(fieldName => {
        const input = registerForm.querySelector(`[name="${fieldName}"]`);
        if (input) {
          input.addEventListener('input', function() {
            const currentData = JSON.parse(localStorage.getItem(storageKey) || '{}');
            currentData[fieldName] = this.value;
            localStorage.setItem(storageKey, JSON.stringify(currentData));
          });
          
          input.addEventListener('blur', function() {
            const currentData = JSON.parse(localStorage.getItem(storageKey) || '{}');
            currentData[fieldName] = this.value;
            localStorage.setItem(storageKey, JSON.stringify(currentData));
          });
        }
      });
    }
  });

</script>

<?php /**PATH C:\Users\younes\Downloads\junspro-main (1)\junspro-main3\resources\views/frontend/auth/auth-modal.blade.php ENDPATH**/ ?>