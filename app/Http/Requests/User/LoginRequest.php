<?php

namespace App\Http\Requests\User;

use App\Models\BasicSettings\Basic;
use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
  /**
   * Determine if the user is authorized to make this request.
   *
   * @return bool
   */
  public function authorize()
  {
    return true;
  }

  /**
   * Get the validation rules that apply to the request.
   *
   * @return array
   */
  public function rules()
  {
    $recaptchaStatus = Basic::query()->pluck('google_recaptcha_status')->first();

    return [
      'email_address' => 'required',
      'password' => 'required',
      'g-recaptcha-response' => ($recaptchaStatus == 1) ? 'required|captcha' : ''
    ];
  }

  /**
   * Get the validation messages that apply to the request.
   *
   * @return array
   */
  public function messages()
  {
    $recaptchaStatus = Basic::query()->pluck('google_recaptcha_status')->first();

    $messages = [
      'email_address.required' => 'L\'adresse e-mail est requise.',
      'password.required' => 'Le mot de passe est requis.',
    ];

    if ($recaptchaStatus == 1) {
      $messages['g-recaptcha-response.required'] = 'Veuillez vérifier que vous n\'êtes pas un robot.';
      $messages['g-recaptcha-response.captcha'] = 'Erreur de captcha ! Réessayez plus tard ou contactez l\'administrateur.';
    }

    return $messages;
  }
}
