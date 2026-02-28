@extends('frontend.layout')

@section('pageHeading')
  Cours | {{ $websiteInfo->website_title }}
@endsection

@section('metaDescription')
  Trouvez un freelance pour progresser. Rituel d'essai, objectifs clairs, suivi régulier.
@endsection

@section('style')
<link rel="stylesheet" href="{{ asset('assets/front/css/services-pages.css') }}">
<style>
  /* ============================================
     PAGE PREPLY STYLE - ADAPTÉE JUNSPRO
     ============================================ */
  
  /* Variables couleurs Lessons - Dégradé bleu cyan bleu royal */
  :root {
    --preply-primary: #06B6D4; /* Cyan-500 */
    --preply-primary-dark: #2563EB; /* Blue-600 - Bleu royal */
    --preply-primary-light: #22D3EE; /* Cyan-400 - Cyan clair */
    --preply-pink: #0EA5E9; /* Sky-500 */
    --preply-pink-light: #38BDF8; /* Sky-400 */
    --preply-text: #1F2937;
    --preply-text-light: #6B7280;
    --preply-bg: #FFFFFF;
    --preply-border: #E5E7EB;
    --preply-hover: #F9FAFB;
  }

  /* Hero Lessons - Dégradé bleu cyan bleu royal */
  .services-hero {
    background: linear-gradient(
      135deg,
      #67E8F9 0%,
      #22D3EE 20%,
      #06B6D4 40%,
      #0891B2 60%,
      #2563EB 80%,
      #1E40AF 100%
    ) !important;
    box-shadow: 
      0 20px 60px rgba(6, 182, 212, 0.25),
      0 0 0 1px rgba(255, 255, 255, 0.1) inset;
  }

  .services-hero__placeholder {
    background: linear-gradient(
      135deg,
      #67E8F9 0%,
      #22D3EE 20%,
      #06B6D4 40%,
      #0891B2 60%,
      #2563EB 80%,
      #1E40AF 100%
    ) !important;
  }

  .services-hero__placeholder::after {
    background: linear-gradient(
      135deg,
      rgba(255, 255, 255, 0.1) 0%,
      transparent 50%,
      rgba(6, 182, 212, 0.1) 100%
    );
  }

  /* Boutons hero Lessons - Adaptation bleu cyan */
  .services-hero__btn--primary {
    color: #2563EB !important;
  }

  .services-hero__btn--primary:hover {
    color: #1E40AF !important;
  }

  .services-hero__btn--secondary {
    border-color: rgba(255, 255, 255, 0.5) !important;
  }

  .services-hero__btn--secondary:hover {
    border-color: rgba(255, 255, 255, 0.7) !important;
    background: rgba(255, 255, 255, 0.3) !important;
  }

  /* Section titre et description Preply */
  .preply-intro-section {
    background: var(--preply-bg);
    padding: 40px 0;
    border-bottom: 1px solid var(--preply-border);
  }

  .preply-intro-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 24px;
  }

  .preply-intro-title {
    font-size: 2.5rem;
    font-weight: 700;
    color: var(--preply-text);
    margin-bottom: 16px;
    line-height: 1.2;
  }

  .preply-intro-description {
    font-size: 1.125rem;
    color: var(--preply-text-light);
    line-height: 1.6;
    margin-bottom: 24px;
  }

  .preply-intro-description.collapsed {
    max-height: 120px;
    overflow: hidden;
  }

  .preply-intro-description.expanded {
    max-height: none;
  }

  .preply-intro-toggle {
    color: var(--preply-primary);
    background: none;
    border: none;
    font-size: 1rem;
    font-weight: 600;
    cursor: pointer;
    padding: 0;
    margin-top: 8px;
  }

  .preply-intro-toggle:hover {
    text-decoration: underline;
  }

  /* Barre de filtres horizontaux Preply */
  .preply-filters-section {
    background: var(--preply-bg);
    padding: 24px 0;
    border-bottom: 1px solid var(--preply-border);
    position: sticky;
    top: 0;
    z-index: 100;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
  }

  .preply-filters-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 24px;
  }

  .preply-filters-row {
    display: flex;
    flex-wrap: wrap;
    gap: 12px;
    align-items: center;
    margin-bottom: 16px;
  }

  .preply-filter-group {
    position: relative;
    min-width: 200px;
    flex: 1;
  }

  .preply-filter-label {
    font-size: 0.875rem;
    color: var(--preply-text-light);
    margin-bottom: 4px;
    display: block;
  }

  .preply-filter-select,
  .preply-filter-input {
    width: 100%;
    padding: 10px 12px;
    border: 1px solid var(--preply-border);
    border-radius: 8px;
    font-size: 0.9375rem;
    background: var(--preply-bg);
    color: var(--preply-text);
    cursor: pointer;
    transition: all 0.2s;
  }

  .preply-filter-select:hover,
  .preply-filter-input:hover {
    border-color: var(--preply-primary);
  }

  .preply-filter-select:focus,
  .preply-filter-input:focus {
    outline: none;
    border-color: var(--preply-primary);
    box-shadow: 0 0 0 3px rgba(6, 182, 212, 0.1);
  }

  /* Interface de sélection de disponibilité */
  .preply-availability-group {
    position: relative;
  }

  .preply-availability-trigger {
    width: 100%;
    padding: 10px 12px;
    border: 1px solid var(--preply-border);
    border-radius: 8px;
    font-size: 0.9375rem;
    background: var(--preply-bg);
    color: var(--preply-text);
    cursor: pointer;
    display: flex;
    justify-content: space-between;
    align-items: center;
    transition: all 0.2s;
  }

  .preply-availability-trigger:hover {
    border-color: var(--preply-primary);
  }

  .preply-availability-trigger i {
    font-size: 0.75rem;
    transition: transform 0.2s;
  }

  .preply-availability-trigger.active i {
    transform: rotate(180deg);
  }

  .preply-availability-panel {
    position: absolute;
    top: calc(100% + 8px);
    left: 0;
    right: 0;
    background: var(--preply-bg);
    border: 1px solid var(--preply-border);
    border-radius: 12px;
    box-shadow: 0 8px 24px rgba(0, 0, 0, 0.12);
    padding: 20px;
    z-index: 1000;
    display: none;
    max-height: 500px;
    overflow-y: auto;
  }

  .preply-availability-panel.active {
    display: block;
  }

  .availability-section {
    margin-bottom: 24px;
  }

  .availability-section:last-of-type {
    margin-bottom: 0;
  }

  .availability-section-title {
    font-size: 1rem;
    font-weight: 600;
    color: var(--preply-text);
    margin-bottom: 12px;
  }

  .availability-time-group {
    margin-bottom: 16px;
  }

  .availability-time-label {
    font-size: 0.875rem;
    color: var(--preply-text-light);
    margin-bottom: 8px;
    font-weight: 500;
  }

  .availability-time-slots {
    display: flex;
    gap: 8px;
    flex-wrap: wrap;
  }

  .availability-time-btn {
    padding: 10px 16px;
    border: 1px solid var(--preply-border);
    border-radius: 8px;
    background: var(--preply-bg);
    color: var(--preply-text);
    cursor: pointer;
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 4px;
    font-size: 0.875rem;
    transition: all 0.2s;
    min-width: 70px;
  }

  .availability-time-btn:hover {
    border-color: var(--preply-primary);
    background: var(--preply-hover);
  }

  .availability-time-btn.selected {
    background: linear-gradient(135deg, var(--preply-primary-dark) 0%, var(--preply-primary) 50%, var(--preply-primary-light) 100%);
    color: white;
    border-color: var(--preply-primary);
  }

  .availability-time-btn i {
    font-size: 1rem;
  }

  .availability-days {
    display: flex;
    gap: 8px;
    flex-wrap: wrap;
  }

  .availability-day-btn {
    flex: 1;
    min-width: 50px;
    padding: 10px 12px;
    border: 1px solid var(--preply-border);
    border-radius: 8px;
    background: var(--preply-bg);
    color: var(--preply-text);
    cursor: pointer;
    font-size: 0.875rem;
    font-weight: 500;
    transition: all 0.2s;
    text-align: center;
  }

  .availability-day-btn:hover {
    border-color: var(--preply-primary);
    background: var(--preply-hover);
  }

  .availability-day-btn.selected {
    background: linear-gradient(135deg, var(--preply-primary-dark) 0%, var(--preply-primary) 50%, var(--preply-primary-light) 100%);
    color: white;
    border-color: var(--preply-primary);
  }

  .availability-actions {
    display: flex;
    gap: 8px;
    margin-top: 20px;
    padding-top: 16px;
    border-top: 1px solid var(--preply-border);
  }

  .availability-clear-btn,
  .availability-apply-btn {
    flex: 1;
    padding: 10px 16px;
    border-radius: 8px;
    font-size: 0.875rem;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.2s;
    border: none;
  }

  .availability-clear-btn {
    background: var(--preply-bg);
    color: var(--preply-text);
    border: 1px solid var(--preply-border);
  }

  .availability-clear-btn:hover {
    background: var(--preply-hover);
  }

  .availability-apply-btn {
    background: linear-gradient(135deg, var(--preply-primary-dark) 0%, var(--preply-primary) 50%, var(--preply-primary-light) 100%);
    color: white;
  }

  .availability-apply-btn:hover {
    box-shadow: 0 4px 12px rgba(6, 182, 212, 0.3);
  }

  .preply-filters-advanced {
    display: flex;
    flex-wrap: wrap;
    gap: 12px;
    margin-top: 12px;
  }

  .preply-filter-advanced {
    min-width: 150px;
    flex: 0 1 auto;
  }

  .preply-search-input {
    flex: 1;
    min-width: 200px;
  }

  /* Résultats et tri */
  .preply-results-section {
    background: var(--preply-bg);
    padding: 32px 0;
    overflow: visible; /* Permettre à la vidéo de dépasser */
  }

  .preply-results-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 24px;
    overflow: visible; /* Permettre à la vidéo de dépasser */
    position: relative;
  }

  .preply-results-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 24px;
    flex-wrap: wrap;
    gap: 16px;
  }

  .preply-results-count {
    font-size: 1.5rem;
    font-weight: 700;
    color: var(--preply-text);
  }

  .preply-sort-select {
    padding: 8px 12px;
    border: 1px solid var(--preply-border);
    border-radius: 8px;
    font-size: 0.9375rem;
    background: var(--preply-bg);
    color: var(--preply-text);
    cursor: pointer;
  }

  /* ============================================
     CARTES PROFESSEURS PREPLY - Duplication exacte
     Mesures contractuelles strictes
     ============================================ */
  
  .preply-teachers-list {
    display: flex;
    flex-direction: column;
    gap: 16px; /* Espacement réduit entre cartes pour effet compact */
    max-width: 808px; /* Largeur réduite de 2cm (75px) : 883px - 75px */
    margin: 0 auto;
    padding: 0;
  }

  /* Wrapper pour chaque carte */
  .preply-teacher-card-wrapper {
    position: relative;
    width: 100%;
    max-width: 980px;
    margin: 0 auto;
  }

  /* Carte principale - Duplication exacte Preply (compacte + premium) */
  .preply-teacher-card {
    background: var(--preply-bg);
    border: 1px solid rgba(0, 0, 0, 0.08); /* Border subtile comme Preply */
    border-radius: 12px;
    padding: 18px; /* Padding réduit pour carte compacte */
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.06), 0 1px 2px rgba(0, 0, 0, 0.04); /* Ombre douce Preply */
    display: grid;
    grid-template-columns: 135px 1fr 240px; /* Col A (photo fixe agrandie de 0.5cm) | Col B (infos) | Col C (prix/CTA) */
    gap: 16px; /* Gap réduit pour compacité */
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); /* Transition premium fluide */
    position: relative;
    width: 100%;
    min-height: auto;
  }

  /* Effet premium au hover - Élévation subtile comme Preply */
  .preply-teacher-card:hover {
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08), 0 2px 4px rgba(0, 0, 0, 0.04); /* Ombre plus prononcée */
    transform: translateY(-2px); /* Légère élévation premium */
    border-color: rgba(0, 0, 0, 0.12); /* Border légèrement plus visible */
  }

  /* ============================================
     COLONNE PHOTO - ESPACE FIXE OBLIGATOIRE (compacte)
     Jamais de collapse, toujours 100px
     ============================================ */
  .preply-teacher-photo {
    width: 135px; /* Colonne photo agrandie pour accommoder l'avatar de 115px + espace */
    flex-shrink: 0; /* Interdit le rétrécissement */
    position: relative;
    display: flex;
    flex-direction: column;
    align-items: center;
  }

  /* Conteneur avatar - Photo carrée Preply (pas ronde) - AGRANDIE de 0.5cm */
  .preply-teacher-photo-avatar {
    width: 115px; /* Taille agrandie de 0.5cm (19px) : 96px + 19px */
    height: 115px; /* Photo carrée agrandie */
    border-radius: 8px; /* Coins arrondis subtils */
    overflow: visible !important; /* IMPORTANT: permettre aux badges de dépasser */
    position: relative !important; /* IMPORTANT: pour le positionnement absolu des badges */
    flex-shrink: 0;
    background: #f3f4f6; /* Fond placeholder */
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1); /* Ombre subtile sur photo */
  }
  
  .preply-teacher-photo img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    object-position: center;
    display: block;
    border-radius: 8px;
  }

  /* Placeholder si pas d'image - Même taille, pas de collapse */
  .preply-teacher-photo-placeholder {
    width: 100%;
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    background: linear-gradient(135deg, #2563EB 0%, #06B6D4 50%, #22D3EE 100%);
    color: white;
    font-size: 1.75rem; /* Taille réduite pour carte compacte */
    font-weight: 600;
    border-radius: 8px;
  }

  .preply-teacher-badge {
    position: absolute;
    bottom: -2px;
    right: -2px;
    background: var(--preply-primary);
    color: white;
    width: 24px;
    height: 24px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 0.75rem;
    border: 2px solid white;
    z-index: 2;
  }

  /* Badge "En ligne" vert en angle droit */
  .preply-teacher-online-badge {
    position: absolute;
    top: -2px;
    right: -2px;
    background: #10b981; /* Vert */
    color: white;
    padding: 4px 8px;
    border-radius: 4px;
    font-size: 0.6875rem; /* 11px */
    font-weight: 600;
    white-space: nowrap;
    border: 2px solid white;
    z-index: 10 !important; /* Z-index élevé pour être visible */
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.15);
    display: block !important; /* Forcer l'affichage */
  }

  /* Badge gris "Dernière connexion" avec tooltip - Petit point */
  .preply-teacher-last-seen-badge {
    position: absolute;
    top: -2px;
    right: -2px;
    width: 8px;
    height: 8px;
    background: #6b7280; /* Gris */
    border-radius: 50%;
    border: 2px solid white;
    z-index: 10 !important; /* Z-index élevé pour être visible */
    cursor: pointer;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.15);
    display: block !important; /* Forcer l'affichage */
  }

  /* Tooltip pour dernière connexion - CACHÉ par défaut */
  .preply-teacher-last-seen-tooltip {
    position: absolute;
    bottom: calc(100% + 8px);
    right: 0;
    background: #1f2937; /* Gris foncé */
    color: white;
    padding: 8px 12px;
    border-radius: 6px;
    font-size: 0.75rem; /* 12px */
    white-space: nowrap;
    opacity: 0 !important; /* Forcer à être caché */
    visibility: hidden !important; /* Forcer à être caché */
    pointer-events: none;
    transition: opacity 0.2s, visibility 0.2s;
    z-index: 10;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.25);
    display: none !important; /* Cacher complètement par défaut */
  }

  /* Flèche du tooltip */
  .preply-teacher-last-seen-tooltip::after {
    content: '';
    position: absolute;
    top: 100%;
    right: 12px;
    width: 0;
    height: 0;
    border-left: 6px solid transparent;
    border-right: 6px solid transparent;
    border-top: 6px solid #1f2937;
  }

  /* Afficher le tooltip UNIQUEMENT au survol */
  .preply-teacher-last-seen-badge:hover .preply-teacher-last-seen-tooltip {
    opacity: 1 !important;
    visibility: visible !important;
    display: block !important; /* Afficher uniquement au survol */
  }

  /* Informations professeur - Style Preply exact */
  .preply-teacher-info {
    flex: 1;
    min-width: 0;
  }

  .preply-teacher-name {
    font-size: 1rem; /* Taille réduite pour compacité */
    font-weight: 600;
    color: var(--preply-text);
    margin-bottom: 2px; /* Espacement réduit */
    display: flex;
    align-items: center;
    gap: 6px;
    line-height: 1.3;
  }
  
  /* Masquer tout texte "Dernière connexion" visible sur la carte */
  .preply-teacher-info *:not(.preply-teacher-last-seen-tooltip) {
    /* S'assurer qu'aucun texte "Dernière connexion" n'est visible */
  }
  
  /* Masquer spécifiquement les éléments contenant "Dernière connexion" */
  .preply-teacher-info [data-last-seen]::before,
  .preply-teacher-info [data-last-seen]::after {
    display: none !important;
  }

  .preply-teacher-name a {
    color: var(--preply-text);
    text-decoration: none;
  }

  .preply-teacher-name a:hover {
    color: var(--preply-primary);
  }

  .preply-teacher-verified {
    color: var(--preply-primary);
    font-size: 0.875rem;
  }

  .preply-teacher-country {
    font-size: 0.8125rem; /* Taille réduite */
    color: var(--preply-text-light);
    margin-bottom: 4px; /* Espacement réduit */
  }

  .preply-teacher-subject {
    font-size: 0.8125rem; /* Taille réduite */
    color: var(--preply-text);
    margin-bottom: 4px; /* Espacement réduit */
    font-weight: 500;
  }

  .preply-teacher-languages {
    font-size: 0.8125rem; /* Taille réduite */
    color: var(--preply-text-light);
    margin-bottom: 8px; /* Espacement réduit */
  }

  .preply-teacher-bio {
    font-size: 0.875rem; /* Taille réduite */
    color: var(--preply-text);
    line-height: 1.5;
    margin-bottom: 8px; /* Espacement réduit */
  }

  .preply-teacher-learn-more {
    color: var(--preply-primary);
    font-size: 0.8125rem; /* Taille réduite */
    font-weight: 600;
    text-decoration: none;
    display: inline-block;
    margin-bottom: 6px; /* Espacement réduit */
    transition: color 0.2s;
  }

  .preply-teacher-learn-more:hover {
    text-decoration: underline;
    color: var(--preply-primary-dark);
  }

  .preply-teacher-popularity {
    font-size: 0.8125rem; /* Taille réduite */
    color: var(--preply-text-light);
    margin-bottom: 0; /* Pas de marge en bas */
  }

  /* Prix et CTA - Colonne actions Preply (compacte) */
  .preply-teacher-pricing {
    width: 240px; /* Colonne actions Preply */
    display: flex;
    flex-direction: column;
    align-items: flex-end;
    gap: 6px; /* Gap réduit */
  }

  .preply-teacher-price {
    font-size: 1.375rem; /* Taille réduite */
    font-weight: 700;
    color: var(--preply-text);
    text-align: right;
    line-height: 1.2;
  }

  .preply-teacher-price-label {
    font-size: 0.8125rem; /* Taille réduite */
    color: var(--preply-text-light);
  }

  .preply-teacher-rating {
    display: flex;
    align-items: center;
    gap: 4px;
    margin-bottom: 2px; /* Espacement réduit */
  }

  .preply-teacher-rating-score {
    font-size: 1rem; /* Taille réduite */
    font-weight: 600;
    color: var(--preply-text);
  }

  .preply-teacher-rating-count {
    font-size: 0.8125rem; /* Taille réduite */
    color: var(--preply-text-light);
  }

  .preply-teacher-stats {
    font-size: 0.8125rem; /* Taille réduite */
    color: var(--preply-text-light);
    margin-bottom: 12px; /* Espacement réduit */
    line-height: 1.4;
  }

  .preply-teacher-btn {
    padding: 10px 16px; /* Padding réduit */
    border-radius: 8px;
    font-size: 0.875rem; /* Taille réduite */
    font-weight: 600;
    cursor: pointer;
    transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1); /* Transition premium */
    text-decoration: none;
    display: inline-block;
    text-align: center;
    width: 100%;
  }

  .preply-teacher-btn-primary {
    background: linear-gradient(135deg, var(--preply-primary-dark) 0%, var(--preply-primary) 50%, var(--preply-primary-light) 100%);
    color: white;
    border: none;
    margin-bottom: 6px; /* Espacement réduit */
    box-shadow: 0 2px 4px rgba(6, 182, 212, 0.2); /* Ombre subtile */
  }

  /* Effet premium au hover */
  .preply-teacher-btn-primary:hover {
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(6, 182, 212, 0.35), 0 2px 4px rgba(6, 182, 212, 0.2); /* Ombre plus prononcée */
  }

  .preply-teacher-btn-secondary {
    background: var(--preply-bg);
    color: var(--preply-text);
    border: 1px solid var(--preply-border);
  }

  .preply-teacher-btn-secondary:hover {
    background: var(--preply-hover);
    border-color: var(--preply-primary);
  }

  /* ============================================
     POPOVER VIDÉO PREPLY - Duplication exacte
     Portal (position: fixed) + Hoverable + Flèche toggle
     ============================================ */
  
  /* Popover vidéo unique (portal au niveau body) */
  #preply-video-popover {
    position: fixed;
    width: 320px; /* 300-340px comme spécifié */
    background: var(--preply-bg);
    border-radius: 12px;
    border: 1px solid rgba(0, 0, 0, 0.10);
    box-shadow: 0 8px 24px rgba(0, 0, 0, 0.15);
    padding: 0;
    opacity: 0;
    visibility: hidden;
    transition: opacity 0.1s ease-out, 
                visibility 0.1s ease-out; /* Open: 80-120ms */
    z-index: 9999;
    pointer-events: none;
    overflow: hidden;
  }

  #preply-video-popover.is-visible {
    opacity: 1;
    visibility: visible;
    pointer-events: all;
  }

  /* Flèche pour toggle gauche/droite */
  .preply-popover-arrow {
    position: absolute;
    top: 12px;
    width: 28px;
    height: 28px;
    background: rgba(255, 255, 255, 0.9);
    border: 1px solid rgba(0, 0, 0, 0.1);
    border-radius: 6px;
    display: none; /* Masqué par défaut, affiché par JS selon le côté */
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: all 0.2s;
    z-index: 10;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
  }

  .preply-popover-arrow:hover {
    background: rgba(255, 255, 255, 1);
    border-color: rgba(0, 0, 0, 0.2);
    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.15);
  }

  .preply-popover-arrow.arrow-left {
    left: 8px;
  }

  .preply-popover-arrow.arrow-right {
    right: 8px;
  }

  .preply-popover-arrow i {
    font-size: 0.75rem;
    color: var(--preply-text);
  }

  /* Vidéo thumbnail - Bloc vidéo rectangle */
  .preply-popover-video-thumbnail {
    width: 100%;
    height: 200px;
    border-radius: 12px 12px 0 0;
    overflow: hidden;
    position: relative;
    background: #000;
  }

  .preply-popover-video-thumbnail img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
  }

  /* Bouton play rond rose (comme capture Preply) */
  .preply-popover-play-btn {
    position: absolute;
    bottom: 12px;
    right: 12px;
    width: 52px;
    height: 52px;
    background: linear-gradient(135deg, #EC4899 0%, #F472B6 100%); /* Rose Preply */
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 1.25rem;
    cursor: pointer;
    transition: all 0.2s;
    border: none;
    z-index: 5;
    box-shadow: 0 4px 12px rgba(236, 72, 153, 0.4);
  }

  .preply-popover-play-btn:hover {
    transform: scale(1.1);
    box-shadow: 0 6px 16px rgba(236, 72, 153, 0.5);
  }

  .preply-popover-play-btn i {
    margin-left: 2px;
  }

  /* Actions vidéo - 2 boutons pleine largeur */
  .preply-popover-actions {
    display: flex;
    flex-direction: column;
    gap: 8px;
    padding: 12px;
  }

  .preply-popover-action-btn {
    padding: 10px 16px;
    background: var(--preply-bg);
    border: 1px solid var(--preply-border);
    border-radius: 8px;
    font-size: 0.875rem;
    color: var(--preply-text);
    text-decoration: none;
    text-align: center;
    transition: all 0.2s;
    width: 100%;
  }

  .preply-popover-action-btn:hover {
    background: var(--preply-hover);
    border-color: var(--preply-primary);
  }

  /* Responsive */
  @media (max-width: 1024px) {
    .preply-teacher-card {
      grid-template-columns: 72px 1fr;
      gap: 12px;
    }

    .preply-teacher-pricing {
      grid-column: 1 / -1;
      width: 100%;
      align-items: flex-start;
      margin-top: 12px;
    }

    .preply-teacher-card {
      grid-template-columns: 96px 1fr;
      gap: 16px;
    }

    .preply-teacher-photo {
      width: 115px; /* Taille agrandie de 0.5cm sur tablette aussi */
    }

    .preply-teacher-pricing {
      grid-column: 1 / -1;
      width: 100%;
      align-items: flex-start;
      margin-top: 12px;
    }

    /* Sur mobile/tablette : masquer popover vidéo hover */
    #preply-video-popover {
      display: none !important;
    }

    .preply-teacher-card-mobile-video-btn {
      display: inline-flex;
      align-items: center;
      gap: 6px;
      padding: 8px 12px;
      background: var(--preply-bg);
      border: 1px solid var(--preply-border);
      border-radius: 8px;
      font-size: 0.875rem;
      color: var(--preply-text);
      text-decoration: none;
      margin-top: 8px;
    }
  }

  @media (max-width: 768px) {
    .preply-filters-row {
      flex-direction: column;
    }

    .preply-filter-group {
      width: 100%;
    }

    .preply-teachers-list {
      max-width: 100%;
      padding: 0 16px;
    }

    .preply-teacher-card-wrapper {
      max-width: 100%;
    }

    .preply-teacher-card {
      padding: 16px;
      border-width: 1px;
    }
  }

  /* Desktop: bouton mobile vidéo masqué */
  .preply-teacher-card-mobile-video-btn {
    display: none;
  }
