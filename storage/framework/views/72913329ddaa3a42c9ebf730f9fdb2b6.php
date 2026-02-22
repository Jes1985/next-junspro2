
<?php $__env->startSection('style'); ?>
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
  .legal-page-wrapper > .privacy-page-inner { position: relative; z-index: 1; }
  .privacy-page-inner {
    max-width: 1100px;
    margin: 0 auto;
    padding: 0 24px;
    display: flex;
    gap: 48px;
    align-items: flex-start;
  }
  .privacy-page-main { flex: 1; min-width: 0; }
  .privacy-sommaire-sidebar {
    width: 180px;
    flex-shrink: 0;
    position: sticky;
    top: 140px;
  }
  .privacy-sommaire-title {
    font-size: 11px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.08em;
    color: rgba(75, 85, 99, 0.6);
    margin-bottom: 12px;
  }
  .privacy-sommaire-list { list-style: none; padding: 0; margin: 0; }
  .privacy-sommaire-list a {
    display: block;
    font-size: 12px;
    color: rgba(75, 85, 99, 0.7);
    text-decoration: none;
    padding: 4px 0;
    line-height: 1.4;
    transition: color 0.2s ease;
    border: none;
  }
  .privacy-sommaire-list a:hover { color: #6366F1; }
  .privacy-sommaire-mobile { display: none; margin-bottom: 24px; }
  .privacy-sommaire-toggle {
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
  .privacy-sommaire-toggle:hover {
    background: rgba(255, 255, 255, 0.95);
    border-color: rgba(124, 58, 237, 0.2);
  }
  .privacy-sommaire-toggle[aria-expanded="true"] svg { transform: rotate(180deg); }
  .privacy-sommaire-dropdown {
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
    max-height: 320px;
    overflow-y: auto;
  }
  .privacy-sommaire-dropdown a {
    display: block;
    font-size: 13px;
    color: #4B5563;
    text-decoration: none;
    padding: 8px 12px;
    border-radius: 8px;
    transition: background 0.2s ease, color 0.2s ease;
    border: none;
  }
  .privacy-sommaire-dropdown a:hover {
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
  .legal-page-content .privacy-doc-body { max-width: 65ch; line-height: 1.85; }
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
  .privacy-section-sep {
    border: none;
    height: 1px;
    background: linear-gradient(90deg, transparent, rgba(124, 58, 237, 0.06), transparent);
    margin: 40px 0 32px;
  }
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
  .privacy-back-to-top {
    display: inline-block;
    margin-top: 16px;
    font-size: 14px;
    color: rgba(75, 85, 99, 0.7);
    text-decoration: none;
    transition: color 0.2s ease;
    border: none;
  }
  .privacy-back-to-top:hover { color: #6366F1; }
  @media (max-width: 991px) {
    .privacy-sommaire-sidebar { display: none; }
    .privacy-sommaire-mobile { display: block; position: relative; }
  }
  @media (max-width: 768px) {
    .legal-page-wrapper { padding-top: 100px; padding-bottom: 60px; }
    .privacy-page-inner { flex-direction: column; padding: 0 20px; }
    .legal-page-title { font-size: 32px; }
    .legal-page-subtitle { font-size: 15px; }
    .legal-page-content { padding: 32px 24px; border-radius: 20px; }
    .legal-page-content h2 { font-size: 20px; margin-top: 40px; scroll-margin-top: 120px; }
    .legal-page-content .privacy-doc-body { max-width: none; }
  }
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('pageHeading'); ?>
    <?php echo e(__('Politique de confidentialité')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('metaKeywords'); ?>
    politique de confidentialité, JUNSPRO, données personnelles, RGPD, cookies
<?php $__env->stopSection(); ?>

<?php $__env->startSection('metaDescription'); ?>
    Politique de confidentialité JUNSPRO — Collecte, utilisation et protection des données personnelles sur la plateforme.
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="legal-page-wrapper">
        <div class="privacy-page-inner">
            <aside class="privacy-sommaire-sidebar">
                <div class="privacy-sommaire-title"><?php echo e(__('Sommaire')); ?></div>
                <ul class="privacy-sommaire-list">
                    <li><a href="#controller">1) Responsable</a></li>
                    <li><a href="#data">2) Données</a></li>
                    <li><a href="#purposes">3) Finalités</a></li>
                    <li><a href="#payment">5) Paiement</a></li>
                    <li><a href="#sharing">7) Partage</a></li>
                    <li><a href="#rights">10) Vos droits</a></li>
                    <li><a href="#cookies">11) Cookies</a></li>
                    <li><a href="#update">14) Mise à jour</a></li>
                </ul>
            </aside>

            <main class="privacy-page-main">
                <div class="legal-page-header">
                    <h1 class="legal-page-title"><?php echo e(__('Politique de confidentialité')); ?></h1>
                    <p class="legal-page-subtitle">
                        <?php echo e(__('Document officiel')); ?> • <?php echo e(__('Dernière mise à jour')); ?> : 13/02/2026
                    </p>
                </div>

                <div class="privacy-sommaire-mobile">
                    <button type="button" class="privacy-sommaire-toggle" aria-expanded="false" aria-controls="privacy-sommaire-dropdown" id="privacy-sommaire-btn">
                        <?php echo e(__('Sommaire')); ?>

                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M6 9l6 6 6-6"/></svg>
                    </button>
                    <div class="privacy-sommaire-dropdown" id="privacy-sommaire-dropdown" hidden>
                        <a href="#controller">1) Responsable</a>
                        <a href="#data">2) Données</a>
                        <a href="#purposes">3) Finalités</a>
                        <a href="#payment">5) Paiement</a>
                        <a href="#sharing">7) Partage</a>
                        <a href="#rights">10) Vos droits</a>
                        <a href="#cookies">11) Cookies</a>
                        <a href="#update">14) Mise à jour</a>
                    </div>
                </div>

                <div class="legal-page-content summernote-content">
                    <div class="privacy-doc-body">
                        <p>La présente Politique de confidentialité explique comment JUNSPRO collecte, utilise et protège vos données personnelles lorsque vous utilisez la plateforme (la « Plateforme »). Elle s'applique aux visiteurs, Clients et Freelances.</p>

                        <h2 id="controller">1) Responsable du traitement</h2>
                        <p><strong>JUNSPRO</strong></p>
                        <p>Éditeur : Jésula SIMON, Entrepreneur Individuel (micro-entreprise)</p>
                        <p>Siège social : 6 rue de Montbrillant, 69003 Lyon, France</p>
                        <p>Contact : contact@junspro.com</p>

                        <hr class="privacy-section-sep">

                        <h2 id="data">2) Données que nous traitons</h2>
                        <p>Selon votre utilisation de la Plateforme, nous pouvons traiter notamment :</p>
                        <ul>
                            <li><strong>Identification</strong> : nom, prénom, email, mot de passe (haché), photo (facultative).</li>
                            <li><strong>Compte & profil</strong> : type de compte (Client/Freelance), préférences, paramètres.</li>
                            <li><strong>Contenus publiés</strong> : textes, visuels, logo, réalisations/portfolio, descriptions, documents, messages.</li>
                            <li><strong>Missions & échanges</strong> : demandes, conversations, fichiers transmis, historique.</li>
                            <li><strong>Paiement & facturation</strong> : statut, références de transaction, informations de facturation (hors données de carte).</li>
                            <li><strong>Données techniques</strong> : IP, logs, session, navigateur/appareil, pages consultées (selon configuration cookies).</li>
                        </ul>

                        <hr class="privacy-section-sep">

                        <h2 id="purposes">3) Pourquoi nous utilisons vos données (finalités)</h2>
                        <p>Nous utilisons vos données pour :</p>
                        <ul>
                            <li>Créer et gérer votre compte (accès, sécurité).</li>
                            <li>Fournir la mise en relation et les fonctionnalités de la Plateforme.</li>
                            <li>Assurer la sécurité (prévention fraude/abus, incidents).</li>
                            <li>Gérer les paiements et l'administratif lorsque ces services sont activés.</li>
                            <li>Support et gestion des demandes.</li>
                            <li>Amélioration de la Plateforme (mesure d'audience, performance) selon vos choix.</li>
                            <li>Communications : informations de service, et, si applicable, communications marketing (selon consentement).</li>
                        </ul>

                        <h2 id="legal-basis">4) Bases légales (RGPD)</h2>
                        <p>Selon les cas, les traitements reposent sur :</p>
                        <ul>
                            <li>l'exécution d'un contrat (services de la Plateforme),</li>
                            <li>l'intérêt légitime (sécurité, amélioration),</li>
                            <li>le consentement (newsletter, certains cookies),</li>
                            <li>des obligations légales (facturation, comptabilité).</li>
                        </ul>

                        <h2 id="payment">5) Paiement sécurisé (Stripe)</h2>
                        <p>Lorsque les paiements sont activés, ils peuvent être traités via un prestataire sécurisé tel que Stripe.</p>
                        <p>JUNSPRO ne stocke pas vos données de carte bancaire ; Stripe traite ces informations selon ses propres standards de sécurité.</p>

                        <h2 id="hosting">6) Hébergement</h2>
                        <p>La Plateforme est hébergée par IONOS.</p>

                        <h2 id="sharing">7) Partage des données</h2>
                        <p>Nous ne vendons pas vos données.</p>
                        <p>Vos données peuvent être partagées uniquement :</p>
                        <ul>
                            <li>avec les équipes habilitées JUNSPRO,</li>
                            <li>avec des prestataires techniques nécessaires (hébergement, paiement, emailing, analytics), agissant comme sous-traitants.</li>
                        </ul>

                        <h2 id="transfers">8) Transferts internationaux</h2>
                        <p>Certains prestataires peuvent traiter des données hors UE. Lorsque requis, des garanties appropriées peuvent être mises en place (ex. clauses contractuelles types).</p>

                        <h2 id="retention">9) Durées de conservation</h2>
                        <p>Nous conservons vos données pendant la durée nécessaire :</p>
                        <ul>
                            <li><strong>Compte</strong> : tant que le compte est actif, puis suppression/anonymisation raisonnable.</li>
                            <li><strong>Transactions / facturation</strong> : conservation légale applicable.</li>
                            <li><strong>Support</strong> : durée du traitement puis archivage limité.</li>
                            <li><strong>Logs sécurité</strong> : durée courte et proportionnée.</li>
                        </ul>

                        <hr class="privacy-section-sep">

                        <h2 id="rights">10) Vos droits</h2>
                        <p>Vous pouvez demander : accès, rectification, suppression, limitation, opposition, portabilité (selon cas) et retrait du consentement.</p>
                        <p>Contact : <a href="mailto:contact@junspro.com">contact@junspro.com</a></p>
                        <p>Vous pouvez également saisir l'autorité de contrôle compétente (CNIL en France).</p>

                        <h2 id="cookies">11) Cookies</h2>
                        <p>La Plateforme peut utiliser :</p>
                        <ul>
                            <li>des cookies nécessaires au fonctionnement et à la sécurité,</li>
                            <li>des cookies optionnels (mesure d'audience, amélioration) selon vos choix via la bannière/centre de préférences (si activé).</li>
                        </ul>

                        <h2 id="security">12) Sécurité</h2>
                        <p>Nous appliquons des mesures de sécurité raisonnables (contrôles d'accès, protection des comptes, journalisation, sauvegardes). Aucune mesure n'offre une sécurité absolue.</p>

                        <h2 id="visibility">13) Contenus publiés et visibilité</h2>
                        <p>Les informations que vous choisissez de publier sur votre profil (portfolio, réalisations, logo, visuels) peuvent être visibles sur la Plateforme selon les paramètres et fonctionnalités disponibles.</p>

                        <h2 id="update">14) Mise à jour de la politique</h2>
                        <p>Nous pouvons mettre à jour cette Politique. La version publiée sur la Plateforme est la version applicable.</p>
                        <p><em>Dernière mise à jour : 13/02/2026</em></p>
                    </div>
                </div>

                <div class="legal-page-footer">
                    <a href="<?php echo e(route('index')); ?>" class="legal-page-back-link">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M19 12H5M12 19l-7-7 7-7"/>
                        </svg>
                        <?php echo e(__('Retour à l\'accueil')); ?>

                    </a>
                    <a href="#" class="privacy-back-to-top" id="privacy-back-to-top"><?php echo e(__('Retour en haut')); ?></a>
                </div>
            </main>
        </div>
    </div>

    <script>
    (function() {
      var btn = document.getElementById('privacy-sommaire-btn');
      var dropdown = document.getElementById('privacy-sommaire-dropdown');
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
      var backToTop = document.getElementById('privacy-back-to-top');
      if (backToTop) {
        backToTop.addEventListener('click', function(e) {
          e.preventDefault();
          window.scrollTo({ top: 0, behavior: 'smooth' });
        });
      }
    })();
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\younes\Downloads\junspro-main (1)\junspro-main3\resources\views\frontend\privacy-policy.blade.php ENDPATH**/ ?>