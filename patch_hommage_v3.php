<?php
require_once __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use Illuminate\Support\Facades\DB;

// Activité 1 FR — hommage Chantal v3 (sans belle-mère, sans tentative suicide)
$activity1FR = <<<'HTML'
<div class="activity-content hommage-chantal" style="font-family: Georgia, serif; line-height: 1.9; color: #1a1a2e;">

  <div style="text-align:center; margin-bottom: 2.5rem;">
    <div style="font-size: 2rem; color: #c9a96e; margin-bottom: 0.5rem;">✦</div>
    <h2 style="font-family: 'Playfair Display', Georgia, serif; font-size: 1.8rem; color: #c9a96e; font-weight: 400; letter-spacing: 0.05em;">
      À Chantal
    </h2>
    <p style="font-style: italic; color: #8a7560; font-size: 1rem;">Pourquoi ce parcours existe</p>
  </div>

  <p style="font-size: 1.1rem; margin-bottom: 1.5rem;">
    Ce parcours est dédié à une femme.<br>
    Une femme qui s'appelait Chantal.
  </p>

  <p style="font-size: 1.05rem; margin-bottom: 1.5rem;">
    Elle avait un sourire immédiat. Des dents blanches. Elle respirait la vie comme si elle lui appartenait — 
    pas par arrogance, mais par certitude tranquille. Elle savait qui elle était, d'où elle venait, 
    ce qu'elle aimait. Elle vivait depuis ses valeurs plutôt que depuis ses peurs.
  </p>

  <p style="font-size: 1.05rem; margin-bottom: 1.5rem;">
    Elle avait choisi le bon père pour ses enfants.<br>
    Ce n'était pas le choix le plus simple.<br>
    Il y avait des résistances autour d'elle — des personnes qui n'accueillaient pas ce choix.<br>
    Elle aurait pu se laisser décourager. Se protéger. Choisir différemment.<br>
    Elle ne l'a pas fait.
  </p>

  <p style="font-size: 1.05rem; margin-bottom: 1.5rem;">
    Elle a regardé au-delà de ce qu'elle traversait.<br>
    Au-delà d'elle-même.<br>
    Vers ce dont ses enfants auraient besoin… après elle.
  </p>

  <p style="font-size: 1.05rem; margin-bottom: 1.8rem;">
    Et certaines de ces personnes qui semblaient si loin d'elle à l'époque…<br>
    sont aujourd'hui celles qui chérissent ses enfants le plus.<br>
    Qui veillent sur eux. Qui les portent.<br>
    <strong>Chantal avait vu juste. À quarante ans.</strong>
  </p>

  <p style="font-size: 1.05rem; margin-bottom: 1.5rem;">
    Quand elle est partie, elle n'a pas laissé un vide.<br>
    Elle a laissé des bijoux.<br>
    Ses enfants — des êtres façonnés par une femme qui savait que ce qu'on sème aujourd'hui 
    pousse longtemps après qu'on soit parti.
  </p>

  <hr style="border: none; border-top: 1px solid #c9a96e; margin: 2rem auto; width: 60%;">

  <p style="font-size: 1.05rem; margin-bottom: 1.5rem;">
    Nous nous connaissions depuis le collège.<br>
    Chantal était la meilleure amie de ma sœur.<br>
    On s'est côtoyées au lycée, dans la même ville.<br>
    Puis je suis partie en Belgique. La vie a repris. Le silence ordinaire.
  </p>

  <p style="font-size: 1.05rem; margin-bottom: 1.5rem;">
    La dernière fois que j'ai eu Chantal au téléphone…<br>
    cela faisait des années qu'on ne s'était pas vraiment parlé.<br>
    Elle m'avait retrouvée sur les réseaux. Elle n'avait plus mon numéro.
  </p>

  <p style="font-size: 1.05rem; margin-bottom: 1.5rem;">
    Ce n'était pas un appel pour elle.<br>
    Ce n'était pas pour me dire qu'elle était malade.<br>
    C'était pour quelqu'un qu'elle aimait —<br>
    quelqu'un qui traversait quelque chose de très difficile,<br>
    quelqu'un qui avait besoin que l'on soit là.
  </p>

  <p style="font-size: 1.05rem; margin-bottom: 1.5rem;">
    Elle avait déjà son cancer. Je ne le savais pas. Elle ne me l'a pas dit.<br>
    Elle portait ça — et son premier réflexe, c'était les autres.<br>
    Toujours.
  </p>

  <p style="font-size: 1.05rem; margin-bottom: 1.5rem;">
    Elle était là pour elle…<br>
    quand moi je ne l'étais pas.<br><br>
    Et pendant ce temps-là, j'accompagnais dans la même ville une amie qui traversait un cancer du sein.<br>
    Je vivais à côté de Chantal sans le savoir.
  </p>

  <hr style="border: none; border-top: 1px solid #c9a96e; margin: 2rem auto; width: 60%;">

  <p style="font-size: 1.1rem; font-style: italic; color: #5a4a3a; margin-bottom: 1.5rem;">
    Chantal, tu m'as réveillée.<br>
    Pas par ta mort — par qui tu étais.<br>
    Par la façon dont tu as choisi de vivre,<br>
    même quand ce n'était pas facile.<br>
    Même quand personne ne regardait.<br>
    Même quand tu portais quelque chose que tu ne m'as pas dit.
  </p>

  <p style="font-size: 1.05rem; margin-bottom: 1.5rem;">
    Ce parcours est pour toutes celles et ceux qui se demandent,<br>
    quelque part dans un coin tranquille d'eux-mêmes :<br>
    <em>Est-ce que je vis vraiment ?</em><br>
    Ou est-ce que je laisse passer ma vie en attendant quelque chose ?
  </p>

  <p style="text-align:center; font-size: 1.2rem; color: #c9a96e; font-style: italic; margin-top: 2rem;">
    La vie n'a pas d'âge.<br>
    Mais elle a une durée.
  </p>

