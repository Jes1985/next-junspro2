{{-- Styles locaux page /pricing — Violet clair + bleu royal, dégradés subtils — Scoped au .pricing-page-wrapper --}}
<style>
.pricing-page-wrapper {
  --jsp-royal: #4169E1;
  --jsp-royal-dark: #1E40AF;
  --jsp-violet: #7C3AED;
  --jsp-violet-light: #A78BFA;
  --jsp-violet-pale: #C4B5FD;
  --jsp-bg-wash: linear-gradient(180deg, #F5F3FF 0%, #EDE9FE 50%, #E9E5FF 100%);
  --jsp-gradient: linear-gradient(135deg, #4169E1 0%, #7C3AED 100%);
  --jsp-gradient-soft: linear-gradient(135deg, rgba(65, 105, 225, 0.12) 0%, rgba(124, 58, 237, 0.12) 100%);
}

/* Hero — Fond clair violet/bleu, fun et raffiné */
.pricing-page-wrapper .pricing-hero-premium {
  position: relative;
  overflow: hidden;
  padding: 120px 0 100px;
  margin-top: 0;
  min-height: 55vh;
  display: flex;
  align-items: center;
  background: var(--jsp-bg-wash);
}

.pricing-page-wrapper .pricing-hero-glow {
  position: absolute;
  top: -20%;
  left: 50%;
  transform: translateX(-50%);
  width: 120%;
  height: 80%;
  background: radial-gradient(ellipse 80% 60% at 50% 0%, rgba(124, 58, 237, 0.15) 0%, rgba(65, 105, 225, 0.08) 40%, transparent 70%);
  pointer-events: none;
}

.pricing-page-wrapper .pricing-hero-container {
  max-width: 900px;
  margin: 0 auto;
  padding: 0 24px;
  position: relative;
  z-index: 2;
}

.pricing-page-wrapper .pricing-hero-content {
  text-align: center;
}

.pricing-page-wrapper .pricing-hero-badge {
  display: inline-block;
  font-size: 12px;
  font-weight: 600;
  text-transform: uppercase;
  letter-spacing: 0.12em;
  color: var(--jsp-violet);
  margin-bottom: 16px;
  padding: 6px 16px;
  background: rgba(124, 58, 237, 0.1);
  border-radius: 50px;
}

.pricing-page-wrapper .pricing-hero-title {
  font-size: 3.2rem;
  font-weight: 700;
  line-height: 1.15;
  margin-bottom: 1.5rem;
  letter-spacing: -0.03em;
  color: #1F2937;
}

.pricing-page-wrapper .pricing-hero-title .hero-title-line-1 {
  display: block;
  margin-bottom: 0.4rem;
}

.pricing-page-wrapper .pricing-hero-title .hero-title-line-1 .highlight {
  background: var(--jsp-gradient);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  background-clip: text;
}

.pricing-page-wrapper .pricing-hero-title .hero-title-line-2 {
  display: block;
  color: #4B5563;
  font-weight: 500;
}

.pricing-page-wrapper .pricing-hero-subtitle {
  font-size: 1.1rem;
  color: #6B7280;
  line-height: 1.7;
  max-width: 640px;
  margin: 0 auto 1.5rem;
}

.pricing-page-wrapper .pricing-hero-freelancer-info {
  margin-bottom: 1rem;
}

.pricing-page-wrapper .hero-stat-text {
  display: inline-block;
  padding: 10px 22px;
  background: var(--jsp-gradient);
  border-radius: 50px;
  font-size: 0.9rem;
  font-weight: 600;
  color: white;
  box-shadow: 0 4px 16px rgba(124, 58, 237, 0.35);
}

/* Sections */
.pricing-page-wrapper .pricing-plans-section {
  padding: 80px 0 100px;
  background: #fff;
}

.pricing-page-wrapper .pricing-express-section {
  padding: 80px 0 100px;
  background: var(--jsp-bg-wash);
}

.pricing-page-wrapper .pricing-how-section {
  padding: 80px 0 100px;
  background: #fff;
}

.pricing-page-wrapper .pricing-guarantees-section {
  padding: 80px 0 100px;
  background: var(--jsp-bg-wash);
}

.pricing-page-wrapper .pricing-cta-section {
  padding: 80px 0 100px;
  background: #fff;
}

.pricing-page-wrapper .pricing-section-header {
  text-align: center;
  margin-bottom: 48px;
}

.pricing-page-wrapper .pricing-section-title {
  font-size: 2rem;
  font-weight: 700;
  color: #1F2937;
  margin-bottom: 12px;
  letter-spacing: -0.02em;
}

.pricing-page-wrapper .pricing-section-subtitle {
  font-size: 1rem;
  color: #6B7280;
  max-width: 600px;
  margin: 0 auto;
  line-height: 1.6;
}

/* Cards formules */
.pricing-page-wrapper .pricing-card {
  position: relative;
  background: #fff;
  border-radius: 20px;
  overflow: hidden;
  height: 100%;
  border: 1px solid rgba(124, 58, 237, 0.08);
  box-shadow: 0 4px 24px rgba(15, 23, 42, 0.06);
  transition: transform 0.3s ease, box-shadow 0.3s ease, border-color 0.3s ease;
}

.pricing-page-wrapper .pricing-card:hover {
  transform: translateY(-6px);
  box-shadow: 0 20px 48px rgba(124, 58, 237, 0.12);
  border-color: rgba(124, 58, 237, 0.2);
}

.pricing-page-wrapper .pricing-card-popular {
  border-color: rgba(124, 58, 237, 0.25);
  box-shadow: 0 8px 32px rgba(124, 58, 237, 0.15);
}

.pricing-page-wrapper .pricing-card-badge {
  position: absolute;
  top: 16px;
  right: 16px;
  font-size: 11px;
  font-weight: 600;
  padding: 6px 12px;
  background: var(--jsp-gradient);
  color: white;
  border-radius: 8px;
  transform: rotate(6deg);
}

.pricing-page-wrapper .pricing-card-body {
  padding: 32px 24px;
  display: flex;
  flex-direction: column;
  align-items: center;
  text-align: center;
  min-height: 320px;
}

.pricing-page-wrapper .pricing-card-icon {
  width: 56px;
  height: 56px;
  display: flex;
  align-items: center;
  justify-content: center;
  background: var(--jsp-gradient-soft);
  border-radius: 16px;
  margin-bottom: 20px;
  color: var(--jsp-violet);
  font-size: 1.5rem;
}

.pricing-page-wrapper .pricing-card-name {
  font-size: 1.15rem;
  font-weight: 700;
  color: #1F2937;
  margin-bottom: 8px;
}

.pricing-page-wrapper .pricing-card-desc {
  font-size: 0.875rem;
  color: #6B7280;
  margin-bottom: 20px;
  line-height: 1.5;
}

.pricing-page-wrapper .pricing-card-hours {
  margin-bottom: 8px;
}

.pricing-page-wrapper .pricing-card-hours .hours-value {
  font-size: 2rem;
  font-weight: 700;
  background: var(--jsp-gradient);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  background-clip: text;
}

.pricing-page-wrapper .pricing-card-hours .hours-label {
  font-size: 0.95rem;
  color: #6B7280;
}

.pricing-page-wrapper .pricing-card-detail {
  font-size: 0.8rem;
  color: #9CA3AF;
  margin-bottom: 8px;
}

.pricing-page-wrapper .pricing-card-topup {
  font-size: 0.75rem;
  color: #9CA3AF;
  margin-bottom: 16px;
  display: flex;
  flex-direction: column;
  gap: 2px;
}

.pricing-page-wrapper .pricing-card-price {
  font-size: 0.9rem;
  color: #4B5563;
  margin-bottom: 20px;
}

.pricing-page-wrapper .pricing-card-price .price-value {
  font-weight: 700;
  color: var(--jsp-violet);
}

.pricing-page-wrapper .pricing-card-price small {
  display: block;
  font-size: 0.75rem;
  color: #9CA3AF;
  margin-top: 4px;
}

.pricing-page-wrapper .pricing-card-cta {
  margin-top: auto;
  width: 100%;
}

.pricing-page-wrapper .pricing-formula-note {
  text-align: center;
  font-size: 0.9rem;
  color: #6B7280;
  margin-top: 48px;
}

.pricing-page-wrapper .pricing-formula-note i {
  color: var(--jsp-violet);
  margin-right: 8px;
}

/* Boutons (scoped) */
.pricing-page-wrapper .pricing-btn {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  padding: 12px 24px;
  font-size: 0.95rem;
  font-weight: 600;
  border-radius: 12px;
  text-decoration: none;
  border: none;
  cursor: pointer;
  transition: all 0.25s ease;
  width: 100%;
}

.pricing-page-wrapper .pricing-btn-primary {
  background: var(--jsp-gradient);
  color: white !important;
  box-shadow: 0 4px 16px rgba(124, 58, 237, 0.3);
}

.pricing-page-wrapper .pricing-btn-primary:hover {
  transform: translateY(-2px);
  box-shadow: 0 8px 24px rgba(124, 58, 237, 0.4);
}

.pricing-page-wrapper .pricing-btn-outline {
  background: transparent;
  color: var(--jsp-violet) !important;
  border: 2px solid var(--jsp-violet);
}

.pricing-page-wrapper .pricing-btn-outline:hover {
  background: rgba(124, 58, 237, 0.08);
}

.pricing-page-wrapper .pricing-btn-lg {
  padding: 16px 32px;
  font-size: 1rem;
}

/* Express cards */
.pricing-page-wrapper .pricing-express-card {
  background: #fff;
  border-radius: 20px;
  padding: 36px 28px;
  text-align: center;
  border: 1px solid rgba(124, 58, 237, 0.08);
  box-shadow: 0 4px 24px rgba(15, 23, 42, 0.06);
  transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.pricing-page-wrapper .pricing-express-card:hover {
  transform: translateY(-4px);
  box-shadow: 0 16px 40px rgba(124, 58, 237, 0.12);
}

.pricing-page-wrapper .pricing-express-icon {
  width: 56px;
  height: 56px;
  margin: 0 auto 20px;
  display: flex;
  align-items: center;
  justify-content: center;
  background: var(--jsp-gradient-soft);
  border-radius: 16px;
  color: var(--jsp-royal);
  font-size: 1.5rem;
}

.pricing-page-wrapper .pricing-express-name {
  font-size: 1.1rem;
  font-weight: 700;
  color: #1F2937;
  margin-bottom: 12px;
}

.pricing-page-wrapper .pricing-express-badge {
  display: inline-block;
  padding: 8px 20px;
  background: var(--jsp-gradient);
  color: white;
  font-weight: 700;
  font-size: 1.1rem;
  border-radius: 10px;
  margin-bottom: 12px;
}

.pricing-page-wrapper .pricing-express-desc {
  font-size: 0.9rem;
  color: #6B7280;
  margin: 0;
}

/* Steps */
.pricing-page-wrapper .pricing-step {
  text-align: center;
  padding: 32px 24px;
}

.pricing-page-wrapper .pricing-step-num {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  width: 56px;
  height: 56px;
  background: var(--jsp-gradient);
  color: white;
  font-size: 1.5rem;
  font-weight: 700;
  border-radius: 16px;
  margin-bottom: 20px;
  box-shadow: 0 4px 16px rgba(124, 58, 237, 0.35);
}

.pricing-page-wrapper .pricing-step-title {
  font-size: 1.1rem;
  font-weight: 700;
  color: #1F2937;
  margin-bottom: 12px;
}

.pricing-page-wrapper .pricing-step-desc {
  font-size: 0.9rem;
  color: #6B7280;
  line-height: 1.6;
  margin: 0;
}

/* Guarantees */
.pricing-page-wrapper .pricing-guarantee-card {
  background: #fff;
  border-radius: 20px;
  padding: 32px 28px;
  border: 1px solid rgba(124, 58, 237, 0.06);
  box-shadow: 0 4px 20px rgba(15, 23, 42, 0.04);
  transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.pricing-page-wrapper .pricing-guarantee-card:hover {
  transform: translateY(-6px);
  box-shadow: 0 12px 32px rgba(124, 58, 237, 0.1);
}

.pricing-page-wrapper .pricing-guarantee-icon {
  width: 48px;
  height: 48px;
  display: flex;
  align-items: center;
  justify-content: center;
  background: var(--jsp-gradient-soft);
  border-radius: 14px;
  color: var(--jsp-violet);
  font-size: 1.25rem;
  margin-bottom: 1rem;
}

.pricing-page-wrapper .pricing-guarantee-title {
  font-size: 1.05rem;
  font-weight: 700;
  color: #1F2937;
  margin-bottom: 12px;
}

.pricing-page-wrapper .pricing-guarantee-desc {
  font-size: 0.9rem;
  color: #6B7280;
  line-height: 1.6;
  margin: 0;
}

/* CTA */
.pricing-page-wrapper .pricing-cta-box {
  text-align: center;
  padding: 56px 48px;
  background: var(--jsp-bg-wash);
  border-radius: 24px;
  border: 1px solid rgba(124, 58, 237, 0.1);
}

.pricing-page-wrapper .pricing-cta-title {
  font-size: 2rem;
  font-weight: 700;
  color: #1F2937;
  margin-bottom: 16px;
}

.pricing-page-wrapper .pricing-cta-subtitle {
  font-size: 1.1rem;
  color: #6B7280;
  margin-bottom: 32px;
  max-width: 520px;
  margin-left: auto;
  margin-right: auto;
  margin-bottom: 32px;
}

.pricing-page-wrapper .pricing-cta-buttons {
  display: flex;
  gap: 16px;
  justify-content: center;
  flex-wrap: wrap;
}

.pricing-page-wrapper .pricing-cta-buttons .pricing-btn {
  width: auto;
  min-width: 200px;
}

/* Responsive */
@media (max-width: 991px) {
  .pricing-page-wrapper .pricing-hero-title { font-size: 2.5rem; }
  .pricing-page-wrapper .pricing-plans-section,
  .pricing-page-wrapper .pricing-express-section,
  .pricing-page-wrapper .pricing-how-section,
  .pricing-page-wrapper .pricing-guarantees-section,
  .pricing-page-wrapper .pricing-cta-section { padding: 60px 0 80px; }
}

@media (max-width: 768px) {
  .pricing-page-wrapper .pricing-hero-premium { padding: 100px 0 70px; min-height: auto; }
  .pricing-page-wrapper .pricing-hero-title { font-size: 2rem; }
  .pricing-page-wrapper .pricing-hero-subtitle { font-size: 1rem; }
  .pricing-page-wrapper .hero-stat-text { font-size: 0.85rem; padding: 8px 18px; }
  .pricing-page-wrapper .pricing-card-body { min-height: auto; }
  .pricing-page-wrapper .pricing-cta-box { padding: 40px 24px; }
  .pricing-page-wrapper .pricing-cta-buttons { flex-direction: column; }
  .pricing-page-wrapper .pricing-cta-buttons .pricing-btn { width: 100%; }
}
</style>
