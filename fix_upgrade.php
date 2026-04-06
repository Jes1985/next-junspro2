<?php
/**
 * fix_upgrade.php — Mise à jour ma-pause-souffle.blade.php
 * ─────────────────────────────────────────────────────────
 * 1. CSS  : ps-card--bebe / ps-card--proches / .ps-vision / .ps-audio-section
 * 2. Leaders : ajout Cadre · RH & DRH
 * 3. Section head : "5 familles" → "7 familles"
 * 4. Nouvelles cartes 6 & 7 (Gardiens du Tout-Petit + Les Proches)
 * 5. Souffle commun : texte étendu
 * 6. Section Vision "Nos vies · Nos maisons · Nos rues"
 * 7. Audio player Module 01 FR/EN
 * 8. JS psSwitchLang
 */

$file = __DIR__ . '/resources/views/frontend/formation/ma-pause-souffle.blade.php';
$raw  = file_get_contents($file);
if ($raw === false || strlen($raw) < 100) { die("ERREUR : fichier introuvable ou vide.\n"); }
$crlf = str_contains($raw, "\r\n");
$c    = str_replace("\r\n", "\n", $raw);   // normaliser en LF
$log  = [];
$ok   = 0; $fail = 0;

function apply(string &$c, string $old, string $new, string $label, array &$log, int &$ok, int &$fail): void {
    if (!str_contains($c, $old)) { $log[] = "❌ $label"; $fail++; return; }
    $c = str_replace($old, $new, $c);
    $log[] = "✅ $label"; $ok++;
}

