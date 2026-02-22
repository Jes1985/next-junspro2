@extends('frontend.freelance.layouts.app')

@section('content')
  <div style="max-width: 1200px; margin: 0 auto; padding: 2rem 1rem;">
    <div style="margin-bottom: 2rem;">
      <h1 style="font-size: 2rem; font-weight: 700; margin-bottom: 0.5rem;">Sécurité</h1>
      <p style="color: #6b7280; font-size: 1rem;">Mot de passe, connexion, protection du compte.</p>
    </div>

    @if(session('success'))
      <div style="background: #d1fae5; border: 1px solid #10b981; color: #065f46; padding: 1rem; border-radius: 8px; margin-bottom: 2rem;">
        {{ session('success') }}
      </div>
    @endif

    @if(session('error'))
      <div style="background: #fee2e2; border: 1px solid #ef4444; color: #991b1b; padding: 1rem; border-radius: 8px; margin-bottom: 2rem;">
        {{ session('error') }}
      </div>
    @endif

    <div style="background: white; border-radius: 16px; padding: 2rem; box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);">
      <form method="POST" action="{{ route('user.update_password') }}">
        @csrf

        <div style="margin-bottom: 2rem;">
          <label for="current_password" style="display: block; font-weight: 600; margin-bottom: 0.5rem; color: #111827;">
            Mot de passe actuel
          </label>
          <input 
            type="password" 
            id="current_password" 
            name="current_password" 
            placeholder="Entrez votre mot de passe actuel"
            style="width: 100%; padding: 0.75rem 1rem; border: 2px solid #e5e7eb; border-radius: 8px; font-size: 1rem; transition: border-color 0.2s;"
            class="@error('current_password') border-red-500 @enderror"
            required
          >
          @error('current_password')
            <p style="color: #ef4444; font-size: 0.875rem; margin-top: 0.5rem;">{{ $message }}</p>
          @enderror
        </div>

        <div style="margin-bottom: 2rem;">
          <label for="new_password" style="display: block; font-weight: 600; margin-bottom: 0.5rem; color: #111827;">
            Nouveau mot de passe
          </label>
          <input 
            type="password" 
            id="new_password" 
            name="new_password" 
            placeholder="Entrez un nouveau mot de passe"
            style="width: 100%; padding: 0.75rem 1rem; border: 2px solid #e5e7eb; border-radius: 8px; font-size: 1rem; transition: border-color 0.2s;"
            class="@error('new_password') border-red-500 @enderror"
            required
          >
          <p style="color: #6b7280; font-size: 0.875rem; margin-top: 0.5rem;">Le mot de passe doit contenir au moins 6 caractères.</p>
          @error('new_password')
            <p style="color: #ef4444; font-size: 0.875rem; margin-top: 0.5rem;">{{ $message }}</p>
          @enderror
        </div>

        <div style="margin-bottom: 2rem;">
          <label for="new_password_confirmation" style="display: block; font-weight: 600; margin-bottom: 0.5rem; color: #111827;">
            Confirmer le nouveau mot de passe
          </label>
          <input 
            type="password" 
            id="new_password_confirmation" 
            name="new_password_confirmation" 
            placeholder="Confirmez votre nouveau mot de passe"
            style="width: 100%; padding: 0.75rem 1rem; border: 2px solid #e5e7eb; border-radius: 8px; font-size: 1rem; transition: border-color 0.2s;"
            class="@error('new_password_confirmation') border-red-500 @enderror"
            required
          >
          @error('new_password_confirmation')
            <p style="color: #ef4444; font-size: 0.875rem; margin-top: 0.5rem;">{{ $message }}</p>
          @enderror
        </div>

        <div style="display: flex; gap: 1rem; align-items: center;">
          <button 
            type="submit" 
            style="background: linear-gradient(135deg, #4F46E5 0%, #7C3AED 100%); color: white; padding: 0.75rem 2rem; border: none; border-radius: 8px; font-weight: 600; font-size: 1rem; cursor: pointer; transition: transform 0.2s, box-shadow 0.2s;"
            onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 4px 12px rgba(79, 70, 229, 0.3)';"
            onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none';"
          >
            Mettre à jour
          </button>
          <a 
            href="{{ route('freelance.dashboard', ['tab' => 'settings']) }}" 
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
      <h3 style="font-weight: 600; margin-bottom: 0.5rem; color: #1e40af;">🔒 Conseils de sécurité</h3>
      <ul style="color: #1e3a8a; margin: 0; padding-left: 1.5rem; line-height: 1.8;">
        <li>Utilisez un mot de passe unique et complexe</li>
        <li>Ne partagez jamais votre mot de passe</li>
        <li>Changez régulièrement votre mot de passe</li>
      </ul>
    </div>
  </div>
@endsection

