<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

$c0 = 'rgba(201,168,76,.9)';
$c_or = '#C9A84C';

$mod = DB::table('formation_modules')
    ->where('slug', '00-prologue-la-vie-na-pas-dage')
    ->where('track', 'parcours')
    ->first();

if (!$mod) { die("❌ Module 0 introuvable.\n"); }

$acts_fr = json_decode($mod->activities, true);
$acts_en = json_decode($mod->activities_en, true);

// ─── BLOC "BIJOUX" FR ───────────────────────────────────────────────────────
$bijoux_fr = '<div style="margin-bottom:1.4rem;">'
.'<strong style="color:#fff;">Elle avait fait les choix que peu de gens font.</strong><br>'
.'Pas les choix faciles. Les choix <em>justes</em>.<br><br>'
.'Elle avait choisi le bon père pour ses enfants.<br>'
.'Ce n\'était pas le choix le plus simple.<br><br>'
.'Sa belle-mère n\'était pas tendre avec elle. '
.'Elle aurait pu laisser cette blessure guider sa décision — se protéger, choisir différemment. '
.'Elle ne l\'a pas fait.<br><br>'
.'Elle a regardé au-delà de ce qu\'elle subissait. '
.'Au-delà d\'elle-même. '
.'Vers ce dont ses enfants auraient besoin... après elle.<br><br>'
.'Et aujourd\'hui, cette belle-mère qui n\'était pas simple avec elle... '
.'est l\'une des personnes qui chérit ses enfants, qui veille sur eux, qui les porte.<br><br>'
.'<strong style="color:'.$c_or.';">Chantal avait vu juste. À quarante ans. '
.'Avec une sagesse que peu de gens atteignent en toute une vie.</strong><br><br>'
.'Quand elle est partie, elle n\'a pas laissé un vide derrière elle.<br>'
.'<strong style="color:'.$c_or.';">Elle a laissé des bijoux.</strong><br><br>'
.'Ses enfants. Des êtres façonnés par une femme qui savait que ce qu\'on sème aujourd\'hui '
.'pousse longtemps après qu\'on soit parti.'
.'</div>';

// ─── BLOC "PARADOXE + DERNIER APPEL" FR ────────────────────────────────────
$paradoxe_fr = '<div style="background:rgba(0,0,0,.2);border-left:3px solid rgba(251,191,36,.6);padding:.9rem 1.1rem;border-radius:0 10px 10px 0;margin-bottom:1.4rem;">'
.'<div style="font-size:.77rem;font-weight:700;color:rgba(251,191,36,.85);letter-spacing:.1em;text-transform:uppercase;margin-bottom:.6rem;">Le paradoxe douloureux — et le dernier appel</div>'
.'Nous nous connaissions depuis le collège. '
.'Chantal était la meilleure amie de ma sœur. '
.'On s\'est beaucoup côtoyées au lycée, dans la même ville. '
.'Puis je suis partie en Belgique. '
.'On s\'est vues brièvement après la naissance de mon fils. '
.'Quelques nouvelles sur les réseaux. '
.'Et puis le silence ordinaire qui s\'installe — celui qu\'on croit toujours temporaire, celui qui dure.<br><br>'
.'La dernière fois que j\'ai eu Chantal au téléphone... cela faisait des années qu\'on ne s\'était pas vraiment parlé. '
.'Elle m\'avait retrouvée sur les réseaux sociaux. Elle n\'avait plus mon numéro.<br><br>'
.'<strong style="color:#fff;">Ce n\'était pas un appel pour elle.</strong><br>'
.'Ce n\'était pas pour me dire qu\'elle était malade.<br>'
.'C\'était pour me prévenir que ma sœur avait fait une tentative de suicide.<br><br>'
.'Elle avait déjà son cancer. Je ne le savais pas. Elle ne me l\'a pas dit.<br><br>'
.'Elle portait ça — et son premier réflexe, c\'était les autres. Ma sœur. Nous.<br><br>'
.'<strong style="color:'.$c_or.';">Elle était là pour ma sœur... quand moi je ne l\'étais pas.</strong><br><br>'
.'Et pendant ce temps-là, j\'accompagnais dans la même ville une amie qui traversait un cancer du sein. '
.'Je vivais à côté de Chantal sans le savoir. À côté de ce qu\'elle traversait. '
.'À côté de tout ce qu\'elle représentait pour moi.<br><br>'
.'<em style="color:rgba(232,224,208,.72);">C\'est une des vérités les plus amères que la perte nous enseigne : '
.'on réalise la valeur de ce qu\'on avait quand on ne l\'a plus.</em>'
.'</div>';

