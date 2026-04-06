@extends('admin.layout')
@section('title', $career ? 'Edit Career' : 'Add Career')
@section('page-title', $career ? 'Edit Career Domain' : 'Add Career Domain')

@push('styles')
<style>
.rule-row { display:flex; gap:10px; align-items:center; margin-bottom:8px; background:rgba(255,255,255,0.03); border:1px solid var(--border); border-radius:10px; padding:10px 12px; flex-wrap:wrap; }
.rule-select { flex:1; min-width:160px; background:rgba(255,255,255,0.06); border:1px solid var(--border); border-radius:8px; padding:8px 10px; color:var(--text); font-size:0.85rem; outline:none; }
.rule-select option { background:#1e293b; }
.rule-weight-wrap { display:flex; align-items:center; gap:6px; flex-shrink:0; }
.rule-weight-wrap label { font-size:0.78rem; color:var(--muted); white-space:nowrap; }
.rule-weight-input { width:64px; background:rgba(255,255,255,0.06); border:1px solid var(--border); border-radius:8px; padding:8px 10px; color:var(--text); font-size:0.85rem; outline:none; text-align:center; }
.rule-mandatory-wrap { display:flex; align-items:center; gap:6px; flex-shrink:0; }
.rule-mandatory-wrap label { font-size:0.78rem; color:var(--muted); white-space:nowrap; cursor:pointer; }
.rule-mandatory-wrap input[type="checkbox"] { width:16px; height:16px; accent-color:#6366f1; cursor:pointer; flex-shrink:0; }
.rule-remove { background:none; border:none; color:#fca5a5; cursor:pointer; font-size:0.9rem; padding:4px 6px; flex-shrink:0; border-radius:6px; transition:background 0.15s; }
.rule-remove:hover { background:rgba(239,68,68,0.1); }
</style>
@endpush

@section('content')

<div class="d-flex align-items-center gap-3 mb-4">
    <a href="{{ route('admin.careers.index') }}" class="btn-admin btn-outline-admin">
        <i class="fa-solid fa-arrow-left"></i> Back
    </a>
    <div>
        <h5 class="fw-bold mb-0">{{ $career ? 'Edit: ' . $career->career_name : 'Add New Career Domain' }}</h5>
        <p style="color:var(--muted); font-size:0.83rem; margin:0;">Define the career name, description, and all skill rules with weights</p>
    </div>
</div>

<form method="POST" action="{{ $career ? route('admin.careers.update', $career) : route('admin.careers.store') }}" id="career-form">
    @csrf
    @if($career) @method('PUT') @endif

    <div class="row g-3">

        {{-- ── LEFT: Career details ── --}}
        <div class="col-lg-4">
            <div class="admin-card mb-3">
                <h6 class="fw-bold mb-3">Career Details</h6>

                <div class="mb-3">
                    <label class="form-label-admin">Career Name <span style="color:#fca5a5;">*</span></label>
                    <input type="text" name="career_name" class="form-input-admin"
                        value="{{ old('career_name', $career?->career_name) }}"
                        placeholder="e.g. Backend Developer" required>
                    @error('career_name')
                        <div style="color:#fca5a5; font-size:0.78rem; margin-top:4px;">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="form-label-admin">Description</label>
                    <textarea name="description" class="form-input-admin" rows="3"
                        placeholder="Brief description of this role...">{{ old('description', $career?->description) }}</textarea>
                </div>

                <div style="background:rgba(99,102,241,0.08); border:1px solid rgba(99,102,241,0.2); border-radius:10px; padding:12px 14px; font-size:0.82rem; color:#a5b4fc; line-height:1.8;">
                    <strong style="display:block; margin-bottom:4px;">Weight guide</strong>
                    <span style="display:block;">5 — core mandatory skill</span>
                    <span style="display:block;">3 — important skill</span>
                    <span style="display:block;">1 — nice to have</span>
                </div>
            </div>

            <button type="submit" class="btn-admin btn-primary-admin w-100" style="justify-content:center; padding:13px;">
                <i class="fa-solid fa-{{ $career ? 'floppy-disk' : 'plus' }}"></i>
                {{ $career ? 'Save Changes' : 'Create Career' }}
            </button>
        </div>

        {{-- ── RIGHT: Skill rules ── --}}
        <div class="col-lg-8">
            <div class="admin-card">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <div>
                        <h6 class="fw-bold mb-0">Skill Rules</h6>
                        <p style="color:var(--muted); font-size:0.78rem; margin:3px 0 0;">
                            Add all skills for this career. Tick Mandatory for core requirements.
                        </p>
                    </div>
                    <button type="button" class="btn-admin btn-primary-admin" onclick="addRule()" style="padding:7px 14px; font-size:0.8rem; flex-shrink:0;">
                        <i class="fa-solid fa-plus"></i> Add Skill
                    </button>
                </div>

                <div id="rules-container">
                    @if($rules->isNotEmpty())
                        @foreach($rules as $i => $rule)
                        <div class="rule-row" id="rule-{{ $loop->index }}">
                            <select name="skills[{{ $loop->index }}][skill_id]" class="rule-select" required>
                                <option value="">Select skill...</option>
                                @foreach($skills as $skill)
                                <option value="{{ $skill->id }}" {{ $rule->skill_id == $skill->id ? 'selected' : '' }}>
                                    {{ $skill->skill_name }} ({{ $skill->skill_type }})
                                </option>
                                @endforeach
                            </select>
                            <div class="rule-weight-wrap">
                                <label>Weight</label>
                                <input type="number" name="skills[{{ $loop->index }}][weight]" class="rule-weight-input" value="{{ $rule->weight }}" min="1" max="10" required>
                            </div>
                            <div class="rule-mandatory-wrap">
                                <input type="checkbox" name="skills[{{ $loop->index }}][is_mandatory]" id="m-{{ $loop->index }}" value="1" {{ $rule->is_mandatory ? 'checked' : '' }}>
                                <label for="m-{{ $loop->index }}">Mandatory</label>
                            </div>
                            <button type="button" class="rule-remove" onclick="removeRule('rule-{{ $loop->index }}')">
                                <i class="fa-solid fa-xmark"></i>
                            </button>
                        </div>
                        @endforeach
                    @else
                        <div id="empty-msg" style="text-align:center; padding:2.5rem 1rem; color:var(--muted); font-size:0.875rem;">
                            <i class="fa-solid fa-tags" style="font-size:1.5rem; display:block; margin-bottom:0.75rem; opacity:0.4;"></i>
                            No skill rules yet. Click <strong style="color:var(--text);">Add Skill</strong> to begin.
                        </div>
                    @endif
                </div>
            </div>
        </div>

    </div>
</form>

@endsection

@push('scripts')
<script>
let ruleCount = {{ $rules->count() }};
const allSkills = @json($skills->map(fn($s) => ['id' => $s->id, 'name' => $s->skill_name, 'type' => $s->skill_type]));

function addRule() {
    const container = document.getElementById('rules-container');
    const empty = document.getElementById('empty-msg');
    if (empty) empty.remove();

    const idx = ruleCount++;
    const opts = allSkills.map(s =>
        `<option value="${s.id}">${s.name} (${s.type})</option>`
    ).join('');

    const div = document.createElement('div');
    div.className = 'rule-row';
    div.id = `rule-${idx}`;
    div.innerHTML = `
        <select name="skills[${idx}][skill_id]" class="rule-select" required>
            <option value="">Select skill...</option>
            ${opts}
        </select>
        <div class="rule-weight-wrap">
            <label>Weight</label>
            <input type="number" name="skills[${idx}][weight]" class="rule-weight-input" value="3" min="1" max="10" required>
        </div>
        <div class="rule-mandatory-wrap">
            <input type="checkbox" name="skills[${idx}][is_mandatory]" id="m-${idx}" value="1">
            <label for="m-${idx}">Mandatory</label>
        </div>
        <button type="button" class="rule-remove" onclick="removeRule('rule-${idx}')">
            <i class="fa-solid fa-xmark"></i>
        </button>
    `;
    container.appendChild(div);
}

function removeRule(id) {
    const el = document.getElementById(id);
    if (el) el.remove();
    if (!document.getElementById('rules-container').children.length) {
        document.getElementById('rules-container').innerHTML = `
            <div id="empty-msg" style="text-align:center; padding:2.5rem 1rem; color:var(--muted); font-size:0.875rem;">
                <i class="fa-solid fa-tags" style="font-size:1.5rem; display:block; margin-bottom:0.75rem; opacity:0.4;"></i>
                No skill rules yet. Click <strong style="color:var(--text);">Add Skill</strong> to begin.
            </div>`;
    }
}
</script>
@endpush