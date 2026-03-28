<?php

namespace App\Services\Mentorship;

/**
 * Calcule la répartition de la rémunération entre un mentor et son accompagné.
 *
 * ═══════════════════════════════════════════════════════════════════════════════
 * DISTINCTION FONDAMENTALE — deux types d'accompagnés
 * ═══════════════════════════════════════════════════════════════════════════════
 *
 * STAGIAIRE (trainee_type = 'student')
 * ─────────────────────────────────────
 * Étudiant en formation qui cherche un encadrement pratique.
 * BUT : acquérir de l'expérience réelle, enrichir son portfolio,
 *       obtenir un certificat de stage.
 * RÉMUNÉRATION : part progressive selon la complexité de la mission.
 * ┌─────────────────┬──────────────┬─────────────────┐
 * │ Difficulté      │ Part mentor  │ Part stagiaire  │
 * ├─────────────────┼──────────────┼─────────────────┤
 * │ beginner        │    90 %      │     10 %        │
 * │ intermediate    │    80 %      │     20 %        │
 * │ advanced        │    70 %      │     30 %        │
 * └─────────────────┴──────────────┴─────────────────┘
 * Le stagiaire paye déjà un abonnement ET contribue réellement.
 * La gratification progressive (10→30 %) est juste et motivante.
 *
 * FREELANCE JUNIOR (trainee_type = 'graduate')
 * ─────────────────────────────────────────────
 * Diplômé débutant qui veut lancer son activité freelance.
 * BUT : décrocher ses premiers clients, prouver sa valeur, être payé.
 * RÉMUNÉRATION : part progressive selon la complexité de la mission.
 * ┌─────────────────┬──────────────┬─────────────────┐
 * │ Difficulté      │ Part mentor  │ Part junior     │
 * ├─────────────────┼──────────────┼─────────────────┤
 * │ beginner        │    30 %      │     70 %        │
 * │ intermediate    │    50 %      │     50 %        │
 * │ advanced        │    70 %      │     30 %        │
 * └─────────────────┴──────────────┴─────────────────┘
 *
 * Dans les deux cas, la commission Junspro est prélevée EN PREMIER.
 * La répartition s'applique sur le montant NET (après commission).
 *
 * COMMISSION JUNSPRO (dégressive) :
 * ┌────────────────────────────────┬────────┐
 * │ Volume cumulé duo              │ Taux   │
 * ├────────────────────────────────┼────────┤
 * │ 0 – 2 000 €                    │  20 %  │
 * │ 2 001 – 10 000 €               │  16 %  │
 * │ 10 001 € et +                  │  12 %  │
 * └────────────────────────────────┴────────┘
 */
class MentorCompensationService
{
    // ─── Commission Junspro dégressive ────────────────────────────
    // S'applique sur le MONTANT BRUT avant tout partage.
    public const PLATFORM_RATES = [
        ['min' => 0,     'max' => 2000,  'rate' => 20],
        ['min' => 2000,  'max' => 10000, 'rate' => 16],
        ['min' => 10000, 'max' => null,  'rate' => 12],
    ];
    public const PLATFORM_DEFAULT_RATE = 20;

    // ─── Freelance junior : taux mentor selon difficulté ───────────
    private const JUNIOR_MENTOR_RATES = [
        'beginner'     => 30,
        'intermediate' => 50,
        'advanced'     => 70,
    ];

    // ─── Stagiaire : gratification progressive selon difficulté ──────
    // Logique symétrique au junior mais avec des taux plus faibles.
    // Le stagiaire paye un abonnement ET participe à la livraison.
    // beginner=10% / intermediate=20% / advanced=30% (part stagiaire)
    private const INTERN_RATES = [
        'beginner'     => 10,
        'intermediate' => 20,
        'advanced'     => 30,
    ];

    // ─── Labels et descriptions ───────────────────────────────────
    public const TRAINEE_TYPE_LABELS = [
        'student'  => 'Stagiaire',
        'graduate' => 'Freelance junior',
    ];

    public const DIFFICULTY_LABELS = [
        'beginner'     => 'Débutant',
        'intermediate' => 'Intermédiaire',
        'advanced'     => 'Avancé',
    ];

    public const JUNIOR_DIFFICULTY_DESCRIPTIONS = [
        'beginner' => [
            'mentor_role'  => 'Guide — oriente, questionne, débloque',
            'junior_role'  => 'Exécutant principal — réalise 70 % du travail',
            'examples'     => ['Landing page simple', 'Refonte UI', 'Script de base'],
        ],
        'intermediate' => [
            'mentor_role'  => 'Co-constructeur — co-conçoit, valide chaque étape',
            'junior_role'  => 'Binôme actif — développe en parité',
            'examples'     => ['Application CRUD', 'Campagne multi-canal', 'Intégration API'],
        ],
        'advanced' => [
            'mentor_role'  => 'Architecte & garant — conçoit la solution, porte la responsabilité client',
            'junior_role'  => 'Exécutant technique — implémente sous supervision étroite',
            'examples'     => ['Architecture microservices', 'Stratégie B2B', 'Système temps réel'],
        ],
    ];

