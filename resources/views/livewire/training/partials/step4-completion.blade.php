<div class="container">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-8">
            <div class="space-y-5">
                {{-- Success Animation --}}
                <div class="text-center mb-5">
                    <div class="d-inline-flex align-items-center justify-content-center bg-success bg-opacity-10 rounded-circle mb-4"
                        style="width: 96px; height: 96px;">
                        <i class="fas fa-check-circle text-success" style="font-size: 48px;"></i>
                    </div>
                    <h1 class="h2 fw-bold text-dark mb-3">
                        Well done!
                    </h1>
                    <p class="h5 text-muted">
                        Your training record has been saved successfully
                    </p>
                </div>

                {{-- Workout Summary --}}
                <div class="card border-1 shadow-sm mb-4">
                    <div class="card-body p-4">
                        <h2 class="h4 fw-semibold text-dark mb-4">This Workout</h2>

                        <div class="row g-3 mb-4">
                            <div class="col-6">
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-calendar text-muted me-3" style="font-size: 20px;"></i>
                                    <div>
                                        <div class="small text-muted">Date</div>
                                        <div class="fw-medium">{{ now()->format('Y年m月d日') }}</div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-dumbbell text-muted me-3" style="font-size: 20px;"></i>
                                    <div>
                                        <div class="small text-muted">Menu</div>
                                        <div class="fw-medium">{{ $this->selectedMenu->name ?? '' }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row g-4">
                            <div class="col-12">
                                <div class="bg-success bg-opacity-10 rounded-3 p-4">
                                    <div class="d-flex align-items-center">
                                        <div class="bg-white rounded-circle p-3 me-4">
                                            <i class="fas fa-check-circle text-success" style="font-size: 20px;"></i>
                                        </div>
                                        <div>
                                            <div class="fw-medium text-dark">Workout Completed</div>
                                            <div class="small text-muted">{{ $this->getCompletedSetsCount() }} sets
                                                completed</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="bg-warning bg-opacity-10 rounded-3 p-4">
                                    <div class="d-flex align-items-center">
                                        <div class="bg-white rounded-circle p-3 me-4">
                                            <i class="fas fa-trophy text-warning" style="font-size: 20px;"></i>
                                        </div>
                                        <div>
                                            <div class="fw-medium text-dark">Total Volume</div>
                                            <div class="small text-muted">{{ number_format($this->getTotalVolume()) }}kg
                                                lifted</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Motivational Message --}}
                <div class="card border-1 shadow-sm mb-4">
                    <div class="card-body p-4">
                        <div class="bg-primary bg-opacity-10 rounded-3 p-4">
                            <div class="d-flex align-items-center">
                                <div class="bg-white rounded-circle p-3 me-4">
                                    <i class="fas fa-heart text-primary" style="font-size: 20px;"></i>
                                </div>
                                <div>
                                    <div class="fw-semibold text-dark mb-2">Great effort!</div>
                                    <div class="small text-muted">
                                        Consistency is key. Today's effort leads to tomorrow's results.<br>
                                        Keep up the good work for your next training!
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Action Buttons --}}
                <div class="row g-3 mb-4">
                    <div class="col-12 col-md-4">
                        <button wire:click="redirectToStats" type="button"
                            class="btn btn-primary w-100 py-3 d-flex align-items-center justify-content-center">
                            <i class="fas fa-chart-line me-2"></i>
                            <span>View Stats</span>
                        </button>
                    </div>

                    <div class="col-12 col-md-4">
                        <button wire:click="createNew" type="button"
                            class="btn btn-success w-100 py-3 d-flex align-items-center justify-content-center">
                            <i class="fas fa-trophy me-2"></i>
                            <span>New Record</span>
                        </button>
                    </div>

                    <div class="col-12 col-md-4">
                        <button wire:click="goHome" type="button"
                            class="btn btn-outline-secondary w-100 py-3 d-flex align-items-center justify-content-center">
                            <i class="fas fa-home me-2"></i>
                            <span>Back to Home</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
