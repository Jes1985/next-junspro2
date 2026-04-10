<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

// ════════════════════════════════════════════════════════════════════════════
//  HOMMAGE À CHANTAL — mise à jour de l'activité d'ouverture du Module 0
// ════════════════════════════════════════════════════════════════════════════

$c0 = 'rgba(201,168,76,.9)';
$c_or   = '#C9A84C';
$c_rose = 'rgba(251,191,36,.85)';

// ─── CONTENU HTML ────────────────────────────────────────────────────────────

$hommage_fr = '<div style="border-left:3px solid '.$c0.';padding:.85rem 1.25rem;margin-bottom:.8rem;background:rgba(0,0,0,.15);border-radius:0 10px 10px 0;">'

// ── Titre ──
.'<h4 style="color:#fff;font-size:.87rem;font-weight:700;margin:0 0 .5rem;display:flex;align-items:center;gap:.6rem;">'
.'<span style="font-size:.68rem;color:'.$c0.';background:rgba(0,0,0,.35);border:1px solid '.$c0.';border-radius:6px;padding:.1rem .4rem;flex-shrink:0;">Prologue · Avant tout le reste</span>'
.'Pourquoi ce parcours existe — À Chantal'
.'</h4>'

.'<div style="font-size:.8rem;color:rgba(232,224,208,.82);line-height:2;">'

// ── Dédicace dorée ──
.'<div style="text-align:center;margin:1.2rem 0 1.8rem;">'
.'<span style="font-size:1.05rem;font-weight:800;letter-spacing:.08em;color:'.$c_or.';">À CHANTAL</span><br>'
.'<span style="font-size:.75rem;color:rgba(201,168,76,.65);letter-spacing:.12em;text-transform:uppercase;">1975 — 2015 · lumière, amie, mère</span>'
.'</div>'

// ── Intro ──
.'<div style="font-size:.9rem;line-height:2.1;color:rgba(232,224,208,.95);margin-bottom:1.4rem;">'
.'Elle s\'appelait Chantal.<br><br>'
.'Quarante ans. Une vie simple. Une vie <em>vraie</em>.<br><br>'
.'Elle souriait d\'une façon qui rendait les pièces plus lumineuses. '
.'Elle avait ces yeux qui vous regardaient vraiment — pas à travers vous, pas en vous évaluant — '
.'qui vous regardaient, <em>vous</em>, tel que vous étiez. '
.'Et ce sourire avec ces belles dents blanches — pas un sourire de façade, '
.'un sourire qui disait : <strong style="color:#fff;">je suis là, je suis vivante, et c\'est suffisant.</strong><br><br>'
.'Elle respirait la vie. Pas la <em>performance</em> de la vie. La vie elle-même.'
.'</div>'

// ── Bloc sagesse ──
.'<div style="background:rgba(201,168,76,.07);border:1px solid rgba(201,168,76,.2);border-radius:12px;padding:1.1rem 1.3rem;margin-bottom:1.4rem;">'
.'<div style="font-size:.77rem;font-weight:700;color:'.$c_or.';letter-spacing:.1em;text-transform:uppercase;margin-bottom:.7rem;">Ce qu\'elle avait compris</div>'
.'Elle n\'avait pas les grands diplômes. Pas la carrière impressionnante. '
.'Pas les signes extérieurs que notre époque confond avec la réussite.<br>'
.'Elle avait quelque chose de plus rare.<br><br>'
.'<strong style="color:#fff;">Elle savait qui elle était.</strong><br><br>'
.'Et parce qu\'elle savait qui elle était, elle vivait <em>depuis</em> cet endroit. '
.'Pas depuis la peur du regard des autres. Pas depuis le besoin de prouver quelque chose. '
.'Depuis elle-même. Depuis ses valeurs. Depuis ce qui comptait vraiment.<br><br>'
.'En quarante ans, Chantal a vécu plus authentiquement que beaucoup ne le feront en quatre-vingts. '
.'Elle avait réalisé ce que certains mettent une vie entière à effleurer :<br><br>'
.'<em style="color:'.$c_or.';">la vie la plus précieuse n\'est pas dans le paraître, pas dans les diplômes, '
.'pas dans les certifications de réussite que la société distribue — elle est dans la simplicité. '
.'Dans le fait de savoir ce qu\'on aime, qui on aime, pourquoi on vit — et d\'agir depuis cet endroit.</em>'
.'</div>'

