<?php

return [
    'logic_groups' => [
        1 => [
            'label' => 'Profil Public Offres et Univers',
            'route_steps' => [1, 2],
        ],
        2 => [
            'label' => 'Positionnement & expertise',
            'route_steps' => [3, 4, 5, 6],
        ],
        3 => [
            'label' => 'Disponibilités & conditions',
            'route_steps' => [7],
        ],
        4 => [
            'label' => "Vérification d'identité & paiement",
            'route_steps' => [8],
        ],
    ],

    'routes' => [
        1 => ['route_name' => 'freelance.onboarding.step1', 'label' => 'Profil Public Offres et Univers'],
        2 => ['route_name' => 'freelance.onboarding.step2', 'label' => 'Positionnement & expertise'],
        4 => ['route_name' => 'freelance.onboarding.step4', 'label' => 'Formation'],
        5 => ['route_name' => 'freelance.onboarding.step5', 'label' => 'Description du profil'],
        6 => ['route_name' => 'freelance.onboarding.step6', 'label' => 'Disponibilités & conditions'],
        7 => ['route_name' => 'freelance.onboarding.step7', 'label' => 'Vérification'],
        8 => ['route_name' => 'freelance.onboarding.step8', 'label' => 'Paiement'],
    ],
];
