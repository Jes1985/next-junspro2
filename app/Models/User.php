<?php

namespace App\Models;

use App\Models\ClientService\ServiceOrder;
use App\Models\ClientService\ServiceOrderMessage;
use App\Models\ClientService\ServiceReview;
use App\Models\ClientService\WishlistService;
use App\Models\Shop\ProductReview;
use App\Models\Shop\WishlistProduct;
use App\Models\SupportTicket;
use App\Models\ChatMessage;
use App\Models\AuditLog;
use App\Models\NotificationLog;
use App\Models\TicketConversation;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Schema;

class User extends Authenticatable
{
  use HasFactory, Notifiable;

  /**
   * Boot du modèle - intercepter les requêtes where('email', ...)
   */
  protected static function boot()
  {
    parent::boot();

    // Intercepter les requêtes where('email', ...) et les transformer
    static::addGlobalScope('email_address', function ($builder) {
      // Ne rien faire ici, on intercepte dans les méthodes where
    });
  }

  /**
   * Override de la méthode where pour intercepter where('email', ...)
   */
  public function newEloquentBuilder($query)
  {
    return new class($query) extends \Illuminate\Database\Eloquent\Builder {
      public function where($column, $operator = null, $value = null, $boolean = 'and')
      {
        // Si la colonne est 'email' et que la table n'a pas de colonne 'email'
        if ($column === 'email' && !Schema::hasColumn('users', 'email')) {
          $column = 'email_address';
        }
        return parent::where($column, $operator, $value, $boolean);
      }
    };
  }

  /**
   * The attributes that aren't mass assignable.
   *
   * @var array
   */
  protected $guarded = [];

  /**
   * The attributes that should be hidden for arrays.
   *
   * @var array
   */
  protected $hidden = [
    'password',
    'remember_token',
  ];

  /**
   * The attributes that should be cast to native types.
   *
   * @var array
   */
  protected $casts = [
    'email_verified_at' => 'datetime',
    'is_freelancer' => 'boolean',
    'is_client' => 'boolean',
    'is_verified_freelancer' => 'boolean',
    'is_super_freelancer' => 'boolean',
    'is_responsive' => 'boolean',
    'languages' => 'array',
    'availability' => 'array',
    'auto_confirm_enabled' => 'boolean',
    'email_sessions' => 'boolean',
    'email_reports' => 'boolean',
    'email_messages' => 'boolean',
    'email_billing' => 'boolean',
    'email_news' => 'boolean',
    'nexus_onboarding' => 'array',
    'nexus_offer' => 'array',
  ];

  public function productReview(): HasMany
  {
    return $this->hasMany(ProductReview::class, 'user_id', 'id');
  }

  public function serviceOrder(): HasMany
  {
    return $this->hasMany(ServiceOrder::class, 'user_id', 'id');
  }

  public function serviceReview(): HasMany
  {
    return $this->hasMany(ServiceReview::class, 'user_id', 'id');
  }

  public function wishlistedService(): HasMany
  {
    return $this->hasMany(WishlistService::class, 'user_id', 'id');
  }

  public function wishlistedProduct(): HasMany
  {
    return $this->hasMany(WishlistProduct::class, 'user_id', 'id');
  }

  public function message(): HasMany
  {
    return $this->hasMany(ServiceOrderMessage::class, 'person_id', 'id');
  }

  public function ticket(): HasMany
  {
    return $this->hasMany(SupportTicket::class, 'user_id', 'id');
  }

  public function ticketConversation(): HasMany
  {
    return $this->hasMany(TicketConversation::class, 'person_id', 'id');
  }

  public function wishlistedProducts(): HasMany
  {
    return $this->hasMany(WishlistProduct::class, 'user_id', 'id');
  }

  public function supportTickets(): HasMany
  {
    return $this->hasMany(SupportTicket::class, 'user_id', 'id');
  }

  /**
   * Messages envoyés
   */
  public function sentMessages(): HasMany
  {
      return $this->hasMany(ChatMessage::class, 'sender_id');
  }

