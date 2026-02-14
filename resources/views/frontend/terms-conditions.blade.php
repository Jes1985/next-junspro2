@extends('frontend.layout')
@section('style')
<link rel="stylesheet" href="{{ asset('assets/css/summernote-content.css') }}">
<style>
  /* Categories hidden */
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

  /* 1) Fond wash premium — très léger */
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

  /* Micro-grain subtil */
  .legal-page-wrapper::before {
    content: "";
    position: absolute;
    inset: 0;
    background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 256 256' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='noise'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23noise)' opacity='0.03'/%3E%3C/svg%3E");
    pointer-events: none;
    z-index: 0;
    opacity: 0.4;
  }

  /* Vignettage doux */
  .legal-page-wrapper::after {
    content: "";
    position: fixed;
    inset: 0;
    background: radial-gradient(ellipse 80% 70% at 50% 50%, transparent 40%, rgba(15, 23, 42, 0.03) 100%);
    pointer-events: none;
    z-index: 998;
  }

  .legal-page-wrapper > .terms-page-inner { position: relative; z-index: 1; }

  /* Layout 2 colonnes desktop */
  .terms-page-inner {
    max-width: 1100px;
    margin: 0 auto;
    padding: 0 24px;
    display: flex;
    gap: 48px;
    align-items: flex-start;
  }

  .terms-page-main { flex: 1; min-width: 0; }

  /* Sommaire sidebar — desktop */
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

  .terms-sommaire-list {
    list-style: none;
    padding: 0;
    margin: 0;
  }

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

  .terms-sommaire-list a:hover {
    color: #6366F1;
  }

  /* Mobile sommaire */
  .terms-sommaire-mobile {
    display: none;
    margin-bottom: 24px;
  }

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

  .terms-sommaire-toggle svg {
    transition: transform 0.2s ease;
  }

  .terms-sommaire-toggle[aria-expanded="true"] svg {
    transform: rotate(180deg);
  }

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

  /* Header */
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

  /* 2) Carte document premium */
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

  /* Typo — line-height augmenté, max-width lecture */
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

  .legal-page-content p {
    font-size: 16px;
    line-height: 1.85;
    color: #374151;
    margin-bottom: 20px;
  }

  .legal-page-content ul { margin: 20px 0; padding-left: 24px; }
  .legal-page-content li { font-size: 16px; line-height: 1.85; color: #374151; margin-bottom: 10px; }
  .legal-page-content strong { font-weight: 600; color: #111827; }
  .legal-page-content a { color: #6366F1; text-decoration: none; border-bottom: 1px solid rgba(99, 102, 241, 0.3); }
  .legal-page-content a:hover { color: #4F46E5; border-bottom-color: #4F46E5; }

  /* Séparateurs */
  .terms-section-sep {
    border: none;
    height: 1px;
    background: linear-gradient(90deg, transparent, rgba(124, 58, 237, 0.06), transparent);
    margin: 40px 0 32px;
  }

  /* Callouts */
  .terms-callout {
    background: rgba(99, 102, 241, 0.04);
    border-left: 3px solid rgba(99, 102, 241, 0.35);
    padding: 20px 24px;
    margin: 24px 0;
    border-radius: 0 8px 8px 0;
  }

  .terms-callout p:last-child { margin-bottom: 0; }

  /* Footer */
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

  /* Responsive */
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
    .legal-page-content .terms-doc-body { max-width: none; }
  }
</style>
@endsection

@section('pageHeading')
    {{ __('Termes et conditions') }}
@endsection

@section('metaKeywords')
    termes et conditions, JUNSPRO, plateforme, CGU, conditions d'utilisation
@endsection

@section('metaDescription')
    Termes et conditions d'utilisation de la plateforme JUNSPRO — Règles, définitions, propriété intellectuelle, données personnelles.
@endsection

@section('content')
    <div class="legal-page-wrapper">
        <div class="terms-page-inner">
            {{-- Sommaire desktop (sticky) --}}
            <aside class="terms-sommaire-sidebar">
                <div class="terms-sommaire-title">{{ __('Sommaire') }}</div>
                <ul class="terms-sommaire-list">
                    <li><a href="#who">1) Qui sommes-nous</a></li>
                    <li><a href="#definitions">2) Définitions</a></li>
                    <li><a href="#platform-role">3) Rôle de la Plateforme</a></li>
                    <li><a href="#ugc">6) Contenus utilisateurs (UGC)</a></li>
                    <li><a href="#payments">8) Paiement</a></li>
                    <li><a href="#privacy">10) Données personnelles</a></li>
                    <li><a href="#liability">12) Responsabilité</a></li>
                    <li><a href="#law">15) Droit applicable</a></li>
                    <li><a href="#contact">16) Contact</a></li>
                </ul>
            </aside>

            <main class="terms-page-main">
                <div class="legal-page-header">
                    <h1 class="legal-page-title">{{ __('Termes et conditions') }}</h1>
                    <p class="legal-page-subtitle">
                        {{ __('Document officiel') }} • {{ __('Dernière mise à jour') }} : 13/02/2026
                    </p>
                </div>

                {{-- Sommaire mobile (accordion) --}}
                <div class="terms-sommaire-mobile">
                    <button type="button" class="terms-sommaire-toggle" aria-expanded="false" aria-controls="terms-sommaire-dropdown" id="terms-sommaire-btn">
                        {{ __('Sommaire') }}
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M6 9l6 6 6-6"/></svg>
                    </button>
                    <div class="terms-sommaire-dropdown" id="terms-sommaire-dropdown" hidden>
                        <a href="#who">1) Qui sommes-nous</a>
                        <a href="#definitions">2) Définitions</a>
                        <a href="#platform-role">3) Rôle de la Plateforme</a>
                        <a href="#ugc">6) Contenus utilisateurs (UGC)</a>
                        <a href="#payments">8) Paiement</a>
                        <a href="#privacy">10) Données personnelles</a>
                        <a href="#liability">12) Responsabilité</a>
                        <a href="#law">15) Droit applicable</a>
                        <a href="#contact">16) Contact</a>
                    </div>
                </div>

                <div class="legal-page-content summernote-content">
                    <div class="terms-doc-body">
                        <p>Les présents Termes et Conditions (les « Conditions ») définissent les règles d'utilisation de la plateforme JUNSPRO (la « Plateforme »). En accédant à la Plateforme, en créant un compte ou en utilisant nos services, vous acceptez ces Conditions.</p>

                        <h2 id="who">1) Qui sommes-nous</h2>
                        <p><strong>JUNSPRO</strong></p>
                        <p>Éditeur : Jésula SIMON, Entrepreneur Individuel (micro-entreprise)</p>
                        <p>Siège social : 6 rue de Montbrillant, 69003 Lyon, France</p>
                        <p>Email : contact@junspro.com</p>
                        <p>Téléphone : +33 6 22 86 94 22 (contact en ligne privilégié via email/formulaire)</p>
                        <p>SIRET : en cours d'attribution</p>
                        <p>TVA : TVA non applicable — art. 293 B du CGI (franchise en base)</p>

                        <hr class="terms-section-sep">

                        <h2 id="definitions">2) Définitions (lecture rapide)</h2>
                        <p><strong>Client</strong> : personne (particulier ou organisation) publiant une demande/mission ou recherchant un freelance.</p>
                        <p><strong>Freelance</strong> : prestataire indépendant proposant ses services via la Plateforme.</p>
                        <p><strong>Compte</strong> : espace personnel permettant d'accéder aux fonctionnalités de la Plateforme.</p>
                        <p><strong>Contenu</strong> : informations, textes, logos, visuels, réalisations/portfolio, descriptions et messages publiés/transmis via la Plateforme.</p>
                        <p><strong>Services</strong> : fonctionnalités de mise en relation, d'outillage, de méthode (rituel), et de paiement/administratif lorsque disponibles.</p>

                        <hr class="terms-section-sep">

                        <h2 id="platform-role">3) Rôle de la Plateforme (important)</h2>
                        <div class="terms-callout">
                            <p>JUNSPRO fournit une plateforme de mise en relation et d'outillage. Sauf mention explicite, JUNSPRO n'est pas :</p>
                            <ul>
                                <li>l'employeur des freelances,</li>
                                <li>l'agent/mandataire du freelance ou du client,</li>
                                <li>responsable de la qualité de la prestation réalisée entre utilisateurs.</li>
                            </ul>
                            <p>JUNSPRO peut proposer une méthode de collaboration (ex : Rituel : 50 min Focus • 10 min Feedback • Plan d'action) et des fonctionnalités de paiement/administratif. JUNSPRO ne garantit pas l'obtention de missions, de résultats ou de revenus.</p>
                        </div>

                        <h2 id="access">4) Accès, compte et sécurité</h2>
                        <p>Vous vous engagez à fournir des informations exactes, à maintenir la confidentialité de vos identifiants et à sécuriser votre Compte. Vous êtes responsable des activités réalisées depuis votre Compte, sauf usage frauduleux dûment prouvé.</p>
                        <p>JUNSPRO peut refuser, suspendre ou supprimer un Compte en cas de non-respect des Conditions, de risque de sécurité, ou d'usage abusif.</p>

                        <h2 id="usage">5) Usage acceptable</h2>
                        <p>Il est interdit de :</p>
                        <ul>
                            <li>publier des contenus illicites, trompeurs, diffamatoires, haineux, violents ou portant atteinte aux droits d'autrui ;</li>
                            <li>usurper une identité, falsifier des éléments, contourner les mécanismes de sécurité ;</li>
                            <li>collecter des données d'utilisateurs sans autorisation ;</li>
                            <li>utiliser la Plateforme à des fins de spam, démarchage abusif ou harcèlement ;</li>
                            <li>perturber le fonctionnement technique (scraping non autorisé, surcharge, attaques, etc.).</li>
                        </ul>
                        <p>JUNSPRO peut modérer, masquer ou supprimer tout contenu non conforme et prendre des mesures sur les comptes concernés.</p>

                        <hr class="terms-section-sep">

                        <h2 id="ugc">6) Contenus utilisateurs — propriété et licence (UGC)</h2>
                        <div class="terms-callout">
                            <p><strong>Propriété.</strong> Chaque utilisateur conserve l'ensemble de ses droits sur son Contenu.</p>
                            <p><strong>Licence à JUNSPRO.</strong> En publiant du Contenu sur la Plateforme, l'utilisateur concède à JUNSPRO une licence non exclusive, mondiale, gratuite, pour la durée de mise en ligne (augmentée de délais techniques raisonnables de sauvegarde/archivage), afin de :</p>
                            <ul>
                                <li>héberger, stocker, reproduire, afficher et communiquer le Contenu au public sur la Plateforme ;</li>
                                <li>effectuer des adaptations strictement techniques (format, compression, dimensions, accessibilité) ;</li>
                                <li>présenter et promouvoir la Plateforme de manière raisonnable (ex : pages de mise en avant sur JUNSPRO, supports de présentation, newsletter, réseaux sociaux JUNSPRO), sans dénaturer le Contenu.</li>
                            </ul>
                            <p><strong>Publicité sponsorisée / cas client nominatif.</strong> La mise en avant d'un Contenu dans des campagnes publicitaires payantes (annonces sponsorisées) ou dans un cas client nominatif peut être soumise à un accord exprès de l'utilisateur via un réglage/opt-in dédié lorsque cela est requis.</p>
                            <p><strong>Garanties.</strong> L'utilisateur garantit disposer des droits et autorisations nécessaires sur le Contenu (y compris marques/logos et droit à l'image le cas échéant).</p>
                        </div>

                        <h2 id="ip">7) Propriété intellectuelle de JUNSPRO</h2>
                        <p>La Plateforme (marque, logo, design, textes, bases de données, code, éléments d'interface) est protégée. Toute reproduction ou exploitation non autorisée est interdite.</p>

                        <hr class="terms-section-sep">

                        <h2 id="payments">8) Paiement et traitement via prestataire (le cas échéant)</h2>
                        <div class="terms-callout">
                            <p>Certaines transactions peuvent être traitées via un prestataire de paiement (ex : Stripe). Les informations nécessaires au traitement peuvent être transmises au prestataire conformément à sa documentation et à la politique de confidentialité de JUNSPRO.</p>
                            <p>JUNSPRO peut mettre à disposition des automatisations liées au paiement et à l'administratif (ex : suivi, justificatifs), sans garantir l'absence d'erreurs ni se substituer aux obligations légales/fiscales propres à chaque utilisateur.</p>
                        </div>

                        <h2 id="moderation">9) Signalement, modération et conformité</h2>
                        <p>Vous pouvez signaler un contenu ou un comportement via les moyens de contact. JUNSPRO se réserve le droit de prendre toute mesure raisonnable de modération/sécurité.</p>

                        <h2 id="privacy">10) Données personnelles et cookies</h2>
                        <p>JUNSPRO traite des données personnelles dans le cadre du fonctionnement (création de compte, mise en relation, sécurité, paiement, etc.). Les informations détaillées figurent dans la <a href="{{ url('/privacy-policy') }}">Politique de confidentialité</a> et les informations cookies dans la section dédiée, accessibles depuis le site.</p>

                        <h2 id="availability">11) Disponibilité — sécurité</h2>
                        <p>JUNSPRO met en œuvre des moyens raisonnables pour assurer l'accès et la mise à jour de la Plateforme, sans garantir une disponibilité continue ni l'absence d'erreurs.</p>

                        <hr class="terms-section-sep">

                        <h2 id="liability">12) Responsabilité</h2>
                        <p>Dans la mesure permise par la loi applicable, JUNSPRO ne pourra être tenu responsable des dommages indirects, pertes de profit, pertes de données, ou conséquences liées à des échanges/contrats entre utilisateurs.</p>
                        <p>Les contenus publiés par les utilisateurs demeurent sous leur responsabilité.</p>

                        <h2 id="suspension">13) Suspension / résiliation</h2>
                        <p>JUNSPRO peut suspendre ou résilier l'accès en cas de violation des Conditions, de risque de sécurité ou de comportement abusif. L'utilisateur peut cesser d'utiliser la Plateforme à tout moment (les effets sur des services en cours dépendent des fonctionnalités disponibles au moment concerné).</p>

                        <h2 id="modifications">14) Modifications des Conditions</h2>
                        <p>JUNSPRO peut modifier les présentes Conditions. La version en vigueur est celle publiée sur le site avec sa date de mise à jour. En continuant à utiliser la Plateforme après modification, vous acceptez les Conditions mises à jour.</p>

                        <hr class="terms-section-sep">

                        <h2 id="law">15) Droit applicable — litiges</h2>
                        <p>Ces Conditions sont régies par le droit applicable au siège de l'éditeur dans la mesure permise, sans préjudice des dispositions impératives éventuellement applicables au lieu de résidence de l'utilisateur (notamment pour les consommateurs). En cas de litige, une tentative de résolution amiable sera privilégiée avant toute action.</p>

                        <h2 id="contact">16) Contact</h2>
                        <p>Support / demandes : <a href="mailto:contact@junspro.com">contact@junspro.com</a></p>
                    </div>
                </div>

                <div class="legal-page-footer">
                    <a href="{{ route('index') }}" class="legal-page-back-link">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M19 12H5M12 19l-7-7 7-7"/>
                        </svg>
                        {{ __('Retour à l\'accueil') }}
                    </a>
                    <a href="#" class="terms-back-to-top" id="terms-back-to-top">{{ __('Retour en haut') }}</a>
                </div>
            </main>
        </div>
    </div>

    <script>
    (function() {
      var btn = document.getElementById('terms-sommaire-btn');
      var dropdown = document.getElementById('terms-sommaire-dropdown');
      if (btn && dropdown) {
        btn.addEventListener('click', function(e) {
          e.stopPropagation();
          var expanded = btn.getAttribute('aria-expanded') === 'true';
          btn.setAttribute('aria-expanded', !expanded);
          dropdown.hidden = expanded;
        });
        document.addEventListener('click', function(e) {
          if (!btn.contains(e.target) && !dropdown.contains(e.target)) {
            btn.setAttribute('aria-expanded', 'false');
            dropdown.hidden = true;
          }
        });
        dropdown.querySelectorAll('a').forEach(function(link) {
          link.addEventListener('click', function() {
            btn.setAttribute('aria-expanded', 'false');
            dropdown.hidden = true;
          });
        });
      }
      var backToTop = document.getElementById('terms-back-to-top');
      if (backToTop) {
        backToTop.addEventListener('click', function(e) {
          e.preventDefault();
          window.scrollTo({ top: 0, behavior: 'smooth' });
        });
      }
    })();
    </script>
@endsection
