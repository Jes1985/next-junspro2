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

<div class="calendar-page-wrapper-light">
  <div class="dashboard-container">
    <!-- ===== ZONE PRINCIPALE (70%) ===== -->
    <main class="main-content">
      <!-- Bloc Tableau de bord Freelance -->
      <div class="dashboard-header">
        <h1>Tableau de bord Freelance</h1>
        <p class="dashboard-header-subtitle">
          Un espace clair pour avancer sans relances : vos clients voient l'avancement, vous gardez le rythme.
        </p>
        <div class="dashboard-header-ctas">
          <a href="{{ route('freelance.dashboard', ['tab' => 'services']) }}" class="btn-premium btn-premium-primary">
            Créer un service
          </a>
          <a href="{{ route('freelance.show', ['id' => $freelancerProfile->id ?? 0]) }}" target="_blank" class="btn-premium btn-premium-secondary">
            Voir mon profil public
          </a>
        </div>
        <p style="margin-top: 0.75rem; font-size: 0.85rem; color: #6b7280;">💡 Plus vos informations sont complètes, plus vous remontez dans les résultats.</p>
      </div>

      <!-- Header de page -->
      <div class="page-header">
        <h1>Agenda</h1>
        <p class="page-subtitle">
          Gérez vos disponibilités et planifiez vos sessions Rituel. Configurez vos créneaux horaires pour permettre aux clients de réserver directement.
        </p>
      </div>

      <!-- Contenu principal -->
      <div class="calendar-content">
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
            <a href="#" class="btn-secondary">
              ⚙️ Configurez mon fuseau horaire
            </a>
          </div>
          
          <!-- Grille de disponibilités avec calendrier -->
          <div class="calendar-grid">
            <div class="day-header">Lun</div>
            <div class="day-header">Mar</div>
            <div class="day-header">Mer</div>
            <div class="day-header">Jeu</div>
            <div class="day-header">Ven</div>
            <div class="day-header">Sam</div>
            <div class="day-header">Dim</div>
            
            <!-- Lundi -->
            <div class="day {{ $currentDay == 1 ? 'today' : '' }}">
              <div class="day-number">{{ $mondayDate }}</div>
              <div class="slot-time">09:00 - 10:00</div>
              <div class="slot-status">Disponible</div>
              @if($currentDay == 1)
                <div class="event">09h-17h</div>
              @endif
            </div>
            
            <!-- Mardi -->
            <div class="day {{ $currentDay == 2 ? 'today' : '' }}">
              <div class="day-number">{{ $tuesdayDate }}</div>
              <div class="slot-time">14:00 - 15:00</div>
              <div class="slot-status">Disponible</div>
              @if($currentDay == 2)
                <div class="event">09h-17h</div>
              @endif
            </div>
            
            <!-- Mercredi -->
            <div class="day {{ $currentDay == 3 ? 'today' : '' }}">
              <div class="day-number">{{ $wednesdayDate }}</div>
              <div class="slot-time">11:00 - 12:00</div>
              <div class="slot-status unavailable">Indisponible</div>
              @if($currentDay == 3)
                <div class="event">09h-17h</div>
              @endif
            </div>
            
            <!-- Jeudi -->
            <div class="day {{ $currentDay == 4 ? 'today' : '' }}">
              <div class="day-number">{{ $thursdayDate }}</div>
              <div class="slot-time">16:00 - 17:00</div>
              <div class="slot-status">Disponible</div>
              @if($currentDay == 4)
                <div class="event">09h-17h</div>
              @endif
            </div>
            
            <!-- Vendredi -->
            <div class="day {{ $currentDay == 5 ? 'today' : '' }}">
              <div class="day-number">{{ $fridayDate }}</div>
              <div class="slot-time">10:00 - 11:00</div>
              <div class="slot-status">Disponible</div>
              @if($currentDay == 5)
                <div class="event">09h-17h</div>
              @endif
            </div>
            
            <!-- Samedi -->
            <div class="day {{ $currentDay == 6 ? 'today' : '' }}">
              <div class="day-number">{{ $saturdayDate }}</div>
              <div class="slot-time">—</div>
              <div class="slot-status unavailable">Non configuré</div>
              @if($currentDay == 6)
                <div class="event">09h-17h</div>
              @endif
            </div>
            
            <!-- Dimanche -->
            <div class="day {{ $currentDay == 7 ? 'today' : '' }}">
              <div class="day-number">{{ $sundayDate }}</div>
              <div class="slot-time">—</div>
              <div class="slot-status unavailable">Non configuré</div>
              @if($currentDay == 7)
                <div class="event">09h-17h</div>
              @endif
            </div>
          </div>
          
          <!-- CTA Ajouter disponibilités -->
          <div style="text-align: center; margin-top: 2rem;">
            <button class="btn-primary">
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
                Activez la visio quand vous en avez besoin : coaching, formation, appel projet. 
                Configurez une salle de visioconférence pour vos sessions Rituel.
              </p>
            </div>
          </div>
          
          <button class="btn-primary">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <path d="M17 10l4-4m0 0l-4-4m4 4H7a4 4 0 000 8h10"/>
            </svg>
            Paramétrer la visio
          </button>
        </div>
      </div>
    </main>

    <!-- ===== SIDEBAR (30%) - LIGHT ===== -->
    <aside class="sidebar">
      <!-- Navigation -->
      <div class="nav-section">
        <h4 class="nav-title">Navigation</h4>
        <div class="nav-list">
          <a href="{{ route('freelance.dashboard', ['tab' => 'overview']) }}" class="nav-item {{ $currentActiveTab === 'overview' ? 'active' : '' }}">
            <span class="nav-icon">📈</span>
            <span>Aperçu</span>
          </a>
          <a href="{{ route('freelance.dashboard', ['tab' => 'requests']) }}" class="nav-item {{ $currentActiveTab === 'requests' ? 'active' : '' }}">
            <span class="nav-icon">📥</span>
            <span>Demandes</span>
          </a>
          <a href="{{ route('freelance.dashboard', ['tab' => 'jobs']) }}" class="nav-item {{ $currentActiveTab === 'jobs' ? 'active' : '' }}">
            <span class="nav-icon">⚙️</span>
            <span>Prestations</span>
          </a>
          <a href="{{ route('freelance.dashboard', ['tab' => 'calendar']) }}" class="nav-item {{ $currentActiveTab === 'calendar' ? 'active' : '' }}">
            <span class="nav-icon">📅</span>
            <span>Agenda</span>
          </a>
          <a href="{{ route('freelance.dashboard', ['tab' => 'messages']) }}" class="nav-item {{ $currentActiveTab === 'messages' ? 'active' : '' }}">
            <span class="nav-icon">✉️</span>
            <span>Messages</span>
          </a>
          <a href="{{ route('freelance.dashboard', ['tab' => 'earnings']) }}" class="nav-item {{ $currentActiveTab === 'earnings' ? 'active' : '' }}">
            <span class="nav-icon">💳</span>
            <span>Revenus</span>
          </a>
        </div>
      </div>

      <!-- Statistiques -->
      <div class="stats-section">
        <h4 class="stats-title">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M22 12h-4l-3 9L9 3l-3 9H2"/>
          </svg>
          Vos indicateurs
        </h4>
        <div class="stats-grid">
          <div class="stat-item">
            <span class="stat-label">Créneaux ouverts</span>
            <span class="stat-value">4</span>
          </div>
          <div class="stat-item">
            <span class="stat-label">Réservations à venir</span>
            <span class="stat-value">0</span>
          </div>
          <div class="stat-item">
            <span class="stat-label">Taux d'occupation</span>
            <span class="stat-value">0%</span>
          </div>
          <div class="stat-item">
            <span class="stat-label">Prochaine dispo</span>
            <span class="stat-value highlight">Lun 09:00</span>
          </div>
        </div>
      </div>

      <!-- Conseils -->
      <div class="tips-section">
        <div class="tip-header">
          <span class="tip-icon">💡</span>
          <h4 class="tip-title">Conseil stratégique</h4>
        </div>
        <p class="tip-content">
          Un agenda bien configuré avec des créneaux réguliers augmente votre visibilité et facilite 
          la réservation pour vos clients. Planifiez vos disponibilités à l'avance.
        </p>
      </div>

      <!-- Citation -->
      <div class="tips-section" style="margin-top: 1.5rem;">
        <div class="tip-header">
          <span class="tip-icon">🚀</span>
          <h4 class="tip-title">Boost de visibilité</h4>
        </div>
        <p class="tip-content">
          Les freelances avec un agenda optimisé reçoivent en moyenne
          <strong>2× plus de réservations</strong> dans leur premier mois.
        </p>
      </div>
    </aside>
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
    min-height: 100vh;
    line-height: 1.5;
  }
  
  /* ===== STRUCTURE 70/30 LIGHT ===== */
  .calendar-page-wrapper-light {
    position: relative;
    width: 100%;
    min-height: 100vh;
    overflow-x: clip;
    padding: 0 10px !important; /* Marges latérales de 1cm (10px) à gauche ET à droite */
    box-sizing: border-box;
  }
  
  .calendar-page-wrapper-light .dashboard-container {
    display: grid !important;
    grid-template-columns: 70% 30% !important; /* Layout premium 70/30 */
    min-height: 100vh;
    max-width: none !important;
    width: 100% !important;
    margin: 0 !important;
    padding: 0 !important;
    background: transparent;
    box-shadow: none;
    box-sizing: border-box;
    gap: 0 10px !important; /* Espacement de 1cm (10px) entre les zones 70% et 30% */
    align-items: start !important;
    overflow-x: visible !important;
  }
  
  /* ===== ZONE PRINCIPALE (70%) - GAUCHE - PREMIUM ===== */
  .calendar-page-wrapper-light .main-content {
    padding: 4rem 10px !important; /* Padding vertical + 1cm (10px) de chaque côté */
    border-right: none !important;
    min-height: 100vh;
    background: transparent;
    box-sizing: border-box;
    overflow-x: visible !important;
    position: relative;
    max-width: none !important;
    width: 100% !important;
    min-width: 0 !important;
    grid-column: 1 !important;
    display: flex;
    flex-direction: column;
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
    border-bottom: 1px solid var(--border-light);
    text-align: center !important; /* Centrage du contenu */
  }
  
  .calendar-page-wrapper-light .page-header::after {
    content: '';
    position: absolute;
    bottom: -1px;
    left: 50%;
    transform: translateX(-50%);
    width: 80px;
    height: 3px;
    background: linear-gradient(90deg, var(--primary), var(--accent));
    border-radius: 2px;
  }
  
  .calendar-page-wrapper-light .page-header h1 {
    font-size: 3rem !important; /* 48px desktop - MÊME TAILLE QUE PRESTATIONS */
    font-weight: 800;
    margin-bottom: 1rem;
    background: linear-gradient(135deg, var(--text-primary) 0%, var(--text-secondary) 100%);
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
    font-weight: 400;
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
  
  /* ===== SECTION DISPONIBILITÉS ===== */
  .calendar-page-wrapper-light .availability-section {
    background: linear-gradient(135deg, rgba(59, 130, 246, 0.03) 0%, rgba(139, 92, 246, 0.01) 100%);
    border: 1px solid var(--border-light);
    border-radius: var(--radius-lg);
    padding: 2rem;
    width: 100% !important;
    max-width: 100% !important;
    min-width: 100% !important;
    box-sizing: border-box;
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
    font-weight: 700;
    color: var(--text-primary);
    margin-bottom: 0.5rem;
  }
  
  .calendar-page-wrapper-light .section-description {
    color: var(--text-secondary);
    margin-bottom: 0;
    line-height: 1.6;
    font-size: 0.95rem;
  }
  
  /* ===== BOUTONS ===== */
  .calendar-page-wrapper-light .btn-primary {
    background: linear-gradient(135deg, var(--primary) 0%, var(--accent) 100%);
    color: white;
    border: none;
    padding: 0.75rem 1.5rem;
    border-radius: var(--radius-md);
    font-weight: 600;
    cursor: pointer;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    transition: all 0.2s ease;
    font-size: 0.95rem;
    text-decoration: none;
  }
  
  .calendar-page-wrapper-light .btn-primary:hover {
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(59, 130, 246, 0.2);
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
  
  /* ===== GRID CALENDRIER ===== */
  .calendar-page-wrapper-light .calendar-grid {
    display: grid;
    grid-template-columns: repeat(7, 1fr);
    gap: 0.75rem;
    margin: 2rem 0;
    width: 100% !important;
    max-width: 100% !important;
    box-sizing: border-box;
  }
  
  .calendar-page-wrapper-light .day-header {
    text-align: center;
    font-size: 0.875rem;
    font-weight: 600;
    color: var(--text-tertiary);
    padding: 0.5rem;
    text-transform: uppercase;
  }
  
  .calendar-page-wrapper-light .day {
    background: var(--bg-primary);
    border: 1px solid var(--border);
    border-radius: var(--radius-sm);
    padding: 1rem;
    text-align: center;
    transition: all 0.2s ease;
    min-height: 100px;
    display: flex;
    flex-direction: column;
    justify-content: center;
  }
  
  .calendar-page-wrapper-light .day:hover {
    border-color: var(--primary);
    transform: translateY(-2px);
    box-shadow: var(--shadow-md);
  }
  
  .calendar-page-wrapper-light .day.today {
    background: linear-gradient(135deg, rgba(59, 130, 246, 0.1) 0%, rgba(139, 92, 246, 0.05) 100%);
    border: 2px solid var(--primary);
    box-shadow: 0 4px 12px rgba(59, 130, 246, 0.15);
  }
  
  .calendar-page-wrapper-light .day-number {
    font-weight: 600;
    color: var(--text-primary);
    margin-bottom: 0.5rem;
    font-size: 1rem;
  }
  
  .calendar-page-wrapper-light .day.today .day-number {
    font-weight: 700;
    color: var(--primary);
    margin-bottom: 0.25rem;
    font-size: 1.125rem;
  }
  
  .calendar-page-wrapper-light .slot-time {
    font-weight: 600;
    color: var(--text-primary);
    margin-bottom: 0.25rem;
    font-size: 0.875rem;
  }
  
  .calendar-page-wrapper-light .slot-status {
    font-size: 0.75rem;
    color: var(--success);
    font-weight: 500;
  }
  
  .calendar-page-wrapper-light .slot-status.unavailable {
    color: var(--text-tertiary);
  }
  
  .calendar-page-wrapper-light .event {
    margin-top: 0.5rem;
    font-size: 0.75rem;
    color: var(--primary);
    font-weight: 600;
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
  
  .calendar-page-wrapper-light .visio-icon {
    width: 48px;
    height: 48px;
    background: linear-gradient(135deg, rgba(59, 130, 246, 0.1) 0%, rgba(139, 92, 246, 0.05) 100%);
    border-radius: var(--radius-md);
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--primary);
    font-size: 1.25rem;
    flex-shrink: 0;
  }
  
  .calendar-page-wrapper-light .visio-title {
    font-size: 1.25rem;
    font-weight: 600;
    color: var(--text-primary);
    margin-bottom: 0.5rem;
  }
  
  .calendar-page-wrapper-light .visio-description {
    color: var(--text-secondary);
    line-height: 1.6;
    margin-bottom: 0;
    font-size: 0.95rem;
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
      grid-template-columns: 70% 30% !important;
      gap: 0 10px !important;
    }
    
    .calendar-page-wrapper-light .main-content {
      padding: 3rem 10px !important;
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
