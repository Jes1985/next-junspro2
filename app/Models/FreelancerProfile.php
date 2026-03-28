<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class FreelancerProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'hourly_rate',
        'reliability_score',
        'wellness_plan',
        'bio',
        'profile_title',
        'introduction',
        'experience',
        'motivation',
        'video_thumbnail_url',
        'video_url',
        'skills',
        'universes',
        'domains',
        'can_online',
        'can_onsite',
        'onsite_country',
        'onsite_city',
        'native_language',
        'spoken_languages',
        'matching_filters',
        'additional_specialization_ids',
        'languages',
        'certifications',
        'certificate_files',
        'university',
        'degree',
        'degree_type',
        'specialization',
        'study_start_year',
        'study_end_year',
        'no_degree',
        'diploma_files',
        'timezone',
        'is_verified',
        'identity_document',
        'bank_iban',
        'bank_account_holder',
        'bank_country',
        'bank_routing',
        'bank_type',
        'is_mentor',
        'mentor_capacity',
        'mentor_status',
        'mentor_quality_score',
        'mentor_domains',
        'mentor_bio',
        'mentor_motivation',
        'mentor_years_experience',
        'mentor_linkedin_url',
        'mentor_rate_override',
        // HomeSwap scoring fields (anciens)
        'homeswap_property_type',
        'homeswap_bedrooms',
        'homeswap_beds_real',
        'homeswap_beds_extra',
        'homeswap_outdoor',
        'homeswap_parking',
        'homeswap_pool',
        'homeswap_wifi_quality',
        'homeswap_wifi_mbps',
        'homeswap_climate',
        'homeswap_bathrooms',
        'homeswap_score',
        'homeswap_points_per_night',
        // HomeSwap scoring fields (nouveaux)
        'homeswap_housing_type',
        'homeswap_sleep_capacity',
        'homeswap_has_balcony',
        'homeswap_has_terrace',
        'homeswap_has_garden',
        'homeswap_parking_type',
        'homeswap_has_pool',
        'homeswap_has_wifi',
        'homeswap_has_heating',
        'homeswap_has_ac',
        'homeswap_near_transport',
        'homeswap_near_shops',
        'homeswap_quiet_area',
    ];

    protected $casts = [
        'hourly_rate' => 'decimal:2',
        'reliability_score' => 'integer',
        'skills' => 'array',
        'universes' => 'array',
        'domains' => 'array',
        'can_online' => 'boolean',
        'can_onsite' => 'boolean',
        'matching_filters' => 'array',
        'additional_specialization_ids' => 'array',
        'languages' => 'array',
        'certifications' => 'array',
        'certificate_files' => 'array',
        'study_start_year' => 'integer',
        'study_end_year' => 'integer',
        'no_degree' => 'boolean',
        'diploma_files' => 'array',
        'is_verified' => 'boolean',
        'is_mentor' => 'boolean',
        'mentor_capacity' => 'integer',
        'mentor_quality_score' => 'integer',
        'mentor_domains' => 'array',
        'mentor_years_experience' => 'integer',
        // HomeSwap scoring casts
        'homeswap_bedrooms' => 'integer',
        'homeswap_beds_real' => 'integer',
        'homeswap_beds_extra' => 'integer',
        'homeswap_wifi_mbps' => 'integer',
        'homeswap_bathrooms' => 'integer',
        'homeswap_score' => 'integer',
        'homeswap_points_per_night' => 'integer',
        'homeswap_sleep_capacity' => 'integer',
        'homeswap_has_balcony' => 'boolean',
        'homeswap_has_terrace' => 'boolean',
        'homeswap_has_garden' => 'boolean',
        'homeswap_has_pool' => 'boolean',
        'homeswap_has_wifi' => 'boolean',
        'homeswap_has_heating' => 'boolean',
        'homeswap_has_ac' => 'boolean',
        'homeswap_near_transport' => 'boolean',
        'homeswap_near_shops' => 'boolean',
        'homeswap_quiet_area' => 'boolean',
    ];

    /**
     * Relation avec User
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Conversations lead (pré-booking) du freelance.
     */
    public function leadConversations(): HasMany
    {
        return $this->hasMany(LeadConversation::class, 'freelancer_id');
    }

    /**
     * Abonnements où ce freelance travaille
     */
    public function subscriptions(): HasMany
    {
        return $this->hasMany(Subscription::class, 'freelancer_id');
    }

    /**
     * Pods de tutorat créés par ce freelance (via User)
     */
    public function mentorshipPods(): HasManyThrough
    {
        return $this->hasManyThrough(
            MentorshipPod::class,
            User::class,
            'id',
            'mentor_user_id',
            'user_id',
            'id'
        );
    }

    /**
     * Créneaux de calendrier
     */
    public function calendarSlots(): HasMany
    {
        return $this->hasMany(CalendarSlot::class, 'freelancer_id');
    }

    /**
     * Reprogrammations demandées
     */
    public function rebookings(): HasMany
    {
        return $this->hasMany(Rebooking::class, 'requested_by');
    }

    /**
     * Demandes de transfert (ancien freelance)
     */
    public function transferRequestsAsOld(): HasMany
    {
        return $this->hasMany(TransferRequest::class, 'old_freelancer_id');
    }

    /**
     * Demandes de transfert (nouveau freelance)
     */
    public function transferRequestsAsNew(): HasMany
    {
        return $this->hasMany(TransferRequest::class, 'new_freelancer_id');
    }

    /**
     * Services premium
     */
    public function premiumServices(): HasMany
    {
        return $this->hasMany(PremiumService::class, 'owner_id')
            ->where('owner_type', 'freelance');
    }

    /**
     * Langues parlées avec niveaux
     */
    public function languages(): HasMany
    {
        return $this->hasMany(FreelancerLanguage::class, 'freelancer_id');
    }

    /**
     * Calcule le score HomeSwap (0-100) et les points/nuit estimés
     * 
     * @return array ['score' => int, 'points_per_night' => int, 'breakdown' => array]
     */
    public function computeHomeswapScore(): array
    {
        $breakdown = [
            'type' => 0,
            'bedrooms' => 0,
            'beds' => 0,
            'outdoor' => 0,
            'parking' => 0,
            'pool' => 0,
            'comfort' => 0,
            'wifi' => 0,
            'climate' => 0,
            'bathrooms' => 0,
        ];

        // 1) Type de logement /15
        $typeScores = [
            'room' => 6,
            'studio' => 8,
            'apartment' => 11,
            'house' => 13,
            'villa' => 14,
            'penthouse' => 15,
        ];
        $breakdown['type'] = $typeScores[$this->homeswap_property_type] ?? 0;

        // 2) Chambres /20
        $bedrooms = (int)($this->homeswap_bedrooms ?? 0);
        if ($bedrooms === 0) {
            $breakdown['bedrooms'] = 4;
        } elseif ($bedrooms === 1) {
            $breakdown['bedrooms'] = 10;
        } elseif ($bedrooms === 2) {
            $breakdown['bedrooms'] = 14;
        } elseif ($bedrooms === 3) {
            $breakdown['bedrooms'] = 17;
        } elseif ($bedrooms === 4) {
            $breakdown['bedrooms'] = 19;
        } else {
            $breakdown['bedrooms'] = 20;
        }

        // 3) Couchages /20
        $bedsReal = (int)($this->homeswap_beds_real ?? 0);
        $bedsExtra = (int)($this->homeswap_beds_extra ?? 0);
        $bedsRealScore = min(16, $bedsReal * 4);
        $bedsExtraScore = min(4, $bedsExtra * 2);
        $breakdown['beds'] = min(20, $bedsRealScore + $bedsExtraScore);

        // 4) Extérieur /10
        $outdoorScores = [
            'none' => 0,
            'balcony' => 5,
            'terrace' => 7,
            'garden' => 8,
            'terrace_garden' => 10,
        ];
        $breakdown['outdoor'] = $outdoorScores[$this->homeswap_outdoor] ?? 0;

        // 5) Stationnement /5
        $parkingScores = [
            'none' => 0,
            'nearby_easy' => 2,
            'private_spot' => 4,
            'garage' => 5,
        ];
        $breakdown['parking'] = $parkingScores[$this->homeswap_parking] ?? 0;

        // 6) Piscine /5
        $poolScores = [
            'none' => 0,
            'shared' => 2,
            'private' => 4,
            'private_heated' => 5,
        ];
        $breakdown['pool'] = $poolScores[$this->homeswap_pool] ?? 0;

        // 7) Confort intérieur /25
        // A) WiFi /12
        if ($this->homeswap_wifi_mbps !== null) {
            $mbps = (int)$this->homeswap_wifi_mbps;
            if ($mbps < 10) {
                $breakdown['wifi'] = 0;
            } elseif ($mbps <= 30) {
                $breakdown['wifi'] = 4;
            } elseif ($mbps <= 100) {
                $breakdown['wifi'] = 8;
            } else {
                $breakdown['wifi'] = 12;
            }
        } else {
            $wifiQualityScores = [
                'basic' => 4,
                'good' => 8,
                'excellent' => 12,
            ];
            $breakdown['wifi'] = $wifiQualityScores[$this->homeswap_wifi_quality] ?? 0;
        }

        // B) Clim/chauffage /8
        $climateScores = [
            'temperate' => 4,
            'heating' => 6,
            'ac' => 6,
            'both' => 8,
        ];
        $breakdown['climate'] = $climateScores[$this->homeswap_climate] ?? 0;

        // C) Salles de bain /5
        $bathrooms = (int)($this->homeswap_bathrooms ?? 0);
        if ($bathrooms === 0) {
            $breakdown['bathrooms'] = 0;
        } elseif ($bathrooms === 1) {
            $breakdown['bathrooms'] = 3;
        } elseif ($bathrooms === 2) {
            $breakdown['bathrooms'] = 4;
        } else {
            $breakdown['bathrooms'] = 5;
        }

        $breakdown['comfort'] = $breakdown['wifi'] + $breakdown['climate'] + $breakdown['bathrooms'];

        // Score total
        $score = $breakdown['type'] + $breakdown['bedrooms'] + $breakdown['beds'] 
               + $breakdown['outdoor'] + $breakdown['parking'] + $breakdown['pool'] 
               + $breakdown['comfort'];
        $score = max(0, min(100, $score)); // Clamp 0-100

        // Points/nuit estimés
        $pointsPerNight = round(25 + ($score * 0.75));
        $pointsPerNight = max(25, min(100, $pointsPerNight)); // Clamp 25-100

        return [
            'score' => $score,
            'points_per_night' => $pointsPerNight,
            'breakdown' => $breakdown,
        ];
    }

    /**
     * Boot method pour calculer automatiquement le score HomeSwap
     */
    protected static function boot()
    {
        parent::boot();

        static::saving(function ($freelancer) {
            // Vérifier si au moins un champ HomeSwap est renseigné
            $homeswapFields = [
                'homeswap_property_type',
                'homeswap_bedrooms',
                'homeswap_beds_real',
                'homeswap_beds_extra',
                'homeswap_outdoor',
                'homeswap_parking',
                'homeswap_pool',
                'homeswap_wifi_quality',
                'homeswap_wifi_mbps',
                'homeswap_climate',
                'homeswap_bathrooms',
            ];

            $hasHomeswapData = false;
            $hasHomeswapChanges = false;

            foreach ($homeswapFields as $field) {
                if ($freelancer->$field !== null) {
                    $hasHomeswapData = true;
                }
                if ($freelancer->isDirty($field)) {
                    $hasHomeswapChanges = true;
                }
            }

            // Si on a des données HomeSwap ET qu'un champ a changé, recalculer
            if ($hasHomeswapData && ($hasHomeswapChanges || $freelancer->homeswap_property_type !== null)) {
                $result = $freelancer->computeHomeswapScore();
                $freelancer->homeswap_score = $result['score'];
                $freelancer->homeswap_points_per_night = $result['points_per_night'];
            }
        });
    }
}

