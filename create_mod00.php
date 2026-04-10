<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

// ─── HELPERS ─────────────────────────────────────────────────────────────────
function lect($color, $badge, $title, $body) {
    return '<div style="border-left:3px solid '.$color.';padding:.85rem 1.25rem;margin-bottom:.8rem;background:rgba(0,0,0,.15);border-radius:0 10px 10px 0;">'
          .'<h4 style="color:#fff;font-size:.87rem;font-weight:700;margin:0 0 .5rem;display:flex;align-items:center;gap:.6rem;">'
          .'<span style="font-size:.68rem;color:'.$color.';background:rgba(0,0,0,.35);border:1px solid '.$color.';border-radius:6px;padding:.1rem .4rem;flex-shrink:0;">'.$badge.'</span>'
          .$title.'</h4>'
          .'<div style="font-size:.8rem;color:rgba(232,224,208,.72);line-height:1.85;">'.$body.'</div>'
          .'</div>';
}
function bloc($color, $badge, $title, $body) {
    return '<div style="background:rgba(0,0,0,.2);border:1px solid '.$color.'22;border-radius:12px;padding:1.1rem 1.3rem;margin-bottom:.75rem;">'
          .'<div style="display:flex;align-items:center;gap:.65rem;margin-bottom:.55rem;">'
          .'<span style="width:28px;height:28px;border-radius:50%;background:'.$color.'22;border:1.5px solid '.$color.';display:flex;align-items:center;justify-content:center;font-size:.75rem;font-weight:800;color:'.$color.';flex-shrink:0;">'.$badge.'</span>'
          .'<span style="font-size:.88rem;font-weight:700;color:#fff;">'.$title.'</span>'
          .'</div>'
          .'<div style="font-size:.79rem;color:rgba(232,224,208,.75);line-height:1.9;padding-left:2.1rem;">'.$body.'</div>'
          .'</div>';
}
function cit($color, $text) { return '<em style="color:'.$color.';">'.$text.'</em>'; }
function h($t) { return '<strong>'.$t.'</strong>'; }
function s($label, $body) { return h($label).'<br>'.$body.'<br><br>'; }

// ════════════════════════════════════════════════════════════════════════════
//  MODULE 0 — PROLOGUE — "La vie n'a pas d'âge"
//  Avant tout le reste. L'électrochoc fondateur. Le feu qui allume tout.
// ════════════════════════════════════════════════════════════════════════════

// ─── OUVERTURE NARRATIVE ────────────────────────────────────────────────────
$c0 = 'rgba(201,168,76,.9)';
$ouverture_fr = lect($c0, 'Prologue · Avant tout le reste',
    'Pourquoi ce parcours existe',
    '<div style="font-size:.9rem;line-height:2.1;color:rgba(232,224,208,.92);">'
   .'Il y a des moments dans une vie qui coupent le monde en deux.<br><br>'
   .'Avant. Et après.<br><br>'
   .'Ce parcours est né d\'un de ces moments.<br><br>'
   .'Un ami d\'enfance. Quarante ans. Une fille de treize ans. Un fils de dix. '
   .'Un cancer diagnostiqué, une rémission — et puis, en un mois, c\'est fini.<br><br>'
   .'Pas un vieillard au bout d\'une longue vie.<br>'
   .'Quelqu\'un de votre âge. Avec les même projets que vous. Les mêmes enfants que vous.<br><br>'
   .'Ce jour-là, quelque chose s\'est fissuré dans la certitude silencieuse que la mort, '
   .'c\'est pour plus tard.<br><br>'
   .'Et dans cette fissure est entré quelque chose d\'inattendu : '
   .'<strong style="color:#fff;">une clarté radicale sur ce qui compte vraiment.</strong><br><br>'
   .'Pas la carrière. Pas la maison. Pas l\'image que les autres ont de vous.<br><br>'
   .'Les gens. La présence. Les projets non reportés. '
   .'Les mots non dits. Les voyages promis. Les matins où vous étiez vraiment là.<br><br>'
   .'Ce parcours a été construit à partir de cette fissure.<br>'
   .'Pas pour vous apprendre à vivre mieux.<br>'
   .'Pour vous rappeler que vous êtes <em style="color:'.$c0.';">déjà en train de vivre</em> '
   .'— et que chaque jour qui passe est un jour de moins pour faire ce qui compte vraiment.<br><br>'
   .'Ce module n\'est pas une introduction.<br>'
   .'C\'est la <strong style="color:#fff;">question centrale</strong> à laquelle tous les autres modules essaient de répondre.<br><br>'
   .cit($c0, '"Ce n\'est pas la mort que les gens craignent le plus. C\'est la peur d\'arriver à la mort et de réaliser qu\'ils n\'ont jamais vraiment vécu." — Marcus Aurelius, Méditations')
   .'</div>'
);

// ─── LEÇON 1 ────────────────────────────────────────────────────────────────
$c1 = 'rgba(239,68,68,.85)';
$lecon1_fr = lect($c1,
    'OMS · 2023  |  Yalom · 2008  |  Heidegger · 1927',
    'Leçon 1 — La vérité que personne ne vous a dite sur le temps',
    h('La statistique que les gens ne regardent jamais').'<br>'
   .'Chaque année, l\'OMS publie les données de mortalité mondiales. Ce que très peu de gens consultent vraiment : '
   .'<strong>en France, 31% des décès surviennent avant l\'âge de 65 ans.</strong><br><br>'
   .'Parmi eux :<br>'
   .'· Cancers diagnostiqués entre 35 et 55 ans<br>'
   .'· Maladies cardiovasculaires — première cause de mort "prématurée" chez les actifs<br>'
   .'· Accidents, suicides, maladies auto-immunes<br><br>'
   .'Si vous avez entre 30 et 55 ans, vous êtes statistiquement dans la fenêtre où la mort ne prévient pas. '
   .'Elle ne frappe pas que les vieux. Elle frappe des gens qui avaient des projets. Des enfants. Des voyages prévus pour "l\'année prochaine".<br><br>'
   .cit($c1, '"La mort n\'est pas l\'ennemi. L\'ennemi, c\'est l\'indifférence à sa propre vie." — Irvin Yalom, psychiatre, Stanford, 2008').'<br><br>'
   .h('La différence entre savoir et réaliser').'<br>'
   .'Tout le monde <em>sait</em> qu\'il va mourir. Presque personne ne le <em>réalise</em>.<br><br>'
   .'Martin Heidegger, dans <em>Être et Temps</em> (1927), distingue deux modes d\'existence :<br><br>'
   .'<strong>Le mode inauthentique</strong> — vivre par défaut. Faire ce que les autres font. Remettre à demain. S\'occuper de tout sauf de l\'essentiel. Laisser la vie se passer.<br><br>'
   .'<strong>Le mode authentique</strong> — vivre en conscience de sa propre finitude. Prendre des décisions depuis ses vraies valeurs. Être présent à ce qui compte, maintenant.<br><br>'
   .'La plupart des gens vivent en mode inauthentique — non par lâcheté, mais parce que personne ne leur a jamais créé les conditions pour basculer dans l\'autre.<br><br>'
   .'<strong>Ce parcours est conçu pour créer ces conditions.</strong><br><br>'
   .cit($c1, '"Le moment où tu réalises vraiment que tu vas mourir — et non pas dans 40 ans, mais un jour précis que tu ne connais pas — est le moment où ta vie change." — Heidegger, 1927').'<br><br>'
   .h('Terror Management Theory : la mort comme moteur').'<br>'
   .'Jeff Solomon, Jeff Greenberg & Sheldon Pyszczynski (1991) ont mené l\'une des études les plus répliquées de la psychologie sociale : '
   .'quand on rend quelqu\'un conscient de sa propre mortalité — même brièvement — ses valeurs se réorientent instantanément.<br><br>'
   .'Les gens investissent dans les relations profondes. Ils abandonnent les activités superficielles. '
   .'Ils rappellent leurs proches. Ils remettent en question leurs priorités.<br><br>'
   .'Cet effet dure. Et il s\'amplifie quand la prise de conscience est intégrée — pas refoulée, pas niée, mais <em>regardée en face.</em>'
);

