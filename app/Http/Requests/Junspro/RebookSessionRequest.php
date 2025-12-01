<?php

namespace App\Http\Requests\Junspro;

use Illuminate\Foundation\Http\FormRequest;

class RebookSessionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'work_session_id' => 'required|exists:work_sessions,id',
            'new_start_at' => 'required|date|after:now',
            'reason' => 'nullable|string|max:1000',
        ];
    }

    public function messages(): array
    {
        return [
            'work_session_id.required' => 'La session est requise',
            'work_session_id.exists' => 'La session sélectionnée n\'existe pas',
            'new_start_at.required' => 'La nouvelle date est requise',
            'new_start_at.date' => 'La nouvelle date doit être une date valide',
            'new_start_at.after' => 'La nouvelle date doit être dans le futur',
        ];
    }
}

