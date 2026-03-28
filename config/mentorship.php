<?php

/**
 * Configuration du module Mentorat — abonnements par cycle de 4 semaines
 *
 * Les Price IDs Stripe doivent être créés dans le Stripe Dashboard :
 *   - type : recurring / subscription
 *   - interval : week
 *   - interval_count : 4
 *
 * Ensuite, renseigner les IDs dans .env :
 *   MENTORSHIP_PRICE_CYCLE_1=price_xxxx   (49 €)
 *   MENTORSHIP_PRICE_CYCLE_2=price_xxxx   (89 €)
 *   MENTORSHIP_PRICE_CYCLE_4=price_xxxx   (159 €)
 */

return [

    /*
    |--------------------------------------------------------------------------
    | Stripe Price IDs par plan
    |--------------------------------------------------------------------------
    */
    'stripe_prices' => [
        'cycle_1' => env('MENTORSHIP_PRICE_CYCLE_1', null), // 49 €  / 4 semaines
        'cycle_2' => env('MENTORSHIP_PRICE_CYCLE_2', null), // 89 €  / 8 semaines
        'cycle_4' => env('MENTORSHIP_PRICE_CYCLE_4', null), // 159 € / 16 semaines
    ],

    /*
    |--------------------------------------------------------------------------
    | Noms & descriptions des plans
    |--------------------------------------------------------------------------
    */
    'plan_names' => [
        'cycle_1' => 'Découverte',
        'cycle_2' => 'Régulier',
        'cycle_4' => 'Engagement',
    ],

    'plan_descriptions' => [
        'cycle_1' => '1 cycle de 4 semaines — idéal pour tester le mentorat',
        'cycle_2' => '2 cycles (8 semaines) — rythme régulier, économisez 9 %',
        'cycle_4' => '4 cycles (16 semaines) — investissement complet, économisez 19 %',
    ],

    /*
    |--------------------------------------------------------------------------
    | Prix en euros (entiers) — affichage uniquement
    | Les montants réels sont définis dans le Stripe Dashboard sur les Price IDs
    |--------------------------------------------------------------------------
    */
    'plan_prices' => [
        'cycle_1' => 49,
        'cycle_2' => 89,
        'cycle_4' => 159,
    ],

    /*
    |--------------------------------------------------------------------------
    | Nombre de cycles de 4 semaines par plan
    |--------------------------------------------------------------------------
    */
    'plan_cycles' => [
        'cycle_1' => 1,
        'cycle_2' => 2,
        'cycle_4' => 4,
    ],

    /*
    |--------------------------------------------------------------------------
    | Économies affichées (en %)
    |--------------------------------------------------------------------------
    */
    'plan_savings' => [
        'cycle_1' => 0,
        'cycle_2' => 9,
        'cycle_4' => 19,
    ],

    /*
    |--------------------------------------------------------------------------
    | Avantages inclus par plan
    |--------------------------------------------------------------------------
    */
    'plan_features' => [
        'cycle_1' => [
            'Accès à 1 pod de mentorat',
            'Missions + jalons suivis',
            'Check-ins hebdomadaires',
            'Attestation de participation',
        ],
        'cycle_2' => [
            'Accès à 1 pod de mentorat',
            'Missions + jalons suivis',
            'Check-ins hebdomadaires',
            'Certificat de validation',
            'Priorité candidature',
        ],
        'cycle_4' => [
            'Accès à 2 pods simultanés',
            'Missions + jalons suivis',
            'Check-ins hebdomadaires',
            'Certificat de validation',
            'Priorité candidature',
            'Badge Engagement affiché sur profil',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Plan mis en avant (popular)
    |--------------------------------------------------------------------------
    */
    'popular_plan' => 'cycle_2',

    /*
    |--------------------------------------------------------------------------
    | Modèle de compensation mentor / stagiaire
    |
    | Ces pourcentages s'appliquent sur le montant NET (après commission Junspro).
    | La commission Junspro est calculée par PricingService selon le volume cumulé
    | du duo mentor/stagiaire (20% → 16% → 12%).
    |
    | Inspiré de MentorCruise (70-80% au mentor sur projets avancés),
    | Leland (80% au coach), Topmate (90% au créateur).
    |--------------------------------------------------------------------------
    */
    'compensation' => [
        'difficulty_rates' => [
            'beginner'     => ['mentor' => 30, 'trainee' => 70],   // stagiaire autonome, mentor guide
            'intermediate' => ['mentor' => 50, 'trainee' => 50],   // co-construction équilibrée
            'advanced'     => ['mentor' => 70, 'trainee' => 30],   // mentor architecte, porte la responsabilité
        ],
        'difficulty_labels' => [
            'beginner'     => 'Débutant',
            'intermediate' => 'Intermédiaire',
            'advanced'     => 'Avancé',
        ],
        // Part minimale garantie au mentor même sur projets simples (floor)
        'mentor_minimum_pct' => 30,
        // Part maximale du mentor (ceiling) — ne jamais dépasser 70%
        'mentor_maximum_pct' => 70,
    ],

    /*
    |--------------------------------------------------------------------------
    | Commission Junspro (dégressive selon volume cumulé du duo)
    |
    | La commission s'applique sur le MONTANT BRUT payé par le client.
    | Elle est prélevée EN PREMIER avant tout partage mentor/accompagné.
    | Paliers calculés sur le volume cumulé du duo (mentor + 1 accompagné).
    |--------------------------------------------------------------------------
    */
    'platform_commission' => [
        'tiers' => [
            // Palier 1 : 0 – 2 000 € cumulés → 20 %
            ['min' => 0,     'max' => 2000,  'rate' => 20],
            // Palier 2 : 2 001 – 10 000 € cumulés → 16 %
            ['min' => 2000,  'max' => 10000, 'rate' => 16],
            // Palier 3 : 10 001 € + → 12 %
            ['min' => 10000, 'max' => null,  'rate' => 12],
        ],
        'default_rate' => 20,     // Taux initial (avant premier seuil)
        'labels' => [
            20 => 'Démarrage (0 – 2 000 € cumulés)',
            16 => 'Partenaire (2 001 – 10 000 € cumulés)',
            12 => 'Expert (10 001 € et +)',
        ],
    ],

];