// ─── LEÇON 2 ────────────────────────────────────────────────────────────────
$c2 = 'rgba(59,130,246,.85)';
$lecon2_fr = lect($c2,
    'Bronnie Ware · 2012  |  Carstensen · 2006  |  Tedeschi & Calhoun · 1996',
    'Leçon 2 — Les regrets des mourants et la science de ce qui compte',
    h('La femme qui a écouté les mourants pendant 10 ans').'<br>'
   .'Bronnie Ware était infirmière australienne en soins palliatifs. Pendant une décennie, elle a recueilli les dernières confidences de personnes en fin de vie. '
   .'Ce qu\'elles lui ont dit, elle l\'a compilé dans <em>The Top Five Regrets of the Dying</em> (2012).<br><br>'
   .'Les cinq regrets les plus cités, dans l\'ordre :<br><br>'
   .'<strong>① "J\'aurais aimé avoir le courage de vivre la vie que je voulais vraiment."</strong><br>'
   .'Pas celle que la famille attendait. Pas celle que la société valorisait. La leur.<br><br>'
   .'<strong>② "J\'aurais aimé ne pas avoir autant travaillé."</strong><br>'
   .'Presque tous les hommes. La quasi-totalité des femmes actives. Sans exception.<br><br>'
   .'<strong>③ "J\'aurais aimé avoir le courage d\'exprimer ce que je ressentais vraiment."</strong><br>'
   .'Les mots non dits. Les "je t\'aime" retenus. Les vérités gardées par peur du conflit.<br><br>'
   .'<strong>④ "J\'aurais aimé rester en contact avec mes amis."</strong><br>'
   .'Les amitiés laissées se diluer sous l\'effet des obligations et de la distance.<br><br>'
   .'<strong>⑤ "J\'aurais aimé m\'être permis d\'être plus heureux."</strong><br>'
   .'La découverte que le bonheur est un choix — fait trop tard.<br><br>'
   .cit($c2, '"Personne sur son lit de mort n\'a jamais dit \'j\'aurais dû passer plus de temps au bureau\'." — Bronnie Ware, 2012').'<br><br>'
   .h('Ce que la science dit : la clarté que donne la finitude (Carstensen, Stanford)').'<br>'
   .'Laura Carstensen (Stanford, 2006) a montré que les personnes qui perçoivent leur temps comme limité '
   .'— que ce soit à cause de l\'âge, d\'une maladie, ou d\'une prise de conscience — investissent massivement '
   .'dans trois domaines :<br><br>'
   .'<strong>① Les relations profondes</strong> — ils passent du temps avec ceux qui comptent vraiment<br>'
   .'<strong>② Les expériences</strong> — ils vivent les choses qu\'ils avaient remises<br>'
   .'<strong>③ Le sens</strong> — ils cherchent une profondeur que la vie ordinaire ne leur donnait plus<br><br>'
   .'Et ce changement — Carstensen l\'a mesuré — ne nécessite pas de vieillir. Il nécessite de <em>réaliser</em>.<br><br>'
   .h('La croissance post-traumatique (Tedeschi & Calhoun, 1996)').'<br>'
   .'Les personnes qui traversent une perte majeure ou un choc existentiel ne reviennent pas simplement à leur état d\'avant. '
   .'La majorité émergent transformées — plus riches dans leurs relations, plus courageuses dans leurs choix, plus présentes dans leur vie.<br><br>'
   .'Ce n\'est pas de la résilience au sens du "rebondir". C\'est de la <em>croissance</em> — au sens d\'aller plus loin qu\'avant la perte.<br><br>'
   .cit($c2, '"Le traumatisme n\'est pas ce qui vous brise. C\'est ce qui révèle ce dont vous êtes fait." — Tedeschi & Calhoun')
);

// ─── EXERCICE ① — L'HORLOGE ─────────────────────────────────────────────────
$c3 = 'rgba(248,113,113,.85)';
$ex1_fr = bloc($c3, '①',
    'L\'Horloge — le calcul que personne ne veut faire',
    s('Ce que cet exercice produit',
        'Cet exercice est inspiré des travaux de Hal Hershfield (UCLA, 2011) sur la connexion au soi futur. '
       .'Sa recherche démontre que les personnes qui se projettent dans la réalité de leur vie future avec précision '
       .'prennent des décisions significativement plus cohérentes avec leurs valeurs dans les semaines qui suivent.<br><br>'
       .'La version que vous allez faire est plus directe — et plus puissante.'
    )
    .s('Le protocole — prenez un stylo et du papier',
        h('Étape 1 — Votre âge aujourd\'hui').'<br>'
       .'Écrivez votre âge. Maintenant.<br><br>'
       .h('Étape 2 — L\'espérance de vie').'<br>'
       .'L\'espérance de vie en France est de 82 ans pour les femmes, 79 ans pour les hommes. '
       .'Soustrayez votre âge actuel. Ce chiffre — c\'est le nombre d\'années qu\'il vous reste statistiquement.<br><br>'
       .'Pas une garantie. Une médiane statistique.<br><br>'
       .h('Étape 3 — Les étés').'<br>'
       .'Multipliez ce chiffre par 1. C\'est le nombre d\'étés qu\'il vous reste '
       .'— le nombre de fois où vous entendrez "les vacances arrivent", où vos enfants grandiront un an de plus, '
       .'où vous aurez une chance de prendre ce voyage que vous reportez depuis 5 ans.<br><br>'
       .h('Étape 4 — Les samedis matins').'<br>'
       .'Multipliez par 52. Ce sont vos samedis matins restants. '
       .'Ces matins où vous pourriez être vraiment avec vos proches — ou sur votre téléphone, ou à penser au travail.<br><br>'
       .h('Étape 5 — La liste de ceux que vous aimez').'<br>'
       .'Pensez aux 5 personnes que vous aimez le plus. '
       .'Pour chacune, estimez combien de fois vous les verrez encore — vraiment — si vous continuez à vivre comme maintenant.<br><br>'
       .'Un enfant qui a 18 ans et s\'apprête à quitter la maison : peut-être 10 étés ensemble. En entier. Peut-être moins.<br><br>'
       .h('Posez votre stylo. Restez un moment avec ce que vous venez de voir.')
    )
    .cit($c3, '"Vous avez peut-être 4 000 semaines à vivre. C\'est peu. La question n\'est pas comment les remplir. La question est : avec quoi les remplir vraiment ?" — Oliver Burkeman, Four Thousand Weeks, 2021')
);

