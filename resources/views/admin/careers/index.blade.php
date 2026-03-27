@extends('admin.layout')
@section('title', 'Career Domains')
@section('page-title', 'Career Domains')

@section('content')

<div class="d-flex align-items-center justify-content-between mb-4">
    <div>
        <h5 class="fw-bold mb-1">Career Domains</h5>
        <p style="color:var(--muted); font-size:0.85rem; margin:0;">{{ $careers->total() }} career paths defined</p>
    </div>
    <a href="{{ route('admin.careers.create') }}" class="btn-admin btn-primary-admin">
        <i class="fa-solid fa-plus"></i> Add Career
    </a>
</div>

<div class="admin-card mb-3">
    <form method="GET" action="{{ route('admin.careers.index') }}" class="d-flex gap-3 align-items-end">
        <div class="flex-grow-1">
            <label class="form-label-admin">Search</label>
            <div class="search-wrap">
                <i class="fa-solid fa-magnifying-glass"></i>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Search careers..." class="form-input-admin search-input">
            </div>
        </div>
        <button type="submit" class="btn-admin btn-outline-admin" style="height:42px;"><i class="fa-solid fa-filter"></i> Filter</button>
        <a href="{{ route('admin.careers.index') }}" class="btn-admin btn-outline-admin" style="height:42px;">Reset</a>
    </form>
</div>

<div class="admin-card">
    <table class="admin-table">
        <thead>
            <tr>
                <th>#</th>
                <th>Career Name</th>
                <th>Description</th>
                <th>Rules</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($careers as $career)
            <tr>
                <td style="color:var(--muted); font-size:0.8rem;">{{ $career->id }}</td>
                <td><span style="font-weight:600;">{{ $career->career_name }}</span></td>
                <td style="font-size:0.8rem; color:var(--muted); max-width:260px;">{{ Str::limit($career->description, 60) ?? '—' }}</td>
                <td>
                    <span class="badge-pill badge-technical">{{ $career->rules_count }} skills</span>
                </td>
                <td>
                    <div class="d-flex gap-2">
                        <a href="{{ route('admin.careers.edit', $career) }}" class="btn-admin btn-outline-admin" style="padding:5px 12px; font-size:0.78rem;">
                            <i class="fa-solid fa-pen"></i> Edit
                        </a>
                        <button type="button" class="btn-admin btn-danger-admin del-btn" style="padding:5px 12px; font-size:0.78rem;"
                            data-name="{{ $career->career_name }}"
                            data-action="{{ route('admin.careers.destroy', $career) }}">
                            <i class="fa-solid fa-trash"></i>
                        </button>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="mt-3 d-flex justify-content-center">
        {{ $careers->links() }}
    </div>
</div>

{{-- Delete modal --}}
<div class="del-overlay" id="delModal">
    <div class="del-card">
        <div style="width:54px; height:54px; background:rgba(239,68,68,0.1); border:1px solid rgba(239,68,68,0.25); border-radius:50%; display:flex; align-items:center; justify-content:center; margin:0 auto 1.2rem; font-size:1.3rem; color:#fca5a5;">
            <i class="fa-solid fa-trash"></i>
        </div>
        <h5 style="font-family:'Sora',sans-serif; margin-bottom:0.6rem;">Delete career domain?</h5>
        <p style="font-size:0.875rem; color:var(--muted); margin-bottom:1.5rem;">
            Deleting <strong id="del-name" style="color:var(--text);"></strong> will also remove all its skill rules. This cannot be undone.
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