<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * ANATOMIE VIVANTE — Le Manuel du Praticien Pause Souffle
 * Architecture : 8 Territoires · 1 Muscle Pilote · 1 Os Repère · 1 Image Mentale
 *
 * Promesse honnête :
 * "8 territoires parfaitement ancrés — une cartographie corporelle durable."
 * Pas une liste de 100 noms. Une géographie vivante.
 */
class FormationAnatomySeeder extends Seeder
{
    private function pilote(string $color, string $num, string $nom, string $muscle, string $image, string $os, string $lienPS): string
    {
        return '<div style="background:linear-gradient(135deg,rgba(0,0,0,.55),rgba(0,0,0,.2));border:2px solid '.$color.';border-radius:14px;padding:1.3rem 1.5rem;margin-bottom:1.1rem;">'
            .'<div style="font-size:.6rem;text-transform:uppercase;letter-spacing:.22em;color:'.$color.';margin-bottom:.55rem;">Territoire '.$num.' — '.$nom.'</div>'
            .'<div style="display:grid;grid-template-columns:1fr 1fr;gap:.9rem;margin-bottom:.85rem;">'
            .'<div><div style="font-size:.65rem;color:rgba(255,255,255,.4);margin-bottom:.18rem;text-transform:uppercase;letter-spacing:.08em;">Muscle pilote</div>'
            .'<div style="color:#fff;font-weight:800;font-size:.95rem;">'.$muscle.'</div>'
            .'<div style="font-size:.77rem;color:'.$color.';font-style:italic;margin-top:.18rem;">'.$image.'</div></div>'
            .'<div><div style="font-size:.65rem;color:rgba(255,255,255,.4);margin-bottom:.18rem;text-transform:uppercase;letter-spacing:.08em;">Os repère</div>'
            .'<div style="color:#fff;font-weight:800;font-size:.95rem;">'.$os.'</div></div>'
            .'</div>'
            .'<div style="background:rgba(0,0,0,.3);border-left:3px solid '.$color.';border-radius:0 8px 8px 0;padding:.65rem 1rem;font-size:.78rem;color:rgba(232,224,208,.75);line-height:1.8;">'
            .'<strong style="color:'.$color.';">⟡ Lien Pause Souffle :</strong> '.$lienPS
            .'</div></div>';
    }

    private function card(string $color, string $badge, string $title, string $body, ?string $audioTag = null): string
    {
        $audio = $audioTag
            ? '<div style="margin-top:.75rem;background:rgba(0,0,0,.25);border-radius:8px;padding:.6rem 1rem;font-size:.75rem;color:'.$color.';border:1px dashed '.$color.';">🎧 '.$audioTag.'</div>'
            : '';
        return '<div style="border-left:3px solid '.$color.';padding:.85rem 1.25rem;margin-bottom:.8rem;background:rgba(0,0,0,.15);border-radius:0 10px 10px 0;">'
            .'<h4 style="color:#fff;font-size:.87rem;font-weight:700;margin:0 0 .5rem;display:flex;align-items:center;gap:.6rem;">'
            .'<span style="font-size:.68rem;color:'.$color.';background:rgba(0,0,0,.35);border:1px solid '.$color.';border-radius:6px;padding:.1rem .4rem;flex-shrink:0;">'.$badge.'</span>'
            .$title.'</h4>'
            .'<div style="font-size:.8rem;color:rgba(232,224,208,.72);line-height:1.85;">'.$body.'</div>'
            .$audio.'</div>';
    }

