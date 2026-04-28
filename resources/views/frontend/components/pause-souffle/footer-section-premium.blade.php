{{-- ============================================
     COMPOSANT 2: Footer Section Premium
     Section "Démarrer" — À propos, Pause Souffle, Comment on estime les tarifs, Baromètre
     ============================================ --}}
<div class="footer-column">
  <h5 class="footer-title">{{ __('Démarrer') }}</h5>
  <ul class="footer-links-list">
    <li><a href="{{ route('aboutus') }}">{{ __('À propos de Junspro') }}</a></li>
    <li><a href="{{ route('presence.pause-souffle') }}">{{ __('Pause Souffle') }}</a>
      <span class="footer-micro-desc">{{ __('Service phare · Univers Présence') }}</span>
    </li>
    <li>
      <a href="{{ route('comment_on_estime_les_tarifs') }}">{{ __('Comment on estime les tarifs') }}</a>
      <span class="footer-micro-desc">{{ __('Baromètre en temps réel & méthode') }}</span>
    </li>
    <li><a href="{{ route('freelance.onboarding.start') }}">{{ __('Devenir un freelance') }}</a></li>
    <li><a href="{{ route('nexus.become-member') }}">{{ __('Devenir Membre NEXUS') }}</a></li>
    <li>
      <a href="{{ route('affiliate.landing') }}">{{ __('Apporteurs d\'Affaires') }}</a>
      <span class="footer-micro-desc">{{ __('Recommandez Junspro · Percevez jusqu\'à 10 % de commission') }}</span>
    </li>
    <li>      <a href="{{ route('presence.ambassadeurs') }}">{{ __('Réseau des Ambassadeurs PS') }}</a>
      <span class="footer-micro-desc">{{ __('Commissions 10-25 % · Cookie 90 jours · 4 programmes') }}</span>
    </li>
    <li>      <a href="{{ route('presence.parcours') }}">{{ __('Le Parcours Pause Souffle') }}</a>
      <span class="footer-micro-desc">{{ __('6 modules · 8 semaines · Transformation personnelle') }}</span>
    </li>
    <li>
      <a href="{{ route('presence.nos-programmes') }}">{{ __('Tous les programmes &amp; tarifs') }}</a>
      <span class="footer-micro-desc">{{ __('Paiement unique ou 4 cycles · 16 semaines') }}</span>
    </li>
    <li>
      <a href="{{ route('presence.formation-praticien') }}">{{ __('Devenir Freelance Pause Souffle') }}</a>
      <span class="footer-micro-desc">{{ __('Formation certifiante · Pratiquez en professionnel') }}</span>
    </li>
    <li>
      <a href="{{ route('presence.retraite') }}">{{ __('La Retraite Pause Souffle') }}</a>
      <span class="footer-micro-desc">{{ __('7 jours · Méditerranée · Destination surprise · 12 places') }}</span>
    </li>
  </ul>
</div>