// ─── BIJOUX EN ─────────────────────────────────────────────────────────────
$bijoux_en = '<div style="margin-bottom:1.4rem;">'
.'<strong style="color:#fff;">She had made the choices that few people make.</strong><br>'
.'Not the easy choices. The <em>right</em> ones.<br><br>'
.'She chose the right father for her children.<br>'
.'It was not the easiest choice.<br><br>'
.'His mother was not kind to her. '
.'She could have let that wound guide her decision — protected herself, chosen differently. '
.'She didn\'t.<br><br>'
.'She looked beyond what she was enduring. '
.'Beyond herself. '
.'Toward what her children would need... after her.<br><br>'
.'And today, that mother-in-law who was not kind to her... '
.'is one of the people who cherishes her children, who watches over them, who holds them.<br><br>'
.'<strong style="color:#C9A84C;">Chantal had seen clearly. At forty years old. '
.'With a wisdom that few people reach in a whole lifetime.</strong><br><br>'
.'When she left, she did not leave a void behind her.<br>'
.'<strong style="color:#C9A84C;">She left jewels.</strong><br><br>'
.'Her children. Beings shaped by a woman who knew that what you sow today '
.'grows long after you are gone.'
.'</div>';

// ─── PARADOXE EN ───────────────────────────────────────────────────────────
$paradoxe_en = '<div style="background:rgba(0,0,0,.2);border-left:3px solid rgba(251,191,36,.6);padding:.9rem 1.1rem;border-radius:0 10px 10px 0;margin-bottom:1.4rem;">'
.'<div style="font-size:.77rem;font-weight:700;color:rgba(251,191,36,.85);letter-spacing:.1em;text-transform:uppercase;margin-bottom:.6rem;">The painful paradox — and the last call</div>'
.'We had known each other since middle school. '
.'Chantal was my sister\'s best friend. '
.'We spent a lot of time together in high school, in the same city. '
.'Then I moved to Belgium. '
.'We saw each other briefly after my son was born. '
.'A few exchanges on social media. '
.'And then the ordinary silence that sets in — the kind you always think is temporary, the kind that lasts.<br><br>'
.'The last time I had Chantal on the phone... it had been years since we\'d truly talked. '
.'She had found me on social media. She no longer had my number.<br><br>'
.'<strong style="color:#fff;">It wasn\'t a call about her.</strong><br>'
.'It wasn\'t to tell me she was sick.<br>'
.'It was to warn me that my sister had attempted suicide.<br><br>'
.'She already had her cancer. I didn\'t know. She didn\'t tell me.<br><br>'
.'She was carrying that — and her first instinct was still others. My sister. Us.<br><br>'
.'<strong style="color:#C9A84C;">She was there for my sister... when I wasn\'t.</strong><br><br>'
.'And during that same time, I was accompanying a friend in the same city who was fighting breast cancer. '
.'I was living alongside Chantal without knowing it. Alongside what she was going through. '
.'Alongside everything she meant to me.<br><br>'
.'<em style="color:rgba(232,224,208,.72);">It is one of the bitterest truths that loss teaches us: '
.'we realize the value of what we had when we no longer have it.</em>'
.'</div>';

// ─── INJECTION DANS LE HTML DE L'ACTIVITÉ 1 ─────────────────────────────────

// FR — on remplace les deux blocs dans le contenu existant
$html_fr = $acts_fr[0]['content'];

