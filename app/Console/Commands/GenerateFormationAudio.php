<?php

namespace App\Console\Commands;

use App\Models\FormationModule;
use App\Services\OpenAIService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class GenerateFormationAudio extends Command
{
    protected $signature   = 'formation:generate-audio {--module= : Slug du module spécifique (optionnel)} {--lang= : Langue à générer : fr, en ou all (défaut: all)} {--force : Régénérer même si l\'audio existe déjà}';
    protected $description = 'Génère les fichiers audio MP3 FR et EN pour chaque module de la formation via OpenAI TTS';

    // ── Scripts audio par module — FR "TTS-ready" ultra luxe ─────
    // [pause Xs] = marqueurs convertis en ellipses dans handle()
    // Chaque chiffre de respiration = phrase courte isolée → pause naturelle
    private array $scripts = [

        // ─────────────────────────────────────────────────────────
        // MODULE 0 — "Comprendre le corps" (anatomie) — cible : 8–10 min
        // ─────────────────────────────────────────────────────────
        '00-comprendre-le-corps' => <<<'SCRIPT'
Bienvenue dans ce module d'ouverture.
[pause 6s]

Avant de commencer... installez-vous confortablement.
[pause 3s]
Assis... allongé... debout... peu importe.
[pause 4s]
Laissez votre corps trouver son appui naturel.
[pause 8s]

Ce module ne commence pas par des termes latins.
[pause 4s]
Il ne commence pas par des schémas anatomiques.
[pause 4s]
Il commence par trois images.
[pause 5s]
Simples... évidentes... que chacun comprend immédiatement.
[pause 8s]

Car pour comprendre le corps profondément...
[pause 4s]
il faut d'abord le voir autrement.
[pause 10s]

Première image.
[pause 5s]

La maison vivante.
[pause 6s]

Imaginez que votre corps est une maison vivante.
[pause 5s]
Pas une maison ordinaire...
[pause 3s]
Une maison qui pense... qui respire... qui s'adapte à chaque instant.
[pause 8s]

Toute maison repose sur une charpente.
[pause 4s]
Sans elle... les murs s'effondrent.
[pause 3s]
Dans votre corps... c'est le squelette.
[pause 5s]
Il donne la structure... la forme... l'architecture.
[pause 3s]
La colonne vertébrale est la poutre centrale.
[pause 4s]
Autour d'elle... tout s'organise.
[pause 8s]

Une maison a aussi des charnières.
[pause 4s]
Des pivots... qui permettent d'ouvrir... de fermer... de plier.
[pause 3s]
Dans votre corps... ce sont les articulations.
[pause 5s]
Le genou... le coude... l'épaule... la hanche.
[pause 4s]
Ce sont elles qui permettent le mouvement.
[pause 8s]

Une maison moderne a des mécanismes.
[pause 4s]
Des portes qui s'ouvrent... des volets qui se ferment...
[pause 3s]
Tout ce qui met la maison en mouvement.
[pause 4s]
Dans votre corps... ce sont les muscles.
[pause 5s]
Ils tirent sur les os... activent les articulations... créent chaque geste.
[pause 8s]

Une maison saine a de l'air qui circule.
[pause 4s]
Pas du vent... de l'air.
[pause 3s]
Des fenêtres que l'on ouvre le matin...
[pause 3s]
Une atmosphère qui se renouvelle.
[pause 4s]
Quand l'air circule... la maison est légère... vivante.
[pause 3s]
Quand l'air est bloqué... l'atmosphère devient lourde.
[pause 5s]
Dans votre corps... c'est la respiration.
[pause 4s]
La Pause Souffle est l'acte d'ouvrir les fenêtres de votre maison... consciemment.
[pause 10s]

Et enfin... une maison sans électricité est aveugle.
[pause 4s]
L'électricité relie chaque pièce... allume les lumières... fait fonctionner chaque appareil.
[pause 4s]
Dans votre corps... c'est le système nerveux.
[pause 5s]
Il relie le cerveau à chaque muscle... chaque organe... chaque millimètre de peau.
[pause 10s]

Votre maison vivante est là... maintenant... sous vous.
[pause 5s]
Elle vous tient.
[pause 12s]

Deuxième image.
[pause 5s]

L'arbre vivant.
[pause 6s]

Si la maison vous a parlé de structure...
[pause 4s]
l'arbre vous parle de vie.
[pause 8s]

Imaginez que votre corps est un arbre.
[pause 5s]
Un arbre en pleine vie... qui pousse... qui respire... qui nourrit.
[pause 8s]

Tout arbre s'organise autour de son tronc.
[pause 4s]
Vertical... central... lien entre la terre et le ciel.
[pause 4s]
Dans votre corps... c'est la colonne vertébrale.
[pause 5s]
Autour d'elle... tout rayonne.
[pause 8s]

Les bras sont les branches.
[pause 4s]
Ils s'étendent... s'élèvent... s'ouvrent vers le monde.
[pause 5s]
Les jambes sont les racines.
[pause 4s]
Elles ancrent... stabilisent... absorbent.
[pause 4s]
Sentez vos pieds... en ce moment... c'est votre ancrage.
[pause 10s]

Les muscles sont l'écorce vivante.
[pause 4s]
Ils enveloppent les os... protègent les organes...
[pause 3s]
donnent au corps sa forme visible.
[pause 4s]
Et comme l'écorce... ils gardent la mémoire des tensions accumulées.
[pause 8s]

Le sang est la sève.
[pause 4s]
Il circule partout... en permanence... du centre jusqu'aux extrémités.
[pause 4s]
Il apporte l'oxygène... les nutriments... l'énergie.
[pause 3s]
Il emporte ce dont le corps n'a plus besoin.
[pause 8s]

Les poumons sont les feuilles.
[pause 4s]
À chaque inspiration... ils captent l'oxygène du monde.
[pause 4s]
À chaque expiration... ils libèrent ce qui n'est plus utile.
[pause 5s]
Chaque souffle est un échange... entre vous... et le monde.
[pause 10s]

Et les nerfs... sont le réseau invisible.
[pause 4s]
Sous la surface... ils transmettent... informent... coordonnent.
[pause 4s]
Sensation... mouvement... réaction... tout passe par eux.
[pause 12s]

Troisième image.
[pause 5s]

L'orchestre vivant.
[pause 6s]

Si la maison vous a parlé de structure...
[pause 3s]
et l'arbre de vie...
[pause 3s]
l'orchestre vous parle d'intelligence.
[pause 8s]

Imaginez que votre corps est un orchestre vivant.
[pause 5s]
Dans un orchestre... chaque instrument joue sa partie.
[pause 4s]
Tout doit être coordonné.
[pause 3s]
Sinon... la musique devient du bruit.
[pause 8s]

Le cerveau est le chef d'orchestre.
[pause 4s]
Il dirige... coordonne... donne le tempo.
[pause 3s]
En permanence... il reçoit des milliers de signaux... et prend des décisions.
[pause 8s]

Les nerfs sont les partitions.
[pause 4s]
Ils transmettent les instructions aux muscles.
[pause 3s]
Contracte... relâche... bouge... arrête.
[pause 4s]
Et en sens inverse... ils remontent les sensations vers le cerveau.
[pause 8s]

Les muscles sont les instruments.
[pause 4s]
Certains sont puissants... comme les cuivres.
[pause 3s]
D'autres sont précis... comme les violons.
[pause 3s]
D'autres encore sont stabilisateurs... silencieux... comme les basses.
[pause 5s]
Un mouvement fluide... c'est quand tous jouent ensemble... au bon moment.
[pause 8s]

Le squelette est la scène.
[pause 4s]
Les musiciens ont besoin d'une structure solide pour jouer.
[pause 4s]
Sans elle... rien n'est possible.
[pause 8s]

Et la respiration...
[pause 4s]
est le rythme.
[pause 5s]
Quand elle est lente et profonde...
[pause 3s]
l'orchestre joue en douceur... tout le corps se dépose.
[pause 4s]
Quand elle est rapide et courte...
[pause 3s]
tout s'accélère... la tension monte.
[pause 5s]
Ce que vous faites avec votre souffle...
[pause 3s]
vous le faites avec votre corps entier.
[pause 10s]

Maintenant... prenons un moment.
[pause 5s]
Trois images... une seule vérité.
[pause 6s]

La maison... vous dit ce que le corps est.
[pause 5s]
L'arbre... vous dit ce qui le rend vivant.
[pause 5s]
L'orchestre... vous dit ce qui le rend intelligent.
[pause 10s]

Votre corps est tout cela à la fois.
[pause 5s]
Il n'est pas une machine à réparer.
[pause 4s]
C'est un être à habiter.
[pause 10s]

Maintenant... je vais vous emmener en voyage.
[pause 5s]
Un voyage dans les territoires de votre corps.
[pause 6s]
Des pieds... jusqu'à la tête.
[pause 4s]
Lentement... sans chercher quoi que ce soit.
[pause 5s]
Juste s'y poser.
[pause 10s]

Sentez vos pieds.
[pause 4s]
Vingt-six os dans chaque pied... disposés comme une voûte.
[pause 4s]
Reposent sur eux... le tibia... la fibula... le genou.
[pause 5s]
La plus grande charnière du corps.
[pause 6s]

Remontez vers les cuisses.
[pause 4s]
Le fémur... l'os le plus long de votre corps.
[pause 4s]
Enveloppé par les quadriceps devant... les ischio-jambiers derrière.
[pause 5s]
Des câbles puissants... qui vous permettent de marcher... de courir... de tenir.
[pause 8s]

Le bassin... le centre de gravité.
[pause 4s]
L'ilion... l'ischion... le pubis.
[pause 4s]
Le psoas... ancré là... reliant la colonne aux cuisses.
[pause 5s]
C'est le muscle que la Pause Souffle relâche le plus profondément.
[pause 8s]

L'abdomen... le ventre.
[pause 4s]
Quatre couches de muscles en spirale... comme un corset naturel.
[pause 4s]
Et en dessous... les organes qui transforment... qui nourrissent... qui éliminent.
[pause 6s]

Le thorax... la cage.
[pause 4s]
Sternum... douze paires de côtes... vertèbres thoraciques.
[pause 4s]
Et au centre de tout... le diaphragme.
[pause 4s]
Le seul muscle à la fois volontaire et automatique.
[pause 4s]
Le pont entre ce que vous contrôlez... et ce que le corps fait tout seul.
[pause 5s]
Poussez doucement votre ventre vers l'extérieur en inspirant...
[pause 3s]
C'est lui.
[pause 8s]

Les épaules... les bras... jusqu'aux mains.
[pause 4s]
Vingt-sept os dans chaque main.
[pause 4s]
Ces mains qui touchent... qui créent... qui soignent.
[pause 6s]

Le dos.
[pause 4s]
Le trapèze... le grand dorsal... les rhomboïdes.
[pause 4s]
Et tout au fond... les multifides... vertèbre par vertèbre.
[pause 4s]
Les gardiens silencieux de votre colonne.
[pause 8s]

Le cou... sept vertèbres cervicales.
[pause 4s]
Le nerf vague y passe...
[pause 3s]
le fil qui relie le cerveau au cœur... aux poumons... au ventre.
[pause 5s]
Chaque respiration lente le calme.
[pause 8s]

Et la tête.
[pause 4s]
Vingt-deux os qui forment le crâne et le visage.
[pause 4s]
Le cerveau à l'intérieur... trois livres de matière vivante...
[pause 4s]
qui contient plus de connexions que d'étoiles dans la galaxie.
[pause 8s]

Votre corps est une ville vivante.
[pause 5s]
Avec ses quartiers... ses routes... ses services essentiels.
[pause 5s]
Le système nerveux transmet à cent vingt mètres par seconde.
[pause 4s]
Le cœur bat cent mille fois par jour sans jamais s'arrêter.
[pause 4s]
Les poumons échangent vingt mille litres d'air chaque jour.
[pause 4s]
Le système immunitaire surveille... filtre... protège... en silence.
[pause 5s]
Et les fascias... tissus continus qui relient tout...
[pause 4s]
forment une combinaison invisible à l'intérieur de votre corps.
[pause 4s]
Sans aucune interruption... de la tête aux pieds.
[pause 10s]

Quand vous inspirez profondément...
[pause 4s]
cinq systèmes répondent en même temps.
[pause 4s]
Respiratoire... cardiovasculaire... nerveux... endocrinien... fascial.
[pause 5s]
Cinq systèmes. Cinq secondes. Un seul souffle.
[pause 10s]

Nous allons pratiquer ensemble.
[pause 3s]
La Pause Souffle... cinq-cinq-cinq.
[pause 5s]

Cinq secondes pour inspirer.
[pause 2s]
Cinq secondes de rétention... bouche légèrement ouverte.
[pause 2s]
Cinq secondes pour expirer... lèvres doucement resserrées.
[pause 5s]

C'est votre outil central.
[pause 3s]
L'acte d'ouvrir les fenêtres de votre maison.
[pause 3s]
De faire circuler la sève dans votre arbre.
[pause 3s]
De reprendre la baguette de votre orchestre.
[pause 7s]

Nous commençons.
[BREATHING_CYCLES]
[pause 20s]

Restez là un moment.
[pause 6s]
Sentez ce qui vient d'avoir lieu.
[pause 8s]

Bienvenue dans la connaissance vivante du corps.
[pause 5s]
À très bientôt.
SCRIPT,

        // ─────────────────────────────────────────────────────────
        // MODULE 0 PROLOGUE — "La vie n'a pas d'âge" — cible : 18–21 min
        // Ton : intime, fondateur — hommage à Chantal, l'électrochoc qui allume tout
        // ─────────────────────────────────────────────────────────
        '00-prologue-la-vie-na-pas-dage' => <<<'SCRIPT'
[pause 8s]

Ce parcours est dédié à quelqu'un.
[pause 5s]
À une femme.
[pause 4s]
Qui s'appelait Chantal.
[pause 10s]

Il y a des moments dans une vie qui coupent le monde en deux.
[pause 5s]
Avant.
[pause 3s]
Et après.
[pause 8s]

C'est à un de ces moments que je dois ce parcours.
[pause 4s]
Pas à une formation.
[pause 3s]
Pas à un livre.
[pause 3s]
À elle.
[pause 12s]

Chantal avait quarante ans.
[pause 5s]
Une fille de treize ans.
[pause 3s]
Un fils de dix.
[pause 6s]
Un cancer diagnostiqué.
[pause 3s]
Une rémission.
[pause 3s]
Et puis... en l'espace d'un mois...
[pause 6s]
c'était fini.
[pause 12s]

Pas une vieille dame au bout d'une longue vie.
[pause 5s]
Une femme de mon âge.
[pause 4s]
Avec les mêmes projets.
[pause 3s]
Les mêmes enfants que moi.
[pause 3s]
Les mêmes certitudes silencieuses sur le futur.
[pause 10s]

Je veux vous dire qui elle était.
[pause 5s]
Vraiment.
[pause 8s]

Elle souriait d'une façon qui rendait les pièces plus lumineuses.
[pause 5s]
Elle avait ce sourire — avec de belles dents blanches —
[pause 4s]
un sourire qui ne cherchait pas à impressionner.
[pause 4s]
Un sourire qui disait simplement :
[pause 4s]
je suis là.
[pause 3s]
Je suis vivante.
[pause 3s]
Et c'est suffisant.
[pause 10s]

Elle respirait la vie.
[pause 4s]
Pas la performance de la vie.
[pause 3s]
La vie elle-même.
[pause 10s]

Elle n'avait pas les grands diplômes.
[pause 4s]
Pas la carrière impressionnante.
[pause 4s]
Pas les signes extérieurs que notre époque confond avec la réussite.
[pause 5s]
Elle avait quelque chose de plus rare.
[pause 6s]

Elle savait qui elle était.
[pause 8s]

Et parce qu'elle savait qui elle était...
[pause 4s]
elle vivait depuis cet endroit.
[pause 5s]
Pas depuis la peur du regard des autres.
[pause 4s]
Pas depuis le besoin de prouver quelque chose.
[pause 4s]
Depuis elle-même.
[pause 3s]
Depuis ses valeurs.
[pause 3s]
Depuis ce qui comptait vraiment.
[pause 10s]

Elle avait fait les choix que peu de gens font.
[pause 5s]
Pas les choix faciles.
[pause 4s]
Les choix justes.
[pause 6s]

Elle avait construit quelque chose de vrai.
[pause 5s]
Une famille. Un foyer. Des liens solides.
[pause 6s]
Ses enfants sont entourés aujourd'hui.
[pause 4s]
Aimés. Portés.
[pause 5s]
C'est le fruit de ce qu'elle avait semé.
[pause 10s]

Quand elle est partie...
[pause 5s]
elle n'a pas laissé un vide derrière elle.
[pause 5s]
Elle a laissé des bijoux.
[pause 6s]

Ses enfants.
[pause 5s]
Des êtres façonnés par une femme qui savait...
[pause 4s]
que ce qu'on sème aujourd'hui pousse longtemps après qu'on soit parti.
[pause 12s]

En quarante ans...
[pause 4s]
Chantal a vécu plus authentiquement que beaucoup ne le feront en quatre-vingts.
[pause 6s]

Elle avait réalisé ce que certains mettent une vie entière à effleurer.
[pause 6s]

La vie la plus précieuse...
[pause 4s]
n'est pas dans le paraître.
[pause 3s]
Pas dans les diplômes.
[pause 3s]
Pas dans les certifications de réussite que la société distribue.
[pause 5s]
Elle est dans la simplicité.
[pause 4s]
Dans le fait de savoir ce qu'on aime...
[pause 3s]
qui on aime...
[pause 3s]
pourquoi on vit.
[pause 4s]
Et d'agir depuis cet endroit.
[pause 10s]

Elle était humble.
[pause 4s]
Non pas parce qu'elle manquait de confiance en elle.
[pause 4s]
Mais parce qu'elle connaissait sa valeur.
[pause 5s]
Et celui qui connaît vraiment sa valeur...
[pause 4s]
n'a plus besoin de la prouver.
[pause 10s]

Elle était le soleil.
[pause 5s]
Pas le genre de soleil qui brille pour qu'on le remarque.
[pause 5s]
Le genre qui chauffe simplement...
[pause 4s]
parce que c'est sa nature.
[pause 12s]

Voilà le paradoxe douloureux que sa disparition m'a laissé.
[pause 6s]

Nous nous connaissions depuis le collège.
[pause 4s]
Chantal était la meilleure amie de ma sœur.
[pause 5s]
On s'est beaucoup côtoyées au lycée... dans la même ville.
[pause 5s]
Puis je suis partie en Belgique.
[pause 4s]
On s'est vues brièvement après la naissance de mon fils.
[pause 4s]
Quelques nouvelles sur les réseaux.
[pause 4s]
Et puis... le silence ordinaire qui s'installe.
[pause 4s]
Celui qu'on croit toujours temporaire.
[pause 3s]
Celui qui dure.
[pause 10s]

La dernière fois que j'ai eu Chantal au téléphone...
[pause 5s]
cela faisait des années qu'on ne s'était pas vraiment parlé.
[pause 5s]
Elle m'avait retrouvée sur les réseaux.
[pause 4s]
Elle n'avait plus mon numéro.
[pause 8s]

Ce n'était pas un appel pour elle.
[pause 5s]
Ce n'était pas pour me dire qu'elle était malade.
[pause 5s]
C'était pour quelqu'un qu'elle aimait.
[pause 5s]
Quelqu'un qui traversait quelque chose de très difficile.
[pause 5s]
Quelqu'un qui avait besoin que l'on soit là.
[pause 10s]

Elle avait déjà son cancer.
[pause 5s]
Je ne le savais pas.
[pause 4s]
Elle ne me l'a pas dit.
[pause 6s]

Elle portait ça.
[pause 4s]
Et son premier réflexe... c'était les autres.
[pause 4s]
Toujours.
[pause 8s]

Durant toutes ces années où j'étais partie...
[pause 5s]
ma sœur a traversé des périodes difficiles.
[pause 5s]
Et Chantal était là pour elle.
[pause 5s]
Sa meilleure amie.
[pause 4s]
Présente.
[pause 4s]
Quand moi j'étais loin.
[pause 10s]

Je lui suis tellement reconnaissante pour ça.
[pause 6s]

Elle a semé dans la vie de ma sœur.
[pause 5s]
Et aujourd'hui...
[pause 4s]
je veux être pour ses enfants...
[pause 4s]
ce qu'elle a été pour elle.
[pause 12s]

Maintenant que tu n'es plus là...
[pause 5s]
je pense souvent à toi.
[pause 10s]

C'est une des vérités les plus amères que la perte nous enseigne.
[pause 6s]
On réalise la valeur de ce qu'on avait...
[pause 5s]
quand on ne l'a plus.
[pause 12s]

Mais tu m'as fait quelque chose de plus grand que me faire regretter.
[pause 6s]

Tu m'as mise face à moi-même.
[pause 8s]

Tu m'as montré que nous avions presque le même âge.
[pause 5s]
Et que si c'était moi qui partais demain...
[pause 5s]
les choix que tu avais su faire —
[pause 4s]
les choix de sagesse pour tes enfants —
[pause 4s]
les choix d'être vraiment présente à ta vie —
[pause 4s]
je ne les avais pas faits.
[pause 8s]

Je me suis rendu compte à quel point je vivais à côté.
[pause 6s]
À côté de ce qui comptait vraiment.
[pause 5s]
Avec mes enfants — là, mais sans être vraiment là.
[pause 5s]
Avec ma sœur — présente, mais pas assez.
[pause 4s]
Avec mes amis — en contact, mais sans prendre vraiment le temps.
[pause 5s]
Avec mes rêves — en mouvement, mais avec l'impression de faire du surplace.
[pause 5s]
À côté de moi-même.
[pause 12s]

Tu m'as réveillée.
[pause 8s]

Pas par ta mort.
[pause 5s]
Par qui tu étais.
[pause 10s]

Depuis que tu es partie...
[pause 5s]
il s'est passé des choses.
[pause 4s]
De vraies choses.
[pause 8s]

Ce projet existait déjà.
[pause 4s]
Mais il tournait en rond.
[pause 4s]
Il avançait — sans vraiment avancer.
[pause 4s]
J'avais l'impression de faire du surplace.
[pause 8s]

Et puis quelque chose a changé.
[pause 5s]
Quelque chose que je n'arrive pas tout à fait à expliquer...
[pause 4s]
mais que je ressens comme une certitude.
[pause 10s]

Je me suis mise au travail.
[pause 4s]
Dans le silence.
[pause 4s]
Des heures. Des semaines. Des mois.
[pause 5s]
Avec l'aide de mon compagnon.
[pause 4s]
Avec des outils que je ne maîtrisais pas au départ.
[pause 4s]
Sans plan écrit.
[pause 3s]
Sans feuille de route tracée à l'avance.
[pause 8s]

Et pourtant — le plan était là.
[pause 5s]
Chaque jour, je découvrais la suite.
[pause 4s]
Comme si quelqu'un me la soufflait.
[pause 10s]

Au départ, je voulais juste moderniser un site.
[pause 4s]
Aujourd'hui, il contient six univers.
[pause 3s]
Un parcours de quarante modules.
[pause 3s]
Plusieurs formations.
[pause 3s]
Et bien plus encore.
[pause 5s]
Je ne m'en reviens pas moi-même.
[pause 8s]

C'est là que j'ai compris quelque chose.
[pause 5s]
Quelque chose que je n'aurais pas osé dire il y a encore un an.
[pause 6s]

Je suis l'outil.
[pause 6s]
Junspro — ce parcours — cette formation —
[pause 4s]
c'est l'œuvre de Dieu.
[pause 8s]

Je sais que cela peut paraître fou à entendre.
[pause 4s]
Mais c'est ce que je crois.
[pause 4s]
Profondément. Calmement. Avec certitude.
[pause 5s]
Au début c'était une impression.
[pause 4s]
Aujourd'hui c'est une évidence.
[pause 5s]
Dans le silence, je suis cœur à cœur avec Lui sur ce projet.
[pause 4s]
Et chaque matin, Il me fait découvrir la suite.
[pause 12s]

En septembre, je pars à Malte avec mes enfants.
[pause 5s]
Ce n'est pas un projet de plus que je remets à l'année prochaine.
[pause 5s]
C'est un moment que je choisis de vivre.
[pause 4s]
Pleinement. Maintenant.
[pause 10s]

J'appelle davantage.
[pause 4s]
Ma sœur. Mes amis.
[pause 4s]
Je dis les choses. Je prends le temps.
[pause 4s]
Je ne laisse plus le silence s'épaissir entre ceux que j'aime.
[pause 10s]

Intérieurement, quelque chose s'est déplacé.
[pause 4s]
Je me sens plus sage.
[pause 3s]
Plus résiliente. Plus compréhensive.
[pause 4s]
Ma spiritualité s'est approfondie.
[pause 4s]
Je cherche à comprendre davantage.
[pause 3s]
À juger moins.
[pause 3s]
À voir l'autre — vraiment.
[pause 10s]

Je veux que mes enfants aient leur père.
[pause 5s]
Pas par obligation.
[pause 4s]
Par conviction.
[pause 6s]
Parce que leurs années ne se rachèteront pas.
[pause 5s]
Parce que chaque jour dans le silence, c'est un jour de moins avec leur père.
[pause 4s]
Un repas raté.
[pause 3s]
Un trait d'humour qu'il n'aura pas entendu.
[pause 3s]
Un câlin qui n'aura pas eu lieu.
[pause 6s]
Parce que ni lui ni moi ne sommes éternels.
[pause 6s]
Alors je tends la main.
[pause 4s]
Je fais le premier pas.
[pause 4s]
Que Dieu m'accompagne dans ça.
[pause 10s]

Et puis...
[pause 5s]
j'ai rencontré quelqu'un.
[pause 6s]
Je ne sais pas ce que l'avenir nous réserve.
[pause 5s]
Mais pour la première fois depuis longtemps...
[pause 5s]
je veux à nouveau construire avec quelqu'un.
[pause 4s]
Que Dieu me guide et m'accompagne.
[pause 12s]

Il y a un avant.
[pause 5s]
Et il y a un après.
[pause 6s]
Et cet après...
[pause 4s]
je te le dois, Chantal.
[pause 12s]

Et pour ça...
[pause 4s]
je ne sais pas comment te remercier autrement...
[pause 4s]
qu'en faisant de cette leçon quelque chose de vivant.
[pause 4s]
En la transmettant.
[pause 4s]
En en faisant ce parcours.
[pause 12s]

Ce parcours existe parce que tu as existé.
[pause 6s]

Chaque personne qui le traversera...
[pause 3s]
chaque vie qui changera...
[pause 3s]
chaque enfant qui sera plus aimé...
[pause 3s]
chaque rêve enfin commencé...
[pause 5s]
c'est ta lumière qui continue.
[pause 15s]

Merci d'avoir été simple dans un monde qui glorifie le compliqué.
[pause 5s]
Merci d'avoir été vraie dans un monde qui récompense le paraître.
[pause 5s]
Merci d'avoir été humble parce que tu connaissais ta valeur.
[pause 5s]
Merci d'avoir semé pour tes bijoux.
[pause 5s]
Merci d'avoir été la merveilleuse femme... amie... mère... compagne que tu étais.
[pause 8s]

Que nous puissions nous retrouver.
[pause 5s]
Je t'aime... Chantal.
[pause 20s]

Installez-vous confortablement.
[pause 4s]
Fermez les yeux si vous pouvez.
[pause 4s]
Et laissez-vous traverser par ce que vous allez entendre.
[pause 12s]

Marcus Aurèle écrivait... il y a deux mille ans :
[pause 4s]
« Ce n'est pas la mort que les gens craignent le plus.
[pause 3s]
C'est la peur d'arriver à la mort...
[pause 3s]
et de réaliser qu'ils n'ont jamais vraiment vécu. »
[pause 12s]

Il y a une différence entre savoir qu'on va mourir...
[pause 5s]
et le réaliser.
[pause 8s]

Tout le monde sait.
[pause 4s]
Presque personne ne réalise.
[pause 10s]

Savoir... c'est une information abstraite.
[pause 4s]
Réaliser... c'est ressentir la vérité de cette information dans la chair.
[pause 5s]
Dans les mains.
[pause 3s]
Dans la gorge.
[pause 3s]
Dans cette petite contraction au creux de l'estomac.
[pause 10s]

Heidegger appelait cela le mode authentique.
[pause 5s]
Vivre en pleine conscience de sa propre finitude.
[pause 4s]
Prendre des décisions depuis ses vraies valeurs.
[pause 4s]
Être présent à ce qui compte...
[pause 3s]
maintenant.
[pause 10s]

L'opposé... c'est le mode inauthentique.
[pause 4s]
Vivre par défaut.
[pause 3s]
Faire ce que les autres font.
[pause 3s]
Remettre à demain.
[pause 3s]
Laisser la vie se passer.
[pause 4s]
Sans vraiment y participer.
[pause 12s]

La grande question... c'est celle-là :
[pause 5s]
Dans quel mode vivez-vous en ce moment ?
[pause 15s]

Les chercheurs en psychologie ont fait une découverte troublante.
[pause 5s]
Bronnie Ware était infirmière en soins palliatifs.
[pause 4s]
Pendant dix ans... elle a écouté les gens mourir.
[pause 5s]
Elle a recueilli leurs dernières confidences.
[pause 4s]
Ce qu'ils regrettaient vraiment... au bout du chemin.
[pause 10s]

Voici ce qu'ils lui ont dit.
[pause 6s]

Le premier regret... le plus répandu :
[pause 4s]
« J'aurais aimé avoir le courage de vivre la vie que je voulais vraiment.
[pause 4s]
Pas celle que la famille attendait.
[pause 3s]
Pas celle que la société valorisait.
[pause 3s]
La mienne. »
[pause 10s]

Le deuxième :
[pause 4s]
« J'aurais aimé ne pas avoir autant travaillé. »
[pause 5s]
Presque tous les hommes.
[pause 3s]
La quasi-totalité des femmes actives.
[pause 3s]
Sans exception.
[pause 10s]

Le troisième :
[pause 4s]
« J'aurais aimé avoir le courage d'exprimer ce que je ressentais vraiment. »
[pause 5s]
Les mots non dits.
[pause 3s]
Les « je t'aime » retenus.
[pause 3s]
Les vérités gardées par peur du conflit.
[pause 10s]

Et le cinquième — celui qui m'a le plus arrêté :
[pause 5s]
« J'aurais aimé m'être permis d'être plus heureux. »
[pause 6s]
La découverte... faite trop tard...
[pause 4s]
que le bonheur était un choix.
[pause 12s]

Prenez un moment avec ça.
[pause 8s]

Lequel de ces regrets résonne en vous... en ce moment ?
[pause 15s]

Laura Carstensen... professeure à Stanford...
[pause 4s]
a passé vingt ans à étudier ce qui se passe dans le cerveau des gens...
[pause 4s]
quand ils perçoivent que leur temps est limité.
[pause 8s]

Ce qu'elle a découvert change tout.
[pause 5s]

Quand on réalise que le temps est compté...
[pause 4s]
le cerveau recentre automatiquement les priorités.
[pause 5s]
On investit dans les relations profondes.
[pause 3s]
On abandonne les activités superficielles.
[pause 3s]
On cherche du sens.
[pause 3s]
On dit les choses importantes.
[pause 10s]

Et Carstensen a montré quelque chose de fondamental :
[pause 5s]
Ce changement ne nécessite pas de vieillir.
[pause 4s]
Il nécessite de réaliser.
[pause 12s]

C'est exactement ce que ce parcours cherche à produire.
[pause 4s]
Non pas en vous effrayant.
[pause 4s]
Mais en vous réveillant.
[pause 15s]

Posons-nous maintenant une question concrète.
[pause 5s]

Pensez aux cinq personnes que vous aimez le plus.
[pause 6s]
Vos enfants si vous en avez.
[pause 3s]
Votre partenaire.
[pause 3s]
Un parent encore vivant.
[pause 3s]
Un ami proche.
[pause 8s]

Maintenant... pour chacune de ces personnes...
[pause 4s]
estimez combien de fois vous les verrez vraiment...
[pause 4s]
si vous continuez à vivre comme maintenant.
[pause 8s]

Un enfant qui a dix-huit ans... qui s'apprête à quitter la maison.
[pause 5s]
Peut-être dix étés ensemble... en entier.
[pause 4s]
Peut-être moins.
[pause 10s]

Un parent de soixante-quinze ans.
[pause 4s]
Si vous le voyez deux fois par an...
[pause 4s]
et s'il vit encore quinze ans...
[pause 4s]
Vous avez trente occasions de le voir.
[pause 4s]
Trente.
[pause 12s]

Ce n'est pas pour vous angoisser.
[pause 4s]
C'est pour vous réveiller à la préciosité de ce qui est là.
[pause 5s]
Maintenant.
[pause 4s]
Devant vous.
[pause 15s]

Oliver Burkeman... dans son livre Quatre mille semaines...
[pause 4s]
a fait un calcul simple.
[pause 4s]
Une vie humaine moyenne...
[pause 3s]
c'est environ quatre mille semaines.
[pause 8s]

Quatre mille.
[pause 6s]

À trente ans... il en reste deux mille six cents.
[pause 4s]
À quarante ans... deux mille.
[pause 4s]
À cinquante ans... mille cinq cents.
[pause 10s]

Ce n'est pas peu.
[pause 4s]
Mais ce n'est pas infini.
[pause 5s]
Et la plupart d'entre nous n'en sommes pas conscients.
[pause 12s]

Alors je vous pose la question que ce parcours entier cherche à répondre :
[pause 6s]

Avec les semaines... les étés... les samedis matins qu'il vous reste...
[pause 5s]
qu'est-ce que vous voulez vraiment vivre ?
[pause 8s]

Pas ce que vous êtes censé vouloir.
[pause 4s]
Pas ce que votre entourage attend de vous.
[pause 4s]
Ce que vous... vous voulez.
[pause 5s]
Profondément.
[pause 5s]
Honnêtement.
[pause 15s]

Je vais maintenant vous proposer un moment de souffle.
[pause 4s]
Pas pour vous calmer.
[pause 4s]
Pour vous ancrer dans ce moment.
[pause 4s]
Pour que ce que vous avez entendu descende du mental...
[pause 3s]
dans le corps.
[pause 10s]

Installez-vous.
[pause 4s]
Posez les mains sur les genoux... paumes ouvertes.
[pause 6s]

Je vais vous guider dans trois cycles de respiration.
[pause 4s]
À chaque inspiration... dites-vous intérieurement :
[pause 3s]
« Je suis vivant... maintenant. »
[pause 5s]
À chaque expiration :
[pause 3s]
« Je choisis comment je vis ça. »
[pause 8s]

Premier cycle.
[pause 3s]
Inspirez... lentement... en cinq temps.
Un.
[pause 1s]
Deux.
[pause 1s]
Trois.
[pause 1s]
Quatre.
[pause 1s]
Cinq.
[pause 2s]
Retenez... en cinq temps.
Un.
[pause 1s]
Deux.
[pause 1s]
Trois.
[pause 1s]
Quatre.
[pause 1s]
Cinq.
[pause 2s]
Expirez... en cinq temps.
Un.
[pause 1s]
Deux.
[pause 1s]
Trois.
[pause 1s]
Quatre.
[pause 1s]
Cinq.
[pause 8s]

Deuxième cycle.
[pause 3s]
Inspirez.
[pause 5s]
Retenez.
[pause 5s]
Expirez.
[pause 5s]

Troisième cycle.
[pause 3s]
Inspirez.
[pause 5s]
Retenez.
[pause 5s]
Expirez doucement.
[pause 12s]

Restez là.
[pause 6s]
Dans ce souffle.
[pause 4s]
Dans ce corps.
[pause 4s]
Dans ce moment qui existe... et qui ne reviendra pas.
[pause 15s]

Viktor Frankl... psychiatre autrichien... survivant des camps...
[pause 4s]
a consacré sa vie à une question :
[pause 5s]
Qu'est-ce qui permet à un être humain de continuer à vivre...
[pause 4s]
face à la souffrance absolue ?
[pause 8s]

Sa réponse... après des années passées à l'observer dans les conditions les plus extrêmes :
[pause 6s]
Le sens.
[pause 8s]

Pas le confort.
[pause 3s]
Pas la sécurité.
[pause 3s]
Pas l'absence de douleur.
[pause 4s]
Le sens.
[pause 10s]

La conscience que sa vie... telle qu'elle est...
[pause 4s]
a une direction.
[pause 4s]
Une importance.
[pause 3s]
Un pour quoi.
[pause 12s]

Et Frankl écrivait :
[pause 4s]
« Entre le stimulus et la réponse...
[pause 4s]
il y a un espace.
[pause 4s]
Dans cet espace réside notre liberté...
[pause 3s]
et notre capacité à grandir. »
[pause 12s]

Ce parcours est cet espace.
[pause 5s]
Entre ce que la vie vous impose...
[pause 4s]
et ce que vous choisissez d'en faire.
[pause 15s]

Vous allez maintenant traverser neuf modules après celui-ci.
[pause 5s]
Certains vous demanderont du temps.
[pause 3s]
D'autres vous surprendront.
[pause 3s]
Certains exercises vous mettront face à des vérités que vous évitez depuis longtemps.
[pause 8s]

Je vous demande de traverser tout ça...
[pause 4s]
avec ce que vous avez entendu aujourd'hui comme toile de fond.
[pause 6s]

Le temps passe.
[pause 4s]
Les gens que vous aimez vieillissent.
[pause 3s]
Vous aussi.
[pause 4s]
Les projets que vous reportez ne vous attendent pas.
[pause 10s]

Mais... et c'est le cœur de ce parcours...
[pause 5s]
il n'est jamais trop tard pour choisir.
[pause 6s]

Pour rentrer chez vous ce soir différemment.
[pause 3s]
Pour appeler quelqu'un que vous avez laissé de côté.
[pause 3s]
Pour dire quelque chose que vous retenez depuis trop longtemps.
[pause 3s]
Pour commencer ce que vous savez que vous devez commencer.
[pause 12s]

Ce moment... maintenant... est réel.
[pause 4s]
Il ne reviendra pas.
[pause 4s]
Mais il peut être le point de départ de quelque chose.
[pause 5s]
De quelque chose de vrai.
[pause 15s]

Avant de terminer ce module...
[pause 4s]
je voudrais que vous fassiez quelque chose de concret.
[pause 6s]

Pas demain.
[pause 3s]
Maintenant.
[pause 8s]

Pensez à une personne.
[pause 5s]
Une seule.
[pause 5s]
Quelqu'un qui compte vraiment.
[pause 4s]
Quelqu'un à qui vous n'avez pas dit ce qu'il ou elle représente pour vous.
[pause 5s]
Peut-être depuis longtemps.
[pause 10s]

Décidez... maintenant...
[pause 4s]
que vous allez lui dire.
[pause 4s]
Pas plus tard.
[pause 3s]
Cette semaine.
[pause 4s]
Dans les sept prochains jours.
[pause 6s]

C'est l'engagement le plus simple et le plus puissant que vous puissiez prendre en entrant dans ce parcours.
[pause 12s]

Ce parcours est né d'une perte.
[pause 5s]
Il est fait de tout ce que cette perte m'a appris.
[pause 5s]
Et de tout ce que des années de recherche... de pratique... de rencontres...
[pause 4s]
ont permis de construire autour de cette clarté initiale.
[pause 8s]

Vous méritez une vie qui ressemble à ce que vous voulez vraiment.
[pause 5s]
Pas une idée de vie.
[pause 3s]
Une vraie vie.
[pause 3s]
Vécue depuis vos vraies valeurs.
[pause 3s]
Avec les gens qui comptent vraiment.
[pause 3s]
Pour les raisons qui comptent vraiment.
[pause 12s]

Bienvenue dans ce parcours.
[pause 6s]

Bienvenue... vraiment.
[pause 15s]
SCRIPT,

        // ─────────────────────────────────────────────────────────
        // MODULE 1 — "Je me rencontre" — cible : 7–8 min
        // Les cycles de respiration sont générés séparément via ffmpeg
        // [BREATHING_CYCLES] = marqueur remplacé par silence+voix ffmpeg
        // ─────────────────────────────────────────────────────────
        '01-je-me-rencontre' => <<<'SCRIPT'
Bienvenue.
[pause 6s]

Prenez le temps de vous installer vraiment.
[pause 3s]
Un lit... un canapé... ou au sol sur un tapis.
[pause 5s]

Allongez-vous.
[pause 4s]
Jambes décroisées... pieds légèrement écartés.
[pause 4s]
Si vous avez une couverture... couvrez-vous maintenant.
[pause 3s]
Laissez votre corps se sentir protégé... au chaud... en sécurité.
[pause 8s]

Posez les mains sur votre ventre.
[pause 4s]
Juste là... au centre.
[pause 6s]

Avant de commencer...
[pause 3s]
Posez une intention pour ce temps.
[pause 4s]
Pas un objectif.
[pause 3s]
Juste une direction.
[pause 5s]
Qu'est-ce que vous venez chercher ici... aujourd'hui ?
[pause 12s]

Fermez les yeux.
[pause 8s]

Sans rien faire... laissez votre corps s'alourdir.
[pause 5s]

Sentez le poids de vos pieds.
[pause 4s]
Laissez-les s'enfoncer... comme si la surface sous vous les accueillait.
[pause 6s]

Remontez vers les mollets... les genoux... les cuisses.
[pause 5s]
Tout ça peut se déposer.
[pause 6s]

Le bas du dos.
[pause 4s]
Laissez-le s'ouvrir... s'étaler.
[pause 4s]
Il n'a pas à tenir quoi que ce soit.
[pause 7s]

Le ventre... la poitrine.
[pause 4s]
Peut-être une tension là... une retenue.
[pause 4s]
Laissez-la simplement être... sans la forcer à partir.
[pause 8s]

Les épaules... les bras... les mains.
[pause 4s]
Sentez leur poids.
[pause 7s]

Le cou... la nuque.
[pause 4s]
Le visage... la mâchoire... les yeux... le front.
[pause 5s]
Tout peut se déposer.
[pause 10s]

Vous êtes là.
[pause 5s]
Entier.
[pause 5s]
Présent.
[pause 12s]

Il y a quelque chose d'étrange dans notre époque.
[pause 4s]
Nous sommes constamment en mouvement... constamment connectés... constamment occupés.
[pause 5s]
Et pourtant... quelque chose en nous reste sans réponse.
[pause 8s]

Ce n'est pas un manque de volonté.
[pause 3s]
Ce n'est pas non plus un manque de travail.
[pause 6s]

C'est l'absence d'une chose simple... presque oubliée.
[pause 4s]
Se rencontrer soi-même.
[pause 9s]

Ce module ne vous demande pas de changer.
[pause 3s]
Il vous demande d'abord de voir.
[pause 3s]
Honnêtement.
[pause 3s]
Sans défense.
[pause 3s]
Sans jugement.
[pause 8s]

C'est par le corps que ce travail commence.
[pause 10s]

Nous allons pratiquer la Pause Souffle.
[pause 3s]
La méthode cinq-cinq-cinq.
[pause 5s]

Cinq secondes pour inspirer.
[pause 2s]
Cinq secondes pour bloquer.
[pause 2s]
Cinq secondes pour expirer.
[pause 4s]
Dix cycles.
[pause 2s]
Deux minutes et demie de présence pure.
[pause 6s]

À l'inspiration... laissez la mâchoire s'ouvrir doucement... comme si elle s'écartait d'elle-même.
[pause 4s]
Au blocage... bouche ouverte... dans ce silence suspendu.
[pause 4s]
À l'expiration... lèvres légèrement resserrées... comme on souffle sur une bougie sans vouloir l'éteindre.
[pause 6s]

Si l'esprit part... laissez-le partir.
[pause 3s]
Et revenez simplement... au souffle.
[pause 7s]

Nous commençons.
[BREATHING_CYCLES]
[pause 20s]

Ce calme... c'est vous.
[pause 5s]
Simplement vous.
[pause 15s]

Laissez le souffle reprendre son rythme naturel.
[pause 10s]

Restez là.
[pause 8s]
Sans rien faire.
[pause 12s]

Laissez venir une question... sans chercher la réponse.
[pause 8s]

Après quoi est-ce que je cours ?
[pause 15s]

Qu'est-ce que j'évite de ressentir... quand je reste en mouvement ?
[pause 15s]

Si je m'arrêtais vraiment... qu'est-ce qui serait encore là ?
[pause 18s]

Notez ce qui est venu... dans votre carnet.
[pause 4s]
Sans le juger.
[pause 5s]
Même si c'est juste un mot.
[pause 5s]
Même si c'est rien.
[pause 8s]

Vous venez de vous rencontrer.
[pause 6s]

Pour la première fois peut-être... ou à nouveau.
[pause 10s]

À très bientôt.
SCRIPT,

        // ─────────────────────────────────────────────────────────
        // MODULE 2 — "Je reconnais mes blessures" — cible : 14–16 min
        // ─────────────────────────────────────────────────────────
        '02-je-reconnais-mes-blessures' => <<<'SCRIPT'
Bienvenue.
[pause 6s]

Vous revenez.
[pause 4s]
C'est déjà quelque chose.
[pause 8s]

Installez-vous à nouveau.
[pause 3s]
Assis... dos droit mais pas rigide.
[pause 4s]
Comme un arbre... ancré et souple à la fois.
[pause 5s]
Pieds bien posés au sol.
[pause 4s]
Sentez leur contact... leur poids... leur chaleur.
[pause 7s]

Mains posées sur les cuisses... paumes vers le haut... ou vers le bas.
[pause 4s]
Ce qui vous semble juste.
[pause 8s]

Avant de commencer...
[pause 3s]
Posez une intention pour ce module.
[pause 5s]
Pas une résolution.
[pause 3s]
Juste une direction.
[pause 5s]
Peut-être simplement... être honnête avec moi-même pendant quelques minutes.
[pause 12s]

Fermez les yeux.
[pause 8s]

Prenez une grande inspiration... et en expirant... laissez descendre tout ce que vous portez depuis ce matin.
[pause 10s]

Sentez le poids de votre tête.
[pause 4s]
Laissez-la s'alléger légèrement... comme si quelqu'un la tenait pour vous.
[pause 6s]

La nuque... les épaules.
[pause 4s]
Vous n'avez rien à porter ici.
[pause 6s]

La poitrine.
[pause 4s]
Peut-être une tension là... peut-être un resserrement.
[pause 4s]
Ne cherchez pas à savoir d'où ça vient.
[pause 4s]
Juste... remarquez.
[pause 8s]

Le ventre.
[pause 4s]
Le ventre garde souvent ce que la tête ne veut pas entendre.
[pause 4s]
Sentez-le.
[pause 4s]
Sans lui demander quoi que ce soit.
[pause 10s]

Les bras... les mains.
[pause 4s]
Est-ce qu'elles sont crispées... ou ouvertes ?
[pause 6s]

Laissez-les s'ouvrir... légèrement.
[pause 8s]

Vous êtes là.
[pause 5s]
Présent.
[pause 5s]
Ouvert.
[pause 12s]

Ce module demande quelque chose de simple... mais de rare.
[pause 4s]
Il demande de regarder... sans fuir.
[pause 8s]

Nous portons tous des blessures.
[pause 5s]
Des mots entendus trop tôt... ou pas dit du tout.
[pause 5s]
Des absences qui ont été mal interprétées.
[pause 5s]
Des attentes que personne n'a remplies... parce que personne ne le savait.
[pause 8s]

Le corps garde tout ça.
[pause 4s]
Bien avant que la tête comprenne.
[pause 4s]
Bien après que la tête a oublié.
[pause 10s]

Ces blessures ne sont pas des défauts.
[pause 5s]
Elles sont des cartes.
[pause 5s]
Elles vous disent... où vous avez eu besoin de protection.
[pause 5s]
Et où... aujourd'hui... vous pouvez commencer à relâcher.
[pause 12s]

La première étape n'est pas de guérir.
[pause 4s]
C'est de voir.
[pause 4s]
Honnêtement.
[pause 4s]
Avec douceur.
[pause 10s]

C'est par le corps que nous allons avancer.
[pause 8s]

Nous allons pratiquer la méthode cinq-cinq-cinq.
[pause 5s]

Cinq secondes pour inspirer.
[pause 2s]
Cinq secondes pour bloquer.
[pause 2s]
Cinq secondes pour expirer.
[pause 4s]
Dix cycles.
[pause 2s]
Deux minutes et demie de présence pure.
[pause 6s]

À l'inspiration... laissez la mâchoire s'ouvrir doucement.
[pause 4s]
Au blocage... restez dans ce silence... et observez ce qui se passe.
[pause 4s]
À l'expiration... lèvres légèrement resserrées... laissez partir ce qui peut partir.
[pause 6s]

Si une émotion monte... laissez-la monter.
[pause 3s]
Elle ne fait que passer.
[pause 3s]
Et revenez simplement... au souffle.
[pause 7s]

Nous commençons.
[BREATHING_CYCLES]
[pause 20s]

Ce que vous venez de traverser...
[pause 5s]
c'est du courage.
[pause 15s]

Laissez le souffle reprendre son rythme.
[pause 10s]

Restez là.
[pause 8s]
Sans rien faire.
[pause 12s]

Portez maintenant votre attention sur une zone de votre corps.
[pause 5s]
Une zone qui porte encore quelque chose.
[pause 4s]
Peut-être la gorge.
[pause 3s]
Peut-être le ventre.
[pause 3s]
Peut-être la poitrine.
[pause 8s]

Ne cherchez pas à la faire partir.
[pause 5s]
Respirez simplement vers cet endroit.
[pause 5s]
Et dites-lui intérieurement...
[pause 4s]
Je te vois.
[pause 15s]

La blessure la plus difficile à regarder...
[pause 4s]
est souvent celle que l'on a transformée en force.
[pause 10s]

Laissez venir une question... sans chercher la réponse tout de suite.
[pause 8s]

Quelle blessure est-ce que je porte encore... sans l'avoir nommée ?
[pause 18s]

Est-ce que je me suis donné le droit... de ressentir ça ?
[pause 18s]

Qu'est-ce que ça changerait... si je posais ce poids... juste pour aujourd'hui ?
[pause 18s]

Notez ce qui est venu... dans votre carnet.
[pause 4s]
Sans le juger.
[pause 5s]
Même si c'est douloureux.
[pause 5s]
Surtout si c'est douloureux.
[pause 8s]

Avant de terminer...
[pause 4s]
je vous invite à écrire une lettre courte.
[pause 4s]
À la version de vous-même qui a été blessée.
[pause 5s]
Commencez simplement par ces mots.
[pause 4s]
Je te vois.
[pause 4s]
Et je comprends pourquoi tu t'es protégé.
[pause 10s]

Vous n'avez rien à réparer maintenant.
[pause 4s]
Juste à voir.
[pause 8s]

À très bientôt.
SCRIPT,

        // ─────────────────────────────────────────────────────────
        // MODULE 3 — "Je décris mon bonheur" — cible : 14–16 min
        // ─────────────────────────────────────────────────────────
        '03-je-decris-mon-bonheur' => <<<'SCRIPT'
Bienvenue.
[pause 6s]

Vous avez regardé vos blessures.
[pause 4s]
C'est rare.
[pause 4s]
C'est courageux.
[pause 8s]

Aujourd'hui... nous regardons de l'autre côté.
[pause 5s]
Ce qui vous nourrit.
[pause 4s]
Ce qui vous vivifie.
[pause 4s]
Ce que vous appelez... bonheur.
[pause 10s]

Installez-vous.
[pause 3s]
Assis... dos droit... ancré.
[pause 4s]
Pieds bien posés au sol.
[pause 4s]
Sentez-les... leur poids... leur solidité.
[pause 7s]

Mains posées sur les cuisses.
[pause 4s]
Ouvertes.
[pause 8s]

Avant de commencer...
[pause 3s]
Posez une intention.
[pause 5s]
Pas un objectif.
[pause 3s]
Une direction.
[pause 5s]
Peut-être... laisser de la place pour ce qui me rend vraiment vivant.
[pause 12s]

Fermez les yeux.
[pause 8s]

Prenez une grande inspiration... et en expirant... déposez tout ce que vous n'avez pas besoin de porter ici.
[pause 10s]

Sentez le poids de vos épaules.
[pause 4s]
Laissez-les descendre.
[pause 6s]

Le visage.
[pause 4s]
La mâchoire... les yeux... le front.
[pause 4s]
Tout peut se relâcher.
[pause 8s]

Le ventre.
[pause 4s]
Sentez le mouvement du souffle là-dedans.
[pause 4s]
Doux... régulier.
[pause 8s]

Vous êtes là.
[pause 5s]
Présent.
[pause 5s]
Ouvert à ce qui va venir.
[pause 12s]

Beaucoup de personnes savent précisément ce qu'elles ne veulent plus.
[pause 5s]
La fatigue.
[pause 3s]
Le bruit.
[pause 3s]
La pression constante.
[pause 5s]

Mais très peu savent décrire ce qu'elles veulent vraiment.
[pause 6s]

Ce n'est pas une critique.
[pause 4s]
C'est juste que personne ne nous a appris à regarder de ce côté-là.
[pause 8s]

Le bonheur n'est pas une destination abstraite.
[pause 5s]
Il est fait de moments concrets.
[pause 4s]
De sensations précises.
[pause 4s]
D'instants que le corps reconnaît... bien avant que la tête comprenne.
[pause 8s]

Si vous ne savez pas à quoi ressemble votre bonheur...
[pause 4s]
vous ne pouvez pas le reconnaître quand il arrive.
[pause 10s]

C'est par le corps que nous allons le retrouver.
[pause 8s]

Nous allons pratiquer la méthode cinq-cinq-cinq.
[pause 5s]

Cinq secondes pour inspirer.
[pause 2s]
Cinq secondes pour bloquer.
[pause 2s]
Cinq secondes pour expirer.
[pause 4s]
Dix cycles.
[pause 2s]
Deux minutes et demie de présence pure.
[pause 6s]

À l'inspiration... laissez la mâchoire s'ouvrir doucement.
[pause 4s]
Au blocage... restez dans ce silence... et observez ce qui se passe.
[pause 4s]
À l'expiration... lèvres légèrement resserrées... laissez partir ce qui peut partir.
[pause 6s]

Si l'esprit part... laissez-le partir.
[pause 3s]
Et revenez simplement... au souffle.
[pause 7s]

Nous commençons.
[BREATHING_CYCLES]
[pause 20s]

Ce calme... c'est vous.
[pause 5s]
Simplement vous.
[pause 15s]

Laissez le souffle reprendre son rythme naturel.
[pause 10s]

Restez là.
[pause 8s]
Sans rien faire.
[pause 12s]

Laissez maintenant venir un souvenir.
[pause 5s]
Un moment précis... où vous vous êtes senti pleinement vivant.
[pause 5s]
Pleinement vous-même.
[pause 8s]

Quel âge aviez-vous ?
[pause 8s]

Où étiez-vous ?
[pause 8s]

Qu'est-ce que vous ressentiez dans le corps... à cet instant précis ?
[pause 15s]

Ce souvenir est une boussole.
[pause 5s]
Il vous dit quelque chose d'essentiel... sur ce qui vous nourrit vraiment.
[pause 12s]

Pensez maintenant à une journée récente... qui vous a semblé juste.
[pause 5s]
Pas parfaite.
[pause 3s]
Juste... juste.
[pause 8s]

Qu'est-ce qui la rendait juste ?
[pause 12s]

Avec qui étiez-vous ?
[pause 12s]

Qu'est-ce que vous ressentiez le soir... en vous endormant ce jour-là ?
[pause 15s]

Ces éléments-là... sont votre bonheur réel.
[pause 5s]
Pas le bonheur qu'on vous a vendu.
[pause 4s]
Le vôtre.
[pause 12s]

Notez ce qui est venu... dans votre carnet.
[pause 4s]
Cinq phrases concrètes.
[pause 4s]
Pas de grands idéaux.
[pause 4s]
Des détails vrais.
[pause 5s]
Un lieu... une personne... une sensation... un moment de la journée.
[pause 8s]

Ce travail est rare.
[pause 4s]
Peu de personnes s'y arrêtent.
[pause 4s]
Vous venez de le faire.
[pause 8s]

À très bientôt.
SCRIPT,

        // ─────────────────────────────────────────────────────────
        // MODULE 4 — "J'écoute mon souffle" — cible : 14–16 min
        // ─────────────────────────────────────────────────────────
        '04-j-ecoute-mon-souffle' => <<<'SCRIPT'
Bienvenue.
[pause 6s]

Vous avez regardé qui vous êtes.
[pause 4s]
Vous avez regardé ce qui vous a blessé.
[pause 4s]
Vous avez regardé ce qui vous nourrit.
[pause 6s]

Ce module est différent.
[pause 5s]
Ici... on ne regarde plus.
[pause 4s]
On écoute.
[pause 10s]

Installez-vous.
[pause 3s]
Assis... dos droit... ancré.
[pause 4s]
Pieds posés au sol.
[pause 4s]
Sentez leur solidité.
[pause 7s]

Mains posées sur les cuisses... ouvertes.
[pause 8s]

Avant de commencer...
[pause 3s]
Posez une intention.
[pause 5s]
Peut-être... aujourd'hui je laisse le souffle me ramener à moi.
[pause 12s]

Fermez les yeux.
[pause 8s]

Prenez une grande inspiration... et en expirant... laissez tomber tout ce que vous portez depuis ce matin.
[pause 10s]

Sentez le poids du corps tout entier.
[pause 5s]
Des épaules... des bras... des mains.
[pause 6s]

Le ventre.
[pause 4s]
Sentez le mouvement du souffle.
[pause 4s]
Il était là avant que vous arriviez.
[pause 4s]
Il sera là après.
[pause 8s]

Vous êtes là.
[pause 5s]
Présent.
[pause 5s]
Prêt à écouter.
[pause 12s]

Il y a quelque chose de remarquable dans le souffle.
[pause 5s]
C'est le seul système du corps à la fois automatique... et conscient.
[pause 6s]

Votre cœur bat sans que vous le décidiez.
[pause 4s]
Votre digestion se fait sans votre permission.
[pause 5s]

Mais le souffle...
[pause 4s]
vous pouvez le choisir.
[pause 4s]
Maintenant.
[pause 4s]
Et en quelques cycles... modifier totalement votre état intérieur.
[pause 8s]

Ce n'est pas une métaphore.
[pause 4s]
C'est physiologique.
[pause 5s]
Quand vous expirez lentement... vous activez le nerf vague.
[pause 4s]
Le système nerveux passe du mode alarme... au mode présence.
[pause 4s]
En quelques secondes.
[pause 4s]
Sans rien d'autre.
[pause 10s]

C'est là que réside un pouvoir discret.
[pause 4s]
Pas le pouvoir de contrôler les autres.
[pause 4s]
Pas celui de dominer les circonstances.
[pause 5s]
Le pouvoir de revenir à vous-même.
[pause 4s]
En toutes circonstances.
[pause 10s]

C'est par le corps que nous allons aller plus loin.
[pause 8s]

Nous allons pratiquer la méthode cinq-cinq-cinq.
[pause 5s]

Cinq secondes pour inspirer.
[pause 2s]
Cinq secondes pour bloquer.
[pause 2s]
Cinq secondes pour expirer.
[pause 4s]
Dix cycles.
[pause 2s]
Deux minutes et demie de présence pure.
[pause 6s]

À l'inspiration... laissez la mâchoire s'ouvrir doucement.
[pause 4s]
Au blocage... restez dans ce silence... observez ce qui se passe à l'intérieur.
[pause 4s]
À l'expiration... lèvres légèrement resserrées... laissez partir ce qui peut partir.
[pause 6s]

Cette fois... pendant les cycles... posez une question silencieuse.
[pause 4s]
Juste une.
[pause 4s]
Qu'est-ce que mon souffle essaie de me dire en ce moment ?
[pause 6s]

Pas besoin de réponse.
[pause 3s]
Juste la question.
[pause 7s]

Nous commençons.
[BREATHING_CYCLES]
[pause 20s]

Ce calme... c'est vous.
[pause 5s]
Simplement vous.
[pause 15s]

Laissez le souffle reprendre son rythme naturel.
[pause 10s]

Restez là.
[pause 8s]
Sans rien faire.
[pause 12s]

Qu'est-ce qui est venu pendant les cycles ?
[pause 8s]
Une image... un mot... une sensation... rien ?
[pause 8s]
Tout est juste.
[pause 12s]

Le souffle est votre état de référence.
[pause 5s]
Apaisé.
[pause 3s]
Présent.
[pause 3s]
Ancré.
[pause 8s]

Vous pouvez y revenir... à tout moment.
[pause 5s]
En trois cycles... avant une réunion difficile.
[pause 4s]
Après une tension.
[pause 4s]
Le matin... avant que le monde entre.
[pause 4s]
Le soir... avant de fermer les yeux.
[pause 10s]

C'est maintenant votre outil.
[pause 4s]
Et bientôt... celui que vous transmettrez.
[pause 8s]

Notez ce qui est venu... dans votre carnet.
[pause 4s]
Ce que le souffle vous a dit.
[pause 5s]
Même si c'est juste un ressenti.
[pause 8s]

À très bientôt.
SCRIPT,

        // ─────────────────────────────────────────────────────────
        // MODULE 5 — "Je découvre ma mission" — cible : 15–17 min
        // ─────────────────────────────────────────────────────────
        '05-je-decouvre-ma-mission' => <<<'SCRIPT'
Bienvenue.
[pause 6s]

Quatre modules.
[pause 4s]
Vous vous êtes rencontré.
[pause 4s]
Vous avez regardé vos blessures.
[pause 4s]
Vous avez décrit ce qui vous nourrit.
[pause 4s]
Vous avez écouté votre corps.
[pause 8s]

Aujourd'hui... une seule question.
[pause 5s]
La plus rare.
[pause 5s]
La plus précieuse.
[pause 8s]

Pourquoi suis-je là ?
[pause 12s]

Installez-vous.
[pause 3s]
Assis... dos droit... ancré.
[pause 4s]
Pieds bien posés au sol.
[pause 5s]
Sentez leur poids... leur chaleur... leur présence.
[pause 7s]

Mains posées sur les cuisses... ouvertes.
[pause 8s]

Avant de commencer...
[pause 3s]
Posez une intention.
[pause 5s]
Peut-être... aujourd'hui je laisse venir ce que je sais déjà... sans le filtrer.
[pause 12s]

Fermez les yeux.
[pause 8s]

Prenez une grande inspiration... et en expirant... laissez tomber tout ce que vous croyez devoir être.
[pause 10s]

Vos rôles.
[pause 4s]
Vos responsabilités.
[pause 4s]
Ce qu'on attend de vous.
[pause 6s]
Déposez tout ça... juste pour ce moment.
[pause 10s]

Le visage... la mâchoire... les épaules.
[pause 5s]
Tout peut se relâcher.
[pause 7s]

Le ventre.
[pause 4s]
Sentez le mouvement du souffle.
[pause 4s]
Doux... régulier... fidèle.
[pause 8s]

Vous êtes là.
[pause 5s]
Présent.
[pause 5s]
Prêt à entendre.
[pause 12s]

La réponse à votre mission n'est pas dans un diplôme.
[pause 5s]
Pas dans un titre.
[pause 4s]
Pas dans ce que les autres attendent de vous.
[pause 6s]

Elle est dans l'intersection de trois choses.
[pause 5s]

Ce que vous avez traversé.
[pause 6s]

Ce qui vous vient naturellement... et qui semble évident pour vous... mais pas pour les autres.
[pause 6s]

Et ce dont le monde autour de vous a besoin.
[pause 10s]

La mission ne s'invente pas.
[pause 5s]
Elle se reconnaît.
[pause 10s]

C'est par le corps que nous allons l'approcher.
[pause 8s]

Nous allons pratiquer la méthode cinq-cinq-cinq.
[pause 5s]

Cinq secondes pour inspirer.
[pause 2s]
Cinq secondes pour bloquer.
[pause 2s]
Cinq secondes pour expirer.
[pause 4s]
Dix cycles.
[pause 2s]
Deux minutes et demie de présence pure.
[pause 6s]

À l'inspiration... laissez la mâchoire s'ouvrir doucement.
[pause 4s]
Au blocage... restez dans ce silence... et laissez monter ce qui veut monter.
[pause 4s]
À l'expiration... laissez partir ce qui n'est pas à vous.
[pause 6s]

Pendant les cycles... posez cette question silencieuse au corps.
[pause 5s]
Pour qui suis-je fait... vraiment ?
[pause 7s]

Nous commençons.
[BREATHING_CYCLES]
[pause 20s]

Ce calme... c'est vous.
[pause 5s]
Simplement vous.
[pause 15s]

Laissez le souffle reprendre son rythme naturel.
[pause 10s]

Restez là.
[pause 8s]
Sans rien faire.
[pause 12s]

Laissez venir maintenant un souvenir.
[pause 6s]
Un moment où vous avez aidé quelqu'un.
[pause 5s]
Pas parce qu'on vous le demandait.
[pause 4s]
Parce que vous ne pouviez pas faire autrement.
[pause 10s]

Qu'est-ce que vous leur avez apporté à ce moment-là ?
[pause 15s]

Est-ce que ça vous a coûté quelque chose... ou est-ce que ça vous a nourri ?
[pause 15s]

Pensez maintenant à quelque chose que vous faites... avec une facilité que vous trouvez normale.
[pause 5s]
Quelque chose d'évident pour vous.
[pause 5s]
Mais que les autres semblent trouver difficile.
[pause 15s]

Et pensez à une épreuve traversée.
[pause 5s]
Pas pour la revivre.
[pause 4s]
Mais pour voir ce qu'elle vous a appris... que vous n'auriez pas compris autrement.
[pause 15s]

Ces trois choses ensemble...
[pause 5s]
le don naturel... l'épreuve transformée... le besoin que vous voyez chez les autres...
[pause 5s]
c'est souvent là que la mission se cache.
[pause 12s]

Vous n'avez pas à tout comprendre aujourd'hui.
[pause 5s]
La mission se révèle en marchant.
[pause 4s]
En servant.
[pause 4s]
En transmettant.
[pause 8s]

Notez ce qui est venu... dans votre carnet.
[pause 4s]
Puis complétez cette phrase.
[pause 5s]
Ma présence dans la vie des autres... permet à...
[pause 15s]

Laissez venir ce qui vient.
[pause 5s]
Sans le corriger.
[pause 5s]
Sans le juger.
[pause 8s]

Vous avez fait un travail rare.
[pause 4s]
Il en restera quelque chose.
[pause 8s]

À très bientôt... pour le dernier module.
SCRIPT,

        // ─────────────────────────────────────────────────────────
        // MODULE 6 — "Je pratique le rituel" — cible : 16–18 min
        // ─────────────────────────────────────────────────────────
        '07-je-transmets-le-rituel' => <<<'SCRIPT'
Bienvenue.
[pause 6s]

C'est le dernier module.
[pause 5s]

Pas parce que le chemin s'arrête.
[pause 4s]
Mais parce que quelque chose a changé.
[pause 4s]
Et qu'à partir d'aujourd'hui... vous marchez différemment.
[pause 12s]

Installez-vous.
[pause 3s]
Assis... dos droit mais vivant.
[pause 4s]
Pas la rigidité d'une posture parfaite.
[pause 3s]
La solidité de quelqu'un qui sait qu'il a quelque chose à offrir.
[pause 7s]

Pieds bien posés au sol.
[pause 4s]
Sentez leur contact... leur ancrage.
[pause 5s]
Ces pieds ont porté tout ce que vous avez traversé.
[pause 7s]

Mains posées sur les cuisses... ouvertes.
[pause 8s]

Avant de commencer...
[pause 3s]
Posez une intention pour ce dernier module.
[pause 5s]
Peut-être... aujourd'hui je reçois ce que j'ai semé.
[pause 5s]
Ou simplement... je laisse ce chemin me transformer pour de bon.
[pause 12s]

Fermez les yeux.
[pause 8s]

Prenez une grande inspiration... et en expirant... laissez descendre toute l'agitation de la semaine.
[pause 10s]

Sentez le poids de la tête.
[pause 4s]
Les épaules... les bras... les mains.
[pause 5s]
Laissez-les s'alourdir.
[pause 7s]

Le ventre.
[pause 4s]
Il a gardé beaucoup de choses pendant ces modules.
[pause 4s]
Aujourd'hui... laissez-le s'ouvrir.
[pause 8s]

Les jambes... les pieds.
[pause 4s]
Entier.
[pause 4s]
Présent.
[pause 4s]
Ici.
[pause 12s]

Repensez un instant au premier module.
[pause 5s]
Vous vous souvenez de ce que vous avez ressenti... la première fois que vous vous êtes installé pour écouter ?
[pause 8s]

Ce n'était pas la même personne.
[pause 5s]
Ou plutôt... c'était vous.
[pause 4s]
Mais vous ne le saviez pas encore.
[pause 10s]

Vous vous êtes rencontré.
[pause 5s]
Vous avez regardé vos blessures... sans fuite.
[pause 5s]
Vous avez décrit ce qui vous nourrit vraiment.
[pause 5s]
Vous avez écouté ce que votre souffle essayait de vous dire.
[pause 5s]
Vous avez touché quelque chose qui ressemblait à votre mission.
[pause 10s]

Ce n'est pas une formation.
[pause 5s]
C'est une rencontre avec vous-même.
[pause 5s]
Et ça... aucune somme d'argent ne peut l'acheter.
[pause 5s]
Ça ne s'achète pas.
[pause 4s]
Ça se traverse.
[pause 12s]

Ce module n'est pas une conclusion.
[pause 5s]
C'est une transmission.
[pause 8s]

Ce que vous avez vécu ici...
[pause 4s]
des personnes autour de vous en ont besoin.
[pause 5s]
Pas pour qu'elles fassent la même chose que vous.
[pause 4s]
Mais pour qu'elles trouvent... leur propre chemin.
[pause 8s]

La présence que vous avez cultivée ici...
[pause 4s]
le calme que vous touchez pendant les cycles...
[pause 4s]
la façon dont vous regardez maintenant ce qui se passe en vous...
[pause 5s]
tout ça se transmet.
[pause 5s]
Sans effort.
[pause 4s]
Par contagion.
[pause 10s]

Un praticien ne guide pas les autres vers la sagesse.
[pause 5s]
Il guide les autres vers eux-mêmes.
[pause 5s]
Et c'est infiniment plus puissant.
[pause 12s]

C'est par le corps que nous allons sceller ce chemin.
[pause 8s]

Nous allons pratiquer la méthode cinq-cinq-cinq une dernière fois ici.
[pause 5s]

Cinq secondes pour inspirer.
[pause 2s]
Cinq secondes pour bloquer.
[pause 2s]
Cinq secondes pour expirer.
[pause 4s]
Dix cycles.
[pause 2s]
Deux minutes et demie... pour intégrer tout ce qui a été semé.
[pause 6s]

À l'inspiration... laissez la mâchoire s'ouvrir doucement.
[pause 4s]
Au blocage... restez dans ce silence... et laissez remonter ce que vous avez reçu.
[pause 4s]
À l'expiration... lèvres légèrement resserrées... laissez partir ce qui n'appartient plus à qui vous êtes maintenant.
[pause 6s]

Pendant les cycles... ne cherchez rien.
[pause 4s]
Laissez juste venir cette question... en douceur.
[pause 4s]
Qu'est-ce que je tiens maintenant... que je ne tenais pas au début ?
[pause 7s]

Nous commençons.
[BREATHING_CYCLES]
[pause 20s]

Ce calme... c'est vous.
[pause 5s]
Simplement vous.
[pause 15s]

Laissez le souffle reprendre son rythme naturel.
[pause 10s]

Restez là.
[pause 8s]
Sans rien faire.
[pause 12s]

Qu'est-ce qui est venu pendant les cycles ?
[pause 8s]
Un mot... une image... un nom... une certitude ?
[pause 8s]
Tout est juste.
[pause 12s]

Vous n'êtes plus un chercheur.
[pause 6s]
Vous êtes un passeur.
[pause 10s]

Un passeur ne possède pas la vérité.
[pause 5s]
Il crée les conditions pour que l'autre la trouve en lui-même.
[pause 5s]
Come vous venez de le faire... pour vous-même.
[pause 10s]

Le rituel que vous allez pratiquer... et transmettre...
[pause 4s]
n'est pas une technique.
[pause 4s]
C'est une présence.
[pause 4s]
Votre présence.
[pause 4s]
Avec ce que vous avez traversé.
[pause 4s]
Avec ce que vous avez compris.
[pause 4s]
Avec ce que vous portez maintenant.
[pause 12s]

Laissez venir une dernière question... sans chercher la réponse immédiatement.
[pause 8s]

À qui est-ce que je dois transmettre ce que j'ai reçu ?
[pause 18s]

Qu'est-ce que je veux que les personnes que j'accompagne... ressentent en ma présence ?
[pause 18s]

Quel est le premier geste concret... que je pose dès demain ?
[pause 18s]

Notez ce qui est venu... dans votre carnet.
[pause 4s]
Sans le corriger.
[pause 4s]
Sans le réduire.
[pause 8s]

Avant de terminer...
[pause 5s]
une phrase.
[pause 5s]
Celle qui m'a accompagné depuis le début.
[pause 6s]

J'ai couru très longtemps.
[pause 5s]
J'ai tout arrêté.
[pause 5s]
Et c'est là que j'ai tout trouvé.
[pause 5s]
Et infiniment plus.
[pause 15s]

Ce que vous avez touché ici... dans ces modules...
[pause 5s]
vous allez maintenant le vivre avec votre corps entier.
[pause 5s]
Dans l'espace.
[pause 4s]
Dans la nature.
[pause 4s]
Avec du silence vrai... et une vue que vous n'oublierez jamais.
[pause 8s]

La retraite est la continuation de ce chemin.
[pause 5s]
Non pas pour apprendre quelque chose de nouveau.
[pause 4s]
Mais pour que ce que vous avez compris... entre dans chaque cellule de votre corps.
[pause 10s]

Votre attestation Praticien Pause Souffle est maintenant disponible dans votre espace.
[pause 6s]

Vous l'avez gagnée.
[pause 5s]
Pas parce que vous avez écouté six modules.
[pause 5s]
Mais parce que vous avez eu le courage de vous arrêter.
[pause 5s]
De regarder.
[pause 4s]
D'écouter.
[pause 4s]
Et de rester.
[pause 12s]

Merci.
[pause 8s]
Vraiment.
SCRIPT,

        // ─────────────────────────────────────────────────────────
        // PARCOURS 1 — Module 03 — J'accepte ce que je ne peux pas changer
        // ─────────────────────────────────────────────────────────
        '03-j-accepte-mes-limites' => <<<'SCRIPT'
Installez-vous confortablement.
[pause 5s]
Dos droit... mais pas rigide.
[pause 4s]
Pieds posés au sol.
[pause 4s]
Mains sur les genoux... paumes vers le haut.
[pause 8s]

Avant de commencer...
[pause 3s]
Posez une intention pour ce module.
[pause 5s]
Qu'est-ce que vous venez toucher ici... aujourd'hui ?
[pause 10s]

Fermez les yeux.
[pause 8s]

Laissez votre corps s'alourdir naturellement.
[pause 5s]
Les épaules... les bras.
[pause 5s]
Le ventre... la poitrine.
[pause 5s]
Tout peut se déposer.
[pause 10s]

Il y a quelque chose que vous portez depuis longtemps.
[pause 6s]
Quelque chose que vous avez essayé de changer... encore... et encore.
[pause 5s]
Et qui n'a pas changé.
[pause 8s]

Ce module ne vous demande pas d'être fort.
[pause 5s]
Il vous demande quelque chose de plus difficile.
[pause 5s]
Il vous demande de lâcher.
[pause 12s]

Épictète était esclave.
[pause 6s]
Il n'avait aucun pouvoir sur sa condition extérieure.
[pause 5s]
Aucun.
[pause 5s]
Et pourtant... il a formulé une vérité qui traverse deux mille ans d'histoire.
[pause 8s]

Il y a ce qui dépend de nous.
[pause 5s]
Et ce qui ne dépend pas de nous.
[pause 8s]
Cette distinction... aussi simple qu'elle paraît...
[pause 5s]
est l'une des clés les plus puissantes que la philosophie ait jamais produites.
[pause 10s]

Posez cette question dans votre corps... maintenant.
[pause 6s]
Qu'est-ce que vous portez... que vous ne pouvez pas changer ?
[pause 8s]
Pas dans votre tête.
[pause 4s]
Dans votre corps.
[pause 4s]
Où est-ce que vous le sentez ?
[pause 4s]
Dans la gorge ?
[pause 3s]
Dans la poitrine ?
[pause 3s]
Dans les épaules ?
[pause 8s]

Restez avec cette sensation.
[pause 5s]
Ne la combattez pas.
[pause 5s]
Ne cherchez pas à la résoudre.
[pause 5s]
Observez-la simplement... comme on observe un nuage dans le ciel.
[pause 12s]

La thérapie ACT — Acceptance and Commitment Therapy —
[pause 4s]
a démontré dans plus de trois cents études ce qu'Épictète savait par l'expérience.
[pause 6s]
La résistance à ce qu'on ne peut pas changer... amplifie la souffrance.
[pause 5s]
Ce n'est pas la réalité qui brise les gens.
[pause 5s]
C'est la lutte contre la réalité.
[pause 10s]

Viktor Frankl... dans les camps... a découvert la même vérité par le fond.
[pause 6s]
Entre le stimulus et la réponse... il y a un espace.
[pause 5s]
Dans cet espace... réside notre liberté.
[pause 5s]
Notre dignité.
[pause 5s]
Notre pouvoir ultime.
[pause 12s]

C'est par le corps que nous allons traverser ça.
[pause 8s]

Nous allons pratiquer la méthode cinq-cinq-cinq.
[pause 5s]

Cinq secondes pour inspirer.
[pause 2s]
Cinq secondes pour bloquer.
[pause 2s]
Cinq secondes pour expirer.
[pause 4s]
Dix cycles.
[pause 2s]
Deux minutes et demie de présence pure.
[pause 6s]

À l'inspiration... laissez la mâchoire s'ouvrir doucement.
[pause 4s]
Au blocage... restez dans ce silence... et observez ce qui se passe.
[pause 4s]
À l'expiration... lèvres légèrement resserrées... laissez partir ce qui peut partir.
[pause 6s]

Si une résistance monte pendant les cycles... laissez-la simplement être.
[pause 3s]
C'est ainsi.
[pause 4s]

Si l'esprit part... laissez-le partir.
[pause 3s]
Et revenez simplement... au souffle.
[pause 7s]

Nous commençons.
[BREATHING_CYCLES]
[pause 20s]

Ce calme... c'est vous.
[pause 5s]
Simplement vous.
[pause 15s]

Laissez le souffle reprendre son rythme naturel.
[pause 10s]

Restez là.
[pause 8s]
Sans rien faire.
[pause 12s]

Pensez à quelque chose que vous ne pouvez pas changer.
[pause 5s]
Une situation... une personne... un fait du passé... une limite physique.
[pause 8s]
Sentez la résistance que votre corps génère face à cette réalité.
[pause 6s]
La tension.
[pause 4s]
L'urgence de faire quelque chose.
[pause 8s]

Et maintenant... dites intérieurement... simplement...
[pause 5s]
C'est ainsi.
[pause 8s]
Pas résigné.
[pause 5s]
Pas vaincu.
[pause 5s]
Juste... lucide.
[pause 5s]
C'est ainsi.
[pause 15s]

Qu'est-ce que vous portez... que vous ne pouvez pas changer... mais que vous continuez à porter comme si vous le pouviez ?
[pause 18s]

Qu'est-ce qui serait libéré en vous si vous vous permettiez de dire vraiment... C'est ainsi ?
[pause 18s]

Notez ce qui est venu... dans votre carnet.
[pause 5s]
Même si c'est juste un mot.
[pause 8s]

Les exercices vous attendent.
[pause 8s]
SCRIPT,

        // ─────────────────────────────────────────────────────────
        // PARCOURS 1 — Module 04 — Je reconnais ce qui me draine
        // ─────────────────────────────────────────────────────────
        '04-je-reconnais-ce-qui-me-draine' => <<<'SCRIPT'
Installez-vous.
[pause 5s]
Dos droit... mais pas rigide.
[pause 4s]
Pieds posés au sol.
[pause 5s]
Fermez les yeux si c'est naturel.
[pause 8s]

Avant de commencer...
[pause 3s]
Observez honnêtement comment vous arrivez ici.
[pause 5s]
Fatigué... ou présent ?
[pause 5s]
Agité... ou calme ?
[pause 5s]
Il n'y a pas de bonne réponse.
[pause 5s]
Juste une observation honnête.
[pause 10s]

Laissez les épaules descendre.
[pause 5s]
Le ventre se relâcher.
[pause 5s]
Tout peut se déposer pour un moment.
[pause 10s]

La plupart des gens qui se sentent épuisés croient qu'ils manquent de temps.
[pause 6s]
Ils ont tort.
[pause 5s]
Ils manquent d'énergie.
[pause 5s]
Et ce n'est pas le même problème.
[pause 10s]

Jim Loehr et Tony Schwartz ont passé vingt ans à studier les athlètes de haut niveau.
[pause 6s]
Et ce qu'ils ont découvert ne concernait pas le sport.
[pause 5s]
Ça concernait tout le monde.
[pause 6s]
La performance humaine n'est pas limitée par le temps... ni par la volonté.
[pause 5s]
Elle est limitée par l'énergie.
[pause 5s]
Et l'énergie a quatre réservoirs.
[pause 8s]

Le réservoir physique.
[pause 4s]
Le sommeil... le mouvement... la nutrition... la respiration.
[pause 8s]
Le réservoir émotionnel.
[pause 4s]
Les relations... les émotions non digérées... le deuil non fait.
[pause 8s]
Le réservoir mental.
[pause 4s]
La charge cognitive... les décisions non prises... les pensées en boucle.
[pause 8s]
Et le réservoir de sens.
[pause 4s]
La question de pourquoi... ce que je fais a de la valeur.
[pause 10s]

Chacun de ces réservoirs peut être percé.
[pause 6s]
Et souvent... il l'est.
[pause 5s]
Par des drains que vous n'avez jamais cartographiés.
[pause 10s]

Je vous invite maintenant à un scan.
[pause 6s]
Prenez votre vie comme elle est aujourd'hui... pas comme vous voudriez qu'elle soit.
[pause 6s]
Et posez-vous cette question.
[pause 5s]
Qu'est-ce qui me vide ?
[pause 8s]

Les personnes dans votre vie.
[pause 5s]
Y en a-t-il qui vous laissent épuisé... après chaque interaction ?
[pause 6s]
Remarquez la sensation dans votre corps en pensant à elles.
[pause 8s]

Les environnements.
[pause 5s]
Y a-t-il des lieux... des situations... qui consomment votre énergie sans vous en redonner ?
[pause 8s]

Le numérique.
[pause 5s]
Combien d'heures par jour votre attention est-elle fragmentée... dispersée... volée ?
[pause 8s]

Les pensées.
[pause 5s]
La rumination... les scénarios catastrophes... les conversations imaginaires.
[pause 5s]
Ce travail invisible que le cerveau fait sans vous en demander la permission.
[pause 8s]

Et les engagements.
[pause 5s]
Ce à quoi vous avez dit oui... et qui vous coûte plus que vous ne le reconnaissez.
[pause 10s]

Restez un moment avec ce qui est apparu.
[pause 8s]
Sans vous juger.
[pause 5s]
Sans résoudre.
[pause 5s]
Juste voir.
[pause 12s]

Emily et Amelia Nagoski ont documenté quelque chose d'essentiel.
[pause 6s]
Le cycle du stress.
[pause 5s]
Quand une menace est perçue... le corps déclenche une réponse biologique complète.
[pause 5s]
Cortisol... adrénaline... tension musculaire.
[pause 5s]
Prêt à combattre ou à fuir.
[pause 8s]
Le problème n'est pas le stress.
[pause 5s]
C'est que nous ne complétons jamais le cycle.
[pause 5s]
Nous gérons la situation... mais nous ne libérons pas le corps.
[pause 5s]
Et le stress non complété s'accumule.
[pause 5s]
Il devient charge allostatique.
[pause 5s]
Il se transforme en fatigue chronique... en épuisement... en maladie.
[pause 10s]

Ce module vous donne les outils pour cartographier... mesurer... et décontaminer.
[pause 5s]
Pas théoriquement.
[pause 5s]
Concrètement.
[pause 5s]
Domaine par domaine.
[pause 5s]
Drain par drain.
[pause 10s]

C'est par le corps que nous allons traverser ça.
[pause 8s]

Nous allons pratiquer la méthode cinq-cinq-cinq.
[pause 5s]

Cinq secondes pour inspirer.
[pause 2s]
Cinq secondes pour bloquer.
[pause 2s]
Cinq secondes pour expirer.
[pause 4s]
Dix cycles.
[pause 2s]
Deux minutes et demie de présence pure.
[pause 6s]

À l'inspiration... laissez la mâchoire s'ouvrir doucement.
[pause 4s]
Au blocage... restez dans ce silence... et observez ce qui se passe.
[pause 4s]
À l'expiration... lèvres légèrement resserrées... laissez partir ce qui peut partir.
[pause 6s]

Pendant les cycles... remarquez si la fatigue change de forme.
[pause 3s]
Où est-ce que vous la sentez ?
[pause 4s]

Si l'esprit part... laissez-le partir.
[pause 3s]
Et revenez simplement... au souffle.
[pause 7s]

Nous commençons.
[BREATHING_CYCLES]
[pause 20s]

Ce calme... c'est vous.
[pause 5s]
Simplement vous.
[pause 15s]

Laissez le souffle reprendre son rythme naturel.
[pause 10s]

Restez là.
[pause 8s]
Sans rien faire.
[pause 12s]

Lequel de vos quatre réservoirs est le plus percé en ce moment ?
[pause 18s]

Quelle personne... quel environnement... quelle habitude vous vide le plus ?
[pause 18s]

Quelle est UNE chose que vous pourriez décontaminer cette semaine ?
[pause 18s]

Notez ce qui est venu... dans votre carnet.
[pause 5s]
Même si c'est juste un mot.
[pause 8s]

Les exercices vous attendent.
[pause 5s]
Ce que vous allez mesurer dans les prochains jours...
[pause 5s]
va changer votre rapport à votre propre énergie.
[pause 8s]
SCRIPT,

        // ─────────────────────────────────────────────────────────
        // PARCOURS 1 — Module 06 — J'incarne ma Vision
        // ─────────────────────────────────────────────────────────
        '06-je-visualise-ma-vie' => <<<'SCRIPT'
Installez-vous confortablement.
[pause 5s]
Fermez les yeux.
[pause 5s]
Posez les mains sur vos cuisses.
[pause 5s]
Sentez le poids de votre corps.
[pause 8s]

Avant de commencer...
[pause 3s]
Posez une intention.
[pause 5s]
Peut-être simplement... aujourd'hui je laisse venir ce qui est vrai.
[pause 10s]

Laissez les épaules descendre.
[pause 5s]
Le visage se relâcher.
[pause 5s]
Presque comme si vous vous installeriez pour regarder quelque chose d'important.
[pause 10s]

Ce module travaille dans l'espace le plus intime qui soit.
[pause 6s]
Celui de votre vision.
[pause 5s]
De ce que vous voulez vraiment.
[pause 5s]
Pas ce que les autres espèrent pour vous.
[pause 5s]
Pas ce que la société valorise par défaut.
[pause 6s]
Ce que vous... ressentez comme juste depuis votre intérieur le plus profond.
[pause 12s]

Une vision n'est pas un objectif.
[pause 6s]
Un objectif est une destination sur une carte.
[pause 5s]
Une vision est le sentiment d'être vivant dans sa propre vie.
[pause 6s]
Elle précède les mots.
[pause 5s]
Elle précède les plans.
[pause 5s]
Elle est une boussole intérieure.
[pause 10s]

Je vous invite à un voyage.
[pause 6s]
Imaginez que cinq ans se sont écoulés.
[pause 5s]
Cinq ans de présence... de choix conscients... de courage.
[pause 8s]

Où êtes-vous ?
[pause 5s]
Pas l'adresse exacte.
[pause 4s]
La texture de l'endroit.
[pause 4s]
L'atmophère.
[pause 4s]
Ce que vous voyez autour de vous le matin quand vous vous réveillez.
[pause 10s]

Avec qui êtes-vous ?
[pause 5s]
Quelles relations ont de la profondeur dans cette vie ?
[pause 5s]
Qui est présent ?
[pause 5s]
Qui a disparu ?
[pause 10s]

Que faites-vous de vos journées ?
[pause 5s]
Pas un planning.
[pause 4s]
Une sensation.
[pause 4s]
Est-ce que vous vous levez avec de l'élan ?
[pause 5s]
Est-ce que ce que vous faites a du sens... pour vous... et pour quelqu'un d'autre ?
[pause 10s]

Quel est votre état intérieur habituel dans cette vie-là ?
[pause 6s]
Pas parfaite.
[pause 5s]
Mais alignée.
[pause 10s]

Restez dans cette image un moment.
[pause 8s]
Laissez-la prendre de la substance.
[pause 5s]
Des couleurs.
[pause 5s]
Des sons.
[pause 5s]
Des odeurs.
[pause 5s]
L'air de cette vie sur votre peau.
[pause 15s]

Cette image n'est pas un fantasme.
[pause 6s]
C'est une information.
[pause 5s]
Votre système nerveux vient de vous montrer quelque chose que votre intellect garde souvent en réserve.
[pause 8s]

La clarté... le courage... la discipline.
[pause 5s]
Ce sont les trois piliers qui relient où vous êtes maintenant... à cette image.
[pause 5s]
Pas les talents.
[pause 5s]
Pas les circonstances.
[pause 5s]
Pas la chance.
[pause 6s]
La clarté.
[pause 4s]
Le courage.
[pause 4s]
La discipline.
[pause 12s]

C'est par le corps que nous allons ancrer cette vision.
[pause 8s]

Nous allons pratiquer la méthode cinq-cinq-cinq.
[pause 5s]

Cinq secondes pour inspirer.
[pause 2s]
Cinq secondes pour bloquer.
[pause 2s]
Cinq secondes pour expirer.
[pause 4s]
Dix cycles.
[pause 2s]
Deux minutes et demie de présence pure.
[pause 6s]

À l'inspiration... laissez la mâchoire s'ouvrir doucement.
[pause 4s]
Au blocage... restez dans ce silence... et laissez l'image de cette vie prendre de la substance.
[pause 4s]
À l'expiration... lèvres légèrement resserrées... laissez partir ce qui n'appartient pas à cette vision.
[pause 6s]

Si l'esprit part... laissez-le partir.
[pause 3s]
Et revenez simplement... au souffle.
[pause 7s]

Nous commençons.
[BREATHING_CYCLES]
[pause 20s]

Ce calme... c'est vous.
[pause 5s]
Simplement vous.
[pause 15s]

Laissez le souffle reprendre son rythme naturel.
[pause 10s]

Restez là.
[pause 8s]
Sans rien faire.
[pause 12s]

Qu'est-ce que votre vision vous demande de commencer... vraiment commencer ?
[pause 18s]

Qu'est-ce qu'elle vous demande d'arrêter ?
[pause 18s]

Si vous viviez selon cette vision demain matin... qu'est-ce qui serait différent dans votre journée ?
[pause 18s]

Notez ce qui est venu... dans votre carnet.
[pause 5s]
Cinq phrases concrètes.
[pause 8s]

Les exercices vont transformer cette vision en intention concrète.
[pause 5s]
Prenez-les au sérieux.
[pause 8s]
SCRIPT,

        // ─────────────────────────────────────────────────────────
        // PRATICIEN — Module 07 — Je maîtrise la Vision — Pratique Avancée
        // ─────────────────────────────────────────────────────────
        '07-je-maitrise-la-vision' => <<<'SCRIPT'
Installez-vous.
[pause 5s]

Vous avez appris à voir.
[pause 5s]
Aujourd'hui... vous apprenez à tenir.
[pause 5s]
Tenir une vision dans le temps.
[pause 5s]
Même quand la peur revient.
[pause 5s]
Même quand le doute s'installe.
[pause 5s]
Même quand la réalité résiste.
[pause 10s]

Dr Joe Dispenza dit que le cerveau ne fait pas la différence entre une expérience vécue et une expérience profondément imaginée.
[pause 5s]
Si vous voyez précisément... avec émotion... avec répétition...
[pause 4s]
le cerveau commence à construire les routes neuronales de cette réalité.
[pause 5s]
Avant même qu'elle existe.
[pause 10s]

La maîtrise de la vision, c'est cela.
[pause 5s]
Pas une pensée positive.
[pause 4s]
Un entraînement neuronal.
[pause 8s]

Fermez les yeux.
[pause 6s]

Respiration consciente... lente.
[pause 4s]
Inspir par le nez.
[pause 5s]
Expir par la bouche.
[pause 5s]
Trois cycles.
[pause 15s]

Maintenant... faites apparaître la scène.
[pause 5s]
La scène de votre vision... la plus précise possible.
[pause 5s]
Pas un fantasme vague.
[pause 4s]
Une image concrète.
[pause 4s]
Où êtes-vous ?
[pause 5s]
Qu'est-ce que vous voyez exactement ?
[pause 5s]
Qu'est-ce que vous entendez ?
[pause 5s]
Qu'est-ce que vous sentez dans votre corps ?
[pause 8s]

Laissez l'émotion venir.
[pause 5s]
Pas la forcer.
[pause 5s]
La laisser naître naturellement... de l'image.
[pause 10s]

C'est par le corps que nous ancrons cette vision maintenant.
[pause 8s]

Nous allons pratiquer la méthode cinq-cinq-cinq.
[pause 5s]

Cinq secondes pour inspirer.
[pause 2s]
Cinq secondes pour bloquer.
[pause 2s]
Cinq secondes pour expirer.
[pause 4s]
Dix cycles.
[pause 2s]
Deux minutes et demie de présence dans cette vision.
[pause 6s]

À chaque inspiration... laissez entrer la scène plus profondément.
[pause 4s]
Au blocage... tenez cette image dans le silence.
[pause 4s]
À l'expiration... laissez partir ce qui résiste encore en vous.
[pause 6s]

Nous commençons.
[BREATHING_CYCLES]
[pause 20s]

Ce calme... c'est le terrain de votre vision.
[pause 5s]
Elle pousse là.
[pause 5s]
Dans ce silence que vous venez de toucher.
[pause 15s]

Laissez le souffle reprendre son rythme naturel.
[pause 10s]

Restez là.
[pause 8s]
Sans rien faire.
[pause 12s]

Qu'est-ce qui est apparu pendant les cycles ?
[pause 8s]
Une image plus nette ?
[pause 5s]
Une résistance ?
[pause 5s]
Une certitude ?
[pause 12s]

La vision ne se maîtrise pas en un module.
[pause 5s]
Elle se pratique.
[pause 5s]
Chaque jour.
[pause 5s]
Cinq à dix minutes.
[pause 5s]
La même scène.
[pause 5s]
La même émotion.
[pause 5s]
Jusqu'à ce que le corps la connaisse par cœur.
[pause 10s]

Notez dans votre carnet :
[pause 4s]
La scène que vous avez vue.
[pause 5s]
L'émotion que vous avez touchée.
[pause 5s]
Ce qui a résisté.
[pause 8s]

À demain.
[pause 5s]
La vision vous attend.
[pause 10s]
SCRIPT,

        // ─────────────────────────────────────────────────────────
        // PRATICIEN — Module 08 — Je renforce ma Discipline
        // ─────────────────────────────────────────────────────────
        '08-je-renforce-ma-discipline' => <<<'SCRIPT'
Installez-vous.
[pause 5s]

La discipline n'est pas une punition.
[pause 5s]
C'est une déclaration d'identité.
[pause 5s]
Elle dit : je suis quelqu'un qui fait ce qu'il a décidé.
[pause 5s]
Même sans envie.
[pause 5s]
Même sans applaudissements.
[pause 5s]
Même sans résultat visible.
[pause 10s]

L'amiral McRaven, lors de son discours aux diplômés de 2014, a dit une chose simple.
[pause 5s]
Faites votre lit chaque matin.
[pause 5s]
Ce premier acte de discipline... donne le ton à toute la journée.
[pause 5s]
Il dit à votre cerveau : je suis quelqu'un qui termine ce qu'il commence.
[pause 10s]

James Clear, dans Atomic Habits, va plus loin.
[pause 5s]
L'identité précède le comportement.
[pause 5s]
Vous ne bâtissez pas des habitudes pour atteindre des objectifs.
[pause 5s]
Vous bâtissez des habitudes pour devenir quelqu'un.
[pause 8s]

Fermez les yeux.
[pause 6s]

Respiration consciente.
[pause 4s]
Trois cycles lents.
[pause 15s]

Pensez à un domaine de votre vie où vous manquez de constance.
[pause 8s]
Pas pour vous juger.
[pause 5s]
Pour observer.
[pause 5s]
Qu'est-ce qui cède en premier ?
[pause 5s]
L'énergie ?
[pause 4s]
La motivation ?
[pause 4s]
La clarté sur le pourquoi ?
[pause 10s]

C'est par le corps que nous ancrons cette discipline maintenant.
[pause 8s]

Nous allons pratiquer la méthode cinq-cinq-cinq.
[pause 5s]

Cinq secondes pour inspirer.
[pause 2s]
Cinq secondes pour bloquer.
[pause 2s]
Cinq secondes pour expirer.
[pause 4s]
Dix cycles.
[pause 2s]
Deux minutes et demie pour ancrer l'identité de la personne disciplinée que vous devenez.
[pause 6s]

À l'inspiration... dites intérieurement : je suis quelqu'un qui tient.
[pause 4s]
Au blocage... tenez.
[pause 4s]
À l'expiration... relâchez ce qui n'est plus vous.
[pause 6s]

Nous commençons.
[BREATHING_CYCLES]
[pause 20s]

Ce calme... c'est la discipline dans sa forme pure.
[pause 5s]
Pas l'effort.
[pause 5s]
La présence.
[pause 15s]

Laissez le souffle reprendre son rythme naturel.
[pause 10s]

Restez là.
[pause 8s]
Sans rien faire.
[pause 12s]

Quel est le rituel quotidien que vous vous engagez à tenir cette semaine ?
[pause 18s]

Pas dix habitudes.
[pause 5s]
Une seule.
[pause 5s]
Que vous ferez même si vous n'en avez pas envie.
[pause 18s]

Notez-la dans votre carnet.
[pause 5s]
Avec l'heure.
[pause 5s]
Avec la durée.
[pause 5s]
Avec l'identité qu'elle construit.
[pause 8s]

La discipline... c'est la liberté de demain.
[pause 5s]
Commencez aujourd'hui.
[pause 10s]
SCRIPT,

        // ─────────────────────────────────────────────────────────
        // PRATICIEN — Module 09 — Je transmets le Rituel Pause Souffle
        // ─────────────────────────────────────────────────────────
        '09-je-transmets-le-rituel' => <<<'SCRIPT'
[pause 30s]

Ce que vous venez de ressentir dans ce silence...
[pause 6s]
c'est exactement ce que votre premier client ressentira face à vous.
[pause 8s]

Pas un discours.
[pause 3s]
Pas une méthode.
[pause 3s]
Du vide.
[pause 5s]
Et la façon dont vous le recevez... ou dont vous le fuyez.
[pause 10s]

Bienvenue dans le dernier module de la formation Praticien Pause Souffle.
[pause 8s]

Ce module ne ressemble à aucun autre.
[pause 5s]
Parce qu'il ne vous apprend rien.
[pause 4s]
Il vous révèle ce que vous savez déjà.
[pause 12s]

─────────────────────────
[pause 2s]

Commencez par observer votre souffle en ce moment précis.
[pause 6s]
Ne le modifiez pas.
[pause 4s]
Observez simplement.
[pause 8s]

Est-ce que vous respirez depuis la poitrine ?
[pause 5s]
Est-ce que votre ventre est contracté ?
[pause 5s]
Est-ce que votre souffle est court... retenu... contrôlé ?
[pause 8s]

Ce que vous observez là...
[pause 5s]
c'est l'état de votre système nerveux en ce moment.
[pause 5s]
Et votre client — le premier, le dixième, le centième —
[pause 4s]
respirera exactement comme ça dans la première minute avec vous.
[pause 6s]
Il copiera votre corps.
[pause 4s]
Pas vos mots.
[pause 4s]
Votre corps.
[pause 10s]

Votre seul travail en tant que praticien Pause Souffle...
[pause 5s]
c'est de descendre votre souffle en premier.
[pause 5s]
Pas pour donner l'exemple.
[pause 4s]
Parce que le système nerveux de votre client s'accordera au vôtre.
[pause 5s]
C'est de la neurobiologie.
[pause 4s]
C'est aussi du souffle.
[pause 5s]
C'est Pause Souffle.
[pause 15s]

─────────────────────────
[pause 2s]

Maintenant je vais vous demander quelque chose d'inhabituel.
[pause 5s]
Pas une visualisation.
[pause 4s]
Pas une affirmation.
[pause 5s]
Une expérience réelle.
[pause 8s]

Posez vos deux mains à plat sur votre sternum.
[pause 5s]
Sentez la chaleur.
[pause 5s]
Sentez le mouvement du souffle sous vos paumes.
[pause 8s]

Fermez les yeux.
[pause 5s]
Et placez devant vous — mentalement, précisément —
[pause 4s]
une personne réelle.
[pause 5s]
Son prénom.
[pause 4s]
Son visage.
[pause 4s]
Quelque chose qu'elle traîne.
[pause 5s]
Quelque chose qu'elle ne dit pas encore à voix haute.
[pause 10s]

Vous ne lui parlez pas.
[pause 5s]
Vous ne l'analysez pas.
[pause 5s]
Vous êtes simplement là.
[pause 5s]
Deux mains sur votre sternum.
[pause 4s]
Souffle conscient.
[pause 4s]
Présence totale.
[pause 12s]

Observez ce qui se passe dans votre corps quand vous pensez à cette personne.
[pause 8s]
Une légère tension dans les épaules ?
[pause 5s]
Une envie de vouloir l'aider tout de suite ?
[pause 5s]
Une impulsion de trouver les bons mots ?
[pause 8s]

Ce que vous ressentez là...
[pause 5s]
c'est votre pattern de praticien.
[pause 5s]
C'est ce que vous devrez apprivoiser.
[pause 5s]
Pas corriger.
[pause 4s]
Apprivoiser.
[pause 12s]

Pratiquons ensemble.
[pause 5s]
Inspiration profonde depuis le ventre...
[pause 5s]
Blocage...
[pause 5s]
Expiration lente...
[pause 5s]

[BREATHING_CYCLES]
[pause 15s]

Restez là.
[pause 8s]
Mains sur le sternum.
[pause 5s]
Cette personne devant vous.
[pause 5s]
Votre souffle descendu.
[pause 5s]
Rien à dire.
[pause 5s]
Rien à faire.
[pause 5s]
Juste être là.
[pause 15s]

Ça — ce que vous venez de faire —
[pause 4s]
c'est votre première séance.
[pause 6s]
Elle a commencé maintenant.
[pause 15s]

─────────────────────────
[pause 2s]

Voici maintenant trois exercices.
[pause 5s]
Ils ne ressemblent à rien de ce que vous avez lu ailleurs.
[pause 5s]
Ils sont propres à ce que vous avez traversé dans ces douze modules.
[pause 10s]

PREMIER EXERCICE — Le souffle du témoin.
[pause 8s]

Pensez à la dernière fois qu'un silence a duré trop longtemps dans une conversation.
[pause 5s]
Pas en séance.
[pause 4s]
Dans votre vie.
[pause 5s]
Un repas de famille. Une dispute. Un moment gênant.
[pause 6s]

Qu'avez-vous fait ?
[pause 5s]
Vous avez parlé pour remplir.
[pause 4s]
Vous avez ri pour désamorcer.
[pause 4s]
Vous avez regardé votre téléphone.
[pause 4s]
Ou vous êtes resté là, inconfortable, à attendre que ça passe.
[pause 8s]

Ce geste automatique que vous avez eu face à ce silence...
[pause 5s]
votre client le fera pendant votre séance.
[pause 6s]
Et votre rôle ne sera pas de le rassurer.
[pause 5s]
Votre rôle sera de tenir l'espace suffisamment stable
[pause 4s]
pour qu'il n'ait pas à fuir.
[pause 8s]

Maintenant — faites ceci.
[pause 5s]
Inspirez lentement.
[pause 4s]
Et restez dans le silence qui suit.
[pause 4s]
Sans le remplir.
[pause 4s]
Sans anticiper la suite.
[pause 4s]
Juste tenir.
[pause 20s]

Ce que vous venez de pratiquer...
[pause 4s]
c'est la compétence la plus rare en thérapie.
[pause 5s]
Tenir le silence sans en avoir peur.
[pause 5s]
Vous venez de l'installer dans votre corps.
[pause 12s]

DEUXIÈME EXERCICE — Le diagnostic du souffle.
[pause 8s]

Ceci ne se pratique pas avec un client imaginaire.
[pause 5s]
Ceci se pratique sur vous-même. Maintenant.
[pause 8s]

Posez une main sur votre ventre.
[pause 4s]
Une main sur votre poitrine.
[pause 6s]

Je vais vous poser une question.
[pause 4s]
Ne répondez pas verbalement.
[pause 4s]
Observez seulement quelle main bouge en premier.
[pause 8s]

Voici la question.
[pause 5s]
Quel est le schéma que cette formation a révélé en vous...
[pause 5s]
que vous allez reconnaître chez vos clients ?
[pause 20s]

Quelle main a bougé ?
[pause 6s]
Si c'est la poitrine — votre réponse vient de la peur.
[pause 5s]
De l'urgence de trouver une réponse juste.
[pause 5s]
Si c'est le ventre — votre réponse vient de quelque chose de plus vrai.
[pause 5s]
Quelque chose que vous savez sans l'avoir appris.
[pause 10s]

Quand votre client vous posera une question difficile en séance...
[pause 5s]
observez quelle main bougerait en premier.
[pause 5s]
Pas pour analyser.
[pause 4s]
Pour savoir depuis quel endroit vous êtes en train de répondre.
[pause 12s]

TROISIÈME EXERCICE — La première phrase.
[pause 8s]

Celui-ci est le plus difficile.
[pause 5s]
Et le plus important.
[pause 8s]

Quelqu'un vous dit — et cette personne existe, vous la connaissez —
[pause 5s]
"La respiration consciente c'est du charlatanisme.
[pause 3s]
Le souffle c'est automatique. Ça ne soigne rien."
[pause 8s]

Vous avez quinze secondes pour trouver votre première phrase.
[pause 4s]
Pas une explication.
[pause 4s]
Pas une défense de la méthode.
[pause 4s]
Une phrase qui ouvre.
[pause 4s]
Qui ne referme pas.
[pause 5s]
Qui laisse de l'espace à cette personne pour rester dans la conversation.
[pause 15s]

Prenez ces quinze secondes.
[pause 15s]

Ce que vous avez trouvé...
[pause 5s]
c'est votre identité de praticien.
[pause 5s]
Pas un discours appris.
[pause 4s]
Une façon d'être en présence du doute de l'autre.
[pause 5s]
Notez-la.
[pause 5s]
C'est votre première phrase de praticien.
[pause 12s]

─────────────────────────
[pause 2s]

Vous avez traversé douze modules.
[pause 6s]
Pas pour accumuler des connaissances.
[pause 5s]
Pour transformer la façon dont vous êtes en présence d'un corps.
[pause 5s]
D'une personne.
[pause 5s]
D'un souffle qui essaie de dire quelque chose.
[pause 10s]

Il y a un paradoxe au cœur de ce que vous allez faire maintenant.
[pause 6s]
Vous allez transmettre le silence...
[pause 5s]
à des gens qui ont construit leur vie entière pour l'éviter.
[pause 8s]

Ils résisteront.
[pause 4s]
Pas contre vous.
[pause 4s]
Contre eux-mêmes.
[pause 6s]
Contre tout ce qu'ils ressentent quand le bruit s'arrête.
[pause 8s]

Et votre capacité à rester là, stable, sans remplir ce vide...
[pause 5s]
c'est exactement ce que vous avez entraîné.
[pause 5s]
Module après module.
[pause 4s]
Souffle après souffle.
[pause 12s]

Vous n'êtes pas un guérisseur.
[pause 6s]
Vous êtes un témoin.
[pause 6s]
Le souffle fait le travail.
[pause 5s]
Votre rôle est de créer un espace suffisamment silencieux
[pause 4s]
pour que le souffle de votre client ose dire la vérité.
[pause 12s]

Vous avez la permission d'être imparfait devant vos clients.
[pause 6s]
Le souffle ne demande pas la perfection.
[pause 5s]
Il demande l'honnêteté.
[pause 6s]
Un praticien qui dit "je ne sais pas"
[pause 4s]
en tenant l'espace sans le lâcher...
[pause 4s]
vaut infiniment plus qu'un praticien qui a réponse à tout
[pause 4s]
et le prouve à chaque séance.
[pause 12s]

─────────────────────────
[pause 2s]

Voici ce que je vous demande pour terminer.
[pause 6s]

Posez vos deux mains sur votre sternum.
[pause 5s]
Sentez votre souffle.
[pause 5s]
Pas le souffle idéal.
[pause 4s]
Le vôtre. Maintenant. Tel qu'il est.
[pause 10s]

Et dites intérieurement le prénom de la première personne que vous allez accompagner.
[pause 5s]
Pas demain.
[pause 4s]
La première.
[pause 5s]
Celle que vous voyez quand vous fermez les yeux et que vous pensez à pourquoi vous avez fait cette formation.
[pause 20s]

Ce n'est pas moi qui vous certifie.
[pause 6s]
C'est ce souffle — le vôtre — qui vient de vous reconnaître.
[pause 20s]

Votre attestation Praticien Pause Souffle est disponible dans votre espace.
[pause 8s]

Merci d'avoir tenu.
[pause 15s]
SCRIPT,

        // ─────────────────────────────────────────────────────────
        // PARCOURS — Module 29 (ord) — 12-je-transmets-le-rituel
        // ─────────────────────────────────────────────────────────
        '12-je-transmets-le-rituel' => <<<'SCRIPT'
Installez-vous.
[pause 5s]

Ce module marque un moment particulier dans votre parcours.
[pause 5s]
Vous avez traversé vingt-neuf semaines.
[pause 5s]
Vous avez travaillé votre corps.
[pause 5s]
Votre souffle.
[pause 5s]
Vos relations.
[pause 5s]
Votre identité.
[pause 10s]

Aujourd'hui... vous transmettez.
[pause 5s]
Pas parce que vous avez tout compris.
[pause 5s]
Mais parce que vous avez traversé.
[pause 5s]
Et traverser... ça s'enseigne.
[pause 10s]

Le rituel Pause Souffle que vous allez guider n'est pas une technique.
[pause 5s]
C'est une présence.
[pause 5s]
Votre présence.
[pause 5s]
Avec ce que vous avez vécu.
[pause 8s]

Fermez les yeux.
[pause 6s]

Trois respirations conscientes pour arriver ici.
[pause 15s]

C'est par le corps que nous ancrons cette étape.
[pause 8s]

Nous allons pratiquer la méthode cinq-cinq-cinq.
[pause 5s]

Cinq secondes pour inspirer.
[pause 2s]
Cinq secondes pour bloquer.
[pause 2s]
Cinq secondes pour expirer.
[pause 4s]
Dix cycles.
[pause 2s]
Deux minutes et demie de présence pure.
[pause 6s]

À l'inspiration... recevez ce que vous avez semé.
[pause 4s]
Au blocage... tenez-le dans le silence.
[pause 4s]
À l'expiration... laissez-le rayonner vers ceux qui vous entourent.
[pause 6s]

Nous commençons.
[BREATHING_CYCLES]
[pause 20s]

Ce calme... c'est vous.
[pause 5s]
Simplement vous.
[pause 15s]

Laissez le souffle reprendre son rythme naturel.
[pause 10s]

Restez là.
[pause 8s]
Sans rien faire.
[pause 12s]

Qu'est-ce que vous avez reçu dans ce parcours que vous voulez offrir ?
[pause 18s]

À qui ?
[pause 18s]

Comment ?
[pause 18s]

Notez ce qui est venu dans votre carnet.
[pause 5s]
Sans le corriger.
[pause 8s]

Merci d'être là.
[pause 5s]
Continuez.
[pause 10s]
SCRIPT,

        // ─────────────────────────────────────────────────────────
        // PARCOURS 1 — Module 07 — Je prends soin de moi en premier
        // ─────────────────────────────────────────────────────────
        '07-je-prends-soin-de-moi' => <<<'SCRIPT'
Posez tout.
[pause 5s]
Ce que vous portez pour les autres.
[pause 4s]
Ce que vous finissez avant de vous occuper de vous.
[pause 4s]
Ce qui attend votre attention... dès que vous aurez un moment.
[pause 6s]
Posez tout... juste pour maintenant.
[pause 10s]

Fermez les yeux.
[pause 8s]

Sentez le poids de votre corps.
[pause 5s]
Les épaules... les bras... les mains.
[pause 6s]
Le ventre.
[pause 5s]
Laissez votre corps s'alourdir... comme s'il posait lui aussi un fardeau.
[pause 10s]

Ce module vous demande de faire quelque chose d'inhabituel.
[pause 6s]
Vous mettre en premier.
[pause 6s]
Non pas par égoïsme.
[pause 5s]
Mais parce que vous ne pouvez donner que ce que vous avez.
[pause 10s]

L'image du masque à oxygène dans l'avion n'est pas une métaphore agréable.
[pause 6s]
C'est une vérité biologique.
[pause 5s]
Si vous perdez conscience... vous ne pouvez rien pour personne.
[pause 6s]
Si vous êtes chroniquement épuisé... vous donnez aux autres une version appauvrie de vous-même.
[pause 5s]
Et vous le savez.
[pause 10s]

Posez cette question honnêtement.
[pause 6s]
Est-ce que je prends vraiment soin de moi ?
[pause 8s]
Pas en idée.
[pause 4s]
Concrètement.
[pause 5s]
Est-ce que je dors suffisamment ?
[pause 5s]
Est-ce que je mange pour nourrir mon corps... ou pour combler un vide ?
[pause 5s]
Est-ce que je bouge... ou est-ce que je résiste au mouvement ?
[pause 5s]
Est-ce que j'ai des moments de vrai repos... pas juste d'inactivité surveillée ?
[pause 10s]

Et cette question plus profonde.
[pause 6s]
Est-ce que je me permets de recevoir ?
[pause 5s]
Pas seulement de donner.
[pause 5s]
De recevoir de l'aide.
[pause 4s]
De recevoir du plaisir.
[pause 4s]
De recevoir du repos... sans le justifier.
[pause 10s]

Restez avec ce qui vient.
[pause 8s]
Sans vous juger.
[pause 5s]
Juste voir.
[pause 12s]

Prendre soin de soi en premier... c'est un acte de responsabilité.
[pause 6s]
Vis-à-vis de vous-même... oui.
[pause 5s]
Mais aussi vis-à-vis de tous ceux qui comptent sur vous.
[pause 5s]
Parce qu'une personne ressourcée... apporte quelque chose de réel.
[pause 5s]
Une personne épuisée... apporte son épuisement.
[pause 12s]

C'est par le corps que nous allons ancrer ça.
[pause 8s]

Nous allons pratiquer la méthode cinq-cinq-cinq.
[pause 5s]

Cinq secondes pour inspirer.
[pause 2s]
Cinq secondes pour bloquer.
[pause 2s]
Cinq secondes pour expirer.
[pause 4s]
Dix cycles.
[pause 2s]
Deux minutes et demie de présence pure.
[pause 6s]

À l'inspiration... laissez la mâchoire s'ouvrir doucement.
[pause 4s]
Au blocage... restez dans ce silence... et inspirez vraiment pour vous.
[pause 4s]
À l'expiration... lèvres légèrement resserrées... laissez partir ce que vous portez pour les autres.
[pause 6s]

Si l'esprit part... laissez-le partir.
[pause 3s]
Et revenez simplement... au souffle.
[pause 7s]

Nous commençons.
[BREATHING_CYCLES]
[pause 20s]

Ce calme... c'est vous.
[pause 5s]
Simplement vous.
[pause 15s]

Laissez le souffle reprendre son rythme naturel.
[pause 10s]

Restez là.
[pause 8s]
Sans rien faire.
[pause 12s]

Est-ce que vous prenez vraiment soin de vous... concrètement ?
[pause 18s]

Qu'est-ce que vous pourriez vous donner cette semaine... que vous remettez depuis trop longtemps ?
[pause 18s]

Qu'est-ce qui vous empêche de vous mettre en premier ?
[pause 18s]

Notez ce qui est venu... dans votre carnet.
[pause 5s]
Même si c'est juste un mot.
[pause 8s]

Les exercices de ce module sont une invitation concrète.
[pause 5s]
Prenez-les pour vous.
[pause 5s]
Vraiment pour vous.
[pause 8s]
SCRIPT,

        // ─────────────────────────────────────────────────────────
        // PARCOURS 1 — Module 08 — Gratitude et intention
        // ─────────────────────────────────────────────────────────
        '08-gratitude-et-intention' => <<<'SCRIPT'
Installez-vous.
[pause 5s]
Dos droit... pieds au sol.
[pause 5s]
Fermez les yeux.
[pause 8s]

Sentez le poids de vos mains sur vos cuisses.
[pause 5s]
La chaleur dans vos paumes.
[pause 5s]
Le mouvement discret de votre respiration.
[pause 8s]

Avant de commencer...
[pause 3s]
Pensez à un moment de la journée d'aujourd'hui ou d'hier...
[pause 5s]
qui a été bon.
[pause 5s]
Même petit.
[pause 10s]

Ce module travaille sur deux moments clés de chaque journée.
[pause 5s]
Le soir... et le matin.
[pause 5s]
La façon dont vous fermez une journée.
[pause 4s]
Et la façon dont vous en ouvrez une autre.
[pause 10s]

Ces deux moments... répétés consciemment...
[pause 5s]
transforment la texture de votre vie en moins de trois semaines.
[pause 5s]
Pas comme une promesse.
[pause 5s]
Comme une mesure.
[pause 10s]

Robert Emmons... de l'Université de Californie...
[pause 5s]
a passé vingt ans à étudier scientifiquement la gratitude.
[pause 5s]
Pas la gratitude comme sentiment passif.
[pause 5s]
La gratitude comme pratique active.
[pause 8s]

Sa découverte principale est simple et radicale.
[pause 6s]
Les gens qui pratiquent la gratitude régulièrement...
[pause 5s]
dorment mieux.
[pause 4s]
Ont des relations plus solides.
[pause 4s]
Sont plus résistants aux événements difficiles.
[pause 4s]
Et rapportent un niveau de satisfaction de vie significativement plus élevé.
[pause 8s]

Mais voici ce qu'on comprend souvent mal.
[pause 6s]
La gratitude effficace n'est pas générale.
[pause 5s]
Elle est spécifique.
[pause 5s]
Pas... je suis reconnaissant pour ma vie.
[pause 5s]
Mais... aujourd'hui à 14h30... quand cette personne m'a dit cette phrase...
[pause 4s]
j'ai ressenti quelque chose de vrai.
[pause 8s]

La spécificité crée la profondeur.
[pause 5s]
La profondeur crée l'ancrage neurologique.
[pause 5s]
L'ancrage neurologique crée la transformation durable.
[pause 10s]

Et l'intention du matin...
[pause 5s]
n'est pas une liste de tâches.
[pause 5s]
C'est une question.
[pause 5s]
Comment est-ce que je veux me comporter aujourd'hui ?
[pause 5s]
Pas ce que je vais faire.
[pause 5s]
Qui je veux être.
[pause 10s]

Cette distinction est fondamentale.
[pause 6s]
Parce que nous contrôlons très peu de ce qui se passe.
[pause 5s]
Mais nous pouvons toujours choisir notre façon d'y répondre.
[pause 5s]
Et ce choix... fait en conscience le matin...
[pause 5s]
oriente la journée entière.
[pause 12s]

C'est par le corps que nous allons ancrer ça.
[pause 8s]

Nous allons pratiquer la méthode cinq-cinq-cinq.
[pause 5s]

Cinq secondes pour inspirer.
[pause 2s]
Cinq secondes pour bloquer.
[pause 2s]
Cinq secondes pour expirer.
[pause 4s]
Dix cycles.
[pause 2s]
Deux minutes et demie de présence pure.
[pause 6s]

À l'inspiration... laissez la mâchoire s'ouvrir doucement.
[pause 4s]
Au blocage... laissez venir une image concrète pour laquelle vous êtes reconnaissant.
[pause 4s]
À l'expiration... lèvres légèrement resserrées... laissez ce sentiment se déposer en vous.
[pause 6s]

Si l'esprit part... laissez-le partir.
[pause 3s]
Et revenez simplement... au souffle.
[pause 7s]

Nous commençons.
[BREATHING_CYCLES]
[pause 20s]

Ce calme... c'est vous.
[pause 5s]
Simplement vous.
[pause 15s]

Laissez le souffle reprendre son rythme naturel.
[pause 10s]

Restez là.
[pause 8s]
Sans rien faire.
[pause 12s]

Pensez à un moment précis et concret d'aujourd'hui... pour lequel vous êtes reconnaissant.
[pause 5s]
Pas une idée générale.
[pause 4s]
Un moment. Une personne. Un détail vrai.
[pause 15s]

Comment voulez-vous vous comporter demain ?
[pause 5s]
Pas ce que vous allez faire.
[pause 4s]
Qui vous voulez être.
[pause 15s]

Notez ce qui est venu... dans votre carnet.
[pause 5s]
Le rituel du soir et du matin vous attend dans les exercices.
[pause 5s]
Vingt et un jours minimum.
[pause 5s]
Pas comme une discipline.
[pause 5s]
Comme une expérience sur vous-même.
[pause 8s]
SCRIPT,

        // ─────────────────────────────────────────────────────────
        // PARCOURS 2 — Module 09 — Définir mes priorités
        // ─────────────────────────────────────────────────────────
        '09-mes-priorites-dabord' => <<<'SCRIPT'
Installez-vous.
[pause 5s]
Dos droit.
[pause 4s]
Pieds au sol.
[pause 4s]
Mains posées.
[pause 6s]
Respirez normalement un moment avant de commencer.
[pause 8s]

Ce module pose une question qui dérange.
[pause 6s]
Si vous ne construisez pas vos rêves...
[pause 5s]
quelqu'un vous embauchera pour construire les siens.
[pause 8s]
Tony Gaskins.
[pause 5s]
Une phrase courte.
[pause 4s]
Une vérité longue.
[pause 10s]

Eisenhower avait un outil.
[pause 5s]
Une matrice en quatre quadrants.
[pause 5s]
Urgent et important.
[pause 4s]
Important mais non urgent.
[pause 4s]
Urgent mais non important.
[pause 4s]
Ni urgent ni important.
[pause 8s]

La plupart des gens passent leur vie dans le premier quadrant.
[pause 5s]
L'urgence.
[pause 5s]
Toujours en réaction.
[pause 4s]
Toujours en mode pompier.
[pause 4s]
Toujours à répondre à ce que les autres définissent comme urgent.
[pause 8s]

Le second quadrant est le plus précieux.
[pause 6s]
Ce qui est important... mais pas urgent.
[pause 5s]
La santé.
[pause 4s]
Les relations profondes.
[pause 4s]
La formation.
[pause 4s]
Le projet de vie.
[pause 4s]
La prévention.
[pause 5s]
Tout ce qui construit quelque chose de durable.
[pause 8s]

Et parce que ce n'est pas urgent...
[pause 5s]
c'est exactement ce qui est constamment sacrifié.
[pause 5s]
Au profit de ce qui crie le plus fort.
[pause 10s]

Posez cette question maintenant.
[pause 6s]
Dans les sept derniers jours...
[pause 5s]
combien d'heures avez-vous passé dans le quadrant 2 ?
[pause 5s]
Sur ce qui construit votre vie... plutôt que sur ce qui la gère ?
[pause 10s]

Restez avec ce chiffre.
[pause 8s]
Sans vous juger.
[pause 5s]
Juste voir.
[pause 10s]

Votre temps reflète vos priorités réelles.
[pause 6s]
Pas celles que vous déclarez.
[pause 5s]
Pas celles que vous pensez avoir.
[pause 5s]
Celles que vous démontrez... heure après heure.
[pause 10s]

Ce module vous donne les outils pour réaligner les deux.
[pause 5s]
Pour que ce que vous faites de vos journées...
[pause 5s]
ressemble à ce que vous voulez vraiment.
[pause 10s]

C'est par le corps que nous allons clarifier ce qui compte vraiment.
[pause 8s]

Nous allons pratiquer la méthode cinq-cinq-cinq.
[pause 5s]

Cinq secondes pour inspirer.
[pause 2s]
Cinq secondes pour bloquer.
[pause 2s]
Cinq secondes pour expirer.
[pause 4s]
Dix cycles.
[pause 2s]
Deux minutes et demie de présence pure.
[pause 6s]

À l'inspiration... laissez la mâchoire s'ouvrir doucement.
[pause 4s]
Au blocage... restez dans ce silence... et regardez honnêtement comment vous utilisez votre temps.
[pause 4s]
À l'expiration... lèvres légèrement resserrées... laissez partir ce qui peut partir.
[pause 6s]

Si l'esprit part... laissez-le partir.
[pause 3s]
Et revenez simplement... au souffle.
[pause 7s]

Nous commençons.
[BREATHING_CYCLES]
[pause 20s]

Ce calme... c'est vous.
[pause 5s]
Simplement vous.
[pause 15s]

Laissez le souffle reprendre son rythme naturel.
[pause 10s]

Restez là.
[pause 8s]
Sans rien faire.
[pause 12s]

Dans les sept derniers jours... qu'avez-vous mis dans le quadrant 2... l'important non urgent ?
[pause 18s]

Qu'est-ce que vous reportez depuis longtemps... et qui est pourtant l'une de vos vraies priorités ?
[pause 18s]

Quel est le premier acte du quadrant 2 que vous pouvez poser dans les prochains jours ?
[pause 18s]

Notez ce qui est venu... dans votre carnet.
[pause 5s]
Même si c'est juste un mot.
[pause 8s]

Ce n'est pas le temps qui manque.
[pause 5s]
C'est la clarté sur ce qui mérite votre temps.
[pause 8s]
SCRIPT,

        // ─────────────────────────────────────────────────────────
        // PARCOURS 2 — Module 12 — Je maîtrise mon temps
        // ─────────────────────────────────────────────────────────
        '12-maitriser-son-temps' => <<<'SCRIPT'
Installez-vous.
[pause 5s]
Vous avez le même nombre d'heures que Darwin.
[pause 5s]
Que Mozart.
[pause 5s]
Que Marie Curie.
[pause 5s]
Vingt-quatre heures.
[pause 5s]
Pas une de plus.
[pause 10s]

Alors pourquoi certains construisent des œuvres remarquables...
[pause 5s]
quand d'autres finissent la journée épuisés sans avoir avancé sur ce qui compte ?
[pause 8s]

La réponse n'est pas la motivation.
[pause 5s]
Ce n'est pas le talent.
[pause 5s]
C'est l'architecture.
[pause 10s]

Cal Newport a étudié les génies de l'histoire.
[pause 5s]
Darwin travaillait quatre heures par jour.
[pause 5s]
Vraiment.
[pause 5s]
Des blocs de concentration totale... sans distraction... sans réunions.
[pause 5s]
Et le reste en marches... en observations... en récupération.
[pause 8s]

Newport appelle ça le Deep Work.
[pause 5s]
Le travail profond.
[pause 5s]
La capacité à se concentrer sans distraction sur une tâche cognitivement exigeante.
[pause 6s]
Cette capacité est devenue rare.
[pause 5s]
Et elle est devenue précieuse.
[pause 10s]

Parkinson a observé quelque chose d'étrange.
[pause 6s]
Le travail se dilate pour occuper tout le temps disponible.
[pause 5s]
Si vous avez trois heures pour une tâche... elle prend trois heures.
[pause 5s]
Si vous en avez six... elle prend six heures.
[pause 5s]
Même résultat.
[pause 5s]
Le double de temps.
[pause 8s]

La conclusion contre-intuitive...
[pause 5s]
c'est qu'avoir plus de temps ne produit pas un meilleur résultat.
[pause 5s]
Il produit de la procrastination.
[pause 5s]
Du perfectionnisme.
[pause 5s]
Du travail superficiel.
[pause 10s]

Posez cette question maintenant.
[pause 6s]
Combien d'heures de vraie concentration profonde fais-je par semaine ?
[pause 5s]
Pas de présence devant l'ordinateur.
[pause 5s]
De concentration réelle.
[pause 5s]
Sans téléphone.
[pause 4s]
Sans notifications.
[pause 4s]
Sans distractions.
[pause 8s]

La plupart des gens découvrent que c'est moins d'une heure par jour.
[pause 6s]
Même en travaillant dix heures.
[pause 10s]

Ce module vous donne les outils pour changer ça.
[pause 5s]
Pas en travaillant plus longtemps.
[pause 5s]
En travaillant mieux.
[pause 5s]
En concentrant votre énergie là où elle produit quelque chose.
[pause 10s]

C'est par le corps que nous allons ancrer la valeur de votre attention.
[pause 8s]

Nous allons pratiquer la méthode cinq-cinq-cinq.
[pause 5s]

Cinq secondes pour inspirer.
[pause 2s]
Cinq secondes pour bloquer.
[pause 2s]
Cinq secondes pour expirer.
[pause 4s]
Dix cycles.
[pause 2s]
Deux minutes et demie de présence pure.
[pause 6s]

À l'inspiration... laissez la mâchoire s'ouvrir doucement.
[pause 4s]
Au blocage... restez dans ce silence... ressentez ce que vaut vraiment votre attention.
[pause 4s]
À l'expiration... lèvres légèrement resserrées... laissez partir ce qui peut partir.
[pause 6s]

Si l'esprit part... laissez-le partir.
[pause 3s]
Et revenez simplement... au souffle.
[pause 7s]

Nous commençons.
[BREATHING_CYCLES]
[pause 20s]

Ce calme... c'est vous.
[pause 5s]
Simplement vous.
[pause 15s]

Laissez le souffle reprendre son rythme naturel.
[pause 10s]

Restez là.
[pause 8s]
Sans rien faire.
[pause 12s]

Y a-t-il dans votre quotidien des blocs de temps protégés... sans interruption... pour ce qui compte vraiment ?
[pause 18s]

Quelle interruption acceptez-vous par habitude... qui vous vole votre temps de concentration ?
[pause 18s]

Quelle serait la première plage de travail profond que vous pouvez organiser cette semaine ?
[pause 18s]

Notez ce qui est venu... dans votre carnet.
[pause 5s]
Même si c'est juste un mot.
[pause 8s]

Le temps ne manque pas.
[pause 5s]
L'attention... si.
[pause 5s]
Et elle s'entraîne.
[pause 8s]
SCRIPT,

        // ─────────────────────────────────────────────────────────
        // PARCOURS 2 — Module 13 — Je gère mes finances
        // ─────────────────────────────────────────────────────────
        '13-gerer-ses-finances' => <<<'SCRIPT'
Installez-vous.
[pause 5s]
Ce module touche quelque chose que peu d'espaces abordent vraiment.
[pause 5s]
L'argent.
[pause 5s]
Non pas comme un problème mathématique.
[pause 5s]
Mais comme un problème psychologique.
[pause 10s]

La plupart des gens qui n'arrivent pas à épargner...
[pause 5s]
ne manquent pas de revenu.
[pause 5s]
Ils portent des croyances héritées...
[pause 5s]
qui sabotent chaque décision financière...
[pause 5s]
souvent sans le savoir.
[pause 10s]

Brad Klontz a passé des années à étudier la psychologie financière.
[pause 5s]
Sa découverte...
[pause 4s]
quatre scripts inconscients hérités de la famille et de la culture...
[pause 5s]
pilotent la quasi-totalité de nos comportements avec l'argent.
[pause 8s]

Le Money Avoidance.
[pause 4s]
L'argent est mauvais... les riches sont corrompus... je ne mérite pas d'en avoir.
[pause 8s]

Le Money Worship.
[pause 4s]
Plus d'argent... plus de bonheur.
[pause 4s]
Le problème se résoudra quand j'en aurai davantage.
[pause 8s]

Le Money Status.
[pause 4s]
Ma valeur égale ce que je dépense... ce que je possède.
[pause 8s]

Et le Money Vigilance.
[pause 4s]
L'argent peut disparaître.
[pause 4s]
Il faut tout garder.
[pause 4s]
Anxiété chronique... méfiance de tout.
[pause 10s]

Lequel résonne le plus en vous ?
[pause 5s]
D'où venez-vous... avec l'argent ?
[pause 5s]
Qu'est-ce qu'on vous a appris... explicitement ou silencieusement... sur ce sujet ?
[pause 10s]

Restez avec ces questions.
[pause 8s]
Sans résoudre.
[pause 5s]
Juste tenir.
[pause 12s]

Ce module ne vous apprend pas à faire des économies.
[pause 5s]
Il vous apprend à comprendre votre relation à l'argent.
[pause 5s]
À automatiser la sécurité.
[pause 5s]
Et à libérer l'espace mental que les finances occupaient.
[pause 5s]
Pour construire autre chose.
[pause 10s]

C'est par le corps que nous allons explorer notre rapport à l'argent.
[pause 8s]

Nous allons pratiquer la méthode cinq-cinq-cinq.
[pause 5s]

Cinq secondes pour inspirer.
[pause 2s]
Cinq secondes pour bloquer.
[pause 2s]
Cinq secondes pour expirer.
[pause 4s]
Dix cycles.
[pause 2s]
Deux minutes et demie de présence pure.
[pause 6s]

À l'inspiration... laissez la mâchoire s'ouvrir doucement.
[pause 4s]
Au blocage... restez dans ce silence... laissez remonter votre relation à l'argent.
[pause 4s]
À l'expiration... lèvres légèrement resserrées... laissez partir ce qui peut partir.
[pause 6s]

Si l'esprit part... laissez-le partir.
[pause 3s]
Et revenez simplement... au souffle.
[pause 7s]

Nous commençons.
[BREATHING_CYCLES]
[pause 20s]

Ce calme... c'est vous.
[pause 5s]
Simplement vous.
[pause 15s]

Laissez le souffle reprendre son rythme naturel.
[pause 10s]

Restez là.
[pause 8s]
Sans rien faire.
[pause 12s]

Quel script émotionnel portez-vous autour de l'argent... hérité de votre famille ou de votre histoire ?
[pause 18s]

Y a-t-il une dépense dans votre vie actuelle qui ne correspond pas à vos vraies valeurs ?
[pause 18s]

Quelle serait la prochaine étape concrète pour prendre davantage de contrôle sur votre situation financière ?
[pause 18s]

Notez ce qui est venu... dans votre carnet.
[pause 5s]
Même si c'est juste un mot.
[pause 8s]

L'argent n'est pas la fin.
[pause 5s]
C'est un outil.
[pause 5s]
Et comme tout outil... il obéit à celui qui sait s'en servir.
[pause 8s]
SCRIPT,

        // ─────────────────────────────────────────────────────────
        // PARCOURS 2 — Module 10 — Un intérieur propre et rangé
        // ─────────────────────────────────────────────────────────
        '10-interieur-propre-et-range' => <<<'SCRIPT'
Fermez les yeux.
[pause 5s]
Pensez à l'état de votre espace de vie ce matin.
[pause 6s]
Pas un jugement.
[pause 4s]
Juste une observation.
[pause 5s]
Ce que vous voyez quand vous entrez.
[pause 5s]
Ce que vous sentez.
[pause 5s]
La texture de cet espace sur votre état intérieur.
[pause 10s]

L'espace extérieur reflète l'espace intérieur.
[pause 6s]
Ce n'est pas une métaphore.
[pause 5s]
C'est une donnée neurologique.
[pause 5s]
Notre cerveau perçoit en permanence l'environnement autour de lui.
[pause 5s]
Et il réagit.
[pause 5s]
Un espace encombré génère une charge cognitive de fond.
[pause 5s]
Permanente.
[pause 5s]
Invisible.
[pause 5s]
Mais réelle.
[pause 10s]

Marie Kondo a popularisé une idée simple.
[pause 5s]
Garder ce qui fait vibrer.
[pause 5s]
Laisser partir le reste.
[pause 5s]
Pas comme une technique de rangement.
[pause 5s]
Comme une pratique de conscience.
[pause 8s]

Chaque objet que vous possédez occupe une part de votre attention.
[pause 5s]
Même inconsciemment.
[pause 5s]
Un tiroir en désordre que vous n'ouvrez jamais...
[pause 5s]
existe quand même dans votre charge mentale.
[pause 10s]

La discipline qui commence chez soi...
[pause 5s]
est la discipline la plus honnête qui soit.
[pause 5s]
Parce qu'elle ne peut pas être simulée.
[pause 5s]
Personne d'autre ne la voit.
[pause 5s]
Elle est entièrement pour vous.
[pause 10s]

C'est par le corps que nous allons ressentir l'impact de notre espace sur nous.
[pause 8s]

Nous allons pratiquer la méthode cinq-cinq-cinq.
[pause 5s]

Cinq secondes pour inspirer.
[pause 2s]
Cinq secondes pour bloquer.
[pause 2s]
Cinq secondes pour expirer.
[pause 4s]
Dix cycles.
[pause 2s]
Deux minutes et demie de présence pure.
[pause 6s]

À l'inspiration... laissez la mâchoire s'ouvrir doucement.
[pause 4s]
Au blocage... restez dans ce silence... et laissez venir l'image de votre espace idéal.
[pause 4s]
À l'expiration... lèvres légèrement resserrées... laissez partir ce qui peut partir.
[pause 6s]

Si l'esprit part... laissez-le partir.
[pause 3s]
Et revenez simplement... au souffle.
[pause 7s]

Nous commençons.
[BREATHING_CYCLES]
[pause 20s]

Ce calme... c'est vous.
[pause 5s]
Simplement vous.
[pause 15s]

Laissez le souffle reprendre son rythme naturel.
[pause 10s]

Restez là.
[pause 8s]
Sans rien faire.
[pause 12s]

Y a-t-il un espace dans votre environnement proche qui vous alourdit... sans que vous ayez encore agi ?
[pause 18s]

Quel objet ou encombrement portez-vous par habitude ou par culpabilité... alors qu'il ne vous nourrit plus ?
[pause 18s]

Quel serait le premier geste concret... aujourd'hui... pour commencer à alléger votre espace ?
[pause 18s]

Notez ce qui est venu... dans votre carnet.
[pause 5s]
Même si c'est juste un mot.
[pause 8s]

Votre espace extérieur façonne votre espace intérieur.
[pause 5s]
Changer l'un... c'est souvent commencer à changer l'autre.
[pause 8s]
SCRIPT,

        // ─────────────────────────────────────────────────────────
        // PARCOURS 3 — Module 27 — Apprivoiser la solitude choisie
        // ─────────────────────────────────────────────────────────
        '27-solitude-choisie' => <<<'SCRIPT'
Installez-vous.
[pause 5s]
Et pour une fois... ne faites rien d'autre.
[pause 5s]
Pas lire en parallèle.
[pause 4s]
Pas vérifier quelque chose.
[pause 4s]
Juste être ici.
[pause 5s]
Avec vous-même.
[pause 10s]

Ce module vous demande quelque chose de contre-culturel.
[pause 6s]
Apprendre à être seul.
[pause 5s]
Par choix.
[pause 5s]
Et y trouver quelque chose de précieux.
[pause 10s]

Winnicott était pédiatre et psychanalyste.
[pause 5s]
En 1958... il a présenté ce qui allait devenir une pierre fondatrice de la psychologie du développement.
[pause 6s]
La capacité d'être seul...
[pause 4s]
est l'un des signes les plus importants de la maturité émotionnelle.
[pause 8s]

Paradoxe de Winnicott.
[pause 5s]
Cette capacité à être seul... se développe toujours en présence de quelqu'un.
[pause 5s]
L'enfant apprend à être seul...
[pause 5s]
parce qu'il a la certitude intérieure que quelqu'un est là s'il en a besoin.
[pause 8s]

Et si la solitude génère systématiquement de l'anxiété chez vous...
[pause 5s]
ce n'est pas une fatalité.
[pause 5s]
C'est une compétence qui n'a pas pu se construire.
[pause 5s]
Et qui peut encore s'apprendre.
[pause 10s]

Maintenant... remarquez.
[pause 6s]
Si vous êtes seul en ce moment...
[pause 5s]
qu'est-ce que ça génère dans votre corps ?
[pause 6s]
De l'agitation ?
[pause 4s]
De l'inconfort ?
[pause 4s]
L'envie de vérifier votre téléphone ?
[pause 4s]
De faire quelque chose d'utile ?
[pause 4s]
Ou quelque chose de plus neutre... voire de calme ?
[pause 10s]

Ne jugez pas.
[pause 5s]
Observez seulement.
[pause 5s]
Ce que vous ressentez est une information sur votre relation actuelle à votre propre présence.
[pause 10s]

Newton a développé le calcul infinitésimal... la loi de la gravitation... et l'optique...
[pause 5s]
pendant dix-huit mois de retraite forcée.
[pause 5s]
Il n'a vu aucun collègue pendant cette période.
[pause 6s]
Descartes passait ses matinées entières couché... à méditer seul.
[pause 5s]
Beethoven refusait toute compagnie pendant ses compositions.
[pause 8s]

La solitude choisie n'est pas un manque.
[pause 5s]
C'est souvent le signe d'une richesse intérieure.
[pause 5s]
Et la condition de son développement.
[pause 10s]

Vous — qu'est-ce qui vous attend dans votre silence ?
[pause 12s]

C'est par le corps que nous allons habiter ce silence.
[pause 8s]

Nous allons pratiquer la méthode cinq-cinq-cinq.
[pause 5s]

Cinq secondes pour inspirer.
[pause 2s]
Cinq secondes pour bloquer.
[pause 2s]
Cinq secondes pour expirer.
[pause 4s]
Dix cycles.
[pause 2s]
Deux minutes et demie de présence pure.
[pause 6s]

À l'inspiration... laissez la mâchoire s'ouvrir doucement.
[pause 4s]
Au blocage... restez dans ce silence... habitez-le.
[pause 4s]
À l'expiration... lèvres légèrement resserrées... laissez partir ce qui peut partir.
[pause 6s]

Si l'esprit part... laissez-le partir.
[pause 3s]
Et revenez simplement... au souffle.
[pause 7s]

Nous commençons.
[BREATHING_CYCLES]
[pause 20s]

Ce calme... c'est vous.
[pause 5s]
Simplement vous.
[pause 15s]

Laissez le souffle reprendre son rythme naturel.
[pause 10s]

Restez là.
[pause 8s]
Sans rien faire.
[pause 12s]

Quelle est votre relation actuelle à la solitude... est-ce quelque chose que vous recherchez ou que vous fuyez ?
[pause 18s]

Y a-t-il un espace régulier dans votre vie pour être seul... pleinement... sans distraction ?
[pause 18s]

Que pourriez-vous découvrir sur vous-même si vous passiez une heure dans un silence choisi ?
[pause 18s]

Notez ce qui est venu... dans votre carnet.
[pause 5s]
Même si c'est juste un mot.
[pause 8s]

La solitude choisie n'est pas l'absence des autres.
[pause 5s]
C'est un retour à soi.
[pause 8s]
SCRIPT,

        // ─────────────────────────────────────────────────────────
        // PARCOURS 3 — Module 36 — Le sens de ma vie
        // ─────────────────────────────────────────────────────────
        '36-sens-de-la-vie' => <<<'SCRIPT'
Installez-vous.
[pause 5s]
Fermez les yeux.
[pause 5s]
Et laissez venir... sans forcer... cette question.
[pause 6s]

Pour quoi... exactement... est-ce que je vis ?
[pause 12s]

Ce n'est pas la question de la dépression.
[pause 5s]
C'est la question de la maturité.
[pause 5s]
Celle qui arrive quand les masques ont fait leur temps.
[pause 5s]
Quand les objectifs atteints ne comblent plus.
[pause 5s]
Quand la vie demande quelque chose de plus vrai que la performance.
[pause 10s]

Viktor Frankl était psychiatre à Vienne.
[pause 5s]
En 1942... il fut déporté à Auschwitz.
[pause 5s]
Il avait perdu sa famille.
[pause 5s]
Il avait tout perdu.
[pause 6s]
Et dans ce contexte d'anéantissement absolu...
[pause 5s]
il a observé qui survivait mentalement... et qui capitulait.
[pause 8s]

Ce n'était pas les plus forts physiquement.
[pause 5s]
C'était ceux qui avaient une raison.
[pause 5s]
Un pourquoi.
[pause 5s]
Un sens qui tenait.
[pause 10s]

Celui qui a un pourquoi...
[pause 4s]
peut supporter presque tous les comment.
[pause 6s]
Nietzsche... repris par Frankl.
[pause 5s]
Validé par les pires conditions que l'humanité ait jamais connues.
[pause 10s]

Irvin Yalom... lui... identifie quatre éveilleurs existentiels.
[pause 5s]
La mort... qui donne son prix à l'existence.
[pause 5s]
La liberté... qui impose la responsabilité absolue de nos choix.
[pause 5s]
L'isolement existentiel... personne ne peut vivre ma vie à ma place.
[pause 5s]
Et l'absurde... l'univers n'a pas de sens intrinsèque.
[pause 5s]
C'est à nous de le créer.
[pause 10s]

Ces réalités ne sont pas des tragédies.
[pause 5s]
Ce sont des éveilleurs.
[pause 5s]
Ils dissolvent la trivialité du quotidien.
[pause 5s]
Ils remettent en contact avec ce qui compte vraiment.
[pause 10s]

Posez maintenant... intérieurement... cette question de Yalom.
[pause 6s]
Si tu savais que tu meurs dans un an...
[pause 5s]
qu'est-ce que tu ferais différemment ?
[pause 15s]

Restez avec ce qui vient.
[pause 10s]

Et cette autre question.
[pause 6s]
Dans trente ans...
[pause 4s]
quelle est l'histoire que vous voulez pouvoir vous raconter sur votre vie ?
[pause 15s]

Ce module vous donne les outils pour construire une réponse vivante.
[pause 5s]
Pas abstraite.
[pause 5s]
Ancrée dans vos journées.
[pause 10s]

C'est par le corps que nous allons toucher ce qui nous anime vraiment.
[pause 8s]

Nous allons pratiquer la méthode cinq-cinq-cinq.
[pause 5s]

Cinq secondes pour inspirer.
[pause 2s]
Cinq secondes pour bloquer.
[pause 2s]
Cinq secondes pour expirer.
[pause 4s]
Dix cycles.
[pause 2s]
Deux minutes et demie de présence pure.
[pause 6s]

À l'inspiration... laissez la mâchoire s'ouvrir doucement.
[pause 4s]
Au blocage... restez dans ce silence... et laissez venir votre pourquoi.
[pause 4s]
À l'expiration... lèvres légèrement resserrées... laissez partir ce qui peut partir.
[pause 6s]

Si l'esprit part... laissez-le partir.
[pause 3s]
Et revenez simplement... au souffle.
[pause 7s]

Nous commençons.
[BREATHING_CYCLES]
[pause 20s]

Ce calme... c'est vous.
[pause 5s]
Simplement vous.
[pause 15s]

Laissez le souffle reprendre son rythme naturel.
[pause 10s]

Restez là.
[pause 8s]
Sans rien faire.
[pause 12s]

Y a-t-il une activité dans votre vie qui vous donne le sentiment d'exister pleinement ?
[pause 18s]

Si vous saviez que vous ne pouviez pas échouer... qu'est-ce que vous choisiriez de faire de votre vie ?
[pause 18s]

Qu'est-ce qui vous retient de vivre davantage en accord avec ce qui vous semble profondément vrai ?
[pause 18s]

Notez ce qui est venu... dans votre carnet.
[pause 5s]
Même si c'est juste un mot.
[pause 8s]

Le sens n'est pas trouvé.
[pause 5s]
Il est construit.
[pause 5s]
Geste après geste.
[pause 5s]
Jour après jour.
[pause 8s]
SCRIPT,

        // ─────────────────────────────────────────────────────────
        // PARCOURS 2 — Mouvement et posture
        // ─────────────────────────────────────────────────────────
        '07-mouvement-et-posture' => <<<'SCRIPT'
Fermez les yeux si c'est naturel.
[pause 5s]
Sentez votre corps tel qu'il est là... maintenant.
[pause 6s]
Sans le modifier.
[pause 5s]
Juste observer.
[pause 5s]
Est-ce que vous êtes tendu quelque part ?
[pause 5s]
Dans les épaules ?
[pause 4s]
Dans la mâchoire ?
[pause 4s]
Dans la nuque ?
[pause 8s]

Le corps humain a été conçu pour bouger.
[pause 5s]
Pendant deux millions d'années... nos ancêtres marchaient entre huit et quinze kilomètres par jour.
[pause 6s]
Ils portaient.
[pause 4s]
Ils couraient.
[pause 4s]
Ils grimpaient.
[pause 4s]
Ils s'accroupissaient.
[pause 6s]
Puis en quelques décennies... nous avons créé un monde où l'on peut passer une journée entière à ne presque pas bouger.
[pause 8s]

Notre système nerveux n'a pas eu le temps d'évoluer.
[pause 5s]
Il perçoit la sédentarité comme une menace.
[pause 5s]
Pas explicitement.
[pause 4s]
Mais biologiquement.
[pause 5s]
La sédentarité augmente le cortisol.
[pause 4s]
Elle réduit les connexions neuronales.
[pause 4s]
Elle fragmente le sommeil.
[pause 4s]
Elle amplifie l'anxiété.
[pause 8s]

Et la posture est son miroir.
[pause 5s]
Amy Cuddy — Harvard — a montré que deux minutes dans une posture contractée suffisent à modifier vos hormones.
[pause 5s]
Épaules rentrées... tête baissée... torse fermé.
[pause 5s]
Le cortisol monte.
[pause 4s]
La testostérone baisse.
[pause 4s]
La confiance diminue.
[pause 8s]

Et l'inverse est vrai.
[pause 5s]
Deux minutes de posture ouverte... dos droit... poitrine disponible.
[pause 5s]
Le corps reçoit un signal différent.
[pause 5s]
Et l'état intérieur change.
[pause 10s]

Faites-le maintenant.
[pause 4s]
Redressez-vous légèrement.
[pause 4s]
Ouvrez la poitrine.
[pause 4s]
Reculez légèrement les épaules.
[pause 4s]
Soulevez légèrement le menton.
[pause 6s]
Restez dans cette posture.
[pause 8s]

Remarquez la différence... même petite... dans votre état intérieur.
[pause 10s]

Le corps n'est pas le transporteur de votre tête.
[pause 5s]
Il est un organe de pensée à part entière.
[pause 5s]
Il traite l'information.
[pause 4s]
Il stocke les émotions.
[pause 4s]
Il prend des décisions.
[pause 5s]
Et il répond à la façon dont vous le traitez.
[pause 10s]

C'est par le corps que nous allons sentir comment la posture crée la présence.
[pause 8s]

Nous allons pratiquer la méthode cinq-cinq-cinq.
[pause 5s]

Cinq secondes pour inspirer.
[pause 2s]
Cinq secondes pour bloquer.
[pause 2s]
Cinq secondes pour expirer.
[pause 4s]
Dix cycles.
[pause 2s]
Deux minutes et demie de présence pure.
[pause 6s]

À l'inspiration... laissez la mâchoire s'ouvrir doucement.
[pause 4s]
Au blocage... restez dans ce silence... sentez les points de contact entre votre corps et ce qui le supporte.
[pause 4s]
À l'expiration... lèvres légèrement resserrées... laissez partir ce qui peut partir.
[pause 6s]

Si l'esprit part... laissez-le partir.
[pause 3s]
Et revenez simplement... au souffle.
[pause 7s]

Nous commençons.
[BREATHING_CYCLES]
[pause 20s]

Ce calme... c'est vous.
[pause 5s]
Simplement vous.
[pause 15s]

Laissez le souffle reprendre son rythme naturel.
[pause 10s]

Restez là.
[pause 8s]
Sans rien faire.
[pause 12s]

Comment décrieriez-vous votre posture habituelle dans la journée... assis... debout... en marchant ?
[pause 18s]

Y a-t-il un lien que vous avez déjà remarqué entre votre posture et votre état intérieur ?
[pause 18s]

Quel serait le premier geste de mouvement que vous seriez prêt à intégrer dans votre quotidien cette semaine ?
[pause 18s]

Notez ce qui est venu... dans votre carnet.
[pause 5s]
Même si c'est juste un mot.
[pause 8s]

Votre corps n'est pas le transporteur de votre tête.
[pause 5s]
C'est votre partenaire de vie.
[pause 5s]
Traitez-le en conséquence.
[pause 8s]
SCRIPT,

        // ─────────────────────────────────────────────────────────
        // PARCOURS 2 — Système nerveux autonome
        // ─────────────────────────────────────────────────────────
        '08-systeme-nerveux' => <<<'SCRIPT'
Installez-vous.
[pause 5s]
Avant de commencer... posez vos deux mains sur votre ventre.
[pause 6s]
Sentez le mouvement de votre respiration sous vos paumes.
[pause 6s]
Juste ça.
[pause 5s]
Rien d'autre pour le moment.
[pause 12s]

Ce module vous présente l'un des systèmes les plus influents sur votre qualité de vie.
[pause 6s]
Et l'un des moins connus.
[pause 5s]
Le système nerveux autonome.
[pause 10s]

Le système nerveux autonome a deux branches principales.
[pause 6s]
Le sympathique.
[pause 4s]
L'accélérateur.
[pause 4s]
Combat ou fuite.
[pause 4s]
Cortisol. Adrénaline. Vigilance. Tension.
[pause 4s]
Conçu pour répondre à un danger... pendant quelques minutes.
[pause 8s]

Et le parasympathique.
[pause 4s]
Le frein.
[pause 4s]
Repos et digestion.
[pause 4s]
Ocytocine. Sérotonine. Récupération. Présence.
[pause 4s]
Conçu pour restaurer... intégrer... régénérer.
[pause 8s]

Stephen Porges... psychiatre... a ajouté une troisième branche.
[pause 5s]
Le circuit social.
[pause 5s]
L'état dans lequel nous sommes capables de connexion... de curiosité... de joie.
[pause 5s]
De confiance.
[pause 5s]
C'est notre état optimal de fonctionnement humain.
[pause 10s]

Le problème de notre époque...
[pause 5s]
c'est que nos corps vivent en mode sympathique chronique.
[pause 5s]
Sans danger réel.
[pause 4s]
Mais avec une charge permanente de notifications... de comparaisons... d'urgences...
[pause 5s]
qui maintient l'accélérateur appuyé... sans jamais trouver le frein.
[pause 10s]

Trois techniques activent directement le parasympathique.
[pause 6s]
La respiration longue.
[pause 4s]
Une expiration plus longue que l'inspiration... ralentit le cœur.
[pause 4s]
C'est physiologique. Immédiat. Sans condition.
[pause 8s]
Le mouvement.
[pause 4s]
Une marche... même courte... dissipe les hormones de stress accumulées.
[pause 8s]
Et la connexion au vivant.
[pause 4s]
Un visage bienveillant. Une main posée. Un espace naturel.
[pause 4s]
Tout cela régule directement le système nerveux.
[pause 10s]

Ce module vous donne les outils pratiques.
[pause 5s]
Pour apprendre à vous réguler.
[pause 4s]
À connaître vos propres signaux.
[pause 4s]
Et à repositionner votre système nerveux... là où vous pouvez fonctionner à votre meilleur.
[pause 10s]

C'est par le corps que nous allons entraîner notre système nerveux vers la régulation.
[pause 8s]

Nous allons pratiquer la méthode cinq-cinq-cinq.
[pause 5s]

Cinq secondes pour inspirer.
[pause 2s]
Cinq secondes pour bloquer.
[pause 2s]
Cinq secondes pour expirer.
[pause 4s]
Dix cycles.
[pause 2s]
Deux minutes et demie de présence pure.
[pause 6s]

À l'inspiration... laissez la mâchoire s'ouvrir doucement.
[pause 4s]
Au blocage... restez dans ce silence... et observez l'état de votre système nerveux en ce moment.
[pause 4s]
À l'expiration... lèvres légèrement resserrées... laissez partir ce qui peut partir.
[pause 6s]

Si l'esprit part... laissez-le partir.
[pause 3s]
Et revenez simplement... au souffle.
[pause 7s]

Nous commençons.
[BREATHING_CYCLES]
[pause 20s]

Ce calme... c'est vous.
[pause 5s]
Simplement vous.
[pause 15s]

Laissez le souffle reprendre son rythme naturel.
[pause 10s]

Restez là.
[pause 8s]
Sans rien faire.
[pause 12s]

Dans votre quotidien... quels sont les principaux déclencheurs qui activent votre système de stress ?
[pause 18s]

Avez-vous des pratiques régulières qui activent votre parasympathique... votre mode repos-réparation ?
[pause 18s]

Quelle serait une pratique simple... cinq à dix minutes... que vous pourriez intégrer dès cette semaine pour réguler votre système nerveux ?
[pause 18s]

Notez ce qui est venu... dans votre carnet.
[pause 5s]
Même si c'est juste un mot.
[pause 8s]

Votre système nerveux peut apprendre.
[pause 5s]
La régulation n'est pas un état fixe.
[pause 5s]
C'est une compétence.
[pause 8s]
SCRIPT,

        // ─────────────────────────────────────────────────────────
        // PARCOURS 2 — Gestion des émotions
        // ─────────────────────────────────────────────────────────
        '09-gestion-des-emotions' => <<<'SCRIPT'
Installez-vous.
[pause 5s]
Respirez normalement.
[pause 5s]
Et reposez-vous cette question honnêtement.
[pause 5s]
Quelle émotion est présente en ce moment ?
[pause 8s]

Pas l'émotion que vous devriez ressentir.
[pause 5s]
Pas celle qui est acceptable.
[pause 5s]
Celle qui est là.
[pause 10s]

Les émotions ne sont pas des ennemies.
[pause 5s]
Ce sont des messagères.
[pause 5s]
Elles ont une fonction biologique précise.
[pause 5s]
La peur vous protège.
[pause 4s]
La colère défend vos frontières.
[pause 4s]
La tristesse intègre une perte.
[pause 4s]
La joie renforce ce qui nourrit.
[pause 4s]
La honte maintient l'appartenance sociale.
[pause 8s]

Le problème n'est pas d'avoir des émotions.
[pause 5s]
C'est de ne pas savoir quoi en faire.
[pause 5s]
De les subir.
[pause 4s]
Ou de les supprimer.
[pause 4s]
Ou de les amplifier par la rumination.
[pause 8s]

Paul Ekman a identifié six émotions universelles.
[pause 5s]
Présentes dans toutes les cultures de la planète.
[pause 5s]
La colère. La peur. La tristesse. La joie. Le dégoût. La surprise.
[pause 6s]
Elles s'expriment dans le corps avant de monter à la conscience.
[pause 5s]
Avant d'avoir un mot.
[pause 5s]
Elles sont là... dans la tension musculaire... dans le rythme cardiaque... dans la respiration.
[pause 10s]

La compétence émotionnelle commence par l'identification.
[pause 5s]
Nommer une émotion... réduit son intensité.
[pause 5s]
Les études de neuroimagerie le montrent.
[pause 5s]
Mettre des mots sur ce qu'on ressent... active le cortex préfrontal.
[pause 5s]
Et réduit l'activité de l'amygdale.
[pause 5s]
La partie réactive du cerveau.
[pause 10s]

Vous n'avez pas à contrôler ce que vous ressentez.
[pause 5s]
Vous avez à vous permettre de le ressentir... consciemment.
[pause 5s]
Et à choisir ce que vous en faites.
[pause 5s]
Pas en réaction.
[pause 5s]
En réponse.
[pause 10s]

C'est par le corps que nous allons apprendre à recevoir et traverser les émotions.
[pause 8s]

Nous allons pratiquer la méthode cinq-cinq-cinq.
[pause 5s]

Cinq secondes pour inspirer.
[pause 2s]
Cinq secondes pour bloquer.
[pause 2s]
Cinq secondes pour expirer.
[pause 4s]
Dix cycles.
[pause 2s]
Deux minutes et demie de présence pure.
[pause 6s]

À l'inspiration... laissez la mâchoire s'ouvrir doucement.
[pause 4s]
Au blocage... restez dans ce silence... observez l'émotion qui est là... sans la juger.
[pause 4s]
À l'expiration... lèvres légèrement resserrées... laissez partir ce qui peut partir.
[pause 6s]

Si l'esprit part... laissez-le partir.
[pause 3s]
Et revenez simplement... au souffle.
[pause 7s]

Nous commençons.
[BREATHING_CYCLES]
[pause 20s]

Ce calme... c'est vous.
[pause 5s]
Simplement vous.
[pause 15s]

Laissez le souffle reprendre son rythme naturel.
[pause 10s]

Restez là.
[pause 8s]
Sans rien faire.
[pause 12s]

Y a-t-il une émotion que vous tendez à éviter... et quelle stratégie utilisez-vous pour l'éviter ?
[pause 18s]

Lorsqu'une émotion intense surgit... comment réagissez-vous... la contrôlez-vous... la fuyez-vous... ou la traversez-vous ?
[pause 18s]

Quelle leçon une émotion récurrente pourrait-elle essayer de vous transmettre ?
[pause 18s]

Notez ce qui est venu... dans votre carnet.
[pause 5s]
Même si c'est juste un mot.
[pause 8s]

Les émotions ne sont pas vos ennemies.
[pause 5s]
Elles sont vos informatrices.
[pause 5s]
Commencez à les écouter.
[pause 8s]
SCRIPT,

        // ─────────────────────────────────────────────────────────
        // PARCOURS 2 — Vivre ici et maintenant
        // ─────────────────────────────────────────────────────────
        '10-vivre-ici-et-maintenant' => <<<'SCRIPT'
Posez ce que vous avez en main.
[pause 5s]
Littéralement.
[pause 4s]
Si vous tenez quelque chose... posez-le.
[pause 5s]
Sentez vos pieds sur le sol.
[pause 5s]
Le contact de votre dos sur le siège ou le lit.
[pause 6s]
La température de l'air.
[pause 5s]
Les sons autour de vous... sans les juger.
[pause 8s]

Vous êtes ici.
[pause 5s]
Maintenant.
[pause 5s]
C'est le seul moment qui existe vraiment.
[pause 10s]

Une étude de Harvard — Matthew Killingsworth et Daniel Gilbert —
[pause 5s]
a suivi quarante-sept pour cent du temps...
[pause 4s]
les esprits humains ne sont pas là où se trouve leur corps.
[pause 6s]
Quarante-sept pour cent du temps... les gens pensent à autre chose que ce qu'ils font.
[pause 5s]
Au passé.
[pause 4s]
Au futur.
[pause 4s]
À des scénarios imaginaires.
[pause 8s]

Et la conclusion ?
[pause 5s]
Cet état de vagabondage mental est associé à un niveau de bonheur significativement plus bas.
[pause 5s]
Peu importe l'activité.
[pause 5s]
Même les activités désagréables... vécues avec présence...
[pause 5s]
produisaient plus de bien-être que les activités agréables vécues en distraction.
[pause 10s]

La pleine présence n'est pas un luxe spirituel.
[pause 5s]
C'est une compétence.
[pause 5s]
Neurologique. Entraînable. Mesurable.
[pause 8s]

Jon Kabat-Zinn a eu cette phrase.
[pause 5s]
Vous ne pouvez pas arrêter les vagues.
[pause 5s]
Mais vous pouvez apprendre à surfer.
[pause 10s]

Remarquez maintenant.
[pause 5s]
Où est votre esprit ?
[pause 5s]
Est-ce qu'il est ici... avec cette méditation ?
[pause 5s]
Ou est-il parti quelque part d'autre ?
[pause 6s]
Pas de jugement.
[pause 4s]
Juste une observation.
[pause 4s]
Et si vous êtes parti... la simple notice est le retour.
[pause 10s]

C'est par le corps que nous allons ancrer notre présence dans ce moment.
[pause 8s]

Nous allons pratiquer la méthode cinq-cinq-cinq.
[pause 5s]

Cinq secondes pour inspirer.
[pause 2s]
Cinq secondes pour bloquer.
[pause 2s]
Cinq secondes pour expirer.
[pause 4s]
Dix cycles.
[pause 2s]
Deux minutes et demie de présence pure.
[pause 6s]

À l'inspiration... laissez la mâchoire s'ouvrir doucement.
[pause 4s]
Au blocage... restez dans ce silence... soyez ici... entièrement.
[pause 4s]
À l'expiration... lèvres légèrement resserrées... laissez partir ce qui peut partir.
[pause 6s]

Si l'esprit part... laissez-le partir.
[pause 3s]
Et revenez simplement... au souffle.
[pause 7s]

Nous commençons.
[BREATHING_CYCLES]
[pause 20s]

Ce calme... c'est vous.
[pause 5s]
Simplement vous.
[pause 15s]

Laissez le souffle reprendre son rythme naturel.
[pause 10s]

Restez là.
[pause 8s]
Sans rien faire.
[pause 12s]

Dans quels moments de votre journée êtes-vous le plus souvent absent... en pilote automatique ?
[pause 18s]

Y a-t-il une activité quotidienne que vous pourriez transformer en pratique de présence... manger... marcher... écouter ?
[pause 18s]

Que perdez-vous dans votre vie quotidienne... parce que vous n'êtes pas pleinement présent ?
[pause 18s]

Notez ce qui est venu... dans votre carnet.
[pause 5s]
Même si c'est juste un mot.
[pause 8s]

La présence n'est pas une destination.
[pause 5s]
C'est une pratique.
[pause 5s]
Moment après moment.
[pause 8s]
SCRIPT,

        // ─────────────────────────────────────────────────────────
        // PARCOURS 2 — Sommeil et récupération
        // ─────────────────────────────────────────────────────────
        '10-sommeil-et-recuperation' => <<<'SCRIPT'
Installez-vous.
[pause 5s]
Ce module peut s'écouter le soir avant de dormir.
[pause 5s]
Ou en toute autre occasion.
[pause 5s]
Mais si vous êtes là le soir... laissez votre corps s'alourdir un peu.
[pause 5s]
Laissez les paupières devenir lourdes si elles le veulent.
[pause 10s]

Matthew Walker... neuroscientifique à Berkeley... a passé sa carrière à étudier le sommeil.
[pause 5s]
Sa conclusion est sans ambiguïté.
[pause 5s]
Le sommeil n'est pas un luxe.
[pause 5s]
C'est la fondation biologique de tout le reste.
[pause 8s]

En une nuit de mauvais sommeil...
[pause 5s]
votre capacité d'attention baisse de trente pour cent.
[pause 5s]
Votre régulation émotionnelle s'effondre.
[pause 5s]
Votre mémoire consolidée la nuit précédente est partiellement effacée.
[pause 5s]
Votre système immunitaire ralentit.
[pause 5s]
Et vos décisions deviennent mesurables plus mauvaises.
[pause 8s]

Et voici la découverte qui devrait nous arrêter.
[pause 5s]
Après dix à douze jours de manque de sommeil chronique...
[pause 5s]
les gens ne ressentent plus la fatigue comme un signal d'alarme.
[pause 5s]
Ils se croient adaptés.
[pause 5s]
Ils ne le sont pas.
[pause 5s]
Leurs performances cognitives ont continué de baisser.
[pause 5s]
Mais ils ont cessé de le sentir.
[pause 10s]

Le sommeil n'est pas du temps passif.
[pause 5s]
C'est le moment où le cerveau se nettoie... littéralement.
[pause 5s]
Le système glymphatique active.
[pause 5s]
Les déchets métaboliques... dont les protéines liées à Alzheimer...
[pause 5s]
sont évacués uniquement pendant le sommeil profond.
[pause 8s]

Ce module vous donne les outils pour hygiéniser votre sommeil.
[pause 5s]
Rituels du soir.
[pause 4s]
Architecture de la chambre.
[pause 4s]
Régulation de la lumière bleue.
[pause 4s]
Température.
[pause 4s]
Consistance des horaires.
[pause 8s]

Pas comme une contrainte de plus.
[pause 5s]
Comme un investissement qui rend tout le reste plus facile.
[pause 10s]

C'est par le corps que nous allons honorer notre besoin de récupération.
[pause 8s]

Nous allons pratiquer la méthode cinq-cinq-cinq.
[pause 5s]

Cinq secondes pour inspirer.
[pause 2s]
Cinq secondes pour bloquer.
[pause 2s]
Cinq secondes pour expirer.
[pause 4s]
Dix cycles.
[pause 2s]
Deux minutes et demie de présence pure.
[pause 6s]

À l'inspiration... laissez la mâchoire s'ouvrir doucement.
[pause 4s]
Au blocage... restez dans ce silence... et laissez votre corps se souvenir de ce que c'est que de vraiment reposer.
[pause 4s]
À l'expiration... lèvres légèrement resserrées... laissez partir ce qui peut partir.
[pause 6s]

Si l'esprit part... laissez-le partir.
[pause 3s]
Et revenez simplement... au souffle.
[pause 7s]

Nous commençons.
[BREATHING_CYCLES]
[pause 20s]

Ce calme... c'est vous.
[pause 5s]
Simplement vous.
[pause 15s]

Laissez le souffle reprendre son rythme naturel.
[pause 10s]

Restez là.
[pause 8s]
Sans rien faire.
[pause 12s]

Comment qualifieriez-vous la qualité de votre sommeil au cours des dernières semaines ?
[pause 18s]

Y a-t-il des habitudes dans votre rituel du soir qui nuisent à votre sommeil... sans que vous les ayez vraiment questionnées ?
[pause 18s]

Quel serait le premier changement concret que vous pourriez apporter à votre routine du sommeil ?
[pause 18s]

Notez ce qui est venu... dans votre carnet.
[pause 5s]
Même si c'est juste un mot.
[pause 8s]

Le sommeil n'est pas du temps perdu.
[pause 5s]
C'est l'investissement qui rend tout le reste possible.
[pause 8s]
SCRIPT,

        // ─────────────────────────────────────────────────────────
        // PARCOURS 2 — Relation à l'alimentation
        // ─────────────────────────────────────────────────────────
        '11-relation-alimentation' => <<<'SCRIPT'
Installez-vous.
[pause 5s]
Avant de commencer... posez cette question sans défense.
[pause 6s]
Quelle est ma véritable relation à la nourriture ?
[pause 8s]
Pas ce que je mange.
[pause 5s]
Mais pourquoi je mange... quand je mange... et comment.
[pause 10s]

Il y a une différence fondamentale entre nourrir et manger.
[pause 6s]
Nourrir... c'est fournir ce dont le corps a besoin pour fonctionner et se réparer.
[pause 5s]
Manger... c'est tout le reste.
[pause 5s]
Combler l'ennui.
[pause 4s]
Gérer le stress.
[pause 4s]
Fêter... punir... récompenser.
[pause 4s]
Appartenir à un groupe.
[pause 4s]
Combler un vide émotionnel.
[pause 8s]

La plupart des comportements alimentaires problématiques n'ont pas de cause alimentaire.
[pause 5s]
Ils ont une cause émotionnelle.
[pause 5s]
Ou relationnelle.
[pause 5s]
Ou psychologique.
[pause 8s]

La pleine conscience alimentaire —
[pause 5s]
manger lentement... sans écran... avec attention —
[pause 5s]
réduit l'apport calorique de vingt à trente pour cent.
[pause 5s]
Pas par restriction.
[pause 5s]
Par satiété réelle.
[pause 5s]
Parce que le corps peut enfin se faire entendre.
[pause 10s]

Remarquez la prochaine fois que vous mangez.
[pause 5s]
Avez-vous faim... ou ressentez-vous autre chose ?
[pause 6s]
Mangez-vous en présence... ou en automatique ?
[pause 6s]
Est-ce que ce que vous mangez vous nourrit... ou accomplit autre chose ?
[pause 10s]

Ce module ne prescrit pas un régime.
[pause 5s]
Il vous invite à une relation différente avec ce que vous mangez.
[pause 5s]
Consciente.
[pause 4s]
Bienveillante.
[pause 4s]
Informée.
[pause 10s]

C'est par le corps que nous allons transformer notre relation à la nourriture.
[pause 8s]

Nous allons pratiquer la méthode cinq-cinq-cinq.
[pause 5s]

Cinq secondes pour inspirer.
[pause 2s]
Cinq secondes pour bloquer.
[pause 2s]
Cinq secondes pour expirer.
[pause 4s]
Dix cycles.
[pause 2s]
Deux minutes et demie de présence pure.
[pause 6s]

À l'inspiration... laissez la mâchoire s'ouvrir doucement.
[pause 4s]
Au blocage... restez dans ce silence... observez votre rapport à la nourriture sans le juger.
[pause 4s]
À l'expiration... lèvres légèrement resserrées... laissez partir ce qui peut partir.
[pause 6s]

Si l'esprit part... laissez-le partir.
[pause 3s]
Et revenez simplement... au souffle.
[pause 7s]

Nous commençons.
[BREATHING_CYCLES]
[pause 20s]

Ce calme... c'est vous.
[pause 5s]
Simplement vous.
[pause 15s]

Laissez le souffle reprendre son rythme naturel.
[pause 10s]

Restez là.
[pause 8s]
Sans rien faire.
[pause 12s]

Y a-t-il des moments dans votre semaine où vous mangez de façon émotionnelle plutôt que physique ?
[pause 18s]

Quand avez-vous mangé pour la dernière fois avec une pleine présence... sans écran... sans distraction ?
[pause 18s]

Quelle serait une pratique simple de pleine conscience alimentaire que vous pourriez intégrer dès aujourd'hui ?
[pause 18s]

Notez ce qui est venu... dans votre carnet.
[pause 5s]
Même si c'est juste un mot.
[pause 8s]

Nourrir votre corps avec conscience... c'est vous respecter à chaque repas.
[pause 8s]
SCRIPT,

        // ─────────────────────────────────────────────────────────
        // PARCOURS 2 — Activité physique
        // ─────────────────────────────────────────────────────────
        '15-activite-physique' => <<<'SCRIPT'
Installez-vous.
[pause 5s]
Respirez.
[pause 6s]
Et laissez-moi vous raconter quelque chose que la plupart des gens ne savent pas.
[pause 8s]

L'exercice physique est l'antidépresseur le plus efficace jamais étudié.
[pause 5s]
Pas une métaphore.
[pause 5s]
Une donnée de méta-analyse.
[pause 5s]
Plus efficace que certains médicaments... sans les effets secondaires.
[pause 10s]

Blumenthal... à Duke... a mené une étude rigoureuse.
[pause 5s]
Dépression modérée à sévère.
[pause 5s]
Trois groupes.
[pause 4s]
Médicaments seuls.
[pause 4s]
Exercice seul.
[pause 4s]
Médicaments et exercice.
[pause 6s]
À six mois... le groupe exercice seul avait les mêmes résultats que les médicaments.
[pause 5s]
Et le taux de rechute... dans ce groupe... était le plus bas de tous.
[pause 10s]

Pourquoi ?
[pause 5s]
Parce que l'exercice génère du BDNF.
[pause 5s]
Brain-Derived Neurotrophic Factor.
[pause 5s]
Ce que John Ratey appelle Miracle-Gro pour le cerveau.
[pause 5s]
Un facteur de croissance neuronal.
[pause 5s]
Qui renforce les connexions... améliore la mémoire... et réduit l'anxiété.
[pause 8s]

Cent cinquante minutes par semaine à intensité modérée.
[pause 5s]
Trente minutes cinq fois par semaine.
[pause 5s]
C'est le seuil recommandé pour des effets significatifs.
[pause 5s]
Pas de salle de sport obligatoire.
[pause 5s]
Pas d'équipement.
[pause 5s]
Une marche rapide... un vélo... une nage... une danse.
[pause 5s]
Votre corps n'a pas besoin de performance.
[pause 5s]
Il a besoin de mouvement.
[pause 10s]

Ce module vous aide à trouver votre forme d'activité.
[pause 5s]
Celle qui vous ressemble.
[pause 4s]
Celle qui dure dans le temps parce qu'elle n'est pas une punition.
[pause 5s]
Mais une rencontre avec votre propre vitalité.
[pause 10s]

C'est par le corps que nous allons retrouver le plaisir de bouger.
[pause 8s]

Nous allons pratiquer la méthode cinq-cinq-cinq.
[pause 5s]

Cinq secondes pour inspirer.
[pause 2s]
Cinq secondes pour bloquer.
[pause 2s]
Cinq secondes pour expirer.
[pause 4s]
Dix cycles.
[pause 2s]
Deux minutes et demie de présence pure.
[pause 6s]

À l'inspiration... laissez la mâchoire s'ouvrir doucement.
[pause 4s]
Au blocage... restez dans ce silence... laissez venir le souvenir d'un moment où vous avez ressenti votre vitalité corporelle.
[pause 4s]
À l'expiration... lèvres légèrement resserrées... laissez partir ce qui peut partir.
[pause 6s]

Si l'esprit part... laissez-le partir.
[pause 3s]
Et revenez simplement... au souffle.
[pause 7s]

Nous commençons.
[BREATHING_CYCLES]
[pause 20s]

Ce calme... c'est vous.
[pause 5s]
Simplement vous.
[pause 15s]

Laissez le souffle reprendre son rythme naturel.
[pause 10s]

Restez là.
[pause 8s]
Sans rien faire.
[pause 12s]

Quel est votre niveau d'activité physique actuel... et en êtes-vous satisfait ?
[pause 18s]

Y a-t-il une forme de mouvement qui vous procure du plaisir... que vous ne vous accordez pas suffisamment ?
[pause 18s]

Quel serait le premier pas réaliste pour intégrer davantage de mouvement dans votre vie cette semaine ?
[pause 18s]

Notez ce qui est venu... dans votre carnet.
[pause 5s]
Même si c'est juste un mot.
[pause 8s]

Vous n'avez pas besoin de performance.
[pause 5s]
Vous avez besoin de mouvement.
[pause 5s]
Votre corps... lui... le sait déjà.
[pause 8s]
SCRIPT,

        // ─────────────────────────────────────────────────────────
        // PARCOURS 2 — Nutrition et vitalité
        // ─────────────────────────────────────────────────────────
        '22-nutrition-et-vitalite' => <<<'SCRIPT'
Installez-vous.
[pause 5s]
Posez vos mains sur votre ventre.
[pause 5s]
Sentez le mouvement de votre respiration.
[pause 8s]

Votre intestin contient environ cent millions de neurones.
[pause 5s]
Il produit plus de quatre-vingt-quinze pour cent de la sérotonine de votre corps.
[pause 5s]
Ce que vous mangez... affecte directement ce que vous ressentez.
[pause 5s]
Pas indirectement.
[pause 5s]
Directement.
[pause 10s]

Ce module ne parle pas de calories.
[pause 5s]
Il parle d'information.
[pause 5s]
Parce que la nourriture est un signal.
[pause 5s]
Chaque repas dit quelque chose à vos cellules.
[pause 5s]
À vos hormones.
[pause 5s]
À votre microbiote.
[pause 5s]
À votre humeur.
[pause 8s]

Les sucres rapides créent des pics d'insuline...
[pause 5s]
suivis de creux... suivis d'envies... suivis de pics.
[pause 5s]
Un cycle qui pilote silencieusement votre énergie, votre concentration et votre humeur.
[pause 8s]

Les graisses de qualité... les oméga-3... les fibres... les polyphénols...
[pause 5s]
nourrissent le microbiote.
[pause 5s]
Réduisent l'inflammation chronique.
[pause 5s]
Et soutiennent la production de neurotransmetteurs.
[pause 8s]

Ce n'est pas de la discipline.
[pause 5s]
C'est de la biochimie.
[pause 5s]
Et quand vous comprenez ce que chaque aliment fait réellement...
[pause 5s]
les choix deviennent naturellement différents.
[pause 10s]

Ce module vous donne les fondamentaux.
[pause 5s]
Pas un régime.
[pause 4s]
Une connaissance.
[pause 4s]
Qui vous appartient et que personne ne peut vous retirer.
[pause 10s]

C'est par le corps que nous allons comprendre comment la nutrition façonne notre vitalité.
[pause 8s]

Nous allons pratiquer la méthode cinq-cinq-cinq.
[pause 5s]

Cinq secondes pour inspirer.
[pause 2s]
Cinq secondes pour bloquer.
[pause 2s]
Cinq secondes pour expirer.
[pause 4s]
Dix cycles.
[pause 2s]
Deux minutes et demie de présence pure.
[pause 6s]

À l'inspiration... laissez la mâchoire s'ouvrir doucement.
[pause 4s]
Au blocage... restez dans ce silence... sentez comment votre corps se sent... en ce moment... après ce que vous avez mangé aujourd'hui.
[pause 4s]
À l'expiration... lèvres légèrement resserrées... laissez partir ce qui peut partir.
[pause 6s]

Si l'esprit part... laissez-le partir.
[pause 3s]
Et revenez simplement... au souffle.
[pause 7s]

Nous commençons.
[BREATHING_CYCLES]
[pause 20s]

Ce calme... c'est vous.
[pause 5s]
Simplement vous.
[pause 15s]

Laissez le souffle reprendre son rythme naturel.
[pause 10s]

Restez là.
[pause 8s]
Sans rien faire.
[pause 12s]

Y a-t-il un aliment ou une habitude alimentaire que vous savez nuisible... mais que vous peinez à changer ?
[pause 18s]

Remarquez-vous un lien entre ce que vous mangez et votre niveau d'énergie ou votre humeur ?
[pause 18s]

Quelle serait une modification simple dans votre alimentation que vous pourriez tester pendant une semaine ?
[pause 18s]

Notez ce qui est venu... dans votre carnet.
[pause 5s]
Même si c'est juste un mot.
[pause 8s]

Vous êtes en partie fait de ce que vous mangez.
[pause 5s]
Chaque repas est une information envoyée à votre biologie.
[pause 8s]
SCRIPT,

        // ─────────────────────────────────────────────────────────
        // PARCOURS 2 — Médecines complémentaires
        // ─────────────────────────────────────────────────────────
        '19-medecines-complementaires' => <<<'SCRIPT'
Installez-vous.
[pause 5s]
Respirez normalement.
[pause 6s]
Et laissez ce module vous inviter à élargir votre perspective.
[pause 8s]

La médecine conventionnelle est magnificente pour les urgences.
[pause 5s]
Pour les infections.
[pause 4s]
Pour la chirurgie.
[pause 4s]
Pour les pathologies aiguës.
[pause 6s]
Elle sauve des vies chaque jour.
[pause 8s]

Mais pour la santé chronique...
[pause 5s]
Pour le bien-être durable...
[pause 5s]
Pour les déséquilibres fonctionnels qui ne trouvent pas de réponse dans le modèle bio-médical classique...
[pause 6s]
d'autres approches méritent d'être connues.
[pause 10s]

L'ostéopathie.
[pause 4s]
Travaille sur les tensions musculo-squelettiques... les restrictions de mobilité... et leur impact sur les systèmes viscéraux.
[pause 8s]
La naturopathie.
[pause 4s]
S'intéresse aux causes profondes des dysfonctions... alimentation... mode de vie... terrain individuel.
[pause 8s]
L'acupuncture.
[pause 4s]
Validée par des méta-analyses pour certaines indications... douleurs chroniques... migraines... anxiété.
[pause 8s]
La méditation et le yoga.
[pause 4s]
Avec des effets mesurés sur l'inflammation... le système nerveux... et la qualité du sommeil.
[pause 8s]

Ce module ne vous prescrit rien.
[pause 5s]
Il vous informe.
[pause 5s]
Pour que vous puissiez choisir de façon éclairée...
[pause 5s]
plutôt que de naviguer par hasard ou par publicité.
[pause 8s]

Votre santé est un territoire.
[pause 5s]
La connaissance est votre meilleure carte.
[pause 10s]

C'est par le corps que nous allons ouvrir notre perspective sur la santé globale.
[pause 8s]

Nous allons pratiquer la méthode cinq-cinq-cinq.
[pause 5s]

Cinq secondes pour inspirer.
[pause 2s]
Cinq secondes pour bloquer.
[pause 2s]
Cinq secondes pour expirer.
[pause 4s]
Dix cycles.
[pause 2s]
Deux minutes et demie de présence pure.
[pause 6s]

À l'inspiration... laissez la mâchoire s'ouvrir doucement.
[pause 4s]
Au blocage... restez dans ce silence... et demandez-vous honnêtement... est-ce que je prends soin de moi de façon globale ?
[pause 4s]
À l'expiration... lèvres légèrement resserrées... laissez partir ce qui peut partir.
[pause 6s]

Si l'esprit part... laissez-le partir.
[pause 3s]
Et revenez simplement... au souffle.
[pause 7s]

Nous commençons.
[BREATHING_CYCLES]
[pause 20s]

Ce calme... c'est vous.
[pause 5s]
Simplement vous.
[pause 15s]

Laissez le souffle reprendre son rythme naturel.
[pause 10s]

Restez là.
[pause 8s]
Sans rien faire.
[pause 12s]

Y a-t-il une médecine complémentaire que vous n'avez pas encore explorée... par manque d'information ?
[pause 18s]

Dans votre approche de votre santé... traitez-vous surtout les symptômes... ou cherchez-vous aussi les causes ?
[pause 18s]

Quelle serait la prochaine étape pour enrichir votre approche de votre santé ?
[pause 18s]

Notez ce qui est venu... dans votre carnet.
[pause 5s]
Même si c'est juste un mot.
[pause 8s]

Votre santé mérite une pensée globale.
[pause 5s]
Intégrative.
[pause 5s]
Curieuse.
[pause 5s]
Et informée.
[pause 8s]
SCRIPT,

        // ─────────────────────────────────────────────────────────
        // PARCOURS 3 — Présence à soi
        // ─────────────────────────────────────────────────────────
        '12-presence-a-soi' => <<<'SCRIPT'
Installez-vous.
[pause 5s]
Fermez les yeux.
[pause 5s]
Et posez cette question douce.
[pause 6s]
Comment est-ce que je me sens... vraiment... en ce moment ?
[pause 10s]

Pas ce que vous pensez devoir ressentir.
[pause 5s]
Ce qui est là.
[pause 10s]

La présence à soi est une forme de perception intérieure.
[pause 6s]
Les chercheurs l'appellent intéroception.
[pause 5s]
La capacité à percevoir les signaux internes du corps.
[pause 5s]
Le rythme cardiaque.
[pause 4s]
La tension musculaire.
[pause 4s]
La faim.
[pause 4s]
La fatigue.
[pause 4s]
Les states émotionnels avant qu'ils ne soient conscients.
[pause 8s]

Cette capacité prédit...
[pause 5s]
la régulation émotionnelle.
[pause 4s]
La qualité des décisions.
[pause 4s]
La résistance au stress.
[pause 4s]
Et la profondeur des relations.
[pause 8s]

Mais dans notre monde hyperconnecté...
[pause 5s]
nous sommes formés à nous tourner vers l'extérieur.
[pause 5s]
À vérifier ce que les autres pensent.
[pause 4s]
À chercher la validation.
[pause 4s]
À combler le silence avec du bruit.
[pause 6s]
Et cette attention permanente vers l'extérieur... affaiblit le muscle intérieur.
[pause 8s]

Ce parcours est un retour.
[pause 5s]
Un retour à soi.
[pause 5s]
Pas comme une retraite du monde.
[pause 5s]
Mais comme un ancrage.
[pause 5s]
Qui permet d'être pleinement présent dans le monde.
[pause 5s]
Parce qu'on est d'abord présent à soi.
[pause 10s]

Remarquez pendant les prochaines secondes.
[pause 5s]
Un signal dans votre corps.
[pause 5s]
N'importe lequel.
[pause 5s]
Une tension.
[pause 4s]
Une chaleur.
[pause 4s]
Un rythme.
[pause 4s]
Un relâchement.
[pause 8s]

Voilà votre intéroception à l'œuvre.
[pause 5s]
Elle était là... elle a toujours été là.
[pause 5s]
Ce module vous apprend à l'écouter davantage.
[pause 10s]

C'est par le corps que nous allons développer notre présence à nous-mêmes.
[pause 8s]

Nous allons pratiquer la méthode cinq-cinq-cinq.
[pause 5s]

Cinq secondes pour inspirer.
[pause 2s]
Cinq secondes pour bloquer.
[pause 2s]
Cinq secondes pour expirer.
[pause 4s]
Dix cycles.
[pause 2s]
Deux minutes et demie de présence pure.
[pause 6s]

À l'inspiration... laissez la mâchoire s'ouvrir doucement.
[pause 4s]
Au blocage... restez dans ce silence... percevez les signaux subtils de votre corps... sans les analyser.
[pause 4s]
À l'expiration... lèvres légèrement resserrées... laissez partir ce qui peut partir.
[pause 6s]

Si l'esprit part... laissez-le partir.
[pause 3s]
Et revenez simplement... au souffle.
[pause 7s]

Nous commençons.
[BREATHING_CYCLES]
[pause 20s]

Ce calme... c'est vous.
[pause 5s]
Simplement vous.
[pause 15s]

Laissez le souffle reprendre son rythme naturel.
[pause 10s]

Restez là.
[pause 8s]
Sans rien faire.
[pause 12s]

Dans votre quotidien... prenez-vous le temps de vous demander comment vous vous sentez vraiment ?
[pause 18s]

Y a-t-il un signal de votre corps que vous ignorez régulièrement... fatigue... tension... inconfort ?
[pause 18s]

Quel serait un moment dans votre journée que vous pourriez transformer en un mini-check-in avec vous-même ?
[pause 18s]

Notez ce qui est venu... dans votre carnet.
[pause 5s]
Même si c'est juste un mot.
[pause 8s]

Plus vous êtes présent à vous-même...
[pause 5s]
plus vous pouvez l'être pour les autres.
[pause 5s]
L'intérieur précède l'extérieur.
[pause 8s]
SCRIPT,

        // ─────────────────────────────────────────────────────────
        // PARCOURS 3 — Confiance corporelle
        // ─────────────────────────────────────────────────────────
        '13-confiance-corporelle' => <<<'SCRIPT'
Installez-vous.
[pause 5s]
Respirez.
[pause 6s]
Et sans vous juger... posez votre regard intérieur sur votre corps.
[pause 6s]
Pas esthétiquement.
[pause 4s]
Fonctionnellement.
[pause 5s]
Ce corps qui vous porte.
[pause 4s]
Qui respire sans que vous le demandiez.
[pause 4s]
Qui guérit vos petites blessures chaque jour.
[pause 4s]
Qui régule votre température.
[pause 4s]
Qui traite des milliards d'informations en ce moment même.
[pause 8s]

La confiance corporelle n'est pas une histoire de formes.
[pause 5s]
C'est une histoire de relation.
[pause 5s]
La relation que vous avez avec votre propre corps.
[pause 8s]

Pour beaucoup d'entre nous... cette relation a été perturbée tôt.
[pause 5s]
Par des regards.
[pause 4s]
Des commentaires.
[pause 4s]
Des comparaisons.
[pause 4s]
Des messages culturels sur ce qu'un corps devrait être.
[pause 6s]
Et nous avons appris à voir notre corps comme un problème à corriger...
[pause 5s]
plutôt que comme un partenaire à respecter.
[pause 10s]

La recherche de Kristin Neff sur l'auto-compassion montre que...
[pause 5s]
se traiter avec la même bienveillance qu'un ami...
[pause 5s]
réduit l'anxiété corporelle... améliore l'image de soi...
[pause 5s]
et paradoxalement... améliore les comportements de santé.
[pause 8s]

Pas en se mentant sur la réalité.
[pause 5s]
Mais en cessant d'être son propre ennemi.
[pause 10s]

Posez maintenant votre main sur une partie de votre corps.
[pause 5s]
N'importe laquelle.
[pause 5s]
Et envoyez-lui... ne serait-ce qu'un moment... de la gratitude.
[pause 6s]
Pour ce qu'elle fait.
[pause 4s]
Pour ce qu'elle supporte.
[pause 4s]
Pour ce qu'elle vous permet.
[pause 12s]

C'est par le corps que nous allons cultiver une relation de gratitude avec lui.
[pause 8s]

Nous allons pratiquer la méthode cinq-cinq-cinq.
[pause 5s]

Cinq secondes pour inspirer.
[pause 2s]
Cinq secondes pour bloquer.
[pause 2s]
Cinq secondes pour expirer.
[pause 4s]
Dix cycles.
[pause 2s]
Deux minutes et demie de présence pure.
[pause 6s]

À l'inspiration... laissez la mâchoire s'ouvrir doucement.
[pause 4s]
Au blocage... restez dans ce silence... et envoyez de la gratitude à votre corps pour ce qu'il fait.
[pause 4s]
À l'expiration... lèvres légèrement resserrées... laissez partir ce qui peut partir.
[pause 6s]

Si l'esprit part... laissez-le partir.
[pause 3s]
Et revenez simplement... au souffle.
[pause 7s]

Nous commençons.
[BREATHING_CYCLES]
[pause 20s]

Ce calme... c'est vous.
[pause 5s]
Simplement vous.
[pause 15s]

Laissez le souffle reprendre son rythme naturel.
[pause 10s]

Restez là.
[pause 8s]
Sans rien faire.
[pause 12s]

Quel discours tenez-vous habituellement sur votre corps... est-il bienveillant ou critique ?
[pause 18s]

Y a-t-il une partie de votre corps envers laquelle vous portez de la honte ou de la frustration... qui mériterait de la compassion ?
[pause 18s]

Comment pourriez-vous traiter votre corps cette semaine comme un partenaire que vous respectez ?
[pause 18s]

Notez ce qui est venu... dans votre carnet.
[pause 5s]
Même si c'est juste un mot.
[pause 8s]

Votre corps n'est pas votre ennemi.
[pause 5s]
Il est votre partenaire le plus ancien.
[pause 5s]
Commencez à le traiter comme tel.
[pause 8s]
SCRIPT,

        // ─────────────────────────────────────────────────────────
        // PARCOURS 3 — Interactions sociales
        // ─────────────────────────────────────────────────────────
        '14-interactions-sociales' => <<<'SCRIPT'
Installez-vous.
[pause 5s]
Pensez à une personne dans votre vie qui vous fait du bien.
[pause 6s]
Pas quelqu'un de parfait.
[pause 4s]
Quelqu'un dont la présence est ressourçante.
[pause 6s]
Remarquez ce que ça génère dans votre corps... juste d'y penser.
[pause 10s]

L'être humain est une espèce ultra-sociale.
[pause 5s]
Notre cerveau a co-évolué avec la communauté.
[pause 5s]
Pendant cent mille ans... être seul était dangereux.
[pause 5s]
L'appartenance à un groupe était une question de survie.
[pause 8s]

Matthew Lieberman — UCLA — a démontré par neuroimagerie...
[pause 5s]
que le cerveau traite l'exclusion sociale...
[pause 5s]
dans les mêmes zones que la douleur physique.
[pause 5s]
La douleur sociale est une douleur réelle.
[pause 5s]
Et la connexion... active les mêmes circuits que la nourriture et la chaleur.
[pause 8s]

Mais nous avons aussi des interactions qui drainent.
[pause 5s]
Des dynamiques qui épuisent.
[pause 5s]
Des relations qui prennent plus qu'elles ne donnent.
[pause 6s]
Et apprendre à distinguer les deux...
[pause 5s]
à choisir ses connexions avec conscience...
[pause 5s]
est une compétence que personne ne nous enseigne.
[pause 10s]

Ce module vous donne les outils pour cartographier vos relations.
[pause 5s]
Identifier celles qui nourrissent.
[pause 4s]
Comprendre celles qui épuisent.
[pause 4s]
Et naviguer les interactions sociales avec plus de fluidité et moins d'énergie perdue.
[pause 10s]

C'est par le corps que nous allons ressentir la qualité de nos connexions humaines.
[pause 8s]

Nous allons pratiquer la méthode cinq-cinq-cinq.
[pause 5s]

Cinq secondes pour inspirer.
[pause 2s]
Cinq secondes pour bloquer.
[pause 2s]
Cinq secondes pour expirer.
[pause 4s]
Dix cycles.
[pause 2s]
Deux minutes et demie de présence pure.
[pause 6s]

À l'inspiration... laissez la mâchoire s'ouvrir doucement.
[pause 4s]
Au blocage... restez dans ce silence... laissez venir le visage d'une personne qui vous ressource.
[pause 4s]
À l'expiration... lèvres légèrement resserrées... laissez partir ce qui peut partir.
[pause 6s]

Si l'esprit part... laissez-le partir.
[pause 3s]
Et revenez simplement... au souffle.
[pause 7s]

Nous commençons.
[BREATHING_CYCLES]
[pause 20s]

Ce calme... c'est vous.
[pause 5s]
Simplement vous.
[pause 15s]

Laissez le souffle reprendre son rythme naturel.
[pause 10s]

Restez là.
[pause 8s]
Sans rien faire.
[pause 12s]

Pouvez-vous nommer trois personnes dont la présence vous ressource profondément ?
[pause 18s]

Y a-t-il des interactions régulières qui vous drainent... et avez-vous une marge de manœuvre sur elles ?
[pause 18s]

Quelle serait une action concrète cette semaine pour renforcer une connexion qui compte pour vous ?
[pause 18s]

Notez ce qui est venu... dans votre carnet.
[pause 5s]
Même si c'est juste un mot.
[pause 8s]

La qualité de vos connexions humaines est le terreau de votre bien-être.
[pause 5s]
Chérissez celles qui vous font du bien.
[pause 8s]
SCRIPT,

        // ─────────────────────────────────────────────────────────
        // PARCOURS 3 — Loisirs et plénitude
        // ─────────────────────────────────────────────────────────
        '16-loisirs-et-vie' => <<<'SCRIPT'
Installez-vous.
[pause 5s]
Pensez à la dernière fois que vous avez fait quelque chose... uniquement par plaisir.
[pause 7s]
Sans but.
[pause 4s]
Sans résultat.
[pause 4s]
Sans productivité.
[pause 4s]
Juste parce que ça vous faisait quelque chose de bien.
[pause 8s]

Quand était-ce ?
[pause 10s]

Mihaly Csikszentmihalyi.
[pause 5s]
Psychologue hongrois-américain.
[pause 5s]
Il a passé des décennies à étudier les états d'expérience optimale.
[pause 5s]
Ce qu'il appelle le flow.
[pause 8s]

Le flow... c'est cet état de complète absorption dans une activité.
[pause 5s]
Où l'ego s'efface.
[pause 4s]
Le temps perd sa consistance.
[pause 4s]
L'efforte et la facilité se confondent.
[pause 4s]
Et on ressent ce qu'il décrit comme un bonheur profond et authentique.
[pause 8s]

L'observation de Csikszentmihalyi est importante.
[pause 6s]
Le flow se produit quand le niveau de défi correspond légèrement à notre niveau de compétence.
[pause 5s]
Trop facile... on s'ennuie.
[pause 4s]
Trop difficile... on s'anxiète.
[pause 5s]
Au point juste... on rentre dans le flux.
[pause 8s]

Mais il a observé quelque chose de contre-intuitif.
[pause 6s]
Les gens rapportent plus de flow dans leur travail que dans leurs loisirs.
[pause 5s]
Et pourtant... ils décident librement de regarder la télévision plutôt que faire l'activité qui les fait vibrer.
[pause 5s]
Parce que le flow a un coût d'entrée.
[pause 4s]
Il demande de l'attention.
[pause 4s]
Il demande de commencer.
[pause 6s]
La passivité... elle... ne demande rien.
[pause 8s]

Ce module vous invite à identifier vos activités de flow.
[pause 5s]
Celles qui vous font entrer dans cet état.
[pause 5s]
Et à leur donner une place réelle dans votre agenda.
[pause 5s]
Pas par hasard.
[pause 5s]
Par choix.
[pause 10s]

C'est par le corps que nous allons retrouver le sens du jeu et de la vitalité.
[pause 8s]

Nous allons pratiquer la méthode cinq-cinq-cinq.
[pause 5s]

Cinq secondes pour inspirer.
[pause 2s]
Cinq secondes pour bloquer.
[pause 2s]
Cinq secondes pour expirer.
[pause 4s]
Dix cycles.
[pause 2s]
Deux minutes et demie de présence pure.
[pause 6s]

À l'inspiration... laissez la mâchoire s'ouvrir doucement.
[pause 4s]
Au blocage... restez dans ce silence... et laissez venir une image d'une activité qui vous fait vibrer.
[pause 4s]
À l'expiration... lèvres légèrement resserrées... laissez partir ce qui peut partir.
[pause 6s]

Si l'esprit part... laissez-le partir.
[pause 3s]
Et revenez simplement... au souffle.
[pause 7s]

Nous commençons.
[BREATHING_CYCLES]
[pause 20s]

Ce calme... c'est vous.
[pause 5s]
Simplement vous.
[pause 15s]

Laissez le souffle reprendre son rythme naturel.
[pause 10s]

Restez là.
[pause 8s]
Sans rien faire.
[pause 12s]

Pouvez-vous nommer une activité en dehors du travail qui vous procure de la joie pure... sans but utilitaire ?
[pause 18s]

Quelle est la place réelle que vous donnez au plaisir et au jeu dans votre semaine ?
[pause 18s]

Quel serait le premier pas pour intégrer davantage de flow dans votre quotidien... dès cette semaine ?
[pause 18s]

Notez ce qui est venu... dans votre carnet.
[pause 5s]
Même si c'est juste un mot.
[pause 8s]

Le plaisir n'est pas un luxe.
[pause 5s]
C'est un carburant.
[pause 5s]
Et vous méritez un plein réservoir.
[pause 8s]
SCRIPT,

        // ─────────────────────────────────────────────────────────
        // PARCOURS 3 — Pièges des écrans
        // ─────────────────────────────────────────────────────────
        '32-pieges-ecrans' => <<<'SCRIPT'
Installez-vous.
[pause 5s]
Posez votre téléphone... face vers le bas.
[pause 5s]
Si vous l'utilisez pour écouter ce module... posez-le à portée... mais loin de votre regard.
[pause 6s]
Et remarquez si une légère résistance se manifeste.
[pause 5s]
Cette résistance est déjà une information.
[pause 10s]

Les technologies numériques ne sont pas neutres.
[pause 5s]
Elles ont été conçues... par des équipes entières de neuroscientifiques et de psychologues... pour capturer votre attention.
[pause 6s]
Tristan Harris... ancien designer chez Google... a nommé ça le modèle persuasif.
[pause 5s]
Ces systèmes n'essaient pas de vous rendre heureux.
[pause 5s]
Ils essaient de maximiser le temps que vous passez sur eux.
[pause 5s]
Et le bonheur et l'engagement ne sont pas la même chose.
[pause 8s]

La dopamine est le neurotransmetteur de l'anticipation.
[pause 5s]
Pas du plaisir.
[pause 5s]
De l'anticipation du plaisir.
[pause 5s]
Chaque notification... chaque scroll infini... chaque like incertain...
[pause 5s]
exploite exactement ce mécanisme.
[pause 5s]
Le même mécanisme que les machines à sous.
[pause 8s]

Les études sur le bien-être subjectif montrent que...
[pause 5s]
une heure de réseaux sociaux par jour est associée à une baisse measurable de bonheur.
[pause 5s]
Pour les adolescents... l'effet est encore plus marqué.
[pause 8s]

Ce module ne vous demande pas de supprimer vos applications.
[pause 5s]
Il vous propose de reprendre le contrôle.
[pause 5s]
D'utiliser consciemment.
[pause 4s]
Plutôt que d'être utilisé.
[pause 5s]
De choisir quand vous regardez.
[pause 4s]
Combien de temps.
[pause 4s]
Et pour quoi.
[pause 10s]

C'est par le corps que nous allons retrouver notre présence... au-delà des écrans.
[pause 8s]

Nous allons pratiquer la méthode cinq-cinq-cinq.
[pause 5s]

Cinq secondes pour inspirer.
[pause 2s]
Cinq secondes pour bloquer.
[pause 2s]
Cinq secondes pour expirer.
[pause 4s]
Dix cycles.
[pause 2s]
Deux minutes et demie de présence pure.
[pause 6s]

À l'inspiration... laissez la mâchoire s'ouvrir doucement.
[pause 4s]
Au blocage... restez dans ce silence... savourez l'absence de notification.
[pause 4s]
À l'expiration... lèvres légèrement resserrées... laissez partir ce qui peut partir.
[pause 6s]

Si l'esprit part... laissez-le partir.
[pause 3s]
Et revenez simplement... au souffle.
[pause 7s]

Nous commençons.
[BREATHING_CYCLES]
[pause 20s]

Ce calme... c'est vous.
[pause 5s]
Simplement vous.
[pause 15s]

Laissez le souffle reprendre son rythme naturel.
[pause 10s]

Restez là.
[pause 8s]
Sans rien faire.
[pause 12s]

Combien de fois vérifiez-vous votre téléphone dans une journée... et est-ce conscient ?
[pause 18s]

Y a-t-il des moments de votre journée que vous pourriez protéger des écrans pour être davantage présent ?
[pause 18s]

Quelle serait une règle simple sur votre usage des écrans... qui respecterait vraiment votre attention ?
[pause 18s]

Notez ce qui est venu... dans votre carnet.
[pause 5s]
Même si c'est juste un mot.
[pause 8s]

Votre attention est votre ressource la plus précieuse.
[pause 5s]
Choisissez consciemment à qui... et à quoi vous la donnez.
[pause 8s]
SCRIPT,

        // ─────────────────────────────────────────────────────────
        // PARCOURS 3 — Relation à l'autre
        // ─────────────────────────────────────────────────────────
        '17-relation-a-lautre' => <<<'SCRIPT'
Installez-vous.
[pause 5s]
Respirez.
[pause 6s]
Et pensez à la relation la plus importante de votre vie.
[pause 5s]
Pas nécessairement amoureuse.
[pause 4s]
La relation qui vous touche le plus profondément.
[pause 5s]
Qui vous définit.
[pause 4s]
Qui vous a le plus transformé.
[pause 8s]

Qu'est-ce qu'elle vous a appris sur vous-même ?
[pause 10s]

Les relations ne nous révèlent pas.
[pause 5s]
Elles nous construisent.
[pause 5s]
Il est impossible de devenir pleinement soi-même en isolation.
[pause 5s]
Nous nous voyons dans le regard de l'autre.
[pause 5s]
Nous nous découvrons en réaction.
[pause 5s]
Nous apprenons nos patterns dans la friction.
[pause 8s]

John Gottman... de l'Université de Washington...
[pause 5s]
a étudié des milliers de couples pendant des décennies.
[pause 5s]
Il peut prédire avec plus de quatre-vingt pour cent de précision...
[pause 5s]
si un couple va se séparer...
[pause 5s]
rien qu'en observant quelques minutes d'interaction.
[pause 8s]

Sa découverte principale ?
[pause 5s]
Ce n'est pas le conflit qui détruit les relations.
[pause 5s]
C'est le mépris.
[pause 5s]
Et son contraire... la bidirectionnalité du turning towards.
[pause 5s]
Ces petits moments quotidiens où l'on se tourne vers l'autre.
[pause 4s]
Où l'on répond à une tentative de connexion.
[pause 4s]
Même minuscule.
[pause 8s]

Ce module vous invite à regarder vos relations avec honnêteté.
[pause 5s]
Leur qualité.
[pause 4s]
Leur réciprocité.
[pause 4s]
Leur évolution.
[pause 5s]
Et les compétences relationnelles qui font la différence entre une relation qui s'use...
[pause 5s]
et une relation qui grandit.
[pause 10s]

C'est par le corps que nous allons ressentir la profondeur de nos liens.
[pause 8s]

Nous allons pratiquer la méthode cinq-cinq-cinq.
[pause 5s]

Cinq secondes pour inspirer.
[pause 2s]
Cinq secondes pour bloquer.
[pause 2s]
Cinq secondes pour expirer.
[pause 4s]
Dix cycles.
[pause 2s]
Deux minutes et demie de présence pure.
[pause 6s]

À l'inspiration... laissez la mâchoire s'ouvrir doucement.
[pause 4s]
Au blocage... restez dans ce silence... et laissez venir la sensation d'être pleinement avec quelqu'un.
[pause 4s]
À l'expiration... lèvres légèrement resserrées... laissez partir ce qui peut partir.
[pause 6s]

Si l'esprit part... laissez-le partir.
[pause 3s]
Et revenez simplement... au souffle.
[pause 7s]

Nous commençons.
[BREATHING_CYCLES]
[pause 20s]

Ce calme... c'est vous.
[pause 5s]
Simplement vous.
[pause 15s]

Laissez le souffle reprendre son rythme naturel.
[pause 10s]

Restez là.
[pause 8s]
Sans rien faire.
[pause 12s]

Dans vos relations importantes... êtes-vous plutôt dans le turning towards ou le turning away... la connexion ou le retrait ?
[pause 18s]

Y a-t-il quelque chose que vous gardez pour vous dans une relation importante... par peur de la réaction de l'autre ?
[pause 18s]

Comment pourriez-vous nourrir davantage la relation qui vous tient le plus à cœur cette semaine ?
[pause 18s]

Notez ce qui est venu... dans votre carnet.
[pause 5s]
Même si c'est juste un mot.
[pause 8s]

Les relations ne se maintiennent pas toutes seules.
[pause 5s]
Elles se choisissent... moment après moment.
[pause 8s]
SCRIPT,

        // ─────────────────────────────────────────────────────────
        // PARCOURS 3 — Intimité et énergie relationnelle
        // ─────────────────────────────────────────────────────────
        '18-intimite-et-energie' => <<<'SCRIPT'
Installez-vous.
[pause 5s]
Ce module touche quelque chose d'intime.
[pause 5s]
Pas seulement l'intimité physique.
[pause 4s]
L'intimité comme capacité.
[pause 4s]
La capacité à laisser l'autre vous voir vraiment.
[pause 5s]
Et à vous voir dans ce reflet.
[pause 10s]

Brené Brown a passé des années à étudier la vulnérabilité.
[pause 5s]
Sa conclusion dérange les gens qui cherchent la force à travers le contrôle.
[pause 6s]
La vulnérabilité n'est pas une faiblesse.
[pause 5s]
C'est la source de la connexion authentique.
[pause 5s]
De la créativité.
[pause 4s]
De l'amour.
[pause 4s]
Et du sens.
[pause 8s]

Ceux qui évitent la vulnérabilité n'évitent pas la douleur.
[pause 5s]
Ils évitent aussi la joie.
[pause 5s]
et la profondeur.
[pause 8s]

Et l'énergie relationnelle...
[pause 5s]
cette ressource que certaines connexions nous donnent et d'autres nous prennent...
[pause 5s]
dépend directement de notre niveau de présence dans la relation.
[pause 5s]
Une relation vécue à distance de soi... par protection...
[pause 5s]
vide plus qu'elle ne nourrit.
[pause 8s]

Ce module vous invite à explorer...
[pause 5s]
votre capacité à être vu.
[pause 5s]
Et à voir vraiment.
[pause 5s]
Pas à travers des attentes.
[pause 4s]
Pas à travers des peurs.
[pause 5s]
Mais dans la présence directe.
[pause 10s]

C'est par le corps que nous allons explorer notre capacité à être vraiment vus.
[pause 8s]

Nous allons pratiquer la méthode cinq-cinq-cinq.
[pause 5s]

Cinq secondes pour inspirer.
[pause 2s]
Cinq secondes pour bloquer.
[pause 2s]
Cinq secondes pour expirer.
[pause 4s]
Dix cycles.
[pause 2s]
Deux minutes et demie de présence pure.
[pause 6s]

À l'inspiration... laissez la mâchoire s'ouvrir doucement.
[pause 4s]
Au blocage... restez dans ce silence... laissez venir la sensation d'être pleinement là... avec vous-même.
[pause 4s]
À l'expiration... lèvres légèrement resserrées... laissez partir ce qui peut partir.
[pause 6s]

Si l'esprit part... laissez-le partir.
[pause 3s]
Et revenez simplement... au souffle.
[pause 7s]

Nous commençons.
[BREATHING_CYCLES]
[pause 20s]

Ce calme... c'est vous.
[pause 5s]
Simplement vous.
[pause 15s]

Laissez le souffle reprendre son rythme naturel.
[pause 10s]

Restez là.
[pause 8s]
Sans rien faire.
[pause 12s]

Dans vos relations proches... êtes-vous capable de vous montrer vulnérable... ou vous protégez-vous systématiquement ?
[pause 18s]

Y a-t-il une relation dans votre vie où vous n'êtes pas complètement vous-même... et pourquoi ?
[pause 18s]

Quel serait un geste de vulnérabilité authentique que vous pourriez offrir cette semaine à quelqu'un qui compte ?
[pause 18s]

Notez ce qui est venu... dans votre carnet.
[pause 5s]
Même si c'est juste un mot.
[pause 8s]

L'intimité n'est pas une faiblesse.
[pause 5s]
C'est le courage de laisser l'autre vous voir... réellement.
[pause 8s]
SCRIPT,

        // ─────────────────────────────────────────────────────────
        // PARCOURS 3 — Vivre, choisir, reconstruire
        // ─────────────────────────────────────────────────────────
        '20-vivre-choisir-reconstruire' => <<<'SCRIPT'
Installez-vous.
[pause 5s]
Pensez à un moment de votre vie où vous avez dû vous reconstruire.
[pause 7s]
Une rupture.
[pause 4s]
Une perte.
[pause 4s]
Un échec.
[pause 4s]
Un départ.
[pause 5s]
Ce moment où vous n'étiez plus sûr de savoir qui vous étiez... ni vers où.
[pause 10s]

Vous êtes ici maintenant.
[pause 5s]
Ce moment fait partie de vous.
[pause 5s]
Il ne vous a pas détruit.
[pause 5s]
Il vous a traversé.
[pause 10s]

Le kintsugi est une pratique japonaise.
[pause 5s]
Quand une céramique se brise... on la répare avec de l'or.
[pause 5s]
La cicatrice devient l'ornement.
[pause 5s]
La fragilité... transformée... devient ce qui est le plus précieux.
[pause 8s]

Les chercheurs en résilience ont découvert quelque chose de similaire.
[pause 5s]
Après un traumatisme...
[pause 4s]
certaines personnes ne reviennent pas au point de départ.
[pause 4s]
Elles dépassent leur niveau d'avant.
[pause 5s]
Tedeschi et Calhoun appellent ça le Post-Traumatic Growth.
[pause 5s]
La croissance post-traumatique.
[pause 8s]

Elle se manifeste par...
[pause 5s]
une plus grande profondeur dans les relations.
[pause 4s]
Une appréciation plus intense de la vie.
[pause 4s]
Une force personnelle découverte.
[pause 4s]
De nouveaux horizons.
[pause 4s]
Et parfois... un profond changement spirituel.
[pause 8s]

Ce n'est pas automatique.
[pause 5s]
Ça demande du travail intérieur.
[pause 5s]
Du temps.
[pause 5s]
Et souvent... un accompagnement.
[pause 8s]

Ce module vous invite à regarder vos fractures avec des yeux différents.
[pause 5s]
Pas pour minimiser ce que vous avez vécu.
[pause 5s]
Mais pour reconnaître ce que vous êtes capable de faire avec.
[pause 10s]

C'est par le corps que nous allons intégrer nos fractures... et en faire notre force.
[pause 8s]

Nous allons pratiquer la méthode cinq-cinq-cinq.
[pause 5s]

Cinq secondes pour inspirer.
[pause 2s]
Cinq secondes pour bloquer.
[pause 2s]
Cinq secondes pour expirer.
[pause 4s]
Dix cycles.
[pause 2s]
Deux minutes et demie de présence pure.
[pause 6s]

À l'inspiration... laissez la mâchoire s'ouvrir doucement.
[pause 4s]
Au blocage... restez dans ce silence... portez avec compassion ce que vous avez traversé.
[pause 4s]
À l'expiration... lèvres légèrement resserrées... laissez partir ce qui peut partir.
[pause 6s]

Si l'esprit part... laissez-le partir.
[pause 3s]
Et revenez simplement... au souffle.
[pause 7s]

Nous commençons.
[BREATHING_CYCLES]
[pause 20s]

Ce calme... c'est vous.
[pause 5s]
Simplement vous.
[pause 15s]

Laissez le souffle reprendre son rythme naturel.
[pause 10s]

Restez là.
[pause 8s]
Sans rien faire.
[pause 12s]

Y a-t-il une expérience difficile de votre passé que vous n'avez pas encore complètement intégrée ?
[pause 18s]

Qu'avez-vous découvert sur vous-même à travers cette épreuve... que vous n'auriez peut-être pas découvert autrement ?
[pause 18s]

Comment pourriez-vous honorer ce que vous avez traversé... tout en choisissant d'avancer vers quelque chose de nouveau ?
[pause 18s]

Notez ce qui est venu... dans votre carnet.
[pause 5s]
Même si c'est juste un mot.
[pause 8s]

Vous n'êtes pas la somme de ce qui vous est arrivé.
[pause 5s]
Vous êtes ce que vous avez choisi d'en faire.
[pause 8s]
SCRIPT,

        // ─────────────────────────────────────────────────────────
        // PARCOURS 3 — Amour à l'ère du jetable
        // ─────────────────────────────────────────────────────────
        '31-amour-ere-jetable' => <<<'SCRIPT'
Installez-vous.
[pause 5s]
Ce module aborde un terrain délicat.
[pause 5s]
L'amour dans une époque qui rend tout jetable.
[pause 6s]
Les objets... les emplois... et parfois les relations.
[pause 8s]

Zygmunt Bauman parlait de la modernité liquide.
[pause 5s]
Un monde sans solide.
[pause 4s]
Sans ancrage.
[pause 4s]
Où tout peut être échangé... remplacé... optimisé.
[pause 5s]
Et les relations... dans ce contexte... sont soumises à la logique du marché.
[pause 5s]
La comparaison permanente.
[pause 4s]
La disponibilité infinie.
[pause 4s]
Le coût de sortie minimisé.
[pause 8s]

Les applications de rencontre ont ajouté une couche supplémentaire.
[pause 5s]
En suggérant que l'amour est une affaire de tri.
[pause 5s]
De swipe.
[pause 4s]
De catalogue.
[pause 5s]
Que si cette personne ne correspond pas parfaitement...
[pause 5s]
la suivante le sera peut-être davantage.
[pause 5s]
L'illusion du mieux possible.
[pause 8s]

Et pourtant.
[pause 5s]
L'étude de Grant à Harvard...
[pause 5s]
la plus longue étude sur le bonheur humain jamais réalisée...
[pause 5s]
soixante-dix ans de suivi...
[pause 5s]
a conclu quelque chose que toutes les cultures savaient intuitivement.
[pause 6s]
La qualité des relations est le facteur le plus déterminant du bonheur humain.
[pause 5s]
Plus que la richesse.
[pause 4s]
Plus que la célébrité.
[pause 4s]
Plus que la santé physique.
[pause 8s]

Pas le nombre de relations.
[pause 5s]
Leur profondeur.
[pause 5s]
Leur chaleur.
[pause 5s]
Leur sécurité.
[pause 10s]

Ce module vous invite à réfléchir... et à choisir.
[pause 5s]
Pas la doctrine du passé.
[pause 5s]
Pas la liquidité du présent.
[pause 5s]
Mais votre propre philosophie de l'engagement.
[pause 10s]

C'est par le corps que nous allons sentir ce que la profondeur d'un lien fait réellement en nous.
[pause 8s]

Nous allons pratiquer la méthode cinq-cinq-cinq.
[pause 5s]

Cinq secondes pour inspirer.
[pause 2s]
Cinq secondes pour bloquer.
[pause 2s]
Cinq secondes pour expirer.
[pause 4s]
Dix cycles.
[pause 2s]
Deux minutes et demie de présence pure.
[pause 6s]

À l'inspiration... laissez la mâchoire s'ouvrir doucement.
[pause 4s]
Au blocage... restez dans ce silence... pensez à quelqu'un pour qui votre cœur est ouvert.
[pause 4s]
À l'expiration... lèvres légèrement resserrées... laissez partir ce qui peut partir.
[pause 6s]

Si l'esprit part... laissez-le partir.
[pause 3s]
Et revenez simplement... au souffle.
[pause 7s]

Nous commençons.
[BREATHING_CYCLES]
[pause 20s]

Ce calme... c'est vous.
[pause 5s]
Simplement vous.
[pause 15s]

Laissez le souffle reprendre son rythme naturel.
[pause 10s]

Restez là.
[pause 8s]
Sans rien faire.
[pause 12s]

Quelle est votre propre philosophie de l'engagement... dans vos relations importantes ?
[pause 18s]

Y a-t-il une relation dans votre vie où vous investissez vraiment dans la profondeur et la durée ?
[pause 18s]

Qu'est-ce qui vous semble le plus précieux dans une relation... et comment cela guide-t-il vos choix ?
[pause 18s]

Notez ce qui est venu... dans votre carnet.
[pause 5s]
Même si c'est juste un mot.
[pause 8s]

Dans un monde qui valorise le renouvellement...
[pause 5s]
choisir la profondeur est un acte courageux.
[pause 8s]
SCRIPT,

        // ─────────────────────────────────────────────────────────
        // PARCOURS 3 — Éducation sacrifiée
        // ─────────────────────────────────────────────────────────
        '33-education-sacrifiee' => <<<'SCRIPT'
Installez-vous.
[pause 5s]
Ce module parle de transmission.
[pause 5s]
De ce qu'on donne... de ce qu'on reçoit.
[pause 5s]
Et de ce qu'on peut choisir de transmettre différemment.
[pause 10s]

Il y a ce que nous voulons transmettre à nos enfants.
[pause 5s]
Et il y a ce que nous transmettons réellement.
[pause 5s]
Ces deux choses ne sont pas toujours les mêmes.
[pause 8s]

D. W. Winnicott avait le concept du good enough parent.
[pause 5s]
Le parent suffisamment bon.
[pause 5s]
Pas parfait.
[pause 4s]
Assez présent.
[pause 4s]
Assez disponible.
[pause 4s]
Assez réparant.
[pause 8s]

Le perfectionnisme parental est souvent une projection.
[pause 5s]
Vouloir pour l'enfant ce qu'on n'a pas pu avoir.
[pause 5s]
Corriger à travers lui.
[pause 5s]
Réussir dans sa réussite.
[pause 5s]
Et l'enfant le ressent.
[pause 5s]
Pas comme amour.
[pause 5s]
Comme pression.
[pause 8s]

Daniel Siegel parle du cerveau narrant.
[pause 5s]
Les parents qui ont intégré leur propre histoire...
[pause 5s]
qui peuvent parler de leurs difficultés avec cohérence et clarté...
[pause 5s]
créent des enfants sécures.
[pause 5s]
Peu importe ce qu'ils ont vécu.
[pause 5s]
C'est l'intégration qui importe.
[pause 5s]
Pas le passé.
[pause 10s]

Ce module vous invite à regarder votre propre histoire.
[pause 5s]
Ce que vous avez reçu.
[pause 4s]
Ce que vous portez.
[pause 4s]
Ce que vous choisissez de transmettre... consciemment... avec amour.
[pause 10s]

C'est par le corps que nous allons sentir ce que nous portons de nos origines.
[pause 8s]

Nous allons pratiquer la méthode cinq-cinq-cinq.
[pause 5s]

Cinq secondes pour inspirer.
[pause 2s]
Cinq secondes pour bloquer.
[pause 2s]
Cinq secondes pour expirer.
[pause 4s]
Dix cycles.
[pause 2s]
Deux minutes et demie de présence pure.
[pause 6s]

À l'inspiration... laissez la mâchoire s'ouvrir doucement.
[pause 4s]
Au blocage... restez dans ce silence... portez avec compassion votre propre enfance.
[pause 4s]
À l'expiration... lèvres légèrement resserrées... laissez partir ce qui peut partir.
[pause 6s]

Si l'esprit part... laissez-le partir.
[pause 3s]
Et revenez simplement... au souffle.
[pause 7s]

Nous commençons.
[BREATHING_CYCLES]
[pause 20s]

Ce calme... c'est vous.
[pause 5s]
Simplement vous.
[pause 15s]

Laissez le souffle reprendre son rythme naturel.
[pause 10s]

Restez là.
[pause 8s]
Sans rien faire.
[pause 12s]

Qu'avez-vous reçu de vos parents ou figures d'attachement... que vous êtes reconnaissant de porter ?
[pause 18s]

Y a-t-il quelque chose que vous avez reçu... blessure ou héritage... que vous choisissez de transformer dans votre vie ?
[pause 18s]

Si vous pouviez transmettre une seule chose à ceux qui viennent après vous... quelle serait-elle ?
[pause 18s]

Notez ce qui est venu... dans votre carnet.
[pause 5s]
Même si c'est juste un mot.
[pause 8s]

La transmission la plus puissante n'est pas ce que vous dites.
[pause 5s]
C'est ce que vous devenez.
[pause 8s]
SCRIPT,

        // ─────────────────────────────────────────────────────────
        // PARCOURS 3 — Entretenir nos relations
        // ─────────────────────────────────────────────────────────
        '21-entretenir-nos-relations' => <<<'SCRIPT'
Installez-vous.
[pause 5s]
Pensez à une relation importante dans votre vie.
[pause 5s]
Une qui existe depuis longtemps.
[pause 5s]
Et posez cette question honnêtement.
[pause 5s]
Est-ce que j'entretiens vraiment cette relation... ou est-ce que je compte sur sa durée ?
[pause 10s]

Les relations sont comme des jardins.
[pause 5s]
Elles ont besoin d'eau.
[pause 4s]
D'attention.
[pause 4s]
De présence.
[pause 5s]
Sans ça... elles ne meurent pas d'un coup.
[pause 5s]
Elles s'appauvrissent lentement.
[pause 5s]
Et un jour... on se regarde en se demandant ce qui s'est passé.
[pause 8s]

Gottman a nommé ça la Love Map.
[pause 5s]
La carte intérieure de l'autre.
[pause 5s]
Connaître les rêves de l'autre.
[pause 4s]
Ses peurs.
[pause 4s]
Ses joies récentes.
[pause 4s]
Ce qui l'occupe.
[pause 4s]
Ce qui l'a blessé.
[pause 6s]
Les couples en difficulté ont des Love Maps vides.
[pause 5s]
Ils vivent côte à côte... mais ils ne savent plus vraiment qui est là à côté d'eux.
[pause 8s]

Et ce n'est pas réservé aux couples.
[pause 5s]
Nos amitiés profondes.
[pause 4s]
Nos relations avec nos parents.
[pause 4s]
Nos liens avec nos frères et sœurs.
[pause 5s]
Toutes ces relations se vident de substance quand on cesse de les cultiver activement.
[pause 8s]

Ce module vous invite à agir.
[pause 5s]
Pas plus tard.
[pause 5s]
Aujourd'hui.
[pause 5s]
Un message.
[pause 4s]
Un appel.
[pause 4s]
Un repas.
[pause 4s]
Une question sincère.
[pause 4s]
Comment va vraiment ta vie ?
[pause 10s]

C'est par le corps que nous allons sentir la richesse de nos liens et l'envie de les nourrir.
[pause 8s]

Nous allons pratiquer la méthode cinq-cinq-cinq.
[pause 5s]

Cinq secondes pour inspirer.
[pause 2s]
Cinq secondes pour bloquer.
[pause 2s]
Cinq secondes pour expirer.
[pause 4s]
Dix cycles.
[pause 2s]
Deux minutes et demie de présence pure.
[pause 6s]

À l'inspiration... laissez la mâchoire s'ouvrir doucement.
[pause 4s]
Au blocage... restez dans ce silence... et laissez venir le prénom d'une personne à qui vous devriez donner davantage de présence.
[pause 4s]
À l'expiration... lèvres légèrement resserrées... laissez partir ce qui peut partir.
[pause 6s]

Si l'esprit part... laissez-le partir.
[pause 3s]
Et revenez simplement... au souffle.
[pause 7s]

Nous commençons.
[BREATHING_CYCLES]
[pause 20s]

Ce calme... c'est vous.
[pause 5s]
Simplement vous.
[pause 15s]

Laissez le souffle reprendre son rythme naturel.
[pause 10s]

Restez là.
[pause 8s]
Sans rien faire.
[pause 12s]

Y a-t-il une relation importante dans votre vie que vous avez laissée s'appauvrir par manque d'attention ?
[pause 18s]

Quelle est la différence entre les relations que vous entretenez activement... et celles que vous tenez pour acquises ?
[pause 18s]

Quel est le geste minimal que vous pouvez faire aujourd'hui pour nourrir une relation qui compte ?
[pause 18s]

Notez ce qui est venu... dans votre carnet.
[pause 5s]
Même si c'est juste un mot.
[pause 8s]

Les relations les plus précieuses sont celles auxquelles vous revenez... encore et encore.
[pause 5s]
Avec intention.
[pause 8s]
SCRIPT,

        // ─────────────────────────────────────────────────────────
        // PARCOURS 3 — Je transmets ma transformation
        // ─────────────────────────────────────────────────────────
        '11-je-transmets-ma-transformation' => <<<'SCRIPT'
Installez-vous.
[pause 5s]
Respirez.
[pause 5s]
Et laissez venir cette question avec douceur.
[pause 5s]
Qu'est-ce que j'ai appris... vraiment... au fil de ce parcours ?
[pause 10s]

Pas intellectuellement.
[pause 5s]
Viscéralement.
[pause 5s]
Qu'est-ce qui a changé en vous ?
[pause 10s]

Il y a un principe dans l'enseignement bouddhiste.
[pause 5s]
Celui qui a reçu une connaissance... a la responsabilité de la transmettre.
[pause 5s]
Pas par devoir moral.
[pause 5s]
Parce que la connaissance se consolide dans la transmission.
[pause 5s]
Et parce que nous sommes tous reliés.
[pause 8s]

Mais la transmission ne se fait pas par les mots seuls.
[pause 5s]
Elle se fait par l'être.
[pause 5s]
Par ce que vous rayonnez quand vous entrez dans une pièce.
[pause 4s]
Par la façon dont vous écoutez.
[pause 4s]
Par la qualité de présence que vous apportez.
[pause 4s]
Par le courage de vivre selon ce que vous croyez vraiment.
[pause 8s]

Nicolas Chamfort a écrit... il y a deux siècles.
[pause 5s]
Jouissez et faites jouir... sans faire de mal ni à vous ni à personne.
[pause 5s]
C'est toute la morale.
[pause 6s]
Et c'est aussi toute la transmission digne de ce nom.
[pause 10s]

Votre transformation n'est pas seulement pour vous.
[pause 5s]
Elle est un point de lumière dans les vies des gens que vous touchez.
[pause 5s]
Souvent sans le savoir.
[pause 5s]
Souvent juste en étant qui vous devenez.
[pause 10s]

C'est par le corps que nous allons ancrer ce que nous sommes devenus... pour le transmettre.
[pause 8s]

Nous allons pratiquer la méthode cinq-cinq-cinq.
[pause 5s]

Cinq secondes pour inspirer.
[pause 2s]
Cinq secondes pour bloquer.
[pause 2s]
Cinq secondes pour expirer.
[pause 4s]
Dix cycles.
[pause 2s]
Deux minutes et demie de présence pure.
[pause 6s]

À l'inspiration... laissez la mâchoire s'ouvrir doucement.
[pause 4s]
Au blocage... restez dans ce silence... et sentez ce qui a changé en vous depuis le début de ce parcours.
[pause 4s]
À l'expiration... lèvres légèrement resserrées... laissez partir ce qui peut partir.
[pause 6s]

Si l'esprit part... laissez-le partir.
[pause 3s]
Et revenez simplement... au souffle.
[pause 7s]

Nous commençons.
[BREATHING_CYCLES]
[pause 20s]

Ce calme... c'est vous.
[pause 5s]
Simplement vous.
[pause 15s]

Laissez le souffle reprendre son rythme naturel.
[pause 10s]

Restez là.
[pause 8s]
Sans rien faire.
[pause 12s]

Qu'est-ce qui a changé concrètement en vous depuis que vous avez commencé ce travail ?
[pause 18s]

Y a-t-il une personne dans votre vie qui bénéficierait de ce que vous avez appris... et à qui vous pourriez le partager ?
[pause 18s]

Comment vivez-vous votre transformation au quotidien... par vos mots... vos actes... votre façon d'être ?
[pause 18s]

Notez ce qui est venu... dans votre carnet.
[pause 5s]
Même si c'est juste un mot.
[pause 8s]

Vous n'avez pas besoin d'être parfait pour transmettre.
[pause 5s]
Vous avez besoin d'être authentiquement en chemin.
[pause 8s]
SCRIPT,

        // ─────────────────────────────────────────────────────────
        // PARCOURS 3 — Synthèse du parcours
        // ─────────────────────────────────────────────────────────
        '29-synthese-du-parcours' => <<<'SCRIPT'
Installez-vous.
[pause 5s]
Fermez les yeux.
[pause 5s]
Et laissez venir... doucement... les images de ce que vous avez traversé.
[pause 8s]

Depuis le début de ce parcours.
[pause 5s]
Ce que vous savez maintenant que vous ne saviez pas.
[pause 5s]
Ce que vous avez compris dans votre corps... pas seulement dans votre tête.
[pause 5s]
Ce qui a bougé en vous.
[pause 10s]

Vous avez commencé par se retrouver.
[pause 5s]
Regarder honnêtement ce qui était là.
[pause 4s]
Vos limites.
[pause 4s]
Vos drains.
[pause 4s]
Vos blessures.
[pause 4s]
Votre vision.
[pause 4s]
Votre vie telle qu'elle est... pas telle que vous voudriez qu'elle soit.
[pause 8s]

Puis vous avez commencé à vous construire.
[pause 5s]
Des piliers.
[pause 4s]
Des priorités.
[pause 4s]
Un temps maîtrisé.
[pause 4s]
Un corps écouté.
[pause 4s]
Un système nerveux régulé.
[pause 4s]
Une alimentation consciente.
[pause 4s]
Un sommeil respecté.
[pause 8s]

Et puis vous vous êtes ouvert.
[pause 5s]
Aux autres.
[pause 4s]
Au monde.
[pause 4s]
À la complexité de l'amour.
[pause 4s]
De la solitude.
[pause 4s]
Du sens.
[pause 4s]
De la transmission.
[pause 8s]

Ce parcours n'avait pas pour but de vous rendre parfait.
[pause 5s]
Il avait pour but de vous rendre plus vivant.
[pause 5s]
Plus présent.
[pause 5s]
Plus ancré.
[pause 5s]
Plus capable d'habiter votre propre vie.
[pause 8s]

Se retrouver.
[pause 4s]
Se construire.
[pause 4s]
S'ouvrir.
[pause 6s]
Trois mouvements qui ne se font pas une fois.
[pause 5s]
Ils se répètent.
[pause 4s]
En spirale.
[pause 4s]
Chaque cycle vous amène plus loin... plus profond.
[pause 10s]

C'est par le corps que nous allons intégrer et honorer tout ce chemin parcouru.
[pause 8s]

Nous allons pratiquer la méthode cinq-cinq-cinq.
[pause 5s]

Cinq secondes pour inspirer.
[pause 2s]
Cinq secondes pour bloquer.
[pause 2s]
Cinq secondes pour expirer.
[pause 4s]
Dix cycles.
[pause 2s]
Deux minutes et demie de présence pure.
[pause 6s]

À l'inspiration... laissez la mâchoire s'ouvrir doucement.
[pause 4s]
Au blocage... restez dans ce silence... et ressentez l'ampleur de ce que vous avez accompli.
[pause 4s]
À l'expiration... lèvres légèrement resserrées... laissez partir ce qui peut partir.
[pause 6s]

Si l'esprit part... laissez-le partir.
[pause 3s]
Et revenez simplement... au souffle.
[pause 7s]

Nous commençons.
[BREATHING_CYCLES]
[pause 20s]

Ce calme... c'est vous.
[pause 5s]
Simplement vous.
[pause 15s]

Laissez le souffle reprendre son rythme naturel.
[pause 10s]

Restez là.
[pause 8s]
Sans rien faire.
[pause 12s]

Dans quelle dimension de ce parcours avez-vous ressenti le plus de transformation... se retrouver... se construire... ou s'ouvrir ?
[pause 18s]

Qu'est-ce que vous emportez de ce parcours comme ancrage... comme boussole pour la suite ?
[pause 18s]

Quel est le premier pas que vous vous engagez à faire... dès demain... pour continuer à vivre ce que vous avez appris ?
[pause 18s]

Notez ce qui est venu... dans votre carnet.
[pause 5s]
Même si c'est juste un mot.
[pause 8s]

Ce parcours ne se termine pas ici.
[pause 5s]
Il continue... dans chaque choix que vous faites.
[pause 5s]
Dans chaque souffle conscient.
[pause 8s]
SCRIPT,

        // ─────────────────────────────────────────────────────────
        // PARCOURS 3 — Mon programme quotidien
        // ─────────────────────────────────────────────────────────
        '30-mon-programme-quotidien' => <<<'SCRIPT'
Installez-vous une dernière fois.
[pause 5s]
Ce module clôt le parcours.
[pause 5s]
Et il l'ouvre en même temps.
[pause 5s]
Parce que ce que vous avez appris ici n'a de valeur que dans ce que vous faites demain.
[pause 10s]

Aristote disait que nous sommes ce que nous faisons... répétitivement.
[pause 5s]
L'excellence n'est pas un acte.
[pause 4s]
C'est une habitude.
[pause 8s]

Les neurosciences ont confirmé ce que les philosophes savaient par l'intuition.
[pause 5s]
Le cerveau est plastique.
[pause 4s]
Il se recâble en fonction de ce que vous répétez.
[pause 5s]
Chaque comportement répété... renforce un réseau neuronal.
[pause 5s]
Jusqu'à ce qu'il devienne automatique.
[pause 5s]
Jusqu'à ce qu'il devienne... vous.
[pause 8s]

Un programme quotidien n'est pas une liste de contraintes.
[pause 5s]
C'est une architecture d'identité.
[pause 5s]
Qui est la personne que vous devenez... heure après heure... jour après jour ?
[pause 8s]

Ce programme doit être réaliste.
[pause 5s]
Pas parfait.
[pause 5s]
Durable.
[pause 5s]
Composé de petits rituels... qui prennent peu de place... mais qui disent tout.
[pause 8s]

Un moment de silence le matin.
[pause 4s]
Même cinq minutes.
[pause 4s]
Un mouvement.
[pause 4s]
Un repas conscient.
[pause 4s]
Un moment de connexion réelle.
[pause 4s]
Une intention le matin.
[pause 4s]
Une gratitude le soir.
[pause 6s]
Et le reste... organisé autour de vos vraies priorités.
[pause 10s]

Je vous invite maintenant à écrire votre programme.
[pause 5s]
Pas l'idéal.
[pause 5s]
Celui qui correspond à votre vie réelle.
[pause 5s]
Et que vous commencerez demain.
[pause 5s]
Pas lundi.
[pause 5s]
Pas le mois prochain.
[pause 5s]
Demain.
[pause 10s]

C'est par le corps que nous allons ancrer l'architecture de votre vie quotidienne.
[pause 8s]

Nous allons pratiquer la méthode cinq-cinq-cinq.
[pause 5s]

Cinq secondes pour inspirer.
[pause 2s]
Cinq secondes pour bloquer.
[pause 2s]
Cinq secondes pour expirer.
[pause 4s]
Dix cycles.
[pause 2s]
Deux minutes et demie de présence pure.
[pause 6s]

À l'inspiration... laissez la mâchoire s'ouvrir doucement.
[pause 4s]
Au blocage... restez dans ce silence... et laissez se dessiner l'image de la personne que vous êtes en train de devenir.
[pause 4s]
À l'expiration... lèvres légèrement resserrées... laissez partir ce qui peut partir.
[pause 6s]

Si l'esprit part... laissez-le partir.
[pause 3s]
Et revenez simplement... au souffle.
[pause 7s]

Nous commençons.
[BREATHING_CYCLES]
[pause 20s]

Ce calme... c'est vous.
[pause 5s]
Simplement vous.
[pause 15s]

Laissez le souffle reprendre son rythme naturel.
[pause 10s]

Restez là.
[pause 8s]
Sans rien faire.
[pause 12s]

Quels sont les rituels qui constituent déjà votre programme quotidien... ceux qui vous ancrent et vous ressourcent ?
[pause 18s]

Y a-t-il un rituel manquant... que vous savez important mais que vous n'avez pas encore installé ?
[pause 18s]

Qu'est-ce que vous voulez faire différemment... dès demain ?
[pause 18s]

Notez ce qui est venu... dans votre carnet.
[pause 5s]
Même si c'est juste un mot.
[pause 8s]

Ce n'est pas ce que vous savez qui change votre vie.
[pause 5s]
C'est ce que vous faites... chaque jour.
[pause 5s]
Commencez demain.
[pause 8s]

Merci d'avoir été là.
[pause 6s]
Ce parcours a été un honneur.
[pause 5s]
À vous.
[pause 15s]
SCRIPT,

        // ─────────────────────────────────────────────────────────
        // PRATICIEN — Module 01 — Je me connais pour accompagner
        // ─────────────────────────────────────────────────────────
        '01-je-me-connais-pour-accompagner' => <<<'SCRIPT'
Installez-vous.
[pause 5s]

Avant d'accompagner qui que ce soit...
[pause 5s]
il faut vous rencontrer vous-même.
[pause 5s]
Pas la version que vous présentez au monde.
[pause 4s]
Celle qui est là... maintenant... sous les rôles.
[pause 10s]

Carl Rogers a dit quelque chose de simple et de profond.
[pause 5s]
La relation d'aide la plus puissante n'est pas celle d'un expert vers un novice.
[pause 5s]
C'est celle d'un être humain qui se connaît... vers un être humain qui cherche à se retrouver.
[pause 10s]

Ce module est le premier de votre formation praticien.
[pause 5s]
Il ne commence pas par des techniques.
[pause 4s]
Il commence par vous.
[pause 8s]

Fermez les yeux.
[pause 6s]

Trois respirations conscientes pour arriver ici.
[pause 20s]

Maintenant... posez cette question à votre corps.
[pause 6s]
Qui suis-je... quand personne ne me regarde ?
[pause 15s]

Pas une réponse rapide.
[pause 5s]
Laissez venir ce qui vient.
[pause 12s]

Un praticien efficace ne guide pas à travers ses théories.
[pause 5s]
Il guide à travers ce qu'il a traversé.
[pause 5s]
Ses blessures conscientes deviennent des clés.
[pause 5s]
Ses ressources développées deviennent des ponts.
[pause 10s]

Pensez à une blessure que vous portez... que vous avez commencé à apprivoiser.
[pause 8s]
Pas à expliquer aux autres.
[pause 5s]
Juste à reconnaître en vous.
[pause 8s]

Où est-elle dans votre corps ?
[pause 5s]
Comment se manifeste-t-elle encore aujourd'hui ?
[pause 12s]

Et maintenant... pensez à une ressource.
[pause 6s]
Quelque chose que vous avez développé... souvent à travers l'épreuve.
[pause 5s]
Une capacité à écouter.
[pause 4s]
Une présence tranquille.
[pause 4s]
Une intuition sur les états émotionnels des autres.
[pause 8s]

Cette ressource... vous la portez depuis longtemps.
[pause 5s]
Et c'est précisément elle qui va nourrir votre pratique.
[pause 10s]

C'est par le corps que nous ancrons ce travail.
[pause 8s]

Nous allons pratiquer la méthode cinq-cinq-cinq.
[pause 5s]

Cinq secondes pour inspirer.
[pause 2s]
Cinq secondes pour bloquer.
[pause 2s]
Cinq secondes pour expirer.
[pause 4s]
Dix cycles.
[pause 2s]
Deux minutes et demie de présence à vous-même.
[pause 6s]

À l'inspiration... laissez entrer la connaissance de soi.
[pause 4s]
Au blocage... restez avec ce que vous êtes.
[pause 4s]
À l'expiration... laissez partir ce qui n'est pas vous.
[pause 6s]

Nous commençons.
[BREATHING_CYCLES]
[pause 20s]

Ce calme... c'est la fondation de votre pratique.
[pause 5s]
Ce que vous touchez là... vous pouvez l'offrir à d'autres.
[pause 15s]

Laissez le souffle reprendre son rythme naturel.
[pause 10s]

Restez là.
[pause 8s]
Sans rien faire.
[pause 12s]

Quelle est la blessure qui vous a le plus façonné... et que vous avez commencé à transformer en compréhension ?
[pause 18s]

Quelle est la ressource la plus profonde que vous apportez dans une relation d'aide ?
[pause 18s]

En une phrase... qui êtes-vous comme praticien ?
[pause 18s]

Notez ce qui est venu dans votre carnet.
[pause 5s]
Sans corriger.
[pause 5s]
Sans minimiser.
[pause 8s]

Vous commencez ici.
[pause 5s]
Avec ce que vous êtes.
[pause 5s]
C'est suffisant.
[pause 10s]
SCRIPT,

        // ─────────────────────────────────────────────────────────
        // PRATICIEN — Module 02 — Je maîtrise les outils du souffle
        // ─────────────────────────────────────────────────────────
        '02-je-maitrise-les-outils-du-souffle' => <<<'SCRIPT'
Installez-vous.
[pause 5s]

Vous avez une intuition sur le souffle.
[pause 5s]
Vous sentez ce qu'il fait en vous.
[pause 5s]
Ce module vous donne les mots précis.
[pause 4s]
Et les outils pour les transmettre.
[pause 10s]

Un praticien Pause Souffle ne travaille pas avec une seule technique.
[pause 5s]
Il travaille avec un répertoire.
[pause 5s]
Sept outils distincts.
[pause 5s]
Chacun pour un état... un besoin... un moment spécifique.
[pause 10s]

Fermez les yeux.
[pause 6s]

Trois respirations pour arriver ici.
[pause 20s]

Le premier outil... vous le connaissez.
[pause 5s]
La Pause Souffle cinq-cinq-cinq.
[pause 5s]
Cohérence cardiaque.
[pause 4s]
Régulation du système nerveux autonome.
[pause 4s]
Activation du nerf vague.
[pause 5s]
C'est votre ancre centrale.
[pause 8s]

Le deuxième outil.
[pause 5s]
Le souffle de feu.
[pause 5s]
Inspirations et expirations courtes et rythmées par le nez.
[pause 5s]
Il active... éveille... libère les tensions accumulées.
[pause 8s]

Le troisième.
[pause 5s]
Le souffle alterné.
[pause 5s]
Narine droite... narine gauche... à tour de rôle.
[pause 5s]
Il équilibre les deux hémisphères du cerveau.
[pause 4s]
Clarté mentale.
[pause 4s]
Calme intérieur.
[pause 8s]

Le quatrième.
[pause 5s]
L'expiration prolongée.
[pause 5s]
Inspir sur quatre secondes... expir sur huit.
[pause 5s]
Le frein parasympathique le plus rapide qui soit.
[pause 5s]
Pour les urgences émotionnelles... le retour à la fenêtre de tolérance.
[pause 8s]

Le cinquième.
[pause 5s]
Le souffle en carré.
[pause 5s]
Quatre entrées... quatre blocages... quatre sorties... quatre pauses.
[pause 5s]
Utilisé par les forces spéciales pour rester calme sous pression extrême.
[pause 8s]

Le sixième.
[pause 5s]
Le souffle de cohérence étendue.
[pause 5s]
Six secondes d'inspiration... six secondes d'expiration.
[pause 5s]
Synchronisation optimale cœur-cerveau.
[pause 4s]
Pour les séances longues... les états profonds.
[pause 8s]

Le septième.
[pause 5s]
Le souffle de libération sonore.
[pause 5s]
Expiration avec un son... un soupir... un murmure.
[pause 5s]
Le son vibre dans le nerf vague.
[pause 4s]
Il libère ce que le corps retient en silence.
[pause 10s]

Sept outils.
[pause 5s]
Sept clés pour sept états.
[pause 5s]
Un praticien qui les maîtrise adapte sa séance à chaque client... à chaque moment.
[pause 10s]

C'est par le corps que nous ancrons cette maîtrise.
[pause 8s]

Nous allons pratiquer la méthode cinq-cinq-cinq.
[pause 5s]

Cinq secondes pour inspirer.
[pause 2s]
Cinq secondes pour bloquer.
[pause 2s]
Cinq secondes pour expirer.
[pause 4s]
Dix cycles.
[pause 2s]
Deux minutes et demie de présence dans votre répertoire.
[pause 6s]

À l'inspiration... laissez entrer la maîtrise.
[pause 4s]
Au blocage... sentez la solidité de ce que vous portez.
[pause 4s]
À l'expiration... imaginez le transmettre avec clarté.
[pause 6s]

Nous commençons.
[BREATHING_CYCLES]
[pause 20s]

Ce calme... c'est votre terrain de pratique.
[pause 5s]
C'est là que vous allez travailler.
[pause 15s]

Laissez le souffle reprendre son rythme naturel.
[pause 10s]

Restez là.
[pause 8s]
Sans rien faire.
[pause 12s]

Quel outil du souffle correspond le mieux à votre énergie naturelle de praticien ?
[pause 18s]

Pour quel type de client ou de situation voulez-vous vous entraîner en priorité ?
[pause 18s]

Quelle est votre mission de praticien du souffle... en une phrase ?
[pause 18s]

Notez ce qui est venu dans votre carnet.
[pause 5s]
Les outils appartiennent à ceux qui les pratiquent.
[pause 5s]
Pratiquez chaque jour.
[pause 10s]
SCRIPT,

        // ─────────────────────────────────────────────────────────
        // PRATICIEN — Module 10 — La Posture du Praticien
        // ─────────────────────────────────────────────────────────
        '10-la-posture-du-praticien' => <<<'SCRIPT'
Installez-vous.
[pause 5s]

Il y a une différence fondamentale entre savoir guider un souffle...
[pause 5s]
et être un praticien.
[pause 5s]
Cette différence... c'est la posture.
[pause 10s]

La posture du praticien n'est pas une technique.
[pause 5s]
C'est un état d'être.
[pause 5s]
Une façon d'occuper l'espace... d'habiter votre voix... de gérer votre état intérieur...
[pause 4s]
avant même que votre client entre dans la salle.
[pause 10s]

Fermez les yeux.
[pause 6s]

Trois respirations pour arriver ici.
[pause 20s]

La première dimension de la posture... c'est la présence physique.
[pause 6s]

Un praticien dont le corps est affaissé... agité... tendu...
[pause 5s]
transmet cet état à son client... avant d'avoir prononcé un mot.
[pause 5s]
Le système nerveux de l'autre vous lit.
[pause 5s]
En quelques secondes.
[pause 5s]
Il est câblé pour ça.
[pause 8s]

Sentez votre corps maintenant.
[pause 5s]
Les pieds au sol.
[pause 4s]
Le dos droit mais vivant.
[pause 4s]
Les épaules relâchées.
[pause 4s]
Le visage ouvert.
[pause 6s]

Cette posture physique est déjà un message.
[pause 5s]
Elle dit... je suis là.
[pause 4s]
Je suis stable.
[pause 4s]
Tu es en sécurité.
[pause 10s]

La deuxième dimension... la voix thérapeutique.
[pause 6s]

La voix d'un praticien n'est pas sa voix quotidienne.
[pause 5s]
Elle est plus lente.
[pause 4s]
Plus grave.
[pause 4s]
Plus posée.
[pause 5s]
Elle descend... plutôt qu'elle ne monte.
[pause 5s]
Elle crée un espace... plutôt qu'elle ne le remplit.
[pause 8s]

Votre voix peut activer ou désactiver le système nerveux de l'autre.
[pause 5s]
Chaque mot.
[pause 4s]
Chaque pause.
[pause 4s]
Chaque variation de ton.
[pause 5s]
C'est votre instrument thérapeutique principal.
[pause 10s]

La troisième dimension... l'état intérieur.
[pause 6s]

Un praticien ne peut pas être dans la peur... la performance... ou le jugement...
[pause 5s]
et en même temps créer un espace de sécurité pour son client.
[pause 5s]
Les deux choses ne peuvent pas coexister.
[pause 8s]

Avant chaque séance... prenez trois cycles de souffle conscient.
[pause 5s]
Pas pour vous préparer à performer.
[pause 4s]
Pour vous rappeler qui vous êtes.
[pause 5s]
Un espace.
[pause 4s]
Pas une solution.
[pause 10s]

La quatrième dimension... la prévention du burn-out du praticien.
[pause 6s]

Un praticien qui donne sans se recharger... s'épuise.
[pause 5s]
Ce n'est pas une faiblesse.
[pause 4s]
C'est la biologie.
[pause 6s]

La règle est simple.
[pause 5s]
Ce que vous demandez à vos clients de faire... vous le faites aussi.
[pause 4s]
Chaque jour.
[pause 4s]
Sans exception.
[pause 10s]

C'est par le corps que nous ancrons cette posture.
[pause 8s]

Nous allons pratiquer la méthode cinq-cinq-cinq.
[pause 5s]

Cinq secondes pour inspirer.
[pause 2s]
Cinq secondes pour bloquer.
[pause 2s]
Cinq secondes pour expirer.
[pause 4s]
Dix cycles.
[pause 2s]
Deux minutes et demie dans la posture du praticien.
[pause 6s]

À l'inspiration... laissez entrer la stabilité.
[pause 4s]
Au blocage... tenez l'espace.
[pause 4s]
À l'expiration... offrez la sécurité.
[pause 6s]

Nous commençons.
[BREATHING_CYCLES]
[pause 20s]

Ce calme... c'est votre posture naturelle.
[pause 5s]
Elle existe en vous.
[pause 5s]
Ce module vous aide à l'habiter consciemment.
[pause 15s]

Laissez le souffle reprendre son rythme naturel.
[pause 10s]

Restez là.
[pause 8s]
Sans rien faire.
[pause 12s]

Quelle dimension de la posture demande le plus de travail pour vous... physique... voix... état intérieur... ou ressourcement ?
[pause 18s]

Qu'est-ce que vous faites déjà naturellement bien dans votre posture de praticien ?
[pause 18s]

Quel rituel de ressourcement allez-vous mettre en place cette semaine ?
[pause 18s]

Notez ce qui est venu dans votre carnet.
[pause 5s]
La posture se cultive dans le quotidien.
[pause 5s]
Pas seulement devant un client.
[pause 10s]
SCRIPT,

        // ─────────────────────────────────────────────────────────
        // PRATICIEN — Module 11 — Lire un Client, Adapter le Protocole
        // ─────────────────────────────────────────────────────────
        '11-lire-un-client-adapter-le-protocole' => <<<'SCRIPT'
Installez-vous.
[pause 5s]

Un protocole rigide... appliqué de la même façon à tout le monde...
[pause 5s]
n'est pas une pratique professionnelle.
[pause 5s]
C'est une prestation standardisée.
[pause 8s]

Un praticien se distingue par sa capacité à lire.
[pause 5s]
À percevoir.
[pause 4s]
À adapter.
[pause 4s]
En temps réel.
[pause 10s]

Ce module vous donne les clés de cette intelligence relationnelle.
[pause 8s]

Fermez les yeux.
[pause 6s]

Trois respirations pour arriver ici.
[pause 20s]

Commençons par les quatre profils de client.
[pause 6s]

Le premier profil.
[pause 5s]
Le client analytique.
[pause 5s]
Il a besoin de comprendre avant de ressentir.
[pause 5s]
Donnez-lui l'anatomie... la physiologie... les études.
[pause 4s]
Expliquez avant de guider.
[pause 4s]
Sa porte d'entrée... c'est l'intellect.
[pause 8s]

Le deuxième profil.
[pause 5s]
Le client émotionnel.
[pause 5s]
Il est déjà dans le ressenti.
[pause 4s]
Il a besoin de sécurité d'abord.
[pause 4s]
De votre présence.
[pause 4s]
Pas d'explications.
[pause 5s]
Sa porte d'entrée... c'est la connexion humaine.
[pause 8s]

Le troisième profil.
[pause 5s]
Le client sceptique.
[pause 5s]
Il teste.
[pause 4s]
Il observe.
[pause 4s]
Il est là malgré lui... ou presque.
[pause 5s]
Ne cherchez pas à le convaincre.
[pause 4s]
Laissez l'expérience parler.
[pause 5s]
Sa porte d'entrée... c'est le résultat concret.
[pause 8s]

Le quatrième profil.
[pause 5s]
Le client en crise.
[pause 5s]
Il est saturé.
[pause 4s]
Épuisé.
[pause 4s]
Submergé.
[pause 5s]
Il a besoin d'un ancrage immédiat.
[pause 4s]
Pas de théorie.
[pause 4s]
Juste... revenir au corps.
[pause 4s]
Là.
[pause 3s]
Maintenant.
[pause 8s]

Maintenant... les cinq canaux non-verbaux.
[pause 6s]

Ce que votre client vous dit par son corps... avant de parler.
[pause 6s]

La respiration.
[pause 5s]
Est-elle courte... haute... bloquée... ou ample ?
[pause 8s]

La posture.
[pause 5s]
Affaissée... fermée... rigide... ou ouverte ?
[pause 8s]

Le regard.
[pause 5s]
Fuyant... fixe... présent... ou absent ?
[pause 8s]

La voix.
[pause 5s]
Rapide... monotone... tremblante... ou posée ?
[pause 8s]

Le tonus général.
[pause 5s]
Hyper-activé... figé... ou disponible ?
[pause 8s]

Ces cinq canaux... ensemble... vous donnent le tableau de votre client.
[pause 5s]
Avant même qu'il vous ait dit un mot.
[pause 10s]

C'est par le corps que nous ancrons cette perception.
[pause 8s]

Nous allons pratiquer la méthode cinq-cinq-cinq.
[pause 5s]

Cinq secondes pour inspirer.
[pause 2s]
Cinq secondes pour bloquer.
[pause 2s]
Cinq secondes pour expirer.
[pause 4s]
Dix cycles.
[pause 2s]
Deux minutes et demie d'attention ouverte.
[pause 6s]

À l'inspiration... ouvrez votre perception.
[pause 4s]
Au blocage... laissez entrer l'information.
[pause 4s]
À l'expiration... restez disponible.
[pause 6s]

Nous commençons.
[BREATHING_CYCLES]
[pause 20s]

Ce calme... c'est la fondation de votre perception.
[pause 5s]
Un praticien détendu perçoit mieux qu'un praticien concentré.
[pause 15s]

Laissez le souffle reprendre son rythme naturel.
[pause 10s]

Restez là.
[pause 8s]
Sans rien faire.
[pause 12s]

Parmi les quatre profils... lequel vous met le plus en défi ?
[pause 18s]

Quel canal non-verbal lisez-vous naturellement le mieux ?
[pause 18s]

Quelle est la question d'entrée que vous posez en début de séance pour calibrer votre approche ?
[pause 18s]

Notez ce qui est venu dans votre carnet.
[pause 5s]
La lecture du client est un art.
[pause 5s]
Il se développe à chaque séance.
[pause 10s]
SCRIPT,

        // ─────────────────────────────────────────────────────────
        // PRATICIEN — Module 12 — Construire une Pratique Professionnelle
        // ─────────────────────────────────────────────────────────
        '12-construire-une-pratique-professionnelle' => <<<'SCRIPT'
Installez-vous.
[pause 5s]

Vous pouvez être le meilleur praticien du monde.
[pause 5s]
Si personne ne sait que vous existez...
[pause 5s]
votre pratique reste une intention.
[pause 10s]

Ce module ne parle pas de marketing au sens publicitaire.
[pause 5s]
Il parle de quelque chose de plus fondamental.
[pause 5s]
La construction d'une pratique qui vous ressemble.
[pause 5s]
Et qui sert vraiment les personnes qui en ont besoin.
[pause 10s]

Fermez les yeux.
[pause 6s]

Trois respirations pour arriver ici.
[pause 20s]

Premièrement... l'offre de service.
[pause 6s]

Un praticien Pause Souffle peut proposer quatre formats principaux.
[pause 5s]

La séance individuelle.
[pause 5s]
En cabinet... à domicile... ou en ligne.
[pause 4s]
45 à 90 minutes.
[pause 4s]
L'accompagnement le plus personnalisé.
[pause 8s]

L'atelier collectif.
[pause 5s]
Deux à vingt personnes.
[pause 4s]
En entreprise... en salle... en plein air.
[pause 4s]
Format énergie haute... impact immédiat.
[pause 8s]

Le programme d'accompagnement.
[pause 5s]
Six à douze semaines.
[pause 4s]
Séances régulières... progression mesurable.
[pause 4s]
La transformation la plus profonde.
[pause 8s]

La retraite ou le séminaire.
[pause 5s]
L'expérience immersive.
[pause 4s]
L'impact démultiplié.
[pause 8s]

Deuxièmement... la tarification.
[pause 6s]

Votre tarif n'est pas un chiffre aléatoire.
[pause 5s]
C'est une déclaration de valeur.
[pause 5s]
Trop bas... et vous vous dévaluez vous-même.
[pause 4s]
Vous envoyez un signal de manque de confiance.
[pause 5s]
Le bon tarif correspond à votre niveau de formation...
[pause 4s]
à la valeur transformationnelle que vous apportez...
[pause 4s]
et au marché local.
[pause 8s]

Troisièmement... les trois premiers clients.
[pause 6s]

Ce ne sont pas vos meilleurs clients.
[pause 5s]
Ce sont vos professeurs.
[pause 5s]
Les plus précieux.
[pause 5s]
Cherchez-les dans votre entourage direct.
[pause 4s]
Proposez les premières séances en échange de retours honnêtes.
[pause 4s]
Pas en échange d'avis publics.
[pause 4s]
En échange de vérité.
[pause 8s]

Quatrièmement... la présence digitale minimale.
[pause 6s]

Vous n'avez pas besoin d'un funnel marketing complexe pour commencer.
[pause 5s]
Vous avez besoin d'une chose.
[pause 5s]
Que les bonnes personnes puissent vous trouver et vous contacter.
[pause 5s]
Un profil clair... une offre lisible... un moyen de prendre rendez-vous.
[pause 5s]
C'est tout.
[pause 10s]

C'est par le corps que nous ancrons cette vision.
[pause 8s]

Nous allons pratiquer la méthode cinq-cinq-cinq.
[pause 5s]

Cinq secondes pour inspirer.
[pause 2s]
Cinq secondes pour bloquer.
[pause 2s]
Cinq secondes pour expirer.
[pause 4s]
Dix cycles.
[pause 2s]
Deux minutes et demie pour incarner votre pratique.
[pause 6s]

À l'inspiration... voyez votre pratique déjà vivante.
[pause 4s]
Au blocage... tenez cette vision.
[pause 4s]
À l'expiration... laissez partir les peurs de ne pas être prêt.
[pause 6s]

Nous commençons.
[BREATHING_CYCLES]
[pause 20s]

Ce calme... c'est la confiance en ce que vous construisez.
[pause 5s]
Elle existe.
[pause 5s]
Elle grandit à chaque séance.
[pause 15s]

Laissez le souffle reprendre son rythme naturel.
[pause 10s]

Restez là.
[pause 8s]
Sans rien faire.
[pause 12s]

Quel format de service correspond le plus à votre énergie naturelle ?
[pause 18s]

Qui sont les trois premières personnes que vous pourriez accompagner dans votre entourage ?
[pause 18s]

Quelle peur vous retient encore de vous lancer... et qu'est-ce qui serait vrai si cette peur n'existait pas ?
[pause 18s]

Notez ce qui est venu dans votre carnet.
[pause 5s]
Votre pratique commence au moment où vous décidez qu'elle a commencé.
[pause 5s]
Pas quand vous serez parfaitement prêt.
[pause 10s]
SCRIPT,

        // ─────────────────────────────────────────────────────────
        // PRATICIEN — Module 13 — Limites, Contre-indications & Responsabilité
        // ─────────────────────────────────────────────────────────
        '13-limites-contre-indications-responsabilite' => <<<'SCRIPT'
Installez-vous.
[pause 5s]

L'éthique n'est pas une contrainte.
[pause 5s]
C'est la structure qui vous protège... vous... et vos clients.
[pause 5s]
Sans limites claires... une pratique professionnelle ne tient pas.
[pause 10s]

Ce module est l'un des plus importants de votre formation.
[pause 5s]
Pas le plus spectaculaire.
[pause 4s]
Le plus fondamental.
[pause 10s]

Fermez les yeux.
[pause 6s]

Trois respirations pour arriver ici.
[pause 20s]

Premièrement... les cinq situations qui nécessitent l'arrêt de la séance.
[pause 6s]

Une... hyperventilation incontrôlée.
[pause 5s]
Si le client perd le contrôle de sa respiration... arrêt immédiat.
[pause 4s]
Retour à la respiration naturelle.
[pause 4s]
Jamais de pression.
[pause 8s]

Deux... crise émotionnelle intense.
[pause 5s]
Pleurs incontrôlables... agitation majeure... état dissociatif.
[pause 5s]
Le praticien ne continue pas.
[pause 4s]
Il pose une présence.
[pause 4s]
Il stabilise.
[pause 8s]

Trois... douleur physique.
[pause 5s]
Toute douleur signalée... aussi minime soit-elle... justifie un ajustement ou un arrêt.
[pause 5s]
Le corps parle.
[pause 4s]
Écoutez-le.
[pause 8s]

Quatre... vertiges ou malaise.
[pause 5s]
Fréquents lors de techniques intenses.
[pause 4s]
Faites allonger.
[pause 4s]
Hydratation.
[pause 4s]
Repos.
[pause 8s]

Cinq... refus ou désir d'arrêt.
[pause 5s]
Si le client veut s'arrêter... pour quelque raison que ce soit...
[pause 5s]
on s'arrête.
[pause 4s]
Sans discussion.
[pause 4s]
Sans jugement.
[pause 8s]

Deuxièmement... les contre-indications médicales.
[pause 6s]

Toujours demander... avant toute séance.
[pause 5s]
Troubles cardiaques.
[pause 4s]
Épilepsie.
[pause 4s]
Grossesse avancée.
[pause 4s]
État psychiatrique non stabilisé.
[pause 4s]
Tension artérielle non contrôlée.
[pause 5s]
Consultez le médecin traitant si vous avez le moindre doute.
[pause 5s]
Ce n'est pas à vous de diagnostiquer.
[pause 4s]
C'est à vous d'orienter.
[pause 8s]

Troisièmement... le RGPD et la confidentialité.
[pause 6s]

Les données personnelles de vos clients sont protégées.
[pause 5s]
Nom... état de santé... informations partagées en séance.
[pause 5s]
Rien ne sort de la relation praticien-client sans consentement explicite.
[pause 5s]
Aucune exception.
[pause 8s]

Quatrièmement... la déontologie.
[pause 6s]

Un praticien Pause Souffle n'est pas thérapeute.
[pause 5s]
Il ne pose pas de diagnostic.
[pause 4s]
Il n'interprète pas les symptômes.
[pause 4s]
Il n'entre pas en concurrence avec le médecin ou le psychologue.
[pause 5s]
Il crée les conditions pour que le corps se régule.
[pause 5s]
Ce n'est pas rien.
[pause 4s]
C'est même précieux.
[pause 4s]
Soyez clair sur ce que vous êtes.
[pause 8s]

C'est par le corps que nous scellons cet engagement.
[pause 8s]

Nous allons pratiquer la méthode cinq-cinq-cinq.
[pause 5s]

Cinq secondes pour inspirer.
[pause 2s]
Cinq secondes pour bloquer.
[pause 2s]
Cinq secondes pour expirer.
[pause 4s]
Dix cycles.
[pause 2s]
Deux minutes et demie de responsabilité consciente.
[pause 6s]

À l'inspiration... laissez entrer la clarté.
[pause 4s]
Au blocage... tenez votre cadre.
[pause 4s]
À l'expiration... offrez cette sécurité à vos futurs clients.
[pause 6s]

Nous commençons.
[BREATHING_CYCLES]
[pause 20s]

Ce calme... c'est la fondation de votre pratique éthique.
[pause 5s]
Un praticien clair... est un praticien sûr.
[pause 15s]

Laissez le souffle reprendre son rythme naturel.
[pause 10s]

Restez là.
[pause 8s]
Sans rien faire.
[pause 12s]

Y a-t-il une limite que vous n'avez pas encore osé poser... une situation que vous n'avez pas anticipée ?
[pause 18s]

Quel serait le premier geste pour structurer la partie administrative et éthique de votre pratique ?
[pause 18s]

Quelle phrase résume votre engagement envers vos clients... votre serment de praticien ?
[pause 18s]

Notez ce qui est venu dans votre carnet.
[pause 5s]
Un praticien éthique sait pourquoi il fait ce qu'il fait.
[pause 5s]
Et ce qu'il ne fait pas.
[pause 10s]
SCRIPT,

        // ─────────────────────────────────────────────────────────
        // PRATICIEN — Module 14 — La Relation de Soin — cible : 16–18 min
        // ─────────────────────────────────────────────────────────
        '14-la-relation-de-soin' => <<<'SCRIPT'
Bienvenue dans le module 14.
[pause 6s]

La Relation de Soin.
[pause 5s]
Ce qui guérit vraiment.
[pause 8s]

Vous avez appris des outils.
[pause 5s]
Vous avez appris des protocoles.
[pause 5s]
Vous avez traversé votre propre blessure pour mieux comprendre celle des autres.
[pause 8s]

Mais aujourd'hui, nous allons au cœur de ce qui fait la différence entre un technicien du souffle et un vrai praticien.
[pause 8s]

Ce qui guérit... ce n'est souvent pas la technique.
[pause 6s]
C'est la relation.
[pause 8s]

Inspirez profondément...
[pause 5s]
Bloquez...
[pause 5s]
Relâchez...
[pause 8s]

Jung a nommé ce paradoxe avec une précision rare.
[pause 5s]
Il l'appelait le Blessé-Guérisseur.
[pause 8s]

L'idée est simple et bouleversante.
[pause 5s]
Celui qui soigne porte lui-même une blessure.
[pause 6s]
Et ce n'est pas un obstacle à sa pratique.
[pause 5s]
C'est sa qualification la plus profonde.
[pause 10s]

Isidore de Séville, médecin du Moyen Âge, disait que le médecin qui n'a jamais souffert ne peut pas vraiment soigner.
[pause 8s]
Pas parce qu'il manque d'information.
[pause 5s]
Mais parce qu'il manque de résonance.
[pause 8s]

Quand vous avez traversé la peur, l'épuisement, le doute... vous reconnaissez ces états chez votre client.
[pause 6s]
Non pas intellectuellement.
[pause 5s]
Mais dans votre corps.
[pause 8s]

Votre blessure intégrée devient votre antenne.
[pause 6s]
Votre blessure non intégrée devient votre angle mort.
[pause 10s]

Inspirez profondément...
[pause 5s]
Bloquez...
[pause 5s]
Relâchez...
[pause 8s]

Parlons maintenant du conteneur thérapeutique.
[pause 6s]

Beaucoup de praticiens pensent que leur rôle est de guider une technique.
[pause 6s]
Mais votre rôle premier est de créer un espace.
[pause 8s]

Un espace où le client peut enfin se permettre de ne pas contrôler.
[pause 6s]
Où il peut lâcher certaines tensions qu'il portait depuis des années.
[pause 6s]
Où quelque chose de plus profond peut émerger.
[pause 10s]

Ce conteneur a cinq dimensions.
[pause 6s]

Premièrement — la sécurité physique.
[pause 5s]
L'espace est confortable, protégé, sans interruption possible.
[pause 5s]
Le client sait qu'il est en sécurité dans son corps.
[pause 8s]

Deuxièmement — la sécurité émotionnelle.
[pause 5s]
Il peut ressentir sans être jugé.
[pause 5s]
Il peut pleurer, se taire, ne pas savoir.
[pause 5s]
Vous êtes là — stable — quoi qu'il arrive.
[pause 8s]

Troisièmement — la clarté du cadre.
[pause 5s]
Il sait pourquoi il est là, ce qui va se passer, et ce qui ne se passera pas.
[pause 5s]
Le cadre est une forme de respect.
[pause 8s]

Quatrièmement — votre présence.
[pause 5s]
Pas votre performance. Votre présence.
[pause 5s]
Vous êtes ancré. Calme. Disponible.
[pause 5s]
Vous n'avez pas besoin qu'il aille bien pour ne pas vous effondrer.
[pause 8s]

Cinquièmement — l'intention claire.
[pause 5s]
Vous savez pourquoi vous êtes là.
[pause 5s]
Vous servez une transformation, pas votre propre besoin d'être reconnu.
[pause 10s]

Inspirez profondément...
[pause 5s]
Bloquez...
[pause 5s]
Relâchez...
[pause 8s]

Il existe un phénomène neurologique qui explique beaucoup de ce que vous vivez en séance.
[pause 6s]
On l'appelle la co-régulation nerveuse.
[pause 8s]

Votre système nerveux et celui de votre client... se parlent.
[pause 6s]
Pas avec des mots. Avec des micro-signaux.
[pause 6s]
Le rythme de votre respiration. Le tonus de votre corps. La qualité de votre regard.
[pause 8s]

Un praticien dont le système nerveux est cohérent crée automatiquement — involontairement — un effet régulateur sur son client.
[pause 8s]
C'est pour ça que votre pratique personnelle quotidienne n'est pas un luxe.
[pause 6s]
C'est le fondement de votre efficacité.
[pause 10s]

Quand vous arrivez en séance dans un état de cohérence cardiaque...
[pause 5s]
Votre client le ressent avant que vous ayez prononcé un seul mot.
[pause 6s]
Son système nerveux commence à se réguler simplement parce que le vôtre est régulé.
[pause 10s]

Inspirez profondément...
[pause 5s]
Bloquez...
[pause 5s]
Relâchez...
[pause 8s]

Ce que les clients cherchent vraiment.
[pause 6s]

Ils viennent pour le souffle. Ou pour dormir. Ou pour gérer le stress.
[pause 6s]
Ce qu'ils cherchent en surface est réel et doit être honoré.
[pause 8s]

Mais dans la couche plus profonde...
[pause 5s]
Ils cherchent à être vus.
[pause 6s]
Vraiment vus.
[pause 6s]
Pas corrigés. Pas optimisés. Pas réparés.
[pause 5s]
Vus.
[pause 10s]

Et dans la couche la plus profonde de toutes...
[pause 5s]
Ils cherchent à se réconcilier avec eux-mêmes.
[pause 6s]
À ne plus être en guerre contre leur corps, leurs émotions, leur histoire.
[pause 10s]

Votre rôle n'est pas de les guérir.
[pause 5s]
Votre rôle est de créer les conditions pour qu'ils puissent se guérir eux-mêmes.
[pause 10s]

Il y a une dernière dimension que nous n'abordons presque jamais.
[pause 6s]
Le silence thérapeutique.
[pause 8s]

Dans notre culture, le silence est inconfortable.
[pause 5s]
On se précipite pour le remplir.
[pause 5s]
On parle pour éviter de sentir.
[pause 8s]

Mais en séance, le silence est souvent l'outil le plus puissant disponible.
[pause 6s]
Il donne au client l'espace pour descendre plus profondément.
[pause 6s]
Pour rencontrer quelque chose qui ne peut émerger que dans la quietude.
[pause 10s]

Apprendre à tenir le silence sans l'interrompre...
[pause 5s]
C'est l'un des apprentissages les plus difficiles.
[pause 5s]
Et l'un des plus précieux.
[pause 10s]

Inspirez profondément...
[pause 5s]
Bloquez...
[pause 5s]
Relâchez...
[pause 8s]

Maintenant, posez-vous cette question.
[pause 6s]
Dans vos séances passées — qu'est-ce qui semble avoir véritablement touché vos clients ?
[pause 18s]

Est-ce une technique spécifique... ou quelque chose dans votre présence ?
[pause 18s]

Quelle dimension du conteneur thérapeutique vous semble la plus naturelle pour vous... et laquelle demande encore du travail ?
[pause 18s]

Notez ce qui est venu.
[pause 5s]
La relation de soin commence par la relation à soi-même.
[pause 5s]
Soignez-vous d'abord.
[pause 10s]
SCRIPT,

        // ─────────────────────────────────────────────────────────
        // PRATICIEN — Module 15 — La Signature du Praticien — cible : 16–18 min
        // ─────────────────────────────────────────────────────────
        '15-signature-du-praticien' => <<<'SCRIPT'
Bienvenue dans le module 15.
[pause 6s]

Le module final de votre formation.
[pause 8s]

La Signature du Praticien.
[pause 6s]
Qui êtes-vous vraiment ?
[pause 10s]

Depuis le module zéro jusqu'ici...
[pause 5s]
Vous avez traversé beaucoup.
[pause 6s]
Vous avez compris le corps. Maîtrisé les outils. Traversé vos propres blessures.
[pause 6s]
Vous avez appris la posture, la voix, l'état interne.
[pause 6s]
Vous avez compris ce qui guérit vraiment.
[pause 10s]

Il reste une chose.
[pause 6s]
La plus difficile pour beaucoup.
[pause 8s]

Incarnez tout cela... comme votre propre signature.
[pause 8s]
Pas la copie d'un autre praticien.
[pause 5s]
Pas le clone d'un modèle admiré.
[pause 5s]
Vous — unique, imparfait, vivant, singulier.
[pause 10s]

Inspirez profondément...
[pause 5s]
Bloquez...
[pause 5s]
Relâchez...
[pause 8s]

Une signature de praticien... ce n'est pas un slogan marketing.
[pause 6s]
C'est ce que les clients reconnaissent avant même que vous parliez.
[pause 6s]
C'est l'empreinte que vous laissez quand vous êtes pleinement vous-même.
[pause 10s]

Cette signature a cinq dimensions.
[pause 6s]

Premièrement — votre tonalité naturelle.
[pause 5s]
Êtes-vous chaleureux ou structuré ? Intuitif ou méthodique ? Guidant ou silencieux ?
[pause 6s]
Ce n'est pas ce que vous choisissez de montrer.
[pause 5s]
C'est ce qui émerge quand vous êtes à l'aise.
[pause 5s]
Votre tonalité est juste. Elle s'affine. Elle ne se remplace pas.
[pause 8s]

Deuxièmement — votre public naturel.
[pause 5s]
Qui vient vers vous spontanément ? Qui se sent immédiatement à l'aise avec vous ?
[pause 6s]
Ce sont les personnes que vous êtes le mieux équipé pour accompagner en premier.
[pause 5s]
Servir son public naturel d'abord... c'est choisir l'efficacité avant l'universalité.
[pause 8s]

Troisièmement — votre outil de prédilection.
[pause 5s]
Parmi tout ce que vous avez appris... où êtes-vous le plus naturellement à l'aise ?
[pause 6s]
Maîtriser un outil en profondeur vaut mille fois plus que connaître dix techniques en surface.
[pause 8s]

Quatrièmement — votre promesse implicite.
[pause 5s]
Pas votre accroche. La promesse que votre présence fait sans que vous la formuliez.
[pause 6s]
"Avec ce praticien, je vais être en sécurité."
[pause 5s]
"Avec ce praticien, je vais être challengé à aller plus loin."
[pause 5s]
"Avec ce praticien, je vais enfin être compris."
[pause 8s]
Connaître votre promesse implicite permet de la tenir consciemment.
[pause 8s]

Cinquièmement — votre valeur fondatrice.
[pause 5s]
La valeur que vous ne sacrifiez jamais dans votre pratique.
[pause 5s]
L'intégrité ? L'authenticité ? La profondeur ? La vérité nommée ?
[pause 6s]
Quand vous prenez une décision difficile dans votre pratique...
[pause 5s]
C'est cette valeur qui tranche.
[pause 10s]

Inspirez profondément...
[pause 5s]
Bloquez...
[pause 5s]
Relâchez...
[pause 8s]

Parlons maintenant de l'éthique.
[pause 6s]

La formation vous a transmis des outils puissants.
[pause 5s]
Des outils qui accèdent aux couches profondes du système nerveux.
[pause 5s]
Qui déverrouillent des émotions. Qui touchent aux blessures primaires.
[pause 8s]

Ce pouvoir s'accompagne d'une responsabilité absolue.
[pause 10s]

Vous ne dépassez jamais vos compétences.
[pause 5s]
Si un client présente des symptômes qui dépassent le bien-être...
[pause 5s]
vous l'orientez vers un professionnel de santé mentale.
[pause 5s]
Ce n'est pas un aveu de faiblesse. C'est de la déontologie.
[pause 8s]

Votre travail réussit quand votre client a moins besoin de vous.
[pause 6s]
Quand il pratique seul. Quand il porte ses propres outils.
[pause 6s]
Si vous sentez que vous cherchez à le garder... supervisez cela avec un pair.
[pause 8s]

Vous protégez le cadre de la relation.
[pause 5s]
Pas de relation personnelle avec un client en cours de suivi.
[pause 5s]
Le cadre protège le client. Il vous protège aussi.
[pause 8s]

Vous continuez de vous former et de vous superviser.
[pause 5s]
Un praticien qui arrête d'apprendre stagne.
[pause 5s]
La supervision n'est pas un signe que ça va mal.
[pause 5s]
C'est le signe que vous prenez votre pratique au sérieux.
[pause 10s]

Inspirez profondément...
[pause 5s]
Bloquez...
[pause 5s]
Relâchez...
[pause 8s]

Nous arrivons au moment le plus important de cette formation.
[pause 6s]

Posez votre main droite sur votre cœur.
[pause 6s]

Prenez le temps de traverser mentalement tout ce que vous avez appris depuis le module zéro.
[pause 12s]

Vos moments de doute. Vos moments de clarté.
[pause 6s]
Ce qui était facile. Ce qui vous a résisté.
[pause 6s]
Les pratiques qui you ont fait quelque chose.
[pause 6s]
Les idées qui ont réorganisé votre compréhension.
[pause 10s]

Et maintenant, depuis cet endroit...
[pause 6s]
Dites intérieurement, ou à voix haute si vous le pouvez :
[pause 6s]

Je m'appelle... votre prénom.
[pause 6s]
Je suis praticien du souffle.
[pause 6s]
Je sers en transmettant ce que j'ai moi-même traversé.
[pause 6s]
Ma présence est mon premier outil.
[pause 6s]
Ma blessure intégrée est ma qualification la plus profonde.
[pause 6s]
Je ne prétends pas être parfait.
[pause 5s]
Je m'engage à être présent.
[pause 6s]
Et à rester présent — pour ceux que j'accompagne...
[pause 5s]
et pour moi-même.
[pause 15s]

Inspirez profondément...
[pause 5s]
Bloquez...
[pause 5s]
Relâchez...
[pause 12s]

Dans votre carnet de praticien, écrivez votre propre version de cette déclaration.
[pause 6s]
En vos mots. Avec votre voix.
[pause 6s]
Ce texte sera votre boussole pour les années qui viennent.
[pause 10s]

Vous avez terminé la formation.
[pause 6s]
Mais votre pratique, elle, ne fait que commencer.
[pause 6s]
Portez ce que vous êtes.
[pause 5s]
C'est votre plus grand outil.
[pause 10s]
SCRIPT,

        // ─────────────────────────────────────────────────────────
        // PRATICIEN — Module 16 — L'Argent du Soin — cible : 14–16 min
        // ─────────────────────────────────────────────────────────
        '16-l-argent-du-soin' => <<<'SCRIPT'
Bienvenue dans le module 16.
[pause 6s]

Le chaînon manquant.
[pause 8s]

Ce module ne parle pas de techniques de souffle.
[pause 5s]
Il parle de quelque chose que presque aucune formation bien-être n'aborde jamais.
[pause 8s]

La conversation sur l'argent.
[pause 10s]

Voici une vérité que personne ne vous dit.
[pause 6s]
Quatre-vingt dix pourcent des praticiens en arts du soin abandonnent dans les trois premières années.
[pause 8s]
Pas par manque de talent.
[pause 5s]
Pas par manque de passion.
[pause 5s]
Par incapacité à parler d'argent... sans se sentir corrompus.
[pause 10s]

Inspirez profondément...
[pause 5s]
Bloquez...
[pause 5s]
Relâchez...
[pause 8s]

Il y a trois croyances qui sabotent en silence la plupart des praticiens bien-être.
[pause 8s]

Première croyance.
[pause 5s]
"Je ne peux pas facturer cher quelque chose de spirituel."
[pause 8s]
Réalité : votre temps, votre formation, votre espace et votre soin ont une valeur économique réelle.
[pause 6s]
Le spirituel ne justifie pas la précarité.
[pause 5s]
Vous pouvez honorer le sacré... et vivre dignement.
[pause 10s]

Deuxième croyance.
[pause 5s]
"Si je facture peu, plus de gens viendront."
[pause 8s]
L'inverse est souvent vrai.
[pause 6s]
Un prix trop bas communique une valeur faible.
[pause 5s]
Un client qui paie cinquante euros annule plus facilement qu'un client qui en a payé cent cinquante.
[pause 6s]
Le prix est un signal de valeur... pour vous... et pour votre client.
[pause 10s]

Troisième croyance.
[pause 5s]
"Si je gagne bien ma vie... je perds mon intégrité."
[pause 8s]
Cette croyance fait des ravages.
[pause 6s]
Un praticien financièrement épuisé ne peut pas servir pleinement.
[pause 5s]
Vous ne pouvez pas donner de l'eau... si votre puits est vide.
[pause 5s]
La durabilité financière... est un acte de service envers vos clients.
[pause 10s]

Inspirez profondément...
[pause 5s]
Bloquez...
[pause 5s]
Relâchez...
[pause 8s]

Parlons maintenant du prix juste.
[pause 6s]

Il existe une méthode simple en trois calculs.
[pause 6s]

Premier calcul — le prix de survie.
[pause 5s]
Vos charges mensuelles complètes, divisées par le nombre de séances réaliste par mois.
[pause 6s]
C'est votre seuil absolu. Vous ne pouvez jamais aller en dessous.
[pause 8s]

Deuxième calcul — le prix de dignité.
[pause 5s]
Le revenu qui vous permet de vivre bien, de vous former, de vous reposer.
[pause 6s]
Divisé par le nombre de séances sans vous épuiser.
[pause 8s]
Exemple : quatre mille cinq cents euros souhaités sur trente séances par mois... égal cent cinquante euros par séance.
[pause 10s]

Troisième calcul — le prix de valeur.
[pause 5s]
Quelle transformation concrète apportez-vous ?
[pause 6s]
Combien vaut-elle pour le client ?
[pause 6s]
Un client qui dort enfin après cinq ans d'insomnie —
[pause 5s]
combien valait ce résultat pour lui ?
[pause 8s]
Votre prix peut aller jusqu'à dix pourcent de la valeur perçue de la transformation.
[pause 10s]

Votre prix juste se situe entre le prix de dignité et le prix de valeur.
[pause 6s]
Il doit vous faire légèrement peur...
[pause 5s]
mais ne pas vous empêcher de le dire.
[pause 10s]

Inspirez profondément...
[pause 5s]
Bloquez...
[pause 5s]
Relâchez...
[pause 8s]

L'appel découverte.
[pause 6s]

C'est l'outil le plus puissant du praticien freelance.
[pause 6s]
Et le plus mal maîtrisé.
[pause 8s]

Il n'est pas un argumentaire.
[pause 5s]
Il n'est pas une présentation de vos services.
[pause 5s]
Si ça ressemble à "vendre"... vous avez perdu l'appel avant de commencer.
[pause 10s]

La structure en quatre temps.
[pause 6s]

Premier temps — l'accueil.
[pause 5s]
Créez l'espace. Pas de pitch. Juste une présence.
[pause 5s]
La première question n'est jamais sur leurs objectifs.
[pause 5s]
Elle est sur leur état.
[pause 5s]
"Comment vous sentez-vous en ce moment ?"
[pause 10s]

Deuxième temps — la situation.
[pause 5s]
"Qu'est-ce qui vous a amené à chercher ce type d'accompagnement maintenant ?"
[pause 6s]
"Depuis combien de temps vivez-vous avec ça ?"
[pause 6s]
Écoutez vraiment. Ne prenez pas de notes. Soyez présent.
[pause 8s]

Troisième temps — la vision.
[pause 5s]
"Si dans trois mois vous vous regardez en arrière — qu'est-ce qui aurait changé dans votre vie quotidienne ?"
[pause 8s]
Laissez-les voir leur propre transformation.
[pause 6s]
Vous n'avez rien à vendre.
[pause 8s]

Quatrième temps — l'alignement.
[pause 5s]
"Voici ce que j'accompagne, comment je travaille, et ce que ça demande de votre part."
[pause 6s]
Puis le prix.
[pause 5s]
Clairement. Calmement. Sans s'excuser.
[pause 6s]
Puis... silence.
[pause 8s]
Celui qui parle en premier après avoir annoncé le prix... perd.
[pause 10s]

Inspirez profondément...
[pause 5s]
Bloquez...
[pause 5s]
Relâchez...
[pause 8s]

Une dernière chose.
[pause 6s]

Arrêtez de vendre des séances à l'unité.
[pause 6s]
C'est le modèle qui épuise le plus vite.
[pause 5s]
Les clients n'ont pas de continuité.
[pause 5s]
Vous n'avez pas de revenu prévisible.
[pause 5s]
La transformation est partielle. Tout le monde y perd.
[pause 10s]

Construisez un programme.
[pause 6s]
La transformation est complète.
[pause 5s]
Vos revenus sont prévisibles.
[pause 5s]
La valeur perçue est supérieure.
[pause 8s]

Et progressivement — construisez trois niveaux de revenus.
[pause 6s]
Les revenus actifs : vos séances et programmes.
[pause 5s]
Les revenus semi-passifs : ateliers, formations en groupe.
[pause 5s]
Les revenus passifs : audios guidés vendus, programme en ligne.
[pause 8s]

Un praticien qui a les trois niveaux... est libre.
[pause 6s]
Véritablement libre.
[pause 10s]

Notez ce qui vient de se passer en vous à l'écoute de ce module.
[pause 18s]

Quel est le changement le plus urgent à faire dans votre pratique financière ?
[pause 18s]

Quelle croyance devez-vous quitter pour avancer vers la dignité que vous méritez ?
[pause 18s]

Notez.
[pause 5s]
La liberté commence dans votre rapport à l'argent.
[pause 5s]
Et l'argent n'est que de la valeur rendue visible.
[pause 10s]
SCRIPT,

        // ─────────────────────────────────────────────────────────
        // MENTOR — Module 01 — L'Identité du Mentor — cible : 18–20 min
        // ─────────────────────────────────────────────────────────
        'mentor-01-identite-du-mentor' => <<<'SCRIPT'
Bienvenue dans la Formation Mentor.
[pause 6s]

Vous êtes ici parce que quelque chose en vous sait.
[pause 5s]
Sait que vous avez quelque chose à transmettre.
[pause 5s]
Une expérience. Une traversée. Une sagesse gagnée au prix fort.
[pause 8s]

Avant d'enseigner quoi que ce soit...
[pause 4s]
avant de guider qui que ce soit...
[pause 4s]
il y a une question fondatrice que vous devez avoir traversée vous-même.
[pause 8s]

Qui suis-je... moi qui ose accompagner ?
[pause 12s]

Installez-vous confortablement.
[pause 4s]
Fermez les yeux si vous le souhaitez.
[pause 4s]

Inspirez profondément...
[pause 5s]
Bloquez...
[pause 5s]
Relâchez...
[pause 5s]
Encore une fois.
[pause 3s]
Inspirez profondément...
[pause 5s]
Bloquez...
[pause 5s]
Relâchez...
[pause 5s]

Laissez votre corps trouver son appui naturel.
[pause 6s]

Ce module porte un titre simple : L'Identité du Mentor.
[pause 5s]
Mais ne vous y trompez pas.
[pause 4s]
C'est probablement le module le plus exigeant de cette formation.
[pause 6s]

Parce qu'il ne vous demande pas d'apprendre quelque chose de nouveau.
[pause 5s]
Il vous demande de regarder ce qui est déjà là.
[pause 5s]
Et de ne pas le fuir.
[pause 10s]

Il y a une vérité que tout mentor doit intégrer dès le départ.
[pause 5s]

Vous ne pouvez pas accompagner quelqu'un plus loin que vous-même.
[pause 8s]

Relisez cette phrase mentalement.
[pause 5s]
Vous ne pouvez pas accompagner quelqu'un plus loin que vous-même.
[pause 10s]

Cela veut dire que votre profondeur... est la profondeur de ce que vous pouvez offrir.
[pause 6s]
Votre clarté... est la clarté que vous pouvez transmettre.
[pause 6s]
Votre paix... est la paix que vous pouvez rayonner.
[pause 10s]

Alors la question n'est pas : "suis-je assez qualifié ?"
[pause 5s]
La vraie question est : "est-ce que je me connais suffisamment pour savoir ce que j'ai à donner ?"
[pause 12s]

Parlons de vos valeurs.
[pause 6s]

Vos valeurs fondatrices ne sont pas des idées que vous admirez.
[pause 5s]
Ce sont des lignes que vous ne franchissez pas.
[pause 5s]
Même sous pression. Même quand c'est coûteux.
[pause 8s]

Pensez à un moment dans votre vie où vous avez ressenti une colère profonde.
[pause 6s]
Pas une petite irritation... une colère qui venait de loin.
[pause 6s]
Qu'est ce qui avait été bafoué ce jour-là ?
[pause 10s]

Cette réponse... c'est une valeur.
[pause 5s]
La colère est souvent la gardienne de ce qui nous est sacré.
[pause 8s]

Maintenant, pensez à un moment de joie profonde.
[pause 5s]
Un moment où vous vous êtes dit : "c'est pour ça que je suis là."
[pause 8s]
Qu'est-ce qui était présent dans ce moment ?
[pause 10s]

Cette réponse aussi... c'est une valeur.
[pause 8s]

Prenons maintenant un souffle ensemble.
[pause 3s]
Inspirez profondément...
[pause 5s]
Bloquez...
[pause 5s]
Relâchez...
[pause 5s]

Maintenant je vous invite à une méditation.
[pause 5s]
Une méditation de l'identité profonde.
[pause 5s]

Posez vos mains sur vos genoux, paumes vers le ciel.
[pause 5s]
C'est le geste de la réception.
[pause 5s]
Vous n'allez pas chercher quelque chose.
[pause 4s]
Vous allez simplement accueillir ce qui est déjà là.
[pause 10s]

Je vais vous poser une question.
[pause 4s]
Ne cherchez pas la bonne réponse. Il n'y en a pas.
[pause 4s]
Laissez simplement quelque chose remonter du fond de vous.
[pause 8s]

Qui êtes-vous... quand personne ne regarde ?
[pause 15s]

Pas le rôle que vous jouez au travail.
[pause 5s]
Pas la version de vous que vos proches connaissent.
[pause 5s]
Pas celle que vous aimeriez montrer.
[pause 6s]
Qui êtes-vous... vraiment... au fond ?
[pause 15s]

Restez avec cette question.
[pause 5s]
Sans chercher à la résoudre.
[pause 5s]
Juste... l'habiter.
[pause 12s]

Maintenant une deuxième question.
[pause 5s]

Qu'est-ce que vous avez traversé... que personne d'autre ne peut prétendre avoir traversé de la même manière que vous ?
[pause 12s]

Une épreuve. Un effondrement. Une période de doute profond.
[pause 6s]
Ou peut-être une victoire silencieuse dont personne n'a su l'ampleur.
[pause 8s]

Cette traversée... c'est votre matière première de mentor.
[pause 6s]

Ce n'est pas vos diplômes qui vous qualifient.
[pause 5s]
Ce n'est pas le nombre d'années d'expérience.
[pause 5s]
C'est ce que vous avez vécu... intégré... transformé en sagesse.
[pause 10s]

Inspirez doucement...
[pause 5s]
Et en expirant... laissez partir le besoin de prouver quoi que ce soit.
[pause 10s]

Vous n'avez rien à prouver ici.
[pause 6s]
Vous avez seulement à vous connaître.
[pause 6s]
Et à transmettre ce que vous connaissez vraiment.
[pause 12s]

Il y a un verset qui traverse toute cette formation.
[pause 5s]
Marc... chapitre dix... versets quarante-trois à quarante-cinq.
[pause 5s]

"Celui qui voudra devenir grand parmi vous sera votre serviteur."
[pause 8s]

"Et celui qui voudra être le premier sera l'esclave de tous."
[pause 8s]

"Car le Fils de l'homme n'est pas venu pour être servi... mais pour servir."
[pause 12s]

Ce verset dit quelque chose de précis.
[pause 5s]
La grandeur n'est pas dans la position.
[pause 5s]
Elle est dans le service.
[pause 8s]

Et le mentor... le vrai mentor...
[pause 4s]
n'accompagne pas pour être admiré.
[pause 4s]
Il accompagne parce qu'il a quelque chose de précieux à transmettre.
[pause 6s]
Et parce qu'il sait que quelqu'un en a besoin.
[pause 10s]

Prenons un dernier souffle ensemble.
[pause 3s]
Inspirez profondément...
[pause 5s]
Bloquez...
[pause 5s]
Relâchez...
[pause 5s]

Avant de terminer cette méditation...
[pause 4s]
posez cette dernière question à votre coeur.
[pause 5s]

Quel mentore... quel guide... auriez-vous eu besoin d'être pour vous... il y a dix ans ?
[pause 12s]

Cette personne... c'est peut-être le mentor que vous êtes en train de devenir.
[pause 8s]

Pour quelqu'un qui vit aujourd'hui ce que vous avez traversé.
[pause 8s]

Prenez le temps de noter ce qui est venu pendant cette méditation.
[pause 5s]
Sans censure. Sans correction.
[pause 5s]
Ce qui vient en premier est souvent le plus vrai.
[pause 10s]

À tout de suite pour la suite du module.
[pause 5s]
SCRIPT,

        // ─────────────────────────────────────────────────────────
        // MENTOR — Module 02 — La Posture du Serviteur — cible : 18–20 min
        // ─────────────────────────────────────────────────────────
        'mentor-02-posture-du-serviteur' => <<<'SCRIPT'
Installez-vous.
[pause 5s]

Module deux. La Posture du Serviteur.
[pause 6s]

Trois souffles d'abord. 5-5-5.
[pause 5s]
Inspiration... 5... 4... 3... 2... 1...
[pause 6s]
Rétention... 5... 4... 3... 2... 1...
[pause 6s]
Expiration... 5... 4... 3... 2... 1...
[pause 10s]

Il y a un paradoxe au coeur du leadership.
[pause 6s]

Le monde croit que commander, c'est être grand.
[pause 5s]
Que l'autorité vient du rang.
[pause 5s]
Que celui qui parle le plus fort a le plus de pouvoir.
[pause 8s]

Le mentor sait le contraire.
[pause 6s]

"Celui qui voudra devenir grand parmi vous sera votre serviteur."
[pause 8s]

Marc dix... verset quarante-trois.
[pause 5s]
Ces mots ont deux mille ans.
[pause 5s]
Et ils restent les plus perturbants... les plus pertinents... sur ce qu'est le vrai leadership.
[pause 10s]

Ce module vous demande de choisir votre posture.
[pause 5s]
Consciemment. Délibérément.
[pause 5s]
Pas celle que votre ego veut adopter.
[pause 5s]
Celle qui sert vraiment les personnes que vous accompagnez.
[pause 10s]

Il y a trois postures possibles.
[pause 6s]

La première... le formateur-autorité.
[pause 5s]
Il sait. Il enseigne. Il évalue.
[pause 5s]
La relation est verticale. L'autre apprend en dessous.
[pause 6s]
Ce n'est pas mauvais en soi.
[pause 4s]
Mais le résultat sur le long terme... c'est la dépendance.
[pause 8s]

La deuxième... le coach-expert.
[pause 5s]
Il guide. Il questionne. Il structure le passage à l'action.
[pause 5s]
La relation est plus horizontale. Plus professionnelle.
[pause 6s]
Le résultat... la performance.
[pause 8s]

La troisième... le mentor-serviteur.
[pause 5s]
Il précède. Il protège. Il libère.
[pause 6s]
La relation est de vie. Elle traverse les années.
[pause 6s]
Le résultat... l'autonomie durable.
[pause 8s]

L'autre devient capable de se passer de vous.
[pause 5s]
Et c'est exactement ça, la victoire.
[pause 10s]

Prenez un souffle.
[pause 8s]

Il y a une question que le mentor-serviteur se pose avant chaque échange.
[pause 6s]

Est-ce que cette interaction le rapproche de moi... ou de lui-même ?
[pause 12s]

Si la réponse est "de moi"...
[pause 4s]
vous êtes en train de construire une dépendance.
[pause 5s]
Pas un mentore. Pas une transformation.
[pause 5s]
Une dépendance.
[pause 8s]

Soyons honnêtes maintenant.
[pause 5s]

Il y a quatre pièges dans lesquels le mentor tombe.
[pause 5s]
Pas par malveillance. Souvent par bonne intention.
[pause 6s]
Mais les conséquences sont les mêmes.
[pause 8s]

Le premier piège : le besoin de validation.
[pause 5s]
Vous accompagnez pour être admiré.
[pause 6s]
Reconnaissez-vous ce moment où vous cherchez l'approbation dans les yeux de vos accompagnés ?
[pause 8s]

Le deuxième piège : le contrôle déguisé en aide.
[pause 5s]
Vous guidez... mais vers là où vous voulez aller.
[pause 5s]
Vous êtes déçu quand ils ne suivent pas vos conseils.
[pause 8s]

Le troisième piège : l'urgence de réparer.
[pause 5s]
Vous voulez résoudre trop vite.
[pause 5s]
Vous interrompez pour donner des solutions avant d'avoir vraiment compris.
[pause 8s]

Le quatrième piège : l'empreinte excessive.
[pause 5s]
Vous voulez qu'ils vous ressemblent.
[pause 5s]
Vous vous sentez menacé quand ils développent leur propre style.
[pause 10s]

L'antidote à ces quatre pièges... c'est toujours le même.
[pause 5s]
Revenir au verset. Servir... pas briller.
[pause 10s]

Prenons maintenant la méditation de ce module.
[pause 5s]

Trois souffles 5-5-5.
[pause 15s]

Visualisez quelqu'un que vous avez accompagné... ou que vous allez accompagner.
[pause 6s]
Voyez son visage.
[pause 5s]
Sentez sa présence.
[pause 5s]

Maintenant... observez votre intention profonde envers cette personne.
[pause 6s]

Est-ce que vous êtes là pour elle... ou pour vous ?
[pause 12s]

Sans jugement.
[pause 5s]
Ce n'est ni bien ni mal.
[pause 5s]
C'est juste... l'honnêteté.
[pause 10s]

Si vous sentez une part d'ego... respirez avec elle.
[pause 6s]
Reconnaissez-la. Remerciez-la de vous avoir protégé jusqu'ici.
[pause 6s]
Et demandez-lui de s'effacer pour laisser la place au service.
[pause 10s]

Posez cette question dans votre coeur.
[pause 5s]

Si personne ne le savait jamais... si aucun regard extérieur ne pouvait vous voir...
[pause 6s]
est-ce que vous feriez quand même ce que vous faites ?
[pause 15s]

Restez dans cette question.
[pause 5s]
Sans chercher à répondre rapidement.
[pause 5s]
Laissez la réponse vraie remonter.
[pause 15s]

Si la réponse est oui... vous avez trouvé votre posture de serviteur.
[pause 6s]

Si la réponse hésite... c'est parfait aussi.
[pause 5s]
C'est une invitation à creuser.
[pause 5s]
À nettoyer ce qui reste encore mélangé.
[pause 8s]

La posture du serviteur n'est pas un état qu'on atteint une fois pour toutes.
[pause 5s]
C'est un choix qu'on refait... chaque jour... avant chaque session.
[pause 10s]

Inspirez.
[pause 5s]
En expirant... dites-vous intérieurement : je suis là pour servir.
[pause 10s]

Inspirez.
[pause 5s]
En expirant... je suis là pour libérer... pas pour retenir.
[pause 10s]

Inspirez.
[pause 5s]
En expirant... ma grandeur est dans mon service.
[pause 12s]

Notez ce qui est venu pendant cette méditation.
[pause 5s]
SCRIPT,

        // ─────────────────────────────────────────────────────────
        // MENTOR — Module 03 — L'Écoute Active — cible : 18–20 min
        // ─────────────────────────────────────────────────────────
        'mentor-03-ecoute-active' => <<<'SCRIPT'
Installez-vous.
[pause 5s]

Module trois. L'Écoute Active.
[pause 5s]

Avant de commencer...
[pause 3s]
observez combien de pensées traversent votre esprit en ce moment.
[pause 8s]

Une liste à faire. Un message à envoyer. Une préoccupation qui revient.
[pause 6s]
C'est normal.
[pause 4s]
C'est exactement pourquoi ce module existe.
[pause 8s]

Trois souffles ensemble.
[pause 5s]
Inspiration lente... rétention douce... expiration profonde.
[pause 18s]

La plupart des gens n'écoutent pas.
[pause 6s]
Ils attendent leur tour pour parler.
[pause 6s]
Ils construisent leur réponse pendant que l'autre parle encore.
[pause 6s]
Ils filtrent ce qu'ils entendent à travers leur propre vécu.
[pause 8s]

Ce n'est pas de la mauvaise volonté.
[pause 4s]
C'est simplement que personne ne nous a appris à écouter vraiment.
[pause 8s]

L'écoute active n'est pas une technique.
[pause 5s]
C'est un état.
[pause 5s]
Un état de présence totale.
[pause 5s]
Où l'autre sent — pour la première fois peut-être — qu'il est vraiment compris.
[pause 10s]

Il y a cinq niveaux d'écoute.
[pause 5s]

Niveau un : l'écoute superficielle.
[pause 4s]
Vous entendez les mots. Votre esprit est ailleurs.
[pause 6s]

Niveau deux : l'écoute partielle.
[pause 4s]
Vous captez les grandes lignes. Vous préparez votre réponse en parallèle.
[pause 6s]

Niveau trois : l'écoute active.
[pause 4s]
Vous suivez le fil. Vous posez des questions de clarification.
[pause 6s]

Niveau quatre : l'écoute empathique.
[pause 4s]
Vous ressentez l'émotion derrière les mots. Vous reflétiez avant de répondre.
[pause 6s]

Niveau cinq : l'écoute générative.
[pause 5s]
Vous écoutez ce qui n'est pas encore dit.
[pause 5s]
Ce que la personne cherche à formuler.
[pause 5s]
Vous créez l'espace pour que ça émerge.
[pause 10s]

Le mentor vise le niveau cinq.
[pause 8s]

Où êtes-vous habituellement ?
[pause 10s]

Soyez honnête. Sans vous juger.
[pause 8s]

La plupart des mentors sincères oscillent entre trois et quatre.
[pause 5s]
Le niveau cinq s'apprend. Il se pratique.
[pause 5s]
Il commence par... le silence.
[pause 10s]

Parlons un moment des questions.
[pause 5s]

Une question fermée ferme.
[pause 4s]
Une question ouverte ouvre.
[pause 4s]
Une question puissante... transforme.
[pause 8s]

La différence entre une question orientée et une question puissante...
[pause 5s]
c'est l'intention derrière elle.
[pause 6s]

Une question orientée mène l'autre vers là où vous voulez aller.
[pause 5s]
"Ne penses-tu pas que tu devrais..."
[pause 4s]
"Et si tu essayais plutôt..."
[pause 4s]
"Il me semble que la solution est..."
[pause 6s]

Une question puissante ouvre sans orienter.
[pause 5s]
"Qu'est-ce qui se passe vraiment ?"
[pause 5s]
"Qu'est-ce qui ferait que ce soit parfait ?"
[pause 5s]
"Si tu savais déjà la réponse... que serait-elle ?"
[pause 8s]

Et après une question puissante...
[pause 4s]
il y a la règle d'or.
[pause 5s]

Taisez-vous.
[pause 6s]
Complètement.
[pause 6s]
Comptez jusqu'à dix si nécessaire.
[pause 8s]

Le silence après une question puissante...
[pause 5s]
c'est l'espace dans lequel la transformation se produit.
[pause 5s]
Ne le remplissez pas.
[pause 8s]

Maintenant la méditation de ce module.
[pause 5s]

La méditation du silence intérieur.
[pause 6s]

Installez-vous encore plus confortablement.
[pause 5s]
Fermez les yeux.
[pause 4s]

Pendant les dix prochaines minutes...
[pause 4s]
vous n'allez rien faire que observer vos propres pensées.
[pause 5s]
Sans les suivre. Sans les combattre.
[pause 5s]
Juste... les observer passer.
[pause 8s]

Quand une pensée vient...
[pause 4s]
notez-la mentalement : "pensée".
[pause 4s]
Et revenez au souffle.
[pause 8s]

C'est tout.
[pause 5s]
Rien d'autre.
[pause 6s]

Pourquoi cette pratique pour un mentor ?
[pause 5s]

Parce qu'un mentor qui ne sait pas faire le silence intérieur...
[pause 5s]
ne peut pas créer le silence accueillant pour l'autre.
[pause 6s]

Vous ne pouvez offrir aux autres que ce que vous avez d'abord cultivé en vous.
[pause 10s]

Commençons.
[pause 5s]

Inspiration douce...
[pause 4s]
Expiration lente...
[pause 5s]
Simple présence.
[pause 180s]

Vous revenez doucement.
[pause 6s]

Remarquez comment vous vous sentez après ce moment de silence.
[pause 6s]

Un peu plus léger peut-être.
[pause 4s]
Un peu plus disponible.
[pause 4s]
Un peu plus présent.
[pause 8s]

C'est cette qualité de présence que vous allez apporter à vos accompagnés.
[pause 6s]

Ils ne le nommeront pas.
[pause 4s]
Mais ils le sentiront.
[pause 5s]
Ils sentiront que vous êtes vraiment là.
[pause 5s]
Et c'est ce qui fait la différence.
[pause 10s]

Notez ce qui est venu pendant cette méditation.
[pause 5s]
SCRIPT,

        // ─────────────────────────────────────────────────────────
        // MENTOR — Module 04 — La Transmission Vivante — cible : 18–20 min
        // ─────────────────────────────────────────────────────────
        'mentor-04-transmission-vivante' => <<<'SCRIPT'
Installez-vous.
[pause 5s]

Module quatre. La Transmission Vivante.
[pause 6s]

Trois souffles 5-5-5.
[pause 18s]

Il y a une différence fondamentale entre quelqu'un qui enseigne... et quelqu'un qui transmet.
[pause 8s]

L'enseignant transmet de l'information.
[pause 5s]
Le mentor transmet une vie.
[pause 8s]

Un discours instruit.
[pause 4s]
Une vie vécue inspire.
[pause 8s]

Pensez aux personnes qui vous ont le plus profondément influencé dans votre vie.
[pause 6s]

Était-ce par ce qu'elles vous ont dit ?
[pause 5s]
Ou par ce qu'elles étaient ?
[pause 5s]
Par la façon dont elles vivaient ce qu'elles croyaient ?
[pause 10s]

La transmission vivante... c'est ça.
[pause 5s]
Quand ce que vous dites et ce que vous êtes sont alignés.
[pause 6s]
Quand il n'y a aucun écart entre le mentor devant le groupe...
[pause 4s]
et l'être humain à vingt-trois heures dans sa cuisine.
[pause 8s]

Ce n'est pas de la perfection qu'on vous demande.
[pause 5s]
C'est de la cohérence.
[pause 8s]

Gandhi disait : soyez le changement que vous voulez voir dans le monde.
[pause 6s]
Le mentor dit : je suis déjà en train de vivre ce que j'enseigne.
[pause 8s]

Une des formes les plus puissantes de transmission vivante...
[pause 5s]
c'est l'histoire vraie.
[pause 6s]

Pas une anecdote qui impressionne.
[pause 5s]
Pas une success story soigneusement polie.
[pause 5s]
Une histoire vraie qui libère.
[pause 8s]

Il y a une structure en cinq moments pour raconter ce qui libère.
[pause 6s]

Premier moment : le basculement.
[pause 5s]
"Il y a X années... j'étais..."
[pause 5s]
Poser le contexte. Puis le moment où quelque chose a changé.
[pause 8s]

Deuxième moment : la descente.
[pause 5s]
"Et puis... quelque chose s'est effondré."
[pause 5s]
Être honnête sur ce que ça a coûté.
[pause 8s]

Troisième moment : la traversée.
[pause 5s]
"J'ai dû faire face à..."
[pause 5s]
Ce que vous avez dû traverser. Pas la version heroïque. La version vraie.
[pause 8s]

Quatrième moment : l'apprentissage.
[pause 5s]
"Ce que j'ai compris à ce moment-là..."
[pause 5s]
La sagesse que vous n'auriez pas pu avoir autrement.
[pause 8s]

Cinquième moment : le pont.
[pause 5s]
"Et c'est exactement pourquoi je vous parle de ça aujourd'hui."
[pause 6s]
Le lien entre votre vécu et ce que vit votre accompagné.
[pause 10s]

La règle de l'histoire qui libère.
[pause 5s]
Ne racontez pas une histoire pour briller.
[pause 5s]
Racontez pour que l'autre se reconnaisse.
[pause 8s]

Prenons maintenant la méditation de ce module.
[pause 5s]

La méditation de l'alignement intérieur.
[pause 6s]

Installez-vous. Fermez les yeux.
[pause 5s]

Trois souffles.
[pause 15s]

Visualisez-vous en train d'enseigner quelque chose qui vous tient à coeur.
[pause 6s]
Un sujet sur lequel vous avez réellement quelque chose à dire.
[pause 6s]

Ressentez-vous de l'alignement quand vous vous imaginez le transmettre ?
[pause 8s]
Ou ressentez-vous une forme d'imposteur ?
[pause 8s]

Où dans votre corps vous sentez-vous le plus vrai dans cette projection ?
[pause 8s]
Où sentez-vous un écart ?
[pause 8s]

Respirez à l'endroit de l'écart.
[pause 5s]
Pas pour le résoudre.
[pause 4s]
Pour l'honorer.
[pause 6s]

Cet écart dit : "je grandis encore dans ce domaine."
[pause 5s]
Et c'est précieux.
[pause 5s]
Parce que vous n'enseigner pas depuis un sommet atteint.
[pause 5s]
Vous enseignez depuis le chemin.
[pause 10s]

Répétez intérieurement... ou à voix basse si vous le souhaitez.
[pause 5s]

"Je suis en chemin."
[pause 5s]
"Et mon chemin m'équipe."
[pause 5s]
"Je transmets ce que je vis... pas seulement ce que je sais."
[pause 12s]

Prenez un dernier souffle profond.
[pause 5s]
Inspiration...
[pause 5s]
Rétention...
[pause 5s]
Expiration lente.
[pause 10s]

Notez l'histoire fondatrice qui est venue pendant cette méditation.
[pause 5s]
Elle pourrait bien devenir la clé de voûte de votre transmission.
[pause 8s]
SCRIPT,

        // ─────────────────────────────────────────────────────────
        // MENTOR — Module 05 — Les Résistances — cible : 18–20 min
        // ─────────────────────────────────────────────────────────
        'mentor-05-les-resistances' => <<<'SCRIPT'
Installez-vous.
[pause 5s]

Module cinq. Les Résistances.
[pause 6s]

Trois souffles 5-5-5.
[pause 18s]

Dans chaque accompagnement... dans chaque groupe... dans chaque relation de mentorat...
[pause 6s]
vous rencontrerez des résistances.
[pause 6s]

Celles de vos accompagnés.
[pause 4s]
Et aussi... les vôtres.
[pause 8s]

Le mentor non-préparé vit les résistances comme des échecs.
[pause 6s]
"Il ne veut pas changer."
[pause 4s]
"Elle n'est pas prête."
[pause 4s]
"Ils ne m'écoutent pas."
[pause 6s]

Le mentor expérimenté les lit comme des messages.
[pause 8s]

Une résistance dit toujours quelque chose.
[pause 5s]

"J'ai peur."
[pause 4s]
"Je n'y crois pas encore."
[pause 4s]
"J'ai déjà été déçu."
[pause 4s]
"Ce n'est pas le bon moment."
[pause 4s]
"Je ne me sens pas capable."
[pause 8s]

Votre travail n'est pas de supprimer la résistance.
[pause 5s]
C'est de l'entendre.
[pause 8s]

Il y a cinq types de résistances que vous rencontrerez.
[pause 6s]

La première : la résistance par peur.
[pause 5s]
"Et si ça ne marchait pas ?"
[pause 5s]
Signe : questionnement excessif, procrastination, besoin de garanties.
[pause 8s]

La deuxième : la résistance par blessure passée.
[pause 5s]
"J'ai déjà essayé, ça n'a pas marché."
[pause 5s]
Signe : cynisme, fermeture, protection anticipée.
[pause 8s]

La troisième : la résistance par croyance limitante.
[pause 5s]
"Je ne suis pas fait pour ça."
[pause 5s]
Signe : minimisation systématique de soi, comparaison aux autres.
[pause 8s]

La quatrième : la résistance par déni.
[pause 5s]
"Je n'ai pas vraiment de problème."
[pause 5s]
Signe : changement de sujet, rationalisation excessive.
[pause 8s]

La cinquième : la résistance par timing.
[pause 5s]
"Pas maintenant... plus tard."
[pause 5s]
Signe : report répété. Parfois légitime... souvent un évitement.
[pause 10s]

Pour chacun de ces types...
[pause 4s]
il y a un protocole de transformation en cinq étapes.
[pause 6s]

Étape un : accueillir sans corriger.
[pause 5s]
"Je t'entends. Cette résistance est là. C'est valide."
[pause 6s]

Étape deux : nommer sans diagnostiquer.
[pause 5s]
"Je perçois quelque chose qui ressemble à de la peur. Est-ce que ça résonne ?"
[pause 6s]

Étape trois : explorer avec curiosité.
[pause 5s]
"Qu'est-ce qui se passerait si cette peur avait raison ? Et si elle avait tort ?"
[pause 6s]

Étape quatre : chercher la ressource dans la résistance.
[pause 5s]
"Qu'est-ce que cette résistance protège ? Qu'est-ce qui a besoin d'être respecté ici ?"
[pause 6s]

Étape cinq : proposer un tout petit pas.
[pause 5s]
"Pas tout. Pas maintenant. Juste un pour cent de mouvement."
[pause 8s]

Maintenant... je vous invite à tourner le regard vers vous.
[pause 6s]

Quelle est la résistance principale que vous avez en ce moment ?
[pause 8s]
Pas celle de vos accompagnés.
[pause 5s]
La vôtre.
[pause 8s]

Entrons dans la méditation de ce module.
[pause 5s]

La méditation des nœuds intérieurs.
[pause 6s]

Fermez les yeux. Trois souffles lents.
[pause 18s]

Pensez à une résistance que vous avez en ce moment dans votre vie.
[pause 6s]
Une chose que vous repoussez. Que vous évitez d'affronter.
[pause 6s]

Localisez-la dans votre corps.
[pause 5s]
Peut-être dans la poitrine ? Dans le ventre ? Dans la gorge ?
[pause 8s]

Donnez-lui une forme.
[pause 5s]
Une couleur.
[pause 5s]
Une texture.
[pause 8s]

Sans chercher à la résoudre.
[pause 5s]
Juste... la rencontrer.
[pause 8s]

Maintenant posez-lui une question.
[pause 5s]

"Qu'est-ce que tu protèges ?"
[pause 15s]

Écoutez.
[pause 5s]
Sans défense.
[pause 5s]
Sans chercher à corriger.
[pause 10s]

Ce que vous entendez là...
[pause 4s]
c'est une information précieuse.
[pause 5s]
C'est ce que vos accompagnés ressentent aussi quand ils résistent.
[pause 6s]

Toute résistance que vous avez traversée vous équipe pour accompagner celle de l'autre.
[pause 8s]

Respirez avec cette résistance.
[pause 6s]
Pas pour la faire partir.
[pause 4s]
Pour la remercier.
[pause 5s]
Elle a fait son travail de protection.
[pause 5s]
Et maintenant... vous pouvez aller plus loin.
[pause 12s]

Prenez un dernier souffle profond.
[pause 5s]
Et en expirant... laissez sortir ce qui n'a plus besoin d'être porté.
[pause 12s]

Notez ce qui est venu.
[pause 5s]
SCRIPT,

        // ─────────────────────────────────────────────────────────
        // MENTOR — Module 06 — L'Énergie du Mentor — cible : 18–20 min
        // ─────────────────────────────────────────────────────────
        'mentor-06-energie-du-mentor' => <<<'SCRIPT'
Installez-vous.
[pause 5s]

Module six. L'Énergie du Mentor.
[pause 6s]

Trois souffles.
[pause 18s]

Voici une vérité que peu de mentors veulent entendre.
[pause 6s]

Un mentor épuisé n'accompagne plus.
[pause 5s]
Il survit.
[pause 6s]

Et dans la survie...
[pause 4s]
il prend inconsciemment de l'énergie à ses accompagnés...
[pause 4s]
au lieu d'en donner.
[pause 8s]

La gestion de votre énergie n'est pas une question de confort.
[pause 5s]
C'est une question d'éthique.
[pause 8s]

Vous ne pouvez pas donner ce que vous n'avez pas.
[pause 6s]

Un praticien qui ne prend pas soin de lui transmet son épuisement.
[pause 5s]
Sa frustration. Son manque.
[pause 5s]

Un praticien qui rayonne transmet sa vitalité.
[pause 5s]
Sa paix. Sa présence.
[pause 8s]

Vos accompagnés ne l'analyseront pas.
[pause 5s]
Mais ils le sentiront.
[pause 5s]
Dans votre voix. Dans votre regard. Dans la qualité de votre silence.
[pause 10s]

Il y a quatre sources d'énergie que vous devez alimenter consciemment.
[pause 6s]

La première : l'énergie physique.
[pause 5s]
Sommeil suffisant. Mouvement régulier. Nutrition consciente. Pause Souffle quotidienne.
[pause 6s]
Question diagnostic : votre corps est-il un allié... ou une charge en ce moment ?
[pause 8s]

La deuxième : l'énergie émotionnelle.
[pause 5s]
Le traitement des émotions non résolues.
[pause 4s]
Les relations nourrissantes versus vampirisantes.
[pause 5s]
Question diagnostic : avez-vous des conversations qui vous alourdissent... ou des conversations qui vous allègent ?
[pause 8s]

La troisième : l'énergie mentale.
[pause 5s]
La clarté d'intention. L'absence de dissonance entre ce que vous pensez et ce que vous faites.
[pause 6s]
Question diagnostic : avez-vous des pensées intrusives récurrentes ? Des décisions non prises qui occupent de l'espace mental ?
[pause 8s]

La quatrième : l'énergie spirituelle.
[pause 5s]
La connexion à votre sens profond.
[pause 4s]
Le sentiment que votre vie a une direction.
[pause 5s]
Question diagnostic : vous levez-vous le matin avec un sentiment de mission... ou d'obligation ?
[pause 10s]

Il y a un rituel simple que je vous propose.
[pause 5s]
Le rituel quotidien du mentor.
[pause 5s]
Quinze minutes le matin. Deux minutes avant chaque session. Dix minutes le soir.
[pause 8s]

Le matin.
[pause 4s]
Cinq minutes de Pause Souffle 5-5-5.
[pause 4s]
Cinq minutes d'intention du jour de mentor : "aujourd'hui je sers en..."
[pause 4s]
Cinq minutes de lecture ou d'écoute d'une phrase qui vous inspire.
[pause 8s]

Avant chaque session.
[pause 4s]
Check-in corporel. État émotionnel. Intention centrée sur l'autre.
[pause 6s]

Le soir.
[pause 4s]
Qu'est-ce que j'ai bien servi aujourd'hui ?
[pause 4s]
Où est-ce que je me suis laissé drainer... et pourquoi ?
[pause 4s]
Qu'est-ce que j'emporte de positif de cette journée ?
[pause 10s]

Entrons dans la méditation de ce module.
[pause 5s]

La méditation de la fontaine intérieure.
[pause 6s]

Installez-vous. Fermez les yeux.
[pause 5s]

Trois souffles 5-5-5.
[pause 18s]

Imaginez une source lumineuse au centre de votre poitrine.
[pause 6s]

À chaque inspiration... elle grandit.
[pause 5s]
Chaude. Dorée. Apaisante.
[pause 5s]

À chaque expiration... elle rayonne vers l'extérieur.
[pause 6s]
En cercles concentriques.
[pause 5s]
Touchant tout ce qui vous entoure.
[pause 8s]

Inspirez. La fontaine grandit.
[pause 8s]
Expirez. Elle rayonne.
[pause 8s]

Maintenant visualisez vos quatre sources d'énergie se remplir.
[pause 5s]

D'abord votre corps.
[pause 4s]
Imaginez chaque cellule recevoir une lumière régénératrice.
[pause 6s]
Chaque muscle se détendre. Chaque articulation se libérer.
[pause 8s]

Maintenant vos émotions.
[pause 5s]
Imaginez toutes les tensions émotionnelles se dissoudre doucement.
[pause 5s]
Comme de la glace qui fond au soleil.
[pause 8s]

Votre mental.
[pause 5s]
Un espace qui se clarifie. Le bruit qui se tait.
[pause 5s]
Une clarté simple et apaisante.
[pause 8s]

Votre sens profond.
[pause 5s]
Reconnectez-vous à la raison pour laquelle vous avez choisi ce chemin.
[pause 6s]
Pas la raison intellectuelle.
[pause 4s]
La raison du coeur.
[pause 8s]

Restez dans cet état de plénitude.
[pause 5s]
Aussi longtemps que vous le souhaitez.
[pause 5s]

Répétez intérieurement.
[pause 5s]
"Je me nourris pour nourrir."
[pause 5s]
"Je me ressource pour ressourcer."
[pause 8s]

Prenez un dernier souffle.
[pause 5s]
Inspiration profonde...
[pause 5s]
Expirez en souriant doucement.
[pause 10s]

Notez sur votre carnet de mentor : quelle source d'énergie avez-vous le plus besoin de nourrir cette semaine ?
[pause 5s]
SCRIPT,

        // ─────────────────────────────────────────────────────────
        // MENTOR — Module 07 — Le Cadre Sacré — cible : 18–20 min
        // ─────────────────────────────────────────────────────────
        'mentor-07-cadre-sacre' => <<<'SCRIPT'
Installez-vous.
[pause 5s]

Module sept. Le Cadre Sacré.
[pause 6s]

Trois souffles ensemble.
[pause 18s]

Pensez à un endroit... une conversation... un moment...
[pause 5s]
où vous vous êtes senti pleinement en sécurité pour être vous-même.
[pause 8s]

Vraiment vous-même.
[pause 5s]
Sans calcul. Sans masque. Sans performance.
[pause 8s]

Comment vous sentiez-vous dans cet espace ?
[pause 8s]

C'est ce qu'un cadre sacré crée.
[pause 6s]

Un cadre sacré n'est pas un lieu.
[pause 5s]
C'est une qualité de présence.
[pause 5s]
C'est ce qui fait que quelqu'un entre dans une salle... ou dans une conversation...
[pause 5s]
et sent instinctivement : ici, je peux être moi-même.
[pause 10s]

Les gens passent des années sans jamais avoir cet espace.
[pause 6s]
Sans jamais avoir quelqu'un devant eux qui ne juge pas.
[pause 5s]
Qui ne cherche pas à en tirer quelque chose.
[pause 5s]
Qui est simplement... là.
[pause 8s]

Votre travail de mentor : créer cet espace. Le maintenir. Le défendre.
[pause 10s]

Il y a cinq éléments qui constituent un cadre sacré.
[pause 6s]

Le premier : la confidentialité totale.
[pause 5s]
Ce qui se partage dans le cadre ne sort pas du cadre.
[pause 5s]
C'est la condition première de la confiance.
[pause 6s]
Pas seulement comme règle affichée... mais comme engagement vécu.
[pause 8s]

Le deuxième : l'absence de jugement.
[pause 5s]
Ce n'est pas l'approbation de tout.
[pause 4s]
C'est l'accueil de tout.
[pause 5s]
"Je t'écoute sans te juger."
[pause 5s]
Et le vivre... dans chaque micro-réaction.
[pause 5s]
Même face à ce qui vous surprend.
[pause 8s]

Le troisième : la présence totale.
[pause 5s]
Téléphone rangé. Regard posé. Corps tourné. Esprit disponible.
[pause 5s]
Pas quatre-vingts pour cent de présence.
[pause 4s]
Cent pour cent.
[pause 8s]

Le quatrième : la permission d'être incomplet.
[pause 5s]
"Tu n'as pas à avoir les réponses ici. Tu as juste à être honnête."
[pause 5s]
Cette permission... pour beaucoup de personnes...
[pause 4s]
est la chose la plus libératrice qu'on leur ait jamais dite.
[pause 8s]

Le cinquième : la ritualisation de l'espace.
[pause 5s]
Une ouverture. Un souffle partagé. Un mot d'intention.
[pause 5s]
Le corps comprend que c'est différent.
[pause 5s]
Que ce qui va se passer ici est précieux.
[pause 10s]

Parlons aussi de ce qui brise le cadre.
[pause 6s]

Un commentaire non sollicité qui juge... même bien intentionné.
[pause 5s]
Une confidence partagée hors du groupe.
[pause 5s]
Un manque de présence perçu par les accompagnés.
[pause 5s]
Une surprise ou un malaise visible du mentor face à ce qui est partagé.
[pause 8s]

Ces violations arrivent.
[pause 5s]
Même aux meilleurs mentors.
[pause 5s]

La réponse n'est pas de fuir.
[pause 4s]
C'est de nommer avec sincérité.
[pause 5s]

"J'ai dit quelque chose qui a brisé la confiance. Je veux réparer. Voici comment."
[pause 8s]

La réparation honnête renforce souvent le cadre plus qu'il n'y avait eu de violation.
[pause 8s]

Entrons dans la méditation de ce module.
[pause 5s]

La méditation de l'espace d'accueil.
[pause 6s]

Fermez les yeux. Trois souffles 5-5-5.
[pause 18s]

Imaginez l'espace que vous allez créer pour ceux que vous accompagnez.
[pause 6s]

Pas la salle. Pas le décor.
[pause 5s]
La qualité de présence que vous apportez.
[pause 8s]

Visualisez quelqu'un qui entre dans cet espace.
[pause 5s]
Et qui se détend.
[pause 4s]
Qui baisse la garde.
[pause 4s]
Qui respire différemment.
[pause 6s]

Que ressentez-vous dans votre corps quand vous voyez cela ?
[pause 8s]

C'est votre raison d'être comme mentor.
[pause 6s]
Ce moment où l'autre retrouve de la sécurité.
[pause 6s]
Où il retrouve un espace pour être vrai.
[pause 8s]

Répétez intérieurement.
[pause 5s]
"Je suis cet espace."
[pause 5s]
"Je le porte en moi."
[pause 5s]
"Il commence par ma propre paix."
[pause 12s]

Prenez un dernier souffle.
[pause 8s]

Et revenez doucement.
[pause 5s]
SCRIPT,

        // ─────────────────────────────────────────────────────────
        // MENTOR — Module 08 — L'Art du Lâcher-Prise — cible : 18–20 min
        // ─────────────────────────────────────────────────────────
        'mentor-08-art-du-lacher-prise' => <<<'SCRIPT'
Installez-vous.
[pause 5s]

Module huit. L'Art du Lâcher-Prise.
[pause 6s]

Trois souffles 5-5-5.
[pause 18s]

Voici le paradoxe final du mentor.
[pause 6s]

Le mentor accomplit sa mission...
[pause 5s]
quand son accompagné n'a plus besoin de lui.
[pause 8s]

Laissez cette phrase résonner.
[pause 6s]

Plus votre travail est réussi...
[pause 5s]
plus ils s'éloignent.
[pause 5s]
Et c'est exactement ça... la victoire.
[pause 10s]

Un parent réussi lève des enfants autonomes.
[pause 5s]
Un thérapeute réussi clôture sa relation thérapeutique.
[pause 5s]
Un mentor réussi crée d'autres mentors.
[pause 8s]

Mais notre ego... notre besoin de nous sentir utile...
[pause 5s]
peut résister à cette vérité.
[pause 6s]

Il y a trois formes d'attachement chez le mentor.
[pause 6s]

La première : l'attachement au rôle.
[pause 5s]
"J'ai besoin qu'ils aient besoin de moi."
[pause 5s]
Signe : un malaise quand un accompagné progresse vite et devient autonome.
[pause 8s]

La deuxième : l'attachement aux résultats.
[pause 5s]
"Leur succès prouve ma valeur."
[pause 5s]
Signe : une déception personnelle quand quelqu'un abandonne... même si c'est son choix.
[pause 8s]

La troisième : l'attachement affectif.
[pause 5s]
La relation dépasse le cadre du mentorat.
[pause 5s]
Signe : difficulté à maintenir les limites professionnelles.
[pause 8s]

Reconnaître son attachement n'est pas une honte.
[pause 5s]
C'est le premier acte du lâcher-prise.
[pause 8s]

Il y a trois pratiques qui aident.
[pause 6s]

La première : la clôture rituelle.
[pause 5s]
À la fin de chaque session : "je te confie à toi-même."
[pause 5s]
Symboliquement remettre la responsabilité à l'autre.
[pause 5s]
Couper l'énergie du contrôle.
[pause 8s]

La deuxième : la délégation à plus grand que soi.
[pause 5s]
"Ce chemin n'est pas le mien à porter.
[pause 4s]
Je fais ce que je peux... et je confie le reste."
[pause 8s]

La troisième : le bilan sans jugement.
[pause 5s]
Après chaque accompagnement terminé... bien ou mal.
[pause 5s]
"Qu'est-ce que j'ai appris ? Qu'est-ce que je lâche ?"
[pause 5s]
Un cahier de clôture. Deux pages. Et on tourne.
[pause 10s]

Entrons dans la méditation de ce module.
[pause 5s]

La méditation du détachement bienveillant.
[pause 6s]

Fermez les yeux. Trois souffles profonds.
[pause 18s]

Pensez à quelqu'un que vous accompagnez... ou que vous avez accompagné.
[pause 6s]

Ressentez si vous portez quelque chose pour eux...
[pause 5s]
qui leur appartient.
[pause 6s]

Une inquiétude à leur place. Une attente de résultat. Un espoir que vous n'avez pas exprimé.
[pause 8s]

Visualisez cette chose que vous portez.
[pause 5s]
Donnez-lui une forme.
[pause 5s]

Et maintenant... imaginez la leur remettre avec amour.
[pause 6s]

Pas avec froideur. Pas avec indifférence.
[pause 5s]
Avec amour.
[pause 6s]

"Ceci est à toi."
[pause 4s]
"Je te le rends."
[pause 4s]
"Je reste là si tu as besoin."
[pause 4s]
"Mais c'est toi qui portes ton chemin."
[pause 10s]

Ressentez le soulagement dans votre corps.
[pause 6s]

La légèreté du mentor qui ne porte pas ce qui ne lui appartient pas.
[pause 8s]

Répétez intérieurement.
[pause 5s]
"Je suis présent."
[pause 5s]
"Je ne suis pas responsable de leur chemin."
[pause 5s]
"Je suis là pour éclairer... pas pour porter."
[pause 12s]

Respirez avec cette légèreté.
[pause 6s]

Et revenez doucement.
[pause 8s]

Notez : quel accompagnement en cours vous demande de lâcher quelque chose ?
[pause 5s]
SCRIPT,

        // ─────────────────────────────────────────────────────────
        // MENTOR — Module 09 — Ma Signature de Mentor — cible : 20–22 min
        // ─────────────────────────────────────────────────────────
        'mentor-09-signature-de-mentor' => <<<'SCRIPT'
Installez-vous.
[pause 5s]

Module neuf. Ma Signature de Mentor.
[pause 6s]

Le dernier module.
[pause 6s]

Trois souffles profonds. Plus lents que d'habitude.
[pause 25s]

Vous avez traversé huit modules.
[pause 5s]

Vous avez exploré votre identité.
[pause 4s]
Vous avez choisi votre posture.
[pause 4s]
Vous avez approfondi votre écoute.
[pause 4s]
Vous avez aligné votre transmission.
[pause 4s]
Vous avez traversé les résistances.
[pause 4s]
Vous avez nourri votre énergie.
[pause 4s]
Vous avez créé un cadre sacré.
[pause 4s]
Vous avez appris à lâcher.
[pause 8s]

Ce module n'est pas un résumé.
[pause 5s]
C'est une synthèse vivante.
[pause 5s]

La question n'est plus : qu'est-ce qu'un bon mentor ?
[pause 5s]
Elle est : quel mentor unique es-tu, toi ?
[pause 10s]

Personne ne peut être vous.
[pause 6s]

Votre combinaison de blessures... de forces... de valeurs... de style...
[pause 5s]
est unique sur cette planète.
[pause 8s]

Ce que vous allez créer ne ressemblera à aucun autre mentor.
[pause 6s]
Et c'est exactement ce dont le monde a besoin.
[pause 10s]

Il y a cinq dimensions de votre signature de mentor.
[pause 6s]

La première : votre ton.
[pause 5s]
Êtes-vous direct ou doux ?
[pause 4s]
Provocateur ou enveloppant ?
[pause 4s]
Solennel ou joyeux ?
[pause 5s]
Ce n'est pas ce que vous choisissez de paraître.
[pause 4s]
C'est ce que vous êtes... quand vous êtes à l'aise.
[pause 8s]

La deuxième : votre approche.
[pause 5s]
Structurée : plan clair, étapes définies, outils concrets.
[pause 4s]
Ou intuitive : fluide, au feeling de la personne.
[pause 5s]
La plupart des mentors sont un mélange.
[pause 4s]
Mais il y en a une qui est dominante.
[pause 8s]

La troisième : votre force première.
[pause 5s]
Écoute. Présence. Clarté. Provocation bienveillante. Transmission d'expérience.
[pause 6s]
Quelle est celle qui vous est la plus naturelle ?
[pause 8s]

La quatrième : votre public naturel.
[pause 5s]
Qui vous cherche naturellement ?
[pause 4s]
Qui vous trouve sans que vous ayez à forcer ?
[pause 5s]
Ce sont les personnes pour qui vous êtes particulièrement équipé.
[pause 8s]

La cinquième : votre empreinte.
[pause 5s]
Dans dix ans...
[pause 4s]
que veulent dire les personnes que vous avez accompagnées quand elles parlent de vous ?
[pause 10s]

Prenons maintenant la méditation finale de cette formation.
[pause 5s]

La méditation de synthèse et d'engagement.
[pause 6s]

Installez-vous dans la position la plus confortable.
[pause 5s]
Prenez le temps. Ce n'est pas un moment à bâcler.
[pause 5s]

Trois souffles très lents.
[pause 25s]

Je vais vous inviter à revivre en images les huit modules précédents.
[pause 6s]

Module un. L'Identité.
[pause 5s]
Qui êtes-vous... avant ce que vous transmettez ?
[pause 6s]
Laissez venir une image.
[pause 8s]

Module deux. La Posture du Serviteur.
[pause 5s]
Comment avez-vous choisi de vous mettre au service ?
[pause 6s]
Laissez venir une sensation.
[pause 8s]

Module trois. L'Écoute Active.
[pause 5s]
L'espace de silence que vous savez maintenant créer.
[pause 6s]
Laissez venir une couleur.
[pause 8s]

Module quatre. La Transmission Vivante.
[pause 5s]
L'histoire fondatrice que vous portez.
[pause 6s]
Laissez venir un visage.
[pause 8s]

Module cinq. Les Résistances.
[pause 5s]
Ce que vous avez traversé... et ce qui vous équipe maintenant.
[pause 6s]
Laissez venir un mot.
[pause 8s]

Module six. L'Énergie.
[pause 5s]
La fontaine intérieure que vous avez appris à nourrir.
[pause 6s]
Laissez venir une lumière.
[pause 8s]

Module sept. Le Cadre Sacré.
[pause 5s]
L'espace que vous créez où les autres osent être vrais.
[pause 6s]
Laissez venir un sentiment.
[pause 8s]

Module huit. Le Lâcher-Prise.
[pause 5s]
La légèreté que vous avez découverte en ne portant que ce qui vous appartient.
[pause 6s]
Laissez venir un souffle.
[pause 10s]

Maintenant... avec tout cela qui réside en vous.
[pause 6s]

Posez votre main droite sur votre coeur.
[pause 6s]

Et dites à voix haute... ou dans votre coeur...
[pause 5s]

"Je suis..."
[pause 4s]
Dites votre prénom.
[pause 5s]

"Je suis mentor."
[pause 5s]

"Je sers en..."
[pause 5s]
Dites votre valeur fondatrice.
[pause 8s]

"Mon empreinte commence maintenant."
[pause 12s]

Prenez un dernier souffle.
[pause 5s]
Profond. Conscient. Reconnaissant.
[pause 5s]
Inspiration...
[pause 5s]
Rétention...
[pause 5s]
Expiration.
[pause 12s]

Félicitez-vous.
[pause 5s]

Vous avez traversé cette formation.
[pause 5s]
Vous n'êtes plus le même.
[pause 5s]
Et ceux que vous allez accompagner ne seront pas les mêmes non plus.
[pause 8s]

C'est votre empreinte.
[pause 5s]
Elle commence maintenant.
[pause 10s]

À bientôt. Mentor.
[pause 8s]
SCRIPT,

        // ─────────────────────────────────────────────────────────
        // MENTOR — Module 10 — La Transmission Invisible — cible : 16–18 min
        // ─────────────────────────────────────────────────────────
        'mentor-10-transmission-invisible' => <<<'SCRIPT'
Bienvenue dans le module 10.
[pause 6s]

Le module final.
[pause 8s]

La Transmission Invisible.
[pause 6s]
Ce que vous transmettez sans jamais l'avoir enseigné.
[pause 10s]

Ce module est différent des autres.
[pause 6s]
Il ne vous donne pas de nouvelles techniques.
[pause 5s]
Il vous demande de regarder quelque chose que peu de mentors ont le courage de regarder en face.
[pause 10s]

Une vérité dérangeante.
[pause 6s]

Vos étudiants n'apprennent pas ce que vous enseignez.
[pause 6s]
Ils apprennent ce que vous êtes.
[pause 8s]

Pas consciemment.
[pause 5s]
Par mimétisme neurologique profond.
[pause 6s]
Leur système nerveux observe et capture votre façon d'être en relation avec votre propre pratique...
[pause 6s]
avec l'incertitude... avec vos erreurs... avec votre corps...
[pause 6s]
avec l'argent... avec le conflit... avec le silence.
[pause 10s]

C'est ce que j'appelle le Curriculum Invisible.
[pause 10s]

Installez-vous.
[pause 4s]
Inspirez profondément...
[pause 5s]
Bloquez...
[pause 5s]
Relâchez...
[pause 8s]

Il y a cinq choses que vous transmettez sans le savoir.
[pause 8s]

Première chose — votre relation à votre propre pratique.
[pause 6s]
Est-ce que vous faites vous-même ce que vous enseignez ?
[pause 6s]
Vos étudiants le voient. Pas dans vos mots. Dans votre corps.
[pause 6s]
Un mentor qui enseigne la cohérence cardiaque et qui vibre d'impatience en cours...
[pause 5s]
transmet l'impatience. Pas la cohérence cardiaque.
[pause 10s]

Deuxième chose — votre relation à vos propres erreurs.
[pause 6s]
Quand vous vous trompez devant eux — que se passe-t-il en vous ?
[pause 6s]
Vous couvrez ? Vous justifiez ? Vous assumez ?
[pause 6s]
Un mentor qui assume ses erreurs avec grâce enseigne plus sur la résilience en trente secondes...
[pause 5s]
que cinq modules entiers sur le sujet.
[pause 10s]

Troisième chose — votre relation à l'incertitude.
[pause 6s]
Savez-vous dire... "je ne sais pas" ?
[pause 6s]
Ou est-ce que l'incertitude vous force à remplir chaque silence avec une réponse ?
[pause 6s]
Un mentor qui tient l'incertitude avec sérénité transmet que l'incertitude est tenable.
[pause 5s]
C'est l'un des apprentissages les plus libérateurs pour un étudiant.
[pause 10s]

Quatrième chose — votre relation au conflit.
[pause 6s]
Quand un étudiant vous contredit... comment réagissez-vous réellement ?
[pause 6s]
La façon dont vous accueillez l'opposition est la façon dont ils apprendront à l'accueillir eux-mêmes.
[pause 10s]

Cinquième chose — votre relation à votre propre limite.
[pause 6s]
Savez-vous quand vous êtes fatigué, hors-présence, pas au mieux de vous-même ?
[pause 6s]
Et osez-vous le nommer... ou jouez-vous toujours le mentor inébranlable ?
[pause 6s]
La vulnérabilité nommée transmet la permission d'être humain.
[pause 5s]
C'est l'un des cadeaux les plus rares qu'un mentor puisse offrir.
[pause 10s]

Inspirez profondément...
[pause 5s]
Bloquez...
[pause 5s]
Relâchez...
[pause 8s]

Parlons maintenant de l'échec comme matière pédagogique.
[pause 6s]

Demandez à n'importe quel adulte de vous rappeler une leçon qui a changé sa vie.
[pause 8s]
Dans neuf cas sur dix... ce n'est pas quand le mentor a brillé.
[pause 6s]
C'est quand il a chuté... et s'est relevé devant eux.
[pause 10s]

La réussite crée de l'admiration. Et souvent de la distance.
[pause 6s]
"C'est pour lui. Pas pour moi."
[pause 8s]

L'échec partagé avec grâce crée de l'identification.
[pause 6s]
"Si lui a traversé ça et continué — moi aussi, je peux."
[pause 8s]

La réussite transmet un résultat.
[pause 5s]
L'échec transmet... un chemin.
[pause 10s]

Trois règles pour partager un échec de façon transformatrice.
[pause 6s]

Premièrement — nommez l'échec précisément.
[pause 5s]
Pas "j'ai traversé des choses difficiles".
[pause 5s]
"J'avais douze étudiants inscrits à ma deuxième formation. Quatre sont venus."
[pause 8s]

Deuxièmement — nommez ce que vous avez ressenti. Vraiment.
[pause 5s]
Pas la version édulcorée.
[pause 5s]
La version qui fait encore un peu mal en la disant.
[pause 8s]

Troisièmement — nommez ce que ça a changé.
[pause 5s]
En quoi cet échec a affiné votre pratique, votre humilité, votre service.
[pause 10s]

Ce n'est pas de la faiblesse.
[pause 5s]
C'est de la transmission vivante.
[pause 10s]

Inspirez profondément...
[pause 5s]
Bloquez...
[pause 5s]
Relâchez...
[pause 8s]

Il y a un piège discret qui attend les mentors à succès.
[pause 6s]
On l'appelle la crystallisation du savoir.
[pause 8s]

Le jour où vous enseignez la même chose...
[pause 5s]
de la même façon...
[pause 5s]
avec la même certitude...
[pause 5s]
depuis trop longtemps...
[pause 6s]
vous avez arrêté de transmettre du vivant.
[pause 5s]
Vous transmettez une archive.
[pause 10s]

Il y a une différence palpable entre un mentor qui récite...
[pause 5s]
et un mentor qui découvre en enseignant.
[pause 10s]

Quatre pratiques du perpétuel étudiant.
[pause 6s]

Premièrement — pratiquez vous-même toujours.
[pause 5s]
Pas pour l'exemple. Pour votre propre découverte continue.
[pause 8s]

Deuxièmement — cherchez activement les gens qui vous contredisent.
[pause 5s]
Pas pour les convaincre. Pour vous laisser questionner.
[pause 8s]

Troisièmement — servez-vous de vos étudiants comme enseignants.
[pause 5s]
Leurs questions naïves sont souvent les plus profondes.
[pause 5s]
"Je ne sais pas — explorons ça ensemble" est l'une des phrases les plus puissantes d'un mentor.
[pause 8s]

Quatrièmement — tenez un journal de vos propres découvertes récentes.
[pause 5s]
Si vous n'avez rien de nouveau à noter depuis trois mois... c'est un signal d'alarme.
[pause 10s]

Inspirez profondément...
[pause 5s]
Bloquez...
[pause 5s]
Relâchez...
[pause 8s]

Une dernière dimension.
[pause 6s]
La lignée vivante.
[pause 8s]

Vos étudiants vont, un jour, transmettre à d'autres.
[pause 6s]
Ces autres vont transmettre à d'autres encore.
[pause 6s]
Dans vingt ans, des gens qui ne vous ont jamais rencontré...
[pause 5s]
seront influencés par la façon dont vous vous êtes comporté avec vos étudiants d'aujourd'hui.
[pause 10s]

Ce n'est pas une métaphore.
[pause 5s]
C'est de la transmission du comportement à travers le temps.
[pause 10s]

Les grands transmetteurs ne transmettent pas leur méthode.
[pause 6s]
Ils transmettent l'amour de la méthode.
[pause 6s]
Ils ne veulent pas des copies d'eux-mêmes.
[pause 5s]
Ils veulent des versions différentes qui continuent le feu.
[pause 8s]

Leur victoire la plus haute ?
[pause 6s]
Un étudiant qui les dépasse.
[pause 5s]
Et qui célèbre cela avec eux.
[pause 10s]

La question que chaque mentor devrait se poser une fois par an.
[pause 6s]
"Est-ce que mes étudiants, en observant ma vie...
[pause 5s]
apprennent ce que je veux qu'ils apprennent ?"
[pause 15s]

Si la réponse est "je ne suis pas sûr"...
[pause 5s]
c'est là que le travail commence.
[pause 10s]

Dans votre journal de mentor.
[pause 6s]
Cinq questions honnêtes.
[pause 6s]

Dans les trente derniers jours — avez-vous pratiqué les outils que vous enseignez pour vous-même ?
[pause 18s]

Quel est le dernier raté que vous avez eu dans votre rôle de mentor ?
[pause 18s]

Y a-t-il un enseignement que vous donnez sur pilotage automatique depuis trop longtemps ?
[pause 18s]

Si vos étudiants devaient vous décrire — pas votre enseignement, VOUS — qu'est-ce qu'ils diraient ?
[pause 18s]

Citez trois comportements que vous espérez voir chez vos étudiants dans dix ans. Est-ce que vous incarnez ces trois choses aujourd'hui ?
[pause 18s]

Notez.
[pause 5s]
Revenez à cet inventaire une fois par an.
[pause 5s]
C'est l'acte le plus honnête d'un mentor.
[pause 10s]

À bientôt, mentor.
[pause 5s]
Continuez à apprendre.
[pause 5s]
Continuez à transmettre du vivant.
[pause 10s]
SCRIPT,

        // ─────────────────────────────────────────────────────────
        // MODULE 40 FR — "Traverser la perte — le deuil, la finitude et l'art de vraiment vivre"
        // Arc unifié : deuil → finitude → choisir de vivre — cible : 20–22 min
        // ─────────────────────────────────────────────────────────
        '40-traverser-la-perte' => <<<'SCRIPT'
Bienvenue.
[pause 6s]

Prenez un moment pour trouver une position dans laquelle vous pouvez vraiment vous déposer.
[pause 4s]
Allongé ou assis, le dos soutenu.
[pause 3s]
Mains posées sur votre ventre ou votre cœur.
[pause 5s]

Fermez les yeux si vous le souhaitez.
[pause 4s]

Il y a quelque chose de courageux dans le fait d'être ici.
[pause 5s]
D'avoir choisi de se poser... dans un moment qui porte peut-être quelque chose de lourd.
[pause 6s]

Ce module ne vous demandera pas d'aller mieux.
[pause 5s]
Il ne vous demandera pas de tourner la page.
[pause 5s]
Il vous demande simplement... d'être là. Avec ce qui est.
[pause 8s]

Respirons ensemble trois fois avant de commencer.
[pause 4s]

[BREATHING_CYCLES]

[pause 8s]

Laissez votre respiration reprendre son rythme naturel.
[pause 5s]

Je voudrais vous poser une question.
[pause 5s]
Pas pour que vous répondiez avec la pensée.
[pause 4s]
Mais pour que vous répondiez avec le corps.
[pause 5s]

Où est la perte... dans votre corps... en ce moment ?
[pause 8s]

Pour certains, c'est une gorge serrée.
[pause 4s]
Pour d'autres, un creux au milieu de la poitrine, comme si quelque chose manquait là.
[pause 5s]
Parfois c'est un dos alourdi.
[pause 4s]
Des mains qui ont oublié quoi tenir.
[pause 5s]
Ou simplement une fatigue... profonde... sans origine claire.
[pause 6s]

Localisez cet endroit-là.
[pause 5s]
Et si vous pouvez... posez une main dessus.
[pause 6s]
Pas pour le faire partir.
[pause 4s]
Juste pour lui dire : je sais que tu es là.
[pause 8s]

La neuroscientifique Mary-Frances O'Connor a passé vingt ans à étudier le cerveau des personnes en deuil.
[pause 5s]
Et ce qu'elle a découvert est à la fois douloureux et libérateur :
[pause 5s]
la douleur que vous ressentez... est réelle.
[pause 6s]
Pas une fragilité. Pas un manque de caractère.
[pause 5s]
Mais une réponse neurologique à une perte réelle.
[pause 5s]
Les mêmes circuits qui s'activaient quand vous anticipiez cette présence... continuent de chercher.
[pause 6s]
Et chaque confrontation à l'absence... est une micro-privation dans le cerveau.
[pause 8s]

Ce n'est pas dans la tête.
[pause 4s]
C'est dans le corps.
[pause 4s]
C'est dans les bras qui ont tenu.
[pause 4s]
Dans la voix qui a appelé.
[pause 4s]
Dans les yeux qui ont cherché.
[pause 6s]

Le corps porte ce que l'esprit ne peut pas encore nommer.
[pause 8s]

Revenons à la respiration.
[pause 4s]
Cette fois avec une intention précise.
[pause 5s]

[BREATHING_CYCLES]

[pause 8s]

Cinq temps pour inspirer... et accueillir ce qui est.
[pause 4s]
Cinq temps de silence... pour tenir. Sans s'effondrer. Sans fuir.
[pause 4s]
Cinq temps pour expirer... et lâcher le poids d'un instant.
[pause 5s]
Pas lâcher la personne.
[pause 4s]
Pas lâcher le souvenir.
[pause 5s]
Juste... le poids de ce moment précis.
[pause 8s]

[BREATHING_CYCLES]

[pause 8s]

Il y a un mythe que nous devons défaire ensemble.
[pause 5s]
Le mythe du "faire son deuil".
[pause 6s]
L'idée qu'il faudrait "lâcher prise", "tourner la page", "passer à autre chose".
[pause 7s]

En 1996, les chercheurs Klass, Silverman et Nickman ont démontré quelque chose que les gens qui ont perdu quelqu'un savent déjà intuitivement :
[pause 5s]
maintenir un lien avec ce qui est parti... n'est pas de la pathologie.
[pause 5s]
C'est de la santé.
[pause 6s]

Parler de la personne disparue.
[pause 4s]
Honorer sa mémoire.
[pause 4s]
Lui écrire encore.
[pause 4s]
Cuisiner ce qu'elle aimait.
[pause 4s]
Garder ses rituels.
[pause 5s]

Tout cela... n'est pas rester coincé.
[pause 5s]
C'est rester connecté.
[pause 8s]

Le deuil ne vous demande pas d'oublier.
[pause 5s]
Il vous demande d'apprendre à porter autrement.
[pause 8s]

Maintenant... je voudrais vous inviter à laisser venir une image.
[pause 5s]
Un souvenir.
[pause 4s]
Pas forcément le plus douloureux.
[pause 5s]
Peut-être le plus vrai.
[pause 5s]
Un moment... avec cette personne, cette relation, cette version de vous-même... qui porte quelque chose de beau.
[pause 8s]

Un sourire que vous avez vu.
[pause 5s]
Une phrase qu'on vous a dite.
[pause 5s]
Un lieu que vous partagiez.
[pause 5s]
Une qualité que vous aimiez.
[pause 8s]

Restez avec cette image.
[pause 6s]
Sans l'analyser.
[pause 4s]
Sans vous défendre de ce qu'elle fait remonter.
[pause 5s]
Laissez-vous être touché.
[pause 10s]

Ce que vous ressentez là... c'est la preuve d'un amour.
[pause 5s]
Pas d'une faiblesse.
[pause 6s]
C'est le prix que nous payons pour avoir aimé.
[pause 5s]
Et si nous le payons, c'est parce que ça en valait la peine.
[pause 10s]

Il y a quelque chose que je voulais vous partager.
[pause 5s]
Une idée de David Kessler... qui a passé sa vie à accompagner des personnes en deuil.
[pause 5s]
Il dit que le deuil a un sixième stade.
[pause 5s]
Non pas une obligation.
[pause 4s]
Mais une possibilité.
[pause 6s]
Ce stade s'appelle : trouver du sens.
[pause 7s]

Pas un sens imposé de l'extérieur.
[pause 5s]
Pas de "c'était pour le mieux" ou "Dieu avait un plan".
[pause 6s]
Un sens que vous construisez vous-même.
[pause 5s]
À votre rythme.
[pause 5s]
Qui peut prendre des années.
[pause 5s]
Et qui peut prendre des formes très différentes pour chacun.
[pause 8s]

Certains trouvent ce sens dans un engagement.
[pause 4s]
D'autres dans une création.
[pause 4s]
D'autres dans la façon dont ils choisissent de vivre.
[pause 4s]
D'autres dans ce qu'ils transmettent.
[pause 8s]

Et d'autres encore... n'ont pas encore trouvé ce sens.
[pause 5s]
C'est aussi valide.
[pause 5s]
Tenir dans l'absence de sens... est parfois le travail le plus courageux qu'on puisse faire.
[pause 8s]

Viktor Frankl, qui a survécu aux camps de concentration et perdu presque tous ses proches, a écrit une phrase que je vous confie :
[pause 5s]
"Tout peut être pris à un homme... sauf une chose.
[pause 4s]
La dernière des libertés humaines.
[pause 4s]
Choisir son attitude face à n'importe quelle circonstance donnée."
[pause 10s]

Vous ne choisissez pas la perte.
[pause 5s]
Vous choisissez comment vous la traversez.
[pause 8s]

Revenons à la respiration une dernière fois.
[pause 4s]

[BREATHING_CYCLES]

[pause 8s]

[BREATHING_CYCLES]

[pause 10s]

Je vais vous laisser avec une invitation intérieure.
[pause 5s]
Dites-vous, à l'intérieur ou à voix haute si vous le souhaitez :
[pause 5s]
Je porte cette perte.
[pause 4s]
Et je continue de vivre.
[pause 4s]
Ces deux choses ne se contredisent pas.
[pause 4s]
Elles coexistent.
[pause 5s]
Et je suis capable de les tenir ensemble.
[pause 10s]

Maintenant...
[pause 4s]
Sentez le poids de votre corps dans la position dans laquelle vous êtes.
[pause 5s]
Sentez votre respiration... qui continue.
[pause 5s]
Sentez... cette capacité que vous avez... de tenir.
[pause 6s]
Elle a toujours été là.
[pause 5s]
Même quand vous n'y croyiez plus.
[pause 8s]

Prenez le temps qu'il vous faut pour revenir.
[pause 6s]

À bientôt.
[pause 5s]
Continuez à traverser.
[pause 5s]
Pas à aller mieux.
[pause 4s]
À traverser.
[pause 5s]
C'est suffisant.
[pause 5s]
C'est même courageux.
[pause 10s]

[pause 8s]

Maintenant... je voudrais vous inviter à faire un pas de plus.
[pause 6s]
Un pas que la perte rend possible.
[pause 5s]
Un pas que rien d'autre n'aurait rendu aussi réel.
[pause 8s]

Il y a quelque chose que les personnes qui ont perdu quelqu'un de jeune — quelqu'un de votre âge, avec des enfants, avec des projets — décrivent souvent de la même façon.
[pause 6s]
Elles disent : depuis ce jour, je ne vois plus la vie de la même façon.
[pause 6s]
Elles ne disent pas ça comme une consolation.
[pause 5s]
Elles le disent comme une vérité nue.
[pause 6s]
La mort de l'autre... a fracturé quelque chose dans leur certitude silencieuse qu'elles avaient le temps.
[pause 8s]

Le psychiatre Irvin Yalom appelle ça un awakening experience.
[pause 5s]
Une expérience d'éveil.
[pause 5s]
Pas une blessure à guérir.
[pause 4s]
Une clarté à recevoir.
[pause 8s]

Alors je voudrais vous poser une question.
[pause 5s]
Pas une question rhétorique.
[pause 4s]
Une vraie question. Qui mérite une vraie réponse.
[pause 6s]

Si vous saviez, ce soir, que vous avez dix ans devant vous.
[pause 5s]
Pas l'espoir vague d'une longue vie.
[pause 4s]
Dix ans. Précisément.
[pause 6s]

Avec qui les passeriez-vous ?
[pause 8s]

Avec qui n'avez-vous pas encore assez de temps ?
[pause 8s]

Quel voyage avez-vous promis à vos enfants... et remis à "quand les conditions seront meilleures" ?
[pause 8s]

Quelle phrase n'avez-vous jamais dite à quelqu'un qui compte... parce que vous pensiez avoir le temps ?
[pause 10s]

Prenez le temps que ces questions méritent.
[pause 8s]

[BREATHING_CYCLES]

[pause 8s]

Il y a une chercheuse à Stanford qui s'appelle Laura Carstensen.
[pause 5s]
Elle a passé vingt ans à étudier ce qui change dans les priorités humaines quand les gens perçoivent que le temps est limité.
[pause 5s]
Sa découverte est bouleversante dans sa simplicité :
[pause 5s]
quand l'horizon se resserre... les supérficiels disparaissent.
[pause 5s]
Les gens abandonnent spontanément les activités sans profondeur.
[pause 5s]
Et ils investissent massivement dans ce qui compte vraiment.
[pause 5s]
Leurs proches. Leurs expériences. Leur sens.
[pause 6s]

Et ce qu'elle a aussi découvert... c'est que ce changement ne nécessite pas de vieillir.
[pause 5s]
Il nécessite de réaliser.
[pause 8s]

Vous êtes en train de réaliser.
[pause 6s]
Peut-être depuis la perte que vous avez traversée.
[pause 5s]
Peut-être depuis ce module.
[pause 5s]
Peut-être depuis cette respiration.
[pause 8s]

[BREATHING_CYCLES]

[pause 8s]

Il y a une infirmière australienne qui s'appelle Bronnie Ware.
[pause 5s]
Elle a passé des années au chevet de personnes mourantes.
[pause 5s]
Et elle a collecté leurs regrets — sans les embellir.
[pause 6s]

Le regret le plus souvent cité, presque à l'unanimité :
[pause 5s]
"J'aurais aimé avoir eu le courage de vivre la vie que je voulais vraiment.
[pause 4s]
Pas celle que les autres attendaient de moi."
[pause 8s]

Et le deuxième :
[pause 5s]
"J'aurais aimé ne pas avoir autant travaillé."
[pause 8s]

Pas : j'aurais aimé avoir plus d'argent.
[pause 4s]
Pas : j'aurais aimé avoir une plus grande maison.
[pause 4s]
Pas : j'aurais aimé avoir eu plus de succès.
[pause 6s]

Avoir osé.
[pause 5s]
Et avoir été là.
[pause 8s]

Vous entendez les deux choses que vos proches attendent de vous ?
[pause 8s]
Pas votre réussite.
[pause 5s]
Votre présence.
[pause 5s]
Et votre vie vraiment vécue.
[pause 10s]

[BREATHING_CYCLES]

[pause 8s]

Je vais vous laisser avec une invitation.
[pause 5s]
Non pas une liste de choses à faire.
[pause 4s]
Mais une image.
[pause 6s]

Imaginez que vous ayez 80 ans.
[pause 5s]
Un soir d'été. Vos enfants, devenus adultes, sont autour de vous.
[pause 5s]
Ils parlent de vous.
[pause 5s]
Ils racontent qui vous étiez.
[pause 5s]
Ils disent ce que vous leur avez transmis.
[pause 5s]
Ce qu'ils ont appris à vos côtés.
[pause 5s]
Les moments qu'ils n'oublieront jamais.
[pause 8s]

Qu'est-ce qu'ils disent ?
[pause 10s]

Prenez le temps d'entendre cette réponse.
[pause 8s]

Maintenant.
[pause 5s]
La distance entre cette image... et votre vie telle qu'elle est aujourd'hui.
[pause 5s]
C'est votre travail.
[pause 5s]
Pas une culpabilité.
[pause 4s]
Une direction.
[pause 8s]

Votre vie n'est pas un dû.
[pause 5s]
Ce n'est pas quelque chose que vous avez mérité une fois pour toutes à la naissance.
[pause 5s]
C'est un cadeau fragile, renouvelé chaque matin.
[pause 5s]
Et ce cadeau... peut s'arrêter.
[pause 5s]
Pour vous. Pour quelqu'un que vous aimez.
[pause 5s]
À n'importe quel moment. Pour des raisons que vous ne contrôlez pas.
[pause 8s]

Alors une dernière fois, respirons ensemble.
[pause 4s]

[BREATHING_CYCLES]

[pause 10s]

Dites-vous à l'intérieur, ou à voix haute si vous le pouvez :
[pause 5s]
Je porte la perte de ceux que j'ai aimés.
[pause 4s]
Et je choisis de vraiment vivre.
[pause 5s]
Ces deux choses coexistent.
[pause 5s]
Et aujourd'hui, maintenant, je me donne la permission de commencer.
[pause 10s]

Prenez le temps qu'il vous faut pour revenir.
[pause 6s]

À bientôt.
[pause 5s]
Pas pour aller mieux.
[pause 4s]
Pour vivre plus vrai.
[pause 5s]
C'est la seule réponse digne de ceux qui n'ont plus le temps.
[pause 10s]
SCRIPT,

    ];
    private array $scriptsEn = [

        // ─────────────────────────────────────────────────────────
        // MODULE 0 EN — "Understanding the Body" (anatomy) — target : 8–10 min
        // ─────────────────────────────────────────────────────────
        '00-comprendre-le-corps' => <<<'SCRIPT'
Welcome to this opening module.
[pause 6s]

Before we begin... settle in comfortably.
[pause 3s]
Sitting... lying down... standing... it doesn't matter.
[pause 4s]
Let your body find its natural support.
[pause 8s]

This module does not begin with Latin terms.
[pause 4s]
It does not begin with anatomical diagrams.
[pause 4s]
It begins with three images.
[pause 5s]
Simple... obvious... that everyone understands immediately.
[pause 8s]

Because to understand the body deeply...
[pause 4s]
you first need to see it differently.
[pause 10s]

First image.
[pause 5s]

The living house.
[pause 6s]

Imagine that your body is a living house.
[pause 5s]
Not an ordinary house...
[pause 3s]
A house that thinks... that breathes... that adapts every single moment.
[pause 8s]

Every house rests on a frame.
[pause 4s]
Without it... the walls collapse.
[pause 3s]
In your body... this is the skeleton.
[pause 5s]
It gives the structure... the form... the architecture.
[pause 3s]
The spine is the central beam.
[pause 4s]
Everything else organizes around it.
[pause 8s]

A house also has hinges.
[pause 4s]
Pivots... that allow opening... closing... bending.
[pause 3s]
In your body... these are the joints.
[pause 5s]
Knee... elbow... shoulder... hip.
[pause 4s]
They are what makes movement possible.
[pause 8s]

A modern house has mechanisms.
[pause 4s]
Doors that open... shutters that close...
[pause 3s]
Everything that puts the house in motion.
[pause 4s]
In your body... these are the muscles.
[pause 5s]
They pull on bones... activate joints... create every gesture.
[pause 8s]

A healthy house has air that circulates.
[pause 4s]
Not wind... air.
[pause 3s]
Windows you open in the morning...
[pause 3s]
An atmosphere that renews itself.
[pause 4s]
When air flows... the house is light... alive.
[pause 3s]
When air is blocked... the atmosphere becomes heavy.
[pause 5s]
In your body... this is your breath.
[pause 4s]
The Pause Souffle is the act of opening your house's windows... consciously.
[pause 10s]

And finally... a house without electricity is blind.
[pause 4s]
Electricity connects every room... lights everything... powers every device.
[pause 4s]
In your body... this is the nervous system.
[pause 5s]
It connects the brain to every muscle... every organ... every millimeter of skin.
[pause 10s]

Your living house is here... right now... holding you.
[pause 12s]

Second image.
[pause 5s]

The living tree.
[pause 6s]

If the house spoke to you of structure...
[pause 4s]
the tree speaks to you of life.
[pause 8s]

Imagine that your body is a tree.
[pause 5s]
A tree in full life... growing... breathing... nourishing.
[pause 8s]

Every tree organizes around its trunk.
[pause 4s]
Vertical... central... the link between earth and sky.
[pause 4s]
In your body... this is the spine.
[pause 5s]
Everything radiates from it.
[pause 8s]

The arms are the branches.
[pause 4s]
They extend... rise... open toward the world.
[pause 5s]
The legs are the roots.
[pause 4s]
They anchor... stabilize... absorb.
[pause 4s]
Feel your feet... right now... that is your grounding.
[pause 10s]

The muscles are the living bark.
[pause 4s]
They wrap around the bones... protect the organs...
[pause 3s]
give the body its visible form.
[pause 4s]
And like bark... they hold the memory of accumulated tensions.
[pause 8s]

The blood is the sap.
[pause 4s]
It circulates everywhere... constantly... from center to extremity.
[pause 4s]
It brings oxygen... nutrients... energy.
[pause 3s]
It carries away what the body no longer needs.
[pause 8s]

The lungs are the leaves.
[pause 4s]
With each breath in... they capture oxygen from the world.
[pause 4s]
With each breath out... they release what is no longer useful.
[pause 5s]
Each breath is an exchange... between you... and the world.
[pause 10s]

And the nerves... are the invisible network.
[pause 4s]
Beneath the surface... they transmit... inform... coordinate.
[pause 4s]
Sensation... movement... reaction... everything passes through them.
[pause 12s]

Third image.
[pause 5s]

The living orchestra.
[pause 6s]

If the house spoke of structure...
[pause 3s]
and the tree of life...
[pause 3s]
the orchestra speaks of intelligence.
[pause 8s]

Imagine that your body is a living orchestra.
[pause 5s]
In an orchestra... every instrument plays its part.
[pause 4s]
Everything must be coordinated.
[pause 3s]
Otherwise... the music becomes noise.
[pause 8s]

The brain is the conductor.
[pause 4s]
It leads... coordinates... sets the tempo.
[pause 3s]
Constantly... it receives thousands of signals... and makes decisions.
[pause 8s]

The nerves are the score.
[pause 4s]
They transmit instructions to the muscles.
[pause 3s]
Contract... release... move... stop.
[pause 4s]
And in return... they send sensations back to the brain.
[pause 8s]

The muscles are the instruments.
[pause 4s]
Some are powerful... like the brass.
[pause 3s]
Others are precise... like the violins.
[pause 3s]
Others still are stabilizing... silent... like the bass.
[pause 5s]
Fluid movement... is when all instruments play together... at the right moment.
[pause 8s]

The skeleton is the stage.
[pause 4s]
Musicians need a solid structure to perform.
[pause 4s]
Without it... nothing is possible.
[pause 8s]

And the breath...
[pause 4s]
is the rhythm.
[pause 5s]
When it is slow and deep...
[pause 3s]
the orchestra plays softly... the whole body settles.
[pause 4s]
When it is fast and shallow...
[pause 3s]
everything accelerates... tension rises.
[pause 5s]
What you do with your breath...
[pause 3s]
you do with your entire body.
[pause 10s]

Now... let us take a moment.
[pause 5s]
Three images... one single truth.
[pause 6s]

The house... tells you what the body is.
[pause 5s]
The tree... tells you what makes it alive.
[pause 5s]
The orchestra... tells you what makes it intelligent.
[pause 10s]

Your body is all of this at once.
[pause 5s]
It is not a machine to be repaired.
[pause 4s]
It is a being to be inhabited.
[pause 10s]

Now... I am going to take you on a journey.
[pause 5s]
A journey through the territories of your body.
[pause 6s]
From the feet... to the head.
[pause 4s]
Slowly... without searching for anything.
[pause 5s]
Just arriving there.
[pause 10s]

Feel your feet.
[pause 4s]
Twenty-six bones in each foot... arranged like a living arch.
[pause 4s]
Resting on them... the tibia... the fibula... the knee.
[pause 5s]
The largest hinge in your body.
[pause 6s]

Move up to the thighs.
[pause 4s]
The femur... the longest bone in your body.
[pause 4s]
Wrapped by the quadriceps at the front... the hamstrings at the back.
[pause 5s]
Powerful cables... that allow you to walk... to run... to stand.
[pause 8s]

The pelvis... the center of gravity.
[pause 4s]
The ilium... the ischium... the pubis.
[pause 4s]
The psoas... anchored here... linking the spine to the thighs.
[pause 5s]
This is the muscle the Pause Souffle releases most deeply.
[pause 8s]

The abdomen... the belly.
[pause 4s]
Four layers of spiral muscles... like a natural corset.
[pause 4s]
And beneath them... the organs that transform... nourish... eliminate.
[pause 6s]

The thorax... the cage.
[pause 4s]
Sternum... twelve pairs of ribs... thoracic vertebrae.
[pause 4s]
And at the center of everything... the diaphragm.
[pause 4s]
The only muscle that is both voluntary and automatic.
[pause 4s]
The bridge between what you control... and what the body does on its own.
[pause 5s]
Gently push your belly outward as you breathe in...
[pause 3s]
That is the diaphragm.
[pause 8s]

The shoulders... the arms... down to the hands.
[pause 4s]
Twenty-seven bones in each hand.
[pause 4s]
These hands that touch... that create... that care.
[pause 6s]

The back.
[pause 4s]
The trapezius... the latissimus dorsi... the rhomboids.
[pause 4s]
And deep beneath... the multifidus... vertebra by vertebra.
[pause 4s]
The silent guardians of your spine.
[pause 8s]

The neck... seven cervical vertebrae.
[pause 4s]
The vagus nerve passes through here...
[pause 3s]
the thread connecting the brain to the heart... the lungs... the gut.
[pause 5s]
Each slow breath calms it.
[pause 8s]

And the head.
[pause 4s]
Twenty-two bones forming the skull and face.
[pause 4s]
The brain inside... three pounds of living matter...
[pause 4s]
containing more connections than there are stars in the Milky Way.
[pause 8s]

Your body is a living city.
[pause 5s]
With its districts... its roads... its essential services.
[pause 5s]
The nervous system transmits at one hundred and twenty meters per second.
[pause 4s]
The heart beats one hundred thousand times a day without ever stopping.
[pause 4s]
The lungs exchange twenty thousand liters of air every day.
[pause 4s]
The immune system watches... filters... protects... in silence.
[pause 5s]
And the fascia... continuous tissue connecting everything...
[pause 4s]
forms an invisible suit inside your body.
[pause 4s]
Without any interruption... from head to toe.
[pause 10s]

When you breathe in deeply...
[pause 4s]
five systems respond simultaneously.
[pause 4s]
Respiratory... cardiovascular... nervous... endocrine... fascial.
[pause 5s]
Five systems. Five seconds. One single breath.
[pause 10s]

We will now practice together.
[pause 3s]
The Pause Souffle... five-five-five.
[pause 5s]

Five seconds to inhale.
[pause 2s]
Five seconds of retention... mouth slightly open.
[pause 2s]
Five seconds to exhale... lips gently pursed.
[pause 5s]

This is your core tool.
[pause 3s]
The act of opening your house's windows.
[pause 3s]
Of circulating sap through your living tree.
[pause 3s]
Of reclaiming the baton of your orchestra.
[pause 7s]

We begin.
[BREATHING_CYCLES]
[pause 20s]

Stay there for a moment.
[pause 6s]
Feel what just took place.
[pause 8s]

Welcome to the living knowledge of the body.
[pause 5s]
See you very soon.
SCRIPT,

        // ─────────────────────────────────────────────────────────
        // MODULE 0 PROLOGUE EN — "Life Has No Age" — target : 18–21 min
        // Tone : intimate, founding — tribute to Chantal, the light that ignites everything
        // ─────────────────────────────────────────────────────────
        '00-prologue-la-vie-na-pas-dage' => <<<'SCRIPT'
[pause 8s]

This program is dedicated to someone.
[pause 5s]
To a woman.
[pause 4s]
Her name was Chantal.
[pause 10s]

There are moments in a life that cut the world in two.
[pause 5s]
Before.
[pause 3s]
And after.
[pause 8s]

I owe this program to one of those moments.
[pause 4s]
Not to a course.
[pause 3s]
Not to a book.
[pause 3s]
To her.
[pause 12s]

Chantal was forty years old.
[pause 5s]
A daughter of thirteen.
[pause 3s]
A son of ten.
[pause 6s]
A cancer diagnosed.
[pause 3s]
A remission.
[pause 3s]
And then... within a month...
[pause 6s]
it was over.
[pause 12s]

Not an old woman at the end of a long life.
[pause 5s]
A woman my age.
[pause 4s]
With the same plans.
[pause 3s]
The same children as me.
[pause 3s]
The same silent certainties about the future.
[pause 10s]

I want to tell you who she was.
[pause 5s]
Truly.
[pause 8s]

She smiled in a way that made rooms brighter.
[pause 5s]
She had this smile — with beautiful white teeth —
[pause 4s]
a smile that wasn't trying to impress anyone.
[pause 4s]
A smile that simply said:
[pause 4s]
I am here.
[pause 3s]
I am alive.
[pause 3s]
And that is enough.
[pause 10s]

She breathed life.
[pause 4s]
Not the performance of life.
[pause 3s]
Life itself.
[pause 10s]

She didn't have the impressive degrees.
[pause 4s]
Not the high-profile career.
[pause 4s]
Not the external markers that our era confuses with success.
[pause 5s]
She had something rarer.
[pause 6s]

She knew who she was.
[pause 8s]

And because she knew who she was...
[pause 4s]
she lived from that place.
[pause 5s]
Not from the fear of others' judgment.
[pause 4s]
Not from the need to prove something.
[pause 4s]
From herself.
[pause 3s]
From her values.
[pause 3s]
From what truly mattered.
[pause 10s]

She had made the choices that few people make.
[pause 5s]
Not the easy choices.
[pause 4s]
The right ones.
[pause 6s]

She had built something real.
[pause 5s]
A family. A home. Solid bonds.
[pause 6s]
Her children are surrounded today.
[pause 4s]
Loved. Held.
[pause 5s]
This is the fruit of what she had sown.
[pause 10s]

When she left...
[pause 5s]
she didn't leave a void behind her.
[pause 5s]
She left jewels.
[pause 6s]

Her children.
[pause 5s]
Beings shaped by a woman who knew...
[pause 4s]
that what you sow today grows long after you are gone.
[pause 12s]

In forty years...
[pause 4s]
Chantal lived more authentically than many will in eighty.
[pause 6s]

She had realized what some spend a whole lifetime barely touching.
[pause 6s]

The most precious life...
[pause 4s]
is not in appearances.
[pause 3s]
Not in degrees.
[pause 3s]
Not in the success certificates that society hands out.
[pause 5s]
It is in simplicity.
[pause 4s]
In knowing what you love...
[pause 3s]
who you love...
[pause 3s]
why you live.
[pause 4s]
And acting from that place.
[pause 10s]

She was humble.
[pause 4s]
Not because she lacked confidence.
[pause 4s]
But because she knew her worth.
[pause 5s]
And the one who truly knows their worth...
[pause 4s]
no longer needs to prove it.
[pause 10s]

She was the sun.
[pause 5s]
Not the kind of sun that shines to be noticed.
[pause 5s]
The kind that simply warms...
[pause 4s]
because that is its nature.
[pause 12s]

Here is the painful paradox her departure left me with.
[pause 6s]

We had known each other since middle school.
[pause 4s]
Chantal was my sister's best friend.
[pause 5s]
We spent a lot of time together in high school... in the same city.
[pause 5s]
Then I moved to Belgium.
[pause 4s]
We saw each other briefly after my son was born.
[pause 4s]
A few exchanges on social media.
[pause 4s]
And then... the ordinary silence that sets in.
[pause 4s]
The kind you always think is temporary.
[pause 3s]
The kind that lasts.
[pause 10s]

The last time I had Chantal on the phone...
[pause 5s]
it had been years since we'd truly talked.
[pause 5s]
She had found me on social media.
[pause 4s]
She no longer had my number.
[pause 8s]

It wasn't a call about her.
[pause 5s]
It wasn't to tell me she was sick.
[pause 5s]
It was for someone she loved.
[pause 5s]
Someone who was going through something very hard.
[pause 5s]
Someone who needed someone to be there.
[pause 10s]

She already had her cancer.
[pause 5s]
I didn't know.
[pause 4s]
She didn't tell me.
[pause 6s]

She was carrying that.
[pause 4s]
And her first instinct... was still others.
[pause 4s]
Always.
[pause 8s]

During all those years I had been away...
[pause 5s]
my sister went through difficult periods.
[pause 5s]
And Chantal was there for her.
[pause 5s]
Her best friend.
[pause 4s]
Present.
[pause 4s]
When I was far away.
[pause 10s]

I am so grateful to her for that.
[pause 6s]

She sowed something in my sister's life.
[pause 5s]
And today...
[pause 4s]
I want to be for her children...
[pause 4s]
what she was for her.
[pause 12s]

Now that you are no longer here...
[pause 5s]
I think of you often.
[pause 10s]

It is one of the bitterest truths that loss teaches us.
[pause 6s]
We realize the value of what we had...
[pause 5s]
when we no longer have it.
[pause 12s]

But you did something greater for me than make me regret.
[pause 6s]

You held a mirror up to me.
[pause 8s]

You showed me that we were almost the same age.
[pause 5s]
And that if it were me leaving tomorrow...
[pause 5s]
the wise choices you had made —
[pause 4s]
the choices for your children —
[pause 4s]
the choices to be truly present to your life —
[pause 4s]
I had not made them.
[pause 8s]

I realized how much I had been living alongside my own life.
[pause 6s]
Alongside what truly mattered.
[pause 5s]
With my children — present, but not really there.
[pause 5s]
With my sister — there, but not enough.
[pause 4s]
With my friends — in touch, but without really taking the time.
[pause 5s]
With my dreams — moving, but feeling like I was going nowhere.
[pause 5s]
Alongside myself.
[pause 12s]

You woke me up.
[pause 8s]

Not through your death.
[pause 5s]
Through who you were.
[pause 10s]

Since you left...
[pause 5s]
things have happened.
[pause 4s]
Real things.
[pause 8s]

This project already existed.
[pause 4s]
But it was going in circles.
[pause 4s]
Moving forward — without really moving forward.
[pause 4s]
I had the feeling of going nowhere.
[pause 8s]

And then something changed.
[pause 5s]
Something I can't quite explain...
[pause 4s]
but which I feel as a certainty.
[pause 10s]

I got to work.
[pause 4s]
In the silence.
[pause 4s]
Hours. Weeks. Months.
[pause 5s]
With the help of my partner.
[pause 4s]
With tools I didn't know at the beginning.
[pause 4s]
Without a written plan.
[pause 3s]
Without a roadmap laid out in advance.
[pause 8s]

And yet — the plan was there.
[pause 5s]
Each day, I discovered what came next.
[pause 4s]
As if someone was whispering it to me.
[pause 10s]

At the start, I just wanted to modernize a website.
[pause 4s]
Today, it holds six universes.
[pause 3s]
A program of forty modules.
[pause 3s]
Several courses.
[pause 3s]
And much more.
[pause 5s]
I can barely believe it myself.
[pause 8s]

That is when I understood something.
[pause 5s]
Something I would not have dared to say a year ago.
[pause 6s]

I am the tool.
[pause 6s]
Junspro — this program — this course —
[pause 4s]
it is God's work.
[pause 8s]

I know that may sound strange to hear.
[pause 4s]
But it is what I believe.
[pause 4s]
Deeply. Calmly. With certainty.
[pause 5s]
At first it was a feeling.
[pause 4s]
Today it is an evidence.
[pause 5s]
In the silence, I am heart to heart with Him on this project.
[pause 4s]
And each morning, He shows me what comes next.
[pause 12s]

In September, I am going to Malta with my children.
[pause 5s]
Not another project I push to next year.
[pause 5s]
A moment I choose to live.
[pause 4s]
Fully. Now.
[pause 10s]

I call more often.
[pause 4s]
My sister. My friends.
[pause 4s]
I say the things. I take the time.
[pause 4s]
I no longer let the silence thicken between those I love.
[pause 10s]

Something has shifted inside me.
[pause 4s]
I feel wiser.
[pause 3s]
More resilient. More understanding.
[pause 4s]
My spirituality has deepened.
[pause 4s]
I seek to understand more.
[pause 3s]
To judge less.
[pause 3s]
To truly see the other.
[pause 10s]

I want my children to have their father.
[pause 5s]
Not out of obligation.
[pause 4s]
Out of conviction.
[pause 6s]
Because their years cannot be bought back.
[pause 5s]
Because every day in the silence is one day less with their father.
[pause 4s]
A missed meal.
[pause 3s]
A joke he won't have heard.
[pause 3s]
A hug that won't have happened.
[pause 6s]
Because neither he nor I are eternal.
[pause 6s]
So I reach out.
[pause 4s]
I take the first step.
[pause 4s]
May God walk with me in that.
[pause 10s]

And then...
[pause 5s]
I met someone.
[pause 6s]
I don't know what the future holds for us.
[pause 5s]
But for the first time in a long time...
[pause 5s]
I want to build something with someone again.
[pause 4s]
May God guide me and walk with me.
[pause 12s]

There is a before.
[pause 5s]
And there is an after.
[pause 6s]
And this after...
[pause 4s]
I owe it to you, Chantal.
[pause 12s]

And for that...
[pause 4s]
I know no better way to thank you...
[pause 4s]
than to make that lesson something living.
[pause 4s]
To pass it on.
[pause 4s]
To make it into this program.
[pause 12s]

This program exists because you existed.
[pause 6s]

Every person who moves through it...
[pause 3s]
every life that changes...
[pause 3s]
every child who is loved more...
[pause 3s]
every dream finally begun...
[pause 5s]
that is your light, still shining.
[pause 15s]

Thank you for being simple in a world that glorifies complexity.
[pause 5s]
Thank you for being real in a world that rewards performance.
[pause 5s]
Thank you for being humble because you knew your worth.
[pause 5s]
Thank you for sowing for your jewels.
[pause 5s]
Thank you for being the wonderful woman... friend... mother... companion that you were.
[pause 8s]

May we one day find each other again.
[pause 5s]
I love you... Chantal.
[pause 20s]

Make yourself comfortable.
[pause 4s]
Close your eyes if you can.
[pause 4s]
And let yourself be moved by what you are about to hear.
[pause 12s]

Marcus Aurelius wrote... two thousand years ago:
[pause 4s]
"It is not death that people fear most.
[pause 3s]
It is the fear of arriving at death...
[pause 3s]
and realizing they never truly lived."
[pause 12s]

There is a difference between knowing you are going to die...
[pause 5s]
and realizing it.
[pause 8s]

Everyone knows.
[pause 4s]
Almost no one realizes.
[pause 10s]

Knowing... is an abstract piece of information.
[pause 4s]
Realizing... is feeling the truth of that information in the flesh.
[pause 5s]
In the hands.
[pause 3s]
In the throat.
[pause 3s]
In that small tightening deep in the stomach.
[pause 10s]

Heidegger called it the authentic mode.
[pause 5s]
Living in full consciousness of one's own finitude.
[pause 4s]
Making decisions from one's real values.
[pause 4s]
Being present to what matters...
[pause 3s]
now.
[pause 10s]

The opposite... is the inauthentic mode.
[pause 4s]
Living by default.
[pause 3s]
Doing what others do.
[pause 3s]
Postponing.
[pause 3s]
Letting life happen.
[pause 4s]
Without truly participating in it.
[pause 12s]

The great question... is this one:
[pause 5s]
In which mode are you living right now?
[pause 15s]

Researchers in psychology made a troubling discovery.
[pause 5s]
Bronnie Ware was a palliative care nurse.
[pause 4s]
For ten years... she listened to people die.
[pause 5s]
She collected their final confidences.
[pause 4s]
What they truly regretted... at the end of the road.
[pause 10s]

Here is what they told her.
[pause 6s]

The first regret... the most widespread:
[pause 4s]
"I wish I'd had the courage to live a life true to myself.
[pause 4s]
Not the life my family expected.
[pause 3s]
Not the life society valued.
[pause 3s]
Mine."
[pause 10s]

The second:
[pause 4s]
"I wish I hadn't worked so hard."
[pause 5s]
Almost every man.
[pause 3s]
Nearly all working women.
[pause 3s]
Without exception.
[pause 10s]

The third:
[pause 4s]
"I wish I'd had the courage to express my feelings."
[pause 5s]
The unsaid words.
[pause 3s]
The held-back "I love you"s.
[pause 3s]
The truths kept for fear of conflict.
[pause 10s]

And the fifth — the one that stopped me the most:
[pause 5s]
"I wish I had let myself be happier."
[pause 6s]
The discovery... made too late...
[pause 4s]
that happiness was a choice.
[pause 12s]

Take a moment with that.
[pause 8s]

Which of these regrets resonates in you... right now?
[pause 15s]

Laura Carstensen... professor at Stanford...
[pause 4s]
spent twenty years studying what happens in people's brains...
[pause 4s]
when they perceive that their time is limited.
[pause 8s]

What she discovered changes everything.
[pause 5s]

When we realize time is running out...
[pause 4s]
the brain automatically recenters priorities.
[pause 5s]
We invest in deep relationships.
[pause 3s]
We let go of superficial activities.
[pause 3s]
We seek meaning.
[pause 3s]
We say the important things.
[pause 10s]

And Carstensen showed something fundamental:
[pause 5s]
This shift does not require growing old.
[pause 4s]
It requires realizing.
[pause 12s]

That is exactly what this program seeks to produce.
[pause 4s]
Not by frightening you.
[pause 4s]
But by waking you up.
[pause 15s]

Let's now ask ourselves a concrete question.
[pause 5s]

Think of the five people you love most.
[pause 6s]
Your children if you have them.
[pause 3s]
Your partner.
[pause 3s]
A parent still living.
[pause 3s]
A close friend.
[pause 8s]

Now... for each of these people...
[pause 4s]
estimate how many times you will truly see them...
[pause 4s]
if you continue living as you do now.
[pause 8s]

A child who is eighteen... about to leave home.
[pause 5s]
Maybe ten full summers together.
[pause 4s]
Maybe fewer.
[pause 10s]

A parent who is seventy-five.
[pause 4s]
If you see them twice a year...
[pause 4s]
and they live fifteen more years...
[pause 4s]
You have thirty occasions to see them.
[pause 4s]
Thirty.
[pause 12s]

This is not to cause you anxiety.
[pause 4s]
It is to wake you up to the preciousness of what is already here.
[pause 5s]
Now.
[pause 4s]
Right in front of you.
[pause 15s]

Oliver Burkeman... in his book Four Thousand Weeks...
[pause 4s]
made a simple calculation.
[pause 4s]
An average human life...
[pause 3s]
is approximately four thousand weeks.
[pause 8s]

Four thousand.
[pause 6s]

At thirty years old... about two thousand six hundred remain.
[pause 4s]
At forty... two thousand.
[pause 4s]
At fifty... fifteen hundred.
[pause 10s]

It's not nothing.
[pause 4s]
But it's not infinite.
[pause 5s]
And most of us are simply not aware of it.
[pause 12s]

So I ask you the question that this entire program seeks to answer:
[pause 6s]

With the weeks... the summers... the Saturday mornings you have left...
[pause 5s]
what do you truly want to live?
[pause 8s]

Not what you are supposed to want.
[pause 4s]
Not what your loved ones expect of you.
[pause 4s]
What you... truly want.
[pause 5s]
Deeply.
[pause 5s]
Honestly.
[pause 15s]

I'm now going to invite you into a moment of breath.
[pause 4s]
Not to calm you.
[pause 4s]
To anchor you in this moment.
[pause 4s]
So that what you've heard can descend from the mind...
[pause 3s]
into the body.
[pause 10s]

Make yourself comfortable.
[pause 4s]
Place your hands on your knees... palms open.
[pause 6s]

I'll guide you through three breathing cycles.
[pause 4s]
With each inhale... say inwardly:
[pause 3s]
"I am alive... now."
[pause 5s]
With each exhale:
[pause 3s]
"I choose how I live this."
[pause 8s]

First cycle.
[pause 3s]
Breathe in... slowly... in five counts.
One.
[pause 1s]
Two.
[pause 1s]
Three.
[pause 1s]
Four.
[pause 1s]
Five.
[pause 2s]
Hold... in five counts.
One.
[pause 1s]
Two.
[pause 1s]
Three.
[pause 1s]
Four.
[pause 1s]
Five.
[pause 2s]
Breathe out... in five counts.
One.
[pause 1s]
Two.
[pause 1s]
Three.
[pause 1s]
Four.
[pause 1s]
Five.
[pause 8s]

Second cycle.
[pause 3s]
Breathe in.
[pause 5s]
Hold.
[pause 5s]
Breathe out.
[pause 5s]

Third cycle.
[pause 3s]
Breathe in.
[pause 5s]
Hold.
[pause 5s]
Breathe out slowly.
[pause 12s]

Stay there.
[pause 6s]
In that breath.
[pause 4s]
In that body.
[pause 4s]
In this moment that exists... and will not return.
[pause 15s]

Viktor Frankl... Austrian psychiatrist... survivor of the camps...
[pause 4s]
devoted his life to one question:
[pause 5s]
What allows a human being to keep living...
[pause 4s]
in the face of absolute suffering?
[pause 8s]

His answer... after years of observing it in the most extreme conditions:
[pause 6s]
Meaning.
[pause 8s]

Not comfort.
[pause 3s]
Not security.
[pause 3s]
Not the absence of pain.
[pause 4s]
Meaning.
[pause 10s]

The awareness that one's life... as it is...
[pause 4s]
has a direction.
[pause 4s]
An importance.
[pause 3s]
A reason for being.
[pause 12s]

And Frankl wrote:
[pause 4s]
"Between stimulus and response...
[pause 4s]
there is a space.
[pause 4s]
In that space lies our freedom...
[pause 3s]
and our power to grow."
[pause 12s]

This program is that space.
[pause 5s]
Between what life imposes on you...
[pause 4s]
and what you choose to make of it.
[pause 15s]

You are about to move through nine more modules after this one.
[pause 5s]
Some will ask time of you.
[pause 3s]
Others will surprise you.
[pause 3s]
Some exercises will place you before truths you've been avoiding for a long time.
[pause 8s]

I ask you to move through all of it...
[pause 4s]
with what you've heard today as your background.
[pause 6s]

Time passes.
[pause 4s]
The people you love are aging.
[pause 3s]
So are you.
[pause 4s]
The projects you keep postponing are not waiting for you.
[pause 10s]

But... and this is the heart of this program...
[pause 5s]
it is never too late to choose.
[pause 6s]

To come home tonight differently.
[pause 3s]
To call someone you've let drift away.
[pause 3s]
To say something you've been holding back for too long.
[pause 3s]
To begin what you know you need to begin.
[pause 12s]

This moment... right now... is real.
[pause 4s]
It will not return.
[pause 4s]
But it can be the starting point for something.
[pause 5s]
Something true.
[pause 15s]

Before closing this module...
[pause 4s]
I'd like you to do something concrete.
[pause 6s]

Not tomorrow.
[pause 3s]
Now.
[pause 8s]

Think of one person.
[pause 5s]
Just one.
[pause 5s]
Someone who truly matters.
[pause 4s]
Someone you haven't told what they mean to you.
[pause 5s]
Perhaps for a long time.
[pause 10s]

Decide... now...
[pause 4s]
that you will tell them.
[pause 4s]
Not later.
[pause 3s]
This week.
[pause 4s]
Within the next seven days.
[pause 6s]

This is the simplest and most powerful commitment you can make entering this program.
[pause 12s]

This program was born from a loss.
[pause 5s]
It carries everything that loss taught me.
[pause 5s]
And everything that years of research... practice... and human encounters...
[pause 4s]
allowed to be built around that initial clarity.
[pause 8s]

You deserve a life that looks like what you truly want.
[pause 5s]
Not an idea of a life.
[pause 3s]
A real life.
[pause 3s]
Lived from your real values.
[pause 3s]
With the people who truly matter.
[pause 3s]
For the reasons that truly matter.
[pause 12s]

Welcome to this program.
[pause 6s]

Welcome... truly.
[pause 15s]
SCRIPT,

        // ─────────────────────────────────────────────────────────
        // MODULE 1 EN — "I Meet Myself" — target : 7–8 min
        // ─────────────────────────────────────────────────────────
        '01-je-me-rencontre' => <<<'SCRIPT'
Welcome.
[pause 6s]

Take the time to truly settle in.
[pause 3s]
A bed... a sofa... or on the floor on a mat.
[pause 5s]

Lie down.
[pause 4s]
Legs uncrossed... feet slightly apart.
[pause 4s]
If you have a blanket... cover yourself now.
[pause 3s]
Let your body feel protected... warm... safe.
[pause 8s]

Place your hands on your belly.
[pause 4s]
Just there... in the center.
[pause 6s]

Before we begin...
[pause 3s]
Set an intention for this time.
[pause 4s]
Not a goal.
[pause 3s]
A direction.
[pause 5s]
What are you coming to find here... today?
[pause 12s]

Close your eyes.
[pause 8s]

Without doing anything... let your body grow heavy.
[pause 5s]

Feel the weight of your feet.
[pause 4s]
Let them sink... as if the surface beneath you is welcoming them.
[pause 6s]

Move up through the calves... the knees... the thighs.
[pause 5s]
All of this can let go.
[pause 6s]

The lower back.
[pause 4s]
Let it open... spread out.
[pause 4s]
It does not have to hold anything.
[pause 7s]

The belly... the chest.
[pause 4s]
Perhaps some tension there... some holding back.
[pause 4s]
Let it simply be... without forcing it away.
[pause 8s]

The shoulders... the arms... the hands.
[pause 4s]
Feel their weight.
[pause 7s]

The neck... the back of the head.
[pause 4s]
The face... the jaw... the eyes... the forehead.
[pause 5s]
Everything can let go.
[pause 10s]

You are here.
[pause 5s]
Whole.
[pause 5s]
Present.
[pause 12s]

There is something strange about our time.
[pause 4s]
We are constantly in motion... constantly connected... constantly busy.
[pause 5s]
And yet... something in us remains unanswered.
[pause 8s]

It is not a lack of willpower.
[pause 3s]
It is not a lack of effort.
[pause 6s]

It is the absence of one simple thing... almost forgotten.
[pause 4s]
Meeting yourself.
[pause 9s]

This module does not ask you to change.
[pause 3s]
It asks you first to see.
[pause 3s]
Honestly.
[pause 3s]
Without defenses.
[pause 3s]
Without judgment.
[pause 8s]

It is through the body that this work begins.
[pause 10s]

We are going to practice the Pause Souffle method.
[pause 3s]
The five-five-five technique.
[pause 5s]

Five seconds to inhale.
[pause 2s]
Five seconds to hold.
[pause 2s]
Five seconds to exhale.
[pause 4s]
Ten cycles.
[pause 2s]
Two and a half minutes of pure presence.
[pause 6s]

On the inhale... let the jaw open gently... as if it releases on its own.
[pause 4s]
During the hold... mouth open... in that suspended silence.
[pause 4s]
On the exhale... lips slightly narrowed... as if blowing on a candle without putting it out.
[pause 6s]

If the mind drifts... let it.
[pause 3s]
And simply return... to the breath.
[pause 7s]

We begin.
[BREATHING_CYCLES]
[pause 20s]

This calm... is you.
[pause 5s]
Simply you.
[pause 15s]

Let the breath return to its natural rhythm.
[pause 10s]

Stay here.
[pause 8s]
Without doing anything.
[pause 12s]

Let a question come... without searching for the answer.
[pause 8s]

What am I chasing?
[pause 15s]

What am I avoiding feeling... when I keep moving?
[pause 15s]

If I truly stopped... what would still be there?
[pause 18s]

Write down what came... in your journal.
[pause 4s]
Without judging it.
[pause 5s]
Even if it is just one word.
[pause 5s]
Even if it is nothing.
[pause 8s]

You have just met yourself.
[pause 6s]
For the first time perhaps... or once again.
[pause 10s]

See you soon.
SCRIPT,

        // ─────────────────────────────────────────────────────────
        // MODULE 2 EN — "I Recognize My Wounds" — target : 14–16 min
        // ─────────────────────────────────────────────────────────
        '02-je-reconnais-mes-blessures' => <<<'SCRIPT'
Welcome.
[pause 6s]

You came back.
[pause 4s]
That already means something.
[pause 8s]

Settle in again.
[pause 3s]
Seated... back straight but not rigid.
[pause 4s]
Like a tree... rooted and flexible at once.
[pause 5s]
Feet flat on the ground.
[pause 4s]
Feel their contact... their weight... their warmth.
[pause 7s]

Hands resting on the thighs... palms up... or palms down.
[pause 4s]
Whatever feels right.
[pause 8s]

Before we begin...
[pause 3s]
Set an intention for this module.
[pause 5s]
Not a resolution.
[pause 3s]
Just a direction.
[pause 5s]
Perhaps simply... to be honest with myself for a few minutes.
[pause 12s]

Close your eyes.
[pause 8s]

Take a deep breath... and as you exhale... let go of everything you have been carrying since this morning.
[pause 10s]

Feel the weight of your head.
[pause 4s]
Let it lighten slightly... as if someone were holding it for you.
[pause 6s]

The neck... the shoulders.
[pause 4s]
You do not have to carry anything here.
[pause 6s]

The chest.
[pause 4s]
Perhaps some tension there... perhaps a tightening.
[pause 4s]
Do not try to understand where it comes from.
[pause 4s]
Just... notice.
[pause 8s]

The belly.
[pause 4s]
The belly often holds what the mind does not want to hear.
[pause 4s]
Feel it.
[pause 4s]
Without asking anything of it.
[pause 10s]

The arms... the hands.
[pause 4s]
Are they tense... or open?
[pause 6s]

Let them open... gently.
[pause 8s]

You are here.
[pause 5s]
Present.
[pause 5s]
Open.
[pause 12s]

This module asks for something simple... but rare.
[pause 4s]
It asks you to look... without fleeing.
[pause 8s]

We all carry wounds.
[pause 5s]
Words heard too early... or never said at all.
[pause 5s]
Absences that were misread.
[pause 5s]
Expectations no one fulfilled... because no one knew.
[pause 8s]

The body holds all of it.
[pause 4s]
Long before the mind understands.
[pause 4s]
Long after the mind has forgotten.
[pause 10s]

These wounds are not flaws.
[pause 5s]
They are maps.
[pause 5s]
They show you where you needed protection.
[pause 5s]
And where... today... you can begin to let go.
[pause 12s]

The first step is not to heal.
[pause 4s]
It is to see.
[pause 4s]
Honestly.
[pause 4s]
With gentleness.
[pause 10s]

It is through the body that we move forward.
[pause 8s]

We are going to practice the five-five-five method.
[pause 5s]

Five seconds to inhale.
[pause 2s]
Five seconds to hold.
[pause 2s]
Five seconds to exhale.
[pause 4s]
Ten cycles.
[pause 2s]
Two and a half minutes of pure presence.
[pause 6s]

On the inhale... let the jaw open gently.
[pause 4s]
During the hold... stay in that silence... and observe what happens.
[pause 4s]
On the exhale... lips slightly narrowed... let go of what can let go.
[pause 6s]

If an emotion rises... let it rise.
[pause 3s]
It is only passing through.
[pause 3s]
And simply return... to the breath.
[pause 7s]

We begin.
[BREATHING_CYCLES]
[pause 20s]

What you just moved through...
[pause 5s]
is courage.
[pause 15s]

Let the breath return to its rhythm.
[pause 10s]

Stay here.
[pause 8s]
Without doing anything.
[pause 12s]

Bring your attention now to an area of your body.
[pause 5s]
An area that still holds something.
[pause 4s]
Perhaps the throat.
[pause 3s]
Perhaps the belly.
[pause 3s]
Perhaps the chest.
[pause 8s]

Do not try to make it leave.
[pause 5s]
Simply breathe toward that place.
[pause 5s]
And say inwardly...
[pause 4s]
I see you.
[pause 15s]

The wound that is hardest to look at...
[pause 4s]
is often the one we have turned into strength.
[pause 10s]

Let a question come... without looking for the answer right away.
[pause 8s]

What wound am I still carrying... without having named it?
[pause 18s]

Have I given myself permission... to feel this?
[pause 18s]

What would change... if I set this weight down... just for today?
[pause 18s]

Write down what came... in your journal.
[pause 4s]
Without judging it.
[pause 5s]
Even if it is painful.
[pause 5s]
Especially if it is painful.
[pause 8s]

Before finishing...
[pause 4s]
I invite you to write a short letter.
[pause 4s]
To the version of yourself that was hurt.
[pause 5s]
Begin simply with these words.
[pause 4s]
I see you.
[pause 4s]
And I understand why you protected yourself.
[pause 10s]

You have nothing to fix right now.
[pause 4s]
Just to see.
[pause 8s]

See you soon.
SCRIPT,

        // ─────────────────────────────────────────────────────────
        // MODULE 3 EN — "I Describe My Happiness" — target : 14–16 min
        // ─────────────────────────────────────────────────────────
        '03-je-decris-mon-bonheur' => <<<'SCRIPT'
Welcome.
[pause 6s]

You looked at your wounds.
[pause 4s]
That is rare.
[pause 4s]
That is courageous.
[pause 8s]

Today... we look at the other side.
[pause 5s]
What nourishes you.
[pause 4s]
What makes you feel alive.
[pause 4s]
What you call... happiness.
[pause 10s]

Settle in.
[pause 3s]
Seated... back straight... rooted.
[pause 4s]
Feet flat on the ground.
[pause 4s]
Feel them... their weight... their solidity.
[pause 7s]

Hands resting on the thighs.
[pause 4s]
Open.
[pause 8s]

Before we begin...
[pause 3s]
Set an intention.
[pause 5s]
Not a goal.
[pause 3s]
A direction.
[pause 5s]
Perhaps... today I let myself see what I truly want.
[pause 12s]

Close your eyes.
[pause 8s]

Take a deep breath... and as you exhale... let go of the noise of the week.
[pause 10s]

Feel the weight of the body... from head to feet.
[pause 5s]
The shoulders... relaxing.
[pause 5s]
The chest... opening.
[pause 5s]
The belly... receiving each breath.
[pause 7s]

You are here.
[pause 5s]
Present.
[pause 5s]
Open.
[pause 12s]

Many people know exactly what they no longer want.
[pause 5s]
The exhaustion.
[pause 3s]
The noise.
[pause 3s]
The relentless pressure.
[pause 5s]
But very few can describe what they truly want.
[pause 5s]
That is not a failure.
[pause 4s]
No one taught us to look in that direction.
[pause 8s]

Happiness is not an abstract destination.
[pause 5s]
It is built from concrete moments.
[pause 4s]
Precise sensations.
[pause 4s]
Instants the body recognizes... before the mind does.
[pause 8s]

If you do not know what your happiness looks like...
[pause 4s]
you cannot recognize it when it arrives.
[pause 10s]

It is through the body that we approach it.
[pause 8s]

We are going to practice the five-five-five method.
[pause 5s]

Five seconds to inhale.
[pause 2s]
Five seconds to hold.
[pause 2s]
Five seconds to exhale.
[pause 4s]
Ten cycles.
[pause 2s]
Two and a half minutes of pure presence.
[pause 6s]

On the inhale... let the jaw open gently.
[pause 4s]
During the hold... stay in that silence... and let what nourishes you rise naturally.
[pause 4s]
On the exhale... release what is not yours.
[pause 6s]

During the cycles... let this question rest gently.
[pause 4s]
What does my body already know about happiness?
[pause 7s]

We begin.
[BREATHING_CYCLES]
[pause 20s]

This calm... is you.
[pause 5s]
Simply you.
[pause 15s]

Let the breath return to its natural rhythm.
[pause 10s]

Stay here.
[pause 8s]
Without doing anything.
[pause 12s]

Let a memory come now.
[pause 5s]
A specific moment.
[pause 4s]
When you felt fully alive.
[pause 4s]
Fully yourself.
[pause 10s]

Where were you?
[pause 15s]

What were you doing?
[pause 15s]

What did you feel in your body at that moment?
[pause 15s]

Now think of a recent day that felt right.
[pause 5s]
Not perfect.
[pause 3s]
But right.
[pause 8s]

What made it feel that way?
[pause 15s]

What did you feel that evening... coming home?
[pause 15s]

These elements... are your real happiness.
[pause 5s]
Not the happiness you were sold.
[pause 4s]
Yours.
[pause 10s]

After this session...
[pause 4s]
take a sheet of paper.
[pause 3s]
Describe your happiness in five concrete sentences.
[pause 4s]
Not grand ideals.
[pause 3s]
True details.
[pause 8s]

This work is rare.
[pause 4s]
Few people make the space for it.
[pause 5s]
You just did.
[pause 8s]

See you soon.
SCRIPT,

        // ─────────────────────────────────────────────────────────
        // MODULE 4 EN — "I Listen to My Breath" — target : 14–16 min
        // ─────────────────────────────────────────────────────────
        '04-j-ecoute-mon-souffle' => <<<'SCRIPT'
Welcome.
[pause 6s]

You looked at who you are.
[pause 4s]
You looked at what has hurt you.
[pause 4s]
You looked at what nourishes you.
[pause 6s]

This module is different.
[pause 5s]
Here... we do not look anymore.
[pause 4s]
We listen.
[pause 10s]

Settle in.
[pause 3s]
Seated... back straight... rooted.
[pause 4s]
Feet flat on the ground.
[pause 4s]
Feel their solidity.
[pause 7s]

Hands resting on the thighs... open.
[pause 8s]

Before we begin...
[pause 3s]
Set an intention.
[pause 5s]
Perhaps... today I let the breath bring me back to myself.
[pause 12s]

Close your eyes.
[pause 8s]

Take a deep breath... and as you exhale... let go of everything you have been carrying since this morning.
[pause 10s]

Feel the weight of the whole body.
[pause 5s]
The shoulders... the arms... the hands.
[pause 6s]

The belly.
[pause 4s]
Feel the movement of the breath.
[pause 4s]
It was here before you arrived.
[pause 4s]
It will be here after.
[pause 8s]

You are here.
[pause 5s]
Present.
[pause 5s]
Ready to listen.
[pause 12s]

There is something remarkable about the breath.
[pause 5s]
It is the only system in the body that is both automatic... and conscious.
[pause 6s]

Your heart beats without any decision from you.
[pause 4s]
Your digestion happens without your permission.
[pause 5s]

But the breath...
[pause 4s]
you can choose it.
[pause 4s]
Right now.
[pause 4s]
And in a few cycles... completely shift your inner state.
[pause 8s]

This is not a metaphor.
[pause 4s]
It is physiological.
[pause 5s]
When you exhale slowly... you activate the vagus nerve.
[pause 4s]
The nervous system shifts from alarm mode... to presence mode.
[pause 4s]
In seconds.
[pause 4s]
Without anything else.
[pause 10s]

There is a quiet power in that.
[pause 4s]
Not the power to control others.
[pause 4s]
Not the power to dominate circumstances.
[pause 5s]
The power to return to yourself.
[pause 4s]
In any circumstance.
[pause 10s]

It is through the body that we go deeper.
[pause 8s]

We are going to practice the five-five-five method.
[pause 5s]

Five seconds to inhale.
[pause 2s]
Five seconds to hold.
[pause 2s]
Five seconds to exhale.
[pause 4s]
Ten cycles.
[pause 2s]
Two and a half minutes of pure presence.
[pause 6s]

On the inhale... let the jaw open gently.
[pause 4s]
During the hold... stay in that silence... observe what is happening inside.
[pause 4s]
On the exhale... lips slightly narrowed... let go of what can let go.
[pause 6s]

This time... during the cycles... rest one silent question.
[pause 4s]
Just one.
[pause 4s]
What is my breath trying to tell me right now?
[pause 6s]

No need for an answer.
[pause 3s]
Just the question.
[pause 7s]

We begin.
[BREATHING_CYCLES]
[pause 20s]

This calm... is you.
[pause 5s]
Simply you.
[pause 15s]

Let the breath return to its natural rhythm.
[pause 10s]

Stay here.
[pause 8s]
Without doing anything.
[pause 12s]

What came during the cycles?
[pause 8s]
An image... a word... a sensation... nothing?
[pause 8s]
Everything is right.
[pause 12s]

The breath is your reference state.
[pause 5s]
Calm.
[pause 3s]
Present.
[pause 3s]
Grounded.
[pause 8s]

You can return here... at any moment.
[pause 5s]
In three cycles... before a difficult meeting.
[pause 4s]
After tension.
[pause 4s]
In the morning... before the world comes in.
[pause 4s]
In the evening... before closing your eyes.
[pause 10s]

This is now your tool.
[pause 4s]
And soon... the one you will pass on.
[pause 8s]

Write down what came... in your journal.
[pause 4s]
What your breath told you.
[pause 5s]
Even if it is just a feeling.
[pause 8s]

See you soon.
SCRIPT,

        // ─────────────────────────────────────────────────────────
        // MODULE 5 EN — "I Discover My Mission" — target : 15–17 min
        // ─────────────────────────────────────────────────────────
        '05-je-decouvre-ma-mission' => <<<'SCRIPT'
Welcome.
[pause 6s]

Four modules.
[pause 4s]
You met yourself.
[pause 4s]
You looked at your wounds.
[pause 4s]
You described what nourishes you.
[pause 4s]
You listened to your body.
[pause 8s]

Today... one question.
[pause 5s]
The rarest one.
[pause 5s]
The most precious.
[pause 8s]

Why am I here?
[pause 12s]

Settle in.
[pause 3s]
Seated... back straight... rooted.
[pause 4s]
Feet flat on the ground.
[pause 5s]
Feel their weight... their warmth... their presence.
[pause 7s]

Hands resting on the thighs... open.
[pause 8s]

Before we begin...
[pause 3s]
Set an intention.
[pause 5s]
Perhaps... today I let what I already know come forward... without filtering it.
[pause 12s]

Close your eyes.
[pause 8s]

Take a deep breath... and as you exhale... let go of everything you think you must be.
[pause 10s]

Your roles.
[pause 4s]
Your responsibilities.
[pause 4s]
What others expect of you.
[pause 6s]
Set all of that down... just for this moment.
[pause 10s]

The face... the jaw... the shoulders.
[pause 5s]
Everything can let go.
[pause 7s]

The belly.
[pause 4s]
Feel the movement of the breath.
[pause 4s]
Gentle... steady... faithful.
[pause 8s]

You are here.
[pause 5s]
Present.
[pause 5s]
Ready to hear.
[pause 12s]

The answer to your mission is not in a degree.
[pause 5s]
Not in a title.
[pause 4s]
Not in what others expect of you.
[pause 6s]

It lives at the intersection of three things.
[pause 5s]

What you have been through.
[pause 6s]

What comes naturally to you... and seems obvious to you... but not to others.
[pause 6s]

And what the world around you needs.
[pause 10s]

The mission is not invented.
[pause 5s]
It is recognized.
[pause 10s]

It is through the body that we approach it.
[pause 8s]

We are going to practice the five-five-five method.
[pause 5s]

Five seconds to inhale.
[pause 2s]
Five seconds to hold.
[pause 2s]
Five seconds to exhale.
[pause 4s]
Ten cycles.
[pause 2s]
Two and a half minutes of pure presence.
[pause 6s]

On the inhale... let the jaw open gently.
[pause 4s]
During the hold... stay in that silence... and let rise what wants to rise.
[pause 4s]
On the exhale... let go of what is not yours.
[pause 6s]

During the cycles... rest this silent question in the body.
[pause 5s]
Who am I truly made for?
[pause 7s]

We begin.
[BREATHING_CYCLES]
[pause 20s]

This calm... is you.
[pause 5s]
Simply you.
[pause 15s]

Let the breath return to its natural rhythm.
[pause 10s]

Stay here.
[pause 8s]
Without doing anything.
[pause 12s]

Let a memory come now.
[pause 6s]
A moment when you helped someone.
[pause 5s]
Not because you were asked.
[pause 4s]
Because you could not do otherwise.
[pause 10s]

What did you bring them in that moment?
[pause 15s]

Did it cost you something... or did it nourish you?
[pause 15s]

Think now of something you do with effortless ease.
[pause 5s]
Something obvious to you.
[pause 5s]
But that others seem to find difficult.
[pause 15s]

And think of a trial you have moved through.
[pause 5s]
Not to relive it.
[pause 4s]
But to see what it taught you... that you could not have understood otherwise.
[pause 15s]

These three things together...
[pause 5s]
the natural gift... the transformed trial... the need you see in others...
[pause 5s]
that is often where the mission hides.
[pause 12s]

You do not need to understand everything today.
[pause 5s]
The mission reveals itself as you walk.
[pause 4s]
As you serve.
[pause 4s]
As you transmit.
[pause 8s]

Write down what came... in your journal.
[pause 4s]
Then complete this sentence.
[pause 5s]
My presence in the lives of others... allows...
[pause 15s]

Let what comes... come.
[pause 5s]
Without correcting it.
[pause 5s]
Without judging it.
[pause 8s]

You have done rare work.
[pause 4s]
Something will remain.
[pause 8s]

See you soon... for the final module.
SCRIPT,

        // ─────────────────────────────────────────────────────────
        // MODULE 6 EN — "I Practice the Ritual" — target : 16–18 min
        // ─────────────────────────────────────────────────────────
        '07-je-transmets-le-rituel' => <<<'SCRIPT'
Welcome.
[pause 6s]

This is the final module.
[pause 5s]
Not because the path ends.
[pause 4s]
But because something has changed.
[pause 4s]
And from today... you walk differently.
[pause 12s]

Settle in.
[pause 3s]
Seated... back straight but alive.
[pause 4s]
Not the rigidity of a perfect posture.
[pause 3s]
The solidity of someone who knows they have something to offer.
[pause 7s]

Feet flat on the ground.
[pause 4s]
Feel their contact... their rootedness.
[pause 5s]
These feet have carried everything you have been through.
[pause 7s]

Hands resting on the thighs... open.
[pause 8s]

Before we begin...
[pause 3s]
Set an intention for this final module.
[pause 5s]
Perhaps... today I receive what I have sown.
[pause 5s]
Or simply... I let this path transform me for good.
[pause 12s]

Close your eyes.
[pause 8s]

Take a deep breath... and as you exhale... let go of everything the week has brought.
[pause 10s]

Feel the weight of the head.
[pause 4s]
The shoulders... the arms... the hands.
[pause 5s]
Let them grow heavy.
[pause 7s]

The belly.
[pause 4s]
It has held a lot during these modules.
[pause 4s]
Today... let it open.
[pause 8s]

The legs... the feet.
[pause 4s]
Whole.
[pause 4s]
Present.
[pause 4s]
Here.
[pause 12s]

Think for a moment of the first module.
[pause 5s]
Do you remember what you felt... the first time you settled in to listen?
[pause 8s]

It was not the same person.
[pause 5s]
Or rather... it was you.
[pause 4s]
But you did not know it yet.
[pause 10s]

You met yourself.
[pause 5s]
You looked at your wounds... without fleeing.
[pause 5s]
You described what truly nourishes you.
[pause 5s]
You listened to what your breath was trying to say.
[pause 5s]
You touched something that resembled your mission.
[pause 10s]

This is not a training.
[pause 5s]
It is a meeting with yourself.
[pause 5s]
And that... no amount of money can buy.
[pause 5s]
It cannot be purchased.
[pause 4s]
It must be lived.
[pause 12s]

This module is not a conclusion.
[pause 5s]
It is a transmission.
[pause 8s]

What you have lived here...
[pause 4s]
people around you need it.
[pause 5s]
Not so they do the same thing you did.
[pause 4s]
But so they find... their own path.
[pause 8s]

The presence you have cultivated here...
[pause 4s]
the calm you touch during the cycles...
[pause 4s]
the way you now look at what is happening inside you...
[pause 5s]
all of that transmits.
[pause 5s]
Effortlessly.
[pause 4s]
By contagion.
[pause 10s]

A practitioner does not guide others toward wisdom.
[pause 5s]
They guide others toward themselves.
[pause 5s]
And that is infinitely more powerful.
[pause 12s]

It is through the body that we seal this path.
[pause 8s]

We are going to practice the five-five-five method one final time here.
[pause 5s]

Five seconds to inhale.
[pause 2s]
Five seconds to hold.
[pause 2s]
Five seconds to exhale.
[pause 4s]
Ten cycles.
[pause 2s]
Two and a half minutes... to integrate everything that has been sown.
[pause 6s]

On the inhale... let the jaw open gently.
[pause 4s]
During the hold... stay in that silence... and let rise what you have received.
[pause 4s]
On the exhale... lips slightly narrowed... let go of what no longer belongs to who you are now.
[pause 6s]

During the cycles... do not search for anything.
[pause 4s]
Just let this question come... gently.
[pause 4s]
What am I holding now... that I was not holding at the start?
[pause 7s]

We begin.
[BREATHING_CYCLES]
[pause 20s]

This calm... is you.
[pause 5s]
Simply you.
[pause 15s]

Let the breath return to its natural rhythm.
[pause 10s]

Stay here.
[pause 8s]
Without doing anything.
[pause 12s]

What came during the cycles?
[pause 8s]
A word... an image... a name... a certainty?
[pause 8s]
Everything is right.
[pause 12s]

You are no longer a seeker.
[pause 6s]
You are a guide.
[pause 10s]

A guide does not possess the truth.
[pause 5s]
They create the conditions for another to find it within themselves.
[pause 5s]
As you have just done... for yourself.
[pause 10s]

The ritual you are going to practice... and transmit...
[pause 4s]
is not a technique.
[pause 4s]
It is a presence.
[pause 4s]
Your presence.
[pause 4s]
With what you have been through.
[pause 4s]
With what you have understood.
[pause 4s]
With what you carry now.
[pause 12s]

Let one last question come... without searching for the answer immediately.
[pause 8s]

Who do I need to pass on what I have received?
[pause 18s]

What do I want the people I accompany... to feel in my presence?
[pause 18s]

What is the first concrete step... I take starting tomorrow?
[pause 18s]

Write down what came... in your journal.
[pause 4s]
Without correcting it.
[pause 4s]
Without diminishing it.
[pause 8s]

Before finishing...
[pause 5s]
one sentence.
[pause 5s]
The one that has been with me from the beginning.
[pause 6s]

I ran for a very long time.
[pause 5s]
I stopped everything.
[pause 5s]
And that is where I found everything.
[pause 5s]
And infinitely more.
[pause 15s]

What you have touched here... in these modules...
[pause 5s]
you are now going to live with your whole body.
[pause 5s]
In space.
[pause 4s]
In nature.
[pause 4s]
With real silence... and a view you will never forget.
[pause 8s]

The retreat is the continuation of this path.
[pause 5s]
Not to learn something new.
[pause 4s]
But so that what you have understood... enters every cell of your body.
[pause 10s]

Your Pause Souffle Practitioner attestation is now available in your space.
[pause 6s]

You earned it.
[pause 5s]
Not because you listened to six modules.
[pause 5s]
But because you had the courage to stop.
[pause 5s]
To look.
[pause 4s]
To listen.
[pause 4s]
And to stay.
[pause 12s]

Thank you.
[pause 8s]
Truly.
SCRIPT,

        // ─────────────────────────────────────────────────────────
        // P1 — Module 03 — I Accept What I Cannot Change
        // ─────────────────────────────────────────────────────────
        '03-j-accepte-mes-limites' => <<<'SCRIPT'
Find a comfortable position.
[pause 5s]
Back straight... but not rigid.
[pause 4s]
Feet grounded.
[pause 4s]
Hands resting on your knees... palms open.
[pause 8s]

There is something you have been carrying for a long time.
[pause 6s]
Something you have tried to change... again and again.
[pause 5s]
And it hasn't changed.
[pause 8s]

This module doesn't ask you to be strong.
[pause 5s]
It asks something harder.
[pause 5s]
It asks you to let go.
[pause 12s]

Three breaths to begin.
[pause 4s]
Inhale slowly... for five counts.
[pause 7s]
Hold... two counts.
[pause 3s]
Exhale... for seven counts.
[pause 9s]
Again.
[pause 7s]
Inhale.
[pause 7s]
Hold.
[pause 3s]
Exhale.
[pause 9s]
One last time.
[pause 7s]
Inhale.
[pause 7s]
Hold.
[pause 3s]
Exhale... and let something go with this breath.
[pause 12s]

Epictetus was a slave.
[pause 6s]
He had no power over his outer circumstances.
[pause 5s]
None.
[pause 5s]
And yet... he formulated a truth that spans two thousand years.
[pause 8s]

There is what depends on us.
[pause 5s]
And what does not.
[pause 8s]
This distinction... as simple as it seems...
[pause 5s]
is one of the most powerful keys philosophy has ever produced.
[pause 10s]

Bring this question into your body... right now.
[pause 6s]
What are you carrying... that you cannot change?
[pause 8s]
Not in your mind.
[pause 4s]
In your body.
[pause 4s]
Where do you feel it?
[pause 4s]
In your throat?
[pause 3s]
In your chest?
[pause 3s]
In your shoulders?
[pause 8s]

Stay with that sensation.
[pause 5s]
Don't fight it.
[pause 5s]
Don't try to solve it.
[pause 5s]
Simply observe it... like a cloud passing through a vast sky.
[pause 12s]

ACT — Acceptance and Commitment Therapy —
[pause 4s]
has demonstrated across hundreds of studies what Epictetus knew through experience.
[pause 6s]
Resistance to what cannot be changed amplifies suffering.
[pause 5s]
It is not reality that breaks people.
[pause 5s]
It is the struggle against reality.
[pause 10s]

Three final breaths.
[pause 5s]
Inhale... welcoming what is.
[pause 7s]
Exhale... releasing what isn't.
[pause 9s]
Inhale.
[pause 7s]
Exhale.
[pause 9s]
Inhale one last time.
[pause 7s]
And exhale... slowly... completely.
[pause 12s]

This module is yours now.
[pause 6s]
The exercises are waiting.
[pause 5s]
Take the time to do them fully.
[pause 5s]
In presence.
[pause 10s]
SCRIPT,

        // ─────────────────────────────────────────────────────────
        // P1 — Module 04 — I Recognize What Drains Me
        // ─────────────────────────────────────────────────────────
        '04-je-reconnais-ce-qui-me-draine' => <<<'SCRIPT'
Settle in.
[pause 5s]
Breathe naturally first... without changing anything.
[pause 6s]
Just notice how you arrive here.
[pause 5s]
Tired... or present?
[pause 5s]
Agitated... or calm?
[pause 5s]
There is no right answer.
[pause 5s]
Just an honest observation.
[pause 10s]

Most people who feel exhausted believe they lack time.
[pause 6s]
They are wrong.
[pause 5s]
They lack energy.
[pause 5s]
That is a different problem entirely.
[pause 10s]

Three slow breaths.
[pause 4s]
Inhale for five counts.
[pause 7s]
Hold two counts.
[pause 3s]
Exhale for seven counts.
[pause 9s]
Again.
[pause 7s]
Inhale.
[pause 7s]
Hold.
[pause 3s]
Exhale.
[pause 9s]
Last one.
[pause 7s]
Inhale.
[pause 7s]
Hold.
[pause 3s]
Exhale... and let your body settle a little more.
[pause 12s]

Jim Loehr and Tony Schwartz spent twenty years studying elite athletes.
[pause 6s]
What they discovered wasn't about sport.
[pause 5s]
It was about everyone.
[pause 6s]
Human performance is not limited by time... nor by willpower.
[pause 5s]
It is limited by energy.
[pause 5s]
And energy has four reservoirs.
[pause 8s]

Physical. Emotional. Mental. And meaning.
[pause 8s]

Each reservoir can have leaks.
[pause 6s]
And often... it does.
[pause 5s]
Through drains you've never mapped.
[pause 10s]

Take a slow scan of your life as it is today.
[pause 6s]
Not as you'd like it to be.
[pause 5s]
As it is.
[pause 6s]

What depletes you?
[pause 8s]

People. Environments. Screens. Thoughts. Commitments.
[pause 10s]

Stay with what arises.
[pause 8s]
No judgment.
[pause 5s]
No solving.
[pause 5s]
Just see.
[pause 12s]

Three closing breaths.
[pause 5s]
Inhale.
[pause 7s]
Exhale.
[pause 9s]
Inhale.
[pause 7s]
Exhale.
[pause 9s]
Inhale deeply.
[pause 7s]
Exhale... slowly.
[pause 12s]
SCRIPT,

        // ─────────────────────────────────────────────────────────
        // P1 — Module 06 — I Embody My Vision
        // ─────────────────────────────────────────────────────────
        '06-je-visualise-ma-vie' => <<<'SCRIPT'
Settle comfortably.
[pause 5s]
Close your eyes if that feels natural.
[pause 5s]
Rest your hands on your thighs.
[pause 5s]
Feel the weight of your body.
[pause 8s]

This module works in the most intimate space there is.
[pause 6s]
The space of your vision.
[pause 5s]
What you truly want.
[pause 5s]
Not what others hope for you.
[pause 5s]
Not what society values by default.
[pause 6s]
What you feel is right from your deepest interior.
[pause 12s]

Three opening breaths.
[pause 4s]
Inhale for five.
[pause 7s]
Hold two.
[pause 3s]
Exhale for seven.
[pause 9s]
Again.
[pause 7s]
Inhale.
[pause 7s]
Hold.
[pause 3s]
Exhale.
[pause 9s]
Last time.
[pause 7s]
Inhale... as if welcoming something important.
[pause 7s]
Hold.
[pause 3s]
Exhale... opening.
[pause 12s]

Imagine five years have passed.
[pause 5s]
Five years of presence... conscious choices... courage.
[pause 8s]

Where are you?
[pause 5s]
Not the exact address.
[pause 4s]
The texture of the place.
[pause 4s]
The atmosphere.
[pause 4s]
What you see around you when you wake up.
[pause 10s]

Who is with you?
[pause 5s]
What relationships have depth in this life?
[pause 10s]

What fills your days?
[pause 5s]
Not a schedule.
[pause 4s]
A feeling.
[pause 4s]
Do you rise with momentum?
[pause 5s]
Does what you do carry meaning?
[pause 10s]

Stay in this image for a moment.
[pause 8s]
Let it take substance.
[pause 5s]
Colors. Sounds. Textures.
[pause 15s]

Three return breaths.
[pause 5s]
Inhale.
[pause 7s]
Exhale.
[pause 9s]
Inhale.
[pause 7s]
Exhale.
[pause 9s]
Inhale one last time.
[pause 7s]
Exhale slowly.
[pause 12s]
SCRIPT,

        // ─────────────────────────────────────────────────────────
        // PRACTITIONER — Module 07 — Mastering the Vision — Advanced Practice
        // ─────────────────────────────────────────────────────────
        '07-je-maitrise-la-vision' => <<<'SCRIPT'
Settle in.
[pause 5s]

You have learned to see.
[pause 5s]
Today... you learn to hold.
[pause 5s]
To hold a vision through time.
[pause 5s]
Even when fear returns.
[pause 5s]
Even when doubt settles in.
[pause 5s]
Even when reality resists.
[pause 10s]

Dr Joe Dispenza says the brain cannot distinguish between a lived experience and a deeply imagined one.
[pause 5s]
If you see precisely... with emotion... with repetition...
[pause 4s]
the brain begins to build the neural pathways of that reality.
[pause 5s]
Before it even exists.
[pause 10s]

That is what mastering the vision means.
[pause 5s]
Not positive thinking.
[pause 4s]
Neural training.
[pause 8s]

Close your eyes.
[pause 6s]

Conscious breathing... slow.
[pause 4s]
Inhale through the nose.
[pause 5s]
Exhale through the mouth.
[pause 5s]
Three cycles.
[pause 15s]

Now... bring the scene to mind.
[pause 5s]
The scene of your vision... as precise as possible.
[pause 5s]
Not a vague fantasy.
[pause 4s]
A concrete image.
[pause 4s]
Where are you?
[pause 5s]
What do you see exactly?
[pause 5s]
What do you hear?
[pause 5s]
What do you feel in your body?
[pause 8s]

Let the emotion come.
[pause 5s]
Do not force it.
[pause 5s]
Let it arise naturally... from the image.
[pause 10s]

It is through the body that we anchor this vision now.
[pause 8s]

We are going to practice the five-five-five method.
[pause 5s]

Five seconds to inhale.
[pause 2s]
Five seconds to hold.
[pause 2s]
Five seconds to exhale.
[pause 4s]
Ten cycles.
[pause 2s]
Two and a half minutes of presence inside this vision.
[pause 6s]

On the inhale... let the scene enter more deeply.
[pause 4s]
During the hold... hold that image in the silence.
[pause 4s]
On the exhale... let go of what still resists inside you.
[pause 6s]

We begin.
[BREATHING_CYCLES]
[pause 20s]

This calm... is the ground of your vision.
[pause 5s]
It grows here.
[pause 5s]
In this silence you just touched.
[pause 15s]

Let the breath return to its natural rhythm.
[pause 10s]

Stay here.
[pause 8s]
Without doing anything.
[pause 12s]

What appeared during the cycles?
[pause 8s]
A sharper image?
[pause 5s]
A resistance?
[pause 5s]
A certainty?
[pause 12s]

The vision is not mastered in one module.
[pause 5s]
It is practiced.
[pause 5s]
Every day.
[pause 5s]
Five to ten minutes.
[pause 5s]
The same scene.
[pause 5s]
The same emotion.
[pause 5s]
Until the body knows it by heart.
[pause 10s]

Write in your journal:
[pause 4s]
The scene you saw.
[pause 5s]
The emotion you touched.
[pause 5s]
What resisted.
[pause 8s]

See you tomorrow.
[pause 5s]
The vision is waiting for you.
[pause 10s]
SCRIPT,

        // ─────────────────────────────────────────────────────────
        // PRACTITIONER — Module 08 — Strengthening Discipline
        // ─────────────────────────────────────────────────────────
        '08-je-renforce-ma-discipline' => <<<'SCRIPT'
Settle in.
[pause 5s]

Discipline is not punishment.
[pause 5s]
It is an identity statement.
[pause 5s]
It says: I am someone who does what they decided.
[pause 5s]
Even without desire.
[pause 5s]
Even without applause.
[pause 5s]
Even without visible results.
[pause 10s]

Admiral McRaven, in his 2014 commencement address, said something simple.
[pause 5s]
Make your bed every morning.
[pause 5s]
This first act of discipline... sets the tone for the entire day.
[pause 5s]
It tells your brain: I am someone who finishes what they start.
[pause 10s]

James Clear, in Atomic Habits, goes further.
[pause 5s]
Identity precedes behavior.
[pause 5s]
You do not build habits to reach goals.
[pause 5s]
You build habits to become someone.
[pause 8s]

Close your eyes.
[pause 6s]

Conscious breathing.
[pause 4s]
Three slow cycles.
[pause 15s]

Think of an area of your life where you lack consistency.
[pause 8s]
Not to judge yourself.
[pause 5s]
To observe.
[pause 5s]
What gives way first?
[pause 5s]
Energy?
[pause 4s]
Motivation?
[pause 4s]
Clarity about the why?
[pause 10s]

It is through the body that we anchor this discipline now.
[pause 8s]

We are going to practice the five-five-five method.
[pause 5s]

Five seconds to inhale.
[pause 2s]
Five seconds to hold.
[pause 2s]
Five seconds to exhale.
[pause 4s]
Ten cycles.
[pause 2s]
Two and a half minutes to anchor the identity of the disciplined person you are becoming.
[pause 6s]

On the inhale... say inwardly: I am someone who holds.
[pause 4s]
During the hold... hold.
[pause 4s]
On the exhale... release what is no longer you.
[pause 6s]

We begin.
[BREATHING_CYCLES]
[pause 20s]

This calm... is discipline in its purest form.
[pause 5s]
Not effort.
[pause 5s]
Presence.
[pause 15s]

Let the breath return to its natural rhythm.
[pause 10s]

Stay here.
[pause 8s]
Without doing anything.
[pause 12s]

What is the daily ritual you commit to holding this week?
[pause 18s]

Not ten habits.
[pause 5s]
Just one.
[pause 5s]
That you will do even when you do not feel like it.
[pause 18s]

Write it in your journal.
[pause 5s]
With the time.
[pause 5s]
With the duration.
[pause 5s]
With the identity it builds.
[pause 8s]

Discipline... is tomorrow's freedom.
[pause 5s]
Start today.
[pause 10s]
SCRIPT,

        // ─────────────────────────────────────────────────────────
        // PRACTITIONER — Module 09 — I Transmit the Pause Souffle Ritual
        // ─────────────────────────────────────────────────────────
        '09-je-transmets-le-rituel' => <<<'SCRIPT'
[pause 30s]

What you just felt in that silence...
[pause 6s]
is exactly what your first client will feel facing you.
[pause 8s]

Not a speech.
[pause 3s]
Not a method.
[pause 3s]
Emptiness.
[pause 5s]
And the way you receive it... or flee from it.
[pause 10s]

Welcome to the final module of the Pause Souffle Practitioner training.
[pause 8s]

This module resembles no other.
[pause 5s]
Because it teaches you nothing.
[pause 4s]
It reveals what you already know.
[pause 12s]

─────────────────────────
[pause 2s]

Begin by observing your breath at this precise moment.
[pause 6s]
Do not modify it.
[pause 4s]
Simply observe.
[pause 8s]

Are you breathing from your chest?
[pause 5s]
Is your belly contracted?
[pause 5s]
Is your breath short... held... controlled?
[pause 8s]

What you observe right now...
[pause 5s]
is the state of your nervous system in this moment.
[pause 5s]
And your client — the first, the tenth, the hundredth —
[pause 4s]
will breathe exactly like this in the first minute with you.
[pause 6s]
They will copy your body.
[pause 4s]
Not your words.
[pause 4s]
Your body.
[pause 10s]

Your only work as a Pause Souffle practitioner...
[pause 5s]
is to bring your own breath down first.
[pause 5s]
Not to set an example.
[pause 4s]
Because your client's nervous system will attune to yours.
[pause 5s]
This is neurobiology.
[pause 4s]
This is also breath.
[pause 5s]
This is Pause Souffle.
[pause 15s]

─────────────────────────
[pause 2s]

Now I am going to ask you something unusual.
[pause 5s]
Not a visualization.
[pause 4s]
Not an affirmation.
[pause 5s]
A real experience.
[pause 8s]

Place both hands flat on your sternum.
[pause 5s]
Feel the warmth.
[pause 5s]
Feel the movement of breath beneath your palms.
[pause 8s]

Close your eyes.
[pause 5s]
And place before you — mentally, precisely —
[pause 4s]
a real person.
[pause 5s]
Their first name.
[pause 4s]
Their face.
[pause 4s]
Something they carry.
[pause 5s]
Something they do not yet say out loud.
[pause 10s]

You are not speaking to them.
[pause 5s]
You are not analyzing them.
[pause 5s]
You are simply there.
[pause 5s]
Two hands on your sternum.
[pause 4s]
Conscious breath.
[pause 4s]
Total presence.
[pause 12s]

Observe what happens in your body when you think about this person.
[pause 8s]
A slight tension in the shoulders?
[pause 5s]
An urge to help them immediately?
[pause 5s]
An impulse to find the right words?
[pause 8s]

What you feel right now...
[pause 5s]
is your practitioner pattern.
[pause 5s]
This is what you will need to tame.
[pause 5s]
Not correct.
[pause 4s]
Tame.
[pause 12s]

Let us practice together.
[pause 5s]
Deep inhale from the belly...
[pause 5s]
Hold...
[pause 5s]
Slow exhale...
[pause 5s]

[BREATHING_CYCLES]
[pause 15s]

Stay here.
[pause 8s]
Hands on the sternum.
[pause 5s]
That person before you.
[pause 5s]
Your breath descended.
[pause 5s]
Nothing to say.
[pause 5s]
Nothing to do.
[pause 5s]
Just be there.
[pause 15s]

This — what you just did —
[pause 4s]
is your first session.
[pause 6s]
It began now.
[pause 15s]

─────────────────────────
[pause 2s]

Here are three exercises.
[pause 5s]
They resemble nothing you have read elsewhere.
[pause 5s]
They belong to what you have crossed in these twelve modules.
[pause 10s]

FIRST EXERCISE — The witness breath.
[pause 8s]

Think of the last time a silence lasted too long in a conversation.
[pause 5s]
Not in a session.
[pause 4s]
In your life.
[pause 5s]
A family dinner. An argument. An awkward moment.
[pause 6s]

What did you do?
[pause 5s]
You spoke to fill it.
[pause 4s]
You laughed to defuse it.
[pause 4s]
You looked at your phone.
[pause 4s]
Or you stayed there, uncomfortable, waiting for it to pass.
[pause 8s]

That automatic gesture you had facing that silence...
[pause 5s]
your client will do it during your session.
[pause 6s]
And your role will not be to reassure them.
[pause 5s]
Your role will be to hold the space steady enough
[pause 4s]
that they do not need to flee.
[pause 8s]

Now — do this.
[pause 5s]
Inhale slowly.
[pause 4s]
And stay in the silence that follows.
[pause 4s]
Without filling it.
[pause 4s]
Without anticipating what comes next.
[pause 4s]
Just hold.
[pause 20s]

What you just practiced...
[pause 4s]
is the rarest skill in therapy.
[pause 5s]
Holding silence without being afraid of it.
[pause 5s]
You have just installed it in your body.
[pause 12s]

SECOND EXERCISE — The breath diagnosis.
[pause 8s]

This is not practiced with an imaginary client.
[pause 5s]
This is practiced on yourself. Now.
[pause 8s]

Place one hand on your belly.
[pause 4s]
One hand on your chest.
[pause 6s]

I am going to ask you a question.
[pause 4s]
Do not answer verbally.
[pause 4s]
Simply observe which hand moves first.
[pause 8s]

Here is the question.
[pause 5s]
What is the pattern this training has revealed in you...
[pause 5s]
that you will recognize in your clients?
[pause 20s]

Which hand moved?
[pause 6s]
If it was the chest — your answer comes from fear.
[pause 5s]
From the urgency to find the right answer.
[pause 5s]
If it was the belly — your answer comes from something truer.
[pause 5s]
Something you know without having learned it.
[pause 10s]

When your client asks you a difficult question during a session...
[pause 5s]
observe which hand would move first.
[pause 5s]
Not to analyze.
[pause 4s]
To know from which place you are responding.
[pause 12s]

THIRD EXERCISE — The first sentence.
[pause 8s]

This one is the hardest.
[pause 5s]
And the most important.
[pause 8s]

Someone says to you — and this person exists, you know them —
[pause 5s]
"Conscious breathing is nonsense.
[pause 3s]
Breath is automatic. It heals nothing."
[pause 8s]

You have fifteen seconds to find your first sentence.
[pause 4s]
Not an explanation.
[pause 4s]
Not a defense of the method.
[pause 4s]
A sentence that opens.
[pause 4s]
That does not close.
[pause 4s]
That leaves space for this person to stay in the conversation.
[pause 15s]

Take those fifteen seconds.
[pause 15s]

What you found...
[pause 5s]
is your practitioner identity.
[pause 5s]
Not a learned speech.
[pause 4s]
A way of being in the presence of another person's doubt.
[pause 5s]
Write it down.
[pause 5s]
This is your first sentence as a practitioner.
[pause 12s]

─────────────────────────
[pause 2s]

You have crossed twelve modules.
[pause 6s]
Not to accumulate knowledge.
[pause 5s]
To transform the way you are present to a body.
[pause 5s]
To a person.
[pause 5s]
To a breath trying to say something.
[pause 10s]

There is a paradox at the heart of what you are about to do.
[pause 6s]
You are going to transmit silence...
[pause 5s]
to people who have built their entire lives to avoid it.
[pause 8s]

They will resist.
[pause 4s]
Not against you.
[pause 4s]
Against themselves.
[pause 6s]
Against everything they feel when the noise stops.
[pause 8s]

And your ability to stay there, steady, without filling that void...
[pause 5s]
is exactly what you have trained.
[pause 5s]
Module after module.
[pause 4s]
Breath after breath.
[pause 12s]

You are not a healer.
[pause 6s]
You are a witness.
[pause 6s]
The breath does the work.
[pause 5s]
Your role is to create a space silent enough
[pause 4s]
that your client's breath dares to tell the truth.
[pause 12s]

You have permission to be imperfect in front of your clients.
[pause 6s]
Breath does not ask for perfection.
[pause 5s]
It asks for honesty.
[pause 6s]
A practitioner who says "I don't know"
[pause 4s]
while holding the space without letting go...
[pause 4s]
is worth infinitely more than a practitioner who has an answer for everything
[pause 4s]
and proves it in every session.
[pause 12s]

─────────────────────────
[pause 2s]

Here is what I ask of you to finish.
[pause 6s]

Place both hands on your sternum.
[pause 5s]
Feel your breath.
[pause 5s]
Not the ideal breath.
[pause 4s]
Yours. Now. As it is.
[pause 10s]

And say inwardly the first name of the first person you are going to accompany.
[pause 5s]
Not tomorrow.
[pause 4s]
The first one.
[pause 5s]
The one you see when you close your eyes and think about why you did this training.
[pause 20s]

It is not I who certifies you.
[pause 6s]
It is this breath — yours — that has just recognized you.
[pause 20s]

Your Pause Souffle Practitioner attestation is available in your space.
[pause 8s]

Thank you for holding.
[pause 15s]
SCRIPT,

        // ─────────────────────────────────────────────────────────
        // PARCOURS — Module 29 (ord) — 12-je-transmets-le-rituel EN
        // ─────────────────────────────────────────────────────────
        '12-je-transmets-le-rituel' => <<<'SCRIPT'
Settle in.
[pause 5s]
Not the end of a list.
[pause 4s]
The end of a crossing.
[pause 10s]

Let me remind you where you came from.
[pause 8s]

In the first module... you placed your hands on a living body with real consciousness for the first time.
[pause 5s]
You understood that breath is not breathed — it is received.
[pause 5s]
You learned anatomy not to know... but to feel.
[pause 10s]

Then you turned toward yourself.
[pause 5s]
You dared to look at your wounds, your blind spots, your ways of avoiding.
[pause 5s]
Not to correct yourself.
[pause 4s]
To know yourself.
[pause 5s]
Because a practitioner who does not know themselves... accompanies from their fears.
[pause 10s]

You mastered the tools of breath.
[pause 5s]
Heart coherence. Conscious breathing. The protocol.
[pause 5s]
And you understood something few therapists truly know:
[pause 5s]
A tool is only as valuable as the presence of the hand that holds it.
[pause 10s]

You worked on your vision.
[pause 5s]
Not a surface vision... "I want to help people."
[pause 5s]
A vision rooted in what you have been through.
[pause 5s]
In what you know about breath because you have inhabited it.
[pause 10s]

You strengthened your discipline.
[pause 5s]
Not the discipline that forces itself.
[pause 4s]
The one that is chosen.
[pause 5s]
Every morning. Every practice. Every time you wanted to stop... and kept going.
[pause 10s]

Then you entered the modules that are frightening.
[pause 5s]
The practitioner's posture.
[pause 4s]
How you hold your body when someone entrusts theirs to you.
[pause 5s]
How your voice carries without crushing.
[pause 5s]
How your presence begins to heal before you have even spoken a word.
[pause 10s]

You learned to read a client.
[pause 5s]
Not to judge them. Not to diagnose them.
[pause 4s]
To receive them as they are... and to adapt what you know to what they are living.
[pause 10s]

You built your professional practice.
[pause 5s]
The foundations. The framework. The rates. The communication.
[pause 5s]
You understood that the professional and the sacred are not opposites.
[pause 5s]
That a well-built practice is an act of love toward your future clients.
[pause 10s]

You looked squarely at limits, contraindications, responsibility.
[pause 5s]
This is the module many avoid.
[pause 5s]
You crossed through it.
[pause 5s]
And that is precisely what makes you trustworthy.
[pause 10s]

You meditated on the care relationship.
[pause 5s]
On what truly heals in an accompaniment.
[pause 5s]
It is not the technique.
[pause 4s]
It is the quality of presence.
[pause 5s]
It is the fact that a person feels seen... without being analyzed.
[pause 10s]

You found your signature.
[pause 5s]
What is uniquely yours in the way you accompany.
[pause 5s]
What no one else can reproduce...
[pause 4s]
because no one else has lived exactly what you have lived.
[pause 10s]

And you faced the money of care.
[pause 5s]
You understood that you deserve to be compensated for what you give.
[pause 5s]
That value is not in the number of hours... but in the transformation you make possible.
[pause 10s]

That is your path.
[pause 8s]
Twelve modules. Twelve facets of the same diamond.
[pause 5s]
And now... you transmit.
[pause 12s]

Settle in one last time in this training space.
[pause 5s]
Back straight and alive.
[pause 4s]
Feet grounded.
[pause 4s]
Palms open on your knees.
[pause 8s]

We are going to practice together the ritual that is at the heart of everything you are going to transmit.
[pause 5s]
The five-five-five method.
[pause 5s]
Five seconds of inhale.
[pause 2s]
Five seconds of hold.
[pause 2s]
Five seconds of exhale.
[pause 4s]
Ten cycles.
[pause 4s]
Not to calm yourself down.
[pause 3s]
To remind yourself who you are.
[pause 8s]

Inhale deeply...
[pause 5s]
Hold...
[pause 5s]
Release slowly...
[pause 5s]

[BREATHING_CYCLES]
[pause 20s]

Stay here.
[pause 8s]
In this silence that now belongs to you.
[pause 15s]

What you feel right now...
[pause 5s]
is what you are going to transmit.
[pause 8s]
Not techniques.
[pause 4s]
Not protocols.
[pause 4s]
This.
[pause 5s]
This space.
[pause 5s]
This quality of presence to oneself.
[pause 12s]

Let the breath return to its natural rhythm.
[pause 10s]

There is a question I need to ask you.
[pause 5s]
Take your time answering it.
[pause 8s]

Who is the human being — a specific, real person — to whom you want to transmit what you have just received?
[pause 20s]

What do you want them to feel in the first minute spent with you?
[pause 20s]

And what do you want them to carry from your accompaniment... in six months... in a year?
[pause 20s]

Write these answers.
[pause 5s]
Now. Before you close this space.
[pause 5s]
These are the foundations of your practitioner commitment.
[pause 15s]

You are a Pause Souffle practitioner.
[pause 6s]
Not because a certificate says so.
[pause 5s]
Because you have crossed what many dare not cross.
[pause 5s]
You looked at yourself honestly.
[pause 5s]
You learned. Practiced. Doubted. Continued.
[pause 8s]

The world needs people who know how to create silence.
[pause 5s]
Who know how to hold a space without filling it.
[pause 5s]
Who know how to accompany without imposing.
[pause 8s]

You are that person.
[pause 10s]

Your Pause Souffle Practitioner attestation is available in your space.
[pause 5s]

Thank you for being here.
[pause 5s]
Thank you for continuing.
[pause 15s]
SCRIPT,

        // ─────────────────────────────────────────────────────────
        // PARCOURS — Module 29 (ord) — 12-je-transmets-le-rituel EN
        // ─────────────────────────────────────────────────────────
        '12-je-transmets-le-rituel' => <<<'SCRIPT'
Settle in.
[pause 5s]

This module marks a particular moment in your journey.
[pause 5s]
You have traveled twenty-nine weeks.
[pause 5s]
You have worked your body.
[pause 5s]
Your breath.
[pause 5s]
Your relationships.
[pause 5s]
Your identity.
[pause 10s]

Today... you transmit.
[pause 5s]
Not because you have understood everything.
[pause 5s]
But because you have crossed.
[pause 5s]
And crossing... can be taught.
[pause 10s]

The Pause Souffle ritual you are going to guide is not a technique.
[pause 5s]
It is a presence.
[pause 5s]
Your presence.
[pause 5s]
With what you have lived.
[pause 8s]

Close your eyes.
[pause 6s]

Three conscious breaths to arrive here.
[pause 15s]

It is through the body that we anchor this step.
[pause 8s]

We are going to practice the five-five-five method.
[pause 5s]

Five seconds to inhale.
[pause 2s]
Five seconds to hold.
[pause 2s]
Five seconds to exhale.
[pause 4s]
Ten cycles.
[pause 2s]
Two and a half minutes of pure presence.
[pause 6s]

On the inhale... receive what you have sown.
[pause 4s]
During the hold... hold it in the silence.
[pause 4s]
On the exhale... let it radiate toward those around you.
[pause 6s]

We begin.
[BREATHING_CYCLES]
[pause 20s]

This calm... is you.
[pause 5s]
Simply you.
[pause 15s]

Let the breath return to its natural rhythm.
[pause 10s]

Stay here.
[pause 8s]
Without doing anything.
[pause 12s]

What have you received in this journey that you want to offer?
[pause 18s]

To whom?
[pause 18s]

How?
[pause 18s]

Write what came in your journal.
[pause 5s]
Without correcting it.
[pause 8s]

Thank you for being here.
[pause 5s]
Carry on.
[pause 10s]
SCRIPT,

        // ─────────────────────────────────────────────────────────
        // P1 — Module 07 — I Take Care of Myself First
        // ─────────────────────────────────────────────────────────
        '07-je-prends-soin-de-moi' => <<<'SCRIPT'
Set everything down.
[pause 5s]
What you carry for others.
[pause 4s]
What you finish before taking care of yourself.
[pause 4s]
What is waiting for your attention.
[pause 6s]
Set it all down... just for now.
[pause 10s]

Three breaths.
[pause 4s]
Inhale for five.
[pause 7s]
Hold two.
[pause 3s]
Exhale for seven.
[pause 9s]
Again.
[pause 7s]
Inhale.
[pause 7s]
Hold.
[pause 3s]
Exhale.
[pause 9s]
Last one.
[pause 7s]
Inhale... for yourself.
[pause 7s]
Hold.
[pause 3s]
Exhale.
[pause 12s]

The oxygen mask image from the airplane is not a pleasant metaphor.
[pause 6s]
It's a biological truth.
[pause 5s]
If you lose consciousness... you can do nothing for anyone.
[pause 6s]
If you're chronically exhausted... you give others a depleted version of yourself.
[pause 10s]

Ask honestly.
[pause 6s]
Do I truly take care of myself?
[pause 8s]
Do I sleep enough?
[pause 5s]
Do I eat to nourish my body?
[pause 5s]
Do I move?
[pause 5s]
Do I have moments of real rest?
[pause 10s]

And this deeper question.
[pause 6s]
Do I allow myself to receive?
[pause 5s]
Not just to give.
[pause 5s]
To receive help.
[pause 4s]
Pleasure.
[pause 4s]
Rest... without justifying it.
[pause 10s]

Three closing breaths.
[pause 5s]
Inhale... receiving.
[pause 7s]
Exhale... releasing something.
[pause 9s]
Inhale.
[pause 7s]
Exhale.
[pause 9s]
Inhale one last time.
[pause 7s]
Exhale slowly.
[pause 12s]
SCRIPT,

        // ─────────────────────────────────────────────────────────
        // P1 — Module 08 — Gratitude and Intention
        // ─────────────────────────────────────────────────────────
        '08-gratitude-et-intention' => <<<'SCRIPT'
This module works on two key moments of each day.
[pause 5s]
The evening... and the morning.
[pause 5s]
How you close a day.
[pause 4s]
And how you open the next one.
[pause 10s]

These two moments... repeated consciously...
[pause 5s]
transform the texture of your life in less than three weeks.
[pause 10s]

Settle in.
[pause 5s]
Inhale for five.
[pause 7s]
Hold two.
[pause 3s]
Exhale for seven.
[pause 9s]
Again.
[pause 7s]
Inhale.
[pause 7s]
Hold.
[pause 3s]
Exhale.
[pause 9s]
Last one.
[pause 7s]
Inhale.
[pause 7s]
Hold.
[pause 3s]
Exhale.
[pause 12s]

Robert Emmons... at the University of California...
[pause 5s]
spent twenty years studying gratitude scientifically.
[pause 5s]
Not gratitude as a passive feeling.
[pause 5s]
Gratitude as an active practice.
[pause 8s]

His key discovery is simple and radical.
[pause 6s]
People who practice gratitude regularly...
[pause 5s]
sleep better.
[pause 4s]
Have stronger relationships.
[pause 4s]
Are more resilient to difficult events.
[pause 4s]
And report significantly higher life satisfaction.
[pause 8s]

Effective gratitude is not general.
[pause 5s]
It is specific.
[pause 5s]
Not... I am grateful for my life.
[pause 5s]
But... today at 2:30 pm... when this person said this to me...
[pause 4s]
I felt something real.
[pause 8s]

Three breaths of gratitude.
[pause 4s]
Inhale... thinking of something specific you're grateful for.
[pause 9s]
Hold that feeling.
[pause 3s]
Exhale... letting it settle in your body.
[pause 10s]
Again.
[pause 7s]
Inhale.
[pause 7s]
Hold.
[pause 3s]
Exhale.
[pause 10s]
Last breath.
[pause 7s]
Hold.
[pause 3s]
Exhale slowly.
[pause 12s]
SCRIPT,

        // ─────────────────────────────────────────────────────────
        // P2 — Module 09 — My Priorities First
        // ─────────────────────────────────────────────────────────
        '09-mes-priorites-dabord' => <<<'SCRIPT'
Settle in.
[pause 5s]
Back straight. Feet grounded. Hands resting.
[pause 6s]
Breathe naturally for a moment before we begin.
[pause 8s]

This module asks a question that unsettles.
[pause 6s]
If you don't build your own dreams...
[pause 5s]
someone will hire you to build theirs.
[pause 8s]
Tony Gaskins.
[pause 5s]
A short sentence.
[pause 4s]
A long truth.
[pause 10s]

Three breaths.
[pause 4s]
Inhale for five.
[pause 7s]
Hold two.
[pause 3s]
Exhale for seven.
[pause 9s]
Again.
[pause 7s]
Inhale.
[pause 7s]
Hold.
[pause 3s]
Exhale.
[pause 9s]
Last one.
[pause 7s]
Inhale.
[pause 7s]
Hold.
[pause 3s]
Exhale.
[pause 12s]

Eisenhower had a tool.
[pause 5s]
A matrix of four quadrants.
[pause 5s]
Urgent and important.
[pause 4s]
Important but not urgent.
[pause 4s]
Urgent but not important.
[pause 4s]
Neither urgent nor important.
[pause 8s]

Most people spend their lives in the first quadrant.
[pause 5s]
Urgency.
[pause 5s]
Always reactive.
[pause 4s]
Always firefighting.
[pause 4s]
Always responding to what others define as urgent.
[pause 8s]

The second quadrant is the most valuable.
[pause 6s]
What is important... but not urgent.
[pause 5s]
Health. Deep relationships. Learning. The life project. Prevention.
[pause 6s]
Everything that builds something lasting.
[pause 8s]

And because it is not urgent...
[pause 5s]
it is precisely what gets sacrificed.
[pause 5s]
To what shouts the loudest.
[pause 10s]

Ask yourself now.
[pause 6s]
In the last seven days...
[pause 5s]
how many hours did you spend in Quadrant 2?
[pause 10s]

Your time reflects your real priorities.
[pause 6s]
Not the ones you declare.
[pause 5s]
The ones you demonstrate... hour by hour.
[pause 10s]

Three closing breaths.
[pause 5s]
Inhale.
[pause 7s]
Exhale.
[pause 9s]
Inhale.
[pause 7s]
Exhale.
[pause 9s]
Inhale once more.
[pause 7s]
Exhale slowly.
[pause 12s]
SCRIPT,

        // ─────────────────────────────────────────────────────────
        // P2 — Module 12 — Mastering My Time
        // ─────────────────────────────────────────────────────────
        '12-maitriser-son-temps' => <<<'SCRIPT'
Settle in.
[pause 5s]
You have the same number of hours as Darwin.
[pause 5s]
As Mozart.
[pause 5s]
As Marie Curie.
[pause 5s]
Twenty-four hours.
[pause 5s]
Not one more.
[pause 10s]

Three breaths.
[pause 4s]
Inhale for five.
[pause 7s]
Hold two.
[pause 3s]
Exhale for seven.
[pause 9s]
Again.
[pause 7s]
Inhale.
[pause 7s]
Hold.
[pause 3s]
Exhale.
[pause 9s]
Last one.
[pause 7s]
Inhale.
[pause 7s]
Hold.
[pause 3s]
Exhale.
[pause 12s]

Cal Newport studied the geniuses of history.
[pause 5s]
Darwin worked four hours a day.
[pause 5s]
Really.
[pause 5s]
Blocks of total concentration... no distractions... no meetings.
[pause 5s]
The rest was walks... observations... recovery.
[pause 8s]

Newport calls this Deep Work.
[pause 5s]
The ability to focus without distraction on a cognitively demanding task.
[pause 6s]
This capacity has become rare.
[pause 5s]
And it has become valuable.
[pause 10s]

Parkinson observed something strange.
[pause 6s]
Work expands to fill the time available for its completion.
[pause 5s]
If you have three hours for a task... it takes three hours.
[pause 5s]
If you have six... it takes six.
[pause 5s]
Same result. Double the time.
[pause 8s]

The counter-intuitive conclusion...
[pause 5s]
is that having more time does not produce a better result.
[pause 5s]
It produces procrastination. Perfectionism. Shallow work.
[pause 10s]

Ask yourself now.
[pause 6s]
How many hours of true deep focus do I get each week?
[pause 5s]
Not screen presence.
[pause 5s]
Real concentration. No phone. No notifications.
[pause 8s]

Most people discover it's less than one hour a day.
[pause 6s]
Even working ten hours.
[pause 10s]

Three closing breaths.
[pause 5s]
Inhale.
[pause 7s]
Exhale.
[pause 9s]
Inhale.
[pause 7s]
Exhale.
[pause 9s]
Inhale.
[pause 7s]
Exhale slowly.
[pause 12s]
SCRIPT,

        // ─────────────────────────────────────────────────────────
        // P2 — Module 13 — Managing My Finances
        // ─────────────────────────────────────────────────────────
        '13-gerer-ses-finances' => <<<'SCRIPT'
Settle in.
[pause 5s]
This module touches something few spaces address honestly.
[pause 5s]
Money.
[pause 5s]
Not as a math problem.
[pause 5s]
But as a psychological one.
[pause 10s]

Three breaths.
[pause 4s]
Inhale for five.
[pause 7s]
Hold two.
[pause 3s]
Exhale for seven.
[pause 9s]
Again.
[pause 7s]
Inhale.
[pause 7s]
Hold.
[pause 3s]
Exhale.
[pause 9s]
Last.
[pause 7s]
Inhale.
[pause 7s]
Hold.
[pause 3s]
Exhale.
[pause 12s]

Brad Klontz spent years studying financial psychology.
[pause 5s]
His discovery...
[pause 4s]
four unconscious scripts inherited from family and culture...
[pause 5s]
drive nearly all of our financial behaviors.
[pause 8s]

Money Avoidance.
[pause 4s]
Money is bad. Rich people are corrupt. I don't deserve it.
[pause 8s]

Money Worship.
[pause 4s]
More money... more happiness. The problem will be solved when I have more.
[pause 8s]

Money Status.
[pause 4s]
My worth equals what I spend... what I own.
[pause 8s]

Money Vigilance.
[pause 4s]
Money can disappear. Save everything.
[pause 4s]
Chronic anxiety. Mistrust of all.
[pause 10s]

Which one resonates most?
[pause 5s]
Where do you come from... with money?
[pause 5s]
What were you taught... explicitly or silently?
[pause 10s]

Stay with these questions.
[pause 8s]
Without solving.
[pause 5s]
Just hold them.
[pause 12s]

Three closing breaths.
[pause 5s]
Inhale.
[pause 7s]
Exhale.
[pause 9s]
Inhale.
[pause 7s]
Exhale.
[pause 9s]
Inhale.
[pause 7s]
Exhale slowly.
[pause 12s]
SCRIPT,

        // ─────────────────────────────────────────────────────────
        // P2 — Module 10 — A Clean and Organized Space
        // ─────────────────────────────────────────────────────────
        '10-interieur-propre-et-range' => <<<'SCRIPT'
Close your eyes.
[pause 5s]
Think about the state of your living space this morning.
[pause 6s]
Not a judgment.
[pause 4s]
Just an observation.
[pause 5s]
What you see when you enter.
[pause 5s]
What you sense.
[pause 5s]
The texture of that space on your inner state.
[pause 10s]

Three breaths.
[pause 4s]
Inhale for five.
[pause 7s]
Hold two.
[pause 3s]
Exhale for seven.
[pause 9s]
Again.
[pause 7s]
Inhale.
[pause 7s]
Hold.
[pause 3s]
Exhale.
[pause 9s]
Last.
[pause 7s]
Inhale.
[pause 7s]
Hold.
[pause 3s]
Exhale.
[pause 12s]

The outer space reflects the inner space.
[pause 6s]
This is not a metaphor.
[pause 5s]
It is neurological data.
[pause 5s]
Our brain constantly perceives the environment around it.
[pause 5s]
And it responds.
[pause 5s]
A cluttered space generates a background cognitive load.
[pause 5s]
Permanent. Invisible. But real.
[pause 10s]

Marie Kondo popularized a simple idea.
[pause 5s]
Keep what sparks joy.
[pause 5s]
Release the rest.
[pause 5s]
Not as a tidying technique.
[pause 5s]
As a practice of awareness.
[pause 8s]

The discipline that begins at home...
[pause 5s]
is the most honest discipline.
[pause 5s]
Because it cannot be performed for others.
[pause 5s]
It is entirely for you.
[pause 10s]

Three closing breaths.
[pause 5s]
Inhale.
[pause 7s]
Exhale.
[pause 9s]
Inhale.
[pause 7s]
Exhale.
[pause 9s]
Inhale.
[pause 7s]
Exhale slowly.
[pause 12s]
SCRIPT,

        // ─────────────────────────────────────────────────────────
        // P3 — Module 27 — Chosen Solitude
        // ─────────────────────────────────────────────────────────
        '27-solitude-choisie' => <<<'SCRIPT'
Settle in.
[pause 5s]
And for once... do nothing else.
[pause 5s]
Just be here.
[pause 5s]
With yourself.
[pause 10s]

This module asks something counter-cultural.
[pause 6s]
To learn how to be alone.
[pause 5s]
By choice.
[pause 5s]
And find something precious in it.
[pause 10s]

Three breaths.
[pause 4s]
Inhale for five.
[pause 7s]
Hold two.
[pause 3s]
Exhale for seven.
[pause 9s]
Again.
[pause 7s]
Inhale.
[pause 7s]
Hold.
[pause 3s]
Exhale.
[pause 9s]
Last.
[pause 7s]
Inhale.
[pause 7s]
Hold.
[pause 3s]
Exhale.
[pause 12s]

Winnicott was a pediatrician and psychoanalyst.
[pause 5s]
In 1958... he presented what would become a cornerstone of developmental psychology.
[pause 6s]
The capacity to be alone...
[pause 4s]
is one of the most important signs of emotional maturity.
[pause 8s]

The Winnicott paradox.
[pause 5s]
This capacity to be alone... always develops in the presence of someone.
[pause 5s]
The child learns to be alone...
[pause 5s]
because they have the inner certainty that someone is there if needed.
[pause 8s]

If solitude consistently generates anxiety in you...
[pause 5s]
it's not a fatality.
[pause 5s]
It's a skill that didn't get to build.
[pause 5s]
And it can still be learned.
[pause 10s]

Notice now.
[pause 6s]
If you are alone in this moment...
[pause 5s]
what does it generate in your body?
[pause 6s]
Restlessness? Discomfort? The urge to check your phone?
[pause 6s]
Or something more neutral... even calm?
[pause 10s]

Three closing breaths.
[pause 5s]
Inhale.
[pause 7s]
Exhale.
[pause 9s]
Inhale.
[pause 7s]
Exhale.
[pause 9s]
Inhale once more.
[pause 7s]
Exhale slowly.
[pause 12s]
SCRIPT,

        // ─────────────────────────────────────────────────────────
        // P3 — Module 36 — The Meaning of My Life
        // ─────────────────────────────────────────────────────────
        '36-sens-de-la-vie' => <<<'SCRIPT'
Settle in.
[pause 5s]
Close your eyes.
[pause 5s]
And let this question come... without forcing.
[pause 6s]

For what... exactly... am I living?
[pause 12s]

This is not the question of depression.
[pause 5s]
It is the question of maturity.
[pause 5s]
The one that arrives when masks have served their time.
[pause 5s]
When goals achieved no longer fill the space.
[pause 5s]
When life asks something truer than performance.
[pause 10s]

Three deep breaths.
[pause 4s]
Inhale for five.
[pause 7s]
Hold two.
[pause 3s]
Exhale for seven.
[pause 9s]
Again.
[pause 7s]
Inhale.
[pause 7s]
Hold.
[pause 3s]
Exhale.
[pause 9s]
Last.
[pause 7s]
Inhale.
[pause 7s]
Hold.
[pause 3s]
Exhale.
[pause 12s]

Viktor Frankl was a psychiatrist in Vienna.
[pause 5s]
In 1942... he was deported to Auschwitz.
[pause 5s]
He had lost his family.
[pause 5s]
He had lost everything.
[pause 6s]
And in that context of absolute annihilation...
[pause 5s]
he observed who survived mentally... and who gave up.
[pause 8s]

It was not the strongest physically.
[pause 5s]
It was those who had a reason.
[pause 5s]
A why.
[pause 5s]
A meaning that held.
[pause 10s]

He who has a why...
[pause 4s]
can bear almost any how.
[pause 6s]
Nietzsche... echoed by Frankl.
[pause 5s]
Validated by the worst conditions humanity has ever known.
[pause 10s]

Ask Yalom's question now.
[pause 6s]
If you knew you would die in a year...
[pause 5s]
what would you do differently?
[pause 15s]

And this other question.
[pause 6s]
In thirty years...
[pause 4s]
what is the story you want to be able to tell about your life?
[pause 15s]

Three closing breaths.
[pause 5s]
Inhale.
[pause 7s]
Exhale.
[pause 9s]
Inhale.
[pause 7s]
Exhale.
[pause 9s]
Inhale once more.
[pause 7s]
Exhale slowly.
[pause 12s]
SCRIPT,

        // ─────────────────────────────────────────────────────────
        // P2 — Movement and Posture
        // ─────────────────────────────────────────────────────────
        '07-mouvement-et-posture' => <<<'SCRIPT'
Close your eyes if that's natural.
[pause 5s]
Feel your body as it is right now.
[pause 6s]
Without modifying it.
[pause 5s]
Just observe.
[pause 5s]
Are you tense somewhere?
[pause 5s]
In your shoulders? Jaw? Neck?
[pause 8s]

Three breaths.
[pause 4s]
Inhale for five.
[pause 7s]
Hold two.
[pause 3s]
Exhale for seven.
[pause 9s]
Again.
[pause 7s]
Inhale.
[pause 7s]
Hold.
[pause 3s]
Exhale.
[pause 9s]
Last.
[pause 7s]
Inhale.
[pause 7s]
Hold.
[pause 3s]
Exhale.
[pause 12s]

The human body was designed to move.
[pause 5s]
For two million years... our ancestors walked eight to fifteen kilometers a day.
[pause 6s]
They carried. They ran. They climbed. They crouched.
[pause 6s]
Then in a few decades... we created a world where someone can spend an entire day barely moving.
[pause 8s]

Our nervous system hasn't had time to evolve.
[pause 5s]
It perceives sedentariness as a threat.
[pause 5s]
Sedentarity increases cortisol.
[pause 4s]
Reduces neural connections.
[pause 4s]
Fragments sleep.
[pause 4s]
Amplifies anxiety.
[pause 8s]

Amy Cuddy — Harvard — showed that two minutes in a contracted posture is enough to alter your hormones.
[pause 5s]
Shoulders in. Head down. Chest closed.
[pause 5s]
Cortisol rises. Testosterone drops. Confidence diminishes.
[pause 8s]

Do this now.
[pause 4s]
Straighten up slightly.
[pause 4s]
Open your chest.
[pause 4s]
Draw your shoulders back gently.
[pause 4s]
Lift your chin slightly.
[pause 6s]
Stay in this posture.
[pause 8s]

Notice the difference... even small... in your inner state.
[pause 10s]

Three closing breaths.
[pause 5s]
Inhale.
[pause 7s]
Exhale.
[pause 9s]
Inhale.
[pause 7s]
Exhale.
[pause 9s]
Inhale.
[pause 7s]
Exhale slowly.
[pause 12s]
SCRIPT,

        // ─────────────────────────────────────────────────────────
        // P2 — The Autonomic Nervous System
        // ─────────────────────────────────────────────────────────
        '08-systeme-nerveux' => <<<'SCRIPT'
Settle in.
[pause 5s]
Before we begin... place both hands on your belly.
[pause 6s]
Feel the movement of your breath beneath your palms.
[pause 6s]
Just that.
[pause 5s]
Nothing else for now.
[pause 12s]

Three breaths.
[pause 4s]
Inhale for five.
[pause 7s]
Hold two.
[pause 3s]
Exhale for seven.
[pause 9s]
Again.
[pause 7s]
Inhale.
[pause 7s]
Hold.
[pause 3s]
Exhale.
[pause 9s]
Last.
[pause 7s]
Inhale.
[pause 7s]
Hold.
[pause 3s]
Exhale.
[pause 12s]

The autonomic nervous system has two main branches.
[pause 6s]
The sympathetic. The accelerator.
[pause 4s]
Fight or flight. Cortisol. Adrenaline. Vigilance. Tension.
[pause 4s]
Designed to respond to danger... for a few minutes.
[pause 8s]

And the parasympathetic. The brake.
[pause 4s]
Rest and digest.
[pause 4s]
Oxytocin. Serotonin. Recovery. Presence.
[pause 4s]
Designed to restore... integrate... regenerate.
[pause 8s]

Stephen Porges added a third branch.
[pause 5s]
The social engagement circuit.
[pause 5s]
The state in which we are capable of connection... curiosity... joy.
[pause 5s]
Trust.
[pause 5s]
This is our optimal state of human functioning.
[pause 10s]

The problem of our era...
[pause 5s]
is that our bodies live in chronic sympathetic mode.
[pause 5s]
Without real danger.
[pause 4s]
But with a permanent load of notifications... comparisons... urgencies...
[pause 5s]
keeping the accelerator pressed... without ever finding the brake.
[pause 10s]

Three techniques directly activate the parasympathetic.
[pause 6s]
Long breathing. Movement. Connection to the living.
[pause 10s]

Three closing breaths.
[pause 5s]
Inhale.
[pause 7s]
Exhale.
[pause 9s]
Inhale.
[pause 7s]
Exhale.
[pause 9s]
Inhale.
[pause 7s]
Exhale slowly.
[pause 12s]
SCRIPT,

        // ─────────────────────────────────────────────────────────
        // P2 — Emotional Regulation
        // ─────────────────────────────────────────────────────────
        '09-gestion-des-emotions' => <<<'SCRIPT'
Settle in.
[pause 5s]
Breathe normally.
[pause 5s]
And ask yourself honestly.
[pause 5s]
What emotion is present right now?
[pause 8s]

Not the emotion you should feel.
[pause 5s]
Not the acceptable one.
[pause 5s]
The one that's there.
[pause 10s]

Three breaths.
[pause 4s]
Inhale for five.
[pause 7s]
Hold two.
[pause 3s]
Exhale for seven.
[pause 9s]
Again.
[pause 7s]
Inhale.
[pause 7s]
Hold.
[pause 3s]
Exhale.
[pause 9s]
Last.
[pause 7s]
Inhale.
[pause 7s]
Hold.
[pause 3s]
Exhale.
[pause 12s]

Emotions are not enemies.
[pause 5s]
They are messengers.
[pause 5s]
They have a precise biological function.
[pause 5s]
Fear protects you. Anger defends your boundaries.
[pause 4s]
Sadness integrates loss. Joy reinforces what nourishes.
[pause 8s]

The problem is not having emotions.
[pause 5s]
It's not knowing what to do with them.
[pause 5s]
Suffering them. Suppressing them. Or amplifying them through rumination.
[pause 8s]

Paul Ekman identified six universal emotions.
[pause 5s]
Present in every culture on earth.
[pause 5s]
Anger. Fear. Sadness. Joy. Disgust. Surprise.
[pause 6s]
They express in the body before reaching consciousness.
[pause 8s]

Neuroimaging studies show that...
[pause 5s]
naming an emotion reduces its intensity.
[pause 5s]
Putting words on what we feel activates the prefrontal cortex.
[pause 5s]
And reduces amygdala activity.
[pause 10s]

You don't have to control what you feel.
[pause 5s]
You have to allow yourself to feel it... consciously.
[pause 5s]
And choose what you do with it.
[pause 5s]
Not in reaction. In response.
[pause 10s]

Three closing breaths.
[pause 5s]
Inhale.
[pause 7s]
Exhale.
[pause 9s]
Inhale.
[pause 7s]
Exhale.
[pause 9s]
Inhale.
[pause 7s]
Exhale slowly.
[pause 12s]
SCRIPT,

        // ─────────────────────────────────────────────────────────
        // P2 — Living Here and Now
        // ─────────────────────────────────────────────────────────
        '10-vivre-ici-et-maintenant' => <<<'SCRIPT'
Put down what you have in hand.
[pause 5s]
Literally.
[pause 4s]
Feel your feet on the floor.
[pause 5s]
The contact of your back on the chair.
[pause 6s]
The temperature of the air.
[pause 5s]
The sounds around you... without judging.
[pause 8s]

You are here. Now.
[pause 5s]
The only moment that truly exists.
[pause 10s]

Three breaths.
[pause 4s]
Inhale for five.
[pause 7s]
Hold two.
[pause 3s]
Exhale for seven.
[pause 9s]
Again.
[pause 7s]
Inhale.
[pause 7s]
Hold.
[pause 3s]
Exhale.
[pause 9s]
Last.
[pause 7s]
Inhale.
[pause 7s]
Hold.
[pause 3s]
Exhale.
[pause 12s]

A Harvard study by Killingsworth and Gilbert found...
[pause 5s]
that human minds wander forty-seven percent of the time.
[pause 6s]
Nearly half the time... people are thinking about something other than what they're doing.
[pause 8s]

And the conclusion?
[pause 5s]
This mind-wandering is associated with significantly lower well-being.
[pause 5s]
Regardless of the activity.
[pause 5s]
Even unpleasant activities... experienced with presence...
[pause 5s]
produced more well-being than pleasant activities lived in distraction.
[pause 10s]

Jon Kabat-Zinn said it simply.
[pause 5s]
You can't stop the waves.
[pause 5s]
But you can learn to surf.
[pause 10s]

Notice now.
[pause 5s]
Where is your mind?
[pause 5s]
Is it here... with this meditation?
[pause 5s]
Or has it wandered somewhere else?
[pause 6s]
No judgment.
[pause 4s]
If you left... the simple noticing is the return.
[pause 10s]

Three closing breaths.
[pause 5s]
Inhale.
[pause 7s]
Exhale.
[pause 9s]
Inhale.
[pause 7s]
Exhale.
[pause 9s]
Inhale.
[pause 7s]
Exhale slowly.
[pause 12s]
SCRIPT,

        // ─────────────────────────────────────────────────────────
        // P2 — Sleep and Recovery
        // ─────────────────────────────────────────────────────────
        '10-sommeil-et-recuperation' => <<<'SCRIPT'
Settle in.
[pause 5s]
This module can be listened to in the evening before sleep.
[pause 5s]
Or at any other time.
[pause 5s]
But if you're here in the evening... let your body grow heavier.
[pause 5s]
Let your eyelids become heavy if they wish.
[pause 10s]

Three breaths.
[pause 4s]
Inhale for five.
[pause 7s]
Hold two.
[pause 3s]
Exhale for eight.
[pause 10s]
Again.
[pause 7s]
Inhale.
[pause 7s]
Hold.
[pause 3s]
Exhale.
[pause 10s]
Last.
[pause 7s]
Inhale.
[pause 7s]
Hold.
[pause 3s]
Exhale.
[pause 12s]

Matthew Walker... neuroscientist at Berkeley...
[pause 5s]
spent his career studying sleep.
[pause 5s]
His conclusion is unambiguous.
[pause 5s]
Sleep is not a luxury.
[pause 5s]
It is the biological foundation of everything else.
[pause 8s]

In one night of poor sleep...
[pause 5s]
your attention capacity drops thirty percent.
[pause 5s]
Your emotional regulation collapses.
[pause 5s]
Your immune system slows.
[pause 5s]
And your decisions are measurably worse.
[pause 8s]

Sleep is not passive time.
[pause 5s]
It is when the brain literally cleans itself.
[pause 5s]
The glymphatic system activates.
[pause 5s]
Metabolic waste... including proteins linked to Alzheimer's...
[pause 5s]
are evacuated only during deep sleep.
[pause 8s]

Three slow breaths.
[pause 5s]
Inhale slowly.
[pause 7s]
Exhale even more slowly.
[pause 10s]
Inhale.
[pause 7s]
Exhale.
[pause 10s]
Inhale one last time.
[pause 7s]
Exhale... letting yourself drift toward rest.
[pause 12s]
SCRIPT,

        // ─────────────────────────────────────────────────────────
        // P2 — Relationship with Food
        // ─────────────────────────────────────────────────────────
        '11-relation-alimentation' => <<<'SCRIPT'
Settle in.
[pause 5s]
Before we begin... ask yourself without defense.
[pause 6s]
What is my true relationship with food?
[pause 8s]
Not what I eat.
[pause 5s]
But why I eat... when... and how.
[pause 10s]

Three breaths.
[pause 4s]
Inhale for five.
[pause 7s]
Hold two.
[pause 3s]
Exhale for seven.
[pause 9s]
Again.
[pause 7s]
Inhale.
[pause 7s]
Hold.
[pause 3s]
Exhale.
[pause 9s]
Last.
[pause 7s]
Inhale.
[pause 7s]
Hold.
[pause 3s]
Exhale.
[pause 12s]

There is a fundamental difference between nourishing and eating.
[pause 6s]
Nourishing... is providing what the body needs to function and repair.
[pause 5s]
Eating... is everything else.
[pause 5s]
Filling boredom. Managing stress. Celebrating. Punishing. Belonging to a group.
[pause 8s]

Most problematic eating behaviors don't have a nutritional cause.
[pause 5s]
They have an emotional one. Relational. Psychological.
[pause 8s]

Mindful eating... slowly... without a screen... with attention...
[pause 5s]
reduces caloric intake by twenty to thirty percent.
[pause 5s]
Not by restriction.
[pause 5s]
By real satiety.
[pause 5s]
Because the body can finally be heard.
[pause 10s]

Notice the next time you eat.
[pause 5s]
Are you hungry... or feeling something else?
[pause 6s]
Are you eating in presence... or on autopilot?
[pause 10s]

Three closing breaths.
[pause 5s]
Inhale.
[pause 7s]
Exhale.
[pause 9s]
Inhale.
[pause 7s]
Exhale.
[pause 9s]
Inhale.
[pause 7s]
Exhale slowly.
[pause 12s]
SCRIPT,

        // ─────────────────────────────────────────────────────────
        // P2 — Physical Activity
        // ─────────────────────────────────────────────────────────
        '15-activite-physique' => <<<'SCRIPT'
Settle in. Breathe.
[pause 6s]
And let me share something most people don't know.
[pause 8s]

Physical exercise is the most effective antidepressant ever studied.
[pause 5s]
Not a metaphor.
[pause 5s]
Data from meta-analysis.
[pause 5s]
More effective than some medications... with no side effects.
[pause 10s]

Three breaths.
[pause 4s]
Inhale for five.
[pause 7s]
Hold two.
[pause 3s]
Exhale for seven.
[pause 9s]
Again.
[pause 7s]
Inhale.
[pause 7s]
Hold.
[pause 3s]
Exhale.
[pause 9s]
Last.
[pause 7s]
Inhale.
[pause 7s]
Hold.
[pause 3s]
Exhale.
[pause 12s]

Blumenthal at Duke ran a rigorous study.
[pause 5s]
Moderate to severe depression. Three groups.
[pause 4s]
Medication only. Exercise only. Medication and exercise.
[pause 6s]
At six months... the exercise-only group had the same results as medication.
[pause 5s]
And the relapse rate... in that group... was the lowest of all.
[pause 10s]

Why?
[pause 5s]
Because exercise generates BDNF.
[pause 5s]
Brain-Derived Neurotrophic Factor.
[pause 5s]
What John Ratey calls Miracle-Gro for the brain.
[pause 5s]
A neuronal growth factor that strengthens connections... improves memory... and reduces anxiety.
[pause 8s]

One hundred and fifty minutes per week at moderate intensity.
[pause 5s]
Thirty minutes five times a week.
[pause 5s]
No gym required. No equipment.
[pause 5s]
A brisk walk... a bike... a swim... a dance.
[pause 5s]
Your body doesn't need performance.
[pause 5s]
It needs movement.
[pause 10s]

Three closing breaths.
[pause 5s]
Inhale.
[pause 7s]
Exhale.
[pause 9s]
Inhale.
[pause 7s]
Exhale.
[pause 9s]
Inhale.
[pause 7s]
Exhale slowly.
[pause 12s]
SCRIPT,

        // ─────────────────────────────────────────────────────────
        // P2 — Nutrition and Vitality
        // ─────────────────────────────────────────────────────────
        '22-nutrition-et-vitalite' => <<<'SCRIPT'
Settle in.
[pause 5s]
Place your hands on your belly.
[pause 5s]
Feel the movement of your breath.
[pause 8s]

Your gut contains around one hundred million neurons.
[pause 5s]
It produces more than ninety-five percent of your body's serotonin.
[pause 5s]
What you eat directly affects what you feel.
[pause 5s]
Not indirectly.
[pause 5s]
Directly.
[pause 10s]

Three breaths.
[pause 4s]
Inhale for five.
[pause 7s]
Hold two.
[pause 3s]
Exhale for seven.
[pause 9s]
Again.
[pause 7s]
Inhale.
[pause 7s]
Hold.
[pause 3s]
Exhale.
[pause 9s]
Last.
[pause 7s]
Inhale.
[pause 7s]
Hold.
[pause 3s]
Exhale.
[pause 12s]

This module doesn't talk about calories.
[pause 5s]
It talks about information.
[pause 5s]
Food is a signal.
[pause 5s]
Every meal tells something to your cells... hormones... microbiome... mood.
[pause 8s]

Fast sugars create insulin spikes...
[pause 5s]
followed by crashes... followed by cravings... followed by spikes again.
[pause 5s]
A cycle that silently drives your energy, concentration and mood.
[pause 8s]

Quality fats... omega-3s... fiber... polyphenols...
[pause 5s]
nourish the microbiome.
[pause 5s]
Reduce chronic inflammation.
[pause 5s]
Support neurotransmitter production.
[pause 8s]

This is not discipline.
[pause 5s]
It is biochemistry.
[pause 5s]
And when you understand what each food actually does...
[pause 5s]
choices naturally become different.
[pause 10s]

Three closing breaths.
[pause 5s]
Inhale.
[pause 7s]
Exhale.
[pause 9s]
Inhale.
[pause 7s]
Exhale.
[pause 9s]
Inhale.
[pause 7s]
Exhale slowly.
[pause 12s]
SCRIPT,

        // ─────────────────────────────────────────────────────────
        // P2 — Complementary Medicine
        // ─────────────────────────────────────────────────────────
        '19-medecines-complementaires' => <<<'SCRIPT'
Settle in. Breathe naturally.
[pause 6s]
And let this module invite you to broaden your perspective.
[pause 8s]

Conventional medicine is magnificent for emergencies.
[pause 5s]
For infections. Surgery. Acute conditions.
[pause 5s]
It saves lives every day.
[pause 8s]

But for chronic health...
[pause 5s]
For lasting well-being...
[pause 5s]
For functional imbalances that don't find an answer in the classical bio-medical model...
[pause 6s]
other approaches deserve to be known.
[pause 10s]

Three breaths.
[pause 4s]
Inhale for five.
[pause 7s]
Hold two.
[pause 3s]
Exhale for seven.
[pause 9s]
Again.
[pause 7s]
Inhale.
[pause 7s]
Hold.
[pause 3s]
Exhale.
[pause 9s]
Last.
[pause 7s]
Inhale.
[pause 7s]
Hold.
[pause 3s]
Exhale.
[pause 12s]

Osteopathy. Naturopathy. Acupuncture. Meditation and yoga.
[pause 6s]
Each with growing evidence for specific indications.
[pause 5s]
Each offering something conventional medicine often doesn't... time, context, the person.
[pause 8s]

This module doesn't prescribe anything.
[pause 5s]
It informs you.
[pause 5s]
So you can choose wisely...
[pause 5s]
rather than navigating by chance or by advertising.
[pause 8s]

Your health is a territory.
[pause 5s]
Knowledge is your best map.
[pause 10s]

Three closing breaths.
[pause 5s]
Inhale.
[pause 7s]
Exhale.
[pause 9s]
Inhale.
[pause 7s]
Exhale.
[pause 9s]
Inhale.
[pause 7s]
Exhale slowly.
[pause 12s]
SCRIPT,

        // ─────────────────────────────────────────────────────────
        // P3 — Presence to Self
        // ─────────────────────────────────────────────────────────
        '12-presence-a-soi' => <<<'SCRIPT'
Settle in.
[pause 5s]
Close your eyes.
[pause 5s]
And ask this gentle question.
[pause 6s]
How am I truly feeling... right now?
[pause 10s]

Not what you think you should feel.
[pause 5s]
What is here.
[pause 10s]

Three breaths.
[pause 4s]
Inhale for five.
[pause 7s]
Hold two.
[pause 3s]
Exhale for seven.
[pause 9s]
Again.
[pause 7s]
Inhale.
[pause 7s]
Hold.
[pause 3s]
Exhale.
[pause 9s]
Last.
[pause 7s]
Inhale.
[pause 7s]
Hold.
[pause 3s]
Exhale.
[pause 12s]

Presence to self is a form of inner perception.
[pause 6s]
Researchers call it interoception.
[pause 5s]
The ability to perceive the internal signals of the body.
[pause 5s]
Heart rate. Muscle tension. Hunger. Fatigue.
[pause 4s]
Emotional states before they become conscious.
[pause 8s]

This capacity predicts...
[pause 5s]
emotional regulation. Decision quality. Stress resilience. Depth of relationships.
[pause 8s]

But in our hyperconnected world...
[pause 5s]
we are trained to look outward.
[pause 5s]
To check what others think. To seek validation.
[pause 4s]
To fill silence with noise.
[pause 6s]
And this constant outward attention weakens the inner muscle.
[pause 8s]

This module is a return.
[pause 5s]
A return to self.
[pause 5s]
Not as a retreat from the world.
[pause 5s]
But as an anchor permitting full presence in the world.
[pause 10s]

Three closing breaths.
[pause 5s]
Inhale.
[pause 7s]
Exhale.
[pause 9s]
Inhale.
[pause 7s]
Exhale.
[pause 9s]
Inhale.
[pause 7s]
Exhale slowly.
[pause 12s]
SCRIPT,

        // ─────────────────────────────────────────────────────────
        // P3 — Body Confidence
        // ─────────────────────────────────────────────────────────
        '13-confiance-corporelle' => <<<'SCRIPT'
Settle in. Breathe.
[pause 6s]
And without judging... turn your inner attention to your body.
[pause 6s]
Not aesthetically.
[pause 4s]
Functionally.
[pause 5s]
This body that carries you.
[pause 4s]
That breathes without your asking.
[pause 4s]
That heals your small wounds daily.
[pause 4s]
That regulates your temperature.
[pause 4s]
That processes billions of pieces of information right now.
[pause 8s]

Three breaths.
[pause 4s]
Inhale for five.
[pause 7s]
Hold two.
[pause 3s]
Exhale for seven.
[pause 9s]
Again.
[pause 7s]
Inhale.
[pause 7s]
Hold.
[pause 3s]
Exhale.
[pause 9s]
Last.
[pause 7s]
Inhale.
[pause 7s]
Hold.
[pause 3s]
Exhale.
[pause 12s]

Body confidence is not about shape.
[pause 5s]
It's about relationship.
[pause 5s]
The relationship you have with your own body.
[pause 8s]

For many of us... that relationship was disrupted early.
[pause 5s]
By looks. Comments. Comparisons. Cultural messages about what a body should be.
[pause 6s]
And we learned to see our body as a problem to fix...
[pause 5s]
rather than a partner to respect.
[pause 10s]

Kristin Neff's research on self-compassion shows that...
[pause 5s]
treating yourself with the same kindness as a friend...
[pause 5s]
reduces body anxiety... improves self-image...
[pause 5s]
and paradoxically... improves health behaviors.
[pause 8s]

Place one hand on a part of your body now.
[pause 5s]
Any part.
[pause 5s]
And send it... even for a moment... some gratitude.
[pause 6s]
For what it does. For what it endures. For what it allows you.
[pause 12s]

Three closing breaths.
[pause 5s]
Inhale.
[pause 7s]
Exhale.
[pause 9s]
Inhale.
[pause 7s]
Exhale.
[pause 9s]
Inhale.
[pause 7s]
Exhale slowly.
[pause 12s]
SCRIPT,

        // ─────────────────────────────────────────────────────────
        // P3 — Social Interactions
        // ─────────────────────────────────────────────────────────
        '14-interactions-sociales' => <<<'SCRIPT'
Settle in.
[pause 5s]
Think of someone in your life who does you good.
[pause 6s]
Not a perfect person.
[pause 4s]
Someone whose presence is nourishing.
[pause 6s]
Notice what it generates in your body... just thinking of them.
[pause 10s]

Three breaths.
[pause 4s]
Inhale for five.
[pause 7s]
Hold two.
[pause 3s]
Exhale for seven.
[pause 9s]
Again.
[pause 7s]
Inhale.
[pause 7s]
Hold.
[pause 3s]
Exhale.
[pause 9s]
Last.
[pause 7s]
Inhale.
[pause 7s]
Hold.
[pause 3s]
Exhale.
[pause 12s]

Humans are an ultra-social species.
[pause 5s]
Our brain co-evolved with community.
[pause 5s]
For a hundred thousand years... being alone was dangerous.
[pause 5s]
Belonging was a matter of survival.
[pause 8s]

Matthew Lieberman at UCLA demonstrated through neuroimaging...
[pause 5s]
that the brain processes social exclusion...
[pause 5s]
in the same zones as physical pain.
[pause 5s]
Social pain is real pain.
[pause 5s]
And connection activates the same circuits as food and warmth.
[pause 8s]

This module gives you tools to map your relationships.
[pause 5s]
Identify those that nourish.
[pause 4s]
Understand those that drain.
[pause 4s]
And navigate social interactions with more fluidity and less wasted energy.
[pause 10s]

Three closing breaths.
[pause 5s]
Inhale.
[pause 7s]
Exhale.
[pause 9s]
Inhale.
[pause 7s]
Exhale.
[pause 9s]
Inhale.
[pause 7s]
Exhale slowly.
[pause 12s]
SCRIPT,

        // ─────────────────────────────────────────────────────────
        // P3 — Leisure and Fulfillment
        // ─────────────────────────────────────────────────────────
        '16-loisirs-et-vie' => <<<'SCRIPT'
Settle in.
[pause 5s]
Think of the last time you did something... purely for pleasure.
[pause 7s]
No goal. No result. No productivity.
[pause 4s]
Just because it felt good.
[pause 8s]

When was that?
[pause 10s]

Three breaths.
[pause 4s]
Inhale for five.
[pause 7s]
Hold two.
[pause 3s]
Exhale for seven.
[pause 9s]
Again.
[pause 7s]
Inhale.
[pause 7s]
Hold.
[pause 3s]
Exhale.
[pause 9s]
Last.
[pause 7s]
Inhale.
[pause 7s]
Hold.
[pause 3s]
Exhale.
[pause 12s]

Mihaly Csikszentmihalyi studied optimal experience.
[pause 5s]
What he calls flow.
[pause 8s]

Flow is a state of complete absorption in an activity.
[pause 5s]
Where the ego steps back.
[pause 4s]
Time loses its density.
[pause 4s]
Effort and ease blur.
[pause 4s]
And one experiences what he describes as deep and authentic happiness.
[pause 8s]

Flow occurs when the challenge level slightly matches your skill level.
[pause 5s]
Too easy... boredom.
[pause 4s]
Too hard... anxiety.
[pause 5s]
At just the right point... flow.
[pause 8s]

His counter-intuitive observation...
[pause 6s]
people report more flow at work than in leisure.
[pause 5s]
Yet they choose to watch television rather than do the activity that makes them thrive.
[pause 5s]
Because flow has an entry cost.
[pause 4s]
It demands attention. It demands beginning.
[pause 6s]
Passivity demands nothing.
[pause 8s]

Identify your flow activities.
[pause 5s]
And give them a real place in your schedule.
[pause 5s]
Not by chance.
[pause 5s]
By choice.
[pause 10s]

Three closing breaths.
[pause 5s]
Inhale.
[pause 7s]
Exhale.
[pause 9s]
Inhale.
[pause 7s]
Exhale.
[pause 9s]
Inhale.
[pause 7s]
Exhale slowly.
[pause 12s]
SCRIPT,

        // ─────────────────────────────────────────────────────────
        // P3 — Screen Traps
        // ─────────────────────────────────────────────────────────
        '32-pieges-ecrans' => <<<'SCRIPT'
Settle in.
[pause 5s]
Put your phone face down.
[pause 5s]
If you're using it to listen to this module... place it nearby but away from your gaze.
[pause 6s]
Notice if a slight resistance arises.
[pause 5s]
That resistance is already information.
[pause 10s]

Three breaths.
[pause 4s]
Inhale for five.
[pause 7s]
Hold two.
[pause 3s]
Exhale for seven.
[pause 9s]
Again.
[pause 7s]
Inhale.
[pause 7s]
Hold.
[pause 3s]
Exhale.
[pause 9s]
Last.
[pause 7s]
Inhale.
[pause 7s]
Hold.
[pause 3s]
Exhale.
[pause 12s]

Digital technologies are not neutral.
[pause 5s]
They were designed... by entire teams of neuroscientists and psychologists... to capture your attention.
[pause 6s]
Tristan Harris... former designer at Google... called this the persuasive model.
[pause 5s]
These systems don't try to make you happy.
[pause 5s]
They try to maximize the time you spend on them.
[pause 5s]
And happiness and engagement are not the same thing.
[pause 8s]

Dopamine is the neurotransmitter of anticipation.
[pause 5s]
Not pleasure.
[pause 5s]
Anticipation of pleasure.
[pause 5s]
Every notification... infinite scroll... uncertain like...
[pause 5s]
exploits exactly this mechanism.
[pause 5s]
The same mechanism as slot machines.
[pause 8s]

This module doesn't ask you to delete your apps.
[pause 5s]
It invites you to take back control.
[pause 5s]
To use consciously.
[pause 4s]
Rather than being used.
[pause 10s]

Three closing breaths.
[pause 5s]
Inhale.
[pause 7s]
Exhale.
[pause 9s]
Inhale.
[pause 7s]
Exhale.
[pause 9s]
Inhale.
[pause 7s]
Exhale slowly.
[pause 12s]
SCRIPT,

        // ─────────────────────────────────────────────────────────
        // P3 — Relationship with Others
        // ─────────────────────────────────────────────────────────
        '17-relation-a-lautre' => <<<'SCRIPT'
Settle in. Breathe.
[pause 6s]
And think of the most important relationship in your life.
[pause 5s]
Not necessarily romantic.
[pause 4s]
The one that touches you most deeply.
[pause 5s]
That defines you. That transformed you.
[pause 8s]

What did it teach you about yourself?
[pause 10s]

Three breaths.
[pause 4s]
Inhale for five.
[pause 7s]
Hold two.
[pause 3s]
Exhale for seven.
[pause 9s]
Again.
[pause 7s]
Inhale.
[pause 7s]
Hold.
[pause 3s]
Exhale.
[pause 9s]
Last.
[pause 7s]
Inhale.
[pause 7s]
Hold.
[pause 3s]
Exhale.
[pause 12s]

Relationships don't just reveal us.
[pause 5s]
They build us.
[pause 5s]
It is impossible to become fully oneself in isolation.
[pause 5s]
We see ourselves in the gaze of the other.
[pause 5s]
We discover ourselves in reaction.
[pause 5s]
We learn our patterns in friction.
[pause 8s]

John Gottman at the University of Washington...
[pause 5s]
studied thousands of couples over decades.
[pause 5s]
He can predict with over eighty percent accuracy...
[pause 5s]
whether a couple will separate...
[pause 5s]
just by observing a few minutes of interaction.
[pause 8s]

His main discovery?
[pause 5s]
It's not conflict that destroys relationships.
[pause 5s]
It's contempt.
[pause 5s]
And its opposite... the daily habit of turning toward.
[pause 5s]
Small moments of responding to a bid for connection.
[pause 8s]

Three closing breaths.
[pause 5s]
Inhale.
[pause 7s]
Exhale.
[pause 9s]
Inhale.
[pause 7s]
Exhale.
[pause 9s]
Inhale.
[pause 7s]
Exhale slowly.
[pause 12s]
SCRIPT,

        // ─────────────────────────────────────────────────────────
        // P3 — Intimacy and Relational Energy
        // ─────────────────────────────────────────────────────────
        '18-intimite-et-energie' => <<<'SCRIPT'
Settle in.
[pause 5s]
This module touches something intimate.
[pause 5s]
Not only physical intimacy.
[pause 4s]
Intimacy as a capacity.
[pause 4s]
The ability to let another truly see you.
[pause 5s]
And to see yourself in that reflection.
[pause 10s]

Three breaths.
[pause 4s]
Inhale for five.
[pause 7s]
Hold two.
[pause 3s]
Exhale for seven.
[pause 9s]
Again.
[pause 7s]
Inhale.
[pause 7s]
Hold.
[pause 3s]
Exhale.
[pause 9s]
Last.
[pause 7s]
Inhale.
[pause 7s]
Hold.
[pause 3s]
Exhale.
[pause 12s]

Brené Brown spent years studying vulnerability.
[pause 5s]
Her conclusion disturbs those who seek strength through control.
[pause 6s]
Vulnerability is not weakness.
[pause 5s]
It is the source of authentic connection.
[pause 5s]
Of creativity. Of love. Of meaning.
[pause 8s]

Those who avoid vulnerability don't avoid pain.
[pause 5s]
They also avoid joy.
[pause 5s]
And depth.
[pause 8s]

This module invites you to explore...
[pause 5s]
your capacity to be seen.
[pause 5s]
And to truly see.
[pause 5s]
Not through expectations.
[pause 4s]
Not through fears.
[pause 5s]
But in direct presence.
[pause 10s]

Three closing breaths.
[pause 5s]
Inhale.
[pause 7s]
Exhale.
[pause 9s]
Inhale.
[pause 7s]
Exhale.
[pause 9s]
Inhale.
[pause 7s]
Exhale slowly.
[pause 12s]
SCRIPT,

        // ─────────────────────────────────────────────────────────
        // P3 — Living, Choosing, Rebuilding
        // ─────────────────────────────────────────────────────────
        '20-vivre-choisir-reconstruire' => <<<'SCRIPT'
Settle in.
[pause 5s]
Think of a moment in your life when you had to rebuild.
[pause 7s]
A breakup. A loss. A failure. A departure.
[pause 5s]
That moment when you were no longer sure who you were... or where to go.
[pause 10s]

You are here now.
[pause 5s]
That moment is part of you.
[pause 5s]
It didn't destroy you.
[pause 5s]
It passed through you.
[pause 10s]

Three breaths.
[pause 4s]
Inhale for five.
[pause 7s]
Hold two.
[pause 3s]
Exhale for seven.
[pause 9s]
Again.
[pause 7s]
Inhale.
[pause 7s]
Hold.
[pause 3s]
Exhale.
[pause 9s]
Last.
[pause 7s]
Inhale.
[pause 7s]
Hold.
[pause 3s]
Exhale.
[pause 12s]

Kintsugi is a Japanese practice.
[pause 5s]
When a ceramic breaks... it is repaired with gold.
[pause 5s]
The scar becomes the ornament.
[pause 5s]
Fragility... transformed... becomes the most precious part.
[pause 8s]

Tedeschi and Calhoun call it Post-Traumatic Growth.
[pause 5s]
After trauma... some people don't return to baseline.
[pause 4s]
They surpass it.
[pause 5s]
Greater depth in relationships. More intense appreciation of life.
[pause 4s]
Discovered personal strength. New horizons.
[pause 8s]

This module invites you to look at your fractures with different eyes.
[pause 5s]
Not to minimize what you experienced.
[pause 5s]
But to recognize what you are capable of doing with it.
[pause 10s]

Three closing breaths.
[pause 5s]
Inhale.
[pause 7s]
Exhale.
[pause 9s]
Inhale.
[pause 7s]
Exhale.
[pause 9s]
Inhale.
[pause 7s]
Exhale slowly.
[pause 12s]
SCRIPT,

        // ─────────────────────────────────────────────────────────
        // P3 — Love in the Disposable Age
        // ─────────────────────────────────────────────────────────
        '31-amour-ere-jetable' => <<<'SCRIPT'
Settle in.
[pause 5s]
This module addresses delicate territory.
[pause 5s]
Love in an age that makes everything disposable.
[pause 6s]
Objects. Jobs. And sometimes relationships.
[pause 8s]

Three breaths.
[pause 4s]
Inhale for five.
[pause 7s]
Hold two.
[pause 3s]
Exhale for seven.
[pause 9s]
Again.
[pause 7s]
Inhale.
[pause 7s]
Hold.
[pause 3s]
Exhale.
[pause 9s]
Last.
[pause 7s]
Inhale.
[pause 7s]
Hold.
[pause 3s]
Exhale.
[pause 12s]

Zygmunt Bauman spoke of liquid modernity.
[pause 5s]
A world without solid. Without anchor.
[pause 4s]
Where everything can be swapped... replaced... optimized.
[pause 5s]
And relationships... in this context... are subject to market logic.
[pause 5s]
Permanent comparison. Infinite availability. Minimized exit cost.
[pause 8s]

And yet.
[pause 5s]
The Harvard Grant Study...
[pause 5s]
the longest study on human happiness ever conducted...
[pause 5s]
seventy years of follow-up...
[pause 5s]
concluded what all cultures knew intuitively.
[pause 6s]
The quality of relationships is the most determining factor of human happiness.
[pause 5s]
More than wealth. More than fame. More than physical health.
[pause 8s]

Not the number of relationships.
[pause 5s]
Their depth. Their warmth. Their safety.
[pause 10s]

This module invites you to reflect... and choose.
[pause 5s]
Not the orthodoxy of the past.
[pause 5s]
Not the liquidity of the present.
[pause 5s]
But your own philosophy of commitment.
[pause 10s]

Three closing breaths.
[pause 5s]
Inhale.
[pause 7s]
Exhale.
[pause 9s]
Inhale.
[pause 7s]
Exhale.
[pause 9s]
Inhale.
[pause 7s]
Exhale slowly.
[pause 12s]
SCRIPT,

        // ─────────────────────────────────────────────────────────
        // P3 — Sacrificed Education
        // ─────────────────────────────────────────────────────────
        '33-education-sacrifiee' => <<<'SCRIPT'
Settle in.
[pause 5s]
This module speaks of transmission.
[pause 5s]
What we give... what we receive.
[pause 5s]
And what we can choose to transmit differently.
[pause 10s]

Three breaths.
[pause 4s]
Inhale for five.
[pause 7s]
Hold two.
[pause 3s]
Exhale for seven.
[pause 9s]
Again.
[pause 7s]
Inhale.
[pause 7s]
Hold.
[pause 3s]
Exhale.
[pause 9s]
Last.
[pause 7s]
Inhale.
[pause 7s]
Hold.
[pause 3s]
Exhale.
[pause 12s]

There is what we want to pass on to our children.
[pause 5s]
And there is what we actually transmit.
[pause 5s]
These two things are not always the same.
[pause 8s]

Winnicott had the concept of the good enough parent.
[pause 5s]
Not perfect.
[pause 4s]
Sufficiently present. Sufficiently available. Sufficiently repairing.
[pause 8s]

Parental perfectionism is often a projection.
[pause 5s]
Wanting for the child what we couldn't have.
[pause 5s]
Correcting through them.
[pause 5s]
And the child senses it.
[pause 5s]
Not as love.
[pause 5s]
As pressure.
[pause 8s]

Daniel Siegel speaks of the narrating brain.
[pause 5s]
Parents who have integrated their own story...
[pause 5s]
who can speak of their difficulties with coherence and clarity...
[pause 5s]
create secure children.
[pause 5s]
Regardless of what they lived through.
[pause 5s]
It's the integration that matters.
[pause 5s]
Not the past.
[pause 10s]

Three closing breaths.
[pause 5s]
Inhale.
[pause 7s]
Exhale.
[pause 9s]
Inhale.
[pause 7s]
Exhale.
[pause 9s]
Inhale.
[pause 7s]
Exhale slowly.
[pause 12s]
SCRIPT,

        // ─────────────────────────────────────────────────────────
        // P3 — Sustaining Our Relationships
        // ─────────────────────────────────────────────────────────
        '21-entretenir-nos-relations' => <<<'SCRIPT'
Settle in.
[pause 5s]
Think of an important relationship in your life.
[pause 5s]
One that has existed for a long time.
[pause 5s]
And ask honestly.
[pause 5s]
Am I truly nurturing this relationship... or counting on its duration?
[pause 10s]

Three breaths.
[pause 4s]
Inhale for five.
[pause 7s]
Hold two.
[pause 3s]
Exhale for seven.
[pause 9s]
Again.
[pause 7s]
Inhale.
[pause 7s]
Hold.
[pause 3s]
Exhale.
[pause 9s]
Last.
[pause 7s]
Inhale.
[pause 7s]
Hold.
[pause 3s]
Exhale.
[pause 12s]

Relationships are like gardens.
[pause 5s]
They need water. Attention. Presence.
[pause 5s]
Without care... they don't die suddenly.
[pause 5s]
They slowly impoverish.
[pause 5s]
And one day you look at each other wondering what happened.
[pause 8s]

Gottman named it the Love Map.
[pause 5s]
The inner map of the other.
[pause 5s]
Knowing their dreams. Their fears. Their recent joys. What occupies their mind. What hurt them.
[pause 6s]
Struggling couples have empty Love Maps.
[pause 5s]
They live side by side... but no longer truly know who is next to them.
[pause 8s]

This module invites you to act.
[pause 5s]
Not later.
[pause 5s]
Today.
[pause 5s]
A message. A call. A meal. A sincere question.
[pause 4s]
How is your life really going?
[pause 10s]

Three closing breaths.
[pause 5s]
Inhale.
[pause 7s]
Exhale.
[pause 9s]
Inhale.
[pause 7s]
Exhale.
[pause 9s]
Inhale.
[pause 7s]
Exhale slowly.
[pause 12s]
SCRIPT,

        // ─────────────────────────────────────────────────────────
        // P3 — I Transmit My Transformation
        // ─────────────────────────────────────────────────────────
        '11-je-transmets-ma-transformation' => <<<'SCRIPT'
Settle in. Breathe.
[pause 5s]
And let this question come gently.
[pause 5s]
What have I truly learned... throughout this journey?
[pause 10s]

Not intellectually.
[pause 5s]
Viscerally.
[pause 5s]
What has changed in you?
[pause 10s]

Three breaths.
[pause 4s]
Inhale for five.
[pause 7s]
Hold two.
[pause 3s]
Exhale for seven.
[pause 9s]
Again.
[pause 7s]
Inhale.
[pause 7s]
Hold.
[pause 3s]
Exhale.
[pause 9s]
Last.
[pause 7s]
Inhale.
[pause 7s]
Hold.
[pause 3s]
Exhale.
[pause 12s]

There is a principle in Buddhist teaching.
[pause 5s]
One who has received knowledge... has the responsibility to transmit it.
[pause 5s]
Not as moral duty.
[pause 5s]
Because knowledge consolidates through transmission.
[pause 5s]
And because we are all connected.
[pause 8s]

But transmission doesn't happen only through words.
[pause 5s]
It happens through being.
[pause 5s]
Through what you radiate when you enter a room.
[pause 4s]
Through how you listen.
[pause 4s]
Through the quality of presence you bring.
[pause 4s]
Through the courage to live according to what you truly believe.
[pause 8s]

Your transformation is not only for you.
[pause 5s]
It is a point of light in the lives of those you touch.
[pause 5s]
Often without knowing.
[pause 5s]
Often just by being who you are becoming.
[pause 10s]

Three closing breaths.
[pause 5s]
Inhale.
[pause 7s]
Exhale.
[pause 9s]
Inhale.
[pause 7s]
Exhale.
[pause 9s]
Inhale.
[pause 7s]
Exhale slowly.
[pause 12s]
SCRIPT,

        // ─────────────────────────────────────────────────────────
        // P3 — Journey Synthesis
        // ─────────────────────────────────────────────────────────
        '29-synthese-du-parcours' => <<<'SCRIPT'
Settle in.
[pause 5s]
Close your eyes.
[pause 5s]
And let come... softly... the images of what you have crossed.
[pause 8s]

Since the beginning of this journey.
[pause 5s]
What you know now that you did not know.
[pause 5s]
What you understood in your body... not just in your head.
[pause 5s]
What has moved in you.
[pause 10s]

Three breaths.
[pause 4s]
Inhale for five.
[pause 7s]
Hold two.
[pause 3s]
Exhale for seven.
[pause 9s]
Again.
[pause 7s]
Inhale.
[pause 7s]
Hold.
[pause 3s]
Exhale.
[pause 9s]
Last.
[pause 7s]
Inhale.
[pause 7s]
Hold.
[pause 3s]
Exhale.
[pause 12s]

You began by finding yourself.
[pause 5s]
Looking honestly at what was there.
[pause 4s]
Your limits. Your drains. Your wounds. Your vision.
[pause 4s]
Life as it is... not as you'd wish it to be.
[pause 8s]

Then you began to build yourself.
[pause 5s]
Foundations. Priorities. Mastered time. A listened-to body.
[pause 4s]
A regulated nervous system. Conscious eating. Respected sleep.
[pause 8s]

And then you opened.
[pause 5s]
To others. To the world. To the complexity of love.
[pause 4s]
Of solitude. Of meaning. Of transmission.
[pause 8s]

This journey was not meant to make you perfect.
[pause 5s]
It was meant to make you more alive.
[pause 5s]
More present. More grounded.
[pause 5s]
More capable of inhabiting your own life.
[pause 8s]

Find yourself. Build yourself. Open yourself.
[pause 6s]
Three movements that are not done once.
[pause 5s]
They repeat. In a spiral.
[pause 4s]
Each cycle takes you further... deeper.
[pause 10s]

Where are you today... compared to the beginning?
[pause 12s]

What do you want to take from this journey into your daily life?
[pause 12s]

Three breaths of gratitude.
[pause 5s]
Inhale.
[pause 7s]
Exhale.
[pause 9s]
Inhale.
[pause 7s]
Exhale.
[pause 9s]
Inhale one last time.
[pause 7s]
Exhale slowly... and let something settle.
[pause 15s]
SCRIPT,

        // ─────────────────────────────────────────────────────────
        // P3 — My Daily Program
        // ─────────────────────────────────────────────────────────
        '30-mon-programme-quotidien' => <<<'SCRIPT'
Settle in one last time.
[pause 5s]
This module closes the journey.
[pause 5s]
And opens it at the same time.
[pause 5s]
Because what you have learned here only has value in what you do tomorrow.
[pause 10s]

Three breaths.
[pause 4s]
Inhale for five.
[pause 7s]
Hold two.
[pause 3s]
Exhale for seven.
[pause 9s]
Again.
[pause 7s]
Inhale.
[pause 7s]
Hold.
[pause 3s]
Exhale.
[pause 9s]
Last.
[pause 7s]
Inhale.
[pause 7s]
Hold.
[pause 3s]
Exhale.
[pause 12s]

Aristotle said we are what we repeatedly do.
[pause 5s]
Excellence is not an act.
[pause 4s]
It is a habit.
[pause 8s]

The neurosciences confirmed what philosophers knew by intuition.
[pause 5s]
The brain is plastic.
[pause 4s]
It rewires according to what you repeat.
[pause 5s]
Each repeated behavior strengthens a neural network.
[pause 5s]
Until it becomes automatic.
[pause 5s]
Until it becomes... you.
[pause 8s]

A daily program is not a list of constraints.
[pause 5s]
It is an architecture of identity.
[pause 5s]
Who is the person you are becoming... hour by hour... day by day?
[pause 8s]

This program must be realistic.
[pause 5s]
Not perfect.
[pause 5s]
Sustainable.
[pause 5s]
Composed of small rituals that take little space... but say everything.
[pause 8s]

A moment of silence in the morning. Even five minutes.
[pause 4s]
Movement.
[pause 4s]
A mindful meal.
[pause 4s]
A moment of real connection.
[pause 4s]
An intention in the morning.
[pause 4s]
A gratitude in the evening.
[pause 6s]
And the rest... organized around your true priorities.
[pause 10s]

I invite you now to write your program.
[pause 5s]
Not the ideal one.
[pause 5s]
The one that fits your real life.
[pause 5s]
And that you will begin tomorrow.
[pause 5s]
Not Monday.
[pause 5s]
Not next month.
[pause 5s]
Tomorrow.
[pause 10s]

Three opening breaths toward tomorrow.
[pause 5s]
Inhale.
[pause 7s]
Exhale.
[pause 9s]
Inhale.
[pause 7s]
Exhale.
[pause 9s]
Inhale one last time.
[pause 7s]
Exhale... letting yourself move toward what you are about to build.
[pause 15s]

Thank you for being here.
[pause 6s]
This journey has been an honor.
[pause 5s]
Yours.
[pause 15s]
SCRIPT,

        // ─────────────────────────────────────────────────────────
        // PRATICIEN EN — Module 01 — Knowing Yourself to Accompany Others
        // ─────────────────────────────────────────────────────────
        '01-je-me-connais-pour-accompagner' => <<<'SCRIPT'
Settle in.
[pause 5s]

Before you can accompany anyone else...
[pause 5s]
you must first meet yourself.
[pause 5s]
Not the version you present to the world.
[pause 4s]
The one that exists right now... beneath the roles.
[pause 10s]

Carl Rogers said something simple and profound.
[pause 5s]
The most powerful helping relationship is not from expert to novice.
[pause 5s]
It is from one human being who knows themselves... towards another who is trying to find themselves.
[pause 10s]

This is the first module of your practitioner training.
[pause 5s]
It does not begin with techniques.
[pause 4s]
It begins with you.
[pause 8s]

Close your eyes.
[pause 6s]

Three conscious breaths to arrive here.
[pause 20s]

Now... ask your body this question.
[pause 6s]
Who am I... when no one is watching?
[pause 15s]

Not a quick answer.
[pause 5s]
Let what comes... come.
[pause 12s]

An effective practitioner does not guide through their theories.
[pause 5s]
They guide through what they have lived.
[pause 5s]
Conscious wounds become keys.
[pause 5s]
Developed resources become bridges.
[pause 10s]

Think of a wound you carry... that you have begun to make peace with.
[pause 8s]
Not to explain to others.
[pause 5s]
Just to recognise within yourself.
[pause 8s]

Where does it live in your body?
[pause 5s]
How does it still show up today?
[pause 12s]

And now... think of a resource.
[pause 6s]
Something you developed... often through difficulty.
[pause 5s]
An ability to listen deeply.
[pause 4s]
A quiet presence.
[pause 4s]
An intuition about others' emotional states.
[pause 8s]

You have carried this resource for a long time.
[pause 5s]
And it is precisely this that will nourish your practice.
[pause 10s]

We anchor this work through the body.
[pause 8s]

We will practise the five-five-five method.
[pause 5s]

Five seconds to inhale.
[pause 2s]
Five seconds to hold.
[pause 2s]
Five seconds to exhale.
[pause 4s]
Ten cycles.
[pause 2s]
Two and a half minutes of deep self-presence.
[pause 6s]

On the inhale... let in self-knowledge.
[pause 4s]
On the hold... rest in what you are.
[pause 4s]
On the exhale... release what is not you.
[pause 6s]

We begin.
[BREATHING_CYCLES]
[pause 20s]

This calm... is the foundation of your practice.
[pause 5s]
What you touch here... you can offer to others.
[pause 15s]

Let the breath return to its natural rhythm.
[pause 10s]

Stay here.
[pause 8s]
Without doing anything.
[pause 12s]

What wound has shaped you most... and that you have begun to transform into understanding?
[pause 18s]

What is the deepest resource you bring into a helping relationship?
[pause 18s]

In one sentence... who are you as a practitioner?
[pause 18s]

Write what came in your notebook.
[pause 5s]
Without correcting.
[pause 5s]
Without minimising.
[pause 8s]

You begin here.
[pause 5s]
With what you are.
[pause 5s]
That is enough.
[pause 10s]
SCRIPT,

        // ─────────────────────────────────────────────────────────
        // PRATICIEN EN — Module 02 — Mastering the Tools of the Breath
        // ─────────────────────────────────────────────────────────
        '02-je-maitrise-les-outils-du-souffle' => <<<'SCRIPT'
Settle in.
[pause 5s]

You already sense what breath does inside you.
[pause 5s]
This module gives you precise language.
[pause 4s]
And the tools to transmit it.
[pause 10s]

A Pause Souffle practitioner does not work with a single technique.
[pause 5s]
They work with a repertoire.
[pause 5s]
Seven distinct tools.
[pause 5s]
Each for a specific state... need... and moment.
[pause 10s]

Close your eyes.
[pause 6s]

Three breaths to arrive here.
[pause 20s]

The first tool... you already know.
[pause 5s]
The Pause Souffle five-five-five.
[pause 5s]
Cardiac coherence.
[pause 4s]
Autonomic nervous system regulation.
[pause 4s]
Vagus nerve activation.
[pause 5s]
Your central anchor.
[pause 8s]

The second tool.
[pause 5s]
The breath of fire.
[pause 5s]
Short rhythmic inhales and exhales through the nose.
[pause 5s]
It activates... awakens... releases accumulated tension.
[pause 8s]

The third.
[pause 5s]
Alternate nostril breathing.
[pause 5s]
Right nostril... left nostril... alternating.
[pause 5s]
It balances the two brain hemispheres.
[pause 4s]
Mental clarity.
[pause 4s]
Inner calm.
[pause 8s]

The fourth.
[pause 5s]
Extended exhale.
[pause 5s]
Four seconds in... eight seconds out.
[pause 5s]
The fastest parasympathetic brake available.
[pause 5s]
For emotional emergencies... returning to the window of tolerance.
[pause 8s]

The fifth.
[pause 5s]
Box breathing.
[pause 5s]
Four in... four hold... four out... four pause.
[pause 5s]
Used by special forces to stay calm under extreme pressure.
[pause 8s]

The sixth.
[pause 5s]
Extended coherence breath.
[pause 5s]
Six seconds inhale... six seconds exhale.
[pause 5s]
Optimal heart-brain synchronisation.
[pause 4s]
For deep states and longer sessions.
[pause 8s]

The seventh.
[pause 5s]
Sound release breath.
[pause 5s]
Exhale with a sound... a sigh... a gentle hum.
[pause 5s]
The sound vibrates through the vagus nerve.
[pause 4s]
It releases what the body holds in silence.
[pause 10s]

Seven tools.
[pause 5s]
Seven keys for seven states.
[pause 5s]
A practitioner who masters them adapts every session to every client.
[pause 10s]

We anchor this mastery through the body.
[pause 8s]

We will practise the five-five-five method.
[pause 5s]

Five seconds to inhale.
[pause 2s]
Five seconds to hold.
[pause 2s]
Five seconds to exhale.
[pause 4s]
Ten cycles.
[pause 2s]
Two and a half minutes of presence within your repertoire.
[pause 6s]

On the inhale... receive the mastery.
[pause 4s]
On the hold... feel the solidity of what you now carry.
[pause 4s]
On the exhale... imagine transmitting it with clarity.
[pause 6s]

We begin.
[BREATHING_CYCLES]
[pause 20s]

This calm... is your practice ground.
[pause 5s]
This is where you will work.
[pause 15s]

Let the breath return to its natural rhythm.
[pause 10s]

Stay here.
[pause 8s]
Without doing anything.
[pause 12s]

Which breathing tool resonates most with your natural energy as a practitioner?
[pause 18s]

For which type of client or situation do you want to train first?
[pause 18s]

What is your mission as a breath practitioner... in one sentence?
[pause 18s]

Write what came in your notebook.
[pause 5s]
Tools belong to those who practise them.
[pause 5s]
Practise every day.
[pause 10s]
SCRIPT,

        // ─────────────────────────────────────────────────────────
        // PRATICIEN EN — Module 10 — The Practitioner's Posture
        // ─────────────────────────────────────────────────────────
        '10-la-posture-du-praticien' => <<<'SCRIPT'
Settle in.
[pause 5s]

There is a fundamental difference between knowing how to guide a breath...
[pause 5s]
and being a practitioner.
[pause 5s]
That difference is posture.
[pause 10s]

The practitioner's posture is not a technique.
[pause 5s]
It is a state of being.
[pause 5s]
A way of occupying space... inhabiting your voice... managing your inner state...
[pause 4s]
before your client even enters the room.
[pause 10s]

Close your eyes.
[pause 6s]

Three breaths to arrive here.
[pause 20s]

The first dimension of posture... physical presence.
[pause 6s]

A practitioner whose body is collapsed... agitated... or tense...
[pause 5s]
transmits that state to their client before saying a single word.
[pause 5s]
The other person's nervous system reads you.
[pause 5s]
Within seconds.
[pause 5s]
It is wired to do exactly that.
[pause 8s]

Feel your body right now.
[pause 5s]
Feet on the ground.
[pause 4s]
Spine upright but alive.
[pause 4s]
Shoulders released.
[pause 4s]
Face open.
[pause 6s]

This physical posture is already a message.
[pause 5s]
It says... I am here.
[pause 4s]
I am stable.
[pause 4s]
You are safe.
[pause 10s]

The second dimension... the therapeutic voice.
[pause 6s]

A practitioner's voice is not their everyday voice.
[pause 5s]
It is slower.
[pause 4s]
Deeper.
[pause 4s]
More grounded.
[pause 5s]
It descends... rather than rises.
[pause 5s]
It creates space... rather than filling it.
[pause 8s]

Your voice can activate or deactivate another person's nervous system.
[pause 5s]
Every word.
[pause 4s]
Every pause.
[pause 4s]
Every variation in tone.
[pause 5s]
It is your primary therapeutic instrument.
[pause 10s]

The third dimension... inner state.
[pause 6s]

A practitioner cannot be in fear... performance... or judgment...
[pause 5s]
and simultaneously create a safe space for a client.
[pause 5s]
Both things cannot coexist.
[pause 8s]

Before each session... take three cycles of conscious breath.
[pause 5s]
Not to prepare to perform.
[pause 4s]
To remember who you are.
[pause 5s]
A space.
[pause 4s]
Not a solution.
[pause 10s]

The fourth dimension... preventing practitioner burnout.
[pause 6s]

A practitioner who gives without recharging... burns out.
[pause 5s]
This is not weakness.
[pause 4s]
It is biology.
[pause 6s]

The rule is simple.
[pause 5s]
What you ask your clients to do... you do too.
[pause 4s]
Every day.
[pause 4s]
Without exception.
[pause 10s]

We anchor this posture through the body.
[pause 8s]

We will practise the five-five-five method.
[pause 5s]

Five seconds to inhale.
[pause 2s]
Five seconds to hold.
[pause 2s]
Five seconds to exhale.
[pause 4s]
Ten cycles.
[pause 2s]
Two and a half minutes inside the practitioner's posture.
[pause 6s]

On the inhale... let in stability.
[pause 4s]
On the hold... hold the space.
[pause 4s]
On the exhale... offer safety.
[pause 6s]

We begin.
[BREATHING_CYCLES]
[pause 20s]

This calm... is your natural posture.
[pause 5s]
It already exists in you.
[pause 5s]
This module helps you inhabit it consciously.
[pause 15s]

Let the breath return to its natural rhythm.
[pause 10s]

Stay here.
[pause 8s]
Without doing anything.
[pause 12s]

Which dimension of posture requires the most work for you — physical presence... voice... inner state... or replenishment?
[pause 18s]

What do you already do naturally well in your practitioner posture?
[pause 18s]

What replenishment practice will you put in place this week?
[pause 18s]

Write what came in your notebook.
[pause 5s]
Posture is cultivated daily.
[pause 5s]
Not only in front of a client.
[pause 10s]
SCRIPT,

        // ─────────────────────────────────────────────────────────
        // PRATICIEN EN — Module 11 — Reading a Client, Adapting the Protocol
        // ─────────────────────────────────────────────────────────
        '11-lire-un-client-adapter-le-protocole' => <<<'SCRIPT'
Settle in.
[pause 5s]

A rigid protocol... applied the same way to everyone...
[pause 5s]
is not professional practice.
[pause 5s]
It is a standardised service.
[pause 8s]

A practitioner is distinguished by their ability to read.
[pause 5s]
To perceive.
[pause 4s]
To adapt.
[pause 4s]
In real time.
[pause 10s]

This module gives you the keys to this relational intelligence.
[pause 8s]

Close your eyes.
[pause 6s]

Three breaths to arrive here.
[pause 20s]

Let us begin with the four client profiles.
[pause 6s]

The first profile.
[pause 5s]
The analytical client.
[pause 5s]
They need to understand before they can feel.
[pause 5s]
Give them anatomy... physiology... research.
[pause 4s]
Explain before you guide.
[pause 4s]
Their entry point is the intellect.
[pause 8s]

The second profile.
[pause 5s]
The emotional client.
[pause 5s]
They are already in the feeling.
[pause 4s]
They need safety first.
[pause 4s]
Your presence.
[pause 4s]
Not explanations.
[pause 5s]
Their entry point is human connection.
[pause 8s]

The third profile.
[pause 5s]
The sceptical client.
[pause 5s]
They are testing.
[pause 4s]
Observing.
[pause 4s]
Here despite themselves... almost.
[pause 5s]
Do not try to convince them.
[pause 4s]
Let the experience speak.
[pause 5s]
Their entry point is concrete results.
[pause 8s]

The fourth profile.
[pause 5s]
The client in crisis.
[pause 5s]
Saturated.
[pause 4s]
Exhausted.
[pause 4s]
Overwhelmed.
[pause 5s]
They need an immediate anchor.
[pause 4s]
No theory.
[pause 4s]
Just... return to the body.
[pause 4s]
Here.
[pause 3s]
Now.
[pause 8s]

Now... the five non-verbal channels.
[pause 6s]

What your client tells you through their body... before they speak.
[pause 6s]

The breath.
[pause 5s]
Is it shallow... high... blocked... or full?
[pause 8s]

The posture.
[pause 5s]
Collapsed... closed... rigid... or open?
[pause 8s]

The eyes.
[pause 5s]
Avoidant... fixed... present... or absent?
[pause 8s]

The voice.
[pause 5s]
Fast... flat... trembling... or grounded?
[pause 8s]

The overall tone.
[pause 5s]
Hyper-activated... frozen... or available?
[pause 8s]

These five channels together give you the picture of your client.
[pause 5s]
Before they have said a single word.
[pause 10s]

We anchor this perception through the body.
[pause 8s]

We will practise the five-five-five method.
[pause 5s]

Five seconds to inhale.
[pause 2s]
Five seconds to hold.
[pause 2s]
Five seconds to exhale.
[pause 4s]
Ten cycles.
[pause 2s]
Two and a half minutes of open attention.
[pause 6s]

On the inhale... open your perception.
[pause 4s]
On the hold... let information in.
[pause 4s]
On the exhale... remain available.
[pause 6s]

We begin.
[BREATHING_CYCLES]
[pause 20s]

This calm... is the foundation of your perception.
[pause 5s]
A relaxed practitioner perceives more than a concentrated one.
[pause 15s]

Let the breath return to its natural rhythm.
[pause 10s]

Stay here.
[pause 8s]
Without doing anything.
[pause 12s]

Among the four profiles... which challenges you most?
[pause 18s]

Which non-verbal channel do you read most naturally?
[pause 18s]

What is the opening question you ask at the start of a session to calibrate your approach?
[pause 18s]

Write what came in your notebook.
[pause 5s]
Reading a client is an art.
[pause 5s]
It develops with every session.
[pause 10s]
SCRIPT,

        // ─────────────────────────────────────────────────────────
        // PRATICIEN EN — Module 12 — Building a Professional Practice
        // ─────────────────────────────────────────────────────────
        '12-construire-une-pratique-professionnelle' => <<<'SCRIPT'
Settle in.
[pause 5s]

You can be the best practitioner in the world.
[pause 5s]
If no one knows you exist...
[pause 5s]
your practice remains an intention.
[pause 10s]

This module is not about marketing in the commercial sense.
[pause 5s]
It is about something more fundamental.
[pause 5s]
Building a practice that reflects who you are.
[pause 5s]
And that truly serves the people who need it.
[pause 10s]

Close your eyes.
[pause 6s]

Three breaths to arrive here.
[pause 20s]

First... your service offering.
[pause 6s]

A Pause Souffle practitioner can offer four main formats.
[pause 5s]

Individual sessions.
[pause 5s]
In a practice... at home... or online.
[pause 4s]
45 to 90 minutes.
[pause 4s]
The most personalised accompaniment.
[pause 8s]

Group workshops.
[pause 5s]
Two to twenty people.
[pause 4s]
Corporate... studio... or outdoors.
[pause 4s]
High-energy format... immediate impact.
[pause 8s]

Accompaniment programmes.
[pause 5s]
Six to twelve weeks.
[pause 4s]
Regular sessions... measurable progression.
[pause 4s]
The deepest transformation.
[pause 8s]

Retreats or seminars.
[pause 5s]
Immersive experience.
[pause 4s]
Multiplied impact.
[pause 8s]

Second... pricing.
[pause 6s]

Your rate is not an arbitrary number.
[pause 5s]
It is a declaration of value.
[pause 5s]
Too low... and you devalue yourself.
[pause 4s]
You send a signal of insufficient confidence.
[pause 5s]
The right rate reflects your training level...
[pause 4s]
the transformational value you bring...
[pause 4s]
and your local market.
[pause 8s]

Third... your first three clients.
[pause 6s]

They are not your best clients.
[pause 5s]
They are your teachers.
[pause 5s]
The most valuable ones.
[pause 5s]
Find them in your immediate circle.
[pause 4s]
Offer the first sessions in exchange for honest feedback.
[pause 4s]
Not public reviews.
[pause 4s]
Truth.
[pause 8s]

Fourth... minimal digital presence.
[pause 6s]

You do not need a complex marketing funnel to begin.
[pause 5s]
You need one thing.
[pause 5s]
For the right people to find you and contact you.
[pause 5s]
A clear profile... a readable offer... a way to book.
[pause 5s]
That is all.
[pause 10s]

We anchor this vision through the body.
[pause 8s]

We will practise the five-five-five method.
[pause 5s]

Five seconds to inhale.
[pause 2s]
Five seconds to hold.
[pause 2s]
Five seconds to exhale.
[pause 4s]
Ten cycles.
[pause 2s]
Two and a half minutes to embody your practice.
[pause 6s]

On the inhale... see your practice already alive.
[pause 4s]
On the hold... hold that vision.
[pause 4s]
On the exhale... release the fear of not being ready.
[pause 6s]

We begin.
[BREATHING_CYCLES]
[pause 20s]

This calm... is the confidence in what you are building.
[pause 5s]
It exists.
[pause 5s]
It grows with every session.
[pause 15s]

Let the breath return to its natural rhythm.
[pause 10s]

Stay here.
[pause 8s]
Without doing anything.
[pause 12s]

Which service format fits your natural energy most?
[pause 18s]

Who are the three first people in your circle you could accompany?
[pause 18s]

What fear is still holding you back... and what would be true if that fear did not exist?
[pause 18s]

Write what came in your notebook.
[pause 5s]
Your practice begins the moment you decide it has begun.
[pause 5s]
Not when you are perfectly ready.
[pause 10s]
SCRIPT,

        // ─────────────────────────────────────────────────────────
        // PRATICIEN EN — Module 13 — Limits, Contraindications & Responsibility
        // ─────────────────────────────────────────────────────────
        '13-limites-contre-indications-responsabilite' => <<<'SCRIPT'
Settle in.
[pause 5s]

Ethics is not a constraint.
[pause 5s]
It is the structure that protects you... and your clients.
[pause 5s]
Without clear limits... a professional practice does not hold.
[pause 10s]

This is one of the most important modules in your training.
[pause 5s]
Not the most spectacular.
[pause 4s]
The most fundamental.
[pause 10s]

Close your eyes.
[pause 6s]

Three breaths to arrive here.
[pause 20s]

First... the five situations requiring immediate session stop.
[pause 6s]

One... uncontrolled hyperventilation.
[pause 5s]
If the client loses control of their breathing... stop immediately.
[pause 4s]
Return to natural breathing.
[pause 4s]
Never any pressure.
[pause 8s]

Two... intense emotional crisis.
[pause 5s]
Uncontrollable crying... major agitation... dissociative state.
[pause 5s]
The practitioner does not continue.
[pause 4s]
They offer presence.
[pause 4s]
They stabilise.
[pause 8s]

Three... physical pain.
[pause 5s]
Any pain reported... however minor... justifies adjustment or stopping.
[pause 5s]
The body speaks.
[pause 4s]
Listen to it.
[pause 8s]

Four... dizziness or discomfort.
[pause 5s]
Common with intense techniques.
[pause 4s]
Have them lie down.
[pause 4s]
Hydration.
[pause 4s]
Rest.
[pause 8s]

Five... refusal or desire to stop.
[pause 5s]
If the client wants to stop... for any reason...
[pause 5s]
you stop.
[pause 4s]
Without discussion.
[pause 4s]
Without judgment.
[pause 8s]

Second... medical contraindications.
[pause 6s]

Always ask... before any session.
[pause 5s]
Heart conditions.
[pause 4s]
Epilepsy.
[pause 4s]
Advanced pregnancy.
[pause 4s]
Unstabilised psychiatric conditions.
[pause 4s]
Uncontrolled blood pressure.
[pause 5s]
Refer to the GP if you have any doubt.
[pause 5s]
It is not your role to diagnose.
[pause 4s]
It is your role to refer.
[pause 8s]

Third... GDPR and confidentiality.
[pause 6s]

Your clients' personal data is protected.
[pause 5s]
Name... health status... information shared in sessions.
[pause 5s]
Nothing leaves the practitioner-client relationship without explicit consent.
[pause 5s]
No exceptions.
[pause 8s]

Fourth... professional ethics.
[pause 6s]

A Pause Souffle practitioner is not a therapist.
[pause 5s]
They do not diagnose.
[pause 4s]
They do not interpret symptoms.
[pause 4s]
They do not compete with doctors or psychologists.
[pause 5s]
They create the conditions for the body to self-regulate.
[pause 5s]
That is not nothing.
[pause 4s]
In fact it is precious.
[pause 4s]
Be clear about who you are.
[pause 8s]

We seal this commitment through the body.
[pause 8s]

We will practise the five-five-five method.
[pause 5s]

Five seconds to inhale.
[pause 2s]
Five seconds to hold.
[pause 2s]
Five seconds to exhale.
[pause 4s]
Ten cycles.
[pause 2s]
Two and a half minutes of conscious responsibility.
[pause 6s]

On the inhale... let in clarity.
[pause 4s]
On the hold... hold your framework.
[pause 4s]
On the exhale... offer this safety to your future clients.
[pause 6s]

We begin.
[BREATHING_CYCLES]
[pause 20s]

This calm... is the foundation of your ethical practice.
[pause 5s]
A clear practitioner... is a safe practitioner.
[pause 15s]

Let the breath return to its natural rhythm.
[pause 10s]

Stay here.
[pause 8s]
Without doing anything.
[pause 12s]

Is there a limit you have not yet dared to set... a situation you have not yet anticipated?
[pause 18s]

What would be the first concrete step to structure the administrative and ethical side of your practice?
[pause 18s]

What sentence summarises your commitment to your clients... your practitioner's oath?
[pause 18s]

Write what came in your notebook.
[pause 5s]
An ethical practitioner knows why they do what they do.
[pause 5s]
And what they do not do.
[pause 10s]
SCRIPT,

        // ─────────────────────────────────────────────────────────
        // PRATICIEN EN — Module 14 — The Relationship of Care — target : 16–18 min
        // ─────────────────────────────────────────────────────────
        '14-la-relation-de-soin' => <<<'SCRIPT'
Welcome to module 14.
[pause 6s]

The Relationship of Care.
[pause 5s]
What really heals.
[pause 8s]

You have learned tools.
[pause 5s]
You have learned protocols.
[pause 5s]
You have crossed your own wound to better understand others'.
[pause 8s]

But today, we go to the heart of what makes the difference between a breath technician and a true practitioner.
[pause 8s]

What heals... is often not the technique.
[pause 6s]
It is the relationship.
[pause 8s]

Inhale deeply...
[pause 5s]
Hold...
[pause 5s]
Release...
[pause 8s]

Jung named this paradox with rare precision.
[pause 5s]
He called it the Wounded Healer.
[pause 8s]

The idea is simple and striking.
[pause 5s]
The one who heals carries their own wound.
[pause 6s]
And this is not an obstacle to their practice.
[pause 5s]
It is their deepest qualification.
[pause 10s]

When you have crossed fear, exhaustion, doubt... you recognise these states in your client.
[pause 6s]
Not intellectually.
[pause 5s]
But in your body.
[pause 8s]

Your integrated wound becomes your antenna.
[pause 6s]
Your unintegrated wound becomes your blind spot.
[pause 10s]

Inhale deeply...
[pause 5s]
Hold...
[pause 5s]
Release...
[pause 8s]

Let us talk about the therapeutic container.
[pause 6s]

Many practitioners believe their role is to guide a technique.
[pause 6s]
But your primary role is to create a space.
[pause 8s]

A space where the client can finally allow themselves to stop controlling.
[pause 6s]
Where something deeper can emerge.
[pause 10s]

This container has five dimensions.
[pause 6s]

First — physical safety.
[pause 5s]
The space is comfortable, protected, without possible interruption.
[pause 5s]
The client knows they are safe in their body.
[pause 8s]

Second — emotional safety.
[pause 5s]
They can feel without being judged.
[pause 5s]
They can cry, be silent, not know.
[pause 5s]
You are there — stable — whatever happens.
[pause 8s]

Third — clarity of the frame.
[pause 5s]
They know why they are here, what will happen, and what will not.
[pause 5s]
The frame is a form of respect.
[pause 8s]

Fourth — your presence.
[pause 5s]
Not your performance. Your presence.
[pause 5s]
You are grounded. Calm. Available.
[pause 5s]
You do not need them to be well in order to not collapse.
[pause 8s]

Fifth — clear intention.
[pause 5s]
You know why you are there.
[pause 5s]
You serve a transformation, not your own need to be recognised.
[pause 10s]

Inhale deeply...
[pause 5s]
Hold...
[pause 5s]
Release...
[pause 8s]

There is a neurological phenomenon that explains much of what you experience in sessions.
[pause 6s]
It is called nervous co-regulation.
[pause 8s]

Your nervous system and your client's... talk to each other.
[pause 6s]
Not with words. With micro-signals.
[pause 6s]
The rhythm of your breath. The tone of your body. The quality of your gaze.
[pause 8s]

A practitioner whose nervous system is coherent automatically creates a regulatory effect on their client.
[pause 8s]
This is why your daily personal practice is not a luxury.
[pause 6s]
It is the foundation of your effectiveness.
[pause 10s]

Inhale deeply...
[pause 5s]
Hold...
[pause 5s]
Release...
[pause 8s]

What clients are really looking for.
[pause 6s]

They come for the breath. Or for sleep. Or to manage stress.
[pause 6s]
What they seek on the surface is real and must be honoured.
[pause 8s]

But in the deeper layer...
[pause 5s]
They are looking to be seen.
[pause 6s]
Truly seen.
[pause 6s]
Not corrected. Not optimised. Not fixed.
[pause 5s]
Seen.
[pause 10s]

And in the deepest layer of all...
[pause 5s]
They are looking to reconcile with themselves.
[pause 6s]
To no longer be at war with their body, their emotions, their history.
[pause 10s]

Your role is not to heal them.
[pause 5s]
Your role is to create the conditions so they can heal themselves.
[pause 10s]

Learn to hold silence without interrupting it.
[pause 5s]
It is one of the most difficult learnings.
[pause 5s]
And one of the most precious.
[pause 10s]

Inhale deeply...
[pause 5s]
Hold...
[pause 5s]
Release...
[pause 8s]

In your past sessions — what seems to have truly touched your clients?
[pause 18s]

Was it a specific technique... or something in your presence?
[pause 18s]

Which dimension of the therapeutic container feels most natural to you... and which one still needs work?
[pause 18s]

Write what came in your notebook.
[pause 5s]
The relationship of care begins with the relationship to oneself.
[pause 5s]
Take care of yourself first.
[pause 10s]
SCRIPT,

        // ─────────────────────────────────────────────────────────
        // PRATICIEN EN — Module 15 — The Practitioner's Signature — target : 16–18 min
        // ─────────────────────────────────────────────────────────
        '15-signature-du-praticien' => <<<'SCRIPT'
Welcome to module 15.
[pause 6s]

The final module of your training.
[pause 8s]

The Practitioner's Signature.
[pause 6s]
Who are you really?
[pause 10s]

From module zero until here...
[pause 5s]
You have crossed a great deal.
[pause 6s]
You understood the body. Mastered the tools. Crossed your own wounds.
[pause 6s]
You learned posture, voice, internal state.
[pause 6s]
You understood what really heals.
[pause 10s]

One thing remains.
[pause 6s]
The most difficult for many.
[pause 8s]

Embody all of this... as your own signature.
[pause 8s]
Not a copy of another practitioner.
[pause 5s]
Not a clone of an admired model.
[pause 5s]
You — unique, imperfect, alive, singular.
[pause 10s]

Inhale deeply...
[pause 5s]
Hold...
[pause 5s]
Release...
[pause 8s]

A practitioner's signature is not a marketing slogan.
[pause 6s]
It is what clients recognise before you even speak.
[pause 6s]
It is the imprint you leave when you are fully yourself.
[pause 10s]

This signature has five dimensions.
[pause 6s]

First — your natural tone.
[pause 5s]
Are you warm or structured? Intuitive or methodical? Guiding or silent?
[pause 6s]
This is not what you choose to show.
[pause 5s]
It is what emerges when you are at ease.
[pause 5s]
Your tone is right. It refines. It cannot be replaced.
[pause 8s]

Second — your natural audience.
[pause 5s]
Who naturally comes toward you? Who feels immediately at ease with you?
[pause 6s]
These are the people you are best equipped to accompany first.
[pause 5s]
Serving your natural audience first means choosing effectiveness over universality.
[pause 8s]

Third — your preferred tool.
[pause 5s]
Among everything you have learned... where are you most naturally at ease?
[pause 6s]
Mastering one tool in depth is worth a thousand times more than knowing ten techniques at the surface.
[pause 8s]

Fourth — your implicit promise.
[pause 5s]
Not your tagline. The promise your presence makes without you formulating it.
[pause 6s]
"With this practitioner, I will be safe."
[pause 5s]
"With this practitioner, I will be challenged to go further."
[pause 5s]
"With this practitioner, I will finally be understood."
[pause 8s]
Knowing your implicit promise allows you to hold it consciously.
[pause 8s]

Fifth — your founding value.
[pause 5s]
The value you never sacrifice in your practice.
[pause 5s]
Integrity? Authenticity? Depth? Named truth?
[pause 6s]
When you make a difficult decision in your practice...
[pause 5s]
This value decides.
[pause 10s]

Inhale deeply...
[pause 5s]
Hold...
[pause 5s]
Release...
[pause 8s]

The training has given you powerful tools.
[pause 5s]
Tools that access the deep layers of the nervous system.
[pause 5s]
That unlock emotions. That touch primary wounds.
[pause 8s]

This power comes with absolute responsibility.
[pause 10s]

You never exceed your competence.
[pause 5s]
If a client presents symptoms that go beyond well-being...
[pause 5s]
you refer them to a mental health professional.
[pause 5s]
This is not an admission of weakness. It is professional ethics.
[pause 8s]

Your work succeeds when your client needs you less.
[pause 6s]
When they practise alone. When they carry their own tools.
[pause 6s]
If you sense you are trying to keep them... supervise this with a peer.
[pause 8s]

You protect the frame of the relationship.
[pause 5s]
No personal relationship with a client during active accompaniment.
[pause 5s]
The frame protects the client. It protects you too.
[pause 8s]

You continue to learn and to supervise yourself.
[pause 5s]
A practitioner who stops learning stagnates.
[pause 5s]
Supervision is not a sign that something is wrong.
[pause 5s]
It is a sign you take your practice seriously.
[pause 10s]

Inhale deeply...
[pause 5s]
Hold...
[pause 5s]
Release...
[pause 8s]

We arrive at the most important moment of this training.
[pause 6s]

Place your right hand on your heart.
[pause 6s]

Take the time to mentally cross everything you have learned since module zero.
[pause 12s]

Your moments of doubt. Your moments of clarity.
[pause 6s]
What was easy. What resisted you.
[pause 6s]
The practices that moved something in you.
[pause 6s]
The ideas that reorganised your understanding.
[pause 10s]

And now, from this place...
[pause 6s]
Say inwardly, or aloud if you can:
[pause 6s]

My name is... your first name.
[pause 6s]
I am a breath practitioner.
[pause 6s]
I serve by transmitting what I have myself crossed.
[pause 6s]
My presence is my first tool.
[pause 6s]
My integrated wound is my deepest qualification.
[pause 6s]
I do not claim to be perfect.
[pause 5s]
I commit to being present.
[pause 6s]
And to remaining present — for those I accompany...
[pause 5s]
and for myself.
[pause 15s]

Inhale deeply...
[pause 5s]
Hold...
[pause 5s]
Release...
[pause 12s]

In your practitioner's notebook, write your own version of this declaration.
[pause 6s]
In your words. In your voice.
[pause 6s]
This text will be your compass for the years ahead.
[pause 10s]

You have completed the training.
[pause 6s]
But your practice has only just begun.
[pause 6s]
Carry who you are.
[pause 5s]
It is your greatest tool.
[pause 10s]
SCRIPT,

        // ─────────────────────────────────────────────────────────
        // PRATICIEN EN — Module 16 — The Money of Care — target : 14–16 min
        // ─────────────────────────────────────────────────────────
        '16-l-argent-du-soin' => <<<'SCRIPT'
Welcome to module 16.
[pause 6s]

The missing link.
[pause 8s]

This module does not speak about breath techniques.
[pause 5s]
It speaks about something almost no wellness training ever addresses.
[pause 8s]

The money conversation.
[pause 10s]

Here is a truth nobody tells you.
[pause 6s]
Ninety percent of care practitioners quit within the first three years.
[pause 8s]
Not for lack of talent.
[pause 5s]
Not for lack of passion.
[pause 5s]
For inability to speak about money... without feeling corrupted.
[pause 10s]

Inhale deeply...
[pause 5s]
Hold...
[pause 5s]
Release...
[pause 8s]

There are three beliefs that silently sabotage most wellness practitioners.
[pause 8s]

First belief.
[pause 5s]
"I cannot charge high prices for something spiritual."
[pause 8s]
Reality: your time, your training, your space and your care have real economic value.
[pause 6s]
The spiritual does not justify precarity.
[pause 5s]
You can honour the sacred... and live with dignity.
[pause 10s]

Second belief.
[pause 5s]
"If I charge less, more people will come."
[pause 8s]
The opposite is often true.
[pause 6s]
A price that is too low communicates low value.
[pause 5s]
A client who pays fifty euros cancels more easily than one who has paid one hundred and fifty.
[pause 6s]
Price is a signal of value... for you... and for your client.
[pause 10s]

Third belief.
[pause 5s]
"If I earn well... I lose my integrity."
[pause 8s]
This belief causes enormous damage.
[pause 6s]
A financially exhausted practitioner cannot serve fully.
[pause 5s]
You cannot give water... if your well is empty.
[pause 5s]
Financial sustainability... is an act of service toward your clients.
[pause 10s]

Inhale deeply...
[pause 5s]
Hold...
[pause 5s]
Release...
[pause 8s]

Let us now talk about the fair price.
[pause 6s]

There is a simple three-calculation method.
[pause 6s]

First calculation — the survival price.
[pause 5s]
Your total monthly costs, divided by the realistic number of sessions per month.
[pause 6s]
This is your absolute floor. You can never go below it.
[pause 8s]

Second calculation — the dignity price.
[pause 5s]
The income that allows you to live well, to train yourself, to rest.
[pause 6s]
Divided by the number of sessions you can do without exhausting yourself.
[pause 8s]
Example: four thousand five hundred euros desired over thirty sessions per month... equals one hundred and fifty euros per session.
[pause 10s]

Third calculation — the value price.
[pause 5s]
What concrete transformation do you bring?
[pause 6s]
How much is that worth to the client?
[pause 6s]
A client who finally sleeps after five years of insomnia —
[pause 5s]
how much was that result worth to them?
[pause 8s]
Your price can go up to ten percent of the perceived value of the transformation.
[pause 10s]

Your fair price lies between the dignity price and the value price.
[pause 6s]
It should make you slightly afraid...
[pause 5s]
but not prevent you from saying it.
[pause 10s]

Inhale deeply...
[pause 5s]
Hold...
[pause 5s]
Release...
[pause 8s]

The discovery call.
[pause 6s]

It is the most powerful tool of the freelance practitioner.
[pause 6s]
And the most poorly mastered.
[pause 8s]

It is not a sales pitch.
[pause 5s]
It is not a presentation of your services.
[pause 5s]
If it feels like "selling"... you have lost the call before it began.
[pause 10s]

The four-stage structure.
[pause 6s]

First stage — the welcome.
[pause 5s]
Create the space. No pitch. Just presence.
[pause 5s]
The first question is never about their objectives.
[pause 5s]
It is about their state.
[pause 5s]
"How are you feeling right now?"
[pause 10s]

Second stage — the situation.
[pause 5s]
"What brought you to look for this type of accompaniment now?"
[pause 6s]
"How long have you been living with this?"
[pause 6s]
Listen truly. Do not take notes. Be present.
[pause 8s]

Third stage — the vision.
[pause 5s]
"If in three months you look back — what would have changed in your daily life?"
[pause 8s]
Let them see their own transformation.
[pause 6s]
You have nothing to sell.
[pause 8s]

Fourth stage — the alignment.
[pause 5s]
"Here is what I accompany, how I work, and what it requires from you."
[pause 6s]
Then the price.
[pause 5s]
Clearly. Calmly. Without apologising.
[pause 6s]
Then... silence.
[pause 8s]
The one who speaks first after stating the price... loses.
[pause 10s]

Inhale deeply...
[pause 5s]
Hold...
[pause 5s]
Release...
[pause 8s]

One final thing.
[pause 6s]

Stop selling individual sessions.
[pause 6s]
It is the model that exhausts you fastest.
[pause 5s]
Clients have no continuity.
[pause 5s]
You have no predictable income.
[pause 5s]
The transformation is partial. Everyone loses.
[pause 10s]

Build a programme.
[pause 6s]
The transformation is complete.
[pause 5s]
Your income is predictable.
[pause 5s]
The perceived value is higher.
[pause 8s]

And progressively — build three income streams.
[pause 6s]
Active income: your sessions and programmes.
[pause 5s]
Semi-passive income: workshops, group trainings.
[pause 5s]
Passive income: audio guides for sale, recorded online programme.
[pause 8s]

A practitioner who has all three streams... is free.
[pause 6s]
Truly free.
[pause 10s]

Note what happened inside you while listening to this module.
[pause 18s]

What is the most urgent change to make in your financial practice?
[pause 18s]

Which belief must you leave behind to move towards the dignity you deserve?
[pause 18s]

Write.
[pause 5s]
Freedom begins in your relationship with money.
[pause 5s]
And money is only value made visible.
[pause 10s]
SCRIPT,

        // ─────────────────────────────────────────────────────────
        // MENTOR EN — Module 01 — The Mentor's Identity — target : 18–20 min
        // ─────────────────────────────────────────────────────────
        'mentor-01-identite-du-mentor' => <<<'SCRIPT'
Welcome to the Mentor Formation.
[pause 6s]

You are here because something in you already knows.
[pause 5s]
Knows that you have something to transmit.
[pause 5s]
An experience. A crossing. A wisdom earned at great cost.
[pause 8s]

Before you teach anything to anyone...
[pause 5s]
there is a founding question you must have already crossed yourself.
[pause 8s]

Who am I... I who dare to accompany others?
[pause 12s]

Settle in comfortably.
[pause 4s]
Close your eyes if you wish.
[pause 4s]

Let us begin with the 5-5-5 breathing method.
[pause 4s]
Inhale deeply...
[pause 5s]
Hold...
[pause 5s]
Release...
[pause 5s]
Again.
[pause 3s]
Inhale deeply...
[pause 5s]
Hold...
[pause 5s]
Release...
[pause 5s]
One more time.
[pause 3s]
Inhale deeply...
[pause 5s]
Hold...
[pause 5s]
Release...
[pause 5s]

Let your body find its natural support.
[pause 6s]

This module has a simple title: The Mentor's Identity.
[pause 5s]
But do not be misled.
[pause 4s]
It is probably the most demanding module in this entire formation.
[pause 6s]

Because it does not ask you to learn something new.
[pause 5s]
It asks you to look at what is already there.
[pause 5s]
And not to flee from it.
[pause 10s]

There is one truth every mentor must integrate from the very start.
[pause 6s]

You cannot accompany someone further than you have gone yourself.
[pause 8s]

Repeat that sentence in your mind.
[pause 5s]
You cannot accompany someone further than you have gone yourself.
[pause 10s]

Your depth... is the depth of what you can offer.
[pause 6s]
Your clarity... is the clarity you can transmit.
[pause 6s]
Your peace... is the peace you can radiate.
[pause 10s]

So the real question is not: am I qualified enough?
[pause 5s]
The real question is: do I know myself well enough to understand what I have to give?
[pause 12s]

Let us speak about your values.
[pause 6s]

Your founding values are not ideas you admire.
[pause 5s]
They are lines you do not cross.
[pause 5s]
Even under pressure. Even when it costs you.
[pause 8s]

Think of a moment in your life when you felt a deep anger.
[pause 6s]
Not a small irritation... a deep anger that came from far within.
[pause 6s]
What had been violated that day?
[pause 10s]

That answer... is a value.
[pause 5s]
Anger is often the guardian of what we hold sacred.
[pause 8s]

Now think of a moment of deep joy.
[pause 5s]
A moment when you said to yourself: this is why I am here.
[pause 8s]
What was present in that moment?
[pause 10s]

That answer too... is a value.
[pause 8s]

Let us breathe together with the 5-5-5 method.
[pause 4s]
Inhale deeply...
[pause 5s]
Hold...
[pause 5s]
Release...
[pause 5s]

Now I invite you into this module's meditation.
[pause 5s]
A meditation of deep identity.
[pause 6s]

Place your hands on your knees, palms facing up.
[pause 5s]
This is the gesture of reception.
[pause 5s]
You are not going to search for something.
[pause 4s]
You are simply going to welcome what is already there.
[pause 10s]

I will ask you a question.
[pause 4s]
Do not search for the right answer. There is none.
[pause 4s]
Simply allow something to rise from deep within you.
[pause 8s]

Who are you... when nobody is watching?
[pause 15s]

Not the role you play at work.
[pause 5s]
Not the version of yourself that your loved ones know.
[pause 5s]
Not the one you would like to show.
[pause 6s]
Who are you... truly... at your core?
[pause 15s]

Stay with that question.
[pause 5s]
Without trying to solve it.
[pause 5s]
Simply... inhabit it.
[pause 12s]

Now a second question.
[pause 5s]

What have you gone through... that no one else could have gone through in exactly the same way as you?
[pause 12s]

An ordeal. A collapse. A period of deep doubt.
[pause 6s]
Or perhaps a silent victory whose magnitude no one ever knew.
[pause 8s]

That crossing... is your raw material as a mentor.
[pause 6s]

It is not your degrees that qualify you.
[pause 5s]
It is not the number of years of experience.
[pause 5s]
It is what you have lived... integrated... transformed into wisdom.
[pause 10s]

Inhale gently...
[pause 5s]
And exhaling... release the need to prove anything.
[pause 10s]

There is a verse that runs through this entire formation.
[pause 5s]
Mark... chapter ten... verses forty-three through forty-five.
[pause 5s]

"Whoever wants to become great among you must be your servant."
[pause 8s]

"And whoever wants to be first must be slave of all."
[pause 8s]

"For even the Son of Man did not come to be served... but to serve."
[pause 12s]

This verse says something precise.
[pause 5s]
Greatness is not in position.
[pause 5s]
It is in service.
[pause 8s]

One last breath... 5-5-5.
[pause 4s]
Inhale deeply...
[pause 5s]
Hold...
[pause 5s]
Release...
[pause 5s]

Before ending this meditation...
[pause 4s]
Ask your heart this last question.
[pause 5s]

What mentor... what guide... would you have needed to be for yourself... ten years ago?
[pause 12s]

That person... might be the mentor you are becoming.
[pause 8s]

For someone who is living today what you once lived through.
[pause 8s]

Take a moment to write down what came during this meditation.
[pause 5s]
Without censure. Without correction.
[pause 5s]
What comes first is often the most true.
[pause 8s]
SCRIPT,

        // ─────────────────────────────────────────────────────────
        // MENTOR EN — Module 02 — The Servant Posture — target : 18–20 min
        // ─────────────────────────────────────────────────────────
        'mentor-02-posture-du-serviteur' => <<<'SCRIPT'
Settle in.
[pause 5s]

Module two. The Servant Posture.
[pause 6s]

Three breaths — 5-5-5 method.
[pause 4s]
Inhale... 5... 4... 3... 2... 1...
[pause 6s]
Hold... 5... 4... 3... 2... 1...
[pause 6s]
Exhale... 5... 4... 3... 2... 1...
[pause 10s]

There is a paradox at the heart of leadership.
[pause 6s]

The world believes that commanding is greatness.
[pause 5s]
That authority comes from rank.
[pause 5s]
That whoever speaks loudest holds the most power.
[pause 8s]

The mentor knows the opposite.
[pause 6s]

"Whoever wants to become great among you must be your servant."
[pause 8s]

Mark ten... verse forty-three.
[pause 5s]
These words are two thousand years old.
[pause 5s]
And they remain the most unsettling... the most relevant...
[pause 4s]
words ever written about true leadership.
[pause 10s]

This module asks you to choose your posture.
[pause 5s]
Consciously. Deliberately.
[pause 5s]
Not the posture your ego wants to adopt.
[pause 5s]
The posture that truly serves the people you accompany.
[pause 10s]

There are three possible postures.
[pause 6s]

The first... the authority-trainer.
[pause 5s]
They know. They teach. They evaluate.
[pause 5s]
The relationship is vertical. The other learns below.
[pause 6s]
Not inherently wrong.
[pause 4s]
But the long-term result... is dependence.
[pause 8s]

The second... the expert-coach.
[pause 5s]
They guide. They question. They structure action.
[pause 5s]
A more horizontal relationship.
[pause 6s]
The result... performance.
[pause 8s]

The third... the servant-mentor.
[pause 5s]
They go ahead. They protect. They liberate.
[pause 6s]
A relationship of life. One that crosses years.
[pause 6s]
The result... lasting autonomy.
[pause 8s]

The other becomes capable of doing without you.
[pause 5s]
And that is exactly the victory.
[pause 10s]

One breath — 5-5-5.
[pause 4s]
Inhale... 5... 4... 3... 2... 1...
[pause 6s]
Hold... 5... 4... 3... 2... 1...
[pause 6s]
Exhale... 5... 4... 3... 2... 1...
[pause 10s]

There is a question the servant-mentor asks before every interaction.
[pause 6s]

Does this interaction bring them closer to me... or to themselves?
[pause 12s]

If the answer is "to me"...
[pause 4s]
you are building dependence.
[pause 5s]
Not a mentor. Not a transformation.
[pause 5s]
A dependence.
[pause 8s]

Let us be honest now.
[pause 5s]

There are four traps the mentor falls into.
[pause 5s]
Not out of malice. Often out of good intention.
[pause 6s]
But the consequences are the same.
[pause 8s]

The first trap: the need for validation.
[pause 5s]
You accompany to be admired.
[pause 6s]
Do you recognise the moment when you seek approval in your mentee's eyes?
[pause 8s]

The second trap: control disguised as help.
[pause 5s]
You guide... but toward where you want to go.
[pause 5s]
You are disappointed when they do not follow your advice.
[pause 8s]

The third trap: the urgency to fix.
[pause 5s]
You want to solve things too quickly.
[pause 5s]
You interrupt to give solutions before you have truly understood.
[pause 8s]

The fourth trap: excessive imprint.
[pause 5s]
You want them to resemble you.
[pause 5s]
You feel threatened when they develop their own style.
[pause 10s]

The antidote to all four traps... is always the same.
[pause 5s]
Return to the verse. Serve... do not shine.
[pause 10s]

Let us enter the meditation of this module.
[pause 5s]

Three breaths — 5-5-5.
[pause 4s]
Inhale... 5... 4... 3... 2... 1...
[pause 6s]
Hold... 5... 4... 3... 2... 1...
[pause 6s]
Exhale... 5... 4... 3... 2... 1...
[pause 10s]

Visualise someone you have accompanied... or are about to accompany.
[pause 6s]
See their face.
[pause 5s]
Feel their presence.
[pause 5s]

Now... observe your deep intention toward this person.
[pause 6s]

Are you there for them... or for yourself?
[pause 12s]

No judgment.
[pause 5s]
Neither right nor wrong.
[pause 5s]
Just... honesty.
[pause 10s]

If you sense a part of ego... breathe with it.
[pause 6s]
Acknowledge it. Thank it for protecting you until now.
[pause 6s]
And ask it to step aside to make room for service.
[pause 10s]

Ask yourself this question.
[pause 5s]

If nobody ever knew... if no external gaze could see you...
[pause 6s]
would you still do what you do?
[pause 15s]

Stay with this question.
[pause 5s]

If the answer is yes... you have found your servant posture.
[pause 6s]
If it hesitates... that is perfect too.
[pause 5s]
It is an invitation to go deeper.
[pause 8s]

Now — inhale... 5... 4... 3... 2... 1...
[pause 6s]
Hold... 5... 4... 3... 2... 1...
[pause 6s]
Exhale... saying inwardly: I am here to serve.
[pause 10s]

Inhale... 5... 4... 3... 2... 1...
[pause 6s]
Hold... 5... 4... 3... 2... 1...
[pause 6s]
Exhale... I am here to liberate, not to hold.
[pause 10s]

Inhale... 5... 4... 3... 2... 1...
[pause 6s]
Hold... 5... 4... 3... 2... 1...
[pause 6s]
Exhale... my greatness is in my service.
[pause 12s]

Write down what came during this meditation.
[pause 5s]
SCRIPT,

        // ─────────────────────────────────────────────────────────
        // MENTOR EN — Module 03 — Active Listening — target : 18–20 min
        // ─────────────────────────────────────────────────────────
        'mentor-03-ecoute-active' => <<<'SCRIPT'
Settle in.
[pause 5s]

Module three. Active Listening.
[pause 5s]

Before we begin...
[pause 3s]
notice how many thoughts are crossing your mind right now.
[pause 8s]

A to-do list. A message to send. A worry that keeps returning.
[pause 6s]
That is normal.
[pause 4s]
And it is precisely why this module exists.
[pause 8s]

Three breaths — 5-5-5.
[pause 4s]
Inhale... 5... 4... 3... 2... 1...
[pause 6s]
Hold... 5... 4... 3... 2... 1...
[pause 6s]
Exhale... 5... 4... 3... 2... 1...
[pause 10s]

Most people do not listen.
[pause 6s]
They wait for their turn to speak.
[pause 6s]
They build their response while the other is still talking.
[pause 6s]
They filter what they hear through their own experience.
[pause 8s]

This is not ill will.
[pause 4s]
It is simply that nobody ever taught us to truly listen.
[pause 8s]

Active listening is not a technique.
[pause 5s]
It is a state.
[pause 5s]
A state of total presence.
[pause 5s]
Where the other feels — perhaps for the first time — truly understood.
[pause 10s]

There are five levels of listening.
[pause 5s]

Level one: surface listening.
[pause 4s]
You hear the words. Your mind is elsewhere.
[pause 6s]

Level two: partial listening.
[pause 4s]
You catch the main points. You prepare your reply in parallel.
[pause 6s]

Level three: active listening.
[pause 4s]
You follow the thread. You ask clarifying questions.
[pause 6s]

Level four: empathic listening.
[pause 4s]
You feel the emotion behind the words. You reflect before responding.
[pause 6s]

Level five: generative listening.
[pause 5s]
You listen for what has not yet been said.
[pause 5s]
What the person is trying to formulate.
[pause 5s]
You create the space for it to emerge.
[pause 10s]

The mentor aims for level five.
[pause 8s]

Where are you, usually?
[pause 10s]

Be honest. Without judging yourself.
[pause 8s]

The difference between a directed question and a powerful question...
[pause 5s]
is the intention behind it.
[pause 6s]

A directed question leads the other toward where you want to go.
[pause 5s]
"Don't you think you should..."
[pause 4s]
"What if you tried instead..."
[pause 4s]
"It seems to me the solution is..."
[pause 6s]

A powerful question opens without directing.
[pause 5s]
"What is really happening here?"
[pause 5s]
"What would make this perfect?"
[pause 5s]
"If you already knew the answer... what would it be?"
[pause 8s]

And after a powerful question...
[pause 4s]
there is the golden rule.
[pause 5s]

Be silent.
[pause 6s]
Completely.
[pause 6s]
Count to ten if you need to.
[pause 8s]

The silence after a powerful question...
[pause 5s]
is the space where transformation happens.
[pause 5s]
Do not fill it.
[pause 8s]

Now let us enter the meditation of this module.
[pause 5s]

The meditation of inner silence.
[pause 6s]

Three breaths — 5-5-5.
[pause 4s]
Inhale... 5... 4... 3... 2... 1...
[pause 6s]
Hold... 5... 4... 3... 2... 1...
[pause 6s]
Exhale... 5... 4... 3... 2... 1...
[pause 10s]

For the next several minutes...
[pause 4s]
you will do nothing but observe your own thoughts.
[pause 5s]
Without following them. Without fighting them.
[pause 5s]
Just... observe them pass.
[pause 8s]

When a thought arrives...
[pause 4s]
note it mentally: "thought."
[pause 4s]
And return to the breath.
[pause 8s]

That is all.
[pause 5s]
Nothing else.
[pause 6s]

Why this practice for a mentor?
[pause 5s]

Because a mentor who cannot create inner silence...
[pause 5s]
cannot create welcoming silence for the other.
[pause 6s]

You can only offer others what you have first cultivated in yourself.
[pause 10s]

Begin now.
[pause 5s]

Gentle inhale...
[pause 4s]
Slow exhale...
[pause 5s]
Simple presence.
[pause 120s]

You return slowly.
[pause 6s]

Notice how you feel after this moment of silence.
[pause 6s]

A little lighter perhaps.
[pause 4s]
A little more available.
[pause 4s]
A little more present.
[pause 8s]

This quality of presence is what you will bring to those you accompany.
[pause 6s]

They will not name it.
[pause 4s]
But they will feel it.
[pause 5s]
They will feel that you are truly there.
[pause 5s]
And that is what makes the difference.
[pause 10s]

One last breath — 5-5-5.
[pause 4s]
Inhale... 5... 4... 3... 2... 1...
[pause 6s]
Hold... 5... 4... 3... 2... 1...
[pause 6s]
Exhale... 5... 4... 3... 2... 1...
[pause 8s]

Write down what came during this meditation.
[pause 5s]
SCRIPT,

        // ─────────────────────────────────────────────────────────
        // MENTOR EN — Module 04 — Living Transmission — target : 18–20 min
        // ─────────────────────────────────────────────────────────
        'mentor-04-transmission-vivante' => <<<'SCRIPT'
Settle in.
[pause 5s]

Module four. Living Transmission.
[pause 6s]

Three breaths — 5-5-5.
[pause 4s]
Inhale... 5... 4... 3... 2... 1...
[pause 6s]
Hold... 5... 4... 3... 2... 1...
[pause 6s]
Exhale... 5... 4... 3... 2... 1...
[pause 10s]

There is a fundamental difference between someone who teaches... and someone who transmits.
[pause 8s]

The teacher transmits information.
[pause 5s]
The mentor transmits a life.
[pause 8s]

A speech instructs.
[pause 4s]
A lived life inspires.
[pause 8s]

Think of the people who have most deeply influenced you in your life.
[pause 6s]

Was it by what they said?
[pause 5s]
Or by who they were?
[pause 5s]
By the way they lived what they believed?
[pause 10s]

Living transmission is exactly that.
[pause 5s]
When what you say and who you are are aligned.
[pause 6s]
When there is no gap between the mentor in front of the group...
[pause 4s]
and the human being at eleven o'clock at night in their kitchen.
[pause 8s]

It does not require perfection.
[pause 5s]
It requires coherence.
[pause 8s]

Gandhi said: be the change you wish to see in the world.
[pause 6s]
The mentor says: I am already living what I teach.
[pause 8s]

One of the most powerful forms of living transmission...
[pause 5s]
is a true story.
[pause 6s]

Not an anecdote that impresses.
[pause 5s]
Not a carefully polished success story.
[pause 5s]
A true story that liberates.
[pause 8s]

There are five moments in a story that liberates.
[pause 6s]

First moment: the tipping point.
[pause 5s]
"X years ago... I was..."
[pause 5s]
Set the context. Then the moment something changed.
[pause 8s]

Second moment: the descent.
[pause 5s]
"And then... something collapsed."
[pause 5s]
Be honest about what it cost you.
[pause 8s]

Third moment: the crossing.
[pause 5s]
"I had to face..."
[pause 5s]
What you had to go through. Not the heroic version. The true version.
[pause 8s]

Fourth moment: the learning.
[pause 5s]
"What I understood at that moment..."
[pause 5s]
The wisdom you could not have gained any other way.
[pause 8s]

Fifth moment: the bridge.
[pause 5s]
"And that is exactly why I am talking to you about this today."
[pause 6s]
The link between your experience and what your mentee is living.
[pause 10s]

The rule of the story that liberates.
[pause 5s]
Do not tell a story to shine.
[pause 5s]
Tell it so the other can recognise themselves.
[pause 8s]

Now let us enter the meditation of this module.
[pause 5s]

The meditation of inner alignment.
[pause 6s]

Three breaths — 5-5-5.
[pause 4s]
Inhale... 5... 4... 3... 2... 1...
[pause 6s]
Hold... 5... 4... 3... 2... 1...
[pause 6s]
Exhale... 5... 4... 3... 2... 1...
[pause 10s]

Visualise yourself teaching something that matters deeply to you.
[pause 6s]
A subject on which you genuinely have something to say.
[pause 6s]

Do you feel alignment when you imagine transmitting it?
[pause 8s]
Or do you feel a form of impostor syndrome?
[pause 8s]

Where in your body do you feel most authentic in that projection?
[pause 8s]
Where do you feel a gap?
[pause 8s]

Breathe into the place of the gap.
[pause 5s]
Not to solve it.
[pause 4s]
To honour it.
[pause 6s]

That gap says: I am still growing in this area.
[pause 5s]
And that is precious.
[pause 5s]
Because you are not teaching from a summit already reached.
[pause 5s]
You are teaching from the path.
[pause 10s]

Repeat inwardly... or softly aloud if you wish.
[pause 5s]

"I am on the path."
[pause 5s]
"And my path equips me."
[pause 5s]
"I transmit what I live... not only what I know."
[pause 12s]

One last breath — 5-5-5.
[pause 4s]
Inhale... 5... 4... 3... 2... 1...
[pause 6s]
Hold... 5... 4... 3... 2... 1...
[pause 6s]
Exhale... 5... 4... 3... 2... 1...
[pause 10s]

Write down the founding story that surfaced during this meditation.
[pause 5s]
It may well become the cornerstone of your transmission.
[pause 8s]
SCRIPT,

        // ─────────────────────────────────────────────────────────
        // MENTOR EN — Module 05 — Resistances — target : 18–20 min
        // ─────────────────────────────────────────────────────────
        'mentor-05-les-resistances' => <<<'SCRIPT'
Settle in.
[pause 5s]

Module five. Resistances.
[pause 6s]

Three breaths — 5-5-5.
[pause 4s]
Inhale... 5... 4... 3... 2... 1...
[pause 6s]
Hold... 5... 4... 3... 2... 1...
[pause 6s]
Exhale... 5... 4... 3... 2... 1...
[pause 10s]

In every accompaniment... in every group... in every mentoring relationship...
[pause 6s]
you will encounter resistance.
[pause 6s]

Your mentees' resistance.
[pause 4s]
And also... your own.
[pause 8s]

The unprepared mentor experiences resistance as failure.
[pause 6s]
"He doesn't want to change."
[pause 4s]
"She's not ready."
[pause 4s]
"They're not listening to me."
[pause 6s]

The experienced mentor reads resistance as messages.
[pause 8s]

Every resistance says something.
[pause 5s]

"I am afraid."
[pause 4s]
"I don't believe in this yet."
[pause 4s]
"I have been disappointed before."
[pause 4s]
"This is not the right time."
[pause 4s]
"I don't feel capable."
[pause 8s]

Your job is not to remove the resistance.
[pause 5s]
It is to hear it.
[pause 8s]

Five types of resistance you will encounter.
[pause 6s]

The first: resistance through fear.
[pause 5s]
"What if it doesn't work?"
[pause 5s]
Signs: excessive questioning, procrastination, the need for guarantees.
[pause 8s]

The second: resistance through past wounds.
[pause 5s]
"I've already tried this, it didn't work."
[pause 5s]
Signs: cynicism, closure, anticipatory protection.
[pause 8s]

The third: resistance through limiting belief.
[pause 5s]
"I'm not made for this."
[pause 5s]
Signs: systematic self-minimisation, constant comparison with others.
[pause 8s]

The fourth: resistance through denial.
[pause 5s]
"I don't really have a problem."
[pause 5s]
Signs: subject-changing, excessive rationalisation.
[pause 8s]

The fifth: resistance through timing.
[pause 5s]
"Not now... later."
[pause 5s]
Signs: repeated postponement. Sometimes legitimate... often avoidance.
[pause 10s]

For each of these types...
[pause 4s]
there is a five-step transformation protocol.
[pause 6s]

Step one: welcome without correcting.
[pause 5s]
"I hear you. This resistance is here. It is valid."
[pause 6s]

Step two: name without diagnosing.
[pause 5s]
"I sense something that looks like fear. Does that resonate?"
[pause 6s]

Step three: explore with curiosity.
[pause 5s]
"What would happen if this fear were right? And if it were wrong?"
[pause 6s]

Step four: find the resource within the resistance.
[pause 5s]
"What is this resistance protecting? What needs to be respected here?"
[pause 6s]

Step five: propose a tiny step.
[pause 5s]
"Not everything. Not now. Just one percent of movement."
[pause 8s]

Now... I invite you to turn the gaze toward yourself.
[pause 6s]

What is the main resistance you carry right now?
[pause 8s]
Not your mentees'. Yours.
[pause 8s]

Let us enter the meditation of this module.
[pause 5s]

The meditation of inner knots.
[pause 6s]

Three breaths — 5-5-5.
[pause 4s]
Inhale... 5... 4... 3... 2... 1...
[pause 6s]
Hold... 5... 4... 3... 2... 1...
[pause 6s]
Exhale... 5... 4... 3... 2... 1...
[pause 10s]

Think of a resistance you carry right now in your life.
[pause 6s]
Something you keep pushing away. Something you avoid confronting.
[pause 6s]

Locate it in your body.
[pause 5s]
Perhaps in the chest? In the belly? In the throat?
[pause 8s]

Give it a shape.
[pause 5s]
A colour.
[pause 5s]
A texture.
[pause 8s]

Without trying to solve it.
[pause 5s]
Just... meet it.
[pause 8s]

Now ask it a question.
[pause 5s]

"What are you protecting?"
[pause 15s]

Listen.
[pause 5s]
Without defence.
[pause 5s]
Without trying to correct.
[pause 10s]

Whatever you hear...
[pause 4s]
is precious information.
[pause 5s]
It is what your mentees feel when they resist.
[pause 6s]

Every resistance you have crossed yourself equips you to accompany someone else's.
[pause 8s]

Breathe with this resistance.
[pause 6s]
Not to make it leave.
[pause 4s]
To thank it.
[pause 5s]
It has done its protective work.
[pause 5s]
And now... you can go further.
[pause 12s]

One last breath — 5-5-5.
[pause 4s]
Inhale... 5... 4... 3... 2... 1...
[pause 6s]
Hold... 5... 4... 3... 2... 1...
[pause 6s]
Exhale... releasing what no longer needs to be carried.
[pause 12s]

Write down what came.
[pause 5s]
SCRIPT,

        // ─────────────────────────────────────────────────────────
        // MENTOR EN — Module 06 — The Mentor's Energy — target : 18–20 min
        // ─────────────────────────────────────────────────────────
        'mentor-06-energie-du-mentor' => <<<'SCRIPT'
Settle in.
[pause 5s]

Module six. The Mentor's Energy.
[pause 6s]

Three breaths — 5-5-5.
[pause 4s]
Inhale... 5... 4... 3... 2... 1...
[pause 6s]
Hold... 5... 4... 3... 2... 1...
[pause 6s]
Exhale... 5... 4... 3... 2... 1...
[pause 10s]

Here is a truth few mentors want to hear.
[pause 6s]

An exhausted mentor is no longer accompanying.
[pause 5s]
They are surviving.
[pause 6s]

And in survival mode...
[pause 4s]
they unconsciously take energy from those they accompany...
[pause 4s]
instead of giving it.
[pause 8s]

Managing your energy is not a question of comfort.
[pause 5s]
It is a question of ethics.
[pause 8s]

You cannot give what you do not have.
[pause 6s]

A practitioner who does not take care of themselves transmits their exhaustion.
[pause 5s]
Their frustration. Their lack.
[pause 5s]

A practitioner who radiates transmits their vitality.
[pause 5s]
Their peace. Their presence.
[pause 8s]

Those you accompany will not analyse it.
[pause 5s]
But they will feel it.
[pause 5s]
In your voice. In your gaze. In the quality of your silence.
[pause 10s]

There are four energy sources you must consciously nourish.
[pause 6s]

The first: physical energy.
[pause 5s]
Sufficient sleep. Regular movement. Conscious nutrition. Daily 5-5-5 breathing.
[pause 6s]
Diagnostic question: is your body an ally... or a burden right now?
[pause 8s]

The second: emotional energy.
[pause 5s]
Processing unresolved emotions.
[pause 4s]
Nourishing versus draining relationships.
[pause 5s]
Diagnostic question: do you have conversations that weigh you down... or conversations that lighten you?
[pause 8s]

The third: mental energy.
[pause 5s]
Clarity of intention. Absence of dissonance between what you think and what you do.
[pause 6s]
Diagnostic question: do you have recurring intrusive thoughts? Unmade decisions occupying mental space?
[pause 8s]

The fourth: spiritual energy.
[pause 5s]
Connection to your deep purpose.
[pause 4s]
The sense that your life has a direction.
[pause 5s]
Diagnostic question: do you wake up in the morning with a sense of mission... or of obligation?
[pause 10s]

There is a simple daily ritual.
[pause 5s]
The mentor's daily ritual.
[pause 5s]
Fifteen minutes in the morning. Two minutes before each session. Ten minutes in the evening.
[pause 8s]

Morning.
[pause 4s]
Five minutes of 5-5-5 breathing.
[pause 4s]
Five minutes setting the mentor intention for the day: "today I serve by..."
[pause 4s]
Five minutes reading or listening to an inspiring sentence.
[pause 8s]

Before each session.
[pause 4s]
Body check-in. Emotional state. Intention centred on the other.
[pause 6s]

Evening.
[pause 4s]
What did I serve well today?
[pause 4s]
Where did I let myself be drained... and why?
[pause 4s]
What positive thing do I take from this day?
[pause 10s]

Let us enter the meditation of this module.
[pause 5s]

The meditation of the inner fountain.
[pause 6s]

Three breaths — 5-5-5.
[pause 4s]
Inhale... 5... 4... 3... 2... 1...
[pause 6s]
Hold... 5... 4... 3... 2... 1...
[pause 6s]
Exhale... 5... 4... 3... 2... 1...
[pause 10s]

Imagine a luminous source at the centre of your chest.
[pause 6s]

With each inhale... it grows.
[pause 5s]
Warm. Golden. Soothing.
[pause 5s]

With each exhale... it radiates outward.
[pause 6s]
In concentric circles.
[pause 5s]
Touching everything around you.
[pause 8s]

Inhale... 5... 4... 3... 2... 1... the fountain grows.
[pause 8s]
Hold... 5... 4... 3... 2... 1...
[pause 6s]
Exhale... 5... 4... 3... 2... 1... it radiates.
[pause 8s]

Now visualise your four energy sources filling up.
[pause 5s]

First your body.
[pause 4s]
Every cell receiving regenerating light.
[pause 6s]
Every muscle relaxing. Every joint releasing.
[pause 8s]

Now your emotions.
[pause 5s]
All emotional tensions dissolving gently.
[pause 5s]
Like ice melting in sunlight.
[pause 8s]

Your mental space.
[pause 5s]
A space becoming clear. The noise falling quiet.
[pause 5s]
Simple, soothing clarity.
[pause 8s]

Your deep purpose.
[pause 5s]
Reconnect to the reason you chose this path.
[pause 6s]
Not the intellectual reason.
[pause 4s]
The reason of the heart.
[pause 8s]

Remain in this state of fullness.
[pause 5s]

Repeat inwardly.
[pause 5s]
"I nourish myself to nourish others."
[pause 5s]
"I recharge to help others recharge."
[pause 8s]

One last breath — 5-5-5.
[pause 4s]
Inhale... 5... 4... 3... 2... 1...
[pause 6s]
Hold... 5... 4... 3... 2... 1...
[pause 6s]
Exhale... with a gentle smile.
[pause 10s]

Write in your mentor journal: which energy source do you most need to nourish this week?
[pause 5s]
SCRIPT,

        // ─────────────────────────────────────────────────────────
        // MENTOR EN — Module 07 — The Sacred Frame — target : 18–20 min
        // ─────────────────────────────────────────────────────────
        'mentor-07-cadre-sacre' => <<<'SCRIPT'
Settle in.
[pause 5s]

Module seven. The Sacred Frame.
[pause 6s]

Three breaths — 5-5-5.
[pause 4s]
Inhale... 5... 4... 3... 2... 1...
[pause 6s]
Hold... 5... 4... 3... 2... 1...
[pause 6s]
Exhale... 5... 4... 3... 2... 1...
[pause 10s]

Think of a place... a conversation... a moment...
[pause 5s]
where you felt fully safe to be yourself.
[pause 8s]

Truly yourself.
[pause 5s]
Without calculation. Without a mask. Without performance.
[pause 8s]

How did you feel in that space?
[pause 8s]

That is what a sacred frame creates.
[pause 6s]

A sacred frame is not a place.
[pause 5s]
It is a quality of presence.
[pause 5s]
It is what makes someone walk into a room... or into a conversation...
[pause 5s]
and feel instinctively: here, I can be myself.
[pause 10s]

People go years without ever having that space.
[pause 6s]
Without ever having someone in front of them who does not judge.
[pause 5s]
Who is not trying to get something from them.
[pause 5s]
Who is simply... there.
[pause 8s]

Your work as a mentor: create this space. Maintain it. Defend it.
[pause 10s]

Five elements constitute a sacred frame.
[pause 6s]

The first: total confidentiality.
[pause 5s]
What is shared within the frame does not leave the frame.
[pause 5s]
This is the primary condition for trust.
[pause 6s]
Not just as a stated rule... but as a lived commitment.
[pause 8s]

The second: the absence of judgment.
[pause 5s]
This is not approval of everything.
[pause 4s]
It is the welcome of everything.
[pause 5s]
"I listen to you without judging you."
[pause 5s]
And living that... in every micro-reaction.
[pause 5s]
Even when what is shared surprises you.
[pause 8s]

The third: total presence.
[pause 5s]
Phone away. Gaze settled. Body turned toward. Mind available.
[pause 5s]
Not eighty percent present.
[pause 4s]
One hundred percent.
[pause 8s]

The fourth: permission to be incomplete.
[pause 5s]
"You don't have to have the answers here. You just have to be honest."
[pause 5s]
For many people...
[pause 4s]
that permission is the most liberating thing anyone has ever said to them.
[pause 8s]

The fifth: ritualisation of the space.
[pause 5s]
An opening. A shared breath. A word of intention.
[pause 5s]
The body understands that this is different.
[pause 5s]
That what is about to happen here is precious.
[pause 10s]

Let us speak also of what breaks the frame.
[pause 6s]

An unsolicited comment that judges... even well-intentioned.
[pause 5s]
A confidence shared outside the group.
[pause 5s]
A perceived lack of presence from the mentor.
[pause 5s]
A visible surprise or discomfort from the mentor at what is shared.
[pause 8s]

These violations happen.
[pause 5s]
Even to the best mentors.
[pause 5s]

The response is not to flee.
[pause 4s]
It is to name it with sincerity.
[pause 5s]

"I said something that broke the trust. I want to repair it. Here is how."
[pause 8s]

Honest repair often strengthens the frame more than if no violation had occurred.
[pause 8s]

Let us enter the meditation of this module.
[pause 5s]

The meditation of the welcoming space.
[pause 6s]

Three breaths — 5-5-5.
[pause 4s]
Inhale... 5... 4... 3... 2... 1...
[pause 6s]
Hold... 5... 4... 3... 2... 1...
[pause 6s]
Exhale... 5... 4... 3... 2... 1...
[pause 10s]

Imagine the space you are going to create for those you accompany.
[pause 6s]

Not the room. Not the decor.
[pause 5s]
The quality of presence you bring.
[pause 8s]

Visualise someone entering that space.
[pause 5s]
And relaxing.
[pause 4s]
Dropping their guard.
[pause 4s]
Breathing differently.
[pause 6s]

What do you feel in your body when you see that?
[pause 8s]

This is your reason for being as a mentor.
[pause 6s]
That moment when the other rediscovers safety.
[pause 6s]
Where they rediscover a space to be real.
[pause 8s]

Repeat inwardly.
[pause 5s]
"I am this space."
[pause 5s]
"I carry it within me."
[pause 5s]
"It begins with my own peace."
[pause 12s]

One last breath — 5-5-5.
[pause 4s]
Inhale... 5... 4... 3... 2... 1...
[pause 6s]
Hold... 5... 4... 3... 2... 1...
[pause 6s]
Exhale... 5... 4... 3... 2... 1...
[pause 8s]

Return gently.
[pause 5s]
SCRIPT,

        // ─────────────────────────────────────────────────────────
        // MENTOR EN — Module 08 — The Art of Letting Go — target : 18–20 min
        // ─────────────────────────────────────────────────────────
        'mentor-08-art-du-lacher-prise' => <<<'SCRIPT'
Settle in.
[pause 5s]

Module eight. The Art of Letting Go.
[pause 6s]

Three breaths — 5-5-5.
[pause 4s]
Inhale... 5... 4... 3... 2... 1...
[pause 6s]
Hold... 5... 4... 3... 2... 1...
[pause 6s]
Exhale... 5... 4... 3... 2... 1...
[pause 10s]

Here is the mentor's ultimate paradox.
[pause 6s]

The mentor fulfils their mission...
[pause 5s]
when their mentee no longer needs them.
[pause 8s]

Let that sentence resonate.
[pause 6s]

The more successful your work...
[pause 5s]
the more they move away.
[pause 5s]
And that is exactly the victory.
[pause 10s]

A successful parent raises autonomous children.
[pause 5s]
A successful therapist closes their therapeutic relationship.
[pause 5s]
A successful mentor creates other mentors.
[pause 8s]

But our ego... our need to feel useful...
[pause 5s]
can resist this truth.
[pause 6s]

Three forms of attachment in the mentor.
[pause 6s]

The first: attachment to the role.
[pause 5s]
"I need them to need me."
[pause 5s]
Sign: discomfort when a mentee progresses quickly and becomes autonomous.
[pause 8s]

The second: attachment to results.
[pause 5s]
"Their success proves my worth."
[pause 5s]
Sign: personal disappointment when someone quits... even if it is their choice.
[pause 8s]

The third: emotional attachment.
[pause 5s]
The relationship extends beyond the mentoring frame.
[pause 5s]
Sign: difficulty maintaining professional boundaries.
[pause 8s]

Recognising your attachment is not a shame.
[pause 5s]
It is the first act of letting go.
[pause 8s]

Three practices that help.
[pause 6s]

The first: the ritual closing.
[pause 5s]
At the end of every session: "I entrust you to yourself."
[pause 5s]
Symbolically returning responsibility to the other.
[pause 5s]
Cutting the energy of control.
[pause 8s]

The second: delegation to something greater than yourself.
[pause 5s]
"This path is not mine to carry.
[pause 4s]
I do what I can... and I entrust the rest."
[pause 8s]

The third: non-judgmental review.
[pause 5s]
After every accompaniment that ends... well or badly.
[pause 5s]
"What did I learn? What do I let go of?"
[pause 5s]
A closing notebook. Two pages. And you turn the page.
[pause 10s]

Let us enter the meditation of this module.
[pause 5s]

The meditation of compassionate detachment.
[pause 6s]

Three breaths — 5-5-5.
[pause 4s]
Inhale... 5... 4... 3... 2... 1...
[pause 6s]
Hold... 5... 4... 3... 2... 1...
[pause 6s]
Exhale... 5... 4... 3... 2... 1...
[pause 10s]

Think of someone you are accompanying... or have accompanied.
[pause 6s]

Sense whether you are carrying something for them...
[pause 5s]
that belongs to them.
[pause 6s]

A worry on their behalf. A hope for a result. An expectation you have not expressed.
[pause 8s]

Visualise this thing you are carrying.
[pause 5s]
Give it a shape.
[pause 5s]

And now... imagine returning it to them with love.
[pause 6s]

Not with coldness. Not with indifference.
[pause 5s]
With love.
[pause 6s]

"This belongs to you."
[pause 4s]
"I return it to you."
[pause 4s]
"I am here if you need me."
[pause 4s]
"But it is you who carry your path."
[pause 10s]

Feel the relief in your body.
[pause 6s]

The lightness of the mentor who does not carry what is not theirs to carry.
[pause 8s]

Repeat inwardly.
[pause 5s]
"I am present."
[pause 5s]
"I am not responsible for their path."
[pause 5s]
"I am here to illuminate... not to carry."
[pause 12s]

One last breath — 5-5-5.
[pause 4s]
Inhale... 5... 4... 3... 2... 1...
[pause 6s]
Hold... 5... 4... 3... 2... 1...
[pause 6s]
Exhale... releasing what no longer belongs to you.
[pause 12s]

Write down: which current accompaniment asks you to let something go?
[pause 5s]
SCRIPT,

        // ─────────────────────────────────────────────────────────
        // MENTOR EN — Module 09 — My Mentor Signature — target : 20–22 min
        // ─────────────────────────────────────────────────────────
        'mentor-09-signature-de-mentor' => <<<'SCRIPT'
Settle in.
[pause 5s]

Module nine. My Mentor Signature.
[pause 6s]

The last module.
[pause 6s]

Three very slow breaths — 5-5-5.
[pause 4s]
Inhale... 5... 4... 3... 2... 1...
[pause 6s]
Hold... 5... 4... 3... 2... 1...
[pause 6s]
Exhale... 5... 4... 3... 2... 1...
[pause 12s]

You have crossed eight modules.
[pause 5s]

You have explored your identity.
[pause 4s]
You have chosen your posture.
[pause 4s]
You have deepened your listening.
[pause 4s]
You have aligned your transmission.
[pause 4s]
You have crossed resistances.
[pause 4s]
You have nourished your energy.
[pause 4s]
You have created a sacred frame.
[pause 4s]
You have learned to let go.
[pause 8s]

This module is not a summary.
[pause 5s]
It is a living synthesis.
[pause 5s]

The question is no longer: what is a good mentor?
[pause 5s]
It is: what unique mentor are you?
[pause 10s]

Nobody can be you.
[pause 6s]

Your combination of wounds... strengths... values... style...
[pause 5s]
is unique on this planet.
[pause 8s]

What you are going to create will not look like any other mentor.
[pause 6s]
And that is exactly what the world needs.
[pause 10s]

Five dimensions of your mentor signature.
[pause 6s]

The first: your tone.
[pause 5s]
Are you direct or gentle?
[pause 4s]
Provocative or enveloping?
[pause 4s]
Solemn or joyful?
[pause 5s]
This is not what you choose to appear.
[pause 4s]
It is who you are... when you are at ease.
[pause 8s]

The second: your approach.
[pause 5s]
Structured: clear plan, defined steps, concrete tools.
[pause 4s]
Or intuitive: fluid, following the person's feeling.
[pause 5s]
Most mentors are a blend.
[pause 4s]
But one is dominant.
[pause 8s]

The third: your primary strength.
[pause 5s]
Listening. Presence. Clarity. Compassionate provocation. Transmission of experience.
[pause 6s]
Which feels most natural to you?
[pause 8s]

The fourth: your natural audience.
[pause 5s]
Who seeks you out naturally?
[pause 4s]
Who finds you without you having to force it?
[pause 5s]
These are the people you are particularly equipped for.
[pause 8s]

The fifth: your legacy.
[pause 5s]
In ten years...
[pause 4s]
what do the people you accompanied say when they speak of you?
[pause 10s]

Let us enter the final meditation of this formation.
[pause 5s]

The meditation of synthesis and commitment.
[pause 6s]

Settle into the most comfortable position.
[pause 5s]
Take your time. This is not a moment to rush.
[pause 5s]

Three very slow breaths — 5-5-5.
[pause 4s]
Inhale... 5... 4... 3... 2... 1...
[pause 6s]
Hold... 5... 4... 3... 2... 1...
[pause 6s]
Exhale... 5... 4... 3... 2... 1...
[pause 12s]

I will invite you to relive the eight previous modules in images.
[pause 6s]

Module one. Identity.
[pause 5s]
Who are you... before what you transmit?
[pause 6s]
Let an image come.
[pause 8s]

Module two. The Servant Posture.
[pause 5s]
How have you chosen to place yourself in service?
[pause 6s]
Let a sensation come.
[pause 8s]

Module three. Active Listening.
[pause 5s]
The space of silence you now know how to create.
[pause 6s]
Let a colour come.
[pause 8s]

Module four. Living Transmission.
[pause 5s]
The founding story you carry.
[pause 6s]
Let a face come.
[pause 8s]

Module five. Resistances.
[pause 5s]
What you have crossed... and what equips you now.
[pause 6s]
Let a word come.
[pause 8s]

Module six. Energy.
[pause 5s]
The inner fountain you have learned to nourish.
[pause 6s]
Let a light come.
[pause 8s]

Module seven. The Sacred Frame.
[pause 5s]
The space you create where others dare to be real.
[pause 6s]
Let a feeling come.
[pause 8s]

Module eight. Letting Go.
[pause 5s]
The lightness discovered by carrying only what is yours.
[pause 6s]
Let a breath come.
[pause 10s]

Now... with all of this residing in you.
[pause 6s]

Place your right hand on your heart.
[pause 6s]

And say aloud... or in your heart...
[pause 5s]

"I am..."
[pause 4s]
Say your name.
[pause 5s]

"I am a mentor."
[pause 5s]

"I serve through..."
[pause 5s]
Say your founding value.
[pause 8s]

"My legacy begins now."
[pause 12s]

One final breath — 5-5-5.
[pause 4s]
Inhale... 5... 4... 3... 2... 1...
[pause 6s]
Hold... 5... 4... 3... 2... 1...
[pause 6s]
Exhale... 5... 4... 3... 2... 1...
[pause 12s]

Congratulate yourself.
[pause 5s]

You have crossed this formation.
[pause 5s]
You are no longer the same.
[pause 5s]
And those you are going to accompany will not be the same either.
[pause 8s]

This is your legacy.
[pause 5s]
It begins now.
[pause 10s]

Until next time. Mentor.
[pause 8s]
SCRIPT,

        // ─────────────────────────────────────────────────────────
        // MENTOR EN — Module 10 — The Invisible Transmission — target : 16–18 min
        // ─────────────────────────────────────────────────────────
        'mentor-10-transmission-invisible' => <<<'SCRIPT'
Welcome to module 10.
[pause 6s]

The final module.
[pause 8s]

The Invisible Transmission.
[pause 6s]
What you transmit without ever having taught it.
[pause 10s]

This module is different from the others.
[pause 6s]
It gives you no new techniques.
[pause 5s]
It asks you to look at something that few mentors have the courage to face.
[pause 10s]

A disturbing truth.
[pause 6s]

Your students do not learn what you teach.
[pause 6s]
They learn what you are.
[pause 8s]

Not consciously.
[pause 5s]
Through deep neurological mimicry.
[pause 6s]
Their nervous system observes and captures your way of being with your own practice...
[pause 6s]
with uncertainty... with your mistakes... with your body...
[pause 6s]
with money... with conflict... with silence.
[pause 10s]

This is what I call the Invisible Curriculum.
[pause 10s]

Settle in.
[pause 4s]
Inhale deeply...
[pause 5s]
Hold...
[pause 5s]
Release...
[pause 8s]

There are five things you transmit without knowing it.
[pause 8s]

First — your relationship to your own practice.
[pause 6s]
Do you yourself do what you teach?
[pause 6s]
Your students see it. Not in your words. In your body.
[pause 6s]
A mentor who teaches cardiac coherence but vibrates with impatience during class...
[pause 5s]
transmits impatience. Not cardiac coherence.
[pause 10s]

Second — your relationship to your own mistakes.
[pause 6s]
When you are wrong in front of them — what happens inside you?
[pause 6s]
Do you cover it? Justify it? Own it?
[pause 6s]
A mentor who owns their mistakes with grace teaches more about resilience in thirty seconds...
[pause 5s]
than five full modules on the subject.
[pause 10s]

Third — your relationship to uncertainty.
[pause 6s]
Can you say... "I don't know"?
[pause 6s]
Or does uncertainty force you to fill every silence with an answer?
[pause 6s]
A mentor who holds uncertainty with serenity transmits that uncertainty is bearable.
[pause 5s]
That is one of the most liberating learnings for a student.
[pause 10s]

Fourth — your relationship to conflict.
[pause 6s]
When a student contradicts you... how do you actually react?
[pause 6s]
The way you welcome opposition is the way they will learn to welcome it themselves.
[pause 10s]

Fifth — your relationship to your own limit.
[pause 6s]
Do you know when you are tired, out of presence, not at your best?
[pause 6s]
And do you dare name it... or do you always play the unshakeable mentor?
[pause 6s]
Named vulnerability transmits permission to be human.
[pause 5s]
That is one of the rarest gifts a mentor can offer.
[pause 10s]

Inhale deeply...
[pause 5s]
Hold...
[pause 5s]
Release...
[pause 8s]

Let us now talk about failure as pedagogical material.
[pause 6s]

Ask any adult to recall a lesson that changed their life.
[pause 8s]
In nine cases out of ten... it was not when the mentor shone.
[pause 6s]
It was when they fell... and got back up in front of them.
[pause 10s]

Success creates admiration. And often distance.
[pause 6s]
"That is for them. Not for me."
[pause 8s]

Failure shared with grace creates identification.
[pause 6s]
"If they crossed that and continued — I can too."
[pause 8s]

Success transmits a result.
[pause 5s]
Failure transmits... a path.
[pause 10s]

Three rules for sharing failure in a way that transforms.
[pause 6s]

First — name the failure precisely.
[pause 5s]
Not "I went through difficult things."
[pause 5s]
"I had twelve students registered for my second training. Four came."
[pause 8s]

Second — name what you felt. Really.
[pause 5s]
Not the softened version.
[pause 5s]
The version that still hurts a little when you say it.
[pause 8s]

Third — name what it changed.
[pause 5s]
How that failure refined your practice, your humility, your service.
[pause 10s]

This is not weakness.
[pause 5s]
This is living transmission.
[pause 10s]

Inhale deeply...
[pause 5s]
Hold...
[pause 5s]
Release...
[pause 8s]

There is a subtle trap that awaits successful mentors.
[pause 6s]
It is called knowledge crystallisation.
[pause 8s]

The day when you teach the same thing...
[pause 5s]
in the same way...
[pause 5s]
with the same certainty...
[pause 5s]
for too long...
[pause 6s]
you have stopped transmitting something living.
[pause 5s]
You are transmitting an archive.
[pause 10s]

There is a palpable difference between a mentor who recites...
[pause 5s]
and a mentor who discovers while teaching.
[pause 10s]

Four practices of the perpetual student.
[pause 6s]

First — practise yourself, always.
[pause 5s]
Not for the example. For your own continued discovery.
[pause 8s]

Second — actively seek out people who contradict you.
[pause 5s]
Not to convince them. To let yourself be questioned.
[pause 8s]

Third — use your students as teachers.
[pause 5s]
Their naive questions are often the deepest ones.
[pause 5s]
"I don't know — let us explore this together" is one of the most powerful phrases a mentor can say.
[pause 8s]

Fourth — keep a journal of your own recent discoveries.
[pause 5s]
If you have nothing new to write for three months... that is a warning sign.
[pause 10s]

Inhale deeply...
[pause 5s]
Hold...
[pause 5s]
Release...
[pause 8s]

One final dimension.
[pause 6s]
The living lineage.
[pause 8s]

Your students will one day transmit to others.
[pause 6s]
Those others will transmit to others still.
[pause 6s]
In twenty years, people who have never met you...
[pause 5s]
will be influenced by the way you behaved with your students today.
[pause 10s]

This is not a metaphor.
[pause 5s]
It is transmitting behaviour through time.
[pause 10s]

Great transmitters do not transmit their method.
[pause 6s]
They transmit the love of the method.
[pause 6s]
They do not want copies of themselves.
[pause 5s]
They want different versions who continue the fire.
[pause 8s]

Their highest victory?
[pause 6s]
A student who surpasses them.
[pause 5s]
And who celebrates that with them.
[pause 10s]

The question every mentor should ask themselves once a year.
[pause 6s]
"Do my students, by observing my life...
[pause 5s]
learn what I want them to learn?"
[pause 15s]

If the answer is "I am not sure"...
[pause 5s]
that is where the work begins.
[pause 10s]

In your mentor journal.
[pause 6s]
Five honest questions.
[pause 6s]

In the last thirty days — have you practised the tools you teach for yourself?
[pause 18s]

What is the last mistake you made in your role as mentor?
[pause 18s]

Is there a teaching you give on autopilot for too long?
[pause 18s]

If your students were to describe you — not your teaching, YOU — what would they say?
[pause 18s]

Name three behaviours you hope to see in your students in ten years. Do you embody those three things today?
[pause 18s]

Write.
[pause 5s]
Return to this inventory once a year.
[pause 5s]
It is the most honest act of a mentor.
[pause 10s]

Until next time, mentor.
[pause 5s]
Keep learning.
[pause 5s]
Keep transmitting something living.
[pause 10s]
SCRIPT,

        // ─────────────────────────────────────────────────────────
        // MODULE 40 EN — "Moving Through Loss" — target : 14–16 min
        // ─────────────────────────────────────────────────────────
        '40-traverser-la-perte' => <<<'SCRIPT'
Welcome.
[pause 6s]

Take a moment to find a position in which you can truly settle.
[pause 4s]
Lying down or sitting, your back supported.
[pause 3s]
Hands resting on your belly or your heart.
[pause 5s]

Close your eyes if you wish.
[pause 4s]

There is something courageous about being here.
[pause 5s]
About having chosen to pause... in a moment that may be carrying something heavy.
[pause 6s]

This module will not ask you to feel better.
[pause 5s]
It will not ask you to turn the page.
[pause 5s]
It simply asks you... to be here. With what is.
[pause 8s]

Let us breathe together three times before we begin.
[pause 4s]

[BREATHING_CYCLES]

[pause 8s]

Let your breathing return to its natural rhythm.
[pause 5s]

I would like to ask you a question.
[pause 5s]
Not for you to answer with thought.
[pause 4s]
But for you to answer with your body.
[pause 5s]

Where is the loss... in your body... right now?
[pause 8s]

For some, it is a tight throat.
[pause 4s]
For others, a hollow in the middle of the chest, as if something were missing there.
[pause 5s]
Sometimes it is a weighted back.
[pause 4s]
Hands that have forgotten what to hold.
[pause 5s]
Or simply a tiredness... deep... with no clear origin.
[pause 6s]

Locate that place.
[pause 5s]
And if you can... place a hand on it.
[pause 6s]
Not to make it leave.
[pause 4s]
Just to say: I know you are here.
[pause 8s]

Neuroscientist Mary-Frances O'Connor spent twenty years studying the brains of grieving people.
[pause 5s]
And what she discovered is both painful and liberating:
[pause 5s]
the pain you feel... is real.
[pause 6s]
Not a fragility. Not a lack of character.
[pause 5s]
But a neurological response to a real loss.
[pause 5s]
The same circuits that activated when you anticipated that presence... keep searching.
[pause 6s]
And each confrontation with absence... is a micro-withdrawal in the brain.
[pause 8s]

This is not in the head.
[pause 4s]
It is in the body.
[pause 4s]
It is in the arms that held.
[pause 4s]
In the voice that called.
[pause 4s]
In the eyes that searched.
[pause 6s]

The body carries what the mind cannot yet name.
[pause 8s]

Let us return to the breath.
[pause 4s]
This time with a precise intention.
[pause 5s]

[BREATHING_CYCLES]

[pause 8s]

Five counts to breathe in... and welcome what is.
[pause 4s]
Five counts of silence... to hold. Without collapsing. Without fleeing.
[pause 4s]
Five counts to breathe out... and release the weight of one moment.
[pause 5s]
Not releasing the person.
[pause 4s]
Not releasing the memory.
[pause 5s]
Just... the weight of this precise moment.
[pause 8s]

[BREATHING_CYCLES]

[pause 8s]

There is a myth we must dismantle together.
[pause 5s]
The myth of "grieving properly."
[pause 6s]
The idea that you should "let go," "turn the page," "move on."
[pause 7s]

In 1996, researchers Klass, Silverman, and Nickman demonstrated something people who have lost someone already know intuitively:
[pause 5s]
maintaining a bond with what has gone... is not pathology.
[pause 5s]
It is health.
[pause 6s]

Talking about the person who is gone.
[pause 4s]
Honoring their memory.
[pause 4s]
Writing to them still.
[pause 4s]
Cooking what they loved.
[pause 4s]
Keeping their rituals.
[pause 5s]

None of this... is being stuck.
[pause 5s]
It is staying connected.
[pause 8s]

Grief does not ask you to forget.
[pause 5s]
It asks you to learn to carry differently.
[pause 8s]

Now... I would like to invite an image to come.
[pause 5s]
A memory.
[pause 4s]
Not necessarily the most painful one.
[pause 5s]
Perhaps the truest.
[pause 5s]
A moment... with that person, that relationship, that version of yourself... that carries something beautiful.
[pause 8s]

A smile you saw.
[pause 5s]
A phrase that was said to you.
[pause 5s]
A place you shared.
[pause 5s]
A quality you loved.
[pause 8s]

Stay with this image.
[pause 6s]
Without analyzing it.
[pause 4s]
Without defending against what it brings up.
[pause 5s]
Let yourself be moved.
[pause 10s]

What you feel there... is proof of love.
[pause 5s]
Not of weakness.
[pause 6s]
It is the price we pay for having loved.
[pause 5s]
And if we paid it, it is because it was worth it.
[pause 10s]

There is something I wanted to share with you.
[pause 5s]
An idea from David Kessler... who spent his life accompanying the bereaved.
[pause 5s]
He says grief has a sixth stage.
[pause 5s]
Not an obligation.
[pause 4s]
But a possibility.
[pause 6s]
This stage is called: finding meaning.
[pause 7s]

Not a meaning imposed from outside.
[pause 5s]
Not "it was for the best" or "God had a plan."
[pause 6s]
A meaning you construct yourself.
[pause 5s]
At your own pace.
[pause 5s]
Which can take years.
[pause 5s]
And which can take very different forms for each person.
[pause 8s]

Some find this meaning in a commitment.
[pause 4s]
Others in a creation.
[pause 4s]
Others in how they choose to live.
[pause 4s]
Others in what they transmit.
[pause 8s]

And still others... have not yet found that meaning.
[pause 5s]
That is also valid.
[pause 5s]
Holding on in the absence of meaning... is sometimes the most courageous work one can do.
[pause 8s]

Viktor Frankl, who survived the concentration camps and lost almost everyone he loved, wrote a sentence I entrust to you:
[pause 5s]
"Everything can be taken from a man... but one thing.
[pause 4s]
The last of human freedoms.
[pause 4s]
To choose one's attitude in any given set of circumstances."
[pause 10s]

You do not choose the loss.
[pause 5s]
You choose how you move through it.
[pause 8s]

Let us return to the breath one final time.
[pause 4s]

[BREATHING_CYCLES]

[pause 8s]

[BREATHING_CYCLES]

[pause 10s]

I will leave you with an inner invitation.
[pause 5s]
Say to yourself, inwardly or aloud if you wish:
[pause 5s]
I carry this loss.
[pause 4s]
And I continue to live.
[pause 4s]
These two things do not contradict each other.
[pause 4s]
They coexist.
[pause 5s]
And I am capable of holding them both.
[pause 10s]

Now...
[pause 4s]
Feel the weight of your body in the position you are in.
[pause 5s]
Feel your breath... continuing.
[pause 5s]
Feel... this capacity you have... to hold.
[pause 6s]
It has always been there.
[pause 5s]
Even when you no longer believed it.
[pause 8s]

[pause 8s]

Now... I would like to invite you to take one more step.
[pause 6s]
A step that loss makes possible.
[pause 5s]
A step that nothing else could have made this real.
[pause 8s]

People who have lost someone young — someone their age, with children, with plans — often describe it the same way.
[pause 6s]
They say: since that day, I no longer see life the same way.
[pause 6s]
They don't say it as a consolation.
[pause 5s]
They say it as a bare truth.
[pause 6s]
The death of another... fractured something in their silent certainty that they had time.
[pause 8s]

The psychiatrist Irvin Yalom calls this an awakening experience.
[pause 5s]
Not a wound to heal.
[pause 4s]
A clarity to receive.
[pause 8s]

So I would like to ask you a question.
[pause 5s]
Not a rhetorical question.
[pause 4s]
A real question. That deserves a real answer.
[pause 6s]

If you knew, tonight, that you had ten years ahead of you.
[pause 5s]
Not the vague hope of a long life.
[pause 4s]
Ten years. Precisely.
[pause 6s]

Who would you spend them with?
[pause 8s]

Who have you not yet spent enough time with?
[pause 8s]

What journey have you promised your children... and postponed to "when conditions are better"?
[pause 8s]

What sentence have you never said to someone who matters... because you thought you had time?
[pause 10s]

Take the time these questions deserve.
[pause 8s]

[BREATHING_CYCLES]

[pause 8s]

There is a researcher at Stanford named Laura Carstensen.
[pause 5s]
She spent twenty years studying how human priorities change when people perceive that time is limited.
[pause 5s]
Her finding is striking in its simplicity:
[pause 5s]
when the horizon narrows... the superficial disappears.
[pause 5s]
People spontaneously abandon activities without depth.
[pause 5s]
And they invest massively in what truly matters.
[pause 5s]
Their loved ones. Their experiences. Their meaning.
[pause 6s]

And what she also found... is that this shift does not require growing old.
[pause 5s]
It requires realizing.
[pause 8s]

You are in the process of realizing.
[pause 6s]
Perhaps since the loss you moved through.
[pause 5s]
Perhaps since this module.
[pause 5s]
Perhaps since this breath.
[pause 8s]

[BREATHING_CYCLES]

[pause 8s]

There is an Australian nurse named Bronnie Ware.
[pause 5s]
She spent years at the bedsides of dying people.
[pause 5s]
And she collected their regrets — without embellishing them.
[pause 6s]

The regret most often cited, almost unanimously:
[pause 5s]
"I wish I had the courage to live a life true to myself.
[pause 4s]
Not the life others expected of me."
[pause 8s]

And the second:
[pause 5s]
"I wish I hadn't worked so hard."
[pause 8s]

Not: I wish I had more money.
[pause 4s]
Not: I wish I had a bigger house.
[pause 4s]
Not: I wish I had more success.
[pause 6s]

Having dared.
[pause 5s]
And having been there.
[pause 8s]

Do you hear the two things your loved ones are waiting for from you?
[pause 8s]
Not your success.
[pause 5s]
Your presence.
[pause 5s]
And your life truly lived.
[pause 10s]

[BREATHING_CYCLES]

[pause 8s]

I will leave you with one image.
[pause 5s]
Not a to-do list.
[pause 4s]
An image.
[pause 6s]

Imagine you are 80 years old.
[pause 5s]
A summer evening. Your children, now grown, are around you.
[pause 5s]
They are talking about you.
[pause 5s]
Telling who you were.
[pause 5s]
Saying what you transmitted to them.
[pause 5s]
What they learned by your side.
[pause 5s]
The moments they will never forget.
[pause 8s]

What do they say?
[pause 10s]

Take the time to hear that answer.
[pause 8s]

Now.
[pause 5s]
The distance between this image... and your life as it is today.
[pause 5s]
That is your work.
[pause 5s]
Not a guilt.
[pause 4s]
A direction.
[pause 8s]

Your life is not a given.
[pause 5s]
It is not something you earned once and for all at birth.
[pause 5s]
It is a fragile gift, renewed every morning.
[pause 5s]
And this gift... can stop.
[pause 5s]
For you. For someone you love.
[pause 5s]
At any moment. For reasons you cannot control.
[pause 8s]

So one last time, let us breathe together.
[pause 4s]

[BREATHING_CYCLES]

[pause 10s]

Say inwardly, or aloud if you can:
[pause 5s]
I carry the loss of those I have loved.
[pause 4s]
And I choose to truly live.
[pause 5s]
These two things coexist.
[pause 5s]
And today, now, I give myself permission to begin.
[pause 10s]

Take all the time you need to return.
[pause 6s]

Until next time.
[pause 5s]
Not to feel better.
[pause 4s]
To live more truly.
[pause 5s]
It is the only response worthy of those who no longer have time.
[pause 10s]
SCRIPT,

    ];

    // ── suppression anciens scripts EN (remplacés ci-dessus) ──────
    private array $_legacyEn = [
        '_removed' => <<<'SCRIPT'
Welcome.
[pause 6s]

Find a place where you feel at ease.
[pause 3s]
A bed... a sofa... or on the floor on a mat.
[pause 6s]

Lie down.
[pause 4s]
Legs uncrossed... feet slightly apart.
[pause 3s]
Place your hands on your belly... to feel the movement of your breath.
[pause 7s]

If you like... soft music in the background.
[pause 8s]

Close your eyes.
[pause 10s]

There is something strange about our time.
[pause 4s]
We are constantly moving... constantly connected... constantly busy.
[pause 5s]
And yet... something in us remains unanswered.
[pause 8s]

It is not a lack of willpower.
[pause 3s]
It is not a lack of effort.
[pause 6s]

It is the absence of one simple thing... almost forgotten.
[pause 4s]
Meeting yourself.
[pause 9s]

This module does not ask you to change.
[pause 3s]
It asks you first to see.
[pause 3s]
Honestly.
[pause 3s]
Without defenses.
[pause 3s]
Without judgment.
[pause 8s]

This is where the work begins. Through the body.
[pause 10s]

We will practice the Pause Souffle method.
[pause 3s]
The five-five-five technique.
[pause 5s]

On the inhale... let the jaw open gently... as if it releases on its own.
[pause 4s]
During the hold... mouth wide open... in that suspended silence.
[pause 4s]
On the exhale... lips slightly narrowed... as if blowing on a candle without putting it out.
[pause 6s]

Five seconds to inhale.
[pause 2s]
Five seconds to hold.
[pause 2s]
Five seconds to exhale.
[pause 4s]
Ten cycles.
[pause 2s]
Two and a half minutes of pure presence.
[pause 4s]
If the mind drifts... let it.
[pause 3s]
And simply return... to the breath.
[pause 7s]

We begin.
[BREATHING_CYCLES]
Good.
[pause 7s]

Let the breath return to its own rhythm.
[pause 6s]

This stillness.
[pause 3s]
This lightness.
[pause 3s]
This presence to yourself.
[pause 10s]

A question... let it simply resonate.
[pause 6s]

What am I chasing?
[pause 12s]

What am I avoiding feeling... when I stay in motion?
[pause 12s]

If I truly stopped... what would still be there?
[pause 12s]

Write down what came... in your journal.
[pause 4s]
Without judging it.
[pause 5s]

You have just met yourself.
[pause 8s]

See you soon.
SCRIPT,

        // ─────────────────────────────────────────────────────────
        // MODULE 2 EN — "I Recognize My Wounds" — target : 5–6 min
        // ─────────────────────────────────────────────────────────
        '02-je-reconnais-mes-blessures' => <<<'SCRIPT'
Welcome to module two.
[pause 2s]
I Recognize My Wounds.
[pause 3s]

Settle in again.
[pause 2s]
Back straight.
[pause 1.5s]
Feet on the floor.
[pause 1.5s]
Hands resting.
[pause 3s]

Let us begin with a breath.
[pause 2s]

Inhale.
[pause 1s]
One.
[pause 1.5s]
Two.
[pause 1.5s]
Three.
[pause 1.5s]
Four.
[pause 1.5s]
Five.
[pause 2s]

Hold.
[pause 1s]
One.
[pause 1.5s]
Two.
[pause 1.5s]
Three.
[pause 2s]

Exhale.
[pause 1s]
One.
[pause 1.5s]
Two.
[pause 1.5s]
Three.
[pause 1.5s]
Four.
[pause 1.5s]
Five.
[pause 1.5s]
Six.
[pause 5s]

This module asks for a little courage.
[pause 3s]
Not bravery.
[pause 2s]
Just... a little tenderness toward yourself.
[pause 4s]

We all carry wounds.
[pause 2s]
Words heard too early.
[pause 2s]
Absences we misread.
[pause 2s]
Losses we were never allowed to grieve.
[pause 4s]

The body holds all of it.
[pause 2s]
Long before the mind understands.
[pause 4s]

These wounds are not flaws.
[pause 2s]
They are maps.
[pause 2s]
They show where you needed protection.
[pause 2s]
And where you can now begin... to release.
[pause 5s]

The first step is not to heal.
[pause 2s]
It is to see.
[pause 4s]

Let us breathe together.
[pause 2s]

Inhale.
[pause 1s]
One.
[pause 1.5s]
Two.
[pause 1.5s]
Three.
[pause 1.5s]
Four.
[pause 1.5s]
Five.
[pause 2s]

Exhale.
[pause 1s]
One.
[pause 1.5s]
Two.
[pause 1.5s]
Three.
[pause 1.5s]
Four.
[pause 1.5s]
Five.
[pause 1.5s]
Six.
[pause 5s]

Bring your attention now to an area of your body.
[pause 2s]
An area that holds tension.
[pause 3s]
Perhaps the throat.
[pause 2s]
Perhaps the stomach.
[pause 2s]
Perhaps the chest.
[pause 3s]

Do not try to make it go away.
[pause 2s]
Simply breathe toward it.
[pause 2s]
And say inwardly...
[pause 2s]
I see you.
[pause 5s]

Inhale toward the tension.
[pause 1s]
One.
[pause 1.5s]
Two.
[pause 1.5s]
Three.
[pause 1.5s]
Four.
[pause 1.5s]
Five.
[pause 2s]

Exhale, releasing.
[pause 1s]
One.
[pause 1.5s]
Two.
[pause 1.5s]
Three.
[pause 1.5s]
Four.
[pause 1.5s]
Five.
[pause 1.5s]
Six.
[pause 5s]

Once more.
[pause 2s]

Inhale.
[pause 1s]
One.
[pause 1.5s]
Two.
[pause 1.5s]
Three.
[pause 1.5s]
Four.
[pause 1.5s]
Five.
[pause 2s]

Exhale.
[pause 1s]
One.
[pause 1.5s]
Two.
[pause 1.5s]
Three.
[pause 1.5s]
Four.
[pause 1.5s]
Five.
[pause 1.5s]
Six.
[pause 6s]

Good.
[pause 3s]

The wound that is hardest to look at...
[pause 2s]
is often the one we have turned into strength.
[pause 4s]

After this session... I invite you to write a short letter.
[pause 2s]
To the version of yourself that was hurt.
[pause 3s]

Begin simply with these words.
[pause 2s]
I see you.
[pause 2s]
And I understand why you protected yourself.
[pause 5s]

You have nothing to fix right now.
[pause 2s]
Just to see.
[pause 4s]

See you soon... for the next module.
SCRIPT,

        // ─────────────────────────────────────────────────────────
        // MODULE 3 EN — "I Describe My Happiness" — target : 6–8 min
        // ─────────────────────────────────────────────────────────
        '03-je-decris-mon-bonheur' => <<<'SCRIPT'
Module three.
[pause 2s]
I Describe My Happiness.
[pause 3s]

Settle in.
[pause 2s]
Breathe freely... for a few moments.
[pause 5s]

Inhale.
[pause 1s]
One.
[pause 1.5s]
Two.
[pause 1.5s]
Three.
[pause 1.5s]
Four.
[pause 1.5s]
Five.
[pause 2s]

Hold.
[pause 1s]
One.
[pause 1.5s]
Two.
[pause 1.5s]
Three.
[pause 2s]

Exhale.
[pause 1s]
One.
[pause 1.5s]
Two.
[pause 1.5s]
Three.
[pause 1.5s]
Four.
[pause 1.5s]
Five.
[pause 1.5s]
Six.
[pause 5s]

Many people know precisely what they no longer want.
[pause 3s]
The exhaustion.
[pause 2s]
The noise.
[pause 2s]
The relentless pressure.
[pause 3s]

But very few can describe what they truly want.
[pause 4s]

That is not a failure.
[pause 2s]
No one taught us to look in that direction.
[pause 4s]

Happiness is not an abstract destination.
[pause 2s]
It is built from concrete moments.
[pause 2s]
Precise sensations.
[pause 2s]
Instants the body recognizes before the mind does.
[pause 4s]

If you do not know what your happiness looks like...
[pause 2s]
you cannot recognize it when it arrives.
[pause 5s]

Let us breathe.
[pause 2s]

Inhale.
[pause 1s]
One.
[pause 1.5s]
Two.
[pause 1.5s]
Three.
[pause 1.5s]
Four.
[pause 1.5s]
Five.
[pause 2s]

Exhale.
[pause 1s]
One.
[pause 1.5s]
Two.
[pause 1.5s]
Three.
[pause 1.5s]
Four.
[pause 1.5s]
Five.
[pause 1.5s]
Six.
[pause 5s]

Let a memory come to mind now.
[pause 3s]
A specific moment.
[pause 2s]
When you felt fully alive.
[pause 2s]
Fully yourself.
[pause 5s]

How old were you?
[pause 6s]

Where were you?
[pause 6s]

What were you doing?
[pause 6s]

What did you feel in your body... in that moment?
[pause 8s]

This memory is a compass.
[pause 2s]
It tells you something essential.
[pause 2s]
About what truly nourishes you.
[pause 4s]

Return to the breath.
[pause 2s]

Inhale.
[pause 1s]
One.
[pause 1.5s]
Two.
[pause 1.5s]
Three.
[pause 1.5s]
Four.
[pause 1.5s]
Five.
[pause 2s]

Exhale.
[pause 1s]
One.
[pause 1.5s]
Two.
[pause 1.5s]
Three.
[pause 1.5s]
Four.
[pause 1.5s]
Five.
[pause 1.5s]
Six.
[pause 5s]

Now, a second exploration.
[pause 3s]

Think of a recent day that felt right.
[pause 2s]
Not perfect.
[pause 2s]
But right.
[pause 4s]

What made it feel that way?
[pause 6s]

Who were you with?
[pause 6s]

What did you feel that evening, coming home?
[pause 8s]

These elements... are your real happiness.
[pause 2s]
Not the happiness you were sold.
[pause 2s]
Yours.
[pause 5s]

After this session...
[pause 2s]
Take a sheet of paper.
[pause 2s]
Describe your happiness in five concrete sentences.
[pause 2s]
Not grand ideals.
[pause 2s]
True details.
[pause 4s]

This work is rare.
[pause 2s]
Few people make the space for it.
[pause 2s]
You just did.
[pause 5s]

See you soon... for module four.
SCRIPT,

        // ─────────────────────────────────────────────────────────
        // MODULE 4 EN — "I Listen to My Breath" — target : 6–8 min
        // ─────────────────────────────────────────────────────────
        '04-j-ecoute-mon-souffle' => <<<'SCRIPT'
Module four.
[pause 2s]
I Listen to My Breath.
[pause 3s]

This module is the core of the training.
[pause 3s]

Settle in.
[pause 2s]
A few free breaths first.
[pause 6s]

The breath is the only system in the body that is both automatic and conscious.
[pause 3s]
Your heart beats without any decision from you.
[pause 2s]
Your digestion happens without your permission.
[pause 3s]
But the breath...
[pause 2s]
You can choose it.
[pause 2s]
Right now.
[pause 2s]
And shift your entire inner state in minutes.
[pause 4s]

There is a quiet power in that.
[pause 3s]
Not the power to control others.
[pause 2s]
Not the power to manage every outcome.
[pause 3s]
But the power to return to yourself.
[pause 2s]
In any circumstance.
[pause 5s]

We will practice cardiac coherence now.
[pause 2s]
Five seconds in.
[pause 2s]
Five seconds out.
[pause 2s]
No force.
[pause 2s]
No effort.
[pause 4s]

Let us begin.
[pause 2s]

Inhale through the nose.
[pause 1s]
One.
[pause 1.5s]
Two.
[pause 1.5s]
Three.
[pause 1.5s]
Four.
[pause 1.5s]
Five.
[pause 2s]

Exhale through the mouth.
[pause 1s]
One.
[pause 1.5s]
Two.
[pause 1.5s]
Three.
[pause 1.5s]
Four.
[pause 1.5s]
Five.
[pause 3s]

Inhale.
[pause 1s]
One.
[pause 1.5s]
Two.
[pause 1.5s]
Three.
[pause 1.5s]
Four.
[pause 1.5s]
Five.
[pause 2s]

Exhale.
[pause 1s]
One.
[pause 1.5s]
Two.
[pause 1.5s]
Three.
[pause 1.5s]
Four.
[pause 1.5s]
Five.
[pause 3s]

Inhale.
[pause 1s]
One.
[pause 1.5s]
Two.
[pause 1.5s]
Three.
[pause 1.5s]
Four.
[pause 1.5s]
Five.
[pause 2s]

Exhale.
[pause 1s]
One.
[pause 1.5s]
Two.
[pause 1.5s]
Three.
[pause 1.5s]
Four.
[pause 1.5s]
Five.
[pause 3s]

Continue at your own pace now.
[pause 2s]
Five in... five out.
[pause 2s]
Without following me.
[pause 2s]
Just you.
[pause 2s]
And the breath.
[pause 30s]

Inhale.
[pause 1s]
One.
[pause 1.5s]
Two.
[pause 1.5s]
Three.
[pause 1.5s]
Four.
[pause 1.5s]
Five.
[pause 2s]

Exhale.
[pause 1s]
One.
[pause 1.5s]
Two.
[pause 1.5s]
Three.
[pause 1.5s]
Four.
[pause 1.5s]
Five.
[pause 3s]

Come back gently.
[pause 3s]
Let the breath return to its natural rhythm.
[pause 5s]

How do you feel right now?
[pause 5s]

This state...
[pause 2s]
Is your reference point.
[pause 2s]
Calm.
[pause 2s]
Present.
[pause 2s]
Grounded.
[pause 4s]

You can return here... at any moment.
[pause 2s]
Three cycles of breath.
[pause 2s]
Before a meeting.
[pause 2s]
After tension.
[pause 2s]
First thing in the morning.
[pause 4s]

This is now your tool.
[pause 2s]
And soon... the one you will pass on.
[pause 5s]

See you soon... for module five.
SCRIPT,

        // ─────────────────────────────────────────────────────────
        // MODULE 5 EN — "I Discover My Mission" — target : 7–9 min
        // ─────────────────────────────────────────────────────────
        '05-je-decouvre-ma-mission' => <<<'SCRIPT'
Module five.
[pause 2s]
I Discover My Mission.
[pause 3s]

Settle in.
[pause 2s]
Let the body adjust.
[pause 5s]

Inhale.
[pause 1s]
One.
[pause 1.5s]
Two.
[pause 1.5s]
Three.
[pause 1.5s]
Four.
[pause 1.5s]
Five.
[pause 2s]

Hold.
[pause 1s]
One.
[pause 1.5s]
Two.
[pause 1.5s]
Three.
[pause 2s]

Exhale.
[pause 1s]
One.
[pause 1.5s]
Two.
[pause 1.5s]
Three.
[pause 1.5s]
Four.
[pause 1.5s]
Five.
[pause 1.5s]
Six.
[pause 5s]

There is a question very few people genuinely ask themselves.
[pause 3s]
Not: what do I want to do?
[pause 3s]
But: why am I here?
[pause 5s]

The answer is not in a degree.
[pause 2s]
Not in a title.
[pause 2s]
Not in what others expect of you.
[pause 4s]

It lives at the intersection of three things.
[pause 3s]

What you have been through.
[pause 4s]

What comes naturally to you.
[pause 4s]

And what the world needs.
[pause 5s]

Let us breathe... to let that question land.
[pause 2s]

Inhale.
[pause 1s]
One.
[pause 1.5s]
Two.
[pause 1.5s]
Three.
[pause 1.5s]
Four.
[pause 1.5s]
Five.
[pause 2s]

Exhale.
[pause 1s]
One.
[pause 1.5s]
Two.
[pause 1.5s]
Three.
[pause 1.5s]
Four.
[pause 1.5s]
Five.
[pause 1.5s]
Six.
[pause 5s]

First exploration.
[pause 2s]

Think of something you do with effortless ease.
[pause 2s]
Something that feels obvious to you.
[pause 2s]
And that others find complex.
[pause 6s]

What is that for you?
[pause 8s]

Second exploration.
[pause 2s]

Think of a difficulty you have moved through.
[pause 2s]
Not to relive it.
[pause 2s]
But to see what it taught you.
[pause 4s]

What did you understand... that you could not have understood otherwise?
[pause 8s]

Return to the breath.
[pause 2s]

Inhale.
[pause 1s]
One.
[pause 1.5s]
Two.
[pause 1.5s]
Three.
[pause 1.5s]
Four.
[pause 1.5s]
Five.
[pause 2s]

Exhale.
[pause 1s]
One.
[pause 1.5s]
Two.
[pause 1.5s]
Three.
[pause 1.5s]
Four.
[pause 1.5s]
Five.
[pause 1.5s]
Six.
[pause 5s]

Third exploration.
[pause 2s]

If you could change one thing in someone's life...
[pause 2s]
Just one thing.
[pause 4s]
What would it be?
[pause 8s]

The answers to these three questions...
[pause 2s]
often form the beginning of a mission.
[pause 4s]

You do not need to understand everything right now.
[pause 2s]
The mission reveals itself as you walk.
[pause 2s]
As you serve.
[pause 2s]
As you transmit.
[pause 5s]

After this session...
[pause 2s]
Complete this sentence, in writing.
[pause 2s]
My presence in the lives of others...
[pause 2s]
allows...
[pause 8s]

Let what comes... come.
[pause 2s]
Without correcting it.
[pause 2s]
Without judging it.
[pause 5s]

You are one module from the end.
[pause 3s]
You have done deep work.
[pause 2s]
Something will remain.
[pause 5s]

See you soon... for the final module.
SCRIPT,

        // ─────────────────────────────────────────────────────────
        // MODULE 6 EN — "I Practice the Ritual" — target : 4–6 min
        // ─────────────────────────────────────────────────────────
        '07-je-transmets-le-rituel' => <<<'SCRIPT'
Module six.
[pause 2s]
I Practice the Pause Souffle Ritual.
[pause 3s]

You have traveled a path.
[pause 3s]

You met yourself.
[pause 2s]
You recognized your wounds.
[pause 2s]
You described your happiness.
[pause 2s]
You listened to your breath.
[pause 2s]
You touched your mission.
[pause 4s]

That is not nothing.
[pause 3s]

Now... it is time to transmit.
[pause 3s]

What you have lived here...
[pause 2s]
other people need it.
[pause 3s]
People who are exhausted.
[pause 2s]
People who are running without knowing why.
[pause 2s]
People who have simply forgotten to stop.
[pause 4s]

The Pause Souffle Ritual you are going to guide...
[pause 2s]
is not a technique.
[pause 2s]
It is a presence.
[pause 4s]

Let us breathe together one last time in this space.
[pause 3s]

Inhale.
[pause 1s]
One.
[pause 1.5s]
Two.
[pause 1.5s]
Three.
[pause 1.5s]
Four.
[pause 1.5s]
Five.
[pause 2s]

Hold.
[pause 1s]
One.
[pause 1.5s]
Two.
[pause 1.5s]
Three.
[pause 2s]

Exhale.
[pause 1s]
One.
[pause 1.5s]
Two.
[pause 1.5s]
Three.
[pause 1.5s]
Four.
[pause 1.5s]
Five.
[pause 1.5s]
Six.
[pause 5s]

Once more.
[pause 2s]

Inhale.
[pause 1s]
One.
[pause 1.5s]
Two.
[pause 1.5s]
Three.
[pause 1.5s]
Four.
[pause 1.5s]
Five.
[pause 2s]

Hold.
[pause 1s]
One.
[pause 1.5s]
Two.
[pause 1.5s]
Three.
[pause 2s]

Exhale.
[pause 1s]
One.
[pause 1.5s]
Two.
[pause 1.5s]
Three.
[pause 1.5s]
Four.
[pause 1.5s]
Five.
[pause 1.5s]
Six.
[pause 6s]

Good.
[pause 4s]

To guide someone...
[pause 2s]
you must first have been guided yourself.
[pause 3s]
You have been.
[pause 4s]

Your Pause Souffle Practitioner attestation is now available in your personal space.
[pause 3s]

A sentence has been with me throughout this journey.
[pause 2s]
I offer it once more... one last time.
[pause 3s]

I ran for a very long time.
[pause 2s]
I stopped everything.
[pause 2s]
And that is where I found everything.
[pause 3s]
And infinitely more.
[pause 6s]

Thank you for being here.
[pause 3s]
Fully here.
SCRIPT,

        // ─────────────────────────────────────────────────────────
        // PRATICIEN EN — Module 01 — Knowing Yourself to Accompany Others
        // ─────────────────────────────────────────────────────────
        '01-je-me-connais-pour-accompagner' => <<<'SCRIPT'
Settle in.
[pause 5s]

Before you can accompany anyone else...
[pause 5s]
you must first meet yourself.
[pause 5s]
Not the version you present to the world.
[pause 4s]
The one that exists right now... beneath the roles.
[pause 10s]

Carl Rogers said something simple and profound.
[pause 5s]
The most powerful helping relationship is not from expert to novice.
[pause 5s]
It is from one human being who knows themselves... towards another who is trying to find themselves.
[pause 10s]

This is the first module of your practitioner training.
[pause 5s]
It does not begin with techniques.
[pause 4s]
It begins with you.
[pause 8s]

Close your eyes.
[pause 6s]

Three conscious breaths to arrive here.
[pause 20s]

Now... ask your body this question.
[pause 6s]
Who am I... when no one is watching?
[pause 15s]

Not a quick answer.
[pause 5s]
Let what comes... come.
[pause 12s]

An effective practitioner does not guide through their theories.
[pause 5s]
They guide through what they have lived.
[pause 5s]
Conscious wounds become keys.
[pause 5s]
Developed resources become bridges.
[pause 10s]

Think of a wound you carry... that you have begun to make peace with.
[pause 8s]
Not to explain to others.
[pause 5s]
Just to recognise within yourself.
[pause 8s]

Where does it live in your body?
[pause 5s]
How does it still show up today?
[pause 12s]

And now... think of a resource.
[pause 6s]
Something you developed... often through difficulty.
[pause 5s]
An ability to listen deeply.
[pause 4s]
A quiet presence.
[pause 4s]
An intuition about others' emotional states.
[pause 8s]

You have carried this resource for a long time.
[pause 5s]
And it is precisely this that will nourish your practice.
[pause 10s]

We anchor this work through the body.
[pause 8s]

We will practise the five-five-five method.
[pause 5s]

Five seconds to inhale.
[pause 2s]
Five seconds to hold.
[pause 2s]
Five seconds to exhale.
[pause 4s]
Ten cycles.
[pause 2s]
Two and a half minutes of deep self-presence.
[pause 6s]

On the inhale... let in self-knowledge.
[pause 4s]
On the hold... rest in what you are.
[pause 4s]
On the exhale... release what is not you.
[pause 6s]

We begin.
[BREATHING_CYCLES]
[pause 20s]

This calm... is the foundation of your practice.
[pause 5s]
What you touch here... you can offer to others.
[pause 15s]

Let the breath return to its natural rhythm.
[pause 10s]

Stay here.
[pause 8s]
Without doing anything.
[pause 12s]

What wound has shaped you most... and that you have begun to transform into understanding?
[pause 18s]

What is the deepest resource you bring into a helping relationship?
[pause 18s]

In one sentence... who are you as a practitioner?
[pause 18s]

Write what came in your notebook.
[pause 5s]
Without correcting.
[pause 5s]
Without minimising.
[pause 8s]

You begin here.
[pause 5s]
With what you are.
[pause 5s]
That is enough.
[pause 10s]
SCRIPT,

        // ─────────────────────────────────────────────────────────
        // PRATICIEN EN — Module 02 — Mastering the Tools of the Breath
        // ─────────────────────────────────────────────────────────
        '02-je-maitrise-les-outils-du-souffle' => <<<'SCRIPT'
Settle in.
[pause 5s]

You already sense what breath does inside you.
[pause 5s]
This module gives you precise language.
[pause 4s]
And the tools to transmit it.
[pause 10s]

A Pause Souffle practitioner does not work with a single technique.
[pause 5s]
They work with a repertoire.
[pause 5s]
Seven distinct tools.
[pause 5s]
Each for a specific state... need... and moment.
[pause 10s]

Close your eyes.
[pause 6s]

Three breaths to arrive here.
[pause 20s]

The first tool... you already know.
[pause 5s]
The Pause Souffle five-five-five.
[pause 5s]
Cardiac coherence.
[pause 4s]
Autonomic nervous system regulation.
[pause 4s]
Vagus nerve activation.
[pause 5s]
Your central anchor.
[pause 8s]

The second tool.
[pause 5s]
The breath of fire.
[pause 5s]
Short rhythmic inhales and exhales through the nose.
[pause 5s]
It activates... awakens... releases accumulated tension.
[pause 8s]

The third.
[pause 5s]
Alternate nostril breathing.
[pause 5s]
Right nostril... left nostril... alternating.
[pause 5s]
It balances the two brain hemispheres.
[pause 4s]
Mental clarity.
[pause 4s]
Inner calm.
[pause 8s]

The fourth.
[pause 5s]
Extended exhale.
[pause 5s]
Four seconds in... eight seconds out.
[pause 5s]
The fastest parasympathetic brake available.
[pause 5s]
For emotional emergencies... returning to the window of tolerance.
[pause 8s]

The fifth.
[pause 5s]
Box breathing.
[pause 5s]
Four in... four hold... four out... four pause.
[pause 5s]
Used by special forces to stay calm under extreme pressure.
[pause 8s]

The sixth.
[pause 5s]
Extended coherence breath.
[pause 5s]
Six seconds inhale... six seconds exhale.
[pause 5s]
Optimal heart-brain synchronisation.
[pause 4s]
For deep states and longer sessions.
[pause 8s]

The seventh.
[pause 5s]
Sound release breath.
[pause 5s]
Exhale with a sound... a sigh... a gentle hum.
[pause 5s]
The sound vibrates through the vagus nerve.
[pause 4s]
It releases what the body holds in silence.
[pause 10s]

Seven tools.
[pause 5s]
Seven keys for seven states.
[pause 5s]
A practitioner who masters them adapts every session to every client.
[pause 10s]

We anchor this mastery through the body.
[pause 8s]

We will practise the five-five-five method.
[pause 5s]

Five seconds to inhale.
[pause 2s]
Five seconds to hold.
[pause 2s]
Five seconds to exhale.
[pause 4s]
Ten cycles.
[pause 2s]
Two and a half minutes of presence within your repertoire.
[pause 6s]

On the inhale... receive the mastery.
[pause 4s]
On the hold... feel the solidity of what you now carry.
[pause 4s]
On the exhale... imagine transmitting it with clarity.
[pause 6s]

We begin.
[BREATHING_CYCLES]
[pause 20s]

This calm... is your practice ground.
[pause 5s]
This is where you will work.
[pause 15s]

Let the breath return to its natural rhythm.
[pause 10s]

Stay here.
[pause 8s]
Without doing anything.
[pause 12s]

Which breathing tool resonates most with your natural energy as a practitioner?
[pause 18s]

For which type of client or situation do you want to train first?
[pause 18s]

What is your mission as a breath practitioner... in one sentence?
[pause 18s]

Write what came in your notebook.
[pause 5s]
Tools belong to those who practise them.
[pause 5s]
Practise every day.
[pause 10s]
SCRIPT,

        // ─────────────────────────────────────────────────────────
        // PRATICIEN EN — Module 10 — The Practitioner's Posture
        // ─────────────────────────────────────────────────────────
        '10-la-posture-du-praticien' => <<<'SCRIPT'
Settle in.
[pause 5s]

There is a fundamental difference between knowing how to guide a breath...
[pause 5s]
and being a practitioner.
[pause 5s]
That difference is posture.
[pause 10s]

The practitioner's posture is not a technique.
[pause 5s]
It is a state of being.
[pause 5s]
A way of occupying space... inhabiting your voice... managing your inner state...
[pause 4s]
before your client even enters the room.
[pause 10s]

Close your eyes.
[pause 6s]

Three breaths to arrive here.
[pause 20s]

The first dimension of posture... physical presence.
[pause 6s]

A practitioner whose body is collapsed... agitated... or tense...
[pause 5s]
transmits that state to their client before saying a single word.
[pause 5s]
The other person's nervous system reads you.
[pause 5s]
Within seconds.
[pause 5s]
It is wired to do exactly that.
[pause 8s]

Feel your body right now.
[pause 5s]
Feet on the ground.
[pause 4s]
Spine upright but alive.
[pause 4s]
Shoulders released.
[pause 4s]
Face open.
[pause 6s]

This physical posture is already a message.
[pause 5s]
It says... I am here.
[pause 4s]
I am stable.
[pause 4s]
You are safe.
[pause 10s]

The second dimension... the therapeutic voice.
[pause 6s]

A practitioner's voice is not their everyday voice.
[pause 5s]
It is slower.
[pause 4s]
Deeper.
[pause 4s]
More grounded.
[pause 5s]
It descends... rather than rises.
[pause 5s]
It creates space... rather than filling it.
[pause 8s]

Your voice can activate or deactivate another person's nervous system.
[pause 5s]
Every word.
[pause 4s]
Every pause.
[pause 4s]
Every variation in tone.
[pause 5s]
It is your primary therapeutic instrument.
[pause 10s]

The third dimension... inner state.
[pause 6s]

A practitioner cannot be in fear... performance... or judgment...
[pause 5s]
and simultaneously create a safe space for a client.
[pause 5s]
Both things cannot coexist.
[pause 8s]

Before each session... take three cycles of conscious breath.
[pause 5s]
Not to prepare to perform.
[pause 4s]
To remember who you are.
[pause 5s]
A space.
[pause 4s]
Not a solution.
[pause 10s]

The fourth dimension... preventing practitioner burnout.
[pause 6s]

A practitioner who gives without recharging... burns out.
[pause 5s]
This is not weakness.
[pause 4s]
It is biology.
[pause 6s]

The rule is simple.
[pause 5s]
What you ask your clients to do... you do too.
[pause 4s]
Every day.
[pause 4s]
Without exception.
[pause 10s]

We anchor this posture through the body.
[pause 8s]

We will practise the five-five-five method.
[pause 5s]

Five seconds to inhale.
[pause 2s]
Five seconds to hold.
[pause 2s]
Five seconds to exhale.
[pause 4s]
Ten cycles.
[pause 2s]
Two and a half minutes inside the practitioner's posture.
[pause 6s]

On the inhale... let in stability.
[pause 4s]
On the hold... hold the space.
[pause 4s]
On the exhale... offer safety.
[pause 6s]

We begin.
[BREATHING_CYCLES]
[pause 20s]

This calm... is your natural posture.
[pause 5s]
It already exists in you.
[pause 5s]
This module helps you inhabit it consciously.
[pause 15s]

Let the breath return to its natural rhythm.
[pause 10s]

Stay here.
[pause 8s]
Without doing anything.
[pause 12s]

Which dimension of posture requires the most work for you — physical presence... voice... inner state... or replenishment?
[pause 18s]

What do you already do naturally well in your practitioner posture?
[pause 18s]

What replenishment practice will you put in place this week?
[pause 18s]

Write what came in your notebook.
[pause 5s]
Posture is cultivated daily.
[pause 5s]
Not only in front of a client.
[pause 10s]
SCRIPT,

        // ─────────────────────────────────────────────────────────
        // PRATICIEN EN — Module 11 — Reading a Client, Adapting the Protocol
        // ─────────────────────────────────────────────────────────
        '11-lire-un-client-adapter-le-protocole' => <<<'SCRIPT'
Settle in.
[pause 5s]

A rigid protocol... applied the same way to everyone...
[pause 5s]
is not professional practice.
[pause 5s]
It is a standardised service.
[pause 8s]

A practitioner is distinguished by their ability to read.
[pause 5s]
To perceive.
[pause 4s]
To adapt.
[pause 4s]
In real time.
[pause 10s]

This module gives you the keys to this relational intelligence.
[pause 8s]

Close your eyes.
[pause 6s]

Three breaths to arrive here.
[pause 20s]

Let us begin with the four client profiles.
[pause 6s]

The first profile.
[pause 5s]
The analytical client.
[pause 5s]
They need to understand before they can feel.
[pause 5s]
Give them anatomy... physiology... research.
[pause 4s]
Explain before you guide.
[pause 4s]
Their entry point is the intellect.
[pause 8s]

The second profile.
[pause 5s]
The emotional client.
[pause 5s]
They are already in the feeling.
[pause 4s]
They need safety first.
[pause 4s]
Your presence.
[pause 4s]
Not explanations.
[pause 5s]
Their entry point is human connection.
[pause 8s]

The third profile.
[pause 5s]
The sceptical client.
[pause 5s]
They are testing.
[pause 4s]
Observing.
[pause 4s]
Here despite themselves... almost.
[pause 5s]
Do not try to convince them.
[pause 4s]
Let the experience speak.
[pause 5s]
Their entry point is concrete results.
[pause 8s]

The fourth profile.
[pause 5s]
The client in crisis.
[pause 5s]
Saturated.
[pause 4s]
Exhausted.
[pause 4s]
Overwhelmed.
[pause 5s]
They need an immediate anchor.
[pause 4s]
No theory.
[pause 4s]
Just... return to the body.
[pause 4s]
Here.
[pause 3s]
Now.
[pause 8s]

Now... the five non-verbal channels.
[pause 6s]

What your client tells you through their body... before they speak.
[pause 6s]

The breath.
[pause 5s]
Is it shallow... high... blocked... or full?
[pause 8s]

The posture.
[pause 5s]
Collapsed... closed... rigid... or open?
[pause 8s]

The eyes.
[pause 5s]
Avoidant... fixed... present... or absent?
[pause 8s]

The voice.
[pause 5s]
Fast... flat... trembling... or grounded?
[pause 8s]

The overall tone.
[pause 5s]
Hyper-activated... frozen... or available?
[pause 8s]

These five channels together give you the picture of your client.
[pause 5s]
Before they have said a single word.
[pause 10s]

We anchor this perception through the body.
[pause 8s]

We will practise the five-five-five method.
[pause 5s]

Five seconds to inhale.
[pause 2s]
Five seconds to hold.
[pause 2s]
Five seconds to exhale.
[pause 4s]
Ten cycles.
[pause 2s]
Two and a half minutes of open attention.
[pause 6s]

On the inhale... open your perception.
[pause 4s]
On the hold... let information in.
[pause 4s]
On the exhale... remain available.
[pause 6s]

We begin.
[BREATHING_CYCLES]
[pause 20s]

This calm... is the foundation of your perception.
[pause 5s]
A relaxed practitioner perceives more than a concentrated one.
[pause 15s]

Let the breath return to its natural rhythm.
[pause 10s]

Stay here.
[pause 8s]
Without doing anything.
[pause 12s]

Among the four profiles... which challenges you most?
[pause 18s]

Which non-verbal channel do you read most naturally?
[pause 18s]

What is the opening question you ask at the start of a session to calibrate your approach?
[pause 18s]

Write what came in your notebook.
[pause 5s]
Reading a client is an art.
[pause 5s]
It develops with every session.
[pause 10s]
SCRIPT,

        // ─────────────────────────────────────────────────────────
        // PRATICIEN EN — Module 12 — Building a Professional Practice
        // ─────────────────────────────────────────────────────────
        '12-construire-une-pratique-professionnelle' => <<<'SCRIPT'
Settle in.
[pause 5s]

You can be the best practitioner in the world.
[pause 5s]
If no one knows you exist...
[pause 5s]
your practice remains an intention.
[pause 10s]

This module is not about marketing in the commercial sense.
[pause 5s]
It is about something more fundamental.
[pause 5s]
Building a practice that reflects who you are.
[pause 5s]
And that truly serves the people who need it.
[pause 10s]

Close your eyes.
[pause 6s]

Three breaths to arrive here.
[pause 20s]

First... your service offering.
[pause 6s]

A Pause Souffle practitioner can offer four main formats.
[pause 5s]

Individual sessions.
[pause 5s]
In a practice... at home... or online.
[pause 4s]
45 to 90 minutes.
[pause 4s]
The most personalised accompaniment.
[pause 8s]

Group workshops.
[pause 5s]
Two to twenty people.
[pause 4s]
Corporate... studio... or outdoors.
[pause 4s]
High-energy format... immediate impact.
[pause 8s]

Accompaniment programmes.
[pause 5s]
Six to twelve weeks.
[pause 4s]
Regular sessions... measurable progression.
[pause 4s]
The deepest transformation.
[pause 8s]

Retreats or seminars.
[pause 5s]
Immersive experience.
[pause 4s]
Multiplied impact.
[pause 8s]

Second... pricing.
[pause 6s]

Your rate is not an arbitrary number.
[pause 5s]
It is a declaration of value.
[pause 5s]
Too low... and you devalue yourself.
[pause 4s]
You send a signal of insufficient confidence.
[pause 5s]
The right rate reflects your training level...
[pause 4s]
the transformational value you bring...
[pause 4s]
and your local market.
[pause 8s]

Third... your first three clients.
[pause 6s]

They are not your best clients.
[pause 5s]
They are your teachers.
[pause 5s]
The most valuable ones.
[pause 5s]
Find them in your immediate circle.
[pause 4s]
Offer the first sessions in exchange for honest feedback.
[pause 4s]
Not public reviews.
[pause 4s]
Truth.
[pause 8s]

Fourth... minimal digital presence.
[pause 6s]

You do not need a complex marketing funnel to begin.
[pause 5s]
You need one thing.
[pause 5s]
For the right people to find you and contact you.
[pause 5s]
A clear profile... a readable offer... a way to book.
[pause 5s]
That is all.
[pause 10s]

We anchor this vision through the body.
[pause 8s]

We will practise the five-five-five method.
[pause 5s]

Five seconds to inhale.
[pause 2s]
Five seconds to hold.
[pause 2s]
Five seconds to exhale.
[pause 4s]
Ten cycles.
[pause 2s]
Two and a half minutes to embody your practice.
[pause 6s]

On the inhale... see your practice already alive.
[pause 4s]
On the hold... hold that vision.
[pause 4s]
On the exhale... release the fear of not being ready.
[pause 6s]

We begin.
[BREATHING_CYCLES]
[pause 20s]

This calm... is the confidence in what you are building.
[pause 5s]
It exists.
[pause 5s]
It grows with every session.
[pause 15s]

Let the breath return to its natural rhythm.
[pause 10s]

Stay here.
[pause 8s]
Without doing anything.
[pause 12s]

Which service format fits your natural energy most?
[pause 18s]

Who are the three first people in your circle you could accompany?
[pause 18s]

What fear is still holding you back... and what would be true if that fear did not exist?
[pause 18s]

Write what came in your notebook.
[pause 5s]
Your practice begins the moment you decide it has begun.
[pause 5s]
Not when you are perfectly ready.
[pause 10s]
SCRIPT,

        // ─────────────────────────────────────────────────────────
        // PRATICIEN EN — Module 13 — Limits, Contraindications & Responsibility
        // ─────────────────────────────────────────────────────────
        '13-limites-contre-indications-responsabilite' => <<<'SCRIPT'
Settle in.
[pause 5s]

Ethics is not a constraint.
[pause 5s]
It is the structure that protects you... and your clients.
[pause 5s]
Without clear limits... a professional practice does not hold.
[pause 10s]

This is one of the most important modules in your training.
[pause 5s]
Not the most spectacular.
[pause 4s]
The most fundamental.
[pause 10s]

Close your eyes.
[pause 6s]

Three breaths to arrive here.
[pause 20s]

First... the five situations requiring immediate session stop.
[pause 6s]

One... uncontrolled hyperventilation.
[pause 5s]
If the client loses control of their breathing... stop immediately.
[pause 4s]
Return to natural breathing.
[pause 4s]
Never any pressure.
[pause 8s]

Two... intense emotional crisis.
[pause 5s]
Uncontrollable crying... major agitation... dissociative state.
[pause 5s]
The practitioner does not continue.
[pause 4s]
They offer presence.
[pause 4s]
They stabilise.
[pause 8s]

Three... physical pain.
[pause 5s]
Any pain reported... however minor... justifies adjustment or stopping.
[pause 5s]
The body speaks.
[pause 4s]
Listen to it.
[pause 8s]

Four... dizziness or discomfort.
[pause 5s]
Common with intense techniques.
[pause 4s]
Have them lie down.
[pause 4s]
Hydration.
[pause 4s]
Rest.
[pause 8s]

Five... refusal or desire to stop.
[pause 5s]
If the client wants to stop... for any reason...
[pause 5s]
you stop.
[pause 4s]
Without discussion.
[pause 4s]
Without judgment.
[pause 8s]

Second... medical contraindications.
[pause 6s]

Always ask... before any session.
[pause 5s]
Heart conditions.
[pause 4s]
Epilepsy.
[pause 4s]
Advanced pregnancy.
[pause 4s]
Unstabilised psychiatric conditions.
[pause 4s]
Uncontrolled blood pressure.
[pause 5s]
Refer to the GP if you have any doubt.
[pause 5s]
It is not your role to diagnose.
[pause 4s]
It is your role to refer.
[pause 8s]

Third... GDPR and confidentiality.
[pause 6s]

Your clients' personal data is protected.
[pause 5s]
Name... health status... information shared in sessions.
[pause 5s]
Nothing leaves the practitioner-client relationship without explicit consent.
[pause 5s]
No exceptions.
[pause 8s]

Fourth... professional ethics.
[pause 6s]

A Pause Souffle practitioner is not a therapist.
[pause 5s]
They do not diagnose.
[pause 4s]
They do not interpret symptoms.
[pause 4s]
They do not compete with doctors or psychologists.
[pause 5s]
They create the conditions for the body to self-regulate.
[pause 5s]
That is not nothing.
[pause 4s]
In fact it is precious.
[pause 4s]
Be clear about who you are.
[pause 8s]

We seal this commitment through the body.
[pause 8s]

We will practise the five-five-five method.
[pause 5s]

Five seconds to inhale.
[pause 2s]
Five seconds to hold.
[pause 2s]
Five seconds to exhale.
[pause 4s]
Ten cycles.
[pause 2s]
Two and a half minutes of conscious responsibility.
[pause 6s]

On the inhale... let in clarity.
[pause 4s]
On the hold... hold your framework.
[pause 4s]
On the exhale... offer this safety to your future clients.
[pause 6s]

We begin.
[BREATHING_CYCLES]
[pause 20s]

This calm... is the foundation of your ethical practice.
[pause 5s]
A clear practitioner... is a safe practitioner.
[pause 15s]

Let the breath return to its natural rhythm.
[pause 10s]

Stay here.
[pause 8s]
Without doing anything.
[pause 12s]

Is there a limit you have not yet dared to set... a situation you have not yet anticipated?
[pause 18s]

What would be the first concrete step to structure the administrative and ethical side of your practice?
[pause 18s]

What sentence summarises your commitment to your clients... your practitioner's oath?
[pause 18s]

Write what came in your notebook.
[pause 5s]
An ethical practitioner knows why they do what they do.
[pause 5s]
And what they do not do.
[pause 10s]
SCRIPT,
    ]; // fin _legacyEn

    public function handle(OpenAIService $openAI): int
    {
        $this->info('🎙  Génération audio bilingue FR + EN — Formation Pause Souffle via ElevenLabs TTS (Charlotte)...');
        $this->newLine();

        $elevenLabs = new \App\Services\ElevenLabsService();

        Storage::disk('public')->makeDirectory('formation/audio');

        $slugFilter = $this->option('module');
        $force      = $this->option('force');
        $langFilter = $this->option('lang') ?? 'all'; // fr | en | all

        $modules = FormationModule::orderBy('order')->get();

        if ($slugFilter) {
            $modules = $modules->where('slug', $slugFilter)->values();
            if ($modules->isEmpty()) {
                $this->error("Module introuvable : {$slugFilter}");
                return self::FAILURE;
            }
        }

        $langs = match($langFilter) {
            'fr'    => ['fr'],
            'en'    => ['en'],
            default => ['fr', 'en'],
        };

        $total = $modules->count() * count($langs);
        $bar   = $this->output->createProgressBar($total);
        $bar->start();

        foreach ($modules as $module) {
            foreach ($langs as $lang) {
                $script = $lang === 'fr'
                    ? ($this->scripts[$module->slug] ?? null)
                    : ($this->scriptsEn[$module->slug] ?? null);

                if (!$script) {
                    $this->newLine();
                    $this->warn("Pas de script {$lang} pour : {$module->slug} — ignoré.");
                    $bar->advance();
                    continue;
                }

                $audioPath   = "formation/audio/{$module->slug}-{$lang}.mp3";
                $dbColumn    = $lang === 'fr' ? 'audio_path' : 'audio_path_en';

                if (!$force && Storage::disk('public')->exists($audioPath)) {
                    $this->newLine();
                    $this->line("  ⏭  [{$lang}] {$module->slug} — déjà présent");
                    $bar->advance();
                    continue;
                }

                try {
                    // Toujours via buildFromScript : pauses ≥4s = silence ffmpeg réel
                    $mp3Content = $this->buildFromScript($script, $elevenLabs, $lang);
                    Storage::disk('public')->put($audioPath, $mp3Content);
                    $module->update([$dbColumn => $audioPath]);

                    $this->newLine();
                    $this->info("  ✅  [{$lang}] {$module->slug}");

                } catch (\Exception $e) {
                    $this->newLine();
                    $this->error("  ❌  [{$lang}] {$module->slug} : " . $e->getMessage());
                }

                $bar->advance();
                sleep(1);
            }
        }

        $bar->finish();
        $this->newLine(2);
        $this->info('Audios générés. Vérifiez storage:link si nécessaire.');

        return self::SUCCESS;
    }

    // ─────────────────────────────────────────────────────────────
    // Génération breathing avec silence réel via ffmpeg
    // ─────────────────────────────────────────────────────────────

    /**
     * Génère un MP3 complet pour les scripts contenant [BREATHING_CYCLES].
     * L'intro et l'outro sont générés via TTS normalement.
     * Les cycles de respiration sont assemblés avec ffmpeg (silences exacts).
     */
    // ──────────────────────────────────────────────────────────────────
    // Génération audio haute qualité via ffmpeg + OpenAI TTS
    // Toutes les pauses ≥ 4s = silence ffmpeg pur → zéro artefact TTS
    // ──────────────────────────────────────────────────────────────────

    /**
     * Point d'entrée principal. Assemble le MP3 à partir d'un script.
     * Gère les marqueurs [pause Xs] et [BREATHING_CYCLES].
     */
    private function buildFromScript(
        string $script,
        \App\Services\ElevenLabsService $elevenLabs,
        string $lang = 'fr'
    ): string {
        $tmp      = sys_get_temp_dir();
        $id       = uniqid('tts_');
        $cleanup  = [];
        $allParts = [];

        try {
            $hasBreathing = str_contains($script, '[BREATHING_CYCLES]');

            if ($hasBreathing) {
                [$introRaw, $outroRaw] = array_map('trim', explode('[BREATHING_CYCLES]', $script, 2));
            } else {
                $introRaw = trim($script);
                $outroRaw = null;
            }

            // Intro (narration)
            $allParts = array_merge(
                $allParts,
                $this->scriptToFiles($introRaw, $elevenLabs, $tmp, $id . '_a', $cleanup, $lang)
            );

            // Cycles de respiration
            if ($hasBreathing) {
                $allParts = array_merge(
                    $allParts,
                    $this->breathingFiles($elevenLabs, $tmp, $id, $cleanup, $lang)
                );
            }

            // Outro (narration)
            if ($outroRaw) {
                $allParts = array_merge(
                    $allParts,
                    $this->scriptToFiles($outroRaw, $elevenLabs, $tmp, $id . '_b', $cleanup, $lang)
                );
            }

            // Assemblage final
            $finalMp3 = "{$tmp}/{$id}_final.mp3";
            $cleanup[] = $finalMp3;
            $this->ffmpegConcat($allParts, $finalMp3, $tmp, $id);

            if (!file_exists($finalMp3) || filesize($finalMp3) < 1000) {
                throw new \Exception('buildFromScript : ffmpeg n\'a pas produit de fichier valide.');
            }

            return file_get_contents($finalMp3);

        } finally {
            foreach ($cleanup as $f) {
                if (file_exists($f)) @unlink($f);
            }
        }
    }

    /**
     * Découpe un bloc de script en fichiers MP3.
     * Pauses ≥ 4s → silence ffmpeg réel (évite les vocalises parasites de shimmer).
     * Pauses < 4s → virgules/ellipses dans le TTS.
     */
    private function scriptToFiles(
        string $script,
        \App\Services\ElevenLabsService $elevenLabs,
        string $tmp,
        string $id,
        array  &$cleanup,
        string $lang = 'fr'
    ): array {
        $parts        = [];
        $silCache     = [];
        $idx          = 0;
        $buffer       = '';
        $MIN_REAL_SIL = 4.0;
        $langCode     = $lang === 'en' ? 'en' : 'fr';

        $segments = preg_split(
            '/\[pause\s*(\d+(?:\.\d+)?)s\]/',
            $script,
            -1,
            PREG_SPLIT_DELIM_CAPTURE
        );

        $flushBuffer = function () use (&$buffer, &$parts, &$idx, &$cleanup, $tmp, $id, $elevenLabs, $langCode) {
            $clean = trim(preg_replace('/[ \t]{2,}/', ' ', $buffer));
            if ($clean === '') {
                $buffer = '';
                return;
            }
            $f = "{$tmp}/{$id}_t{$idx}.mp3";
            file_put_contents($f, $elevenLabs->textToSpeech($clean, \App\Services\ElevenLabsService::DEFAULT_VOICE_ID, 0.88, 0.75, 0.0, $langCode));
            $parts[]   = $f;
            $cleanup[] = $f;
            $idx++;
            $buffer = '';
            sleep(1);
        };

        for ($i = 0; $i < count($segments); $i++) {
            if ($i % 2 === 0) {
                $buffer .= $segments[$i];
            } else {
                $sec = (float) $segments[$i];
                if ($sec >= $MIN_REAL_SIL) {
                    $flushBuffer();
                    $dur = (int) round($sec);
                    if (!isset($silCache[$dur])) {
                        $sf = "{$tmp}/{$id}_sil{$dur}s.mp3";
                        exec(sprintf(
                            'ffmpeg -y -f lavfi -i anullsrc=r=24000:cl=mono -t %d -codec:a libmp3lame -q:a 4 %s 2>&1',
                            $dur, escapeshellarg($sf)
                        ));
                        $silCache[$dur] = $sf;
                        $cleanup[] = $sf;
                    }
                    $parts[] = $silCache[$dur];
                } else {
                    // Pause courte (<2s) : ponctuation — shimmer fait une pause naturelle sans vocaliser
                    $buffer .= $sec <= 1.5 ? ', ' : '. ';
                }
            }
        }

        $flushBuffer();

        return $parts;
    }

    /**
     * Génère les 10 cycles de respiration guidée (5s inspirer / 5s bloquer / 6s expirer).
     * Silences exacts via ffmpeg. Mots courts via TTS.
     */
    private function breathingFiles(
        \App\Services\ElevenLabsService $elevenLabs,
        string $tmp,
        string $id,
        array  &$cleanup,
        string $lang = 'fr'
    ): array {
        $inspireS = 5;
        $blockS   = 5;
        $expireS  = 6;
        $leadIn   = 8;
        $trailOut = 10;
        $cycles   = 10;

        // Mots respiratoires dans la bonne langue
        $wordMaps = [
            'fr' => [
                'inspirez'     => 'Inspirez... doucement.',
                'bloquez'      => 'Bloquez.',
                'expirez'      => 'Expirez... laissez aller.',
                'derniere'     => 'Dernière inspiration... doucement.',
                'expirez_lent' => 'Expirez... lentement.',
            ],
            'en' => [
                'inspirez'     => 'Breathe in... slowly.',
                'bloquez'      => 'Hold.',
                'expirez'      => 'Breathe out... let go.',
                'derniere'     => 'Last breath in... slowly.',
                'expirez_lent' => 'Breathe out... slowly.',
            ],
        ];
        $wordMap = $wordMaps[$lang] ?? $wordMaps['fr'];
        $langCode  = $lang === 'en' ? 'en' : 'fr';
        $wordFiles = [];
        foreach ($wordMap as $key => $text) {
            $f = "{$tmp}/{$id}_br_{$key}.mp3";
            file_put_contents($f, $elevenLabs->textToSpeech($text, \App\Services\ElevenLabsService::DEFAULT_VOICE_ID, 0.88, 0.75, 0.0, $langCode));
            $wordFiles[$key] = $f;
            $cleanup[] = $f;
            sleep(1);
        }

        // Silences
        $silDurs  = array_unique([$leadIn, $inspireS, $blockS, $expireS, $trailOut]);
        $silFiles = [];
        foreach ($silDurs as $dur) {
            $f = "{$tmp}/{$id}_brsil{$dur}s.mp3";
            exec(sprintf(
                'ffmpeg -y -f lavfi -i anullsrc=r=24000:cl=mono -t %d -codec:a libmp3lame -q:a 4 %s 2>&1',
                $dur, escapeshellarg($f)
            ));
            $silFiles[$dur] = $f;
            $cleanup[] = $f;
        }

        // Séquence complète
        $parts = [$silFiles[$leadIn]];
        for ($i = 1; $i <= $cycles; $i++) {
            $isLast  = ($i === $cycles);
            $parts[] = $isLast ? $wordFiles['derniere']     : $wordFiles['inspirez'];
            $parts[] = $silFiles[$inspireS];
            $parts[] = $wordFiles['bloquez'];
            $parts[] = $silFiles[$blockS];
            $parts[] = $isLast ? $wordFiles['expirez_lent'] : $wordFiles['expirez'];
            $parts[] = $isLast ? $silFiles[$trailOut]       : $silFiles[$expireS];
        }

        return $parts;
    }

    /**
     * Concatène une liste de fichiers MP3 via ffmpeg concat.
     */
    private function ffmpegConcat(array $files, string $outFile, string $tmp, string $id): void
    {
        $listFile = "{$tmp}/{$id}_list.txt";
        $lines    = [];
        foreach ($files as $f) {
            if ($f && file_exists($f)) {
                $lines[] = "file '" . str_replace(['\\', "'"], ['/', "\\'"], $f) . "'";
            }
        }
        file_put_contents($listFile, implode("\n", $lines));
        exec(sprintf(
            'ffmpeg -y -f concat -safe 0 -i %s -codec:a libmp3lame -q:a 2 %s 2>&1',
            escapeshellarg($listFile),
            escapeshellarg($outFile)
        ));
        @unlink($listFile);
    }
}
