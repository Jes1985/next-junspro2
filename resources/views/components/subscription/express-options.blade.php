@props([
  'variant' => 'toggle', // toggle | cards — style d'affichage
  'showMicroLine' => false, // afficher "Express sélectionné : +X%" ou "Standard"
])

@php
  // On accepte une valeur unique (legacy) ou un tableau (nouveau multi-choix).
  $expressRaw = request()->input('express', []);
  $expressRaw = is_array($expressRaw) ? $expressRaw : explode(',', (string)$expressRaw);
  $allowedExpress = ['24', '48', '72'];
  $expressSelected = [];
  foreach ($expressRaw as $val) {
    $val = (string)$val;
    if (in_array($val, $allowedExpress, true) && !in_array($val, $expressSelected, true)) {
      $expressSelected[] = $val;
    }
  }

  // Valeur de repli pour compatibilité (estimation prix et code existant) : on prend le supplément le plus élevé sélectionné.
  $expressVal = 'none';
  if (in_array('24', $expressSelected, true)) {
    $expressVal = '24';
  } elseif (in_array('48', $expressSelected, true)) {
    $expressVal = '48';
  } elseif (in_array('72', $expressSelected, true)) {
    $expressVal = '72';
  }

  $percentMap = ['none' => 0, '24' => 30, '48' => 20, '72' => 10];
  $microText = empty($expressSelected)
    ? 'Standard : aucun supplément'
    : 'Options Express sélectionnées : ' . implode(', ', array_map(function ($v) use ($percentMap) {
        return $v . 'h (+' . ($percentMap[$v] ?? 0) . '%)';
      }, $expressSelected)) . ' — supplément max : +' . ($percentMap[$expressVal] ?? 0) . '%';
@endphp

{{-- Composant Express multi-sélection — data-express: none|24|48|72 — %: none=0, 24=30, 48=20, 72=10 --}}
<div class="junspro-express-options" data-express-options data-initial="{{ $expressVal }}">
  @if($variant === 'toggle')
  <div class="express-options-toggle" style="display: flex; align-items: center; gap: 8px; margin-top: 10px; font-size: 11px; color: #6B7280;">
    <span class="express-options-label" style="font-weight: 500;">Express :</span>
    <div class="express-options-buttons" style="display: inline-flex; flex-wrap: wrap; gap: 6px; align-items: center; border: 1px solid #E5E7EB; border-radius: 8px; padding: 2px; background: #F9FAFB;">
      <button type="button" class="express-option-card {{ empty($expressSelected) ? 'is-selected' : '' }}" data-express="none" data-express-none aria-pressed="{{ empty($expressSelected) ? 'true' : 'false' }}">Aucun</button>
      <button type="button" class="express-option-card {{ in_array('72', $expressSelected, true) ? 'is-selected' : '' }}" data-express="72" data-express-option aria-pressed="{{ in_array('72', $expressSelected, true) ? 'true' : 'false' }}">72h (+10%)</button>
      <input type="checkbox" name="express[]" value="72" data-express-checkbox style="display:none;" {{ in_array('72', $expressSelected, true) ? 'checked' : '' }}>
      <button type="button" class="express-option-card {{ in_array('48', $expressSelected, true) ? 'is-selected' : '' }}" data-express="48" data-express-option aria-pressed="{{ in_array('48', $expressSelected, true) ? 'true' : 'false' }}">48h (+20%)</button>
      <input type="checkbox" name="express[]" value="48" data-express-checkbox style="display:none;" {{ in_array('48', $expressSelected, true) ? 'checked' : '' }}>
      <button type="button" class="express-option-card {{ in_array('24', $expressSelected, true) ? 'is-selected' : '' }}" data-express="24" data-express-option aria-pressed="{{ in_array('24', $expressSelected, true) ? 'true' : 'false' }}">24h (+30%)</button>
      <input type="checkbox" name="express[]" value="24" data-express-checkbox style="display:none;" {{ in_array('24', $expressSelected, true) ? 'checked' : '' }}>
    </div>
  </div>
  @else
  <div class="express-options-cards" style="display: flex; flex-wrap: wrap; gap: 8px; align-items: center; margin-top: 10px;">
    <button type="button" class="express-option-card {{ empty($expressSelected) ? 'is-selected' : '' }}" data-express="none" data-express-none aria-pressed="{{ empty($expressSelected) ? 'true' : 'false' }}">Aucun</button>
    <button type="button" class="express-option-card {{ in_array('72', $expressSelected, true) ? 'is-selected' : '' }}" data-express="72" data-express-option aria-pressed="{{ in_array('72', $expressSelected, true) ? 'true' : 'false' }}">72h (+10%)</button>
    <input type="checkbox" name="express[]" value="72" data-express-checkbox style="display:none;" {{ in_array('72', $expressSelected, true) ? 'checked' : '' }}>
    <button type="button" class="express-option-card {{ in_array('48', $expressSelected, true) ? 'is-selected' : '' }}" data-express="48" data-express-option aria-pressed="{{ in_array('48', $expressSelected, true) ? 'true' : 'false' }}">48h (+20%)</button>
    <input type="checkbox" name="express[]" value="48" data-express-checkbox style="display:none;" {{ in_array('48', $expressSelected, true) ? 'checked' : '' }}>
    <button type="button" class="express-option-card {{ in_array('24', $expressSelected, true) ? 'is-selected' : '' }}" data-express="24" data-express-option aria-pressed="{{ in_array('24', $expressSelected, true) ? 'true' : 'false' }}">24h (+30%)</button>
    <input type="checkbox" name="express[]" value="24" data-express-checkbox style="display:none;" {{ in_array('24', $expressSelected, true) ? 'checked' : '' }}>
  </div>
  @endif
  @if($showMicroLine)
  <div class="express-options-micro" data-express-micro style="font-size: 10px; color: #6B7280; margin-top: 6px;">{{ $microText }}</div>
  @endif
  {{-- Champ legacy pour compatibilité (utilisé pour les estimations prix) --}}
  <input type="hidden" name="express" data-express-input value="{{ $expressVal }}">
  <div class="express-options-tags" data-express-tags style="display:none; margin-top: 6px; gap: 6px; flex-wrap: wrap;"></div>
</div>
