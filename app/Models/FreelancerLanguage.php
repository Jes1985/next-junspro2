<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FreelancerLanguage extends Model
{
    protected $fillable = [
        'freelancer_id',
        'language_code',
        'level',
    ];

    protected $casts = [
        'level' => 'string',
    ];

    /**
     * Relation avec FreelancerProfile
     */
    public function freelancer(): BelongsTo
    {
        return $this->belongsTo(FreelancerProfile::class, 'freelancer_id');
    }

    /**
     * Constantes pour le ranking des niveaux (pour le tri)
     * Plus le nombre est élevé, plus le niveau est élevé
     */
    public static function getLevelRank(string $level): int
    {
        return match($level) {
            'native' => 7,
            'c2' => 6,
            'c1' => 5,
            'b2' => 4,
            'b1' => 3,
            'a2' => 2,
            'a1' => 1,
            default => 0,
        };
    }

    /**
     * Nom français du niveau
     */
    public static function getLevelLabel(string $level): string
    {
        return match($level) {
            'native' => 'Natif',
            'c2' => 'C2',
            'c1' => 'C1',
            'b2' => 'B2',
            'b1' => 'B1',
            'a2' => 'A2',
            'a1' => 'A1',
            default => 'B1',
        };
    }
}
