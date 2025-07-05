<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
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
            // 'full_name' => 'required|string|max:255',
            'age' => 'required|integer|min:1|max:120',
            'gender' => 'required|in:male,female,other',
            'height' => 'required|numeric|min:50|max:300',
            'weight' => 'required|numeric|min:10|max:500',
            'fitness_level' => 'required|in:beginner,intermediate,advanced',
            'medical_conditions' => 'nullable|string|max:1000',
        ];
    }

    /**
     * Get custom error messages for validation rules.
     */
    public function messages(): array
    {
        return [
            // 'full_name.required' => 'Full name is required.',
            'age.required' => 'Age is required.',
            'age.min' => 'Age must be at least 1.',
            'age.max' => 'Age must not exceed 120.',
            'gender.required' => 'Gender is required.',
            'gender.in' => 'Gender must be male, female, or other.',
            'height.required' => 'Height is required.',
            'height.min' => 'Height must be at least 50cm.',
            'height.max' => 'Height must not exceed 300cm.',
            'weight.required' => 'Current weight is required.',
            'weight.min' => 'Weight must be at least 10kg.',
            'weight.max' => 'Weight must not exceed 500kg.',
            'fitness_level.required' => 'Exercise experience level is required.',
            'fitness_level.in' => 'Exercise experience level must be beginner, intermediate, or advanced.',
            'medical_conditions.max' => 'Medical conditions must not exceed 1000 characters.',

        ];
    }
}
