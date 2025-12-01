<?php

namespace App\Http\Requests\Junspro;

use Illuminate\Foundation\Http\FormRequest;

class CreateTransferRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'subscription_id' => 'required|exists:subscriptions,id',
            'new_freelancer_id' => 'required|exists:freelancer_profiles,id',
            'reason' => 'required|string|min:10|max:1000',
        ];
    }

    public function messages(): array
    {
        return [
            'subscription_id.required' => 'L\'abonnement est requis',
            'new_freelancer_id.required' => 'Le nouveau freelance est requis',
            'reason.required' => 'La raison du transfert est obligatoire',
            'reason.min' => 'La raison doit contenir au moins 10 caractères',
        ];
    }
}

