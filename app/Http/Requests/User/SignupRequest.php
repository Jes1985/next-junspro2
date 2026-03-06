<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class SignupRequest extends FormRequest
{
  public function authorize()
  {
    return true;
  }

  public function rules()
  {
    // Si l'email existe déjà (même compte multi-rôles), on ne bløque plus sur unique
    // La logique de fusion est gérée dans signupSubmit()
    $existingUser = User::where('email_address', $this->email_address)->first();

    return [
      'username'             => $existingUser ? 'required|max:255' : 'required|unique:users|max:255',
      'email_address'        => 'required|email:rfc|max:255',
      'password'             => 'required|confirmed',
      'password_confirmation' => 'required',
    ];
  }

  public function messages()
  {
    return [
      'password_confirmation.required' => 'The confirm password field is required.',
    ];
  }
}
