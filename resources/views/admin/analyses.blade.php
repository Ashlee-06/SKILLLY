@extends('admin.layout')
@section('title', 'All Analyses')
@section('page-title', 'All Analyses')

@section('content')

<div class="d-flex align-items-center justify-content-between mb-4">
    <div>
        <h5 class="fw-bold mb-1">All Analyses</h5>
        <p style="color:var(--muted); font-size:0.85rem; margin:0;">{{ $analyses->total() }} total analyses across all users</p>
    </div>
</div>

<div class="admin-card">
    <table class="admin-table">
        <thead>
            <tr>
                <th>User</th>
                <th>Resume File</th>
                <th>Career Match</th>
                <th>Score</th>
                <th>Skills Matched</th>
                <th>Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($analyses as $a)
            <tr>
                <td>
                    @if($a->user)
                        <span style="font-weight:600; font-size:0.875rem;">{{ $a->user->name }}</span>
                        <span style="font-size:0.75rem; color:var(--muted); display:block;">{{ $a->user->email }}</span>
                    @else
                        <span style="color:var(--muted); font-size:0.875rem;">Guest</span>
                    @endif
                </td>
                <td style="font-size:0.8rem; color:var(--muted);">
                    <i class="fa-solid fa-file me-1"></i>{{ Str::limit($a->resume_file_name, 24) }}
                </td>
                <td style="font-weight:600; font-size:0.875rem;">{{ $a->career }}</td>
                <td>
                    <span class="badge-pill {{ $a->readiness_score >= 80 ? 'badge-green' : ($a->readiness_score >= 50 ? 'badge-technical' : 'badge-red') }}">
                        {{ $a->readiness_score }}%
                    </span>
                </td>
                <td style="font-size:0.83rem; color:var(--muted);">
                    @php $matched = is_array($a->matched_skills) ? $a->matched_skills : json_decode($a->matched_skills, true) ?? []; @endphp
                    {{ count($matched) }} skill{{ count($matched) !== 1 ? 's' : '' }}
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