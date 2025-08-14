<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class TemplateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'string',
                'max:255',
                'min:2',
            ],
            'description' => [
                'nullable',
                'string',
                'max:1000',
            ],
            'difficulty' => [
                'nullable',
                'string',
                'in:easy,normal,hard',
            ],
            'is_active' => [
                'nullable',
                'boolean',
            ],
            'exercises' => [
                'nullable',
                'array',
            ],
            'exercises.*.exercise_id' => [
                'required_with:exercises',
                'integer',
                'exists:exercises,id',
            ],
            'exercises.*.sets' => [
                'required_with:exercises',
                'integer',
                'min:1',
                'max:10',
            ],
            'exercises.*.reps' => [
                'required_with:exercises',
                'integer',
                'min:1',
                'max:100',
            ],
            'exercises.*.rest_seconds' => [
                'nullable',
                'integer',
                'min:0',
                'max:600',
            ],
            'exercises.*.duration_seconds' => [
                'nullable',
                'integer',
                'min:0',
                'max:3600',
            ],
        ];
    }

    /**
     * Get custom error messages for validation rules.
     */
    public function messages(): array
    {
        return [
            'name.required' => 'Template name is required.',
            'name.min' => 'Template name must be at least 2 characters.',
            'name.max' => 'Template name cannot exceed 255 characters.',
            'description.max' => 'Description cannot exceed 1000 characters.',
            'difficulty.in' => 'Difficulty must be easy, normal, or hard.',
            'exercises.*.exercise_id.required_with' => 'Exercise selection is required.',
            'exercises.*.exercise_id.exists' => 'Selected exercise does not exist.',
            'exercises.*.sets.required_with' => 'Sets is required for each exercise.',
            'exercises.*.sets.min' => 'Sets must be at least 1.',
            'exercises.*.sets.max' => 'Sets cannot exceed 10.',
            'exercises.*.reps.required_with' => 'Reps is required for each exercise.',
            'exercises.*.reps.min' => 'Reps must be at least 1.',
            'exercises.*.reps.max' => 'Reps cannot exceed 100.',
            'exercises.*.rest_seconds.max' => 'Rest time cannot exceed 10 minutes.',
            'exercises.*.duration_seconds.max' => 'Duration cannot exceed 1 hour.',
        ];
    }

    /**
     * Get custom attribute names for error messages.
     */
    public function attributes(): array
    {
        return [
            'name' => 'template name',
            'description' => 'description',
            'difficulty' => 'difficulty',
            'exercises.*.exercise_id' => 'exercise',
            'exercises.*.sets' => 'sets',
            'exercises.*.reps' => 'reps',
            'exercises.*.rest_seconds' => 'rest time',
            'exercises.*.duration_seconds' => 'duration',
        ];
    }

    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation(): void
    {
        // Clean up exercises array - remove empty entries
        if ($this->has('exercises')) {
            $exercises = array_filter($this->exercises, function ($exercise) {
                return ! empty($exercise['exercise_id']);
            });

            $this->merge(['exercises' => array_values($exercises)]);
        }
    }
}
