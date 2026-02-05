@extends('frontend.layout')

@section('pageHeading')
  Choisir mon cycle (4 semaines) | {{ $websiteInfo->website_title }}
@endsection

@section('metaDescription')
  Choisissez votre cycle Pause Souffle : 1, 2, 4 ou 8 rituels par cycle de 4 semaines.
@endsection

@section('style')
<style>
  .pause-souffle-choose-cycle-page {
    min-height: 70vh;
    padding: 4rem 1rem;
    background: #FFFFFF;
  }

  .pause-souffle-choose-cycle-container {
    max-width: 900px;
    margin: 0 auto;
  }

  .pause-souffle-choose-cycle-header {
    text-align: center;
    margin-bottom: 3rem;
  }

  .pause-souffle-choose-cycle-header h1 {
    font-size: 2.5rem;
    font-weight: 700;
    color: #1F2937;
    margin-bottom: 1rem;
  }

  .pause-souffle-choose-cycle-header p {
    font-size: 1.125rem;
    color: #6B7280;
    line-height: 1.6;
  }

  .pause-souffle-packs-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 1.5rem;
    margin-bottom: 3rem;
  }

  .pause-souffle-pack-card {
    border: 2px solid #E5E7EB;
    border-radius: 16px;
    padding: 1.5rem;
    text-align: center;
    cursor: pointer;
    transition: all 0.3s ease;
    background: #FFFFFF;
  }

  .pause-souffle-pack-card:hover {
    border-color: #6366F1;
    box-shadow: 0 4px 12px rgba(99, 102, 241, 0.15);
    transform: translateY(-2px);
  }

  .pause-souffle-pack-card.selected {
    border-color: #6366F1;
    background: #F0F4FF;
    box-shadow: 0 4px 12px rgba(99, 102, 241, 0.2);
  }

  .pause-souffle-pack-card h3 {
    font-size: 1.5rem;
    font-weight: 700;
    color: #1F2937;
    margin-bottom: 0.5rem;
  }

  .pause-souffle-pack-card .rituals-count {
    font-size: 0.875rem;
    color: #6B7280;
    margin-bottom: 1rem;
  }

  .pause-souffle-pack-card .price {
    font-size: 1.75rem;
    font-weight: 700;
    color: #6366F1;
    margin-bottom: 0.5rem;
  }

  .pause-souffle-pack-card .price-currency {
    font-size: 1rem;
    color: #6B7280;
  }

  .pause-souffle-addon-section {
    background: #F9FAFB;
    border-radius: 16px;
    padding: 2rem;
    margin-bottom: 2rem;
  }

  .pause-souffle-addon-section h2 {
    font-size: 1.5rem;
    font-weight: 600;
    color: #1F2937;
    margin-bottom: 1rem;
  }

  .pause-souffle-addon-section p {
    font-size: 0.875rem;
    color: #6B7280;
    margin-bottom: 1.5rem;
  }

  .pause-souffle-stepper {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 1rem;
    margin-bottom: 1rem;
  }

  .pause-souffle-stepper-btn {
    width: 40px;
    height: 40px;
    border: 2px solid #E5E7EB;
    border-radius: 8px;
    background: #FFFFFF;
    color: #1F2937;
    font-size: 1.25rem;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.2s ease;
    display: flex;
    align-items: center;
    justify-content: center;
  }

  .pause-souffle-stepper-btn:hover:not(:disabled) {
    border-color: #6366F1;
    color: #6366F1;
  }

  .pause-souffle-stepper-btn:disabled {
    opacity: 0.5;
    cursor: not-allowed;
  }

  .pause-souffle-stepper-value {
    font-size: 1.5rem;
    font-weight: 600;
    color: #1F2937;
    min-width: 60px;
    text-align: center;
  }

  .pause-souffle-total {
    text-align: center;
    font-size: 1.125rem;
    font-weight: 600;
    color: #1F2937;
    padding: 1rem;
    background: #FFFFFF;
    border-radius: 8px;
    margin-top: 1rem;
  }

  .pause-souffle-activate-btn {
    display: block;
    width: 100%;
    padding: 1rem 2rem;
    background: #6366F1;
    color: #FFFFFF;
    text-align: center;
    text-decoration: none;
    border-radius: 12px;
    font-weight: 600;
    font-size: 1rem;
    transition: all 0.3s ease;
    border: none;
    cursor: pointer;
  }

  .pause-souffle-activate-btn:hover:not(:disabled) {
    background: #4F46E5;
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(99, 102, 241, 0.3);
  }

  .pause-souffle-activate-btn:disabled {
    opacity: 0.5;
    cursor: not-allowed;
  }

  @media (max-width: 768px) {
    .pause-souffle-choose-cycle-header h1 {
      font-size: 2rem;
    }

    .pause-souffle-packs-grid {
      grid-template-columns: 1fr;
    }
  }
</style>
@endsection