// ── Les bijoux ──
.'<div style="margin-bottom:1.4rem;">'
.'<strong style="color:#fff;">Elle avait fait les choix que peu de gens font.</strong><br>'
.'Pas les choix faciles. Les choix <em>justes</em>.<br><br>'
.'Elle avait choisi le bon père pour ses enfants. La bonne famille. Les bonnes fondations. '
.'Pas le plus séduisant. Pas le plus impressionnant. Le <em>bon</em> — celui qui serait là, '
.'celui en qui elle pouvait avoir confiance pour continuer ce qu\'elle avait commencé.<br><br>'
.'Quand elle est partie, elle n\'a pas laissé un vide derrière elle.<br>'
.'<strong style="color:'.$c_or.';">Elle a laissé des bijoux.</strong><br><br>'
.'Ses enfants. Des êtres façonnés par une femme qui savait que ce qu\'on sème aujourd\'hui '
.'pousse longtemps après qu\'on soit parti.'
.'</div>'

// ── Paradoxe ──
.'<div style="background:rgba(0,0,0,.2);border-left:3px solid rgba(251,191,36,.6);padding:.9rem 1.1rem;border-radius:0 10px 10px 0;margin-bottom:1.4rem;">'
.'<div style="font-size:.77rem;font-weight:700;color:rgba(251,191,36,.85);letter-spacing:.1em;text-transform:uppercase;margin-bottom:.6rem;">Le paradoxe douloureux</div>'
.'Quand tu étais là, Chantal, pris comme je l\'étais dans les aléas de la vie, '
.'je ne pensais pas assez à toi. La vie allait. Les journées se remplissaient. '
.'Les urgences de l\'ordinaire prenaient toute la place. '
.'Et toi, tu étais là — souriante, lumineuse, présente — '
.'et je ne mesurais pas ce que tu représentais vraiment.<br><br>'
.'Maintenant que tu n\'es plus là... je pense souvent à toi.<br><br>'
.'<em style="color:rgba(232,224,208,.72);">C\'est une des vérités les plus amères que la perte nous enseigne : '
.'on réalise la valeur de ce qu\'on avait... quand on ne l\'a plus.</em>'
.'</div>'

// ── Le réveil ──
.'<div style="margin-bottom:1.4rem;">'
.'Mais tu m\'as fait quelque chose de plus grand que me faire regretter.<br><br>'
.'<strong style="color:#fff;">Tu m\'as mis face à moi-même.</strong><br><br>'
.'Tu m\'as montré, sans le vouloir, que nous avions presque le même âge — '
.'et que si c\'était moi qui partais demain, les choix que tu avais su faire, '
.'les choix de sagesse, les choix pour tes enfants, '
.'les choix d\'être <em>vraiment présent</em> à ta vie — je ne les avais pas faits.<br><br>'
.'J\'étais en train de vivre à côté de mes enfants. À côté de mes rêves. '
.'À côté de mes amis. À côté de moi-même.<br><br>'
.'<strong style="color:'.$c_or.';">Tu m\'as réveillé.</strong><br><br>'
.'Et pour ça, je ne sais pas comment te remercier autrement qu\'en faisant de cette leçon quelque chose de vivant — '
.'en la transmettant, en en faisant ce parcours.'
.'</div>'