  /**
   * Messages reçus
   */
  public function receivedMessages(): HasMany
  {
      return $this->hasMany(ChatMessage::class, 'receiver_id');
  }

  /**
   * Tickets de support (déjà mappés via supportTickets)
   */

  /**
   * Relation avec FreelancerProfile (Junspro V2)
   */
  public function freelancerProfile()
  {
    return $this->hasOne(FreelancerProfile::class);
  }

  /**
   * Relation avec ClientProfile (Junspro V2)
   */
  public function clientProfile()
  {
    return $this->hasOne(ClientProfile::class);
  }

  /**
   * Logs d'audit liés à l'utilisateur
   */
  public function auditLogs(): HasMany
  {
      return $this->hasMany(AuditLog::class);
  }

  /**
   * Logs de notifications liés à l'utilisateur
   */
  public function notificationLogs(): HasMany
  {
      return $this->hasMany(NotificationLog::class);
  }

  /**
   * Abonnements où l'utilisateur est client (via ClientProfile)
   */
  public function clientSubscriptions(): HasManyThrough
  {
      return $this->hasManyThrough(
          Subscription::class,
          ClientProfile::class,
          'user_id',       // Clé étrangère sur client_profiles
          'client_id',     // Clé étrangère sur subscriptions
          'id',            // Clé locale sur users
          'id'             // Clé locale sur client_profiles
      );
  }

  /**
   * Abonnements où l'utilisateur est freelance (via FreelancerProfile)
   */
  public function freelancerSubscriptions(): HasManyThrough
  {
      return $this->hasManyThrough(
          Subscription::class,
          FreelancerProfile::class,
          'user_id',        // Clé étrangère sur freelancer_profiles
          'freelancer_id',  // Clé étrangère sur subscriptions
          'id',             // Clé locale sur users
          'id'              // Clé locale sur freelancer_profiles
      );
  }

  /**
   * Parrainages où cet utilisateur est le parrain
   */
  public function referralsAsReferrer(): HasMany
  {
      return $this->hasMany(Referral::class, 'referrer_id');
  }

  /**
   * Parrainage où cet utilisateur est le filleul
   */
  public function referralAsReferred(): HasMany
  {
      return $this->hasMany(Referral::class, 'referred_id');
  }

  /**
   * Utilisateur qui a parrainé cet utilisateur
   */
  public function referrer(): BelongsTo
  {
      return $this->belongsTo(User::class, 'referred_by_user_id');
  }

  /**
   * Utilisateurs parrainés par cet utilisateur
   */
  public function referredUsers(): HasMany
  {
      return $this->hasMany(User::class, 'referred_by_user_id');
  }

  /**
   * Accessor pour l'email (compatibilité avec Nova et autres systèmes qui utilisent 'email')
   */
  public function getEmailAttribute()
  {
      // Si la colonne 'email' existe, l'utiliser
      if (isset($this->attributes['email'])) {
          return $this->attributes['email'];
      }
      // Sinon, utiliser 'email_address'
      return $this->attributes['email_address'] ?? null;
  }

  /**
   * Mutator pour l'email (compatibilité avec Nova)
   */
  public function setEmailAttribute($value)
  {
      // Si la colonne 'email' existe, l'utiliser
      if (array_key_exists('email', $this->attributes) || \Schema::hasColumn('users', 'email')) {
          $this->attributes['email'] = $value;
      } else {
          // Sinon, utiliser 'email_address'
          $this->attributes['email_address'] = $value;
      }
  }

  /**
   * Méthode utilisée par Fortify/Nova pour trouver un utilisateur par email
   */
  public function findForPassport($identifier)
  {
      // Essayer d'abord avec 'email' si la colonne existe
      if (\Schema::hasColumn('users', 'email')) {
          return $this->where('email', $identifier)->first();
      }
      // Sinon, utiliser 'email_address'
      return $this->where('email_address', $identifier)->first();
  }
}
