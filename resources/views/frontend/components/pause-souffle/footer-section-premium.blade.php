{{-- ============================================
     COMPOSANT 2: Footer Section Premium
     Section "Démarrer" — À propos, Pause Souffle, Comment on estime les tarifs, Baromètre
     ============================================ --}}
<div class="footer-column">
  <h5 class="footer-title">{{ __('Démarrer') }}</h5>
  <ul class="footer-links-list">
    <li><a href="{{ route('aboutus') }}">{{ __('À propos de Junspro') }}</a></li>
    <li><a href="{{ route('presence.pause-souffle') }}">{{ __('Pause Souffle') }}</a></li>
    <li>
      <a href="{{ route('comment_on_estime_les_tarifs') }}">{{ __('Comment on estime les tarifs') }}</a>
      <span class="footer-micro-desc">{{ __('Baromètre en temps réel & méthode') }}</span>
    </li>
    <li><a href="{{ route('freelance.onboarding.start') }}">{{ __('Devenir un freelance') }}</a></li>
    <li><a href="{{ route('nexus.become-member') }}">{{ __('Devenir Membre NEXUS') }}</a></li>
  </ul>
</div>
