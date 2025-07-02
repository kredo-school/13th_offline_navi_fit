<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class DifficultyBadge extends Component
{
    public function __construct(
        public string $level
    ) {}

    public function render(): View
    {
        return view('components.difficulty-badge');
    }

    public function badgeClass(): string
    {
        return match ($this->level) {
            'beginner' => 'bg-success',
            'intermediate' => 'bg-warning text-dark',
            'advanced' => 'bg-danger',
            default => 'bg-secondary'
        };
    }
}
