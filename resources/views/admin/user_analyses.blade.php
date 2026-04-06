@extends('admin.layout')
@section('title', $user->name . ' — Analyses')
@section('page-title', $user->name . '\'s Analyses')

@section('content')

<div class="d-flex align-items-center gap-3 mb-4">
    <a href="{{ route('admin.users') }}" class="btn-admin btn-outline-admin">
        <i class="fa-solid fa-arrow-left"></i> Back
    </a>
    <div>
        <h5 class="fw-bold mb-0">{{ $user->name }}</h5>
        <p style="color:var(--muted); font-size:0.83rem; margin:0;">{{ $user->email }} &nbsp;·&nbsp; Joined {{ $user->created_at->format('d M Y') }}</p>
    </div>
</div>

<div class="admin-card mb-3" style="padding:16px 20px;">
    <div class="row g-3">
        <div class="col-md-3">
            <div style="font-size:0.72rem; color:var(--muted); text-transform:uppercase; letter-spacing:0.08em; margin-bottom:4px;">Total Analyses</div>
            <div style="font-size:1.6rem; font-weight:800; color:#a5b4fc;">{{ $analyses->total() }}</div>
        </div>
        <div class="col-md-3">
            <div style="font-size:0.72rem; color:var(--muted); text-transform:uppercase; letter-spacing:0.08em; margin-bottom:4px;">Avg. Score</div>
            <div style="font-size:1.6rem; font-weight:800; color:#86efac;">
                {{ $analyses->total() > 0 ? round($analyses->avg('readiness_score')) : 0 }}%
            </div>
        </div>
        <div class="col-md-3">
            <div style="font-size:0.72rem; color:var(--muted); text-transform:uppercase; letter-spacing:0.08em; margin-bottom:4px;">Last Active</div>
            <div style="font-size:1rem; font-weight:700; color:var(--text);">
                {{ $analyses->first() ? $analyses->first()->created_at->diffForHumans() : 'Never' }}
            </div>
        </div>
        <div class="col-md-3">
            <div style="font-size:0.72rem; color:var(--muted); text-transform:uppercase; letter-spacing:0.08em; margin-bottom:4px;">Account</div>
            <div style="font-size:1rem; font-weight:700; color:var(--text);">Active</div>
        </div>
    </div>
</div>

<div class="admin-card">
    @if($analyses->isEmpty())
        <div style="text-align:center; padding:3rem; color:var(--muted);">
            <i class="fa-solid fa-folder-open" style="font-size:2rem; margin-bottom:1rem; display:block;"></i>
            This user has no saved analyses yet.
        </div>
    @else
        <table class="admin-table">
            <thead>
                <tr>
                    <th>Resume File</th>
                    <th>Career Match</th>
                    <th>Score</th>
                    <th>Matched Skills</th>
                    <th>Missing Skills</th>
                    <th>Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($analyses as $a)
                <tr>
                    <td style="font-size:0.8rem; color:var(--muted);">
                        <i class="fa-solid fa-file me-1"></i>{{ Str::limit($a->resume_file_name, 22) }}
                    </td>
                    <td style="font-weight:600; font-size:0.875rem;">{{ $a->career }}</td>
                    <td>
                        <span class="badge-pill {{ $a->readiness_score >= 80 ? 'badge-green' : ($a->readiness_score >= 50 ? 'badge-technical' : 'badge-red') }}">
                            {{ $a->readiness_score }}%
                        </span>
                    </td>
                    <td style="font-size:0.83rem; color:#86efac;">
                        @php $matched = is_array($a->matched_skills) ? $a->matched_skills : json_decode($a->matched_skills, true) ?? []; @endphp
                        {{ count($matched) }} skill{{ count($matched) !== 1 ? 's' : '' }}
                    </td>
                    <td style="font-size:0.83rem; color:#fdba74;">
                        @php $missing = is_array($a->missing_skills) ? $a->missing_skills : json_decode($a->missing_skills, true) ?? []; @endphp
                        {{ count($missing) }} gap{{ count($missing) !== 1 ? 's' : '' }}
                    </td>
                    <td style="color:var(--muted); font-size:0.78rem; white-space:nowrap;">
                        {{ $a->created_at->format('d M Y') }}<br>
                        <span style="font-size:0.72rem;">{{ $a->created_at->format('g:i A') }}</span>
                    </td>
                    <td>
                        <button type="button" class="btn-admin btn-danger-admin del-btn" style="padding:5px 12px; font-size:0.78rem;"
                            data-career="{{ $a->career }}"
                            data-action="{{ route('admin.analyses.destroy', $a) }}">
                            <i class="fa-solid fa-trash"></i>
                        </button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="mt-3 d-flex justify-content-center">
            {{ $analyses->links() }}
        </div>
    @endif
</div>

{{-- Delete modal --}}
<div class="del-overlay" id="delModal">
    <div class="del-card">
        <div style="width:54px; height:54px; background:rgba(239,68,68,0.1); border:1px solid rgba(239,68,68,0.25); border-radius:50%; display:flex; align-items:center; justify-content:center; margin:0 auto 1.2rem; font-size:1.3rem; color:#fca5a5;">
            <i class="fa-solid fa-trash"></i>
        </div>
        <h5 style="font-family:'Sora',sans-serif; margin-bottom:0.6rem;">Delete analysis?</h5>
        <p style="font-size:0.875rem; color:var(--muted); margin-bottom:1.5rem;">
            Permanently delete the <strong id="del-name" style="color:var(--text);"></strong> analysis? This cannot be undone.
        </p>
        <div class="d-flex gap-2 justify-content-center">
            <button class="btn-admin btn-outline-admin" onclick="closeModal()">Cancel</button>
            <form id="del-form" method="POST">
                @csrf @method('DELETE')
                <button type="submit" class="btn-admin btn-danger-admin">Yes, Delete</button>
            </form>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
document.querySelectorAll('.del-btn').forEach(btn => {
    btn.addEventListener('click', () => {
        document.getElementById('del-name').textContent = btn.dataset.career;
        document.getElementById('del-form').action = btn.dataset.action;
        document.getElementById('delModal').classList.add('active');
    });
});
function closeModal() { document.getElementById('delModal').classList.remove('active'); }
document.getElementById('delModal').addEventListener('click', e => { if(e.target===document.getElementById('delModal')) closeModal(); });
document.addEventListener('keydown', e => { if(e.key==='Escape') closeModal(); });
</script>
@endpush