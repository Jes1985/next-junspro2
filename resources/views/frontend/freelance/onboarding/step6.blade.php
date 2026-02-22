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
      margin-bottom: 3rem;
    }

    .onboarding-title {
      font-size: 2.25rem;
      font-weight: 800;
      color: #1a202c;
      margin-bottom: 1rem;
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

    /* Section vidéo */
    .video-section {
      margin-bottom: 3rem;
      position: relative;
    }

    /* Illustration */
    .video-illustration {
      position: absolute;
      top: -50px;
      right: -80px;
      width: 350px;
      height: auto;
      opacity: 0.15;
      pointer-events: none;
      z-index: 0;
      filter: blur(0.5px);
    }

    @media (max-width: 1200px) {
      .video-illustration {
        display: none;
      }
    }

    .video-main-section {
      position: relative;
      z-index: 1;
    }

    .onboarding-header {
      position: relative;
      overflow: hidden;
    }

    .video-main-section {
      max-width: 900px;
      margin: 0 auto;
      display: flex;
      flex-direction: column;
      gap: 2rem;
    }

    .section-title {
      font-size: 1.15rem;
      font-weight: 700;
      color: #1a202c;
      margin-bottom: 1rem;
      display: flex;
      align-items: center;
      gap: 0.75rem;
    }

    .section-title-icon {
      width: 32px;
      height: 32px;
      background: var(--junspro-gradient);
      border-radius: 8px;
      display: flex;
      align-items: center;
      justify-content: center;
      flex-shrink: 0;
      box-shadow: 0 2px 8px rgba(124, 58, 237, 0.2);
    }

    .section-text {
      font-size: 0.95rem;
      color: #4b5563;
      line-height: 1.7;
      margin-bottom: 1.5rem;
    }

    .section-text strong {
      color: #1a202c;
      font-weight: 600;
    }

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

    .form-input {
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

    .form-input:focus {
      outline: none;
      border-color: var(--junspro-purple);
      box-shadow: 0 0 0 4px rgba(124, 58, 237, 0.1);
      background: #faf5ff;
    }
    
    .form-input:hover {
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

    .video-preview-container {
      margin-top: 1rem;
    }

    .video-preview {
      width: 100%;
      aspect-ratio: 16 / 9;
      background: #000;
      border-radius: 12px;
      overflow: hidden;
      position: relative;
      box-shadow: 0 4px 16px rgba(0, 0, 0, 0.15);
    }

    .video-preview iframe {
      width: 100%;
      height: 100%;
      border: none;
    }

    .video-preview-placeholder {
      width: 100%;
      height: 100%;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      background: linear-gradient(135deg, #1a202c 0%, #2d1b4e 100%);
      color: #9ca3af;
    }

    .video-preview-placeholder svg {
      opacity: 0.5;
    }

    .thumbnail-upload-zone {
      border: 2px dashed #c4b5fd;
      border-radius: 12px;
      padding: 1.5rem;
      text-align: center;
      background: #faf5ff;
      cursor: pointer;
      transition: all 0.3s ease;
      position: relative;
      margin-top: 1rem;
      max-width: 360px;
      aspect-ratio: 16 / 9;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
    }

    @media (max-width: 968px) {
      .thumbnail-upload-zone {
        max-width: 320px;
      }
    }

    @media (max-width: 640px) {
      .thumbnail-upload-zone {
        max-width: 280px;
      }
    }

    .thumbnail-upload-zone:hover {
      border-color: var(--junspro-purple);
      background: #f3e8ff;
      transform: translateY(-2px);
      box-shadow: 0 4px 12px rgba(124, 58, 237, 0.15);
    }

    .thumbnail-upload-zone.dragover {
      border-color: var(--junspro-purple);
      background: #f3e8ff;
      box-shadow: 0 0 0 4px rgba(124, 58, 237, 0.2);
      transform: scale(1.02);
    }

    .thumbnail-upload-zone.has-image {
      padding: 0;
      border: none;
      background: transparent;
      cursor: default;
    }

    .thumbnail-preview-container {
      position: relative;
      margin-top: 1rem;
      max-width: 360px;
      aspect-ratio: 16 / 9;
      border-radius: 12px;
      overflow: hidden;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }

    @media (max-width: 968px) {
      .thumbnail-preview-container {
        max-width: 320px;
      }
    }

    @media (max-width: 640px) {
      .thumbnail-preview-container {
        max-width: 280px;
      }
    }

    .thumbnail-preview-container img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      display: block;
    }

    .thumbnail-replace-btn {
      position: absolute;
      bottom: 0.75rem;
      right: 0.75rem;
      padding: 0.5rem 1rem;
      background: rgba(124, 58, 237, 0.9);
      color: white;
      border: none;
      border-radius: 8px;
      font-size: 0.875rem;
      font-weight: 600;
      cursor: pointer;
      transition: all 0.3s ease;
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
    }

    .thumbnail-replace-btn:hover {
      background: rgba(124, 58, 237, 1);
      transform: translateY(-1px);
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
    }

    .thumbnail-preview {
      margin-top: 1rem;
      border-radius: 12px;
      overflow: hidden;
      max-width: 360px;
      aspect-ratio: 16 / 9;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }

    @media (max-width: 968px) {
      .thumbnail-preview {
        max-width: 320px;
      }
    }

    @media (max-width: 640px) {
      .thumbnail-preview {
        max-width: 280px;
      }
    }

    .thumbnail-preview img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      display: block;
    }

    /* Colonne secondaire - Guide intégré */
    .guide-section {
      margin-top: 4rem;
      padding-top: 3rem;
      border-top: 2px solid #f3f4f6;
      display: flex;
      flex-direction: column;
      gap: 2.5rem;
    }

    /* Espacement entre miniature et mini script */
    .thumbnail-section {
      margin-bottom: 3rem;
    }

    .guide-block {
      padding: 0;
    }

    .guide-block-title {
      font-size: 1.15rem;
      font-weight: 700;
      color: #1a202c;
      margin-bottom: 1rem;
      display: flex;
      align-items: center;
      gap: 0.75rem;
      padding-bottom: 0.75rem;
      border-bottom: 1px solid #e5e7eb;
    }

    .guide-block-title-icon {
      width: 32px;
      height: 32px;
      background: var(--junspro-gradient);
      border-radius: 8px;
      display: flex;
      align-items: center;
      justify-content: center;
      flex-shrink: 0;
      box-shadow: 0 2px 8px rgba(124, 58, 237, 0.2);
    }

    .guide-intro {
      font-size: 0.95rem;
      color: #4b5563;
      font-style: italic;
      margin-bottom: 1.5rem;
      line-height: 1.6;
    }

    /* Mini script intégré */
    .script-timeline {
      display: grid;
      grid-template-columns: repeat(2, 1fr);
      gap: 1.5rem;
      margin-top: 1.5rem;
    }

    @media (max-width: 968px) {
      .script-timeline {
        grid-template-columns: 1fr;
      }
    }

    .script-item {
      background: linear-gradient(135deg, #faf5ff 0%, #f3e8ff 100%);
      border: 1px solid #e9d5ff;
      border-radius: 16px;
      padding: 1.5rem;
      display: flex;
      align-items: flex-start;
      gap: 1rem;
      transition: all 0.3s ease;
      box-shadow: 0 2px 8px rgba(124, 58, 237, 0.05);
    }

    .script-item:hover {
      transform: translateY(-2px);
      box-shadow: 0 4px 16px rgba(124, 58, 237, 0.15);
      border-color: #c4b5fd;
    }

    .script-item.cta {
      background: linear-gradient(135deg, #fffbeb 0%, #fef3c7 100%);
      border-color: #fde68a;
    }

    .script-item.cta:hover {
      border-color: #fcd34d;
      box-shadow: 0 4px 16px rgba(245, 158, 11, 0.15);
    }

    .script-time {
      width: 56px;
      height: 56px;
      background: var(--junspro-gradient);
      border-radius: 12px;
      display: flex;
      align-items: center;
      justify-content: center;
      color: white;
      font-weight: 700;
      font-size: 0.875rem;
      flex-shrink: 0;
      box-shadow: 0 4px 12px rgba(124, 58, 237, 0.25);
    }

    .script-item.cta .script-time {
      background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
      box-shadow: 0 4px 12px rgba(245, 158, 11, 0.25);
    }

    .script-content {
      flex: 1;
    }

    .script-item-title {
      font-size: 1.05rem;
      font-weight: 700;
      color: #1a202c;
      margin-bottom: 0.75rem;
      letter-spacing: -0.01em;
    }

    .script-item-text {
      font-size: 0.95rem;
      color: #4b5563;
      line-height: 1.7;
    }

    /* Prérequis intégrés */
    .requirements-grid {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 1.5rem;
      margin-top: 1.5rem;
    }

    @media (max-width: 968px) {
      .requirements-grid {
        grid-template-columns: 1fr;
      }
    }

    .requirement-category-block {
      background: white;
      border: 1px solid #e5e7eb;
      border-radius: 16px;
      padding: 1.75rem;
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
      transition: all 0.3s ease;
    }

    .requirement-category-block:hover {
      box-shadow: 0 4px 16px rgba(0, 0, 0, 0.08);
      transform: translateY(-2px);
    }

    /* Système accordéon pour prérequis */
    .requirement-toggle {
      cursor: pointer;
      user-select: none;
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 0.5rem 0;
    }

    .requirement-toggle:hover {
      opacity: 0.8;
    }

    .requirement-toggle-icon {
      transition: transform 0.3s ease;
      color: #6b7280;
    }

    .requirement-toggle-icon.expanded {
      transform: rotate(180deg);
    }

    .requirement-list {
      max-height: 0;
      overflow: hidden;
      transition: max-height 0.4s ease, opacity 0.3s ease;
      opacity: 0;
    }

    .requirement-list.expanded {
      max-height: 2000px;
      opacity: 1;
    }

    .requirement-category-title {
      font-size: 0.95rem;
      font-weight: 700;
      color: #1a202c;
      margin-bottom: 1rem;
      display: flex;
      align-items: center;
      gap: 0.5rem;
      padding-bottom: 0.75rem;
      border-bottom: 2px solid #e5e7eb;
    }

    .requirement-category-title.do {
      border-bottom-color: #10b981;
    }

    .requirement-category-title.dont {
      border-bottom-color: #ef4444;
    }

    .requirement-category-icon {
      width: 24px;
      height: 24px;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .requirement-list {
      list-style: none;
      padding: 0;
      margin: 0;
      display: flex;
      flex-direction: column;
      gap: 0.75rem;
    }

    .requirement-item {
      display: flex;
      align-items: flex-start;
      gap: 0.75rem;
      padding: 0.75rem 0;
      transition: all 0.2s ease;
    }

    .requirement-item:hover {
      padding-left: 0.5rem;
    }

    .requirement-icon {
      width: 20px;
      height: 20px;
      flex-shrink: 0;
      margin-top: 0.125rem;
    }

    .requirement-text {
      flex: 1;
      font-size: 0.9rem;
      color: #4b5563;
      line-height: 1.6;
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

    .btn-continue:disabled {
      opacity: 0.5;
      cursor: not-allowed;
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
    }
  </style>
@endsection

@section('content')
  <div class="onboarding-page">
    <div class="onboarding-container">
      @include('frontend.freelance.onboarding.partials.premium-stepper', ['routeStep' => 6])
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
          <div class="progress-step active">
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
          <!-- Illustration décorative moderne -->
          <div class="video-illustration">
            <svg viewBox="0 0 500 400" fill="none" xmlns="http://www.w3.org/2000/svg">
              <defs>
                <linearGradient id="grad1" x1="0%" y1="0%" x2="100%" y2="100%">
                  <stop offset="0%" style="stop-color:#7C3AED;stop-opacity:1" />
                  <stop offset="50%" style="stop-color:#4c1d95;stop-opacity:1" />
                  <stop offset="100%" style="stop-color:#1e40af;stop-opacity:1" />
                </linearGradient>
                <radialGradient id="radial1" cx="50%" cy="50%">
                  <stop offset="0%" style="stop-color:#7C3AED;stop-opacity:0.4" />
                  <stop offset="100%" style="stop-color:#1e40af;stop-opacity:0.1" />
                </radialGradient>
              </defs>
              <!-- Caméra vidéo moderne -->
              <rect x="120" y="100" width="260" height="180" rx="25" fill="url(#grad1)" opacity="0.25"/>
              <circle cx="250" cy="190" r="65" fill="url(#radial1)"/>
              <circle cx="250" cy="190" r="45" fill="url(#grad1)" opacity="0.2"/>
              <rect x="180" y="160" width="140" height="60" rx="12" fill="url(#grad1)" opacity="0.3"/>
              <!-- Ondes sonores/vidéo -->
              <path d="M 40 190 Q 60 160, 100 190 T 180 190" stroke="url(#grad1)" stroke-width="4" fill="none" opacity="0.3" stroke-linecap="round"/>
              <path d="M 400 190 Q 420 160, 460 190 T 500 190" stroke="url(#grad1)" stroke-width="4" fill="none" opacity="0.3" stroke-linecap="round"/>
              <!-- Particules décoratives -->
              <circle cx="80" cy="80" r="6" fill="url(#grad1)" opacity="0.4"/>
              <circle cx="420" cy="100" r="5" fill="url(#grad1)" opacity="0.4"/>
              <circle cx="450" cy="280" r="7" fill="url(#grad1)" opacity="0.4"/>
              <circle cx="60" cy="320" r="5" fill="url(#grad1)" opacity="0.4"/>
              <!-- Lignes décoratives -->
              <line x1="50" y1="50" x2="100" y2="50" stroke="url(#grad1)" stroke-width="2" opacity="0.2" stroke-linecap="round"/>
              <line x1="400" y1="350" x2="450" y2="350" stroke="url(#grad1)" stroke-width="2" opacity="0.2" stroke-linecap="round"/>
            </svg>
          </div>
          <h1 class="onboarding-title">Vidéo de présentation</h1>
          <p class="onboarding-description">
            Ajoutez une vidéo de présentation pour créer une connexion authentique avec vos clients. Une vidéo bien réalisée augmente significativement votre crédibilité et votre taux de conversion sur Junspro.
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

        <form action="{{ route('freelance.onboarding.step6.store') }}" method="POST" enctype="multipart/form-data" id="videoForm">
          @csrf

          <!-- Section vidéo -->
          <div class="video-section">
            <div class="video-main-section">
              <div>
                <div class="section-title">
                  <div class="section-title-icon">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2.5">
                      <polygon points="23 7 16 12 23 17 23 7"></polygon>
                      <rect x="1" y="5" width="15" height="14" rx="2" ry="2"></rect>
                    </svg>
                  </div>
                  <span>Ajoutez votre vidéo de présentation (optionnel)</span>
                </div>

                <p class="section-text">
                  <strong>Ajoutez une vidéo horizontale de 60 secondes maximum.</strong> Dites qui vous êtes, ce que vous faites, et pour qui (en 3 phrases). Présentez-vous aux clients dans la même langue que celle de votre description. Montrez votre personnalité et votre expertise pour créer une connexion authentique. <strong>Cette étape est optionnelle</strong> - vous pourrez ajouter votre vidéo plus tard.
                </p>

                <div class="form-group">
                  <label class="form-label">URL de la vidéo (YouTube, Vimeo ou autre) - Optionnel</label>
                  <input 
                    type="url" 
                    name="video_url" 
                    id="video_url"
                    class="form-input @error('video_url') form-input-error @enderror"
                    value="{{ old('video_url', $data['video_url']) }}"
                    placeholder="https://www.youtube.com/watch?v=... ou https://vimeo.com/..."
                    oninput="updateVideoPreview(this.value)"
                  >
                  @error('video_url')
                    <span class="form-error">{{ $message }}</span>
                  @enderror
                  <p style="font-size: 0.875rem; color: #6b7280; margin-top: 0.5rem;">
                    Vous avez déjà une vidéo sur YouTube ou Vimeo ? Collez simplement le lien ci-dessus.
                  </p>
                </div>

                <!-- Aperçu vidéo -->
                <div id="videoPreviewContainer" class="video-preview-container" style="{{ empty($data['video_url']) ? 'display: none;' : '' }}">
                  <div class="video-preview" id="videoPreview">
                    <div class="video-preview-placeholder">
                      <svg width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <polygon points="23 7 16 12 23 17 23 7"></polygon>
                        <rect x="1" y="5" width="15" height="14" rx="2" ry="2"></rect>
                      </svg>
                      <p style="margin-top: 1rem; font-size: 0.9rem;">Aperçu de la vidéo</p>
                    </div>
                  </div>
                </div>

                <!-- Upload miniature -->
                <div class="thumbnail-section" style="margin-top: 2rem;">
                  <label class="form-label">Miniature de la vidéo (optionnel)</label>
                  <p style="font-size: 0.875rem; color: #6b7280; margin-bottom: 1rem;">
                    Ajoutez une image de prévisualisation pour votre vidéo. Format recommandé : 16:9 (ex: 1280×720px). Formats acceptés : JPG, PNG, WEBP.
                  </p>
                  
                  @if(!empty($data['video_thumbnail_url']))
                    <!-- Aperçu avec bouton Remplacer -->
                    <div class="thumbnail-preview-container" id="thumbnailPreviewContainer">
                      <img src="{{ $data['video_thumbnail_url'] }}" alt="Miniature actuelle" id="currentThumbnail">
                      <button type="button" class="thumbnail-replace-btn" onclick="document.getElementById('video_thumbnail').click()">
                        Remplacer
                      </button>
                    </div>
                  @else
                    <!-- Zone d'upload -->
                    <div class="thumbnail-upload-zone" id="thumbnailUploadZone" onclick="document.getElementById('video_thumbnail').click()">
                      <div style="width: 48px; height: 48px; background: linear-gradient(135deg, #f3f4f6 0%, #e5e7eb 100%); border-radius: 10px; display: flex; align-items: center; justify-content: center; margin: 0 auto 0.75rem; box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#7C3AED" stroke-width="2">
                          <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
                          <circle cx="8.5" cy="8.5" r="1.5"></circle>
                          <polyline points="21 15 16 10 5 21"></polyline>
                        </svg>
                      </div>
                      <div style="font-size: 0.9rem; font-weight: 600; color: #1a202c; margin-bottom: 0.375rem;">
                        Importer une miniature
                      </div>
                      <div style="font-size: 0.8rem; color: #6b7280;">
                        Glissez-déposez ou cliquez
                      </div>
                    </div>
                  @endif

                  <!-- Aperçu temporaire après upload -->
                  <div id="thumbnailPreview" class="thumbnail-preview-container" style="display: none; margin-top: 1rem;">
                    <img id="thumbnailPreviewImg" src="" alt="Aperçu miniature">
                    <button type="button" class="thumbnail-replace-btn" onclick="document.getElementById('video_thumbnail').click()">
                      Remplacer
                    </button>
                  </div>

                  <input type="file" id="video_thumbnail" name="video_thumbnail" accept="image/jpeg,image/png,image/jpg,image/webp" style="display: none;" onchange="handleThumbnailSelect(event)">

                  @error('video_thumbnail')
                    <span class="form-error">{{ $message }}</span>
                  @enderror
                </div>
              </div>
            </div>

            <!-- Colonne secondaire - Guide intégré -->
            <div class="guide-section">
              <!-- Mini script 60 secondes -->
              <div class="guide-block">
                <div class="guide-block-title">
                  <div class="guide-block-title-icon">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2.5">
                      <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                      <polyline points="14 2 14 8 20 8"></polyline>
                      <line x1="16" y1="13" x2="8" y2="13"></line>
                      <line x1="16" y1="17" x2="8" y2="17"></line>
                      <polyline points="10 9 9 9 8 9"></polyline>
                    </svg>
                  </div>
                  <span>Mini script ultra efficace (60 s)</span>
                </div>
                <p class="guide-intro">
                  Dites qui vous êtes, ce que vous faites, et pour qui (en 3 phrases).
                </p>
                <div class="script-timeline">
                  <div class="script-item">
                    <div class="script-time">10s</div>
                    <div class="script-content">
                      <div class="script-item-title">Qui je suis + spécialité</div>
                      <div class="script-item-text">Présentez-vous brièvement et indiquez votre domaine de compétences principal.</div>
                    </div>
                  </div>
                  <div class="script-item">
                    <div class="script-time">20s</div>
                    <div class="script-content">
                      <div class="script-item-title">À qui j'aide + problème</div>
                      <div class="script-item-text">Expliquez quel type de clients vous aidez et quels problèmes vous résolvez pour eux.</div>
                    </div>
                  </div>
                  <div class="script-item">
                    <div class="script-time">20s</div>
                    <div class="script-content">
                      <div class="script-item-title">Comment je travaille + résultat</div>
                      <div class="script-item-text">Décrivez votre méthode de travail et les résultats que vous obtenez pour vos clients.</div>
                    </div>
                  </div>
                  <div class="script-item cta">
                    <div class="script-time">10s</div>
                    <div class="script-content">
                      <div class="script-item-title">Appel à l'action</div>
                      <div class="script-item-text">Invitez les clients à vous contacter ("Écrivez-moi...", "Contactez-moi pour discuter de votre projet...").</div>
                    </div>
                  </div>
                </div>
              </div>

              <!-- Prérequis de la vidéo -->
              <div class="guide-block">
                <div class="guide-block-title">
                  <div class="guide-block-title-icon">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2.5">
                      <circle cx="12" cy="12" r="10"></circle>
                      <line x1="12" y1="16" x2="12" y2="12"></line>
                      <line x1="12" y1="8" x2="12.01" y2="8"></line>
                    </svg>
                  </div>
                  <span>Prérequis de la vidéo</span>
                </div>
                <p style="font-size: 0.95rem; color: #4b5563; margin-bottom: 2rem; line-height: 1.6;">
                  Assurez-vous que votre vidéo réponde aux exigences suivantes pour être approuvée.
                </p>

                <div class="requirements-grid">
                  <!-- À faire -->
                  <div class="requirement-category-block">
                    <div class="requirement-category-title do requirement-toggle" onclick="toggleRequirements('do')">
                      <div style="display: flex; align-items: center; gap: 0.5rem;">
                        <div class="requirement-category-icon">
                          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#10b981" stroke-width="2.5">
                            <polyline points="20 6 9 17 4 12"></polyline>
                          </svg>
                        </div>
                        <span>À faire</span>
                      </div>
                      <svg class="requirement-toggle-icon" id="icon-do" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#6b7280" stroke-width="2">
                        <polyline points="6 9 12 15 18 9"></polyline>
                      </svg>
                    </div>
                    <ul class="requirement-list" id="list-do">
                      <li class="requirement-item">
                        <svg class="requirement-icon" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#10b981" stroke-width="2">
                          <circle cx="12" cy="12" r="10"></circle>
                          <polyline points="9 12 12 15 15 12"></polyline>
                          <line x1="12" y1="9" x2="12" y2="15"></line>
                        </svg>
                        <span class="requirement-text">Votre vidéo doit durer au maximum 60 secondes</span>
                      </li>
                      <li class="requirement-item">
                        <svg class="requirement-icon" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#10b981" stroke-width="2">
                          <circle cx="12" cy="12" r="10"></circle>
                          <polyline points="9 12 12 15 15 12"></polyline>
                          <line x1="12" y1="9" x2="12" y2="15"></line>
                        </svg>
                        <span class="requirement-text">Enregistrer au format paysage (16:9) et à hauteur des yeux</span>
                      </li>
                      <li class="requirement-item">
                        <svg class="requirement-icon" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#10b981" stroke-width="2">
                          <circle cx="12" cy="12" r="10"></circle>
                          <polyline points="9 12 12 15 15 12"></polyline>
                          <line x1="12" y1="9" x2="12" y2="15"></line>
                        </svg>
                        <span class="requirement-text">Utiliser une bonne lumière et un fond neutre et professionnel</span>
                      </li>
                      <li class="requirement-item">
                        <svg class="requirement-icon" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#10b981" stroke-width="2">
                          <circle cx="12" cy="12" r="10"></circle>
                          <polyline points="9 12 12 15 15 12"></polyline>
                          <line x1="12" y1="9" x2="12" y2="15"></line>
                        </svg>
                        <span class="requirement-text">Poser la caméra sur une surface stable pour éviter que l'image tremble</span>
                      </li>
                      <li class="requirement-item">
                        <svg class="requirement-icon" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#10b981" stroke-width="2">
                          <circle cx="12" cy="12" r="10"></circle>
                          <polyline points="9 12 12 15 15 12"></polyline>
                          <line x1="12" y1="9" x2="12" y2="15"></line>
                        </svg>
                        <span class="requirement-text">Veiller à ce que votre visage et vos yeux soient entièrement visibles</span>
                      </li>
                      <li class="requirement-item">
                        <svg class="requirement-icon" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#10b981" stroke-width="2">
                          <circle cx="12" cy="12" r="10"></circle>
                          <polyline points="9 12 12 15 15 12"></polyline>
                          <line x1="12" y1="9" x2="12" y2="15"></line>
                        </svg>
                        <span class="requirement-text">Mettre l'accent sur votre expérience professionnelle et vos compétences</span>
                      </li>
                      <li class="requirement-item">
                        <svg class="requirement-icon" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#10b981" stroke-width="2">
                          <circle cx="12" cy="12" r="10"></circle>
                          <polyline points="9 12 12 15 15 12"></polyline>
                          <line x1="12" y1="9" x2="12" y2="15"></line>
                        </svg>
                        <span class="requirement-text">Accueillir chaleureusement les clients et les inviter à vous contacter</span>
                      </li>
                    </ul>
                  </div>

                  <!-- À éviter -->
                  <div class="requirement-category-block">
                    <div class="requirement-category-title dont requirement-toggle" onclick="toggleRequirements('dont')">
                      <div style="display: flex; align-items: center; gap: 0.5rem;">
                        <div class="requirement-category-icon">
                          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#ef4444" stroke-width="2.5">
                            <line x1="18" y1="6" x2="6" y2="18"></line>
                            <line x1="6" y1="6" x2="18" y2="18"></line>
                          </svg>
                        </div>
                        <span>À éviter</span>
                      </div>
                      <svg class="requirement-toggle-icon" id="icon-dont" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#6b7280" stroke-width="2">
                        <polyline points="6 9 12 15 18 9"></polyline>
                      </svg>
                    </div>
                    <ul class="requirement-list" id="list-dont">
                      <li class="requirement-item">
                        <svg class="requirement-icon" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#ef4444" stroke-width="2">
                          <circle cx="12" cy="12" r="10"></circle>
                          <line x1="12" y1="8" x2="12" y2="12"></line>
                          <line x1="12" y1="16" x2="12.01" y2="16"></line>
                        </svg>
                        <span class="requirement-text">Donner votre nom de famille ou vos coordonnées personnelles</span>
                      </li>
                      <li class="requirement-item">
                        <svg class="requirement-icon" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#ef4444" stroke-width="2">
                          <circle cx="12" cy="12" r="10"></circle>
                          <line x1="12" y1="8" x2="12" y2="12"></line>
                          <line x1="12" y1="16" x2="12.01" y2="16"></line>
                        </svg>
                        <span class="requirement-text">Inclure des logos, des liens ou des informations de contact</span>
                      </li>
                      <li class="requirement-item">
                        <svg class="requirement-icon" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#ef4444" stroke-width="2">
                          <circle cx="12" cy="12" r="10"></circle>
                          <line x1="12" y1="8" x2="12" y2="12"></line>
                          <line x1="12" y1="16" x2="12.01" y2="16"></line>
                        </svg>
                        <span class="requirement-text">Utiliser des diaporamas ou des présentations PowerPoint</span>
                      </li>
                      <li class="requirement-item">
                        <svg class="requirement-icon" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#ef4444" stroke-width="2">
                          <circle cx="12" cy="12" r="10"></circle>
                          <line x1="12" y1="8" x2="12" y2="12"></line>
                          <line x1="12" y1="16" x2="12.01" y2="16"></line>
                        </svg>
                        <span class="requirement-text">Avoir d'autres personnes apparaissant dans votre vidéo</span>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Actions -->
          <div class="onboarding-actions">
            <a href="{{ route('freelance.onboarding.step5') }}" class="btn-back">
              ← Retour
            </a>
            <button type="submit" class="btn-continue" id="submitBtn">
              Sauvegarder et continuer →
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <script>
    function getEmbedUrl(url) {
      if (!url) return null;
      
      // YouTube
      const youtubeRegex = /(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/;
      const youtubeMatch = url.match(youtubeRegex);
      if (youtubeMatch) {
        return `https://www.youtube.com/embed/${youtubeMatch[1]}`;
      }
      
      // Vimeo
      const vimeoRegex = /(?:vimeo\.com\/)(\d+)/;
      const vimeoMatch = url.match(vimeoRegex);
      if (vimeoMatch) {
        return `https://player.vimeo.com/video/${vimeoMatch[1]}`;
      }
      
      return null;
    }

    function updateVideoPreview(url) {
      const container = document.getElementById('videoPreviewContainer');
      const preview = document.getElementById('videoPreview');
      
      const embedUrl = getEmbedUrl(url);
      
      if (embedUrl) {
        container.style.display = 'block';
        preview.innerHTML = `<iframe src="${embedUrl}" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>`;
      } else if (url) {
        container.style.display = 'block';
        preview.innerHTML = `
          <div class="video-preview-placeholder">
            <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="#9ca3af" stroke-width="2">
              <polygon points="23 7 16 12 23 17 23 7"></polygon>
              <rect x="1" y="5" width="15" height="14" rx="2" ry="2"></rect>
            </svg>
            <p style="margin-top: 1rem; font-size: 0.9rem;">URL non reconnue. Veuillez utiliser YouTube ou Vimeo.</p>
          </div>
        `;
      } else {
        container.style.display = 'none';
      }
    }

    function handleThumbnailSelect(event) {
      const file = event.target.files[0];
      if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
          // Masquer la zone d'upload
          const uploadZone = document.getElementById('thumbnailUploadZone');
          if (uploadZone) {
            uploadZone.style.display = 'none';
          }
          
          // Afficher l'aperçu avec bouton Remplacer
          const preview = document.getElementById('thumbnailPreview');
          const previewImg = document.getElementById('thumbnailPreviewImg');
          if (preview && previewImg) {
            previewImg.src = e.target.result;
            preview.style.display = 'block';
          }
          
          // Si une miniature existante existe, la masquer
          const existingPreview = document.getElementById('thumbnailPreviewContainer');
          if (existingPreview && existingPreview.id === 'thumbnailPreviewContainer' && !existingPreview.querySelector('#currentThumbnail')) {
            existingPreview.style.display = 'none';
          }
        };
        reader.readAsDataURL(file);
      }
    }

    // Gestion du drag & drop pour la miniature
    const thumbnailUploadZone = document.getElementById('thumbnailUploadZone');
    const thumbnailInput = document.getElementById('video_thumbnail');

    if (thumbnailUploadZone) {
      thumbnailUploadZone.addEventListener('dragover', (e) => {
        e.preventDefault();
        thumbnailUploadZone.classList.add('dragover');
      });

      thumbnailUploadZone.addEventListener('dragleave', () => {
        thumbnailUploadZone.classList.remove('dragover');
      });

      thumbnailUploadZone.addEventListener('drop', (e) => {
        e.preventDefault();
        thumbnailUploadZone.classList.remove('dragover');
        const files = Array.from(e.dataTransfer.files);
        if (files.length > 0 && files[0].type.startsWith('image/')) {
          thumbnailInput.files = e.dataTransfer.files;
          handleThumbnailSelect({ target: { files: e.dataTransfer.files } });
        }
      });
    }

    // Initialiser l'aperçu si une URL existe déjà
    @if(!empty($data['video_url']))
      updateVideoPreview('{{ $data['video_url'] }}');
    @endif

    // Système accordéon pour prérequis
    function toggleRequirements(type) {
      const list = document.getElementById('list-' + type);
      const icon = document.getElementById('icon-' + type);
      
      if (list.classList.contains('expanded')) {
        list.classList.remove('expanded');
        icon.classList.remove('expanded');
      } else {
        list.classList.add('expanded');
        icon.classList.add('expanded');
      }
    }

    // Ouvrir par défaut les prérequis
    document.addEventListener('DOMContentLoaded', function() {
      toggleRequirements('do');
      toggleRequirements('dont');
    });
  </script>
@endsection