</style>
@endsection

@section('content')
<div class="services-page-wrapper">
  {{-- Hero conservé --}}
  <x-services.hero
    title="Cours"
    subtitle="Des progrès qui se voient."
    micro="Rituel d'essai, objectifs clairs, suivi régulier. Vous avancez sereinement."
    :cta="['text' => 'Réserver un essai', 'url' => '#results', 'variant' => 'primary']"
  />

  {{-- Section titre et description Preply --}}
  <section class="preply-intro-section">
    <div class="preply-intro-container">
      <h1 class="preply-intro-title">Rituels en ligne avec un freelance</h1>
      <div class="preply-intro-description collapsed" id="introDescription">
        Envie d'apprendre ? Vous êtes entre de bonnes mains ! Avec Junspro, trouvez le <strong>Rituel en ligne</strong> qu'il vous faut pour développer vos compétences. Nous vous offrons le meilleur pour apprendre : Plus de {{ $freelancers->total() ?? 0 }} freelances disponibles sur notre plateforme Des freelances vérifiés et certifiés Une évaluation moyenne de 4.92/5 donnée par plus de {{ $freelancers->total() * 10 ?? 0 }} clients satisfaits Une salle de classe virtuelle et toutes les ressources pour progresser Profitez de la qualité d'un Rituel dans le confort de votre domicile, avec tous les avantages d'un accompagnement à distance ! Envie de progresser ? Découvrez nos ressources pour apprendre.
    </div>
      <button class="preply-intro-toggle" onclick="toggleDescription()">Voir plus</button>
  </div>
  </section>

  {{-- Barre de filtres horizontaux Preply --}}
  <section class="preply-filters-section">
    <div class="preply-filters-container">
      <form method="GET" action="{{ route('services.lessons') }}" id="preplyFiltersForm">
        <div class="preply-filters-row">
          <div class="preply-filter-group">
            <label class="preply-filter-label">Ce que je veux apprendre</label>
            <select name="category" class="preply-filter-select">
              <option value="">Toutes les catégories</option>
              @foreach($categories as $category)
                <option value="{{ strtolower($category) }}" {{ (request('category') == strtolower($category)) ? 'selected' : '' }}>
                  {{ $category }}
                </option>
              @endforeach
            </select>
          </div>

          <div class="preply-filter-group">
            <label class="preply-filter-label">Tarif par Rituel</label>
            <select name="price_range" class="preply-filter-select">
              <option value="">Tous les rituels</option>
              <option value="3-20" {{ request('price_range') == '3-20' ? 'selected' : '' }}>3-20 €</option>
              <option value="20-30" {{ request('price_range') == '20-30' ? 'selected' : '' }}>20-30 €</option>
              <option value="30-40" {{ request('price_range') == '30-40' ? 'selected' : '' }}>30-40 €</option>
              <option value="40-50" {{ request('price_range') == '40-50' ? 'selected' : '' }}>40-50 €</option>
              <option value="50+" {{ request('price_range') == '50+' ? 'selected' : '' }}>50€ et +</option>
            </select>
          </div>

          <div class="preply-filter-group">
            <label class="preply-filter-label">Pays de naissance</label>
            <select name="country" class="preply-filter-select">
              <option value="">Tous les pays</option>
              <option value="FR" {{ request('country') == 'FR' ? 'selected' : '' }}>France</option>
              <option value="US" {{ request('country') == 'US' ? 'selected' : '' }}>États-Unis</option>
              <option value="GB" {{ request('country') == 'GB' ? 'selected' : '' }}>Royaume-Uni</option>
              <option value="ES" {{ request('country') == 'ES' ? 'selected' : '' }}>Espagne</option>
            </select>
          </div>

          <div class="preply-filter-group preply-availability-group">
            <label class="preply-filter-label">Mes disponibilités</label>
            <button type="button" class="preply-availability-trigger" onclick="toggleAvailabilityPanel()">
              <span class="availability-selected-text">Toutes les heures</span>
              <i class="fas fa-chevron-down"></i>
            </button>
            <div class="preply-availability-panel" id="availabilityPanel">
              <div class="availability-section">
                <h4 class="availability-section-title">Heures</h4>
                
                <div class="availability-time-group">
                  <div class="availability-time-label">Journée</div>
                  <div class="availability-time-slots">
                    <button type="button" class="availability-time-btn" data-time="9-12">
                      <i class="fas fa-sun"></i>
                      <span>9-12</span>
                    </button>
                    <button type="button" class="availability-time-btn" data-time="12-15">
                      <i class="fas fa-sun"></i>
                      <span>12-15</span>
                    </button>
                    <button type="button" class="availability-time-btn" data-time="15-18">
                      <i class="fas fa-sun"></i>
                      <span>15-18</span>
                    </button>
                  </div>
                </div>
                
                <div class="availability-time-group">
                  <div class="availability-time-label">Soir et nuit</div>
                  <div class="availability-time-slots">
                    <button type="button" class="availability-time-btn" data-time="18-21">
                      <i class="fas fa-sun"></i>
                      <span>18-21</span>
                    </button>
                    <button type="button" class="availability-time-btn" data-time="21-24">
                      <i class="fas fa-moon"></i>
                      <span>21-24</span>
                    </button>
                    <button type="button" class="availability-time-btn" data-time="0-3">
                      <i class="fas fa-moon"></i>
                      <span>0-3</span>
                    </button>
                  </div>
                </div>
                
                <div class="availability-time-group">
                  <div class="availability-time-label">Tôt le matin</div>
                  <div class="availability-time-slots">
                    <button type="button" class="availability-time-btn" data-time="3-6">
                      <i class="fas fa-moon"></i>
                      <span>3-6</span>
                    </button>
                    <button type="button" class="availability-time-btn" data-time="6-9">
                      <i class="fas fa-sun"></i>
                      <span>6-9</span>
                    </button>
                  </div>
                </div>
              </div>
              
              <div class="availability-section">
                <h4 class="availability-section-title">Jours</h4>
                <div class="availability-days">
                  <button type="button" class="availability-day-btn" data-day="0">Dim</button>
                  <button type="button" class="availability-day-btn" data-day="1">Lun</button>
                  <button type="button" class="availability-day-btn" data-day="2">Mar</button>
                  <button type="button" class="availability-day-btn" data-day="3">Mer</button>
                  <button type="button" class="availability-day-btn" data-day="4">Jeu</button>
                  <button type="button" class="availability-day-btn" data-day="5">Ven</button>
                  <button type="button" class="availability-day-btn" data-day="6">Sam</button>
                </div>
              </div>
              
              <div class="availability-actions">
                <button type="button" class="availability-clear-btn" onclick="clearAvailabilitySelection()">Effacer</button>
                <button type="button" class="availability-apply-btn" onclick="applyAvailabilityFilter()">Appliquer</button>
              </div>
            </div>
          </div>

        </div>

        <div class="preply-filters-advanced">
          <div class="preply-filter-advanced">
            <select name="specialization" class="preply-filter-select">
              <option value="">Spécialisation</option>
              <option value="beginner">Débutant</option>
              <option value="intermediate">Intermédiaire</option>
              <option value="advanced">Avancé</option>
            </select>
          </div>

          <div class="preply-filter-advanced">
            <select name="teacher_speaks" class="preply-filter-select">
              <option value="">Je parle</option>
              <option value="french">Français</option>
              <option value="english">Anglais</option>
              <option value="spanish">Espagnol</option>
            </select>
          </div>

          <div class="preply-filter-advanced">
            <select name="native_language" class="preply-filter-select">
              <option value="">Langue maternelle</option>
              <option value="french">Français</option>
              <option value="english">Anglais</option>
              <option value="spanish">Espagnol</option>
            </select>
    </div>

          <div class="preply-filter-advanced">
            <select name="teacher_category" class="preply-filter-select">
              <option value="">Catégories de freelances</option>
              <option value="super">Super freelance</option>
              <option value="qualified">Freelance qualifié</option>
            </select>
  </div>

          <div class="preply-filter-advanced preply-search-input">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Saisir nom ou mot-clé" class="preply-filter-input">
          </div>
        </div>
      </form>
    </div>
  </section>

  {{-- Résultats --}}
  <section id="results" class="preply-results-section" style="overflow: visible;">
    <div class="preply-results-container" style="overflow: visible;">
      <div class="preply-results-header">
        <h2 class="preply-results-count">{{ $freelancers->total() ?? 0 }} freelances disponibles</h2>
        <select class="preply-sort-select" onchange="sortTeachers(this.value)">
          <option value="favorites">Trier par : Nos préférés</option>
          <option value="price_asc">Prix croissant</option>
          <option value="price_desc">Prix décroissant</option>
          <option value="rating">Meilleure note</option>
        </select>
      </div>

      <div class="preply-teachers-list" style="overflow: visible;">
        @forelse($freelancers as $freelancer)
          @php
            $user = $freelancer->user;
            // Extraire prénom et première lettre du nom de chaque freelance
            $fullName = trim($user->name ?? '');
            $nameParts = !empty($fullName) ? array_filter(explode(' ', $fullName)) : [];
            
            if (!empty($nameParts) && count($nameParts) > 0) {
              // Le freelance a un nom : utiliser son vrai prénom + première lettre du nom
              $firstName = $nameParts[0];
              $lastName = isset($nameParts[1]) && !empty($nameParts[1]) ? substr($nameParts[1], 0, 1) . '.' : '';
              $displayName = trim($firstName . ' ' . $lastName); // Format: "Prénom N."
            } else {
              // Si pas de nom dans user->name, essayer profile_title ou username comme fallback
              $fallbackName = $freelancer->profile_title ?? ($user->username ?? 'Freelance');
              $fallbackParts = array_filter(explode(' ', trim($fallbackName)));
              if (!empty($fallbackParts) && count($fallbackParts) > 0) {
                $firstName = $fallbackParts[0];
                $lastName = isset($fallbackParts[1]) && !empty($fallbackParts[1]) ? substr($fallbackParts[1], 0, 1) . '.' : '';
                $displayName = trim($firstName . ' ' . $lastName);
              } else {
                $displayName = 'Freelance';
                $firstName = 'Freelance';
              }
            }
            
            $countryCode = strtolower($user->country_code ?? 'fr');
            $flagEmojis = [
              'fr' => '🇫🇷', 'en' => '🇬🇧', 'us' => '🇺🇸', 'es' => '🇪🇸', 
              'de' => '🇩🇪', 'it' => '🇮🇹', 'gb' => '🇬🇧', 'uk' => '🇬🇧'
            ];
            $flag = $flagEmojis[$countryCode] ?? '🌍';
            $countryName = $user->country ?? 'France';
            
            $languages = $freelancer->languages ?? [];
            $langDisplay = [];
            if (is_array($languages) && count($languages) > 0) {
              foreach (array_slice($languages, 0, 2) as $lang) {
                if (is_array($lang)) {
                  $langName = $lang['name'] ?? $lang['code'] ?? 'Langue';
                  $level = $lang['level'] ?? 'Natif';
                  $langDisplay[] = $langName . ' (' . $level . ')';
                } else {
                  $langDisplay[] = $lang;
                }
              }
            }
            $langText = !empty($langDisplay) ? 'Parle : ' . implode(', ', $langDisplay) : 'Parle : Français (Natif)';
            
            $bio = $freelancer->bio ?? 'Freelance expérimenté prêt à vous aider à progresser.';
            $shortBio = \Illuminate\Support\Str::limit(strip_tags($bio), 200, '…');
            
            $hourlyRate = $freelancer->hourly_rate ?? 25;
            $rating = 4.9; // À remplacer par une vraie note si disponible
            $reviewsCount = rand(10, 100);
            $studentsCount = rand(5, 30);
            $coursesCount = rand(500, 5000);
            
            $hasVideo = !empty($freelancer->video_url) || !empty($freelancer->video_thumbnail_url);
            
            // Calculer statut en ligne et dernière connexion
            $lastActivity = $user->updated_at ?? $user->created_at;
            $isOnline = false;
            $lastSeenText = 'Il y a longtemps';
            
            if ($lastActivity) {
              try {
                $now = \Carbon\Carbon::now();
                $minutesAgo = $lastActivity->diffInMinutes($now);
                $isOnline = $minutesAgo < 5; // En ligne si activité dans les 5 dernières minutes
                $lastSeenText = $lastActivity->diffForHumans();
              } catch (\Exception $e) {
                // En cas d'erreur, utiliser des valeurs par défaut
                $isOnline = false;
                $lastSeenText = 'Il y a longtemps';
              }
            }
            
            // Toujours afficher un badge (en ligne ou dernière connexion)
            // Si pas de dernière activité, afficher "Il y a longtemps"
            @endphp

          <div class="preply-teacher-card-wrapper" data-freelancer-id="{{ $freelancer->id }}">
            @php
              $thumbnailUrl = $hasVideo ? ($freelancer->video_thumbnail_url ?? null) : null;
              $videoUrl = $hasVideo ? ($freelancer->video_url ?? null) : null;
            @endphp
            <div class="preply-teacher-card" 
                 data-has-video="{{ $hasVideo ? 'true' : 'false' }}"
                 data-freelancer-id="{{ $freelancer->id }}"
                 @if($hasVideo)
                   data-video-thumbnail="{{ $thumbnailUrl ?? '' }}"
                   data-video-url="{{ $videoUrl ?? '' }}"
                   data-teacher-name="{{ $displayName }}"
                   data-teacher-first-name="{{ $firstName }}"
                   data-teacher-profile-url="{{ route('freelance.show', $freelancer->id) }}"
                 @endif>
              {{-- Colonne A: Photo/Avatar - ESPACE FIXE 120px (jamais de collapse) --}}
              <div class="preply-teacher-photo">
                <div class="preply-teacher-photo-avatar">
                  @if($user->image)
                    <img src="{{ asset('assets/img/users/' . $user->image) }}" alt="{{ $displayName }}">
                  @else
                    <div class="preply-teacher-photo-placeholder">
                      {{ strtoupper(substr($firstName, 0, 1)) }}
                    </div>
                  @endif
                  @if($freelancer->is_verified)
                    <div class="preply-teacher-badge">
                      <i class="fas fa-check"></i>
                    </div>
                  @endif
                  
                  {{-- Badge "En ligne" vert en angle droit OU Badge gris dernière connexion --}}
                  @php
                    // Debug: toujours afficher le badge gris pour test
                    $showOnlineBadge = isset($isOnline) && $isOnline === true;
                    $showLastSeenBadge = !$showOnlineBadge;
                  @endphp
                  
                  @if($showOnlineBadge)
                    <div class="preply-teacher-online-badge" title="En ligne">
                      En ligne
                    </div>
                  @endif
                  
                  @if($showLastSeenBadge)
                    {{-- Badge gris avec tooltip dernière connexion - Petit point --}}
                    <div class="preply-teacher-last-seen-badge" data-last-seen="{{ $lastSeenText ?? 'Il y a longtemps' }}">
                      <div class="preply-teacher-last-seen-tooltip">
                        Dernière connexion {{ $lastSeenText ?? 'Il y a longtemps' }}
                      </div>
                    </div>
                  @endif
                </div>
              </div>

              {{-- Informations - Colonne 2 (flexible) --}}
              <div class="preply-teacher-info">
                <h3 class="preply-teacher-name">
                  <a href="{{ route('freelance.show', $freelancer->id) }}">{{ $displayName }}</a>
                  @if($freelancer->is_verified)
                    <span class="preply-teacher-verified">
                      <i class="fas fa-check-circle"></i>
                    </span>
                  @endif
                </h3>
                {{-- Pas de texte "Dernière connexion" affiché ici --}}
                <div class="preply-teacher-country">{{ $countryName }} {{ $flag }}</div>
                <div class="preply-teacher-subject">
                  @if(!empty($freelancer->skills) && is_array($freelancer->skills))
                    {{ $freelancer->skills[0]['name'] ?? 'Rituel' }}
                  @else
                    Rituel
                  @endif
                </div>
                <div class="preply-teacher-languages">{{ $langText }}</div>
                <div class="preply-teacher-bio">{{ $shortBio }}</div>
                <a href="{{ route('freelance.show', $freelancer->id) }}" class="preply-teacher-learn-more">En savoir plus</a>
                <div class="preply-teacher-popularity">Très populaire. {{ rand(5, 25) }} réservations récentes</div>
              </div>

              {{-- Prix et CTA - Colonne 3 (240px) --}}
              <div class="preply-teacher-pricing">
                <div class="preply-teacher-price">{{ number_format($hourlyRate, 0) }} €</div>
                <div class="preply-teacher-price-label">Rituel de 50 min</div>
                <div class="preply-teacher-rating">
                  <span class="preply-teacher-rating-score">{{ $rating }}</span>
                  <span class="preply-teacher-rating-count">{{ $reviewsCount }} avis</span>
                </div>
                <div class="preply-teacher-stats">
                  {{ $studentsCount }} élèves<br>
                  {{ number_format($coursesCount) }} Rituels
                </div>
                <a href="{{ route('freelance.show', $freelancer->id) }}" class="preply-teacher-btn preply-teacher-btn-primary">
                  Réserver un Rituel d'essai
                </a>
                <a href="#" class="preply-teacher-btn preply-teacher-btn-secondary">
                  Envoyer un message
                </a>
              </div>
            </div>

            {{-- Bouton mobile "Voir la vidéo" (masqué sur desktop) --}}
            @if($hasVideo)
              <a href="#" 
                 class="preply-teacher-card-mobile-video-btn"
                 onclick="event.preventDefault(); openVideoModal({{ $freelancer->id }}); return false;">
                <i class="fas fa-play-circle"></i>
                Voir la vidéo
              </a>
            @endif
          </div>
        @empty
          <div style="text-align: center; padding: 60px 20px;">
            <p style="font-size: 1.125rem; color: var(--preply-text-light);">Aucun freelance trouvé pour le moment.</p>
          </div>
        @endforelse
      </div>

      {{-- Pagination --}}
      @if($freelancers->hasPages())
        <div style="margin-top: 40px; display: flex; justify-content: center;">
          {{ $freelancers->links() }}
        </div>
      @endif
    </div>
  </section>