// Remplacer bloc bijoux (père "pas le plus séduisant" → belle-mère)
$html_fr = preg_replace(
    '/<div[^>]*>.*?Elle avait choisi le bon père.*?pousse longtemps après qu.*?parti\.<\/div>/s',
    $bijoux_fr,
    $html_fr,
    1
);

// Remplacer bloc paradoxe
$html_fr = preg_replace(
    '/<div[^>]*>.*?paradoxe.*?quand on ne l\'a plus\..*?<\/div>/s',
    $paradoxe_fr,
    $html_fr,
    1
);

// Si les regex n'ont rien trouvé (contenu trop imbriqué), on reconstruit le bloc entier
if (!str_contains($html_fr, 'n\'était pas tendre')) {
    // Recherche/remplacement sur une phrase-clé unique
    $old_bijoux = 'Elle avait fait les choix que peu de gens font.<br>'
        .'<br>Pas les choix faciles. Les choix <em>justes</em>.<br><br>'
        .'Elle avait choisi le bon père pour ses enfants. '
        .'Pas le plus séduisant. Pas le plus impressionnant. Le <em>bon</em>';
    if (str_contains($html_fr, 'Pas le plus séduisant')) {
        // remplacement simple sur la phrase clé
        $html_fr = str_replace(
            '<strong style="color:#fff;">Elle avait fait les choix que peu de gens font.</strong><br>'
            .'Pas les choix faciles. Les choix <em>justes</em>.<br><br>'
            .'Elle avait choisi le bon père pour ses enfants. '
            .'Pas le plus séduisant. Pas le plus impressionnant. Le <em>bon</em> — celui qui serait là, '
            .'celui en qui elle pouvait avoir confiance pour continuer ce qu\'elle avait commencé.<br><br>'
            .'Quand elle est partie, elle n\'a pas laissé un vide derrière elle.<br>'
            .'<strong style="color:'.$c_or.';">Elle a laissé des bijoux.</strong><br><br>'
            .'Ses enfants. Des êtres façonnés par une femme qui savait que ce qu\'on sème aujourd\'hui '
            .'pousse longtemps après qu\'on soit parti.',
            rtrim($bijoux_fr, '</div>'),
            $html_fr
        );
    }
}

// EN
$html_en = $acts_en[0]['content'];

$acts_fr[0]['content'] = $html_fr;
$acts_en[0]['content'] = $html_en; // EN rebuild ci-dessous si nécessaire

// Pour robustesse : on reconstruit complètement les deux activités d'ouverture
// plutôt que de patcher un HTML imbriqué fragile

// ── Fonctions helper (copie légère) ──
function lect2($color, $badge, $title, $body) {
    return '<div style="border-left:3px solid '.$color.';padding:.85rem 1.25rem;margin-bottom:.8rem;background:rgba(0,0,0,.15);border-radius:0 10px 10px 0;">'
          .'<h4 style="color:#fff;font-size:.87rem;font-weight:700;margin:0 0 .5rem;display:flex;align-items:center;gap:.6rem;">'
          .'<span style="font-size:.68rem;color:'.$color.';background:rgba(0,0,0,.35);border:1px solid '.$color.';border-radius:6px;padding:.1rem .4rem;flex-shrink:0;">'.$badge.'</span>'
          .$title.'</h4>'
          .'<div style="font-size:.8rem;color:rgba(232,224,208,.72);line-height:1.85;">'.$body.'</div>'
          .'</div>';
}

$c0 = 'rgba(201,168,76,.9)';
$c_or = '#C9A84C';

// ── HOMMAGE FR complet ──────────────────────────────────────────────────────
$hommage_fr = '<div style="border-left:3px solid '.$c0.';padding:.85rem 1.25rem;margin-bottom:.8rem;background:rgba(0,0,0,.15);border-radius:0 10px 10px 0;">'
.'<h4 style="color:#fff;font-size:.87rem;font-weight:700;margin:0 0 .5rem;display:flex;align-items:center;gap:.6rem;">'
.'<span style="font-size:.68rem;color:'.$c0.';background:rgba(0,0,0,.35);border:1px solid '.$c0.';border-radius:6px;padding:.1rem .4rem;flex-shrink:0;">Prologue · Avant tout le reste</span>'
.'À Chantal — Pourquoi ce parcours existe'
.'</h4>'
.'<div style="font-size:.8rem;color:rgba(232,224,208,.82);line-height:2;">'

