{{-- Partial : Stepper NEXUS Onboarding --}}
{{-- Usage : @include('nexus.onboarding._stepper', ['current' => 1]) --}}

@php
$steps = [
  1 => ['label' => 'Identité',   'icon' => '👤'],
  2 => ['label' => 'Mon Offre',  'icon' => '🏠'],
  3 => ['label' => 'Activation', 'icon' => '🚀'],
];
@endphp

<div class="nx-stepper">
  @foreach($steps as $num => $step)
    @php
      $state = $num < $current ? 'completed' : ($num == $current ? 'active' : 'pending');
    @endphp

    <div class="nx-step {{ $state }}">
      <div class="nx-step-dot">
        @if($state === 'completed')
          <svg width="14" height="14" viewBox="0 0 14 14" fill="none"><path d="M2.5 7l3 3 6-6" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
        @else
          {{ $num }}
        @endif
      </div>
      <div class="nx-step-label d-none d-md-block">{{ $step['label'] }}</div>
    </div>

    @if(!$loop->last)
      <div class="nx-step-sep {{ $num < $current ? 'done' : 'pending' }}"></div>
    @endif
  @endforeach
</div>
