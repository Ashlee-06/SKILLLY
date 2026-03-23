@extends('layouts.app')

@section('title', 'My Analyses — Skillly')

@section('content')

<div class="row justify-content-center mb-4">
    <div class="col-lg-10">
        <div class="d-flex align-items-center justify-content-between mb-4">
            <div>
                <h1 class="h3 fw-bold mb-1">My Analyses</h1>
                <p class="text-secondary small mb-0">All your saved career guidance sessions.</p>
            </div>
            <a href="{{ route('resume.index') }}" class="btn-glow" style="padding: 10px 20px; font-size:0.875rem;">
                <i class="fa-solid fa-plus"></i> New Analysis
            </a>
        </div>

        @if ($sessions->isEmpty())
            <div class="glass-panel text-center py-5">
                <div style="width:64px;height:64px;background:rgba(99,102,241,0.12);border-radius:50%;display:flex;align-items:center;justify-content:center;margin:0 auto 1.5rem;">
                    <i class="fa-solid fa-folder-open" style="font-size:1.5rem;color:#6366f1;"></i>
                </div>
                <h4 class="fw-bold mb-2">No analyses yet</h4>
                <p class="text-secondary mb-4">Upload your resume to get your first career guidance report.</p>
                <a href="{{ route('resume.index') }}" class="btn btn-glow">
                    <i class="fa-solid fa-wand-magic-sparkles"></i> Start My First Analysis
                </a>
            </div>
        @else
            <div class="row g-3">
                @foreach ($sessions as $session)
                    <div class="col-12">
                        <div class="history-card glass-panel p-0">
                            <div class="d-flex align-items-center p-3 gap-3 flex-wrap">

                                {{-- Readiness ring --}}
                                <div class="readiness-ring" style="--pct: {{ $session->readiness_score }};">
                                    <span class="ring-label">{{ $session->readiness_score }}%</span>
                                </div>

                                {{-- Career info --}}
                                <div class="flex-grow-1">
                                    <div class="d-flex align-items-center gap-2 flex-wrap mb-1">
                                        <span class="fw-bold" style="font-family:var(--font-sora);">{{ $session->career }}</span>
                                        <span class="badge-pill {{ $session->readinessBadgeClass() }}">{{ $session->readinessLabel() }}</span>
                                    </div>
                                    <div class="text-secondary small">
                                        <i class="fa-solid fa-file me-1"></i> {{ $session->resume_file_name }}
                                        &nbsp;·&nbsp;
                                        <i class="fa-regular fa-clock me-1"></i> {{ $session->created_at->diffForHumans() }}
                                    </div>
                                    <div class="mt-2 d-flex flex-wrap gap-1">
                                        @foreach (array_slice($session->matched_skills, 0, 4) as $skill)
                                            <span class="skill-chip matched">{{ ucwords($skill) }}</span>
                                        @endforeach
                                        @if (count($session->matched_skills) > 4)
                                            <span class="skill-chip more">+{{ count($session->matched_skills) - 4 }} more</span>
                                        @endif
                                    </div>
                                </div>

                                {{-- Actions --}}
                                <div class="d-flex gap-2 flex-wrap">
                                    <a href="{{ route('history.show', $session) }}" class="btn-outline-glass btn-sm" style="font-size:0.8rem;">
                                        <i class="fa-solid fa-eye"></i> View
                                    </a>
                                    <form action="{{ route('history.download', $session) }}" method="POST" class="download-form">
                                        @csrf
                                        <button type="button" class="btn-outline-glass btn-sm download-btn"
                                            style="font-size:0.8rem;"
                                            data-career="{{ $session->career }}">
                                            <i class="fa-solid fa-file-pdf"></i> PDF
                                        </button>
                                    </form>
                                    <form action="{{ route('history.destroy', $session) }}" method="POST" class="delete-form">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button"
                                            class="btn-outline-glass btn-sm delete-btn"
                                            style="font-size:0.8rem;"
                                            data-career="{{ $session->career }}"
                                            data-date="{{ $session->created_at->format('d M Y') }}">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-4 d-flex justify-content-center">
                {{ $sessions->links() }}
            </div>
        @endif
    </div>
</div>

{{-- ── Delete Confirmation Modal ── --}}
<div class="modal-overlay" id="deleteModal">
    <div class="modal-card">
        <div class="modal-icon danger">
            <i class="fa-solid fa-trash"></i>
        </div>
        <h4 class="modal-title">Delete this analysis?</h4>
        <p class="modal-desc">
            You're about to permanently delete your
            <strong id="modal-career-name"></strong> analysis
            from <span id="modal-career-date" style="color:var(--text-primary);"></span>.
            This cannot be undone.
        </p>
        <div class="modal-actions">
            <button class="modal-btn cancel" id="modal-cancel">
                <i class="fa-solid fa-xmark"></i> Cancel
            </button>
            <button class="modal-btn confirm-danger" id="modal-confirm">
                <i class="fa-solid fa-trash"></i> Yes, Delete
            </button>
        </div>
    </div>