</div>

<script>
  function toggleDescription() {
    const desc = document.getElementById('introDescription');
    const btn = event.target;
    
    if (desc.classList.contains('collapsed')) {
      desc.classList.remove('collapsed');
      desc.classList.add('expanded');
      btn.textContent = 'Masquer';
    } else {
      desc.classList.remove('expanded');
      desc.classList.add('collapsed');
      btn.textContent = 'Voir plus';
    }
  }

  function openPersonalizeModal() {
    // TODO: Implémenter modal de personnalisation
    alert('Fonctionnalité de personnalisation à venir');
  }

  function sortTeachers(value) {
    // TODO: Implémenter le tri
    console.log('Tri:', value);
  }

  // Gestion de l'interface de disponibilité
  let selectedTimes = [];
  let selectedDays = [];

  function toggleAvailabilityPanel() {
    const panel = document.getElementById('availabilityPanel');
    const trigger = document.querySelector('.preply-availability-trigger');
    
    if (panel.classList.contains('active')) {
      panel.classList.remove('active');
      trigger.classList.remove('active');
    } else {
      panel.classList.add('active');
      trigger.classList.add('active');
    }
  }

  // Initialiser les boutons de temps et jours
  document.addEventListener('DOMContentLoaded', function() {
    // Restaurer les sélections depuis la requête
    @php
      $savedTimes = request('availability_times', []);
      $savedDays = request('availability_days', []);
    @endphp
    selectedTimes = @json($savedTimes);
    selectedDays = @json($savedDays);
    
    const timeButtons = document.querySelectorAll('.availability-time-btn');
    const dayButtons = document.querySelectorAll('.availability-day-btn');
    
    // Restaurer les sélections visuelles
    timeButtons.forEach(function(btn) {
      const time = btn.getAttribute('data-time');
      if (selectedTimes.includes(time)) {
        btn.classList.add('selected');
      }
    });
    
    dayButtons.forEach(function(btn) {
      const day = btn.getAttribute('data-day');
      if (selectedDays.includes(day)) {
        btn.classList.add('selected');
      }
    });
    
    updateAvailabilityText();
    
    // Gestion des sélections de temps
    timeButtons.forEach(function(btn) {
      btn.addEventListener('click', function() {
        const time = this.getAttribute('data-time');
        if (this.classList.contains('selected')) {
          this.classList.remove('selected');
          selectedTimes = selectedTimes.filter(t => t !== time);
        } else {
          this.classList.add('selected');
          selectedTimes.push(time);
        }
        updateAvailabilityText();
      });
    });
    
    // Gestion des sélections de jours
    dayButtons.forEach(function(btn) {
      btn.addEventListener('click', function() {
        const day = this.getAttribute('data-day');
        if (this.classList.contains('selected')) {
          this.classList.remove('selected');
          selectedDays = selectedDays.filter(d => d !== day);
        } else {
          this.classList.add('selected');
          selectedDays.push(day);
        }
        updateAvailabilityText();
      });
    });
    
    // Fermer le panneau en cliquant en dehors
    document.addEventListener('click', function(e) {
      const panel = document.getElementById('availabilityPanel');
      const trigger = document.querySelector('.preply-availability-trigger');
      if (panel && trigger && !panel.contains(e.target) && !trigger.contains(e.target)) {
        panel.classList.remove('active');
        trigger.classList.remove('active');
      }
    });
  });

  function updateAvailabilityText() {
    const textElement = document.querySelector('.availability-selected-text');
    if (!textElement) return;
    
    if (selectedTimes.length === 0 && selectedDays.length === 0) {
      textElement.textContent = 'Toutes les heures';
    } else {
      const parts = [];
      if (selectedTimes.length > 0) {
        parts.push(selectedTimes.length + ' créneau' + (selectedTimes.length > 1 ? 'x' : ''));
      }
      if (selectedDays.length > 0) {
        parts.push(selectedDays.length + ' jour' + (selectedDays.length > 1 ? 's' : ''));
      }
      textElement.textContent = parts.join(' • ') || 'Toutes les heures';
    }
  }

  function clearAvailabilitySelection() {
    selectedTimes = [];
    selectedDays = [];
    
    document.querySelectorAll('.availability-time-btn.selected').forEach(function(btn) {
      btn.classList.remove('selected');
    });
    
    document.querySelectorAll('.availability-day-btn.selected').forEach(function(btn) {
      btn.classList.remove('selected');
    });
    
    updateAvailabilityText();
  }

  function applyAvailabilityFilter() {
    const form = document.querySelector('.preply-filters-section form');
    if (!form) return;
    
    // Créer des champs cachés pour les disponibilités sélectionnées
    // Supprimer les anciens champs
    document.querySelectorAll('input[name="availability_times[]"], input[name="availability_days[]"]').forEach(function(input) {
      input.remove();
    });
    
    // Ajouter les nouveaux champs
    selectedTimes.forEach(function(time) {
      const input = document.createElement('input');
      input.type = 'hidden';
      input.name = 'availability_times[]';
      input.value = time;
      form.appendChild(input);
    });
    
    selectedDays.forEach(function(day) {
      const input = document.createElement('input');
      input.type = 'hidden';
      input.name = 'availability_days[]';
      input.value = day;
      form.appendChild(input);
    });
    
    // Fermer le panneau
    toggleAvailabilityPanel();
    
    // Soumettre le formulaire
    form.submit();
  }

  // Auto-submit form on filter change
  document.querySelectorAll('.preply-filter-select, .preply-filter-input').forEach(el => {
    el.addEventListener('change', function() {
      document.getElementById('preplyFiltersForm').submit();
    });
  });

  // ============================================
  // POPOVER VIDÉO PREPLY - Reset + Fix Total
  // Portal + Positionnement Intelligent + Flèche Toggle
  // ============================================

  (function() {
    'use strict';
    
    // Constantes
    const POPOVER_WIDTH = 320;
    const GAP = 16; // Gap entre carte et popover
    const VIEWPORT_PADDING = 8; // Padding viewport pour clamp
    const OPEN_DELAY = 100; // Délai ouverture: 80-120ms
    const CLOSE_DELAY = 250; // Délai fermeture: 200-300ms (anti-flicker)
    
    // État global
    let currentCard = null;
    let currentCardId = null;
    let openTimeout = null;
    let closeTimeout = null;
    let popover = null;
    let forcedSide = null; // 'left' | 'right' | null (auto)
    let isArrowClicking = false; // Flag pour empêcher fermeture lors du clic sur flèche
    
    // Créer le portal popover au niveau body
    function createPopoverPortal() {
      if (document.getElementById('preply-video-popover')) {
        popover = document.getElementById('preply-video-popover');
        return;
      }
      
      popover = document.createElement('div');
      popover.id = 'preply-video-popover';
      popover.innerHTML = `
        <button class="preply-popover-arrow arrow-left" id="popover-arrow-left" aria-label="Afficher à gauche" title="Afficher à gauche">
          <i class="fas fa-chevron-left"></i>
        </button>
        <button class="preply-popover-arrow arrow-right" id="popover-arrow-right" aria-label="Afficher à droite" title="Afficher à droite">
          <i class="fas fa-chevron-right"></i>
        </button>
        <div class="preply-popover-video-thumbnail">
          <img id="popover-thumbnail" src="" alt="Vidéo de présentation" loading="lazy" style="display: none;">
          <div id="popover-placeholder" style="width: 100%; height: 100%; background: linear-gradient(135deg, #2563EB 0%, #06B6D4 50%, #22D3EE 100%); display: flex; align-items: center; justify-content: center; color: white;">
            <i class="fas fa-video" style="font-size: 2.5rem; opacity: 0.8;"></i>
          </div>
          <button class="preply-popover-play-btn" id="popover-play-btn" aria-label="Lire la vidéo">
            <i class="fas fa-play"></i>
          </button>
        </div>
        <div class="preply-popover-actions">
          <a href="#" class="preply-popover-action-btn" id="popover-agenda-btn">Voir tout l'agenda</a>
          <a href="#" class="preply-popover-action-btn" id="popover-profile-btn">Voir le profil</a>
        </div>
      `;
      document.body.appendChild(popover);
      
      // Event listeners sur la popover (pour hover stable)
      popover.addEventListener('mouseenter', cancelClose);
      popover.addEventListener('mouseleave', function() {
        // Ne pas fermer si on vient de cliquer sur une flèche
        if (!isArrowClicking) {
          scheduleClose();
        }
      });
      
      // Flèches pour forcer le côté
      popover.querySelector('#popover-arrow-left').addEventListener('click', function(e) {
        e.stopPropagation();
        e.preventDefault();
        isArrowClicking = true; // Empêcher fermeture
        cancelClose(); // Annuler toute fermeture en cours
        forcedSide = 'left';
        if (currentCard) {
          updatePopoverPosition(currentCard);
        }
        // Réinitialiser le flag après un court délai
        setTimeout(function() {
          isArrowClicking = false;
        }, 300);
      });
      
      popover.querySelector('#popover-arrow-right').addEventListener('click', function(e) {
        e.stopPropagation();
        e.preventDefault();
        isArrowClicking = true; // Empêcher fermeture
        cancelClose(); // Annuler toute fermeture en cours
        forcedSide = 'right';
        if (currentCard) {
          updatePopoverPosition(currentCard);
        }
        // Réinitialiser le flag après un court délai
        setTimeout(function() {
          isArrowClicking = false;
        }, 300);
      });
    }
    
    // Calculer position intelligente avec gap garanti + flèche toggle
    function calculatePosition(cardRect) {
      const viewportWidth = window.innerWidth;
      const viewportHeight = window.innerHeight;
      const popoverHeight = popover.offsetHeight || 280;
      
      // Si côté forcé manuellement, l'utiliser
      let side = forcedSide;
      
      if (!side) {
        // Auto-détection
        const spaceRight = viewportWidth - cardRect.right - GAP;
        const spaceLeft = cardRect.left - GAP;
        
        if (spaceRight >= POPOVER_WIDTH) {
          side = 'right';
        } else if (spaceLeft >= POPOVER_WIDTH) {
          side = 'left';
        } else {
          // Choisir le meilleur côté
          side = spaceRight > spaceLeft ? 'right' : 'left';
        }
      }
      
      let left = 0;
      let top = 0;
      
      // Calculer position selon le côté
      if (side === 'right') {
        left = cardRect.right + GAP;
        // Clamp si dépasse viewport
        if (left + POPOVER_WIDTH > viewportWidth - VIEWPORT_PADDING) {
          left = Math.max(VIEWPORT_PADDING, viewportWidth - POPOVER_WIDTH - VIEWPORT_PADDING);
        }
      } else {
        left = cardRect.left - POPOVER_WIDTH - GAP;
        // Clamp si dépasse viewport
        if (left < VIEWPORT_PADDING) {
          left = VIEWPORT_PADDING;
        }
      }
      
      // Position verticale: aligner avec le haut de la carte (même hauteur)
      // Calculer la hauteur de la carte
      const cardHeight = cardRect.height;
      
      // Aligner le haut de la popover avec le haut de la carte
      // Cela garantit que la carte vidéo commence à la même hauteur que la carte freelance
      top = Math.max(
        VIEWPORT_PADDING,
        Math.min(
          cardRect.top, // Alignement exact avec le haut de la carte
          viewportHeight - popoverHeight - VIEWPORT_PADDING
        )
      );
      
      return { left, top, side };
    }
    
    // Mettre à jour la position de la popover
    function updatePopoverPosition(card) {
      if (!card || !popover) return;
      const cardRect = card.getBoundingClientRect();
      const position = calculatePosition(cardRect);
      
      popover.style.left = position.left + 'px';
      popover.style.top = position.top + 'px';
      
      // Afficher/masquer les flèches selon le côté
      const arrowLeft = popover.querySelector('#popover-arrow-left');
      const arrowRight = popover.querySelector('#popover-arrow-right');
      
      if (position.side === 'right') {
        arrowLeft.style.display = 'flex';
        arrowRight.style.display = 'none';
      } else {
        arrowLeft.style.display = 'none';
        arrowRight.style.display = 'flex';
      }
    }
    
    // Ouvrir popover (avec délai)
    function scheduleOpen(card) {
      if (!card) return;
      
      // Vérifier que la carte a bien une vidéo
      const hasVideo = card.getAttribute('data-has-video') === 'true';
      if (!hasVideo) return;
      
      // Annuler toute fermeture en cours
      cancelClose();
      
      // Vérifier si c'est une nouvelle carte
      const cardId = card.getAttribute('data-freelancer-id');
      if (cardId === currentCardId && popover && popover.classList.contains('is-visible')) {
        // C'est la même carte déjà affichée, ne rien faire
        return;
      }
      
      // Annuler ouverture précédente si elle existe
      if (openTimeout) {
        clearTimeout(openTimeout);
        openTimeout = null;
      }
      
      // Programmer l'ouverture
      openTimeout = setTimeout(function() {
        if (card && card.getAttribute('data-has-video') === 'true') {
          openPopover(card);
        }
        openTimeout = null;
      }, OPEN_DELAY);
    }
    
    // Ouvrir popover immédiatement
    function openPopover(card) {
      // Annuler fermeture en cours
      cancelClose();
      
      // Récupérer les données
      const hasVideo = card.getAttribute('data-has-video') === 'true';
      if (!hasVideo) return;
      
      const cardId = card.getAttribute('data-freelancer-id');
      const thumbnail = card.getAttribute('data-video-thumbnail') || '';
      const videoUrl = card.getAttribute('data-video-url') || '';
      const teacherName = card.getAttribute('data-teacher-name') || '';
      const firstName = card.getAttribute('data-teacher-first-name') || '';
      const profileUrl = card.getAttribute('data-teacher-profile-url') || '#';
      
      // Réinitialiser le côté forcé si nouvelle carte
      if (cardId !== currentCardId) {
        forcedSide = null;
      }
      
      // Mettre à jour le contenu
      const thumbnailImg = popover.querySelector('#popover-thumbnail');
      const placeholder = popover.querySelector('#popover-placeholder');
      
      if (thumbnail) {
        thumbnailImg.src = thumbnail;
        thumbnailImg.style.display = 'block';
        placeholder.style.display = 'none';
      } else {
        thumbnailImg.style.display = 'none';
        placeholder.style.display = 'flex';
      }
      
      // Mettre à jour les liens
      popover.querySelector('#popover-profile-btn').href = profileUrl;
      popover.querySelector('#popover-profile-btn').textContent = `Voir le profil de ${firstName}`;
      
      // Bouton play
      const playBtn = popover.querySelector('#popover-play-btn');
      playBtn.onclick = function() {
        if (videoUrl && videoUrl !== '#') {
          window.open(videoUrl, '_blank');
        }
      };
      
      // Afficher d'abord pour calculer la hauteur réelle
      popover.classList.add('is-visible');
      
      // Calculer et appliquer position après affichage (pour avoir la vraie hauteur)
      // Petit délai pour que le navigateur calcule la hauteur réelle
      setTimeout(function() {
        updatePopoverPosition(card);
      }, 10);
      
      // Recalculer aussi immédiatement
      updatePopoverPosition(card);
      
      currentCard = card;
      currentCardId = cardId;
    }
    
    // Fermer popover
    function closePopover() {
      if (popover) {
        popover.classList.remove('is-visible');
      }
      currentCard = null;
      currentCardId = null;
      forcedSide = null; // Réinitialiser le côté forcé
    }
    
    // Programmer fermeture (avec délai anti-flicker: 200-300ms)
    function scheduleClose() {
      if (openTimeout) {
        clearTimeout(openTimeout);
        openTimeout = null;
      }
      closeTimeout = setTimeout(closePopover, CLOSE_DELAY);
    }
    
    // Annuler fermeture
    function cancelClose() {
      if (closeTimeout) {
        clearTimeout(closeTimeout);
        closeTimeout = null;
      }
      if (openTimeout) {
        clearTimeout(openTimeout);
        openTimeout = null;
      }
    }
    
      // Event delegation sur les cartes
      function init() {
        createPopoverPortal();
        
      // Event delegation sur le conteneur - CORRIGÉ pour fonctionner sur TOUS les profils
      const teachersList = document.querySelector('.preply-teachers-list');
      if (!teachersList) return;
      
      // Fonction pour initialiser les listeners sur une carte
      function initCardListeners(card) {
        if (!card || card.getAttribute('data-has-video') !== 'true') return;
        
        // Ne pas ajouter plusieurs fois les mêmes listeners
        if (card.hasAttribute('data-listeners-initialized')) return;
        card.setAttribute('data-listeners-initialized', 'true');
        
        // Mouseenter sur la carte elle-même
        card.addEventListener('mouseenter', function() {
          scheduleOpen(card);
        }, { passive: true });
        
        // Mouseenter sur le wrapper parent
        const wrapper = card.closest('.preply-teacher-card-wrapper');
        if (wrapper && !wrapper.hasAttribute('data-listeners-initialized')) {
          wrapper.setAttribute('data-listeners-initialized', 'true');
          wrapper.addEventListener('mouseenter', function() {
            scheduleOpen(card);
          }, { passive: true });
        }
      }
      
      // Initialiser les listeners sur toutes les cartes existantes
      const allCards = teachersList.querySelectorAll('.preply-teacher-card[data-has-video="true"]');
      allCards.forEach(function(card) {
        initCardListeners(card);
      });
      
      // Observer pour les nouvelles cartes ajoutées dynamiquement
      const observer = new MutationObserver(function(mutations) {
        mutations.forEach(function(mutation) {
          mutation.addedNodes.forEach(function(node) {
            if (node.nodeType === 1) { // Element node
              const newCards = node.querySelectorAll ? node.querySelectorAll('.preply-teacher-card[data-has-video="true"]') : [];
              newCards.forEach(function(card) {
                initCardListeners(card);
              });
              // Vérifier aussi si le node lui-même est une carte
              if (node.classList && node.classList.contains('preply-teacher-card') && node.getAttribute('data-has-video') === 'true') {
                initCardListeners(node);
              }
            }
          });
        });
      });
      
      observer.observe(teachersList, { childList: true, subtree: true });
      
      // Délégation d'événements principale - CORRIGÉ pour fonctionner sur TOUS les profils
      teachersList.addEventListener('mouseenter', function(e) {
        // Ignorer si on survole la popover elle-même
        if (e.target.closest('#preply-video-popover')) return;
        
        // Chercher directement la carte avec vidéo
        const card = e.target.closest('.preply-teacher-card[data-has-video="true"]');
        
        // Si on survole directement la carte, l'ouvrir
        if (card) {
          scheduleOpen(card);
          return;
        }
        
        // Sinon, chercher le wrapper et la carte à l'intérieur
        const wrapper = e.target.closest('.preply-teacher-card-wrapper');
        if (wrapper) {
          const cardInWrapper = wrapper.querySelector('.preply-teacher-card[data-has-video="true"]');
          if (cardInWrapper) {
            scheduleOpen(cardInWrapper);
          }
        }
      }, true);
      
      // Mouseover supplémentaire pour capturer tous les mouvements
      teachersList.addEventListener('mouseover', function(e) {
        // Ignorer si on survole la popover elle-même
        if (e.target.closest('#preply-video-popover')) return;
        
        // Chercher directement la carte avec vidéo
        const card = e.target.closest('.preply-teacher-card[data-has-video="true"]');
        
        // Si on survole directement la carte, l'ouvrir
        if (card) {
          const cardId = card.getAttribute('data-freelancer-id');
          if (cardId !== currentCardId) {
            scheduleOpen(card);
          }
          return;
        }
        
        // Sinon, chercher le wrapper et la carte à l'intérieur
        const wrapper = e.target.closest('.preply-teacher-card-wrapper');
        if (wrapper) {
          const cardInWrapper = wrapper.querySelector('.preply-teacher-card[data-has-video="true"]');
          if (cardInWrapper) {
            const cardId = cardInWrapper.getAttribute('data-freelancer-id');
            if (cardId !== currentCardId) {
              scheduleOpen(cardInWrapper);
            }
          }
        }
      }, true);
      
      // Mouseout: programmer fermeture (si on quitte le wrapper ou la carte)
      teachersList.addEventListener('mouseout', function(e) {
        const wrapper = e.target.closest('.preply-teacher-card-wrapper');
        const card = wrapper ? wrapper.querySelector('.preply-teacher-card[data-has-video="true"]') : null;
        const popoverEl = e.relatedTarget && e.relatedTarget.closest('#preply-video-popover');
        const stillInWrapper = wrapper && wrapper.contains(e.relatedTarget);
        
        // Si on quitte complètement le wrapper ET qu'on ne va pas vers la popover
        if (card && card === currentCard && !stillInWrapper && !popoverEl) {
          scheduleClose();
        }
      }, true);
      
      // Fermer avec ESC
      document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && popover && popover.classList.contains('is-visible')) {
          closePopover();
        }
      });
      
      // Recalculer position au scroll/resize
      let resizeTimeout;
      window.addEventListener('resize', function() {
        clearTimeout(resizeTimeout);
        resizeTimeout = setTimeout(function() {
          if (currentCard && popover.classList.contains('is-visible')) {
            updatePopoverPosition(currentCard);
          }
        }, 100);
      });
      
      window.addEventListener('scroll', function() {
        if (currentCard && popover.classList.contains('is-visible')) {
          updatePopoverPosition(currentCard);
        }
      }, true);
    }
    
    // Initialiser au chargement
    if (document.readyState === 'loading') {
      document.addEventListener('DOMContentLoaded', init);
    } else {
      init();
    }
  })();

  // Fonction pour ouvrir la vidéo en modal sur mobile
  function openVideoModal(freelancerId) {
    // TODO: Implémenter modal vidéo mobile
    alert('Modal vidéo mobile à implémenter pour le freelance #' + freelancerId);
  }
</script>
@endsection
