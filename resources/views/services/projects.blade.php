@extends('frontend.layout')

@section('pageHeading')
  Projets | {{ $websiteInfo->website_title }}
@endsection

@section('metaDescription')
  De "j'ai une idée" à "c'est livré". Brief clair, exécution rapide, livrables propres. Vous gardez le cap, on avance.
@endsection

@section('style')
<link rel="stylesheet" href="{{ asset('assets/front/css/services-pages.css') }}">
<style>
  /* ============================================
     PAGE PREPLY STYLE - ADAPTÉE JUNSPRO
     ============================================ */
  
  /* Variables couleurs Projects - Dégradé violet bleu royal */
  .page-projects {
    --preply-primary: #8B5CF6;
    --preply-primary-rgb: 139, 92, 246;
    --preply-primary-dark: #7C3AED;
    --preply-primary-light: #2563EB;
    --preply-pink: #A78BFA;
    --preply-pink-light: #3B82F6;
    --preply-text: #1F2937;
    --preply-text-light: #6B7280;
    --preply-bg: #FFFFFF;
    --preply-border: #E5E7EB;
    --preply-hover: #F9FAFB;
  }

  /* Hero Projects - Dégradé violet bleu royal */
  .services-hero {
    background: linear-gradient(
      135deg,
      #EDE9FE 0%,
      #DDD6FE 20%,
      #C4B5FD 40%,
      #A78BFA 60%,
      #8B5CF6 80%,
      #2563EB 100%
    ) !important;
    box-shadow: 
      0 20px 60px rgba(139, 92, 246, 0.25),
      0 0 0 1px rgba(255, 255, 255, 0.1) inset;
  }

  .services-hero__placeholder {
    background: linear-gradient(
      135deg,
      #EDE9FE 0%,
      #DDD6FE 20%,
      #C4B5FD 40%,
      #A78BFA 60%,
      #8B5CF6 80%,
      #2563EB 100%
    ) !important;
  }

  .services-hero__placeholder::after {
    background: linear-gradient(
      135deg,
      rgba(255, 255, 255, 0.1) 0%,
      transparent 50%,
      rgba(139, 92, 246, 0.1) 100%
    );
  }

  /* Boutons hero Projects - Adaptation violet */
  .services-hero__btn--primary {
    color: #8B5CF6 !important;
  }

  .services-hero__btn--primary:hover {
    color: #7C3AED !important;
  }

  .services-hero__btn--secondary {
    border-color: rgba(255, 255, 255, 0.5) !important;
  }

  .services-hero__btn--secondary:hover {
    border-color: rgba(255, 255, 255, 0.7) !important;
    background: rgba(255, 255, 255, 0.3) !important;
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

  /* Filtres du bas : icône + gras (comme ceux du haut) */
  .preply-filter-label-icon {
    font-weight: 600;
    display: flex;
    align-items: center;
    color: #374151;
  }

  .preply-filter-select,
  .preply-filter-input {
    width: 100%;
    padding: 10px 12px;
    border: 1px solid var(--preply-border);
    border-radius: 8px;
    font-size: 0.9375rem;
    background: rgba(255, 255, 255, 0.98);
    color: var(--preply-text);
    cursor: pointer;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    box-shadow: 0 2px 8px rgba(15, 23, 42, 0.08);
  }

  .preply-filter-select:hover,
  .preply-filter-input:hover {
    box-shadow: 0 4px 12px rgba(15, 23, 42, 0.12);
    border-color: rgba(139, 92, 246, 0.3);
    transform: translateY(-1px);
  }

  .preply-filter-select:focus,
  .preply-filter-input:focus {
    outline: none;
    border-color: var(--preply-primary);
    box-shadow: 0 4px 12px rgba(139, 92, 246, 0.2);
  }

  /* Dropdown Domaines avec flèches */
  .domain-dropdown-wrapper {
    position: relative;
  }

  .domain-dropdown-trigger {
    width: 100%;
    padding: 10px 12px;
    border: 1px solid var(--preply-border);
    border-radius: 8px;
    font-size: 0.9375rem;
    background: rgba(255, 255, 255, 0.98);
    color: var(--preply-text);
    cursor: pointer;
    display: flex;
    justify-content: space-between;
    align-items: center;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    box-shadow: 0 2px 8px rgba(15, 23, 42, 0.08);
  }

  .domain-dropdown-trigger:hover {
    border-color: rgba(139, 92, 246, 0.3);
    box-shadow: 0 4px 12px rgba(15, 23, 42, 0.12);
    transform: translateY(-1px);
  }

  .domain-dropdown-trigger.active {
    border-color: var(--preply-primary);
    box-shadow: 0 4px 12px rgba(139, 92, 246, 0.2);
  }

  .domain-selected-text {
    flex: 1;
  }

  .domain-arrow {
    font-size: 0.75rem;
    color: var(--preply-text-light);
    transition: transform 0.2s;
    transform: rotate(0deg);
  }

  .domain-dropdown-trigger.active .domain-arrow {
    transform: rotate(180deg);
  }

  .domain-dropdown-menu {
    position: absolute;
    bottom: calc(100% + 8px);
    left: 0;
    right: 0;
    background: var(--preply-bg);
    border: 1px solid var(--preply-border);
    border-radius: 12px;
    box-shadow: 0 8px 24px rgba(0, 0, 0, 0.12);
    z-index: 1000;
    max-height: 400px;
    overflow-y: auto;
  }

  .domain-option {
    padding: 10px 16px;
    cursor: pointer;
    transition: background-color 0.2s;
    color: var(--preply-text);
    font-size: 0.9375rem;
  }

  .domain-option:hover {
    background-color: var(--preply-hover);
  }

  .domain-option.selected {
    background-color: rgba(139, 92, 246, 0.1);
    color: var(--preply-primary);
    font-weight: 500;
  }

  .domain-option .domain-option-label {
    display: block;
    font-weight: 500;
  }

  .domain-option .domain-option-desc {
    display: block;
    font-size: 0.8125rem;
    color: var(--preply-text-light);
    font-weight: 400;
    margin-top: 2px;
  }

  /* Micro-description premium sous le filtre Domaine (affichée lorsqu'un domaine est sélectionné) */
  .domain-premium-desc {
    margin-top: 8px;
    padding: 10px 12px;
    background: rgba(249, 250, 251, 0.95);
    border: 1px solid rgba(229, 231, 235, 0.8);
    border-radius: 8px;
    font-size: 0.8125rem;
    line-height: 1.45;
    color: var(--preply-text-light);
    transition: opacity 0.2s ease;
  }
  .domain-premium-desc-icon {
    color: rgba(139, 92, 246, 0.6);
    margin-right: 6px;
    font-size: 0.7rem;
  }
  .domain-premium-desc #domainPremiumDescText {
    vertical-align: baseline;
  }
  @media (max-width: 768px) {
    .domain-premium-desc { font-size: 0.8125rem; padding: 8px 10px; margin-top: 6px; }
  }

  .domain-option-group {
    border-bottom: 1px solid var(--preply-border);
  }

  .domain-option-group:last-child {
    border-bottom: none;
  }

  /* Dropdown Mon expérience — ouvert vers le haut */
  .experience-dropdown-wrapper {
    position: relative;
  }

  .experience-dropdown-trigger {
    width: 100%;
    padding: 10px 12px;
    border: 1px solid var(--preply-border);
    border-radius: 8px;
    font-size: 0.9375rem;
    background: rgba(255, 255, 255, 0.98);
    color: var(--preply-text);
    cursor: pointer;
    display: flex;
    justify-content: space-between;
    align-items: center;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    box-shadow: 0 2px 8px rgba(15, 23, 42, 0.08);
  }

  .experience-dropdown-trigger:hover {
    border-color: rgba(139, 92, 246, 0.3);
    box-shadow: 0 4px 12px rgba(15, 23, 42, 0.12);
    transform: translateY(-1px);
  }

  .experience-dropdown-trigger.active {
    border-color: var(--preply-primary);
    box-shadow: 0 4px 12px rgba(139, 92, 246, 0.2);
  }

  .experience-selected-text {
    flex: 1;
  }

  .experience-arrow {
    font-size: 0.75rem;
    color: var(--preply-text-light);
    transition: transform 0.2s;
  }

  .experience-dropdown-trigger.active .experience-arrow {
    transform: rotate(180deg);
  }

  .experience-dropdown-menu {
    position: absolute;
    bottom: calc(100% + 8px);
    left: 0;
    right: 0;
    background: var(--preply-bg);
    border: 1px solid var(--preply-border);
    border-radius: 12px;
    box-shadow: 0 8px 24px rgba(0, 0, 0, 0.12);
    z-index: 1000;
    max-height: 280px;
    overflow-y: auto;
  }

  .experience-option {
    padding: 10px 16px;
    cursor: pointer;
    transition: background-color 0.2s;
    color: var(--preply-text);
    font-size: 0.9375rem;
  }

  .experience-option:hover {
    background-color: var(--preply-hover);
  }

  .experience-option.selected {
    background-color: rgba(139, 92, 246, 0.1);
    color: var(--preply-primary);
    font-weight: 500;
  }

  /* Dropdown Premium Pays de naissance */
  .country-dropdown-wrapper {
    position: relative;
  }

  .country-dropdown-trigger {
    width: 100%;
    padding: 10px 12px;
    border: 1px solid var(--preply-border);
    border-radius: 8px;
    font-size: 0.9375rem;
    background: rgba(255, 255, 255, 0.98);
    color: var(--preply-text);
    cursor: pointer;
    display: flex;
    justify-content: space-between;
    align-items: center;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    box-shadow: 0 2px 8px rgba(15, 23, 42, 0.08);
  }

  .country-dropdown-trigger:hover {
    border-color: rgba(139, 92, 246, 0.3);
    box-shadow: 0 4px 12px rgba(15, 23, 42, 0.12);
    transform: translateY(-1px);
  }

  .country-dropdown-trigger.active {
    border-color: var(--preply-primary);
    box-shadow: 0 4px 12px rgba(139, 92, 246, 0.2);
  }

  .country-selected-text {
    flex: 1;
  }

  .country-arrow {
    font-size: 0.75rem;
    color: var(--preply-text-light);
    transition: transform 0.2s;
    transform: rotate(0deg);
  }

  .country-dropdown-trigger.active .country-arrow {
    transform: rotate(180deg);
  }

  .country-dropdown-menu {
    position: absolute;
    bottom: calc(100% + 8px);
    left: 0;
    right: 0;
    background: var(--preply-bg);
    border: 1px solid var(--preply-border);
    border-radius: 12px;
    box-shadow: 0 8px 24px rgba(0, 0, 0, 0.12);
    z-index: 1001;
    max-height: 400px;
    overflow-y: auto;
    padding: 8px;
  }

  .country-search-wrapper {
    position: relative;
    margin-bottom: 12px;
  }

  .country-search-icon {
    position: absolute;
    left: 12px;
    top: 50%;
    transform: translateY(-50%);
    color: var(--preply-text-light);
    font-size: 0.875rem;
    pointer-events: none;
  }

  .country-search-input {
    width: 100%;
    padding: 10px 12px 10px 36px;
    border: 1px solid var(--preply-border);
    border-radius: 8px;
    font-size: 0.875rem;
    background: rgba(255, 255, 255, 0.98);
    color: var(--preply-text);
    outline: none;
    transition: all 0.2s;
  }

  .country-search-input:focus {
    border-color: var(--preply-primary);
    box-shadow: 0 0 0 3px rgba(139, 92, 246, 0.1);
  }

  .country-popular-header {
    font-weight: 600;
    font-size: 0.875rem;
    color: var(--preply-text);
    margin-bottom: 8px;
    padding: 0 4px;
  }

  .country-list {
    display: flex;
    flex-direction: column;
    gap: 2px;
  }

  .country-option {
    display: flex;
    align-items: center;
    padding: 10px 12px;
    cursor: pointer;
    border-radius: 8px;
    transition: background-color 0.2s;
    gap: 12px;
  }

  .country-option:hover {
    background-color: var(--preply-hover);
  }

  .country-option.selected {
    background-color: rgba(139, 92, 246, 0.1);
  }

  .country-flag {
    width: 24px;
    height: 24px;
    border-radius: 4px;
    flex-shrink: 0;
    object-fit: cover;
    font-size: 20px;
    display: flex;
    align-items: center;
    justify-content: center;
  }

  .country-name {
    flex: 1;
    font-size: 0.875rem;
    color: var(--preply-text);
  }

  .country-option.selected .country-name {
    color: var(--preply-primary);
    font-weight: 500;
  }

  .country-checkbox {
    width: 18px;
    height: 18px;
    border: 2px solid var(--preply-border);
    border-radius: 4px;
    flex-shrink: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.2s;
  }

  .country-option.selected .country-checkbox {
    background-color: var(--preply-primary);
    border-color: var(--preply-primary);
  }

  .country-option.selected .country-checkbox::after {
    content: '✓';
    color: white;
    font-size: 12px;
    font-weight: bold;
  }

  .country-no-results {
    padding: 16px;
    text-align: center;
    color: var(--preply-text-light);
    font-size: 0.875rem;
  }

  .country-all-section {
    margin-top: 12px;
    padding-top: 12px;
    border-top: 1px solid var(--preply-border);
  }

  /* Dropdown Premium Secteur/Industrie (réutilise le style pays) */
  .sector-dropdown-wrapper {
    position: relative;
  }

  /* Filtre Secteur/Industrie : +2 cm (76px) sur /services/projects */
  .page-projects .sector-filter-container {
    min-width: 320px;
  }
  .sector-filter-container {
    min-width: 200px;
  }

  .sector-dropdown-trigger {
    width: 100%;
    padding: 10px 12px;
    border: 1px solid var(--preply-border);
    border-radius: 8px;
    font-size: 0.9375rem;
    background: rgba(255, 255, 255, 0.98);
    color: var(--preply-text);
    cursor: pointer;
    display: flex;
    justify-content: space-between;
    align-items: center;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    box-shadow: 0 2px 8px rgba(15, 23, 42, 0.08);
  }

  .sector-dropdown-trigger:hover {
    border-color: rgba(139, 92, 246, 0.3);
    box-shadow: 0 4px 12px rgba(15, 23, 42, 0.12);
    transform: translateY(-1px);
  }

  .sector-dropdown-trigger.active {
    border-color: var(--preply-primary);
    box-shadow: 0 4px 12px rgba(139, 92, 246, 0.2);
  }

  .sector-selected-text {
    flex: 1;
  }

  .sector-arrow {
    font-size: 0.75rem;
    color: var(--preply-text-light);
    transition: transform 0.2s;
    transform: rotate(0deg);
  }

  .sector-dropdown-trigger.active .sector-arrow {
    transform: rotate(180deg);
  }

  .sector-dropdown-menu {
    position: absolute;
    bottom: calc(100% + 8px);
    left: 0;
    right: 0;
    background: var(--preply-bg);
    border: 1px solid var(--preply-border);
    border-radius: 12px;
    box-shadow: 0 8px 24px rgba(0, 0, 0, 0.12);
    z-index: 1001;
    max-height: 400px;
    overflow-y: auto;
    padding: 8px;
  }

  .sector-search-wrapper {
    position: relative;
    margin-bottom: 12px;
  }

  .sector-search-icon {
    position: absolute;
    left: 12px;
    top: 50%;
    transform: translateY(-50%);
    color: var(--preply-text-light);
    font-size: 0.875rem;
    pointer-events: none;
  }

  .sector-search-input {
    width: 100%;
    padding: 10px 12px 10px 36px;
    border: 1px solid var(--preply-border);
    border-radius: 8px;
    font-size: 0.875rem;
    background: rgba(255, 255, 255, 0.98);
    color: var(--preply-text);
    outline: none;
    transition: all 0.2s;
  }

  .sector-search-input:focus {
    border-color: var(--preply-primary);
    box-shadow: 0 0 0 3px rgba(139, 92, 246, 0.1);
  }

  .sector-popular-header {
    font-weight: 600;
    font-size: 0.875rem;
    color: var(--preply-text);
    margin-bottom: 8px;
    padding: 0 4px;
  }

  .sector-list {
    display: flex;
    flex-direction: column;
    gap: 2px;
  }

  .sector-option {
    display: flex;
    align-items: center;
    padding: 10px 12px;
    cursor: pointer;
    border-radius: 8px;
    transition: background-color 0.2s;
    gap: 12px;
  }

  .sector-option:hover {
    background-color: var(--preply-hover);
  }

  .sector-option.selected {
    background-color: rgba(139, 92, 246, 0.1);
  }

  .sector-name {
    flex: 1;
    font-size: 0.875rem;
    color: var(--preply-text);
  }

  .sector-option.selected .sector-name {
    color: var(--preply-primary);
    font-weight: 500;
  }

  .sector-checkbox {
    width: 18px;
    height: 18px;
    border: 2px solid var(--preply-border);
    border-radius: 4px;
    flex-shrink: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.2s;
  }

  .sector-option.selected .sector-checkbox {
    background-color: var(--preply-primary);
    border-color: var(--preply-primary);
  }

  .sector-option.selected .sector-checkbox::after {
    content: '✓';
    color: white;
    font-size: 12px;
    font-weight: bold;
  }

  .sector-no-results {
    padding: 16px;
    text-align: center;
    color: var(--preply-text-light);
    font-size: 0.875rem;
  }

  .sector-all-section {
    margin-top: 12px;
    padding-top: 12px;
    border-top: 1px solid var(--preply-border);
  }

  .sector-group {
    margin-bottom: 12px;
  }
  .sector-group:last-child {
    margin-bottom: 0;
  }
  .sector-group-header {
    font-size: 0.75rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.04em;
    color: var(--preply-text-light);
    padding: 8px 12px 4px;
    margin-bottom: 2px;
  }
  .sector-reset-option {
    margin-top: 12px;
    padding: 10px 12px;
    border-radius: 8px;
    background: rgba(139, 92, 246, 0.06);
    border: 1px solid rgba(139, 92, 246, 0.15);
    font-size: 0.875rem;
    font-weight: 500;
    color: var(--preply-primary);
    cursor: pointer;
    text-align: center;
    transition: background-color 0.2s;
  }
  .sector-reset-option:hover {
    background: rgba(139, 92, 246, 0.1);
  }

  /* Dropdown Premium "Le prof parle" (réutilise le style pays) */
  .language-dropdown-wrapper {
    position: relative;
    min-width: 188px;
  }

  .language-dropdown-trigger {
    width: 100%;
    padding: 10px 12px;
    border: 1px solid var(--preply-border);
    border-radius: 8px;
    font-size: 0.9375rem;
    background: rgba(255, 255, 255, 0.98);
    color: var(--preply-text);
    cursor: pointer;
    display: flex;
    justify-content: space-between;
    align-items: center;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    box-shadow: 0 2px 8px rgba(15, 23, 42, 0.08);
  }

  .language-dropdown-trigger:hover {
    border-color: rgba(139, 92, 246, 0.3);
    box-shadow: 0 4px 12px rgba(15, 23, 42, 0.12);
    transform: translateY(-1px);
  }

  .language-dropdown-trigger.active {
    border-color: var(--preply-primary);
    box-shadow: 0 4px 12px rgba(139, 92, 246, 0.2);
  }

  .language-selected-text {
    flex: 1;
  }

  .language-arrow {
    font-size: 0.75rem;
    color: var(--preply-text-light);
    transition: transform 0.2s;
    transform: rotate(0deg);
  }

  .language-dropdown-trigger.active .language-arrow {
    transform: rotate(180deg);
  }

  .language-dropdown-menu {
    position: absolute;
    bottom: calc(100% + 8px);
    left: 0;
    right: 0;
    background: var(--preply-bg);
    border: 1px solid var(--preply-border);
    border-radius: 12px;
    box-shadow: 0 8px 24px rgba(0, 0, 0, 0.12);
    z-index: 1001;
    max-height: 400px;
    overflow-y: auto;
    padding: 8px;
  }

  .language-search-wrapper {
    position: relative;
    margin-bottom: 12px;
  }

  .language-search-icon {
    position: absolute;
    left: 12px;
    top: 50%;
    transform: translateY(-50%);
    color: var(--preply-text-light);
    font-size: 0.875rem;
    pointer-events: none;
  }

  .language-search-input {
    width: 100%;
    padding: 10px 12px 10px 36px;
    border: 1px solid var(--preply-border);
    border-radius: 8px;
    font-size: 0.875rem;
    background: rgba(255, 255, 255, 0.98);
    color: var(--preply-text);
    outline: none;
    transition: all 0.2s;
  }

  .language-search-input:focus {
    border-color: var(--preply-primary);
    box-shadow: 0 0 0 3px rgba(139, 92, 246, 0.1);
  }

  .language-popular-header {
    font-weight: 600;
    font-size: 0.875rem;
    color: var(--preply-text);
    margin-bottom: 8px;
    padding: 0 4px;
  }

  .language-list {
    display: flex;
    flex-direction: column;
    gap: 2px;
  }

  .language-option {
    display: flex;
    align-items: center;
    padding: 10px 12px;
    cursor: pointer;
    border-radius: 8px;
    transition: background-color 0.2s;
    gap: 12px;
  }

  .language-option:hover {
    background-color: var(--preply-hover);
  }

  .language-option.selected {
    background-color: rgba(139, 92, 246, 0.1);
  }

  .language-name {
    flex: 1;
    font-size: 0.875rem;
    color: var(--preply-text);
  }

  .language-option.selected .language-name {
    color: var(--preply-primary);
    font-weight: 500;
  }

  .language-checkbox {
    width: 18px;
    height: 18px;
    border: 2px solid var(--preply-border);
    border-radius: 4px;
    flex-shrink: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.2s;
  }

  .language-option.selected .language-checkbox {
    background-color: var(--preply-primary);
    border-color: var(--preply-primary);
  }

  .language-option.selected .language-checkbox::after {
    content: '✓';
    color: white;
    font-size: 12px;
    font-weight: bold;
  }

  .language-no-results {
    padding: 16px;
    text-align: center;
    color: var(--preply-text-light);
    font-size: 0.875rem;
  }

  .language-all-section {
    margin-top: 12px;
    padding-top: 12px;
    border-top: 1px solid var(--preply-border);
  }

  .language-reset-option {
    margin-top: 12px;
    padding-top: 12px;
    border-top: 1px solid var(--preply-border);
  }

  .language-reset-option .language-name {
    font-weight: 600;
  }

  /* Popover Premium "Langue maternelle" - Professeurs natifs uniquement */
  .native-only-wrapper {
    position: relative;
  }

  .native-only-trigger {
    width: 100%;
    padding: 10px 12px;
    border: 1px solid var(--preply-border);
    border-radius: 8px;
    font-size: 0.9375rem;
    background: rgba(255, 255, 255, 0.98);
    color: var(--preply-text);
    cursor: pointer;
    display: flex;
    justify-content: space-between;
    align-items: center;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    box-shadow: 0 2px 8px rgba(15, 23, 42, 0.08);
  }

  .native-only-trigger:hover {
    border-color: rgba(139, 92, 246, 0.3);
    box-shadow: 0 4px 12px rgba(15, 23, 42, 0.12);
    transform: translateY(-1px);
  }

  .native-only-trigger.active {
    border-color: var(--preply-primary);
    box-shadow: 0 4px 12px rgba(139, 92, 246, 0.2);
  }

  .native-only-text {
    flex: 1;
  }

  .native-only-arrow {
    font-size: 0.75rem;
    color: var(--preply-text-light);
    transition: transform 0.2s;
    transform: rotate(0deg);
  }

  .native-only-trigger.active .native-only-arrow {
    transform: rotate(180deg);
  }

  .native-only-popover {
    position: absolute;
    bottom: calc(100% + 8px);
    left: 0;
    right: 0;
    background: var(--preply-bg);
    border: 1px solid var(--preply-border);
    border-radius: 12px;
    box-shadow: 0 8px 24px rgba(0, 0, 0, 0.12);
    z-index: 1001;
    padding: 20px;
    min-width: 280px;
  }

  .native-only-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 12px;
  }

  .native-only-title {
    font-weight: 600;
    font-size: 0.9375rem;
    color: var(--preply-text);
    flex: 1;
  }

  .native-only-toggle-wrapper {
    position: relative;
    display: inline-block;
    width: 44px;
    height: 24px;
    flex-shrink: 0;
    margin-left: 16px;
  }

  .native-only-toggle-input {
    opacity: 0;
    width: 0;
    height: 0;
  }

  .native-only-toggle-slider {
    position: absolute;
    cursor: pointer;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: #e0e0e0;
    transition: 0.3s;
    border-radius: 24px;
  }

  .native-only-toggle-slider:before {
    position: absolute;
    content: "";
    height: 18px;
    width: 18px;
    left: 3px;
    bottom: 3px;
    background-color: white;
    transition: 0.3s;
    border-radius: 50%;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
  }

  .native-only-toggle-input:checked + .native-only-toggle-slider {
    background-color: var(--preply-primary);
  }

  .native-only-toggle-input:checked + .native-only-toggle-slider:before {
    transform: translateX(20px);
  }

  .native-only-description {
    font-size: 0.875rem;
    color: var(--preply-text-light);
    line-height: 1.5;
    margin: 0;
  }

  /* Panel Premium "Profils d'experts" */
  .category-filter-wrapper {
    position: relative;
  }

  .category-filter-trigger {
    width: 100%;
    padding: 10px 12px;
    border: 1px solid var(--preply-border);
    border-radius: 8px;
    font-size: 0.9375rem;
    background: rgba(255, 255, 255, 0.98);
    color: var(--preply-text);
    cursor: pointer;
    display: flex;
    justify-content: space-between;
    align-items: center;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    box-shadow: 0 2px 8px rgba(15, 23, 42, 0.08);
  }

  .category-filter-trigger:hover {
    border-color: rgba(139, 92, 246, 0.3);
    box-shadow: 0 4px 12px rgba(15, 23, 42, 0.12);
    transform: translateY(-1px);
  }

  .category-filter-trigger.active {
    border-color: var(--preply-primary);
    box-shadow: 0 4px 12px rgba(139, 92, 246, 0.2);
  }

  .category-filter-trigger:hover {
    border-color: rgba(139, 92, 246, 0.3);
  }

  .category-filter-text {
    flex: 1;
  }

  .category-filter-arrow {
    font-size: 0.75rem;
    color: var(--preply-text-light);
    transition: transform 0.2s;
    transform: rotate(0deg);
  }

  .category-filter-trigger.active .category-filter-arrow {
    transform: rotate(180deg);
  }

  .category-filter-panel {
    position: absolute;
    bottom: calc(100% + 8px);
    left: 0;
    right: 0;
    background: var(--preply-bg);
    border: 1px solid var(--preply-border);
    border-radius: 16px;
    box-shadow: 0 8px 24px rgba(0, 0, 0, 0.12);
    z-index: 1001;
    padding: 20px;
    min-width: 320px;
  }

  .category-filter-card {
    display: flex;
    gap: 16px;
    align-items: flex-start;
  }

  .category-filter-card-icon {
    width: 40px;
    height: 40px;
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
    font-size: 20px;
  }

  .category-filter-card-icon.super-icon {
    background: linear-gradient(135deg, #EDE9FE 0%, #DDD6FE 100%);
    color: var(--preply-primary);
  }

  .category-filter-card-icon.qualified-icon {
    background: linear-gradient(135deg, #DBEAFE 0%, #BFDBFE 100%);
    color: var(--preply-primary-light);
  }

  .category-filter-card-icon.new-icon {
    background: linear-gradient(135deg, #FEF3C7 0%, #FDE68A 100%);
    color: #F59E0B;
  }

  .category-filter-card-content {
    flex: 1;
  }

  .category-filter-card-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 8px;
  }

  .category-filter-card-title {
    font-weight: 600;
    font-size: 0.9375rem;
    color: var(--preply-text);
    flex: 1;
  }

  .category-filter-card-description {
    font-size: 0.875rem;
    color: var(--preply-text-light);
    line-height: 1.5;
    margin: 0;
  }

  .category-filter-rating-options {
    display: flex;
    flex-direction: column;
    gap: 8px;
    margin-top: 12px;
  }

  .category-filter-rating-option {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 8px 12px;
    border-radius: 8px;
    cursor: pointer;
    transition: background 150ms ease;
    background: #F9FAFB;
    border: 1px solid #E5E7EB;
  }

  .category-filter-rating-option:hover {
    background: #F3F4F6;
    border-color: #D1D5DB;
  }

  .category-filter-rating-checkbox {
    width: 18px;
    height: 18px;
    cursor: pointer;
    accent-color: var(--preply-primary);
    flex-shrink: 0;
    border-radius: 4px;
  }

  .category-filter-rating-option:has(.category-filter-rating-checkbox:checked) {
    background: linear-gradient(135deg, #EEF2FF 0%, #E0E7FF 100%);
    border-color: #6366F1;
  }

  .rating-stars {
    font-size: 1rem;
    line-height: 1;
    color: #F59E0B;
  }

  .rating-text {
    font-size: 0.875rem;
    color: var(--preply-text);
    font-weight: 500;
  }

  .category-filter-toggle-wrapper {
    position: relative;
    display: inline-block;
    width: 44px;
    height: 24px;
    flex-shrink: 0;
    margin-left: 16px;
  }

  .category-filter-toggle-input {
    opacity: 0;
    width: 0;
    height: 0;
  }

  .category-filter-toggle-slider {
    position: absolute;
    cursor: pointer;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: #e0e0e0;
    transition: 0.3s;
    border-radius: 24px;
  }

  .category-filter-toggle-slider:before {
    position: absolute;
    content: "";
    height: 18px;
    width: 18px;
    left: 3px;
    bottom: 3px;
    background-color: white;
    transition: 0.3s;
    border-radius: 50%;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
  }

  .category-filter-toggle-input:checked + .category-filter-toggle-slider {
    background-color: var(--preply-primary);
  }

  .category-filter-toggle-input:checked + .category-filter-toggle-slider:before {
    transform: translateX(20px);
  }

  .category-filter-separator {
    height: 1px;
    background: var(--preply-border);
    margin: 16px 0;
  }

  .domain-option-main {
    padding: 10px 16px;
    cursor: pointer;
    transition: background-color 0.2s;
    color: var(--preply-text);
    font-size: 0.9375rem;
    display: flex;
    align-items: center;
    gap: 8px;
  }

  .domain-option-main:hover {
    background-color: var(--preply-hover);
  }

  .domain-option-main.selected {
    background-color: rgba(139, 92, 246, 0.1);
    color: var(--preply-primary);
    font-weight: 500;
  }

  .domain-arrow-inline {
    font-size: 0.7rem;
    color: var(--preply-text-light);
    transition: transform 0.2s;
    width: 12px;
    min-width: 12px;
    transform: rotate(0deg);
    display: inline-block !important;
    margin-right: 8px;
    visibility: visible !important;
  }

  .domain-option-main.expanded .domain-arrow-inline {
    transform: rotate(90deg);
  }

  .domain-submenu {
    background-color: #F9FAFB;
    padding-left: 24px;
  }

  .domain-suboption {
    padding: 8px 16px;
    font-size: 0.875rem;
    color: var(--preply-text-light);
  }

  .domain-suboption:hover {
    background-color: #F3F4F6;
  }

  .domain-suboption.selected {
    background-color: rgba(139, 92, 246, 0.1);
    color: var(--preply-primary);
    font-weight: 500;
  }

  .preply-filter-select:hover,
  .preply-filter-input:hover {
    border-color: var(--preply-primary);
  }

  .preply-filter-select:focus,
  .preply-filter-input:focus {
    outline: none;
    border-color: var(--preply-primary);
    box-shadow: 0 0 0 3px rgba(139, 92, 246, 0.1);
  }

  /* Interface de sélection de disponibilité — augmentée de 8 cm (350px + 8cm) */
  .preply-availability-group {
    position: relative;
    min-width: 200px;
    max-width: calc(350px + 8cm);
  }

  /* Mon expérience — réduit de 2 cm */
  .preply-experience-group {
    max-width: calc(300px - 2cm);
  }

  .preply-availability-trigger {
    width: 100%;
    padding: 10px 12px;
    border: 1px solid var(--preply-border);
    border-radius: 8px;
    font-size: 0.9375rem;
    background: rgba(255, 255, 255, 0.98);
    color: var(--preply-text);
    cursor: pointer;
    display: flex;
    justify-content: space-between;
    align-items: center;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    box-shadow: 0 2px 8px rgba(15, 23, 42, 0.08);
  }

  .preply-availability-trigger:hover {
    border-color: rgba(139, 92, 246, 0.3);
    box-shadow: 0 4px 12px rgba(15, 23, 42, 0.12);
    transform: translateY(-1px);
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
    bottom: calc(100% + 8px);
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
    flex-wrap: nowrap;
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
    flex-shrink: 0;
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
    box-shadow: 0 4px 12px rgba(139, 92, 246, 0.3);
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
    flex: 0.5;
    min-width: 200px;
    margin-left: auto;
  }

  /* Modèle de recherche premium (page d'accueil) - Taille réduite */
  .search-box-modern {
    background: rgba(255, 255, 255, 0.98);
    backdrop-filter: blur(10px);
    -webkit-backdrop-filter: blur(10px);
    border-radius: 999px;
    padding: 3px;
    box-shadow: 0 4px 12px rgba(15, 23, 42, 0.15);
    width: 100%;
    border: 1px solid rgba(255, 255, 255, 0.4);
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    height: 48px;
    display: flex;
    align-items: center;
  }

  .search-box-modern:hover {
    box-shadow: 0 6px 16px rgba(15, 23, 42, 0.2);
    transform: translateY(-1px);
  }

  .search-box-modern input {
    border: none;
    height: 42px;
    padding: 0 20px;
    font-size: 0.9375rem;
    background: transparent;
    color: #1a202c;
    font-weight: 400;
    flex: 1;
  }

  .search-box-modern input::placeholder {
    color: #9CA3AF;
    font-weight: 400;
    font-size: 0.9375rem;
  }

  .search-box-modern input:focus {
    outline: none;
    box-shadow: none;
  }

  /* Bouton loupe rond intégré (style premium) - Taille réduite */
  .search-box-modern .btn-search {
    background: linear-gradient(135deg, #4c1d95 0%, #2563eb 100%);
    color: white;
    border: none;
    width: 42px;
    height: 42px;
    border-radius: 50%;
    font-weight: 500;
    font-size: 1rem;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    box-shadow: 0 2px 8px rgba(76, 29, 149, 0.3);
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
    padding: 0;
    margin-right: 3px;
    cursor: pointer;
  }

  .search-box-modern .btn-search i {
    font-size: 1rem;
    margin: 0;
  }

  .search-box-modern .btn-search:hover {
    background: linear-gradient(135deg, #5B52F0 0%, #2563eb 100%);
    transform: scale(1.05);
    box-shadow: 0 4px 12px rgba(76, 29, 149, 0.4);
  }

  /* Résultats et tri */
  .preply-results-section {
    background: var(--preply-bg);
    padding: 32px 0;
    overflow: visible; /* Permettre à la vidéo de dépasser */
    position: relative;
    transition: opacity 0.2s ease;
  }

  .preply-results-section.is-loading {
    position: relative;
  }

  .preply-results-section.is-loading::after {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(255, 255, 255, 0.8);
    z-index: 10;
    pointer-events: none;
  }

  /* Loader discret pour filtres de langue uniquement */
  .preply-results-section.is-loading-language::after {
    display: none; /* Pas d'overlay pour les filtres de langue */
  }

  .preply-results-header .language-loader {
    display: none;
    margin-left: 12px;
    vertical-align: middle;
  }

  .preply-results-section.is-loading-language .preply-results-header .language-loader {
    display: inline-block;
  }

  .language-loader-spinner {
    display: inline-block;
    width: 16px;
    height: 16px;
    border: 2px solid #e0e0e0;
    border-top-color: #6366f1;
    border-radius: 50%;
    animation: language-spin 0.6s linear infinite;
  }

  @keyframes language-spin {
    to { transform: rotate(360deg); }
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
    background: linear-gradient(135deg, #8B5CF6 0%, #A78BFA 50%, #2563EB 100%);
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
    box-shadow: 0 2px 4px rgba(139, 92, 246, 0.2); /* Ombre subtile */
  }

  /* Effet premium au hover */
  .preply-teacher-btn-primary:hover {
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(139, 92, 246, 0.35), 0 2px 4px rgba(139, 92, 246, 0.2); /* Ombre plus prononcée */
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

  /* Bouton play rond violet bleu royal Projects */
  .preply-popover-play-btn {
    position: absolute;
    bottom: 12px;
    right: 12px;
    width: 52px;
    height: 52px;
    background: linear-gradient(135deg, #8B5CF6 0%, #A78BFA 50%, #2563EB 100%); /* Violet bleu royal */
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
    box-shadow: 0 4px 12px rgba(139, 92, 246, 0.4);
  }

  .preply-popover-play-btn:hover {
    transform: scale(1.1);
    box-shadow: 0 6px 16px rgba(139, 92, 246, 0.5);
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

  /* ============================================
     CARTES FREELANCES PREMIUM - STYLE PREPLY (depuis explore)
     ============================================ */
  .freelancers-list-wrapper {
    width: 100%;
    overflow: visible;
  }

  .freelancers-grid-premium {
    display: flex;
    flex-direction: column;
    gap: 20px;
  }

  .freelancer-card-wrapper-premium {
    position: relative !important;
    margin-bottom: 24px;
    width: 100%;
    overflow: visible !important;
    z-index: 1;
  }

  .freelancer-card-premium-v2 {
    background: #FFFFFF;
    border-radius: 24px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04), 0 1px 3px rgba(0, 0, 0, 0.02);
    border: 1px solid #E5E7EB;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    overflow: visible !important;
    position: relative;
    z-index: 1;
    width: 100%;
    padding: 0.5rem 1.75rem;
    min-height: 200px;
    max-width: 100%;
    box-sizing: border-box;
    display: flex;
    align-items: stretch;
  }

  @media (min-width: 1200px) {
    .freelancer-card-premium-v2 {
      max-width: 68%;
      margin-right: auto;
    }
  }

  .freelancer-card__content {
    display: flex;
    align-items: stretch;
    width: 100%;
    max-width: 100%;
    margin-right: 0;
    flex: 1;
    min-width: 0;
    position: relative;
  }

  .freelancer-card-premium-v2 .freelancer-quick-view-v2 {
    left: calc(100% + 1.5rem) !important;
  }

  .freelancer-card-premium-v2:hover {
    box-shadow: 0 12px 32px rgba(0, 0, 0, 0.12), 0 6px 16px rgba(0, 0, 0, 0.08);
    transform: translateY(-3px);
    transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
  }

  .freelancer-card-content {
    display: grid;
    grid-template-columns: auto 1fr auto;
    gap: 10px;
    align-items: flex-start;
    padding: 0;
    width: 100%;
  }

  .freelancer-photo-section {
    position: relative;
    flex-shrink: 0;
    display: flex;
    gap: 10px;
    align-items: flex-start;
    width: auto;
    min-width: 260px;
    max-width: 300px;
    padding-bottom: 8px;
  }

  .freelancer-identity-block {
    flex: 1;
    min-width: 0;
    display: flex;
    flex-direction: column;
    gap: 4px;
  }

  .freelancer-photo-container {
    position: relative;
    width: 138px;
    height: 138px;
    flex-shrink: 0;
    overflow: visible;
    margin-bottom: 0;
  }

  .freelancer-status-dot-wrapper {
    position: absolute;
    bottom: 4px;
    right: 4px;
    z-index: 10;
    cursor: pointer;
  }

  .freelancer-status-dot-wrapper .status-dot {
    width: 14px;
    height: 14px;
    border-radius: 50%;
    border: 2px solid white;
    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.2);
    display: block;
    transition: transform 0.2s;
  }

  .freelancer-status-dot-wrapper .status-dot.status-online {
    background: #10B981;
    animation: pulse-online 2s ease-in-out infinite;
  }

  .freelancer-status-dot-wrapper .status-dot.status-offline {
    background: #9CA3AF;
  }

  .freelancer-status-text-wrapper {
    position: absolute;
    bottom: -28px;
    left: 0;
    right: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 4px;
    font-size: 11px;
    font-weight: 500;
    color: #6B7280;
    white-space: nowrap !important;
    max-width: 100%;
    overflow: hidden;
    text-overflow: ellipsis;
    opacity: 0 !important;
    visibility: hidden !important;
    transition: opacity 0.2s ease, visibility 0.2s ease;
    z-index: 5;
    pointer-events: none;
    padding: 0 4px;
    box-sizing: border-box;
    flex-wrap: nowrap !important;
    line-height: 1.2;
  }

  .freelancer-status-dot-wrapper:hover ~ .freelancer-status-text-wrapper,
  .freelancer-photo-container:hover .freelancer-status-dot-wrapper:hover ~ .freelancer-status-text-wrapper {
    opacity: 1 !important;
    visibility: visible !important;
  }

  .status-dot-inline {
    width: 8px;
    height: 8px;
    border-radius: 50%;
    display: inline-block;
    flex-shrink: 0;
  }

  .status-dot-inline.status-online {
    background: #10B981;
  }

  .status-dot-inline.status-offline {
    background: #9CA3AF;
  }

  .status-text-inline {
    color: #6B7280;
    font-weight: 500;
    max-width: 100%;
    overflow: hidden;
    text-overflow: ellipsis;
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 2px;
    line-height: 1.3;
  }

  .status-line-1,
  .status-line-2 {
    display: block;
    width: 100%;
    text-align: center;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
  }

  .status-line-2 {
    font-size: 10px;
    color: #9CA3AF;
  }

  .freelancer-job-line {
    font-size: 14px;
    font-weight: 500;
    color: #374151;
    margin-top: 4px;
    line-height: 1.4;
  }

  .freelancer-headline {
    font-size: 14px;
    font-weight: 500;
    color: #374151;
    line-height: 1.4;
    margin: 4px 0 2px 0;
  }

  .freelancer-photo-img {
    width: 100%;
    height: 100%;
    border-radius: 20px;
    object-fit: cover;
    object-position: center center;
    border: 2px solid rgba(255, 255, 255, 0.95);
    box-shadow: 0 4px 16px rgba(0, 0, 0, 0.1), 0 2px 8px rgba(0, 0, 0, 0.06), inset 0 0 0 1px rgba(255, 255, 255, 0.4);
    transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
    background: #F9FAFB;
    display: block;
  }

  .freelancer-photo-placeholder {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    border-radius: 20px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: linear-gradient(135deg, #6366F1 0%, #8B5CF6 50%, #7C3AED 100%);
    border: 2px solid rgba(255, 255, 255, 0.95);
    box-shadow: 0 4px 16px rgba(99, 102, 241, 0.2), 0 2px 8px rgba(124, 58, 237, 0.15), inset 0 0 0 1px rgba(255, 255, 255, 0.4);
    transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
  }

  .photo-initial {
    font-size: 58px;
    font-weight: 700;
    color: white;
    text-shadow: 0 2px 8px rgba(0, 0, 0, 0.25), 0 1px 4px rgba(0, 0, 0, 0.15);
    letter-spacing: -1px;
    line-height: 1;
  }

  .freelancer-badge-overlay {
    position: absolute;
    top: -6px;
    right: -6px;
    width: 32px;
    height: 32px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    border: 3px solid white;
    box-shadow: 0 3px 12px rgba(0, 0, 0, 0.15), 0 1px 4px rgba(0, 0, 0, 0.1);
    z-index: 15;
    background: white;
    transition: transform 0.2s cubic-bezier(0.4, 0, 0.2, 1);
    pointer-events: none;
  }

  .freelancer-badge-overlay.badge-verified {
    background: linear-gradient(135deg, #10B981 0%, #059669 100%);
    border-color: white;
  }

  .freelancer-badge-overlay.badge-verified i {
    color: white;
    font-size: 16px;
  }

  .freelancer-badge-overlay.badge-top {
    background: linear-gradient(135deg, #FCD34D 0%, #F59E0B 100%);
    border-color: white;
  }

  .freelancer-badge-overlay.badge-top i {
    color: white;
    font-size: 14px;
  }

  .freelancer-info-section {
    flex: 1;
    min-width: 0;
    max-width: 100%;
    display: flex;
    flex-direction: column;
    justify-content: flex-start;
    padding: 0 8px;
    margin-right: 0.5rem;
  }

  .freelancer-name-v2 {
    font-size: 22px;
    font-weight: 600;
    color: #111827;
    margin: 0 0 4px 0;
    display: flex;
    align-items: center;
    gap: 8px;
    flex-wrap: wrap;
  }

  .freelancer-name-v2 a {
    color: inherit;
    text-decoration: none;
    transition: color 0.2s;
  }

  .freelancer-name-v2 a:hover {
    color: var(--premium-primary);
  }

  .verified-icon-v2 {
    color: #10B981;
    font-size: 18px;
  }

  .freelancer-languages-v2 {
    display: flex;
    align-items: center;
    gap: 8px;
    font-size: 14px;
    color: #374151;
    margin-bottom: 4px;
    line-height: 1.5;
  }

  .skill-icon {
    color: #6B7280;
    font-size: 16px;
  }

  .freelancer-bio-wrapper {
    margin: 0 0 4px 0;
  }

  .freelancer-bio-v2 {
    font-size: 14px;
    line-height: 1.5;
    color: #4B5563;
    margin: 0;
    font-weight: 400;
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
  }

  .freelancer-learn-more-v2 {
    font-size: 14px;
    font-weight: 500;
    color: var(--premium-primary);
    text-decoration: none;
    display: inline-block;
    margin-bottom: 6px;
    transition: color 0.2s;
  }

  .freelancer-learn-more-v2:hover {
    color: var(--premium-primary-dark);
    text-decoration: underline;
  }

  .freelancer-popularity-v2 {
    display: flex;
    align-items: center;
    gap: 6px;
    font-size: 13px;
    color: #6B7280;
    margin-top: 4px;
  }

  .freelancer-popularity-v2 i {
    color: #10B981;
  }

  .freelancer-pricing-section {
    flex-shrink: 0;
    width: 200px;
    min-width: 200px;
    display: flex;
    flex-direction: column;
    align-items: flex-end;
    gap: 12px;
    border-left: 1px solid #E5E7EB;
    padding-left: 10px;
    position: relative;
  }

  .freelancer-favorite-btn {
    position: absolute;
    top: 0;
    right: 0;
    background: none;
    border: none;
    color: #9CA3AF;
    font-size: 20px;
    cursor: pointer;
    padding: 4px;
    transition: all 0.2s;
    z-index: 5;
    width: 28px;
    height: 28px;
    display: flex;
    align-items: center;
    justify-content: center;
  }

  .freelancer-favorite-btn:hover {
    color: #EF4444;
    transform: scale(1.1);
  }

  .freelancer-favorite-btn.active {
    color: #EF4444;
  }

  .freelancer-price-v2 {
    text-align: right;
    position: relative;
    margin-right: 28px;
    padding-top: 4px;
  }

  .price-amount {
    font-size: 28px;
    font-weight: 700;
    color: #111827;
    line-height: 1;
  }

  .price-label {
    font-size: 13px;
    color: #6B7280;
    margin-top: 4px;
  }

  .freelancer-rating-v2 {
    display: flex;
    align-items: center;
    gap: 6px;
    margin-top: 8px;
  }

  .rating-number {
    font-size: 20px;
    font-weight: 700;
    color: #111827;
  }

  .rating-stars-v2 {
    color: #FCD34D;
    font-size: 16px;
  }

  .rating-count {
    font-size: 13px;
    color: #6B7280;
  }

  .freelancer-stats-v2 {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 8px;
    width: 100%;
    margin-top: 4px;
  }

  .stat-item-v2 {
    background: #F9FAFB;
    border-radius: 8px;
    padding: 12px;
    text-align: center;
  }

  .stat-number {
    display: block;
    font-size: 20px;
    font-weight: 700;
    color: #111827;
    line-height: 1;
  }

  .stat-label-v2 {
    display: block;
    font-size: 11px;
    color: #6B7280;
    margin-top: 4px;
    font-weight: 500;
  }

  .freelancer-cta-v2 {
    display: flex;
    flex-direction: column;
    gap: 6px;
    width: 100%;
    margin-top: 4px;
  }

  .cta-primary-v2 {
    padding: 9px 11px;
    background: linear-gradient(135deg, #7C3AED 0%, #6366F1 50%, #4F46E5 100%);
    color: white;
    border-radius: 9999px;
    font-size: 15px;
    font-weight: 600;
    text-align: center;
    text-decoration: none;
    transition: all 0.2s;
    box-shadow: 0 2px 8px rgba(124, 58, 237, 0.25);
  }

  .cta-primary-v2:hover {
    background: linear-gradient(135deg, #4338CA 0%, #6D28D9 100%);
    box-shadow: 0 4px 12px rgba(79, 70, 229, 0.4);
    transform: translateY(-1px);
    color: white;
  }

  .cta-secondary-v2 {
    padding: 12px 20px;
    background: white;
    color: #111827;
    border: 1px solid #D1D5DB;
    border-radius: 10px;
    font-size: 14px;
    font-weight: 500;
    text-align: center;
    text-decoration: none;
    transition: all 0.2s;
  }

  .cta-secondary-v2:hover {
    background: #F9FAFB;
    border-color: #9CA3AF;
    color: #111827;
  }

  .freelancer-card-premium-v2 .freelancer-quick-view-v2,
  .freelancers-list-wrapper .freelancer-quick-view-v2 {
    position: absolute !important;
    top: 0 !important;
    transform: translateX(-10px) !important;
    left: calc(100% + 1.5rem) !important;
    right: auto !important;
    width: 340px !important;
    max-width: 340px !important;
    height: 100% !important;
    min-height: auto;
    max-height: none;
    background: #FFFFFF;
    border-radius: 20px;
    box-shadow: 0 10px 40px rgba(0, 0, 0, 0.15), 0 4px 16px rgba(0, 0, 0, 0.1);
    padding: 0;
    opacity: 0;
    visibility: hidden;
    transition: opacity 0.3s cubic-bezier(0.4, 0, 0.2, 1), visibility 0.3s cubic-bezier(0.4, 0, 0.2, 1), transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    z-index: 100 !important;
    pointer-events: none;
    overflow: hidden;
    display: flex;
    flex-direction: column;
  }

  .freelancer-card-premium-v2:hover .freelancer-quick-view-v2,
  .freelancers-list-wrapper .freelancer-card-premium-v2:hover .freelancer-quick-view-v2,
  .freelancers-list-wrapper .freelancer-card-wrapper-premium:hover .freelancer-quick-view-v2 {
    opacity: 1 !important;
    visibility: visible !important;
    transform: translateX(0) !important;
    pointer-events: all !important;
  }

  @media (max-width: 1024px) {
    .freelancer-card-premium-v2 {
      flex-direction: column;
    }
    
    .freelancer-card__content {
      max-width: 100% !important;
      margin-right: 0 !important;
      flex-direction: column;
    }
    
    .freelancer-card-content {
      grid-template-columns: 1fr;
      gap: 16px;
    }
    
    .freelancers-list-wrapper .freelancer-quick-view-v2 {
      position: static !important;
      transform: none !important;
      width: 100% !important;
      max-width: 100% !important;
      margin: 1rem 0 0 0 !important;
      top: auto !important;
      left: auto !important;
      right: auto !important;
      opacity: 1 !important;
      visibility: visible !important;
      pointer-events: all !important;
    }
  }

  .quick-view-content-v2 {
    display: flex;
    flex-direction: column;
  }

  .quick-view-video-section {
    position: relative;
    width: 100%;
    height: 45%;
    min-height: 169px;
    max-height: 219px;
    overflow: hidden;
    border-radius: 16px 16px 0 0;
    background: #1F2937;
    box-shadow: inset 0 2px 8px rgba(0, 0, 0, 0.1);
    flex-shrink: 0;
  }

  .video-thumbnail-wrapper {
    position: relative;
    width: 100%;
    height: 100%;
    overflow: hidden;
  }

  .video-thumbnail-img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    object-position: center;
    transition: transform 0.3s ease;
    display: block;
    background: #1F2937;
  }

  .video-play-btn-v2 {
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
    z-index: 10;
  }

  .video-play-btn-v2:hover {
    background: rgba(255, 255, 255, 0.18);
    border-color: rgba(255, 255, 255, 0.3);
    transform: translate(-50%, -50%) scale(1.08);
    box-shadow: 0 6px 20px rgba(0, 0, 0, 0.2);
  }

  .video-play-btn-v2 svg {
    filter: drop-shadow(0 1px 3px rgba(0, 0, 0, 0.2));
  }

  .video-label-v2 {
    position: absolute;
    bottom: 12px;
    left: 12px;
    background: rgba(0, 0, 0, 0.75);
    backdrop-filter: blur(8px);
    color: white;
    padding: 6px 12px;
    border-radius: 8px;
    font-size: 12px;
    font-weight: 500;
    z-index: 5;
    pointer-events: none;
  }

  .quick-view-actions-v2 {
    padding: 16px 20px 20px;
    display: flex;
    flex-direction: column;
    gap: 10px;
    flex: 1;
    justify-content: flex-end;
  }

  .quick-view-btn-primary-v2,
  .quick-view-btn-secondary-v2 {
    padding: 10px 16px;
    border-radius: 10px;
    font-size: 13px;
    font-weight: 600;
    text-align: center;
    text-decoration: none;
    transition: all 0.2s;
  }

  .quick-view-btn-primary-v2 {
    padding: 19px 16px;
    background: linear-gradient(135deg, #4F46E5 0%, #7C3AED 100%);
    color: white;
    box-shadow: 0 2px 8px rgba(79, 70, 229, 0.3);
  }

  .quick-view-btn-primary-v2:hover {
    background: linear-gradient(135deg, #4338CA 0%, #6D28D9 100%);
    box-shadow: 0 4px 12px rgba(79, 70, 229, 0.4);
    transform: translateY(-1px);
    color: white;
  }

  .quick-view-btn-secondary-v2 {
    background: white;
    color: #111827;
    border: 1px solid #D1D5DB;
  }

  .quick-view-btn-secondary-v2:hover {
    background: #F9FAFB;
    border-color: #9CA3AF;
    color: #111827;
  }

  @keyframes pulse-online {
    0%, 100% {
      opacity: 1;
      transform: scale(1);
    }
    50% {
      opacity: 0.7;
      transform: scale(1.1);
    }
  }

  /* Modale vidéo */
  .video-modal-overlay {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.85);
    z-index: 9999;
    align-items: center;
    justify-content: center;
    backdrop-filter: blur(5px);
  }

  .video-modal-overlay.active {
    display: flex;
  }

  .video-modal-container {
    position: relative;
    width: 90%;
    max-width: 900px;
    max-height: 90vh;
    background: #000;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 20px 60px rgba(0, 0, 0, 0.5);
  }

  .video-modal-close {
    position: absolute;
    top: 15px;
    right: 15px;
    width: 40px;
    height: 40px;
    background: rgba(255, 255, 255, 0.2);
    border: none;
    border-radius: 50%;
    color: white;
    font-size: 24px;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    z-index: 10000;
    transition: all 0.3s ease;
    backdrop-filter: blur(10px);
  }

  .video-modal-close:hover {
    background: rgba(255, 255, 255, 0.3);
    transform: scale(1.1);
  }

  .video-modal-content {
    width: 100%;
    height: 0;
    padding-bottom: 56.25%; /* 16:9 aspect ratio */
    position: relative;
  }

  .video-modal-content iframe {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    border: none;
  }

  @media (max-width: 768px) {
    .video-modal-container {
      width: 95%;
      max-height: 80vh;
    }
  }

  /* ========== DESIGN SYSTEM PREMIUM (scopé .page-projects) ========== */
  /* Fond de page (sous filtre et cartes) : dégradé violet lavande /services + jet de lumière — sans toucher au hero */
  .services-page-wrapper.page-projects {
    min-height: 100vh;
    position: relative;
    overflow: hidden;
    background-color: #FAFAFC;
    background-image:
      linear-gradient(180deg, #FAFAFC 0%, #F8F7FC 40%, #F5F3FF 100%),
      url("data:image/svg+xml,%3Csvg viewBox='0 0 256 256' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='g'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.8' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23g)'/%3E%3C/svg%3E");
    background-blend-mode: normal, overlay;
    background-size: 100% 100%, 200px 200px;
    background-position: 0 0, 0 0;
  }
  .services-page-wrapper.page-projects::before {
    content: '';
    position: fixed;
    top: -20%;
    left: -10%;
    width: 60%;
    height: 60%;
    background: radial-gradient(circle at 30% 30%, rgba(196, 181, 253, 0.06) 0%, transparent 55%);
    pointer-events: none;
    z-index: 0;
  }
  .services-page-wrapper.page-projects::after {
    content: '';
    position: fixed;
    bottom: -20%;
    right: -10%;
    width: 55%;
    height: 55%;
    background: radial-gradient(circle at 70% 70%, rgba(196, 181, 253, 0.05) 0%, transparent 55%);
    pointer-events: none;
    z-index: 0;
  }
  .services-page-wrapper.page-projects > * { position: relative; z-index: 1; }
  .services-page-wrapper.page-projects .preply-filters-section,
  .services-page-wrapper.page-projects .preply-results-section { background: transparent; }
  .page-projects .services-hero {
    position: relative;
    border-radius: 0 0 32px 32px;
    box-shadow: 0 12px 40px rgba(139, 92, 246, 0.18), 0 0 0 1px rgba(255, 255, 255, 0.08) inset;
  }
  .page-projects .services-hero::before {
    content: '';
    position: absolute;
    inset: 0;
    background: linear-gradient(to bottom, rgba(255,255,255,0.12) 0%, transparent 50%);
    pointer-events: none;
    z-index: 1;
  }
  .page-projects .services-hero::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    height: 160px;
    background: linear-gradient(to top, rgba(255,255,255,1) 0%, rgba(255,255,255,0.5) 50%, transparent 100%);
    pointer-events: none;
    z-index: 2;
  }
  .page-projects .preply-filters-section {
    border-bottom: 1px solid var(--preply-border);
    box-shadow: 0 2px 12px rgba(0, 0, 0, 0.04);
  }
  .page-projects .preply-filter-select,
  .page-projects .preply-filter-input {
    border: 1px solid var(--preply-border);
    border-radius: 12px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
  }
  .page-projects .preply-filter-select:focus,
  .page-projects .preply-filter-input:focus {
    box-shadow: 0 0 0 3px rgba(var(--preply-primary-rgb), 0.12);
  }
  .page-projects .preply-results-header { border-bottom: 1px solid var(--preply-border); padding-bottom: 1rem; margin-bottom: 1rem; }
  .page-projects .freelancer-card-premium-v2 {
    border: 1px solid rgba(229, 231, 235, 0.9);
    border-radius: 20px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.06);
    transition: transform 0.25s ease-out, box-shadow 0.25s ease-out;
  }
  .page-projects .freelancer-card-premium-v2:hover {
    transform: translateY(-3px);
    box-shadow: 0 12px 40px rgba(0, 0, 0, 0.08);
  }
  .page-projects .services-hero__btn--primary {
    transition: transform 0.2s ease-out, box-shadow 0.2s ease-out;
  }
  .page-projects .services-hero__btn--primary:hover {
    transform: translateY(-1px);
    box-shadow: 0 6px 20px rgba(var(--preply-primary-rgb), 0.25);
  }

  /* Hero Pays + Ville (identique HomeSwap) — micro-indicateurs */
  #projectsCityWrapper { position: relative; }
  .projects-city-assistant { position: absolute; right: 0.75rem; top: 50%; transform: translateY(-50%); display: flex; align-items: center; gap: 0.5rem; pointer-events: none; z-index: 3; }
  .projects-city-assistant > * { pointer-events: auto; }
  .projects-city-icons { display: flex; align-items: center; gap: 0.35rem; }
  .projects-city-icon { display: inline-flex; align-items: center; justify-content: center; width: 18px; height: 18px; color: #94a3b8; opacity: 0.7; }
  .projects-city-icon svg { width: 100%; height: 100%; }
  .projects-city-icon-popular { color: #6b7280; opacity: 0.75; }
  .projects-city-info-btn { display: inline-flex; align-items: center; justify-content: center; width: 18px; height: 18px; padding: 0; border: none; background: none; color: #94a3b8; cursor: pointer; opacity: 0.6; transition: all 0.2s ease; }
  .projects-city-info-btn:hover { opacity: 1; color: #7c3aed; }
  .projects-city-info-btn:focus-visible { outline: 2px solid #7c3aed; outline-offset: 2px; border-radius: 3px; }
  .projects-city-info-btn svg { width: 100%; height: 100%; }
  .projects-city-popover { position: fixed; z-index: 10000; background: #fff; border: 1px solid rgba(0,0,0,0.08); border-radius: 12px; box-shadow: 0 8px 24px rgba(0,0,0,0.12); min-width: 240px; max-width: 320px; animation: projectsPopoverFadeIn 0.2s ease; }
  @keyframes projectsPopoverFadeIn { from { opacity: 0; transform: translateY(-4px); } to { opacity: 1; transform: translateY(0); } }
  .projects-city-popover-content { padding: 1rem; }
  .projects-city-popover-content p + p { margin-top: 0.5rem; }
  .projects-city-popover-text { font-size: 0.75rem; color: #64748b; line-height: 1.5; margin: 0; }
  .projects-city-popover-badge { color: #6b7280; font-weight: 500; }

  /* Toggle Base journée 7h/8h (Engagement en Rituel) */
  .page-projects .engagement-base-btn.is-active { background: #fff !important; color: #7c3aed !important; box-shadow: 0 1px 2px rgba(0,0,0,0.05); }
  .page-projects .engagement-base-btn:hover { color: #7c3aed; background: rgba(124, 58, 237, 0.08); }
  /* Express option — style premium aligné Engagement */
  .page-projects .junspro-express-options .express-option-card.is-selected { background: #fff !important; color: #7c3aed !important; box-shadow: 0 1px 2px rgba(0,0,0,0.05); }
  .page-projects .junspro-express-options .express-option-card:hover { color: #7c3aed; background: rgba(124, 58, 237, 0.08); }
  .page-projects .engagement-base-tooltip:hover { background: #7c3aed !important; color: white !important; }
  .page-projects .engagement-base-tooltip:hover::after { content: attr(data-tooltip); position: absolute; left: 50%; bottom: calc(100% + 8px); transform: translateX(-50%); max-width: 240px; padding: 6px 10px; background: #1F2937; color: #fff; font-size: 10px; line-height: 1.4; border-radius: 6px; white-space: normal; z-index: 100; pointer-events: none; box-shadow: 0 4px 12px rgba(0,0,0,0.2); }
  .page-projects .engagement-base-tooltip { position: relative; }

  /* Hero Domaine + Spécialisation (dropdown premium) — z-index pour que le menu s’affiche au-dessus du hero */
  .page-projects .home-search-filter-section { overflow: visible; }
  [data-hero-filter="projects"] { position: relative; z-index: 50; overflow: visible; }
  .filter-hero-domain-select-wrapper { position: relative; width: 100%; }
  .filter-hero-domain-select-wrapper .filter-select-domain-hero,
  .filter-select-domain-hero {
    display: block; width: 100%; padding: 1rem 1rem 1rem 3.5rem; border: 2px solid rgba(196, 181, 253, 0.3); border-radius: 16px;
    font-size: 1rem; background: #fff; color: #1a202c; cursor: pointer; transition: all 0.3s ease;
    appearance: none; -webkit-appearance: none; -moz-appearance: none;
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 12 12' fill='none' stroke='%237c3aed' stroke-width='2' stroke-linecap='round'%3E%3Cpath d='M3 4.5 L6 7.5 L9 4.5'/%3E%3C/svg%3E");
    background-repeat: no-repeat; background-position: right 1rem center; background-size: 12px;
    outline: none;
  }
  .filter-hero-domain-select-wrapper .filter-select-domain-hero:hover,
  .filter-select-domain-hero:hover { border-color: rgba(124, 58, 237, 0.5); }
  .filter-hero-domain-select-wrapper .filter-select-domain-hero:focus,
  .filter-select-domain-hero:focus { border-color: #7c3aed; box-shadow: 0 0 0 4px rgba(124, 58, 237, 0.1); }
  .filter-hero-domain-spec .filter-select { padding-left: 3.5rem; }
  #projectsHeroSpecializationWrapper .filter-select:disabled { opacity: 0.85; cursor: not-allowed; }
</style>
@endsection

@section('content')
<div class="services-page-wrapper page-projects">
  {{-- Hero conservé --}}
  <x-services.hero
    title="Projets et Consulting"
    subtitle="On avance vite. Et on fait ça bien."
    micro="Choisissez un rituel, exprimez votre besoin et avancez sereinement, en suivant chaque étape en toute simplicité."
    :cta="['text' => 'Trouver un freelance', 'url' => '#results', 'variant' => 'primary']"
  />

  {{-- Filtre de recherche type /home (sur le hero) --}}
  <div class="container" style="position:relative;z-index:10;">
    <x-home.search-filter formId="preplyFiltersForm" :formAction="route('services.projects')" universe="projects" :categories="$categories" :domainSpecializations="$domainSpecializations ?? []" keywordPlaceholder="Essayez 'SEO', 'Développement web', 'Design'..." locationPlaceholder="Lieu (ex: Paris, Lyon...)" />
    </div>

  {{-- Barre de filtres horizontaux Preply : intégrée dans "Filtres avancés" du search-filter pour /services/projects --}}

  {{-- Module Pause Souffle Inline avec badge + titre (juste sous filtres, avant résultats) --}}
  <div class="container">
    @include('frontend.components.pause-souffle.inline-premium-projects')
  </div>

  {{-- Résultats --}}
  <section id="results" class="preply-results-section" style="overflow: visible;">
    <div id="resultsContainer" class="preply-results-container" style="overflow: visible;">
      <div class="preply-results-header">
        <h2 class="preply-results-count">{{ $freelancers->total() ?? 0 }} freelances disponibles<span class="language-loader"><span class="language-loader-spinner"></span></span></h2>
        <x-ritual-signature />
        <select class="preply-sort-select" id="sortSelect" name="sort">
          <option value="favorites">Trier par : Nos préférés</option>
          <option value="price_asc">Prix croissant</option>
          <option value="price_desc">Prix décroissant</option>
          <option value="rating">Meilleure note</option>
        </select>
      </div>

      <div class="freelancers-list-wrapper">
        <div class="freelancers-grid-premium" style="display: flex; flex-direction: column; gap: 20px;">
          @if($freelancers->isEmpty())
            <div style="text-align: center; padding: 60px 20px; max-width: 600px; margin: 0 auto;">
              @if(isset($hasNoResults) && $hasNoResults)
                <div style="margin-bottom: 2rem;">
                  <i class="fas fa-map-marker-alt" style="font-size: 3rem; color: #7c3aed; margin-bottom: 1rem;"></i>
                  <h3 style="font-size: 1.5rem; font-weight: 600; color: #1a202c; margin-bottom: 1rem;">
                    Ce service n'existe pas encore dans votre région
                  </h3>
                  <p style="font-size: 1.125rem; color: #4a5568; line-height: 1.6; margin-bottom: 2rem;">
                    Aidez-nous à le développer en devenant notre ambassadeur
                  </p>
                  <a href="{{ route('referral.index') }}" class="btn-ambassador" style="display: inline-flex; align-items: center; gap: 0.5rem; padding: 0.875rem 2rem; font-size: 1.125rem; font-weight: 600; color: #ffffff; background: linear-gradient(135deg, #7c3aed 0%, #a78bfa 50%, #2563eb 100%); border-radius: 50px; text-decoration: none; box-shadow: 0 4px 12px rgba(124, 58, 237, 0.3); transition: all 0.3s ease;">
                    <i class="fas fa-star"></i>
                    Devenez Ambassadeur
                  </a>
                </div>
              @else
              <p style="font-size: 1.125rem; color: var(--preply-text-light);">Aucun freelance trouvé pour le moment.</p>
              @endif
            </div>
          @else
            @foreach ($freelancers as $freelancer)
          @php
            $user = $freelancer->user;
                  
                  // Calculer les initiales (première lettre du prénom + première lettre du nom)
                  // IMPORTANT : Ne jamais afficher "Freelance" comme nom - utiliser les vraies données
                  $name = trim($user->name ?? '');
                  
                  // Si le nom est vide ou contient "Freelance", essayer d'autres sources
                  if (empty($name) || strtolower($name) === 'freelance') {
                    // Essayer first_name et last_name si disponibles
                    $firstName = trim($user->first_name ?? '');
                    $lastName = trim($user->last_name ?? '');
                    
                    if (!empty($firstName) || !empty($lastName)) {
                      $name = trim($firstName . ' ' . $lastName);
                    }
                  }
                  
                  $nameParts = array_filter(explode(' ', $name), function($part) {
                    return strlen(trim($part)) > 0 && strtolower(trim($part)) !== 'freelance';
                  });
                  $nameParts = array_values($nameParts); // Réindexer le tableau
                  
                  if (count($nameParts) >= 2) {
                    // Si on a prénom et nom : prendre la première lettre de chaque
                    $firstName = ucfirst(strtolower(trim($nameParts[0])));
                    $lastName = ucfirst(strtolower(trim($nameParts[count($nameParts) - 1])));
                    $initial = strtoupper(substr($firstName, 0, 1) . substr($lastName, 0, 1));
                    // Format "Prénom N." pour l'affichage (comme Preply : "Maxence B.")
                    $displayName = $firstName . ' ' . strtoupper(substr($lastName, 0, 1)) . '.';
                  } else if (count($nameParts) == 1 && strlen(trim($nameParts[0])) > 2) {
                    // Si un seul mot mais plus de 2 caractères, utiliser ce mot
                    $singleName = ucfirst(strtolower(trim($nameParts[0])));
                    $initial = strtoupper(substr($singleName, 0, min(2, strlen($singleName))));
                    $displayName = $singleName;
                } else {
                    // Dernier recours : utiliser les initiales du nom d'utilisateur ou générer un nom
                    $username = trim($user->username ?? '');
                    if (!empty($username) && strtolower($username) !== 'freelance') {
                      $displayName = ucfirst($username);
                      $initial = strtoupper(substr($displayName, 0, min(2, strlen($displayName))));
                    } else {
                      // Générer un nom à partir de l'ID si vraiment rien n'est disponible
                      $displayName = 'Utilisateur ' . substr($user->id ?? 'U', 0, 3);
                      $initial = 'U' . substr($user->id ?? '1', 0, 1);
                    }
                  }
                  
                  $avatarColor = '#' . substr(md5($user->name ?? 'F'), 0, 6);
                  $skills = is_array($freelancer->skills) ? $freelancer->skills : [];
                  
                  // Badge
                  $badge = null;
                  if ($user->is_super_freelancer ?? false) {
                    $badge = 'top';
                  } elseif ($freelancer->is_verified || ($user->is_verified_freelancer ?? false)) {
                    $badge = 'verified';
                  }
                  
                  // Statut de présence (simulé pour l'instant - à remplacer par vraies données si disponibles)
                  // Utiliser updated_at comme approximation de la dernière activité
                  $lastSeenAt = $user->updated_at ?? null;
                  $isOnline = false; // Par défaut hors ligne - à remplacer par vraie logique si disponible
                  
                  // Calculer "vu il y a X" si hors ligne (avec protection contre les valeurs négatives)
                  $lastSeenText = '';
                  if (!$isOnline && $lastSeenAt) {
                    try {
                      // S'assurer que lastSeenAt est une date valide et dans le passé
                      $lastSeen = \Carbon\Carbon::parse($lastSeenAt);
                      $now = now();
                      
                      // Si la date est dans le futur, utiliser maintenant comme référence
                      if ($lastSeen->isFuture()) {
                        $lastSeen = $now;
                      }
                      
                      $diffInMinutes = abs($now->diffInMinutes($lastSeen));
                      
                      // Limiter à un maximum raisonnable (éviter les valeurs absurdes)
                      if ($diffInMinutes > 525600) { // Plus d'un an
                        $lastSeenText = 'vu il y a longtemps';
                      } elseif ($diffInMinutes < 60) {
                        $lastSeenText = 'vu il y a ' . $diffInMinutes . ' min';
                      } elseif ($diffInMinutes < 1440) {
                        $diffInHours = floor($diffInMinutes / 60);
                        $lastSeenText = 'vu il y a ' . $diffInHours . ' h';
                      } else {
                        $diffInDays = floor($diffInMinutes / 1440);
                        $lastSeenText = 'vu il y a ' . $diffInDays . ' j';
                      }
              } catch (\Exception $e) {
                      // En cas d'erreur, ne pas afficher de texte
                      $lastSeenText = '';
              }
            }
            @endphp
                <div class="freelancer-card-wrapper-premium" data-freelancer-id="{{ $freelancer->id }}">
                  <!-- Carte principale - Style Preply avec wrapper pour réserver l'espace vidéo -->
                  <div class="freelancer-card-premium-v2 preply-teacher-card" data-freelancer-id="{{ $freelancer->id }}" data-hourly-rate="{{ $freelancer->hourly_rate ?? 0 }}" data-ritual-rate="{{ $freelancer->hourly_rate ?? 0 }}">
                    <!-- Wrapper du contenu pour limiter la largeur et réserver l'espace pour la vidéo -->
                    <div class="freelancer-card__content">
                      <!-- Contenu principal de la carte (avatar + infos + prix) -->
                      <div class="freelancer-card-content">
                      
                      <!-- ============================================
                           COLONNE GAUCHE : IDENTITÉ (Style Preply)
                           ============================================ -->
                      <div class="freelancer-photo-section">
                        <div class="freelancer-photo-container">
                          @if ($user->image)
                            <img src="{{ asset('assets/img/users/' . $user->image) }}" 
                                 alt="{{ $user->name }}" 
                                 class="freelancer-photo-img"
                                 onerror="this.style.display='none'; this.parentElement.querySelector('.freelancer-photo-placeholder').style.display='flex';">
                          @endif
                          
                          <!-- Fallback avec dégradé violet et initiales si pas de photo -->
                          <div class="freelancer-photo-placeholder" style="display: {{ $user->image ? 'none' : 'flex' }};">
                            <span class="photo-initial">{{ $initial }}</span>
                    </div>
                          
                          <!-- Badge qualité (coin supérieur droit) -->
                          @if ($badge)
                            <div class="freelancer-badge-overlay badge-{{ $badge }}">
                              @if ($badge == 'top')
                                <i class="fas fa-crown"></i>
                              @elseif ($badge == 'verified')
                                <i class="fas fa-check-circle"></i>
                  @endif
                    </div>
                  @endif
                  
                          <!-- Statut en ligne/hors ligne (point en bas à droite de la photo) -->
                          <!-- SUPPRESSION du title pour éviter le tooltip encadré du navigateur -->
                          <div class="freelancer-status-dot-wrapper">
                            <span class="status-dot {{ $isOnline ? 'status-online' : 'status-offline' }}"></span>
                          </div>
                          
                          <!-- Texte du statut en ligne/hors ligne (sous la photo) - Visible uniquement au survol -->
                          <div class="freelancer-status-text-wrapper">
                            <span class="status-dot-inline {{ $isOnline ? 'status-online' : 'status-offline' }}"></span>
                            <span class="status-text-inline">
                              @if ($isOnline)
                      En ligne
                              @else
                                <span class="status-line-1">Hors ligne</span>
                                @if ($lastSeenText)
                                  <span class="status-line-2">{{ $lastSeenText }}</span>
                  @endif
                  @endif
                            </span>
                </div>
              </div>

                        <!-- Nom + Initiale + Drapeau + Badge vérifié (à droite de la photo) -->
                        <div class="freelancer-identity-block">
                          <h3 class="freelancer-name-v2">
                            <a href="{{ route('freelance.show', $freelancer->id) }}" target="_self">
                              {{ $displayName }}
                            </a>
                            @php
                              // Récupérer le code pays pour l'afficher après le nom
                              $countryCodeForName = strtoupper(trim($user->country_code ?? 'FR'));
                              if (empty($countryCodeForName) || strlen($countryCodeForName) < 2) {
                                $countryCodeForName = 'FR';
                              }
                            @endphp
                            <span style="font-weight: 400; color: #6B7280; margin-left: 4px;">{{ $countryCodeForName }}</span>
                            @if ($badge == 'verified' || ($user->is_verified_freelancer ?? false))
                              <span class="verified-icon-v2">
                      <i class="fas fa-check-circle"></i>
                    </span>
                  @endif
                </h3>
                          
                          <!-- Langues parlées -->
                          @php
                            // Mapping des codes de langues vers leurs noms français
                            $languageNames = [
                              'fr' => 'Français',
                              'ar' => 'Arabe',
                              'es' => 'Espagnol',
                              'ru' => 'Russe',
                              'en' => 'Anglais',
                              'de' => 'Allemand',
                              'it' => 'Italien',
                              'pt' => 'Portugais',
                              'zh' => 'Chinois',
                              'ja' => 'Japonais',
                              'ko' => 'Coréen',
                            ];
                            
                            // Récupérer les langues du freelancer
                            $languages = $freelancer->languages ?? [];
                            $langDisplay = [];
                            
                            if (is_array($languages) && count($languages) > 0) {
                              // Prendre la première langue
                              $firstLang = $languages[0];
                              if (is_array($firstLang)) {
                                $langCode = strtolower($firstLang['code'] ?? $firstLang['name'] ?? 'en');
                                $langName = $languageNames[$langCode] ?? ucfirst($firstLang['name'] ?? 'Anglais');
                                $level = $firstLang['level'] ?? 'Natif';
                                // Capitaliser "Natif" si nécessaire
                                if (strtolower($level) === 'native' || strtolower($level) === 'natif') {
                                  $level = 'Natif';
                                }
                                $langDisplay = $langName . ' (' . $level . ')';
                              } else {
                                // Si c'est une chaîne simple, essayer de la mapper
                                $langCode = strtolower($firstLang);
                                $langDisplay = $languageNames[$langCode] ?? ucfirst($firstLang);
                                $langDisplay .= ' (Natif)';
                              }
                            }
                            
                            // Valeur par défaut si aucune langue trouvée
                            if (empty($langDisplay)) {
                              $langDisplay = 'Anglais (Natif)';
                            }
                          @endphp
                          <div class="freelancer-job-line" style="white-space: nowrap;">
                            🗣️ Le freelance parle {{ $langDisplay }}
                          </div>
                          
                          <!-- Phrase d'accroche (headline) -->
                          @php
                            $headline = $freelancer->headline ?? 'Freelance expert pour vos projets.';
                          @endphp
                          <p class="freelancer-headline">
                            {{ $headline }}
                          </p>
                          
                          <!-- Description courte : on limite l'aperçu sur la carte à quelques lignes.
                               Le texte complet sera lu sur la page profil via « En savoir plus ». -->
                          @php
                            // Bio complète (utilisée sur la page profil)
                            $fullBio = $freelancer->bio ?? $freelancer->about ?? 'Spécialisé dans la création de landing pages, tunnels de vente et automatisation marketing.';
                            // Si la bio est trop courte, utiliser un texte par défaut réduit
                            if (empty($fullBio) || strlen($fullBio) < 30) {
                              $fullBio = 'Spécialisé dans la création de landing pages, tunnels de vente et automatisation marketing.';
                            }

                            // Aperçu pour la carte : on tronque à ~220 caractères max
                            // pour rester visuellement autour de 2–3 lignes.
                            $shortBio = \Illuminate\Support\Str::limit(strip_tags($fullBio), 220, '…');
                          @endphp
                          
                          <!-- Sur la carte : on affiche uniquement l'aperçu $shortBio -->
                          <div class="freelancer-bio-wrapper">
                            <p class="freelancer-bio-v2">
                              {{ $shortBio }}
                            </p>
                          </div>
                          
                          <!-- Popularité -->
                          <div class="freelancer-popularity-v2">
                            <i class="fas fa-chart-line"></i>
                            <span style="white-space: nowrap;">{{ __('Très populaire') }}. {{ rand(10, 50) }} {{ __('réservations récentes') }}</span>
                          </div>
                          
                          <!-- Lien "En savoir plus" (aligné à gauche) -->
                          <a href="{{ route('freelance.show', $freelancer->id) }}" 
                             class="freelancer-learn-more-v2" target="_self">
                            {{ __('En savoir plus') }}
                          </a>
                        </div>
                      </div>

                      <!-- ============================================
                           COLONNE CENTRE : VIDÉE (Le contenu a été déplacé dans la colonne gauche)
                           ============================================ -->
                      <div class="freelancer-info-section">
                        <!-- La description "Spécialisé dans la création de landing pages..." a été déplacée sous "Freelance expert pour vos projets" dans la colonne gauche -->
                        <!-- Cette colonne peut être utilisée pour d'autres informations si nécessaire -->

              </div>

                      <!-- ============================================
                           COLONNE DROITE : TARIF / STATS / CTA
                           ============================================ -->
                      <div class="freelancer-pricing-section">
                        <!-- Icône Favoris (en haut à droite) -->
                        <button class="freelancer-favorite-btn" data-freelancer-id="{{ $freelancer->id }}" aria-label="Ajouter aux favoris">
                          <i class="far fa-heart"></i>
                        </button>

                        <!-- Prix mis en avant -->
                        <div class="freelancer-price-v2">
                          <div class="price-amount">{{ number_format($freelancer->hourly_rate, 0, ',', ' ') }} €</div>
                          <div class="price-label">{{ __('par Rituel') }} <span style="font-size: 0.7em; opacity: 0.85;">(= 1h)</span></div>
                </div>

                        <!-- Note + Avis sur une ligne -->
                        <div class="freelancer-rating-v2">
                          <div class="rating-number">{{ number_format($freelancer->reliability_score / 20 ?? 4.5, 1) }}</div>
                          <div class="rating-stars-v2">
                            <i class="fas fa-star"></i>
                </div>
                          <div class="rating-count">{{ rand(10, 100) }} {{ __('avis') }}</div>
                        </div>

                        <!-- Stats projets : 2 colonnes alignées -->
                        <div class="freelancer-stats-v2">
                          <div class="stat-item-v2">
                            <span class="stat-number">{{ $freelancer->subscriptions()->count() ?? 0 }}</span>
                            <span class="stat-label-v2">{{ __('projets livrés') }}</span>
                          </div>
                          <div class="stat-item-v2">
                            <span class="stat-number">{{ $freelancer->subscriptions()->where('status', 'active')->count() ?? 0 }}</span>
                            <span class="stat-label-v2">{{ __('clients récurrents') }}</span>
                          </div>
                        </div>

                        <!-- CTA Buttons -->
                        <div class="freelancer-cta-v2">
                          <a href="{{ route('freelance.show', $freelancer->id) }}#agenda" 
                             class="cta-primary-v2">
                            {{ __('Réserver 1h d\'essai') }}
                          </a>
                          <button type="button" class="cta-secondary-v2" data-bs-toggle="modal" data-bs-target="#contactModal{{ $freelancer->id }}" data-freelancer-id="{{ $freelancer->id }}">
                            {{ __('Envoyer un message') }}
                          </button>
              </div>
                      </div>
                      <!-- Fin du contenu principal -->
                    </div>
                    <!-- Fin du wrapper de contenu (réserve l'espace pour la vidéo) -->
            </div>

                    <!-- Quick View - Vidéo de présentation (positionnée à droite, en dehors du wrapper de contenu) -->
                    <div class="freelancer-quick-view-v2" data-freelancer-id="{{ $freelancer->id }}">
                      <div class="quick-view-content-v2">
                        <!-- Vidéo de présentation avec miniature réelle -->
                        <div class="quick-view-video-section">
                          <div class="video-thumbnail-wrapper">
                            @php
                              // Récupérer l'URL de la miniature vidéo (PRIORITÉ : vraie miniature, pas de gradient)
                              $thumbnailUrl = null;
                              $hasThumbnail = false;
                              
                              // Essayer plusieurs sources pour la miniature vidéo
                              $possibleThumbnailSources = [
                                $freelancer->video_thumbnail_url ?? null,
                                $freelancer->video_thumbnail ?? null,
                                $user->video_thumbnail_url ?? null,
                                $user->video_thumbnail ?? null,
                              ];
                              
                              foreach ($possibleThumbnailSources as $source) {
                                if (empty($source)) continue;
                                
                                // Vérifier si c'est une URL complète
                                if (filter_var($source, FILTER_VALIDATE_URL)) {
                                  $thumbnailUrl = $source;
                                  $hasThumbnail = true;
                                  break;
                                }
                                
                                // Vérifier si c'est un chemin relatif qui existe
                                $relativePath = ltrim($source, '/');
                                if (file_exists(public_path($relativePath))) {
                                  $thumbnailUrl = asset($relativePath);
                                  $hasThumbnail = true;
                                  break;
                                }
                                
                                // Essayer avec le préfixe assets/img/
                                if (file_exists(public_path('assets/img/' . $relativePath))) {
                                  $thumbnailUrl = asset('assets/img/' . $relativePath);
                                  $hasThumbnail = true;
                                  break;
                                }
                              }
                              
                              // Dernier recours : utiliser l'image placeholder si elle existe
                              if (!$hasThumbnail) {
                                $placeholderPaths = [
                                  'assets/img/video-placeholder.jpg',
                                  'assets/img/video-placeholder.png',
                                  'assets/front/img/video-placeholder.jpg',
                                ];
                                
                                foreach ($placeholderPaths as $path) {
                                  if (file_exists(public_path($path))) {
                                    $thumbnailUrl = asset($path);
                                    $hasThumbnail = true;
                                    break;
                                  }
                                }
                              }
                              
                              // Récupérer l'URL de la vidéo
                              $videoUrl = $freelancer->video_url ?? $user->video_url ?? null;
                            @endphp
                            
                            @if($hasThumbnail && !empty($thumbnailUrl))
                              <!-- VRAIE MINIATURE VIDÉO (pas de gradient) -->
                              <img src="{{ $thumbnailUrl }}" 
                                   alt="Vidéo de présentation - {{ $displayName }}" 
                                   class="video-thumbnail-img"
                                   loading="lazy"
                                   onerror="this.onerror=null; this.style.display='none'; this.parentElement.querySelector('.video-placeholder-fallback').style.display='flex';">
                            @endif
                            
                            <!-- Fallback élégant avec dégradé violet UNIQUEMENT si aucune miniature n'est disponible -->
                            <div class="video-placeholder-fallback" style="display: {{ ($hasThumbnail && !empty($thumbnailUrl)) ? 'none' : 'flex' }}; flex-direction: column; align-items: center; justify-content: center; width: 100%; height: 100%; background: linear-gradient(135deg, #6366F1 0%, #8B5CF6 50%, #7C3AED 100%); color: white; text-align: center; position: absolute; top: 0; left: 0; right: 0; bottom: 0; z-index: 1;">
                              <div style="position: relative; z-index: 2; display: flex; flex-direction: column; align-items: center; gap: 16px;">
                                <div style="width: 80px; height: 80px; background: rgba(255, 255, 255, 0.2); backdrop-filter: blur(10px); border-radius: 50%; display: flex; align-items: center; justify-content: center; border: 2px solid rgba(255, 255, 255, 0.3);">
                                  <i class="fas fa-video" style="font-size: 36px; opacity: 0.95;"></i>
                                </div>
                              </div>
                              <!-- Overlay subtil pour plus de profondeur -->
                              <div style="position: absolute; top: 0; left: 0; right: 0; bottom: 0; background: radial-gradient(circle at 30% 40%, rgba(255, 255, 255, 0.1) 0%, transparent 60%); pointer-events: none; z-index: 1;"></div>
                            </div>
                            
                            <!-- Bouton Play centré (toujours visible) -->
                            <button class="video-play-btn-v2" data-freelancer-id="{{ $freelancer->id }}" data-video-url="{{ $videoUrl ?? '' }}" aria-label="{{ __('Lire la vidéo de présentation') }}" style="z-index: 10;">
                              <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="rgba(255, 255, 255, 0.9)" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                <polygon points="6 4 18 12 6 20 6 4" fill="rgba(255, 255, 255, 0.15)"></polygon>
                              </svg>
                            </button>
                            
                          </div>
                        </div>

                        <!-- Boutons d'action -->
                        <div class="quick-view-actions-v2">
                          <a href="{{ route('freelance.show', $freelancer->id) }}" 
                             class="quick-view-btn-primary-v2">
                            Voir le profil de {{ $displayName }}
                          </a>
                          <a href="{{ route('freelance.show', $freelancer->id) }}#agenda" 
                             class="quick-view-btn-secondary-v2">
                            {{ __('Voir tout l\'agenda') }}
                          </a>
                        </div>
                      </div>
                    </div>
                    <!-- Fin de la carte vidéo (positionnée à droite, en dehors du wrapper de contenu) -->
                  </div>
                </div>
            @endforeach
            @endif
          </div>
          </div>
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
  function openPersonalizeModal() {
    // Fonctionnalité désactivée
  }

  function sortTeachers(value) {
    // Appliquer le tri via AJAX
    applyFiltersAjax({
      sort: value
    });
  }
  
  // Gérer le changement du select de tri
  const sortSelect = document.getElementById('sortSelect');
  if (sortSelect) {
    sortSelect.addEventListener('change', function(e) {
      e.preventDefault();
      e.stopPropagation();
      sortTeachers(this.value);
    }, true);
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

  // Gestion du dropdown des catégories avec sous-domaines
  function toggleCategoryPanel() {
    const panel = document.getElementById('categoryPanel');
    const trigger = document.getElementById('categoryTrigger');
    
    if (panel.classList.contains('active')) {
      panel.classList.remove('active');
      trigger.classList.remove('active');
    } else {
      panel.classList.add('active');
      trigger.classList.add('active');
    }
  }

  function toggleDomainSubdomains(domainHeader) {
    const subdomains = domainHeader.nextElementSibling;
    const arrow = domainHeader.querySelector('.category-domain-arrow');
    
    if (subdomains && subdomains.classList.contains('category-subdomains')) {
      if (subdomains.style.display === 'none') {
        subdomains.style.display = 'block';
        domainHeader.classList.add('active');
      } else {
        subdomains.style.display = 'none';
        domainHeader.classList.remove('active');
      }
    }
  }

  // Initialiser les boutons de temps et jours
  document.addEventListener('DOMContentLoaded', function() {
    // Gestion du dropdown des domaines
    const domainTrigger = document.getElementById('domainDropdownTrigger');
    const domainMenu = document.getElementById('domainDropdownMenu');
    const domainArrow = document.getElementById('domainArrow');
    
    if (domainTrigger && domainMenu) {
      // Ouvrir/fermer le menu principal
      domainTrigger.addEventListener('click', function(e) {
        e.stopPropagation();
        const isOpen = domainMenu.style.display === 'block';
        domainMenu.style.display = isOpen ? 'none' : 'block';
        domainTrigger.classList.toggle('active', !isOpen);
        if (domainArrow) {
          domainArrow.style.transform = isOpen ? 'rotate(0deg)' : 'rotate(180deg)';
        }
      });

      // Fermer le menu en cliquant en dehors
      document.addEventListener('click', function(e) {
        if (!domainMenu.contains(e.target) && !domainTrigger.contains(e.target)) {
          domainMenu.style.display = 'none';
          domainTrigger.classList.remove('active');
          if (domainArrow) {
            domainArrow.style.transform = 'rotate(0deg)';
          }
        }
      });

      // Gestion de l'ouverture/fermeture des sous-domaines
      const domainOptionMains = document.querySelectorAll('.domain-option-main');
      domainOptionMains.forEach(optionMain => {
        const hasSubdomains = optionMain.getAttribute('data-has-subdomains') === 'true';
        if (hasSubdomains) {
          optionMain.addEventListener('click', function(e) {
            e.stopPropagation();
            const submenu = this.nextElementSibling;
            const arrow = this.querySelector('.domain-arrow-inline');
            
            if (submenu && submenu.classList.contains('domain-submenu')) {
              const isOpen = submenu.style.display === 'block';
              submenu.style.display = isOpen ? 'none' : 'block';
              this.classList.toggle('expanded', !isOpen);
              if (arrow) {
                arrow.style.transform = isOpen ? 'rotate(0deg)' : 'rotate(90deg)';
              }
            }
          });
        } else {
          // Si pas de sous-domaines, sélectionner directement
          optionMain.addEventListener('click', function(e) {
            e.stopPropagation();
            const value = this.getAttribute('data-value');
            const text = this.querySelector('span').textContent;
            
            document.getElementById('domainInput').value = value;
            document.getElementById('domainSelectedText').textContent = text;
            
            // Mettre à jour la sélection visuelle
            document.querySelectorAll('.domain-option, .domain-option-main').forEach(opt => {
              opt.classList.remove('selected');
            });
            this.classList.add('selected');
            
            // Fermer le menu
            domainMenu.style.display = 'none';
            domainTrigger.classList.remove('active');
            if (domainArrow) {
              domainArrow.style.transform = 'rotate(0deg)';
            }
            var spMap = window.__domainSpecializations; var opts = (spMap && spMap[value]) ? spMap[value] : [];
            var w = document.getElementById('specializationFilterWrapper'); var s = document.getElementById('specializationSelect');
            if (w && s) { if (opts.length) { w.style.display = ''; s.innerHTML = '<option value="">Spécialisation</option>'; opts.forEach(function(o) { var opt = document.createElement('option'); opt.value = o[0]; opt.textContent = o[1]; s.appendChild(opt); }); s.value = ''; } else { w.style.display = 'none'; s.value = ''; s.innerHTML = '<option value="">Spécialisation</option>'; } }
            applyFiltersAjax({
              category: value
            });
          });
        }
      });

      // Gestion de la sélection des sous-domaines
      const domainSuboptions = document.querySelectorAll('.domain-suboption');
      domainSuboptions.forEach(suboption => {
        suboption.addEventListener('click', function(e) {
          e.stopPropagation();
          const value = this.getAttribute('data-value');
          const text = this.querySelector('span').textContent;
          
          document.getElementById('domainInput').value = value;
          document.getElementById('domainSelectedText').textContent = text;
          var d = document.getElementById('domainPremiumDesc'); var txt = document.getElementById('domainPremiumDescText');
          var map = window.__domainLongDescriptions;
          if (d && txt && map && map[value]) { txt.textContent = map[value]; d.style.display = 'block'; } else if (d) d.style.display = 'none';
          var spMap = window.__domainSpecializations; var opts = (spMap && spMap[value]) ? spMap[value] : [];
          var w = document.getElementById('specializationFilterWrapper'); var s = document.getElementById('specializationSelect');
          if (w && s) { if (opts.length) { w.style.display = ''; s.innerHTML = '<option value="">Spécialisation</option>'; opts.forEach(function(o) { var opt = document.createElement('option'); opt.value = o[0]; opt.textContent = o[1]; s.appendChild(opt); }); s.value = ''; } else { w.style.display = 'none'; s.value = ''; s.innerHTML = '<option value="">Spécialisation</option>'; } }
          // Mettre à jour la sélection visuelle
          document.querySelectorAll('.domain-option, .domain-option-main').forEach(opt => {
            opt.classList.remove('selected');
          });
          this.classList.add('selected');
          domainMenu.style.display = 'none';
          domainTrigger.classList.remove('active');
          if (domainArrow) {
            domainArrow.style.transform = 'rotate(0deg)';
          }
          applyFiltersAjax({
            category: value
          });
        });
      });

      // Gestion de "Tous les domaines" (uniquement menu avancé #domainDropdownMenu, pas le hero)
      const allDomainsOption = document.querySelector('#domainDropdownMenu .domain-option[data-value=""]');
      if (allDomainsOption) {
        allDomainsOption.addEventListener('click', function(e) {
          e.stopPropagation();
          document.getElementById('domainInput').value = '';
          document.getElementById('domainSelectedText').textContent = 'Tous les domaines';
          var d = document.getElementById('domainPremiumDesc'); if (d) d.style.display = 'none';
          var w = document.getElementById('specializationFilterWrapper'); var s = document.getElementById('specializationSelect');
          if (w) w.style.display = 'none'; if (s) s.value = '';
          
          document.querySelectorAll('.domain-option, .domain-option-main').forEach(opt => {
            opt.classList.remove('selected');
          });
          this.classList.add('selected');
          
          domainMenu.style.display = 'none';
          domainTrigger.classList.remove('active');
          if (domainArrow) {
            domainArrow.style.transform = 'rotate(0deg)';
          }
          
          // Appliquer via AJAX
          applyFiltersAjax({
            category: ''
          });
        });
      }

      // Gestion des domaines V1 (uniquement menu avancé #domainDropdownMenu, pas le hero projects)
      document.querySelectorAll('#domainDropdownMenu .domain-option[data-value]').forEach(function(opt) {
        if (opt.getAttribute('data-value') === '') return;
        opt.addEventListener('click', function(e) {
          e.stopPropagation();
          var value = this.getAttribute('data-value');
          var labelEl = this.querySelector('.domain-option-label') || this.querySelector('span');
          var text = labelEl ? labelEl.textContent.trim() : value;
          var domainInput = document.getElementById('domainInput');
          var domainSelectedText = document.getElementById('domainSelectedText');
          if (domainInput) domainInput.value = value;
          if (domainSelectedText) domainSelectedText.textContent = text;
          document.querySelectorAll('.domain-option, .domain-option-main').forEach(function(o) { o.classList.remove('selected'); });
          this.classList.add('selected');
          domainMenu.style.display = 'none';
          domainTrigger.classList.remove('active');
          if (domainArrow) domainArrow.style.transform = 'rotate(0deg)';
          var d = document.getElementById('domainPremiumDesc'); var txt = document.getElementById('domainPremiumDescText');
          var map = window.__domainLongDescriptions;
          if (d && txt && map && map[value]) { txt.textContent = map[value]; d.style.display = 'block'; } else if (d) d.style.display = 'none';
          var spMap = window.__domainSpecializations; var opts = (spMap && spMap[value]) ? spMap[value] : [];
          var w = document.getElementById('specializationFilterWrapper'); var s = document.getElementById('specializationSelect');
          if (w && s) { if (opts.length) { w.style.display = ''; s.innerHTML = '<option value="">Spécialisation</option>'; opts.forEach(function(o) { var opt = document.createElement('option'); opt.value = o[0]; opt.textContent = o[1]; s.appendChild(opt); }); s.value = ''; } else { w.style.display = 'none'; s.value = ''; s.innerHTML = '<option value="">Spécialisation</option>'; } }
          if (typeof applyFiltersAjax === 'function') applyFiltersAjax({ category: value });
        });
      });

      // Restaurer la sélection actuelle
      const currentDomain = document.getElementById('domainInput')?.value || '';
      if (currentDomain) {
        const selectedOption = document.querySelector(`[data-value="${currentDomain}"]`);
        if (selectedOption) {
          selectedOption.classList.add('selected');
          const selectedText = selectedOption.querySelector('span')?.textContent;
          if (selectedText) {
            document.getElementById('domainSelectedText').textContent = selectedText;
          }
        }
      }
      var d = document.getElementById('domainPremiumDesc'); var map = window.__domainLongDescriptions;
      if (d && map && currentDomain && map[currentDomain]) {
        var txt = document.getElementById('domainPremiumDescText'); if (txt) txt.textContent = map[currentDomain];
        d.style.display = 'block';
      } else if (d) d.style.display = 'none';
      var spMap = window.__domainSpecializations; var opts = (spMap && spMap[currentDomain]) ? spMap[currentDomain] : [];
      var w = document.getElementById('specializationFilterWrapper'); var s = document.getElementById('specializationSelect');
      if (w && s && opts.length) {
        w.style.display = ''; s.innerHTML = '<option value="">Spécialisation</option>';
        opts.forEach(function(o) { var opt = document.createElement('option'); opt.value = o[0]; opt.textContent = o[1]; s.appendChild(opt); });
        var init = w.getAttribute('data-initial-specialization') || '';
        s.value = (init && opts.some(function(o){ return o[0]===init; })) ? init : '';
      } else if (w) w.style.display = 'none';
    }

    // Gestion du dropdown Mon expérience (ouvert vers le haut)
    const experienceTrigger = document.getElementById('experienceDropdownTrigger');
    const experienceMenu = document.getElementById('experienceDropdownMenu');
    const experienceLevelInput = document.getElementById('experienceLevelInput');
    const experienceSelectedText = document.getElementById('experienceSelectedText');
    const experienceArrow = document.getElementById('experienceArrow');

    if (experienceTrigger && experienceMenu && experienceLevelInput && experienceSelectedText) {
      experienceTrigger.addEventListener('click', function(e) {
        e.stopPropagation();
        const isOpen = experienceMenu.style.display === 'block';
        experienceMenu.style.display = isOpen ? 'none' : 'block';
        experienceTrigger.classList.toggle('active', !isOpen);
        if (experienceArrow) {
          experienceArrow.style.transform = isOpen ? 'rotate(0deg)' : 'rotate(180deg)';
        }
      });

      document.addEventListener('click', function(e) {
        if (!experienceMenu.contains(e.target) && !experienceTrigger.contains(e.target)) {
          experienceMenu.style.display = 'none';
          experienceTrigger.classList.remove('active');
          if (experienceArrow) {
            experienceArrow.style.transform = 'rotate(0deg)';
          }
        }
      });

      document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && experienceMenu.style.display === 'block') {
          experienceMenu.style.display = 'none';
          experienceTrigger.classList.remove('active');
          if (experienceArrow) {
            experienceArrow.style.transform = 'rotate(0deg)';
          }
        }
      });

      document.querySelectorAll('.experience-option').forEach(function(opt) {
        opt.addEventListener('click', function(e) {
          e.stopPropagation();
          const value = this.getAttribute('data-value');
          const text = this.textContent.trim();
          experienceLevelInput.value = value;
          experienceSelectedText.textContent = text;
          document.querySelectorAll('.experience-option').forEach(function(o) { o.classList.remove('selected'); });
          this.classList.add('selected');
          experienceMenu.style.display = 'none';
          experienceTrigger.classList.remove('active');
          if (experienceArrow) {
            experienceArrow.style.transform = 'rotate(0deg)';
          }
          if (typeof applyFiltersAjax === 'function') {
            applyFiltersAjax({ experience_level: value });
          } else {
            var f = document.getElementById('preplyFiltersForm');
            if (f) f.submit();
          }
        });
      });

      // Restaurer la sélection actuelle
      const currentExp = experienceLevelInput.value || '';
      var expOpt = document.querySelector('.experience-option[data-value="' + currentExp + '"]');
      if (expOpt) {
        expOpt.classList.add('selected');
      }
    }

    // Gestion du dropdown des catégories (ancien code - à supprimer si non utilisé)
    const categoryTrigger = document.getElementById('categoryTrigger');
    const categoryPanel = document.getElementById('categoryPanel');
    
    if (categoryTrigger && categoryPanel) {
      categoryTrigger.addEventListener('click', function(e) {
        e.stopPropagation();
        toggleCategoryPanel();
      });

      // Fermer le panel en cliquant en dehors
      document.addEventListener('click', function(e) {
        if (!categoryPanel.contains(e.target) && !categoryTrigger.contains(e.target)) {
          categoryPanel.classList.remove('active');
          categoryTrigger.classList.remove('active');
        }
      });

      // Gestion des domaines avec sous-domaines
      const domainHeaders = document.querySelectorAll('.category-domain-header');
      domainHeaders.forEach(header => {
        header.addEventListener('click', function(e) {
          e.stopPropagation();
          toggleDomainSubdomains(this);
        });
      });

      // Gestion de la sélection d'une catégorie
      const categoryOptions = document.querySelectorAll('.category-option');
      categoryOptions.forEach(option => {
        option.addEventListener('click', function(e) {
          e.stopPropagation();
          const category = this.getAttribute('data-category');
          const categoryInput = document.getElementById('categoryInput');
          const selectedText = this.querySelector('span').textContent;
          
          // Mettre à jour l'input caché
          if (categoryInput) {
            categoryInput.value = category;
          }
          
          // Mettre à jour le texte affiché
          const selectedTextElement = document.querySelector('.category-selected-text');
          if (selectedTextElement) {
            selectedTextElement.textContent = selectedText;
          }
          
          // Mettre à jour la sélection visuelle
          categoryOptions.forEach(opt => opt.classList.remove('selected'));
          this.classList.add('selected');
          
          // Fermer le panel
          categoryPanel.classList.remove('active');
          categoryTrigger.classList.remove('active');
          
          // Appliquer via AJAX
          applyFiltersAjax({
            category: category
          });
        });
      });

      // Restaurer la sélection actuelle
      const currentCategory = document.getElementById('categoryInput')?.value || '';
      if (currentCategory) {
        categoryOptions.forEach(option => {
          if (option.getAttribute('data-category') === currentCategory) {
            option.classList.add('selected');
          }
        });
      }
    }

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
    const form = document.getElementById('preplyFiltersForm');
    if (!form) return;
    
    // Construire les paramètres de disponibilité
    const params = {};
    if (selectedTimes.length > 0) {
      params.availability_times = selectedTimes;
    }
    if (selectedDays.length > 0) {
      params.availability_days = selectedDays;
    }
    
    // Fermer le panneau
    toggleAvailabilityPanel();
    
    // Appliquer via AJAX
    applyFiltersAjax(params);
  }

  // AbortController pour annuler les requêtes précédentes
  let currentAbortController = null;

  // Fonction AJAX pour appliquer les filtres sans rechargement
  function applyFiltersAjax(params) {
    const resultsSection = document.getElementById('results');
    const resultsContainer = document.getElementById('resultsContainer');
    
    if (!resultsSection || !resultsContainer) {
      console.warn('Results section or container not found');
      return;
    }
    
    // Détecter si c'est un filtre de langue ou pays (loader discret)
    const isLanguageFilter = params && (
      params.hasOwnProperty('teacher_speaks') ||
      params.hasOwnProperty('native_only') ||
      params.hasOwnProperty('super_only') ||
      params.hasOwnProperty('qualified_only') ||
      params.hasOwnProperty('country')
    );
    
    // Annuler la requête précédente si elle existe
    if (currentAbortController) {
      currentAbortController.abort();
    }
    currentAbortController = new AbortController();
    
    // Ajouter loading state selon le type de filtre
    if (isLanguageFilter) {
      // Loader discret pour filtres de langue : pas d'overlay, juste opacity + spinner
      resultsSection.classList.remove('is-loading');
      resultsSection.classList.add('is-loading-language');
      resultsContainer.style.opacity = '0.6';
      resultsContainer.style.pointerEvents = 'none';
    } else {
      // Loader standard pour autres filtres
      resultsSection.classList.remove('is-loading-language');
      resultsSection.classList.add('is-loading');
      resultsContainer.style.opacity = '0.5';
      resultsContainer.style.pointerEvents = 'none';
    }
    
    // Construire la query string
    const form = document.getElementById('preplyFiltersForm');
    const formData = new FormData(form);
    const searchParams = new URLSearchParams();
    
    // Ajouter tous les paramètres du formulaire
    for (const [key, value] of formData.entries()) {
      if (value) {
        searchParams.append(key, value);
      }
    }
    
    // Ajouter les paramètres spécifiques si fournis
    if (params) {
      Object.keys(params).forEach(key => {
        const value = params[key];
        // Supprimer d'abord toutes les occurrences de ce paramètre
        searchParams.delete(key);
        
        if (value !== null && value !== undefined && value !== '') {
          // Si c'est un tableau, ajouter chaque valeur
          if (Array.isArray(value) && value.length > 0) {
            value.forEach(v => {
              searchParams.append(key + '[]', v);
            });
          } else if (!Array.isArray(value)) {
            // Sinon, ajouter la valeur simple
            searchParams.set(key, value);
          }
        }
      });
    }
    
    const queryString = searchParams.toString();
    const url = form.action + (queryString ? '?' + queryString : '');
    
    // Mettre à jour l'URL sans rechargement
    window.history.replaceState({}, '', url);
    
    // Fetch AJAX
    fetch(url, {
      method: 'GET',
      headers: {
        'Accept': 'text/html',
        'X-Requested-With': 'XMLHttpRequest'
      },
      signal: currentAbortController.signal
    })
    .then(response => {
      if (!response.ok) {
        throw new Error('Network response was not ok');
      }
      return response.text();
    })
    .then(html => {
      // Parser la réponse HTML
      const parser = new DOMParser();
      const doc = parser.parseFromString(html, 'text/html');
      
      // Extraire uniquement la section résultats
      const newResultsSection = doc.querySelector('.preply-results-section');
      
      if (newResultsSection) {
        // Remplacer uniquement le contenu de la section résultats
        resultsSection.innerHTML = newResultsSection.innerHTML;
        
        // Réinjecter le spinner dans le header si nécessaire (pour les filtres de langue)
        const resultsHeader = resultsSection.querySelector('.preply-results-header');
        const resultsCount = resultsHeader?.querySelector('.preply-results-count');
        if (resultsCount && !resultsCount.querySelector('.language-loader')) {
          const spinner = document.createElement('span');
          spinner.className = 'language-loader';
          spinner.innerHTML = '<span class="language-loader-spinner"></span>';
          resultsCount.appendChild(spinner);
        }
        
        // Réinitialiser les listeners après le remplacement du DOM
        const newSortSelect = document.getElementById('sortSelect');
        if (newSortSelect) {
          newSortSelect.addEventListener('change', function(e) {
            e.preventDefault();
            e.stopPropagation();
            sortTeachers(this.value);
          }, true);
        }
      }
      
      // Retirer loading state
      resultsSection.classList.remove('is-loading', 'is-loading-language');
      if (resultsContainer) {
        resultsContainer.style.opacity = '1';
        resultsContainer.style.pointerEvents = 'auto';
      }
    })
    .catch(error => {
      // Ignorer les erreurs d'annulation (AbortError)
      if (error.name === 'AbortError') {
        return;
      }
      
      console.error('Error applying filters:', error);
      
      // Retirer loading state
      resultsSection.classList.remove('is-loading', 'is-loading-language');
      if (resultsContainer) {
        resultsContainer.style.opacity = '1';
        resultsContainer.style.pointerEvents = 'auto';
      }
      
      // Afficher message d'erreur discret
      const form = document.getElementById('preplyFiltersForm');
      if (!form) return;
      
      const existingError = form.querySelector('.filter-error-message');
      if (existingError) {
        existingError.remove();
      }
      
      const errorMsg = document.createElement('div');
      errorMsg.className = 'filter-error-message';
      errorMsg.style.cssText = 'padding: 8px 12px; margin-top: 8px; background: #FEE2E2; color: #991B1B; border-radius: 6px; font-size: 0.875rem;';
      errorMsg.textContent = 'Impossible de charger les résultats. Réessayez.';
      form.appendChild(errorMsg);
      
      setTimeout(() => {
        if (errorMsg.parentNode) {
          errorMsg.remove();
        }
      }, 5000);
    });
  }

  // Flag pour indiquer qu'un changement sur les filtres de langue vient d'avoir lieu
  let languageFilterChanged = false;
  
  // Empêcher le submit du formulaire si déclenché par "Je parle" ou "Langue maternelle"
  function preventLanguageFiltersSubmit() {
    const preplyFiltersForm = document.getElementById('preplyFiltersForm');
    if (preplyFiltersForm) {
      preplyFiltersForm.addEventListener('submit', function(e) {
        // Si un changement sur les filtres de langue vient d'avoir lieu, empêcher le submit
        if (languageFilterChanged) {
        e.preventDefault();
        e.stopPropagation();
        e.stopImmediatePropagation();
          languageFilterChanged = false; // Réinitialiser le flag
        return false;
      }
      }, true); // Capture phase pour intercepter avant les autres handlers
    }
  }
  
  // Initialiser la protection au chargement
  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', preventLanguageFiltersSubmit);
  } else {
    preventLanguageFiltersSubmit();
  }

  // Auto-apply moderne pour tous les dropdowns avec debounce
  (function() {
    let debounceTimer = null;
    const DEBOUNCE_DELAY = 200; // 200ms debounce
    
    function submitForm() {
      if (debounceTimer) {
        clearTimeout(debounceTimer);
      }
      debounceTimer = setTimeout(() => {
        // Appliquer tous les filtres via AJAX
        applyFiltersAjax({});
      }, DEBOUNCE_DELAY);
    }
    
    // Auto-apply pour tous les selects (Budget uniquement maintenant)
    document.querySelectorAll('.preply-filter-select').forEach(el => {
      // Exclure teacherSpeaksFilter car il n'existe plus (remplacé par dropdown premium)
      if (el.id === 'teacherSpeaksFilter') {
        return;
      }
      
      // Exclure nativeLanguageFilter car il n'existe plus (remplacé par popover premium)
      if (el.id === 'nativeLanguageFilter') {
        return;
      }
      
      el.addEventListener('change', function(e) {
        
        submitForm();
      }, true); // Capture phase pour intercepter avant les autres listeners
    });
    
    // Auto-apply pour les autres inputs
    document.querySelectorAll('.preply-filter-input').forEach(el => {
      if (el.id === 'teacherSpeaksOther') {
        return; // Exclure le champ "Autre..." de "Je parle" (si encore présent)
      }
      el.addEventListener('change', function(e) {
        submitForm();
      }, false);
    });
  })();

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
          <div id="popover-placeholder" style="width: 100%; height: 100%; background: linear-gradient(135deg, #8B5CF6 0%, #A78BFA 50%, #2563EB 100%); display: flex; align-items: center; justify-content: center; color: white;">
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

  // Fonction pour convertir une URL vidéo en URL embed
  function convertToEmbedUrl(url) {
    if (!url) return null;
    
    // YouTube
    const youtubeRegex = /(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/;
    const youtubeMatch = url.match(youtubeRegex);
    if (youtubeMatch) {
      return 'https://www.youtube.com/embed/' + youtubeMatch[1];
    }
    
    // Vimeo
    const vimeoRegex = /(?:vimeo\.com\/)(\d+)/;
    const vimeoMatch = url.match(vimeoRegex);
    if (vimeoMatch) {
      return 'https://player.vimeo.com/video/' + vimeoMatch[1];
    }
    
    // Si c'est déjà une URL embed, la retourner telle quelle
    if (url.includes('youtube.com/embed') || url.includes('player.vimeo.com')) {
      return url;
    }
    
    // Si c'est une URL de vidéo directe (.mp4, .webm, etc.), la retourner telle quelle
    if (url.match(/\.(mp4|webm|ogg|mov)(\?.*)?$/i)) {
      return url;
    }
    
    // Par défaut, retourner l'URL originale
    return url;
  }

  // Gestionnaire pour le bouton play de la carte vidéo
  document.addEventListener('DOMContentLoaded', function() {
    const videoModal = document.getElementById('videoModal');
    const videoModalContent = document.getElementById('videoModalContent');
    const videoModalClose = document.getElementById('videoModalClose');
    
    // Fonction pour ouvrir la modale vidéo
    function openVideoModal(videoUrl) {
      const embedUrl = convertToEmbedUrl(videoUrl);
      
      if (embedUrl.includes('youtube.com/embed') || embedUrl.includes('player.vimeo.com')) {
        // Vidéo YouTube ou Vimeo - utiliser iframe
        videoModalContent.innerHTML = '<iframe src="' + embedUrl + '?autoplay=1" allow="autoplay; fullscreen" allowfullscreen></iframe>';
      } else if (embedUrl.match(/\.(mp4|webm|ogg|mov)(\?.*)?$/i)) {
        // Vidéo directe - utiliser balise video
        videoModalContent.innerHTML = '<video controls autoplay style="width: 100%; height: 100%;"><source src="' + embedUrl + '" type="video/mp4">Votre navigateur ne supporte pas la lecture de vidéos.</video>';
      } else {
        // Fallback - rediriger vers l'URL originale
        window.open(videoUrl, '_blank');
        return;
      }
      
      videoModal.classList.add('active');
      document.body.style.overflow = 'hidden';
    }
    
    // Fonction pour fermer la modale vidéo
    function closeVideoModal() {
      videoModal.classList.remove('active');
      videoModalContent.innerHTML = '';
      document.body.style.overflow = '';
    }
    
    // Fermer la modale au clic sur le bouton fermer
    if (videoModalClose) {
      videoModalClose.addEventListener('click', closeVideoModal);
    }
    
    // Fermer la modale au clic sur l'overlay (mais pas sur le conteneur)
    if (videoModal) {
      videoModal.addEventListener('click', function(e) {
        if (e.target === videoModal) {
          closeVideoModal();
        }
      });
    }
    
    // Fermer la modale avec la touche ESC
    document.addEventListener('keydown', function(e) {
      if (e.key === 'Escape' && videoModal.classList.contains('active')) {
        closeVideoModal();
      }
    });
    
    // Gestionnaire pour les boutons play
    document.querySelectorAll('.video-play-btn-v2').forEach(function(btn) {
      btn.addEventListener('click', function(e) {
        e.preventDefault();
        e.stopPropagation();
        const videoUrl = this.getAttribute('data-video-url');
        if (videoUrl && videoUrl !== '') {
          openVideoModal(videoUrl);
        } else {
          // Si pas d'URL vidéo, rediriger vers le profil
          const freelancerId = this.getAttribute('data-freelancer-id');
          if (freelancerId) {
            window.location.href = '/freelance/' + freelancerId + '#video';
          }
        }
      });
    });
  });

  // ============================================
  // ESTIMATION BUDGET HEURES / RITUELS + EXPRESS
  // Utilise express:changed (module expressOptions.js)
  // ============================================
  (function() {
    'use strict';
    const STORAGE_KEY = 'junspro_day_base_hours';
    var expressMultiplier = 1;
    var updateBudgetEstimateRef = null;
    function getBaseHours() {
      var v = parseInt(localStorage.getItem(STORAGE_KEY), 10);
      return (v === 7 || v === 8) ? v : 7;
    }
    function setBaseHours(v) {
      localStorage.setItem(STORAGE_KEY, String(v));
    }
    function getExpressMultiplier() {
      syncExpressFromDom();
      return expressMultiplier;
    }
    function syncExpressFromDom() {
      var input = document.querySelector('[data-express-input]');
      var mode = (input && input.value) ? input.value : 'none';
      expressMultiplier = { none: 1, '24': 1.3, '48': 1.2, '72': 1.1 }[mode] || 1;
    }
    window.addEventListener('express:changed', function(e) {
      expressMultiplier = e.detail && e.detail.multiplier ? e.detail.multiplier : 1;
      if (updateBudgetEstimateRef) updateBudgetEstimateRef();
    });
    function syncToggleUI(base) {
      document.querySelectorAll('.engagement-base-btn').forEach(function(btn) {
        if (parseInt(btn.getAttribute('data-base'), 10) === base) {
          btn.classList.add('is-active');
        } else {
          btn.classList.remove('is-active');
        }
      });
    }
    
    // Fonction d'initialisation qui s'exécute quand le DOM est prêt
    function initBudgetEstimate() {
      const budgetSelect = document.getElementById('budgetFilter');
      const estimateElement = document.getElementById('budgetEstimate');
      
      if (!budgetSelect || !estimateElement) {
        console.warn('Budget estimate elements not found');
        return;
      }
    
      // Mapping des valeurs du select vers les budgets réels
      // Soft launch : 4 paliers visibles uniquement
      const budgetMapping = {
        // Paliers visibles (soft launch)
        '0-1000': { min: 0, max: 1000 },
        '1000-2500': { min: 1000, max: 2500 },
        '2500-5000': { min: 2500, max: 5000 },
        '5000-10000': { min: 5000, max: 10000 },
        // Paliers masqués (soft launch) - conservés pour réactivation future
        '10000-20000': { min: 10000, max: 20000 },
        '20000-60000': { min: 20000, max: 60000 },
        '60000+': { min: 60000, max: 999999 },
        // Compatibilité avec anciennes valeurs (si présentes dans l'URL)
        '3-20': { min: 0, max: 500 },
        '20-30': { min: 500, max: 1000 },
        '30-40': { min: 1000, max: 2000 },
        '40-50': { min: 2000, max: 5000 },
        '50+': { min: 5000, max: 999999 }
      };
      
      // Fonction pour calculer la médiane d'un tableau
      function median(arr) {
        if (arr.length === 0) return 0;
        const sorted = [...arr].sort((a, b) => a - b);
        const mid = Math.floor(sorted.length / 2);
        if (sorted.length % 2 === 0) {
          return (sorted[mid - 1] + sorted[mid]) / 2;
        }
        return sorted[mid];
      }
      
      // Fonction pour récupérer les hourly rates des cartes visibles
      // Cherche data-hourly-rate OU data-ritual-rate
      function getVisibleHourlyRates() {
        const cards = document.querySelectorAll('.preply-teacher-card[data-hourly-rate], .preply-teacher-card[data-ritual-rate], .freelancer-card-premium-v2[data-hourly-rate], .freelancer-card-premium-v2[data-ritual-rate]');
        const rates = [];
        
        cards.forEach(function(card) {
          // Essayer d'abord data-hourly-rate, puis data-ritual-rate
          let rate = parseFloat(card.getAttribute('data-hourly-rate'));
          if (isNaN(rate) || rate <= 0) {
            rate = parseFloat(card.getAttribute('data-ritual-rate'));
          }
          if (!isNaN(rate) && rate >= 1) {
            rates.push(rate);
          }
        });
        
        return rates;
      }
      
      // Fonction pour obtenir le taux à utiliser (médiane ou premier)
      function getRateToUse(rates) {
        if (rates.length === 0) return null;
        if (rates.length === 1 || rates.length === 2) {
          return rates[0]; // Prendre le premier si 1-2 freelances
        }
        return median(rates); // Médiane si 3+ freelances
      }
      
      // Fonction pour formater un nombre (entier si >= 1 ou == 0, sinon 1 décimale)
      function formatEstimate(num) {
        if (num === 0 || num >= 1) {
          return Math.round(num).toString();
        } else {
          return num.toFixed(1);
        }
      }
      
      // Fonction pour calculer et afficher l'estimation
      function updateBudgetEstimate() {
        const selectedValue = budgetSelect.value;
        
        // Si aucun budget sélectionné
        if (!selectedValue || !budgetMapping[selectedValue]) {
          estimateElement.textContent = 'Sélectionnez un engagement pour afficher une estimation en rituels.';
          return;
        }
        
        const budget = budgetMapping[selectedValue];
        const rates = getVisibleHourlyRates();
        
        // Tarif de référence : cartes visibles ou fallback (39 €/h) pour afficher une estimation même sans résultats
        const FALLBACK_RATE = 39;
        let rateBase = (rates.length > 0) ? getRateToUse(rates) : null;
        if (!rateBase || rateBase <= 0) rateBase = FALLBACK_RATE;
        // Express : multiplicateur appliqué UNIQUEMENT aux montants € affichés, jamais aux heures/rituels
        const expressMult = getExpressMultiplier();
        const rate = rateBase * expressMult;
        
        // ============================================
        // CALCUL ESTIMATION EN RITUELS (système actuel)
        // Volume/heures inchangés — Express n'ajoute pas d'heures
        // ============================================
        let rituelsMin, rituelsMax;
        let isUnlimited = false;
        
        if (budget.max === 999999) {
          rituelsMin = Math.ceil(budget.min / rateBase);
          isUnlimited = true;
        } else {
          rituelsMin = Math.ceil(budget.min / rateBase);
          rituelsMax = Math.floor(budget.max / rateBase);
        }
        
        // Les heures = rituels (1 rituel = 1 heure)
        const hoursMin = rituelsMin;
        const hoursMax = isUnlimited ? null : rituelsMax;
        
        // Formater les valeurs
        const rituelsMinFormatted = formatEstimate(rituelsMin);
        const rituelsMaxFormatted = isUnlimited ? null : formatEstimate(rituelsMax);
        const hoursMinFormatted = formatEstimate(hoursMin);
        const hoursMaxFormatted = isUnlimited ? null : formatEstimate(hoursMax);
        
        // ============================================
        // CALCUL ESTIMATION "À L'HEURE" (nouveau système)
        // Heures inchangées — Express n'affecte pas le volume
        // ============================================
        let hoursDirectMin, hoursDirectMax;
        
        if (budget.max === 999999) {
          hoursDirectMin = Math.ceil(budget.min / rateBase);
          hoursDirectMax = null;
        } else {
          hoursDirectMin = Math.ceil(budget.min / rateBase);
          hoursDirectMax = Math.floor(budget.max / rateBase);
        }
        
        const hoursDirectMinFormatted = formatEstimate(hoursDirectMin);
        const hoursDirectMaxFormatted = hoursDirectMax ? formatEstimate(hoursDirectMax) : null;
        
        // Tarifs affichés = base * (1 + % express)
        const rateFormatted = formatEstimate(rate);
        const ratesCount = rates.length;
        const rateMinBase = ratesCount > 0 ? Math.min(...rates) : rateBase;
        const rateMaxBase = ratesCount > 0 ? Math.max(...rates) : rateBase;
        const rateMin = rateMinBase * expressMult;
        const rateMax = rateMaxBase * expressMult;
        const rateMinFormatted = formatEstimate(rateMin);
        const rateMaxFormatted = formatEstimate(rateMax);
        
        // Conversion journalier (base 7h ou 8h) — arrondi à l'euro — avec Express
        const base = getBaseHours();
        const tjmMoyen = Math.round(rate * base);
        const tjmMin = Math.round(rateMin * base);
        const tjmMax = Math.round(rateMax * base);
        const tjmLine = (tjmMoyen > 0 && !isNaN(tjmMoyen)) ? `
            <div style="color: #059669; font-weight: 500; font-size: 11px; margin-top: 4px;">
              Tarif journalier moyen (${base}h) : ${tjmMoyen} €/jour${ratesCount > 1 ? ` (fourchette : ${tjmMin}–${tjmMax} €/jour)` : ''}
            </div>
          ` : '';
        const horaireLine = `
            <div style="color: #059669; font-weight: 500; font-size: 11px; margin-top: 4px;">
              Tarif horaire moyen : ${rateFormatted} €/h${ratesCount > 1 ? ` (fourchette : ${rateMinFormatted}–${rateMaxFormatted} €/h)` : ''}
            </div>
          `;
        var expressPct = (expressMult - 1) * 100;
        var expressMicroLine = expressPct > 0
          ? '<div style="font-size: 10px; color: #6B7280; margin-top: 6px;">Supplément Express appliqué : +' + Math.round(expressPct) + '%</div>'
          : '<div style="font-size: 10px; color: #6B7280; margin-top: 6px;">Standard : aucun supplément</div>';
        if (isUnlimited) {
          estimateElement.innerHTML = `
            <div style="margin-bottom: 4px;">
              Volume estimé : ~${rituelsMinFormatted}+ rituels (≈ ${hoursMinFormatted}+ h)
            </div>
            ${tjmLine}
            ${horaireLine}
            ${expressMicroLine}
          `;
        } else {
          estimateElement.innerHTML = `
            <div style="margin-bottom: 4px;">
              Volume estimé : ~${rituelsMinFormatted}–${rituelsMaxFormatted} rituels (≈ ${hoursMinFormatted}–${hoursMaxFormatted} h)
            </div>
            ${tjmLine}
            ${horaireLine}
            ${expressMicroLine}
          `;
        }
      }
      
      // Écouter les changements du select Budget (sans recharger la page)
      // Utiliser capture phase pour intercepter AVANT les autres listeners
      budgetSelect.addEventListener('change', function(e) {
        e.stopImmediatePropagation(); // Empêcher les autres listeners (notamment l'auto-submit)
        e.stopPropagation(); // Empêcher la propagation de l'événement
        updateBudgetEstimate();
      }, true); // Capture phase = true pour intercepter en premier
    
    // Toggle Base journée 7h/8h
    syncToggleUI(getBaseHours());
    document.querySelectorAll('.engagement-base-btn').forEach(function(btn) {
      btn.addEventListener('click', function() {
        var base = parseInt(this.getAttribute('data-base'), 10);
        setBaseHours(base);
        syncToggleUI(base);
        updateBudgetEstimate();
      });
    });
    
    // Express : géré par expressOptions.js (express:changed)
    
    // Observer les changements dans les résultats (filtrage, tri, pagination)
    const resultsContainer = document.querySelector('.preply-teachers-list, .freelancers-grid-premium, .freelancers-list-wrapper');
    if (resultsContainer) {
      const observer = new MutationObserver(function() {
        // Délai pour laisser le temps aux résultats de se charger
        setTimeout(updateBudgetEstimate, 200);
      });
      
      observer.observe(resultsContainer, {
        childList: true,
        subtree: true
      });
    }
    
    // Observer aussi le conteneur de résultats pour la pagination
    const resultsSection = document.querySelector('.preply-results-section');
    if (resultsSection) {
      const sectionObserver = new MutationObserver(function() {
        setTimeout(updateBudgetEstimate, 200);
      });
      
      sectionObserver.observe(resultsSection, {
        childList: true,
        subtree: true
      });
    }
    
    // Mettre à jour au chargement initial
    updateBudgetEstimateRef = updateBudgetEstimate;
    setTimeout(updateBudgetEstimate, 300);
    
    // Mettre à jour après les changements de filtres (via le formulaire)
    // Note: Le select Budget ne soumet pas le formulaire, donc cette partie ne s'applique pas à lui
    const filterForm = document.getElementById('preplyFiltersForm');
    if (filterForm) {
      filterForm.addEventListener('submit', function(e) {
        // Ne pas empêcher la soumission normale des autres filtres
        setTimeout(updateBudgetEstimate, 500);
      });
    }
    
    // Mettre à jour après tri
    const sortSelect = document.querySelector('.preply-sort-select');
    if (sortSelect) {
      sortSelect.addEventListener('change', function() {
        setTimeout(updateBudgetEstimate, 200);
      });
    }
    
    // Mettre à jour lors des clics sur les liens de pagination
    document.addEventListener('click', function(e) {
      if (e.target.closest('.pagination a, .pagination-link')) {
        setTimeout(updateBudgetEstimate, 500);
      }
    });
    } // Fin de initBudgetEstimate
    
    // Initialiser quand le DOM est prêt (avec retry si search-filter pas encore rendu)
    function tryInitBudgetEstimate() {
      if (document.getElementById('budgetFilter') && document.getElementById('budgetEstimate')) {
        initBudgetEstimate();
      } else {
        setTimeout(tryInitBudgetEstimate, 100);
      }
    }
    if (document.readyState === 'loading') {
      document.addEventListener('DOMContentLoaded', tryInitBudgetEstimate);
    } else {
      setTimeout(tryInitBudgetEstimate, 50);
    }

    // Dropdown Premium "Le prof parle" (remplace l'ancien système "Autre...")
    (function initLanguageDropdown() {
      // Liste des langues avec codes
      const languagesData = [
        // Populaires (dans l'ordre spécifié)
        { code: 'fr', name: 'Français', popular: true },
        { code: 'ar', name: 'Arabe', popular: true },
        { code: 'es', name: 'Espagnol', popular: true },
        { code: 'en', name: 'Anglais', popular: true },
        // Autres langues
        { code: 'ru', name: 'Russe', popular: false },
        { code: 'de', name: 'Allemand', popular: false },
        { code: 'it', name: 'Italien', popular: false },
        { code: 'pt', name: 'Portugais', popular: false },
        { code: 'zh', name: 'Chinois', popular: false },
        { code: 'ja', name: 'Japonais', popular: false },
        { code: 'ko', name: 'Coréen', popular: false },
        { code: 'nl', name: 'Néerlandais', popular: false },
        { code: 'pl', name: 'Polonais', popular: false },
        { code: 'sv', name: 'Suédois', popular: false },
        { code: 'da', name: 'Danois', popular: false },
        { code: 'no', name: 'Norvégien', popular: false },
        { code: 'fi', name: 'Finnois', popular: false },
        { code: 'cs', name: 'Tchèque', popular: false },
        { code: 'hu', name: 'Hongrois', popular: false },
        { code: 'ro', name: 'Roumain', popular: false },
        { code: 'el', name: 'Grec', popular: false },
        { code: 'tr', name: 'Turc', popular: false },
        { code: 'he', name: 'Hébreu', popular: false },
        { code: 'th', name: 'Thaï', popular: false },
        { code: 'vi', name: 'Vietnamien', popular: false },
        { code: 'id', name: 'Indonésien', popular: false },
        { code: 'hi', name: 'Hindi', popular: false },
      ];

      const languageTrigger = document.getElementById('languageDropdownTrigger');
      const languageMenu = document.getElementById('languageDropdownMenu');
      const languageSelectedText = document.getElementById('languageSelectedText');
      const teacherSpeaksInput = document.getElementById('teacherSpeaksInput');
      const languageSearchInput = document.getElementById('languageSearchInput');
      const languagePopularList = document.getElementById('languagePopularList');
      const languageAllList = document.getElementById('languageAllList');
      const languageAllSection = document.getElementById('languageAllSection');
      const languageNoResults = document.getElementById('languageNoResults');
      const languageResetOption = document.getElementById('languageResetOption');

      if (!languageTrigger || !languageMenu || !languageSelectedText || !teacherSpeaksInput) {
        return;
      }

      // Gérer plusieurs sélections : tableau de codes de langues
      let selectedLanguageCodes = [];
      let searchDebounceTimer = null;

      // Initialiser depuis l'URL ou l'input
      const initialValue = teacherSpeaksInput.value || '';
      if (initialValue) {
        selectedLanguageCodes = initialValue.split(',').filter(c => c.trim() !== '');
      }

      // Mettre à jour le texte affiché
      function updateSelectedText() {
        if (selectedLanguageCodes.length === 0) {
          languageSelectedText.textContent = 'Toutes les langues';
        } else if (selectedLanguageCodes.length === 1) {
          const language = languagesData.find(l => l.code === selectedLanguageCodes[0]);
          languageSelectedText.textContent = language ? language.name : 'Toutes les langues';
        } else {
          const firstLanguage = languagesData.find(l => l.code === selectedLanguageCodes[0]);
          const firstName = firstLanguage ? firstLanguage.name : selectedLanguageCodes[0];
          languageSelectedText.textContent = firstName + ' +' + (selectedLanguageCodes.length - 1);
        }
      }

      // Créer un élément de langue
      function createLanguageOption(language) {
        const option = document.createElement('div');
        option.className = 'language-option';
        option.setAttribute('data-code', language.code);
        if (selectedLanguageCodes.includes(language.code)) {
          option.classList.add('selected');
        }

        option.innerHTML = `
          <span class="language-name">${language.name}</span>
          <span class="language-checkbox"></span>
        `;

        option.addEventListener('click', function(e) {
          e.stopPropagation();
          toggleLanguage(language.code);
        });

        return option;
      }

      // Rendre la liste des langues populaires
      function renderPopularLanguages() {
        if (!languagePopularList) return;
        languagePopularList.innerHTML = '';
        const popularLanguages = languagesData.filter(l => l.popular);
        popularLanguages.forEach(language => {
          languagePopularList.appendChild(createLanguageOption(language));
        });
      }

      // Rendre la liste complète filtrée
      function renderFilteredLanguages(searchTerm = '') {
        if (!languageAllList) return;

        const normalizedSearch = searchTerm.toLowerCase().trim();
        let filteredLanguages = [];

        if (normalizedSearch === '') {
          filteredLanguages = languagesData.filter(l => !l.popular);
          languageAllSection.style.display = filteredLanguages.length > 0 ? 'block' : 'none';
          languageNoResults.style.display = 'none';
        } else {
          filteredLanguages = languagesData.filter(language => 
            language.name.toLowerCase().includes(normalizedSearch)
          );
          languageAllSection.style.display = filteredLanguages.length > 0 ? 'block' : 'none';
          languageNoResults.style.display = filteredLanguages.length === 0 ? 'block' : 'none';
          const popularSection = document.querySelector('.language-popular-section');
          if (popularSection) {
            popularSection.style.display = 'none';
          }
        }

        languageAllList.innerHTML = '';
        filteredLanguages.forEach(language => {
          languageAllList.appendChild(createLanguageOption(language));
        });
      }

      // Toggle une langue (ajouter ou retirer)
      function toggleLanguage(code) {
        const index = selectedLanguageCodes.indexOf(code);
        if (index > -1) {
          // Retirer la langue
          selectedLanguageCodes.splice(index, 1);
        } else {
          // Ajouter la langue
          selectedLanguageCodes.push(code);
        }
        
        // Mettre à jour l'input hidden avec les valeurs séparées par des virgules
        teacherSpeaksInput.value = selectedLanguageCodes.join(',');
        
        // Re-rendre les listes pour mettre à jour visuellement les checkboxes
        const currentSearchTerm = languageSearchInput ? languageSearchInput.value : '';
        renderPopularLanguages();
        renderFilteredLanguages(currentSearchTerm);
        
        updateSelectedText();
        updateSelectedState();
        
        // Ne pas fermer le dropdown pour permettre plusieurs sélections
        // Appliquer le filtre via AJAX si la fonction existe, sinon soumettre le formulaire
        if (typeof applyFiltersAjax === 'function') {
          applyFiltersAjax({
            teacher_speaks: selectedLanguageCodes.length > 0 ? selectedLanguageCodes : ''
          });
        } else {
          const form = document.getElementById('preplyFiltersForm');
          if (form) {
            form.submit();
          }
        }
      }

      // Mettre à jour l'état visuel de sélection
      function updateSelectedState() {
        const allOptions = languageMenu.querySelectorAll('.language-option');
        allOptions.forEach(opt => {
          const code = opt.getAttribute('data-code');
          if (selectedLanguageCodes.includes(code)) {
            opt.classList.add('selected');
          } else {
            opt.classList.remove('selected');
          }
        });
      }

      // Ouvrir le dropdown
      function openDropdown() {
        languageMenu.style.display = 'block';
        languageTrigger.classList.add('active');
        if (!languageSearchInput.value.trim()) {
          const popularSection = document.querySelector('.language-popular-section');
          if (popularSection) {
            popularSection.style.display = 'block';
          }
        }
        setTimeout(() => {
          if (languageSearchInput) {
            languageSearchInput.focus();
          }
        }, 100);
      }

      // Fermer le dropdown
      function closeDropdown() {
        languageMenu.style.display = 'none';
        languageTrigger.classList.remove('active');
        if (languageSearchInput) {
          languageSearchInput.value = '';
        }
        const popularSection = document.querySelector('.language-popular-section');
        if (popularSection) {
          popularSection.style.display = 'block';
        }
        languageAllSection.style.display = 'none';
        languageNoResults.style.display = 'none';
      }

      // Toggle dropdown
      languageTrigger.addEventListener('click', function(e) {
        e.stopPropagation();
        if (languageMenu.style.display === 'none' || !languageMenu.style.display) {
          openDropdown();
        } else {
          closeDropdown();
        }
      });

      // Recherche avec debounce
      if (languageSearchInput) {
        languageSearchInput.addEventListener('input', function(e) {
          const searchTerm = e.target.value;
          
          if (searchDebounceTimer) {
            clearTimeout(searchDebounceTimer);
          }

          searchDebounceTimer = setTimeout(() => {
            if (searchTerm.trim() === '') {
              const popularSection = document.querySelector('.language-popular-section');
              if (popularSection) {
                popularSection.style.display = 'block';
              }
              renderFilteredLanguages('');
            } else {
              const popularSection = document.querySelector('.language-popular-section');
              if (popularSection) {
                popularSection.style.display = 'none';
              }
              renderFilteredLanguages(searchTerm);
            }
          }, 200);
        });
      }

      // Option "Toutes les langues" (reset)
      if (languageResetOption) {
        if (selectedLanguageCodes.length === 0) {
          languageResetOption.classList.add('selected');
        }
        languageResetOption.addEventListener('click', function(e) {
          e.stopPropagation();
          selectedLanguageCodes = [];
          teacherSpeaksInput.value = '';
          updateSelectedText();
          updateSelectedState();
          
          // Appliquer le filtre via AJAX si la fonction existe, sinon soumettre le formulaire
          if (typeof applyFiltersAjax === 'function') {
            applyFiltersAjax({
              teacher_speaks: ''
            });
          } else {
            const form = document.getElementById('preplyFiltersForm');
            if (form) {
              form.submit();
            }
          }
        });
      }

      // Fermeture au click outside
      document.addEventListener('click', function(e) {
        if (!languageTrigger.contains(e.target) && !languageMenu.contains(e.target)) {
          closeDropdown();
        }
      });

      // Fermeture avec ESC
      document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && languageMenu.style.display === 'block') {
          closeDropdown();
        }
      });

      // Initialiser
      updateSelectedText();
      renderPopularLanguages();
      renderFilteredLanguages('');

      // Restaurer la sélection au chargement
      const urlParams = new URLSearchParams(window.location.search);
      const urlLanguages = urlParams.getAll('teacher_speaks[]');
      if (urlLanguages.length > 0) {
        selectedLanguageCodes = urlLanguages.filter(l => l && l !== 'other');
        teacherSpeaksInput.value = selectedLanguageCodes.join(',');
        updateSelectedText();
        updateSelectedState();
      } else {
        // Essayer aussi avec teacher_speaks (sans [])
        const urlLanguage = urlParams.get('teacher_speaks');
        if (urlLanguage && urlLanguage !== 'other') {
          selectedLanguageCodes = [urlLanguage];
          teacherSpeaksInput.value = urlLanguage;
          updateSelectedText();
          updateSelectedState();
        }
      }
    })();

    // Popover Premium "Langue maternelle" - Freelances natifs uniquement
    (function initNativeOnlyPopover() {
      const nativeOnlyTrigger = document.getElementById('nativeOnlyTrigger');
      const nativeOnlyPopover = document.getElementById('nativeOnlyPopover');
      const nativeOnlyToggle = document.getElementById('nativeOnlyToggle');

      if (!nativeOnlyTrigger || !nativeOnlyPopover || !nativeOnlyToggle) {
        return;
      }

      // Ouvrir le popover
      function openPopover() {
        nativeOnlyPopover.style.display = 'block';
        nativeOnlyTrigger.classList.add('active');
      }

      // Fermer le popover
      function closePopover() {
        nativeOnlyPopover.style.display = 'none';
        nativeOnlyTrigger.classList.remove('active');
      }

      // Toggle popover
      nativeOnlyTrigger.addEventListener('click', function(e) {
        e.stopPropagation();
        if (nativeOnlyPopover.style.display === 'none' || !nativeOnlyPopover.style.display) {
          openPopover();
        } else {
          closePopover();
        }
      });

      // Gérer le toggle switch
      nativeOnlyToggle.addEventListener('change', function(e) {
        e.stopPropagation();
        const isChecked = this.checked;
        
        // Appliquer le filtre via AJAX avec loader discret
        applyFiltersAjax({
          native_only: isChecked ? '1' : ''
        });
      });

      // Fermeture au click outside
      document.addEventListener('click', function(e) {
        if (!nativeOnlyTrigger.contains(e.target) && !nativeOnlyPopover.contains(e.target)) {
          closePopover();
        }
      });

      // Fermeture avec ESC
      document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && nativeOnlyPopover.style.display === 'block') {
          closePopover();
        }
      });

      // Restaurer l'état au chargement
      const urlParams = new URLSearchParams(window.location.search);
      const urlNativeOnly = urlParams.get('native_only');
      if (urlNativeOnly === '1') {
        nativeOnlyToggle.checked = true;
      }
    })();

    // Panel Premium "Profils d'experts" - Super freelances / Qualifiés / Nouveaux talents
    (function initCategoryFilterPanel() {
      const categoryFilterTrigger = document.getElementById('categoryFilterTrigger');
      const categoryFilterPanel = document.getElementById('categoryFilterPanel');
      const superOnlyToggle = document.getElementById('superOnlyToggle');
      const qualifiedOnlyToggle = document.getElementById('qualifiedOnlyToggle');
      const newTalentsToggle = document.getElementById('newTalentsToggle');

      if (!categoryFilterTrigger || !categoryFilterPanel || !superOnlyToggle || !qualifiedOnlyToggle || !newTalentsToggle) {
        return;
      }

      // Ouvrir le panel
      function openPanel() {
        categoryFilterPanel.style.display = 'block';
        categoryFilterTrigger.classList.add('active');
      }

      // Fermer le panel
      function closePanel() {
        categoryFilterPanel.style.display = 'none';
        categoryFilterTrigger.classList.remove('active');
      }

      // Toggle panel
      categoryFilterTrigger.addEventListener('click', function(e) {
        e.stopPropagation();
        if (categoryFilterPanel.style.display === 'none' || !categoryFilterPanel.style.display) {
          openPanel();
        } else {
          closePanel();
        }
      });

      // Gérer le toggle "Super freelances uniquement"
      superOnlyToggle.addEventListener('change', function(e) {
        e.stopPropagation();
        e.preventDefault();
        const isChecked = this.checked;
        
        // Récupérer l'état actuel des autres toggles pour les préserver
        const currentQualifiedOnly = qualifiedOnlyToggle.checked ? '1' : '';
        const currentNewTalents = newTalentsToggle.checked ? '1' : '';
        
        // Appliquer le filtre via AJAX avec loader discret (préserver les autres toggles)
        applyFiltersAjax({
          super_only: isChecked ? '1' : '',
          qualified_only: currentQualifiedOnly,
          new_talents: currentNewTalents
        });
      });

      // Gérer le toggle "Freelances qualifiés uniquement"
      qualifiedOnlyToggle.addEventListener('change', function(e) {
        e.stopPropagation();
        e.preventDefault();
        const isChecked = this.checked;
        
        // Récupérer l'état actuel des autres toggles pour les préserver
        const currentSuperOnly = superOnlyToggle.checked ? '1' : '';
        const currentNewTalents = newTalentsToggle.checked ? '1' : '';
        
        // Appliquer le filtre via AJAX avec loader discret (préserver les autres toggles)
        applyFiltersAjax({
          super_only: currentSuperOnly,
          qualified_only: isChecked ? '1' : '',
          new_talents: currentNewTalents
        });
      });

      // Gérer le toggle "Nouveaux talents"
      newTalentsToggle.addEventListener('change', function(e) {
        e.stopPropagation();
        e.preventDefault();
        const isChecked = this.checked;
        
        // Récupérer l'état actuel des autres toggles pour les préserver
        const currentSuperOnly = superOnlyToggle.checked ? '1' : '';
        const currentQualifiedOnly = qualifiedOnlyToggle.checked ? '1' : '';
        
        // Appliquer le filtre via AJAX avec loader discret (préserver les autres toggles)
        applyFiltersAjax({
          super_only: currentSuperOnly,
          qualified_only: currentQualifiedOnly,
          new_talents: isChecked ? '1' : ''
        });
      });

      // Fermeture au click outside
      document.addEventListener('click', function(e) {
        if (!categoryFilterTrigger.contains(e.target) && !categoryFilterPanel.contains(e.target)) {
          closePanel();
        }
      });

      // Fermeture avec ESC
      document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && categoryFilterPanel.style.display === 'block') {
          closePanel();
        }
      });

      // Restaurer l'état au chargement
      const urlParams = new URLSearchParams(window.location.search);
      const urlSuperOnly = urlParams.get('super_only');
      const urlQualifiedOnly = urlParams.get('qualified_only');
      if (urlSuperOnly === '1') {
        superOnlyToggle.checked = true;
      }
      if (urlQualifiedOnly === '1') {
        qualifiedOnlyToggle.checked = true;
      }
    })();
  })();

  // Dropdown Premium Pays de naissance
  (function initCountryDropdown() {
    // Liste complète des pays avec drapeaux (ISO2)
    const countriesData = [
      // Populaires (dans l'ordre spécifié)
      { code: 'GB', name: 'Royaume-Uni', flag: '🇬🇧', popular: true },
      { code: 'FR', name: 'France', flag: '🇫🇷', popular: true },
      { code: 'US', name: 'États-Unis d\'Amérique', flag: '🇺🇸', popular: true },
      { code: 'CA', name: 'Canada', flag: '🇨🇦', popular: true },
      { code: 'ZA', name: 'Afrique du Sud', flag: '🇿🇦', popular: true },
      // Autres pays
      { code: 'ES', name: 'Espagne', flag: '🇪🇸', popular: false },
      { code: 'DE', name: 'Allemagne', flag: '🇩🇪', popular: false },
      { code: 'IT', name: 'Italie', flag: '🇮🇹', popular: false },
      { code: 'PT', name: 'Portugal', flag: '🇵🇹', popular: false },
      { code: 'BE', name: 'Belgique', flag: '🇧🇪', popular: false },
      { code: 'CH', name: 'Suisse', flag: '🇨🇭', popular: false },
      { code: 'NL', name: 'Pays-Bas', flag: '🇳🇱', popular: false },
      { code: 'AT', name: 'Autriche', flag: '🇦🇹', popular: false },
      { code: 'SE', name: 'Suède', flag: '🇸🇪', popular: false },
      { code: 'NO', name: 'Norvège', flag: '🇳🇴', popular: false },
      { code: 'DK', name: 'Danemark', flag: '🇩🇰', popular: false },
      { code: 'FI', name: 'Finlande', flag: '🇫🇮', popular: false },
      { code: 'PL', name: 'Pologne', flag: '🇵🇱', popular: false },
      { code: 'GR', name: 'Grèce', flag: '🇬🇷', popular: false },
      { code: 'IE', name: 'Irlande', flag: '🇮🇪', popular: false },
      { code: 'AU', name: 'Australie', flag: '🇦🇺', popular: false },
      { code: 'NZ', name: 'Nouvelle-Zélande', flag: '🇳🇿', popular: false },
      { code: 'BR', name: 'Brésil', flag: '🇧🇷', popular: false },
      { code: 'MX', name: 'Mexique', flag: '🇲🇽', popular: false },
      { code: 'AR', name: 'Argentine', flag: '🇦🇷', popular: false },
      { code: 'CL', name: 'Chili', flag: '🇨🇱', popular: false },
      { code: 'CO', name: 'Colombie', flag: '🇨🇴', popular: false },
      { code: 'PE', name: 'Pérou', flag: '🇵🇪', popular: false },
      { code: 'VE', name: 'Venezuela', flag: '🇻🇪', popular: false },
      { code: 'JP', name: 'Japon', flag: '🇯🇵', popular: false },
      { code: 'CN', name: 'Chine', flag: '🇨🇳', popular: false },
      { code: 'KR', name: 'Corée du Sud', flag: '🇰🇷', popular: false },
      { code: 'IN', name: 'Inde', flag: '🇮🇳', popular: false },
      { code: 'TH', name: 'Thaïlande', flag: '🇹🇭', popular: false },
      { code: 'VN', name: 'Vietnam', flag: '🇻🇳', popular: false },
      { code: 'ID', name: 'Indonésie', flag: '🇮🇩', popular: false },
      { code: 'MY', name: 'Malaisie', flag: '🇲🇾', popular: false },
      { code: 'SG', name: 'Singapour', flag: '🇸🇬', popular: false },
      { code: 'PH', name: 'Philippines', flag: '🇵🇭', popular: false },
      { code: 'AE', name: 'Émirats arabes unis', flag: '🇦🇪', popular: false },
      { code: 'SA', name: 'Arabie saoudite', flag: '🇸🇦', popular: false },
      { code: 'IL', name: 'Israël', flag: '🇮🇱', popular: false },
      { code: 'TR', name: 'Turquie', flag: '🇹🇷', popular: false },
      { code: 'EG', name: 'Égypte', flag: '🇪🇬', popular: false },
      { code: 'MA', name: 'Maroc', flag: '🇲🇦', popular: false },
      { code: 'TN', name: 'Tunisie', flag: '🇹🇳', popular: false },
      { code: 'DZ', name: 'Algérie', flag: '🇩🇿', popular: false },
      { code: 'SN', name: 'Sénégal', flag: '🇸🇳', popular: false },
      { code: 'CI', name: 'Côte d\'Ivoire', flag: '🇨🇮', popular: false },
      { code: 'CM', name: 'Cameroun', flag: '🇨🇲', popular: false },
      { code: 'KE', name: 'Kenya', flag: '🇰🇪', popular: false },
      { code: 'NG', name: 'Nigeria', flag: '🇳🇬', popular: false },
      { code: 'GH', name: 'Ghana', flag: '🇬🇭', popular: false },
      { code: 'RU', name: 'Russie', flag: '🇷🇺', popular: false },
      { code: 'UA', name: 'Ukraine', flag: '🇺🇦', popular: false },
      { code: 'RO', name: 'Roumanie', flag: '🇷🇴', popular: false },
      { code: 'CZ', name: 'République tchèque', flag: '🇨🇿', popular: false },
      { code: 'HU', name: 'Hongrie', flag: '🇭🇺', popular: false },
    ];

    const countryTrigger = document.getElementById('countryDropdownTrigger');
    const countryMenu = document.getElementById('countryDropdownMenu');
    const countrySelectedText = document.getElementById('countrySelectedText');
    const countryInput = document.getElementById('countryInput');
    const countrySearchInput = document.getElementById('countrySearchInput');
    const countryPopularList = document.getElementById('countryPopularList');
    const countryAllList = document.getElementById('countryAllList');
    const countryAllSection = document.getElementById('countryAllSection');
    const countryNoResults = document.getElementById('countryNoResults');

    if (!countryTrigger || !countryMenu || !countrySelectedText || !countryInput) {
      return;
    }

    let selectedCountryCode = countryInput.value || '';
    let searchDebounceTimer = null;

    // Récupérer le nom du pays depuis le code
    function getCountryName(code) {
      const country = countriesData.find(c => c.code === code);
      return country ? country.name : '';
    }

    // Mettre à jour le texte affiché
    function updateSelectedText() {
      if (selectedCountryCode) {
        const country = countriesData.find(c => c.code === selectedCountryCode);
        countrySelectedText.textContent = country ? country.name : 'Tous les pays';
      } else {
        countrySelectedText.textContent = 'Tous les pays';
      }
    }

    // Créer un élément de pays
    function createCountryOption(country) {
      const option = document.createElement('div');
      option.className = 'country-option';
      option.setAttribute('data-code', country.code);
      if (selectedCountryCode === country.code) {
        option.classList.add('selected');
      }

      option.innerHTML = `
        <span class="country-flag">${country.flag}</span>
        <span class="country-name">${country.name}</span>
        <span class="country-checkbox"></span>
      `;

      option.addEventListener('click', function(e) {
        e.stopPropagation();
        selectCountry(country.code);
      });

      return option;
    }

    // Rendre la liste des pays populaires
    function renderPopularCountries() {
      if (!countryPopularList) return;
      countryPopularList.innerHTML = '';
      const popularCountries = countriesData.filter(c => c.popular);
      popularCountries.forEach(country => {
        countryPopularList.appendChild(createCountryOption(country));
      });
    }

    // Rendre la liste complète filtrée
    function renderFilteredCountries(searchTerm = '') {
      if (!countryAllList) return;

      const normalizedSearch = searchTerm.toLowerCase().trim();
      let filteredCountries = [];

      if (normalizedSearch === '') {
        // Si pas de recherche, afficher tous les pays non-populaires
        filteredCountries = countriesData.filter(c => !c.popular);
        countryAllSection.style.display = filteredCountries.length > 0 ? 'block' : 'none';
        countryNoResults.style.display = 'none';
      } else {
        // Filtrer par recherche
        filteredCountries = countriesData.filter(country => 
          country.name.toLowerCase().includes(normalizedSearch)
        );
        countryAllSection.style.display = filteredCountries.length > 0 ? 'block' : 'none';
        countryNoResults.style.display = filteredCountries.length === 0 ? 'block' : 'none';
        // Masquer la section populaire si recherche active
        document.querySelector('.country-popular-section').style.display = 'none';
      }

      countryAllList.innerHTML = '';
      filteredCountries.forEach(country => {
        countryAllList.appendChild(createCountryOption(country));
      });
    }

    // Sélectionner un pays
    function selectCountry(code) {
      selectedCountryCode = code;
      countryInput.value = code;
      updateSelectedText();
      updateSelectedState();
      closeDropdown();

      // Appliquer le filtre via AJAX
      applyFiltersAjax({
        country: code
      });
    }

    // Mettre à jour l'état visuel de sélection
    function updateSelectedState() {
      const allOptions = countryMenu.querySelectorAll('.country-option');
      allOptions.forEach(opt => {
        const code = opt.getAttribute('data-code');
        if (code === selectedCountryCode) {
          opt.classList.add('selected');
        } else {
          opt.classList.remove('selected');
        }
      });
    }

    // Ouvrir le dropdown
    function openDropdown() {
      countryMenu.style.display = 'block';
      countryTrigger.classList.add('active');
      // Réafficher la section populaire si recherche vide
      if (!countrySearchInput.value.trim()) {
        document.querySelector('.country-popular-section').style.display = 'block';
      }
      // Focus sur le champ de recherche
      setTimeout(() => {
        if (countrySearchInput) {
          countrySearchInput.focus();
        }
      }, 100);
    }

    // Fermer le dropdown
    function closeDropdown() {
      countryMenu.style.display = 'none';
      countryTrigger.classList.remove('active');
      if (countrySearchInput) {
        countrySearchInput.value = '';
      }
      // Réafficher la section populaire
      document.querySelector('.country-popular-section').style.display = 'block';
      countryAllSection.style.display = 'none';
      countryNoResults.style.display = 'none';
    }

    // Toggle dropdown
    countryTrigger.addEventListener('click', function(e) {
      e.stopPropagation();
      if (countryMenu.style.display === 'none' || !countryMenu.style.display) {
        openDropdown();
      } else {
        closeDropdown();
      }
    });

    // Recherche avec debounce
    if (countrySearchInput) {
      countrySearchInput.addEventListener('input', function(e) {
        const searchTerm = e.target.value;
        
        if (searchDebounceTimer) {
          clearTimeout(searchDebounceTimer);
        }

        searchDebounceTimer = setTimeout(() => {
          if (searchTerm.trim() === '') {
            // Réafficher la section populaire
            document.querySelector('.country-popular-section').style.display = 'block';
            renderFilteredCountries('');
          } else {
            // Masquer la section populaire et afficher les résultats filtrés
            document.querySelector('.country-popular-section').style.display = 'none';
            renderFilteredCountries(searchTerm);
          }
        }, 200);
      });
    }

    // Fermeture au click outside
    document.addEventListener('click', function(e) {
      if (!countryTrigger.contains(e.target) && !countryMenu.contains(e.target)) {
        closeDropdown();
      }
    });

    // Fermeture avec ESC
    document.addEventListener('keydown', function(e) {
      if (e.key === 'Escape' && countryMenu.style.display === 'block') {
        closeDropdown();
      }
    });

    // Option "Tous les pays"
    const allCountriesOption = document.createElement('div');
    allCountriesOption.className = 'country-option';
    allCountriesOption.setAttribute('data-code', '');
    if (!selectedCountryCode) {
      allCountriesOption.classList.add('selected');
    }
    allCountriesOption.innerHTML = `
      <span class="country-flag">🌍</span>
      <span class="country-name">Tous les pays</span>
      <span class="country-checkbox"></span>
    `;
    allCountriesOption.addEventListener('click', function(e) {
      e.stopPropagation();
      selectCountry('');
    });

    // Insérer "Tous les pays" en haut de la liste populaire
    if (countryPopularList) {
      countryPopularList.insertBefore(allCountriesOption, countryPopularList.firstChild);
    }

    // Initialiser
    updateSelectedText();
    renderPopularCountries();
    renderFilteredCountries('');

    // Restaurer la sélection au chargement
    const urlParams = new URLSearchParams(window.location.search);
    const urlCountry = urlParams.get('country');
    if (urlCountry) {
      selectedCountryCode = urlCountry;
      countryInput.value = urlCountry;
      updateSelectedText();
      updateSelectedState();
    }
  })();

  // Dropdown Premium Univers d'activité — V1 ultra minimal (6 univers principaux, liste plate)
  (function initSectorDropdown() {
    const sectorsData = [
      { code: 'business_strategie', name: 'Business & Stratégie' },
      { code: 'tech_digital', name: 'Tech & Digital' },
      { code: 'marketing_marques_croissance', name: 'Marketing, Marques & Croissance' },
      { code: 'sante_bien_etre', name: 'Santé & Bien-être' },
      { code: 'impact_culture_societe', name: 'Impact, Culture & Société' },
      { code: 'formation_transmission', name: 'Formation & Transmission' },
    ];

    const sectorTrigger = document.getElementById('sectorDropdownTrigger');
    const sectorMenu = document.getElementById('sectorDropdownMenu');
    const sectorSelectedText = document.getElementById('sectorSelectedText');
    const sectorInput = document.getElementById('sectorInput');
    const sectorSearchInput = document.getElementById('sectorSearchInput');
    const sectorPopularList = document.getElementById('sectorPopularList');
    const sectorAllList = document.getElementById('sectorAllList');
    const sectorAllSection = document.getElementById('sectorAllSection');
    const sectorNoResults = document.getElementById('sectorNoResults');

    if (!sectorTrigger || !sectorMenu || !sectorSelectedText || !sectorInput) {
      return;
    }
    // Le filtre Univers d'activité est dans le search-filter : son init gère déjà le dropdown
    if (sectorTrigger.closest('#homeSearchFilter')) {
      return;
    }

    let selectedSectorCode = sectorInput.value || '';
    let searchDebounceTimer = null;

    // Mettre à jour le texte affiché
    function updateSelectedText() {
      if (selectedSectorCode) {
        const sector = sectorsData.find(s => s.code === selectedSectorCode);
        sectorSelectedText.textContent = sector ? sector.name : 'Tous les univers d\'activité';
      } else {
        sectorSelectedText.textContent = 'Tous les univers d\'activité';
      }
    }

    // Créer un élément de secteur
    function createSectorOption(sector) {
      const option = document.createElement('div');
      option.className = 'sector-option';
      option.setAttribute('data-code', sector.code);
      if (selectedSectorCode === sector.code) {
        option.classList.add('selected');
      }

      option.innerHTML = `
        <span class="sector-name">${sector.name}</span>
        <span class="sector-checkbox"></span>
      `;

      option.addEventListener('click', function(e) {
        e.stopPropagation();
        selectSector(sector.code);
      });

      return option;
    }

    // Rendre la liste plate (Univers d'activité V1 ultra minimal — 6 options, sans sous-niveaux)
    function renderPopularSectors() {
      if (!sectorPopularList) return;
      sectorPopularList.innerHTML = '';
      sectorsData.forEach(function(sector) {
        sectorPopularList.appendChild(createSectorOption(sector));
      });
    }

    // Rendre la liste complète filtrée
    function renderFilteredSectors(searchTerm = '') {
      if (!sectorAllList) return;

      const normalizedSearch = searchTerm.toLowerCase().trim();
      let filteredSectors = [];

      if (normalizedSearch === '') {
        filteredSectors = [];
        sectorAllSection.style.display = 'none';
        sectorNoResults.style.display = 'none';
      } else {
        filteredSectors = sectorsData.filter(sector => 
          sector.name.toLowerCase().includes(normalizedSearch)
        );
        sectorAllSection.style.display = filteredSectors.length > 0 ? 'block' : 'none';
        sectorNoResults.style.display = filteredSectors.length === 0 ? 'block' : 'none';
        // Masquer la section populaire si recherche active
        const popularSection = document.querySelector('.sector-popular-section');
        if (popularSection) {
          popularSection.style.display = 'none';
        }
      }

      sectorAllList.innerHTML = '';
      filteredSectors.forEach(sector => {
        sectorAllList.appendChild(createSectorOption(sector));
      });
    }

    // Sélectionner un secteur
    function selectSector(code) {
      selectedSectorCode = code;
      sectorInput.value = code;
      updateSelectedText();
      updateSelectedState();
      closeDropdown();

      // Appliquer le filtre via AJAX
      if (typeof applyFiltersAjax === 'function') {
        applyFiltersAjax({
          sector: code
        });
      } else {
        // Fallback : soumettre le formulaire
        document.getElementById('preplyFiltersForm').submit();
      }
    }

    // Mettre à jour l'état visuel de sélection
    function updateSelectedState() {
      const allOptions = sectorMenu.querySelectorAll('.sector-option');
      allOptions.forEach(opt => {
        const code = opt.getAttribute('data-code');
        if (code === selectedSectorCode) {
          opt.classList.add('selected');
        } else {
          opt.classList.remove('selected');
        }
      });
    }

    // Ouvrir le dropdown
    function openDropdown() {
      sectorMenu.style.display = 'block';
      sectorTrigger.classList.add('active');
      // Réafficher la section populaire si recherche vide
      if (!sectorSearchInput.value.trim()) {
        const popularSection = document.querySelector('.sector-popular-section');
        if (popularSection) {
          popularSection.style.display = 'block';
        }
      }
      // Focus sur le champ de recherche
      setTimeout(() => {
        if (sectorSearchInput) {
          sectorSearchInput.focus();
        }
      }, 100);
    }

    // Fermer le dropdown
    function closeDropdown() {
      sectorMenu.style.display = 'none';
      sectorTrigger.classList.remove('active');
      if (sectorSearchInput) {
        sectorSearchInput.value = '';
      }
      renderFilteredSectors('');
      // Réafficher la section populaire
      const popularSection = document.querySelector('.sector-popular-section');
      if (popularSection) {
        popularSection.style.display = 'block';
      }
    }

    // Initialiser
    renderPopularSectors();
    updateSelectedText();
    updateSelectedState();

    var sectorResetOpt = document.getElementById('sectorResetOption');
    if (sectorResetOpt) {
      sectorResetOpt.addEventListener('click', function(e) { e.stopPropagation(); selectSector(''); });
      sectorResetOpt.addEventListener('keydown', function(e) { if (e.key === 'Enter' || e.key === ' ') { e.preventDefault(); selectSector(''); } });
    }

    // Événements
    sectorTrigger.addEventListener('click', function(e) {
      e.stopPropagation();
      if (sectorMenu.style.display === 'none' || !sectorMenu.style.display) {
        openDropdown();
      } else {
        closeDropdown();
      }
    });

    if (sectorSearchInput) {
      sectorSearchInput.addEventListener('input', function(e) {
        const searchTerm = e.target.value;
        if (searchDebounceTimer) {
          clearTimeout(searchDebounceTimer);
        }
        searchDebounceTimer = setTimeout(() => {
          renderFilteredSectors(searchTerm);
        }, 150);
      });
    }

    // Fermer au clic en dehors
    document.addEventListener('click', function(e) {
      if (!sectorTrigger.contains(e.target) && !sectorMenu.contains(e.target)) {
        closeDropdown();
      }
    });

    // Gérer la touche Escape
    document.addEventListener('keydown', function(e) {
      if (e.key === 'Escape' && sectorMenu.style.display === 'block') {
        closeDropdown();
      }
    });

    // Initialiser depuis l'URL si présent
    const urlParams = new URLSearchParams(window.location.search);
    const urlSector = urlParams.get('sector');
    if (urlSector && urlSector !== selectedSectorCode) {
      selectedSectorCode = urlSector;
      sectorInput.value = urlSector;
      updateSelectedText();
      updateSelectedState();
    }
  })();

</script>

<!-- Modale vidéo -->
<div id="videoModal" class="video-modal-overlay">
  <div class="video-modal-container">
    <button class="video-modal-close" id="videoModalClose" aria-label="Fermer la vidéo">&times;</button>
    <div class="video-modal-content" id="videoModalContent">
      <!-- Le contenu vidéo sera injecté ici -->
    </div>
  </div>
</div>
@endsection