// Dédicace
.'<div style="text-align:center;margin:1.2rem 0 1.8rem;">'
.'<span style="font-size:1.05rem;font-weight:800;letter-spacing:.08em;color:'.$c_or.';">À CHANTAL</span><br>'
.'<span style="font-size:.75rem;color:rgba(201,168,76,.65);letter-spacing:.12em;text-transform:uppercase;">lumière · amie · mère · meilleure amie de ma sœur</span>'
.'</div>'

// Intro
.'<div style="font-size:.9rem;line-height:2.1;color:rgba(232,224,208,.95);margin-bottom:1.4rem;">'
.'Elle s\'appelait Chantal.<br><br>'
.'Quarante ans. Une vie simple. Une vie <em>vraie</em>.<br><br>'
.'Elle souriait d\'une façon qui rendait les pièces plus lumineuses. '
.'Elle avait ces yeux qui vous regardaient vraiment — pas à travers vous, pas en vous évaluant. '
.'Et ce sourire avec ces belles dents blanches — pas un sourire de façade, '
.'un sourire qui disait : <strong style="color:#fff;">je suis là, je suis vivante, et c\'est suffisant.</strong><br><br>'
.'Elle respirait la vie. Pas la <em>performance</em> de la vie. La vie elle-même.'
.'</div>'

// Sagesse
.'<div style="background:rgba(201,168,76,.07);border:1px solid rgba(201,168,76,.2);border-radius:12px;padding:1.1rem 1.3rem;margin-bottom:1.4rem;">'
.'<div style="font-size:.77rem;font-weight:700;color:'.$c_or.';letter-spacing:.1em;text-transform:uppercase;margin-bottom:.7rem;">Ce qu\'elle avait compris</div>'
.'Elle n\'avait pas les grands diplômes. Pas la carrière impressionnante. '
.'Pas les signes extérieurs que notre époque confond avec la réussite.<br>'
.'Elle avait quelque chose de plus rare.<br><br>'
.'<strong style="color:#fff;">Elle savait qui elle était.</strong><br><br>'
.'Et parce qu\'elle savait qui elle était, elle vivait <em>depuis</em> cet endroit. '
.'Pas depuis la peur du regard des autres. Pas depuis le besoin de prouver quelque chose. '
.'Depuis ses valeurs. Depuis ce qui comptait vraiment.<br><br>'
.'En quarante ans, Chantal a vécu plus authentiquement que beaucoup ne le feront en quatre-vingts. '
.'Elle avait réalisé ce que certains mettent une vie entière à effleurer :<br><br>'
.'<em style="color:'.$c_or.';">la vie la plus précieuse n\'est pas dans le paraître, pas dans les diplômes — '
.'elle est dans la simplicité. Dans le fait de savoir ce qu\'on aime, qui on aime, pourquoi on vit — et d\'agir depuis cet endroit.</em>'
.'</div>'

// Bijoux + belle-mère
.'<div style="margin-bottom:1.4rem;">'
.'<strong style="color:#fff;">Elle avait fait les choix que peu de gens font.</strong><br>'
.'Pas les choix faciles. Les choix <em>justes</em>.<br><br>'
.'Elle avait choisi le bon père pour ses enfants. Ce n\'était pas le choix le plus simple. '
.'Sa belle-mère n\'était pas tendre avec elle. '
.'Elle aurait pu laisser cette blessure guider son choix — se protéger, choisir différemment.<br>'
.'Elle ne l\'a pas fait.<br><br>'
.'Elle a regardé au-delà de ce qu\'elle subissait. Au-delà d\'elle-même. '
.'Vers ce dont ses enfants auraient besoin... après elle.<br><br>'
.'Et aujourd\'hui, cette belle-mère qui n\'était pas simple avec elle... '
.'est l\'une des personnes qui chérit ses enfants, qui veille sur eux, qui les porte.<br><br>'
.'<strong style="color:'.$c_or.';">Chantal avait vu juste. À quarante ans. '
.'Avec une sagesse que peu de gens atteignent en toute une vie.</strong><br><br>'
.'Quand elle est partie, elle n\'a pas laissé un vide derrière elle.<br>'
.'<strong style="color:'.$c_or.';">Elle a laissé des bijoux.</strong><br><br>'
.'Ses enfants. Des êtres façonnés par une femme qui savait que ce qu\'on sème aujourd\'hui '
.'pousse longtemps après qu\'on soit parti.'
.'</div>'

