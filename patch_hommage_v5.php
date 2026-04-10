<?php
require_once __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();
use Illuminate\Support\Facades\DB;

$mod = DB::table('formation_modules')->where('slug', '00-prologue-la-vie-na-pas-dage')->first();
if (!$mod) { echo "❌ Module 0 non trouvé\n"; exit(1); }

$acts_fr = json_decode($mod->activities, true);
$acts_en = json_decode($mod->activities_en, true);

$acts_fr[0]['title']   = 'À Chantal — Pourquoi ce parcours existe';
$acts_fr[0]['content'] = <<<'HTML'
<div class="activity-content hommage-chantal" style="font-family: Georgia, serif; line-height: 1.9; color: #e8ddd0;">

  <div style="text-align:center; margin-bottom: 2.5rem;">
    <div style="font-size: 2rem; color: #c9a96e; margin-bottom: 0.5rem;">✦</div>
    <h2 style="font-family: 'Playfair Display', Georgia, serif; font-size: 1.8rem; color: #c9a96e; font-weight: 400; letter-spacing: 0.05em;">À Chantal</h2>
    <p style="font-style: italic; color: #b8a898; font-size: 1rem;">Pourquoi ce parcours existe</p>
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
    Elle avait construit quelque chose de vrai.<br>
    Une famille. Un foyer. Des liens solides.<br>
    Ses enfants sont entourés aujourd'hui.<br>
    Aimés. Portés.<br>
    C'est le fruit de ce qu'elle avait semé.
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

  <p style="font-size: 1.05rem; margin-bottom: 1.8rem;">
    Durant toutes ces années où j'étais partie…<br>
    ma sœur a traversé des périodes difficiles.<br>
    Et Chantal était là pour elle. Sa meilleure amie. Présente.<br>
    Quand moi j'étais loin.
  </p>

  <p style="font-size: 1.05rem; margin-bottom: 1.5rem;">
    Je lui suis tellement reconnaissante pour ça.<br><br>
    Elle a semé dans la vie de ma sœur.<br>
    Et aujourd'hui, je veux être pour ses enfants<br>
    ce qu'elle a été pour elle.
  </p>

  <hr style="border: none; border-top: 1px solid #c9a96e; margin: 2rem auto; width: 60%;">

  <p style="font-size: 1.1rem; font-style: italic; color: #c4b49a; margin-bottom: 1.5rem;">
    Chantal, tu m'as réveillée.<br>
    Pas par ta mort — par qui tu étais.<br>
    Par la façon dont tu as choisi de vivre,<br>
    même quand ce n'était pas facile.<br>
    Même quand personne ne regardait.<br>
    Même quand tu portais quelque chose que tu ne m'as pas dit.
  </p>

  <p style="font-size: 1.05rem; margin-bottom: 1.5rem;">
    Je me suis rendu compte à quel point je vivais à côté.<br>
    À côté de ce qui comptait vraiment.<br>
    Avec mes enfants — là, mais sans être vraiment là.<br>
    Avec ma sœur — présente, mais pas assez.<br>
    Avec mes amis — en contact, mais sans prendre vraiment le temps.<br>
    Avec mes rêves — en mouvement, mais avec l'impression de faire du surplace.<br>
    À côté de moi-même.
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

$acts_en[0]['title']   = 'To Chantal — Why this program exists';
$acts_en[0]['content'] = <<<'HTML'
<div class="activity-content hommage-chantal" style="font-family: Georgia, serif; line-height: 1.9; color: #e8ddd0;">

  <div style="text-align:center; margin-bottom: 2.5rem;">
    <div style="font-size: 2rem; color: #c9a96e; margin-bottom: 0.5rem;">✦</div>
    <h2 style="font-family: 'Playfair Display', Georgia, serif; font-size: 1.8rem; color: #c9a96e; font-weight: 400; letter-spacing: 0.05em;">To Chantal</h2>
    <p style="font-style: italic; color: #b8a898; font-size: 1rem;">Why this program exists</p>
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
    She had built something real.<br>
    A family. A home. Solid bonds.<br>
    Her children are surrounded today.<br>
    Loved. Held.<br>
    This is the fruit of what she had sown.
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

  <p style="font-size: 1.05rem; margin-bottom: 1.8rem;">
    During all those years I had been away…<br>
    my sister went through difficult periods.<br>
    And Chantal was there for her. Her best friend. Present.<br>
    When I was far away.
  </p>

  <p style="font-size: 1.05rem; margin-bottom: 1.5rem;">
    I am so grateful to her for that.<br><br>
    She sowed something in my sister's life.<br>
    And today, I want to be for her children<br>
    what she was for her.
  </p>

  <hr style="border: none; border-top: 1px solid #c9a96e; margin: 2rem auto; width: 60%;">

  <p style="font-size: 1.1rem; font-style: italic; color: #c4b49a; margin-bottom: 1.5rem;">
    Chantal, you woke me up.<br>
    Not through your death — but through who you were.<br>
    Through the way you chose to live,<br>
    even when it was hard.<br>
    Even when no one was watching.<br>
    Even when you were carrying something you didn't tell me.
  </p>

  <p style="font-size: 1.05rem; margin-bottom: 1.5rem;">
    I realized how much I had been living alongside my own life.<br>
    Alongside what truly mattered.<br>
    With my children — present, but not really there.<br>
    With my sister — there, but not enough.<br>
    With my friends — in touch, but without really taking the time.<br>
    With my dreams — moving, but feeling like I was going nowhere.<br>
    Alongside myself.
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

DB::table('formation_modules')
    ->where('id', $mod->id)
    ->update([
        'activities'    => json_encode($acts_fr, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES),
        'activities_en' => json_encode($acts_en, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES),
        'updated_at'    => now(),
    ]);

echo "✅ Module 0 mis à jour (ID: {$mod->id})\n";
echo "✅ v5 — 'construit quelque chose de vrai' + suppression amie cancer (FR + EN)\n";