// ─── EXERCICE ② — L'ÉPITAPHE ────────────────────────────────────────────────
$c4 = 'rgba(168,85,247,.85)';
$ex2_fr = bloc($c4, '②',
    'L\'Épitaphe — la phrase que vous voulez que votre vie dise',
    s('Pourquoi cet exercice',
        'Depuis l\'Antiquité, les philosophes stoïciens utilisaient cette pratique — la <em>meditatio mortis</em> — non pour se déprimer, mais pour clarifier. '
       .'Sénèque, Marc Aurèle, Épictète recommandaient tous de contempler régulièrement sa propre mort pour vivre avec plus d\'intention.<br><br>'
       .'Aujourd\'hui, la psychologie positive la réintègre sous le nom d\'<em>obituary exercise</em> (Stephen Covey, Les 7 habitudes, 1989). '
       .'Covey l\'utilise comme point de départ de toute transformation : '
       .'commencer par voir la fin pour savoir où on va.'
    )
    .s('Le protocole — 3 parties',
        h('Partie A — L\'épitaphe de votre vie telle qu\'elle est (10 min)').'<br>'
       .'Si vous mouriez demain, que dirait-on de vous lors de votre éloge funèbre ?<br>'
       .'Pas ce que vous voulez qu\'on dise. Ce qu\'on dirait honnêtement. '
       .'Basé sur la façon dont vous vivez réellement, maintenant.<br><br>'
       .'Rédigez-la. En 5 à 8 phrases. En première ou troisième personne.<br><br>'
       .h('Partie B — L\'épitaphe de votre vie telle que vous la voulez (10 min)').'<br>'
       .'Maintenant, écrivez l\'épitaphe de la vie que vous voulez avoir vécue.<br>'
       .'Pas idéalisée à l\'excès. Mais vraiment voulue. '
       .'Ce que vous voulez que vos enfants retiennent de vous. Ce que vous voulez avoir fait. Été. Transmis.<br><br>'
       .h('Partie C — La distance (5 min)').'<br>'
       .'Posez les deux textes côte à côte.<br>'
       .'Lisez-les l\'un après l\'autre.<br><br>'
       .'Qu\'est-ce que vous voyez ?<br><br>'
       .'La distance entre ces deux textes...<br>'
       .'C\'est là que commence votre transformation.<br>'
       .'C\'est exactement pour ça que ce parcours existe.'
    )
    .cit($c4, '"Commencez avec la fin en tête." — Stephen Covey, Les 7 habitudes des gens très efficaces, 1989')
);

// ─── EXERCICE ③ — LA LETTRE ─────────────────────────────────────────────────
$c5 = 'rgba(34,197,94,.85)';
$ex3_fr = bloc($c5, '③',
    'La Lettre de votre futur moi — dans 10 ans, à vous aujourd\'hui',
    s('Le levier psychologique le plus puissant de ce parcours',
        'Hal Hershfield (UCLA) a montré avec des IRM que la majorité des gens perçoivent leur "moi futur" '
       .'comme un <em>étranger</em> — un personnage flou, presque fictif. '
       .'Résultat : ils lui font ce qu\'ils feraient à un inconnu — ils lui laissent les projets difficiles, '
       .'les conversations dures, les changements importants. "Il s\'en occupera."<br><br>'
       .'Cette lettre brise cette illusion. Elle fait exister votre moi futur — concrètement, charnellement.'
    )
    .s('Le protocole',
        'Vous êtes dans 10 ans.<br>'
       .'Vous regardez en arrière — à la personne que vous êtes aujourd\'hui, en train de lire ces lignes.<br><br>'
       .'Écrivez-lui une lettre.<br><br>'
       .'Dites-lui :<br><br>'
       .h('① Ce que vous avez compris que vous ne voyiez pas encore').'<br>'
       .'Qu\'est-ce que les 10 prochaines années vous ont appris sur vous-même, sur vos vraies priorités, '
       .'sur ce qui compte et ce qui ne compte pas ?<br><br>'
       .h('② Ce dont vous êtes le plus fier').'<br>'
       .'Un choix que vous avez fait. Une peur que vous avez traversée. '
       .'Quelque chose que vous avez dit enfin. Un projet que vous n\'avez pas reporté cette fois.<br><br>'
       .h('③ Ce que vous voudriez que votre moi actuel commence maintenant').'<br>'
       .'Pas dans 6 mois. Pas "quand les conditions seront meilleures". '
       .'Maintenant. Parce que vous savez ce que ça coûte d\'attendre.<br><br>'
       .h('④ Ce que vous avez transmis à vos enfants / proches').'<br>'
       .'Quelle version de vous-même ils ont vue grandir. Ce qu\'ils vous ont dit qu\'ils retenaient.<br><br>'
       .'Prenez le temps qu\'il vous faut. Cette lettre n\'est pas un exercice. '
       .'C\'est un <em>acte fondateur</em>.'
    )
    .cit($c5, '"Écrire à son futur moi n\'est pas un exercice de développement personnel. C\'est un acte d\'amour envers la personne que vous pouvez devenir." — Hershfield, 2011')
);

// ─── EXERCICE ④ — LES 3 QUESTIONS ───────────────────────────────────────────
$c6 = 'rgba(251,191,36,.85)';
$ex4_fr = bloc($c6, '④',
    'Les 3 Questions de Kinder — la séquence qui change tout',
    s('Origine',
        'George Kinder, fondateur du Life Planning (Harvard), utilise cette séquence depuis 30 ans '
       .'pour aider ses clients à identifier ce qu\'ils veulent vraiment de leur vie — au-delà des projections financières. '
       .'Il dit que presque tous ses clients pleurent à la troisième question. '
       .'Pas de tristesse. De reconnaissance soudaine.<br><br>'
       .'Prenez une feuille. Répondez dans l\'ordre. Ne passez pas à la suivante avant d\'avoir fini la précédente.'
    )
    .s('Les 3 questions',
        h('Question 1 — Si l\'argent n\'était pas un problème').'<br>'
       .'Imaginez que vous avez assez d\'argent pour le reste de votre vie. '
       .'Tout ce dont vous avez besoin, maintenant et pour toujours.<br><br>'
       .'Comment vivriez-vous ? Qu\'est-ce que vous changeriez dans votre vie, à partir de demain ?<br><br>'
       .'Prenez 15 minutes. Soyez précis. Pas de vœux pieux — de décisions concrètes.<br><br>'
       .h('Question 2 — Si vous aviez 5 à 10 ans à vivre').'<br>'
       .'Votre médecin vous apprend que vous avez 5 à 10 ans à vivre. '
       .'Vous vous sentirez parfaitement bien pendant cette période — mais vous savez comment elle se termine.<br><br>'
       .'Qu\'est-ce que vous changez dans votre vie ? Maintenant que vous êtes sûr du temps qu\'il vous reste ?<br><br>'
       .'Prenez 15 minutes. Qu\'est-ce qui disparaît de votre vie ? Qu\'est-ce qui y entre ?<br><br>'
       .h('Question 3 — Si vous aviez 24 heures').'<br>'
       .'Votre médecin vous apprend que vous avez 24 heures à vivre.<br><br>'
       .'Posez-vous ces questions — honnêtement :<br>'
       .'· Qu\'est-ce que vous regrettez de ne pas avoir fait ?<br>'
       .'· Qu\'est-ce que vous regrettez de ne pas avoir dit — et à qui ?<br>'
       .'· Qu\'est-ce que vous n\'avez jamais osé faire et qui vous manque maintenant ?<br>'
       .'· Quelle personne vous manque et que vous n\'avez pas vue assez ?<br><br>'
       .h('Maintenant : regardez vos réponses aux trois questions.').'<br>'
       .'Y a-t-il des thèmes qui reviennent ?<br>'
       .'Y a-t-il quelque chose que vous avez écrit à la question 3 que vous pouvez commencer à faire aujourd\'hui ?<br><br>'
       .cit($c6, '"Presque tous mes clients — PDG, médecins, entrepreneurs — pleurent à la troisième question. Non pas de tristesse. De reconnaissance. Ils voient enfin ce qu\'ils voulaient vraiment." — George Kinder')
    )
);