// ── Hommage final ──
.'<div style="background:linear-gradient(135deg,rgba(201,168,76,.1) 0%,rgba(0,0,0,.25) 100%);border:1px solid rgba(201,168,76,.25);border-radius:14px;padding:1.3rem 1.5rem;margin-bottom:1.2rem;text-align:center;">'
.'<div style="font-size:.8rem;color:rgba(232,224,208,.95);line-height:2.2;font-style:italic;">'
.'Ce parcours existe parce que tu as existé.<br><br>'
.'Chaque personne qui le traversera, chaque vie qui changera,<br>'
.'chaque enfant qui sera plus aimé, chaque rêve enfin commencé —<br>'
.'<strong style="color:'.$c_or.';font-style:normal;">c\'est ta lumière qui continue.</strong>'
.'</div>'
.'</div>'

.'<div style="font-size:.8rem;color:rgba(232,224,208,.75);line-height:2.1;margin-bottom:1rem;">'
.'Merci d\'avoir été simple dans un monde qui glorifie le compliqué.<br>'
.'Merci d\'avoir été vraie dans un monde qui récompense le paraître.<br>'
.'Merci d\'avoir été humble parce que tu connaissais ta valeur — '
.'et que celui qui connaît vraiment sa valeur n\'a plus besoin de la prouver.<br><br>'
.'Tu étais le soleil. Pas un soleil qui brille pour qu\'on le remarque. '
.'Le genre de soleil qui chauffe simplement parce que c\'est sa nature.<br><br>'
.'<strong style="color:#fff;">Merci, Chantal — lumière, amie, mère, compagne.</strong><br>'
.'Que nous puissions nous retrouver.<br><br>'
.'<em style="color:'.$c_or.';">Je t\'aime.</em>'
.'</div>'

.'</div>'
.'</div>';

// ─── VERSION EN ──────────────────────────────────────────────────────────────

$hommage_en = '<div style="border-left:3px solid rgba(201,168,76,.9);padding:.85rem 1.25rem;margin-bottom:.8rem;background:rgba(0,0,0,.15);border-radius:0 10px 10px 0;">'
.'<h4 style="color:#fff;font-size:.87rem;font-weight:700;margin:0 0 .5rem;display:flex;align-items:center;gap:.6rem;">'
.'<span style="font-size:.68rem;color:rgba(201,168,76,.9);background:rgba(0,0,0,.35);border:1px solid rgba(201,168,76,.9);border-radius:6px;padding:.1rem .4rem;flex-shrink:0;">Prologue · Before everything else</span>'
.'Why this program exists — To Chantal'
.'</h4>'
.'<div style="font-size:.8rem;color:rgba(232,224,208,.82);line-height:2;">'

.'<div style="text-align:center;margin:1.2rem 0 1.8rem;">'
.'<span style="font-size:1.05rem;font-weight:800;letter-spacing:.08em;color:#C9A84C;">TO CHANTAL</span><br>'
.'<span style="font-size:.75rem;color:rgba(201,168,76,.65);letter-spacing:.12em;text-transform:uppercase;">1975 — 2015 · light, friend, mother</span>'
.'</div>'

.'<div style="font-size:.9rem;line-height:2.1;color:rgba(232,224,208,.95);margin-bottom:1.4rem;">'
.'Her name was Chantal.<br><br>'
.'Forty years old. A simple life. A <em>real</em> life.<br><br>'
.'She smiled in a way that made rooms brighter. '
.'She had the kind of eyes that looked at you <em>truly</em> — not through you, not evaluating you — '
.'that looked at you, as you were. '
.'And that smile with those beautiful white teeth — not a performance of a smile, '
.'a smile that said: <strong style="color:#fff;">I am here, I am alive, and that is enough.</strong><br><br>'
.'She breathed life. Not the <em>performance</em> of life. Life itself.'
.'</div>'

