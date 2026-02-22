<?php $__env->startSection('pageHeading'); ?>
  <?php if(!empty($pageHeading)): ?>
    <?php echo e($pageHeading->faq_page_title); ?>

  <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('metaKeywords'); ?>
  <?php if(!empty($seoInfo)): ?>
    <?php echo e($seoInfo->meta_keyword_faq); ?>

  <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('metaDescription'); ?>
  <?php if(!empty($seoInfo)): ?>
    <?php echo e($seoInfo->meta_description_faq); ?>

  <?php endif; ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<?php
  $faqs = [
    // Fonctionnement général
    ['category' => 'Fonctionnement général', 'question' => 'Qu’est-ce que Junspro ?', 'answer' => "<p>Junspro est une plateforme premium qui met en relation des clients et des freelances experts pour des projets professionnels.</p><p>La particularité de Junspro : tout fonctionne par abonnements hebdomadaires basés sur un nombre d’heures par semaine, avec un suivi structuré (50 minutes de travail + 10 minutes de rapport) et des règles claires sur le planning, la reprogrammation et les transferts d’abonnement.</p>"],
    ['category' => 'Fonctionnement général', 'question' => 'En quoi Junspro est différent des plateformes classiques de freelances ?', 'answer' => "<p>Sur les plateformes classiques, on paie souvent au projet ou au forfait, avec peu de visibilité sur le temps réellement passé.</p><p>Sur Junspro, vous achetez du temps de travail qualifié sous forme d’heures par semaine sur 4 semaines, avec :</p><ul><li>des sessions structurées : 50 min travail + 10 min rapport,</li><li>des livraisons hebdomadaires obligatoires,</li><li>des règles strictes si le freelance ne respecte pas ses engagements (reprogrammation, transferts).</li></ul><p>Résultat : plus de transparence, de contrôle et de continuité dans vos projets.</p>"],
    ['category' => 'Fonctionnement général', 'question' => 'Junspro est-il une agence qui gère le projet à ma place ?', 'answer' => "<p>Junspro n’est pas une agence classique qui pilote tout à votre place.</p><p>Nous fournissons :</p><ul><li>une infrastructure fiable (paiements, planning, livraisons, transferts),</li><li>des freelances sélectionnés,</li><li>et des services premium d’accompagnement (MatchDirect™, Conciergerie complète, Audit Express…).</li></ul><p>Vous gardez la main sur votre projet (brief, priorités, validation), tout en travaillant dans un cadre structuré qui sécurise les deux parties.</p>"],
    ['category' => 'Fonctionnement général', 'question' => 'Quels types de projets sont les plus adaptés à Junspro ?', 'answer' => "<p>Junspro est particulièrement adapté aux projets qui nécessitent :</p><ul><li>un suivi régulier (toutes les semaines),</li><li>une évolution dans le temps (améliorations, tests, itérations),</li><li>une collaboration continue plutôt qu’un one-shot.</li></ul><p>Exemples : développement web, maintenance, création de contenu récurrent, gestion de réseaux sociaux, design continu, accompagnement marketing, optimisation SEO, etc.</p><p>Pour des projets ultra ponctuels et très simples, une autre solution peut parfois être plus adaptée qu’un abonnement.</p>"],
    // Abonnements & heures
    ['category' => 'Abonnements & heures', 'question' => 'Quels sont les formats d’abonnement disponibles ?', 'answer' => "<p>Vous choisissez un nombre d’heures par semaine, parmi les formules suivantes :</p><ul><li>1h / semaine → 4 heures au total (1 × 4)</li><li>2h / semaine → 8 heures au total (2 × 4)</li><li>4h / semaine → 16 heures au total (4 × 4)</li><li>8h / semaine → 32 heures au total (8 × 4)</li><li>12h / semaine → 48 heures au total (12 × 4)</li><li>16h / semaine → 64 heures au total (16 × 4)</li><li>24h / semaine → 96 heures au total (24 × 4)</li></ul><p>Chaque abonnement couvre 4 semaines consécutives.</p>"],
    ['category' => 'Abonnements & heures', 'question' => 'Comment est calculé le prix de mon abonnement ?', 'answer' => "<p>Le prix total de votre abonnement sur 4 semaines est calculé ainsi :</p><p><strong>Prix = tarif horaire du freelance × heures par semaine × 4</strong></p><p>Exemple :</p><ul><li>Freelance à 40 €/h,</li><li>Abonnement 4h / semaine,</li><li>Sur 4 semaines : 40 × 4 × 4 = 640 €.</li></ul><p>Tout est affiché clairement avant validation.</p>"],
    ['category' => 'Abonnements & heures', 'question' => 'Comment fonctionne le calendrier de réservation ?', 'answer' => "<p>Vous réservez vos créneaux en heures pleines, de 00h à 23h.</p><p>Chaque créneau correspond à 1h = 50 min travail + 10 min rapport.</p><p>Vous pouvez répartir vos heures comme vous le souhaitez dans la semaine, en fonction des disponibilités du freelance.</p><p>Le planning est visible des deux côtés (client & freelance) pour garder une organisation claire.</p>"],
    ['category' => 'Abonnements & heures', 'question' => 'Puis-je commencer avec un petit volume d’heures pour tester ?', 'answer' => "<p>Oui. Vous pouvez démarrer avec une formule faible en heures (par exemple 1h ou 2h / semaine) pour tester la collaboration.</p><p>Si tout se passe bien, il est ensuite très simple d’augmenter le nombre d’heures ou de prolonger l’abonnement.</p><p>L’idée : avancer progressivement, sans engagement lourd dès le départ.</p>"],
    ['category' => 'Abonnements & heures', 'question' => 'Mon abonnement se renouvelle-t-il automatiquement à la fin des 4 semaines ?', 'answer' => "<p>Par défaut, un abonnement Junspro est prévu pour une période de 4 semaines.</p><p>Selon la configuration choisie, il peut :</p><ul><li>soit ne pas se renouveler automatiquement (vous décidez de reprendre ou non),</li><li>soit être renouvelé automatiquement pour une nouvelle période de 4 semaines avec le même freelance et le même nombre d’heures par semaine.</li></ul><p>Les conditions de renouvellement sont clairement indiquées avant le paiement, et vous pouvez ajuster votre abonnement dans votre espace client (volume d’heures, changement de freelance, non-renouvellement…).</p>"],
    // Reprogrammation & discipline
    ['category' => 'Reprogrammation & discipline', 'question' => 'Le freelance peut-il annuler une séance ?', 'answer' => "<p>Non. Sur Junspro, le freelance ne peut pas annuler, il peut uniquement reprogrammer dans un cadre très précis :</p><ul><li>prévenir au moins 24h à l’avance,</li><li>reprogrammer immédiatement un nouveau créneau,</li><li>dans la même semaine,</li><li>avec un décalage maximum de +72h,</li><li>et 1 seule reprogrammation par heure réservée.</li></ul><p>Ces règles existent pour protéger votre temps et la continuité de votre projet.</p>"],
    ['category' => 'Reprogrammation & discipline', 'question' => 'Que se passe-t-il si le freelance ne respecte pas ces règles ?', 'answer' => "<p>Si le freelance ne respecte pas les conditions de reprogrammation (préavis, délai, nombre de reprogrammations), vous avez la possibilité de :</p><ul><li>transférer toutes vos heures restantes vers un autre freelance,</li><li>sans perte de solde ni frais supplémentaires.</li></ul><p>En parallèle, le freelance peut subir des sanctions invisibles (baisse de visibilité, perte de badges, limitations…), sans que cela impacte vos droits en tant que client.</p>"],
    // Transferts & solde
    ['category' => 'Transferts & solde', 'question' => 'Puis-je transférer mon solde entre mes freelances actuels ?', 'answer' => "<p>Oui. Si vous travaillez déjà avec plusieurs freelances sur Junspro, vous pouvez déplacer votre solde d’heures restantes de l’un vers l’autre.</p><p>Exemple :</p><ul><li>Il vous reste 10h avec le Freelance A.</li><li>Vous souhaitez confier la suite du projet au Freelance B.</li><li>Vous pouvez transférer tout ou partie de ces 10h de A vers B.</li></ul><p>👉 Ce transfert ne crée pas de nouvelles heures : on déplace simplement un crédit déjà payé vers un autre freelance.</p>"],
    ['category' => 'Transferts & solde', 'question' => 'Que signifie “Transférer mon solde restant vers un nouveau freelance” ?', 'answer' => "<p>C’est le cas où vous ne voulez plus continuer avec votre freelance actuel et que vous souhaitez repartir sur une nouvelle collaboration.</p><p>Vous conservez votre solde d’heures non utilisées.</p><p>Vous choisissez un nouveau freelance sur Junspro.</p><p>Vous pouvez affecter ce solde d’heures à ce nouveau freelance.</p><p>Exemple :</p><ul><li>Il restait 6h sur votre abonnement avec le Freelance C.</li><li>Vous trouvez le Freelance D, plus adapté.</li><li>Vous transférez les 6h restantes vers D, qui les utilisera dans le cadre d’un nouvel abonnement.</li></ul><p>👉 Dans l’interface, cela peut apparaître comme : « Utiliser mon solde restant avec un nouveau freelance ».</p>"],
    ['category' => 'Transferts & solde', 'question' => 'Quelle est la différence avec “Transférer mon abonnement à un autre freelance” ?', 'answer' => "<p>Ici, vous ne transférez pas seulement le solde, mais toute la formule d’abonnement en cours.</p><p>Vous gardez exactement le même rythme (ex : 8h / semaine × 4 semaines).</p><p>Vous changez uniquement de freelance.</p><p>On transfère donc :</p><ul><li>les heures restantes,</li><li>la récurrence,</li><li>et les futurs créneaux à venir vers un nouveau freelance.</li></ul><p>C’est idéal si vous aimez la formule (ex : 4h/semaine) mais que vous préférez continuer avec quelqu’un d’autre (compétences, affinité, disponibilité).</p>"],
    // Livraisons & suivi
    ['category' => 'Livraisons & suivi', 'question' => 'Comment fonctionnent les livraisons hebdomadaires ?', 'answer' => "<p>Sur Junspro, chaque heure travaillée est rattachée à une livraison hebdomadaire :</p><ul><li>1h / semaine → 1 livraison</li><li>2h / semaine → 2 livraisons</li><li>8h / semaine → 8 livraisons, etc.</li></ul><p>Chaque livraison inclut :</p><ul><li>l’avancement,</li><li>les tâches réalisées,</li><li>les preuves ou livrables (captures, documents, liens),</li><li>la durée consommée.</li></ul><p>Vous pouvez ainsi suivre votre projet semaine après semaine, de façon claire et documentée.</p>"],
    ['category' => 'Livraisons & suivi', 'question' => 'Quelles preuves ou livrables puis-je attendre dans les rapports ?', 'answer' => "<p>Selon la nature du projet, le freelance doit fournir par exemple :</p><ul><li>captures d’écran,</li><li>documents partagés,</li><li>liens vers des versions de travail,</li><li>extraits de code, maquettes, designs,</li><li>notes de synthèse, plan d’action, etc.</li></ul><p>L’objectif est que vous ayez en permanence une vision concrète de ce qui a été fait avec vos heures.</p>"],
    // Facturation & cadre d'utilisation
    ['category' => 'Facturation & cadre d\'utilisation', 'question' => 'Comment sont calculés les prix sur Junspro ?', 'answer' => "<p>Sur Junspro, les prix sont calculés de manière simple et transparente pour le client comme pour le freelance.</p><h4 style='font-size: 16px; font-weight: 600; color: #111827; margin-top: 16px; margin-bottom: 8px;'>1. Le point de départ : le tarif du freelance</h4><p>Chaque freelance définit un tarif horaire de base en fonction de son expérience, de ses compétences et du type de projet.</p><h4 style='font-size: 16px; font-weight: 600; color: #111827; margin-top: 16px; margin-bottom: 8px;'>2. La formule d'abonnement en heures / semaine</h4><p>Le client choisit ensuite un format d'abonnement : 1h, 2h, 4h, 8h, 12h, 16h ou 24h par semaine, sur une période de 4 semaines.</p><p>👉 <strong>Prix de l'abonnement = tarif horaire du freelance × nombre d'heures par semaine × 4.</strong></p><h4 style='font-size: 16px; font-weight: 600; color: #111827; margin-top: 16px; margin-bottom: 8px;'>3. La commission Junspro côté freelance</h4><p>Pour faire fonctionner la plateforme (sécurité des paiements, support, outils, assistant, transferts d'abonnement, etc.), Junspro prend une commission dégressive sur les gains du freelance :</p><ul><li><strong>de 0 à 1 000 € : 20 %</strong></li><li><strong>de 1 001 à 5 000 € : 16 %</strong></li><li><strong>au-delà de 5 001 € : 12 %</strong></li></ul><p>Plus un freelance travaille avec ses clients sur Junspro, plus son taux de commission baisse.</p><h4 style='font-size: 16px; font-weight: 600; color: #111827; margin-top: 16px; margin-bottom: 8px;'>4. Les frais de service côté client (intégrés au prix affiché)</h4><p>Les prix que vous voyez sur le site incluent déjà une petite part de frais de service client. Ceux-ci couvrent notamment :</p><ul><li>la sécurisation des paiements et du solde,</li><li>la possibilité de transférer vos heures ou votre abonnement vers un autre freelance en cas de problème,</li><li>le suivi des livraisons (50 min de travail + 10 min de rapport),</li><li>l'assistant Junspro et le support en cas de litige.</li></ul><p>👉 <strong>Concrètement : vous voyez un prix final tout compris, sans surprise.</strong></p><h4 style='font-size: 16px; font-weight: 600; color: #111827; margin-top: 16px; margin-bottom: 8px;'>5. Notre engagement de transparence</h4><ul><li>Les freelances voient clairement combien ils gagnent sur chaque mission.</li><li>Les clients voient directement le prix final à payer, sans frais cachés.</li><li>Le détail des frais de Junspro est expliqué dans la FAQ et les CGU.</li></ul>"],
    ['category' => 'Facturation & cadre d’utilisation', 'question' => 'Vais-je recevoir une facture pour mes abonnements Junspro ?', 'answer' => "<p>Oui. À chaque paiement, vous recevez une facture détaillée comprenant :</p><ul><li>le freelance concerné,</li><li>la formule choisie (heures / semaine × 4 semaines),</li><li>les montants HT / TTC,</li><li>les éventuels services premium.</li></ul><p>Vous pouvez retrouver l’historique complet de vos factures dans votre espace client, pour votre comptabilité.</p>"],
    ['category' => 'Facturation & cadre d’utilisation', 'question' => 'Junspro est-il sécurisé pour les paiements ?', 'answer' => "<p>Oui. Les paiements sont gérés via un prestataire de paiement sécurisé (type Stripe ou équivalent), avec :</p><ul><li>chiffrement des données,</li><li>gestion conforme aux normes de sécurité en vigueur,</li><li>flux d’argent tracés entre clients, Junspro et freelances.</li></ul><p>Les freelances sont payés sur la base des heures validées, et les clients bénéficient des protections liées au système de livraisons et de transferts.</p>"],
    ['category' => 'Facturation & cadre d’utilisation', 'question' => 'Puis-je travailler avec le même freelance en direct, en dehors de Junspro ?', 'answer' => "<p>Les conditions d’utilisation de Junspro prévoient que la relation initiée via la plateforme doit rester dans le cadre de Junspro pendant une certaine période.</p><p>Cela permet de :</p><ul><li>protéger les deux parties (contrat, paiements sécurisés, transferts, médiation en cas de litige),</li><li>garantir le respect du business model (commissions, services premium, support),</li><li>maintenir un environnement de confiance pour tous les utilisateurs.</li></ul><p>Si vous souhaitez adapter ou faire évoluer la relation (volume d’heures très élevé, cadre spécifique), contactez-nous pour étudier une solution encadrée plutôt que de sortir de la plateforme.</p>"],
    // Services premium
    ['category' => 'Services premium', 'question' => 'Quels services premium sont disponibles pour les clients ?', 'answer' => "<p>Les clients peuvent activer des options pour gagner du temps ou sécuriser encore davantage leurs projets :</p><ul><li>MatchDirect™ – 9,99 € : Junspro vous propose des freelances triés sur mesure.</li><li>Conciergerie complète – 99 € : accompagnement personnalisé (brief, sélection, suivi).</li><li>Audit Express – 19,99 € : analyse rapide d’une situation ou d’un livrable.</li><li>Pack Confiance+ – 4,99 €/mois : avantages et garanties supplémentaires (priorités, support renforcé, etc., selon implémentation).</li></ul>"],
    ['category' => 'Services premium', 'question' => 'Quels services premium sont disponibles pour les freelances ?', 'answer' => "<p>Les freelances peuvent booster leur activité grâce à différentes options :</p><ul><li>Boost Visibilité – 9,99 € / 7 jours</li><li>Position Premium – 29,99 € / 30 jours</li><li>Vérification Avancée – 14,99 €</li><li>Coaching de Profil – 39,99 €</li><li>Plan Pro – 19,99 € / mois</li></ul><p>Ces services impactent la visibilité, la confiance inspirée aux clients et la qualité perçue du profil.</p>"],
    // Freelances & compte
    ['category' => 'Freelances & compte', 'question' => 'Que sont les “sanctions intelligentes” pour les freelances ?', 'answer' => "<p>Pour ne pas pénaliser les clients financièrement, Junspro applique des sanctions invisibles côté freelance en cas de manquements répétés (reprogrammations abusives, livraisons manquantes, etc.) :</p><ul><li>baisse de la visibilité dans les résultats,</li><li>perte de certains badges (ex. « vérifié », « premium »),</li><li>limitation du nombre d’heures vendables par semaine,</li><li>limitation du nombre de clients actifs,</li><li>exclusion de certains clients/projets premium.</li></ul><p>Ces sanctions sont gérées automatiquement par le système et/ou par l’équipe Junspro, sur la base de règles internes.</p>"],
    ['category' => 'Freelances & compte', 'question' => 'Comment un freelance peut-il réussir sur Junspro ?', 'answer' => "<p>Pour un freelance, la réussite sur Junspro repose sur :</p><ul><li>un profil complet et clair (compétences, portfolio, positionnement),</li><li>le respect strict des règles de calendrier et de reprogrammation,</li><li>des rapports hebdomadaires détaillés,</li><li>une communication transparente et réactive avec le client,</li><li>l’utilisation intelligente des services premium (boost, position, coaching).</li></ul><p>Plus le freelance respecte le cadre Junspro, plus il bénéficie de visibilité, de confiance et de projets récurrents.</p>"],
    ['category' => 'Freelances & compte', 'question' => 'Comment mettre à jour mon profil (photo, description, compétences, informations de facturation) ?', 'answer' => "<p>Vous pouvez modifier votre profil à tout moment depuis votre espace personnel Junspro :</p><ul><li>côté client : informations de facturation, coordonnées, préférences, méthodes de paiement ;</li><li>côté freelance : photo, description, compétences, portfolio, tarifs, langues, disponibilités.</li></ul><p>Nous vous recommandons de tenir votre profil à jour en permanence : c’est essentiel pour inspirer confiance et faciliter la mise en relation.</p>"],
    // Données, langues & conformité
    ['category' => 'Données, langues & conformité', 'question' => 'Comment Junspro protège-t-il mes données et celles de mon entreprise ?', 'answer' => "<p>Junspro applique des mesures techniques et organisationnelles pour protéger vos données : connexion sécurisée (HTTPS), mots de passe chiffrés, gestion stricte des accès, sauvegardes régulières.</p><p>Nous ne partageons pas vos informations avec des tiers non autorisés et nous limitons l’accès aux seules personnes qui en ont réellement besoin (support, facturation…).</p><p>Vous pouvez demander à consulter, modifier ou supprimer certaines données conformément à la réglementation en vigueur (RGPD).</p>"],
    ['category' => 'Données, langues & conformité', 'question' => 'Puis-je travailler avec des freelances dans d’autres pays ou fuseaux horaires ?', 'answer' => "<p>Oui. Junspro vous permet de collaborer avec des freelances situés dans différents pays.</p><p>Le calendrier et les créneaux tiennent compte des fuseaux horaires pour limiter les malentendus.</p><p>Nous vous recommandons simplement de clarifier dès le début les plages horaires de travail et de réunion.</p>"],
    ['category' => 'Données, langues & conformité', 'question' => 'Dans quelle langue puis-je travailler avec mon freelance ?', 'answer' => "<p>La langue principale de la plateforme est le français, mais certains freelances peuvent également travailler en anglais ou dans d’autres langues.</p><p>Chaque profil indique clairement :</p><ul><li>les langues parlées,</li><li>le niveau (courant, professionnel, bilingue).</li></ul><p>Vous pouvez filtrer les freelances selon la langue pour garantir une communication fluide.</p>"],
    // Support & litiges
    ['category' => 'Support & litiges', 'question' => 'Que se passe-t-il en cas de désaccord ou de litige avec un freelance ?', 'answer' => "<p>En cas de désaccord, nous vous encourageons d’abord à en discuter directement avec votre freelance via la messagerie Junspro.</p><p>Si le problème persiste, vous pouvez ouvrir un ticket auprès de notre équipe : nous analysons la situation (livraisons, échanges, respect des règles) et nous cherchons une solution équilibrée : ajustement du planning, transfert de solde, changement de freelance, etc.</p><p>Notre objectif : protéger la relation tout en restant justes avec les deux parties.</p>"],
    ['category' => 'Support & litiges', 'question' => 'Comment contacter l’équipe Junspro en cas de besoin ?', 'answer' => "<p>Vous pouvez nous contacter :</p><ul><li>via l’assistant Junspro (bulle en bas à droite du site),</li><li>via le formulaire de contact,</li><li>ou par e-mail à l’adresse indiquée dans la page « Support ».</li></ul><p>Nous faisons notre maximum pour vous répondre rapidement, dans le plus bref délai.</p>"],
  ];

  // Grouper par catégorie
  $grouped = [];
  foreach ($faqs as $faq) {
    $grouped[$faq['category']][] = $faq;
  }

  $icons = [
    'Fonctionnement général' => 'heroicons-question-mark-circle',
    'Abonnements & heures' => 'heroicons-clock',
    'Reprogrammation & discipline' => 'heroicons-arrow-path',
    'Transferts & solde' => 'heroicons-arrows-right-left',
    'Livraisons & suivi' => 'heroicons-document-check',
    'Facturation & cadre d’utilisation' => 'heroicons-credit-card',
    'Services premium' => 'heroicons-sparkles',
    'Freelances & compte' => 'heroicons-user-group',
    'Données, langues & conformité' => 'heroicons-shield-check',
    'Support & litiges' => 'heroicons-life-buoy',
  ];

  $iconMap = [
    'heroicons-question-mark-circle' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><path d="M12 17h.01M12 13.5a2.5 2.5 0 1 0-2.5-2.5"/><path d="M12 21a9 9 0 1 0-9-9 9 9 0 0 0 9 9Z"/></svg>',
    'heroicons-clock' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><circle cx="12" cy="12" r="9"/><path d="M12 7v5l3 3"/></svg>',
    'heroicons-arrow-path' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><path d="M4 7h9a3 3 0 0 1 3 3v2"/><path d="M20 17h-9a3 3 0 0 1-3-3v-2"/><path d="M8 11 4 7l4-4M16 13l4 4-4 4"/></svg>',
    'heroicons-arrows-right-left' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><path d="M17 7H7m0 0 3-3M7 7l3 3m-3 7h10m0 0-3-3m3 3-3 3"/></svg>',
    'heroicons-document-check' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><path d="M9 12l2 2 4-4"/><path d="M7 3h7l4 4v10a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2Z"/></svg>',
    'heroicons-credit-card' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><rect x="3" y="5" width="18" height="14" rx="2"/><path d="M3 9h18M7 13h4"/></svg>',
    'heroicons-sparkles' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><path d="M9 5l1 3 3 1-3 1-1 3-1-3-3-1 3-1zM17 11l.7 2.3L20 14l-2.3.7L17 17l-.7-2.3L14 14l2.3-.7z"/></svg>',
    'heroicons-user-group' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><path d="M10 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0ZM20 8a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/><path d="M4 16v-1a4 4 0 0 1 4-4h0a4 4 0 0 1 4 4v1m4 0v-1a4 4 0 0 0-3-3.87"/></svg>',
    'heroicons-shield-check' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><path d="M12 3l7 4v5c0 4-2.7 7.5-7 9-4.3-1.5-7-5-7-9V7l7-4Z"/><path d="M9 12l2 2 4-4"/></svg>',
    'heroicons-life-buoy' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><circle cx="12" cy="12" r="9"/><circle cx="12" cy="12" r="4"/><path d="M4.93 4.93l3.54 3.54M15.53 15.53l3.54 3.54M4.93 19.07l3.54-3.54M15.53 8.47l3.54-3.54"/></svg>',
  ];

  $slugify = function ($text) {
    return 'faq-' . Str::slug($text);
  };
