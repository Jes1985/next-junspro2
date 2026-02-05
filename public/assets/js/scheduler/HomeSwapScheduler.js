/**
 * HomeSwapScheduler - Mode C pour /services/homeswap
 * Sélection de période (date range) + flexibilité + 2 périodes optionnelles
 */

class HomeSwapScheduler {
  constructor(containerId, options = {}) {
    this.container = document.getElementById(containerId);
    if (!this.container) {
      console.error(`Container #${containerId} not found`);
      return;
    }

    this.freelancerId = options.freelancerId;
    this.config = options.config || {};
    
    this.state = {
      period1: { start: null, end: null },
      period2: { start: null, end: null },
      flexible: false,
      showPeriod2: false
    };

    this.init();
  }

  async init() {
    // Charger le contexte depuis l'API
    await this.loadContext();
    
    // Rendre le UI
    this.render();
  }

  /**
   * Charge le contexte depuis l'API
   */
  async loadContext() {
    try {
      const response = await fetch(`/api/scheduler/homeswap/context?freelancer_id=${this.freelancerId}`, {
        headers: {
          'Accept': 'application/json',
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content')
        }
      });

      if (response.ok) {
        const data = await response.json();
        this.context = data;
      } else {
        // Fallback avec données mock
        this.context = this.getMockContext();
      }
    } catch (error) {
      console.warn('API error, using mock data:', error);
      this.context = this.getMockContext();
    }
  }

  /**
   * Données mock pour le contexte HomeSwap
   */
  getMockContext() {
    return {
      disabledDates: [],
      minNights: 2,
      maxNights: 180
    };
  }

  /**
   * Rend le UI complet
   */
  render() {
    this.container.innerHTML = this.getHTML();
    this.attachEventListeners();
    this.updateRecap();
  }

  /**
   * Génère le HTML du scheduler
   */
  getHTML() {
    return `
      <div class="scheduler-homeswap-wrapper">
        <!-- Header -->
        <div class="scheduler-homeswap-header">
          <h1 class="scheduler-homeswap-title">Choisir votre période d'échange</h1>
          <p class="scheduler-homeswap-subtitle">Proposez une période, l'hôte confirme.</p>
        </div>

        <!-- Layout 2 colonnes -->
        <div class="scheduler-homeswap-layout">
          <!-- Colonne gauche : Sélection -->
          <div class="scheduler-homeswap-selection">
            <!-- Période 1 -->
            <div class="scheduler-period-section">
              <h3 class="scheduler-period-title">Période 1</h3>
              
              <div class="scheduler-date-range">
                <div class="scheduler-date-field">
                  <label>Date d'arrivée</label>
                  <input 
                    type="date" 
                    id="period1-start"
                    class="scheduler-date-input"
                    min="${this.getMinDate()}"
                    required>
                </div>
                
                <div class="scheduler-date-field">
                  <label>Date de départ</label>
                  <input 
                    type="date" 
                    id="period1-end"
                    class="scheduler-date-input"
                    min="${this.getMinDate()}"
                    required>
                </div>
              </div>
            </div>

            <!-- Toggle Flexibilité -->
            <div class="scheduler-flexibility-toggle">
              <label class="scheduler-toggle-label">
                <input 
                  type="checkbox" 
                  id="flexible-toggle"
                  ${this.state.flexible ? 'checked' : ''}>
                <span>Flexible ± 3 jours</span>
              </label>
            </div>

            <!-- Option période 2 -->
            <div class="scheduler-period2-option">
              <button 
                type="button"
                class="scheduler-add-period-btn"
                id="add-period2-btn"
                onclick="window.homeSwapSchedulerInstance?.togglePeriod2()">
                ${this.state.showPeriod2 ? 'Masquer la 2e période' : 'Proposer 2 périodes'}
              </button>
            </div>

            <!-- Période 2 (si activée) -->
            ${this.state.showPeriod2 ? `
              <div class="scheduler-period-section" id="period2-section">
                <h3 class="scheduler-period-title">Période 2</h3>
                
                <div class="scheduler-date-range">
                  <div class="scheduler-date-field">
                    <label>Date d'arrivée</label>
                    <input 
                      type="date" 
                      id="period2-start"
                      class="scheduler-date-input"
                      min="${this.getMinDate()}">
                  </div>
                  
                  <div class="scheduler-date-field">
                    <label>Date de départ</label>
                    <input 
                      type="date" 
                      id="period2-end"
                      class="scheduler-date-input"
                      min="${this.getMinDate()}">
                  </div>
                </div>
              </div>
            ` : ''}

            <!-- Micro-copy -->
            <div class="scheduler-homeswap-info">
              <p>Une fois confirmé, l'échange est verrouillé.</p>
            </div>
          </div>

          <!-- Colonne droite : Récap -->
          <div class="scheduler-homeswap-recap">
            ${this.renderRecap()}
          </div>
        </div>
      </div>
    `;
  }

  /**
   * Récap panneau de droite
   */
  renderRecap() {
    return `
      <div class="scheduler-recap-card">
        <h3 class="scheduler-recap-title">Récapitulatif</h3>
        
        <div class="scheduler-recap-section">
          <div class="scheduler-recap-label">Période 1</div>
          <div class="scheduler-recap-value" id="recap-period1">Non définie</div>
        </div>
        
        <div class="scheduler-recap-section">
          <div class="scheduler-recap-label">Flexible</div>
          <div class="scheduler-recap-value" id="recap-flexible">Non</div>
        </div>
        
        ${this.state.showPeriod2 ? `
          <div class="scheduler-recap-section">
            <div class="scheduler-recap-label">Période 2</div>
            <div class="scheduler-recap-value" id="recap-period2">Non définie</div>
          </div>
        ` : ''}
        
        <button 
          class="scheduler-recap-cta" 
          id="homeswap-submit-btn"
          ${this.canSubmit() ? '' : 'disabled'}
          onclick="window.homeSwapSchedulerInstance?.submitRequest()">
          Envoyer la demande
        </button>
      </div>
    `;
  }

