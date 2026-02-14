@extends('frontend.layout')
@section('style')
@include('frontend.partials.legal-document-styles')
@endsection

@section('pageHeading')
    {{ __('Conditions Générales de Vente') }}
@endsection

@section('metaKeywords')
    CGV, conditions générales de vente, JUNSPRO, abonnement, Stripe, cycles 4 semaines
@endsection

@section('metaDescription')
    Conditions Générales de Vente JUNSPRO — Abonnements par cycles de 4 semaines, paiement Stripe, plateforme internationale.
@endsection

@section('content')
@php
  $toc = [
    ['label' => '1) Identité du vendeur', 'href' => '#identite'],
    ['label' => '2) Définitions', 'href' => '#definitions'],
    ['label' => '3) Objet et périmètre', 'href' => '#objet'],
    ['label' => '5) Prix', 'href' => '#prix'],
    ['label' => '6) Paiement sécurisé (Stripe)', 'href' => '#paiement'],
    ['label' => '7) Abonnements — cycles de 4 semaines', 'href' => '#abonnements'],
    ['label' => '9) Exécution du service', 'href' => '#execution'],
    ['label' => '10) Droit de rétractation', 'href' => '#retractation'],
    ['label' => '11) Remboursements', 'href' => '#remboursements'],
    ['label' => '7.3 Résiliation', 'href' => '#resiliation'],
    ['label' => '13) Responsabilité', 'href' => '#responsabilite'],
    ['label' => '15) Données personnelles', 'href' => '#donnees-personnelles'],
    ['label' => '18) Contact', 'href' => '#contact'],
  ];
