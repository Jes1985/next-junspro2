<?php

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\FreelancerProfile;

// Texte très long pour tester "Voir plus" (plus de 200 mots)
$longBio = "Bonjour, je suis Eman. Championne nationale de débat et présidente de la société littéraire anglaise, avec plus de 800 heures de lecture et plus de 1000 heures d'enseignement, je vous aiderai à embellir vos compétences en expression orale, compréhension et lecture, que ce soit pour les SAT ou pour des conversations quotidiennes.

Mon parcours académique et professionnel m'a permis de développer une expertise approfondie dans l'enseignement de l'anglais. J'ai commencé mon voyage éducatif il y a plus de dix ans, et depuis, j'ai eu le privilège d'aider des centaines d'étudiants à atteindre leurs objectifs linguistiques.

En tant que championne nationale de débat, j'ai appris l'importance de la communication claire et persuasive. Ces compétences me permettent de créer un environnement d'apprentissage dynamique où chaque étudiant peut s'exprimer librement et développer sa confiance en soi.

Ma présidence de la société littéraire anglaise m'a donné une compréhension profonde de la littérature anglaise, de la poésie classique aux œuvres contemporaines. Cette connaissance enrichit mes cours et permet à mes étudiants de découvrir la beauté et la richesse de la langue anglaise à travers ses plus grands auteurs.

Avec plus de 800 heures de lecture intensive, j'ai exploré un large éventail de genres littéraires, de la fiction historique aux essais philosophiques. Cette diversité de lecture me permet d'adapter mes cours aux intérêts spécifiques de chaque étudiant, rendant l'apprentissage plus engageant et personnel.

Mes 1000 heures d'enseignement m'ont enseigné que chaque étudiant est unique et nécessite une approche personnalisée. Je crois fermement en l'apprentissage adaptatif, où le contenu et la méthode sont ajustés en fonction des besoins, des objectifs et du style d'apprentissage de chaque individu.

Que vous prépariez les examens SAT, cherchiez à améliorer votre anglais conversationnel, ou souhaitiez simplement enrichir votre vocabulaire, je suis là pour vous accompagner dans votre parcours. Mon objectif est de vous donner les outils et la confiance nécessaires pour exceller en anglais, que ce soit dans un contexte académique, professionnel ou personnel.

Dans mes cours, nous explorerons ensemble les nuances de la grammaire anglaise, développerons votre compréhension orale et écrite, et travaillerons sur votre prononciation pour que vous puissiez communiquer avec aisance et précision. Chaque session est conçue pour être interactive, engageante et productive.

Je suis passionnée par l'enseignement et je crois que l'apprentissage d'une langue devrait être une expérience enrichissante et agréable. Mon approche combine rigueur académique et créativité pédagogique pour créer un environnement où vous pouvez apprendre efficacement tout en vous amusant.

Rejoignez-moi dans cette aventure linguistique et découvrez comment l'anglais peut ouvrir de nouvelles portes dans votre vie personnelle et professionnelle. Ensemble, nous transformerons vos défis linguistiques en opportunités de croissance et de réussite.";

try {
    $profile = FreelancerProfile::find(1);
    
    if ($profile) {
        $profile->bio = $longBio;
        $profile->save();
        
        echo "✅ Bio mise à jour avec succès !\n";
        echo "Longueur du texte : " . strlen($longBio) . " caractères\n";
        echo "Nombre de mots : " . str_word_count($longBio) . " mots\n";
    } else {
        echo "❌ Profil avec ID 1 non trouvé\n";
    }
} catch (\Exception $e) {
    echo "❌ Erreur : " . $e->getMessage() . "\n";
}