// ══════════════════════════════════════════════════════════
// 1. CSS — nouvelles classes
// ══════════════════════════════════════════════════════════
$css_old = '.ps-card--educ     .ps-card__icon { background:rgba(34,197,94,.1); }
.ps-card--educ     .ps-card__tag  { background:rgba(34,197,94,.1); color:#86efac; border:1px solid rgba(34,197,94,.25); }
.ps-card--educ     { border-left:3px solid rgba(34,197,94,.35); }';

$css_new = $css_old . '

.ps-card--bebe     .ps-card__icon { background:rgba(244,114,182,.1); }
.ps-card--bebe     .ps-card__tag  { background:rgba(244,114,182,.1); color:#f9a8d4; border:1px solid rgba(244,114,182,.25); }
.ps-card--bebe     { border-left:3px solid rgba(244,114,182,.4); }

.ps-card--proches  .ps-card__icon { background:rgba(251,146,60,.1); }
.ps-card--proches  .ps-card__tag  { background:rgba(251,146,60,.1); color:#fdba74; border:1px solid rgba(251,146,60,.25); }
.ps-card--proches  { border-left:3px solid rgba(251,146,60,.4); }

/* ══ AUDIO MODULE ══ */
.ps-audio-section { max-width:760px; margin:3.5rem auto 0; padding:0 2rem; }
.ps-audio-section__inner {
  background:rgba(201,168,76,.06); border:1px solid rgba(201,168,76,.22);
  border-radius:16px; padding:2rem 2.5rem;
}
.ps-audio-section__label {
  font-size:.72rem; text-transform:uppercase; letter-spacing:.2em;
  color:var(--ps-gold); margin-bottom:.7rem;
}
.ps-audio-section__title { font-size:1.35rem; font-weight:700; color:#fff; margin-bottom:.4rem; }
.ps-audio-section__sub {
  font-size:.93rem; color:var(--ps-muted); line-height:1.75; margin-bottom:1.4rem;
}

/* ══ VISION ══ */
.ps-vision {
  position:relative; overflow:hidden;
  background:linear-gradient(135deg,rgba(201,168,76,.07) 0%,rgba(0,0,0,0) 55%,rgba(201,168,76,.04) 100%);
  border:1px solid rgba(201,168,76,.18); border-radius:20px;
  padding:4.5rem 3.5rem; text-align:center;
}
@media(max-width:680px){ .ps-vision{ padding:3rem 1.5rem; } }
.ps-vision__bg-text {
  position:absolute; top:50%; left:50%; transform:translate(-50%,-50%);
  font-size:16rem; font-weight:900; letter-spacing:.12em;
  color:rgba(201,168,76,.04); pointer-events:none; white-space:nowrap; user-select:none;
}
.ps-vision__eyebrow {
  font-size:.72rem; text-transform:uppercase; letter-spacing:.22em;
  color:var(--ps-gold); margin-bottom:1.2rem; position:relative;
}
.ps-vision__title {
  font-size:clamp(1.9rem,4vw,3rem); font-weight:800; color:#fff;
  line-height:1.15; margin-bottom:1.5rem; position:relative;
}
.ps-vision__title em { color:var(--ps-gold); font-style:normal; }
.ps-vision__lead {
  max-width:560px; margin:0 auto 3rem;
  font-size:1.05rem; color:var(--ps-muted); line-height:1.85; position:relative;
}
.ps-vision__lead em { color:rgba(255,255,255,.8); }
.ps-vision__pillars {
  display:grid; grid-template-columns:repeat(3,1fr); gap:1.5rem;
  text-align:left; margin-bottom:3rem; position:relative;
}
@media(max-width:680px){ .ps-vision__pillars{ grid-template-columns:1fr; } }
.ps-vision__pillar {
  background:rgba(255,255,255,.025); border:1px solid rgba(255,255,255,.07);
  border-radius:14px; padding:1.7rem; transition:border-color .2s;
}
.ps-vision__pillar:hover { border-color:rgba(201,168,76,.25); }
.ps-vision__pillar-icon { font-size:2rem; margin-bottom:.75rem; }
.ps-vision__pillar-title { font-size:1rem; font-weight:700; color:#fff; margin-bottom:.6rem; }
.ps-vision__pillar p { font-size:.88rem; color:var(--ps-muted); line-height:1.8; margin:0; }
.ps-vision__divider { width:40px; height:2px; background:rgba(201,168,76,.3); margin:0 auto 2.2rem; position:relative; }
.ps-vision__quote {
  max-width:550px; margin:0 auto; font-size:1.1rem; color:rgba(255,255,255,.7);
  font-style:italic; line-height:1.75; border-top:1px solid rgba(201,168,76,.2);
  padding-top:2rem; position:relative;
}
.ps-vision__quote-mark { font-size:1.5rem; color:var(--ps-gold); vertical-align:-.12em; margin:0 .15rem; }';

apply($c, $css_old, $css_new, 'CSS nouvelles classes', $log, $ok, $fail);

// ══════════════════════════════════════════════════════════
// 2. Leaders — ajout Cadre · RH & DRH
// ══════════════════════════════════════════════════════════
apply($c,
    "Chef d'entreprise · Manager · Coach · Consultant · Directeur · Entrepreneur",
    "Chef d'entreprise · Manager · Cadre · Coach · Consultant · RH &amp; DRH · Directeur · Entrepreneur",
    'Leaders : Cadre/RH',
    $log, $ok, $fail
);

// ══════════════════════════════════════════════════════════
// 3. Section head : 5 familles → 7 familles
// ══════════════════════════════════════════════════════════
apply($c,
    '5 familles · Des dizaines de pratiques',
    '7 familles · Des dizaines de pratiques',
    'Section head : 5→7 familles',
    $log, $ok, $fail
);

// ══════════════════════════════════════════════════════════
// 4. Cartes 6 & 7 — à insérer après la fermeture du grid des familles
// ══════════════════════════════════════════════════════════
$families_anchor =
'</div>

</div>

{{-- ══════ LE SOUFFLE COMMUN ══════ --}}';

$new_cards = '
  {{-- 6 — GARDIENS DU TOUT-PETIT --}}
  <div class="ps-card ps-card--bebe">
    <div class="ps-card__head">
      <div class="ps-card__left">
        <div class="ps-card__icon">🍼</div>
        <div class="ps-card__meta">
          <div class="ps-card__name">Les Gardiens du Tout-Petit</div>
          <div class="ps-card__prof">Nounou · Assistante maternelle · Auxiliaire de puériculture · Sage-femme · Puéricultrice · Crèche &amp; Maternité</div>
        </div>
      </div>
      <span class="ps-card__tag">Premiers instants &amp; Éveil</span>
    </div>
    <div class="ps-card__body">
      <div class="ps-card__subtitle">Un nourrisson ressent votre tension avant d\'entendre votre voix. Votre souffle est son premier ancrage.</div>
      <div class="ps-card__moment">
        <div class="ps-card__moment-label">Le moment d\'activation</div>
        <div class="ps-card__moment-text">
          <strong>Avant chaque change, chaque biberon, chaque portage.</strong> Mains posées, un cycle silencieux. Le corps du tout-petit se règle sur le vôtre — rythme cardiaque, tonus musculaire, qualité de présence. La question intérieure&nbsp;: <em style="color:var(--ps-gold);">"Est-ce que je suis vraiment là&hellip; pour lui&nbsp;?"</em>
        </div>
      </div>
      <div class="ps-card__examples">
        <span class="ps-card__ex">🍼 avant chaque biberon</span>
        <span class="ps-card__ex">🛁 avant le bain du soir</span>
        <span class="ps-card__ex">😴 avant d\'endormir le bébé</span>
        <span class="ps-card__ex">😢 face aux pleurs inconsolables</span>
        <span class="ps-card__ex">🤱 transition maternité → maison</span>
      </div>
      <div class="ps-card__result">Ce que ça change&nbsp;: vous offrez à ces enfants <em>dès les premiers instants de leur vie</em> un système nerveux qui rencontre le calme. L\'ancrage le plus profond qui soit — avant même les premiers mots.</div>
    </div>
  </div>

  {{-- 7 — LES PROCHES --}}
  <div class="ps-card ps-card--proches">
    <div class="ps-card__head">
      <div class="ps-card__left">
        <div class="ps-card__icon">🏡</div>
        <div class="ps-card__meta">
          <div class="ps-card__name">Les Proches</div>
          <div class="ps-card__prof">Parent · Conjoint · Mari · Femme · Ami(e) · Femme au foyer · Aidant familial</div>
        </div>
      </div>
      <span class="ps-card__tag">Vie quotidienne &amp; Lien</span>
    </div>
    <div class="ps-card__body">
      <div class="ps-card__subtitle">Pas de titre, pas de protocole. Juste la vie. Un souffle avant de répondre change tout ce qui suit.</div>
      <div class="ps-card__moment">
        <div class="ps-card__moment-label">Le moment d\'activation</div>
        <div class="ps-card__moment-text">
          <strong>L\'éclat de voix sur le point d\'arriver.</strong> L\'enfant qui crie, le partenaire qui reproche, la fatigue du soir qui déborde. Pause. Un cycle 5-5-5. Puis vous répondez. La question intérieure&nbsp;: <em style="color:var(--ps-gold);">"Est-ce que je veux réagir&hellip; ou agir&nbsp;?"</em>
        </div>
      </div>
      <div class="ps-card__examples">
        <span class="ps-card__ex">👶 avant de répondre à un enfant en crise</span>
        <span class="ps-card__ex">👩‍❤️‍👨 avant une conversation difficile en couple</span>
        <span class="ps-card__ex">🌙 rituel du soir après les enfants couchés</span>
        <span class="ps-card__ex">🛒 dans la file d\'attente, entre deux corvées</span>
        <span class="ps-card__ex">🤗 avant de retrouver un ami en peine</span>
      </div>
      <div class="ps-card__result">Ce que ça change&nbsp;: un parent qui respire apprend à son enfant que la paix est possible — <em>sans le dire, sans l\'enseigner, juste en le vivant devant eux</em>. C\'est peut-être la transmission la plus profonde de toutes.</div>
    </div>
  </div>

</div>

{{-- ══════ LE SOUFFLE COMMUN ══════ --}}';

apply($c, $families_anchor, $new_cards, 'Cartes 6 & 7 (Gardiens + Proches)', $log, $ok, $fail);

// ══════════════════════════════════════════════════════════
// 5. Souffle commun — texte étendu
// ══════════════════════════════════════════════════════════
apply($c,
    "Ce protocole est identique pour le potier, le chirurgien, la maîtresse d'école et le chef d'entreprise. C'est sa force.",
    "Ce protocole est identique pour le potier, le chirurgien, la sage-femme, l'enseignante, le chef d'entreprise, la nounou et le parent épuisé du soir. C'est sa force.",
    'Souffle commun : texte étendu',
    $log, $ok, $fail
);

// ══════════════════════════════════════════════════════════
// 6. Section VISION — juste avant {{-- CONSTRUIRE --}}
// ══════════════════════════════════════════════════════════
$vision_before = '{{-- ══════ CONSTRUIRE SON PROTOCOLE ══════ --}}';

$vision_block = '{{-- ══════ VISION : NOS VIES · NOS MAISONS · NOS RUES ══════ --}}
<div class="ps-vision" style="max-width:760px;margin:5rem auto 4rem;">
  <div class="ps-vision__bg-text" aria-hidden="true">SOUFFLE</div>

  <div class="ps-vision__eyebrow">Une pratique pour chaque vie</div>
  <h2 class="ps-vision__title">La Pause Souffle<br><em>dans nos vies,</em><br><em>dans nos maisons,</em><br><em>dans nos rues.</em></h2>

  <p class="ps-vision__lead">
    Le 5-5-5 n\'a pas de lieu attitré. Pas de cabinet, pas de salle de cours, pas de bureau.<br>
    Il appartient à quiconque respire — et veut choisir <em>comment</em> il respire.
  </p>

  <div class="ps-vision__pillars">
    <div class="ps-vision__pillar">
      <div class="ps-vision__pillar-icon">🏠</div>
      <div class="ps-vision__pillar-title">Dans nos maisons</div>
      <p>La cuisine à 7 h du matin, avant que tout commence. La chambre des enfants le soir, quand la voix doit rester douce. Le couloir après une journée qui vous a tout pris. Un seul cycle — et la maison change de tonalité. Pas parce que les murs ont bougé. Parce que vous avez bougé.</p>
    </div>
    <div class="ps-vision__pillar">
      <div class="ps-vision__pillar-icon">🌆</div>
      <div class="ps-vision__pillar-title">Dans nos rues</div>
      <p>Dans la voiture entre deux rendez-vous. Dans le métro avant d\'arriver. Sur le quai, à la caisse du supermarché, dans la salle d\'attente. Ces espaces de transition que l\'on traverse sans les habiter — la Pause Souffle les transforme en espaces de retour à soi. Trente secondes. N\'importe où.</p>
    </div>
    <div class="ps-vision__pillar">
      <div class="ps-vision__pillar-icon">🌍</div>
      <div class="ps-vision__pillar-title">Dans notre monde</div>
      <p>Une enseignante qui respire avant d\'entrer en classe depuis dix ans. Deux cents élèves qui ont appris à faire pareil. Et les enfants de ces enfants, qui sauront que le calme est possible. Une pratique se transmet silencieusement — par l\'exemple, par la présence, par la qualité de ce qu\'on dépose dans l\'espace.</p>
    </div>
  </div>

  <div class="ps-vision__divider"></div>

  <div class="ps-vision__quote">
    <span class="ps-vision__quote-mark">&laquo;</span>Le souffle est le seul acte que vous faites depuis votre naissance jusqu\'à votre dernier instant. Autant choisir <em>comment</em> vous le faites.<span class="ps-vision__quote-mark">&raquo;</span>
  </div>
</div>

{{-- ══════ CONSTRUIRE SON PROTOCOLE ══════ --}}';

apply($c, $vision_before, $vision_block, 'Section Vision', $log, $ok, $fail);

// ══════════════════════════════════════════════════════════
// 7. Audio player Module 01 — avant la section 7 familles
// ══════════════════════════════════════════════════════════
$audio_before = '{{-- ══════ 5 FAMILLES ══════ --}}';

$audio_block = '{{-- ══════ AUDIO GUIDÉ MODULE 01 ══════ --}}
<div class="ps-audio-section">
  <div class="ps-audio-section__inner">
    <div class="ps-audio-section__label">🎧&nbsp; Module 01 — Audio guidé</div>
    <h3 class="ps-audio-section__title">Commencez par l\'écoute.</h3>
    <p class="ps-audio-section__sub">Installez-vous. Fermez les yeux si vous le souhaitez. Laissez la pratique venir à vous — avant de lire, avant d\'analyser, avant de décider.</p>
    <div style="display:flex;gap:8px;margin-bottom:10px;">
      <button id="btn-m01-fr"
        onclick="psSwitchLang(\'01\',\'fr\')"
        style="background:#c9a84c;color:#0f0f0f;border:none;padding:5px 14px;border-radius:20px;font-size:12px;font-weight:700;cursor:pointer;letter-spacing:.04em;">
        🇫🇷 Français
      </button>
      <button id="btn-m01-en"
        onclick="psSwitchLang(\'01\',\'en\')"
        style="background:rgba(201,168,76,.15);color:#c9a84c;border:1px solid #c9a84c;padding:5px 14px;border-radius:20px;font-size:12px;font-weight:700;cursor:pointer;letter-spacing:.04em;">
        🇬🇧 English
      </button>
    </div>
    <audio id="audio-player-01" controls preload="none"
      style="width:100%;margin:.5rem 0;accent-color:#c9a84c;border-radius:8px;"
      data-base="{{ asset(\'storage/formation/audio/mps-01\') }}"
      src="{{ asset(\'storage/formation/audio/mps-01-fr.mp3\') }}">
      Votre navigateur ne supporte pas l\'audio HTML5.
    </audio>
    <p style="font-size:.8rem;color:rgba(201,168,76,.45);margin-top:.5rem;">
      🎙 Natasha · ElevenLabs · Méthode Pause Souffle 5-5-5
    </p>
  </div>
</div>

{{-- ══════ 7 FAMILLES ══════ --}}';

// Remplace également le commentaire "5 FAMILLES" en "7 FAMILLES"
$audio_old = $audio_before;
if (!str_contains($c, $audio_old)) {
    // Le heading a peut-être déjà été changé en "7 FAMILLES" (changement n°3 ci-dessus)
    $audio_old = '{{-- ══════ 7 FAMILLES ══════ --}}';
    $audio_block = str_replace('{{-- ══════ 7 FAMILLES ══════ --}}', '', $audio_block);
    $audio_block .= '{{-- ══════ 7 FAMILLES ══════ --}}';
    apply($c, $audio_old, $audio_block, 'Audio player Module 01 (alt)', $log, $ok, $fail);
} else {
    apply($c, $audio_old, $audio_block, 'Audio player Module 01', $log, $ok, $fail);
}

// ══════════════════════════════════════════════════════════
// 8. JS psSwitchLang — avant @endsection
// ══════════════════════════════════════════════════════════
$js_old = "</div>\n@endsection";
$js_new = "</div>
<script>
function psSwitchLang(mod, lang) {
  var btnFr = document.getElementById('btn-m' + mod + '-fr');
  var btnEn = document.getElementById('btn-m' + mod + '-en');
  var on  = 'background:#c9a84c;color:#0f0f0f;border:none;padding:5px 14px;border-radius:20px;font-size:12px;font-weight:700;cursor:pointer;letter-spacing:.04em;';
  var off = 'background:rgba(201,168,76,.15);color:#c9a84c;border:1px solid #c9a84c;padding:5px 14px;border-radius:20px;font-size:12px;font-weight:700;cursor:pointer;letter-spacing:.04em;';
  if (btnFr) btnFr.style.cssText = (lang === 'fr') ? on : off;
  if (btnEn) btnEn.style.cssText = (lang === 'en') ? on : off;
  var player = document.getElementById('audio-player-' + mod);
  if (player) {
    var base = player.getAttribute('data-base') || player.src.replace(/-fr\\.mp3\$/, '').replace(/-en\\.mp3\$/, '');
    player.setAttribute('data-base', base);
    player.pause();
    player.src = base + '-' + lang + '.mp3';
    player.load();
  }
}
</script>
@endsection";

apply($c, $js_old, $js_new, 'JS psSwitchLang', $log, $ok, $fail);

// ══════════════════════════════════════════════════════════
// ÉCRITURE FINALE
// ══════════════════════════════════════════════════════════
if ($crlf) $c = str_replace("\n", "\r\n", $c);  // restaurer CRLF si besoin
file_put_contents($file, $c);

echo implode("\n", $log) . "\n\n";
echo "────────────────────────────────\n";
echo "Réussis  : $ok\n";
echo "Échoués  : $fail\n";
if ($fail === 0) {
    echo "\n✅ Toutes les mises à jour ont été appliquées.\n";
} else {
    echo "\n⚠️  Certaines mises à jour ont échoué — vérifier les ancres.\n";
}
