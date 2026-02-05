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
      max-width: 700px;
      margin: 0 auto;
      padding: 0 1.5rem;
    }

    /* Barre de progression */
    .onboarding-progress {
      background: transparent;
      padding: 0;
      margin-bottom: 3rem;
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

    /* Contenu principal - Directement sur le fond, sans bloc */
    .onboarding-title {
      font-size: 2rem;
      font-weight: 700;
      color: #1a202c;
      margin-bottom: 2rem;
      letter-spacing: -0.01em;
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

    /* Champ de prix */
    .price-input-wrapper {
      position: relative;
      margin-bottom: 0.75rem;
    }

    .price-input {
      width: 100%;
      padding: 1rem 0;
      padding-left: 2rem;
      border: none;
      border-bottom: 2px solid #e5e7eb;
      font-size: 1.5rem;
      font-weight: 700;
      color: #1a202c;
      transition: all 0.3s ease;
      background: transparent;
    }

    .price-input:focus {
      outline: none;
      border-bottom-color: var(--junspro-purple);
    }

    .price-input:hover {
      border-bottom-color: #d1d5db;
    }

    .price-symbol {
      position: absolute;
      left: 0;
      top: 1rem;
      font-size: 1.5rem;
      font-weight: 700;
      color: #6b7280;
      pointer-events: none;
    }

    .price-currency-note {
      font-size: 0.875rem;
      color: #6b7280;
      margin-top: 0.5rem;
    }

    /* Section frais de service */
    .commission-section {
      margin-top: 2rem;
    }

    .commission-toggle {
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 0.75rem 0;
      cursor: pointer;
      border-bottom: 1px solid #f3f4f6;
      transition: all 0.2s ease;
    }

    .commission-toggle:hover {
      padding-left: 0.5rem;
    }

    .commission-title {
      font-size: 0.95rem;
      font-weight: 600;
      color: #1a202c;
    }

    .commission-icon {
      width: 20px;
      height: 20px;
      color: #6b7280;
      transition: transform 0.3s ease;
    }

    .commission-icon.expanded {
      transform: rotate(180deg);
    }

    .commission-content {
      max-height: 0;
      overflow: hidden;
      transition: max-height 0.4s ease, opacity 0.3s ease;
      opacity: 0;
      padding-top: 0;
    }

    .commission-content.expanded {
      max-height: 500px;
      opacity: 1;
      padding-top: 1rem;
    }

    .commission-text {
      font-size: 0.9rem;
      color: #4b5563;
      line-height: 1.6;
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

    .btn-finish {
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

    .btn-finish:hover {
      transform: translateY(-2px);
      box-shadow: 0 6px 20px rgba(124, 58, 237, 0.4);
    }

    .form-error {
      display: block;
      color: #ef4444;
      font-size: 0.875rem;
      margin-top: 0.5rem;
    }

    /* Responsive */
    @media (max-width: 768px) {
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
      .btn-finish {
        width: 100%;
        justify-content: center;
      }

      .price-input {
        font-size: 1.25rem;
      }

      .price-symbol {
        font-size: 1.25rem;
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
          <div class="progress-step completed">
            <div class="progress-step-number">✓</div>
            <span class="progress-step-label">Disponibilité</span>
          </div>
          <span class="progress-chevron">›</span>
          <div class="progress-step active">
            <div class="progress-step-number">8</div>
            <span class="progress-step-label">Tarif</span>
          </div>
        </div>
      </div>

      <!-- Contenu principal - Directement sur le fond, sans bloc -->
      <h1 class="onboarding-title">Fixez le tarif de vos séances</h1>

      @if(session('success'))
        <div style="padding: 1rem 0; color: #166534; margin-bottom: 2rem;">
          ✓ {{ session('success') }}
        </div>
      @endif

      @if($errors->any())
        <div style="padding: 0; color: #991b1b; margin-bottom: 2rem;">
          <ul style="margin: 0; padding-left: 1.25rem;">
            @foreach($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      <form action="{{ route('freelance.onboarding.step8.store') }}" method="POST" id="pricingForm">
        @csrf

        <!-- Section tarif -->
        <div class="section">
          <div class="price-input-wrapper">
            <span class="price-symbol">€</span>
            <input 
              type="number" 
              name="hourly_rate" 
              id="hourly_rate"
              class="price-input @error('hourly_rate') form-input-error @enderror"
              value="{{ old('hourly_rate', $data['hourly_rate'] ?? '') }}"
              placeholder="0"
              min="0"
              step="0.01"
              required
            >
          </div>
          <p class="price-currency-note">Prix en EUR uniquement</p>
          @error('hourly_rate')
            <span class="form-error">{{ $message }}</span>
          @enderror
        </div>

        <!-- Section frais de service -->
        <div class="section commission-section">
          <div class="commission-toggle" onclick="toggleCommission()">
            <span class="commission-title">Frais de service de Junspro</span>
            <svg class="commission-icon" id="commissionIcon" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <polyline points="6 9 12 15 18 9"></polyline>
            </svg>
          </div>
          <div class="commission-content" id="commissionContent">
            <p class="commission-text">
              Junspro applique des frais de service dégressifs de 20% à 12% sur chaque Rituel réservé. Ces frais de service couvrent les frais de plateforme, le traitement des paiements sécurisés, le support client, notre système de discipline et la promotion de votre profil. Vous recevrez 80% à 88% du montant de chaque Rituel après déduction des frais de service.
            </p>
            <p class="commission-text" style="margin-top: 1rem;">
              Exemple : Si vous fixez votre tarif à 50€ par séance, vous recevrez 40€ par séance réservée (50€ - 20% = 40€).
            </p>
          </div>
        </div>

        <!-- Section coordonnées bancaires -->
        <div class="section">
          <h2 class="section-title">Coordonnées bancaires</h2>
          <p class="section-description">
            Ces informations sont nécessaires pour recevoir vos paiements. Elles sont sécurisées et cryptées conformément aux normes bancaires.
          </p>

          <!-- IBAN -->
          <div style="margin-bottom: 1.5rem;">
            <label for="bank_iban" class="section-title" style="font-size: 0.95rem; margin-bottom: 0.5rem; display: block;">IBAN</label>
            <input 
              type="text" 
              id="bank_iban" 
              name="bank_iban"
              class="price-input @error('bank_iban') form-input-error @enderror"
              value="{{ old('bank_iban', $data['bank_iban'] ?? '') }}"
              placeholder="FR76 1234 5678 9012 3456 7890 123"
              style="font-size: 1rem; padding: 0.875rem 0; padding-left: 0;"
              required
              oninput="formatIBAN(this)"
            >
            <p style="font-size: 0.875rem; color: #6b7280; margin-top: 0.5rem;">
              Format : 2 lettres suivies de 2 chiffres, puis jusqu'à 30 caractères alphanumériques
            </p>
            @error('bank_iban')
              <span class="form-error">{{ $message }}</span>
            @enderror
          </div>

          <!-- Nom du titulaire -->
          <div style="margin-bottom: 1.5rem;">
            <label for="bank_account_holder" class="section-title" style="font-size: 0.95rem; margin-bottom: 0.5rem; display: block;">Nom du titulaire du compte</label>
            <input 
              type="text" 
              id="bank_account_holder" 
              name="bank_account_holder"
              class="price-input @error('bank_account_holder') form-input-error @enderror"
              value="{{ old('bank_account_holder', $data['bank_account_holder'] ?? ($user->first_name . ' ' . $user->last_name)) }}"
              placeholder="{{ $user->first_name }} {{ $user->last_name }}"
              style="font-size: 1rem; padding: 0.875rem 0; padding-left: 0;"
              required
            >
            <p style="font-size: 0.875rem; color: #6b7280; margin-top: 0.5rem; line-height: 1.5;">
              Le nom doit correspondre exactement à celui indiqué sur votre compte bancaire.
            </p>
            @error('bank_account_holder')
              <span class="form-error">{{ $message }}</span>
            @enderror
          </div>
        </div>

        <!-- Actions -->
        <div class="onboarding-actions">
          <a href="{{ route('freelance.onboarding.step7') }}" class="btn-back">
            Retour
          </a>
          <button type="submit" class="btn-finish">
            Terminer l'inscription
          </button>
        </div>
      </form>
    </div>
  </div>

  <script>
    function toggleCommission() {
      const content = document.getElementById('commissionContent');
      const icon = document.getElementById('commissionIcon');
      
      if (content.classList.contains('expanded')) {
        content.classList.remove('expanded');
        icon.classList.remove('expanded');
      } else {
        content.classList.add('expanded');
        icon.classList.add('expanded');
      }
    }

    // Ouvrir la section commission par défaut
    document.addEventListener('DOMContentLoaded', function() {
      toggleCommission();
    });

    // Formatage de l'IBAN
    function formatIBAN(input) {
      let value = input.value.replace(/\s/g, '').toUpperCase();
      let formatted = '';
      
      for (let i = 0; i < value.length; i++) {
        if (i > 0 && i % 4 === 0) {
          formatted += ' ';
        }
        formatted += value[i];
      }
      
      input.value = formatted;
    }

    // Validation du formulaire
    document.getElementById('pricingForm').addEventListener('submit', function(e) {
      const hourlyRate = document.getElementById('hourly_rate').value;
      const iban = document.getElementById('bank_iban').value.replace(/\s/g, '');
      const accountHolder = document.getElementById('bank_account_holder').value.trim();
      
      if (!hourlyRate || parseFloat(hourlyRate) <= 0) {
        e.preventDefault();
        alert('Veuillez entrer un tarif valide supérieur à 0.');
        return false;
      }

      if (parseFloat(hourlyRate) < 5) {
        e.preventDefault();
        alert('Le tarif minimum est de 5€ par séance.');
        return false;
      }

      // Validation IBAN basique (2 lettres + 2 chiffres + 10-30 caractères)
      // Retirer les espaces avant validation
      const ibanClean = iban.replace(/\s/g, '').toUpperCase();
      const ibanRegex = /^[A-Z]{2}[0-9]{2}[A-Z0-9]{10,30}$/;
      if (!ibanRegex.test(ibanClean)) {
        e.preventDefault();
        alert('Veuillez entrer un IBAN valide (format : FR76 1234 5678 9012 3456 7890 123).');
        return false;
      }

      if (!accountHolder || accountHolder.length < 2) {
        e.preventDefault();
        alert('Veuillez entrer le nom du titulaire du compte.');
        return false;
      }
    });
  </script>
@endsection

