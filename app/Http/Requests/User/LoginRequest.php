<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
  protected function getRedirectUrl()
  {
    return route('user.login', ['role' => $this->input('role', 'client')]);
  }

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
    return [
      'email_address' => 'required',
      'password' => 'required'
    ];
  }

  /**
   * Get the validation messages that apply to the request.
   *
   * @return array
   */
  public function messages()
  {
    return [
      'email_address.required' => 'L\'adresse e-mail est requise.',
      'password.required' => 'Le mot de passe est requis.',
    ];
  }
}
