@extends('frontend.freelance.layouts.app')

@section('content')
  <div style="max-width: 1200px; margin: 0 auto; padding: 2rem 1rem;">
    <div style="margin-bottom: 2rem;">
      <h1 style="font-size: 2rem; font-weight: 700; margin-bottom: 0.5rem;">Vidéo de présentation</h1>
      <p style="color: #6b7280; font-size: 1rem;">Ajoutez ou modifiez votre vidéo de présentation pour votre profil public.</p>
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
      <form method="POST" action="{{ route('freelance.settings.video.update') }}">
        @csrf

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
            value="{{ old('video_url', $freelancerProfile->video_url ?? '') }}"
            placeholder="https://www.youtube.com/watch?v=..."
            style="width: 100%; padding: 0.75rem 1rem; border: 2px solid #e5e7eb; border-radius: 8px; font-size: 1rem; transition: border-color 0.2s;"
            class="@error('video_url') border-red-500 @enderror"
          >
          @error('video_url')
            <p style="color: #ef4444; font-size: 0.875rem; margin-top: 0.5rem;">{{ $message }}</p>
          @enderror
        </div>

        @if($freelancerProfile->video_url)
          <div style="margin-bottom: 2rem; padding: 1rem; background: #f9fafb; border-radius: 8px;">
            <p style="font-weight: 600; margin-bottom: 0.5rem; color: #111827;">Vidéo actuelle :</p>
            <p style="color: #6b7280; font-size: 0.875rem; word-break: break-all;">{{ $freelancerProfile->video_url }}</p>
          </div>
        @endif

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
      <h3 style="font-weight: 600; margin-bottom: 0.5rem; color: #1e40af;">💡 Conseils</h3>
      <ul style="color: #1e3a8a; margin: 0; padding-left: 1.5rem; line-height: 1.8;">
        <li>Pour YouTube : copiez l'URL complète de la vidéo (ex: https://www.youtube.com/watch?v=...)</li>
        <li>Pour Vimeo : copiez l'URL complète de la vidéo (ex: https://vimeo.com/...)</li>
        <li>Les URLs courtes (youtu.be) sont également acceptées</li>
        <li>La vidéo sera visible sur votre profil public</li>
      </ul>
    </div>
  </div>
@endsection








