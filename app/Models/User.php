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
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
  use HasFactory, Notifiable;

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
}