.'<div style="background:rgba(201,168,76,.07);border:1px solid rgba(201,168,76,.2);border-radius:12px;padding:1.1rem 1.3rem;margin-bottom:1.4rem;">'
.'<div style="font-size:.77rem;font-weight:700;color:#C9A84C;letter-spacing:.1em;text-transform:uppercase;margin-bottom:.7rem;">What she had understood</div>'
.'She didn\'t have the impressive degrees. Not the high-profile career. '
.'Not the external markers that our era tends to confuse with success.<br>'
.'She had something rarer.<br><br>'
.'<strong style="color:#fff;">She knew who she was.</strong><br><br>'
.'And because she knew who she was, she lived <em>from</em> that place. '
.'Not from the fear of others\' judgment. Not from the need to prove anything. '
.'From herself. From her values. From what truly mattered.<br><br>'
.'In forty years, Chantal lived more authentically than many will in eighty. '
.'She had realized what some spend a whole lifetime barely touching:<br><br>'
.'<em style="color:#C9A84C;">the most precious life is not in appearances, not in diplomas, '
.'not in the success certificates that society hands out — it is in simplicity. '
.'In knowing what you love, who you love, why you live — and acting from that place.</em>'
.'</div>'

.'<div style="margin-bottom:1.4rem;">'
.'<strong style="color:#fff;">She had made the choices that few people make.</strong><br>'
.'Not the easy choices. The <em>right</em> ones.<br><br>'
.'She chose the right father for her children. The right family. The right foundations. '
.'Not the most charming. Not the most impressive. The <em>right one</em> — the one who would be there, '
.'the one she could trust to carry on what she had started.<br><br>'
.'When she left, she did not leave a void behind her.<br>'
.'<strong style="color:#C9A84C;">She left jewels.</strong><br><br>'
.'Her children. Beings shaped by a woman who knew that what you sow today '
.'grows long after you are gone.'
.'</div>'

.'<div style="background:rgba(0,0,0,.2);border-left:3px solid rgba(251,191,36,.6);padding:.9rem 1.1rem;border-radius:0 10px 10px 0;margin-bottom:1.4rem;">'
.'<div style="font-size:.77rem;font-weight:700;color:rgba(251,191,36,.85);letter-spacing:.1em;text-transform:uppercase;margin-bottom:.6rem;">The painful paradox</div>'
.'When you were here, Chantal, caught as I was in the current of daily life, '
.'I didn\'t think of you enough. Life moved forward. Days filled up. '
.'The small urgencies of the ordinary took up all the space. '
.'And you were there — smiling, luminous, present — '
.'and I didn\'t measure what you truly meant to me.<br><br>'
.'Now that you are no longer here... I think of you often.<br><br>'
.'<em style="color:rgba(232,224,208,.72);">It is one of the bitterest truths that loss teaches us: '
.'we realize the value of what we had... when we no longer have it.</em>'
.'</div>'

.'<div style="margin-bottom:1.4rem;">'
.'But you did something greater for me than make me regret.<br><br>'
.'<strong style="color:#fff;">You held a mirror up to me.</strong><br><br>'
.'You showed me, without intending to, that we were almost the same age — '
.'and that if it were me leaving tomorrow, the wise choices you had made, '
.'the choices for your children, the choices to be <em>truly present</em> to your life — '
.'I had not made them.<br><br>'
.'I was living alongside my children. Alongside my dreams. '
.'Alongside my friends. Alongside myself.<br><br>'
.'<strong style="color:#C9A84C;">You woke me up.</strong><br><br>'
.'And for that, I know no better way to thank you than to make that lesson something living — '
.'to pass it on, to make it into this program.'
.'</div>'

.'<div style="background:linear-gradient(135deg,rgba(201,168,76,.1) 0%,rgba(0,0,0,.25) 100%);border:1px solid rgba(201,168,76,.25);border-radius:14px;padding:1.3rem 1.5rem;margin-bottom:1.2rem;text-align:center;">'
.'<div style="font-size:.8rem;color:rgba(232,224,208,.95);line-height:2.2;font-style:italic;">'
.'This program exists because you existed.<br><br>'
.'Every person who moves through it, every life that changes,<br>'
.'every child who is loved more, every dream finally begun —<br>'
.'<strong style="color:#C9A84C;font-style:normal;">that is your light, still shining.</strong>'
.'</div>'
.'</div>'