// ─── PRATIQUE ───────────────────────────────────────────────────────────────
$c7 = 'rgba(59,130,246,.85)';
$pratique_fr = '<div style="border-left:3px solid '.$c7.';padding:.85rem 1.25rem;margin-bottom:.8rem;background:rgba(0,0,0,.15);border-radius:0 10px 10px 0;">'
    .'<h4 style="color:#fff;font-size:.87rem;font-weight:700;margin:0 0 .5rem;display:flex;align-items:center;gap:.6rem;">'
    .'<span style="font-size:.68rem;color:'.$c7.';background:rgba(0,0,0,.35);border:1px solid '.$c7.';border-radius:6px;padding:.1rem .4rem;flex-shrink:0;">Pratique · Audio · 15 min</span>'
    .'🌬 La Respiration de l\'Urgence — ancrage dans le moment qui compte</h4>'
    .'<div style="font-size:.8rem;color:rgba(232,224,208,.72);line-height:1.85;">'
    .'Cette pratique ne cherche pas à vous calmer. Elle cherche à vous <strong>réveiller</strong>.<br><br>'
    .'Elle utilise le souffle comme vecteur d\'entrée dans une conscience que la plupart des gens ne visitent que rarement : '
    .'la conscience que <em>ce moment — maintenant — est réel, et limité, et précieux.</em><br><br>'
    .h('Ce que la science dit').'<br>'
    .'La recherche en neurologie du stress post-traumatique (van der Kolk, 2014) montre que le souffle est le seul '
    .'système autonome du corps sur lequel vous avez un contrôle direct. '
    .'Il est l\'interface entre votre monde intérieur et votre monde extérieur. '
    .'Apprendre à l\'utiliser délibérément, c\'est apprendre à choisir l\'état depuis lequel vous prenez vos décisions.<br><br>'
    .'Or, les décisions les plus importantes de ce parcours — celles qui concernent vraiment votre vie — '
    .'vous voulez les prendre depuis un état de clarté. Pas d\'angoisse. Pas de pilote automatique. '
    .'De <em>clarté vivante</em>.<br><br>'
    .h('La pratique').'<br>'
    .'Allongez-vous ou asseyez-vous, dos soutenu, mains sur les genoux, paumes ouvertes.<br><br>'
    .'<strong>Phase 1 — L\'inventaire du corps (3 min)</strong><br>'
    .'Fermez les yeux. Sans rien changer, observez votre respiration telle qu\'elle est maintenant. '
    .'Est-elle courte ? Tendue ? Dans quelle partie du corps ressentez-vous la tension ?<br>'
    .'Ne changez rien. Observez simplement.<br><br>'
    .'<strong>Phase 2 — La Pause Souffle avec intention (5 min)</strong><br>'
    .'5 temps pour inspirer — en vous disant : <em>je suis vivant, maintenant.</em><br>'
    .'5 temps de silence — en vous disant : <em>ce moment existe. Il ne reviendra pas.</em><br>'
    .'5 temps pour expirer — en vous disant : <em>je choisis comment je vis ça.</em><br><br>'
    .'8 cycles. Lentement. Avec intention.<br><br>'
    .'<strong>Phase 3 — La vision (5 min)</strong><br>'
    .'Laissez venir l\'image d\'une personne que vous aimez. '
    .'Votre enfant. Un parent encore vivant. Un ami que vous n\'avez pas appelé depuis trop longtemps.<br><br>'
    .'Voyez leur visage clairement.<br><br>'
    .'Posez-vous une question — et restez avec elle sans chercher à répondre vite :<br>'
    .'<em>Est-ce que cette personne sait vraiment ce qu\'elle représente pour moi ?</em><br><br>'
    .'<strong>Phase 4 — L\'ancrage (2 min)</strong><br>'
    .'Dites intérieurement :<br>'
    .'<em>J\'ai du temps. Mais pas indéfiniment.<br>'
    .'Ce que j\'ai à vivre, à dire, à construire — commence maintenant.<br>'
    .'Pas demain. Pas après ce parcours. Maintenant.</em><br><br>'
    .cit($c7, '"Le souffle est la seule porte entre ce que vous subissez et ce que vous choisissez." — van der Kolk, The Body Keeps the Score, 2014')
    .'</div></div>';

// ─── EXERCICE ⑤ — L'ENGAGEMENT ──────────────────────────────────────────────
$c8 = 'rgba(20,184,166,.85)';
$ex5_fr = bloc($c8, '⑤',
    'L\'Acte Fondateur — un engagement irréversible avant de continuer',
    s('Pourquoi maintenant',
        'La recherche en psychologie de l\'engagement (Cialdini, 1984) montre que les personnes qui '
       .'formalisent un engagement concret au début d\'un processus de transformation sont trois fois '
       .'plus susceptibles de le mener à terme que celles qui commencent sans engagement.<br><br>'
       .'Ce n\'est pas une signature de contrat. C\'est un ancrage — une déclaration faite à vous-même, '
       .'depuis l\'état dans lequel vous êtes maintenant, après avoir traversé ce module.'
    )
    .s('Le protocole',
        h('Étape 1 — Ce que vous avez vu (10 min)').'<br>'
       .'Depuis les exercices de ce module, qu\'avez-vous vu que vous ne voyiez pas clairement avant ?<br>'
       .'Une priorité. Une personne. Un projet. Une peur. Un mensonge que vous vous racontiez.<br>'
       .'Écrivez-le en une phrase précise.<br><br>'
       .h('Étape 2 — L\'engagement concret (10 min)').'<br>'
       .'À partir de ce que vous avez vu, choisissez <strong>un seul acte concret</strong> que vous vous engagez à faire dans les 7 prochains jours. '
       .'Pas à finir. Commencer.<br><br>'
       .'L\'acte doit être :<br>'
       .'· Précis (pas "passer plus de temps avec mes enfants" — "jeudi soir, dîner sans téléphone, jeu de société")<br>'
       .'· Lié à ce qui compte vraiment pour vous<br>'
       .'· Faisable cette semaine<br><br>'
       .h('Étape 3 — La déclaration').'<br>'
       .'Écrivez cette phrase, à la main, sur une vraie feuille :<br><br>'
       .'<em>"Moi, [votre prénom], je m\'engage à [acte précis] avant le [date précise].<br>'
       .'Je fais cela parce que je choisis de vivre ma vie — pas de la regarder passer."</em><br><br>'
       .'Signez. Datez. Gardez cette feuille quelque part où vous la verrez.<br><br>'
       .cit($c8, '"Un engagement écrit, signé, daté, déclenche un mécanisme neurologique de cohérence que l\'intention mentale ne déclenche pas." — Robert Cialdini, Influence, 1984')
    )
);

// ─── JOURNAL ────────────────────────────────────────────────────────────────
$c9 = 'rgba(201,168,76,.9)';
$journal_fr = bloc($c9, '✍',
    'Journal d\'entrée — la question centrale de tout le parcours',
    s('Avant de commencer',
        'Vous avez maintenant tout ce qu\'il faut pour répondre à la question la plus importante de ce parcours.<br><br>'
       .'Pas la plus facile. La plus vraie.'
    )
    .s('Les 3 questions du journal',
        h('① Si vous deviez résumer ce que vous voulez vraiment de votre vie en une seule phrase — laquelle serait-ce ?').'<br><br>'
       .h('② Quelle est la chose que vous reportez depuis le plus longtemps — et qui, vous le savez, compte vraiment ?').'<br><br>'
       .h('③ Qui a besoin de vous — vraiment, profondément — et à qui n\'avez-vous pas donné cette présence ?').'<br><br>'
       .'Prenez le temps qu\'il vous faut. Ce journal ne sera lu que par vous.<br><br>'
       .cit($c9, '"Ce parcours commence ici. Pas dans les modules suivants. Ici. Dans votre réponse à ces trois questions."')
    )
);

