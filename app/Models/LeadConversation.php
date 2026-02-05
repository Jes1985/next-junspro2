<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Conversation pré-booking (sans subscription) entre un client et un freelance.
 * ÉTAPE 4 — Un seul thread par paire (client_id, freelancer_id).
 */
class LeadConversation extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'freelancer_id',
    ];

    /**
     * Client (ClientProfile).
     */
    public function client(): BelongsTo
    {
        return $this->belongsTo(ClientProfile::class, 'client_id');
    }

    /**
     * Freelance (FreelancerProfile).
     */
    public function freelancer(): BelongsTo
    {
        return $this->belongsTo(FreelancerProfile::class, 'freelancer_id');
    }

    /**
     * Messages de cette conversation lead.
     */
    public function messages(): HasMany
    {
        return $this->hasMany(ChatMessage::class, 'lead_conversation_id');
    }
}
