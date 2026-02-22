@extends('frontend.layout')

@section('style')
  <link rel="stylesheet" href="{{ asset('assets/css/summernote-content.css') }}">
  <style>
    :root {
      --junspro-purple: #7C3AED;
      --junspro-blue: #1e40af;
      --junspro-gradient: linear-gradient(135deg, #1e40af 0%, #4c1d95 50%, #7c3aed 100%);
    }

    /* Page onboarding freelance */
    .onboarding-page {
      min-height: 100vh;
      background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
      padding: 2rem 0 4rem;
    }

    .onboarding-container {
      max-width: 1100px;
      margin: 0 auto;
      padding: 0 1.5rem;
    }

    /* Barre de progression */
    .onboarding-progress {
      background: white;
      border-radius: 16px;
      padding: 2rem;
      margin-bottom: 2rem;
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
    }

    .progress-steps {
      display: flex;
      align-items: center;
      justify-content: space-between;
      gap: 0.5rem;
      flex-wrap: wrap;
    }

    .progress-step {
      display: flex;
      align-items: center;
      gap: 0.5rem;
      flex: 1;
      min-width: 0;
    }

    .progress-step-number {
      width: 36px;
      height: 36px;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      font-weight: 600;
      font-size: 0.875rem;
      flex-shrink: 0;
      transition: all 0.3s ease;
    }

    .progress-step.completed .progress-step-number {
      background: var(--junspro-gradient);
      color: white;
    }

    .progress-step.active .progress-step-number {
      background: var(--junspro-gradient);
      color: white;
      box-shadow: 0 0 0 4px rgba(124, 58, 237, 0.1);
    }

    .progress-step.pending .progress-step-number {
      background: #e5e7eb;
      color: #6b7280;
    }

    .progress-step-label {
      font-size: 0.875rem;
      font-weight: 500;
      color: #374151;
      white-space: nowrap;
      overflow: hidden;
      text-overflow: ellipsis;
    }

    .progress-step.completed .progress-step-label,
    .progress-step.active .progress-step-label {
      color: var(--junspro-purple);
      font-weight: 600;
    }

    .progress-chevron {
      color: #d1d5db;
      font-size: 1.25rem;
      flex-shrink: 0;
      margin: 0 0.5rem;
    }

    /* Contenu principal - Design fluide sans blocs */
    .onboarding-content {
      background: white;
      border-radius: 24px;
      padding: 3rem;
      box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
    }

    .onboarding-title {
      font-size: 2.25rem;
      font-weight: 800;
      color: #1a202c;
      margin-bottom: 1.5rem;
      letter-spacing: -0.02em;
      background: linear-gradient(135deg, #1a202c 0%, #4c1d95 100%);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      background-clip: text;
    }

    /* Sections fluides sans blocs */
    .section {
      margin-bottom: 3rem;
      padding-bottom: 2rem;
      border-bottom: 1px solid #f3f4f6;
    }

    .section:last-of-type {
      border-bottom: none;
      margin-bottom: 0;
    }

    .section-title {
      font-size: 1.1rem;
      font-weight: 700;
      color: #1a202c;
      margin-bottom: 0.75rem;
    }

    .section-description {
      font-size: 0.95rem;
      color: #6b7280;
      line-height: 1.6;
      margin-bottom: 1.5rem;
    }

    /* Critères avancés - filtre disponibilités (matching) */
    .advanced-matching-filters {
      border: 1px solid #e5e7eb;
      border-radius: 12px;
      background: #fff;
      padding: 0.75rem;
    }
    .advanced-matching-filters .preply-filter-label {
      display: block;
      font-size: 0.9rem;
      color: #111827;
      font-weight: 700;
      margin-bottom: 0.35rem;
    }
    .advanced-matching-filters .preply-availability-trigger {
      width: 100%;
      border: 1px solid #d1d5db;
      border-radius: 10px;
      background: #fff;
      padding: 0.6rem 0.7rem;
      font-size: 0.95rem;
      color: #111827;
      cursor: pointer;
      display: flex;
      align-items: center;
      justify-content: space-between;
      gap: 0.5rem;
    }
    .advanced-matching-filters .preply-availability-panel {
      margin-top: 0.45rem;
      border: 1px solid #e5e7eb;
      border-radius: 10px;
      background: #fff;
      padding: 0.6rem;
      display: none;
    }
    .advanced-matching-filters .preply-availability-panel.active { display: block; }
    .advanced-matching-filters .availability-section-title {
      font-size: 0.95rem;
      font-weight: 800;
      color: #111827;
      margin: 0 0 0.45rem 0;
    }
    .advanced-matching-filters .availability-time-slots,
    .advanced-matching-filters .availability-days {
      display: flex;
      flex-wrap: wrap;
      gap: 0.35rem;
      margin-bottom: 0.45rem;
    }
    .advanced-matching-filters .availability-time-btn,
    .advanced-matching-filters .availability-day-btn {
      border: 1px solid #d1d5db;
      background: #fff;
      border-radius: 999px;
      padding: 0.32rem 0.5rem;
      font-size: 0.82rem;
      cursor: pointer;
      color: #111827;
    }
    .advanced-matching-filters .availability-time-btn.active,
    .advanced-matching-filters .availability-day-btn.active {
      border-color: #4f46e5;
      background: #eef2ff;
      color: #3730a3;
      font-weight: 700;
    }
    .advanced-matching-filters .availability-actions {
      display: flex;
      justify-content: flex-end;
      gap: 0.45rem;
      margin-top: 0.45rem;
    }
    .advanced-matching-filters .availability-clear-btn,
    .advanced-matching-filters .availability-apply-btn {
      border: 1px solid #d1d5db;
      border-radius: 8px;
      background: #fff;
      padding: 0.45rem 0.7rem;
      font-size: 0.85rem;
      font-weight: 700;
    }
    .advanced-matching-filters .availability-apply-btn {
      border-color: #4f46e5;
      background: #4f46e5;
      color: #fff;
      box-shadow: 0 4px 14px rgba(79, 70, 229, 0.18);
    }

    /* Question fuseau horaire */
    .timezone-question {
      font-size: 1rem;
      color: #1a202c;
      margin-bottom: 1rem;
    }

    .timezone-display {
      font-size: 1rem;
      color: #4b5563;
      padding: 0.75rem 0;
      margin-bottom: 1.5rem;
      border-bottom: 1px solid #e5e7eb;
    }

    .timezone-buttons {
      display: flex;
      gap: 1rem;
      margin-bottom: 2rem;
    }

    .btn-timezone {
      flex: 1;
      padding: 0.875rem 1.5rem;
      border: 1px solid #d1d5db;
      border-radius: 8px;
      background: white;
      color: #1a202c;
      font-size: 0.95rem;
      font-weight: 600;
      cursor: pointer;
      transition: all 0.2s ease;
    }

    .btn-timezone:hover {
      border-color: var(--junspro-purple);
      color: var(--junspro-purple);
    }

    .btn-timezone.selected {
      border-color: var(--junspro-purple);
      background: var(--junspro-purple);
      color: white;
    }

    /* Fuseau horaire - Design épuré */
    .timezone-select {
      width: 100%;
      padding: 0.875rem 0;
      border: none;
      border-bottom: 2px solid #e5e7eb;
      font-size: 1rem;
      color: #1a202c;
      transition: all 0.3s ease;
      background: transparent;
      cursor: pointer;
      appearance: none;
      background-image: url("data:image/svg+xml,%3Csvg width='12' height='8' viewBox='0 0 12 8' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1 1L6 6L11 1' stroke='%237C3AED' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'/%3E%3C/svg%3E");
      background-repeat: no-repeat;
      background-position: right center;
      padding-right: 2rem;
    }

    .timezone-select:focus {
      outline: none;
      border-bottom-color: var(--junspro-purple);
    }

    .timezone-select:hover {
      border-bottom-color: #d1d5db;
    }

    /* Disponibilités - Design fluide */
    .days-list {
      display: flex;
      flex-direction: column;
      gap: 0;
    }

    .day-row {
      display: flex;
      align-items: flex-start;
      gap: 1rem;
      padding: 1.25rem 0;
      border-bottom: 1px solid #f3f4f6;
      transition: all 0.2s ease;
    }

    .day-row:last-child {
      border-bottom: none;
    }

    .day-row:hover {
      padding-left: 0.5rem;
    }

    .day-checkbox {
      width: 20px;
      height: 20px;
      cursor: pointer;
      accent-color: var(--junspro-purple);
      flex-shrink: 0;
      margin-top: 0.125rem;
    }

    .day-label {
      font-size: 1rem;
      font-weight: 600;
      color: #1a202c;
      cursor: pointer;
      flex: 0 0 100px;
    }

    .day-slots {
      flex: 1;
      display: flex;
      flex-direction: column;
      gap: 0.75rem;
    }

    .time-slot-row {
      display: flex;
      align-items: center;
      gap: 0.75rem;
      padding: 0.5rem 0;
    }

    .time-label {
      font-size: 0.875rem;
      font-weight: 500;
      color: #6b7280;
      min-width: 30px;
    }

    .time-input {
      padding: 0.5rem 0.75rem;
      border: none;
      border-bottom: 1px solid #e5e7eb;
      font-size: 0.95rem;
      color: #1a202c;
      background: transparent;
      cursor: pointer;
      transition: all 0.2s ease;
      min-width: 100px;
    }

    .time-input:focus {
      outline: none;
      border-bottom-color: var(--junspro-purple);
    }

    .time-input:hover {
      border-bottom-color: #d1d5db;
    }

    .add-slot-link {
      margin-top: 0.5rem;
      padding: 0;
      background: transparent;
      color: var(--junspro-purple);
      border: none;
      font-size: 0.9rem;
      font-weight: 500;
      cursor: pointer;
      transition: all 0.2s ease;
      text-decoration: none;
      display: inline-block;
    }

    .add-slot-link:hover {
      color: #6d28d9;
      text-decoration: underline;
    }

    .remove-slot-link {
      padding: 0;
      background: transparent;
      color: #9ca3af;
      border: none;
      font-size: 0.875rem;
      font-weight: 500;
      cursor: pointer;
      transition: all 0.2s ease;
      text-decoration: none;
      margin-left: auto;
    }

    .remove-slot-link:hover {
      color: #dc2626;
      text-decoration: underline;
    }

    /* Actions */
    .onboarding-actions {
      display: flex;
      justify-content: space-between;
      align-items: center;
      gap: 1rem;
      margin-top: 3rem;
      padding-top: 2rem;
      border-top: 1px solid #f3f4f6;
    }

    .btn-back {
      padding: 0.875rem 2rem;
      background: transparent;
      border: 1px solid #d1d5db;
      border-radius: 8px;
      color: #6b7280;
      font-weight: 600;
      text-decoration: none;
      cursor: pointer;
      transition: all 0.2s ease;
      display: inline-flex;
      align-items: center;
    }

    .btn-back:hover {
      border-color: #9ca3af;
      color: #1a202c;
    }

    .btn-continue {
      padding: 0.875rem 2rem;
      background: var(--junspro-gradient);
      border: none;
      border-radius: 8px;
      color: white;
      font-weight: 600;
      cursor: pointer;
      transition: all 0.3s ease;
      box-shadow: 0 4px 15px rgba(124, 58, 237, 0.3);
    }

    .btn-continue:hover {
      transform: translateY(-2px);
      box-shadow: 0 6px 20px rgba(124, 58, 237, 0.4);
    }

    .form-error {
      display: block;
      color: #ef4444;
      font-size: 0.875rem;
      margin-top: 0.5rem;
    }

    /* Masquer les slots si le jour n'est pas activé */
    .day-slots[style*="display: none"] {
      display: none !important;
    }

    /* Responsive */
    @media (max-width: 768px) {
      .onboarding-content {
        padding: 2rem 1.5rem;
      }

      .progress-steps {
        flex-direction: column;
        align-items: flex-start;
      }

      .progress-chevron {
        display: none;
      }

      .onboarding-actions {
        flex-direction: column-reverse;
      }

      .btn-back,
      .btn-continue {
        width: 100%;
        justify-content: center;
      }

      .day-row {
        flex-wrap: wrap;
      }

      .day-label {
        flex: 1 1 100%;
      }

      .day-slots {
        flex: 1 1 100%;
        margin-left: 0;
      }

      .timezone-buttons {
        flex-direction: column;
      }
    }
  </style>
@endsection

@section('content')
  <div class="onboarding-page">
    <div class="onboarding-container">
      @include('frontend.freelance.onboarding.partials.premium-stepper', ['routeStep' => 7])
      <!-- Barre de progression -->
      <div class="onboarding-progress" style="display:none;">
        <div class="progress-steps">
          <div class="progress-step completed">
            <div class="progress-step-number">✓</div>
            <span class="progress-step-label">À propos</span>
          </div>
          <span class="progress-chevron">›</span>
          <div class="progress-step completed">
            <div class="progress-step-number">✓</div>
            <span class="progress-step-label">Photo</span>
          </div>
          <span class="progress-chevron">›</span>
          <div class="progress-step completed">
            <div class="progress-step-number">✓</div>
            <span class="progress-step-label">Certifications</span>
          </div>
          <span class="progress-chevron">›</span>
          <div class="progress-step completed">
            <div class="progress-step-number">✓</div>
            <span class="progress-step-label">Formation</span>
          </div>
          <span class="progress-chevron">›</span>
          <div class="progress-step completed">
            <div class="progress-step-number">✓</div>
            <span class="progress-step-label">Description</span>
          </div>
          <span class="progress-chevron">›</span>
          <div class="progress-step completed">
            <div class="progress-step-number">✓</div>
            <span class="progress-step-label">Vidéo</span>
          </div>
          <span class="progress-chevron">›</span>
          <div class="progress-step active">
            <div class="progress-step-number">7</div>
            <span class="progress-step-label">Disponibilité &amp; conditions</span>
          </div>
          <span class="progress-chevron">›</span>
          <div class="progress-step pending">
            <div class="progress-step-number">8</div>
            <span class="progress-step-label">Tarif</span>
          </div>
        </div>
      </div>

      <!-- Contenu principal - Directement sur le fond -->
      <div class="onboarding-content">
        <h1 class="onboarding-title">Disponibilité &amp; conditions</h1>

        @if(session('success'))
          <div style="padding: 1rem; background: #f0fdf4; border-left: 4px solid #10b981; border-radius: 4px; color: #166534; margin-bottom: 2rem;">
            ✓ {{ session('success') }}
          </div>
        @endif

        @if($errors->any())
          <div style="padding: 1rem; background: #fef2f2; border-left: 4px solid #ef4444; border-radius: 4px; color: #991b1b; margin-bottom: 2rem;">
            <ul style="margin: 0; padding-left: 1.25rem;">
              @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
        @endif

        <form action="{{ route('freelance.onboarding.step7.store') }}" method="POST" id="availabilityForm">
          @csrf

          <!-- Critères avancés (optionnel) : filtre matching disponibilités -->
          <div class="section">
            <div class="section-title">Critères avancés (optionnel)</div>
            <p class="section-description">Affinez votre matching côté client grâce à vos plages disponibles.</p>
            <div class="advanced-matching-filters">
              <div class="preply-filter-group preply-availability-group">
                <label class="preply-filter-label preply-filter-label-icon"><i class="fas fa-calendar-alt me-2"></i>Mes disponibilités</label>
                <button type="button" class="preply-availability-trigger" id="matchingAvailabilityTrigger">
                  <span class="availability-selected-text" id="matchingAvailabilityLabel">Toutes les heures</span>
                  <i class="fas fa-chevron-down"></i>
                </button>
                <div class="preply-availability-panel" id="matchingAvailabilityPanel">
                  <div class="availability-section" style="width:100%;">
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
                  <div class="availability-section" style="width:100%;">
                    <h4 class="availability-section-title">Heures</h4>
                    <div class="availability-time-group">
                      <div class="availability-time-label">Journée</div>
                      <div class="availability-time-slots">
                        <button type="button" class="availability-time-btn" data-time="9-12"><i class="fas fa-sun"></i><span>9-12</span></button>
                        <button type="button" class="availability-time-btn" data-time="12-15"><i class="fas fa-sun"></i><span>12-15</span></button>
                        <button type="button" class="availability-time-btn" data-time="15-18"><i class="fas fa-sun"></i><span>15-18</span></button>
                      </div>
                    </div>
                    <div class="availability-time-group">
                      <div class="availability-time-label">Soir et nuit</div>
                      <div class="availability-time-slots">
                        <button type="button" class="availability-time-btn" data-time="18-21"><i class="fas fa-sun"></i><span>18-21</span></button>
                        <button type="button" class="availability-time-btn" data-time="21-24"><i class="fas fa-moon"></i><span>21-24</span></button>
                        <button type="button" class="availability-time-btn" data-time="0-3"><i class="fas fa-moon"></i><span>0-3</span></button>
                      </div>
                    </div>
                    <div class="availability-time-group">
                      <div class="availability-time-label">Tôt le matin</div>
                      <div class="availability-time-slots">
                        <button type="button" class="availability-time-btn" data-time="3-6"><i class="fas fa-moon"></i><span>3-6</span></button>
                        <button type="button" class="availability-time-btn" data-time="6-9"><i class="fas fa-sun"></i><span>6-9</span></button>
                      </div>
                    </div>
                  </div>
                  <div class="availability-actions">
                    <button type="button" class="availability-clear-btn" id="matchingAvailabilityClear">Effacer</button>
                    <button type="button" class="availability-apply-btn" id="matchingAvailabilityApply">Appliquer</button>
                  </div>
                </div>
                <input type="hidden" name="matching_availability" id="matchingAvailabilityInput" value="{{ old('matching_availability', $data['matching_availability'] ?? '') }}">
              </div>
            </div>
          </div>

          <!-- Section confirmation fuseau horaire -->
          <div class="section">
            <p class="timezone-question">S'agit-il de votre fuseau horaire actuel ?</p>
            <div class="timezone-display" id="detectedTimezone">
              @php
                $detectedTz = old('timezone', $data['timezone'] ?? 'Europe/Paris');
                $tzDisplay = [
                  'Europe/Paris' => 'Europe, Paris (UTC+1)',
                  'Europe/London' => 'Europe, Londres (UTC+0)',
                  'Europe/Berlin' => 'Europe, Berlin (UTC+1)',
                  'Europe/Madrid' => 'Europe, Madrid (UTC+1)',
                  'Europe/Rome' => 'Europe, Rome (UTC+1)',
                  'Europe/Amsterdam' => 'Europe, Amsterdam (UTC+1)',
                  'America/New_York' => 'Amérique, New York (UTC-5)',
                  'America/Los_Angeles' => 'Amérique, Los Angeles (UTC-8)',
                  'America/Chicago' => 'Amérique, Chicago (UTC-6)',
                  'America/Toronto' => 'Amérique, Toronto (UTC-5)',
                  'Asia/Tokyo' => 'Asie, Tokyo (UTC+9)',
                  'Asia/Shanghai' => 'Asie, Shanghai (UTC+8)',
                  'Asia/Dubai' => 'Asie, Dubaï (UTC+4)',
                  'Australia/Sydney' => 'Australie, Sydney (UTC+10)',
                  'Africa/Cairo' => 'Afrique, Le Caire (UTC+2)',
                  'Africa/Johannesburg' => 'Afrique, Johannesburg (UTC+2)',
                ];
                $displayTz = $tzDisplay[$detectedTz] ?? 'Europe, Paris (UTC+1)';
              @endphp
              {{ $displayTz }}
            </div>
            <div class="timezone-buttons">
              <button type="button" class="btn-timezone" id="btnNo" onclick="selectTimezoneOption(false)">
                Non
              </button>
              <button type="button" class="btn-timezone selected" id="btnYes" onclick="selectTimezoneOption(true)">
                Oui
              </button>
            </div>
            <input type="hidden" name="timezone_confirmed" id="timezoneConfirmed" value="1">
          </div>

          <!-- Section fuseau horaire (affichée si "Non" sélectionné) -->
          <div class="section" id="timezoneSelectSection" style="display: none;">
            <div class="section-title">Choisissez votre fuseau horaire</div>
            <p class="section-description">
              Il est essentiel d'être sur le bon fuseau horaire pour coordonner les consultations avec les clients à l'international.
            </p>
            <select name="timezone" id="timezone" class="timezone-select @error('timezone') form-input-error @enderror">
              <option value="">Sélectionnez votre fuseau horaire</option>
              @php
                $timezones = [
                  'Europe/Paris' => 'Europe, Paris (UTC+1)',
                  'Europe/London' => 'Europe, Londres (UTC+0)',
                  'Europe/Berlin' => 'Europe, Berlin (UTC+1)',
                  'Europe/Madrid' => 'Europe, Madrid (UTC+1)',
                  'Europe/Rome' => 'Europe, Rome (UTC+1)',
                  'Europe/Amsterdam' => 'Europe, Amsterdam (UTC+1)',
                  'America/New_York' => 'Amérique, New York (UTC-5)',
                  'America/Los_Angeles' => 'Amérique, Los Angeles (UTC-8)',
                  'America/Chicago' => 'Amérique, Chicago (UTC-6)',
                  'America/Toronto' => 'Amérique, Toronto (UTC-5)',
                  'Asia/Tokyo' => 'Asie, Tokyo (UTC+9)',
                  'Asia/Shanghai' => 'Asie, Shanghai (UTC+8)',
                  'Asia/Dubai' => 'Asie, Dubaï (UTC+4)',
                  'Australia/Sydney' => 'Australie, Sydney (UTC+10)',
                  'Africa/Cairo' => 'Afrique, Le Caire (UTC+2)',
                  'Africa/Johannesburg' => 'Afrique, Johannesburg (UTC+2)',
                ];
              @endphp
              @foreach($timezones as $tz => $label)
                <option value="{{ $tz }}" {{ old('timezone', $data['timezone'] ?? 'Europe/Paris') == $tz ? 'selected' : '' }}>
                  {{ $label }}
                </option>
              @endforeach
            </select>
            @error('timezone')
              <span class="form-error">{{ $message }}</span>
            @enderror
          </div>

          <!-- Section disponibilités -->
          <div class="section">
            <div class="section-title">Définissez vos disponibilités</div>
            <p class="section-description">
              Votre disponibilité correspond à vos heures de travail. Les clients peuvent réserver des Rituels durant ces horaires.
            </p>

            @php
              $days = [
                'monday' => 'Lundi',
                'tuesday' => 'Mardi',
                'wednesday' => 'Mercredi',
                'thursday' => 'Jeudi',
                'friday' => 'Vendredi',
                'saturday' => 'Samedi',
                'sunday' => 'Dimanche',
              ];
              $availability = old('availability', $data['availability'] ?? []);
            @endphp

            <div class="days-list">
              @foreach($days as $dayKey => $dayLabel)
                @php
                  $dayAvailability = $availability[$dayKey] ?? [];
                  $isActive = !empty($dayAvailability) && isset($dayAvailability['enabled']) && $dayAvailability['enabled'];
                  $slots = $dayAvailability['slots'] ?? [['from' => '09:00', 'to' => '17:00']];
                @endphp
                <div class="day-row">
                  <input 
                    type="checkbox" 
                    name="availability[{{ $dayKey }}][enabled]" 
                    id="day_{{ $dayKey }}"
                    class="day-checkbox"
                    value="1"
                    {{ $isActive ? 'checked' : '' }}
                    onchange="toggleDayAvailability('{{ $dayKey }}', this.checked)"
                  >
                  <label for="day_{{ $dayKey }}" class="day-label">{{ $dayLabel }}</label>
                  <div class="day-slots" id="slots_{{ $dayKey }}" style="{{ !$isActive ? 'display: none;' : '' }}">
                    @foreach($slots as $index => $slot)
                      <div class="time-slot-row" data-slot-index="{{ $index }}">
                        <span class="time-label">De</span>
                        <input 
                          type="time" 
                          name="availability[{{ $dayKey }}][slots][{{ $index }}][from]"
                          class="time-input"
                          value="{{ $slot['from'] ?? '09:00' }}"
                          {{ $isActive ? 'required' : '' }}
                        >
                        <span class="time-label">À</span>
                        <input 
                          type="time" 
                          name="availability[{{ $dayKey }}][slots][{{ $index }}][to]"
                          class="time-input"
                          value="{{ $slot['to'] ?? '17:00' }}"
                          {{ $isActive ? 'required' : '' }}
                        >
                        @if($index > 0)
                          <button 
                            type="button" 
                            class="remove-slot-link"
                            onclick="removeTimeSlot('{{ $dayKey }}', {{ $index }})"
                          >
                            Supprimer
                          </button>
                        @endif
                      </div>
                    @endforeach
                    <button 
                      type="button" 
                      class="add-slot-link"
                      onclick="addTimeSlot('{{ $dayKey }}')"
                    >
                      Ajouter un autre créneau horaire
                    </button>
                  </div>
                </div>
              @endforeach
            </div>
          </div>

          <!-- Actions -->
          <div class="onboarding-actions">
            <a href="{{ route('freelance.onboarding.step6') }}" class="btn-back">
              Retour
            </a>
            <button type="submit" class="btn-continue">
              Sauvegarder et continuer
            </button>
          </div>
        </form>
    </div>
  </div>

  <script>
    (function() {
      const trigger = document.getElementById('matchingAvailabilityTrigger');
      const panel = document.getElementById('matchingAvailabilityPanel');
      const label = document.getElementById('matchingAvailabilityLabel');
      const hidden = document.getElementById('matchingAvailabilityInput');
      const applyBtn = document.getElementById('matchingAvailabilityApply');
      const clearBtn = document.getElementById('matchingAvailabilityClear');
      if (!trigger || !panel || !label || !hidden || !applyBtn || !clearBtn) return;

      function updateLabel(count) {
        const active = typeof count === 'number' ? count : panel.querySelectorAll('.availability-time-btn.active').length;
        label.textContent = active ? `${active} créneau(x) sélectionné(s)` : 'Toutes les heures';
      }

      function hydrateFromHidden() {
        let times = [];
        let days = [];
        try {
          const parsed = JSON.parse(hidden.value || 'null');
          if (parsed && Array.isArray(parsed.times)) times = parsed.times;
          if (parsed && Array.isArray(parsed.days)) days = parsed.days;
        } catch (e) {
          times = (hidden.value || '').split(',').map(v => v.trim()).filter(Boolean);
        }

        if (times.length) {
          panel.querySelectorAll('.availability-time-btn').forEach(btn => {
            const val = btn.getAttribute('data-time');
            btn.classList.toggle('active', times.includes(val));
          });
        }
        if (days.length) {
          panel.querySelectorAll('.availability-day-btn').forEach(btn => {
            const val = btn.getAttribute('data-day');
            btn.classList.toggle('active', days.includes(val));
          });
        }
        updateLabel(times.length);
      }

      function serializeSelection() {
        const times = Array.from(panel.querySelectorAll('.availability-time-btn.active')).map(el => el.getAttribute('data-time')).filter(Boolean);
        const days = Array.from(panel.querySelectorAll('.availability-day-btn.active')).map(el => el.getAttribute('data-day')).filter(Boolean);
        hidden.value = JSON.stringify({ times, days });
        updateLabel(times.length);
      }

      trigger.addEventListener('click', function(e) {
        e.preventDefault();
        panel.classList.toggle('active');
      });

      panel.querySelectorAll('.availability-time-btn, .availability-day-btn').forEach(function(btn) {
        btn.addEventListener('click', function(e) {
          e.preventDefault();
          btn.classList.toggle('active');
        });
      });

      clearBtn.addEventListener('click', function(e) {
        e.preventDefault();
        panel.querySelectorAll('.availability-time-btn.active, .availability-day-btn.active').forEach(function(el) {
          el.classList.remove('active');
        });
        hidden.value = '';
        updateLabel(0);
      });

      applyBtn.addEventListener('click', function(e) {
        e.preventDefault();
        serializeSelection();
        panel.classList.remove('active');
      });

      hydrateFromHidden();
    })();

    // Gestion de la confirmation du fuseau horaire
    function selectTimezoneOption(isYes) {
      const btnYes = document.getElementById('btnYes');
      const btnNo = document.getElementById('btnNo');
      const timezoneSelectSection = document.getElementById('timezoneSelectSection');
      const timezoneConfirmed = document.getElementById('timezoneConfirmed');
      const timezoneSelect = document.getElementById('timezone');

      if (isYes) {
        btnYes.classList.add('selected');
        btnNo.classList.remove('selected');
        timezoneSelectSection.style.display = 'none';
        timezoneConfirmed.value = '1';
        timezoneSelect.removeAttribute('required');
      } else {
        btnNo.classList.add('selected');
        btnYes.classList.remove('selected');
        timezoneSelectSection.style.display = 'block';
        timezoneConfirmed.value = '0';
        timezoneSelect.setAttribute('required', 'required');
      }
    }

    function toggleDayAvailability(dayKey, enabled) {
      const slotsContainer = document.getElementById(`slots_${dayKey}`);
      
      if (enabled) {
        slotsContainer.style.display = 'flex';
        slotsContainer.querySelectorAll('.time-input').forEach(input => {
          input.required = true;
        });
      } else {
        slotsContainer.style.display = 'none';
        slotsContainer.querySelectorAll('.time-input').forEach(input => {
          input.required = false;
        });
      }
    }

    function addTimeSlot(dayKey) {
      const slotsContainer = document.getElementById(`slots_${dayKey}`);
      const existingSlots = slotsContainer.querySelectorAll('.time-slot-row');
      const newIndex = existingSlots.length;
      
      const newSlot = document.createElement('div');
      newSlot.className = 'time-slot-row';
      newSlot.setAttribute('data-slot-index', newIndex);
      newSlot.innerHTML = `
        <span class="time-label">De</span>
        <input 
          type="time" 
          name="availability[${dayKey}][slots][${newIndex}][from]"
          class="time-input"
          value="09:00"
          required
        >
        <span class="time-label">À</span>
        <input 
          type="time" 
          name="availability[${dayKey}][slots][${newIndex}][to]"
          class="time-input"
          value="17:00"
          required
        >
        <button 
          type="button" 
          class="remove-slot-link"
          onclick="removeTimeSlot('${dayKey}', ${newIndex})"
        >
          Supprimer
        </button>
      `;
      
      const addBtn = slotsContainer.querySelector('.add-slot-link');
      slotsContainer.insertBefore(newSlot, addBtn);
      reindexSlots(dayKey);
    }

    function removeTimeSlot(dayKey, index) {
      const slot = document.querySelector(`#slots_${dayKey} .time-slot-row[data-slot-index="${index}"]`);
      if (slot) {
        slot.remove();
        reindexSlots(dayKey);
      }
    }

    function reindexSlots(dayKey) {
      const slotsContainer = document.getElementById(`slots_${dayKey}`);
      const slots = slotsContainer.querySelectorAll('.time-slot-row');
      slots.forEach((slot, index) => {
        slot.setAttribute('data-slot-index', index);
        const fromInput = slot.querySelector('input[name*="[from]"]');
        const toInput = slot.querySelector('input[name*="[to]"]');
        if (fromInput) {
          fromInput.name = `availability[${dayKey}][slots][${index}][from]`;
        }
        if (toInput) {
          toInput.name = `availability[${dayKey}][slots][${index}][to]`;
        }
        const removeBtn = slot.querySelector('.remove-slot-link');
        if (removeBtn && index > 0) {
          removeBtn.onclick = function() { removeTimeSlot(dayKey, index); };
        } else if (removeBtn && index === 0) {
          removeBtn.remove();
        }
      });
    }

    // Validation du formulaire
    document.getElementById('availabilityForm').addEventListener('submit', function(e) {
      const timezoneConfirmed = document.getElementById('timezoneConfirmed').value;
      const timezoneSelect = document.getElementById('timezone');
      
      if (timezoneConfirmed === '0' && !timezoneSelect.value) {
        e.preventDefault();
        alert('Veuillez sélectionner votre fuseau horaire.');
        return false;
      }

      const checkedDays = document.querySelectorAll('.day-checkbox:checked');
      if (checkedDays.length === 0) {
        e.preventDefault();
        alert('Veuillez sélectionner au moins un jour de disponibilité.');
        return false;
      }

      let hasError = false;
      checkedDays.forEach(checkbox => {
        const dayKey = checkbox.id.replace('day_', '');
        const slots = document.querySelectorAll(`#slots_${dayKey} .time-slot-row`);
        slots.forEach(slot => {
          const fromInput = slot.querySelector('input[name*="[from]"]');
          const toInput = slot.querySelector('input[name*="[to]"]');
          if (fromInput.value && toInput.value && fromInput.value >= toInput.value) {
            hasError = true;
            alert(`L'heure de début doit être antérieure à l'heure de fin.`);
          }
        });
      });

      if (hasError) {
        e.preventDefault();
        return false;
      }
    });
  </script>
@endsection
