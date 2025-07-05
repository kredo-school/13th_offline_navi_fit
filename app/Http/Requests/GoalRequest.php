<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GoalRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'target_weight' => 'required|numeric|min:10|max:999.99',
            'target_date' => 'required|date|after:today',
            'target_body_fat_percentage' => 'nullable|numeric|min:1|max:99.99',
            'weekly_workout_frequency' => 'required|integer|min:1|max:7',
            'is_active' => 'boolean',
        ];
    }

    /**
     * Get custom error messages for validation rules.
     */
    public function messages(): array
    {
        return [
            'target_weight.required' => 'Target weight is required.',
            'target_weight.min' => 'Target weight must be at least 10kg.',
            'target_weight.max' => 'Target weight must not exceed 999.99kg.',
            'target_date.required' => 'Target date is required.',
            'target_date.after' => 'Target date must be in the future.',
            'target_body_fat_percentage.min' => 'Body fat percentage must be at least 1%.',
            'target_body_fat_percentage.max' => 'Body fat percentage must not exceed 99.99%.',
            'weekly_workout_frequency.required' => 'Weekly workout frequency is required.',
            'weekly_workout_frequency.min' => 'Weekly workout frequency must be at least 1.',
            'weekly_workout_frequency.max' => 'Weekly workout frequency must not exceed 7.',
        ];
    }
}
