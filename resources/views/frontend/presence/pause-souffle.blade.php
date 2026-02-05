@extends('frontend.layout')

@section('pageHeading')
  Pause Souffle | {{ $websiteInfo->website_title }}
@endsection

@section('metaDescription')
  Pause Souffle, un temps de recul pour poser des choix éclairés avant l'action. Accompagnement de clarification et de discernement.
@endsection

@section('style')
<style>
  /* ============================================
     PAGE PAUSE SOUFFLE - DESIGN PREMIUM & RESPIRANT
     ============================================ */
  
  :root {
    --pause-souffle-primary: #84CC16;
    --pause-souffle-primary-dark: #FBBF24;
    --pause-souffle-primary-light: #2563EB;
    --pause-souffle-text: #1F2937;
    --pause-souffle-text-light: #6B7280;
    --pause-souffle-bg: #FFFFFF;
    --pause-souffle-bg-light: #F9FAFB;
    --pause-souffle-border: #E5E7EB;
    --pause-souffle-hover: #F3F4F6;
  }

  .pause-souffle-page {
    background: var(--pause-souffle-bg);
    color: var(--pause-souffle-text);
    font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
    line-height: 1.7;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
  }

  /* SECTION 1 — HERO VISUEL */
  .pause-souffle-hero {
    position: relative;
    min-height: 70vh;
    display: flex;
    align-items: center;
    justify-content: center;
    background: linear-gradient(135deg, rgba(251, 191, 36, 0.05) 0%, rgba(132, 204, 22, 0.05) 50%, rgba(37, 99, 235, 0.05) 100%);
    background-size: cover;
    background-position: center;
    background-attachment: fixed;
    padding: 80px 20px;
    text-align: center;
  }

  .pause-souffle-hero::before {
    content: '';
    position: absolute;
    inset: 0;
    background: rgba(255, 255, 255, 0.4);
    backdrop-filter: blur(1px);
  }

  .pause-souffle-hero-content {
    position: relative;
    z-index: 1;
    max-width: 800px;
    margin: 0 auto;
  }

  .pause-souffle-hero h1 {
    font-size: clamp(2.5rem, 5vw, 4rem);
    font-weight: 300;
    letter-spacing: -0.02em;
    color: var(--pause-souffle-text);
    margin-bottom: 1.5rem;
    line-height: 1.2;
  }

  .pause-souffle-hero .subtitle {
    font-size: clamp(1.125rem, 2vw, 1.5rem);
    font-weight: 400;
    color: var(--pause-souffle-text-light);
    line-height: 1.6;
    max-width: 600px;
    margin: 0 auto;
  }

  /* SECTION 2 — INTRODUCTION */
  .pause-souffle-intro {
    max-width: 700px;
    margin: 0 auto;
    padding: 80px 20px;
    text-align: center;
  }

  .pause-souffle-intro p {
    font-size: 1.125rem;
    line-height: 1.8;
    color: var(--pause-souffle-text-light);
    margin: 0;
  }

  /* SECTION 3 — À QUI S'ADRESSE */
  .pause-souffle-audience {
    background: var(--pause-souffle-bg-light);
    padding: 80px 20px;
  }

  .pause-souffle-container {
    max-width: 1200px;
    margin: 0 auto;
  }

  .pause-souffle-section-title {
    font-size: clamp(1.75rem, 3vw, 2.25rem);
    font-weight: 300;
    text-align: center;
    margin-bottom: 3rem;
    color: var(--pause-souffle-text);
    letter-spacing: -0.01em;
  }

  .pause-souffle-audience-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 2rem;
    max-width: 900px;
    margin: 0 auto;
  }

  .pause-souffle-audience-item {
    padding: 2rem 1.5rem;
    background: var(--pause-souffle-bg);
    border: 1px solid var(--pause-souffle-border);
    border-radius: 12px;
    text-align: center;
    transition: all 0.3s ease;
  }

  .pause-souffle-audience-item:hover {
    border-color: var(--pause-souffle-primary);
    box-shadow: 0 4px 12px rgba(132, 204, 22, 0.1);
    transform: translateY(-2px);
  }

  .pause-souffle-audience-item span {
    font-size: 1.125rem;
    font-weight: 400;
    color: var(--pause-souffle-text);
  }

  /* SECTION 4 — OBJECTIFS */
  .pause-souffle-objectives {
    padding: 80px 20px;
  }

  .pause-souffle-objectives-grid {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 1.5rem;
    max-width: 900px;
    margin: 0 auto;
  }

  .pause-souffle-objective {
    padding: 1rem 2rem;
    background: var(--pause-souffle-bg-light);
    border: 1px solid var(--pause-souffle-border);
    border-radius: 50px;
    font-size: 1rem;
    font-weight: 400;
    color: var(--pause-souffle-text);
    transition: all 0.3s ease;
  }

  .pause-souffle-objective:hover {
    background: var(--pause-souffle-primary);
    color: white;
    border-color: var(--pause-souffle-primary);
  }

  /* SECTION 5 — INTAKE PROGRESSIF */
  .pause-souffle-intake {
    background: var(--pause-souffle-bg-light);
    padding: 80px 20px;
  }

  .pause-souffle-intake-container {
    max-width: 700px;
    margin: 0 auto;
  }

  .pause-souffle-form {
    background: var(--pause-souffle-bg);
    border-radius: 16px;
    padding: 3rem;
    box-shadow: 0 4px 24px rgba(0, 0, 0, 0.04);
    min-height: 400px;
    position: relative;
  }

  .pause-souffle-step {
    display: none;
    animation: fadeIn 0.4s ease;
  }

  .pause-souffle-step.active {
    display: block !important;
  }

  @keyframes fadeIn {
    from { opacity: 0; transform: translateY(10px); }
    to { opacity: 1; transform: translateY(0); }
  }

  .pause-souffle-step-title {
    font-size: 1.5rem;
    font-weight: 400;
    margin-bottom: 2rem;
    color: var(--pause-souffle-text);
  }

  /* Sliders */
  .pause-souffle-slider-group {
    margin-bottom: 2.5rem;
  }

  .pause-souffle-slider-label {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 0.75rem;
    font-size: 1rem;
    color: var(--pause-souffle-text);
  }

  .pause-souffle-slider-value {
    font-weight: 500;
    color: var(--pause-souffle-primary);
    min-width: 30px;
    text-align: right;
  }

  .pause-souffle-slider {
    width: 100%;
    height: 6px;
    border-radius: 3px;
    background: var(--pause-souffle-border);
    outline: none;
    -webkit-appearance: none;
    appearance: none;
  }

  .pause-souffle-slider::-webkit-slider-thumb {
    -webkit-appearance: none;
    appearance: none;
    width: 20px;
    height: 20px;
    border-radius: 50%;
    background: var(--pause-souffle-primary);
    cursor: pointer;
    box-shadow: 0 2px 6px rgba(132, 204, 22, 0.3);
    transition: all 0.2s ease;
  }

  .pause-souffle-slider::-webkit-slider-thumb:hover {
    transform: scale(1.1);
    box-shadow: 0 4px 12px rgba(132, 204, 22, 0.4);
  }

  .pause-souffle-slider::-moz-range-thumb {
    width: 20px;
    height: 20px;
    border-radius: 50%;
    background: var(--pause-souffle-primary);
    cursor: pointer;
    border: none;
    box-shadow: 0 2px 6px rgba(132, 204, 22, 0.3);
    transition: all 0.2s ease;
  }

  .pause-souffle-slider::-moz-range-thumb:hover {
    transform: scale(1.1);
    box-shadow: 0 4px 12px rgba(132, 204, 22, 0.4);
  }

  /* Radio buttons */
  .pause-souffle-radio-group {
    display: flex;
    flex-direction: column;
    gap: 1rem;
    margin-bottom: 2rem;
  }

  .pause-souffle-radio-item {
    padding: 1.25rem 1.5rem;
    border: 1px solid var(--pause-souffle-border);
    border-radius: 12px;
    cursor: pointer;
    transition: all 0.3s ease;
    background: var(--pause-souffle-bg);
  }

  .pause-souffle-radio-item:hover {
    border-color: var(--pause-souffle-primary);
    background: var(--pause-souffle-bg-light);
  }

  .pause-souffle-radio-item input[type="radio"] {
    margin-right: 0.75rem;
    accent-color: var(--pause-souffle-primary);
  }

  .pause-souffle-radio-item input[type="radio"]:checked + label {
    color: var(--pause-souffle-primary);
    font-weight: 500;
  }

  .pause-souffle-radio-item label {
    cursor: pointer;
    font-size: 1rem;
    color: var(--pause-souffle-text);
    margin: 0;
  }

  /* Checkboxes */
  .pause-souffle-checkbox-group {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 1rem;
    margin-bottom: 2rem;
  }

  .pause-souffle-checkbox-item {
    padding: 1rem 1.25rem;
    border: 1px solid var(--pause-souffle-border);
    border-radius: 8px;
    cursor: pointer;
    transition: all 0.3s ease;
    background: var(--pause-souffle-bg);
    display: flex;
    align-items: center;
  }

  .pause-souffle-checkbox-item:hover {
    border-color: var(--pause-souffle-primary);
    background: var(--pause-souffle-bg-light);
  }

  .pause-souffle-checkbox-item input[type="checkbox"] {
    margin-right: 0.75rem;
    accent-color: var(--pause-souffle-primary);
  }

  .pause-souffle-checkbox-item input[type="checkbox"]:checked + label {
    color: var(--pause-souffle-primary);
    font-weight: 500;
  }

  .pause-souffle-checkbox-item label {
    cursor: pointer;
    font-size: 0.9375rem;
    color: var(--pause-souffle-text);
    margin: 0;
  }

  /* Textarea */
  .pause-souffle-textarea {
    width: 100%;
    min-height: 120px;
    padding: 1rem;
    border: 1px solid var(--pause-souffle-border);
    border-radius: 8px;
    font-size: 1rem;
    font-family: inherit;
    color: var(--pause-souffle-text);
    resize: vertical;
    transition: all 0.3s ease;
    background: var(--pause-souffle-bg);
  }

  .pause-souffle-textarea:focus {
    outline: none;
    border-color: var(--pause-souffle-primary);
    box-shadow: 0 0 0 3px rgba(132, 204, 22, 0.1);
  }

  .pause-souffle-textarea-hints {
    margin-top: 0.5rem;
    font-size: 0.875rem;
    color: var(--pause-souffle-text-light);
    font-style: italic;
  }

  /* Consentement */
  .pause-souffle-consent {
    padding: 1.5rem;
    background: var(--pause-souffle-bg-light);
    border: 1px solid var(--pause-souffle-border);
    border-radius: 12px;
    margin-bottom: 2rem;
  }

  .pause-souffle-consent p {
    font-size: 0.9375rem;
    line-height: 1.6;
    color: var(--pause-souffle-text-light);
    margin: 0 0 1rem 0;
  }

  .pause-souffle-consent-checkbox {
    display: flex;
    align-items: flex-start;
    gap: 0.75rem;
  }

  .pause-souffle-consent-checkbox input[type="checkbox"] {
    margin-top: 0.25rem;
    accent-color: var(--pause-souffle-primary);
  }

  .pause-souffle-consent-checkbox label {
    font-size: 0.9375rem;
    color: var(--pause-souffle-text);
    cursor: pointer;
    line-height: 1.5;
  }

  /* Navigation buttons */
  .pause-souffle-nav {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-top: 3rem;
    padding-top: 2rem;
    border-top: 1px solid var(--pause-souffle-border);
  }

  .pause-souffle-btn {
    padding: 0.875rem 2rem;
    border-radius: 50px;
    font-size: 1rem;
    font-weight: 500;
    cursor: pointer;
    transition: all 0.3s ease;
    border: none;
    font-family: inherit;
  }

  .pause-souffle-btn-secondary {
    background: transparent;
    color: var(--pause-souffle-text-light);
    border: 1px solid var(--pause-souffle-border);
  }

  .pause-souffle-btn-secondary:hover {
    background: var(--pause-souffle-bg-light);
    color: var(--pause-souffle-text);
    border-color: var(--pause-souffle-text);
  }

  .pause-souffle-btn-primary {
    background: linear-gradient(135deg, #FBBF24 0%, #84CC16 50%, #2563EB 100%);
    color: white;
    box-shadow: 0 4px 12px rgba(132, 204, 22, 0.3);
  }

  .pause-souffle-btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(132, 204, 22, 0.4);
  }

  .pause-souffle-btn-primary:disabled {
    opacity: 0.5;
    cursor: not-allowed;
    transform: none;
  }

  .pause-souffle-progress {
    text-align: center;
    margin-bottom: 2rem;
    font-size: 0.875rem;
    color: var(--pause-souffle-text-light);
  }

  /* SECTION 6 — CONCLUSION */
  .pause-souffle-conclusion {
    padding: 80px 20px;
    text-align: center;
  }

  .pause-souffle-conclusion-content {
    max-width: 600px;
    margin: 0 auto;
  }

  .pause-souffle-conclusion p {
    font-size: 1.125rem;
    line-height: 1.8;
    color: var(--pause-souffle-text-light);
    margin-bottom: 2.5rem;
  }

  .pause-souffle-cta {
    display: inline-block;
    padding: 1rem 2.5rem;
    background: linear-gradient(135deg, #FBBF24 0%, #84CC16 50%, #2563EB 100%);
    color: white;
    text-decoration: none;
    border-radius: 50px;
    font-size: 1.125rem;
    font-weight: 500;
    transition: all 0.3s ease;
    box-shadow: 0 4px 12px rgba(132, 204, 22, 0.3);
  }

  .pause-souffle-cta:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(132, 204, 22, 0.4);
  }

  /* Responsive */
  @media (max-width: 768px) {
    .pause-souffle-hero {
      min-height: 60vh;
      padding: 60px 20px;
    }

    .pause-souffle-form {
      padding: 2rem 1.5rem;
    }

    .pause-souffle-nav {
      flex-direction: column;
      gap: 1rem;
    }

    .pause-souffle-btn {
      width: 100%;
    }

    .pause-souffle-checkbox-group {
      grid-template-columns: 1fr;
    }
  }
