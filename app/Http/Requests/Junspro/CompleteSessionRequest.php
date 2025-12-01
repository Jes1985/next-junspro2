<?php

namespace App\Http\Requests\Junspro;

use Illuminate\Foundation\Http\FormRequest;

class CompleteSessionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'work_session_id' => 'required|exists:work_sessions,id',
            'report_text' => 'required|string|min:10',
            'report_files' => 'nullable|array',
            'report_files.*' => 'file|max:10240', // 10MB max par fichier
        ];
    }

    public function messages(): array
    {
        return [
            'work_session_id.required' => 'La session est requise',
            'report_text.required' => 'Le rapport est obligatoire',
            'report_text.min' => 'Le rapport doit contenir au moins 10 caractères',
        ];
    }
}

