@extends('admin.layout')
@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('content')

{{-- Stats --}}
<div class="row g-3 mb-4">
    <div class="col-md-2">
        <div class="stat-card">
            <div class="stat-num" style="color:#a5b4fc;">{{ $stats['users'] }}</div>
            <div class="stat-label">Total Users</div>
        </div>
    </div>
    <div class="col-md-2">
        <div class="stat-card">
            <div class="stat-num" style="color:#86efac;">{{ $stats['analyses'] }}</div>
            <div class="stat-label">Analyses</div>
        </div>
    </div>
    <div class="col-md-2">
        <div class="stat-card">
            <div class="stat-num" style="color:#fcd34d;">{{ $stats['today'] }}</div>
            <div class="stat-label">Today</div>
        </div>
    </div>
    <div class="col-md-2">
        <div class="stat-card">
            <div class="stat-num" style="color:#fdba74;">{{ $stats['this_week'] }}</div>
            <div class="stat-label">This Week</div>
        </div>
    </div>
    <div class="col-md-2">
        <div class="stat-card">
            <div class="stat-num" style="color:#d8b4fe;">{{ $stats['skills'] }}</div>
            <div class="stat-label">Skills</div>
        </div>
    </div>
    <div class="col-md-2">
        <div class="stat-card">
            <div class="stat-num" style="color:#f9a8d4;">{{ $stats['careers'] }}</div>
            <div class="stat-label">Careers</div>
        </div>
    </div>
</div>

<div class="row g-3">
    {{-- Recent Analyses --}}
    <div class="col-lg-8">
        <div class="admin-card">
            <div class="d-flex align-items-center justify-content-between mb-3">
                <h6 class="fw-bold mb-0">Recent Analyses</h6>
                <a href="{{ route('admin.analyses') }}" class="btn-admin btn-outline-admin">View all</a>
            </div>
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>User</th>
                        <th>Career Match</th>
                        <th>Score</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($recentAnalyses as $a)
                    <tr>
                        <td>
                            @if($a->user)
                                <span style="font-weight:600;">{{ $a->user->name }}</span>
                                <span style="font-size:0.78rem; color:var(--muted); display:block;">{{ $a->user->email }}</span>
                            @else
                                <span style="color:var(--muted);">Guest</span>
                            @endif
                        </td>
                        <td>{{ $a->career }}</td>
                        <td>
                            <span class="badge-pill {{ $a->readiness_score >= 60 ? 'badge-green' : 'badge-red' }}">
                                {{ $a->readiness_score }}%
                            </span>
                        </td>
                        <td style="color:var(--muted); font-size:0.8rem;">{{ $a->created_at->diffForHumans() }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    {{-- Top Careers --}}
    <div class="col-lg-4">
        <div class="admin-card">
            <h6 class="fw-bold mb-3">Top Matched Careers</h6>
            @foreach($topCareers as $i => $c)
            <div class="d-flex align-items-center justify-content-between mb-3">
                <div>
                    <div style="font-size:0.875rem; font-weight:600;">{{ $c->career }}</div>
                    <div style="font-size:0.75rem; color:var(--muted);">{{ $c->total }} {{ $c->total === 1 ? 'analysis' : 'analyses' }}</div>
                </div>
                <div style="font-size:1.1rem; font-weight:800; color:#a5b4fc;">#{{ $i+1 }}</div>
            </div>
            @endforeach
        </div>

        <div class="admin-card mt-3">
            <h6 class="fw-bold mb-3">Quick Actions</h6>
            <div class="d-flex flex-column gap-2">
                <a href="{{ route('admin.skills.create') }}" class="btn-admin btn-primary-admin">
                    <i class="fa-solid fa-plus"></i> Add New Skill
                </a>
                <a href="{{ route('admin.careers.create') }}" class="btn-admin btn-primary-admin">
                    <i class="fa-solid fa-plus"></i> Add New Career
                </a>
                <a href="{{ route('admin.users') }}" class="btn-admin btn-outline-admin">
                    <i class="fa-solid fa-users"></i> Manage Users
                </a>
            </div>
        </div>
    </div>
</div>

@endsection