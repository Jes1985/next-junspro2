<?php
$file = __DIR__ . '/resources/views/frontend/formation/ma-pause-souffle.blade.php';
$content = file_get_contents($file);

// 1. 5 → 6 questions
$content = str_replace(
    'Ces 5 questions vous aident',
    'Ces 6 questions vous aident',
    $content
);

// 2. Remplacer les 5 questions par 6 via regex multi-ligne
$pattern = '/(ps-act__q-num">1<\/span> Dans votre pratique.*?ps-act__q-num">5<\/span> Quelle carte.*?100 % \?<\/div>)/s';
$replacement = '<span class="ps-act__q-num">1</span> Dans votre pratique, êtes-vous principalement seul devant votre travail, face à une personne, devant un groupe, ou au cœur de votre foyer ?</div>
          <div class="ps-act__q"><span class="ps-act__q-num">2</span> Le moment le plus délicat de votre journée — c\'est avant de commencer, entre deux personnes, au milieu d\'une décision, ou dans la vie quotidienne à la maison ?</div>
          <div class="ps-act__q"><span class="ps-act__q-num">3</span> Ce que vous transmettez — c\'est une œuvre, une guérison, un savoir, une direction, une présence, ou simplement de l\'amour au quotidien ?</div>
          <div class="ps-act__q"><span class="ps-act__q-num">4</span> Quand vous n\'êtes pas centré, cela se voit-il dans le résultat (qualité du travail), dans la relation (qualité du contact), dans la salle (ambiance du groupe), ou dans votre foyer (tension, réactions) ?</div>
          <div class="ps-act__q"><span class="ps-act__q-num">5</span> Votre lieu de pratique est-il professionnel, institutionnel, ou la maison comme terrain de vie ?</div>
          <div class="ps-act__q"><span class="ps-act__q-num">6</span> Quelle carte vous a touché instinctivement — même si vous ne vous y retrouvez pas à 100 % ?</div>';

$new = preg_replace($pattern, $replacement, $content, 1, $count);
if ($count > 0) {
    $content = $new;
    echo "Questions remplacées ($count)\n";
} else {
    echo "Pattern non trouvé — on laisse tel quel\n";
}

file_put_contents($file, $content);
echo "Terminé\n";
