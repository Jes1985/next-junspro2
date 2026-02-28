{{-- 
AUDIT - Formulaire /mission/soumettre (VERSION PREMIUM)
=======================================================
Fichier: resources/views/frontend/client/mission-form.blade.php
Route: GET /mission/soumettre -> FrontEnd\ClientMissionController@showForm
POST: /mission/soumettre -> FrontEnd\ClientMissionController@submit
Controller: app/Http/Controllers/FrontEnd/ClientMissionController.php
Modèle: app/Models/Mission.php
Table: missions

CHAMPS BACKEND (names/values):
- univers_slug: required, values: projets-consulting|cours-mentorat|service-domicile|echange-logement|wellnesslive|pause-souffle
- budget: required|numeric|min:0 (sauf echange-logement: nullable)
- offre: required, values: Accompagnement|Mise_en_relation|Aucune
- description_mission: required|string
- about_you: nullable|string|max:2000
- location_mode: nullable, values: remote|hybrid|onsite
- preferred_contact: nullable, values: email|whatsapp|call
- language: nullable, values: fr|en|it
- details: nullable|array (JSON) - Champs conditionnels par univers

CHAMPS DB EXISTANTS RÉUTILISÉS:
✓ univers_slug (migration 2026_01_22_105536)
✓ about_you (migration 2026_01_22_105536)
✓ details (migration 2026_01_22_105536, JSON)
✓ preferred_contact, language, location_mode (migration 2026_01_22_105536)
✓ client_nom, client_email, client_telephone, description_mission, budget, offre, bonus, statut (table missions)

CHAMPS CONDITIONNELS PAR UNIVERS (dans details JSON):
A) projets-consulting: domain, deliverables[], scope_in, scope_out, decision_maker, tools
B) cours-mentorat: topic, level, goal, rhythm, format, availability
C) service-domicile: service_type, postal_city, frequency, constraints, verified_required
D) echange-logement: exchange_type, destinations, dates_text, flexibility, travelers_adults, travelers_children, essentials[], house_rules, checkin
E) wellnesslive: objective, class_types[], level, frequency, content_pref, equipment, subscription_budget
F) pause-souffle: situation, intention, energy, clarity, stress, protect[], vision, coaching_style, spiritual

ÉLÉMENTS UI PREMIUM:
✓ Design "journal blanc" (bg-white, borders #e5e7eb, radius 1rem)
✓ Boutons premium (gradient doux, rounded-full, transitions douces)
✓ Champs conditionnels affichés selon univers_slug
✓ Range inputs (sliders) pour pause-souffle avec affichage valeur
✓ Disclaimer Pause Souffle (alerte médicale)
✓ Validation conditionnelle serveur selon univers

FICHIERS MODIFIÉS:
1. resources/views/frontend/client/mission-form.blade.php
   - Champs conditionnels mis à jour selon spécifications exactes
   - UI premium "journal blanc" améliorée
   - Scripts pour conversion ex_* -> details[...] et sliders
2. app/Http/Controllers/FrontEnd/ClientMissionController.php
   - Validation conditionnelle ajoutée (getUniversValidationRules)
   - Nettoyage des détails (filtrage valeurs vides)
--}}

@extends('frontend.layout')

@section('pageHeading')
  {{ __('Soumettre une Mission') }}
@endsection

