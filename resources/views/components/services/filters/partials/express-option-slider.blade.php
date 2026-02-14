{{-- Options Express (slider) — at-home & wellnesslive — cartes add-on premium --}}
@php
  $expressSliderVal = request('express', 'none');
  $expressSliderVal = in_array($expressSliderVal, ['24', '48', '72', 'none']) ? $expressSliderVal : 'none';
@endphp
<div class="express-slider-module junspro-express-slider" id="expressSliderModule" style="margin-top: 10px;">
  <div class="express-slider-cards" style="display: flex; flex-wrap: wrap; gap: 8px; align-items: center;">
    <button type="button" class="express-slider-card {{ $expressSliderVal === 'none' ? 'is-selected' : '' }}" data-express="none" aria-pressed="{{ $expressSliderVal === 'none' ? 'true' : 'false' }}">Aucun</button>
    <button type="button" class="express-slider-card {{ $expressSliderVal === '72' ? 'is-selected' : '' }}" data-express="72" aria-pressed="{{ $expressSliderVal === '72' ? 'true' : 'false' }}">72h (+10%)</button>
    <button type="button" class="express-slider-card {{ $expressSliderVal === '48' ? 'is-selected' : '' }}" data-express="48" aria-pressed="{{ $expressSliderVal === '48' ? 'true' : 'false' }}">48h (+20%)</button>
    <button type="button" class="express-slider-card {{ $expressSliderVal === '24' ? 'is-selected' : '' }}" data-express="24" aria-pressed="{{ $expressSliderVal === '24' ? 'true' : 'false' }}">24h (+30%)</button>
  </div>
  <div id="rituel-express-micro" class="rituel-express-micro" style="font-size: 10px; color: #6B7280; margin-top: 6px;">{{ $expressSliderVal === 'none' ? 'Standard : aucun supplément' : 'Express sélectionné : +' . (['24'=>30,'48'=>20,'72'=>10][$expressSliderVal] ?? 0) . '% (délais accélérés)' }}</div>
  <input type="hidden" name="express" id="expressSliderInput" value="{{ $expressSliderVal }}">
</div>
