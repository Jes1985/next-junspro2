@props([
  'variant' => 'toggle', // toggle | cards — style d'affichage
  'showMicroLine' => false, // afficher "Express sélectionné : +X%" ou "Standard"
])

@php
  $expressVal = request('express', 'none');
  $expressVal = in_array($expressVal, ['24', '48', '72', 'none']) ? $expressVal : 'none';
  $percentMap = ['none' => 0, '24' => 30, '48' => 20, '72' => 10];
@endphp

{{-- Composant Express unique — data-express: none|24|48|72 — %: none=0, 24=30, 48=20, 72=10 --}}
<div class="junspro-express-options" data-express-options data-initial="{{ $expressVal }}">
  @if($variant === 'toggle')
  <div class="express-options-toggle" style="display: flex; align-items: center; gap: 8px; margin-top: 10px; font-size: 11px; color: #6B7280;">
    <span class="express-options-label" style="font-weight: 500;">Express :</span>
    <div class="express-options-buttons" style="display: inline-flex; flex-wrap: wrap; gap: 6px; align-items: center; border: 1px solid #E5E7EB; border-radius: 8px; padding: 2px; background: #F9FAFB;">
      <button type="button" class="express-option-card {{ $expressVal === 'none' ? 'is-selected' : '' }}" data-express="none" aria-pressed="{{ $expressVal === 'none' ? 'true' : 'false' }}">Aucun</button>
      <button type="button" class="express-option-card {{ $expressVal === '72' ? 'is-selected' : '' }}" data-express="72" aria-pressed="{{ $expressVal === '72' ? 'true' : 'false' }}">72h (+10%)</button>
      <button type="button" class="express-option-card {{ $expressVal === '48' ? 'is-selected' : '' }}" data-express="48" aria-pressed="{{ $expressVal === '48' ? 'true' : 'false' }}">48h (+20%)</button>
      <button type="button" class="express-option-card {{ $expressVal === '24' ? 'is-selected' : '' }}" data-express="24" aria-pressed="{{ $expressVal === '24' ? 'true' : 'false' }}">24h (+30%)</button>
    </div>
  </div>
  @else
  <div class="express-options-cards" style="display: flex; flex-wrap: wrap; gap: 8px; align-items: center; margin-top: 10px;">
    <button type="button" class="express-option-card {{ $expressVal === 'none' ? 'is-selected' : '' }}" data-express="none" aria-pressed="{{ $expressVal === 'none' ? 'true' : 'false' }}">Aucun</button>
    <button type="button" class="express-option-card {{ $expressVal === '72' ? 'is-selected' : '' }}" data-express="72" aria-pressed="{{ $expressVal === '72' ? 'true' : 'false' }}">72h (+10%)</button>
    <button type="button" class="express-option-card {{ $expressVal === '48' ? 'is-selected' : '' }}" data-express="48" aria-pressed="{{ $expressVal === '48' ? 'true' : 'false' }}">48h (+20%)</button>
    <button type="button" class="express-option-card {{ $expressVal === '24' ? 'is-selected' : '' }}" data-express="24" aria-pressed="{{ $expressVal === '24' ? 'true' : 'false' }}">24h (+30%)</button>
  </div>
  @endif
  @if($showMicroLine)
  <div class="express-options-micro" data-express-micro style="font-size: 10px; color: #6B7280; margin-top: 6px;">{{ $expressVal === 'none' ? 'Standard : aucun supplément' : 'Supplément Express appliqué : +' . ($percentMap[$expressVal] ?? 0) . '%' }}</div>
  @endif
  <input type="hidden" name="express" data-express-input value="{{ $expressVal }}">
</div>