</div>
HTML;

// Activité 1 EN — To Chantal v3
$activity1EN = <<<'HTML'
<div class="activity-content hommage-chantal" style="font-family: Georgia, serif; line-height: 1.9; color: #1a1a2e;">

  <div style="text-align:center; margin-bottom: 2.5rem;">
    <div style="font-size: 2rem; color: #c9a96e; margin-bottom: 0.5rem;">✦</div>
    <h2 style="font-family: 'Playfair Display', Georgia, serif; font-size: 1.8rem; color: #c9a96e; font-weight: 400; letter-spacing: 0.05em;">
      To Chantal
    </h2>
    <p style="font-style: italic; color: #8a7560; font-size: 1rem;">Why this program exists</p>
  </div>

  <p style="font-size: 1.1rem; margin-bottom: 1.5rem;">
    This program is dedicated to a woman.<br>
    A woman named Chantal.
  </p>

  <p style="font-size: 1.05rem; margin-bottom: 1.5rem;">
    She had an immediate smile. White teeth. She breathed life as if it belonged to her — 
    not out of arrogance, but out of quiet certainty. She knew who she was, where she came from, 
    what she loved. She lived from her values rather than her fears.
  </p>

  <p style="font-size: 1.05rem; margin-bottom: 1.5rem;">
    She chose the right father for her children.<br>
    It was not the easiest choice.<br>
    There were resistances around her — people who didn't welcome that choice.<br>
    She could have let herself be discouraged. Chosen differently. Protected herself.<br>
    She didn't.
  </p>

  <p style="font-size: 1.05rem; margin-bottom: 1.5rem;">
    She looked beyond what she was going through.<br>
    Beyond herself.<br>
    Toward what her children would need… after her.
  </p>

  <p style="font-size: 1.05rem; margin-bottom: 1.8rem;">
    And some of the people who seemed so far from her back then…<br>
    are now the ones who cherish her children the most.<br>
    Who watch over them. Who hold them.<br>
    <strong>Chantal had seen clearly. At forty years old.</strong>
  </p>

  <p style="font-size: 1.05rem; margin-bottom: 1.5rem;">
    When she left, she didn't leave a void behind her.<br>
    She left jewels.<br>
    Her children — beings shaped by a woman who knew that what you sow today 
    grows long after you are gone.
  </p>

  <hr style="border: none; border-top: 1px solid #c9a96e; margin: 2rem auto; width: 60%;">

  <p style="font-size: 1.05rem; margin-bottom: 1.5rem;">
    We had known each other since middle school.<br>
    Chantal was my sister's best friend.<br>
    We crossed paths often in those years, in the same city.<br>
    Then I left for Belgium. Life went on. The ordinary silence.
  </p>

  <p style="font-size: 1.05rem; margin-bottom: 1.5rem;">
    The last time I had Chantal on the phone…<br>
    it had been years since we had really talked.<br>
    She had found me on social media. She no longer had my number.
  </p>

  <p style="font-size: 1.05rem; margin-bottom: 1.5rem;">
    It wasn't a call about her.<br>
    It wasn't to tell me she was sick.<br>
    It was for someone she loved —<br>
    someone who was going through something very hard,<br>
    someone who needed someone to be there.
  </p>

  <p style="font-size: 1.05rem; margin-bottom: 1.5rem;">
    She already had her cancer. I didn't know. She didn't tell me.<br>
    She was carrying that — and her first instinct was still others.<br>
    Always.
  </p>

  <p style="font-size: 1.05rem; margin-bottom: 1.5rem;">
    She was there for her…<br>
    when I wasn't.<br><br>
    And during that same time, I was accompanying a friend in the same city who was fighting breast cancer.<br>
    I was living right alongside Chantal without knowing it.
  </p>

  <hr style="border: none; border-top: 1px solid #c9a96e; margin: 2rem auto; width: 60%;">

  <p style="font-size: 1.1rem; font-style: italic; color: #5a4a3a; margin-bottom: 1.5rem;">
    Chantal, you woke me up.<br>
    Not through your death — but through who you were.<br>
    Through the way you chose to live,<br>
    even when it was hard.<br>
    Even when no one was watching.<br>
    Even when you were carrying something you didn't tell me.
  </p>

  <p style="font-size: 1.05rem; margin-bottom: 1.5rem;">
    This program is for everyone who wonders,<br>
    somewhere quiet inside themselves:<br>
    <em>Am I really living?</em><br>
    Or am I letting my life pass by, waiting for something?
  </p>

  <p style="text-align:center; font-size: 1.2rem; color: #c9a96e; font-style: italic; margin-top: 2rem;">
    Life has no age.<br>
    But it has a duration.
  </p>

