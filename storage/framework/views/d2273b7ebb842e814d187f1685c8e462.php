<!-- Étape 4 : Choisissez votre Rituel avec [Nom] -->
<div 
  x-data="transferAddStep4()"
  x-show="isOpen"
  x-cloak
  @keydown.escape.window="goBack()"
  class="transfer-modal-overlay"
  style="display: none;"
>
  <div class="transfer-modal-backdrop" @click="goBack()"></div>
  
  <div 
    class="transfer-modal-container transfer-ritual-container"
    @click.stop
    x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="opacity-0 translate-x-full"
    x-transition:enter-end="opacity-100 translate-x-0"
  >
    <!-- Header -->
    <div class="transfer-modal-header">
      <button 
        type="button"
        @click="goBack()"
        class="transfer-modal-back"
        aria-label="<?php echo e(__('Retour')); ?>"
      >
        <i class="fas fa-arrow-left"></i>
      </button>
      <button 
        type="button"
        @click="close()"
        class="transfer-modal-close"
        aria-label="<?php echo e(__('Fermer')); ?>"
      >
        <i class="fas fa-times"></i>
      </button>
      
      <!-- Photo du freelance -->
      <div class="transfer-plan-avatar-wrapper">
        <img 
          x-bind:src="selectedFreelance?.avatar || '<?php echo e(asset('assets/img/noimage.jpg')); ?>'"
          x-bind:alt="selectedFreelance?.name"
          class="transfer-plan-avatar"
          onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';"
        >
        <div class="transfer-plan-avatar-initials" style="display: none;">
          <span x-text="getInitials(selectedFreelance?.name)"></span>
        </div>
      </div>
      
      <h2 class="transfer-modal-title">
        <div><?php echo e(__('Choisissez votre Rituel avec')); ?></div>
        <div><span x-text="selectedFreelance?.name"></span>.</div>
      </h2>
      
      <!-- Texte intro -->
      <div class="transfer-ritual-intro">
        <p><?php echo e(__('Un Rituel est un rythme d\'accompagnement sur 4 semaines, ajustable à tout moment.')); ?></p>
        <p><?php echo e(__('Chaque Rituel inclut 50 minutes de focus + 10 minutes de feedback, pour avancer sereinement et durablement.')); ?></p>
      </div>
    </div>

    <!-- Body avec le slider -->
    <div class="transfer-modal-body transfer-ritual-body">
      <!-- Valeur sélectionnée en grand -->
      <div class="transfer-ritual-selected-value">
        <span x-text="selectedValue"></span> <span class="transfer-ritual-unit"><?php echo e(__('h')); ?></span>
      </div>

      <!-- Slider -->
      <div class="transfer-ritual-slider-wrapper">
        <input 
          type="range"
          :value="getSliderValue()"
          :min="0"
          :max="visibleValues.length - 1"
          :step="1"
          @input="updateFromSliderIndex($event.target.value)"
          class="transfer-ritual-slider"
          :aria-label="'<?php echo e(__('Rituels par semaine')); ?>'"
          :aria-valuemin="0"
          :aria-valuemax="visibleValues.length - 1"
          :aria-valuenow="getSliderIndex()"
        >
        
        <!-- Labels sous le slider -->
        <div class="transfer-ritual-labels">
          <template x-for="(value, index) in visibleValues" :key="index">
            <div 
              class="transfer-ritual-label"
              :class="{ 'transfer-ritual-label-active': value === selectedValue }"
              :style="`left: ${getLabelPosition(index)}%`"
              @click="selectValue(value)"
            >
              <span x-text="value"></span>
            </div>
          </template>
        </div>
      </div>

      <!-- Bouton Voir plus / Voir moins -->
      <button 
        type="button"
        @click="toggleExtendedValues()"
        class="transfer-ritual-toggle-btn"
      >
        <span x-text="showExtended ? '<?php echo e(__('Voir moins')); ?>' : '<?php echo e(__('Voir plus')); ?>'"></span>
        <i class="fas" :class="showExtended ? 'fa-chevron-up' : 'fa-chevron-down'"></i>
      </button>

      <!-- Paliers / Cartes -->
      <div class="transfer-ritual-tiers">
        <div class="transfer-ritual-tiers-row">
          <button 
            type="button"
            @click="selectTier(1, 2)"
            class="transfer-ritual-tier-card"
            :class="{ 'transfer-ritual-tier-active': isInTier(1, 2) }"
          >
            <div class="transfer-ritual-tier-label">1–2</div>
            <div class="transfer-ritual-tier-title"><?php echo e(__('Découverte')); ?></div>
            <div class="transfer-ritual-tier-subtitle"><?php echo e(__('Entrer dans l\'expérience')); ?></div>
          </button>
          
          <button 
            type="button"
            @click="selectTier(3, 4)"
            class="transfer-ritual-tier-card"
            :class="{ 'transfer-ritual-tier-active': isInTier(3, 4) }"
          >
            <div class="transfer-ritual-tier-label">3–4</div>
            <div class="transfer-ritual-tier-title"><?php echo e(__('Continuité')); ?></div>
            <div class="transfer-ritual-tier-subtitle"><?php echo e(__('Installer une habitude')); ?></div>
          </button>
          
          <button 
            type="button"
            @click="selectTier(5, 6)"
            class="transfer-ritual-tier-card transfer-ritual-tier-popular"
            :class="{ 'transfer-ritual-tier-active': isInTier(5, 6) }"
          >
            <div class="transfer-ritual-tier-label">5–6</div>
            <div class="transfer-ritual-tier-badge"><?php echo e(__('Populaire')); ?></div>
            <div class="transfer-ritual-tier-title"><?php echo e(__('Équilibre')); ?></div>
            <div class="transfer-ritual-tier-subtitle"><?php echo e(__('Le rythme naturel')); ?></div>
          </button>
        </div>
        
        <div class="transfer-ritual-tiers-row">
          <button 
            type="button"
            @click="selectTier(7, 10)"
            class="transfer-ritual-tier-card"
            :class="{ 'transfer-ritual-tier-active': isInTier(7, 10) }"
          >
            <div class="transfer-ritual-tier-label">7–10</div>
            <div class="transfer-ritual-tier-title"><?php echo e(__('Engagement')); ?></div>
            <div class="transfer-ritual-tier-subtitle"><?php echo e(__('Avancer concrètement')); ?></div>
          </button>
          
          <button 
            type="button"
            @click="selectTier(12, 24)"
            class="transfer-ritual-tier-card"
            :class="{ 'transfer-ritual-tier-active': isInTier(12, 24) }"
          >
            <div class="transfer-ritual-tier-label">12–24</div>
            <div class="transfer-ritual-tier-title"><?php echo e(__('Approfondissement')); ?></div>
            <div class="transfer-ritual-tier-subtitle"><?php echo e(__('Transformation / projet')); ?></div>
          </button>
        </div>
      </div>

      <!-- Message pour Approfondissement -->
      <div x-show="selectedValue >= 12" class="transfer-ritual-deep-message">
        <p><?php echo e(__('Idéal pour projets intensifs, accompagnements professionnels ou immersion complète.')); ?></p>
      </div>

      <!-- Résumé chiffré -->
      <div class="transfer-ritual-summary">
        <div class="transfer-ritual-summary-item">
          <span><?php echo e(__('Vous choisissez :')); ?></span>
          <strong x-text="selectedValue + ' ' + (selectedValue === 1 ? '<?php echo e(__('Rituel')); ?>' : '<?php echo e(__('Rituels')); ?>') + ' / semaine'"></strong>
        </div>
        <div class="transfer-ritual-summary-item">
          <span><?php echo e(__('Soit :')); ?></span>
          <strong x-text="(selectedValue * 4) + ' <?php echo e(__('Rituels')); ?> / x 4 semaines'"></strong>
        </div>
      </div>

      <!-- Prix -->
      <div class="transfer-ritual-price">
        <div class="transfer-ritual-price-total">
          <?php echo e(__('Total :')); ?> <span x-text="formatPrice(calculatedPrice)"></span> <?php echo e(__('toutes les 4 semaines')); ?>

        </div>
        <div class="transfer-ritual-price-note">
          <?php echo e(__('Besoin ponctuel ? Vous pourrez ajouter des Rituels en plus, à tout moment, après l\'abonnement.')); ?>

        </div>
      </div>
    </div>

    <!-- Footer avec bouton CTA -->
    <div class="transfer-modal-footer">
      <button 
        type="button"
        @click="continueToConfirm()"
        class="transfer-ritual-continue-btn"
        :disabled="!selectedValue"
      >
        <?php echo e(__('Continuer')); ?> <i class="fas fa-arrow-right"></i>
      </button>
    </div>
  </div>
