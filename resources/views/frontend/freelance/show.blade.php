@extends('frontend.layout')

@section('pageHeading')
  {{ $user->name ?? __('Freelance') }}
@endsection

@section('metaDescription')
  {{ Str::limit($freelancer->bio ?? '', 150) }}
@endsection

@section('style')
<style>
  /* Palette Junspro Premium */
  :root {
    --junspro-primary: #4F46E5;
    --junspro-primary-dark: #4338CA;
    --junspro-secondary: #7C3AED;
    --junspro-gradient: linear-gradient(135deg, #4F46E5 0%, #7C3AED 100%);
    --junspro-bg-light: #F9FAFB;
    --junspro-border: #E5E7EB;
    --junspro-text: #111827;
    --junspro-text-light: #6B7280;
  }

  /* Application globale des couleurs Junspro */
  body {
    color: var(--junspro-text);
  }

  h1, h2, h3, h4, h5, h6 {
    color: var(--junspro-text);
  }

  /* Section "À propos de moi" - Style Premium Preply/Junspro */
  div.about-me-section-premium.card.mb-4 {
    border-radius: 16px !important;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05) !important;
    border: none !important;
    background: white !important;
    margin-bottom: 1.5rem !important;
    overflow: hidden !important;
  }
  
  div.about-me-section-premium.card.mb-4 .card-body {
    padding: 32px 40px !important;
  }
  
  div.about-me-section-premium.card.mb-4 h2 {
    font-size: 28px !important;
    font-weight: 700 !important;
    color: #202020 !important;
    line-height: 1.2 !important;
    margin-bottom: 16px !important;
    margin-top: 0 !important;
    text-align: left !important;
    font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif !important;
    letter-spacing: -0.02em !important;
  }
  
  #about-text-container-main {
    width: 100%;
  }
  
  #about-text-main {
    font-size: 16px !important;
    line-height: 1.7 !important;
    color: #202020 !important;
    margin-bottom: 0 !important;
    transition: max-height 0.4s ease, overflow 0.4s ease !important;
  }
  
  #about-text-main.expanded {
    max-height: none !important;
    overflow: visible !important;
    height: auto !important;
  }
  
  /* Forcer l'affichage complet quand expanded - sélecteur très spécifique */
  p#about-text-main.profile-about-text-identity.expanded {
    max-height: none !important;
    overflow: visible !important;
    height: auto !important;
  }
  
  /* S'assurer que le texte peut s'étendre */
  #about-text-main {
    transition: max-height 0.4s ease !important;
  }
  
  #about-toggle-main {
    color: #4F46E5 !important;
    font-size: 16px !important;
    font-weight: 500 !important;
    margin-top: 16px !important;
    display: none !important;
    text-decoration: underline !important;
    cursor: pointer !important;
  }
  
  #about-toggle-main:hover {
    color: #4338CA !important;
  }
  
  #about-toggle-main:focus {
    outline: none !important;
  }

  /* Agenda Premium */
  .agenda-table-premium {
    border-collapse: separate;
    border-spacing: 0;
  }

  .agenda-time-header {
    background: var(--junspro-bg-light) !important;
    border: 1px solid var(--junspro-border) !important;
    font-weight: 600;
    color: var(--junspro-text);
    padding: 12px;
    width: 80px;
  }

  .agenda-day-header {
    background: var(--junspro-bg-light) !important;
    border: 1px solid var(--junspro-border) !important;
    font-weight: 600;
    color: var(--junspro-text);
    padding: 12px;
  }

  .agenda-time-cell {
    background: var(--junspro-bg-light);
    border: 1px solid var(--junspro-border);
    padding: 8px;
    text-align: right;
    vertical-align: middle;
    width: 80px;
  }

  .agenda-time-label {
    font-size: 13px;
    font-weight: 500;
    color: var(--junspro-text-light);
  }

  .agenda-slot-cell {
    border: 1px solid var(--junspro-border);
    padding: 4px;
    vertical-align: middle;
    background: white;
  }

  .agenda-slot-btn-premium {
    width: 100%;
    padding: 8px 10px;
    border: 1px solid var(--junspro-border);
    border-radius: 8px;
    background: white;
    color: var(--junspro-primary);
    font-size: 13px;
    font-weight: 500;
    cursor: pointer;
    transition: all 0.2s ease;
    min-height: 36px;
    display: flex;
    align-items: center;
    justify-content: center;
  }

  .agenda-slot-btn-premium:hover {
    background: rgba(79, 70, 229, 0.08);
    border-color: var(--junspro-primary);
    color: var(--junspro-primary-dark);
    transform: translateY(-1px);
  }

  .agenda-slot-btn-premium.selected {
    background: var(--junspro-gradient);
    border-color: var(--junspro-primary);
    color: white;
    box-shadow: 0 2px 8px rgba(79, 70, 229, 0.3);
    font-weight: 600;
  }

  /* Alertes avec couleurs Junspro */
  .alert-info {
    background: linear-gradient(135deg, rgba(79, 70, 229, 0.1) 0%, rgba(124, 58, 237, 0.1) 100%);
    border: 1px solid rgba(79, 70, 229, 0.2);
    color: var(--junspro-text);
  }

  .alert-info .fas {
    color: var(--junspro-primary);
  }

  /* Boutons avec couleurs Junspro */
  .btn-outline-secondary {
    border-color: var(--junspro-border);
    color: var(--junspro-text);
  }

  .btn-outline-secondary:hover {
    background: var(--junspro-primary);
    border-color: var(--junspro-primary);
    color: white;
  }

  /* Cards avec couleurs Junspro */
  .card {
    border-color: var(--junspro-border);
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
  }

  /* Layout principal - Conteneur central */
  .freelance-page-container {
    max-width: 1280px;
    margin: 0 auto;
    padding: 80px 40px 60px 40px;
    background: #F8FAFC;
  }

  @media (max-width: 768px) {
    .freelance-page-container {
      padding: 40px 16px 30px 16px;
    }
  }

  @media (max-width: 480px) {
    .freelance-page-container {
      padding: 30px 12px 20px 12px;
    }
  }

  /* Hero en 2 colonnes */
  .freelance-hero {
    display: grid;
    grid-template-columns: 1fr 380px;
    gap: 40px;
    margin-bottom: 64px;
    align-items: start;
    margin-top: 24px;
  }

  @media (max-width: 991px) {
    .freelance-hero {
      grid-template-columns: 1fr;
      gap: 40px;
      margin-bottom: 48px;
    }
  }

  @media (max-width: 768px) {
    .freelance-hero {
      gap: 24px;
      margin-bottom: 32px;
      margin-top: 16px;
    }
  }

  @media (max-width: 480px) {
    .freelance-hero {
      gap: 16px;
      margin-bottom: 24px;
      margin-top: 12px;
    }
  }

  /* Vidéo container avec espacement */
  .freelance-video-container {
    margin-bottom: 0;
  }

  /* Style des liens Freelance dans la navbar */
  .nav-link-freelance {
    transition: color 0.2s ease, text-decoration 0.2s ease;
  }
  
  .nav-link-freelance:hover {
    color: var(--junspro-primary) !important;
    text-decoration: underline;
  }

  /* Bloc Premium Profil */
  .freelance-profile-premium-block {
    transition: box-shadow 0.3s ease;
    margin-top: 48px;
  }
  
  .freelance-profile-premium-block:hover {
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
  }

  /* Carte sticky avec marges améliorées */
  .freelance-booking-card {
    margin-top: 24px;
    margin-right: 0;
  }

  /* Styles pour les liens de traduction et toggle */
  .translation-link:hover,
  .about-toggle-link:hover {
    text-decoration: underline !important;
  }

  @media (max-width: 768px) {
    .freelance-profile-header {
      flex-direction: column;
      align-items: flex-start !important;
      gap: 20px !important;
    }
    
    .freelance-profile-header > div:first-child {
      align-self: center;
    }
    
    .freelance-profile-premium-block {
      padding: 32px 24px !important;
      border-radius: 16px !important;
      margin-top: 32px;
    }
    
    .freelance-profile-header h1 {
      font-size: 28px !important;
    }
  }

  @media (max-width: 480px) {
    .freelance-profile-header {
      gap: 16px !important;
    }
    
    .freelance-profile-premium-block {
      padding: 24px 16px !important;
      border-radius: 12px !important;
      margin-top: 24px;
    }
    
    .freelance-profile-header h1 {
      font-size: 24px !important;
    }
  }

  /* Colonne de contenu unique sous le hero */
  .freelance-content-column {
    max-width: 100%;
  }

  .freelance-content-section {
    background: white;
    border-radius: 24px;
    box-shadow: 0 2px 8px rgba(15, 23, 42, 0.06);
    padding: 40px;
    margin-bottom: 40px;
  }

  .freelance-content-section:last-child {
    margin-bottom: 0;
  }

  .freelance-section-title {
    font-size: 1.75rem;
    font-weight: 700;
    color: #111827;
    margin-bottom: 24px;
    display: flex;
    align-items: center;
    gap: 12px;
  }

  .freelance-section-title i {
    color: var(--junspro-primary);
    font-size: 1.5rem;
  }

  /* Vidéo de présentation */
  .freelance-video-container {
    position: relative;
    border-radius: 28px;
    overflow: hidden;
    background: linear-gradient(135deg, #6366F1 0%, #8B5CF6 100%);
    aspect-ratio: 16/9;
    box-shadow: 0 12px 32px rgba(79, 70, 229, 0.2);
    width: 75%;
    max-width: 75%;
    cursor: pointer;
  }
  
  .freelance-video-container:hover .freelance-video-play-btn {
    background: rgba(255, 255, 255, 0.18);
    border-color: rgba(255, 255, 255, 0.3);
    transform: translate(-50%, -50%) scale(1.08);
    box-shadow: 0 6px 20px rgba(0, 0, 0, 0.2);
  }

  .freelance-video-play-btn {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 56px;
    height: 56px;
    background: rgba(255, 255, 255, 0.12);
    backdrop-filter: blur(12px);
    border: 1px solid rgba(255, 255, 255, 0.2);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    box-shadow: 0 4px 16px rgba(0, 0, 0, 0.15);
    z-index: 1000;
    pointer-events: auto;
  }
  
  /* Style pour l'iframe YouTube dans la carte */
  .freelance-video-container iframe {
    width: 100%;
    height: 100%;
    position: absolute;
    top: 0;
    left: 0;
    border: none;
    border-radius: 28px;
  }

  .freelance-video-play-btn:hover {
    background: rgba(255, 255, 255, 0.18);
    border-color: rgba(255, 255, 255, 0.3);
    transform: translate(-50%, -50%) scale(1.08);
    box-shadow: 0 6px 20px rgba(0, 0, 0, 0.2);
  }

  /* Style pour les créneaux sélectionnés (Preply) */
  .agenda-slot-simple.selected {
    background: #EC4899 !important;
    border-color: #EC4899 !important;
    color: white !important;
  }
  
  /* Responsive pour le layout Preply */
  @media (max-width: 1024px) {
    #agenda-simple-container > div[style*="grid-template-columns"] {
      grid-template-columns: 1fr !important;
    }
    
    #agenda-simple-container > div[style*="grid-template-columns"] > div:last-child {
      border-right: none !important;
      border-top: 1px solid #E5E7EB !important;
    }
  }

  .freelance-video-play-btn svg {
    filter: drop-shadow(0 1px 3px rgba(0, 0, 0, 0.2));
  }

  /* Modal vidéo */
  .video-modal-overlay {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.9);
    z-index: 9999;
    align-items: center;
    justify-content: center;
    padding: 20px;
  }

  .video-modal-content {
    position: relative;
    width: 100%;
    max-width: 90vw;
    max-height: 90vh;
    background: #000;
    border-radius: 12px;
    overflow: hidden;
  }

  .video-modal-close {
    position: absolute;
    top: 10px;
    right: 10px;
    background: rgba(255, 255, 255, 0.9);
    border: none;
    width: 40px;
    height: 40px;
    border-radius: 50%;
    font-size: 24px;
    cursor: pointer;
    z-index: 10000;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #000;
    transition: all 0.2s ease;
  }

  .video-modal-close:hover {
    background: white;
    transform: scale(1.1);
  }

  .video-modal-iframe-container {
    width: 100%;
    padding-bottom: 56.25%; /* 16:9 aspect ratio */
    position: relative;
    height: 0;
  }

  .video-modal-iframe-container iframe {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
  }

  @media (max-width: 768px) {
    .video-modal-content {
      max-width: 95vw;
      max-height: 95vh;
    }
    
    .video-modal-iframe-container {
      padding-bottom: 75%; /* 4:3 pour mobile */
    }
  }

  .freelance-video-label {
    position: absolute;
    bottom: 20px;
    left: 20px;
    background: rgba(255, 255, 255, 0.95);
    padding: 8px 16px;
    border-radius: 8px;
    font-size: 13px;
    font-weight: 600;
    color: #374151;
  }

  /* Modal vidéo */
  .video-modal-overlay {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.9);
    z-index: 9999;
    align-items: center;
    justify-content: center;
    padding: 20px;
  }

  .video-modal-content {
    position: relative;
    width: 100%;
    max-width: 90vw;
    max-height: 90vh;
    background: #000;
    border-radius: 12px;
    overflow: hidden;
  }

  .video-modal-close {
    position: absolute;
    top: 10px;
    right: 10px;
    background: rgba(255, 255, 255, 0.9);
    border: none;
    width: 40px;
    height: 40px;
    border-radius: 50%;
    font-size: 24px;
    cursor: pointer;
    z-index: 10000;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #000;
    transition: all 0.2s ease;
  }

  .video-modal-close:hover {
    background: white;
    transform: scale(1.1);
  }

  .video-modal-iframe-container {
    width: 100%;
    padding-bottom: 56.25%; /* 16:9 aspect ratio */
    position: relative;
    height: 0;
  }

  .video-modal-iframe-container iframe {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
  }

  @media (max-width: 768px) {
    .video-modal-content {
      max-width: 95vw;
      max-height: 95vh;
    }
    
    .video-modal-iframe-container {
      padding-bottom: 75%; /* 4:3 pour mobile */
    }
  }

  /* Carte sticky premium à droite */
  .freelance-booking-card {
    background: white;
    border-radius: 24px;
    box-shadow: 0 12px 40px rgba(79, 70, 229, 0.12);
    border: 1px solid #EEF2FF;
    padding: 32px;
    position: sticky;
    top: 100px;
    max-width: 100%;
    max-height: calc(100vh - 120px);
    overflow-y: auto;
    margin-left: 0;
    margin-right: 0;
  }

  @media (max-width: 991px) {
    .freelance-booking-card {
      position: relative;
      top: 0;
      max-height: none;
      margin-top: 0;
    }
  }

  .profile-popularity-banner {
    background: #FEF2F2;
    color: #B91C1C;
    font-weight: 700;
    font-size: 13px;
    padding: 8px 14px;
    border-radius: 999px;
    width: fit-content;
    display: inline-flex;
    align-items: center;
    gap: 6px;
    margin-bottom: 20px;
  }

  .profile-rating-price-row {
    display: flex;
    align-items: flex-start;
    justify-content: space-between;
    margin-bottom: 24px;
  }

  .profile-rating-block {
    display: flex;
    align-items: center;
    gap: 8px;
  }

  .profile-rating-number {
    font-size: 32px;
    font-weight: 800;
    color: #0F172A;
    line-height: 1;
  }

  .profile-rating-star {
    color: #F59E0B;
    font-size: 20px;
  }

  .profile-reviews-count {
    font-size: 13px;
    color: #6B7280;
    margin-top: 4px;
  }

  .profile-price-block {
    text-align: right;
  }

  .profile-price-main {
    font-size: 32px;
    font-weight: 800;
    color: #0F172A;
    line-height: 1;
  }

  .profile-price-unit {
    font-size: 14px;
    font-weight: 600;
    color: #6B7280;
  }

  .profile-stats-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 12px;
    margin-bottom: 16px;
  }

  .profile-stat-card {
    background: #F8FAFC;
    border: 1px solid #E5E7EB;
    border-radius: 12px;
    padding: 16px;
  }

  .profile-stat-label {
    font-size: 12px;
    color: #6B7280;
    margin-bottom: 8px;
  }

  .profile-stat-value {
    font-weight: 700;
    color: #0F172A;
    font-size: 18px;
  }

  .profile-last-seen {
    background: #F8FAFC;
    border: 1px solid #E5E7EB;
    border-radius: 12px;
    padding: 16px;
    margin-bottom: 24px;
  }

  .profile-cta-primary {
    width: 100%;
    padding: 16px 24px;
    background: var(--junspro-gradient);
    color: white;
    border-radius: 20px;
    font-size: 16px;
    font-weight: 700;
    box-shadow: 0 8px 24px rgba(79, 70, 229, 0.3);
    border: none;
    margin-bottom: 12px;
    transition: transform 0.2s, box-shadow 0.2s;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
  }

  .profile-cta-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 12px 32px rgba(79, 70, 229, 0.4);
    color: white;
    text-decoration: none;
  }

  .profile-cta-secondary {
    width: 100%;
    padding: 14px 24px;
    background: white;
    color: var(--junspro-text);
    border: 1px solid var(--junspro-border);
    border-radius: 12px;
    font-size: 15px;
    font-weight: 600;
    margin-bottom: 12px;
    transition: all 0.2s;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
  }

  .profile-cta-secondary:hover {
    background: #F8FAFC;
    border-color: var(--junspro-primary);
    color: var(--junspro-primary);
  }

  .profile-cta-link {
    width: 100%;
    padding: 14px 24px;
    background: transparent;
    color: var(--junspro-primary);
    border: none;
    border-radius: 12px;
    font-size: 15px;
    font-weight: 600;
    text-decoration: none;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    transition: color 0.2s;
  }

  .profile-cta-link:hover {
    color: var(--junspro-primary-dark);
    text-decoration: underline;
  }

  /* Fond de page */
  body.profile-page {
    background: #F8FAFC;
  }

  /* Responsive amélioré */
  @media (max-width: 768px) {
    .freelance-content-section {
      padding: 32px 24px;
    }

    .freelance-section-title {
      font-size: 1.5rem;
    }

    .freelance-video-container {
      border-radius: 20px;
    }

    .freelance-booking-card {
      border-radius: 20px;
      padding: 24px;
    }
  }

  @media (max-width: 480px) {
    .freelance-content-section {
      padding: 24px 16px;
      border-radius: 16px;
      margin-bottom: 24px;
    }

    .freelance-section-title {
      font-size: 1.25rem;
      margin-bottom: 16px;
    }

    .freelance-video-container {
      border-radius: 16px;
    }

    .freelance-booking-card {
      border-radius: 16px;
      padding: 20px 16px;
    }
  }

  .card-title {
    color: var(--junspro-text);
    font-weight: 600;
  }

  /* Badges avec couleurs Junspro */
  .badge {
    background: rgba(79, 70, 229, 0.1);
    color: var(--junspro-primary);
  }

  /* Liens avec couleurs Junspro */
  a {
    color: var(--junspro-primary);
  }

  a:hover {
    color: var(--junspro-primary-dark);
  }

  /* Form controls */
  .form-select {
    border-color: var(--junspro-border);
  }

  .form-select:focus {
    border-color: var(--junspro-primary);
    box-shadow: 0 0 0 0.2rem rgba(79, 70, 229, 0.25);
  }

  /* Correction des superpositions */
  .sticky-top {
    z-index: 10;
  }

  .card {
    position: relative;
    z-index: 1;
  }

  /* S'assurer que les boutons sont cliquables */
  .btn, button, a.btn {
    position: relative;
    z-index: 10;
    pointer-events: auto !important;
  }

  /* S'assurer que les formulaires sont cliquables */
  form {
    position: relative;
    z-index: 1;
    pointer-events: auto !important;
  }

  /* S'assurer que la vidéo ne bloque pas les autres éléments */
  #play-video-btn {
    pointer-events: auto !important;
    z-index: 100 !important;
  }

  /* Hover effects pour CTA */
  .card-body a.btn:hover {
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(79, 70, 229, 0.4) !important;
  }

  /* About text toggle (style Preply) */
  .profile-about-text-identity {
    transition: max-height 0.4s ease, overflow 0.4s ease !important;
  }

  .profile-about-text-identity.expanded {
    max-height: none !important;
    overflow: visible !important;
  }

  .profile-about-toggle-link {
    transition: color 0.2s ease !important;
  }

  .profile-about-toggle-link:hover {
    color: var(--junspro-primary-dark) !important;
    text-decoration: underline !important;
  }
  
  /* Style pour la ligne traduction */
  #show-original-text:hover {
    text-decoration: underline;
  }
  
  /* Style Preply pour le titre */
  h2[style*="font-size: 28px"] {
    font-size: 28px !important;
    font-weight: 700 !important;
    color: #202020 !important;
    letter-spacing: -0.02em !important;
  }
