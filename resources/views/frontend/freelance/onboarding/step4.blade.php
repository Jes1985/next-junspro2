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

    /* Contenu principal */
    .onboarding-content {
      background: white;
      border-radius: 24px;
      padding: 3rem;
      box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
    }

    .onboarding-header {
      margin-bottom: 2.5rem;
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

    .onboarding-description {
      font-size: 1.05rem;
      color: #4b5563;
      line-height: 1.7;
      font-weight: 400;
    }

    /* Formulaires */
    .form-group {
      margin-bottom: 1.5rem;
    }

    .form-label {
      display: block;
      font-size: 0.95rem;
      font-weight: 600;
      color: #1a202c;
      margin-bottom: 0.75rem;
      letter-spacing: -0.01em;
    }

    .form-input,
    .form-select,
    .form-textarea {
      width: 100%;
      padding: 0.875rem 1.25rem;
      border: 2px solid #e5e7eb;
      border-radius: 12px;
      font-size: 0.95rem;
      color: #1a202c;
      transition: all 0.3s ease;
      box-sizing: border-box;
      background: white;
      font-weight: 400;
    }

    .form-input:focus,
    .form-select:focus,
    .form-textarea:focus {
      outline: none;
      border-color: var(--junspro-purple);
      box-shadow: 0 0 0 4px rgba(124, 58, 237, 0.1);
      background: #faf5ff;
    }
    
    .form-input:hover,
    .form-select:hover,
    .form-textarea:hover {
      border-color: #d1d5db;
    }

    .form-input-error {
      border-color: #ef4444 !important;
    }

    .form-error {
      display: block;
      color: #ef4444;
      font-size: 0.875rem;
      margin-top: 0.5rem;
    }

    .checkbox-group {
      display: flex;
      align-items: center;
      gap: 0.75rem;
      margin-bottom: 2rem;
      padding: 1.25rem;
      background: #f9fafb;
      border-radius: 12px;
      border: 2px solid #e5e7eb;
      transition: all 0.3s ease;
    }

    .checkbox-group:hover {
      border-color: #c4b5fd;
      background: #faf5ff;
    }

    .checkbox-input {
      width: 20px;
      height: 20px;
      cursor: pointer;
      accent-color: var(--junspro-purple);
    }

    .checkbox-label {
      font-size: 0.95rem;
      font-weight: 500;
      color: #374151;
      cursor: pointer;
    }

    .education-form {
      background: white;
      border: 2px solid #f3f4f6;
      border-radius: 16px;
      padding: 2rem;
      margin-bottom: 2rem;
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
      transition: all 0.3s ease;
    }

    .education-form:hover {
      border-color: #e9d5ff;
      box-shadow: 0 4px 16px rgba(124, 58, 237, 0.1);
    }

    .years-group {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 1rem;
    }

    .verified-badge-section {
      background: linear-gradient(135deg, #faf5ff 0%, #f3f4f6 100%);
      border: 2px solid #e9d5ff;
      border-radius: 20px;
      padding: 2.5rem;
      margin-top: 3rem;
      position: relative;
      overflow: hidden;
      box-shadow: 0 4px 20px rgba(124, 58, 237, 0.08);
    }
    
    .verified-badge-section::before {
      content: '';
      position: absolute;
      top: -50px;
      right: -50px;
      width: 200px;
      height: 200px;
      background: radial-gradient(circle, rgba(124, 58, 237, 0.1) 0%, transparent 70%);
      border-radius: 50%;
    }

    .verified-badge-title {
      font-size: 1.5rem;
      font-weight: 700;
      color: #1a202c;
      margin-bottom: 1.5rem;
    }

    .verified-badge-description {
      background: white;
      border-radius: 16px;
      padding: 1.75rem;
      margin-bottom: 1.5rem;
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
    }

    .verified-badge-requirements {
      background: white;
      border-radius: 12px;
      padding: 1.25rem;
      margin-bottom: 1.5rem;
      border: 1px solid #e5e7eb;
    }

    .file-upload-zone {
      border: 2px dashed #c4b5fd;
      border-radius: 16px;
      padding: 2.5rem;
      text-align: center;
      background: white;
      cursor: pointer;
      transition: all 0.3s ease;
      position: relative;
    }

    .file-upload-zone:hover {
      border-color: var(--junspro-purple);
      background: #faf5ff;
      transform: translateY(-2px);
      box-shadow: 0 8px 24px rgba(124, 58, 237, 0.15);
    }

    .file-upload-zone.dragover {
      border-color: var(--junspro-purple);
      background: #faf5ff;
      box-shadow: 0 0 0 4px rgba(124, 58, 237, 0.2);
      transform: scale(1.02);
    }

    .file-preview {
      margin-top: 1rem;
      padding: 1.25rem;
      background: white;
      border-radius: 12px;
      border: 2px solid #e5e7eb;
      display: flex;
      align-items: center;
      gap: 1rem;
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
      transition: all 0.2s ease;
    }
    
    .file-preview:hover {
      border-color: #c4b5fd;
      box-shadow: 0 4px 12px rgba(124, 58, 237, 0.1);
    }

    .onboarding-actions {
      display: flex;
      justify-content: space-between;
      align-items: center;
      gap: 1rem;
      margin-top: 3rem;
      padding-top: 2rem;
      border-top: 2px solid #f3f4f6;
    }

    .btn-back {
      padding: 0.875rem 2rem;
      background: white;
      border: 2px solid #e5e7eb;
      border-radius: 12px;
      color: #374151;
      font-weight: 600;
      text-decoration: none;
      cursor: pointer;
      transition: all 0.3s ease;
      display: inline-flex;
      align-items: center;
    }

    .btn-back:hover {
      border-color: #d1d5db;
      background: #f9fafb;
    }

    .btn-continue {
      padding: 0.875rem 2rem;
      background: var(--junspro-gradient);
      border: none;
      border-radius: 12px;
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

      .years-group {
        grid-template-columns: 1fr;
      }

      .onboarding-actions {
        flex-direction: column-reverse;
      }

      .btn-back,
      .btn-continue {
        width: 100%;
        justify-content: center;
      }
    }
  </style>
@endsection

@section('content')
  <div class="onboarding-page">
    <div class="onboarding-container">
      @include('frontend.freelance.onboarding.partials.premium-stepper', ['routeStep' => 4])
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
          <div class="progress-step active">
            <div class="progress-step-number">4</div>
            <span class="progress-step-label">Formation</span>
          </div>
          <span class="progress-chevron">›</span>
          <div class="progress-step pending">
            <div class="progress-step-number">5</div>
            <span class="progress-step-label">Description</span>
          </div>
          <span class="progress-chevron">›</span>
          <div class="progress-step pending">
            <div class="progress-step-number">6</div>
            <span class="progress-step-label">Vidéo</span>
          </div>
          <span class="progress-chevron">›</span>
          <div class="progress-step pending">
            <div class="progress-step-number">7</div>
            <span class="progress-step-label">Disponibilité</span>
          </div>
          <span class="progress-chevron">›</span>
          <div class="progress-step pending">
            <div class="progress-step-number">8</div>
            <span class="progress-step-label">Tarif</span>
          </div>
        </div>
      </div>

      <!-- Contenu principal -->
      <div class="onboarding-content">
        <div class="onboarding-header">
          <h1 class="onboarding-title">Formation</h1>
          <p class="onboarding-description">
            Partagez votre parcours académique et professionnel avec les clients. Vos diplômes et votre formation renforcent votre crédibilité et vous permettent de vous démarquer sur Junspro.
          </p>
        </div>

        @if(session('success'))
          <div style="padding: 1rem; background: #f0fdf4; border: 1px solid #86efac; border-radius: 12px; color: #166534; margin-bottom: 1.5rem;">
            ✓ {{ session('success') }}
          </div>
        @endif

        @if($errors->any())
          <div style="padding: 1rem; background: #fef2f2; border: 1px solid #fca5a5; border-radius: 12px; color: #991b1b; margin-bottom: 1.5rem;">
            <ul style="margin: 0; padding-left: 1.25rem;">
              @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
        @endif

        <form action="{{ route('freelance.onboarding.step4.store') }}" method="POST" enctype="multipart/form-data" id="educationForm">
          @csrf

          <!-- Option : Pas de diplôme -->
          <div class="checkbox-group">
            <input 
              type="checkbox" 
              id="no_degree" 
              name="no_degree" 
              value="1"
              class="checkbox-input"
              {{ old('no_degree', $data['no_degree']) ? 'checked' : '' }}
              onchange="toggleEducationForm(this)"
            >
            <label for="no_degree" class="checkbox-label">
              Je n'ai pas de diplôme de l'enseignement supérieur
            </label>
          </div>
          
          <!-- Champ caché pour forcer la soumission même si checkbox cochée -->
          @if(old('no_degree', $data['no_degree']))
            <input type="hidden" name="no_degree_submitted" value="1">
          @endif

          <!-- Formulaire de formation -->
          <div id="educationFormContainer" class="education-form" style="{{ old('no_degree', $data['no_degree']) ? 'display: none;' : '' }}">
            <div class="form-group">
              <label class="form-label">Université ou établissement</label>
              <input 
                type="text" 
                name="university" 
                class="form-input @error('university') form-input-error @enderror"
                value="{{ old('university', $data['university']) }}"
                placeholder="Ex : Université Lyon 2, École Polytechnique, HEC Paris..."
                required
              >
              @error('university')
                <span class="form-error">{{ $message }}</span>
              @enderror
            </div>

            <div class="form-group">
              <label class="form-label">Diplôme</label>
              <input 
                type="text" 
                name="degree" 
                class="form-input @error('degree') form-input-error @enderror"
                value="{{ old('degree', $data['degree']) }}"
                placeholder="Ex : Master 1 en Informatique, Licence en Design, MBA..."
                required
              >
              @error('degree')
                <span class="form-error">{{ $message }}</span>
              @enderror
            </div>

            <div class="form-group">
              <label class="form-label">Type de diplôme</label>
              <select name="degree_type" class="form-select @error('degree_type') form-input-error @enderror" required>
                <option value="">Choisissez votre diplôme...</option>
                <option value="Baccalauréat" {{ old('degree_type', $data['degree_type']) === 'Baccalauréat' ? 'selected' : '' }}>Baccalauréat</option>
                <option value="BTS" {{ old('degree_type', $data['degree_type']) === 'BTS' ? 'selected' : '' }}>BTS</option>
                <option value="DUT" {{ old('degree_type', $data['degree_type']) === 'DUT' ? 'selected' : '' }}>DUT</option>
                <option value="Licence" {{ old('degree_type', $data['degree_type']) === 'Licence' ? 'selected' : '' }}>Licence</option>
                <option value="Master 1" {{ old('degree_type', $data['degree_type']) === 'Master 1' ? 'selected' : '' }}>Master 1</option>
                <option value="Master 2" {{ old('degree_type', $data['degree_type']) === 'Master 2' ? 'selected' : '' }}>Master 2</option>
                <option value="MBA" {{ old('degree_type', $data['degree_type']) === 'MBA' ? 'selected' : '' }}>MBA</option>
                <option value="Doctorat" {{ old('degree_type', $data['degree_type']) === 'Doctorat' ? 'selected' : '' }}>Doctorat</option>
                <option value="Autre" {{ old('degree_type', $data['degree_type']) === 'Autre' ? 'selected' : '' }}>Autre</option>
              </select>
              @error('degree_type')
                <span class="form-error">{{ $message }}</span>
              @enderror
            </div>

            <div class="form-group">
              <label class="form-label">Spécialité</label>
              <input 
                type="text" 
                name="specialization" 
                class="form-input @error('specialization') form-input-error @enderror"
                value="{{ old('specialization', $data['specialization']) }}"
                placeholder="Ex : Développement web, Design UX/UI, Marketing digital, Gestion de projet..."
              >
              @error('specialization')
                <span class="form-error">{{ $message }}</span>
              @enderror
            </div>

            <div class="form-group">
              <label class="form-label">Années d'études</label>
              <div class="years-group">
                <div>
                  <label style="font-size: 0.875rem; color: #6b7280; margin-bottom: 0.5rem; display: block;">Année de début</label>
                  <select name="study_start_year" class="form-select @error('study_start_year') form-input-error @enderror" required>
                    <option value="">Sélectionner...</option>
                    @for($year = date('Y'); $year >= 1950; $year--)
                      <option value="{{ $year }}" {{ old('study_start_year', $data['study_start_year']) == $year ? 'selected' : '' }}>{{ $year }}</option>
                    @endfor
                  </select>
                  @error('study_start_year')
                    <span class="form-error">{{ $message }}</span>
                  @enderror
                </div>
                <div>
                  <label style="font-size: 0.875rem; color: #6b7280; margin-bottom: 0.5rem; display: block;">Année de fin</label>
                  <select name="study_end_year" class="form-select @error('study_end_year') form-input-error @enderror">
                    <option value="">Sélectionner...</option>
                    <option value="" {{ old('study_end_year', $data['study_end_year']) == '' ? 'selected' : '' }}>En cours</option>
                    @for($year = date('Y') + 10; $year >= 1950; $year--)
                      <option value="{{ $year }}" {{ old('study_end_year', $data['study_end_year']) == $year ? 'selected' : '' }}>{{ $year }}</option>
                    @endfor
                  </select>
                  @error('study_end_year')
                    <span class="form-error">{{ $message }}</span>
                  @enderror
                </div>
              </div>
            </div>
          </div>

          <!-- Section badge vérifié -->
          <div class="verified-badge-section" id="diplomaBadgeSection" style="{{ old('no_degree', $data['no_degree']) ? 'display: none;' : '' }}">
            <div style="position: relative; z-index: 1;">
              <div style="display: flex; align-items: center; gap: 1rem; margin-bottom: 1.5rem;">
                <div style="width: 48px; height: 48px; background: var(--junspro-gradient); border-radius: 12px; display: flex; align-items: center; justify-content: center; box-shadow: 0 4px 12px rgba(124, 58, 237, 0.3);">
                  <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2.5">
                    <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                    <polyline points="22 4 12 14.01 9 11.01"></polyline>
                  </svg>
                </div>
                <h2 class="verified-badge-title" style="margin: 0;">
                  Obtenez le badge « Diplôme Vérifié »
                </h2>
              </div>
              
              <div class="verified-badge-description">
                <p style="margin-bottom: 1rem; font-weight: 600; color: #1a202c; font-size: 1rem;">
                  Votre diplôme est vérifié par notre équipe avant l'activation du badge.
                </p>
                <p style="color: #4b5563; line-height: 1.8; font-size: 0.95rem; margin: 0;">
                  Conformément aux principes de protection des données, le document est supprimé après vérification. Nous conservons uniquement les informations nécessaires à la preuve de contrôle (statut, horodatage, historique), afin d'assurer la fiabilité du badge et prévenir les usages frauduleux.
                </p>
              </div>
              
              <div class="verified-badge-requirements">
                <div style="display: flex; align-items: center; gap: 0.75rem; margin-bottom: 0.75rem;">
                  <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#10b981" stroke-width="2">
                    <circle cx="12" cy="12" r="10"></circle>
                    <path d="M12 16v-4M12 8h.01"></path>
                  </svg>
                  <span style="font-size: 0.9rem; color: #374151;"><strong style="color: #1a202c;">Format accepté :</strong> JPG ou PNG</span>
                </div>
                <div style="display: flex; align-items: center; gap: 0.75rem;">
                  <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#10b981" stroke-width="2">
                    <circle cx="12" cy="12" r="10"></circle>
                    <path d="M12 16v-4M12 8h.01"></path>
                  </svg>
                  <span style="font-size: 0.9rem; color: #374151;"><strong style="color: #1a202c;">Taille maximale :</strong> 20 Mo</span>
                </div>
              </div>
              
              <div class="file-upload-zone" id="diplomaUploadZone" onclick="document.getElementById('diploma-input').click()">
                <div style="width: 64px; height: 64px; background: linear-gradient(135deg, #f3f4f6 0%, #e5e7eb 100%); border-radius: 12px; display: flex; align-items: center; justify-content: center; margin: 0 auto 1rem; box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);">
                  <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="#7C3AED" stroke-width="2">
                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                    <polyline points="17 8 12 3 7 8"></polyline>
                    <line x1="12" y1="3" x2="12" y2="15"></line>
                  </svg>
                </div>
                <div class="file-upload-text" style="font-size: 1.05rem; font-weight: 600; color: #1a202c; margin-bottom: 0.5rem;">
                  Importer votre diplôme
                </div>
                <div class="file-upload-hint" style="font-size: 0.9rem; color: #6b7280;">
                  Glissez-déposez votre fichier ou cliquez pour sélectionner
                </div>
                <input type="file" id="diploma-input" name="diploma_file[]" accept="image/jpeg,image/png,image/jpg" multiple style="display: none;">
              </div>
              
              <div id="diplomaFilesPreview" style="margin-top: 1rem;"></div>
              
              <button type="button" onclick="document.getElementById('diploma-input').click()" style="margin-top: 1rem; background: white; border: 1px solid #e5e7eb; color: #7C3AED; padding: 0.75rem 1.5rem; border-radius: 10px; font-weight: 600; transition: all 0.2s ease; cursor: pointer;">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="display: inline-block; vertical-align: middle; margin-right: 0.5rem;">
                  <line x1="12" y1="5" x2="12" y2="19"></line>
                  <line x1="5" y1="12" x2="19" y2="12"></line>
                </svg>
                Ajouter un autre diplôme
              </button>
            </div>
          </div>

          <!-- Actions -->
          <div class="onboarding-actions">
            <a href="{{ route('freelance.onboarding.step3') }}" class="btn-back">
              ← Retour
            </a>
            <button type="submit" class="btn-continue">
              Sauvegarder et continuer →
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <script>
    let diplomaFiles = [];

    function toggleEducationForm(checkbox) {
      const formContainer = document.getElementById('educationFormContainer');
      const badgeSection = document.getElementById('diplomaBadgeSection');
      const form = document.getElementById('educationForm');
      
      if (checkbox.checked) {
        formContainer.style.display = 'none';
        badgeSection.style.display = 'none';
        // Désactiver TOUS les champs requis dans le formulaire
        formContainer.querySelectorAll('input[required], select[required], textarea[required]').forEach(field => {
          field.removeAttribute('required');
          field.setAttribute('data-was-required', 'true');
        });
      } else {
        formContainer.style.display = 'block';
        badgeSection.style.display = 'block';
        // Réactiver les champs requis
        formContainer.querySelectorAll('input[data-was-required], select[data-was-required], textarea[data-was-required]').forEach(field => {
          field.setAttribute('required', 'required');
          field.removeAttribute('data-was-required');
        });
      }
    }

    // Initialiser les champs requis au chargement
    document.addEventListener('DOMContentLoaded', function() {
      const noDegreeCheckbox = document.getElementById('no_certificate');
      const formContainer = document.getElementById('educationFormContainer');
      const noDegreeCheckboxEducation = document.getElementById('no_degree');
      
      // Si "pas de diplôme" est coché au chargement, désactiver les champs requis
      if (noDegreeCheckboxEducation && noDegreeCheckboxEducation.checked) {
        formContainer.querySelectorAll('input[required], select[required], textarea[required]').forEach(field => {
          field.removeAttribute('required');
          field.setAttribute('data-was-required', 'true');
        });
      } else if (formContainer && formContainer.style.display !== 'none') {
        // Marquer les champs requis pour pouvoir les réactiver plus tard
        formContainer.querySelectorAll('input[type="text"], select').forEach(field => {
          if (field.name !== 'specialization' && field.name !== 'study_end_year' && field.hasAttribute('required')) {
            field.setAttribute('data-was-required', 'true');
          }
        });
      }
    });

    // Gestion du drag & drop pour les diplômes
    const diplomaUploadZone = document.getElementById('diplomaUploadZone');
    const diplomaInput = document.getElementById('diploma-input');
    const diplomaFilesPreview = document.getElementById('diplomaFilesPreview');

    diplomaUploadZone.addEventListener('dragover', (e) => {
      e.preventDefault();
      diplomaUploadZone.classList.add('dragover');
    });

    diplomaUploadZone.addEventListener('dragleave', () => {
      diplomaUploadZone.classList.remove('dragover');
    });

    diplomaUploadZone.addEventListener('drop', (e) => {
      e.preventDefault();
      diplomaUploadZone.classList.remove('dragover');
      const files = Array.from(e.dataTransfer.files);
      handleDiplomaFiles(files);
    });

    diplomaInput.addEventListener('change', (e) => {
      const files = Array.from(e.target.files);
      handleDiplomaFiles(files);
    });

    function handleDiplomaFiles(files) {
      files.forEach(file => {
        if (file.type.startsWith('image/')) {
          diplomaFiles.push(file);
          displayDiplomaFile(file);
        }
      });
      
      // Mettre à jour l'input file
      const dt = new DataTransfer();
      diplomaFiles.forEach(file => dt.items.add(file));
      diplomaInput.files = dt.files;
    }

    function displayDiplomaFile(file) {
      const preview = document.createElement('div');
      preview.className = 'file-preview';
      preview.innerHTML = `
        <div style="width: 48px; height: 48px; background: linear-gradient(135deg, #f3f4f6 0%, #e5e7eb 100%); border-radius: 10px; display: flex; align-items: center; justify-content: center;">
          <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#7C3AED" stroke-width="2">
            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
            <polyline points="14 2 14 8 20 8"></polyline>
            <line x1="16" y1="13" x2="8" y2="13"></line>
            <line x1="16" y1="17" x2="8" y2="17"></line>
            <polyline points="10 9 9 9 8 9"></polyline>
          </svg>
        </div>
        <div style="flex: 1;">
          <div style="font-weight: 600; color: #1a202c; margin-bottom: 0.25rem;">${file.name}</div>
          <div style="font-size: 0.875rem; color: #6b7280;">${(file.size / 1024 / 1024).toFixed(2)} Mo</div>
        </div>
        <button type="button" onclick="removeDiplomaFile(this, '${file.name}')" style="width: 36px; height: 36px; border: none; background: #fee2e2; color: #dc2626; border-radius: 8px; cursor: pointer; font-size: 18px; display: flex; align-items: center; justify-content: center; transition: all 0.2s ease; font-weight: 600;">✕</button>
      `;
      diplomaFilesPreview.appendChild(preview);
      
      // Animation d'apparition
      preview.style.opacity = '0';
      preview.style.transform = 'translateY(-10px)';
      setTimeout(() => {
        preview.style.transition = 'all 0.3s ease';
        preview.style.opacity = '1';
        preview.style.transform = 'translateY(0)';
      }, 10);
    }

    function removeDiplomaFile(button, fileName) {
      diplomaFiles = diplomaFiles.filter(file => file.name !== fileName);
      const preview = button.closest('.file-preview');
      
      // Animation de suppression
      preview.style.transition = 'all 0.3s ease';
      preview.style.opacity = '0';
      preview.style.transform = 'translateX(-20px)';
      setTimeout(() => {
        preview.remove();
      }, 300);
      
      // Mettre à jour l'input file
      const dt = new DataTransfer();
      diplomaFiles.forEach(file => dt.items.add(file));
      diplomaInput.files = dt.files;
    }
  </script>
@endsection

