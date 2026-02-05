<?php

require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\FreelancerProfile;

try {
    // Trouver le freelance avec l'ID 11
    $freelancer = FreelancerProfile::find(11);
    
    if (!$freelancer) {
        echo "Freelance avec l'ID 11 non trouvé.\n";
        exit(1);
    }
    
    // Texte d'environ 300 mots pour tester "Voir plus"
    $longBio = "Consultante en stratégie digitale et transformation numérique. 12 ans d'expérience dans l'accompagnement des entreprises vers le digital. Expertise en e-commerce, marketing automation et analyse de données.

Au fil de ma carrière, j'ai accompagné plus de 200 entreprises dans leur transformation digitale, de la PME locale aux grandes entreprises internationales. Ma spécialité réside dans la création de stratégies sur mesure qui allient innovation technologique et vision business.

Mon approche se base sur une analyse approfondie des besoins clients, une compréhension fine des enjeux métier et une expertise technique solide. Je travaille en étroite collaboration avec les équipes pour garantir une mise en œuvre efficace et durable.

Mes domaines d'expertise incluent le développement de plateformes e-commerce performantes, la mise en place de systèmes de marketing automation, l'analyse de données et la création de tableaux de bord, l'optimisation des processus métier, ainsi que la formation des équipes aux outils digitaux.

Je suis également formatrice certifiée et j'anime régulièrement des sessions de formation pour aider les entreprises à maîtriser les outils digitaux essentiels à leur développement. Ces formations couvrent des sujets variés comme la gestion de projet agile, l'utilisation des CRM, l'analyse de données avec des outils modernes, et la création de campagnes marketing efficaces.

Ma philosophie de travail repose sur la transparence, la communication et l'engagement. Je m'engage à fournir des solutions qui apportent une réelle valeur ajoutée à mes clients, tout en respectant leurs contraintes budgétaires et temporelles.

Dans le domaine de l'e-commerce, j'ai accompagné de nombreuses entreprises dans la création et l'optimisation de leurs boutiques en ligne. Cela inclut la sélection des plateformes adaptées, la configuration des systèmes de paiement, l'optimisation de l'expérience utilisateur, et la mise en place de stratégies de conversion.

Pour le marketing automation, j'ai développé des compétences approfondies dans l'utilisation d'outils comme HubSpot, Marketo, Pardot, et Mailchimp. J'aide les entreprises à créer des parcours clients personnalisés, à automatiser leurs campagnes email, et à mesurer l'efficacité de leurs actions marketing.

L'analyse de données est un autre pilier de mon expertise. Je maîtrise l'utilisation d'outils comme Google Analytics, Adobe Analytics, Tableau, et Power BI. Je crée des tableaux de bord personnalisés qui permettent aux entreprises de suivre leurs KPIs en temps réel et de prendre des décisions éclairées.

N'hésitez pas à me contacter pour discuter de votre projet et voir comment je peux vous accompagner dans votre transformation digitale. Je serai ravie d'échanger avec vous sur vos besoins spécifiques et de vous proposer une solution adaptée à votre contexte.";
    
    // Mettre à jour la bio
    $freelancer->bio = $longBio;
    $freelancer->save();
    
    $wordCount = str_word_count($longBio);
    $charCount = strlen($longBio);
    
    echo "Bio mise à jour avec succès pour le freelance ID 11.\n";
    echo "Nombre de mots : " . $wordCount . " mots.\n";
    echo "Longueur du texte : " . $charCount . " caractères.\n";
    echo "Vous pouvez maintenant vérifier sur http://localhost:8000/freelance/11\n";
    echo "Le lien 'Voir plus' devrait maintenant s'afficher automatiquement.\n";
    
} catch (\Exception $e) {
    echo "Erreur : " . $e->getMessage() . "\n";
    exit(1);
}
