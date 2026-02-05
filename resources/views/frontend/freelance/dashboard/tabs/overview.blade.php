@php
  // Générer les initiales pour l'avatar
  $initials = '';
  if (isset($user->first_name) && isset($user->last_name) && $user->first_name && $user->last_name) {
    $initials = strtoupper(substr($user->first_name, 0, 1) . substr($user->last_name, 0, 1));
  } elseif (isset($user->username) && $user->username) {
    $initials = strtoupper(substr($user->username, 0, 2));
  } else {
    $initials = 'U';
  }
  
  // Nom d'affichage
  $displayName = (isset($user->first_name) && $user->first_name) ? $user->first_name : (isset($user->username) ? $user->username : 'Utilisateur');
  
  // Récupérer activeTab depuis les variables passées
  $currentActiveTab = $activeTab ?? 'overview';
@endphp

<div class="overview-page-wrapper-light">
  <div class="dashboard-container">
    <!-- ===== ZONE PRINCIPALE (70%) ===== -->
    <main class="main-content">
      <!-- Bloc Tableau de bord Freelance -->
      @include('frontend.freelance.dashboard.partials.dashboard-header-section', [
        'freelancerProfile' => $freelancerProfile ?? null
      ])

      <!-- Header de page -->
      <div class="page-header">
        <h1>Aperçu</h1>
        <p class="page-subtitle">
          Tableau de bord de votre activité freelance. Suivez vos performances et gérez vos missions.
        </p>
      </div>

      <!-- Contenu principal -->
      <div class="overview-content">
        <!-- SECTION GAUCHE : L'ESPRIT CLAIR -->
        <section class="focus-area">
          <div class="welcome-card">
            <p class="tagline">Bonjour, {{ $displayName }}. Prête pour une journée créative ?</p>
            <h2>Focus du jour</h2>
            <div class="today-status">
              <div class="time-slot">🕘 09:00 - 10:00</div>
              <h3>✨ Rituel de conception</h3>
              <p class="client">Pour : <strong>Maison Blanc</strong></p>
              <a href="{{ route('freelance.dashboard', ['tab' => 'rituals']) }}" class="btn-primary">Commencer la session</a>
            </div>
            <p class="hint">Votre prochain créneau est à 14h. <a href="{{ route('freelance.dashboard', ['tab' => 'calendar']) }}">Ajouter du temps focus</a></p>
          </div>
        </section>

        <!-- SECTION DROITE : FLUX D'ACTIVITÉ -->
        <section class="activity-area" id="activityCard">
          <div class="activity-header">
            <h2>Flux d'activité</h2>
            <span class="badge">3 nouveaux</span>
          </div>
          <div class="activity-feed" id="activityFeed">
            <div class="activity-item new">
              <span class="icon">💬</span>
              <div>
                <p><strong>Alexandre Chevallier</strong> a envoyé un message.</p>
                <span class="time">Il y a 10 min</span>
              </div>
            </div>
            <div class="activity-item">
              <span class="icon">✅</span>
              <div>
                <p>Le bilan pour <strong>Rituel #42</strong> a été envoyé et vu.</p>
                <span class="time">Hier, 18:30</span>
              </div>
            </div>
            <div class="activity-item">
              <span class="icon">💰</span>
              <div>
                <p><strong>Paiement reçu</strong> pour "Stratégie de marque".</p>
                <span class="amount">+ 2 400 €</span>
              </div>
            </div>
          </div>
          
          <!-- Activités supplémentaires (cachées par défaut) -->
          <div class="activity-feed-expanded" id="activityFeedExpanded" style="display: none;">
            <div class="activity-item">
              <span class="icon">📋</span>
              <div>
                <p><strong>Nouvelle demande</strong> reçue pour "Refonte de site web".</p>
                <span class="time">Il y a 2h</span>
              </div>
            </div>
            <div class="activity-item">
              <span class="icon">📅</span>
              <div>
                <p><strong>Rendez-vous confirmé</strong> avec Sophie Martin pour demain à 14h.</p>
                <span class="time">Il y a 3h</span>
              </div>
            </div>
            <div class="activity-item">
              <span class="icon">⭐</span>
              <div>
                <p><strong>Nouvelle évaluation</strong> : 5 étoiles pour "Conception logo".</p>
                <span class="time">Il y a 5h</span>
              </div>
            </div>
            <div class="activity-item">
              <span class="icon">📝</span>
              <div>
                <p><strong>Rituel #41</strong> terminé et bilan envoyé.</p>
                <span class="time">Hier, 16:00</span>
              </div>
            </div>
            <div class="activity-item">
              <span class="icon">💼</span>
              <div>
                <p><strong>Service créé</strong> : "Audit UX/UI".</p>
                <span class="time">Hier, 12:00</span>
              </div>
            </div>
            <div class="activity-item">
              <span class="icon">🎯</span>
              <div>
                <p><strong>Objectif mensuel</strong> : 75% atteint.</p>
                <span class="time">Il y a 2 jours</span>
              </div>
            </div>
          </div>
          
          <button type="button" class="link-elegant activity-toggle-btn" id="activityToggleBtn" onclick="toggleActivityFeed()">
            Voir toute l'activité →
          </button>
        </section>

        <!-- SECTION HORIZONTALE : PRIORITÉ + QUOTE -->
        <section class="cards-horizontal-row">
          <div class="priority-card">
            <div class="card-header">
              <span class="icon">⭐</span>
              <h3>Priorité Élévation</h3>
            </div>
            <p>Votre profil est complet à 85%. Le finaliser augmente votre visibilité de <strong>40%</strong>.</p>
            <div class="progress-bar">
              <div class="progress-fill" style="width:85%"></div>
            </div>
            <a href="{{ route('freelance.dashboard', ['tab' => 'profile']) }}" class="btn-refined">Optimiser mon profil</a>
          </div>

          <div class="quote-card">
            <div class="quote-image-wrapper">
              <img src="https://images.unsplash.com/photo-1522202176988-66273c2fd55f?w=800&h=400&fit=crop&q=80" alt="Productivité et créativité" class="quote-image" loading="lazy">
            </div>
            <div class="quote-content">
              <p class="quote">"Le secret n'est pas de relancer, mais de rendre l'avancement irrésistible."</p>
              <p class="author">— Junspro</p>
            </div>
          </div>
        </section>
      </div>
    </main>

    <!-- ===== SIDEBAR (30%) - LIGHT ===== -->
    @include('frontend.freelance.dashboard.partials.dashboard-sidebar-section', [
      'activeTab' => $activeTab ?? 'overview'
    ])
  </div>
