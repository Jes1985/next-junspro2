/**
 * ProjectScheduler - Mode B pour /services/projects
 * Flow: Kickoff + Cadence + Timeline jalons
 */

class ProjectScheduler {
  constructor(containerId, options = {}) {
    this.container = document.getElementById(containerId);
    if (!this.container) {
      console.error(`Container #${containerId} not found`);
      return;
    }

    this.freelancerId = options.freelancerId;
    this.config = options.config || {};
    
    this.state = {
      step: 1, // 1: Kickoff, 2: Cadence, 3: Timeline
      selectedKickoffSlot: null,
      selectedCadence: null,
      milestones: []
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
      const response = await fetch(`/api/scheduler/projects/context?freelancer_id=${this.freelancerId}`, {
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
   * Données mock pour le contexte Projects
   */
  getMockContext() {
    const now = new Date();
    const tomorrow = new Date(now);
    tomorrow.setDate(tomorrow.getDate() + 1);
    tomorrow.setHours(10, 0, 0, 0);

    const slots = [];
    for (let i = 0; i < 6; i++) {
      const slotDate = new Date(tomorrow);
      slotDate.setDate(slotDate.getDate() + i);
      slotDate.setHours(10 + (i % 3) * 2, 0, 0, 0);
      
      slots.push({
        start: slotDate.toISOString(),
        end: new Date(slotDate.getTime() + 50 * 60000).toISOString(),
        label: this.formatSlotLabel(slotDate)
      });
    }

    return {
      kickoffSlots: slots,
      defaultMilestones: [
        { id: 1, name: 'Validation brief', order: 1 },
        { id: 2, name: '1ère proposition', order: 2 },
        { id: 3, name: 'Révisions', order: 3 },
        { id: 4, name: 'Livraison', order: 4 }
      ],
      cadencePresets: [
        { id: 'express', label: 'Express (3–5 jours)', days: 4 },
        { id: 'standard', label: 'Standard (1–2 semaines)', days: 10 },
        { id: 'confort', label: 'Confort (2–4 semaines)', days: 21 }
      ]
    };
  }

  /**
   * Formate un label de créneau
   */
  formatSlotLabel(date) {
    const dayNames = ['Dim', 'Lun', 'Mar', 'Mer', 'Jeu', 'Ven', 'Sam'];
    const monthNames = ['jan', 'fév', 'mar', 'avr', 'mai', 'jun', 'jul', 'aoû', 'sep', 'oct', 'nov', 'déc'];
    
    const day = dayNames[date.getDay()];
    const dayNum = date.getDate();
    const month = monthNames[date.getMonth()];
    const hours = String(date.getHours()).padStart(2, '0');
    const minutes = String(date.getMinutes()).padStart(2, '0');
    
    return `${day} ${dayNum} ${month} à ${hours}:${minutes}`;
  }

  /**
   * Rend le UI complet
   */
  render() {
    this.container.innerHTML = this.getHTML();
    this.attachEventListeners();
    this.updateTimeline();
  }

  /**
   * Génère le HTML du scheduler
   */
  getHTML() {
    return `
      <div class="scheduler-project-wrapper">
        <!-- Header -->
        <div class="scheduler-project-header">
          <h1 class="scheduler-project-title">Planifier votre projet</h1>
          <p class="scheduler-project-subtitle">Lancez le projet et gardez une cadence.</p>
        </div>

        <!-- Layout 2 colonnes -->
        <div class="scheduler-project-layout">
          <!-- Colonne gauche : Flow -->
          <div class="scheduler-project-flow">
            ${this.renderStep1()}
            ${this.renderStep2()}
            ${this.renderStep3()}
          </div>

          <!-- Colonne droite : Récap -->
          <div class="scheduler-project-recap">
            ${this.renderRecap()}
          </div>
        </div>
      </div>
    `;
  }

  /**
   * Étape 1 : Kickoff
   */
  renderStep1() {
    const slots = this.context?.kickoffSlots || [];
    
    return `
      <div class="scheduler-step scheduler-step-${this.state.step >= 1 ? 'active' : 'pending'}" data-step="1">
        <div class="scheduler-step-header">
          <div class="scheduler-step-number">1</div>
          <div class="scheduler-step-content">
            <h3 class="scheduler-step-title">Kickoff (50 min)</h3>
            <p class="scheduler-step-micro">50 min focus pour cadrer, décider, lancer.</p>
          </div>
        </div>
        
        <div class="scheduler-kickoff-slots">
          ${slots.map((slot, index) => `
            <button 
              class="scheduler-kickoff-slot ${this.state.selectedKickoffSlot === slot.start ? 'selected' : ''}"
              data-slot-start="${slot.start}"
              data-slot-end="${slot.end}">
              ${slot.label}
            </button>
          `).join('')}
        </div>
        
        ${this.state.selectedKickoffSlot ? `
          <button class="scheduler-step-cta" onclick="window.projectSchedulerInstance?.validateKickoff()">
            Valider le kickoff
          </button>
        ` : ''}
      </div>
    `;
  }

  /**
   * Étape 2 : Cadence
   */
  renderStep2() {
    const presets = this.context?.cadencePresets || [];
    
    return `
      <div class="scheduler-step scheduler-step-${this.state.step >= 2 ? 'active' : 'pending'}" data-step="2" style="display: ${this.state.step >= 2 ? 'block' : 'none'};">
        <div class="scheduler-step-header">
          <div class="scheduler-step-number">2</div>
          <div class="scheduler-step-content">
            <h3 class="scheduler-step-title">Cadence</h3>
            <p class="scheduler-step-micro">Choisissez un rythme, on s'y tient.</p>
          </div>
        </div>
        
        <div class="scheduler-cadence-chips">
          ${presets.map(preset => `
            <button 
              class="scheduler-cadence-chip ${this.state.selectedCadence === preset.id ? 'active' : ''}"
              data-cadence="${preset.id}"
              data-days="${preset.days}">
              ${preset.label}
            </button>
          `).join('')}
        </div>
      </div>
    `;
  }

  /**
   * Étape 3 : Timeline
   */
  renderStep3() {
    return `
      <div class="scheduler-step scheduler-step-${this.state.step >= 3 ? 'active' : 'pending'}" data-step="3" style="display: ${this.state.step >= 3 ? 'block' : 'none'};">
        <div class="scheduler-step-header">
          <div class="scheduler-step-number">3</div>
          <div class="scheduler-step-content">
            <h3 class="scheduler-step-title">Timeline jalons</h3>
            <p class="scheduler-step-micro">Dates estimées selon votre cadence.</p>
          </div>
        </div>
        
        <div class="scheduler-timeline" id="project-timeline">
          <!-- Généré dynamiquement -->
        </div>
        
        <div class="scheduler-anti-procrastination-info">
          <p>Cadence protégée : report unique (freelance) de 24 à 72h pour garder votre projet en mouvement.</p>
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
          <div class="scheduler-recap-label">Kickoff</div>
          <div class="scheduler-recap-value" id="recap-kickoff">Non sélectionné</div>
        </div>
        
        <div class="scheduler-recap-section">
          <div class="scheduler-recap-label">Cadence</div>
          <div class="scheduler-recap-value" id="recap-cadence">Non sélectionnée</div>
        </div>
        
        <div class="scheduler-recap-section">
          <div class="scheduler-recap-label">Livraison estimée</div>
          <div class="scheduler-recap-value" id="recap-delivery">—</div>
        </div>
        
        <button 
          class="scheduler-recap-cta" 
          id="project-launch-btn"
          ${this.canLaunch() ? '' : 'disabled'}
          onclick="window.projectSchedulerInstance?.launchProject()">
          Lancer le projet
        </button>
      </div>
    `;
  }

  /**
   * Attache les event listeners
   */
  attachEventListeners() {
    // Sélection kickoff
    this.container.querySelectorAll('.scheduler-kickoff-slot').forEach(btn => {
      btn.addEventListener('click', (e) => {
        const start = btn.dataset.slotStart;
        this.selectKickoffSlot(start);
      });
    });

    // Sélection cadence
    this.container.querySelectorAll('.scheduler-cadence-chip').forEach(btn => {
      btn.addEventListener('click', (e) => {
        const cadence = btn.dataset.cadence;
        this.selectCadence(cadence);
      });
    });
  }

  /**
   * Sélectionne un créneau kickoff
   */
  selectKickoffSlot(slotStart) {
    this.state.selectedKickoffSlot = slotStart;
    this.render();
  }

  /**
   * Valide le kickoff et passe à l'étape 2
   */
  validateKickoff() {
    if (!this.state.selectedKickoffSlot) return;
    this.state.step = 2;
    this.render();
    this.updateRecap();
  }

  /**
   * Sélectionne une cadence
   */
  selectCadence(cadenceId) {
    this.state.selectedCadence = cadenceId;
    this.state.step = 3;
    this.updateTimeline();
    this.render();
    this.updateRecap();
  }

  /**
   * Met à jour la timeline avec les dates estimées
   */
  updateTimeline() {
    if (!this.state.selectedKickoffSlot || !this.state.selectedCadence) return;

    const kickoffDate = new Date(this.state.selectedKickoffSlot);
    const cadencePreset = this.context.cadencePresets.find(p => p.id === this.state.selectedCadence);
    if (!cadencePreset) return;

    const milestones = this.context.defaultMilestones;
    const totalDays = cadencePreset.days;
    const daysPerMilestone = Math.floor(totalDays / milestones.length);

    this.state.milestones = milestones.map((milestone, index) => {
      const milestoneDate = new Date(kickoffDate);
      milestoneDate.setDate(milestoneDate.getDate() + (index + 1) * daysPerMilestone);
      
      return {
        ...milestone,
        estimatedDate: milestoneDate,
        completed: index === 0 // Kickoff toujours complété
      };
    });

    // Rendre la timeline
    const timelineContainer = this.container.querySelector('#project-timeline');
    if (timelineContainer) {
      timelineContainer.innerHTML = this.renderTimelineItems();
    }
  }

  /**
   * Rend les items de timeline
   */
  renderTimelineItems() {
    const kickoffDate = new Date(this.state.selectedKickoffSlot);
    
    return `
      <div class="scheduler-timeline-item completed">
        <div class="scheduler-timeline-marker">✓</div>
        <div class="scheduler-timeline-content">
          <div class="scheduler-timeline-title">Kickoff</div>
          <div class="scheduler-timeline-date">${this.formatDate(kickoffDate)}</div>
        </div>
      </div>
      ${this.state.milestones.map(milestone => `
        <div class="scheduler-timeline-item ${milestone.completed ? 'completed' : 'pending'}">
          <div class="scheduler-timeline-marker">${milestone.order}</div>
          <div class="scheduler-timeline-content">
            <div class="scheduler-timeline-title">${milestone.name}</div>
            <div class="scheduler-timeline-date">${this.formatDate(milestone.estimatedDate)}</div>
          </div>
        </div>
      `).join('')}
    `;
  }

  /**
   * Formate une date
   */
  formatDate(date) {
    const dayNames = ['Dim', 'Lun', 'Mar', 'Mer', 'Jeu', 'Ven', 'Sam'];
    const monthNames = ['jan', 'fév', 'mar', 'avr', 'mai', 'jun', 'jul', 'aoû', 'sep', 'oct', 'nov', 'déc'];
    
    const day = dayNames[date.getDay()];
    const dayNum = date.getDate();
    const month = monthNames[date.getMonth()];
    
    return `${day} ${dayNum} ${month}`;
  }

  /**
   * Met à jour le récap
   */
  updateRecap() {
    const kickoffEl = document.getElementById('recap-kickoff');
    const cadenceEl = document.getElementById('recap-cadence');
    const deliveryEl = document.getElementById('recap-delivery');
    const launchBtn = document.getElementById('project-launch-btn');

    if (kickoffEl) {
      if (this.state.selectedKickoffSlot) {
        const date = new Date(this.state.selectedKickoffSlot);
        kickoffEl.textContent = this.formatSlotLabel(date);
      } else {
        kickoffEl.textContent = 'Non sélectionné';
      }
    }

    if (cadenceEl) {
      if (this.state.selectedCadence) {
        const preset = this.context.cadencePresets.find(p => p.id === this.state.selectedCadence);
        cadenceEl.textContent = preset ? preset.label : 'Non sélectionnée';
      } else {
        cadenceEl.textContent = 'Non sélectionnée';
      }
    }

    if (deliveryEl) {
      if (this.state.milestones.length > 0) {
        const lastMilestone = this.state.milestones[this.state.milestones.length - 1];
        deliveryEl.textContent = this.formatDate(lastMilestone.estimatedDate);
      } else {
        deliveryEl.textContent = '—';
      }
    }

    if (launchBtn) {
      launchBtn.disabled = !this.canLaunch();
    }
  }

  /**
   * Vérifie si on peut lancer le projet
   */
  canLaunch() {
    return this.state.selectedKickoffSlot && this.state.selectedCadence && this.state.milestones.length > 0;
  }

  /**
   * Lance le projet
   */
  async launchProject() {
    if (!this.canLaunch()) return;

    const launchBtn = document.getElementById('project-launch-btn');
    if (launchBtn) {
      launchBtn.disabled = true;
      launchBtn.textContent = 'Lancement en cours...';
    }

    try {
      const response = await fetch('/api/scheduler/projects/confirm', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'Accept': 'application/json',
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content')
        },
        body: JSON.stringify({
          freelancer_id: this.freelancerId,
          kickoff_slot: this.state.selectedKickoffSlot,
          cadence: this.state.selectedCadence,
          milestones: this.state.milestones
        })
      });

      const data = await response.json();

      if (data.ok || data.success) {
        alert('Projet lancé avec succès !');
        window.location.href = '/user/dashboard';
      } else {
        alert(data.message || 'Une erreur est survenue');
        if (launchBtn) {
          launchBtn.disabled = false;
          launchBtn.textContent = 'Lancer le projet';
        }
      }
    } catch (error) {
      console.error('Error launching project:', error);
      alert('Une erreur est survenue lors du lancement du projet.');
      if (launchBtn) {
        launchBtn.disabled = false;
        launchBtn.textContent = 'Lancer le projet';
      }
    }
  }
}

// Export global
if (typeof window !== 'undefined') {
  window.ProjectScheduler = ProjectScheduler;
}