    public const INTERN_DIFFICULTY_DESCRIPTIONS = [
        'beginner' => [
            'mentor_role' => 'Maître de stage — guide, débloque, enseigne les fondamentaux',
            'intern_role' => 'Apprenant actif — réalise des tâches encadrées pas à pas',
            'examples'    => ['Intégration HTML/CSS', 'Rédaction de contenu', 'Tests manuels'],
        ],
        'intermediate' => [
            'mentor_role' => 'Superviseur — co-conçoit, valide chaque livrable',
            'intern_role' => 'Contributeur — développe des fonctionnalités sous supervision',
            'examples'    => ['Composant front-end', 'Module backend simple', 'Analyse de données'],
        ],
        'advanced' => [
            'mentor_role' => 'Garant — porte la responsabilité, architecture la solution',
            'intern_role' => 'Exécutant avancé — implémente des parties techniques complexes',
            'examples'    => ['Intégration API tierce', 'Pipeline ETL', 'Module de paiement'],
        ],
    ];

    public const INTERN_DESCRIPTION = [
        'mentor_role' => 'Maître de stage — encadre, enseigne, valide les livrables',
        'intern_role' => 'Apprenant rémunéré — contribue à des projets réels et reçoit une gratification progressive',
        'value'       => 'Expérience professionnelle, certificat Junspro, portfolio, réseau, gratification 10–30 %',
        'compensation'=> 'Gratification progressive selon difficulté : 10 % (débutant) → 20 % (intermédiaire) → 30 % (avancé)',
    ];

    /**
     * Point d'entrée principal.
     *
     * @param  float  $grossAmount   Montant brut payé par le client (€)
     * @param  float  $platformRate  Commission Junspro (ex: 20 pour 20 %)
     * @param  string $difficulty    'beginner' | 'intermediate' | 'advanced'
     * @param  string $traineeType   'student' (stagiaire) | 'graduate' (freelance junior)
     */
    public function compute(
        float $grossAmount,
        float $platformRate,
        string $difficulty = 'intermediate',
        string $traineeType = 'graduate'
    ): array {
        $difficulty  = $this->sanitizeDifficulty($difficulty);
        $traineeType = $this->sanitizeTraineeType($traineeType);

        $platformFee = round($grossAmount * ($platformRate / 100), 2);
        $netAfterFee = round($grossAmount - $platformFee, 2);

        if ($traineeType === 'student') {
            // ── Stagiaire : gratification progressive par difficulté ──
            // Le stagiaire paye un abonnement ET livre de la valeur réelle.
            // Taux intern : 10 % (débutant) / 20 % (intermédiaire) / 30 % (avancé)
            $internSharePct = self::INTERN_RATES[$difficulty];
            $mentorSharePct = 100 - $internSharePct;
            $internAmount   = round($netAfterFee * ($internSharePct / 100), 2);
            $mentorAmount   = round($netAfterFee - $internAmount, 2);

            return [
                'trainee_type'      => 'student',
                'gross'             => $grossAmount,
                'platform_fee'      => $platformFee,
                'net_after_fee'     => $netAfterFee,
                'mentor_amount'     => $mentorAmount,
                'trainee_amount'    => $internAmount,
                'mentor_share_pct'  => $mentorSharePct,
                'trainee_share_pct' => $internSharePct,
                'difficulty'        => $difficulty,
                'is_paid_trainee'   => true,
                'model'             => 'internship_paid',
            ];
        }

        // ── Freelance junior : modèle rémunération progressive ───────
        $mentorSharePct  = self::JUNIOR_MENTOR_RATES[$difficulty];
        $juniorSharePct  = 100 - $mentorSharePct;
        $mentorAmount    = round($netAfterFee * ($mentorSharePct / 100), 2);
        $juniorAmount    = round($netAfterFee - $mentorAmount, 2);

        return [
            'trainee_type'      => 'graduate',
            'gross'             => $grossAmount,
            'platform_fee'      => $platformFee,
            'net_after_fee'     => $netAfterFee,
            'mentor_amount'     => $mentorAmount,
            'trainee_amount'    => $juniorAmount,
            'mentor_share_pct'  => $mentorSharePct,
            'trainee_share_pct' => $juniorSharePct,
            'difficulty'        => $difficulty,
            'is_paid_trainee'   => true,
            'model'             => 'freelance_junior',
        ];
    }

