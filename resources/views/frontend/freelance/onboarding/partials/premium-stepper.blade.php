@php
  $routeStep = (int)($routeStep ?? 1);
  $config = config('onboarding_steps', []);
  $logicGroups = (array)($config['logic_groups'] ?? []);
  ksort($logicGroups);

  $routeToLogic = [];
  foreach ($logicGroups as $logic => $group) {
    foreach ((array)($group['route_steps'] ?? []) as $step) {
      $routeToLogic[(int)$step] = (int)$logic;
    }
  }

  $logicStep = $routeToLogic[$routeStep] ?? 1;
  $logicLabels = [];
  foreach ($logicGroups as $logic => $group) {
    $logicLabels[(int)$logic] = $group['label'] ?? ('Étape ' . $logic);
  }

  $substep = null;
  foreach ($logicGroups as $logic => $group) {
    $steps = array_values((array)($group['route_steps'] ?? []));
    $index = array_search($routeStep, $steps, true);
    if ($index !== false && count($steps) > 1) {
      $substep = ($index + 1) . '/' . count($steps);
      break;
    }
  }
@endphp

@once
<style>
  .onboarding-super-stepper {
    background: #fff;
    border-radius: 16px;
    padding: 1rem 1.1rem;
    margin-bottom: 1.25rem;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
    border: 1px solid #f3f4f6;
  }
  .onboarding-super-row {
    display: grid;
    grid-template-columns: repeat(5, minmax(0, 1fr));
    gap: 0.5rem;
    align-items: center;
  }
  .onboarding-super-item {
    display: flex;
    align-items: center;
    gap: 0.45rem;
    min-width: 0;
  }
  .onboarding-super-dot {
    width: 30px;
    height: 30px;
    border-radius: 999px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    font-size: 0.78rem;
    font-weight: 700;
    flex: 0 0 30px;
    color: #6b7280;
    background: #e5e7eb;
  }
  .onboarding-super-item.is-done .onboarding-super-dot,
  .onboarding-super-item.is-active .onboarding-super-dot {
    color: #fff;
    background: linear-gradient(135deg, #1e40af 0%, #7c3aed 100%);
  }
  .onboarding-super-label {
    font-size: 0.78rem;
    font-weight: 600;
    color: #6b7280;
    line-height: 1.35;
    white-space: normal;
    overflow: visible;
    text-overflow: clip;
  }
  .onboarding-super-item.is-done .onboarding-super-label,
  .onboarding-super-item.is-active .onboarding-super-label {
    color: #4c1d95;
  }
  .onboarding-super-meta {
    margin-top: 0.7rem;
    font-size: 0.8rem;
    color: #6b7280;
    display: flex;
    justify-content: space-between;
    gap: 0.5rem;
  }
  @media (max-width: 900px) {
    .onboarding-super-row {
      grid-template-columns: 1fr;
      gap: 0.45rem;
    }
    .onboarding-super-meta {
      flex-direction: column;
      align-items: flex-start;
    }
  }
</style>
@endonce

<div class="onboarding-super-stepper" aria-label="Progression onboarding premium">
  <div class="onboarding-super-row">
    @foreach($logicLabels as $step => $label)
      <div class="onboarding-super-item {{ $step < $logicStep ? 'is-done' : ($step === $logicStep ? 'is-active' : '') }}">
        <span class="onboarding-super-dot">{{ $step < $logicStep ? '✓' : $step }}</span>
        <span class="onboarding-super-label">{{ $label }}</span>
      </div>
    @endforeach
  </div>
  <div class="onboarding-super-meta">
    <span>Votre profil se construit étape par étape. Tout est sauvegardé automatiquement.</span>
  </div>
</div>

