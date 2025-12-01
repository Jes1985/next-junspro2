<?php

namespace App\Models\PaymentGateway;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OnlineGateway extends Model
{
  use HasFactory;

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = ['name', 'keyword', 'information', 'status'];

  // as the timestamps is not needed, so make it false.
  public $timestamps = false;

  /**
   * Convertir le JSON en array lors de la lecture
   */
  public function getInformationAttribute($value)
  {
    if (is_string($value)) {
      return json_decode($value, true) ?? [];
    }
    return $value ?? [];
  }

  /**
   * Convertir l'array en JSON lors de la sauvegarde
   */
  public function setInformationAttribute($value)
  {
    if (is_array($value)) {
      $this->attributes['information'] = json_encode($value);
    } else {
      $this->attributes['information'] = $value;
    }
  }

  public function convertAutoData()
  {
    return $this->information;
  }
}
