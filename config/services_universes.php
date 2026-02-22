<?php

/**
 * Source unique de vérité : Univers (hub /services) → Domaines (Spécialisation).
 * Réutilisable par le hub, les vues et les contrôleurs.
 */

return [
    /*
    |--------------------------------------------------------------------------
    | Liste des 6 univers (hub /services) — slug => libellé
    |--------------------------------------------------------------------------
    */
    'universes' => [
        'projects' => 'Projet & Consulting',
        'lessons' => 'Cours & Tutorat',
        'at-home' => 'Rituals Services',
        'wellnesslive' => 'Ritual Motion',
        'homeswap' => 'Échange de logement',
        'corporate' => 'Présence',
    ],

    /*
    |--------------------------------------------------------------------------
    | Domaines (Spécialisation) par univers — universe_slug => [[slug, label], ...]
    |--------------------------------------------------------------------------
    */
    'domains_by_universe' => [
        'projects' => [
            ['strategie-conseil', 'Stratégie & Conseil'],
            ['marketing-croissance', 'Marketing & Croissance'],
            ['tech-produits-digitaux', 'Tech & Produits digitaux'],
            ['creation-image-marque', 'Création & Image de marque'],
            ['formation-accompagnement', 'Formation & Accompagnement'],
        ],
        'lessons' => [
            ['langues', 'Langues'],
            ['certifications', 'Certifications'],
            ['soutien-scolaire', 'Soutien scolaire'],
            ['etudes-superieur', 'Études & supérieur'],
            ['tech-outils', 'Tech & outils'],
            ['carriere-soft-skills', 'Carrière & soft skills'],
        ],
        'at-home' => [
            ['beaute-soins', 'Beauté & soins'],
            ['massage-relaxation', 'Massage & relaxation'],
            ['menage-repassage', 'Ménage & repassage'],
            ['bien-etre-sport', 'Bien-être & sport'],
            ['accompagnement', 'Accompagnement'],
        ],
        'wellnesslive' => [
            ['cardio-training', 'Cardio-Training'],
            ['renforcement-musculaire', 'Renforcement Musculaire'],
            ['bien-etre', 'Bien-Etre'],
            ['danse', 'Danse'],
        ],
        'homeswap' => [
            ['court-sejour', 'Court séjour'],
            ['moyen-sejour', 'Moyen séjour'],
            ['long-sejour', 'Long séjour'],
        ],
        'corporate' => [
            ['pause-souffle', 'Pause Souffle'],
            ['experiences-bien-etre-serinite', 'Expériences Bien-Être & Sérénité'],
            ['team-building-cohesion-qvt', 'Team Building & Cohésion (QVT)'],
            ['evenements-vie-celebrations', 'Événements de Vie & Célébrations'],
            ['vitalite-experiences-immersives', 'Vitalité & Expériences Immersives'],
            ['intervenants-experts-experience-humaine', 'Intervenants & Experts en Expérience Humaine'],
            ['partenaires-logistique-evenementielle', 'Partenaires & Logistique Événementielle'],
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Route par univers (pour redirection hub → page univers)
    |--------------------------------------------------------------------------
    */
    'routes' => [
        'projects' => 'services.projects',
        'lessons' => 'services.lessons',
        'at-home' => 'services.at-home',
        'wellnesslive' => 'services.wellnesslive',
        'homeswap' => 'services.homeswap',
        'corporate' => 'services.corporate',
    ],
];
