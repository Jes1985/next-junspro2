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
      background: linear-gradient(135deg, #1e40af 0%, #4c1d95 50%, #020617 100%);
      position: relative;
      overflow: hidden;
      padding: 0;
      margin-top: 0 !important;
      min-height: 80vh;
      display: flex;
      align-items: center;
    }

    /* Texture abstraite bleu/violet (comme le drapé doré de ComeUp) */
    .hero-modern::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background: 
        radial-gradient(circle at 20% 50%, rgba(79, 70, 229, 0.15) 0%, transparent 50%),
        radial-gradient(circle at 80% 80%, rgba(124, 58, 237, 0.12) 0%, transparent 50%),
        linear-gradient(135deg, rgba(65, 105, 225, 0.08) 0%, transparent 50%);
      opacity: 0.6;
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
    }

    .hero-modern .container {
      position: relative;
      z-index: 2;
      padding: 120px 0;
    }

    .hero-content-left {
      color: white;
      padding-right: 2rem;
      max-width: 100%;
    }

    /* Colonne droite - Carte Freelance unique (style ComeUp) */
    .hero-freelancer-card {
      position: relative;
      width: 100%;
      max-width: 450px;
      margin: 0 auto;
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
      font-size: 3.8rem; /* Plus grand pour plus d'impact */
      font-weight: 400;
      color: #FFFFFF !important;
      line-height: 1.2;
      margin-bottom: 2rem;
      text-shadow: 0 2px 10px rgba(0, 0, 0, 0.2) !important; /* Même luminosité que page services */
      display: block;
      letter-spacing: -0.02em;
      max-width: 100%;
      width: 100%;
    }

    /* Style ComeUp : 2 lignes avec mot-clé en couleur accent */
    .hero-title-line-1 {
      display: block !important;
      line-height: 1.2;
      font-weight: 400;
      color: #FFFFFF !important;
      margin-bottom: 0.75rem; /* Espacement entre les lignes */
      white-space: nowrap; /* Garder sur une seule ligne */
      text-shadow: 0 2px 10px rgba(0, 0, 0, 0.2) !important; /* Même luminosité que page services */
    }

    /* Dégradé unifié pour "freelances experts" - même style que "freelance parfait" */
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
      color: #FFFFFF !important;
      white-space: nowrap; /* Garder sur une seule ligne */
      text-shadow: 0 2px 10px rgba(0, 0, 0, 0.2) !important; /* Même luminosité que page services */
    }

    .hero-subtitle {
      font-size: 1.15rem;
      color: rgba(255, 255, 255, 0.85) !important; /* Même luminosité que page services */
      margin-bottom: 2.5rem;
      text-shadow: 0 1px 4px rgba(0, 0, 0, 0.2) !important; /* Même luminosité que page services */
      font-weight: 400;
      line-height: 1.6;
      max-width: 90%;
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
      color: rgba(255, 255, 255, 0.7);
      font-size: 0.9rem;
    }

    .hero-search-tags a {
      color: rgba(255, 255, 255, 0.9) !important;
      text-decoration: none;
      transition: color 0.2s ease;
      text-shadow: 0 1px 4px rgba(0, 0, 0, 0.4);
    }

    .hero-search-tags a:hover {
      color: rgba(255, 255, 255, 1) !important;
      text-shadow: 0 2px 6px rgba(0, 0, 0, 0.5);
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
      background: linear-gradient(135deg, #1e40af 0%, #4c1d95 50%, #7c3aed 100%);
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

    .popular-category-card:hover {
      transform: translateY(-12px);
      box-shadow: 0 20px 60px rgba(30, 64, 175, 0.25);
      border-color: #1e40af;
    }

    .popular-category-card:hover::before {
      transform: scaleX(1);
    }

    .popular-category-icon {
      width: 80px;
      height: 80px;
      border-radius: 20px;
      background: linear-gradient(135deg, #1e40af 0%, #4c1d95 50%, #7c3aed 100%);
      display: flex;
      align-items: center;
      justify-content: center;
      margin-bottom: 1.75rem;
      position: relative;
      z-index: 1;
      transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
      box-shadow: 0 8px 24px rgba(30, 64, 175, 0.4);
    }
    
    .popular-category-icon img {
      filter: brightness(0) invert(1);
    }
    
    .category-icon-placeholder {
      color: white !important;
    }

    .popular-category-card:hover .popular-category-icon {
      transform: scale(1.1) rotate(5deg);
      box-shadow: 0 12px 32px rgba(30, 64, 175, 0.5);
      background: linear-gradient(135deg, #2563eb 0%, #5b21b6 50%, #8b5cf6 100%);
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
      padding: 0 60px;
      margin-bottom: 2rem;
    }

    .freelancers-recommended-slider {
      overflow: visible;
      padding-bottom: 50px;
    }

    .freelancers-recommended-slider .swiper-slide {
      height: auto;
      display: flex;
    }

    .freelancer-card-slider-modern {
      position: relative;
      width: 100%;
      height: 400px;
      border-radius: 24px;
      overflow: hidden;
      background-size: cover;
      background-position: center;
      background-repeat: no-repeat;
      display: flex;
      flex-direction: column;
      justify-content: flex-end;
      padding: 2rem;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.25);
      transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
      border: 1px solid rgba(255, 255, 255, 0.1);
    }
    

    .freelancer-card-slider-modern:hover {
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
      background: linear-gradient(to top, rgba(0, 0, 0, 0.85) 0%, rgba(0, 0, 0, 0.5) 50%, rgba(0, 0, 0, 0.2) 100%);
      z-index: 1;
      transition: opacity 0.3s ease;
    }
    
    .freelancer-card-slider-modern:hover .freelancer-card-overlay {
      opacity: 0.9;
    }

    .freelancer-card-content {
      position: relative;
      z-index: 2;
      color: white;
    }

    .freelancers-recommended-slider .swiper-button-next,
    .freelancers-recommended-slider .swiper-button-prev {
      color: #4a5568;
      background: white;
      width: 50px;
      height: 50px;
      border-radius: 50%;
      box-shadow: 0 4px 15px rgba(0, 0, 0, 0.15);
      transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
      margin-top: -25px;
    }

    .freelancers-recommended-slider .swiper-button-next:hover,
    .freelancers-recommended-slider .swiper-button-prev:hover {
      background: linear-gradient(135deg, #1e40af 0%, #4c1d95 50%, #7c3aed 100%);
      color: white;
      transform: scale(1.1);
      box-shadow: 0 6px 20px rgba(30, 64, 175, 0.5);
    }

    .freelancers-recommended-slider .swiper-button-next {
      right: 0;
    }

    .freelancers-recommended-slider .swiper-button-prev {
      left: 0;
    }

    .freelancers-recommended-slider .swiper-button-next::after,
    .freelancers-recommended-slider .swiper-button-prev::after {
      font-size: 18px;
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

    .blog-card-modern {
      background: white;
      border-radius: 24px;
      overflow: hidden;
      box-shadow: 0 4px 24px rgba(0, 0, 0, 0.06);
      transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
      height: 100%;
      border: 1.5px solid #F3F4F6;
      position: relative;
      display: flex;
      flex-direction: column;
    }
    
    .blog-card-modern::before {
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

    .blog-card-modern:hover {
      transform: translateY(-12px);
      box-shadow: 0 20px 60px rgba(30, 64, 175, 0.25);
      border-color: #1e40af;
    }
    
    .blog-card-modern:hover::before {
      transform: scaleX(1);
    }
    
    .blog-card-link {
      text-decoration: none;
      display: block;
    }
    
    .blog-image-container {
      position: relative;
      width: 100%;
      height: 240px;
      overflow: hidden;
      background: linear-gradient(135deg, #f3f4f6 0%, #e5e7eb 100%);
    }

    .blog-image-modern {
      width: 100%;
      height: 100%;
      object-fit: cover;
      transition: transform 0.5s cubic-bezier(0.4, 0, 0.2, 1);
    }
    
    .blog-image-placeholder {
      width: 100%;
      height: 100%;
      display: flex;
      align-items: center;
      justify-content: center;
      background: linear-gradient(135deg, #1e40af 0%, #4c1d95 50%, #7c3aed 100%);
      color: white;
      font-size: 3.5rem;
    }
    
    .blog-card-modern:hover .blog-image-modern {
      transform: scale(1.1);
    }
    
    .blog-image-overlay {
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background: linear-gradient(to bottom, transparent 0%, rgba(0, 0, 0, 0.1) 50%, rgba(0, 0, 0, 0.3) 100%);
      display: flex;
      align-items: center;
      justify-content: center;
      opacity: 0;
      transition: opacity 0.3s ease;
    }
    
    .blog-card-modern:hover .blog-image-overlay {
      opacity: 1;
    }
    
    .blog-read-icon {
      width: 50px;
      height: 50px;
      background: linear-gradient(135deg, #1e40af 0%, #4c1d95 50%, #7c3aed 100%);
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      color: white;
      font-size: 1.2rem;
      box-shadow: 0 4px 15px rgba(30, 64, 175, 0.4);
      transform: scale(0.8);
      transition: transform 0.3s ease;
    }
    
    .blog-card-modern:hover .blog-read-icon {
      transform: scale(1);
    }
    
    .blog-card-body {
      padding: 1.75rem;
      flex: 1;
      display: flex;
      flex-direction: column;
    }
    
    .blog-meta {
      display: flex;
      align-items: center;
      gap: 0.5rem;
      margin-bottom: 1rem;
      font-size: 0.85rem;
      color: #6B7280;
    }
    
    .blog-meta-item {
      display: flex;
      align-items: center;
      gap: 0.35rem;
    }
    
    .blog-meta-item i {
      font-size: 0.75rem;
      color: #9CA3AF;
    }
    
    .blog-meta-separator {
      color: #D1D5DB;
      margin: 0 0.25rem;
    }
    
    .blog-title {
      font-size: 1.35rem;
      font-weight: 700;
      color: #111827;
      margin-bottom: 1rem;
      line-height: 1.4;
      min-height: 3.8em;
      display: -webkit-box;
      -webkit-line-clamp: 2;
      line-clamp: 2;
      -webkit-box-orient: vertical;
      overflow: hidden;
    }
    
    .blog-title-link {
      color: #111827;
      text-decoration: none;
      transition: color 0.3s ease;
    }
    
    .blog-title-link:hover {
      color: #1e40af;
    }
    
    .blog-excerpt {
      font-size: 0.95rem;
      color: #6B7280;
      line-height: 1.7;
      margin-bottom: 1.25rem;
      flex: 1;
      display: -webkit-box;
      -webkit-line-clamp: 3;
      line-clamp: 3;
      -webkit-box-orient: vertical;
      overflow: hidden;
    }
    
    .blog-read-more-link {
      color: #1e40af;
      text-decoration: none;
      font-weight: 600;
      font-size: 0.95rem;
      transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
      display: inline-flex;
      align-items: center;
      gap: 0.5rem;
    }
    
    .blog-read-more-link:hover {
      color: #7c3aed;
      transform: translateX(5px);
    }
    
    .blog-read-more-link i {
      transition: transform 0.3s ease;
      font-size: 0.85rem;
    }
    
    .blog-read-more-link:hover i {
      transform: translateX(5px);
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

      .hero-freelancer-card {
        max-width: 100%;
        margin-top: 2rem;
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

    /* En-tête avec dégradé - Même style que la page de contact */
    body .header-area,
    html body .header-area,
    body .header-area.header_v1,
    html body .header-area.header_v1,
    body .header-area.header_v1:not(.is-sticky),
    html body .header-area.header_v1:not(.is-sticky) {
      background: linear-gradient(135deg, #1e40af 0%, #4c1d95 50%, #020617 100%) !important;
      background-color: transparent !important;
      background-image: linear-gradient(135deg, #1e40af 0%, #4c1d95 50%, #020617 100%) !important;
      position: relative;
      z-index: 1000 !important;
    }

    /* Main navbar avec dégradé */
    body .header-area .main-navbar,
    html body .header-area .main-navbar,
    body .header-area .main-responsive-nav,
    html body .header-area .main-responsive-nav,
    body .header-area .main-navbar .navbar,
    html body .header-area .main-navbar .navbar,
    body .header-area .main-navbar .container-fluid,
    html body .header-area .main-navbar .container-fluid {
      background: linear-gradient(135deg, #1e40af 0%, #4c1d95 50%, #020617 100%) !important;
      background-color: transparent !important;
      background-image: linear-gradient(135deg, #1e40af 0%, #4c1d95 50%, #020617 100%) !important;
    }

    /* Assurer la visibilité des liens de navigation sur fond sombre */
    body .header-area .nav-link,
    html body .header-area .nav-link,
    body .header-area .main-navbar .nav-link,
    html body .header-area .main-navbar .nav-link,
    body .header-area .navbar-nav .nav-link,
    html body .header-area .navbar-nav .nav-link {
      color: rgba(255, 255, 255, 0.95) !important;
      -webkit-text-fill-color: rgba(255, 255, 255, 0.95) !important;
    }

    body .header-area .nav-link:hover,
    body .header-area .nav-link.active,
    html body .header-area .nav-link:hover,
    html body .header-area .nav-link.active {
      color: #ffffff !important;
      -webkit-text-fill-color: #ffffff !important;
    }

    /* Logo blanc sur fond sombre */
    body .header-area .junspro-logo-text {
      background: linear-gradient(135deg, #ffffff 0%, #e0e7ff 50%, #c7d2fe 100%) !important;
      -webkit-background-clip: text !important;
      -webkit-text-fill-color: transparent !important;
      background-clip: text !important;
      color: #ffffff !important;
    }

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

  <!-- Hero Section Moderne avec Slider Freelances -->
  <section class="hero-modern">
    <div class="container">
      <div class="row align-items-center">
        <!-- Contenu gauche -->
        <div class="col-lg-6 hero-content-left" data-aos="fade-right">
          <h1 class="hero-title mb-5">
<span class="hero-title-line-1">{{ __('Des') }} <span class="highlight">{{ __('freelances experts') }}</span></span>
<span class="hero-title-line-2">{{ __('pour tous vos projets') }}</span>
              </h1>
          <p class="hero-subtitle mb-5">
            {{ __('Plateforme premium de mise en relation avec abonnements hebdomadaires flexibles.') }}
          </p>
          
          <div class="search-box-modern" data-aos="fade-up" data-aos-delay="200">
            <form action="{{ route('explore') }}" method="GET" class="d-flex align-items-center w-100">
              <input type="text" name="search" class="form-control flex-grow-1 border-0"
                placeholder="{{ __('Rechercher') }}" required>
              <button type="submit" class="btn-search">
                <i class="fas fa-search"></i>
              </button>
                </form>
              </div>

          @if (!empty($BasicExtends) && !is_null($BasicExtends->popular_tags))
            <div class="hero-search-tags" data-aos="fade-up" data-aos-delay="250">
                    @php
                      $tags = explode(',', $BasicExtends->popular_tags);
                    @endphp
              @foreach (array_slice($tags, 0, 4) as $tag)
                <a href="{{ route('explore', ['search' => trim($tag)]) }}">{{ trim($tag) }}</a>
                      @if (!$loop->last)
                  <span style="color: rgba(255, 255, 255, 0.4);">·</span>
                      @endif
                    @endforeach
                  </div>
              @endif
            </div>

        <!-- Carte Freelance unique (style ComeUp) -->
        <div class="col-lg-6" data-aos="fade-left">
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

  <!-- Guarantees Section Moderne -->
  <section class="section-modern bg-light">
        <div class="container">
      <div class="row mb-5">
        <div class="col-12 text-center">
          <h2 class="section-title-modern" data-aos="fade-up">{{ __('Pourquoi choisir Junspro ?') }}</h2>
          <p class="section-subtitle-modern" data-aos="fade-up" data-aos-delay="100">
            {{ __('Des garanties qui font la différence') }}
          </p>
                        </div>
                      </div>
      <div class="row g-4">
        <div class="col-md-6 col-lg-3" data-aos="fade-up">
          <div class="guarantee-card-modern text-center">
            <div class="guarantee-icon-modern mx-auto">
              <i class="fas fa-shield-alt"></i>
                    </div>
            <h5 class="fw-bold mb-2" style="color: #1a202c;">{{ __('Paiements sécurisés') }}</h5>
            <p class="small mb-0" style="color: #4a5568;">{{ __('Transactions protégées et gérées par la plateforme avec Stripe.') }}</p>
                </div>
              </div>
        <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="100">
          <div class="guarantee-card-modern text-center">
            <div class="guarantee-icon-modern mx-auto">
              <i class="fas fa-clock"></i>
            </div>
            <h5 class="fw-bold mb-2" style="color: #1a202c;">{{ __('Abonnements flexibles') }}</h5>
            <p class="small mb-0" style="color: #4a5568;">{{ __('De 1 à 24h par semaine, adaptez selon le rythme de votre projet.') }}</p>
          </div>
        </div>
        <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="200">
          <div class="guarantee-card-modern text-center">
            <div class="guarantee-icon-modern mx-auto">
              <i class="fas fa-file-alt"></i>
            </div>
            <h5 class="fw-bold mb-2" style="color: #1a202c;">{{ __('Rapport après chaque heure') }}</h5>
            <p class="small mb-0" style="color: #4a5568;">{{ __('50 min de travail + 10 min de rapport détaillé sur l\'avancement.') }}</p>
          </div>
                    </div>
        <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="300">
          <div class="guarantee-card-modern text-center">
            <div class="guarantee-icon-modern mx-auto">
              <i class="fas fa-exchange-alt"></i>
                      </div>
            <h5 class="fw-bold mb-2" style="color: #1a202c;">{{ __('Changement de freelance') }}</h5>
            <p class="small mb-0" style="color: #4a5568;">{{ __('En cas de problème, transférez votre projet vers un autre freelance.') }}</p>
            </div>
          </div>
        </div>
      </div>
    </section>

  <!-- Catégories Populaires Section -->
  @if (isset($categories) && $categories->count() > 0)
    <section class="section-modern">
      <div class="container">
        <div class="row mb-5">
          <div class="col-12 text-center">
            <h2 class="section-title-modern" data-aos="fade-up">{{ __('Catégories les plus populaires') }}</h2>
            <p class="section-subtitle-modern" data-aos="fade-up" data-aos-delay="100">
              {{ __('Découvrez nos catégories de services les plus demandées') }}
            </p>
                  </div>
                </div>
        <div class="row g-4">
          @foreach ($categories->take(8) as $index => $category)
            <div class="col-lg-3 col-md-4 col-sm-6" data-aos="fade-up" data-aos-delay="{{ $loop->index * 50 }}">
              <div class="popular-category-card">
                <div class="popular-category-icon">
                  @if (!empty($category->image))
                                        <img class="lazyload"
                      data-src="{{ asset('assets/img/service-categories/' . $category->image) }}"
                      src="{{ asset('assets/front/images/placeholder.png') }}"
                      alt="{{ $category->name }}"
                      onerror="this.onerror=null; this.src='{{ asset('assets/front/images/placeholder.png') }}';">
              @else
                    <div class="category-icon-placeholder">
                      <i class="fas fa-folder"></i>
                </div>
              @endif
            </div>
                <h5 class="popular-category-title">{{ $category->name }}</h5>
                <a href="{{ route('explore', ['category' => $category->slug]) }}" class="popular-category-link">
                  {{ __('Afficher les services') }} <i class="fas fa-arrow-right ms-1"></i>
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
            <h2 class="section-title-modern" data-aos="fade-up">{{ __('Freelances recommandés') }}</h2>
            <p class="section-subtitle-modern" data-aos="fade-up" data-aos-delay="100">
              {{ __('Découvrez nos meilleurs freelances experts, vérifiés et notés par la communauté') }}
            </p>
                      </div>
                    </div>
        <!-- Slider Freelances -->
        <div class="freelancers-slider-container">
          <div class="swiper freelancers-recommended-slider">
            <div class="swiper-wrapper">
              @foreach ($highlightedFreelancers as $freelancer)
                @php
                  $user = $freelancer->user;
                        @endphp
                <div class="swiper-slide">
                  @php
                    // Images de fond professionnelles pour chaque freelance
                    $backgroundImages = [
                      'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=400&h=500&fit=crop',
                      'https://images.unsplash.com/photo-1494790108377-be9c29b29330?w=400&h=500&fit=crop',
                      'https://images.unsplash.com/photo-1519085360753-af0119f7cbe7?w=400&h=500&fit=crop',
                      'https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?w=400&h=500&fit=crop',
                      'https://images.unsplash.com/photo-1506794778202-cad84cf45f1d?w=400&h=500&fit=crop',
                      'https://images.unsplash.com/photo-1580489944761-15a19d654956?w=400&h=500&fit=crop',
                      'https://images.unsplash.com/photo-1551836022-d5d88e9218df?w=400&h=500&fit=crop',
                      'https://images.unsplash.com/photo-1519085360753-af0119f7cbe7?w=400&h=500&fit=crop',
                    ];
                    $bgImage = $backgroundImages[$loop->index % count($backgroundImages)];
                                  @endphp
                  <div class="freelancer-card-slider-modern" data-bg-image="{{ $bgImage }}">
                    <div class="freelancer-card-overlay"></div>
                    <div class="freelancer-card-content">
                      <div class="mb-2">
                        <small class="text-white-50 d-block mb-1" style="font-size: 0.85rem; text-transform: uppercase; letter-spacing: 0.5px;">
                          {{ __('Expert freelance') }}
                        </small>
                        <h5 class="text-white fw-bold mb-2" style="font-size: 1.5rem; text-shadow: 0 2px 10px rgba(0,0,0,0.3);">
                          {{ $user->name }}
                        </h5>
                                    </div>
                      <div class="mb-3">
                        <div class="d-flex align-items-center mb-2">
                          <i class="fas fa-map-marker-alt text-white me-2"></i>
                          <span class="text-white">{{ $user->country_code ?? '—' }}</span>
                                  </div>
                        <div class="d-flex align-items-center mb-2">
                          <i class="fas fa-euro-sign text-white me-2"></i>
                          <strong class="text-white h5 mb-0">
                            {{ number_format($freelancer->hourly_rate, 2, ',', ' ') }} / h
                          </strong>
                                    </div>
                        @if ($freelancer->reliability_score)
                          <div class="mb-2">
                            <small class="text-white-50 d-block mb-1">{{ __('Score') }} : {{ $freelancer->reliability_score }}/100</small>
                            <div class="progress" style="height: 6px; border-radius: 10px; background: rgba(255,255,255,0.2);">
                              <div class="progress-bar bg-white" role="progressbar" 
                                style="width: {{ $freelancer->reliability_score }}%"
                                aria-valuenow="{{ $freelancer->reliability_score }}" 
                                aria-valuemin="0" 
                                aria-valuemax="100">
                                  </div>
                              </div>
                                </div>
                                  @endif
                        @if ($user->is_super_freelancer ?? false)
                          <span class="badge mb-2" style="background: rgba(245, 158, 11, 0.9); color: white; backdrop-filter: blur(10px);">
                            <i class="fas fa-star"></i> {{ __('Super Freelance') }}
                                </span>
                              @endif
                            </div>
                      <a href="{{ route('freelance.show', ['id' => $freelancer->id]) }}"
                        class="btn btn-light w-100 mt-3 fw-bold" style="border-radius: 50px;">
                        {{ __('Voir le profil') }}
                      </a>
                          </div>
                        </div>
                </div>
              @endforeach
            </div>
            <!-- Navigation -->
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
            <!-- Pagination -->
            <div class="swiper-pagination"></div>
            </div>
          </div>
        <div class="row mt-5">
          <div class="col-12 text-center">
            <a href="{{ route('explore') }}" class="btn btn-primary-modern btn-lg">
              {{ __('Voir tous les freelances') }}
              <i class="fas fa-arrow-right ms-2"></i>
            </a>
        </div>
      </div>
      </div>
    </section>
  @endif

  <!-- Services en Vedette Section Moderne -->
  @if (isset($secInfo) && $secInfo->featured_services_section_status == 1 && isset($featuredCategories) && $featuredCategories->count() > 0)
    <section class="section-modern">
      <div class="container">
        <div class="row mb-5">
          <div class="col-12 text-center">
            <h2 class="section-title-modern" data-aos="fade-up">{{ __('Services en vedette') }}</h2>
            <p class="section-subtitle-modern" data-aos="fade-up" data-aos-delay="100">
              {{ __('Découvrez nos services premium sélectionnés pour leur excellence') }}
            </p>
        </div>
            </div>
        
        <div class="row g-4">
          @foreach ($featuredCategories as $category)
            @if ($category->serviceContent && $category->serviceContent->count() > 0)
              @foreach ($category->serviceContent->take(4) as $serviceContent)
                @php
                  $service = $serviceContent->service;
                  $reviewCount = $service->review()->count();
                  $averageRating = $service->average_rating ?? 0;
                @endphp
                <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="{{ ($loop->parent->index * 50) + ($loop->index * 25) }}">
                  <div class="featured-service-card">
                    <a href="{{ route('service_details', ['slug' => $serviceContent->slug, 'id' => $service->id]) }}" class="featured-service-link">
                      <div class="featured-service-image-wrapper">
                        @if (!empty($service->thumbnail_image))
                          <img src="{{ asset('assets/img/services/thumbnails/' . $service->thumbnail_image) }}" 
                               alt="{{ $serviceContent->title }}"
                               class="featured-service-image"
                               loading="lazy"
                               onerror="this.onerror=null; this.src='{{ asset('assets/front/images/placeholder.png') }}';">
        @else
                          <div class="featured-service-image-placeholder">
                            <i class="fas fa-briefcase"></i>
                        </div>
                        @endif
                        <div class="featured-service-overlay">
                          <span class="featured-service-badge">{{ __('En vedette') }}</span>
                      </div>
                      </div>
                      <div class="featured-service-content">
                        <div class="featured-service-category">{{ $category->name }}</div>
                        <h5 class="featured-service-title">{{ strlen($serviceContent->title) > 50 ? mb_substr($serviceContent->title, 0, 50, 'UTF-8') . '...' : $serviceContent->title }}</h5>
                        <div class="featured-service-meta">
                          @if ($reviewCount > 0)
                            <div class="featured-service-rating">
                              <i class="fas fa-star"></i>
                              <span>{{ number_format($averageRating, 1) }}</span>
                              <span class="featured-service-reviews">({{ $reviewCount }})</span>
                    </div>
                          @endif
                          @if ($service->package_lowest_price)
                            <div class="featured-service-price">
                              {{ __('À partir de') }} {{ number_format($service->package_lowest_price, 2, ',', ' ') }} €
                    </div>
                          @endif
                  </div>
                </div>
                    </a>
            </div>
          </div>
              @endforeach
        @endif
          @endforeach
        </div>
        
        <div class="row mt-5">
          <div class="col-12 text-center">
            <a href="{{ route('services') }}" class="btn btn-primary-modern btn-lg">
              {{ __('Voir tous les services') }}
              <i class="fas fa-arrow-right ms-2"></i>
            </a>
          </div>
        </div>
      </div>
    </section>
  @endif

  <!-- CTA Section Moderne -->
  @if ($secInfo->cta_section_status == 1 && isset($ctaSectionInfo))
    <section class="section-modern">
      <div class="container">
        <div class="cta-section-modern text-center text-white">
          <div class="cta-content-modern">
            <h2 class="mb-4" style="font-size: 2.5rem; font-weight: 700;" data-aos="fade-up">
              {{ $ctaSectionInfo->title ?? __('Prêt à démarrer votre projet ?') }}
                </h2>
            @if (!empty($ctaSectionInfo->button_text) && !empty($ctaSectionInfo->button_url))
              <a href="{{ $ctaSectionInfo->button_url }}" class="btn btn-light btn-lg rounded-pill px-5"
                data-aos="fade-up" data-aos-delay="100">
                {{ $ctaSectionInfo->button_text }}
                <i class="fas fa-arrow-right ms-2"></i>
              </a>
            @else
              <a href="{{ route('explore') }}" class="btn btn-light btn-lg rounded-pill px-5"
                data-aos="fade-up" data-aos-delay="100">
                {{ __('Explorer les freelances') }}
                <i class="fas fa-arrow-right ms-2"></i>
              </a>
                @endif
          </div>
        </div>
      </div>
    </section>
  @endif

  <!-- Blog Section Moderne -->
  @if ($secInfo->blog_section_status == 1 && isset($posts) && $posts->count() > 0)
    <section class="section-modern bg-light">
      <div class="container">
        <div class="row mb-5">
          <div class="col-12 d-flex justify-content-between align-items-center flex-wrap">
            <div class="mb-3 mb-md-0">
              <h2 class="section-title-modern mb-2" data-aos="fade-up">
                @if (!empty($secTitle->blog_section_title))
                  {{ $secTitle->blog_section_title }}
                @else
                  {{ __('Lisez notre blog') }}
                @endif
              </h2>
              <p class="section-subtitle-modern mb-0" data-aos="fade-up" data-aos-delay="100">
                {{ __('Actualités et conseils pour vos projets') }}
              </p>
            </div>
            <a href="{{ route('blog') }}" class="btn btn-primary-modern" data-aos="fade-up">
              {{ __('Voir tout') }}
            </a>
          </div>
        </div>
        <div class="row g-4">
          @foreach ($posts as $post)
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
              <article class="blog-card-modern">
                <a href="{{ route('blog.post_details', ['slug' => $post->slug, 'id' => $post->id]) }}" class="blog-card-link">
                  <div class="blog-image-container">
                    @if (!empty($post->image))
                      <img class="blog-image-modern lazyload" 
                        data-src="{{ asset('assets/img/posts/' . $post->image) }}"
                        src="{{ asset('assets/front/images/placeholder.png') }}"
                        alt="{{ $post->title }}" 
                        onerror="this.onerror=null; this.parentElement.innerHTML='<div class=\'blog-image-modern blog-image-placeholder\'><i class=\'fas fa-newspaper\'></i></div>';">
                    @else
                      <div class="blog-image-modern blog-image-placeholder">
                        <i class="fas fa-newspaper"></i>
                      </div>
                    @endif
                    <div class="blog-image-overlay">
                      <span class="blog-read-icon"><i class="fas fa-arrow-right"></i></span>
                    </div>
                  </div>
                </a>
                <div class="blog-card-body">
                  <div class="blog-meta">
                    <span class="blog-meta-item">
                      <i class="fas fa-calendar-alt"></i> 
                      <span>{{ $post->created_at->format('d M Y') }}</span>
                    </span>
                    <span class="blog-meta-separator">•</span>
                    <span class="blog-meta-item">
                      <i class="fas fa-folder"></i> 
                      <span>{{ $post->categoryName }}</span>
                    </span>
                  </div>
                  <h5 class="blog-title">
                    <a href="{{ route('blog.post_details', ['slug' => $post->slug, 'id' => $post->id]) }}"
                      class="blog-title-link">
                      {{ strlen($post->title) > 60 ? mb_substr($post->title, 0, 60, 'UTF-8') . '...' : $post->title }}
                    </a>
                  </h5>
                  <p class="blog-excerpt">
                    {!! strlen(strip_tags($post->content)) > 100
                        ? mb_substr(strip_tags($post->content), 0, 100, 'UTF-8') . '...'
                        : strip_tags($post->content) !!}
                  </p>
                  <a href="{{ route('blog.post_details', ['slug' => $post->slug, 'id' => $post->id]) }}"
                    class="blog-read-more-link">
                    {{ __('Lire la suite') }} <i class="fas fa-arrow-right ms-1"></i>
                  </a>
                </div>
              </article>
            </div>
          @endforeach
        </div>
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

      // Initialiser le slider freelances recommandés - Style comme Services les plus recherchés
      if (document.querySelector('.freelancers-recommended-slider')) {
        // Définir les images de fond via JavaScript pour éviter les problèmes de guillemets
        document.querySelectorAll('.freelancer-card-slider-modern[data-bg-image]').forEach(function(card) {
          const bgImage = card.getAttribute('data-bg-image');
          if (bgImage) {
            card.style.setProperty('background-image', 'url(' + bgImage + ')');
          }
        });
        
        new Swiper('.freelancers-recommended-slider', {
          slidesPerView: 1,
          spaceBetween: 20,
          loop: true,
          autoplay: {
            delay: 4000,
            disableOnInteraction: false,
          },
          pagination: {
            el: '.freelancers-recommended-slider .swiper-pagination',
            clickable: true,
          },
          navigation: {
            nextEl: '.freelancers-recommended-slider .swiper-button-next',
            prevEl: '.freelancers-recommended-slider .swiper-button-prev',
          },
          breakpoints: {
            640: {
              slidesPerView: 2,
              spaceBetween: 20,
            },
            768: {
              slidesPerView: 3,
              spaceBetween: 20,
            },
            1024: {
              slidesPerView: 4,
              spaceBetween: 20,
            },
            1200: {
              slidesPerView: 5,
              spaceBetween: 20,
            }
          },
          speed: 600,
        });
      }

    });
  </script>

  {{-- Le chatbot premium est créé automatiquement par junspro-chatbot-premium.js --}}

@endsection
