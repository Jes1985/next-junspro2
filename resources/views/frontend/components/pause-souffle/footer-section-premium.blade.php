{{-- ============================================
     COMPOSANT 2: Footer Section Premium
     Section "Démarrer" avec lien Pause Souffle
     Si section existe déjà : ajouter juste le lien
     Si section n'existe pas : créer la colonne complète
     ============================================ --}}
<div class="footer-column">
  <h5 class="footer-title">{{ __('Démarrer') }}</h5>
  <ul class="footer-links-list">
    <li><a href="{{ route('presence.pause-souffle') }}">{{ __('Pause Souffle') }}</a></li>
  </ul>
</div>