</div>

{{-- ── PDF Download Toast ── --}}
<div class="toast-wrap" id="downloadToast">
    <div class="toast-inner">
        <span class="spinner-border spinner-border-sm" style="color:#a5b4fc; width:14px; height:14px; border-width:2px;"></span>
        <span id="toast-text">Preparing your PDF report...</span>
    </div>
</div>

@endsection

@push('styles')
<style>

/* ── History card ── */
.history-card {
    padding: 0 !important;
    border-radius: 16px !important;
    transition: border-color 0.2s, transform 0.2s;
}
.history-card:hover {
    border-color: rgba(99,102,241,0.35);
    transform: translateY(-2px);
}

/* ── Readiness ring ── */
.readiness-ring {
    position: relative;
    width: 56px; height: 56px; flex-shrink: 0;
    background: conic-gradient(
        #6366f1 calc(var(--pct) * 1%),
        rgba(255,255,255,0.07) 0
    );
    border-radius: 50%;
    display: flex; align-items: center; justify-content: center;
}
.readiness-ring::before {
    content: '';
    position: absolute; inset: 6px;
    background: var(--bg-deep); border-radius: 50%;
}
.ring-label {
    position: relative;
    font-size: 0.68rem; font-weight: 700;
    color: var(--text-primary); z-index: 1;
}

