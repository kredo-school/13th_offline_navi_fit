<?php

namespace App\Livewire;

use App\Models\Exercise;
use Livewire\Component;

class ExerciseCatalog extends Component
{
    public $searchExercise = '';

    public $exercises = [];

    public function mount()
    {
        $this->exercises = Exercise::all();
    }

    public function updatedSearchExercise($value)
    {
        if (empty($value)) {
            $this->exercises = Exercise::all();
        } else {
            $searchTerm = "%{$value}%";
            $this->exercises = Exercise::where('name', 'LIKE', $searchTerm)->get();
        }
    }

    public function clear()
    {
        $this->searchExercise = '';

        $this->exercises = Exercise::all();

        $this->dispatch('clearSearchInput');
    }

    public function render()
    {
        return view('livewire.exercise-catalog');
    }
}
