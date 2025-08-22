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
                        Great Job!
                    </h1>
                    <p class="h5 text-muted">
                        Your workout log has been saved successfully.
                    </p>
                </div>

                {{-- Workout Summary --}}
                <div class="card border-1 shadow-sm mb-4">
                    <div class="card-body p-4">
                        <h2 class="h4 fw-semibold text-dark mb-4">Today's Workout</h2>


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
                                        <div class="small text-muted">Workout Plan</div>
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
                                            <div class="small text-muted">{{ $this->getCompletedSetsCount() }}sets

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
                                            <div class="small text-muted">You lifted
                                                {{ number_format($this->getTotalVolume()) }}kg in total!</div>

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
                                    <div class="fw-semibold text-dark mb-2">Amazing effort!</div>
                                    <div class="small text-muted">
                                        @php
                                            $messages = [
                                                "Consistency builds strength.<br>Small steps, solid gains.",
                                                "Brick by brick, you get stronger.<br>Today's work powers tomorrow.",
                                                "Little by little becomes a lot.<br>Keep showing up.",
                                                "Sweat today, strength tomorrow.<br>Stay the course.",
                                                "Habits forge results.<br>Keep the rhythm."
                                            ];
                                            $randomMessage = $messages[array_rand($messages)];
                                        @endphp
                                        {!! $randomMessage !!}

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
                            <span>View Analytics</span>

                        </button>
                    </div>

                    <div class="col-12 col-md-4">
                        <button wire:click="createNew" type="button"
                            class="btn btn-success w-100 py-3 d-flex align-items-center justify-content-center">
                            <i class="fas fa-trophy me-2"></i>
                            <span>New Log</span>

                        </button>
                    </div>

                    <div class="col-12 col-md-4">
                        <button wire:click="goHome" type="button"
                            class="btn btn-outline-secondary w-100 py-3 d-flex align-items-center justify-content-center">
                            <i class="fas fa-home me-2"></i>
                            <span>Back to Dashboard</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
