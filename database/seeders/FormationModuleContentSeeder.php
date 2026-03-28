<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FormationModuleContentSeeder extends Seeder
{
    private array $content = [
        '00-comprendre-le-corps' => [
            'intro_text' => "Avant d'étudier l'anatomie, posez-vous une seconde.\n\nLe corps que vous portez en ce moment — vous l'habitez depuis votre naissance. Et pourtant, il vous est peut-être encore partiellement inconnu.\n\nCe module ne commence pas par des schémas ou des termes latins.\nIl commence par **trois images** — simples, évidentes, que tout le monde comprend en quelques secondes.\n\nCar pour comprendre le corps profondément, il faut d'abord le **voir** autrement.",
            'description' => 'Trois paraboles pour comprendre le corps humain : la maison, l\'arbre et l\'orchestre. Les fondations anatomiques de la méthode Pause Souffle.',
            'activities' => [
                [
                    'type'        => 'lecture',
                    'title'       => '🏠 Le Corps — Une Maison Vivante',
                    'duration'    => '8 min',
                    'description' => 'La structure du corps expliquée à travers l\'image universelle de la maison : charpente, charnières, mécanismes, circulation d\'air et réseau électrique.',
                    'content'     => '<h3>Imaginez que votre corps est une maison vivante.</h3>
<p>Pas une maison ordinaire — une maison qui pense, qui respire, qui s\'adapte à chaque instant. Une maison habitée.</p>

<h3>La charpente — le squelette</h3>
<p>Toute maison repose sur une charpente. Sans elle, les murs s\'effondrent, la toiture cède, tout s\'affaisse.<br>
Dans votre corps, c\'est le <strong>squelette</strong>. Il donne la structure, la forme, l\'architecture.<br>
La <strong>colonne vertébrale</strong> est la poutre centrale : le pilier autour duquel s\'organise tout le reste.</p>
<blockquote>Fermez les yeux un instant. Sentez votre dos contre le dossier ou le sol. C\'est votre charpente. Elle est là depuis le premier jour.</blockquote>

<h3>Les charnières — les articulations</h3>
<p>Une porte sans charnières ne s\'ouvre plus. Une fenêtre sans pivot reste fermée.<br>
Dans votre corps, ce sont les <strong>articulations</strong> — genou, coude, épaule, hanche, cheville.<br>
Elles permettent l\'ouverture, la fermeture, le pivot, la rotation. Sans elles, le corps serait rigide — un mur plein.</p>

<h3>Les mécanismes — les muscles</h3>
<p>Une maison moderne a des mécanismes qui permettent le mouvement : portes automatiques, volets, ascenseur. Ils ne poussent pas — ils tirent, ils activent.<br>
Dans votre corps, ce sont les <strong>muscles</strong>. Ils tirent sur les os, activent les articulations, créent chaque geste.<br>
<em>Un muscle ne pousse jamais — il tire. Toujours.</em></p>

<h3>L\'air qui circule — la respiration</h3>
<p>Une maison saine a de l\'air qui circule. Pas du vent — de l\'air. Des fenêtres que l\'on ouvre le matin, une atmosphère qui se renouvelle.<br>
Quand l\'air circule bien : la maison est légère, vivante.<br>
Quand l\'air est bloqué : l\'atmosphère devient lourde, étouffante.<br>
Dans votre corps, c\'est la <strong>respiration</strong>. La Pause Souffle 5-5-5 est l\'acte d\'ouvrir consciemment les fenêtres de votre maison.</p>

<h3>Le réseau électrique — le système nerveux</h3>
<p>Une maison sans électricité est aveugle. L\'électricité relie chaque pièce, allume les lumières, fait fonctionner chaque appareil.<br>
Dans votre corps, c\'est le <strong>système nerveux</strong>. Il relie le cerveau à chaque muscle, chaque organe, chaque millimètre de peau — en millisecondes.</p>

<div style="background:rgba(201,168,76,.08);border:1px solid rgba(201,168,76,.2);border-radius:10px;padding:1rem 1.25rem;margin:.75rem 0;">
<strong style="color:#c9a84c;">Votre maison vivante en 5 éléments :</strong><br>
Le <strong>squelette</strong> = la charpente &nbsp;·&nbsp; Les <strong>articulations</strong> = les charnières<br>
Les <strong>muscles</strong> = les mécanismes &nbsp;·&nbsp; La <strong>respiration</strong> = l\'air qui circule<br>
Le <strong>système nerveux</strong> = le réseau électrique
</div>',
                ],
                [
                    'type'        => 'lecture',
                    'title'       => '🌳 Le Corps — Un Arbre Vivant',
                    'duration'    => '8 min',
                    'description' => 'La vitalité du corps révélée par l\'image de l\'arbre : tronc, branches, racines, écorce, sève, feuilles et réseau invisible.',
                    'content'     => '<h3>Imaginez maintenant que votre corps est un arbre vivant.</h3>
<p>Pas un arbre figé dans un tableau — un arbre en pleine vie. Qui pousse, qui respire, qui puise et qui nourrit.<br>
Si la maison vous a parlé de <em>structure</em>, l\'arbre vous parle de <em>vie</em>.</p>

<h3>Le tronc — la colonne vertébrale</h3>
<p>Tout arbre s\'organise autour de son tronc. Vertical, central, lien entre la terre et le ciel.<br>
Dans votre corps, c\'est la <strong>colonne vertébrale</strong>. Elle relie le bassin au crâne et protège la moelle épinière — le câble central du système nerveux.<br>
La santé de votre colonne conditionne la santé de l\'ensemble.</p>
<blockquote>Sentez votre colonne maintenant. Relâchez doucement le dos. Respirez vers votre centre.</blockquote>

<h3>Les branches et les racines — bras et jambes</h3>
<p>Les <strong>bras</strong> sont les branches : ils s\'étendent, s\'élèvent, s\'ouvrent vers le monde. Ils explorent, touchent, créent.<br>
Les <strong>jambes</strong> sont les racines : elles ancrent, stabilisent, absorbent les chocs. La solidité d\'un arbre se juge à la profondeur de ses racines.<br>
<em>Sentez vos pieds en ce moment. C\'est votre ancrage dans la terre.</em></p>

<h3>L\'écorce vivante — les muscles</h3>
<p>L\'écorce d\'un arbre est vivante. Elle enveloppe, protège, donne sa forme au tronc et aux branches. Elle porte aussi les traces du temps — les saisons, les cicatrices, la croissance.<br>
Dans votre corps, ce sont les <strong>muscles</strong>. Ils enveloppent les os, protègent les organes, donnent au corps sa forme visible. Et comme l\'écorce : ils gardent la mémoire des tensions accumulées.</p>

<h3>La sève — le sang</h3>
<p>Dans un arbre, la sève circule en permanence, du sol jusqu\'aux feuilles les plus hautes. Elle transporte l\'eau, les minéraux, l\'énergie. Sans sève : l\'arbre dépérit.<br>
Dans votre corps, c\'est le <strong>sang</strong> — 100 000 km de vaisseaux, l\'équivalent de 2,5 fois le tour de la Terre.<br>
Le mouvement et la respiration sont les pompes de votre sève.</p>

<h3>Les feuilles — les poumons</h3>
<p>Les feuilles d\'un arbre sont les lieux d\'échange avec le monde extérieur. Elles captent la lumière, absorbent le CO₂, libèrent l\'oxygène.<br>
Dans votre corps, ce sont les <strong>poumons</strong>. À chaque inspiration, ils capturent l\'oxygène du monde. À chaque expiration, ils libèrent ce qui n\'est plus utile.<br>
Chaque souffle est un échange entre vous et le monde.</p>

<h3>Le réseau invisible — les nerfs</h3>
<p>Sous l\'écorce d\'un arbre circule un réseau invisible qui transmet des informations dans toute la plante. C\'est ainsi qu\'un arbre répond à la lumière, à la chaleur, à la menace.<br>
Dans votre corps, ce sont les <strong>nerfs</strong> — vitesse de transmission : jusqu\'à 120 m/s.<br>
Sensation, mouvement, réaction : tout passe par ce réseau.</p>

<div style="background:rgba(201,168,76,.08);border:1px solid rgba(201,168,76,.2);border-radius:10px;padding:1rem 1.25rem;margin:.75rem 0;">
<strong style="color:#c9a84c;">Votre arbre vivant en 6 éléments :</strong><br>
La <strong>colonne</strong> = le tronc &nbsp;·&nbsp; Les <strong>bras</strong> = les branches &nbsp;·&nbsp; Les <strong>jambes</strong> = les racines<br>
Les <strong>muscles</strong> = l\'écorce vivante &nbsp;·&nbsp; Le <strong>sang</strong> = la sève<br>
Les <strong>poumons</strong> = les feuilles &nbsp;·&nbsp; Les <strong>nerfs</strong> = le réseau invisible
</div>',
                ],
                [
                    'type'        => 'lecture',
                    'title'       => '🎼 Le Corps — Un Orchestre Vivant',
                    'duration'    => '8 min',
                    'description' => 'La coordination du corps révélée par l\'image de l\'orchestre : chef d\'orchestre, partitions, instruments, scène et rythme.',
                    'content'     => '<h3>Troisième image — la plus puissante pour comprendre le mouvement.</h3>
<p>Imaginez que votre corps est un grand orchestre vivant.<br>
Si la maison vous a parlé de <em>structure</em>, l\'arbre de <em>vie</em> — l\'orchestre vous parle d\'<em>intelligence</em>.<br>
Car un corps qui bouge bien n\'est pas seulement solide et vivant. Il est <strong>coordonné</strong>.</p>

<h3>Le chef d\'orchestre — le cerveau</h3>
<p>Dans un orchestre, le chef dirige sans jouer d\'instrument. Il écoute l\'ensemble, anticipe, corrige, donne le tempo. Sans lui, chaque musicien jouerait dans son coin — du bruit, pas de la musique.<br>
Dans votre corps, c\'est le <strong>cerveau</strong>. En permanence, il reçoit des milliers de signaux, prend des décisions, envoie des ordres. Équilibre, posture, mouvement, douleur, émotion — tout passe par lui.</p>

<h3>Les partitions — les nerfs</h3>
<p>Les musiciens ne jouent pas au hasard — ils ont des partitions précises, coordonnées.<br>
Dans votre corps, ce sont les <strong>nerfs</strong>. Ils transmettent les instructions du cerveau : <em>Contracte. Relâche. Bouge. Arrête.</em><br>
Et en sens inverse : ils remontent les sensations vers le cerveau pour qu\'il ajuste en temps réel.</p>

<h3>Les instruments — les muscles</h3>
<p>Dans un orchestre, chaque instrument a son timbre, son rôle spécifique dans l\'harmonie.<br>
Dans votre corps, ce sont les <strong>muscles</strong> :</p>
<ul>
<li>Certains sont <strong>puissants</strong>, comme les cuivres — le grand fessier, les quadriceps.</li>
<li>D\'autres sont <strong>précis</strong>, comme les violons — les muscles de la main, les muscles oculaires.</li>
<li>D\'autres encore sont <strong>stabilisateurs</strong>, silencieux, comme les basses — les muscles profonds du dos, le plancher pelvien.</li>
</ul>
<p>Un mouvement fluide, c\'est quand tous les instruments jouent ensemble, au bon moment.</p>

<h3>La scène — le squelette</h3>
<p>Les musiciens ont besoin d\'une scène solide. Sans structure, l\'orchestre ne peut pas jouer.<br>
Dans votre corps, c\'est le <strong>squelette</strong>. Il offre les points d\'appui que les muscles utilisent pour créer le mouvement.</p>

<h3>Le rythme — la respiration</h3>
<p>Dans toute musique, il y a un battement — une pulsation qui donne la vie à l\'ensemble.<br>
Dans votre corps, c\'est la <strong>respiration</strong>.<br>
Quand elle est lente et profonde : l\'orchestre joue en douceur, tout le corps se dépose.<br>
Quand elle est rapide et courte : tout s\'accélère, la tension monte.<br>
<strong>Ce que vous faites avec votre souffle, vous le faites avec votre corps entier.</strong><br>
La Pause Souffle 5-5-5 est l\'acte de reprendre la baguette — consciemment.</p>

<div style="background:rgba(201,168,76,.08);border:1px solid rgba(201,168,76,.2);border-radius:10px;padding:1rem 1.25rem;margin:.75rem 0;">
<strong style="color:#c9a84c;">Votre orchestre vivant en 5 éléments :</strong><br>
Le <strong>cerveau</strong> = le chef d\'orchestre &nbsp;·&nbsp; Les <strong>nerfs</strong> = les partitions<br>
Les <strong>muscles</strong> = les instruments &nbsp;·&nbsp; Le <strong>squelette</strong> = la scène<br>
La <strong>respiration</strong> = le rythme qui guide tout
</div>',
                ],
                [
                    'type'        => 'lecture',
                    'title'       => '🗺 La Géographie du Corps — Les 12 Territoires',
                    'duration'    => '20 min',
                    'description' => 'Parcourez le corps territoire par territoire : os, muscles, articulations et fonction de chaque région. Avec une expérience sensorielle de 30 secondes par zone.',
                    'content'     => '<h3>Le corps a une géographie.</h3>
<p>Comme un continent, il s\'organise en <strong>territoires</strong> — chacun avec ses structures, ses fonctions, son langage propre. Parcourir cette géographie n\'est pas mémoriser une liste. C\'est apprendre à <em>voyager dans votre propre corps</em>.</p>

<div style="background:rgba(201,168,76,.06);border-left:3px solid #c9a84c;padding:.75rem 1rem;margin:.75rem 0;border-radius:0 8px 8px 0;">
<strong style="color:#c9a84c;">Mode d\'emploi :</strong> Pour chaque territoire, lisez — puis fermez les yeux 30 secondes et <em>sentez</em> cette zone dans votre corps. C\'est ainsi que la connaissance devient incarnée.
</div>

<h3>1 — La Tête</h3>
<p><strong>Os du crâne :</strong> frontal, 2 pariétaux, 2 temporaux, occipital, sphénoïde, ethmoïde <em>(8 os).</em><br>
<strong>Os du visage :</strong> 2 maxillaires, mandibule, 2 zygomatiques, 2 nasaux et leurs voisins <em>(14 os).</em><br>
<strong>Muscles clés :</strong> masséter (mastication), temporal (fermeture de la mâchoire), orbiculaires (yeux et bouche).<br>
<strong>Fonctions :</strong> perception sensorielle, mastication, langage, expression.</p>
<blockquote>✋ Expérience : desserrez la mâchoire. Laissez les dents se décoller légèrement. Respirez. Le masséter est souvent le premier muscle à accumuler le stress de la journée.</blockquote>

<h3>2 — Le Cou</h3>
<p><strong>Os :</strong> vertèbres cervicales C1 à C7 — C1 (atlas) porte la tête, C2 (axis) permet la rotation.<br>
<strong>Muscles superficiels :</strong> sterno-cléido-mastoïdien (SCM), scalènes ×3, trapèze supérieur.<br>
<strong>Muscles profonds :</strong> long du cou, long de la tête — les stabilisateurs silencieux.<br>
<strong>Fonctions :</strong> mobilité de la tête dans les 3 plans, passage des artères carotides et du nerf vague.</p>
<blockquote>✋ Expérience : inclinez très lentement la tête vers la droite. Sentez l\'étirement du SCM gauche. Respirez 5 secondes. Revenez. Le nerf vague passe là — chaque respiration le calme.</blockquote>

<h3>3 — Épaules et Bras</h3>
<p><strong>Os :</strong> clavicule, scapula (omoplate), humérus.<br>
<strong>Coiffe des rotateurs :</strong> supra-épineux, infra-épineux, petit rond, subscapulaire — 4 muscles qui stabilisent l\'épaule.<br>
<strong>Bras :</strong> biceps brachial, brachial, triceps brachial, coraco-brachial.<br>
<strong>Fonctions :</strong> élévation, rotation, préhension, expression corporelle.</p>
<blockquote>✋ Expérience : faites 3 grands cercles lents avec les épaules vers l\'arrière. Sentez la scapula glisser sur la cage thoracique. C\'est la coiffe des rotateurs qui travaille.</blockquote>

<h3>4 — Avant-bras et Main</h3>
<p><strong>Avant-bras :</strong> radius et ulna. Muscles : brachio-radial, fléchisseurs du carpe, extenseurs des doigts.<br>
<strong>La main — 27 os en 3 niveaux :</strong></p>
<ul>
<li><strong>Carpe (poignet) :</strong> 8 os — scaphoïde, lunaire, triquetrum, pisiforme, trapèze, trapézoïde, capitatum, hamatum.</li>
<li><strong>Métacarpe (paume) :</strong> 5 os — un par doigt.</li>
<li><strong>Phalanges (doigts) :</strong> 14 os — 2 pour le pouce, 3 pour chaque autre doigt.</li>
</ul>
<blockquote>✋ Expérience : ouvrez les mains grand. Écartez tous les doigts. Puis fermez très lentement, phalange par phalange, en commençant par les extrémités. Sentez les 27 os s\'organiser. Les mains sont la carte de votre système nerveux périphérique.</blockquote>

<h3>5 — Thorax</h3>
<p><strong>Os :</strong> sternum, 12 paires de côtes, vertèbres thoraciques T1–T12.<br>
<strong>Muscles :</strong> grand pectoral, petit pectoral, intercostaux (entre les côtes), <strong>diaphragme</strong> — le muscle central de la respiration.<br>
<strong>Organes :</strong> cœur, poumons.<br>
<strong>Fonctions :</strong> respiration, circulation, protection des organes vitaux.</p>
<blockquote>✋ Expérience : posez les mains sur les côtés de votre cage thoracique. Inspirez lentement. Sentez les côtes s\'écarter <em>latéralement</em> — c\'est le diaphragme qui descend et pousse le contenu abdominal vers le bas, forçant les côtes à s\'ouvrir. La Pause Souffle 5-5-5 mobilise ce mécanisme à chaque cycle.</blockquote>

<h3>6 — Abdomen</h3>
<p><strong>Muscles en couches :</strong></p>
<ul>
<li>Droit de l\'abdomen — la couche externe, visible.</li>
<li>Oblique externe — direction diagonale vers le bas.</li>
<li>Oblique interne — direction diagonale vers le haut (croisé avec l\'externe).</li>
<li><strong>Transverse de l\'abdomen</strong> — la ceinture profonde, invisible, fondamentale pour la stabilité lombaire.</li>
</ul>
<p><strong>Organes :</strong> estomac, intestins, foie, pancréas, rate.<br>
<strong>Fonctions :</strong> stabilisation du tronc, digestion, protection viscérale.</p>
<blockquote>✋ Expérience : expirez lentement en rentrant très légèrement le ventre. Tenez 5 secondes. C\'est le transverse qui travaille. Ce muscle est activé à chaque expiration Pause Souffle 5-5-5.</blockquote>

<h3>7 — Dos</h3>
<p><strong>Muscles superficiels :</strong> trapèze (3 portions), grand dorsal, rhomboïdes majeur et mineur.<br>
<strong>Muscles profonds — les érecteurs du rachis :</strong> iliocostal, longissimus, spinal.<br>
<strong>Muscles très profonds :</strong> multifides — les stabilisateurs vertèbre par vertèbre.<br>
<strong>Fonctions :</strong> extension de la colonne, protection de la moelle épinière, posture.</p>
<blockquote>✋ Expérience : asseyez-vous au bord de la chaise. Laissez le dos s\'arrondir complètement (flexion). Puis, lentement, creusez légèrement le bas du dos (extension). Répétez 3 fois. Ce sont les érecteurs et les multifides qui coordonnent ce mouvement.</blockquote>

<h3>8 — Bassin</h3>
<p><strong>Os :</strong> ilion (l\'aile), ischion (l\'assise), pubis (devant). Ensemble, ils forment l\'os coxal × 2 + sacrum = le bassin.<br>
<strong>Muscles :</strong> psoas et iliaque (psoas-iliaque = fléchisseur de hanche), grand fessier, moyen et petit fessier, piriforme.<br>
<strong>Articulations :</strong> sacro-iliaques (transmission des forces entre colonne et jambes).<br>
<strong>Fonctions :</strong> stabilité fondamentale, transmission des forces sol-colonne, ancrage du centre de gravité.</p>
<blockquote>✋ Expérience : debout, posez une main sur votre bas-ventre, l\'autre sur le bas du dos. Respirez profondément dans le ventre. Sentez le bassin bouger légèrement. Le psoas s\'attache sur les vertèbres lombaires et le fémur — il est le lien entre le tronc et les jambes.</blockquote>

<h3>9 — Cuisses</h3>
<p><strong>Os :</strong> fémur — l\'os le plus long et le plus résistant du corps.<br>
<strong>Quadriceps (avant) :</strong> droit fémoral, vaste latéral, vaste médial, vaste intermédiaire — extension du genou.<br>
<strong>Ischio-jambiers (arrière) :</strong> biceps fémoral, semi-tendineux, semi-membraneux — flexion du genou.<br>
<strong>Adducteurs (intérieur) :</strong> pectiné, long adducteur, court adducteur, grand adducteur, gracile.<br>
<strong>Fonctions :</strong> marche, course, stabilité du genou, équilibre postural.</p>
<blockquote>✋ Expérience : croisez les jambes. Posez la main sur la cuisse inférieure. Sentez la fermeté du quadriceps. Maintenant, asseyez-vous bien sur vos ischions. Sentez les ischio-jambiers s\'étirer légèrement sous la cuisse.</blockquote>

<h3>10 — Jambe</h3>
<p><strong>Os :</strong> tibia (porteur), fibula (stabilisateur).<br>
<strong>Muscles :</strong> tibial antérieur (relève le pied), gastrocnémien et soléaire (le mollet = propulsion), fibulaires long et court (stabilisation de la cheville).<br>
<strong>Articulation :</strong> genou (charnière + rotation), cheville (pivot).<br>
<strong>Fonctions :</strong> propulsion à la marche, amortissement, ajustement postural permanent.</p>

<h3>11 — Le Pied — 26 os en 3 niveaux</h3>
<ul>
<li><strong>Tarse (arrière) :</strong> talus, calcanéum, naviculaire, cuboïde, 3 cunéiformes — 7 os.</li>
<li><strong>Métatarse (milieu) :</strong> 5 métatarsiens.</li>
<li><strong>Phalanges (orteils) :</strong> 14 os (gros orteil = 2, autres = 3 chacun).</li>
</ul>
<blockquote>✋ Expérience : debout, soulevez légèrement les orteils. Puis posez-les un par un, en commençant par le petit orteil. Sentez les 26 os s\'organiser comme un trépied. Un pied stable = une posture stable = une respiration libre. La fondation de tout.</blockquote>

<div style="background:rgba(201,168,76,.08);border:1px solid rgba(201,168,76,.2);border-radius:10px;padding:1rem 1.25rem;margin:1rem 0;">
<strong style="color:#c9a84c;">Le squelette en chiffres :</strong><br>
206 os au total · 27 os dans une main · 26 os dans un pied · 33 vertèbres<br>
<em>Les mains et les pieds à eux seuls contiennent plus de la moitié des os du corps.</em>
</div>',
                ],
                [
                    'type'        => 'lecture',
                    'title'       => '🕸 Le Tissu Invisible — Fascias et Chaînes Musculaires',
                    'duration'    => '12 min',
                    'description' => 'La découverte la plus importante de l\'anatomie moderne : le fascia, tissu qui relie tout. Les 5 grandes chaînes musculaires (Anatomy Trains) qui expliquent pourquoi une tension au pied remonte jusqu\'aux cervicales.',
                    'source'      => 'Sources : Thomas Myers — Anatomy Trains (2001, 4e éd. 2021) · Robert Schleip — Fascia Research (2012) · Serge Gracovetsky — The Spinal Engine',
                    'content'     => '<h3>Le fascia — la combinaison sous la peau</h3>
<p>Si vous pouviez retirer tous les os et tous les muscles du corps humain en laissant uniquement le fascia... vous auriez encore une silhouette humaine parfaitement reconnaissable. Le fascia <strong>donne sa forme au corps</strong>.</p>
<p>C\'est un tissu conjonctif continu — comme une combinaison de plongée tridimensionnelle — qui enveloppe chaque muscle, chaque os, chaque organe, chaque nerf, sans jamais s\'interrompre. <strong>Il n\'y a aucune séparation dans le corps. Tout est relié.</strong></p>

<h3>Pourquoi c\'est révolutionnaire</h3>
<p>L\'ancienne anatomie découpait le corps en pièces séparées. Le fascia nous dit que c\'est une illusion pédagogique.<br>
En réalité :</p>
<ul>
<li>Une tension dans les fascias plantaires (sous le pied) peut <strong>remonter jusqu\'à la nuque</strong> via la chaîne postérieure.</li>
<li>Une cicatrice abdominale peut <strong>limiter la mobilité de l\'épaule</strong> via les fascias profonds.</li>
<li>Un stress émotionnel chronique <strong>se stabilise dans les fascias</strong> — c\'est pour cela que le corps "garde mémoire" des traumatismes.</li>
</ul>
<blockquote>« Le corps n\'est pas un assemblage de parties. C\'est un réseau de tensions et de compressions interdépendantes. » — Thomas Myers, Anatomy Trains</blockquote>

<h3>Les 5 grandes chaînes myofasciales</h3>
<p>Thomas Myers a cartographié les grandes voies de tension qui traversent le corps de la tête aux pieds. Ce sont les <strong>autoroutes du corps</strong>.</p>

<p><strong>1 — La chaîne postérieure</strong> (ligne arrière superficielle)<br>
Du plancher des pieds → mollets → ischio-jambiers → érecteurs du rachis → scalp.<br>
<em>Rôle : maintenir le corps droit contre la gravité. Tension typique : lombalgies, tensions cervicales, fasciite plantaire.</em></p>

<p><strong>2 — La chaîne antérieure</strong> (ligne avant superficielle)<br>
Dos des pieds → tibial antérieur → quadriceps → droit de l\'abdomen → sternocléïdomastoïdien.<br>
<em>Rôle : flexion du corps, protection viscérale. Tension typique : posture en avant, tête projetée.</em></p>

<p><strong>3 — Les chaînes latérales</strong> (lignes latérales)<br>
Fibulaires → tractus ilio-tibial → obliques → intercostaux → muscles du cou latéraux.<br>
<em>Rôle : équilibre latéral, coordination des deux côtés du corps.</em></p>

<p><strong>4 — Les chaînes spirales</strong> (lignes spirales)<br>
Elles croisent le corps en diagonale, créant les mouvements de rotation.<br>
<em>Rôle : rotation du tronc, marche, gestes asymétriques.</em></p>

<p><strong>5 — Les chaînes profondes</strong> (lignes profondes avant)<br>
Voûte plantaire → psoas → diaphragme → péricarde → fascias du cou et du crâne.<br>
<em>C\'est la ligne des structures les plus profondes, directement connectée à la respiration. <strong>C\'est ici que la Pause Souffle agit en premier.</strong></em></p>

<div style="background:rgba(201,168,76,.08);border:1px solid rgba(201,168,76,.2);border-radius:10px;padding:1rem 1.25rem;margin:.75rem 0;">
<strong style="color:#c9a84c;">La Pause Souffle 5-5-5 et les fascias :</strong><br>
À chaque inspiration profonde, le diaphragme descend et <strong>tire sur la ligne fasciale profonde</strong> — relâchant les tensions du psoas, du péricarde et des fascias cervicaux.<br>
C\'est le mécanisme précis par lequel une respiration consciente libère des tensions en apparence "sans rapport" avec les poumons.
</div>',
                ],
                [
                    'type'        => 'lecture',
                    'title'       => '🏙 La Ville Vivante — Les 11 Systèmes du Corps',
                    'duration'    => '15 min',
                    'description' => 'Une carte mentale des 11 systèmes du corps organisée comme une ville vivante. Chaque système a son rôle, son image et son lien à la méthode Pause Souffle.',
                    'content'     => '<h3>Imaginez maintenant que votre corps est une ville vivante.</h3>
<p>Pas un village — une grande ville organisée, avec des quartiers spécialisés, des services essentiels, des routes de communication et un chef d\'orchestre central. Une ville de 37 000 milliards d\'habitants : vos cellules.</p>

<table style="width:100%;border-collapse:collapse;font-size:0.92em;margin:1rem 0;">
<thead>
<tr style="background:rgba(201,168,76,.15);">
<th style="padding:.6rem .8rem;text-align:left;border-bottom:2px solid rgba(201,168,76,.3);">Système</th>
<th style="padding:.6rem .8rem;text-align:left;border-bottom:2px solid rgba(201,168,76,.3);">Image dans la ville</th>
<th style="padding:.6rem .8rem;text-align:left;border-bottom:2px solid rgba(201,168,76,.3);">Rôle essentiel</th>
</tr>
</thead>
<tbody>
<tr><td style="padding:.5rem .8rem;border-bottom:1px solid rgba(255,255,255,.07);">🧱 Cellulaire</td><td style="padding:.5rem .8rem;border-bottom:1px solid rgba(255,255,255,.07);">Les habitants</td><td style="padding:.5rem .8rem;border-bottom:1px solid rgba(255,255,255,.07);">Tout commence ici — base de toute vie</td></tr>
<tr><td style="padding:.5rem .8rem;border-bottom:1px solid rgba(255,255,255,.07);">🏠 Tégumentaire (peau)</td><td style="padding:.5rem .8rem;border-bottom:1px solid rgba(255,255,255,.07);">Les murs et les remparts</td><td style="padding:.5rem .8rem;border-bottom:1px solid rgba(255,255,255,.07);">Protège, régule la chaleur, perçoit</td></tr>
<tr><td style="padding:.5rem .8rem;border-bottom:1px solid rgba(255,255,255,.07);">🏗 Musculo-squelettique</td><td style="padding:.5rem .8rem;border-bottom:1px solid rgba(255,255,255,.07);">La charpente + les moteurs</td><td style="padding:.5rem .8rem;border-bottom:1px solid rgba(255,255,255,.07);">Structure et mouvement</td></tr>
<tr><td style="padding:.5rem .8rem;border-bottom:1px solid rgba(255,255,255,.07);">⚡ Nerveux</td><td style="padding:.5rem .8rem;border-bottom:1px solid rgba(255,255,255,.07);">Le réseau électrique + internet</td><td style="padding:.5rem .8rem;border-bottom:1px solid rgba(255,255,255,.07);">Communication rapide, réflexes, pensée</td></tr>
<tr><td style="padding:.5rem .8rem;border-bottom:1px solid rgba(255,255,255,.07);">🧪 Endocrinien</td><td style="padding:.5rem .8rem;border-bottom:1px solid rgba(255,255,255,.07);">Les messagers chimiques</td><td style="padding:.5rem .8rem;border-bottom:1px solid rgba(255,255,255,.07);">Régulation lente (hormones)</td></tr>
<tr><td style="padding:.5rem .8rem;border-bottom:1px solid rgba(255,255,255,.07);">❤️ Cardiovasculaire</td><td style="padding:.5rem .8rem;border-bottom:1px solid rgba(255,255,255,.07);">Les routes et la pompe centrale</td><td style="padding:.5rem .8rem;border-bottom:1px solid rgba(255,255,255,.07);">Transport — oxygène, nutriments, chaleur</td></tr>
<tr><td style="padding:.5rem .8rem;border-bottom:1px solid rgba(255,255,255,.07);">🛡 Lymphatique / Immunitaire</td><td style="padding:.5rem .8rem;border-bottom:1px solid rgba(255,255,255,.07);">Le système de nettoyage et la police</td><td style="padding:.5rem .8rem;border-bottom:1px solid rgba(255,255,255,.07);">Défense, filtration, immunité</td></tr>
<tr><td style="padding:.5rem .8rem;border-bottom:1px solid rgba(255,255,255,.07);">🌬 Respiratoire</td><td style="padding:.5rem .8rem;border-bottom:1px solid rgba(255,255,255,.07);">La ventilation de la ville</td><td style="padding:.5rem .8rem;border-bottom:1px solid rgba(255,255,255,.07);">Apporter l\'oxygène, évacuer le CO₂</td></tr>
<tr><td style="padding:.5rem .8rem;border-bottom:1px solid rgba(255,255,255,.07);">🍽 Digestif</td><td style="padding:.5rem .8rem;border-bottom:1px solid rgba(255,255,255,.07);">La cuisine centrale</td><td style="padding:.5rem .8rem;border-bottom:1px solid rgba(255,255,255,.07);">Transformer les aliments en énergie</td></tr>
<tr><td style="padding:.5rem .8rem;border-bottom:1px solid rgba(255,255,255,.07);">💧 Urinaire</td><td style="padding:.5rem .8rem;border-bottom:1px solid rgba(255,255,255,.07);">Les filtres et les stations d\'épuration</td><td style="padding:.5rem .8rem;border-bottom:1px solid rgba(255,255,255,.07);">Éliminer les déchets, équilibre hydrique</td></tr>
<tr><td style="padding:.5rem .8rem;">🌱 Reproducteur</td><td style="padding:.5rem .8rem;">L\'atelier de transmission de la vie</td><td style="padding:.5rem .8rem;">Continuité de l\'espèce</td></tr>
</tbody>
</table>

<h3>La cellule — la maison miniature</h3>
<p>Avant les systèmes, il y a la cellule. Imaginez une ville composée de 37 000 milliards de <strong>petites maisons autonomes</strong>. Chaque maison produit sa propre énergie (mitochondries), communique avec ses voisines, se répare et se reproduit. Les cellules forment les tissus → les tissus forment les organes → les organes forment les systèmes.</p>

<h3>Le lien Pause Souffle — les systèmes qui répondent immédiatement</h3>
<p>Quand vous pratiquez la Pause Souffle 5-5-5, <strong>5 systèmes répondent simultanément :</strong></p>
<ul>
<li><strong>Respiratoire</strong> — les poumons s\'ouvrent, le diaphragme s\'abaisse.</li>
<li><strong>Cardiovasculaire</strong> — le rythme cardiaque ralentit par le réflexe vago-vagal.</li>
<li><strong>Nerveux</strong> — le système parasympathique prend le relais (mode récupération).</li>
<li><strong>Endocrinien</strong> — le cortisol diminue, l\'ocytocine et la sérotonine augmentent.</li>
<li><strong>Fascial</strong> — les tensions myofasciales profondes se relâchent progressivement.</li>
</ul>
<p><em>Cinq systèmes. Cinq secondes d\'inspiration. Un seul geste.</em></p>',
                ],
                [
                    'type'        => 'pratique',
                    'title'       => '🧘 Méditations Anatomiques Guidées',
                    'duration'    => '25 min',
                    'description' => 'Six méditations courtes — une par système essentiel — intégrant la Pause Souffle 5-5-5. La méthode qui permet de retenir 5 à 10 fois plus vite en ancrant le savoir dans le ressenti.',
                    'content'     => '<h3>Pourquoi les méditations anatomiques fonctionnent</h3>
<p>Les grandes écoles corporelles — Feldenkrais, Pilates, Eutonie, Hatha Yoga — partagent un secret pédagogique : <strong>on apprend mieux ce qu\'on ressent que ce qu\'on lit.</strong><br>
La méditation anatomique active simultanément :</p>
<ul>
<li><strong>La mémoire visuelle</strong> (l\'image mentale)</li>
<li><strong>La mémoire sensorielle</strong> (la sensation dans le corps)</li>
<li><strong>La mémoire émotionnelle</strong> (l\'état intérieur)</li>
</ul>
<p>Résultat : ce qui aurait demandé des heures de lecture se grave en quelques minutes.</p>
<p>Chaque méditation ci-dessous dure <strong>3 à 4 minutes</strong>. Installez-vous confortablement. Lisez une fois. Puis fermez les yeux et vivez-la.</p>

<hr style="border:none;border-top:1px solid rgba(201,168,76,.2);margin:1.5rem 0;">

<h3>🌬 Le Système Respiratoire</h3>
<p>Fermez les yeux.<br>
Posez une main sur la poitrine, l\'autre sur le ventre.<br>
Prenez une inspiration lente — <em>cinq secondes</em>.<br>
Imaginez votre cage thoracique comme une grande maison qui s\'ouvre à la lumière. L\'air entre dans vos poumons comme une brise qui traverse les pièces.<br>
Les alvéoles — 300 millions de petits sacs — se remplissent d\'oxygène.<br>
Retenez — <em>cinq secondes</em>. Laissez cet oxygène passer dans le sang.<br>
Expirez — <em>cinq secondes</em>. Le corps libère ce dont il n\'a plus besoin.<br>
Faites trois cycles complets.<br>
<em>Vous venez de vivre le système respiratoire.</em></p>

<hr style="border:none;border-top:1px solid rgba(201,168,76,.15);margin:1.5rem 0;">

<h3>❤️ Le Système Cardiovasculaire</h3>
<p>Posez une main sur votre cœur.<br>
Sentez le battement.<br>
Imaginez que votre cœur est une pompe centrale au milieu d\'une ville.<br>
À chaque battement, il envoie du sang dans <strong>100 000 km de vaisseaux</strong> — l\'équivalent de 2,5 fois le tour de la Terre.<br>
Les artères partent du cœur chargées d\'oxygène — rouge vif.<br>
Les veines reviennent au cœur chargées de déchets — sombre.<br>
Les capillaires — plus fins qu\'un cheveu — nourrissent chaque cellule.<br>
Inspirez 5 s. → Retenez 5 s. → Expirez 5 s.<br>
<em>Sentez le cœur se calmer à chaque expiration.</em></p>

<hr style="border:none;border-top:1px solid rgba(201,168,76,.15);margin:1.5rem 0;">

<h3>⚡ Le Système Nerveux</h3>
<p>Imaginez votre cerveau comme un centre de contrôle lumineux.<br>
Depuis ce centre partent des millions de fils lumineux. Les nerfs.<br>
Ils parcourent tout votre corps — jusqu\'aux dernières phalanges de vos orteils.<br>
Ils transmettent à 120 m/s : mouvements, sensations, perceptions.<br>
Maintenant, avec la Pause Souffle :<br>
Inspirez 5 s. — les fils s\'illuminent.<br>
Retenez 5 s. — le centre de contrôle reçoit.<br>
Expirez 5 s. — imaginez que tous les fils s\'apaisent, s\'assombrissent doucement.<br>
Le système nerveux parasympathique prend le relais.<br>
<em>Vous venez de passer du mode "alerte" au mode "récupération".</em></p>

<hr style="border:none;border-top:1px solid rgba(201,168,76,.15);margin:1.5rem 0;">

<h3>🍽 Le Système Digestif</h3>
<p>Placez les deux mains sur votre ventre.<br>
Sentez la chaleur sous vos paumes.<br>
Imaginez que votre ventre est une cuisine centrale — toujours en activité, transformant, distribuant, créant de l\'énergie.<br>
9 mètres de tube digestif, de la bouche à l\'anus.<br>
Votre "deuxième cerveau" — 500 millions de neurones entériques.<br>
Inspirez 5 s. — l\'air descend jusqu\'au ventre.<br>
Retenez 5 s. — laissez la chaleur de vos mains réchauffer cet espace.<br>
Expirez 5 s. — relâchez toute tension abdominale.<br>
<em>Quand le souffle est calme, la digestion s\'optimise — c\'est la physiologie.</em></p>

<hr style="border:none;border-top:1px solid rgba(201,168,76,.15);margin:1.5rem 0;">

<h3>🛡 Le Système Immunitaire</h3>
<p>Imaginez un réseau de gardiens silencieux qui parcourent votre corps sans jamais s\'arrêter.<br>
Vos 600 ganglions lymphatiques filtrent la lymphe — 2 à 4 litres par jour.<br>
Vos globules blancs — leucocytes — patrouillent, identifient, neutralisent.<br>
Ce système travaille mieux quand vous êtes calme et reposé.<br>
Inspirez 5 s. — la lymphe circule.<br>
Retenez 5 s. — les gardiens sont à leur poste.<br>
Expirez 5 s. — le corps se défend en silence.<br>
<em>Chaque Pause Souffle soutient votre immunité.</em></p>

<hr style="border:none;border-top:1px solid rgba(201,168,76,.15);margin:1.5rem 0;">

<h3>🕸 Le Système Fascial</h3>
<p>Imaginez maintenant une combinaison de plongée qui enveloppe chaque muscle, chaque os, chaque organe de votre corps — sans jamais s\'interrompre.<br>
C\'est le fascia. Le tissu de l\'unité.<br>
Chaque clic de votre mâchoire, chaque tension dans vos épaules, chaque douleur dans votre pied — il les ressent tous.<br>
Maintenant, inspirez profondément — <em>cinq secondes</em>.<br>
Le diaphragme descend. Il tire sur la ligne fasciale profonde. Le psoas se relâche légèrement. Les fascias cervicaux se déposent.<br>
Retenez — <em>cinq secondes</em>.<br>
Expirez — <em>cinq secondes</em>. Imaginez que la combinaison se détend d\'un millimètre dans tout le corps.<br>
<em>C\'est ce qui se passe réellement. À chaque Pause Souffle.</em></p>',
                ],
                [
                    'type'        => 'reflexion',
                    'title'       => '✨ Synthèse — La Carte Complète du Corps',
                    'duration'    => '10 min',
                    'description' => 'Intégrer les 3 paraboles, les 12 territoires, les fascias, les 11 systèmes et les méditations. Identifier votre territoire et votre système les plus présents en ce moment.',
                    'content'     => '<h3>Vous avez maintenant la carte complète.</h3>
<p>Regardez ce que vous venez d\'apprendre — non pas en mémorisant, mais en <em>habitant</em> :</p>

<table style="width:100%;border-collapse:collapse;font-size:0.9em;margin:1rem 0;">
<tr style="background:rgba(201,168,76,.12);">
<td style="padding:.6rem .8rem;font-weight:700;">Couche 1</td>
<td style="padding:.6rem .8rem;">🏠🌳🎼 Les 3 paraboles</td>
<td style="padding:.6rem .8rem;color:rgba(255,255,255,.7);">Le cadre mental</td>
</tr>
<tr>
<td style="padding:.6rem .8rem;font-weight:700;">Couche 2</td>
<td style="padding:.6rem .8rem;">🗺 Les 12 territoires</td>
<td style="padding:.6rem .8rem;color:rgba(255,255,255,.7);">La géographie</td>
</tr>
<tr style="background:rgba(255,255,255,.03);">
<td style="padding:.6rem .8rem;font-weight:700;">Couche 3</td>
<td style="padding:.6rem .8rem;">🕸 Fascias + chaînes</td>
<td style="padding:.6rem .8rem;color:rgba(255,255,255,.7);">Les connexions</td>
</tr>
<tr>
<td style="padding:.6rem .8rem;font-weight:700;">Couche 4</td>
<td style="padding:.6rem .8rem;">🏙 Les 11 systèmes</td>
<td style="padding:.6rem .8rem;color:rgba(255,255,255,.7);">L\'intelligence du corps</td>
</tr>
<tr style="background:rgba(255,255,255,.03);">
<td style="padding:.6rem .8rem;font-weight:700;">Couche 5</td>
<td style="padding:.6rem .8rem;">🧘 6 méditations</td>
<td style="padding:.6rem .8rem;color:rgba(255,255,255,.7);">L\'ancrage sensoriel</td>
</tr>
</table>

<h3>Les 3 grilles de lecture clinique</h3>
<p>Quand vous accompagnez quelqu\'un :</p>
<ul>
<li><strong>Quand un client souffre physiquement</strong> → pensez aux 12 territoires. Quel territoire est en tension ? Quelle chaîne myofasciale est impliquée ?</li>
<li><strong>Quand un client manque d\'énergie ou de vitalité</strong> → pensez aux 11 systèmes. Lequel est sous-alimenté ? La respiration, la digestion, l\'immunité ?</li>
<li><strong>Quand un client ne parvient pas à se détendre</strong> → pensez aux 3 paraboles. Sa maison est-elle mal structurée ? Son arbre manque-t-il de sève ? Son orchestre est-il en cacophonie ?</li>
</ul>

<h3>Questions de réflexion</h3>
<ol>
<li>Quel territoire de votre corps est le plus présent en ce moment — et que vous dit-il ?</li>
<li>Parmi les 11 systèmes, lequel vous semble le plus "silencieux" ou le plus négligé dans votre quotidien ?</li>
<li>Quelle méditation anatomique a créé la sensation la plus forte pour vous ?</li>
<li>Faites <strong>3 cycles de Pause Souffle 5-5-5</strong> en laissant votre attention parcourir le corps des pieds à la tête.</li>
</ol>

<div style="background:rgba(201,168,76,.08);border:1px solid rgba(201,168,76,.2);border-radius:10px;padding:1rem 1.25rem;margin:.75rem 0;">
<strong style="color:#c9a84c;">À retenir en une phrase :</strong><br>
Votre corps est une maison vivante, un arbre vivant, un orchestre vivant —<br>
organisé en 12 territoires, relié par les fascias, animé par 11 systèmes.<br>
<em>Et tout cela respire. Tout cela écoute. Tout cela répond à la Pause Souffle.</em>
</div>',
                ],
            ],
            'conclusion' => 'Infiniment + ancré(e) dans la connaissance vivante, sensorielle et complète du corps.',
        ],
        '01-je-me-rencontre' => [
            'intro_text' => "Il y a quelque chose d'étrange dans notre époque : nous sommes constamment en mouvement, constamment connectés, constamment occupés — et pourtant, quelque chose en nous reste sans réponse.\n\nCe n'est pas un manque de volonté. Ce n'est pas non plus un manque de travail.\nC'est l'absence d'une chose simple, presque oubliée : **se rencontrer soi-même.**\n\nCe module ne vous demande pas de changer. Il vous demande d'abord de **voir** — honnêtement, sans défense, sans jugement.",
            'description' => 'Premier pas vers vous-même. Comprendre pourquoi vous courez, et découvrir qui vous êtes quand vous vous arrêtez.',
            'activities' => [
                ['type' => 'lecture',  'title' => 'La science de la course',         'duration' => '10 min',
                 'description' => 'Le système nerveux autonome entre sympathique et parasympathique. Pourquoi le corps s\'épuise et comment 5 minutes de souffle conscient changent tout.',
                 'source'      => 'Sources : Dr Robert Sapolsky — Why Zebras Don\'t Get Ulcers (2004) · Institut HeartMath — Coherence Research · American Institute of Stress (2023)',
                 'content'     => '<h3>Vous ne manquez pas de volonté. Vous manquez de récupération.</h3>
<p>Depuis des décennies, le monde du travail, du sport et du développement personnel valorise une seule chose : <strong>l\'effort soutenu</strong>. Lever tôt. Travailler plus. Tenir plus longtemps. Et pourtant, quelque chose ne fonctionne pas. Les burn-outs explosent. Les arrêts cardiaques de sportifs de haut niveau font la une. Les cadres « qui n\'ont jamais été aussi organisés » s\'effondrent.</p>
<p>Ce n\'est pas une question de faiblesse. C\'est de la <strong>physiologie</strong>.</p>

<h3>Le système nerveux autonome : votre moteur caché</h3>
<p>Votre corps est piloté par un chef d\'orchestre invisible : le <strong>système nerveux autonome (SNA)</strong>. Il régule votre cœur, vos poumons, votre digestion, vos hormones — sans que vous ayez à y penser.</p>
<p>Il fonctionne selon deux modes :</p>
<ul>
<li><strong>Mode sympathique (accélérateur)</strong> — cortisol, adrénaline, rythme cardiaque élevé, vigilance maximale. C\'est le mode « courir / combattre ». Indispensable en situation de danger.</li>
<li><strong>Mode parasympathique (frein)</strong> — nerf vague, sérotonine, récupération cellulaire, digestion, créativité. C\'est le mode « réparer / intégrer ».</li>
</ul>
<p>Le problème ? Notre époque a désactivé le frein. Les notifications, les deadlines permanentes, l\'hyper-connexion — tout cela maintient le système en mode sympathique <strong>en continu</strong>. Le corps ne sait plus s\'arrêter.</p>

<h3>Pourquoi 5 minutes de souffle conscient changent tout</h3>
<p>En 2001, des chercheurs de l\'Institut HeartMath ont découvert quelque chose de remarquable : <em>respirer à environ 5 respirations par minute crée un état de « cohérence cardiaque »</em> — une synchronisation entre le cœur, le cerveau et le système nerveux. Cet état active le nerf vague, qui est le câble principal du système parasympathique.</p>
<p>Traduction concrète : <strong>5 minutes suffisent</strong> pour abaisser le cortisol, réduire la fréquence cardiaque, améliorer la clarté mentale et créer un état de calme stable.</p>
<blockquote>« La respiration est le seul système autonome que nous pouvons contrôler consciemment. C\'est notre porte d\'entrée directe vers l\'état intérieur. » — Dr Andrew Weil</blockquote>

<h3>Ce que le Rituel Pause Souffle active en vous</h3>
<p>Ce n\'est pas une pratique de confort. C\'est une pratique de <strong>réinitialisation neurologique</strong>. Chaque fois que vous faites une Pause Souffle 5-5-5, vous envoyez un signal direct à votre système nerveux : <em>le danger est passé. Tu peux te reconstruire.</em></p>
<p>Votre mission dans ce module est simple : expérimenter. Pas croire — <strong>sentir</strong>.</p>'],
                ['type' => 'exercice', 'title' => 'L\'inventaire honnête',           'duration' => '15 min', 'description' => 'Trois questions sans censure : Je cours après quoi ? Qu\'est-ce que j\'évite ? Si je m\'arrêtais vraiment — qu\'est-ce qui serait encore là ?'],
                ['type' => 'pratique', 'title' => 'La première Pause Souffle 5-5-5', 'duration' => '5 min',  'description' => 'Inspirer 5s · Retenir 5s · Expirer 5s. 5 cycles. Remarquer une sensation et la noter.'],
                ['type' => 'ecriture', 'title' => 'La lettre au moi qui courait',    'duration' => '20 min', 'description' => 'Écrire 10 à 20 lignes adressées à la version de vous qui courait le plus vite. Commencer par : "Je te vois. Et je comprends pourquoi tu courais..."'],
            ],
            'conclusion' => 'Infiniment + présent(e) à vous-même qu\'au début de cette semaine.',
        ],
        '02-je-reconnais-mes-blessures' => [
            'intro_text' => "Nous portons tous des blessures. Des mots entendus trop tôt. Des absences mal interprétées. Des deuils qu'on n'a pas eu le droit de faire.\n\nLe corps garde tout — longtemps avant que la tête comprenne.\n\nCes blessures ne sont pas des défauts. Elles sont des cartes. Elles indiquent où vous avez eu besoin de protection. Et où vous pouvez aujourd'hui commencer à guérir.\n\nLa première étape n'est pas de guérir. C'est de **voir**.",
            'description' => 'Reconnaître sans se condamner. Le corps comme mémoire. Transformer la honte en compréhension.',
            'activities' => [
                ['type' => 'lecture',  'title' => 'Comment le corps porte les blessures',   'duration' => '15 min',
                 'description' => 'Les travaux de Peter Levine (Somatic Experiencing) et Bessel van der Kolk (Le corps n\'oublie rien). Le traumatisme non exprimé s\'installe dans le système nerveux.',
                 'source'      => 'Sources : Peter Levine — Waking the Tiger (1997) · Bessel van der Kolk — The Body Keeps the Score (2014) · Stephen Porges — La théorie polyvagale (2011)',
                 'content'     => '<h3>Le corps se souvient de tout</h3>
<p>Il y a des choses que votre esprit a « oublié ». Votre corps, lui, ne les a jamais oubliées. Une tension dans les épaules qui revient sans raison. Un malaise dans certains lieux. Une réaction disproportionnée face à un ton de voix. Ce ne sont pas des caprices. Ce sont les <strong>empreintes de ce que vous avez traversé</strong>.</p>
<p>Le <strong>traumatisme</strong> n\'est pas réservé aux catastrophes spectaculaires. Il est partout où le système nerveux a été dépassé — et où la décharge n\'a pas eu lieu.</p>

<h3>Peter Levine et le tigre qui s\'échappe</h3>
<p>Le biologiste Peter Levine a observé quelque chose de déterminant chez les animaux sauvages : un zèbre poursuivi par un lion, s\'il s\'échappe, <em>tremble de tout son corps pendant plusieurs minutes</em> avant de reprendre sa vie normale. Ce tremblement n\'est pas la peur. C\'est la <strong>décharge neurologique</strong> du trauma.</p>
<p>Les humains, eux, ont appris à supprimer ce tremblement. <em>« Calme-toi. Sois fort. Ce n\'est rien. »</em> Résultat : l\'énergie de survie reste piégée dans le corps. Elle cherche une sortie — et la trouve sous forme de douleurs chroniques, d\'anxiété, d\'hypervigilance ou d\'effondrement.</p>
<blockquote>« Le traumatisme n\'est pas ce qui vous est arrivé. C\'est ce qui s\'est passé à l\'intérieur de vous en réponse à ce qui vous est arrivé. » — Peter Levine</blockquote>

<h3>Bessel van der Kolk : le corps ne ment pas</h3>
<p>Le psychiatre Bessel van der Kolk a étudié des centaines de patients traumatisés avec la neuroimagerie. Sa découverte majeure : lors d\'un rappel traumatique, <strong>la zone du langage du cerveau se met hors ligne</strong>. Impossible de « parler » le traumatisme hors du corps. Il faut passer par le corps lui-même.</p>
<p>C\'est là que la respiration devient un outil de soin. Le souffle, connecté au nerf vague, est l\'un des rares accès directs au système nerveux autonome — sans avoir besoin de mots.</p>

<h3>Ce que cela change pour vous</h3>
<p>Reconnaître ses blessures n\'est pas une faiblesse. C\'est un acte de précision. Savoir <em>où</em> votre corps stocke une émotion, c\'est savoir <em>où</em> commencer à respirer. Ce module n\'est pas une thérapie — c\'est un <strong>espace de reconnaissance</strong>. Et parfois, être vu suffit pour que quelque chose commence à bouger.</p>'],
                ['type' => 'exercice', 'title' => 'La cartographie du corps',               'duration' => '15 min', 'description' => 'Scanner le corps de la tête aux pieds. Identifier trois zones de tension. Nommer ce que chaque zone pourrait porter sans chercher à l\'analyser.'],
                ['type' => 'pratique', 'title' => 'Respirer vers la tension',              'duration' => '8 min',  'description' => 'Identifier une zone tendue. Inspirer vers elle 5s, expirer en relâchant 5s. Lui dire intérieurement : "Je te vois." Répéter 5 cycles.'],
                ['type' => 'ecriture', 'title' => 'Lettre à la blessure',                  'duration' => '20 min', 'description' => 'Écrire une lettre à la version blessée de vous-même. Pas pour guérir — pour témoigner. Commencer par : "Je te vois. Et je comprends pourquoi tu t\'es protégé(e)."'],
                ['type' => 'reflexion','title' => 'Ce que la blessure m\'a appris',        'duration' => '10 min', 'description' => 'Compléter : "Cette blessure m\'a appris à... Elle m\'a coûté... Mais elle m\'a aussi donné..."'],
            ],
            'conclusion' => 'Infiniment + proche de vous-même dans votre vérité.',
        ],
        '03-je-decris-mon-bonheur' => [
            'intro_text' => "Beaucoup de personnes savent précisément ce qu'elles ne veulent plus. Mais très peu savent décrire ce qu'elles veulent vraiment.\n\nLe bonheur n'est pas une destination abstraite. Il est fait de moments concrets. De sensations. De mots. D'odeurs. De relations.\n\nSi vous ne savez pas à quoi ressemble votre bonheur — vous ne pouvez pas le reconnaître quand il arrive.",
            'description' => 'Passer de "ce que je ne veux plus" à "ce que je veux vraiment". La boussole intérieure.',
            'activities' => [
                ['type' => 'lecture',  'title' => 'Le bonheur est dans les détails',       'duration' => '10 min',
                 'description' => 'La psychologie positive (Martin Seligman, PERMA) : le bonheur durable est fait d\'engagement, de sens, de relations — pas de plaisir immédiat.',
                 'source'      => 'Sources : Martin Seligman — Flourish (2011) · Mihaly Csikszentmihalyi — Flow (1990) · Sonja Lyubomirsky — The How of Happiness (2008)',
                 'content'     => '<h3>Nous cherchons le bonheur au mauvais endroit</h3>
<p>On nous a appris que le bonheur était une destination. Une maison plus grande. Une promotion. Une relation parfaite. Un chiffre sur un compte. Mais la recherche en psychologie positive est formelle : <strong>les grandes réussites ne rendent pas heureux durablement</strong>. L\'adaptation hédonique efface le plaisir en quelques semaines.</p>
<p>Le vrai bonheur — celui qui tient — est fait de quelque chose de beaucoup plus discret.</p>

<h3>Le modèle PERMA de Martin Seligman</h3>
<p>Le psychiatre Martin Seligman a passé trente ans à étudier ce qui constitue réellement le bien-être humain. Il a identifié cinq éléments :</p>
<ul>
<li><strong>P — Émotions Positives</strong> : Pas l\'euphorie. La gratitude. La sérénité. L\'espoir. Des émotions douces, ordinaires.</li>
<li><strong>E — Engagement</strong> : Ces moments où on perd la notion du temps. Ce que Csikszentmihalyi appelle le <em>flow</em>.</li>
<li><strong>R — Relations</strong> : La qualité des liens humains, pas leur quantité.</li>
<li><strong>M — Sens (Meaning)</strong> : Appartenir à quelque chose de plus grand que soi.</li>
<li><strong>A — Accomplissement</strong> : Progresser vers ses propres objectifs — pas ceux des autres.</li>
</ul>
<blockquote>« Le bonheur ne vient pas de ce que vous avez. Il vient de la façon dont vous vous rapportez à ce que vous vivez. » — Sonja Lyubomirsky</blockquote>

<h3>Le bonheur se reconnaît dans les détails</h3>
<p>Les personnes les plus épanouies que les psychologues ont étudiées partagent un point commun : elles savent décrire leur bonheur de façon concrète. Pas « je veux être heureux ». Mais : <em>« Je suis heureux quand je cuisine en silence le dimanche matin »</em>, ou <em>« quand je lis dans un café sans regarder mon téléphone »</em>, ou encore <em>« quand quelqu\'un me dit que j\'ai fait une différence »</em>.</p>
<p>Ces détails ne sont pas anecdotiques. Ils sont <strong>votre boussole intérieure</strong>.</p>

<h3>Pour vous dans ce module</h3>
<p>L\'exercice qui suit n\'est pas une liste de souhaits. C\'est un travail de précision : remettre des mots vrais sur ce qui, concrètement, vous fait vous sentir vivant(e). Parce que si vous ne savez pas à quoi ressemble votre bonheur — vous ne pouvez pas le reconnaître quand il arrive.</p>'],
                ['type' => 'exercice', 'title' => 'Le souvenir boussole',                  'duration' => '15 min', 'description' => 'Retrouver un souvenir où vous vous êtes senti(e) pleinement vivant(e). Quel âge ? Où ? Que faisiez-vous ? Qu\'est-ce que vous ressentiez dans le corps ? Ce souvenir est votre référence.'],
                ['type' => 'pratique', 'title' => 'Ancrage dans la joie — Pause Souffle',  'duration' => '5 min',  'description' => 'Tenir le souvenir boussole en tête pendant 5 cycles 5-5-5. Laisser la sensation du souvenir amplifier la respiration.'],
                ['type' => 'ecriture', 'title' => 'Mon bonheur en 5 phrases concrètes',    'duration' => '15 min', 'description' => 'Décrire le bonheur avec des détails vrais. Pas de grands idéaux. Exemple : "Je suis heureuse quand je prends un café le matin en silence avant que tout le monde se réveille."'],
            ],
            'conclusion' => 'Infiniment + proche de votre propre boussole intérieure.',
        ],
        '04-j-ecoute-mon-souffle' => [
            'intro_text' => "Le souffle est le seul système du corps qui soit à la fois automatique et conscient. Vous pouvez laisser votre cœur battre sans y penser. Mais vous pouvez aussi décider de respirer autrement — maintenant — et transformer votre état intérieur en quelques minutes.\n\nC'est là que réside un pouvoir extraordinaire.\n\nPas le pouvoir de contrôler les autres. Pas le pouvoir de dominer le monde.\n\n**Le pouvoir de revenir à vous-même.**",
            'description' => 'Le cœur de la formation. Maîtriser la cohérence cardiaque et comprendre la physiologie du souffle.',
            'activities' => [
                ['type' => 'lecture',  'title' => 'La physiologie du souffle',             'duration' => '20 min',
                 'description' => 'Le nerf vague, la cohérence cardiaque (Institut HeartMath), les fréquences respiratoires. Pourquoi 5,5 respirations/minute est la fréquence de résonance du corps humain.',
                 'source'      => 'Sources : Institut HeartMath — Coherence Research (2001–2023) · Dr James Nestor — Breath (2020) · Dr Andrew Weil — Breathing: The Master Key to Self-Healing',
                 'content'     => '<h3>La respiration : le levier de pilotage de votre état intérieur</h3>
<p>Le cœur bat. Les reins filtrent. L\'intestin digère. Tout cela se passe sans vous. Mais il existe un système à la frontière entre l\'automatique et le conscient : <strong>la respiration</strong>. C\'est le seul système autonome que vous pouvez contrôler volontairement — et par ce biais, influencer tout le reste.</p>

<h3>Le nerf vague : votre autoroute vers la paix</h3>
<p>Le <strong>nerf vague</strong> est le nerf le plus long du corps humain. Il relie le tronc cérébral au cœur, aux poumons, à l\'estomac — et transporte 80 % de ses informations <em>du corps vers le cerveau</em> (et non l\'inverse). En activant ce nerf, vous envoyez directement au cerveau le message : <em>tu peux te détendre, le danger est passé.</em></p>
<p>Comment l\'activer ? <strong>Par une expiration lente et prolongée.</strong> Chaque fois que vous expirez plus longtemps que vous n\'inspirez, vous stimulez le nerf vague.</p>

<h3>La cohérence cardiaque : la fréquence de résonance du corps humain</h3>
<p>Des chercheurs de l\'Institut HeartMath ont découvert qu\'à <strong>5,5 respirations par minute</strong> (soit ~5,5 secondes d\'inspiration et ~5,5 secondes d\'expiration), le rythme cardiaque entre dans un état de cohérence parfaite avec les oscillations naturelles du système cardiovasculaire.</p>
<p>Cet état de cohérence cardiaque produit des effets mesurables :</p>
<ul>
<li>Réduction du cortisol (hormone du stress) dès <strong>3 minutes</strong></li>
<li>Augmentation de la DHEA (hormone de vitalité)</li>
<li>Amélioration des fonctions cognitives et de la créativité</li>
<li>Régulation des émotions difficiles</li>
<li>Renforcement du système immunitaire sur le long terme</li>
</ul>
<blockquote>« Respirer à 5,5 respirations par minute, c\'est trouver la fréquence de résonance propre au corps humain. » — Dr James Nestor, <em>Breath</em></blockquote>

<h3>Les trois pratiques fondamentales</h3>
<p><strong>1. Cohérence cardiaque 5-5</strong> — 5 secondes inspirer, 5 secondes expirer. 5 minutes = 30 cycles. Effet immédiat et cumulatif (pratique 3 fois/jour = résultats en 3 semaines).</p>
<p><strong>2. Box Breathing (4-4-4-4)</strong> — Technique militaire des Navy SEAL. 4s inspirer · 4s retenir · 4s expirer · 4s retenir. Idéal pour les états de panique ou stress intense.</p>
<p><strong>3. Souffle 4-7-8 (Dr Weil)</strong> — 4s inspirer · 7s retenir · 8s expirer. Active le parasympathique en 4 cycles. Utilisé contre l\'insomnie et l\'anxiété aiguë.</p>

<h3>Ce que cela signifie pour votre pratique</h3>
<p>Ces techniques ne sont pas des remèdes miracle. Ce sont des <strong>outils de navigation intérieure</strong>. En les maîtrisant, vous devenez autonome face à vos états émotionnels. Non pas en les supprimant — mais en sachant comment revenir à vous-même, à tout moment, en n\'importe quelle situation.</p>'],
                ['type' => 'pratique', 'title' => 'Cohérence cardiaque 5-5 — 5 minutes',  'duration' => '5 min',  'description' => 'Inspirer 5s, expirer 5s. Maintenir pendant 5 minutes (30 cycles). Observer la différence avant/après sur l\'état émotionnel.'],
                ['type' => 'pratique', 'title' => 'Souffle carré — 4-4-4-4',              'duration' => '5 min',  'description' => 'Inspirer 4s · Retenir 4s · Expirer 4s · Retenir 4s. Technique des forces spéciales (Box Breathing). Idéal pour le stress intense.'],
                ['type' => 'pratique', 'title' => 'Souffle apaisant — 4-7-8',             'duration' => '5 min',  'description' => 'Inspirer 4s · Retenir 7s · Expirer 8s. Technique du Dr Andrew Weil. Active le système parasympathique en 4 cycles.'],
                ['type' => 'reflexion','title' => 'Journal du souffle — 7 jours',         'duration' => '7 j',    'description' => 'Pratiquer la cohérence cardiaque 5 minutes chaque matin pendant 7 jours. Noter chaque jour : état avant / état après / une observation.'],
            ],
            'conclusion' => 'Infiniment + à l\'écoute de votre souffle intérieur.',
        ],
        '05-je-decouvre-ma-mission' => [
            'intro_text' => "Il existe une question que peu de gens se posent vraiment.\n\nPas : qu'est-ce que je veux faire ?\nMais : **pourquoi je suis là ?**\n\nVotre mission n'est pas dans un diplôme. Elle n'est pas dans un titre. Elle est dans l'intersection de trois choses : ce que vous avez traversé... ce qui vous vient naturellement... et ce dont le monde a besoin.",
            'description' => 'Trouver l\'intersection entre votre vécu, vos dons naturels et le besoin du monde. Le concept d\'Ikigaï appliqué à la pratique.',
            'activities' => [
                ['type' => 'lecture',  'title' => 'L\'Ikigaï et la raison d\'être',       'duration' => '15 min',
                 'description' => 'Le concept japonais d\'Ikigaï : ce que vous aimez / ce pour quoi vous êtes fait(e) / ce dont le monde a besoin / ce pour quoi vous pouvez être payé(e). Leur intersection est votre mission.',
                 'source'      => 'Sources : Héctor García & Francesc Miralles — Ikigai (2016) · Dan Buettner — The Blue Zones (2008) · Victor Frankl — Man\'s Search for Meaning (1946)',
                 'content'     => '<h3>生き甲斐 — Ce qui vaut la peine d\'être vécu</h3>
<p>Le mot japonais <em>Ikigaï</em> (生き甲斐) se traduit littéralement par <strong>« ce qui vaut la peine d\'être vécu »</strong>. Ce n\'est pas un concept philosophique abstrait. C\'est une pratique quotidienne. Dans les villages d\'Okinawa — île japonaise avec la plus haute concentration de centenaires au monde — les habitants ne prennent jamais leur retraite. Pas parce qu\'ils ne peuvent pas. Mais parce qu\'ils ont trouvé leur Ikigaï.</p>

<h3>Les quatre cercles qui se croisent</h3>
<p>L\'Ikigaï se trouve à l\'intersection de quatre dimensions :</p>
<ul>
<li><strong>Ce que vous aimez</strong> — vos passions profondes, ce qui vous fait perdre la notion du temps</li>
<li><strong>Ce pour quoi vous êtes fait(e)</strong> — vos compétences naturelles, ce qui vient facilement à vous</li>
<li><strong>Ce dont le monde a besoin</strong> — les problèmes que vous pouvez résoudre, les douleurs que vous comprenez</li>
<li><strong>Ce pour quoi vous pouvez être payé(e)</strong> — la valeur que vous pouvez créer et échanger</li>
</ul>
<p>Quand deux cercles se croisent sans les deux autres, quelque chose manque :</p>
<ul>
<li>Aimer + être doué — sans besoin du monde ni rémunération = <em>passion sans utilité</em></li>
<li>Être doué + payé — sans amour ni besoin du monde = <em>confort sans âme</em></li>
<li>Besoin du monde + payé — sans amour ni talent = <em>épuisement</em></li>
</ul>
<p>Mais quand les quatre cercles se croisent ? C\'est là que votre mission prend sa vraie forme.</p>
<blockquote>« La plus grande tragédie n\'est pas de ne pas avoir réalisé son Ikigaï. C\'est de ne jamais avoir pris le temps de le chercher. » — Héctor García</blockquote>

<h3>Votre vécu est votre matière première</h3>
<p>La clé que peu de gens voient au début : <strong>ce que vous avez traversé fait partie de votre Ikigaï</strong>. Ce qui vous a coûté le plus cher est souvent ce que vous comprenez le mieux — et donc ce que vous pouvez transmettre le plus puissamment.</p>
<p>Victor Frankl, psychiatre survivant d\'Auschwitz, l\'a formulé ainsi : <em>« Celui qui a un pourquoi peut supporter presque n\'importe quel comment. »</em> Votre mission n\'est pas dans un diplôme. Elle est dans votre histoire — et dans ce que vous en faites.</p>

<h3>Une mission n\'est pas figée</h3>
<p>L\'Ikigaï n\'est pas une destination. C\'est une boussole. Elle peut évoluer. Ce qui compte, c\'est d\'avoir une direction assez claire pour savoir chaque matin <em>pourquoi vous vous levez</em> — et assez souple pour s\'ajuster en marchant.</p>'],
                ['type' => 'exercice', 'title' => 'Votre carte de mission',                'duration' => '30 min', 'description' => 'Dessiner les 4 cercles de l\'Ikigaï. Remplir chaque cercle honnêtement. Observer les intersections. La mission n\'a pas besoin d\'être parfaite — elle se révèle en marchant.'],
                ['type' => 'pratique', 'title' => 'Pause Souffle de clarté',              'duration' => '7 min',  'description' => '5 cycles 5-5-5. Puis poser la question intérieure : "Ce que j\'ai traversé peut servir à..." Laisser venir les réponses sans les forcer.'],
                ['type' => 'ecriture', 'title' => 'Ma phrase de mission',                 'duration' => '20 min', 'description' => 'Compléter : "Ma présence dans la vie des autres permet à [qui] de [faire quoi] pour [quel résultat]." Écrire 3 versions. Garder celle qui vous émeut.'],
            ],
            'conclusion' => 'Infiniment + proche de votre raison d\'être.',
        ],
        '07-je-transmets-le-rituel' => [
            'intro_text' => "Vous avez parcouru un chemin.\n\nVous vous êtes rencontré(e). Vous avez reconnu vos blessures. Vous avez décrit votre bonheur. Vous avez écouté votre souffle. Vous avez touché votre mission.\n\nMaintenant, il est temps de **transmettre**.\n\nParce que ce que vous avez vécu ici — d'autres personnes en ont besoin.\n\nLe Rituel Pause Souffle que vous allez guider n'est pas une technique. C'est une **présence**.",
            'description' => 'Intégrer tous les outils et apprendre à guider une séance complète. De praticant(e) à Praticien(ne) certifié(e).',
            'activities' => [
                ['type' => 'lecture',  'title' => 'L\'éthique du praticien',              'duration' => '15 min',
                 'description' => 'Cadre déontologique : confidentialité, limites de la pratique, orientation vers les professionnels de santé. Ce que le Rituel Pause Souffle est — et ce qu\'il n\'est pas.',
                 'source'      => 'Sources : Code de déontologie des praticiens en bien-être (FFMBE) · Dr Christophe Massin — Éthique en pratique (2019) · International Coach Federation — Code of Ethics',
                 'content'     => '<h3>Guider est un acte de responsabilité</h3>
<p>Quand vous guidez une séance Pause Souffle, vous entrez dans l\'espace intérieur de quelqu\'un. Cet espace est <strong>fragile et précieux</strong>. L\'éthique du praticien n\'est pas une formalité administrative — c\'est la colonne vertébrale de votre pratique. Sans elle, vous pourriez involontairement blesser là où vous voulez aider.</p>

<h3>Ce que le Rituel Pause Souffle est</h3>
<ul>
<li>Une pratique de <strong>bien-être et de régulation du système nerveux</strong></li>
<li>Un espace de <strong>douceur, de présence et de ralentissement</strong></li>
<li>Un outil de <strong>prévention du burn-out et de reconnexion à soi</strong></li>
<li>Un accompagnement <strong>complémentaire</strong> à tout suivi médical ou psychologique</li>
</ul>

<h3>Ce que le Rituel Pause Souffle n\'est pas</h3>
<ul>
<li><strong>Pas une thérapie</strong> — vous n\'êtes pas thérapeute, ni psychologue, ni médecin</li>
<li><strong>Pas un diagnostic</strong> — vous ne posez pas de diagnostic sur l\'état de quelqu\'un</li>
<li><strong>Pas un traitement</strong> — vous ne remplacez pas un suivi psychiatrique ou médical</li>
<li><strong>Pas un espace de conseil personnel</strong> — vous n\'orientez pas les décisions de vie de quelqu\'un</li>
</ul>
<blockquote>« La première responsabilité d\'un praticien est de ne pas nuire — et d\'avoir la clarté de savoir quand orienter vers quelqu\'un d\'autre. » — Code de déontologie ICF</blockquote>

<h3>Les quatre piliers déontologiques</h3>
<p><strong>1. Confidentialité absolue</strong> — Ce qui se passe dans une séance reste entre vous et la personne. Aucun partage, aucune mention, même anonyme, sans consentement explicite.</p>
<p><strong>2. Limites claires</strong> — Si une personne traverse une crise psychologique, un deuil récent, un épisode dépressif sévère ou une addiction active : orientez vers un professionnel de santé. Ce n\'est pas esquiver — c\'est protéger.</p>
<p><strong>3. Non-jugement constant</strong> — Votre rôle est d\'accueillir et de guider, jamais d\'évaluer ou de corriger la vie de quelqu\'un.</p>
<p><strong>4. Consentement éclairé</strong> — Avant chaque séance, expliquez clairement ce que vous proposez, ce que vous ne proposez pas, et donnez la liberté de s\'arrêter à tout moment.</p>

<h3>La phrase à garder</h3>
<p>Si jamais vous doutez dans une situation : <em>« Mon rôle est de créer un espace sécurisé pour que cette personne rencontre son propre calme intérieur. Je ne guéris pas — j\'accompagne. »</em></p>
<p>C\'est depuis cette posture — humble, présente et précise — que la transmission devient réellement puissante.</p>'],
                ['type' => 'pratique', 'title' => 'Protocole séance 30 minutes',          'duration' => '30 min', 'description' => 'Structure complète d\'une séance guidée : accueil (5 min) · scan corporel (5 min) · pratique respiratoire principale (15 min) · intégration et clôture (5 min). Pratiquer sur soi-même d\'abord.'],
                ['type' => 'pratique', 'title' => 'Protocole séance 60 minutes',          'duration' => '60 min', 'description' => 'Version étendue avec approfondissement : accueil · scan · exercice d\'ancrage · cohérence cardiaque · visualisation guidée · journal rapide · clôture.'],
                ['type' => 'exercice', 'title' => 'Séance témoin — guider quelqu\'un',   'duration' => '45 min', 'description' => 'Guider une première séance complète avec un proche volontaire. Observer, puis noter : ce qui s\'est bien passé, ce qui peut s\'améliorer, ce que vous avez ressenti en transmettant.'],
                ['type' => 'reflexion','title' => 'Ma déclaration de praticien(ne)',     'duration' => '15 min', 'description' => 'Écrire en une page : qui vous étiez avant, ce que cette formation a transformé, et comment vous comptez transmettre le Rituel Pause Souffle.'],
            ],
            'conclusion' => 'J\'ai couru très longtemps. J\'ai tout arrêté. Et c\'est là que j\'ai tout trouvé — et infiniment plus. ∞+',
        ],
    ];

    private array $contentEn = [
        '00-comprendre-le-corps' => [
            'title_en'       => 'Understanding the Body — Anatomy & Physiology',
            'description_en' => 'Three parables to understand the human body: the house, the tree and the orchestra. The anatomical foundations of the Pause Souffle method.',
            'intro_text_en'  => "Before studying anatomy, pause for a moment.\n\nThe body you carry right now — you have inhabited it since birth. And yet, it may still be partly unknown to you.\n\nThis module does not begin with diagrams or Latin terms.\nIt begins with **three images** — simple, obvious, understood by anyone in a few seconds.\n\nBecause to deeply understand the body, you must first **see** it differently.",
            'activities_en'  => [
                [
                    'type'        => 'lecture',
                    'title'       => '🏠 The Body — A Living House',
                    'duration'    => '8 min',
                    'description' => 'The body\'s structure explained through the universal image of a house: framework, hinges, mechanisms, air circulation and electrical network.',
                    'content'     => '<h3>Imagine that your body is a living house.</h3>
<p>Not an ordinary house — a house that thinks, breathes, adapts at every moment. An inhabited house.</p>

<h3>The framework — the skeleton</h3>
<p>Every house rests on a framework. Without it, the walls collapse, the roof gives way, everything sags.<br>
In your body, this is the <strong>skeleton</strong>. It provides the structure, the shape, the architecture.<br>
The <strong>spine</strong> is the central beam: the pillar around which everything else is organised.</p>
<blockquote>Close your eyes for a moment. Feel your back against the chair or the floor. That is your framework. It has been there since the first day.</blockquote>

<h3>The hinges — the joints</h3>
<p>A door without hinges can no longer open. A window without a pivot stays shut.<br>
In your body, these are the <strong>joints</strong> — knee, elbow, shoulder, hip, ankle.<br>
They allow opening, closing, pivoting, rotation. Without them, the body would be rigid — a solid wall.</p>

<h3>The mechanisms — the muscles</h3>
<p>A modern house has mechanisms that allow movement: automatic doors, shutters, elevators. They don\'t push — they pull, they activate.<br>
In your body, these are the <strong>muscles</strong>. They pull on bones, activate joints, create every gesture.<br>
<em>A muscle never pushes — it pulls. Always.</em></p>

<h3>The circulating air — breathing</h3>
<p>A healthy house has circulating air. Not wind — air. Windows opened in the morning, an atmosphere that renews itself.<br>
When air circulates well: the house feels light, alive.<br>
When air is blocked: the atmosphere becomes heavy, suffocating.<br>
In your body, this is <strong>breathing</strong>. The 5-5-5 Pause Souffle is the act of consciously opening the windows of your house.</p>

<h3>The electrical network — the nervous system</h3>
<p>A house without electricity is blind. Electricity connects every room, turns on the lights, powers every device.<br>
In your body, this is the <strong>nervous system</strong>. It links the brain to every muscle, every organ, every millimetre of skin — in milliseconds.</p>

<div style="background:rgba(201,168,76,.08);border:1px solid rgba(201,168,76,.2);border-radius:10px;padding:1rem 1.25rem;margin:.75rem 0;">
<strong style="color:#c9a84c;">Your living house in 5 elements:</strong><br>
The <strong>skeleton</strong> = the framework &nbsp;·&nbsp; The <strong>joints</strong> = the hinges<br>
The <strong>muscles</strong> = the mechanisms &nbsp;·&nbsp; <strong>Breathing</strong> = the circulating air<br>
The <strong>nervous system</strong> = the electrical network
</div>',
                ],
                [
                    'type'        => 'lecture',
                    'title'       => '🌳 The Body — A Living Tree',
                    'duration'    => '8 min',
                    'description' => 'The body\'s vitality revealed through the image of a tree: trunk, branches, roots, bark, sap, leaves and invisible network.',
                    'content'     => '<h3>Now imagine that your body is a living tree.</h3>
<p>Not a tree frozen in a painting — a tree fully alive. Growing, breathing, drawing up and nourishing.<br>
If the house spoke to you of <em>structure</em>, the tree speaks to you of <em>life</em>.</p>

<h3>The trunk — the spine</h3>
<p>Every tree organises itself around its trunk. Vertical, central, the link between earth and sky.<br>
In your body, this is the <strong>spine</strong>. It connects the pelvis to the skull and protects the spinal cord — the central cable of the nervous system.<br>
The health of your spine conditions the health of the whole.</p>
<blockquote>Feel your spine now. Gently release your back. Breathe toward your centre.</blockquote>

<h3>The branches and roots — arms and legs</h3>
<p>The <strong>arms</strong> are the branches: they extend, rise, open toward the world. They explore, touch, create.<br>
The <strong>legs</strong> are the roots: they anchor, stabilise, absorb shocks. The strength of a tree is judged by the depth of its roots.<br>
<em>Feel your feet right now. That is your anchor in the earth.</em></p>

<h3>The living bark — the muscles</h3>
<p>The bark of a tree is alive. It wraps, protects, gives the trunk and branches their shape. It also carries the traces of time — seasons, scars, growth.<br>
In your body, these are the <strong>muscles</strong>. They envelop bones, protect organs, give the body its visible form. And like bark: they keep the memory of accumulated tensions.</p>

<h3>The sap — the blood</h3>
<p>In a tree, sap circulates continuously, from soil to the highest leaves. It carries water, minerals, energy. Without sap: the tree withers.<br>
In your body, this is the <strong>blood</strong> — 100,000 km of vessels, equivalent to 2.5 times around the Earth.<br>
Movement and breathing are the pumps of your sap.</p>

<h3>The leaves — the lungs</h3>
<p>A tree\'s leaves are the places of exchange with the outside world. They capture light, absorb CO₂, release oxygen.<br>
In your body, these are the <strong>lungs</strong>. With each inhale, they capture oxygen from the world. With each exhale, they release what is no longer needed.<br>
Every breath is an exchange between you and the world.</p>

<h3>The invisible network — the nerves</h3>
<p>Beneath a tree\'s bark runs an invisible network that transmits information throughout the plant. This is how a tree responds to light, heat, and threat.<br>
In your body, these are the <strong>nerves</strong> — transmission speed: up to 120 m/s.<br>
Sensation, movement, reaction: everything passes through this network.</p>

<div style="background:rgba(201,168,76,.08);border:1px solid rgba(201,168,76,.2);border-radius:10px;padding:1rem 1.25rem;margin:.75rem 0;">
<strong style="color:#c9a84c;">Your living tree in 6 elements:</strong><br>
The <strong>spine</strong> = the trunk &nbsp;·&nbsp; The <strong>arms</strong> = the branches &nbsp;·&nbsp; The <strong>legs</strong> = the roots<br>
The <strong>muscles</strong> = the living bark &nbsp;·&nbsp; The <strong>blood</strong> = the sap<br>
The <strong>lungs</strong> = the leaves &nbsp;·&nbsp; The <strong>nerves</strong> = the invisible network
</div>',
                ],
                [
                    'type'        => 'lecture',
                    'title'       => '🎼 The Body — A Living Orchestra',
                    'duration'    => '8 min',
                    'description' => 'The body\'s coordination revealed through the image of the orchestra: conductor, score, instruments, stage and rhythm.',
                    'content'     => '<h3>Third image — the most powerful for understanding movement.</h3>
<p>Imagine that your body is a great living orchestra.<br>
If the house spoke to you of <em>structure</em>, and the tree of <em>life</em> — the orchestra speaks to you of <em>intelligence</em>.<br>
For a body that moves well is not only solid and alive. It is <strong>coordinated</strong>.</p>

<h3>The conductor — the brain</h3>
<p>In an orchestra, the conductor leads without playing an instrument. They listen to the whole, anticipate, correct, set the tempo. Without them, each musician would play alone — noise, not music.<br>
In your body, this is the <strong>brain</strong>. Continuously, it receives thousands of signals, makes decisions, sends commands. Balance, posture, movement, pain, emotion — everything passes through it.</p>

<h3>The score — the nerves</h3>
<p>Musicians don\'t play at random — they have precise, coordinated scores.<br>
In your body, these are the <strong>nerves</strong>. They transmit the brain\'s instructions: <em>Contract. Release. Move. Stop.</em><br>
And in the opposite direction: they carry sensations back to the brain so it can adjust in real time.</p>

<h3>The instruments — the muscles</h3>
<p>In an orchestra, each instrument has its own timbre, its specific role in the harmony.<br>
In your body, these are the <strong>muscles</strong>:</p>
<ul>
<li>Some are <strong>powerful</strong>, like the brass — the gluteus maximus, the quadriceps.</li>
<li>Others are <strong>precise</strong>, like violins — the hand muscles, the eye muscles.</li>
<li>Others still are <strong>stabilisers</strong>, silent, like the bass — the deep back muscles, the pelvic floor.</li>
</ul>
<p>Fluid movement is when all the instruments play together, at the right moment.</p>

<h3>The stage — the skeleton</h3>
<p>Musicians need a solid stage. Without structure, the orchestra cannot play.<br>
In your body, this is the <strong>skeleton</strong>. It provides the anchor points that muscles use to create movement.</p>

<h3>The rhythm — breathing</h3>
<p>In all music, there is a beat — a pulse that gives life to the whole.<br>
In your body, this is <strong>breathing</strong>.<br>
When it is slow and deep: the orchestra plays gently, the whole body settles.<br>
When it is fast and short: everything accelerates, tension rises.<br>
<strong>What you do with your breath, you do with your entire body.</strong><br>
The 5-5-5 Pause Souffle is the act of consciously picking up the baton.</p>

<div style="background:rgba(201,168,76,.08);border:1px solid rgba(201,168,76,.2);border-radius:10px;padding:1rem 1.25rem;margin:.75rem 0;">
<strong style="color:#c9a84c;">Your living orchestra in 5 elements:</strong><br>
The <strong>brain</strong> = the conductor &nbsp;·&nbsp; The <strong>nerves</strong> = the score<br>
The <strong>muscles</strong> = the instruments &nbsp;·&nbsp; The <strong>skeleton</strong> = the stage<br>
<strong>Breathing</strong> = the rhythm that guides everything
</div>',
                ],
                [
                    'type'        => 'lecture',
                    'title'       => '🗺 The Body\'s Geography — The 12 Territories',
                    'duration'    => '20 min',
                    'description' => 'Explore the body territory by territory: bones, muscles, joints and function of each region. With a 30-second sensory experience for each zone.',
                    'content'     => '<h3>The body has a geography.</h3>
<p>Like a continent, it is organised into <strong>territories</strong> — each with its structures, its functions, its own language. Exploring this geography is not memorising a list. It is learning to <em>travel within your own body</em>.</p>

<div style="background:rgba(201,168,76,.06);border-left:3px solid #c9a84c;padding:.75rem 1rem;margin:.75rem 0;border-radius:0 8px 8px 0;">
<strong style="color:#c9a84c;">How to use this:</strong> For each territory, read — then close your eyes for 30 seconds and <em>feel</em> that zone in your body. This is how knowledge becomes embodied.
</div>

<h3>1 — The Head</h3>
<p><strong>Cranial bones:</strong> frontal, 2 parietals, 2 temporals, occipital, sphenoid, ethmoid <em>(8 bones).</em><br>
<strong>Facial bones:</strong> 2 maxillae, mandible, 2 zygomatics, 2 nasals and their neighbours <em>(14 bones).</em><br>
<strong>Key muscles:</strong> masseter (chewing), temporalis (jaw closing), orbicularis (eyes and mouth).<br>
<strong>Functions:</strong> sensory perception, chewing, speech, expression.</p>
<blockquote>✋ Experience: release your jaw. Let your teeth separate slightly. Breathe. The masseter is often the first muscle to accumulate the day\'s stress.</blockquote>

<h3>2 — The Neck</h3>
<p><strong>Bones:</strong> cervical vertebrae C1 to C7 — C1 (atlas) supports the head, C2 (axis) allows rotation.<br>
<strong>Superficial muscles:</strong> sternocleidomastoid (SCM), scalenes ×3, upper trapezius.<br>
<strong>Deep muscles:</strong> longus colli, longus capitis — the silent stabilisers.<br>
<strong>Functions:</strong> head mobility in 3 planes, passage of carotid arteries and the vagus nerve.</p>
<blockquote>✋ Experience: very slowly tilt your head to the right. Feel the stretch of the left SCM. Breathe for 5 seconds. Return. The vagus nerve passes here — each breath calms it.</blockquote>

<h3>3 — Shoulders and Arms</h3>
<p><strong>Bones:</strong> clavicle, scapula (shoulder blade), humerus.<br>
<strong>Rotator cuff:</strong> supraspinatus, infraspinatus, teres minor, subscapularis — 4 muscles that stabilise the shoulder.<br>
<strong>Arm:</strong> biceps brachii, brachialis, triceps brachii, coracobrachialis.<br>
<strong>Functions:</strong> elevation, rotation, gripping, physical expression.</p>
<blockquote>✋ Experience: make 3 large slow circles with your shoulders backward. Feel the scapula glide over the ribcage. That is the rotator cuff working.</blockquote>

<h3>4 — Forearm and Hand</h3>
<p><strong>Forearm:</strong> radius and ulna. Muscles: brachioradialis, wrist flexors, finger extensors.<br>
<strong>The hand — 27 bones in 3 levels:</strong></p>
<ul>
<li><strong>Carpus (wrist):</strong> 8 bones — scaphoid, lunate, triquetrum, pisiform, trapezium, trapezoid, capitate, hamate.</li>
<li><strong>Metacarpus (palm):</strong> 5 bones — one per finger.</li>
<li><strong>Phalanges (fingers):</strong> 14 bones — 2 for the thumb, 3 for each other finger.</li>
</ul>
<blockquote>✋ Experience: open your hands wide. Spread all fingers. Then very slowly close, phalanx by phalanx, starting from the tips. Feel the 27 bones organising. The hands are the map of your peripheral nervous system.</blockquote>

<h3>5 — Thorax</h3>
<p><strong>Bones:</strong> sternum, 12 pairs of ribs, thoracic vertebrae T1–T12.<br>
<strong>Muscles:</strong> pectoralis major, pectoralis minor, intercostals (between the ribs), <strong>diaphragm</strong> — the central muscle of breathing.<br>
<strong>Organs:</strong> heart, lungs.<br>
<strong>Functions:</strong> breathing, circulation, protection of vital organs.</p>
<blockquote>✋ Experience: place your hands on the sides of your ribcage. Inhale slowly. Feel the ribs expand <em>laterally</em> — that is the diaphragm descending and pushing the abdominal contents downward, forcing the ribs to open. The 5-5-5 Pause Souffle mobilises this mechanism with every cycle.</blockquote>

<h3>6 — Abdomen</h3>
<p><strong>Muscles in layers:</strong></p>
<ul>
<li>Rectus abdominis — the outer layer, visible.</li>
<li>External oblique — diagonal direction downward.</li>
<li>Internal oblique — diagonal direction upward (crossing with the external).</li>
<li><strong>Transversus abdominis</strong> — the deep belt, invisible, fundamental for lumbar stability.</li>
</ul>
<p><strong>Organs:</strong> stomach, intestines, liver, pancreas, spleen.<br>
<strong>Functions:</strong> trunk stabilisation, digestion, visceral protection.</p>
<blockquote>✋ Experience: exhale slowly, gently drawing the belly in. Hold for 5 seconds. That is the transversus working. This muscle is activated with every Pause Souffle 5-5-5 exhale.</blockquote>

<h3>7 — Back</h3>
<p><strong>Superficial muscles:</strong> trapezius (3 portions), latissimus dorsi, rhomboids major and minor.<br>
<strong>Deep muscles — the spinal erectors:</strong> iliocostalis, longissimus, spinalis.<br>
<strong>Very deep muscles:</strong> multifidus — the vertebra-by-vertebra stabilisers.<br>
<strong>Functions:</strong> spinal extension, protection of the spinal cord, posture.</p>
<blockquote>✋ Experience: sit at the edge of a chair. Let the back round completely (flexion). Then, slowly, gently arch the lower back (extension). Repeat 3 times. That is the erectors and multifidus coordinating this movement.</blockquote>

<h3>8 — Pelvis</h3>
<p><strong>Bones:</strong> ilium (the wing), ischium (the seat), pubis (front). Together they form the hip bone × 2 + sacrum = the pelvis.<br>
<strong>Muscles:</strong> psoas and iliacus (iliopsoas = hip flexor), gluteus maximus, gluteus medius and minimus, piriformis.<br>
<strong>Joints:</strong> sacroiliac joints (force transmission between spine and legs).<br>
<strong>Functions:</strong> fundamental stability, force transmission floor-to-spine, anchoring the centre of gravity.</p>
<blockquote>✋ Experience: standing, place one hand on your lower abdomen, the other on your lower back. Breathe deeply into the belly. Feel the pelvis move slightly. The psoas attaches to the lumbar vertebrae and femur — it is the link between trunk and legs.</blockquote>

<h3>9 — Thighs</h3>
<p><strong>Bone:</strong> femur — the longest and strongest bone in the body.<br>
<strong>Quadriceps (front):</strong> rectus femoris, vastus lateralis, vastus medialis, vastus intermedius — knee extension.<br>
<strong>Hamstrings (back):</strong> biceps femoris, semitendinosus, semimembranosus — knee flexion.<br>
<strong>Adductors (inner):</strong> pectineus, adductor longus, adductor brevis, adductor magnus, gracilis.<br>
<strong>Functions:</strong> walking, running, knee stability, postural balance.</p>
<blockquote>✋ Experience: cross your legs. Place your hand on the lower thigh. Feel the firmness of the quadriceps. Now sit well on your ischial tuberosities. Feel the hamstrings gently stretching beneath the thigh.</blockquote>

<h3>10 — Leg</h3>
<p><strong>Bones:</strong> tibia (load-bearing), fibula (stabiliser).<br>
<strong>Muscles:</strong> tibialis anterior (lifts the foot), gastrocnemius and soleus (the calf = propulsion), fibularis longus and brevis (ankle stabilisation).<br>
<strong>Joints:</strong> knee (hinge + rotation), ankle (pivot).<br>
<strong>Functions:</strong> walking propulsion, shock absorption, continuous postural adjustment.</p>

<h3>11 — The Foot — 26 bones in 3 levels</h3>
<ul>
<li><strong>Tarsus (rear):</strong> talus, calcaneus, navicular, cuboid, 3 cuneiforms — 7 bones.</li>
<li><strong>Metatarsus (middle):</strong> 5 metatarsals.</li>
<li><strong>Phalanges (toes):</strong> 14 bones (big toe = 2, others = 3 each).</li>
</ul>
<blockquote>✋ Experience: standing, gently lift your toes. Then place them down one by one, starting with the little toe. Feel the 26 bones organising like a tripod. A stable foot = a stable posture = free breathing. The foundation of everything.</blockquote>

<div style="background:rgba(201,168,76,.08);border:1px solid rgba(201,168,76,.2);border-radius:10px;padding:1rem 1.25rem;margin:1rem 0;">
<strong style="color:#c9a84c;">The skeleton in numbers:</strong><br>
206 bones total · 27 bones in one hand · 26 bones in one foot · 33 vertebrae<br>
<em>The hands and feet alone contain more than half of all the body\'s bones.</em>
</div>',
                ],
                [
                    'type'        => 'lecture',
                    'title'       => '🕸 The Invisible Tissue — Fascia and Muscle Chains',
                    'duration'    => '12 min',
                    'description' => 'The most important discovery in modern anatomy: the fascia, the tissue that connects everything. The 5 major muscle chains (Anatomy Trains) that explain why a tension in the foot travels all the way to the cervical spine.',
                    'source'      => 'Sources: Thomas Myers — Anatomy Trains (2001, 4th ed. 2021) · Robert Schleip — Fascia Research (2012) · Serge Gracovetsky — The Spinal Engine',
                    'content'     => '<h3>The fascia — the suit beneath the skin</h3>
<p>If you could remove all the bones and muscles from the human body while leaving only the fascia... you would still have a perfectly recognisable human silhouette. The fascia <strong>gives the body its shape</strong>.</p>
<p>It is a continuous connective tissue — like a three-dimensional wetsuit — that envelops every muscle, every bone, every organ, every nerve, without ever interrupting. <strong>There is no separation in the body. Everything is connected.</strong></p>

<h3>Why this is revolutionary</h3>
<p>Old anatomy cut the body into separate pieces. Fascia tells us this was a pedagogical illusion.<br>
In reality:</p>
<ul>
<li>Tension in the plantar fascia (under the foot) can <strong>travel all the way to the back of the neck</strong> via the posterior chain.</li>
<li>An abdominal scar can <strong>limit shoulder mobility</strong> via the deep fascia.</li>
<li>Chronic emotional stress <strong>stabilises in the fascia</strong> — which is why the body "holds memory" of trauma.</li>
</ul>
<blockquote>« The body is not an assembly of parts. It is a network of interdependent tensions and compressions. » — Thomas Myers, Anatomy Trains</blockquote>

<h3>The 5 major myofascial chains</h3>
<p>Thomas Myers mapped the major tension pathways that cross the body from head to foot. These are the <strong>motorways of the body</strong>.</p>

<p><strong>1 — The posterior chain</strong> (superficial back line)<br>
From the floor of the feet → calves → hamstrings → spinal erectors → scalp.<br>
<em>Role: hold the body upright against gravity. Typical tension: low back pain, neck tension, plantar fasciitis.</em></p>

<p><strong>2 — The anterior chain</strong> (superficial front line)<br>
Top of the feet → tibialis anterior → quadriceps → rectus abdominis → sternocleidomastoid.<br>
<em>Role: body flexion, visceral protection. Typical tension: forward posture, head projected forward.</em></p>

<p><strong>3 — The lateral chains</strong> (lateral lines)<br>
Fibulars → iliotibial band → obliques → intercostals → lateral neck muscles.<br>
<em>Role: lateral balance, coordination of both sides of the body.</em></p>

<p><strong>4 — The spiral chains</strong> (spiral lines)<br>
They cross the body diagonally, creating rotation movements.<br>
<em>Role: trunk rotation, walking, asymmetric gestures.</em></p>

<p><strong>5 — The deep chains</strong> (deep front lines)<br>
Plantar arch → psoas → diaphragm → pericardium → neck and skull fascia.<br>
<em>This is the line of the deepest structures, directly connected to breathing. <strong>This is where the Pause Souffle acts first.</strong></em></p>

<div style="background:rgba(201,168,76,.08);border:1px solid rgba(201,168,76,.2);border-radius:10px;padding:1rem 1.25rem;margin:.75rem 0;">
<strong style="color:#c9a84c;">The Pause Souffle 5-5-5 and fascia:</strong><br>
With each deep inhale, the diaphragm descends and <strong>pulls on the deep fascial line</strong> — releasing tensions in the psoas, the pericardium, and the cervical fascia.<br>
This is the precise mechanism by which conscious breathing releases tensions that appear to have "nothing to do" with the lungs.
</div>',
                ],
                [
                    'type'        => 'lecture',
                    'title'       => '🏙 The Living City — The 11 Body Systems',
                    'duration'    => '15 min',
                    'description' => 'A mental map of the 11 body systems organised like a living city. Each system has its role, its image and its connection to the Pause Souffle method.',
                    'content'     => '<h3>Now imagine that your body is a living city.</h3>
<p>Not a village — a large organised city, with specialised districts, essential services, communication roads and a central conductor. A city of 37 trillion inhabitants: your cells.</p>

<table style="width:100%;border-collapse:collapse;font-size:0.92em;margin:1rem 0;">
<thead>
<tr style="background:rgba(201,168,76,.15);">
<th style="padding:.6rem .8rem;text-align:left;border-bottom:2px solid rgba(201,168,76,.3);">System</th>
<th style="padding:.6rem .8rem;text-align:left;border-bottom:2px solid rgba(201,168,76,.3);">Image in the city</th>
<th style="padding:.6rem .8rem;text-align:left;border-bottom:2px solid rgba(201,168,76,.3);">Essential role</th>
</tr>
</thead>
<tbody>
<tr><td style="padding:.5rem .8rem;border-bottom:1px solid rgba(255,255,255,.07);">🧱 Cellular</td><td style="padding:.5rem .8rem;border-bottom:1px solid rgba(255,255,255,.07);">The inhabitants</td><td style="padding:.5rem .8rem;border-bottom:1px solid rgba(255,255,255,.07);">Everything begins here — the basis of all life</td></tr>
<tr><td style="padding:.5rem .8rem;border-bottom:1px solid rgba(255,255,255,.07);">🏠 Integumentary (skin)</td><td style="padding:.5rem .8rem;border-bottom:1px solid rgba(255,255,255,.07);">The walls and ramparts</td><td style="padding:.5rem .8rem;border-bottom:1px solid rgba(255,255,255,.07);">Protects, regulates heat, perceives</td></tr>
<tr><td style="padding:.5rem .8rem;border-bottom:1px solid rgba(255,255,255,.07);">🏗 Musculoskeletal</td><td style="padding:.5rem .8rem;border-bottom:1px solid rgba(255,255,255,.07);">The framework + the engines</td><td style="padding:.5rem .8rem;border-bottom:1px solid rgba(255,255,255,.07);">Structure and movement</td></tr>
<tr><td style="padding:.5rem .8rem;border-bottom:1px solid rgba(255,255,255,.07);">⚡ Nervous</td><td style="padding:.5rem .8rem;border-bottom:1px solid rgba(255,255,255,.07);">The electrical network + internet</td><td style="padding:.5rem .8rem;border-bottom:1px solid rgba(255,255,255,.07);">Fast communication, reflexes, thought</td></tr>
<tr><td style="padding:.5rem .8rem;border-bottom:1px solid rgba(255,255,255,.07);">🧪 Endocrine</td><td style="padding:.5rem .8rem;border-bottom:1px solid rgba(255,255,255,.07);">The chemical messengers</td><td style="padding:.5rem .8rem;border-bottom:1px solid rgba(255,255,255,.07);">Slow regulation (hormones)</td></tr>
<tr><td style="padding:.5rem .8rem;border-bottom:1px solid rgba(255,255,255,.07);">❤️ Cardiovascular</td><td style="padding:.5rem .8rem;border-bottom:1px solid rgba(255,255,255,.07);">The roads and central pump</td><td style="padding:.5rem .8rem;border-bottom:1px solid rgba(255,255,255,.07);">Transport — oxygen, nutrients, heat</td></tr>
<tr><td style="padding:.5rem .8rem;border-bottom:1px solid rgba(255,255,255,.07);">🛡 Lymphatic / Immune</td><td style="padding:.5rem .8rem;border-bottom:1px solid rgba(255,255,255,.07);">The cleaning system and the police</td><td style="padding:.5rem .8rem;border-bottom:1px solid rgba(255,255,255,.07);">Defence, filtration, immunity</td></tr>
<tr><td style="padding:.5rem .8rem;border-bottom:1px solid rgba(255,255,255,.07);">🌬 Respiratory</td><td style="padding:.5rem .8rem;border-bottom:1px solid rgba(255,255,255,.07);">The city\'s ventilation</td><td style="padding:.5rem .8rem;border-bottom:1px solid rgba(255,255,255,.07);">Bring in oxygen, expel CO₂</td></tr>
<tr><td style="padding:.5rem .8rem;border-bottom:1px solid rgba(255,255,255,.07);">🍽 Digestive</td><td style="padding:.5rem .8rem;border-bottom:1px solid rgba(255,255,255,.07);">The central kitchen</td><td style="padding:.5rem .8rem;border-bottom:1px solid rgba(255,255,255,.07);">Transform food into energy</td></tr>
<tr><td style="padding:.5rem .8rem;border-bottom:1px solid rgba(255,255,255,.07);">💧 Urinary</td><td style="padding:.5rem .8rem;border-bottom:1px solid rgba(255,255,255,.07);">The filters and treatment plants</td><td style="padding:.5rem .8rem;border-bottom:1px solid rgba(255,255,255,.07);">Eliminate waste, water balance</td></tr>
<tr><td style="padding:.5rem .8rem;">🌱 Reproductive</td><td style="padding:.5rem .8rem;">The workshop of life transmission</td><td style="padding:.5rem .8rem;">Continuation of the species</td></tr>
</tbody>
</table>

<h3>The cell — the miniature house</h3>
<p>Before the systems, there is the cell. Imagine a city made of 37 trillion <strong>small autonomous houses</strong>. Each house produces its own energy (mitochondria), communicates with its neighbours, repairs and reproduces itself. Cells form tissues → tissues form organs → organs form systems.</p>

<h3>The Pause Souffle link — systems that respond immediately</h3>
<p>When you practise the 5-5-5 Pause Souffle, <strong>5 systems respond simultaneously:</strong></p>
<ul>
<li><strong>Respiratory</strong> — the lungs open, the diaphragm descends.</li>
<li><strong>Cardiovascular</strong> — heart rate slows via the vago-vagal reflex.</li>
<li><strong>Nervous</strong> — the parasympathetic system takes over (recovery mode).</li>
<li><strong>Endocrine</strong> — cortisol decreases, oxytocin and serotonin increase.</li>
<li><strong>Fascial</strong> — deep myofascial tensions gradually release.</li>
</ul>
<p><em>Five systems. Five seconds of inhale. One single gesture.</em></p>',
                ],
                [
                    'type'        => 'pratique',
                    'title'       => '🧘 Guided Anatomical Meditations',
                    'duration'    => '25 min',
                    'description' => 'Six short meditations — one per essential system — incorporating the 5-5-5 Pause Souffle. The method that allows you to retain information 5 to 10 times faster by anchoring knowledge in felt sensation.',
                    'content'     => '<h3>Why anatomical meditations work</h3>
<p>The great somatic schools — Feldenkrais, Pilates, Eutonia, Hatha Yoga — share a pedagogical secret: <strong>we learn better what we feel than what we read.</strong><br>
Anatomical meditation simultaneously activates:</p>
<ul>
<li><strong>Visual memory</strong> (the mental image)</li>
<li><strong>Sensory memory</strong> (the sensation in the body)</li>
<li><strong>Emotional memory</strong> (the inner state)</li>
</ul>
<p>Result: what would have taken hours of reading is engraved in a few minutes.</p>
<p>Each meditation below lasts <strong>3 to 4 minutes</strong>. Settle comfortably. Read once. Then close your eyes and live it.</p>

<hr style="border:none;border-top:1px solid rgba(201,168,76,.2);margin:1.5rem 0;">

<h3>🌬 The Respiratory System</h3>
<p>Close your eyes.<br>
Place one hand on your chest, the other on your abdomen.<br>
Take a slow inhale — <em>five seconds</em>.<br>
Imagine your ribcage as a great house opening to the light. Air enters your lungs like a breeze moving through the rooms.<br>
The alveoli — 300 million small sacs — fill with oxygen.<br>
Hold — <em>five seconds</em>. Let that oxygen pass into the blood.<br>
Exhale — <em>five seconds</em>. The body releases what it no longer needs.<br>
Complete three full cycles.<br>
<em>You have just lived the respiratory system.</em></p>

<hr style="border:none;border-top:1px solid rgba(201,168,76,.15);margin:1.5rem 0;">

<h3>❤️ The Cardiovascular System</h3>
<p>Place one hand on your heart.<br>
Feel the beat.<br>
Imagine your heart as a central pump at the centre of a city.<br>
With each beat, it sends blood through <strong>100,000 km of vessels</strong> — equivalent to 2.5 times around the Earth.<br>
The arteries leave the heart carrying oxygen — vivid red.<br>
The veins return to the heart carrying waste — dark.<br>
The capillaries — thinner than a hair — nourish every cell.<br>
Inhale 5 s. → Hold 5 s. → Exhale 5 s.<br>
<em>Feel the heart calm with each exhale.</em></p>

<hr style="border:none;border-top:1px solid rgba(201,168,76,.15);margin:1.5rem 0;">

<h3>⚡ The Nervous System</h3>
<p>Imagine your brain as a luminous control centre.<br>
From this centre radiate millions of glowing threads. The nerves.<br>
They travel through every part of your body — to the last phalanges of your toes.<br>
They transmit at 120 m/s: movements, sensations, perceptions.<br>
Now, with the Pause Souffle:<br>
Inhale 5 s. — the threads illuminate.<br>
Hold 5 s. — the control centre receives.<br>
Exhale 5 s. — imagine all the threads calming, gently dimming.<br>
The parasympathetic nervous system takes over.<br>
<em>You have just switched from "alert" mode to "recovery" mode.</em></p>

<hr style="border:none;border-top:1px solid rgba(201,168,76,.15);margin:1.5rem 0;">

<h3>🍽 The Digestive System</h3>
<p>Place both hands on your abdomen.<br>
Feel the warmth beneath your palms.<br>
Imagine that your belly is a central kitchen — always active, transforming, distributing, creating energy.<br>
9 metres of digestive tube, from mouth to anus.<br>
Your "second brain" — 500 million enteric neurons.<br>
Inhale 5 s. — the breath descends to the belly.<br>
Hold 5 s. — let the warmth of your hands warm this space.<br>
Exhale 5 s. — release every abdominal tension.<br>
<em>When breathing is calm, digestion optimises — this is physiology.</em></p>

<hr style="border:none;border-top:1px solid rgba(201,168,76,.15);margin:1.5rem 0;">

<h3>🛡 The Immune System</h3>
<p>Imagine a network of silent guardians travelling through your body without ever stopping.<br>
Your 600 lymph nodes filter the lymph — 2 to 4 litres per day.<br>
Your white blood cells — leucocytes — patrol, identify, neutralise.<br>
This system works best when you are calm and rested.<br>
Inhale 5 s. — the lymph circulates.<br>
Hold 5 s. — the guardians are at their posts.<br>
Exhale 5 s. — the body defends itself in silence.<br>
<em>Every Pause Souffle supports your immunity.</em></p>

<hr style="border:none;border-top:1px solid rgba(201,168,76,.15);margin:1.5rem 0;">

<h3>🕸 The Fascial System</h3>
<p>Now imagine a wetsuit that envelops every muscle, every bone, every organ of your body — without ever interrupting.<br>
That is the fascia. The tissue of unity.<br>
Every click of your jaw, every tension in your shoulders, every pain in your foot — it feels all of them.<br>
Now, inhale deeply — <em>five seconds</em>.<br>
The diaphragm descends. It pulls on the deep fascial line. The psoas releases slightly. The cervical fascia settles.<br>
Hold — <em>five seconds</em>.<br>
Exhale — <em>five seconds</em>. Imagine the suit relaxing by one millimetre throughout the entire body.<br>
<em>This is what actually happens. With every Pause Souffle.</em></p>',
                ],
                [
                    'type'        => 'reflexion',
                    'title'       => '✨ Synthesis — The Complete Body Map',
                    'duration'    => '10 min',
                    'description' => 'Integrate the 3 parables, the 12 territories, the fascia, the 11 systems and the meditations. Identify your territory and system most present right now.',
                    'content'     => '<h3>You now have the complete map.</h3>
<p>Look at what you have just learned — not by memorising, but by <em>inhabiting</em>:</p>

<table style="width:100%;border-collapse:collapse;font-size:0.9em;margin:1rem 0;">
<tr style="background:rgba(201,168,76,.12);">
<td style="padding:.6rem .8rem;font-weight:700;">Layer 1</td>
<td style="padding:.6rem .8rem;">🏠🌳🎼 The 3 parables</td>
<td style="padding:.6rem .8rem;color:rgba(255,255,255,.7);">The mental framework</td>
</tr>
<tr>
<td style="padding:.6rem .8rem;font-weight:700;">Layer 2</td>
<td style="padding:.6rem .8rem;">🗺 The 12 territories</td>
<td style="padding:.6rem .8rem;color:rgba(255,255,255,.7);">The geography</td>
</tr>
<tr style="background:rgba(255,255,255,.03);">
<td style="padding:.6rem .8rem;font-weight:700;">Layer 3</td>
<td style="padding:.6rem .8rem;">🕸 Fascia + chains</td>
<td style="padding:.6rem .8rem;color:rgba(255,255,255,.7);">The connections</td>
</tr>
<tr>
<td style="padding:.6rem .8rem;font-weight:700;">Layer 4</td>
<td style="padding:.6rem .8rem;">🏙 The 11 systems</td>
<td style="padding:.6rem .8rem;color:rgba(255,255,255,.7);">The body\'s intelligence</td>
</tr>
<tr style="background:rgba(255,255,255,.03);">
<td style="padding:.6rem .8rem;font-weight:700;">Layer 5</td>
<td style="padding:.6rem .8rem;">🧘 6 meditations</td>
<td style="padding:.6rem .8rem;color:rgba(255,255,255,.7);">Sensory anchoring</td>
</tr>
</table>

<h3>The 3 clinical reading frameworks</h3>
<p>When you accompany someone:</p>
<ul>
<li><strong>When a client is experiencing physical pain</strong> → think about the 12 territories. Which territory is under tension? Which myofascial chain is involved?</li>
<li><strong>When a client lacks energy or vitality</strong> → think about the 11 systems. Which one is under-nourished? Breathing, digestion, immunity?</li>
<li><strong>When a client cannot relax</strong> → think about the 3 parables. Is their house poorly structured? Does their tree lack sap? Is their orchestra in cacophony?</li>
</ul>

<h3>Reflection questions</h3>
<ol>
<li>Which territory of your body is most present right now — and what is it telling you?</li>
<li>Among the 11 systems, which seems most "silent" or neglected in your daily life?</li>
<li>Which anatomical meditation created the strongest sensation for you?</li>
<li>Do <strong>3 cycles of 5-5-5 Pause Souffle</strong> letting your attention travel through the body from feet to head.</li>
</ol>

<div style="background:rgba(201,168,76,.08);border:1px solid rgba(201,168,76,.2);border-radius:10px;padding:1rem 1.25rem;margin:.75rem 0;">
<strong style="color:#c9a84c;">To remember in one sentence:</strong><br>
Your body is a living house, a living tree, a living orchestra —<br>
organised into 12 territories, connected by fascia, animated by 11 systems.<br>
<em>And all of it breathes. All of it listens. All of it responds to the Pause Souffle.</em>
</div>',
                ],
            ],
        ],
        '01-je-me-rencontre' => [
            'title_en'       => 'I Meet Myself',
            'description_en' => 'The first step toward yourself. Understanding why you run, and discovering who you are when you stop.',
            'intro_text_en'  => "There is something strange about our time: we are constantly in motion, constantly connected, constantly busy — and yet, something inside us remains unanswered.\n\nIt is not a lack of willpower. It is not a lack of hard work.\nIt is the absence of one simple, almost forgotten thing: **meeting yourself.**\n\nThis module does not ask you to change. It first asks you to **see** — honestly, without defense, without judgment.",
            'activities_en'  => [
                ['type' => 'lecture',  'title' => 'The science of running',             'duration' => '10 min',
                 'description' => 'The autonomic nervous system: sympathetic vs. parasympathetic. Why the body burns out, and how 5 minutes of conscious breathing changes everything.',
                 'source'      => 'Sources: Dr Robert Sapolsky — Why Zebras Don\'t Get Ulcers (2004) · HeartMath Institute — Coherence Research · American Institute of Stress (2023)',
                 'content'     => '<h3>You don\'t lack willpower. You lack recovery.</h3>
<p>For decades, work culture, sports, and self-development have valued one thing above all: <strong>sustained effort</strong>. Wake up early. Work harder. Last longer. And yet something isn\'t working. Burnout is everywhere. Executives who "have never been more organized" collapse. Elite athletes suffer cardiac events.</p>
<p>This isn\'t weakness. It\'s <strong>physiology</strong>.</p>

<h3>The autonomic nervous system: your hidden engine</h3>
<p>Your body is run by an invisible conductor: the <strong>autonomic nervous system (ANS)</strong>. It regulates your heart, lungs, digestion, and hormones — without you having to think about it.</p>
<p>It operates in two modes:</p>
<ul>
<li><strong>Sympathetic mode (accelerator)</strong> — cortisol, adrenaline, high heart rate, maximum vigilance. The "fight or flight" mode. Essential in real danger.</li>
<li><strong>Parasympathetic mode (brake)</strong> — vagus nerve, serotonin, cellular recovery, digestion, creativity. The "rest and repair" mode.</li>
</ul>
<p>The problem? Our era has disabled the brake. Notifications, permanent deadlines, hyper-connection — all of this keeps the system in sympathetic mode <strong>continuously</strong>. The body no longer knows how to stop.</p>

<h3>Why 5 minutes of conscious breath changes everything</h3>
<p>In 2001, researchers at the HeartMath Institute discovered something remarkable: <em>breathing at approximately 5 breaths per minute creates a state of "cardiac coherence"</em> — a synchronization between the heart, brain, and nervous system. This state activates the vagus nerve, which is the main cable of the parasympathetic system.</p>
<p>Practical translation: <strong>5 minutes is enough</strong> to lower cortisol, reduce heart rate, improve mental clarity, and create a stable calm state.</p>
<blockquote>"Breath is the only autonomous system we can consciously control. It is our direct gateway to our inner state." — Dr Andrew Weil</blockquote>

<h3>What the Pause Souffle Ritual activates in you</h3>
<p>This isn\'t a comfort practice. It\'s a practice of <strong>neurological reset</strong>. Every time you do a 5-5-5 Pause Souffle, you send a direct signal to your nervous system: <em>the danger has passed. You can rebuild.</em></p>
<p>Your mission in this module is simple: experiment. Not believe — <strong>feel</strong>.</p>'],
                ['type' => 'exercise', 'title' => 'The honest inventory',               'duration' => '15 min', 'description' => 'Three uncensored questions: What am I chasing? What am I avoiding feeling? If I truly stopped — what would still be there?'],
                ['type' => 'practice', 'title' => 'The first Pause Souffle 5-5-5',     'duration' => '5 min',  'description' => 'Inhale 5s · Hold 5s · Exhale 5s. 5 cycles. Notice a sensation and write it down.'],
                ['type' => 'writing',  'title' => 'Letter to the self who was running', 'duration' => '20 min', 'description' => 'Write 10–20 lines addressed to the version of you who was running fastest. Begin with: "I see you. And I understand why you were running..."'],
            ],
        ],
        '02-je-reconnais-mes-blessures' => [
            'title_en'       => 'I Recognize My Wounds',
            'description_en' => 'Recognizing without self-judgment. The body as memory. Transforming shame into understanding.',
            'intro_text_en'  => "We all carry wounds. Words heard too early. Absences we misunderstood. Griefs we were not allowed to feel.\n\nThe body holds everything — long before the mind understands.\n\nThese wounds are not flaws. They are maps. They show where you needed protection. And where you can begin to heal today.\n\nThe first step is not to heal. It is to **see**.",
            'activities_en'  => [
                ['type' => 'lecture',  'title' => 'How the body carries wounds',        'duration' => '15 min',
                 'description' => 'The work of Peter Levine (Somatic Experiencing) and Bessel van der Kolk (The Body Keeps the Score). Unexpressed trauma settles in the nervous system.',
                 'source'      => 'Sources: Peter Levine — Waking the Tiger (1997) · Bessel van der Kolk — The Body Keeps the Score (2014) · Stephen Porges — Polyvagal Theory (2011)',
                 'content'     => '<h3>The body remembers everything</h3>
<p>Some things your mind has "forgotten." Your body never did. Tension in the shoulders that comes back without reason. Unease in certain places. A disproportionate reaction to a tone of voice. These aren\'t quirks. They are <strong>the imprints of what you have lived through</strong>.</p>
<p><strong>Trauma</strong> isn\'t reserved for spectacular catastrophes. It exists wherever the nervous system was overwhelmed — and where the discharge never happened.</p>

<h3>Peter Levine and the tiger that escapes</h3>
<p>Biologist Peter Levine observed something decisive in wild animals: a zebra chased by a lion, if it escapes, <em>trembles with its entire body for several minutes</em> before resuming normal life. That trembling isn\'t fear. It\'s the <strong>neurological discharge</strong> of trauma.</p>
<p>Humans, however, have learned to suppress that trembling. <em>"Calm down. Be strong. It\'s nothing."</em> Result: the survival energy remains trapped in the body. It searches for an exit — and finds it in chronic pain, anxiety, hypervigilance, or collapse.</p>
<blockquote>"Trauma is not what happened to you. It\'s what happened inside you in response to what happened." — Peter Levine</blockquote>

<h3>Bessel van der Kolk: the body doesn\'t lie</h3>
<p>Psychiatrist Bessel van der Kolk studied hundreds of trauma patients with neuroimaging. His major finding: during traumatic recall, <strong>the language area of the brain goes offline</strong>. You can\'t "talk" trauma out of the body. You need to go through the body itself.</p>
<p>That\'s where breathing becomes a healing tool. Breath, connected to the vagus nerve, is one of the rare direct accesses to the autonomic nervous system — without needing words.</p>

<h3>What this changes for you</h3>
<p>Recognizing your wounds isn\'t weakness. It\'s an act of precision. Knowing <em>where</em> your body stores an emotion means knowing <em>where</em> to begin breathing. This module isn\'t therapy — it\'s a <strong>space of recognition</strong>. And sometimes, being seen is enough for something to begin moving.</p>'],
                ['type' => 'exercise', 'title' => 'Body mapping',                        'duration' => '15 min', 'description' => 'Scan the body from head to toe. Identify three areas of tension. Name what each area might be holding without trying to analyze it.'],
                ['type' => 'practice', 'title' => 'Breathing toward the tension',       'duration' => '8 min',  'description' => 'Find a tense area. Inhale toward it for 5s, exhale releasing for 5s. Say inwardly: "I see you." Repeat 5 cycles.'],
                ['type' => 'writing',  'title' => 'Letter to the wound',                'duration' => '20 min', 'description' => 'Write a letter to your wounded self. Not to heal — to witness. Begin with: "I see you. And I understand why you protected yourself."'],
                ['type' => 'reflection', 'title' => 'What the wound taught me',        'duration' => '10 min', 'description' => 'Complete: "This wound taught me... It cost me... But it also gave me..."'],
            ],
        ],
        '03-je-decris-mon-bonheur' => [
            'title_en'       => 'I Describe My Happiness',
            'description_en' => 'Moving from "what I no longer want" to "what I truly want." The inner compass.',
            'intro_text_en'  => "Many people know exactly what they no longer want. But very few can describe what they truly want.\n\nHappiness is not an abstract destination. It is made of concrete moments. Sensations. Words. Smells. Relationships.\n\nIf you don't know what your happiness looks like — you cannot recognize it when it arrives.",
            'activities_en'  => [
                ['type' => 'lecture',  'title' => 'Happiness is in the details',         'duration' => '10 min',
                 'description' => 'Positive psychology (Martin Seligman, PERMA): lasting happiness is built on engagement, meaning, and relationships — not immediate pleasure.',
                 'source'      => 'Sources: Martin Seligman — Flourish (2011) · Mihaly Csikszentmihalyi — Flow (1990) · Sonja Lyubomirsky — The How of Happiness (2008)',
                 'content'     => '<h3>We\'re looking for happiness in the wrong place</h3>
<p>We were taught that happiness is a destination. A bigger house. A promotion. A perfect relationship. A number in an account. But positive psychology research is clear: <strong>major achievements don\'t create lasting happiness</strong>. Hedonic adaptation erases the pleasure within weeks.</p>
<p>Real happiness — the kind that lasts — is made of something far more subtle.</p>

<h3>Martin Seligman\'s PERMA model</h3>
<p>Psychiatrist Martin Seligman spent thirty years studying what truly constitutes human well-being. He identified five elements:</p>
<ul>
<li><strong>P — Positive Emotions</strong>: Not euphoria. Gratitude. Serenity. Hope. Soft, ordinary emotions.</li>
<li><strong>E — Engagement</strong>: Those moments when you lose track of time. What Csikszentmihalyi calls <em>flow</em>.</li>
<li><strong>R — Relationships</strong>: The quality of human connection, not the quantity.</li>
<li><strong>M — Meaning</strong>: Belonging to something larger than yourself.</li>
<li><strong>A — Achievement</strong>: Moving toward your own goals — not others\'.</li>
</ul>
<blockquote>"Happiness doesn\'t come from what you have. It comes from how you relate to what you experience." — Sonja Lyubomirsky</blockquote>

<h3>Happiness is recognizable in the details</h3>
<p>The most fulfilled people psychologists have studied share one common trait: they can describe their happiness concretely. Not "I want to be happy." But: <em>"I\'m happy when I cook in silence on Sunday morning"</em>, or <em>"when I read in a café without checking my phone"</em>, or <em>"when someone tells me I made a difference."</em></p>
<p>These details aren\'t anecdotal. They are <strong>your inner compass</strong>.</p>

<h3>For you in this module</h3>
<p>The exercise that follows is not a wish list. It\'s a work of precision: putting true words on what, concretely, makes you feel alive. Because if you don\'t know what your happiness looks like — you can\'t recognize it when it arrives.</p>'],
                ['type' => 'exercise', 'title' => 'The compass memory',                  'duration' => '15 min', 'description' => 'Find a memory where you felt fully alive. How old were you? Where? What were you doing? What did you feel in your body? This memory is your reference.'],
                ['type' => 'practice', 'title' => 'Anchoring in joy — Pause Souffle',   'duration' => '5 min',  'description' => 'Hold the compass memory in mind during 5 cycles of 5-5-5. Let the feeling of the memory amplify your breath.'],
                ['type' => 'writing',  'title' => 'My happiness in 5 concrete sentences','duration' => '15 min', 'description' => 'Describe happiness with true details. No grand ideals. Example: "I am happy when I have a morning coffee in silence before everyone wakes up."'],
            ],
        ],
        '04-j-ecoute-mon-souffle' => [
            'title_en'       => 'I Listen to My Inner Breath',
            'description_en' => 'The heart of the training. Mastering cardiac coherence and understanding the physiology of breath.',
            'intro_text_en'  => "The breath is the only system in the body that is both automatic and conscious. You can let your heart beat without thinking about it. But you can also decide to breathe differently — right now — and transform your inner state in just a few minutes.\n\nThat is where an extraordinary power lies.\n\nNot the power to control others. Not the power to dominate the world.\n\n**The power to return to yourself.**",
            'activities_en'  => [
                ['type' => 'lecture',  'title' => 'The physiology of breath',            'duration' => '20 min',
                 'description' => 'The vagus nerve, cardiac coherence (HeartMath Institute), respiratory frequencies. Why 5.5 breaths per minute is the resonance frequency of the human body.',
                 'source'      => 'Sources: HeartMath Institute — Coherence Research (2001–2023) · Dr James Nestor — Breath (2020) · Dr Andrew Weil — Breathing: The Master Key to Self-Healing',
                 'content'     => '<h3>Breath: the control lever for your inner state</h3>
<p>The heart beats. The kidneys filter. The intestines digest. All of this happens without you. But there\'s one system on the border between automatic and conscious: <strong>breathing</strong>. It\'s the only autonomous system you can control voluntarily — and through it, influence everything else.</p>

<h3>The vagus nerve: your highway to peace</h3>
<p>The <strong>vagus nerve</strong> is the longest nerve in the human body. It connects the brainstem to the heart, lungs, and stomach — and carries 80% of its information <em>from the body to the brain</em> (not the other way around). By activating this nerve, you send a direct message to your brain: <em>you can relax, the danger is gone.</em></p>
<p>How to activate it? <strong>Through a slow, prolonged exhale.</strong> Every time you exhale longer than you inhale, you stimulate the vagus nerve.</p>

<h3>Cardiac coherence: the resonance frequency of the human body</h3>
<p>Researchers at the HeartMath Institute discovered that at <strong>5.5 breaths per minute</strong> (approximately 5.5 seconds inhaling and 5.5 seconds exhaling), the heart rate enters a state of perfect coherence with the natural oscillations of the cardiovascular system.</p>
<p>This state of cardiac coherence produces measurable effects:</p>
<ul>
<li>Reduction in cortisol (stress hormone) within <strong>3 minutes</strong></li>
<li>Increase in DHEA (vitality hormone)</li>
<li>Improved cognitive function and creativity</li>
<li>Regulation of difficult emotions</li>
<li>Long-term immune system strengthening</li>
</ul>
<blockquote>"Breathing at 5.5 breaths per minute is finding the resonance frequency of the human body." — Dr James Nestor, <em>Breath</em></blockquote>

<h3>The three foundational practices</h3>
<p><strong>1. Cardiac Coherence 5-5</strong> — 5 seconds inhale, 5 seconds exhale. 5 minutes = 30 cycles. Immediate and cumulative effect (practice 3x/day = results in 3 weeks).</p>
<p><strong>2. Box Breathing (4-4-4-4)</strong> — Navy SEAL technique. 4s inhale · 4s hold · 4s exhale · 4s hold. Ideal for panic or intense stress.</p>
<p><strong>3. 4-7-8 Breathing (Dr Weil)</strong> — 4s inhale · 7s hold · 8s exhale. Activates the parasympathetic in 4 cycles. Used for insomnia and acute anxiety.</p>

<h3>What this means for your practice</h3>
<p>These techniques aren\'t miracle cures. They are <strong>inner navigation tools</strong>. By mastering them, you become autonomous with your emotional states. Not by suppressing them — but by knowing how to return to yourself, at any moment, in any situation.</p>'],
                ['type' => 'practice', 'title' => 'Cardiac coherence 5-5 — 5 minutes', 'duration' => '5 min',  'description' => 'Inhale 5s, exhale 5s. Maintain for 5 minutes (30 cycles). Observe the difference in your emotional state before and after.'],
                ['type' => 'practice', 'title' => 'Box breathing — 4-4-4-4',            'duration' => '5 min',  'description' => 'Inhale 4s · Hold 4s · Exhale 4s · Hold 4s. Special forces technique. Ideal for intense stress.'],
                ['type' => 'practice', 'title' => 'Calming breath — 4-7-8',             'duration' => '5 min',  'description' => 'Inhale 4s · Hold 7s · Exhale 8s. Dr. Andrew Weil technique. Activates the parasympathetic system in 4 cycles.'],
                ['type' => 'reflection', 'title' => 'Breath journal — 7 days',          'duration' => '7 days', 'description' => 'Practice cardiac coherence 5 minutes each morning for 7 days. Note each day: state before / state after / one observation.'],
            ],
        ],
        '05-je-decouvre-ma-mission' => [
            'title_en'       => 'I Discover My Unique Mission',
            'description_en' => 'Finding the intersection of your lived experience, natural gifts, and the world\'s need. The Ikigai applied to practice.',
            'intro_text_en'  => "There is a question very few people truly ask themselves.\n\nNot: what do I want to do?\nBut: **why am I here?**\n\nYour mission is not in a diploma. It is not in a title. It is in the intersection of three things: what you have been through... what comes naturally to you... and what the world needs.",
            'activities_en'  => [
                ['type' => 'lecture',  'title' => 'Ikigai and reason for being',        'duration' => '15 min',
                 'description' => 'The Japanese concept of Ikigai: what you love / what you are good at / what the world needs / what you can be paid for. Their intersection is your mission.',
                 'source'      => 'Sources: Héctor García & Francesc Miralles — Ikigai (2016) · Dan Buettner — The Blue Zones (2008) · Victor Frankl — Man\'s Search for Meaning (1946)',
                 'content'     => '<h3>生き甲斐 — That which makes life worth living</h3>
<p>The Japanese word <em>Ikigai</em> (生き甲斐) translates literally as <strong>"that which makes life worth living."</strong> This is not an abstract philosophical concept. It\'s a daily practice. In the villages of Okinawa — the Japanese island with the highest concentration of centenarians in the world — inhabitants never retire. Not because they can\'t. But because they have found their Ikigai.</p>

<h3>The four overlapping circles</h3>
<p>Ikigai is found at the intersection of four dimensions:</p>
<ul>
<li><strong>What you love</strong> — your deep passions, what makes you lose track of time</li>
<li><strong>What you\'re good at</strong> — your natural abilities, what comes easily to you</li>
<li><strong>What the world needs</strong> — the problems you can solve, the pain you understand</li>
<li><strong>What you can be paid for</strong> — the value you can create and exchange</li>
</ul>
<p>When two circles overlap without the other two, something is missing:</p>
<ul>
<li>Love + talent — without world need or pay = <em>passion without utility</em></li>
<li>Talent + paid — without love or world need = <em>comfort without soul</em></li>
<li>World need + paid — without love or talent = <em>exhaustion</em></li>
</ul>
<p>But when all four circles intersect? That\'s where your mission takes its true shape.</p>
<blockquote>"The greatest tragedy is not failing to realize your Ikigai. It\'s never taking the time to look for it." — Héctor García</blockquote>

<h3>Your lived experience is your raw material</h3>
<p>The key few people see at first: <strong>what you have been through is part of your Ikigai</strong>. What cost you the most is often what you understand most deeply — and therefore what you can transmit most powerfully.</p>
<p>Victor Frankl, psychiatrist and Auschwitz survivor, put it this way: <em>"He who has a why can bear almost any how."</em> Your mission isn\'t in a diploma. It\'s in your story — and in what you do with it.</p>

<h3>A mission is not fixed</h3>
<p>Ikigai is not a destination. It\'s a compass. It can evolve. What matters is having a clear enough direction to know each morning <em>why you get up</em> — and flexible enough to adjust as you walk.</p>'],
                ['type' => 'exercise', 'title' => 'Your mission map',                   'duration' => '30 min', 'description' => 'Draw the 4 Ikigai circles. Fill each one honestly. Observe the intersections. The mission does not need to be perfect — it reveals itself as you walk.'],
                ['type' => 'practice', 'title' => 'Clarity Pause Souffle',              'duration' => '7 min',  'description' => '5 cycles of 5-5-5. Then ask inwardly: "What I have been through can serve..." Let answers come without forcing them.'],
                ['type' => 'writing',  'title' => 'My mission statement',               'duration' => '20 min', 'description' => 'Complete: "My presence in the lives of others allows [who] to [do what] for [what result]." Write 3 versions. Keep the one that moves you.'],
            ],
        ],
        '07-je-transmets-le-rituel' => [
            'title_en'       => 'I Practice the Pause Souffle Ritual',
            'description_en' => 'Integrating all tools and learning to guide a complete session. From practitioner-in-training to Certified Pause Souffle Practitioner.',
            'intro_text_en'  => "You have traveled a path.\n\nYou have met yourself. You have recognized your wounds. You have described your happiness. You have listened to your breath. You have touched your mission.\n\nNow it is time to **transmit**.\n\nBecause what you have lived here — other people need it.\n\nThe Pause Souffle Ritual you are going to guide is not a technique. It is a **presence**.",
            'activities_en'  => [
                ['type' => 'lecture',  'title' => 'The practitioner\'s ethics',        'duration' => '15 min',
                 'description' => 'Ethical framework: confidentiality, limits of practice, referral to healthcare professionals. What the Pause Souffle Ritual is — and what it is not.',
                 'source'      => 'Sources: FFMBE Code of Ethics for Wellness Practitioners · International Coach Federation — Code of Ethics · Dr Christophe Massin — Ethics in Practice (2019)',
                 'content'     => '<h3>Guiding is an act of responsibility</h3>
<p>When you guide a Pause Souffle session, you enter someone\'s inner space. That space is <strong>fragile and precious</strong>. The practitioner\'s ethics isn\'t an administrative formality — it\'s the spine of your practice. Without it, you could unintentionally harm where you want to help.</p>

<h3>What the Pause Souffle Ritual is</h3>
<ul>
<li>A practice of <strong>well-being and nervous system regulation</strong></li>
<li>A space of <strong>gentleness, presence, and slowing down</strong></li>
<li>A tool for <strong>burnout prevention and reconnection with oneself</strong></li>
<li>A <strong>complementary</strong> accompaniment to any medical or psychological follow-up</li>
</ul>

<h3>What the Pause Souffle Ritual is not</h3>
<ul>
<li><strong>Not therapy</strong> — you are not a therapist, psychologist, or doctor</li>
<li><strong>Not diagnosis</strong> — you do not diagnose someone\'s condition</li>
<li><strong>Not treatment</strong> — you do not replace psychiatric or medical care</li>
<li><strong>Not personal advice</strong> — you do not guide someone\'s life decisions</li>
</ul>
<blockquote>"A practitioner\'s first responsibility is to do no harm — and to have the clarity to know when to refer to someone else." — ICF Code of Ethics</blockquote>

<h3>The four ethical pillars</h3>
<p><strong>1. Absolute confidentiality</strong> — What happens in a session stays between you and the person. No sharing, no mention, even anonymously, without explicit consent.</p>
<p><strong>2. Clear boundaries</strong> — If someone is going through a psychological crisis, recent bereavement, severe depressive episode, or active addiction: refer to a health professional. This isn\'t avoiding — it\'s protecting.</p>
<p><strong>3. Constant non-judgment</strong> — Your role is to welcome and guide, never to evaluate or correct someone\'s life.</p>
<p><strong>4. Informed consent</strong> — Before each session, clearly explain what you offer, what you don\'t offer, and give the freedom to stop at any time.</p>

<h3>The phrase to hold</h3>
<p>If you ever doubt in a situation: <em>"My role is to create a safe space for this person to meet their own inner calm. I don\'t heal — I accompany."</em></p>
<p>It\'s from this posture — humble, present, and precise — that transmission becomes truly powerful.</p>'],
                ['type' => 'practice', 'title' => '30-minute session protocol',        'duration' => '30 min', 'description' => 'Complete guided session structure: welcome (5 min) · body scan (5 min) · main breathing practice (15 min) · integration and closing (5 min). Practice on yourself first.'],
                ['type' => 'practice', 'title' => '60-minute session protocol',        'duration' => '60 min', 'description' => 'Extended version: welcome · scan · anchoring exercise · cardiac coherence · guided visualization · quick journal · closing.'],
                ['type' => 'exercise', 'title' => 'Witness session — guide someone',   'duration' => '45 min', 'description' => 'Guide a first complete session with a willing friend or family member. Then note: what went well, what can improve, what you felt while transmitting.'],
                ['type' => 'reflection', 'title' => 'My practitioner declaration',     'duration' => '15 min', 'description' => 'Write one page: who you were before, what this training transformed, and how you intend to share the Pause Souffle Ritual.'],
            ],
        ],
    ];

    public function run(): void
    {
        foreach ($this->content as $slug => $data) {
            $enData = $this->contentEn[$slug] ?? [];
            DB::table('formation_modules')
                ->where('slug', $slug)
                ->update([
                    'description'    => $data['description'],
                    'intro_text'     => $data['intro_text'],
                    'activities'     => json_encode($data['activities']),
                    'title_en'       => $enData['title_en'] ?? null,
                    'description_en' => $enData['description_en'] ?? null,
                    'intro_text_en'  => $enData['intro_text_en'] ?? null,
                    'activities_en'  => isset($enData['activities_en']) ? json_encode($enData['activities_en']) : null,
                    'updated_at'     => now(),
                ]);
        }

        $this->command->info('[FormationModuleContentSeeder] Contenu bilingue FR + EN des 7 modules mis à jour.');
    }
}
