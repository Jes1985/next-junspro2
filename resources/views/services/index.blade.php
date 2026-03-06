@extends('frontend.layout')

@section('pageHeading')
  Services | {{ $websiteInfo->website_title }}
@endsection

@section('metaDescription')
  Découvrez les 6 univers Junspro : Projets et Consulting, Cours, Rituals Services, Ritual Motion, Présence et NEXUS — échangez autrement, partout dans le monde.
@endsection

@section('style')
<link rel="stylesheet" href="{{ asset('assets/front/css/services-hub.css') }}">
<style>
  /* Projets et Consulting — violet/bleu désaturé premium */
  .services-universe-bubble[data-index="0"] {
    background: linear-gradient(
      135deg,
      rgba(255, 255, 255, 0.98) 0%,
      rgba(250, 245, 255, 0.95) 100%
    ) !important;
    border-color: rgba(139, 92, 246, 0.2) !important;
    box-shadow: 
      0 8px 32px rgba(139, 92, 246, 0.12),
      0 2px 8px rgba(37, 99, 235, 0.08),
      inset 0 1px 0 rgba(255, 255, 255, 0.9) !important;
  }

  .services-universe-bubble[data-index="0"]:hover {
    box-shadow: 
      0 16px 48px rgba(139, 92, 246, 0.2),
      0 4px 16px rgba(37, 99, 235, 0.15),
      inset 0 1px 0 rgba(255, 255, 255, 0.95) !important;
    border-color: rgba(37, 99, 235, 0.4) !important;
  }

  .services-universe-bubble[data-index="0"] .services-universe-bubble__tail {
    border-color: rgba(139, 92, 246, 0.2) transparent transparent transparent !important;
    filter: drop-shadow(2px 2px 4px rgba(139, 92, 246, 0.1)) !important;
  }

  .services-universe-bubble[data-index="0"] .services-universe-bubble__emoji-wrapper {
    border-color: rgba(139, 92, 246, 0.3) !important;
    box-shadow: 
      0 4px 16px rgba(139, 92, 246, 0.15),
      0 0 0 1px rgba(255, 255, 255, 0.5) inset,
      0 2px 8px rgba(37, 99, 235, 0.1) inset !important;
  }

  .services-universe-bubble[data-index="0"]:hover .services-universe-bubble__emoji-wrapper {
    border-color: rgba(37, 99, 235, 0.5) !important;
    box-shadow: 
      0 8px 24px rgba(37, 99, 235, 0.25),
      0 0 0 1px rgba(255, 255, 255, 0.6) inset,
      0 4px 12px rgba(139, 92, 246, 0.15) inset !important;
  }

  .services-universe-bubble[data-index="0"] .services-universe-bubble__emoji {
    filter: drop-shadow(0 2px 8px rgba(139, 92, 246, 0.2)) !important;
  }

  .services-universe-bubble[data-index="0"]:hover .services-universe-bubble__emoji {
    filter: drop-shadow(0 4px 12px rgba(37, 99, 235, 0.3)) !important;
  }

  .services-universe-bubble[data-index="0"] .services-universe-bubble__baseline {
    background: linear-gradient(135deg, #8B5CF6 0%, #A78BFA 50%, #2563EB 100%) !important;
    -webkit-background-clip: text !important;
    -webkit-text-fill-color: transparent !important;
    background-clip: text !important;
  }

  .services-universe-bubble[data-index="0"] .services-universe-bubble__cta {
    background: linear-gradient(135deg, #8B5CF6 0%, #A78BFA 50%, #2563EB 100%) !important;
    box-shadow: 
      0 4px 12px rgba(139, 92, 246, 0.3),
      0 0 0 1px rgba(255, 255, 255, 0.2) inset !important;
  }

  .services-universe-bubble[data-index="0"] .services-universe-bubble__cta:hover {
    box-shadow: 
      0 8px 24px rgba(37, 99, 235, 0.4),
      0 0 0 1px rgba(255, 255, 255, 0.3) inset !important;
  }

  /* Cours — bleu/cyan désaturé premium */
  .services-universe-bubble[data-index="1"] {
    background: linear-gradient(135deg, rgba(255,255,255,0.98) 0%, rgba(240,253,250,0.95) 100%) !important;
    border-color: rgba(6, 182, 212, 0.1) !important;
    box-shadow: 0 8px 24px rgba(6, 182, 212, 0.06), 0 2px 8px rgba(0,0,0,0.03) !important;
  }
  .services-universe-bubble[data-index="1"]:hover {
    box-shadow: 0 16px 40px rgba(6, 182, 212, 0.08), 0 4px 12px rgba(0,0,0,0.04) !important;
    border-color: rgba(6, 182, 212, 0.18) !important;
  }
  .services-universe-bubble[data-index="1"] .services-universe-bubble__tail { border-color: rgba(6, 182, 212, 0.1) transparent transparent transparent !important; }
  .services-universe-bubble[data-index="1"] .services-universe-bubble__emoji-wrapper {
    border-color: rgba(6, 182, 212, 0.2) !important;
    box-shadow: 0 2px 8px rgba(6, 182, 212, 0.08) !important;
  }
  .services-universe-bubble[data-index="1"]:hover .services-universe-bubble__emoji-wrapper {
    border-color: rgba(6, 182, 212, 0.28) !important;
    box-shadow: 0 4px 12px rgba(6, 182, 212, 0.1) !important;
  }
  .services-universe-bubble[data-index="1"] .services-universe-bubble__baseline {
    background: linear-gradient(135deg, #3B82F6 0%, #22D3EE 50%, #67E8F9 100%) !important;
    -webkit-background-clip: text !important; -webkit-text-fill-color: transparent !important; background-clip: text !important;
  }
  .services-universe-bubble[data-index="1"] .services-universe-bubble__cta {
    background: linear-gradient(135deg, #3B82F6 0%, #06B6D4 50%, #22D3EE 100%) !important;
    box-shadow: 0 2px 8px rgba(6, 182, 212, 0.15) !important;
  }
  .services-universe-bubble[data-index="1"] .services-universe-bubble__cta:hover {
    box-shadow: 0 6px 16px rgba(6, 182, 212, 0.2) !important;
  }

  /* At Home — jaune/orange désaturé premium */
  .services-universe-bubble[data-index="2"] {
    background: linear-gradient(135deg, rgba(255,255,255,0.98) 0%, rgba(255,253,243,0.95) 100%) !important;
    border-color: rgba(251, 191, 36, 0.1) !important;
    box-shadow: 0 8px 24px rgba(251, 191, 36, 0.06), 0 2px 8px rgba(0,0,0,0.03) !important;
  }
  .services-universe-bubble[data-index="2"]:hover {
    box-shadow: 0 16px 40px rgba(251, 191, 36, 0.08), 0 4px 12px rgba(0,0,0,0.04) !important;
    border-color: rgba(251, 191, 36, 0.18) !important;
  }
  .services-universe-bubble[data-index="2"] .services-universe-bubble__tail { border-color: rgba(251, 191, 36, 0.1) transparent transparent transparent !important; }
  .services-universe-bubble[data-index="2"] .services-universe-bubble__emoji-wrapper {
    border-color: rgba(251, 191, 36, 0.2) !important;
    box-shadow: 0 2px 8px rgba(251, 191, 36, 0.08) !important;
  }
  .services-universe-bubble[data-index="2"]:hover .services-universe-bubble__emoji-wrapper {
    border-color: rgba(251, 191, 36, 0.28) !important;
    box-shadow: 0 4px 12px rgba(251, 191, 36, 0.1) !important;
  }
  .services-universe-bubble[data-index="2"] .services-universe-bubble__baseline {
    background: linear-gradient(135deg, #F59E0B 0%, #FB923C 50%, #6366F1 100%) !important;
    -webkit-background-clip: text !important; -webkit-text-fill-color: transparent !important; background-clip: text !important;
  }
  .services-universe-bubble[data-index="2"] .services-universe-bubble__cta {
    background: linear-gradient(135deg, #F59E0B 0%, #FB923C 50%, #6366F1 100%) !important;
    box-shadow: 0 2px 8px rgba(251, 191, 36, 0.15) !important;
  }
  .services-universe-bubble[data-index="2"] .services-universe-bubble__cta:hover {
    box-shadow: 0 6px 16px rgba(251, 191, 36, 0.2) !important;
  }

  /* Junspro Ritual Motion — orange/rouge désaturé premium */
  .services-universe-bubble[data-index="3"] {
    background: linear-gradient(135deg, rgba(255,255,255,0.98) 0%, rgba(255,250,245,0.95) 100%) !important;
    border-color: rgba(251, 146, 60, 0.1) !important;
    box-shadow: 0 8px 24px rgba(251, 146, 60, 0.06), 0 2px 8px rgba(0,0,0,0.03) !important;
  }
  .services-universe-bubble[data-index="3"]:hover {
    box-shadow: 0 16px 40px rgba(251, 146, 60, 0.08), 0 4px 12px rgba(0,0,0,0.04) !important;
    border-color: rgba(234, 88, 12, 0.18) !important;
  }
  .services-universe-bubble[data-index="3"] .services-universe-bubble__tail { border-color: rgba(251, 146, 60, 0.1) transparent transparent transparent !important; }
  .services-universe-bubble[data-index="3"] .services-universe-bubble__emoji-wrapper {
    border-color: rgba(234, 88, 12, 0.2) !important;
    box-shadow: 0 2px 8px rgba(251, 146, 60, 0.08) !important;
  }
  .services-universe-bubble[data-index="3"]:hover .services-universe-bubble__emoji-wrapper {
    border-color: rgba(234, 88, 12, 0.28) !important;
    box-shadow: 0 4px 12px rgba(251, 146, 60, 0.1) !important;
  }
  .services-universe-bubble[data-index="3"] .services-universe-bubble__baseline {
    background: linear-gradient(135deg, #FB923C 0%, #F97316 50%, #E07C5A 100%) !important;
    -webkit-background-clip: text !important; -webkit-text-fill-color: transparent !important; background-clip: text !important;
  }
  .services-universe-bubble[data-index="3"] .services-universe-bubble__cta {
    background: linear-gradient(135deg, #FB923C 0%, #EA580C 50%, #E07C5A 100%) !important;
    box-shadow: 0 2px 8px rgba(234, 88, 12, 0.15) !important;
  }
  .services-universe-bubble[data-index="3"] .services-universe-bubble__cta:hover {
    box-shadow: 0 6px 16px rgba(234, 88, 12, 0.2) !important;
  }

  /* Styles spécifiques pour l'univers "NEXUS" - Dégradé rose bleu royal */
  .services-universe-bubble[data-index="4"] {
    background: linear-gradient(
      135deg,
      rgba(255, 255, 255, 0.98) 0%,
      rgba(253, 242, 248, 0.95) 100%
    ) !important;
    border-color: rgba(236, 72, 153, 0.2) !important;
    box-shadow: 
      0 8px 32px rgba(236, 72, 153, 0.12),
      0 2px 8px rgba(37, 99, 235, 0.08),
      inset 0 1px 0 rgba(255, 255, 255, 0.9) !important;
  }

  .services-universe-bubble[data-index="4"]:hover {
    box-shadow: 
      0 16px 48px rgba(236, 72, 153, 0.2),
      0 4px 16px rgba(37, 99, 235, 0.15),
      inset 0 1px 0 rgba(255, 255, 255, 0.95) !important;
    border-color: rgba(37, 99, 235, 0.4) !important;
  }

  .services-universe-bubble[data-index="4"] .services-universe-bubble__tail {
    border-color: rgba(236, 72, 153, 0.2) transparent transparent transparent !important;
    filter: drop-shadow(2px 2px 4px rgba(236, 72, 153, 0.1)) !important;
  }

  .services-universe-bubble[data-index="4"] .services-universe-bubble__emoji-wrapper {
    border-color: rgba(236, 72, 153, 0.3) !important;
    box-shadow: 
      0 4px 16px rgba(236, 72, 153, 0.15),
      0 0 0 1px rgba(255, 255, 255, 0.5) inset,
      0 2px 8px rgba(37, 99, 235, 0.1) inset !important;
  }

  .services-universe-bubble[data-index="4"]:hover .services-universe-bubble__emoji-wrapper {
    border-color: rgba(37, 99, 235, 0.5) !important;
    box-shadow: 
      0 8px 24px rgba(37, 99, 235, 0.25),
      0 0 0 1px rgba(255, 255, 255, 0.6) inset,
      0 4px 12px rgba(236, 72, 153, 0.15) inset !important;
  }

  .services-universe-bubble[data-index="4"] .services-universe-bubble__emoji {
    filter: drop-shadow(0 2px 8px rgba(236, 72, 153, 0.2)) !important;
  }

  .services-universe-bubble[data-index="4"]:hover .services-universe-bubble__emoji {
    filter: drop-shadow(0 4px 12px rgba(37, 99, 235, 0.3)) !important;
  }

  .services-universe-bubble[data-index="4"] .services-universe-bubble__baseline {
    background: linear-gradient(135deg, #EC4899 0%, #F472B6 50%, #2563EB 100%) !important;
    -webkit-background-clip: text !important;
    -webkit-text-fill-color: transparent !important;
    background-clip: text !important;
  }

  .services-universe-bubble[data-index="4"] .services-universe-bubble__cta {
    background: linear-gradient(135deg, #EC4899 0%, #F472B6 50%, #2563EB 100%) !important;
    box-shadow: 
      0 4px 12px rgba(236, 72, 153, 0.3),
      0 0 0 1px rgba(255, 255, 255, 0.2) inset !important;
  }

  .services-universe-bubble[data-index="4"] .services-universe-bubble__cta:hover {
    box-shadow: 
      0 8px 24px rgba(37, 99, 235, 0.4),
      0 0 0 1px rgba(255, 255, 255, 0.3) inset !important;
  }

  /* Corporate — jaune/vert désaturé premium */
  .services-universe-bubble[data-index="5"] {
    background: linear-gradient(135deg, rgba(255,255,255,0.98) 0%, rgba(250,253,240,0.95) 100%) !important;
    border-color: rgba(132, 204, 22, 0.1) !important;
    box-shadow: 0 8px 24px rgba(132, 204, 22, 0.06), 0 2px 8px rgba(0,0,0,0.03) !important;
  }
  .services-universe-bubble[data-index="5"]:hover {
    box-shadow: 0 16px 40px rgba(132, 204, 22, 0.08), 0 4px 12px rgba(0,0,0,0.04) !important;
    border-color: rgba(132, 204, 22, 0.18) !important;
  }
  .services-universe-bubble[data-index="5"] .services-universe-bubble__tail { border-color: rgba(132, 204, 22, 0.1) transparent transparent transparent !important; }
  .services-universe-bubble[data-index="5"] .services-universe-bubble__emoji-wrapper {
    border-color: rgba(132, 204, 22, 0.2) !important;
    box-shadow: 0 2px 8px rgba(132, 204, 22, 0.08) !important;
  }
  .services-universe-bubble[data-index="5"]:hover .services-universe-bubble__emoji-wrapper {
    border-color: rgba(132, 204, 22, 0.28) !important;
    box-shadow: 0 4px 12px rgba(132, 204, 22, 0.1) !important;
  }
  .services-universe-bubble[data-index="5"] .services-universe-bubble__baseline {
    background: linear-gradient(135deg, #A3E635 0%, #84CC16 50%, #6366F1 100%) !important;
    -webkit-background-clip: text !important; -webkit-text-fill-color: transparent !important; background-clip: text !important;
  }
  .services-universe-bubble[data-index="5"] .services-universe-bubble__cta {
    background: linear-gradient(135deg, #A3E635 0%, #84CC16 50%, #6366F1 100%) !important;
    box-shadow: 0 2px 8px rgba(132, 204, 22, 0.15) !important;
  }
  .services-universe-bubble[data-index="5"] .services-universe-bubble__cta:hover {
    box-shadow: 0 6px 16px rgba(132, 204, 22, 0.2) !important;
  }

  /* ========== #services-hero — REFONTE PREMIUM (scopé, /services uniquement) ========== */
  #services-hero {
    padding: 4rem 1rem 6rem;
    border-radius: 0 0 48px 48px;
    min-height: 70vh;
    margin-bottom: 3rem;
  }
  @media (min-width: 768px) {
    #services-hero { padding: 6rem 1.5rem 8rem; }
  }

  /* Fade bas vers blanc (ajusté pour permettre l'overlap avec les filtres) */
  #services-hero::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    height: 80px;
    background: linear-gradient(to top, rgba(255,255,255,0.3) 0%, transparent 100%);
    pointer-events: none;
    z-index: 2;
  }

  /* Grain très léger (optionnel) */
  #services-hero::before {
    content: '';
    position: absolute;
    inset: 0;
    z-index: 3;
    pointer-events: none;
    opacity: 0.035;
    background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 256 256' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.85' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)'/%3E%3C/svg%3E");
  }

  /* Placeholder: gradient moins saturé, plus de profondeur */
  #services-hero .services-hub-hero__placeholder {
    background: linear-gradient(165deg, #A78BFA 0%, #8B5CF6 25%, #7C3AED 50%, #6D28D9 75%, #5B21B6 100%);
  }

  /* Glow radial doux derrière le titre */
  #services-hero .services-hub-hero__content::before {
    content: '';
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: min(640px, 85vw);
    height: 360px;
    background: radial-gradient(ellipse at center, rgba(255,255,255,0.12) 0%, rgba(255,255,255,0.04) 40%, transparent 70%);
    pointer-events: none;
    z-index: -1;
  }

  #services-hero .services-hub-hero__content {
    max-width: 72rem;
    padding: 2rem 1.5rem;
    z-index: 4;
    animation: servicesHeroEnter 0.6s ease-out 1 forwards;
  }
  @media (min-width: 768px) {
    #services-hero .services-hub-hero__content { padding: 3rem 2rem; }
  }

  @keyframes servicesHeroEnter {
    from { opacity: 0; transform: translateY(12px); }
    to   { opacity: 1; transform: translateY(0); }
  }

  /* Typo: titre moins massif, plus de souffle */
  #services-hero .services-hub-hero__h1 {
    font-size: clamp(2rem, 4.2vw, 3.25rem);
    font-weight: 700;
    line-height: 1.28;
    letter-spacing: 0.01em;
    text-shadow: none;
    margin-bottom: 1rem;
  }

  /* Sous-titre: blanc cassé / slate très clair (éviter noir sur violet) */
  #services-hero .services-hub-hero__h2 {
    color: rgba(248,250,252,0.98);
    font-size: clamp(1.25rem, 2.5vw, 1.875rem);
    font-weight: 600;
    margin-bottom: 1.5rem;
    text-shadow: 0 1px 8px rgba(0,0,0,0.08);
  }

  /* Micro: max-width, couleur douce, interligne */
  #services-hero .services-hub-hero__micro {
    max-width: 42rem;
    color: rgba(226,232,240,0.95);
    line-height: 1.75;
    margin-bottom: 2.5rem;
    font-size: clamp(0.9375rem, 1.25vw, 1.125rem);
  }

  /* CTA premium: même hauteur, radius, transitions 200–300ms */
  #services-hero .services-hub-hero__actions {
    gap: 1rem;
    margin-bottom: 2rem;
  }
  @media (max-width: 640px) {
    #services-hero .services-hub-hero__actions { flex-direction: column; align-items: center; }
  }

  #services-hero .services-hub-hero__cta {
    padding: 0.75rem 1.75rem;
    border-radius: 9999px;
    font-size: 0.9375rem;
    font-weight: 600;
    transition: transform 0.25s ease-out, box-shadow 0.25s ease-out, background 0.25s ease-out, border-color 0.25s ease-out;
  }

  /* CTA primaire: gradient Junspro discret, ombre, hover lift 1–2px + glow, focus ring */
  #services-hero .services-hub-hero__cta--primary {
    background: linear-gradient(135deg, #4F46E5 0%, #6366F1 50%, #7C3AED 100%);
    box-shadow: 0 4px 14px rgba(79,70,229,0.28);
    border: none;
  }
  #services-hero .services-hub-hero__cta--primary::before { display: none; }
  #services-hero .services-hub-hero__cta--primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 24px rgba(79,70,229,0.35), 0 0 0 1px rgba(255,255,255,0.15) inset;
  }
  #services-hero .services-hub-hero__cta--primary:focus-visible {
    outline: 2px solid rgba(255,255,255,0.6);
    outline-offset: 2px;
  }

  /* CTA secondaire: outline translucide, fond léger au hover */
  #services-hero .services-hub-hero__cta--secondary {
    background: transparent;
    border: 1px solid rgba(255,255,255,0.4);
    color: rgba(255,255,255,0.98);
  }
  #services-hero .services-hub-hero__cta--secondary:hover {
    background: rgba(255,255,255,0.08);
    border-color: rgba(255,255,255,0.55);
  }
  #services-hero .services-hub-hero__cta--secondary:focus-visible {
    outline: 2px solid rgba(255,255,255,0.5);
    outline-offset: 2px;
  }

  /* Pills: glass, hairline, icône, hover discret, transition 200–300ms */
  #services-hero .services-hub-hero__chips {
    gap: 0.75rem;
  }
  #services-hero .services-hub-chip {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.5rem 1rem;
    font-size: 0.8125rem;
    font-weight: 500;
    letter-spacing: 0.02em;
    background: rgba(255,255,255,0.12);
    border: 1px solid rgba(255,255,255,0.25);
    border-radius: 9999px;
    backdrop-filter: blur(12px);
    -webkit-backdrop-filter: blur(12px);
    transition: background 0.25s ease-out, border-color 0.25s ease-out, transform 0.25s ease-out;
  }
  #services-hero .services-hub-chip i {
    font-size: 0.7rem;
    opacity: 0.9;
  }
  #services-hero .services-hub-chip:hover {
    background: rgba(255,255,255,0.18);
    border-color: rgba(255,255,255,0.35);
    transform: translateY(-1px);
  }
  @media (max-width: 640px) {
    #services-hero .services-hub-hero__chips { justify-content: center; flex-wrap: wrap; }
  }