  /**
   * Attache les event listeners
   */
  attachEventListeners() {
    // Date inputs période 1
    const period1Start = document.getElementById('period1-start');
    const period1End = document.getElementById('period1-end');
    
    if (period1Start) {
      period1Start.addEventListener('change', (e) => {
        this.state.period1.start = e.target.value;
        if (period1End) {
          period1End.min = e.target.value;
        }
        this.updateRecap();
      });
    }

    if (period1End) {
      period1End.addEventListener('change', (e) => {
        this.state.period1.end = e.target.value;
        this.updateRecap();
      });
    }

    // Date inputs période 2
    const period2Start = document.getElementById('period2-start');
    const period2End = document.getElementById('period2-end');
    
    if (period2Start) {
      period2Start.addEventListener('change', (e) => {
        this.state.period2.start = e.target.value;
        if (period2End) {
          period2End.min = e.target.value;
        }
        this.updateRecap();
      });
    }

    if (period2End) {
      period2End.addEventListener('change', (e) => {
        this.state.period2.end = e.target.value;
        this.updateRecap();
      });
    }

    // Toggle flexibilité
    const flexibleToggle = document.getElementById('flexible-toggle');
    if (flexibleToggle) {
      flexibleToggle.addEventListener('change', (e) => {
        this.state.flexible = e.target.checked;
        this.updateRecap();
      });
    }
  }

  /**
   * Toggle période 2
   */
  togglePeriod2() {
    this.state.showPeriod2 = !this.state.showPeriod2;
    this.render();
  }

  /**
   * Met à jour le récap
   */
  updateRecap() {
    const period1El = document.getElementById('recap-period1');
    const flexibleEl = document.getElementById('recap-flexible');
    const period2El = document.getElementById('recap-period2');
    const submitBtn = document.getElementById('homeswap-submit-btn');

    if (period1El) {
      if (this.state.period1.start && this.state.period1.end) {
        period1El.textContent = `${this.formatDate(this.state.period1.start)} → ${this.formatDate(this.state.period1.end)}`;
      } else {
        period1El.textContent = 'Non définie';
      }
    }

    if (flexibleEl) {
      flexibleEl.textContent = this.state.flexible ? 'Oui (± 3 jours)' : 'Non';
    }

    if (period2El && this.state.showPeriod2) {
      if (this.state.period2.start && this.state.period2.end) {
        period2El.textContent = `${this.formatDate(this.state.period2.start)} → ${this.formatDate(this.state.period2.end)}`;
      } else {
        period2El.textContent = 'Non définie';
      }
    }

    if (submitBtn) {
      submitBtn.disabled = !this.canSubmit();
    }
  }

  /**
   * Formate une date
   */
  formatDate(dateString) {
    if (!dateString) return '';
    const date = new Date(dateString);
    const dayNames = ['Dim', 'Lun', 'Mar', 'Mer', 'Jeu', 'Ven', 'Sam'];
    const monthNames = ['jan', 'fév', 'mar', 'avr', 'mai', 'jun', 'jul', 'aoû', 'sep', 'oct', 'nov', 'déc'];
    
    const day = dayNames[date.getDay()];
    const dayNum = date.getDate();
    const month = monthNames[date.getMonth()];
    
    return `${day} ${dayNum} ${month}`;
  }

  /**
   * Retourne la date minimum (aujourd'hui)
   */
  getMinDate() {
    const today = new Date();
    return today.toISOString().split('T')[0];
  }

  /**
   * Vérifie si on peut soumettre
   */
  canSubmit() {
    if (!this.state.period1.start || !this.state.period1.end) return false;
    
    // Vérifier durée minimum
    const start = new Date(this.state.period1.start);
    const end = new Date(this.state.period1.end);
    const nights = Math.ceil((end - start) / (1000 * 60 * 60 * 24));
    
    if (nights < this.context.minNights) return false;
    if (nights > this.context.maxNights) return false;

    // Si période 2 activée, elle doit être complète aussi
    if (this.state.showPeriod2) {
      if (!this.state.period2.start || !this.state.period2.end) return false;
    }

    return true;
  }

  /**
   * Soumet la demande
   */
  async submitRequest() {
    if (!this.canSubmit()) return;

    const submitBtn = document.getElementById('homeswap-submit-btn');
    if (submitBtn) {
      submitBtn.disabled = true;
      submitBtn.textContent = 'Envoi en cours...';
    }

    try {
      const response = await fetch('/api/scheduler/homeswap/request', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'Accept': 'application/json',
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content')
        },
        body: JSON.stringify({
          freelancer_id: this.freelancerId,
          period1: this.state.period1,
          period2: this.state.showPeriod2 ? this.state.period2 : null,
          flexible: this.state.flexible
        })
      });

      const data = await response.json();

      if (data.ok || data.success) {
        alert('Demande envoyée avec succès !');
        window.location.href = '/user/dashboard';
      } else {
        alert(data.message || 'Une erreur est survenue');
        if (submitBtn) {
          submitBtn.disabled = false;
          submitBtn.textContent = 'Envoyer la demande';
        }
      }
    } catch (error) {
      console.error('Error submitting request:', error);
      alert('Une erreur est survenue lors de l\'envoi de la demande.');
      if (submitBtn) {
        submitBtn.disabled = false;
        submitBtn.textContent = 'Envoyer la demande';
      }
    }
  }
}

// Export global
if (typeof window !== 'undefined') {
  window.HomeSwapScheduler = HomeSwapScheduler;
}