// Paradoxe + dernier appel
.'<div style="background:rgba(0,0,0,.2);border-left:3px solid rgba(251,191,36,.6);padding:.9rem 1.1rem;border-radius:0 10px 10px 0;margin-bottom:1.4rem;">'
.'<div style="font-size:.77rem;font-weight:700;color:rgba(251,191,36,.85);letter-spacing:.1em;text-transform:uppercase;margin-bottom:.6rem;">Le paradoxe douloureux — et le dernier appel</div>'
.'Nous nous connaissions depuis le collège. Chantal était la meilleure amie de ma sœur. '
.'On s\'est beaucoup côtoyées au lycée, dans la même ville. Puis je suis partie en Belgique. '
.'On s\'est vues brièvement après la naissance de mon fils. Quelques nouvelles sur les réseaux. '
.'Et puis le silence qui s\'installe — celui qu\'on croit temporaire, celui qui dure.<br><br>'
.'La dernière fois que j\'ai eu Chantal au téléphone... cela faisait des années qu\'on ne s\'était pas vraiment parlé. '
.'Elle m\'avait retrouvée sur les réseaux. Elle n\'avait plus mon numéro.<br><br>'
.'<strong style="color:#fff;">Ce n\'était pas un appel pour elle.</strong> '
.'Ce n\'était pas pour me dire qu\'elle était malade. '
.'C\'était pour me prévenir que ma sœur avait fait une tentative de suicide.<br><br>'
.'Elle avait déjà son cancer. Je ne le savais pas. Elle ne me l\'a pas dit.<br><br>'
.'Elle portait ça — et son premier réflexe, c\'était les autres. Ma sœur. Nous.<br><br>'
.'<strong style="color:'.$c_or.';">Elle était là pour ma sœur... quand moi je ne l\'étais pas.</strong><br><br>'
.'Et pendant ce temps-là, j\'accompagnais dans la même ville une amie qui traversait un cancer du sein. '
.'Je vivais à côté de Chantal sans le savoir. À côté de ce qu\'elle traversait. À côté de tout ce qu\'elle représentait.<br><br>'
.'<em style="color:rgba(232,224,208,.72);">C\'est une des vérités les plus amères que la perte nous enseigne : '
.'on réalise la valeur de ce qu\'on avait quand on ne l\'a plus.</em>'
.'</div>'

// Réveil
.'<div style="margin-bottom:1.4rem;">'
.'Mais tu m\'as fait quelque chose de plus grand que me faire regretter.<br><br>'
.'<strong style="color:#fff;">Tu m\'as mise face à moi-même.</strong><br><br>'
.'Tu m\'as montré que nous avions presque le même âge — '
.'et que si c\'était moi qui partais demain, les choix que tu avais su faire, '
.'les choix d\'être <em>vraiment présente</em> à ta vie — je ne les avais pas faits.<br><br>'
.'J\'étais en train de vivre à côté de mes enfants. À côté de mes rêves. '
.'À côté de mes amis. À côté de moi-même.<br><br>'
.'<strong style="color:'.$c_or.';">Tu m\'as réveillée.</strong><br><br>'
.'Et pour ça, je ne sais pas comment te remercier autrement qu\'en faisant de cette leçon quelque chose de vivant — '
.'en la transmettant, en en faisant ce parcours.'
.'</div>'

