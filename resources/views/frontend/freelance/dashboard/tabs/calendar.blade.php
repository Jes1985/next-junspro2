@php
  // Récupérer activeTab depuis les variables passées
  $currentActiveTab = $activeTab ?? 'calendar';
  
  // Obtenir le jour actuel
  $today = date('d');
  $currentDay = date('N'); // 1 (Lundi) à 7 (Dimanche)
  
  // Calculer les dates pour chaque jour de la semaine (lundi = jour 1)
  $mondayDate = date('d', strtotime('monday this week'));
  $tuesdayDate = date('d', strtotime('tuesday this week'));
  $wednesdayDate = date('d', strtotime('wednesday this week'));
  $thursdayDate = date('d', strtotime('thursday this week'));
  $fridayDate = date('d', strtotime('friday this week'));
  $saturdayDate = date('d', strtotime('saturday this week'));
  $sundayDate = date('d', strtotime('sunday this week'));
@endphp

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr@4.6.13/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr@4.6.13/dist/flatpickr.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr@4.6.13/dist/l10n/fr.js"></script>

<div class="calendar-page-wrapper-light">
  <div class="dashboard-container">
    <!-- ===== ZONE PRINCIPALE (70%) ===== -->
    <main class="main-content">
      <!-- Bloc Tableau de bord Freelance -->
      @include('frontend.freelance.dashboard.partials.dashboard-header-section', [
        'freelancerProfile' => $freelancerProfile ?? null
      ])

      <!-- Header de page -->
      <div class="page-header">
        <h1>Agenda</h1>
        <p class="page-subtitle">
          Gérez vos disponibilités et planifiez vos Rituels. Configurez vos créneaux horaires pour permettre aux clients de réserver directement.
        </p>
      </div>

      <!-- Contenu principal -->
      <div class="calendar-content" data-calendar-root>
        <!-- Section Disponibilités -->
        <div class="availability-section">
          <div class="section-header">
            <div>
              <h2 class="section-title">Disponibilités</h2>
              <p class="section-description">
                Définissez vos plages horaires disponibles pour permettre aux clients de réserver 
                des Rituels directement dans votre agenda.
              </p>
            </div>
            <div class="section-actions">
              <button type="button" class="timezone-chip" data-week-timezone data-open-tz aria-label="Changer de fuseau horaire">Fuseau chargé : —</button>
              <button type="button" class="btn-secondary" data-open-modal>
                ⚙️ Ajouter une disponibilité
              </button>
            </div>
          </div>

          <div class="week-controls">
            <button type="button" class="btn-ghost" data-week-nav="prev" aria-label="Semaine précédente">⟵</button>
            <div class="week-label">
              <div class="week-range" data-week-range>Semaine en cours</div>
              <div class="week-sub" data-week-sub>Synchronisé en temps réel</div>
            </div>
            <button type="button" class="btn-ghost" data-week-nav="next" aria-label="Semaine suivante">⟶</button>
          </div>

          <div class="calendar-grid" data-calendar-grid></div>
          <div class="calendar-empty" data-empty-state>
            <div class="empty-illustration">✨</div>
            <div class="empty-title">Aucun créneau cette semaine</div>
            <div class="empty-sub">Ajoutez vos premières disponibilités pour être réservable immédiatement.</div>
            <button type="button" class="btn-primary" data-open-modal>Ajouter un créneau</button>
          </div>

          <div class="calendar-loader" data-calendar-loader style="display: none;">Chargement des créneaux...</div>

          <!-- CTA Ajouter disponibilités -->
          <div class="calendar-cta">
            <button class="btn-primary" type="button" data-open-modal>
              <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M12 5v14M5 12h14"/>
              </svg>
              Ajouter des disponibilités
            </button>
          </div>
        </div>

        <!-- Section Visio -->
        <div class="visio-section">
          <div class="visio-header">
            <div class="visio-icon">🎥</div>
            <div>
              <h2 class="visio-title">Visio</h2>
              <p class="visio-description">
                Activez la visio quand vous en avez besoin : coaching, formation, appel Rituel. 
                Configurez une salle de visioconférence pour vos Rituels.
              </p>
            </div>
          </div>
          
          <button class="btn-primary" type="button">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <path d="M17 10l4-4m0 0l-4-4m4 4H7a4 4 0 000 8h10"/>
            </svg>
            Paramétrer la visio
          </button>
        </div>

        <!-- Modale de création / édition -->
        <div class="calendar-modal" data-calendar-modal style="display: none;">
          <div class="calendar-modal-dialog">
            <div class="calendar-modal-header">
              <div>
                <div class="modal-eyebrow">Disponibilités</div>
                <h3 class="modal-title" data-modal-title>Ajouter un créneau</h3>
              </div>
              <button type="button" class="modal-close" data-close-modal aria-label="Fermer">✕</button>
            </div>
            <form data-calendar-form>
              <input type="hidden" name="slot_id" data-slot-id>
              <div class="form-grid">
                <label class="form-field">
                  <span>Date</span>
                  <input type="date" name="date" required data-field-date>
                </label>
                <label class="form-field">
                  <span>Début</span>
                  <input type="time" name="start_time" required data-field-start>
                </label>
                <label class="form-field">
                  <span>Fin</span>
                  <input type="time" name="end_time" required data-field-end>
                </label>
                <label class="form-field">
                  <span>Statut</span>
                  <select name="status" data-field-status required>
                    <option value="available">Disponible</option>
                    <option value="unavailable">Indisponible</option>
                  </select>
                </label>
              </div>
              <div class="modal-helper">Les heures sont saisies dans votre fuseau horaire local.</div>
              <div class="modal-actions">
                <button type="button" class="btn-secondary" data-close-modal>Annuler</button>
                <div class="modal-actions-right">
                  <button type="button" class="btn-ghost" data-delete-slot style="display: none;">Supprimer</button>
                  <button type="submit" class="btn-primary" data-submit-slot>
                    <span data-submit-label>Enregistrer</span>
                  </button>
                </div>
              </div>
            </form>
          </div>
        </div>

        <!-- Modale fuseau horaire -->
        <div class="calendar-modal" data-tz-modal style="display: none;">
          <div class="calendar-modal-dialog" style="max-width: 420px;">
            <div class="calendar-modal-header">
              <div>
                <div class="modal-eyebrow">Fuseau horaire</div>
                <h3 class="modal-title">Choisir un fuseau</h3>
              </div>
              <button type="button" class="modal-close" data-close-tz aria-label="Fermer">✕</button>
            </div>
            <div class="form-grid" style="grid-template-columns: 1fr;">
              <label class="form-field">
                <span>Fuseau</span>
                <select data-tz-select></select>
              </label>
            </div>
            <div class="modal-helper">Les créneaux seront affichés dans ce fuseau, stockés en UTC côté serveur.</div>
            <div class="modal-actions" style="justify-content: flex-end;">
              <button type="button" class="btn-secondary" data-close-tz>Annuler</button>
              <button type="button" class="btn-primary" data-save-tz>Enregistrer</button>
            </div>
          </div>
        </div>

        <!-- Toasts -->
        <div class="toast-stack" data-toast-stack></div>
      </div>
    </main>

    {{-- Sidebar navigation supprimée : le contenu utilise toute la largeur --}}


  </div>
</div>