@section('content')
<div class="pause-souffle-choose-cycle-page">
  <div class="pause-souffle-choose-cycle-container">
    <div class="pause-souffle-choose-cycle-header">
      <h1>Choisir mon cycle (4 semaines)</h1>
      <p>Après votre rituel d'essai, choisissez le rythme qui vous convient pour les 4 prochaines semaines.</p>
    </div>

    <form id="chooseCycleForm" method="POST" action="{{ route('pause-souffle.activate-cycle') }}">
      @csrf
      <input type="hidden" name="intake_id" value="{{ $intake->id }}">

      <div class="pause-souffle-packs-grid">
        @foreach(['pack_1' => '1 rituel', 'pack_2' => '2 rituels', 'pack_4' => '4 rituels', 'pack_8' => '8 rituels'] as $packKey => $packLabel)
          @php
            $packData = $packs[$packKey] ?? null;
            $ritualsPerCycle = config("pause_souffle.pack_to_rituals_per_cycle.{$packKey}", 0);
          @endphp
          @if($packData)
            <div class="pause-souffle-pack-card" data-pack="{{ $packKey }}" onclick="selectPack('{{ $packKey }}')">
              <h3>{{ $packLabel }}</h3>
              <div class="rituals-count">par cycle de 4 semaines</div>
              <div class="price">
                {{ number_format($packData['amount'], 2, ',', ' ') }}
                <span class="price-currency">{{ $packData['currency'] }}</span>
              </div>
              <input type="radio" name="pack" value="{{ $packKey }}" id="pack_{{ $packKey }}" style="display: none;">
            </div>
          @endif
        @endforeach
      </div>

      <div class="pause-souffle-addon-section">
        <h2>Rituels supplémentaires</h2>
        <p>Ajoutez jusqu'à 12 rituels au total par cycle (pack + add-on).</p>
        
        <div class="pause-souffle-stepper">
          <button type="button" class="pause-souffle-stepper-btn" onclick="decreaseAddon()" id="decreaseBtn">-</button>
          <span class="pause-souffle-stepper-value" id="addonValue">0</span>
          <button type="button" class="pause-souffle-stepper-btn" onclick="increaseAddon()" id="increaseBtn">+</button>
        </div>
        
        <input type="hidden" name="addon_qty" id="addonQty" value="0">
        
        <div class="pause-souffle-total" id="totalDisplay">
          Total : <span id="totalRituals">0</span> rituels / 4 semaines
        </div>
      </div>

      <button type="submit" class="pause-souffle-activate-btn" id="activateBtn" disabled>
        Activer mon cycle (4 semaines)
      </button>
    </form>
  </div>
</div>

<script>
  let selectedPack = null;
  let addonQty = 0;
  const maxRituals = 12;

  function selectPack(packKey) {
    // Désélectionner tous les packs
    document.querySelectorAll('.pause-souffle-pack-card').forEach(card => {
      card.classList.remove('selected');
    });
    
    // Sélectionner le pack cliqué
    const card = document.querySelector(`[data-pack="${packKey}"]`);
    if (card) {
      card.classList.add('selected');
      const radio = document.getElementById(`pack_${packKey}`);
      if (radio) {
        radio.checked = true;
        selectedPack = packKey;
        updateTotal();
        checkActivateButton();
      }
    }
  }

  function getPackRituals(packKey) {
    // Les packs représentent le nombre de rituels par cycle de 4 semaines
    const packMap = {
      'pack_1': 1,
      'pack_2': 2,
      'pack_4': 4,
      'pack_8': 8
    };
    return packMap[packKey] || 0;
  }

  function increaseAddon() {
    if (!selectedPack) return;
    
    const packRituals = getPackRituals(selectedPack);
    const maxAddon = maxRituals - packRituals;
    
    if (addonQty < maxAddon) {
      addonQty++;
      updateAddonDisplay();
      updateTotal();
    }
  }

  function decreaseAddon() {
    if (addonQty > 0) {
      addonQty--;
      updateAddonDisplay();
      updateTotal();
    }
  }

  function updateAddonDisplay() {
    document.getElementById('addonValue').textContent = addonQty;
    document.getElementById('addonQty').value = addonQty;
    
    // Désactiver boutons si limites atteintes
    const packRituals = selectedPack ? getPackRituals(selectedPack) : 0;
    const maxAddon = maxRituals - packRituals;
    
    document.getElementById('increaseBtn').disabled = addonQty >= maxAddon;
    document.getElementById('decreaseBtn').disabled = addonQty <= 0;
  }

  function updateTotal() {
    const packRituals = selectedPack ? getPackRituals(selectedPack) : 0;
    const totalRituals = packRituals + addonQty;
    
    document.getElementById('totalRituals').textContent = totalRituals;
    
    // Ajuster add-on si dépassement
    if (totalRituals > maxRituals) {
      addonQty = Math.max(0, maxRituals - packRituals);
      updateAddonDisplay();
    }
  }

  function checkActivateButton() {
    const activateBtn = document.getElementById('activateBtn');
    activateBtn.disabled = !selectedPack;
  }

  // Initialiser au chargement
  document.addEventListener('DOMContentLoaded', function() {
    checkActivateButton();
    updateAddonDisplay();
  });
</script>
@endsection
