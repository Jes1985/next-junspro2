@extends('frontend.layout')

@section('pageHeading')Devenir Membre NEXUS@endsection

@section('style')
  <style>
    /* ============================================================
       NEXUS Become Member — Ultra Luxury Theme
       Cercle d'Or : WHY → HOW → WHAT
    ============================================================ */
    :root {
      --nexus-dark: #0a0f1e;
      --nexus-deep: #111827;
      --nexus-gold: #c9a84c;
      --nexus-gold-light: #f0d080;
      --nexus-white: #f9fafb;
      --nexus-gradient: linear-gradient(135deg, #0a0f1e 0%, #1e1b4b 50%, #312e81 100%);
      --nexus-gradient-gold: linear-gradient(135deg, #c9a84c 0%, #f0d080 50%, #c9a84c 100%);
      --nexus-gradient-light: linear-gradient(135deg, #f8f6ff 0%, #fef9ee 100%);
    }

    .nexus-become-page {
      font-family: 'Inter', sans-serif;
      color: #1a202c;
    }

    /* ===== HERO ===== */
    .nexus-hero {
      background: var(--nexus-gradient);
      padding: 7rem 0 6rem;
      min-height: 90vh;
      display: flex;
      align-items: center;
      position: relative;
      overflow: hidden;
    }

    .nexus-hero::before {
      content: '';
      position: absolute;
      inset: 0;
      background: url('https://images.unsplash.com/photo-1600596542815-ffad4c1539a9?w=1600&q=80') center/cover no-repeat;
      opacity: 0.12;
    }

    .nexus-hero-container {
      max-width: 1200px;
      margin: 0 auto;
      padding: 0 2rem;
      position: relative;
      z-index: 1;
      width: 100%;
    }

    .nexus-hero-content {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 4rem;
      align-items: center;
    }

    .nexus-hero-badge {
      display: inline-flex;
      align-items: center;
      gap: 0.5rem;
      background: rgba(201, 168, 76, 0.15);
      border: 1px solid rgba(201, 168, 76, 0.4);
      color: var(--nexus-gold-light);
      padding: 0.4rem 1rem;
      border-radius: 100px;
      font-size: 0.8rem;
      font-weight: 600;
      letter-spacing: 0.1em;
      text-transform: uppercase;
      margin-bottom: 1.5rem;
    }

    .nexus-hero-text h1 {
      font-size: 3.5rem;
      font-weight: 800;
      color: #fff;
      line-height: 1.15;
      margin-bottom: 1.5rem;
      letter-spacing: -0.02em;
    }

    .nexus-hero-text h1 span {
      background: var(--nexus-gradient-gold);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      background-clip: text;
    }

    .nexus-hero-text .subtitle {
      font-size: 1.2rem;
      color: rgba(255,255,255,0.72);
      line-height: 1.75;
      margin-bottom: 2.5rem;
    }

    .nexus-hero-cta {
      display: flex;
      gap: 1rem;
      flex-wrap: wrap;
    }

    .btn-nexus-primary {
      display: inline-flex;
      align-items: center;
      gap: 0.6rem;
      background: var(--nexus-gradient-gold);
      color: #0a0f1e !important;
      padding: 1rem 2.5rem;
      border-radius: 100px;
      font-weight: 700;
      font-size: 1rem;
      text-decoration: none !important;
      transition: all 0.3s ease;
      box-shadow: 0 4px 24px rgba(201, 168, 76, 0.35);
    }

    .btn-nexus-primary:hover {
      transform: translateY(-2px);
      box-shadow: 0 8px 32px rgba(201, 168, 76, 0.5);
    }

    .btn-nexus-secondary {
      display: inline-flex;
      align-items: center;
      gap: 0.6rem;
      background: transparent;
      color: rgba(255,255,255,0.85) !important;
      border: 1.5px solid rgba(255,255,255,0.3);
      padding: 1rem 2rem;
      border-radius: 100px;
      font-weight: 600;
      font-size: 1rem;
      text-decoration: none !important;
      transition: all 0.3s ease;
    }

    .btn-nexus-secondary:hover {
      background: rgba(255,255,255,0.08);
      border-color: rgba(255,255,255,0.5);
      color: #fff !important;
    }

    .nexus-hero-image img {
      width: 100%;
      border-radius: 24px;
      object-fit: cover;
      aspect-ratio: 4/3;
      box-shadow: 0 32px 80px rgba(0,0,0,0.6);
      border: 1px solid rgba(201, 168, 76, 0.3);
    }

    .nexus-hero-stats {
      display: flex;
      gap: 2.5rem;
      margin-top: 2.5rem;
      padding-top: 2rem;
      border-top: 1px solid rgba(255,255,255,0.12);
    }

    .nexus-hero-stat .stat-num {
      display: block;
      font-size: 1.75rem;
      font-weight: 800;
      color: var(--nexus-gold-light);
    }

    .nexus-hero-stat .stat-label {
      font-size: 0.78rem;
      color: rgba(255,255,255,0.5);
      text-transform: uppercase;
      letter-spacing: 0.08em;
    }

    /* ===== SECTION LAYOUT COMMUN ===== */
    .nexus-section {
      padding: 6rem 0;
    }

    .nexus-container {
      max-width: 1200px;
      margin: 0 auto;
      padding: 0 2rem;
    }

    .nexus-section-badge {
      display: inline-block;
      background: linear-gradient(135deg, rgba(201,168,76,0.12), rgba(201,168,76,0.06));
      border: 1px solid rgba(201,168,76,0.3);
      color: #92640a;
      padding: 0.3rem 0.9rem;
      border-radius: 100px;
      font-size: 0.75rem;
      font-weight: 700;
      letter-spacing: 0.1em;
      text-transform: uppercase;
      margin-bottom: 1rem;
    }

    .nexus-section-title {
      font-size: 2.75rem;
      font-weight: 800;
      color: #0a0f1e;
      margin-bottom: 1.2rem;
      letter-spacing: -0.02em;
      line-height: 1.2;
    }

    .nexus-section-sub {
      font-size: 1.1rem;
      color: #6b7280;
      line-height: 1.8;
      max-width: 640px;
    }

    /* ===== WHY — Pourquoi NEXUS ===== */
    .nexus-why {
      background: var(--nexus-gradient-light);
    }

    .nexus-why-grid {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 5rem;
      align-items: center;
      margin-top: 1rem;
    }

    .nexus-why-cards {
      display: grid;
      gap: 1.25rem;
      margin-top: 2rem;
    }

    .nexus-why-card {
      background: #fff;
      border-radius: 16px;
      padding: 1.5rem 1.75rem;
      display: flex;
      align-items: flex-start;
      gap: 1.25rem;
      box-shadow: 0 2px 12px rgba(0,0,0,0.05);
      border: 1px solid rgba(201,168,76,0.15);
      transition: transform 0.25s, box-shadow 0.25s;
    }

    .nexus-why-card:hover {
      transform: translateY(-3px);
      box-shadow: 0 10px 32px rgba(0,0,0,0.09);
    }

    .nexus-why-icon {
      width: 50px;
      height: 50px;
      border-radius: 12px;
      background: linear-gradient(135deg, #0a0f1e, #312e81);
      display: flex;
      align-items: center;
      justify-content: center;
      flex-shrink: 0;
      font-size: 1.35rem;
    }

    .nexus-why-card-title {
      font-size: 1rem;
      font-weight: 700;
      color: #0a0f1e;
      margin-bottom: 0.35rem;
    }

    .nexus-why-card-text {
      font-size: 0.875rem;
      color: #6b7280;
      line-height: 1.6;
      margin: 0;
    }

    .nexus-why-image img {
      width: 100%;
      border-radius: 24px;
      object-fit: cover;
      aspect-ratio: 3 / 4;
      object-position: center top;
      box-shadow: 0 20px 60px rgba(0,0,0,0.13);
    }

    /* ===== DOMAINS — Les Espaces ===== */
    .nexus-domains {
      background: #fff;
    }

    .nexus-domains-header {
      text-align: center;
      margin-bottom: 3.5rem;
    }

    .nexus-domains-grid {
      display: grid;
      grid-template-columns: repeat(3, 1fr);
      gap: 2rem;
    }

    .nexus-domain-card {
      background: var(--nexus-dark);
      border-radius: 24px;
      overflow: hidden;
      position: relative;
      transition: transform 0.3s, box-shadow 0.3s;
      border: 1px solid rgba(255,255,255,0.04);
    }

    .nexus-domain-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 24px 64px rgba(0,0,0,0.28);
    }

    .nexus-domain-img {
      width: 100%;
      aspect-ratio: 4 / 3;
      object-fit: cover;
      opacity: 0.6;
      display: block;
    }

    .nexus-domain-overlay {
      position: absolute;
      inset: 0;
      background: linear-gradient(to top, rgba(10,15,30,0.97) 35%, rgba(10,15,30,0.05) 80%);
      padding: 1.5rem;
      display: flex;
      flex-direction: column;
      justify-content: flex-end;
    }

    .nexus-domain-icon {
      font-size: 1.75rem;
      margin-bottom: 0.4rem;
    }

    .nexus-domain-title {
      font-size: 1.1rem;
      font-weight: 800;
      color: #fff;
      margin-bottom: 0.75rem;
    }

    .nexus-domain-tags {
      display: flex;
      flex-wrap: wrap;
      gap: 0.4rem;
    }

    .nexus-domain-tag {
      background: rgba(255,255,255,0.1);
      border: 1px solid rgba(255,255,255,0.18);
      color: rgba(255,255,255,0.82);
      padding: 0.25rem 0.7rem;
      border-radius: 100px;
      font-size: 0.73rem;
      font-weight: 500;
    }

    .nexus-domain-tag.gold {
      background: rgba(201,168,76,0.2);
      border-color: rgba(201,168,76,0.45);
      color: var(--nexus-gold-light);
    }

    /* ===== HOW — Comment ça marche ===== */
    .nexus-how {
      background: linear-gradient(180deg, #0a0f1e 0%, #1a1042 100%);
      position: relative;
      overflow: hidden;
    }

    .nexus-how::before {
      content: '';
      position: absolute;
      top: -120px;
      right: -120px;
      width: 700px;
      height: 700px;
      background: radial-gradient(circle, rgba(201,168,76,0.07) 0%, transparent 70%);
      pointer-events: none;
    }

    .nexus-how .nexus-section-badge {
      background: rgba(201,168,76,0.15);
      border-color: rgba(201,168,76,0.3);
      color: var(--nexus-gold-light);
    }

    .nexus-how .nexus-section-title { color: #fff; }
    .nexus-how .nexus-section-sub   { color: rgba(255,255,255,0.55); }

    .nexus-how-header {
      text-align: center;
      margin-bottom: 4rem;
    }

    .nexus-steps {
      display: grid;
      grid-template-columns: repeat(4, 1fr);
      gap: 2rem;
      position: relative;
    }

    .nexus-steps::before {
      content: '';
      position: absolute;
      top: 28px;
      left: calc(12.5% + 28px);
      right: calc(12.5% + 28px);
      height: 1px;
      background: linear-gradient(90deg, transparent, rgba(201,168,76,0.35), rgba(201,168,76,0.35), transparent);
    }

    .nexus-step {
      text-align: center;
      position: relative;
      z-index: 1;
    }

    .nexus-step-num {
      width: 56px;
      height: 56px;
      border-radius: 50%;
      background: var(--nexus-gradient-gold);
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 1.2rem;
      font-weight: 800;
      color: #0a0f1e;
      margin: 0 auto 1.5rem;
      box-shadow: 0 4px 20px rgba(201,168,76,0.4);
    }

    .nexus-step h3 {
      font-size: 0.98rem;
      font-weight: 700;
      color: #fff;
      margin-bottom: 0.6rem;
    }

    .nexus-step p {
      font-size: 0.86rem;
      color: rgba(255,255,255,0.52);
      line-height: 1.65;
      margin: 0;
    }

    /* ===== POINTS SYSTEM ===== */
    .nexus-points {
      background: var(--nexus-gradient-light);
    }

    .nexus-points-content {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 5rem;
      align-items: center;
    }

    .nexus-points-visual {
      position: relative;
    }

    .nexus-points-visual img {
      width: 100%;
      border-radius: 24px;
      object-fit: cover;
      aspect-ratio: 3 / 4;
      box-shadow: 0 20px 60px rgba(0,0,0,0.11);
    }

    .nexus-points-badge {
      position: absolute;
      bottom: -1.5rem;
      right: -1.5rem;
      background: linear-gradient(135deg, #0a0f1e, #1e1b4b);
      color: #fff;
      border-radius: 16px;
      padding: 1.25rem 1.75rem;
      box-shadow: 0 8px 32px rgba(0,0,0,0.3);
      border: 1px solid rgba(201,168,76,0.3);
      text-align: center;
    }

    .nexus-points-badge .big-num {
      display: block;
      font-size: 1.35rem;
      font-weight: 800;
      background: var(--nexus-gradient-gold);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      background-clip: text;
    }

    .nexus-points-badge .big-label {
      font-size: 0.72rem;
      color: rgba(255,255,255,0.55);
      text-transform: uppercase;
      letter-spacing: 0.08em;
    }

    .nexus-points-list {
      display: grid;
      gap: 1.25rem;
      margin-top: 2rem;
    }

    .nexus-points-item {
      display: flex;
      align-items: flex-start;
      gap: 0.9rem;
    }

    .nexus-points-dot {
      width: 8px;
      height: 8px;
      border-radius: 50%;
      background: var(--nexus-gold);
      margin-top: 0.45rem;
      flex-shrink: 0;
    }

    .nexus-points-item-text {
      font-size: 0.97rem;
      color: #374151;
      line-height: 1.65;
      margin: 0;
    }

    /* ===== 3 MODES D'ÉCHANGE ===== */
    .nexus-modes {
      background: linear-gradient(180deg, #0a0f1e 0%, #1a1042 100%);
      position: relative;
      overflow: hidden;
    }

    .nexus-modes::before {
      content: '';
      position: absolute;
      bottom: -120px;
      left: -120px;
      width: 600px;
      height: 600px;
      background: radial-gradient(circle, rgba(201,168,76,0.06) 0%, transparent 70%);
      pointer-events: none;
    }

    .nexus-modes .nexus-section-badge {
      background: rgba(201,168,76,0.15);
      border-color: rgba(201,168,76,0.3);
      color: var(--nexus-gold-light);
    }

    .nexus-modes .nexus-section-title { color: #fff; }
    .nexus-modes .nexus-section-sub   { color: rgba(255,255,255,0.55); }

    .nexus-modes-header {
      text-align: center;
      margin-bottom: 3.5rem;
    }

    .nexus-modes-grid {
      display: grid;
      grid-template-columns: repeat(3, 1fr);
      gap: 1.75rem;
    }

    .nexus-mode-card {
      background: rgba(255,255,255,0.04);
      border: 1px solid rgba(255,255,255,0.08);
      border-radius: 24px;
      padding: 2.25rem 2rem;
      transition: transform 0.3s, border-color 0.3s, box-shadow 0.3s;
      position: relative;
      overflow: hidden;
    }

    .nexus-mode-card::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      height: 3px;
      background: var(--nexus-gradient-gold);
      opacity: 0;
      transition: opacity 0.3s;
    }

    .nexus-mode-card:hover {
      transform: translateY(-6px);
      border-color: rgba(201,168,76,0.3);
      box-shadow: 0 20px 56px rgba(0,0,0,0.35);
    }

    .nexus-mode-card:hover::before {
      opacity: 1;
    }

    .nexus-mode-icon {
      font-size: 2.25rem;
      margin-bottom: 1.25rem;
      display: block;
    }

    .nexus-mode-title {
      font-size: 1.15rem;
      font-weight: 800;
      color: #fff;
      margin-bottom: 0.75rem;
      letter-spacing: -0.01em;
    }

    .nexus-mode-desc {
      font-size: 0.9rem;
      color: rgba(255,255,255,0.55);
      line-height: 1.7;
      margin: 0 0 1.5rem;
    }

    .nexus-mode-tags {
      display: flex;
      flex-direction: column;
      gap: 0.55rem;
    }

    .nexus-mode-tag-row {
      display: flex;
      align-items: flex-start;
      gap: 0.6rem;
      font-size: 0.83rem;
      color: rgba(255,255,255,0.68);
      line-height: 1.5;
    }

    .nexus-mode-tag-row::before {
      content: '→';
      color: var(--nexus-gold);
      font-weight: 700;
      flex-shrink: 0;
      margin-top: 0.05rem;
    }

    .nexus-mode-badge {
      display: inline-block;
      margin-top: 1.5rem;
      background: rgba(201,168,76,0.15);
      border: 1px solid rgba(201,168,76,0.3);
      color: var(--nexus-gold-light);
      padding: 0.3rem 0.9rem;
      border-radius: 100px;
      font-size: 0.72rem;
      font-weight: 700;
      letter-spacing: 0.07em;
      text-transform: uppercase;
    }

    @media (max-width: 1024px) {
      .nexus-modes-grid {
        grid-template-columns: 1fr;
        max-width: 520px;
        margin: 0 auto;
      }
    }

    /* ===== PRICING ===== */
    .nexus-pricing {
      background: #fff;
    }

    .nexus-pricing-header {
      text-align: center;
      margin-bottom: 4rem;
    }

    .nexus-pricing-grid {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 2rem;
      max-width: 820px;
      margin: 0 auto;
    }

    .nexus-pricing-card {
      border-radius: 24px;
      padding: 2.5rem;
      position: relative;
      transition: transform 0.3s, box-shadow 0.3s;
      border: 2px solid #e5e7eb;
      background: #fafafa;
    }

    .nexus-pricing-card.featured {
      background: var(--nexus-dark);
      border-color: rgba(201,168,76,0.4);
    }

    .nexus-pricing-card:hover {
      transform: translateY(-4px);
      box-shadow: 0 16px 48px rgba(0,0,0,0.1);
    }

    .nexus-pricing-card.featured:hover {
      box-shadow: 0 20px 60px rgba(0,0,0,0.35);
    }

    .nexus-pricing-badge {
      position: absolute;
      top: -14px;
      left: 50%;
      transform: translateX(-50%);
      background: var(--nexus-gradient-gold);
      color: #0a0f1e;
      padding: 0.3rem 1.2rem;
      border-radius: 100px;
      font-size: 0.73rem;
      font-weight: 700;
      letter-spacing: 0.05em;
      white-space: nowrap;
    }

    .nexus-pricing-label {
      font-size: 0.82rem;
      font-weight: 600;
      text-transform: uppercase;
      letter-spacing: 0.1em;
      color: #9ca3af;
      margin-bottom: 1rem;
    }

    .nexus-pricing-card.featured .nexus-pricing-label {
      color: rgba(255,255,255,0.45);
    }

    .nexus-pricing-amount {
      font-size: 3rem;
      font-weight: 800;
      color: #0a0f1e;
      line-height: 1;
    }

    .nexus-pricing-card.featured .nexus-pricing-amount {
      background: var(--nexus-gradient-gold);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      background-clip: text;
    }

    .nexus-pricing-period {
      font-size: 0.875rem;
      color: #9ca3af;
      font-weight: 500;
      margin-top: 0.25rem;
      display: block;
    }

    .nexus-pricing-card.featured .nexus-pricing-period {
      color: rgba(255,255,255,0.38);
    }

    .nexus-pricing-desc {
      font-size: 0.92rem;
      color: #6b7280;
      line-height: 1.6;
      margin: 1rem 0 1.75rem;
      min-height: 44px;
    }

    .nexus-pricing-card.featured .nexus-pricing-desc {
      color: rgba(255,255,255,0.58);
    }

    .nexus-pricing-features {
      list-style: none;
      padding: 0;
      margin: 0 0 2rem;
      display: grid;
      gap: 0.7rem;
    }

    .nexus-pricing-features li {
      display: flex;
      align-items: center;
      gap: 0.75rem;
      font-size: 0.9rem;
      color: #374151;
    }

    .nexus-pricing-card.featured .nexus-pricing-features li {
      color: rgba(255,255,255,0.78);
    }

    .nexus-pricing-features li::before {
      content: '✓';
      width: 20px;
      height: 20px;
      min-width: 20px;
      border-radius: 50%;
      background: rgba(201,168,76,0.14);
      color: #92640a;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 0.68rem;
      font-weight: 800;
    }

    .nexus-pricing-card.featured .nexus-pricing-features li::before {
      background: rgba(201,168,76,0.2);
      color: var(--nexus-gold-light);
    }

    .nexus-pricing-cta {
      display: block;
      text-align: center;
      padding: 0.9rem 1.5rem;
      border-radius: 100px;
      font-weight: 700;
      font-size: 0.95rem;
      text-decoration: none !important;
      transition: all 0.3s;
      background: #f3f4f6;
      color: #0a0f1e !important;
    }

    .nexus-pricing-cta:hover {
      background: #e5e7eb;
    }

    .nexus-pricing-card.featured .nexus-pricing-cta {
      background: var(--nexus-gradient-gold);
      color: #0a0f1e !important;
      box-shadow: 0 4px 20px rgba(201,168,76,0.4);
    }

    .nexus-pricing-card.featured .nexus-pricing-cta:hover {
      box-shadow: 0 8px 32px rgba(201,168,76,0.55);
      transform: translateY(-1px);
    }

    .nexus-pricing-note {
      text-align: center;
      margin-top: 2rem;
      font-size: 0.85rem;
      color: #9ca3af;
    }

    /* ===== FAQ ===== */
    .nexus-faq {
      background: var(--nexus-gradient-light);
    }

    .nexus-faq-title {
      text-align: center;
      font-size: 2.5rem;
      font-weight: 800;
      color: #0a0f1e;
      margin-bottom: 3rem;
      letter-spacing: -0.02em;
    }

    .nexus-faq-grid {
      max-width: 820px;
      margin: 0 auto;
    }

    .nexus-faq-item {
      border-bottom: 1px solid #e5e7eb;
      cursor: pointer;
    }

    .nexus-faq-q {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 1.5rem 0;
      font-size: 1rem;
      font-weight: 600;
      color: #111827;
      gap: 1rem;
      user-select: none;
    }

    .nexus-faq-q::after {
      content: '+';
      font-size: 1.5rem;
      font-weight: 300;
      color: #9ca3af;
      transition: transform 0.3s ease;
      flex-shrink: 0;
      line-height: 1;
    }

    .nexus-faq-item.active .nexus-faq-q::after {
      transform: rotate(45deg);
      color: var(--nexus-gold);
    }

    .nexus-faq-a {
      max-height: 0;
      overflow: hidden;
      transition: max-height 0.35s ease-out;
    }

    .nexus-faq-item.active .nexus-faq-a {
      max-height: 400px;
      padding-bottom: 1.5rem;
    }

    .nexus-faq-a p {
      font-size: 0.95rem;
      color: #6b7280;
      line-height: 1.8;
      margin: 0;
    }

    .nexus-faq-support {
      text-align: center;
      margin-top: 3rem;
      padding-top: 2rem;
      border-top: 1px solid #e5e7eb;
      font-size: 0.95rem;
      color: #6b7280;
    }

    .nexus-faq-support a {
      color: #92640a;
      text-decoration: none;
      font-weight: 600;
    }

    .nexus-faq-support a:hover {
      text-decoration: underline;
    }

    /* ===== FOOTER CTA ===== */
    .nexus-footer-cta {
      background: var(--nexus-gradient);
      padding: 7rem 0;
      text-align: center;
      position: relative;
      overflow: hidden;
    }

    .nexus-footer-cta::before {
      content: '';
      position: absolute;
      inset: 0;
      background: url('https://images.unsplash.com/photo-1540959733332-eab4deabeeaf?w=1600&q=50') center/cover no-repeat;
      opacity: 0.07;
    }

    .nexus-footer-cta-container {
      max-width: 720px;
      margin: 0 auto;
      padding: 0 2rem;
      position: relative;
      z-index: 1;
    }

    .nexus-footer-cta h2 {
      font-size: 3rem;
      font-weight: 800;
      color: #fff;
      margin-bottom: 1rem;
      letter-spacing: -0.02em;
      line-height: 1.2;
    }

    .nexus-footer-cta h2 span {
      background: var(--nexus-gradient-gold);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      background-clip: text;
    }

    .nexus-footer-cta p {
      font-size: 1.1rem;
      color: rgba(255,255,255,0.6);
      margin-bottom: 2.5rem;
    }

    /* ===== RESPONSIVE ===== */
    @media (max-width: 1024px) {
      .nexus-hero-content,
      .nexus-why-grid,
      .nexus-points-content {
        grid-template-columns: 1fr;
        gap: 3rem;
      }

      .nexus-domains-grid {
        grid-template-columns: 1fr 1fr;
      }

      .nexus-steps {
        grid-template-columns: repeat(2, 1fr);
      }

      .nexus-steps::before {
        display: none;
      }

      .nexus-hero-text h1 {
        font-size: 2.75rem;
      }
    }

    @media (max-width: 768px) {
      .nexus-hero {
        padding: 5rem 0 4rem;
        min-height: auto;
      }

      .nexus-hero-text h1 {
        font-size: 2.2rem;
      }

      .nexus-hero-cta {
        flex-direction: column;
        align-items: flex-start;
      }

      .nexus-domains-grid {
        grid-template-columns: 1fr;
      }

      .nexus-pricing-grid {
        grid-template-columns: 1fr;
        max-width: 480px;
      }

      .nexus-section-title {
        font-size: 2rem;
      }

      .nexus-section,
      .nexus-faq,
      .nexus-points,
      .nexus-pricing {
        padding: 4rem 0;
      }

      .nexus-footer-cta h2 {
        font-size: 2rem;
      }

      .nexus-points-badge {
        position: static;
        display: inline-block;
        margin-top: 1.5rem;
      }

      .nexus-faq-title {
        font-size: 2rem;
      }
    }

    @media (max-width: 640px) {
      .nexus-hero-text h1 {
        font-size: 1.9rem;
      }

      .nexus-steps {
        grid-template-columns: 1fr;
      }

      .btn-nexus-primary {
        width: 100%;
        justify-content: center;
      }
    }
  </style>
@endsection

@section('content')
<div class="nexus-become-page">

  {{-- ================================================================
       HERO — Accroche ultra-luxe
  ================================================================ --}}
  <section class="nexus-hero">
    <div class="nexus-hero-container">
      <div class="nexus-hero-content">

        <div class="nexus-hero-text">
          <div class="nexus-hero-badge">
            <i class="fas fa-gem"></i>
            NEXUS World &mdash; L'Univers des Espaces
          </div>
          <h1>Échangez des espaces.<br><span>Vivez plus grand.</span></h1>
          <p class="subtitle">
            Logements d'exception, bureaux premium, espaces académiques d'élite &mdash;
            rejoignez la communauté qui transforme la propriété en liberté.
          </p>
          <div class="nexus-hero-cta">
            <a href="{{ route('nexus.onboarding.step1') }}" class="btn-nexus-primary">
              Rejoindre NEXUS
              <i class="fas fa-arrow-right"></i>
            </a>
            <a href="#pourquoi-nexus" class="btn-nexus-secondary">
              Découvrir l'univers
            </a>
          </div>
          <div class="nexus-hero-stats">
            <div class="nexus-hero-stat">
              <span class="stat-num">3</span>
              <span class="stat-label">Domaines</span>
            </div>
            <div class="nexus-hero-stat">
              <span class="stat-num">1</span>
              <span class="stat-label">Abonnement</span>
            </div>
            <div class="nexus-hero-stat">
              <span class="stat-num">&infin;</span>
              <span class="stat-label">Possibilités</span>
            </div>
          </div>
        </div>

        <div class="nexus-hero-image">
          <img
            src="https://images.unsplash.com/photo-1600596542815-ffad4c1539a9?w=800&h=600&fit=crop"
            alt="Espace NEXUS World premium"
            onerror="this.src='https://images.unsplash.com/photo-1512917774080-9991f1c4c750?w=800&h=600&fit=crop';"
          >
        </div>

      </div>
    </div>
  </section>

  {{-- ================================================================
       WHY — Pourquoi NEXUS ? (Simon Sinek — Le WHY)
  ================================================================ --}}
  <section id="pourquoi-nexus" class="nexus-section nexus-why">
    <div class="nexus-container">
      <div class="nexus-why-grid">

        <div>
          <div class="nexus-section-badge">Pourquoi NEXUS ?</div>
          <h2 class="nexus-section-title">Parce que vos espaces méritent de voyager.</h2>
          <p class="nexus-section-sub">
            Chaque espace inutilisé est une opportunité manquée. NEXUS transforme vos biens en monnaie
            d'échange &mdash; non pour les vendre, mais pour les faire vivre autrement.
          </p>
          <div class="nexus-why-cards">
            <div class="nexus-why-card">
              <div class="nexus-why-icon">🌍</div>
              <div>
                <p class="nexus-why-card-title">La mobilité comme mode de vie</p>
                <p class="nexus-why-card-text">Accédez à des logements d'exception à travers le monde en échangeant le vôtre. Voyagez autrement, vivez mieux.</p>
              </div>
            </div>
            <div class="nexus-why-card">
              <div class="nexus-why-icon">🏆</div>
              <div>
                <p class="nexus-why-card-title">L'excellence académique à portée</p>
                <p class="nexus-why-card-text">Offrez à vos proches l'accès aux meilleures institutions via des espaces d'hébergement ou de travail proches des grandes écoles.</p>
              </div>
            </div>
            <div class="nexus-why-card">
              <div class="nexus-why-icon">🤝</div>
              <div>
                <p class="nexus-why-card-title">La confiance comme fondation</p>
                <p class="nexus-why-card-text">Notre système de points garantit l'équité de chaque échange. Pas d'argent entre membres &mdash; juste de la valeur réelle.</p>
              </div>
            </div>
          </div>
        </div>

        <div class="nexus-why-image">
          <img
            src="https://images.unsplash.com/photo-1545324418-cc1a3fa10c00?w=600&h=800&fit=crop&crop=top"
            alt="Mobilité et excellence NEXUS"
            onerror="this.src='https://images.unsplash.com/photo-1580587771525-78b9dba3b914?w=600&h=800&fit=crop&crop=top';"
          >
        </div>

      </div>
    </div>
  </section>

  {{-- ================================================================
       WHAT — Les 3 Domaines (Simon Sinek — Le WHAT)
  ================================================================ --}}
  <section class="nexus-section nexus-domains">
    <div class="nexus-container">

      <div class="nexus-domains-header">
        <div class="nexus-section-badge">L'Univers NEXUS</div>
        <h2 class="nexus-section-title">Trois domaines. Un seul univers.</h2>
        <p class="nexus-section-sub" style="margin: 0 auto;">
          Votre abonnement NEXUS ouvre l'accès à l'ensemble des espaces, sans restriction de domaine ni surcoût.
        </p>
      </div>

      <div class="nexus-domains-grid">

        {{-- Domaine 1 : Logement --}}
        <div class="nexus-domain-card">
          <img
            class="nexus-domain-img"
            src="https://images.unsplash.com/photo-1512917774080-9991f1c4c750?w=600&h=450&fit=crop"
            alt="Logements premium NEXUS"
            onerror="this.src='https://images.unsplash.com/photo-1560448204-444b6a78cfad?w=600&h=450&fit=crop';"
          >
          <div class="nexus-domain-overlay">
            <div class="nexus-domain-icon">🏠</div>
            <div class="nexus-domain-title">Logement</div>
            <div class="nexus-domain-tags">
              <span class="nexus-domain-tag">Chambre</span>
              <span class="nexus-domain-tag">Studio</span>
              <span class="nexus-domain-tag">Appartement</span>
              <span class="nexus-domain-tag">Maison</span>
              <span class="nexus-domain-tag gold">Penthouse</span>
              <span class="nexus-domain-tag">Chalet</span>
              <span class="nexus-domain-tag">Bungalow</span>
            </div>
          </div>
        </div>

        {{-- Domaine 2 : Infrastructure Professionnelle --}}
        <div class="nexus-domain-card">
          <img
            class="nexus-domain-img"
            src="https://images.unsplash.com/photo-1497366754035-f200968a2c79?w=600&h=450&fit=crop"
            alt="Espaces professionnels NEXUS"
            onerror="this.src='https://images.unsplash.com/photo-1497366811353-6870744d04b2?w=600&h=450&fit=crop';"
          >
          <div class="nexus-domain-overlay">
            <div class="nexus-domain-icon">🏢</div>
            <div class="nexus-domain-title">Infrastructure Professionnelle</div>
            <div class="nexus-domain-tags">
              <span class="nexus-domain-tag">Bureau</span>
              <span class="nexus-domain-tag">Salle de Réunion</span>
              <span class="nexus-domain-tag gold">Salle d'Événement</span>
              <span class="nexus-domain-tag">Salle de Réception</span>
            </div>
          </div>
        </div>

        {{-- Domaine 3 : Infrastructure d'Enseignement --}}
        <div class="nexus-domain-card">
          <img
            class="nexus-domain-img"
            src="https://images.unsplash.com/photo-1541339907198-e08756dedf3f?w=600&h=450&fit=crop"
            alt="Espaces académiques NEXUS"
            onerror="this.src='https://images.unsplash.com/photo-1523050854058-8df90110c9f1?w=600&h=450&fit=crop';"
          >
          <div class="nexus-domain-overlay">
            <div class="nexus-domain-icon">🎓</div>
            <div class="nexus-domain-title">Infrastructure d'Enseignement</div>
            <div class="nexus-domain-tags">
              <span class="nexus-domain-tag">Collège</span>
              <span class="nexus-domain-tag">Lycée</span>
              <span class="nexus-domain-tag">Université</span>
              <span class="nexus-domain-tag">École Spécialisée</span>
              <span class="nexus-domain-tag gold">Grandes Écoles</span>
            </div>
          </div>
        </div>

      </div>
    </div>
  </section>

  {{-- ================================================================
       HOW — Comment ça marche ? (Simon Sinek — Le HOW)
  ================================================================ --}}
  <section id="fonctionnement" class="nexus-section nexus-how">
    <div class="nexus-container">

      <div class="nexus-how-header">
        <div class="nexus-section-badge">Comment ça marche ?</div>
        <h2 class="nexus-section-title">Quatre étapes. Une nouvelle liberté.</h2>
        <p class="nexus-section-sub" style="margin: 0 auto;">
          Du premier dépôt à votre premier échange, le processus NEXUS est conçu pour être fluide et intuitif.
        </p>
      </div>

      <div class="nexus-steps">
        <div class="nexus-step">
          <div class="nexus-step-num">1</div>
          <h3>Publiez votre espace</h3>
          <p>Ajoutez votre logement, bureau ou infrastructure dans votre tableau de bord NEXUS en quelques minutes.</p>
        </div>
        <div class="nexus-step">
          <div class="nexus-step-num">2</div>
          <h3>Choisissez votre mode</h3>
          <p>Échange simultané, non simultané ou par points &mdash; trois façons d'accéder aux espaces selon votre situation.</p>
        </div>
        <div class="nexus-step">
          <div class="nexus-step-num">3</div>
          <h3>Explorez l'univers</h3>
          <p>Parcourez les 3 domaines et choisissez l'espace qui correspond à vos projets de vie ou de travail.</p>
        </div>
        <div class="nexus-step">
          <div class="nexus-step-num">4</div>
          <h3>Échangez &amp; profitez</h3>
          <p>Confirmez l'échange selon le mode choisi. Votre aventure NEXUS commence ici.</p>
        </div>
      </div>

    </div>
  </section>

  {{-- ================================================================
       3 MODES D'ÉCHANGE
  ================================================================ --}}
  <section class="nexus-section nexus-modes">
    <div class="nexus-container">

      <div class="nexus-modes-header">
        <div class="nexus-section-badge">Les Modes d'Échange NEXUS</div>
        <h2 class="nexus-section-title">Trois façons d'échanger. Une seule liberté.</h2>
        <p class="nexus-section-sub" style="margin: 0 auto;">
          NEXUS ne vous impose pas un seul modèle. Choisissez le mode qui correspond à votre situation, à chaque échange.
        </p>
      </div>

      <div class="nexus-modes-grid">

        {{-- Mode 1 : Simultané --}}
        <div class="nexus-mode-card">
          <span class="nexus-mode-icon">🔄</span>
          <div class="nexus-mode-title">Échange Simultané</div>
          <p class="nexus-mode-desc">
            Vous et un autre membre échangez vos espaces aux <strong style="color:#fff;">mêmes dates</strong>.
            Un accord bilatéral direct, sans intermédiaire de points.
          </p>
          <div class="nexus-mode-tags">
            <div class="nexus-mode-tag-row">Calendriers synchronisés entre les deux membres</div>
            <div class="nexus-mode-tag-row">Aucun point débité — échange 1 pour 1</div>
            <div class="nexus-mode-tag-row">Idéal pour les vacances planifiées à l'avance</div>
            <div class="nexus-mode-tag-row">Confirmation mutuelle requise</div>
          </div>
          <span class="nexus-mode-badge">Classique &amp; direct</span>
        </div>

        {{-- Mode 2 : Non simultané --}}
        <div class="nexus-mode-card">
          <span class="nexus-mode-icon">⏳</span>
          <div class="nexus-mode-title">Échange Non Simultané</div>
          <p class="nexus-mode-desc">
            Vous utilisez l'espace d'un membre <strong style="color:#fff;">maintenant</strong>,
            il utilisera le vôtre <strong style="color:#fff;">plus tard</strong> — à une date convenue entre vous.
          </p>
          <div class="nexus-mode-tags">
            <div class="nexus-mode-tag-row">Flexibilité maximale sur les dates de chaque partie</div>
            <div class="nexus-mode-tag-row">Engagement enregistré sur la plateforme</div>
            <div class="nexus-mode-tag-row">Idéal quand les agendas ne se croisent pas</div>
            <div class="nexus-mode-tag-row">Sécurisé par le système NEXUS</div>
          </div>
          <span class="nexus-mode-badge">Flexibilité totale</span>
        </div>

        {{-- Mode 3 : Points --}}
        <div class="nexus-mode-card">
          <span class="nexus-mode-icon">⭐</span>
          <div class="nexus-mode-title">Échange par Points</div>
          <p class="nexus-mode-desc">
            Mettez votre espace à disposition pour <strong style="color:#fff;">accumuler des points NEXUS</strong>,
            puis dépensez-les pour accéder à n'importe quel espace sans partenaire direct.
          </p>
          <div class="nexus-mode-tags">
            <div class="nexus-mode-tag-row">Points transversaux : logement, bureau, Grande École</div>
            <div class="nexus-mode-tag-row">Capitalisation — les points ne périment pas</div>
            <div class="nexus-mode-tag-row">Aucun partenaire direct requis</div>
            <div class="nexus-mode-tag-row">Valorisation selon le marché local réel</div>
          </div>
          <span class="nexus-mode-badge">Liberté &amp; transversalité</span>
        </div>

      </div>
    </div>
  </section>

  {{-- ================================================================
       POINTS — La monnaie transversale (détail mode 3)
  ================================================================ --}}
  <section class="nexus-section nexus-points">
    <div class="nexus-container">
      <div class="nexus-points-content">

        <div class="nexus-points-visual">
          <img
            src="https://images.unsplash.com/photo-1582268611958-ebfd161ef9cf?w=800&h=1067&fit=crop&crop=center"
            alt="Piscine à débordement rooftop vue sur skyline — NEXUS World"
            onerror="this.src='https://images.unsplash.com/photo-1613977257592-4871e5fcd7c4?w=800&h=1067&fit=crop&crop=center';"
          >
          <div class="nexus-points-badge">
            <span class="big-num">Vos espaces</span>
            <span class="big-label">ouvrent toutes les portes</span>
            <span class="big-label" style="margin-top:0.6rem;opacity:0.7;font-style:italic;font-size:0.65rem;letter-spacing:0.06em;">Vivre haut &nbsp;·&nbsp; Travailler haut &nbsp;·&nbsp; Viser haut</span>
          </div>
        </div>

        <div>
          <div class="nexus-section-badge">3 modes. 3 domaines. Zéro frontière.</div>
          <h2 class="nexus-section-title">Chaque espace peut tout ouvrir.</h2>
          <p class="nexus-section-sub">
            Imaginez&nbsp;: un logement échangé contre un autre logement lors d'un séjour, ou converti en
            accès à un bureau premium à l'autre bout du monde. Deux établissements scolaires qui organisent
            en simultané un programme d'immersion linguistique croisé — ou qui utilisent leurs points pour
            permettre à leurs élèves de découvrir une grande école partenaire, à leur propre rythme.
            Et surtout&nbsp;: une famille, un élève, un parent — <strong>sans attendre l'initiative d'aucune institution</strong> —
            qui convertit ses points en ouverture vers l'excellence académique.
            NEXUS ne réserve pas l'accès. Il le rend possible.
          </p>
          <div class="nexus-points-list">
            <div class="nexus-points-item">
              <div class="nexus-points-dot"></div>
              <p class="nexus-points-item-text"><strong>Logement ↔ Logement, Infrastructure pro ou Enseignement</strong> &mdash; échangez votre résidence principale ou secondaire contre un autre lieu de vie, un bureau, une salle de réception, ou convertissez vos points en accès à un programme linguistique ou à la découverte d'un établissement d'excellence &mdash; selon vos projets, à votre rythme</p>
            </div>
            <div class="nexus-points-item">
              <div class="nexus-points-dot"></div>
              <p class="nexus-points-item-text"><strong>École ↔ École</strong> &mdash; deux établissements organisent un échange simultané, différé ou par points&nbsp;: immersion linguistique, stage de découverte, programme de mobilité entre grandes écoles</p>
            </div>
            <div class="nexus-points-item">
              <div class="nexus-points-dot"></div>
              <p class="nexus-points-item-text"><strong>Famille ou Élève ↔ Grande École</strong> &mdash; sans attendre qu'un établissement initie la démarche, parents et élèves utilisent leurs points pour candidater à une immersion, un accès découverte ou un programme d'admission temporaire</p>
            </div>
            <div class="nexus-points-item">
              <div class="nexus-points-dot"></div>
              <p class="nexus-points-item-text"><strong>Capitalisation sans limite</strong> &mdash; vos points s'accumulent cycle après cycle, prêts à financer le projet qui compte vraiment, quand vous êtes prêt</p>
            </div>
          </div>
        </div>

      </div>
    </div>
  </section>

  {{-- ================================================================
       PRICING — Tarifs
  ================================================================ --}}
  <section id="tarifs" class="nexus-section nexus-pricing">
    <div class="nexus-container">

      <div class="nexus-pricing-header">
        <div class="nexus-section-badge">Tarifs</div>
        <h2 class="nexus-section-title">Un abonnement. L'accès à tout.</h2>
        <p class="nexus-section-sub" style="margin: 0 auto;">
          Choisissez le rythme qui vous correspond. L'univers NEXUS&nbsp;reste identique dans les deux formules.
        </p>
      </div>

      <div class="nexus-pricing-grid">

        {{-- Cycle 4 semaines --}}
        <div class="nexus-pricing-card">
          <div class="nexus-pricing-label">Cycle 4 semaines</div>
          <div>
            <span class="nexus-pricing-amount">99,90€</span>
            <span class="nexus-pricing-period">par cycle de 4 semaines</span>
          </div>
          <p class="nexus-pricing-desc">Idéal pour tester l'univers NEXUS sans engagement long terme.</p>
          <ul class="nexus-pricing-features">
            <li>Accès aux 3 domaines NEXUS</li>
            <li>Points NEXUS inclus</li>
            <li>1 espace publié</li>
            <li>Messagerie membre</li>
            <li>Support standard</li>
          </ul>
          <a href="{{ route('nexus.onboarding.step1') }}" class="nexus-pricing-cta">
            Commencer maintenant
          </a>
        </div>

        {{-- Annuel --}}
        <div class="nexus-pricing-card featured">
          <div class="nexus-pricing-badge">2 Cycles offerts</div>
          <div class="nexus-pricing-label">Abonnement Annuel</div>
          <div>
            <span class="nexus-pricing-amount">1&nbsp;098,90€</span>
            <span class="nexus-pricing-period">pour 13 cycles &mdash; soit 84,53€/cycle</span>
          </div>
          <p class="nexus-pricing-desc">11 cycles payés, 13 cycles d'accès. La solution des membres engagés.</p>
          <ul class="nexus-pricing-features">
            <li>Accès aux 3 domaines NEXUS</li>
            <li>Points NEXUS premium</li>
            <li>3 espaces publiés</li>
            <li>Messagerie prioritaire</li>
            <li>Support dédié 7j/7</li>
            <li>Échanges illimités</li>
          </ul>
          <a href="{{ route('nexus.onboarding.step1') }}" class="nexus-pricing-cta">
            Rejoindre NEXUS
          </a>
        </div>

      </div>

      <p class="nexus-pricing-note">
        Sans engagement. Résiliation possible avant le prochain cycle.&nbsp;&nbsp;·&nbsp;&nbsp;
        <a href="#faq" style="color:#92640a;text-decoration:none;">Questions sur les tarifs →</a>
      </p>

    </div>
  </section>

  {{-- ================================================================
       FAQ
  ================================================================ --}}
  <section id="faq" class="nexus-section nexus-faq">
    <div class="nexus-container">

      <h2 class="nexus-faq-title">Questions fréquentes</h2>

      <div class="nexus-faq-grid">

        <div class="nexus-faq-item">
          <div class="nexus-faq-q">Qu'est-ce que NEXUS World ?</div>
          <div class="nexus-faq-a">
            <p>NEXUS World est l'univers des espaces de la plateforme Junspro. Il vous permet d'échanger tous types d'espaces — logements, bureaux, salles de réception, infrastructures académiques — via un système de points unique et transversal, sans transaction monétaire entre membres.</p>
          </div>
        </div>

        <div class="nexus-faq-item">
          <div class="nexus-faq-q">Comment fonctionne le système de points ?</div>
          <div class="nexus-faq-a">
            <p>Lorsque vous mettez votre espace à disposition d'un autre membre, vous gagnez des points NEXUS. Ces points peuvent ensuite être utilisés pour accéder à n'importe quel espace disponible dans l'univers NEXUS, quel que soit le domaine. Un penthouse en ville peut ainsi "financer" une salle de conférence dans une grande école.</p>
          </div>
        </div>

        <div class="nexus-faq-item">
          <div class="nexus-faq-q">Puis-je avoir plusieurs espaces publiés ?</div>
          <div class="nexus-faq-a">
            <p>Oui. Avec l'abonnement annuel, vous pouvez publier jusqu'à 3 espaces dans les 3 domaines. Avec le cycle 4 semaines, 1 espace est inclus. Les deux formules permettent des échanges transversaux sans restriction.</p>
          </div>
        </div>

        <div class="nexus-faq-item">
          <div class="nexus-faq-q">Les échanges impliquent-ils de l'argent entre membres ?</div>
          <div class="nexus-faq-a">
            <p>Non. Les échanges NEXUS se font exclusivement via le système de points. L'abonnement mensuel ou annuel est la seule transaction monétaire — il garantit l'accès à l'univers et la qualité de la communauté.</p>
          </div>
        </div>

        <div class="nexus-faq-item">
          <div class="nexus-faq-q">Comment sont vérifiés les espaces publiés ?</div>
          <div class="nexus-faq-a">
            <p>Chaque espace soumis passe par un processus de vérification Junspro : photos authentifiées, description contrôlée, identité du propriétaire vérifiée. Seuls les espaces validés par notre équipe apparaissent dans l'univers NEXUS et peuvent faire l'objet d'un échange.</p>
          </div>
        </div>

        <div class="nexus-faq-item">
          <div class="nexus-faq-q">Que se passe-t-il si je résilie mon abonnement ?</div>
          <div class="nexus-faq-a">
            <p>Vos points NEXUS sont conservés pendant 12 mois après votre résiliation. Vos espaces publiés sont archivés (non supprimés) et peuvent être réactivés à tout moment. Vous retrouvez l'intégralité de votre univers NEXUS dès la réactivation de votre abonnement.</p>
          </div>
        </div>

        <div class="nexus-faq-support">
          Une question ?
          @php
            try { $contactUrl = route('contact'); } catch (\Exception $e) { $contactUrl = url('/contact'); }
          @endphp
          <a href="{{ $contactUrl }}">Contacter le support</a>
        </div>

      </div>
    </div>
  </section>

  {{-- ================================================================
       FOOTER CTA
  ================================================================ --}}
  <section class="nexus-footer-cta">
    <div class="nexus-footer-cta-container">
      <h2>Prêt(e) à entrer dans<br><span>l'Univers NEXUS ?</span></h2>
      <p>Rejoignez les premiers membres qui réinventent la façon d'utiliser leurs espaces.</p>
      <a href="{{ route('nexus.onboarding.step1') }}" class="btn-nexus-primary" style="display:inline-flex;margin:0 auto;">
        Rejoindre NEXUS maintenant
        <i class="fas fa-arrow-right"></i>
      </a>
    </div>
  </section>

</div>
@endsection

@section('script')
<script>
  document.addEventListener('DOMContentLoaded', function () {

    // ── FAQ Accordion ────────────────────────────────────────────────
    const faqItems = document.querySelectorAll('.nexus-faq-item');
    faqItems.forEach(item => {
      const q = item.querySelector('.nexus-faq-q');
      if (!q) return;
      q.addEventListener('click', () => {
        const isActive = item.classList.contains('active');
        faqItems.forEach(i => i.classList.remove('active'));
        if (!isActive) item.classList.add('active');
      });
    });

    // ── Scroll animations (Intersection Observer) ───────────────────
    const targets = document.querySelectorAll(
      '.nexus-why-card, .nexus-domain-card, .nexus-step, .nexus-pricing-card, .nexus-points-item'
    );
    targets.forEach((el, i) => {
      el.style.opacity = '0';
      el.style.transform = 'translateY(22px)';
      el.style.transition = `opacity 0.55s ease ${i * 0.06}s, transform 0.55s ease ${i * 0.06}s`;
    });

    const observer = new IntersectionObserver((entries) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          entry.target.style.opacity = '1';
          entry.target.style.transform = 'translateY(0)';
        }
      });
    }, { threshold: 0.08, rootMargin: '0px 0px -70px 0px' });

    targets.forEach(el => observer.observe(el));

    // ── Smooth scroll ────────────────────────────────────────────────
    document.querySelectorAll('a[href^="#"]').forEach(a => {
      a.addEventListener('click', function (e) {
        const target = document.querySelector(this.getAttribute('href'));
        if (target) {
          e.preventDefault();
          target.scrollIntoView({ behavior: 'smooth', block: 'start' });
        }
      });
    });

  });
</script>
@endsection
