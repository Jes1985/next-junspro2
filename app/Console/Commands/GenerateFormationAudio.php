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
        '06-je-pratique-le-rituel' => <<<'SCRIPT'
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
    ];

    // ── Scripts EN — "TTS-ready" calm executive tone ──────────────
    private array $scriptsEn = [

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
        '06-je-pratique-le-rituel' => <<<'SCRIPT'
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
        '06-je-pratique-le-rituel' => <<<'SCRIPT'
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