    /**
     * Renvoie tous les taux pour un freelance junior (affichage tableau).
     */
    public function getJuniorRates(): array
    {
        $rates = [];
        foreach (self::JUNIOR_MENTOR_RATES as $level => $mentorPct) {
            $rates[$level] = [
                'difficulty'        => $level,
                'label'             => self::DIFFICULTY_LABELS[$level],
                'mentor_share_pct'  => $mentorPct,
                'junior_share_pct'  => 100 - $mentorPct,
                'description'       => self::JUNIOR_DIFFICULTY_DESCRIPTIONS[$level],
            ];
        }
        return $rates;
    }

    /**
     * Retourne tous les taux pour un stagiaire (affichage tableau).
     */
    public function getInternRates(): array
    {
        $rates = [];
        foreach (self::INTERN_RATES as $level => $internPct) {
            $rates[$level] = [
                'difficulty'        => $level,
                'label'             => self::DIFFICULTY_LABELS[$level],
                'mentor_share_pct'  => 100 - $internPct,
                'intern_share_pct'  => $internPct,
                'description'       => self::INTERN_DIFFICULTY_DESCRIPTIONS[$level],
            ];
        }
        return $rates;
    }

    /**
     * Retourne le résumé du modèle pour un stagiaire.
     */
    public function getInternModel(): array
    {
        return [
            'is_paid'        => true,
            'rates'          => self::INTERN_RATES,
            'mentor_rates'   => array_map(fn($p) => 100 - $p, self::INTERN_RATES),
            'description'    => self::INTERN_DESCRIPTION,
        ];
    }

    public function getMentorSharePercent(string $difficulty, string $traineeType = 'graduate'): int
    {
        $difficulty = $this->sanitizeDifficulty($difficulty);
        if ($this->sanitizeTraineeType($traineeType) === 'student') {
            return 100 - self::INTERN_RATES[$difficulty];
        }
        return self::JUNIOR_MENTOR_RATES[$difficulty];
    }

    private function sanitizeDifficulty(string $d): string
    {
        return array_key_exists($d, self::JUNIOR_MENTOR_RATES) ? $d : 'intermediate';
    }

    /**
     * Renvoie le taux de commission Junspro applicable selon le volume cumulé du duo.
     *
     * @param  float $cumulativeVolume  Volume € cumulé du duo mentor/accompagné
     * @return int   Taux en % (20, 16 ou 12)
     */
    public function getPlatformRate(float $cumulativeVolume = 0): int
    {
        foreach (self::PLATFORM_RATES as $tier) {
            if ($tier['max'] === null || $cumulativeVolume < $tier['max']) {
                return $tier['rate'];
            }
        }
        return self::PLATFORM_DEFAULT_RATE;
    }

    /**
     * Retourne les critères objectifs qui permettent de qualifier un niveau de difficulté.
     * Utilisé pour afficher le guide de classification aux mentors et accompagnés.
     */
    public static function getDifficultyCriteria(): array
    {
        return [
            'beginner' => [
                'label'       => 'Débutant',
                'color'       => '#10b981',
                'autonomy'    => '70–80 % réalisable seul',
                'tech'        => 'Technologies déjà pratiquées',
                'scope'       => '1–2 livrables précis',
                'risk'        => 'Faible (facilement corrigeable)',
                'supervision' => 'Revue finale uniquement',
                'duration'    => '1–2 semaines',
                'examples'    => ['Page HTML/CSS', 'Rédaction de contenu', 'Script d\'export', 'Tests manuels'],
            ],
            'intermediate' => [
                'label'       => 'Intermédiaire',
                'color'       => '#f59e0b',
                'autonomy'    => '50–60 % réalisable seul',
                'tech'        => 'Partiellement maîtrisées ou 1ère appli réelle',
                'scope'       => '3–5 livrables interdépendants',
                'risk'        => 'Moyen (délai critique possible)',
                'supervision' => 'Revue régulière + déblocages',
                'duration'    => '2–4 semaines',
                'examples'    => ['App CRUD avec auth', 'Intégration API', 'Dashboard analytics', 'Campagne multi-canal'],
            ],
            'advanced' => [
                'label'       => 'Avancé',
                'color'       => '#ef4444',
                'autonomy'    => '30–40 % réalisable seul',
                'tech'        => 'Nouvelles ou stack spécifique client',
                'scope'       => '6+ livrables ou ambiguïté fonctionnelle',
                'risk'        => 'Élevé (impact business, sécurité)',
                'supervision' => 'Co-présence mentor tout au long',
                'duration'    => '4+ semaines',
                'examples'    => ['Architecture microservices', 'Système temps réel', 'Module paiement', 'Stratégie B2B'],
            ],
        ];
    }

    /**
     * Renvoie le pourcentage intern pour un niveau de difficulté donné.
     */
    public static function getInternSharePct(string $difficulty): int
    {
        return self::INTERN_RATES[$difficulty] ?? self::INTERN_RATES['intermediate'];
    }

    private function sanitizeTraineeType(string $t): string
    {
        return in_array($t, ['student', 'graduate'], true) ? $t : 'graduate';
    }
}

