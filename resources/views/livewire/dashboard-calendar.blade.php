<div>
    <div class="card">
        <div class="card-body p-4">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="card-title fw-semibold mb-0">Training Calendar</h5>
                <i class="bi bi-calendar-week text-muted"></i>
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
                        <p class="text-muted small">{{ $startOfWeek->format('M d') }} - {{ $endOfWeek->format('M d, Y') }}</p>
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

                        @if($actual >= $goal && $goal > 0)
                            <div class="alert alert-success mt-3 py-2 small">
                                <i class="bi bi-trophy-fill"></i> Goal achieved!
                            </div>
                        @endif
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
        document.addEventListener('livewire:initialized', function () {
            // Responsive calendar resize handler
            function resizeCalendar() {
                if (calendar) {
                    calendar.updateSize();
                }
            }
            
            // Update calendar size on window resize
            window.addEventListener('resize', resizeCalendar);
            
            // Initialize FullCalendar
            const calendarEl = document.getElementById('calendar');
            const calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: window.innerWidth < 768 ? 'listMonth' : 'dayGridMonth',
                locale: 'en',
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,listMonth'
                },
                events: @json($events),
                height: 'auto',
                contentHeight: 260,
                aspectRatio: window.innerWidth < 768 ? 1.1 : 1.35,
                buttonText: {
                    today: 'Today',
                    month: 'Month',
                    list: 'List'
                },
                dayMaxEvents: window.innerWidth < 768 ? 1 : 2,
                navLinks: true,
                dayHeaderFormat: { weekday: 'short' },
                titleFormat: { year: 'numeric', month: 'short' },
                views: {
                    dayGridMonth: {
                        dayHeaderFormat: { weekday: 'narrow' },
                        titleFormat: { year: 'numeric', month: 'short' }
                    }
                }
            });
            calendar.render();
            
            // Initialize Chart.js
            const ctx = document.getElementById('weeklyProgress').getContext('2d');
            const goalRemaining = Math.max(0, {{ $goal }} - {{ $actual }});
            
            new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: ['Completed', 'Remaining'],
                    datasets: [{
                        data: [{{ $actual }}, goalRemaining],
                        backgroundColor: [
                            '#4ade80', // green (completed)
                            '#e5e7eb'  // gray (remaining)
                        ],
                        borderWidth: 0
                    }]
                },
                options: {
                    cutout: '70%',
                    plugins: {
                        legend: {
                            display: false
                        },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    const label = context.label || '';
                                    const value = context.parsed || 0;
                                    return `${label}: ${value} sessions`;
                                }
                            }
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
        /* Responsive design CSS */
        .calendar-container {
            min-height: 220px;
            max-height: 260px;
            height: 100%;
            overflow: auto;
        }
        
        /* Smaller calendar fonts */
        #calendar {
            font-size: 0.85rem;
        }
        
        #calendar .fc-toolbar-title {
            font-size: 1.1rem;
        }
        
        #calendar .fc-button {
            font-size: 0.8rem;
            padding: 0.2rem 0.5rem;
        }
        
        @media (max-width: 767px) {
            .calendar-container {
                min-height: 200px;
            }
        }
        
        .hover-shadow:hover {
            box-shadow: 0 .5rem 1rem rgba(0,0,0,.1);
            transition: box-shadow 0.3s ease;
        }
    </style>
</div>
