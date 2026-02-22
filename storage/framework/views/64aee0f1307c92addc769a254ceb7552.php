<?php $__env->startSection('style'); ?>
<?php echo $__env->make('frontend.partials.legal-document-styles', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('pageHeading'); ?>
    <?php echo e(__('Mentions légales')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('metaKeywords'); ?>
    mentions légales, JUNSPRO, éditeur, hébergement, IONOS
<?php $__env->stopSection(); ?>

<?php $__env->startSection('metaDescription'); ?>
    Mentions légales de JUNSPRO — Éditeur, hébergement, propriété intellectuelle, données personnelles, cookies.
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<?php
  $toc = [
    ['label' => 'Éditeur du site', 'href' => '#editeur'],
    ['label' => 'Hébergement', 'href' => '#hebergement'],
    ['label' => 'Activité de la plateforme', 'href' => '#activite'],
    ['label' => 'Paiement sécurisé', 'href' => '#paiement'],
    ['label' => 'Propriété intellectuelle', 'href' => '#propriete-intellectuelle'],
    ['label' => 'Données personnelles', 'href' => '#donnees-personnelles'],
    ['label' => 'Cookies', 'href' => '#cookies'],
    ['label' => 'Responsabilité', 'href' => '#responsabilite'],
    ['label' => 'Droit applicable — Litiges', 'href' => '#droit-applicable'],
    ['label' => 'Médiation (si applicable)', 'href' => '#mediation'],
  ];
?>
<?php if (isset($component)) { $__componentOriginal24a4e002f4b5adc6294b426518657882 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal24a4e002f4b5adc6294b426518657882 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.legal-document-layout','data' => ['title' => __('Mentions légales'),'updatedAt' => '13/02/2026','toc' => $toc,'prefix' => 'mentions']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('legal-document-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('Mentions légales')),'updatedAt' => '13/02/2026','toc' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($toc),'prefix' => 'mentions']); ?>
  <h2 id="editeur">Éditeur du site</h2>
  <p><strong>JUNSPRO</strong></p>
  <p>Éditeur : Jésula SIMON, Entrepreneur Individuel (EI) — micro-entreprise</p>
  <p>Siège social : 6 rue de Montbrillant, 69003 Lyon, France</p>
  <p>Email : <a href="mailto:contact@junspro.com">contact@junspro.com</a></p>
  <p>Téléphone : +33 6 22 86 94 22 — contact en ligne privilégié (réponse plus rapide via formulaire/email).</p>
  <p>SIRET : en cours d'attribution</p>
  <p>Immatriculation : RCS Lyon — en cours (si applicable)</p>
  <p>TVA : TVA non applicable — art. 293 B du CGI (franchise en base)</p>
  <p>N° TVA intracommunautaire : non attribué (franchise en base)</p>
  <p>Directeur de la publication : Jésula SIMON</p>

  <hr class="terms-section-sep">

  <h2 id="hebergement">Hébergement</h2>
  <p><strong>IONOS SE</strong></p>
  <p>Elgendorfer Str. 57, 56410 Montabaur, Allemagne</p>
  <p>Téléphone : 0970 808 911</p>

  <hr class="terms-section-sep">

  <h2 id="activite">Activité de la plateforme</h2>
  <p>JUNSPRO est une plateforme de mise en relation entre clients (entreprises et particuliers) et freelances, visant à faciliter la découverte d'opportunités, la structuration des échanges et la réalisation de prestations.</p>

  <hr class="terms-section-sep">

  <h2 id="paiement">Paiement sécurisé</h2>
  <p>Les paiements effectués sur JUNSPRO sont traités via une solution de paiement sécurisée (Stripe). Certaines informations strictement nécessaires au traitement des transactions peuvent être transmises au prestataire de paiement.</p>

  <hr class="terms-section-sep">

  <h2 id="propriete-intellectuelle">Propriété intellectuelle</h2>
  <p>L'ensemble des éléments du site JUNSPRO (marque, logo, charte graphique, textes, visuels, interfaces, bases de données, etc.) est protégé par le droit de la propriété intellectuelle.</p>
  <p>Toute reproduction, représentation, adaptation ou exploitation, totale ou partielle, sans autorisation écrite préalable de l'éditeur, est interdite.</p>

  <hr class="terms-section-sep">

  <h2 id="donnees-personnelles">Données personnelles</h2>
  <p>JUNSPRO traite des données personnelles dans le cadre de son fonctionnement (création de compte, mise en relation, sécurité, paiement, etc.).</p>
  <p>Les informations détaillées sur les traitements et les droits des utilisateurs sont disponibles dans la <a href="<?php echo e(route('dynamic_page', ['slug' => 'politique-de-confidentialite'])); ?>">Politique de confidentialité</a> (page dédiée à publier sur le site).</p>

  <hr class="terms-section-sep">

  <h2 id="cookies">Cookies</h2>
  <p>Le site peut utiliser des cookies et traceurs nécessaires au fonctionnement, à la mesure d'audience et à l'amélioration de l'expérience utilisateur.</p>
  <p>La gestion des préférences cookies est accessible via l'outil dédié (bannière / centre de préférences).</p>

  <hr class="terms-section-sep">

  <h2 id="responsabilite">Responsabilité</h2>
  <p>JUNSPRO met en œuvre des moyens raisonnables pour assurer l'accès et la mise à jour du site, sans garantir l'absence d'erreurs.</p>
  <p>Les contenus publiés par les utilisateurs (profils, annonces, descriptions, messages, etc.) demeurent sous leur responsabilité.</p>

  <hr class="terms-section-sep">

  <h2 id="droit-applicable">Droit applicable — Litiges</h2>
  <p>Les présentes mentions légales sont soumises au droit français.</p>
  <p>En cas de litige, une tentative de résolution amiable sera privilégiée avant toute action judiciaire.</p>

  <hr class="terms-section-sep">

  <h2 id="mediation">Médiation de la consommation (si clients particuliers)</h2>
  <p>Conformément au Code de la consommation, tout consommateur peut recourir gratuitement à un médiateur de la consommation après démarche préalable écrite auprès du service client.</p>
  <p>Médiateur : à désigner avant ouverture B2C complète.</p>

  <p><em>Dernière mise à jour : 13/02/2026</em></p>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal24a4e002f4b5adc6294b426518657882)): ?>
<?php $attributes = $__attributesOriginal24a4e002f4b5adc6294b426518657882; ?>
<?php unset($__attributesOriginal24a4e002f4b5adc6294b426518657882); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal24a4e002f4b5adc6294b426518657882)): ?>
<?php $component = $__componentOriginal24a4e002f4b5adc6294b426518657882; ?>
<?php unset($__componentOriginal24a4e002f4b5adc6294b426518657882); ?>
<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\younes\Downloads\junspro-main (1)\junspro-main3\resources\views\frontend\mentions-legales.blade.php ENDPATH**/ ?>