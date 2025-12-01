<?php

namespace App\Http\Requests\Junspro;

use Illuminate\Foundation\Http\FormRequest;

class CreateSubscriptionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // À adapter selon votre logique d'authentification
    }

    public function rules(): array
    {
        return [
            'freelancer_id' => 'required|exists:freelancer_profiles,id',
            'hours_per_week' => 'required|integer|in:1,2,3,4,5,8',
            'delivery_mode' => 'required|string|in:standard,express_24h,express_48h,express_72h',
        ];
    }

    public function messages(): array
    {
        return [
            'freelancer_id.required' => 'Le freelance est requis',
            'freelancer_id.exists' => 'Le freelance sélectionné n\'existe pas',
            'hours_per_week.required' => 'Le nombre d\'heures par semaine est requis',
            'hours_per_week.in' => 'Le nombre d\'heures doit être 1, 2, 3, 4, 5 ou 8',
            'delivery_mode.required' => 'Le mode de livraison est requis',
            'delivery_mode.in' => 'Le mode de livraison doit être standard, express_24h, express_48h ou express_72h',
        ];
    }
}

