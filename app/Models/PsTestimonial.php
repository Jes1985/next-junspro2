<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Témoignages publics affichés sur la landing ambassadeurs Pause Souffle.
 * Gérés via Nova admin (PsTestimonial resource).
 */
class PsTestimonial extends Model
{
    protected $table = 'ps_testimonials';

    protected $fillable = [
        'author_name',
        'author_role',
        'content',
        'avatar_initial',
        'highlight',
        'sort_order',
        'is_published',
    ];

    protected $casts = [
        'is_published' => 'boolean',
        'sort_order'   => 'integer',
    ];

    /**
     * Uniquement les témoignages publiés.
     */
    public function scopePublished($query)
    {
        return $query->where('is_published', true);
    }

    /**
     * Témoignages mis en avant (highlight = 'featured').
     */
    public function scopeFeatured($query)
    {
        return $query->where('highlight', 'featured');
    }
}
