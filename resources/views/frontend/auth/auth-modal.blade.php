@php
  $role = $role ?? 'client'; // 'client' ou 'freelance'
  $mode = $mode ?? 'login'; // 'login' ou 'register'
  $isModal = $isModal ?? false;
  $googleRecaptchaStatus = $googleRecaptchaStatus ?? 0;
@endphp

<div class="auth-container {{ $isModal ? 'auth-modal' : 'auth-page' }}" id="authContainer">
  @if($isModal)
    <button class="auth-close-btn" onclick="closeAuthModal()" aria-label="Fermer">
      <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
        <line x1="18" y1="6" x2="6" y2="18"></line>
        <line x1="6" y1="6" x2="18" y2="18"></line>
      </svg>
    </button>
  @endif

  <div class="auth-content">
    {{-- Logo --}}
    <div class="auth-logo">
      @if(isset($websiteInfo) && !empty($websiteInfo->logo))
        <img src="{{ asset('assets/img/' . $websiteInfo->logo) }}" alt="Junspro" class="auth-logo-img">
      @else
        <div class="auth-logo-text">JUNSPRO</div>
      @endif
    </div>

    {{-- Sélecteur de rôle --}}
    <div class="auth-role-selector">
      <button 
        class="auth-role-btn {{ $role === 'client' ? 'active' : '' }}" 
        onclick="switchRole('client')"
        data-role="client"
        type="button"
      >
        Je suis un client
      </button>
      <button 
        class="auth-role-btn {{ $role === 'freelance' ? 'active' : '' }}" 
        onclick="switchRole('freelance')"
        data-role="freelance"
        type="button"
      >
        Je suis un freelance
      </button>
      <button 
        class="auth-role-btn nexus-btn {{ $role === 'nexus' ? 'active nexus-active' : '' }}" 
        onclick="switchRole('nexus')"
        data-role="nexus"
        type="button"
      >
        <span class="nexus-icon">✦</span> Compte NEXUS
      </button>
    </div>

    {{-- En-tête --}}
    <div class="auth-header">
      <h1 class="auth-title">
        @if($mode === 'login')
          Connexion
        @else
          @if($role === 'nexus')
            Rejoindre NEXUS
          @elseif($role === 'freelance')
            Commencez votre parcours freelance
          @else
            Créer un compte
          @endif
        @endif
      </h1>
      <p class="auth-subtitle {{ $role === 'nexus' ? 'nexus-subtitle' : '' }}">
        @if($role === 'nexus')
          @if($mode === 'login')
            Habitez le monde. Échangez autrement.
          @else
            Rejoignez NEXUS et échangez dans plus de 30 pays, en toute confiance.
          @endif
        @elseif($role === 'client')
          @if($mode === 'login')
            Accédez à vos services et vos abonnements en un clic.
          @else
            Créez votre compte client et accédez à des milliers de services.
          @endif
        @else
          @if($mode === 'login')
            Gérez vos missions et vos revenus en toute simplicité.
          @else
            Créez votre compte et suivez les étapes pour devenir freelance sur Junspro.
          @endif
        @endif
      </p>
    </div>

    {{-- Messages d'erreur globaux --}}
    @if(session('error'))
      <div class="auth-alert auth-alert-error">
        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" stroke="currentColor">
          <circle cx="10" cy="10" r="9"></circle>
          <line x1="10" y1="6" x2="10" y2="10"></line>
          <line x1="10" y1="14" x2="10" y2="14"></line>
        </svg>
        <div style="flex: 1;">
          <span>{{ session('error') }}</span>
        </div>
      </div>
    @endif

    @if(session('success'))
      <div class="auth-alert auth-alert-success">
        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" stroke="currentColor">
          <path d="M16 6l-8 8-4-4"></path>
        </svg>
        <span>{{ session('success') }}</span>
      </div>
    @endif

    {{-- Boutons de connexion sociale --}}
    @php
      $googleEnabled = $googleEnabled ?? false;
      $facebookEnabled = $facebookEnabled ?? false;
      $hasSocialAuth = $googleEnabled || $facebookEnabled;
    @endphp

    @if($hasSocialAuth)
      <div class="auth-social-buttons">
        @if($googleEnabled)
          <a href="{{ route('user.login.google') }}?role={{ $role }}" class="auth-social-btn auth-social-google">
            <svg width="20" height="20" viewBox="0 0 24 24">
              <path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/>
              <path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/>
              <path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z"/>
              <path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"/>
            </svg>
            <span>Continuer avec Google</span>
          </a>
        @endif

        @if($facebookEnabled)
          <a href="{{ route('user.login.facebook') }}?role={{ $role }}" class="auth-social-btn auth-social-facebook">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="#1877F2">
              <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
            </svg>
            <span>Continuer avec Facebook</span>
          </a>
        @endif

        <a href="#" class="auth-social-btn auth-social-apple" onclick="alert('Connexion Apple à venir'); return false;">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
            <path d="M17.05 20.28c-.98.95-2.05.88-3.08.4-1.09-.5-2.08-.48-3.24 0-1.44.62-2.2.44-3.06-.4C2.79 15.25 3.51 7.59 9.05 7.31c1.35.07 2.29.74 3.08.8 1.18-.24 2.31-.93 3.57-.84 1.51.12 2.65.72 3.4 1.8-3.12 1.87-2.38 5.98.48 7.13-.57 1.5-1.31 2.99-2.54 4.09l.01-.01zM12.03 7.25c-.15-2.23 1.66-4.07 3.74-4.25.29 2.58-2.34 4.5-3.74 4.25z"/>
          </svg>
          <span>Continuer avec Apple</span>
        </a>
      </div>

      {{-- Séparateur --}}
      <div class="auth-divider">
        <span class="auth-divider-text">ou</span>
      </div>
    @endif

    {{-- Formulaire --}}
    @if($mode === 'login')
      <form action="{{ route('user.login_submit') }}" method="POST" class="auth-form" id="authLoginForm">
        @csrf
        <input type="hidden" name="role" value="{{ $role }}">

        <div class="auth-form-group">
          <label for="email" class="auth-label">Adresse e-mail</label>
          <input 
            type="email" 
            id="email" 
            name="email_address" 
            class="auth-input @error('email_address') auth-input-error @enderror" 
            value="{{ old('email_address') }}"
            placeholder="votre@email.com"
            required
            autocomplete="email"
          >
          @error('email_address')
            <span class="auth-error">{{ $message }}</span>
          @enderror
        </div>

        <div class="auth-form-group">
          <div class="auth-label-row">
            <label for="password" class="auth-label">Mot de passe</label>
            <a href="{{ route('user.forget_password') }}" class="auth-link-forgot">Mot de passe oublié ?</a>
          </div>
          <input 
            type="password" 
            id="password" 
            name="password" 
            class="auth-input @error('password') auth-input-error @enderror" 
            placeholder="••••••••"
            required
            autocomplete="current-password"
          >
          @error('password')
            <span class="auth-error">{{ $message }}</span>
          @enderror
        </div>

        <button type="submit" class="auth-submit-btn {{ $role === 'nexus' ? 'nexus-submit' : '' }}" id="authSubmitBtn">
          <span class="auth-submit-text">Se connecter</span>
          <span class="auth-submit-loader" style="display: none;">
            <svg class="auth-spinner" width="20" height="20" viewBox="0 0 24 24">
              <circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4" fill="none" opacity="0.25"/>
              <path fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"/>
            </svg>
          </span>
        </button>
      </form>
    @else
      <form action="{{ route('user.signup_submit') }}" method="POST" class="auth-form" id="authRegisterForm">
        @csrf
        <input type="hidden" name="role" value="{{ $role }}">

        <div class="auth-form-group">
          <label for="username" class="auth-label">Nom d'utilisateur</label>
          <input 
            type="text" 
            id="username" 
            name="username" 
            class="auth-input @error('username') auth-input-error @enderror" 
            value="{{ old('username') }}"
            placeholder="johndoe"
            required
            autocomplete="username"
          >
          @error('username')
            <span class="auth-error">{{ $message }}</span>
          @enderror
        </div>

        <div class="auth-form-group">
          <label for="email_register" class="auth-label">Adresse e-mail</label>
          <input 
            type="email" 
            id="email_register" 
            name="email_address" 
            class="auth-input @error('email_address') auth-input-error @enderror" 
            value="{{ old('email_address') }}"
            placeholder="votre@email.com"
            required
            autocomplete="email"
          >
          @error('email_address')
            <span class="auth-error">{{ $message }}</span>
          @enderror
        </div>

        <div class="auth-form-group">
          <label for="password_register" class="auth-label">Mot de passe</label>
          <input 
            type="password" 
            id="password_register" 
            name="password" 
            class="auth-input @error('password') auth-input-error @enderror" 
            placeholder="••••••••"
            required
            autocomplete="new-password"
          >
          @error('password')
            <span class="auth-error">{{ $message }}</span>
          @enderror
        </div>

        <div class="auth-form-group">
          <label for="password_confirmation" class="auth-label">Confirmer le mot de passe</label>
          <input 
            type="password" 
            id="password_confirmation" 
            name="password_confirmation" 
            class="auth-input @error('password_confirmation') auth-input-error @enderror" 
            placeholder="••••••••"
            required
            autocomplete="new-password"
          >
          @error('password_confirmation')
            <span class="auth-error">{{ $message }}</span>
          @enderror
        </div>

        <button type="submit" class="auth-submit-btn {{ $role === 'nexus' ? 'nexus-submit' : '' }}" id="authSubmitBtn">
          <span class="auth-submit-text">
            @if($role === 'nexus')
              Rejoindre NEXUS
            @elseif($role === 'freelance')
              Continuer
            @else
              Créer mon compte
            @endif
          </span>
          <span class="auth-submit-loader" style="display: none;">
            <svg class="auth-spinner" width="20" height="20" viewBox="0 0 24 24">
              <circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4" fill="none" opacity="0.25"/>
              <path fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"/>
            </svg>
          </span>
        </button>
      </form>
    @endif

    {{-- Liens secondaires --}}
    <div class="auth-footer">
      @if($mode === 'login')
        <p class="auth-footer-text">
          Vous n'avez pas de compte ? 
          <a href="{{ route('user.signup') }}?role={{ $role }}" class="auth-footer-link">Inscrivez-vous</a>
        </p>
      @else
        <p class="auth-footer-text">
          Vous avez déjà un compte ? 
          <a href="{{ route('user.login') }}?role={{ $role }}" class="auth-footer-link">Connectez-vous</a>
        </p>
      @endif

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

