<section class="referral-faq-section">
  <div class="referral-faq-container">
    <h2 class="referral-section-title">{{ __('Des questions ?') }}</h2>

    <div class="referral-faq-accordion" x-data="faqAccordion()">
      <div class="referral-faq-item" x-data="{ open: false }">
        <button 
          class="referral-faq-question"
          @click="open = !open"
          :aria-expanded="open"
        >
          <span>{{ __('Quand vais-je recevoir mon crédit Junspro ?') }}</span>
          <svg 
            class="referral-faq-chevron"
            :class="{ 'rotate-180': open }"
            width="20" 
            height="20" 
            viewBox="0 0 24 24" 
            fill="none" 
            stroke="currentColor" 
            stroke-width="2"
          >
            <polyline points="6 9 12 15 18 9"></polyline>
          </svg>
        </button>
        <div 
          class="referral-faq-answer"
          x-show="open"
          x-collapse
        >
          <p>
            {{ __('Après confirmation de la première prestation de votre proche (payée + non annulée). L\'ajout peut prendre jusqu\'à :hours heures pour vérification.', ['hours' => $config['cooldown_hours']]) }}
          </p>
        </div>
      </div>

      <div class="referral-faq-item" x-data="{ open: false }">
        <button 
          class="referral-faq-question"
          @click="open = !open"
          :aria-expanded="open"
        >
          <span>{{ __('Quel avantage mon proche reçoit-il ?') }}</span>
          <svg 
            class="referral-faq-chevron"
            :class="{ 'rotate-180': open }"
            width="20" 
            height="20" 
            viewBox="0 0 24 24" 
            fill="none" 
            stroke="currentColor" 
            stroke-width="2"
          >
            <polyline points="6 9 12 15 18 9"></polyline>
          </svg>
        </button>
        <div 
          class="referral-faq-answer"
          x-show="open"
          x-collapse
        >
          <p>
            {{ __('Il bénéficie de :benefit_label sur sa première réservation éligible, dès :amount€ de prestation, selon les conditions.', [
              'benefit_label' => $config['benefit_label'],
              'amount' => $config['min_eligible_amount']
            ]) }}
          </p>
        </div>
      </div>

      <div class="referral-faq-item" x-data="{ open: false }">
        <button 
          class="referral-faq-question"
          @click="open = !open"
          :aria-expanded="open"
        >
          <span>{{ __('Pourquoi Junspro applique des frais des deux côtés ?') }}</span>
          <svg 
            class="referral-faq-chevron"
            :class="{ 'rotate-180': open }"
            width="20" 
            height="20" 
            viewBox="0 0 24 24" 
            fill="none" 
            stroke="currentColor" 
            stroke-width="2"
          >
            <polyline points="6 9 12 15 18 9"></polyline>
          </svg>
        </button>
        <div 
          class="referral-faq-answer"
          x-show="open"
          x-collapse
        >
          <p>
            {{ __('Parce que Junspro est un écosystème : discipline (rituels), suivi (rapports), sécurité (paiements/règles) et organisation (planning). Le client finance la protection & l\'expérience, le freelance finance le cadre d\'exécution et la qualité.') }}
          </p>
        </div>
      </div>

      <div class="referral-faq-item" x-data="{ open: false }">
        <button 
          class="referral-faq-question"
          @click="open = !open"
          :aria-expanded="open"
        >
          <span>{{ __('Et si mon proche annule ou se fait rembourser ?') }}</span>
          <svg 
            class="referral-faq-chevron"
            :class="{ 'rotate-180': open }"
            width="20" 
            height="20" 
            viewBox="0 0 24 24" 
            fill="none" 
            stroke="currentColor" 
            stroke-width="2"
          >
            <polyline points="6 9 12 15 18 9"></polyline>
          </svg>
        </button>
        <div 
          class="referral-faq-answer"
          x-show="open"
          x-collapse
        >
          <p>
            {{ __('Si la première réservation est annulée ou remboursée, la récompense ne peut pas être accordée. Elle sera déclenchée dès qu\'une première prestation éligible est confirmée.') }}
          </p>
        </div>
      </div>

      <div class="referral-faq-item" x-data="{ open: false }">
        <button 
          class="referral-faq-question"
          @click="open = !open"
          :aria-expanded="open"
        >
          <span>{{ __('Peut-on changer de freelance ou transférer ses heures ?') }}</span>
          <svg 
            class="referral-faq-chevron"
            :class="{ 'rotate-180': open }"
            width="20" 
            height="20" 
            viewBox="0 0 24 24" 
            fill="none" 
            stroke="currentColor" 
            stroke-width="2"
          >
            <polyline points="6 9 12 15 18 9"></polyline>
          </svg>
        </button>
        <div 
          class="referral-faq-answer"
          x-show="open"
          x-collapse
        >
          <p>
            {{ __('Oui. Selon les règles Junspro, vous pouvez changer de freelance et transférer des heures/abonnements pour garantir la continuité du Rituel.') }}
          </p>
        </div>
      </div>

      <div class="referral-faq-item" x-data="{ open: false }">
        <button 
          class="referral-faq-question"
          @click="open = !open"
          :aria-expanded="open"
        >
          <span>{{ __('Je pense qu\'il y a une erreur sur mon parrainage.') }}</span>
          <svg 
            class="referral-faq-chevron"
            :class="{ 'rotate-180': open }"
            width="20" 
            height="20" 
            viewBox="0 0 24 24" 
            fill="none" 
            stroke="currentColor" 
            stroke-width="2"
          >
            <polyline points="6 9 12 15 18 9"></polyline>
          </svg>
        </button>
        <div 
          class="referral-faq-answer"
          x-show="open"
          x-collapse
        >
          <p>
            {{ __('Contactez le support avec l\'email du proche invité (ou une capture). Nous vérifierons l\'attribution du lien et l\'éligibilité.') }}
          </p>
        </div>
      </div>
    </div>
  </div>
</section>

<script>
  function faqAccordion() {
    return {
      init() {
        // Alpine.js pour l'accordéon FAQ
      }
    }
  }
</script>