@section('style')
<style>
  /* Design premium "journal blanc" */
  .mission-form-container {
    background: #ffffff !important;
    min-height: 100vh;
  }
  
  .mission-form-wrapper {
    max-width: 80rem !important;
    margin: 0 auto !important;
    padding: 2.5rem 1rem !important;
    width: 100% !important;
    position: relative;
  }
  
  @media (min-width: 768px) {
    .mission-form-wrapper {
      padding: 2.5rem 2rem;
      display: grid;
      grid-template-columns: 1fr 320px;
      gap: 2rem;
    }
  }
  
  .mission-form-main {
    min-width: 0;
  }
  
  .mission-form-title {
    font-size: 2rem;
    font-weight: 700;
    color: #1a202c;
    margin-bottom: 0.5rem;
  }
  
  .mission-form-subtitle {
    color: #64748b;
    font-size: 1rem;
    margin-bottom: 2.5rem;
  }
  
  /* Stepper */
  .mission-stepper {
    display: flex;
    justify-content: space-between;
    margin-bottom: 2.5rem;
    position: relative;
  }
  
  .mission-stepper::before {
    content: '';
    position: absolute;
    top: 1.25rem;
    left: 0;
    right: 0;
    height: 2px;
    background: #e5e7eb;
    z-index: 0;
  }
  
  .mission-stepper-step {
    position: relative;
    z-index: 1;
    display: flex;
    flex-direction: column;
    align-items: center;
    flex: 1;
  }
  
  .mission-stepper-circle {
    width: 2.5rem;
    height: 2.5rem;
    border-radius: 50%;
    background: #ffffff;
    border: 2px solid #e5e7eb;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 600;
    font-size: 0.875rem;
    color: #9ca3af;
    transition: all 0.3s;
  }
  
  .mission-stepper-step.active .mission-stepper-circle {
    background: linear-gradient(135deg, #4B2CEB 0%, #6D5CE8 100%);
    border-color: #4B2CEB;
    color: #ffffff;
    box-shadow: 0 0 0 4px rgba(75, 44, 235, 0.1);
  }
  
  .mission-stepper-step.completed .mission-stepper-circle {
    background: linear-gradient(135deg, #4B2CEB 0%, #6D5CE8 100%);
    border-color: #4B2CEB;
    color: #ffffff;
  }
  
  .mission-stepper-step.completed .mission-stepper-circle::after {
    content: '✓';
    color: #ffffff;
  }
  
  .mission-stepper-label {
    margin-top: 0.5rem;
    font-size: 0.75rem;
    font-weight: 500;
    color: #9ca3af;
    text-align: center;
  }
  
  .mission-stepper-step.active .mission-stepper-label {
    color: #1a202c;
  }
  
  .mission-stepper-step.completed .mission-stepper-label {
    color: #4B2CEB;
  }
  
  /* Cartes Univers */
  .mission-univers-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 1rem;
    margin-bottom: 1.5rem;
  }
  
  .mission-univers-card {
    background: #ffffff;
    border: 2px solid #e5e7eb;
    border-radius: 1.5rem;
    padding: 1.5rem;
    cursor: pointer;
    transition: all 0.3s;
    text-align: center;
    position: relative;
  }
  
  .mission-univers-card:hover {
    border-color: #4B2CEB;
    background: rgba(75, 44, 235, 0.02);
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(75, 44, 235, 0.1);
  }
  
  .mission-univers-card input[type="radio"] {
    position: absolute;
    opacity: 0;
    pointer-events: none;
  }
  
  .mission-univers-card.selected {
    border-color: #4B2CEB;
    background: linear-gradient(135deg, rgba(75, 44, 235, 0.05) 0%, rgba(109, 92, 232, 0.05) 100%);
    box-shadow: 0 4px 12px rgba(75, 44, 235, 0.15);
  }
  
  .mission-univers-card.selected::before {
    content: '✓';
    position: absolute;
    top: 0.5rem;
    right: 0.5rem;
    width: 1.5rem;
    height: 1.5rem;
    background: linear-gradient(135deg, #4B2CEB 0%, #6D5CE8 100%);
    color: #ffffff;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 0.75rem;
    font-weight: bold;
  }
  
  .mission-univers-card-title {
    font-weight: 600;
    font-size: 1rem;
    color: #1a202c;
    margin: 0;
  }
  
  /* Sections formulaire */
  .mission-form-step {
    display: none;
  }
  
  .mission-form-step.active {
    display: block;
    animation: fadeIn 0.3s;
  }
  
  @keyframes fadeIn {
    from { opacity: 0; transform: translateY(10px); }
    to { opacity: 1; transform: translateY(0); }
  }
  
  .mission-form-card {
    background: #ffffff;
    border-radius: 1.5rem;
    border: 1px solid rgba(0, 0, 0, 0.05);
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
    padding: 1.5rem;
    margin-bottom: 1.5rem;
  }
  
  @media (min-width: 768px) {
    .mission-form-card {
      padding: 2rem;
    }
  }
  
  .mission-form-section-title {
    font-size: 1.25rem;
    font-weight: 600;
    color: #1a202c;
    margin-bottom: 1.75rem;
    letter-spacing: -0.02em;
  }
  
  .mission-form-label {
    display: block;
    font-size: 0.875rem;
    font-weight: 600;
    color: #1a202c;
    margin-bottom: 0.625rem;
    letter-spacing: -0.01em;
  }
  
  .mission-form-input,
  .mission-form-select,
  .mission-form-textarea {
    width: 100%;
    padding: 0.875rem 1.125rem;
    border: 1px solid #e5e7eb;
    border-radius: 1rem;
    font-size: 0.9375rem;
    transition: all 0.2s ease-out;
    background: #ffffff;
    color: #1a202c;
    font-weight: 400;
    letter-spacing: 0.01em;
  }
  
  .mission-form-input:focus,
  .mission-form-select:focus,
  .mission-form-textarea:focus {
    outline: none;
    border-color: #8B5CF6;
    box-shadow: 0 0 0 3px rgba(139, 92, 246, 0.1);
  }
  
  .mission-form-input[type="range"] {
    padding: 0.5rem 0;
    height: auto;
    cursor: pointer;
  }
  
  .mission-form-textarea {
    resize: vertical;
    min-height: 6rem;
  }
  
  .mission-form-btn-primary {
    background: linear-gradient(90deg, #F472B6 0%, #C084FC 50%, #60A5FA 100%);
    color: #ffffff;
    font-weight: 600;
    padding: 0.875rem 2rem;
    border-radius: 9999px;
    border: none;
    cursor: pointer;
    transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
    width: 100%;
    font-size: 0.9375rem;
    letter-spacing: 0.01em;
    box-shadow: 0 2px 8px rgba(244, 114, 182, 0.15);
  }
  
  .mission-form-btn-primary:hover {
    background: linear-gradient(90deg, #EC4899 0%, #A855F7 50%, #3B82F6 100%);
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(244, 114, 182, 0.2);
  }
  
  .mission-form-btn-secondary {
    background: #ffffff;
    color: #8B5CF6;
    font-weight: 600;
    padding: 0.875rem 2rem;
    border-radius: 9999px;
    border: 1.5px solid #8B5CF6;
    cursor: pointer;
    transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
    width: 100%;
    font-size: 0.9375rem;
    letter-spacing: 0.01em;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
  }
  
  .mission-form-btn-secondary:hover {
    background: rgba(139, 92, 246, 0.03);
    transform: translateY(-1px);
    box-shadow: 0 2px 6px rgba(139, 92, 246, 0.1);
  }
  
  .mission-form-nav {
    display: flex;
    gap: 1rem;
    margin-top: 2rem;
  }
  
  .mission-form-error {
    color: #dc2626;
    font-size: 0.875rem;
    margin-top: 0.25rem;
  }
  
  .mission-form-helper {
    color: #64748b;
    font-size: 0.75rem;
    margin-top: 0.25rem;
  }
  
  .mission-form-radio-group {
    display: flex;
    flex-direction: column;
    gap: 0.75rem;
  }
  
  .mission-form-radio-item {
    padding: 1rem;
    border: 1px solid #e5e7eb;
    border-radius: 1rem;
    cursor: pointer;
    transition: all 0.2s;
  }
  
  .mission-form-radio-item:hover {
    border-color: #4B2CEB;
    background: rgba(75, 44, 235, 0.02);
  }
  
  .mission-form-radio-item input[type="radio"] {
    margin-right: 0.75rem;
    accent-color: #4B2CEB;
  }
  
  .mission-form-alert {
    background: rgba(75, 44, 235, 0.05);
    border: 1px solid rgba(75, 44, 235, 0.2);
    border-radius: 1rem;
    padding: 1rem;
    color: #1a202c;
    font-size: 0.875rem;
    margin-bottom: 1.5rem;
  }
  
  /* Résumé */
  .mission-summary {
    position: sticky;
    top: 2rem;
    background: linear-gradient(to bottom right, #f5f3ff 0%, #ffffff 50%, #ede9fe 100%);
    border-radius: 1.5rem;
    border: 1px solid rgba(0, 0, 0, 0.05);
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    padding: 1.5rem;
    height: fit-content;
    transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1), box-shadow 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    position: relative;
    overflow: hidden;
  }
  
  /* Micro-interactions premium - Glow et shine */
  .mission-summary::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.08), transparent);
    transition: left 0.6s ease-out;
    pointer-events: none;
    z-index: 1;
  }
  
  .mission-summary.is-visible::before {
    left: 100%;
  }
  
  .mission-summary.is-visible {
    box-shadow: 0 4px 16px rgba(139, 92, 246, 0.12), 0 0 0 1px rgba(139, 92, 246, 0.05);
  }
  
  .mission-summary.is-scrolling {
    box-shadow: 0 6px 20px rgba(139, 92, 246, 0.18), 0 0 0 1px rgba(139, 92, 246, 0.08);
  }
  
  .mission-summary:hover,
  .mission-summary:focus-within {
    transform: translateY(-1px);
    box-shadow: 0 6px 20px rgba(139, 92, 246, 0.15), 0 0 0 1px rgba(139, 92, 246, 0.06);
  }
  
  /* Respect prefers-reduced-motion */
  @media (prefers-reduced-motion: reduce) {
    .mission-summary {
      transition: none;
    }
    
    .mission-summary::before {
      display: none;
    }
    
    .mission-summary:hover,
    .mission-summary:focus-within {
      transform: none;
    }
  }
  
  /* Assurer que le contenu reste au-dessus du shine */
  .mission-summary > * {
    position: relative;
    z-index: 2;
  }
  
  .mission-summary-title {
    font-size: 1.125rem;
    font-weight: 600;
    color: #1a202c;
    margin-bottom: 1rem;
    padding-bottom: 1rem;
    border-bottom: 1px solid #e5e7eb;
  }
  
  .mission-summary-item {
    margin-bottom: 1rem;
    font-size: 0.875rem;
  }
  
  .mission-summary-label {
    color: #64748b;
    font-weight: 500;
    margin-bottom: 0.25rem;
  }
  
  .mission-summary-value {
    color: #1a202c;
    font-weight: 600;
  }
  
  .mission-summary-empty {
    color: #9ca3af;
    font-style: italic;
  }
  
  @media (max-width: 767px) {
    .mission-summary {
      position: relative;
      top: 0;
      margin-top: 1.5rem;
    }
    
    .mission-summary.collapsed .mission-summary-content {
      display: none;
    }
    
    .mission-summary-toggle {
      display: flex;
      justify-content: space-between;
      align-items: center;
      cursor: pointer;
      padding: 0.75rem 0;
      border-bottom: 1px solid #e5e7eb;
    }
  }
  
  @media (min-width: 768px) {
    .mission-summary-toggle {
      display: none;
    }
  }
  
  /* Champs conditionnels */
  .mission-form-conditional {
    margin-top: 1.5rem;
    padding-top: 1.5rem;
    border-top: 1px solid #e5e7eb;
  }
  
  .mission-form-checkbox-group {
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
    margin-top: 0.5rem;
  }
  
  .mission-form-checkbox-item {
    display: flex;
    align-items: center;
    gap: 0.5rem;
  }
  
  .mission-form-checkbox-item input[type="checkbox"] {
    accent-color: #4B2CEB;
  }
  
  .mission-form-disclaimer {
    font-size: 0.8125rem;
    color: #4B5563;
    line-height: 1.6;
    margin-top: 1.5rem;
    padding: 1rem;
    background: rgba(251, 191, 36, 0.08);
    border: 1px solid rgba(251, 191, 36, 0.3);
    border-radius: 0.75rem;
    color: #64748b;
    font-style: italic;
    margin-top: 0.5rem;
    padding-top: 0.5rem;
    border-top: 1px solid #e5e7eb;
  }
  
  /* Bouton CTA dans résumé */
  .mission-summary-cta {
    background: linear-gradient(135deg, #4B2CEB 0%, #6D5CE8 100%);
    color: #ffffff;
    font-weight: 600;
    padding: 0.625rem 1.25rem;
    border-radius: 0.75rem;
    border: none;
    cursor: pointer;
    transition: all 0.2s;
    width: 100%;
    font-size: 0.875rem;
  }
  
  .mission-summary-cta:hover {
    background: linear-gradient(135deg, #3B1CD9 0%, #5D4CD8 100%);
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(75, 44, 235, 0.3);
  }
  
  /* Select caché pour compatibilité */
  .mission-form-hidden-select {
    position: absolute;
    opacity: 0;
    pointer-events: none;
    height: 0;
    overflow: hidden;
  }
  
  /* Hidden class */
  .hidden {
    display: none !important;
  }
  
  /* Date range picker premium */
  .flatpickr-calendar {
    border-radius: 1rem !important;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15) !important;
  }
  
  .flatpickr-day.selected,
  .flatpickr-day.startRange,
  .flatpickr-day.endRange {
    background: linear-gradient(135deg, #4B2CEB 0%, #6D5CE8 100%) !important;
    border-color: #4B2CEB !important;
  }
  
  .flatpickr-day.inRange {
    background: rgba(75, 44, 235, 0.1) !important;
    border-color: rgba(75, 44, 235, 0.2) !important;
  }
</style>
@endsection

@section('content')
<div class="mission-form-container" id="missionFormApp">
  <div class="mission-form-wrapper">
    <div class="mission-form-main">
      <h1 class="mission-form-title">Soumettre une mission</h1>
      <p class="mission-form-subtitle">Dites-nous l'essentiel. Nous vous guidons vers le bon univers, puis vers le prochain pas.</p>
      
      <!-- Stepper -->
      <div class="mission-stepper">
        <div class="mission-stepper-step" data-step="1" id="stepper-1">
          <div class="mission-stepper-circle">1</div>
          <div class="mission-stepper-label">Univers</div>
                </div>
        <div class="mission-stepper-step" data-step="2" id="stepper-2">
          <div class="mission-stepper-circle">2</div>
          <div class="mission-stepper-label">Votre mission</div>
        </div>
        <div class="mission-stepper-step" data-step="3" id="stepper-3">
          <div class="mission-stepper-circle">3</div>
          <div class="mission-stepper-label">Préférences</div>
        </div>
        <div class="mission-stepper-step" data-step="4" id="stepper-4">
          <div class="mission-stepper-circle">4</div>
          <div class="mission-stepper-label">Option & envoi</div>
        </div>
      </div>
      
      <form action="{{ route('mission.submit') }}" method="POST" enctype="multipart/form-data" id="missionForm">
                        @csrf

        <!-- Select caché pour compatibilité backend -->
        <select name="univers_slug" id="univers_slug_hidden" class="mission-form-hidden-select" required>
          <option value="">{{ old('univers_slug', '') }}</option>
        </select>
        <!-- ID pour JS -->
        <div id="js-universe" style="display: none;"></div>

        <!-- Étape 1: Univers -->
        <div class="mission-form-step active" data-step="1" id="step-1">
          <div class="mission-form-card">
            <h2 class="mission-form-section-title">Choisissez votre univers</h2>
            
            <div class="mission-univers-grid">
              <label class="mission-univers-card" data-value="projets-consulting">
                <input type="radio" name="univers_slug_radio" value="projets-consulting" {{ old('univers_slug') === 'projets-consulting' ? 'checked' : '' }}>
                <div class="mission-univers-card-title">Projets & Consulting</div>
              </label>
              
              <label class="mission-univers-card" data-value="cours-mentorat">
                <input type="radio" name="univers_slug_radio" value="cours-mentorat" {{ old('univers_slug') === 'cours-mentorat' ? 'checked' : '' }}>
                <div class="mission-univers-card-title">Cours & Mentorat</div>
              </label>
              
              <label class="mission-univers-card" data-value="service-domicile">
                <input type="radio" name="univers_slug_radio" value="service-domicile" {{ old('univers_slug') === 'service-domicile' ? 'checked' : '' }}>
                <div class="mission-univers-card-title">Service à domicile</div>
              </label>
              
              <label class="mission-univers-card" data-value="echange-logement">
                <input type="radio" name="univers_slug_radio" value="echange-logement" {{ old('univers_slug') === 'echange-logement' ? 'checked' : '' }}>
                <div class="mission-univers-card-title">Échange de logement</div>
              </label>
              
              <label class="mission-univers-card" data-value="wellnesslive">
                <input type="radio" name="univers_slug_radio" value="wellnesslive" {{ old('univers_slug') === 'wellnesslive' ? 'checked' : '' }}>
                <div class="mission-univers-card-title">WellnessLive</div>
              </label>
              
              <label class="mission-univers-card" data-value="pause-souffle">
                <input type="radio" name="univers_slug_radio" value="pause-souffle" {{ old('univers_slug') === 'pause-souffle' ? 'checked' : '' }}>
                <div class="mission-univers-card-title">Pause Souffle</div>
              </label>
            </div>
            
            @error('univers_slug')
              <div class="mission-form-error">{{ $message }}</div>
            @enderror
            
            <div style="margin-top: 1.5rem;">
              <label for="about_you" class="mission-form-label">
                En quelques lignes, qui êtes-vous — au-delà du Rituel ? (optionnel)
              </label>
              <textarea id="about_you" 
                        name="about_you" 
                        rows="4"
                        class="mission-form-textarea @error('about_you') border-red-500 @enderror">{{ old('about_you') }}</textarea>
              <p class="mission-form-helper">Une saison, une force, une priorité. Quelques mots suffisent.</p>
              @error('about_you')
                <div class="mission-form-error">{{ $message }}</div>
              @enderror
            </div>
            
            <!-- Champs conditionnels par univers -->
            <div id="conditionalFields" style="display: none; margin-top: 1.5rem; padding-top: 1.5rem; border-top: 1px solid #e5e7eb;">
              <!-- Les champs conditionnels seront injectés ici via JS -->
            </div>
            
            <!-- Section Échange de logement (homeswap) -->
            <div id="js-exchange-section" class="hidden" style="margin-top: 1.5rem; padding-top: 1.5rem; border-top: 1px solid #e5e7eb;">
              <h3 class="mission-form-section-title" style="font-size: 1rem;">Échange de logement</h3>
              <p class="mission-form-helper" style="margin-bottom: 1.5rem;">L'échange parfait, c'est un cadre clair : dates, type d'échange, objectif.</p>
              
              <div style="margin-bottom: 1.5rem;">
                <label for="js-ex-dates" class="mission-form-label">Dates du séjour</label>
                <input type="text" 
                       id="js-ex-dates" 
                       name="ex_dates_range" 
                       class="mission-form-input" 
                       placeholder="Du ... / Au ..."
                       readonly
                       style="cursor: pointer; background: #ffffff;">
                <input type="hidden" id="js-ex-start" name="ex_start">
                <input type="hidden" id="js-ex-end" name="ex_end">
                <p id="js-ex-nights" class="mission-form-helper" style="display: none; margin-top: 0.25rem; color: #4B2CEB; font-weight: 500;"></p>
              </div>
              
              <div style="margin-bottom: 1.5rem;">
                <label class="mission-form-label">Type d'échange</label>
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1rem; margin-top: 0.5rem;">
                  <label class="mission-univers-card" style="cursor: pointer;">
                    <input type="radio" id="js-ex-type-simultane" name="ex_type" value="simultane" style="position: absolute; opacity: 0;">
                    <div class="mission-univers-card-title" style="margin: 0;">Simultané</div>
                    <p style="font-size: 0.75rem; color: #64748b; margin: 0.5rem 0 0 0;">Échange au même moment</p>
                    <p style="font-size: 0.7rem; color: #9ca3af; margin: 0.25rem 0 0 0; font-style: italic;">Vous partez quand l'autre arrive</p>
                  </label>
                  <label class="mission-univers-card" style="cursor: pointer;">
                    <input type="radio" id="js-ex-type-non-simultane" name="ex_type" value="non-simultane" style="position: absolute; opacity: 0;">
                    <div class="mission-univers-card-title" style="margin: 0;">Non simultané</div>
                    <p style="font-size: 0.75rem; color: #64748b; margin: 0.5rem 0 0 0;">Échange à des dates différentes</p>
                    <p style="font-size: 0.7rem; color: #9ca3af; margin: 0.25rem 0 0 0; font-style: italic;">Dates décalées, plus de flexibilité</p>
                  </label>
                  <label class="mission-univers-card" style="cursor: pointer;">
                    <input type="radio" id="js-ex-type-points" name="ex_type" value="points" style="position: absolute; opacity: 0;">
                    <div class="mission-univers-card-title" style="margin: 0;">Points</div>
                    <p style="font-size: 0.75rem; color: #64748b; margin: 0.5rem 0 0 0;">Système de points</p>
                    <p style="font-size: 0.7rem; color: #9ca3af; margin: 0.25rem 0 0 0; font-style: italic;">Gagnez des points en hébergeant</p>
                  </label>
                </div>
                <p class="mission-form-helper" style="margin-top: 0.5rem; font-size: 0.75rem;">
                  <strong>Pourquoi les points ?</strong> Les points permettent d'échanger sans simultanéité : vous gagnez des points en hébergeant, vous les utilisez pour voyager.
                </p>
                <div id="js-ex-points-info" class="hidden" style="margin-top: 1rem; padding: 1rem; background: rgba(75, 44, 235, 0.05); border-radius: 1rem; border: 1px solid rgba(75, 44, 235, 0.2);">
                  <p style="font-size: 0.875rem; color: #1a202c; margin: 0;">
                    <strong>Système de points HomeSwap :</strong> Hébergez des voyageurs et accumulez des points. Utilisez ensuite ces points pour séjourner dans d'autres logements, sans contrainte de dates simultanées. Idéal pour une flexibilité maximale.
                  </p>
                </div>
              </div>
              
              <div style="margin-bottom: 1.5rem;">
                <label for="js-ex-objectif" class="mission-form-label">Objectif du séjour</label>
                <select id="js-ex-objectif" name="ex_objectif" class="mission-form-select">
                  <option value="">Sélectionnez</option>
                  <option value="vacances">Vacances</option>
                  <option value="echange-linguistique">Échange linguistique</option>
                  <option value="travail-distance">Travail à distance</option>
                  <option value="famille">Famille</option>
                  <option value="etudes">Études</option>
                  <option value="decouverte-ville">Découverte d'une ville</option>
                  <option value="repos-pause-souffle">Repos / Pause souffle</option>
                  <option value="autre">Autre (précisez)</option>
                </select>
              </div>
              
              <div id="js-ex-objectif-other" class="hidden" style="margin-bottom: 1.5rem;">
                <label for="js-ex-objectif-other-text" class="mission-form-label">Expliquez votre objectif</label>
                <textarea id="js-ex-objectif-other-text" name="ex_objectif_other" rows="2" class="mission-form-textarea"></textarea>
              </div>
              
              <div style="margin-bottom: 1.5rem;">
                <label for="js-ex-logement" class="mission-form-label">Type de logement</label>
                <select id="js-ex-logement" name="ex_logement" class="mission-form-select">
                  <option value="">Sélectionnez</option>
                  <option value="chambre">Chambre</option>
                  <option value="appartement">Appartement</option>
                  <option value="maison">Maison</option>
                  <option value="penthouse">Penthouse</option>
                  <option value="autre">Autre</option>
                </select>
              </div>
              
              <div id="js-ex-logement-other" class="hidden" style="margin-bottom: 1.5rem;">
                <label for="js-ex-logement-other-text" class="mission-form-label">Précisez le type de logement</label>
                <input type="text" id="js-ex-logement-other-text" name="ex_logement_other" class="mission-form-input">
              </div>
              
              <div style="margin-bottom: 1.5rem;">
                <label for="details_destinations" class="mission-form-label">Destinations souhaitées</label>
                <input type="text" id="details_destinations" name="details[destinations]" class="mission-form-input" placeholder="Ex: Paris, Londres, Barcelone...">
              </div>
              
              <div style="margin-bottom: 1.5rem;">
                <label for="details_dates_text" class="mission-form-label">Dates (texte libre)</label>
                <input type="text" id="details_dates_text" name="details[dates_text]" class="mission-form-input" placeholder="Ex: Juillet 2024, flexible...">
              </div>
              
              <div style="margin-bottom: 1.5rem;">
                <label class="mission-form-label">Flexibilité sur les dates</label>
                <div class="mission-form-radio-group">
                  <div class="mission-form-radio-item">
                    <input type="radio" id="details_flexibility_yes" name="details[flexibility]" value="yes">
                    <label for="details_flexibility_yes">Oui, flexible</label>
                  </div>
                  <div class="mission-form-radio-item">
                    <input type="radio" id="details_flexibility_no" name="details[flexibility]" value="no">
                    <label for="details_flexibility_no">Non, dates fixes</label>
                  </div>
                </div>
              </div>
              
              <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; margin-bottom: 1.5rem;">
                <div>
                  <label for="details_travelers_adults" class="mission-form-label">Adultes</label>
                  <input type="number" id="details_travelers_adults" name="details[travelers_adults]" class="mission-form-input" min="0" placeholder="0">
                </div>
                <div>
                  <label for="details_travelers_children" class="mission-form-label">Enfants</label>
                  <input type="number" id="details_travelers_children" name="details[travelers_children]" class="mission-form-input" min="0" placeholder="0">
                </div>
              </div>
              
              <div style="margin-bottom: 1.5rem;">
                <label class="mission-form-label">Essentiels</label>
                <div class="mission-form-checkbox-group">
                  <div class="mission-form-checkbox-item">
                    <input type="checkbox" id="essential_wifi" name="details[essentials][]" value="wifi">
                    <label for="essential_wifi">WiFi</label>
                  </div>
                  <div class="mission-form-checkbox-item">
                    <input type="checkbox" id="essential_bureau" name="details[essentials][]" value="bureau">
                    <label for="essential_bureau">Bureau</label>
                  </div>
                  <div class="mission-form-checkbox-item">
                    <input type="checkbox" id="essential_cuisine" name="details[essentials][]" value="cuisine">
                    <label for="essential_cuisine">Cuisine équipée</label>
                  </div>
                  <div class="mission-form-checkbox-item">
                    <input type="checkbox" id="essential_lave_linge" name="details[essentials][]" value="lave-linge">
                    <label for="essential_lave_linge">Lave-linge</label>
                  </div>
                  <div class="mission-form-checkbox-item">
                    <input type="checkbox" id="essential_lit_bebe" name="details[essentials][]" value="lit-bebe">
                    <label for="essential_lit_bebe">Lit bébé</label>
                  </div>
                  <div class="mission-form-checkbox-item">
                    <input type="checkbox" id="essential_autre" name="details[essentials][]" value="autre">
                    <label for="essential_autre">Autre</label>
                  </div>
                </div>
              </div>
              
              <div style="margin-bottom: 1.5rem;">
                <label for="details_house_rules" class="mission-form-label">Règles de la maison</label>
                <textarea id="details_house_rules" name="details[house_rules]" rows="3" class="mission-form-textarea" placeholder="Ex: Pas de fumeurs, animaux acceptés..."></textarea>
              </div>
              
              <div>
                <label for="details_checkin" class="mission-form-label">Check-in / Check-out</label>
                <input type="text" id="details_checkin" name="details[checkin]" class="mission-form-input" placeholder="Ex: Flexible, après 15h...">
              </div>
            </div>
          </div>
          
          <div class="mission-form-nav">
            <div style="flex: 1;"></div>
            <button type="button" class="mission-form-btn-primary" onclick="goToStep(2)">Continuer</button>
          </div>
        </div>

        <!-- Étape 2: Votre mission -->
        <div class="mission-form-step" data-step="2" id="step-2">
          <!-- Informations Personnelles -->
          <div class="mission-form-card">
            <h2 class="mission-form-section-title">Informations Personnelles</h2>
            
            <div style="display: grid; grid-template-columns: 1fr; gap: 1rem; margin-bottom: 1rem;">
              <div>
                <label for="client_nom" class="mission-form-label">
                  Nom complet <span style="color: #dc2626;">*</span>
                </label>
                <input type="text" 
                       id="client_nom" 
                       name="client_nom" 
                       value="{{ old('client_nom') }}" 
                       class="mission-form-input @error('client_nom') border-red-500 @enderror" 
                       required>
                                    @error('client_nom')
                  <div class="mission-form-error">{{ $message }}</div>
                                    @enderror
                                </div>

              <div>
                <label for="client_email" class="mission-form-label">
                  Email <span style="color: #dc2626;">*</span>
                </label>
                <input type="email" 
                       id="client_email" 
                       name="client_email" 
                       value="{{ old('client_email') }}" 
                       class="mission-form-input @error('client_email') border-red-500 @enderror" 
                       required>
                                    @error('client_email')
                  <div class="mission-form-error">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

            <div>
              <label for="client_telephone" class="mission-form-label">Téléphone</label>
              <input type="tel" 
                     id="client_telephone" 
                     name="client_telephone" 
                     value="{{ old('client_telephone') }}" 
                     class="mission-form-input @error('client_telephone') border-red-500 @enderror">
                                    @error('client_telephone')
                <div class="mission-form-error">{{ $message }}</div>
                                    @enderror
                            </div>
                        </div>

          <div class="mission-form-card">
            <h2 class="mission-form-section-title">Description de la Mission</h2>
            
            <div style="margin-bottom: 1.5rem;">
              <label for="description_mission" class="mission-form-label">
                Décrivez votre Rituel <span style="color: #dc2626;">*</span>
              </label>
              <textarea id="js-description" 
                        name="description_mission" 
                        rows="6"
                        class="mission-form-textarea @error('description_mission') border-red-500 @enderror" 
                        required>{{ old('description_mission') }}</textarea>
                                @error('description_mission')
                <div class="mission-form-error">{{ $message }}</div>
                                @enderror
                            </div>

            <div id="js-budget-section" style="margin-bottom: 1.5rem;">
              <label for="budget" class="mission-form-label">
                Budget estimé (€) <span style="color: #dc2626;">*</span>
              </label>
              <input type="number" 
                     id="budget" 
                     name="budget" 
                     value="{{ old('budget') }}" 
                     min="0" 
                     step="5" 
                     class="mission-form-input @error('budget') border-red-500 @enderror" 
                     required>
                                @error('budget')
                <div class="mission-form-error">{{ $message }}</div>
                                @enderror
              <small id="bonus-indicator" style="display: none; color: #4B2CEB; font-weight: 600; margin-top: 0.25rem;"></small>
                            </div>

            <div>
              <label for="fichier_joint" class="mission-form-label">Fichier joint (optionnel)</label>
              <input type="file" 
                     id="fichier_joint" 
                     name="fichier_joint" 
                     accept=".pdf,.doc,.docx,.jpg,.jpeg,.png"
                     class="mission-form-input @error('fichier_joint') border-red-500 @enderror">
                                @error('fichier_joint')
                <div class="mission-form-error">{{ $message }}</div>
                                @enderror
              <p class="mission-form-helper">Taille max : 10MB</p>
                            </div>
                        </div>

          <div class="mission-form-nav">
            <button type="button" class="mission-form-btn-secondary" onclick="goToStep(1)">Retour</button>
            <button type="button" class="mission-form-btn-primary" onclick="goToStep(3)">Continuer</button>
          </div>
        </div>

        <!-- Étape 3: Préférences -->
        <div class="mission-form-step" data-step="3" id="step-3">
          <div class="mission-form-card">
            <h2 class="mission-form-section-title">Préférences (optionnel)</h2>
            
            <div style="display: grid; grid-template-columns: 1fr; gap: 1rem;">
              <div>
                <label for="preferred_contact" class="mission-form-label">Contact préféré</label>
                <select id="preferred_contact" name="preferred_contact" class="mission-form-select">
                  <option value="">Sélectionnez</option>
                  <option value="email" {{ old('preferred_contact') === 'email' ? 'selected' : '' }}>Email</option>
                  <option value="whatsapp" {{ old('preferred_contact') === 'whatsapp' ? 'selected' : '' }}>WhatsApp</option>
                  <option value="call" {{ old('preferred_contact') === 'call' ? 'selected' : '' }}>Appel</option>
                </select>
              </div>

              <div>
                <label for="language" class="mission-form-label">Langue</label>
                <select id="language" name="language" class="mission-form-select">
                  <option value="">Sélectionnez</option>
                  <option value="fr" {{ old('language') === 'fr' ? 'selected' : '' }}>Français</option>
                  <option value="en" {{ old('language') === 'en' ? 'selected' : '' }}>English</option>
                  <option value="it" {{ old('language') === 'it' ? 'selected' : '' }}>Italiano</option>
                </select>
              </div>

              <div id="js-location-mode-section">
                <label for="location_mode" class="mission-form-label">Mode de travail</label>
                <select id="location_mode" name="location_mode" class="mission-form-select">
                  <option value="">Sélectionnez</option>
                  <option value="remote" {{ old('location_mode') === 'remote' ? 'selected' : '' }}>Distant</option>
                  <option value="hybrid" {{ old('location_mode') === 'hybrid' ? 'selected' : '' }}>Hybride</option>
                  <option value="onsite" {{ old('location_mode') === 'onsite' ? 'selected' : '' }}>Sur site</option>
                </select>
              </div>
            </div>
          </div>
          
          <div class="mission-form-nav">
            <button type="button" class="mission-form-btn-secondary" onclick="goToStep(2)">Retour</button>
            <button type="button" class="mission-form-btn-primary" onclick="goToStep(4)">Continuer</button>
          </div>
        </div>

        <!-- Étape 4: Option & envoi -->
        <div class="mission-form-step" data-step="4" id="step-4">
          <div id="js-option-section" class="mission-form-card">
            <h2 class="mission-form-section-title">Choisissez votre Option</h2>
            
            <div class="mission-form-radio-group" id="js-options-content">
              <div class="mission-form-radio-item">
                <input type="radio" name="offre" id="offre_accompagnement" value="Accompagnement" {{ old('offre') === 'Accompagnement' ? 'checked' : '' }}>
                <label for="offre_accompagnement">
                  <strong class="js-option-title">Accompagnement complet - 99€</strong>
                  <ul class="js-option-details" style="margin: 0.5rem 0 0 0; padding-left: 1.25rem; font-size: 0.875rem; color: #64748b;">
                                        <li>Gestion par l'équipe Junspro</li>
                                        <li>Envoi de 3 freelances pré-qualifiés</li>
                                        <li>RDV visio via Zoom</li>
                                        <li>Suivi personnalisé</li>
                                    </ul>
                                </label>
                            </div>

              <div class="mission-form-radio-item">
                <input type="radio" name="offre" id="offre_mise_relation" value="Mise_en_relation" {{ old('offre') === 'Mise_en_relation' ? 'checked' : (!old('offre') ? 'checked' : '') }}>
                <label for="offre_mise_relation">
                  <strong class="js-option-title">Mise en relation simple - 9,99€</strong>
                  <ul class="js-option-details" style="margin: 0.5rem 0 0 0; padding-left: 1.25rem; font-size: 0.875rem; color: #64748b;">
                                        <li>Mise en relation avec un ou plusieurs freelances</li>
                                        <li>Sans visio ni suivi</li>
                                    </ul>
                                </label>
                            </div>

              <div class="mission-form-radio-item">
                <input type="radio" name="offre" id="offre_aucune" value="Aucune" {{ old('offre') === 'Aucune' ? 'checked' : '' }}>
                <label for="offre_aucune">
                  <strong class="js-option-title">Aucune option</strong>
                  <ul class="js-option-details" style="margin: 0.5rem 0 0 0; padding-left: 1.25rem; font-size: 0.875rem; color: #64748b;">
                                        <li>Postez votre mission sans accompagnement</li>
                                        <li>Gratuit</li>
                                    </ul>
                                </label>
              </div>
                            </div>

                            @error('offre')
              <div class="mission-form-error">{{ $message }}</div>
                            @enderror
                        </div>

          <div class="mission-form-alert">
            <strong>Note :</strong> 10% de frais de protection Junspro seront appliqués sur chaque paiement. 
                            Ces frais couvrent l'assistance, la sécurité, les outils techniques et la modération.
                        </div>

          <div class="mission-form-nav">
            <button type="button" class="mission-form-btn-secondary" onclick="goToStep(3)">Retour</button>
            <button type="submit" class="mission-form-btn-primary">Envoyer ma demande</button>
          </div>
                        </div>
                    </form>
                </div>
    
    <!-- Résumé -->
    <div class="mission-summary js-mission-summary" id="missionSummary">
      <div class="mission-summary-toggle" onclick="toggleSummary()">
        <div class="mission-summary-title">Résumé</div>
        <span id="summaryToggleIcon">▼</span>
            </div>
      <div class="mission-summary-content">
        <div class="mission-summary-item">
          <div class="mission-summary-label">Univers</div>
          <div class="mission-summary-value" id="summaryUnivers">
            <span class="mission-summary-empty">Non sélectionné</span>
          </div>
        </div>
        <div class="mission-summary-item" id="js-summary-budget-item">
          <div class="mission-summary-label">Budget</div>
          <div class="mission-summary-value" id="summaryBudget">
            <span class="mission-summary-empty">Non renseigné</span>
          </div>
        </div>
        <div class="mission-summary-item hidden" id="js-summary-subscription-item">
          <div class="mission-summary-label">Abonnement HomeSwap</div>
          <div class="mission-summary-value" id="summarySubscription">
            <span style="display: block; margin-bottom: 0.75rem;">99€/an (requis pour message & visio)</span>
            <form action="{{ route('mission.homeswap.checkout') }}" method="POST" style="margin: 0;">
              @csrf
              <button type="submit" class="mission-summary-cta">
                S'abonner (99€/an)
              </button>
            </form>
            <a href="{{ route('user.settings.subscription') }}" style="display: block; margin-top: 0.5rem; color: #64748b; font-size: 0.75rem; text-decoration: underline; text-align: center;">Gérer mon abonnement</a>
          </div>
        </div>
        <div class="mission-summary-item">
          <div class="mission-summary-label">Option</div>
          <div class="mission-summary-value" id="summaryOption">
            <span class="mission-summary-empty">Non sélectionnée</span>
          </div>
        </div>
      </div>
        </div>
    </div>
</div>

<!-- Flatpickr pour date range picker -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/fr.js"></script>

<script>
// Gestion du stepper
let currentStep = 1;
const totalSteps = 4;

function updateStepper(step) {
  // Mettre à jour les étapes
  for (let i = 1; i <= totalSteps; i++) {
    const stepEl = document.getElementById(`step-${i}`);
    const stepperEl = document.getElementById(`stepper-${i}`);
    
    if (i < step) {
      stepEl.classList.remove('active');
      stepperEl.classList.remove('active');
      stepperEl.classList.add('completed');
    } else if (i === step) {
      stepEl.classList.add('active');
      stepperEl.classList.add('active');
      stepperEl.classList.remove('completed');
    } else {
      stepEl.classList.remove('active');
      stepperEl.classList.remove('active', 'completed');
    }
  }
  
  currentStep = step;
  updateSummary();
}

function goToStep(step) {
  // Validation avant de passer à l'étape suivante
  if (step > currentStep) {
    if (currentStep === 1) {
      const universSelected = document.querySelector('input[name="univers_slug_radio"]:checked');
      if (!universSelected) {
        alert('Veuillez sélectionner un univers');
        return;
      }
    } else if (currentStep === 2) {
      const nom = document.getElementById('client_nom').value;
      const email = document.getElementById('client_email').value;
      const description = document.getElementById('js-description').value;
      
      // Vérifier budget seulement si pas HomeSwap
      const universRadio = document.querySelector('input[name="univers_slug_radio"]:checked');
      const isHomeSwap = universRadio && universRadio.value === HOME_SWAP_VALUE;
      const budget = document.getElementById('budget').value;
      
      if (!nom || !email || !description) {
        alert('Veuillez remplir tous les champs obligatoires');
        return;
      }
      
      if (!isHomeSwap && !budget) {
        alert('Veuillez remplir le budget');
        return;
      }
    }
  }
  
  updateStepper(step);
  window.scrollTo({ top: 0, behavior: 'smooth' });
}

  // Fonction pour détecter si homeswap est actif
  function isHomeswap(universValue, universText) {
    if (!universValue && !universText) return false;
    const value = (universValue || '').toLowerCase();
    const text = (universText || '').toLowerCase();
    return value === HOME_SWAP_VALUE || 
           value.includes('home') || 
           value.includes('swap') ||
           text.includes('échange') || 
           text.includes('logement');
  }
  
  // HOME_SWAP_VALUE: valeur backend pour "Échange de logement"
  const HOME_SWAP_VALUE = 'echange-logement';
  
  // Fonction pour gérer le mode homeswap
  function handleHomeswapMode(isActive) {
    const exchangeSection = document.getElementById('js-exchange-section');
    const budgetSection = document.getElementById('js-budget-section');
    const optionSection = document.getElementById('js-option-section');
    const locationModeSection = document.getElementById('js-location-mode-section');
    const budgetInput = document.getElementById('budget');
    
    if (isActive) {
      // Afficher section échange
      if (exchangeSection) {
        exchangeSection.classList.remove('hidden');
      }
      
      // Cacher budget et mode de travail (mais GARDER l'option visible)
      if (budgetSection) {
        budgetSection.classList.add('hidden');
      }
      // NE PLUS CACHER l'option : elle doit être accessible pour tous les univers
      // if (optionSection) {
      //   optionSection.classList.add('hidden');
      // }
      if (locationModeSection) {
        locationModeSection.classList.add('hidden');
      }
      
      // Nettoyer budget (vide/null) pour éviter "0,00€" dans le résumé
      if (budgetInput) {
        budgetInput.value = '';
        budgetInput.removeAttribute('required');
      }
      
      // Adapter les textes des options pour HomeSwap
      updateOptionsTextForHomeSwap(true);
      
      // Ne plus forcer automatiquement "Mise en relation" : l'utilisateur doit pouvoir choisir
      // Le défaut reste géré par le backend/Blade (old('offre') ou checked par défaut)
    } else {
      // Cacher section échange
      if (exchangeSection) {
        exchangeSection.classList.add('hidden');
      }
      
      // Afficher budget, options et mode de travail
      if (budgetSection) {
        budgetSection.classList.remove('hidden');
      }
      if (optionSection) {
        optionSection.classList.remove('hidden');
      }
      if (locationModeSection) {
        locationModeSection.classList.remove('hidden');
      }
      
      // Remettre budget required pour les autres univers
      if (budgetInput) {
        budgetInput.setAttribute('required', 'required');
      }
      
      // Restaurer les textes des options standards
      updateOptionsTextForHomeSwap(false);
    }
    
    updateSummary();
  }
  
  // Fonction pour adapter les textes des options selon HomeSwap
  function updateOptionsTextForHomeSwap(isHomeSwap) {
    const accompTitle = document.querySelector('#offre_accompagnement + label .js-option-title');
    const accompDetails = document.querySelector('#offre_accompagnement + label .js-option-details');
    const simpleTitle = document.querySelector('#offre_mise_relation + label .js-option-title');
    const simpleDetails = document.querySelector('#offre_mise_relation + label .js-option-details');
    const noneTitle = document.querySelector('#offre_aucune + label .js-option-title');
    const noneDetails = document.querySelector('#offre_aucune + label .js-option-details');
    
    if (isHomeSwap) {
      // Microcopy premium adaptée à HomeSwap (prix inchangés)
      if (accompTitle) accompTitle.textContent = 'Accompagnement complet - 99€';
      if (accompDetails) accompDetails.innerHTML = '<li>Stratégie d\'échange + optimisation du profil logement</li><li>Check-list sécurité + bonnes pratiques</li><li>Aide à la rédaction annonce + photos conseillées</li><li>Visio de cadrage + suivi</li>';
      
      if (simpleTitle) simpleTitle.textContent = 'Mise en relation simple - 9,99€';
      if (simpleDetails) simpleDetails.innerHTML = '<li>Matching de 1 à 3 logements adaptés</li><li>Message guidé + première mise en relation</li><li>Sans suivi ni visio</li>';
      
      if (noneTitle) noneTitle.textContent = 'Aucune option - Gratuit';
      if (noneDetails) noneDetails.innerHTML = '<li>Dépôt de la demande sans matching</li><li>Vous gérez ensuite vos échanges</li>';
    } else {
      // Textes standards pour les autres univers
      if (accompTitle) accompTitle.textContent = 'Accompagnement complet - 99€';
      if (accompDetails) accompDetails.innerHTML = '<li>Gestion par l\'équipe Junspro</li><li>Envoi de 3 freelances pré-qualifiés</li><li>RDV visio via Zoom</li><li>Suivi personnalisé</li>';
      
      if (simpleTitle) simpleTitle.textContent = 'Mise en relation simple - 9,99€';
      if (simpleDetails) simpleDetails.innerHTML = '<li>Mise en relation avec un ou plusieurs freelances</li><li>Sans visio ni suivi</li>';
      
      if (noneTitle) noneTitle.textContent = 'Aucune option';
      if (noneDetails) noneDetails.innerHTML = '<li>Postez votre mission sans accompagnement</li><li>Gratuit</li>';
    }
  }
  
  // Synchroniser les radios avec le select caché
document.addEventListener('DOMContentLoaded', function() {
    const radios = document.querySelectorAll('input[name="univers_slug_radio"]');
    const hiddenSelect = document.getElementById('univers_slug_hidden');
    
    radios.forEach(radio => {
      radio.addEventListener('change', function() {
        hiddenSelect.value = this.value;
        hiddenSelect.name = 'univers_slug';
        
        // Mettre à jour l'apparence des cartes
        document.querySelectorAll('.mission-univers-card').forEach(card => {
          card.classList.remove('selected');
        });
        this.closest('.mission-univers-card').classList.add('selected');
        
        // Détecter homeswap
        const cardTitle = this.closest('.mission-univers-card').querySelector('.mission-univers-card-title')?.textContent || '';
        const isHomeswapActive = isHomeswap(this.value, cardTitle);
        handleHomeswapMode(isHomeswapActive);
        
        // Afficher les champs conditionnels (sauf pour homeswap qui a sa propre section)
        if (!isHomeswapActive) {
          showConditionalFields(this.value);
        } else {
          // Cacher les champs conditionnels génériques pour homeswap (section dédiée utilisée)
          const conditionalFields = document.getElementById('conditionalFields');
          if (conditionalFields) {
            conditionalFields.style.display = 'none';
            conditionalFields.innerHTML = ''; // Nettoyer pour éviter affichage
          }
        }
        
        updateSummary();
      });
    
    // Initialiser l'état visuel
    if (radio.checked) {
      radio.closest('.mission-univers-card').classList.add('selected');
      hiddenSelect.value = radio.value;
      hiddenSelect.name = 'univers_slug';
      
      const cardTitle = radio.closest('.mission-univers-card').querySelector('.mission-univers-card-title')?.textContent || '';
      const isHomeswapActive = isHomeswap(radio.value, cardTitle);
      handleHomeswapMode(isHomeswapActive);
      
      if (!isHomeswapActive) {
        showConditionalFields(radio.value);
      } else {
        // Nettoyer les champs conditionnels pour homeswap
        const conditionalFields = document.getElementById('conditionalFields');
        if (conditionalFields) {
          conditionalFields.style.display = 'none';
          conditionalFields.innerHTML = '';
        }
      }
    }
  });
  
  // Date range picker premium pour HomeSwap
  const datesInput = document.getElementById('js-ex-dates');
  const startInput = document.getElementById('js-ex-start');
  const endInput = document.getElementById('js-ex-end');
  const nightsDisplay = document.getElementById('js-ex-nights');
  
  if (datesInput && startInput && endInput) {
    const flatpickrInstance = flatpickr(datesInput, {
      mode: 'range',
      dateFormat: 'd/m/Y',
      locale: 'fr',
      minDate: 'today',
      onChange: function(selectedDates, dateStr, instance) {
        if (selectedDates.length === 2) {
          const start = selectedDates[0];
          const end = selectedDates[1];
          
          // Empêcher fin < début
          if (end < start) {
            instance.setDate([start, start]);
            return;
          }
          
          // Mettre à jour les champs cachés
          startInput.value = start.toISOString().split('T')[0];
          endInput.value = end.toISOString().split('T')[0];
          
          // Calculer et afficher les nuits
          const nights = Math.ceil((end - start) / (1000 * 60 * 60 * 24));
          if (nightsDisplay) {
            nightsDisplay.textContent = `${nights} nuit${nights > 1 ? 's' : ''}`;
            nightsDisplay.style.display = 'block';
          }
          
          // Mettre à jour le placeholder
          datesInput.value = `Du ${start.toLocaleDateString('fr-FR')} / Au ${end.toLocaleDateString('fr-FR')}`;
        } else if (selectedDates.length === 1) {
          datesInput.value = `Du ${selectedDates[0].toLocaleDateString('fr-FR')} / Au ...`;
        }
      }
    });
  }
  
  // Gérer les champs "Autre" pour objectif et logement
  const objectifSelect = document.getElementById('js-ex-objectif');
  const objectifOtherDiv = document.getElementById('js-ex-objectif-other');
  const logementSelect = document.getElementById('js-ex-logement');
  const logementOtherDiv = document.getElementById('js-ex-logement-other');
  
  if (objectifSelect && objectifOtherDiv) {
    objectifSelect.addEventListener('change', function() {
      if (this.value === 'autre') {
        objectifOtherDiv.classList.remove('hidden');
      } else {
        objectifOtherDiv.classList.add('hidden');
      }
    });
  }
  
  if (logementSelect && logementOtherDiv) {
    logementSelect.addEventListener('change', function() {
      if (this.value === 'autre') {
        logementOtherDiv.classList.remove('hidden');
      } else {
        logementOtherDiv.classList.add('hidden');
      }
    });
  }
  
  // Gérer l'apparence des cartes "Type d'échange" (style premium)
  document.querySelectorAll('input[name="ex_type"]').forEach(radio => {
    radio.addEventListener('change', function() {
      // Retirer la sélection de toutes les cartes
      document.querySelectorAll('input[name="ex_type"]').forEach(r => {
        const card = r.closest('.mission-univers-card');
        if (card) {
          card.classList.remove('selected');
        }
      });
      // Ajouter la sélection à la carte active
      const card = this.closest('.mission-univers-card');
      if (card) {
        card.classList.add('selected');
      }
      
      // Afficher/masquer l'encart explicatif pour "Points"
      const pointsInfo = document.getElementById('js-ex-points-info');
      if (pointsInfo) {
        if (this.value === 'points') {
          pointsInfo.classList.remove('hidden');
        } else {
          pointsInfo.classList.add('hidden');
        }
      }
    });
  });
  
  // Injection du résumé dans la description au submit (mode homeswap)
  const missionForm = document.getElementById('missionForm');
  if (missionForm) {
    missionForm.addEventListener('submit', function(e) {
      const universRadio = document.querySelector('input[name="univers_slug_radio"]:checked');
      if (universRadio) {
        const cardTitle = universRadio.closest('.mission-univers-card').querySelector('.mission-univers-card-title')?.textContent || '';
        const isHomeswapActive = isHomeswap(universRadio.value, cardTitle);
        
        if (isHomeswapActive) {
          const descriptionTextarea = document.getElementById('js-description');
          if (descriptionTextarea) {
            const currentDescription = descriptionTextarea.value || '';
            
            // Vérifier si le marqueur existe déjà
            if (!currentDescription.includes('[ÉCHANGE DE LOGEMENT]')) {
              // Construire le résumé structuré
              const startDateInput = document.getElementById('js-ex-start');
              const endDateInput = document.getElementById('js-ex-end');
              const datesDisplay = document.getElementById('js-ex-dates')?.value || '';
              
              let startDate = 'Non renseigné';
              let endDate = 'Non renseigné';
              
              if (startDateInput && endDateInput && startDateInput.value && endDateInput.value) {
                const start = new Date(startDateInput.value);
                const end = new Date(endDateInput.value);
                startDate = start.toLocaleDateString('fr-FR');
                endDate = end.toLocaleDateString('fr-FR');
              } else if (datesDisplay) {
                // Utiliser l'affichage du range picker si disponible
                const datesMatch = datesDisplay.match(/Du (.+?) \/ Au (.+)/);
                if (datesMatch) {
                  startDate = datesMatch[1];
                  endDate = datesMatch[2];
                }
              }
              
              const typeRadio = document.querySelector('input[name="ex_type"]:checked');
              const typeValue = typeRadio ? typeRadio.value : 'Non renseigné';
              const typeLabels = {
                'simultane': 'Simultané',
                'non-simultane': 'Non simultané',
                'points': 'Points'
              };
              const typeLabel = typeLabels[typeValue] || typeValue;
              
              const objectifSelect = document.getElementById('js-ex-objectif');
              const objectifValue = objectifSelect ? objectifSelect.value : 'Non renseigné';
              const objectifLabels = {
                'vacances': 'Vacances',
                'echange-linguistique': 'Échange linguistique',
                'travail-distance': 'Travail à distance',
                'famille': 'Famille',
                'etudes': 'Études',
                'decouverte-ville': 'Découverte d\'une ville',
                'repos-pause-souffle': 'Repos / Pause souffle',
                'autre': 'Autre'
              };
              const objectifLabel = objectifLabels[objectifValue] || objectifValue;
              const objectifOther = document.getElementById('js-ex-objectif-other-text')?.value || '';
              
              const logementSelect = document.getElementById('js-ex-logement');
              const logementValue = logementSelect ? logementSelect.value : 'Non renseigné';
              const logementLabels = {
                'chambre': 'Chambre',
                'appartement': 'Appartement',
                'maison': 'Maison',
                'penthouse': 'Penthouse',
                'autre': 'Autre'
              };
              const logementLabel = logementLabels[logementValue] || logementValue;
              const logementOther = document.getElementById('js-ex-logement-other-text')?.value || '';
              
              const summary = `\n\n[ÉCHANGE DE LOGEMENT]
Dates: ${startDate} -> ${endDate}
Type: ${typeLabel}
Objectif: ${objectifLabel}${objectifOther ? '\nObjectif (autre): ' + objectifOther : ''}
Logement: ${logementLabel}${logementOther ? '\nLogement (autre): ' + logementOther : ''}`;
              
              descriptionTextarea.value = currentDescription + summary;
            }
          }
          
          // Convertir les champs ex_* en details[...] pour sauvegarde DB
          const exType = document.querySelector('input[name="ex_type"]:checked');
          if (exType) {
            const hiddenInput = document.createElement('input');
            hiddenInput.type = 'hidden';
            hiddenInput.name = 'details[exchange_type]';
            hiddenInput.value = exType.value;
            missionForm.appendChild(hiddenInput);
          }
          
          const exObjectif = document.getElementById('js-ex-objectif');
          if (exObjectif && exObjectif.value) {
            const hiddenInput = document.createElement('input');
            hiddenInput.type = 'hidden';
            hiddenInput.name = 'details[exchange_objectif]';
            hiddenInput.value = exObjectif.value;
            missionForm.appendChild(hiddenInput);
            
            if (exObjectif.value === 'autre') {
              const otherText = document.getElementById('js-ex-objectif-other-text')?.value;
              if (otherText) {
                const hiddenInputOther = document.createElement('input');
                hiddenInputOther.type = 'hidden';
                hiddenInputOther.name = 'details[exchange_objectif_other]';
                hiddenInputOther.value = otherText;
                missionForm.appendChild(hiddenInputOther);
              }
            }
          }
          
          const exLogement = document.getElementById('js-ex-logement');
          if (exLogement && exLogement.value) {
            const hiddenInput = document.createElement('input');
            hiddenInput.type = 'hidden';
            hiddenInput.name = 'details[exchange_type_logement]';
            hiddenInput.value = exLogement.value;
            missionForm.appendChild(hiddenInput);
            
            if (exLogement.value === 'autre') {
              const otherText = document.getElementById('js-ex-logement-other-text')?.value;
              if (otherText) {
                const hiddenInputOther = document.createElement('input');
                hiddenInputOther.type = 'hidden';
                hiddenInputOther.name = 'details[exchange_type_logement_other]';
                hiddenInputOther.value = otherText;
                missionForm.appendChild(hiddenInputOther);
              }
            }
          }
          
          const exStart = document.getElementById('js-ex-start');
          const exEnd = document.getElementById('js-ex-end');
          if (exStart && exStart.value) {
            const hiddenInput = document.createElement('input');
            hiddenInput.type = 'hidden';
            hiddenInput.name = 'details[exchange_start_date]';
            hiddenInput.value = exStart.value;
            missionForm.appendChild(hiddenInput);
          }
          if (exEnd && exEnd.value) {
            const hiddenInput = document.createElement('input');
            hiddenInput.type = 'hidden';
            hiddenInput.name = 'details[exchange_end_date]';
            hiddenInput.value = exEnd.value;
            missionForm.appendChild(hiddenInput);
          }
        }
      }
    });
  }
  
  // Gérer les range inputs (sliders) pour Pause Souffle
  const energyRange = document.getElementById('details_energy');
  const clarityRange = document.getElementById('details_clarity');
  const stressRange = document.getElementById('details_stress');
  
  if (energyRange) {
    const energyValue = document.getElementById('energy_value');
    energyRange.addEventListener('input', function() {
      if (energyValue) energyValue.textContent = this.value;
    });
  }
  
  if (clarityRange) {
    const clarityValue = document.getElementById('clarity_value');
    clarityRange.addEventListener('input', function() {
      if (clarityValue) clarityValue.textContent = this.value;
    });
  }
  
  if (stressRange) {
    const stressValue = document.getElementById('stress_value');
    stressRange.addEventListener('input', function() {
      if (stressValue) stressValue.textContent = this.value;
    });
  }
  
  // Fonction pour afficher les champs conditionnels
  function showConditionalFields(universSlug) {
    const container = document.getElementById('conditionalFields');
    if (!container) return;
    
    container.innerHTML = '';
    container.style.display = 'none';
    
    if (!universSlug) return;
    
    const fields = getConditionalFields(universSlug);
    if (fields) {
      container.innerHTML = fields;
      container.style.display = 'block';
    }
  }
  
  function getConditionalFields(universSlug) {
    const fieldsMap = {
      'projets-consulting': `
        <h3 class="mission-form-section-title" style="font-size: 1rem; margin-bottom: 1.5rem;">Détails - Projets & Consulting</h3>
        <div style="margin-bottom: 1.5rem;">
          <label for="details_domain" class="mission-form-label">Domaine</label>
          <select id="details_domain" name="details[domain]" class="mission-form-select">
            <option value="">Sélectionnez un domaine</option>
            <option value="strategie">Stratégie</option>
            <option value="marketing">Marketing</option>
            <option value="design">Design</option>
            <option value="dev">Développement</option>
            <option value="ops">Ops / Infrastructure</option>
            <option value="finance">Finance</option>
            <option value="autre">Autre</option>
          </select>
        </div>
        <div style="margin-bottom: 1.5rem;">
          <label class="mission-form-label">Livrables</label>
          <div class="mission-form-checkbox-group">
            <div class="mission-form-checkbox-item">
              <input type="checkbox" id="deliverable_audit" name="details[deliverables][]" value="audit">
              <label for="deliverable_audit">Audit</label>
            </div>
            <div class="mission-form-checkbox-item">
              <input type="checkbox" id="deliverable_plan" name="details[deliverables][]" value="plan">
              <label for="deliverable_plan">Plan</label>
            </div>
            <div class="mission-form-checkbox-item">
              <input type="checkbox" id="deliverable_maquettes" name="details[deliverables][]" value="maquettes">
              <label for="deliverable_maquettes">Maquettes</label>
            </div>
            <div class="mission-form-checkbox-item">
              <input type="checkbox" id="deliverable_texte" name="details[deliverables][]" value="texte">
              <label for="deliverable_texte">Texte</label>
            </div>
            <div class="mission-form-checkbox-item">
              <input type="checkbox" id="deliverable_dev" name="details[deliverables][]" value="dev">
              <label for="deliverable_dev">Développement</label>
            </div>
            <div class="mission-form-checkbox-item">
              <input type="checkbox" id="deliverable_automatisation" name="details[deliverables][]" value="automatisation">
              <label for="deliverable_automatisation">Automatisation</label>
            </div>
            <div class="mission-form-checkbox-item">
              <input type="checkbox" id="deliverable_autre" name="details[deliverables][]" value="autre">
              <label for="deliverable_autre">Autre</label>
            </div>
          </div>
        </div>
        <div style="margin-bottom: 1.5rem;">
          <label for="details_scope_in" class="mission-form-label">Dans le périmètre</label>
          <input type="text" id="details_scope_in" name="details[scope_in]" class="mission-form-input" placeholder="Ce qui est inclus dans la mission">
        </div>
        <div style="margin-bottom: 1.5rem;">
          <label for="details_scope_out" class="mission-form-label">Hors périmètre</label>
          <input type="text" id="details_scope_out" name="details[scope_out]" class="mission-form-input" placeholder="Ce qui n'est pas inclus">
        </div>
        <div style="margin-bottom: 1.5rem;">
          <label class="mission-form-label">Décideur identifié ?</label>
          <div class="mission-form-radio-group">
            <div class="mission-form-radio-item">
              <input type="radio" id="decision_yes" name="details[decision_maker]" value="yes">
              <label for="decision_yes">Oui</label>
            </div>
            <div class="mission-form-radio-item">
              <input type="radio" id="decision_no" name="details[decision_maker]" value="no">
              <label for="decision_no">Non</label>
            </div>
          </div>
        </div>
        <div>
          <label for="details_tools" class="mission-form-label">Outils utilisés</label>
          <input type="text" id="details_tools" name="details[tools]" class="mission-form-input" placeholder="Ex: Figma, Notion, Slack...">
        </div>
      `,
      'cours-mentorat': `
        <h3 class="mission-form-section-title" style="font-size: 1rem; margin-bottom: 1.5rem;">Détails - Cours & Mentorat</h3>
        <div style="margin-bottom: 1.5rem;">
          <label for="details_topic" class="mission-form-label">Sujet</label>
          <input type="text" id="details_topic" name="details[topic]" class="mission-form-input" placeholder="Ex: Python, Marketing digital, Design UX...">
        </div>
        <div style="margin-bottom: 1.5rem;">
          <label for="details_level" class="mission-form-label">Niveau</label>
          <select id="details_level" name="details[level]" class="mission-form-select">
            <option value="">Sélectionnez votre niveau</option>
            <option value="debutant">Débutant</option>
            <option value="intermediaire">Intermédiaire</option>
            <option value="avance">Avancé</option>
          </select>
        </div>
        <div style="margin-bottom: 1.5rem;">
          <label for="details_goal" class="mission-form-label">Objectif</label>
          <select id="details_goal" name="details[goal]" class="mission-form-select">
            <option value="">Sélectionnez votre objectif</option>
            <option value="examen">Examen</option>
            <option value="projet">Rituel</option>
            <option value="remise-a-niveau">Remise à niveau</option>
            <option value="confiance">Confiance</option>
            <option value="autre">Autre</option>
          </select>
        </div>
        <div style="margin-bottom: 1.5rem;">
          <label for="details_rhythm" class="mission-form-label">Rythme</label>
          <select id="details_rhythm" name="details[rhythm]" class="mission-form-select">
            <option value="">Sélectionnez le rythme</option>
            <option value="1x">1x par semaine</option>
            <option value="2x">2x par semaine</option>
            <option value="sur-mesure">Sur mesure</option>
          </select>
        </div>
        <div style="margin-bottom: 1.5rem;">
          <label for="details_format" class="mission-form-label">Format</label>
          <select id="details_format" name="details[format]" class="mission-form-select">
            <option value="">Sélectionnez le format</option>
            <option value="visio">Visio</option>
            <option value="presentiel">Présentiel</option>
            <option value="mixte">Mixte</option>
          </select>
        </div>
        <div>
          <label for="details_availability" class="mission-form-label">Disponibilité</label>
          <input type="text" id="details_availability" name="details[availability]" class="mission-form-input" placeholder="Ex: Lundi et mercredi après-midi, weekends...">
        </div>
      `,
      'service-domicile': `
        <h3 class="mission-form-section-title" style="font-size: 1rem; margin-bottom: 1.5rem;">Détails - Service à Domicile</h3>
        <div style="margin-bottom: 1.5rem;">
          <label for="details_service_type" class="mission-form-label">Type de service</label>
          <select id="details_service_type" name="details[service_type]" class="mission-form-select">
            <option value="">Sélectionnez le type de service</option>
            <option value="menage">Ménage</option>
            <option value="garde">Garde d'enfants</option>
            <option value="aide">Aide à domicile</option>
            <option value="beaute">Beauté / Bien-être</option>
            <option value="massage">Massage</option>
            <option value="bricolage">Bricolage</option>
            <option value="autre">Autre</option>
          </select>
        </div>
        <div style="margin-bottom: 1.5rem;">
          <label for="details_postal_city" class="mission-form-label">Code postal / Ville</label>
          <input type="text" id="details_postal_city" name="details[postal_city]" class="mission-form-input" placeholder="Ex: 75001 Paris">
        </div>
        <div style="margin-bottom: 1.5rem;">
          <label for="details_frequency" class="mission-form-label">Fréquence</label>
          <select id="details_frequency" name="details[frequency]" class="mission-form-select">
            <option value="">Sélectionnez la fréquence</option>
            <option value="ponctuel">Ponctuel</option>
            <option value="hebdo">Hebdomadaire</option>
            <option value="mensuel">Mensuel</option>
          </select>
        </div>
        <div style="margin-bottom: 1.5rem;">
          <label for="details_constraints" class="mission-form-label">Contraintes</label>
          <input type="text" id="details_constraints" name="details[constraints]" class="mission-form-input" placeholder="Ex: Horaires spécifiques, animaux, accessibilité...">
        </div>
        <div>
          <label class="mission-form-label">Vérification requise ?</label>
          <div class="mission-form-radio-group">
            <div class="mission-form-radio-item">
              <input type="radio" id="verified_yes" name="details[verified_required]" value="yes">
              <label for="verified_yes">Oui</label>
            </div>
            <div class="mission-form-radio-item">
              <input type="radio" id="verified_no" name="details[verified_required]" value="no">
              <label for="verified_no">Non</label>
            </div>
          </div>
        </div>
      `,
      // DOUBLON SUPPRIMÉ: échange-logement utilise la section dédiée js-exchange-section
      // Les champs conditionnels génériques ne s'affichent pas pour homeswap
      'echange-logement': null,
      'wellnesslive': `
        <h3 class="mission-form-section-title" style="font-size: 1rem; margin-bottom: 1.5rem;">Détails - WellnessLive</h3>
        <div style="margin-bottom: 1.5rem;">
          <label for="details_objective" class="mission-form-label">Objectif</label>
          <select id="details_objective" name="details[objective]" class="mission-form-select">
            <option value="">Sélectionnez votre objectif</option>
            <option value="forme">Forme</option>
            <option value="mobilite">Mobilité</option>
            <option value="energie">Énergie</option>
            <option value="reprise">Reprise sportive</option>
            <option value="autre">Autre</option>
          </select>
        </div>
        <div style="margin-bottom: 1.5rem;">
          <label class="mission-form-label">Types de Rituels</label>
          <div class="mission-form-checkbox-group">
            <div class="mission-form-checkbox-item">
              <input type="checkbox" id="class_fitness" name="details[class_types][]" value="fitness">
              <label for="class_fitness">Fitness</label>
            </div>
            <div class="mission-form-checkbox-item">
              <input type="checkbox" id="class_yoga" name="details[class_types][]" value="yoga">
              <label for="class_yoga">Yoga</label>
            </div>
            <div class="mission-form-checkbox-item">
              <input type="checkbox" id="class_pilates" name="details[class_types][]" value="pilates">
              <label for="class_pilates">Pilates</label>
            </div>
            <div class="mission-form-checkbox-item">
              <input type="checkbox" id="class_renfo" name="details[class_types][]" value="renfo">
              <label for="class_renfo">Renforcement</label>
            </div>
            <div class="mission-form-checkbox-item">
              <input type="checkbox" id="class_danse" name="details[class_types][]" value="danse">
              <label for="class_danse">Danse</label>
            </div>
            <div class="mission-form-checkbox-item">
              <input type="checkbox" id="class_autre" name="details[class_types][]" value="autre">
              <label for="class_autre">Autre</label>
            </div>
          </div>
        </div>
        <div style="margin-bottom: 1.5rem;">
          <label for="details_level_wl" class="mission-form-label">Niveau</label>
          <select id="details_level_wl" name="details[level]" class="mission-form-select">
            <option value="">Sélectionnez votre niveau</option>
            <option value="debutant">Débutant</option>
            <option value="intermediaire">Intermédiaire</option>
            <option value="avance">Avancé</option>
          </select>
        </div>
        <div style="margin-bottom: 1.5rem;">
          <label for="details_frequency_wl" class="mission-form-label">Fréquence</label>
          <select id="details_frequency_wl" name="details[frequency]" class="mission-form-select">
            <option value="">Sélectionnez la fréquence</option>
            <option value="2-semaine">2 fois par semaine</option>
            <option value="4-semaine">4 fois par semaine</option>
            <option value="illimite">Illimité</option>
          </select>
        </div>
        <div style="margin-bottom: 1.5rem;">
          <label for="details_content_pref" class="mission-form-label">Préférence de contenu</label>
          <select id="details_content_pref" name="details[content_pref]" class="mission-form-select">
            <option value="">Sélectionnez</option>
            <option value="live-only">Live uniquement</option>
            <option value="live+vod">Live + VOD</option>
          </select>
        </div>
        <div style="margin-bottom: 1.5rem;">
          <label for="details_equipment" class="mission-form-label">Équipement</label>
          <input type="text" id="details_equipment" name="details[equipment]" class="mission-form-input" placeholder="Ex: Tapis, haltères, ballon...">
        </div>
        <div>
          <label for="details_subscription_budget" class="mission-form-label">Budget abonnement</label>
          <select id="details_subscription_budget" name="details[subscription_budget]" class="mission-form-select">
            <option value="">Sélectionnez votre budget</option>
            <option value="lt20">Moins de 20€/mois</option>
            <option value="20-39">20-39€/mois</option>
            <option value="40-79">40-79€/mois</option>
            <option value="80plus">80€+/mois</option>
          </select>
        </div>
      `,
      'pause-souffle': `
        <h3 class="mission-form-section-title" style="font-size: 1rem; margin-bottom: 1.5rem;">Détails - Pause Souffle</h3>
        <div style="margin-bottom: 1.5rem;">
          <label for="details_situation" class="mission-form-label">Situation</label>
          <select id="details_situation" name="details[situation]" class="mission-form-select">
            <option value="">Sélectionnez votre situation</option>
            <option value="dirigeant">Dirigeant</option>
            <option value="salarie">Salarié</option>
            <option value="parent">Parent</option>
            <option value="freelance">Freelance</option>
            <option value="transition">En transition</option>
          </select>
        </div>
        <div style="margin-bottom: 1.5rem;">
          <label for="details_intention" class="mission-form-label">Intention</label>
          <select id="details_intention" name="details[intention]" class="mission-form-select">
            <option value="">Sélectionnez votre intention</option>
            <option value="clarte">Clarté</option>
            <option value="energie">Énergie</option>
            <option value="decisions">Décisions</option>
            <option value="equilibre">Équilibre</option>
            <option value="sens">Sens</option>
          </select>
        </div>
        <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 1rem; margin-bottom: 1.5rem;">
          <div>
            <label for="details_energy" class="mission-form-label">Énergie (0-10)</label>
            <input type="range" id="details_energy" name="details[energy]" class="mission-form-input" min="0" max="10" value="5" step="1" style="width: 100%;">
            <div style="text-align: center; font-size: 0.75rem; color: #64748b; margin-top: 0.25rem;" id="energy_value">5</div>
          </div>
          <div>
            <label for="details_clarity" class="mission-form-label">Clarté (0-10)</label>
            <input type="range" id="details_clarity" name="details[clarity]" class="mission-form-input" min="0" max="10" value="5" step="1" style="width: 100%;">
            <div style="text-align: center; font-size: 0.75rem; color: #64748b; margin-top: 0.25rem;" id="clarity_value">5</div>
          </div>
          <div>
            <label for="details_stress" class="mission-form-label">Stress (0-10)</label>
            <input type="range" id="details_stress" name="details[stress]" class="mission-form-input" min="0" max="10" value="5" step="1" style="width: 100%;">
            <div style="text-align: center; font-size: 0.75rem; color: #64748b; margin-top: 0.25rem;" id="stress_value">5</div>
          </div>
        </div>
        <div style="margin-bottom: 1.5rem;">
          <label class="mission-form-label">Protéger</label>
          <div class="mission-form-checkbox-group">
            <div class="mission-form-checkbox-item">
              <input type="checkbox" id="protect_temps" name="details[protect][]" value="temps">
              <label for="protect_temps">Temps</label>
            </div>
            <div class="mission-form-checkbox-item">
              <input type="checkbox" id="protect_sante" name="details[protect][]" value="sante">
              <label for="protect_sante">Santé</label>
            </div>
            <div class="mission-form-checkbox-item">
              <input type="checkbox" id="protect_famille" name="details[protect][]" value="famille">
              <label for="protect_famille">Famille</label>
            </div>
            <div class="mission-form-checkbox-item">
              <input type="checkbox" id="protect_foi" name="details[protect][]" value="foi">
              <label for="protect_foi">Foi</label>
            </div>
            <div class="mission-form-checkbox-item">
              <input type="checkbox" id="protect_projet" name="details[protect][]" value="projet">
              <label for="protect_projet">Rituel</label>
            </div>
            <div class="mission-form-checkbox-item">
              <input type="checkbox" id="protect_autre" name="details[protect][]" value="autre">
              <label for="protect_autre">Autre</label>
            </div>
          </div>
        </div>
        <div style="margin-bottom: 1.5rem;">
          <label for="details_vision" class="mission-form-label">Vision</label>
          <textarea id="details_vision" name="details[vision]" rows="4" class="mission-form-textarea" placeholder="Votre vision pour cette pause..."></textarea>
        </div>
        <div style="margin-bottom: 1.5rem;">
          <label for="details_coaching_style" class="mission-form-label">Style de coaching</label>
          <select id="details_coaching_style" name="details[coaching_style]" class="mission-form-select">
            <option value="">Sélectionnez votre style</option>
            <option value="structure">Structuré</option>
            <option value="doux">Doux</option>
            <option value="mixte">Mixte</option>
          </select>
        </div>
        <div style="margin-bottom: 1.5rem;">
          <label for="details_spiritual" class="mission-form-label">Dimension spirituelle</label>
          <select id="details_spiritual" name="details[spiritual]" class="mission-form-select">
            <option value="">Sélectionnez</option>
            <option value="oui">Oui</option>
            <option value="non">Non</option>
            <option value="je-ne-sais-pas">Je ne sais pas</option>
          </select>
        </div>
        <div class="mission-form-alert" style="background: rgba(251, 191, 36, 0.08); border-color: rgba(251, 191, 36, 0.3); margin-top: 1.5rem;">
          <p style="font-size: 0.8125rem; color: #1a202c; margin: 0; line-height: 1.6;">
            <strong>Important :</strong> Junspro ne remplace pas un suivi médical. Pour des problèmes de santé, consultez un professionnel de santé qualifié.
          </p>
        </div>
      `
    };
    
    // Ne pas retourner de champs pour échange-logement (section dédiée utilisée)
    if (universSlug === 'echange-logement') {
      return null;
    }
    return fieldsMap[universSlug] || null;
  }
  
  // Budget indicator
    const budgetInput = document.getElementById('budget');
    const bonusIndicator = document.getElementById('bonus-indicator');
    
  if (budgetInput && bonusIndicator) {
    budgetInput.addEventListener('input', function() {
        const budget = parseFloat(this.value) || 0;
        let bonusText = '';
        
        if (budget >= 5000) {
            bonusText = '🎉 Bonus Équilibre disponible !';
        } else if (budget >= 2500) {
            bonusText = '🎉 Bonus Sérénité disponible !';
        } else if (budget >= 500) {
            bonusText = '🎉 Bonus Vitalité disponible !';
        }
        
        if (bonusText) {
            bonusIndicator.textContent = bonusText;
        bonusIndicator.style.display = 'block';
        } else {
        bonusIndicator.style.display = 'none';
      }
      
      updateSummary();
    });
  }
  
  // Mettre à jour le résumé pour les options (écouter les changements en temps réel)
  document.querySelectorAll('input[name="offre"]').forEach(radio => {
    radio.addEventListener('change', function() {
      updateSummary(); // Met à jour le récap avec l'option sélectionnée
    });
  });
  
  // Mettre à jour le récap au chargement initial
  updateSummary();
  
  // Mettre à jour aussi quand on change d'univers (pour adapter les textes)
  document.querySelectorAll('input[name="univers_slug_radio"]').forEach(radio => {
    radio.addEventListener('change', function() {
      updateSummary();
    });
  });
  
  // Gestion des erreurs serveur - ouvrir l'étape avec erreur
  const errors = document.querySelectorAll('.mission-form-error, .is-invalid, .border-red-500');
  if (errors.length > 0) {
    let errorStep = 1;
    
    // Vérifier les champs spécifiques
    const universError = document.querySelector('#univers_slug_hidden').parentElement.querySelector('.mission-form-error');
    const clientNomError = document.getElementById('client_nom')?.classList.contains('border-red-500');
    const clientEmailError = document.getElementById('client_email')?.classList.contains('border-red-500');
    const descriptionError = document.getElementById('js-description')?.classList.contains('border-red-500');
    const budgetError = document.getElementById('budget')?.classList.contains('border-red-500');
    const offreError = document.querySelector('input[name="offre"]')?.parentElement.querySelector('.mission-form-error');
    
    if (universError) {
      errorStep = 1;
    } else if (clientNomError || clientEmailError || descriptionError || budgetError) {
      errorStep = 2;
    } else if (offreError) {
      errorStep = 4;
    }
    
    updateStepper(errorStep);
  }
  
  // Initialiser le résumé
  updateSummary();
});

function updateSummary() {
  const universRadio = document.querySelector('input[name="univers_slug_radio"]:checked');
  const universNames = {
    'projets-consulting': 'Projets & Consulting',
    'cours-mentorat': 'Cours & Mentorat',
    'service-domicile': 'Service à domicile',
    'echange-logement': 'Échange de logement',
    'wellnesslive': 'WellnessLive',
    'pause-souffle': 'Pause Souffle'
  };
  
  const universEl = document.getElementById('summaryUnivers');
  if (universRadio && universNames[universRadio.value]) {
    universEl.innerHTML = universNames[universRadio.value];
  } else {
    universEl.innerHTML = '<span class="mission-summary-empty">Non sélectionné</span>';
  }
  
  // Détecter si HomeSwap
  const isHomeSwap = universRadio && universRadio.value === HOME_SWAP_VALUE;
  const budgetItem = document.getElementById('js-summary-budget-item');
  const subscriptionItem = document.getElementById('js-summary-subscription-item');
  
  if (isHomeSwap) {
    // Masquer budget, afficher abonnement
    if (budgetItem) budgetItem.classList.add('hidden');
    if (subscriptionItem) subscriptionItem.classList.remove('hidden');
  } else {
    // Afficher budget, masquer abonnement
    if (budgetItem) budgetItem.classList.remove('hidden');
    if (subscriptionItem) subscriptionItem.classList.add('hidden');
    
    const budget = document.getElementById('budget')?.value;
    const budgetEl = document.getElementById('summaryBudget');
    if (budget && parseFloat(budget) > 0) {
      budgetEl.innerHTML = parseFloat(budget).toLocaleString('fr-FR', { style: 'currency', currency: 'EUR' });
    } else {
      budgetEl.innerHTML = '<span class="mission-summary-empty">Non renseigné</span>';
    }
  }
  
  // Option: afficher la vraie sélection (dynamique selon la valeur réelle)
  const optionRadio = document.querySelector('input[name="offre"]:checked');
  const optionEl = document.getElementById('summaryOption');
  
  if (optionRadio) {
    const optionValue = optionRadio.value; // Valeur backend réelle
    
    if (isHomeSwap) {
      // Textes adaptés pour HomeSwap selon la valeur réelle (avec prix)
      const homeSwapOptionNames = {
        'Accompagnement': 'Accompagnement complet (99€)',
        'Mise_en_relation': 'Mise en relation simple (9,99€)',
        'Aucune': 'Aucune option (Gratuit)'
      };
      optionEl.innerHTML = homeSwapOptionNames[optionValue] || optionValue;
    } else {
      // Textes standards selon la valeur réelle
      const optionNames = {
        'Accompagnement': 'Accompagnement (99€)',
        'Mise_en_relation': 'Mise en relation (9,99€)',
        'Aucune': 'Aucune (Gratuit)'
      };
      optionEl.innerHTML = optionNames[optionValue] || optionValue;
    }
  } else {
    optionEl.innerHTML = '<span class="mission-summary-empty">Non sélectionnée</span>';
  }
}

function toggleSummary() {
  const summary = document.getElementById('missionSummary');
  summary.classList.toggle('collapsed');
  const icon = document.getElementById('summaryToggleIcon');
  icon.textContent = summary.classList.contains('collapsed') ? '▶' : '▼';
}

// Micro-interactions premium pour le récapitulatif
(function() {
  'use strict';
  
  // Vérifier si l'utilisateur préfère les animations réduites
  const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
  
  if (prefersReducedMotion) {
    return; // Ne pas ajouter d'animations si l'utilisateur les a désactivées
  }
  
  const summaryCard = document.querySelector('.js-mission-summary');
  if (!summaryCard) return;
  
  let scrollTimeout;
  let isScrolling = false;
  
  // IntersectionObserver pour détecter quand la card est visible
  const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        summaryCard.classList.add('is-visible');
      } else {
        summaryCard.classList.remove('is-visible');
      }
    });
  }, {
    threshold: 0.1, // Déclencher quand au moins 10% de la card est visible
    rootMargin: '50px' // Déclencher un peu avant que la card soit complètement visible
  });
  
  observer.observe(summaryCard);
  
  // Gestion du scroll avec throttle via requestAnimationFrame
  let ticking = false;
  
  function handleScroll() {
    if (!ticking) {
      window.requestAnimationFrame(() => {
        if (!isScrolling) {
          isScrolling = true;
          summaryCard.classList.add('is-scrolling');
        }
        
        // Réinitialiser le timeout
        clearTimeout(scrollTimeout);
        scrollTimeout = setTimeout(() => {
          isScrolling = false;
          summaryCard.classList.remove('is-scrolling');
        }, 250);
        
        ticking = false;
      });
      
      ticking = true;
    }
  }
  
  // Écouter le scroll avec passive pour de meilleures performances
  window.addEventListener('scroll', handleScroll, { passive: true });
  
  // Nettoyer au déchargement de la page
  window.addEventListener('beforeunload', () => {
    observer.disconnect();
    window.removeEventListener('scroll', handleScroll);
    clearTimeout(scrollTimeout);
  });
})();
</script>
@endsection