// Hommage final
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
.'Merci d\'avoir été humble parce que tu connaissais ta valeur.<br>'
.'Merci d\'avoir semé pour tes bijoux.<br>'
.'Merci d\'avoir été là pour ma sœur quand je ne l\'étais pas.<br><br>'
.'<strong style="color:#fff;">Merci, Chantal — lumière, amie, mère, compagne.</strong><br>'
.'Que nous puissions nous retrouver.<br><br>'
.'<em style="color:'.$c_or.';">Je t\'aime.</em>'
.'</div>'
.'</div>'
.'</div>';

// ── HOMMAGE EN complet ──────────────────────────────────────────────────────
$hommage_en = '<div style="border-left:3px solid rgba(201,168,76,.9);padding:.85rem 1.25rem;margin-bottom:.8rem;background:rgba(0,0,0,.15);border-radius:0 10px 10px 0;">'
.'<h4 style="color:#fff;font-size:.87rem;font-weight:700;margin:0 0 .5rem;display:flex;align-items:center;gap:.6rem;">'
.'<span style="font-size:.68rem;color:rgba(201,168,76,.9);background:rgba(0,0,0,.35);border:1px solid rgba(201,168,76,.9);border-radius:6px;padding:.1rem .4rem;flex-shrink:0;">Prologue · Before everything else</span>'
.'To Chantal — Why this program exists'
.'</h4>'
.'<div style="font-size:.8rem;color:rgba(232,224,208,.82);line-height:2;">'

.'<div style="text-align:center;margin:1.2rem 0 1.8rem;">'
.'<span style="font-size:1.05rem;font-weight:800;letter-spacing:.08em;color:#C9A84C;">TO CHANTAL</span><br>'
.'<span style="font-size:.75rem;color:rgba(201,168,76,.65);letter-spacing:.12em;text-transform:uppercase;">light · friend · mother · my sister\'s best friend</span>'
.'</div>'

.'<div style="font-size:.9rem;line-height:2.1;color:rgba(232,224,208,.95);margin-bottom:1.4rem;">'
.'Her name was Chantal.<br><br>'
.'Forty years old. A simple life. A <em>real</em> life.<br><br>'
.'She smiled in a way that made rooms brighter. '
.'She had those eyes that looked at you truly — not through you, not evaluating you. '
.'And that smile with those beautiful white teeth — not a performance of a smile, '
.'a smile that said: <strong style="color:#fff;">I am here, I am alive, and that is enough.</strong><br><br>'
.'She breathed life. Not the <em>performance</em> of life. Life itself.'
.'</div>'

.'<div style="background:rgba(201,168,76,.07);border:1px solid rgba(201,168,76,.2);border-radius:12px;padding:1.1rem 1.3rem;margin-bottom:1.4rem;">'
.'<div style="font-size:.77rem;font-weight:700;color:#C9A84C;letter-spacing:.1em;text-transform:uppercase;margin-bottom:.7rem;">What she had understood</div>'
.'She didn\'t have the impressive degrees. Not the high-profile career. '
.'She had something rarer.<br><br>'
.'<strong style="color:#fff;">She knew who she was.</strong><br><br>'
.'And because she knew who she was, she lived <em>from</em> that place. '
.'In forty years, Chantal lived more authentically than many will in eighty. '
.'She had realized what some spend a whole lifetime barely touching:<br><br>'
.'<em style="color:#C9A84C;">the most precious life is not in appearances, not in diplomas — '
.'it is in simplicity. In knowing what you love, who you love, why you live — and acting from that place.</em>'
.'</div>'

.'<div style="margin-bottom:1.4rem;">'
.'<strong style="color:#fff;">She had made the choices that few people make.</strong><br>'
.'Not the easy choices. The <em>right</em> ones.<br><br>'
.'She chose the right father for her children. It was not the easiest choice. '
.'His mother was not kind to her. '
.'She could have let that wound guide her decision — protected herself, chosen differently.<br>'
.'She didn\'t.<br><br>'
.'She looked beyond what she was enduring. Beyond herself. '
.'Toward what her children would need... after her.<br><br>'
.'And today, that mother-in-law who was not kind to her... '
.'is one of the people who cherishes her children, who watches over them, who holds them.<br><br>'
.'<strong style="color:#C9A84C;">Chantal had seen clearly. At forty years old. '
.'With a wisdom that few people reach in a whole lifetime.</strong><br><br>'
.'When she left, she did not leave a void behind her.<br>'
.'<strong style="color:#C9A84C;">She left jewels.</strong><br><br>'
.'Her children. Beings shaped by a woman who knew that what you sow today '
.'grows long after you are gone.'
.'</div>'

