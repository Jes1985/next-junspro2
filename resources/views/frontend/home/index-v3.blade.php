@extends('frontend.layout')

@section('pageHeading')
  {{ __('Home') }}
@endsection

@section('metaKeywords')
  @if (!empty($seoInfo))
    {{ $seoInfo->meta_keyword_home }}
  @endif
@endsection

@section('metaDescription')
  @if (!empty($seoInfo))
    {{ $seoInfo->meta_description_home }}
  @endif
@endsection

@section('style')
  <link rel="stylesheet" href="{{ asset('assets/css/summernote-content.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/front/css/services-hub.css') }}">
  <style>
    :root {
      --royal-blue: #4169E1;
      --royal-blue-dark: #1E40AF;
      --purple: #7C3AED;
      --purple-light: #8B5CF6;
      --gradient-primary: linear-gradient(135deg, #4169E1 0%, #7C3AED 100%);
      --gradient-secondary: linear-gradient(135deg, #7C3AED 0%, #4169E1 100%);
    }

    .hero-modern {
      /* Le background-image est ajouté en style inline si l'image existe */
      background: linear-gradient(135deg, #1e40af 0%, #4c1d95 50%, #020617 100%);
      position: relative;
      overflow: hidden;
      padding: 0 !important;
      margin: 0 !important;
      margin-top: 0 !important;
      margin-bottom: 3rem !important;
      min-height: 80vh;
      display: flex;
      align-items: center;
      border-radius: 0 0 48px 48px;
    }

    /* Supprimer toute marge entre le header et le hero */
    .header-area + .hero-modern,
    .header-area ~ .hero-modern {
      margin-top: 0 !important;
    }

    /* Overlay en haut pour transition douce avec le header violet (adapté au gradient du header) */
    .hero-modern::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      height: 120px;
      /* Couleur adaptée au violet du header (gradient: #1e40af → #4c1d95 → #020617) */
      background: linear-gradient(to bottom, rgba(30, 64, 175, 0.55), rgba(30, 64, 175, 0));
      pointer-events: none;
      z-index: 1;
    }

    /* Dégradé noir transparent sur la moitié gauche pour garantir la lisibilité */
    .hero-modern::after {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      width: 60%;
      height: 100%;
      background: linear-gradient(to right, rgba(2, 6, 23, 0.6) 0%, rgba(2, 6, 23, 0.3) 50%, transparent 100%);
      z-index: 1;
      pointer-events: none;
    }

    .hero-modern .container {
      position: relative;
      z-index: 2;
      padding: 120px 0;
    }

    .hero-content-left {
      color: #000000;
      padding-right: 2rem;
      max-width: 50%; /* Limiter la largeur pour éviter la superposition avec la photo */
      min-width: 0; /* Pour éviter les problèmes de flex/grid avec overflow */
      position: relative;
      z-index: 10;
    }

    /* Colonne droite - Carte Freelance unique (style ComeUp) */
    /* Colonne photo - décalage pour éviter la superposition */
    .hero-photo-column {
      padding-left: 12rem !important; /* Décale la photo plus à droite pour éviter la superposition */
    }
    
    .hero-freelancer-card {
      position: relative;
      width: 100%;
      max-width: 450px;
      margin: 0 auto;
      margin-left: 0; /* Pas de marge supplémentaire, le padding de la colonne suffit */
      background: #0b1120;
      border-radius: 20px;
      overflow: hidden;
      box-shadow: 0 24px 64px rgba(0, 0, 0, 0.35), 0 0 0 1px rgba(255, 255, 255, 0.05);
      display: flex;
      flex-direction: column;
      transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .hero-freelancer-card:hover {
      transform: translateY(-4px);
      box-shadow: 0 28px 72px rgba(0, 0, 0, 0.4), 0 0 0 1px rgba(255, 255, 255, 0.08);
    }

    .hero-freelancer-photo {
      width: 100%;
      height: 70%;
      object-fit: cover;
      object-position: center;
      transition: transform 0.5s ease;
    }

    .hero-freelancer-card:hover .hero-freelancer-photo {
      transform: scale(1.03);
    }

    .hero-freelancer-info {
      padding: 1.75rem;
      background: linear-gradient(to bottom, #0b1120 0%, #111827 100%);
      color: white;
      position: relative;
    }

    .hero-freelancer-info::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      height: 1px;
      background: linear-gradient(to right, transparent, rgba(255, 255, 255, 0.1), transparent);
    }

    .hero-freelancer-name {
      font-size: 1.5rem;
      font-weight: 600;
      margin: 0 0 0.5rem 0;
      color: #FFFFFF;
      line-height: 1.2;
      letter-spacing: -0.01em;
    }

    .hero-freelancer-role {
      font-size: 1rem;
      margin: 0 0 0.375rem 0;
      color: rgba(255, 255, 255, 0.8);
      font-weight: 500;
      line-height: 1.4;
    }

    .hero-freelancer-location {
      font-size: 0.9rem;
      margin: 0;
      color: rgba(255, 255, 255, 0.65);
      font-weight: 400;
      display: flex;
      align-items: center;
      gap: 6px;
    }

    .hero-freelancer-location::before {
      content: '📍';
      font-size: 0.85rem;
    }




    /* Suppression des cartes de bénéfices du hero - elles seront dans une section dédiée plus bas */

    .hero-title {
      font-size: 3.2rem; /* Taille réduite pour éviter la superposition */
      font-weight: 400;
      color: #000000 !important;
      line-height: 1.2;
      margin-bottom: 2rem;
      text-shadow: none !important;
      display: block;
      letter-spacing: -0.02em;
      max-width: 1100px; /* Container max-width pour le H1 */
      width: 100%;
    }

    /* Style ComeUp : 2 lignes avec mot-clé en couleur accent */
    .hero-title-line-1 {
      display: block !important;
      line-height: 1.2;
      font-weight: 400;
      color: #000000 !important;
      margin-bottom: 0.75rem; /* Espacement entre les lignes */
      white-space: nowrap !important; /* Forcer sur une seule ligne */
      text-shadow: none !important;
    }

    /* Dégradé unifié pour "freelances" - même style que "freelance parfait" */
    .hero-modern .hero-title .hero-title-line-1 .highlight,
    .hero-title .hero-title-line-1 .highlight,
    .hero-title-line-1 .highlight {
      font-weight: 600 !important;
      background: linear-gradient(135deg, #60A5FA 0%, #A78BFA 50%, #C084FC 100%) !important;
      -webkit-background-clip: text !important;
      -webkit-text-fill-color: transparent !important;
      background-clip: text !important;
      color: #60A5FA !important; /* Fallback */
      display: inline-block !important;
    }
    

    .hero-title-line-2 {
      display: block !important;
      line-height: 1.2;
      font-weight: 400;
      color: #000000 !important;
      white-space: nowrap !important; /* Forcer sur une seule ligne */
      text-shadow: 0 2px 10px rgba(0, 0, 0, 0.2) !important; /* Même luminosité que page services */
    }

    .hero-subtitle {
      font-size: 1.15rem;
      color: #000000 !important;
      margin-bottom: 2.5rem;
      text-shadow: none !important;
      font-weight: 400;
      line-height: 1.6;
      max-width: 90%;
    }

    /* Segmentation (mini switch) */
    .hero-segmentation {
      display: flex;
      align-items: center;
      gap: 1rem;
      margin-bottom: 1.5rem;
    }

    .segmentation-switch {
      display: flex;
      background: rgba(255, 255, 255, 0.15);
      backdrop-filter: blur(10px);
      border-radius: 50px;
      padding: 4px;
      border: 1px solid rgba(255, 255, 255, 0.2);
    }

    .segmentation-btn {
      padding: 0.5rem 1.25rem;
      font-size: 0.9rem;
      font-weight: 500;
      color: rgba(0, 0, 0, 0.7);
      background: transparent;
      border: none;
      border-radius: 50px;
      cursor: pointer;
      transition: all 0.3s ease;
      white-space: nowrap;
    }

    .segmentation-btn:hover {
      color: #000000;
    }

    .segmentation-btn.active {
      background: linear-gradient(135deg, #7c3aed 0%, #a78bfa 50%, #2563eb 100%);
      color: #ffffff;
      box-shadow: 0 2px 8px rgba(124, 58, 237, 0.3);
    }

    .segmentation-link-freelance {
      font-size: 0.85rem;
      color: rgba(0, 0, 0, 0.6);
      text-decoration: none;
      transition: color 0.3s ease;
      white-space: nowrap;
    }

    .segmentation-link-freelance:hover {
      color: #7c3aed;
      text-decoration: underline;
    }

    /* CTAs selon le type d'utilisateur */
    .hero-ctas {
      margin-bottom: 1.5rem;
    }

    .cta-group {
      display: flex;
      align-items: center;
      gap: 1rem;
      flex-wrap: wrap;
    }

    #cta-entreprise,
    #cta-particulier {
      display: flex;
    }

    .btn-cta-primary {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      padding: 0.875rem 2rem;
      font-size: 1.05rem;
      font-weight: 600;
      color: #ffffff;
      background: linear-gradient(135deg, #7c3aed 0%, #a78bfa 50%, #2563eb 100%);
      border-radius: 50px;
      text-decoration: none;
      box-shadow: 0 4px 12px rgba(124, 58, 237, 0.3);
      transition: all 0.3s ease;
      white-space: nowrap;
    }

    .btn-cta-primary:hover {
      transform: translateY(-2px);
      box-shadow: 0 6px 16px rgba(124, 58, 237, 0.4);
      color: #ffffff;
    }

    .btn-cta-secondary {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      padding: 0.875rem 2rem;
      font-size: 1.05rem;
      font-weight: 600;
      color: #7c3aed;
      background: rgba(255, 255, 255, 0.9);
      border: 1.5px solid #7c3aed;
      border-radius: 50px;
      text-decoration: none;
      transition: all 0.3s ease;
      white-space: nowrap;
      cursor: pointer;
      position: relative;
      z-index: 10;
    }

    .btn-cta-secondary:hover {
      background: #7c3aed;
      color: #ffffff;
      transform: translateY(-2px);
    }

    .btn-cta-link {
      font-size: 0.9rem;
      color: rgba(0, 0, 0, 0.6);
      text-decoration: none;
      transition: color 0.3s ease;
      white-space: nowrap;
      cursor: pointer;
      position: relative;
      z-index: 10;
    }

    .btn-cta-link:hover {
      color: #7c3aed;
      text-decoration: underline;
    }
    
    .hero-subtitle-link {
      cursor: pointer;
      position: relative;
      z-index: 10;
    }

    .search-box-modern {
      background: rgba(255, 255, 255, 0.98);
      backdrop-filter: blur(10px);
      -webkit-backdrop-filter: blur(10px);
      border-radius: 999px;
      padding: 4px;
      box-shadow: 0 18px 40px rgba(15, 23, 42, 0.4);
      max-width: 85%; /* Plus large (de 70% à 85%) */
      width: 100%;
      margin: 0 0 1.5rem 0;
      border: 1px solid rgba(255, 255, 255, 0.4);
      transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
      height: 64px; /* Plus haute (de 58px à 64px) */
      display: flex;
      align-items: center;
    }

    .search-box-modern:hover {
      box-shadow: 0 20px 45px rgba(15, 23, 42, 0.45);
      transform: translateY(-1px);
    }

    .search-box-modern input {
      border: none;
      height: 56px; /* Ajusté pour le container de 64px */
      padding: 0 28px; /* Plus de padding horizontal */
      font-size: 1rem; /* Légèrement plus grand */
      background: transparent;
      color: #1a202c;
      font-weight: 400;
      flex: 1;
    }

    .search-box-modern input::placeholder {
      color: #9CA3AF;
      font-weight: 400;
      font-size: 0.95rem; /* Légèrement plus grand */
    }

    .search-box-modern input:focus {
      outline: none;
      box-shadow: none;
    }

    /* Bouton loupe rond intégré (style ComeUp raffiné) */
    .search-box-modern .btn-search {
      background: linear-gradient(135deg, #4c1d95 0%, #2563eb 100%);
      color: white;
      border: none;
      width: 56px; /* Plus grand (de 50px à 56px) */
      height: 56px; /* Plus grand (de 50px à 56px) */
      border-radius: 50%;
      font-weight: 500;
      font-size: 1.1rem;
      transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
      box-shadow: 0 4px 12px rgba(76, 29, 149, 0.35);
      display: flex;
      align-items: center;
      justify-content: center;
      flex-shrink: 0;
      padding: 0;
      margin-right: 4px;
    }

    .search-box-modern .btn-search i {
      font-size: 1.1rem;
      margin: 0;
    }

    .search-box-modern .btn-search:hover {
      background: linear-gradient(135deg, #5B52F0 0%, #2563eb 100%);
      transform: scale(1.05);
      box-shadow: 0 6px 16px rgba(76, 29, 149, 0.4);
    }

    /* Tags de recherche fréquentes (style texte simple comme ComeUp) */
    .hero-search-tags {
      display: flex;
      flex-wrap: wrap;
      gap: 1rem;
      margin-top: 0.75rem;
      color: #000000;
      font-size: 0.9rem;
    }

    .hero-search-tags a {
      color: #000000 !important;
      text-decoration: none;
      transition: color 0.2s ease;
      text-shadow: none;
    }

    .hero-search-tags a:hover {
      color: #000000 !important;
      text-shadow: none;
    }

    /* Barre de Preuve intégrée dans le Hero */
    .hero-proof-bar {
      padding: 32px 0 24px 0 !important;
      background: transparent !important;
      margin-top: 24px !important;
    }
    
    .hero-proof-container {
      display: flex !important;
      justify-content: flex-start !important;
      align-items: center !important;
      gap: 3rem !important;
      flex-wrap: nowrap !important;
    }
    
    .hero-proof-item {
      display: flex !important;
      align-items: center !important;
      gap: 0.75rem !important;
      flex: 0 1 auto !important;
    }
    
    .hero-proof-icon {
      width: 40px !important;
      height: 40px !important;
      border-radius: 10px !important;
      display: flex !important;
      align-items: center !important;
      justify-content: center !important;
      font-size: 18px !important;
      flex-shrink: 0 !important;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15) !important;
    }
    
    .hero-proof-icon-check {
      background: linear-gradient(135deg, #10B981 0%, #059669 100%) !important;
      color: #ffffff !important;
    }
    
    .hero-proof-icon-camera {
      background: linear-gradient(135deg, #7C3AED 0%, #6D28D9 100%) !important;
      color: #ffffff !important;
    }
    
    .hero-proof-icon-card {
      background: linear-gradient(135deg, #3B82F6 0%, #2563EB 100%) !important;
      color: #ffffff !important;
    }
    
    .hero-proof-text {
      font-size: 14px !important;
      font-weight: 500 !important;
      color: #000000 !important;
      line-height: 1.4 !important;
      text-shadow: none !important;
    }
    
    .hero-proof-text-small {
      font-size: 12px !important;
      font-weight: 400 !important;
      color: #000000 !important;
    }
    
    @media (max-width: 768px) {
      .hero-proof-bar {
        padding: 24px 0 20px 0 !important;
      }
      
      .hero-proof-container {
        flex-direction: column !important;
        gap: 1.5rem !important;
        align-items: flex-start !important;
      }
      
      .hero-proof-item {
        width: 100% !important;
      }
    }

    .section-modern {
      padding: 100px 0;
    }

    .section-title-modern {
      font-size: 3rem;
      font-weight: 800;
      color: #111827;
      margin-bottom: 1.25rem;
      letter-spacing: -0.02em;
      line-height: 1.2;
      position: relative;
    }
    
    /* Ligne décorative sous les titres de section (uniquement pour les titres centrés) */
    .text-center .section-title-modern::after {
      content: '';
      position: absolute;
      bottom: -10px;
      left: 50%;
      transform: translateX(-50%);
      width: 60px;
      height: 4px;
      background: linear-gradient(90deg, #7C3AED 0%, #5B21B6 50%, #4169E1 100%);
      border-radius: 2px;
    }

    .section-subtitle-modern {
      font-size: 1.2rem;
      color: #6B7280;
      margin-bottom: 4rem;
      font-weight: 400;
      line-height: 1.7;
      max-width: 700px;
      margin-left: auto;
      margin-right: auto;
    }

    /* Bouton Rituel d'essai - Style ovale avec couleurs Junspro */
    .btn-vision-rituel {
      display: inline-block;
      padding: 1rem 2.5rem;
      background: linear-gradient(135deg, #1e40af 0%, #4c1d95 50%, #7c3aed 100%);
      color: #ffffff !important;
      text-decoration: none;
      font-size: 1.1rem;
      font-weight: 600;
      border-radius: 50px;
      box-shadow: 0 4px 15px rgba(124, 58, 237, 0.3);
      transition: all 0.3s ease;
      border: none;
    }

    .btn-vision-rituel:hover {
      transform: translateY(-2px);
      box-shadow: 0 6px 20px rgba(124, 58, 237, 0.4);
      background: linear-gradient(135deg, #2563eb 0%, #5b21b6 50%, #8b5cf6 100%);
      color: #ffffff !important;
    }

    .btn-vision-rituel:active {
      transform: translateY(0);
      box-shadow: 0 2px 10px rgba(124, 58, 237, 0.3);
    }

    /* Section Nos Rituels - Grille 2 colonnes */
    .rituels-universes-grid {
      display: grid;
      grid-template-columns: repeat(2, 1fr);
      gap: 2rem;
      max-width: 1200px;
      margin: 0 auto;
      padding: 2rem 0;
    }

    .rituel-universe-item {
      width: 100%;
    }

    .rituel-universe-bubble {
      position: relative;
      background: linear-gradient(135deg, rgba(255, 255, 255, 0.98) 0%, rgba(250, 248, 255, 0.95) 100%);
      border-radius: 24px;
      padding: 2rem;
      box-shadow: 0 8px 32px rgba(139, 92, 246, 0.12), 0 2px 8px rgba(139, 92, 246, 0.08), inset 0 1px 0 rgba(255, 255, 255, 0.9);
      transition: all 0.5s cubic-bezier(0.34, 1.56, 0.64, 1);
      border: 2px solid rgba(196, 181, 253, 0.2);
      backdrop-filter: blur(30px);
      height: 100%;
      display: flex;
      flex-direction: column;
    }

    .rituel-universe-bubble:hover {
      transform: translateY(-6px) scale(1.02);
      box-shadow: 0 16px 48px rgba(139, 92, 246, 0.2), 0 4px 16px rgba(139, 92, 246, 0.15), inset 0 1px 0 rgba(255, 255, 255, 0.95);
    }

    .rituel-universe-content {
      display: flex;
      flex-direction: column;
      gap: 1.5rem;
      height: 100%;
    }

    .rituel-universe-header {
      display: flex;
      align-items: center;
      gap: 1rem;
    }

    .rituel-universe-emoji-wrapper {
      width: 60px;
      height: 60px;
      border-radius: 16px;
      display: flex;
      align-items: center;
      justify-content: center;
      background: linear-gradient(135deg, rgba(255, 255, 255, 0.9) 0%, rgba(255, 255, 255, 0.7) 100%);
      box-shadow: 0 4px 16px rgba(0, 0, 0, 0.1), inset 0 1px 0 rgba(255, 255, 255, 0.5);
      border: 1.5px solid rgba(196, 181, 253, 0.3);
      flex-shrink: 0;
    }

    .rituel-universe-emoji {
      font-size: 2rem;
      line-height: 1;
    }

    .rituel-universe-title {
      font-size: 1.5rem;
      font-weight: 700;
      color: #1a202c;
      margin: 0;
      letter-spacing: -0.01em;
    }

    .rituel-universe-cta {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      gap: 0.5rem;
      padding: 0.875rem 1.75rem;
      border-radius: 12px;
      font-size: 1rem;
      font-weight: 600;
      color: #ffffff;
      text-decoration: none;
      transition: all 0.3s ease;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15), 0 0 0 1px rgba(255, 255, 255, 0.2) inset;
      margin-top: auto;
    }

    .rituel-universe-cta:hover {
      transform: translateY(-2px);
      box-shadow: 0 8px 24px rgba(0, 0, 0, 0.25), 0 0 0 1px rgba(255, 255, 255, 0.3) inset;
    }

    .rituel-universe-cta svg {
      transition: transform 0.3s ease;
    }

    .rituel-universe-cta:hover svg {
      transform: translateX(4px);
    }

    /* Couleurs spécifiques par univers */
    /* Projets (index 0) - Violet/Bleu */
    .rituel-universe-item[data-index="0"] .rituel-universe-bubble {
      border-color: rgba(139, 92, 246, 0.3) !important;
      box-shadow: 0 8px 32px rgba(139, 92, 246, 0.12), 0 2px 8px rgba(37, 99, 235, 0.08), inset 0 1px 0 rgba(255, 255, 255, 0.9) !important;
    }

    .rituel-universe-item[data-index="0"] .rituel-universe-bubble:hover {
      border-color: rgba(37, 99, 235, 0.4) !important;
      box-shadow: 0 16px 48px rgba(139, 92, 246, 0.2), 0 4px 16px rgba(37, 99, 235, 0.15), inset 0 1px 0 rgba(255, 255, 255, 0.95) !important;
    }

    .rituel-universe-item[data-index="0"] .rituel-universe-emoji-wrapper {
      border-color: rgba(139, 92, 246, 0.3) !important;
    }

    .rituel-universe-item[data-index="0"] .rituel-universe-cta {
      background: linear-gradient(135deg, #8B5CF6 0%, #A78BFA 50%, #2563EB 100%) !important;
      box-shadow: 0 4px 12px rgba(139, 92, 246, 0.3), 0 0 0 1px rgba(255, 255, 255, 0.2) inset !important;
    }

    .rituel-universe-item[data-index="0"] .rituel-universe-cta:hover {
      box-shadow: 0 8px 24px rgba(37, 99, 235, 0.4), 0 0 0 1px rgba(255, 255, 255, 0.3) inset !important;
    }

    /* Cours (index 1) - Bleu/Cyan */
    .rituel-universe-item[data-index="1"] .rituel-universe-bubble {
      border-color: rgba(6, 182, 212, 0.3) !important;
      box-shadow: 0 8px 32px rgba(6, 182, 212, 0.12), 0 2px 8px rgba(6, 182, 212, 0.08), inset 0 1px 0 rgba(255, 255, 255, 0.9) !important;
    }

    .rituel-universe-item[data-index="1"] .rituel-universe-bubble:hover {
      border-color: rgba(6, 182, 212, 0.4) !important;
      box-shadow: 0 16px 48px rgba(6, 182, 212, 0.2), 0 4px 16px rgba(6, 182, 212, 0.15), inset 0 1px 0 rgba(255, 255, 255, 0.95) !important;
    }

    .rituel-universe-item[data-index="1"] .rituel-universe-emoji-wrapper {
      border-color: rgba(6, 182, 212, 0.3) !important;
    }

    .rituel-universe-item[data-index="1"] .rituel-universe-cta {
      background: linear-gradient(135deg, #2563EB 0%, #06B6D4 50%, #22D3EE 100%) !important;
      box-shadow: 0 4px 12px rgba(6, 182, 212, 0.3), 0 0 0 1px rgba(255, 255, 255, 0.2) inset !important;
    }

    .rituel-universe-item[data-index="1"] .rituel-universe-cta:hover {
      box-shadow: 0 8px 24px rgba(6, 182, 212, 0.4), 0 0 0 1px rgba(255, 255, 255, 0.3) inset !important;
    }

    /* Services at Home (index 2) - Jaune/Orange */
    .rituel-universe-item[data-index="2"] .rituel-universe-bubble {
      border-color: rgba(251, 191, 36, 0.3) !important;
      box-shadow: 0 8px 32px rgba(251, 191, 36, 0.12), 0 2px 8px rgba(251, 191, 36, 0.08), inset 0 1px 0 rgba(255, 255, 255, 0.9) !important;
    }

    .rituel-universe-item[data-index="2"] .rituel-universe-bubble:hover {
      border-color: rgba(251, 191, 36, 0.4) !important;
      box-shadow: 0 16px 48px rgba(251, 191, 36, 0.2), 0 4px 16px rgba(251, 191, 36, 0.15), inset 0 1px 0 rgba(255, 255, 255, 0.95) !important;
    }

    .rituel-universe-item[data-index="2"] .rituel-universe-emoji-wrapper {
      border-color: rgba(251, 191, 36, 0.3) !important;
    }

    .rituel-universe-item[data-index="2"] .rituel-universe-cta {
      background: linear-gradient(135deg, #FBBF24 0%, #FB923C 50%, #2563EB 100%) !important;
      box-shadow: 0 4px 12px rgba(251, 191, 36, 0.3), 0 0 0 1px rgba(255, 255, 255, 0.2) inset !important;
    }

    .rituel-universe-item[data-index="2"] .rituel-universe-cta:hover {
      box-shadow: 0 8px 24px rgba(251, 191, 36, 0.4), 0 0 0 1px rgba(255, 255, 255, 0.3) inset !important;
    }

    /* Junspro Ritual Motion (index 3) - Orange/Rouge */
    .rituel-universe-item[data-index="3"] .rituel-universe-bubble {
      border-color: rgba(251, 146, 60, 0.3) !important;
      box-shadow: 0 8px 32px rgba(251, 146, 60, 0.12), 0 2px 8px rgba(234, 88, 12, 0.08), inset 0 1px 0 rgba(255, 255, 255, 0.9) !important;
    }

    .rituel-universe-item[data-index="3"] .rituel-universe-bubble:hover {
      border-color: rgba(234, 88, 12, 0.4) !important;
      box-shadow: 0 16px 48px rgba(251, 146, 60, 0.2), 0 4px 16px rgba(234, 88, 12, 0.15), inset 0 1px 0 rgba(255, 255, 255, 0.95) !important;
    }

    .rituel-universe-item[data-index="3"] .rituel-universe-emoji-wrapper {
      border-color: rgba(234, 88, 12, 0.3) !important;
    }

    .rituel-universe-item[data-index="3"] .rituel-universe-cta {
      background: linear-gradient(135deg, #F97316 0%, #EA580C 50%, #DC2626 100%) !important;
      box-shadow: 0 4px 12px rgba(234, 88, 12, 0.3), 0 0 0 1px rgba(255, 255, 255, 0.2) inset !important;
    }

    .rituel-universe-item[data-index="3"] .rituel-universe-cta:hover {
      box-shadow: 0 8px 24px rgba(234, 88, 12, 0.4), 0 0 0 1px rgba(255, 255, 255, 0.3) inset !important;
    }

    /* Échanges de logement (index 4) - Rose/Bleu */
    .rituel-universe-item[data-index="4"] .rituel-universe-bubble {
      border-color: rgba(236, 72, 153, 0.3) !important;
      box-shadow: 0 8px 32px rgba(236, 72, 153, 0.12), 0 2px 8px rgba(37, 99, 235, 0.08), inset 0 1px 0 rgba(255, 255, 255, 0.9) !important;
    }

    .rituel-universe-item[data-index="4"] .rituel-universe-bubble:hover {
      border-color: rgba(37, 99, 235, 0.4) !important;
      box-shadow: 0 16px 48px rgba(236, 72, 153, 0.2), 0 4px 16px rgba(37, 99, 235, 0.15), inset 0 1px 0 rgba(255, 255, 255, 0.95) !important;
    }

    .rituel-universe-item[data-index="4"] .rituel-universe-emoji-wrapper {
      border-color: rgba(236, 72, 153, 0.3) !important;
    }

    .rituel-universe-item[data-index="4"] .rituel-universe-cta {
      background: linear-gradient(135deg, #EC4899 0%, #F472B6 50%, #2563EB 100%) !important;
      box-shadow: 0 4px 12px rgba(236, 72, 153, 0.3), 0 0 0 1px rgba(255, 255, 255, 0.2) inset !important;
    }

    .rituel-universe-item[data-index="4"] .rituel-universe-cta:hover {
      box-shadow: 0 8px 24px rgba(37, 99, 235, 0.4), 0 0 0 1px rgba(255, 255, 255, 0.3) inset !important;
    }

    /* Bien-être en entreprise (index 5) - Jaune/Vert */
    .rituel-universe-item[data-index="5"] .rituel-universe-bubble {
      border-color: rgba(251, 191, 36, 0.3) !important;
      box-shadow: 0 8px 32px rgba(251, 191, 36, 0.12), 0 2px 8px rgba(132, 204, 22, 0.08), inset 0 1px 0 rgba(255, 255, 255, 0.9) !important;
    }

    .rituel-universe-item[data-index="5"] .rituel-universe-bubble:hover {
      border-color: rgba(132, 204, 22, 0.4) !important;
      box-shadow: 0 16px 48px rgba(251, 191, 36, 0.2), 0 4px 16px rgba(132, 204, 22, 0.15), inset 0 1px 0 rgba(255, 255, 255, 0.95) !important;
    }

    .rituel-universe-item[data-index="5"] .rituel-universe-emoji-wrapper {
      border-color: rgba(132, 204, 22, 0.3) !important;
    }

    .rituel-universe-item[data-index="5"] .rituel-universe-cta {
      background: linear-gradient(135deg, #FBBF24 0%, #84CC16 50%, #2563EB 100%) !important;
      box-shadow: 0 4px 12px rgba(132, 204, 22, 0.3), 0 0 0 1px rgba(255, 255, 255, 0.2) inset !important;
    }

    .rituel-universe-item[data-index="5"] .rituel-universe-cta:hover {
      box-shadow: 0 8px 24px rgba(132, 204, 22, 0.4), 0 0 0 1px rgba(255, 255, 255, 0.3) inset !important;
    }

    /* Responsive */
    @media (max-width: 768px) {
      .rituels-universes-grid {
        grid-template-columns: 1fr;
        gap: 1.5rem;
        padding: 1rem 0;
      }

      .rituel-universe-bubble {
        padding: 1.5rem;
      }

      .rituel-universe-title {
        font-size: 1.25rem;
      }

      .rituel-universe-emoji-wrapper {
        width: 50px;
        height: 50px;
      }

      .rituel-universe-emoji {
        font-size: 1.5rem;
      }
    }

    .guarantee-card-modern {
      background: white;
      border-radius: 24px;
      padding: 2.5rem;
      height: 100%;
      box-shadow: 0 4px 24px rgba(0, 0, 0, 0.06);
      transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
      border: 1.5px solid #F3F4F6;
      position: relative;
      overflow: hidden;
    }

    .guarantee-card-modern::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      height: 4px;
      background: linear-gradient(135deg, #1e40af 0%, #4c1d95 50%, #7c3aed 100%);
      transform: scaleX(0);
      transition: transform 0.4s ease;
    }

    .guarantee-card-modern:hover {
      transform: translateY(-12px);
      box-shadow: 0 20px 60px rgba(30, 64, 175, 0.25);
      border-color: #1e40af;
    }

    .guarantee-card-modern:hover::before {
      transform: scaleX(1);
    }

    .guarantee-icon-modern {
      width: 80px;
      height: 80px;
      border-radius: 20px;
      background: linear-gradient(135deg, #1e40af 0%, #4c1d95 50%, #7c3aed 100%);
      display: flex;
      align-items: center;
      justify-content: center;
      margin-bottom: 1.75rem;
      color: white;
      font-size: 2rem;
      box-shadow: 0 8px 24px rgba(30, 64, 175, 0.4);
      transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .guarantee-card-modern:hover .guarantee-icon-modern {
      transform: scale(1.1) rotate(5deg);
      box-shadow: 0 12px 32px rgba(30, 64, 175, 0.5);
      background: linear-gradient(135deg, #2563eb 0%, #5b21b6 50%, #8b5cf6 100%);
    }

    .category-card-modern {
      background: white;
      border-radius: 24px;
      padding: 2.5rem;
      height: 100%;
      box-shadow: 0 4px 24px rgba(0, 0, 0, 0.06);
      transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
      border: 1.5px solid #F3F4F6;
      position: relative;
      overflow: hidden;
    }

    .category-card-modern::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      height: 5px;
      background: var(--gradient-primary);
      transform: scaleX(0);
      transition: transform 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .category-card-modern:hover {
      transform: translateY(-12px);
      box-shadow: 0 20px 60px rgba(79, 70, 229, 0.25);
      border-color: var(--royal-blue);
    }

    .category-card-modern:hover::before {
      transform: scaleX(1);
    }

    .category-card-modern.premium {
      border-color: #F59E0B;
      background: linear-gradient(135deg, #FFFBF0 0%, #FFFFFF 100%);
    }

    .category-card-modern.premium::before {
      background: linear-gradient(135deg, #F59E0B 0%, #F97316 100%);
    }

    .category-icon-modern {
      width: 90px;
      height: 90px;
      border-radius: 22px;
      background: var(--gradient-primary);
      display: flex;
      align-items: center;
      justify-content: center;
      margin-bottom: 1.75rem;
      overflow: hidden;
      box-shadow: 0 8px 24px rgba(79, 70, 229, 0.3);
      transition: transform 0.3s ease;
    }

    .category-card-modern:hover .category-icon-modern {
      transform: scale(1.1) rotate(5deg);
    }

    /* Cartes Catégories Populaires */
    .popular-category-card {
      background: #ffffff;
      border-radius: 24px;
      padding: 2.5rem;
      height: 100%;
      box-shadow: 0 4px 24px rgba(0, 0, 0, 0.06);
      transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
      border: 1.5px solid #F3F4F6;
      position: relative;
      overflow: hidden;
    }

    .popular-category-card::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      height: 4px;
      background: linear-gradient(135deg, #1e40af 0%, #4c1d95 50%, #7c3aed 100%);
      transform: scaleX(0);
      transition: transform 0.4s ease;
    }

    /* Couleurs par univers pour les cartes */
    .popular-category-card[data-universe-index="0"] {
      border-color: rgba(139, 92, 246, 0.3);
    }
    .popular-category-card[data-universe-index="0"]::before {
      background: linear-gradient(135deg, #8B5CF6 0%, #A78BFA 50%, #2563EB 100%);
    }
    .popular-category-card[data-universe-index="0"]:hover {
      border-color: rgba(37, 99, 235, 0.4);
      box-shadow: 0 20px 60px rgba(139, 92, 246, 0.25);
    }

    .popular-category-card[data-universe-index="1"] {
      border-color: rgba(6, 182, 212, 0.3);
    }
    .popular-category-card[data-universe-index="1"]::before {
      background: linear-gradient(135deg, #2563EB 0%, #06B6D4 50%, #22D3EE 100%);
    }
    .popular-category-card[data-universe-index="1"]:hover {
      border-color: rgba(6, 182, 212, 0.4);
      box-shadow: 0 20px 60px rgba(6, 182, 212, 0.25);
    }

    .popular-category-card[data-universe-index="2"] {
      border-color: rgba(251, 191, 36, 0.3);
    }
    .popular-category-card[data-universe-index="2"]::before {
      background: linear-gradient(135deg, #FBBF24 0%, #FB923C 50%, #2563EB 100%);
    }
    .popular-category-card[data-universe-index="2"]:hover {
      border-color: rgba(251, 191, 36, 0.4);
      box-shadow: 0 20px 60px rgba(251, 191, 36, 0.25);
    }

    .popular-category-card[data-universe-index="3"] {
      border-color: rgba(251, 146, 60, 0.3);
    }
    .popular-category-card[data-universe-index="3"]::before {
      background: linear-gradient(135deg, #F97316 0%, #EA580C 50%, #DC2626 100%);
    }
    .popular-category-card[data-universe-index="3"]:hover {
      border-color: rgba(234, 88, 12, 0.4);
      box-shadow: 0 20px 60px rgba(234, 88, 12, 0.25);
    }

    .popular-category-card[data-universe-index="4"] {
      border-color: rgba(236, 72, 153, 0.3);
    }
    .popular-category-card[data-universe-index="4"]::before {
      background: linear-gradient(135deg, #EC4899 0%, #F472B6 50%, #2563EB 100%);
    }
    .popular-category-card[data-universe-index="4"]:hover {
      border-color: rgba(37, 99, 235, 0.4);
      box-shadow: 0 20px 60px rgba(236, 72, 153, 0.25);
    }

    .popular-category-card[data-universe-index="5"] {
      border-color: rgba(251, 191, 36, 0.3);
    }
    .popular-category-card[data-universe-index="5"]::before {
      background: linear-gradient(135deg, #FBBF24 0%, #84CC16 50%, #2563EB 100%);
    }
    .popular-category-card[data-universe-index="5"]:hover {
      border-color: rgba(132, 204, 22, 0.4);
      box-shadow: 0 20px 60px rgba(132, 204, 22, 0.25);
    }

    .popular-category-card:hover {
      transform: translateY(-12px);
    }

    .popular-category-card:hover::before {
      transform: scaleX(1);
    }

    .popular-category-icon {
      width: 80px;
      height: 80px;
      border-radius: 20px;
      display: flex;
      align-items: center;
      justify-content: center;
      margin-bottom: 1.75rem;
      position: relative;
      z-index: 1;
      transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
      box-shadow: 0 8px 24px rgba(0, 0, 0, 0.3);
      color: white;
      font-size: 2rem;
    }
    
    .popular-category-icon img {
      filter: brightness(0) invert(1);
    }
    
    .category-icon-placeholder {
      color: white !important;
    }

    .popular-category-card:hover .popular-category-icon {
      transform: scale(1.1) rotate(5deg);
      box-shadow: 0 12px 32px rgba(0, 0, 0, 0.5);
    }

    .popular-category-icon img {
      width: 50px;
      height: 50px;
      object-fit: contain;
    }

    .category-icon-placeholder {
      font-size: 2rem;
      color: white;
    }

    .popular-category-title {
      font-size: 1.35rem;
      font-weight: 700;
      color: #111827;
      margin-bottom: 1.25rem;
      position: relative;
      z-index: 1;
      letter-spacing: -0.01em;
    }

    .popular-category-link {
      color: #1e40af;
      text-decoration: none;
      font-size: 0.95rem;
      font-weight: 600;
      display: inline-flex;
      align-items: center;
      transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
      position: relative;
      z-index: 1;
    }

    .popular-category-link:hover {
      color: #7c3aed;
      transform: translateX(5px);
    }

    .popular-category-link i {
      transition: transform 0.3s ease;
    }

    .popular-category-link:hover i {
      transform: translateX(5px);
    }

    .category-icon-modern img {
      width: 100%;
      height: 100%;
      object-fit: cover;
    }

    .freelancer-card-modern {
      background: white;
      border-radius: 24px;
      padding: 2rem;
      height: 100%;
      box-shadow: 0 4px 24px rgba(0, 0, 0, 0.06);
      transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
      border: 1.5px solid #F3F4F6;
      position: relative;
      overflow: hidden;
    }

    .freelancer-card-modern::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      height: 4px;
      background: var(--gradient-primary);
      transform: scaleX(0);
      transition: transform 0.4s ease;
    }

    .freelancer-card-modern:hover {
      transform: translateY(-12px);
      box-shadow: 0 20px 60px rgba(79, 70, 229, 0.25);
      border-color: var(--royal-blue);
    }

    .freelancer-card-modern:hover::before {
      transform: scaleX(1);
    }

    /* Slider Freelances Recommandés - Style comme Services les plus recherchés */
    .freelancers-slider-container {
      position: relative;
      padding: 0 52px;
      margin-bottom: 2rem;
    }

    .freelancers-recommended-slider {
      overflow: hidden;
      padding-bottom: 50px;
    }

    .freelancers-recommended-slider .swiper-slide {
      height: auto;
      display: flex;
    }

    .freelancer-card-link {
      text-decoration: none;
      display: block;
      cursor: pointer;
      color: inherit;
    }

    .freelancer-card-link:hover {
      text-decoration: none;
      color: inherit;
    }

    .freelancer-card-slider-modern {
      position: relative;
      width: 100%;
      height: 380px;
      border-radius: 24px;
      overflow: hidden;
      display: flex;
      flex-direction: column;
      justify-content: flex-end;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.25);
      transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
      border: 1px solid rgba(255, 255, 255, 0.1);
      cursor: pointer;
    }

    .freelancer-card-photo {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      object-fit: cover;
      object-position: center;
      z-index: 0;
    }

    .freelancer-card-photo-fallback {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: linear-gradient(180deg, #F5F3FF 0%, #EDE9FE 50%, #E9D5FF 100%);
      align-items: center;
      justify-content: center;
      z-index: 0;
    }

    .freelancer-card-photo-fallback i {
      font-size: 2rem;
      color: rgba(255, 255, 255, 0.7);
    }

    .freelancer-card-link:hover .freelancer-card-slider-modern {
      transform: translateY(-12px);
      box-shadow: 0 20px 50px rgba(0, 0, 0, 0.35);
      border-color: rgba(255, 255, 255, 0.2);
    }

    .freelancer-card-overlay {
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background: linear-gradient(to top, rgba(139, 92, 246, 0.85) 0%, rgba(196, 181, 253, 0.4) 50%, transparent 100%);
      z-index: 1;
      transition: opacity 0.3s ease;
    }

    .freelancer-card-overlay.freelancer-card-overlay-with-photo {
      background: linear-gradient(to top, rgba(0, 0, 0, 0.7) 0%, rgba(0, 0, 0, 0.2) 50%, transparent 100%);
    }

    .freelancer-card-link:hover .freelancer-card-slider-modern .freelancer-card-overlay {
      opacity: 0.95;
    }

    .freelancer-card-content {
      position: relative;
      z-index: 2;
      color: white;
      padding: 1.5rem 1.5rem 1.25rem;
    }

    .freelancer-card-content-inner { display: block; }

    .freelancer-card-name {
      font-size: 1.25rem;
      font-weight: 700;
      margin: 0 0 0.5rem 0;
      color: #fff;
      text-shadow: 0 1px 6px rgba(0,0,0,0.4);
      line-height: 1.3;
    }

    .freelancer-card-meta {
      display: flex;
      flex-wrap: wrap;
      align-items: center;
      gap: 0.75rem 1rem;
      font-size: 0.875rem;
      color: rgba(255,255,255,0.95);
    }

    .freelancer-card-meta i {
      margin-right: 0.25rem;
      opacity: 0.9;
    }

    .freelancer-card-score {
      font-weight: 600;
    }

    .freelancer-card-badge-verified {
      display: inline-flex;
      align-items: center;
      gap: 0.35rem;
      margin-top: 0.5rem;
      padding: 0.2rem 0.5rem;
      border-radius: 9999px;
      font-size: 0.7rem;
      font-weight: 600;
      background: rgba(255,255,255,0.2);
      color: #fff;
    }

    .freelancer-card-cta {
      margin-top: 0.75rem;
      font-size: 0.9rem;
      font-weight: 600;
      color: #fff;
    }

    .freelancer-card-barre {
      position: absolute;
      bottom: 0;
      left: 1.5rem;
      right: 1.5rem;
      height: 1px;
      background: rgba(255,255,255,0.35);
      z-index: 3;
    }

    .freelancers-recommended-slider .swiper-button-next,
    .freelancers-recommended-slider .swiper-button-prev {
      width: 44px;
      height: 44px;
      border-radius: 50%;
      background: rgba(255,255,255,0.85);
      color: #374151;
      box-shadow: 0 2px 8px rgba(0,0,0,0.08);
      transition: opacity 0.25s ease, transform 0.25s ease, box-shadow 0.25s ease, background 0.25s ease;
      margin-top: -22px;
      top: 50%;
    }

    .freelancers-recommended-slider .swiper-button-next:hover:not(.swiper-button-disabled),
    .freelancers-recommended-slider .swiper-button-prev:hover:not(.swiper-button-disabled) {
      background: rgba(255,255,255,0.98);
      box-shadow: 0 4px 12px rgba(0,0,0,0.12);
      transform: scale(1.05);
    }

    .freelancers-recommended-slider .swiper-button-disabled {
      opacity: 0.4;
      cursor: not-allowed;
      pointer-events: none;
    }

    .freelancers-recommended-slider .swiper-button-next {
      right: 8px;
    }

    .freelancers-recommended-slider .swiper-button-prev {
      left: 8px;
    }

    .freelancers-recommended-slider .swiper-button-next::after,
    .freelancers-recommended-slider .swiper-button-prev::after {
      font-size: 14px;
      font-weight: bold;
    }

    .freelancers-recommended-slider .swiper-pagination {
      position: relative;
      margin-top: 2rem;
    }

    .freelancers-recommended-slider .swiper-pagination-bullet {
      background: #1e40af;
      opacity: 0.3;
      width: 12px;
      height: 12px;
      transition: all 0.3s ease;
    }

    .freelancers-recommended-slider .swiper-pagination-bullet-active {
      opacity: 1;
      background: linear-gradient(135deg, #1e40af 0%, #4c1d95 50%, #7c3aed 100%);
      width: 24px;
      border-radius: 6px;
    }

    .freelancer-avatar-modern {
      width: 60px;
      height: 60px;
      border-radius: 50%;
      background: var(--gradient-primary);
      display: flex;
      align-items: center;
      justify-content: center;
      color: white;
      font-weight: 700;
      font-size: 1.5rem;
    }

    .btn-primary-modern {
      background: linear-gradient(135deg, #1e40af 0%, #4c1d95 50%, #7c3aed 100%);
      border: none;
      color: white;
      padding: 12px 30px;
      border-radius: 50px;
      font-weight: 600;
      transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
      box-shadow: 0 4px 15px rgba(30, 64, 175, 0.3);
    }

    .btn-primary-modern:hover {
      transform: translateY(-2px);
      box-shadow: 0 8px 25px rgba(30, 64, 175, 0.5);
      background: linear-gradient(135deg, #2563eb 0%, #5b21b6 50%, #8b5cf6 100%);
      color: white;
    }

    /* Container pour les boutons freelances */
    .freelances-actions {
      display: flex;
      justify-content: center;
      align-items: center;
      gap: 1.5rem;
      flex-wrap: wrap;
    }

    /* Bouton outline pour "Devenir freelance" */
    .btn-outline-modern {
      background: white;
      border: 2px solid #7C3AED;
      color: #7C3AED;
      padding: 12px 30px;
      border-radius: 50px;
      font-weight: 600;
      transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
      box-shadow: 0 2px 8px rgba(124, 58, 237, 0.15);
      text-decoration: none;
      display: inline-flex;
      align-items: center;
    }

    .btn-outline-modern:hover {
      transform: translateY(-2px);
      box-shadow: 0 4px 15px rgba(124, 58, 237, 0.3);
      background: #7C3AED;
      color: white;
      border-color: #7C3AED;
    }

    .btn-outline-modern i {
      transition: transform 0.3s ease;
    }

    .btn-outline-modern:hover i {
      transform: translateX(3px);
    }

    /* Responsive : empiler les boutons sur mobile */
    @media (max-width: 768px) {
      .freelances-actions {
        flex-direction: column;
        gap: 1rem;
      }

      .freelances-actions .btn {
        width: 100%;
        max-width: 100%;
        justify-content: center;
      }
    }

    /* Blog Section Premium avec Slider Horizontal */
    .blog-section-premium {
      background: #FAFAF9;
      padding: 80px 0;
      position: relative;
    }

    .blog-header-premium {
      display: flex;
      justify-content: space-between;
      align-items: flex-start;
      margin-bottom: 48px;
      gap: 32px;
    }

    .blog-header-content {
      flex: 1;
      max-width: 600px;
    }

    .blog-title-premium {
      font-size: 2.5rem;
      font-weight: 700;
      color: #111827;
      margin-bottom: 16px;
      line-height: 1.2;
    }

    .blog-subtitle-premium {
      font-size: 1.125rem;
      color: #6B7280;
      line-height: 1.6;
      margin: 0;
    }

    .blog-header-actions {
      display: flex;
      gap: 16px;
      align-items: center;
      flex-shrink: 0;
    }

    .btn-blog-primary {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      padding: 14px 32px;
      font-size: 1rem;
      font-weight: 600;
      color: white;
      background: linear-gradient(135deg, #EC4899 0%, #8B5CF6 50%, #3B82F6 100%);
      border-radius: 50px;
      text-decoration: none;
      box-shadow: 0 4px 12px rgba(236, 72, 153, 0.25);
      transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
      border: none;
      cursor: pointer;
    }

    .btn-blog-primary:hover {
      transform: translateY(-2px);
      box-shadow: 0 6px 20px rgba(236, 72, 153, 0.35);
      color: white;
      text-decoration: none;
    }

    .btn-blog-secondary {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      padding: 14px 32px;
      font-size: 1rem;
      font-weight: 600;
      color: #6B7280;
      background: white;
      border: 2px solid #E5E7EB;
      border-radius: 50px;
      text-decoration: none;
      transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .btn-blog-secondary:hover {
      border-color: #EC4899;
      color: #EC4899;
      text-decoration: none;
    }

    .blog-slider-wrapper {
      position: relative;
      margin: 0 -16px;
      padding: 0 16px;
    }

    .blog-slider-container {
      overflow: hidden;
      position: relative;
    }

    .blog-slider-track {
      display: flex;
      gap: 24px;
      transition: transform 0.5s cubic-bezier(0.4, 0, 0.2, 1);
      scroll-behavior: smooth;
      scroll-snap-type: x mandatory;
      overflow-x: auto;
      scrollbar-width: none;
      -ms-overflow-style: none;
      padding-bottom: 8px;
    }

    .blog-slider-track::-webkit-scrollbar {
      display: none;
    }

    .blog-card-premium {
      flex: 0 0 calc(33.333% - 16px);
      min-width: calc(33.333% - 16px);
      scroll-snap-align: start;
      background: white;
      border-radius: 20px;
      overflow: hidden;
      box-shadow: 0 2px 12px rgba(0, 0, 0, 0.08);
      transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
      border: 1px solid #F3F4F6;
      display: flex;
      flex-direction: column;
    }

    .blog-card-premium:hover {
      transform: translateY(-8px);
      box-shadow: 0 12px 32px rgba(0, 0, 0, 0.08);
    }

    .blog-card-link-premium {
      text-decoration: none;
      color: inherit;
      display: flex;
      flex-direction: column;
      height: 100%;
    }

    .blog-image-wrapper-premium {
      position: relative;
      width: 100%;
      height: 240px;
      overflow: hidden;
      background: linear-gradient(135deg, #F5F3FF 0%, #EDE9FE 50%, #E9D5FF 100%);
    }

    .blog-image-premium {
      width: 100%;
      height: 100%;
      object-fit: cover;
      transition: transform 0.5s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .blog-card-premium:hover .blog-image-premium {
      transform: scale(1.08);
    }

    .blog-image-placeholder-premium {
      width: 100%;
      height: 100%;
      display: flex;
      align-items: center;
      justify-content: center;
      background: linear-gradient(135deg, #EC4899 0%, #8B5CF6 50%, #3B82F6 100%);
      color: white;
      font-size: 3rem;
    }

    .blog-category-badge {
      position: absolute;
      top: 16px;
      left: 16px;
      padding: 6px 12px;
      background: rgba(255, 255, 255, 0.95);
      backdrop-filter: blur(10px);
      border-radius: 20px;
      font-size: 0.75rem;
      font-weight: 600;
      color: #6B7280;
      text-transform: uppercase;
      letter-spacing: 0.5px;
    }

    .blog-card-content-premium {
      padding: 24px;
      flex: 1;
      display: flex;
      flex-direction: column;
    }

    .blog-card-title-premium {
      font-size: 1.25rem;
      font-weight: 700;
      color: #111827;
      margin-bottom: 12px;
      line-height: 1.4;
      display: -webkit-box;
      -webkit-line-clamp: 2;
      line-clamp: 2;
      -webkit-box-orient: vertical;
      overflow: hidden;
    }

    .blog-card-excerpt-premium {
      font-size: 0.9375rem;
      color: #6B7280;
      line-height: 1.6;
      margin-bottom: 16px;
      flex: 1;
      display: -webkit-box;
      -webkit-line-clamp: 3;
      line-clamp: 3;
      -webkit-box-orient: vertical;
      overflow: hidden;
    }

    .blog-card-meta-premium {
      display: flex;
      align-items: center;
      gap: 12px;
      margin-top: auto;
    }

    .blog-reading-time {
      display: flex;
      align-items: center;
      gap: 6px;
      font-size: 0.875rem;
      color: #9CA3AF;
      font-weight: 500;
    }

    .blog-reading-time i {
      font-size: 0.75rem;
    }

    .blog-slider-nav {
      position: absolute;
      top: 50%;
      transform: translateY(-50%);
      width: 48px;
      height: 48px;
      background: white;
      border: 2px solid #E5E7EB;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      cursor: pointer;
      transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
      z-index: 10;
      opacity: 0;
      pointer-events: none;
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    }

    .blog-slider-wrapper:hover .blog-slider-nav {
      opacity: 1;
      pointer-events: all;
    }

    .blog-slider-nav:hover {
      background: linear-gradient(135deg, #EC4899 0%, #8B5CF6 50%, #3B82F6 100%);
      border-color: transparent;
      color: white;
      box-shadow: 0 4px 12px rgba(236, 72, 153, 0.3);
    }

    .blog-slider-prev {
      left: -24px;
    }

    .blog-slider-next {
      right: -24px;
    }

    .blog-slider-nav i {
      font-size: 1rem;
      color: #6B7280;
      transition: color 0.3s ease;
    }

    .blog-slider-nav:hover i {
      color: white;
    }

    .blog-empty-state {
      text-align: center;
      padding: 60px 20px;
    }

    .blog-empty-text {
      font-size: 1.125rem;
      color: #6B7280;
      margin-bottom: 24px;
    }

    /* Responsive */
    @media (max-width: 1024px) {
      .blog-card-premium {
        flex: 0 0 calc(50% - 12px);
        min-width: calc(50% - 12px);
      }
    }

    @media (max-width: 768px) {
      .blog-section-premium {
        padding: 60px 0;
      }

      .blog-header-premium {
        flex-direction: column;
        gap: 24px;
      }

      .blog-title-premium {
        font-size: 2rem;
      }

      .blog-header-actions {
        width: 100%;
        flex-direction: column;
      }

      .btn-blog-primary,
      .btn-blog-secondary {
        width: 100%;
      }

      .blog-card-premium {
        flex: 0 0 calc(85% - 12px);
        min-width: calc(85% - 12px);
      }

      .blog-slider-nav {
        display: none;
      }
    }

    /* Services en Vedette - Cartes Modernes */
    .featured-service-card {
      background: white;
      border-radius: 24px;
      overflow: hidden;
      box-shadow: 0 4px 24px rgba(0, 0, 0, 0.06);
      transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
      border: 1.5px solid #F3F4F6;
      position: relative;
      height: 100%;
    }
    
    .featured-service-card::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      height: 4px;
      background: linear-gradient(135deg, #1e40af 0%, #4c1d95 50%, #7c3aed 100%);
      transform: scaleX(0);
      transition: transform 0.4s ease;
      z-index: 2;
    }
    
    .featured-service-card:hover {
      transform: translateY(-12px);
      box-shadow: 0 20px 60px rgba(30, 64, 175, 0.25);
      border-color: #1e40af;
    }
    
    .featured-service-card:hover::before {
      transform: scaleX(1);
    }
    
    .featured-service-link {
      text-decoration: none;
      color: inherit;
      display: block;
      height: 100%;
    }
    
    .featured-service-image-wrapper {
      position: relative;
      width: 100%;
      height: 200px;
      overflow: hidden;
      background: linear-gradient(135deg, #f3f4f6 0%, #e5e7eb 100%);
    }
    
    .featured-service-image {
      width: 100%;
      height: 100%;
      object-fit: cover;
      transition: transform 0.5s cubic-bezier(0.4, 0, 0.2, 1);
    }
    
    .featured-service-card:hover .featured-service-image {
      transform: scale(1.1);
    }
    
    .featured-service-image-placeholder {
      width: 100%;
      height: 100%;
      display: flex;
      align-items: center;
      justify-content: center;
      background: linear-gradient(135deg, #1e40af 0%, #4c1d95 50%, #7c3aed 100%);
      color: white;
      font-size: 3rem;
    }
    
    .featured-service-overlay {
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background: linear-gradient(to bottom, transparent 0%, rgba(0, 0, 0, 0.1) 50%, rgba(0, 0, 0, 0.3) 100%);
      display: flex;
      align-items: flex-start;
      justify-content: flex-end;
      padding: 12px;
      opacity: 0;
      transition: opacity 0.3s ease;
    }
    
    .featured-service-card:hover .featured-service-overlay {
      opacity: 1;
    }
    
    .featured-service-badge {
      background: linear-gradient(135deg, #1e40af 0%, #4c1d95 50%, #7c3aed 100%);
      color: white;
      padding: 6px 14px;
      border-radius: 50px;
      font-size: 0.75rem;
      font-weight: 600;
      text-transform: uppercase;
      letter-spacing: 0.5px;
      box-shadow: 0 4px 12px rgba(30, 64, 175, 0.4);
    }
    
    .featured-service-content {
      padding: 1.5rem;
    }
    
    .featured-service-category {
      font-size: 0.75rem;
      font-weight: 600;
      color: #7c3aed;
      text-transform: uppercase;
      letter-spacing: 0.5px;
      margin-bottom: 0.75rem;
    }
    
    .featured-service-title {
      font-size: 1.15rem;
      font-weight: 700;
      color: #111827;
      margin-bottom: 1rem;
      line-height: 1.4;
      min-height: 3.2em;
      display: -webkit-box;
      -webkit-line-clamp: 2;
      line-clamp: 2;
      -webkit-box-orient: vertical;
      overflow: hidden;
    }
    
    .featured-service-meta {
      display: flex;
      justify-content: space-between;
      align-items: center;
      flex-wrap: wrap;
      gap: 0.5rem;
    }
    
    .featured-service-rating {
      display: flex;
      align-items: center;
      gap: 4px;
      color: #f59e0b;
      font-weight: 600;
      font-size: 0.9rem;
    }
    
    .featured-service-rating i {
      font-size: 0.85rem;
    }
    
    .featured-service-reviews {
      color: #6B7280;
      font-weight: 400;
      font-size: 0.85rem;
    }
    
    .featured-service-price {
      font-size: 0.95rem;
      font-weight: 600;
      color: #1e40af;
      background: linear-gradient(135deg, rgba(30, 64, 175, 0.1) 0%, rgba(124, 58, 237, 0.1) 100%);
      padding: 6px 12px;
      border-radius: 8px;
    }

    .cta-section-modern {
      background: linear-gradient(135deg, #1e40af 0%, #4c1d95 50%, #7c3aed 100%);
      border-radius: 32px;
      padding: 100px 60px;
      position: relative;
      overflow: hidden;
      box-shadow: 0 20px 60px rgba(30, 64, 175, 0.4);
    }
    
    .cta-section-modern h2 {
      color: #ffffff !important;
      text-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
    }
    
    .cta-section-modern .btn-light {
      background: rgba(255, 255, 255, 0.95) !important;
      color: #1e40af !important;
      font-weight: 600;
      border: none;
      box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
      transition: all 0.3s ease;
    }
    
    .cta-section-modern .btn-light:hover {
      background: #ffffff !important;
      transform: translateY(-2px);
      box-shadow: 0 8px 25px rgba(0, 0, 0, 0.3);
    }

    .cta-section-modern::before {
      content: '';
      position: absolute;
      top: -50%;
      right: -10%;
      width: 400px;
      height: 400px;
      background: rgba(255, 255, 255, 0.1);
      border-radius: 50%;
    }

    .cta-section-modern::after {
      content: '';
      position: absolute;
      bottom: -30%;
      left: -5%;
      width: 300px;
      height: 300px;
      background: rgba(255, 255, 255, 0.1);
      border-radius: 50%;
    }

    .cta-content-modern {
      position: relative;
      z-index: 1;
    }

    @media (max-width: 768px) {
      .hero-modern {
        min-height: auto;
        padding: 80px 0 60px;
      }

      .hero-modern .container {
        padding: 0;
      }

      .hero-content-left {
        padding-right: 0;
        margin-bottom: 3rem;
      }

      .hero-title {
        font-size: 2.5rem; /* Légèrement plus grand sur mobile */
        line-height: 1.2;
        margin-bottom: 1.5rem;
        max-width: 100%;
        width: 100%;
      }

      .hero-title-line-1,
      .hero-title-line-2 {
        white-space: normal; /* Permettre le retour à la ligne sur mobile */
      }

      .search-box-modern {
        max-width: 100%; /* Pleine largeur sur mobile */
        height: 60px;
      }

      .search-box-modern input {
        height: 52px;
        padding: 0 20px;
        font-size: 0.95rem;
      }

      .search-box-modern .btn-search {
        width: 52px;
        height: 52px;
      }

      .hero-subtitle {
        font-size: 1rem;
        margin-bottom: 2rem;
      }

      .search-box-modern {
        max-width: 100%;
        height: 54px;
      }

      .search-box-modern input {
        height: 46px;
        padding: 0 18px;
        font-size: 0.9rem;
      }

      .search-box-modern .btn-search {
        width: 46px;
        height: 46px;
      }

      .hero-search-tags {
        font-size: 0.85rem;
        gap: 0.75rem;
      }

      .hero-photo-column {
        padding-left: 0 !important; /* Réinitialiser sur mobile */
      }
      
      .hero-freelancer-card {
        max-width: 100%;
        margin-top: 2rem;
        margin-left: 0; /* Réinitialiser sur mobile */
      }

      .hero-freelancer-photo {
        height: 55%;
      }

      .section-subtitle-modern {
        font-size: 1.05rem;
      }
      
      .featured-service-card {
        margin-bottom: 1.5rem;
      }
      
      .featured-service-image-wrapper {
        height: 180px;
      }
      
      .featured-service-title {
        font-size: 1rem;
        min-height: 2.8em;
      }
      
      .featured-service-content {
        padding: 1.25rem;
      }
      
      .blog-card-body {
        padding: 1.5rem;
      }
      
      .blog-image-container {
        height: 200px;
      }
      
      .blog-title {
        font-size: 1.15rem;
        min-height: 3.2em;
      }
      
      .blog-excerpt {
        font-size: 0.9rem;
      }
    }

    /* Correction pour les images lazyload */
    img.lazyload {
      opacity: 0;
      transition: opacity 0.3s;
    }

    img.lazyloaded {
      opacity: 1;
    }

    /* Fallback pour les images manquantes */
    .category-icon-modern img,
    .blog-image-modern {
      background: #f0f0f0;
    }

    /* En-tête fond blanc, textes noirs - aligné avec layout.blade.php */
    body .header-area,
    html body .header-area,
    body .header-area.header_v1,
    html body .header-area.header_v1,
    body .header-area.header_v1:not(.is-sticky),
    html body .header-area.header_v1:not(.is-sticky) {
      background: #FFFFFF !important;
      background-color: #FFFFFF !important;
      background-image: none !important;
      position: relative;
      z-index: 1000 !important;
      box-shadow: 0 1px 3px rgba(0, 0, 0, 0.08) !important;
    }

    /* Main navbar fond blanc */
    body .header-area .main-navbar,
    html body .header-area .main-navbar,
    body .header-area .main-responsive-nav,
    html body .header-area .main-responsive-nav,
    body .header-area .main-navbar .navbar,
    html body .header-area .main-navbar .navbar,
    body .header-area .main-navbar .container-fluid,
    html body .header-area .main-navbar .container-fluid {
      background: #FFFFFF !important;
      background-color: #FFFFFF !important;
      background-image: none !important;
    }

    /* Liens de navigation - texte noir */
    body .header-area .nav-link,
    html body .header-area .nav-link,
    body .header-area .main-navbar .nav-link,
    html body .header-area .main-navbar .nav-link,
    body .header-area .navbar-nav .nav-link,
    html body .header-area .navbar-nav .nav-link {
      color: #111827 !important;
      -webkit-text-fill-color: #111827 !important;
    }

    body .header-area .nav-link:hover,
    body .header-area .nav-link.active,
    html body .header-area .nav-link:hover,
    html body .header-area .nav-link.active {
      color: #4F46E5 !important;
      -webkit-text-fill-color: #4F46E5 !important;
    }

    /* Logo JUNSPRO - style global dans layout.blade.php (noir sur fond blanc) */

    .main-navbar {
      position: relative;
      z-index: 1001 !important;
    }

    /* Correction de la superposition : barre de catégories et hero */
    .header-area .categories-menu {
      position: relative !important;
      z-index: 998 !important;
      background: #ffffff !important;
      border-top: 1px solid #E5E7EB !important;
      border-bottom: 1px solid #E5E7EB !important;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05) !important;
    }

    /* Fond blanc pour TOUS les éléments de la barre de catégories */
    .header-area .categories-menu .categories-menu-nav,
    .header-area .categories-menu .container-fluid,
    .header-area .categories-menu nav,
    .header-area .categories-menu ul.categories {
      background: #ffffff !important;
    }

    /* Texte des catégories en gris foncé sur fond blanc */
    .header-area .categories-menu .categories .sub-menu-item > a {
      color: #6B7280 !important;
    }

    .header-area .categories-menu .categories .sub-menu-item > a:hover,
    .header-area .categories-menu .categories .sub-menu-item > a.active {
      color: #4F46E5 !important;
    }

    /* Séparateurs verticaux visibles sur fond blanc */
    .header-area .categories-menu .categories .sub-menu-item:not(:last-child)::before {
      background-color: #E5E7EB !important;
    }

    /* Remplacer le vert par les couleurs Junspro (bleu/violet) */
    .header-area .more-option .btn-primary {
      background: linear-gradient(135deg, #4F46E5 0%, #7C3AED 100%) !important;
      border: none !important;
      color: #ffffff !important;
    }

    .header-area .more-option .btn-primary:hover,
    .header-area .more-option .btn-primary:focus,
    .header-area .more-option .btn-primary.show {
      background: linear-gradient(135deg, #4338CA 0%, #6D28D9 100%) !important;
      color: #ffffff !important;
      box-shadow: 0 4px 12px rgba(79, 70, 229, 0.4) !important;
    }

    /* Espacement supplémentaire pour éviter la superposition */
    .hero-modern .container {
      position: relative;
      z-index: 1;
    }

    /* S'assurer que le hero ne se cache pas derrière le header */
    @media (min-width: 992px) {
      .hero-modern {
        margin-top: 0 !important;
        padding-top: 80px;
      }
    }


    @media (max-width: 768px) {
      .categories-nav-wrapper {
        justify-content: flex-start;
        padding: 0 10px;
      }

      .category-nav-link {
        font-size: 0.85rem;
        padding: 6px 12px;
      }

      .category-nav-separator {
        margin: 0 2px;
      }
    }


    @media (max-width: 991px) {
      .hero-modern {
        margin-top: 140px !important;
        padding: 40px 0 60px;
        min-height: auto;
      }

      .hero-freelancers-slider-large {
        height: 400px;
        margin-top: 3rem;
      }

      .freelancer-large-photo-container {
        height: 450px;
      }

      .freelancer-large-photo-wrapper {
        height: 65%;
      }

      .freelancer-large-info-capsule {
        bottom: 1rem;
        left: 1rem;
        right: 1rem;
        padding: 1rem 1.25rem;
      }

      .freelancer-large-name {
        font-size: 1.25rem;
      }

      .freelancer-large-job {
        font-size: 0.85rem;
      }

      .freelancer-large-rating-badge {
        font-size: 0.8rem;
        padding: 0.4rem 0.6rem;
        min-width: 45px;
      }

      .hero-title {
        font-size: 2.25rem;
      }

      .hero-subtitle {
        font-size: 1.1rem;
      }
    }
  </style>
@endsection


@section('content')
  @php
    // Chercher l'image cover-hero dans différents emplacements (même code que sur /)
    $soieImagePath = null;
    $imageLocations = [
      'images',
      'assets/img'
    ];
    
    // Chercher dans chaque emplacement
    foreach ($imageLocations as $locationDir) {
      $locationPath = public_path($locationDir);
      
      // Si le dossier existe, chercher tous les fichiers commençant par "cover-hero"
      if (is_dir($locationPath)) {
        $files = glob($locationPath . DIRECTORY_SEPARATOR . 'cover-hero*');
        if (!empty($files)) {
          // Prendre le premier fichier trouvé et nettoyer le chemin
          $foundFile = $files[0];
          // Convertir le chemin Windows en chemin relatif web
          $relativePath = str_replace([public_path(), DIRECTORY_SEPARATOR], ['', '/'], $foundFile);
          $relativePath = ltrim($relativePath, '/');
          // Encoder les espaces et caractères spéciaux dans l'URL
          $pathParts = explode('/', $relativePath);
          $fileName = array_pop($pathParts);
          $fileName = rawurlencode($fileName);
          $relativePath = implode('/', $pathParts) . '/' . $fileName;
          $soieImagePath = asset($relativePath);
          break;
        }
      }
    }
  @endphp

  <!-- Hero Section Moderne avec Slider Freelances -->
  <section class="hero-modern" @if($soieImagePath) style="background-image: url('{{ $soieImagePath }}'); background-size: cover; background-position: center; background-repeat: no-repeat;" @endif>
    <div class="container">
      <div class="row align-items-center">
        <!-- Contenu gauche -->
        <div class="col-lg-6 hero-content-left" data-aos="fade-right">
          <h1 class="hero-title mb-5">
            <span class="hero-title-line-1">{{ __('Des missions pour vos besoins.') }}</span>
            <span class="hero-title-line-2">{{ __('Des rituels pour vos résultats.') }}</span>
          </h1>
          <p class="hero-subtitle mb-5">
            Déposez une mission. Nous vous orientons vers le bon univers et les bons profils.<br>
            <a href="#nos-univers" class="hero-subtitle-link" style="color: #7c3aed; text-decoration: none; font-weight: 600; transition: color 0.3s ease;">
              Explorer nos univers →
            </a>
          </p>
          
          <!-- Segmentation et CTAs -->
          <div id="heroSegmentationContainer" style="position: relative; z-index: 10;">
            <!-- Segmentation (mini switch) -->
            <div class="hero-segmentation" data-aos="fade-up" data-aos-delay="150">
              <div class="segmentation-switch">
                <button 
                  type="button" 
                  class="segmentation-btn active" 
                  data-user-type="entreprise"
                >
                  Je suis Entreprise
              </button>
                <button 
                  type="button" 
                  class="segmentation-btn" 
                  data-user-type="particulier"
                >
                  Particulier
                </button>
              </div>
              <a href="{{ route('freelance.onboarding.start') }}" class="segmentation-link-freelance">
                Freelance
              </a>
              </div>
            
            <!-- CTAs selon le type d'utilisateur -->
            <div class="hero-ctas" data-aos="fade-up" data-aos-delay="180">
              <!-- Entreprise -->
              <div id="cta-entreprise" class="cta-group">
                <a href="{{ route('mission.form') }}" class="btn-cta-primary">
                  Déposer une mission
                </a>
                <a href="{{ route('services') }}" class="btn-cta-secondary">
                  Trouver un freelance
                </a>
                <a href="{{ route('freelance.onboarding.start') }}" class="btn-cta-link">
                  Créer mon profil freelance
                </a>
              </div>
              
              <!-- Particulier -->
              <div id="cta-particulier" class="cta-group" style="display: none;">
                <a href="{{ route('services') }}" class="btn-cta-primary">
                  Réserver un rituel
                </a>
              </div>
            </div>
          </div>
          
          <script>
            (function() {
              function changeUserType(type) {
                console.log('🔄 Changement de type:', type);
                
                // Mettre à jour les boutons de segmentation
                const buttons = document.querySelectorAll('.segmentation-btn');
                buttons.forEach(btn => {
                  if (btn.dataset.userType === type) {
                    btn.classList.add('active');
                  } else {
                    btn.classList.remove('active');
                  }
                });
                
                // Afficher/masquer les CTAs appropriés
                const ctaEntreprise = document.getElementById('cta-entreprise');
                const ctaParticulier = document.getElementById('cta-particulier');
                
                if (type === 'entreprise') {
                  if (ctaEntreprise) {
                    ctaEntreprise.style.display = 'flex';
                    console.log('✅ Affichage CTAs entreprise');
                  }
                  if (ctaParticulier) {
                    ctaParticulier.style.display = 'none';
                  }
                } else if (type === 'particulier') {
                  if (ctaEntreprise) {
                    ctaEntreprise.style.display = 'none';
                  }
                  if (ctaParticulier) {
                    ctaParticulier.style.display = 'flex';
                    console.log('✅ Affichage CTAs particulier');
                  }
                }
              }
              
              // Attendre que le DOM soit chargé
              function initSegmentation() {
                const buttons = document.querySelectorAll('.segmentation-btn');
                console.log('🔍 Boutons trouvés:', buttons.length);
                
                buttons.forEach(btn => {
                  btn.addEventListener('click', function(e) {
                    e.preventDefault();
                    const userType = this.dataset.userType;
                    console.log('👆 Clic sur:', userType);
                    changeUserType(userType);
                  });
                });
                
                // Initialiser avec "entreprise" par défaut
                changeUserType('entreprise');
              }
              
              // Exécuter quand le DOM est prêt
              if (document.readyState === 'loading') {
                document.addEventListener('DOMContentLoaded', initSegmentation);
              } else {
                // DOM déjà chargé
                initSegmentation();
              }
              
              // Exporter la fonction globalement pour le debug
              window.changeUserType = changeUserType;
            })();
          </script>
          

          <!-- Barre de Preuve intégrée dans le Hero -->
          <div class="hero-proof-bar" data-aos="fade-up" data-aos-delay="250">
            <div class="hero-proof-container">
              <div class="hero-proof-item">
                <div class="hero-proof-icon hero-proof-icon-check">
                  <i class="fas fa-check"></i>
                </div>
                <div class="hero-proof-text">
                  {{ __('Profils vérifiés') }}
                </div>
              </div>
              
              <div class="hero-proof-item">
                <div class="hero-proof-icon hero-proof-icon-camera">
                  <i class="fas fa-video"></i>
                </div>
                <div class="hero-proof-text">
                  <span style="display: block; white-space: nowrap;">{{ __('Séance d\'essai') }}</span>
                  <span style="display: block; white-space: nowrap;">{{ __('de 1h') }}</span>
                </div>
              </div>
              
              <div class="hero-proof-item">
                <div class="hero-proof-icon hero-proof-icon-card">
                  <i class="fas fa-credit-card"></i>
                </div>
                <div class="hero-proof-text">
                  <span style="display: block; white-space: nowrap;">{{ __('Réservation simple') }}</span>
                  <span style="display: block; white-space: nowrap;">{{ __('et paiement sécurisé') }}</span>
                </div>
              </div>
            </div>
          </div>

            <div class="hero-search-tags" data-aos="fade-up" data-aos-delay="300">
            Bêta privée —qualité > quantité. Vos premières missions sont traitées en priorité.
                  </div>
            </div>

        <!-- Carte Freelance unique (style ComeUp) -->
        <div class="col-lg-6 hero-photo-column" data-aos="fade-left">
          @php
            // Toujours utiliser le nom par défaut "Marie Dubois" pour le hero
            $heroFreelancerName = 'Marie Dubois';
            $heroFreelancerRole = 'Consultante Marketing Digital';
            $heroFreelancerLocation = 'France';
            // Photo professionnelle rayonnante et inspirante : femme souriante avec blazer gris et ordinateur
            $heroFreelancerImage = 'https://images.unsplash.com/photo-1494790108377-be9c29b29330?w=800&h=1000&fit=crop&crop=face';
          @endphp
          <div class="hero-freelancer-card">
            <img src="{{ $heroFreelancerImage }}" 
                 alt="{{ $heroFreelancerName }}" 
                 class="hero-freelancer-photo"
                 loading="lazy"
                 onerror="this.onerror=null; this.src='https://images.unsplash.com/photo-1494790108377-be9c29b29330?w=800&h=1000&fit=crop&crop=face';">
            <div class="hero-freelancer-info">
              <h3 class="hero-freelancer-name">{{ $heroFreelancerName }}</h3>
              <p class="hero-freelancer-role">{{ $heroFreelancerRole }}</p>
              <p class="hero-freelancer-location">{{ $heroFreelancerLocation }}</p>
          </div>
        </div>
      </div>
    </div>
    </div>
  </section>

  {{-- Hero filters (copie /services) : Univers + Spécialisation + Pays + Ville + Filtres avancés --}}
  <div class="container" style="position:relative;z-index:10;">
    <x-home.search-filter
      formId="homeHubSearchFilter"
      :formAction="route('services')"
      universe="hub"
      :hubUniverses="$hubUniverses ?? []"
      :hubUniverseDomains="$hubUniverseDomains ?? []"
      keywordPlaceholder="Essayez « Pilates », « Marketing Digital », « Anglais »..."
      locationPlaceholder="Lieu de la mission (ex: Paris, Lyon...)"
    />
  </div>

  {{-- Module Pause Souffle Inline avec bullets (juste sous filtres, avant 6 univers) --}}
  <div class="container">
    @include('frontend.components.pause-souffle.inline-with-bullets-premium')
  </div>

  <!-- Nos Rituels Section -->
  <section class="section-modern" id="nos-univers" style="scroll-margin-top: 100px;">
        <div class="container">
      <div class="row mb-5">
        <div class="col-12 text-center">
          <h2 class="section-title-modern mb-3" data-aos="fade-up">Nos Univers</h2>
                        </div>
                      </div>
      <div class="rituels-universes-grid">
        @if(isset($universes))
          @foreach($universes as $index => $universe)
            <div class="rituel-universe-item" data-index="{{ $index }}">
              <div class="rituel-universe-bubble">
                <div class="rituel-universe-content">
                  <div class="rituel-universe-header">
                    <div class="rituel-universe-emoji-wrapper">
                      <span class="rituel-universe-emoji">
                        @if($index == 0)💡
                        @elseif($index == 1)🎓
                        @elseif($index == 2)🏠
                        @elseif($index == 3)🏃
                        @elseif($index == 4)🛋️
                        @elseif($index == 5)🌍
                        @else💬
                        @endif
                      </span>
                    </div>
                    <h3 class="rituel-universe-title">{{ $universe['title'] }}</h3>
                </div>
                  <a href="{{ $universe['url'] }}" class="rituel-universe-cta">
                    Réserver un Rituel d'essai
                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path d="M6 12L10 8L6 4" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                  </a>
              </div>
            </div>
          </div>
          @endforeach
        @endif
        </div>
      </div>
    </section>

  <!-- Notre Vision Section -->
  <section class="section-modern bg-light">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <div class="text-center" data-aos="fade-up" style="max-width: 900px; margin: 0 auto; padding: 0 20px;">
            <h2 class="section-title-modern mb-5">{{ __('Notre Vision') }}</h2>
            
            <div style="text-align: left; font-size: 1.1rem; line-height: 1.9; color: #1a202c; margin-bottom: 2rem;">
              <p style="margin-bottom: 1.5rem;">
                <strong>FreelancesX by Junspro</strong> est né d'une conviction : ce qui fait avancer un projet, ce n'est pas la pression — c'est la discipline.<br>
                Une discipline douce, progressive, qui respecte l'humain… mais qui ne laisse pas la procrastination s'installer.
              </p>
              
              <p style="margin-bottom: 1.5rem;">
                Ici, tout repose sur un langage commun, clair et simple :
              </p>
              
              <p style="margin-bottom: 1.5rem; padding-left: 1.5rem; border-left: 3px solid #7c3aed;">
                <strong>Un Rituel, c'est 1h = 50 minutes de focus + 10 minutes de feedback / rapport.</strong><br>
                Ce n'est pas "du temps vendu". C'est une méthode : un cadre qui transforme l'élan en résultats.
                <button id="visionToggleBtn" onclick="toggleVisionContent()" style="background: none; border: none; color: #7c3aed; font-weight: 600; cursor: pointer; text-decoration: underline; margin-left: 0.5rem; font-size: 1.1rem;">Voir plus</button>
              </p>
              
              <div id="visionMoreContent" style="display: none; margin-bottom: 1.5rem; animation: fadeIn 0.3s ease-in;">
                <p style="margin-bottom: 1.5rem;">
                  Les abonnements sont pensés pour la vraie vie :<br>
                  vous pouvez ajouter des heures, mettre en pause, arrêter quand vous voulez, et même transférer vos heures ou votre abonnement à un autre freelance si vous sentez qu'un autre accompagnement vous correspond mieux.
                </p>
                
                <p style="margin-bottom: 1.5rem;">
                  Côté freelances, FreelancesX n'impose pas une perfection.<br>
                  Il installe une progression : des Rituels qui deviennent des habitudes, puis une discipline.<br>
                  Et si cette discipline n'est pas encore là, le système reste juste : il n'y a pas de punition artificielle — seulement une pédagogie du réel.<br>
                  Parfois on tombe, et c'est ainsi qu'on se relève mieux. On grandit en humilité, en expérience, en sagesse — et la discipline devient une force paisible.
                </p>
                
                <p style="margin-bottom: 1.5rem;">
                  Ce cadre peut sembler exigeant. En réalité, c'est une protection :<br>
                  pour le client, qui veut du concret ;<br>
                  pour le freelance, qui veut une trajectoire stable ;<br>
                  et pour l'humain, qui veut une vie plus équilibrée, physiquement et psychologiquement.
                </p>
                
                <p style="margin-bottom: 2.5rem; font-size: 1.15rem; font-weight: 500;">
                  <strong>FreelancesX by Junspro</strong>, c'est ça : un espace où l'on avance avec calme, mais avec rigueur.<br>
                  Un endroit où la discipline devient un cadeau — pour vos projets, et pour votre vie.
                </p>
                
                <div style="text-align: center; margin-top: 3rem;">
                  <p style="font-size: 1.2rem; font-weight: 500; color: #1a202c; margin-bottom: 1.5rem;">
                    Êtes-vous prêt à entrer dans l'expérience ?
                  </p>
                  <a href="{{ route('explore') }}" class="btn-vision-rituel">
                    {{ __('Réserver un Rituel d\'essai') }}
                  </a>
                        </div>
                      </div>
                    </div>
            
            <script>
              function toggleVisionContent() {
                const content = document.getElementById('visionMoreContent');
                const button = document.getElementById('visionToggleBtn');
                
                if (content.style.display === 'none') {
                  content.style.display = 'block';
                  button.textContent = 'Voir moins';
                } else {
                  content.style.display = 'none';
                  button.textContent = 'Voir plus';
                }
              }
            </script>
            
            <style>
              @keyframes fadeIn {
                from {
                  opacity: 0;
                  transform: translateY(-10px);
                }
                to {
                  opacity: 1;
                  transform: translateY(0);
                }
              }
            </style>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Comment ça marche Section -->
  <section class="section-modern">
    <div class="container">
      <div class="row mb-5">
        <div class="col-12 text-center">
          <h2 class="section-title-modern mb-3" data-aos="fade-up">Comment ça marche</h2>
        </div>
      </div>
      <div class="row g-4 align-items-center" style="flex-wrap: nowrap;">
        <!-- Étape 1 -->
        <div class="col-12 col-md-4" data-aos="fade-up" data-aos-delay="0">
          <div class="text-center">
            <div class="mb-3" style="width: 80px; height: 80px; margin: 0 auto; border-radius: 50%; background: linear-gradient(135deg, #1e40af 0%, #4c1d95 50%, #7c3aed 100%); display: flex; align-items: center; justify-content: center; color: white; font-size: 2rem; font-weight: bold;">
              1
            </div>
            <h5 class="fw-bold mb-2" style="color: #1a202c; font-size: 1.25rem;">Choisissez votre univers</h5>
            <p class="small mb-0" style="color: #4a5568; font-size: 0.95rem; line-height: 1.6;">Explorez nos 6 univers et trouvez celui qui correspond à vos besoins</p>
          </div>
        </div>
        <!-- Flèche 1 -->
        <div class="col-auto d-none d-md-flex align-items-center justify-content-center" data-aos="fade-up" data-aos-delay="100">
          <i class="fas fa-arrow-right" style="font-size: 2rem; color: #7c3aed;"></i>
        </div>
        <!-- Étape 2 -->
        <div class="col-12 col-md-4" data-aos="fade-up" data-aos-delay="200">
          <div class="text-center">
            <div class="mb-3" style="width: 80px; height: 80px; margin: 0 auto; border-radius: 50%; background: linear-gradient(135deg, #1e40af 0%, #4c1d95 50%, #7c3aed 100%); display: flex; align-items: center; justify-content: center; color: white; font-size: 2rem; font-weight: bold;">
              2
            </div>
            <h5 class="fw-bold mb-2" style="color: #1a202c; font-size: 1.25rem;">Réservez en quelques clics</h5>
            <p class="small mb-0" style="color: #4a5568; font-size: 0.95rem; line-height: 1.6;">Sélectionnez votre service, choisissez un créneau et validez</p>
          </div>
        </div>
        <!-- Flèche 2 -->
        <div class="col-auto d-none d-md-flex align-items-center justify-content-center" data-aos="fade-up" data-aos-delay="300">
          <i class="fas fa-arrow-right" style="font-size: 2rem; color: #7c3aed;"></i>
        </div>
        <!-- Étape 3 -->
        <div class="col-12 col-md-4" data-aos="fade-up" data-aos-delay="400">
          <div class="text-center">
            <div class="mb-3" style="width: 80px; height: 80px; margin: 0 auto; border-radius: 50%; background: linear-gradient(135deg, #1e40af 0%, #4c1d95 50%, #7c3aed 100%); display: flex; align-items: center; justify-content: center; color: white; font-size: 2rem; font-weight: bold;">
              3
            </div>
            <h5 class="fw-bold mb-2" style="color: #1a202c; font-size: 1.25rem;">Profitez de l'expérience</h5>
            <p class="small mb-0" style="color: #4a5568; font-size: 0.95rem; line-height: 1.6;">Suivez votre progression et bénéficiez d'un accompagnement personnalisé</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Univers Populaires Section -->
  @if (isset($popularRituals) && count($popularRituals) > 0)
    <section class="section-modern">
      <div class="container">
        <div class="row mb-5">
          <div class="col-12 text-center">
            <h2 class="section-title-modern" data-aos="fade-up">{{ __('Nos Rituels en Vedette') }}</h2>
            <p class="section-subtitle-modern" data-aos="fade-up" data-aos-delay="100">
              {{ __('Découvrez nos domaines de Rituels les plus demandés') }}
            </p>
                  </div>
                </div>
        <div class="row g-4">
          @foreach ($popularRituals as $index => $ritual)
            <div class="col-lg-3 col-md-4 col-sm-6" data-aos="fade-up" data-aos-delay="{{ $loop->index * 50 }}">
              <div class="popular-category-card" data-universe-index="{{ $ritual['universeIndex'] }}">
                <div class="popular-category-icon" style="background: {{ $ritual['colorGradient'] }};">
                  @php
                    $iconMap = [
                      'megaphone' => 'fa-bullhorn',
                      'code' => 'fa-code',
                      'video' => 'fa-video',
                      'users' => 'fa-users',
                      'book' => 'fa-book',
                      'calculator' => 'fa-calculator',
                      'dumbbell' => 'fa-dumbbell',
                      'fire' => 'fa-fire',
                      'broom' => 'fa-broom',
                      'baby' => 'fa-child',
                      'moon' => 'fa-moon',
                      'apple-alt' => 'fa-apple-alt',
                      'home' => 'fa-home',
                      'wind' => 'fa-wind',
                      'brain' => 'fa-brain'
                    ];
                    $iconClass = $iconMap[$ritual['icon']] ?? 'fa-folder';
                  @endphp
                  <i class="fas {{ $iconClass }}"></i>
                </div>
                <h5 class="popular-category-title">{{ $ritual['name'] }}</h5>
                <a href="{{ $ritual['url'] }}" class="popular-category-link">
                  {{ __('Réserver un Rituel d\'essai') }} <i class="fas fa-arrow-right ms-1"></i>
                </a>
          </div>
                                  </div>
          @endforeach
                                    </div>
                                  </div>
    </section>
                                @endif

  <!-- Freelancers Highlight Section Moderne -->
  @if (isset($highlightedFreelancers) && $highlightedFreelancers->count() > 0)
    <section class="section-modern bg-light">
      <div class="container">
        <div class="row mb-5">
          <div class="col-12 text-center">
            <h2 class="section-title-modern" data-aos="fade-up">{{ __('Freelances du mois') }}</h2>
            <p class="section-subtitle-modern" data-aos="fade-up" data-aos-delay="100">
              {{ __('Découvrez nos meilleurs freelances experts, vérifiés et notés par la communauté') }}
            </p>
                      </div>
                    </div>
        <!-- Slider Freelances -->
        <div class="freelancers-slider-container">
          <div class="swiper freelancers-recommended-slider">
            <div class="swiper-wrapper">
              @php
                $femaleUsed = 0;
                $maleUsed = 0;
                $femaleFirstNames = ['emma','camille','sophie','lea','léa','marie','julie','chloe','chloé','manon','pauline','laura','jade','sarah','alice','ines','lucie','marion','oceane','clemence','julia','charlotte','jesula','jessica','valerie','nathalie','isabelle','melanie','olivia','audrey','cecile','delphine','elodie','fanny','helene','karine'];
                $femaleExampleUrls = [
                  'https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?w=400&fit=crop',
                  'https://images.unsplash.com/photo-1580489944761-15a19d654956?w=400&fit=crop',
                  'https://images.unsplash.com/photo-1594744803329-e58b31de8bf5?w=400&fit=crop',
                  'https://images.unsplash.com/photo-1438761681033-6461ffad8d80?w=400&fit=crop',
                  'https://images.unsplash.com/photo-1544005313-94ddf0286df2?w=400&fit=crop',
                  'https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=400&fit=crop',
                  'https://images.unsplash.com/photo-1573497019940-1c28c88b4f3e?w=400&fit=crop',
                  'https://images.unsplash.com/photo-1607746882042-944635dfe10e?w=400&fit=crop',
                  'https://images.unsplash.com/photo-1598550874175-4d0ef436c909?w=400&fit=crop',
                ];
                $maleExampleUrls = [
                  'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=400&fit=crop',
                  'https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?w=400&fit=crop',
                  'https://images.unsplash.com/photo-1500648767791-00dcc994a43e?w=400&fit=crop',
                  'https://images.unsplash.com/photo-1519085360753-af0119f7cbe7?w=400&fit=crop',
                  'https://images.unsplash.com/photo-1506794778202-cad84cf45f1d?w=400&fit=crop',
                  'https://images.unsplash.com/photo-1519345182560-3f2917c472ef?w=400&fit=crop',
                  'https://images.unsplash.com/photo-1560250097-0b93528c311a?w=400&fit=crop',
                  'https://images.unsplash.com/photo-1507591064344-4c6ce005b128?w=400&fit=crop',
                  'https://images.unsplash.com/photo-1539571696357-5a69c17a67c6?w=400&fit=crop',
                ];
              @endphp
              @foreach ($highlightedFreelancers as $freelancer)
                @php
                  $user = $freelancer->user;
                  $name = trim($user->name ?? '');
                  if (empty($name) || strtolower($name) === 'freelance') {
                    $firstName = trim($user->first_name ?? '');
                    $lastName = trim($user->last_name ?? '');
                    if (!empty($firstName) || !empty($lastName)) {
                      $name = trim($firstName . ' ' . $lastName);
                    }
                  }
                  $nameParts = array_values(array_filter(explode(' ', $name), function($p) {
                    return strlen(trim($p)) > 0 && strtolower(trim($p)) !== 'freelance';
                  }));
                  $displayName = (count($nameParts) >= 2)
                    ? ($nameParts[0] . ' ' . substr($nameParts[1], 0, 1) . '.')
                    : (!empty($nameParts) ? $nameParts[0] : ($user->username ?? 'Freelance'));
                  $photoUrl = !empty($user->image) ? asset('assets/img/users/' . $user->image) : null;
                  if (empty($photoUrl)) {
                    $firstName = $nameParts[0] ?? '';
                    $isFemale = in_array(mb_strtolower(trim($firstName)), $femaleFirstNames);
                    $urls = $isFemale ? $femaleExampleUrls : $maleExampleUrls;
                    $idx = $isFemale ? $femaleUsed++ : $maleUsed++;
                    $photoUrl = $urls[$idx % count($urls)];
                  }
                  $freelancerUrl = route('freelance.show', ['id' => $freelancer->id]);
                @endphp
                <div class="swiper-slide">
                  <a href="{{ $freelancerUrl }}" class="freelancer-card-link" style="text-decoration: none; display: block;">
                    <div class="freelancer-card-slider-modern">
                      @if($photoUrl)
                        <img src="{{ $photoUrl }}" alt="" class="freelancer-card-photo" loading="lazy"
                             onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                      @endif
                      <div class="freelancer-card-photo-fallback" style="display: {{ $photoUrl ? 'none' : 'flex' }};">
                        <i class="fas fa-image"></i>
                      </div>
                      <div class="freelancer-card-overlay {{ $photoUrl ? 'freelancer-card-overlay-with-photo' : '' }}"></div>
                      <div class="freelancer-card-content">
                        <div class="freelancer-card-content-inner">
                          <h5 class="freelancer-card-name">{{ $displayName }}</h5>
                          <div class="freelancer-card-meta">
                            <span><i class="fas fa-map-marker-alt"></i> {{ $user->country_code ?? '—' }}</span>
                            <span><strong>{{ number_format($freelancer->hourly_rate ?? 0, 0, ',', ' ') }} €/h</strong></span>
                            @if($freelancer->reliability_score)
                              <span class="freelancer-card-score">{{ $freelancer->reliability_score }}/100</span>
                            @endif
                          </div>
                          @if($user->is_verified_freelancer ?? $freelancer->is_verified ?? false)
                            <span class="freelancer-card-badge-verified"><i class="fas fa-check-circle"></i> Vérifié</span>
                          @endif
                          <div class="freelancer-card-cta">{{ __('Voir le profil') }}</div>
                        </div>
                        <div class="freelancer-card-barre"></div>
                      </div>
                    </div>
                  </a>
                </div>
              @endforeach
            </div>
            <!-- Navigation -->
            <div class="swiper-button-prev"></div>
            <div class="swiper-button-next"></div>
            <!-- Pagination -->
            <div class="swiper-pagination"></div>
          </div>
        </div>
        <div class="row mt-5">
          <div class="col-12">
            <div class="freelances-actions">
              <a href="{{ route('explore') }}" class="btn btn-primary-modern btn-lg">
                {{ __('Voir tous les freelances') }}
                <i class="fas fa-arrow-right ms-2"></i>
              </a>
              <a href="{{ route('freelance.onboarding.start') }}" class="btn btn-outline-modern btn-lg">
                {{ __('Devenir freelance') }}
                <i class="fas fa-user-plus ms-2"></i>
              </a>
            </div>
          </div>
        </div>
      </div>
    </section>
  @endif

  <!-- Blog Section Premium avec Slider Horizontal -->
  @if ($secInfo->blog_section_status == 1)
    <section class="blog-section-premium">
      <div class="container">
        <!-- Header de section -->
        <div class="blog-header-premium">
          <div class="blog-header-content">
            <h2 class="blog-title-premium">Votre source d'inspiration</h2>
            <p class="blog-subtitle-premium">
              Guides, conseils et retours d'expérience pour échanger en confiance et choisir votre univers.
            </p>
          </div>
          <div class="blog-header-actions">
            <a href="{{ route('blog') }}" class="btn-blog-primary">
              Voir plus d'articles
            </a>
            @php
              try {
                $servicesRoute = route('services');
              } catch (\Exception $e) {
                $servicesRoute = null;
              }
            @endphp
            @if($servicesRoute)
              <a href="{{ $servicesRoute }}" class="btn-blog-secondary">
                Explorer les services
              </a>
            @endif
          </div>
        </div>

        <!-- Slider horizontal -->
        @if(isset($posts) && $posts->count() > 0)
          <div class="blog-slider-wrapper">
            <div class="blog-slider-container">
              <div class="blog-slider-track">
                @foreach ($posts as $post)
                  <article class="blog-card-premium">
                    <a href="{{ route('blog.post_details', ['slug' => $post->slug, 'id' => $post->id]) }}" class="blog-card-link-premium">
                      <div class="blog-image-wrapper-premium">
                        @if (!empty($post->image))
                          <img class="blog-image-premium lazyload" 
                            data-src="{{ asset('assets/img/posts/' . $post->image) }}"
                            src="{{ asset('assets/front/images/placeholder.png') }}"
                            alt="{{ $post->title }}" 
                            loading="lazy"
                            onerror="this.onerror=null; this.style.display='none'; this.parentElement.querySelector('.blog-image-placeholder-premium').style.display='flex';">
                        @else
                          <div class="blog-image-placeholder-premium">
                            <i class="fas fa-newspaper"></i>
                          </div>
                        @endif
                        @if(isset($post->categoryName))
                          <span class="blog-category-badge">{{ $post->categoryName }}</span>
                        @endif
                      </div>
                      <div class="blog-card-content-premium">
                        <h3 class="blog-card-title-premium">
                          {{ strlen($post->title) > 80 ? mb_substr($post->title, 0, 80, 'UTF-8') . '...' : $post->title }}
                        </h3>
                        <p class="blog-card-excerpt-premium">
                          {!! strlen(strip_tags($post->content)) > 120
                              ? mb_substr(strip_tags($post->content), 0, 120, 'UTF-8') . '...'
                              : strip_tags($post->content) !!}
                        </p>
                        <div class="blog-card-meta-premium">
                          <span class="blog-reading-time">
                            <i class="far fa-clock"></i>
                            @php
                              $wordCount = str_word_count(strip_tags($post->content));
                              $readingTime = max(1, round($wordCount / 200));
                            @endphp
                            {{ $readingTime }}mn à lire
                          </span>
                        </div>
                      </div>
                    </a>
                  </article>
                @endforeach
              </div>
            </div>
            <button class="blog-slider-nav blog-slider-next" aria-label="Article suivant">
              <i class="fas fa-chevron-right"></i>
            </button>
          </div>
        @else
          <!-- Fallback si aucun article -->
          <div class="blog-empty-state">
            <p class="blog-empty-text">Aucun article disponible pour le moment.</p>
            <a href="{{ route('blog') }}" class="btn-blog-primary">
              Voir plus d'articles
            </a>
          </div>
        @endif
      </div>
    </section>
  @endif
@endsection

@section('script')
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      // Initialiser le slider grandes photos freelances
      if (document.querySelector('.freelancers-large-slider')) {
        new Swiper('.freelancers-large-slider', {
          slidesPerView: 1,
          spaceBetween: 0,
          loop: true,
          autoplay: {
            delay: 5000,
            disableOnInteraction: false,
          },
          pagination: {
            el: '.swiper-pagination',
            clickable: true,
          },
          effect: 'fade',
          fadeEffect: {
            crossFade: true
          },
          speed: 800,
        });
      }

      // Initialiser le slider Freelances du mois (photos premium, 5 cartes desktop)
      if (document.querySelector('.freelancers-recommended-slider')) {
        new Swiper('.freelancers-recommended-slider', {
          slidesPerView: 1,
          spaceBetween: 24,
          loop: true,
          pagination: {
            el: '.freelancers-recommended-slider .swiper-pagination',
            clickable: true,
          },
          navigation: {
            nextEl: '.freelancers-recommended-slider .swiper-button-next',
            prevEl: '.freelancers-recommended-slider .swiper-button-prev',
          },
          breakpoints: {
            640: { slidesPerView: 2, spaceBetween: 24 },
            768: { slidesPerView: 3, spaceBetween: 24 },
            1024: { slidesPerView: 4, spaceBetween: 24 },
            1200: { slidesPerView: 5, spaceBetween: 24 },
          },
          speed: 600,
          on: {
            init: function() {
              this.update();
              this.navigation.update();
            },
            slideChange: function() {
              this.navigation.update();
            },
          },
        });
      }

      // Blog Slider Horizontal Premium
      const blogSliderTrack = document.querySelector('.blog-slider-track');
      const blogSliderNext = document.querySelector('.blog-slider-next');

      if (blogSliderTrack) {
        let isDown = false;
        let startX;
        let scrollLeft;
        let currentScroll = 0;

        // Fonction pour calculer le scroll
        const scrollAmount = () => {
          const cardWidth = blogSliderTrack.querySelector('.blog-card-premium')?.offsetWidth || 0;
          const gap = 24;
          return cardWidth + gap;
        };

        // Navigation : suivant uniquement (défilement continu, pas de retour arrière)
        if (blogSliderNext) {
          blogSliderNext.addEventListener('click', () => {
            const amount = scrollAmount();
            const maxScroll = blogSliderTrack.scrollWidth - blogSliderTrack.clientWidth;
            currentScroll = Math.min(maxScroll, currentScroll + amount);
            blogSliderTrack.scrollTo({
              left: currentScroll,
              behavior: 'smooth'
            });
          });
        }

        // Swipe mobile
        blogSliderTrack.addEventListener('mousedown', (e) => {
          isDown = true;
          startX = e.pageX - blogSliderTrack.offsetLeft;
          scrollLeft = blogSliderTrack.scrollLeft;
          blogSliderTrack.style.cursor = 'grabbing';
        });

        blogSliderTrack.addEventListener('mouseleave', () => {
          isDown = false;
          blogSliderTrack.style.cursor = 'grab';
        });

        blogSliderTrack.addEventListener('mouseup', () => {
          isDown = false;
          blogSliderTrack.style.cursor = 'grab';
        });

        blogSliderTrack.addEventListener('mousemove', (e) => {
          if (!isDown) return;
          e.preventDefault();
          const x = e.pageX - blogSliderTrack.offsetLeft;
          const walk = (x - startX) * 2;
          blogSliderTrack.scrollLeft = scrollLeft - walk;
        });

        // Touch events pour mobile
        let touchStartX = 0;
        let touchScrollLeft = 0;

        blogSliderTrack.addEventListener('touchstart', (e) => {
          touchStartX = e.touches[0].pageX - blogSliderTrack.offsetLeft;
          touchScrollLeft = blogSliderTrack.scrollLeft;
        });

        blogSliderTrack.addEventListener('touchmove', (e) => {
          if (!touchStartX) return;
          const x = e.touches[0].pageX - blogSliderTrack.offsetLeft;
          const walk = (x - touchStartX) * 2;
          blogSliderTrack.scrollLeft = touchScrollLeft - walk;
        });

        // Mettre à jour currentScroll lors du scroll
        blogSliderTrack.addEventListener('scroll', () => {
          currentScroll = blogSliderTrack.scrollLeft;
        });

        const updateNavButtons = () => {
          if (blogSliderNext) {
            const maxScroll = blogSliderTrack.scrollWidth - blogSliderTrack.clientWidth;
            blogSliderNext.style.opacity = currentScroll < maxScroll - 10 ? '1' : '0.3';
          }
        };

        blogSliderTrack.addEventListener('scroll', updateNavButtons);
        window.addEventListener('resize', updateNavButtons);
        updateNavButtons();
      }

    });
  </script>

  {{-- Le chatbot premium est créé automatiquement par junspro-chatbot-premium.js --}}

@endsection