<style>
  /* ===== BLOC TABLEAU DE BORD FREELANCE ===== */
  .calendar-page-wrapper-light .dashboard-header {
    margin-bottom: 2rem;
    padding-bottom: 1.5rem;
    border-bottom: 1px solid rgba(0, 0, 0, 0.08);
    width: 100% !important;
    max-width: 100% !important;
    min-width: 100% !important;
  }

  .calendar-page-wrapper-light .dashboard-header h1 {
    font-size: 1.75rem;
    font-weight: 700;
    color: #111827;
    margin: 0 0 0.5rem 0;
    line-height: 1.2;
  }

  .calendar-page-wrapper-light .dashboard-header-subtitle {
    font-size: 0.95rem;
    color: #6b7280;
    margin-bottom: 1.25rem;
    line-height: 1.5;
  }

  .calendar-page-wrapper-light .dashboard-header-ctas {
    display: flex;
    gap: 0.75rem;
    flex-wrap: wrap;
  }

  .calendar-page-wrapper-light .btn-premium {
    padding: 0.625rem 1.25rem;
    font-size: 0.9rem;
    font-weight: 600;
    border-radius: 10px;
    border: none;
    cursor: pointer;
    transition: all 0.2s ease;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
  }

  .calendar-page-wrapper-light .btn-premium-primary {
    background: linear-gradient(135deg, #1e40af 0%, #4c1d95 50%, #7c3aed 100%);
    color: white;
    box-shadow: 0 4px 12px rgba(124, 58, 237, 0.3);
  }

  .calendar-page-wrapper-light .btn-premium-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(124, 58, 237, 0.4);
    color: white;
    text-decoration: none;
  }

  .calendar-page-wrapper-light .btn-premium-secondary {
    background: white;
    color: #1e40af;
    border: 2px solid #1e40af;
  }

  .calendar-page-wrapper-light .btn-premium-secondary:hover {
    background: #f8fafc;
    transform: translateY(-1px);
    color: #1e40af;
    text-decoration: none;
  }

  /* ===== RESET ET VARIABLES LIGHT ===== */
  .calendar-page-wrapper-light {
    --bg-primary: #FFFFFF;
    --bg-secondary: #F8FAFC;
    --bg-card: #FFFFFF;
    --text-primary: #1E293B;
    --text-secondary: #64748B;
    --text-tertiary: #94A3B8;
    --primary: #3B82F6;
    --primary-light: #60A5FA;
    --accent: #8B5CF6;
    --accent-light: #A78BFA;
    --border: #E2E8F0;
    --border-light: #F1F5F9;
    --success: #10B981;
    --warning: #F59E0B;
    --shadow-sm: 0 1px 3px rgba(0, 0, 0, 0.05);
    --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -1px rgba(0, 0, 0, 0.03);
    --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.05), 0 4px 6px -2px rgba(0, 0, 0, 0.02);
    --shadow-xl: 0 20px 25px -5px rgba(0, 0, 0, 0.05), 0 10px 10px -5px rgba(0, 0, 0, 0.01);
    --radius-sm: 8px;
    --radius-md: 12px;
    --radius-lg: 16px;
    --radius-xl: 20px;
    --radius-2xl: 24px;
  }
  
  .calendar-page-wrapper-light * {
    box-sizing: border-box;
  }
  
  .calendar-page-wrapper-light {
    font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
    background: linear-gradient(135deg, var(--bg-secondary) 0%, #FFFFFF 100%);
    color: var(--text-primary);
    min-height: auto;
    line-height: 1.5;
  }
  
  /* ===== STRUCTURE 70/30 LIGHT ===== */
  .calendar-page-wrapper-light {
    position: relative;
    width: 100%;
    min-height: auto;
    overflow-x: clip;
    padding: 0 10px !important; /* Marges latérales de 1cm (10px) à gauche ET à droite */
    box-sizing: border-box;
  }
  
  .calendar-page-wrapper-light .dashboard-container {
    display: block !important;
    grid-template-columns: unset !important;
    min-height: auto;
    max-width: none !important;
    width: 100% !important;
    margin: 0 !important;
    padding: 0 !important;
    background: transparent;
    box-shadow: none;
    box-sizing: border-box;
    gap: 0 !important;
    overflow-x: visible !important;
  }
  
  /* ===== ZONE PRINCIPALE (100%) - PLEINE LARGEUR ===== */
  .calendar-page-wrapper-light .main-content {
    padding: 2rem 0 !important;
    border-right: none !important;
    min-height: auto;
    background: transparent;
    box-sizing: border-box;
    overflow-x: visible !important;
    position: relative;
    max-width: 100% !important;
    width: 100% !important;
    min-width: 0 !important;
    display: flex;
    flex-direction: column;
  }
  
  /* ===== HERO HEADER - IDENTIQUE À OVERVIEW ===== */
  .calendar-page-wrapper-light .dashboard-overview-hero {
    position: relative !important; margin: 0 !important; margin-bottom: 3rem !important;
    padding: 0 !important; border: none !important; background: transparent !important;
    width: 100% !important; max-width: 100% !important; overflow: visible !important;
  }
  .calendar-page-wrapper-light .dashboard-overview-hero .hero-glow {
    position: absolute; top: -50px; left: 50%; transform: translateX(-50%);
    width: 800px; height: 600px;
    background: radial-gradient(circle at 30% 50%, rgba(124, 58, 237, 0.15) 0%, rgba(30, 64, 175, 0.1) 35%, transparent 80%);
    border-radius: 50%; filter: blur(100px); pointer-events: none; z-index: 0;
  }
  .calendar-page-wrapper-light .dashboard-overview-hero .hero-content {
    position: relative; z-index: 1; display: grid; grid-template-columns: 1fr 1fr;
    gap: 4rem; align-items: center; padding: 3rem 0; width: 100%; box-sizing: border-box;
  }
  .calendar-page-wrapper-light .dashboard-overview-hero .hero-text { display: flex; flex-direction: column; gap: 1.5rem; padding: 0; }
  .calendar-page-wrapper-light .dashboard-overview-hero .hero-title {
    font-size: 2.5rem; font-weight: 800; line-height: 1.2; color: #111827; margin: 0; letter-spacing: -0.02em;
    background: linear-gradient(135deg, #111827 0%, #374151 100%);
    -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;
  }
  .calendar-page-wrapper-light .dashboard-overview-hero .hero-subtitle { font-size: 1.125rem; line-height: 1.6; color: #6b7280; margin: 0; font-weight: 400; max-width: 550px; }
  .calendar-page-wrapper-light .dashboard-overview-hero .hero-ctas { display: flex; gap: 1rem; flex-wrap: wrap; margin-top: 0.5rem; }
  .calendar-page-wrapper-light .dashboard-overview-hero .btn-hero {
    padding: 1rem 1.75rem; font-size: 1rem; font-weight: 600; border-radius: 14px; border: none;
    cursor: pointer; transition: all 0.3s ease; text-decoration: none; display: inline-flex; align-items: center; gap: 0.5rem; font-family: inherit;
  }
  .calendar-page-wrapper-light .dashboard-overview-hero .btn-hero-primary { background: linear-gradient(135deg, #1e40af 0%, #4c1d95 50%, #7c3aed 100%); color: white; box-shadow: 0 10px 30px rgba(124, 58, 237, 0.25); }
  .calendar-page-wrapper-light .dashboard-overview-hero .btn-hero-primary:hover { transform: translateY(-3px); box-shadow: 0 15px 40px rgba(124, 58, 237, 0.35); color: white; text-decoration: none; }
  .calendar-page-wrapper-light .dashboard-overview-hero .btn-hero-secondary { background: white; color: #1e40af; border: 2px solid #1e40af; box-shadow: 0 4px 12px rgba(30, 64, 175, 0.1); }
  .calendar-page-wrapper-light .dashboard-overview-hero .btn-hero-secondary:hover { background: #f0f4ff; transform: translateY(-2px); box-shadow: 0 8px 20px rgba(30, 64, 175, 0.15); color: #1e40af; text-decoration: none; }
  .calendar-page-wrapper-light .dashboard-overview-hero .btn-text { display: inline; }
  .calendar-page-wrapper-light .dashboard-overview-hero .btn-icon { font-size: 1.2rem; display: inline-block; transition: transform 0.3s ease; }
  .calendar-page-wrapper-light .dashboard-overview-hero .btn-hero:hover .btn-icon { transform: translateX(3px); }
  .calendar-page-wrapper-light .dashboard-overview-hero .hero-hint { font-size: 0.9rem; color: #6b7280; margin: 0; margin-top: 0.5rem; font-weight: 500; }
  .calendar-page-wrapper-light .dashboard-overview-hero .hero-visual { display: flex; align-items: center; justify-content: center; padding: 2rem; }
  .calendar-page-wrapper-light .dashboard-overview-hero .hero-visual-card {
    position: relative; width: 100%; max-width: 350px; padding: 3rem 2rem;
    background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%); border: 1px solid #e2e8f0;
    border-radius: 24px; text-align: center; box-shadow: 0 20px 60px rgba(0,0,0,0.08); overflow: hidden;
  }
  .calendar-page-wrapper-light .dashboard-overview-hero .hero-visual-card::before {
    content: ''; position: absolute; top: 0; right: 0; width: 300px; height: 300px;
    background: radial-gradient(circle, rgba(124,58,237,0.1) 0%, transparent 70%);
    border-radius: 50%; transform: translate(100px, -100px);
  }
  .calendar-page-wrapper-light .dashboard-overview-hero .visual-badge {
    display: inline-block; padding: 0.5rem 1rem; background: linear-gradient(135deg, #ddd6fe 0%, #e9d5ff 100%);
    color: #6d28d9; font-size: 0.85rem; font-weight: 600; border-radius: 20px; margin-bottom: 1.5rem; position: relative; z-index: 1;
  }
  .calendar-page-wrapper-light .dashboard-overview-hero .visual-icon { font-size: 3.5rem; margin-bottom: 1rem; display: block; position: relative; z-index: 1; }
  .calendar-page-wrapper-light .dashboard-overview-hero .visual-text { font-size: 1.25rem; font-weight: 700; color: #111827; line-height: 1.5; margin: 0; position: relative; z-index: 1; }
  @media (max-width: 1024px) {
    .calendar-page-wrapper-light .dashboard-overview-hero .hero-content { grid-template-columns: 1fr; gap: 2.5rem; padding: 2.5rem 0; }
    .calendar-page-wrapper-light .dashboard-overview-hero .hero-title { font-size: 2rem; }
    .calendar-page-wrapper-light .dashboard-overview-hero .hero-visual-card { max-width: 280px; }
  }
  @media (max-width: 768px) {
    .calendar-page-wrapper-light .dashboard-overview-hero .hero-content { padding: 2rem 0; }
    .calendar-page-wrapper-light .dashboard-overview-hero .hero-title { font-size: 1.75rem; }
    .calendar-page-wrapper-light .dashboard-overview-hero .hero-ctas { flex-direction: column; }
    .calendar-page-wrapper-light .dashboard-overview-hero .btn-hero { width: 100%; justify-content: center; }
    .calendar-page-wrapper-light .dashboard-overview-hero .hero-visual-card { max-width: 250px; padding: 2rem 1.5rem; }
  }
  @media (max-width: 480px) {
    .calendar-page-wrapper-light .dashboard-overview-hero .hero-title { font-size: 1.5rem; }
    .calendar-page-wrapper-light .dashboard-overview-hero .btn-hero { padding: 0.875rem 1.5rem; font-size: 0.95rem; }
    .calendar-page-wrapper-light .dashboard-overview-hero .visual-icon { font-size: 2.5rem; }
  }

  /* ===== HEADER PREMIUM - CENTRÉ ===== */
  .calendar-page-wrapper-light .page-header {
    margin-bottom: 4rem;
    position: relative;
    max-width: 100% !important;
    width: 100% !important;
    min-width: 100% !important;
    box-sizing: border-box;
    padding-bottom: 2rem;
    padding-left: 0 !important;
    padding-right: 0 !important;
    margin-left: 0 !important;
    margin-right: 0 !important;
    border-bottom: 2.5px solid rgba(59, 130, 246, 0.2);
    text-align: center !important; /* Centrage du contenu */
  }
  
  .calendar-page-wrapper-light .page-header::after {
    content: '';
    position: absolute;
    bottom: -2.5px;
    left: 50%;
    transform: translateX(-50%);
    width: 120px;
    height: 4px;
    background: linear-gradient(90deg, #3B82F6 0%, #60A5FA 50%, #8B5CF6 100%);
    border-radius: 2px;
    box-shadow: 0 8px 20px rgba(59, 130, 246, 0.3);
  }
  
  .calendar-page-wrapper-light .page-header h1 {
    font-size: 3rem !important; /* 48px desktop - MÊME TAILLE QUE PRESTATIONS */
    font-weight: 900;
    margin-bottom: 1rem;
    background: linear-gradient(135deg, #1e40af 0%, #3B82F6 50%, #8B5CF6 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    letter-spacing: -0.03em;
    max-width: 100%;
    width: 100%;
    word-wrap: break-word;
    line-height: 1.1;
    text-align: center !important; /* Centrage du titre */
  }
  
  .calendar-page-wrapper-light .page-subtitle {
    color: var(--text-secondary);
    font-size: 1.25rem; /* 20px */
    max-width: 100%;
    width: 100%;
    line-height: 1.75;
    font-weight: 500;
    word-wrap: break-word;
    margin-top: 0.5rem;
    text-align: center !important; /* Centrage du sous-texte */
  }
  
  /* ===== CONTENU PRINCIPAL ===== */
  .calendar-page-wrapper-light .calendar-content {
    width: 100% !important;
    max-width: 100% !important;
    min-width: 100% !important;
    display: flex;
    flex-direction: column;
    gap: 2rem;
    padding: 0 !important;
    margin: 0 !important;
    box-sizing: border-box;
  }
  
  /* ===== SECTION DISPONIBILITÉS ULTRA PREMIUM ===== */
  .calendar-page-wrapper-light .availability-section {
    background: linear-gradient(135deg, #ffffff 0%, #f0f9ff 50%, #f8fafc 100%);
    border: 2.5px solid rgba(59, 130, 246, 0.25);
    box-shadow: 0 32px 80px rgba(59, 130, 246, 0.2), 0 12px 32px rgba(59, 130, 246, 0.12), inset 0 1px 0 rgba(255, 255, 255, 0.8);
    border-radius: 32px;
    padding: 2.5rem;
    width: 100% !important;
    max-width: 100% !important;
    min-width: 100% !important;
    box-sizing: border-box;
    transition: all 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
  }
  
  .calendar-page-wrapper-light .availability-section:hover {
    box-shadow: 0 40px 100px rgba(59, 130, 246, 0.3), 0 16px 48px rgba(59, 130, 246, 0.18), inset 0 1px 0 rgba(255, 255, 255, 0.9);
    border-color: rgba(59, 130, 246, 0.4);
  }
  
  .calendar-page-wrapper-light .section-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 1.5rem;
    flex-wrap: wrap;
    gap: 1rem;
  }
  
  .calendar-page-wrapper-light .section-title {
    font-size: 1.5rem;
    font-weight: 900;
    color: var(--text-primary);
    margin-bottom: 0.5rem;
    letter-spacing: -0.03em;
  }
  
  .calendar-page-wrapper-light .section-description {
    color: var(--text-secondary);
    margin-bottom: 0;
    line-height: 1.6;
    font-size: 1rem;
    font-weight: 500;
  }
  
  /* ===== BOUTONS ===== */
  .calendar-page-wrapper-light .btn-primary {
    background: linear-gradient(135deg, #3B82F6 0%, #60A5FA 100%);
    color: white;
    border: none;
    padding: 1rem 2rem;
    border-radius: 32px;
    font-weight: 700;
    cursor: pointer;
    display: inline-flex;
    align-items: center;
    gap: 0.75rem;
    transition: all 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
    font-size: 1rem;
    text-decoration: none;
    box-shadow: 0 12px 32px rgba(59, 130, 246, 0.3);
    letter-spacing: -0.02em;
  }
  
  .calendar-page-wrapper-light .btn-primary:hover {
    transform: translateY(-3px) scale(1.02);
    box-shadow: 0 20px 48px rgba(59, 130, 246, 0.4);
  }
  
  .calendar-page-wrapper-light .btn-secondary {
    background: var(--bg-primary);
    color: var(--text-primary);
    border: 1px solid var(--border);
    padding: 0.75rem 1.5rem;
    border-radius: var(--radius-md);
    font-weight: 500;
    cursor: pointer;
    transition: all 0.2s ease;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    font-size: 0.9rem;
  }
  
  .calendar-page-wrapper-light .btn-secondary:hover {
    border-color: var(--primary-light);
    background: var(--bg-secondary);
  }

  .calendar-page-wrapper-light .btn-ghost {
    background: transparent;
    color: var(--text-primary);
    border: 1px solid var(--border);
    padding: 0.65rem 0.9rem;
    border-radius: var(--radius-md);
    font-weight: 600;
    cursor: pointer;
    transition: all 0.2s ease;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 0.35rem;
    text-decoration: none;
  }

  .calendar-page-wrapper-light .btn-ghost:hover {
    color: var(--primary);
    border-color: var(--primary-light);
    box-shadow: var(--shadow-sm);
  }

  .calendar-page-wrapper-light .section-actions {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    flex-wrap: wrap;
  }

  .calendar-page-wrapper-light .timezone-chip {
    display: inline-flex;
    align-items: center;
    gap: 0.35rem;
    padding: 0.5rem 0.75rem;
    border-radius: var(--radius-md);
    background: var(--bg-secondary);
    border: 1px solid var(--border);
    color: var(--text-secondary);
    font-size: 0.9rem;
  }
  
  /* ===== GRID CALENDRIER ===== */
  .calendar-page-wrapper-light .week-controls {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 1rem;
    padding: 0.85rem 1rem;
    border: 1px solid var(--border);
    border-radius: var(--radius-lg);
    background: var(--bg-primary);
    box-shadow: var(--shadow-sm);
  }

  .calendar-page-wrapper-light .week-label {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 0.25rem;
    text-align: center;
  }

  .calendar-page-wrapper-light .week-range {
    font-weight: 700;
    color: var(--text-primary);
  }

  .calendar-page-wrapper-light .week-sub {
    font-size: 0.9rem;
    color: var(--text-tertiary);
  }

  .calendar-page-wrapper-light .calendar-grid {
    display: grid;
    grid-template-columns: repeat(7, minmax(0, 1fr));
    gap: 0.75rem;
    margin: 1.5rem 0 1rem;
    width: 100% !important;
    max-width: 100% !important;
    box-sizing: border-box;
    background: radial-gradient(circle at 10% 10%, rgba(59, 130, 246, 0.08), transparent 28%), radial-gradient(circle at 90% 15%, rgba(139, 92, 246, 0.1), transparent 32%);
    padding: 0.5rem;
    border-radius: var(--radius-lg);
  }

  .calendar-page-wrapper-light .calendar-day {
    background: linear-gradient(160deg, rgba(255, 255, 255, 0.92) 0%, rgba(247, 250, 255, 0.96) 100%);
    border: 1px solid rgba(59, 130, 246, 0.18);
    border-radius: var(--radius-lg);
    padding: 1.1rem;
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
    box-shadow: 0 18px 45px rgba(17, 24, 39, 0.08);
    min-height: 180px;
    max-height: 100%;
    position: relative;
    overflow: visible;
  }

  .calendar-page-wrapper-light .calendar-day.today {
    border: 1px solid var(--primary);
    box-shadow: 0 20px 50px rgba(59, 130, 246, 0.18);
  }

  .calendar-page-wrapper-light .calendar-day::after {
    content: '';
    position: absolute;
    inset: 0;
    background: radial-gradient(circle at 75% 20%, rgba(59, 130, 246, 0.12), transparent 40%);
    pointer-events: none;
  }

  .calendar-page-wrapper-light .day-head {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 0.5rem;
  }

  .calendar-page-wrapper-light .day-name {
    font-weight: 600;
    color: var(--text-tertiary);
    text-transform: uppercase;
    font-size: 0.85rem;
  }

  .calendar-page-wrapper-light .day-number {
    font-size: 1.4rem;
    font-weight: 700;
    color: var(--text-primary);
  }

  .calendar-page-wrapper-light .slots-stack {
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
    margin-top: 0.35rem;
    flex: 1;
    min-height: 0;
    overflow-y: auto;
    overflow-x: hidden;
    padding-right: 0.25rem;
  }

  .calendar-page-wrapper-light .slots-stack::-webkit-scrollbar {
    width: 6px;
  }

  .calendar-page-wrapper-light .slots-stack::-webkit-scrollbar-track {
    background: transparent;
  }

  .calendar-page-wrapper-light .slots-stack::-webkit-scrollbar-thumb {
    background: rgba(59, 130, 246, 0.3);
    border-radius: 3px;
  }

  .calendar-page-wrapper-light .slots-stack::-webkit-scrollbar-thumb:hover {
    background: rgba(59, 130, 246, 0.5);
  }

  .calendar-page-wrapper-light .slot-pill {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 0.5rem;
    padding: 0.65rem 0.8rem;
    border-radius: var(--radius-md);
    border: 1.5px solid var(--border);
    background: var(--bg-secondary);
    cursor: pointer;
    transition: all 0.2s ease;
    flex-shrink: 0;
    min-height: 40px;
  }

  .calendar-page-wrapper-light .slot-pill:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 16px rgba(59, 130, 246, 0.15);
    border-color: var(--primary-light);
    background: rgba(255, 255, 255, 0.8);
  }

  .calendar-page-wrapper-light .slot-pill .slot-time {
    font-weight: 700;
    color: var(--text-primary);
    font-size: 0.92rem;
    flex: 0 0 auto;
  }

  .calendar-page-wrapper-light .slot-pill .slot-meta {
    font-size: 0.82rem;
    color: var(--text-tertiary);
    font-weight: 600;
    text-align: right;
    flex: 0 0 auto;
  }

  .calendar-page-wrapper-light .slot-pill.status-available {
    border-color: rgba(16, 185, 129, 0.4);
    background: rgba(16, 185, 129, 0.12);
    color: #047857;
  }

  .calendar-page-wrapper-light .slot-pill.status-available:hover {
    border-color: rgba(16, 185, 129, 0.6);
    background: rgba(16, 185, 129, 0.18);
    box-shadow: 0 8px 16px rgba(16, 185, 129, 0.2);
  }

  .calendar-page-wrapper-light .slot-pill.status-unavailable {
    border-color: rgba(148, 163, 184, 0.5);
    background: rgba(148, 163, 184, 0.12);
    color: #475569;
  }

  .calendar-page-wrapper-light .slot-pill.status-unavailable:hover {
    border-color: rgba(148, 163, 184, 0.7);
    background: rgba(148, 163, 184, 0.18);
    box-shadow: 0 8px 16px rgba(148, 163, 184, 0.2);
  }

  .calendar-page-wrapper-light .slot-empty {
    color: var(--text-tertiary);
    font-size: 0.9rem;
    border: 1px dashed var(--border);
    border-radius: var(--radius-md);
    padding: 0.65rem 0.75rem;
    background: var(--bg-secondary);
  }

  .calendar-page-wrapper-light .calendar-empty {
    text-align: center;
    border: 1px dashed var(--border);
    border-radius: var(--radius-lg);
    padding: 1.5rem;
    background: var(--bg-primary);
    box-shadow: var(--shadow-sm);
  }

  .calendar-page-wrapper-light .empty-illustration {
    font-size: 2rem;
    margin-bottom: 0.5rem;
  }

  .calendar-page-wrapper-light .empty-title {
    font-weight: 700;
    color: var(--text-primary);
    margin-bottom: 0.25rem;
  }

  .calendar-page-wrapper-light .empty-sub {
    color: var(--text-secondary);
    margin-bottom: 1rem;
  }

  .calendar-page-wrapper-light .calendar-loader {
    text-align: center;
    color: var(--text-secondary);
    padding: 0.75rem;
  }

  .calendar-page-wrapper-light .calendar-cta {
    text-align: center;
    margin-top: 1.5rem;
  }

  /* ===== MODALE ===== */
  .calendar-modal {
    position: fixed;
    inset: 0;
    background: rgba(15, 23, 42, 0.45);
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 1rem;
    z-index: 1200;
  }

  .calendar-modal-dialog {
    background: var(--bg-primary);
    border-radius: var(--radius-xl);
    padding: 1.5rem;
    width: min(520px, 100%);
    box-shadow: var(--shadow-lg);
    border: 1px solid var(--border);
  }

  .calendar-modal-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 0.5rem;
    margin-bottom: 1rem;
  }

  .modal-eyebrow {
    text-transform: uppercase;
    letter-spacing: 0.08em;
    font-size: 0.75rem;
    color: var(--text-tertiary);
    font-weight: 700;
  }

  .modal-title {
    margin: 0;
    font-size: 1.4rem;
    color: var(--text-primary);
  }

  .modal-close {
    background: transparent;
    border: none;
    font-size: 1.1rem;
    cursor: pointer;
    color: var(--text-secondary);
  }

  .form-grid {
    display: grid;
    grid-template-columns: repeat(2, minmax(0, 1fr));
    gap: 1rem;
    margin-top: 0.5rem;
  }

  .form-field {
    display: flex;
    flex-direction: column;
    gap: 0.4rem;
    font-weight: 600;
    color: var(--text-secondary);
    font-size: 0.95rem;
  }

  .form-field input,
  .form-field select {
    border: 1px solid rgba(59, 130, 246, 0.18);
    border-radius: var(--radius-md);
    padding: 0.75rem 0.85rem;
    font-size: 0.97rem;
    color: var(--text-primary);
    background: radial-gradient(circle at 20% 20%, rgba(59, 130, 246, 0.08), transparent 55%), var(--bg-primary);
    box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.4), 0 10px 35px rgba(17, 24, 39, 0.08);
    transition: border-color 0.2s ease, box-shadow 0.2s ease, transform 0.2s ease;
  }

  /* Flatpickr input (alt field) */
  .form-field .flatpickr-input {
    width: 100%;
    border: 1px solid rgba(59, 130, 246, 0.18);
    border-radius: var(--radius-md);
    padding: 0.75rem 0.85rem;
    font-size: 0.97rem;
    color: var(--text-primary);
    background: radial-gradient(circle at 20% 20%, rgba(59, 130, 246, 0.08), transparent 55%), var(--bg-primary);
    box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.4), 0 10px 35px rgba(17, 24, 39, 0.08);
    transition: border-color 0.2s ease, box-shadow 0.2s ease, transform 0.2s ease;
    cursor: pointer;
  }

  .form-field .flatpickr-input:focus {
    outline: none;
    border-color: var(--primary);
    box-shadow: 0 12px 28px rgba(59, 130, 246, 0.18), 0 0 0 3px rgba(59, 130, 246, 0.14);
    transform: translateY(-1px);
  }

  .form-field input:focus,
  .form-field select:focus {
    outline: none;
    border-color: var(--primary);
    box-shadow: 0 12px 28px rgba(59, 130, 246, 0.18), 0 0 0 3px rgba(59, 130, 246, 0.14);
    transform: translateY(-1px);
  }

  .form-field input[type="time"],
  .form-field input[type="date"] {
    letter-spacing: 0.02em;
    font-variant-numeric: tabular-nums;
  }

  .form-field input[type="time"]::-webkit-calendar-picker-indicator,
  .form-field input[type="date"]::-webkit-calendar-picker-indicator {
    filter: saturate(1.2);
    opacity: 0.8;
  }

  .form-field input[type="time"]:hover,
  .form-field input[type="date"]:hover,
  .form-field select:hover {
    border-color: rgba(59, 130, 246, 0.3);
    box-shadow: 0 14px 30px rgba(17, 24, 39, 0.12);
  }

  /* Select premium pour le fuseau horaire */
  .calendar-modal select[data-tz-select] {
    appearance: none;
    background: linear-gradient(145deg, rgba(255, 255, 255, 0.96), rgba(243, 246, 255, 0.96));
    border: 1px solid rgba(59, 130, 246, 0.2);
    border-radius: var(--radius-md);
    padding: 0.75rem 1rem;
    font-weight: 600;
    color: var(--text-primary);
    box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.5), 0 12px 30px rgba(17, 24, 39, 0.08);
    cursor: pointer;
    background-image: linear-gradient(135deg, rgba(59, 130, 246, 0.12), rgba(139, 92, 246, 0.06)), url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" width="12" height="8" viewBox="0 0 12 8"><path fill="%233b82f6" d="M1.41 0L6 4.58 10.59 0 12 1.41l-6 6-6-6z"/></svg>');
    background-repeat: no-repeat;
    background-position: right 0.85rem center;
    background-size: auto 10px;
  }

  .calendar-modal select[data-tz-select]:focus {
    outline: none;
    border-color: var(--primary);
    box-shadow: 0 14px 30px rgba(59, 130, 246, 0.16), 0 0 0 3px rgba(59, 130, 246, 0.14);
  }

  .calendar-modal select[data-tz-select] option {
    font-weight: 600;
    color: #111827;
    padding: 0.5rem 0.75rem;
  }

  .calendar-modal select[data-tz-select]::-webkit-scrollbar {
    width: 10px;
  }

  .calendar-modal select[data-tz-select]::-webkit-scrollbar-track {
    background: #f3f4f6;
    border-radius: 10px;
  }

  .calendar-modal select[data-tz-select]::-webkit-scrollbar-thumb {
    background: rgba(59, 130, 246, 0.35);
    border-radius: 10px;
    border: 2px solid #f3f4f6;
  }

  /* Flatpickr panel styling */
  .flatpickr-calendar {
    border: 1px solid rgba(59, 130, 246, 0.15);
    box-shadow: 0 18px 38px rgba(17, 24, 39, 0.18);
    border-radius: 14px;
    overflow: hidden;
    font-family: 'Inter', system-ui, -apple-system, sans-serif;
    min-width: 340px;
  }

  .flatpickr-months {
    background: linear-gradient(135deg, rgba(255, 255, 255, 0.96), rgba(245, 248, 255, 0.96));
    color: #111827;
    padding: 0.75rem 1rem;
  }

  .flatpickr-current-month input.cur-year,
  .flatpickr-current-month .cur-month {
    font-size: 1rem;
    font-weight: 700;
    color: #111827;
  }

  .flatpickr-weekdays {
    background: #fff;
    border-bottom: 1px solid rgba(59, 130, 246, 0.12);
    padding: 0.35rem 1rem 0.25rem;
  }

  .flatpickr-weekday {
    color: #9ca3af;
    font-weight: 700;
    text-transform: lowercase;
    font-size: 0.85rem;
  }

  .flatpickr-days,
  .flatpickr-days .dayContainer {
    padding: 0 1rem 0.9rem;
    box-sizing: border-box;
  }

  .flatpickr-day {
    border-radius: 12px;
    color: #111827;
    border: 1px solid transparent;
    font-weight: 600;
  }

  .flatpickr-day.today {
    border-color: rgba(59, 130, 246, 0.35);
    box-shadow: inset 0 0 0 1px rgba(59, 130, 246, 0.18);
  }

  .flatpickr-day.selected,
  .flatpickr-day.startRange,
  .flatpickr-day.endRange,
  .flatpickr-day.selected.inRange,
  .flatpickr-day.startRange.inRange,
  .flatpickr-day.endRange.inRange,
  .flatpickr-day.selected:focus,
  .flatpickr-day.startRange:focus,
  .flatpickr-day.endRange:focus {
    background: linear-gradient(145deg, #2563eb, #7c3aed);
    color: #fff;
    border-color: transparent;
    box-shadow: 0 8px 20px rgba(59, 130, 246, 0.35);
  }

  .flatpickr-day:hover {
    border-color: rgba(59, 130, 246, 0.25);
  }

  .flatpickr-day.flatpickr-disabled {
    color: #d1d5db !important;
    background: transparent !important;
    border-color: transparent !important;
    pointer-events: none;
  }

  .flatpickr-rContainer {
    padding: 0.75rem;
    background: linear-gradient(180deg, rgba(255, 255, 255, 0.98) 0%, rgba(247, 250, 255, 0.98) 100%);
  }

  .flatpickr-calendar .flatpickr-clear,
  .flatpickr-calendar .flatpickr-today {
    color: #2563eb;
    font-weight: 600;
    padding: 0.35rem 0.5rem;
  }

  /* Time picker premium look */
  .flatpickr-time {
    border-top: 1px solid rgba(59, 130, 246, 0.12);
    padding: 0.65rem 1rem;
    background: linear-gradient(180deg, rgba(255, 255, 255, 0.98) 0%, rgba(243, 246, 255, 0.98) 100%);
    border-radius: 0 0 14px 14px;
  }

  .flatpickr-time .numInput-wrapper {
    border: 1px solid rgba(59, 130, 246, 0.16);
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 0 10px 25px rgba(17, 24, 39, 0.08);
  }

  .flatpickr-time input.flatpickr-hour,
  .flatpickr-time input.flatpickr-minute {
    font-weight: 700;
    color: #111827;
  }

  .flatpickr-time .flatpickr-am-pm {
    display: none;
  }

  .modal-helper {
    margin-top: 0.5rem;
    color: var(--text-tertiary);
    font-size: 0.9rem;
  }

  .modal-actions {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 0.75rem;
    margin-top: 1.25rem;
  }

  .modal-actions-right {
    display: flex;
    align-items: center;
    gap: 0.75rem;
  }

  /* ===== TOASTS ===== */
  .toast-stack {
    position: fixed;
    top: 1rem;
    right: 1rem;
    display: flex;
    flex-direction: column;
    gap: 0.75rem;
    z-index: 1300;
  }

  .toast {
    background: var(--bg-primary);
    border: 1px solid var(--border);
    border-radius: var(--radius-md);
    padding: 0.75rem 1rem;
    box-shadow: var(--shadow-lg);
    display: flex;
    align-items: center;
    gap: 0.5rem;
    color: var(--text-primary);
    min-width: 260px;
  }

  .toast.success {
    border-color: rgba(16, 185, 129, 0.4);
  }

  .toast.error {
    border-color: rgba(239, 68, 68, 0.4);
  }

  .toast .toast-title {
    font-weight: 700;
    font-size: 0.95rem;
  }

  .toast .toast-text {
    font-size: 0.9rem;
    color: var(--text-secondary);
  }

  /* ===== TZ MODAL SPECIFICS ===== */
  [data-tz-modal] select {
    width: 100%;
  }
  
  /* ===== SECTION VISIO ===== */
  .calendar-page-wrapper-light .visio-section {
    background: var(--bg-card);
    border: 1px solid var(--border);
    border-radius: var(--radius-xl);
    padding: 2rem;
    width: 100% !important;
    max-width: 100% !important;
    min-width: 100% !important;
    box-sizing: border-box;
  }
  
  .calendar-page-wrapper-light .visio-header {
    display: flex;
    align-items: center;
    gap: 1rem;
    margin-bottom: 1.5rem;
  }
  
  /* ===== SECTION VISIO ULTRA PREMIUM ===== */
  .calendar-page-wrapper-light .visio-section {
    background: linear-gradient(135deg, #ffffff 0%, #fef3f2 50%, #f8fafc 100%);
    border: 2.5px solid rgba(30, 64, 175, 0.25);
    box-shadow: 0 32px 80px rgba(30, 64, 175, 0.2), 0 12px 32px rgba(30, 64, 175, 0.12), inset 0 1px 0 rgba(255, 255, 255, 0.8);
    border-radius: 32px;
    padding: 2.5rem;
    width: 100% !important;
    max-width: 100% !important;
    min-width: 100% !important;
    box-sizing: border-box;
    transition: all 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
  }
  
  .calendar-page-wrapper-light .visio-section:hover {
    box-shadow: 0 40px 100px rgba(30, 64, 175, 0.3), 0 16px 48px rgba(30, 64, 175, 0.18), inset 0 1px 0 rgba(255, 255, 255, 0.9);
    border-color: rgba(30, 64, 175, 0.4);
  }
  
  .calendar-page-wrapper-light .visio-icon {
    width: 72px;
    height: 72px;
    background: linear-gradient(135deg, rgba(30, 64, 175, 0.15) 0%, rgba(30, 64, 175, 0.08) 100%);
    border-radius: 24px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #1e40af;
    font-size: 2rem;
    flex-shrink: 0;
    box-shadow: 0 12px 32px rgba(30, 64, 175, 0.2);
  }
  
  .calendar-page-wrapper-light .visio-title {
    font-size: 1.35rem;
    font-weight: 900;
    color: var(--text-primary);
    margin-bottom: 0.5rem;
    letter-spacing: -0.03em;
  }
  
  .calendar-page-wrapper-light .visio-description {
    color: var(--text-secondary);
    line-height: 1.8;
    margin-bottom: 0;
    font-size: 1rem;
    font-weight: 500;
  }
  
  /* ===== SIDEBAR (30%) - DROITE - PREMIUM CARD AVEC SCROLL ===== */
  .calendar-page-wrapper-light .sidebar {
    padding: 2.5rem 10px 2.5rem 2rem !important;
    background: var(--bg-card) !important;
    border: 1px solid var(--border-light) !important;
    border-radius: var(--radius-xl) !important;
    box-shadow: var(--shadow-md) !important;
    position: sticky !important;
    top: 2rem !important;
    width: 100% !important;
    min-width: 0 !important;
    max-width: 100% !important;
    min-height: 0 !important;
    height: calc(100vh - 4rem) !important;
    max-height: calc(100vh - 4rem) !important;
    overflow-y: auto !important;
    overflow-x: hidden !important;
    box-sizing: border-box !important;
    grid-column: 2 !important;
    align-self: start !important;
  }
  
  .calendar-page-wrapper-light .sidebar .nav-section,
  .calendar-page-wrapper-light .sidebar .stats-section,
  .calendar-page-wrapper-light .sidebar .tips-section {
    width: 100% !important;
    flex-shrink: 0 !important;
  }
  
  /* Style de la scrollbar pour un rendu premium - ÉPAISSE */
  .calendar-page-wrapper-light .sidebar::-webkit-scrollbar {
    width: 12px !important; /* Scrollbar épaisse (12px) */
  }
  
  .calendar-page-wrapper-light .sidebar::-webkit-scrollbar-track {
    background: var(--bg-secondary);
    border-radius: 10px;
    margin: 8px 0;
  }
  
  .calendar-page-wrapper-light .sidebar::-webkit-scrollbar-thumb {
    background: var(--border);
    border-radius: 10px;
    border: 2px solid var(--bg-secondary);
  }
  
  .calendar-page-wrapper-light .sidebar::-webkit-scrollbar-thumb:hover {
    background: var(--text-tertiary);
  }
  
  /* Support Firefox */
  .calendar-page-wrapper-light .sidebar {
    scrollbar-width: thick !important;
    scrollbar-color: var(--border) var(--bg-secondary) !important;
  }
  
  /* ===== NAVIGATION ===== */
  .calendar-page-wrapper-light .nav-section {
    margin-bottom: 3.5rem !important;
    width: 100% !important;
    box-sizing: border-box !important;
    position: relative !important;
    z-index: 1 !important;
    overflow: visible !important;
  }
  
  .calendar-page-wrapper-light .nav-title {
    font-size: 0.75rem !important;
    font-weight: 700 !important;
    text-transform: uppercase !important;
    letter-spacing: 0.1em !important;
    color: var(--text-tertiary) !important;
    margin-bottom: 1.5rem !important;
    padding: 0 !important;
  }
  
  .calendar-page-wrapper-light .nav-list {
    display: flex !important;
    flex-direction: column !important;
    gap: 0.75rem !important;
    width: 100% !important;
  }
  
  .calendar-page-wrapper-light .nav-item {
    display: flex !important;
    align-items: center !important;
    gap: 1rem !important;
    padding: 1rem 1.25rem !important;
    border-radius: var(--radius-md) !important;
    text-decoration: none !important;
    color: var(--text-secondary) !important;
    font-weight: 500 !important;
    font-size: 0.95rem !important;
    transition: all 0.2s ease !important;
    background: transparent !important;
    border: 1px solid transparent !important;
    width: 100% !important;
    box-sizing: border-box !important;
    min-height: 56px !important;
  }
  
  .calendar-page-wrapper-light .nav-item:hover {
    background: rgba(59, 130, 246, 0.05) !important;
    color: var(--primary) !important;
    border-color: rgba(59, 130, 246, 0.1) !important;
  }
  
  .calendar-page-wrapper-light .nav-item.active {
    background: linear-gradient(135deg, rgba(59, 130, 246, 0.1) 0%, rgba(139, 92, 246, 0.05) 100%) !important;
    color: var(--primary) !important;
    border-color: var(--primary) !important;
    font-weight: 600 !important;
  }
  
  .calendar-page-wrapper-light .nav-icon {
    font-size: 1.25rem !important;
    flex-shrink: 0 !important;
    width: 24px !important;
    text-align: center !important;
  }
  
  /* ===== STATISTIQUES ===== */
  .calendar-page-wrapper-light .stats-section {
    background: var(--bg-card);
    border: 1px solid var(--border);
    border-radius: var(--radius-xl);
    padding: 2rem;
    margin-bottom: 2.5rem;
    box-shadow: var(--shadow-sm);
  }
  
  .calendar-page-wrapper-light .stats-title {
    font-size: 1.125rem;
    font-weight: 700;
    color: var(--text-primary);
    margin-bottom: 1.5rem;
    display: flex;
    align-items: center;
    gap: 0.75rem;
  }
  
  .calendar-page-wrapper-light .stats-title svg {
    color: var(--primary);
  }
  
  .calendar-page-wrapper-light .stats-grid {
    display: grid;
    grid-template-columns: 1fr;
    gap: 1.5rem;
  }
  
  .calendar-page-wrapper-light .stat-item {
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
  }
  
  .calendar-page-wrapper-light .stat-label {
    font-size: 0.875rem;
    color: var(--text-secondary);
    font-weight: 500;
  }
  
  .calendar-page-wrapper-light .stat-value {
    font-size: 1.75rem;
    font-weight: 800;
    color: var(--primary);
  }
  
  .calendar-page-wrapper-light .stat-value.highlight {
    color: var(--accent);
  }
  
  /* ===== CONSEILS ===== */
  .calendar-page-wrapper-light .tips-section {
    background: linear-gradient(135deg, rgba(59, 130, 246, 0.03) 0%, rgba(139, 92, 246, 0.01) 100%);
    border: 1px solid var(--border);
    border-radius: var(--radius-xl);
    padding: 2rem;
    margin-top: 2.5rem;
  }
  
  .calendar-page-wrapper-light .tip-header {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    margin-bottom: 1rem;
  }
  
  .calendar-page-wrapper-light .tip-icon {
    font-size: 1.5rem;
    flex-shrink: 0;
  }
  
  .calendar-page-wrapper-light .tip-title {
    font-size: 1rem;
    font-weight: 700;
    color: var(--text-primary);
    margin: 0;
  }
  
  .calendar-page-wrapper-light .tip-content {
    font-size: 0.9rem;
    color: var(--text-secondary);
    line-height: 1.6;
    margin: 0;
  }
  
  .calendar-page-wrapper-light .tip-content strong {
    color: var(--text-primary);
    font-weight: 600;
  }
  
  /* ===== RESPONSIVE ===== */
  @media (max-width: 1200px) {
    .calendar-page-wrapper-light {
      padding-inline: 10px !important;
    }
    
    .calendar-page-wrapper-light .dashboard-container {
      display: block !important;
      grid-template-columns: unset !important;
      gap: 0 !important;
    }
    
    .calendar-page-wrapper-light .main-content {
      padding: 2rem 10px !important;
    }
    
    .calendar-page-wrapper-light .sidebar {
      padding: 2.5rem 10px 2.5rem 2rem !important;
    }
    
    .calendar-page-wrapper-light .page-header h1 {
      font-size: 2.5rem !important; /* 40px tablette */
    }
    
    .calendar-page-wrapper-light .calendar-grid {
      grid-template-columns: repeat(4, 1fr);
    }
  }
  
  @media (max-width: 1024px) {
    .calendar-page-wrapper-light {
      padding-inline: 10px !important;
    }
    
    .calendar-page-wrapper-light .dashboard-container {
      grid-template-columns: 1fr !important;
      gap: 10px 0 !important;
    }
    
    .calendar-page-wrapper-light .main-content {
      padding: 2rem 10px !important;
    }
    
    .calendar-page-wrapper-light .sidebar {
      position: static !important;
      top: auto !important;
      width: 100% !important;
      min-width: 100% !important;
      max-width: 100% !important;
      height: auto !important;
      max-height: none !important;
      padding: 2.5rem 10px !important;
      grid-column: 1 !important;
    }
    
    .calendar-page-wrapper-light .page-header h1 {
      font-size: 2rem !important; /* 32px mobile */
    }
    
    .calendar-page-wrapper-light .calendar-grid {
      grid-template-columns: repeat(2, 1fr);
    }
    
    .calendar-page-wrapper-light .nav-section {
      margin-bottom: 2.5rem !important;
    }
    
    .calendar-page-wrapper-light .nav-list {
      gap: 0.75rem !important;
    }
    
    .calendar-page-wrapper-light .nav-item {
      min-height: 52px !important;
      padding: 0.875rem 1rem !important;
    }
    
    .calendar-page-wrapper-light .section-header {
      flex-direction: column;
      align-items: flex-start;
      gap: 1rem;
    }
    
    .calendar-page-wrapper-light .visio-header {
      flex-direction: column;
      align-items: flex-start;
      text-align: left;
    }
  }
  
  @media (max-width: 480px) {
    .calendar-page-wrapper-light .sidebar {
      padding: 1.5rem 1rem !important;
    }
    
    .calendar-page-wrapper-light .nav-section {
      margin-bottom: 2rem !important;
    }
    
    .calendar-page-wrapper-light .nav-item {
      min-height: 48px !important;
      padding: 0.75rem 0.875rem !important;
      gap: 0.875rem !important;
    }
    
    .calendar-page-wrapper-light .nav-icon {
      font-size: 1.125rem !important;
    }
    
    .calendar-page-wrapper-light .calendar-grid {
      grid-template-columns: 1fr;
    }
  }
</style>

<script>
(() => {
  const root = document.querySelector('[data-calendar-root]');
  if (!root) return;

  const grid = root.querySelector('[data-calendar-grid]');
  const weekRangeEl = root.querySelector('[data-week-range]');
  const weekSubEl = root.querySelector('[data-week-sub]');
  const timezoneChip = root.querySelector('[data-week-timezone]');
  const emptyState = root.querySelector('[data-empty-state]');
  const ctaSection = root.querySelector('.calendar-cta');
  const loader = root.querySelector('[data-calendar-loader]');
  const modal = root.querySelector('[data-calendar-modal]');
  const tzModal = root.querySelector('[data-tz-modal]');
  const tzSelect = root.querySelector('[data-tz-select]');
  const form = root.querySelector('[data-calendar-form]');
  const toastStack = root.querySelector('[data-toast-stack]');
  const deleteBtn = root.querySelector('[data-delete-slot]');
  const submitLabel = root.querySelector('[data-submit-label]');

  const dateField = root.querySelector('[data-field-date]');
  const startField = root.querySelector('[data-field-start]');
  const endField = root.querySelector('[data-field-end]');
  const statusField = root.querySelector('[data-field-status]');
  const slotIdField = root.querySelector('[data-slot-id]');

  // Debug: verify all form fields are found
  console.log('🔍 Form fields found:', {
    dateField: !!dateField,
    startField: !!startField,
    endField: !!endField,
    statusField: !!statusField,
    slotIdField: !!slotIdField,
  });
  if (statusField) {
    console.log('🎯 Status field value:', statusField.value);
    console.log('🎯 Status field options:', Array.from(statusField.options).map(o => ({ value: o.value, text: o.text })));
  }

  const csrf = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '';

  const TIMEZONES = [
    'Europe/Paris', 'Europe/London', 'Europe/Berlin', 'Europe/Madrid', 'Europe/Rome',
    'UTC', 'Etc/UTC', 'America/New_York', 'America/Chicago', 'America/Denver', 'America/Los_Angeles',
    'America/Toronto', 'America/Sao_Paulo', 'Africa/Casablanca', 'Africa/Dakar', 'Africa/Tunis',
    'Africa/Abidjan', 'Asia/Dubai', 'Asia/Kolkata', 'Asia/Shanghai', 'Asia/Tokyo', 'Asia/Singapore',
    'Australia/Sydney'
  ];

  const state = {
    timezone: Intl.DateTimeFormat().resolvedOptions().timeZone || 'Europe/Paris',
    weekStart: startOfWeek(new Date()),
    slots: [],
    loading: false,
  };

  let datePicker = null;
  let startTimePicker = null;
  let endTimePicker = null;

  const dayLabels = ['Lun', 'Mar', 'Mer', 'Jeu', 'Ven', 'Sam', 'Dim'];

  function initDatePicker() {
    if (!dateField || !window.flatpickr) return;
    datePicker = flatpickr(dateField, {
      altInput: true,
      altFormat: 'd/m/Y',
      dateFormat: 'Y-m-d',
      defaultDate: dateField.value || formatDateKey(new Date()),
      locale: flatpickr.l10ns.fr,
      disableMobile: true,
      position: 'auto center',
      prevArrow: '‹',
      nextArrow: '›',
      minDate: 'today',
    });
  }

  function initTimePickers() {
    if (!window.flatpickr || !startField || !endField) return;
    const sharedOpts = {
      enableTime: true,
      noCalendar: true,
      dateFormat: 'H:i',
      time_24hr: true,
      minuteIncrement: 15,
      disableMobile: true,
      enable: [
        (d) => {
          const h = d.getHours();
          return h === 23 || h === 0;
        }
      ],
      onChange: (_, __, instance) => instance.close(),
    };

    startTimePicker = flatpickr(startField, {
      ...sharedOpts,
      defaultDate: startField.value || '23:00',
    });

    endTimePicker = flatpickr(endField, {
      ...sharedOpts,
      defaultDate: endField.value || '00:00',
    });
  }

  function startOfWeek(date) {
    const d = new Date(date);
    const day = d.getDay(); // 0 (dimanche) -> 6 (samedi)
    const diff = day === 0 ? -6 : 1 - day;
    d.setHours(0, 0, 0, 0);
    d.setDate(d.getDate() + diff);
    return d;
  }

  function addDays(date, days) {
    const d = new Date(date);
    d.setDate(d.getDate() + days);
    return d;
  }

  function startOfDay(date) {
    const d = new Date(date);
    d.setHours(0, 0, 0, 0);
    return d;
  }

  function formatDateKey(date) {
    const y = date.getFullYear();
    const m = String(date.getMonth() + 1).padStart(2, '0');
    const d = String(date.getDate()).padStart(2, '0');
    return `${y}-${m}-${d}`;
  }

  function formatRangeLabel(start, end) {
    const opts = { day: '2-digit', month: 'short' };
    return `${start.toLocaleDateString('fr-FR', opts)} – ${end.toLocaleDateString('fr-FR', opts)}`;
  }

  function isToday(date) {
    const today = new Date();
    return date.getFullYear() === today.getFullYear() &&
      date.getMonth() === today.getMonth() &&
      date.getDate() === today.getDate();
  }

  function showLoader(show) {
    if (!loader) return;
    loader.style.display = show ? 'block' : 'none';
  }

  function showToast(type, title, text) {
    if (!toastStack) return;
    const toast = document.createElement('div');
    toast.className = `toast ${type}`;
    toast.innerHTML = `<div class="toast-title">${title}</div><div class="toast-text">${text || ''}</div>`;
    toastStack.appendChild(toast);
    setTimeout(() => toast.remove(), 3600);
  }

  async function loadWeek() {
    state.loading = true;
    showLoader(true);
    const params = new URLSearchParams({
      week: formatDateKey(state.weekStart),
      timezone: state.timezone,
    });

    try {
      console.log('📡 Loading slots for week:', formatDateKey(state.weekStart));
      const res = await fetch(`/freelance/calendar/slots?${params.toString()}`, {
        headers: { 'Accept': 'application/json' },
        credentials: 'same-origin',
      });

      if (!res.ok) throw new Error('Impossible de charger les créneaux');

      const data = await res.json();
      state.slots = data.slots || [];
      console.log('✅ Slots loaded:', state.slots);
      state.slots.forEach(slot => {
        console.log(`  🎯 Slot: ${slot.date} ${slot.start_time}-${slot.end_time} [${slot.status}]`);
      });
      renderWeek();
    } catch (e) {
      console.error('❌ Error loading slots:', e);
      showToast('error', 'Erreur', e.message || 'Une erreur est survenue');
    } finally {
      state.loading = false;
      showLoader(false);
    }
  }

  function renderWeek() {
    if (!grid) return;
    grid.innerHTML = '';

    const weekEnd = addDays(state.weekStart, 6);
    if (weekRangeEl) weekRangeEl.textContent = formatRangeLabel(state.weekStart, weekEnd);
    if (timezoneChip) timezoneChip.textContent = `Fuseau chargé : ${state.timezone}`;

    let total = 0;
    const today = startOfDay(new Date());
    let shown = 0;
    let offset = 0;

    while (shown < 7) {
      const dayDate = addDays(state.weekStart, offset);
      const dayStart = startOfDay(dayDate);
      offset += 1;
      if (dayStart < today) continue;

      const dateKey = formatDateKey(dayDate);
      const slots = state.slots.filter(s => s.date === dateKey);
      total += slots.length;

      const card = document.createElement('div');
      card.className = 'calendar-day' + (isToday(dayDate) ? ' today' : '');

      const head = document.createElement('div');
      head.className = 'day-head';
      const dayLabelIndex = (dayDate.getDay() + 6) % 7; // convert Sunday=0 to Sunday=6
      head.innerHTML = `<div><div class="day-name">${dayLabels[dayLabelIndex]}</div><div class="day-number">${dayDate.getDate()}</div></div>`;
      card.appendChild(head);

      const stack = document.createElement('div');
      stack.className = 'slots-stack';

      if (slots.length === 0) {
        const empty = document.createElement('div');
        empty.className = 'slot-empty';
        empty.textContent = 'Aucun créneau';
        empty.addEventListener('click', () => openModal('create', { date: dateKey }));
        stack.appendChild(empty);
      } else {
        slots.forEach(slot => {
          console.log(`🎨 Rendering slot: ${slot.date} ${slot.start_time}-${slot.end_time} with className: slot-pill status-${slot.status}`);
          const pill = document.createElement('button');
          pill.type = 'button';
          pill.className = `slot-pill status-${slot.status}`;
          pill.innerHTML = `<div class="slot-time">${slot.start_time} – ${slot.end_time}</div><div class="slot-meta">${slot.status === 'available' ? 'Disponible' : 'Indisponible'}</div>`;
          pill.addEventListener('click', () => openModal('edit', slot));
          stack.appendChild(pill);
        });
      }

      card.appendChild(stack);
      grid.appendChild(card);
      shown += 1;
    }

    if (weekSubEl) weekSubEl.textContent = `${total} créneau${total > 1 ? 'x' : ''}`;
  }

  function openModal(mode, slot) {
    if (!modal) return;
    modal.style.display = 'flex';
    modal.dataset.mode = mode;

    const defaultDate = slot?.date || formatDateKey(new Date());
    dateField.value = defaultDate;
    if (datePicker) datePicker.setDate(defaultDate, false, 'Y-m-d');
    
    // Remplir les champs heure correctement
    const startTime = slot?.start_time || '09:00';
    const endTime = slot?.end_time || '10:00';
    
    // Mettre à jour les champs directement et via flatpickr
    setTimeout(() => {
      if (startTimePicker) {
        startTimePicker.setDate(startTime, false, 'H:i');
        startField.value = startTime;
      }
      if (endTimePicker) {
        endTimePicker.setDate(endTime, false, 'H:i');
        endField.value = endTime;
      }
    }, 100);
    
    statusField.value = slot?.status || 'available';
    slotIdField.value = slot?.id || '';

    console.log('📋 Modal opened - Mode:', mode);
    console.log('📋 Slot data:', slot);
    console.log('📋 Setting times - start:', startTime, 'end:', endTime);

    submitLabel.textContent = mode === 'edit' ? 'Mettre à jour' : 'Enregistrer';
    deleteBtn.style.display = mode === 'edit' ? 'inline-flex' : 'none';

    const title = modal.querySelector('[data-modal-title]');
    if (title) title.textContent = mode === 'edit' ? 'Éditer le créneau' : 'Ajouter un créneau';
  }

  function closeModal() {
    if (modal) modal.style.display = 'none';
  }

  async function submitSlot(event) {
    event.preventDefault();
    
    // Verify all fields have values
    console.log('🔐 Form validation check:');
    console.log('  dateField.value:', dateField.value);
    console.log('  startField.value:', startField.value);
    console.log('  endField.value:', endField.value);
    console.log('  statusField.value:', statusField.value);
    console.log('  slotIdField.value:', slotIdField.value);

    const payload = {
      date: dateField.value,
      start_time: startField.value,
      end_time: endField.value,
      status: statusField.value,
      timezone: state.timezone,
    };

    console.log('📝 Submitting slot with payload:', payload);

    const isEdit = !!slotIdField.value;
    const url = isEdit ? `/freelance/calendar/slots/${slotIdField.value}` : '/freelance/calendar/slots';
    const method = isEdit ? 'PUT' : 'POST';

    try {
      const res = await fetch(url, {
        method,
        headers: {
          'Content-Type': 'application/json',
          'Accept': 'application/json',
          'X-CSRF-TOKEN': csrf,
        },
        credentials: 'same-origin',
        body: JSON.stringify(payload),
      });

      const data = await res.json().catch(() => ({}));

      console.log('📡 Response status:', res.status, 'Data:', data);

      if (!res.ok) {
        console.error('❌ Submission failed:', data);
        throw new Error(data.message || 'Impossible d\'enregistrer le créneau');
      }

      console.log('✅ Slot submitted successfully');
      closeModal();
      showToast('success', isEdit ? 'Créneau mis à jour' : 'Créneau créé', 'Vos disponibilités sont à jour.');
      await loadWeek();
    } catch (e) {
      console.error('💥 Error:', e);
      showToast('error', 'Erreur', e.message || 'Une erreur est survenue');
    }
  }

  async function deleteSlot() {
    const slotId = slotIdField.value;
    if (!slotId) return;
    if (!confirm('Supprimer ce créneau ?')) return;

    try {
      const res = await fetch(`/freelance/calendar/slots/${slotId}`, {
        method: 'DELETE',
        headers: {
          'Accept': 'application/json',
          'X-CSRF-TOKEN': csrf,
        },
        credentials: 'same-origin',
      });

      const data = await res.json().catch(() => ({}));
      if (!res.ok) throw new Error(data.message || 'Suppression impossible');

      closeModal();
      showToast('success', 'Créneau supprimé', 'Le créneau a été retiré.');
      await loadWeek();
    } catch (e) {
      showToast('error', 'Erreur', e.message || 'Une erreur est survenue');
    }
  }

  function bindEvents() {
    const openButtons = root.querySelectorAll('[data-open-modal]');
    openButtons.forEach(btn => btn.addEventListener('click', () => openModal('create')));

    const closeButtons = root.querySelectorAll('[data-close-modal]');
    closeButtons.forEach(btn => btn.addEventListener('click', closeModal));

    const prev = root.querySelector('[data-week-nav="prev"]');
    const next = root.querySelector('[data-week-nav="next"]');
    if (prev) prev.addEventListener('click', () => { state.weekStart = addDays(state.weekStart, -7); renderWeek(); loadWeek(); });
    if (next) next.addEventListener('click', () => { state.weekStart = addDays(state.weekStart, 7); renderWeek(); loadWeek(); });

    const tzBtn = root.querySelector('[data-open-tz]');
    if (tzBtn) {
      tzBtn.addEventListener('click', () => {
        openTzModal();
      });
    }

    const tzClosers = root.querySelectorAll('[data-close-tz]');
    tzClosers.forEach(btn => btn.addEventListener('click', closeTzModal));

    const tzSave = root.querySelector('[data-save-tz]');
    if (tzSave) tzSave.addEventListener('click', saveTz);

    if (tzModal) {
      tzModal.addEventListener('click', (e) => {
        if (e.target === tzModal) closeTzModal();
      });
    }

    if (form) form.addEventListener('submit', submitSlot);
    if (deleteBtn) deleteBtn.addEventListener('click', deleteSlot);

    // Debug: track status field changes
    if (statusField) {
      statusField.addEventListener('change', (e) => {
        console.log('✏️ Status field changed to:', e.target.value);
      });
      statusField.addEventListener('input', (e) => {
        console.log('🔄 Status field input:', e.target.value);
      });
    }

    if (modal) {
      modal.addEventListener('click', (e) => {
        if (e.target === modal) closeModal();
      });
    }

  }


  function openTzModal() {
    if (!tzModal || !tzSelect) return;
    tzSelect.innerHTML = '';
    TIMEZONES.forEach(tz => {
      const opt = document.createElement('option');
      opt.value = tz;
      opt.textContent = tz;
      if (tz === state.timezone) opt.selected = true;
      tzSelect.appendChild(opt);
    });
    tzModal.style.display = 'flex';
  }

  function closeTzModal() {
    if (tzModal) tzModal.style.display = 'none';
  }

  function saveTz() {
    if (!tzSelect) return;
    state.timezone = tzSelect.value || state.timezone;
    closeTzModal();
    renderWeek();
    loadWeek();
  }

  function init() {
    bindEvents();
    initDatePicker();
    initTimePickers();
    renderWeek();
    loadWeek();
  }

  init();
})();
</script>