.'<div style="background:rgba(0,0,0,.2);border-left:3px solid rgba(251,191,36,.6);padding:.9rem 1.1rem;border-radius:0 10px 10px 0;margin-bottom:1.4rem;">'
.'<div style="font-size:.77rem;font-weight:700;color:rgba(251,191,36,.85);letter-spacing:.1em;text-transform:uppercase;margin-bottom:.6rem;">The painful paradox — and the last call</div>'
.'We had known each other since middle school. Chantal was my sister\'s best friend. '
.'We spent a lot of time together in high school, in the same city. Then I moved to Belgium. '
.'We saw each other briefly after my son was born. Some exchanges on social media. '
.'And then the ordinary silence that sets in — the kind you always think is temporary, the kind that lasts.<br><br>'
.'The last time I had Chantal on the phone... it had been years since we\'d truly talked. '
.'She had found me on social media. She no longer had my number.<br><br>'
.'<strong style="color:#fff;">It wasn\'t a call about her.</strong> '
.'It wasn\'t to tell me she was sick. '
.'It was to warn me that my sister had attempted suicide.<br><br>'
.'She already had her cancer. I didn\'t know. She didn\'t tell me.<br><br>'
.'She was carrying that — and her first instinct was still others. My sister. Us.<br><br>'
.'<strong style="color:#C9A84C;">She was there for my sister... when I wasn\'t.</strong><br><br>'
.'And during that same time, I was accompanying a friend in the same city who was fighting breast cancer. '
.'I was living alongside Chantal without knowing it. Alongside what she was going through. '
.'Alongside everything she meant to me.<br><br>'
.'<em style="color:rgba(232,224,208,.72);">It is one of the bitterest truths that loss teaches us: '
.'we realize the value of what we had when we no longer have it.</em>'
.'</div>'

.'<div style="margin-bottom:1.4rem;">'
.'But you did something greater for me than make me regret.<br><br>'
.'<strong style="color:#fff;">You held a mirror up to me.</strong><br><br>'
.'You showed me that we were almost the same age — '
.'and that if it were me leaving tomorrow, the choices you had made, '
.'the choices to be <em>truly present</em> to your life — I had not made them.<br><br>'
.'I was living alongside my children. Alongside my dreams. '
.'Alongside my friends. Alongside myself.<br><br>'
.'<strong style="color:#C9A84C;">You woke me up.</strong><br><br>'
.'And for that, I know no better way to thank you than to make this lesson something living — '
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
.'Thank you for being humble because you knew your worth.<br>'
.'Thank you for sowing for your jewels.<br>'
.'Thank you for being there for my sister when I wasn\'t.<br><br>'
.'<strong style="color:#fff;">Thank you, Chantal — light, friend, mother, companion.</strong><br>'
.'May we one day find each other again.<br><br>'
.'<em style="color:#C9A84C;">I love you.</em>'
.'</div>'
.'</div>'
.'</div>';

// ─── Injecter ────────────────────────────────────────────────────────────────

$acts_fr[0]['title']   = 'À Chantal — Pourquoi ce parcours existe';
$acts_fr[0]['content'] = $hommage_fr;
$acts_en[0]['title']   = 'To Chantal — Why this program exists';
$acts_en[0]['content'] = $hommage_en;

DB::table('formation_modules')
    ->where('id', $mod->id)
    ->update([
        'activities'    => json_encode($acts_fr, JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES),
        'activities_en' => json_encode($acts_en, JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES),
        'updated_at'    => now(),
    ]);

echo "✅ Module 0 mis à jour (ID: {$mod->id})\n";
echo "✅ Belle-mère + dernier appel intégrés (FR + EN)\n";