// ════════════════════════════════════════════════════════════════════════════
//  VERSION EN
// ════════════════════════════════════════════════════════════════════════════

$ouverture_en = lect('rgba(201,168,76,.9)', 'Prologue · Before everything else',
    'Why this program exists',
    '<div style="font-size:.9rem;line-height:2.1;color:rgba(232,224,208,.92);">'
   .'There are moments in a life that cut the world in two.<br><br>'
   .'Before. And after.<br><br>'
   .'This program was born from one of those moments.<br><br>'
   .'A childhood friend. Forty years old. A daughter of thirteen. A son of ten. '
   .'A diagnosed cancer, a remission — and then, within a month, it was over.<br><br>'
   .'Not an old man at the end of a long life.<br>'
   .'Someone your age. With the same plans as you. The same children as you.<br><br>'
   .'That day, something cracked in the silent certainty that death is for later.<br><br>'
   .'And in that crack entered something unexpected: '
   .'<strong style="color:#fff;">radical clarity about what truly matters.</strong><br><br>'
   .'Not the career. Not the house. Not the image others have of you.<br><br>'
   .'The people. The presence. The unpostponed projects. '
   .'The unsaid words. The promised trips. The mornings when you were truly there.<br><br>'
   .'This program was built from that crack.<br>'
   .'Not to teach you to live better.<br>'
   .'To remind you that you are <em style="color:rgba(201,168,76,.9);">already living</em> '
   .'— and that each passing day is one less day to do what truly matters.<br><br>'
   .'This module is not an introduction.<br>'
   .'It is the <strong style="color:#fff;">central question</strong> all other modules try to answer.<br><br>'
   .cit('rgba(201,168,76,.9)', '"It is not death that people fear most. It is the fear of arriving at death and realizing they never truly lived." — Marcus Aurelius, Meditations')
   .'</div>'
);

$lecon1_en = lect('rgba(239,68,68,.85)',
    'WHO · 2023  |  Yalom · 2008  |  Heidegger · 1927',
    'Lesson 1 — The truth nobody told you about time',
    h('The statistic nobody looks at').'<br>'
   .'Every year, the WHO publishes global mortality data. What very few people actually look at: '
   .'<strong>in most Western countries, roughly 30% of deaths occur before age 65.</strong><br><br>'
   .'Among them: cancers diagnosed between 35 and 55, cardiovascular disease, accidents, suicide, autoimmune disease.<br><br>'
   .'If you are between 30 and 55, you are statistically in the window where death does not warn. '
   .'It does not only strike the old. It strikes people who had plans. Children. Trips planned for "next year".<br><br>'
   .cit('rgba(239,68,68,.85)', '"Death is not the enemy. The enemy is indifference to one\'s own life." — Irvin Yalom, Stanford, 2008').'<br><br>'
   .h('The difference between knowing and realizing').'<br>'
   .'Everyone <em>knows</em> they will die. Almost no one actually <em>realizes</em> it.<br><br>'
   .'Martin Heidegger, in <em>Being and Time</em> (1927), distinguishes two modes of existence:<br><br>'
   .'<strong>Inauthentic mode</strong> — living by default. Doing what others do. Postponing. Occupying oneself with everything except what is essential. Letting life happen.<br><br>'
   .'<strong>Authentic mode</strong> — living consciously of one\'s own finitude. Making decisions from one\'s real values. Being present to what matters, now.<br><br>'
   .'Most people live in inauthentic mode — not from cowardice, but because no one ever created the conditions for them to shift.<br><br>'
   .'<strong>This program is designed to create those conditions.</strong><br><br>'
   .cit('rgba(239,68,68,.85)', '"The moment you truly realize you are going to die — not in 40 years, but on a specific day you do not know — is the moment your life changes." — Heidegger, 1927').'<br><br>'
   .h('Terror Management Theory: death as fuel').'<br>'
   .'Jeff Solomon, Jeff Greenberg & Sheldon Pyszczynski (1991): when people are made aware of their own mortality — even briefly — their values reorient immediately. '
   .'They invest in deep relationships, abandon superficial activities, call their loved ones, question their priorities. '
   .'This effect lasts. And it amplifies when the awareness is integrated — not repressed, not denied, but <em>looked at directly.</em>'
);

$lecon2_en = lect('rgba(59,130,246,.85)',
    'Bronnie Ware · 2012  |  Carstensen · 2006  |  Tedeschi & Calhoun · 1996',
    'Lesson 2 — The regrets of the dying and the science of what matters',
    h('The woman who listened to the dying for 10 years').'<br>'
   .'Bronnie Ware was an Australian palliative care nurse. For a decade, she collected the final confidences of people at end of life. '
   .'What they told her, she compiled in <em>The Top Five Regrets of the Dying</em> (2012).<br><br>'
   .'The five most cited regrets, in order:<br><br>'
   .'<strong>① "I wish I\'d had the courage to live a life true to myself, not the life others expected of me."</strong><br><br>'
   .'<strong>② "I wish I hadn\'t worked so hard."</strong><br>'
   .'Almost every man. Nearly all working women. Without exception.<br><br>'
   .'<strong>③ "I wish I\'d had the courage to express my feelings."</strong><br>'
   .'The unsaid words. The held-back "I love you"s. The truths kept for fear of conflict.<br><br>'
   .'<strong>④ "I wish I had stayed in touch with my friends."</strong><br><br>'
   .'<strong>⑤ "I wish I had let myself be happier."</strong><br>'
   .'The discovery that happiness is a choice — made too late.<br><br>'
   .cit('rgba(59,130,246,.85)', '"Nobody on their deathbed ever said \'I wish I\'d spent more time at the office\'." — Bronnie Ware, 2012').'<br><br>'
   .h('What science says: the clarity that finitude gives (Carstensen, Stanford)').'<br>'
   .'Laura Carstensen showed that people who perceive their time as limited invest massively in: '
   .'deep relationships, meaningful experiences, and purpose. '
   .'And this shift does not require growing old. It requires <em>realizing.</em><br><br>'
   .h('Post-traumatic growth (Tedeschi & Calhoun, 1996)').'<br>'
   .'People who move through major loss do not simply return to who they were. '
   .'The majority emerge transformed — richer in their relationships, more courageous in their choices, more present in their lives.<br><br>'
   .cit('rgba(59,130,246,.85)', '"Trauma is not what breaks you. It is what reveals what you\'re made of." — Tedeschi & Calhoun')
);

$ex1_en = bloc('rgba(248,113,113,.85)', '①',
    'The Clock — the calculation nobody wants to do',
    s('What this exercise produces',
        'Inspired by Hal Hershfield\'s work (UCLA, 2011) on future-self connection. '
       .'People who project themselves into their future with precision make significantly more values-consistent decisions in the weeks that follow.'
    )
    .s('The protocol — pen and paper',
        h('Step 1 — Your age today.').'<br>Write it down. Now.<br><br>'
       .h('Step 2 — Life expectancy.').'<br>'
       .'Average life expectancy: approximately 79-82 years depending on country. Subtract your current age. '
       .'This number is how many years you have left — statistically. Not a guarantee. A median.<br><br>'
       .h('Step 3 — The summers.').'<br>'
       .'Multiply by 1. That is how many summers you have left — how many times your children will grow one year older, '
       .'how many chances you have to take that trip you\'ve been postponing for 5 years.<br><br>'
       .h('Step 4 — The Saturday mornings.').'<br>'
       .'Multiply by 52. These are your Saturday mornings left. '
       .'Mornings when you could be truly with your loved ones — or on your phone, or thinking about work.<br><br>'
       .h('Step 5 — The people you love.').'<br>'
       .'Think of the 5 people you love most. For each, estimate how many times you will actually see them — in full — '
       .'if you continue living as you do now.<br>'
       .'A child who is 18 and about to leave home: maybe 10 full summers together. Maybe fewer.<br><br>'
       .h('Put your pen down. Stay with what you just saw.')
    )
    .cit('rgba(248,113,113,.85)', '"You may have about 4,000 weeks to live. The question is not how to fill them. The question is: with what to fill them truly." — Oliver Burkeman, Four Thousand Weeks, 2021')
);

