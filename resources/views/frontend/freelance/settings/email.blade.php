@extends('frontend.freelance.layouts.app')

@section('content')
  <div style="max-width: 1200px; margin: 0 auto; padding: 2rem 1rem;">
    <div style="margin-bottom: 2rem;">
      <h1 style="font-size: 2rem; font-weight: 700; margin-bottom: 0.5rem;">Adresse e-mail</h1>
      <p style="color: #6b7280; font-size: 1rem;">E-mail de connexion et notifications.</p>
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
      <div style="margin-bottom: 2rem; padding: 1rem; background: #f9fafb; border-radius: 8px;">
        <p style="font-weight: 600; margin-bottom: 0.5rem; color: #111827;">Adresse e-mail actuelle :</p>
        <p style="color: #6b7280; font-size: 1rem;">{{ $user->email_address ?? '' }}</p>
      </div>

      <form method="POST" action="{{ route('user.settings.email.update') }}">
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
          <label for="email_address" style="display: block; font-weight: 600; margin-bottom: 0.5rem; color: #111827;">
            Nouvelle adresse e-mail
          </label>
          <input 
            type="email" 
            id="email_address" 
            name="email_address" 
            value="{{ old('email_address') }}"
            placeholder="nouvelle@email.com"
            style="width: 100%; padding: 0.75rem 1rem; border: 2px solid #e5e7eb; border-radius: 8px; font-size: 1rem; transition: border-color 0.2s;"
            class="@error('email_address') border-red-500 @enderror"
            required
          >
          @error('email_address')
            <p style="color: #ef4444; font-size: 0.875rem; margin-top: 0.5rem;">{{ $message }}</p>
          @enderror
        </div>

        <div style="margin-bottom: 2rem;">
          <label for="email_confirmation" style="display: block; font-weight: 600; margin-bottom: 0.5rem; color: #111827;">
            Confirmer la nouvelle adresse e-mail
          </label>
          <input 
            type="email" 
            id="email_confirmation" 
            name="email_confirmation" 
            value="{{ old('email_confirmation') }}"
            placeholder="nouvelle@email.com"
            style="width: 100%; padding: 0.75rem 1rem; border: 2px solid #e5e7eb; border-radius: 8px; font-size: 1rem; transition: border-color 0.2s;"
            class="@error('email_confirmation') border-red-500 @enderror"
            required
          >
          @error('email_confirmation')
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
            Mettre à jour mon e-mail
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

    <div style="margin-top: 2rem; padding: 1.5rem; background: #fef9c3; border-left: 4px solid #eab308; border-radius: 8px;">
      <h3 style="font-weight: 600; margin-bottom: 0.5rem; color: #854d0e;">⚠️ Important</h3>
      <p style="color: #713f12; margin: 0; line-height: 1.8;">Cette adresse e-mail sera utilisée pour vous connecter et recevoir toutes les notifications importantes.</p>
    </div>
  </div>
@endsection

