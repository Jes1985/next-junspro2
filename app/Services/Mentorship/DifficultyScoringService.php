<?php

namespace App\Services\Mentorship;

/**
 * Service d'évaluation OBJECTIVE de la difficulté d'une mission.
 *
 * Remplace la décision unilatérale (mentor ou accompagné) par un
 * questionnaire structuré à 5 critères factuels, chacun noté 1–3.
 *
 * ═══════════════════════════════════════════════════════════
 * POURQUOI UN SCORE ET NON UNE DÉCISION HUMAINE ?
 * ═══════════════════════════════════════════════════════════
 * • Mentor qui décide → tendance à classer "avancé" (il gagne plus)
 * • Accompagné qui décide → tendance à classer "débutant" (il gagne plus)
 * • Score automatique → neutre, reproductible, transparent, incontestable
 *
 * ═══════════════════════════════════════════════════════════
 * GRILLE DE SCORE
 * ═══════════════════════════════════════════════════════════
 * 11 critères × 1–3 points chacun = score total entre 11 et 33
 * ┌─────────────────────┬─────────────────────────────────────┐
 * │ Score total         │ Niveau                              │
 * ├─────────────────────┼─────────────────────────────────────┤
 * │ 11 – 17             │ Débutant                            │
 * │ 18 – 25             │ Intermédiaire                       │
 * │ 26 – 33             │ Avancé                              │
 * └─────────────────────┴─────────────────────────────────────┘
 *
 * RÉMUNÉRATION RÉSULTANTE
 * ┌──────────────────┬──────────────┬──────────────────────────┐
 * │ Niveau           │ Stagiaire    │ Freelance Junior         │
 * ├──────────────────┼──────────────┼──────────────────────────┤
 * │ Débutant         │ 20 % du net  │ 50 % du net              │
 * │ Intermédiaire    │ 30 % du net  │ 60 % du net              │
 * │ Avancé           │ 40 % du net  │ 70 % du net              │
 * └──────────────────┴──────────────┴──────────────────────────┘
 *
 * BONUS APPORTEUR DE MISSION (+10 % uniforme)
 * ┌──────────────────┬──────────────┬──────────────────────────┐
 * │ Niveau           │ Stagiaire    │ Freelance Junior         │
 * ├──────────────────┼──────────────┼──────────────────────────┤
 * │ Débutant         │ 30 % (+10)   │ 60 % (+10)               │
 * │ Intermédiaire    │ 40 % (+10)   │ 70 % (+10)               │
 * │ Avancé           │ 50 % (+10)   │ 80 % (+10)               │
 * └──────────────────┴──────────────┴──────────────────────────┘
 */
