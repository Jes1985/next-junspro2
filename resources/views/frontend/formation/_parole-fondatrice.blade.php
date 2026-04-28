{{--
  _parole-fondatrice.blade.php
  Bloc d'introduction — affiché en haut de chaque module.
  Verset FR + EN simultanés, explication FR + EN.

  Variables attendues :
    $module  — FormationModule (slug requis)
--}}
@php
  $pf = config('parole_fondatrice.' . $module->slug);
@endphp

@if($pf)
<div class="pf-block">
  <div class="pf-block__header">
    <span class="pf-block__icon" aria-hidden="true">✦</span>
    <span class="pf-block__label">Parole fondatrice &nbsp;·&nbsp; Founding Word</span>
  </div>

  {{-- Verset français --}}
  <blockquote class="pf-block__verse">{{ $pf['verse_fr'] }}</blockquote>
  {{-- Verset anglais --}}
  <blockquote class="pf-block__verse-en">{{ $pf['verse_en'] ?? $pf['verse_fr'] }}</blockquote>

  {{-- Référence --}}
  <p class="pf-block__ref">— {{ $pf['ref'] }}{{ isset($pf['ref_en']) && $pf['ref_en'] !== $pf['ref'] ? ' · ' . $pf['ref_en'] : '' }}</p>

  {{-- Explication française --}}
  <p class="pf-block__insight">{{ $pf['insight_fr'] }}</p>
  {{-- Explication anglaise --}}
  @if(!empty($pf['insight_en']))
  <p class="pf-block__insight-en">{{ $pf['insight_en'] }}</p>
  @endif
</div>
@endif
