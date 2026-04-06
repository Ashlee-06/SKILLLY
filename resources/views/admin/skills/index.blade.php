@extends('admin.layout')
@section('title', 'Skills')
@section('page-title', 'Skills')

@section('content')

<div class="d-flex align-items-center justify-content-between mb-4">
    <div>
        <h5 class="fw-bold mb-1">Skills Library</h5>
        <p style="color:var(--muted); font-size:0.85rem; margin:0;">{{ $skills->total() }} skills in the database</p>
    </div>
    <a href="{{ route('admin.skills.create') }}" class="btn-admin btn-primary-admin">
        <i class="fa-solid fa-plus"></i> Add Skill
    </a>
</div>

{{-- Filters --}}
<div class="admin-card mb-3">
    <form method="GET" action="{{ route('admin.skills.index') }}">
        <div class="row g-2 align-items-end">
            <div class="col-md-6">
                <label class="form-label-admin">Search</label>
                <div class="search-wrap">
                    <i class="fa-solid fa-magnifying-glass"></i>
                    <input type="text" name="search" value="{{ request('search') }}"
                        placeholder="Search by skill name..." class="form-input-admin search-input">
                </div>
            </div>
            <div class="col-md-3">
                <label class="form-label-admin">Type</label>
                <select name="type" class="form-input-admin">
                    <option value="">All types</option>
                    <option value="technical" {{ request('type')==='technical'?'selected':'' }}>Technical</option>
                    <option value="soft"      {{ request('type')==='soft'?'selected':'' }}>Soft</option>
                </select>
            </div>
            <div class="col-md-3">
                <div class="d-flex gap-2">
                    <button type="submit" class="btn-admin btn-primary-admin flex-grow-1" style="justify-content:center;">
                        <i class="fa-solid fa-filter"></i> Filter
                    </button>
                    <a href="{{ route('admin.skills.index') }}" class="btn-admin btn-outline-admin">Reset</a>
                </div>
            </div>
        </div>
    </form>
</div>

<div class="admin-card">
    <div style="overflow-x: auto;">
        <table class="admin-table" style="min-width: 640px;">
            <thead>
                <tr>
                    <th style="width:50px;">#</th>
                    <th>Skill Name</th>
                    <th style="width:110px;">Type</th>
                    <th>Keywords</th>
                    <th style="width:130px;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($skills as $skill)
                <tr>
                    <td style="color:var(--muted); font-size:0.78rem;">{{ $skill->id }}</td>
                    <td style="font-weight:600;">{{ $skill->skill_name }}</td>
                    <td>
                        <span class="badge-pill {{ $skill->skill_type === 'technical' ? 'badge-technical' : 'badge-soft' }}">
                            {{ $skill->skill_type }}
                        </span>
                    </td>
                    <td style="font-size:0.8rem; color:var(--muted);">
                        {{ Str::limit($skill->keywords, 55) }}
                    </td>
                    <td>
                        <div class="d-flex gap-2">
                            <a href="{{ route('admin.skills.edit', $skill) }}"
                                class="btn-admin btn-outline-admin" style="padding:5px 10px; font-size:0.75rem;">
                                <i class="fa-solid fa-pen"></i> Edit
                            </a>
                            <button type="button" class="btn-admin btn-danger-admin del-btn"
                                style="padding:5px 10px; font-size:0.75rem;"
                                data-name="{{ $skill->skill_name }}"
                                data-action="{{ route('admin.skills.destroy', $skill) }}">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" style="text-align:center; padding:2.5rem; color:var(--muted);">
                        <i class="fa-solid fa-inbox" style="font-size:1.5rem; display:block; margin-bottom:0.75rem;"></i>
                        No skills found. Try a different search or add a new skill.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if ($skills->hasPages())
<div class="mt-3 d-flex justify-content-center flex-wrap gap-2">

    {{-- Prev --}}
    @if ($skills->onFirstPage())
        <span class="btn-admin btn-outline-admin disabled">Prev</span>
    @else
        <a href="{{ $skills->previousPageUrl() }}" class="btn-admin btn-outline-admin">Prev</a>
    @endif

    {{-- Pages --}}
    @foreach ($skills->getUrlRange(1, $skills->lastPage()) as $page => $url)
        @if ($page == $skills->currentPage())
            <span class="btn-admin btn-primary-admin">{{ $page }}</span>
        @else
            <a href="{{ $url }}" class="btn-admin btn-outline-admin">{{ $page }}</a>
        @endif
    @endforeach

    {{-- Next --}}
    @if ($skills->hasMorePages())
        <a href="{{ $skills->nextPageUrl() }}" class="btn-admin btn-outline-admin">Next</a>
    @else
        <span class="btn-admin btn-outline-admin disabled">Next</span>
    @endif

</div>
@endif
</div>

{{-- Delete modal --}}
<div class="del-overlay" id="delModal">
    <div class="del-card">
        <div style="width:54px; height:54px; background:rgba(239,68,68,0.1); border:1px solid rgba(239,68,68,0.25); border-radius:50%; display:flex; align-items:center; justify-content:center; margin:0 auto 1.2rem; font-size:1.3rem; color:#fca5a5;">
            <i class="fa-solid fa-trash"></i>
        </div>
        <h5 style="font-family:'Sora',sans-serif; margin-bottom:0.6rem;">Delete skill?</h5>
        <p style="font-size:0.875rem; color:var(--muted); margin-bottom:1.5rem;">
            Deleting <strong id="del-name" style="color:var(--text);"></strong> will remove it from all career rules. This cannot be undone.
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
        document.getElementById('del-name').textContent = btn.dataset.name;
        document.getElementById('del-form').action = btn.dataset.action;
        document.getElementById('delModal').classList.add('active');
    });
});
function closeModal() { document.getElementById('delModal').classList.remove('active'); }
document.getElementById('delModal').addEventListener('click', e => { if(e.target===document.getElementById('delModal')) closeModal(); });
document.addEventListener('keydown', e => { if(e.key==='Escape') closeModal(); });
</script>
@endpush