class DifficultyScoringService
{
    /**
     * Les 5 critères d'évaluation avec leurs 3 options.
     * 'value' : 1 = débutant, 2 = intermédiaire, 3 = avancé
     */
    public const CRITERIA = [
        'autonomy' => [
            'icon'     => '💪',
            'label'    => 'Autonomie',
            'question' => 'Quelle proportion de la mission pensez-vous pouvoir réaliser seul·e ?',
            'options'  => [
                ['value' => 1, 'emoji' => '🙋', 'label' => '+ de 70 % seul·e',   'desc' => 'Je maîtrise bien le sujet'],
                ['value' => 2, 'emoji' => '🤝', 'label' => '50 – 70 % seul·e',   'desc' => 'Aide ponctuelle nécessaire'],
                ['value' => 3, 'emoji' => '🧭', 'label' => '- de 50 % seul·e',   'desc' => 'Sujet majoritairement nouveau'],
            ],
        ],
        'technology' => [
            'icon'     => '⚙️',
            'label'    => 'Technologies',
            'question' => 'Comment maîtrisez-vous les technologies requises pour cette mission ?',
            'options'  => [
                ['value' => 1, 'emoji' => '🛠️', 'label' => 'Toutes maîtrisées',         'desc' => 'Utilisées depuis + de 6 mois'],
                ['value' => 2, 'emoji' => '🔧', 'label' => 'Partiellement maîtrisées', 'desc' => 'Au moins une est nouvelle'],
                ['value' => 3, 'emoji' => '🚀', 'label' => 'Majoritairement nouvelles','desc' => 'Stack imposée par le client'],
            ],
        ],
        'scope' => [
            'icon'     => '📋',
            'label'    => 'Périmètre',
            'question' => 'Combien de livrables distincts cette mission comporte-t-elle ?',
            'options'  => [
                ['value' => 1, 'emoji' => '🎯', 'label' => '1 – 2 livrables',          'desc' => 'Clairement définis'],
                ['value' => 2, 'emoji' => '📦', 'label' => '3 – 5 livrables',          'desc' => 'Liés et interdépendants'],
                ['value' => 3, 'emoji' => '📚', 'label' => '6+ ou spécs incomplètes',  'desc' => 'Périmètre évolutif'],
            ],
        ],
        'risk' => [
            'icon'     => '⚡',
            'label'    => 'Risque client',
            'question' => "Quel est l'impact si quelque chose tourne mal sur cette mission ?",
            'options'  => [
                ['value' => 1, 'emoji' => '😌', 'label' => 'Faible', 'desc' => 'Erreur facilement corrigeable'],
                ['value' => 2, 'emoji' => '😬', 'label' => 'Moyen',  'desc' => 'Délai critique ou intégration clé'],
                ['value' => 3, 'emoji' => '🔥', 'label' => 'Élevé', 'desc' => 'Impact financier, sécurité ou réputation'],
            ],
        ],
        'supervision' => [
            'icon'     => '👁️',
            'label'    => 'Supervision',
            'question' => 'Quel niveau de supervision pensez-vous nécessiter sur cette mission ?',
            'options'  => [
                ['value' => 1, 'emoji' => '📬', 'label' => 'Revue finale',        'desc' => 'Je livre, le mentor valide'],
                ['value' => 2, 'emoji' => '📅', 'label' => 'Check-ins réguliers', 'desc' => '1 à 2 fois par semaine'],
                ['value' => 3, 'emoji' => '🔄', 'label' => 'Présence continue',   'desc' => 'Déblocages fréquents nécessaires'],
            ],
        ],

        // ── Profil de l'accompagné (6 critères supplémentaires) ────────

        'native_language' => [
            'icon'     => '🗣️',
            'label'    => 'Langue maternelle',
            'question' => 'Quelle est votre langue maternelle ?',
            'options'  => [
                ['value' => 1, 'emoji' => '🇫🇷', 'label' => 'Français',                   'desc' => 'Communication native, aucune barrière linguistique'],
                ['value' => 2, 'emoji' => '🌍', 'label' => 'Autre langue latine',          'desc' => 'Espagnol, italien, portugais — adaptation rapide'],
                ['value' => 3, 'emoji' => '🌏', 'label' => 'Autre langue',                 'desc' => 'Langue non-latine ou très éloignée du français'],
            ],
        ],

        'english_level' => [
            'icon'     => '🇬🇧',
            'label'    => 'Anglais technique',
            'question' => "Quel est votre niveau d'anglais technique (documentation, README, forums) ?",
            'options'  => [
                ['value' => 1, 'emoji' => '🚀', 'label' => 'Courant / Bilingue',    'desc' => 'Je lis et comprends toute documentation sans effort'],
                ['value' => 2, 'emoji' => '📖', 'label' => 'Intermédiaire',          'desc' => "Je comprends l'essentiel, je me débrouille seul"],
                ['value' => 3, 'emoji' => '📚', 'label' => 'Débutant / Scolaire',   'desc' => "J'ai besoin d'aide pour les ressources en anglais"],
            ],
        ],

        'autodidact' => [
            'icon'     => '🔍',
            'label'    => 'Autodidaxie',
            'question' => 'Quand vous rencontrez un problème technique, quel est votre premier réflexe ?',
            'options'  => [
                ['value' => 1, 'emoji' => '🕵️', 'label' => 'Je cherche toujours seul en premier', 'desc' => 'Google, docs, forums — je trouve avant de demander'],
                ['value' => 2, 'emoji' => '⚖️', 'label' => 'Je cherche, puis je demande si besoin','desc' => "Je tente 30 min, puis j'escalade si bloqué"],
                ['value' => 3, 'emoji' => '🙋', 'label' => "Je demande rapidement de l'aide",       'desc' => "Je préfère validation du mentor avant de m'engager"],
            ],
        ],

        'communication' => [
            'icon'     => '📢',
            'label'    => 'Communication proactive',
            'question' => 'Comment gérez-vous la communication quand vous sentez un risque de retard ou un blocage ?',
            'options'  => [
                ['value' => 1, 'emoji' => '⏰', 'label' => "Je préviens toujours en avance",   'desc' => "Dès que je sens un risque, j'alerte mon mentor"],
                ['value' => 2, 'emoji' => '💬', 'label' => 'Je communique, mais parfois tard',  'desc' => 'Je signale le problème quand il est confirmé'],
                ['value' => 3, 'emoji' => '🤫', 'label' => "J'attends qu'on me demande",        'desc' => 'Je gère dans mon coin et je rapporte en fin de sprint'],
            ],
        ],

        'time_management' => [
            'icon'     => '⏱️',
            'label'    => 'Gestion du temps',
            'question' => 'Comment organisez-vous votre travail et vos priorités au quotidien ?',
            'options'  => [
                ['value' => 1, 'emoji' => '📅', 'label' => 'Autonome — je gère seul mes priorités', 'desc' => 'Todo list, deadlines, planning : rigoureux sans rappel'],
                ['value' => 2, 'emoji' => '🗓️', 'label' => 'Cadré — un point hebdo me suffit',      'desc' => 'Je fonctionne bien avec un rituel de synchronisation'],
                ['value' => 3, 'emoji' => '🆘', 'label' => 'Guidé — je priorise mal sans aide',     'desc' => "Je me disperse ou procrastine sans supervision proche"],
            ],
        ],

        'learning_speed' => [
            'icon'     => '⚡',
            'label'    => "Vitesse d'apprentissage",
            'question' => "Combien de temps vous faut-il pour être opérationnel sur un nouvel outil ou framework ?",
            'options'  => [
                ['value' => 1, 'emoji' => '🏎️', 'label' => '1 à 2 jours de pratique',              'desc' => 'Je lis la doc, je fais un tuto et je suis autonome'],
                ['value' => 2, 'emoji' => '🚗',  'label' => 'Environ une semaine avec guidage',     'desc' => 'Quelques points de synchro suffisent à me lancer'],
                ['value' => 3, 'emoji' => '🚶',  'label' => 'Plusieurs semaines accompagné',        'desc' => "J'ai besoin d'un suivi prolongé pour être à l'aise"],
            ],
        ],
    ];

