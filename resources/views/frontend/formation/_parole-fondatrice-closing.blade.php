{{--
  _parole-fondatrice-closing.blade.php
  Écho de clôture — affiché en bas de chaque module, avant le bouton "Terminer".
  Verset FR + EN, sans explication — espace contemplatif.

  Variables attendues :
    $module  — FormationModule (slug requis)
--}}
@php
  $pf = config('parole_fondatrice.' . $module->slug);
@endphp

@if($pf)
<div class="pf-closing">
  <span class="pf-closing__symbol">✦ &nbsp; ✦ &nbsp; ✦</span>

  {{-- Verset français --}}
  <blockquote class="pf-closing__verse">{{ $pf['verse_fr'] }}</blockquote>
  {{-- Verset anglais --}}
  <blockquote class="pf-closing__verse-en">{{ $pf['verse_en'] ?? $pf['verse_fr'] }}</blockquote>

  {{-- Référence --}}
  <p class="pf-closing__ref">— {{ $pf['ref'] }}{{ isset($pf['ref_en']) && $pf['ref_en'] !== $pf['ref'] ? ' · ' . $pf['ref_en'] : '' }}</p>
</div>
@endif