</div>

{{-- Styles CSS communs du shell premium --}}
@include('frontend.freelance.dashboard.partials.dashboard-shell-styles')

<style>
  /* ===== STYLES SPÉCIFIQUES À L'ONGLET APERÇU ===== */
  /* Les styles communs sont dans dashboard-shell-styles.blade.php */
  
  /* ===== BLOC TABLEAU DE BORD FREELANCE - Décalage de 2 cm du bord gauche et haut ===== */
  .overview-page-wrapper-light .dashboard-header {
    margin-top: 2cm !important;
    margin-left: 2cm !important;
    margin-bottom: 2rem;
    padding-bottom: 1.5rem;
    border-bottom: 1px solid rgba(0, 0, 0, 0.08);
    width: 100% !important;
    max-width: 100% !important;
    min-width: 100% !important;
  }

  .overview-page-wrapper-light .dashboard-header h1 {
    font-size: 1.75rem;
    font-weight: 700;
    color: #111827;
    margin: 0 0 0.5rem 0;
    line-height: 1.2;
  }

  .overview-page-wrapper-light .dashboard-header-subtitle {
    font-size: 0.95rem;
    color: #6b7280;
    margin-bottom: 1.25rem;
    line-height: 1.5;
  }

  .overview-page-wrapper-light .dashboard-header-ctas {
    display: flex;
    gap: 0.75rem;
    flex-wrap: wrap;
  }

  .overview-page-wrapper-light .btn-premium {
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

  .overview-page-wrapper-light .btn-premium-primary {
    background: linear-gradient(135deg, #1e40af 0%, #4c1d95 50%, #7c3aed 100%);
    color: white;
    box-shadow: 0 4px 12px rgba(124, 58, 237, 0.3);
  }

  .overview-page-wrapper-light .btn-premium-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(124, 58, 237, 0.4);
    color: white;
    text-decoration: none;
  }

  .overview-page-wrapper-light .btn-premium-secondary {
    background: white;
    color: #1e40af;
    border: 2px solid #1e40af;
  }

  .overview-page-wrapper-light .btn-premium-secondary:hover {
    background: #f8fafc;
    transform: translateY(-1px);
    color: #1e40af;
    text-decoration: none;
  }

  /* ===== RESET ET VARIABLES LIGHT ===== */
  .overview-page-wrapper-light {
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
  
  .overview-page-wrapper-light * {
    box-sizing: border-box;
  }
  
  .overview-page-wrapper-light {
    font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
    background: linear-gradient(135deg, var(--bg-secondary) 0%, #FFFFFF 100%);
    color: var(--text-primary);
    min-height: 100vh;
    line-height: 1.5;
  }
  
  /* ===== STRUCTURE 70/30 LIGHT (Style identique à Demandes) ===== */
  .overview-page-wrapper-light {
    position: relative;
    width: 100%;
    min-height: 100vh;
    overflow-x: clip;
    padding: 0 10px !important; /* Marges latérales de 1cm (10px) à gauche ET à droite comme Demandes */
    box-sizing: border-box;
  }
  
  .overview-page-wrapper-light .dashboard-container {
    display: grid !important;
    grid-template-columns: 70% 30% !important; /* Layout premium 70/30 */
    min-height: 100vh;
    max-width: none !important;
    width: 100% !important;
    margin: 0 !important;
    padding: 2rem !important; /* Padding pour créer l'espace autour du contenu comme dans Demandes */
    background: white !important; /* Fond blanc comme dans Demandes */
    border-radius: var(--radius-xl) !important; /* Bords arrondis (20px) comme dans Demandes */
    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -1px rgba(0, 0, 0, 0.03) !important; /* Ombre légère identique à Demandes */
    box-sizing: border-box;
    gap: 0 10px !important; /* Espacement de 1cm (10px) entre les zones 70% et 30% */
    align-items: start !important;
    overflow-x: visible !important;
  }
  
  /* ===== ZONE PRINCIPALE (70%) - GAUCHE - PREMIUM ===== */
  .overview-page-wrapper-light .main-content {
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
  
  /* ===== HEADER PREMIUM - CENTRÉ (Style identique à Demandes) ===== */
  .overview-page-wrapper-light .page-header {
    margin-top: 2cm !important; /* Décalage de 2 cm du bloc Tableau de bord Freelance */
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
  
  .overview-page-wrapper-light .page-header::after {
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
  
  .overview-page-wrapper-light .page-header h1 {
    font-size: 3rem !important; /* 48px desktop - MÊME TAILLE QUE DEMANDES */
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
  
  .overview-page-wrapper-light .page-subtitle {
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
  .overview-page-wrapper-light .overview-content {
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
  
  /* Focus Area */
  .overview-page-wrapper-light .focus-area {
    width: 100% !important;
    max-width: 100% !important;
    min-width: 100% !important;
    margin: 0 !important;
    padding: 0 !important;
    box-sizing: border-box;
  }
  
  .overview-page-wrapper-light .welcome-card {
    background: var(--bg-card);
    border: 1px solid var(--border);
    border-radius: var(--radius-xl);
    padding: 2.5rem;
    box-shadow: var(--shadow-md);
    width: 100% !important;
    max-width: 100% !important;
    min-width: 100% !important;
    box-sizing: border-box;
  }
  
  .overview-page-wrapper-light .tagline {
    font-size: 1rem;
    color: var(--text-secondary);
    margin-bottom: 1.5rem;
  }
  
  .overview-page-wrapper-light .welcome-card h2 {
    font-size: 1.75rem;
    font-weight: 700;
    color: var(--text-primary);
    margin-bottom: 1.5rem;
  }
  
  .overview-page-wrapper-light .today-status {
    background: linear-gradient(135deg, rgba(59, 130, 246, 0.05) 0%, rgba(139, 92, 246, 0.03) 100%);
    border: 1px solid var(--border-light);
    border-radius: var(--radius-lg);
    padding: 1.5rem;
    margin-bottom: 1rem;
  }
  
  .overview-page-wrapper-light .time-slot {
    font-size: 0.9rem;
    color: var(--text-secondary);
    margin-bottom: 0.75rem;
  }
  
  .overview-page-wrapper-light .today-status h3 {
    font-size: 1.25rem;
    font-weight: 600;
    color: var(--text-primary);
    margin-bottom: 0.5rem;
  }
  
  .overview-page-wrapper-light .client {
    font-size: 0.95rem;
    color: var(--text-secondary);
    margin-bottom: 1rem;
  }
  
  .overview-page-wrapper-light .btn-primary {
    display: inline-block;
    padding: 0.75rem 1.5rem;
    background: linear-gradient(135deg, var(--primary) 0%, var(--accent) 100%);
    color: white;
    border-radius: var(--radius-md);
    text-decoration: none;
    font-weight: 600;
    transition: all 0.2s ease;
  }
  
  .overview-page-wrapper-light .btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: var(--shadow-lg);
  }
  
  .overview-page-wrapper-light .hint {
    font-size: 0.875rem;
    color: var(--text-tertiary);
    margin-top: 1rem;
  }
  
  .overview-page-wrapper-light .hint a {
    color: var(--primary);
    text-decoration: none;
  }
  
  /* Activity Area */
  .overview-page-wrapper-light .activity-area {
    background: var(--bg-card);
    border: 1px solid var(--border);
    border-radius: var(--radius-xl);
    padding: 2rem;
    box-shadow: var(--shadow-md);
    width: 100% !important;
    max-width: 100% !important;
    min-width: 100% !important;
    box-sizing: border-box;
  }
  
  .overview-page-wrapper-light .activity-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 1.5rem;
  }
  
  .overview-page-wrapper-light .activity-header h2 {
    font-size: 1.5rem;
    font-weight: 700;
    color: var(--text-primary);
    margin: 0;
  }
  
  .overview-page-wrapper-light .activity-header .badge {
    background: linear-gradient(135deg, var(--primary) 0%, var(--accent) 100%);
    color: white;
    padding: 0.25rem 0.75rem;
    border-radius: 12px;
    font-size: 0.75rem;
    font-weight: 600;
  }
  
  .overview-page-wrapper-light .activity-feed {
    display: flex;
    flex-direction: column;
    gap: 1rem;
  }
  
  .overview-page-wrapper-light .activity-item {
    display: flex;
    gap: 1rem;
    padding: 1rem;
    border-radius: var(--radius-md);
    transition: all 0.2s ease;
  }
  
  .overview-page-wrapper-light .activity-item:hover {
    background: var(--bg-secondary);
  }
  
  .overview-page-wrapper-light .activity-item.new {
    background: linear-gradient(135deg, rgba(59, 130, 246, 0.05) 0%, rgba(139, 92, 246, 0.03) 100%);
    border: 1px solid var(--border-light);
  }
  
  .overview-page-wrapper-light .activity-item .icon {
    font-size: 1.5rem;
    flex-shrink: 0;
  }
  
  .overview-page-wrapper-light .activity-item p {
    margin: 0 0 0.25rem 0;
    color: var(--text-primary);
    font-size: 0.95rem;
  }
  
  .overview-page-wrapper-light .activity-item .time {
    font-size: 0.85rem;
    color: var(--text-tertiary);
  }
  
  .overview-page-wrapper-light .activity-item .amount {
    font-size: 0.95rem;
    font-weight: 600;
    color: var(--success);
  }
  
  .overview-page-wrapper-light .activity-toggle-btn {
    margin-top: 1rem;
    color: var(--primary);
    text-decoration: none;
    font-weight: 500;
    cursor: pointer;
    border: none;
    background: none;
    padding: 0;
  }
  
  /* Cards Horizontal Row */
  .overview-page-wrapper-light .cards-horizontal-row {
    display: grid !important;
    grid-template-columns: 1fr 2fr !important; /* Quote-card prend 2x plus de largeur */
    gap: 1.5rem;
    width: 100% !important;
    max-width: 100% !important;
    min-width: 100% !important;
    margin: 0 !important;
    padding: 0 !important;
    box-sizing: border-box;
  }
  
  .overview-page-wrapper-light .priority-card,
  .overview-page-wrapper-light .quote-card {
    background: var(--bg-card);
    border: 1px solid var(--border);
    border-radius: var(--radius-xl);
    padding: 2rem;
    box-shadow: var(--shadow-md);
    width: 100% !important;
    max-width: 100% !important;
    min-width: 0 !important;
    box-sizing: border-box;
  }
  
  .overview-page-wrapper-light .card-header {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    margin-bottom: 1rem;
  }
  
  .overview-page-wrapper-light .card-header .icon {
    font-size: 1.5rem;
  }
  
  .overview-page-wrapper-light .card-header h3 {
    font-size: 1.25rem;
    font-weight: 700;
    color: var(--text-primary);
    margin: 0;
  }
  
  .overview-page-wrapper-light .priority-card p {
    color: var(--text-secondary);
    margin-bottom: 1rem;
    font-size: 0.95rem;
  }
  
  .overview-page-wrapper-light .progress-bar {
    height: 8px;
    background: var(--bg-secondary);
    border-radius: 4px;
    margin-bottom: 1rem;
    overflow: hidden;
  }
  
  .overview-page-wrapper-light .progress-fill {
    height: 100%;
    background: linear-gradient(90deg, var(--primary), var(--accent));
    border-radius: 4px;
    transition: width 0.3s ease;
  }
  
  .overview-page-wrapper-light .btn-refined {
    display: inline-block;
    padding: 0.75rem 1.5rem;
    background: white;
    color: var(--primary);
    border: 1.5px solid var(--primary);
    border-radius: var(--radius-md);
    text-decoration: none;
    font-weight: 600;
    transition: all 0.2s ease;
  }
  
  .overview-page-wrapper-light .btn-refined:hover {
    background: rgba(59, 130, 246, 0.05);
  }
  
  .overview-page-wrapper-light .quote-card {
    padding: 0;
    overflow: hidden;
  }
  
  .overview-page-wrapper-light .quote-image-wrapper {
    width: 100%;
    height: 350px; /* Hauteur augmentée pour voir les têtes entières */
    overflow: hidden;
  }
  
  .overview-page-wrapper-light .quote-image {
    width: 100%;
    height: 100%;
    object-fit: cover;
    object-position: center top; /* Ajuste la position pour montrer les visages */
  }
  
  .overview-page-wrapper-light .quote-content {
    padding: 1.5rem;
  }
  
  .overview-page-wrapper-light .quote {
    font-size: 1rem;
    font-style: italic;
    color: var(--text-primary);
    margin-bottom: 0.75rem;
  }
  
  .overview-page-wrapper-light .author {
    font-size: 0.875rem;
    color: var(--text-secondary);
    margin: 0;
  }
  
  /* ===== SIDEBAR (30%) - DROITE - PREMIUM CARD AVEC SCROLL ===== */
  .overview-page-wrapper-light .sidebar {
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
  
  .overview-page-wrapper-light .sidebar .nav-section,
  .overview-page-wrapper-light .sidebar .stats-section,
  .overview-page-wrapper-light .sidebar .tips-section {
    width: 100% !important;
    flex-shrink: 0 !important;
  }
  
  /* Style de la scrollbar pour un rendu premium - ÉPAISSE */
  .overview-page-wrapper-light .sidebar::-webkit-scrollbar {
    width: 12px !important; /* Scrollbar épaisse (12px) */
  }
  
  .overview-page-wrapper-light .sidebar::-webkit-scrollbar-track {
    background: var(--bg-secondary);
    border-radius: 10px;
    margin: 8px 0;
  }
  
  .overview-page-wrapper-light .sidebar::-webkit-scrollbar-thumb {
    background: var(--border);
    border-radius: 10px;
    border: 2px solid var(--bg-secondary);
  }
  
  .overview-page-wrapper-light .sidebar::-webkit-scrollbar-thumb:hover {
    background: var(--text-tertiary);
  }
  
  /* Support Firefox */
  .overview-page-wrapper-light .sidebar {
    scrollbar-width: thick !important;
    scrollbar-color: var(--border) var(--bg-secondary) !important;
  }
  
  /* ===== NAVIGATION ===== */
  .overview-page-wrapper-light .nav-section {
    margin-bottom: 3.5rem !important;
    width: 100% !important;
    box-sizing: border-box !important;
    position: relative !important;
    z-index: 1 !important;
    overflow: visible !important;
  }
  
  .overview-page-wrapper-light .nav-title {
    font-size: 0.75rem !important;
    font-weight: 700 !important;
    text-transform: uppercase !important;
    letter-spacing: 0.1em !important;
    color: var(--text-tertiary) !important;
    margin-bottom: 1.5rem !important;
    padding: 0 !important;
  }
  
  .overview-page-wrapper-light .nav-list {
    display: flex !important;
    flex-direction: column !important;
    gap: 0.75rem !important;
    width: 100% !important;
  }
  
  .overview-page-wrapper-light .nav-item {
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
  
  .overview-page-wrapper-light .nav-item:hover {
    background: rgba(59, 130, 246, 0.05) !important;
    color: var(--primary) !important;
    border-color: rgba(59, 130, 246, 0.1) !important;
  }
  
  .overview-page-wrapper-light .nav-item.active {
    background: linear-gradient(135deg, rgba(59, 130, 246, 0.1) 0%, rgba(139, 92, 246, 0.05) 100%) !important;
    color: var(--primary) !important;
    border-color: var(--primary) !important;
    font-weight: 600 !important;
  }
  
  .overview-page-wrapper-light .nav-icon {
    font-size: 1.25rem !important;
    flex-shrink: 0 !important;
    width: 24px !important;
    text-align: center !important;
  }
  
  /* ===== STATISTIQUES ===== */
  .overview-page-wrapper-light .stats-section {
    background: var(--bg-card);
    border: 1px solid var(--border);
    border-radius: var(--radius-xl);
    padding: 2rem;
    margin-bottom: 2.5rem;
    box-shadow: var(--shadow-sm);
  }
  
  .overview-page-wrapper-light .stats-title {
    font-size: 1.125rem;
    font-weight: 700;
    color: var(--text-primary);
    margin-bottom: 1.5rem;
    display: flex;
    align-items: center;
    gap: 0.75rem;
  }
  
  .overview-page-wrapper-light .stats-title svg {
    color: var(--primary);
  }
  
  .overview-page-wrapper-light .stats-grid {
    display: grid;
    grid-template-columns: 1fr;
    gap: 1.5rem;
  }
  
  .overview-page-wrapper-light .stat-item {
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
  }
  
  .overview-page-wrapper-light .stat-label {
    font-size: 0.875rem;
    color: var(--text-secondary);
    font-weight: 500;
  }
  
  .overview-page-wrapper-light .stat-value {
    font-size: 1.75rem;
    font-weight: 800;
    color: var(--primary);
  }
  
  .overview-page-wrapper-light .stat-value.highlight {
    color: var(--accent);
  }
  
  /* ===== CONSEILS ===== */
  .overview-page-wrapper-light .tips-section {
    background: linear-gradient(135deg, rgba(59, 130, 246, 0.03) 0%, rgba(139, 92, 246, 0.01) 100%);
    border: 1px solid var(--border);
    border-radius: var(--radius-xl);
    padding: 2rem;
    margin-top: 2.5rem;
  }
  
  .overview-page-wrapper-light .tip-header {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    margin-bottom: 1rem;
  }
  
  .overview-page-wrapper-light .tip-icon {
    font-size: 1.5rem;
    flex-shrink: 0;
  }
  
  .overview-page-wrapper-light .tip-title {
    font-size: 1rem;
    font-weight: 700;
    color: var(--text-primary);
    margin: 0;
  }
  
  .overview-page-wrapper-light .tip-content {
    font-size: 0.9rem;
    color: var(--text-secondary);
    line-height: 1.6;
    margin: 0;
  }
  
  .overview-page-wrapper-light .tip-content strong {
    color: var(--text-primary);
    font-weight: 600;
  }
  
  /* ===== RESPONSIVE ===== */
  @media (max-width: 1200px) {
    .overview-page-wrapper-light {
      padding: 10px !important; /* Décalage de 1cm (10px) sur tous les bords */
    }
    
    .overview-page-wrapper-light .dashboard-container {
      grid-template-columns: 70% 30% !important;
      gap: 0 10px !important;
    }
    
    .overview-page-wrapper-light .main-content {
      padding: 3rem 10px !important;
    }
    
    .overview-page-wrapper-light .sidebar {
      padding: 2.5rem 10px 2.5rem 2rem !important;
    }
    
    .overview-page-wrapper-light .page-header h1 {
      font-size: 2.5rem !important; /* 40px tablette */
    }
    
    .overview-page-wrapper-light .cards-horizontal-row {
      grid-template-columns: 1fr 2fr !important; /* Maintien du ratio 1:2 sur tablette */
    }
  }
  
  @media (max-width: 1024px) {
    .overview-page-wrapper-light {
      padding: 10px !important; /* Décalage de 1cm (10px) sur tous les bords */
    }
    
    .overview-page-wrapper-light .dashboard-container {
      grid-template-columns: 1fr !important;
      gap: 10px 0 !important;
    }
    
    .overview-page-wrapper-light .main-content {
      padding: 2rem 10px !important;
    }
    
    .overview-page-wrapper-light .sidebar {
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
    
    .overview-page-wrapper-light .page-header h1 {
      font-size: 2rem !important; /* 32px mobile */
    }
    
    .overview-page-wrapper-light .cards-horizontal-row {
      grid-template-columns: 1fr;
    }
    
    .overview-page-wrapper-light .nav-section {
      margin-bottom: 2.5rem !important;
    }
    
    .overview-page-wrapper-light .nav-list {
      gap: 0.75rem !important;
    }
    
    .overview-page-wrapper-light .nav-item {
      min-height: 52px !important;
      padding: 0.875rem 1rem !important;
    }
  }
  
  @media (max-width: 480px) {
    .overview-page-wrapper-light .sidebar {
      padding: 1.5rem 1rem !important;
    }
    
    .overview-page-wrapper-light .nav-section {
      margin-bottom: 2rem !important;
    }
    
    .overview-page-wrapper-light .nav-item {
      min-height: 48px !important;
      padding: 0.75rem 0.875rem !important;
      gap: 0.875rem !important;
    }
    
    .overview-page-wrapper-light .nav-icon {
      font-size: 1.125rem !important;
    }
  }
</style>

<script>
  function toggleActivityFeed() {
    const expanded = document.getElementById('activityFeedExpanded');
    const btn = document.getElementById('activityToggleBtn');
    
    if (expanded.style.display === 'none') {
      expanded.style.display = 'block';
      btn.textContent = 'Voir moins ←';
    } else {
      expanded.style.display = 'none';
      btn.textContent = 'Voir toute l\'activité →';
    }
  }
</script>
