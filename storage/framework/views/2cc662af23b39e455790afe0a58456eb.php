<?php $__env->startSection('pageHeading'); ?>
  <?php if(!empty($pageHeading)): ?>
    <?php echo e($pageHeading->about_us_page_title ?? __('About')); ?>

  <?php else: ?>
    <?php echo e(__('About')); ?>

  <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('metaKeywords'); ?>
  <?php if(!empty($seoInfo)): ?>
    <?php echo e($seoInfo->meta_keyword_aboutus ?? ''); ?>

  <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('metaDescription'); ?>
  <?php if(!empty($seoInfo)): ?>
    <?php echo e($seoInfo->meta_description_aboutus ?? ''); ?>

  <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('style'); ?>
  <link rel="stylesheet" href="<?php echo e(asset('assets/css/summernote-content.css')); ?>">
  <style>
    /* Suppression barre catégories sur /about */
    .about-page-wrapper .categories-menu,
    .about-page-wrapper .categories-menu-nav,
    .about-page-wrapper .categories,
    .about-page-wrapper ul.categories,
    .about-page-wrapper .category-menu,
    .about-page-wrapper .category-nav {
      display: none !important;
      visibility: hidden !important;
      height: 0 !important;
      overflow: hidden !important;
      margin: 0 !important;
      padding: 0 !important;
      opacity: 0 !important;
      pointer-events: none !important;
    }

    /* ============================================
       PAGE À PROPOS - JUNSPRO 50/50 FUN + LUXE DOUX
       Couleurs officielles : #A78BFA → #6D28D9 → #1D4ED8
       ============================================ */
    .about-page-wrapper {
      background: linear-gradient(180deg, #F6F3FF 0%, #F1F6FF 100%) !important;
      min-height: 100vh !important;
      padding-top: 120px !important;
      padding-bottom: 80px !important;
      position: relative !important;
      overflow: hidden !important;
      -webkit-font-smoothing: antialiased !important;
      -moz-osx-font-smoothing: grayscale !important;
      text-rendering: optimizeLegibility !important;
    }
    .about-page-wrapper::before {
      content: "";
      position: absolute;
      top: 0;
      left: 50%;
      transform: translateX(-50%);
      width: 800px;
      height: 800px;
      background: radial-gradient(circle, rgba(167, 139, 250, 0.08) 0%, transparent 70%);
      pointer-events: none;
      z-index: 1;
    }
    .about-page-wrapper > * {
      position: relative;
      z-index: 2;
    }

    /* Typographie */
    .about-page-wrapper .text-primary { color: #0F172A !important; }
    .about-page-wrapper .text-secondary { color: #475569 !important; }
    .about-page-wrapper .gradient-text {
      background: linear-gradient(135deg, #A78BFA 0%, #6D28D9 50%, #1D4ED8 100%);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      background-clip: text;
    }

    /* HERO */
    .about-hero {
      text-align: center;
      padding: 60px 0 80px;
      max-width: 720px;
      margin: 0 auto;
    }
    .about-hero h1 {
      font-size: clamp(28px, 4vw, 42px);
      font-weight: 700;
      color: #0F172A;
      margin-bottom: 24px;
      line-height: 1.25;
    }
    .about-hero .hero-lead {
      font-size: 1.125rem;
      color: #475569;
      line-height: 1.7;
      margin-bottom: 20px;
    }
    .about-hero .hero-ritual {
      font-size: 1rem;
      color: #64748B;
      margin-bottom: 28px;
    }
    .about-hero .hero-ctas {
      display: flex;
      flex-wrap: wrap;
      gap: 16px;
      justify-content: center;
    }
    .about-hero .btn-junspro {
      padding: 14px 28px;
      border-radius: 12px;
      font-weight: 600;
      font-size: 1rem;
      transition: all 0.18s ease;
      text-decoration: none;
      display: inline-flex;
      align-items: center;
      gap: 8px;
    }
    .about-hero .btn-junspro-primary {
      background: linear-gradient(135deg, #A78BFA 0%, #6D28D9 50%, #1D4ED8 100%);
      color: #fff;
      border: none;
    }
    .about-hero .btn-junspro-primary:hover {
      transform: translateY(-2px);
      box-shadow: 0 8px 24px rgba(109, 40, 217, 0.35);
      color: #fff;
    }
    .about-hero .btn-junspro-outline {
      background: transparent;
      color: #6D28D9;
      border: 2px solid rgba(109, 40, 217, 0.4);
    }
    .about-hero .btn-junspro-outline:hover {
      background: rgba(109, 40, 217, 0.08);
      border-color: #6D28D9;
      color: #6D28D9;
      transform: translateY(-1px);
    }

    /* Module ludique - Le Rituel en 3 gestes */
    .about-ritual-module {
      background: rgba(255, 255, 255, 0.9);
      border-radius: 20px;
      padding: 48px 40px;
      margin-bottom: 60px;
      box-shadow: 0 4px 24px rgba(0, 0, 0, 0.06);
      border: 1px solid rgba(167, 139, 250, 0.15);
    }
    .about-ritual-module h2 {
      font-size: 1.5rem;
      font-weight: 700;
      color: #0F172A;
      margin-bottom: 32px;
      text-align: center;
    }
    .about-ritual-grid {
      display: grid;
      grid-template-columns: repeat(3, 1fr);
      gap: 24px;
      margin-bottom: 24px;
    }
    @media (max-width: 768px) {
      .about-ritual-grid { grid-template-columns: 1fr; }
    }
    .about-ritual-card {
      background: linear-gradient(135deg, #F6F3FF 0%, #F1F6FF 100%);
      border-radius: 14px;
      padding: 24px;
      text-align: center;
      transition: all 0.2s ease;
      border: 1px solid rgba(167, 139, 250, 0.12);
    }
    .about-ritual-card:hover {
      transform: translateY(-4px);
      box-shadow: 0 8px 24px rgba(109, 40, 217, 0.12);
    }
    .about-ritual-card .ritual-badge {
      font-size: 1.125rem;
      font-weight: 700;
      color: #6D28D9;
      margin-bottom: 8px;
    }
    .about-ritual-card .ritual-label {
      font-size: 1rem;
      color: #475569;
      margin-bottom: 4px;
    }
    .about-ritual-card .ritual-desc {
      font-size: 0.9375rem;
      color: #64748B;
    }
    .about-ritual-footer {
      text-align: center;
      font-size: 1rem;
      font-weight: 600;
      color: #0F172A;
    }

    /* Bloc vidéo */
    .about-video-section {
      margin-bottom: 60px;
    }
    .about-video-section h2 {
      font-size: 1.5rem;
      font-weight: 700;
      color: #0F172A;
      margin-bottom: 12px;
      text-align: center;
    }
    .about-video-section .video-subtitle {
      text-align: center;
      color: #475569;
      font-size: 1rem;
      margin-bottom: 8px;
    }
    .about-video-section .video-under {
      text-align: center;
      color: #64748B;
      font-size: 0.9375rem;
      margin-bottom: 32px;
    }
    .about-video-wrapper {
      position: relative;
      border-radius: 16px;
      overflow: hidden;
      box-shadow: 0 12px 40px rgba(0, 0, 0, 0.12);
      max-width: 720px;
      margin: 0 auto 24px;
    }
    .about-video-wrapper .about-img {
      position: relative;
      display: block;
      width: 100%;
    }
    .about-video-wrapper .about-img img {
      width: 100%;
      height: auto;
      display: block;
    }
    .about-video-wrapper .play-content {
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      z-index: 15;
    }
    .about-video-wrapper .video-btn {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      width: 70px;
      height: 70px;
      border-radius: 50%;
      background: linear-gradient(135deg, #A78BFA 0%, #6D28D9 100%) !important;
      color: #fff !important;
      text-decoration: none;
      transition: all 0.2s ease;
      border: none;
      box-shadow: 0 4px 20px rgba(109, 40, 217, 0.4);
    }
    .about-video-wrapper .video-btn:hover {
      transform: scale(1.08);
      box-shadow: 0 6px 28px rgba(109, 40, 217, 0.5);
      color: #fff !important;
    }
    /* Module Multi-casquettes ↔ Rituel Junspro — Overlays premium */
    .about-video-overlay-zone {
      position: absolute;
      inset: 0;
      pointer-events: none;
      z-index: 3;
    }
    .about-video-overlay-zone > * {
      pointer-events: auto;
    }
    .about-video-overlay-text {
      position: absolute;
      top: 20px;
      left: 20px;
      right: 20px;
      max-width: 300px;
      padding: 14px 18px;
      background: rgba(255, 255, 255, 0.72);
      backdrop-filter: blur(14px);
      -webkit-backdrop-filter: blur(14px);
      border-radius: 12px;
      border: 1px solid rgba(255, 255, 255, 0.55);
      box-shadow: 0 2px 16px rgba(0, 0, 0, 0.04);
      transition: opacity 0.18s ease;
    }
    .about-video-overlay-text .overlay-title {
      font-size: 0.625rem;
      font-weight: 600;
      letter-spacing: 0.1em;
      text-transform: uppercase;
      color: #64748B;
      margin-bottom: 6px;
    }
    .about-video-overlay-text .overlay-line {
      font-size: 0.8125rem;
      color: #475569;
      line-height: 1.45;
      margin-bottom: 2px;
    }
    .about-video-overlay-text .overlay-line:last-child {
      margin-bottom: 0;
    }
    .about-video-overlay-text .overlay-signature {
      font-size: 0.9375rem;
      font-weight: 600;
      color: #0F172A;
      letter-spacing: 0.02em;
      margin: 8px 0 4px 0;
      line-height: 1.35;
    }
    .about-video-segmented {
      position: absolute;
      top: 20px;
      right: 20px;
      display: flex;
      background: rgba(255, 255, 255, 0.78);
      backdrop-filter: blur(14px);
      -webkit-backdrop-filter: blur(14px);
      border-radius: 10px;
      padding: 4px;
      border: 1px solid rgba(255, 255, 255, 0.5);
      box-shadow: 0 2px 12px rgba(0, 0, 0, 0.05);
      transition: all 0.18s ease;
    }
    .about-video-segmented-btn {
      padding: 8px 14px;
      font-size: 0.8125rem;
      font-weight: 500;
      color: #64748B;
      background: transparent;
      border: none;
      border-radius: 8px;
      cursor: pointer;
      transition: all 0.15s ease;
      white-space: nowrap;
    }
    .about-video-segmented-btn:hover {
      color: #6D28D9;
    }
    .about-video-segmented-btn.active {
      background: rgba(255, 255, 255, 0.95);
      color: #6D28D9;
      box-shadow: 0 1px 4px rgba(0, 0, 0, 0.06);
    }
    @media (max-width: 576px) {
      .about-video-overlay-zone {
        display: flex;
        flex-direction: column;
        align-items: stretch;
        padding: 12px;
        gap: 12px;
      }
      .about-video-overlay-text {
        position: relative;
        top: 0;
        left: 0;
        right: 0;
        max-width: none;
        padding: 12px 14px;
        margin-bottom: 0;
        order: 1;
      }
      .about-video-overlay-text .overlay-title { font-size: 0.5625rem; }
      .about-video-overlay-text .overlay-line { font-size: 0.75rem; }
      .about-video-overlay-text .overlay-signature { font-size: 0.875rem; }
      .about-video-segmented {
        position: relative;
        top: 0;
        right: 0;
        align-self: flex-start;
        flex-shrink: 0;
        order: 2;
      }
      .about-video-segmented-btn {
        padding: 6px 10px;
        font-size: 0.75rem;
      }
    }
    .about-video-pills {
      display: flex;
      flex-wrap: wrap;
      gap: 12px;
      justify-content: center;
      margin-top: 24px;
    }
    .about-video-pill {
      padding: 10px 18px;
      border-radius: 999px;
      font-size: 0.875rem;
      font-weight: 500;
      cursor: pointer;
      transition: all 0.18s ease;
      border: 1px solid rgba(109, 40, 217, 0.25);
      background: #fff;
      color: #475569;
    }
    .about-video-pill:hover,
    .about-video-pill.active {
      background: linear-gradient(135deg, rgba(167, 139, 250, 0.15) 0%, rgba(109, 40, 217, 0.1) 100%);
      border-color: rgba(109, 40, 217, 0.4);
      color: #6D28D9;
    }
    .about-video-pill-text {
      text-align: center;
      margin-top: 16px;
      min-height: 48px;
      font-size: 0.9375rem;
      color: #475569;
      transition: opacity 0.18s ease;
    }
    .about-video-pills-wrapper {
      min-height: 80px;
    }

    /* Tabs abonnement */
    .about-tabs-section {
      margin-bottom: 60px;
    }
    .about-tabs-section h2 {
      font-size: 1.5rem;
      font-weight: 700;
      color: #0F172A;
      margin-bottom: 12px;
      text-align: center;
    }
    .about-tabs-section .tabs-lead {
      text-align: center;
      color: #475569;
      font-size: 1rem;
      margin-bottom: 28px;
    }
    .about-tabs-nav {
      display: flex;
      flex-wrap: wrap;
      gap: 8px;
      justify-content: center;
      margin-bottom: 24px;
      border-bottom: 1px solid #E2E8F0;
      padding-bottom: 0;
    }
    .about-tabs-btn {
      padding: 14px 24px;
      font-size: 0.9375rem;
      font-weight: 500;
      color: #64748B;
      background: transparent;
      border: none;
      cursor: pointer;
      position: relative;
      transition: all 0.18s ease;
      border-radius: 8px 8px 0 0;
    }
    .about-tabs-btn:hover {
      color: #6D28D9;
    }
    .about-tabs-btn.active {
      color: #6D28D9;
      font-weight: 600;
    }
    .about-tabs-btn.active::after {
      content: '';
      position: absolute;
      bottom: -1px;
      left: 0;
      right: 0;
      height: 2px;
      background: linear-gradient(90deg, #A78BFA, #6D28D9);
      border-radius: 2px;
    }
    .about-tabs-panel {
      display: none;
      padding: 24px;
      background: rgba(246, 243, 255, 0.5);
      border-radius: 12px;
      font-size: 1rem;
      color: #475569;
      line-height: 1.6;
      transition: opacity 0.2s ease;
    }
    .about-tabs-panel.active {
      display: block;
    }

    /* Bloc photo laptop */
    .about-laptop-section {
      margin-bottom: 60px;
    }
    .about-laptop-section h2 {
      font-size: 1.5rem;
      font-weight: 700;
      color: #0F172A;
      margin-bottom: 24px;
      text-align: center;
    }
    .about-laptop-grid {
      display: grid;
      grid-template-columns: repeat(3, 1fr);
      gap: 20px;
      margin-top: 24px;
    }
    @media (max-width: 768px) {
      .about-laptop-grid { grid-template-columns: 1fr; }
    }
    .about-laptop-card {
      text-align: center;
      padding: 20px;
      border-radius: 12px;
      background: rgba(255, 255, 255, 0.8);
      border: 1px solid rgba(167, 139, 250, 0.12);
      transition: all 0.2s ease;
    }
    .about-laptop-card:hover {
      transform: translateY(-2px);
      box-shadow: 0 6px 20px rgba(0, 0, 0, 0.06);
    }
    .about-laptop-card .card-label {
      font-size: 0.875rem;
      font-weight: 600;
      color: #6D28D9;
      margin-bottom: 8px;
    }
    .about-laptop-card .card-text {
      font-size: 0.9375rem;
      color: #475569;
    }
    .about-laptop-note {
      text-align: center;
      margin-top: 24px;
      font-size: 0.9375rem;
      color: #64748B;
      font-style: italic;
    }

    /* Mythes vs Réalité - Accordion */
    .about-myths-section {
      margin-bottom: 60px;
    }
    .about-myths-section h2 {
      font-size: 1.5rem;
      font-weight: 700;
      color: #0F172A;
      margin-bottom: 28px;
      text-align: center;
    }
    .about-myth-accordion {
      max-width: 640px;
      margin: 0 auto;
    }
    .about-myth-item {
      border: 1px solid #E2E8F0;
      border-radius: 12px;
      margin-bottom: 12px;
      overflow: hidden;
      transition: all 0.18s ease;
    }
    .about-myth-item:hover {
      border-color: rgba(109, 40, 217, 0.25);
    }
    .about-myth-item.open {
      border-color: rgba(109, 40, 217, 0.35);
      box-shadow: 0 4px 16px rgba(109, 40, 217, 0.08);
    }
    .about-myth-trigger {
      width: 100%;
      padding: 18px 22px;
      text-align: left;
      font-size: 0.9375rem;
      font-weight: 500;
      color: #0F172A;
      background: #fff;
      border: none;
      cursor: pointer;
      display: flex;
      justify-content: space-between;
      align-items: center;
      transition: all 0.18s ease;
    }
    .about-myth-trigger:hover {
      background: #F8FAFC;
    }
    .about-myth-trigger i {
      transition: transform 0.2s ease;
      color: #6D28D9;
    }
    .about-myth-item.open .about-myth-trigger i {
      transform: rotate(180deg);
    }
    .about-myth-content {
      max-height: 0;
      overflow: hidden;
      transition: max-height 0.25s ease;
    }
    .about-myth-item.open .about-myth-content {
      max-height: 300px;
    }
    .about-myth-content-inner {
      padding: 0 22px 18px;
      font-size: 0.9375rem;
      color: #475569;
      line-height: 1.6;
    }

    /* 6 Univers - Cartes premium */
    .about-univers-section {
      margin-bottom: 60px;
    }
    .about-univers-section h2 {
      font-size: 1.5rem;
      font-weight: 700;
      color: #0F172A;
      margin-bottom: 12px;
      text-align: center;
    }
    .about-univers-grid {
      margin-top: 24px;
      display: grid;
      grid-template-columns: repeat(3, 1fr);
      gap: 20px;
    }
    @media (max-width: 992px) {
      .about-univers-grid { grid-template-columns: repeat(2, 1fr); }
    }
    @media (max-width: 576px) {
      .about-univers-grid { grid-template-columns: 1fr; }
    }
    .about-univers-card {
      background: #fff;
      border-radius: 14px;
      padding: 24px;
      border: 1px solid #E2E8F0;
      transition: all 0.2s ease;
      text-decoration: none;
      color: inherit;
      display: block;
      position: relative;
      overflow: hidden;
    }
    .about-univers-card:hover {
      transform: translateY(-6px);
      box-shadow: 0 12px 32px rgba(0, 0, 0, 0.1);
      border-color: rgba(109, 40, 217, 0.2);
    }
    .about-univers-card .card-title {
      font-size: 1.0625rem;
      font-weight: 700;
      color: #0F172A;
      margin-bottom: 8px;
    }
    .about-univers-card .card-desc {
      font-size: 0.9375rem;
      color: #475569;
      margin-bottom: 12px;
      line-height: 1.5;
    }
    .about-univers-card .card-cta {
      font-size: 0.875rem;
      font-weight: 600;
      color: #6D28D9;
      opacity: 0;
      transition: opacity 0.18s ease;
    }
    .about-univers-card:hover .card-cta {
      opacity: 1;
    }

    /* Slider partenaires - Système haut de gamme */
    .about-partners-section {
      margin-bottom: 60px;
    }
    .about-partners-section h2 {
      font-size: 1.5rem;
      font-weight: 700;
      color: #0F172A;
      margin-bottom: 12px;
      text-align: center;
    }
    .about-partners-section .partners-lead {
      text-align: center;
      color: #475569;
      font-size: 1rem;
      margin-bottom: 36px;
    }
    .about-partners-slider-wrapper {
      position: relative;
      padding: 0 56px;
    }
    .about-partners-slider {
      overflow: hidden;
      padding-bottom: 48px;
    }
    .about-partners-slider .item-single {
      padding: 28px 20px;
      transition: all 0.35s cubic-bezier(0.4, 0, 0.2, 1);
    }
    .about-partners-slider .sponsor-img {
      filter: grayscale(100%);
      opacity: 0.55;
      transition: all 0.35s cubic-bezier(0.4, 0, 0.2, 1);
    }
    .about-partners-slider .item-single:hover .sponsor-img {
      filter: grayscale(0%);
      opacity: 1;
      transform: scale(1.05);
    }
    .about-partners-slider .sponsor-img img {
      max-height: 52px;
      width: auto;
      object-fit: contain;
    }
    .about-partners-slider .swiper-button-prev,
    .about-partners-slider .swiper-button-next {
      width: 48px;
      height: 48px;
      border-radius: 50%;
      background: rgba(255,255,255,0.95);
      color: #6D28D9;
      box-shadow: 0 4px 20px rgba(109, 40, 217, 0.15);
      transition: all 0.3s ease;
    }
    .about-partners-slider .swiper-button-prev::after,
    .about-partners-slider .swiper-button-next::after {
      font-size: 16px;
      font-weight: bold;
    }
    .about-partners-slider .swiper-button-prev:hover,
    .about-partners-slider .swiper-button-next:hover {
      background: linear-gradient(135deg, #A78BFA, #6D28D9);
      color: #fff;
      box-shadow: 0 6px 24px rgba(109, 40, 217, 0.3);
      transform: scale(1.08);
    }
    .about-partners-slider .swiper-button-disabled {
      opacity: 0.35;
      cursor: not-allowed;
    }
    .about-partners-slider .swiper-pagination {
      position: relative;
      margin-top: 2rem;
    }
    .about-partners-slider .swiper-pagination .swiper-pagination-bullet {
      background: #CBD5E1;
      opacity: 0.7;
      width: 10px;
      height: 10px;
      transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }
    .about-partners-slider .swiper-pagination .swiper-pagination-bullet-active {
      background: linear-gradient(135deg, #A78BFA, #6D28D9);
      opacity: 1;
      transform: scale(1.35);
      box-shadow: 0 2px 8px rgba(109, 40, 217, 0.4);
    }
    @media (max-width: 767px) {
      .about-partners-slider-wrapper {
        padding: 0 44px;
      }
      .about-partners-slider .swiper-button-prev,
      .about-partners-slider .swiper-button-next {
        width: 40px;
        height: 40px;
      }
      .about-partners-slider .swiper-button-prev::after,
      .about-partners-slider .swiper-button-next::after {
        font-size: 14px;
      }
    }

    /* CTA final */
    .about-cta-final {
      text-align: center;
      padding: 56px 24px;
      background: linear-gradient(135deg, rgba(167, 139, 250, 0.12) 0%, rgba(29, 78, 216, 0.08) 100%);
      border-radius: 20px;
      margin-bottom: 40px;
      border: 1px solid rgba(109, 40, 217, 0.15);
    }
    .about-cta-final h2 {
      font-size: 1.5rem;
      font-weight: 700;
      color: #0F172A;
      margin-bottom: 12px;
    }
    .about-cta-final .cta-lead {
      color: #475569;
      font-size: 1rem;
      margin-bottom: 28px;
    }
    .about-cta-final .cta-btns {
      display: flex;
      flex-wrap: wrap;
      gap: 16px;
      justify-content: center;
    }
    .about-cta-final .stripe-note {
      margin-top: 24px;
      font-size: 0.8125rem;
      color: #94A3B8;
    }
  </style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
  <div class="about-page-wrapper">
    <div class="container">
      
      <section class="about-hero">
        <h1>Moins de pression. Plus de progrès.</h1>
        <p class="hero-lead">Junspro est né d'une conviction : ce qui fait avancer un projet, ce n'est pas la pression — c'est la discipline. Une discipline douce, progressive, qui respecte l'humain… sans laisser la procrastination s'installer.</p>
        <p class="hero-ritual">Un Rituel = 1h : 50 minutes de focus + 10 minutes de feedback / rapport.<br>Rituel après rituel, l'élan devient résultat.</p>
        <div class="hero-ctas">
          <a href="<?php echo e(route('mission.form')); ?>" class="btn btn-junspro btn-junspro-primary">Entrer dans l'expérience</a>
          <a href="<?php echo e(route('faq')); ?>" class="btn btn-junspro btn-junspro-outline">Comprendre le Rituel</a>
        </div>
      </section>

      
      <section class="about-ritual-module">
        <h2>Le Rituel, en 3 gestes</h2>
        <div class="about-ritual-grid">
          <div class="about-ritual-card">
            <div class="ritual-badge">50 min — Focus</div>
            <div class="ritual-label">On fait. (vraiment)</div>
          </div>
          <div class="about-ritual-card">
            <div class="ritual-badge">10 min — Feedback</div>
            <div class="ritual-label">On clarifie. (tout de suite)</div>
          </div>
          <div class="about-ritual-card">
            <div class="ritual-badge">Rapport</div>
            <div class="ritual-label">Décisions nettes. Prochaine étape claire.</div>
          </div>
      </div>
        <p class="about-ritual-footer">Petit cadre. Gros impact.</p>
      </section>

      
      <?php if(isset($secInfo) && $secInfo->about_section_status == 1 && isset($aboutInfo) && !empty($aboutInfo->about_section_image)): ?>
        <section class="about-video-section" x-data="{ casquetteMode: 'multi' }">
          <div class="about-video-wrapper">
                <div class="about-img">
              <img data-src="<?php echo e(asset('assets/img/' . $aboutInfo->about_section_image)); ?>" alt="Multi-casquettes vs Rituel Junspro" class="lazyload">
                  <?php if(!empty($aboutInfo->about_section_video_link)): ?>
                    <div class="play-content text-center">
                  <a href="<?php echo e($aboutInfo->about_section_video_link); ?>" class="video-btn video-btn-white youtube-popup p-absolute" aria-label="Lire la vidéo">
                    <i class="fas fa-play"></i>
                  </a>
                    </div>
                  <?php endif; ?>
                </div>
          </div>
        </section>
      <?php endif; ?>

      
      <section class="about-tabs-section" x-data="{ tab: 'ajouter' }">
        <h2>Choisissez votre rythme</h2>
        <p class="tabs-lead">Un abonnement pensé pour la vraie vie.<br>"Vous gardez la maîtrise. Nous gardons le cadre."</p>
        <div class="about-tabs-nav">
          <button type="button" class="about-tabs-btn" :class="{ active: tab === 'ajouter' }" @click="tab = 'ajouter'">Ajouter</button>
          <button type="button" class="about-tabs-btn" :class="{ active: tab === 'pause' }" @click="tab = 'pause'">Pause</button>
          <button type="button" class="about-tabs-btn" :class="{ active: tab === 'transférer' }" @click="tab = 'transférer'">Transférer</button>
        </div>
        <div class="about-tabs-panel" :class="{ active: tab === 'ajouter' }">
          <strong>Besoin d'accélérer ?</strong> Ajoutez des heures.
        </div>
        <div class="about-tabs-panel" :class="{ active: tab === 'pause' }">
          <strong>Une pause ?</strong> OK. Le cadre reste là.
        </div>
        <div class="about-tabs-panel" :class="{ active: tab === 'transférer' }">
          <strong>Changer d'accompagnement ?</strong> Possible, sans perdre vos heures.
      </div>
    </section>

      
      <?php if(isset($secInfo) && $secInfo->about_section_status == 1 && isset($aboutInfo) && !empty($aboutInfo->about_section_image)): ?>
        <section class="about-laptop-section">
          <h2>Un cadre qui protège le concret.</h2>
          <div class="row align-items-center">
            <div class="col-lg-6">
              <div class="about-img-box mb-4">
                <img data-src="<?php echo e(asset('assets/img/' . $aboutInfo->about_section_image)); ?>" alt="Cadre Junspro" class="lazyload rounded-3" style="width: 100%; height: auto;">
              </div>
            </div>
            <div class="col-lg-6">
              <div class="about-laptop-grid">
                <div class="about-laptop-card">
                  <div class="card-label">Client</div>
                  <p class="card-text">Un cap. Un cadre. Une trajectoire claire.</p>
                </div>
                <div class="about-laptop-card">
                  <div class="card-label">Freelance</div>
                  <p class="card-text">Progression réelle, sans pression artificielle.</p>
          </div>
                <div class="about-laptop-card">
                  <div class="card-label">Humain</div>
                  <p class="card-text">Un rythme soutenable. Une discipline paisible.</p>
                </div>
              </div>
              <p class="about-laptop-note">Le cadre peut sembler exigeant. En réalité, il sécurise.</p>
                                </div>
                              </div>
        </section>
      <?php endif; ?>

      
      <section class="about-myths-section" x-data="{ open: 1 }">
        <h2>Mythes vs Réalité</h2>
        <div class="about-myth-accordion">
          <div class="about-myth-item" :class="{ open: open === 1 }">
            <button type="button" class="about-myth-trigger" @click="open = open === 1 ? 0 : 1">
              <span>Mythe "Il faut se mettre la pression."</span>
              <i class="fas fa-chevron-down"></i>
            </button>
            <div class="about-myth-content">
              <div class="about-myth-content-inner">Réalité : Un cadre régulier fait avancer plus loin — et plus sereinement.</div>
                              </div>
                            </div>
          <div class="about-myth-item" :class="{ open: open === 2 }">
            <button type="button" class="about-myth-trigger" @click="open = open === 2 ? 0 : 2">
              <span>Mythe "Je paye du temps."</span>
              <i class="fas fa-chevron-down"></i>
            </button>
            <div class="about-myth-content">
              <div class="about-myth-content-inner">Réalité : Vous investissez dans une méthode : focus + feedback + rapport.</div>
                          </div>
                        </div>
          <div class="about-myth-item" :class="{ open: open === 3 }">
            <button type="button" class="about-myth-trigger" @click="open = open === 3 ? 0 : 3">
              <span>Mythe "Il faut être parfait."</span>
              <i class="fas fa-chevron-down"></i>
            </button>
            <div class="about-myth-content">
              <div class="about-myth-content-inner">Réalité : On progresse. Parfois on tombe. Puis on revient plus fort.</div>
                  </div>
                </div>
          <div class="about-myth-item" :class="{ open: open === 4 }">
            <button type="button" class="about-myth-trigger" @click="open = open === 4 ? 0 : 4">
              <span>Mythe "Une plateforme, c'est impersonnel."</span>
              <i class="fas fa-chevron-down"></i>
            </button>
            <div class="about-myth-content">
              <div class="about-myth-content-inner">Réalité : Ici, on protège la relation et le concret.</div>
              </div>
          </div>
        </div>
      </section>

      
      <section class="about-univers-section">
        <h2>6 univers. Un langage commun : le Rituel.</h2>
        <div class="about-univers-grid">
          <a href="<?php echo e(route('services.projects')); ?>" class="about-univers-card">
            <div class="card-title">Projet & Consulting</div>
            <p class="card-desc">Clarifier, structurer… décider juste.</p>
            <span class="card-cta">Explorer →</span>
          </a>
          <a href="<?php echo e(route('services.lessons')); ?>" class="about-univers-card">
            <div class="card-title">Cours & Tutorat</div>
            <p class="card-desc">Apprendre vite — et bien.</p>
            <span class="card-cta">Explorer →</span>
          </a>
          <a href="<?php echo e(route('services.at-home')); ?>" class="about-univers-card">
            <div class="card-title">At home Rituals Services</div>
            <p class="card-desc">Simplifier la vie, simplement.</p>
            <span class="card-cta">Explorer →</span>
          </a>
          <a href="<?php echo e(route('services.wellnesslive')); ?>" class="about-univers-card">
            <div class="card-title">Ritual Motion</div>
            <p class="card-desc">Bouger. Tenir. Progresser.</p>
            <span class="card-cta">Explorer →</span>
          </a>
          <a href="<?php echo e(route('services.corporate')); ?>" class="about-univers-card">
            <div class="card-title">Présence</div>
            <p class="card-desc">Gagner en impact, naturellement.</p>
            <span class="card-cta">Explorer →</span>
          </a>
          <a href="<?php echo e(route('services.homeswap')); ?>" class="about-univers-card">
            <div class="card-title">Échange de logement</div>
            <p class="card-desc">Changer d'air… intelligemment.</p>
            <span class="card-cta">Explorer →</span>
          </a>
      </div>
    </section>

      
      <?php if(isset($secInfo) && $secInfo->partners_section_status == 1 && count($partners ?? []) > 0): ?>
        <section class="about-partners-section">
          <h2>Ils avancent avec nous</h2>
          <p class="partners-lead">Partenaires, outils, écosystème — sélectionnés pour servir une expérience fiable et exigeante.</p>
          <div class="about-partners-slider-wrapper">
            <div class="swiper about-partners-slider">
              <div class="swiper-wrapper">
                <?php $__currentLoopData = $partners; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $partner): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <div class="swiper-slide">
                    <div class="item-single d-flex justify-content-center align-items-center">
                      <a href="<?php echo e($partner->url); ?>" target="_blank" rel="noopener">
                        <div class="sponsor-img">
                          <img class="lazyload" data-src="<?php echo e(asset('assets/img/partners/' . $partner->image)); ?>" alt="Partenaire">
                        </div>
                      </a>
                    </div>
                  </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </div>
              <div class="swiper-button-prev"></div>
              <div class="swiper-button-next"></div>
              <div class="swiper-pagination"></div>
            </div>
          </div>
        </section>
      <?php endif; ?>

      
      <section class="about-cta-final">
        <h2>Prêt pour votre premier Rituel ?</h2>
        <p class="cta-lead">Un cadre simple, un rythme humain, des résultats visibles.</p>
        <div class="cta-btns">
          <a href="<?php echo e(route('mission.form')); ?>" class="btn btn-junspro btn-junspro-primary">Commencer</a>
          <a href="<?php echo e(route('faq')); ?>" class="btn btn-junspro btn-junspro-outline">Voir comment fonctionne un Rituel</a>
        </div>
        <p class="stripe-note">Paiement sécurisé par Stripe.</p>
      </section>
              </div>
            </div>

  
  <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
  
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      var el = document.querySelector('.about-partners-slider');
      if (el && typeof Swiper !== 'undefined') {
        new Swiper('.about-partners-slider', {
          speed: 800,
          loop: true,
          spaceBetween: 32,
          slidesPerView: 4,
          autoplay: {
            delay: 4000,
            disableOnInteraction: false,
          },
          pagination: {
            el: '.about-partners-slider .swiper-pagination',
            clickable: true,
          },
          navigation: {
            nextEl: '.about-partners-slider .swiper-button-next',
            prevEl: '.about-partners-slider .swiper-button-prev',
          },
          breakpoints: {
            320: { slidesPerView: 1, spaceBetween: 20 },
            480: { slidesPerView: 2, spaceBetween: 24 },
            768: { slidesPerView: 3, spaceBetween: 28 },
            1024: { slidesPerView: 4, spaceBetween: 32 },
          },
          on: {
            init: function() {
              this.update();
              if (this.navigation) this.navigation.update();
            },
            slideChange: function() {
              if (this.navigation) this.navigation.update();
            },
          },
        });
      }
    });
  </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\younes\Downloads\junspro-main (1)\junspro-main3\resources\views\frontend\aboutus.blade.php ENDPATH**/ ?>