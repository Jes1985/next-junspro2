@extends('frontend.freelance.layouts.app')

@section('content')
  <div style="max-width: 1200px; margin: 0 auto; padding: 2rem 1rem;">
    <div style="margin-bottom: 2rem;">
      <h1 style="font-size: 2rem; font-weight: 700; margin-bottom: 0.5rem; color: #dc2626;">Fermer le compte</h1>
      <p style="color: #6b7280; font-size: 1rem;">Désactiver ou supprimer votre compte freelance.</p>
    </div>

    @if(session('error'))
      <div style="background: #fee2e2; border: 1px solid #ef4444; color: #991b1b; padding: 1rem; border-radius: 8px; margin-bottom: 2rem;">
        {{ session('error') }}
      </div>
    @endif

    <!-- Avertissement -->
    <div style="background: #fef2f2; border: 2px solid #dc2626; border-radius: 16px; padding: 2rem; margin-bottom: 2rem;">
      <div style="display: flex; align-items: start; gap: 1rem;">
        <div style="flex-shrink: 0; width: 48px; height: 48px; background: #dc2626; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; font-size: 1.5rem;">
          ⚠️
        </div>
        <div>
          <h3 style="font-size: 1.25rem; font-weight: 700; color: #991b1b; margin: 0 0 0.5rem 0;">Attention</h3>
          <p style="color: #991b1b; margin: 0; line-height: 1.6;">La fermeture de votre compte est définitive. Toutes vos données seront supprimées et vous ne pourrez plus les récupérer.</p>
        </div>
      </div>
    </div>

    <!-- Option 1: Désactivation temporaire -->
    <div style="background: white; border-radius: 16px; padding: 2rem; box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1); margin-bottom: 2rem;">
      <h3 style="font-size: 1.25rem; font-weight: 600; color: #111827; margin-bottom: 1rem;">Désactivation temporaire</h3>
      <p style="color: #6b7280; margin-bottom: 1.5rem; line-height: 1.6;">Mettez votre compte en pause sans perdre vos données. Vous pourrez le réactiver à tout moment.</p>
      
      <div style="background: #f9fafb; border-radius: 8px; padding: 1.5rem; margin-bottom: 1.5rem;">
        <h4 style="font-weight: 600; color: #111827; margin: 0 0 0.75rem 0;">Ce qui se passe :</h4>
        <ul style="color: #6b7280; margin: 0; padding-left: 1.5rem; line-height: 1.8;">
          <li>Votre profil devient invisible pour les clients</li>
          <li>Vous ne recevrez plus de nouvelles demandes</li>
          <li>Vos données restent sauvegardées</li>
          <li>Réactivation possible à tout moment</li>
        </ul>
      </div>

      <button 
        onclick="if(confirm('Êtes-vous sûr de vouloir désactiver temporairement votre compte ?')) { alert('Fonctionnalité en cours de développement'); }"
        style="background: #f59e0b; color: white; padding: 0.75rem 2rem; border: none; border-radius: 8px; font-weight: 600; font-size: 1rem; cursor: pointer; transition: transform 0.2s, box-shadow 0.2s;"
        onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 4px 12px rgba(245, 158, 11, 0.3)';"
        onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none';"
      >
        Désactiver temporairement
      </button>
    </div>

    <!-- Option 2: Suppression définitive -->
    <div style="background: white; border: 2px solid #dc2626; border-radius: 16px; padding: 2rem; box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);">
      <h3 style="font-size: 1.25rem; font-weight: 600; color: #dc2626; margin-bottom: 1rem;">Suppression définitive</h3>
      <p style="color: #6b7280; margin-bottom: 1.5rem; line-height: 1.6;">Supprimez définitivement votre compte et toutes vos données. Cette action est irréversible.</p>
      
      <div style="background: #fef2f2; border-radius: 8px; padding: 1.5rem; margin-bottom: 1.5rem;">
        <h4 style="font-weight: 600; color: #991b1b; margin: 0 0 0.75rem 0;">Ce qui sera supprimé :</h4>
        <ul style="color: #991b1b; margin: 0; padding-left: 1.5rem; line-height: 1.8;">
          <li>Votre profil freelance complet</li>
          <li>Votre historique de missions</li>
          <li>Vos conversations et messages</li>
          <li>Vos coordonnées bancaires</li>
          <li>Toutes vos données personnelles</li>
        </ul>
      </div>

      <div style="background: #fffbeb; border: 1px solid #f59e0b; border-radius: 8px; padding: 1rem; margin-bottom: 1.5rem;">
        <p style="color: #92400e; margin: 0; font-weight: 500;">⏳ Action réversible 14 jours (si possible), sinon demander confirmation.</p>
      </div>

      <form method="POST" action="#" onsubmit="return confirm('ATTENTION : Cette action est DÉFINITIVE.\n\nTapez SUPPRIMER dans le champ ci-dessous pour confirmer.')">
        @csrf
        <div style="margin-bottom: 1.5rem;">
          <label for="confirmation" style="display: block; font-weight: 600; margin-bottom: 0.5rem; color: #991b1b;">
            Pour confirmer, tapez "SUPPRIMER" ci-dessous :
          </label>
          <input 
            type="text" 
            id="confirmation" 
            name="confirmation" 
            placeholder="SUPPRIMER"
            style="width: 100%; padding: 0.75rem 1rem; border: 2px solid #dc2626; border-radius: 8px; font-size: 1rem; transition: border-color 0.2s;"
            required
          >
        </div>

        <button 
          type="submit"
          style="background: #dc2626; color: white; padding: 0.75rem 2rem; border: none; border-radius: 8px; font-weight: 600; font-size: 1rem; cursor: pointer; transition: transform 0.2s, box-shadow 0.2s;"
          onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 4px 12px rgba(220, 38, 38, 0.3)';"
          onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none';"
        >
          Supprimer définitivement mon compte
        </button>
      </form>
    </div>

    <div style="margin-top: 2rem; text-align: center;">
      <a 
        href="{{ route('freelance.dashboard', ['tab' => 'settings']) }}" 
        style="color: #6b7280; text-decoration: none; font-weight: 500; padding: 0.75rem 1.5rem; border-radius: 8px; transition: background-color 0.2s; display: inline-block;"
        onmouseover="this.style.backgroundColor='#f3f4f6';"
        onmouseout="this.style.backgroundColor='transparent';"
      >
        ← Retour aux paramètres
      </a>
    </div>
  </div>
@endsection

