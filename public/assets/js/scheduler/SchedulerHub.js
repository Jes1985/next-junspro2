/**
 * SchedulerHub - Point d'entrée unique pour tous les schedulers
 * Détecte l'univers et charge le bon scheduler (A/B/C)
 */

class SchedulerHub {
  constructor(containerId, options = {}) {
    this.container = document.getElementById(containerId);
    if (!this.container) {
      console.error(`Container #${containerId} not found`);
      return;
    }

    this.universeType = options.universeType || this.detectUniverseType();
    this.freelancerId = options.freelancerId || null;
    this.config = options.config || {};

    this.init();
  }

  /**
   * Détecte l'univers depuis l'URL ou data-attribute
   */
  detectUniverseType() {
    // Vérifier data-attribute
    const dataUniverse = this.container?.getAttribute('data-universe');
    if (dataUniverse) {
      return dataUniverse;
    }

    // Détecter depuis l'URL
    const path = window.location.pathname;
    if (path.includes('/services/projects')) return 'projects';
    if (path.includes('/services/homeswap')) return 'homeswap';
    if (path.includes('/services/lessons')) return 'lessons';
    if (path.includes('/services/wellnesslive')) return 'wellnesslive';
    if (path.includes('/services/at-home')) return 'at-home';
    if (path.includes('/services/corporate')) return 'corporate';

    // Par défaut, Mode A (scheduler existant)
    return 'lessons';
  }

  /**
   * Initialise le bon scheduler selon l'univers
   */
  init() {
    const mode = this.getMode();
    
    switch (mode) {
      case 'B': // Projects
        this.loadProjectScheduler();
        break;
      case 'C': // HomeSwap
        this.loadHomeSwapScheduler();
        break;
      case 'A': // SessionScheduler (existant)
      default:
        // Le scheduler existant est déjà chargé via booking-scripts.blade.php
        // On ajoute juste un micro-bloc info dynamique si besoin
        this.addUniverseInfo();
        break;
    }
  }

  /**
   * Détermine le mode selon l'univers
   */
  getMode() {
    const modeMap = {
      'projects': 'B',
      'homeswap': 'C',
      'lessons': 'A',
      'wellnesslive': 'A',
      'at-home': 'A',
      'corporate': 'A'
    };
    return modeMap[this.universeType] || 'A';
  }

  /**
   * Charge le ProjectScheduler (Mode B)
   */
  loadProjectScheduler() {
    // Masquer le scheduler existant
    const existingScheduler = this.container.querySelector('.booking-container');
    if (existingScheduler) {
      existingScheduler.style.display = 'none';
    }

    // Créer le container pour ProjectScheduler
    const projectContainer = document.createElement('div');
    projectContainer.id = 'project-scheduler-container';
    projectContainer.className = 'scheduler-container';
    this.container.appendChild(projectContainer);

    // Attendre que ProjectScheduler soit chargé
    const checkProjectScheduler = setInterval(() => {
      if (typeof ProjectScheduler !== 'undefined') {
        clearInterval(checkProjectScheduler);
        const scheduler = new ProjectScheduler('project-scheduler-container', {
          freelancerId: this.freelancerId,
          ...this.config
        });
        window.projectSchedulerInstance = scheduler;
      }
    }, 100);

    // Timeout après 5 secondes
    setTimeout(() => {
      clearInterval(checkProjectScheduler);
      if (typeof ProjectScheduler === 'undefined') {
        console.error('ProjectScheduler not loaded');
      }
    }, 5000);
  }

  /**
   * Charge le HomeSwapScheduler (Mode C)
   */
  loadHomeSwapScheduler() {
    // Masquer le scheduler existant
    const existingScheduler = this.container.querySelector('.booking-container');
    if (existingScheduler) {
      existingScheduler.style.display = 'none';
    }

    // Créer le container pour HomeSwapScheduler
    const homeswapContainer = document.createElement('div');
    homeswapContainer.id = 'homeswap-scheduler-container';
    homeswapContainer.className = 'scheduler-container';
    this.container.appendChild(homeswapContainer);

    // Attendre que HomeSwapScheduler soit chargé
    const checkHomeSwapScheduler = setInterval(() => {
      if (typeof HomeSwapScheduler !== 'undefined') {
        clearInterval(checkHomeSwapScheduler);
        const scheduler = new HomeSwapScheduler('homeswap-scheduler-container', {
          freelancerId: this.freelancerId,
          ...this.config
        });
        window.homeSwapSchedulerInstance = scheduler;
      }
    }, 100);

    // Timeout après 5 secondes
    setTimeout(() => {
      clearInterval(checkHomeSwapScheduler);
      if (typeof HomeSwapScheduler === 'undefined') {
        console.error('HomeSwapScheduler not loaded');
      }
    }, 5000);
  }

  /**
   * Ajoute un micro-bloc info dynamique selon l'univers (Mode A uniquement)
   */
  addUniverseInfo() {
    const infoTexts = {
      'lessons': 'Annulez ou reprogrammez gratuitement jusqu\'à 12h avant.',
      'wellnesslive': 'Live 1-1 : annulation possible jusqu\'à 12h avant. Live groupe : places limitées — annulation possible, reprogrammation non disponible.',
      'at-home': 'Déplacement inclus — merci d\'anticiper.',
      'corporate': 'Planning optimisé pour l\'équipe.'
    };

    const infoText = infoTexts[this.universeType];
    if (!infoText) return;

    // Chercher le bloc info existant et le mettre à jour
    const existingInfo = this.container.querySelector('.booking-info-block');
    if (existingInfo) {
      const infoParagraph = existingInfo.querySelector('p');
      if (infoParagraph) {
        infoParagraph.textContent = infoText;
      }
    }
  }
}

// Export pour utilisation globale
if (typeof window !== 'undefined') {
  window.SchedulerHub = SchedulerHub;
}