</style>
@endsection

@section('script')
<script>
  // ============================================
  // DÉFINITIONS GLOBALES (AVANT TOUT)
  // ============================================
  
  // Définir videoUrl globalement AVANT les fonctions
  @php
    $hasVideo = isset($freelancer) && $freelancer && !empty($freelancer->video_url);
    $videoUrlValue = $hasVideo ? $freelancer->video_url : null;
  @endphp
  @if($hasVideo)
    window.videoUrl = @json($videoUrlValue);
    console.log('✅ Video URL définie:', window.videoUrl);
  @else
    window.videoUrl = null;
    console.warn('⚠️ Aucune vidéo URL trouvée. Freelancer ID:', @json(isset($freelancer) ? $freelancer->id : 'non défini'), 'video_url:', @json(isset($freelancer) && $freelancer ? $freelancer->video_url : 'non défini'));
  @endif
  
  // Fonction pour ouvrir la modal vidéo (définie GLOBALEMENT)
  window.openVideoModal = function(videoUrl) {
    try {
      if (!videoUrl) {
        console.error('Aucune URL vidéo fournie');
        alert('{{ __("Aucune vidéo disponible pour le moment") }}');
        return;
      }
      
      // Créer la modal si elle n'existe pas
      let modal = document.getElementById('video-modal');
      if (!modal) {
        modal = document.createElement('div');
        modal.id = 'video-modal';
        modal.className = 'video-modal-overlay';
        modal.innerHTML = '<div class="video-modal-content"><button class="video-modal-close" id="video-modal-close">&times;</button><div class="video-modal-iframe-container" id="video-iframe-container"></div></div>';
        document.body.appendChild(modal);
        
        // Fermer la modal au clic sur le bouton fermer
        const closeBtn = document.getElementById('video-modal-close');
        if (closeBtn) {
          closeBtn.addEventListener('click', window.closeVideoModal);
        }
        
        // Fermer la modal au clic en dehors
        modal.addEventListener('click', function(e) {
          if (e.target === modal) {
            window.closeVideoModal();
          }
        });
        
        // Fermer avec ESC
        document.addEventListener('keydown', function(e) {
          if (e.key === 'Escape' && modal.style.display === 'flex') {
            window.closeVideoModal();
          }
        });
      }
      
      // Convertir l'URL YouTube si nécessaire
      let embedUrl = videoUrl;
      if (typeof videoUrl === 'string') {
        if (videoUrl.includes('youtube.com/watch?v=')) {
          const videoId = videoUrl.split('v=')[1].split('&')[0];
          embedUrl = 'https://www.youtube.com/embed/' + videoId;
        } else if (videoUrl.includes('youtu.be/')) {
          const videoId = videoUrl.split('youtu.be/')[1].split('?')[0];
          embedUrl = 'https://www.youtube.com/embed/' + videoId;
        } else if (videoUrl.includes('vimeo.com/')) {
          const videoId = videoUrl.split('vimeo.com/')[1].split('?')[0];
          embedUrl = 'https://player.vimeo.com/video/' + videoId;
        }
      }
      
      // Afficher la modal et charger la vidéo
      const iframeContainer = document.getElementById('video-iframe-container');
      if (iframeContainer) {
        iframeContainer.innerHTML = '<iframe src="' + embedUrl + '" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';
      }
      modal.style.display = 'flex';
      document.body.style.overflow = 'hidden';
    } catch (error) {
      console.error('Erreur lors de l\'ouverture de la modal vidéo:', error);
      alert('{{ __("Erreur lors du chargement de la vidéo") }}');
    }
  };
  
  // Fonction pour fermer la modal vidéo (définie GLOBALEMENT)
  window.closeVideoModal = function() {
    try {
      const modal = document.getElementById('video-modal');
      if (modal) {
        modal.style.display = 'none';
        document.body.style.overflow = '';
        // Vider l'iframe pour arrêter la vidéo
        const iframeContainer = document.getElementById('video-iframe-container');
        if (iframeContainer) {
          iframeContainer.innerHTML = '';
        }
      }
    } catch (error) {
      console.error('Erreur lors de la fermeture de la modal vidéo:', error);
    }
  };
  
  // Vérification immédiate après définition
  console.log('✅ Script vidéo chargé. videoUrl:', window.videoUrl, 'openVideoModal:', typeof window.openVideoModal);
  
  // Vérification que les variables sont bien définies sur window
  if (typeof window.videoUrl === 'undefined') {
    console.error('❌ ERREUR: window.videoUrl n\'est pas défini!');
  }
  if (typeof window.openVideoModal === 'undefined') {
    console.error('❌ ERREUR: window.openVideoModal n\'est pas défini!');
  }

  // ============================================
  // CODE APRÈS CHARGEMENT DU DOM
  // ============================================
  
  // Gestion de l'agenda
  document.addEventListener('DOMContentLoaded', function() {
    const prevBtn = document.getElementById('agenda-prev-week');
    const nextBtn = document.getElementById('agenda-next-week');
    const weekDisplay = document.getElementById('agenda-week-display');
    const timezoneSelect = document.getElementById('agenda-timezone');
    const slotBtns = document.querySelectorAll('.agenda-slot-btn-premium');

    let currentWeek = 0;
    window.currentWeek = 0; // Variable globale pour être accessible depuis onclick

    // Rendre la fonction globale pour être accessible depuis onclick
    window.updateWeekDisplay = function() {
      const today = new Date();
      // Commencer le lundi (day 1)
      const startOfWeek = new Date(today);
      const dayOfWeek = today.getDay(); // 0 = dimanche, 1 = lundi, etc.
      const daysToMonday = dayOfWeek === 0 ? 6 : dayOfWeek - 1; // Si dimanche, aller à lundi précédent
      startOfWeek.setDate(today.getDate() - daysToMonday + (window.currentWeek * 7));
      startOfWeek.setHours(0, 0, 0, 0);
      const endOfWeek = new Date(startOfWeek);
      endOfWeek.setDate(startOfWeek.getDate() + 6); // Dimanche

      // Noms des mois en français
      const monthNames = ['janvier', 'février', 'mars', 'avril', 'mai', 'juin', 
                          'juillet', 'août', 'septembre', 'octobre', 'novembre', 'décembre'];
      
      // Noms des mois en français (format Preply : abrégé)
      const monthNamesShort = ['janv.', 'févr.', 'mars', 'avr.', 'mai', 'juin', 
                               'juil.', 'août', 'sept.', 'oct.', 'nov.', 'déc.'];
      const dayNames = ['Lun', 'Mar', 'Mer', 'Jeu', 'Ven', 'Sam', 'Dim'];
      
      const startDay = startOfWeek.getDate();
      const startMonth = monthNamesShort[startOfWeek.getMonth()];
      const endDay = endOfWeek.getDate();
      const endMonth = monthNamesShort[endOfWeek.getMonth()];
      const year = endOfWeek.getFullYear();
      
      const weekDisplayEl = document.getElementById('agenda-week-display');
      if (weekDisplayEl) {
        if (startMonth === endMonth) {
          weekDisplayEl.textContent = `${startDay} ${startMonth} – ${endDay} ${endMonth} ${year}`;
        } else {
          weekDisplayEl.textContent = `${startDay} ${startMonth} – ${endDay} ${endMonth} ${year}`;
        }
      }
      
      // Mettre à jour les jours dans les en-têtes (format Preply : "Lun. 26")
      for (let i = 0; i < 7; i++) {
        const date = new Date(startOfWeek);
        date.setDate(date.getDate() + i);
        const dayElement = document.getElementById('agenda-day-' + i);
        if (dayElement) {
          const dayNum = date.getDate();
          dayElement.textContent = `${dayNames[i]}. ${dayNum}`;
        }
      }
      
      // Mettre à jour l'affichage des créneaux réservés pour la semaine sélectionnée
      updateBookedSlotsForWeek(startOfWeek);
    };
    
    // Fonction pour mettre à jour l'affichage des créneaux réservés
    function updateBookedSlotsForWeek(startOfWeek) {
      if (!window.bookedSlotsByDate) return;
      
      // Parcourir toutes les cellules du calendrier
      const slotButtons = document.querySelectorAll('.agenda-slot-simple');
      slotButtons.forEach(button => {
        const day = parseInt(button.dataset.day);
        const hour = parseInt(button.dataset.hour);
        const minute = parseInt(button.dataset.minute) || 0;
        
        if (isNaN(day) || isNaN(hour)) return;
        
        // Calculer la date exacte pour ce jour de la semaine
        const date = new Date(startOfWeek);
        date.setDate(startOfWeek.getDate() + day);
        const dateKey = date.getFullYear() + '-' + 
                       String(date.getMonth() + 1).padStart(2, '0') + '-' + 
                       String(date.getDate()).padStart(2, '0');
        
        // Vérifier si ce créneau est réservé (avec minutes)
        const isBooked = window.bookedSlotsByDate[dateKey] && 
                        window.bookedSlotsByDate[dateKey][hour] && 
                        window.bookedSlotsByDate[dateKey][hour][minute];
        
        if (isBooked) {
          // Créneau réservé - le désactiver visuellement
          button.disabled = true;
          button.style.background = '#F3F4F6';
          button.style.borderColor = '#E5E7EB';
          button.style.color = '#9CA3AF';
          button.style.cursor = 'not-allowed';
          button.classList.add('booked');
          button.title = '{{ __("Créneau déjà réservé") }}';
        } else {
          // Créneau disponible - s'assurer qu'il est activé
          button.disabled = false;
          if (!button.classList.contains('selected')) {
            // Vérifier si c'est un créneau configuré (fond blanc) ou non configuré (fond gris clair)
            const currentBg = window.getComputedStyle(button).backgroundColor;
            const isConfigured = currentBg === 'rgb(255, 255, 255)' || button.style.background === 'white' || button.style.background === 'rgb(255, 255, 255)';
            
            if (isConfigured) {
              // Créneau configuré - style blanc
              button.style.background = 'white';
              button.style.borderColor = '#E5E7EB';
              button.style.color = '#111827';
              button.style.opacity = '1';
            } else {
              // Créneau non configuré - style gris clair
              button.style.background = '#F9FAFB';
              button.style.borderColor = '#E5E7EB';
              button.style.color = '#6B7280';
              button.style.opacity = '0.7';
            }
            button.style.cursor = 'pointer';
          }
          button.classList.remove('booked');
          button.title = '';
        }
      });
    }
    
    // Alias pour compatibilité
    const updateWeekDisplay = window.updateWeekDisplay;

    // Fonction pour initialiser les boutons de navigation
    function initAgendaNavigation() {
      const prevBtn = document.getElementById('agenda-prev-week');
      const nextBtn = document.getElementById('agenda-next-week');
      
      if (prevBtn) {
        // Supprimer tous les anciens listeners en clonant le bouton
        const newPrevBtn = prevBtn.cloneNode(true);
        prevBtn.parentNode.replaceChild(newPrevBtn, prevBtn);
        newPrevBtn.addEventListener('click', function(e) {
          e.preventDefault();
          e.stopPropagation();
          currentWeek--;
          updateWeekDisplay();
        });
      }

      if (nextBtn) {
        // Supprimer tous les anciens listeners en clonant le bouton
        const newNextBtn = nextBtn.cloneNode(true);
        nextBtn.parentNode.replaceChild(newNextBtn, nextBtn);
        newNextBtn.addEventListener('click', function(e) {
          e.preventDefault();
          e.stopPropagation();
          currentWeek++;
          updateWeekDisplay();
        });
      }
      
      // Initialiser l'affichage
      updateWeekDisplay();
    }

    // Initialiser au chargement
    setTimeout(function() {
      initAgendaNavigation();
    }, 100);
    
    // Réinitialiser quand l'agenda est ouvert via le bouton toggle
    const agendaToggleBtn = document.getElementById('agenda-toggle-simple');
    if (agendaToggleBtn) {
      agendaToggleBtn.addEventListener('click', function() {
        setTimeout(function() {
          initAgendaNavigation();
        }, 300);
      });
    }
    
    // Utiliser la délégation d'événements pour s'assurer que les boutons fonctionnent même s'ils sont ajoutés dynamiquement
    document.addEventListener('click', function(e) {
      // Vérifier si le clic est sur le bouton précédent ou son icône
      if (e.target && (e.target.id === 'agenda-prev-week' || e.target.closest('#agenda-prev-week'))) {
        e.preventDefault();
        e.stopPropagation();
        currentWeek--;
        updateWeekDisplay();
        return false;
      }
      // Vérifier si le clic est sur le bouton suivant ou son icône
      if (e.target && (e.target.id === 'agenda-next-week' || e.target.closest('#agenda-next-week'))) {
        e.preventDefault();
        e.stopPropagation();
        currentWeek++;
        updateWeekDisplay();
        return false;
      }
    });
    
    // Forcer l'initialisation après un délai supplémentaire
    setTimeout(function() {
      initAgendaNavigation();
    }, 1000);

    slotBtns.forEach(btn => {
      btn.addEventListener('click', function() {
        // Désélectionner tous les autres
        slotBtns.forEach(b => {
          b.classList.remove('selected');
        });
        // Sélectionner celui-ci
        this.classList.add('selected');
        
        // Ici, vous pouvez ajouter la logique de réservation
        const day = this.dataset.day;
        const hour = this.dataset.hour;
        console.log('Créneau sélectionné:', day, hour);
      });
    });

    updateWeekDisplay();
  });

  // Fonction pour définir le type de réservation (hebdomadaire/ponctuelle)
  window.setBookingType = function(type) {
    try {
      const weeklyBtn = document.getElementById('booking-type-weekly');
      const onetimeBtn = document.getElementById('booking-type-onetime');
      
      if (!weeklyBtn || !onetimeBtn) {
        console.error('Boutons de type de réservation non trouvés');
        return;
      }
      
      if (type === 'weekly') {
        weeklyBtn.style.borderColor = '#EC4899';
        weeklyBtn.style.background = '#FDF2F8';
        onetimeBtn.style.borderColor = '#E5E7EB';
        onetimeBtn.style.background = 'white';
        window.bookingType = 'weekly';
      } else {
        onetimeBtn.style.borderColor = '#EC4899';
        onetimeBtn.style.background = '#FDF2F8';
        weeklyBtn.style.borderColor = '#E5E7EB';
        weeklyBtn.style.background = 'white';
        window.bookingType = 'onetime';
      }
    } catch (error) {
      console.error('Erreur dans setBookingType:', error);
    }
  };
  
  // Fonction pour revenir à aujourd'hui
  window.goToToday = function() {
    try {
      window.currentWeek = 0;
      if (typeof window.updateWeekDisplay === 'function') {
        window.updateWeekDisplay();
      } else {
        console.error('updateWeekDisplay non définie');
      }
    } catch (error) {
      console.error('Erreur dans goToToday:', error);
    }
  };
  
  // Initialiser le type de réservation par défaut
  window.bookingType = 'onetime';
  
  // Gestion des Rituels sélectionnés
  window.selectedSlots = [];
  window.maxCourses = 5; // Nombre maximum de Rituels à programmer
  
  // Fonction pour ajouter un créneau sélectionné (avec minutes pour Preply)
  window.addSelectedSlot = function(day, hour, minute) {
    minute = minute || 0; // Par défaut 0 si non spécifié
    
    if (window.selectedSlots.length >= window.maxCourses) {
      alert('{{ __("Vous ne pouvez programmer que :max Rituels maximum", ["max" => 5]) }}');
      return;
    }
    
    const slotKey = `${day}-${hour}-${minute}`;
    if (window.selectedSlots.find(s => s.key === slotKey)) {
      return; // Déjà sélectionné
    }
    
    const slot = {
      key: slotKey,
      day: day,
      hour: hour,
      minute: minute,
      courseNumber: window.selectedSlots.length + 1
    };
    
    window.selectedSlots.push(slot);
    updateCoursesList();
    updateScheduleButton();
  };
  
  // Fonction pour retirer un créneau
  window.removeSelectedSlot = function(slotKey) {
    window.selectedSlots = window.selectedSlots.filter(s => s.key !== slotKey);
    // Réorganiser les numéros de Rituels
    window.selectedSlots.forEach((slot, index) => {
      slot.courseNumber = index + 1;
    });
    updateCoursesList();
    updateScheduleButton();
    // Désélectionner le bouton dans le calendrier
    const btn = document.querySelector(`[data-slot-key="${slotKey}"]`);
    if (btn) {
      btn.classList.remove('selected');
      btn.style.background = 'white';
      btn.style.borderColor = '#E5E7EB';
      btn.style.color = '#111827';
    }
  };
  
  // Fonction pour mettre à jour la liste des Rituels (style Preply)
  function updateCoursesList() {
    const coursesCount = document.getElementById('courses-count');
    const emptyState = document.getElementById('courses-empty-state');
    
    if (!coursesCount) return;
    
    // Masquer tous les conteneurs de Rituels
    for (let i = 1; i <= 5; i++) {
      const container = document.getElementById('course-' + i + '-container');
      if (container) {
        container.style.display = 'none';
      }
    }
    
    if (window.selectedSlots.length === 0) {
      // Afficher l'état vide
      if (emptyState) {
        emptyState.style.display = 'block';
      }
    } else {
      // Masquer l'état vide
      if (emptyState) {
        emptyState.style.display = 'none';
      }
      
      // Afficher les Rituels sélectionnés
      window.selectedSlots.forEach((slot) => {
        const dayNames = ['Lun', 'Mar', 'Mer', 'Jeu', 'Ven', 'Sam', 'Dim'];
        const hourStr = String(slot.hour).padStart(2, '0') + ':' + String(slot.minute || 0).padStart(2, '0');
        const courseContainer = document.getElementById('course-' + slot.courseNumber + '-container');
        const courseTime = document.getElementById('course-' + slot.courseNumber + '-time');
        
        if (courseContainer) {
          courseContainer.style.display = 'block';
        }
        if (courseTime) {
          courseTime.textContent = `${dayNames[slot.day]}. ${hourStr}`;
        }
      });
    }
    
    if (coursesCount) {
      coursesCount.textContent = window.selectedSlots.length;
    }
  }
  
  // Fonction pour retirer un Rituel spécifique (par numéro)
  window.removeCourseSlot = function(courseNumber) {
    const slot = window.selectedSlots.find(s => s.courseNumber === courseNumber);
    if (slot) {
      removeSelectedSlot(slot.key);
    }
  };
  
  // Fonction pour mettre à jour le bouton Programmer (Style Preply - bleu clair)
  function updateScheduleButton() {
    const scheduleBtn = document.getElementById('schedule-btn');
    if (!scheduleBtn) return;
    
    if (window.selectedSlots.length > 0) {
      scheduleBtn.style.background = '#3B82F6'; // Bleu Preply
      scheduleBtn.style.cursor = 'pointer';
      scheduleBtn.disabled = false;
      scheduleBtn.onmouseover = function() {
        this.style.background = '#2563EB';
        this.style.transform = 'translateY(-1px)';
        this.style.boxShadow = '0 4px 12px rgba(59, 130, 246, 0.3)';
      };
      scheduleBtn.onmouseout = function() {
        this.style.background = '#3B82F6';
        this.style.transform = 'translateY(0)';
        this.style.boxShadow = 'none';
      };
    } else {
      scheduleBtn.style.background = '#6B7280';
      scheduleBtn.style.cursor = 'not-allowed';
      scheduleBtn.disabled = true;
      scheduleBtn.onmouseover = null;
      scheduleBtn.onmouseout = null;
    }
  }
  
  // Modifier les boutons de créneaux pour ajouter la sélection (avec minutes pour Preply)
  document.addEventListener('click', function(e) {
    if (e.target && e.target.classList.contains('agenda-slot-simple')) {
      e.preventDefault();
      e.stopPropagation();
      
      const day = parseInt(e.target.dataset.day);
      const hour = parseInt(e.target.dataset.hour);
      const minute = parseInt(e.target.dataset.minute) || 0;
      const slotKey = `${day}-${hour}-${minute}`;
      
      // Vérifier si le créneau est réservé
      if (e.target.classList.contains('booked') || e.target.disabled) {
        return; // Ne pas permettre la sélection d'un créneau réservé
      }
      
      // Vérifier si déjà sélectionné
      const isSelected = window.selectedSlots.find(s => s.key === slotKey);
      
      if (isSelected) {
        // Retirer la sélection
        removeSelectedSlot(slotKey);
        e.target.classList.remove('selected');
        // Restaurer le style selon l'état initial (disponible ou non configuré)
        if (e.target.style.background === 'rgb(249, 250, 251)' || e.target.style.background === '#F9FAFB') {
          // Créneau non configuré
          e.target.style.background = '#F9FAFB';
          e.target.style.borderColor = '#E5E7EB';
          e.target.style.color = '#6B7280';
          e.target.style.opacity = '0.7';
        } else {
          // Créneau disponible
          e.target.style.background = 'white';
          e.target.style.borderColor = '#E5E7EB';
          e.target.style.color = '#111827';
        }
      } else {
        // Ajouter la sélection
        addSelectedSlot(day, hour, minute);
        e.target.classList.add('selected');
        e.target.style.background = '#EC4899';
        e.target.style.borderColor = '#EC4899';
        e.target.style.color = 'white';
        e.target.style.opacity = '1';
        e.target.setAttribute('data-slot-key', slotKey);
      }
    }
  });
  
  // Fonction pour gérer le clic sur le bouton Programmer
  window.handleScheduleClick = function() {
    try {
      if (window.selectedSlots.length === 0) {
        alert('{{ __("Veuillez sélectionner au moins un créneau") }}');
        return;
      }
      
      // Afficher un message de confirmation
      const slotsText = window.selectedSlots.map(slot => {
        const dayNames = ['Lun', 'Mar', 'Mer', 'Jeu', 'Ven', 'Sam', 'Dim'];
        const hourStr = String(slot.hour).padStart(2, '0') + ':' + String(slot.minute || 0).padStart(2, '0');
        return `${dayNames[slot.day]}. ${hourStr}`;
      }).join(', ');
      
      const rituelText = window.selectedSlots.length <= 1 ? '{{ __("Rituel") }}' : '{{ __("Rituels") }}';
      if (confirm(`{{ __('Confirmer la programmation de') }} ${window.selectedSlots.length} ${rituelText} ?\n\n${slotsText}`)) {
        // Ici, vous pouvez ajouter l'appel API pour programmer les Rituels
        alert('{{ __("Programmation en cours... Cette fonctionnalité sera bientôt disponible.") }}');
        console.log('Rituels à programmer:', window.selectedSlots);
      }
    } catch (error) {
      console.error('Erreur dans handleScheduleClick:', error);
      alert('{{ __("Une erreur est survenue") }}');
    }
  };
  
  // Initialiser la liste des Rituels
  setTimeout(function() {
    updateCoursesList();
    updateScheduleButton();
  }, 500);
  
  // S'assurer que les fonctions sont disponibles dès le chargement
  document.addEventListener('DOMContentLoaded', function() {
    // Réinitialiser les boutons de navigation
    const prevBtn = document.getElementById('agenda-prev-week');
    const nextBtn = document.getElementById('agenda-next-week');
    const todayBtn = document.getElementById('agenda-today-btn');
    
    if (prevBtn) {
      prevBtn.addEventListener('click', function(e) {
        e.preventDefault();
        e.stopPropagation();
        if (typeof window.currentWeek !== 'undefined') {
          window.currentWeek--;
        } else {
          window.currentWeek = -1;
        }
        if (typeof window.updateWeekDisplay === 'function') {
          window.updateWeekDisplay();
        }
      });
    }
    
    if (nextBtn) {
      nextBtn.addEventListener('click', function(e) {
        e.preventDefault();
        e.stopPropagation();
        if (typeof window.currentWeek !== 'undefined') {
          window.currentWeek++;
        } else {
          window.currentWeek = 1;
        }
        if (typeof window.updateWeekDisplay === 'function') {
          window.updateWeekDisplay();
        }
      });
    }
    
    if (todayBtn) {
      todayBtn.addEventListener('click', function(e) {
        e.preventDefault();
        e.stopPropagation();
        window.goToToday();
      });
    }
    
    // S'assurer que setBookingType fonctionne
    const weeklyBtn = document.getElementById('booking-type-weekly');
    const onetimeBtn = document.getElementById('booking-type-onetime');
    
    if (weeklyBtn) {
      weeklyBtn.addEventListener('click', function(e) {
        e.preventDefault();
        e.stopPropagation();
        window.setBookingType('weekly');
      });
    }
    
    if (onetimeBtn) {
      onetimeBtn.addEventListener('click', function(e) {
        e.preventDefault();
        e.stopPropagation();
        window.setBookingType('onetime');
      });
    }
  });

  // Calcul du total pour l'abonnement
  document.addEventListener('DOMContentLoaded', function() {
    @if(isset($freelancer) && isset($freelancer->hourly_rate))
      const hourlyRate = {{ $freelancer->hourly_rate }};
    @else
      const hourlyRate = 0;
    @endif
    const form = document.getElementById('subscriptionForm');
    if (!form) return;
    
    const totalElement = document.getElementById('total_4_weeks');
    const detailsElement = document.getElementById('calculation_details');
    
    function calculateTotal() {
      const weeklyHours = parseInt(document.querySelector('input[name="weekly_hours"]:checked')?.value || 1);
      const deliveryMode = document.querySelector('input[name="delivery_mode"]:checked')?.value || 'standard';
      
      let baseTotal = weeklyHours * hourlyRate * 4;
      let multiplier = 1;
      let expressText = '';
      
      if (deliveryMode === 'express_24h') {
        multiplier = 1.30;
        expressText = ' (+30% Express 24h)';
      } else if (deliveryMode === 'express_48h') {
        multiplier = 1.20;
        expressText = ' (+20% Express 48h)';
      } else if (deliveryMode === 'express_72h') {
        multiplier = 1.10;
        expressText = ' (+10% Express 72h)';
      }
      
      const finalTotal = baseTotal * multiplier;
      
      if (totalElement) {
        totalElement.textContent = finalTotal.toFixed(2).replace('.', ',') + ' €';
      }
      if (detailsElement) {
        detailsElement.textContent = `${weeklyHours}h/semaine × ${hourlyRate.toFixed(2).replace('.', ',')} €/h × 4 semaines${expressText}`;
      }
    }
    
    // Écouter les changements
    form.querySelectorAll('input[type="radio"]').forEach(input => {
      input.addEventListener('change', calculateTotal);
    });
    
    // Calcul initial
    calculateTotal();
  });

  // Toggle "Voir plus" pour À propos de moi - Version sécurisée
  try {
    window.addEventListener('load', function() {
      setTimeout(function() {
        try {
          var aboutToggleMain = document.getElementById('about-toggle-main');
          var aboutTextMain = document.getElementById('about-text-main');
          
          if (!aboutTextMain || !aboutToggleMain) {
            return;
          }
          
          // Initialiser la troncature
          function initTruncate() {
            try {
              aboutTextMain.style.maxHeight = 'none';
              aboutTextMain.style.overflow = 'visible';
              
              setTimeout(function() {
                try {
                  var originalHeight = aboutTextMain.scrollHeight;
                  var maxHeight = 27.2 * 4; // 4 lignes = 108.8px
                  
                  if (originalHeight > maxHeight) {
        aboutTextMain.style.maxHeight = '6.8em';
        aboutTextMain.style.overflow = 'hidden';
        aboutToggleMain.style.display = 'inline-block';
      } else {
        aboutToggleMain.style.display = 'none';
                  }
                } catch (err) {
                  console.error('Erreur initTruncate setTimeout:', err);
                }
              }, 100);
            } catch (err) {
              console.error('Erreur initTruncate:', err);
            }
          }
          
          // Gérer le clic sur "Voir plus" / "Voir moins"
      aboutToggleMain.addEventListener('click', function(e) {
            try {
        e.preventDefault();
              e.stopPropagation();
              
              var isExpanded = aboutTextMain.classList.contains('expanded');
        
        if (isExpanded) {
          // Replier
          aboutTextMain.style.maxHeight = '6.8em';
          aboutTextMain.style.overflow = 'hidden';
          aboutTextMain.classList.remove('expanded');
          this.textContent = '{{ __("Voir plus") }}';
        } else {
          // Déplier
          aboutTextMain.style.maxHeight = 'none';
          aboutTextMain.style.overflow = 'visible';
                aboutTextMain.style.height = 'auto';
          aboutTextMain.classList.add('expanded');
          this.textContent = '{{ __("Voir moins") }}';
              }
              
              return false;
            } catch (err) {
              console.error('Erreur toggle click:', err);
            }
          });
          
          // Initialiser la troncature
          initTruncate();
        } catch (err) {
          console.error('Erreur setupAboutMeToggle:', err);
        }
      }, 500);
    });
  } catch (err) {
    console.error('Erreur globale AboutMe:', err);
  }

  // Gestion du lien "Voir le texte original" (si traduction active)
    const showOriginalText = document.getElementById('show-original-text');
    if (showOriginalText) {
      showOriginalText.addEventListener('click', function(e) {
        e.preventDefault();
        // Logique pour basculer entre texte traduit et original
        // À implémenter selon votre système de traduction
        console.log('Afficher le texte original');
      });
    }

    // Supprimer tout titre "Vidéo de présentation" visible au-dessus de la vidéo
    const videoContainer = document.querySelector('.col-lg-8 .mb-4');
    if (videoContainer) {
      const videoSection = videoContainer.querySelector('[style*="aspect-ratio: 16/9"]');
      if (videoSection) {
        const parent = videoSection.closest('.col-lg-8');
        if (parent) {
          const allChildren = Array.from(parent.children);
          allChildren.forEach((child) => {
            const text = child.textContent || child.innerText || '';
            if (text.includes('Vidéo de présentation') && child !== videoContainer) {
              child.style.display = 'none';
            }
          });
        }
      }
    }

    // Les définitions de window.videoUrl et window.openVideoModal sont déjà faites au début du script
    // Bouton play vidéo - Initialisation après chargement du DOM
    function initVideoButton() {
      try {
        const playVideoBtn = document.getElementById('play-video-btn');
        const videoContainer = document.getElementById('video-container');
        
        // Utiliser window.videoUrl qui est déjà défini globalement
        const videoUrl = window.videoUrl;
        
        if (playVideoBtn) {
          // Clic sur le bouton
          playVideoBtn.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            console.log('Bouton vidéo cliqué, videoUrl:', window.videoUrl);
            if (window.videoUrl && typeof window.openVideoModal === 'function') {
              window.openVideoModal(window.videoUrl);
            } else {
              console.warn('Aucune vidéo disponible ou fonction openVideoModal non définie. videoUrl:', window.videoUrl);
              alert('{{ __("Aucune vidéo disponible pour le moment") }}');
            }
          });
          
          // Clic sur le conteneur vidéo (fallback)
          if (videoContainer) {
            videoContainer.addEventListener('click', function(e) {
              // Ne déclencher que si on clique directement sur le conteneur (pas sur le bouton)
              if (e.target === videoContainer || e.target.classList.contains('video-placeholder-fallback') || e.target.closest('.video-placeholder-fallback')) {
                e.preventDefault();
                e.stopPropagation();
                console.log('Conteneur vidéo cliqué, videoUrl:', window.videoUrl);
                if (window.videoUrl && typeof window.openVideoModal === 'function') {
                  window.openVideoModal(window.videoUrl);
                } else {
                  console.warn('Aucune vidéo disponible. videoUrl:', window.videoUrl);
                  alert('{{ __("Aucune vidéo disponible pour le moment") }}');
                }
              }
            });
          }
          
          // Hover effects
          playVideoBtn.addEventListener('mouseenter', function() {
            this.style.transform = 'translate(-50%, -50%) scale(1.08)';
            this.style.background = 'rgba(255, 255, 255, 0.18)';
            this.style.borderColor = 'rgba(255, 255, 255, 0.3)';
          });
          
          playVideoBtn.addEventListener('mouseleave', function() {
            this.style.transform = 'translate(-50%, -50%) scale(1)';
            this.style.background = 'rgba(255, 255, 255, 0.12)';
            this.style.borderColor = 'rgba(255, 255, 255, 0.2)';
          });
        }
      } catch (error) {
        console.error('Erreur lors de l\'initialisation du bouton vidéo:', error);
      }
    }
    
    // Initialiser après chargement du DOM
    if (document.readyState === 'loading') {
      document.addEventListener('DOMContentLoaded', initVideoButton);
    } else {
      initVideoButton();
    }

    // Fonction globale simple pour toggle l'agenda - Définie sur window pour être accessible partout
    window.agendaTextShow = @json(__("Voir le planning complet"));
    window.agendaTextHide = @json(__("Masquer le planning"));
    
    window.toggleAgenda = function() {
      var container = document.getElementById('agenda-simple-container');
      var btnText = document.getElementById('agenda-btn-text');
      var btnIcon = document.getElementById('agenda-icon');
      
      if (!container) {
        console.error('Container agenda non trouvé');
        return;
      }
      
      var isVisible = container.style.display === 'block';
      
      if (isVisible) {
        container.style.display = 'none';
        if (btnIcon) btnIcon.className = 'fas fa-chevron-down me-2';
        if (btnText) btnText.textContent = window.agendaTextShow;
      } else {
        container.style.display = 'block';
        if (btnIcon) btnIcon.className = 'fas fa-chevron-up me-2';
        if (btnText) btnText.textContent = window.agendaTextHide;
      }
    };
    
    // Initialiser les événements de clic sur les créneaux après chargement
    document.addEventListener('DOMContentLoaded', function() {
      setTimeout(function() {
        var slotButtons = document.querySelectorAll('.agenda-slot-simple');
        var dayNames = ['Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche'];
        
        slotButtons.forEach(function(btn) {
          btn.addEventListener('click', function(e) {
            e.preventDefault();
            var day = this.getAttribute('data-day');
            var hour = this.getAttribute('data-hour');
            alert('Créneau sélectionné : ' + dayNames[parseInt(day)] + ' à ' + hour + ':00');
          });
        });
      }, 500);
    });

    // Scroll vers l'agenda quand on clique sur les liens #agenda
    document.querySelectorAll('a[href="#agenda"]').forEach(link => {
      link.addEventListener('click', function(e) {
        e.preventDefault();
        const agendaElement = document.getElementById('agenda');
        if (agendaElement) {
          agendaElement.scrollIntoView({ behavior: 'smooth', block: 'start' });
          // Ajouter un petit offset pour le header fixe
          window.scrollBy(0, -80);
          
          // Ouvrir automatiquement le calendrier si il est fermé
          if (agendaToggleBtn && agendaTableContainer && !isAgendaExpanded) {
            setTimeout(() => {
              agendaToggleBtn.click();
            }, 300);
          }
        }
      });
    });

    // Bouton sauvegarder dans la liste
    const saveToListBtn = document.getElementById('save-to-list-btn');
    if (saveToListBtn) {
      saveToListBtn.addEventListener('click', function() {
        const isAuthenticated = {{ Auth::guard('web')->check() ? 'true' : 'false' }};
        if (isAuthenticated) {
          // Ici, ajouter la logique pour sauvegarder dans la liste
          alert('{{ __("Fonctionnalité à implémenter") }}');
        } else {
          window.location.href = '{{ route("user.login") }}';
        }
      });
    }

    // Gestion du formulaire de contact
    const contactForm = document.getElementById('contactFreelancerForm');
    if (contactForm) {
      contactForm.addEventListener('submit', function(e) {
        e.preventDefault();
        const isAuthenticated = {{ Auth::guard('web')->check() ? 'true' : 'false' }};
        if (isAuthenticated) {
          // Ici, ajouter la logique d'envoi du message
          alert(@json(__("Fonctionnalité d'envoi de message à implémenter")));
          const modal = bootstrap.Modal.getInstance(document.getElementById('contactModal'));
          if (modal) {
            modal.hide();
          }
        } else {
          window.location.href = '{{ route("user.login") }}';
        }
      });
    }

    // Toggle "Voir plus/moins" pour la bio premium - Afficher la suite du texte
    (function() {
      'use strict';
      
      function initAboutToggle() {
    const aboutTextPremium = document.getElementById('about-text-premium');
    const aboutTogglePremium = document.getElementById('about-toggle-premium');
    
        if (!aboutTextPremium || !aboutTogglePremium) {
          return;
        }
        
        // Textes traduits
        const textShowMore = @json(__("Voir plus"));
        const textShowLess = @json(__("Voir moins"));
        
      // Vérifier si le texte dépasse la hauteur maximale
        function checkTextHeight() {
          // S'assurer que le texte est tronqué par défaut
        aboutTextPremium.style.maxHeight = '7.2em';
          aboutTextPremium.style.overflow = 'hidden';
          
          // Créer un clone invisible pour mesurer la hauteur complète
          const clone = aboutTextPremium.cloneNode(true);
          clone.style.position = 'absolute';
          clone.style.visibility = 'hidden';
          clone.style.height = 'auto';
          clone.style.maxHeight = 'none';
          clone.style.overflow = 'visible';
          clone.style.width = aboutTextPremium.offsetWidth + 'px';
          document.body.appendChild(clone);
          
          const fullHeight = clone.scrollHeight;
          document.body.removeChild(clone);
          
          // Calculer la hauteur maximale en pixels (7.2em)
          const computedStyle = window.getComputedStyle(aboutTextPremium);
          const fontSize = parseFloat(computedStyle.fontSize);
          const lineHeight = parseFloat(computedStyle.lineHeight) || fontSize * 1.8;
          const maxHeightPx = lineHeight * 7.2;
          
          // Afficher "Voir plus" seulement si le texte est tronqué
          if (fullHeight > maxHeightPx) {
            aboutTogglePremium.style.display = 'inline-block';
        } else {
          aboutTogglePremium.style.display = 'none';
          }
        }
        
        // Initialiser l'état : texte tronqué par défaut
        aboutTextPremium.style.maxHeight = '7.2em';
        aboutTextPremium.style.overflow = 'hidden';
      
        // Vérifier au chargement et après des délais
        setTimeout(function() {
      checkTextHeight();
          setTimeout(checkTextHeight, 200);
          setTimeout(checkTextHeight, 500);
          setTimeout(checkTextHeight, 1000);
        }, 50);
        
        window.addEventListener('resize', checkTextHeight);
      
      let isExpanded = false;
        
        // Effet hover
      aboutTogglePremium.addEventListener('mouseenter', function() {
          this.style.textDecoration = 'underline';
      });
        
      aboutTogglePremium.addEventListener('mouseleave', function() {
        this.style.textDecoration = 'none';
      });
        
        // Gestion du clic pour développer/replier
        aboutTogglePremium.addEventListener('click', function(e) {
          e.preventDefault();
          e.stopPropagation();
          
        isExpanded = !isExpanded;
          
        if (isExpanded) {
            // Développer : afficher tout le texte
          aboutTextPremium.style.maxHeight = 'none';
          aboutTextPremium.style.overflow = 'visible';
            this.textContent = textShowLess;
        } else {
            // Replier : tronquer le texte
          aboutTextPremium.style.maxHeight = '7.2em';
          aboutTextPremium.style.overflow = 'hidden';
            this.textContent = textShowMore;
        }
          
        this.style.textDecoration = 'none';
      });
    }
      
      // Initialiser au chargement du DOM
      if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initAboutToggle);
      } else {
        initAboutToggle();
      }
    })();

    // Toggle traduction (placeholder pour l'instant)
    const toggleTranslation = document.getElementById('toggle-translation');
    if (toggleTranslation) {
      let showingOriginal = false;
      toggleTranslation.addEventListener('mouseenter', function() {
        this.style.textDecoration = 'underline';
      });
      toggleTranslation.addEventListener('mouseleave', function() {
        this.style.textDecoration = 'none';
      });
      toggleTranslation.addEventListener('click', function() {
        showingOriginal = !showingOriginal;
        this.textContent = showingOriginal ? '{{ __("Voir la traduction") }}' : '{{ __("Voir le texte original") }}';
        // Ici, ajouter la logique de traduction si disponible
        this.style.textDecoration = 'none';
      });
    }
  });
