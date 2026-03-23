@extends('layouts.app')

@section('title', 'Analysis — ' . $chatSession->career)

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">

        {{-- ── Back + header ── --}}
        <div class="d-flex align-items-center gap-3 mb-4">
            <a href="{{ route('history.index') }}" class="btn-outline-glass btn-sm" style="font-size:0.8rem;">
                <i class="fa-solid fa-arrow-left"></i> Back
            </a>
            <div class="flex-grow-1">
                <div class="small text-secondary">
                    <i class="fa-regular fa-clock me-1"></i> {{ $chatSession->created_at->format('d M Y, g:ia') }}
                    &nbsp;·&nbsp;
                    <i class="fa-solid fa-file me-1"></i> {{ $chatSession->resume_file_name }}
                </div>
            </div>
            <form action="{{ route('history.download', $chatSession) }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-glow" style="padding:8px 18px;font-size:0.85rem;">
                    <i class="fa-solid fa-file-pdf"></i> Download Report
                </button>
            </form>
        </div>

        {{-- ── Score Card ── --}}
        <div class="score-card glass-panel mb-4">
            <div class="sc-left">
                <div class="sc-career-label">Career Match</div>
                <div class="sc-career-name">{{ $chatSession->career }}</div>
                <div class="mt-2">
                    <span class="badge-pill badge-{{ $chatSession->readinessBadgeClass() }}">
                        {{ $chatSession->readinessLabel() }}
                    </span>
                </div>
            </div>
            <div class="sc-right">
                <div class="readiness-ring" style="--pct: {{ $chatSession->readiness_score }}; width:80px; height:80px;">
                    <span class="ring-label" style="font-size:1rem;">{{ $chatSession->readiness_score }}%</span>
                </div>
            </div>
            <div class="sc-chips">
                @foreach (array_slice($chatSession->matched_skills, 0, 3) as $skill)
                    <span class="sc-chip match">✓ {{ ucwords($skill) }}</span>
                @endforeach
                @foreach (array_slice($chatSession->missing_skills, 0, 2) as $skill)
                    <span class="sc-chip gap">+ {{ ucwords($skill) }}</span>
                @endforeach
            </div>
        </div>

        {{-- ── Skills side-by-side ── --}}
        <div class="row g-3 mb-4">
            <div class="col-md-6">
                <div class="glass-panel h-100" style="padding:1.5rem;">
                    <div class="section-label mb-3">
                        <i class="fa-solid fa-circle-check me-2" style="color:#22c55e;"></i>
                        Matched Skills ({{ count($chatSession->matched_skills) }})
                    </div>
                    <div class="d-flex flex-wrap gap-2">
                        @foreach ($chatSession->matched_skills as $skill)
                            <span class="skill-chip matched">{{ ucwords($skill) }}</span>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="glass-panel h-100" style="padding:1.5rem;">
                    <div class="section-label mb-3">
                        <i class="fa-solid fa-circle-arrow-up me-2" style="color:#f97316;"></i>
                        Skills to Develop ({{ count($chatSession->missing_skills) }})
                    </div>
                    <div class="d-flex flex-wrap gap-2">
                        @foreach ($chatSession->missing_skills as $skill)
                            <span class="skill-chip missing">{{ ucwords($skill) }}</span>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        {{-- ── Conversation replay ── --}}
        <div class="glass-panel p-0">
            <div class="chat-top border-bottom" style="border-color:var(--border-glass)!important; padding:16px 24px; display:flex; align-items:center; justify-content:space-between;">
                <span class="fw-bold" style="font-family:var(--font-sora); font-size:0.95rem;">
                    <i class="fa-solid fa-comments me-2" style="color:#6366f1;"></i> Chat Replay
                </span>
                <span class="small text-secondary">{{ count($conversation) }} messages</span>
            </div>
            <div class="chat-body chat-scroll" style="max-height:420px; overflow-y:auto; padding:20px 24px; display:flex; flex-direction:column; gap:6px;">
                @foreach ($conversation as $msg)
                    <div class="msg {{ $msg['type'] }}">
                        {!! nl2br(e($msg['message'])) !!}
                    </div>
                @endforeach
            </div>
        </div>

    </div>