$ex2_en = bloc('rgba(168,85,247,.85)', '②',
    'The Epitaph — the sentence you want your life to say',
    s('Why this exercise',
        'The Stoics called it <em>meditatio mortis</em> — not for despair, but for clarity. '
       .'Seneca, Marcus Aurelius, Epictetus all recommended contemplating one\'s own death regularly in order to live with more intention. '
       .'Stephen Covey reintegrated it in <em>The 7 Habits</em> (1989) as "begin with the end in mind" — '
       .'the starting point of all transformation.'
    )
    .s('The protocol — 3 parts',
        h('Part A — The epitaph of your life as it is (10 min)').'<br>'
       .'If you died tomorrow, what would be said at your eulogy?<br>'
       .'Not what you want said. What would honestly be said, based on how you actually live right now.<br>'
       .'Write it. 5 to 8 sentences.<br><br>'
       .h('Part B — The epitaph of the life you want to have lived (10 min)').'<br>'
       .'Write the epitaph of the life you actually want. '
       .'What you want your children to remember about you. What you want to have done. Been. Transmitted.<br><br>'
       .h('Part C — The distance (5 min)').'<br>'
       .'Place both texts side by side. Read them one after the other.<br><br>'
       .'The distance between these two texts...<br>'
       .'That is where your transformation begins.<br>'
       .'That is exactly why this program exists.'
    )
    .cit('rgba(168,85,247,.85)', '"Begin with the end in mind." — Stephen Covey, The 7 Habits of Highly Effective People, 1989')
);

$ex3_en = bloc('rgba(34,197,94,.85)', '③',
    'The Letter from Your Future Self — in 10 years, to you today',
    s('The most powerful psychological lever in this program',
        'Hershfield (UCLA) showed with MRI scans that most people perceive their "future self" '
       .'as a stranger — a blurry, almost fictional character. '
       .'They leave the difficult projects, the hard conversations, the important changes for them. "They\'ll deal with it."<br><br>'
       .'This letter breaks that illusion. It makes your future self exist — concretely, physically.'
    )
    .s('The protocol',
        'You are 10 years from now. You look back at the person you are today, reading these words.<br><br>'
       .'Write them a letter.<br><br>'
       .h('① What you understood that you couldn\'t yet see').'<br>'
       .'What did the next 10 years teach you about yourself, your real priorities, what matters and what doesn\'t?<br><br>'
       .h('② What you are most proud of').'<br>'
       .'A decision you made. A fear you walked through. '
       .'Something you finally said. A project you didn\'t postpone this time.<br><br>'
       .h('③ What you want your current self to start now').'<br>'
       .'Not in 6 months. Not "when conditions are better." Now. Because you know what it costs to wait.<br><br>'
       .h('④ What you transmitted to your children / loved ones').'<br>'
       .'What version of yourself they watched grow. What they told you they remembered.<br><br>'
       .'Take all the time you need. This letter is not an exercise. It is a founding act.'
    )
    .cit('rgba(34,197,94,.85)', '"Writing to your future self is not a self-help exercise. It is an act of love toward the person you can become." — Hershfield, 2011')
);

$ex4_en = bloc('rgba(251,191,36,.85)', '④',
    'Kinder\'s 3 Questions — the sequence that changes everything',
    s('Origin',
        'George Kinder, founder of Life Planning (Harvard), has used this sequence for 30 years '
       .'to help clients identify what they truly want from life. '
       .'He says almost all his clients cry at the third question. '
       .'Not from sadness. From sudden recognition.'
    )
    .s('The 3 questions',
        h('Question 1 — If money were not an issue').'<br>'
       .'Imagine you have enough money for the rest of your life. Everything you need, now and forever.<br><br>'
       .'How would you live? What would you change in your life, starting tomorrow?<br>'
       .'Take 15 minutes. Be specific. Not wishes — concrete decisions.<br><br>'
       .h('Question 2 — If you had 5 to 10 years to live').'<br>'
       .'Your doctor tells you that you have 5 to 10 years to live. '
       .'You will feel perfectly well during that time — but you know how it ends.<br><br>'
       .'What do you change? Now that you know exactly how much time you have left.<br>'
       .'Take 15 minutes. What disappears from your life? What enters it?<br><br>'
       .h('Question 3 — If you had 24 hours').'<br>'
       .'Your doctor tells you that you have 24 hours to live.<br><br>'
       .'· What do you regret not having done?<br>'
       .'· What do you regret not having said — and to whom?<br>'
       .'· What did you never dare do and that you now miss?<br>'
       .'· Which person do you miss and haven\'t seen enough of?<br><br>'
       .h('Now: look at your answers to all three questions.').'<br>'
       .'Are there themes that recur?<br>'
       .'Is there something from question 3 that you can begin doing today?<br><br>'
       .cit('rgba(251,191,36,.85)', '"Almost all my clients — CEOs, doctors, entrepreneurs — cry at the third question. Not from sadness. From recognition. They finally see what they truly wanted." — George Kinder')
    )
);

$pratique_en = '<div style="border-left:3px solid rgba(59,130,246,.85);padding:.85rem 1.25rem;margin-bottom:.8rem;background:rgba(0,0,0,.15);border-radius:0 10px 10px 0;">'
    .'<h4 style="color:#fff;font-size:.87rem;font-weight:700;margin:0 0 .5rem;display:flex;align-items:center;gap:.6rem;">'
    .'<span style="font-size:.68rem;color:rgba(59,130,246,.85);background:rgba(0,0,0,.35);border:1px solid rgba(59,130,246,.85);border-radius:6px;padding:.1rem .4rem;flex-shrink:0;">Practice · Audio · 15 min</span>'
    .'🌬 The Breath of Urgency — anchoring in the moment that matters</h4>'
    .'<div style="font-size:.8rem;color:rgba(232,224,208,.72);line-height:1.85;">'
    .'This practice does not seek to calm you. It seeks to <strong>wake you up</strong>.<br><br>'
    .'It uses the breath as the vehicle for entering a state of consciousness that most people visit only rarely: '
    .'the awareness that <em>this moment — now — is real, and limited, and precious.</em><br><br>'
    .h('What science says').'<br>'
    .'Van der Kolk (2014): the breath is the only autonomic system of the body over which you have direct control. '
    .'Learning to use it deliberately is learning to choose the state from which you make your decisions. '
    .'The most important decisions of this program — those that truly concern your life — '
    .'you want to make from a state of clarity. Not anxiety. Not autopilot. <em>Living clarity.</em><br><br>'
    .h('The practice').'<br>'
    .'Lie down or sit with your back supported, hands on your knees, palms open.<br><br>'
    .'<strong>Phase 1 — Body inventory (3 min)</strong><br>'
    .'Close your eyes. Without changing anything, observe your breath as it is right now. '
    .'Is it short? Tight? Where do you feel tension in your body?<br>'
    .'Change nothing. Simply observe.<br><br>'
    .'<strong>Phase 2 — Pause Souffle with intention (5 min)</strong><br>'
    .'5 counts to breathe in — telling yourself: <em>I am alive, now.</em><br>'
    .'5 counts of silence — telling yourself: <em>this moment exists. It will not come back.</em><br>'
    .'5 counts to breathe out — telling yourself: <em>I choose how I live this.</em><br><br>'
    .'8 cycles. Slowly. With intention.<br><br>'
    .'<strong>Phase 3 — The vision (5 min)</strong><br>'
    .'Let an image come of someone you love. '
    .'Your child. A parent still living. A friend you haven\'t called in too long.<br><br>'
    .'See their face clearly.<br><br>'
    .'Ask yourself a question — and stay with it without rushing to answer:<br>'
    .'<em>Does this person truly know what they mean to me?</em><br><br>'
    .'<strong>Phase 4 — The anchor (2 min)</strong><br>'
    .'Say inwardly:<br>'
    .'<em>I have time. But not indefinitely.<br>'
    .'What I have to live, to say, to build — begins now.<br>'
    .'Not tomorrow. Not after this program. Now.</em><br><br>'
    .cit('rgba(59,130,246,.85)', '"The breath is the only door between what you endure and what you choose." — van der Kolk, The Body Keeps the Score, 2014')
    .'</div></div>';