.'<div style="font-size:.8rem;color:rgba(232,224,208,.75);line-height:2.1;margin-bottom:1rem;">'
.'Thank you for being simple in a world that glorifies complexity.<br>'
.'Thank you for being real in a world that rewards performance.<br>'
.'Thank you for being humble because you knew your worth — '
.'and the one who truly knows their worth no longer needs to prove it.<br><br>'
.'You were the sun. Not the kind of sun that shines to be noticed. '
.'The kind that simply warms because that is its nature.<br><br>'
.'<strong style="color:#fff;">Thank you, Chantal — light, friend, mother, companion.</strong><br>'
.'May we one day find each other again.<br><br>'
.'<em style="color:#C9A84C;">I love you.</em>'
.'</div>'

.'</div>'
.'</div>';

// ─── MISE À JOUR EN BASE ────────────────────────────────────────────────────

$mod = DB::table('formation_modules')
    ->where('slug', '00-prologue-la-vie-na-pas-dage')
    ->where('track', 'parcours')
    ->first();

if (!$mod) {
    die("❌ Module 0 introuvable. Vérifiez le slug.\n");
}

$acts_fr = json_decode($mod->activities, true);
$acts_en = json_decode($mod->activities_en, true);

// Remplacer la première activité (ouverture) par l'hommage à Chantal
$acts_fr[0]['title']   = 'À Chantal — Pourquoi ce parcours existe';
$acts_fr[0]['content'] = $hommage_fr;
$acts_fr[0]['description'] = 'L\'histoire de Chantal — amie, mère, lumière — disparue à 40 ans. '
    .'L\'élément déclencheur de tout ce parcours. La femme qui a compris en 40 ans ce que certains mettent 80 ans à réaliser : '
    .'que la vie authentique est dans la simplicité, la présence, les bons choix — pas dans le paraître.';

$acts_en[0]['title']   = 'To Chantal — Why this program exists';
$acts_en[0]['content'] = $hommage_en;
$acts_en[0]['description'] = 'The story of Chantal — friend, mother, light — who left at 40. '
    .'The founding element of this entire program. The woman who understood in 40 years what some take 80 to realize: '
    .'that authentic life is in simplicity, presence, and right choices — not in appearances.';

// Mise à jour du intro_text pour inclure une référence à Chantal
$intro_fr = "Ce parcours est dédié à Chantal.\n\n"
    ."Une femme qui a compris en quarante ans ce que certains mettent toute une vie à effleurer.\n"
    ."Sa disparition a tout changé.\n"
    ."Pas de tristesse — de clarté.\n\n"
    ."Ce module est son hommage.\n"
    ."Et votre point de départ.";

$intro_en = "This program is dedicated to Chantal.\n\n"
    ."A woman who understood in forty years what some take a whole life to touch.\n"
    ."Her departure changed everything.\n"
    ."Not into grief — into clarity.\n\n"
    ."This module is her tribute.\n"
    ."And your starting point.";

DB::table('formation_modules')
    ->where('id', $mod->id)
    ->update([
        'activities'    => json_encode($acts_fr, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES),
        'activities_en' => json_encode($acts_en, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES),
        'intro_text'    => $intro_fr,
        'intro_text_en' => $intro_en,
        'updated_at'    => now(),
    ]);

echo "✅ Hommage à Chantal intégré dans le Module 0 (ID: {$mod->id})\n";
echo "✅ Activité 1 FR mise à jour\n";
echo "✅ Activité 1 EN mise à jour\n";
echo "✅ intro_text FR + EN mis à jour\n";