?>

<style>
  /* ============================================
     FOND PREMIUM ULTRA-FLUIDE - FONCÉ MAIS LUMINEUX
     ============================================ */
  
  .faq-page {
    /* Fond principal : Lavande/bleu plus foncé avec dégradé fluide */
    /* Zone du header plus foncée, puis s'éclaircit progressivement */
    background: linear-gradient(
      180deg,
      #D8DBFF 0%,
      #D5D8FF 15%,
      #D2D5FF 30%,
      #CFD2FF 45%,
      #CCCEFF 60%,
      #C9CBFF 75%,
      #C6C8FF 90%,
      #C3C5FF 100%
    );
    
    color: #111827;
    padding-top: 120px;
    position: relative;
    overflow: hidden;
    min-height: 100vh;
    
    /* Rendu anti-aliasing premium */
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
    text-rendering: optimizeLegibility;
  }

  /* Zone du header encore plus foncée avec overlay */
  .faq-page::after {
    content: "";
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    height: 120px;
    /* Overlay foncé pour la zone du header - effet lumineux mais plus foncé */
    background: linear-gradient(
      180deg,
      rgba(124, 58, 237, 0.30) 0%,
      rgba(79, 70, 229, 0.20) 40%,
      rgba(124, 58, 237, 0.10) 80%,
      transparent 100%
    );
    pointer-events: none;
    z-index: 998;
    /* Le header doit être au-dessus (z-index: 999) */
  }

  /* Halo lumineux derrière le titre "FAQ Junspro" */
  .faq-hero {
    position: relative;
    overflow: visible;
    background: transparent;
    border: none;
    border-radius: 0;
    box-shadow: none;
    padding: 0;
    margin-bottom: 48px;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
  }

  .faq-hero::before {
    content: "";
    position: absolute;
    top: -50px;
    left: 50%;
    transform: translateX(-50%);
    width: 500px;
    height: 150px;
    /* Halo radial lumineux - effet glow doux et visible */
    background: radial-gradient(
      ellipse 100% 50% at 50% 50%,
      rgba(124, 58, 237, 0.15) 0%,
      rgba(124, 58, 237, 0.10) 25%,
      rgba(79, 70, 229, 0.06) 50%,
      rgba(124, 58, 237, 0.03) 75%,
      transparent 100%
    );
    pointer-events: none;
    z-index: 0;
    /* Flou doux pour effet lumineux */
    filter: blur(30px);
    -webkit-filter: blur(30px);
  }