</style>
@endsection

@section('content')
<div class="services-hub-wrapper">
  {{-- Hero Section --}}
  <section id="services-hero" class="services-hub-hero">
    <div class="services-hub-hero__image-wrapper">
      @php
        // Chercher une image premium pour le hero
        $heroImageName = 'services-hub-hero';
        $possiblePaths = [
          public_path('images/' . $heroImageName . '.jpg'),
          public_path('images/' . $heroImageName . '.png'),
          public_path('images/' . $heroImageName . '.webp'),
          public_path('assets/img/' . $heroImageName . '.jpg'),
          public_path('assets/img/' . $heroImageName . '.png'),
          public_path('assets/img/' . $heroImageName . '.webp'),
        ];

        $heroImagePath = null;
        foreach ($possiblePaths as $path) {
          if (file_exists($path)) {
            $heroImagePath = str_replace(public_path(), '', $path);
            $heroImagePath = str_replace('\\', '/', $heroImagePath);
            if (!str_starts_with($heroImagePath, '/')) {
              $heroImagePath = '/' . $heroImagePath;
            }
            break;
          }
        }
      @endphp
      
      @if($heroImagePath)
        <img src="{{ $heroImagePath }}" alt="Junspro Services" class="services-hub-hero__image">
      @else
        <div class="services-hub-hero__placeholder"></div>
      @endif
    </div>
    <div class="services-hub-hero__overlay"></div>
    <div class="services-hub-hero__content">
      <h1 class="services-hub-hero__h1">Bienvenue sur Junspro.</h1>
      <h2 class="services-hub-hero__h2">6 univers, une seule plateforme.</h2>
      <p class="services-hub-hero__micro">Réservez, progressez, déléguez, bougez — avec la même expérience simple et fluide.</p>
      <div class="services-hub-hero__actions">
        <a href="#universes" class="services-hub-hero__cta services-hub-hero__cta--primary">Explorer les univers</a>
        <a href="#how-it-works" class="services-hub-hero__cta services-hub-hero__cta--secondary">Comment ça marche</a>
      </div>
      <div class="services-hub-hero__chips">
        <span class="services-hub-chip"><i class="fas fa-clock" aria-hidden="true"></i>Rituel 50+10</span>
        <span class="services-hub-chip"><i class="fas fa-gift" aria-hidden="true"></i>Essai dispo</span>
        <span class="services-hub-chip"><i class="fas fa-calendar-alt" aria-hidden="true"></i>Abonnements flexibles</span>
        <span class="services-hub-chip"><i class="fas fa-lock" aria-hidden="true"></i>Paiement sécurisé</span>
      </div>
    </div>
  </section>

  {{-- Hero filters (copie /services/projects) : Univers + Spécialisation + Pays + Ville + Filtres avancés --}}
  <div class="container" style="position:relative;z-index:10;">
    <x-home.search-filter
      formId="servicesHubSearchFilter"
      :formAction="route('services')"
      universe="hub"
      :hubUniverses="$hubUniverses ?? []"
      :hubUniverseDomains="$hubUniverseDomains ?? []"
      keywordPlaceholder="Essayez « Pilates », « Marketing Digital », « Anglais »..."
      locationPlaceholder="Lieu de la mission (ex: Paris, Lyon...)"
    />
  </div>

  {{-- Module Pause Souffle Inline avec bullets (juste sous filtres, avant listing univers) --}}
  <div class="container">
    @include('frontend.components.pause-souffle.inline-with-bullets-premium')
  </div>

  {{-- Universes Grid --}}
  <section id="universes" class="services-hub-universes">
    <div class="container">
      <h2 class="services-hub-section-title">Les univers</h2>
      <x-services.universe-grid :universes="$universes" />
    </div>
  </section>

  {{-- How it works section --}}
  <section id="how-it-works" class="services-hub-how-it-works">
    <noscript><style>.services-hub-step{opacity:1!important;transform:none!important}</style></noscript>
    <div class="container">
      <h2 class="services-hub-section-title">Comment ça marche</h2>
      <div class="services-hub-steps">
        <div class="services-hub-step">
          <div class="services-hub-step__number">1</div>
          <h3 class="services-hub-step__title">Choisissez votre univers</h3>
          <p class="services-hub-step__text">Explorez nos 6 univers et trouvez celui qui correspond à vos besoins</p>
        </div>
        <div class="services-hub-step">
          <div class="services-hub-step__number">2</div>
          <h3 class="services-hub-step__title">Réservez en quelques clics</h3>
          <p class="services-hub-step__text">Sélectionnez votre service, choisissez un créneau et validez</p>
        </div>
        <div class="services-hub-step">
          <div class="services-hub-step__number">3</div>
          <h3 class="services-hub-step__title">Profitez de l'expérience</h3>
          <p class="services-hub-step__text">Suivez votre progression et bénéficiez d'un accompagnement personnalisé</p>
        </div>
      </div>
    </div>
  </section>
</div>
@endsection

@section('script')
<script>
  // Smooth scroll pour les ancres
  document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
      e.preventDefault();
      const target = document.querySelector(this.getAttribute('href'));
      if (target) {
        target.scrollIntoView({ behavior: 'smooth', block: 'start' });
      }
    });
  });

  // Animation au scroll : « Comment ça marche » (respecte prefers-reduced-motion)
  (function () {
    var steps = document.querySelectorAll('.services-hub-step');
    if (!steps.length) return;
    var reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    var observer = new IntersectionObserver(function (entries) {
      entries.forEach(function (e) {
        if (e.isIntersecting) e.target.classList.add('is-visible');
      });
    }, { rootMargin: '0px 0px -40px 0px', threshold: 0.1 });
    steps.forEach(function (s) {
      if (reduceMotion) s.classList.add('is-visible');
      else observer.observe(s);
    });
  })();
</script>
@endsection