/* ── Badges ── */
.badge-pill { font-size: 0.7rem; font-weight: 600; padding: 2px 10px; border-radius: 99px; border: 1px solid; }
.badge-green  { background: rgba(34,197,94,0.1);  border-color: rgba(34,197,94,0.25);  color: #86efac; }
.badge-blue   { background: rgba(99,102,241,0.1); border-color: rgba(99,102,241,0.25); color: #a5b4fc; }
.badge-amber  { background: rgba(245,158,11,0.1); border-color: rgba(245,158,11,0.25); color: #fcd34d; }
.badge-red    { background: rgba(239,68,68,0.1);  border-color: rgba(239,68,68,0.25);  color: #fca5a5; }

/* ── Skill chips ── */
.skill-chip { font-size: 0.7rem; font-weight: 500; padding: 2px 8px; border-radius: 99px; border: 1px solid; }
.skill-chip.matched { background: rgba(34,197,94,0.08); border-color: rgba(34,197,94,0.2); color: #86efac; }
.skill-chip.more    { background: rgba(255,255,255,0.04); border-color: var(--border-glass); color: var(--text-secondary); }

/* ── Action buttons ── */
.delete-btn { border-color: rgba(239,68,68,0.2); color: #fca5a5; }
.delete-btn:hover { background: rgba(239,68,68,0.1); border-color: rgba(239,68,68,0.5); color: #fca5a5; }

/* ── Pagination ── */
.pagination .page-link {
    background: var(--bg-card); border-color: var(--border-glass);
    color: var(--text-secondary); border-radius: 8px; margin: 0 2px;
}
.pagination .page-link:hover { background: rgba(99,102,241,0.12); color: white; }
.pagination .active .page-link { background: var(--accent-main); border-color: var(--accent-main); color: white; }

/* ── Modal overlay ── */
.modal-overlay {
    position: fixed; inset: 0; z-index: 9000;
    background: rgba(0,0,0,0.65);
    backdrop-filter: blur(10px);
    -webkit-backdrop-filter: blur(10px);
    display: flex; align-items: center; justify-content: center;
    padding: 1rem;
    opacity: 0; pointer-events: none;
    transition: opacity 0.25s ease;
}
.modal-overlay.active {
    opacity: 1; pointer-events: all;
}

/* ── Modal card ── */
.modal-card {
    background: rgba(15, 23, 42, 0.97);
    border: 1px solid rgba(255,255,255,0.1);
    border-radius: 24px;
    padding: 2rem 2rem 1.75rem;
    width: 100%; max-width: 400px;
    text-align: center;
    box-shadow: 0 40px 80px rgba(0,0,0,0.6);
    transform: translateY(20px) scale(0.96);
    transition: transform 0.28s cubic-bezier(0.22,1,0.36,1);
}
.modal-overlay.active .modal-card {
    transform: translateY(0) scale(1);
}

/* ── Modal icon ── */
.modal-icon {
    width: 64px; height: 64px;
    border-radius: 50%;
    display: flex; align-items: center; justify-content: center;
    margin: 0 auto 1.25rem;
    font-size: 1.4rem;
}
.modal-icon.danger {
    background: rgba(239,68,68,0.1);
    border: 1px solid rgba(239,68,68,0.25);
    color: #fca5a5;
    animation: iconPulse 2s infinite;
}
@keyframes iconPulse {
    0%,100% { box-shadow: 0 0 0 0 rgba(239,68,68,0.2); }
    50%      { box-shadow: 0 0 0 8px rgba(239,68,68,0); }
}
.modal-title {
    font-family: var(--font-sora);
    font-size: 1.2rem; font-weight: 700;
    color: var(--text-primary); margin-bottom: 0.75rem;
}
.modal-desc {
    font-size: 0.875rem; color: var(--text-secondary);
    line-height: 1.7; margin-bottom: 1.75rem;
}
.modal-desc strong { color: var(--text-primary); }

/* ── Modal buttons ── */
.modal-actions { display: flex; gap: 10px; justify-content: center; }
.modal-btn {
    display: inline-flex; align-items: center; gap: 7px;
    padding: 10px 24px; border-radius: 10px;
    font-size: 0.875rem; font-weight: 600;
    cursor: pointer; border: 1px solid;
    transition: all 0.2s; font-family: var(--font-inter);
    background: none;
}
.modal-btn.cancel {
    border-color: var(--border-glass); color: var(--text-secondary);
    background: rgba(255,255,255,0.04);
}
.modal-btn.cancel:hover {
    background: rgba(255,255,255,0.08); color: var(--text-primary);
    border-color: rgba(255,255,255,0.2);
}
.modal-btn.confirm-danger {
    background: rgba(239,68,68,0.1);
    border-color: rgba(239,68,68,0.3); color: #fca5a5;
}
.modal-btn.confirm-danger:hover {
    background: rgba(239,68,68,0.2);
    border-color: rgba(239,68,68,0.6); color: white;
}
.modal-btn:disabled { opacity: 0.6; cursor: not-allowed; }

/* ── Download toast ── */
.toast-wrap {
    position: fixed; bottom: 28px; left: 50%;
    transform: translateX(-50%) translateY(16px);
    z-index: 9999; opacity: 0; pointer-events: none;
    transition: opacity 0.3s, transform 0.3s;
}
.toast-wrap.active {
    opacity: 1; pointer-events: all;
    transform: translateX(-50%) translateY(0);
}
.toast-inner {
    background: rgba(15,23,42,0.97);
    border: 1px solid rgba(99,102,241,0.3);
    border-radius: 50px; padding: 12px 22px;
    font-size: 0.85rem; color: var(--text-primary);
    display: flex; align-items: center; gap: 10px;
    box-shadow: 0 8px 32px rgba(0,0,0,0.4);
    white-space: nowrap;
}
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {

    // ── Delete modal ───────────────────────────────────────────────
    const modal        = document.getElementById('deleteModal');
    const modalCancel  = document.getElementById('modal-cancel');
    const modalConfirm = document.getElementById('modal-confirm');
    const modalCareer  = document.getElementById('modal-career-name');
    const modalDate    = document.getElementById('modal-career-date');
    let pendingForm    = null;

    document.querySelectorAll('.delete-btn').forEach(btn => {
        btn.addEventListener('click', function () {
            pendingForm             = this.closest('.delete-form');
            modalCareer.textContent = this.dataset.career || 'this';
            modalDate.textContent   = this.dataset.date   || '';
            modal.classList.add('active');
        });
    });

    modalCancel.addEventListener('click', closeModal);

    modal.addEventListener('click', function (e) {
        if (e.target === modal) closeModal();
    });

    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape') closeModal();
    });

    function closeModal() {
        modal.classList.remove('active');
        pendingForm = null;
    }

    modalConfirm.addEventListener('click', function () {
        if (!pendingForm) return;
        this.innerHTML = '<span class="spinner-border spinner-border-sm" style="width:13px;height:13px;border-width:2px;"></span> Deleting...';
        this.disabled  = true;
        modalCancel.disabled = true;
        pendingForm.submit();
    });

    // ── Download toast ─────────────────────────────────────────────
    const toast     = document.getElementById('downloadToast');
    const toastText = document.getElementById('toast-text');

    document.querySelectorAll('.download-btn').forEach(btn => {
        btn.addEventListener('click', function () {
            toastText.textContent = `Preparing ${this.dataset.career || 'your'} report...`;
            toast.classList.add('active');
            this.closest('.download-form').submit();
            setTimeout(() => toast.classList.remove('active'), 4500);
        });
    });

});
</script>
@endpush