@endphp
<x-legal-document-layout title="Conditions Générales de Vente (CGV)" updatedAt="13/02/2026" :toc="$toc" prefix="cgv">
  <p>Les présentes Conditions Générales de Vente (les « CGV ») encadrent la vente des services fournis par JUNSPRO (ci-après « JUNSPRO », « nous »), notamment l'accès à la Plateforme, les abonnements, et les options payantes. Elles s'appliquent à tout achat réalisé en ligne via la Plateforme.</p>

  <p><strong>Important (Marketplace)</strong> : les CGV ci-dessous visent les services vendus par JUNSPRO. Les prestations réalisées par des freelances (lorsque disponibles sur la Plateforme) peuvent faire l'objet de conditions complémentaires entre les utilisateurs. JUNSPRO n'est pas partie au contrat de prestation entre un Client et un Freelance, sauf mention expresse.</p>

  <h2 id="identite">1) Identité du vendeur</h2>
  <p><strong>JUNSPRO</strong><br>
  Éditeur : Jésula SIMON, Entrepreneur Individuel (micro-entreprise)<br>
  Siège social : 6 rue de Montbrillant, 69003 Lyon, France<br>
  Email : <a href="mailto:contact@junspro.com">contact@junspro.com</a></p>
  <p>SIRET : en cours d'attribution<br>
  TVA : TVA non applicable — art. 293 B du CGI (franchise en base).</p>

  <hr class="terms-section-sep">

  <h2 id="definitions">2) Définitions</h2>
  <ul>
    <li><strong>Utilisateur</strong> : toute personne utilisant la Plateforme.</li>
    <li><strong>Client</strong> : utilisateur (particulier ou organisation) achetant un service JUNSPRO et/ou recherchant un freelance.</li>
    <li><strong>Freelance</strong> : prestataire indépendant référencé sur la Plateforme.</li>
    <li><strong>Abonnement</strong> : accès payant organisé en cycles de 4 semaines.</li>
    <li><strong>Cycle</strong> : période de 4 semaines consécutives à compter de l'activation.</li>
    <li><strong>Options</strong> : services ponctuels ou fonctionnalités payantes (le cas échéant).</li>
    <li><strong>Rituel</strong> : cadre méthodologique JUNSPRO (ex. 50 min Focus + 10 min Feedback + plan d'action) lorsque proposé.</li>
  </ul>

  <hr class="terms-section-sep">

  <h2 id="objet">3) Objet et périmètre des CGV</h2>
  <p>Les CGV encadrent l'achat :</p>
  <ul>
    <li>d'abonnements (cycles de 4 semaines),</li>
    <li>d'options payantes,</li>
    <li>et, plus généralement, de toute fonctionnalité vendue directement par JUNSPRO.</li>
  </ul>
  <p>Les caractéristiques essentielles (contenu, tarifs, inclusions, limitations) sont décrites sur la page de l'offre au moment de l'achat. En cas de contradiction, la description affichée au moment de la commande prévaut.</p>

  <h2 id="commande">4) Commande et acceptation</h2>
  <p>La commande est réalisée en ligne. Avant validation, l'Utilisateur a accès au récapitulatif (prix, périodicité, inclusions). La confirmation de commande vaut acceptation des CGV.</p>
  <p>JUNSPRO se réserve le droit de refuser une commande en cas de fraude suspectée, d'incident de paiement, ou d'usage manifestement abusif.</p>

  <hr class="terms-section-sep">

  <h2 id="prix">5) Prix</h2>
  <p>Les prix sont affichés en euros (EUR), sauf indication contraire. Des offres promotionnelles peuvent être proposées (codes, campagnes). Elles sont applicables uniquement pendant leur période de validité et selon leurs conditions.</p>
  <p>TVA : JUNSPRO peut facturer en franchise en base de TVA lorsque applicable (TVA non applicable — art. 293 B du CGI).</p>

  <hr class="terms-section-sep">

  <h2 id="paiement">6) Paiement sécurisé (Stripe)</h2>
  <p>Les paiements sont traités via un prestataire de paiement sécurisé tel que Stripe. JUNSPRO ne stocke pas les données de carte bancaire. Le prestataire gère la transaction selon ses standards de sécurité.</p>
  <p>En cas d'échec de paiement :</p>
  <ul>
    <li>l'accès peut être suspendu jusqu'à régularisation,</li>
    <li>et/ou la commande peut être annulée.</li>
  </ul>

  <hr class="terms-section-sep">

  <h2 id="abonnements">7) Abonnements — cycles de 4 semaines</h2>

  <h3>7.1 Activation</h3>
  <p>Sauf mention contraire, l'Abonnement est activé à la date de validation du paiement (ou à la date d'activation indiquée lors de l'achat).</p>

  <h3>7.2 Durée et renouvellement</h3>
  <p>Chaque Abonnement fonctionne par cycles de 4 semaines. Sauf résiliation avant l'échéance du cycle, l'Abonnement peut être renouvelé automatiquement pour un nouveau cycle (selon l'option choisie lors de la souscription).</p>

  <h3 id="resiliation">7.3 Résiliation</h3>
  <p>L'Utilisateur peut résilier à tout moment. La résiliation prend effet à la fin du cycle en cours, sauf mention contraire sur l'offre. Par défaut, aucun remboursement prorata temporis n'est dû pour un cycle déjà commencé (voir section 10).</p>

  <h3>7.4 Suspension / interruption</h3>
  <p>JUNSPRO peut suspendre l'accès en cas :</p>
  <ul>
    <li>d'incident de paiement,</li>
    <li>d'usage non conforme,</li>
    <li>de risque de sécurité.</li>
  </ul>

  <h3>7.5 Évolution des tarifs</h3>
  <p>JUNSPRO peut faire évoluer ses tarifs. Les nouveaux tarifs s'appliquent aux cycles futurs, avec information préalable raisonnable sur la Plateforme (ou par email lorsque disponible).</p>

  <hr class="terms-section-sep">

  <h2 id="options">8) Options et services ponctuels</h2>
  <p>Certaines options peuvent être vendues à l'unité (ex. fonctionnalités premium, mises en avant, accès à un module). Les conditions spécifiques (durée, prix, contenu, limitations) sont indiquées au moment de l'achat.</p>

  <hr class="terms-section-sep">

  <h2 id="execution">9) Exécution du service — accès numérique</h2>
  <p>Les services JUNSPRO sont principalement numériques (accès Plateforme, fonctionnalités, contenus, outils). L'accès est fourni dès l'activation, sauf indication contraire.</p>
  <p>JUNSPRO met en œuvre des moyens raisonnables pour assurer la disponibilité, sans garantir une disponibilité continue.</p>

  <hr class="terms-section-sep">

  <h2 id="retractation">10) Droit de rétractation (consommateurs)</h2>
  <p>Si vous êtes un consommateur au sens du droit applicable, vous pouvez disposer d'un délai de rétractation de 14 jours pour certains achats à distance, à compter de la conclusion du contrat.</p>

  <h3>Exceptions / exécution immédiate</h3>
  <p>Conformément au droit applicable, le droit de rétractation peut ne pas s'appliquer à certains services numériques, notamment lorsque :</p>
  <ul>
    <li>le service est pleinement exécuté avant la fin du délai, avec accord exprès du consommateur,</li>
    <li>et reconnaissance de la perte du droit de rétractation dans les cas prévus.</li>
  </ul>
  <p>Lorsque la Plateforme propose une activation immédiate (accès numérique instantané), l'Utilisateur pourra être amené à confirmer explicitement cette exécution immédiate et, le cas échéant, la renonciation au droit de rétractation selon les conditions légales applicables.</p>

  <hr class="terms-section-sep">

  <h2 id="remboursements">11) Remboursements</h2>
  <p>Sauf obligation légale contraire :</p>
  <ul>
    <li>les cycles d'abonnement entamés ne sont pas remboursés,</li>
    <li>les options consommées/activées ne sont pas remboursées.</li>
  </ul>
  <p>Un remboursement (ou un geste commercial) peut être envisagé en cas de dysfonctionnement majeur imputable à JUNSPRO et dûment constaté, au cas par cas.</p>

  <h2 id="obligations">12) Obligations de l'Utilisateur</h2>
  <p>L'Utilisateur s'engage à :</p>
  <ul>
    <li>fournir des informations exactes,</li>
    <li>respecter les règles de la Plateforme,</li>
    <li>ne pas détourner ou perturber les services,</li>
    <li>utiliser la Plateforme conformément au droit applicable.</li>
  </ul>

  <hr class="terms-section-sep">

  <h2 id="responsabilite">13) Responsabilité</h2>
  <p>Dans les limites autorisées par la loi, JUNSPRO ne pourra être tenue responsable :</p>
  <ul>
    <li>des dommages indirects (perte de chance, perte de revenus, etc.),</li>
    <li>des litiges entre utilisateurs,</li>
    <li>des conséquences liées aux décisions prises par les utilisateurs.</li>
  </ul>
  <p>Aucune clause ne limite une responsabilité qui ne pourrait être légalement exclue.</p>

  <h2 id="force-majeure">14) Force majeure</h2>
  <p>JUNSPRO ne saurait être responsable en cas d'inexécution due à un événement de force majeure (panne majeure, événement extérieur imprévisible, etc.).</p>

  <h2 id="donnees-personnelles">15) Données personnelles</h2>
  <p>Les traitements de données personnelles sont décrits dans la <a href="{{ url('/privacy-policy') }}">Politique de confidentialité</a> accessible depuis le site.</p>

  <h2 id="mediation">16) Réclamations — Médiation (consommateurs)</h2>
  <p>En cas de réclamation, contactez : <a href="mailto:contact@junspro.com">contact@junspro.com</a>.</p>
  <p>Si vous êtes consommateur, vous pouvez recourir gratuitement à un dispositif de médiation de la consommation dans les conditions prévues par la loi. Médiateur : [à compléter — nom / site / adresse] (à renseigner dès désignation).</p>

  <h2 id="droit-applicable">17) Droit applicable — litiges</h2>
  <p>Les CGV sont régies par le droit du pays d'établissement de l'opérateur (France), sans préjudice des dispositions impératives protectrices applicables dans le pays de résidence du consommateur le cas échéant.</p>
  <p>En cas de litige, une résolution amiable sera privilégiée avant toute action.</p>

  <h2 id="contact">18) Contact</h2>
  <p>Support / demandes : <a href="mailto:contact@junspro.com">contact@junspro.com</a></p>
</x-legal-document-layout>
@endsection
