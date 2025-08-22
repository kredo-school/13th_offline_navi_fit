{{-- 
/**
 * Training History Advanced Filters
 * Advanced filters (date range, template, search)
 * 
 * [Note] Since JavaScript is disabled, filters are always displayed in open state
 */
--}}

<div class="card shadow-sm mb-4">
    <div class="card-body">
        <h3 class="h6 mb-3">Advanced Filters</h3>
        <form method="GET" action="{{ route('training-history.index') }}">
            <div class="row g-3">
                <div class="col-md-3">
                    <label for="dateFrom" class="form-label small">Start Date</label>
                    <input type="date" name="date_from" id="dateFrom" class="form-control form-control-sm"
                        value="{{ request('date_from') }}">
                </div>
                <div class="col-md-3">
                    <label for="dateTo" class="form-label small">End Date</label>
                    <input type="date" name="date_to" id="dateTo" class="form-control form-control-sm"
                        value="{{ request('date_to') }}">
                </div>
                <div class="col-md-3">
                    <label for="templateFilter" class="form-label small">Template</label>
                    <select name="template" id="templateFilter" class="form-select form-select-sm">
                        <option value="">All Templates</option>
                        <option value="upper" {{ request('template') === 'upper' ? 'selected' : '' }}>Upper Body Focus
                        </option>
                        <option value="lower" {{ request('template') === 'lower' ? 'selected' : '' }}>Lower Body Power
                        </option>
                        <option value="hiit" {{ request('template') === 'hiit' ? 'selected' : '' }}>HIIT Cardio
                        </option>
                        <option value="core" {{ request('template') === 'core' ? 'selected' : '' }}>Core Strength
                            Program</option>
                        <option value="stretch" {{ request('template') === 'stretch' ? 'selected' : '' }}>Morning
                            Stretch
                        </option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="search" class="form-label small">Keyword Search</label>
                    <div class="input-group input-group-sm">
                        <span class="input-group-text"><i class="fas fa-search"></i></span>
                        <input type="text" name="keyword" id="search" class="form-control"
                            value="{{ request('keyword') }}" placeholder="Search by menu name or notes">
                    </div>
                </div>
            </div>
            <div class="mt-3 d-flex justify-content-end">
                <button class="btn btn-primary btn-sm" type="submit">Search</button>
            </div>
        </form>
    </div>
</div>
