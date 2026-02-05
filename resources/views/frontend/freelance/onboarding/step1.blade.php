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
      max-width: 900px;
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

    .progress-step.completed .progress-step-label {
      color: var(--junspro-purple);
    }

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
      font-size: 2rem;
      font-weight: 700;
      color: #1a202c;
      margin-bottom: 0.75rem;
    }

    .onboarding-description {
      font-size: 1rem;
      color: #6b7280;
      line-height: 1.6;
    }

    /* Formulaire */
    .onboarding-form {
      display: flex;
      flex-direction: column;
      gap: 2rem;
    }

    .form-group {
      display: flex;
      flex-direction: column;
      gap: 0.5rem;
    }

    .form-label {
      font-size: 0.95rem;
      font-weight: 600;
      color: #374151;
    }

    .form-input,
    .form-select {
      padding: 0.875rem 1rem;
      border: 2px solid #e5e7eb;
      border-radius: 12px;
      font-size: 1rem;
      transition: all 0.2s ease;
      background: white;
    }

    .form-input:focus,
    .form-select:focus {
      outline: none;
      border-color: var(--junspro-purple);
      box-shadow: 0 0 0 3px rgba(124, 58, 237, 0.1);
    }

    .form-error {
      color: #ef4444;
      font-size: 0.875rem;
      margin-top: 0.25rem;
    }

    /* Langues */
    .languages-container {
      display: flex;
      flex-direction: column;
      gap: 1rem;
    }

    .language-row {
      display: grid;
      grid-template-columns: 2fr 1fr auto;
      gap: 1rem;
      align-items: end;
    }

    .btn-add-language {
      padding: 0.5rem 1rem;
      background: #f3f4f6;
      border: 2px dashed #d1d5db;
      border-radius: 8px;
      color: #6b7280;
      font-size: 0.875rem;
      font-weight: 500;
      cursor: pointer;
      transition: all 0.2s ease;
    }

    .btn-add-language:hover {
      background: #e5e7eb;
      border-color: var(--junspro-purple);
      color: var(--junspro-purple);
    }

    .btn-remove-language {
      padding: 0.5rem;
      background: #fef2f2;
      border: 2px solid #fecaca;
      border-radius: 8px;
      color: #ef4444;
      cursor: pointer;
      transition: all 0.2s ease;
    }

    .btn-remove-language:hover {
      background: #fee2e2;
    }

    /* Services (catégories et sous-catégories) */
    .services-categories {
      display: flex;
      flex-direction: column;
      gap: 0.5rem;
      max-height: 600px;
      overflow-y: auto;
      padding-right: 0.5rem;
    }

    .service-category {
      background: white;
      border: 1px solid #e5e7eb;
      border-radius: 12px;
      overflow: hidden;
      transition: all 0.2s ease;
    }
    
    .service-category .category-subcategories {
      overflow: visible;
    }

    .service-category:hover {
      border-color: var(--junspro-purple);
      box-shadow: 0 2px 8px rgba(124, 58, 237, 0.1);
    }

    .category-header {
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 1rem 1.25rem;
      cursor: pointer;
      user-select: none;
      transition: background 0.2s ease;
    }

    .category-header:hover {
      background: #f9fafb;
    }

    .category-header.active {
      background: #faf5ff;
    }

    .category-header.has-selection {
      border-left: 3px solid var(--junspro-purple);
    }

    .category-header.has-selection .category-name {
      color: var(--junspro-purple);
    }

    .category-info {
      display: flex;
      align-items: center;
      gap: 0.75rem;
    }

    .category-icon {
      font-size: 1.5rem;
      width: 2rem;
      text-align: center;
    }

    .category-name {
      font-size: 0.95rem;
      font-weight: 600;
      color: #374151;
      text-transform: uppercase;
      letter-spacing: 0.5px;
    }

    .category-arrow {
      font-size: 0.875rem;
      color: #6b7280;
      transition: transform 0.2s ease;
    }

    .category-header.active .category-arrow {
      transform: rotate(180deg);
      color: var(--junspro-purple);
    }

    .category-subcategories {
      display: none;
      padding: 0 1.25rem 1rem 1.25rem;
      padding-left: 3.75rem;
    }

    .category-header.active + .category-subcategories,
    .category-subcategories.show {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
      gap: 1.25rem 1rem;
      padding-top: 1.25rem;
      padding-bottom: 1.25rem;
      margin-top: 0.5rem;
    }

    .subcategory-checkbox {
      display: none;
    }

    .subcategory-label {
      display: flex;
      align-items: center;
      padding: 1rem 1.25rem;
      min-height: 3.5rem;
      border: 2px solid #e5e7eb;
      border-radius: 10px;
      cursor: pointer;
      transition: all 0.2s ease;
      font-size: 0.875rem;
      font-weight: 500;
      color: #374151;
      background: white;
      line-height: 1.6;
      word-wrap: break-word;
      overflow-wrap: break-word;
      text-align: center;
      justify-content: center;
      margin: 0;
    }

    .subcategory-label:hover {
      border-color: var(--junspro-purple);
      background: #faf5ff;
    }

    .subcategory-checkbox:checked + .subcategory-label {
      background: var(--junspro-gradient);
      color: white;
      border-color: var(--junspro-purple);
    }

    .services-categories::-webkit-scrollbar {
      width: 6px;
    }

    .services-categories::-webkit-scrollbar-track {
      background: #f1f5f9;
      border-radius: 3px;
    }

    .services-categories::-webkit-scrollbar-thumb {
      background: #cbd5e1;
      border-radius: 3px;
    }

    .services-categories::-webkit-scrollbar-thumb:hover {
      background: #94a3b8;
    }

    /* Actions */
    .onboarding-actions {
      display: flex;
      justify-content: space-between;
      gap: 1rem;
      margin-top: 2rem;
      padding-top: 2rem;
      border-top: 1px solid #e5e7eb;
    }

    .btn-back {
      padding: 0.875rem 2rem;
      background: white;
      border: 2px solid #e5e7eb;
      border-radius: 12px;
      color: #6b7280;
      font-weight: 600;
      cursor: pointer;
      transition: all 0.2s ease;
      text-decoration: none;
      display: inline-flex;
      align-items: center;
      gap: 0.5rem;
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

    .btn-continue:active {
      transform: translateY(0);
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

      .language-row {
        grid-template-columns: 1fr;
      }

      .services-categories {
        max-height: 400px;
      }

      .category-subcategories.show {
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
      <!-- Barre de progression -->
      <div class="onboarding-progress">
        <div class="progress-steps">
          <div class="progress-step active">
            <div class="progress-step-number">1</div>
            <span class="progress-step-label">À propos</span>
          </div>
          <span class="progress-chevron">›</span>
          <div class="progress-step pending" style="pointer-events: none; opacity: 0.6;">
            <div class="progress-step-number">2</div>
            <span class="progress-step-label">Photo</span>
          </div>
          <span class="progress-chevron">›</span>
          <div class="progress-step pending">
            <div class="progress-step-number">3</div>
            <span class="progress-step-label">Certifications</span>
          </div>
          <span class="progress-chevron">›</span>
          <div class="progress-step pending">
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
          <h1 class="onboarding-title">À propos</h1>
          <p class="onboarding-description">
            Commencez à créer votre profil public en tant que freelance. Vos modifications seront automatiquement enregistrées à mesure que vous complétez chaque section. Vous pourrez y revenir à tout moment afin de finaliser votre inscription.
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

        <form action="{{ route('freelance.onboarding.step1.store') }}" method="POST" class="onboarding-form" enctype="multipart/form-data">
          @csrf

          <!-- Prénom -->
          <div class="form-group">
            <label for="first_name" class="form-label">Prénom</label>
            <input 
              type="text" 
              id="first_name" 
              name="first_name" 
              class="form-input @error('first_name') form-input-error @enderror"
              value="{{ old('first_name', $data['first_name'] ?? '') }}"
              required
            >
            @error('first_name')
              <span class="form-error">{{ $message }}</span>
            @enderror
          </div>

          <!-- Nom -->
          <div class="form-group">
            <label for="last_name" class="form-label">Nom</label>
            <input 
              type="text" 
              id="last_name" 
              name="last_name" 
              class="form-input @error('last_name') form-input-error @enderror"
              value="{{ old('last_name', $data['last_name'] ?? '') }}"
              required
            >
            @error('last_name')
              <span class="form-error">{{ $message }}</span>
            @enderror
          </div>

          <!-- Pays de naissance -->
          <div class="form-group">
            <label for="birth_country" class="form-label">Pays de naissance</label>
            <select 
              id="birth_country" 
              name="birth_country" 
              class="form-select @error('birth_country') form-input-error @enderror"
              required
            >
              <option value="">Choisissez votre pays...</option>
              @foreach(['FR' => 'France', 'BE' => 'Belgique', 'CH' => 'Suisse', 'CA' => 'Canada', 'US' => 'États-Unis', 'GB' => 'Royaume-Uni', 'DE' => 'Allemagne', 'ES' => 'Espagne', 'IT' => 'Italie', 'PT' => 'Portugal'] as $code => $name)
                <option value="{{ $code }}" {{ old('birth_country', $data['birth_country'] ?? '') === $code ? 'selected' : '' }}>{{ $name }}</option>
              @endforeach
            </select>
            @error('birth_country')
              <span class="form-error">{{ $message }}</span>
            @enderror
          </div>

          <!-- Adresse -->
          <div class="form-group">
            <label for="address" class="form-label">Adresse</label>
            <input 
              type="text" 
              id="address" 
              name="address" 
              class="form-input @error('address') form-input-error @enderror"
              value="{{ old('address', $data['address'] ?? '') }}"
              placeholder="123 Rue de la République"
              required
            >
            @error('address')
              <span class="form-error">{{ $message }}</span>
            @enderror
          </div>

          <!-- Code postal -->
          <div class="form-group">
            <label for="postal_code" class="form-label">Code postal</label>
            <input 
              type="text" 
              id="postal_code" 
              name="postal_code" 
              class="form-input @error('postal_code') form-input-error @enderror"
              value="{{ old('postal_code', $data['postal_code'] ?? '10001') }}"
              placeholder="10001"
              required
            >
            <p style="font-size: 0.875rem; color: #6b7280; margin-top: 0.5rem;">
              Si vous ne connaissez pas votre code postal, utilisez 10001 par défaut.
            </p>
            @error('postal_code')
              <span class="form-error">{{ $message }}</span>
            @enderror
          </div>

          <!-- Pièce d'identité -->
          <div class="form-group">
            <label for="identity_document" class="form-label">Pièce d'identité</label>
            <p style="font-size: 0.875rem; color: #6b7280; margin-bottom: 0.75rem;">
              Téléchargez une copie de votre pièce d'identité, passeport, permis de conduire ou tout autre document d'identité officiel. Ce document est nécessaire pour vérifier votre identité et recevoir vos paiements.
            </p>
            <div style="position: relative;">
              <input 
                type="file" 
                id="identity_document" 
                name="identity_document" 
                accept="image/*,.pdf"
                class="form-input @error('identity_document') form-input-error @enderror"
                style="padding: 0.75rem; border: 2px dashed #d1d5db; border-radius: 8px; cursor: pointer; transition: all 0.2s ease;"
                onchange="previewIdentityDocument(this)"
                required
              >
              <div id="identityPreview" style="margin-top: 1rem; display: none;">
                <div style="display: flex; align-items: center; gap: 0.75rem; padding: 0.75rem; background: #f9fafb; border-radius: 8px;">
                  <span style="font-size: 1.5rem;">📄</span>
                  <div style="flex: 1;">
                    <p style="margin: 0; font-weight: 600; color: #1a202c;" id="identityFileName"></p>
                    <p style="margin: 0.25rem 0 0; font-size: 0.875rem; color: #6b7280;">Document téléchargé</p>
                  </div>
                  <button type="button" onclick="removeIdentityDocument()" style="padding: 0.5rem; background: #fee2e2; border: none; border-radius: 6px; color: #dc2626; cursor: pointer;">✕</button>
                </div>
              </div>
            </div>
            @error('identity_document')
              <span class="form-error">{{ $message }}</span>
            @enderror
          </div>

          <!-- Services que vous proposez -->
          <div class="form-group">
            <label class="form-label">Services que vous proposez</label>
            <div class="services-categories">
              @foreach($serviceCategories ?? [] as $categoryIndex => $category)
                <div class="service-category">
                  <div class="category-header" onclick="toggleCategory({{ $categoryIndex }})">
                    <div class="category-info">
                      <span class="category-icon">{{ $category['icon'] }}</span>
                      <span class="category-name">{{ $category['name'] }}</span>
                    </div>
                    <span class="category-arrow">▼</span>
                  </div>
                  <div class="category-subcategories" id="subcategories_{{ $categoryIndex }}">
                    @foreach($category['subcategories'] as $subIndex => $subcategory)
                      @php
                        $serviceId = 'service_' . $categoryIndex . '_' . $subIndex;
                        $isChecked = in_array($subcategory, old('services', $data['services'] ?? []));
                      @endphp
                      <input 
                        type="checkbox" 
                        id="{{ $serviceId }}" 
                        name="services[]" 
                        value="{{ $subcategory }}"
                        class="subcategory-checkbox"
                        {{ $isChecked ? 'checked' : '' }}
                        onchange="updateCategoryState({{ $categoryIndex }})"
                      >
                      <label for="{{ $serviceId }}" class="subcategory-label">{{ $subcategory }}</label>
                    @endforeach
                  </div>
                </div>
              @endforeach
            </div>
            @error('services')
              <span class="form-error">{{ $message }}</span>
            @enderror
          </div>

          <!-- Numéro de téléphone (optionnel) -->
          <div class="form-group">
            <label for="phone" class="form-label">Numéro de téléphone (optionnel)</label>
            <div style="display: flex; gap: 0.5rem;">
              <select 
                id="phone_country_code" 
                name="phone_country_code" 
                class="form-select"
                style="flex: 0 0 120px;"
              >
                <option value="+33" {{ old('phone_country_code', $data['phone_country_code'] ?? '+33') === '+33' ? 'selected' : '' }}>🇫🇷 +33</option>
                <option value="+1" {{ old('phone_country_code', $data['phone_country_code'] ?? '') === '+1' ? 'selected' : '' }}>🇺🇸 +1</option>
                <option value="+44" {{ old('phone_country_code', $data['phone_country_code'] ?? '') === '+44' ? 'selected' : '' }}>🇬🇧 +44</option>
                <option value="+32" {{ old('phone_country_code', $data['phone_country_code'] ?? '') === '+32' ? 'selected' : '' }}>🇧🇪 +32</option>
                <option value="+41" {{ old('phone_country_code', $data['phone_country_code'] ?? '') === '+41' ? 'selected' : '' }}>🇨🇭 +41</option>
                <option value="+34" {{ old('phone_country_code', $data['phone_country_code'] ?? '') === '+34' ? 'selected' : '' }}>🇪🇸 +34</option>
                <option value="+39" {{ old('phone_country_code', $data['phone_country_code'] ?? '') === '+39' ? 'selected' : '' }}>🇮🇹 +39</option>
                <option value="+49" {{ old('phone_country_code', $data['phone_country_code'] ?? '') === '+49' ? 'selected' : '' }}>🇩🇪 +49</option>
                <option value="+351" {{ old('phone_country_code', $data['phone_country_code'] ?? '') === '+351' ? 'selected' : '' }}>🇵🇹 +351</option>
                <option value="+31" {{ old('phone_country_code', $data['phone_country_code'] ?? '') === '+31' ? 'selected' : '' }}>🇳🇱 +31</option>
                <option value="+212" {{ old('phone_country_code', $data['phone_country_code'] ?? '') === '+212' ? 'selected' : '' }}>🇲🇦 +212</option>
                <option value="+213" {{ old('phone_country_code', $data['phone_country_code'] ?? '') === '+213' ? 'selected' : '' }}>🇩🇿 +213</option>
                <option value="+216" {{ old('phone_country_code', $data['phone_country_code'] ?? '') === '+216' ? 'selected' : '' }}>🇹🇳 +216</option>
                <option value="+225" {{ old('phone_country_code', $data['phone_country_code'] ?? '') === '+225' ? 'selected' : '' }}>🇨🇮 +225</option>
                <option value="+221" {{ old('phone_country_code', $data['phone_country_code'] ?? '') === '+221' ? 'selected' : '' }}>🇸🇳 +221</option>
              </select>
              <input 
                type="tel" 
                id="phone" 
                name="phone" 
                class="form-input @error('phone') form-input-error @enderror"
                value="{{ old('phone', $data['phone'] ?? '') }}"
                placeholder="6 12 34 56 78"
                style="flex: 1;"
              >
            </div>
            @error('phone')
              <span class="form-error">{{ $message }}</span>
            @enderror
          </div>

          <!-- Langues parlées -->
          <div class="form-group">
            <label class="form-label">Langues parlées</label>
            <div class="languages-container" id="languagesContainer">
              @php
                $languages = old('languages', $data['languages'] ?? []);
                if (empty($languages)) {
                  $languages = [['language' => '', 'level' => 'native']];
                }
              @endphp
              @foreach($languages as $index => $lang)
                <div class="language-row" data-language-index="{{ $index }}">
                  <select name="languages[{{ $index }}][language]" class="form-select" required>
                    <option value="">Langue...</option>
                    @foreach(['Français', 'Anglais', 'Espagnol', 'Allemand', 'Italien', 'Portugais', 'Arabe', 'Chinois', 'Japonais', 'Russe'] as $langName)
                      <option value="{{ $langName }}" {{ ($lang['language'] ?? '') === $langName ? 'selected' : '' }}>{{ $langName }}</option>
                    @endforeach
                  </select>
                  <select name="languages[{{ $index }}][level]" class="form-select" required>
                    <option value="native" {{ ($lang['level'] ?? 'native') === 'native' ? 'selected' : '' }}>Natif</option>
                    <option value="fluent" {{ ($lang['level'] ?? '') === 'fluent' ? 'selected' : '' }}>Courant</option>
                    <option value="intermediate" {{ ($lang['level'] ?? '') === 'intermediate' ? 'selected' : '' }}>Intermédiaire</option>
                    <option value="beginner" {{ ($lang['level'] ?? '') === 'beginner' ? 'selected' : '' }}>Débutant</option>
                  </select>
                  @if($index > 0)
                    <button type="button" class="btn-remove-language" onclick="removeLanguage(this)">✕</button>
                  @endif
                </div>
              @endforeach
            </div>
            <button type="button" class="btn-add-language" onclick="addLanguage()" style="margin-top: 0.5rem;">
              + Ajouter une autre langue
            </button>
            @error('languages')
              <span class="form-error">{{ $message }}</span>
            @enderror
          </div>

          <!-- Confirmation d'âge -->
          <div class="form-group">
            <label style="display: flex; align-items: center; gap: 0.75rem; cursor: pointer;">
              <input 
                type="checkbox" 
                id="age_confirmation" 
                name="age_confirmation" 
                value="1"
                class="@error('age_confirmation') form-input-error @enderror"
                {{ old('age_confirmation', $data['age_confirmation'] ?? false) ? 'checked' : '' }}
                required
                style="width: 20px; height: 20px; cursor: pointer;"
              >
              <span style="font-size: 0.95rem; color: #374151;">Je confirme avoir plus de 18 ans</span>
            </label>
            @error('age_confirmation')
              <span class="form-error">{{ $message }}</span>
            @enderror
          </div>

          <!-- Actions -->
          <div class="onboarding-actions">
            <a href="{{ route('user.dashboard') }}" class="btn-back">
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
    let languageIndex = {{ count($languages ?? [['language' => '', 'level' => 'native']]) }};

    function addLanguage() {
      const container = document.getElementById('languagesContainer');
      const newRow = document.createElement('div');
      newRow.className = 'language-row';
      newRow.setAttribute('data-language-index', languageIndex);
      newRow.innerHTML = `
        <select name="languages[${languageIndex}][language]" class="form-select" required>
          <option value="">Langue...</option>
          <option value="Français">Français</option>
          <option value="Anglais">Anglais</option>
          <option value="Espagnol">Espagnol</option>
          <option value="Allemand">Allemand</option>
          <option value="Italien">Italien</option>
          <option value="Portugais">Portugais</option>
          <option value="Arabe">Arabe</option>
          <option value="Chinois">Chinois</option>
          <option value="Japonais">Japonais</option>
          <option value="Russe">Russe</option>
        </select>
        <select name="languages[${languageIndex}][level]" class="form-select" required>
          <option value="native">Natif</option>
          <option value="fluent">Courant</option>
          <option value="intermediate">Intermédiaire</option>
          <option value="beginner">Débutant</option>
        </select>
        <button type="button" class="btn-remove-language" onclick="removeLanguage(this)">✕</button>
      `;
      container.appendChild(newRow);
      languageIndex++;
    }

    function removeLanguage(button) {
      button.closest('.language-row').remove();
    }

    // Gestion des catégories de services
    function toggleCategory(categoryIndex) {
      const header = document.querySelector(`.category-header[onclick="toggleCategory(${categoryIndex})"]`);
      const subcategories = document.getElementById(`subcategories_${categoryIndex}`);
      
      if (header && subcategories) {
        header.classList.toggle('active');
        subcategories.classList.toggle('show');
      }
    }

    function updateCategoryState(categoryIndex) {
      const subcategories = document.getElementById(`subcategories_${categoryIndex}`);
      const checkboxes = subcategories.querySelectorAll('.subcategory-checkbox');
      const checkedCount = Array.from(checkboxes).filter(cb => cb.checked).length;
      
      // Optionnel: mettre à jour l'apparence de la catégorie si des sous-catégories sont sélectionnées
      const header = document.querySelector(`.category-header[onclick="toggleCategory(${categoryIndex})"]`);
      if (checkedCount > 0 && !header.classList.contains('has-selection')) {
        header.classList.add('has-selection');
      } else if (checkedCount === 0) {
        header.classList.remove('has-selection');
      }
    }

    // Ouvrir automatiquement les catégories avec des sous-catégories sélectionnées au chargement
    document.addEventListener('DOMContentLoaded', function() {
      const categories = document.querySelectorAll('.service-category');
      categories.forEach((category, index) => {
        const subcategories = category.querySelector('.category-subcategories');
        const checkboxes = subcategories.querySelectorAll('.subcategory-checkbox:checked');
        
        if (checkboxes.length > 0) {
          const header = category.querySelector('.category-header');
          header.classList.add('active');
          subcategories.classList.add('show');
        }
      });
    });

    // Gestion de l'aperçu de la pièce d'identité
    function previewIdentityDocument(input) {
      const preview = document.getElementById('identityPreview');
      const fileName = document.getElementById('identityFileName');
      
      if (input.files && input.files[0]) {
        fileName.textContent = input.files[0].name;
        preview.style.display = 'block';
      }
    }

    function removeIdentityDocument() {
      const input = document.getElementById('identity_document');
      const preview = document.getElementById('identityPreview');
      input.value = '';
      preview.style.display = 'none';
    }
    
    // Nettoyer localStorage après inscription réussie (on est arrivé sur step1)
    document.addEventListener('DOMContentLoaded', function() {
      // Nettoyer toutes les clés de localStorage liées à l'inscription
      Object.keys(localStorage).forEach(key => {
        if (key.startsWith('signup_form_data')) {
          localStorage.removeItem(key);
        }
      });
    });
  </script>
@endsection