</script>

@endsection

@section('content')
  <!-- Page principale avec fond gris -->
  <div class="freelance-page-container">
    <!-- Hero en 2 colonnes -->
    <div class="freelance-hero">
      <!-- Colonne gauche : Vidéo de présentation -->
      <div>
        @php
          // Debug: vérifier si video_url existe
          $hasVideo = isset($freelancer) && $freelancer && !empty($freelancer->video_url);
          $currentVideoUrl = $hasVideo ? $freelancer->video_url : null;
        @endphp
        
        {{-- Script inline pour garantir que videoUrl est disponible immédiatement --}}
        <script>
          (function() {
            // Définir immédiatement au chargement de la page
            @if($hasVideo)
              window.videoUrl = @json($currentVideoUrl);
              console.log('✅ Video URL définie INLINE:', window.videoUrl);
            @else
              window.videoUrl = null;
              console.warn('⚠️ Aucune vidéo URL trouvée INLINE');
            @endif
            
            // Fonction pour afficher la vidéo directement dans la carte
            if (typeof window.openVideoModal === 'undefined') {
              window.openVideoModal = function(videoUrl) {
                try {
                  if (!videoUrl) {
                    console.error('Aucune URL vidéo fournie');
                    alert('{{ __("Aucune vidéo disponible pour le moment") }}');
                    return;
                  }
                  
                  const videoContainer = document.getElementById('video-container');
                  if (!videoContainer) {
                    console.error('Conteneur vidéo non trouvé');
                    return;
                  }
                  
                  // Convertir l'URL en URL d'embed
                  let embedUrl = videoUrl;
                  if (typeof videoUrl === 'string') {
                    if (videoUrl.includes('youtube.com/watch?v=')) {
                      const videoId = videoUrl.split('v=')[1].split('&')[0];
                      embedUrl = 'https://www.youtube.com/embed/' + videoId + '?autoplay=1&rel=0';
                    } else if (videoUrl.includes('youtu.be/')) {
                      const videoId = videoUrl.split('youtu.be/')[1].split('?')[0];
                      embedUrl = 'https://www.youtube.com/embed/' + videoId + '?autoplay=1&rel=0';
                    } else if (videoUrl.includes('vimeo.com/')) {
                      const videoId = videoUrl.split('vimeo.com/')[1].split('?')[0];
                      embedUrl = 'https://player.vimeo.com/video/' + videoId + '?autoplay=1';
                    }
                  }
                  
                  // Masquer le placeholder et le bouton play
                  const placeholder = videoContainer.querySelector('img');
                  const placeholderFallback = videoContainer.querySelector('.video-placeholder-fallback');
                  const playBtn = document.getElementById('play-video-btn');
                  const videoLabel = videoContainer.querySelector('.freelance-video-label');
                  
                  if (placeholder) placeholder.style.display = 'none';
                  if (placeholderFallback) placeholderFallback.style.display = 'none';
                  if (playBtn) playBtn.style.display = 'none';
                  if (videoLabel) videoLabel.style.display = 'none';
                  
                  // Créer et insérer l'iframe YouTube directement dans le conteneur
                  const iframe = document.createElement('iframe');
                  iframe.src = embedUrl;
                  iframe.setAttribute('frameborder', '0');
                  iframe.setAttribute('allow', 'accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture');
                  iframe.setAttribute('allowfullscreen', '');
                  iframe.style.width = '100%';
                  iframe.style.height = '100%';
                  iframe.style.position = 'absolute';
                  iframe.style.top = '0';
                  iframe.style.left = '0';
                  iframe.style.borderRadius = '28px';
                  
                  // Vider le conteneur et ajouter l'iframe
                  videoContainer.innerHTML = '';
                  videoContainer.appendChild(iframe);
                  
                  console.log('✅ Vidéo chargée dans la carte:', embedUrl);
                } catch (error) {
                  console.error('Erreur lors du chargement de la vidéo:', error);
                  alert('{{ __("Erreur lors du chargement de la vidéo") }}');
                }
              };
              console.log('✅ openVideoModal définie INLINE');
            }
          })();
        </script>
        
        <div class="freelance-video-container" id="video-container">
            @if(file_exists(public_path('assets/img/video-placeholder.jpg')))
              <img src="{{ asset('assets/img/video-placeholder.jpg') }}" 
                   alt="Vidéo de présentation" 
                   style="width: 100%; height: 100%; object-fit: cover; display: block; pointer-events: none;"
                   onerror="this.style.display='none'; this.parentElement.querySelector('.video-placeholder-fallback').style.display='flex';">
            @endif
            <div class="video-placeholder-fallback" style="display: {{ file_exists(public_path('assets/img/video-placeholder.jpg')) ? 'none' : 'flex' }}; flex-direction: column; align-items: center; justify-content: center; width: 100%; height: 100%; color: white; text-align: center; padding: 40px; pointer-events: none;">
              <i class="fas fa-video" style="font-size: 64px; margin-bottom: 16px; opacity: 0.8;"></i>
            </div>
          <button class="freelance-video-play-btn" id="play-video-btn" type="button" onclick="event.preventDefault(); event.stopPropagation(); console.log('🔴 onclick appelé - videoUrl:', window.videoUrl, 'openVideoModal:', typeof window.openVideoModal); if(typeof window.openVideoModal === 'function' && window.videoUrl) { console.log('✅ Ouverture de la modal avec:', window.videoUrl); window.openVideoModal(window.videoUrl); } else { console.error('❌ Erreur - videoUrl:', window.videoUrl, 'openVideoModal:', typeof window.openVideoModal); alert('{{ __("Aucune vidéo disponible pour le moment") }}'); }" style="pointer-events: auto !important; z-index: 1000 !important; cursor: pointer !important;">
            <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="rgba(255, 255, 255, 0.9)" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
              <polygon points="6 4 18 12 6 20 6 4" fill="rgba(255, 255, 255, 0.15)"></polygon>
            </svg>
          </button>
          <div class="freelance-video-label" style="pointer-events: none;">{{ __('Vidéo de présentation') }}</div>
        </div>

        <!-- Bloc Premium Profil (Header + À propos + Langues) - Inspiré Preply -->
        <div class="freelance-profile-premium-block" style="background: white; border-radius: 24px; padding: 48px; margin-top: 48px; box-shadow: 0 2px 8px rgba(0, 0, 0, 0.06);">
          
          <!-- Header Profil (Photo + Nom + Rôle + Pays) - Style Preply -->
          <div class="freelance-profile-header" style="display: flex; align-items: flex-start; gap: 32px; margin-bottom: 40px; padding-bottom: 40px; border-bottom: 1px solid #E5E7EB;">
            <!-- Photo de profil à gauche -->
            <div style="flex-shrink: 0;">
              @php
                // Vérifier plusieurs emplacements possibles pour l'image
                $imageUrl = null;
                $imageExists = false;
                
                if ($user->image) {
                  // Emplacement 1 : storage/app/public/img/users/ (nouveau système avec Storage)
                  // Utiliser Storage::url() pour générer l'URL correcte
                  if (\Storage::disk('public')->exists('img/users/' . $user->image)) {
                    $imageUrl = \Storage::disk('public')->url('img/users/' . $user->image);
                    $imageExists = true;
                  } else {
                    // Emplacement 2 : public/assets/img/users/ (ancien système)
                    $path2 = public_path('assets/img/users/' . $user->image);
                    if (file_exists($path2)) {
                      $imageUrl = asset('assets/img/users/' . $user->image);
                      $imageExists = true;
                    } else {
                      // Emplacement 3 : public/storage/img/users/ (si symlink existe)
                      $path3 = public_path('storage/img/users/' . $user->image);
                      if (file_exists($path3)) {
                        $imageUrl = asset('storage/img/users/' . $user->image);
                        $imageExists = true;
                      }
                    }
                  }
                }
                
                // Initiale pour l'avatar fallback
                $firstName = $user->first_name ?? '';
                $lastName = $user->last_name ?? '';
                $initial = strtoupper(substr($firstName, 0, 1) ?: substr($lastName, 0, 1) ?: 'F');
              @endphp
              @if($imageUrl && $imageExists)
                <img src="{{ $imageUrl }}" 
                     alt="{{ $firstName }} {{ $lastName }}" 
                     style="width: 120px; height: 120px; border-radius: 16px; object-fit: cover; border: 2px solid #F3F4F6;"
                     onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                <!-- Fallback avatar violet avec initiale (masqué par défaut) -->
                <div style="width: 120px; height: 120px; border-radius: 16px; background: var(--junspro-gradient); display: none; align-items: center; justify-content: center; color: white; font-size: 48px; font-weight: 700; border: 2px solid #F3F4F6;">
                  {{ $initial }}
                </div>
              @else
                <!-- Fallback avatar violet avec initiale -->
                <div style="width: 120px; height: 120px; border-radius: 16px; background: var(--junspro-gradient); display: flex; align-items: center; justify-content: center; color: white; font-size: 48px; font-weight: 700; border: 2px solid #F3F4F6;">
                  {{ $initial }}
                </div>
              @endif
            </div>
            
            <!-- Informations textuelles à droite -->
            <div style="flex-grow: 1; min-width: 0;">
              @php
                // Utiliser first_name et last_name directement
                $displayFirstName = $user->first_name ?? '';
                $displayLastName = $user->last_name ?? '';
                $fullName = trim($displayFirstName . ' ' . $displayLastName);
                
                // Si pas de first_name/last_name, utiliser name comme fallback
                if (empty($fullName)) {
                  $nameParts = explode(' ', $user->name ?? '');
                  $displayFirstName = $nameParts[0] ?? '';
                  $displayLastName = isset($nameParts[1]) ? $nameParts[1] : '';
                  $fullName = trim($displayFirstName . ' ' . $displayLastName);
                }
                
                // Format d'affichage : Prénom + Nom complet (ou initiale si préféré)
                $displayName = $displayFirstName;
                if ($displayLastName) {
                  $displayName .= ' ' . $displayLastName;
                }
              @endphp
              
              <!-- Ligne 1 : Nom complet (Prénom + Nom) -->
              <h1 style="font-size: 32px; font-weight: 700; color: #111827; margin: 0 0 12px 0; line-height: 1.2; letter-spacing: -0.02em;">
                {{ $displayName ?: __('Freelance') }}
              </h1>
              
              <!-- Ligne 2 : Rôle + Pays + Drapeau -->
              <div style="display: flex; align-items: center; gap: 8px; margin-bottom: 12px; flex-wrap: wrap;">
                @php
                  // Déterminer le rôle/titre du freelance
                  $role = '';
                  if(!empty($freelancer->skills) && is_array($freelancer->skills)) {
                    $firstSkill = $freelancer->skills[0] ?? '';
                    $role = __('Freelance expert en') . ' ' . $firstSkill;
                  } else {
                    $role = __('Freelance');
                  }
                @endphp
                <span style="font-size: 16px; color: #6B7280; font-weight: 400;">
                  {{ $role }}
                </span>
                <span style="color: #D1D5DB; font-size: 16px;">·</span>
                <span style="font-size: 16px; color: #6B7280;">
                  {{ $user->country ?? 'France' }}
                </span>
                @php
                  $country = $user->country ?? 'France';
                  $countryCode = strtolower(substr($country, 0, 2));
                  $flagEmojis = [
                    'fr' => '🇫🇷', 'en' => '🇬🇧', 'us' => '🇺🇸', 'es' => '🇪🇸', 
                    'de' => '🇩🇪', 'it' => '🇮🇹', 'pt' => '🇵🇹', 'nl' => '🇳🇱',
                    'be' => '🇧🇪', 'ch' => '🇨🇭', 'ca' => '🇨🇦', 'au' => '🇦🇺',
                    'pk' => '🇵🇰', 'in' => '🇮🇳', 'cn' => '🇨🇳', 'jp' => '🇯🇵',
                    'kr' => '🇰🇷', 'br' => '🇧🇷', 'mx' => '🇲🇽', 'ar' => '🇦🇷',
                    'za' => '🇿🇦', 'eg' => '🇪🇬', 'ma' => '🇲🇦', 'tn' => '🇹🇳',
                    'dz' => '🇩🇿', 'ru' => '🇷🇺', 'pl' => '🇵🇱', 'cz' => '🇨🇿',
                    'ro' => '🇷🇴', 'hu' => '🇭🇺', 'gr' => '🇬🇷', 'tr' => '🇹🇷'
                  ];
                  $flag = $flagEmojis[$countryCode] ?? '🌍';
                @endphp
                <span style="font-size: 18px; line-height: 1;">{{ $flag }}</span>
              </div>
              
              <!-- Ligne 3 : Phrase d'accroche / résumé court (1-2 lignes max avec ellipsis) -->
              @if($freelancer->bio)
                @php
                  $bioText = strip_tags($freelancer->bio);
                  // Limiter à environ 120 caractères pour 1-2 lignes
                  $tagline = Str::limit($bioText, 120);
                @endphp
                <p style="font-size: 15px; color: #4B5563; margin: 0; line-height: 1.6; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; text-overflow: ellipsis;">
                  {{ $tagline }}
                </p>
              @endif
            </div>
          </div>

          <!-- Section "À propos de moi" - Style Preply -->
          <div class="freelance-about-section" style="margin-bottom: 40px; padding-bottom: 40px; border-bottom: 1px solid #E5E7EB;">
            <!-- Titre de section -->
            <h2 style="font-size: 24px; font-weight: 700; color: #111827; margin-bottom: 16px; letter-spacing: -0.01em;">
              {{ __('À propos de moi') }}
            </h2>
              
            <!-- Ligne Traduction (comme Preply) -->
            <div style="display: flex; align-items: center; gap: 6px; margin-bottom: 20px;">
              <i class="fas fa-globe" style="font-size: 14px; color: #6B7280;"></i>
              <span style="font-size: 13px; color: #6B7280;">{{ __('Traduction') }}</span>
              <span style="color: #D1D5DB; font-size: 13px;">·</span>
              <button type="button" id="toggle-translation" class="translation-link" style="background: none; border: none; color: #4F46E5; font-size: 13px; text-decoration: none; cursor: pointer; padding: 0; transition: text-decoration 0.2s;">
                {{ __('Voir le texte original') }}
              </button>
            </div>
            
            <!-- Texte Bio avec toggle "Voir plus/moins" -->
            <div id="about-text-container-premium">
              @if($freelancer->bio && strlen($freelancer->bio) > 0)
                <p id="about-text-premium" style="font-size: 16px; line-height: 1.8; color: #374151; margin-bottom: 0; max-height: 7.2em; overflow: hidden; transition: max-height 0.4s ease;">
                    {!! nl2br(e($freelancer->bio)) !!}
                  </p>
                <a href="#" id="about-toggle-premium" class="about-toggle-link" style="color: #4F46E5; text-decoration: none; font-size: 16px; font-weight: 500; padding: 0; margin-top: 8px; border: none; background: none; cursor: pointer; display: none; transition: text-decoration 0.2s;">
                  {{ __('Voir plus') }}
                </a>
                <script>
                  // Script inline pour vérifier si le texte est vraiment tronqué et gérer le clic
                  (function() {
                    var isExpanded = false;
                    var textShowMore = @json(__("Voir plus"));
                    var textShowLess = @json(__("Voir moins"));
                    
                    function checkBioLength() {
                      var bioText = document.getElementById('about-text-premium');
                      var toggleLink = document.getElementById('about-toggle-premium');
                      
                      if (!bioText || !toggleLink) return;
                      
                      // S'assurer que le texte est tronqué par défaut
                      bioText.style.maxHeight = '7.2em';
                      bioText.style.overflow = 'hidden';
                      
                      // Mesurer la hauteur complète (sans limite)
                      bioText.style.maxHeight = 'none';
                      bioText.style.overflow = 'visible';
                      var fullHeight = bioText.scrollHeight;
                      
                      // Remettre la limite
                      bioText.style.maxHeight = '7.2em';
                      bioText.style.overflow = 'hidden';
                      
                      // Calculer 7.2em en pixels
                      var computedStyle = window.getComputedStyle(bioText);
                      var fontSize = parseFloat(computedStyle.fontSize);
                      var lineHeight = parseFloat(computedStyle.lineHeight) || fontSize * 1.8;
                      var maxHeightPx = lineHeight * 7.2;
                      
                      // Afficher "Voir plus" SEULEMENT si le texte dépasse vraiment (avec une marge de sécurité)
                      if (fullHeight > maxHeightPx + 10) {
                        toggleLink.style.display = 'inline-block';
                      } else {
                        toggleLink.style.display = 'none';
                      }
                    }
                    
                    // Gérer le clic sur "Voir plus" / "Voir moins"
                    function initToggleClick() {
                      var bioText = document.getElementById('about-text-premium');
                      var toggleLink = document.getElementById('about-toggle-premium');
                      
                      if (!bioText || !toggleLink) return;
                      
                      // Effet hover
                      toggleLink.addEventListener('mouseenter', function() {
                        this.style.textDecoration = 'underline';
                      });
                      
                      toggleLink.addEventListener('mouseleave', function() {
                        this.style.textDecoration = 'none';
                      });
                      
                      // Gestion du clic pour développer/replier
                      toggleLink.addEventListener('click', function(e) {
                        e.preventDefault();
                        e.stopPropagation();
                        
                        isExpanded = !isExpanded;
                        
                        if (isExpanded) {
                          // Développer : afficher tout le texte
                          bioText.style.maxHeight = 'none';
                          bioText.style.overflow = 'visible';
                          this.textContent = textShowLess;
                        } else {
                          // Replier : tronquer le texte
                          bioText.style.maxHeight = '7.2em';
                          bioText.style.overflow = 'hidden';
                          this.textContent = textShowMore;
                        }
                        
                        this.style.textDecoration = 'none';
                      });
                    }
                    
                    // Initialiser
                    setTimeout(function() {
                      checkBioLength();
                      initToggleClick();
                    }, 100);
                    
                    // Vérifier plusieurs fois pour être sûr
                    setTimeout(checkBioLength, 200);
                    setTimeout(checkBioLength, 500);
                    setTimeout(checkBioLength, 1000);
                    window.addEventListener('resize', checkBioLength);
                  })();
                </script>
              @else
                <p style="font-size: 16px; line-height: 1.8; color: #6B7280; margin-bottom: 0;">
                  {{ __('Aucune présentation disponible pour le moment.') }}
                </p>
              @endif
            </div>
          </div>

          <!-- Section "Je parle" (Langues) -->
          <div class="freelance-languages-section">
            <h3 style="font-size: 18px; font-weight: 600; color: #111827; margin-bottom: 16px;">
              {{ __('Je parle') }}
            </h3>
            <div style="display: flex; flex-wrap: wrap; gap: 8px;">
              @php
                // Récupérer les langues depuis le profil (à adapter selon votre structure de données)
                $languages = [];
                if(isset($user->languages) && is_array($user->languages)) {
                  $languages = $user->languages;
                } elseif(isset($freelancer->languages)) {
                  $languages = is_array($freelancer->languages) ? $freelancer->languages : json_decode($freelancer->languages, true) ?? [];
                }
                // Par défaut, afficher au moins la langue principale
                if(empty($languages)) {
                  $languages = [
                    ['name' => 'Français', 'level' => 'Natif'],
                    ['name' => 'Anglais', 'level' => 'Supérieur C2']
                  ];
                }
              @endphp
              @foreach($languages as $lang)
                @php
                  $langName = is_array($lang) ? ($lang['name'] ?? $lang['language'] ?? '') : $lang;
                  $langLevel = is_array($lang) ? ($lang['level'] ?? $lang['proficiency'] ?? '') : '';
                  $isNative = strtolower($langLevel) === 'natif' || strtolower($langLevel) === 'native';
                @endphp
                <span class="language-badge" style="display: inline-flex; align-items: center; gap: 6px; padding: 8px 16px; border-radius: 20px; font-size: 14px; font-weight: 500; background: {{ $isNative ? '#ECFDF5' : '#EEF2FF' }}; color: {{ $isNative ? '#065F46' : '#3730A3' }}; border: 1px solid {{ $isNative ? '#A7F3D0' : '#C7D2FE' }};">
                  <span>{{ $langName }}</span>
                  @if($langLevel)
                    <span style="opacity: 0.8;">[{{ $langLevel }}]</span>
                              @endif
                          </span>
              @endforeach
                        </div>
                      </div>
                    </div>
                </div>

      <!-- Colonne droite : Carte sticky premium -->
      <div>
        <div class="freelance-booking-card">
          <!-- Badge popularité -->
          <div class="profile-popularity-banner">
            <i class="fas fa-fire"></i>
            <span>{{ __('Très populaire') }} · {{ rand(10, 50) }} {{ __('réservations récentes') }}</span>
              </div>

          <!-- Note et Prix -->
          <div class="profile-rating-price-row">
            <div>
              <div class="profile-rating-block">
                <div class="profile-rating-number">{{ number_format($averageRating ?? 4.5, 1) }}</div>
                <div class="profile-rating-star"><i class="fas fa-star"></i></div>
            </div>
              <div class="profile-reviews-count">{{ $reviewsCount ?? 0 }} {{ __('avis') }}</div>
            </div>
            <div class="profile-price-block">
              <div class="profile-price-main">{{ number_format($freelancer->hourly_rate, 0) }} €</div>
              <div class="profile-price-unit">{{ __('par heure') }}</div>
            </div>
          </div>

          <!-- Statistiques -->
          <div class="profile-stats-grid">
            <div class="profile-stat-card">
              <div class="profile-stat-label">{{ __('Rituels livrés') }}</div>
              <div class="profile-stat-value">{{ $subscriptionsCount ?? 0 }}</div>
            </div>
            <div class="profile-stat-card">
              <div class="profile-stat-label">{{ __('Clients récurrents') }}</div>
              <div class="profile-stat-value">{{ $activeSubscriptionsCount ?? 0 }}</div>
            </div>
          </div>

          <!-- Dernière connexion -->
          <div class="profile-last-seen">
            <div class="profile-stat-label">{{ __('Dernière connexion') }}</div>
            <div class="profile-stat-value" style="font-size: 15px;">{{ isset($freelancer->last_seen_at) ? $freelancer->last_seen_at->diffForHumans() : __('Il y a 1h') }}</div>
          </div>

          <!-- Coordonnées (anti-désintermédiation : masquées avant réservation confirmée) -->
          <div class="profile-last-seen" style="border-top: 1px solid #E5E7EB; padding-top: 16px;">
            <div class="profile-stat-label">{{ __('Contact') }}</div>
            @if($canViewContactInfo ?? false)
              <div class="profile-stat-value" style="font-size: 14px;">
                @if($user->email_address ?? null)
                  <a href="mailto:{{ $user->email_address }}" style="color: var(--junspro-primary); text-decoration: none;"><i class="fas fa-envelope me-1"></i>{{ $user->email_address }}</a>
                @endif
                @if(($user->phone_number ?? null) && ($user->email_address ?? null))<br>@endif
                @if($user->phone_number ?? null)
                  <a href="tel:{{ $user->phone_number }}" style="color: var(--junspro-primary); text-decoration: none;"><i class="fas fa-phone me-1"></i>{{ $user->phone_number }}</a>
                @endif
                @if(!($user->email_address ?? null) && !($user->phone_number ?? null))
                  <span style="color: #6B7280;">—</span>
                @endif
              </div>
            @else
              <p class="mb-0" style="font-size: 13px; color: #6B7280;">
                <i class="fas fa-lock me-1"></i>{{ __('Débloqué après réservation confirmée') }}
              </p>
            @endif
          </div>

          <!-- Bouton CTA principal -->
          <div class="d-grid gap-2 mb-3">
            @auth('web')
              <a href="{{ route('freelance.booking', $freelancer->id) }}" class="profile-cta-primary" style="text-decoration: none; text-align: center; display: flex; align-items: center; justify-content: center;">
                <i class="fas fa-bolt me-2"></i>{{ __('Réserver un Rituel d\'essai') }}
              </a>
            @else
              <a href="{{ route('user.login') }}" class="profile-cta-primary" style="text-decoration: none; text-align: center; display: flex; align-items: center; justify-content: center;">
                <i class="fas fa-bolt me-2"></i>{{ __('Réserver un Rituel d\'essai') }}
              </a>
            @endauth
            <p style="font-size: clamp(0.75rem, 2.5vw, 0.8125rem); color: #9CA3AF; margin: 4px 0 0 0; text-align: center;">{{ __('Paiement sécurisé') }} • {{ __('Annulation simplifiée') }} • {{ __('Facture') }} • {{ __('Support') }}</p>
              </div>

          <!-- Boutons secondaires -->
          <div class="d-grid gap-2 mb-3">
            <button type="button" class="profile-cta-secondary" data-bs-toggle="modal" data-bs-target="#contactModal">
              <i class="fas fa-envelope me-2"></i>{{ __('Envoyer un message') }}
                  </button>
            <button type="button" class="profile-cta-link" id="save-to-list-btn">
              <i class="fas fa-heart me-2"></i>{{ __('Sauvegarder dans ma liste') }}
                  </button>
              </div>

          <!-- Encadré recommandations -->
          <div style="background: linear-gradient(135deg, rgba(16, 185, 129, 0.08) 0%, rgba(5, 150, 105, 0.08) 100%); border: 1px solid rgba(16, 185, 129, 0.2); border-radius: 12px; padding: 20px; margin-top: 24px;">
            <p style="font-size: 14px; line-height: 1.6; color: #111827; margin-bottom: 12px;">
              {{ __('Pas sûr que ce freelance soit le bon ?') }} {{ __('Junspro peut vous proposer des profils similaires.') }}
            </p>
            <a href="{{ route('explore') }}" style="color: #4F46E5; font-size: 14px; font-weight: 600; text-decoration: none;">
              {{ __('Explorer d\'autres freelances') }} <i class="fas fa-arrow-right ms-1"></i>
            </a>
          </div>
              </div>
            </div>
          </div>

    <!-- Colonne de contenu unique sous le hero -->
    <div class="freelance-content-column">

      <!-- Section 1 : Résumé de la mission idéale avec [Prénom] -->
      <div class="freelance-content-section">
        <h2 class="freelance-section-title">
          <i class="fas fa-user-circle"></i>
          {{ __('Résumé de la mission idéale avec') }} {{ explode(' ', $user->name)[0] ?? $user->name }}
        </h2>

              <!-- Points forts -->
        <div class="mb-4 pb-4" style="border-bottom: 1px solid #E5E7EB;">
          <div class="d-flex align-items-start gap-3 mb-3">
            <i class="fas fa-thumbs-up" style="color: var(--junspro-primary); font-size: 20px; margin-top: 4px;"></i>
                  <div class="flex-grow-1">
              <h3 style="font-size: 18px; font-weight: 600; color: #111827; margin-bottom: 12px;">{{ __('Points forts') }}</h3>
              <p style="font-size: 16px; line-height: 1.8; color: #4B5563; margin-bottom: 8px;">
                      {{ $user->name }} {{ __('a') }} {{ rand(2, 5) }} {{ __('ans d\'expérience et une note de') }} {{ number_format($averageRating ?? 4.5, 1) }} {{ __('sur') }} {{ $reviewsCount ?? 0 }} {{ __('avis, ce qui indique ses méthodes de travail efficaces et son bon rapport avec les clients.') }}
                    </p>
              <small style="font-size: 13px; color: #9CA3AF; font-style: italic;">
                <i class="fas fa-sparkles me-1"></i>{{ __('Résumé généré par l\'IA à partir des données du profil') }}
                    </small>
                  </div>
                </div>
              </div>

              <!-- Style de travail -->
        <div class="mb-4 pb-4" style="border-bottom: 1px solid #E5E7EB;">
          <div class="d-flex align-items-start gap-3 mb-3">
            <i class="fas fa-graduation-cap" style="color: var(--junspro-primary); font-size: 20px; margin-top: 4px;"></i>
                  <div class="flex-grow-1">
              <h3 style="font-size: 18px; font-weight: 600; color: #111827; margin-bottom: 12px;">{{ __('Style de travail') }}</h3>
              <p style="font-size: 16px; line-height: 1.8; color: #4B5563; margin-bottom: 8px;">
                      {{ __('Il utilise des plans de Rituel personnalisés adaptés aux besoins et aux objectifs de chaque client, favorisant un environnement encourageant pour la collaboration et l\'atteinte des résultats.') }}
                    </p>
              <small style="font-size: 13px; color: #9CA3AF; font-style: italic;">
                <i class="fas fa-sparkles me-1"></i>{{ __('Résumé généré par l\'IA à partir des données du profil') }}
                    </small>
                  </div>
                </div>
              </div>

              <!-- Freelance qualifié -->
              <div>
          <div class="d-flex align-items-start gap-3 mb-3">
            <i class="fas fa-check-circle" style="color: #10B981; font-size: 20px; margin-top: 4px;"></i>
                  <div class="flex-grow-1">
              <h3 style="font-size: 18px; font-weight: 600; color: #111827; margin-bottom: 12px;">{{ __('Freelance qualifié') }}</h3>
              <p style="font-size: 16px; line-height: 1.8; color: #4B5563; margin-bottom: 12px;">
                      {{ $user->name }} {{ __('détient des certifications qui attestent de ses compétences.') }}
                    </p>
              <a href="#certifications" style="color: var(--junspro-primary); font-size: 14px; font-weight: 600; text-decoration: none;">
                      {{ __('En savoir plus') }} <i class="fas fa-arrow-right ms-1"></i>
                    </a>
                  </div>
                </div>
              </div>
            </div>

      <!-- Section 2 : Rituel d'essai & abonnement Junspro -->
      @php $isOwnProfile = Auth::guard('web')->check() && Auth::guard('web')->id() === $user->id; @endphp
      <div class="freelance-content-section" id="subscription">
        <h2 class="freelance-section-title">
          <i class="fas fa-calendar-check"></i>
          {{ __('Rituel d\'essai & abonnement Junspro') }}
        </h2>

        @if($isOwnProfile)
          {{-- Vue propriétaire : aperçu de son propre profil --}}
          <div style="background: #EEF2FF; border: 1px solid #C7D2FE; border-radius: 16px; padding: 20px 24px; display: flex; align-items: center; gap: 16px;">
            <i class="fas fa-eye" style="color: #4F46E5; font-size: 24px; flex-shrink: 0;"></i>
            <div>
              <p style="font-size: 15px; font-weight: 600; color: #3730A3; margin: 0 0 4px;">Aperçu de votre profil public</p>
              <p style="font-size: 14px; color: #6B7280; margin: 0;">Vos clients voient ici les options pour réserver un Rituel d'essai ou s'abonner à vos services.</p>
            </div>
          </div>
        @else
        <div class="mb-4 pb-4" style="border-bottom: 1px solid #E5E7EB;">
          <h3 style="font-size: 18px; font-weight: 600; color: #111827; margin-bottom: 12px;">{{ __('Rituel d\'essai (1h)') }}</h3>
          <p style="font-size: 15px; line-height: 1.7; color: #6B7280; margin-bottom: 20px;">
            {{ __('50 minutes de travail concentré + 10 minutes de rapport pédagogique : ce qui a été fait, pourquoi, et les prochaines étapes pour votre Rituel.') }}
          </p>
          @auth('web')
            <a href="{{ route('freelance.booking', $freelancer->id) }}" class="btn w-100" style="background: var(--junspro-gradient); color: white; border-radius: 12px; padding: 14px 24px; font-weight: 600; text-decoration: none; display: block; text-align: center; box-shadow: 0 4px 12px rgba(79, 70, 229, 0.3);">
              <i class="fas fa-play-circle me-2"></i>{{ __('Réserver un Rituel d\'essai') }}
            </a>
          @else
            <a href="{{ route('user.login') }}" class="btn w-100" style="background: var(--junspro-gradient); color: white; border-radius: 12px; padding: 14px 24px; font-weight: 600; text-decoration: none; display: block; text-align: center; box-shadow: 0 4px 12px rgba(79, 70, 229, 0.3);">
              <i class="fas fa-sign-in-alt me-2"></i>{{ __('Se connecter pour réserver') }}
            </a>
          @endauth
          <p class="text-center mt-3 mb-0" style="font-size: 14px; color: #6B7280;">
            {{ number_format($freelancer->hourly_rate, 2, ',', ' ') }} €
          </p>
          </div>

        <!-- Passer à l'abonnement -->
        <div>
          <h3 style="font-size: 18px; font-weight: 600; color: #111827; margin-bottom: 12px;">{{ __('Passer à l\'abonnement') }}</h3>
          <p style="font-size: 15px; line-height: 1.7; color: #6B7280; margin-bottom: 20px;">
            {{ __('Choisissez votre formule hebdomadaire pour un accompagnement régulier.') }}
          </p>
          @auth('web')
            <a href="{{ route('freelance.booking', $freelancer->id) }}" class="btn w-100" style="background: white; border: 2px solid var(--junspro-primary); color: var(--junspro-primary); border-radius: 12px; padding: 14px 24px; font-weight: 600; text-decoration: none; display: block; text-align: center;">
              <i class="fas fa-arrow-right me-2"></i>{{ __('Voir les formules') }}
            </a>
          @else
            <a href="{{ route('user.login') }}" class="btn w-100" style="background: white; border: 2px solid var(--junspro-primary); color: var(--junspro-primary); border-radius: 12px; padding: 14px 24px; font-weight: 600; text-decoration: none; display: block; text-align: center;">
              <i class="fas fa-sign-in-alt me-2"></i>{{ __('Se connecter pour s\'abonner') }}
            </a>
          @endauth
            </div>
        @endif
          </div>


      <!-- Section 4 : Outils & secteurs -->
          @if(!empty($freelancer->skills))
        <div class="freelance-content-section">
          <h2 class="freelance-section-title">
            <i class="fas fa-tools"></i>
            {{ __('Outils & secteurs') }}
          </h2>
                <div class="row g-3">
                      <div class="col-md-6">
              <h3 style="font-size: 16px; font-weight: 600; color: #111827; margin-bottom: 16px;">{{ __('Outils & technologies') }}</h3>
                <div class="d-flex flex-wrap gap-2">
                  @foreach($freelancer->skills as $skill)
                  <span class="badge" style="background: #F3F4F6; color: #374151; border: 1px solid #E5E7EB; padding: 8px 16px; font-size: 14px; border-radius: 8px; font-weight: 500;">{{ $skill }}</span>
                  @endforeach
                </div>
              </div>
            <div class="col-md-6">
              <h3 style="font-size: 16px; font-weight: 600; color: #111827; margin-bottom: 16px;">{{ __('Secteurs clients') }}</h3>
                <div class="d-flex flex-wrap gap-2">
                @php
                  $sectors = ['Infopreneurs', 'Coachs', 'E-commerce', 'Associations', 'Startups'];
                @endphp
                @foreach($sectors as $sector)
                  <span class="badge" style="background: #F3F4F6; color: #374151; border: 1px solid #E5E7EB; padding: 8px 16px; font-size: 14px; border-radius: 8px; font-weight: 500;">{{ $sector }}</span>
                  @endforeach
              </div>
                </div>
              </div>
            </div>
          @endif

      <!-- Section 5 : Certifications & Qualité -->
      <div class="freelance-content-section" id="certifications">
        <h2 class="freelance-section-title">
          <i class="fas fa-medal"></i>
          {{ __('Certifications & qualité') }}
        </h2>
        <div style="text-align: center; margin-bottom: 32px;">
          <div style="font-size: 48px; font-weight: 700; color: var(--junspro-primary); margin-bottom: 8px;">{{ number_format($averageRating ?? 4.5, 1) }} / 5.0</div>
          <div style="font-size: 24px; color: #FCD34D; margin-bottom: 16px;">
                      @for($i = 0; $i < 5; $i++)
                        <i class="fas fa-star"></i>
                      @endfor
                    </div>
                  </div>
        <div class="row g-3">
                <div class="col-6 col-md-3">
            <div style="text-align: center; padding: 24px; background: #F8FAFC; border-radius: 16px; border: 1px solid #E5E7EB;">
              <div style="font-size: 32px; margin-bottom: 12px;">😊</div>
              <div style="font-size: 32px; font-weight: 700; color: #111827; margin-bottom: 8px;">5.0</div>
              <div style="font-size: 14px; color: #6B7280; font-weight: 500;">{{ __('Soutien') }}</div>
                  </div>
                </div>
                <div class="col-6 col-md-3">
            <div style="text-align: center; padding: 24px; background: #F8FAFC; border-radius: 16px; border: 1px solid #E5E7EB;">
              <div style="font-size: 32px; margin-bottom: 12px;">💬</div>
              <div style="font-size: 32px; font-weight: 700; color: #111827; margin-bottom: 8px;">4.9</div>
              <div style="font-size: 14px; color: #6B7280; font-weight: 500;">{{ __('Clarté') }}</div>
                  </div>
                </div>
                <div class="col-6 col-md-3">
            <div style="text-align: center; padding: 24px; background: #F8FAFC; border-radius: 16px; border: 1px solid #E5E7EB;">
              <div style="font-size: 32px; margin-bottom: 12px;">📈</div>
              <div style="font-size: 32px; font-weight: 700; color: #111827; margin-bottom: 8px;">4.8</div>
              <div style="font-size: 14px; color: #6B7280; font-weight: 500;">{{ __('Progrès') }}</div>
                  </div>
                </div>
                <div class="col-6 col-md-3">
            <div style="text-align: center; padding: 24px; background: #F8FAFC; border-radius: 16px; border: 1px solid #E5E7EB;">
              <div style="font-size: 32px; margin-bottom: 12px;">✏️</div>
              <div style="font-size: 32px; font-weight: 700; color: #111827; margin-bottom: 8px;">5.0</div>
              <div style="font-size: 14px; color: #6B7280; font-weight: 500;">{{ __('Préparation') }}</div>
                  </div>
                </div>
              </div>
        <p class="text-center mt-4 mb-0" style="font-size: 14px; color: #6B7280;">
                {{ __('D\'après') }} {{ $reviewsCount ?? 0 }} {{ __('avis de clients anonymes') }}
              </p>
          </div>

      <!-- Section 6 : Rituels récents livrés -->
      <div class="freelance-content-section">
        <h2 class="freelance-section-title">
          <i class="fas fa-folder-open"></i>
          {{ __('Rituels récents livrés') }}
        </h2>
        @if(isset($recentProjects) && $recentProjects->isNotEmpty())
          <div class="d-flex flex-column gap-3">
            @foreach($recentProjects as $project)
              <div style="background: #F8FAFC; border: 1px solid #E5E7EB; border-radius: 16px; padding: 24px;">
                <div class="d-flex justify-content-between align-items-start mb-2">
                  <div class="flex-grow-1">
                    <h6 class="mb-1" style="color: #111827; font-weight: 600; font-size: 16px;">
                      @if($project->subscription && $project->subscription->client && $project->subscription->client->user)
                        {{ __('Rituel pour') }} {{ $project->subscription->client->user->name }}
                  @else
                        {{ __('Rituel') }} #{{ $project->id }}
                  @endif
                          </h6>
                    <small class="text-muted" style="font-size: 14px;">
                      <i class="fas fa-calendar me-1"></i>
                      {{ $project->end_at ? $project->end_at->format('d/m/Y') : __('Date non disponible') }}
                      </small>
                    </div>
                  <span class="badge" style="background: rgba(16, 185, 129, 0.1); color: #10B981; border: 1px solid rgba(16, 185, 129, 0.2); padding: 8px 14px; border-radius: 8px;">
                    <i class="fas fa-check-circle me-1"></i>{{ __('Livré') }}
                  </span>
                  </div>
                @if($project->report_text)
                  <p class="mb-0 mt-3" style="font-size: 15px; line-height: 1.7; color: #6B7280;">
                    {{ Str::limit($project->report_text, 200) }}
                      </p>
                    @endif
                  </div>
                @endforeach
              </div>
                @else
          <div style="background: #F8FAFC; border: 1px solid #E5E7EB; border-radius: 16px; padding: 60px; text-align: center;">
            <i class="fas fa-folder-open" style="font-size: 64px; color: #9CA3AF; margin-bottom: 20px;"></i>
            <p style="color: #6B7280; font-size: 16px; margin-bottom: 0;">{{ __('Portfolio en cours de construction...') }}</p>
            </div>
          @endif
        </div>

      <!-- Section 7 : Agenda -->
      <div class="freelance-content-section" id="agenda">
        <h2 class="freelance-section-title">
          <i class="fas fa-calendar-alt"></i>
          {{ __('Agenda') }}
        </h2>
        
        <!-- Bandeau d'info -->
        <div style="background: rgba(79, 70, 229, 0.1); border: 1px solid rgba(79, 70, 229, 0.2); border-radius: 16px; padding: 20px; margin-bottom: 24px;">
          <div class="d-flex align-items-start gap-3">
            <i class="fas fa-info-circle" style="color: #4F46E5; font-size: 20px; margin-top: 2px;"></i>
            <p style="font-size: 15px; color: #374151; margin-bottom: 0; line-height: 1.6;">
              {{ __('Sélectionnez l\'heure de votre premier Rituel. Les créneaux sont affichés dans votre fuseau horaire.') }}
            </p>
          </div>
        </div>
        
        <!-- Bouton pour accéder au nouveau calendrier Preply -->
        <div style="text-align: center; padding: 40px 20px; background: white; border-radius: 16px; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
          <div style="margin-bottom: 24px;">
            <i class="fas fa-calendar-check" style="font-size: 48px; color: #4F46E5; margin-bottom: 16px;"></i>
            <h3 style="font-size: 24px; font-weight: 600; color: #111827; margin-bottom: 12px;">{{ __('Programmez vos Rituels') }}</h3>
            <p style="font-size: 16px; color: #6B7280; margin-bottom: 0; max-width: 500px; margin-left: auto; margin-right: auto;">
              {{ __('Accédez à notre nouveau système de réservation pour sélectionner vos créneaux horaires facilement.') }}
            </p>
          </div>
          @auth('web')
            <a href="{{ route('freelance.booking', $freelancer->id) }}" 
               class="btn" 
               style="background: linear-gradient(135deg, #4F46E5 0%, #7C3AED 100%); color: white; border: none; border-radius: 12px; padding: 14px 32px; font-weight: 600; font-size: 16px; text-decoration: none; display: inline-flex; align-items: center; gap: 10px; box-shadow: 0 4px 12px rgba(79, 70, 229, 0.3); transition: all 0.2s;"
               onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 6px 20px rgba(79, 70, 229, 0.4)';"
               onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 12px rgba(79, 70, 229, 0.3)';">
              <i class="fas fa-calendar-alt"></i>
              {{ __('Accéder au calendrier') }}
            </a>
          @else
            <a href="{{ route('user.login') }}" 
               class="btn" 
               style="background: linear-gradient(135deg, #4F46E5 0%, #7C3AED 100%); color: white; border: none; border-radius: 12px; padding: 14px 32px; font-weight: 600; font-size: 16px; text-decoration: none; display: inline-flex; align-items: center; gap: 10px; box-shadow: 0 4px 12px rgba(79, 70, 229, 0.3); transition: all 0.2s;"
               onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 6px 20px rgba(79, 70, 229, 0.4)';"
               onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 12px rgba(79, 70, 229, 0.3)';">
              <i class="fas fa-sign-in-alt"></i>
              {{ __('Se connecter pour réserver') }}
            </a>
          @endauth
        </div>
      </div>

      <!-- Section 8 : Ces freelances pourraient aussi vous intéresser -->
                @if(isset($recommendedFreelancers) && $recommendedFreelancers->isNotEmpty())
        <div class="freelance-content-section">
          <h2 class="freelance-section-title">
            <i class="fas fa-users"></i>
            {{ __('Ces freelances pourraient aussi vous intéresser') }}
          </h2>
          <div class="row g-4">
            @foreach($recommendedFreelancers->take(4) as $recFreelancer)
                    @if(isset($recFreelancer->user) && $recFreelancer->user)
                      <div class="col-md-6 col-lg-3">
                  <div style="background: white; border: 1px solid #E5E7EB; border-radius: 20px; padding: 24px; transition: all 0.2s; cursor: pointer; height: 100%;" 
                       onmouseover="this.style.boxShadow='0 8px 24px rgba(0,0,0,0.1)'; this.style.transform='translateY(-4px)'" 
                       onmouseout="this.style.boxShadow='none'; this.style.transform='translateY(0)'">
                    <div class="text-center mb-3">
                          @if($recFreelancer->user->image)
                            <img src="{{ asset('assets/img/users/' . $recFreelancer->user->image) }}" 
                                 alt="{{ $recFreelancer->user->name }}" 
                                 class="rounded-circle" 
                             style="width: 64px; height: 64px; object-fit: cover; margin: 0 auto;">
                          @else
                        <div class="rounded-circle d-flex align-items-center justify-content-center mx-auto"
                             style="width: 64px; height: 64px; background: var(--junspro-gradient); color: white; font-weight: 700; font-size: 24px;">
                              {{ strtoupper(substr($recFreelancer->user->name ?? 'F', 0, 1)) }}
                            </div>
                              @endif
                            </div>
                    <h4 class="text-center mb-2" style="font-size: 16px; font-weight: 600; color: #111827;">{{ $recFreelancer->user->name }}</h4>
                    <div class="text-center mb-3">
                          @for($i = 0; $i < 5; $i++)
                        <i class="fas fa-star" style="color: #FCD34D; font-size: 14px;"></i>
                          @endfor
                      <small class="text-muted ms-1" style="font-size: 13px;">({{ rand(5, 50) }})</small>
                    </div>
                    <div class="text-center mb-3">
                      <strong style="font-size: 18px; color: #111827;">{{ number_format($recFreelancer->hourly_rate ?? 45, 0) }} €</strong>
                        </div>
                        <a href="{{ route('freelance.show', $recFreelancer->id) }}" 
                       class="btn w-100" 
                       style="background: var(--junspro-gradient); color: white; border: none; font-size: 14px; padding: 12px; border-radius: 12px; font-weight: 600; text-decoration: none; display: block; text-align: center;">
                          {{ __('Voir le profil') }}
                        </a>
                      </div>
                    </div>
                    @endif
                  @endforeach
          </div>
                  </div>
                @endif
              </div>
            </div>

  <!-- Modal Contact -->
  <div class="modal fade" id="contactModal" tabindex="-1" aria-labelledby="contactModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="contactModalLabel">{{ __('Envoyer un message à') }} {{ $user->name }}</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form id="contactFreelancerForm">
            @csrf
            <div class="mb-3">
              <label for="contactSubject" class="form-label">{{ __('Sujet') }}</label>
              <input type="text" class="form-control" id="contactSubject" name="subject" required>
            </div>
            <div class="mb-3">
              <label for="contactMessage" class="form-label">{{ __('Message') }}</label>
              <textarea class="form-control" id="contactMessage" name="message" rows="5" required></textarea>
            </div>
            <div class="d-grid">
              <button type="submit" class="btn" style="background: var(--junspro-gradient); color: white;">
                <i class="fas fa-paper-plane me-2"></i>
                {{ __('Envoyer') }}
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection
