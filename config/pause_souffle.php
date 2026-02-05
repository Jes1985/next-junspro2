<?php

/**
 * Configuration pour Pause Souffle
 * 
 * Prices Stripe doivent être créés dans Stripe Dashboard et leurs IDs stockés ici.
 * Pour créer les prices dans Stripe :
 * - trial : one-time payment
 * - cycle_4w : subscription avec interval=week, interval_count=4
 * - cycle_3m : subscription avec interval=month, interval_count=3
 */

return [
    /*
    |--------------------------------------------------------------------------
    | Stripe Price IDs par plan
    |--------------------------------------------------------------------------
    |
    | Ces IDs doivent être créés dans Stripe Dashboard et configurés dans .env
    | Format recommandé : PAUSE_SOUFFLE_PRICE_TRIAL, PAUSE_SOUFFLE_PRICE_CYCLE_4W, etc.
    |
    */
    'stripe_prices' => [
        'trial' => env('PAUSE_SOUFFLE_PRICE_TRIAL', null), // 1 session - one-time
        // Packs cycles 4 semaines (subscription, interval=week, interval_count=4)
        'pack_1' => env('PAUSE_SOUFFLE_PRICE_PACK_1', null), // 1 rituel / 4 semaines
        'pack_2' => env('PAUSE_SOUFFLE_PRICE_PACK_2', null), // 2 rituels / 4 semaines
        'pack_4' => env('PAUSE_SOUFFLE_PRICE_PACK_4', null), // 4 rituels / 4 semaines
        'pack_8' => env('PAUSE_SOUFFLE_PRICE_PACK_8', null), // 8 rituels / 4 semaines
    ],

    /*
    |--------------------------------------------------------------------------
    | Labels des plans
    |--------------------------------------------------------------------------
    */
    'plan_labels' => [
        'trial' => 'Rituel d\'essai',
        'pack_1' => '1 rituel / 4 semaines',
        'pack_2' => '2 rituels / 4 semaines',
        'pack_4' => '4 rituels / 4 semaines',
        'pack_8' => '8 rituels / 4 semaines',
    ],

    /*
    |--------------------------------------------------------------------------
    | Mapping pack → rituels par cycle (4 semaines)
    |--------------------------------------------------------------------------
    */
    'pack_to_rituals_per_cycle' => [
        'pack_1' => 1,
        'pack_2' => 2,
        'pack_4' => 4,
        'pack_8' => 8,
    ],

    /*
    |--------------------------------------------------------------------------
    | Mapping pack → hours_per_week pour Subscription (utilise minimum 1)
    | Note: Le nombre réel de rituels est stocké dans metadata
    |--------------------------------------------------------------------------
    */
    'pack_to_hours_per_week' => [
        'pack_1' => 1, // Minimum pour compatibilité système
        'pack_2' => 1,
        'pack_4' => 1,
        'pack_8' => 2, // Minimum pour compatibilité système
    ],

    /*
    |--------------------------------------------------------------------------
    | Limite max rituels par cycle (pack + add-on)
    |--------------------------------------------------------------------------
    */
    'max_rituals_per_cycle' => 12,
];