</div>
@endsection

@push('styles')
<style>
/* Score card */
.score-card {
    display: flex; align-items: center; gap: 20px; flex-wrap: wrap;
    border-radius: 20px !important;
    position: relative; overflow: hidden;
}
.score-card::before {
    content: ''; position: absolute; inset: 0;
    background: linear-gradient(135deg, rgba(99,102,241,0.06), rgba(168,85,247,0.04));
    pointer-events: none;
}
.sc-left { flex: 1; min-width: 140px; }
.sc-career-label { font-size: 0.7rem; font-weight: 700; text-transform: uppercase; letter-spacing: .12em; color: var(--text-secondary); margin-bottom: 4px; }
.sc-career-name { font-family: var(--font-sora); font-size: 1.2rem; font-weight: 700; color: var(--text-primary); }
.sc-right { position: relative; display: flex; align-items: center; justify-content: center; }
.sc-chips { width: 100%; display: flex; flex-wrap: wrap; gap: 6px; margin-top: 4px; }
.sc-chip { font-size: 0.72rem; font-weight: 500; padding: 3px 10px; border-radius: 99px; border: 1px solid; }
.sc-chip.match { background: rgba(34,197,94,0.08); border-color: rgba(34,197,94,0.25); color: #86efac; }
.sc-chip.gap   { background: rgba(251,146,60,0.08); border-color: rgba(251,146,60,0.25); color: #fdba74; }

/* Readiness ring */
.readiness-ring {
    position: relative;
    width: var(--size, 80px); height: var(--size, 80px);
    background: conic-gradient(#6366f1 calc(var(--pct) * 1%), rgba(255,255,255,0.07) 0);
    border-radius: 50%; display: flex; align-items: center; justify-content: center;
}
.readiness-ring::before {
    content: ''; position: absolute; inset: 8px;
    background: var(--bg-deep); border-radius: 50%;
}
.ring-label { position: relative; font-weight: 700; color: var(--text-primary); z-index: 1; }

/* Badges */
.badge-pill { font-size: 0.7rem; font-weight: 600; padding: 2px 10px; border-radius: 99px; border: 1px solid; }
.badge-green  { background: rgba(34,197,94,0.1);  border-color: rgba(34,197,94,0.25);  color: #86efac; }
.badge-blue   { background: rgba(99,102,241,0.1); border-color: rgba(99,102,241,0.25); color: #a5b4fc; }
.badge-amber  { background: rgba(245,158,11,0.1); border-color: rgba(245,158,11,0.25); color: #fcd34d; }
.badge-red    { background: rgba(239,68,68,0.1);  border-color: rgba(239,68,68,0.25);  color: #fca5a5; }

/* Skills section */
.section-label { font-size: 0.8rem; font-weight: 600; color: var(--text-secondary); text-transform: uppercase; letter-spacing: 0.08em; }
.skill-chip { font-size: 0.72rem; font-weight: 500; padding: 3px 10px; border-radius: 99px; border: 1px solid; }
.skill-chip.matched { background: rgba(34,197,94,0.08); border-color: rgba(34,197,94,0.2); color: #86efac; }
.skill-chip.missing { background: rgba(249,115,22,0.08); border-color: rgba(249,115,22,0.2); color: #fdba74; }

/* Chat replay */
.msg { max-width: 80%; padding: 10px 14px; border-radius: 16px; font-size: 0.875rem; line-height: 1.6; word-break: break-word; }
.msg.bot  { background: rgba(255,255,255,0.055); border: 1px solid var(--border-glass); border-bottom-left-radius: 4px; align-self: flex-start; color: var(--text-primary); }
.msg.user { background: var(--accent-gradient); color: white; border-bottom-right-radius: 4px; align-self: flex-end; box-shadow: 0 4px 12px rgba(99,102,241,0.25); }

.chat-scroll::-webkit-scrollbar { width: 4px; }
.chat-scroll::-webkit-scrollbar-thumb { background: rgba(255,255,255,0.07); border-radius: 10px; }
</style>
@endpush