$ex5_en = bloc('rgba(20,184,166,.85)', '⑤',
    'The Founding Act — one irreversible commitment before continuing',
    s('Why now',
        'Cialdini (1984): people who formalize a concrete commitment at the start of a transformation process '
       .'are three times more likely to complete it than those who begin without one. '
       .'Not a contract. An anchor — a declaration made to yourself, from the state you are in now, '
       .'after moving through this module.'
    )
    .s('The protocol',
        h('Step 1 — What you saw (10 min)').'<br>'
       .'Since the exercises in this module, what have you seen that you didn\'t see clearly before?<br>'
       .'A priority. A person. A project. A fear. A lie you were telling yourself.<br>'
       .'Write it in one precise sentence.<br><br>'
       .h('Step 2 — The concrete commitment (10 min)').'<br>'
       .'Choose <strong>one single concrete act</strong> you commit to doing within the next 7 days. Not finishing. Beginning.<br><br>'
       .'The act must be:<br>'
       .'· Precise (not "spend more time with my children" — "Thursday evening, dinner without phones, board game")<br>'
       .'· Linked to what truly matters to you<br>'
       .'· Doable this week<br><br>'
       .h('Step 3 — The declaration').'<br>'
       .'Write this sentence, by hand, on a real piece of paper:<br><br>'
       .'<em>"I, [your name], commit to [precise act] before [precise date].<br>'
       .'I do this because I choose to live my life — not watch it pass by."</em><br><br>'
       .'Sign it. Date it. Keep it somewhere you will see it.<br><br>'
       .cit('rgba(20,184,166,.85)', '"A written, signed, dated commitment triggers a neurological consistency mechanism that mental intention does not." — Robert Cialdini, Influence, 1984')
    )
);

$journal_en = bloc('rgba(201,168,76,.9)', '✍',
    'Entry Journal — the central question of the entire program',
    s('Before you begin',
        'You now have everything you need to answer the most important question in this program.<br><br>'
       .'Not the easiest one. The truest one.'
    )
    .s('The 3 journal questions',
        h('① If you had to summarize what you truly want from your life in one sentence — what would it be?').'<br><br>'
       .h('② What is the thing you have been postponing the longest — and that you know, deep down, truly matters?').'<br><br>'
       .h('③ Who needs you — truly, deeply — and to whom have you not given that presence?').'<br><br>'
       .'Take all the time you need. This journal is only for you.<br><br>'
       .cit('rgba(201,168,76,.9)', '"This program begins here. Not in the next modules. Here. In your answers to these three questions."')
    )
);

// ════════════════════════════════════════════════════════════════════════════
//  ASSEMBLAGE
// ════════════════════════════════════════════════════════════════════════════

$activities_fr = [
    ['type'=>'lecture', 'title'=>'Pourquoi ce parcours existe', 'content'=>$ouverture_fr, 'duration'=>'5 min', 'description'=>'L\'histoire vraie de l\'orig ine de ce parcours. La mort d\'un ami de 40 ans. Deux enfants. Et la clarté radicale que cette perte a produite.'],
    ['type'=>'lecture', 'title'=>'Leçon 1 — La vérité que personne ne vous a dite sur le temps', 'content'=>$lecon1_fr, 'duration'=>'10 min', 'description'=>'OMS : 30% des décès avant 65 ans. Heidegger : mode authentique vs inauthentique. Terror Management Theory : la conscience de la finitude réoriente les valeurs en profondeur.'],
    ['type'=>'lecture', 'title'=>'Leçon 2 — Les regrets des mourants et la science de ce qui compte', 'content'=>$lecon2_fr, 'duration'=>'10 min', 'description'=>'Bronnie Ware : les 5 regrets. Carstensen : finitude = clarté. Tedeschi & Calhoun : croissance post-traumatique. La mort de l\'autre comme révélateur de vie.'],
    ['type'=>'exercice', 'title'=>'① L\'Horloge — le calcul que personne ne veut faire', 'content'=>$ex1_fr, 'duration'=>'30 min', 'description'=>'Calculer ses étés restants · ses samedis matins · les fois où vous verrez encore vraiment chaque personne que vous aimez. Burkeman : 4000 semaines. Hershfield : connexion au soi futur.'],
    ['type'=>'ecriture', 'title'=>'② L\'Épitaphe — la phrase que vous voulez que votre vie dise', 'content'=>$ex2_fr, 'duration'=>'25 min', 'description'=>'Covey (7 Habits) : "commencer avec la fin en tête". Rédiger l\'épitaphe de votre vie telle qu\'elle est vs telle que vous la voulez. La distance entre les deux = votre travail.'],
    ['type'=>'ecriture', 'title'=>'③ La Lettre de votre futur moi — dans 10 ans, à vous aujourd\'hui', 'content'=>$ex3_fr, 'duration'=>'40 min', 'description'=>'Hershfield (UCLA) : le moi futur perçu comme étranger. Lettre du moi dans 10 ans : révélations, fiertés, ce qu\'il voudrait que vous commenciez maintenant, ce que vous avez transmis.'],
    ['type'=>'exercice', 'title'=>'④ Les 3 Questions de Kinder — la séquence qui change tout', 'content'=>$ex4_fr, 'duration'=>'50 min', 'description'=>'George Kinder (Harvard). Q1 : si l\'argent n\'était pas un problème. Q2 : si vous aviez 5 à 10 ans. Q3 : si vous aviez 24h. Presque tous les participants pleurent à la troisième question.'],
    ['type'=>'pratique', 'audio'=>true, 'title'=>'🌬 La Respiration de l\'Urgence — ancrage dans le moment qui compte (15 min)', 'content'=>$pratique_fr, 'duration'=>'15 min', 'description'=>'Van der Kolk : le souffle comme porte entre ce qu\'on subit et ce qu\'on choisit. Cycle Pause Souffle avec intention existentielle. Vision d\'un proche. Ancrage : "ce que j\'ai à vivre commence maintenant."'],
    ['type'=>'exercice', 'title'=>'⑤ L\'Acte Fondateur — un engagement irréversible avant de continuer', 'content'=>$ex5_fr, 'duration'=>'20 min', 'description'=>'Cialdini (1984) : l\'engagement écrit triple les chances de transformation. Un acte précis, lié à ce qui compte, réalisable cette semaine. Signé. Daté. Gardé.'],
    ['type'=>'reflexion', 'title'=>'✍ Journal d\'entrée — la question centrale de tout le parcours', 'content'=>$journal_fr, 'duration'=>'20 min', 'description'=>'3 questions : la phrase que vous voulez que votre vie dise · la chose reportée la plus longtemps · la personne qui a besoin de vous. Le parcours commence ici.'],
];

