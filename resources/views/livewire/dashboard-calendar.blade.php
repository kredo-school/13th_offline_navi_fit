<div>
    <div class="card">
        <div class="card-body p-4">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="card-title fw-semibold mb-0">Training Calendar</h5>
                <div class="d-flex align-items-center">
                    <div class="me-2 text-end">
                        <span class="d-block small text-muted">Your training streak</span>
                        <div class="d-flex align-items-center justify-content-end">
                            <i class="bi bi-fire text-danger me-1"></i>
                            <span class="fw-bold fs-5 text-primary">{{ $trainingDaysCount }}</span>
                            <span class="ms-1 small">days</span>
                        </div>
                    </div>
                    <div class="achievement-badge">
                        @if ($trainingDaysCount >= 30)
                            <i class="bi bi-trophy-fill fs-4 text-warning" title="Gold trainer: 30+ training days!"></i>
                        @elseif($trainingDaysCount >= 20)
                            <i class="bi bi-award-fill fs-4 text-secondary"
                                title="Silver trainer: 20+ training days!"></i>
                        @elseif($trainingDaysCount >= 10)
                            <i class="bi bi-award fs-4 text-warning" title="Bronze trainer: 10+ training days!"></i>
                        @else
                            <i class="bi bi-emoji-smile fs-4 text-primary"
                                title="Keep going! Train more to earn badges!"></i>
                        @endif
                    </div>
                </div>
            </div>

            <div class="row g-4">
                <!-- Mobile order adjustment - stats first -->
                <div class="col-md-4 order-md-2 order-first mb-md-0 mb-3">
                    <!-- Weekly Progress Stats -->
                    <div class="text-center mb-3">
                        <div class="d-flex align-items-center gap-2 justify-content-center mb-2">
                            <i class="bi bi-calendar-check text-primary small"></i>
                            <span class="small fw-medium">Weekly Progress</span>
                        </div>
                        <p class="text-muted small">{{ $startOfWeek->format('M d') }} -
                            {{ $endOfWeek->format('M d, Y') }}</p>
                    </div>

                    <div class="d-flex justify-content-center mb-3">
                        <div style="width: min(140px, 100%); height: auto; aspect-ratio: 1/1;">
                            <canvas id="weeklyProgress"></canvas>
                        </div>
                    </div>

                    <div class="text-center">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <span class="small fw-medium">Weekly Goal Progress</span>
                            <span class="small fw-semibold">{{ $actual }}/{{ $goal }} sessions</span>
                        </div>
                        <div class="progress" style="height: 0.5rem;">
                            <div class="progress-bar {{ $goal > 0 ? 'bg-success' : 'bg-secondary' }}" role="progressbar"
                                style="width: {{ $goal > 0 ? min(100, ($actual / $goal) * 100) : 0 }}%"></div>
                        </div>
                        <div class="d-flex justify-content-between small text-muted mt-1">
                            <span>Progress: {{ $goal > 0 ? min(100, round(($actual / $goal) * 100)) : 0 }}%</span>
                            <span>{{ max(0, $goal - $actual) }} to go</span>
                        </div>

                        @if ($actual >= $goal && $goal > 0)
                            <div class="alert alert-success mt-3 py-2 small">
                                <i class="bi bi-trophy-fill"></i> Goal achieved!
                            </div>
                        @endif

                        <!-- Color legend -->
                        {{-- <div class="mt-3 pt-2 border-top">
                            <p class="small fw-medium mb-2">Intensity Legend:</p>
                            <div class="d-flex justify-content-between small">
                                <span><i class="bi bi-circle-fill me-1 text-success"></i> Low</span>
                                <span><i class="bi bi-circle-fill me-1 text-primary"></i> Medium</span>
                                <span><i class="bi bi-circle-fill me-1 text-warning"></i> High</span>
                                <span><i class="bi bi-circle-fill me-1 text-danger"></i> Very High</span>
                            </div>
                        </div> --}}
                    </div>
                </div>

                <!-- Calendar - below on mobile -->
                <div class="col-md-8 order-md-1 order-last">
                    <!-- FullCalendar display area -->
                    <div id="calendar" class="calendar-container"></div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Initialize FullCalendar
                var calendarEl = document.getElementById('calendar');
                var calendar = new FullCalendar.Calendar(calendarEl, {
                    initialView: window.innerWidth < 768 ? 'listMonth' : 'dayGridMonth',
                    headerToolbar: {
                        left: 'prev,next today',
                        center: 'title',
                        right: 'dayGridMonth,listMonth'
                    },
                    events: @json($events),
                    height: 'auto',
                    contentHeight: 260,
                    dayHeaderFormat: {
                        weekday: 'short'
                    },
                    titleFormat: {
                        year: 'numeric',
                        month: 'short'
                    }
                });
                calendar.render();

                // Initialize Chart.js
                var ctx = document.getElementById('weeklyProgress').getContext('2d');
                var goalRemaining = Math.max(0, {{ $goal }} - {{ $actual }});

                new Chart(ctx, {
                    type: 'doughnut',
                    data: {
                        labels: ['Completed', 'Remaining'],
                        datasets: [{
                            data: [{{ $actual }}, goalRemaining],
                            backgroundColor: [
                                '#4ade80', // green (completed)
                                '#e5e7eb' // gray (remaining)
                            ],
                            borderWidth: 0
                        }]
                    },
                    options: {
                        cutout: '70%',
                        plugins: {
                            legend: {
                                display: false
                            }
                        },
                        maintainAspectRatio: true,
                        responsive: true
                    }
                });
            });
        </script>
    @endpush

    <style>
        .calendar-container {
            min-height: 220px;
            max-height: 260px;
            height: 100%;
            overflow: auto;
        }

        #calendar {
            font-size: 0.85rem;
        }

        @media (max-width: 767px) {
            .calendar-container {
                min-height: 200px;
            }
        }
    </style>
</div>
