<?php

require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\FreelancerProfile;
use Illuminate\Support\Facades\DB;

try {
    // Trouver le freelance avec l'ID 11
    $freelancer = FreelancerProfile::find(11);
    
    if (!$freelancer) {
        echo "Freelance avec l'ID 11 non trouvé.\n";
        exit(1);
    }
    
    // Texte long pour tester "Voir plus" - Environ 1000 mots
    $longBio = "Consultante en stratégie digitale et transformation numérique. 12 ans d'expérience dans l'accompagnement des entreprises vers le digital. Expertise en e-commerce, marketing automation et analyse de données.

Au fil de ma carrière, j'ai accompagné plus de 200 entreprises dans leur transformation digitale, de la PME locale aux grandes entreprises internationales. Ma spécialité réside dans la création de stratégies sur mesure qui allient innovation technologique et vision business.

Mon approche se base sur une analyse approfondie des besoins clients, une compréhension fine des enjeux métier et une expertise technique solide. Je travaille en étroite collaboration avec les équipes pour garantir une mise en œuvre efficace et durable.

Mes domaines d'expertise incluent :
- Développement de plateformes e-commerce performantes
- Mise en place de systèmes de marketing automation
- Analyse de données et création de tableaux de bord
- Optimisation des processus métier
- Formation des équipes aux outils digitaux

Je suis également formatrice certifiée et j'anime régulièrement des sessions de formation pour aider les entreprises à maîtriser les outils digitaux essentiels à leur développement.

Ma philosophie de travail repose sur la transparence, la communication et l'engagement. Je m'engage à fournir des solutions qui apportent une réelle valeur ajoutée à mes clients, tout en respectant leurs contraintes budgétaires et temporelles.

Dans le domaine de l'e-commerce, j'ai développé une expertise approfondie dans la création et l'optimisation de plateformes de vente en ligne. J'ai accompagné de nombreuses entreprises dans la mise en place de leurs boutiques en ligne, depuis la conception initiale jusqu'à l'optimisation continue des performances. Mon approche intègre toujours les meilleures pratiques en termes d'expérience utilisateur, de conversion et de référencement naturel.

Le marketing automation représente un autre pilier de mon expertise. J'ai mis en place des systèmes complexes d'automatisation marketing pour des entreprises de toutes tailles, permettant d'optimiser les parcours clients et d'augmenter significativement les taux de conversion. Ces systèmes permettent de personnaliser les communications, de suivre les comportements des clients et d'adapter les stratégies en temps réel.

L'analyse de données est au cœur de toutes mes interventions. Je crois fermement que les décisions doivent être basées sur des données concrètes et analysées de manière rigoureuse. J'ai développé des compétences avancées dans l'utilisation d'outils d'analyse comme Google Analytics, Adobe Analytics, et diverses plateformes de business intelligence. La création de tableaux de bord personnalisés permet aux équipes de suivre les KPIs essentiels et de prendre des décisions éclairées rapidement.

L'optimisation des processus métier est un aspect crucial de la transformation digitale. J'ai accompagné de nombreuses entreprises dans la digitalisation de leurs processus internes, permettant d'améliorer l'efficacité opérationnelle, de réduire les coûts et d'améliorer la satisfaction des clients. Cette approche nécessite une compréhension approfondie des enjeux métier et une capacité à identifier les opportunités d'amélioration.

La formation des équipes est également un élément essentiel de mon travail. Je crois que la réussite d'un projet de transformation digitale dépend en grande partie de l'adoption des outils et des nouvelles méthodes de travail par les équipes. J'ai développé des programmes de formation adaptés aux différents niveaux de compétences et aux besoins spécifiques de chaque entreprise.

Au cours de mes 12 années d'expérience, j'ai eu l'opportunité de travailler avec des entreprises de secteurs très variés : retail, services financiers, industrie, santé, éducation, et bien d'autres. Cette diversité m'a permis de développer une compréhension large des enjeux sectoriels et d'adapter mes approches en fonction des spécificités de chaque industrie.

Mon expertise en transformation numérique s'étend également à la gestion du changement. Je comprends que la transformation digitale n'est pas seulement une question de technologie, mais aussi et surtout une question de changement organisationnel et culturel. J'accompagne les entreprises dans cette transition en veillant à ce que les équipes soient préparées et motivées pour adopter les nouveaux outils et processus.

La stratégie digitale que je développe pour mes clients prend toujours en compte les objectifs business à long terme. Je ne me contente pas de proposer des solutions techniques, mais je m'assure que chaque initiative s'inscrit dans une vision stratégique globale qui permettra à l'entreprise d'atteindre ses objectifs de croissance et de développement.

L'innovation est un élément central de mon approche. Je reste constamment à l'affût des nouvelles technologies et des tendances émergentes dans le domaine du digital. Cette veille me permet de proposer à mes clients des solutions innovantes qui leur donnent un avantage concurrentiel.

La mesure de la performance est également cruciale dans tous mes projets. J'établis systématiquement des indicateurs de performance clés (KPI) qui permettent de suivre l'efficacité des initiatives mises en place et d'ajuster les stratégies en fonction des résultats obtenus.

La relation client est au cœur de ma démarche. Je m'engage à maintenir une communication transparente et régulière avec mes clients tout au long des projets. Je crois que la réussite d'un projet dépend en grande partie de la qualité de la collaboration entre le consultant et le client.

Mon expertise technique couvre un large éventail de technologies et d'outils : plateformes e-commerce (Shopify, WooCommerce, Magento, PrestaShop), systèmes de CRM (Salesforce, HubSpot), outils de marketing automation (Marketo, Pardot, Mailchimp), outils d'analyse (Google Analytics, Adobe Analytics, Tableau), et bien d'autres.

Je suis également certifiée dans plusieurs domaines clés : Google Analytics, Google Ads, HubSpot Inbound Marketing, et Salesforce. Ces certifications témoignent de mon engagement continu à développer mes compétences et à rester à jour avec les meilleures pratiques de l'industrie.

La gestion de projet est un autre aspect important de mon travail. J'ai développé des compétences solides en gestion de projet agile, ce qui me permet de gérer efficacement des projets complexes avec des équipes multidisciplinaires. Je suis également expérimentée dans la gestion de budgets et de délais, garantissant que les projets sont livrés dans les temps et dans les limites budgétaires convenues.

L'international est également un aspect de mon expérience. J'ai travaillé avec des entreprises ayant des opérations dans plusieurs pays, ce qui m'a permis de développer une compréhension des enjeux de localisation et d'internationalisation des stratégies digitales.

La sécurité et la conformité sont des préoccupations constantes dans tous mes projets. Je m'assure que les solutions mises en place respectent les réglementations en vigueur, notamment le RGPD en Europe, et que les données des clients sont protégées de manière adéquate.

L'accessibilité numérique est également un élément important de mon travail. Je m'assure que les solutions que je développe sont accessibles à tous les utilisateurs, conformément aux standards d'accessibilité web (WCAG).

La performance technique est un autre aspect crucial. Je m'assure que les solutions mises en place sont optimisées pour offrir une expérience utilisateur rapide et fluide, ce qui a un impact direct sur le taux de conversion et la satisfaction des utilisateurs.

En résumé, mon approche combine expertise technique, compréhension des enjeux business, et capacité à accompagner le changement organisationnel. Je m'engage à fournir des solutions qui apportent une réelle valeur ajoutée à mes clients et qui contribuent à leur succès à long terme.

N'hésitez pas à me contacter pour discuter de votre projet et voir comment je peux vous accompagner dans votre transformation digitale. Je serais ravie d'échanger avec vous sur vos besoins spécifiques et de vous proposer une approche adaptée à votre situation.";
    
    // Mettre à jour la bio
    $freelancer->bio = $longBio;
    $freelancer->save();
    
    echo "Bio mise à jour avec succès pour le freelance ID 11.\n";
    echo "Longueur du texte : " . strlen($longBio) . " caractères.\n";
    echo "Vous pouvez maintenant vérifier sur http://localhost:8000/freelance/11\n";
    
} catch (\Exception $e) {
    echo "Erreur : " . $e->getMessage() . "\n";
    exit(1);
}