    /** Seuils score → niveau (11 critères × 1-3 = 11-33) */
    public const THRESHOLDS = [
        ['level' => 'beginner',     'min' => 11, 'max' => 17, 'label' => 'Débutant',      'color' => '#06b6d4', 'emoji' => '🌱'],
        ['level' => 'intermediate', 'min' => 18, 'max' => 25, 'label' => 'Intermédiaire', 'color' => '#3b82f6', 'emoji' => '⚡'],
        ['level' => 'advanced',     'min' => 26, 'max' => 33, 'label' => 'Avancé',        'color' => '#7c3aed', 'emoji' => '🏆'],
    ];

    /** Taux de gratification stagiaire (% du net) selon niveau */
    public const INTERN_RATES = [
        'beginner'     => 20, // Plancher garanti — minimum motivant
        'intermediate' => 30, // +10 pts : progression visible (24 € sur 300 € brut)
        'advanced'     => 40, // +10 pts : effort exceptionnel reconnu
    ];

    /** Taux de rémunération freelance junior (% du net) selon niveau */
    public const JUNIOR_RATES = [
        'beginner'     => 50, // Mission simple : junior autonome, valeur prouvée
        'intermediate' => 60, // Mission médiane : compétences reconnues
        'advanced'     => 70, // Mission complexe : expertise maximale récompensée
    ];

