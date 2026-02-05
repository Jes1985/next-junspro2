<!-- Root component pour le flow de changement de formule -->
<div 
  x-data="changePlanFlow()"
  x-show="isOpen"
  x-cloak
  @keydown.escape.window="close()"
  class="change-plan-flow-root"
  style="display: none;"
>
  <!-- Inclure toutes les modals -->
  <x-subscription.change-plan-entry />
  <x-subscription.change-plan-upgrade-builder />
  <x-subscription.change-plan-upgrade-review />
  <x-subscription.change-plan-payment />
  <x-subscription.change-plan-downgrade-picker />
  <x-subscription.change-plan-downgrade-confirm />
</div>

