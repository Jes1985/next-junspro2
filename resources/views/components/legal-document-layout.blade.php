@props([
  'title' => '',
  'updatedAt' => '13/02/2026',
  'toc' => [],
  'prefix' => 'legal',
])
@php
  $btnId = $prefix . '-sommaire-btn';
  $dropdownId = $prefix . '-sommaire-dropdown';
  $backToTopId = $prefix . '-back-to-top';
@endphp
<div class="legal-page-wrapper">
  <div class="terms-page-inner">
    <aside class="terms-sommaire-sidebar">
      <div class="terms-sommaire-title">{{ __('Sommaire') }}</div>
      <ul class="terms-sommaire-list">
        @foreach ($toc as $item)
          <li><a href="{{ $item['href'] }}">{{ $item['label'] }}</a></li>
        @endforeach
      </ul>
    </aside>

    <main class="terms-page-main">
      <div class="legal-page-header">
        <h1 class="legal-page-title">{{ $title }}</h1>
        <p class="legal-page-subtitle">
          {{ __('Document officiel') }} • {{ __('Dernière mise à jour') }} : {{ $updatedAt }}
        </p>
      </div>

      <div class="terms-sommaire-mobile">
        <button type="button" class="terms-sommaire-toggle" aria-expanded="false" aria-controls="{{ $dropdownId }}" id="{{ $btnId }}">
          {{ __('Sommaire') }}
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M6 9l6 6 6-6"/></svg>
        </button>
        <div class="terms-sommaire-dropdown" id="{{ $dropdownId }}" hidden>
          @foreach ($toc as $item)
            <a href="{{ $item['href'] }}">{{ $item['label'] }}</a>
          @endforeach
        </div>
      </div>

      <div class="legal-page-content summernote-content">
        <div class="terms-doc-body">
          {{ $slot }}
        </div>
      </div>

      <div class="legal-page-footer">
        <a href="{{ route('index') }}" class="legal-page-back-link">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M19 12H5M12 19l-7-7 7-7"/>
          </svg>
          {{ __('Retour à l\'accueil') }}
        </a>
        <a href="#" class="terms-back-to-top" id="{{ $backToTopId }}">{{ __('Retour en haut') }}</a>
      </div>
    </main>
  </div>
</div>

<script>
(function() {
  var prefix = '{{ $prefix }}';
  var btn = document.getElementById(prefix + '-sommaire-btn');
  var dropdown = document.getElementById(prefix + '-sommaire-dropdown');
  if (btn && dropdown) {
    btn.addEventListener('click', function(e) {
      e.stopPropagation();
      var expanded = btn.getAttribute('aria-expanded') === 'true';
      btn.setAttribute('aria-expanded', !expanded);
      dropdown.hidden = expanded;
    });
    document.addEventListener('click', function(e) {
      if (!btn.contains(e.target) && !dropdown.contains(e.target)) {
        btn.setAttribute('aria-expanded', 'false');
        dropdown.hidden = true;
      }
    });
    var links = dropdown.querySelectorAll('a');
    for (var i = 0; i < links.length; i++) {
      links[i].addEventListener('click', function() {
        btn.setAttribute('aria-expanded', 'false');
        dropdown.hidden = true;
      });
    }
  }
  var backToTop = document.getElementById(prefix + '-back-to-top');
  if (backToTop) {
    backToTop.addEventListener('click', function(e) {
      e.preventDefault();
      window.scrollTo({ top: 0, behavior: 'smooth' });
    });
  }
})();
</script>