    public function run(): void
    {
        $gold   = 'rgba(201,168,76,.9)';
        $teal   = 'rgba(20,184,166,.8)';
        $blue   = 'rgba(59,130,246,.8)';
        $purple = 'rgba(168,85,247,.8)';
        $orange = 'rgba(249,115,22,.8)';
        $red    = 'rgba(239,68,68,.8)';
        $green  = 'rgba(34,197,94,.8)';
        $indigo = 'rgba(99,102,241,.8)';

        // ─── OUVERTURE ─────────────────────────────────────────────
        $ouverture =
            $this->card($gold, 'Promesse', 'Ce que ce module vous donne réellement',
                'La mauvaise promesse (fréquente) : <em>"Apprenez 100 muscles en 2 heures."</em> Impossible. Contre-productif.<br><br>
                <strong>La vraie promesse :</strong> À la fin de ce module, vous habitez votre corps différemment. Vous reconnaissez immédiatement les 8 territoires. Vous pouvez poser la main sur n\'importe quelle zone et savoir ce qui s\'y passe.<br><br>
                Ce n\'est pas une liste à réciter. C\'est une géographie vivante à ressentir.<br><br>
                <em style="color:rgba(201,168,76,.7);">8 territoires · 8 muscles pilotes · 8 os repères · 8 images mentales · 8 audios guidés</em>'
            )
            .$this->card($gold, 'Méthode', 'Les 6 étapes d\'ancrage (pour chaque territoire)',
                '① <strong>Voir</strong> — localiser sur le schéma, puis sur vous-même<br>
                ② <strong>Nommer à voix haute</strong> — muscle pilote + os repère<br>
                ③ <strong>L\'image mentale</strong> — associer la métaphore précise<br>
                ④ <strong>Le geste</strong> — 1 mouvement qui active ce territoire<br>
                ⑤ <strong>Le souffle</strong> — 1 cycle 5-5-5 en conscience sur la zone<br>
                ⑥ <strong>L\'audio</strong> — la voix guidée encode dans la mémoire sensorielle<br><br>
                <em>4 mémoires simultanées : visuelle · verbale · kinesthésique · auditive. Rétention 4× supérieure à la lecture (Dual Coding Theory, Paivio 1971).</em>'
            )
            .$this->card($gold, 'Vue d\'ensemble', 'Les 8 territoires — la carte complète',
                '<table style="width:100%;font-size:.74rem;border-collapse:collapse;">
                <tr style="color:rgba(201,168,76,.9);border-bottom:1px solid rgba(255,255,255,.1);">
                <td style="padding:.28rem .4rem;font-weight:700;">#</td>
                <td style="padding:.28rem .4rem;font-weight:700;">Territoire</td>
                <td style="padding:.28rem .4rem;font-weight:700;">Muscle Pilote</td>
                <td style="padding:.28rem .4rem;font-weight:700;">Image</td></tr>
                <tr style="border-bottom:1px solid rgba(255,255,255,.04);"><td style="padding:.22rem .4rem;color:rgba(168,85,247,.85);">I</td><td>Le Souffle</td><td>Diaphragme</td><td style="font-style:italic;color:rgba(232,224,208,.45);">Le parachute intérieur</td></tr>
                <tr style="border-bottom:1px solid rgba(255,255,255,.04);"><td style="padding:.22rem .4rem;color:rgba(20,184,166,.85);">II</td><td>La Tour</td><td>Sous-occipitaux</td><td style="font-style:italic;color:rgba(232,224,208,.45);">Les gardiens du phare</td></tr>
                <tr style="border-bottom:1px solid rgba(255,255,255,.04);"><td style="padding:.22rem .4rem;color:rgba(59,130,246,.85);">III</td><td>Les Ailes</td><td>Sus-épineux</td><td style="font-style:italic;color:rgba(232,224,208,.45);">L\'aile qui décolle</td></tr>
                <tr style="border-bottom:1px solid rgba(255,255,255,.04);"><td style="padding:.22rem .4rem;color:rgba(249,115,22,.85);">IV</td><td>Le Centre</td><td>Psoas majeur</td><td style="font-style:italic;color:rgba(232,224,208,.45);">Le câble de l\'âme</td></tr>
                <tr style="border-bottom:1px solid rgba(255,255,255,.04);"><td style="padding:.22rem .4rem;color:rgba(239,68,68,.85);">V</td><td>Le Bassin</td><td>Grand fessier</td><td style="font-style:italic;color:rgba(232,224,208,.45);">Le moteur endormi</td></tr>
                <tr style="border-bottom:1px solid rgba(255,255,255,.04);"><td style="padding:.22rem .4rem;color:rgba(34,197,94,.85);">VI</td><td>Les Piliers</td><td>Vaste médial</td><td style="font-style:italic;color:rgba(232,224,208,.45);">Les colonnes portantes</td></tr>
                <tr style="border-bottom:1px solid rgba(255,255,255,.04);"><td style="padding:.22rem .4rem;color:rgba(99,102,241,.85);">VII</td><td>Les Pompes</td><td>Gastrocnémien</td><td style="font-style:italic;color:rgba(232,224,208,.45);">Le deuxième cœur</td></tr>
                <tr><td style="padding:.22rem .4rem;color:rgba(201,168,76,.85);">VIII</td><td>Le GPS Interne</td><td>Multifides</td><td style="font-style:italic;color:rgba(232,224,208,.45);">La boussole vertébrale</td></tr>
                </table>'
            );

        // ─── TERRITOIRE I — LE SOUFFLE ─────────────────────────────
        $t1 =
            $this->card($purple, 'Image', 'Le diaphragme — le parachute intérieur',
                '<div style="font-size:.92rem;line-height:2.3;text-align:center;color:rgba(232,224,208,.82);font-style:italic;padding:.4rem 0 .9rem;">
                Dans ton corps,<br>il existe un parachute invisible.<br><br>
                Quand il descend :<br>les poumons s\'ouvrent.<br>L\'air entre.<br><br>
                Quand il remonte :<br>l\'air sort.<br>Le calme revient.<br><br>
                <strong style="color:rgba(168,85,247,.9);font-style:normal;font-size:1rem;">Ce parachute est le diaphragme.</strong>
                </div>
                <div style="background:rgba(168,85,247,.07);border-radius:10px;padding:.85rem 1.1rem;margin-top:.2rem;">
                <div style="font-size:.6rem;text-transform:uppercase;letter-spacing:.18em;color:rgba(168,85,247,.55);margin-bottom:.55rem;">― Exploration ―</div>
                <span style="color:rgba(232,224,208,.78);line-height:2.1;">
                Pose une main sur le ventre.<br>
                Inspire doucement.<br>
                Observe la main qui se soulève.<br><br></span>
                <em style="color:rgba(168,85,247,.85);">Tu sens le parachute qui s\'ouvre ?</em></div>'
            )
            .$this->pilote($purple, 'I', 'Le Souffle',
                'Diaphragme', '"le parachute intérieur"',
                'Xiphoïde — pointe du sternum',
                'Toute la pratique 5-5-5 commence ici. À l\'inspiration, le diaphragme descend de 1,5 cm. À la rétention, il stabilise la pression intra-abdominale. À l\'expiration, il remonte et masse les organes. Poser la main sous le sternum : c\'est le toit du parachute.'
            )
            .$this->card($purple, 'Carte', 'Le territoire respiratoire — 8 muscles',
                '<strong>① Diaphragme</strong> — PILOTE. D6–L3 → centre tendineux. Descend à l\'inspi, remonte à l\'expi. Masse foie, rate, estomac 20 000×/jour.<br>
                <strong>② Intercostaux externes</strong> ×11 paires — inspiratoires, élèvent les côtes.<br>
                <strong>③ Intercostaux internes</strong> ×11 paires — expiratoires forcés.<br>
                <strong>④ Scalènes</strong> ant./moy./post. — C2–C7 → côtes 1–2. Actifs en stress chronique.<br>
                <strong>⑤ SCM</strong> — mastoïde → clavicula/manubrium. Urgence respiratoire uniquement.<br>
                <strong>⑥ Grand dentelé</strong> — scapula → côtes 1–9. Expansion thoracique latérale.<br>
                <strong>⑦ Grand pectoral</strong> (faisceau claviculaire) — inspiration forcée.<br>
                <strong>⑧ Carré des lombes</strong> — ancrage de la 12e côte, plancher du diaphragme.<br><br>
                <em style="color:rgba(168,85,247,.7);">Signal clinique : si les scalènes restent contractés après 3 cycles 5-5-5, le sympathique est encore dominant.</em>',
                'Audio A — Le parachute intérieur · Diaphragme + 5-5-5 guidé (~12 min)'
            )
            .$this->card($purple, 'Geste pilote', 'Activer le diaphragme — respiration 3D',
                '① Main sur le nombril, main sur le sternum · laquelle bouge en premier ?<br>
                ② Inspiration 5s : ventre → côtés → haut (dans cet ordre)<br>
                ③ Rétention 5s : les deux mains restent en place, sentez la pression douce<br>
                ④ Expiration 5s : la main du ventre redescend · la main du sternum s\'affaisse<br><br>
                <strong>Si seule la poitrine monte : vous respirez encore en mode alarme.</strong>'
            )
            .$this->card($purple, 'Clinique', 'Diaphragme — pathologie & application praticien',
                '<strong>Pathologie fréquente :</strong> Dysfonction diaphragmatique chronique.<br>
                Signes : respiration thoracique haute permanente · scalènes en hypertonus · anxiété de fond · RGO (reflux) · voix portée par le souffle court.<br>
                Prévalence : estimée à 60–80% des personnes souffrant d\'anxiété chronique.<br><br>
                <strong>Application praticien Pause Souffle :</strong><br>
                ① Avant la séance : observer si le ventre bouge à l\'inspiration (diaphragme actif) ou si seule la poitrine monte (compensé).<br>
                ② En séance : 5 cycles 5-5-5 main sur le ventre suffisent à réenclencher le diaphragme chez 70% des clients en 8 minutes.<br>
                ③ À prescrire : 3 × 5 cycles quotidiens le matin à jeun pendant 3 semaines.'
            );

        // ─── TERRITOIRE II — LA TOUR ──────────────────────────────────
        $t2 =
            $this->card($teal, 'Image', 'Les sous-occipitaux — les gardiens du phare',
                '<div style="font-size:.92rem;line-height:2.3;text-align:center;color:rgba(232,224,208,.82);font-style:italic;padding:.4rem 0 .9rem;">
                Au sommet de ta colonne,<br>sous le crâne,<br>quatre petits muscles veillent.<br><br>
                Quand ils se contractent :<br>la tête se fige.<br>La nuque se bloque.<br><br>
                Quand ils se relâchent :<br>le phare s\'allume.<br>La Tour respire.<br><br>
                <strong style="color:rgba(20,184,166,.9);font-style:normal;font-size:1rem;">Ces gardiens sont les sous-occipitaux.</strong>
                </div>
                <div style="background:rgba(20,184,166,.07);border-radius:10px;padding:.85rem 1.1rem;margin-top:.2rem;">
                <div style="font-size:.6rem;text-transform:uppercase;letter-spacing:.18em;color:rgba(20,184,166,.55);margin-bottom:.55rem;">― Exploration ―</div>
                <span style="color:rgba(232,224,208,.78);line-height:2.1;">
                Pose deux doigts à la base du crâne.<br>
                Rentre doucement le menton.<br>
                Sens la nuque s\'allonger.<br><br></span>
                <em style="color:rgba(20,184,166,.85);">Tu sens les gardiens lâcher prise ?</em></div>'
            )
            .$this->pilote($teal, 'II', 'La Tour',
                'Sous-occipitaux ×4', '"les gardiens du phare"',
                'Atlas C1 — première vertèbre cervicale',
                'La rétention 5s relâche progressivement les sous-occipitaux hypertoniques — à l\'origine de 70% des céphalées de tension. Chin tuck léger avant chaque cycle : la Tour se redresse, le nerf vague s\'active.'
            )
            .$this->card($teal, 'Carte', 'Le territoire crânio-cervical — 12 muscles',
                '<strong>Profondeurs de la Tour</strong><br>
                <strong>① Sous-occipitaux ×4</strong> — PILOTES (rect. cap. post. maj/min, obliques sup/inf). Contrôle nanomillimétrique du crâne. Siège des céphalées de tension.<br>
                <strong>② Longus colli & Longus capitis</strong> — fléchisseurs profonds. Faibles = tête projetée en avant.<br>
                <strong>③ Splénius capitis/cervicis</strong> — extension + rotation ipsilatérale.<br><br>
                <strong>La garde extérieure</strong><br>
                <strong>④ Trapèze supérieur</strong> — zone de stockage émotionnel n°1.<br>
                <strong>⑤ Élévateur de la scapula</strong> — se raccourcit sous les responsabilités.<br>
                <strong>⑥ SCM</strong> — rotation + urgence respiratoire.<br><br>
                <strong>Les portes du visage</strong><br>
                <strong>⑦ Masséter</strong> — bruxisme = pression accumulée.<br>
                <strong>⑧ Temporal</strong> — fermeture puissante, lié à la vigilance chronique.<br>
                <strong>⑨ Ptérygoïdiens</strong> méd. + lat. — mécanisme fin de l\'ATM.<br>
                <strong>⑩ Zygomatique majeur</strong> — le sourire authentique.<br>
                <strong>⑪ Orbiculaire des yeux</strong> — fatigue visuelle, pleurs retenus.<br>
                <strong>⑫ Frontal</strong> — froncement = vigilance permanente = sympathique actif.',
                'Audio B — Les gardiens du phare · Relâchement cervical + mâchoire (~10 min)'
            )
            .$this->card($teal, 'Geste pilote', 'Relâcher la Tour — chin tuck + 5-5-5',
                '① Assis, rentrez le menton doucement — sentez l\'allongement de la nuque<br>
                ② 2 doigts sur l\'occiput (base du crâne)<br>
                ③ Rétention 5s : la pression se relâche doucement sous vos doigts<br>
                ④ Expiration : mâchoire détendue, espace entre les dents, langue vers le bas<br><br>
                <em>La Tour correctement positionnée : oreille dans l\'axe de l\'épaule.</em>'
            )
            .$this->card($teal, 'Clinique', 'Sous-occipitaux — pathologie & application praticien',
                '<strong>Pathologie fréquente :</strong> Céphalées de tension d\'origine cervicale haute.<br>
                Signes : douleur en casque ou en bandeau · pire en fin de journée · aggravée par l\'écran · sensation de tête lourde · vertiges posturaux légers.<br>
                Cause : sous-occipitaux en hypertonus chronique → compression artère vertébrale → troubles vasculaires locaux.<br><br>
                <strong>Application praticien Pause Souffle :</strong><br>
                ① Repérer la tension : demander à la personne de tourner la tête à droite et à gauche — la rotation limitée (< 70°) indique un territoire II hypertonique.<br>
                ② En séance : chin tuck + 5 cycles 5-5-5, 2 doigts sur l\'occiput. Mesurer la rotation après : amélioration immédiate fréquente (5–10°).<br>
                ③ À prescrire : 3 × chin tuck + 3 cycles quotidiens · éviter le menton en avant devant l\'écran.'
            );

        // ─── TERRITOIRE III — LES AILES ───────────────────────────────
        $t3 =
            $this->card($blue, 'Image', 'Le sus-épineux — l\'aile qui attend',
                '<div style="font-size:.92rem;line-height:2.3;text-align:center;color:rgba(232,224,208,.82);font-style:italic;padding:.4rem 0 .9rem;">
                Dans l\'épaule, une aile attend.<br>Coincée sous un toit trop bas.<br>Elle veut décoller.<br><br>
                Quand le stress monte :<br>les ailes se verrouillent.<br>Les épaules remontent vers les oreilles.<br><br>
                Quand le souffle revient :<br>les ailes se déposent.<br>La cage s\'ouvre.<br><br>
                <strong style="color:rgba(59,130,246,.9);font-style:normal;font-size:1rem;">Cette aile est le sus-épineux.</strong>
                </div>
                <div style="background:rgba(59,130,246,.07);border-radius:10px;padding:.85rem 1.1rem;margin-top:.2rem;">
                <div style="font-size:.6rem;text-transform:uppercase;letter-spacing:.18em;color:rgba(59,130,246,.55);margin-bottom:.55rem;">― Exploration ―</div>
                <span style="color:rgba(232,224,208,.78);line-height:2.1;">
                Croise les bras sur la poitrine.<br>
                Inspire 5 secondes : sens les côtés s\'élargir.<br>
                Expire : laisse les épaules descendre seules.<br><br></span>
                <em style="color:rgba(59,130,246,.85);">Tu sens les ailes se reposer ?</em></div>'
            )
            .$this->pilote($blue, 'III', 'Les Ailes',
                'Sus-épineux', '"l\'aile qui décolle"',
                'Scapula — l\'omoplate comme aile repliée',
                'Les épaules descendent naturellement à chaque expiration — si les ailes ne sont pas verrouillées. À chaque inspiration : omoplates qui s\'écartent. À chaque expiration : deux ailes qui se reposent sur la cage thoracique.'
            )
            .$this->card($blue, 'Carte', 'La ceinture scapulaire — 11 muscles + 8 outils',
                '<strong>La coiffe des rotateurs (SITS)</strong><br>
                <strong>① Sus-épineux</strong> — PILOTE. Initiation abduction 0–15°. Déchirure = douleur épaule n°1.<br>
                <strong>② Sous-épineux</strong> — rotation externe. Stabilisateur postérieur principal.<br>
                <strong>③ Petit rond</strong> — rotation externe.<br>
                <strong>④ Sous-scapulaire</strong> — rotation interne. Souvent en hypertonus au bureau.<br><br>
                <strong>Les grands moteurs</strong><br>
                <strong>⑤ Deltoïde</strong> ant./moy./post. — abduction, flexion, extension.<br>
                <strong>⑥ Grand pectoral</strong> — adduction + rot. interne. Raccourcit en posture bureau.<br>
                <strong>⑦ Grand dorsal</strong> — extension + adduction + rot. interne. Plus grand muscle du dos.<br>
                <strong>⑧ Grand dentelé</strong> — plaquage scapulaire. Absent = scapula ailée.<br>
                <strong>⑨ Rhomboïdes</strong> maj + min — rétraction scapulaire.<br>
                <strong>⑩ Trapèze moyen</strong> — stabilisation posturale.<br>
                <strong>⑪ Coraco-brachial</strong> — hypertonus chez les anxieux.<br><br>
                <strong>Les outils du bras (×8)</strong><br>
                Biceps (2 chefs) · Brachial · Triceps (3 chefs) · Pronateur rond · Supinateur · Fléchisseurs doigts · Extenseurs doigts',
                'Audio C — Les ailes repliées · Épaules + ouverture thoracique (~12 min)'
            )
            .$this->card($blue, 'Geste pilote', 'Ouvrir les ailes — expansion thoracique',
                '① Bras croisés sur la poitrine (mains sur omoplates opposées)<br>
                ② Inspiration 5s : sentez les côtes s\'élargir latéralement sous vos bras<br>
                ③ Rétention 5s : chaleur entre les omoplates et la colonne<br>
                ④ Expiration 5s : épaules qui fondent vers le bas et l\'arrière<br><br>
                <em>Si les épaules remontent automatiquement à l\'inspiration : les scalènes compensent = stress non résolu.</em>'
            )
            .$this->card($blue, 'Clinique', 'Sus-épineux — pathologie & application praticien',
                '<strong>Pathologie fréquente :</strong> Syndrome de coincement sous-acromial (impingement).<br>
                Signes : douleur à l\'élévation du bras entre 60° et 120° (arc douloureux) · douleur nocturne sur le côté dominant · faiblesse à l\'abduction · craquement à l\'épaule.<br>
                Cause : sus-épineux comprimé entre acromion et tête humérale par posture avachie + sous-scapulaire en hypertonus.<br><br>
                <strong>Application praticien Pause Souffle :</strong><br>
                ① Observer : les épaules montent-elles à l\'inspiration ? = scalènes actifs + ailes verrouillées.<br>
                ② En séance : expansion thoracique (geste III) + 5 cycles → les omoplates se déposent naturellement dans l\'expiration.<br>
                ③ À prescrire : étirement pectoral en cadre de porte 30s × 3 + 3 cycles d\'expansion thoracique quotidiens.'
            );

        // ─── TERRITOIRE IV — LE CENTRE ─────────────────────────────────
        $t4 =
            $this->card($orange, 'Image', 'Le psoas — le câble du centre',
                '<div style="font-size:.92rem;line-height:2.3;text-align:center;color:rgba(232,224,208,.82);font-style:italic;padding:.4rem 0 .9rem;">
                Dans les profondeurs de ton bassin,<br>un câble relie ta colonne à tes jambes.<br><br>
                Quand il est tendu :<br>le corps se replie.<br>Le dos se courbe.<br>La nuit est agitée.<br><br>
                Quand il se libère :<br>le centre s\'ouvre.<br>La colonne trouve sa hauteur.<br><br>
                <strong style="color:rgba(249,115,22,.9);font-style:normal;font-size:1rem;">Ce câble est le psoas.</strong>
                </div>
                <div style="background:rgba(249,115,22,.07);border-radius:10px;padding:.85rem 1.1rem;margin-top:.2rem;">
                <div style="font-size:.6rem;text-transform:uppercase;letter-spacing:.18em;color:rgba(249,115,22,.55);margin-bottom:.55rem;">― Exploration ―</div>
                <span style="color:rgba(232,224,208,.78);line-height:2.1;">
                Debout, pose une main sur l\'aine.<br>
                Avance doucement un genou.<br>
                Sens le câble s\'étirer de l\'intérieur.<br><br></span>
                <em style="color:rgba(249,115,22,.85);">Tu sens la profondeur du centre ?</em></div>'
            )
            .$this->pilote($orange, 'IV', 'Le Centre',
                'Psoas majeur', '"le câble de l\'âme"',
                'L3 — centre de gravité du corps',
                'La rétention 5s active simultanément le transverse et le plancher pelvien — ce qui libère progressivement le psoas de son rôle de stabilisateur de survie. Un psoas libéré = posture droite sans effort, respiration libre, sommeil sans tensions lombaires.'
            )
            .$this->card($orange, 'Carte', 'Le territoire central — 12 muscles profonds',
                '<strong>Le câble</strong><br>
                <strong>① Psoas majeur</strong> — PILOTE. T12–L5 → petit trochanter. Seul muscle reliant tronc et jambe. Stocke la peur (Liz Koch).<br>
                <strong>② Iliaque</strong> — fosse iliaque → petit trochanter. Union = ilio-psoas.<br><br>
                <strong>Le corset naturel</strong><br>
                <strong>③ Transverse de l\'abdomen</strong> — corset profond. Se co-contracte 30ms avant tout mouvement. Première activation à la rétention 5s.<br>
                <strong>④ Multifides</strong> — GPS proprioceptif vertèbre à vertèbre. S\'atrophient en douleur chronique.<br>
                <strong>⑤ Plancher pelvien</strong> — élévateur de l\'anus + coccygien. Sol du corset.<br>
                <strong>⑥ Oblique interne</strong> + <strong>⑦ Oblique externe</strong> — rotateurs + compresseurs.<br>
                <strong>⑧ Droit de l\'abdomen</strong> — flexion du tronc.<br><br>
                <strong>Les piliers verticaux</strong><br>
                <strong>⑨ Érecteurs du rachis</strong> — 3 colonnes verticales.<br>
                <strong>⑩ Carré des lombes</strong> — stabilisation latérale L1–L4.<br>
                <strong>⑪ Droit de la cuisse</strong> — biarticulaire (fléchit hanche + étend genou).<br>
                <strong>⑫ Grand fessier</strong> (rappel) — extenseur de hanche, co-activé avec le transverse.',
                'Audio D — Le câble de l\'âme · Psoas + centrage 5-5-5 (~12 min)'
            )
            .$this->card($orange, 'Geste pilote', 'Libérer le psoas — la fente consciente',
                '① Fente basse : genou arrière au sol, genou avant à 90°<br>
                ② Inspiration 5s : légère antéversion du bassin<br>
                ③ Rétention 5s : sentez le câble de l\'aine à la colonne lombaire<br>
                ④ Expiration 5s : bassin revient en neutre, relâchement du câble<br><br>
                <em>Un psoas qui se libère = chaleur diffuse dans l\'aine. Un psoas qui résiste = tremblement involontaire possible (normal — décharge du stress stocké).</em>'
            )
            .$this->card($orange, 'Clinique', 'Psoas — pathologie & application praticien',
                '<strong>Pathologie fréquente :</strong> Lombalgie chronique d\'origine psoïtique + syndrome anxieux somatisé.<br>
                Signes : douleur lombaire irradiant à l\'aine · impossibilité de se tenir droit debout longtemps · hanche bloquée en légère flexion · réveils nocturnes avec tensions abdominales basses.<br>
                Cause profonde : le psoas est innervé par L1–L3 ET reçoit des projections du système limbique (amygdale) → il stocke littéralement les états de peur chronique.<br><br>
                <strong>Application praticien Pause Souffle :</strong><br>
                ① Évaluation : en décubitus dorsal, si une jambe ne peut pas rester à plat (test Thomas positif) → psoas raccourci confirmé.<br>
                ② En séance : fente consciente + 5 cycles. Si tremblement apparaît → c\'est une décharge neurologique saine, ne pas interrompre.<br>
                ③ À prescrire : fente 2 min par côté le soir + 3 cycles centrés sur l\'aine. 3 semaines pour ressentir un relâchement durable.'
            );

        // ─── TERRITOIRE V — LE BASSIN ───────────────────────────────────
        $t5 =
            $this->card($red, 'Image', 'Le grand fessier — le moteur endormi',
                '<div style="font-size:.92rem;line-height:2.3;text-align:center;color:rgba(232,224,208,.82);font-style:italic;padding:.4rem 0 .9rem;">
                Sous toi, en ce moment,<br>le plus grand muscle de ton corps dort.<br><br>
                Oublié par des heures passées assis.<br>Silencieux. En veille.<br><br>
                Quand il dort :<br>le dos travaille à sa place.<br>Le bas du dos se fatigue.<br><br>
                Quand il se réveille :<br>le bassin s\'ancre.<br>Le moteur reprend.<br><br>
                <strong style="color:rgba(239,68,68,.9);font-style:normal;font-size:1rem;">Ce moteur endormi est le grand fessier.</strong>
                </div>
                <div style="background:rgba(239,68,68,.07);border-radius:10px;padding:.85rem 1.1rem;margin-top:.2rem;">
                <div style="font-size:.6rem;text-transform:uppercase;letter-spacing:.18em;color:rgba(239,68,68,.55);margin-bottom:.55rem;">― Exploration ―</div>
                <span style="color:rgba(232,224,208,.78);line-height:2.1;">
                Assis, contracte doucement les deux fessiers.<br>
                Sens le sacrum s\'enfoncer dans la chaise.<br>
                Relâche.<br><br></span>
                <em style="color:rgba(239,68,68,.85);">Tu sens le moteur qui s\'allume ?</em></div>'
            )
            .$this->pilote($red, 'V', 'Le Bassin',
                'Grand fessier', '"le moteur endormi"',
                'Sacrum — la pierre angulaire',
                'Le grand fessier est le plus grand muscle du corps — et le plus souvent inhibé par 8h de position assise. Sa réactivation directe passe par l\'expiration : à l\'expiration 5s, contractez doucement les deux fessiers.'
            )
            .$this->card($red, 'Carte', 'Le territoire pelvien — 14 muscles',
                '<strong>① Grand fessier</strong> — PILOTE. Extenseur de hanche. Inhibé par la position assise. Réactive avec l\'expiration.<br><br>
                <strong>Stabilisateurs latéraux</strong><br>
                <strong>② Moyen fessier</strong> — stabilise le bassin à chaque pas. Faible = signe de Trendelenburg.<br>
                <strong>③ Petit fessier</strong> — abduction + rotation interne.<br>
                <strong>④ TFL</strong> — abduction + rotation interne. Souvent tendu chez les sédentaires.<br><br>
                <strong>Rotateurs profonds (coiffe de la hanche)</strong><br>
                <strong>⑤ Piriforme</strong> — sacrum → grand trochanter. Le nerf sciatique le traverse (50% de la pop).<br>
                <strong>⑥–⑦ Obturateurs</strong> int. + ext. — rotation externe profonde.<br>
                <strong>⑧–⑨ Gémelliers</strong> sup. + inf.<br>
                <strong>⑩ Carré fémoral</strong> — rotation externe puissante.<br><br>
                <strong>Adducteurs</strong><br>
                <strong>⑪ Grand adducteur</strong> · <strong>⑫ Long adducteur</strong> · <strong>⑬ Court adducteur</strong> · <strong>⑭ Gracile</strong> (biarticulaire)',
                'Audio E — Le moteur endormi · Ancrage pelvien + activation fessiers (~10 min)'
            )
            .$this->card($red, 'Geste pilote', 'Réveiller le grand fessier — isométrie',
                '① Allongé sur le dos, genoux fléchis, pieds à plat<br>
                ② Inspiration 5s : relâchez tout<br>
                ③ Rétention 5s : contractez les deux fessiers ensemble. Sentez le sacrum dans le sol.<br>
                ④ Expiration 5s : relâchez progressivement, sentez la chaleur<br><br>
                <em>Signal de réactivation : le grand fessier se contracte AVANT le bas du dos lors du lever. Sinon, le bas du dos compense encore.</em>'
            )
            .$this->card($red, 'Clinique', 'Grand fessier — pathologie & application praticien',
                '<strong>Pathologie fréquente :</strong> Inhibition du grand fessier + syndrome douloureux lombopelvien.<br>
                Signes : douleur lombaire basse · sensation de faiblesse en montant les escaliers · genou qui rentre en valgus à la descente · signe de Trendelenburg (bassin qui chute du côté porteur).<br>
                Cause : 8h de position assise quotidiennes inhibent le grand fessier par réciprocité (le psoas contracté inhibe son antagoniste). Le bas du dos devient le moteur principal de la marche → surcharge permanente.<br><br>
                <strong>Application praticien Pause Souffle :</strong><br>
                ① Test d\'activation : demander de lever une jambe en décubitus ventral — si le bas du dos se contracte avant la fesse → grand fessier inhibé confirmé.<br>
                ② En séance : isométrie fessier (rétention 5s) × 10 répétitions. Chaleur mesurable en 3 minutes.<br>
                ③ À prescrire : 20 isométries fessiers debout (serrage à chaque expiration) avant chaque lever de chaise. À faire toute la journée.'
            );

        // ─── TERRITOIRE VI — LES PILIERS ────────────────────────────────
        $t6 =
            $this->card($green, 'Image', 'Le vaste médial — la colonne intérieure',
                '<div style="font-size:.92rem;line-height:2.3;text-align:center;color:rgba(232,224,208,.82);font-style:italic;padding:.4rem 0 .9rem;">
                À l\'intérieur de ta cuisse,<br>une colonne soutient le genou.<br><br>
                Quand elle s\'affaiblit :<br>la rotule dévie.<br>Le genou craque.<br>Les escaliers font mal.<br><br>
                Quand elle est forte :<br>le genou glisse librement.<br>Le pilier tient.<br><br>
                <strong style="color:rgba(34,197,94,.9);font-style:normal;font-size:1rem;">Cette colonne intérieure est le vaste médial — VMO.</strong>
                </div>
                <div style="background:rgba(34,197,94,.07);border-radius:10px;padding:.85rem 1.1rem;margin-top:.2rem;">
                <div style="font-size:.6rem;text-transform:uppercase;letter-spacing:.18em;color:rgba(34,197,94,.55);margin-bottom:.55rem;">― Exploration ―</div>
                <span style="color:rgba(232,224,208,.78);line-height:2.1;">
                Debout, légère flexion de genou.<br>
                Pose une main sur la face interne de la cuisse.<br>
                Redresse-toi lentement.<br><br></span>
                <em style="color:rgba(34,197,94,.85);">Tu sens la colonne intérieure qui travaille ?</em></div>'
            )
            .$this->pilote($green, 'VI', 'Les Piliers',
                'Vaste médial (VMO)', '"les colonnes portantes"',
                'Grand trochanter — saillie latérale du fémur',
                'La rétention 5s en position debout active légèrement les quadriceps par co-contraction posturale. Microflexion de genou pendant la rétention = activation de tout le pilier.'
            )
            .$this->card($green, 'Clinique', 'VMO (Vaste médial) — pathologie & application praticien',
                '<strong>Pathologie fréquente :</strong> Syndrome fémoro-patellaire (douleur antérieure du genou).<br>
                Signes : douleur sous ou autour de la rotule · aggravée en montant/descendant les escaliers · craquements du genou · douleur prolongée en position assise (signe du cinéma).<br>
                Cause : VMO s\'atrophie 2× plus vite que le vaste latéral sous l\'effort. Le vaste latéral dominant tire la rotule vers l\'extérieur → friction. 30% des coureurs touchés.<br><br>
                <strong>Application praticien Pause Souffle :</strong><br>
                ① Observation : en squat profil, le genou plonge-t-il en dedans (valgus) ? = VMO faible confirmé.<br>
                ② En séance : microflexion genou + rétention 5s debout = activation VMO par co-contraction posturale.<br>
                ③ À prescrire : marche consciente en sentant l\'intérieur de la cuisse à chaque appui + 3 cycles debout avant chaque montée d\'escalier.'
            )
            .$this->card($green, 'Carte', 'Les membres inférieurs — 18 muscles',
                '<strong>Quadriceps (colonnes frontales)</strong><br>
                <strong>① VMO — Vaste médial</strong> — PILOTE. Stabilise la rotule médialement. Se faiblit le plus vite.<br>
                <strong>② Droit fémoral</strong> — biarticulaire (fléchit hanche + étend genou).<br>
                <strong>③ Vaste latéral</strong> — souvent dominant, tire la rotule latéralement.<br>
                <strong>④ Vaste intermédiaire</strong> — profond.<br><br>
                <strong>Ischio-jambiers (câbles dorsaux)</strong><br>
                <strong>⑤ Biceps fémoral</strong> (2 chefs) — flexion genou + rotation externe tibia.<br>
                <strong>⑥ Semi-tendineux</strong> + <strong>⑦ Semi-membraneux</strong> — flexion + stabilisation.<br>
                <strong>⑧ Poplité</strong> — déverrouille le genou pour la flexion.<br><br>
                <strong>Régleurs d\'appui (jambe)</strong><br>
                <strong>⑨ Tibial antérieur</strong> — dorsiflexion + inversion. Chaîne frontale.<br>
                <strong>⑩ Extenseur de l\'hallux</strong> — extension gros orteil.<br>
                <strong>⑪ Tibial postérieur</strong> — soutien voûte plantaire.<br>
                <strong>⑫ Fléchisseur commun des orteils</strong> — prise d\'appui sol.<br>
                <strong>⑬–⑭ Fibulaires</strong> long + court — éversion + voûte transverse.',
                'Audio F — Les colonnes portantes · Marche consciente + activation VMO (~10 min)'
            );

        // ─── TERRITOIRE VII — LES POMPES ───────────────────────────────
        $t7 =
            $this->card($indigo, 'Image', 'Le gastrocnémien — le deuxième cœur',
                '<div style="font-size:.92rem;line-height:2.3;text-align:center;color:rgba(232,224,208,.82);font-style:italic;padding:.4rem 0 .9rem;">
                Dans tes mollets,<br>deux pompes battent en silence.<br><br>
                À chaque pas :<br>elles poussent le sang vers le cœur.<br>80% du retour veineux remonte par là.<br><br>
                Quand elles s\'arrêtent :<br>le sang stagne.<br>Les jambes s\'alourdissent.<br><br>
                <strong style="color:rgba(99,102,241,.9);font-style:normal;font-size:1rem;">Ces pompes sont les gastrocnémiens.</strong>
                </div>
                <div style="background:rgba(99,102,241,.07);border-radius:10px;padding:.85rem 1.1rem;margin-top:.2rem;">
                <div style="font-size:.6rem;text-transform:uppercase;letter-spacing:.18em;color:rgba(99,102,241,.55);margin-bottom:.55rem;">― Exploration ―</div>
                <span style="color:rgba(232,224,208,.78);line-height:2.1;">
                Debout, monte lentement sur la pointe des pieds.<br>
                Sens la chaleur dans les mollets.<br>
                Redescends très lentement.<br><br></span>
                <em style="color:rgba(99,102,241,.85);">Tu sens les pompes travailler ?</em></div>'
            )
            .$this->pilote($indigo, 'VII', 'Les Pompes',
                'Gastrocnémien', '"le deuxième cœur"',
                'Calcanéum — première prise de terre',
                'Chaque contraction du gastrocnémien pompe 80% du retour veineux de tout le corps contre la gravité. Rétention 5s debout + montée sur pointe = activation maximale des pompes. À l\'expiration : descente lente = retour veineux complet.'
            )
            .$this->card($indigo, 'Carte', 'Les pompes et la voûte — 5 muscles clés',
                '<strong>① Gastrocnémien</strong> — PILOTE (2 chefs). Tendon d\'Achille. Deuxième cœur veineux. 80% du retour veineux des jambes.<br>
                <strong>② Soléaire</strong> — endurance pure. Pompe profonde (système saphène). Actif même debout immobile.<br>
                <strong>③ Triceps sural</strong> = gastrocnémien + soléaire = unité fonctionnelle du mollet.<br>
                <strong>④ Poplité</strong> (rappel) — déverrouilleur.<br>
                <strong>⑤ Muscles plantaires</strong> — voûte plantaire.<br><br>
                <strong style="color:rgba(99,102,241,.8);">Les 3 points d\'appui du pied</strong><br>
                ① Calcanéum · ② Base du gros orteil · ③ Base du petit orteil<br>
                Appui équilibré = triangle actif = colonnes vertébrales en axe.<br><br>
                <em>Une voûte effondrée transmet chaque choc au genou → hanche → colonne (×3 l\'onde de choc).</em>',
                'Audio G — Le deuxième cœur · Ancrage plantaire + activation mollets (~10 min)'
            )
            .$this->card($indigo, 'Geste pilote', 'Activer les pompes — élévation talons',
                '① Debout, pieds parallèles, microflexion genou (10°)<br>
                ② Inspiration 5s : montée lente sur la pointe des pieds<br>
                ③ Rétention 5s : maintien en haut, chaleur dans les mollets<br>
                ④ Expiration 5s : descente très lente (4 secondes) — retour veineux maximum<br><br>
                <em>20 répétitions quotidiennes = équivalent veineux de 2 km de marche (École française de Phlébologie).</em>'
            )
            .$this->card($indigo, 'Clinique', 'Gastrocnémien — pathologie & application praticien',
                '<strong>Pathologie fréquente :</strong> Insuffisance veineuse chronique + contractures du mollet récidivantes.<br>
                Signes : jambes lourdes en fin de journée · crampes nocturnes · chevilles gonflées · varices précoces · mollets douloureux au réveil.<br>
                Cause : position assise prolongée = pompes désactivées = stase veineuse dans les jambes = pression veineuse × 3 par rapport à la marche.<br><br>
                <strong>Application praticien Pause Souffle :</strong><br>
                ① Observation : marques de chaussettes profondes ou oedème de cheville en fin de journée = pompes insuffisantes.<br>
                ② En séance : 10 élévations de talons lentes synchronisées avec le souffle (inspiration = montée, expiration = descente lente).<br>
                ③ À prescrire : 20 élévations de talons toutes les 45 min de travail assis. Résultats sur l\'œdème en 2 semaines.'
            );

        // ─── TERRITOIRE VIII — LE GPS INTERNE ──────────────────────────
        $t8 =
            $this->card($gold, 'Image', 'Les multifides — la boussole vertébrale',
                '<div style="font-size:.92rem;line-height:2.3;text-align:center;color:rgba(232,224,208,.82);font-style:italic;padding:.4rem 0 .9rem;">
                Le long de ta colonne,<br>des milliers de petits capteurs écoutent.<br><br>
                Vertèbre par vertèbre.<br>Millimètre par millimètre.<br><br>
                Quand ils s\'éteignent :<br>le dos perd ses repères.<br>Les douleurs reviennent.<br><br>
                Quand ils s\'allument :<br>la boussole recalibre.<br>L\'équilibre revient.<br><br>
                <strong style="color:rgba(201,168,76,.95);font-style:normal;font-size:1rem;">Ces capteurs sont les multifides.</strong>
                </div>
                <div style="background:rgba(201,168,76,.07);border-radius:10px;padding:.85rem 1.1rem;margin-top:.2rem;">
                <div style="font-size:.6rem;text-transform:uppercase;letter-spacing:.18em;color:rgba(201,168,76,.55);margin-bottom:.55rem;">― Exploration ―</div>
                <span style="color:rgba(232,224,208,.78);line-height:2.1;">
                Ferme les yeux, debout.<br>
                Inspire 5s en sentant ta colonne de bas en haut.<br>
                Quelle vertèbre disparaît de ta conscience ?<br><br></span>
                <em style="color:rgba(201,168,76,.85);">C\'est là que ton GPS a besoin de toi.</em></div>'
            )
            .$this->pilote($gold, 'VIII', 'Le GPS Interne',
                'Multifides', '"la boussole vertébrale"',
                'L5–S1 — jonction lombo-sacrée',
                'Les multifides contiennent 5× plus de fuseaux neuromusculaires que le biceps. Ils sont le GPS proprioceptif de la colonne. La rétention 5s les co-active avec le transverse et le plancher pelvien : le système trilatéral de stabilisation profonde.'
            )
            .$this->card($gold, 'Carte', 'Les sentinelles de la colonne + les 50 os repères',
                '<strong>Les sentinelles</strong><br>
                <strong>① Multifides</strong> — PILOTE. 5 niveaux de profondeur. S\'atrophient en 48h de douleur aiguë. Priorité n°1 de rééducation lombaire.<br>
                <strong>② Érecteurs du rachis</strong> — 3 colonnes verticales (iliocostal + longissimus + épineux).<br>
                <strong>③ Carré des lombes</strong> — stabilisation latérale lombaire.<br><br>
                <strong>Les 50 os repères — voyage sensoriel ascendant</strong><br>
                <em>Du calcanéum jusqu\'au frontal · 1 main sur chaque repère · 1 souffle · remontez.</em><br><br>
                <span style="color:rgba(201,168,76,.8);">Pieds</span> — Calcanéum · Métatarses (×5) · Tibia · Fibula · Rotule<br>
                <span style="color:rgba(201,168,76,.8);">Bassin</span> — Grand trochanter · EIAS · Sacrum · Coccyx · Pubis<br>
                <span style="color:rgba(201,168,76,.8);">Colonne</span> — L5 · L3 (centre de gravité) · L1 · T12 · T4 · C7 · C1 (Atlas)<br>
                <span style="color:rgba(201,168,76,.8);">Thorax</span> — Côte 1 · Côte 7 · Côte 11 (flottante) · Xiphoïde · Sternum · Manubrium<br>
                <span style="color:rgba(201,168,76,.8);">Épaule & Bras</span> — Clavicule · Scapula · Humérus · Épicondyle · Radius · Ulna<br>
                <span style="color:rgba(201,168,76,.8);">Main</span> — Scaphoïde · Capitatum · Métacarpes (×5)<br>
                <span style="color:rgba(201,168,76,.8);">Crâne & Face</span> — Occipital · Mastoïde · Arcade zygomatique · Frontal · Pariétaux',
                'Audio H — La boussole vertébrale · Voyage des 50 os + méditation ascendante (~25 min)'
            )
            .$this->card($gold, 'Geste pilote', 'Calibrer le GPS — le column scan',
                '① Fermez les yeux, assis ou debout<br>
                ② Inspiration 5s : percevez L5 → T12 → T4 → C7 → Atlas (du bas vers le haut)<br>
                ③ Rétention 5s : quelle vertèbre "disparaît" ? = zone de déconnexion = priorité<br>
                ④ Expiration 5s : envoyez le souffle vers cette zone précise<br><br>
                <em>Une zone invisible = zone en protection neurale. C\'est là que commence votre pratique.</em>'
            )
            .$this->card($gold, 'Clinique', 'Multifides — pathologie & application praticien',
                '<strong>Pathologie fréquente :</strong> Lombalgie chronique récidivante + instabilité lombaire segmentaire.<br>
                Signes : douleur lombaire diffuse · sensation de "dos qui lâche" sans raison apparente · raideur matinale > 30 min · histoire de multiples épisodes douloureux sur fond stable.<br>
                Cause : les multifides s\'atrophient en seulement 48h de douleur aiguë (IRM mesurable) et ne récupèrent PAS spontanément même après disparition de la douleur. C\'est pourquoi 80% des lombalgies récidivent sans rééducation ciblée.<br><br>
                <strong>Application praticien Pause Souffle :</strong><br>
                ① Évaluation : demander de tenir l\'appui unipodal yeux fermés — instabilité rapide (< 10s) = proprioception lombaire défaillante = multifides insuffisants.<br>
                ② En séance : column scan (rétention 5s en conscience de chaque vertèbre) — les zones "invisibles" sont les priorités de travail.<br>
                ③ À prescrire : 5 min de column scan quotidien le matin. Résultats proprioceptifs mesurables en 3 semaines. Association recommandée avec la fente psoas (T IV) et l\'isométrie fessier (T V).'
            );

        // ─── LA CHARPENTE — LE SQUELETTE (100 OS) ─────────────────────────
        $squelette =
            $this->card($gold, 'Architecture', 'Le squelette : les fondations vivantes',
                'Le squelette n\'est pas une structure morte — c\'est un tissu vivant : il se remodèle, stocke du calcium, fabrique des cellules sanguines. 206 os chez l\'adulte · 300 à la naissance (certains fusionnent).<br><br>
                <strong>9 zones · une progression tête → pieds · 1 image + 1 geste par zone clé.</strong><br>
                La même logique qu\'utilisent les kinés, les ostéopathes et les professeurs d\'anatomie — mais avec le corps comme terrain d\'exploration, pas comme liste à mémoriser.'
            )
            .$this->card($gold, '① Crâne', 'Le crâne — le casque protecteur (22 os)',
                '<strong>Voûte (8 os) :</strong> Frontal · Pariétaux ×2 · Occipital · Temporaux ×2 · Sphénoïde · Ethmoïde<br>
                <strong>Face (14 os) :</strong> Maxillaires ×2 · Zygomatiques ×2 · Nasaux ×2 · Lacrymaux ×2 · Palatins ×2 · Cornets ×2 · Vomer · Mandibule<br><br>
                <em>Image :</em> Le crâne est un casque de moto vissé sur la colonne.<br>
                Toutes les forces du choc y convergent. La mandibule est la seule pièce mobile.<br><br>
                <em>Pratique :</em> Posez 2 doigts sur l\'occiput (base du crâne, derrière). Sentez le relief osseux. Faites un léger chin tuck : l\'occiput remonte légèrement. C\'est l\'Atlas qui pivote sous vos doigts.'
            )
            .$this->card($teal, '② Colonne', 'La colonne vertébrale — l\'arbre central (26 os)',
                '<strong>Cervicales C1–C7</strong> — C1 = Atlas (porte le crâne) · C2 = Axis (rotation tête) · C7 = vertèbre proéminente (repère visible)<br>
                <strong>Thoraciques T1–T12</strong> — articulent les 12 paires de côtes · T4 = niveau des omoplates<br>
                <strong>Lombaires L1–L5</strong> — les plus chargées · L3 = centre de gravité · L5 = jonction sacrée<br>
                <strong>Sacrum</strong> — 5 vertèbres fusionnées · clé de voûte du bassin<br>
                <strong>Coccyx</strong> — 4–5 vertèbres rudimentaires · point d\'ancrage du plancher pelvien<br><br>
                <em>Image :</em> La colonne est le mât d\'un voilier — souple mais ancré. Ce n\'est pas un mur en béton. C\'est un roseau qui plie sans rompre.<br><br>
                <em>Pratique :</em> Debout, trouvez C7 (la grosse bosse au bas du cou, visible en fléchissant la tête). Descendez vertèbre par vertèbre avec un doigt jusqu\'à T4. Sentez l\'alignement de votre mât.'
            )
            .$this->card($blue, '③ Cage thoracique', 'La cage thoracique — le berceau protecteur (25 os)',
                '<strong>Sternum</strong> en 3 parties : Manubrium (haut) · Corps · Xiphoïde (repère du diaphragme, bas)<br>
                <strong>Côtes ×12 paires :</strong><br>
                — Côtes 1–7 : <em>vraies côtes</em> (cartilage direct au sternum)<br>
                — Côtes 8–10 : <em>fausses côtes</em> (cartilage commun)<br>
                — Côtes 11–12 : <em>flottantes</em> (libres, ancrage postérieur du diaphragme uniquement)<br><br>
                <em>Image :</em> La cage thoracique est un berceau vivant qui s\'élargit à chaque inspiration et se resserre à chaque expiration. Elle protège le cœur et les poumons comme deux mains jointes autour d\'une flamme.<br><br>
                <em>Pratique :</em> Posez les deux paumes sur les flans des côtes. Inspirez lentement : sentez le berceau s\'élargir latéralement. Expirez : les paumes se rapprochent. C\'est la respiration 3D.'
            )
            .$this->card($purple, '④ Ceinture scapulaire', 'La ceinture scapulaire — les os de la liberté (4 os)',
                '<strong>Clavicule</strong> ×2 — seul pont osseux entre bras et thorax. Fracture la plus fréquente du sport. Palpable de bout en bout.<br>
                <strong>Scapula (omoplate)</strong> ×2 — os flottant maintenu par 17 muscles. Acromion · processus coracoïde · fosse supra-épineuse.<br><br>
                <em>Image :</em> Les omoplates sont deux ailes repliées. Libres de glisser, tourner, s\'élever. Quand elles se bloquent sous le stress, les ailes disparaissent.<br><br>
                <em>Pratique :</em> Croisez les bras sur la poitrine, mains sur les omoplates opposées. Faites des petits cercles d\'épaules. Sentez les scapulas glisser sous vos paumes comme deux plaquettes libres.'
            )
            .$this->card($purple, '⑤ Les bras', 'Les bras — les leviers du mouvement (6 os)',
                '<strong>Humérus</strong> ×2 — os du bras. Tête sphérique dans la glène de la scapula (articulation la plus mobile du corps).<br>
                <strong>Radius</strong> ×2 — côté pouce. Tourne autour de l\'ulna en pronation/supination.<br>
                <strong>Ulna (Cubitus)</strong> ×2 — côté auriculaire. Stable, forme le coude avec l\'humérus.<br><br>
                <em>Image :</em> Le bras est une grue à 3 segments articulés — épaule (rotule), coude (charnière), poignet (pivot). Chaque degré de liberté a son os.<br><br>
                <em>Pratique :</em> Bras tendu devant vous, paume vers le haut. Tournez lentement la paume vers le bas : le radius vient de pivoter par-dessus l\'ulna. C\'est la pronation — sentez la torsion dans l\'avant-bras.'
            )
            .$this->card($indigo, '⑥ Les mains', 'Les mains — l\'outil de précision (54 os)',
                '<strong>Os du carpe</strong> ×2 — 8 os par poignet (Scaphoïde · Lunatum · Triquétrum · Pisiforme · Trapèze · Trapézoïde · Capitatum · Hamatum)<br>
                <strong>Métacarpiens</strong> ×10 — 5 par main, forment la paume<br>
                <strong>Phalanges</strong> ×28 — 3 par doigt (proximale · moyenne · distale), 2 pour le pouce<br><br>
                <em>Image :</em> Les deux mains = 54 os = un quart du squelette. L\'évolution a tout misé sur la précision de la prise.<br><br>
                <em>Pratique :</em> Posez une main à plat. De l\'autre, palpez chaque métacarpe du pouce à l\'auriculaire. 5 rayons. Puis remontez sur le scaphoïde (face pouce du poignet) — os le plus souvent fracturé sans qu\'on le sache.'
            )
            .$this->card($red, '⑦ Le bassin', 'Le bassin — le centre de stabilité (4 pièces)',
                '<strong>Os iliaque</strong> ×2 — formé par : Ilion (crête iliaque + EIAS) · Ischion (tubérosité = "os assis") · Pubis<br>
                <strong>Sacrum + Coccyx</strong> (déjà vus)<br>
                Articulations : Sacro-iliaques ×2 · Symphyse pubienne<br><br>
                <em>Image :</em> Le bassin est un bol en céramique. Quand il est à niveau, tout ce qui est posé au-dessus (colonne, organes) trouve son équilibre naturel. Quand il bascule, c\'est toute la tour qui penche.<br><br>
                <em>Pratique :</em> Debout, posez un index sur chaque EIAS (saillies osseuses des hanches à l\'avant). Sont-elles au même niveau ? Une différence visible = bassin en inclinaison. C\'est le premier geste de bilan postural d\'un kiné ou d\'un ostéo.'
            )
            .$this->card($green, '⑧ Les jambes', 'Les jambes — les piliers du mouvement (8 os)',
                '<strong>Fémur</strong> ×2 — os le plus long et le plus résistant du corps. Tête · Col · Grand trochanter (repère Territoire VI).<br>
                <strong>Rotule (Patella)</strong> ×2 — os sésamoïde. Glisse dans la trochlée fémorale. Protège le genou à la flexion.<br>
                <strong>Tibia</strong> ×2 — porteur principal (90% de la charge). Tubérosité tibiale (attache quadriceps) · malléole interne.<br>
                <strong>Fibula</strong> ×2 — stabilisateur latéral. Malléole externe.<br><br>
                <em>Image :</em> Le fémur est la colonne d\'un pont suspendu. Il soutient tout le poids du corps entre la hanche et le genou. Le tibia est le pilier vertical qui descend jusqu\'au sol.<br><br>
                <em>Pratique :</em> Debout, posez la main sur la cuisse. Soulevez doucement le genou. Sentez le fémur travailler contre la gravité — c\'est le levier du bassin en action. Posez la main sur le grand trochanter (saillie latérale de la hanche) : c\'est la tête du fémur qui tourne dans son cotyle.'
            )
            .$this->card($orange, '⑨ Les pieds', 'Les pieds — les racines du corps (52 os)',
                '<strong>Tarse (7 os par pied) :</strong> Calcanéum (talon) · Talus (cheville) · Naviculaire · Cuboïde · 3 Cunéiformes<br>
                <strong>Métatarses</strong> ×10 — 5 par pied, forment la voûte transverse<br>
                <strong>Phalanges</strong> ×28 — 3 par orteil, 2 pour le gros orteil<br><br>
                <em>Image :</em> Le pied est un arc de tension vivant à 3 points d\'appui : Calcanéum · Base du gros orteil · Base du petit orteil. Un arc gothique, pas un bloc rigide. Quand la voûte s\'effondre, le choc de chaque pas monte jusqu\'aux genoux, hanches et colonnes (×3 l\'intensité).<br><br>
                <em>Pratique :</em> Debout, pieds nus. Trouvez vos 3 points d\'appui. Soulevez légèrement les orteils : vous sentez la voûte se renforcer. Reposez-les. Basculez le poids vers l\'avant, vers l\'arrière, de côté — explorez votre triangle d\'appui.'
            )
            .$this->card($indigo, 'Synthèse', 'Voyage sensoriel ascendant — les 26 repères essentiels',
                'Posez une main sur chaque repère · 1 inspiration · nommez-le à voix haute · remontez.<br><br>
                <strong>Pieds → Tête :</strong><br>
                Calcanéum · Malléoles · Tubérosité tibiale · Rotule · Grand trochanter ·
                Tubérosité ischiatique · EIAS · Sacrum · Crête iliaque · Xiphoïde ·
                Sternum · Manubrium · Côte 1 · Clavicule · Acromion (scapula) ·
                Épicondyle · Styloïde radiale · C7 (proéminente) · Mastoïde · Occiput ·
                Arcade zygomatique · Frontal<br><br>
                <em>Objectif : en 5 minutes, vous pouvez poser le doigt sur chacun. Ce n\'est pas de la mémorisation — c\'est de la reconnaissance. La charpente que vous habitez enfin.</em>'
            );

        // ─── TENSIONS & DOULEURS ───────────────────────────────────────────
        $tensions =
            $this->card($orange, 'Principe', 'Pourquoi le corps se bloque',
                '<strong>3 causes primaires :</strong><br>
                ① <strong>Le stress chronique</strong> — le système nerveux sympathique reste actif · les muscles posturaux restent contractés · la respiration reste haute et courte.<br>
                ② <strong>La sédentarité / mauvaise posture</strong> — certains muscles se raccourcissent (psoas, pectoraux, scalènes), d\'autres s\'atrophient (multifides, grand fessier, VMO).<br>
                ③ <strong>La compensation</strong> — une zone douloureuse est protégée → les zones adjacentes surcompensent → cascade de tensions.<br><br>
                <em>La douleur n\'est jamais là où est la cause. La nuque douloureuse souffre du travail du trapèze. Le dos bas souffre du manque de grand fessier.</em>'
            )
            .$this->card($red, 'Zone 1', 'Tensions de la nuque — les 4 coupables',
                '<strong>① Sous-occipitaux</strong> (hypertoniques) → céphalées de tension · vision floue · vertiges.<br>
                <strong>② Trapèze supérieur</strong> (chroniquement raccourci) → épaule remontée · douleur irradiante vers le temporal.<br>
                <strong>③ Élévateur de la scapula</strong> (tendu sous stress) → raideur rotation cervicale côté dominant.<br>
                <strong>④ Scalènes</strong> (activés en respiration haute) → engourdissements bras · syndrome thoracique<br><br>
                <em>Protocole Pause Souffle :</em> Chin tuck + rétention 5s avec 2 doigts sur l\'occiput. 5 cycles. Relâchement des sous-occipitaux mesuré par thermographie en 8 min (étude 2019).'
            )
            .$this->card($orange, 'Zone 2', 'Tensions des épaules — le verrou de la coiffe',
                '<strong>① Sus-épineux</strong> (Territoire III) — coincement sous-acromial à 60–120° d\'abduction.<br>
                <strong>② Sous-scapulaire</strong> (rotation interne chronique "posture bureau") → bras toujours en rotation interne.<br>
                <strong>③ Grand pectoral</strong> (raccourci) → les épaules tombent en avant → le sus-épineux est pincé en permanence.<br><br>
                <em>Protocole :</em> Expansion thoracique (Geste III) + étirement pectoral en cadre de porte + 5 cycles d\'épaules qui "fondent" à chaque expiration.'
            )
            .$this->card($gold, 'Zone 3', 'Douleurs lombaires — la triade infernale',
                '<strong>① Multifides atrophiés</strong> (s\'atrophient en 48h de douleur aiguë) → déstabilisation segmentaire.<br>
                <strong>② Psoas raccourci</strong> (Territoire IV) → antéversion forcée du bassin → hyperextension lombaire permanente.<br>
                <strong>③ Grand fessier inhibé</strong> (Territoire V) → le bas du dos compense chaque step.<br><br>
                <em>Règle des 3 territoires :</em> Toute lombalgie chronique implique IV + V + VIII. Impossible de traiter l\'un sans les deux autres.<br>
                <em>Protocole :</em> Fente consciente (T IV) + isométrie fessier (T V) + column scan (T VIII) · 3 min chacun · quotidien.'
            )
            .$this->card($red, 'Zone 4', 'Les hanches — le carrefour',
                '<strong>Piriforme</strong> (rotateur profond, Territoire V) → nerf sciatique traverse dans 50% des cas.<br>
                <strong>TFL/Bandelette ilio-tibiale</strong> → frottement condyle fémoral latéral → syndrome de la bandelette du coureur.<br>
                <strong>Adducteurs</strong> (souvent surmenés / rétrécis chez les sédentaires) → gêne à la rotation externe.<br><br>
                <em>Signe de Trendelenburg :</em> Si le bassin bascule du côté porteur à l\'appui unipodal → moyen fessier faible. Ce signe visible en marche explique 60% des lombo-sciatalgies de hanche.'
            )
            .$this->card($purple, 'Cas clinique', 'La sciatique — lecture complète du câble',
                '<strong>Le câble sciatique :</strong> Plexus lombaire L4–S3 → nerf sciatique (le plus long et le plus épais du corps, 2 cm de diamètre) → se divise derrière le genou en nerf tibial + péronier commun.<br><br>
                <strong>Mécanismes de compression :</strong><br>
                ① <em>Discale</em> — hernie L4-L5 ou L5-S1 → compression radiculaire directe (douleur électrique)<br>
                ② <em>Piriformis syndrome</em> — piriforme comprime le nerf → douleur fessière haute irradiante<br>
                ③ <em>Foraminale</em> — rétrécissement du foramen par arthrose · favorisé par multifides affaiblis<br><br>
                <strong>Protocole Pause Souffle :</strong> Psoas (T IV) + piriforme + multifides (T VIII). Jamais forcer la flexion en phase aiguë. La rétention 5s diminue la pression intra-discale de 30% (Wilke 1999).'
            );

        // ─── L'ŒIL DU PRATICIEN ───────────────────────────────────────────
        $praticien =
            $this->card($teal, 'Observation', 'Observer un corps — le regard en 4 couches',
                '<strong>Couche 1 — La forme</strong> : symétrie des épaules · niveau du bassin (EIAS) · position des pieds (rotation interne/externe) · position de la tête.<br>
                <strong>Couche 2 — Le mouvement</strong> : comment la personne entre dans la pièce · côté porteur · raideurs à l\'élévation des bras · amplitude de la rotation cervicale.<br>
                <strong>Couche 3 — La respiration</strong> : thoracique ou abdominale ? rythme · synchronisation bras/thorax · retenue inconsciente (apnée post-expiration).<br>
                <strong>Couche 4 — Le tonus</strong> : trapèzes remontés · mâchoire serrée · genoux hyperextendus · pieds en supination ou pronation.<br><br>
                <em>Règle : noter SANS interpréter pendant 60 secondes. L\'interprétation vient après.</em>'
            )
            .$this->card($blue, 'Adaptation', 'Adapter un mouvement — les 3 principes',
                '<strong>① Moins pour plus</strong> — réduire l\'amplitude jusqu\'à ce que le mouvement devienne fluide. La fluidité à 30° vaut mieux que la douleur à 90°.<br>
                <strong>② La zone sûre d\'abord</strong> — identifier quelle amplitude est libre, y installer le souffle d\'abord, puis explorer le reste.<br>
                <strong>③ La lenteur révèle</strong> — un mouvement rapide contourne les zones de résistance. Lent = le corps ne peut pas tricher.<br><br>
                <em>Jamais forcer contre une douleur aiguë (≥6/10). La douleur est une information, pas un obstacle à surmonter.</em>'
            )
            .$this->card($gold, 'Souffle', 'Guider la respiration — les 3 niveaux',
                '<strong>Niveau 1 — Observation</strong> : "Comment vous respirez en ce moment ?" · observer sans corriger · 3 cycles naturels.<br>
                <strong>Niveau 2 — Invitation</strong> : "Et si vous laissiez le ventre se détendre à l\'inspiration ?" · suggestion, pas injonction.<br>
                <strong>Niveau 3 — Guidé</strong> : "Inspirez pendant 5 secondes, je compte avec vous." · voix calme · rythme 5-5-5.<br><br>
                <em>Ne jamais dire "respirez correctement" — l\'adverbe crée une tension immédiate. Dire "respirez librement".</em>'
            )
            .$this->card($green, 'Sécurité', 'Créer un espace de sécurité',
                '<strong>Le corps se détend seulement s\'il se sent en sécurité.</strong><br>
                ① Annoncez TOUJOURS avant de toucher · attendez un "oui" verbal.<br>
                ② Proposez des positions variées (assis / debout / allongé) sans imposer.<br>
                ③ "Vous pouvez arrêter à tout moment" · dit au début, rappelé si hésitation.<br>
                ④ Pression maximale acceptable : le corps peut se déplacer sans résister.<br><br>
                <em>Un seul toucher non consenti détruit 6 séances de confiance construites.</em>'
            )
            .$this->card($red, 'Éthique', 'L\'éthique du praticien Pause Souffle',
                '<strong>Ce que vous faites :</strong><br>
                ✓ Accompagner un processus naturel de régulation<br>
                ✓ Éduquer à la conscience corporelle<br>
                ✓ Proposer des outils de gestion du stress par le souffle<br><br>
                <strong>Ce que vous ne faites pas :</strong><br>
                ✗ Diagnostiquer une pathologie médicale<br>
                ✗ Traiter une douleur de cause inconnue sans avoir recommandé une consultation médicale<br>
                ✗ Continuer une séance si la douleur augmente pendant le travail<br><br>
                <em style="color:rgba(239,68,68,.8);">Règle absolue : toute douleur thoracique, dorsale intense, ou engourdissement bilatéral des membres → arrêt immédiat + médecin.</em>'
            );

        // ─── LES 6 SYSTÈMES ──────────────────────────────────────────────
        $systemes =
            $this->card($red, '① Le réseau électrique silencieux', 'Le système nerveux — 86 milliards de neurones',
                '<em style="color:rgba(239,68,68,.8);font-size:.9rem;">Imaginez un réseau électrique invisible qui traverse chaque centimètre de votre corps. Des fils fins comme un cheveu, capables de transmettre un signal à 120 m/s — plus vite qu\'une voiture de course.</em><br><br>
                <strong>Les deux modes :</strong><br>
                🔴 <strong>Sympathique</strong> — "alarme incendie". Accélère tout. Parfait pour courir. Désastreux en permanence.<br>
                🟢 <strong>Parasympathique</strong> — "mode repos". Répare, digère, régénère. Activé par le souffle.<br><br>
                <strong>Le nerf vague X</strong> — le câble principal (80% des fibres vont du corps vers le cerveau, pas l\'inverse). 3 cycles 5-5-5 = bascule parasympathique confirmée.<br><br>
                <em>Exploration :</em> Posez deux doigts sur votre pouls au poignet. Inspirez 5s : le pouls s\'accélère légèrement. Expirez 5s : il ralentit. C\'est le réseau électrique qui répond à votre souffle en temps réel.',
                'Audio I — Les 6 systèmes · Voyage physiologique guidé (~15 min)'
            )
            .$this->card($gold, '② Les soufflets de la vie', 'Le système respiratoire — 300 millions d\'alvéoles',
                '<em style="color:rgba(201,168,76,.8);font-size:.9rem;">Imaginez deux soufflets de forge logés dans votre cage thoracique. Ils s\'ouvrent 20 000 fois par jour, aspirant l\'air du monde et le transformant en vie. Leur surface déployée = un court de tennis (70 m²).</em><br><br>
                <strong>Ce qui se passe vraiment :</strong><br>
                Inspiration → diaphragme descend → pression négative → air aspiré → oxygène traverse les alvéoles vers le sang en 0,25 seconde.<br>
                Rétention 5s → contact air/sang prolongé → saturation O₂ optimisée.<br>
                Expiration → CO₂ libéré → nerf vague activé → calme immédiat.<br><br>
                <em>Exploration :</em> Inspirez normalement. Puis inspirez encore — il reste de la place. Encore — encore. C\'est votre volume de réserve : 1,5 L d\'air que vous n\'utilisez jamais. Les soufflets ne fonctionnent qu\'à 30% de leur capacité.'
            )
            .$this->card($blue, '③ Les rivières qui nourrissent', 'Le système circulatoire — 100 000 km de vaisseaux',
                '<em style="color:rgba(59,130,246,.8);font-size:.9rem;">Imaginez un réseau de rivières, ruisseaux et canaux qui parcourent chaque village de votre corps. Les grandes artères sont les fleuves. Les capillaires sont les canaux d\'irrigation — si fins qu\'un globule rouge doit se plier pour passer.</em><br><br>
                <strong>Les 3 pompes :</strong><br>
                🫀 <strong>Cœur</strong> — 100 000 contractions/jour. Ne se repose jamais.<br>
                🫁 <strong>Diaphragme</strong> — pompe thoracique. Chaque inspiration crée une aspiration veineuse. 20 000 cycles d\'assistance/jour.<br>
                🦵 <strong>Mollets</strong> — pompe périphérique. 80% du retour veineux des jambes contre la gravité.<br><br>
                <em>Exploration :</em> Debout, faites 10 élévations de talons lentes. Sentez la chaleur monter dans les mollets — ce sont les rivières qui remontent vers le cœur.'
            )
            .$this->card($green, '④ Les cuisines intérieures', 'Le système digestif — le 2ème cerveau',
                '<em style="color:rgba(34,197,94,.8);font-size:.9rem;">Imaginez une longue cuisine de 9 mètres nichée dans votre ventre. Elle transforme tout ce qu\'elle reçoit : une pomme devient énergie en 4 heures. Un steak en 24h. Elle ne s\'arrête jamais — même la nuit, même sous le stress.</em><br><br>
                <strong>Ce qu\'on ne vous a pas dit :</strong><br>
                200–500 millions de neurones intestinaux = plus que dans la moelle épinière.<br>
                95% de la sérotonine (hormone du bonheur) produite ici, pas dans le cerveau.<br>
                38 000 milliards de bactéries — votre microbiome pèse 2 kg.<br><br>
                <strong>Le lien avec le souffle :</strong> À chaque inspiration profonde, le diaphragme masse foie, rate, estomac et côlon. 1 cycle 5-5-5 = massage viscéral complet. La digestion difficile après le stress = les cuisines n\'ont plus d\'électricité (sympathique).<br><br>
                <em>Exploration :</em> Posez la main sur le ventre. Inspirez en laissant le ventre se gonfler vers la paume. Sentez les cuisines recevoir ce massage doux.'
            )
            .$this->card($orange, '⑤ Les laboratoires invisibles', 'Le système hormonal — 50 hormones en circulation',
                '<em style="color:rgba(249,115,22,.8);font-size:.9rem;">Imaginez des laboratoires microscopiques disséminés dans tout le corps — glandes thyroïde, surrénales, pancréas, hypophyse — qui fabriquent en permanence des molécules messagères. Ces messagers voyagent dans le sang et changent le comportement de milliards de cellules à distance.</em><br><br>
                <strong>Les 4 acteurs clés :</strong><br>
                🔴 <strong>Cortisol</strong> — hormone de stress. Utile en urgence. Chronique = inflammation + immunodépression + prise de poids abdominale.<br>
                🟠 <strong>Adrénaline</strong> — survie immédiate. Reste dans le sang 20 min après l\'alerte.<br>
                🟢 <strong>Ocytocine</strong> — connexion + sécurité. Antagoniste direct du cortisol. Déclenchée par le toucher ET le souffle rhythmique.<br>
                🟡 <strong>Dopamine</strong> — motivation + récompense. 1 cycle 5-5-5 bien exécuté = micro-pic mesuré.<br><br>
                <em>La Pause Souffle fait baisser le cortisol ET monter l\'ocytocine + dopamine simultanément. C\'est une pharmacie naturelle activée par la respiration.</em>'
            )
            .$this->card($teal, '⑥ Les gardiens silencieux', 'Le système lymphatique + homéostasie',
                '<em style="color:rgba(20,184,166,.8);font-size:.9rem;">Imaginez une armée de gardiens invisibles qui patrouillent en permanence dans vos tissus, neutralisant les envahisseurs, évacuant les déchets, maintenant l\'ordre intérieur. Sans bruit. Sans holidays. 24h/24.</em><br><br>
                <strong>Le système lymphatique :</strong><br>
                1–2 L de lymphe/jour — collecte les déchets cellulaires.<br>
                700 ganglions lymphatiques — postes de filtration.<br>
                Pas de pompe propre : dépend du mouvement ET de la respiration.<br>
                <strong>1 cycle 5-5-5 = activation directe du drainage lymphatique thoracique.</strong><br><br>
                <strong>L\'homéostasie — l\'équilibre vivant :</strong><br>
                pH sanguin 7,35–7,45 · Température 37°C · Pression artérielle — tous régulés en temps réel par la respiration.<br><br>
                <em>La Pause Souffle est une pratique d\'homéostasie active : elle ramène la biologie vers ses valeurs d\'équilibre, naturellement, sans médicament.</em>'
            );

        // ─── INTRODUCTION — 6 LEÇONS FONDAMENTALES ───────────────────────
        $intro =
            $this->card($gold, 'Objectif', 'Ce que ce module vous apprend à faire',
                '<div style="font-size:.88rem;line-height:2.1;color:rgba(232,224,208,.82);">
                Un praticien Pause Souffle ne doit pas devenir médecin.<br>
                Mais il doit devenir un <strong>observateur intelligent du corps vivant</strong>.<br><br>
                Ce module vous apprend à :<br>
                · <strong>Lire</strong> le corps<br>
                · <strong>Respecter</strong> le corps<br>
                · <strong>Accompagner</strong> le corps<br><br>
                Pas de mémorisation. Pas de liste.<br>
                <em style="color:rgba(201,168,76,.8);">De la présence, de l\'observation, du souffle.</em>
                </div>'
            )
            .$this->card($teal, 'Leçon 1', 'Le corps — une maison vivante',
                '<div style="font-size:.92rem;line-height:2.3;color:rgba(232,224,208,.82);font-style:italic;margin-bottom:.9rem;">
                Imagine que le corps est une maison vivante.<br><br>
                Les os sont les murs.<br>
                Les muscles sont les cordes.<br>
                Le souffle est le vent qui circule dans les pièces.<br><br>
                Quand tout est fluide : la maison respire.<br>
                Quand les tensions s\'accumulent : la maison se ferme.
                </div>
                <div style="background:rgba(20,184,166,.07);border-radius:10px;padding:.85rem 1.1rem;">
                <div style="font-size:.6rem;text-transform:uppercase;letter-spacing:.18em;color:rgba(20,184,166,.55);margin-bottom:.5rem;">─ Exercice pratique ─</div>
                Ferme doucement les yeux.<br>
                Observe simplement trois choses :<br>
                · ta posture<br>
                · ton souffle<br>
                · les tensions dans ton corps<br><br>
                <em>Sans rien changer. Juste observer.</em><br>
                C\'est la première compétence d\'un praticien.
                </div>
                <div style="background:rgba(0,0,0,.25);border-left:3px solid rgba(20,184,166,.6);border-radius:0 8px 8px 0;padding:.65rem 1rem;margin-top:.75rem;font-size:.75rem;color:rgba(232,224,208,.65);">
                🎙 <strong style="color:rgba(20,184,166,.8);">Script audio ElevenLabs ·</strong>
                <em>"Fermez doucement les yeux. Imaginez votre corps comme une maison vivante. Une maison avec des murs, des pièces, des passages. Maintenant observez simplement : votre posture… votre souffle… les tensions présentes dans votre corps. Sans rien changer. Juste observer."</em>
                </div>'
            )
            .$this->card($blue, 'Leçon 2', 'La colonne vertébrale — l\'arbre du corps',
                '<div style="font-size:.92rem;line-height:2.3;color:rgba(232,224,208,.82);font-style:italic;margin-bottom:.9rem;">
                La colonne vertébrale est comme le tronc d\'un arbre.<br><br>
                Les bras et les jambes sont les branches.<br><br>
                Si le tronc est libre et vivant : l\'arbre est stable.<br>
                Si le tronc est rigide : tout l\'arbre souffre.
                </div>
                <div style="background:rgba(59,130,246,.07);border-radius:10px;padding:.85rem 1.1rem;">
                <div style="font-size:.6rem;text-transform:uppercase;letter-spacing:.18em;color:rgba(59,130,246,.55);margin-bottom:.5rem;">─ Exercice pratique ─</div>
                Debout. Imagine que ta colonne est un arbre.<br>
                Respire doucement.<br>
                À chaque respiration : grandis légèrement. Sans forcer.
                </div>
                <div style="background:rgba(0,0,0,.25);border-left:3px solid rgba(59,130,246,.6);border-radius:0 8px 8px 0;padding:.65rem 1rem;margin-top:.75rem;font-size:.75rem;color:rgba(232,224,208,.65);">
                🎙 <strong style="color:rgba(59,130,246,.8);">Script audio ElevenLabs ·</strong>
                <em>"Imaginez votre colonne vertébrale comme le tronc d\'un arbre. Un arbre vivant, souple, enraciné. À chaque respiration, sentez ce tronc s\'allonger doucement. Pas de tension. Juste une croissance naturelle."</em>
                </div>'
            )
            .$this->card($orange, 'Leçon 3', 'Les épaules — le carrefour des tensions',
                '<div style="font-size:.92rem;line-height:2.3;color:rgba(232,224,208,.82);font-style:italic;margin-bottom:.9rem;">
                Les épaules sont comme un sac invisible que nous portons.<br><br>
                Responsabilités. Stress. Fatigue.<br><br>
                Avec le temps, ce sac devient lourd.<br>
                Quand les épaules sont tendues : la respiration devient courte.
                </div>
                <div style="background:rgba(249,115,22,.07);border-radius:10px;padding:.85rem 1.1rem;">
                <div style="font-size:.6rem;text-transform:uppercase;letter-spacing:.18em;color:rgba(249,115,22,.55);margin-bottom:.5rem;">─ Exercice pratique ─</div>
                Pose les mains sur tes épaules.<br>
                Fais de petits cercles lents. Respire.<br>
                Imagine que le sac devient plus léger.
                </div>
                <div style="background:rgba(0,0,0,.25);border-left:3px solid rgba(249,115,22,.6);border-radius:0 8px 8px 0;padding:.65rem 1rem;margin-top:.75rem;font-size:.75rem;color:rgba(232,224,208,.65);">
                🎙 <strong style="color:rgba(249,115,22,.8);">Script audio ElevenLabs ·</strong>
                <em>"Posez doucement vos mains sur vos épaules. Imaginez que vous portez un sac invisible. Avec chaque mouvement… ce sac devient plus léger. Respirez… et laissez les épaules se relâcher."</em>
                </div>'
            )
            .$this->card($purple, 'Leçon 4', 'Le diaphragme — le chef d\'orchestre du souffle',
                '<div style="font-size:.92rem;line-height:2.3;color:rgba(232,224,208,.82);font-style:italic;margin-bottom:.9rem;">
                Le diaphragme est comme un parachute intérieur.<br><br>
                Quand il descend : l\'air entre.<br>
                Quand il remonte : l\'air sort.<br><br>
                Ce muscle influence la respiration, la détente, la digestion.<br>
                Quand le diaphragme se détend : tout le corps se calme.
                </div>
                <div style="background:rgba(168,85,247,.07);border-radius:10px;padding:.85rem 1.1rem;">
                <div style="font-size:.6rem;text-transform:uppercase;letter-spacing:.18em;color:rgba(168,85,247,.55);margin-bottom:.5rem;">─ Exercice pratique ─</div>
                Une main sur le ventre. Respire lentement.<br>
                Observe le mouvement naturel du parachute.
                </div>
                <div style="background:rgba(0,0,0,.25);border-left:3px solid rgba(168,85,247,.6);border-radius:0 8px 8px 0;padding:.65rem 1rem;margin-top:.75rem;font-size:.75rem;color:rgba(232,224,208,.65);">
                🎙 <strong style="color:rgba(168,85,247,.8);">Script audio ElevenLabs ·</strong>
                <em>"Posez une main sur votre ventre. Imaginez un parachute qui s\'ouvre doucement à l\'intérieur de votre corps. À chaque inspiration… le parachute descend. À chaque expiration… il remonte lentement."</em>
                </div>'
            )
            .$this->card($green, 'Leçon 5', 'Les muscles — les cordes du corps',
                '<div style="font-size:.92rem;line-height:2.3;color:rgba(232,224,208,.82);font-style:italic;margin-bottom:.9rem;">
                Les muscles sont comme les cordes d\'un instrument.<br><br>
                Trop tendues → douleur.<br>
                Trop relâchées → instabilité.<br><br>
                L\'équilibre crée l\'harmonie.
                </div>
                <div style="background:rgba(34,197,94,.07);border-radius:10px;padding:.85rem 1.1rem;">
                <div style="font-size:.6rem;text-transform:uppercase;letter-spacing:.18em;color:rgba(34,197,94,.55);margin-bottom:.5rem;">─ Exercice pratique ─</div>
                Étirement doux des bras. Respire.<br>
                Observe la différence entre tension et relâchement.<br>
                L\'espace entre les deux — c\'est là que vous travaillez.
                </div>
                <div style="background:rgba(0,0,0,.25);border-left:3px solid rgba(34,197,94,.6);border-radius:0 8px 8px 0;padding:.65rem 1rem;margin-top:.75rem;font-size:.75rem;color:rgba(232,224,208,.65);">
                🎙 <strong style="color:rgba(34,197,94,.8);">Script audio ElevenLabs ·</strong>
                <em>"Imaginez les muscles de votre corps comme les cordes d\'un instrument. Trop tendues, elles ne chantent plus. Trop relâchées, elles ne vibrent plus. Trouvez l\'accord juste, celui qui vibre sans forcer."</em>
                </div>'
            )
            .$this->card($indigo, 'Leçon 6', 'Lire le corps d\'un client — le regard du praticien',
                '<div style="font-size:.92rem;line-height:2.3;color:rgba(232,224,208,.82);font-style:italic;margin-bottom:.9rem;">
                Un bon praticien observe avant d\'agir.<br><br>
                Le corps parle avant les mots.
                </div>
                <div style="background:rgba(99,102,241,.07);border-radius:10px;padding:.85rem 1.1rem;">
                <div style="font-size:.6rem;text-transform:uppercase;letter-spacing:.18em;color:rgba(99,102,241,.55);margin-bottom:.5rem;">─ Les 3 lectures ─</div>
                <strong>① Posture</strong> — les épaules sont-elles au même niveau ? le bassin penche-t-il ?<br>
                <strong>② Respiration</strong> — thoracique ou abdominale ? retenue ou fluide ?<br>
                <strong>③ Mouvement</strong> — où est la zone de raideur ? quel côté compense ?<br><br>
                <em>60 secondes d\'observation silencieuse avant toute intervention. C\'est la règle.</em>
                </div>'
            );

        // ─── LES 10 RÈGLES DE SÉCURITÉ ───────────────────────────────────
        $securite =
            $this->card($red, 'Préambule', 'Pourquoi ces règles existent',
                '<div style="font-size:.88rem;line-height:2.1;color:rgba(232,224,208,.82);">
                Toutes les grandes écoles de pratiques corporelles enseignent ces règles <strong>en premier</strong>, avant toute technique.<br><br>
                Pas parce que le corps est fragile.<br>
                Parce que <strong>la confiance se construit sur le respect</strong>, et le respect commence par des limites claires.<br><br>
                Un praticien qui ne connaît pas ces règles n\'est pas un praticien — c\'est un amateur bien intentionné.<br>
                <em style="color:rgba(239,68,68,.8);">Un seul écart peut défaire des semaines de confiance construite.</em>
                </div>'
            )
            .$this->card($red, 'Règles 1–5', 'Les 5 règles du corps',
                '<div style="line-height:2.4;font-size:.84rem;color:rgba(232,224,208,.85);">
                <strong style="color:rgba(239,68,68,.9);">① Ne jamais forcer un mouvement.</strong><br>
                Si le corps résiste, s\'arrêter. La résistance est une information, pas un obstacle.<br><br>
                <strong style="color:rgba(239,68,68,.9);">② Respecter la douleur.</strong><br>
                Douleur ≥ 6/10 = arrêt immédiat. Toujours. Sans exception. Recommander un médecin.<br><br>
                <strong style="color:rgba(239,68,68,.9);">③ Toujours aller lentement.</strong><br>
                Un mouvement rapide contourne les zones de résistance. Lent = le corps ne peut pas tricher.<br><br>
                <strong style="color:rgba(239,68,68,.9);">④ Adapter à l\'âge et à l\'état.</strong><br>
                Une personne de 70 ans, une femme enceinte, quelqu\'un sous traitement = protocole adapté avant la séance.<br><br>
                <strong style="color:rgba(239,68,68,.9);">⑤ Observer la respiration en permanence.</strong><br>
                Retenue du souffle = inconfort ou effort excessif = réduire immédiatement l\'intensité.
                </div>'
            )
            .$this->card($orange, 'Règles 6–10', 'Les 5 règles de la relation',
                '<div style="line-height:2.4;font-size:.84rem;color:rgba(232,224,208,.85);">
                <strong style="color:rgba(249,115,22,.9);">⑥ Respecter les limites articulaires.</strong><br>
                Chaque articulation a une amplitude naturelle. Ne jamais amener un segment au-delà de sa limite passive.<br><br>
                <strong style="color:rgba(249,115,22,.9);">⑦ Éviter les mouvements brusques.</strong><br>
                Aucun étirement, manipulation ou appui n\'est jamais brusque. Jamais. La douceur n\'est pas une option.<br><br>
                <strong style="color:rgba(249,115,22,.9);">⑧ Encourager activement la détente.</strong><br>
                "Laissez le poids aller." "Je tiens, vous n\'avez rien à faire." La sécurité se dit et se confirme.<br><br>
                <strong style="color:rgba(249,115,22,.9);">⑨ Observer les réactions tout au long de la séance.</strong><br>
                Couleur du visage · tension des mâchoires · respiration bloquée · larmes soudaines = signal à accueillir.<br><br>
                <strong style="color:rgba(249,115,22,.9);">⑩ Toujours privilégier la douceur sur l\'efficacité.</strong><br>
                Une séance douce qui crée de la confiance vaut dix fois une séance "puissante" qui créé de l\'appréhension.
                </div>'
            )
            .$this->card($gold, 'Urgences', 'Les 3 signaux d\'arrêt immédiat',
                '<div style="font-size:.85rem;line-height:2.2;color:rgba(232,224,208,.82);">
                Ces situations imposent l\'<strong>arrêt immédiat de la séance</strong> et une recommandation médicale :<br><br>
                🔴 <strong>Douleur thoracique</strong> ou dorsale intense et soudaine<br>
                🔴 <strong>Engourdissement bilatéral</strong> des membres (des deux côtés simultanément)<br>
                🔴 <strong>Vertiges intenses</strong> avec nausée ou perte d\'équilibre<br><br>
                <em style="color:rgba(239,68,68,.7);">En cas de doute : arrêt, hydratation, position de repos, appel médical si les symptômes persistent plus de 5 minutes.</em>
                </div>'
            );

        // ─── ACTIVITÉS ────────────────────────────────────────────────────
        $activities = [
            [
                'type'        => 'lecture',
                'title'       => 'Introduction — Le Corps Maison Vivante',
                'duration'    => '~25 min',
                'description' => '6 leçons fondamentales avant la plongée dans les 8 territoires. Paraboles, exercices pratiques, scripts audio ElevenLabs. Apprendre à observer avant d\'agir.',
                'content'     => $intro,
            ],
            [
                'type'        => 'lecture',
                'title'       => 'Ouverture — La Méthode des 8 Territoires',
                'duration'    => '~20 min',
                'description' => 'La promesse honnête : 8 territoires ancrés, pas 100 noms récités. La méthode en 6 étapes. Le tableau des 8 pilotes, 8 os repères, 8 images mentales.',
                'content'     => $ouverture,
            ],
            [
                'type'        => 'pratique',
                'title'       => 'Territoire I — Le Souffle · Diaphragme / Xiphoïde',
                'duration'    => '~30 min',
                'description' => 'Muscle pilote : Diaphragme — "le parachute intérieur". Os repère : Xiphoïde. 8 muscles du territoire respiratoire. Audio A.',
                'source'      => 'Blandine Calais-Germain — Respiration · HeartMath',
                'content'     => $t1,
            ],
            [
                'type'        => 'pratique',
                'title'       => 'Territoire II — La Tour · Sous-occipitaux / Atlas C1',
                'duration'    => '~25 min',
                'description' => 'Muscle pilote : Sous-occipitaux — "les gardiens du phare". Os repère : Atlas C1. 12 muscles crânio-cervicaux. Audio B.',
                'source'      => 'Travell & Simons — Myofascial Pain Vol.1',
                'content'     => $t2,
            ],
            [
                'type'        => 'pratique',
                'title'       => 'Territoire III — Les Ailes · Sus-épineux / Scapula',
                'duration'    => '~25 min',
                'description' => 'Muscle pilote : Sus-épineux — "l\'aile qui décolle". Os repère : Scapula. 11 muscles ceinture scapulaire + 8 outils du bras. Audio C.',
                'source'      => 'Kapandji — Physiologie Articulaire Vol.1 · Netter',
                'content'     => $t3,
            ],
            [
                'type'        => 'pratique',
                'title'       => 'Territoire IV — Le Centre · Psoas / L3',
                'duration'    => '~30 min',
                'description' => 'Muscle pilote : Psoas — "le câble de l\'âme". Os repère : L3 (centre de gravité). 12 muscles profonds. Audio D.',
                'source'      => 'Stuart McGill — Back Mechanic · Liz Koch — The Psoas Book',
                'content'     => $t4,
            ],
            [
                'type'        => 'pratique',
                'title'       => 'Territoire V — Le Bassin · Grand Fessier / Sacrum',
                'duration'    => '~25 min',
                'description' => 'Muscle pilote : Grand fessier — "le moteur endormi". Os repère : Sacrum. 14 muscles pelviens. Audio E.',
                'source'      => 'Diane Lee — The Pelvic Girdle',
                'content'     => $t5,
            ],
            [
                'type'        => 'pratique',
                'title'       => 'Territoires VI & VII — Les Piliers & Les Pompes',
                'duration'    => '~35 min',
                'description' => 'Pilotes : VMO / Gastrocnémien. Os repères : Grand trochanter / Calcanéum. 18 + 5 muscles. Audios F & G.',
                'source'      => 'Kapandji Vol.2 · Michaud — Foot Orthoses',
                'content'     => $t6.$t7,
            ],
            [
                'type'        => 'pratique',
                'title'       => 'Territoire VIII — Le GPS Interne · Multifides / L5–S1',
                'duration'    => '~30 min',
                'description' => 'Muscle pilote : Multifides — "la boussole vertébrale". Os repère : L5–S1. Voyage sensoriel ascendant des 50 os repères. Audio H.',
                'source'      => 'Thomas Myers — Anatomy Trains · Netter Atlas 7e éd.',
                'content'     => $t8,
            ],
            [
                'type'        => 'lecture',
                'title'       => 'La Charpente — Voyage du Squelette (100 os)',
                'duration'    => '~30 min',
                'description' => 'Le squelette zone par zone : crâne (22 os) · colonne (33 vertèbres) · thorax · ceinture scapulaire · bassin · membres inférieurs. Voyage sensoriel ascendant des 26 repères essentiels.',
                'source'      => 'Frank Netter — Atlas d\'Anatomie Humaine 7e éd. · Gray\'s Anatomy',
                'content'     => $squelette,
            ],
            [
                'type'        => 'pratique',
                'title'       => 'Lire les Tensions — Nuque, Dos, Hanches, Sciatique',
                'duration'    => '~25 min',
                'description' => 'Pourquoi le corps se bloque (stress, sédentarité, compensation). Les 4 zones de tension les plus fréquentes. Lecture clinique de la sciatique.',
                'source'      => 'Travell & Simons — Myofascial Pain · Stuart McGill — Back Mechanic',
                'content'     => $tensions,
            ],
            [
                'type'        => 'lecture',
                'title'       => 'Les 6 Systèmes — Les Flux du Corps',
                'duration'    => '~25 min',
                'description' => 'Nerveux (nerf vague) · Respiratoire · Circulatoire · Digestif (2e cerveau) · Hormonal · Homéostasie. Audio I.',
                'source'      => 'Michael Gershon — The Second Brain · HeartMath · Candace Pert',
                'content'     => $systemes,
            ],
            [
                'type'        => 'pratique',
                'title'       => 'L\'Œil du Praticien — Observer, Adapter, Guider',
                'duration'    => '~30 min',
                'description' => 'Le regard en 4 couches (forme, mouvement, respiration, tonus). 3 principes d\'adaptation. 3 niveaux de guidage du souffle. Créer un espace de sécurité. Éthique du praticien Pause Souffle.',
                'content'     => $praticien,
            ],
            [
                'type'        => 'lecture',
                'title'       => 'Les 10 Règles de Sécurité — Le Code du Praticien',
                'duration'    => '~20 min',
                'description' => 'Ce que toutes les grandes écoles enseignent en premier : ne jamais forcer, respecter la douleur, aller lentement. Les 5 règles du corps, les 5 règles de la relation, et les 3 signaux d\'arrêt immédiat.',
                'content'     => $securite,
            ],
            [
                'type'        => 'exercice',
                'title'       => 'Intégration — Ma Carte des 8 Territoires',
                'duration'    => '~40 min',
                'description' => 'Schéma vierge : nommez le pilote et l\'os repère de chaque territoire. Identifiez vos 3 zones de déconnexion (column scan). Rédigez votre protocole 5-5-5 personnalisé par territoire.',
            ],
            [
                'type'        => 'reflexion',
                'title'       => 'Lettre au Corps — Après la Traversée',
                'duration'    => '~20 min',
                'description' => 'Commencez par : "Je t\'ai parcouru territoire par territoire. Voici ce que j\'ai trouvé dans tes 8 territoires..."',
            ],
        ];

        DB::table('formation_modules')
            ->where('slug', '00-comprendre-le-corps')
            ->update([
                'intro_text'  => "ANATOMIE VIVANTE — Le Manuel du Praticien Pause Souffle\n\n8 Territoires. 1 Muscle Pilote. 1 Os Repère. 1 Image Mentale. 1 Audio.\n\nLa vraie promesse : à la fin de ce module, vous habitez votre corps différemment. Vous reconnaissez immédiatement les 8 territoires. Vous pouvez poser la main sur n'importe quelle zone et savoir ce qui s'y passe.\n\nPas une liste à réciter. Une géographie vivante à ressentir.",
                'description' => '8 territoires · 1 muscle pilote + 1 os repère par territoire · 8 images mentales · 8 audios guidés. L\'anatomie ancrée de l\'intérieur — durablement.',
                'activities'  => json_encode($activities),
                'updated_at'  => now(),
            ]);

        $this->command->info('[FormationAnatomySeeder] ✓ Architecture complète — 17 activités : Introduction · Ouverture · 8 Territoires · Squelette · Tensions · 6 Systèmes · Praticien · 10 Règles · Intégration · Lettre.');
    }
}
