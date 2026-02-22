
<link rel="stylesheet" href="<?php echo e(asset('assets/css/summernote-content.css')); ?>">
<style>
  .legal-page-wrapper .categories-menu,
  .legal-page-wrapper .categories-menu-nav,
  .legal-page-wrapper .categories,
  .legal-page-wrapper ul.categories,
  .legal-page-wrapper .category-menu,
  .legal-page-wrapper .category-nav {
    display: none !important;
    visibility: hidden !important;
    height: 0 !important;
    overflow: hidden !important;
    margin: 0 !important;
    padding: 0 !important;
    opacity: 0 !important;
    pointer-events: none !important;
  }
  .legal-page-wrapper {
    background: linear-gradient(180deg, rgba(245, 245, 255, 0.98) 0%, rgba(240, 240, 252, 0.95) 50%, rgba(235, 235, 250, 0.92) 100%) !important;
    min-height: 100vh !important;
    padding-top: 120px !important;
    padding-bottom: 80px !important;
    position: relative !important;
    overflow: hidden !important;
    -webkit-font-smoothing: antialiased !important;
    -moz-osx-font-smoothing: grayscale !important;
    text-rendering: optimizeLegibility !important;
  }
  .legal-page-wrapper::before {
    content: "";
    position: absolute;
    inset: 0;
    background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 256 256' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='noise'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23noise)' opacity='0.03'/%3E%3C/svg%3E");
    pointer-events: none;
    z-index: 0;
    opacity: 0.4;
  }
  .legal-page-wrapper::after {
    content: "";
    position: fixed;
    inset: 0;
    background: radial-gradient(ellipse 80% 70% at 50% 50%, transparent 40%, rgba(15, 23, 42, 0.03) 100%);
    pointer-events: none;
    z-index: 998;
  }
  .legal-page-wrapper > .terms-page-inner { position: relative; z-index: 1; }
  .terms-page-inner {
    max-width: 1100px;
    margin: 0 auto;
    padding: 0 24px;
    display: flex;
    gap: 48px;
    align-items: flex-start;
  }
  .terms-page-main { flex: 1; min-width: 0; }
  .terms-sommaire-sidebar {
    width: 180px;
    flex-shrink: 0;
    position: sticky;
    top: 140px;
  }
  .terms-sommaire-title {
    font-size: 11px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.08em;
    color: rgba(75, 85, 99, 0.6);
    margin-bottom: 12px;
  }
  .terms-sommaire-list { list-style: none; padding: 0; margin: 0; }
  .terms-sommaire-list a {
    display: block;
    font-size: 12px;
    color: rgba(75, 85, 99, 0.7);
    text-decoration: none;
    padding: 4px 0;
    line-height: 1.4;
    transition: color 0.2s ease;
    border: none;
  }
  .terms-sommaire-list a:hover { color: #6366F1; }
  .terms-sommaire-mobile { display: none; margin-bottom: 24px; }
  .terms-sommaire-toggle {
    width: 100%;
    padding: 12px 16px;
    background: rgba(255, 255, 255, 0.9);
    border: 1px solid rgba(124, 58, 237, 0.12);
    border-radius: 12px;
    font-size: 14px;
    font-weight: 500;
    color: #4B5563;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: space-between;
    transition: all 0.2s ease;
  }
  .terms-sommaire-toggle:hover {
    background: rgba(255, 255, 255, 0.95);
    border-color: rgba(124, 58, 237, 0.2);
  }
  .terms-sommaire-toggle svg { transition: transform 0.2s ease; }
  .terms-sommaire-toggle[aria-expanded="true"] svg { transform: rotate(180deg); }
  .terms-sommaire-dropdown {
    position: absolute;
    top: 100%;
    left: 0;
    right: 0;
    margin-top: 4px;
    background: rgba(255, 255, 255, 0.98);
    border: 1px solid rgba(124, 58, 237, 0.12);
    border-radius: 12px;
    padding: 12px;
    box-shadow: 0 8px 24px rgba(15, 23, 42, 0.08);
    z-index: 10;
    max-height: 280px;
    overflow-y: auto;
  }
  .terms-sommaire-dropdown a {
    display: block;
    font-size: 13px;
    color: #4B5563;
    text-decoration: none;
    padding: 8px 12px;
    border-radius: 8px;
    transition: background 0.2s ease, color 0.2s ease;
    border: none;
  }
  .terms-sommaire-dropdown a:hover {
    background: rgba(99, 102, 241, 0.08);
    color: #6366F1;
  }
  .legal-page-header {
    text-align: center;
    margin-bottom: 48px;
    padding-bottom: 32px;
    border-bottom: 1px solid rgba(124, 58, 237, 0.08);
  }
  .legal-page-title {
    font-size: 42px;
    font-weight: 700;
    color: #111827;
    margin-bottom: 12px;
    line-height: 1.2;
    letter-spacing: -0.02em;
  }
  .legal-page-subtitle {
    font-size: 16px;
    color: #6B7280;
    font-weight: 400;
    line-height: 1.6;
    max-width: 600px;
    margin: 0 auto;
  }
  .legal-page-content {
    background: rgba(255, 255, 255, 0.97);
    border: 1px solid rgba(255, 255, 255, 0.8);
    border-radius: 24px;
    padding: 56px 64px;
    box-shadow: 0 4px 24px rgba(15, 23, 42, 0.04), 0 1px 3px rgba(15, 23, 42, 0.02);
    margin-bottom: 40px;
    position: relative;
    overflow: hidden;
  }
  .legal-page-content .terms-doc-body {
    max-width: 65ch;
    line-height: 1.85;
  }
  .legal-page-content h2 {
    font-size: 22px;
    font-weight: 600;
    color: #1F2937;
    margin-top: 48px;
    margin-bottom: 16px;
    line-height: 1.4;
    scroll-margin-top: 140px;
  }
  .legal-page-content h2:first-of-type { margin-top: 0; }
  .legal-page-content h3 {
    font-size: 18px;
    font-weight: 600;
    color: #374151;
    margin-top: 28px;
    margin-bottom: 12px;
    line-height: 1.5;
    scroll-margin-top: 140px;
  }
  .legal-page-content h4 {
    font-size: 16px;
    font-weight: 600;
    color: #4B5563;
    margin-top: 24px;
    margin-bottom: 10px;
    line-height: 1.5;
    scroll-margin-top: 140px;
  }
  .legal-page-content p {
    font-size: 16px;
    line-height: 1.85;
    color: #374151;
    margin-bottom: 20px;
  }
  .legal-page-content ul { margin: 20px 0; padding-left: 24px; }
  .legal-page-content ol { margin: 20px 0; padding-left: 24px; }
  .legal-page-content li { font-size: 16px; line-height: 1.85; color: #374151; margin-bottom: 10px; }
  .legal-page-content strong { font-weight: 600; color: #111827; }
  .legal-page-content a { color: #6366F1; text-decoration: none; border-bottom: 1px solid rgba(99, 102, 241, 0.3); }
  .legal-page-content a:hover { color: #4F46E5; border-bottom-color: #4F46E5; }
  .terms-section-sep {
    border: none;
    height: 1px;
    background: linear-gradient(90deg, transparent, rgba(124, 58, 237, 0.06), transparent);
    margin: 40px 0 32px;
  }
  .terms-callout {
    background: rgba(99, 102, 241, 0.04);
    border-left: 3px solid rgba(99, 102, 241, 0.35);
    padding: 20px 24px;
    margin: 24px 0;
    border-radius: 0 8px 8px 0;
  }
  .terms-callout p:last-child { margin-bottom: 0; }
  .legal-page-footer {
    text-align: center;
    margin-top: 48px;
    padding-top: 32px;
    border-top: 1px solid rgba(124, 58, 237, 0.08);
  }
  .legal-page-back-link {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    color: #FFFFFF;
    font-weight: 600;
    font-size: 16px;
    text-decoration: none;
    padding: 14px 28px;
    border-radius: 12px;
    background: linear-gradient(135deg, #6366F1 0%, #7C3AED 100%);
    transition: all 0.3s ease;
    box-shadow: 0 8px 24px rgba(99, 102, 241, 0.3), 0 4px 8px rgba(99, 102, 241, 0.2);
  }
  .legal-page-back-link:hover { transform: translateY(-2px); box-shadow: 0 12px 32px rgba(99, 102, 241, 0.4); }
  .terms-back-to-top {
    display: inline-block;
    margin-top: 16px;
    font-size: 14px;
    color: rgba(75, 85, 99, 0.7);
    text-decoration: none;
    transition: color 0.2s ease;
    border: none;
  }
  .terms-back-to-top:hover { color: #6366F1; }
  @media (max-width: 991px) {
    .terms-sommaire-sidebar { display: none; }
    .terms-sommaire-mobile { display: block; position: relative; }
  }
  @media (max-width: 768px) {
    .legal-page-wrapper { padding-top: 100px; padding-bottom: 60px; }
    .terms-page-inner { flex-direction: column; padding: 0 20px; }
    .legal-page-title { font-size: 32px; }
    .legal-page-subtitle { font-size: 15px; }
    .legal-page-content { padding: 32px 24px; border-radius: 20px; }
    .legal-page-content h2 { font-size: 20px; margin-top: 40px; scroll-margin-top: 120px; }
    .legal-page-content h3 { font-size: 17px; scroll-margin-top: 120px; }
    .legal-page-content .terms-doc-body { max-width: none; }
  }
</style>
<?php /**PATH C:\Users\younes\Downloads\junspro-main (1)\junspro-main3\resources\views\frontend\partials\legal-document-styles.blade.php ENDPATH**/ ?>