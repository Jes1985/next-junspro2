<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class FormationModule extends Model
{
    protected $fillable = [
        'slug', 'title', 'description', 'order', 'week_label', 'is_active', 'activities',
        'intro_text', 'audio_path',
        'title_en', 'description_en', 'intro_text_en', 'activities_en', 'audio_path_en',
    ];

    protected $casts = [
        'activities'    => 'array',
        'activities_en' => 'array',
        'is_active'     => 'boolean',
    ];

    // ─── Relations ────────────────────────────────────────────
    public function progress(): HasMany
    {
        return $this->hasMany(FormationModuleProgress::class, 'module_id');
    }

    // ─── Scopes ───────────────────────────────────────────────
    public function scopeActive($query)
    {
        return $query->where('is_active', true)->orderBy('order');
    }
}
