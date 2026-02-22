<?php

namespace App\Http\Requests\User;

use App\Rules\ImageMimeTypeRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateProfileRequest extends FormRequest
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
    return [
      'image' => $this->hasFile('image') ? [
        new ImageMimeTypeRule(),
        'dimensions:min_width=80,max_width=80,min_width=80,min_height=80'
      ] : '',
      'first_name' => 'required',
      'last_name'  => 'required',
      'username'     => 'sometimes|required|unique:users,username,' . Auth::guard('web')->user()->id,
      'phone_number' => 'sometimes|nullable',
      'address'      => 'sometimes|nullable',
      'city'         => 'sometimes|nullable',
      'country'         => 'sometimes|nullable',
      'native_language'  => 'sometimes|nullable|string|max:10',
      'other_languages'  => 'sometimes|nullable|string|max:500',
    ];
  }
}