$activities_en = [
    ['type'=>'lecture', 'title'=>'Why this program exists', 'content'=>$ouverture_en, 'duration'=>'5 min', 'description'=>'The true story of the origin of this program. The death of a 40-year-old friend. Two children. And the radical clarity that loss produced.'],
    ['type'=>'lecture', 'title'=>'Lesson 1 — The truth nobody told you about time', 'content'=>$lecon1_en, 'duration'=>'10 min', 'description'=>'WHO: 30% of deaths before 65. Heidegger: authentic vs inauthentic mode. Terror Management Theory: consciousness of finitude reorients values in depth.'],
    ['type'=>'lecture', 'title'=>'Lesson 2 — The regrets of the dying and the science of what matters', 'content'=>$lecon2_en, 'duration'=>'10 min', 'description'=>'Bronnie Ware: the 5 regrets. Carstensen: finitude = clarity. Tedeschi & Calhoun: post-traumatic growth. Someone else\'s death as a revealer of life.'],
    ['type'=>'exercice', 'title'=>'① The Clock — the calculation nobody wants to do', 'content'=>$ex1_en, 'duration'=>'30 min', 'description'=>'Calculating remaining summers · Saturday mornings · times you will truly see each person you love. Burkeman: 4000 weeks. Hershfield: future-self connection.'],
    ['type'=>'ecriture', 'title'=>'② The Epitaph — the sentence you want your life to say', 'content'=>$ex2_en, 'duration'=>'25 min', 'description'=>'Covey (7 Habits): "begin with the end in mind." Write the epitaph of your life as it is vs as you want it. The distance between the two = your work.'],
    ['type'=>'ecriture', 'title'=>'③ The Letter from Your Future Self — in 10 years, to you today', 'content'=>$ex3_en, 'duration'=>'40 min', 'description'=>'Hershfield (UCLA): the future self perceived as a stranger. Letter from the self in 10 years: revelations, pride, what it wants you to start now, what you transmitted.'],
    ['type'=>'exercice', 'title'=>'④ Kinder\'s 3 Questions — the sequence that changes everything', 'content'=>$ex4_en, 'duration'=>'50 min', 'description'=>'George Kinder (Harvard). Q1: if money were no issue. Q2: if you had 5-10 years. Q3: if you had 24h. Almost all participants cry at the third question.'],
    ['type'=>'pratique', 'audio'=>true, 'title'=>'🌬 The Breath of Urgency — anchoring in the moment that matters (15 min)', 'content'=>$pratique_en, 'duration'=>'15 min', 'description'=>'Van der Kolk: the breath as door between what you endure and what you choose. Pause Souffle cycle with existential intention. Vision of a loved one. Anchor: "what I have to live begins now."'],
    ['type'=>'exercice', 'title'=>'⑤ The Founding Act — one irreversible commitment before continuing', 'content'=>$ex5_en, 'duration'=>'20 min', 'description'=>'Cialdini (1984): written commitment triples transformation rates. One precise act, linked to what matters, doable this week. Signed. Dated. Kept.'],
    ['type'=>'reflexion', 'title'=>'✍ Entry Journal — the central question of the entire program', 'content'=>$journal_en, 'duration'=>'20 min', 'description'=>'3 questions: the sentence you want your life to say · the most postponed thing · the person who needs you. The program begins here.'],
];

// ════════════════════════════════════════════════════════════════════════════
//  INSERTION EN BASE
// ════════════════════════════════════════════════════════════════════════════

$existing = DB::table('formation_modules')
    ->where('slug','00-prologue-la-vie-na-pas-dage')
    ->where('track','parcours')
    ->first();

if ($existing) {
    DB::table('formation_modules')->where('id', $existing->id)->update([
        'activities'    => json_encode($activities_fr, JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES),
        'activities_en' => json_encode($activities_en, JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES),
        'updated_at'    => now(),
    ]);
    echo "✅ Module 0 mis à jour. ID: ".$existing->id."\n";
} else {
    $id = DB::table('formation_modules')->insertGetId([
        'slug'          => '00-prologue-la-vie-na-pas-dage',
        'title'         => 'Prologue — La vie n\'a pas d\'âge',
        'title_en'      => 'Prologue — Life Has No Age',
        'description'   => 'Avant tout le reste. La question qui allume tout. Ce module est né d\'un électrochoc — la mort d\'un ami de 40 ans, laissant deux enfants derrière lui. Il vous posera les questions que personne ne vous a jamais posées aussi directement. Après ce module, vous ne voyez plus le parcours de la même façon. Vous le traversez avec une urgence différente — celle de quelqu\'un qui a réalisé que sa vie est précieuse, limitée, et déjà en train de se passer.',
        'description_en'=> 'Before everything else. The question that ignites everything. This module was born from a shock — the death of a 40-year-old friend, leaving two children behind. It will ask you the questions no one has ever asked you this directly. After this module, you no longer see the program the same way. You move through it with a different urgency — that of someone who has realized their life is precious, limited, and already happening.',
        'order'         => 0,
        'week_label'    => 'Prologue',
        'track'         => 'parcours',
        'part'          => 1,
        'is_active'     => 1,
        'activities'    => json_encode($activities_fr, JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES),
        'activities_en' => json_encode($activities_en, JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES),
        'audio_path'    => 'formation/audio/00-prologue-la-vie-na-pas-dage-fr.mp3',
        'audio_path_en' => 'formation/audio/00-prologue-la-vie-na-pas-dage-en.mp3',
        'intro_text'    => "Vous allez commencer un parcours.\nMais avant que vous commenciez, il y a quelque chose que vous devez savoir.\n\nCe parcours est né d'un choc.\nLa mort d'un ami d'enfance. Quarante ans. Deux enfants. Un cancer en rémission — et puis, en un mois, plus rien.\n\nCe jour-là, quelque chose s'est fissuré.\nLa certitude silencieuse que la mort, c'est pour plus tard.\nQue les projets importants peuvent attendre.\nQue vos proches seront là demain.\nQue vous aurez le temps.\n\nDans cette fissure est entré quelque chose d'inattendu : une clarté radicale.\n\nCe module est cette fissure.\nIl ne cherche pas à vous apprendre quelque chose.\nIl cherche à vous réveiller.",
        'intro_text_en' => "You are about to begin a program.\nBut before you begin, there is something you need to know.\n\nThis program was born from a shock.\nThe death of a childhood friend. Forty years old. Two children. A cancer in remission — and then, within a month, nothing.\n\nThat day, something cracked.\nThe silent certainty that death is for later.\nThat important projects can wait.\nThat your loved ones will be there tomorrow.\nThat you have time.\n\nIn that crack entered something unexpected: radical clarity.\n\nThis module is that crack.\nIt does not seek to teach you something.\nIt seeks to wake you up.",
        'created_at'    => now(),
        'updated_at'    => now(),
    ]);
    echo "✅ Module 0 créé. ID: ".$id."\n";
}

echo "Activités FR : ".count($activities_fr)."\n";
echo "Activités EN : ".count($activities_en)."\n";
