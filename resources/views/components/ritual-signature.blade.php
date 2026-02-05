{{-- Micro-phrase signature Junspro : à afficher partout où un volume (Rituels) est visible --}}
@php
  $signature = app(\App\Services\Junspro\CycleUsageService::class)->ritualSignatureText();
@endphp
<p class="ritual-signature-helper" style="font-size: 0.75rem; color: #6b7280; margin: 0.25rem 0; line-height: 1.4;">{{ $signature }}</p>
