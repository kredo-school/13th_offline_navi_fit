<div class="card border-1 shadow-sm">
    <div class="card-body p-4">
        <div class="d-flex align-items-center justify-content-between position-relative">
            @php
                $steps = [
                    ['number' => 1, 'title' => 'Select Menu', 'description' => 'Choose your workout'],
                    ['number' => 2, 'title' => 'Edit Performance', 'description' => 'Enter sets & weights'],
                    ['number' => 3, 'title' => 'Confirm', 'description' => 'Review your record'],
                    ['number' => 4, 'title' => 'Complete', 'description' => 'Training record complete'],
                ];
            @endphp

            @foreach ($steps as $index => $step)
                @php
                    $isCompleted = in_array($step['number'], $completedSteps);
                    $isCurrent = $step['number'] === $currentStep;
                    $isUpcoming = !$isCompleted && !$isCurrent;
                @endphp

                <div class="d-flex flex-column align-items-center position-relative">
                    <div class="rounded-circle border-2 d-flex align-items-center justify-content-center shadow position-relative
                        {{ $isCompleted ? 'bg-success border-success text-white' : '' }}
                        {{ $isCurrent ? 'bg-primary border-primary text-white' : '' }}
                        {{ $isUpcoming ? 'bg-light border-secondary text-muted' : '' }}"
                        style="width: 48px; height: 48px; font-weight: 600; font-size: 14px;
                        {{ $isCurrent ? 'transform: scale(1.1);' : '' }}">

                        @if ($isCompleted)
                            <i class="fas fa-check"></i>
                        @else
                            {{ $step['number'] }}
                        @endif

                        @if ($isCurrent)
                            <div class="position-absolute bottom-0 start-0 end-0 bg-primary rounded"
                                style="height: 4px; animation: pulse 2s infinite;"></div>
                        @endif
                    </div>

                    <div class="mt-3 text-center" style="max-width: 96px;">
                        <div
                            class="small fw-{{ $isCurrent ? 'bold' : ($isCompleted ? 'semibold' : 'normal') }} 
                                    text-{{ $isCurrent ? 'primary' : ($isCompleted ? 'success' : 'muted') }}">
                            {{ $step['title'] }}
                        </div>
                        <div class="text-muted d-none d-sm-block" style="font-size: 11px;">
                            {{ $step['description'] }}
                        </div>
                    </div>
                </div>

                @if ($index < count($steps) - 1)
                    <div class="flex-fill px-3">
                        <div class="rounded {{ $isCompleted ? 'bg-success' : 'bg-secondary' }}"
                            style="height: 4px; transition: all 0.3s ease;"></div>
                    </div>
                @endif
            @endforeach
        </div>

        {{-- Mobile Progress Bar --}}
        <div class="mt-4 d-sm-none">
            <div class="d-flex justify-content-between text-muted mb-2" style="font-size: 12px;">
                <span>Progress</span>
                <span>{{ round((count($completedSteps) / 4) * 100) }}%</span>
            </div>
            <div class="progress" style="height: 8px;">
                <div class="progress-bar bg-primary" role="progressbar"
                    style="width: {{ (count($completedSteps) / 4) * 100 }}%"
                    aria-valuenow="{{ count($completedSteps) }}" aria-valuemin="0" aria-valuemax="4"></div>
            </div>
        </div>
    </div>
</div>

<style>
    @keyframes pulse {
        0% {
            opacity: 1;
        }

        50% {
            opacity: 0.5;
        }

        100% {
            opacity: 1;
        }
    }
</style>