</div>

<style>
  .transfer-ritual-container {
    max-width: 600px;
  }

  .transfer-ritual-container .transfer-modal-header {
    padding: 16px 24px 12px 24px;
  }

  .transfer-ritual-container .transfer-modal-back,
  .transfer-ritual-container .transfer-modal-close {
    top: 16px;
    width: 32px;
    height: 32px;
  }

  .transfer-ritual-container .transfer-plan-avatar-wrapper {
    margin-bottom: 12px;
  }

  .transfer-ritual-container .transfer-plan-avatar,
  .transfer-ritual-container .transfer-plan-avatar-initials {
    width: 70px;
    height: 70px;
    font-size: 28px;
    border-width: 3px;
  }

  .transfer-ritual-container .transfer-modal-title {
    font-size: 24px;
    margin: 0 0 8px 0;
    padding: 0 60px;
    line-height: 1.3;
    display: flex;
    flex-direction: column;
    gap: 4px;
  }

  .transfer-ritual-container .transfer-modal-title div {
    line-height: 1.3;
  }

  .transfer-ritual-intro {
    margin-top: 12px;
    padding: 14px 16px;
    background: #F9FAFB;
    border-radius: 12px;
  }

  .transfer-ritual-intro p {
    font-size: 14px;
    color: #6B7280;
    line-height: 1.6;
    margin: 0 0 8px 0;
  }

  .transfer-ritual-intro p:last-child {
    margin-bottom: 0;
  }

  .transfer-ritual-body {
    padding: 32px 24px;
  }

  .transfer-ritual-selected-value {
    text-align: center;
    font-size: 48px;
    font-weight: 700;
    color: #7C3AED;
    margin-bottom: 32px;
    line-height: 1;
  }

  .transfer-ritual-unit {
    font-size: 32px;
    font-weight: 500;
    color: #9CA3AF;
    margin-left: 4px;
  }

  .transfer-ritual-slider-wrapper {
    position: relative;
    margin-bottom: 24px;
    padding: 0 8px;
  }

  .transfer-ritual-slider {
    width: 100%;
    height: 8px;
    border-radius: 4px;
    background: #E5E7EB;
    outline: none;
    -webkit-appearance: none;
    appearance: none;
    position: relative;
    z-index: 2;
    transition: none;
  }

  .transfer-ritual-slider::-webkit-slider-thumb {
    -webkit-appearance: none;
    appearance: none;
    width: 24px;
    height: 24px;
    border-radius: 50%;
    background: linear-gradient(135deg, #1e40af 0%, #4c1d95 50%, #7c3aed 100%);
    cursor: pointer;
    box-shadow: 0 2px 8px rgba(124, 58, 237, 0.4);
    border: 3px solid white;
    transition: transform 0.1s ease-out, box-shadow 0.1s ease-out;
  }

  .transfer-ritual-slider::-webkit-slider-thumb:hover {
    transform: scale(1.1);
    box-shadow: 0 4px 12px rgba(124, 58, 237, 0.5);
  }

  .transfer-ritual-slider::-webkit-slider-thumb:active {
    transform: scale(1.15);
    box-shadow: 0 6px 16px rgba(124, 58, 237, 0.6);
  }

  .transfer-ritual-slider::-moz-range-thumb {
    width: 24px;
    height: 24px;
    border-radius: 50%;
    background: linear-gradient(135deg, #1e40af 0%, #4c1d95 50%, #7c3aed 100%);
    cursor: pointer;
    box-shadow: 0 2px 8px rgba(124, 58, 237, 0.4);
    border: 3px solid white;
    transition: transform 0.1s ease-out, box-shadow 0.1s ease-out;
  }

  .transfer-ritual-slider::-moz-range-thumb:hover {
    transform: scale(1.1);
    box-shadow: 0 4px 12px rgba(124, 58, 237, 0.5);
  }

  .transfer-ritual-slider::-moz-range-thumb:active {
    transform: scale(1.15);
    box-shadow: 0 6px 16px rgba(124, 58, 237, 0.6);
  }

  .transfer-ritual-labels {
    position: relative;
    height: 40px;
    margin-top: 16px;
  }

  .transfer-ritual-label {
    position: absolute;
    transform: translateX(-50%);
    text-align: center;
    font-size: 14px;
    font-weight: 500;
    color: #9CA3AF;
    transition: color 0.15s ease-out, font-size 0.15s ease-out, font-weight 0.15s ease-out;
    cursor: pointer;
    padding-top: 8px;
    user-select: none;
  }

  .transfer-ritual-label-active {
    color: #7C3AED;
    font-weight: 600;
    font-size: 16px;
  }

  .transfer-ritual-label::before {
    content: '';
    position: absolute;
    top: 0;
    left: 50%;
    transform: translateX(-50%);
    width: 6px;
    height: 6px;
    border-radius: 50%;
    background: #D1D5DB;
    transition: all 0.2s;
  }

  .transfer-ritual-label-active::before {
    background: #7C3AED;
    width: 8px;
    height: 8px;
  }

  .transfer-ritual-toggle-btn {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    width: 100%;
    padding: 12px;
    background: #F9FAFB;
    border: 1px solid #E5E7EB;
    border-radius: 8px;
    color: #6B7280;
    font-size: 14px;
    font-weight: 500;
    cursor: pointer;
    transition: all 0.2s;
    margin-bottom: 24px;
  }

  .transfer-ritual-toggle-btn:hover {
    background: #F3F4F6;
    border-color: #D1D5DB;
  }

  .transfer-ritual-tiers {
    margin-bottom: 24px;
  }

  .transfer-ritual-tiers-row {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 12px;
    margin-bottom: 12px;
  }

  .transfer-ritual-tiers-row:last-child {
    grid-template-columns: repeat(2, 1fr);
    margin-bottom: 0;
  }

  .transfer-ritual-tier-card {
    padding: 16px;
    background: #F9FAFB;
    border: 2px solid #E5E7EB;
    border-radius: 12px;
    cursor: pointer;
    transition: all 0.2s;
    text-align: left;
    position: relative;
  }

  .transfer-ritual-tier-card:hover {
    background: #F3F4F6;
    border-color: #D1D5DB;
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
  }

  .transfer-ritual-tier-active {
    border-color: #7C3AED;
    background: #F3E8FF;
  }

  .transfer-ritual-tier-popular {
    border-color: #10B981;
  }

  .transfer-ritual-tier-popular.transfer-ritual-tier-active {
    background: #ECFDF5;
  }

  .transfer-ritual-tier-label {
    font-size: 12px;
    font-weight: 600;
    color: #6B7280;
    margin-bottom: 8px;
  }

  .transfer-ritual-tier-active .transfer-ritual-tier-label {
    color: #7C3AED;
  }

  .transfer-ritual-tier-badge {
    position: absolute;
    top: 8px;
    right: 8px;
    padding: 2px 8px;
    background: #10B981;
    color: white;
    border-radius: 4px;
    font-size: 10px;
    font-weight: 600;
  }

  .transfer-ritual-tier-title {
    font-size: 16px;
    font-weight: 600;
    color: #111827;
    margin-bottom: 4px;
  }

  .transfer-ritual-tier-subtitle {
    font-size: 12px;
    color: #6B7280;
    line-height: 1.4;
  }

  .transfer-ritual-deep-message {
    margin-bottom: 24px;
    padding: 16px;
    background: linear-gradient(135deg, #D1FAE5 0%, #A7F3D0 100%);
    border-radius: 12px;
    border: 1px solid #10B981;
  }

  .transfer-ritual-deep-message p {
    font-size: 13px;
    color: #065F46;
    line-height: 1.6;
    margin: 0;
  }

  .transfer-ritual-summary {
    background: linear-gradient(135deg, #F3E8FF 0%, #E9D5FF 100%);
    border-radius: 12px;
    padding: 20px;
    margin-bottom: 16px;
  }

  .transfer-ritual-summary-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 12px;
    font-size: 14px;
    color: #6B7280;
  }

  .transfer-ritual-summary-item:last-child {
    margin-bottom: 0;
  }

  .transfer-ritual-summary-item strong {
    font-size: 16px;
    font-weight: 600;
    color: #7C3AED;
  }

  .transfer-ritual-price {
    background: #F9FAFB;
    border-radius: 12px;
    padding: 20px;
    margin-bottom: 24px;
  }

  .transfer-ritual-price-total {
    font-size: 20px;
    font-weight: 600;
    color: #111827;
    margin-bottom: 12px;
    text-align: center;
  }

  .transfer-ritual-price-total span {
    color: #7C3AED;
  }

  .transfer-ritual-price-note {
    padding: 12px;
    background: linear-gradient(135deg, #D1FAE5 0%, #A7F3D0 100%);
    border-radius: 8px;
    font-size: 12px;
    color: #065F46;
    line-height: 1.5;
    text-align: center;
  }

  .transfer-ritual-continue-btn {
    width: 100%;
    padding: 16px;
    background: linear-gradient(135deg, #1e40af 0%, #4c1d95 50%, #7c3aed 100%);
    color: white;
    border: none;
    border-radius: 12px;
    font-size: 16px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.2s;
    box-shadow: 0 4px 12px rgba(124, 58, 237, 0.3);
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
  }

  .transfer-ritual-continue-btn:hover:not(:disabled) {
    transform: translateY(-2px);
    box-shadow: 0 6px 16px rgba(124, 58, 237, 0.4);
  }

  .transfer-ritual-continue-btn:disabled {
    opacity: 0.6;
    cursor: not-allowed;
  }
</style>

<script>
  function transferAddStep4() {
    return {
      isOpen: false,
      selectedFreelance: null,
      subscriptionId: null,
      currentTutorName: '',
      currentTutorAvatar: '',
      credit: 0,
      creditAmount: 0,
      selectedQty: 0,
      usedAmount: 0,
      pricePerRituel: 0,
      
      // Slider values
      baseValues: [1, 2, 4, 6, 8, 10],
      extendedValues: [12, 14, 16, 18, 20, 24],
      showExtended: false,
      selectedValue: 1,
      minValue: 1,
      maxValue: 10,

      init() {
        window.addEventListener('openTransferAddStep4', (e) => {
          this.open(e.detail);
        });
      },

      get visibleValues() {
        return this.showExtended 
          ? [...this.baseValues, ...this.extendedValues]
          : this.baseValues;
      },

      open(payload) {
        this.selectedFreelance = payload.selectedFreelance;
        this.subscriptionId = payload.subscriptionId;
        this.currentTutorName = payload.currentTutorName || '';
        this.currentTutorAvatar = payload.currentTutorAvatar || '';
        this.credit = payload.credit || 0;
        this.creditAmount = payload.creditAmount || 0;
        this.selectedQty = payload.selectedQty || 0;
        this.usedAmount = payload.usedAmount || 0;
        this.pricePerRituel = payload.pricePerRituel || this.selectedFreelance?.price_per_session || 0;
        
        // Réinitialiser le slider
        this.selectedValue = 1;
        this.showExtended = false;
        this.updateMaxValue();
        
        this.isOpen = true;
        document.body.style.overflow = 'hidden';
      },

      updateMaxValue() {
        this.maxValue = this.showExtended ? 24 : 10;
        // S'assurer que la valeur sélectionnée est valide
        if (this.selectedValue > this.maxValue) {
          this.selectedValue = this.maxValue;
        }
        // S'assurer que la valeur est dans la liste des valeurs valides
        if (!this.visibleValues.includes(this.selectedValue)) {
          // Trouver la valeur la plus proche
          const closest = this.visibleValues.reduce((prev, curr) => {
            return Math.abs(curr - this.selectedValue) < Math.abs(prev - this.selectedValue) ? curr : prev;
          });
          this.selectedValue = closest;
        }
      },

      getSliderIndex() {
        const index = this.visibleValues.indexOf(this.selectedValue);
        return index !== -1 ? index : 0;
      },

      getSliderValue() {
        return this.getSliderIndex();
      },

      updateFromSliderIndex(sliderIndex) {
        const index = parseInt(sliderIndex);
        if (index >= 0 && index < this.visibleValues.length) {
          this.selectedValue = this.visibleValues[index];
        }
      },

      selectValue(value) {
        // Si la valeur nécessite l'extension, ouvrir "Voir plus" automatiquement
        if (!this.showExtended && value > 10) {
          this.showExtended = true;
          this.updateMaxValue();
        }
        this.selectedValue = value;
      },

      toggleExtendedValues() {
        this.showExtended = !this.showExtended;
        this.updateMaxValue();
        // Maintenir la valeur sélectionnée si elle est toujours valide
        if (!this.visibleValues.includes(this.selectedValue)) {
          // Trouver la valeur la plus proche
          const closest = this.visibleValues.reduce((prev, curr) => {
            return Math.abs(curr - this.selectedValue) < Math.abs(prev - this.selectedValue) ? curr : prev;
          });
          this.selectedValue = closest;
        }
      },

      getLabelPosition(index) {
        if (this.visibleValues.length === 1) return 50;
        return (index / (this.visibleValues.length - 1)) * 100;
      },

      isInTier(min, max) {
        return this.selectedValue >= min && this.selectedValue <= max;
      },

      selectTier(min, max) {
        // Sélectionner la valeur médiane du tier, ou la plus proche valeur disponible
        const median = Math.floor((min + max) / 2);
        
        // Si le tier nécessite l'extension, ouvrir "Voir plus" automatiquement
        if (!this.showExtended && max > 10) {
          this.showExtended = true;
          this.updateMaxValue();
        }
        
        const closest = this.visibleValues.reduce((prev, curr) => {
          if (curr >= min && curr <= max) {
            return Math.abs(curr - median) < Math.abs(prev - median) ? curr : prev;
          }
          return prev;
        }, this.visibleValues[0]);
        this.selectedValue = closest;
      },

      get calculatedPrice() {
        const totalSessions = this.selectedValue * 4;
        return this.pricePerRituel * totalSessions;
      },

      getInitials(name) {
        if (!name) return '?';
        const parts = name.trim().split(' ');
        if (parts.length >= 2) {
          return (parts[0][0] + parts[parts.length - 1][0]).toUpperCase();
        }
        return name.substring(0, 2).toUpperCase();
      },

      formatPrice(price) {
        return new Intl.NumberFormat('fr-FR', { style: 'currency', currency: 'EUR' }).format(price);
      },

      continueToConfirm() {
        if (!this.selectedValue) return;
        
        // Créer un plan basé sur la valeur sélectionnée
        const plan = {
          id: this.selectedValue,
          sessions_per_week: this.selectedValue,
          total_sessions: this.selectedValue * 4,
          price: this.calculatedPrice,
          is_popular: this.selectedValue >= 5 && this.selectedValue <= 6
        };
        
        this.close();
        // Ouvrir l'étape 5 : Confirmation transfert
        window.dispatchEvent(new CustomEvent('openTransferAddStep5', {
          detail: {
            subscriptionId: this.subscriptionId,
            selectedFreelance: this.selectedFreelance,
            selectedPlan: plan,
            selectedQty: this.selectedQty,
            usedAmount: this.usedAmount,
            currentTutorName: this.currentTutorName,
            currentTutorAvatar: this.currentTutorAvatar,
            credit: this.credit,
            creditAmount: this.creditAmount
          }
        }));
      },

      goBack() {
        this.close();
        // Revenir à l'étape 3
        window.dispatchEvent(new CustomEvent('openTransferAddStep3', {
          detail: {
            subscriptionId: this.subscriptionId,
            selectedFreelance: this.selectedFreelance,
            currentTutorName: this.currentTutorName,
            currentTutorAvatar: this.currentTutorAvatar,
            credit: this.credit,
            creditAmount: this.creditAmount
          }
        }));
      },

      close() {
        this.isOpen = false;
        document.body.style.overflow = '';
      }
    }
  }
</script>
<?php /**PATH C:\Users\younes\Downloads\junspro-main (1)\junspro-main3\resources\views\components\subscription\transfer\add\step4-pick-plan.blade.php ENDPATH**/ ?>