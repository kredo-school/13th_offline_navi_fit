<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ExerciseRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'muscle_groups' => 'required|array',
            'muscle_groups.*' => 'required|string|in:chest,back,shoulders,arms,legs,core,full_body',
            'equipment_category' => 'required|string|in:barbell,dumbbell,machine,bodyweight,timer',
            'equipment_needed' => 'nullable|string',
            'difficulty' => 'required|string|in:beginner,intermediate,advanced',
            'instructions' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_active' => 'boolean',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Exercise name is required',
            'name.max' => 'Exercise name must not exceed 255 characters',
            'muscle_groups.required' => 'Please select target muscle groups',
            'muscle_groups.array' => 'Muscle groups must be an array',
            'muscle_groups.*.in' => 'Invalid muscle group selected',
            'equipment_category.required' => 'Please select equipment category',
            'equipment_category.in' => 'Invalid equipment category selected',
            'difficulty.required' => 'Please select difficulty level',
            'difficulty.in' => 'Invalid difficulty level selected',
        ];
    }

    protected function prepareForValidation()
    {
        if (! $this->has('is_active')) {
            $this->merge(['is_active' => true]);
        }
    }
}