/* Tous les éléments enfants au-dessus du fond */
.faq-page > * {
  position: relative;
  z-index: 1;
}

/* Le hero doit être au-dessus du halo */
.faq-hero > * {
  position: relative;
  z-index: 1;
}
.faq-container {
  max-width: 1200px;
  margin: 0 auto;
  padding: 0 24px 120px;
  /* Amélioration du rendu global */
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-rendering: optimizeLegibility;
}

/* Hero - Le halo est défini plus haut dans le CSS */
  .faq-hero h1 {
    color: #111827;
    font-size: 34px;
    line-height: 1.2;
    margin-bottom: 12px;
    font-weight: 700;
    /* Rendu texte ultra-lisse */
    text-rendering: optimizeLegibility;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
    letter-spacing: -0.01em;
  }
  .faq-hero p {
    color: #374151;
    font-size: 16px;
    line-height: 1.7;
    margin: 0;
    /* Rendu texte ultra-lisse */
    text-rendering: optimizeLegibility;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
  }


/* Pills catégories / segmented control - Rendu ultra-lisse */
.faq-pills-wrap {
  overflow-x: auto;
  padding-bottom: 10px;
  scrollbar-width: thin;
  margin-bottom: 32px;
  /* Amélioration du scroll pour éviter le pixelisé */
  -webkit-overflow-scrolling: touch;
}
.faq-pills-inner {
  display: inline-flex;
  flex-wrap: wrap;
  gap: 12px;
  min-width: 100%;
}
.faq-pill {
  padding: 10px 20px;
  border-radius: 999px;
  font-weight: 500;
  font-size: 14px;
  border: 1px solid rgba(148, 163, 184, 0.3);
  background: #ffffff;
  color: #0f172a;
  /* Ombre douce avec blur pour éviter le pixelisé */
  box-shadow: 0 4px 12px rgba(15, 23, 42, 0.06), 0 2px 4px rgba(15, 23, 42, 0.04);
  transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
  cursor: pointer;
  display: inline-flex;
  align-items: center;
  gap: 8px;
  white-space: nowrap;
  /* Amélioration du rendu */
  will-change: transform, box-shadow;
  transform: translateZ(0);
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
}
.faq-pill:hover, .faq-pill:focus-visible {
  background: linear-gradient(135deg, #f0f4ff 0%, #eef2ff 100%);
  border-color: rgba(79, 70, 229, 0.5);
  /* Ombre plus douce avec blur */
  box-shadow: 0 8px 24px rgba(79, 70, 229, 0.12), 0 4px 8px rgba(79, 70, 229, 0.08);
  transform: translateY(-2px) translateZ(0);
}
.faq-pill.active {
  /* Dégradé avec plus de points pour éviter les bandes */
  background: linear-gradient(135deg, #4f46e5 0%, #6366f1 30%, #7c3aed 70%, #8b5cf6 100%);
  color: #ffffff;
  border-color: transparent;
  /* Ombre douce avec blur pour un rendu premium */
  box-shadow: 0 12px 32px rgba(79, 70, 229, 0.35), 0 4px 12px rgba(124, 58, 237, 0.25);
  transform: translateZ(0);
}

/* Sections FAQ */
.faq-wrapper {
  max-width: 1100px;
  margin: 0 auto;
}
.faq-section {
  margin-bottom: 32px;
}
.faq-section.is-hidden {
  display: none;
}
.faq-section-title {
  font-size: 20px;
  font-weight: 700;
  color: #111827;
  margin-bottom: 24px;
  /* Rendu texte ultra-lisse */
  text-rendering: optimizeLegibility;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  letter-spacing: -0.01em;
}

  /* Cartes / accordéons - Rendu ultra-lisse */
/* Cartes FAQ premium */
.faq-card {
  background: #ffffff;
  border-radius: 16px;
  padding: 18px 24px;
  margin-bottom: 14px;
  border: 1px solid rgba(148, 163, 184, 0.15);
  /* Ombre douce avec blur pour éviter le pixelisé */
  box-shadow: 0 4px 16px rgba(15, 23, 42, 0.05), 0 2px 6px rgba(15, 23, 42, 0.03);
  display: flex;
  flex-direction: column;
  transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
  /* Amélioration du rendu */
  will-change: transform, box-shadow;
  transform: translateZ(0);
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  /* Backdrop blur subtil pour adoucir */
  backdrop-filter: blur(0.5px);
  -webkit-backdrop-filter: blur(0.5px);
}
.faq-card:hover {
  background: linear-gradient(135deg, #ffffff 0%, #f9fbff 100%);
  border-color: rgba(79, 70, 229, 0.4);
  /* Ombre plus douce avec blur */
  box-shadow: 0 12px 36px rgba(79, 70, 229, 0.15), 0 4px 12px rgba(79, 70, 229, 0.1);
  transform: translateY(-2px) translateZ(0);
}
.faq-card.is-open {
  border-left: 3px solid #6366f1;
  background: linear-gradient(135deg, #ffffff 0%, #f8faff 100%);
}
.faq-header {
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 16px;
  cursor: pointer;
  width: 100%;
  background: transparent;
  border: none;
  padding: 0;
  text-align: left;
  list-style: none;
  outline: none;
}
.faq-header::-webkit-details-marker { display: none; }
.faq-icon {
  width: 40px;
  height: 40px;
  border-radius: 12px;
  /* Dégradé doux pour éviter le pixelisé */
  background: linear-gradient(135deg, rgba(37, 99, 235, 0.14) 0%, rgba(79, 70, 229, 0.12) 100%);
  color: #2563eb;
  display: inline-flex;
  align-items: center;
  justify-content: center;
  flex-shrink: 0;
  /* Amélioration du rendu */
  transform: translateZ(0);
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
}
.faq-question {
  flex: 1;
  font-weight: 600;
  font-size: 16px;
  color: #0f172a;
  line-height: 1.5;
  /* Rendu texte ultra-lisse */
  text-rendering: optimizeLegibility;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
}
.faq-chevron {
  transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1), color 0.25s ease;
  width: 18px;
  height: 18px;
  color: #94a3b8;
  flex-shrink: 0;
  /* Amélioration du rendu */
  transform: translateZ(0);
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
}
.faq-card.is-open .faq-chevron {
  transform: rotate(180deg) translateZ(0);
  color: #6366f1;
}
.faq-body {
  margin-top: 10px;
  padding-top: 10px;
  border-top: 1px solid rgba(226, 232, 240, 0.9);
  color: #4b5563;
  font-size: 14px;
  line-height: 1.7;
  /* Rendu texte ultra-lisse */
  text-rendering: optimizeLegibility;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
}
  .faq-body p {
    margin-bottom: 12px;
    /* Rendu texte ultra-lisse */
    text-rendering: optimizeLegibility;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
  }
  .faq-body ul {
    padding-left: 18px;
    margin: 0 0 12px;
  }

  /* Amélioration du rendu SVG et éléments graphiques */
  .faq-icon svg,
  .faq-chevron {
    /* Rendu SVG ultra-lisse */
    shape-rendering: geometricPrecision;
    text-rendering: geometricPrecision;
    image-rendering: -webkit-optimize-contrast;
    image-rendering: crisp-edges;
  }

  /* Amélioration globale du rendu */
  * {
    /* Forcer l'anti-aliasing sur tous les éléments */
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
  }

  /* Responsive */
  @media (max-width: 992px) {
    .faq-hero {
      padding: 24px;
      margin-bottom: 32px;
    }
    .faq-support {
      flex-direction: column;
      align-items: flex-start;
    }
    .faq-support .btn-support {
      width: 100%;
      text-align: center;
    }
    .faq-container {
      padding: 0 20px 120px;
    }
  }
  @media (max-width: 768px) {
    .faq-hero h1 { font-size: 28px; }
    .faq-hero p { font-size: 15px; }
    .faq-pills-inner { gap: 8px; }
    .faq-pill { font-size: 13px; padding: 9px 14px; }
    .faq-question { font-size: 15.5px; }
  }
</style>

<div class="faq-page">
  <div class="faq-container">
    <!-- Hero -->
    <section class="faq-hero">
      <div class="row g-4">
        <div class="col-lg-8">
          <div class="d-flex flex-column">
            <h1 class="fw-bold mb-2" style="color:#111827;">FAQ Junspro</h1>
            <p class="mb-0">
              Toutes les réponses pour comprendre les abonnements, les transferts, la facturation et le fonctionnement de Junspro.
            </p>
                        </div>
                      </div>
                    </div>
    </section>


    <!-- Pills -->
    <section class="py-4">
      <div class="faq-pills-wrap">
        <div class="faq-pills-inner">
          <?php $__currentLoopData = array_keys($grouped); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <button class="faq-pill" data-target="#<?php echo e($slugify($cat)); ?>">
              <?php echo e($cat); ?>

            </button>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </div>
                </div>
    </section>

    <!-- FAQ Sections -->
    <section class="pb-4">
      <div class="faq-wrapper">
        <?php $__currentLoopData = $grouped; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category => $items): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <div id="<?php echo e($slugify($category)); ?>" class="faq-section">
            <h3 class="faq-section-title"><?php echo e($category); ?></h3>
            <div class="d-flex flex-column gap-3">
              <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $idx => $faq): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php
                  $id = $slugify($category) . '-q' . $idx;
                  $iconKey = $icons[$category] ?? 'heroicons-question-mark-circle';
                  $iconSvg = $iconMap[$iconKey];
                ?>
                <details class="faq-card" id="<?php echo e($id); ?>">
                  <summary class="faq-header">
                    <span class="faq-icon"><?php echo $iconSvg; ?></span>
                    <span class="faq-question"><?php echo e($faq['question']); ?></span>
                    <svg class="faq-chevron" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                      <path d="M6 9l6 6 6-6"/>
                    </svg>
                  </summary>
                  <div id="<?php echo e($id); ?>-body" class="faq-body">
                    <?php echo $faq['answer']; ?>

              </div>
                </details>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </div>
    </section>
      </div>
    </div>

<?php $__env->startPush('scripts'); ?>
<script>
  // Script minimal sans dépendance : accordéons & pills
  document.addEventListener('DOMContentLoaded', function() {
    const pills = document.querySelectorAll('.faq-pill');
    const sections = Array.from(document.querySelectorAll('.faq-section'));

    pills.forEach(pill => {
      pill.addEventListener('click', () => {
        const target = pill.getAttribute('data-target');
        document.querySelectorAll('.faq-pill').forEach(p => p.classList.remove('active'));
        pill.classList.add('active');
        // filtrage sections
        sections.forEach(sec => sec.classList.add('is-hidden'));
        const activeSec = sections.find(sec => ('#' + sec.id) === target);
        if (activeSec) activeSec.classList.remove('is-hidden');
        // scroll vers le haut du bloc
        const hero = document.querySelector('.faq-hero');
        if (hero) hero.scrollIntoView({ behavior: 'smooth', block: 'start' });
      });
    });
    // état initial : première catégorie active
    if (pills.length) {
      pills[0].classList.add('active');
      if (sections.length) {
        sections.forEach((sec, idx) => {
          if (idx === 0) {
            sec.classList.remove('is-hidden');
          } else {
            sec.classList.add('is-hidden');
          }
        });
      }
    }

    // Accordéons <details> : rotation du chevron + classe is-open
    document.addEventListener('toggle', function(e) {
      const details = e.target;
      if (!details.matches('.faq-card')) return;
      const chevron = details.querySelector('.faq-chevron');
      details.classList.toggle('is-open', details.open);
      if (chevron) {
        chevron.style.transform = details.open ? 'rotate(180deg)' : 'rotate(0deg)';
      }
    }, true);

  });
</script>
<?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\younes\Downloads\junspro-main (1)\junspro-main3\resources\views\frontend\faq.blade.php ENDPATH**/ ?>