<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mission extends Model
{
    use HasFactory;

    protected $table = 'missions';
    protected $primaryKey = 'id_mission';

    protected $fillable = [
        'client_nom',
        'client_email',
        'client_telephone',
        'univers_slug',
        'about_you',
        'details',
        'preferred_contact',
        'language',
        'location_mode',
        'description_mission',
        'offre',
        'budget',
        'bonus',
        'statut',
        'calendly_link',
        'zoom_link',
        'freelance_propose',
        'fichier_joint',
        'stripe_payment_id',
        'calendly_event_id',
        'zoom_meeting_id',
        'date_rdv',
    ];

    protected $casts = [
        'budget' => 'decimal:2',
        'freelance_propose' => 'array',
        'details' => 'array',
        'date_soumission' => 'datetime',
        'date_rdv' => 'datetime',
    ];

    /**
     * Détermine le bonus bien-être selon le budget
     */
    public static function determineBonus($budget)
    {
        if ($budget >= 5000) {
            return 'Equilibre';
        } elseif ($budget >= 2500) {
            return 'Serenite';
        } elseif ($budget >= 500) {
            return 'Vitalite';
        }
        return 'Aucun';
    }

    /**
     * Vérifie si un lien Calendly/Zoom est nécessaire
     */
    public function needsCalendlyZoom()
    {
        return $this->offre === 'Accompagnement' || $this->bonus !== 'Aucun';
    }
}


