<div class="min-vh-100 bg-light">
    {{-- Header --}}
    <div class="bg-white shadow-sm border-bottom sticky-top">
        <div class="container-fluid">
            <div class="row align-items-center py-3">
                <div class="col-auto">
                    <div class="d-flex align-items-center">
                        <button wire:click="goHome" type="button" class="btn btn-link text-secondary p-2 me-3">
                            <i class="fas fa-arrow-left"></i>
                        </button>
                        <div>
                            <h1 class="h4 mb-0 text-dark fw-semibold">Workout Log</h1>
                            {{-- <p class="small text-muted mb-0">トレーニング記録を作成</p> --}}
                        </div>
                    </div>
                </div>
                <div class="col-auto ms-auto">
                    <div class="small text-muted">
                        Step {{ $currentStep }} of 4
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Main Content --}}
    <div class="container-fluid py-4">
        <div class="row justify-content-center">
            <div class="col-12 col-xl-10">
                {{-- Step Indicator --}}
                <div class="mb-4">
                    @include('livewire.training.partials.step-indicator')
                </div>
                
                {{-- Content Area --}}
                <div wire:loading.class="opacity-50" wire:target="goToStep1, goToStep2, goToStep3, goToStep4">
                    @if($currentStep === 1)
                        @include('livewire.training.partials.step1-menu-selection')
                    @elseif($currentStep === 2)
                        @include('livewire.training.partials.step2-workout-editor')
                    @elseif($currentStep === 3)
                        @include('livewire.training.partials.step3-confirmation')
                    @elseif($currentStep === 4)
                        @include('livewire.training.partials.step4-completion')
                    @endif
                </div>
            </div>
        </div>
    </div>

    {{-- Loading Overlay --}}
    {{-- <div wire:loading.flex 
         wire:target="goToStep1, goToStep2, goToStep3, goToStep4, saveTrainingRecord"
         class="position-fixed top-0 start-0 w-100 h-100 bg-dark bg-opacity-25 d-flex align-items-center justify-content-center" 
         style="z-index: 9999;">
        <div class="bg-white rounded-3 p-4 shadow">
            <div class="d-flex align-items-center">
                <div class="spinner-border spinner-border-sm text-primary me-3" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
                <span class="text-dark">Loading...</span>
            </div>
        </div>
    </div> --}}
</div>