</style>
@endsection

@section('content')
<div class="pause-souffle-page">
  <!-- SECTION 1 — HERO VISUEL -->
  <section class="pause-souffle-hero">
    <div class="pause-souffle-hero-content">
      <h1>Pause Souffle</h1>
      <p class="subtitle">Un temps de recul pour poser des choix éclairés avant l'action.</p>
    </div>
  </section>

  <!-- SECTION 2 — INTRODUCTION -->
  <section class="pause-souffle-intro">
    <p>
      Faire le point. Clarifier qui l'on est. Poser ses priorités. Avant toute mise en mouvement.
    </p>
  </section>

  <!-- SECTION 3 — À QUI S'ADRESSE -->
  <section class="pause-souffle-audience">
    <div class="pause-souffle-container">
      <h2 class="pause-souffle-section-title">À qui s'adresse cet accompagnement</h2>
      <div class="pause-souffle-audience-grid">
        <div class="pause-souffle-audience-item">
          <span>Dirigeant</span>
        </div>
        <div class="pause-souffle-audience-item">
          <span>Salarié</span>
        </div>
        <div class="pause-souffle-audience-item">
          <span>Parent</span>
        </div>
        <div class="pause-souffle-audience-item">
          <span>Freelance</span>
        </div>
        <div class="pause-souffle-audience-item">
          <span>Étudiant</span>
        </div>
        <div class="pause-souffle-audience-item">
          <span>Personne en transition</span>
        </div>
      </div>
    </div>
  </section>

  <!-- SECTION 4 — OBJECTIFS -->
  <section class="pause-souffle-objectives">
    <div class="pause-souffle-container">
      <h2 class="pause-souffle-section-title">Objectifs de l'accompagnement</h2>
      <div class="pause-souffle-objectives-grid">
        <div class="pause-souffle-objective">Clarté</div>
        <div class="pause-souffle-objective">Priorités</div>
        <div class="pause-souffle-objective">Décision</div>
        <div class="pause-souffle-objective">Énergie</div>
        <div class="pause-souffle-objective">Confiance</div>
        <div class="pause-souffle-objective">Équilibre</div>
      </div>
    </div>
  </section>

  <!-- SECTION 5 — INTAKE PROGRESSIF -->
  <section class="pause-souffle-intake" id="intake">
    <div class="pause-souffle-container">
      <h2 class="pause-souffle-section-title">Un premier échange</h2>
      
      @if(session('success'))
        <div style="max-width: 700px; margin: 0 auto 2rem; padding: 1.5rem; background: #D1FAE5; border: 1px solid #84CC16; border-radius: 12px; color: #065F46;">
          {{ session('success') }}
        </div>
      @endif

      @if($errors->any())
        <div style="max-width: 700px; margin: 0 auto 2rem; padding: 1.5rem; background: #FEE2E2; border: 1px solid #EF4444; border-radius: 12px; color: #991B1B;">
          <strong>Veuillez corriger les erreurs suivantes :</strong>
          <ul style="margin: 0.5rem 0 0 1.5rem; padding: 0;">
            @foreach($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      <div class="pause-souffle-intake-container">
        <form id="pauseSouffleForm" class="pause-souffle-form" method="POST" action="{{ route('presence.pause-souffle.submit') }}">
          @csrf

          <!-- ÉTAPE 1 — Où en êtes-vous aujourd'hui ? -->
          <div class="pause-souffle-step active" data-step="1">
            <h3 class="pause-souffle-step-title">Où en êtes-vous aujourd'hui ?</h3>
            <div class="pause-souffle-progress">Étape 1 sur 7</div>

            <div class="pause-souffle-slider-group">
              <div class="pause-souffle-slider-label">
                <span>Énergie</span>
                <span class="pause-souffle-slider-value" id="energyValue">5</span>
              </div>
              <input type="range" name="energy" id="energySlider" class="pause-souffle-slider" min="0" max="10" value="5" required>
            </div>

            <div class="pause-souffle-slider-group">
              <div class="pause-souffle-slider-label">
                <span>Clarté</span>
                <span class="pause-souffle-slider-value" id="clarityValue">5</span>
              </div>
              <input type="range" name="clarity" id="claritySlider" class="pause-souffle-slider" min="0" max="10" value="5" required>
            </div>

            <div class="pause-souffle-slider-group">
              <div class="pause-souffle-slider-label">
                <span>Niveau de tension / stress</span>
                <span class="pause-souffle-slider-value" id="tensionValue">5</span>
              </div>
              <input type="range" name="tension" id="tensionSlider" class="pause-souffle-slider" min="0" max="10" value="5" required>
            </div>

            <div class="pause-souffle-nav">
              <div></div>
              <button type="button" class="pause-souffle-btn pause-souffle-btn-primary" onclick="nextStep()">Continuer</button>
            </div>
          </div>

          <!-- ÉTAPE 2 — Situation actuelle -->
          <div class="pause-souffle-step" data-step="2">
            <h3 class="pause-souffle-step-title">Situation actuelle</h3>
            <div class="pause-souffle-progress">Étape 2 sur 7</div>

            <div class="pause-souffle-radio-group">
              <div class="pause-souffle-radio-item">
                <input type="radio" name="situation" id="situation-dirigeant" value="dirigeant" required>
                <label for="situation-dirigeant">Dirigeant</label>
              </div>
              <div class="pause-souffle-radio-item">
                <input type="radio" name="situation" id="situation-salarie" value="salarie" required>
                <label for="situation-salarie">Salarié</label>
              </div>
              <div class="pause-souffle-radio-item">
                <input type="radio" name="situation" id="situation-parent" value="parent" required>
                <label for="situation-parent">Parent</label>
              </div>
              <div class="pause-souffle-radio-item">
                <input type="radio" name="situation" id="situation-freelance" value="freelance" required>
                <label for="situation-freelance">Freelance</label>
              </div>
              <div class="pause-souffle-radio-item">
                <input type="radio" name="situation" id="situation-etudiant" value="etudiant" required>
                <label for="situation-etudiant">Étudiant</label>
              </div>
              <div class="pause-souffle-radio-item">
                <input type="radio" name="situation" id="situation-transition" value="transition" required>
                <label for="situation-transition">Transition de vie</label>
              </div>
            </div>

            <div class="pause-souffle-nav">
              <button type="button" class="pause-souffle-btn pause-souffle-btn-secondary" onclick="prevStep()">Précédent</button>
              <button type="button" class="pause-souffle-btn pause-souffle-btn-primary" onclick="nextStep()">Continuer</button>
            </div>
          </div>

          <!-- ÉTAPE 3 — Rythme souhaité -->
          <div class="pause-souffle-step" data-step="3">
            <h3 class="pause-souffle-step-title">Rythme souhaité</h3>
            <div class="pause-souffle-progress">Étape 3 sur 7</div>

            <div class="pause-souffle-radio-group">
              <div class="pause-souffle-radio-item">
                <input type="radio" name="rythme" id="rythme-1-session" value="1-session" required>
                <label for="rythme-1-session">1 session</label>
              </div>
              <div class="pause-souffle-radio-item">
                <input type="radio" name="rythme" id="rythme-4-semaines" value="4-semaines" required>
                <label for="rythme-4-semaines">4 semaines</label>
              </div>
              <div class="pause-souffle-radio-item">
                <input type="radio" name="rythme" id="rythme-3-mois" value="3-mois" required>
                <label for="rythme-3-mois">3 mois</label>
              </div>
            </div>

            <div class="pause-souffle-nav">
              <button type="button" class="pause-souffle-btn pause-souffle-btn-secondary" onclick="prevStep()">Précédent</button>
              <button type="button" class="pause-souffle-btn pause-souffle-btn-primary" onclick="nextStep()">Continuer</button>
            </div>
          </div>

          <!-- ÉTAPE 4 — Ce que vous souhaitez protéger -->
          <div class="pause-souffle-step" data-step="4">
            <h3 class="pause-souffle-step-title">Ce que vous souhaitez protéger</h3>
            <div class="pause-souffle-progress">Étape 4 sur 7</div>

            <div class="pause-souffle-checkbox-group">
              <div class="pause-souffle-checkbox-item">
                <input type="checkbox" name="protect[]" id="protect-temps" value="temps">
                <label for="protect-temps">Temps</label>
              </div>
              <div class="pause-souffle-checkbox-item">
                <input type="checkbox" name="protect[]" id="protect-famille" value="famille">
                <label for="protect-famille">Famille</label>
              </div>
              <div class="pause-souffle-checkbox-item">
                <input type="checkbox" name="protect[]" id="protect-projet" value="projet">
                <label for="protect-projet">Projet</label>
              </div>
              <div class="pause-souffle-checkbox-item">
                <input type="checkbox" name="protect[]" id="protect-sante" value="sante">
                <label for="protect-sante">Santé</label>
              </div>
              <div class="pause-souffle-checkbox-item">
                <input type="checkbox" name="protect[]" id="protect-foi" value="foi">
                <label for="protect-foi">Foi</label>
              </div>
              <div class="pause-souffle-checkbox-item">
                <input type="checkbox" name="protect[]" id="protect-equilibre" value="equilibre">
                <label for="protect-equilibre">Équilibre personnel</label>
              </div>
            </div>

            <div class="pause-souffle-nav">
              <button type="button" class="pause-souffle-btn pause-souffle-btn-secondary" onclick="prevStep()">Précédent</button>
              <button type="button" class="pause-souffle-btn pause-souffle-btn-primary" onclick="nextStep()">Continuer</button>
            </div>
          </div>

          <!-- ÉTAPE 5 — Ce que vous souhaitez construire -->
          <div class="pause-souffle-step" data-step="5">
            <h3 class="pause-souffle-step-title">Ce que vous souhaitez construire</h3>
            <div class="pause-souffle-progress">Étape 5 sur 7</div>

            <textarea name="construire" id="construire" class="pause-souffle-textarea" placeholder="Partagez librement votre vision..."></textarea>
            <div class="pause-souffle-textarea-hints">
              Repères optionnels : Vision à 2 ans • Vision à 5 ans • Vision à 10 ans
            </div>

            <div class="pause-souffle-nav">
              <button type="button" class="pause-souffle-btn pause-souffle-btn-secondary" onclick="prevStep()">Précédent</button>
              <button type="button" class="pause-souffle-btn pause-souffle-btn-primary" onclick="nextStep()">Continuer</button>
            </div>
          </div>

          <!-- ÉTAPE 6 — Préférences d'accompagnement (OPTIONNEL) -->
          <div class="pause-souffle-step" data-step="6">
            <h3 class="pause-souffle-step-title">Préférences d'accompagnement</h3>
            <div class="pause-souffle-progress">Étape 6 sur 7 (optionnel)</div>

            <div class="pause-souffle-checkbox-group">
              <div class="pause-souffle-checkbox-item">
                <input type="checkbox" name="preferences[]" id="pref-doux" value="douce">
                <label for="pref-doux">Accompagnement doux</label>
              </div>
              <div class="pause-souffle-checkbox-item">
                <input type="checkbox" name="preferences[]" id="pref-structure" value="structuree">
                <label for="pref-structure">Accompagnement structuré</label>
              </div>
              <div class="pause-souffle-checkbox-item">
                <input type="checkbox" name="preferences[]" id="pref-spirituel" value="spirituel">
                <label for="pref-spirituel">Dimension spirituelle (optionnelle)</label>
              </div>
            </div>

            <div class="pause-souffle-nav">
              <button type="button" class="pause-souffle-btn pause-souffle-btn-secondary" onclick="prevStep()">Précédent</button>
              <button type="button" class="pause-souffle-btn pause-souffle-btn-primary" onclick="nextStep()">Continuer</button>
            </div>
          </div>

          <!-- ÉTAPE 7 — Cadre & consentement (OBLIGATOIRE) -->
          <div class="pause-souffle-step" data-step="7">
            <h3 class="pause-souffle-step-title">Cadre & consentement</h3>
            <div class="pause-souffle-progress">Étape 7 sur 7</div>

            <div class="pause-souffle-consent">
              <p>
                Pause Souffle est un accompagnement de clarté et de discernement.<br>
                Junspro ne propose pas de service médical ou thérapeutique.
              </p>
              <div class="pause-souffle-consent-checkbox">
                <input type="checkbox" name="consentement" id="consentement" value="1" required>
                <label for="consentement">J'ai lu et j'accepte ces conditions.</label>
              </div>
            </div>

            <div class="pause-souffle-nav">
              <button type="button" class="pause-souffle-btn pause-souffle-btn-secondary" onclick="prevStep()">Précédent</button>
              <button type="submit" class="pause-souffle-btn pause-souffle-btn-primary" id="submitBtn" disabled>Réserver un Rituel d'essai</button>
            </div>
            <p style="text-align: center; margin-top: 1rem; font-size: 0.875rem; color: #6B7280; line-height: 1.6;">
              Clarifier ce qui compte vraiment • Poser des priorités réalistes • Choisir une direction cohérente
            </p>
          </div>
        </form>
      </div>
    </div>
  </section>

  <!-- SECTION 6 — CONCLUSION & CTA -->
  <section class="pause-souffle-conclusion">
    <div class="pause-souffle-conclusion-content">
      <p>
        Vous n'avez rien à prouver ici.<br>
        Simplement un espace pour faire le point, à votre rythme.
      </p>
      <a href="#pauseSouffleForm" class="pause-souffle-cta" onclick="document.getElementById('pauseSouffleForm').scrollIntoView({ behavior: 'smooth' }); return false;">
        Demander un premier échange
      </a>
    </div>
  </section>
</div>

<script>
  let currentStep = 1;
  const totalSteps = 7;

  // Initialiser le formulaire
  document.addEventListener('DOMContentLoaded', function() {
    // S'assurer que toutes les étapes sauf la première sont cachées
    document.querySelectorAll('.pause-souffle-step').forEach(function(stepEl) {
      stepEl.classList.remove('active');
    });
    
    // Afficher la première étape
    const firstStep = document.querySelector('.pause-souffle-step[data-step="1"]');
    if (firstStep) {
      firstStep.classList.add('active');
    }
    
    currentStep = 1;

    // Initialiser les sliders
    const sliders = ['energy', 'clarity', 'tension'];
    sliders.forEach(function(sliderId) {
      const slider = document.getElementById(sliderId + 'Slider');
      const valueDisplay = document.getElementById(sliderId + 'Value');
      if (slider && valueDisplay) {
        // Mettre à jour la valeur initiale
        valueDisplay.textContent = slider.value;
        
        slider.addEventListener('input', function() {
          valueDisplay.textContent = this.value;
        });
      }
    });

    // Vérifier le consentement pour activer le bouton submit
    const consentCheckbox = document.getElementById('consentement');
    const submitBtn = document.getElementById('submitBtn');
    if (consentCheckbox && submitBtn) {
      // Désactiver le bouton au départ
      submitBtn.disabled = true;
      
      consentCheckbox.addEventListener('change', function() {
        submitBtn.disabled = !this.checked;
      });
    }

    // Gérer la soumission du formulaire
    const form = document.getElementById('pauseSouffleForm');
    if (form) {
      form.addEventListener('submit', function(e) {
        // Validation finale avant soumission
        const consentCheckbox = document.getElementById('consentement');
        if (!consentCheckbox || !consentCheckbox.checked) {
          e.preventDefault();
          alert('Vous devez accepter les conditions pour continuer.');
          return false;
        }
        
        // La validation côté serveur sera gérée par Laravel
      });
    }
  });

  function showStep(step) {
    // Masquer toutes les étapes
    document.querySelectorAll('.pause-souffle-step').forEach(function(stepEl) {
      stepEl.classList.remove('active');
    });

    // Afficher l'étape courante
    const stepElement = document.querySelector(`.pause-souffle-step[data-step="${step}"]`);
    if (stepElement) {
      stepElement.classList.add('active');
      // Scroll vers le haut du formulaire avec un petit délai pour l'animation
      setTimeout(function() {
        const formContainer = document.querySelector('.pause-souffle-intake-container');
        if (formContainer) {
          formContainer.scrollIntoView({ behavior: 'smooth', block: 'start' });
        }
      }, 100);
    }
  }

  function nextStep() {
    // Valider l'étape courante
    const currentStepEl = document.querySelector(`.pause-souffle-step[data-step="${currentStep}"]`);
    if (currentStepEl) {
      let isValid = true;
      let errorMessage = '';

      // Étape 1 : Sliders (toujours valides car ils ont des valeurs par défaut)
      if (currentStep === 1) {
        // Les sliders ont des valeurs par défaut, donc toujours valides
        isValid = true;
      }
      // Étape 2 : Situation (un radio doit être sélectionné)
      else if (currentStep === 2) {
        const situationRadios = currentStepEl.querySelectorAll('input[name="situation"]');
        const isSituationSelected = Array.from(situationRadios).some(function(radio) {
          return radio.checked;
        });
        if (!isSituationSelected) {
          isValid = false;
          errorMessage = 'Veuillez sélectionner une situation.';
        }
      }
      // Étape 3 : Rythme (un radio doit être sélectionné)
      else if (currentStep === 3) {
        const rythmeRadios = currentStepEl.querySelectorAll('input[name="rythme"]');
        const isRythmeSelected = Array.from(rythmeRadios).some(function(radio) {
          return radio.checked;
        });
        if (!isRythmeSelected) {
          isValid = false;
          errorMessage = 'Veuillez sélectionner un rythme.';
        }
      }
      // Étape 4 : Protect (au moins une checkbox doit être cochée)
      else if (currentStep === 4) {
        const protectCheckboxes = currentStepEl.querySelectorAll('input[name="protect[]"]');
        const isProtectChecked = Array.from(protectCheckboxes).some(function(cb) {
          return cb.checked;
        });
        if (!isProtectChecked) {
          isValid = false;
          errorMessage = 'Veuillez sélectionner au moins un élément à protéger.';
        }
      }
      // Étape 5 : Textarea (optionnel, donc toujours valide)
      else if (currentStep === 5) {
        isValid = true; // Optionnel
      }
      // Étape 6 : Préférences (optionnel, donc toujours valide)
      else if (currentStep === 6) {
        isValid = true; // Optionnel
      }
      // Étape 7 : Consentement (obligatoire)
      else if (currentStep === 7) {
        const consentCheckbox = currentStepEl.querySelector('input[name="consentement"]');
        if (!consentCheckbox || !consentCheckbox.checked) {
          isValid = false;
          errorMessage = 'Vous devez accepter les conditions pour continuer.';
        }
      }
      // Validation générique pour les champs required
      else {
        const requiredFields = currentStepEl.querySelectorAll('[required]');
        requiredFields.forEach(function(field) {
          if (field.type === 'radio') {
            const radioGroup = currentStepEl.querySelectorAll(`input[name="${field.name}"]`);
            const isChecked = Array.from(radioGroup).some(function(radio) {
              return radio.checked;
            });
            if (!isChecked) {
              isValid = false;
              errorMessage = 'Veuillez remplir tous les champs obligatoires avant de continuer.';
            }
          } else if (field.type === 'checkbox') {
            if (!field.checked) {
              isValid = false;
              errorMessage = 'Veuillez remplir tous les champs obligatoires avant de continuer.';
            }
          } else if (!field.value || field.value.trim() === '') {
            isValid = false;
            errorMessage = 'Veuillez remplir tous les champs obligatoires avant de continuer.';
          }
        });
      }

      if (!isValid) {
        alert(errorMessage || 'Veuillez remplir tous les champs obligatoires avant de continuer.');
        return;
      }
    }

    if (currentStep < totalSteps) {
      currentStep++;
      showStep(currentStep);
    }
  }

  function prevStep() {
    if (currentStep > 1) {
      currentStep--;
      showStep(currentStep);
    }
  }
</script>
@endsection