    /**
     * ─── BONUS APPORTEUR DE MISSION ─────────────────────────────────────────
     *
     * Règle unique et symétrique : apporter une mission = +10 % quel que soit
     * le niveau de difficulté, pour le stagiaire comme pour le junior.
     *
     * ┌──────────────────┬─────────────┬──────────────┬─────────────┬──────────────┐
     * │ Niveau mission   │ Stage std   │ Stage deal   │ Junior std  │ Junior deal  │
     * ├──────────────────┼─────────────┼──────────────┼─────────────┼──────────────┤
     * │ Débutant         │ 20 %        │ 30 % (+10)   │ 50 %        │ 60 % (+10)   │
     * │ Intermédiaire    │ 30 %        │ 40 % (+10)   │ 60 %        │ 70 % (+10)   │
     * │ Avancé           │ 40 %        │ 50 % (+10)   │ 70 %        │ 80 % (+10)   │
     * └──────────────────┴─────────────┴──────────────┴─────────────┴──────────────┘
     *
     * La symétrie +10 pts pour tous rend la règle simple, mémorisable et
     * incontestable. Validation mentor requise avant application (anti-abus).
     */
    public const DEAL_BRINGER_INTERN_RATES = [
        'beginner'     => 30, // +10 sur 20 %
        'intermediate' => 40, // +10 sur 30 %
        'advanced'     => 50, // +10 sur 40 %
    ];

    public const DEAL_BRINGER_JUNIOR_RATES = [
        'beginner'     => 60, // +10 sur 50 %
        'intermediate' => 70, // +10 sur 60 %
        'advanced'     => 80, // +10 sur 70 %
    ];

    /**
     * Calcule le niveau à partir d'un tableau de scores.
     *
     * @param  array $scores  ex: ['autonomy' => 1, 'technology' => 2, ...]
     * @return string  'beginner' | 'intermediate' | 'advanced'
     */
    public function computeLevel(array $scores): string
    {
        $total = (int) array_sum(array_values($scores));
        foreach (self::THRESHOLDS as $threshold) {
            if ($total >= $threshold['min'] && $total <= $threshold['max']) {
                return $threshold['level'];
            }
        }
        return 'intermediate';
    }

    /**
     * Rapport complet : score + niveau + rémunération.
     *
     * @param  array $scores     Réponses du questionnaire
     * @param  float $grossAmount  Montant brut exemple (pour calcul illustratif)
     * @param  float $platformRate Commission Junspro (%)
     */
    public function computeReport(array $scores, float $grossAmount = 300, float $platformRate = 20): array
    {
        $total   = (int) array_sum(array_values($scores));
        $level   = $this->computeLevel($scores);
        $t       = collect(self::THRESHOLDS)->firstWhere('level', $level);
        $net     = round($grossAmount * (1 - $platformRate / 100), 2);

        return [
            'total'        => $total,
            'max'          => 33,
            'level'        => $level,
            'label'        => $t['label'],
            'color'        => $t['color'],
            'emoji'        => $t['emoji'],
            'intern_rate'  => self::INTERN_RATES[$level],
            'junior_rate'  => self::JUNIOR_RATES[$level],
            'intern_amount'=> round($net * self::INTERN_RATES[$level] / 100, 2),
            'junior_amount'=> round($net * self::JUNIOR_RATES[$level] / 100, 2),
            'example_gross'=> $grossAmount,
            'example_net'  => $net,
            'scores'       => $scores,
        ];
    }

    /**
     * Données sérialisables pour le widget JS frontend.
     */
    public static function getWidgetData(): array
    {
        return [
            'criteria'                => self::CRITERIA,
            'thresholds'              => self::THRESHOLDS,
            'internRates'             => self::INTERN_RATES,
            'juniorRates'             => self::JUNIOR_RATES,
            'dealBringerInternRates'  => self::DEAL_BRINGER_INTERN_RATES,
            'dealBringerJuniorRates'  => self::DEAL_BRINGER_JUNIOR_RATES,
        ];
    }
}
