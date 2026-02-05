@extends('frontend.layout')

@section('pageHeading')
  @if (!empty($pageHeading))
    {{ $pageHeading->signup_page_title }}
  @endif
@endsection

@section('metaKeywords')
  @if (!empty($seoInfo))
    {{ $seoInfo->meta_keyword_customer_signup }}
  @endif
@endsection

@section('metaDescription')
  @if (!empty($seoInfo))
    {{ $seoInfo->meta_description_customer_signup }}
  @endif
@endsection
@php
  $title = $pageHeading->signup_page_title ?? __('No Page Title Found');
@endphp
@section('content')
  @includeIf('frontend.partials.breadcrumb', ['breadcrumb' => $breadcrumb, 'title' => $title])

  <!--====== Start Signup Area Section ======-->
  <div class="user-area-section ptb-100">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-8">
          <div class="user-form">
            <form action="{{ route('user.signup_submit') }}" method="POST">
              @csrf
              <div class="form-group mb-4">
                <label>{{ __('Username') . '*' }}</label>
                <input type="text" class="form-control" name="username" value="{{ old('username') }}">
                @error('username')
                  <p class="text-danger mt-1">{{ $message }}</p>
                @enderror
              </div>

              <div class="form-group mb-4">
                <label>{{ __('Email Address') . '*' }}</label>
                <input type="email" class="form-control" name="email_address" value="{{ old('email_address') }}">
                @error('email_address')
                  <p class="text-danger mt-1">{{ $message }}</p>
                @enderror
              </div>

              <div class="form-group mb-4">
                <label>{{ __('Password') . '*' }}</label>
                <input type="password" class="form-control" name="password" value="{{ old('password') }}">
                @error('password')
                  <p class="text-danger mt-1">{{ $message }}</p>
                @enderror
              </div>

              <div class="form-group mb-4">
                <label>{{ __('Confirm Password') . '*' }}</label>
                <input type="password" class="form-control" name="password_confirmation"
                  value="{{ old('password_confirmation') }}">
                @error('password_confirmation')
                  <p class="text-danger mt-1">{{ $message }}</p>
                @enderror
              </div>

              @if ($recaptchaStatus == 1)
                <div class="form-group my-4">
                  {!! NoCaptcha::renderJs() !!}
                  {!! NoCaptcha::display() !!}

                  @error('g-recaptcha-response')
                    <p class="text-danger mt-1">{{ $message }}</p>
                  @enderror
                </div>
              @endif

              <div class="form-group">
                <button type="submit" class="btn btn-lg btn-primary radius-sm">{{ __('Signup') }}</button>
              </div>
              <p class="mt-3">{{ __('Already have an account') . '?' }} <a
                  href="{{ route('user.login') }}">{{ __('Login Now') }}</a></p>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!--====== End Signup Area Section ======-->
@endsection

@section('script')
<script>
  (function() {
    'use strict';
    
    const storageKey = 'signup_form_data';
    const form = document.querySelector('form[action="{{ route('user.signup_submit') }}"]');
    
    if (!form) return;
    
    // Restaurer les valeurs sauvegardées
    const savedData = localStorage.getItem(storageKey);
    if (savedData) {
      try {
        const data = JSON.parse(savedData);
        const usernameInput = form.querySelector('[name="username"]');
        const emailInput = form.querySelector('[name="email_address"]');
        
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
      const input = form.querySelector(`[name="${fieldName}"]`);
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
    
    // Nettoyer localStorage après soumission réussie
    form.addEventListener('submit', function() {
      // Le localStorage sera nettoyé côté serveur si succès
      // Sinon les valeurs restent pour restauration en cas d'erreur
    });
    
    // Nettoyer localStorage si on arrive sur une page de succès (onboarding step1)
    if (window.location.pathname.includes('/freelance/onboarding/step-1')) {
      localStorage.removeItem(storageKey);
    }
  })();
</script>
@endsection