</div>
HTML;

// Trouver le module 0
$mod = DB::table('formation_modules')->where('slug', '00-prologue-la-vie-na-pas-dage')->first();
if (!$mod) {
    echo "❌ Module 0 non trouvé\n";
    exit(1);
}
echo "✅ Module trouvé : ID={$mod->id}\n";

// Charger les activités existantes
$acts_fr = json_decode($mod->activities, true);
$acts_en = json_decode($mod->activities_en, true);

// Mettre à jour l'activité 1 (index 0)
$acts_fr[0]['title']   = 'À Chantal — Pourquoi ce parcours existe';
$acts_fr[0]['content'] = $activity1FR;
$acts_en[0]['title']   = 'To Chantal — Why this program exists';
$acts_en[0]['content'] = $activity1EN;

DB::table('formation_modules')
    ->where('id', $mod->id)
    ->update([
        'activities'    => json_encode($acts_fr, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES),
        'activities_en' => json_encode($acts_en, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES),
        'updated_at'    => now(),
    ]);

echo "✅ Module 0 mis à jour (ID: {$mod->id})\n";
echo "✅ Version v3 — belle-mère et dernier appel reformulés (FR + EN)\n";
echo "   Préserve : sagesse Chantal, son choix, les personnes qui chérissent les enfants\n";
echo "   Protège  : la sœur, Julien\n";
