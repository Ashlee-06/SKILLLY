@extends('admin.layout')
@section('title', 'Users')
@section('page-title', 'Users')

@section('content')

<div class="d-flex align-items-center justify-content-between mb-4">
    <div>
        <h5 class="fw-bold mb-1">All Users</h5>
        <p style="color:var(--muted); font-size:0.85rem; margin:0;">{{ $users->total() }} registered users</p>
    </div>
</div>

<div class="admin-card">
    <table class="admin-table">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Email</th>
                <th>Analyses</th>
                <th>Joined</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
            <tr>
                <td style="color:var(--muted); font-size:0.8rem;">{{ $user->id }}</td>
                <td><span style="font-weight:600;">{{ $user->name }}</span></td>
                <td style="color:var(--muted); font-size:0.85rem;">{{ $user->email }}</td>
                <td>
                    <a href="{{ route('admin.user.analyses', $user) }}" class="badge-pill badge-technical" style="text-decoration:none; cursor:pointer;">
                        {{ $user->chat_sessions_count }} analyses
                    </a>
                </td>
                <td style="color:var(--muted); font-size:0.8rem;">{{ $user->created_at->format('d M Y') }}</td>
                <td>
                    <div class="d-flex gap-2">
                        <a href="{{ route('admin.user.analyses', $user) }}" class="btn-admin btn-outline-admin" style="padding:5px 12px; font-size:0.78rem;">
                            <i class="fa-solid fa-eye"></i> View
                        </a>
                        <button type="button" class="btn-admin btn-danger-admin del-btn" style="padding:5px 12px; font-size:0.78rem;"
                            data-name="{{ $user->name }}"
                            data-action="{{ route('admin.users.destroy', $user) }}">
                            <i class="fa-solid fa-trash"></i>
                        </button>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="mt-3 d-flex justify-content-center">
        {{ $users->links() }}
    </div>
</div>

{{-- Delete modal --}}
<div class="del-overlay" id="delModal">
    <div class="del-card">
        <div style="width:54px; height:54px; background:rgba(239,68,68,0.1); border:1px solid rgba(239,68,68,0.25); border-radius:50%; display:flex; align-items:center; justify-content:center; margin:0 auto 1.2rem; font-size:1.3rem; color:#fca5a5;">
            <i class="fa-solid fa-user-slash"></i>
        </div>
        <h5 style="font-family:'Sora',sans-serif; margin-bottom:0.6rem;">Delete user?</h5>
        <p style="font-size:0.875rem; color:var(--muted); margin-bottom:1.5rem;">
            Deleting <strong id="del-name" style="color:var(--text);"></strong> will permanently remove their account and all saved analyses. This cannot be undone.
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